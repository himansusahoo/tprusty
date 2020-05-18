<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bulkproduct_update Extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('html','form','url'));
		$this->load->library('form_validation');
		$this->load->library('session');			
		$this->load->library('upload');		
		$this->load->library('javascript');
		$this->load->helper('string');			
		$this->load->database();		
		//$this->load->model('admin/Bulkporductupload_model');
		$this->load->model('admin/Bulkporductupdate_model');		
	}
	
	function upload_editedprodexcel()
	{
		if($this->session->userdata('logged_in')){
		
		$this->Bulkporductupdate_model->productupdate_process_statusstart();
		
		$config['upload_path'] = './bulkproductedit_excel/';
		//$config['allowed_types'] = 'doc|pdf|docx|zip|rar';
		$config['allowed_types'] = 'xls';
		$config['max_size'] = '100000';
		$this->load->library('upload');
		$this->upload->initialize($config);
		//$this->load->library('upload', $config);
		
		if(!$this->upload->do_upload()){
				 $this->upload->display_errors(); 
				
			}else{
				 $data=$this->upload->data();
				 $excl_filename = $data['file_name'];
				 
				 //$rowsdata=$this->Bulkporductupload_model->validbeforeinsert_bulkupload($excl_filename);
				 
				 $data['insertvalid_staus']=$this->Bulkporductupdate_model->validwithinsert_editedbulkupload($excl_filename);
				 $excelfiluploadid= $data['insertvalid_staus'];
				// $this->Bulkporductupload_model->insert_bulkuploadafterconf($excelfiluploadid); echo "success";exit;
				 
				 $file_sts=$data['insertvalid_staus'];
				 
				 if($file_sts=="File has expired")
				 {
					$output_dir = "./bulkproductedit_excel/";						
					$filePath = $output_dir.$excl_filename;
					unlink($filePath);		 
				 }
				$this->Bulkporductupdate_model->productupdate_process_statusfinish();
 
				 $this->load->view('admin/exceleditproductdata_validationstatus_ajax',$data);
			}
		}else{
			redirect('admin/super_admin');
		}	
	}
	
	
	function upload_afterconfirmprodexcel_editedprod()
	{
		$this->Bulkporductupdate_model->productupdate_process_statusstart();
		
				$excelfiluploadid=$this->input->post('fileuploadid');				
				$conf_status=$this->input->post('confsts');
				$this->session->set_userdata('prod_uploaduid',$excelfiluploadid);
				
				//$excelfiluploadid='28';
				//$conf_status='yes';
				
				if($conf_status=='yes')
				{
					$this->Bulkporductupdate_model->update_editedbulkuploadafterconf($excelfiluploadid);
					
					//$data=$this->Bulkporductupdate_model->select_edituploadlist_excelsheetwise($excelfiluploadid);
					
					$data['excelupload_statu']=$excelfiluploadid;
					$this->load->view('admin/success_prodedituploadexcel_ajax',$data); 
				}
				else
				{
						
					$this->Bulkporductupdate_model->delete_editedbulkuploadaproduct($excelfiluploadid);
					$data['excelupload_statu']="cancelled";
					$this->load->view('admin/success_prodedituploadexcel_ajax',$data);
					
				}
				
			$this->Bulkporductupdate_model->productupdate_process_statusfinish();		
		
		}
	
	function prod_update_status()
	{
		$data['uploadid']=$this->input->post('fileuploadid');
		$this->load->view('admin/edit_productstatus_ajaxpage',$data);	
	}
	
	
}
?>