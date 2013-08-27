<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tracking extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('resource_model');
    }

    public function enter(){
        $user = $this->session->userdata('user');
        $teacher = $this->session->userdata('teacher');
        $teachers = array();
        if($teacher->gradeLevel == Teacher_model::$GRADE_LEVEL_S){
            $teachers = $this->teacher_model->get_full_by_school($teacher->schoolId);
        }

        $school = $this->school_model->get($teacher->schoolId);
        $resources = $this->resource_model->get_for_poster($teacher->gradeLevel, $school->startingSchoolYear);
        $grades = $teacher->gradeLevel == Teacher_model::$GRADE_LEVEL_S? $this->teacher_model->grades(): array($teacher->gradeLevel);

        $params['user'] = $user;
        $params['teacher'] = $teacher;
        $params['teachers'] = $teachers;
        $params['resources'] = $resources;
        $params['school'] = $school;
        $params['grades'] = $grades;
        $params['months'] = Misc_helper::str_months();

        $this->template('tracking/enter', $params);
    }

    public function submit_poster(){
        $resourceIds = $this->input->post('resourceIds');
        echo json_encode($resourceIds);
    }

    public function get_resources(){
        $selected_grade = $this->input->post('selected_grade');
        
    }
}

/* End of file tracking.php */
/* Location: ./application/controllers/tracking.php */