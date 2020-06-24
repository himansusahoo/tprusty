<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_count extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
        $this->load->library('form_validation');
        $this->load->library('email');
        
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->helper('string');
        

        $this->load->model('admin/Order_model');
        $this->load->model('admin/Report_model');
        $this->load->model('admin/Ordercount_cornjobmodel');
    }

    function order_transfer_count() {

        $order_data['transfer_order_data'] = $this->Order_model->count_transfered_order();
        $order_transfercount = count($order_data['transfer_order_data']);

        $this->Ordercount_cornjobmodel->updatecount_transferedorder($order_transfercount);
    }

    function return_order() {

        $order_data['return_orderlist'] = $this->Order_model->returned_ordercount();
        $order_returncount = count($order_data['return_orderlist']);

        $this->Ordercount_cornjobmodel->updatecount_returnorder($order_returncount);
    }

    function replacement_order() {
        $order_data['replacement_orderlist'] = $this->Order_model->replacement_ordercount();
        $order_replacementcount = count($order_data['replacement_orderlist']);

        $this->Ordercount_cornjobmodel->updatecount_replacementorder($order_replacementcount);
    }

    function graceperiod_order() {
        $order_data['graceperiod_request'] = $this->Order_model->count_graceperiodRequest();
        $order_graceperiodcount = count($order_data['graceperiod_request']);

        $this->Ordercount_cornjobmodel->updatecount_graceperiodorder($order_graceperiodcount);
    }

    function seller_payout() {
        $data['payout_result'] = $this->Report_model->retrievePayoutData();
        //$payout_sellercount=count($data['payout_result']);
        $payout_sellercount = $data['payout_result']->num_rows();

        $this->Ordercount_cornjobmodel->updatecount_sellerpayout($payout_sellercount);
    }

    function buyer_refund() {
        $data['buyer_refund'] = $this->Report_model->get_refundlist();
        $refund_buyercount = count($data['buyer_refund']);

        $this->Ordercount_cornjobmodel->updatecount_buyerrefund($refund_buyercount);
    }

}
