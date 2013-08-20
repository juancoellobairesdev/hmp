<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resource_model extends MY_Model {
    protected $table = 'refResources';

    public function __construct(){
        parent::__construct();
        $this->load->model('category_model');
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

        if(!isset($resource->maximumUsesPerMonth) || (intval($resource->maximumUsesPerMonth) < 1)){
            $errors[] = 'Invalid value for "Maximum Uses Per Month". It must be an integer greater than 0.';
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