<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tracking extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('resource_model');
        $this->load->model('tracking_model');
        $this->load->model('tracking_resource_model');
    }

    public function enter(){
        $user = $this->session->userdata('user');
        $teacher = $this->session->userdata('teacher');
        $teachers = array();
        if($teacher->gradeLevel == Teacher_model::$GRADE_LEVEL_S){
            $teachers = $this->teacher_model->get_full_by_school($teacher->schoolId);
        }

        $school = $this->school_model->get($teacher->schoolId);
        $grades = $teacher->gradeLevel == Teacher_model::$GRADE_LEVEL_S? $this->teacher_model->grades(): array($teacher->gradeLevel);

        $params['user'] = $user;
        $params['teacher'] = $teacher;
        $params['teachers'] = $teachers;
        $params['school'] = $school;
        $params['grades'] = $grades;
        $params['months'] = Misc_helper::str_months();

        $this->template('tracking/enter', $params);
    }

    public function get_resources(){
        $selected_grade = $this->input->post('selected_grade');
        $month = $this->input->post('month');

        $teacher = $this->session->userdata('teacher');
        $school = $this->school_model->get($teacher->schoolId);
        $resources = $this->resource_model->get_for_poster($selected_grade, $school->startingSchoolYear);
        $resources_used = $this->tracking_resource_model->get_resources_used($school->id, $month);
        $count_resources = count($resources);

        for($i=0; $i<$count_resources; $i++){
            $uses = 0;
            $unset_resource = FALSE;
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

    public function submit(){
        $errors = array();
        $id = FALSE;
        $teacher = $this->session->userdata('teacher');
        $schoolId = $teacher->schoolId;

        $resources = json_decode(json_encode($this->input->post('resources')));
        $reportingMonth = $this->input->post('reportingMonth');
        $reportingWeek = $this->input->post('reportingWeek');
        $teacherId = $this->input->post('teacherId');

        $tracking = new stdClass();
        $tracking->teacherId = $teacherId;
        $tracking->schoolId = $schoolId;
        $tracking->reportingMonth = $reportingMonth;
        $tracking->reportingWeek = $reportingWeek;

        if($resources){
            if(!($errors = $this->tracking_model->has_errors($tracking))){
                //$this->db->trans_begin();
                try{

                    // Save trackingEntry
                    if($id = $this->tracking_model->insert($tracking)){

                        // Save trackingResources
                        $trans_complete = TRUE;
                        foreach($resources as $resource){
                            $resource->trackingEntryId = $id;
                            $trans_error = $trans_complete && !!$this->tracking_resource_model->insert($resource);
                        }

                        if($trans_complete){
                            //$this->db->trans_commit();
                        }
                    }
                    else{
                        $errors[] = 'Unable to save tracking.';
                    }
                }
                catch(exception $e){
                    //$this->db->trans_rollback();
                    $errors[] = 'Unable to complete transaction.';
                }
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
}

/* End of file tracking.php */
/* Location: ./application/controllers/tracking.php */