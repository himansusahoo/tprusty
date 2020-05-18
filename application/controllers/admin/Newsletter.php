<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('html','form','url'));
		$this->load->helper('file');
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->library('session');
		$this->load->library('encrypt');
		$this->load->library('javascript');
		$this->load->library('upload');
		$this->load->model('admin/Newsletter_model');
		$this->load->database();
		$this->load->library('pagination');
		$this->load->library('image_lib');
		
	}

	function index(){
		    if($this->session->userdata('logged_in'))
			{
			$data['subscriber'] = $this->Newsletter_model->getnewsletter();
			
			$this->load->view('admin/newsletter',$data);
		    }else{
			redirect('admin/super_admin');
		}
		
	}
	
	function search_subscriber()
	{
		$keyword = $this->input->post('name1');
		
		$p['search_sub']=$this->Newsletter_model->search_subscriber($keyword);
	
		//echo 'hfjf';exit;
	$this->load->view('admin/search_subscriber',$p);

	}
	
	function search_user()
	{
		if($this->session->userdata('logged_in'))
			{
		$data['subscriber'] = $this->Newsletter_model->selectnewsletter($this->uri->segment(4));
		//print_r($data['subscriber']);exit;
		$this->load->view('admin/Newsletter',$data);
		    }else{
			redirect('admin/super_admin');
			}
	}
	
	// Delete Excel filesize
	function doDeleteExcelFiles(){
		if($this->session->userdata('logged_in')){
			$delete = delete_files('./excel_downloaded/');
			echo "success"; exit;
		}else{
			redirect('admin/super_admin');
		}
	}
	
	
	
}
?>