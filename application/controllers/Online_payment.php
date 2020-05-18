<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Online_payment extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->library('email');		
		$this->load->helper(array('html','form','url'));
		$this->load->library('form_validation');
		//$this->load->library('email');
		$this->load->library('session');
		$this->load->library('encrypt');
		$this->load->library('javascript');
		$this->load->helper('string');
		$this->load->database();
		$this->load->library('user_agent');
		$this->load->helper('file'); 
		$this->load->model('Order_model');
		
		
	}
	
	function index(){
		if($this->session->userdata['session_data']['user_id']){
			//if($this->session->userdata['session_data']['user_id']==5)
//			{
				$this->load->model('Mycart_model');
				$addtocart_ids=explode('-',$this->session->userdata('sessaddtocart_id_arr'));
			
			$total_price=$this->session->userdata('sesstotal_price');
			
			$seller_id_arr=explode('-',$this->session->userdata('sessseller_id_arr'));
			
			$tax_arr=explode('-',$this->session->userdata('sesstax_arr'));
			
			$shipping_fees_arr=explode('-',$this->session->userdata('sessshipping_fees_arr'));
			
			$sub_total_arr=explode('-',$this->session->userdata('subtotal_arr'));
			
			$price_arr = explode('-',$this->session->userdata('price_arr'));
			
			$qantity_arr=explode('-',$this->session->userdata('sessqantity_arr'));
			
			$sku_arr=explode('*',$this->session->userdata('sesssku_arr'));
			
			$address_id=$this->session->userdata('sesscus_data');
			
			$color_arr = explode('-',$this->session->userdata('color_arr'));
			
			$size_arr = explode('-',$this->session->userdata('size_arr'));
			
			$order_id_payment_gateway=$this->session->userdata('sessccavenue_order_id');
			
			date_default_timezone_set('Asia/Calcutta');
			$dt = preg_replace("/[^0-9]+/","", date('Y-m-d H:i:s'));
			$user_id=$this->session->userdata['session_data']['user_id'];
			
			$order_id_arr=array();
			
			foreach($seller_id_arr as $key=>$value)
			{		
				$order_id_arr[$key]=$user_id.implode('',$addtocart_ids).$dt.$value;
				//$cart['order_id']=$user_id.implode('',explode('-',$this->uri->segment(3))).$dt.$value;
			}
						
			$this->Mycart_model->insert_orderdata_beforecheckout($addtocart_ids,$order_id_arr,$tax_arr,$shipping_fees_arr,$sub_total_arr,$qantity_arr,$sku_arr,$total_price,$seller_id_arr,$address_id,$order_id_payment_gateway,$price_arr,$color_arr,$size_arr);
		
		$order_idstr=implode(',',$order_id_arr);
		$this->session->set_userdata('orderidarr_seesion',$order_id_arr);
		$order_id_payment_gateway=$this->session->userdata('sessccavenue_order_id');
		$order_id_arr=$this->session->userdata('orderidarr_seesion');
		$this->Mycart_model->update_ccavenuedata($order_id_payment_gateway,$order_id_arr);
		
		$result = $this->Mycart_model->inserted_into_checkout_temp();
				
			//}
						
					
			$this->load->view('m/ccavRequestHandler');
				}
			else{
					redirect(base_url());
				}
	
	}
	
					function mail_test()
					{						
						/*$message = "Test mail";									   
						$this->email->set_mailtype("html");
						$this->email->from('santanu@paramountitsolutions.co.in');
						$this->email->to('santanu9337@gmail.com');
						$this->email->subject('Welcome to Moonboy.in');
										
						$this->email->message($message);
						$this->email->send();*/
						
				$data['fname']=$fname = $this->input->post('fname');
				$data['email']=$email = $this->input->post('email_id');
				$data['mob']=$mob = $this->input->post('mob');
				$this->load->view('email_template/career_mail',$data);
												
		
		
    					}
	
	function ccav_response_handler()
	{
		if($this->session->userdata['session_data']['user_id']){
							
			//if($this->session->userdata['session_data']['user_id']==5)
			//{
				$order_id_arr=$this->session->userdata('orderidarr_seesion');
				$sku_arr=explode('*',$this->session->userdata('sesssku_arr'));
				$this->Order_model->update_onlinepaymentinfo($order_id_arr,$sku_arr);
				
			
			//}
//			else	
//			{
//			$addtocart_ids=explode('-',$this->session->userdata('sessaddtocart_id_arr'));
//			
//			$total_price=$this->session->userdata('sesstotal_price');
//			
//			$seller_id_arr=explode('-',$this->session->userdata('sessseller_id_arr'));
//			
//			$tax_arr=explode('-',$this->session->userdata('sesstax_arr'));
//			
//			$shipping_fees_arr=explode('-',$this->session->userdata('sessshipping_fees_arr'));
//			
//			$sub_total_arr=explode('-',$this->session->userdata('subtotal_arr'));
//			
//			$price_arr = explode('-',$this->session->userdata('price_arr'));
//			
//			$qantity_arr=explode('-',$this->session->userdata('sessqantity_arr'));
//			
//			$sku_arr=explode('*',$this->session->userdata('sesssku_arr'));
//			
//			$address_id=$this->session->userdata('sesscus_data');
//			
//			$color_arr = explode('-',$this->session->userdata('color_arr'));
//			
//			$size_arr = explode('-',$this->session->userdata('size_arr'));
//			
//			$order_id_payment_gateway=$this->session->userdata('sessccavenue_order_id');
//			
//			date_default_timezone_set('Asia/Calcutta');
//			$dt = preg_replace("/[^0-9]+/","", date('Y-m-d H:i:s'));
//			$user_id=$this->session->userdata['session_data']['user_id'];
//			
//			$order_id_arr=array();
//			
//			foreach($seller_id_arr as $key=>$value)
//			{		
//				$order_id_arr[$key]=$user_id.implode('',explode('-',$this->uri->segment(3))).$dt.$value;
//				//$cart['order_id']=$user_id.implode('',explode('-',$this->uri->segment(3))).$dt.$value;
//			}
//						
//			$this->Order_model->insert_onlinepayment_orderdata($addtocart_ids,$order_id_arr,$tax_arr,$shipping_fees_arr,$sub_total_arr,$qantity_arr,$sku_arr,$total_price,$seller_id_arr,$address_id,$order_id_payment_gateway,$price_arr,$color_arr,$size_arr);
//			
//			} // condition end for user id 5
			
					redirect('Online_payment/show_my_order_detail/'.implode(',',$order_id_arr));
				}
			else{
					redirect(base_url());
				}
	}
	
	function paytm_response_handler()
	{
		
			if($this->session->userdata['session_data']['user_id']){
							
			
				//$order_id_arr=$this->session->userdata('orderidarr_seesion');
//				$sku_arr=explode('*',$this->session->userdata('sesssku_arr'));
//				$this->Order_model->update_onlinepaymentinfo($order_id_arr,$sku_arr);				
//			
//			
//					redirect('Online_payment/show_my_order_detail/'.implode(',',$order_id_arr));

				redirect(base_url());
				}
			else{
					redirect(base_url());
				}
	}
	
	function manual_ccavenueresponse()
	{
			//$addtocart_ids=explode('-',$this->session->userdata('sessaddtocart_id_arr'));
			$addtocart_ids[]=190;
			
			//$total_price=$this->session->userdata('sesstotal_price');			
			$total_price=199;
			
			//$seller_id_arr=explode('-',$this->session->userdata('sessseller_id_arr'));
			$seller_id_arr[]=19;
			
			//$tax_arr=explode('-',$this->session->userdata('sesstax_arr'));
			$tax_arr[]=9.95;
			
			//$shipping_fees_arr=explode('-',$this->session->userdata('sessshipping_fees_arr'));
			$shipping_fees_arr[]=0;
			
			//$sub_total_arr=explode('-',$this->session->userdata('subtotal_arr'));
			$sub_total_arr=199;
			
			//$price_arr = explode('-',$this->session->userdata('price_arr'));
			$price_arr[]=199;
			
			//$qantity_arr=explode('-',$this->session->userdata('sessqantity_arr'));
			$qantity_arr[]=1;
			
			//$sku_arr=explode('*',$this->session->userdata('sesssku_arr'));
			$sku_arr[]='YOZA-19-KB-BTR-KB5C';
			
			//$address_id=$this->session->userdata('sesscus_data');
			$address_id=92;
			
			//$color_arr = explode('-',$this->session->userdata('color_arr'));
			$color_arr[]='Black';
			
			//$size_arr = explode('-',$this->session->userdata('size_arr'));
			$size_arr[]='not';
			
			//$order_id_payment_gateway=$this->session->userdata('sessccavenue_order_id');
			$order_id_payment_gateway='13818620160817174331';
			
			date_default_timezone_set('Asia/Calcutta');
			$dt = preg_replace("/[^0-9]+/","", date('Y-m-d H:i:s'));
			$user_id=138;
			
			$order_id_arr=array();
			
			foreach($seller_id_arr as $key=>$value)
			{		
				$order_id_arr[$key]=$user_id.'190'.$dt.$value;
				//$cart['order_id']=$user_id.implode('',explode('-',$this->uri->segment(3))).$dt.$value;
			}
						
			//$this->Order_model->manual_online_paymentinfo($addtocart_ids,$order_id_arr,$tax_arr,$shipping_fees_arr,$sub_total_arr,$qantity_arr,$sku_arr,$total_price,$seller_id_arr,$address_id,$order_id_payment_gateway,$price_arr,$color_arr,$size_arr);
	}
	
	
	function show_my_order_detail()
	{
		
		if($this->session->userdata['session_data']['user_id']){
						
			$cart['order_id']=$this->uri->segment(3);
			$order_id_arr=$this->uri->segment(3);
			
			$cart['cart_data']=$this->Order_model->show_myordered_with_payment_detail($order_id_arr);
					
			$cart['cus_data']=$this->Order_model->customer_detail_for_myorder();			
			if ($this->agent->is_mobile())		
			{$this->load->view('m/ccavResponseHandler',$cart);}
			else
			{$this->load->view('ccavResponseHandler',$cart);}
			
		}
		else{
					redirect(base_url());
			}		
		
	}
	
	function ccav_response_handler_revisepayment()
	{
		if($this->session->userdata['session_data']['user_id']){
			
		$order_id_arr=array();
		array_push($order_id_arr,$this->session->userdata('sess_orderid'));	
		
		$order_id=$this->session->userdata('sess_orderid');
		$qnt_arr=explode('-',$this->session->userdata('sess_qntarr'));
		$sku_arr=explode('-',$this->session->userdata('sess_skuarr'));
		$ccavenue_orderid=$this->session->userdata('sess_ccaavenueorderid');       
		$this->Order_model->revise_onlinepayment_orderdata($order_id,$qnt_arr,$sku_arr,$ccavenue_orderid);
		redirect('Online_payment/show_my_order_detail/'.implode(',',$order_id_arr));
		}
		else
		{
			redirect(base_url());
		}
	}
	
	function export_onlinepaymentdata()
	{	$this->load->model('Super_admin_model');	
		$data['result_onlinepay'] = $this->Super_admin_model->select_onlinepaymentdata();
		$this->load->view('admin/exportexcel_onlinepayment_failed',$data);
	}
	
}
?>