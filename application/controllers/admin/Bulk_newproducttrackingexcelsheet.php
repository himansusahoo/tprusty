<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bulk_newproducttrackingexcelsheet extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('html', 'form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('session');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->helper('string');
        $this->load->database();
        //$this->load->model('Corenjob_product_model')
        $this->load->model('admin/Bulk_newprod_excelsheettrackingmodel');
        $this->load->helper('file');
    }

    function bulk_newprod_addexcelsheetracking() {
        if ($this->session->userdata('logged_in')) {

            $data['excelinfo'] = $this->Bulk_newprod_excelsheettrackingmodel->bulknewprod_excelfiletracking();

            $this->load->view('admin/bulknewproduct_excelsheettracking', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function reset_reuploadprocess() {
        if ($this->session->userdata('logged_in')) {

            $this->Bulk_newprod_excelsheettrackingmodel->bulknewprod_excelfilereuploadstop();

            redirect('admin/Bulk_newproducttrackingexcelsheet/bulk_newprod_addexcelsheetracking');
        } else {
            redirect('admin/super_admin');
        }
    }

}
