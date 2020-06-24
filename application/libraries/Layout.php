<?php

/*
 * @Author: Himansu S
 * @Desc: Implement Layout mechanism in codeigniter
 * @Create Date:26th Mar 2015
 * @Last Update:Himansu S
 * @Updated By:26th Mar 2015
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Layout {

    //set the data to be passed to view
    public $data = array();
    //set the view name to be loaded
    public $view = null;
    //set the view path
    public $viewFolder = null;
    //set the layout name
    public $layout = 'default';
    //set the layout path
    public $layoutsFolder = 'layouts/default';
    public $errorLayoutsFolder = 'errors/app_error/';
    //set page the title
    public $title = '';
    public $menuFlag = true;
    public $headerFlag = true;
    public $siteMap=FALSE;
    public $footerFlag = true; 
    public $navTitleFlag=1;
    public $breadcrumbsFlag=1;
    public $navTitle='';
    public $navSlider=FALSE;
    var $obj;
    
    public $param;
    
    function __construct() {
        $this->obj = & get_instance();
    }

    /**
     * @Param string $name <br/><p> 
     * set required variable for layout file</p>
     * @Param any type  $value <br/><p>
     * set required variable value</p>
     * @desc set the dynamci variable, which help to declare layout specific variables
     */
    public function __set($name, $value) {
        $this->param[$name] = $value;
    }

   /**
     * @Param string $name <br/><p> 
     * get required variable for layout file</p>
     * @Param any type  $value <br/><p>
     * get required variable value</p>
     * @desc get the layout specific variables
     */
    public function __get($name) {
        
        if (array_key_exists($name, $this->param)) {
            return $this->param[$name];
        }
        return null;
    }

    /**
     * @Param string $layoutFolder <br/><p> 
     * set the layout folder name default is '/views/layout'</p>
     * @Param string $layout <br/><p>
     * set the layout name default name is 'default'</p>
     * @desc Set the custom layout directory path and layout name
     */
    function setLayout($layoutFolder = null, $layout = null) {
        if ($layoutFolder) {
            $this->layoutsFolder = $layoutFolder;
        }
        if ($layout) {
            $this->layout = $layout;
        }
    }

    /**
     * @Param string $viewFolder <br/><p> 
     * set the custom view directory name, default directory path is 'views/same-as-controller name directory'</p>
     * @Param string $view <br/><p>
     * set the custom view name default name is same as action name.</p>
     * @desc Set the custom view path and view name
     */
    function setView($viewFolder = null, $view = null) {
        if ($viewFolder) {
            $this->viewFolder = $viewFolder;
        }
        if ($view) {
            $this->view = $view;
        }
    }

    /**
     * @Param array $param <br/><p> 
     * set the custom view,layout and data that suppose to pass to the view object<br/>
     * $param['view']='view_directory_name/view_name'<br/>
     * $param['data']=$variable_name<br/>
     * $param['layout']='layout_directory_name/layout_name'<br/></p>   
     * $return_view=TRUE/FALSE<br/></p>  
     * @desc used to render the specified view.
     */
    function render($param = null,$return_view=FALSE) {
        $controller = strtolower($this->obj->router->fetch_class());
        $method = $this->obj->router->fetch_method();
        $viewFolder = !($this->viewFolder) ? $controller : $this->viewFolder . '/' . $controller;
        $view = !($this->view) ? $method : $this->view;
        $loadView = '/' . $viewFolder . '/' . $view;

        $loadLayout = $this->layoutsFolder . '/' . $this->layout;
        $loadedData = array();
        if (is_array($param)) {
            if (array_key_exists('view', $param)) {
                $loadView = $param['view'];
            }
            if (array_key_exists('data', $param)) {
                $this->data = $param['data'];
            }
            if (array_key_exists('layout', $param)) {
                $loadLayout = $param['layout'];
            }
            if (array_key_exists('error', $param)) {
                $loadView = $this->layoutsFolder.'/app_error/'.$param['error'];
            }
        }
        //return the view for ajax operation
        if($return_view===TRUE){
            return $this->obj->load->view($loadView, $this->data, true);
        }
        $loadedData['content'] = $this->obj->load->view($loadView, $this->data, true);
        $loadedData['data'] = $this->data;
        $this->obj->load->view($loadLayout, $loadedData);
    }

}
