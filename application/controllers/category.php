<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('category_model');
    }

    public function show_list($page = 1){
        $params = array();

        $params['pagination'] = Misc_helper::pagination($page, 'category_model');
        $this->template('category/show_list', $params);
    }

    public function get_page(){
        $page = $this->input->post('page');
        $categories = $this->category_model->getAll($page);

        $params['categories'] = $categories;

        $this->load->view('category/get_page', $params);
    }

    public function add_form(){
        $this->session->unset_userdata('categorySaveId');
        $this->_form();
    }

    public function edit_form($id = NULL){
        $this->session->set_userdata('categorySaveId', $id);
        $this->_form($id);
    }

    private function _form($id = NULL){
        if(!($category = $this->category_model->get($id))){
            $category = $this->category_model->fields();
        }

        $params['category'] = $category;
        $params['cohorts'] = $this->category_model->cohorts();
        $this->template('category/form', $params);
    }

    public function save(){
        $errors = array();
        $id = FALSE;

        $category = (object) $this->input->post('category');

        //Null means insert, an integer means edit that categoryId
        $idToSave = $this->session->userdata('categorySaveId');

        if(!$idToSave){ //Insert
            unset($category->id);

            if(!($errors = $this->category_model->has_errors($category))){
                $id = $this->category_model->insert($category);
            }
        }
        elseif(isset($category->id) && ($category->id == $idToSave)){ //Edit
            if(!($errors = $this->category_model->has_errors($category))){
                $id = $this->category_model->update($category->id, $category)? $category->id: FALSE;
            }
        }
        else{ //Error
            $errors[] = 'Invalid category.';
        }

        $data = new stdClass();
        $data->errors = $errors;
        $data->id = $id;

        $this->session->unset_userdata('categorySaveId');

        echo json_encode($data);
    }
}

/* End of file category.php */
/* Location: ./application/controllers/category.php */