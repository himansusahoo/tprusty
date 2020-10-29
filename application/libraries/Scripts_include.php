<?php

/**
 * Description of Script_manage
 *
 * @author Himansu
 */
define('COMPONENT_PATH', '/asset/bower_components/');

define('COMPOSER_PATH', '/vendor/');
define('NODE_PATH', '/node_modules/');
define('ASSETS_PATH', '/assets/');
define('ADMIN_LTE_PATH', COMPOSER_PATH . 'almasaeed2010/adminlte/');

class Scripts_include {

    public $jsFiles = array('common');
    public $cssFiles = array('common');
    public $_inlineJs = array();
    private $_customJsfiles = array();
    private $_customCssfiles = array();
    private $_defaultModulePath;
    private $_CI;
    private $_layout = 'default';
    //layout js files
    private $_layoutJsFiles;
    //layout css files
    private $_layoutCssFiles;
    //plugin js files
    private $_appJsFiles;
    //plugin css files
    private $_appCssFiles;

    function __construct() {
        $this->_CI = &get_instance();
        $this->_setLayoutJsFiles();
        $this->_setLayoutCssFiles();
        $this->_setAppJsFiles();
        $this->_setAppCssFiles();
        $this->_defaultModulePath = 'application/modules/' . $this->_CI->router->fetch_module() . '/assets/';
    }

    private function _setLayoutJsFiles() {
        $this->_layoutJsFiles = array(
            'admin_lte' => array(
                'top' => array(
                    ADMIN_LTE_PATH . 'plugins/jquery/jquery.min.js',
                    ADMIN_LTE_PATH . 'plugins/jquery-ui/jquery-ui.min.js',
                ),
                'common' => array(
                    ADMIN_LTE_PATH . 'plugins/bootstrap/js/bootstrap.bundle.min.js',
                    ADMIN_LTE_PATH . 'plugins/moment/moment.min.js',
                    ADMIN_LTE_PATH . 'plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
                    ADMIN_LTE_PATH . 'dist/js/adminlte.js',
                    ADMIN_LTE_PATH . 'plugins/toastr/toastr.min.js',
                    NODE_PATH . 'downloadjs/download.min.js',
                    NODE_PATH . 'bootstrap4-dialog/dist/js/bootstrap-dialog.min.js',
                    ADMIN_LTE_PATH . 'dist/js/demo.js'
                ),
                'buttom' => array(
                    ASSETS_PATH.'js/messages.js',
                    ASSETS_PATH.'js/myapp.js'
                ),
            ),
            'admin_layout' => array(
                'top' => array(
                    COMPONENT_PATH . 'jquery/dist/jquery.min.js',
                    COMPONENT_PATH . 'jquery-ui/jquery-ui.min.js',
                ),
                'common' => array(
                    COMPONENT_PATH . 'bootstrap/dist/js/bootstrap.min.js',
                    COMPONENT_PATH . 'admin-lte/dist/js/adminlte.min.js',
                    COMPONENT_PATH . 'bootstrap3-dialog/src/js/bootstrap-dialog.js',
                    COMPONENT_PATH . 'downloadjs/download.min.js',
                    COMPONENT_PATH . 'jquery-slimscroll/jquery.slimscroll.min.js'
                ),
                'buttom' => array(
                    '/js/messages.js',
                    '/js/myapp.js'
                ),
            ),
            'blank_layout' => array(
                'top' => array(
                    ADMIN_LTE_PATH . 'plugins/jquery/jquery.min.js',
                    ADMIN_LTE_PATH . 'plugins/jquery-ui/jquery-ui.min.js',
                ),
                'common' => array(
                    ADMIN_LTE_PATH . 'plugins/bootstrap/js/bootstrap.bundle.min.js',
                    ADMIN_LTE_PATH . 'plugins/moment/moment.min.js',
                    ADMIN_LTE_PATH . 'plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
                    ADMIN_LTE_PATH . 'dist/js/adminlte.js',
                    ADMIN_LTE_PATH . 'plugins/toastr/toastr.min.js',
                    NODE_PATH . 'bootstrap4-dialog/dist/js/bootstrap-dialog.min.js'                    
                ),
                'buttom' => array(     
                    ASSETS_PATH.'js/messages.js',
                    ASSETS_PATH.'js/myapp.js'
                ),
            ),
            'default' => array(
                'top' => array(),
                'common' => array()
            )
        );
    }

    private function _setLayoutCssFiles() {
        $this->_layoutCssFiles = array(
            'admin_lte' => array(
                'common' => array(
                    ADMIN_LTE_PATH . 'plugins/fontawesome-free/css/all.min.css',
                    ADMIN_LTE_PATH . 'dist/css/adminlte.min.css',
                    ADMIN_LTE_PATH . 'plugins/icheck-bootstrap/icheck-bootstrap.min.css',
                    ASSETS_PATH . 'css/fonts/google_fonts/google_fonts.css',
                    ADMIN_LTE_PATH . 'plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
                    ADMIN_LTE_PATH . 'plugins/toastr/toastr.min.css',
                    ADMIN_LTE_PATH . 'plugins/jquery-ui/jquery-ui.min.css',
                    NODE_PATH . 'bootstrap4-dialog/dist/css/bootstrap-dialog.min.css',
                    ASSETS_PATH . 'css/wrapper_datatable.css',
                    ASSETS_PATH .'/css/myapp.css',
                )
            ),
            'admin_layout' => array(
                'common' => array(
                    COMPONENT_PATH . 'bootstrap/dist/css/bootstrap.min.css',
                    COMPONENT_PATH . 'font-awesome/css/font-awesome.min.css',
                    COMPONENT_PATH . 'Ionicons/css/ionicons.min.css',
                    COMPONENT_PATH . 'admin-lte/dist/css/AdminLTE.min.css',
                    COMPONENT_PATH . 'admin-lte/dist/css/skins/_all-skins.min.css',
                    '/css/wrapper_datatable.css',
                    '/css/myapp.css',
                ),
                'bs_datepicker' => array(COMPONENT_PATH . 'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'),
                'bs_date_range_picker' => array(COMPONENT_PATH . 'bootstrap-daterangepicker/daterangepicker.css'),
                'bs_wysihtml5' => array(COMPONENT_PATH . 'admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'),
            ),
            'blank_layout' => array(
                'common' => array(
                    COMPONENT_PATH . 'bootstrap/dist/css/bootstrap.min.css',
                    COMPONENT_PATH . 'font-awesome/css/font-awesome.min.css',
                    COMPONENT_PATH . 'Ionicons/css/ionicons.min.css',
                    COMPONENT_PATH . 'admin-lte/dist/css/AdminLTE.min.css',
                    COMPONENT_PATH . 'admin-lte/dist/css/skins/_all-skins.min.css',
                    '/css/myapp.css',
                )
            ),
            'default' => array(
                'common' => array()
            )
        );
    }

    private function _setAppJsFiles() {
        $this->_appJsFiles = array(
            'rbac' => array('/js/rbac.js'),
            'multiselect' => array(
                COMPONENT_PATH . 'jQuery-MultiSelect/jquery.multiselect.js'
            ),
            'jq_validation' => array(
                COMPONENT_PATH . 'jquery-validation/dist/jquery.validate.min.js',
                COMPONENT_PATH . 'jquery-validation/dist/additional-methods.min.js',
                '/js/additional_jq_validation.js'
            ),
            'datatable' => array(
                ADMIN_LTE_PATH . 'plugins/datatables/jquery.dataTables.min.js',
                ADMIN_LTE_PATH . 'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js',
                ADMIN_LTE_PATH . 'plugins/datatables-responsive/js/dataTables.responsive.min.js',
                ADMIN_LTE_PATH . 'plugins/datatables-responsive/js/responsive.bootstrap4.min.js',
                //ADMIN_LTE_PATH . 'plugins/datatables-colreorder/js/colReorder.bootstrap4.min.js',
                //ADMIN_LTE_PATH . 'plugins/datatables-fixedcolumns/js/fixedColumns.bootstrap4.min.js',
                //ADMIN_LTE_PATH . 'plugins/datatables-keytable/js/keyTable.bootstrap4.min.js',
                ADMIN_LTE_PATH . 'plugins/datatables-scroller/js/dataTables.scroller.min.js',
            ),
            'chosen' => array(COMPONENT_PATH . 'chosen/chosen.jquery.js'),
            'tree' => array('/js/tree.js'),
            'jstree' => array(COMPONENT_PATH . 'jstree/dist/jstree.min.js'),
            'promise' => array(COMPONENT_PATH . 'bluebird/js/browser/bluebird.min.js'),
            'js_validation' => array(COMPONENT_PATH . 'jquery-validation/jquery.validate.js'),
            'jq_typehead' => array(COMPONENT_PATH . 'jquery-typeahead/dist/jquery.typeahead.min.js'),
            'jq_multitag_select' => array(
                COMPONENT_PATH . 'jquery.treeSelector/jquery.treeSelector.js'
            ),
            'print_element' => array(COMPONENT_PATH . 'print-elements/print_elements.js'),
            'd3' => array('/asset/d3/d3.min.js'),
            'pass_meter' => array('/js/pass_meter/js/mocha.js'),
            'bs_daterange_picker' => array(
                COMPONENT_PATH . 'moment/moment.js',
                COMPONENT_PATH . 'bootstrap-daterangepicker/daterangepicker.js'
            )
        );
    }

    private function _setAppCssFiles() {
        $this->_appCssFiles = array(
            'multiselect' => array(
                COMPONENT_PATH . 'jQuery-MultiSelect/jquery.multiselect.css'
            ),
            'datatable' => array(
                ADMIN_LTE_PATH . 'plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
                ADMIN_LTE_PATH . 'plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
                ASSETS_PATH . 'css/wrapper_datatable.css',
                
            ),
            'chosen' => array(COMPONENT_PATH . 'chosen/chosen.css'),
            'jstree' => array(COMPONENT_PATH . 'jstree/dist/themes/default/style.min.css'),
            'jq_typehead' => array(COMPONENT_PATH . 'jquery-typeahead/dist/jquery.typeahead.min.css'),
            'jq_multitag_select' => array(
                COMPONENT_PATH . 'jquery.treeSelector/jquery.treeSelector.css'
            ),
            'print_element' => array(COMPONENT_PATH . 'print-elements/print.css'),
            'bs_daterange_picker' => array(COMPONENT_PATH . 'bootstrap-daterangepicker/daterangepicker.css')
        );
    }

    public function preJs($layout) {
        $str = '';
        if (isset($this->_layoutJsFiles[$layout]['top'])) {
            foreach ($this->_layoutJsFiles[$layout]['top'] as $files) {
                $str .= "\n\t" . '<script src="' . base_url($files) . '"></script>';
            }
        }
        echo $str;
        return $this;
    }

    public function includeCss($layout) {
        $str = '';
        if (isset($this->_layoutCssFiles[$layout]) && is_array($this->cssFiles)) {
            //merge application plugins with layout css list
            $this->_layoutCssFiles[$layout] = array_merge($this->_layoutCssFiles[$layout], $this->_appCssFiles);
            foreach ($this->cssFiles as $pluginName) {
                if (array_key_exists($pluginName, $this->_layoutCssFiles[$layout])) {
                    foreach ($this->_layoutCssFiles[$layout][$pluginName] as $files) {
                        $str .= "\n\t" . '<link rel="stylesheet" href="' . base_url($files) . '" />';
                    }
                }
            }
        }
        echo $str;
        return $this;
    }

    public function includeJs($layout) {
        $this->_layout = $layout;
        $str = '';
        if (isset($this->_layoutJsFiles[$layout]) && is_array($this->jsFiles)) {
            //merge application plugins with layout scripts list
            $this->_layoutJsFiles[$layout] = array_merge($this->_layoutJsFiles[$layout], $this->_appJsFiles);
            foreach ($this->jsFiles as $key => $pluginName) {

                if (array_key_exists($pluginName, $this->_layoutJsFiles[$layout])) {
                    foreach ($this->_layoutJsFiles[$layout][$pluginName] as $key => $files) {
                        if (is_array($files)) {
                            foreach ($files as $scripts) {
                                $link = (strpos($scripts, 'http') !== false) ? $scripts : base_url($scripts);
                                $str .= "\n\t" . '<script src="' . $link . '"></script>';
                            }
                        } else {
                            $link = (strpos($files, 'http') !== false) ? $files : base_url($files);
                            $str .= "\n\t" . '<script src="' . $link . '" ></script>';
                        }
                    }
                }
            }
        }

        echo $str;
        return $this;
    }

    public function includeCustomJsTop() {
        $scriptFiles = '';
        if (array_key_exists('top', $this->_customJsfiles)) {
            foreach ($this->_customJsfiles['top'] as $files) {
                $scriptFiles .= "\n\t" . '<script src="' . base_url($files . '.js') . '"></script>';
            }
        }
        echo $scriptFiles;
        return $this;
    }

    public function includeCustomJsButtom() {
        $scriptFiles = '';
        if (array_key_exists('buttom', $this->_customJsfiles)) {
            foreach ($this->_customJsfiles['buttom'] as $files) {
                $url = (strpos($files, 'http') !== false) ? $files : base_url($files . '.js');
                $scriptFiles .= "\n\t" . '<script src="' . $url . '"></script>';
            }
        }
        echo $scriptFiles;
        return $this;
    }

    public function includeCustomCssTop() {
        $cssFiles = '';
        if (array_key_exists('top', $this->_customCssfiles)) {
            foreach ($this->_customCssfiles['top'] as $files) {
                $cssFiles .= "\n" . '<link rel="stylesheet" href="' . base_url($files . '.css') . '" />';
            }
        }
        echo $cssFiles;
        return $this;
    }

    public function includeCustomCssButtom() {
        $cssFiles = '';
        if (array_key_exists('buttom', $this->_customCssfiles)) {
            foreach ($this->_customCssfiles['buttom'] as $files) {
                $cssFiles .= "\n" . '<link rel="stylesheet" href="' . base_url($files . '.css') . '" />';
            }
        }
        echo $cssFiles;
        return $this;
    }

    public function includePlugins($plugins = null, $type = null) {
        if (is_array($plugins) && $type == 'css') {
            $this->cssFiles = array_merge($this->cssFiles, $plugins);
        } elseif (is_array($plugins) && $type == 'js') {
            $this->jsFiles = array_merge($this->jsFiles, $plugins);
        } else {
            $this->cssFiles = array_merge($this->cssFiles, $plugins);
            $this->jsFiles = array_merge($this->jsFiles, $plugins);
        }
        return $this;
    }

    public function includeCustomeFile($js_array = array(), $type = 'js', $position = '') {

        if ($position == '') {
            if ($type == 'js')
                $position = 'buttom';
            else
                $position = 'top';
        }

        $files = array();
        if (is_array($js_array)) {
            foreach ($js_array as $file) {
                if (is_string($file)) {
                    $files[] = $this->_defaultModulePath . $type . '/' . $file;
                } else if (is_array($file)) {
                    if (array_key_exists('path', $file) && array_key_exists('file', $file)) {
                        $files[] = $file['path'] . '/' . $file['file'];
                    } else if (array_key_exists('file', $file)) {
                        $files[] = $this->_defaultModulePath . $type . '/' . $file['file'];
                    }
                }
            }
        }
        if ($type == 'js') {
            $this->_customJsfiles[$position] = $files;
        } else if ($type == 'css') {
            $this->_customCssfiles[$position] = $files;
        }
        return $this;
    }

    public function includeGenericJsButtom() {
        $str = '';
        $layout = $this->_layout;
        if (isset($this->_layoutJsFiles[$layout]) && is_array($this->jsFiles)) {

            foreach ($this->_layoutJsFiles[$layout]['buttom'] as $key => $files) {
                if (is_array($files)) {
                    foreach ($files as $scripts) {
                        $str .= "\n\t" . '<script src="' . base_url($scripts) . '"></script>';
                    }
                } else {
                    $str .= "\n\t" . '<script src="' . base_url($files) . '" ></script>';
                }
            }
        }

        echo $str;
        return $this;
    }

    /**
     * include in view page js script
     *
     * Include in view page js script defined in $this->scripts_include->_inlineJs array
     *
     * @return object $this
     * */
    public function includeInlineJs() {
        if (isset($this->_inlineJs)) {
            foreach ($this->_inlineJs as $script) {
                echo "\r\n";
                echo $script;
            }
        }
        return $this;
    }

}
