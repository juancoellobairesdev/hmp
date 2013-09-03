<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends MY_Controller {
    private $access;

    public function __construct(){
        parent::__construct();
        $this->_set_access();
        $this->load->model('report_model');
    }

    public function by_teacher(){
        $role = $this->session->userdata('role');

        $years = $this->report_model->get_years();
        $months = $this->report_model->get_months(date('Y'), TRUE);

        // Only A and H can choose schools
        $schools = array();
        if($this->_can_access($role, 'by_teacher_schools')){
            $schools = $this->school_model->getAll();
        }
        else{
            if($school = $this->session->userdata('school')){
                $schools[] = $school;
            }
        }
        if(count($schools) > 1){
            $any = new stdClass();
            $any->id = 0;
            $any->name = 'Any';
            $temp = array($any);
            $schools = array_merge($temp, $schools);
        }

        // Only A, H, S, V and C can choose teachers
        $teachers = array();

        // Only A, H, S, V and C can choose grades
        $grades = array();
        if($this->_can_access($role, 'by_teacher_grades')){
            $grades = $this->report_model->get_grades(TRUE);
        }
        else{
            if($teacher = $this->session->userdata('teacher')){
                $all_grades = $this->teacher_model->grades();
                $grades[$teacher->gradeLevel] = $all_grades[$teacher->gradeLevel];
            }
        }

        $params = array();
        $params['schools'] = $schools;
        $params['years'] = $years;
        $params['months'] = $months;
        $params['grades'] = $grades;
        $params['teachers'] = $teachers;

        $this->template('report/by_teacher', $params);
    }

    public function search_by_teacher(){
        $params = new stdClass();
        $params->result = $this->_search_by_teacher();

        $this->load->view('report/get_by_teacher', $params);
    }

    public function get_teachers_by_school(){
        $teachers = array();
        if($this->_can_access($this->session->userdata('role'), 'by_teacher_teachers')){
            $schoolId = $this->input->post('schoolId');

            $any = new stdClass();
            $any->id = 0;
            $any->name = 'Any';
            $teachers[] = $any;
            $teachers = array_merge($teachers, $this->teacher_model->get_full_by_school($schoolId));
        }
        else{
            $teacher = $this->session->userdata('teacher');
            $user = $this->session->userdata('user');
            $teacher->name = $user->name;
            $teachers[] = $teacher;
        }

        echo json_encode($teachers);
    }

    private function _search_by_teacher(){
        $year = $this->input->post('year');
        $month = $this->input->post('month');
        $grade = $this->input->post('grade');
        $schoolId = $this->input->post('schoolId');
        $teacherId = $this->input->post('teacherId');
        $order_by = $this->input->post('order_by');
        $side = $this->input->post('side');

        $params = new stdClass();
        $params->month = $month? $month: NULL;
        $params->grade = $grade!=''? $grade: NULL;
        $params->schoolId = $schoolId? $schoolId: NULL;
        $params->teacherId = $teacherId? $teacherId: NULL;
        $params->order_by = $order_by? $order_by: NULL;
        $params->side = $side=='desc'? $side: 'asc';

        return $this->tracking_model->report_by_teacher($year, $params);
    }

    public function download_by_teacher(){
        $errors = array();
        if(!($result = $this->_search_by_teacher())){
            $errors[] = 'Nothing to download.';
            return $errors;
        }

        $userId = $this->session->userdata('userId');
        $full_path = '';
        $url = '';
        $errors = array();

        $reports_path = config_item('uploads_path') . 'reports/' . $userId . '/';

        if(is_dir($reports_path)){
            @chmod($reports_path, 0755);
        }
        else{
            @mkdir($reports_path, 0755);
        }

        if(is_dir($reports_path)){
            $file_name = date('Y-m-dH:i:s').'.csv';//$schoolId . '_' . microtime(TRUE) . '.csv';
            $full_path = $reports_path . $file_name;

            $uploads_url = config_item('uploads_url');
            $url = $uploads_url . 'reports/' . $userId . '/' . $file_name;

            if($file = fopen($full_path, 'wt')){
                $line = '"Month","District","School","Grade Level","Teacher","Category","Resource","Minutes Per Use","Times Used","Maximum Uses Per Month","Minutes Used","Total Possible Use"' . PHP_EOL;
                fwrite($file, $line);


                foreach($result as $row){
                    $line = implode('","',(array) $row);
                    $line = '"' . $line . '"' . PHP_EOL;
                    fwrite($file, $line);
                }

                fclose($file);
            }
            else{
                $errors[] = 'Unable to create csv file.';
            }
        }
        else{
            $errors[] = 'Unable to create csv file.';
        }

        $response = new stdClass();
        $response->url = $url;
        $response->errors = $errors;

        echo json_encode($response);
    }

    public function by_school(){
        $role = $this->session->userdata('role');

        $years = $this->report_model->get_years();
        $months = $this->report_model->get_months(date('Y'), TRUE);

        // Only A and H can choose districts
        $districts = array();
        if($this->_can_access($role, 'by_school_districts')){
            $districts = $this->district_model->getAll();
        }
        else{
            if($school = $this->session->userdata('school')){
                $district = $this->district_model->get_by_school($school->id);
                $districts[] = $district;
            }
        }
        if(count($districts) > 1){
            $any = new stdClass();
            $any->id = 0;
            $any->name = 'Any';
            $temp = array($any);
            $districts = array_merge($temp, $districts);
        }


        // OJO BORRAR BORRAR BORRAR BORRAR BORRAR BORRAR 
        $districts = $this->district_model->getAll();


        $cohorts = $this->report_model->get_cohorts(TRUE);
        // Only A, H, S, V and C can choose teachers
        $teachers = array();

        $params = array();
        $params['districts'] = $districts;
        $params['years'] = $years;
        $params['months'] = $months;
        $params['cohorts'] = $cohorts;

        $this->template('report/by_school', $params);
    }

    public function search_by_school(){
        $params = new stdClass();
        $params->result = $this->_search_by_teacher();

        $this->load->view('report/get_by_school', $params);
    }

    public function get_schools_by_district(){
        $schools = array();
        if($this->_can_access($this->session->userdata('role'), 'by_school_schools')){
            $districtId = $this->input->post('districtId');
            $schools = $this->school_model->get_by_district($districtId);
        }
        else{
            $school = $this->session->userdata('school');
            $schools[] = $school;
        }

        if(count($schools) > 1){
            $any = new stdClass();
            $any->id = 0;
            $any->name = 'Any';
            $temp = array($any);
            $schools = array_merge($temp, $schools);
        }

        echo json_encode($schools);
    }

    public function _search_by_school(){
        $year = $this->input->post('year');
        $month = $this->input->post('month');
        $cohort = $this->input->post('cohort');
        $schoolId = $this->input->post('schoolId');
        $order_by = $this->input->post('order_by');
        $verified = $this->input->post('verified');
        $side = $this->input->post('side');

        $params = new stdClass();
        $params->month = $month? $month: NULL;
        $params->cohort = $cohort!=''? $cohort: NULL;
        $params->schoolId = $schoolId? $schoolId: NULL;
        $params->order_by = $order_by? $order_by: NULL;
        $params->verified = $verified? $verified: NULL;
        $params->side = $side=='desc'? $side: 'asc';

        return $this->tracking_model->report_by_school($year, $params);
    }

    private function _set_access(){
        $access = array(
            'by_teacher_schools' => array(
                User_model::$ROLE_A,
                User_model::$ROLE_H
            ),

            'by_teacher_grades' => array(
                User_model::$ROLE_A,
                User_model::$ROLE_H,
                User_model::$ROLE_S,
                User_model::$ROLE_V,
                User_model::$ROLE_C,
            ),

            'by_teacher_teachers' => array(
                User_model::$ROLE_A,
                User_model::$ROLE_H,
                User_model::$ROLE_S,
                User_model::$ROLE_V,
                User_model::$ROLE_C,
            ),

            'by_school_schools' => array(
                User_model::$ROLE_A,
                User_model::$ROLE_H
            ),

            'by_school_districts' => array(
                User_model::$ROLE_A,
                User_model::$ROLE_H
            ),

            'by_teacher_cohort' => array(
                User_model::$ROLE_A,
                User_model::$ROLE_H
            )
        );

        $this->access = $access;
    }

    private function _can_access($role, $function){
        if(array_key_exists($function, $this->access) && in_array($role, $this->access[$function])){
            return TRUE;
        }

        return FALSE;
    }
}

/* End of file report.php */
/* Location: ./application/controllers/report.php */