<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu{
    private $ci;
    private $menu;
    private $controllers;
    private $role;

    public function __construct(){
        $this->ci = &get_instance();
        $this->controllers = $this->ci->auth->get_controllers();
        $this->role = $this->ci->session->userdata('role');
        $this->_set_menu();
    }

    private function _set_menu(){
        //$registration = $this->_get_element('Registration', 'school', 'add_form');
        
        //$home = $this->_get_element('Home', 'home');
        $school = $this->_get_element('Schools');
        //$school->childs[] = $this->_get_element('Register', 'school', 'add_form');
        $school->childs[] = $this->_get_element('List', 'school', 'show_list');
        $school->childs[] = $this->_get_element('Edit', 'school', 'edit');


        $resource = $this->_get_element('Resources');
        $resource->childs[] = $this->_get_element('List', 'resource', 'show_list');
        $resource->childs[] = $this->_get_element('Add Resource', 'resource', 'add_form');

        $category = $this->_get_element('Categories');
        $category->childs[] = $this->_get_element('List', 'category', 'show_list');
        $category->childs[] = $this->_get_element('Add Category', 'category', 'add_form');

        $report = $this->_get_element('Reports');
        $report->childs[] = $this->_get_element('By Teacher', 'report', 'by_teacher');
        $report->childs[] = $this->_get_element('By School', 'report', 'by_school');
        $report->childs[] = $this->_get_element('By Resource', 'report', 'by_resource');

        $tracking = $this->_get_element('Track Resources');
        $tracking->childs[] = $this->_get_element('Enter Tracking', 'tracking', 'enter');
        $tracking->childs[] = $this->_get_element('Verify Trackings', 'tracking', 'unverified');

        $user = $this->_get_element('User');
        $user->childs[] = $this->_get_element('Logout', 'user', 'logout');
        $user->childs[] = $this->_get_element('Change password', 'user', 'change_password_form');

        $login = $this->_get_element('Login', 'user', 'login_form');

        $menu = array(
            //$home,
            //$registration,
            $school,
            $tracking,
            $resource,
            $category,
            $report,
            $user,
            $login
        );

        $this->menu = $this->_clean_menu($menu);
    }

    private function _clean_menu($menu){
        $new_menu = array();
        foreach($menu as $element){
            if($this->_is_valid_element($element)){
                $new_element = clone $element;
                $new_element->childs = $this->_clean_menu($new_element->childs);
                $new_menu[] = $new_element;
            }
        }

        return $new_menu;
    }

    private function _is_valid_element($element){
        $valid = FALSE;

        if($element){
            if($element->controller){
                $valid = TRUE;
            }
            else{
                foreach($element->childs as $child){
                    $valid = $valid || $this->_is_valid_element($child);
                }
            }
        }

        return $valid;
    }

    private function _get_element($text, $controller = '', $method = ''){
        $element = FALSE;
        $role = $this->role;
        if($this->ci->auth->have_access($controller, $method, $role)){
            $element = new stdClass();
            $element->text = $text;
            $element->controller = $controller;
            $element->method = $method;
            $element->href = $controller? config_item('base_url') . $controller . '/' . $method: '#';
            $element->childs = array();
        }

        return $element;
    }

    private function _method_exists($controller, $method){
        return in_array($method, $this->controllers->$controller);
    }

    public function get_menu(){
        return $this->menu;
    }

    static function menu_to_html($menu, $source = TRUE){
        $class = $source? 'menu': '';
        $html = "<ul class='{$class}'>\n\t";
        foreach($menu as $element){
            $html .= "<li><a href='{$element->href}'>{$element->text}</a>\n";
            $html .= self::menu_to_html($element->childs, FALSE);
            $html .= '</li>';
        }

        $html .= '</ul>';

        return $html;
    }
}

/* End of file Menu.php */
/* Location: ./application/library/Menu.php */