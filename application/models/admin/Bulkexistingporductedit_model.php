<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bulkexistingporductedit_model extends CI_Model
{
	function sellerprod_category($seller_id)
	{
		$query=$this->db->query("SELECT lvl2,lvl1,lvlmain FROM cornjob_productsearch a INNER JOIN seller_product_master b ON b.master_product_id=a.product_id WHERE a.seller_id='$seller_id' GROUP BY lvl2 ");
		$prod_catgstrg='';
		if($query->num_rows()>0)
		{
			$array_prodcatg=array();
			
			
			foreach($query->result_array()as $res_pordcatg)
			{
				$array_prodcatg[]=$res_pordcatg['lvl2'];
				$array_prodcatg[]=$res_pordcatg['lvl1'];
				$array_prodcatg[]=$res_pordcatg['lvlmain'];	
			}
			
			$prod_catgstrg=implode(',',array_unique($array_prodcatg));
			return $prod_catgstrg;
				
		}
		else
		{
			return $prod_catgstrg;	
		}	
	}

		function search_bulkexistingedit_product_listcount($catg_id,$attrbsetid,$seller_id)
		{
			if(@$_REQUEST['catg_id'] && @$_REQUEST['attrbsetid'])
			
			{	$catg_id = $_REQUEST['catg_id'];
				$attrbsetid = $_REQUEST['attrbsetid'];
			}
		$query=$this->db->query("SELECT a.product_id FROM cornjob_productsearch a 
		INNER JOIN product_setting b ON a.product_id=b.product_id
		INNER JOIN seller_product_master c ON c.master_product_id=a.product_id	
		WHERE a.lvl2 IN ($catg_id) AND a.seller_id='$seller_id' AND b.attribut_set='$attrbsetid' AND a.seller_id='$seller_id' GROUP BY a.sku,a.product_id  ");
		
		return $query->num_rows();	
	}
	
	function search_bulkexisting_productedit_list($limit,$start,$catg_id,$attrbsetid,$seller_id)
	{
			//$seller_id=$this->uri->segment(4);
			if(@$_REQUEST['catg_id'] && @$_REQUEST['attrbsetid'])
			
			{	$catg_id = $_REQUEST['catg_id'];
				$attrbsetid = $_REQUEST['attrbsetid'];
			}
			$query=$this->db->query("SELECT a.product_id,a.* FROM cornjob_productsearch a 
		INNER JOIN product_setting b ON a.product_id=b.product_id
		INNER JOIN seller_product_master c ON c.master_product_id=a.product_id	
		WHERE a.lvl2 IN ($catg_id) AND a.seller_id='$seller_id' AND b.attribut_set='$attrbsetid'   GROUP BY a.sku,a.product_id,b.product_id order by a.product_id DESC LIMIT ".$start." , ".$limit." ");
		
		return $query;
		
	}
	
	
	
	function search_bulkexisting_editedproductlist_filtercount()
	{
				/*$catg_id = @$_REQUEST['catg_id'];
				$attrbsetid = @$_REQUEST['attrbsetid'];
				
				if($catg_id=='' && $attrbsetid=='' )
				{
					$catg_id=$this->session->userdata('catgid');
			 		$attrbsetid=$this->session->userdata('attrbid');	
				}*/
				
				$catg_id=$this->uri->segment(4);
				$attrbsetid=$this->uri->segment(5);
				$seller_id=$this->uri->segment(6);
				
				if($_REQUEST['from_dtm'] && $_REQUEST['to_dtm'])
				{
					/*$from_dtm = $_REQUEST['from_dtm'].' 00:00:00';	
					$to_dtm = $_REQUEST['to_dtm'].' 00:00:00';*/
					
					$fromtime_search = strtotime($_REQUEST['from_dtm']); 
					$from_dtm= date("Y-m-d H:i:s", $fromtime_search);
					
					$totime_search = strtotime($_REQUEST['to_dtm']); 
					$to_dtm= date("Y-m-d H:i:s", $totime_search);
					
					
				}
				else
				{
					$from_dtm ='';	
					$to_dtm = '';	
				}
				
				$prod_name = trim($_REQUEST['prod_name']);
				$prod_sku = trim($_REQUEST['prod_sku']);
				$slr_name = trim($_REQUEST['seller_name']);
				
				$condition = '';
			
			if( $from_dtm!='' &&  $to_dtm!=''){
				
				$condition .= " c.date_added>='$from_dtm' AND c.date_added<='$to_dtm' " ;
							
				$query=$this->db->query("SELECT a.product_id FROM cornjob_productsearch a 
											INNER JOIN product_setting b ON a.product_id=b.product_id
											INNER JOIN seller_product_setting c ON c.master_product_id=a.product_id
											INNER JOIN seller_product_master d ON d.master_product_id=a.product_id	
											WHERE ".$condition." AND a.lvl2 IN ($catg_id) AND a.seller_id='$seller_id' AND b.attribut_set='$attrbsetid' 
											GROUP BY a.sku,a.product_id  ");
				
						return $query->num_rows();			
			}		
			
			if($prod_name!=''){
				
				$condition .= " a.name LIKE '%$prod_name%' " ;
							
				$query=$this->db->query("SELECT a.product_id FROM cornjob_productsearch a 
											INNER JOIN product_setting b ON a.product_id=b.product_id
											INNER JOIN seller_product_master c ON c.master_product_id=a.product_id											
											WHERE ".$condition." AND a.lvl2 IN ($catg_id) AND a.seller_id='$seller_id'  AND b.attribut_set='$attrbsetid' 
											GROUP BY a.sku,a.product_id  ");
				
						return $query->num_rows();
				
			}
			if($prod_sku!=''){
				
				$condition .= " a.sku LIKE '%$prod_sku%' " ;
							
				$query=$this->db->query("SELECT a.product_id FROM cornjob_productsearch a 
											INNER JOIN product_setting b ON a.product_id=b.product_id
											INNER JOIN seller_product_master c ON c.master_product_id=a.product_id												
											WHERE ".$condition." AND a.lvl2 IN ($catg_id) AND a.seller_id='$seller_id' AND b.attribut_set='$attrbsetid' 
											GROUP BY a.sku,a.product_id  ");
				
						return $query->num_rows();
				
			}
			
			if($slr_name!=''){
				
				$condition .= " c.business_name LIKE '%$slr_name%' " ;
							
				$query=$this->db->query("SELECT a.product_id FROM cornjob_productsearch a 
											INNER JOIN product_setting b ON a.product_id=b.product_id
											INNER JOIN seller_account_information c ON c.seller_id=a.seller_id
											INNER JOIN seller_product_master d ON d.master_product_id=a.product_id											
											WHERE ".$condition." AND a.lvl2 IN ($catg_id) AND a.seller_id='$seller_id' AND b.attribut_set='$attrbsetid' 
											GROUP BY a.sku,a.product_id  ");
				
						return $query->num_rows();
				
			}
				
				$query=$this->db->query("SELECT a.product_id FROM cornjob_productsearch a 
										INNER JOIN product_setting b ON a.product_id=b.product_id
										INNER JOIN seller_product_master c ON c.master_product_id=a.product_id	
										WHERE a.lvl2 IN ($catg_id) AND b.attribut_set='$attrbsetid' AND a.seller_id='$seller_id'  GROUP BY a.sku,a.product_id  ");
		
		return $query->num_rows();	
	}
	
	
	function search_bulkexisting_editedproductlist_filter($limit,$start)
	{
				/*$catg_id = @$_REQUEST['catg_id'];
				$attrbsetid = @$_REQUEST['attrbsetid'];
				
				if($catg_id=='' && $attrbsetid=='' )
				{
					$catg_id=$this->session->userdata('catgid');
			 		$attrbsetid=$this->session->userdata('attrbid');	
				}*/
				
				
				$catg_id=$this->uri->segment(4);
				$attrbsetid=$this->uri->segment(5);
				$seller_id=$this->uri->segment(6);
				
				if($_REQUEST['from_dtm'] && $_REQUEST['to_dtm'])
				{
					/*$from_dtm = $_REQUEST['from_dtm'].' 00:00:00';	
					$to_dtm = $_REQUEST['to_dtm'].' 00:00:00';*/			
					
					
					$fromtime_search = strtotime($_REQUEST['from_dtm']); 
					$from_dtm= date("Y-m-d H:i:s", $fromtime_search);
					
					$totime_search = strtotime($_REQUEST['to_dtm']); 
					$to_dtm= date("Y-m-d H:i:s", $totime_search);
				}
				else
				{
					$from_dtm ='';	
					$to_dtm = '';	
				}
				
				$prod_name = trim($_REQUEST['prod_name']);
				$prod_sku = trim($_REQUEST['prod_sku']);
				$slr_name = trim($_REQUEST['seller_name']);
				
				$condition = '';
			
			if( $from_dtm!='' &&  $to_dtm!=''){
				
				$condition .= " c.date_added>='$from_dtm' AND c.date_added<='$to_dtm' " ;
							
				$query=$this->db->query("SELECT a.* FROM cornjob_productsearch a 
											INNER JOIN product_setting b ON a.product_id=b.product_id
											INNER JOIN seller_product_setting c ON c.master_product_id=a.product_id
											INNER JOIN seller_product_master d ON d.master_product_id=a.product_id	
											WHERE ".$condition." AND a.lvl2 IN ($catg_id) AND a.seller_id='$seller_id' AND b.attribut_set='$attrbsetid' 
											GROUP BY a.sku,a.product_id ORDER BY a.product_id DESC  LIMIT ".$start.", ".$limit." ");
				
						return $query;			
			}		
			
			if($prod_name!=''){
				
				$condition .= " a.name LIKE '%$prod_name%' " ;
							
				$query=$this->db->query("SELECT a.* FROM cornjob_productsearch a 
											INNER JOIN product_setting b ON a.product_id=b.product_id
											INNER JOIN seller_product_master c ON c.master_product_id=a.product_id											
											WHERE ".$condition." AND a.lvl2 IN ($catg_id) AND a.seller_id='$seller_id' AND b.attribut_set='$attrbsetid' 
											GROUP BY a.sku,a.product_id ORDER BY a.product_id DESC  LIMIT ".$start.", ".$limit." ");
				
						return $query;
				
			}
			if($prod_sku!=''){
				
				$condition .= " a.sku LIKE '%$prod_sku%' " ;
							
				$query=$this->db->query("SELECT a.* FROM cornjob_productsearch a 
											INNER JOIN product_setting b ON a.product_id=b.product_id
											INNER JOIN seller_product_master c ON c.master_product_id=a.product_id											
											WHERE ".$condition." AND a.lvl2 IN ($catg_id) AND a.seller_id='$seller_id' AND b.attribut_set='$attrbsetid' 
											GROUP BY a.sku,a.product_id ORDER BY a.product_id DESC  LIMIT ".$start.", ".$limit." ");
				
						return $query;
				
			}
			
			
			if($slr_name!=''){
				
				$condition .= " c.business_name LIKE '%$slr_name%' " ;
							
				$query=$this->db->query("SELECT a.* FROM cornjob_productsearch a 
											INNER JOIN product_setting b ON a.product_id=b.product_id
											INNER JOIN seller_account_information c ON c.seller_id=a.seller_id
											INNER JOIN seller_product_master d ON d.master_product_id=a.product_id											
											WHERE ".$condition." AND a.lvl2 IN ($catg_id) AND a.seller_id='$seller_id' AND b.attribut_set='$attrbsetid' 
											GROUP BY a.sku,a.product_id ORDER BY a.product_id DESC  LIMIT ".$start.", ".$limit." ");
				
						return $query;
				
			}
				
						$query=$this->db->query("SELECT a.* FROM cornjob_productsearch a 
				INNER JOIN product_setting b ON a.product_id=b.product_id
				INNER JOIN seller_product_master c ON c.master_product_id=a.product_id	
				WHERE a.lvl2 IN ($catg_id) AND a.seller_id='$seller_id' AND b.attribut_set='$attrbsetid' 
				GROUP BY a.sku,a.product_id ORDER BY a.product_id DESC  LIMIT ".$start.", ".$limit." ");
		
			return $query;		
	}
	
	
	function select_uploadlistsellerwise($seller_id)
	{
		
		//$query=$this->db->query("SELECT * FROM bulkprod_templatelog WHERE seller_id='$seller_id' ORDER BY blk_tempid DESC ");
		$query=$this->db->query("SELECT * FROM bulkexisting_editprodtemplatelog a INNER JOIN  bulk_existing_editedproductupload_log b ON a.blk_tempid=b.uploadprod_uid WHERE seller_id='$seller_id' AND b.editstatus='Edited' GROUP BY b.uploadprod_uid ORDER BY a.blk_tempid DESC ");

		
		return $query;	
	}
	
	
	
	
}