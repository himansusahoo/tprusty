<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalog extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('html','form','url'));
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->library('session');
		$this->load->library('encrypt');
		$this->load->library('javascript');
		$this->load->library('upload');
		$this->load->database();
		$this->load->model('admin/Manage_category_model');
		$this->load->model('admin/Product');
		$this->load->library('pagination');
		
		
		
		$this->load->library('ckeditor');
		$this->load->library('ckfinder');
		$this->ckeditor->basePath = base_url().'asset/ckeditor/';
		$this->ckeditor->config['toolbar'] = array(
                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' ) );
		$this->ckeditor->config['language'] = 'it';
		$this->ckeditor->config['width'] = '730px';
		$this->ckeditor->config['height'] = '300px';
		//Add Ckfinder to Ckeditor
		$this->ckfinder->SetupCKEditor($this->ckeditor,'base_url()/asset/ckfinder/');
	}
	

	function index(){
		if($this->session->userdata('logged_in')){
			$data['id'] = $this->input->post('id_1');           	
			$data['name'] = $this->input->post('name1');					
			$data['slr_name'] = $this->input->post('slr_nm');				
			$data['select_att_name'] = $this->input->post('select_att_name');			
			$data['sku'] = $this->input->post('sku');			
			$data['id_from'] = $this->input->post('id_from1');			
			$data['id_to'] = $this->input->post('id_to1');		
			$data['id_from2'] = $this->input->post('id_from2');	
			$data['id_to2'] = $this->input->post('id_to2');		
			$data['status'] = $this->input->post('status_name1');
			
			$config = array();
			$config["base_url"] = base_url()."admin/catalog";
			$config["total_rows"] = $this->Product->retrive_product_details_count();
			$config["per_page"] = 200;
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
			$data['result'] = $this->Product->retrive_product_details_catalog($config["per_page"], $page);
			$data['links'] = $this->pagination->create_links();
			
			//$data['result'] = $this->Product->retrive_product_details();
			$data['result_attr_group'] = $this->Product->retrive_product_attribute_group();
			$this->load->view('admin/manage_products',$data);
		}else{
			redirect('admin/super_admin');
		}
	}
	function export_toexcel()
	{
		$data['result'] = $this->Product->export_product_details();
		$this->load->view('admin/export_allproduct',$data);
	}
	
	function autofill_seller(){
		$data['autofilldata'] = $this->Product->search_seller_name();
		$this->load->view('admin/autofill_seller',$data);
	}
	
	
	function filtered_products()
	{
		if($this->session->userdata('logged_in')){
			$data['id'] = $_REQUEST['id_1'];
			$data['name'] = $_REQUEST['name1'];
			$data['slr_name'] = $_REQUEST['slr_nm'];
			$data['select_att_name'] = $_REQUEST['select_att_name'];
			$data['sku'] = $_REQUEST['sku'];
			$data['id_from'] = $_REQUEST['id_from1'];
			$data['id_to'] = $_REQUEST['id_to1'];	
			$data['id_from2'] = $_REQUEST['id_from2'];
			$data['id_to2'] = $_REQUEST['id_to2'];
			$data['status'] = $_REQUEST['status_name1'];

			$config = array();
			$config["base_url"] = base_url()."admin/catalog/filtered_products";
			$config["total_rows"] = $this->Product->filter_product_details_count();
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
			$config['suffix'] ='&id_1='.$data['id'].'&name1='.$data['name'].'&slr_nm='.$data['slr_name'].'&select_att_name='.$data['select_att_name'].'&sku='.$data['sku'].'&id_from1='.$data['id_from'].'&id_to1='.$data['id_to'].'&id_from2='.$data['id_from2'].'&id_to2='.$data['id_to2'].'&status_name1='.$data['status'];
			
			$this->pagination->initialize($config);
			$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
			
			$data['result'] = $this->Product->filter_product_details($config["per_page"], $page);
			$data['links'] = $this->pagination->create_links();
			
			//$data['result'] = $this->Product->filter_product_details();
			$data['result_attr_group'] = $this->Product->retrive_product_attribute_group();
			$this->load->view('admin/manage_products',$data);
		}else{
			redirect('admin/super_admin');
		}
	}
	
	
	function manage_category(){
		
		if($this->session->userdata('logged_in')){
			
			$result=$this->Manage_category_model->select_allcategory();
			$count_rows=$result->num_rows();
		
			$config = array();
			$config["base_url"] = base_url() . "admin/catalog/manage_category";
			
			
			$config["total_rows"] = $count_rows;
			$config["per_page"] = 10;
			//$config["uri_segment"] = 3;
			$config["page_query_string"] = TRUE;
			$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] = 5;
			
			$config['cur_tag_open'] = '&nbsp;<a style="background-color:white" class="current">&nbsp;';
			$config['cur_tag_close'] = '&nbsp;&nbsp;</a>';
			$config['next_link'] = '&nbsp;Next';
			$config['prev_link'] = 'Previous&nbsp;';
	 
			$this->pagination->initialize($config);
	 
			//$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
			$data['result'] = $this->Manage_category_model->select_allcategoryinfo($config["per_page"], $page);
			$data["links"] = $this->pagination->create_links();
			$data['result'] = $this->Manage_category_model->select_allcategoryinfo($config["per_page"], $page);
			$data["links"] = $this->pagination->create_links();
						
			$data['data2']=$this->Manage_category_model->select_category_list();
			$data['catg_info']=$this->Manage_category_model->select_allcategory();
		$this->load->view('admin/manage_categories',$data);
		
		}else{
			redirect('admin/super_admin');
		}
		
	}
	
	function filter_category()
	{
		if($this->session->userdata('logged_in')){
			
		$p['data']="";
		$p['data2']=$this->Manage_category_model->select_category_list();
		$p['catg_info']=$this->Manage_category_model->filtered_select_allcategory();
		$this->load->view('admin/category_list',$p);
		}
		else
		{
			redirect('admin/super_admin');
		}
			
	}
	
	function save_category()
	{
		
		if($this->session->userdata('logged_in')){
		$f=$this->Manage_category_model->insert_category();
		redirect('admin/Catalog/load_manage_categories/'.$f);
			
		}else{
			redirect('admin/super_admin');
		}
				
	}
	
	function save_menu()
	{
		if($this->session->userdata('logged_in')){
		$f=$this->Manage_category_model->insert_pcmenu();
		redirect('admin/Catalog/load_manage_categories/'.$f);	
				
			
		}else{
			redirect('admin/super_admin');
		}	
			
	}
	
	function load_manage_categories()
	{
		
		if($this->session->userdata('logged_in')){
			
			$f=$this->uri->segment(4);			 
			if($f==true){
//			
//			$result=$this->Manage_category_model->select_allcategory();
//			$count_rows=$result->num_rows();
//		
//			$config = array();
//			$config["base_url"] = base_url() . "admin/catalog/manage_category";
//			
//			
//			$config["total_rows"] = $count_rows;
//			$config["per_page"] = 10;
//			//$config["uri_segment"] = 3;
//			$config["page_query_string"] = TRUE;
//			$choice = $config["total_rows"] / $config["per_page"];
//			$config["num_links"] = round($choice);
//			
//			$config['cur_tag_open'] = '&nbsp;<a style="background-color:white" class="current">&nbsp;';
//			$config['cur_tag_close'] = '&nbsp;&nbsp;</a>';
//			$config['next_link'] = '&nbsp;Next';
//			$config['prev_link'] = 'Previous&nbsp;';
//	 
//			$this->pagination->initialize($config);
//	 
//			//$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
//			$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
//			$p['result'] = $this->Manage_category_model->select_allcategoryinfo($config["per_page"], $page);
//			$p["links"] = $this->pagination->create_links();
//			$p['result'] = $this->Manage_category_model->select_allcategoryinfo($config["per_page"], $page);
//			$p["links"] = $this->pagination->create_links();
				
				
				
				
			$p['data']="Record saved Successfully";
			$p['data2']=$this->Manage_category_model->select_category_list();
			$p['catg_info']=$this->Manage_category_model->select_allcategory();
			$this->load->view('admin/category_list',$p);	}
					
			
			}else{
			redirect('admin/super_admin');
			}	
			
	}
	
	function save_subcategory()
	{
		if($this->session->userdata('logged_in')){
			
		//$catg_id=$this->uri->segment(4);
		$f=$this->Manage_category_model->insert_subcategory();
		redirect('admin/Catalog/load_manage_subcategories/'.$f);
			
		}else{
			redirect('admin/super_admin');
		}	
	}
	
	
	function load_manage_subcategories()
	{
		
		if($this->session->userdata('logged_in')){			 
			
			//$res['data']="";
			
			$f=$this->uri->segment(4);			 
			if($f==true){
			$p['data']="Record saved Successfully";
			$p['data2']=$this->Manage_category_model->select_category_list();
			$p['catg_info']=$this->Manage_category_model->select_allcategory();
			$this->load->view('admin/category_list',$p);
			}
			
			}else{
			redirect('admin/super_admin');
			}
			
	}
	
	
	function add_subcategory()
	{
		if($this->session->userdata('logged_in')){
			
			$catg_id=$this->uri->segment(4);				 
			$res['data']="";
			
			$res['catg_info']=$this->Manage_category_model->select_category_data($catg_id);
			
			$res['data2']=$this->Manage_category_model->select_category_list();
			
			$res['catg_info1']=$this->Manage_category_model->select_allcategory();
				
			$this->load->view('admin/add_subcategory',$res);
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function delete_category()
	{
		if($this->session->userdata('logged_in')){
				
			$this->Manage_category_model->delete_category();	
			
		}
		else
		{
				
		}
	}
	
	function addnew_product()
	{
		if($this->session->userdata('logged_in')){
			$res['data2']=$this->Manage_category_model->select_category_list();
			//$res['result'] = $this->Product->retrive_product_attribute_group();
			$res['tax_class_result'] = $this->Product->retrive_product_tax_class();
			$res['result_product'] = $this->Product->retrive_product_details();
			$res['result_attr_group'] = $this->Product->retrive_product_attribute_group();
			$res['all_category_result'] = $this->Product->retrieve_all_category();
			$this->load->view('admin/add_new_product_form',$res);
		}else{
			redirect('admin/super_admin');
		}
	}
	
	/*function addnew_product_form1()
	{
		if($this->session->userdata('logged_in')){
			$this->load->view('admin/add_new_product_form1');
		}else{
			redirect('admin/super_admin');
		}
	}*/
	
	/*function addnew_product_form2()
	{
		if($this->session->userdata('logged_in')){ 
			$result = $this->Product->insert_product_setting();
			redirect('admin/catalog/load_addnew_product_form2/'.base64_encode($this->encrypt->encode($result)));			
		}else{
			redirect('admin/super_admin');
		}
	}*/
	
	/*function load_addnew_product_form2()
	{
		if($this->session->userdata('logged_in')){
			$this->load->view('admin/add_new_product_form2');						
		}else{
			redirect('admin/super_admin');
		}	
	}*/
	
	/*function addnew_product_form3()
	{
		if($this->session->userdata('logged_in')){
			$result = $this->Product->insert_product_general_info();
			redirect('admin/catalog/load_product_form3/'.base64_encode($this->encrypt->encode($result)));
		}else{
			redirect('admin/super_admin');
		}
	}*/
	
	/*function load_product_form3(){
		if($this->session->userdata('logged_in')){
			$this->load->view('admin/add_new_product_form3');
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function find_product_price(){
		$result = $this->Product->insert_product_price_info();
		if($result){
			redirect('admin/catalog');
		}
	}
	
	function addnew_product_form4()
	{
		if($this->session->userdata('logged_in')){
			$this->load->view('admin/add_new_product_form4');
		}else{
			redirect('admin/super_admin');
		}		
	}*/
	
	function get_new_product_data(){
		//////image uploading script start here/////
		/*$name_array = array();
		$count = count($_FILES['userfile']['size']);
		foreach($_FILES as $key=>$value)
		for($s=0; $s<=$count-1; $s++){
		//for($s=0; $s<=5; $s++){
			$_FILES['userfile']['name']=$value['name'][$s];
			$_FILES['userfile']['type'] = $value['type'][$s];
			$_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
			$_FILES['userfile']['error'] = $value['error'][$s];
			$_FILES['userfile']['size'] = $value['size'][$s];				
				
			$config['upload_path'] = './images/product_img/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$this->load->library('upload');
			$this->upload->initialize($config);
			
			if(!$this->upload->do_upload()){
				$error = array('error' => $this->upload->display_errors());    
				$this->load->view('admin/add_new_product_form', $error);
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
				$this->image_lib->clear();
				$this->image_lib->initialize($configi);   
				$success_resize = $this->image_lib->resize();
			}
			$name_array[] = $data['upload_data']['file_name'];
		}*/
		//////image uploading script end here/////
		
		//if($success_resize){
			//$seller_id = $this->session->userdata('seller-session');
			//$insert_result = $this->Product->insert_product_data($name_array);
			$insert_result = $this->Product->insert_product_data();
			if($insert_result == true){
				$this->session->set_flashdata('product_add', 'Product added successfully.');
				
				if($this->session->userdata('logged_in')!=ADMIN_MAIL)
				{
					$this->Product->insert_product_data_log();
				}
				redirect('admin/catalog');
			}else{
				redirect('admin/catalog/addnew_product');
			}
		/*}else{
			redirect('admin/catalog/addnew_product');
		}*/
			
		/*$result = $this->Product->insert_product_data($name_array);
		if($result == true){
			redirect('admin/catalog');
		}*/
	}
	
	/*function set_upload_options(){
		//upload an image options
		$config = array();
		$config['upload_path'] = './images/product_img/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '2048';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		$config['overwrite'] = FALSE;
		return $config;
	}*/
	
	/*function update_product_data(){
		if($this->session->userdata('logged_in')){
			if($_FILES['userfile']['name'][0] != ''){
				$files = $_FILES;	
				$cpt = count($_FILES['userfile']['name']); 
				for($i=0; $i<=$cpt-1; $i++){
					$_FILES['userfile']['name']= rand(0, 1000).'_'.$files['userfile']['name'][$i];
					$_FILES['userfile']['type']= $files['userfile']['type'][$i];
					$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
					$_FILES['userfile']['error']= $files['userfile']['error'][$i];
					$_FILES['userfile']['size']= $files['userfile']['size'][$i];
					
					$arr_image[$i] = $_FILES['userfile']['name']; 
					$arr_image[$i] = str_replace(' ', '_', $arr_image[$i]);
					
					$config['upload_path'] = './images/product_img/';
					$config['allowed_types'] = 'gif|jpg|jpeg|png';
					
					$this->load->library('upload');
					$this->upload->initialize($config);
					if ( ! $this->upload->do_upload()){
						$error = array('error' => $this->upload->display_errors());    
						$this->load->view('admin/catalog', $error);
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
						$this->image_lib->clear();
						$this->image_lib->initialize($configi);   
						$success_resize = $this->image_lib->resize();
					}
				}
				if($success_resize){
					$insert_result = $this->Product->update_new_product($arr_image);
					if($insert_result == true){
						redirect('admin/catalog');
					}else{
						redirect('admin/catalog');
					}
				}else{
					redirect('admin/catalog');
				}
			}else{
				$insert_result = $this->Product->update_new_product1();
				if($insert_result == true){
					redirect('admin/catalog');
				}
			}
		}else{
			redirect('admin/super_admin');
		}
	}*/
	
	function update_product_data(){
		if($this->session->userdata('logged_in')){
			
				$insert_result = $this->Product->update_new_product();
				
				$product_id = $this->input->post('hidden_product_id');		
				$product_sku = $this->input->post('hidden_product_sku');
				
				$prodsetting_edited = $this->input->post('prod_setting');
				$prodgeninfo_edited = $this->input->post('prod_geninfo');
				 
				//$this->load->model('Cornjob_productinsermodel');
				//if($prodgeninfo_edited!='')
//				{$this->Cornjob_productinsermodel->update_cornjob_singleproduct_datainfo($product_id,$product_sku);}
//				
				//if($prodsetting_edited!='')
//				{ 
//					$this->Cornjob_productinsermodel->update_other_data_cronjobproductsearch($product_sku);
//				} // comment due to page slow when save edited data
				
				//if($this->session->userdata('logged_in')!=ADMIN_MAIL)
				//{
					$this->Product->update_new_product_log();	
				//}
				
				if($insert_result == true){
					redirect('admin/catalog');
				}
			//}
		}else{
			redirect('admin/super_admin');
		}
	}
	
	
	function update_approved_existing_product_data(){
		if($this->session->userdata('logged_in')){
			$insert_result = $this->Product->update_inn_approved_existing_product_data();
			
		$product_id = $this->input->post('hidden_product_id');		
		$product_sku = $this->input->post('hidden_product_sku');
		$this->load->model('Cornjob_productinsermodel');
		//$this->Cornjob_productinsermodel->update_cornjob_singleproduct_info($product_id,$product_sku);	
		$this->Cornjob_productinsermodel->update_cornjob_singleproduct_datainfo($product_id,$product_sku);	
			
			if($insert_result == true){
				redirect('admin/sellers/product_exiting_for_approve');
			}
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function update_nonapproved_existing_product_data(){
		if($this->session->userdata('logged_in')){
			$insert_result = $this->Product->update_inn_nonapproved_existing_product_data();
			if($insert_result == true){
				redirect('admin/sellers/product_exiting_for_approve');
			}
		}else{
			redirect('admin/super_admin');
		}
	}
	
	
	function update_pending_product_data(){
		if($this->session->userdata('logged_in')){
			$insert_result = $this->Product->update_pending_new_product();
			
			$product_id = $this->input->post('hidden_product_id'); 		
			$product_sku = $this->input->post('hidden_product_sku');
			$this->load->model('Cornjob_productinsermodel');
			//$this->Cornjob_productinsermodel->update_cornjob_singleproduct_info($product_id,$product_sku);
			$this->Cornjob_productinsermodel->update_cornjob_singleproduct_datainfo($product_id,$product_sku);
			if($insert_result == true){
				redirect('admin/sellers/product_for_approve');
			}
		}else{
			redirect('admin/super_admin');
		}
	}
	
	//---
	function reset_for_add_subcategory()
	{
		if($this->session->userdata('logged_in')){
			$catg_id=$this->uri->segment(4);				 
			$res['data']="";
			$res['catg_info']=$this->Manage_category_model->select_category_data($catg_id);
			$res['data2']=$this->Manage_category_model->select_category_list();
			$res['catg_info1']=$this->Manage_category_model->select_allcategory();
			$this->load->view('admin/insert_sub_category',$res);
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function edit_subcategory()
	{
		if($this->session->userdata('logged_in')){		
			$catg_id=$this->uri->segment(4);
			$p=$this->Manage_category_model->edit_subcategory_data($catg_id);			
			redirect('admin/Catalog/load_manage_categories/'.$p);			
		}else{
			redirect('admin/super_admin');
		}				
	}
	
	function checksku(){
		$result = $this->Product->checking_sku();
		if($result == true){
			echo 'exists';exit;
		}else{
			echo 'avail';exit;
		}
	}
	
	// Admin Product Edit
	function product_edit(){
		if($this->session->userdata('logged_in')){
			$product_id = $this->uri->segment(4);
			$sku = base64_decode($this->uri->segment(5));
			$sku = $this->encrypt->decode($sku);
			$result = $this->Product->getProductDetails($product_id, $sku);
			
			//seller id for temp_product_img table
			$seller_id = 0;
			$this->session->set_userdata('session_slr_id',$seller_id);
			
			//$result1=$this->Product->getProductAttrValues($product_id, $sku);
			$result1=$this->Product->getProductAttrValues1($sku);
			if($result != false){
				$data['product_id']=$product_id;
				$data['edit_product_details'] = $result;
				$data['attribute_val'] = $result1;
				$data['result'] = $this->Product->retrive_product_attribute_group();//commented by santanu dt:26-09-2016
				
				//$data['result'] = $this->Product->retrive_product_attribute_group1($product_id);
				
				//$data['tax_class_result'] = $this->Product->retrive_product_tax_class();
				//$data['data2']=$this->Manage_category_model->select_category_list();
				//$data['result_product'] = $this->Product->retrive_product_details();
				//$data['result_product_related'] = $this->Product->retrive_product_details_for_relative($sku);
				//$data['only_related_product'] = $this->Product->retrieve_only_related_products($sku);
				$this->load->model('admin/Attribute_model');
				$data['color_result'] = $this->Attribute_model->retrieve_colors();
				$this->load->view('admin/edit_product_form', $data);
			}
		}else{
			redirect('admin/super_admin');
		}
	}
	
	
	function load_related_products(){
		$sku = $this->input->post('sku');
		$data['result_product_related'] = $this->Product->retrive_product_details_for_relative($sku);
		$data['only_related_product'] = $this->Product->retrieve_only_related_products($sku);
		$this->load->view('admin/load_ajax_related_product', $data);
	}
	
	
	function existing_product_edit(){
		if($this->session->userdata('logged_in')){
			$product_id = $this->uri->segment(4);
			$sku = base64_decode($this->uri->segment(5));
			$sku = $this->encrypt->decode($sku);
			
			//checking weather this products is approved or not
			$check = $this->Product->check_existing_product_approved_r_not($sku);
			//program start for approved existing product//
			if($check === true){
				//$result = $this->Product->getProductDetails($product_id, $sku);
				$result = $this->Product->getProductExitingDetails_4_edit($product_id, $sku);
				
				//get and store seller id in session
				//$seller_id = $this->Product->getting_exiting_product_seller_id($sku);
				$seller_id = $result[0]->seller_id;
				$this->session->set_userdata('session_slr_id',$seller_id);
				
				//$result1=$this->Product->getProductAttrValues($product_id, $sku);
				//$result1=$this->Product->getProductAttrValues1($sku); 
				if($result != false){
					//$data['attribute_val'] = $result1;
					//$data['tax_class_result'] = $this->Product->retrive_product_tax_class();
					//$data['data2']=$this->Manage_category_model->select_category_list();
					//$data['result_product_related'] = $this->Product->retrive_product_details_for_relative($sku);
					//$data['only_related_product'] = $this->Product->retrieve_only_related_products($sku);
					//$this->load->model('admin/Attribute_model');
					//$data['color_result'] = $this->Attribute_model->retrieve_colors();
					//$data['result_product'] = $this->Product->retrive_product_details();
					
					$data['product_id']=$product_id;
					$data['edit_product_details'] = $result;
					$data['result'] = $this->Product->retrive_product_attribute_group();
					$this->load->view('admin/edit_form_4_existing_approved_product', $data);
				}
			}
			//program end of approved existing product//
			else
			//program start for non approved existing product//
			{
				$result = $this->Product->get_nonapproved_existing_product_edit($product_id, $sku);
				if($result != false){
					$data['product_id']=$product_id;
					$data['edit_product_details'] = $result;
					$data['result'] = $this->Product->retrive_product_attribute_group();
					//$data['data2']=$this->Manage_category_model->select_category_list();
					$this->load->view('admin/edit_form_4_existing_nonapproved_product', $data);
				}
			}
			//program end of non approved existing product//
		}else{
			redirect('admin/super_admin');
		}
	}
	
	
	function pending_product_edit(){
		if($this->session->userdata('logged_in')){
			$slr_product_id = $this->uri->segment(4);
			$sku = base64_decode($this->uri->segment(5));
			$sku = $this->encrypt->decode($sku);
			$result = $this->Product->get_pending_ProductDetails($slr_product_id, $sku);
			$result1 = $this->Product->get_pending_ProductAttrValues($sku);
			
			//get and store seller id in session
			//$seller_id = $this->Product->getting_seller_id($sku);
			$seller_id = $result[0]->seller_id;
			$this->session->set_userdata('session_slr_id',$seller_id);
			
			if($result != false){
				$data['product_id']=$slr_product_id;
				$data['edit_product_details'] = $result;
				$data['attribute_val'] = $result1;
				$data['result'] = $this->Product->retrive_product_attribute_group();
				//$data['tax_class_result'] = $this->Product->retrive_product_tax_class();
				//$data['data2'] = $this->Manage_category_model->select_category_list();
				//$data['result_product'] = $this->Product->retrive_seller_product_details();
				
				//related product in designing copy from edit_product_form page and paste in edit_pending_product_form page-
				//and uncomment bellow two lines if required in feature 
				//$data['result_product_related'] = $this->Product->retrive_product_details_for_relative($sku);
				//$data['only_related_product'] = $this->Product->retrieve_only_related_products($sku);
				$this->load->model('admin/Attribute_model');
				$data['color_result'] = $this->Attribute_model->retrieve_colors();
				$this->load->view('admin/edit_pending_product_form',$data);
			}			
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function load_pending_product_meta_info(){
		$data['pending_meta_info'] = $this->Product->getting_pending_product_meta_info();
		$this->load->view('admin/load_ajx_meta_info',$data);
	}
	
	function load_pending_product_prc_n_invtry_info(){
		$data['edit_product_details'] = $this->Product->getting_pending_product_prc_n_invntry_info();
		$this->load->view('admin/load_ajx_price_inventory_info',$data);
	}
	
	
	function edit_productimg(){
		if($this->session->userdata('logged_in')){
			$result = $this->Product->getDeleteProductImage();
			if($result === true){
				echo "success";
			}else{
				echo "not";
			}
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function edit_pending_productimg(){
		if($this->session->userdata('logged_in')){
			$result = $this->Product->getDelete_pending_ProductImage();
			if($result === true){
				echo "success";
			}else{
				echo "not";
			}
		}else{
			redirect('admin/super_admin');
		}
	}
	
	
	function upload_product_tmp_image(){
		//$output_dir = "./images/product_img/";
		if(isset($_FILES["userfile"]))
		{
			$ret = array();
		//	This is for custom errors;	
		/*	$custom_error= array();
			$custom_error['jquery-upload-file-error']="File already exists";
			echo json_encode($custom_error);
			die();
		*/
			$error =$_FILES["userfile"]["error"];
			//You need to handle  both cases
			//If Any browser does not support serializing of multiple files using FormData()
			if(!is_array($_FILES["userfile"]["name"])) //single file
			{
				/*$fileName = $_FILES["userfile"]["name"];
				move_uploaded_file($_FILES["userfile"]["tmp_name"],$output_dir.$fileName);
				$ret[]= $fileName;*/
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
					$this->load->view('admin/add_new_product_form', $error);
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
					/*$fileName = $_FILES["userfile"]["name"][$i];
					move_uploaded_file($_FILES["userfile"]["tmp_name"][$i],$output_dir.$fileName);
					$ret[]= $fileName;*/
				
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
						$this->load->view('admin/add_new_product_form', $error);
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
			$this->Product->insert_product_tmp_img_4_admin($name_array);
			//echo json_encode($ret);
			echo json_encode($name_array);
		}
	}
	
	
	function delete_product_tmp_image(){
		$output_dir = "./images/product_img/";
		if(isset($_POST["op"]) && $_POST["op"] == "delete" && isset($_POST['name']))
		{
			$fileName =$_POST['name'];
			$fileName=str_replace("..",".",$fileName); //required. if somebody is trying parent folder files	
			$filePath = $output_dir. $fileName;
			$thumb_filePath = $output_dir. 'catalog_'.$fileName;
			if (file_exists($filePath)) 
			{
				unlink($filePath);
				unlink($thumb_filePath);
			}
			//delete file from temp_product_img table//
			$this->Product->delete_product_tmp_img($fileName);
			echo "Deleted File ".$fileName."<br>";
		}
	}
	
	/*function download_product_tmp_image(){
		if(isset($_GET['filename']))
		{
		$fileName=$_GET['filename'];
		$fileName=str_replace("..",".",$fileName); //required. if somebody is trying parent folder files
		$file = "uploads/".$fileName;
		$file = str_replace("..","",$file);
		if (file_exists($file)){
			$fileName =str_replace(" ","",$fileName);
			header('Content-Description: File Transfer');
			header('Content-Disposition: attachment; filename='.$fileName);
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();
			readfile($file);
			exit;
		}
		}
	}*/
	
	
	
	
	
}


?>