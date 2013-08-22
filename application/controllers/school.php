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

        $params['schools'] = $resources;

        $this->load->view('school/get_page', $params);
    }

    public function add_form(){
        $this->session->set_userdata('schoolSaveId', NULL);
        $this->_form();
    }

    public function edit_form($id = NULL){
        $this->session->set_userdata('schoolSaveId', $id);
        $this->_form($id);
    }

    private function _form($id = NULL){
        $this->load->helper('form_helper');
        if(!($school = $this->school_model->get($id))){
            $school = $this->school_model->fields();
            $principal = $this->user_model->fields();
        }
        else{
            $principal = $this->school_model->principal();
        }

        $params['principal'] = $principal;
        $params['districts'] = $this->district_model->getAllIndexed();
        $params['grades'] = $this->school_model->grades();
        $params['school'] = $school;
        $this->template('school/form', $params);
    }

    public function save(){
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
        $school->id = $this->input->post('id');
        $school->name = $this->input->post('name');
        $school->startingSchoolYear = $this->input->post('startingSchoolYear');
        $school->classesStartDate = $this->input->post('classesStartDate');
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

        $principalsemail = $this->input->post('principalsemail');

        //Null means insert, an integer means edit that resourceId
        $idToSave = $this->session->userdata('schoolSaveId');

        if(!$idToSave){ //Insert
            unset($school->id);

            if(!($errors = $this->school_model->has_errors($school))){
                $id = $this->school_model->insert($school);
                if(!$this->_save_principal($id, $principalsemail, $school)){
                    $errors[] = 'Unable to save principal information.';
                }
            }
        }
        elseif(isset($school->id) && ($school->id == $idToSave)){ //Edit
            if(!($errors = $this->school_model->has_errors($school))){
                if($id = $this->school_model->update($school->id, $school)? $school->id: FALSE){

                    //School successfully saved, proceed to save principal
                    if(!$this->_save_principal($id, $principalsemail, $school)){
                        $errors[] = 'Unable to save principal information.';
                    }
                }
            }
        }
        else{ //Error
            $errors[] = 'Invalid school.';
        }

        $response = new stdClass();
        $response->errors = $errors;
        $response->id = $id;

        $this->session->unset_userdata('schoolSaveId');

        return $response;
    }

    private function _upload_csv($schoolId){
        $full_path = '';
        $errors = array();

        $school_path = config_item('uploads_path') . $schoolId;

        if(is_dir($school_path)){
            chmod($shcool_path, 0755);
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

    private function _save_principal($schoolId, $principalsemail, $school){
        $teacher = FALSE;
        $userId = FALSE;

        if($user = $this->user_model->get_by_email($principalsemail)){

            // This needs improvement. If someone register a school giving a mail used by someone else,
            // that someone else will automatically become admin of that school
            $userId = $user->id;
        }
        else{
            $user = new stdClass();
            $user->name = $school->principal;
            $user->email = $principalsemail;
            $user->role = User_model::$ROLE_S;
            $user->salt = hash('sha512', microtime());
            $user->password = Misc_helper::pbkdf2('sha512', implode('', explode(' ', $user->name)), $user->salt, '1024', '64');

            if($id = $this->user_model->insert($user)){
                $userId = $id;
            }
        }

        if($userId){
            $teacher = new stdClass();
            $teacher->schoolId = $schoolId;
            $teacher->userId = $userId;
            $teacher->schoolYear = date('Y');
            $teacher->enabled = TRUE;
            $teacher->gradeLevel = Teacher_model::$GRADE_LEVEL_T;
            $teacher->numStudents = 0;

            if($id = $this->teacher_model->insert($teacher)){
                $teacher->id = $id;
            }
            else{
                $teacher = FALSE;
            }
        }

        return $teacher;
    }

    private function _save_teachers_from_csv($schoolId, $full_path){
        $this->load->library('Csv_Reader');

        $csv_users = $this->csv_reader->parse_file($full_path);
        $csv_users = array_values($csv_users);
        $csv_users = json_decode(json_encode($csv_users));

        // Get all emails to search for users already on db
        $teachers = array();
        $emails = array();
        $year = date('Y');
        for($i=0;$i<count($csv_users);$i++){
            $csv_user = $csv_users[$i];
            if(isset($csv_user->gradeLevel) && isset($csv_user->name) && isset($csv_user->email) && isset($csv_user->numStudents) && $csv_user->email){
                $user = new stdClass();
                $user->name = $csv_user->name;
                $user->email = $csv_user->email;
                $user->role = User_model::$ROLE_T;
                $user->salt = hash('sha512', microtime());
                $user->password = Misc_helper::pbkdf2('sha512', implode('', explode(' ', $user->name)), $user->salt, '1024', '64');

                unset($csv_user->name);
                unset($csv_user->email);
                
                $teacher = new stdClass();
                $teacher->schoolId = $schoolId;
                $teacher->gradeLevel = $csv_user->gradeLevel;
                $teacher->numStudents = $csv_user->numStudents;
                $teacher->schoolYear = $year;
                $teacher->enabled = FALSE;
                $teacher->user = $user;

                $teachers[$user->email] = $teacher;
                $emails[$user->email] = $user->email;
            }
            else{
                unset($csv_users[$i]);
            }
        }
        $db_users = $this->user_model->gets_by_email($emails);
        foreach($db_users as $db_user){
            $teachers[$db_user->email]->user = $db_user;
            $teachers[$db_user->email]->userId = $db_user->id;
        }

        // Save every teacher to db
        $userIds = array();
        $teacherIds = array();
        foreach($teachers as &$teacher){

            // Save user before teacher
            if(!isset($teacher->user->id)){
                $user = $teacher->user;
                if($userId = $this->user_model->insert($user)){
                    $teacher->userId = $userId;
                    $userIds[] = $userId;
                }
            }

            // Save teacher at last
            unset($teacher->user);
            if($teacherId = $this->teacher_model->insert($teacher)){
                $teacherIds[] = $teacherId;
            }
        }

        //$data['csvData'] =  $result;
        //$this->load->view('view_csv', $data);
    }
}

/* End of file school.php */
/* Location: ./application/controllers/school.php */