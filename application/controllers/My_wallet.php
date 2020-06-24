<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_wallet extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
        $this->load->library('form_validation');
        $this->load->library('email');
        
        $this->load->library('upload');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->library('pagination');
        $this->load->library('user_agent');
        
        $this->load->model('My_wallet_model');
    }

    function index() {
        if ($this->session->userdata['session_data']['user_id']) {
            $wallet['walet_info'] = $this->My_wallet_model->select_wallet_data();
            $wallet_user_id = $this->session->userdata['session_data']['user_id'];
            $this->load->model('admin/Report_model');
            $wallet['wallet_info'] = $this->Report_model->walletdetail_as_user_id($wallet_user_id);
            $wallet['purchase_bywallet_info'] = $this->Report_model->purchased_by_wallet($wallet_user_id);
            if ($this->agent->is_mobile()) {
                $this->load->view('m/view_mywallet', $wallet);
            } else {
                $this->load->view('view_mywallet', $wallet);
            }
        } else {
            redirect(base_url());
        }
    }

    function deduct_from_wallet() {
        if ($this->session->userdata['session_data']['user_id']) {
            $result = $this->My_wallet_model->adjust_wallet_bal_to_shopping();
            /* if($result == true){
              echo $result;
              }
              if($result === false){
              echo 'Invalid';
              } */
        } else {
            redirect(base_url());
        }
    }

    function gift_voucher() {
        if ($this->session->userdata['session_data']['user_id']) {
            $data['gfv_result'] = $this->My_wallet_model->retrieve_gift_voucher();
            if ($this->agent->is_mobile()) {
                $this->load->view('m/gift_voucher', $data);
            } else {
                $this->load->view('gift_voucher', $data);
            }
        } else {
            redirect(base_url());
        }
    }

    function shop_from_voucher() {
        if ($this->session->userdata['session_data']['user_id']) {
            $result = $this->My_wallet_model->adjust_voucher_to_shopping();
            if (is_array($result)) {
                $data['result'] = $result;
                $this->load->view('ajx_voucher_list', $data);
            } else {
                echo $result;
            }
        } else {
            redirect(base_url());
        }
    }

    function shop_from_coupon() {
        if ($this->session->userdata['session_data']['user_id']) {
            $result = $this->My_wallet_model->adjust_coupon_to_shopping();
            if (is_array($result)) {
                $data['result'] = $result;
                $this->load->view('ajx_coupon_list', $data);
            } else {
                echo $result;
            }
        } else {
            redirect(base_url());
        }
    }

    function calculate_adjustment() {
        $result = $this->My_wallet_model->calculating_adjustment();
        if ($result != false) {
            echo $result;
        } else {
            echo 'NOT';
        }
    }

    function calculate_total_adjustment_n_without_wallet() {
        $result = $this->My_wallet_model->calculating_total_adjustment_n_without_wallet();
        if ($result != false) {
            echo $result;
        } else {
            echo 'NOT';
        }
    }

    function get_adj_wllt_amount() {
        $result = $this->My_wallet_model->getting_adj_wllt_amount();
        echo $result;
    }

}

?>