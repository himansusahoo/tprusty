<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mycart extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('html', 'form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('session');
        $this->load->library('upload');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->library('pagination');
        $this->load->library('user_agent');
        $this->load->database();
        $this->load->helper('string');
        $this->load->model('Mycart_model');
        $this->load->helper('cookie');
        $this->load->model('Usermodel');
        //$this->load->model('Admin_model');
    }

    function mycart_detail() {
        if (@$this->session->userdata['session_data']['user_id']) {
            $product_id = $this->uri->segment(3);
            $sku_id = $this->uri->segment(4);
            $cart['cart_data'] = $this->Mycart_model->show_mycart();
            //$this->load->model('Mycart_model');
            //$cart['new_product_result'] = $this->Usermodel->retrieve_random_product();
            $cart['new_product_result'] = $this->Usermodel->retrieve_product();

            if ($this->agent->is_mobile()) {
                $this->load->view('m/view_mycart', $cart);
            } else {
                $this->load->view('view_mycart', $cart);
            }
        } else {


            //$cart['sku']= (object) $this->session->userdata('addtocart_sku');
            $cart['sku'] = $this->Mycart_model->select_tempcartskuids();
            //$sku_ids['new_product_result'] = $this->Usermodel->retrieve_random_product();
            $prodid = get_cookie('prodid', TRUE);
            if ($prodid != '') {
                $cart['new_product_result'] = $this->Usermodel->retrieve_product();
            } else {
                $cart['new_product_result'] = '';
            }

            if ($this->agent->is_mobile()) {
                $this->load->view('m/view_mycart', $cart);
            } else {
                $this->load->view('view_mycart', $cart);
            }

            //redirect(base_url());
        }
    }

    function insert_detail() {
        if ($this->session->userdata['session_data']['user_id']) {
            //print_r($sku);exit;
            $quantity = $this->input->post('quantity_added');
            $product_id = $this->input->post('product_id');
            $sku = $this->input->post('sku_id');
            $session_id = $this->input->post('session_id');
            $user_id = $this->input->post('user_id');
            $rec_ct = $this->input->post('rec_count');
            $addtocart_id1 = $this->input->post('addtocart_id');
            $master_quantity = $this->input->post('quantity');
            $sl = $this->input->post('sl');

            //print_r($master_quantity);exit;
            if ($quantity < $master_quantity && $rec_ct < $quantity) {


                $cart['cart_data'] = $this->Mycart_model->insert_addtocart_temp_withlogin();
                echo 'success';
                exit;
            }
            if ($quantity > $master_quantity) {

                $this->session->set_flashdata('sl_number', $sl);
                $this->session->set_flashdata('message', 'Not available in stock');
                echo 'success';
                exit;
            }

            if ($rec_ct > $quantity) {
                $cart['cart_data'] = $this->Mycart_model->delete_addtocart_temp_withlogin();
                echo 'success';
                exit;
            }
            //$cart['cart_data']=$this->Mycart_model->show_mycart();
            // redirect('mycart/mycart_detail');
            redirect(base_url());
        }
    }

    function guest_cart_detail() {
        $sku_ids['sku'] = (object) $this->session->userdata('addtocart_sku');
        //$sku_ids['new_product_result'] = $this->Usermodel->retrieve_random_product();
        $prodid = get_cookie('prodid', TRUE);
        if ($prodid != '') {
            $sku_ids['new_product_result'] = $this->Usermodel->retrieve_product();
        } else {
            $sku_ids['new_product_result'] = '';
        }
        if ($this->agent->is_mobile()) {
            $this->load->view('m/view_guestcart', $sku_ids);
        } else {
            $this->load->view('view_guestcart', $sku_ids);
        }
    }

    function remove_from_cart() {
        //if($this->session->userdata['session_data']['user_id']){

        $addtocart_id = $this->uri->segment(3);


        $this->Mycart_model->delete_from_mycart($addtocart_id);

        //$cart['cart_data']=$this->Mycart_model->show_mycart();
//		
//		$cart['new_product_result'] = $this->Usermodel->retrieve_random_product();
//		//$cart['shipping_fee_data']=$this->Mycart_model->retrive_shipping_amount_seller_wise();
//		if ($this->agent->is_mobile())
//		{$this->load->view('m/view_mycart',$cart);}
//		else
//		{$this->load->view('view_mycart',$cart); }
//		}else{
//			redirect(base_url());
//		}
        redirect('mycart/mycart_detail');
    }

    function remove_from_cart_in_final() {
        $addtocart_id = $this->input->post('cart_id');
        $result = $this->Mycart_model->delete_from_mycart_final($addtocart_id);
        if ($result == true) {
            echo 'success';
        }
        /* $cart['cart_data']=$this->Mycart_model->show_mycart();
          $cart['new_product_result'] = $this->Usermodel->retrieve_random_product(); */

        //$this->load->view('view_mycart',$cart);
    }

    function remove_from_tempcart() {
        $sku_id = $this->uri->segment(3);
        $this->Mycart_model->delete_from_tempmycart($sku_id);
        //$prodid=get_cookie('prodid', TRUE);
//		if($prodid!='')
//		{$sku_ids['new_product_result'] = $this->Usermodel->retrieve_random_product1();}else
//		{$sku_ids['new_product_result']='';}
//		
//		$sku_ids['sku']= (object) $this->session->userdata('addtocart_sku');
//		if ($this->agent->is_mobile())
//		{$this->load->view('m/view_guestcart',$sku_ids);}
//		else		
//		{$this->load->view('view_guestcart',$sku_ids);
//		}
        redirect('mycart/mycart_detail');
    }

    function checkout_process() {
        if ($this->session->userdata['session_data']['user_id']) {
            //$this->Mycart_model->insert_into_checkout();
            $cart['cart_data'] = $this->Mycart_model->show_mycart();
            $cart['cus_data'] = $this->Mycart_model->customer_detail_for_checkout();
            $this->load->model('Usermodel');
            $cart['state_result'] = $this->Usermodel->retrive_state();
            $address_result = $this->Usermodel->retrive_user_address();

            /* $this->load->model('Product_descrp_model');
              $user_address_id = $this->Product_descrp_model->retrieve_user_address_id();
              if($user_address_id == 0){
              $cart['shipping_fee_data']=$this->Mycart_model->retrive_national_shipping_amount_seller_wise();
              }else{
              $cart['shipping_fee_data']=$this->Mycart_model->retrive_shipping_amount_seller_wise();
              } */

            if ($address_result != false) {
                $cart['address_result'] = $address_result;
                $this->load->model('Usermodel');
                $cart['state_result'] = $this->Usermodel->retrive_state();

                if ($this->agent->is_mobile()) {
                    $this->load->view('m/checkout', $cart);
                } else {
                    //if($this->session->userdata['session_data']['user_id']!=5)
                    //{
                    $this->load->view('checkout', $cart);
                    //}
                    //else
                    //{
                    //$this->load->view('checkout_test',$cart);	
                    //}
                }
            } else {
                $cart['address_result'] = '';
                if ($this->agent->is_mobile()) {
                    $this->load->view('m/checkout', $cart);
                } else {

                    $this->load->view('checkout', $cart);
                }
            }
        } else {
            redirect(base_url());
        }
    }

    function load_ccavnue() {
        if ($this->session->userdata['session_data']['user_id']) {
            $cart['cart_data'] = $this->Mycart_model->show_mycart();
            $cart['cus_data'] = $this->Mycart_model->customer_detail_for_checkout();


            $order_id_payment_gateway = $this->session->userdata('sessccavenue_order_id');
            $order_id_arr = $this->session->userdata('orderidarr_seesion');
            $this->Mycart_model->update_ccavenuedata($order_id_payment_gateway, $order_id_arr);

            $this->load->model('Usermodel');
            $cart['state_result'] = $this->Usermodel->retrive_state();
            $address_result = $this->Usermodel->retrive_user_address();

            //getting rest payable amount after adjustment program start here
            $cart['rest_payble_amt'] = $this->Mycart_model->getting_rest_payble_amount();
            //getting rest payable amount after adjustment program end here

            if ($address_result != false) {
                $cart['address_result'] = $address_result;
                //if($this->session->userdata['session_data']['user_id']!=5)
//				{
                //$this->load->view('paytm_load',$cart);
                $this->load->view('ccavnue_load', $cart);
                //}
                //else
//				{$this->load->view('ccavnue_loadtest',$cart);} 
            } else {
                $cart['address_result'] = '';
                $this->load->view('ccavnue_load', $cart);
            }
        } else {
            redirect(base_url());
        }
    }

    function load_paytm() {
        if ($this->session->userdata['session_data']['user_id']) {
            $cart['cart_data'] = $this->Mycart_model->show_mycart();
            $cart['cus_data'] = $this->Mycart_model->customer_detail_for_checkout();


            $order_id_payment_gateway = $this->session->userdata('sessccavenue_order_id');
            $order_id_arr = $this->session->userdata('orderidarr_seesion');
            $this->Mycart_model->update_ccavenuedata($order_id_payment_gateway, $order_id_arr);

            $this->load->model('Usermodel');
            $cart['state_result'] = $this->Usermodel->retrive_state();
            $address_result = $this->Usermodel->retrive_user_address();

            //getting rest payable amount after adjustment program start here
            $cart['rest_payble_amt'] = $this->Mycart_model->getting_rest_payble_amount();
            //getting rest payable amount after adjustment program end here

            if ($address_result != false) {
                $cart['address_result'] = $address_result;
                //if($this->session->userdata['session_data']['user_id']!=5)
//				{
                $this->load->view('ccavnue_load', $cart);
                //}
                //else
//				{$this->load->view('ccavnue_loadtest',$cart);} 
            } else {
                $cart['address_result'] = '';
                $this->load->view('ccavnue_load', $cart);
            }
        } else {
            redirect(base_url());
        }
    }

    function insert_into_checkout_temp() {


        $addtocart_ids = explode('-', $this->session->userdata('sessaddtocart_id_arr'));

        $total_price = $this->session->userdata('sesstotal_price');

        $seller_id_arr = explode('-', $this->session->userdata('sessseller_id_arr'));

        $tax_arr = explode('-', $this->session->userdata('sesstax_arr'));

        $shipping_fees_arr = explode('-', $this->session->userdata('sessshipping_fees_arr'));

        $sub_total_arr = explode('-', $this->session->userdata('subtotal_arr'));

        $price_arr = explode('-', $this->session->userdata('price_arr'));

        $qantity_arr = explode('-', $this->session->userdata('sessqantity_arr'));

        $sku_arr = explode('*', $this->session->userdata('sesssku_arr'));

        $address_id = $this->session->userdata('sesscus_data');

        $color_arr = explode('-', $this->session->userdata('color_arr'));

        $size_arr = explode('-', $this->session->userdata('size_arr'));

        $order_id_payment_gateway = $this->session->userdata('sessccavenue_order_id');

        date_default_timezone_set('Asia/Calcutta');
        $dt = preg_replace("/[^0-9]+/", "", date('Y-m-d H:i:s'));
        $user_id = $this->session->userdata['session_data']['user_id'];

        $order_id_arr = array();

        foreach ($seller_id_arr as $key => $value) {
            $order_id_arr[$key] = $user_id . implode('', $addtocart_ids) . $dt . $value;
            //$cart['order_id']=$user_id.implode('',explode('-',$this->uri->segment(3))).$dt.$value;
        }

        $this->Mycart_model->insert_orderdata_beforecheckout($addtocart_ids, $order_id_arr, $tax_arr, $shipping_fees_arr, $sub_total_arr, $qantity_arr, $sku_arr, $total_price, $seller_id_arr, $address_id, $order_id_payment_gateway, $price_arr, $color_arr, $size_arr);

        $order_idstr = implode(',', $order_id_arr);
        $this->session->set_userdata('orderidarr_seesion', $order_id_arr);


        $result = $this->Mycart_model->inserted_into_checkout_temp();
        if ($result == true) {
            echo 'success';
        }
    }

    /* function check_inventory_befor_order(){
      $result = $this->Mycart_model->checkinn_inventory_befor_order();
      } */

    function update_tempprodqnt() {
        $this->Mycart_model->update_tempcartproductqnt();
        echo 'success';
    }

    function pincode_check() {
        $pincode = $this->input->post('pincode');
        $data_cod = $this->Mycart_model->check_codavilstatus($pincode);
        echo $data_cod;
    }

    function prodcod_chargesapply() {
        $data_codchrg = $this->Mycart_model->prodcod_charges();
        echo "COD charges : Rs." . $data_codchrg;
    }

}
