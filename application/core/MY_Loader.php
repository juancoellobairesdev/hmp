<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Loader extends CI_Loader
{
    public $render = "";
    public $title;
    public $description;
    public $dataModel = FALSE;
    
    public function __construct()
    {
        parent::__construct();

        $this->title = $this->config('site_title');
        $this->description = $this->config('site_description');
    }

    public function render()
    {
        echo $this->render;
    }

    public function title()
    {
        echo $this->title;
    }
    
    public function description()
    {
        echo $this->description;
    }

    public function config($name)
    {
        return config_item($name);
    }

    public function view($view, $vars = array(), $return = FALSE)
    {
        $vars = $this->_ci_object_to_array($vars);

        $vars['basePath'] = config_item('base_path');
        $vars['viewsPath'] = $vars['basePath'] . "application/views/";

        $vars['baseUrl'] = config_item('base_url');
        $vars['imagesUrl'] = $vars['baseUrl'] . "images/";
        $vars['scriptsUrl'] = $vars['baseUrl'] . "scripts/";
        $vars['stylesUrl'] = $vars['baseUrl'] . "styles/";

        $ci =& get_instance();
        
        return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $vars, '_ci_return' => $return));
    }

    public function setDataModel($dataModel)
    {
        $this->dataModel = $dataModel;
    }

    public function model($model, $dataModel = FALSE)
    {
        if (is_array($model))
        {
            foreach ($model as $babe)
            {
                $this->model($babe);
            }
            return;
        }

        if($dataModel)
        {
            parent::model("{$dataModel}/{$model}");
        }
        elseif($this->dataModel)
        {
            parent::model("{$this->dataModel}/{$model}");
        }
        else
        {
            parent::model($model);
        }
    }
    
}


/* End of file MY_Loader.php */
/* Location: core/MY_Loader.php */