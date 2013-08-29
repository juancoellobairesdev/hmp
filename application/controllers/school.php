<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class School extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('teacher_model');
        $this->load->model('school_model');
        $this->load->model('district_model');
    }

    public function show_list($page = 1){
        $params = array();

        $params['pagination'] = Misc_helper::pagination($page, 'school_model');
        $this->template('school/show_list', $params);
    }

    public function get_page(){
        $page = $this->input->post('page');
        $schools = $this->school_model->getAll($page);
        foreach($schools as &$school){
            $school->administrator = $this->user_model->get($school->administratorUserId);
            $school->verifier = $this->user_model->get($school->verifierUserId);
        }

        $params['schools'] = $schools;

        $this->load->view('school/get_page', $params);
    }

    public function add_form(){
        $this->session->unset_userdata('schoolSaveId');
        $this->_form();
    }

    public function edit_form($id = NULL){
        $this->session->set_userdata('schoolSaveId', $id);
        $this->_form($id);
    }

    private function _form($id = NULL){
        if(!($school = $this->school_model->get($id))){
            $school = $this->school_model->fields();
            $administrator = $this->user_model->fields();
            $verifier = $administrator;
        }
        else{
            if(!($administrator = $this->school_model->get_administrator($school->id))){
                $administrator = $this->user_model->fields();
            }
            if(!($verifier = $this->school_model->get_verifier($school->id))){
                $verifier = $this->user_model->fields();
            }
        }

        $params['administrator'] = $administrator;
        $params['verifier'] = $verifier;
        $params['districts'] = $this->district_model->getAllIndexed();
        $params['grades'] = $this->school_model->grades();
        $params['school'] = $school;
        $this->template('school/form', $params);
    }

    public function save(){
        $response = new stdClass();
        $warnings = array();

        $this->db->trans_begin();
        try{
            $response = $this->_save_school();
            if(!$response->errors && $response->id){
                $this->db->trans_commit();
                $uploaded = $this->_upload_csv($response->id);
                if(!$uploaded->errors && $uploaded->full_path){
                    $this->_save_teachers_from_csv($response->id, $uploaded->full_path);
                }
                else{
                    $warnings = $uploaded->errors;
                }
            }
        }
        catch(exception $e){
            $this->db->trans_rollback();
        }

        $response->warnings = $warnings;

        echo json_encode($response);
    }

    private function _save_school(){
        $errors = array();
        $id = FALSE;

        $school = new stdClass();
        $school->id = $this->input->post('schoolId');
        $school->name = $this->input->post('name');
        $school->startingSchoolYear = $this->input->post('startingSchoolYear');
        $school->classesStartDate = Misc_helper::date_to_db($this->input->post('classesStartDate'));
        $school->address = $this->input->post('address');
        $school->phone = $this->input->post('phone');
        $school->fax = $this->input->post('fax');
        $school->email = $this->input->post('email');
        $school->startTimeOfClasses = $this->input->post('startTimeOfClasses');
        $school->endTimeOfClasses = $this->input->post('endTimeOfClasses');
        $school->fallBreakDates = $this->input->post('fallBreakDates');
        $school->winterBreakDates = $this->input->post('winterBreakDates');
        $school->springBreakDates = $this->input->post('springBreakDates');
        $school->itbsTestingDates = $this->input->post('itbsTestingDates');
        $school->writingAssessmentDates = $this->input->post('writingAssessmentDates');
        $school->crctTestingDates = $this->input->post('crctTestingDates');
        $school->shippingContactInfo = $this->input->post('shippingContactInfo');
        $school->principal = $this->input->post('principal');
        $school->principalCarbonCopied = $this->input->post('principalCarbonCopied');
        $school->approveNewsletterCommunication = $this->input->post('approveNewsletterCommunication');
        $school->approveReminderPrompts = $this->input->post('approveReminderPrompts');
        $school->districtId = $this->input->post('districtId');
        $administrator_password = FALSE;
        $verifier_password = FALSE;

        //Null means insert, an integer means edit that resourceId
        $idToSave = $this->session->userdata('schoolSaveId');
        if(!$idToSave){ //Insert
            //unset($school->id);

            // Save administrator
            $response_administrator = $this->_save_administrator();
            $errors = $response_administrator->errors;
            $administrator_password = $response_administrator->administrator_password;
            $school->administratorUserId = $response_administrator->administratorId;

            if(!$errors){
                // Use admin as verifier if no verifier is given
                if(!$this->input->post('verifiersEmail')){
                    $school->verifierUserId = $school->administratorUserId;
                    $verifier_password = $administrator_password;
                }
                else{
                    $response_verifier = $this->_save_verifier();
                    $errors = $response_verifier->errors;
                    $verifier_password = $response_verifier->verifier_password;
                    $school->verifierUserId = $response->verifierId;
                }
            }

            // Finally save school
            $errors = array_merge($this->school_model->has_errors($school), $errors);

            if(!$errors){
                $id = $this->school_model->insert($school);
            }
        }

        // Edit Shcool
        elseif(isset($school->id) && ($school->id == $idToSave)){
            if(!($errors = $this->school_model->has_errors($school))){
                if(!($id = $this->school_model->update($school->id, $school)? $school->id: FALSE)){
                    $errors[] = 'Unable to save School data.';
                }
            }
            $this->session->unset_userdata('schoolSaveId');
        }
        else{ //Error
            $errors[] = 'Invalid school.';
        }

        $response = new stdClass();
        $response->errors = $errors;
        $response->administrator_password = $administrator_password;
        $response->verifier_password = $verifier_password;
        $response->id = $id;

        return $response;
    }

    private function _upload_csv($schoolId){
        $full_path = '';
        $errors = array();

        $school_path = config_item('uploads_path') . $schoolId;

        if(is_dir($school_path)){
            @chmod($shcool_path, 0755);
        }
        else{
            @mkdir($school_path, 0755);
        }

        if(is_dir($school_path)){
            $file_name = $schoolId . '_' . microtime(TRUE) . '.csv';
            $config['upload_path'] = $school_path;
            $config['allowed_types'] = 'csv';
            $config['max_size'] = '2048';
            $config['file_name'] = $file_name;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()){
                $errors[] = $this->upload->display_errors('','');
            }
            else{
                $data = $this->upload->data();
                $full_path = $data['full_path'];
            }
        }
        else{
            $errors[] = 'Unable to save csv file.';
        }

        $response = new stdClass();
        $response->full_path = $full_path;
        $response->errors = $errors;

        return $response;
    }

    private function _save_administrator(){
        $response = new stdClass();
        $response->administratorId = FALSE;
        $response->administrator_password = FALSE;
        $response->errors = array();
        $errors = array();

        $administratorsEmail = $this->input->post('administratorsEmail');
        $administrator = $this->input->post('administrator');

        if(!Misc_helper::is_valid_email($administratorsEmail)){
            $errors[] = 'Invalid email for "Administrator\'s email".';
        }
        if(!$administrator){
            $errors[] = 'Please, give a name for "Administrator".';
        }

        if(!$errors){
            $response_user = $this->_save_user($administrator, $administratorsEmail, User_model::$ROLE_S, Misc_helper::random_password());
            if($response->administratorId = $response_user->id){
                $response->administrator_password = $response_user->raw_password;
            }
            else{
                $errors[] = 'Unable to save administrator.';
            }
        }

        $response->errors = $errors;

        return $response;
    }

    private function _save_verifier($name, $email, $role = 'Support Staff'){
        $response = new stdClass();
        $response->verifierId = FALSE;
        $response->verifier_password = FALSE;
        $response->errors = array();

        $verifier = $this->input->post('verifier');
        $verifiersEmail = $this->input->post('verifiersEmail');

        if(!Misc_helper::is_valid_email($verifiersEmail)){
            $errrors[] = 'Invalid email for "verifier\'s email".';
        }
        if(!$verifier){
            $errors[] = 'Please, give a name for "verifier".';
        }

        if(!$errors){
            $response_user = $this->_save_user($verifier, $verifiersEmail, User_model::$ROLE_S);
            if($response->verifierId = $response_user->id){
                $response->verifier_password = $response_user->raw_password;
            }
            else{
                $errors[] = 'Unable to save verifier.';
            }
        }

        $response->errors = $errors;

        return $response;
    }

    private function _save_user($name, $email, $role = 'Support Staff', $raw_password = FALSE){
        $response = new stdClass();
        $response->id = FALSE;
        $response->raw_password = FALSE;

        $raw_password = $raw_password? $raw_password: implode('', explode(' ', $role . $name . $role));
        $user = new stdClass();
        $user->name = $name;
        $user->email = $email;
        $user->role = $role;
        $user->salt = hash('sha512', microtime());
        $user->password = Misc_helper::encrypt_password($raw_password, $user->salt);

        if($response->id = $this->user_model->insert($user)){
            $response->raw_password = $raw_password;
        }

        return $response;
    }

    private function _save_teachers_from_csv($schoolId, $full_path){
        $this->load->library('Csv_Reader');

        $csv_users = $this->csv_reader->parse_file($full_path);
        $csv_users = array_values($csv_users);
        $csv_users = json_decode(json_encode($csv_users));

        $teachers = array();
        $year = date('Y');

        // Delete all teachers from a school
        if(count($csv_users)){
            $this->teacher_model->delete_by_school($schoolId);
        }

        for($i=0;$i<count($csv_users);$i++){
            $csv_user = $csv_users[$i];
            if(isset($csv_user->gradeLevel) && isset($csv_user->name) && isset($csv_user->email) && isset($csv_user->numStudents) && $csv_user->email){
                $raw_password = implode('', explode(' ', $csv_user->gradeLevel . $user->name . $user->gradeLevel ));
                $user = new stdClass();
                $user->name = $csv_user->name;
                $user->email = $csv_user->email;
                $user->role = User_model::$ROLE_T;
                $user->salt = hash('sha512', microtime());
                $user->password = Misc_helper::encrypt_password($raw_password, $user->salt);

                $teacher = new stdClass();
                $teacher->schoolId = $schoolId;
                $teacher->gradeLevel = $csv_user->gradeLevel;
                $teacher->numStudents = $csv_user->numStudents;
                $teacher->schoolYear = $year;
                $teacher->enabled = FALSE;
                $teacher->user = $user;

                $teachers[$user->email] = $teacher;
                unset($csv_users[$i]);
                // $csv_users will hold at the end, all the invalid users on the csv file
            }
        }

        // Save every teacher to db
        $userIds = array();
        $teacherIds = array();
        foreach($teachers as $teacher){
            // Save user before teacher
            $user = $teacher->user;
            if($userId = $this->user_model->insert($user)){
                $teacher->userId = $userId;
                $userIds[] = $userId;
            }

            // Save teacher at last
            unset($teacher->user);
            if($teacherId = $this->teacher_model->insert($teacher)){
                $teacherIds[] = $teacherId;
            }
        }
    }

    public function check_upload(){
        $id = $this->input->post('schoolId');

        $count = $this->teacher_model->get_count_by_school($id);

        echo json_encode(!!$count);
    }
}

/* End of file school.php */
/* Location: ./application/controllers/school.php */