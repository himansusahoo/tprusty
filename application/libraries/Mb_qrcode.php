<?php

require_once APPPATH . "/third_party/phpqrcode/qrlib.php";
/**
 * Chm_qrcode Class File
 * PHP Version 7.1.1
 * 
 * @category   CI Library
 * @package    CI Library
 * @subpackage QR-Code
 * @class      Qrcode
 * @desc    
 * @author     HimansuS <himansu.php@gmail.com>                
 * @license    
 * @link       
 * @since   24/02/2019
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Library_members Class
 * 
 * @category   CI Library
 * @package    CI Library
 * @class      Chm_qrcode
 * @desc    
 * @author     HimansuS                  
 * @since   11/08/2018
 */
class Mb_qrcode {

    /**
     * __construct Method
     * 
     * @param   
     * @desc    
     * @return 
     * @author  HimansuS                  
     * @since   24/02/2019
     */
    public function __construct() {
        //$this->_initialize($config);
    }

    private $_error_correction_level = array('L', 'M', 'Q', 'H');
    private $_config = array();

    /**
     * @param  : 
     * @desc   : used to set the configurations
     * @return :
     * @author : HimansuS
     * @created: 25/02/2019
     */
    private function _initialize($config) {
        $default = array(
            'error_correction_level' => 'H',
            'size' => 2,
            'temp_dir_access' => '..',//no use
            'temp_dir' => 'qrcodes',
            'file_name' => 'qrcode_' . rand(1, 999999),
            'file_name_random' => true,
            'file_path' => '',
            'margin' => 2,
            'save_and_print' => false,
            'dir_separator' => '/',
            'text'=>''
        );
        $this->_config = array_merge($default, $config);
        if (isset($this->_config['file_path']) && $this->_config['file_path'] == '') {
            $this->_config['file_path'] = $this->_path_separator();
        } else {
            $this->_config['file_path'] = $this->_path_separator($this->_config['file_path']);
        }
        $this->_config['full_path'] = $this->_config['file_path'] . $this->_config['dir_separator'] . $this->_config['temp_dir'];
        create_dir($this->_config['full_path']);
    }

    /**
     * @param  : 
     * @desc   : manage directory separator,get physical path like g:\projects/chm/
     * @return :
     * @author : HimansuS
     * @created: 25/02/2019
     */
    private function _path_separator($path = null) {
        if (!$path) {
            $path = dirname(APPPATH);
        }
        $path = explode('\\', $path);
        $drive = array_shift($path);
        $rest_path = implode($this->_config['dir_separator'], $path);
        $path = $drive . '\\' . $rest_path;
        return $path;
    }

    /**
     * @param  : 
     * @desc   : generate qrcode image and return full config array
     * @return :
     * @author : HimansuS
     * @created:
     */
    public function generate_qrcode($config) {
        $this->_initialize($config);
        
        if ($this->_config['file_name_random']) {
            $filename = $this->_config['file_name'] . md5($this->_config['text'] . '|' . $this->_config['error_correction_level'] . '|' . $this->_config['size']) . '.png';
        } else {
            $filename = $this->_config['file_name'] . '.png';
        }
        $full_file_name = $this->_config['file_path'] . $this->_config['dir_separator'] . $this->_config['temp_dir'] . $this->_config['dir_separator'] . $filename;
        QRcode::png($this->_config['text'], $full_file_name, $this->_config['error_correction_level'], $this->_config['size'], $this->_config['margin'], $this->_config['save_and_print']);

        $qrcode_relative_path = $this->_config['dir_separator'] . $this->_config['temp_dir'] . $this->_config['dir_separator'];
        $return_filename = $qrcode_relative_path . $filename;
        $this->_config['qrcode_image'] = $return_filename;
        return $this->_config;
    }

}
