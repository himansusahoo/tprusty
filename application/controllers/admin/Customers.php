<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('html', 'form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('session');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->database();
        $this->load->model('admin/Customer_model');
        $this->load->library('pagination');
    }

    function index() {

        if ($this->session->userdata('logged_in')) {
            $data['user_id'] = $this->input->post('user_id');
            $data['cust_name'] = $this->input->post('cust_name');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');

            $data['zip'] = $this->input->post('zip');
            $data['country_id'] = $this->input->post('country_id');
            $data['state_province'] = $this->input->post('state_province');
            $data['cust_since'] = $this->input->post('cust_since');

            $config = array();
            $config["base_url"] = base_url() . "admin/customers";
            $config["total_rows"] = $this->Customer_model->retrive_customer_details_count();
            $config["per_page"] = 20;
            $config["uri_segment"] = 3;
            //$config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];

            //$config["num_links"] = round($choice);
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $data['customer'] = $this->Customer_model->select_user($config["per_page"], $page);
            //$data['result'] = $this->Product->retrive_product_details_catalog($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();

            //$data['result'] = $this->Product->retrive_product_details();
            //$data['result_attr_group'] = $this->Product->retrive_product_attribute_group();
            $this->load->view('admin/manage_customers', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    //$data['customer']=$this->Customer_model->select_user();
    //$this->load->view('admin/manage_customers',$data);
    //}




    function filter_customer() {
        if ($this->session->userdata('logged_in')) {
            //$order_data['user_id'] = $_REQUEST['user_id'];
            $order_data['cust_name'] = $_REQUEST['cust_name'];
            $order_data['email'] = $_REQUEST['email'];
            $order_data['phone'] = $_REQUEST['phone'];
            $order_data['zip'] = $_REQUEST['zip'];
            $order_data['country_id'] = $_REQUEST['country_id'];
            $order_data['state_province'] = $_REQUEST['state_province'];
            $order_data['cust_since'] = $_REQUEST['cust_since'];

            $config = array();
            $config["base_url"] = base_url() . "admin/customers/filter_customer";
            $config["total_rows"] = $this->Customer_model->select_filter_customer_count();
            $config["per_page"] = 30;
            $config["uri_segment"] = 3;
            $config["page_query_string"] = TRUE;
            $config['enable_query_strings'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];
            //$config["num_links"] = round($choice);
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['suffix'] = '&cust_name=' . $order_data['cust_name'] . '&email=' . $order_data['email'] . '&phone=' . $order_data['phone'] . '&zip=' . $order_data['zip'] . '&country_id=' . $order_data['country_id'] . '&state_province=' . $order_data['state_province'] . '&cust_since=' . $order_data['cust_since'];
            //'&user_id='.$order_data['user_id'].
            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

            $order_data['customer'] = $this->Customer_model->select_filtered_customers($config["per_page"], $page);
            $order_data['links'] = $this->pagination->create_links();

            $this->load->view('admin/manage_customers', $order_data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function customer() {
        $this->load->view('admin/customers');
    }

    /* function filter_customer(){
      if($this->session->userdata('logged_in')){


      $data['customer'] = $this->Customer_model->filter_customer();
      $this->load->view('admin/manage_customers', $data);
      }else{
      redirect('admin/super_admin');
      }
      } */

    function customer_details() {
        if ($this->session->userdata('logged_in')) {
            $id = $this->uri->segment(4);
            $data['customer'] = $this->Customer_model->customer_details($id);
            $data['order_details'] = $this->Customer_model->order_details($id);
            $data['cancel_details'] = $this->Customer_model->cancel_details($id);
            $data['return_details'] = $this->Customer_model->return_details($id);
            $data['delivered_products'] = $this->Customer_model->delivered_products($id);
            $data['undelivered_products'] = $this->Customer_model->undelivered_products($id);
            $this->load->view('admin/customer_details', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function getting_addresses() {
        $data['result'] = $this->Customer_model->retriving_custmr_addrs();
        $this->load->view('admin/load_custmr_addrs', $data);
    }

}

?>