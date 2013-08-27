<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!defined('PAGE_DEFAULT')){
    define('PAGE_DEFAULT', 1);
}
if(!defined('PAGE_SIZE_DEFAULT')){
    define('PAGE_SIZE_DEFAULT', 20);
}
if(!defined('PAGE_SIZE_MAX')){
    define('PAGE_SIZE_MAX', 50);
}
class MY_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
    }

    protected function _print($object, $return = FALSE){
        echo '<pre>';
        $printed = print_r($object, $return);
        echo '</pre>';

        return $printed;
    }

    public function template($view, $params = array()){
        $params['basePath'] = config_item('base_path');
        $params['viewsPath'] = $params['basePath'] . "application/views/";

        $params['baseUrl'] = config_item('base_url');
        $params['imagesUrl'] = $params['baseUrl'] . "images/";
        $params['scriptsUrl'] = $params['baseUrl'] . "scripts/";
        $params['stylesUrl'] = $params['baseUrl'] . "styles/";
        $params['redirect_url'] = config_item('base_url');
        
        $params['rendered_content'] = $this->load->view($view, $params, true);

        $this->load->view('templates/home', $params);
    }

    public function redirect($url = "", $params = array(), $get = true){
        if(count($params)){
            if($get){
                $url .= "?" . http_build_query($params);
            }
            else{
                if(strrpos($url,"/") != (strlen($url)-1)){
                   $url .= "/";
                }
                foreach($params as $key => $value){
                    if(!isset($bar)){
                        $bar = true;
                    }
                    else{
                        $url .= "/";
                    }

                    $url .= $value;
                }
            }
        }

        header("Location: $url", true, 302);
        exit;
    }}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */