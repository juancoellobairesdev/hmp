<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!defined('USER_ROLE_S')){
    define('USER_ROLE_S', 'Support Staff');
}

if(!defined('USER_ROLE_V')){
    define('USER_ROLE_V', 'Verification Designee');
}

if(!defined('USER_ROLE_A')){
    define('USER_ROLE_A', 'HMP Admin');
}

if(!defined('USER_ROLE_H')){
    define('USER_ROLE_H', 'HMP Staff');
}

if(!defined('USER_ROLE_T')){
    define('USER_ROLE_T', 'Teacher');
}

class User_model extends MY_Model {
    static $ROLE_S = 'Support Staff';
    static $ROLE_V = 'Verification Designee';
    static $ROLE_A = 'HMP Admin';
    static $ROLE_H = 'HMP Staff';
    static $ROLE_T = 'Teacher';

    protected $table = 'users';

    public function __construct(){
        parent::__construct();
    }

    private function _get_by_email($email){
        if(is_string($email)){
            $email = array($email);
        }
        if(!$email){
            $email = array('');
        }

        $this->db->select();
        $this->db->from($this->table);
        $this->db->where_in('email', $email);

        return $this->db->get();
    }

    public function get_by_email($email){
        return $this->_get_by_email($email)->row();
    }

    public function gets_by_email($emails){
        return $this->_get_by_email($emails)->result();
    }
}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */