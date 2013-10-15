<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth{
    private $ci;
    private $roles;
    private $controllers;
    private $access;

    public function __construct(){
        $this->ci = &get_instance();
        $this->_set_roles();
        $this->_set_controllers();
        $this->_set_access();
    }

    public function authenticate(){
        $role = $this->ci->session->userdata('role');
        $controller = $this->ci->uri->segment(1);
        $method = $this->ci->uri->segment(2);
        if(!$this->have_access($controller, $method, $role)){
            $this->redirect();
        }
    }

    public function have_access($controller, $method, $role = FALSE){
        $have_access = TRUE;
        if($controller && $method){
            $access = $this->access;
            if(isset($access->$controller->$method) && !empty($access->$controller->$method) && !in_array($role, $access->$controller->$method)){
                $have_access = FALSE;
            }
        }

        return $have_access;
    }

    public function redirect(){
        $this->ci->load->helper('url');
        $this->ci->load->library('user_agent');
        if(!$this->ci->input->is_ajax_request()){
            $params['redirect_url'] = $this->ci->agent->is_referral()? $this->ci->agent->referrer(): base_url();
            $params['message'] = 'You are not allowed to see this page.';
            $this->ci->template('messages', $params);
            $this->ci->output->_display();
            exit();
        }
        else{
            $this->ci->output->set_status_header('401'); // Unauthorized
        }
    }

    private function _set_roles(){
        $roles = new stdClass();
        $roles->n = FALSE;
        $roles->ss = User_model::$ROLE_S;
        $roles->sa = User_model::$ROLE_C;
        $roles->sv = User_model::$ROLE_V;
        $roles->ha = User_model::$ROLE_A;
        $roles->hs = User_model::$ROLE_H;
        $roles->st = User_model::$ROLE_T;

        $this->roles = $roles;
    }

    private function _get_all_roles(){
        $roles = array();
        foreach($this->roles as $role){
            if($role){
                $roles[] = $role;
            }
        }

        return $roles;
    }

    public function get_controllers(){
        return $this->controllers;
    }

    private function _set_controllers(){
        $home = array();

        $user = array();
        $user[] = 'login_form';
        $user[] = 'login';
        $user[] = 'logout';
        $user[] = 'change_password_form';
        $user[] = 'change_password';
        $user[] = 'forgot_password_form';
        $user[] = 'forgot_password';
        $user[] = 'reset_password';

        $school = array();
        $school[] = 'show_list';
        $school[] = 'get_page';
        $school[] = 'edit_form';
        $school[] = 'add_form';
        $school[] = 'edit';
        $school[] = 'save';
        $school[] = 'check_upload';

        $tracking = array();
        $tracking[] = 'enter';
        $tracking[] = 'get_resources';
        $tracking[] = 'submit_enter';
        $tracking[] = 'unverified';
        $tracking[] = 'get_trackings';
        $tracking[] = 'submit_unverified';

        $resource = array();
        $resource[] = 'show_list';
        $resource[] = 'get_page';
        $resource[] = 'edit_form';
        $resource[] = 'add_form';
        $resource[] = 'save';
        $resource[] = 'check_upload';

        $category = array();
        $category[] = 'show_list';
        $category[] = 'get_page';
        $category[] = 'edit_form';
        $category[] = 'add_form';
        $category[] = 'save';
        $category[] = 'check_upload';

        $report = array();
        $report[] = 'by_teacher';
        $report[] = 'by_school';
        $report[] = 'by_resource';

        $controllers = new stdClass();
        $controllers->home = $home;
        $controllers->user = $user;
        $controllers->school = $school;
        $controllers->tracking = $tracking;
        $controllers->resource = $resource;
        $controllers->category = $category;
        $controllers->report = $report;

        $this->controllers = $controllers;
    }

    private function _set_access(){
        $access = new stdClass();
        $controllers = clone $this->controllers;
        $roles = clone $this->roles;

        foreach($controllers as $controller => $methods){
            $controller_name = strval($controller);
            $access->$controller_name = new stdClass();
            foreach($methods as $method){
                $method_name = strval($method);
                $access->$controller_name->$method_name = array();
            }
        }
        
        $access->user->login_form[] = $roles->n;
        $access->user->change_password_form = $this->_get_all_roles();
        $access->user->change_password = $this->_get_all_roles();
        $access->user->logout = $this->_get_all_roles();

        $access->school->show_list[] = $roles->ha;
        $access->school->get_page = $access->school->show_list;

        //$access->school->add_form = $this->_get_all_roles();
        $access->school->edit_form[] = $roles->ha;
        $access->school->edit_form[] = $roles->sa;
        $access->school->edit[] = $roles->sa;

        $access->tracking->enter[] = $roles->ha;
        $access->tracking->enter[] = $roles->hs;
        $access->tracking->enter[] = $roles->st;
        $access->tracking->enter[] = $roles->sa;
        $access->tracking->get_resources = $access->tracking->enter;
        $access->tracking->submit_enter = $access->tracking->enter;

        $access->tracking->unverified[] = $roles->ha;
        $access->tracking->unverified[] = $roles->sv;
        $access->tracking->unverified[] = $roles->sa;
        $access->tracking->get_trackings = $access->tracking->unverified;
        $access->tracking->submit_unverified = $access->tracking->unverified;

        $access->report->by_teacher[] = $roles->ha;
        $access->report->by_teacher[] = $roles->hs;
        $access->report->by_teacher[] = $roles->sv;
        $access->report->by_teacher[] = $roles->ss;
        $access->report->by_school[] = $roles->ha;
        $access->report->by_school[] = $roles->hs;
        $access->report->by_resource[] = $roles->ha;
        $access->report->by_resource[] = $roles->hs;
        $access->report->by_resource[] = $roles->sv;
        $access->report->by_resource[] = $roles->ss;

        /*
        $access->report->by_teacher = $this->_get_all_roles();
        $access->report->by_school = $this->_get_all_roles();
        $access->report->by_resource = $this->_get_all_roles();
        */

        foreach($access->resource as $method => $array){
            $temp = array();
            $temp[] = $roles->ha;
            $access->resource->$method = $temp;
        }

        foreach($access->category as $method => $array){
            $temp = array();
            $temp[] = $roles->ha;
            $access->category->$method = $temp;
        }

        $this->access = $access;
    }
}

/* End of file Auth.php */
/* Location: ./application/library/Auth.php */