<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desktop_page_search extends CI_Controller {
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
		$this->load->model('admin/Desktop_searchpage_model');		
		
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
		
		$data['sec_data']=$this->Desktop_searchpage_model->section_dataof_desktopsearchpage();
			
		$this->load->view('admin/desktop_page_search',$data);
			
		}else{
				redirect('admin/super_admin');
			}
	}
	
	function addnewsection_fordesktopsearchpage()
	{
		if($this->session->userdata('logged_in')){

		$this->load->view('admin/addnewsection_desktopsearchpage');	
			
		}else{
				redirect('admin/super_admin');
			}	
	}
	
	function select_imagesize()
	{
		if($this->session->userdata('logged_in')){
			
		$data['img_size']=$this->Desktop_searchpage_model->select_imgsize();
		
		$this->load->view('admin/pagedesign_setup/pagedesigne_imagesizeajax',$data);
			
		}else{
				redirect('admin/super_admin');
			}			
	}
	
	function select_screeshot()
	{	if($this->session->userdata('logged_in')){
	
		
		$data['screenshot_image']=$this->Desktop_searchpage_model->select_screenshotimage();
		
		$this->load->view('admin/pagedesign_setup/desktop_searchpage_screenshotajax',$data);
	
		}else{
				redirect('admin/super_admin');
			}
			
	}
	
	
	function add_pagesectiondata()
	{
		if($this->session->userdata('logged_in')){		
			
		$this->Desktop_searchpage_model->add_pagesectioninfo();
		$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');
		
		//$data['sec_data']=$this->Desktop_searchpage_model->section_dataof_desktopsearchpage();			
		//$this->load->view('admin/desktop_page_search',$data);
		echo "<script>window.close();</script>";

		}else{
				redirect('admin/super_admin');
		}		
				
	}
	
	function searchpagesortby_section_up()
	{
		if($this->session->userdata('logged_in'))
		{	
			$this->Desktop_searchpage_model->searchpagesectionsorby_up();
			$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');	
		
			$data['sec_data']=$this->Desktop_searchpage_model->section_dataof_desktopsearchpage();			
			$this->load->view('admin/desktop_page_search',$data);
			
			
		}else{
				redirect('admin/super_admin');
		}		
			
	}
	
	function searchpagesortby_section_down()
	{	if($this->session->userdata('logged_in'))
		{
			$this->Desktop_searchpage_model->searchpagesectionsorby_down();
			$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');	
			
			$data['sec_data']=$this->Desktop_searchpage_model->section_dataof_desktopsearchpage();			
			$this->load->view('admin/desktop_page_search',$data);
			
		}else{
				redirect('admin/super_admin');
		}

	}
	
	function searchpagesortby_section_movetop()
	{
		if($this->session->userdata('logged_in'))
		{	
			$this->Desktop_searchpage_model->searchpagesortby_section_movetop();
			$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');	
		
			$data['sec_data']=$this->Desktop_searchpage_model->section_dataof_desktopsearchpage();			
			$this->load->view('admin/desktop_page_search',$data);	
			//redirect('admin/Page_setup');
			
		}else{
				redirect('admin/super_admin');
		}		
			
	}
	
	function searchpagesortby_section_movedown()
	{
		if($this->session->userdata('logged_in'))
		{	
			$this->Desktop_searchpage_model->searchpagesortby_section_movedown();
			$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');	
		
			$data['sec_data']=$this->Desktop_searchpage_model->section_dataof_desktopsearchpage();			
			$this->load->view('admin/desktop_page_search',$data);	
			//redirect('admin/Page_setup');
			
		}else{
				redirect('admin/super_admin');
		}		
			
	}
	
	
	function edit_desktopsearchpagesection()
	{	if($this->session->userdata('logged_in'))
		{
			$data['sec_info']=$this->Desktop_searchpage_model->searchpage_sectioneditedpage();
			
			$this->load->view('admin/edit_desktopsearchpagesection',$data);
			
			
		}else{
				redirect('admin/super_admin');
		}		
			
	}
	
	function remove_desktopsearchpagesection()
	{
		if($this->session->userdata('logged_in'))
		{
			$this->Desktop_searchpage_model->delete_desktopsearchpage_section();
			$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');

			$data['sec_data']=$this->Desktop_searchpage_model->section_dataof_desktopsearchpage();			
			$this->load->view('admin/desktop_page_search',$data);	
				
			
		}else{
				redirect('admin/super_admin');
		}		
				
			
	}
	
	function change_sec_status()
	{
		if($this->session->userdata('logged_in'))
		{
			$this->Desktop_searchpage_model->changesection_status();
			$this->session->set_flashdata('flshmsg', 'Section Status Changed Successfully');
		
		}else{
				redirect('admin/super_admin');
		}
			
			
	}
	
	function update_pagesectiondata()
	{
		if($this->session->userdata('logged_in'))
		{
			$this->Desktop_searchpage_model->update_pagesectioninfo();
			$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');
			
			//$data['sec_data']=$this->Desktop_searchpage_model->section_dataof_desktopsearchpage();			
			//$this->load->view('admin/desktop_page_search',$data);
			echo "<script>window.close();</script>";
					
		}else{
				redirect('admin/super_admin');
		}
	
	}
	
	function remove_imagedata()
	{
		if($this->session->userdata('logged_in'))
		{
			$this->Desktop_searchpage_model->remove_imageinfo();
			echo 'success';
		}else{
				redirect('admin/super_admin');
		}
			
	}
	
	function remove_csvdata()
	{	if($this->session->userdata('logged_in'))
		{
			$this->Desktop_searchpage_model->remove_csvinfo();
			echo 'success';
		}else{
				redirect('admin/super_admin');
		}		
			
	}
}
?>