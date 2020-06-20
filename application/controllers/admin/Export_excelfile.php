<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Export_excelfile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('html', 'form', 'url'));
        $this->load->helper('file');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('session');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->database();
        $this->load->model('admin/Export_excel_model');
    }

    function export_to_excelfile() {
        if ($this->session->userdata('logged_in')) {
            $this->Export_excel_model->export_to_excel();

            $this->load->model('admin/Product');

            $msg1['res'] = $this->Product->select_tax_list();
            $msg1['res1'] = $this->Product->select_taxclass();
            $msg1['res2'] = $this->Product->select_triname();
            $msg1['res3'] = $this->Product->select_country();

            $this->load->view('admin/tax_manage', $msg1);
        } else {
            redirect('admin/super_admin');
        }
    }

    // Newsletter Excel
    function newsletter_excelfile() {
        if ($this->session->userdata('logged_in')) {
            $success = $this->Export_excel_model->getNewsletterExcel();
            if ($success == true) {
                $this->session->set_flashdata('download_msg', 'Excel file downloaded successfully.');
                redirect('admin/newsletter');
            }
        } else {
            redirect('admin/super_admin');
        }
    }

    /* function payout_excelfile(){
      if($this->session->userdata('logged_in')){
      $result = $this->Export_excel_model->getPayoutExcel();
      $slr_payout_result = $this->Export_excel_model->getSellerPayoutExcel();
      if($slr_payout_result == true){
      redirect('admin/payment/download_excel');
      }
      }else{
      redirect('admin/super_admin');
      }
      } */
}
