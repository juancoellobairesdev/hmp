<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('teacher_model');
        $this->load->model('school_model');
        $this->load->model('district_model');
        $this->load->model('user_model');
        $this->load->helper('url');
        $this->load->library('user_agent');
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

    public function dates(){
        $date1 = '6:13 AM';
        $date2 = '5.15pm';
        $date3 = '3,12';

        $date11 = new DateTime($date1);
        $date22 = new DateTime($date2);
        //$date33 = new DateTime($date3);

        $this->_print(Misc_helper::parse_time($date1));
        $this->_print(Misc_helper::parse_time($date2));
        //$this->_print($date33);
    }

    public function maver($int = 1){
        $date = new DateTime('First monday of November 2013');
        $date->add(new DateInterval('P1W'));
        $now = new DateTime();

        $this->_print($date);
        $this->_print($now);

        $this->_print($date < $now);
    }

    public function a(){
        $this->_print(current_url());
        $this->_print($_SERVER['HTTP_REFERER']);
        $this->_print($this->agent->referrer());
    }

    public function change_password($userId, $password){
        $user = $this->user_model->get($userId);
        $user->password = Misc_helper::encrypt_password($password, $user->salt);

        if($this->user_model->update($user->id, $user)){
            $this->_print($this->user_model->get($userId));
        }
        else{
            $this->_print('Nain!');
        }
    }

    public function get_teacher_full($id = 1){
        $this->_print($this->teacher_model->get_full($id));
    }

    public function get_teachers_full_by_school($id = 1){
        $this->_print($this->teacher_model->get_full_by_school($id));
    }

    public function get_users(){
        $this->_print($this->user_model->getAll());
    }

    public function get_teachers(){
        $this->_print($this->teacher_model->getAll());
    }
}

/* End of file test.php */
/* Location: ./application/controllers/test.php */