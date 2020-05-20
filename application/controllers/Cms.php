<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller{
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
		$this->load->library('user_agent');	
		$this->load->database();
		$this->load->model('Cms_model');		
	}
	
	function about_us(){
		$data['result'] = $this->Cms_model->getAboutusDetails();
		if ($this->agent->is_mobile())
		{$this->load->view('m/about_us', $data);}
		else
		{$this->load->view('about_us', $data);}
	}
	function contact_us(){
		$data['result'] = $this->Cms_model->getContactusDetails();
		if ($this->agent->is_mobile())
		{$this->load->view('m/contact_us', $data);}
		else
		{$this->load->view('contact_us', $data);}
	}
	function faq(){
		$data['result'] = $this->Cms_model->getFaqDetails();
		if($this->agent->is_mobile())
		{$this->load->view('m/faq', $data);}
		else
		{$this->load->view('faq', $data);}
	}
	function privacy_policy(){
		$data['result'] = $this->Cms_model->getPrivacyPolicyDetails();
		
		if($this->agent->is_mobile())
		{$this->load->view('m/privacy_policy', $data);}
		else
		{$this->load->view('privacy_policy', $data);}
	}
	function career(){
		
		$data['result'] = $this->Cms_model->getCareerDetails();
		if($this->agent->is_mobile())
		{$this->load->view('m/career', $data);}
		else
		{$this->load->view('career', $data);}
	}
	
	function send_email()
	{
		     
		       
				$fname = $this->input->post('fname');
				$email = $this->input->post('email_id');
				$mob = $this->input->post('mob');
				//$street_addrs = $this->input->post('street_addrs');
				$street_addrs='';
				
				//$cvfile = $this->input->post('userfile');
		
               
                 //echo $cvfile;exit; 

                $config['upload_path'] = './images/docs/';
				$config['allowed_types'] = 'docx|rtf|doc|pdf';
				$this->load->library('upload');
				$this->upload->initialize($config);
				$this->upload->do_upload();
				//echo 'successful';
				//exit;
				if ($this->upload->do_upload())
				{
				$data=$this->upload->data();
				$path=$data['full_path'];
				$name_array1=$data['file_name'];
               
				//print_r($name_array1);exit;
				$result=$this->Cms_model->insertCareerDetails($fname,$email,$mob,$street_addrs,$name_array1);
				
				if($result==TRUE)
				
				$to = SUPPORT_MAIL;
			    
				$from =  $email;
				$subject = "Career Details";
				
				$data['fname']= $fname;
				$data['email']= $email;
				$data['mob']= $mob;
				
				$this->email->set_newline("\r\n");
				$this->email->set_mailtype("html");
				$this->email->from($from);
				$this->email->to($to);
				$this->email->subject($subject);
				$this->email->message($this->load->view('email_template/career_mail',$data,true));
				/*$this->email->message("
					<html>
					<head>
						<title>Email From </title>
					</head>
					<body>
						<div style='width:50%; margin:0px auto; padding:40px;  background-color:#f4f4f4; border:10px solid #ef3038;'>
							<p>From:".$fname.", </p>
                            <p>Email: ".$email."</p>
							<p>Mobile: ".$mob."</p>
							<p>House Address: ".$street_addrs."</p>
                            Thanks & regards,<p> ".$fname.", </p>
						</div>
					</body>
				</html>
				");*/
				
			   $this->email->attach($path);	
				
				if($this->email->send())
				{
				$this->session->set_flashdata('error_message', 'Details have been saved successfully.');
				redirect('cms/career');
				}}else{
					
				$this->session->set_flashdata('error_message', 'Details are not saved.');
				redirect('cms/career');
				}
	}
	
	function terns_and_conditions(){
		$data['result'] = $this->Cms_model->getTermandconditionsDetails();
		if($this->agent->is_mobile())
		{$this->load->view('m/terns_and_conditions', $data);}
		else
		{$this->load->view('terns_and_conditions', $data);}
	}
	function return_policy(){
		$data['result'] = $this->Cms_model->getReturnpolicyDetails();
		$this->load->view('return_policy', $data);
	}
	function report_listing(){
		$data['result'] = $this->Cms_model->getReportListingDetails();
		if($this->agent->is_mobile())
		{$this->load->view('m/report_listing', $data);}
		else
		{$this->load->view('report_listing', $data);}
	}
	function customer_services(){
		$data['result'] = $this->Cms_model->getCustomerserviceDetails();
		$this->load->view('customer_services', $data);
	}
	
}