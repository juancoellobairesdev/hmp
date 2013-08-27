<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
    }

    public function has_errors($object){
        $errors = array();

        if(!isset($object->schoolYear) || ($object->schoolYear != '0' && !intval($object->schoolYear))){
            $errors[] = 'Invalid value for "School Year". It must be an integer.';
        }

        if(!isset($object->gradeLevel) || !array_key_exists($object->gradeLevel, $this->grades(TRUE))){
            $errors[] = 'Invalid Grade Level.';
        }

        if(!isset($object->numStudents) || ($object->numStudents != '0' && !intval($object->numStudents))){
            $errors[] = 'Invalid value for "Number of Students". It must be an integer.';
        }

        return $errors;
    }

    public function get_by_school($schoolId){
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where('schoolId', $schoolId);

        return $this->db->get()->result();
    }

    public function get_full_by_school($schoolId){
        $this->db->select();
        $this->db->from($this->table);
        $this->db->join('users', 'teachers.userId = users.id', 'inner');
        $this->db->where('schoolId', $schoolId);

        return $this->db->get()->result();
    }

    public function get_count_by_school($schoolId){
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where('schoolId', $schoolId);

        return $this->db->count_all_results();
    }

    public function delete_by_school($schoolId){
        $this->db->from($this->table);
        $this->db->where('schoolId', $schoolId);
        $teachers = $this->db->get()->result();

        foreach($teachers as $teacher){
            $this->user_model->delete(array('id' => $teacher->userId));
        }
    }

    public function get_by_user($userId){
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where('userId', $userId);

        return $this->db->get()->row();
    }
}

/* End of file teacher_model.php */
/* Location: ./application/models/teacher_model.php */