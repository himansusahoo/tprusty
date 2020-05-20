<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Sellers extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$this->load->helper(array('html','form','url'));

		$this->load->library('form_validation');

		$this->load->library('email');

		$this->load->library('session');

		$this->load->helper('string');
		
		$this->load->library('upload');

		$this->load->library('encrypt');

		$this->load->library('javascript');

		$this->load->database();

		$this->load->model('admin/Seller_model');
		
		$this->load->model('seller/Catalog_model');
		
		$this->load->library('pagination');

	}



	function index(){

		if($this->session->userdata('logged_in')){

			$data['seller_from'] = $this->input->post('seller_id_from');

			$data['seller_to'] = $this->input->post('seller_id_to');			

			$data['name1'] = $this->input->post('name1');

			$data['phone'] = $this->input->post('phone');

			$data['reg_date_from'] = $this->input->post('reg_date_from');

			$data['reg_date_to'] = $this->input->post('reg_date_to');

			$data['state'] = $this->input->post('state');

			$data['city'] = $this->input->post('city');	

			$data['email'] = $this->input->post('email');

			$data['approval_from'] = $this->input->post('approval_from');

			$data['approval_to'] = $this->input->post('approval_to');

			$data['seller_status'] = $this->input->post('seller_status');

			

			$config = array();

			$config["base_url"] = base_url()."admin/Sellers";

			$config["total_rows"] = $this->Seller_model->getSellersForAdminListcount();

			$config["per_page"] = 20;

			$config["uri_segment"] = 3;

			//$config['use_page_numbers'] = TRUE;

			$config['page_query_string'] = TRUE;

			$choice = $config["total_rows"] / $config["per_page"];

			//print_r(round($choice));exit;

			//$config["num_links"] = round($choice);

			$config["num_links"] = 3;

			$config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';

			$config['cur_tag_close'] = '</a>';

			$config['next_link'] = 'Next';

			$config['prev_link'] = 'Previous';

			

			$this->pagination->initialize($config);

			$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

			

			$data['sellers'] = $this->Seller_model->getSellersForAdminList($config["per_page"], $page);

			$data['links'] = $this->pagination->create_links();

			

			$this->load->view('admin/sellers', $data);

		}else{

			redirect('admin/super_admin');

		}

	}
	
	function seller_porfile()
	{
		if($this->session->userdata('logged_in')){
		
			$data['seller_from'] = $this->input->post('seller_id_from');
			$data['seller_to'] = $this->input->post('seller_id_to');
			$data['name1'] = $this->input->post('name1');
			$data['phone'] = $this->input->post('phone');
			$data['reg_date_from'] = $this->input->post('reg_date_from');
			$data['reg_date_to'] = $this->input->post('reg_date_to');
			$data['state'] = $this->input->post('state');
			$data['city'] = $this->input->post('city');	
			$data['email'] = $this->input->post('email');
			$data['approval_from'] = $this->input->post('approval_from');
			$data['approval_to'] = $this->input->post('approval_to');
			$data['seller_status'] = $this->input->post('seller_status');			

			$config = array();
			$config["base_url"] = base_url()."admin/sellers/seller_porfile";
			$config["total_rows"] = $this->Seller_model->getSellersForAdminListcount();
			$config["per_page"] = 20;
			$config["uri_segment"] = 3;
			//$config['use_page_numbers'] = TRUE;

			$config['page_query_string'] = TRUE;
			$config['enable_query_strings'] = TRUE;
			$config['reuse_query_string'] = TRUE;
			$choice = $config["total_rows"] / $config["per_page"];
			//print_r(round($choice));exit;
			//$config["num_links"] = round($choice);
			$config["num_links"] = 3;
			$config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
			$config['cur_tag_close'] = '</a>';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Previous';			

			$this->pagination->initialize($config);

			$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
			$data['sellers'] = $this->Seller_model->getSellersForAdminList($config["per_page"], $page);
			$data['links'] = $this->pagination->create_links();			

			$this->load->view('admin/sellers_profile', $data);
		
		
		}else{

			redirect('admin/super_admin');
		}	
				
	}

	

	function seller_details(){

		if($this->session->userdata('logged_in')){

			$id['seller_id']=$this->uri->segment(4);

			$this->load->view('admin/seller_details', $id);

		}else{

			redirect('admin/super_admin');

		}

	}
	
	function sellerprofile_details(){

		if($this->session->userdata('logged_in')){

			$id['seller_id']=$this->uri->segment(4);

			$this->load->view('admin/sellerprofile_details', $id);

		}else{

			redirect('admin/super_admin');

		}

	}

	

	/*function filter_sellers_data()

	{

		if($this->session->userdata('logged_in')){

			

			$data['sellers'] = $this->Seller_model->filter_sellers_data();

			$this->load->view('admin/sellers', $data);

		}else{

			redirect('admin/super_admin');

		}

	}*/

	

	function filter_sellers_data()

	{

		if($this->session->userdata('logged_in')){

			$data['seller_id'] = $_REQUEST['seller_id'];

			$data['seller_from'] = $this->input->post('seller_id_from');

			$data['seller_to'] = $this->input->post('seller_id_to');			

			$data['name1'] = $_REQUEST['name1'];

			$data['phone'] = $_REQUEST['phone'];

			$data['reg_date_from'] =$_REQUEST['regdate_from'];

			$data['reg_date_to'] = $_REQUEST['regdate_to'];

			$data['state'] = $_REQUEST['state'];

			$data['city'] = $_REQUEST['city'];	

			$data['email'] = $_REQUEST['email'];

			$data['approval_from'] = $_REQUEST['approval_from'];

			$data['approval_to'] = $_REQUEST['approval_to'];

			$data['seller_status'] = $_REQUEST['seller_status'];

			

			$config = array();

			$config["base_url"] = base_url()."admin/sellers/filter_sellers_data";

			$config["total_rows"] = $this->Seller_model->filter_sellers_datacount();

			$config["per_page"] = 20;

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

			

			$config['suffix'] ='&seller_id='.$data['seller_id'].'&name1='.$data['name1'].'&regdate_from='.$data['reg_date_from'].'&regdate_to='.$data['reg_date_to'].'&phone='.$data['phone'].'&approval_from='.$data['approval_from'].'&approval_to='.$data['approval_to'].'&email='.$data['email'].'&state='.$data['state'].'&city='.$data['city'].'&seller_status='.$data['seller_status'];

			

			$this->pagination->initialize($config);

			$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

			

			$data['sellers'] = $this->Seller_model->filter_sellers_data($config["per_page"], $page);

			$data['links'] = $this->pagination->create_links();

			$this->load->view('admin/sellers', $data);

		}else{

			redirect('admin/super_admin');

		}

	}

	function filter_sellersprofile_data()
	{
		if($this->session->userdata('logged_in')){

			$data['seller_id'] = $_REQUEST['seller_id'];
			$data['seller_from'] = $this->input->post('seller_id_from');
			$data['seller_to'] = $this->input->post('seller_id_to');
			$data['name1'] = $_REQUEST['name1'];
			$data['phone'] = $_REQUEST['phone'];
			$data['reg_date_from'] =$_REQUEST['regdate_from'];
			$data['reg_date_to'] = $_REQUEST['regdate_to'];
			$data['state'] = $_REQUEST['state'];
			$data['city'] = $_REQUEST['city'];
			$data['email'] = $_REQUEST['email'];
			$data['approval_from'] = $_REQUEST['approval_from'];
			$data['approval_to'] = $_REQUEST['approval_to'];
			$data['seller_status'] = $_REQUEST['seller_status'];			

			$config = array();
			$config["base_url"] = base_url()."admin/sellers/filter_sellersprofile_data";
			$config["total_rows"] = $this->Seller_model->filter_sellers_datacount();
			$config["per_page"] = 20;
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

			$config['suffix'] ='&seller_id='.$data['seller_id'].'&name1='.$data['name1'].'&regdate_from='.$data['reg_date_from'].'&regdate_to='.$data['reg_date_to'].'&phone='.$data['phone'].'&approval_from='.$data['approval_from'].'&approval_to='.$data['approval_to'].'&email='.$data['email'].'&state='.$data['state'].'&city='.$data['city'].'&seller_status='.$data['seller_status'];			

			$this->pagination->initialize($config);
			$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
			$data['sellers'] = $this->Seller_model->filter_sellers_data($config["per_page"], $page);
			$data['links'] = $this->pagination->create_links();
			$this->load->view('admin/sellers_profile', $data);
		}else{

			redirect('admin/super_admin');

		}

	}


	function change_seller_status(){

		if($this->session->userdata('logged_in')){

			/*$status = $this->uri->segment(4);

			$seller_id = $this->uri->segment(5);

			$email = $this->uri->segment(6);*/

			$status = $this->input->post('val');

			$seller_id = $this->input->post('seller_id');

			$email = $this->input->post('email');

			

			$this->load->model('Cornjob_productinsermodel');

			$result = $this->Cornjob_productinsermodel->update_sellerstatus($seller_id, $status);

			

			$result = $this->Seller_model->update_sellers_status($seller_id, $status);

			  

			if($result == true){

				

				$to = $email;				

				$from = ADMIN_MAIL;

				$subject = "Regarding Seller approval in ".DOMAIN_NAME;

				

				$seller_nm['seller_id']=$seller_id;

				$seller_nm['seller_sts']=$status;

				

				$this->email->set_newline("\r\n");

				$this->email->set_mailtype("html");

				$this->email->from(SELLER_MAIL);

				$this->email->to($to);

				$this->email->subject('Seller Account Status');

				$this->email->message($this->load->view('email_template/seller_approved',$seller_nm,true));

				

				$this->email->send();

				

				date_default_timezone_set('Asia/Calcutta');

				$dt = date('Y-m-d H:i:s');

					

				$msg=$this->load->view('email_template/seller_approved',$seller_nm,true);

				if($this->email->send()){

					

					$email_data=array(

					'to_email_id'=>$to,

					'from_email_id'=>SELLER_MAIL,

					'date'=>$dt,

					'email_sub'=>'Seller Account Status',

					'email_content'=>$msg,

					'email_send_status'=>'Success'

					);

				}else

				{

					$email_data=array(

					'to_email_id'=>$to,

					'from_email_id'=>SELLER_MAIL,

					'date'=>$dt,

					'email_sub'=>'Seller Account Status',

					'email_content'=>$msg,

					'email_send_status'=>'Failure'

					);	

				}

				$this->db->insert('email_log',$email_data);	

				

				

			}

		}else{

			redirect('admin/super_admin');

		}

	}

	

	

	function product_for_approve(){

		if($this->session->userdata('logged_in')){

			$data['from_dt'] = $this->input->post('from_dt');		   

			$data['to_dt'] = $this->input->post('to_dt');				

			$data['fltr_product_nm'] = $this->input->post('fltr_product_nm');					

			$data['fltr_slr_nm'] = $this->input->post('fltr_slr_nm');			

			$data['product_sts'] = $this->input->post('product_sts');			

			

			$config = array();

			$config["base_url"] = base_url()."admin/Sellers/product_for_approve";

			$config["total_rows"] = $this->Seller_model->retrive_seller_product_data_4_approvecount();

			$config["per_page"] = 200;

			$config["uri_segment"] = 3;

			//$config['use_page_numbers'] = TRUE;

			$config['page_query_string'] = TRUE;

			$choice = $config["total_rows"] / $config["per_page"];

			//print_r(round($choice));exit;

			//$config["num_links"] = round($choice);

			$config["num_links"] = 3;

			$config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';

			$config['cur_tag_close'] = '</a>';

			$config['next_link'] = 'Next';

			$config['prev_link'] = 'Previous';

			

			$this->pagination->initialize($config);

			$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

			

			$data['result'] = $this->Seller_model->retrive_seller_product_data_4_approve($config["per_page"], $page);

			$data['links'] = $this->pagination->create_links();

			

			//$data['result'] = $this->Seller_model->retrive_seller_product_data_4_approve();

			

			//$this->load->model('admin/Manage_category_model');			

//			$data['category_result'] = $this->Manage_category_model->retrieve_category();

			

			$this->load->view('admin/products_for_approval_list',$data); 

		}else{

			redirect('admin/super_admin');

		}

	}

	function autofill_category(){

		$data['autofilldata'] = $this->Seller_model->retrieve_categorysearch();

		$this->load->view('admin/autofill_category',$data);

	}

	

	

	function filter_seller_product_data()

	{

		if($this->session->userdata('logged_in')){

			

			//$data['from_dt'] = $_REQUEST['from_dt'];

			//$data['to_dt'] = $_REQUEST['to_dt'];

			$data['from_dt'] = '';

			$data['to_dt'] = '';

			$data['fltr_product_nm'] = $_REQUEST['fltr_product_nm'];

			$data['fltr_slr_nm'] = $_REQUEST['fltr_slr_nm'];		

			$data['product_sts'] = $_REQUEST['product_sts'];

			

			//$data['product_sts'] = '';

			$data['fltr_product_sku']=	$_REQUEST['fltr_product_sku'];

			$data['seller_sts']=$_REQUEST['seller_sts'];

			$data['prod_mrp']=$_REQUEST['prod_mrp'];

			$data['prod_saleprice']=$_REQUEST['prod_saleprice'];

			$data['prod_qnt']=$_REQUEST['prod_qnt'];

			$data['catg_id']=$_REQUEST['catg_id'];

			

			$config = array();

			$config["base_url"] = base_url()."admin/Sellers/filter_seller_product_data";

			$config["total_rows"] = $this->Seller_model->filter_seller_product_datacount();

			$config["per_page"] = 200;

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

			

			

			$config['suffix'] ='&from_dt='.$data['from_dt'].'&to_dt='.$data['to_dt'].'&fltr_product_nm='.$data['fltr_product_nm'].'&fltr_slr_nm='.$data['fltr_slr_nm'].'&product_sts='.$data['product_sts'].'&fltr_product_sku='.$data['fltr_product_sku'].'&seller_sts='.$data['seller_sts'].'&prod_mrp='.$data['prod_mrp'].'&prod_saleprice='.$data['prod_saleprice'].'&prod_qnt='.$data['prod_qnt'].'&catg_id='.$data['catg_id'] ;

			

			$this->pagination->initialize($config);

			$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;				

			$data['result'] = $this->Seller_model->filter_seller_product_data($config["per_page"], $page);

			$data['links'] = $this->pagination->create_links();			

			

			//$data['result'] = $this->Seller_model->filter_seller_product_data();

			//$this->load->model('admin/Manage_category_model');			

//			$data['category_result'] = $this->Manage_category_model->retrieve_category();

			$this->load->view('admin/products_for_approval_list',$data);

			

			//$this->load->view('admin/new_product_approvallistby_ajax',$data);

		}else{

			redirect('admin/super_admin');

		}

	}

	

	function product_exiting_for_approve(){
		if($this->session->userdata('logged_in')){
			$data['from_dt'] = $this->input->post('from_dt1');
		   // print_r($shipment);exit;
			
			$data['to_dt'] = $this->input->post('to_dt1');			
			//print_r($to_dt);exit;		
			$data['fltr_product_nm'] = $this->input->post('fltr_product_nm1');
			
			$data['fltr_product_sku'] = $this->input->post('fltr_product_sku');
			
			$data['fltr_slr_nm'] = $this->input->post('fltr_slr_nm1');
			//print_r($fltr_slr_nm);exit;
			$data['product_sts'] = $this->input->post('product_sts1');			
			
			$config = array();
			$config["base_url"] = base_url()."admin/Sellers/product_exiting_for_approve";
			$config["total_rows"] = $this->Seller_model->retrive_seller_product_exiting_datacount();
			$config["per_page"] = 100;
			$config["uri_segment"] = 3;
			//$config['use_page_numbers'] = TRUE;
			$config['page_query_string'] = TRUE;
			$choice = $config["total_rows"] / $config["per_page"];
			//print_r(round($choice));exit;
			//$config["num_links"] = round($choice);
			$config["num_links"] = 3;
			$config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
			$config['cur_tag_close'] = '</a>';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Previous';
			
			$this->pagination->initialize($config);
			$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
			
			$data['result'] = $this->Seller_model->retrive_seller_product_exiting_data($config["per_page"], $page);
			$data['links'] = $this->pagination->create_links();
			
			//$data['result'] = $this->Seller_model->retrive_seller_product_data_4_approve();
			
			//$this->load->model('admin/Manage_category_model');			
//			$data['category_result'] = $this->Manage_category_model->retrieve_category();
			
			$this->load->view('admin/products_exiting_for_approval_list',$data); 
		}else{
			redirect('admin/super_admin');
		}
	}

	
function autofill_seller(){
		$data['autofilldata'] = $this->Seller_model->search_existseller_name();
		$this->load->view('admin/autofill_existslrnm',$data);
	}
	function autofill_existprodnm(){
		$data['autofilldata'] = $this->Seller_model->search_existprod_name();
		$this->load->view('admin/autofill_existprodnm',$data);
	}
	function autofill_existcategory(){
		$data['autofilldata'] = $this->Seller_model->existcategorysearch();
		$this->load->view('admin/autofill_existcategory',$data);
	}
	
	
	
	function filter_seller_existing_product()
	{
		if($this->session->userdata('logged_in')){
			
			//$data['from_dt'] = $_REQUEST['from_dt'];
			//$data['to_dt'] = $_REQUEST['to_dt'];
			$data['from_dt'] = '';
			$data['to_dt'] = '';
			$data['fltr_product_sku']=$_REQUEST['fltr_product_sku'];
			$data['fltr_product_nm']=$_REQUEST['fltr_product_nm'];
			$data['prod_cate']=$_REQUEST['prod_cate'];
			$data['fltr_slr_nm']=$_REQUEST['fltr_slr_nm'];
			$data['mrp']=$_REQUEST['mrp'];
			$data['sell_prices']=$_REQUEST['sell_prices'];
			$data['quantity']=$_REQUEST['quantity'];
			$data['product_sts']=$_REQUEST['product_sts'];
			/*$data['fltr_product_sku'] = $this->input->post('fltr_product_sku');
			//$data['from_dt'] = $this->input->post('from_dt1');
			
			//$data['to_dt'] = $this->input->post('to_dt1');	
			$data['fltr_product_nm'] = $this->input->post('fltr_product_nm');
			$data['prod_cate'] = $this->input->post('prod_cate');
			
			$data['fltr_slr_nm'] = $this->input->post('fltr_slr_nm');
			$data['mrp'] = $this->input->post('mrp');
			$data['sell_prices'] = $this->input->post('sell_prices');
			$data['quantity'] = $this->input->post('quantity');
			
			$data['product_sts'] = $this->input->post('product_sts');*/
			
			$config = array();
			$config["base_url"] = base_url()."admin/Sellers/filter_seller_existing_product";
			$config["total_rows"] = $this->Seller_model->filter_seller_product_exiting_datacount();
			$config["per_page"] = 100;
			$config["uri_segment"] = 3;
			$config["page_query_string"] = TRUE;
			$config['enable_query_strings'] = TRUE;
			$config['reuse_query_string'] = TRUE;
			$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] = 3;
			$config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
			$config['cur_tag_close'] = '</a>';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Previous';
			
			
			$config['suffix'] ='&fltr_product_sku='.$data['fltr_product_sku'].'&from_dt='.'&fltr_product_nm='.$data['fltr_product_nm'].'&prod_cate='.$data['prod_cate'].'&fltr_slr_nm='.$data['fltr_slr_nm'].'&product_sts='.$data['product_sts'].'&mrp='.$data['mrp'].'&sell_prices='.$data['sell_prices'].'&quantity='.$data['quantity'] ;
			
			$this->pagination->initialize($config);
			$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;				
			$data['result'] = $this->Seller_model->filter_seller_existing_product($config["per_page"], $page);
			$data['links'] = $this->pagination->create_links();			
			
			//$data['result'] = $this->Seller_model->filter_seller_product_data();
			//$this->load->model('admin/Manage_category_model');			
//			$data['category_result'] = $this->Manage_category_model->retrieve_category();
			$this->load->view('admin/products_exiting_for_approval_list',$data);
			
			//$this->load->view('admin/new_product_approvallistby_ajax',$data);
		}else{
			redirect('admin/super_admin');
		}
	}

	

	function change_seller_product_status()
	{		

		$this->Seller_model->changed_productprocess_statusstart();		

		$status = $this->input->post('status');

		$sku_ids=implode(',',$this->input->post('sku_chkids'));

		$result = $this->Seller_model->changed_seller_product_status();		

		$skuid_arr=explode(',',$sku_ids);

		$skuararray=array();

		foreach($skuid_arr as $key=>$val)

		{	

			$qr_cron=$this->db->query("select * FROM cornjob_productsearch WHERE sku= '$val' ");

			$rw=$qr_cron->row();

			if($rw)

			{	array_push($skuararray,$rw->sku);}

				

		}

		if(count($skuararray)==0){

		

			$this->load->model('Cornjob_productinsermodel');

			//$this->Cornjob_productinsermodel->select_productdata();
			
			$this->Cornjob_productinsermodel->select_newproductdata();
			
			foreach($skuid_arr as $skukey=>$skuvalue)
			{
					//$sql="call existing_productdataupdateincronjobsearch(".$skuvalue.");";
					$this->Cornjob_productinsermodel->existing_productdataupdateincronjobsearch($skuvalue);
					//$this->db->query($sql);
			}

			//$this->Cornjob_productinsermodel->update_single_capramrom_attrubute($sku_ids);
			
				

		}

			$this->load->model('Cornjob_productinsermodel');

			$this->Cornjob_productinsermodel->update_prodapprove_status($status,$sku_ids);



			$this->Seller_model->changed_productprocess_statusfinish();

		

		//if($result == true){

//			echo 'success';exit;

//		}

	}

	

	

	

	

	

	//---------------------------------sellerwise product status change start---------------------------//

	function change_sellerwiseproduct_status()

	{ 

				$this->Seller_model->changed_productprocess_statusstart();

				

				$status = $this->input->post('status');

				//$sku_ids=implode(',',$this->input->post('sku_chkids'));

				

					 

					 //------------------sku access start----------------//

					 

					 $ids = implode(',',$this->input->post('id'));		

				

				$query_slrprod = $this->db->query("SELECT b.sku FROM seller_product_setting a

					INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id

					 WHERE (a.product_approve='Pending')  AND a.seller_id IN ($ids)  GROUP BY a.seller_product_id  ");

							

					 

					 $skuid_arr=array();

					foreach($query_slrprod->result_array() as $res_slrprod )

					{

						$skuid_arr[]= $res_slrprod['sku'];

							

					}

					$sku_ids=implode(',',$skuid_arr);

				//-------------------sku access end-----------------//

				

				$result = $this->Seller_model->changed_sellerwiseproduct_status();

				

				

				

				//$skuid_arr=explode(',',$sku_ids);

				$skuararray=array();

				foreach($skuid_arr as $key=>$val)

				{	

					$qr_cron=$this->db->query("select * FROM cornjob_productsearch WHERE sku= '$val' ");

					$rw=$qr_cron->row();

					if($rw)

					{	array_push($skuararray,$rw->sku);}

						

				}

				if(count($skuararray)==0){

				

					$this->load->model('admin/Cronjobinser_modelfor_sellerproductapproval');

					$this->Cronjobinser_modelfor_sellerproductapproval->select_productdata();

					$this->Cronjobinser_modelfor_sellerproductapproval->update_single_capramrom_attrubute($sku_ids);	

				}

					$this->load->model('admin/Cronjobinser_modelfor_sellerproductapproval');

					$this->Cronjobinser_modelfor_sellerproductapproval->update_prodapprove_status($status,$sku_ids);

					

					$this->Seller_model->changed_productprocess_statusfinish();			

				

				//if($result == true){

		//			echo 'success';exit;

		//		}			

	}

	//---------------------------------sellerwise product status change end---------------------------//

	

	

	//-----------------------------------------sellerwise product status change by store procedure start------------------//

			function change_sellerwiseproduct_status_sp()
			{
				$this->Seller_model->changed_productprocess_statusstart();
				$this->Seller_model->changed_sellerwiseproduct_status_sp();			

				$this->Seller_model->changed_productprocess_statusfinish();

				//echo "success";exit;

			}

			

	

	//-----------------------------------------sellerwise product status change by store procedure end------------------//

	

	

		function sellerwiseproduct_approve()

	{

		//-------------------------------sellerwise product approval start---------------------------------//

		 if($this->session->userdata('logged_in')){

			 

			$config = array();

			$config["base_url"] = base_url()."admin/Sellers/sellerwiseproduct_approve";

			$config["total_rows"] = $this->Seller_model->getSellerswisepnding_productcount();

			$config["per_page"] = 20;

			$config["uri_segment"] = 3;

			//$config['use_page_numbers'] = TRUE;

			$config['page_query_string'] = TRUE;

			$choice = $config["total_rows"] / $config["per_page"];

			//print_r(round($choice));exit;

			//$config["num_links"] = round($choice);

			$config["num_links"] = 3;

			$config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';

			$config['cur_tag_close'] = '</a>';

			$config['next_link'] = 'Next';

			$config['prev_link'] = 'Previous';

			

			$this->pagination->initialize($config);

			$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

			

			$data['sellers'] = $this->Seller_model->getSellerswise_productapprovedata($config["per_page"], $page);

			$data['links'] = $this->pagination->create_links();

			

			$this->load->view('admin/sellerswise_productapprovelist', $data);

			 

		 }

		 else

		 {redirect('admin/super_admin');}

		//----------------------------------sellerwise product approval end--------------------------------//	

	}

	

	

	

	

	/*function change_seller_exiting_product_status(){

		$result = $this->Seller_model->changed_seller_exiting_product_status();

		

			$status = $this->input->post('status');

			$prod_ids=implode(',',$this->input->post('prod_id'));

		

			$this->load->model('Cornjob_productinsermodel');

			$this->Cornjob_productinsermodel->update_existingprodapprove_status($status,$prod_ids);

				

		if($result == true){

			echo 'success';exit;

		}

	}*/

	

	function change_seller_exiting_product_status(){

		//$this->Seller_model->changed_productprocess_statusstart();
		$result = $this->Seller_model->changed_seller_exiting_product_status();	

			$status = $this->input->post('status');

			$prod_ids=implode(',',$this->input->post('prod_id'));		

			$sku_ids=implode(',',$this->input->post('prodextsku'));	

			//existing product insert in cronjob table start			

				$skuid_arr=explode(',',$sku_ids);
				$skuararray=array();

				/*foreach($skuid_arr as $key=>$val)
				{	
					$qr_cron=$this->db->query("select * FROM cornjob_productsearch WHERE sku= '$val' ");

					$rw=$qr_cron->row();

					if($rw)

					{	array_push($skuararray,$rw->sku);}						

				}*/

				$this->load->model('Cornjob_productinsermodel');

				//if(count($skuararray)==0){				


					//$this->Cornjob_productinsermodel->select_productdata();
					$this->Cornjob_productinsermodel->select_productdataexistingproductapprove();

					//$this->Cornjob_productinsermodel->update_single_capramrom_attrubute($sku_ids);	

				//}
				
				foreach($skuid_arr as $skukey=>$skuvalue)
				{
					//$sql="call existing_productdataupdateincronjobsearch(".$skuvalue.");";
					$this->Cornjob_productinsermodel->existing_productdataupdateincronjobsearch($skuvalue);
					//$this->db->query($sql);
				}
					$this->Cornjob_productinsermodel->update_prodapprove_status($status,$sku_ids);			

			//existing product insert in cronjob table end		

			//$this->load->model('Cornjob_productinsermodel');

			$this->Cornjob_productinsermodel->update_existingprodapprove_status($status,$prod_ids);		

			//$this->Seller_model->changed_productprocess_statusfinish();				

		/*if($result == true){

			echo 'success';exit;

		}*/
		//echo 'success';exit;

	}
	
	function change_seller_exiting_product_image()
	{
		
			$this->load->model('admin/Upload_existingporductexcelfile_model');
			$this->Upload_existingporductexcelfile_model->change_sellerprodimage();
	}

	

	function seller_product(){

		if($this->session->userdata('logged_in')){

			$data['result'] = $this->Seller_model->retrive_approved_seller_product_data();

			$this->load->view('admin/seller_product_list',$data);

		}else{

			redirect('admin/super_admin');

		}

	}

	

	function seller_search(){

		if($this->session->userdata('logged_in')){

			$cate_search_title = $this->uri->segment(4); 

			$data['sellers'] = $this->Seller_model->getSearchedSellers($cate_search_title); 

			//if($result != false){

				$this->load->view('admin/sellers', $data);

			//}

		}else{

			redirect('admin/super_admin');

		}

	}

	

	function seller_dispatch_time(){

		if($this->session->userdata('logged_in')){

			$this->load->model('admin/Shipment_model');

			$data['state_result'] = $this->Shipment_model->retrive_state();

			$data['dispatched_result'] = $this->Seller_model->retrieve_dispatch_details();

			$this->load->view('admin/seller_dispatch_time', $data);

		}else{

			redirect('admin/super_admin');

		}

	}

	function seller_notification_form2(){

		if($this->session->userdata('logged_in')){

			$data['sellers'] = $this->Seller_model->getSellers();

			$this->load->view('admin/seller_notification_form2', $data);

		}else{

			redirect('admin/super_admin');

		}

	}

	function add_seller_notification2(){

		if($this->session->userdata('logged_in')){

			$this->form_validation->set_rules('title', 'Title', 'required');

			$this->form_validation->set_rules('page_content', 'Content', 'required');

			$this->form_validation->set_rules('seller', 'Seller', 'required');

			$this->form_validation->set_rules('status', 'Status', 'required');

			

			if($this->form_validation->run() != false) { 

				$result = $this->Seller_model->insert_newseller_notice2();

				if($result == true){

					$content = $this->input->post('page_content');

					$seller_id = $this->input->post('seller');

					$email = $this->Seller_model->getSellerEmail($seller_id);

					$data["content"]=$content;

					

					$to = $email;

					$from = SELLER_MAIL;

					$subject = "Seller Notification";

					

					$this->email->set_newline("\r\n");

					$this->email->set_mailtype("html");

					$this->email->from($from);

					$this->email->to($to);

					$this->email->subject($subject);

					$this->email->message($this->load->view('email_template/notification_seller',$data,true));

					

					/*$this->email->message("<html>

											<head>

												<title> Moonboy </title>

											</head>

											<body>

												<div style='width:50%; margin:0px auto; padding:40px;  background-color:#f4f4f4; border:10px solid #ef3038;'>

													<p> Notification for you, </p>

													<p> ".$content." </p>

													<br/> <br/>

												   Thanks & regards,<br/>Moonboy Seller Support <br/>

												</div>

											</body>

										</html>");*/

					

					if($this->email->send()){

						$this->seller_notification();

					}

				}

			}else{

				$this->load->view('admin/seller_notification_form2');

			}

		}else{

			redirect('admin/super_admin');

		}

	}

	

	/*  Seller Notification Starts   **/

	function seller_notification(){

		if($this->session->userdata('logged_in')){

			$data['result'] = $this->Seller_model->getSellerNotification();

			$data['result2'] = $this->Seller_model->getSellerNotification2();

			$this->load->view('admin/seller_notification', $data);

		}else{

			redirect('admin/super_admin');

		}

	}

	

	function seller_notification_form(){

		if($this->session->userdata('logged_in')){

			$this->load->view('admin/seller_notification_form');

		}else{

			redirect('admin/super_admin');

		}

	}

	

	

	function add_seller_notification(){

		if($this->session->userdata('logged_in')){

			$this->form_validation->set_rules('title', 'Title', 'required');

			$this->form_validation->set_rules('page_content', 'Content', 'required');

			$this->form_validation->set_rules('status', 'Status', 'required');

			

			if($this->form_validation->run() != false) { 

				$result = $this->Seller_model->insert_newseller_notice();

				if($result == true){

					$this->seller_notification();

				}

			}else{

				$this->load->view('admin/seller_notification_form');

			}

		}else{

			redirect('admin/super_admin');

		}

	}

	

	function seller_notification_edit(){

		if($this->session->userdata('logged_in')){

			$id = $this->uri->segment(4);

			$data['result'] = $this->Seller_model->getSellerNotificationForEdit($id);

			$this->load->view('admin/seller_notification_edit_form', $data);

		}else{

			redirect('admin/super_admin');

		}

	}

	function terms_conditions_setup()

	{

		if($this->session->userdata('logged_in')){

			$data['tc_data']=$this->Seller_model->select_SellerTC();

			$this->load->view('admin/seller_terms_conditions',$data);

		}else{

			redirect('admin/super_admin');

		}	

	}

	function add_seller_terms_cond()

	{

		if($this->session->userdata('logged_in')){

			

			$this->Seller_model->getSellerTC_ForEdit();

			$this->load->view('admin/seller_terms_conditions');

			redirect('admin/sellers/terms_conditions_setup');

			}else{

			redirect('admin/super_admin');

		}

			

	}

	

	function seller_notification_edit2(){

		if($this->session->userdata('logged_in')){

			$id = $this->uri->segment(4);

			$data['sellers'] = $this->Seller_model->getSellers();

			$data['result2'] = $this->Seller_model->getSellerNotificationForEdit2($id);

			$this->load->view('admin/seller_notification_edit_form2', $data);

		}else{

			redirect('admin/super_admin');

		}

	}

	

	function seller_notification_update(){

		if($this->session->userdata('logged_in')){

			$this->form_validation->set_rules('title', 'Title', 'required');

			$this->form_validation->set_rules('page_content', 'Content', 'required');

			$this->form_validation->set_rules('status', 'Status', 'required');

			

			if($this->form_validation->run() != false) { 

				$result = $this->Seller_model->getseller_notification_update();

				if($result == true){

					$this->seller_notification();

				}

			}else{

				$data['result'] = $this->Seller_model->getSellerNotification();

				$this->load->view('admin/seller_notification_edit_form', $data);

			}

		}else{

			redirect('admin/super_admin');

		}

	}

	function seller_notification_update2(){

		if($this->session->userdata('logged_in')){

			$this->form_validation->set_rules('title', 'Title', 'required');

			$this->form_validation->set_rules('page_content', 'Content', 'required');

			$this->form_validation->set_rules('seller', 'Seller', 'required');

			$this->form_validation->set_rules('status', 'Status', 'required');

			

			if($this->form_validation->run() != false) { 

				$result = $this->Seller_model->getseller_notification_update2();

				if($result == true){

					$this->seller_notification();

				}

			}else{

				$data['result'] = $this->Seller_model->getSellerNotification();

				$this->load->view('admin/seller_notification_edit_form', $data);

			}

		}else{

			redirect('admin/super_admin');

		}

	}

	function seller_notification_delete(){

		if($this->session->userdata('logged_in')){

			$id = $this->uri->segment(4);

			$result = $this->Seller_model->delete_seller_notification($id);

			if($result == true){

				redirect('admin/sellers/seller_notification');

			}

		}else{

			redirect('admin/super_admin');

		}

	}

	function seller_notification_delete2(){

		if($this->session->userdata('logged_in')){

			$id = $this->uri->segment(4);

			$result = $this->Seller_model->delete_seller_notification2($id);

			if($result == true){

				redirect('admin/sellers/seller_notification');

			}

		}else{

			redirect('admin/super_admin');

		}

	}

	

	/*  Seller Notification End   **/

	

	/* Seller badge Starts  */

	function seller_badge(){

		if($this->session->userdata('logged_in')){

			$data['seller_list'] = $this->Seller_model->getBadgeSellersList();

			$data['seller_badge'] = $this->Seller_model->getSellersBadgeDetails();

			$this->load->view('admin/seller_badge', $data);

		}else{

			redirect('admin/super_admin');

		}

	}

	

	function sellerbadgeaddform(){

		if($this->session->userdata('logged_in')){

			$data['seller_list'] = $this->Seller_model->getBadgeSellersList();

			$this->load->view('admin/seller_badge_add_form', $data);

		}else{

			redirect('admin/super_admin');

		}	

	}

	function save_new_sellerbadge(){

		if($this->session->userdata('logged_in')){

			$result = $this->Seller_model->insert_newseller_badge();

			if($result == true){

				redirect('admin/sellers/seller_badge');

				//$this->seller_badge();

			}else{

				$this->load->view('admin/seller_badge_add_form');

			}

		}else{

			redirect('admin/super_admin');

		}	

	}

	function delete_seller_badge(){

		if($this->session->userdata('logged_in')){

			$id = base64_decode($this->uri->segment(4));

			$id = $this->encrypt->decode($id);

			$result = $this->Seller_model->deleteSellerBadge($id);

			if($result == true){

				redirect('admin/sellers/seller_badge');

			}

		}else{

			redirect('admin/super_admin');

		}	

	}

	function edit_seller_badge(){

		if($this->session->userdata('logged_in')){

			$id = base64_decode($this->uri->segment(4));

			$id = $this->encrypt->decode($id);

			$data['seller_badge_details'] = $this->Seller_model->getSellerBadgeDetails($id);

			$data['sellers_list'] = $this->Seller_model->getBadgeSellerList();

			$this->load->view('admin/seller_badge_edit_form', $data);

		}else{

			redirect('admin/super_admin');

		}	

	}

	function update_sellerbadge(){

		if($this->session->userdata('logged_in')){

			$result = $this->Seller_model->seller_badge_update();

			if($result == true){

				redirect('admin/sellers/seller_badge');

			}else{

				$this->edit_seller_badge();

			}

		}else{

			redirect('admin/super_admin');

		}	

	}

	/* Seller badge End  */

	

	function seller_membership(){

		if($this->session->userdata('logged_in')){

			$data['membership'] = $this->Seller_model->getMembershipDetails();

			$this->load->view('admin/seller_membership', $data);

		}else{

			redirect('admin/super_admin');

		}	

	}

	function addsellermembershipaddform(){

		if($this->session->userdata('logged_in')){

			$data['sellers_list'] = $this->Seller_model->getMembershipSellersList();

			$data['membership_list'] = $this->Seller_model->getMembershipList();

			$this->load->view('admin/membership_add_form', $data);

		}else{

			redirect('admin/super_admin');

		}

	}

	function save_new_membership(){

		if($this->session->userdata('logged_in')){

			$seller_id = urldecode($this->uri->segment(5));

			$membership = $this->uri->segment(4);

			$result = $this->Seller_model->insert_newseller_membership($membership, $seller_id);

			if($result == true){

				redirect('admin/sellers/seller_membership');

			}else{

				$this->addsellermembershipaddform();

			}

		}else{

			redirect('admin/super_admin');

		}

	}

	

	function get_dispatched_time_data(){

		$result = $this->Seller_model->insert_dispatched_data();

		if($result == 1){

			$this->session->set_flashdata('ss_msg', 'Saved successfully !');

			redirect("admin/sellers/seller_dispatch_time");

		}

		if($result == 0){

			$this->session->set_flashdata('err_msg', 'This state is already exists! Pleasse Update.');

			redirect("admin/sellers/seller_dispatch_time");

		}

	}

	

	function edit_dispatched_time_data(){

		$result = $this->Seller_model->insert_update_dispatched_data();

		if($result = true){

			$this->session->set_flashdata('ss_msg', 'Updated successfully !');

			redirect("admin/sellers/seller_dispatch_time");

		}

	}

	

	

	//Reject Product

	function product_inactive(){

		if($this->session->userdata('logged_in')){

						

			$status = $this->input->post('status');

			$sku=$this->input->post('sku');

		

			$this->load->model('Cornjob_productinsermodel');

			$this->Cornjob_productinsermodel->update_singleprodapprove_status($status,$sku);

			

			$result = $this->Seller_model->update_pro_reject_data();

			

			

			if($result == true){

				echo 'success'; exit;

			}else{

				echo 'fail'; exit;

			}

		}else{

			redirect('admin/super_admin');

		}	

	}

	function default_sellerlist()

	{

		if($this->session->userdata('logged_in')){

			

			

			$seller_defaulter['defaulter_seller']=$this->Seller_model->select_defulter_seller();

			$this->load->view('admin/default_seller_list',$seller_defaulter);

			

		}else{

			redirect('admin/super_admin');

		}	

	

		

	}

	

	function change_productstatus()

	{

		if($this->session->userdata('logged_in')){

			$sku_id=$this->uri->segment(4);

			$this->Seller_model->change_defulterseller_status($sku_id);

			$seller_defaulter['defaulter_seller']=$this->Seller_model->select_defulter_seller();

			$this->load->view('admin/default_seller_list',$seller_defaulter);

			}else{

			redirect('admin/super_admin');

		}	



	}

	

	function update_seller_info(){

		$result = $this->Seller_model->update_inn_slr_info();

		if($result){

			echo $result;

		}

	}

	

	function update_slr_proof(){

		$slr_id = $this->input->post('slr_id');

		$config['upload_path'] = './images/seller_image_doc/';

		$config['allowed_types'] = 'jpg|jpeg|png';

		$config['max_size']	= '20480000';

		$config['max_width']  = '3000';

		$config['max_height']  = '3000';

		$this->load->library('upload', $config);

		$this->upload->initialize($config);

		

		$this->upload->do_upload();

		$data = array('upload_data' => $this->upload->data());

		$fileName = $data['upload_data']['file_name'];

		$result = $this->Seller_model->update_inn_slr_proof($fileName);

		if($result == true){

			redirect('admin/sellers/seller_details/'.$slr_id);

		}

		

	}

	

	

	

	function update_kyc_details(){

		$slr_id = $this->input->post('slr_id');

		$config['upload_path'] = './images/seller_image_doc/';

		$config['allowed_types'] = 'jpg|jpeg|png';

		$config['max_size']	= '20480000';

		$config['max_width']  = '3000';

		$config['max_height']  = '3000';

		$this->load->library('upload', $config);

		$this->upload->initialize($config);

		

		$this->upload->do_upload();

		$data = array('upload_data' => $this->upload->data());

		$fileName = $data['upload_data']['file_name'];

		$result = $this->Seller_model->update_kyc_details($fileName);

		if($result == true){

			redirect('admin/sellers/seller_details/'.$slr_id);

		}

		

	}

	// Admin adding products for seller starts

	

	function addnew_product_for_seller(){

		if($this->session->userdata('logged_in')){

			$data['seller_id'] = $this->uri->segment(4);

			$this->load->view('admin/addproduct_forseller', $data);

		}else{

			redirect('admin/super_admin');

		}

	}

	

	function new_product_form_seller(){

		if($this->session->userdata('logged_in')){

			$data['seller_id'] = $this->uri->segment(4);

			$data['categories'] = $this->Seller_model->getCategories();

			$this->load->view('admin/new_product_form_seller', $data);

		}else{

			redirect('admin/super_admin');

		}

	}

	

	function save_new_product(){

		if($this->session->userdata('logged_in')){

			$seller_id = $this->input->post('hidden_seller_id');

			$insert_result = $this->Seller_model->insert_new_product($seller_id);

			

			

			//if($insert_result == true || $insert_result ==''){

				redirect('admin/sellers/seller_details/'.$seller_id);

			//}else{

				//$this->load->view('admin/new_product_form_seller');

			//}

		}else{

			redirect('admin/super_admin');

		}

	}

	

	function upload_product_tmp_image(){

		$seller_id = $this->uri->segment(4);

		if(isset($_FILES["userfile"])){

			$ret = array();

			$error =$_FILES["userfile"]["error"];

			if(!is_array($_FILES["userfile"]["name"])){

				$fileName = $_FILES["userfile"]["name"];

				$_FILES['userfile']['type'];

				$_FILES['userfile']['tmp_name'];

				$_FILES['userfile']['error'];

				$_FILES['userfile']['size'];

				$config['encrypt_name'] = TRUE;

				$config['upload_path'] = './images/product_img/';

				$config['allowed_types'] = 'gif|jpg|jpeg|png';

				$this->load->library('upload');

				$this->upload->initialize($config);

				$ret[]= $fileName;



				if(!$this->upload->do_upload()){

					$error = array('error' => $this->upload->display_errors());    

					$this->load->view('seller/add_new_product', $error);

				}else{

					$data = array('upload_data' => $this->upload->data());  

					$path = $data['upload_data']['full_path'];

					$width = $data['upload_data']['image_width'];  

					$height = $data['upload_data']['image_height'];

			

					if($width > $height){

						$configi['image_library'] = 'gd2';

						$configi['source_image']   = $path;

						$config['maintain_ratio'] = TRUE;

						$configi['width']  = 500;

						$configi['height'] = 500;

						$config['master_dim'] = 'width';

						//$config['master_dim'] = 'height';

					}else{

						$configi['image_library'] = 'gd2';

						$configi['source_image']   = $path;

						$config['maintain_ratio'] = TRUE;

						$configi['width']  = 500;

						$configi['height'] = 500;

						//$config['master_dim'] = 'width';

						$config['master_dim'] = 'height';

					}

			

					$this->load->library('image_lib');

					$this->image_lib->initialize($configi);   

					$success_resize = $this->image_lib->resize();

					$this->image_lib->clear();

					

					if($success_resize){

						/* Second size */

						if($width > $height){

							$configi2['image_library'] = 'gd2';

							$configi2['source_image']   = $path;

							$config['maintain_ratio'] = TRUE;

							$configi2['width']  = 190;

							$configi2['height'] = 190;

							$configi2['master_dim'] = 'width';

							$configi2['new_image']   = 'catalog_'.$data['upload_data']['file_name'];

						}else{

							$configi2['image_library'] = 'gd2';

							$configi2['source_image']   = $path;

							$config['maintain_ratio'] = TRUE;

							$configi2['width']  = 190;

							$configi2['height'] = 190;

							//$config['master_dim'] = 'width';

							$configi2['master_dim'] = 'height';

							$configi2['new_image']   = 'catalog_'.$data['upload_data']['file_name'];

						}

						

						$this->load->library('image_lib');

						$this->image_lib->initialize($configi2);  

						$success_resize = $this->image_lib->resize();

						$this->image_lib->clear();

					}

					

					$name_array[] = $data['upload_data']['file_name'];					

				}				

			}

			else  //Multiple files, file[]

			{

				$fileCount = count($_FILES["userfile"]["name"]);

				for($s=0; $s < $fileCount; $s++){

					$fileName = $_FILES['userfile']['name'][$s];

					$_FILES['userfile']['type'][$s];

					$_FILES['userfile']['tmp_name'][$s];

					$_FILES['userfile']['error'][$s];

					$_FILES['userfile']['size'][$s];				

					$config['encrypt_name'] = TRUE;

					$config['upload_path'] = './images/product_img/';

					$config['allowed_types'] = 'gif|jpg|jpeg|png';

					$this->load->library('upload');

					$this->upload->initialize($config);

					$ret[]= $fileName;

				

					if(!$this->upload->do_upload()){

						$error = array('error' => $this->upload->display_errors());    

						$this->load->view('seller/add_new_product', $error);

					}else{

						$data = array('upload_data' => $this->upload->data());  

						$path = $data['upload_data']['full_path'];

						$width = $data['upload_data']['image_width'];  

						$height = $data['upload_data']['image_height'];

				

						if($width > $height){

							$configi['image_library'] = 'gd2';

							$configi['source_image']   = $path;

							$config['maintain_ratio'] = TRUE;

							$configi['width']  = 500;

							$configi['height'] = 500;

							$config['master_dim'] = 'width';

							//$config['master_dim'] = 'height'; 

						}else{

							$configi['image_library'] = 'gd2';

							$configi['source_image']   = $path;

							$config['maintain_ratio'] = TRUE;

							$configi['width']  = 500;

							$configi['height'] = 500;

							//$config['master_dim'] = 'width';

							$config['master_dim'] = 'height';

						}

				

						$this->load->library('image_lib');						

						$this->image_lib->initialize($configi);   

						$success_resize = $this->image_lib->resize();

						$this->image_lib->clear();

						if($success_resize){

							if($s == 0){

								/* Second size */

								if($width > $height){

									$configi2['image_library'] = 'gd2';

									$configi2['source_image']   = $path;

									$config['maintain_ratio'] = TRUE;

									$configi2['width']  = 190;

									$configi2['height'] = 190;

									$configi2['master_dim'] = 'width';

									$configi2['new_image']   = 'catalog_'.$data['upload_data']['file_name'];

								}else{

									$configi2['image_library'] = 'gd2';

									$configi2['source_image']   = $path;

									$config['maintain_ratio'] = TRUE;

									$configi2['width']  = 190;

									$configi2['height'] = 190;

									//$config['master_dim'] = 'width';

									$configi2['master_dim'] = 'height';

									$configi2['new_image']   = 'catalog_'.$data['upload_data']['file_name'];

								}

								$this->load->library('image_lib');

								$this->image_lib->initialize($configi2);  

								$success_resize = $this->image_lib->resize();

								$this->image_lib->clear();

							}

						}

					}

					$name_array[] = $data['upload_data']['file_name'];

				}				

			}

			$this->Seller_model->insert_product_tmp_img($name_array, $seller_id);

			//echo json_encode($ret);

			echo json_encode($name_array);

		}

	}

	

	function delete_product_tmp_image(){

		$output_dir = "./images/product_img/";

		if(isset($_POST["op"]) && $_POST["op"] == "delete" && isset($_POST['name']))

		{

			$fileName =$_POST['name'];

			$seller_id =$_POST['seller_id'];

			$fileName=str_replace("..",".",$fileName); //required. if somebody is trying parent folder files	

			$filePath = $output_dir. $fileName;

			$thumb_filePath = $output_dir. 'catalog_'.$fileName;

			if (file_exists($filePath)) 

			{

				unlink($filePath);

				unlink($thumb_filePath);

			}

			//delete file from temp_product_img table//

			$this->Seller_model->delete_product_tmp_img($fileName, $seller_id);

			echo "Deleted File ".$fileName."<br>";

		}

	}

	

	function search_existing_product(){

		if($this->session->userdata('logged_in')){

			$search_tittle = $this->input->post('search_title');

			$seller_id = $this->input->post('hidden_seller_id');

			$data['search_result'] = $this->Seller_model->search_existing_product_list($search_tittle, $seller_id);

			$data['seller_id'] = $seller_id;

			$this->load->view('admin/search_existing_product_list', $data);

		}else{

			redirect('admin/super_admin');

		}

	}

	

	function add_existing_product(){

		if($this->session->userdata('logged_in')){

			$data = array(

				'master_product_id' => urldecode($this->uri->segment(4)),

				'seller_id' => $this->uri->segment(5),

			);

			$skuid= urldecode($this->uri->segment(6));

			$prod_id=urldecode($this->uri->segment(4));

			

			$data['tax_classes'] = $this->Seller_model->getTaxClasses();

			$data['exist_product_info'] = $this->Seller_model->getExistProductInfo($data);

			

			// product attribute access start by ssantanu dt:21-09-2016

			$data['exist_product_attrbinfo'] = $this->Seller_model->getExistProductattributeInfo($prod_id,$skuid);

			if(count($data['exist_product_attrbinfo'])==0)

			{$data['exist_product_attrbinfo']='';}

				

			

			$this->load->model('admin/Attribute_model');

			$data['color_result'] = $this->Attribute_model->retrieve_colors();			

			$data['size_result'] = $this->Attribute_model->retrieve_size();

			$data['sub_size_result'] = $this->Attribute_model->retrieve_sub_size();

			// product attribute access start by ssantanu dt:21-09-2016

			

			$this->load->view('admin/add_Exisitng_product_for_seller', $data);

		}else{

			redirect('admin/super_admin');

		}

	}

	

	function check_sku(){

		$sku = $this->input->post('sku');

		$data1 = $this->Seller_model->getProductMastersku($sku);

		$data2 = $this->Seller_model->getSellerGeneralsku($sku);

		$data3 = $this->Seller_model->getSellerMastersku($sku);

		if($data1 == false && $data2 == false && $data3 == false){

			echo 'avail';

		}else{

			echo 'exist';

		}

	}

	function save_exist_new_product(){

		if($this->session->userdata('logged_in')){

			$seller_id = $this->input->post('hidden_seller_id');

			$exist_product_result = $this->Seller_model->insert_existing_product($seller_id);

			redirect('admin/sellers/seller_details/'.$seller_id);

		}else{

			redirect('admin/super_admin');

		}

	}

	

	

	function seller_courier_setting()

	{

		if($this->session->userdata('logged_in')){

			

			$courier_data['courier_info'] = $this->Seller_model->select_courierlist();

			$this->load->view('admin/courier_info_setup',$courier_data);

			

		}else{

			redirect('admin/super_admin');

		}	

	}

	

	

	

	

	// Admin adding products for seller starts

	

	

	function update_courierinfo()

	{

		if($this->session->userdata('logged_in')){

			

			$this->Seller_model->update_courierinfo();

			

			redirect('admin/sellers/seller_courier_setting');

			

		}else{

			redirect('admin/super_admin');

		}		

			

	}

	

	function addnew_courierinfo()

	{

		if($this->session->userdata('logged_in')){

		

			$this->Seller_model->insert_newcourierinfo();

			

			redirect('admin/sellers/seller_courier_setting');

			

		}else{

			redirect('admin/super_admin');

		}	

			

	}

	

	

	

	function product_detail()

	{

		$product_id=$this->uri->segment(4);

		$sku_id = $this->uri->segment(5);

		$this->load->model('Product_descrp_model');

		$this->load->helper('string');

		

				//$p['data']=$this->Product_descrp_model->select_prodmeta_info($product_id,$sku_id);

				//$p['page_title']=$this->Product_descrp_model->select_pagetitle($product_id);

				

				//if($this->session->userdata('sesscoke')!='')

//				{

//					array_push($this->session->userdata['sesscoke'],$product_id);

//					$prodskarrctr=implode(',',$this->session->userdata('sesscoke'));

//					

//					 

//					$cookie = array(

//					'name'=>'prodid',

//					'value'=>$prodskarrctr,        

//					'expire'=>time()+86500000              

//					);

//					 

//					set_cookie($cookie);

//				}

				

				//$p['other_seller_productid']=$this->Product_descrp_model->retrieve_same_productid_different_seller($product_id); //code by santanu dt:28-09-2016

				

				$p['other_seller_product'] = $this->Product_descrp_model->retrieve_same_product_different_seller($product_id,$sku_id);

				$p['seller_rating_result'] = $this->Product_descrp_model->retrieve_all_seller_rating();

				//$p['product_attr_result'] = $this->Product_descrp_model->retrieve_indivisual_product_attr_headings($sku_id,$product_id);

				$p['product_attr_result'] = '';

				

				

				//$p['attribute_color'] = $this->Product_descrp_model->retrieve_attr_color_option($product_id);

				//$p['attribute_size'] = $this->Product_descrp_model->retrieve_attr_size_option($product_id);				

				

				//$p['attribute_capacity'] = $this->Product_descrp_model->retrieve_attr_capacity($product_id); //code by santanu dt:28-09-2016

				//$p['attribute_ram'] = $this->Product_descrp_model->retrieve_attr_ram($product_id);//code by santanu dt:28-09-2016

				//$p['attribute_rom'] = $this->Product_descrp_model->retrieve_attr_rom($product_id);//code by santanu dt:28-09-2016

				

				$p['seller_badge'] = $this->Product_descrp_model->getSellerBadge($sku_id);

				

				//$p['vertual_inventory_data'] = $this->Product_descrp_model->checking_vertual_inventory_data($sku_id);

				$p['vertual_inventory_data'] ='';

				

				if(@$this->session->userdata['session_data']['user_id']){

					

					$p['data_sku']=$sku_id;

					$p['product_data']=$this->Product_descrp_model->select_single_product_data($product_id,$sku_id);

					

					$p['review_result']=$this->Product_descrp_model->retrieve_product_review($sku_id);

					$p['related_prod'] = $this->Product_descrp_model->related_prod($product_id);

					

					

					$this->load->view('single_product_admin',$p);

				}else{

					

					$p['data_sku']=$sku_id;

					

					$p['product_data']=$this->Product_descrp_model->select_single_product_data($product_id,$sku_id);

					

					$p['review_result']=$this->Product_descrp_model->retrieve_product_review($sku_id);

					$p['related_prod'] = $this->Product_descrp_model->related_prod($product_id);

					

					

					$this->load->view('single_product_admin',$p);

				}

		

		

	}
	function seller_products(){
		
		if($this->session->userdata('logged_in')){
			$seller_id=$this->uri->segment(4);
			//$seller_id = $this->input->post('slr_id');
			$config = array();
			$config["base_url"] = base_url()."admin/sellers/seller_products/".$seller_id ;
			$config["total_rows"] = $this->Seller_model->seller_productcount($seller_id);
			$config["per_page"] = 50;
			$config["uri_segment"] = 4;
			//$config['use_page_numbers'] = TRUE;
			$config['page_query_string'] = TRUE;
			$choice = $config["total_rows"] / $config["per_page"];
			//print_r(round($choice));exit;
			//$config["num_links"] = round($choice);
			$config["num_links"] = 3;
			$config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
			$config['cur_tag_close'] = '</a>';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Previous';
			
			$this->pagination->initialize($config);
			$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
			//$this->session->set_flashdata('message', 'Data Updated Successfully..');
			$data['seller_product'] = $this->Seller_model->seller_product($config["per_page"], $page,$seller_id);
			//$data['product_details'] = $this->Seller_model->getProductDetails($seller_id);
			
			$data['buss_name'] = $this->Seller_model->bussiness_nm($seller_id);
			$data['links'] = $this->pagination->create_links();
			
			$data['fixed_charge_result'] = $this->Catalog_model->getFixedCharges();
			$data['pg_charge_result'] = $this->Catalog_model->getPgCharges();
			$data['seasonal_charge_result'] = $this->Catalog_model->getSeasonalCharges();
			$data['service_tax_res'] =  $this->Catalog_model->getServiceTax();
			$this->load->view('admin/seller_products', $data);
		}else{
			redirect('admin/super_admin');
		}
		
	}
	
	function seller_products_forbdm(){
		
		if($this->session->userdata('logged_in')){
			$seller_id=$this->uri->segment(4);
			//$seller_id = $this->input->post('slr_id');
			$config = array();
			$config["base_url"] = base_url()."admin/sellers/seller_products_forbdm/".$seller_id ;
			$config["total_rows"] = $this->Seller_model->seller_productcount($seller_id);
			$config["per_page"] = 50;
			$config["uri_segment"] = 4;
			//$config['use_page_numbers'] = TRUE;
			$config['page_query_string'] = TRUE;
			$choice = $config["total_rows"] / $config["per_page"];
			//print_r(round($choice));exit;
			//$config["num_links"] = round($choice);
			$config["num_links"] = 3;
			$config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
			$config['cur_tag_close'] = '</a>';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Previous';
			
			$this->pagination->initialize($config);
			$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
			//$this->session->set_flashdata('message', 'Data Updated Successfully..');
			$data['seller_product'] = $this->Seller_model->seller_product($config["per_page"], $page,$seller_id);
			//$data['product_details'] = $this->Seller_model->getProductDetails($seller_id);
			
			$data['buss_name'] = $this->Seller_model->bussiness_nm($seller_id);
			$data['links'] = $this->pagination->create_links();
			
			$data['fixed_charge_result'] = $this->Catalog_model->getFixedCharges();
			$data['pg_charge_result'] = $this->Catalog_model->getPgCharges();
			$data['seasonal_charge_result'] = $this->Catalog_model->getSeasonalCharges();
			$data['service_tax_res'] =  $this->Catalog_model->getServiceTax();
			$this->load->view('admin/seller_productsforbdm', $data);
		}else{
			redirect('admin/super_admin');
		}
		
	}
	
	function manual_email() {
        if ($this->session->userdata('logged_in')) {

            $id['seller_id'] = $this->uri->segment(4);

            $this->load->view('admin/manual_email', $id);
        } else {

            redirect('admin/super_admin');
        }
    }
	
	function exportseller_products()
	{
		if($this->session->userdata('logged_in')){
		$seller_id=$this->uri->segment('4');
		$data['seller_product'] = $this->Seller_model->exportseller_allproduct($seller_id);
		$this->load->view('admin/export_allsellerproduct',$data);
		
		}else{
			redirect('admin/super_admin');
		}	
			
			
	}
	
	
	function retrieve_commission(){
		$data['cmsn_result'] =  $this->Seller_model->getCommission();
	}
	
	
	
	function filter_sellprod()
		{
			if($this->session->userdata('logged_in')){
			//$seller_id = $data['seller_id'] = $_REQUEST['seller_id'];
			$seller_id=$this->uri->segment(4);
			$data['prod_id'] = $_REQUEST['prod_id'];
			$data['sku'] = $_REQUEST['sku'];	
			$data['prod_nm'] = $_REQUEST['prod_nm'];
			$data['stock'] = $_REQUEST['stock'];	
			$data['mrp'] = $_REQUEST['mrp'];
			$data['sellprce'] = $_REQUEST['sellprce'];
			$data['stat'] = $_REQUEST['stat'];
			$data['specprce'] = $_REQUEST['specprce'];
			$data['status'] = $_REQUEST['status'];
			
			
			$config = array();
			$config["base_url"] = base_url()."admin/sellers/filter_sellprod/".$seller_id;
			$config["total_rows"] = $this->Seller_model->select_filter_sellprod_count($seller_id);
			$config["per_page"] = 50;
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
			$config['suffix'] ='&prod_id='.$data['prod_id'].'&sku='.$data['sku'].'&prod_nm='.$data['prod_nm'].'&stock='.$data['stock'].'&mrp='.$data['mrp'].'&sellprce='.$data['sellprce'].'&specprce='.$data['specprce'].'&status='.$data['status'].'&stat='.$data['stat'];
			
			$this->pagination->initialize($config);
			$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
			$data['seller_product']= $this->Seller_model->select_filtered_sell_prod($config["per_page"], $page,$seller_id);
			$data['buss_name'] = $this->Seller_model->bussiness_nm($seller_id);
			$data['links'] = $this->pagination->create_links();
			$data['fixed_charge_result'] = $this->Catalog_model->getFixedCharges();
			$data['pg_charge_result'] = $this->Catalog_model->getPgCharges();
			$data['seasonal_charge_result'] = $this->Catalog_model->getSeasonalCharges();
			$data['service_tax_res'] =  $this->Catalog_model->getServiceTax();
			$this->load->view('admin/seller_products', $data);
		
			}else{
				redirect('admin/super_admin');
			}
				
		}
		
		
		function filter_sellprodforbdm()
		{
			if($this->session->userdata('logged_in')){
			//$seller_id = $data['seller_id'] = $_REQUEST['seller_id'];
			$seller_id=$this->uri->segment(4);
			$data['prod_id'] = $_REQUEST['prod_id'];
			$data['sku'] = $_REQUEST['sku'];	
			$data['prod_nm'] = $_REQUEST['prod_nm'];
			$data['stock'] = $_REQUEST['stock'];	
			$data['mrp'] = $_REQUEST['mrp'];
			$data['sellprce'] = $_REQUEST['sellprce'];
			$data['stat'] = $_REQUEST['stat'];
			$data['specprce'] = $_REQUEST['specprce'];
			$data['status'] = $_REQUEST['status'];
			
			
			$config = array();
			$config["base_url"] = base_url()."admin/sellers/filter_sellprodforbdm/".$seller_id;
			$config["total_rows"] = $this->Seller_model->select_filter_sellprod_count($seller_id);
			$config["per_page"] = 50;
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
			$config['suffix'] ='&prod_id='.$data['prod_id'].'&sku='.$data['sku'].'&prod_nm='.$data['prod_nm'].'&stock='.$data['stock'].'&mrp='.$data['mrp'].'&sellprce='.$data['sellprce'].'&specprce='.$data['specprce'].'&status='.$data['status'].'&stat='.$data['stat'];
			
			$this->pagination->initialize($config);
			$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
			$data['seller_product']= $this->Seller_model->select_filtered_sell_prod($config["per_page"], $page,$seller_id);
			$data['buss_name'] = $this->Seller_model->bussiness_nm($seller_id);
			$data['links'] = $this->pagination->create_links();
			$data['fixed_charge_result'] = $this->Catalog_model->getFixedCharges();
			$data['pg_charge_result'] = $this->Catalog_model->getPgCharges();
			$data['seasonal_charge_result'] = $this->Catalog_model->getSeasonalCharges();
			$data['service_tax_res'] =  $this->Catalog_model->getServiceTax();
			$this->load->view('admin/seller_productsforbdm', $data);
		
			}else{
				redirect('admin/super_admin');
			}
				
		}
		
		
}




?>