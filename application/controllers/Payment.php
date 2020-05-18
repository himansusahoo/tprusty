<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('html','form','url'));
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->library('session');
		$this->load->library('encrypt');
		$this->load->library('javascript');
		$this->load->library('upload');
		$this->load->database();
		$this->load->library('pagination');
		$this->load->model('admin/Report_model');
	}
	
	function index(){
		if($this->session->userdata('logged_in')){
			$data['payout_result'] = $this->Report_model->retrievePayoutData();
			$this->load->view('admin/payment_pg',$data);
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function update_settelment_discount(){
		$result = $this->Report_model->update_inn_settelment_discount();
		if($result == true){
			echo 'success';
		}
	}
	
	function update_transaction_data(){
		$result = $this->Report_model->update_inn_transaction_data();
		if($result == true){
			$this->session->set_flashdata('succ_msg', 'Payout Generated successfully !');
			redirect('admin/payment');
		}
	}
	
	function download_excel(){
		//$parm = $this->uri->segment(3);
		if($this->session->userdata('logged_in')){
			$data['payout_result'] = $this->Report_model->retrievePayoutData();
			$this->load->view('admin/payment_pg',$data);
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function seller_payout(){
		if($this->session->userdata('logged_in')){
			$data['slr_payout_result'] = $this->Report_model->retrieve_seller_payout();
			$this->load->view('admin/slr_payout_pg',$data);
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function seller_all_payout(){
		if($this->session->userdata('logged_in')){
			$data['slr_payout_result'] = $this->Report_model->retrieve_seller_all_payout();
			$this->load->view('admin/slr_payout_report_pg',$data);
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function seller_payout_datewise(){
		if($this->session->userdata('logged_in')){
			$data['slr_payout_result'] = $this->Report_model->retrieve_seller_payout_datewise();
			$this->load->view('admin/slr_payout_pg',$data);
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function seller_all_payout_datewise(){
		if($this->session->userdata('logged_in')){
			$data['slr_payout_result'] = $this->Report_model->retrieve_seller_all_payout_datewise();
			$this->load->view('admin/slr_payout_report_pg',$data);
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function update_utr_no(){
		if($this->session->userdata('logged_in')){
			$result = $this->Report_model->update_inn_utr_no();
			if($result == true){
				redirect('admin/payment/seller_payout');
			}
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function payout_excel_report(){
		if($this->session->userdata('logged_in')){
			$data['result'] = $this->Report_model->getPayoutExcel();
			$this->load->view('admin/payout_gen',$data);	
		}else{
			redirect('admin/super_admin');
		}	
	}
	
	function slr_payout_excel_report(){
		if($this->session->userdata('logged_in')){
			$data['result'] = $this->Report_model->getSellerPayoutExcel();
			$this->load->view('admin/slr_payout_gen',$data);	
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function buyer_refund()
	{
		if($this->session->userdata('logged_in')){
			
			$data_buyerefund['buyer_refund'] = $this->Report_model->get_refundlist();
			$this->load->view('admin/buyer_refundlist',$data_buyerefund);
			
			}else{
			redirect('admin/super_admin');
		}
			
	}
	
	function export_to_excel()
	{
		if($this->session->userdata('logged_in')){
			
			$order_id_arr=explode(',',$this->uri->segment(4));
			
			
			$data_buyerefund['buyer_refund'] = $this->Report_model->get_refundlist_forExcel($order_id_arr);
			$this->load->view('admin/buyer_RefundExcelReport',$data_buyerefund);
			
			
			}else{
			redirect('admin/super_admin');
		}
		
		
			
	}
	
	
}
?>