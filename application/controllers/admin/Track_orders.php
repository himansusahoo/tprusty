<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Track_orders extends CI_Controller {
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
		$this->load->model('admin/Product');		
		$this->load->helper('file');
		$this->load->model('admin/Track_orders_model'); 
		
	}
	
	function index()
	{
		if($this->session->userdata('logged_in')){
			
		$ordered_data['shipment_list']= $this->Track_orders_model->select_order_data();	
		$ordered_data['couriename_list']= $this->Track_orders_model->select_shipmentinfo();
		
		if($this->session->userdata('logged_in')!=ADMIN_MAIL)
		{
			$this->load->model('admin/User_activity_model');
			$log_data="Access Of In Transit Orders Under Track Orders";
			$this->User_activity_model->insert_user_log($log_data);
		}
		$this->load->view('admin/shipments',$ordered_data);
		}else{
			redirect('admin/super_admin');
		}	
	}
	
	
	function filter_order_intransist()
	{
		if($this->session->userdata('logged_in')){
			
			$ordered_data['shipment_list']= $this->Track_orders_model->filter_order_in_transist();
			$ordered_data['couriename_list']= $this->Track_orders_model->select_shipmentinfo();	
		$this->load->view('admin/shipments',$ordered_data);
			
			}else{
			redirect('admin/super_admin');
		}
			
	}
	
	function delivered_orders_tracking()
	{
		if($this->session->userdata('logged_in')){
			
		$ordered_data['delivered_list']= $this->Track_orders_model->select_delivered_order();
		$ordered_data['couriename_list']= $this->Track_orders_model->select_shipmentinfo();
		
		if($this->session->userdata('logged_in')!=ADMIN_MAIL)
		{
			$this->load->model('admin/User_activity_model');
			$log_data="Access Of Delivered Orders Under Track Orders";
			$this->User_activity_model->insert_user_log($log_data);
		}
		$this->load->view('admin/track_order_delivered',$ordered_data);
		}
		else{
			redirect('admin/super_admin');
		}	
	}
	
	
	function filter_delivered()
	{
		if($this->session->userdata('logged_in')){
			
		$ordered_data['delivered_list']= $this->Track_orders_model->filter_delivered_order();	
		$this->load->view('admin/track_order_delivered',$ordered_data);
		}
		else{
			redirect('admin/super_admin');
		}
	}
	function change_orderstatus()
	{
		
			if($this->session->userdata('logged_in')){
				
				$this->load->model('admin/Order_model');
				$this->Order_model->change_ordertatus();
				
				if($this->session->userdata('logged_in')!=ADMIN_MAIL)
				{
					$this->Order_model->change_ordertatus_log();
				}
				
				$this->Order_model->mail_change_ordertatus();
				echo "success";
				exit;
				
				
				}
		else{
			redirect('admin/super_admin');
		}
			
	}
	
	
	
}