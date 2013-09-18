<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee_model extends MY_Model {
    protected $table = 'employees';

    public function __construct(){
        parent::__construct();
    }

    public function has_errors($object){
        $errors = array();
        
        return $errors;
    }

    public function get_by_school($schoolId){
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where('schoolId', $schoolId);

        return $this->db->get()->result();
    }

    public function get_full_by_school($schoolId){
        $this->db->select('e.*, u.*, e.id');
        $this->db->from("{$this->table} AS e");
        $this->db->join('users AS u', 'e.userId = u.id', 'inner');
        $this->db->where('e.schoolId', $schoolId);

        return $this->db->get()->result();
    }
}

/* End of file employee_model.php */
/* Location: ./application/models/employee_model.php */