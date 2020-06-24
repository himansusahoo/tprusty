<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Update_postal_code_cnt extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
        $this->load->library('form_validation');

        $this->load->library('email');
        
        $this->load->library('upload');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->library('pagination');
        
        $this->load->helper('string');
        $this->load->library('user_agent');
        $this->load->model('Super_admin_model');
        $this->load->model('admin/User_role_setup_model');
        //$this->load->model('Admin_model');
        $this->load->model('admin/postalcode_update_model');
        $this->load->model('PHPExcel/Phpexcel_iofactory');
    }

    function update_postal_code() {
        if ($this->session->userdata('logged_in')) {

            $this->load->view('admin/update_postal_code_view');
            //echo "hi";exit;
        } else {
            redirect('admin/super_admin');
        }
    }

    function upload_postal_code_excel() {

        if ($this->session->userdata('logged_in')) {
            //$this->load->library('excel');




            $this->postalcode_update_model->postalcode_Upload();

            $this->session->set_flashdata('msgcod_wtchrg', 'Data Saved Successfully');

            // redirect('admin/super_admin/color_setup');
        } else {
            redirect('admin/super_admin');
        }
    }

    function dltsolr_logsingle() {
        $this->Solar_manage_model->dltsolr_logsingle();
        //echo $logsql_id;exit;
    }

    function dltselected_solr_log() {
        $this->Solar_manage_model->dltselected_solr_log();
    }

}
