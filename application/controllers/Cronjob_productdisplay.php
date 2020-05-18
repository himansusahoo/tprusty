<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjob_productdisplay extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('html','form','url'));
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->library('session');
		$this->load->library('encrypt');
		$this->load->library('javascript');
		$this->load->helper('string');
		$this->load->database();
		//$this->load->model('Corenjob_product_model')
		$this->load->model('Cornjob_productinsermodel');		
		$this->load->helper('file');
	}
	
	
	function select_product_data(){
		
		//$this->Corenjob_product_model->select_productdata();
		
		$this->Cornjob_productinsermodel->select_productdata();	
	}
	function updateprice_product_data(){
		
		//$this->Corenjob_product_model->select_productdata();
		
		$this->Cornjob_productinsermodel->cronjobsearch_priceqntstatus_update();	
	}
	
	
	function update_cornjob_product_data(){
		//$this->Corenjob_product_model->update_inn_cornjob_product_data();
		
		$this->Cornjob_productinsermodel->update_cornjob_product_info();
	}
	function cronjob_ctagupdate()
	{
		$this->Cornjob_productinsermodel->cronjob_categoryupdate();
	}
	function update_tempcatg()
	{
		$this->Cornjob_productinsermodel->select_productdata1();	
	}
	
	function update_attributes()
	{
		
		//$sku_str='RXES-154-FF28';
		//$skr_arr=explode(',',$sku_str);
		set_time_limit(0);
			//$this->db->trans_start();
		
		
		$attrb_query=$this->db->query("SELECT sku FROM seller_product_master WHERE product_type='Grouped Product' ");
		
		foreach($attrb_query->result_array() as $res_attrbsku )
		{$skr_arr=array();
			$skr_arr[]=$res_attrbsku['sku'];		
		
			$this->Cornjob_productinsermodel->manual_update_filtering_attribute_data($skr_arr);
		}
		
	}
	
	function update_capacityattribute()
	{
		
		$this->Cornjob_productinsermodel->update_capramrom_attrubute();
	}
	
	function manual_update_allattributes()
	{
			
			//$uploaduid_arr=array('0'=>'239','1'=>'25','2'=>'27', '3'=>'588', '4'=>'628', '5'=>'630', '6'=>'674', '7'=>'675', '8'=>'680', '9'=>'683', '10'=>'684', '11'=>'686');
			//$uploaduid_arr=array('0'=>'675','1'=>'680','2'=>'683', '3'=>'684', '4'=>'686');
			
			
			
			/*$this->load->model('Cronjobattrb_manualupdate');
			foreach($uploaduid_arr as $attbrky=>$excelfiluploadid)
			{  $this->Cronjobattrb_manualupdate->updtae_attrbmanullay($excelfiluploadid); }*/
			
			$this->load->model('Cronjobattrb_manualupdate');
			$excelfiluploadid='686';			
			$this->Cronjobattrb_manualupdate->updtae_attrbmanullay($excelfiluploadid);
			
			
	}
		
	/*function update_price_mastertable()
	{
		$qr_price=$this->db->query("SELECT * FROM bulk_editedproductupload_log WHERE editstatus='Edited' ");
		
		foreach($qr_price->result_array() as $rw_priceupdatedata)
		{
			$mrp=$rw_priceupdatedata['mrp'];
			$sale_price=$rw_priceupdatedata['sell_price'];
			$special_price=$rw_priceupdatedata['special_price'];
			$sku=$rw_priceupdatedata['sku'];
			
			$this->db->query("update product_master set mrp='$mrp' , price='$sale_price' , special_price='$special_price' WHERE sku='$sku' ");	
		}
		echo "finish";exit;
			
	}*/
	
	
	function update_price_cronjobtable()
	{
		$qr_price=$this->db->query("SELECT  a.sku
FROM cornjob_productsearch a
WHERE lvl2
IN ( 79 ) 
AND a.quantity >0
AND a.prod_status =  'Active'
AND a.status =  'Enabled'
AND a.seller_status =  'Active'
GROUP BY a.sku, a.product_id
ORDER BY a.current_price DESC limit 10 ");
		
		foreach($qr_price->result_array() as $rw_priceupdatedata)
		{
			$sku=$rw_priceupdatedata['sku'];
			
			$qr_mast=$this->db->query("SELECT c.sku, c.mrp, c.price, c.special_price, c.special_pric_from_dt, c.special_pric_to_dt,		
				CASE 
				WHEN c.special_price !=0 AND CURDATE() BETWEEN c.special_pric_from_dt AND c.special_pric_to_dt
				THEN c.special_price
				WHEN c.price !=0
				THEN c.price 
				ELSE c.mrp
				END FINAL_PRICE				
		FROM product_master c WHERE c.sku='$sku' AND mrp=(select min(c.mrp) from product_master where sku='$sku')   ");
		
			$rw=$qr_mast->result();
			
			$mrp=$rw[0]->mrp;
			$sale_price=$rw[0]->price;
			$special_price=$rw[0]->special_price;
			$special_price_frmdate=$rw[0]->special_pric_from_dt;
			$special_price_todate=$rw[0]->special_pric_to_dt;
			$current_price=$rw[0]->FINAL_PRICE;
			
			
			
			$this->db->query("update cornjob_productsearch set mrp='$mrp' , price='$sale_price' , special_price='$special_price'
			,special_pric_from_dt='$special_price_frmdate',special_pric_to_dt='$special_price_todate',current_price='$current_price'
			 WHERE sku='$sku' ");	
		}
		echo "finish";exit;
			
	}
	
	function category_update()
	{
		$this->Cornjob_productinsermodel->update_globalcommisiontbl();	
	}
	
	/*function manualproduct_addin_cronjob()
	{
		$qr=$this->db->query("SELECT a.sku,a.product_id FROM solar_indexing a WHERE (a.indexing_status='Pending') AND (a.prod_process_status='Add' OR a.prod_process_status='Edit') AND a.sku NOT IN (SELECT b.sku FROM cornjob_productsearch b WHERE b.sku!='' ) GROUP BY a.sku");
		
		foreach($qr->result_array() as $res_prod)
		{	$prod_sku=$res_prod['sku'];
			$prod_id=$res_prod['product_id'];
			
			$qr_color=$this->db->query("SELECT a.attr_value AS attr_value FROM seller_product_attribute_value a 
			INNER JOIN attribute_real b ON a.attr_id = b.attribute_id 
			WHERE b.attribute_field_name='Color' AND a.sku='$prod_sku' GROUP BY sku");
			
			$color=	$qr_color->row()->attr_value;
			
			
			$qr_size=$this->db->query("SELECT a.attr_value AS attr_value FROM seller_product_attribute_value a 
			INNER JOIN attribute_real b ON a.attr_id = b.attribute_id 
			WHERE b.attribute_field_name='Size' AND a.sku='$prod_sku' GROUP BY sku ");
			
			$size=	$qr_size->row()->attr_value;
			
			
			$qr_brand=$this->db->query("SELECT a.attr_value AS attr_value FROM seller_product_attribute_value a 
			INNER JOIN attribute_real b ON a.attr_id = b.attribute_id 
			WHERE b.attribute_field_name='Brand' AND a.sku='$prod_sku' GROUP BY sku ");
			
			$brand=	$qr_brand->row()->attr_value;
			
			
			$qr_type=$this->db->query("SELECT a.attr_value AS attr_value FROM seller_product_attribute_value a
			 INNER JOIN attribute_real b ON a.attr_id = b.attribute_id 
			WHERE b.attribute_field_name='Type' AND a.sku='$prod_sku' GROUP BY sku ");
			
			$type=	$qr_type->row()->attr_value;
			
			
			$qr_capacity=$this->db->query("SELECT a.attr_value AS attr_value FROM seller_product_attribute_value a
			INNER JOIN attribute_real b ON a.attr_id = b.attribute_id 
			WHERE b.attribute_field_name='Capacity' AND a.sku='$prod_sku' GROUP BY sku ");
			
			$capacity=	$qr_capacity->row()->attr_value;
			
			
			
			$qr_ram=$this->db->query("SELECT a.attr_value AS attr_value FROM seller_product_attribute_value a 
											INNER JOIN attribute_real b ON a.attr_id = b.attribute_id 
											WHERE b.attribute_field_name='RAM' AND a.sku='$prod_sku' GROUP BY sku ");
			
			$ram=$qr_ram->row()->attr_value;
			
			
			
				$qr_rom=$this->db->query("SELECT a.attr_value AS attr_value FROM seller_product_attribute_value a 
				INNER JOIN attribute_real b ON a.attr_id = b.attribute_id 
				WHERE b.attribute_field_name='ROM' AND a.sku='$prod_sku' GROUP BY sku ");
			
				$rom=$qr_rom->row()->attr_value;
			
			
			
			
			$qr_curprice=$this->db->query("SELECT CASE WHEN special_price !=0 AND CURDATE() BETWEEN special_pric_from_dt	 AND special_pric_to_dt
				THEN special_price
				WHEN price !=0
				THEN price 
				ELSE mrp
				END FINAL_PRICE				
		FROM product_master  WHERE sku='$prod_sku' ");
			
				$curprice=$qr_curprice->row()->FINAL_PRICE;
				
				
				$this->db->query(
				"INSERT INTO cornjob_productsearch (lvl2,lvl2_name,lvl1,lvl1_name,lvlmain,lvlmain_name,sku,product_id,
		name,imag,prod_status,seller_id,mrp,price,special_price,special_pric_from_dt,special_pric_to_dt,status,
		quantity,seller_status,current_price,brand,color,size,type,Capacity,RAM,ROM)			
		SELECT a.lvl2,a.lvl2_name,a.lvl1,a.lvl1_name,a.lvlmain,a.lvlmain_name,f.sku,".$prod_id.",c.name,d.catelog_img_url,
		f.approve_status,f.seller_id,f.mrp,f.price,f.special_price,f.special_pric_from_dt,f.special_pric_to_dt,f.status,f.quantity,h.status,
		".$curprice.",'".$brand."','".$color."','".$size."','".$type."','".$capacity."',
		'".$ram."','".$rom."'
		FROM  temp_category a
		INNER JOIN product_category b ON b.category_id = a.lvl2
		INNER JOIN product_general_info c ON c.product_id=b.product_id
		INNER JOIN product_image d ON d.product_id=b.product_id		
		INNER JOIN product_master f ON f.product_id=b.product_id		
		INNER JOIN seller_account h ON h.seller_id= f.seller_id			
		WHERE  f.sku='$prod_sku' GROUP BY f.sku"
				);
			
			
		}	
	}*/
	
	function saleprice_update()
	{
		$qr=$this->db->query("SELECT sku from sell_price_349 WHERE process_satus='Pending' ");
							  
		if($qr->num_rows()>0)
		{					  
				foreach($qr->result_array() as $res_prodsaleprc)
				{
					$sku=$res_prodsaleprc['sku'];	
					//$sale_price=$res_prodsaleprc['sell_price'];
					
					/*if($sale_price=='349')
					{
						$this->db->query("UPDATE cornjob_productsearch SET price='299' WHERE sku='$sku' ");
						$this->db->query("UPDATE product_master SET price='299' WHERE sku='$sku' ");
						
						$this->db->query("UPDATE seller_product_price_info a SET price='299' WHERE a.seller_product_id 
						IN (SELECT b.seller_product_id FROM seller_product_general_info b WHERE b.sku='$sku' )");	
						
						
					}
					else
					{
						$this->db->query("UPDATE cornjob_productsearch SET price='$sale_price' WHERE sku='$sku' ");	
						$this->db->query("UPDATE product_master SET price='$sale_price' WHERE sku='$sku' ");
						
						$this->db->query("UPDATE seller_product_price_info a SET price='$sale_price' WHERE a.seller_product_id 
						IN (SELECT b.seller_product_id FROM seller_product_general_info b WHERE b.sku='$sku' )");		
					}*/
					
					$this->db->query("UPDATE cornjob_productsearch SET price='299',	current_price='299' WHERE sku='$sku' ");
					$this->db->query("UPDATE product_master SET price='299' WHERE sku='$sku' ");
						
					$this->db->query("UPDATE seller_product_price_info a SET price='299' WHERE a.seller_product_id 
						IN (SELECT b.seller_product_id FROM seller_product_general_info b WHERE b.sku='$sku' )");
						
							
					$this->db->query("UPDATE sell_price_349 SET process_satus='Completed' WHERE sku='$sku' ");
				}					  
							  
		}
		
	}
	
	
		function solr_attr_catglink()
		{
			$qr=$this->db->query("SELECT sku,lvl2,lvl2_name,lvl1,lvl1_name,lvlmain,lvlmain_name 
									FROM cornjob_productsearch WHERE sku!='' AND lvl2>0 GROUP BY lvl2   ");
			
			foreach($qr->result_array() as $res_catg)
			{		
					$skuid=$res_catg['sku'];
					$qrattr_fldname=$this->db->query("SELECT b.attribute_field_name FROM seller_product_attribute_value a
															   INNER JOIN attribute_real b ON a.attr_id=b.attribute_id
															   WHERE a.sku='$skuid' GROUP BY a.attr_id ");
					$solr_fldnmarr=array();
					$solr_fldstrng='';									   
					if($qrattr_fldname->num_rows()>0)
					{
						foreach($qrattr_fldname->result_array() as $res_fldname)
						{ 		
								$attrb_fldname=str_replace("&",'',str_replace("'",'',$res_fldname['attribute_field_name']));
								$qr_solrattrb=$this->db->query("SELECT * FROM solr_product_attribute 
																	WHERE attrb_name='$attrb_fldname' 
																	GROUP BY  attrb_name");
																	
								if($qr_solrattrb->num_rows()>0)
								{
									$solr_fldnmarr[]=$qr_solrattrb->row()->solr_filed_nm;	
								}									
						}	
					}
					
					
					if(count($solr_fldnmarr)>0)
					{
						$solr_fldstrng=implode(',',$solr_fldnmarr);
						
						$catg_lvl3id=$res_catg['lvl2'];
						
						$qr_chk=$this->db->query("SELECT Category_Lvl3_Id FROM solr_attrb_catg_link WHERE Category_Lvl3_Id='$catg_lvl3id' ");
						
								if($qr_chk->num_rows()==0)
								{
											$data=array(
												'Category_Lvl1_Id'=>$res_catg['lvlmain'],
												'Category_Lvl2_Id'=>$res_catg['lvl1'],
												'Category_Lvl3_Id'=>$res_catg['lvl2'],
												'Category_Lvl1'=>$res_catg['lvlmain_name'],
												'Category_Lvl2'=>$res_catg['lvl1_name'],
												'Category_Lvl3'=>$res_catg['lvl2_name'],
												'solr_filedname'=>$solr_fldstrng						
											);
											
											$this->db->insert('solr_attrb_catg_link',$data);
								}
					}
			} // main for loop end						
				
		} // function end
		
	
}