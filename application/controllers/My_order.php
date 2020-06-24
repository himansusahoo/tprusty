<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My_order extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
        $this->load->library('form_validation');
        $this->load->library('email');
        
        $this->load->library('upload');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->library('pagination');
        $this->load->library('user_agent');
        
        $this->load->model('Order_model');
        $this->load->model('Usermodel');
    }

    /* function myorder_detail()
      {
      if($this->session->userdata['session_data']['user_id']){

      $addtocart_ids=explode('-',$this->uri->segment(3));

      $total_price=$this->uri->segment(4);

      $seller_id_arr=explode('-',$this->uri->segment(5));

      $tax_arr=explode('-',$this->uri->segment(6));

      $shipping_fees_arr=explode('-',$this->uri->segment(7));

      $sub_total_arr=explode('-',$this->uri->segment(8));

      $qantity_arr=explode('-',$this->uri->segment(9));

      $sku_arr=explode('*',$this->uri->segment(10));

      $address_id=$this->uri->segment(11);

      $price_arr = explode('-',$this->uri->segment(12));
      $color_arr = str_replace('&',' ',explode('-',$this->uri->segment(13)));
      $size_arr = str_replace('&',' ',explode('-',$this->uri->segment(14)));

      
      $dt = preg_replace("/[^0-9]+/","", date('Y-m-d H:i:s'));
      $user_id=$this->session->userdata['session_data']['user_id'];

      $order_id_arr=array();

      foreach($seller_id_arr as $key=>$value)
      {
      $order_id_arr[$key]=$user_id.implode('',explode('-',$this->uri->segment(3))).$dt.$value;

      }


      $this->Order_model->insert_myorderdata($addtocart_ids,$order_id_arr,$tax_arr,$shipping_fees_arr,$sub_total_arr,$qantity_arr,$sku_arr,$total_price,$seller_id_arr,$address_id,$price_arr,$color_arr,$size_arr);

      redirect('my_order/show_my_order_detail/'.implode(',',$order_id_arr));
      }else{
      redirect(base_url());
      }
      } */

    function myorder_detail() {
        if ($this->session->userdata['session_data']['user_id']) {

            $order_id_arr = $this->session->userdata('orderidarr_seesion');
            $sku_arr = explode('*', $this->session->userdata('sesssku_arr'));
            $this->Order_model->update_myorderdata_aftercheckout($order_id_arr, $sku_arr);

            redirect('my_order/show_my_order_detail/' . implode(',', $order_id_arr));
        } else {
            redirect(base_url());
        }
    }

    function myorder_detail_mobile() {
        if ($this->session->userdata['session_data']['user_id']) {



            $addtocart_ids = explode('-', $this->uri->segment(3));

            $total_price = $this->uri->segment(4);

            $seller_id_arr = explode('-', $this->uri->segment(5));

            $tax_arr = explode('-', $this->uri->segment(6));

            $shipping_fees_arr = explode('-', $this->uri->segment(7));

            $sub_total_arr = explode('-', $this->uri->segment(8));

            $qantity_arr = explode('-', $this->uri->segment(9));

            $sku_arr = explode('*', $this->uri->segment(10));

            $address_id = $this->uri->segment(11);

            $price_arr = explode('-', $this->uri->segment(12));
            $color_arr = str_replace('&', ' ', explode('-', $this->uri->segment(13)));
            $size_arr = str_replace('&', ' ', explode('-', $this->uri->segment(14)));

            
            $dt = preg_replace("/[^0-9]+/", "", date('Y-m-d H:i:s'));
            $user_id = $this->session->userdata['session_data']['user_id'];

            $order_id_arr = array();

            foreach ($seller_id_arr as $key => $value) {
                $order_id_arr[$key] = $user_id . implode('', explode('-', $this->uri->segment(3))) . $dt . $value;
            }


            $this->Order_model->insert_myorderdata($addtocart_ids, $order_id_arr, $tax_arr, $shipping_fees_arr, $sub_total_arr, $qantity_arr, $sku_arr, $total_price, $seller_id_arr, $address_id, $price_arr, $color_arr, $size_arr);

            redirect('my_order/show_my_order_detail/' . implode(',', $order_id_arr));
        } else {
            redirect(base_url());
        }
    }

    function myorder_detail_wallet() {
        if ($this->session->userdata['session_data']['user_id']) {

            $addtocart_ids = explode('-', $this->uri->segment(3));

            $total_price = $this->uri->segment(4);

            $seller_id_arr = explode('-', $this->uri->segment(5));

            $tax_arr = explode('-', $this->uri->segment(6));

            $shipping_fees_arr = explode('-', $this->uri->segment(7));

            $sub_total_arr = explode('-', $this->uri->segment(8));

            $qantity_arr = explode('-', $this->uri->segment(9));

            $sku_arr = explode('*', $this->uri->segment(10));

            $address_id = $this->uri->segment(11);

            $price_arr = explode('-', $this->uri->segment(12));
            $color_arr = str_replace('&', ' ', explode('-', $this->uri->segment(13)));
            $size_arr = str_replace('&', ' ', explode('-', $this->uri->segment(14)));

            $deduct_wallet_bal = $this->uri->segment(15);

            
            $dt = preg_replace("/[^0-9]+/", "", date('Y-m-d H:i:s'));
            $user_id = $this->session->userdata['session_data']['user_id'];

            $order_id_arr = array();

            foreach ($seller_id_arr as $key => $value) {
                $order_id_arr[$key] = $user_id . implode('', explode('-', $this->uri->segment(3))) . $dt . $value;
                //$cart['order_id']=$user_id.implode('',explode('-',$this->uri->segment(3))).$dt.$value;
            }

            //$order_id=$this->session->userdata['session_data']['user_id'].implode('',explode('-',$this->uri->segment(3))).$dt;
            $this->Order_model->insert_myorderdata_wallet($addtocart_ids, $order_id_arr, $tax_arr, $shipping_fees_arr, $sub_total_arr, $qantity_arr, $sku_arr, $total_price, $seller_id_arr, $address_id, $price_arr, $color_arr, $size_arr, $deduct_wallet_bal);

            redirect('my_order/show_my_order_detail/' . implode(',', $order_id_arr));
        } else {
            redirect(base_url());
        }
    }

    function show_my_order_detail() {
        if ($this->session->userdata['session_data']['user_id']) {
            $this->load->library('user_agent');

            $cart['order_id'] = $this->uri->segment(3);
            $order_id_arr = $this->uri->segment(3);
            $cart['cart_data'] = $this->Order_model->show_myordered($order_id_arr);
            $cart['cus_data'] = $this->Order_model->customer_detail_for_myorder();

            if ($this->agent->is_mobile()) {

                $this->load->view('m/my_order_detail', $cart);
            } else {
                $this->load->view('my_order_detail', $cart);
            }
        } else {
            redirect(base_url());
        }
    }

    function remove_from_myorder() {
        if ($this->session->userdata['session_data']['user_id']) {

            $addtocart_id = $this->uri->segment(3);
            $order_id = $this->uri->segment(4);

            $this->Order_model->delete_from_myorder($addtocart_id, $order_id);

            redirect('My_order/show_myorders/' . $order_id);
        } else {
            redirect(base_url());
        }
    }

    function show_myorders() {
        if ($this->session->userdata['session_data']['user_id']) {
            $order_id = $this->uri->segment(3);
            $cart['cart_data'] = $this->Order_model->show_myordered($order_id);
            ;
            $cart['cus_data'] = $this->Order_model->customer_detail_for_myorder();
            $this->load->view('my_order_detail', $cart);
        } else {
            redirect(base_url());
        }
    }

    function return_product() {
        if ($this->session->userdata['session_data']['user_id']) {
            $id = base64_decode($this->uri->segment(3));
            $data['sl_id'] = $this->encrypt->decode($id);
            $order_id = base64_decode($this->uri->segment(4));
            $data['order_id'] = $this->encrypt->decode($order_id);
            if ($this->agent->is_mobile()) {
                $this->load->view('m/return_product_form', $data);
            } else {
                $this->load->view('return_product_form', $data);
            }
        } else {
            redirect(base_url());
        }
    }

    function add_return_product() {
        if ($this->session->userdata['session_data']['user_id']) {
            $result = $this->Order_model->insert_return_data();
            if ($result == true) {
                $this->session->set_flashdata('return_req', 'Return Request added successfully');
                redirect('my_order/return_products');
            }
        } else {
            redirect(base_url());
        }
    }

    // Return Product
    function return_products() {
        if ($this->session->userdata['session_data']['user_id']) {
            $data['order_id_result'] = $this->Order_model->retrieve_customer_order_idForReturn();
            //$data['order_id_past_result'] = $this->Usermodel->retrieve_customer_past_order_id();
            if ($this->agent->is_mobile()) {
                $this->load->view('m/my_returns', $data);
            } else {
                $this->load->view('my_returns', $data);
            }
        } else {
            redirect(base_url());
        }
    }

    function generate_return_slip() {
        $order_id['orderid'] = $this->uri->segment(3);
        //$this->load->view('admin/invoice_slip',$order_id);
        $html = $this->load->view('return_slip', $order_id, true);
        $this->load->helper(array('dompdf/dompdf_helper', 'file'));
        pdf_create($html, 'return_slip');
    }

    function clear_checkout_temp_table() {
        $this->Order_model->clear_inn_checkout_temp_table();
    }

    function clear_payment_adjust_temp_data() {
        $this->Order_model->clear_inn_payment_adjust_temp_data();
    }

}
