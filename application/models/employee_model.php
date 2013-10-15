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

    public function fields(){
        $fields = parent::fields();
        $fields->name = '';
        $fields->email = '';

        return $fields;
    }

    public function get_not_vital_by_school($schoolId){
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where('schoolId', $schoolId);
        $this->db->where('userId IS NULL');

        $result = $this->db->get()->result();
        foreach($result as &$row){
            $data = unserialize($row->data);
            $row->name = isset($data->name)? $data->name: '';
            $row->email = isset($data->email)? $data->email: '';
        }

        return $result;
    }

    public function delete_not_vital_by_school($schoolId){
        $this->db->from($this->table);
        $this->db->where('schoolId', $schoolId);
        $this->db->where('userId IS NULL');
        $this->db->delete();
    }

    public function save_not_vital($schoolId, $not_vital_employee){
        if(isset($not_vital_employee->name) && isset($not_vital_employee->role)){
            $employee = new stdClass();
            $employee->schoolId = $schoolId;
            $employee->role = $not_vital_employee->role;

            $data = new stdClass();
            $data->name = $not_vital_employee->name;
            $data->email = $not_vital_employee->email;
            $employee->data = serialize($data);

            $this->db->where('schoolId', $schoolId);
            $this->db->insert($this->table, $employee);
        }
    }
}

/* End of file employee_model.php */
/* Location: ./application/models/employee_model.php */