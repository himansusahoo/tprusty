<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cronjobattrb_manualupdate extends CI_Model{


	function updtae_attrbmanullay($excelfiluploadid)
	{
		set_time_limit(0);
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		
		$qr_filetempdata=$this->db->query("SELECT * FROM bulkprod_templatelog WHERE blk_tempid='$excelfiluploadid' ");
		$res_filetempdata=$qr_filetempdata->row();
		$seller_id=$res_filetempdata->seller_id;
		$attrbset_id=$res_filetempdata->attribute_set;
		$category_id=$res_filetempdata->category_id;
		
		
		
		// attribute id & value list start
			
				$attr_heading_result = $this->db->query("SELECT * FROM attributes WHERE attribute_group_id='$attrbset_id'");
				
				$attr_fld_name=array();
				$attr_id=array();
				
				foreach($attr_heading_result->result_array() as $attr_heading_row){
					
					$attr_hedingid=$attr_heading_row['attribute_heading_id'];
					
					$query_attrbreal = $this->db->query("SELECT * FROM attribute_real WHERE attribute_heading_id=$attr_hedingid ");
					$field_result = $query_attrbreal->result_array();
					
					foreach($field_result as $attr_fld_row)
					{
						 $attr_fld_name[]=$attr_fld_row['attribute_field_name'];
						 $attr_id[]=$attr_fld_row['attribute_id'];
						
					} // attribute field name inner forloop end
					
				}
				
					// attribute heading name inner forloop end
					
			// attribute id & value list end
			
			
			
			/*$qr_filedata=$this->db->query("SELECT * FROM bulkproductupload_log WHERE uploadprod_uid='$excelfiluploadid' AND qc_status='Passed' AND upload_status='Pending'  ");*/
			
			$qr_filedata=$this->db->query("SELECT * FROM  `bulkproductupload_log` WHERE    upload_status =  'Uploaded' AND  (attrb_valueandid !=  'a:0:{}' AND attrb_valueandid !='') AND uploadprod_uid='$excelfiluploadid' AND qc_status='Passed' AND new_sku NOT IN (SELECT sku FROM seller_product_attribute_value)");
			
		$res_filedata=$qr_filedata->result_array();
		
	//----------------------------------main for loop start-------------------------//	
		foreach($res_filedata as $rw_filedata)
		{
			$seller_product_id=$rw_filedata['seller_productid'];
			$sku=$rw_filedata['new_sku'];
			
			
			
			//---------------------------------------------attribute insert code start---------------------------------------
				
				//$attr_fld_name[]=$attr_fld_row['attribute_field_name'];
//				$attr_id[]=$attr_fld_row['attribute_id'];
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');

				$newattr_fld_name=array();
				$attrbid_ky=array();
				$newattr_value=array();
				$newattr_id=array();	
				
				$attr_id_n_value = unserialize($rw_filedata['attrb_valueandid']);
				
				foreach($attr_id_n_value as $attrbidkey=>$attrbvalue)
				{
					$attrbid_ky[]=$attrbidkey;
					$newattr_value[]=$attrbvalue;
					 $newattr_id[]=$attrbidkey;	
				}
				
				for($attri=0; $attri<count($attr_id); $attri++)
				{
					foreach($attr_id_n_value as $attrbidskey=>$attrbsvalues)
					{
						if($attrbidskey==$attr_id[$attri])
						{
							$newattr_fld_name[]=$attr_fld_name[$attri];
							
							
						}
					}
				}
				
				//$attr_id_n_value = array_combine($newattr_id,$newattr_value);
				
				$attr_id_n_value_length = count($attr_id_n_value);
				
			for($atr=0; $atr<$attr_id_n_value_length; $atr++){
			/*$attr_value = $attr_value[$i];
			if($attr_value == ''){
				$attr_value = NULL;
			}else{
				$attr_value = $attr_value;
			}*/
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			if($newattr_fld_name[$atr] == 'Size'){
				if($newattr_value[$atr] != ''){
					$sz_sql = $this->db->query("SELECT size_id FROM size_master WHERE size_name='$newattr_value[$atr]'");
					
					$sizeattrbup_sql = $this->db->query("SELECT sku_id FROM size_attr WHERE sku_id='$sku' ");
					if($sizeattrbup_sql->num_rows()==0)
					{$sz_row = $sz_sql->row();
					$sz_id = $sz_row->size_id;
					$product_sz_attr_data = array(
						'sku_id' => $sku,
						'm_size_id' => $sz_id,
						'm_size_name' => $newattr_value[$atr]
					);
					$this->db->insert('size_attr',$product_sz_attr_data);}
				}
			}
			
			//progrm for sub size attribute
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			
			if($newattr_fld_name[$atr] == 'Size Type'){
				if($attr_value[$atr] != ''){
					$sb_sz_sql = $this->db->query("SELECT size_id FROM size_master WHERE size_name='$newattr_value[$atr]'");
					$sb_sz_row = $sb_sz_sql->row();
					$sb_sz_id = $sb_sz_row->size_id;
					$product_sb_sz_attr_data = array(
						'sku_id' => $sku,
						's_size_id' => $sb_sz_id,
						's_size_name' => $newattr_value[$atr]
					);
					
					//program start for checking if sku is exits or not in size_attr table and insert or update
					$sq = $this->db->query("SELECT * FROM size_attr WHERE sku_id='$sku'");
					if($sq->num_rows() > 0){
						$product_sb_sz_attr_data1 = array(
							's_size_id' => $sb_sz_id,
							's_size_name' => $newattr_value[$atr]
						);
						$this->db->where('sku_id',$sku);
						$this->db->update('size_attr',$product_sb_sz_attr_data1);
					}else{
						$this->db->insert('size_attr',$product_sb_sz_attr_data);
					}
					//program end of checking if sku is exits or not in size_attr table and insert or update
				}
			}
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			
			if($newattr_fld_name[$atr] == 'Color'){
				if($newattr_value[$atr] != ''){
					$clor_sql = $this->db->query("SELECT color_id FROM color_master WHERE clr_name='$newattr_value[$atr]'");
					if($clor_sql->num_rows()>0)
					{
						$clorattrbup_sql = $this->db->query("SELECT sku_id FROM color_attr WHERE sku_id='$sku' ");
						
						if($clorattrbup_sql->num_rows()==0)
						{$clor_row = $clor_sql->row();
						$clor_id = $clor_row->color_id;
						$product_color_attr_data = array(
							'sku_id' => $sku,
							'color_id' => $clor_id,
							'clr_name' => $newattr_value[$atr]
						);
						$this->db->insert('color_attr',$product_color_attr_data);}
					}
					
				}
			}
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			
			$product_attr_data = array(
				'seller_product_id' => $seller_product_id,
				'sku' => $sku,
				'attr_id' => $newattr_id[$atr],
				'attr_value' => $newattr_value[$atr], 
			);
			 	 //$newattr_id[$atr];
			 	 //$newattr_value[$atr];
			
			$this->db->insert('seller_product_attribute_value',$product_attr_data);
		}
		
	//---------------------------------------------attribute insert code end---------------------------------------
			
			
			//---------------------------------------Data update in cronjob product start-------------------------------//
				$skr_arr=array();
				$skr_arr[]=$sku;
				
			$this->manual_update_cronjobattributedata($skr_arr);
			//---------------------------------------Data Update in cronjob productend----------------------------------//
			$data_attrbupdatearr=array(
			'attrb_skuid'=>$sku 
			);
			$this->db->insert('attrbupdate_count',$data_attrbupdatearr);
		}
 		 //---------------------------------main for loop end-------------------------------//		
				
	}



	function manual_update_cronjobattributedata($skr_arr)
	{
		set_time_limit(0);
		$arr=array();
		foreach($skr_arr as $k=>$v){
			$arr[] = "'".$v."'";
		}
		$sku_strng = implode(',',$arr);
		

$this->db->query("UPDATE cornjob_productsearch SET color=( SELECT a.attr_value AS attr_value FROM seller_product_attribute_value a INNER JOIN attribute_real b ON a.attr_id = b.attribute_id WHERE b.attribute_field_name='Color' AND a.sku=cornjob_productsearch.sku GROUP BY sku ) WHERE sku IN ($sku_strng)");

 
 
 // color code by santanu start
 
 			$this->db->query("UPDATE cornjob_productsearch SET color=( SELECT clr_name
FROM color_attr
WHERE sku_id=cornjob_productsearch.sku
GROUP BY sku_id ) WHERE sku IN ($sku_strng)");
 
 // clolr code by santanu end
 
		
	

$this->db->query("UPDATE cornjob_productsearch SET size=( SELECT a.attr_value AS attr_value FROM seller_product_attribute_value a INNER JOIN attribute_real b ON a.attr_id = b.attribute_id WHERE b.attribute_field_name='Size' AND a.sku=cornjob_productsearch.sku GROUP BY sku ) WHERE sku IN ($sku_strng)");





// size code by santanu start
 
 			$this->db->query("UPDATE cornjob_productsearch SET size=( SELECT m_size_name
FROM size_attr
WHERE sku_id=cornjob_productsearch.sku
GROUP BY sku_id ) WHERE sku IN ($sku_strng)");
 
 // size code by santanu end

		

$this->db->query("UPDATE cornjob_productsearch SET brand=( SELECT a.attr_value AS attr_value FROM seller_product_attribute_value a INNER JOIN attribute_real b ON a.attr_id = b.attribute_id	WHERE b.attribute_field_name='Brand' AND a.sku=cornjob_productsearch.sku GROUP BY sku) WHERE sku IN ($sku_strng)");



	

$this->db->query("UPDATE cornjob_productsearch SET sub_size=( SELECT a.attr_value AS attr_value FROM seller_product_attribute_value a INNER JOIN attribute_real b ON a.attr_id = b.attribute_id WHERE b.attribute_field_name='Sub size' AND a.sku=cornjob_productsearch.sku GROUP BY sku) WHERE sku IN ($sku_strng)");


// subsize code by santanu start
 
 			$this->db->query("UPDATE cornjob_productsearch SET sub_size=( SELECT s_size_name
FROM size_attr
WHERE sku_id=cornjob_productsearch.sku
GROUP BY sku_id ) WHERE sku IN ($sku_strng)");
 
 // subsize code by santanu end

		

$this->db->query("UPDATE cornjob_productsearch SET occasion=( SELECT a.attr_value AS attr_value FROM seller_product_attribute_value a INNER JOIN attribute_real b ON a.attr_id = b.attribute_id WHERE b.attribute_field_name='Occasion' AND a.sku=cornjob_productsearch.sku GROUP BY sku ) WHERE sku IN ($sku_strng)");

	


	$this->db->query("UPDATE cornjob_productsearch SET type=( SELECT a.attr_value AS attr_value FROM seller_product_attribute_value a INNER JOIN attribute_real b ON a.attr_id = b.attribute_id WHERE b.attribute_field_name='Type' AND a.sku=cornjob_productsearch.sku GROUP BY sku ) WHERE sku IN ($sku_strng)");

	}





}