<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tracking_resource_model extends MY_Model {
    protected $table = 'trackingResources';

    public function __construct(){
        parent::__construct();
    }

    public function get_resources_used($schoolId, $month = FALSE, $year = FALSE){
        $this->db->select('tr.resourceId AS id, SUM(tr.timesUsed) AS used');
        $this->db->from('trackingEntry AS te');
        $this->db->join("{$this->table} AS tr", 'te.id = tr.trackingEntryId', 'inner');
        $this->db->where('te.schoolId', $schoolId);
        if($month){
            $this->db->where('MONTH(te.entered)', $month);
        }
        else{
            $this->db->where('MONTH(te.entered) = YEAR(NOW())');
        }
        if($year){
            $this->db->where('YEAR(te.entered)', $year);
        }
        else{
            $this->db->where('YEAR(te.entered) = YEAR(NOW())');
        }
        $this->db->group_by('resourceId');

        return $this->db->get()->result();
    }

    public function has_errors($tracking_resource){
        $errors = array();

        return $errors;
    }
}

/* End of file tracking_resource_model.php */
/* Location: ./application/models/tracking_resource_model.php */