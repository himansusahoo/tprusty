<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seller_shipment extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('html','form','url'));
		$this->load->helper('string');
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->library('encrypt');
		$this->load->library('javascript');
		$this->load->library('pagination');
		$this->load->database();
		$this->load->model('seller/Seller_shipment_model');
	}

	public function index(){
		if($this->session->userdata('seller-session')){
			$data['result'] = $this->Seller_shipment_model->retrive_state();
			$data['seller_state'] = $this->Seller_shipment_model->retrieve_seller_shippment_state_id();
			$data['local_shipment_result'] = $this->Seller_shipment_model->retrieve_seller_shippment_details();
			$data['national_shipping_result'] = $this->Seller_shipment_model->retrieve_national_shippment_details();
			$data['shippment_type_result'] =  $this->Seller_shipment_model->retrieve_shippment_type();
			$data['flat_shippment_result'] =  $this->Seller_shipment_model->retrieve_flat_shippment();
			$this->load->view('seller/product_shipping_fee_form', $data);
		}else{
			redirect('seller/seller');
		}
	}
	function add_shipping_fee(){
		$flag = $this->input->post('flag');
		if($flag == 1){
			$result = $this->Seller_shipment_model->insert_local_shipping_fee();
			if($result == true){
				echo 'success';exit;
			}
		}
		else if($flag == 2){
			$result = $this->Seller_shipment_model->insert_national_shipping_fee();
			if($result == true){
				echo 'success';exit;
			}else{
				echo 'already exits';
			}
		}
		else if($flag == 3){
			$result = $this->Seller_shipment_model->insert_flat_shipping_fee();
			if($result == true){
				echo 'success';exit;
			}
		}
		else if($flag == 4){
			$result = $this->Seller_shipment_model->insert_free_shipping_fee();
			if($result == true){
				echo 'success';exit;
			}
		}
	}
	function update_national_shipping_fee(){
		$result = $this->Seller_shipment_model->update_inn_national_shipping_fee();
		if($result == true){
			echo 'success';exit;
		}
	}
	function update_local_shipping_fee(){
		$result = $this->Seller_shipment_model->update_inn_local_shipping_fee();
		if($result == true){
			echo 'success';exit;
		}
	}
	function update_flat_shipping_fee(){
		$result = $this->Seller_shipment_model->update_inn_flat_shipping_fee();
		if($result == true){
			echo 'success';exit;
		}
	}
	
	
}