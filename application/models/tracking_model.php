<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tracking_model extends MY_Model {
    protected $table = 'trackingEntry';

    public function __construct(){
        parent::__construct();
    }

    public function has_errors($tracking){
        $ci = &get_instance();

        $errors = array();
        if(!Misc_helper::str_month($tracking->reportingMonth)){
            $errors[] = 'Invalid value for "Reporting Month".';
        }
        if($tracking->reportingWeek < 1 || $tracking->reportingWeek > 5){
            $errors[] = 'Invalid value for "Reporting Week".';
        }
        if(!$ci->teacher_model->get($tracking->teacherId)){
            $errors[] = 'Invalid Teacher selected';
        }

        return $errors;
    }

    public function insert($tracking){
        if(!isset($tracking->entered)){
            $tracking->entered = Misc_helper::str_datetime_to_db();
        }

        return parent::insert($tracking);
    }

    public function get_unverified_by_school($schoolId){
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where('schoolId', $schoolId);
        $this->db->where('verified IS NULL');
        $this->db->order_by('entered', 'desc');

        return $this->db->get()->result();
    }
}

/* End of file tracking_model.php */
/* Location: ./application/models/tracking_model.php */