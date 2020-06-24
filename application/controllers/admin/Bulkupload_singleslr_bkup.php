<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bulkupload_singleslr Extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
        $this->load->library('form_validation');
        
        $this->load->library('upload');
        $this->load->library('javascript');
        $this->load->helper('string');
        
        $this->load->model('admin/Bulkupload_category_attrblink_model');
    }

    function select_attrbid() {
        $attrb_id = $this->input->post('attrb_id');

        $data['editedprod_catg'] = $this->Bulkupload_category_attrblink_model->getedit_attributeset_ascatg($attrb_id);

        $this->load->view('admin/ajax_category_attrblink', $data);
    }

}
