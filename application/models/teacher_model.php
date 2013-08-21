<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teacher_model extends MY_Model {
    protected $table = 'teachers';

    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
    }

    public function has_errors($object){
        $errors = array();

        if(!isset($object->schoolYear) || ($object->schoolYear != '0' && !intval($object->schoolYear))){
            $errors[] = 'Invalid value for "School Year". It must be an integer.';
        }

        if(!isset($object->gradeLevel) || !array_key_exists($object->gradeLevel, $this->grades())){
            $errors[] = 'Invalid Grade Level.';
        }

        if(!isset($object->numStudents) || ($object->numStudents != '0' && !intval($object->numStudents))){
            $errors[] = 'Invalid value for "Number of Students". It must be an integer.';
        }

        return $errors;
    }
}

/* End of file teacher_model.php */
/* Location: ./application/models/teacher_model.php */