<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advance_searchmodel_count extends CI_Model {



	function selected_advanceproductsearch_count()
	{
		
			
		$product_status=$this->input->get('prod_status');
		
		$sell_bzname=$this->input->get('slr_nmsrchfinlhidn');
		$sell_bzname_arr=array();
		if(count($sell_bzname)>0)
		{
			foreach($sell_bzname as $slnamky=>$slrname_val)
			{
				$sell_bzname_arr[]=preg_replace('#/#',"-",str_replace("'",'-',str_replace('&','-',str_replace(' ','-',strtolower($slrname_val)))));	
			}
		}
		
		
		$seller_idsrch=array();
		$seller_idsrchstring='';
		//****************************************************************//
		
		//$slr_name=preg_replace('#/#',"-",str_replace("'",'-',str_replace('&','-',str_replace(' ','-',strtolower($this->input->get('slrname'))))));
		
		if(count($sell_bzname)>0)
		{	$qr_slr=$this->db->query("SELECT seller_id,business_name FROM seller_account_information ");
			foreach($qr_slr->result_array() as $res_slrnam)
			{
				$slrnmfind=preg_replace('#/#',"-",str_replace("'",'-',str_replace('&','-',str_replace(' ','-',strtolower($res_slrnam['business_name'])))));
				
				foreach($sell_bzname_arr as $slfndky=>$slrfndval)
				{
					//if($slrfndval==$slrnmfind)
					//preg_match('/http/',$rw_filedata['image_url1'])
					//if(strpos($slrnmfind, $slrfndval))
					if($slrnmfind==$slrfndval)
					{$seller_idsrch[]=$res_slrnam['seller_id'];}
				
				} // inner loop end
				
			}
			
		}
		
		if(count($seller_idsrch)>0)
		{	$seller_idsrchstring=implode(',',$seller_idsrch);
			
		}
		//$this->session->set_userdata('sess_seller_idsrchstring',$seller_idsrchstring);
		
		$catg_ids=$this->input->get('catg_nmsrchfnlhdn');
		
		if($catg_ids!='')
		{$catg_ids_string=implode(',',$catg_ids);}
		else
		{$catg_ids_string='';}
		
		//$this->session->set_userdata('sess_catg_ids_string',$catg_ids_string);
		
	//--------------------product add or modified  date initialize start -----------------//	
		$prodaddormodf_type=$this->input->get('hdndate_filtertype');
		$proddate_from=$this->input->get('hdndate_fromfilter');
		$proddate_to=$this->input->get('hdndate_tofilter');
		 
		 /*$timestamp = strtotime($proddate_from[0]);
		 echo date("Y-m-d", $timestamp);exit;*/
		 
		 $addfrom_date_arr=array();
		 $addto_date_arr=array();
		 
		 $addfromto_date_string='';
		
		 
		 $modffrom_date_arr=array();
		 $modfto_date_arr=array();
		 
		 $modffromto_date_string='';
		 
		 
		 
		if($prodaddormodf_type!='')
		{		 $i_dt=0;
				 foreach($prodaddormodf_type as $keyproddt=>$valproddt)
				 {
					if($valproddt=='Add Date')
					{
						$timestamp_addfrom = strtotime($proddate_from[$i_dt]);
						$frm_addate=date("Y-m-d H:i:s", $timestamp_addfrom);
						$addfrom_date_arr[]=$frm_addate;
						
						
						
						$timestamp_addto = strtotime($proddate_to[$i_dt]);
						$to_addate=date("Y-m-d H:i:s", $timestamp_addto);
						$addto_date_arr[]=$to_addate;
						
					}
					else
					{
						$timestamp_addfrom = strtotime($proddate_from[$i_dt]);
						$frm_addate=date("Y-m-d H:i:s", $timestamp_addfrom);
						$modffrom_date_arr[]=$frm_addate;
						
						
						$timestamp_addto = strtotime($proddate_to[$i_dt]);
						$to_addate=date("Y-m-d H:i:s", $timestamp_addto);
						$modfto_date_arr[]=$to_addate;	
					}
					
					$i_dt++;
						 
				 }
				 
			if(count($addfrom_date_arr)>0)
			{ $j_dtprodadd=0;
				foreach($addfrom_date_arr as $ky_prodadddt=>$val_prodadddt)
				{
					if($j_dtprodadd==(count($addfrom_date_arr)-1))
					{$or='';}
					else
					{$or='OR';}
					
					$addfromto_date_string=$addfromto_date_string.' (date_added>='."'".$val_prodadddt."'".' AND date_added<='."'".$addto_date_arr[$ky_prodadddt]."'".') '.$or.' ';
					$j_dtprodadd++;	
				}
				
				
			} 
			
			
			if(count($modffrom_date_arr)>0)
			{ $k_dtprodadd=0;
				foreach($modffrom_date_arr as $ky_prodmodfdt=>$val_prodmodfdt)
				{
					if($k_dtprodadd==(count($modffrom_date_arr)-1))
					{$or='';}
					else
					{$or='OR';}
					
					$modffromto_date_string=$modffromto_date_string.' (modified_dtm>='."'".$val_prodmodfdt."'".' AND modified_dtm<='."'".$modfto_date_arr[$ky_prodmodfdt]."'".') '.$or.' ';
					$k_dtprodadd++;	
				}	
			} 
				 
		 
		} // product date type condition check end
		
		//$this->session->set_userdata('sess_addfromto_date_string',$addfromto_date_string);	
		//$this->session->set_userdata('sess_modffromto_date_string',$modffromto_date_string);	
		
		//--------------------product add or modified  date initialize end -----------------//
		
		
		//-----------------------------------Product Price Or Discount Blank or not check start------------------//
		
				$prod_prcdiscntttype=$this->input->get('hdnpricedsi_type');
								
				$pricedsi_from=$this->input->get('hdnpricedsi_from');			
				$pricedsi_to=$this->input->get('hdnpricedsi_to');
				
				 $pricefrom_arr=array();
		 		 $priceto_arr=array();
		 
		 		$pricefromto_string='';
				
				 $discountfrom_arr=array();
		 		 $discountto_arr=array();
		 
		 		$discountfromto_string='';
				
				
				if($prod_prcdiscntttype!='')
				{
					
						 $j_dt=0;
						 foreach($prod_prcdiscntttype as $keyproddt=>$valproddt)
						 {
							if($valproddt=='Price')
							{
								$pricefrom_arr[]=$pricedsi_from[$j_dt];
								
								$priceto_arr[]=$pricedsi_to[$j_dt];
								
							}
							else
							{
								
								$discountfrom_arr[]=$pricedsi_from[$j_dt];;
								
								$discountto_arr[]=$pricedsi_to[$j_dt];	
							}
							
							$j_dt++;
								 
						 }
						 
					if(count($pricefrom_arr)>0)
					{ $j_prodprice=0;
						foreach($pricefrom_arr as $ky_price=>$val_price)
						{
							if($j_prodprice==(count($pricefrom_arr)-1))
							{$or='';}
							else
							{$or='OR';}
							
							$pricefromto_string=$pricefromto_string.' (FINAL_PRICE>='."'".$val_price."'".' AND FINAL_PRICE<='."'".$priceto_arr[$ky_price]."'".') '.$or.' ';
							$j_prodprice++;	
						}
						
						
					} 
					
					
					if(count($discountfrom_arr)>0)
					{ $j_prodprice=0;
						foreach($discountfrom_arr as $ky_discount=>$val_discount)
						{
							if($j_prodprice==(count($discountfrom_arr)-1))
							{$or='';}
							else
							{$or='OR';}
							
							$discountfromto_string=$discountfromto_string.' ((100-(FINAL_PRICE*(100/mrp)))>='."'".$val_discount."'".' AND (100-(FINAL_PRICE*(100/mrp)))<='."'".$discountto_arr[$ky_discount]."'".') '.$or.' ';
							$j_prodprice++;	
						}	
					} 
				 
		 
			
		}
				
				//$this->session->set_userdata('sess_pricefromto_string',$pricefromto_string);	
				//$this->session->set_userdata('sess_discountfromto_string',$discountfromto_string);
				
				
		 
		
		
		
		//-----------------------------------Product Price Or Discount Blank or not check start------------------//
		
		
		//--------------------------------------product name or sku filter start---------------------------------------//	
			 $prod_sskuornamtype=$this->input->get('hdnprodnmsku_tyefilter');	
		  	 $product_nameorskuvaluearr=$this->input->get('hdnprodnmsku_datafilter');		
				
			  $prod_skuarr=array();
			  $prod_namearr=array();
			  
			  $prod_skustring='';
			  $prod_namestirng='';
		  
		  		if($prod_sskuornamtype!='')
				{					
						 $j_dt=0;
						 foreach($prod_sskuornamtype as $keyproskunmtyp=>$valproskunmtyp)
						 {
							if($valproskunmtyp=='Product Name')
							{	
								$prod_namearr[]=preg_replace('#"#',' ',preg_replace("/'/",' ',preg_replace('#/#',' ',$product_nameorskuvaluearr[$j_dt])));
															
							}
							else
							{
								$prod_skuarr[]=preg_replace('#"#',' ',preg_replace("/'/",' ',preg_replace('#/#',' ',$product_nameorskuvaluearr[$j_dt])));
								
								
							}
							
							$j_dt++;
								 
						 }
						 
					if(count($prod_skuarr)>0)
					{ $j_sku=0;
						foreach($prod_skuarr as $ky_sku=>$val_sku)
						{
							if($j_sku==(count($prod_skuarr)-1))
							{$or='';}
							else
							{$or='OR';}
							
							$prod_skustring=$prod_skustring.' (sku LIKE '."'%".$val_sku."%'".') '.$or.' ';
							$j_sku++;	
						}
						
						
					} 
					
					
					if(count($prod_namearr)>0)
					{ $j_prodnm=0;
						foreach($prod_namearr as $ky_prodnm=>$val_prodnm)
						{
							if($j_prodnm==(count($prod_namearr)-1))
							{$or='';}
							else
							{$or='OR';}
							
							$prod_namestirng=$prod_namestirng.' (name LIKE '."'%".$val_prodnm."%'".') '.$or.' ';
							$j_prodnm++;	
						}	
					} 
				 
					
				}
				
				
				
				//$this->session->set_userdata('sess_prodname_string',$prod_namestirng);	
				//$this->session->set_userdata('sess_prodsku_string',$prod_skustring);
				
				
				
				$attrbgroup_id=$this->input->get('hdnattrb_groupids');	
				$attrbactualvalue_sqlid=$this->input->get('hdnattrb_ids');
				
				$attrbgrouids_string='';
				if(count($attrbgroup_id)>0)	
				{$attrbgrouids_string=implode(',',$attrbgroup_id);}
				
				$attrbvalueasqlis_string='';
				if(count($attrbactualvalue_sqlid)>0)
				{$attrbvalueasqlis_string=implode(',',$attrbactualvalue_sqlid);}
				
				//$this->session->set_userdata('sess_attrbgrouids_string',$attrbgrouids_string);	
				//$this->session->set_userdata('sess_attrbvalueasqlis_string',$attrbvalueasqlis_string);
				
		//--------------------------------------product name or sku filter end---------------------------------------//
		
		
		//----------------------------------------- seller Or Buyer Rating Start-------------------------------------------//
			
				$slrbuyerrating_type=$this->input->get('hdnslrbuyerrating_type');
				$slrbuyerrating_from=$this->input->get('hdnslrbuyerrating_from');				
				$slrbuyerrating_to=$this->input->get('hdnslrbuyerrating_to');
				
				$slrrating_from=array();
		 		$slrrating_to=array();
		 
		 		$sellerratingfromto_string='';
				
				 $buyerrating_from=array();
		 		 $buyerrating_to=array();
		 
		 		$buyerfromto_string='';
				
				
				if($slrbuyerrating_type!='')
				{
					
						 $j_dt=0;
						 foreach($slrbuyerrating_type as $keyrate=>$valrate)
						 {
							if($valrate=='Seller Rating')
							{
								$slrrating_from[]=$slrbuyerrating_from[$j_dt];
								
								$slrrating_to[]=$slrbuyerrating_to[$j_dt];
								
							}
							else
							{
								
								$buyerrating_from[]=$slrbuyerrating_from[$j_dt];;
								
								$buyerrating_to[]=$slrbuyerrating_to[$j_dt];	
							}
							
							$j_dt++;
								 
						 }
						 
					if(count($slrrating_from)>0)
					{ $j_rate=0;
						foreach($slrrating_from as $ky_slrrate=>$val_slrrate)
						{
							if($j_rate==(count($slrrating_from)-1))
							{$or='';}
							else
							{$or='OR';}
							
							$sellerratingfromto_string=$sellerratingfromto_string.' (rating>='."'".$val_slrrate."'".' AND rating<='."'".$slrrating_to[$ky_slrrate]."'".') '.$or.' ';
							$j_rate++;	
						}
						
						
					} 
					
					
					if(count($buyerrating_from)>0)
					{ $k_rate=0;
						foreach($buyerrating_from as $ky_buyerrate=>$val_buyerrate)
						{
							if($k_rate==(count($buyerrating_from)-1))
							{$or='';}
							else
							{$or='OR';}
							
							$buyerfromto_string=$buyerfromto_string.' (rating>='."'".$val_buyerrate."'".' AND rating<='."'".$buyerrating_to[$ky_buyerrate]."'".') '.$or.' ';
							$k_rate++;	
						}	
					} 
				 
		 
			
		}
				
				//$this->session->set_userdata('sess_sellerratingfromto_string',$sellerratingfromto_string);	
				//$this->session->set_userdata('sess_buyerfromto_string',$buyerfromto_string);
				
				
		
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
						
				 $qr=$this->productdata_asattributrvalue($product_status,$seller_idsrchstring,$catg_ids_string,$attrbgrouids_string,$attrbvalueasqlis_string,$actualattrbid_string,$actualattrbvalue_string,$last_segment,$pricefromto_string,$discountfromto_string,$sellerratingfromto_string,$buyerfromto_string);			
						
					return $qr->num_rows();
							
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
			return $qr->num_rows();	
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
			return $qr->num_rows();	
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
			return $qr->num_rows();	
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
			return $qr->num_rows();
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
				return $qr->num_rows();
					
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
			return $qr->num_rows();
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
				return $qr->num_rows();
					
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
			
			$qr=$this->db->query("SELECT a.product_id,sku,name,prod_status,imag,a.mrp,a.price,a.special_price,
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
					e.mrp,e.price,e.special_price asspecial_price, e.price_fr_dt as special_pric_from_dt , e.price_to_dt as special_pric_to_dt
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
			return $qr->num_rows();	
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
			return $qr->num_rows();	
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
			return $qr->num_rows();	
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
			return $qr->num_rows();	
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
			return $qr->num_rows();
			}
			else
			{
				$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
				INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
				INNER JOIN review_seller c ON c.seller_id=a.seller_id			
				WHERE  ($sellerratingfromto_string) AND a.lvl2 IN ($catg_ids_string) AND a.seller_id IN ($seller_idsrchstring) AND a.sku!='' AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY a.sku 
				");	
				return $qr->num_rows();
					
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
					return $qr->num_rows();	
			}
			else
			{
				
					$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
					a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
					INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
					INNER JOIN review_product c ON c.sku_id=a.sku			
					WHERE  ($buyerfromto_string) AND a.lvl2 IN ($catg_ids_string) AND a.seller_id IN ($seller_idsrchstring) and a.sku!='' AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY a.sku   
					  ");	
					return $qr->num_rows();		
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
			return $qr->num_rows();	
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
			 AND prod_status='Active' AND status='Enabled' AND seller_status='Active' AND sku!=''	GROUP BY sku");	
			
				
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
			
			return $qr->num_rows();
				
		
				
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
			//echo $qr->num_rows();exit;
			
			$ctr=$qr->num_rows();
				
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
			");	
			$ctr=$qr->num_rows();
			}
			
			return $ctr;
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
			
			return $qr->num_rows();
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
			return $qr->num_rows();
			}
			else
			{
				$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
				INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
				INNER JOIN review_seller c ON c.seller_id=a.seller_id			
				WHERE  ($sellerratingfromto_string) AND a.seller_id IN ($seller_idsrchstring) AND a.sku!='' AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY a.sku  
				");	
				return $qr->num_rows();
					
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
					return $qr->num_rows();	
			}
			else
			{
				
					$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
					a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
					INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
					INNER JOIN review_product c ON c.sku_id=a.sku			
					WHERE  ($buyerfromto_string) AND a.seller_id IN ($seller_idsrchstring) and a.sku!='' AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY a.sku 
					");	
					return $qr->num_rows();		
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
				return $qr->num_rows();	
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
				return $qr->num_rows();	
			
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
			
			return $qr->num_rows();
				
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
						
				 $qr=$this->productdata_asattributrvalue($product_status,$seller_idsrchstring,$catg_ids_string,$attrbgrouids_string,$attrbvalueasqlis_string,$actualattrbid_string,$actualattrbvalue_string,$last_segment,$pricefromto_string,$discountfromto_string,$sellerratingfromto_string,$buyerfromto_string);			
						
					return $qr->num_rows();
							
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
			return $qr->num_rows();	
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
			return $qr->num_rows();	
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
			return $qr->num_rows();
			
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
			return $qr->num_rows();	
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
			 
			 return $qr->num_rows();
			
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
			WHERE ($pricefromto_string) and sku!=''   AND (a.prod_status='Inactive' OR a.status='Disabled')	GROUP BY sku
			
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
			WHERE ($discountfromto_string) and sku!=''   AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY sku ");
			
			
			
			}
			 return $qr->num_rows();
				
		}

		
		if($pricefromto_string!='' && $discountfromto_string=='')
		{
			
			if($product_status=='Active')
			{
					/*$qr=$this->db->query("SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id			
			WHERE ($pricefromto_string) and a.sku!=''   AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active'  	GROUP BY a.sku   ");*/
			
			
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
			WHERE ($pricefromto_string) and sku!=''   AND prod_status='Active' AND status='Enabled' AND seller_status='Active'  	GROUP BY sku  ");	
							
			}
			else
			{
			
			/*$qr=$this->db->query("SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id			
			WHERE ($pricefromto_string) and a.sku!='' AND (a.prod_status='Inactive' OR a.status='Disabled')	GROUP BY a.sku   ");*/
			
			
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
			 
			 return $qr->num_rows();
				
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
			 
			 return $qr->num_rows();
				
		}
			
		if($prod_namestirng!='' && $prod_skustring!='')
		{
			$qr=$this->db->query("SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id			
			WHERE  ($prod_skustring) OR ($prod_namestirng) GROUP BY a.sku  
			");	
			return $qr->num_rows();	
		}
			
				
		if($prod_namestirng!='' && $prod_skustring=='')
		{ //echo $prod_namestirng;exit;
			$qr=$this->db->query("SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id			
			WHERE  $prod_namestirng GROUP BY a.sku  
			");
			
			return $qr->num_rows();	
		}
		
		if($prod_namestirng=='' && $prod_skustring!='')
		{
			$qr=$this->db->query("SELECT product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
			a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id			
			WHERE  $prod_skustring GROUP BY a.sku  
			");	
			return $qr->num_rows();	
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
				return $qr->num_rows();	
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
				return $qr->num_rows();	
			
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
			return $qr->num_rows();
			}
			else
			{
				$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
				a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
				INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
				INNER JOIN review_seller c ON c.seller_id=a.seller_id			
				WHERE  ($sellerratingfromto_string) AND a.sku!='' AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY a.sku  
				");	
				return $qr->num_rows();
					
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
					return $qr->num_rows();	
			}
			else
			{
				
					$qr=$this->db->query("SELECT a.product_id,a.sku,a.name,prod_status,imag,a.mrp,a.price,a.special_price,
					a.special_pric_from_dt,a.special_pric_to_dt,b.business_name FROM cornjob_productsearch a
					INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id
					INNER JOIN review_product c ON c.sku_id=a.sku			
					WHERE  ($buyerfromto_string) and a.sku!='' AND (a.prod_status='Inactive' OR a.status='Disabled') GROUP BY a.sku   
					");	
					return $qr->num_rows();		
			}
		}
		
		
		
		//------------------------ seller or buyer rating data access end---------------------------------//
		
	} // function end
	
	
	
	function productdata_asattributrvalue($product_status,$seller_idsrchstring,$catg_ids_string,$attrbgrouids_string,$attrbvalueasqlis_string,$actualattrbid_string,$actualattrbvalue_string,$last_segment,$pricefromto_string,$discountfromto_string,$sellerratingfromto_string,$buyerfromto_string)
	{
		
		 		
			$catg_id=$catg_ids_string;
		
		if($product_status=='Active')
			{
				$qr=$this->product_attributefilter_as_seller($catg_id,$last_segment,$seller_idsrchstring,$product_status,$pricefromto_string,$discountfromto_string,$sellerratingfromto_string,$buyerfromto_string);
				
				
			
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
					$qr=$this->inactiveproduct_attributefilter_as_seller($catg_id,$last_segment,$seller_idsrchstring,$product_status,$pricefromto_string,$discountfromto_string,$sellerratingfromto_string,$buyerfromto_string);
				}
				else
				{
					$qr=false;	
				}
				
				
			
			}
			//echo $qr->num_rows();exit;
			return $qr;	
	
	
	}
	
	function product_attributefilter_as_seller($catg_id,$last_segmt,$seller_idsrchstring,$product_status,$pricefromto_string,$discountfromto_string,$sellerratingfromto_string,$buyerfromto_string)
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
				 $condition AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by b.product_id DESC  ");*/
				 
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
	
	
	function inactiveproduct_attributefilter_as_seller($catg_id,$last_segmt,$seller_idsrchstring,$product_status,$pricefromto_string,$discountfromto_string,$sellerratingfromto_string,$buyerfromto_string)
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
					GROUP BY b.sku 
					
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
	
	
	

	
} // class end

?>