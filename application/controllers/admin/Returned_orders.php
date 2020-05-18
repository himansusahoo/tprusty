<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Returned_orders extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('html','form','url'));
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->library('session');
		$this->load->library('encrypt');
		$this->load->library('javascript');
		$this->load->helper('string');
		$this->load->database();		
		$this->load->helper('file');
		$this->load->model('admin/Returned_order_model'); 
		
	}
	
	function return_in_progress()
	{
		if($this->session->userdata('logged_in')){
			
		$ordered_data['return_data']= $this->Returned_order_model->select_retun_order();
		
		if($this->session->userdata('logged_in')!='admin@moonboy.in')
			{
				$this->load->model('admin/User_activity_model');
				$log_data="Access Of InProgress of Return ";
				$this->User_activity_model->insert_user_log($log_data);
			}
		$this->load->view('admin/return_orders_inprogress',$ordered_data);
		
		}else{
			redirect('admin/super_admin');
		}	
	}
	
	function filter_returned_orders()
	{
		if($this->session->userdata('logged_in')){
			
		$ordered_data['return_data']= $this->Returned_order_model->filter_return_order();	
		$this->load->view('admin/return_orders_inprogress',$ordered_data);
		
		}else{
			redirect('admin/super_admin');
		}	
	}
	
	
	function return_completed()
	{
		if($this->session->userdata('logged_in')){
		$ordered_data['return_data']= $this->Returned_order_model->select_retun_order_complete();
		if($this->session->userdata('logged_in')!='admin@moonboy.in')
		{
			$this->load->model('admin/User_activity_model');
			$log_data="Access Of Return Complete of Orders";
			$this->User_activity_model->insert_user_log($log_data);
		}
		$this->load->view('admin/return_orders_complete',$ordered_data);
		}else{
			redirect('admin/super_admin');
		}		
	}
	
	
	function filter_returned_completed()
	{
		
		if($this->session->userdata('logged_in')){
			
		$ordered_data['return_data']= $this->Returned_order_model->filter_retun_order_complete();	
		$this->load->view('admin/return_orders_complete',$ordered_data);
		
		}else{
			redirect('admin/super_admin');
		}		
	}
}