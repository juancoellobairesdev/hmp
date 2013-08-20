<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class School_model extends MY_Model {
    protected $table = 'schools';

    public function index(){
        echo "hola vieja de la water polo";
    }

    public function save($fields){
        if(!(isset($fields->startingSchoolYear) && $fields->startingSchoolYear)){
            $fields->startingSchoolYear = date('Y');
        }

        $this->insert($this->table, $fields);
    }
}

/* End of file school_model.php */
/* Location: ./application/models/school_model.php */