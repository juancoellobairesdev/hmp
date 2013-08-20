<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {
    private $pk = 'id';
    private static $fields = array();

    public function __construct(){
        parent::__construct();
    }

    public function get($id){
        $where = array($this->pk => $id);

        $row = NULL;
        $result = $this->getSeveral($where);
        foreach($result as $row){
            break;
        }

        return $row;
    }

    public function getAll($page = FALSE){
        $where = array();
        return $this->getSeveral($where, $page);
    }

    public function getAllIndexed(){
        $response = array();
        $result = $this->getAll();
        foreach($result as $row){
            $response[$row->id] = $row;
        }

        return $response;
    }

    public function getSeveral($where = array(), $page = FALSE){
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where($where);
        if($page){
            $this->db->limit(PAGE_SIZE_DEFAULT, ($page-1) * PAGE_SIZE_DEFAULT);
        }

        return $this->db->get()->result();
    }

    public function count(){
        return $this->db->count_all($this->table);
    }

    public function fields(){
        if(isset(self::$fields[$this->table])){
            $field = new stdClass();
            foreach(self::$fields[$this->table] as $name => $value){
                $field->$name = $value;
            }
            return $field;
        }
        else{
            $row = new stdClass();
            $fields = $this->db->list_fields($this->table);
            foreach($fields as $field){
                $row->$field = NULL;
            }
            self::$fields[$this->table] = $row;
            return $row;
        }
    }


    public function insert($object){
        $id = NULL;
        if($this->db->insert($this->table, $object)){
            $id = $this->db->insert_id();
        }
        return $id;
    }

    public function update($id, $object){
        $this->db->where($this->pk, $id);
        return $this->db->update($this->table, $object);
    }
    
    public function grades(){
        $grades = array();
        $grades[0] = 'Kindergarten';
        $grades[1] = '1st. Grade';
        $grades[2] = '2dn. Grade';
        $grades[3] = '3rd. Grade';
        $grades[4] = '4th. Grade';
        $grades[5] = '5th. Grade';

        return $grades;
    }

    public function cohorts(){
        $cohorts = array();
        $cohorts[1] = '1';
        $cohorts[2] = '2';
        $cohorts[3] = '3';
        $cohorts[4] = '4';
        $cohorts[5] = '5';

        return $cohorts;
    }
}

/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */