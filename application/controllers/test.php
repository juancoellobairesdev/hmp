<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('teacher_model');
        $this->load->model('school_model');
        $this->load->model('district_model');
        $this->load->model('user_model');
    }

    public function get_by_email($email = ''){
        $result = $this->user_model->gets_by_email($email);

        $this->_print($result);
    }
}

/* End of file test.php */
/* Location: ./application/controllers/test.php */