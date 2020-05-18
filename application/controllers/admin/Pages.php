<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
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
		$this->load->model('admin/Pages_model');
		
		
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
			$data['result'] = $this->Pages_model->getPages();
			$this->load->view('admin/pages', $data);
		}else{
			redirect('admin/super_admin');
		}
	}
	function edit_page_content(){
		if($this->session->userdata('logged_in')){
			$page_id = $this->uri->segment(4); 
			$data['result'] = $this->Pages_model->getPageDetails($page_id);
			$this->load->view('admin/edit_page_contents', $data);
		}else{
			redirect('admin/super_admin');
		}
	}
	function update_page_content(){
		if($this->session->userdata('logged_in')){
			$page_id = $this->input->post('page_id'); 
			$result = $this->Pages_model->updatePageContent($page_id);
			if($result == true){
				redirect('admin/pages');
			}
		}else{
			redirect('admin/super_admin');
		}
	}
	
}


?>