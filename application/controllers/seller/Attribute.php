<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attribute extends CI_Controller {
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
		$this->load->model('seller/Attribute_model');
		$this->load->library('pagination');
		
	}
	
	function show_attr_headings(){
		$data['attr_heading_result'] = $this->Attribute_model->retrieve_attr_headings();
		$this->load->view('seller/load_attr_ajx', $data);
	}
	
	
}	
?>