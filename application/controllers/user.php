<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {
    public function __construct(){
        parent::__construct();
    }

    public function login_form($email = '', $errors = array()){
        $this->session->unset_userdata('userId', 1);
        $params['email'] = $email;
        $params['errors'] = $errors;
        $this->template('user/login_form', $params);
    }

    public function login(){
        $accounts = array();
        $errors = array();

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if($users = $this->user_model->get_by_email($email)){
            foreach($users as $user){
                $encrypted = Misc_helper::encrypt_password($password, $user->salt);
                if($user->password == $encrypted){
                    $accounts[] = $user;
                }
            }
        }

        if(!$accounts){
            $errors[] = 'Invalid email and/or password.';
            $this->login_form($email, $errors);
        }
        else{
            if(count($accounts) == 1){

                // User logs fine
                $user = $accounts[0];
                $this->session->set_userdata('user', $user);
                $this->session->set_userdata('userId', $user->id);
                $this->session->set_userdata('role', $user->role);
                if($teacher = $this->teacher_model->get_by_user($user->id)){
                    $this->session->set_userdata('teacher', $teacher);
                    $this->session->set_userdata('teacherId', $teacher->id);
                }

                $this->_login_success($user);
            }
            else{

                // User can't be determined univocally
                $this->_login_success();
            }
        }
    }

    private function _login_success($user = FALSE){
        if(!$user || !is_object($user) || !isset($user->id) || $user->id != $this->session->userdata('userId')){
            $params['timeout'] = 0;
            $params['message'] = "We can't detect your user account, please contact HMP Staff in order to login.";
            //$this->redirect(config_item('base_url'), array($this->session->userdata('session_id')));
        }
        else{
            $params['message'] = "Welcome {$user->name}. Thank you for loging in.";
        }

        $params['user'] = $user;
        $params['redirect_url'] = config_item('base_url');
        $this->template('messages', $params);
    }

    public function logout(){
        $this->session->unset_userdata('user');
        $this->session->unset_userdata('userId');
        $this->session->unset_userdata('teacher');
        $this->session->unset_userdata('teacherId');
        $this->session->unset_userdata('role');

        $params['redirect_url'] = config_item('base_url');
        $params['message'] = "We are sad to see you leave. Please como again soon.";

        $this->template('messages', $params);
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
                    $this->template('messages', $params);

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
        $params['schools'] = $this->school_model->get_all_approved();
        $params['gradeLevels'] = $this->teacher_model->gradeLevels();
        $this->template('user/forgot_password_form', $params);
    }

    public function forgot_password(){
        $errors = array();
        $email = $this->input->post('email');
        $schoolId = $this->input->post('school');
        $is_teacher = $this->input->post('iAmTeacher');
        $gradeLevel = $this->input->post('gradeLevel');

        if($users = $this->user_model->get_forgot_password_users($email, $schoolId, $is_teacher, $gradeLevel)){
            if(count($users) == 1){
                $user = $users[0];

                $user->securityCode = md5($user->email . $user->salt . microtime(TRUE));

                if($this->user_model->update($user->id, $user)){
                    $params['user'] = $user;
                    $this->email->from('noreply@hmp.com','HealthMPowers');
                    $this->email->to($user->email);
                    $this->email->subject('Password reset');
                    $this->email->message($this->load->view('user/forgot_password_mail', $params, TRUE));

                    if($this->email->send()){
                        $params['message'] = "A link has been sent to the given email. Please follow the instructions there to reset the current password.";
                        $this->template('messages', $params);
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
                $errors[] = 'We couldn\'t determine your account. Please contact HMP Staff.';
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
                        $this->template('messages', $params);
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