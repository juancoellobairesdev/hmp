<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee_type_model extends MY_Model {
    const ADM = 1;
    const VER = 2;
    const LSC = 3;
    const FCO = 4;
    const PET = 5;
    const SHA = 6;
    const TCH = 7;

    protected $table = 'employeeTypes';

    public function __construct(){
        parent::__construct();
    }

    public function has_errors($object){
        $errors = array();
        
        return $errors;
    }

    public function hotfix(){
        $verifier = new stdClass();
        $verifier->title = 'Verifier';

        $this->db->where('id', 2);
        $this->db->update($this->table, $verifier);
    }
}

/* End of file employee_type_model.php */
/* Location: ./application/models/employee_type_model.php */