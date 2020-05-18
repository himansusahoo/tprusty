<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Bulkproduct_model extends CI_Model
{
	function select_allnewproductuploadlist($limit,$start)
	{
		
		//$query=$this->db->query("SELECT * FROM bulkprod_templatelog WHERE seller_id='$seller_id' ORDER BY blk_tempid DESC ");
		$query=$this->db->query("SELECT * FROM bulkprod_templatelog a INNER JOIN  bulkproductupload_log b ON a.blk_tempid=b.uploadprod_uid GROUP BY b.uploadprod_uid ORDER BY a.blk_tempid DESC LIMIT ".$start.", ".$limit." ");

		
		return $query;	
	}
	
	function select_allnewproductuploadlist_count()
	{
		$query=$this->db->query("SELECT * FROM bulkprod_templatelog a INNER JOIN  bulkproductupload_log b ON a.blk_tempid=b.uploadprod_uid GROUP BY b.uploadprod_uid  ");

		
		return $query->num_rows();	
	}
	
	function select_allnewproductupload_edit_count()
	{
		$query=$this->db->query("SELECT * FROM bulkprodedit_templatelog a INNER JOIN  bulk_editedproductupload_log b ON a.blk_tempid=b.uploadprod_uid GROUP BY b.uploadprod_uid ");

		
		return $query->num_rows();		
	}
	
	function select_allnewproductupload_edit_list($limit,$start)
	{
		$query=$this->db->query("SELECT * FROM bulkprodedit_templatelog a INNER JOIN  bulk_editedproductupload_log b ON a.blk_tempid=b.uploadprod_uid GROUP BY b.uploadprod_uid ORDER BY a.blk_tempid DESC LIMIT ".$start.", ".$limit." ");
	
	
		return $query;	
	
	
	}
	
	function select_allnewproductuploadlist_filtercount()
	{
			$excelfilename_name = $_REQUEST['excelfilename_name'];	
			$seller_name = $_REQUEST['seller_name'];
			$download_date_from = $_REQUEST['download_date_from'];				
			$download_date_to = $_REQUEST['download_date_to'];			
			$upload_from = $_REQUEST['upload_from'];			
			$upload_to = $_REQUEST['upload_to'];
			
			$condition = '';
			
			if($excelfilename_name != "")
			{
				$condition .= " a.excelfile_name LIKE '%$excelfilename_name%' " ;			
				
				$query=$this->db->query(" SELECT * FROM bulkprod_templatelog a INNER JOIN  bulkproductupload_log b ON a.blk_tempid=b.uploadprod_uid  where ".$condition." GROUP BY b.uploadprod_uid  ");
				
						return $query->num_rows();
			}
			
			if($seller_name != "")
			{
				$condition .= " c.business_name LIKE '%$seller_name%' " ;			
				
				$query=$this->db->query(" SELECT * FROM bulkprod_templatelog a INNER JOIN  bulkproductupload_log b ON a.blk_tempid=b.uploadprod_uid 
				INNER JOIN seller_account_information c ON a.seller_id=c.seller_id
				 where ".$condition." GROUP BY b.uploadprod_uid  ");
				
						return $query->num_rows();
			}
			
			
			if($download_date_from != "" && $download_date_to != "")
			{
				$condition .= " a.gen_dt >= '$download_date_from' AND a.gen_dt<= $download_date_to" ;			
				
				$query=$this->db->query(" SELECT * FROM bulkprod_templatelog a INNER JOIN  bulkproductupload_log b ON a.blk_tempid=b.uploadprod_uid  where ".$condition." GROUP BY b.uploadprod_uid  ");
				
						return $query->num_rows();
			}
			
			if($upload_from != "" && $upload_from != "")
			{
				$condition .= " a.upload_dtime >= '$download_date_from' AND a.upload_dtime<= $download_date_to" ;			
				
				$query=$this->db->query(" SELECT * FROM bulkprod_templatelog a INNER JOIN  bulkproductupload_log b ON a.blk_tempid=b.uploadprod_uid  where ".$condition." GROUP BY b.uploadprod_uid  ");
				
						return $query->num_rows();
			}
			else
			{
				$query=$this->db->query("SELECT * FROM bulkprod_templatelog a INNER JOIN  bulkproductupload_log b ON a.blk_tempid=b.uploadprod_uid GROUP BY b.uploadprod_uid  ");
				
				return $query->num_rows();	
			}	
	}
	
	
	function select_allnewproductuploadlist_filter($limit,$start)
	{
		
			$excelfilename_name = $_REQUEST['excelfilename_name'];	
			$seller_name = $_REQUEST['seller_name'];
			$download_date_from = $_REQUEST['download_date_from'];				
			$download_date_to = $_REQUEST['download_date_to'];			
			$upload_from = $_REQUEST['upload_from'];			
			$upload_to = $_REQUEST['upload_to'];
			
			$condition = '';		
			
			if($excelfilename_name != "")
			{
				$condition .= " a.excelfile_name LIKE '%$excelfilename_name%' " ;			
				
				$query=$this->db->query(" SELECT * FROM bulkprod_templatelog a INNER JOIN  bulkproductupload_log b ON a.blk_tempid=b.uploadprod_uid
				where ".$condition." GROUP BY b.uploadprod_uid ORDER BY a.blk_tempid DESC LIMIT ".$start.", ".$limit."  ");
				
				return $query;
			}
			
			if($seller_name != "")
			{
				$condition .= " c.business_name LIKE '%$seller_name%' " ;			
				
				$query=$this->db->query(" SELECT * FROM bulkprod_templatelog a INNER JOIN  bulkproductupload_log b ON a.blk_tempid=b.uploadprod_uid 
				INNER JOIN seller_account_information c ON a.seller_id=c.seller_id
				 where ".$condition." GROUP BY b.uploadprod_uid ORDER BY a.blk_tempid DESC LIMIT ".$start.", ".$limit." ");
				
						return $query;
			}
			
			
			if($download_date_from != "" && $download_date_to != "")
			{
				$condition .= " a.gen_dt >= '$download_date_from' AND a.gen_dt<= $download_date_to" ;			
				
				$query=$this->db->query(" SELECT * FROM bulkprod_templatelog a INNER JOIN  bulkproductupload_log b ON a.blk_tempid=b.uploadprod_uid
				where ".$condition." GROUP BY b.uploadprod_uid ORDER BY a.blk_tempid DESC LIMIT ".$start.", ".$limit." ");
				
						return $query;
			}
			
			if($upload_from != "" && $upload_from != "")
			{
				$condition .= " a.upload_dtime >= '$download_date_from' AND a.upload_dtime<= $download_date_to" ;			
				
				$query=$this->db->query(" SELECT * FROM bulkprod_templatelog a INNER JOIN  bulkproductupload_log b ON a.blk_tempid=b.uploadprod_uid  where ".$condition." GROUP BY b.uploadprod_uid ORDER BY a.blk_tempid DESC LIMIT ".$start.", ".$limit." ");
				
						return $query;
			}
			else
			{
				$query=$this->db->query("SELECT * FROM bulkprod_templatelog a INNER JOIN  bulkproductupload_log b ON a.blk_tempid=b.uploadprod_uid GROUP BY b.uploadprod_uid ORDER BY a.blk_tempid DESC LIMIT ".$start.", ".$limit." ");
				
				return $query;
					
			}
			
			
				
	}	
	
	
	
} // class end