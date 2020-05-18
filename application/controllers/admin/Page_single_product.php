<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_single_product extends CI_Controller {
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
		$this->load->model('admin/Page_single_product_model');		
	}

	public function index(){
		if($this->session->userdata('logged_in')){
			
			$data['cat_data']=$this->Page_single_product_model->section_dataof_mobile_singleproduct();
			
			$data['select_catagories']=$this->Page_single_product_model->select_allcategory();
			$this->load->view('admin/single_product_page',$data);
		}else{
				redirect('admin/super_admin');
		}
	}
	
	public function addnewsection_mobile_signle_product(){
		if($this->session->userdata('logged_in')){
			$data['select_catagories']=$this->Page_single_product_model->select_allcategory();
			$this->load->view('admin/addnewsection_mobile_signle_product',$data);
			}else{
				redirect('admin/super_admin');
			}
		}
		
	public function addpage_single_productdata(){
		if($this->session->userdata('logged_in')){
			$this->Page_single_product_model->add_pagesectioninfo();
			$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');
			
			//$data['cat_data']=$this->Page_single_product_model->section_dataof_mobile_singleproduct();
			//$this->load->view('admin/single_product_page',$data);
			echo "<script>window.close();</script>";
			
		}else{
			redirect('admin/super_admin');
		}
	}
	
	public function edit_mobile_singleproduct_section()
	{	
		if($this->session->userdata('logged_in')){
			$data['sec_info']=$this->Page_single_product_model->single_product_sectioneditedpage();
			$data['select_catagories']=$this->Page_single_product_model->select_allcategory();
			$this->load->view('admin/edit_mobile_singleproduct_section',$data);
		}else{
			redirect('admin/super_admin');
		}
	}
	
	public function update_single_product_sectiondata()
	{
		if($this->session->userdata('logged_in')){
			$this->Page_single_product_model->update_pagesectioninfo();
			$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');
			
			//$data['cat_data']=$this->Page_single_product_model->section_dataof_mobile_singleproduct();
			//$this->load->view('admin/single_product_page',$data);
			echo "<script>window.close();</script>";
			
				
							
		}else{
				redirect('admin/super_admin');
		}	
	}
	
	public function select_imagesize()
	{
		if($this->session->userdata('logged_in')){
		$data['img_size']=$this->Page_single_product_model->select_imgsize();
		$this->load->view('admin/pagedesign_setup/pagedesigne_imagesizeajax',$data);
		}else{
			redirect('admin/super_admin');
		}
	}
	
	public function single_productsortby_section_up()
	{
		if($this->session->userdata('logged_in')){	
			$this->Page_single_product_model->single_productsectionsorby_up();
			$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');
				
			//$data['cat_data']=$this->Page_single_product_model->section_dataof_mobile_singleproduct();
			//$this->load->view('admin/single_product_page',$data);
			
			//redirect('admin/Page_catlog');
			
			$data['cat_data']=$this->Page_single_product_model->section_dataof_mobile_singleproductajx();		
			$this->load->view('admin/singleprodpagedesign_infomenuwise',$data);
			
		}else{
				redirect('admin/super_admin');
		}		
			
	}
	
	public function single_productsortby_section_down()
	{	
		if($this->session->userdata('logged_in')){
			$this->Page_single_product_model->single_productsectionsorby_down();
			$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');
			
			//$data['cat_data']=$this->Page_single_product_model->section_dataof_mobile_singleproduct();
			//$this->load->view('admin/single_product_page',$data);
			
			$data['cat_data']=$this->Page_single_product_model->section_dataof_mobile_singleproductajx();		
			$this->load->view('admin/singleprodpagedesign_infomenuwise',$data);	
		
			//redirect('admin/Page_catlog');
		}else{
				redirect('admin/super_admin');
		}	
	}
	
	public function single_productsortby_section_totop()
	{	
		if($this->session->userdata('logged_in')){
			$this->Page_single_product_model->single_productsortby_section_totop();
			$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');
			
			//$data['cat_data']=$this->Page_single_product_model->section_dataof_mobile_singleproduct();
			//$this->load->view('admin/single_product_page',$data);
			
			$data['cat_data']=$this->Page_single_product_model->section_dataof_mobile_singleproductajx();		
			$this->load->view('admin/singleprodpagedesign_infomenuwise',$data);	
		
			//redirect('admin/Page_catlog');
		}else{
				redirect('admin/super_admin');
		}	
	}
	
	public function single_productsortby_section_todown()
	{	
		if($this->session->userdata('logged_in')){
			$this->Page_single_product_model->single_productsortby_section_todown();
			$this->session->set_flashdata('flshmsg', 'Data Saved Successfully');
			
			//$data['cat_data']=$this->Page_single_product_model->section_dataof_mobile_singleproduct();
			//$this->load->view('admin/single_product_page',$data);
			
			$data['cat_data']=$this->Page_single_product_model->section_dataof_mobile_singleproductajx();		
			$this->load->view('admin/singleprodpagedesign_infomenuwise',$data);	
		
			//redirect('admin/Page_catlog');
		}else{
				redirect('admin/super_admin');
		}	
	}
	
	public function change_sec_status()
	{
		if($this->session->userdata('logged_in')){
			$this->Page_single_product_model->changesection_status();
			$this->session->set_flashdata('flshmsg', 'Section Status Changed Successfully');
			
			$data['cat_data']=$this->Page_single_product_model->section_dataof_mobile_singleproductajx();		
			$this->load->view('admin/singleprodpagedesign_infomenuwise',$data);
		
		}else{
				redirect('admin/super_admin');
		}
	}
	
	public function remove_mobile_singleproduct_section()
	{
		if($this->session->userdata('logged_in')){
			$this->Page_single_product_model->delete_mobile_singelproduct_section();
			$this->session->set_flashdata('flshmsg', 'Section Deleted Successfully');
			
			//$data['cat_data']=$this->Page_single_product_model->section_dataof_mobile_singleproduct();
			//$this->load->view('admin/single_product_page',$data);
			//redirect('admin/Page_catlog');
			
			$data['cat_data']=$this->Page_single_product_model->section_dataof_mobile_singleproductajx();		
			$this->load->view('admin/singleprodpagedesign_infomenuwise',$data);	
			
		}else{
				redirect('admin/super_admin');
		}
	}
	
	public function remove_imagedata()
	{
		if($this->session->userdata('logged_in')){
			$this->Page_single_product_model->remove_imageinfo();
			echo 'success';			
		}else{
				redirect('admin/super_admin');
		}
			
	}
	public function remove_csvdata()
	{	if($this->session->userdata('logged_in'))
		{
			$this->Page_single_product_model->remove_csvinfo();
			echo 'success';
		}else{
				redirect('admin/super_admin');
		}		
			
	}
	public function select_screeshot()
	{	if($this->session->userdata('logged_in')){
		
		$data['screenshot_image']=$this->Page_single_product_model->select_screenshotimage();		
		$this->load->view('admin/pagedesign_setup/single_product_design_screenshotajax',$data);	
		}else{
				redirect('admin/super_admin');
			}
	}
	public function remove_categorymenulink()
	{
		if($this->session->userdata('logged_in')){
		$this->load->model('admin/Page_single_product_model');
		$this->Page_single_product_model->remove_menulink();	
			
		}else{
				redirect('admin/super_admin');
			}		
			
	}
	
	function populate_singleprodpagedesigninfo()
	{
		if($this->session->userdata('logged_in')){
			
			$data['cat_data']=$this->Page_single_product_model->section_dataof_mobile_singleproductajx();		
			$this->load->view('admin/singleprodpagedesign_infomenuwise',$data);
		}else{
				redirect('admin/super_admin');
			}		
				
	}
}
?>