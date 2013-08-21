<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class School_model extends MY_Model {
    protected $table = 'schools';

    public function __construct(){
        parent::__construct();
        $this->load->model('teacher_model');
    }

    public function principal($id){
        $this->db->select('u.*');
        $this->db->from($this->table);
        $this->db->join('user AS u', "{$this->table}.userId = u.id", 'inner');
        $this->db->where("{$this->table}.id", $id);

        return $this->db->get->row();
    }

    public function has_errors(){
        return array();
    }
}

/* End of file school_model.php */
/* Location: ./application/models/school_model.php */