<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
        $this->load->helper('string');
        $this->load->library('form_validation');
        $this->load->library('email');
        
        $this->load->library('upload');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        
        $this->load->model('seller/Report_model');
        $this->load->helper('date');
        $this->load->library('pagination');
    }

    function index() {
        if ($this->session->userdata('seller-session')) {
            $config = array();
            $config["base_url"] = base_url() . "seller/reports";
            $config["total_rows"] = $this->Report_model->order_report_count();
            $config["per_page"] = 100;
            $config["uri_segment"] = 3;
            $config['page_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $data['order_report'] = $this->Report_model->retrieve_order_report($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();

            $end = $page + $this->pagination->per_page;
            $data['start'] = $page;


            $this->load->view('seller/order_report', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function export_orderreport() {
        $limit = 100;
        $start = $this->uri->segment(4);
        $data['result'] = $this->Report_model->export_orderreport($limit, $start);
        $this->load->view('seller/export_order_report', $data);
    }

    function filter_order() {
        if ($this->session->userdata('seller-session')) {
            $data['order_date'] = $_REQUEST['order_date'];
            $data['order_id'] = $_REQUEST['order_id'];
            $data['email'] = $_REQUEST['email'];
            $data['amount'] = $_REQUEST['amount'];
            $data['status'] = $_REQUEST['status'];

            $config = array();
            $config["base_url"] = base_url() . "seller/reports/filter_order";
            $config["total_rows"] = $this->Report_model->filter_order_count();
            $config["per_page"] = 100;
            $config["uri_segment"] = 3;
            $config["page_query_string"] = TRUE;
            $config['enable_query_strings'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['suffix'] = '&order_date=' . $data['order_date'] . '&order_id=' . $data['order_id'] . '&email=' . $data['email'] . '&amount=' . $data['amount'] . '&status=' . $data['status'];
            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

            $data['order_report'] = $this->Report_model->filtered_order($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();
            $end = $page + $this->pagination->per_page;
            $data['start'] = $page;
            $this->load->view('seller/order_report', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function return_report() {


        if ($this->session->userdata('seller-session')) {
            $config = array();
            $config["base_url"] = base_url() . "seller/reports/return_report";
            $config["total_rows"] = $this->Report_model->return_report_count();
            $config["per_page"] = 100;
            $config["uri_segment"] = 3;
            $config['page_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $data['return_order_reportresult'] = $this->Report_model->retrieve_return_order_report($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();

            $end = $page + $this->pagination->per_page;
            $data['start'] = $page;


            $this->load->view('seller/returned_order_report', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function export_returnreport() {
        $limit = 100;
        $start = $this->uri->segment(4);
        $data['result'] = $this->Report_model->export_returnreport($limit, $start);
        $this->load->view('seller/export_returned_report', $data);
    }

    function autofill_prodnm() {
        $data['autofilldata'] = $this->Report_model->search_prod_name();
        $this->load->view('seller/autofill_prodnm', $data);
    }

    function filter_return() {
        if ($this->session->userdata('seller-session')) {
            $data['retn_dt'] = $_REQUEST['retn_dt'];
            $data['order_id'] = $_REQUEST['order_id'];
            $data['retn_id'] = $_REQUEST['retn_id'];
            $data['prod_name'] = $_REQUEST['prod_name'];
            $data['quantity'] = $_REQUEST['quantity'];
            $data['amount'] = $_REQUEST['amount'];
            $data['email'] = $_REQUEST['email'];
            $data['status'] = $_REQUEST['status'];

            $config = array();
            $config["base_url"] = base_url() . "seller/reports/filter_return";
            $config["total_rows"] = $this->Report_model->filter_return_count();
            $config["per_page"] = 100;
            $config["uri_segment"] = 3;
            $config["page_query_string"] = TRUE;
            $config['enable_query_strings'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['suffix'] = '&retn_dt=' . $data['retn_dt'] . '&order_id=' . $data['order_id'] . '&retn_id=' . $data['retn_id'] . '&prod_name=' . $data['prod_name'] . '&quantity=' . $data['quantity'] . '&amount=' . $data['amount'] . '&email=' . $data['email'] . '&status=' . $data['status'];
            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

            $data['return_order_reportresult'] = $this->Report_model->filtered_return($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();
            $end = $page + $this->pagination->per_page;
            $data['start'] = $page;
            $this->load->view('seller/returned_order_report', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function payment_report() {
        if ($this->session->userdata('seller-session')) {

            $data['payment_reportresult'] = $this->Report_model->retrieve_seller_all_payout();

            $this->load->view('seller/payment_report', $data);
        } else {
            redirect('seller/seller');
        }
    }

}
