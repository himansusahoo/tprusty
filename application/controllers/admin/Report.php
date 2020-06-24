<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
        $this->load->library('form_validation');
        $this->load->library('email');
        
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->model('admin/Report_model');
        $this->load->model('admin/Seller_model');
        $this->load->library('pagination');
        
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

    function sales_report() {
        if ($this->session->userdata('logged_in')) {
            $config = array();
            $config["base_url"] = base_url() . "admin/report/sales_report";
            $config["total_rows"] = $this->Seller_model->retrive_sales_details_count();
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
            $data['sales_report'] = $this->Seller_model->retrieve_sales_report($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();

            $end = $page + $this->pagination->per_page;
            $data['start'] = $page;


            $this->load->view('admin/sales_report', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    /* if($this->session->userdata('logged_in')){
      $data['sales_report'] = $this->Seller_model->retrieve_sales_report();
      $this->load->view('admin/sales_report',$data);
      }else{
      redirect('admin/super_admin');
      }
      } */

    function autofill_seller() {
        $data['autofilldata'] = $this->Seller_model->search_seller_name();
        $this->load->view('admin/autofill_business', $data);
    }

    function filter_sales() {
        if ($this->session->userdata('logged_in')) {
            $order_data['seller'] = $_REQUEST['seller'];
            /* $order_data['totl_order'] = $_REQUEST['totl_order'];	
              $order_data['sale'] = $_REQUEST['sale'];
              $order_data['cancel'] = $_REQUEST['cancel'];
              $order_data['return'] = $_REQUEST['return'];
              $order_data['replacement'] = $_REQUEST['replacement']; */

            $config = array();
            $config["base_url"] = base_url() . "admin/report/filter_sales";
            $config["total_rows"] = $this->Seller_model->select_filter_sales_count();
            $config["per_page"] = 100;
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
            $config['suffix'] = '&seller=' . $order_data['seller'];
            /* $config['suffix'] ='&seller='.$order_data['seller'].'&totl_order='.$order_data['totl_order'].'&sale='.$order_data['sale'].'&cancel='.$order_data['cancel'].'&return='.$order_data['return'].'&replacement='.$order_data['replacement']; */
            //'&user_id='.$order_data['user_id'].
            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

            $order_data['sales_report'] = $this->Seller_model->select_filtered_sales($config["per_page"], $page);
            $order_data['links'] = $this->pagination->create_links();
            $end = $page + $this->pagination->per_page;
            $order_data['start'] = $page;
            $this->load->view('admin/sales_report', $order_data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function export_salereport() {
        $limit = 100;
        $start = $this->uri->segment(4);
        $data['result'] = $this->Seller_model->export_salereport($limit, $start);
        $this->load->view('admin/export_sale_report', $data);
    }

    function seller_report() {
        if ($this->session->userdata('logged_in')) {
            $config = array();
            $config["base_url"] = base_url() . "admin/report/seller_report";
            $config["total_rows"] = $this->Seller_model->retrive_slr_details_count();
            $config["per_page"] = 20;
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
            $data['slr_report'] = $this->Seller_model->retrieve_slr_report($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();

            $end = $page + $this->pagination->per_page;
            $data['start'] = $page;


            $this->load->view('admin/seller_report', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function autofill_register() {
        $data['autofilldata'] = $this->Seller_model->search_register_name();
        $this->load->view('admin/autofill_register', $data);
    }

    function export_seller_report() {
        $limit = 20;
        $start = $this->uri->segment(4);
        $data['result'] = $this->Seller_model->export_slrreport($limit, $start);
        $this->load->view('admin/export_slrreport', $data);
    }

    function filter_seller() {
        if ($this->session->userdata('logged_in')) {
            $data['seller'] = $_REQUEST['seller'];
            $data['slr_date_from'] = $_REQUEST['slr_date_from'];
            $data['slr_date_to'] = $_REQUEST['slr_date_to'];
            $data['status'] = $_REQUEST['status'];

            $config = array();
            $config["base_url"] = base_url() . "admin/report/filter_seller";
            $config["total_rows"] = $this->Seller_model->select_filter_slr_count();
            $config["per_page"] = 20;
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
            $config['suffix'] = '&seller=' . $data['seller'] . '&slr_date_from=' . $data['slr_date_from'] . '&slr_date_to=' . $data['slr_date_to'] . '&status=' . $data['status'];

            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

            $data['slr_report'] = $this->Seller_model->select_filtered_slr($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();
            $end = $page + $this->pagination->per_page;
            $data['start'] = $page;

            $this->load->view('admin/seller_report', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function product_report() {

        if ($this->session->userdata('logged_in')) {
            $config = array();
            $config["base_url"] = base_url() . "admin/report/product_report";
            $config["total_rows"] = $this->Seller_model->retrive_product_details_count();
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
            $data['seller_report'] = $this->Seller_model->retrieve_product_report($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();
            $this->load->view('admin/product_report', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function autofill_prodseller() {
        $data['autofilldata'] = $this->Seller_model->search_prodseller_name();
        $this->load->view('admin/autofill_prodseller', $data);
    }

    function autofill_prodnm() {
        $data['autofilldatas'] = $this->Seller_model->search_prod_name();
        $this->load->view('admin/autofill_prodnm', $data);
    }

    /* if($this->session->userdata('logged_in')){
      $data['seller_report'] = $this->Seller_model->retrieve_product_report();
      $this->load->view('admin/product_report',$data);
      }else{
      redirect('admin/super_admin');
      }
      } */

    function filter_product() {
        if ($this->session->userdata('logged_in')) {
            $data['cate_name'] = $_REQUEST['cate_name'];
            $data['prod_name'] = $_REQUEST['prod_name'];
            $data['add_date'] = $_REQUEST['add_date'];
            $data['seller_name'] = $_REQUEST['seller_name'];
            $data['quantity'] = $_REQUEST['quantity'];
            $data['approve_status'] = $_REQUEST['approve_status'];
            $data['dispy_stas'] = $_REQUEST['dispy_stas'];
            $data['mrp'] = $_REQUEST['mrp'];
            $data['sell_price'] = $_REQUEST['sell_price'];
            $data['spec_price'] = $_REQUEST['spec_price'];
            $data['vat'] = $_REQUEST['vat'];

            $config = array();
            $config["base_url"] = base_url() . "admin/report/filter_product";
            $config["total_rows"] = $this->Seller_model->select_filter_product_count();
            $config["per_page"] = 100;
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
            $config['suffix'] = '&cate_name=' . $data['cate_name'] . '&prod_name=' . $data['prod_name'] . '&add_date=' . $data['add_date'] . '&seller_name=' . $data['seller_name'] . '&quantity=' . $data['quantity'] . '&approve_status=' . $data['approve_status'] . '&dispy_stas=' . $data['dispy_stas'] . '&mrp=' . $data['mrp'] . '&sell_price=' . $data['sell_price'] . '&spec_price=' . $data['spec_price'] . '&vat=' . $data['vat'];

            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

            $data['seller_report'] = $this->Seller_model->select_filtered_product($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();

            $this->load->view('admin/product_report', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function top_selling() {

        if ($this->session->userdata('logged_in')) {
            $config = array();
            $config["base_url"] = base_url() . "admin/report/top_selling";
            $config["total_rows"] = $this->Seller_model->retrive_topselling_count();
            $config["per_page"] = 10;
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
            $data['topselling_report'] = $this->Seller_model->retrieve_topselling_report($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();
            $this->load->view('admin/topselling_product', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function autofill_topseller() {
        $data['autofilldata'] = $this->Seller_model->search_topseller();
        $this->load->view('admin/autofill_topseller', $data);
    }

    function autofill_topprodnm() {
        $data['autofilldatas'] = $this->Seller_model->search_topprodnm();
        $this->load->view('admin/autofill_topprodnm', $data);
    }

    function filter_topselling() {
        if ($this->session->userdata('logged_in')) {
            $data['prod_name'] = $_REQUEST['prod_name'];
            $data['seller_name'] = $_REQUEST['seller_name'];
            //$data['selling_qnty'] = $_REQUEST['selling_qnty'];
            $data['approve_status'] = $_REQUEST['approve_status'];
            $data['dispy_stas'] = $_REQUEST['dispy_stas'];

            $config = array();
            $config["base_url"] = base_url() . "admin/report/filter_topselling";
            $config["total_rows"] = $this->Seller_model->select_filter_topselling_count();
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
            $config['suffix'] = '&prod_name=' . $data['prod_name'] . '&seller_name=' . $data['seller_name'] . '&approve_status=' . $data['approve_status'] . '&dispy_stas=' . $data['dispy_stas'];
            /* $config['suffix'] ='&prod_name='.$data['prod_name'].'&seller_name='.$data['seller_name'].'&selling_qnty='.$data['selling_qnty'].'&approve_status='.$data['approve_status'].'&dispy_stas='.$data['dispy_stas']; */

            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

            $data['topselling_report'] = $this->Seller_model->select_filtered_topselling($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();

            $this->load->view('admin/topselling_product', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function topselling_excel_report() {
        if ($this->session->userdata('logged_in')) {
            $data['result'] = $this->Seller_model->excel_topselling();
            $this->load->view('admin/excel_topselling', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function buyer_report() {

        if ($this->session->userdata('logged_in')) {
            $config = array();
            $config["base_url"] = base_url() . "admin/report/buyer_report";
            $config["total_rows"] = $this->Seller_model->retrive_buyer_count();
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
            $data['buyer_report'] = $this->Seller_model->retrieve_buyer_report($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();
            $end = $page + $this->pagination->per_page;
            $data['start'] = $page;
            $this->load->view('admin/buyer_report', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function filter_buyer() {
        if ($this->session->userdata('logged_in')) {
            $data['name'] = $_REQUEST['name'];
            $data['email'] = $_REQUEST['email'];
            $data['phno'] = $_REQUEST['phno'];
            $data['address'] = $_REQUEST['address'];
            //$data['totl_order'] = $_REQUEST['totl_order'];

            $config = array();
            $config["base_url"] = base_url() . "admin/report/filter_buyer";
            $config["total_rows"] = $this->Seller_model->select_filter_buyer_count();
            $config["per_page"] = 100;
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
            $config['suffix'] = '&name=' . $data['name'] . '&email=' . $data['email'] . '&phno=' . $data['phno'] . '&address=' . $data['address'];

            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

            $data['buyer_report'] = $this->Seller_model->select_filtered_buyer($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();
            $end = $page + $this->pagination->per_page;
            $data['start'] = $page;
            $this->load->view('admin/buyer_report', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function export_buyrreport() {
        $limit = 100;
        $start = $this->uri->segment(4);
        $data['result'] = $this->Seller_model->export_byurreport($limit, $start);
        $this->load->view('admin/export_buyer_report', $data);
    }

    function byrwallet_report() {

        if ($this->session->userdata('logged_in')) {
            $config = array();
            $config["base_url"] = base_url() . "admin/report/byrwallet_report";
            $config["total_rows"] = $this->Seller_model->retrive_byrwallet_count();
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
            $data['byrwallet_report'] = $this->Seller_model->retrieve_byrwallet_report($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();
            $end = $page + $this->pagination->per_page;
            $data['start'] = $page;
            $this->load->view('admin/buyer_wallet_report', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function filter_wallet() {
        if ($this->session->userdata('logged_in')) {
            $data['buyer'] = $_REQUEST['buyer'];
            $data['email'] = $_REQUEST['email'];
            $data['contact'] = $_REQUEST['contact'];

            $config = array();
            $config["base_url"] = base_url() . "admin/report/filter_wallet";
            $config["total_rows"] = $this->Seller_model->select_filter_wallet_count();
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
            $config['suffix'] = '&buyer=' . $data['buyer'] . '&email=' . $data['email'] . '&contact=' . $data['contact'];

            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

            $data['byrwallet_report'] = $this->Seller_model->select_filtered_wallet($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();
            $end = $page + $this->pagination->per_page;
            $data['start'] = $page;
            $this->load->view('admin/buyer_wallet_report', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function export_buyer_wallet() {
        $limit = 30;
        $start = $this->uri->segment(4);
        $data['result'] = $this->Seller_model->export_byurwallet($limit, $start);
        $this->load->view('admin/export_buyer_wallet', $data);
    }

}

?>