<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tracking_model extends MY_Model {
    protected $table = 'trackingEntry';

    public function __construct(){
        parent::__construct();
    }

    public function has_errors($tracking){
        $ci = &get_instance();

        $errors = array();

        if(Misc_helper::str_month($tracking->reportingMonth)){
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
        $this->db->select('
            year(tc.trackDate) as year,
            month(tc.trackDate) AS month,
            d.name AS district,
            s.name AS school,
            t.gradeLevel AS gradeLevel,
            u.name AS teacher,
            c.name AS category,
            r.title AS resource,
            r.minutesPerUse,
            tcr.timesUsed,
            r.maximumUsesPerYear,
            r.minutesPerUse * tcr.timesUsed AS minutesUsed,
            r.maximumUsesPerYear * r.minutesPerUse AS totalPossibleTime
        ');

        $this->db->from('trackingResources AS tcr');
        $this->db->join('refResources AS r', 'tcr.resourceId = r.id', 'inner');
        $this->db->join('refResourceCategories AS c', 'r.categoryId = c.id', 'inner');
        $this->db->join('trackingEntry AS tc', 'tcr.trackingEntryId = tc.id', 'inner');
        $this->db->join('teachers AS t', 'tc.teacherId = t.id', 'inner');
        $this->db->join('users AS u', 't.userId = u.id', 'inner');
        $this->db->join('schools AS s', 'tc.schoolId = s.id', 'inner');
        $this->db->join('refDistricts AS d', 's.districtId = d.id', 'inner');

        if(isset($params->month)){
            if($params->month < 8){
                $date = $year + 1 . '-' . $params->month;
            }
            else{
                $date = $year . '-' . $params->month;
            }
        }
        else{
            $date = $year + 1 . '-07-31';
        }

        $this->db->where('tc.trackDate <=', $date);

        if(isset($params->schoolId)){
            $this->db->where('tc.schoolId', $params->schoolId);
        }
        if(isset($params->teacherId)){
            $this->db->where('tc.teacherId', $params->teacherId);
        }
        if(isset($params->grade)){
            $this->db->where('t.gradeLevel', $params->grade);
        }

        $this->db->order_by('tc.trackDate');
        $this->db->order_by('d.name');
        $this->db->order_by('s.name');
        $this->db->order_by('t.gradeLevel');
        $this->db->order_by('u.name');

        return $this->db->get()->result();
        $return = $this->db->get()->result();
        $ci = &get_instance();
        $ci->_print($this->db->last_query());
        return $return;
    }

    public function report_by_school($year, $params){
        $this->db->select('
            year(tc.trackDate) as year,
            month(tc.trackDate) AS month,
            tc.verified,
            d.name AS district,
            s.name AS school,
            r.nutrition,
            IF(month(now())<8, year(now()) - s.startingSchoolYear, year(now()) - s.startingSchoolYear + 1) AS cohort,
            t.numStudents as students,
            tcr.timesUsed as teacherUsage,
            tcr.timesUsed * r.minutesPerUse AS totalTimeMinutes,
            tcr.timesUsed * r.minutesPerUse / 60 AS actualTime,
            tcr.timesUsed * t.numStudents as studentUsage,
        ');

        $this->db->from('trackingResources AS tcr');
        $this->db->join('refResources AS r', 'tcr.resourceId = r.id', 'inner');
        $this->db->join('trackingEntry AS tc', 'tcr.trackingEntryId = tc.id', 'inner');
        $this->db->join('teachers AS t', 'tc.teacherId = t.id', 'inner');
        $this->db->join('schools AS s', 'tc.schoolId = s.id', 'inner');
        $this->db->join('refDistricts AS d', 's.districtId = d.id', 'inner');
        
        if($params->date){ // Date between
            if($params->month < 8){
                $date = $year + 1 . '-' . $params->month . '-1';
            }
            else{
                $date = $year . '-' . $params->month . '-1';
            }
            if($params->andMonth < 8){
                $andDate = $year + 1 . '-' . $params->andMonth;
            }
            else{
                $andDate = $year . '-' . $params->andMonth;
            }

            $this->db->where('tc.trackDate >=', $date);
            $this->db->where('tc.trackDate <=', $andDate);
        }
        else{ // Up to Date
            if(isset($params->month)){
                if($params->month < 8){
                    $date = $year + 1 . '-' . $params->month;
                }
                else{
                    $date = $year . '-' . $params->month;
                }
            }
            else{
                $date = $year + 1 . '-07-31';
            }

            $this->db->where('tc.trackDate <=', $date);
        }

        if(isset($params->late)){
            $sign = $params->late == 1? '': '!';
            $this->db->where("month(tc.entered) {$sign}= month(tc.trackDate)");
        }
        if(isset($params->schoolId)){
            $this->db->where('tc.schoolId', $params->schoolId);
        }
        if(isset($params->districtId)){
            $this->db->where('d.id', $params->districtId);
        }
        if(isset($params->cohort)){
            $this->db->where('IF(month(now())<8, year(now()) - s.startingSchoolYear, year(now()) - s.startingSchoolYear + 1) <=', $params->cohort);
        }

        $not = $params->verified? 'NOT': '';
        $this->db->where("tc.verified IS {$not} NULL");
        if($params->verified && $params->afterDate){
            $this->db->where('tc.verified >', $params->afterDate);
        }

        $this->db->order_by('tc.trackDate');
        $this->db->order_by('tc.verified');
        $this->db->order_by('d.name');
        $this->db->order_by('s.name');
        $this->db->order_by('r.nutrition');

        return $this->db->get()->result();
        $return = $this->db->get()->result();
        $ci = &get_instance();
        $ci->_print($this->db->last_query());
        return $return;
    }

    public function report_by_resource($year, $params){
        $this->db->select('
            c.name as category, 
            r.title as resource, 
            t.gradeLevel, 
            u.name as teacher,
            t.numStudents as students,
            tcr.timesUsed as teacherUsage, 
            tcr.timesUsed * t.numStudents as studentUsage,
            tcr.timesUsed * t.numStudents * r.minutesPerUse as minutesOfInstruction
        ');

        $this->db->from('trackingEntry AS tc');
        $this->db->join('trackingResources AS tcr', 'tc.id = tcr.trackingEntryId', 'inner');
        $this->db->join('refResources AS r', 'tcr.resourceId = r.id', 'inner');
        $this->db->join('refResourceCategories AS c', 'r.categoryId = c.id', 'inner');
        $this->db->join('teachers AS t', 'tc.teacherId = t.id', 'inner');
        $this->db->join('users AS u', 't.userId = u.id', 'inner');
        
        /*
        $fall = $year . ' - 07';
        $break = $year + 1 . ' - 07';

        $this->db->where('tc.entered >', $fall);
        $this->db->where('tc.entered <', $break);
        */

        if(isset($params->month)){
            if($params->month < 8){
                $date = $year + 1 . '-' . $params->month;
            }
            else{
                $date = $year . '-' . $params->month;
            }
        }
        else{
            $date = $year + 1 . '-07-31';
        }

        $this->db->where('tc.trackDate <=', $date);

        if(isset($params->schoolId)){
            $this->db->where('tc.schoolId', $params->schoolId);
        }
        if(isset($params->grade)){
            $this->db->where('t.gradeLevel', $params->grade);
        }
        if(isset($params->cohort)){
            $this->db->where('IF(month(now())<8, year(now()) - s.startingSchoolYear, year(now()) - s.startingSchoolYear + 1) <=', $params->cohort);
        }

        $this->db->order_by('c.id');
        $this->db->order_by('r.id');
        $this->db->order_by('t.gradeLevel');

        return $this->db->get()->result();
        $return = $this->db->get()->result();
        $ci = &get_instance();
        $ci->_print($this->db->last_query());
        return $return;
    }
}

/* End of file tracking_model.php */
/* Location: ./application/models/tracking_model.php */