<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!defined('TEACHER_GRADE_LEVEL_S')){
    define('TEACHER_GRADE_LEVEL_S', -2);
}

if(!defined('TEACHER_GRADE_LEVEL_PK')){
    define('TEACHER_GRADE_LEVEL_PK', -1);
}

if(!defined('TEACHER_GRADE_LEVEL_K')){
    define('TEACHER_GRADE_LEVEL_K', 0);
}

if(!defined('TEACHER_GRADE_LEVEL_1')){
    define('TEACHER_GRADE_LEVEL_1', 1);
}

if(!defined('TEACHER_GRADE_LEVEL_2')){
    define('TEACHER_GRADE_LEVEL_2', 2);
}

if(!defined('TEACHER_GRADE_LEVEL_3')){
    define('TEACHER_GRADE_LEVEL_3', 3);
}

if(!defined('TEACHER_GRADE_LEVEL_4')){
    define('TEACHER_GRADE_LEVEL_4', 4);
}

if(!defined('TEACHER_GRADE_LEVEL_5')){
    define('TEACHER_GRADE_LEVEL_5', 5);
}

class Teacher_model extends MY_Model {
    static $GRADE_LEVEL_S = -2;
    static $GRADE_LEVEL_PK = -1;
    static $GRADE_LEVEL_K = 0;
    static $GRADE_LEVEL_1 = 1;
    static $GRADE_LEVEL_2 = 2;
    static $GRADE_LEVEL_3 = 3;
    static $GRADE_LEVEL_4 = 4;
    static $GRADE_LEVEL_5 = 5;

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