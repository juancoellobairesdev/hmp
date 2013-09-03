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
            /*
            if($year == $current_year && $month > $current_month){
                break;
            }
            else{
                $year_by_month = $month<8? $year - 1: $year;
                $months[$month] = Misc_helper::str_month($month) . ' ' . $year_by_month;
            }
            */
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
            $cohorts[''] = 'Any';
        }

        return array_merge($cohorts, $this->cohorts());
    }
}

/* End of file report_model.php */
/* Location: ./application/models/report_model.php */