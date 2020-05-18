<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bulk_newprod_reupload Extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('html','form','url'));
		$this->load->library('form_validation');		
		$this->load->library('session');				
		$this->load->library('javascript');
		$this->load->helper('string');			
		$this->load->database();		
		$this->load->model('admin/Bulkporduct_reuploadmodel');		
	}
	
	public function bulknewproduct_reupload()
	{
		
		if($this->session->userdata('logged_in')){
		
				$excelfiluploadid=$this->input->post('fileuploadid');
				
				//$excelfiluploadid=$this->uri->segment(4);
				
				//$conf_status=$this->input->post('confsts');
				
				
					$this->Bulkporduct_reuploadmodel->reupload_bulkuploadafterconf($excelfiluploadid);
					
					//$data['excelupload_statu']=$excelfiluploadid;
					//$this->load->view('admin/successuploadexcel_ajax',$data); 
				
			
		}else{
			redirect('admin/super_admin');
		}	
			
	}
	
	function manual_reuploadpendingcheck()
	{
		$skuids_arr=array('0'=>'NXLV-459-WCNW-09-761-T3','1'=>'ELBS-459-WCNW-09-762-T3');
		
		$skuidarr_strng=array();
		
		foreach($skuids_arr as $key=>$val)
		{
			$skuidarr_strng[]="'".$val."'";	
		}
		
		$chkskuids_string=implode(',',$skuidarr_strng);
		
		$excelfiluploadid='617';
		
		$this->Bulkporduct_reuploadmodel->manualcheck_reuploadfail($excelfiluploadid,$chkskuids_string);	
	}
	
	function reuploadlog_list()
	{
		if($this->session->userdata('logged_in')){
		
		//$seller_id=$this->uri->segment(4);
		
		$data['uploadlist']=$this->Bulkporduct_reuploadmodel->select_reuploadloglist();
		//$data['seller_id']=$seller_id;
		$this->load->view('admin/bulknewproductreuploadexcel_list',$data);
			
		}else{
			redirect('admin/super_admin');
		}		
	}
	
	function reupload_pendingproducts()
	{
		$this->Bulkporduct_reuploadmodel->reupload_pendingproductsstart();		
	}
	
	
}
?>