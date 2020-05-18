<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cms_model extends CI_Model{

	function getAboutusDetails(){
		$qr = $this->db->query("SELECT * FROM pages WHERE page_name='about_us'");
		$rows = $qr->row();
		return $rows;
	}
	function getContactusDetails(){
		$qr = $this->db->query("SELECT * FROM pages WHERE page_name='contact_us'");
		$rows = $qr->row();
		return $rows;
	}
	function getFaqDetails(){
		$qr = $this->db->query("SELECT * FROM pages WHERE page_name='faq'");
		$rows = $qr->row();
		return $rows;
	}
	function getPrivacyPolicyDetails(){
		$qr = $this->db->query("SELECT * FROM pages WHERE page_name='privacy_policy'");
		$rows = $qr->row();
		return $rows;
	}
	function getCareerDetails(){
		$qr = $this->db->query("SELECT * FROM pages WHERE page_name='career'");
		$rows = $qr->row();
		return $rows;
	}
	function getTermandconditionsDetails(){
		$qr = $this->db->query("SELECT * FROM pages WHERE page_name='terns_and_conditions'");
		$rows = $qr->row();
		return $rows;
	}
	function getReturnpolicyDetails(){
		$qr = $this->db->query("SELECT * FROM pages WHERE page_name='return_policy'");
		$rows = $qr->row();
		return $rows;
	}
	function getReportListingDetails(){
		$qr = $this->db->query("SELECT * FROM pages WHERE page_name='report_listing'");
		$rows = $qr->row();
		return $rows;
	}
	function getCustomerserviceDetails(){
		$qr = $this->db->query("SELECT * FROM pages WHERE page_name='customer_services'");
		$rows = $qr->row();
		return $rows;
	}
	function insertCareerDetails($fname,$email,$mob,$street_addrs,$name_array1){
		$qr = $this->db->query("insert into career (user_name,user_email,user_phone,user_address,user_doc) values ('$fname','$email','$mob','$street_addrs','$name_array1')");
		return $qr;
	}



}