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


    public function report_by_teacher($year, $params){
        $order_by = array();
        $order_by['month'] = 'month(tc.entered)';
        $order_by['district'] = 'd.id';
        $order_by['school'] = 's.id';
        $order_by['grade'] = 't.gradeLevel';
        $order_by['teacher'] = 't.id';

        $this->db->select('
            month(tc.entered) AS month,
            d.name AS district,
            s.name AS school,
            t.gradeLevel AS gradeLevel,
            u.name AS teacher,
            c.name AS category,
            r.title AS resource,
            r.minutesPerUse,
            tcr.timesUsed,
            r.maximumUsesPerMonth,
            r.minutesPerUse * tcr.timesUsed AS minutesUsed,
            r.maximumUsesPerMonth * r.minutesPerUse AS totalPossibleTime
        ');

        $this->db->from('trackingResources AS tcr');
        $this->db->join('refResources AS r', 'tcr.resourceId = r.id', 'inner');
        $this->db->join('refResourceCategories AS c', 'r.categoryId = c.id', 'inner');
        $this->db->join('trackingEntry AS tc', 'tcr.trackingEntryId = tc.id', 'inner');
        $this->db->join('teachers AS t', 'tc.teacherId = t.id', 'inner');
        $this->db->join('users AS u', 't.userId = u.id', 'inner');
        $this->db->join('schools AS s', 'tc.schoolId = s.id', 'inner');
        $this->db->join('refDistricts AS d', 's.districtId = d.id', 'inner');
        
        $fall = $year . ' - 07';
        $break = $year + 1 . ' - 07';

        $this->db->where('tc.entered >', $fall);
        $this->db->where('tc.entered <', $break);

        if(isset($params->schoolId)){
            $this->db->where('tc.schoolId', $params->schoolId);
        }
        if(isset($params->teacherId)){
            $this->db->where('tc.teacherId', $params->teacherId);
        }
        if(isset($params->grade)){
            $this->db->where('t.gradeLevel', $params->grade);
        }
        if(isset($params->month)){
            $this->db->where('month(tc.entered)', $params->month);
        }

        if(isset($params->order_by) and array_key_exists($params->order_by, $order_by)){
            $this->db->order_by($order_by[$params->order_by], $params->side);
        }

        return $this->db->get()->result();
    }

    public function report_by_school($year, $params){
        $order_by = array();
        $order_by['month'] = 'month(tc.entered)';
        $order_by['district'] = 'd.id';
        $order_by['school'] = 's.id';
        $order_by['grade'] = 't.gradeLevel';
        $order_by['teacher'] = 't.id';

        $this->db->select('
            month(tc.entered) AS month,
            d.name AS district,
            s.name AS school,
            t.gradeLevel AS gradeLevel,
            u.name AS teacher,
            c.name AS category,
            r.title AS resource,
            r.minutesPerUse,
            tcr.timesUsed,
            r.maximumUsesPerMonth,
            r.minutesPerUse * tcr.timesUsed AS minutesUsed,
            r.maximumUsesPerMonth * r.minutesPerUse AS totalPossibleTime
        ');

        $this->db->from('trackingResources AS tcr');
        $this->db->join('refResources AS r', 'tcr.resourceId = r.id', 'inner');
        $this->db->join('refResourceCategories AS c', 'r.categoryId = c.id', 'inner');
        $this->db->join('trackingEntry AS tc', 'tcr.trackingEntryId = tc.id', 'inner');
        $this->db->join('teachers AS t', 'tc.teacherId = t.id', 'inner');
        $this->db->join('users AS u', 't.userId = u.id', 'inner');
        $this->db->join('schools AS s', 'tc.schoolId = s.id', 'inner');
        $this->db->join('refDistricts AS d', 's.districtId = d.id', 'inner');
        
        $fall = $year . ' - 07';
        $break = $year + 1 . ' - 07';

        $this->db->where('tc.entered >', $fall);
        $this->db->where('tc.entered <', $break);

        if(isset($params->schoolId)){
            $this->db->where('tc.schoolId', $params->schoolId);
        }
        if(isset($params->teacherId)){
            $this->db->where('tc.teacherId', $params->teacherId);
        }
        if(isset($params->grade)){
            $this->db->where('t.gradeLevel', $params->grade);
        }
        if(isset($params->month)){
            $this->db->where('month(tc.entered)', $params->month);
        }

        if(isset($params->order_by) and array_key_exists($params->order_by, $order_by)){
            $this->db->order_by($order_by[$params->order_by], $params->side);
        }

        return $this->db->get()->result();
    }
}

/* End of file tracking_model.php */
/* Location: ./application/models/tracking_model.php */