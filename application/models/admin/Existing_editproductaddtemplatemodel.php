<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Existing_editproductaddtemplatemodel extends CI_Model
{
	
	function select_catgnm($catg_id)
	{
		$qr=$this->db->query("SELECT category_name FROM category_indexing WHERE category_id='$catg_id' ");
		
		return $qr->row()->category_name;
			
	}
	
	function select_existprodtemplat($catg_id,$attr_group_id,$productids)
	{
		$prodid_str=implode(',',$productids);
		
		set_time_limit(0);
		$query = $this->db->query("SELECT a.*,b.tax_amount,b.shipping_fee_amount,b.shipping_fee,b.manufacture_country,c.weight,c.description,c.short_desc,d.meta_title,
		d.meta_keywords,d.meta_desc,e.* FROM
		cornjob_productsearch a 
		INNER JOIN product_master b ON b.sku=a.sku
		INNER JOIN product_general_info c ON b.product_id=c.product_id 
		INNER JOIN product_meta_info d ON b.product_id=d.product_id
		INNER JOIN product_image e ON e.product_id=b.product_id
		INNER JOIN product_setting f ON a.product_id=f.product_id  
		WHERE a.lvl2='$catg_id' AND f.attribut_set='$attr_group_id' AND a.product_id IN ($prodid_str)		
		GROUP BY a.sku ORDER BY a.product_id DESC ");
		
		return $query;
			
	}
	
	
	function select_existeditprodtemplat($catg_id,$attr_group_id,$productids,$seller_id,$prod_sku)
	{set_time_limit(0);
		$prodid_str=implode(',',$productids);
		$arr_sku=array();
		foreach($prod_sku as $sku_key=>$sku_val)
		{$arr_sku[]="'".$sku_val."'";}
		
		$sku_string=implode(',',$arr_sku);
		
		
		/*$query = $this->db->query("SELECT a.*,b.tax_amount,b.shipping_fee_amount,b.shipping_fee,b.manufacture_country,c.weight,c.description,c.short_desc,e.* 					        FROM cornjob_productsearch a 
		INNER JOIN product_master b ON b.sku=a.sku
		INNER JOIN product_general_info c ON b.product_id=c.product_id		
		INNER JOIN product_image e ON e.product_id=b.product_id
		INNER JOIN product_setting f ON a.product_id=f.product_id
		INNER JOIN seller_product_master g ON g.master_product_id=a.product_id   
		WHERE a.lvl2='$catg_id' AND f.attribut_set='$attr_group_id' AND a.product_id IN ($prodid_str) AND a.seller_id='$seller_id'		
		GROUP BY a.sku ORDER BY a.product_id DESC ");*/
		
		
		
		$query = $this->db->query("SELECT a.*,b.name,b.weight,b.description,b.short_desc,e.* 
		FROM  product_master a 
		INNER JOIN product_general_info b ON b.product_id=a.product_id		
		INNER JOIN product_image e ON e.product_id=b.product_id
		INNER JOIN product_setting f ON a.product_id=f.product_id
		INNER JOIN seller_product_master g ON g.master_product_id=a.product_id
		INNER JOIN product_category h ON h.product_id=a.product_id
		WHERE h.category_id='$catg_id' AND f.attribut_set='$attr_group_id' AND a.product_id IN ($prodid_str) AND a.sku IN ($sku_string) AND a.seller_id='$seller_id'		
		GROUP BY a.sku ORDER BY a.product_id DESC ");
		
		return $query;
			
	}
	
	function insertexist_editprodexcelsheetlog($cur_dt,$exl_filename,$seller_id,$catg_id,$attrbsetids,$srlz_prodiids)
	{
		$data=array(
		'excelfile_name'=>$exl_filename,
		'gen_dt'=>$cur_dt,
		'seller_id'=>$seller_id,
		'attribute_set'=>$attrbsetids,
		'category_id'=>$catg_id,
		'product_ids'=>$srlz_prodiids
		);
		
		$this->db->insert('bulkexisting_editprodtemplatelog',$data);
					
	}
	
	function retrieve_extprodattr_headings($attr_group_id){ 
		//$attr_group_id = $this->input->post('group_id');
		$query = $this->db->query("SELECT * FROM attributes a
		 INNER JOIN attribute_real b ON a.attribute_group_id=b.attribute_group_id
		 WHERE a.attribute_group_id='$attr_group_id' AND
		 ((b.attribute_field_name='Color' or b.attribute_field_name='color' or b.attribute_field_name='COLOR' )
		 OR (b.attribute_field_name='size' or b.attribute_field_name='Size' or b.attribute_field_name='SIZE') 
		 OR (b.attribute_field_name='Capacity' or b.attribute_field_name='capacity' or b.attribute_field_name='CAPACITY' ) 
		OR  (b.attribute_field_name='RAM' or b.attribute_field_name='Ram' or b.attribute_field_name='ram')
		OR (b.attribute_field_name='ROM' OR b.attribute_field_name='Rom' or b.attribute_field_name='rom'))
		group by b.attribute_heading_id
		 ");
		 
		/* $query = $this->db->query("SELECT b.* FROM attribute_real b 
		 WHERE attribute_group_id='$attr_group_id' AND
		 ((b.attribute_field_name='Color' or b.attribute_field_name='color' or b.attribute_field_name='COLOR' )
		 OR (b.attribute_field_name='size' or b.attribute_field_name='Size' or b.attribute_field_name='SIZE') 
		 OR (b.attribute_field_name='Capacity' or b.attribute_field_name='capacity' or b.attribute_field_name='CAPACITY' ) 
		OR  (b.attribute_field_name='RAM' or b.attribute_field_name='Ram' or b.attribute_field_name='ram')
		OR (b.attribute_field_name='ROM' OR b.attribute_field_name='Rom' or b.attribute_field_name='rom'))
		group by attribute_heading_id
		 ");*/
		
		 
		return $query;
	}
	
}
?>