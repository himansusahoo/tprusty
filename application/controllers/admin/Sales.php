<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {
	public function __construct(){
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
		$this->load->model('admin/Order_model');
		$this->load->model('admin/Invoice_model');
		$this->load->model('admin/Shipment_model');
		$this->load->helper('file');
		$this->load->library('pagination');
	}

	function index(){
		if($this->session->userdata('logged_in')){
			$order_data['orderid'] = $this->input->post('order_id');
			$order_data['custname'] = $this->input->post('customer_name');
			$order_data['orderstat'] = $this->input->post('order_status');	
			$order_data['orderdate'] = $this->input->post('order_date_from');
			$order_data['orderdateto'] = $this->input->post('order_date_to');
			$order_data['orderstatmod'] = $this->input->post('status_modified_from');
			$order_data['orderstatmodto'] = $this->input->post('status_modified_to');
			$order_data['order_approve'] = $this->input->post('order_status');
			$order_data['tot_amount']= $this->input->post('tot_amount');
			
			$config = array();
			$config["base_url"] = base_url()."admin/sales";
			$config["total_rows"] = $this->Order_model->retrive_select_order_count();
			$config["per_page"] = 30;
			$config["uri_segment"] = 3;
			//$config['use_page_numbers'] = TRUE;
			$config['page_query_string'] = TRUE;
			$choice = $config["total_rows"] / $config["per_page"];
			
			//$config["num_links"] = round($choice);
			$config["num_links"] = 3;
			$config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
			$config['cur_tag_close'] = '</a>';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Previous';			
			$this->pagination->initialize($config);
			$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;			
			$order_data['order_list']= $this->Order_model->select_orders($config["per_page"], $page);
			$order_data['links'] = $this->pagination->create_links();
			
			//$order_data['statusdata']=$this->Order_model->select_status();
			
			//$order_data['return_orderlist']= $this->Order_model->returned_ordercount();
			//$order_data['replacement_orderlist']= $this->Order_model->replacement_ordercount();
			//$this->Order_model->penalty_data_insert();
			//$order_data['transfer_order_data']=$this->Order_model->count_transfered_order();
			//$order_data['graceperiod_request']=$this->Order_model->count_graceperiodRequest();
			if($this->session->userdata('logged_in')!='admin@moonboy.in')
			{
				$this->load->model('admin/User_activity_model');
				$log_data="Access Of Orders Page";
				$this->User_activity_model->insert_user_log($log_data);
			}
			//$order_data['penalty_list']= $this->Order_model->select_penalty_list();
			$this->load->view('admin/orders',$order_data);
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function penalty_insertby_cornjob()
	{
		$this->Order_model->penalty_data_insert();	
	}
	
	function invoice(){
		if($this->session->userdata('logged_in')){
			
		$invoice_data['invoice_list']= $this->Invoice_model->select_invoices();
		$this->load->view('admin/invoices',$invoice_data);
		}else{
			redirect('admin/super_admin');
		}
	}
	
	//function shipments(){
//		if($this->session->userdata('logged_in')){
//			
//		$shipment_data['shipment_list']= $this->Shipment_model->select_shipment_data();	
//		$this->load->view('admin/shipments',$shipment_data);
//		}else{
//			redirect('admin/super_admin');
//		}
//	}
	
	function credit_memo(){
		if($this->session->userdata('logged_in')){
		$this->load->view('admin/credit_memos');
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function transaction(){
		if($this->session->userdata('logged_in')){
		$this->load->view('admin/transactions');
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function terms_condition(){
		if($this->session->userdata('logged_in')){
		$this->load->view('admin/manage_terms_and_conditions');
		}else{
			redirect('admin/super_admin');
		}
	}
	
	//function addnew_product_form1()
//	{
//		if($this->session->userdata('logged_in')){
//			$this->load->view('admin/add_new_product_form1');
//			}else{
//			redirect('admin/super_admin');
//			}
//			
//	}
//	
//	function addnew_product_form2()
//	{
//		if($this->session->userdata('logged_in')){
//			 
//			$this->Product->insert_product_setting();
//			redirect('admin/Sales/load_addnew_product_form2');
//			
//			
//			}else{
//			redirect('admin/super_admin');
//			}	
//	
//	}
//	
//	function load_addnew_product_form2()
//	{
//		if($this->session->userdata('logged_in')){			 
//			
//			$this->load->view('admin/add_new_product_form2');			
//			
//			}else{
//			redirect('admin/super_admin');
//			}	
//	
//	}
//	
//	
//	
//	
//	function addnew_product_form3()
//	{
//		if($this->session->userdata('logged_in')){
//			$this->load->view('admin/add_new_product_form3');
//			}else{
//			redirect('admin/super_admin');
//			}	
//	
//	}
//	
//	function addnew_product_form4()
//	{
//		if($this->session->userdata('logged_in')){
//			$this->load->view('admin/add_new_product_form4');
//			}else{
//			redirect('admin/super_admin');
//			}	
//	
//	}
	
	function tax()
	{
		if($this->session->userdata('logged_in')){
			
			$msg1['res']=$this->Product->select_tax_list();
			$msg1['res1']=$this->Product->select_taxclass();
			$msg1['res2']=$this->Product->select_triname();
			$msg1['res3']=$this->Product->select_country();
			
			if($this->session->userdata('logged_in')!='admin@moonboy.in')
			{
				$this->load->model('admin/User_activity_model');
				$log_data="Access Of Tax Page";
				$this->User_activity_model->insert_user_log($log_data);
			}
			
			$this->load->view('admin/tax_manage',$msg1);
			}else{
			redirect('admin/super_admin');
			}	
	}
	
	function update_servc_tax(){
		$result = $this->Product->update_inn_servc_tax();
		if($result == true){
			echo 'success';
		}
	}
	
	function addnew_tax_rate()
	{
			if($this->session->userdata('logged_in')){
			$this->load->view('admin/addnew_taxrate');
			}else{
			redirect('admin/super_admin');
			}	
	}
	
	function insertnew_tax_rate()
	{
		if($this->session->userdata('logged_in')){
			
			$res=$this->Product->insert_newtaxrate();
			if($res==true)
			{ 
				
				redirect('admin/Sales/load_after_insert_newtaxrate');
			
			}
			else{
					redirect('admin/Sales/error_after_insert_newtaxrate');
				}
			}else{
			redirect('admin/super_admin');
			}		
	}
	
	function load_after_insert_newtaxrate()
	{
			if($this->session->userdata('logged_in')){
				$msg1['data']="Record saved Successfully";
				
			$msg1['res']=$this->Product->select_tax_list();
			$msg1['res1']=$this->Product->select_taxclass();
			$msg1['res2']=$this->Product->select_triname();
			$msg1['res3']=$this->Product->select_country();
				
			$this->load->view('admin/tax_manage',$msg1);
			}else{
			redirect('admin/super_admin');
			}	
	}
	
	function error_after_insert_newtaxrate()
	{
		
		if($this->session->userdata('logged_in')){
			$this->load->view('admin/addnew_taxrate');
			}else{
			redirect('admin/super_admin');
			}
			
	}
	
	function select_state()
	{
		
			$p['autofilldata']=$this->Product->select_state_data();
			
			$this->load->view('admin/search_state',$p);
	}
	function filter_tax()
	{
			
		if($this->session->userdata('logged_in')){
			
			$msg1['res']=$this->Product->select_filtered_tax_list();
			$msg1['res1']=$this->Product->select_taxclass();
			$msg1['res2']=$this->Product->select_triname();
			$msg1['res3']=$this->Product->select_country();
			
			$this->load->view('admin/tax_manage',$msg1);			
			
			}else{
			redirect('admin/super_admin');
			}	
	}
	
	
	function order_detail_asper_order_id()
	{
		if($this->session->userdata('logged_in')){
			$order_id['orderid']=$this->uri->segment(4);
			$this->load->view('admin/order_detail_asper_orderid',$order_id);
		}else{
			redirect('admin/super_admin');
		}
	}
	
	
	function invoice_detail_asper_order_id()
	{
		if($this->session->userdata('logged_in')){
			$order_id['orderid']=$this->uri->segment(4);
			$this->load->view('admin/invoice_detail_asper_orderid',$order_id) ;
		}else{
			redirect('admin/super_admin');
		}
	}
	
	
	function generate_invoice_id()
	{
		if($this->session->userdata('logged_in')){
				
		$order_id=$this->uri->segment(4);
		//$orderid=$this->uri->segment(4);
		$this->Order_model->generate_invoiceid($order_id);
		
		redirect('admin/Sales/load_order_detail/'.$order_id);
		//$this->load->view('admin/order_detail_asper_orderid',$orderid) ;			
			
			}else{
			redirect('admin/super_admin');
			}
		}
		
		
		function generate_invoice_id1()
	{
					
			$order_id1=$this->uri->segment(4);
			$this->Order_model->generate_invoiceid($order_id1);

			$order_id['orderid']=$this->uri->segment(4);	
			//$this->load->view('admin/invoice_slip',$order_id);
			
			$html=$this->load->view('admin/invoice_slip',$order_id, true) ;
			$this->load->helper(array('dompdf/dompdf_helper', 'file'));
		    pdf_create($html, 'invoice_Slip');	
			
		}
		
		
		
		
		function load_order_detail()
		{
			if($this->session->userdata('logged_in')){
			$orderid['orderid']=$this->uri->segment(4);
			$this->load->view('admin/order_detail_asper_orderid',$orderid) ;
			
			}else{
			redirect('admin/super_admin');
			}
			
				
		}
		
		function generate_packing_slip()
		{
			
				
			$order_id['orderid']=$this->uri->segment(4);		
			
			//$this->load->view('admin/package_slip',$order_id);
			
			$html=$this->load->view('admin/package_slip',$order_id, true) ;
			$this->load->helper(array('dompdf/dompdf_helper', 'file'));
		    pdf_create($html, 'Packing_Slip');

			
			
		}
		
		function generate_invoice_slip()
		{
						
			$order_id['orderid']=$this->uri->segment(4);		
			
			//$this->load->view('admin/invoice_slip',$order_id);
			
			$html=$this->load->view('admin/invoice_slip',$order_id, true) ;
			$this->load->helper(array('dompdf/dompdf_helper', 'file'));
		    pdf_create($html, 'invoice_Slip');
			
		}
		
		
		function generate_invoiceId_with_slip()
		{
				
			
		}
		
		function generate_order_slip()
		{
			
				
			$order_id['orderid']=$this->uri->segment(4);		
			
			//$this->load->view('admin/invoice_slip',$order_id);
			
			$html=$this->load->view('admin/order_slip',$order_id, true) ;
			$this->load->helper(array('dompdf/dompdf_helper', 'file'));
		    pdf_create($html, 'order_Slip');

				
			
		}
		
		function change_order_status()
		{
			if($this->session->userdata('logged_in')){
				
				if($this->session->userdata('logged_in')!='admin@moonboy.in')
				{
					$this->Order_model->change_oderstatus_log();
				}
					$this->Order_model->change_ordertatus();
					$this->Order_model->mail_change_ordertatus();
				
				echo "success";
				exit;
			}else{
			redirect('admin/super_admin');
			}
		}
		
		function change_order_approvestatus()
		{
			if($this->session->userdata('logged_in')){
			
			$this->Order_model->approve_order_by_admin();
			
				echo "success";
				exit;		
				
				}else{
			redirect('admin/super_admin');
			}
				
		}
		
		function change_order_disapprovestatus()
		{
			if($this->session->userdata('logged_in')){
			
			$this->Order_model->disapprove_order_by_admin();
					echo "success";
					exit;	
				
					}else{
			redirect('admin/super_admin');
			}
				
		}
		
		
		function delete_order()
		{
			$result = $this->Order_model->delete_order();
			$this->Order_model->mail_delete_order();
			if($this->session->userdata('logged_in')!='admin@moonboy.in')
			{
				$this->Order_model->delete_order_log();
			}
			if($result == true){
				echo "success";exit;
			}
		}
		
		
		function filter_order()
		{
			if($this->session->userdata('logged_in')){
			$order_data['orderid'] = $_REQUEST['order_id'];	
			$order_data['custname'] = $_REQUEST['customer_name'];
			$order_data['orderstat'] = $_REQUEST['order_status1'];	
			$order_data['orderdate'] = $_REQUEST['order_date_from'];
			$order_data['orderdateto'] = $_REQUEST['order_date_to'];
			$order_data['orderstatmod'] = $_REQUEST['status_modified_from'];
			$order_data['orderstatmodto'] = $_REQUEST['status_modified_to'];
			$order_data['tot_amount'] = $_REQUEST['tot_amount'];
			$order_data['order_approve'] = $_REQUEST['order_status'];
			
			$config = array();
			$config["base_url"] = base_url()."admin/sales/filter_order";
			$config["total_rows"] = $this->Order_model->select_filter_orders_count();
			$config["per_page"] = 30;
			$config["uri_segment"] = 3;
			$config["page_query_string"] = TRUE;
			$config['enable_query_strings'] = TRUE;
			$config['reuse_query_string'] = TRUE;
			$choice = $config["total_rows"] / $config["per_page"];
			//$config["num_links"] = round($choice);
			$config["num_links"] = 3;
			$config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
			$config['cur_tag_close'] = '</a>';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Previous';
			$config['suffix'] ='&order_id='.$order_data['orderid'].'&customer_name='.$order_data['custname'].'&order_status1='.$order_data['orderstat'].'&order_date_from='.$order_data['orderdate'].'&order_date_to='.$order_data['orderdateto'].'&status_modified_from='.$order_data['orderstatmod'].'&status_modified_to='.$order_data['orderstatmodto'].'&tot_amount='.$order_data['tot_amount'].'&order_status='.$order_data['order_approve'];
			
			$this->pagination->initialize($config);
			$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
			
			$order_data['order_list']= $this->Order_model->select_filtered_orders($config["per_page"], $page);
			$order_data['links'] = $this->pagination->create_links();
			
			$this->load->view('admin/orders',$order_data);
		
		}else{
			redirect('admin/super_admin');
		}
				
		}
		function add_shipment_info()
		{
			if($this->session->userdata('logged_in')){
				$order_id=$this->input->post('txtbox_order_no');
				$result = $this->Order_model->check_invoice_id($order_id);
				if($result == true){
					$this->Order_model->generate_invoiceid($order_id);
				}				
				$this->Order_model->insert_shipment_info();				
				redirect('admin/sales/show_orders');	
			}else{
				redirect('admin/super_admin');
			}
		}
	
	function show_orders()
	{
		if($this->session->userdata('logged_in')){
			$order_data['orderid'] = $this->input->post('order_id');	
			$order_data['custname'] = $this->input->post('customer_name');
			$order_data['orderstat'] = $this->input->post('order_status1');	
			$order_data['orderdate'] = $this->input->post('order_date_from');
			$order_data['orderdateto'] = $this->input->post('order_date_to');
			$order_data['orderstatmod'] = $this->input->post('status_modified_from');
			$order_data['orderstatmodto'] = $this->input->post('status_modified_to');
			//$order_data['order_list']= $this->Order_model->select_orders();
			$order_data['order_list']= $this->Order_model->select_transferorders();
			
			//$order_data['return_orderlist']= $this->Order_model->returned_ordercount();
			//$order_data['transfer_order_data']=$this->Order_model->count_transfered_order();
			//$order_data['replacement_orderlist']= $this->Order_model->replacement_ordercount();
			//$order_data['graceperiod_request']=$this->Order_model->count_graceperiodRequest();
			$this->load->view('admin/orders',$order_data);		
		}
		else{
			redirect('admin/super_admin');
		}
	}
	
	function set_order_undeliver()
	{
		if($this->session->userdata('logged_in')){
			
			$order_id=$this->uri->segment(4);
			$this->Order_model->set_status_as_undelivered($order_id);
			
			redirect('admin/sales/show_orders');
			
			
		}
		else{
			redirect('admin/super_admin');
		}
	}
	
	
	function set_order_confirm()
	{
		if($this->session->userdata('logged_in')){
			
			//$order_id=$this->uri->segment(4);
			
			$this->Order_model->confirm_order_by_admin();
			
			if($this->session->userdata('logged_in')!='admin@moonboy.in')
			{
				
				$this->Order_model->confirm_order_by_admin_log();
			}
			
			
			redirect('admin/sales');
			
			}
		else{
			redirect('admin/super_admin');
		}
			
	}
	
	function set_hold_order()
	{
		if($this->session->userdata('logged_in')){
			
			//$order_id=$this->uri->segment(4);
			
			$this->Order_model->hold_order_by_admin();
			
			
			if($this->session->userdata('logged_in')!='admin@moonboy.in')
			{
				$this->Order_model->hold_order_by_admin_log();
			}
			
			redirect('admin/sales');
			
			}
		else{
			redirect('admin/super_admin');
		}
			
	}
	
	
	
	function  view_penalty_detail()
	{
		if($this->session->userdata('logged_in')){
			
			//$penalty['penalty_notpaid_data']=$this->Order_model->select_penalty_list();
			
			$penalty['penalty_data']=$this->Order_model->view_penaltypaid_list();
			
			$this->load->view('admin/penalty_detail',$penalty);
			
			}
		else{
			redirect('admin/super_admin');
		}
	}
	
	function view_order_transfer_list()
	{
		
		if($this->session->userdata('logged_in')){
			
			$order_data['orderid'] = $this->input->post('order_id');
			$order_data['custname'] = $this->input->post('customer_name');
			$order_data['orderstat'] = $this->input->post('order_status');	
			$order_data['orderdate'] = $this->input->post('order_date_from');
			$order_data['orderdateto'] = $this->input->post('order_date_to');
			$order_data['orderstatmod'] = $this->input->post('status_modified_from');
			$order_data['orderstatmodto'] = $this->input->post('status_modified_to');
			//$order_data['statusdata']=$this->Order_model->select_status();
			//$order_data['order_list']= $this->Order_model->select_orders();
			$order_data['order_list']= $this->Order_model->select_transferorders();
		
			
			$order_data['transfer_order_data']=$this->Order_model->count_transfered_order();
			
			//$order_data['penalty_list']= $this->Order_model->select_order_transfer_list();
			$this->load->view('admin/transfer_order_list',$order_data);	
		}else{
			redirect('admin/super_admin');
		}
			
	}
	
	function add_order_transferinfo()
	{
		if($this->session->userdata('logged_in')){
		
		$trans_order_id=$this->uri->segment(4);
		$seller_id_trans=$this->uri->segment(5);
		$transfer_order['trans_productdata']=$this->Order_model->select_transOrder_relatedseller($trans_order_id,$seller_id_trans);
		$transfer_order['trans_orderid']=$trans_order_id;
		
		//pma($transfer_order,1);
		$this->load->view('admin/transfer_order',$transfer_order);	
		
		
		
		}else{
			redirect('admin/super_admin');
		}	
	}
	
	function reassign_order()
	{
		if($this->session->userdata('logged_in')){
			
			$sku_arr_trans=$this->input->post('chek_sku');
			$productid_arr_trans=$this->input->post('product_id');
			$userid_arr_trans=$this->input->post('user_id');
			$buyerqnt_arr_trans=$this->input->post('buyer_qnt');
			$fixedcharge_arr_trans=$this->input->post('chk_fixedprice');
			$old_orderid=$this->input->post('old_order_id');
			
			
			$dtm = str_replace(" ","-",date('Y-m-d H:i:s'));
			$addtocarttemp_session_id=random_string('alnum', 16).$dtm;
		
		//$this->Order_model->reassign_order_Toseller();
		
		$this->Order_model->reassign_order_Toseller1($sku_arr_trans,$productid_arr_trans,$addtocarttemp_session_id,$userid_arr_trans,$fixedcharge_arr_trans,$buyerqnt_arr_trans,$old_orderid);
		
		if($this->session->userdata('logged_in')!='admin@moonboy.in')
		{
			$this->Order_model->reassign_order_Toseller1_log($old_orderid);
		
		}
			
		redirect('admin/sales/show_orderstransferlist');
		
		}else{
			redirect('admin/super_admin');
		}	
		
	}
	
	function show_orderstransferlist()
	{
		
		if($this->session->userdata('logged_in')){
			
			$order_data['orderid'] = $this->input->post('order_id');
			$order_data['custname'] = $this->input->post('customer_name');
			$order_data['orderstat'] = $this->input->post('order_status');	
			$order_data['orderdate'] = $this->input->post('order_date_from');
			$order_data['orderdateto'] = $this->input->post('order_date_to');
			$order_data['orderstatmod'] = $this->input->post('status_modified_from');
			$order_data['orderstatmodto'] = $this->input->post('status_modified_to');
			//$order_data['statusdata']=$this->Order_model->select_status();
			//$order_data['order_list']= $this->Order_model->select_orders();
			
			$order_data['order_list']= $this->Order_model->select_transferorders();
			
			//$this->Order_model->penalty_data_insert();
			
			$order_data['transfer_order_data']=$this->Order_model->count_transfered_order();
			
			//$order_data['penalty_list']= $this->Order_model->select_order_transfer_list();
			$this->load->view('admin/transfer_order_list',$order_data);	
		}else{
			redirect('admin/super_admin');
		}
		
		
			
	}
	
	function cancel_transfered_order()
	{
		if($this->session->userdata('logged_in')){
			
		$old_orderid=$this->uri->segment(4);
		
		$this->Order_model->transfreed_ordercancel($old_orderid);
		
		
		if($this->session->userdata('logged_in')!='admin@moonboy.in')
		{
			$this->Order_model->transfreed_ordercancel_log($old_orderid);	
		}
		
		redirect('admin/sales/show_orderstransferlist');
		}else{
			redirect('admin/super_admin');
		}		
		
	}
	
	function view_returnrequested_list()
	{
		if($this->session->userdata('logged_in')){
		$returnorder_data['return_orderlist']= $this->Order_model->returned_ordercount();	
		$this->load->view('admin/return_orderlistfor_approve',$returnorder_data);
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function return_request_approve()
	{
		if($this->session->userdata('logged_in')){
		$order_id=$this->uri->segment(4);
		$this->Order_model->returned_order_approve($order_id);
		if($this->session->userdata('logged_in')!='admin@moonboy.in')
		{
			$this->Order_model->returned_order_approve_log($order_id);
		}
		$returnorder_data['return_orderlist']= $this->Order_model->returned_ordercount();	
		$this->load->view('admin/return_orderlistfor_approve',$returnorder_data);
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function return_request_denied(){
		if($this->session->userdata('logged_in')){
			$order_id=$this->uri->segment(4);
			$this->Order_model->returned_order_denied($order_id);
			$returnorder_data['return_orderlist']= $this->Order_model->returned_ordercount();
			$this->load->view('admin/return_orderlistfor_approve',$returnorder_data);
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function view_request_detail()
	{
		if($this->session->userdata('logged_in')){
			
		$order_id=$this->uri->segment(4);	
		$returndetail_as_orderid['return_info']=$this->Order_model->retrun_orderinfo_as_order_id($order_id);
		
		$returndetail_as_orderid['order_id']=$order_id;
		
		$this->load->view('admin/view_return_order_detail',$returndetail_as_orderid);
				
		}else{
			redirect('admin/super_admin');
		}
	
	}
	
	
	function view_replacement_list()
	{
		if($this->session->userdata('logged_in')){
		
		
		$order_replacement['order_refundlist']=$this->Order_model->replacement_ordercount();
		
		$this->load->view('admin/view_replacement_orderlist',$order_replacement);
		
		}else{
			redirect('admin/super_admin');
		}
	
	}
	
	function add_order_replacementinfo()
	{
		
		if($this->session->userdata('logged_in')){
		
		$replace_order_id=$this->uri->segment(4);
		
		$replace_order['replace_productdata']=$this->Order_model->select_refundOrder_relatedseller($replace_order_id);
		$replace_order['replace_orderid']=$replace_order_id;
		
		
		$this->load->view('admin/replacement_order',$replace_order);	
		
		
		
		}else{
			redirect('admin/super_admin');
		}
			
	}
	
	
	function reassign_order_replacement()
	{
		if($this->session->userdata('logged_in')){
			
			$sku_arr_trans=$this->input->post('chek_sku');
			$productid_arr_trans=$this->input->post('product_id');
			$userid_arr_trans=$this->input->post('user_id');
			$buyerqnt_arr_trans=$this->input->post('buyer_qnt');
			$fixedcharge_arr_trans=$this->input->post('chk_fixedprice');
			$old_orderid=$this->input->post('old_order_id');
			
			
			$dtm = str_replace(" ","-",date('Y-m-d H:i:s'));
			$addtocarttemp_session_id=random_string('alnum', 16).$dtm;
			
			
		
		$this->Order_model->reassign_orderReplace_Toseller($sku_arr_trans,$productid_arr_trans,$addtocarttemp_session_id,$userid_arr_trans,$fixedcharge_arr_trans,$buyerqnt_arr_trans,$old_orderid);
			
		redirect('admin/sales/view_replacement_list');
		
		}else{
			redirect('admin/super_admin');
		}	
	}
	
	function view_graceperiodrequest_list()
	{
		if($this->session->userdata('logged_in')){
			
			$data['grc_periodrqst_list']=$this->Order_model->grace_period_request_list();
			
			$this->load->view('admin/view_graceperiod_requestList',$data);
			
			}else{
			redirect('admin/super_admin');
		}
			
	
	}
	
	function approve_graceperiod()
	{
		if($this->session->userdata('logged_in')){
			
		$order_id=$this->uri->segment(4);
		
		$this->Order_model->approve_grace_period($order_id);
		redirect('admin/sales/view_graceperiodrequest_list');
		
		}else{
			redirect('admin/super_admin');
			
		}
	}
	
	function graceperiod_deny()
	{
		if($this->session->userdata('logged_in')){
				
			$order_id=$this->uri->segment(4);
		
			$this->Order_model->update_graceperiod_as_deny($order_id);
			redirect('admin/sales/view_graceperiodrequest_list');	
		}else{
				redirect('admin/super_admin');
				
			}
	
	}
	
	function transfer_to_wallet()
	{
		if($this->session->userdata('logged_in')){
			
			$order_id=$this->uri->segment(4);
			$user_id=$this->uri->segment(5);
			$totrefund_amt=$this->uri->segment(6);
			
			$this->Order_model->transferTo_wallet($order_id,$user_id,$totrefund_amt);
			
			$this->load->model('admin/Report_model');
			$data_buyerefund['buyer_refund'] = $this->Report_model->get_refundlist();			
			$this->load->view('admin/buyer_refundlist',$data_buyerefund);
		
		}else{
			redirect('admin/super_admin');
			
		}
			
	}
	
	
		
}

?>