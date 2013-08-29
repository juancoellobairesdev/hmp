<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class School_model extends MY_Model {
    protected $table = 'schools';

    public function __construct(){
        parent::__construct();
        $this->load->model('teacher_model');
    }

    public function get_verifier($id){
        $this->db->select('u.*');
        $this->db->from($this->table);
        $this->db->join('users AS u', "{$this->table}.verifierUserId = u.id", 'inner');
        $this->db->where("{$this->table}.id", $id);

        return $this->db->get()->row();
    }

    public function get_administrator($id){
        $this->db->select('u.*');
        $this->db->from($this->table);
        $this->db->join('users AS u', "{$this->table}.administratorUserId = u.id", 'inner');
        $this->db->where("{$this->table}.id", $id);

        return $this->db->get()->row();
    }

    public function get_all_approved(){
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where('approved', TRUE);

        return $this->db->get()->result();
    }

    public function has_errors($school){
        $errors = array();

        if(!isset($school->name) || !$school->name){
            $errors[] = 'Please, enter a name for the School.';
        }

        if(!isset($school->startingSchoolYear) || (intval($school->startingSchoolYear) < 2010)){
            $errors[] = 'Invalid year for "Starting School Year". It must be an integer greater or equal to 2010.';
        }

        if(!isset($school->classesStartDate) || !strtotime($school->classesStartDate)){
            $errors[] = 'Invalid date for "Start Classes Date".';
        }

        if(!isset($school->email) || !$school->email || !Misc_helper::is_valid_email($school->email)){
            $errors[] = 'Invalid email.';
        }

        if(isset($school->startTimeOfClasses) && $school->startTimeOfClasses && !Misc_helper::time_to_db($school->startTimeOfClasses)){
            $errors[] = 'Invalid date for "Start Time of Classes".';
        }

        if(isset($school->endTimeOfClasses) && $school->endTimeOfClasses && !Misc_helper::time_to_db($school->endTimeOfClasses)){
            $errors[] = 'Invalid date for "End Time of Classes".';
        }

        return $errors;
    }

    public function get_by_verifier($verifierUserId){
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where('verifierUserId', $verifierUserId);

        return $this->db->get()->result();
    }
}

/* End of file school_model.php */
/* Location: ./application/models/school_model.php */