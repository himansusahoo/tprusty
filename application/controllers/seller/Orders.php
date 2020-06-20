<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('html', 'form', 'url'));
        $this->load->helper('string');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('session');
        $this->load->library('upload');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->database();
        $this->load->model('seller/Orders_model');
        $this->load->helper('date');
        $this->load->library('pagination');
    }

    function index() {
        if ($this->session->userdata('seller-session')) {
            $config = array();
            $config["base_url"] = base_url() . "seller/orders";
            $config["total_rows"] = $this->Orders_model->Activeorder_count();
            $config["per_page"] = 5;
            $config["uri_segment"] = 3;
            //$config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];
            //print_r(round($choice));exit;
            //$config["num_links"] = round($choice);
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';

            $this->pagination->initialize($config);

            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

            $data['new_orders_as_per_orderid1'] = $this->Orders_model->getNewOrdersDetails_as_order_id($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();

            //$data['new_orders'] = $this->Orders_model->getNewOrdersDetails();
            //$data['new_orders_as_per_orderid1'] = $this->Orders_model->getNewOrdersDetails_as_order_id();
            //$data['inTransit_orders'] = $this->Orders_model->getTransitOrdersDetails();
            //$data['delivered_orders'] = $this->Orders_model->getDelieveredOrderDetails();
            $data['courier_info'] = $this->Orders_model->getcourier_Details();
            //$data['count_graceperiod_orderid'] = $this->Orders_model->count_graceperiod_orderidsAs_sellerid();
            //$this->Orders_model->penalty_data_insert();
            $this->load->view('seller/active_orders', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function order_report() {


        if ($this->session->userdata('seller-session')) {

            $data['new_orders_as_per_orderid'] = $this->Orders_model->OrdersDetails_as_order_id();

            $this->load->view('seller/active_order', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function intransist_orders() {
        if ($this->session->userdata('seller-session')) {

            $config = array();
            $config["base_url"] = base_url() . "seller/orders/intransist_orders";
            $config["total_rows"] = $this->Orders_model->intransistorder_count();
            $config["per_page"] = 10;
            $config["uri_segment"] = 3;
            //$config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];
            //print_r(round($choice));exit;
            //$config["num_links"] = round($choice);
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';

            $this->pagination->initialize($config);

            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

            $data['inTransit_orders1'] = $this->Orders_model->getTransitOrdersDetails($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();

            //$data['inTransit_orders1'] = $this->Orders_model->getTransitOrdersDetails();
            $this->load->view('seller/Intransist_order', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function delivered_orders() {
        if ($this->session->userdata('seller-session')) {
            $config = array();
            $config["base_url"] = base_url() . "seller/orders/delivered_orders";
            $config["total_rows"] = $this->Orders_model->Deliveredorder_count();
            $config["per_page"] = 10;
            $config["uri_segment"] = 3;
            //$config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];
            //print_r(round($choice));exit;
            //$config["num_links"] = round($choice);
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';

            $this->pagination->initialize($config);

            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

            $data['delivered_orders1'] = $this->Orders_model->getDelieveredOrderDetails($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();

            //$data['delivered_orders'] = $this->Orders_model->getDelieveredOrderDetails();
            $this->load->view('seller/delivered_orders', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function add_shipment_info() {
        if ($this->session->userdata('seller-session')) {
            $this->load->model('admin/Order_model');
            $order_id = $this->input->post('txtbox_order_no');
            $result = $this->Order_model->check_invoice_id($order_id);
            if ($result == true) {
                $this->Order_model->generate_invoiceid($order_id);
            }
            $reasult = $this->Order_model->insert_shipment_info();
            if ($reasult == true) {
                $data['order_id'] = $order_id;
                $data['shipment_no'] = $this->input->post('txtbox_shipment_number');
                $data['courier_name'] = $this->input->post('courier_name');
                $data['tracking_number'] = $this->input->post('tracking_number');
                $data['shipmnt_data'] = $this->Order_model->retrieve_order_shipment_details($order_id);
                $data['shipment_address_details'] = $this->Order_model->retrieve_order_shipment_address($order_id);
                $data['total_amount_result'] = $this->Order_model->retrieve_order_total_amount($order_id);
                $data['slr_qty_result'] = $this->Order_model->retrieve_slr_qty_data($order_id);
                $to = $data['shipment_address_details']->email;
                //$to='sisir@paramountitsolutions.co.in';
                //$cart['order_id']=$res_email1->order_id;
                $data['user_id'] = $data['shipment_address_details']->user_id;

                $this->email->set_mailtype("html");
                $this->email->from(NO_REPLY_MAIL, DOMAIN_NAME);
                $this->email->to($to);
                $this->email->subject('Order-' . $order_id . ' successfully shipped ');
                //$message=$this->load->view('email_template/shipping_info_buyer',$data,true);
                $this->email->message($this->load->view('email_template/shipping_info_buyer', $data, true));

                //$this->email->send();
                $this->email->send();

                date_default_timezone_set('Asia/Calcutta');
                $dt = date('Y-m-d H:i:s');

                $msg = $this->load->view('email_template/shipping_info_buyer', $data, true);
                if ($this->email->send()) {

                    $email_data = array(
                        'to_email_id' => $to,
                        'from_email_id' => SELLER_MAIL,
                        'date' => $dt,
                        'email_sub' => 'Order-' . $order_id . ' successfully shipped ',
                        'email_content' => $msg,
                        'email_send_status' => 'Success'
                    );
                } else {
                    $email_data = array(
                        'to_email_id' => $to,
                        'from_email_id' => SELLER_MAIL,
                        'date' => $dt,
                        'email_sub' => 'Order-' . $order_id . ' successfully shipped ',
                        'email_content' => $msg,
                        'email_send_status' => 'Failure'
                    );
                }
                $this->db->insert('email_log', $email_data);




                redirect('seller/orders/show_active_orders');
            }
        } else {
            redirect('seller/seller');
        }
    }

    function show_active_orders() {
        if ($this->session->userdata('seller-session')) {

            $config = array();
            $config["base_url"] = base_url() . "seller/orders";
            $config["total_rows"] = $this->Orders_model->Activeorder_count();
            $config["per_page"] = 5;
            $config["uri_segment"] = 3;
            //$config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];
            //print_r(round($choice));exit;
            //$config["num_links"] = round($choice);
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';

            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $data['new_orders_as_per_orderid1'] = $this->Orders_model->getNewOrdersDetails_as_order_id($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();
            $data['courier_info'] = $this->Orders_model->getcourier_Details();

            //$data['new_orders_as_per_orderid1'] = $this->Orders_model->getNewOrdersDetails_as_order_id();
            //$data['new_orders'] = $this->Orders_model->getNewOrdersDetails();
            //$data['inTransit_orders'] = $this->Orders_model->getTransitOrdersDetails();
            //$data['delivered_orders'] = $this->Orders_model->getDelieveredOrderDetails();
            //$data['count_graceperiod_orderid'] = $this->Orders_model->count_graceperiod_orderidsAs_sellerid();

            $this->load->view('seller/active_orders', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function cancelled_orders() {
        if ($this->session->userdata('seller-session')) {
            $data['cancel_order_details'] = $this->Orders_model->getCancelOrderDetails();
            $this->load->view('seller/cancelled_orders', $data);
        } else {
            redirect('seller/seller');
        }
    }

    /* function search_orders_by_orderID(){
      $order_id =  $this->uri->segment(4);
      $data['new_orders'] = $this->Orders_model->getOrdersByOrderID($order_id);
      $this->load->view('seller/active_orders', $data);
      } */

    function search_orders_by_orderID() {
        $order_id = $this->input->post('order_id_input');
        $result = $this->Orders_model->getOrdersByOrderID($order_id);
        if ($result != false) {
            $data['searched_order'] = $result;
            $this->load->view('seller/searched_order_result', $data);
        }
    }

    function change_order_status() {
        $status = urldecode($this->uri->segment(4));
        $order_ids = urldecode($this->uri->segment(5));
        $order_ids = explode(",", $order_ids);
        $result = $this->Orders_model->getUpdateOrderStatus($status, $order_ids);
        if ($result == true) {
            redirect('seller/orders');
        }
    }

    function accept_order() {
        if ($this->session->userdata('seller-session')) {

            $order_id = $this->uri->segment(4);
            $this->Orders_model->order_accept_update($order_id);

            redirect('seller/orders/show_active_orders');


            //$data['new_orders_as_per_orderid1'] = $this->Orders_model->getNewOrdersDetails_as_order_id();
//			
//			$data['courier_info'] = $this->Orders_model->getcourier_Details();
//			$data['count_graceperiod_orderid'] = $this->Orders_model->count_graceperiod_orderidsAs_sellerid();
//			
//			$this->load->view('seller/active_orders', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function add_couriername() {
        if ($this->session->userdata('seller-session')) {

            $rest = $this->Orders_model->insert_courier_name();
            if ($rest) {
                echo "success";
                exit;
            }
        } else {
            redirect('seller/seller');
        }
    }

    function view_graceperiod_requestlist() {

        if ($this->session->userdata('seller-session')) {

            //$data['new_orders'] = $this->Orders_model->getNewOrdersDetails();
            $data['new_orders_as_per_orderid1'] = $this->Orders_model->getNewOrdersDetails_as_order_id();

            $data['count_graceperiod_orderid'] = $this->Orders_model->count_graceperiod_orderidsAs_sellerid();

            $this->load->view('seller/view_graceperiod_request_orderidBySeller', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function request_for_graceperiod() {
        if ($this->session->userdata('seller-session')) {

            $order_ids = urldecode($this->uri->segment(4));

            $order_ids = explode(",", $order_ids);
            $this->Orders_model->UpdateOrder_gracePeriodStatus($order_ids);

            redirect('seller/Orders/view_graceperiod_requestlist');
        } else {
            redirect('seller/seller');
        }
    }

    function request_forgraceperiod() {
        if ($this->session->userdata('seller-session')) {
            $this->Orders_model->Update_Order_gracePeriodStatus();

            redirect('seller/Orders/show_active_orders');
        } else {
            redirect('seller/seller');
        }
    }

    function cancel_order() {
        if ($this->session->userdata('seller-session')) {
            $this->Orders_model->insert_ordercancel_penalty();
            $result = $this->Orders_model->cancel_inn_order();
            if ($result == true) {
                echo "success";
                exit;
            }
        } else {
            redirect('seller/seller');
        }
    }

}

?>