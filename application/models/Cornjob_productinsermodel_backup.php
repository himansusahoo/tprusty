<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cornjob_productinsermodel extends CI_Model{

	function select_productdata()
	{
		//$this->category_insertinto_cornjob_productsearch();
		
		$this->cronjobsearch_skuprodid_insert();
		$this->category_update();
		$this->cronjobsearch_prodnameimage_update();
		$this->other_data_update_cronjobproductsearch();
		
		
		//$this->cronjobsearch_priceqntstatus_update(); //1st update price and qnt
		//$this->cronjobsearch_sellerstatus_update(); //2nd update seller status
		
	} // select_productdata() function end
	
	
	//function select_productdata1()
//	{
		//$qr_catg=$this->db->query("SELECT lvl2, lvl2_name, lvl1, lvl1_name, lvlmain, lvlmain_name  FROM `view_catinfo`");
//		$row_catg=$qr_catg->result();
//		$this->db->query("truncate temp_category");
//		
//		
//		foreach($row_catg as $res_catg)
//		{
//			$data_catg=array(
//				'lvl2'=>$res_catg->lvl2,
//				'lvl2_name'=>$res_catg->lvl2_name,
//				'lvl1'=>$res_catg->lvl1,
//				'lvl1_name'=>$res_catg->lvl1_name,
//				'lvlmain'=>$res_catg->lvlmain,
//				'lvlmain_name'=>$res_catg->lvlmain_name
//			);
//			$this->db->insert('temp_category',$data_catg);
//		}

//==================================================STEP : 1 START category insert=========================================================================================//
		
		//$qr_catg=$this->db->query("SELECT DISTINCT lvl2, lvl2_name, lvl1, lvl1_name, lvlmain, lvlmain_name  FROM `temp_category`");
//				$row_catg=$qr_catg->result();
//				
//				foreach($row_catg as $res_catg)
//				{
//					$data_catg=array(
//						'lvl2'=>$res_catg->lvl2,
//						'lvl2_name'=>$res_catg->lvl2_name,
//						'lvl1'=>$res_catg->lvl1,
//						'lvl1_name'=>$res_catg->lvl1_name,
//						'lvlmain'=>$res_catg->lvlmain,
//						'lvlmain_name'=>$res_catg->lvlmain_name
//					);
//					$this->db->insert('cornjob_productsearch',$data_catg);
//				} 
//==================================================STEP : 1 END========================================================================================//



//==================================================STEP : 2 START product_id, sku insert=========================================================================================//
		
		 //$query_productid=$this->db->query("select c.product_id,c.sku FROM product_master c INNER JOIN seller_account d ON d.seller_id = c.seller_id WHERE c.sku NOT IN 			                                      (select sku FROM cornjob_productsearch) AND c.seller_id!=0 AND c.approve_status =  'Active' AND c.status='Enabled'
//		                                AND d.status =  'Active' AND d.seller_id IN (SELECT seller_id FROM seller_account_information) limit 1000") ;	
//				
//		$row_productid=$query_productid->result();
//		
//		$prod_sku_array=array();
//		foreach($row_productid as $res_productid)
//		{
//			$sku = "'".$res_productid->sku."'";
//			array_push($prod_sku_array,$sku);	
//			
//		}
//		$sku_str=implode(',',$prod_sku_array);	
//		
//		
//		$qr=$this->db->query("SELECT DISTINCT f.lvl2, f.lvl2_name, f.lvl1, f.lvl1_name, f.lvlmain, f.lvlmain_name, c.sku, c.product_id,c.approve_status,c.seller_id				
//FROM product_master c
//INNER JOIN product_category e ON e.product_id = c.product_id
//INNER JOIN temp_category f ON f.lvl2 = e.category_id WHERE c.sku IN ($sku_str)
//LIMIT 1000 ");
//		
//		$row_prod=$qr->result();
//		if(count($row_prod)>0)
//		{
//			foreach($row_prod as $res_prod)
//			{
//				$skr_arr[] = $res_prod->sku;
//				$data=array(
//					'lvl2'=>$res_prod->lvl2,
//					'lvl2_name'=>$res_prod->lvl2_name,
//					'lvl1'=>$res_prod->lvl1,
//					'lvl1_name'=>$res_prod->lvl1_name,
//					'lvlmain'=>$res_prod->lvlmain,
//					'lvlmain_name'=>$res_prod->lvlmain_name,
//					'sku'=>$res_prod->sku,
//					'product_id'=>$res_prod->product_id,
//					'prod_status'=>$res_prod->approve_status,					
//					'seller_id'=>$res_prod->seller_id
//					
//				);
//				$this->db->insert('cornjob_productsearch', $data);
//			}
//		}
//==================================================STEP : 2 END========================================================================================//
	
	
	
//==============================================STEP : 3 START prod_name, image insert==================================================================================//
	
		// $query_productid=$this->db->query("select c.product_id FROM product_master c INNER JOIN seller_account d ON d.seller_id = c.seller_id WHERE c.product_id IN 			                                      (select product_id FROM cornjob_productsearch) AND c.seller_id!=0 AND c.approve_status =  'Active' AND c.status='Enabled'
//		                                AND d.status =  'Active' AND d.seller_id IN (SELECT seller_id FROM seller_account_information) limit 1000") ;	
//				
//		$row_productid=$query_productid->result();
//		
//		$prod_id_array=array();
//		foreach($row_productid as $res_productid)
//		{
//			$sku = $res_productid->product_id;
//			array_push($prod_id_array,$sku);
//			
//		
//			
//		}
//		$prodid_str=implode(',',$prod_id_array);
//		
//		
//		
//		$qr=$this->db->query("SELECT a.product_id, a.name,b.catelog_img_url
//FROM product_general_info a
//INNER JOIN product_image b ON a.product_id = b.product_id
//WHERE a.product_id IN ($prodid_str)
//LIMIT 1000 ");
//		
//		$row_prod=$qr->result();
//		if(count($row_prod)>0)
//		{
//			foreach($row_prod as $res_prod)
//			{
//				
//				//$data=array('name'=>$res_prod->name,'imag'=>$res_prod->catelog_img_url);
////				$this->db->where('product_id','$res_prod->product_id');
////				$this->db->update('cornjob_productsearch',$data);
//				
//				//$prod_name=mysqli_real_escape_string($res_prod->name);
//				
//				$prod_name=addslashes($res_prod->name);
//				$this->db->query("UPDATE cornjob_productsearch SET name='$prod_name' , imag='$res_prod->catelog_img_url' WHERE product_id='$res_prod->product_id' AND product_id!=0 ");
//			}
//		}
//==================================================STEP : 3 END========================================================================================//



	
//==================================================STEP : 4 START prod_name, image insert=========================================================================================//
	
	 //$query_productid=$this->db->query("select c.sku FROM product_master c INNER JOIN seller_account d ON d.seller_id = c.seller_id WHERE c.product_id NOT IN 			                                      (select product_id FROM cornjob_productsearch) AND c.seller_id!=0 AND c.approve_status =  'Active' AND c.status='Enabled'
//		                                AND d.status =  'Active' AND d.seller_id IN (SELECT seller_id FROM seller_account_information) limit 1000") ;	
//				
//		$row_productid=$query_productid->result();
//		if(count($row_productid)>0)
//			$prod_sku_array=array();
//			foreach($row_productid as $res_productid)
//			{
//				
//					$skr_arr[] = $res_productid->sku;
//				
//			}
//		
//		
//		$this->update_filtering_attribute_data($skr_arr);
//==================================================STEP : 4 END========================================================================================//

//}
	function update_filtering_attribute_data($skr_arr){
		foreach($skr_arr as $k=>$v){
			$arr[] = "'".$v."'";
		}
		$sku_strng = implode(',',$arr);
		//update color attribute
		$this->db->query("UPDATE cornjob_productsearch SET color=( SELECT attr_value
FROM view_attrbute_filter_data
WHERE sku=cornjob_productsearch.sku
AND view_attrbute_filter_data.attribute_field_name='Color'
GROUP BY sku ) WHERE sku IN ($sku_strng)");
		
		//update size attribute
		$this->db->query("UPDATE cornjob_productsearch SET size=( SELECT attr_value
FROM view_attrbute_filter_data
WHERE sku=cornjob_productsearch.sku
AND view_attrbute_filter_data.attribute_field_name='Size'
GROUP BY sku ) WHERE sku IN ($sku_strng)");

		//update brand attribute
		$this->db->query("UPDATE cornjob_productsearch SET brand=( SELECT attr_value
FROM view_attrbute_filter_data
WHERE sku=cornjob_productsearch.sku
AND view_attrbute_filter_data.attribute_field_name='Brand'
GROUP BY sku ) WHERE sku IN ($sku_strng)");

		//update sub size attribute
		$this->db->query("UPDATE cornjob_productsearch SET sub_size=( SELECT attr_value
FROM view_attrbute_filter_data
WHERE sku=cornjob_productsearch.sku
AND view_attrbute_filter_data.attribute_field_name='Sub size'
GROUP BY sku ) WHERE sku IN ($sku_strng)");

		//update Occasion attribute
		$this->db->query("UPDATE cornjob_productsearch SET occasion=( SELECT attr_value
FROM view_attrbute_filter_data
WHERE sku=cornjob_productsearch.sku
AND view_attrbute_filter_data.attribute_field_name='Occasion'
GROUP BY sku ) WHERE sku IN ($sku_strng)");

		//update Type attribute
		$this->db->query("UPDATE cornjob_productsearch SET type=( SELECT attr_value
FROM view_attrbute_filter_data
WHERE sku=cornjob_productsearch.sku
AND view_attrbute_filter_data.attribute_field_name='Type'
GROUP BY sku ) WHERE sku IN ($sku_strng)");
	}
	


		function temp_category_insert()
		{
			$qr_catg=$this->db->query("SELECT lvl2, lvl2_name, lvl1, lvl1_name, lvlmain, lvlmain_name  FROM `view_catinfo` ");
				$row_catg=$qr_catg->result();
				$this->db->query("truncate temp_category");				
				
				foreach($row_catg as $res_catg)
				{
					$data_catg=array(
						'lvl2'=>$res_catg->lvl2,
						'lvl2_name'=>$res_catg->lvl2_name,
						'lvl1'=>$res_catg->lvl1,
						'lvl1_name'=>$res_catg->lvl1_name,
						'lvlmain'=>$res_catg->lvlmain,
						'lvlmain_name'=>$res_catg->lvlmain_name
					);
					$this->db->insert('temp_category',$data_catg);
				}	
			
		}
		
		
		function category_insertinto_cornjob_productsearch()
		{			
			$qr_catg=$this->db->query("SELECT DISTINCT lvl2, lvl2_name, lvl1, lvl1_name, lvlmain, lvlmain_name  FROM `temp_category`");
				$row_catg=$qr_catg->result();
				
				foreach($row_catg as $res_catg)
				{
					$data_catg=array(
						'lvl2'=>$res_catg->lvl2,
						'lvl2_name'=>$res_catg->lvl2_name,
						'lvl1'=>$res_catg->lvl1,
						'lvl1_name'=>$res_catg->lvl1_name,
						'lvlmain'=>$res_catg->lvlmain,
						'lvlmain_name'=>$res_catg->lvlmain_name
					);
					$this->db->insert('cornjob_productsearch',$data_catg);
				}
				
		}
		
		
		function cronjobsearch_skuprodid_insert()
		{
			
				$query_productid=$this->db->query("select c.sku FROM product_master c INNER JOIN seller_account d ON d.seller_id = c.seller_id WHERE c.sku NOT IN 			                                      (select sku FROM cornjob_productsearch WHERE sku!='') AND c.seller_id!=0 AND c.approve_status =  'Active' AND c.status='Enabled'
		                                AND d.status =  'Active' AND d.seller_id IN (SELECT seller_id FROM seller_account_information)") ;	
				
		$row_productid=$query_productid->result();
		if(count($row_productid)>0)
		{
				$prod_sku_array=array();
				foreach($row_productid as $res_productid)
				{
					$sku = "'".$res_productid->sku."'";
					array_push($prod_sku_array,$sku);	
					
				}
				$sku_str=implode(',',$prod_sku_array);	
				
				
				$qr=$this->db->query("SELECT c.sku, c.product_id,c.approve_status,c.seller_id, c.mrp,c.price,c.special_price,c.special_pric_from_dt,c.special_pric_to_dt, c.status, c.quantity,	d.status as seller_status,	
				CASE 
				WHEN c.special_price !=0 AND CURDATE() BETWEEN c.special_pric_from_dt AND c.special_pric_to_dt
				THEN c.special_price
				WHEN c.price !=0
				THEN c.price 
				ELSE c.mrp
				END FINAL_PRICE				
		FROM product_master c INNER JOIN seller_account d ON c.seller_id=d.seller_id WHERE c.sku IN ($sku_str) ");
				
				$row_prod=$qr->result();
				if(count($row_prod)>0)
				{
					foreach($row_prod as $res_prod)
					{
						//$skr_arr[] = $res_prod->sku;
						$data=array(					
							'sku'=>$res_prod->sku,
							'product_id'=>$res_prod->product_id,
							'prod_status'=>$res_prod->approve_status,
							'current_price'=>$res_prod->FINAL_PRICE,					
							'seller_id'=>$res_prod->seller_id,
							'mrp'=>$res_prod->mrp,
							'price'=>$res_prod->price,
							'special_price'=>$res_prod->special_price,
							'special_pric_from_dt'=>$res_prod->special_pric_from_dt,
							'special_pric_to_dt'=>$res_prod->special_pric_to_dt,
							'status'=>$res_prod->status,
							'quantity'=>$res_prod->quantity,
							'seller_status'=>$res_prod->seller_status
							
							
						);
						$this->db->insert('cornjob_productsearch', $data);
					}
				}
		
		}	
			
		}
		
		
		function cronjobsearch_priceqntstatus_update()
		{
			
				$query_productid=$this->db->query("select c.sku	FROM product_master c INNER JOIN seller_account d ON d.seller_id = c.seller_id WHERE c.sku IN (select sku FROM cornjob_productsearch WHERE sku!='' AND mrp=0 ) AND c.seller_id!=0 AND c.approve_status =  'Active' AND c.status='Enabled' AND d.status =  'Active' AND d.seller_id IN (SELECT seller_id FROM seller_account_information)") ;	
				
		$row_productid=$query_productid->result();
		if(count($row_productid)>0)
		{
				$prod_sku_array=array();
				foreach($row_productid as $res_productid)
				{
					$sku = "'".$res_productid->sku."'";
					array_push($prod_sku_array,$sku);	
					
				}
				$sku_str=implode(',',$prod_sku_array);	
				
				
				$qr=$this->db->query("SELECT c.sku, c.mrp,c.price,c.special_price,c.special_pric_from_dt,c.special_pric_to_dt, c.status, c.quantity FROM product_master c WHERE c.sku IN ($sku_str) ");
				
				$row_prod=$qr->result();
				if(count($row_prod)>0)
				{
					foreach($row_prod as $res_prod)
					{
						//$skr_arr[] = $res_prod->sku;
						//$data=array(					
//							'mrp'=>$res_prod->mrp,
//							'price'=>$res_prod->price,
//							'special_price'=>$res_prod->special_price,
//							'special_pric_from_dt'=>$res_prod->special_pric_from_dt,					
//							'special_pric_to_dt'=>$res_prod->special_pric_to_dt,
//							'status'=>$res_prod->status,
//							'quantity'=>$res_prod->quantity
//							
//						);
						
						$this->db->query("update cornjob_productsearch set mrp='$res_prod->mrp', price='$res_prod->price', special_price='$res_prod->special_price', special_pric_from_dt='$res_prod->special_pric_from_dt', special_pric_to_dt='$res_prod->special_pric_to_dt', status='$res_prod->status', quantity='$res_prod->quantity'  WHERE sku = '$res_prod->sku' ");
						
					}
				}
		
		}	
		
		}
		
		
		
		
		function cronjobsearch_sellerstatus_update()
		{
			
				$query_productid=$this->db->query("select c.sku	FROM product_master c INNER JOIN seller_account d ON d.seller_id = c.seller_id WHERE c.sku IN (select sku FROM cornjob_productsearch WHERE sku!='' AND seller_status='Pending' ) AND c.seller_id!=0 AND c.approve_status =  'Active' AND c.status='Enabled' AND d.status =  'Active' AND d.seller_id IN (SELECT seller_id FROM seller_account_information)") ;	
				
		$row_productid=$query_productid->result();
		if(count($row_productid)>0)
		{
				$prod_sku_array=array();
				foreach($row_productid as $res_productid)
				{
					$sku = "'".$res_productid->sku."'";
					array_push($prod_sku_array,$sku);	
					
				}
				$sku_str=implode(',',$prod_sku_array);	
				
				
				$qr=$this->db->query("SELECT c.sku,d.status FROM product_master c INNER JOIN seller_account d ON d.seller_id = c.seller_id  WHERE c.sku IN ($sku_str) ");
				
				$row_prod=$qr->result();
				
				if(count($row_prod)>0)
				{
					foreach($row_prod as $res_prod)
					{
						$this->db->query("update cornjob_productsearch set seller_status='$res_prod->status'  WHERE sku = '$res_prod->sku' ");
						
					}
				}
		
		}	
		
		}
		
		
		
		function category_update()
		{
			$qr=$this->db->query("SELECT DISTINCT f.lvl2, f.lvl2_name, f.lvl1, f.lvl1_name, f.lvlmain, f.lvlmain_name,c.product_id				
FROM cornjob_productsearch c
INNER JOIN product_category e ON e.product_id = c.product_id
INNER JOIN temp_category f ON f.lvl2 = e.category_id WHERE  c.lvl2=0 AND c.product_id!=0 ");
		
		$row_prod=$qr->result();
		
			foreach($row_prod as $res_prod)
			{
			
				$lvl2_name=addslashes($res_prod->lvl2_name);
				$lvl1_name=addslashes($res_prod->lvl1_name);
				$lvlmain_name=addslashes($res_prod->lvlmain_name);
				
				$this->db->query("update cornjob_productsearch set lvl2='$res_prod->lvl2', lvl2_name='$lvl2_name', lvl1='$res_prod->lvl1', lvl1_name='$lvl1_name' 
				 , lvlmain='$res_prod->lvlmain', lvlmain_name='$lvlmain_name'  WHERE product_id='$res_prod->product_id' ");
			}
			
		}
		
		function cronjobsearch_prodnameimage_update()
		{
			
						
			$qr=$this->db->query("SELECT c.product_id, a.name,b.catelog_img_url
			FROM cornjob_productsearch c INNER JOIN
			product_general_info a ON a.product_id=c.product_id
			INNER JOIN product_image b ON c.product_id = b.product_id  WHERE c.product_id!=0 AND c.name='' AND c.imag='' ");
					
					$row_prod=$qr->result();
					if(count($row_prod)>0)
					{
						foreach($row_prod as $res_prod)
						{
							
							$prod_name=addslashes($res_prod->name);
							$this->db->query("UPDATE cornjob_productsearch SET name='$prod_name' , imag='$res_prod->catelog_img_url' WHERE product_id='$res_prod->product_id'  ");
						}
					}
				
		}
		
		function other_data_update_cronjobproductsearch()
		{
			
				$query_productid=$this->db->query("select sku FROM cornjob_productsearch WHERE sku!='' AND product_id!=0 AND brand='' ") ;	
						
				$row_productid=$query_productid->result();
				if(count($row_productid)>0)
					$prod_sku_array=array();
					foreach($row_productid as $res_productid)
					{
						
							$skr_arr[] = $res_productid->sku;
						
					}
				
				
				$this->update_filtering_attribute_data($skr_arr);
						
		}
		
		
		//--------------------------------------------------------Product Data Update when Edit Product Data Start--------------------------------------------
		
			
			function update_cornjob_product_info()
			{
				$qr_select=$this->db->query("SELECT * FROM  `cornjob_productsearch` WHERE sku IN (SELECT sku FROM cornjob_product_update)" );
				$row=$qr_select->result();
				if(count($row)>0)
				{
						foreach($row as $res_prodinfo)
						{							
							$this->update_cronjobsearch_price_status($res_prodinfo->sku);
							$this->update_cronjobsearch_prodnameimage_update($res_prodinfo->product_id);
							$this->update_other_data_cronjobproductsearch($res_prodinfo->sku);
								
						}
						
						$this->db->query("truncate cornjob_product_update");				
				} // if condition end
			
			}
			
			function update_cornjob_singleproduct_info($product_id,$product_sku)
			{
										
							$this->update_cronjobsearch_price_status($product_sku);
							$this->update_cronjobsearch_prodnameimage_update($product_id);
							$this->update_other_data_cronjobproductsearch($product_sku);
								
					
				$this->db->query("DELETE FROM cornjob_product_update WHERE sku='$product_sku' ");
			}
			
			
			
			
			
		function update_cronjobsearch_price_status($sku_id)
		{
			
				
				$qr=$this->db->query("SELECT c.sku, c.product_id,c.approve_status,c.seller_id,		
				CASE 
				WHEN c.special_price !=0 AND CURDATE() BETWEEN c.special_pric_from_dt AND c.special_pric_to_dt
				THEN c.special_price
				WHEN c.price !=0
				THEN c.price 
				ELSE c.mrp
				END FINAL_PRICE				
		FROM product_master c WHERE c.sku = '$sku_id' ");
				
				$row_prod=$qr->row();
				if($qr->num_rows()>0)
				{					
						
				$this->db->query("update cornjob_productsearch SET prod_status='$row_prod->approve_status' , current_price='$row_prod->FINAL_PRICE' WHERE sku='$sku_id' ");
				
				}	
		}
		
		
		function update_cronjobsearch_prodnameimage_update($productid)
		{
			
						
			$qr=$this->db->query("SELECT a.product_id, a.name,b.catelog_img_url
			FROM product_general_info a INNER JOIN product_image b ON a.product_id = b.product_id  WHERE a.product_id= '$productid' ");
					
					$row_prod=$qr->row();
					if($qr->num_rows()>0)
					{
							$prod_name=addslashes($row_prod->name);
							$this->db->query("UPDATE cornjob_productsearch SET name='$prod_name' , imag='$row_prod->catelog_img_url' WHERE product_id='$productid'  ");
						
					}
				
		}
		
		
		function update_other_data_cronjobproductsearch($sku)
		{
			
				
					$prod_sku_array=array();					
						
					$skr_arr[] = $sku;			
				
				$this->update_filtering_attribute_data($skr_arr);
						
		}
		
			
		
		
			
		//--------------------------------------------------------Product Data Update when Edit Product Data End--------------------------------------------
		

} // class end
	

?>