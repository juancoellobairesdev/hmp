<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends MY_Model {
    protected $table = 'users';

    public function __construct(){
        parent::__construct();
    }
}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */