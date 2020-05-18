<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advance_search extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('html','form','url'));
		$this->load->library('form_validation');	
		$this->load->library('session');
		$this->load->library('javascript');
		$this->load->library('encrypt');
		$this->load->helper('string');
		$this->load->database();
		$this->load->library('pagination');			
		$this->load->model('admin/Advance_search_model');
		
	}

	function selectcategory_as_seller()
	{
		if($this->session->userdata('logged_in'))
		{
			$data['catgname']=$this->Advance_search_model->select_categoryas_seller();
			
			$this->load->view('admin/advance_search/category_ajax',$data);
				
		}
		else
		{redirect('admin/super_admin');}	
	}
	
	function selectattrb_as_seller()
	{
		if($this->session->userdata('logged_in'))
		{
			$data['attrbdata']=$this->Advance_search_model->select_attributeas_seller();
			
			//$this->load->view('admin/advance_search/category_ajax',$data);
			
			$this->load->view('admin/advance_search/atribute_ajax',$data);
		}
		else
		{redirect('admin/super_admin');}		
	}
	
	function select_allcategory()
	{
		if($this->session->userdata('logged_in'))
		{
			$data['allcatg']=$this->Advance_search_model->populate_allcategories();		
			
			$this->load->view('admin/advance_search/allcategories_ajax',$data);
		}
		else
		{
			redirect('admin/super_admin');
		}
		
	}
	
	function selectattrb_as_category()
	{
		if($this->session->userdata('logged_in'))
		{
			$data['attrbdata']=$this->Advance_search_model->populate_attributeas_categories();			
			
			$this->load->view('admin/advance_search/allattribute_ajaxascategory',$data);
		}
		else
		{
			redirect('admin/super_admin');
		}	
	}
	
	function show_attributeactualvalue()
	{
		if($this->session->userdata('logged_in'))
		{
			$data['attrfieldtd_id']=$this->input->post('tdid');
			$data['attrb_headname']=$this->input->post('attrb_headingname');
			$data['attrbval_query']=$this->Advance_search_model->populate_attributeactualvalue();			
			
			$this->load->view('admin/advance_search/actualattributevalue_ajax',$data);
		}
		else
		{
			redirect('admin/super_admin');
		}
			
	}
	
	function advancesearch_productinfo()
	{
		//header("Location:server-pc/moonboy");
		
		if($this->session->userdata('logged_in'))
		{	
			$this->load->model('admin/Advance_searchmodel_count');
			
			$config = array();
			$config["base_url"] = base_url()."admin/Advance_search/advancesearch_productinfo";
			$config["total_rows"] = $this->Advance_searchmodel_count->selected_advanceproductsearch_count();
			$config["per_page"] = 1000;
			$config["uri_segment"] = 4;
			//$config['use_page_numbers'] = TRUE;
			$config["page_query_string"] = TRUE;
			$config['enable_query_strings'] = TRUE;
			$config['reuse_query_string'] = TRUE;
			$choice = $config["total_rows"] / $config["per_page"];			
			//$config["num_links"] = round($choice);
			$config["num_links"] = 5;
			$config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
			$config['cur_tag_close'] = '</a>';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Previous';			
			$this->pagination->initialize($config);
			$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;			
			
			$data['product_info']=$this->Advance_search_model->selected_advanceproductsearch($config["per_page"],$page);
			$data['links'] = $this->pagination->create_links();		
			
			$data['prod_count']=$config["total_rows"];
			$this->load->view('admin/advance_productserachdisplaydata',$data);
		}
		else
		{
			redirect('admin/super_admin');
		}
	}
	
	function exporttoexcel_product()
	{	if($this->session->userdata('logged_in'))
		{
			 
			$this->load->model('admin/Advance_search_exporttoexcel_model');
			$data['product_info']=$this->Advance_search_exporttoexcel_model->exportselected_advanceproductsearch();
				
			$this->load->view('admin/exporttoexcel_advancesearch',$data);
			
		}
		else
		{
			redirect('admin/super_admin');
		}		
			
	}
	
	
	function exporttoexcel_asselectedrow()
	{	if($this->session->userdata('logged_in'))
		{
			 
			$this->load->model('admin/Advance_search_exporttoexcel_model');
			$data['product_info']=$this->Advance_search_exporttoexcel_model->export_selectedproduct();
				
			$this->load->view('admin/exporttoexcel_advancesearch',$data);
			
		}
		else
		{
			redirect('admin/super_admin');
		}		
			
	}
	
	
	/*function exporttoexcel_productwithattribute()
	{
		if($this->session->userdata('logged_in'))
		{
			$data['fltrcatg_id']=$this->session->userdata('sess_catg_ids_string');
			$data['fltr_attrbgrpid']=$this->session->userdata('sess_attrbgrouids_string');
			
			$this->load->model('admin/Advance_search_exporttoexcel_model');
			$data['product_info']=$this->Advance_search_exporttoexcel_model->exportselected_advanceproductsearch();
				
			$this->load->view('admin/exporttoexcel_advancesearch_withattribute',$data);
				
			
		}
		else
		{
			redirect('admin/super_admin');
		}	
				
	}*/
	
	
	function exporttoexcel_productwithattribute()
	{
		if($this->session->userdata('logged_in'))
		{
			$data['fltrcatg_id']=$this->session->userdata('sess_catg_ids_string');
			$data['fltr_attrbgrpid']=$this->session->userdata('sess_attrbgrouids_string');
			$data['fltrseller_ids']=$this->session->userdata('sess_seller_idsrchstring');
			/*$this->load->model('admin/Advance_search_exporttoexcel_model');
			$data['product_info']=$this->Advance_search_exporttoexcel_model->exportselected_advanceproductsearch();
				
			$this->load->view('admin/exporttoexcel_advancesearch_withattribute',$data);
				*/
				
			$this->load->view('admin/advancesearch_exportlist',$data);	
			
		}
		else
		{
			redirect('admin/super_admin');
		}	
				
	}
	
	function exportproduct_attributewise()
	{
		
		if($this->session->userdata('logged_in')){
			
			//$catg_id=$this->uri->segment(4);
			$catg_ids=$this->input->post('ctagid');
			$catg_id=$catg_ids[0];
			//$attr_group_id=$this->uri->segment(5);
			$attr_group_ids=$this->input->post('attrbgrpid');
			$attr_group_id=$attr_group_ids[0];			
			//$seller_id=$this->uri->segment(6);
			
			//$data['edited_product']=$this->Bulkporductedit_model->select_editprodtemplatedidwise($seller_id,$catg_id,$attr_group_id);
			$this->load->model('admin/Advance_search_exporttoexcel_model');
			$data['edited_product']=$this->Advance_search_exporttoexcel_model->select_productattributewise($catg_id,$attr_group_id);
			
			 $dt_rec = preg_replace("/[^0-9]+/","", date('d-m-Y H:i:s'));
			 $rand_string=random_string('alnum',10);		
			
			$this->load->model('admin/Downlaod_bulkprodtemplatemodel');
			$data['catgnm'] = $this->Downlaod_bulkprodtemplatemodel->select_catgnm($catg_id);			
			$data['rand_string']=$rand_string;
			$data['dt_rec']=$dt_rec;
			$catgnm=$data['catgnm'];
			//attribute headin retrive start			
			$this->load->model('admin/Attribute_model');
			$data['attr_heading_result'] = $this->Attribute_model->retrieve_attr_headings($attr_group_id);
			
			$cur_dt=date('y-m-d H:i:s');
			
			
			$data['color_result'] = $this->Attribute_model->retrieve_colors();
			$data['size_result'] = $this->Attribute_model->retrieve_size();
			$data['sub_size_result'] = $this->Attribute_model->retrieve_sub_size();
			
		
		$this->load->view('admin/advancesearchproduct_exportattributewiseexcelsheet',$data);	
			
			
		}else{
			redirect('admin/super_admin');
		}	
			
	}
	
	
	
}
?>