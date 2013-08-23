<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
    }

    public function login_form($email = '', $errors = array()){
        $this->session->unset_userdata('userId', 1);
        $params['email'] = $email;
        $params['errors'] = $errors;
        $this->template('user/login_form', $params);
    }

    public function login(){
        $invalid = TRUE;
        $errors = array();

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if($user = $this->user_model->get_by_email($email)){
            $encrypted = Misc_helper::encrypt_password($password, $user->salt);
            if($user->password == $encrypted){
                $invalid = FALSE;
                $this->session->set_userdata('user', $user);
                $this->session->set_userdata('userId', $user->id);
                $this->_login_success($user);
            }
        }

        if($invalid){
            $errors[] = 'Invalid email and/or password.';
            $this->login_form($email, $errors);
        }
    }

    private function _login_success($user = FALSE){
        if(!$user || !is_object($user) || !isset($user->id) || $user->id != $this->session->userdata('userId')){
            $this->redirect(config_item('base_url'), array($this->session->userdata('session_id')));
        }
        else{
            $params['user'] = $user;
            $params['redirect_url'] = config_item('base_url');
            $params['message'] = "Welcome {$user->name}. Thank you for loging in.";
            $this->template('user/messages', $params);
        }
    }

    public function logout(){
        $this->session->unset_userdata('user');
        $this->session->unset_userdata('userId');

        $params['redirect_url'] = config_item('base_url');
        $params['message'] = "We are sad to see you leave. Please como again soon.";

        $this->template('user/messages', $params);
    }

    public function change_password_form($errors = array()){
        $params['errors'] = $errors;
        $this->template('user/change_password_form', $params);
    }

    public function change_password(){
        $errors = array();

        $password = $this->input->post('password');
        $new_password = $this->input->post('newPassword');

        // Session exists
        if($user = $this->session->userdata('user')){
            $encrypted = Misc_helper::encrypt_password($password, $user->salt);

            // Current password ok
            if($user->password == $encrypted){
                $user->password = Misc_helper::encrypt_password($new_password, $user->salt);;

                // Update user
                if($this->user_model->update($user->id, $user)){

                    $this->session->unset_userdata('user');
                    $this->session->set_userdata('user', $user);

                    $params['redirect_url'] = config_item('base_url');
                    $params['message'] = "We are sad to see you leave. Please como again soon.";
                    $this->template('user/messages', $params);

                    return;
                }
                else{
                    $errors[] = 'Unable to update password.';
                }
            }
            else{
                $errors[] = 'Invalid current password.';
            }
        }
        else{
            $errors[] = 'No user logged in.';
        }

        $this->change_form($errors);
    }

    public function forgot_password_form($errors = array()){
        $params['errors'] = $errors;
        $this->template('user/forgot_password_form');
    }

    public function forgot_password(){
        $errors = array();
        $email = $this->input->post('email');

        if($user = $this->user_model->get_by_email($email)){
            $user->securityCode = md5($user->email . $user->salt . microtime(TRUE));
            if($this->user_model->update($user->id, $user)){
                $params['user'] = $user;
                $this->email->from('noreply@hmp.com','HealthMPowers');
                $this->email->to($user->email);
                $this->email->subject('Password reset');
                $this->email->message($this->load->view('user/forgot_password_mail', $params, TRUE));

                if($this->email->send()){
                    $params['message'] = "A link has been sent to the given email. Please follow the instructions there to reset the current password.";
                    $this->template('user/messages', $params);
                    return;
                }
                else{
                    $errors[] = 'Unable to send mail.';
                }
            }
            else{
                $errors[] = 'Unable to complete process.';
            }
        }
        else{
            $errors[] = 'Invalid email.';
        }

        $this->forgot_password_form($errors);
    }

    public function reset_password($userId = FALSE, $security_code = FALSE){
        if($user = $this->user_model->get($userId)){
            $this->_print($user);
            if($user->securityCode == $security_code){
                $raw_password = Misc_helper::random_password();
                $user->securityCode = NULL;
                $user->password = Misc_helper::encrypt_password($raw_password, $user->salt);
                if($this->user_model->update($user->id, $user)){
                    $params['user'] = $user;
                    $this->email->from('noreply@hmp.com','HealthMPowers');
                    $this->email->to($user->email);
                    $this->email->subject('Password successfuly reseted');
                    $this->email->message($this->load->view('user/reset_password_mail', $params, TRUE));

                    if($this->email->send()){
                        $params['message'] = "The new password has been sent to your email. We recommend you to change it as soon as possible. {$raw_password}";
                        $this->template('user/messages', $params);
                        return;
                    }
                    else{
                        $errors[] = 'Unable to send mail.'; // Need to improve this
                    }
                }
                else{
                    $errors[] = 'Unable to reset password.';
                }
            }
            else{
                $errors[] = 'Invalid code.';
            }
        }
        else{
            $errors[] = 'Invalid user.';
        }
    }
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */