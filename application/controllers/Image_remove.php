<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Image_remove extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('html', 'form', 'url'));
        //$this->load->library('form_validation');
        $this->load->helper('file');
        $this->load->database();
        $this->load->helper('directory');
        //$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        //$this->load->helper(array('solariumphp/library/solarium/Autoloader', 'file'));
        //$this->load->library('email');
        //$this->load->library('session');
        //$this->load->library('upload');
        //$this->load->library('encrypt');
        //$this->load->library('javascript');
        //$this->load->library('pagination');
        //$this->load->helper('string');
        //$this->load->helper('cookie');
        //$this->load->library('user_agent');
        //$this->load->model('Product_descrp_model');
        //$this->load->model('Mycart_model');
        //$this->load->library('breadcrumbs');
        //$this->load->model('Admin_model');
    }

    function rejected_image() {
        set_time_limit(0);
        //echo $dir=base_url().'images/product_img/';
        //$map = directory_map('./images/pagedesign_image/' , FALSE, TRUE);
        //echo count($map); 

        $fileSystemIterator = new FilesystemIterator('./images/product_img/');
        $i = 0;

        $output_dir = "./images/product_img/";
        $entries = array();
        foreach ($fileSystemIterator as $fileInfo) {
            $entries[] = $fileInfo->getFilename();

            $imgflnamechk = substr($entries[$i], strpos($entries[$i], "_") + 1);

            $qr_img = $this->db->query("SELECT * FROM seller_product_image WHERE  (image='$imgflnamechk' OR image LIKE '$imgflnamechk,%' OR image LIKE '%,$imgflnamechk,%' OR image LIKE '%,$imgflnamechk' )");

            if ($qr_img->num_rows() == 0) {
                $qr_img = $this->db->query("SELECT * FROM seller_existingproduct_image WHERE  (image='$imgflnamechk' OR image LIKE '$imgflnamechk,%' OR image LIKE '%,$imgflnamechk,%' OR image LIKE '%,$imgflnamechk' )");
            }

            if ($qr_img->num_rows() == 0) {
                $filePath = $output_dir . $entries[$i];
                //unlink($filePath);
                echo $entries[$i] . " >>>>>> Delete<br>";

                $data = array('img_name' => $entries[$i]);

                $this->db->insert('Image_deletetrack', $data);
            } else {
                echo $entries[$i] . " >>>>>>>>> Is in DB<br>";
            }




            /* if(file_exists(trim($filePath)))						
              {


              //echo "--exist--";
              }
              else
              {echo "not exist";} */


            $i++;
            if ($i == 100) {
                break;
            }
        }

        //print_r($entries);
    }

}

?>