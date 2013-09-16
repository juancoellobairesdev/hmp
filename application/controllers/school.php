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

        $pagination = Misc_helper::pagination($page, 'school');
        $params['pagination_html'] = Misc_helper::pagination_html($pagination);
        $params['pagination'] = $pagination;
        $this->template('school/show_list', $params);
    }

    public function get_page(){
        $page = $this->input->post('page');
        $schools = $this->school_model->getAll($page);
        foreach($schools as &$school){
            $employees = array();
            $temp = $this->employee_model->get_full_by_school($school->id);
            //$this->_print($temp);
            foreach($temp as $employee){
                $employees[$employee->employeeTypesId] = $employee;
            }
            $school->employees = $employees;
        }

        $params['schools'] = $schools;

        $view = $this->load->view('school/get_page', $params, TRUE);
        $pagination = Misc_helper::pagination($page, 'school');

        $data = new stdClass();
        $data->pagination_html = Misc_helper::pagination_html($pagination);
        $data->view = $view;

        echo json_encode($data);
    }

    public function add_form(){
        $this->session->unset_userdata('schoolSaveId');
        $this->_form();
    }

    public function edit_form($id = NULL){
        $this->session->set_userdata('schoolSaveId', $id);
        $this->_form($id);
    }

    public function edit(){
        $this->edit_form($this->session->userdata('schoolId'));
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

                $uploaded = $this->_upload_csv($response->id);
                if(!$uploaded->errors && $uploaded->full_path){
                    $this->_save_teachers_from_csv($response->id, $uploaded->full_path);
                }
                else{
                    $warnings = $uploaded->errors;
                }
            }
            else{
                $this->db->trans_rollback();
                $response->id = FALSE;
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
        $employees = array();

        $school = new stdClass();
        $school->id = $this->input->post('schoolId');
        $school->name = $this->input->post('name');
        
        if(!$school->id){
            $school->startingSchoolYear = Misc_helper::school_year();
        }
        else{
            if($this->input->post('startingSchoolYear')){
                $school->startingSchoolYear = $this->input->post('startingSchoolYear');
            }
        }
        $school->classesStartDate = Misc_helper::date_to_db($this->input->post('classesStartDate'));
        $school->address = $this->input->post('address');
        $school->phone = $this->input->post('phone');
        $school->fax = $this->input->post('fax');
        $school->email = $this->input->post('email');
        $school->startTimeOfClasses = $this->input->post('startTimeOfClasses');
        $school->endTimeOfClasses = $this->input->post('endTimeOfClasses');
        $school->shippingContactInfo = $this->input->post('shippingContactInfo');
        $school->principal = $this->input->post('principal');
        $school->principalCarbonCopied = $this->input->post('principalCarbonCopied');
        $school->approveNewsletterCommunication = $this->input->post('approveNewsletterCommunication');
        $school->approveReminderPrompts = $this->input->post('approveReminderPrompts');
        $school->districtId = $this->input->post('districtId');

        $idToSave = $this->session->userdata('schoolSaveId');
        $errors = $this->school_model->has_errors($school);

        if(!$errors){
            if(!$idToSave){ // Insert
                if(!($id = $this->school_model->insert($school))){
                    $errors[] = 'Unable to save School data.';
                }
            }

            // Update
            elseif(isset($school->id) && ($school->id == $idToSave)){
                if(!($id = $this->school_model->update($school->id, $school)? $school->id: FALSE)){
                    $errors[] = 'Unable to save School data.';
                }
            }
            else{
                $errors[] = 'Invalid school.';
            }

            if($id){
                $response = $this->_save_employees($id);
                $errors = $response->errors;
                $employees = $response->employees;
            }
        }

        $response = new stdClass();
        $response->errors = $errors;
        $response->id = $id;
        $response->employees = $employees;

        return $response;
    }

    private function _save_employees($schoolId){
        $errors = array();
        $employees = array();

        $temp = $this->employee_model->get_full_by_school($schoolId);
        foreach($temp as $employee){
            $employees[$employee->employeeTypeSid] = $employee;
        }
        unset($temp);

        $employee_types = $this->employee_type_model->getAllIndexed();

        if($email = $this->input->post('versEmail')){
            $name = $this->input->post('ver');

            $employeeTypeSid = Employee_type_model::VER;
            $response = $this->_save_employee($schoolId, $name, $email, $employeeTypeSid, $employees);
            if($response->id){
                $response->typeId = $employeeTypeSid;
                $response->type = $employee_types[$employeeTypeSid]->title;
                $employees[] = $response;
            }
        }

        if($email = $this->input->post('lscsEmail')){
            $name = $this->input->post('lsc');

            $employeeTypeSid = Employee_type_model::LSC;
            $response = $this->_save_employee($schoolId, $name, $email, $employeeTypeSid, $employees);
            if($response->id){
                $response->typeId = $employeeTypeSid;
                $response->type = $employee_types[$employeeTypeSid]->title;
                $employees[] = $response;
            }
        }

        if($email = $this->input->post('fcosEmail')){
            $name = $this->input->post('fco');

            $employeeTypeSid = Employee_type_model::FCO;
            $response = $this->_save_employee($schoolId, $name, $email, $employeeTypeSid, $employees);
            if($response->id){
                $response->typeId = $employeeTypeSid;
                $response->type = $employee_types[$employeeTypeSid]->title;
                $employees[] = $response;
            }
        }

        if($email = $this->input->post('petsEmail')){
            $name = $this->input->post('pet');

            $employeeTypeSid = Employee_type_model::PET;
            $response = $this->_save_employee($schoolId, $name, $email, $employeeTypeSid, $employees);
            if($response->id){
                $response->typeId = $employeeTypeSid;
                $response->type = $employee_types[$employeeTypeSid]->title;
                $employees[] = $response;
            }
        }

        if($email = $this->input->post('shasEmail')){
            $name = $this->input->post('sha');

            $employeeTypeSid = Employee_type_model::SHA;
            $response = $this->_save_employee($schoolId, $name, $email, $employeeTypeSid, $employees);
            if($response->id){
                $response->typeId = $employeeTypeSid;
                $response->type = $employee_types[$employeeTypeSid]->title;
                $employees[] = $response;
            }
        }

        if($email = $this->input->post('admsEmail')){
            if($name = $this->input->post('adm')){
                $employeeTypeSid = Employee_type_model::ADM;
                $response = $this->_save_employee($schoolId, $name, $email, $employeeTypeSid, $employees);
                if($response->id){
                    $response->typeId = $employeeTypeSid;
                    $response->type = $employee_types[$employeeTypeSid]->title;
                    $employees[] = $response;
                }
            }
            else{
                $errors[] = 'Please, give a name for Administrator.';
            }
        }
        else{
            $errors[] = 'Invalid email for Administrator.';
        }

        $response = new stdClass();
        $response->errors = $errors;
        $response->employees = $employees;

        return $response;
    }

    private function _save_employee($schoolId, $name, $email, $employeeTypeSid, $employees){
        // Get current employees
        $response = new stdClass();
        $response->id = FALSE;
        $response->raw_password = FALSE;

        if($email){
            if(!isset($employees[$employeeTypeSid])){ // Insert user and employee
                $response_user = $this->_save_user($name, $email, User_model::$ROLE_S, Misc_helper::random_password());

                if($response_user->id){
                    $employee = new stdClass();
                    $employee->employeeTypeSid = $employeeTypeSid;
                    $employee->userId = $response_user->id;
                    $employee->schoolId = $schoolId;
                    if($this->employee_model->insert($employee)){
                        $response = $response_user;
                    }
                }
            }
            else{
                $employee_type = $employees[$employeeTypeSid];
                if($employes_type->email != $email){ // Save new user and update employee
                    $response_user = $this->_save_user($name, $email, User_model::$ROLE_S, Misc_helper::random_password());

                    if($response_user->id){
                        $employee = new stdClass();
                        $employee->userId = $response_user->id;
                        if($this->employee_model->update($employee_type->id, $employee)){
                            $response = $response_user;
                        }
                    }
                }
                else{ // Check name and update user if necesary
                    if($name != $employee_type->name){
                        $user = new stdClass();
                        $user->name = $name;
                        if($this->user_name->update($employee_type->userId, $user)){
                            $response->id = $employee_type->userId;
                        }
                    }
                }
            }
        }

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