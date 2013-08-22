<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {
    public function login_form(){
        $this->template('user/login_form');
    }

    public function login(){
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->session->set_userdata('asd', $email . ' - ' . $password);
        echo $this->session->userdata('asd');
    }

    public function forgot_form(){
        $this->template('user/forgot_form');
    }

    public function forgot(){
        $this->email->from('juan.coello@bairesdev.com','Juan');
        $this->email->to('juan.coello@bairesdev.com');
        $this->email->subject('Hola hola perinola');
        $this->email->message('Un mensaje bonito bonito');
        echo "Me olvidao";
        /*
        try{
            var_dump($this->email->send());
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        */
        

    }
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */