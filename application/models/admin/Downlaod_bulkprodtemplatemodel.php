<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Downlaod_bulkprodtemplatemodel extends CI_Model
{
	function select_catgnm($catg_id)
	{
		$qr=$this->db->query("SELECT category_name FROM category_indexing WHERE category_id='$catg_id' ");
		
		return $qr->row()->category_name;
			
	}
	
	function insert_excelsheetlog($cur_dt,$exl_filename,$seller_id,$attr_group_id,$catg_id)
	{
		$data=array(
		'excelfile_name'=>$exl_filename,
		'gen_dt'=>$cur_dt,
		'seller_id'=>$seller_id,
		'attribute_set'=>$attr_group_id,
		'category_id'=>$catg_id,
		
		);
		
		$this->db->insert('bulkprod_templatelog',$data);
					
	}
	
	function insertfailed_excelsheetlog($cur_dt,$exl_filename,$seller_id,$attr_group_id,$catg_id,$upload_templateid)
	{
		$data=array(
		'excelfile_name'=>$exl_filename,
		'gen_dt'=>$cur_dt,
		'seller_id'=>$seller_id,
		'attribute_set'=>$attr_group_id,
		'category_id'=>$catg_id,
		'downlaod_parentid'=>$upload_templateid
		);
		
		$this->db->insert('bulkprod_templatelog',$data);
					
	}
	
	function select_uploadlistsellerwise($seller_id)
	{
		
		//$query=$this->db->query("SELECT * FROM bulkprod_templatelog WHERE seller_id='$seller_id' ORDER BY blk_tempid DESC ");
		$query=$this->db->query("SELECT * FROM bulkprod_templatelog a INNER JOIN  bulkproductupload_log b ON a.blk_tempid=b.uploadprod_uid WHERE seller_id='$seller_id' GROUP BY b.uploadprod_uid ORDER BY a.blk_tempid DESC ");

		
		return $query;	
	}
	
	
	function select_failedprodtemplatedidwise($upload_templateid)
	{
		$prod_query=$this->db->query("SELECT * FROM bulkproductupload_log WHERE uploadprod_uid='$upload_templateid' AND (qc_status='Failed' OR upload_status='pending')  ");
		return 	$prod_query;
	}
	
}

?>