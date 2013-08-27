<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
        return $this->_get_by_email($email)->result();
    }

    public function get_by_emails($emails){
        return $this->_get_by_email($emails)->result();
    }

    public function get_forgot_password_users($email, $schoolId, $is_teacher = FALSE, $gradeLevel = FALSE){
        if($is_teacher){
            $sql .= "
                SELECT u.*
                FROM users AS u
                INNER JOIN teachers AS t
                    ON u.id = t.userId
                WHERE id = ?
                AND t.gradeLevel = ?
            ";

            $query =  $this->db->query($sql, array($schoolId, $gradeLevel));
        }
        else{
            $sql = "
                SELECT u.*
                FROM schools AS s
                INNER JOIN users AS u
                    ON s.administratorUserId = u.id
                    OR s.verifierUserId = u.id
                WHERE s.id = ?
                AND u.email like ?
            ";

            $query = $this->db->query($sql, array($schoolId, $email));
        }

        return $query->result();
    }

    public function _print($obj){
        echo '<pre>';
        print_r($obj);
        echo '</pre>';
    }
}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */