<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_bulkproduct Extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('html','form','url'));
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->library('encrypt');
		$this->load->library('javascript');
		$this->load->helper('string');			
		$this->load->database();		
		$this->load->model('admin/Bulkporductupload_model');		
	}

	function bulkproductupload_forseller(){
		if($this->session->userdata('logged_in')){
			
			$this->load->model('admin/Seller_model');
			$data['categories'] = $this->Seller_model->getCategories();
			$data['attrbset'] = $this->Bulkporductupload_model->getattributeset();
			$data['seller_id']=$this->uri->segment(4);
			
			$this->load->view('admin/upload_bulkproductfor_single_seller',$data);
			
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function bulk_productuploadtemplate()
	{
			$this->load->helper('string');
			$catg_id=$this->uri->segment(4);
			$attr_group_id=$this->uri->segment(5);
			$seller_id=$this->uri->segment(6);
			
			
			$this->load->model('admin/Bulkporductupload_model');
			
			 date_default_timezone_set('Asia/Calcutta');
			 
			 $dt_rec = preg_replace("/[^0-9]+/","", date('d-m-Y H:i:s'));
			 $rand_string=random_string('alnum',10);		
			
			$data['catgnm'] = $this->Bulkporductupload_model->select_catgnm($catg_id);			
			$data['rand_string']=$rand_string;
			$data['dt_rec']=$dt_rec;
			$catgnm=$data['catgnm'];
			//attribute headin retrive start			
			$this->load->model('admin/Attribute_model');
			$data['attr_heading_result'] = $this->Attribute_model->retrieve_attr_headings($attr_group_id);
			
			$cur_dt=date('y-m-d H:i:s');
			$exl_filename=preg_replace('#"#',"_",preg_replace('#/#',"_",str_replace(' ','_',strtolower($catgnm))))."_".$rand_string."_".$dt_rec.".xls";
			$this->Bulkporductupload_model->insert_excelsheetlog($cur_dt,$exl_filename,$seller_id,$attr_group_id,$catg_id);
				 
			
			$this->load->model('admin/Attribute_model');
			$data['color_result'] = $this->Attribute_model->retrieve_colors();
			$data['size_result'] = $this->Attribute_model->retrieve_size();
			$data['sub_size_result'] = $this->Attribute_model->retrieve_sub_size();
			//$this->load->view('admin/bulkproduct_uploadtemplate',$data);
			
			$this->load->view('admin/upload_bulkproducttempl',$data);
			
			//$this->load->model('admin/Product');
//			$data['result'] = $this->Product->export_product_details();
//			$this->load->view('admin/export_allproduct',$data);
		
	
	}
	
	function upload_prodexcel()
	{
		if($this->session->userdata('logged_in')){
		
		$config['upload_path'] = './bulkproduct_excel/';
		//$config['allowed_types'] = 'doc|pdf|docx|zip|rar';
		$config['allowed_types'] = 'xls|xlsx';
		$config['max_size'] = '100000';
		$this->load->library('upload');
		$this->upload->initialize($config);
		//$this->load->library('upload', $config);
		
		if(!$this->upload->do_upload()){
				 $this->upload->display_errors(); 
				
			}else{
				 $data=$this->upload->data();
				 $excl_filename = $data['file_name'];
				 
				 $rowsdata=$this->Bulkporductupload_model->validbeforeinsert_bulkupload($excl_filename);
				 
					if($rowsdata[0]=="0")
					{				 
						//$this->Bulkporductupload_model->insert_bulkupload($excl_filename);
						$data['rows_status']=$rowsdata;
						$data['excl_filename']=$excl_filename;
						
						$this->load->view('admin/exceldata_validationstatus_ajax',$data);
						//echo "success";
					}else if((int)$rowsdata[0]>0 && $rowsdata[0]!="File has expired")
					{	
						//$output_dir = "./bulkproduct_excel/";
//						$filePath = $output_dir. $excl_filename;
//						unlink($filePath);
						
						$data['rows_status']=$rowsdata;
						$data['excl_filename']=$excl_filename;
						
						$this->load->view('admin/exceldata_validationstatus_ajax',$data); 	
					}
					if($rowsdata[0]=="File has expired" && $rowsdata[0]!="0")
					{  
						$output_dir = "./bulkproduct_excel/";						
						$filePath = $output_dir.$excl_filename;
						unlink($filePath);						
						$data['rows_status']=$rowsdata;
						$this->load->view('admin/exceldata_validationstatus_ajax',$data);	
					}
				
			}	
		
		//echo 'success';exit;
		//redirect('admin/Upload_bulkproduct');	
		}else{
			redirect('admin/super_admin');
		}	
	}
	
	
	
	
	
	function upload_afterconfirmprodexcel()
	{
				$excelfilename=$this->input->post('excelfilnm');
				$conf_status=$this->input->post('conf_status');
				
				 $excl_filename = $data['file_name'];
				 
				 $rowsdata=$this->Bulkporductupload_model->validbeforeinsert_bulkupload($excl_filename);
				 
					if($rowsdata[0]=="0")
					{	if($conf_status=='yes')			 
						{	$this->Bulkporductupload_model->insert_bulkupload($excl_filename);
							$rowsdata[]='allproductadded';
							$data['rows_status']=$rowsdata;
						}
						else
						{
							$output_dir = "./bulkproduct_excel/";						
							$filePath = $output_dir.$excl_filename;
							unlink($filePath);						
							//$data['rows_status']=$rowsdata;
						}
						$this->load->view('admin/exceldata_validationstatus_ajax',$data);
						//echo "success";
					}else if($rowsdata[0]>0)
					{	
						if($conf_status=='yes')
						{	$this->Bulkporductupload_model->insert_bulkupload($excl_filename);
							$rowsdata[]='confirmedproductadded';
							$data['rows_status']=$rowsdata;
						}
						else
						{
							$output_dir = "./bulkproduct_excel/";						
							$filePath = $output_dir.$excl_filename;
							unlink($filePath);		
						}
						
						
						$this->load->view('admin/exceldata_validationstatus_ajax',$data); 	
					}
					if($rowsdata[0]=="File has expired")
					{  
						$output_dir = "./bulkproduct_excel/";						
						$filePath = $output_dir.$excl_filename;
						unlink($filePath);						
						$data['rows_status']=$rowsdata;
						$this->load->view('admin/exceldata_validationstatus_ajax',$data);	
					}
		
		}
	
	
	
	
}