<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends MY_Model {
    protected $table = 'refResourceCategories';

    public function __construct(){
        parent::__construct();
    }

    public function has_errors($object){
        $errors = array();

        if(!isset($object->minCohort) || !array_key_exists($object->minCohort, $this->cohorts())){
            $errors[] = 'Invalid Minimum Cohort';
        }

        if(!isset($object->maxCohort) || !array_key_exists($object->maxCohort, $this->cohorts())){
            $errors[] = 'Invalid Maximum Cohort';
        }

        if(isset($object->minCohort) && isset($object->maxCohort) && array_key_exists($object->minCohort, $this->cohorts()) && array_key_exists($object->maxCohort, $this->cohorts()) && $object->maxCohort < $object->minCohort){
            $errors[] = 'Maximum Cohort can\'t be lower than Minimum Cohort.';
        }

        if(!isset($object->weight) || ($object->weight != '0' && !intval($object->weight))){
            $errors[] = 'Invalid value for "Weight". It must be an integer.';
        }

        return $errors;
    }
}

/* End of file category_model.php */
/* Location: ./application/models/category_model.php */