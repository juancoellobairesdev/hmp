<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tracking extends MY_Controller {
    private $access;

    public function __construct(){
        parent::__construct();
        $this->load->model('resource_model');
        $this->load->model('tracking_model');
        $this->load->model('tracking_resource_model');
        $this->_set_access();
    }

    public function enter(){
        $role = $this->session->userdata('role');
        $schools = array();
        $teachers = array();
        $grades = array();

        $all_grades = $this->teacher_model->grades();

        if($this->_can_access($role, 'enter_choose_school')){
            $schools = $this->school_model->getAll();
            $teachers = $this->teacher_model->get_full_by_school($schools[0]->id);
            if($this->_can_access($teachers[0]->role, 'enter_choose_grade')){
                $grades = $all_grades;
            }
            else{
                $grades[$teachers[0]->gradeLevel] = $all_grades[$teachers[0]->gradeLevel];
            }
        }
        else{
            $school = $this->session->userdata('school');
            $schools[] = $school;
            if($this->_can_access($role, 'enter_choose_teacher')){
                $teachers = $this->teacher_model->get_full_by_school($school->id);
                if($this->_can_access($teachers[0]->role, 'enter_choose_grade')){
                    $grades = $all_grades;
                }
                else{
                    $grades[$teachers[0]->gradeLevel] = $all_grades[$teachers[0]->gradeLevel];
                }
            }
            else{
                $user = $this->session->userdata('user');
                $teacher = $this->session->userdata('teacher');
                $teacher->name = $user->name;
                $teachers[] = $teacher;
                if($this->_can_access($role, 'enter_choose_grade')){
                    $grades = $all_grades;
                }
                else{
                    $grades[$teacher->gradeLevel] = $all_grades[$teacher->gradeLevel];
                }
            }
        }

        $params['months'] = Misc_helper::get_months();
        $params['teachers'] = $teachers;
        $params['schools'] = $schools;
        $params['grades'] = $grades;

        $this->template('tracking/enter', $params);
    }

    public function get_resources(){
        $month = $this->input->post('month');
        $teacherId = $this->input->post('teacherId');
        $schoolId = $this->input->post('schoolId');
        $grade = $this->input->post('grade');

        $teacher = $this->teacher_model->get($teacherId);
        $school = $this->school_model->get($schoolId);
        $resources = $this->resource_model->get_for_poster($grade, $school->startingSchoolYear);
        $resources_used = $this->tracking_resource_model->get_resources_used($school->id, $month);
        $count_resources = count($resources);

        for($i=0; $i<$count_resources; $i++){
            $uses = 0;
            $unset_resource = FALSE;
            $resources_used = array_values($resources_used);
            $count_resources_used = count($resources_used);

            for($j=0; $j<$count_resources_used; $j++){
                if($resources[$i]->id == $resources_used[$j]->id){
                    if($resources[$i]->maximumUsesPerMonth - $resources_used[$j]->used < 1){
                        $unset_resource = TRUE;
                    }
                    else{
                        $uses = $resources_used[$j]->used;
                    }
                    unset($resources_used[$j]);
                }
            }

            if($unset_resource){
                unset($resources[$i]);
            }
            else{
                $resources[$i]->timesUsed = $uses;
                $resources[$i]->availableUses = $resources[$i]->maximumUsesPerMonth - $uses;
            }
        }


        $params['resources'] = $resources;
        $params['school'] = $school;

        $this->load->view('tracking/get_resources', $params);
    }

    public function get_teachers(){
        $schoolId = $this->input->post('schoolId');

        echo json_encode($this->teacher_model->get_full_by_school($schoolId));
    }

    public function get_grades(){
        $grades = array();
        $all_grades = $this->teacher_model->grades();
        $teacherId = $this->input->post('teacherId');

        $teacher = $this->teacher_model->get_full($teacherId);
        if($this->_can_access($teacher->role, 'enter_choose_grade')){
            $grades = $all_grades;
        }
        else{
            $grades[$teacher->gradeLevel] = $all_grades[$teacher->gradeLevel];
        }

        echo json_encode($grades);
    }

    public function submit_enter(){
        $errors = array();
        $id = FALSE;

        $resources = json_decode(json_encode($this->input->post('resources')));
        $reportingMonth = $this->input->post('reportingMonth');
        $reportingWeek = $this->input->post('reportingWeek');
        $teacherId = $this->input->post('teacherId');

        if($resources){
            if($teacher = $this->teacher_model->get($teacherId)){
                // Get reporting date
                try{
                    $str_month = Misc_helper::str_month($reportingMonth);
                    if((date('m') < 8 && $reportingMonth < 8) || (date('m') >= 8 && $reportingMonth >= 8)){
                        $year = date('Y');
                    }
                    else{
                        if(date('m') >= 8 && $reportingMonth < 8){
                            $year = date('Y') + 1;
                        }
                        else{
                            $year = date('Y') - 1;
                        }
                    }

                    $date = new DateTime('First monday of ' . $str_month . ' ' . $year);
                    $string = 'P' . intval($reportingWeek-1) . 'W';
                    $date->add(new DateInterval($string));
                }
                catch(Exception $e){
                    $date = new DateTime();
                    $date->add(new DateInterval('P1Y'));
                }
                $now = new DateTime();
                if($date <= $now){
                    $school = $this->school_model->get($teacher->schoolId);
                    $schoolId = $school->id;

                    $tracking = new stdClass();
                    $tracking->teacherId = $teacherId;
                    $tracking->schoolId = $schoolId;
                    $tracking->trackDate = $date->format('Y-m-d');
                    $tracking->reportingMonth = $reportingMonth;
                    $tracking->reportingWeek = $reportingWeek;
                    $errors = $this->tracking_model->has_errors($tracking);

                    // Save trackingEntry
                    if($id = $this->tracking_model->insert($tracking)){

                        // Save trackingResources
                        foreach($resources as $resource){
                            $resource->trackingEntryId = $id;
                            $this->tracking_resource_model->insert($resource);
                        }
                    }
                    else{
                        $errors[] = 'Unable to save tracking.';
                    }
                }
                else{
                    $errors[] = 'Invalid Month and Week given. Date cannot be greater than today.';
                }
            }
            else{
                $errors[] = 'Invalid teacher.';
            }
        }
        else{
            $errors[] = 'Please, select at least 1 resource to track.';
        }

        $data = new stdClass();
        $data->errors = $errors;
        $data->id = $id;
        $data->teacherId = $teacherId;

        echo json_encode($data);
    }

    public function unverified(){
        $role = $this->session->userdata('role');
        $userId = $this->session->userdata('userId');

        if($this->_can_access($role, 'unverified_choose_school')){
            $schools = $this->school_model->getAll();
        }
        else{
            $schools = $this->school_model->get_by_verifier($userId);
        }

        $params['schools'] = $schools;

        $this->template('tracking/unverified', $params);
    }

    public function get_trackings(){
        $schoolId = $this->input->post('schoolId');

        $trackings = $this->tracking_model->get_unverified_by_school($schoolId);
        foreach($trackings as &$tracking){
            $teacher = $this->teacher_model->get($tracking->teacherId);
            $user = $this->user_model->get($teacher->userId);
            $tracking->user = $user;
        }

        $params['trackings'] = $trackings;

        $this->load->view('tracking/get_trackings', $params);
    }

    public function submit_unverified(){
        $errors = array();
        $trackingIds = $this->input->post('trackingIds');
        $select_submit = $this->input->post('select_submit');
        $success = FALSE;

        if($trackingIds){
            if($select_submit == 'delete'){
                foreach($trackingIds as $trackingId){
                    $this->tracking_model->delete(array('id' => $trackingId));
                }
            }
            else{
                foreach($trackingIds as $trackingId){
                    $tracking = new stdClass();
                    $tracking->verified = Misc_helper::str_datetime_to_db();

                    $this->tracking_model->update($trackingId, $tracking);
                }
            }

            $success = TRUE;
        }
        else{
            $errors[] = 'Please, select something to Verify or Delete';
        }

        $data['success'] = $success;
        $data['errors'] = $errors;

        echo json_encode($data);
    }

    private function _set_access(){
        $access = array(
            'enter_choose_school' => array(
                User_model::$ROLE_A,
                User_model::$ROLE_H
            ),

            'enter_choose_teacher' => array(
                User_model::$ROLE_A,
                User_model::$ROLE_H,
                User_model::$ROLE_S,
                User_model::$ROLE_C,
            ),

            'enter_choose_grade' => array(
                User_model::$ROLE_A,
                User_model::$ROLE_H,
                User_model::$ROLE_C,
                User_model::$ROLE_S,
            ),

            'unverified_choose_school' => array(
                User_model::$ROLE_A,
            ),
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

/* End of file tracking.php */
/* Location: ./application/controllers/tracking.php */