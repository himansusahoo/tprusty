<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cornjob_email extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('html','form','url'));
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->library('session');
		$this->load->library('encrypt');
		$this->load->library('javascript');
		$this->load->helper('string');
		$this->load->database();		
		$this->load->model('Corenjob_email_model');
		$this->load->helper('file');
	}
	
	function addtocart_email()
	{
		$this->Corenjob_email_model->mail_sendTo_buyer();
	}
	
	function wishlist_email()
	{
		$this->Corenjob_email_model->wishlistmail_sendTo_buyer();
	}
	
	
	
	
	
}