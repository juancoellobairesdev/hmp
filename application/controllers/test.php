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

    public function create_user(){
        $user = new stdClass();
        $user->name = 'Chiforimpulo';
        $user->email = 'chif@rimpu.lo';
        $user->role = User_model::$ROLE_S;
        $user->salt = hash('sha512', microtime());
        $user->password = Misc_helper::pbkdf2('sha512', 'asd', $user->salt, '1024', '64');

        $this->_print($this->user_model->insert($user));
        $this->_print($user);
    }
}

/* End of file test.php */
/* Location: ./application/controllers/test.php */