<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solar_search_log extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('html','form','url'));
		$this->load->library('form_validation');	
		$this->load->library('session');	
		$this->load->database();
		$this->load->library('pagination');		
		$this->load->model('admin/Solar_manage_model');
		
	}
	
	
	function solr_searchlog()
	{
		if($this->session->userdata('logged_in'))
		{
		$config = array();
		$config["base_url"] = base_url()."admin/Solar_search_log/solr_searchlog";
		$config["total_rows"] = $this->Solar_manage_model->solr_search_log_count();
		$config["per_page"] = 5;
		$config["uri_segment"] = 3;
		//$config['use_page_numbers'] = TRUE;
		$config['page_query_string'] = TRUE;
		$choice = $config["total_rows"] / $config["per_page"];
		//print_r(round($choice));exit;
		//$config["num_links"] = round($choice);
		$config["num_links"] = 3;
		$config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$this->pagination->initialize($config);
		$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
		$data['solr_search_log_list']=$this->Solar_manage_model->select_solr_search_log($config["per_page"], $page);
		$data['links'] = $this->pagination->create_links();
		$this->load->view('admin/solr_search_logview',$data);
		//echo "hi";exit;
		}
		else
		{redirect('admin/super_admin');}
	}
	
	function dltsolr_logsingle()
	{
		$this->Solar_manage_model->dltsolr_logsingle();
		//echo $logsql_id;exit;
	}
	function dltselected_solr_log()
	{
		$this->Solar_manage_model->dltselected_solr_log();
	}
}