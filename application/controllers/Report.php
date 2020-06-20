<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('html', 'form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('session');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->model('admin/Report_model');
        $this->load->database();
    }

    function index() {
        if ($this->session->userdata('logged_in')) {
            $data['status'] = $this->input->post('order_status2');
            $data['seller_name'] = $this->input->post('fltr_seller');
            $data['order_report'] = $this->Report_model->retrieve_order_report();
            $this->load->view('admin/order_report', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function filter_order_report() {
        if ($this->session->userdata('logged_in')) {
            $data['status'] = $this->input->post('order_status2');
            $data['seller_name'] = $this->input->post('fltr_seller');
            $data['order_report'] = $this->Report_model->retrieve_filter_order_report();
            $this->load->view('admin/order_report', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function return_order_report() {
        if ($this->session->userdata('logged_in')) {
            $data['status'] = $this->input->post('order_status2');
            $data['seller_name'] = $this->input->post('fltr_seller');
            $data['return_order_report_result'] = $this->Report_model->retrieve_return_order_report();
            $this->load->view('admin/return_order_report', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function filter_return_order_report() {
        if ($this->session->userdata('logged_in')) {
            $data['status'] = $this->input->post('order_status2');
            $data['seller_name'] = $this->input->post('fltr_seller');
            $data['return_order_report_result'] = $this->Report_model->filter_return_order_report();
            $this->load->view('admin/return_order_report', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

}

?>