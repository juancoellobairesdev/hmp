<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teacher extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('teacher_model');
    }

    public function show_list($page = 1){
        $params = array();

        $params['pagination'] = Misc_helper::pagination($page, 'teacher_model');
        $this->template('teacher/show_list', $params);
    }

    public function get_page(){
        $page = $this->input->post('page');
        $teachers = $this->teacher_model->getAll($page);

        $params['teachers'] = $resources;

        $this->load->view('teacher/get_page', $params);
    }

    public function add_form(){
        $this->session->set_userdata('teacherSaveId', NULL);
        $this->_form();
    }

    public function edit_form($id = NULL){
        $this->session->set_userdata('teacherSaveId', $id);
        $this->_form($id);
    }

    private function _form($id = NULL){
        if(!($teacher = $this->teacher_model->get($id))){
            $teacher = $this->teacher_model->fields();
        }

        $params['grades'] = $this->teacher_model->grades();
        $params['teacher'] = $teacher;
        $this->template('teacher/form', $params);
    }

    public function save(){
        $errors = array();
        $id = FALSE;

        $teacher = (object) $this->input->post('teacher');

        //Null means insert, an integer means edit that resourceId
        $idToSave = $this->session->userdata('teacherSaveId');

        if(!$idToSave){ //Insert
            unset($teacher->id);

            if(!($errors = $this->teacher_model->has_errors($teacher))){
                $id = $this->teacher_model->insert($teacher);
            }
        }
        elseif(isset($teacher->id) && ($teacher->id == $idToSave)){ //Edit
            if(!($errors = $this->teacher_model->has_errors($teacher))){
                $id = $this->teacher_model->update($teacher->id, $teacher)? $teacher->id: FALSE;
            }
        }
        else{ //Error
            $errors[] = 'Invalid teacher.';
        }

        $data = new stdClass();
        $data->errors = $errors;
        $data->id = $id;

        $this->session->unset_userdata('teacherSaveId');

        echo json_encode($data);
    }

}

/* End of file teacher.php */
/* Location: ./application/controllers/teacher.php */