<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_bulk_existingproduct Extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('html','form','url'));
		$this->load->library('form_validation');
		//$this->load->library('email');
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->library('encrypt');
		$this->load->library('javascript');
		$this->load->helper('string');
		$this->load->library('pagination');			
		$this->load->database();		
		//$this->load->model('admin/Bulkporductupload_model');	
		$this->load->model('admin/Bulk_existingporductupload_model');	
	}
	
	function bulk_existingproductupload_forseller()
	{
		if($this->session->userdata('logged_in')){
		
			$this->load->model('admin/Seller_model');
			$data['categories'] = $this->Seller_model->getCategories();
			
			$this->load->model('admin/Bulkporductupload_model');	
			$data['attrbset'] = $this->Bulkporductupload_model->getattributeset();
			
			$data['seller_id']=$this->uri->segment(4);
			
			
			$this->load->view('admin/upload_bulk_existingproductfor_single_seller',$data);	
			
		}else{
			redirect('admin/super_admin');
		}	
	}
	
	function select_productfor_addexistingproduct()
	{
		if($this->session->userdata('logged_in')){
		
			//$catg_id=implode(',',$this->input->post('subcatgid'));		
			  $catg_id=$this->input->post('hidden_subcatgtxtbox');		
			// $attrbsetid=$this->input->post('attrbid');			
			 $attrbsetid=$this->input->post('attribute_set');
			 
			//$seller_id=$this->input->post('selr_id');
			$seller_id=$this->input->post('hdntxt_sellerid');
			if($seller_id=='')
			{$seller_id=$this->uri->segment(6);}
			
			if($catg_id=='' &&  $attrbsetid=='')
			{
				$catg_id = @$_REQUEST['catg_id'];
				$attrbsetid = @$_REQUEST['attrbsetid'];
			}
			
			
			$config = array();
			$config["base_url"] = base_url()."admin/Upload_bulk_existingproduct/select_productfor_addexistingproduct/".$catg_id.'/'.$attrbsetid.'/'.$seller_id.'/';
			$config["total_rows"] = $this->Bulk_existingporductupload_model->search_bulkexisting_product_listcount($catg_id,$attrbsetid);
			$config["per_page"] = 200;
			$config["uri_segment"] = 3;
			//$config['use_page_numbers'] = TRUE;
			$config['page_query_string'] = TRUE;
			$config['enable_query_strings'] = TRUE;
			$config['reuse_query_string'] = TRUE;
			$choice = $config["total_rows"] / $config["per_page"];
			
			//$config["num_links"] = round($choice);
			$config["num_links"] = 3;
			$config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
			$config['cur_tag_close'] = '</a>';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Previous';
			$config['suffix'] ='&catg_id='.$catg_id.'&attrbsetid='.$attrbsetid;
						
			$this->pagination->initialize($config);
			$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
			$data['links'] = $this->pagination->create_links();
						
		$data['search_result']= $this->Bulk_existingporductupload_model->search_bulkexisting_product_list($config["per_page"], $page,$catg_id,$attrbsetid);		
			
			//$data['search_result'] = $this->Bulk_existingporductupload_model->search_bulkexisting_product_list($catg_id,$attrbsetid);		
			
			//$this->load->view('admin/view_selectedexistingproductfor_singleseller_ajax',$data);	
			$data['catg_id']=$catg_id;
			$data['attrbsetid']=$attrbsetid;
			$data['seller_id']=$seller_id;
			$this->load->view('admin/view_selectedexistingproductfor_singleseller',$data);	
			
		}else{
			redirect('admin/super_admin');
		}	
		
			
	}
	
	function filter_bulkexisting_product()
	{
			if($this->session->userdata('logged_in')){
			
			/* $catg_id=$this->input->post('hidden_subcatgtxtbox');			
			 $attrbsetid=$this->input->post('attribute_set');
			 
			 if($catg_id=='' &&  $attrbsetid=='')
			 {
			 	$catg_id=$this->session->userdata('catgid');
			 	$attrbsetid=$this->session->userdata('attrbid');	
			 }
			 
			if($catg_id=='' &&  $attrbsetid=='')
			{
				$catg_id = $_REQUEST['catg_id'];
				$attrbsetid = $_REQUEST['attrbsetid'];
			}*/
			
			$catg_id=$this->uri->segment(4);
			$attrbsetid=$this->uri->segment(5);
			$seller_id=$this->uri->segment(6);
			
			$from_dtm = $_REQUEST['from_dtm'];	
			$to_dtm = $_REQUEST['to_dtm'];
			$prod_name = $_REQUEST['prod_name'];
			$prod_sku = $_REQUEST['prod_sku'];
			$slr_name = $_REQUEST['seller_name'];
				
			
			$config = array();
			$config["base_url"] = base_url()."admin/Upload_bulk_existingproduct/filter_bulkexisting_product/".$catg_id.'/'.$attrbsetid.'/'.$seller_id.'/';
			$config["total_rows"] = $this->Bulk_existingporductupload_model->search_bulkexisting_productlist_filtercount();
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
			$config['suffix'] ='&catg_id='.$catg_id.'&attrbsetid='.$attrbsetid.'&from_dtm='.$from_dtm.'&to_dtm='.$to_dtm.'&prod_name='.$prod_name.'&prod_sku='.$prod_sku.'&slr_name='.$slr_name;
						
			$this->pagination->initialize($config);
			$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
			
			$data['search_result']= $this->Bulk_existingporductupload_model->search_bulkexisting_productlist_filter($config["per_page"], $page);
			$data['links'] = $this->pagination->create_links();			
			
			$data['catg_id']=$catg_id;
			$data['attrbsetid']=$attrbsetid;
			$data['seller_id']=$seller_id;
			
			$this->load->view('admin/view_selectedexistingproductfor_singleseller',$data);	
			
		}else{
			redirect('admin/super_admin');
		}		
	}
	
	
	
	
	function select_attrbsetascategorywise()
	{
		//$seller_id=$this->input->post('seler_id');
		$catg_id=$this->input->post('catg_id');
		
		$data['edit_attrbset'] = $this->Bulk_existingporductupload_model->getexistingproduct_attributeset_ascatg($catg_id);
		
		$this->load->view('admin/attrbset_as_categorywise',$data);
			
	}
	
	function bulk_existingproductupload_panel()
	{
		if($this->session->userdata('logged_in')){
			
			$data['seller_id']=$this->uri->segment(4);
			$this->load->view('admin/upload_bulkexistingproduct_panel',$data);
		
		}else{
			redirect('admin/super_admin');
		}
			
	}
	
	function uploadlog_extingproductlist()
	{
		if($this->session->userdata('logged_in')){
		
		$seller_id=$this->uri->segment(4);
		
		$data['uploadlist']=$this->Bulk_existingporductupload_model->select_uploadlistsellerwise($seller_id);
		$data['seller_id']=$seller_id;
		$this->load->view('admin/bulkexitingproductexcel_listsellerwise',$data);
			
		}else{
			redirect('admin/super_admin');
		}		
	
	}
	
}  // class end