<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class School extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('school_model');
    }

    public function show_list($page = 1){
        $params = array();

        $params['pagination'] = Misc_helper::pagination($page, 'school_model');
        $this->template('school/show_list', $params);
    }

    public function get_page(){
        $page = $this->input->post('page');
        $schools = $this->school_model->getAll($page);

        $params['schools'] = $resources;

        $this->load->view('school/get_page', $params);
    }

    public function add_form(){
        $this->session->set_userdata('schoolSaveId', NULL);
        $this->_form();
    }

    public function edit_form($id = NULL){
        $this->session->set_userdata('schoolSaveId', $id);
        $this->_form($id);
    }

    private function _form($id = NULL){
        if(!($school = $this->school_model->get($id))){
            $school = $this->school_model->fields();
        }

        $params['grades'] = $this->school_model->grades();
        $params['school'] = $school;
        $this->template('school/form', $params);
    }

    public function save(){
        $errors = array();
        $id = FALSE;

        $school = (object) $this->input->post('school');

        //Null means insert, an integer means edit that resourceId
        $idToSave = $this->session->userdata('schoolSaveId');

        if(!$idToSave){ //Insert
            unset($school->id);

            if(!($errors = $this->school_model->has_errors($school))){
                $id = $this->school_model->insert($school);
            }
        }
        elseif(isset($school->id) && ($school->id == $idToSave)){ //Edit
            if(!($errors = $this->school_model->has_errors($school))){
                $id = $this->school_model->update($school->id, $school)? $school->id: FALSE;
            }
        }
        else{ //Error
            $errors[] = 'Invalid school.';
            $errors[] = json_encode($school);
            $errors[] = $idToSave;
        }

        $data = new stdClass();
        $data->errors = $errors;
        $data->id = $id;

        $this->session->unset_userdata('schoolSaveId');

        echo json_encode($data);
    }


}

/* End of file school.php */
/* Location: ./application/controllers/school.php */