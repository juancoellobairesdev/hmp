<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tracking extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('resource_model');
    }

    public function poster(){
        $user = $this->session->userdata('user');
        $teacher = $this->session->userdata('teacher');
        $teachers = array();
        if($teacher->gradeLevel == Teacher_model::$GRADE_LEVEL_S){
            $teachers = $this->teacher_model->get_full_by_school($teacher->schoolId);
        }

        $school = $this->school_model->get($teacher->schoolId);
        $resources = $this->resource_model->get_for_poster($teacher->gradeLevel, $school->startingSchoolYear);

        $params['user'] = $user;
        $params['teacher'] = $teacher;
        $params['teachers'] = $teachers;
        $params['resources'] = $resources;
        $params['school'] = $school;
        $params['months'] = Misc_helper::str_months();

        $this->template('tracking/poster', $params);
    }

    public function submit_poster(){
        $resourceIds = $this->input->post('resourceIds');
        echo json_encode($resourceIds);
    }
}

/* End of file tracking.php */
/* Location: ./application/controllers/tracking.php */