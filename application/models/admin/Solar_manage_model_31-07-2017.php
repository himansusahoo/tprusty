<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solar_manage_model extends CI_Model
{
	
	
		
	function solar_indexing_count()
	{
		if(@$_GET['indx_status']=='Completed')
		{
			$qr=$this->db->query("SELECT count(sql_id) as tot FROM solar_indexing WHERE indexing_status='Completed' AND prod_process_status='Add' ");
		}
		else
		{
			$qr=$this->db->query("SELECT count(sql_id) as tot FROM solar_indexing WHERE indexing_status='Pending' AND prod_process_status='Add' ");
		}
		//return $qr->num_rows();
		
		return $qr->row()->tot;
			
	}
	/*function select_solar_indexing($limit,$start)
	{
		
		$qr=$this->db->query("SELECT a.*,b.name,b.imag,b.sku FROM solar_indexing a 
							INNER JOIN cornjob_productsearch b on a.sku=b.sku 
							WHERE indexing_status='Pending' ORDER BY b.prod_search_sqlid DESC LIMIT ".$start.", ".$limit." ");
		
		return $qr;	
	}*/
	
	
	
	
	function select_solar_indexing($limit,$start)
	{
		if(@$_GET['indx_status']=='Completed')
		{
					$indx_sts='Completed';
					
		}
		else
		{
			$indx_sts='Pending';	
		}
		//$query_prodid = $this->db->query("SELECT a.product_id FROM product_setting a INNER JOIN cornjob_productsearch b ON a.product_id=b.product_id  ORDER BY a.id DESC LIMIT ".$start.", ".$limit."");
		
		$query_prodid = $this->db->query("SELECT b.product_id FROM solar_indexing a INNER JOIN cornjob_productsearch b ON a.product_id=b.product_id WHERE  (a.indexing_status='".$indx_sts."' ) AND a.prod_process_status='Add'  ORDER BY a.sql_id DESC LIMIT ".$start.", ".$limit."");
		
		if($query_prodid->num_rows()>0)
		{
				$row_prod_id=$query_prodid->result_array();
				
				$prod_arr=array();
				foreach($row_prod_id as $res_prodid)
				{ array_push($prod_arr,$res_prodid['product_id']);}
				$prodid_str=implode(',',$prod_arr);
				
				
				$query1 = $this->db->query("SELECT h.*,b.name,b.imag,b.sku
		FROM product_setting a INNER JOIN  cornjob_productsearch b ON a.product_id=b.product_id
		INNER JOIN attribute_group f ON a.attribut_set = f.attribute_group_id
		INNER JOIN seller_account_information g ON b.seller_id = g.seller_id
		INNER JOIN solar_indexing h on h.sku=b.sku
		WHERE a.product_id
		IN ($prodid_str) AND h.indexing_status='".$indx_sts."' AND h.prod_process_status='Add'
		GROUP BY b.sku  ORDER BY a.product_id DESC  ");
		
			if($query1->num_rows()>0)
			{
				return $query1;
			}else
				{	$query2 = $this->db->query("SELECT h.*,b.name,c.sku,e.catelog_img_url
			FROM product_setting a
			INNER JOIN product_general_info b ON a.product_id = b.product_id
			INNER JOIN product_master c ON a.product_id = c.product_id
			INNER JOIN product_category d ON a.product_id = d.product_id
			INNER JOIN product_image e ON a.product_id = e.product_id
			INNER JOIN attribute_group f ON a.attribut_set = f.attribute_group_id
			INNER JOIN seller_account_information g ON c.seller_id = g.seller_id
			INNER JOIN solar_indexing h on h.sku=c.sku
			WHERE a.product_id
			IN ($prodid_str) AND h.indexing_status='".$indx_sts."' AND h.prod_process_status='Add'
			GROUP BY c.sku ORDER BY a.product_id DESC ");
					
					return $query2;
				} //if condition end
				
		}
		else
		{
			return $query2=false;	
		}
	}
	
	
	function addsolr_indesing()	
	{
		set_time_limit(0);
		$sku_ids=$this->input->post('prod_sku');
		$skuidsarr=array();
		
		foreach($sku_ids as $ky=>$val)
		{$skuidsarr[]="'".$val."'";}
		
		$skuids_strg=implode(',',$skuidsarr);
		
		$query=$this->db->query("select distinct a.product_id,a.name,a.sku,a.lvl2_name,a.lvl1_name,lvlmain_name,a.brand,
                                 a.color,a.size,a.Capacity,a.RAM,a.ROM,a.seller_id FROM cornjob_productsearch a
								 INNER JOIN solar_indexing b ON a.sku=b.sku  
								 WHERE b.indexing_status='Pending' AND prod_process_status='Add' AND b.sku IN ($skuids_strg) group by a.sku    ");
		if(base_url()=='https://www.moonboy.in/')
		{$solr_colection='mycollection1';}
		else
		{
			$solr_colection='mycollection1_offline';	
		}						 
		
		$ch = curl_init(SOLR_BASE_URL."".$solr_colection."/update?wt=json&spellcheck=true&spellcheck.build=true");
		
		foreach($query->result_array() as $res_prod)
		{
			$selr_id=$res_prod['seller_id'];
			$skuid=$res_prod['sku'];
			$qr_seller=$this->db->query("SELECT business_name FROM seller_account_information WHERE seller_id='$selr_id' ");
			
			$seller_name=$qr_seller->row()->business_name;
			
			$qrattr_sku=$this->db->query("SELECT * FROM seller_product_attribute_value WHERE sku='$skuid' ");
			$model_num='';
			foreach($qrattr_sku->result_array() as $res_attribte)
			{ $attrb_id=$res_attribte['attr_id'];
				$qr_attrbfld=$this->db->query("SELECT attribute_field_name FROM attribute_real 
				                              WHERE attribute_id='$attrb_id' AND
											  (attribute_field_name LIKE '%Model%'											   
											   OR attribute_field_name LIKE '%Model  Number%'
											   OR attribute_field_name LIKE '%Model ID%'
											   OR attribute_field_name LIKE '%Model Name%'
											   OR attribute_field_name LIKE '%Model No%'
											   OR attribute_field_name LIKE '%Model Number%'
											   OR attribute_field_name LIKE '%Model Series%'
											   OR attribute_field_name LIKE '%Model Series Name%'
											   OR attribute_field_name LIKE '%Vehicle Model%'											   
											  ) ");
				if($qr_attrbfld->num_rows()>0)
				{
					$model_num=	$res_attribte['attr_value'];
				}							  
					
			}		
			
				
			$data=array();
			
			$data = array(
				"add" => array( 
					"doc" => array(
						"product_id"   => $res_prod['product_id'],
						"name" => $res_prod['name'],
						"sku" => $res_prod['sku'],
						"lvl2_name" => $res_prod['lvl2_name'],
						"lvl1_name" => $res_prod['lvl1_name'],
						"lvlmain_name" => $res_prod['lvlmain_name'],
						"brand"=>$res_prod['brand'],
						"color"=>$res_prod['color'],
						//"size"=>$res_prod['size'],
						"Capacity"=>$res_prod['Capacity'],
						"RAM"=>$res_prod['RAM'],
						"ROM"=>$res_prod['ROM'],
						"seller_name"=>$seller_name,						
						"model_number"=>$model_num
						
					),
					"commitWithin" => 1000,
				),
			);
			$data_string = json_encode($data);
			
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
			
			$response = curl_exec($ch);
			
			$data2 = json_decode($response, true);
			
			
			
			if($data2['responseHeader']['status']==0)			
			{
				$dt = date('Y-m-d H:i:s');
				$this->db->query("UPDATE solar_indexing SET indexing_status='Completed',last_indexdtm='$dt' WHERE sku='$skuid' ");
			
			}
			
				
		}
		
		echo 'success';exit;
				
	}
	
	
	function solar_editprodindexing_count()
	{
		if(@$_GET['indx_status']=='Completed')
		{		
			$qr=$this->db->query("SELECT count(sql_id) as tot FROM solar_indexing WHERE (indexing_status='Completed' ) AND prod_process_status='Edit' ");
		}
		else
		{
			$qr=$this->db->query("SELECT count(sql_id) as tot FROM solar_indexing WHERE (indexing_status='Pending' ) AND prod_process_status='Edit' ");	
		}
		
		
		return $qr->row()->tot;
			
	}
	
	
	function select_solar_editedindexing($limit,$start)
	{
		
		if(@$_GET['indx_status']=='Completed')
		{
			$indx_sts='Completed';
					
		}
		else
		{
			$indx_sts='Pending';	
		}
		
		$query_prodid = $this->db->query("SELECT b.product_id FROM solar_indexing a INNER JOIN cornjob_productsearch b ON a.product_id=b.product_id WHERE  (a.indexing_status='".$indx_sts."' ) AND a.prod_process_status='Edit'  ORDER BY a.sql_id DESC LIMIT ".$start.", ".$limit."");
		$row_prod_id=$query_prodid->result_array();
		
		if($query_prodid->num_rows()>0)
		{				$prod_arr=array();
						foreach($row_prod_id as $res_prodid)
						{ array_push($prod_arr,$res_prodid['product_id']);}
						$prodid_str=implode(',',$prod_arr);
						
						
						$query1 = $this->db->query("SELECT h.*,b.name,b.imag,b.sku
				FROM product_setting a INNER JOIN  cornjob_productsearch b ON a.product_id=b.product_id
				INNER JOIN attribute_group f ON a.attribut_set = f.attribute_group_id
				INNER JOIN seller_account_information g ON b.seller_id = g.seller_id
				INNER JOIN solar_indexing h on h.sku=b.sku
				WHERE a.product_id
				IN ($prodid_str) AND (h.indexing_status='".$indx_sts."' ) AND h.prod_process_status='Edit'
				GROUP BY b.sku  ORDER BY a.product_id DESC  ");
				
					if($query1->num_rows()>0)
					{
						return $query1;
					}else
						{	$query2 = $this->db->query("SELECT h.*,b.name,c.sku,e.catelog_img_url
					FROM product_setting a
					INNER JOIN product_general_info b ON a.product_id = b.product_id
					INNER JOIN product_master c ON a.product_id = c.product_id
					INNER JOIN product_category d ON a.product_id = d.product_id
					INNER JOIN product_image e ON a.product_id = e.product_id
					INNER JOIN attribute_group f ON a.attribut_set = f.attribute_group_id
					INNER JOIN seller_account_information g ON c.seller_id = g.seller_id
					INNER JOIN solar_indexing h on h.sku=c.sku
					WHERE a.product_id
					IN ($prodid_str) AND (h.indexing_status='".$indx_sts."' ) AND h.prod_process_status='Edit'
					GROUP BY c.sku ORDER BY a.product_id DESC ");
							
							return $query2;
						} //if condition end
						
		}
		else
		{return $query2=false;}
		
	}
	
	
	
	
	function updatesolr_indesing()
	{
	
		
		set_time_limit(0);
		$sku_ids=$this->input->post('prod_sku');
		$skuidsarr=array();
		
		foreach($sku_ids as $ky=>$val)
		{$skuidsarr[]="'".$val."'";}
		
		$skuids_strg=implode(',',$skuidsarr);
		
		$query=$this->db->query("select distinct a.product_id,a.name,a.sku,a.lvl2_name,a.lvl1_name,lvlmain_name,a.brand,
                                 a.color,a.size,a.Capacity,a.RAM,a.ROM,a.seller_id FROM cornjob_productsearch a
								 INNER JOIN solar_indexing b ON a.sku=b.sku  
								 WHERE (b.indexing_status='Pending') AND prod_process_status='Edit' AND b.sku IN ($skuids_strg) group by a.sku    ");
		if(base_url()=='https://www.moonboy.in/')
		{$solr_colection='mycollection1';}
		else
		{
			$solr_colection='mycollection1_offline';	
		}						 
		
		$ch = curl_init(SOLR_BASE_URL."".$solr_colection."/update?wt=json&spellcheck=true&spellcheck.build=true");
		
		foreach($query->result_array() as $res_prod)
		{
			
			//-------------------------index remove if exit start---------------------//
			
				$search_txt=$res_prod['sku'];
				$chslect= SOLR_BASE_URL."mycollection1/select?q=sku:".$search_txt."&wt=json&spellcheck=true&spellcheck.collate=true&spellcheck.build=true";			
				
			$curl2 = curl_init($chslect);
			curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
			$output = curl_exec($curl2);
			 $data3 = json_decode($output, true);			
			
			$skuid=$res_prod['sku'];
			
			if($data3['response']['numFound']>0)
			
			{
				$curl_dlt= SOLR_BASE_URL."".$solr_colection."/update?commit=true -H 'Content-Type: text/xml' --data-binary '<delete><sku>".$skuid."</sku></delete>'";
				
				
				$curl2 = curl_init($curl_dlt);
				curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
				$output = curl_exec($curl2);
				$data2 = json_decode($output, true);	
			
					
			
			}
			
			//-------------------------index remove if exit end---------------------//
			
			$selr_id=$res_prod['seller_id'];
			$skuid=$res_prod['sku'];
			$qr_seller=$this->db->query("SELECT business_name FROM seller_account_information WHERE seller_id='$selr_id' ");
			
			$seller_name=$qr_seller->row()->business_name;
			
			$qrattr_sku=$this->db->query("SELECT * FROM seller_product_attribute_value WHERE sku='$skuid' ");
			$model_num='';
			foreach($qrattr_sku->result_array() as $res_attribte)
			{ $attrb_id=$res_attribte['attr_id'];
				$qr_attrbfld=$this->db->query("SELECT attribute_field_name FROM attribute_real 
				                              WHERE attribute_id='$attrb_id' AND
											  (attribute_field_name LIKE '%Model%'											   
											   OR attribute_field_name LIKE '%Model  Number%'
											   OR attribute_field_name LIKE '%Model ID%'
											   OR attribute_field_name LIKE '%Model Name%'
											   OR attribute_field_name LIKE '%Model No%'
											   OR attribute_field_name LIKE '%Model Number%'
											   OR attribute_field_name LIKE '%Model Series%'
											   OR attribute_field_name LIKE '%Model Series Name%'
											   OR attribute_field_name LIKE '%Vehicle Model%'											   
											  ) ");
				if($qr_attrbfld->num_rows()>0)
				{
					$model_num=	$res_attribte['attr_value'];
				}							  
					
			}		
			
				
			$data=array();
			
			$data = array(
				"add" => array( 
					"doc" => array(
						"product_id"   => $res_prod['product_id'],
						"name" => $res_prod['name'],
						"sku" => $res_prod['sku'],
						"lvl2_name" => $res_prod['lvl2_name'],
						"lvl1_name" => $res_prod['lvl1_name'],
						"lvlmain_name" => $res_prod['lvlmain_name'],
						"brand"=>$res_prod['brand'],
						"color"=>$res_prod['color'],
						//"size"=>$res_prod['size'],
						"Capacity"=>$res_prod['Capacity'],
						"RAM"=>$res_prod['RAM'],
						"ROM"=>$res_prod['ROM'],
						"seller_name"=>$seller_name,						
						"model_number"=>$model_num
						
					),
					"commitWithin" => 1000,
				),
			);
			$data_string = json_encode($data);
			
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
			
			$response = curl_exec($ch);
			
			$data2 = json_decode($response, true);
			
			
			
			if($data2['responseHeader']['status']==0)
			
			{
				$dt = date('Y-m-d H:i:s');
				$this->db->query("UPDATE solar_indexing SET indexing_status='Completed',last_indexdtm='$dt' WHERE sku='$skuid' ");
			}
			
			
				
		}
		
		echo 'success';exit;
				
			
	}
	
	
	function solar_deletedprodindexing_count()
	{
		if(@$_GET['indx_status']=='Completed')
		{
				$qr=$this->db->query("SELECT count(sql_id) as tot FROM solar_indexing WHERE (indexing_status='Completed') AND prod_process_status='Delete' ");
					
		}
		else
		{
			$qr=$this->db->query("SELECT count(sql_id) as tot FROM solar_indexing WHERE (indexing_status='Pending') AND prod_process_status='Delete' ");	
		}
		
		
		
		
		return $qr->row()->tot;	
	}
	
	
	function select_solar_deletedindexing($limit,$start)
	{
		if(@$_GET['indx_status']=='Completed')
		{
				$indx_sts='Completed';
					
		}
		else
		{
			$indx_sts='Pending';	
		}
		
		$qr = $this->db->query("SELECT * FROM solar_indexing WHERE (indexing_status='".$indx_sts."') AND prod_process_status='Delete'   ORDER BY sql_id DESC LIMIT ".$start.", ".$limit."");
		
		
		return $qr;	
			
	}
	
	function deletesolr_indesing()
	{
		set_time_limit(0);
		$sku_ids=$this->input->post('prod_sku');
		$skuidsarr=array();
		
		if(base_url()=='https://www.moonboy.in/')
		{$solr_colection='mycollection1';}
		else
		{
			$solr_colection='mycollection1_offline';	
		}	
		
		foreach($sku_ids as $ky=>$val)
		{
			
				$curl_dlt= SOLR_BASE_URL."".$solr_colection."/update?commit=true -H 'Content-Type: text/xml' --data-binary '<delete><sku>".$val."</sku></delete>'";
				
				
				$curl2 = curl_init($curl_dlt);
				curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
				$output = curl_exec($curl2);
				$data2 = json_decode($output, true);
				
				if($data2['responseHeader']['status']==0)			
				{
					$dt = date('Y-m-d H:i:s');
					$this->db->query("UPDATE solar_indexing SET indexing_status='Completed',last_indexdtm='$dt' WHERE sku='$val' ");
				}
			
		}
			
		echo 'success';exit;	
			
	}
	
	

	
}
?>