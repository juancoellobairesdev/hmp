<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends MY_Model {
    protected $d = 'refDistricts';
    protected $s = 'schools';
    protected $u = 'users';
    protected $t = 'teachers';
    protected $r = 'refResources';
    protected $c = 'refResourceCategories';
    protected $tc = 'trackingEntry';
    protected $tcr = 'trackingResources';

    public function __construct(){
        parent::__construct();
    }

    public function get_years($any = FALSE){
        $years = array();
        for($i=date('Y');$i>2000;$i--){
            $years[] = $i;
        }

        return $years;
    }

    public function get_months($year = FALSE, $any = FALSE){
        $months = array();

        $current_year = date('Y');
        $current_month = date('m');

        if(!$year){
            $year = $current_year;
            if($current_month < 8){
                $year--;
            }
        }
        for($i=0;$i<12;$i++){
            $month = $i > 4? $i - 4: $i + 8;
            $months[$month] = Misc_helper::str_month($month);
        }

        if($any && count($months) > 1){
            $temp = array(0 => 'Any');
            $months = array_merge($temp, $months);
        }

        return $months;
    }

    public function get_all_months($any = FALSE){
        return $this->get_months(2000, $any);
    }

    public function get_grades($any = FALSE){
        $grades = array();
        if($any){
            $grades[''] = 'Any';
        }

        return array_merge($grades, $this->grades());
    }

    public function get_cohorts($any = FALSE){
        $cohorts = array();
        if($any){
            $cohorts[0] = 'Any';
        }

        return array_merge($cohorts, $this->cohorts());
    }

    public function init_report_object_by_teacher(){
            $object = new stdClass();
            $object->minutesPerUse = 0;
            $object->timesUsed = 0;
            $object->maximumUsesPerMonth = 0;
            $object->minutesUsed = 0;
            $object->totalPossibleTime = 0;

            return $object;
    }

    public function sum_report_objects_by_teacher($sum1, $sum2 = FALSE){
        $sum = new stdClass();
        if(!$sum2){
            $sum2 = $this->_init_object_by_teacher();
        }

        $sum->minutesPerUse = $sum1->minutesPerUse + $sum2->minutesPerUse;
        $sum->timesUsed = $sum1->timesUsed + $sum2->timesUsed;
        $sum->maximumUsesPerMonth = $sum1->maximumUsesPerMonth + $sum2->maximumUsesPerMonth;
        $sum->minutesUsed = $sum1->minutesUsed + $sum2->minutesUsed;
        $sum->totalPossibleTime = $sum1->totalPossibleTime + $sum2->totalPossibleTime;
        

        return $sum;
    }

    public function init_report_object_by_school(){
            $object = new stdClass();
            $object->students = 0;
            $object->teacherUsage = 0;
            $object->totalTimeMinutes = 0;
            $object->actualTime = 0;
            $object->studentUsage = 0;

            return $object;
    }

    public function sum_report_objects_by_school($sum1, $sum2 = FALSE){
        $sum = new stdClass();
        if(!$sum2){
            $sum2 = $this->_init_object_by_teacher();
        }

        $sum->students = $sum1->students + $sum2->students;
        $sum->teacherUsage = $sum1->teacherUsage + $sum2->teacherUsage;
        $sum->totalTimeMinutes = $sum1->totalTimeMinutes + $sum2->totalTimeMinutes;
        $sum->actualTime = $sum1->actualTime + $sum2->actualTime;
        $sum->studentUsage = $sum1->studentUsage + $sum2->studentUsage;
        

        return $sum;
    }

    public function init_report_object_by_resource(){
            $object = new stdClass();
            $object->students = 0;
            $object->teacherUsage = 0;
            $object->studentUsage = 0;
            $object->minutesOfInstruction = 0;

            return $object;
    }

    public function sum_report_objects_by_resource($sum1, $sum2 = FALSE){
        $sum = new stdClass();
        if(!$sum2){
            $sum2 = $this->_init_object_by_teacher();
        }

        $sum->students = $sum1->students + $sum2->students;
        $sum->teacherUsage = $sum1->teacherUsage + $sum2->teacherUsage;
        $sum->studentUsage = $sum1->studentUsage + $sum2->studentUsage;
        $sum->minutesOfInstruction = $sum1->minutesOfInstruction + $sum2->minutesOfInstruction;
        

        return $sum;
    }
}

/* End of file report_model.php */
/* Location: ./application/models/report_model.php */