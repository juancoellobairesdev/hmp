<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class District_model extends MY_Model {
    protected $table = 'refDistricts';

    public function __construct(){
        parent::__construct();
    }

    public function get_by_school($schoolId){
        $this->db->select('d.*');
        $this->db->from('schools AS s');
        $this->db->join("{$this->table} AS d", 's.districtId = d.id', 'inner');
        $this->db->where('s.id', $schoolId);

        return $this->db->get()->row();
    }
}

/* End of file district_model.php */
/* Location: ./application/models/district_model.php */