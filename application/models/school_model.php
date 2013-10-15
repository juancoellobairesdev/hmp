<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class School_model extends MY_Model {
    protected $table = 'schools';

    public function __construct(){
        parent::__construct();
        $this->load->model('teacher_model');
    }

    public function get_adm($id){
        return $this->get_staff($id, Employee_type_model::ADM);
    }

    public function get_ver($id){
        return $this->get_staff($id, Employee_type_model::VER);
    }

    public function get_lsc($id){
        return $this->get_staff($id, Employee_type_model::LSC);
    }

    public function get_fco($id){
        return $this->get_staff($id, Employee_type_model::FCO);
    }

    public function get_pet($id){
        return $this->get_staff($id, Employee_type_model::PET);
    }

    public function get_sha($id){
        return $this->get_staff($id, Employee_type_model::SHA);
    }

    public function get_staff($id, $type){
        $this->db->select('u.*');
        $this->db->from("{$this->table} AS s");
        $this->db->join('employees AS e', 's.id = e.schoolId', 'inner');
        $this->db->join('users AS u', 'e.userId = u.id', 'inner');
        $this->db->where('s.id', $id);
        $this->db->where('e.employeeTypesId', $type);

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

        /*if(!isset($school->email) || !$school->email || !Misc_helper::is_valid_email($school->email)){
            $errors[] = 'Invalid email.';
        }*/

        if(!isset($school->principalEmailAddress) || !$school->principalEmailAddress || !Misc_helper::is_valid_email($school->principalEmailAddress)){
            $errors[] = 'Invalid email for Principal.';
        }

        if(isset($school->startTimeOfClasses) && $school->startTimeOfClasses && !Misc_helper::time_to_db($school->startTimeOfClasses)){
            $errors[] = 'Invalid date for "Start Time of Classes".';
        }

        if(isset($school->endTimeOfClasses) && $school->endTimeOfClasses && !Misc_helper::time_to_db($school->endTimeOfClasses)){
            $errors[] = 'Invalid date for "End Time of Classes".';
        }

        return $errors;
    }

    public function get_by_verifier($userId){
        /*
        $this->db->select('s.*');
        $this->db->from("{$this->table} AS s");
        $this->db->join('employees AS e', 's.id = e.schoolId', 'inner');
        $this->db->where('e.id', $userId);
        $this->db->where('(e.employeeTypesId = ' . Employee_type_model::VER);
        $this->db->or_where('e.employeeTypesId', Employee_type_model::ADM);

        return $this->db->get()->result();
        */

        $sql = "
            SELECT s.*
            FROM schools AS s
            INNER JOIN employees AS e
                ON s.id = e.schoolId
            AND e.userId = ?
            AND (
                e.employeeTypesId = ?
                OR
                e.employeeTypesId = ?
            )
        ";

        return $this->db->query($sql, array($userId, Employee_type_model::ADM, Employee_type_model::VER))->result();
    }

    public function get_by_user($userId){
        $this->db->select('s.*');
        $this->db->from("{$this->table} AS s");
        $this->db->join('employees AS e', 's.id = e.schoolId', 'inner');
        $this->db->where('e.userId', $userId);

        // Not good but client want this asap. The way database is right now, it is very possible that an user verifies or manage more than 1 school.
        return $this->db->get()->row();
    }

    public function get_by_district($districtId){
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where('districtId', $districtId);

        return $this->db->get()->result();
    }
}

/* End of file school_model.php */
/* Location: ./application/models/school_model.php */