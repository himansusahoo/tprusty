<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_catlog extends CI_Controller {
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
		$this->load->model('admin/Pagecatlog_model');		
	}

	public function index(){
		if($this->session->userdata('logged_in')){
			
			//$data['cat_data']=$this->Pagecatlog_model->section_dataof_mobilecatlog();
			$data['sel_catg']=$this->Pagecatlog_model->select_allcategory();
			$this->load->view('admin/catlog_page',$data);
		}else{
				redirect('admin/super_admin');
		}
	}
	
	public function addnewsection_mobilecatlog(){
		if($this->session->userdata('logged_in')){
			$data['sel_catg']=$this->Pagecatlog_model->select_allcategory();
			$this->load->view('admin/addnewsection_mobilecatlog',$data);			
			}else{
				redirect('admin/super_admin');
			}
		}
		
	public function add_pagecatlogdata(){
		if($this->session->userdata('logged_in')){
			$this->Pagecatlog_model->add_pagesectioninfo();
			$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');
			
			//$data['cat_data']=$this->Pagecatlog_model->section_dataof_mobilecatlog();
			//$this->load->view('admin/catlog_page',$data);
			//redirect('admin/Page_catlog');
			echo "<script>window.close();</script>";
		}else{
			redirect('admin/super_admin');
		}
	}
	
	public function edit_mobilecatlogsection()
	{	
		if($this->session->userdata('logged_in')){
			$data['sec_info']=$this->Pagecatlog_model->catlog_sectioneditedpage();
			$data['sel_catg']=$this->Pagecatlog_model->select_allcategory();
			$this->load->view('admin/edit_mobilecatlogsection',$data);
		}else{
			redirect('admin/super_admin');
		}
	}
	
	public function update_catlogectiondata()
	{
		if($this->session->userdata('logged_in')){
			$this->Pagecatlog_model->update_pagesectioninfo();
			$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');
			
			//$data['cat_data']=$this->Pagecatlog_model->section_dataof_mobilecatlog();
			//$this->load->view('admin/catlog_page',$data);
			
			echo "<script>window.close();</script>";	
			//redirect('admin/Page_catlog');					
		}else{
				redirect('admin/super_admin');
		}	
	}
	
	public function select_imagesize()
	{
		if($this->session->userdata('logged_in')){
		$data['img_size']=$this->Pagecatlog_model->select_imgsize();
		$this->load->view('admin/pagedesign_setup/pagedesigne_imagesizeajax',$data);
		}else{
			redirect('admin/super_admin');
		}
	}
	
	public function catlogsortby_section_up()
	{
		if($this->session->userdata('logged_in')){	
			$this->Pagecatlog_model->catlogsectionsorby_up();
			$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');
				
			//$data['cat_data']=$this->Pagecatlog_model->section_dataof_mobilecatlog();
			//$this->load->view('admin/catlog_page',$data);
			
			$data['cat_data']=$this->Pagecatlog_model->select_pagedesinginfo_as_menuwise();		
			$this->load->view('admin/pagedesign_infomenuwise',$data);
			
			//redirect('admin/Page_catlog');
			
		}else{
				redirect('admin/super_admin');
		}		
			
	}
	
	public function catlogsortby_section_down()
	{	
		if($this->session->userdata('logged_in')){
			$this->Pagecatlog_model->catlogsectionsorby_down();
			$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');
			
			//$data['cat_data']=$this->Pagecatlog_model->section_dataof_mobilecatlog();
			//$this->load->view('admin/catlog_page',$data);
			
			$data['cat_data']=$this->Pagecatlog_model->select_pagedesinginfo_as_menuwise();		
			$this->load->view('admin/pagedesign_infomenuwise',$data);
				
		
			//redirect('admin/Page_catlog');
		}else{
				redirect('admin/super_admin');
		}	
	}
	
	public function categorysortby_section_totop()
	{	
		if($this->session->userdata('logged_in')){
			$this->Pagecatlog_model->catlogsectionsorby_movetop();
			$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');
			
			//$data['cat_data']=$this->Pagecatlog_model->section_dataof_mobilecatlog();
			//$this->load->view('admin/catlog_page',$data);
			
			$data['cat_data']=$this->Pagecatlog_model->select_pagedesinginfo_as_menuwise();		
			$this->load->view('admin/pagedesign_infomenuwise',$data);
				
		
			//redirect('admin/Page_catlog');
		}else{
				redirect('admin/super_admin');
		}	
	}
	
	public function categorysortby_section_todown()
	{	
		if($this->session->userdata('logged_in')){
			$this->Pagecatlog_model->catlogsectionsorby_movedown();
			$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');
			
			//$data['cat_data']=$this->Pagecatlog_model->section_dataof_mobilecatlog();
			//$this->load->view('admin/catlog_page',$data);
			
			$data['cat_data']=$this->Pagecatlog_model->select_pagedesinginfo_as_menuwise();		
			$this->load->view('admin/pagedesign_infomenuwise',$data);
				
		
			//redirect('admin/Page_catlog');
		}else{
				redirect('admin/super_admin');
		}	
	}
	
	public function change_sec_status()
	{
		if($this->session->userdata('logged_in')){
			$this->Pagecatlog_model->changesection_status();
			$this->session->set_flashdata('flshmsg', 'Section Status Changed Successfully');
			
			$data['cat_data']=$this->Pagecatlog_model->select_pagedesinginfo_as_menuwise();		
			$this->load->view('admin/pagedesign_infomenuwise',$data);
		
		}else{
				redirect('admin/super_admin');
		}
	}
	
	public function remove_mobilecatlogsection()
	{
		if($this->session->userdata('logged_in')){
			$this->Pagecatlog_model->delete_mobilecatlog_section();
			$this->session->set_flashdata('flshmsg', 'Section Deleted Successfully');
			
			//$data['cat_data']=$this->Pagecatlog_model->section_dataof_mobilecatlog();
			//$this->load->view('admin/catlog_page',$data);
			//redirect('admin/Page_catlog');
			
			$data['cat_data']=$this->Pagecatlog_model->select_pagedesinginfo_as_menuwise();		
			$this->load->view('admin/pagedesign_infomenuwise',$data);
			
			
		}else{
				redirect('admin/super_admin');
		}
	}
	
	public function remove_imagedata()
	{
		if($this->session->userdata('logged_in')){
			$this->Pagecatlog_model->remove_imageinfo();
			echo 'success';			
		}else{
				redirect('admin/super_admin');
		}
			
	}
	public function remove_csvdata()
	{	if($this->session->userdata('logged_in'))
		{
			$this->Pagecatlog_model->remove_csvinfo();
			echo 'success';
		}else{
				redirect('admin/super_admin');
		}		
			
	}
	public function select_screeshot()
	{	if($this->session->userdata('logged_in')){
		
		$data['screenshot_image']=$this->Pagecatlog_model->select_screenshotimage();		
		$this->load->view('admin/pagedesign_setup/catlogdesign_screenshotajax',$data);	
		}else{
				redirect('admin/super_admin');
			}
	}
	public function remove_catalogmenulink()
	{
		if($this->session->userdata('logged_in')){
		$this->load->model('admin/Pagecatlog_model');
		$this->Pagecatlog_model->remove_menulink();	
			
		}else{
				redirect('admin/super_admin');
			}		
			
	}
	public function remove_categorymenulink()
	{
		if($this->session->userdata('logged_in')){
		$this->load->model('admin/Pagecatlog_model');
		$this->Pagecatlog_model->remove_menulink();	
			
		}else{
				redirect('admin/super_admin');
			}
	}
	
	
	function populate_pagedesigninfo()
	{
		if($this->session->userdata('logged_in')){
		
		$data['cat_data']=$this->Pagecatlog_model->select_pagedesinginfo_as_menuwise();		
		$this->load->view('admin/pagedesign_infomenuwise',$data);	
		}else{
				redirect('admin/super_admin');
			}

			
	}
	
}
?>