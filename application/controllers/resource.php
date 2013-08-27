<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resource extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('resource_model');
    }

    public function show_list($page = 1){
        $params = array();

        $params['pagination'] = Misc_helper::pagination($page, 'resource_model');
        $this->template('resource/show_list', $params);
    }

    public function get_page(){
        $page = $this->input->post('page');
        $resources = $this->resource_model->getAll($page);
        $categories = $this->category_model->getAllIndexed();
        foreach($resources as &$resource){
            $resource->categoryName = $categories[$resource->categoryId]->name;
        }

        $params['resources'] = $resources;
        $params['categories'] = $categories;

        $this->load->view('resource/get_page', $params);
    }

    public function add_form(){
        $this->session->set_userdata('resourceSaveId', NULL);
        $this->_form();
    }

    public function edit_form($id = NULL){
        $this->session->set_userdata('resourceSaveId', $id);
        $this->_form($id);
    }

    private function _form($id = NULL){
        if(!($resource = $this->resource_model->get($id))){
            $resource = $this->resource_model->fields();
        }

        $params['grades'] = $this->category_model->grades();
        $params['categories'] = $this->category_model->getAllIndexed();
        $params['resource'] = $resource;
        $this->template('resource/form', $params);
    }

    public function save(){
        $errors = array();
        $id = FALSE;

        $resource = (object) $this->input->post('resource');

        //Null means insert, an integer means edit that resourceId
        $idToSave = $this->session->userdata('resourceSaveId');

        if(!$idToSave){ //Insert
            unset($resource->id);

            if(!($errors = $this->resource_model->has_errors($resource))){
                $id = $this->resource_model->insert($resource);
            }
        }
        elseif(isset($resource->id) && ($resource->id == $idToSave)){ //Edit
            if(!($errors = $this->resource_model->has_errors($resource))){
                $id = $this->resource_model->update($resource->id, $resource)? $resource->id: FALSE;
            }
        }
        else{ //Error
            $errors[] = 'Invalid resource.';
        }

        $data = new stdClass();
        $data->errors = $errors;
        $data->id = $id;

        $this->session->unset_userdata('resourceSaveId');

        echo json_encode($data);
    }


}

/* End of file resource.php */
/* Location: ./application/controllers/resource.php */