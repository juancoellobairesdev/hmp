<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resource_model extends MY_Model {
    protected $table = 'refResources';

    public function __construct(){
        parent::__construct();
        $this->load->model('category_model');
    }

    public function get_for_poster($gradeLevel, $startingSchoolYear, $categoryId = FALSE){
        $cohort = date('Y') - $startingSchoolYear + 1;
        $this->db->select('r.id, r.title, r.maximumUsesPerYear, c.id AS categoryId, c.name');
        $this->db->from("{$this->table} AS r");
        $this->db->join('refResourceCategories AS c', 'r.categoryId = c.id', 'inner');
        $this->db->where('c.minCohort <=', $cohort);
        $this->db->where('c.maxCohort >=', $cohort);
        $this->db->where('r.minGrade >=', $gradeLevel);
        $this->db->where('r.maxGrade <=', $gradeLevel);
        $this->db->where('r.enabled', TRUE);
        if($categoryId){
            $this->db->where('r.categoryId', $categoryId);
        }
        $this->db->order_by('r.categoryId', 'asc');
        $this->db->order_by('r.weight', 'asc');

        return $this->db->get()->result();
    }

    public function has_errors($resource){
        $errors = array();

        $categories = $this->category_model->getAllIndexed();
        if(!isset($resource->categoryId) || !array_key_exists($resource->categoryId, $categories)){
            $errors[] = 'Invalid category.';
        }

        if(!isset($resource->minutesPerUse) || (intval($resource->minutesPerUse) < 1)){
            $errors[] = 'Invalid value for "Minutes Per Use". It must be an integer greater than 0.';
        }

        if(!isset($resource->maximumUsesPerYear) || (intval($resource->maximumUsesPerYear) < 1)){
            $errors[] = 'Invalid value for "Maximum Uses Per Year". It must be an integer greater than 0.';
        }

        if(!isset($resource->nutrition) || ($resource->nutrition != 0 && $resource->nutrition != 1)){
            $errors[] = 'Invalid Nutrition.';
        }

        if(!isset($resource->minGrade) || !array_key_exists($resource->minGrade, $this->grades())){
            $errors[] = 'Invalid Minimum Grade';
        }

        if(!isset($resource->maxGrade) || !array_key_exists($resource->maxGrade, $this->grades())){
            $errors[] = 'Invalid Maximum Grade';
        }

        if(isset($resource->minGrade) && isset($resource->maxGrade) && array_key_exists($resource->minGrade, $this->grades()) && array_key_exists($resource->maxGrade, $this->grades()) && $resource->maxGrade < $resource->minGrade){
            $errors[] = 'Max Grade can\'t be lower than Min Grade.';
        }

        if(!isset($resource->enabled) || ($resource->enabled != 0 && $resource->enabled != 1)){
            $errors[] = 'Invalid value for "Enabled".';
        }

        if(!isset($resource->weight) || ($resource->weight != '0' && !intval($resource->weight))){
            $errors[] = 'Invalid value for "Weight". It must be an integer.';
        }

        return $errors;
    }
}

/* End of file resource_model.php */
/* Location: ./application/models/resource_model.php */