<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bulk_productlog extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$this->load->helper(array('html','form','url'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('encrypt');
		$this->load->library('javascript');
		$this->load->helper('string');
		$this->load->helper('file');		
		$this->load->database();
		$this->load->library('pagination');
		$this->load->model('admin/Bulkproduct_model');
		
		
		
		
		

	}

	
	function bulk_newproductlog()
	{
		
		if($this->session->userdata('logged_in')){
			
			
		 	
		$config = array();

			$config["base_url"] = base_url()."admin/Bulk_productlog/bulk_newproductlog";
			$config["total_rows"] = $this->Bulkproduct_model->select_allnewproductuploadlist_count();
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
			//$data['sellers'] = $this->Seller_model->getSellersForAdminList($config["per_page"], $page);
			$data['links'] = $this->pagination->create_links();
						
			$data['uploadlist']=$this->Bulkproduct_model->select_allnewproductuploadlist($config["per_page"], $page);
				
			$this->load->view('admin/bulk_newproductexcellist',$data);
				
		}else{
			redirect('admin/super_admin');
		}	
			
	}
	
	
	
		function filter_newproduploadlog()
		{
		
		if($this->session->userdata('logged_in')){
			$data['excelfilename_name'] = $_REQUEST['excelfilename_name'];	
			$data['seller_name'] = $_REQUEST['seller_name'];			
			$data['download_date_from'] = $_REQUEST['download_date_from'];				
			$data['download_date_to'] = $_REQUEST['download_date_to'];			
			$data['upload_from'] = $_REQUEST['upload_from'];			
			$data['upload_to'] = $_REQUEST['upload_to'];
			
			
			
			$config = array();
			$config["base_url"] = base_url()."admin/Bulk_productlog/filter_newproduploadlog";
			$config["total_rows"] = $this->Bulkproduct_model->select_allnewproductuploadlist_filtercount();
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
			$config['suffix'] ='&excelfilename_name='.$data['excelfilename_name'].'&seller_name='.$data['seller_name'].'&download_date_from='.$data['download_date_from'].'&download_date_to='.$data['download_date_to'].'&upload_from='.$data['upload_from'].'&upload_to='.$data['upload_to'];
			
			$this->pagination->initialize($config);
			$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
			
			$data['uploadlist']= $this->Bulkproduct_model->select_allnewproductuploadlist_filter($config["per_page"], $page);
			$data['links'] = $this->pagination->create_links();
			
			$this->load->view('admin/bulk_newproductexcellist',$data);
		
		}
		else{
			redirect('admin/super_admin');
		}
		
			
	}
	
	
	
	
	

	function bulk_newproduct_editlog()
	{
		if($this->session->userdata('logged_in')){		
			
			$config = array();

			$config["base_url"] = base_url()."admin/Bulk_productlog/bulk_newproduct_editlog";
			$config["total_rows"] = $this->Bulkproduct_model->select_allnewproductupload_edit_count();
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
			//$data['sellers'] = $this->Seller_model->getSellersForAdminList($config["per_page"], $page);
			$data['links'] = $this->pagination->create_links();
						
			$data['uploadlist']=$this->Bulkproduct_model->select_allnewproductupload_edit_list($config["per_page"], $page);
				
			$this->load->view('admin/bulk_new_editedproductexcellist',$data);
				
		}else{
			redirect('admin/super_admin');
		}		
	}
	
	
	
}  // class End
