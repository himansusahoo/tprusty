<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advance_search_exporttoexcel_model extends CI_Model {
	
	function export_selectedproduct()
	{
		$prod_skuids=$this->input->post('chk_product');	
		
		$prdskuids_arr=array();
		$prdskuids_string='';
		
		foreach($prod_skuids as $key=>$val)
		{
			$prdskuids_arr[]="'".$val."'";	
		}
		
		$prdskuids_string=implode(',',$prdskuids_arr);
		
				
		$qr=$this->db->query("SELECT product_id,sku,name,prod_status,imag,b.business_name,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt FROM cornjob_productsearch a 
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id  WHERE a.sku IN ($prdskuids_string)
			GROUP BY sku 
			
			UNION ALL
			
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name,d.business_name, a.approve_status AS prod_status, c.catelog_img_url AS                                       imag, b.mrp, b.price, b.special_price, b.special_pric_from_dt, b.special_pric_to_dt FROM seller_product_master a 
				                       INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
									   INNER JOIN seller_existingproduct_image c ON  c.seller_extproduct_id=a.seller_exist_product_id
									   INNER JOIN  seller_account_information d ON d.seller_id=a.seller_id
									   WHERE b.sku IN ($prdskuids_string) GROUP BY a.master_product_id 
									   
			UNION ALL
			
			
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name,c.business_name, 
			       a.approve_status AS prod_status,b.imag,b.mrp,b.price,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt 
				  FROM seller_product_master a 
				 INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id
				 INNER JOIN  seller_account_information c ON a.seller_id=c.seller_id									    
			     WHERE b.sku IN ($prdskuids_string) GROUP BY a.master_product_id 
					  
			UNION ALL
			
			
			SELECT a.seller_product_id AS product_id, a.sku, a.name,d.business_name, b.product_approve AS prod_status, c.catelog_img_url AS imag
			, e.mrp,e.price,e.special_price asspecial_price, e.price_fr_dt as special_pric_from_dt , e.price_to_dt as special_pric_to_dt
										FROM seller_product_general_info a
										INNER JOIN seller_product_setting b ON a.seller_product_id = b.seller_product_id
										INNER JOIN seller_product_image c ON a.seller_product_id = c.seller_product_id
										INNER JOIN seller_account_information d ON b.seller_id=d.seller_id
										INNER join seller_product_price_info e ON e.seller_product_id=a.seller_product_id
										WHERE a.sku IN ($prdskuids_string) group by a.sku
			");
			
			return $qr;
		
		
		
	}
	
	
	
	function exportselected_advanceproductsearch()
	{
		$limit=0;
		$start=0;
		$product_status=$this->session->userdata('sess_product_status');
		
		$seller_idsrchstring=$this->session->userdata('sess_seller_idsrchstring');
		
		$catg_ids_string=$this->session->userdata('sess_catg_ids_string');
		
	//--------------------product add or modified  date initialize start -----------------//	
		
		$addfromto_date_string=$this->session->userdata('sess_addfromto_date_string');	
		$modffromto_date_string=$this->session->userdata('sess_modffromto_date_string');	
		
		//--------------------product add or modified  date initialize end -----------------//
		
		
		//-----------------------------------Product Price Or Discount Blank or not check start------------------//
		
				$pricefromto_string=$this->session->userdata('sess_pricefromto_string');	
				$discountfromto_string=$this->session->userdata('sess_discountfromto_string');
				
				
		//-----------------------------------Product Price Or Discount Blank or not check start------------------//
		
		
		//--------------------------------------product name or sku filter start---------------------------------------//	
			
				
				$prod_namestirng=$this->session->userdata('sess_prodname_string');	
				$prod_skustring=$this->session->userdata('sess_prodsku_string');
								
				
				$attrbgrouids_string=$this->session->userdata('sess_attrbgrouids_string');	
				$attrbvalueasqlis_string=$this->session->userdata('sess_attrbvalueasqlis_string');
				
		//--------------------------------------product name or sku filter end---------------------------------------//
		
		
		//----------------------------------------- seller Or Buyer Rating Start-------------------------------------------//
			
				
				$sellerratingfromto_string=$this->session->userdata('sess_sellerratingfromto_string');	
				$buyerfromto_string=$this->session->userdata('sess_buyerfromto_string');
				
		
		//----------------------------------------- seller Or Buyer Rating end---------------------------------------------//
		
			
		
		//-------------------------------------- query for attribute value start--------------------------------------------//
		
			if($seller_idsrchstring!='' && $catg_ids_string!='' && $attrbgrouids_string!='' && $attrbvalueasqlis_string!='' && $addfromto_date_string=='' 					 && $modffromto_date_string=='')
			{
						$actualattrb_id=array();
						$actualattrb_value=array();
						
						$actualattrbid_string='';
						$actualattrbvalue_string='';
						
						$qr_attrbvalue=$this->db->query("SELECT * FROM seller_product_attribute_value WHERE id IN ($attrbvalueasqlis_string)");
						
						$last_segment="";
						
						$i_ampersand=1;
						
						foreach($qr_attrbvalue->result_array() as $res_attrbval)
						{	$actualattrb_id[]=$res_attrbval['attr_id'];
							$actualattrb_value[]="'".$res_attrbval['attr_value']."'";
							
							$attrb_idforfldname=$res_attrbval['attr_id'];
							
							$qr_attrbfldname=$this->db->query("SELECT * FROM attribute_real WHERE attribute_id='$attrb_idforfldname' ");
							
							$attrbfieldactual_name=$qr_attrbfldname->row()->attribute_field_name;
							
							$ampersansymbol='';
							if($i_ampersand!=1 )
							{$ampersansymbol='&';}
							
							$last_segment=$last_segment.$ampersansymbol.$res_attrbval['attr_id']."-".$attrbfieldactual_name."=".$res_attrbval['attr_value'];
							
							$i_ampersand++;
						}
						
						
						if(count($actualattrb_id)>0)
						{$actualattrbid_string=implode(',',$actualattrb_id);}
						
						if(count($actualattrb_value)>0)
						{$actualattrbvalue_string=implode(',',$actualattrb_value);}
						
				 $qr=$this->productdata_asattributrvalue($product_status,$seller_idsrchstring,$catg_ids_string,$attrbgrouids_string,$attrbvalueasqlis_string,$actualattrbid_string,$actualattrbvalue_string,$last_segment,$limit,$start,$pricefromto_string,$discountfromto_string,$sellerratingfromto_string,$buyerfromto_string);			
						
					return $qr;
							
				}
				
				
			//---------------------------------------- query for attribute value end-----------------------------------------------//
		
		if($seller_idsrchstring!='' && $catg_ids_string!='' && $attrbgrouids_string!='' && $pricefromto_string!='' && $discountfromto_string=='')
		{
			if($product_status=='Active')
			{
				
			$qr=$this->db->query("SELECT * FROM(
					SELECT a.product_id,sku,name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name,
			CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE
				
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			INNER JOIN product_setting c ON c.product_id=a.product_id 
			WHERE a.lvl2 IN ($catg_ids_string)  and a.sku!='' 
			 AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' 
			 AND c.attribut_set IN ($attrbgrouids_string) AND b.seller_id IN ($seller_idsrchstring)			 
			 GROUP BY sku
			
			) as innerTable
			WHERE ($pricefromto_string) ");	
				
			}
			else
			{
			
			$qr=$this->db->query("SELECT * FROM(
					SELECT a.product_id,sku,name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name,
			CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE				
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			INNER JOIN product_setting c ON c.product_id=a.product_id  
			WHERE a.lvl2 IN ($catg_ids_string) and a.sku!='' 
			AND (a.prod_status='Inactive' OR a.status='Disabled') 
			AND c.attribut_set IN ($attrbgrouids_string) 	
			and b.seller_id IN ($seller_idsrchstring)
			GROUP BY sku			
			) as innerTable
			WHERE ($pricefromto_string) 
			
			UNION ALL
			
			SELECT * FROM(
					SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status, c.catelog_img_url AS                    imag,b.mrp,b.price,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt,d.business_name,
			CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE				
			FROM seller_product_master a 
				                       INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
									   INNER JOIN seller_existingproduct_image c ON  c.seller_extproduct_id=a.seller_exist_product_id
									   INNER JOIN  seller_account_information d ON d.seller_id=b.seller_id
									   INNER JOIN product_setting e ON e.product_id=b.product_id					   
									   WHERE b.lvl2 IN ($catg_ids_string) 
									   AND (b.prod_status='Inactive' OR b.status='Disabled') 
									   AND e.attribut_set IN ($attrbgrouids_string) 
									   AND b.seller_id IN ($seller_idsrchstring)
									   GROUP BY a.master_product_id			
			) as innerTable
			WHERE ($pricefromto_string)
									   
			UNION ALL
			
			SELECT * FROM(
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status,b.imag,b.mrp,b.price,b.special_price,
			b.special_pric_from_dt,b.special_pric_to_dt,c.business_name, 
			CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE	
			
			FROM seller_product_master a 
					  INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id
					  INNER JOIN  seller_account_information c ON b.seller_id=c.seller_id
					  INNER JOIN product_setting d ON d.product_id=b.product_id							  									    
					  WHERE b.lvl2 IN ($catg_ids_string) 
					  AND (b.prod_status='Inactive' OR b.status='Disabled') 
					  AND d.attribut_set IN ($attrbgrouids_string) 
					  AND b.seller_id IN ($seller_idsrchstring)
					  GROUP BY a.master_product_id  ) as innerTable
			WHERE ($pricefromto_string)
					  
			UNION ALL
			
			SELECT * FROM(
			SELECT a.seller_product_id AS product_id, a.sku, a.name, b.product_approve AS prod_status, c.catelog_img_url AS imag,f.business_name,
					e.mrp,e.price,e.special_price as special_price, e.price_fr_dt as special_pric_from_dt , e.price_to_dt as special_pric_to_dt,
					
					CASE 
					WHEN e.special_price !=0 AND CURDATE() BETWEEN e.price_fr_dt AND e.price_to_dt
					THEN e.special_price
					WHEN e.price !=0
					THEN e.price 
					ELSE e.mrp
					END FINAL_PRICE					
										FROM seller_product_general_info a
										INNER JOIN seller_product_setting b ON a.seller_product_id = b.seller_product_id
										INNER JOIN seller_product_image c ON a.seller_product_id = c.seller_product_id
										INNER JOIN seller_product_category d ON b.seller_product_id=d.seller_product_id
										INNER join seller_product_price_info e ON e.seller_product_id=a.seller_product_id
										INNER JOIN seller_account_information f ON f.seller_id=b.seller_id
										WHERE d.category IN ($catg_ids_string) 
										AND (b.product_approve='Pending' OR a.status='Disabled')  
										AND b.attribute_set IN ($attrbgrouids_string) 
										AND b.seller_id IN ($seller_idsrchstring)
										GROUP BY a.sku 	) as innerTable
			WHERE ($pricefromto_string)	
										  
									   
			");
			
			}
			return $qr;	
		}
		
		
		if($seller_idsrchstring!='' && $catg_ids_string!='' && $attrbgrouids_string!='' && $pricefromto_string=='' && $discountfromto_string!='')
		{
			if($product_status=='Active')
			{
				
			$qr=$this->db->query("SELECT * FROM(
					SELECT a.product_id,sku,name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name,
			CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE
				
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			INNER JOIN product_setting c ON c.product_id=a.product_id 
			WHERE a.lvl2 IN ($catg_ids_string)  and a.sku!='' 
			 AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' 
			 AND c.attribut_set IN ($attrbgrouids_string) AND b.seller_id IN ($seller_idsrchstring)			 
			 GROUP BY sku
			
			) as innerTable
			WHERE ($discountfromto_string) ");	
				
			}
			else
			{
			
			$qr=$this->db->query("SELECT * FROM(
					SELECT a.product_id,sku,name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name,
			CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE				
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			INNER JOIN product_setting c ON c.product_id=a.product_id  
			WHERE a.lvl2 IN ($catg_ids_string) and a.sku!='' 
			AND (a.prod_status='Inactive' OR a.status='Disabled') 
			AND c.attribut_set IN ($attrbgrouids_string) 	
			and b.seller_id IN ($seller_idsrchstring)
			GROUP BY sku			
			) as innerTable
			WHERE ($discountfromto_string)  
			
			UNION ALL
			
			SELECT * FROM(
					SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status, c.catelog_img_url AS                    imag,b.mrp,b.price,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt,d.business_name,
			CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE				
			FROM seller_product_master a 
				                       INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
									   INNER JOIN seller_existingproduct_image c ON  c.seller_extproduct_id=a.seller_exist_product_id
									   INNER JOIN  seller_account_information d ON d.seller_id=b.seller_id
									   INNER JOIN product_setting e ON e.product_id=b.product_id					   
									   WHERE b.lvl2 IN ($catg_ids_string) 
									   AND (b.prod_status='Inactive' OR b.status='Disabled') 
									   AND e.attribut_set IN ($attrbgrouids_string) 
									   AND b.seller_id IN ($seller_idsrchstring)
									   GROUP BY a.master_product_id			
			) as innerTable
			WHERE ($discountfromto_string) 
									   
			UNION ALL
			
			SELECT * FROM(
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status,b.imag,b.mrp,b.price,b.special_price,
			b.special_pric_from_dt,b.special_pric_to_dt,c.business_name, 
			CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE	
			
			FROM seller_product_master a 
					  INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id
					  INNER JOIN  seller_account_information c ON b.seller_id=c.seller_id
					  INNER JOIN product_setting d ON d.product_id=b.product_id							  									    
					  WHERE b.lvl2 IN ($catg_ids_string) 
					  AND (b.prod_status='Inactive' OR b.status='Disabled') 
					  AND d.attribut_set IN ($attrbgrouids_string) 
					  AND b.seller_id IN ($seller_idsrchstring)
					  GROUP BY a.master_product_id  ) as innerTable
			WHERE ($discountfromto_string) 
					  
			UNION ALL
			
			SELECT * FROM(
			SELECT a.seller_product_id AS product_id, a.sku, a.name, b.product_approve AS prod_status, c.catelog_img_url AS imag,f.business_name,
					e.mrp,e.price,e.special_price as special_price, e.price_fr_dt as special_pric_from_dt , e.price_to_dt as special_pric_to_dt,
					
					CASE 
					WHEN e.special_price !=0 AND CURDATE() BETWEEN e.price_fr_dt AND e.price_to_dt
					THEN e.special_price
					WHEN e.price !=0
					THEN e.price 
					ELSE e.mrp
					END FINAL_PRICE					
										FROM seller_product_general_info a
										INNER JOIN seller_product_setting b ON a.seller_product_id = b.seller_product_id
										INNER JOIN seller_product_image c ON a.seller_product_id = c.seller_product_id
										INNER JOIN seller_product_category d ON b.seller_product_id=d.seller_product_id
										INNER join seller_product_price_info e ON e.seller_product_id=a.seller_product_id
										INNER JOIN seller_account_information f ON f.seller_id=b.seller_id
										WHERE d.category IN ($catg_ids_string) 
										AND (b.product_approve='Pending' OR a.status='Disabled')  
										AND b.attribute_set IN ($attrbgrouids_string) 
										AND b.seller_id IN ($seller_idsrchstring)
										GROUP BY a.sku 	) as innerTable
			WHERE ($discountfromto_string)	
										  
									   
			");
			
			}
			return $qr;	
		}
		
		
		
		if($seller_idsrchstring!='' && $catg_ids_string!='' && $attrbgrouids_string!='' && $pricefromto_string!='' && $discountfromto_string!='')
		{
			if($product_status=='Active')
			{
				
			$qr=$this->db->query("SELECT * FROM(
					SELECT a.product_id,sku,name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name,
			CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE
				
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			INNER JOIN product_setting c ON c.product_id=a.product_id 
			WHERE a.lvl2 IN ($catg_ids_string)  and a.sku!='' 
			 AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' 
			 AND c.attribut_set IN ($attrbgrouids_string) AND b.seller_id IN ($seller_idsrchstring)			 
			 GROUP BY sku
			
			) as innerTable
			WHERE ($pricefromto_string) AND ($discountfromto_string) ");	
				
			}
			else
			{
			
			$qr=$this->db->query("SELECT * FROM(
					SELECT a.product_id,sku,name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name,
			CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE				
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			INNER JOIN product_setting c ON c.product_id=a.product_id  
			WHERE a.lvl2 IN ($catg_ids_string) and a.sku!='' 
			AND (a.prod_status='Inactive' OR a.status='Disabled') 
			AND c.attribut_set IN ($attrbgrouids_string) 	
			and b.seller_id IN ($seller_idsrchstring)
			GROUP BY sku			
			) as innerTable
			WHERE ($pricefromto_string) AND ($discountfromto_string)
			
			UNION ALL
			
			SELECT * FROM(
					SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status, c.catelog_img_url AS                    imag,b.mrp,b.price,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt,d.business_name,
			CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE				
			FROM seller_product_master a 
				                       INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
									   INNER JOIN seller_existingproduct_image c ON  c.seller_extproduct_id=a.seller_exist_product_id
									   INNER JOIN  seller_account_information d ON d.seller_id=b.seller_id
									   INNER JOIN product_setting e ON e.product_id=b.product_id					   
									   WHERE b.lvl2 IN ($catg_ids_string) 
									   AND (b.prod_status='Inactive' OR b.status='Disabled') 
									   AND e.attribut_set IN ($attrbgrouids_string) 
									   AND b.seller_id IN ($seller_idsrchstring)
									   GROUP BY a.master_product_id			
			) as innerTable
			WHERE ($pricefromto_string) AND ($discountfromto_string)
									   
			UNION ALL
			
			SELECT * FROM(
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status,b.imag,b.mrp,b.price,b.special_price,
			b.special_pric_from_dt,b.special_pric_to_dt,c.business_name, 
			CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE	
			
			FROM seller_product_master a 
					  INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id
					  INNER JOIN  seller_account_information c ON b.seller_id=c.seller_id
					  INNER JOIN product_setting d ON d.product_id=b.product_id							  									    
					  WHERE b.lvl2 IN ($catg_ids_string) 
					  AND (b.prod_status='Inactive' OR b.status='Disabled') 
					  AND d.attribut_set IN ($attrbgrouids_string) 
					  AND b.seller_id IN ($seller_idsrchstring)
					  GROUP BY a.master_product_id  ) as innerTable
			WHERE ($pricefromto_string) AND ($discountfromto_string) 
					  
			UNION ALL
			
			SELECT * FROM(
			SELECT a.seller_product_id AS product_id, a.sku, a.name, b.product_approve AS prod_status, c.catelog_img_url AS imag,f.business_name,
					e.mrp,e.price,e.special_price as special_price, e.price_fr_dt as special_pric_from_dt , e.price_to_dt as special_pric_to_dt,
					
					CASE 
					WHEN e.special_price !=0 AND CURDATE() BETWEEN e.price_fr_dt AND e.price_to_dt
					THEN e.special_price
					WHEN e.price !=0
					THEN e.price 
					ELSE e.mrp
					END FINAL_PRICE					
										FROM seller_product_general_info a
										INNER JOIN seller_product_setting b ON a.seller_product_id = b.seller_product_id
										INNER JOIN seller_product_image c ON a.seller_product_id = c.seller_product_id
										INNER JOIN seller_product_category d ON b.seller_product_id=d.seller_product_id
										INNER join seller_product_price_info e ON e.seller_product_id=a.seller_product_id
										INNER JOIN seller_account_information f ON f.seller_id=b.seller_id
										WHERE d.category IN ($catg_ids_string) 
										AND (b.product_approve='Pending' OR a.status='Disabled')  
										AND b.attribute_set IN ($attrbgrouids_string) 
										AND b.seller_id IN ($seller_idsrchstring)
										GROUP BY a.sku 	) as innerTable
			WHERE ($pricefromto_string) AND ($discountfromto_string)	
										  
									   
			");
			
			}
			return $qr;	
		}
		
		
		if($seller_idsrchstring!='' && $catg_ids_string!='' && $attrbgrouids_string!='' && $sellerratingfromto_string!='' && $buyerfromto_string=='')
		{
			
			if($product_status=='Active')
			{
				$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
				INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
				INNER JOIN review_seller c ON c.seller_id=a.seller_id
				INNER JOIN product_setting d ON d.product_id=a.product_id			
				WHERE  ($sellerratingfromto_string) 
				AND  a.lvl2 IN ($catg_ids_string)
				AND d.attribut_set IN ($attrbgrouids_string) AND b.seller_id IN ($seller_idsrchstring)
				AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' AND sku!='' GROUP BY a.sku  
				 ");	
			return $qr;
			}
			else
			{
				$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
				INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
				INNER JOIN review_seller c ON c.seller_id=a.seller_id			
				WHERE  ($sellerratingfromto_string) AND  a.lvl2 IN ($catg_ids_string)
				AND d.attribut_set IN ($attrbgrouids_string) AND b.seller_id IN ($seller_idsrchstring)			 
				AND a.sku!='' AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY a.sku  
				 ");	
				return $qr;
					
			}
				
		}
		
		
		if($seller_idsrchstring!='' && $catg_ids_string!='' && $attrbgrouids_string!='' && $sellerratingfromto_string=='' && $buyerfromto_string!='')
		{
			
			if($product_status=='Active')
			{
				$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
				INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
				INNER JOIN review_product c ON c.sku_id=a.sku
				INNER JOIN product_setting d ON d.product_id=a.product_id			
				WHERE  ($buyerfromto_string) 
				AND  a.lvl2 IN ($catg_ids_string)
				AND d.attribut_set IN ($attrbgrouids_string) AND b.seller_id IN ($seller_idsrchstring)
				AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' AND sku!='' GROUP BY a.sku  
				");	
			return $qr;
			}
			else
			{
				$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
				INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
				INNER JOIN review_product c ON c.sku_id=a.sku		
				WHERE  ($buyerfromto_string) AND  a.lvl2 IN ($catg_ids_string)
				AND d.attribut_set IN ($attrbgrouids_string) AND b.seller_id IN ($seller_idsrchstring)			 
				AND a.sku!='' AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY a.sku  
				 ");	
				return $qr;
					
			}
				
		}
		
		
		
		if($seller_idsrchstring!='' && $catg_ids_string!='' && $attrbgrouids_string!='' && $addfromto_date_string=='' && $modffromto_date_string=='')
		{
			if($product_status=='Active')
			{
				
			$qr=$this->db->query("SELECT a.product_id,sku,name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			INNER JOIN product_setting c ON c.product_id=a.product_id 
			WHERE a.lvl2 IN ($catg_ids_string)  and a.sku!='' 
			 AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' 
			 AND c.attribut_set IN ($attrbgrouids_string) AND b.seller_id IN ($seller_idsrchstring)			 
			 GROUP BY sku  ");	
				
			}
			else
			{
			
			$qr=$this->db->query("SELECT product_id,sku,name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			INNER JOIN product_setting c ON c.product_id=a.product_id  
			WHERE a.lvl2 IN ($catg_ids_string) and a.sku!='' 
			AND (a.prod_status='Inactive' OR a.status='Disabled') 
			AND c.attribut_set IN ($attrbgrouids_string) 	
			and b.seller_id IN ($seller_idsrchstring)
			GROUP BY sku  
			
			UNION ALL
			
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status, c.catelog_img_url AS                                       imag,b.mrp,b.price,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt,d.business_name
									   FROM seller_product_master a 
				                       INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
									   INNER JOIN seller_existingproduct_image c ON  c.seller_extproduct_id=a.seller_exist_product_id
									   INNER JOIN  seller_account_information d ON d.seller_id=b.seller_id
									   INNER JOIN product_setting e ON e.product_id=b.product_id					   
									   WHERE b.lvl2 IN ($catg_ids_string) 
									   AND (b.prod_status='Inactive' OR b.status='Disabled') 
									   AND e.attribut_set IN ($attrbgrouids_string) 
									   AND b.seller_id IN ($seller_idsrchstring)
									   GROUP BY a.master_product_id 
									   
			UNION ALL
			
			
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status,b.imag,b.mrp,b.price,b.special_price,
			b.special_pric_from_dt,b.special_pric_to_dt,c.business_name FROM seller_product_master a 
					  INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id
					  INNER JOIN  seller_account_information c ON b.seller_id=c.seller_id
					  INNER JOIN product_setting d ON d.product_id=b.product_id							  									    
					  WHERE b.lvl2 IN ($catg_ids_string) 
					  AND (b.prod_status='Inactive' OR b.status='Disabled') 
					  AND d.attribut_set IN ($attrbgrouids_string) 
					  AND b.seller_id IN ($seller_idsrchstring)
					  GROUP BY a.master_product_id  
					  
			UNION ALL
			
			
			SELECT a.seller_product_id AS product_id, a.sku, a.name, b.product_approve AS prod_status, c.catelog_img_url AS imag,f.business_name,
					e.mrp,e.price,e.special_price as special_price, e.price_fr_dt as special_pric_from_dt , e.price_to_dt as special_pric_to_dt
										FROM seller_product_general_info a
										INNER JOIN seller_product_setting b ON a.seller_product_id = b.seller_product_id
										INNER JOIN seller_product_image c ON a.seller_product_id = c.seller_product_id
										INNER JOIN seller_product_category d ON b.seller_product_id=d.seller_product_id
										INNER join seller_product_price_info e ON e.seller_product_id=a.seller_product_id
										INNER JOIN seller_account_information f ON f.seller_id=b.seller_id
										WHERE d.category IN ($catg_ids_string) 
										AND (b.product_approve='Pending' OR a.status='Disabled')  
										AND b.attribute_set IN ($attrbgrouids_string) 
										AND b.seller_id IN ($seller_idsrchstring)
										GROUP BY a.sku 		
										  
									   
			");
			
			}
			return $qr;	
		}
		
		
		
		if($seller_idsrchstring!='' && $catg_ids_string!='' && $pricefromto_string!='' && $discountfromto_string=='')
		{
			if($product_status=='Active')
			{
				
			$qr=$this->db->query("SELECT * FROM(
					SELECT product_id,sku,name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name,
			CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE 
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			WHERE a.lvl2 IN ($catg_ids_string) and b.seller_id IN ($seller_idsrchstring)  and a.sku!='' 
			 AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' GROUP BY sku
			
			) as innerTable
			WHERE ($pricefromto_string) ");	
				
			}
			else
			{
			
			$qr=$this->db->query("SELECT * FROM (
					SELECT product_id,sku,name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name,
			CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE 
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id 
			WHERE a.lvl2 IN ($catg_ids_string) and b.seller_id IN ($seller_idsrchstring) and a.sku!='' 
			AND (a.prod_status='Inactive' OR a.status='Disabled')	GROUP BY sku
			
			) as innerTable
			WHERE ($pricefromto_string)
			
			UNION ALL
			
			SELECT * FROM (
					SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status, c.catelog_img_url AS                  imag,b.mrp,b.price,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt,d.business_name,
			CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE 
			FROM seller_product_master a 
				                       INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
									   INNER JOIN seller_existingproduct_image c ON  c.seller_extproduct_id=a.seller_exist_product_id
									   INNER JOIN  seller_account_information d ON d.seller_id=b.seller_id					   
									   WHERE b.lvl2 IN ($catg_ids_string) and b.seller_id IN ($seller_idsrchstring)
									   AND (b.prod_status='Inactive' OR b.status='Disabled') GROUP BY a.master_product_id
			) as innerTable			
			WHERE ($pricefromto_string)
			
			UNION ALL
			
			
			SELECT * FROM (
					SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status,b.imag,b.mrp,b.price,b.special_price,
			b.special_pric_from_dt,b.special_pric_to_dt,c.business_name,
			CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE 
			FROM seller_product_master a 
					  INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id
					  INNER JOIN  seller_account_information c ON b.seller_id=c.seller_id							  									    
					  WHERE b.lvl2 IN ($catg_ids_string) and b.seller_id IN ($seller_idsrchstring)
					  AND (b.prod_status='Inactive' OR b.status='Disabled') GROUP BY a.master_product_id
			) as innerTable			
			WHERE ($pricefromto_string)
					  
			
			UNION ALL
			
			
			SELECT * FROM (
					 SELECT a.seller_product_id AS product_id, a.sku, a.name, b.product_approve AS prod_status, c.catelog_img_url AS imag,f.business_name,
					e.mrp,e.price,e.special_price as special_price, e.price_fr_dt as special_pric_from_dt , e.price_to_dt as special_pric_to_dt,
				CASE 
				WHEN e.special_price !=0 AND CURDATE() BETWEEN e.price_fr_dt AND e.price_to_dt
				THEN e.special_price
				WHEN e.price !=0
				THEN e.price 
				ELSE e.mrp
				END FINAL_PRICE 
				FROM seller_product_general_info a
										INNER JOIN seller_product_setting b ON a.seller_product_id = b.seller_product_id
										INNER JOIN seller_product_image c ON a.seller_product_id = c.seller_product_id
										INNER JOIN seller_product_category d ON b.seller_product_id=d.seller_product_id
										INNER join seller_product_price_info e ON e.seller_product_id=a.seller_product_id
										INNER JOIN seller_account_information f ON f.seller_id=b.seller_id
										WHERE d.category IN ($catg_ids_string) and b.seller_id IN ($seller_idsrchstring)
										AND (b.product_approve='Pending' OR a.status='Disabled')  GROUP BY a.sku
			) as innerTable			
			WHERE ($pricefromto_string)
									   
			");
			
			}
			return $qr;	
		}
		
		
		if($seller_idsrchstring!='' && $catg_ids_string!='' && $pricefromto_string=='' && $discountfromto_string!='')
		{
			if($product_status=='Active')
			{
				
			$qr=$this->db->query("SELECT * FROM(
					SELECT product_id,sku,name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name,
			CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE 
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			WHERE a.lvl2 IN ($catg_ids_string) and b.seller_id IN ($seller_idsrchstring)  and a.sku!='' 
			 AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' GROUP BY sku
			
			) as innerTable
			WHERE ($discountfromto_string)  ");	
				
			}
			else
			{
			
			$qr=$this->db->query("SELECT * FROM (
					SELECT product_id,sku,name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name,
			CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE 
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id 
			WHERE a.lvl2 IN ($catg_ids_string) and b.seller_id IN ($seller_idsrchstring) and a.sku!='' 
			AND (a.prod_status='Inactive' OR a.status='Disabled')	GROUP BY sku
			
			) as innerTable
			WHERE ($discountfromto_string)
			
			UNION ALL
			
			SELECT * FROM (
					SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status, c.catelog_img_url AS                  imag,b.mrp,b.price,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt,d.business_name,
			CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE 
			FROM seller_product_master a 
				                       INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
									   INNER JOIN seller_existingproduct_image c ON  c.seller_extproduct_id=a.seller_exist_product_id
									   INNER JOIN  seller_account_information d ON d.seller_id=b.seller_id					   
									   WHERE b.lvl2 IN ($catg_ids_string) and b.seller_id IN ($seller_idsrchstring)
									   AND (b.prod_status='Inactive' OR b.status='Disabled') GROUP BY a.master_product_id
			) as innerTable			
			WHERE ($discountfromto_string)
			
			UNION ALL
			
			
			SELECT * FROM (
					SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status,b.imag,b.mrp,b.price,b.special_price,
			b.special_pric_from_dt,b.special_pric_to_dt,c.business_name,
			CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE 
			FROM seller_product_master a 
					  INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id
					  INNER JOIN  seller_account_information c ON b.seller_id=c.seller_id							  									    
					  WHERE b.lvl2 IN ($catg_ids_string) and b.seller_id IN ($seller_idsrchstring)
					  AND (b.prod_status='Inactive' OR b.status='Disabled') GROUP BY a.master_product_id
			) as innerTable			
			WHERE ($discountfromto_string)
					  
			
			UNION ALL
			
			
			SELECT * FROM (
					 SELECT a.seller_product_id AS product_id, a.sku, a.name, b.product_approve AS prod_status, c.catelog_img_url AS imag,f.business_name,
					e.mrp,e.price,e.special_price as special_price, e.price_fr_dt as special_pric_from_dt , e.price_to_dt as special_pric_to_dt,
				CASE 
				WHEN e.special_price !=0 AND CURDATE() BETWEEN e.price_fr_dt AND e.price_to_dt
				THEN e.special_price
				WHEN e.price !=0
				THEN e.price 
				ELSE e.mrp
				END FINAL_PRICE 
				FROM seller_product_general_info a
										INNER JOIN seller_product_setting b ON a.seller_product_id = b.seller_product_id
										INNER JOIN seller_product_image c ON a.seller_product_id = c.seller_product_id
										INNER JOIN seller_product_category d ON b.seller_product_id=d.seller_product_id
										INNER join seller_product_price_info e ON e.seller_product_id=a.seller_product_id
										INNER JOIN seller_account_information f ON f.seller_id=b.seller_id
										WHERE d.category IN ($catg_ids_string) and b.seller_id IN ($seller_idsrchstring)
										AND (b.product_approve='Pending' OR a.status='Disabled')  GROUP BY a.sku
			) as innerTable			
			WHERE ($discountfromto_string)									   
			");
			
			}
			return $qr;	
		}
		
		if($seller_idsrchstring!='' && $catg_ids_string!='' && $pricefromto_string!='' && $discountfromto_string!='')
		{
			if($product_status=='Active')
			{
				
			$qr=$this->db->query("SELECT * FROM(
					SELECT product_id,sku,name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name,
			CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE 
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			WHERE a.lvl2 IN ($catg_ids_string) and b.seller_id IN ($seller_idsrchstring)  and a.sku!='' 
			 AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' GROUP BY sku
			
			) as innerTable
			WHERE ($pricefromto_string) AND ($discountfromto_string) ");	
				
			}
			else
			{
			
			$qr=$this->db->query("SELECT * FROM (
					SELECT product_id,sku,name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name,
			CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE 
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id 
			WHERE a.lvl2 IN ($catg_ids_string) and b.seller_id IN ($seller_idsrchstring) and a.sku!='' 
			AND (a.prod_status='Inactive' OR a.status='Disabled')	GROUP BY sku
			
			) as innerTable
			WHERE ($pricefromto_string) AND ($discountfromto_string)
			
			UNION ALL
			
			SELECT * FROM (
					SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status, c.catelog_img_url AS                  imag,b.mrp,b.price,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt,d.business_name,
			CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE 
			FROM seller_product_master a 
				                       INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
									   INNER JOIN seller_existingproduct_image c ON  c.seller_extproduct_id=a.seller_exist_product_id
									   INNER JOIN  seller_account_information d ON d.seller_id=b.seller_id					   
									   WHERE b.lvl2 IN ($catg_ids_string) and b.seller_id IN ($seller_idsrchstring)
									   AND (b.prod_status='Inactive' OR b.status='Disabled') GROUP BY a.master_product_id
			) as innerTable			
			WHERE ($pricefromto_string) AND ($discountfromto_string) 
			
			UNION ALL
			
			
			SELECT * FROM (
					SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status,b.imag,b.mrp,b.price,b.special_price,
			b.special_pric_from_dt,b.special_pric_to_dt,c.business_name,
			CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE 
			FROM seller_product_master a 
					  INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id
					  INNER JOIN  seller_account_information c ON b.seller_id=c.seller_id							  									    
					  WHERE b.lvl2 IN ($catg_ids_string) and b.seller_id IN ($seller_idsrchstring)
					  AND (b.prod_status='Inactive' OR b.status='Disabled') GROUP BY a.master_product_id
			) as innerTable			
			WHERE ($pricefromto_string) AND ($discountfromto_string)  
					  
			
			UNION ALL
			
			
			SELECT * FROM (
					 SELECT a.seller_product_id AS product_id, a.sku, a.name, b.product_approve AS prod_status, c.catelog_img_url AS imag,f.business_name,
					e.mrp,e.price,e.special_price as special_price, e.price_fr_dt as special_pric_from_dt , e.price_to_dt as special_pric_to_dt,
				CASE 
				WHEN e.special_price !=0 AND CURDATE() BETWEEN e.price_fr_dt AND e.price_to_dt
				THEN e.special_price
				WHEN e.price !=0
				THEN e.price 
				ELSE e.mrp
				END FINAL_PRICE 
				FROM seller_product_general_info a
										INNER JOIN seller_product_setting b ON a.seller_product_id = b.seller_product_id
										INNER JOIN seller_product_image c ON a.seller_product_id = c.seller_product_id
										INNER JOIN seller_product_category d ON b.seller_product_id=d.seller_product_id
										INNER join seller_product_price_info e ON e.seller_product_id=a.seller_product_id
										INNER JOIN seller_account_information f ON f.seller_id=b.seller_id
										WHERE d.category IN ($catg_ids_string) and b.seller_id IN ($seller_idsrchstring)
										AND (b.product_approve='Pending' OR a.status='Disabled')  GROUP BY a.sku
			) as innerTable			
			WHERE ($pricefromto_string) AND ($discountfromto_string)
									   
			");
			
			}
			return $qr;	
		}
		
		
		if($seller_idsrchstring!='' && $catg_ids_string!='' && $sellerratingfromto_string!='' && $buyerfromto_string=='')
		{
			if($product_status=='Active')
			{
				$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
				INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
				INNER JOIN review_seller c ON c.seller_id=a.seller_id			
				WHERE  ($sellerratingfromto_string) AND a.lvl2 IN ($catg_ids_string) AND a.seller_id IN ($seller_idsrchstring) AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' AND sku!='' GROUP BY a.sku 
				");	
			return $qr;
			}
			else
			{
				$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
				INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
				INNER JOIN review_seller c ON c.seller_id=a.seller_id			
				WHERE  ($sellerratingfromto_string) AND a.lvl2 IN ($catg_ids_string) AND a.seller_id IN ($seller_idsrchstring) AND a.sku!='' AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY a.sku 
				");	
				return $qr;
					
			}
			
		}
		
		
		if($seller_idsrchstring!='' && $catg_ids_string!='' && $sellerratingfromto_string=='' && $buyerfromto_string!='')
		{
			
			if($product_status=='Active')
			{
			
					$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
					a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
					INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
					INNER JOIN review_product c ON c.sku_id=a.sku			
					WHERE  ($buyerfromto_string) AND a.lvl2 IN ($catg_ids_string) AND a.seller_id IN ($seller_idsrchstring) AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' AND sku!='' GROUP BY a.sku  
					  ");	
					return $qr;	
			}
			else
			{
				
					$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
					a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
					INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
					INNER JOIN review_product c ON c.sku_id=a.sku			
					WHERE  ($buyerfromto_string) AND a.lvl2 IN ($catg_ids_string) AND a.seller_id IN ($seller_idsrchstring) and a.sku!='' AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY a.sku   
					  ");	
					return $qr;		
			}
		}
		
		
		
		if($seller_idsrchstring!='' && $catg_ids_string!='' && $addfromto_date_string=='' && $modffromto_date_string=='')
		{
			if($product_status=='Active')
			{
				
			$qr=$this->db->query("SELECT product_id,sku,name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id 
			WHERE a.lvl2 IN ($catg_ids_string) and b.seller_id IN ($seller_idsrchstring)  and a.sku!='' 
			 AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' GROUP BY sku  ");	
				
			}
			else
			{
			
			$qr=$this->db->query("SELECT product_id,sku,name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id 
			WHERE a.lvl2 IN ($catg_ids_string) and b.seller_id IN ($seller_idsrchstring) and a.sku!='' 
			AND (a.prod_status='Inactive' OR a.status='Disabled')	GROUP BY sku  
			
			UNION ALL
			
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status, c.catelog_img_url AS                                       imag,b.mrp,b.price,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt,d.business_name
									   FROM seller_product_master a 
				                       INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
									   INNER JOIN seller_existingproduct_image c ON  c.seller_extproduct_id=a.seller_exist_product_id
									   INNER JOIN  seller_account_information d ON d.seller_id=b.seller_id					   
									   WHERE b.lvl2 IN ($catg_ids_string) and b.seller_id IN ($seller_idsrchstring)
									   AND (b.prod_status='Inactive' OR b.status='Disabled') GROUP BY a.master_product_id 
									   
			UNION ALL
			
			
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status,b.imag,b.mrp,b.price,b.special_price,
			b.special_pric_from_dt,b.special_pric_to_dt,c.business_name FROM seller_product_master a 
					  INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id
					  INNER JOIN  seller_account_information c ON b.seller_id=c.seller_id							  									    
					  WHERE b.lvl2 IN ($catg_ids_string) and b.seller_id IN ($seller_idsrchstring)
					  AND (b.prod_status='Inactive' OR b.status='Disabled') GROUP BY a.master_product_id  
					  
			UNION ALL
			
			
			SELECT a.seller_product_id AS product_id, a.sku, a.name, b.product_approve AS prod_status, c.catelog_img_url AS imag,f.business_name,
					e.mrp,e.price,e.special_price asspecial_price, e.price_fr_dt as special_pric_from_dt , e.price_to_dt as special_pric_to_dt
										FROM seller_product_general_info a
										INNER JOIN seller_product_setting b ON a.seller_product_id = b.seller_product_id
										INNER JOIN seller_product_image c ON a.seller_product_id = c.seller_product_id
										INNER JOIN seller_product_category d ON b.seller_product_id=d.seller_product_id
										INNER join seller_product_price_info e ON e.seller_product_id=a.seller_product_id
										INNER JOIN seller_account_information f ON f.seller_id=b.seller_id
										WHERE d.category IN ($catg_ids_string) and b.seller_id IN ($seller_idsrchstring)
										AND (b.product_approve='Pending' OR a.status='Disabled')  GROUP BY a.sku 		
										  
									   
			");
			
			}
			return $qr;	
		}
		
		
		if($seller_idsrchstring!='' && $catg_ids_string=='' && $pricefromto_string!='' && $discountfromto_string=='')
		{
			
			if($product_status=='Active')
			{
						
			$qr=$this->db->query("SELECT * FROM(
					SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,a.status,a.seller_status,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name,b.seller_id,
			CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE 
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			
			) as innerTable
			WHERE ($pricefromto_string) AND seller_id IN ($seller_idsrchstring)
			 AND prod_status='Active' AND status='Enabled' AND seller_status='Active' AND sku!=''	GROUP BY sku ");	
			
				
			}
			else
			{
				
				
				$qr=$this->db->query("SELECT * FROM (
					SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,a.status,a.seller_status,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name,b.seller_id,
			CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE 
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			
			) as innerTable
			WHERE ($pricefromto_string) AND seller_id IN ($seller_idsrchstring)
			 AND (prod_status='Inactive' OR status='Disabled') AND sku!=''	GROUP BY sku 
			
			
			UNION ALL			
			
			SELECT * FROM (
					SELECT a.seller_exist_product_id AS product_id, a.sku, b.name,d.business_name, a.approve_status AS prod_status, c.catelog_img_url AS  imag, b.mrp, b.price, b.special_price, b.special_pric_from_dt, b.special_pric_to_dt,d.seller_id,a.master_product_id,b.status,
			CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE 
			FROM seller_product_master a 
			INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
			INNER JOIN seller_existingproduct_image c ON  c.seller_extproduct_id=a.seller_exist_product_id
			INNER JOIN  seller_account_information d ON d.seller_id=a.seller_id
			) as innerTable
			
			WHERE ($pricefromto_string) AND  seller_id IN ($seller_idsrchstring) AND (prod_status='Inactive' OR status='Disabled') GROUP BY master_product_id 
									   
			UNION ALL
			
			
			SELECT * FROM (
					SELECT a.seller_exist_product_id AS product_id, a.sku, b.name,c.business_name, 
			       a.approve_status AS prod_status,b.imag,b.mrp,b.price,b.special_price,
				   b.special_pric_from_dt,b.special_pric_to_dt,c.seller_id,a.master_product_id,b.status,
			CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE 
				FROM seller_product_master a 
				 INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id
				 INNER JOIN  seller_account_information c ON a.seller_id=c.seller_id									    
			    
			
			) as innerTable
			 WHERE ($pricefromto_string) AND seller_id IN ($seller_idsrchstring) AND (prod_status='Inactive' OR status='Disabled') GROUP BY master_product_id 
					  
			UNION ALL
			
			
			SELECT * FROM (
					SELECT a.seller_product_id AS product_id, a.sku, a.name,d.business_name, b.product_approve AS prod_status, 
					c.catelog_img_url AS imag, e.mrp,e.price,e.special_price asspecial_price,e.price_fr_dt as special_pric_from_dt, 
					e.price_to_dt as special_pric_to_dt,d.seller_id,a.status,a.seller_product_id as master_product_id,
			CASE 
				WHEN e.special_price !=0 AND CURDATE() BETWEEN e.price_fr_dt AND e.price_to_dt
				THEN e.special_price
				WHEN e.price !=0
				THEN e.price 
				ELSE e.mrp
				END FINAL_PRICE 
				FROM seller_product_general_info a
										INNER JOIN seller_product_setting b ON a.seller_product_id = b.seller_product_id
										INNER JOIN seller_product_image c ON a.seller_product_id = c.seller_product_id
										INNER JOIN seller_account_information d ON b.seller_id=d.seller_id
										INNER join seller_product_price_info e ON e.seller_product_id=a.seller_product_id									    
			    
			
			) as innerTable
			 WHERE ($pricefromto_string) AND seller_id IN ($seller_idsrchstring) AND (prod_status='Pending' OR status='Disabled')");	}
			
			return $qr;
				
		
				
		}
		
		if($seller_idsrchstring!='' && $catg_ids_string=='' && $pricefromto_string=='' && $discountfromto_string!='')
		{
			
			if($product_status=='Active')
			{
			
			$qr=$this->db->query("SELECT * FROM(
					SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,a.status,a.seller_status,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name,b.seller_id,
			CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE 
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			
			) as innerTable
			WHERE ($discountfromto_string) AND seller_id IN ($seller_idsrchstring)
			 AND prod_status='Active' AND status='Enabled' AND seller_status='Active' AND sku!='' GROUP BY sku ");	
			
				
			}
			else
			{
				
				
				$qr=$this->db->query("SELECT * FROM (
					SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,a.status,a.seller_status,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name,b.seller_id,
			CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE 
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			
			) as innerTable
			WHERE ($discountfromto_string) AND seller_id IN ($seller_idsrchstring)
			 AND (prod_status='Inactive' OR status='Disabled') AND sku!=''	GROUP BY sku
			
			
			UNION ALL			
			
			SELECT * FROM (
					SELECT a.seller_exist_product_id AS product_id, a.sku, b.name,d.business_name, a.approve_status AS prod_status, c.catelog_img_url AS  imag, b.mrp, b.price, b.special_price, b.special_pric_from_dt, b.special_pric_to_dt,d.seller_id,a.master_product_id,b.status,
			CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE 
			FROM seller_product_master a 
			INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
			INNER JOIN seller_existingproduct_image c ON  c.seller_extproduct_id=a.seller_exist_product_id
			INNER JOIN  seller_account_information d ON d.seller_id=a.seller_id
			) as innerTable
			
			WHERE ($discountfromto_string) AND  seller_id IN ($seller_idsrchstring) AND (prod_status='Inactive' OR status='Disabled') GROUP BY master_product_id 
									   
			UNION ALL
			
			
			SELECT * FROM (
					SELECT a.seller_exist_product_id AS product_id, a.sku, b.name,c.business_name, 
			       a.approve_status AS prod_status,b.imag,b.mrp,b.price,b.special_price,
				   b.special_pric_from_dt,b.special_pric_to_dt,c.seller_id,a.master_product_id,b.status,
			CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE 
				FROM seller_product_master a 
				 INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id
				 INNER JOIN  seller_account_information c ON a.seller_id=c.seller_id									    
			    
			
			) as innerTable
			 WHERE ($discountfromto_string) AND seller_id IN ($seller_idsrchstring) AND (prod_status='Inactive' OR status='Disabled') GROUP BY master_product_id 
					  
			UNION ALL
			
			
			SELECT * FROM (
					SELECT a.seller_product_id AS product_id, a.sku, a.name,d.business_name, b.product_approve AS prod_status, 
					c.catelog_img_url AS imag, e.mrp,e.price,e.special_price asspecial_price,e.price_fr_dt as special_pric_from_dt, 
					e.price_to_dt as special_pric_to_dt,d.seller_id,a.status,a.seller_product_id as master_product_id,
			CASE 
				WHEN e.special_price !=0 AND CURDATE() BETWEEN e.price_fr_dt AND e.price_to_dt

				THEN e.special_price
				WHEN e.price !=0
				THEN e.price 
				ELSE e.mrp
				END FINAL_PRICE 
				FROM seller_product_general_info a
										INNER JOIN seller_product_setting b ON a.seller_product_id = b.seller_product_id
										INNER JOIN seller_product_image c ON a.seller_product_id = c.seller_product_id
										INNER JOIN seller_account_information d ON b.seller_id=d.seller_id
										INNER join seller_product_price_info e ON e.seller_product_id=a.seller_product_id									    
			    
			
			) as innerTable
			 WHERE ($discountfromto_string) AND seller_id IN ($seller_idsrchstring) AND (prod_status='Pending' OR status='Disabled')
									   
			");	}
			
			return $qr;
		}
		
		
		if($seller_idsrchstring!='' && $catg_ids_string=='' && $pricefromto_string!='' && $discountfromto_string!='')
		{
			
			if($product_status=='Active')
			{
			
			$qr=$this->db->query("SELECT * FROM(
					SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,a.status,a.seller_status,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name,b.seller_id,
			CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE 
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			
			) as innerTable
			WHERE ($pricefromto_string) AND ($discountfromto_string) AND seller_id IN ($seller_idsrchstring)
			 AND prod_status='Active' AND status='Enabled' AND seller_status='Active' AND sku!=''	GROUP BY sku ");	
			
				
			}
			else
			{
				
				
				$qr=$this->db->query("SELECT * FROM (
					SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,a.status,a.seller_status,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name,b.seller_id,
			CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE 
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			
			) as innerTable
			WHERE ($pricefromto_string) AND ($discountfromto_string) AND seller_id IN ($seller_idsrchstring)
			 AND (prod_status='Inactive' OR status='Disabled') AND sku!=''	GROUP BY sku 
			
			
			UNION ALL			
			
			SELECT * FROM (
					SELECT a.seller_exist_product_id AS product_id, a.sku, b.name,d.business_name, a.approve_status AS prod_status, c.catelog_img_url AS  imag, b.mrp, b.price, b.special_price, b.special_pric_from_dt, b.special_pric_to_dt,d.seller_id,a.master_product_id,b.status,
			CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE 
			FROM seller_product_master a 
			INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
			INNER JOIN seller_existingproduct_image c ON  c.seller_extproduct_id=a.seller_exist_product_id
			INNER JOIN  seller_account_information d ON d.seller_id=a.seller_id
			) as innerTable
			
			WHERE ($pricefromto_string) AND ($discountfromto_string) AND  seller_id IN ($seller_idsrchstring) AND (prod_status='Inactive' OR status='Disabled') GROUP BY master_product_id
									   
			UNION ALL
			
			
			SELECT * FROM (
					SELECT a.seller_exist_product_id AS product_id, a.sku, b.name,c.business_name, 
			       a.approve_status AS prod_status,b.imag,b.mrp,b.price,b.special_price,
				   b.special_pric_from_dt,b.special_pric_to_dt,c.seller_id,a.master_product_id,b.status,
			CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE 
				FROM seller_product_master a 
				 INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id
				 INNER JOIN  seller_account_information c ON a.seller_id=c.seller_id									    
			    
			
			) as innerTable
			 WHERE ($pricefromto_string) AND ($discountfromto_string) AND seller_id IN ($seller_idsrchstring) AND (prod_status='Inactive' OR status='Disabled') GROUP BY master_product_id
					  
			UNION ALL
			
			
			SELECT * FROM (
					SELECT a.seller_product_id AS product_id, a.sku, a.name,d.business_name, b.product_approve AS prod_status, 
					c.catelog_img_url AS imag, e.mrp,e.price,e.special_price asspecial_price,e.price_fr_dt as special_pric_from_dt, 
					e.price_to_dt as special_pric_to_dt,d.seller_id,a.status,a.seller_product_id as master_product_id,
			CASE 
				WHEN e.special_price !=0 AND CURDATE() BETWEEN e.price_fr_dt AND e.price_to_dt
				THEN e.special_price
				WHEN e.price !=0
				THEN e.price 
				ELSE e.mrp
				END FINAL_PRICE 
				FROM seller_product_general_info a
										INNER JOIN seller_product_setting b ON a.seller_product_id = b.seller_product_id
										INNER JOIN seller_product_image c ON a.seller_product_id = c.seller_product_id
										INNER JOIN seller_account_information d ON b.seller_id=d.seller_id
										INNER join seller_product_price_info e ON e.seller_product_id=a.seller_product_id									    
			    
			
			) as innerTable
			 WHERE ($pricefromto_string) AND ($discountfromto_string) AND seller_id IN ($seller_idsrchstring) AND (prod_status='Pending' OR status='Disabled')	  	  
									   
			");	}
			
			return $qr;
		}
		
		
		
		if($seller_idsrchstring!='' && $catg_ids_string=='' && $sellerratingfromto_string!='' && $buyerfromto_string=='')
		{

			if($product_status=='Active')
			{
				$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
				INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
				INNER JOIN review_seller c ON c.seller_id=a.seller_id			
				WHERE  ($sellerratingfromto_string) AND a.seller_id IN ($seller_idsrchstring) AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' AND sku!='' GROUP BY a.sku  
				");	
			return $qr;
			}
			else
			{
				$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
				INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
				INNER JOIN review_seller c ON c.seller_id=a.seller_id			
				WHERE  ($sellerratingfromto_string) AND a.seller_id IN ($seller_idsrchstring) AND a.sku!='' AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY a.sku  
				");	
				return $qr;
					
			}
		}
		
		
		if($seller_idsrchstring!='' && $catg_ids_string=='' && $sellerratingfromto_string=='' && $buyerfromto_string!='')
		{
			
			if($product_status=='Active')
			{
			
					$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
					a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
					INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
					INNER JOIN review_product c ON c.sku_id=a.sku			
					WHERE  ($buyerfromto_string) AND a.seller_id IN ($seller_idsrchstring) AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' AND sku!='' GROUP BY a.sku  
					");	
					return $qr;	
			}
			else
			{
				
					$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
					a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
					INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
					INNER JOIN review_product c ON c.sku_id=a.sku			
					WHERE  ($buyerfromto_string) AND a.seller_id IN ($seller_idsrchstring) and a.sku!='' AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY a.sku 
					");	
					return $qr;		
			}
		}
		
		
		if($seller_idsrchstring!='' && $catg_ids_string=='' && $sellerratingfromto_string!='' && $buyerfromto_string!='')
		{
			
			if($product_status=='Active')
			{
				$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
				INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
				INNER JOIN review_seller c ON c.seller_id=a.seller_id			
				WHERE  ($sellerratingfromto_string) AND a.seller_id IN ($seller_idsrchstring) AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' AND sku!='' GROUP BY a.sku
							
				UNION ALL 
				
				SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
				INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
				INNER JOIN review_product c ON c.sku_id=a.sku			
				WHERE  ($buyerfromto_string) AND a.seller_id IN ($seller_idsrchstring) AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' AND sku!='' GROUP BY a.sku
				
				  
				");	
				return $qr;	
			}
			else
			{
				$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
				INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
				INNER JOIN review_seller c ON c.seller_id=a.seller_id			
				WHERE  ($sellerratingfromto_string) AND a.seller_id IN ($seller_idsrchstring) and a.sku!='' AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY a.sku
								
				UNION ALL 
				
				SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
				INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
				INNER JOIN review_product c ON c.sku_id=a.sku			
				WHERE  ($buyerfromto_string) AND a.seller_id IN ($seller_idsrchstring) and a.sku!='' AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY a.sku
				 
				  
				");	
				return $qr;	
			
			}
			
		}

		
		
		
		if($seller_idsrchstring!='' && $catg_ids_string=='' && $addfromto_date_string=='' && $modffromto_date_string=='')
		{
			if($product_status=='Active')
			{
				$qr=$this->db->query("SELECT product_id,sku,name,prod_status,imag,b.business_name,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt FROM cornjob_productsearch a 
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id  WHERE b.seller_id IN ($seller_idsrchstring)
			 AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' AND sku!=''
			GROUP BY sku ");	
			
				
			}
			else
			{
			$qr=$this->db->query("SELECT product_id,sku,name,prod_status,imag,b.business_name,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt FROM cornjob_productsearch a 
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id  WHERE b.seller_id IN ($seller_idsrchstring)
			AND (a.prod_status='Inactive' OR a.status='Disabled') AND sku!=''  GROUP BY sku 
			
			UNION ALL
			
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name,d.business_name, a.approve_status AS prod_status, c.catelog_img_url AS                                       imag, b.mrp, b.price, b.special_price, b.special_pric_from_dt, b.special_pric_to_dt FROM seller_product_master a 
				                       INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
									   INNER JOIN seller_existingproduct_image c ON  c.seller_extproduct_id=a.seller_exist_product_id
									   INNER JOIN  seller_account_information d ON d.seller_id=a.seller_id
									   WHERE d.seller_id IN ($seller_idsrchstring) AND (b.prod_status='Inactive' OR b.status='Disabled') GROUP BY a.master_product_id 
									   
			UNION ALL
			
			
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name,c.business_name, 
			       a.approve_status AS prod_status,b.imag,b.mrp,b.price,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt 
				  FROM seller_product_master a 
				 INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id
				 INNER JOIN  seller_account_information c ON a.seller_id=c.seller_id									    
			     WHERE c.seller_id IN ($seller_idsrchstring) AND (b.prod_status='Inactive' OR b.status='Disabled') GROUP BY a.master_product_id 
					  
			UNION ALL
			
			
			SELECT a.seller_product_id AS product_id, a.sku, a.name,d.business_name, b.product_approve AS prod_status, c.catelog_img_url AS imag
			, e.mrp,e.price,e.special_price asspecial_price, e.price_fr_dt as special_pric_from_dt , e.price_to_dt as special_pric_to_dt
										FROM seller_product_general_info a
										INNER JOIN seller_product_setting b ON a.seller_product_id = b.seller_product_id
										INNER JOIN seller_product_image c ON a.seller_product_id = c.seller_product_id
										INNER JOIN seller_account_information d ON b.seller_id=d.seller_id
										INNER join seller_product_price_info e ON e.seller_product_id=a.seller_product_id
										WHERE d.seller_id IN ($seller_idsrchstring) AND (b.product_approve='Pending' OR a.status='Disabled') 		  
									   
			");	
		}
			
			return $qr;
				
		}
			
			//------------------------attrribute value for category without seller name filter start--------------------//
			
			if($seller_idsrchstring=='' && $catg_ids_string!='' && $attrbgrouids_string!='' && $attrbvalueasqlis_string!='' && $addfromto_date_string=='' 					 && $modffromto_date_string=='')
			{
						$actualattrb_id=array();
						$actualattrb_value=array();
						
						$actualattrbid_string='';
						$actualattrbvalue_string='';
						
						$qr_attrbvalue=$this->db->query("SELECT * FROM seller_product_attribute_value WHERE id IN ($attrbvalueasqlis_string)");
						
						$last_segment="";
						
						$i_ampersand=1;
						
						foreach($qr_attrbvalue->result_array() as $res_attrbval)
						{	$actualattrb_id[]=$res_attrbval['attr_id'];
							$actualattrb_value[]="'".$res_attrbval['attr_value']."'";
							
							$attrb_idforfldname=$res_attrbval['attr_id'];
							
							$qr_attrbfldname=$this->db->query("SELECT * FROM attribute_real WHERE attribute_id='$attrb_idforfldname' ");
							
							$attrbfieldactual_name=$qr_attrbfldname->row()->attribute_field_name;
							
							$ampersansymbol='';
							if($i_ampersand!=1 )
							{$ampersansymbol='&';}
							
							$last_segment=$last_segment.$ampersansymbol.$res_attrbval['attr_id']."-".$attrbfieldactual_name."=".$res_attrbval['attr_value'];
							
							$i_ampersand++;
						}
						
						
						if(count($actualattrb_id)>0)
						{$actualattrbid_string=implode(',',$actualattrb_id);}
						
						if(count($actualattrb_value)>0)
						{$actualattrbvalue_string=implode(',',$actualattrb_value);}
						
				 $qr=$this->productdata_asattributrvalue($product_status,$seller_idsrchstring,$catg_ids_string,$attrbgrouids_string,$attrbvalueasqlis_string,$actualattrbid_string,$actualattrbvalue_string,$last_segment,$limit,$start,$pricefromto_string,$discountfromto_string,$sellerratingfromto_string,$buyerfromto_string);			
						
					return $qr;
							
				}
			
			
			//------------------------attrribute value for category without seller name filter start--------------------//
			
		
		//------------------------------query for attribute group start-----------------------------------------//
		
		if($seller_idsrchstring=='' && $catg_ids_string!='' && $attrbgrouids_string!='' && $addfromto_date_string=='' && $modffromto_date_string=='')
		{
			if($product_status=='Active')
			{
				
			$qr=$this->db->query("SELECT a.product_id,sku,name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			INNER JOIN product_setting c ON c.product_id=a.product_id 
			WHERE a.lvl2 IN ($catg_ids_string)  and a.sku!='' 
			 AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' AND c.attribut_set IN ($attrbgrouids_string) GROUP BY sku  ");	
				
			}
			else
			{
			
			$qr=$this->db->query("SELECT product_id,sku,name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			INNER JOIN product_setting c ON c.product_id=a.product_id  
			WHERE a.lvl2 IN ($catg_ids_string) and a.sku!='' 
			AND (a.prod_status='Inactive' OR a.status='Disabled') AND c.attribut_set IN ($attrbgrouids_string) 	GROUP BY sku  
			
			UNION ALL
			
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status, c.catelog_img_url AS                                       imag,b.mrp,b.price,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt,d.business_name
									   FROM seller_product_master a 
				                       INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
									   INNER JOIN seller_existingproduct_image c ON  c.seller_extproduct_id=a.seller_exist_product_id
									   INNER JOIN  seller_account_information d ON d.seller_id=b.seller_id
									   INNER JOIN product_setting e ON e.product_id=b.product_id					   
									   WHERE b.lvl2 IN ($catg_ids_string) 
									   AND (b.prod_status='Inactive' OR b.status='Disabled') 
									   AND e.attribut_set IN ($attrbgrouids_string) GROUP BY a.master_product_id 
									   
			UNION ALL
			
			
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status,b.imag,b.mrp,b.price,b.special_price,
			b.special_pric_from_dt,b.special_pric_to_dt,c.business_name FROM seller_product_master a 
					  INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id
					  INNER JOIN  seller_account_information c ON b.seller_id=c.seller_id
					  INNER JOIN product_setting d ON d.product_id=b.product_id							  									    
					  WHERE b.lvl2 IN ($catg_ids_string) 
					  AND (b.prod_status='Inactive' OR b.status='Disabled') 
					  AND d.attribut_set IN ($attrbgrouids_string) GROUP BY a.master_product_id  
					  
			UNION ALL
			
			
			SELECT a.seller_product_id AS product_id, a.sku, a.name, b.product_approve AS prod_status, c.catelog_img_url AS imag,f.business_name,
					e.mrp,e.price,e.special_price asspecial_price, e.price_fr_dt as special_pric_from_dt , e.price_to_dt as special_pric_to_dt
										FROM seller_product_general_info a
										INNER JOIN seller_product_setting b ON a.seller_product_id = b.seller_product_id
										INNER JOIN seller_product_image c ON a.seller_product_id = c.seller_product_id
										INNER JOIN seller_product_category d ON b.seller_product_id=d.seller_product_id
										INNER join seller_product_price_info e ON e.seller_product_id=a.seller_product_id
										INNER JOIN seller_account_information f ON f.seller_id=b.seller_id
										WHERE d.category IN ($catg_ids_string) 
										AND (b.product_approve='Pending' OR a.status='Disabled')  
										AND b.attribut_set IN ($attrbgrouids_string)GROUP BY a.sku 		
										  
									   
			");
			
			}
			return $qr;	
		}
		
		
		
		
		
		
		//-------------------------------query for attribute group end---------------------------------------------//
		
		
		
		
		if($seller_idsrchstring=='' && $catg_ids_string!='' && $attrbgrouids_string=='' && $addfromto_date_string=='' && $modffromto_date_string=='')
		{
			if($product_status=='Active')
			{
				$qr=$this->db->query("SELECT product_id,sku,name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id 
			 WHERE a.lvl2 IN ($catg_ids_string) and a.sku!=''  AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' 				GROUP BY sku   " );
				
				
			}
			else
			{
			
			$qr=$this->db->query("SELECT product_id,sku,name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id 
			 WHERE a.lvl2 IN ($catg_ids_string) and a.sku!='' AND (a.prod_status='Inactive' OR a.status='Disabled') 	GROUP BY sku  
			
			UNION ALL
			
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status, c.catelog_img_url AS                                       imag,b.mrp,b.price,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt,d.business_name
									   FROM seller_product_master a 
				                       INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
									   INNER JOIN seller_existingproduct_image c ON  c.seller_extproduct_id=a.seller_exist_product_id
									   INNER JOIN  seller_account_information d ON d.seller_id=b.seller_id					   
									   WHERE b.lvl2 IN ($catg_ids_string) AND (b.prod_status='Inactive' OR b.status='Disabled') GROUP BY a.master_product_id 
									   
			UNION ALL
			
			
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status,b.imag,b.mrp,b.price,b.special_price,
			b.special_pric_from_dt,b.special_pric_to_dt,c.business_name FROM seller_product_master a 
					  INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id
					  INNER JOIN  seller_account_information c ON b.seller_id=c.seller_id							  									    
					  WHERE b.lvl2 IN ($catg_ids_string) AND (b.prod_status='Inactive' OR b.status='Disabled') GROUP BY a.master_product_id  
					  
			UNION ALL
			
			
			SELECT a.seller_product_id AS product_id, a.sku, a.name, b.product_approve AS prod_status, c.catelog_img_url AS imag,f.business_name,
					e.mrp,e.price,e.special_price asspecial_price, e.price_fr_dt as special_pric_from_dt , e.price_to_dt as special_pric_to_dt
										FROM seller_product_general_info a
										INNER JOIN seller_product_setting b ON a.seller_product_id = b.seller_product_id
										INNER JOIN seller_product_image c ON a.seller_product_id = c.seller_product_id
										INNER JOIN seller_product_category d ON b.seller_product_id=d.seller_product_id
										INNER join seller_product_price_info e ON e.seller_product_id=a.seller_product_id
										INNER JOIN seller_account_information f ON f.seller_id=b.seller_id
										WHERE d.category IN ($catg_ids_string) AND (b.product_approve='Pending' OR a.status='Disabled') GROUP BY a.sku 		
										  
									   
			");
			
			}
			return $qr;	
		}
		
		
		
		if($addfromto_date_string!='' && $modffromto_date_string!='')
		{
			if($product_status=='Active')
			{  $qr=$this->db->query("SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
				INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id			
				WHERE ($modffromto_date_string) and a.sku!=''   AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' 	GROUP BY a.sku  
				");
				
			}else
			{
			
			$qr=$this->db->query("SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id			
			WHERE ($modffromto_date_string) and a.sku!=''  AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY a.sku  
			
			UNION ALL
			
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status, c.catelog_img_url AS                                       imag,b.mrp,b.price,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt,d.business_name
									   FROM seller_product_master a 
				                       INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
									   INNER JOIN seller_existingproduct_image c ON  c.seller_extproduct_id=a.seller_exist_product_id
									   INNER JOIN  seller_account_information d ON d.seller_id=b.seller_id
									   INNER  JOIN seller_product_general_info e ON e.sku=b.sku
									   INNER JOIN  seller_product_setting f ON e.seller_product_id=f.seller_product_id					   
									   WHERE $addfromto_date_string AND (b.prod_status='Inactive' OR b.status='Disabled') GROUP BY a.master_product_id 
									   
			UNION ALL
			
			
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status,b.imag,b.mrp,b.price,b.special_price,
			b.special_pric_from_dt,b.special_pric_to_dt,c.business_name FROM seller_product_master a 
					  INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id
					  INNER JOIN  seller_account_information c ON b.seller_id=c.seller_id
					  INNER  JOIN seller_product_general_info e ON e.sku=b.sku
					  INNER JOIN  seller_product_setting f ON e.seller_product_id=f.seller_product_id				  									    
					  WHERE $addfromto_date_string AND (b.prod_status='Inactive' OR b.status='Disabled') GROUP BY a.master_product_id  
					  
			UNION ALL
			
			
			SELECT a.seller_product_id AS product_id, a.sku, a.name, b.product_approve AS prod_status, c.catelog_img_url AS imag,f.business_name,
					e.mrp,e.price,e.special_price asspecial_price, e.price_fr_dt as special_pric_from_dt , e.price_to_dt as special_pric_to_dt
										FROM seller_product_general_info a
										INNER JOIN seller_product_setting b ON a.seller_product_id = b.seller_product_id
										INNER JOIN seller_product_image c ON a.seller_product_id = c.seller_product_id
										INNER JOIN seller_product_category d ON b.seller_product_id=d.seller_product_id
										INNER join seller_product_price_info e ON e.seller_product_id=a.seller_product_id
										INNER JOIN seller_account_information f ON f.seller_id=b.seller_id
										WHERE $addfromto_date_string  AND (b.product_approve='Pending' OR a.status='Disabled')  GROUP BY a.sku 		
										  
									   
			");
			
			}
			return $qr;
			
		}
		
		
		
		if($addfromto_date_string!='' && $modffromto_date_string=='')
		{
			if($product_status=='Active')
			{$qr=$this->db->query("SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			INNER  JOIN seller_product_general_info c ON c.sku=a.sku
			INNER JOIN  seller_product_setting d ON d.seller_product_id=c.seller_product_id
			 WHERE ($addfromto_date_string) and a.sku!=''   AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' 	GROUP BY a.sku  ");
			 }
			else
			{
			
			$qr=$this->db->query("SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			INNER  JOIN seller_product_general_info c ON c.sku=a.sku
			INNER JOIN  seller_product_setting d ON d.seller_product_id=c.seller_product_id
			 WHERE ($addfromto_date_string) and a.sku!='' AND (a.prod_status='Inactive' OR a.status='Disabled')	GROUP BY a.sku  
			
			UNION ALL
			
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status, c.catelog_img_url AS                                       imag,b.mrp,b.price,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt,d.business_name
									   FROM seller_product_master a 
				                       INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
									   INNER JOIN seller_existingproduct_image c ON  c.seller_extproduct_id=a.seller_exist_product_id
									   INNER JOIN  seller_account_information d ON d.seller_id=b.seller_id
									   INNER  JOIN seller_product_general_info e ON e.sku=b.sku
									   INNER JOIN  seller_product_setting f ON e.seller_product_id=f.seller_product_id					   
									   WHERE $addfromto_date_string AND (b.prod_status='Inactive' OR b.status='Disabled') GROUP BY a.master_product_id 
									   
			UNION ALL
			
			
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status,b.imag,b.mrp,b.price,b.special_price,
			b.special_pric_from_dt,b.special_pric_to_dt,c.business_name FROM seller_product_master a 
					  INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id
					  INNER JOIN  seller_account_information c ON b.seller_id=c.seller_id
					  INNER  JOIN seller_product_general_info e ON e.sku=b.sku
					  INNER JOIN  seller_product_setting f ON e.seller_product_id=f.seller_product_id				  									    
					  WHERE $addfromto_date_string AND (b.prod_status='Inactive' OR b.status='Disabled') GROUP BY a.master_product_id  
					  
			UNION ALL
			
			
			SELECT a.seller_product_id AS product_id, a.sku, a.name, b.product_approve AS prod_status, c.catelog_img_url AS imag,f.business_name,
					e.mrp,e.price,e.special_price asspecial_price, e.price_fr_dt as special_pric_from_dt , e.price_to_dt as special_pric_to_dt
										FROM seller_product_general_info a
										INNER JOIN seller_product_setting b ON a.seller_product_id = b.seller_product_id
										INNER JOIN seller_product_image c ON a.seller_product_id = c.seller_product_id
										INNER JOIN seller_product_category d ON b.seller_product_id=d.seller_product_id
										INNER join seller_product_price_info e ON e.seller_product_id=a.seller_product_id
										INNER JOIN seller_account_information f ON f.seller_id=b.seller_id
										WHERE $addfromto_date_string AND (b.product_approve='Pending' OR a.status='Disabled')  GROUP BY a.sku 		
										  
									   
			");
			
			}
			return $qr;	
		}
		
		
		if($addfromto_date_string=='' && $modffromto_date_string!='')
		{
			
			if($product_status=='Active')
			{
				$qr=$this->db->query("SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
				INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id			
				WHERE ($modffromto_date_string)  AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' AND sku!=''	GROUP BY a.sku   ");
			}
			else
			{
				$qr=$this->db->query("SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
				INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id			
				WHERE ($modffromto_date_string) and a.sku!='' AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY a.sku   ");	
			}
			 
			 return $qr;
			
		}
		
		
		
		if($pricefromto_string!='' && $discountfromto_string!='')
		{
			if($product_status=='Active')
			{
				
				$qr=$this->db->query("SELECT * FROM(
					SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,a.status,a.seller_status,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name, 
				CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE 
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			
			) as innerTable
			WHERE ($pricefromto_string) and sku!=''   AND prod_status='Active' AND status='Enabled' AND seller_status='Active'  GROUP BY sku
			
			UNION ALL
			
			SELECT * FROM(
					SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,a.status,a.seller_status,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name, 
				CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE 
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			
			) as innerTable
			WHERE ($discountfromto_string) and sku!=''   AND prod_status='Active' AND status='Enabled' AND seller_status='Active' GROUP BY sku	");
			
			
			
			
			
			}
			else
			{
			
			
			
			
			$qr=$this->db->query("SELECT * FROM(
					SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,a.status,a.seller_status,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name, 
			CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE 
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			
			) as innerTable
			WHERE ($pricefromto_string) and sku!=''   AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY sku
			
			UNION ALL
			
			SELECT * FROM(
					SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,a.status,a.seller_status,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name, 
				CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE 
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			
			) as innerTable
			WHERE ($discountfromto_string) and sku!=''   AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY sku 	");
			
			
			
			}
			 return $qr;
				
		}
		
		
		if($pricefromto_string!='' && $discountfromto_string=='')
		{
			
			if($product_status=='Active')
			{
					/*$qr=$this->db->query("SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id			
			WHERE ($pricefromto_string) and a.sku!=''   AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active'  	GROUP BY a.sku   ");	*/
			
			
			$qr=$this->db->query("
					SELECT * FROM(
					SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,a.status,a.seller_status,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name, 
			CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE 
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			
			) as innerTable
			WHERE ($pricefromto_string) and sku!=''   AND prod_status='Active' AND status='Enabled' AND seller_status='Active' GROUP BY sku ");	
				
			}
			else
			{
			
			/*$qr=$this->db->query("SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id			
			WHERE ($pricefromto_string) and a.sku!='' AND (a.prod_status='Inactive' OR a.status='Disabled')	GROUP BY a.sku   ");
			*/
			
			
			$qr=$this->db->query("
					SELECT * FROM(
					SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,a.status,a.seller_status,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name, 
			CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE 
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			
			) as innerTable
			WHERE ($pricefromto_string) and sku!=''   AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY sku  ");	
			
			
			}
			 
			 return $qr;
				
		}
		
		if($pricefromto_string=='' && $discountfromto_string!='')
		{
			if($product_status=='Active')
			{
					/*$qr=$this->db->query("SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id			
			WHERE ($discountfromto_string) and a.sku!='' AND (mrp!=price AND mrp!=special_price) AND status='Enabled' AND seller_status='Active' AND prod_status='Active' AND price!='' AND current_price!='' GROUP BY a.sku   ");
			*/			
			
			$qr=$this->db->query("
					SELECT * FROM(
					SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,a.status,a.seller_status,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name, 
				CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE 
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			
			) as innerTable
			WHERE ($discountfromto_string) and sku!=''   AND prod_status='Active' AND status='Enabled' AND seller_status='Active' GROUP BY sku ");	
					
					
			}
			else
			{
			/*$qr=$this->db->query("SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id			
			WHERE ($discountfromto_string) and a.sku!='' AND (mrp!=price AND mrp!=special_price) AND (a.prod_status='Inactive' OR a.status='Disabled') AND price!='' AND current_price!=''	GROUP BY a.sku   ");*/
			
			$qr=$this->db->query("
					SELECT * FROM(
					SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,a.status,a.seller_status,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name, 
				CASE 
				WHEN a.special_price !=0 AND CURDATE() BETWEEN a.special_pric_from_dt AND a.special_pric_to_dt
				THEN a.special_price
				WHEN a.price !=0
				THEN a.price 
				ELSE a.mrp
				END FINAL_PRICE 
			FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
			
			) as innerTable
			WHERE ($discountfromto_string) and sku!=''   AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY sku ");	
			
			}
			 
			 return $qr;
				
		}
			
		if($prod_namestirng!='' && $prod_skustring!='')
		{
			$qr=$this->db->query("SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id			
			WHERE  ($prod_skustring) OR ($prod_namestirng) GROUP BY a.sku  
			");	
			return $qr;	
		}	
		
		
		if($prod_namestirng!='' && $prod_skustring=='')
		{ //echo $prod_namestirng;exit;
			$qr=$this->db->query("SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id			
			WHERE  $prod_namestirng GROUP BY a.sku  
			");
			
			return $qr;	
		}
		
		if($prod_namestirng=='' && $prod_skustring!='')
		{
			$qr=$this->db->query("SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id			
			WHERE  $prod_skustring GROUP BY a.sku  
			");	
			return $qr;	
		}
		
		
		
		
		//------------------------ seller or buyer rating data access start------------------------------//
		
		
		if($sellerratingfromto_string!='' && $buyerfromto_string!='')
		{
			
			if($product_status=='Active')
			{
				$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
				INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
				INNER JOIN review_seller c ON c.seller_id=a.seller_id			
				WHERE  ($sellerratingfromto_string) AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' AND sku!='' GROUP BY a.sku
				
				UNION ALL 
				
				SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
				INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
				INNER JOIN review_product c ON c.sku_id=a.sku			
				WHERE  ($buyerfromto_string) AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' AND sku!='' GROUP BY a.sku
				  
				");	
				return $qr;	
			}
			else
			{
				$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
				INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
				INNER JOIN review_seller c ON c.seller_id=a.seller_id			
				WHERE  ($sellerratingfromto_string) and a.sku!='' AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY a.sku
				
				UNION ALL 
				
				SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
				INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
				INNER JOIN review_product c ON c.sku_id=a.sku			
				WHERE  ($buyerfromto_string) and a.sku!='' AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY a.sku
				  
				");	
				return $qr;	
			
			}
		}
		
		
		
		
		if($sellerratingfromto_string!='' && $buyerfromto_string=='')
		{ 
			if($product_status=='Active')
			{
				$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
				INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
				INNER JOIN review_seller c ON c.seller_id=a.seller_id			
				WHERE  ($sellerratingfromto_string) AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' AND sku!='' GROUP BY a.sku  
				");	
			return $qr;
			}
			else
			{
				$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
				INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
				INNER JOIN review_seller c ON c.seller_id=a.seller_id			
				WHERE  ($sellerratingfromto_string) AND a.sku!='' AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY a.sku  
				");	
				return $qr;
					
			}
		}
		
		if($sellerratingfromto_string=='' && $buyerfromto_string!='')
		{
			if($product_status=='Active')
			{
			
					$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
					a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
					INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
					INNER JOIN review_product c ON c.sku_id=a.sku			
					WHERE  ($buyerfromto_string) AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' AND sku!='' GROUP BY a.sku  
					");	
					return $qr;	
			}
			else
			{
				
					$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
					a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
					INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
					INNER JOIN review_product c ON c.sku_id=a.sku			
					WHERE  ($buyerfromto_string) and a.sku!='' AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY a.sku   
					");	
					return $qr;		
			}
		}
		
		
		
		//------------------------ seller or buyer rating data access end---------------------------------//
		
			
	} //function end
	
	
	function productdata_asattributrvalue($product_status,$seller_idsrchstring,$catg_ids_string,$attrbgrouids_string,$attrbvalueasqlis_string,$actualattrbid_string,$actualattrbvalue_string,$last_segment,$limit,$start,$pricefromto_string,$discountfromto_string,$sellerratingfromto_string,$buyerfromto_string)
	{ 		
			$catg_id=$catg_ids_string;
		
		if($product_status=='Active')
			{
				$qr=$this->product_attributefilter_as_seller($catg_id,$last_segment,$seller_idsrchstring,$product_status,$limit,$start,$pricefromto_string,$discountfromto_string,$sellerratingfromto_string,$buyerfromto_string);
				
				
			
			}
			else
			{
				
				$qrattrb_check=$this->db->query("				
				SELECT a.product_id FROM cornjob_productsearch a
				INNER JOIN seller_product_attribute_value d ON d.sku=a.sku 
				WHERE a.lvl2 IN ($catg_ids_string)
			 	AND (a.prod_status='Inactive' OR a.status='Disabled') 
				AND (d.attr_id IN ($actualattrbid_string) AND d.attr_value IN ($actualattrbvalue_string) ) GROUP BY a.sku  				
				");
				if($qrattrb_check->num_rows()>0)
				{
					$qr=$this->inactiveproduct_attributefilter_as_seller($catg_id,$last_segment,$seller_idsrchstring,$product_status,$limit,$start,$pricefromto_string,$discountfromto_string,$sellerratingfromto_string,$buyerfromto_string);
				}
				else
				{
					$qr=false;	
				}
				
				
			
			}
			//echo $qr->num_rows();exit;
			return $qr;	
		
				
		
	}
	
	function product_attributefilter_as_seller($catg_id,$last_segmt,$seller_idsrchstring,$product_status,$limit,$start,$pricefromto_string,$discountfromto_string,$sellerratingfromto_string,$buyerfromto_string)
	{
		
		$attrbid_arr=array();

		$attrbactualvalue_arr=array();

		$attrbhedname=array();

		$attrb_param=array();

		//$limit = 1000;

		
		if($seller_idsrchstring!='')
		{$condition = " WHERE b.lvl2 IN (".$catg_id.") AND c.seller_id IN  (".$seller_idsrchstring.") ";}
		else
		{$condition = " WHERE b.lvl2 IN (".$catg_id.") ";}

		if($last_segmt != 'NOT'){

			$mkg_arr = explode('&',$last_segmt);

			foreach($mkg_arr as $key=>$val){

				//arrange value to attribute as index and value as array variable

				$arr1=array();

				$arr1 = preg_split('/=/',$val);

				$attr[] = $arr1[0];

				$vale[] = $arr1[1];

				//if($arr1[0]!='price' || $arr1[0]!='sortbyprice' )

				if(!preg_match('/sortbyprice/',$arr1[0]) || !preg_match('/price/',$arr1[0]))
				{	
						$attrb_param[]=$arr1[0];				

						$attrbid_arr[]=strtok($arr1[0], '-');

						$attrbactualvalue_arr[]=str_replace('%20',' ',$arr1[1]);
				}

			}

			$arr = array_combine($attr,$vale);		

		}else{

			$arr = array();

		}		

		//----------------------------------------------attribute filter code start--------------------------------------------------//

		if(count($attrbactualvalue_arr)>0)
		{
			$attrb_brandvaluearr=array();
			$attrb_brandidarr=array();			

			$otherattrbvalue_arr=array();
			$otherattrbid_arr=array();
			$skuattrb_arrnewstrng='';

			foreach($attrb_param as $keyattrbval=>$attrbval)
			{
					if(strpos($attrbval, 'Brand') || strpos($attrbval, 'BRAND')  || strpos($attrbval, 'brand'))
					{
							$attrb_brandvaluearr[]=$attrbactualvalue_arr[$keyattrbval]; // brand data insert in to array like: sony, samsung
							$attrb_brandidarr[]=$attrbid_arr[$keyattrbval];
					}
					else
					{

							$otherattrbvalue_arr[]=$attrbactualvalue_arr[$keyattrbval]; // Other attribute data except brand insert in to array 
							$otherattrbid_arr[]=$attrbid_arr[$keyattrbval];

					}

			}			

			if(count($attrb_brandvaluearr)>0)
			{
			//--------------------------------------for loop start for brand wise filter-----------------------	

				foreach($attrb_brandvaluearr as $keybrand=>$valbrand)
				{
					$attrbrand_sid=$attrb_brandidarr[$keybrand];
					$attrbrand_svalue=trim($attrb_brandvaluearr[$keybrand]);					

					if($keybrand==0)
					{
						$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");							

						if($skuattrb_query->num_rows()==0)
						{	

							$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");			

						}	
						
							if($skuattrb_query->num_rows()>0)
							{	$skuattrb_arrnewstrng='';

								$skuattrb_arrnew=array();
									foreach($skuattrb_query->result_array() as $res_attrbsku)
									{
										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attrbrand_svalue) && $res_attrbsku['attr_value']!='')
										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);
							}

								
					//---------------------------------********* other attribute with brand filtering with one brand start-*******----------------//

								if(count($otherattrbvalue_arr)>0)
								{							

									foreach($otherattrbvalue_arr as $attrothrbky=>$attrtoherbval)
									{	
											$attrb_othersid=$otherattrbid_arr[$attrothrbky];
											$attr_othersvalue=trim($otherattrbvalue_arr[$attrothrbky]);									

											$skuattrb_arrnew=array();
											

											$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");
			

										if($skuattrb_query->num_rows()==0)
										{ 
											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");					

										}


										if($skuattrb_query->num_rows()>0)
										{	//$skuattrb_arrnewstrng='';

											foreach($skuattrb_query->result_array() as $res_attrbsku)
											{
												if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_othersvalue) && $res_attrbsku['attr_value']!='')
												{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

											}

											$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

										}


									} // other attribute forloop end

								} 

								
					//-------------------------------******other attribute with brand filtering with one brand end********** -----------------------//		
	

								$skuattrb_arrnew=array();

								if($skuattrb_arrnewstrng!='')

								{ $condition .=" AND b.sku IN ($skuattrb_arrnewstrng) ";}				


								}
					else
					{

									$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");	

							if($skuattrb_query->num_rows()==0)
							{

							$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");

							}
								if($skuattrb_query->num_rows()>0)
								{	$skuattrb_arrnewstrng='';

									foreach($skuattrb_query->result_array() as $res_attrbsku)
									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attrbrand_svalue) && $res_attrbsku['attr_value']!='')
										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}	

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

								}
						//---------------------------------********* other attribute with brand filtering with multiple brand start-*******----------------//

								if(count($otherattrbvalue_arr)>0)
								{	

									foreach($otherattrbvalue_arr as $attrothrbky=>$attrtoherbval)
									{								
											$attrb_othersid=$otherattrbid_arr[$attrothrbky];
											$attr_othersvalue=trim($otherattrbvalue_arr[$attrothrbky]);										

											$skuattrb_arrnew=array();	
										

										$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'   ");										

										if($skuattrb_query->num_rows()==0)
										{

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");		

										}					

										if($skuattrb_query->num_rows()>0)
										{	$skuattrb_arrnewstrng='';

											foreach($skuattrb_query->result_array() as $res_attrbsku)
											{

											if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_othersvalue) && $res_attrbsku['attr_value']!='')											{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

											
											}

											$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);
										}


									} // other attribute forloop end

								}


					//-------------------------------******other attribute with brand filtering with multiple brand end********** -----------------------//


									$skuattrb_arrnew=array();

						}

						if($skuattrb_arrnewstrng!='')

					{$condition .=" OR b.sku IN ($skuattrb_arrnewstrng) ";}

					} 


			//--------------------------------------for loop end for brand wise filter---------------------------------------------------//


			} // other attribut check if condition else part start

			else
			{	
				foreach($attrbactualvalue_arr as $attrbky=>$attrbval)
				{				

					$attrb_sid=$attrbid_arr[$attrbky];
					$attr_svalue=trim($attrbactualvalue_arr[$attrbky]);

				//--------------------------- if attribute value count condition start-------------------------------------//					

						if($attrbky==0)
						{

							$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND b.lvl2 IN ($catg_id) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");		


							if($skuattrb_query->num_rows()==0)
							{
											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");		

							}			

							if($skuattrb_query->num_rows()>0)
							{	$skuattrb_arrnewstrng='';	

									foreach($skuattrb_query->result_array() as $res_attrbsku)
									{
										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

									}
									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

							}
									$skuattrb_arrnew=array();

						} // if attrbkey is zero end

						else
						{

							$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  AND b.lvl2 IN ($catg_id)   ");
							

								if($skuattrb_query->num_rows()==0)
								{
											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active'  ");		

								}		

								if($skuattrb_query->num_rows()>0)
								{	$skuattrb_arrnewstrng='';

									foreach($skuattrb_query->result_array() as $res_attrbsku)	
									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_svalue) && $res_attrbsku['attr_value']!='')
										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

								}								

									$skuattrb_arrnew=array();

						}	
								if($skuattrb_arrnewstrng!='')

									{$condition .=" AND b.sku IN ($skuattrb_arrnewstrng) ";}

						

				//--------------------------- if attribute value count condition end-----------------------------------//
	

				} // $attrbactualvalue_arr for loop end 

				
			} // Other attribute check if condition end

		} // $attrbactualvalue_arr count check main if condition end

		

	   //----------------------------------------------attribute filter code end----------------------------------------------------//

			$attrbidarrunique=array_unique($attrbid_arr);

			
				/*$query=$this->db->query("SELECT b.product_id,b.sku,b.name,b.prod_status,b.imag,b.mrp,b.price,b.special_price,
				b.special_pric_from_dt,b.special_pric_to_dt,c.business_name FROM  cornjob_productsearch b 
				INNER JOIN seller_account_information c ON b.seller_id=c.seller_id
				 $condition AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by b.product_id DESC  ");
				 */
				 
				 	 if($pricefromto_string=='' && $discountfromto_string=='' && $sellerratingfromto_string=='' && $buyerfromto_string=='')
			{	$query=$this->db->query("SELECT b.product_id,b.sku,b.name,b.prod_status,b.imag,b.mrp,b.price,b.special_price,
				b.special_pric_from_dt,b.special_pric_to_dt,c.business_name FROM  cornjob_productsearch b 
				INNER JOIN seller_account_information c ON b.seller_id=c.seller_id
				 $condition AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku  DESC ");
				 
				 return $query;
				 }
				 
			
			
				
			//-------------------------******************************---------------------------------------------//
			else if($pricefromto_string!='' && $discountfromto_string=='' && $sellerratingfromto_string!='' && $buyerfromto_string=='')	
			{
				$query=$this->db->query("
				SELECT * FROM(
				SELECT b.product_id,b.sku,b.name,b.prod_status,b.imag,b.mrp,b.price,b.special_price,
				b.special_pric_from_dt,b.special_pric_to_dt,c.business_name, 
				CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE
				
				FROM  cornjob_productsearch b 
				INNER JOIN seller_account_information c ON b.seller_id=c.seller_id
				INNER JOIN review_seller d ON d.seller_id=b.seller_id
				 $condition  AND ($sellerratingfromto_string)
				 AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by b.product_id DESC 
				 )as innerTable
			WHERE ($pricefromto_string) ");		
			
			return $query;
			}
			
			else if($pricefromto_string=='' && $discountfromto_string!='' && $sellerratingfromto_string!='' && $buyerfromto_string=='')	
			{
				$query=$this->db->query("
				SELECT * FROM(
				SELECT b.product_id,b.sku,b.name,b.prod_status,b.imag,b.mrp,b.price,b.special_price,
				b.special_pric_from_dt,b.special_pric_to_dt,c.business_name, 
				CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE
				
				FROM  cornjob_productsearch b 
				INNER JOIN seller_account_information c ON b.seller_id=c.seller_id
				INNER JOIN review_seller d ON d.seller_id=b.seller_id
				 $condition AND ($sellerratingfromto_string) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by b.product_id DESC 
				 )as innerTable
			WHERE ($discountfromto_string) ");
			
			return $query;
			}
			
			
			else if($pricefromto_string!='' && $discountfromto_string=='' && $sellerratingfromto_string=='' && $buyerfromto_string!='')	
			{
				$query=$this->db->query("
				SELECT * FROM(
				SELECT b.product_id,b.sku,b.name,b.prod_status,b.imag,b.mrp,b.price,b.special_price,
				b.special_pric_from_dt,b.special_pric_to_dt,c.business_name, 
				CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE
				
				FROM  cornjob_productsearch b 
				INNER JOIN seller_account_information c ON b.seller_id=c.seller_id
				INNER JOIN review_product d ON d.sku_id=b.sku
				$condition AND ($buyerfromto_string) 
				 AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by b.product_id DESC 
				 )as innerTable
			WHERE ($pricefromto_string) ");	
			
			return $query;
			}
			
			
			else if($pricefromto_string=='' && $discountfromto_string!='' && $sellerratingfromto_string=='' && $buyerfromto_string!='')	
			{
				$query=$this->db->query("
				SELECT * FROM(
				SELECT b.product_id,b.sku,b.name,b.prod_status,b.imag,b.mrp,b.price,b.special_price,
				b.special_pric_from_dt,b.special_pric_to_dt,c.business_name, 
				CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE
				
				FROM  cornjob_productsearch b 
				INNER JOIN seller_account_information c ON b.seller_id=c.seller_id
				INNER JOIN review_product d ON d.sku_id=b.sku
				 $condition AND ($buyerfromto_string) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by b.product_id DESC 
				 )as innerTable
			WHERE ($discountfromto_string) ");

			return $query;	
			}
			
			else if($pricefromto_string!='' && $discountfromto_string!='' && $sellerratingfromto_string!='' && $buyerfromto_string=='')	
			{
				$query=$this->db->query("
				SELECT * FROM(
				SELECT b.product_id,b.sku,b.name,b.prod_status,b.imag,b.mrp,b.price,b.special_price,
				b.special_pric_from_dt,b.special_pric_to_dt,c.business_name, 
				CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE
				
				FROM  cornjob_productsearch b 
				INNER JOIN seller_account_information c ON b.seller_id=c.seller_id
				INNER JOIN review_seller d ON d.seller_id=b.seller_id
				 $condition AND ($sellerratingfromto_string) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by b.product_id DESC 
				 )as innerTable
			WHERE ($pricefromto_string) AND ($discountfromto_string)  ");
			
			return $query;
			}
			
			else if($pricefromto_string!='' && $discountfromto_string!='' && $sellerratingfromto_string=='' && $buyerfromto_string!='')	
			{
				$query=$this->db->query("
				SELECT * FROM(
				SELECT b.product_id,b.sku,b.name,b.prod_status,b.imag,b.mrp,b.price,b.special_price,
				b.special_pric_from_dt,b.special_pric_to_dt,c.business_name, 
				CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE
				
				FROM  cornjob_productsearch b 
				INNER JOIN seller_account_information c ON b.seller_id=c.seller_id
				INNER JOIN review_product d ON d.sku_id=b.sku
				 $condition AND ($buyerfromto_string) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by b.product_id DESC 
				 )as innerTable
			WHERE ($pricefromto_string) AND ($discountfromto_string)  ");
			
			return $query;
			}
			
	//-------------------------******************************---------------------------------------------//
				 
			if($pricefromto_string=='' && $discountfromto_string=='' && $sellerratingfromto_string!='' && $buyerfromto_string=='')
			{
				$query=$this->db->query("SELECT b.product_id,b.sku,b.name,b.prod_status,b.imag,b.mrp,b.price,b.special_price,
				b.special_pric_from_dt,b.special_pric_to_dt,c.business_name FROM  cornjob_productsearch b 
				INNER JOIN seller_account_information c ON b.seller_id=c.seller_id
				INNER JOIN review_seller d ON d.seller_id=b.seller_id
				$condition AND ($sellerratingfromto_string) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by b.product_id DESC ");	
			
			return $query;
			}
			
			if($pricefromto_string=='' && $discountfromto_string=='' && $sellerratingfromto_string=='' && $buyerfromto_string!='')
			{
				$query=$this->db->query("SELECT b.product_id,b.sku,b.name,b.prod_status,b.imag,b.mrp,b.price,b.special_price,
				b.special_pric_from_dt,b.special_pric_to_dt,c.business_name FROM  cornjob_productsearch b 
				INNER JOIN seller_account_information c ON b.seller_id=c.seller_id
				INNER JOIN review_product d ON d.sku_id=b.sku
				$condition AND ($buyerfromto_string) AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by b.product_id DESC ");	
			
			return $query;
			}		 
				 
			else if($pricefromto_string!='' && $discountfromto_string=='')
			{
					
				$query=$this->db->query("
				SELECT * FROM(
				SELECT b.product_id,b.sku,b.name,b.prod_status,b.imag,b.mrp,b.price,b.special_price,
				b.special_pric_from_dt,b.special_pric_to_dt,c.business_name, 
				CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE
				
				FROM  cornjob_productsearch b 
				INNER JOIN seller_account_information c ON b.seller_id=c.seller_id
				 $condition AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku  
				 )as innerTable
			WHERE ($pricefromto_string) ");
			
			return $query;
			}
			
			
			else if($pricefromto_string=='' && $discountfromto_string!='')
			{
					
				$query=$this->db->query("
				SELECT * FROM(
				SELECT b.product_id,b.sku,b.name,b.prod_status,b.imag,b.mrp,b.price,b.special_price,
				b.special_pric_from_dt,b.special_pric_to_dt,c.business_name, 
				CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE
				
				FROM  cornjob_productsearch b 
				INNER JOIN seller_account_information c ON b.seller_id=c.seller_id
				 $condition AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku  
				 )as innerTable
			WHERE ($discountfromto_string) ");
			
			return $query;
			}
			
			
			
			else if($pricefromto_string!='' && $discountfromto_string!='')
			{
					
				$query=$this->db->query("
				SELECT * FROM(
				SELECT b.product_id,b.sku,b.name,b.prod_status,b.imag,b.mrp,b.price,b.special_price,
				b.special_pric_from_dt,b.special_pric_to_dt,c.business_name, 
				CASE 
				WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
				THEN b.special_price
				WHEN b.price !=0
				THEN b.price 
				ELSE b.mrp
				END FINAL_PRICE
				
				FROM  cornjob_productsearch b 
				INNER JOIN seller_account_information c ON b.seller_id=c.seller_id
				 $condition AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku  
				 )as innerTable
			WHERE ($pricefromto_string) AND ($discountfromto_string) ");
			
			
			}		 	 
			
			

		return $query;

	}
	
	
	
	
	function inactiveproduct_attributefilter_as_seller($catg_id,$last_segmt,$seller_idsrchstring,$product_status,$limit,$start,$pricefromto_string,$discountfromto_string,$sellerratingfromto_string,$buyerfromto_string)
	{
			
		
		
		$attrbid_arr=array();

		$attrbactualvalue_arr=array();

		$attrbhedname=array();

		$attrb_param=array();

		//$limit = 1000;

		if($seller_idsrchstring!='')
		{$condition = " WHERE b.lvl2 IN (".$catg_id.") AND c.seller_id IN  (".$seller_idsrchstring.") ";}
		else
		{$condition = " WHERE b.lvl2 IN (".$catg_id.") ";}

		if($last_segmt != 'NOT'){

			$mkg_arr = explode('&',$last_segmt);

			foreach($mkg_arr as $key=>$val){

				//arrange value to attribute as index and value as array variable

				$arr1=array();

				$arr1 = preg_split('/=/',$val);

				$attr[] = $arr1[0];

				$vale[] = $arr1[1];

				//if($arr1[0]!='price' || $arr1[0]!='sortbyprice' )

				if(!preg_match('/sortbyprice/',$arr1[0]) || !preg_match('/price/',$arr1[0]))
				{	
						$attrb_param[]=$arr1[0];				

						$attrbid_arr[]=strtok($arr1[0], '-');

						$attrbactualvalue_arr[]=str_replace('%20',' ',$arr1[1]);
				}

			}

			$arr = array_combine($attr,$vale);		

		}else{

			$arr = array();

		}		

		//----------------------------------------------attribute filter code start--------------------------------------------------//

		if(count($attrbactualvalue_arr)>0)
		{
			$attrb_brandvaluearr=array();
			$attrb_brandidarr=array();			

			$otherattrbvalue_arr=array();
			$otherattrbid_arr=array();
			$skuattrb_arrnewstrng='';

			foreach($attrb_param as $keyattrbval=>$attrbval)
			{
					if(strpos($attrbval, 'Brand') || strpos($attrbval, 'BRAND')  || strpos($attrbval, 'brand'))
					{
							$attrb_brandvaluearr[]=$attrbactualvalue_arr[$keyattrbval]; // brand data insert in to array like: sony, samsung
							$attrb_brandidarr[]=$attrbid_arr[$keyattrbval];
					}
					else
					{

							$otherattrbvalue_arr[]=$attrbactualvalue_arr[$keyattrbval]; // Other attribute data except brand insert in to array 
							$otherattrbid_arr[]=$attrbid_arr[$keyattrbval];

					}

			}			

			if(count($attrb_brandvaluearr)>0)
			{
			//--------------------------------------for loop start for brand wise filter-----------------------	

				foreach($attrb_brandvaluearr as $keybrand=>$valbrand)
				{
					$attrbrand_sid=$attrb_brandidarr[$keybrand];
					$attrbrand_svalue=trim($attrb_brandvaluearr[$keybrand]);					

					if($keybrand==0)
					{
						$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id) AND (b.prod_status='Inactive' OR b.status='Disabled')  ");							

						if($skuattrb_query->num_rows()==0)
						{	

							$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id)AND b.prod_status='Active' AND (b.prod_status='Inactive' OR b.status='Disabled')  ");			

						}	
						
							if($skuattrb_query->num_rows()>0)
							{	$skuattrb_arrnewstrng='';

								$skuattrb_arrnew=array();
									foreach($skuattrb_query->result_array() as $res_attrbsku)
									{
										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attrbrand_svalue) && $res_attrbsku['attr_value']!='')
										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);
							}

								
					//---------------------------------********* other attribute with brand filtering with one brand start-*******----------------//

								if(count($otherattrbvalue_arr)>0)
								{							

									foreach($otherattrbvalue_arr as $attrothrbky=>$attrtoherbval)
									{	
											$attrb_othersid=$otherattrbid_arr[$attrothrbky];
											$attr_othersvalue=trim($otherattrbvalue_arr[$attrothrbky]);									

											$skuattrb_arrnew=array();
											

											$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id) AND (b.prod_status='Inactive' OR b.status='Disabled')  ");
			

										if($skuattrb_query->num_rows()==0)
										{ 
											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id) AND (b.prod_status='Inactive' OR b.status='Disabled')  ");					

										}


										if($skuattrb_query->num_rows()>0)
										{	//$skuattrb_arrnewstrng='';

											foreach($skuattrb_query->result_array() as $res_attrbsku)
											{
												if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_othersvalue) && $res_attrbsku['attr_value']!='')
												{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

											}

											$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

										}


									} // other attribute forloop end

								} 

								
					//-------------------------------******other attribute with brand filtering with one brand end********** -----------------------//		
	

								$skuattrb_arrnew=array();

								if($skuattrb_arrnewstrng!='')

								{ $condition .=" AND b.sku IN ($skuattrb_arrnewstrng) ";}				


								}
					else
					{

									$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id) (b.prod_status='Inactive' OR b.status='Disabled')  ");	

							if($skuattrb_query->num_rows()==0)
							{

							$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrbrand_sid' AND a.attr_value LIKE '%$attrbrand_svalue%' AND b.lvl2 IN ($catg_id) AND (b.prod_status='Inactive' OR b.status='Disabled')  ");

							}
								if($skuattrb_query->num_rows()>0)
								{	$skuattrb_arrnewstrng='';

									foreach($skuattrb_query->result_array() as $res_attrbsku)
									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attrbrand_svalue) && $res_attrbsku['attr_value']!='')
										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}	

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

								}
						//---------------------------------********* other attribute with brand filtering with multiple brand start-*******----------------//

								if(count($otherattrbvalue_arr)>0)
								{	

									foreach($otherattrbvalue_arr as $attrothrbky=>$attrtoherbval)
									{								
											$attrb_othersid=$otherattrbid_arr[$attrothrbky];
											$attr_othersvalue=trim($otherattrbvalue_arr[$attrothrbky]);										

											$skuattrb_arrnew=array();	
										

										$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id) AND (b.prod_status='Inactive' OR b.status='Disabled')  ");										

										if($skuattrb_query->num_rows()==0)
										{

											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_othersid' AND a.attr_value LIKE '%$attr_othersvalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id)AND    (b.prod_status='Inactive' OR b.status='Disabled')  ");		

										}					

										if($skuattrb_query->num_rows()>0)
										{	$skuattrb_arrnewstrng='';

											foreach($skuattrb_query->result_array() as $res_attrbsku)
											{

											if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_othersvalue) && $res_attrbsku['attr_value']!='')											{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

											
											}

											$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);
										}


									} // other attribute forloop end

								}


					//-------------------------------******other attribute with brand filtering with multiple brand end********** -----------------------//


									$skuattrb_arrnew=array();

						}

						if($skuattrb_arrnewstrng!='')

					{$condition .=" OR b.sku IN ($skuattrb_arrnewstrng) ";}

					} 


			//--------------------------------------for loop end for brand wise filter---------------------------------------------------//


			} // other attribut check if condition else part start

			else
			{	
				foreach($attrbactualvalue_arr as $attrbky=>$attrbval)
				{				

					$attrb_sid=$attrbid_arr[$attrbky];
					$attr_svalue=trim($attrbactualvalue_arr[$attrbky]);

				//--------------------------- if attribute value count condition start-------------------------------------//					

						if($attrbky==0)
						{

							$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND b.lvl2 IN ($catg_id) AND (b.prod_status='Inactive' OR b.status='Disabled')  ");		


							if($skuattrb_query->num_rows()==0)
							{
											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND b.lvl2 IN ($catg_id) AND (b.prod_status='Inactive' OR b.status='Disabled')  ");		

							}			

							if($skuattrb_query->num_rows()>0)
							{	$skuattrb_arrnewstrng='';	

									foreach($skuattrb_query->result_array() as $res_attrbsku)
									{
										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_svalue) && $res_attrbsku['attr_value']!='')

										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

									}
									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

							}
									$skuattrb_arrnew=array();

						} // if attrbkey is zero end

						else
						{

							$skuattrb_query=$this->db->query("SELECT a.* FROM seller_product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND (b.prod_status='Inactive' OR b.status='Disabled')  AND b.lvl2 IN ($catg_id)   ");
							

								if($skuattrb_query->num_rows()==0)
								{
											$skuattrb_query=$this->db->query("SELECT a.* FROM product_attribute_value a INNER JOIN cornjob_productsearch b ON a.sku=b.sku WHERE a.attr_id='$attrb_sid' AND a.attr_value LIKE '%$attr_svalue%' AND a.sku IN ($skuattrb_arrnewstrng) AND b.lvl2 IN ($catg_id)AND (b.prod_status='Inactive' OR b.status='Disabled')  ");		

								}		

								if($skuattrb_query->num_rows()>0)
								{	$skuattrb_arrnewstrng='';

									foreach($skuattrb_query->result_array() as $res_attrbsku)	
									{

										if(strtolower(trim($res_attrbsku['attr_value']))==strtolower($attr_svalue) && $res_attrbsku['attr_value']!='')
										{$skuattrb_arrnew[]="'".$res_attrbsku['sku']."'";}										

									}

									$skuattrb_arrnewstrng=implode(',',$skuattrb_arrnew);

								}								

									$skuattrb_arrnew=array();

						}	
								if($skuattrb_arrnewstrng!='')

									{$condition .=" AND b.sku IN ($skuattrb_arrnewstrng) ";}

						

				//--------------------------- if attribute value count condition end-----------------------------------//
	

				} // $attrbactualvalue_arr for loop end 

				
			} // Other attribute check if condition end

		} // $attrbactualvalue_arr count check main if condition end

		

	   //----------------------------------------------attribute filter code end----------------------------------------------------//

			$attrbidarrunique=array_unique($attrbid_arr);

					
					if($pricefromto_string=='' && $discountfromto_string=='' && $sellerratingfromto_string=='' && $buyerfromto_string=='')	
				{	$query=$this->db->query("SELECT b.product_id,b.sku,b.name,b.prod_status,b.imag,b.mrp,b.price,b.special_price,
					b.special_pric_from_dt,b.special_pric_to_dt,c.business_name FROM cornjob_productsearch b
					INNER  JOIN seller_account_information c ON b.seller_id=c.seller_id					
					$condition 					
					AND (b.prod_status='Inactive' OR b.status='Disabled')					
					GROUP BY b.sku  LIMIT ".$start.", ".$limit."
					
					UNION ALL
					
					SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status, d.catelog_img_url AS                                       imag,b.mrp,b.price,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt,c.business_name
											   FROM seller_product_master a 
											   INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
											   INNER JOIN seller_existingproduct_image d ON  d.seller_extproduct_id=a.seller_exist_product_id
											   INNER JOIN  seller_account_information c ON c.seller_id=b.seller_id
											   $condition										   
											   AND (b.prod_status='Inactive' OR b.status='Disabled') 											   
											   
											   GROUP BY a.master_product_id
										   
					");
					
				}
				
				else if($pricefromto_string=='' && $discountfromto_string=='' && $sellerratingfromto_string!='' && $buyerfromto_string=='')	
				{	$query=$this->db->query("SELECT b.product_id,b.sku,b.name,b.prod_status,b.imag,b.mrp,b.price,b.special_price,
					b.special_pric_from_dt,b.special_pric_to_dt,c.business_name FROM cornjob_productsearch b
					INNER  JOIN seller_account_information c ON b.seller_id=c.seller_id
					INNER JOIN review_seller d ON d.seller_id=b.seller_id					
					$condition 	AND ($sellerratingfromto_string)				
					AND (b.prod_status='Inactive' OR b.status='Disabled')					
					GROUP BY b.sku 
					
					UNION ALL
					
					SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status, d.catelog_img_url AS                                       imag,b.mrp,b.price,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt,c.business_name
											   FROM seller_product_master a 
											   INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
											   INNER JOIN seller_existingproduct_image d ON  d.seller_extproduct_id=a.seller_exist_product_id
											   INNER JOIN  seller_account_information c ON c.seller_id=b.seller_id
											   INNER JOIN review_seller e ON e.seller_id=b.seller_id
											   $condition	AND ($sellerratingfromto_string)									   
											   AND (b.prod_status='Inactive' OR b.status='Disabled') 											   
											   
											   GROUP BY a.master_product_id
										   
					");
					
				}
				
				
				else if($pricefromto_string=='' && $discountfromto_string=='' && $sellerratingfromto_string=='' && $buyerfromto_string!='')	
				{	$query=$this->db->query("SELECT b.product_id,b.sku,b.name,b.prod_status,b.imag,b.mrp,b.price,b.special_price,
					b.special_pric_from_dt,b.special_pric_to_dt,c.business_name FROM cornjob_productsearch b
					INNER  JOIN seller_account_information c ON b.seller_id=c.seller_id
					INNER JOIN review_product d ON d.sku_id=b.sku					
					$condition 	AND ($buyerfromto_string)				
					AND (b.prod_status='Inactive' OR b.status='Disabled')					
					GROUP BY b.sku 
					
					UNION ALL
					
					SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status, d.catelog_img_url AS                                       imag,b.mrp,b.price,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt,c.business_name
											   FROM seller_product_master a 
											   INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
											   INNER JOIN seller_existingproduct_image d ON  d.seller_extproduct_id=a.seller_exist_product_id
											   INNER JOIN  seller_account_information c ON c.seller_id=b.seller_id
											   INNER JOIN review_product e ON e.sku_id=b.sku
											   $condition	AND ($buyerfromto_string)									   
											   AND (b.prod_status='Inactive' OR b.status='Disabled') 											   
											   
											   GROUP BY a.master_product_id
										   
					");
					
				}
				
				else if($pricefromto_string!='' && $discountfromto_string=='')
				{
					$query=$this->db->query("
					
					SELECT * FROM(
					SELECT b.product_id,b.sku,b.name,b.prod_status,b.imag,b.mrp,b.price,b.special_price,
					b.special_pric_from_dt,b.special_pric_to_dt,c.business_name, 
					CASE 
					WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
					THEN b.special_price
					WHEN b.price !=0
					THEN b.price 
					ELSE b.mrp
					END FINAL_PRICE
					
					FROM cornjob_productsearch b
					INNER  JOIN seller_account_information c ON b.seller_id=c.seller_id					
					$condition 					
					AND (b.prod_status='Inactive' OR b.status='Disabled')					
					GROUP BY b.sku 
					)as innerTable
					WHERE ($pricefromto_string)
					
					UNION ALL
										
					SELECT * FROM(
					SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status, d.catelog_img_url AS                                       imag,b.mrp,b.price,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt,c.business_name,					
												CASE 
												WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
												THEN b.special_price
												WHEN b.price !=0
												THEN b.price 
												ELSE b.mrp
												END FINAL_PRICE											
											   FROM seller_product_master a 
											   INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
											   INNER JOIN seller_existingproduct_image d ON  d.seller_extproduct_id=a.seller_exist_product_id
											   INNER JOIN  seller_account_information c ON c.seller_id=b.seller_id
											   $condition										   
											   AND (b.prod_status='Inactive' OR b.status='Disabled') GROUP BY a.master_product_id
											   )as innerTable
												WHERE ($pricefromto_string)
												");	
				}
				
				
				else if($pricefromto_string=='' && $discountfromto_string!='')
				{
					$query=$this->db->query("
					
					SELECT * FROM(
					SELECT b.product_id,b.sku,b.name,b.prod_status,b.imag,b.mrp,b.price,b.special_price,
					b.special_pric_from_dt,b.special_pric_to_dt,c.business_name, 
					CASE 
					WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
					THEN b.special_price
					WHEN b.price !=0
					THEN b.price 
					ELSE b.mrp
					END FINAL_PRICE
					
					FROM cornjob_productsearch b
					INNER  JOIN seller_account_information c ON b.seller_id=c.seller_id					
					$condition 					
					AND (b.prod_status='Inactive' OR b.status='Disabled')					
					GROUP BY b.sku 
					)as innerTable
					WHERE ($discountfromto_string)
					
					UNION ALL
										
					SELECT * FROM(
					SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status, d.catelog_img_url AS                                       imag,b.mrp,b.price,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt,c.business_name,					
												CASE 
												WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
												THEN b.special_price
												WHEN b.price !=0
												THEN b.price 
												ELSE b.mrp
												END FINAL_PRICE											
											   FROM seller_product_master a 
											   INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
											   INNER JOIN seller_existingproduct_image d ON  d.seller_extproduct_id=a.seller_exist_product_id
											   INNER JOIN  seller_account_information c ON c.seller_id=b.seller_id
											   $condition										   
											   AND (b.prod_status='Inactive' OR b.status='Disabled') GROUP BY a.master_product_id
											   )as innerTable
												WHERE ($discountfromto_string)
												");	
				}
				
				
				else if($pricefromto_string!='' && $discountfromto_string!='')
				{
					$query=$this->db->query("
					
					SELECT * FROM(
					SELECT b.product_id,b.sku,b.name,b.prod_status,b.imag,b.mrp,b.price,b.special_price,
					b.special_pric_from_dt,b.special_pric_to_dt,c.business_name, 
					CASE 
					WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
					THEN b.special_price
					WHEN b.price !=0
					THEN b.price 
					ELSE b.mrp
					END FINAL_PRICE
					
					FROM cornjob_productsearch b
					INNER  JOIN seller_account_information c ON b.seller_id=c.seller_id					
					$condition 					
					AND (b.prod_status='Inactive' OR b.status='Disabled')					
					GROUP BY b.sku 
					)as innerTable
					WHERE ($pricefromto_string) AND ($discountfromto_string)
					
					UNION ALL
										
					SELECT * FROM(
					SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status, d.catelog_img_url AS                                       imag,b.mrp,b.price,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt,c.business_name,					
												CASE 
												WHEN b.special_price !=0 AND CURDATE() BETWEEN b.special_pric_from_dt AND b.special_pric_to_dt
												THEN b.special_price
												WHEN b.price !=0
												THEN b.price 
												ELSE b.mrp
												END FINAL_PRICE											
											   FROM seller_product_master a 
											   INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
											   INNER JOIN seller_existingproduct_image d ON  d.seller_extproduct_id=a.seller_exist_product_id
											   INNER JOIN  seller_account_information c ON c.seller_id=b.seller_id
											   $condition										   
											   AND (b.prod_status='Inactive' OR b.status='Disabled') GROUP BY a.master_product_id
											   )as innerTable
												WHERE ($pricefromto_string) AND ($discountfromto_string)
												");	
				}
					
			

		return $query;

	
	}
	
	
	function select_productattributewise($catg_id,$attr_group_id)
	{
		
		set_time_limit(0);
		$sellr_ids=$this->session->userdata('sess_seller_idsrchstring');
		
		if($sellr_ids!='')
		{
			
			$query = $this->db->query("SELECT a.*,b.tax_amount,b.shipping_fee_amount,b.shipping_fee,b.manufacture_country,c.weight,c.description,c.short_desc,d.meta_title,
		d.meta_keywords,d.meta_desc,e.*,g.business_name,h.attribute_group_name FROM
		cornjob_productsearch a 
		INNER JOIN product_master b ON b.sku=a.sku
		INNER JOIN product_general_info c ON b.product_id=c.product_id 
		INNER JOIN product_meta_info d ON b.product_id=d.product_id
		INNER JOIN product_image e ON e.product_id=b.product_id
		INNER JOIN product_setting f ON a.product_id=f.product_id
		INNER JOIN seller_account_information g ON a.seller_id= g.seller_id		
		INNER JOIN attribute_group h ON h.attribute_group_id=f.attribut_set
		 
		WHERE a.lvl2='$catg_id' AND a.seller_id IN ($sellr_ids) AND f.attribut_set='$attr_group_id'
		
		GROUP BY a.sku ORDER BY a.product_id DESC ");	
			
		}
		else
		{
		$query = $this->db->query("SELECT a.*,b.tax_amount,b.shipping_fee_amount,b.shipping_fee,b.manufacture_country,c.weight,c.description,c.short_desc,d.meta_title,
		d.meta_keywords,d.meta_desc,e.*,g.business_name,h.attribute_group_name FROM
		cornjob_productsearch a 
		INNER JOIN product_master b ON b.sku=a.sku
		INNER JOIN product_general_info c ON b.product_id=c.product_id 
		INNER JOIN product_meta_info d ON b.product_id=d.product_id
		INNER JOIN product_image e ON e.product_id=b.product_id
		INNER JOIN product_setting f ON a.product_id=f.product_id
		INNER JOIN seller_account_information g ON a.seller_id= g.seller_id
		INNER JOIN attribute_group h ON h.attribute_group_id=f.attribut_set 
		WHERE a.lvl2='$catg_id' AND f.attribut_set='$attr_group_id'
		
		GROUP BY a.sku ORDER BY a.product_id DESC ");
		}
		return $query;
	}
	
}