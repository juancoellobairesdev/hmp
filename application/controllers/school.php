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
            $adm = $this->user_model->fields();
            $ver = $adm;
            $lsc = $adm;
            $fco = $adm;
            $pet = $adm;
            $sha = $adm;
        }
        else{
            if(!($adm = $this->school_model->get_adm($school->id))){
                $adm = $this->user_model->fields();
            }
            if(!($ver = $this->school_model->get_ver($school->id))){
                $ver = $this->user_model->fields();
            }
            if(!($lsc = $this->school_model->get_lsc($school->id))){
                $lsc = $this->user_model->fields();
            }
            if(!($fco = $this->school_model->get_fco($school->id))){
                $fco = $this->user_model->fields();
            }
            if(!($pet = $this->school_model->get_pet($school->id))){
                $pet = $this->user_model->fields();
            }
            if(!($sha = $this->school_model->get_sha($school->id))){
                $sha = $this->user_model->fields();
            }
        }

        $params['adm'] = $adm;
        $params['ver'] = $ver;
        $params['lsc'] = $lsc;
        $params['fco'] = $fco;
        $params['pet'] = $pet;
        $params['sha'] = $sha;
        $params['districts'] = $this->district_model->getAllIndexed();
        $params['grades'] = $this->school_model->grades();
        $params['school'] = $school;
        $this->template('school/form', $params);
    }

    public function save(){
        $response = new stdClass();
        $warnings = array();

        //$this->db->trans_begin();
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
                //$this->db->trans_rollback();
                $response->id = FALSE;
            }
        }
        catch(exception $e){
            //$this->db->trans_rollback();
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
        $db_employees = array();

        $temp = $this->employee_model->get_full_by_school($schoolId);
        foreach($temp as $employee){
            $db_employees[$employee->employeeTypesId] = $employee;
        }
        unset($temp);

        $employee_types = $this->employee_type_model->getAllIndexed();

        if(($email = $this->input->post('admsEmail')) && Misc_helper::is_valid_email($email)){
            if($name = $this->input->post('adm')){
                $employeeTypesId = Employee_type_model::ADM;
                $response = $this->_save_employee($schoolId, $name, $email, $employeeTypesId, $db_employees, User_model::$ROLE_C);
                if($response->id){
                    $response->typeId = $employeeTypesId;
                    $response->type = $employee_types[$employeeTypesId]->title;
                    $employees[] = $response;

                    if(($email = $this->input->post('versEmail')) && Misc_helper::is_valid_email($email)){
                        $name = $this->input->post('ver');

                        $employeeTypesId = Employee_type_model::VER;
                        $response = $this->_save_employee($schoolId, $name, $email, $employeeTypesId, $db_employees);
                        if($response->id){
                            $response->typeId = $employeeTypesId;
                            $response->type = $employee_types[$employeeTypesId]->title;
                            $employees[] = $response;
                        }
                    }

                    if(($email = $this->input->post('lscsEmail')) && Misc_helper::is_valid_email($email)){
                        $name = $this->input->post('lsc');

                        $employeeTypesId = Employee_type_model::LSC;
                        $response = $this->_save_employee($schoolId, $name, $email, $employeeTypesId, $db_employees);
                        if($response->id){
                            $response->typeId = $employeeTypesId;
                            $response->type = $employee_types[$employeeTypesId]->title;
                            $employees[] = $response;
                        }
                    }

                    if(($email = $this->input->post('fcosEmail')) && Misc_helper::is_valid_email($email)){
                        $name = $this->input->post('fco');

                        $employeeTypesId = Employee_type_model::FCO;
                        $response = $this->_save_employee($schoolId, $name, $email, $employeeTypesId, $db_employees);
                        if($response->id){
                            $response->typeId = $employeeTypesId;
                            $response->type = $employee_types[$employeeTypesId]->title;
                            $employees[] = $response;
                        }
                    }

                    if(($email = $this->input->post('petsEmail')) && Misc_helper::is_valid_email($email)){
                        $name = $this->input->post('pet');

                        $employeeTypesId = Employee_type_model::PET;
                        $response = $this->_save_employee($schoolId, $name, $email, $employeeTypesId, $db_employees);
                        if($response->id){
                            $response->typeId = $employeeTypesId;
                            $response->type = $employee_types[$employeeTypesId]->title;
                            $employees[] = $response;
                        }
                    }

                    if(($email = $this->input->post('shasEmail')) && Misc_helper::is_valid_email($email)){
                        $name = $this->input->post('sha');

                        $employeeTypesId = Employee_type_model::SHA;
                        $response = $this->_save_employee($schoolId, $name, $email, $employeeTypesId, $db_employees);
                        if($response->id){
                            $response->typeId = $employeeTypesId;
                            $response->type = $employee_types[$employeeTypesId]->title;
                            $employees[] = $response;
                        }
                    }
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

    private function _save_employee($schoolId, $name, $email, $employeeTypesId, $employees, $role = 'Support Staff'){
        // Get current employees
        $response = new stdClass();
        $response->id = FALSE;
        $response->raw_password = FALSE;

        if($email){
            if(!isset($employees[$employeeTypesId])){ // Insert user and employee
                $response_user = $this->_save_user($name, $email, $role, Misc_helper::random_password());

                if($response_user->id){
                    $employee = new stdClass();
                    $employee->employeeTypesId = $employeeTypesId;
                    $employee->userId = $response_user->id;
                    $employee->schoolId = $schoolId;
                    if($this->employee_model->insert($employee)){
                        $response = $response_user;
                    }
                }
            }
            else{
                $employee_type = $employees[$employeeTypesId];
                if($employee_type->email != $email){ // Save new user and update employee
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
        $grades = $this->teacher_model->grades();

        // Delete all teachers from a school
        if(count($csv_users)){
            $this->teacher_model->delete_by_school($schoolId);
        }

        $count = count($csv_users);
        for($i=0;$i<$count;$i++){
            $csv_user = $csv_users[$i];
            $csv_user->name = trim($csv_user->name);
            $csv_user->email = trim($csv_user->email);
            if(isset($csv_user->gradeLevel) && isset($csv_user->name) && isset($csv_user->email) && isset($csv_user->numStudents) && $csv_user->email){

                if(Misc_helper::is_valid_email($csv_user->email) && $csv_user->numStudents >= 0 && array_key_exists(intval($csv_user->gradeLevel), $grades)){
                    $raw_password = implode('', explode(' ', $csv_user->gradeLevel . $csv_user->name . $csv_user->gradeLevel));
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