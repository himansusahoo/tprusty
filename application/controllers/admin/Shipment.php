<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipment extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('html','form','url'));
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->library('encrypt');
		$this->load->library('javascript');
		$this->load->library('pagination');
		$this->load->model('admin/Shipment_model');
		$this->load->database();
		
		//$this->load->model('Admin_model');
	}
	
	function index(){
		if($this->session->userdata('logged_in')){
			$data['result'] = $this->Shipment_model->retrive_state();
			$data['admin_state'] = $this->Shipment_model->retrieve_admin_shippment_state_id();
			$data['shipment_result'] = $this->Shipment_model->retrieve_shippment_details();
			$data['national_shipping_result'] = $this->Shipment_model->retrieve_national_shippment_details();
			$data['shippment_type_result'] =  $this->Shipment_model->retrieve_shippment_type();
			$data['flat_shippment_result'] =  $this->Shipment_model->retrieve_flat_shippment();
			$this->load->view('admin/shipment_setting',$data);
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function get_shipping_fee(){
		$flag = $this->input->post('flag');
		if($flag == 1){
			$result = $this->Shipment_model->insert_local_shipping_fee();
			if($result == true){
				echo 'success';exit;
			}
		}
		else if($flag == 2){
			$result = $this->Shipment_model->insert_national_shipping_fee();
			if($result == true){
				echo 'success';exit;
			}else{
				echo 'already exits';
			}
		}
		else if($flag == 3){
			$result = $this->Shipment_model->insert_flat_shipping_fee();
			if($result == true){
				echo 'success';exit;
			}
		}
		else if($flag == 4){
			$result = $this->Shipment_model->insert_free_shipping_fee();
			if($result == true){
				echo 'success';exit;
			}
		}
		
	}
	
	function update_national_shipping_fee(){
		$result = $this->Shipment_model->update_inn_national_shipping_fee();
		if($result == true){
			echo 'success';exit;
		}
	}
	
	function update_local_shipping_fee(){
		$result = $this->Shipment_model->update_inn_local_shipping_fee();
		if($result == true){
			echo 'success';exit;
		}
	}
	
	function update_flat_shipping_fee(){
		$result = $this->Shipment_model->update_inn_flat_shipping_fee();
		if($result == true){
			echo 'success';exit;
		}
	}
	
	function update_shipping_type(){
		$result = $this->Shipment_model->update_inn_shipping_type();
		if($result == true){
			echo 'success';exit;
		}
	}
	

	
}
	