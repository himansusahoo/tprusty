<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Returns extends CI_Controller {
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
		$this->load->database();
		$this->load->model('seller/Returns_model');
	}

	function index(){
		if($this->session->userdata('seller-session')){
			$data['result'] = $this->Returns_model->getReturnRequestedDetails();
			$data['result1'] = $this->Returns_model->getReturnCompletedDetails();
			$this->load->view('seller/returns', $data);
		}else{
			redirect('seller/seller');
		};
	}
	
	
	function returned_order(){
		if($this->session->userdata('seller-session')){
			$data['result'] = $this->Returns_model->ReturnRequestedDetails();
			$this->load->view('seller/returnorder_report', $data);
		}else{
			redirect('seller/seller');
		};
	}
	
	function disputes(){
		if($this->session->userdata('seller-session')){
			$this->load->view('seller/disputes');
		}else{
			redirect('seller/seller');
		};
	}
	
	function change_return_status(){
		if($this->session->userdata('seller-session')){
			$status =  urldecode($this->uri->segment(4));
			$order_ids =  urldecode($this->uri->segment(5)); 
			$order_ids = explode(",", $order_ids);  
			$result = $this->Returns_model->getUpdateReturnStatus($status, $order_ids); 
			if($result == true){
				redirect('seller/returns');
			}
		}else{
			redirect('seller/seller');
		};	
	}
	
}


?>