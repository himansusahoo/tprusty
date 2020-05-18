<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_category extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('html','form','url'));
		$this->load->library('form_validation');		
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->library('encrypt');
		$this->load->library('javascript');
		$this->load->helper('string');			
		$this->load->database();
		$this->load->model('admin/Pagecategory_model');		
	}

	public function index(){
		if($this->session->userdata('logged_in')){
			//$data['cat_data']=$this->Pagecategory_model->section_dataof_mobilecategory();
			$data['sel_catg']=$this->Pagecategory_model->select_allcategory();
			$this->load->view('admin/category_page',$data);
		}else{
				redirect('admin/super_admin');
		}
	}
	
	public function addnewcategory_formobilehomepage(){
		if($this->session->userdata('logged_in')){
			$data['sel_catg']=$this->Pagecategory_model->select_allcategory();
			$this->load->view('admin/addnewsection_mobilecategory',$data);			
			}else{
				redirect('admin/super_admin');
			}
		}
	public function select_imagesize()
	{
		if($this->session->userdata('logged_in')){
		$data['img_size']=$this->Pagecategory_model->select_imgsize();
		$this->load->view('admin/pagedesign_setup/pagedesigne_imagesizeajax',$data);
		}else{
			redirect('admin/super_admin');
		}			
	}
		
	public function add_pagecategorydata(){
		//echo '<pre>';print_r($_POST);exit;
		if($this->session->userdata('logged_in')){
			$this->Pagecategory_model->add_pagesectioninfo();
			$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');
			
			//$data['cat_data']=$this->Pagecategory_model->section_dataof_mobilecategory();
			//$this->load->view('admin/category_page',$data);			
			//redirect('admin/Page_category');
			echo "<script>window.close();</script>";
		}else{
			redirect('admin/super_admin');
		}
	}
	
	public function edit_mobilecategorysection()
	{	
		if($this->session->userdata('logged_in')){
			$data['sel_catg']=$this->Pagecategory_model->select_allcategory();
			$data['sec_info']=$this->Pagecategory_model->category_sectioneditedpage();
			$this->load->view('admin/edit_mobilecategorysection',$data);
		}else{
			redirect('admin/super_admin');
		}
	}
	
	public function update_categoryectiondata()
	{
		if($this->session->userdata('logged_in')){
			$this->Pagecategory_model->update_pagesectioninfo();
			$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');
			
			//$data['cat_data']=$this->Pagecategory_model->section_dataof_mobilecategory();
			//$this->load->view('admin/category_page',$data);	
			//redirect('admin/Page_category');	
			
			echo "<script>window.close();</script>";				
		}else{
				redirect('admin/super_admin');
		}	
	}
		
	public function categorysortby_section_up()
	{
		if($this->session->userdata('logged_in')){	
			$this->Pagecategory_model->categorysectionsorby_up();
			$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');
			
			//$data['cat_data']=$this->Pagecategory_model->section_dataof_mobilecategory();
			//$this->load->view('admin/category_page',$data);	
		
			//redirect('admin/Page_category');
			
			$data['cat_data']=$this->Pagecategory_model->select_pagedesinginfo_asmenuwise();		
			$this->load->view('admin/pagedesign_infomenuwise_category',$data);	
				
			
		}else{
				redirect('admin/super_admin');
		}		
			
	}
	
	public function categorysortby_section_down()
	{	
		if($this->session->userdata('logged_in')){
			$this->Pagecategory_model->categorysectionsorby_down();
			$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');
			
			//$data['cat_data']=$this->Pagecategory_model->section_dataof_mobilecategory();
			//$this->load->view('admin/category_page',$data);	
		
			//redirect('admin/Page_category');
			
			$data['cat_data']=$this->Pagecategory_model->select_pagedesinginfo_asmenuwise();		
			$this->load->view('admin/pagedesign_infomenuwise_category',$data);	
			
		}else{
				redirect('admin/super_admin');
		}	
	}
	
	public function categorysortby_section_totop()
	{	
		if($this->session->userdata('logged_in')){
			$this->Pagecategory_model->categorysectionsorby_totop();
			$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');
			
			//$data['cat_data']=$this->Pagecategory_model->section_dataof_mobilecategory();
			//$this->load->view('admin/category_page',$data);	
		
			//redirect('admin/Page_category');
			
			$data['cat_data']=$this->Pagecategory_model->select_pagedesinginfo_asmenuwise();		
			$this->load->view('admin/pagedesign_infomenuwise_category',$data);
			
		}else{
				redirect('admin/super_admin');
		}	
	}
	
	public function categorysortby_section_todown()
	{	
		if($this->session->userdata('logged_in')){
			$this->Pagecategory_model->categorysortby_section_todown();
			$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');
			
			//$data['cat_data']=$this->Pagecategory_model->section_dataof_mobilecategory();
			//$this->load->view('admin/category_page',$data);	
		
			//redirect('admin/Page_category');
			
			$data['cat_data']=$this->Pagecategory_model->select_pagedesinginfo_asmenuwise();		
			$this->load->view('admin/pagedesign_infomenuwise_category',$data);	
			
		}else{
				redirect('admin/super_admin');
		}	
	}
	
	public function remove_mobilecategorysection()
	{
		if($this->session->userdata('logged_in')){
			$this->Pagecategory_model->delete_mobilecategory_section();
			$this->session->set_flashdata('flshmsg', 'Section Deleted Successfully');
			
			//$data['cat_data']=$this->Pagecategory_model->section_dataof_mobilecategory();
			//$this->load->view('admin/category_page',$data);
			
			//redirect('admin/Page_category');
			
			$data['cat_data']=$this->Pagecategory_model->select_pagedesinginfo_asmenuwise();		
			$this->load->view('admin/pagedesign_infomenuwise_category',$data);	
					
			
		}else{
				redirect('admin/super_admin');
		}
	}
	
	public function change_sec_status()
	{
		if($this->session->userdata('logged_in')){
			$this->Pagecategory_model->changesection_status();
			$this->session->set_flashdata('flshmsg', 'Section Status Changed Successfully');
			
			$data['cat_data']=$this->Pagecategory_model->select_pagedesinginfo_asmenuwise();		
			$this->load->view('admin/pagedesign_infomenuwise_category',$data);	
				
			
		
		}else{
				redirect('admin/super_admin');
		}
	}
	
	public function remove_imagedata()
	{
		if($this->session->userdata('logged_in')){
			$this->Pagecategory_model->remove_imageinfo();
			echo 'success';			
		}else{
				redirect('admin/super_admin');
		}
			
	}
	
	public function remove_csvdata()
	{	if($this->session->userdata('logged_in'))
		{
			$this->Pagecategory_model->remove_csvinfo();
			echo 'success';
		}else{
				redirect('admin/super_admin');
		}		
			
	}
	
	public function remove_categorymenulink()
	{
		if($this->session->userdata('logged_in')){
		$this->load->model('admin/Pagecategory_model');
		$this->Pagecategory_model->remove_menulink();	
			
		}else{
				redirect('admin/super_admin');
			}		
			
	}
	
	public function select_screeshot()
	{	if($this->session->userdata('logged_in')){
	
		
		$data['screenshot_image']=$this->Pagecategory_model->select_screenshotimage();
		
		$this->load->view('admin/pagedesign_setup/categorydesign_screenshotajax',$data);
	
		}else{
				redirect('admin/super_admin');
			}
	}
	
	function populate_pagedesigninfo()
	{
		if($this->session->userdata('logged_in'))
		{
			$data['cat_data']=$this->Pagecategory_model->select_pagedesinginfo_asmenuwise();		
			$this->load->view('admin/pagedesign_infomenuwise_category',$data);	
					
		}else{
				redirect('admin/super_admin');
			}	
	}
}
?>