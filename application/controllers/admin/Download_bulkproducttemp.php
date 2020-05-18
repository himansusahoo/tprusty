<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download_bulkproducttemp Extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('html','form','url'));
		$this->load->library('form_validation');
		//$this->load->library('email');
		$this->load->library('session');
		//$this->load->library('upload');
		//$this->load->library('encrypt');
		$this->load->library('javascript');
		$this->load->helper('string');			
		$this->load->database();		
		$this->load->model('admin/Downlaod_bulkprodtemplatemodel');		
	}
	 function index()
	 {
			 
	 }
	 
	 function bulk_productuploadtemplate()
	{
			//$this->load->helper('string');
			$catg_id=$this->uri->segment(4);
			$attr_group_id=$this->uri->segment(5);
			$seller_id=$this->uri->segment(6);			
			
			 date_default_timezone_set('Asia/Calcutta');
			 
			 $dt_rec = preg_replace("/[^0-9]+/","", date('d-m-Y H:i:s'));
			 $rand_string=random_string('alnum',10);		
			
			$data['catgnm'] = $this->Downlaod_bulkprodtemplatemodel->select_catgnm($catg_id);			
			$data['rand_string']=$rand_string;
			$data['dt_rec']=$dt_rec;
			$catgnm=$data['catgnm'];
			//attribute headin retrive start			
			$this->load->model('admin/Attribute_model');
			$data['attr_heading_result'] = $this->Attribute_model->retrieve_attr_headings($attr_group_id);
			
			$cur_dt=date('y-m-d H:i:s');
			$exl_filename=str_replace("'", "",stripslashes(preg_replace('#"#',"_",preg_replace('#/#',"_",str_replace(',','_',str_replace('&','',str_replace(' ','_',strtolower($catgnm))))))))."_".$rand_string."_".$dt_rec.".xls";
			$this->Downlaod_bulkprodtemplatemodel->insert_excelsheetlog($cur_dt,$exl_filename,$seller_id,$attr_group_id,$catg_id);		 
			
			
			$data['color_result'] = $this->Attribute_model->retrieve_colors();
			$data['size_result'] = $this->Attribute_model->retrieve_size();
			$data['sub_size_result'] = $this->Attribute_model->retrieve_sub_size();
			$this->load->view('admin/upload_bulkproductfor_single_sellerexcelsheet',$data);
			
			//$this->load->view('admin/upload_bulkproducttempl',$data);
//			$this->load->view('admin/upload_bulkproducttempl',$data);
			
			//$this->load->model('admin/Product');bulprotem_test
//			$data['result'] = $this->Product->export_product_details();
//			$this->load->view('admin/export_allproduct',$data);
		
	
	}
	
	function uploadlog_list()
	{
		if($this->session->userdata('logged_in')){
		
		$seller_id=$this->uri->segment(4);
		
		$data['uploadlist']=$this->Downlaod_bulkprodtemplatemodel->select_uploadlistsellerwise($seller_id);
		$data['seller_id']=$seller_id;
		$this->load->view('admin/bulkproductexcel_listsellerwise',$data);
			
		}else{
			redirect('admin/super_admin');
		}		
	}
	
	
	function generate_failedproductexcelsheet()
	{
		
		if($this->session->userdata('logged_in')){
			
		$upload_templateid=$this->uri->segment(4);
		$catg_id=$this->uri->segment(5);
		$attr_group_id=$this->uri->segment(6);
		$seller_id=$this->uri->segment(7);	
		
		
		$data['failed_product']=$this->Downlaod_bulkprodtemplatemodel->select_failedprodtemplatedidwise($upload_templateid);
		
		
		 date_default_timezone_set('Asia/Calcutta');
			 
			 $dt_rec = preg_replace("/[^0-9]+/","", date('d-m-Y H:i:s'));
			 $rand_string=random_string('alnum',10);		
			
			$data['catgnm'] = $this->Downlaod_bulkprodtemplatemodel->select_catgnm($catg_id);			
			$data['rand_string']=$rand_string;
			$data['dt_rec']=$dt_rec;
			$catgnm=$data['catgnm'];
			//attribute headin retrive start			
			$this->load->model('admin/Attribute_model');
			$data['attr_heading_result'] = $this->Attribute_model->retrieve_attr_headings($attr_group_id);
			
			$cur_dt=date('y-m-d H:i:s');
			$exl_filename=str_replace("'", "",stripslashes(preg_replace('#"#',"_",preg_replace('#/#',"_",str_replace(',','_',str_replace('&','',str_replace(' ','_',strtolower($catgnm))))))))."_".$rand_string."_".$dt_rec."_failed.xls";
			$this->Downlaod_bulkprodtemplatemodel->insertfailed_excelsheetlog($cur_dt,$exl_filename,$seller_id,$attr_group_id,$catg_id,$upload_templateid);		 
			
			
			$data['color_result'] = $this->Attribute_model->retrieve_colors();
			$data['size_result'] = $this->Attribute_model->retrieve_size();
			$data['sub_size_result'] = $this->Attribute_model->retrieve_sub_size();
			
		
		$this->load->view('admin/failedproduct_singlesellerexcelsheet',$data);
		
		}else{
			redirect('admin/super_admin');
		} 
			
	}
	
	 
}

?>