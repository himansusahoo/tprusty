<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_description_search extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('html','form','url'));
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->library('encrypt');
		$this->load->library('javascript');
		$this->load->library('pagination');
		$this->load->helper('string');
		$this->load->helper('cookie');
		$this->load->library('user_agent');
		$this->load->database();
		$this->load->model('Product_descrp_search_model');
		$this->load->model('Mycart_model');
		//$this->load->library('breadcrumbs');
		//$this->load->model('Admin_model');
	}

	
	
	function product_search()
	{ 
	  $p['data']=$this->Product_descrp_search_model->view_product_descrp();
	  $search_title=urldecode($this->input->get('search'));	  
	  
	   if($this->session->userdata('sugstword'))
	   {
		  $this->session->unset_userdata('sugstword'); 
		  $this->session->set_userdata('sugstword','');
		}
			  
			  if ($this->agent->is_mobile())		
			  {
					$this->load->view('m/search_product_pg',$p);
			  }
			  else
			  {		 
				   $this->load->view('d_new/newsearch_product_pgwith_ajax_view',$p);
			  }
	
	}
	
}

?>