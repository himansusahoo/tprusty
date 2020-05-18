<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bulkporductedit_model extends CI_Model
{
	
	function sellerprod_category($seller_id)
	{
		$query=$this->db->query("SELECT lvl2,lvl1,lvlmain FROM cornjob_productsearch WHERE seller_id='$seller_id' GROUP BY lvl2 ");
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
	
	function getedit_attributeset($seller_id)
	{
		
		
		$query=$this->db->query("SELECT b.attribut_set FROM cornjob_productsearch a 
		INNER JOIN product_setting b ON a.product_id=b.product_id	
		WHERE a.seller_id='$seller_id' GROUP BY a.sku ");
		
		$prod_attrbstrg='';
		
		if($query->num_rows()>0)
		{
			$array_prodattrbset=array();
			
			
			foreach($query->result_array()as $res_pordattrbset)
			{
				$array_prodattrbset[]=$res_pordattrbset['attribut_set'];
				
			}
			
			$prod_attrbstrg=implode(',',array_unique($array_prodattrbset));
			return $prod_attrbstrg;
				
		}
		else
		{
			return $prod_attrbstrg;	
		}	
			
	}
	
	function getedit_attributeset_ascatg($seller_id,$catg_id)
	{
			$query=$this->db->query("SELECT b.attribut_set,d.* FROM cornjob_productsearch a 
			INNER JOIN product_setting b ON a.product_id=b.product_id
			INNER JOIN product_category c ON c.product_id=a.product_id
			INNER JOIN attribute_group d ON d.attribute_group_id=b.attribut_set	
			WHERE a.seller_id='$seller_id' AND c.category_id='$catg_id'  GROUP BY d.attribute_group_id ");
			
			return $query;
			
			
	}
	
	
	function insertedit_excelsheetlog($cur_dt,$exl_filename,$seller_id,$catg_id,$attrbsetids)
	{
		$data=array(
		'excelfile_name'=>$exl_filename,
		'gen_dt'=>$cur_dt,
		'seller_id'=>$seller_id,
		'attribute_set'=>$attrbsetids,
		'category_id'=>$catg_id
		);
		
		$this->db->insert('bulkprodedit_templatelog',$data);
					
	}
	
	function select_editprodtemplatedidwise($seller_id,$catg_id,$attr_group_id)
	{
		/*$query = $this->db->query("SELECT a.*,b.product_type, c.attribute_group_name, c.attribute_group_id, d.*, e.imag,e.id AS IMAG_ID ,f.*, h.category_name,h.category_id
		FROM product_master a
		INNER JOIN product_setting b ON a.product_id = b.product_id
		INNER JOIN attribute_group c ON b.attribut_set = c.attribute_group_id
		INNER JOIN product_general_info d ON a.product_id = d.product_id
		INNER JOIN product_image e ON a.product_id = e.product_id
		INNER JOIN product_meta_info f ON a.product_id = f.product_id
		INNER JOIN product_category g ON a.product_id = g.product_id
		INNER JOIN category_indexing h ON g.category_id = h.category_id
		WHERE a.seller_id='$seller_id' AND g.category='$catg_id'");*/
		
		set_time_limit(0);
		$query = $this->db->query("SELECT a.*,b.tax_amount,b.shipping_fee_amount,b.shipping_fee,b.manufacture_country,c.weight,c.description,c.short_desc,d.meta_title,
		d.meta_keywords,d.meta_desc,e.* FROM
		cornjob_productsearch a 
		INNER JOIN product_master b ON b.sku=a.sku
		INNER JOIN product_general_info c ON b.product_id=c.product_id 
		INNER JOIN product_meta_info d ON b.product_id=d.product_id
		INNER JOIN product_image e ON e.product_id=b.product_id
		INNER JOIN product_setting f ON a.product_id=f.product_id  
		WHERE a.seller_id='$seller_id' AND a.lvl2='$catg_id' AND f.attribut_set='$attr_group_id'
		AND a.sku NOT IN (SELECT sku FROM seller_product_master WHERE seller_id='$seller_id')
		GROUP BY a.sku ORDER BY a.product_id DESC ");
		
		return $query;
	}
	
	
	function select_edituploadlistsellerwise($seller_id)
	{
		
		//$query=$this->db->query("SELECT * FROM bulkprod_templatelog WHERE seller_id='$seller_id' ORDER BY blk_tempid DESC ");
		$query=$this->db->query("SELECT * FROM bulkprodedit_templatelog a INNER JOIN  bulk_editedproductupload_log b ON a.blk_tempid=b.uploadprod_uid WHERE seller_id='$seller_id'   GROUP BY b.uploadprod_uid ORDER BY a.blk_tempid DESC ");

		
		return $query;	
	}
	
	
	
	function select_failed_editedprodtemplatedidwise($upload_templateid)
	{
		$prod_query=$this->db->query("SELECT * FROM bulk_editedproductupload_log WHERE uploadprod_uid='$upload_templateid' AND (qc_status='Failed' OR upload_status='pending') AND editstatus='Edited'  ");
		return 	$prod_query;
	}
	
	function selectcatgnm($catg_id)
	{
		$qr=$this->db->query("SELECT category_name FROM category_indexing WHERE category_id='$catg_id' ");
		
		return $qr->row()->category_name;
			
	}
	
	function insertfailededited_excelsheetlog($cur_dt,$exl_filename,$seller_id,$attr_group_id,$catg_id,$upload_templateid)
	{
		$data=array(
		'excelfile_name'=>$exl_filename,
		'gen_dt'=>$cur_dt,
		'seller_id'=>$seller_id,
		'attribute_set'=>$attr_group_id,
		'category_id'=>$catg_id,
		'downlaod_parentid'=>$upload_templateid
		);
		
		$this->db->insert('bulkprodedit_templatelog',$data);
					
	}
	
}