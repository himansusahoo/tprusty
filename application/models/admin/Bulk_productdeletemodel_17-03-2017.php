<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bulk_productdeletemodel extends CI_Model {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('PHPExcel/Phpexcel_iofactory');
			
	}

	public function search_bulknewprodfordelete()
	{		
		
		$sku_ids=trim(stripslashes(str_replace("/",'',(str_replace("'", "",$this->input->post('sku_txtarea')))))); 	
		
		//$sku_ids=$this->form_validation->set_rules($sku_ids, $sku_ids, 'trim|xss_clean');
		
		if($sku_ids!='')
		{
			$sku_idarrprv=explode(',',$sku_ids);
			
			$sku_idarr=array();
			
			foreach($sku_idarrprv as $skukey=>$skuval)
			{
				$sku_idarr[]="'".$skuval."'";	
			}
			
			$sku_trng=implode(',',$sku_idarr);
			
			/*$qr=$this->db->query("SELECT product_id,sku,name,prod_status,imag FROM cornjob_productsearch WHERE sku IN ($sku_trng) 
			GROUP BY sku ");
			
			if($qr->num_rows()==0)
			{
				$qr=$this->db->query("SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status, c.catelog_img_url AS                                       imag FROM seller_product_master a 
				                       INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
									   INNER JOIN seller_existingproduct_image c ON  c.seller_extproduct_id=a.seller_exist_product_id 
									   WHERE a.sku IN ($sku_trng) GROUP BY a.master_product_id
									    ");	
			}
			
			if($qr->num_rows()==0)
			{
				$qr=$this->db->query("SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status,b.imag                                       FROM seller_product_master a 
				                       INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id									    
									   WHERE a.sku IN ($sku_trng) GROUP BY a.master_product_id
									    ");		
			}
			
			if($qr->num_rows()==0)
			{
				$qr=$this->db->query("SELECT a.seller_product_id AS product_id, a.sku, a.name, b.product_approve AS prod_status, c.catelog_img_url AS imag
										FROM seller_product_general_info a
										INNER JOIN seller_product_setting b ON a.seller_product_id = b.seller_product_id
										INNER JOIN seller_product_image c ON a.seller_product_id = c.seller_product_id
										WHERE a.sku	IN ($sku_trng)  ");	
			}
			*/
			
			/*$qr=$this->db->query("SELECT product_id,sku,name,prod_status,imag FROM cornjob_productsearch WHERE sku IN ($sku_trng) 
			AND sku NOT IN (SELECT sku FROM seller_product_master WHERE sku IN ($sku_trng))	GROUP BY sku ");*/
			
			
			$qr=$this->db->query("SELECT product_id,sku,name,prod_status,imag FROM cornjob_productsearch WHERE sku IN ($sku_trng) 
			GROUP BY sku 
			
			UNION ALL
			
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status, c.catelog_img_url AS                                       imag FROM seller_product_master a 
				                       INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
									   INNER JOIN seller_existingproduct_image c ON  c.seller_extproduct_id=a.seller_exist_product_id 
									   WHERE a.sku IN ($sku_trng) GROUP BY a.master_product_id
									   
			UNION ALL
			
			
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status,b.imag FROM seller_product_master a                       INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id									    
					  WHERE a.sku IN ($sku_trng) GROUP BY a.master_product_id
					  
			UNION ALL
			
			
			SELECT a.seller_product_id AS product_id, a.sku, a.name, b.product_approve AS prod_status, c.catelog_img_url AS imag
										FROM seller_product_general_info a
										INNER JOIN seller_product_setting b ON a.seller_product_id = b.seller_product_id
										INNER JOIN seller_product_image c ON a.seller_product_id = c.seller_product_id
										WHERE a.sku	IN ($sku_trng)		  
									   
			");
			
			
			
			
			
			return $qr;
			
		}else
		{
			echo "Please Enter Valid SKU";exit;
			
		}
			
	}
	
	
	public function searchby_bulknewprodfordelete()
	{
				
		
		//$sku_ids=trim(stripslashes(str_replace("/",'',(str_replace("'", "",$this->input->post('sku_txtarea')))))); 	
		
		$slr_name=$this->input->post('slrname');
		
		$catg_ids=$this->input->post('catgids');
		
		if($catg_ids!='')
		{$catg_ids_string=implode(',',$catg_ids);}
		else
		{$catg_ids_string='';}
		
		$attrbids=$this->input->post('attrb');
		if($attrbids!='')
		{$attrbids_string=implode(',',$attrbids);}
		else
		{$attrbids_string='';}
		
		
			
			$qr=$this->db->query("SELECT product_id,sku,name,prod_status,imag FROM cornjob_productsearch a 
			INNER  JOIN seller_account_information b ON a.seller_id=b.seller_id  WHERE b.business_name LIKE  '%$slr_name%'
			GROUP BY sku LIMIT 1000
			
			UNION ALL
			
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status, c.catelog_img_url AS                                       imag FROM seller_product_master a 
				                       INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
									   INNER JOIN seller_existingproduct_image c ON  c.seller_extproduct_id=a.seller_exist_product_id
									   INNER JOIN  seller_account_information d ON d.seller_id=a.seller_id
									   WHERE d.business_name LIKE  '%$slr_name%' GROUP BY a.master_product_id LIMIT 1000
									   
			UNION ALL
			
			
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status,b.imag FROM seller_product_master a                       INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id
					   INNER JOIN 	seller_account_information c ON a.seller_id=c.seller_id									    
					  WHERE c.business_name LIKE  '%$slr_name%' GROUP BY a.master_product_id LIMIT 1000
					  
			UNION ALL
			
			
			SELECT a.seller_product_id AS product_id, a.sku, a.name, b.product_approve AS prod_status, c.catelog_img_url AS imag
										FROM seller_product_general_info a
										INNER JOIN seller_product_setting b ON a.seller_product_id = b.seller_product_id
										INNER JOIN seller_product_image c ON a.seller_product_id = c.seller_product_id
										INNER JOIN seller_account_information d ON b.seller_id=d.seller_id
										WHERE d.business_name LIKE  '%$slr_name%'	LIMIT 1000	  
									   
			");
			
			
			
			
			
			return $qr;
			
		
			
		
	}
	
	public function validwithinsert_bulkproddelete($excl_filename)
	{		
			set_time_limit(0);
			
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			
				$sku_idarr=array();
				$inputFileName = './bulk_proddeleteexcelsheet/'.$excl_filename;
				
				$inputFileType = Phpexcel_iofactory::identify($inputFileName);
				$objReader = Phpexcel_iofactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load($inputFileName);
			
				$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			
				$arrayCount = count($allDataInSheet);
				
				for($i=2; $i<=$arrayCount; $i++){
					
					if(trim($allDataInSheet[$i]['A'])!='')
							{								
								//$valid_sku=trim($allDataInSheet[$i]['A']);
								$sku_ids=trim(stripslashes(str_replace("/",'',(str_replace("'", "",$allDataInSheet[$i]['A'])))));
								$sku_idarr[]="'".$sku_ids."'";
							}
				}
				
				
			$sku_trng=implode(',',$sku_idarr);
			
			if($sku_trng!='')
			{
				/*$qr=$this->db->query("SELECT product_id,sku,name,prod_status,imag FROM cornjob_productsearch WHERE sku IN ($sku_trng) GROUP BY sku ");*/
				
				
				$qr=$this->db->query("SELECT product_id,sku,name,prod_status,imag FROM cornjob_productsearch WHERE sku IN ($sku_trng) 
			GROUP BY sku 
			
			UNION ALL
			
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status, c.catelog_img_url AS                                       imag FROM seller_product_master a 
				                       INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id 
									   INNER JOIN seller_existingproduct_image c ON  c.seller_extproduct_id=a.seller_exist_product_id 
									   WHERE a.sku IN ($sku_trng) GROUP BY a.master_product_id
									   
			UNION ALL
			
			
			SELECT a.seller_exist_product_id AS product_id, a.sku, b.name, a.approve_status AS prod_status,b.imag FROM seller_product_master a                       INNER JOIN  cornjob_productsearch b ON a.master_product_id=b.product_id									    
					  WHERE a.sku IN ($sku_trng) GROUP BY a.master_product_id
					  
			UNION ALL
			
			
			SELECT a.seller_product_id AS product_id, a.sku, a.name, b.product_approve AS prod_status, c.catelog_img_url AS imag
										FROM seller_product_general_info a
										INNER JOIN seller_product_setting b ON a.seller_product_id = b.seller_product_id
										INNER JOIN seller_product_image c ON a.seller_product_id = c.seller_product_id
										WHERE a.sku	IN ($sku_trng)		  
									   
			");
			
				
				
				
				
				return $qr;
			}
			else
			{
				echo "Please Enter Valid SKU";exit;
			
			}
		
	}
	
	
	function delete_bulkselectedproduct()
	{set_time_limit(0);
	  
	  $prodskuarr=$this->input->post('productsku');
	  
	   //$prodskuarr=$this->input->post('order_id_chk'); //order_id_chk
	$this->db->query("UPDATE product_process_status SET prod_delete='process' where status_id='1' ");	
	$ctr_prod=count($prodskuarr);
	if($ctr_prod>0)	
	{	foreach($prodskuarr as $skukey=>$skuval)
		{ $sl_sku=$skuval;
		  $product_iddelete='';	
		//=================================================Old product data and image delete start=============================================//
			//$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
				$qr_slroldprodinfo=$this->db->query("SELECT seller_product_id FROM seller_product_general_info WHERE sku='$sl_sku' group by sku ");
				
				if($qr_slroldprodinfo->num_rows()>0)
				{
						$seller_oldproductid=$qr_slroldprodinfo->row()->seller_product_id;
						$product_iddelete=$seller_oldproductid;
						//-------------------------------------image delete from folder start---------------------------//
						$slr_prodimagequery=$this->db->query("SELECT * FROM seller_product_image WHERE seller_product_id='$seller_oldproductid' ");
						
						if($slr_prodimagequery->num_rows()>0)
						{
							$slr_oldallimageinfo=$slr_prodimagequery->row()->image;
							$slr_oldcatalogimage=$slr_prodimagequery->row()->catelog_img_url;							
							 
							 $all_sellerdbimgarr=array();
							 $all_sellerdbimgarr=explode(',', $slr_oldallimageinfo);
							 							 
							 $output_dir = "./images/product_img/";
							 	
							 for($img_ctr=0; $img_ctr<count($all_sellerdbimgarr); $img_ctr++)
							 {
								$remove_imagename=$all_sellerdbimgarr[$img_ctr];
								
								if($img_ctr==0 && $slr_oldcatalogimage!='')	
								{	
									
									$filePath = $output_dir.$slr_oldcatalogimage;
									if(file_exists(trim($filePath)))						
									{unlink($filePath);}
								}
								else
								{
										if($remove_imagename!='')
										{	$filePath = $output_dir.'original_'.$remove_imagename;						
											if(file_exists(trim($filePath)))						
											{unlink($filePath);}
											
											$filePath = $output_dir.$remove_imagename;						
											if(file_exists(trim($filePath)))						
											{unlink($filePath);}
											
											$filePath = $output_dir.'2000x2000_'.$remove_imagename;						
											if(file_exists(trim($filePath)))						
											{unlink($filePath);}
											
											$filePath = $output_dir.'thumbnil_'.$remove_imagename;						
											if(file_exists(trim($filePath)))						
											{unlink($filePath);}
										} // if image name not blank
									
								}
										 
							 }		
							
							
						
						}
						//-------------------------------------image delete from folder end---------------------------//
						
						
						
						//-----------------------Seller Product Data Delete from all seller Table start------------------------------//
							//$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
							
								
							$this->db->query("DELETE FROM seller_product_attribute_value WHERE sku='$sl_sku' ");
							$this->db->query("DELETE FROM seller_product_category WHERE seller_product_id='$seller_oldproductid' ");
							$this->db->query("DELETE FROM seller_product_image WHERE seller_product_id='$seller_oldproductid' ");
							$this->db->query("DELETE FROM seller_product_inventory_info WHERE seller_product_id='$seller_oldproductid' ");
							$this->db->query("DELETE FROM seller_product_meta_info WHERE seller_product_id='$seller_oldproductid' ");
							$this->db->query("DELETE FROM seller_product_price_info WHERE seller_product_id='$seller_oldproductid' ");
							$this->db->query("DELETE FROM seller_product_setting WHERE seller_product_id='$seller_oldproductid' ");
							$this->db->query("DELETE FROM seller_product_general_info WHERE sku='$sl_sku' ");
							
						//-----------------------Seller Product Data Delete from all seller Table end------------------------------//
				}
				
				//**************************************************************************************************************************//
				
					//-------------------------------------Existing Product image delete from folder start---------------------------//
						//$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
						$slr_extprodquery=$this->db->query("SELECT seller_exist_product_id FROM seller_product_master WHERE sku='$sl_sku' ");
						
						if($slr_extprodquery->num_rows()>0)
						{
							$selr_extproductid=$slr_extprodquery->row()->seller_exist_product_id;
							$product_iddelete=$selr_extproductid;
							
							$slr_prodimagequery=$this->db->query("SELECT * FROM seller_existingproduct_image 
																   WHERE seller_extproduct_id='$selr_extproductid' ");
							if($slr_prodimagequery->num_rows()>0)
							{
											$slr_oldallimageinfo=$slr_prodimagequery->row()->image;
											$slr_oldcatalogimage=$slr_prodimagequery->row()->catelog_img_url;							
											 
											 $all_sellerdbimgarr=array();
											 $all_sellerdbimgarr=explode(',', $slr_oldallimageinfo);
																		 
											 $output_dir = "./images/product_img/";
												
											 for($img_ctr=0; $img_ctr<count($all_sellerdbimgarr); $img_ctr++)
											 {
												$remove_imagename=$all_sellerdbimgarr[$img_ctr];
												
												if($img_ctr==0 && $slr_oldcatalogimage!='')	
												{	
													$filePath = $output_dir.$slr_oldcatalogimage;
													if(file_exists(trim($filePath)))						
													{unlink($filePath);}
												}
												else
												{
													if($remove_imagename!='')
													{	   
															$filePath = $output_dir.'original_'.$remove_imagename;						
															if(file_exists(trim($filePath)))						
															{unlink($filePath);}
															
															$filePath = $output_dir.$remove_imagename;						
															if(file_exists(trim($filePath)))						
															{unlink($filePath);}
															
															$filePath = $output_dir.'2000x2000_'.$remove_imagename;						
															if(file_exists(trim($filePath)))						
															{unlink($filePath);}
															
															$filePath = $output_dir.'thumbnil_'.$remove_imagename;						
															if(file_exists(trim($filePath)))						
															{unlink($filePath);}
															
													} // if image not blank condition end
														
												}
														 
											 }
							} // existing product image table query count greater than zero condition end
							
							
							//$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
							$this->db->query("DELETE FROM seller_existingproduct_image WHERE seller_extproduct_id='$selr_extproductid' ");
							$this->db->query("DELETE FROM seller_product_master WHERE sku='$sl_sku' ");
							
							$this->db->query("DELETE FROM seller_product_attribute_value WHERE sku='$sl_sku' ");
							$this->db->query("DELETE FROM color_attr WHERE sku_id='$sl_sku' ");
							$this->db->query("DELETE FROM size_attr WHERE sku_id='$sl_sku' ");
							
						}
														
						//-------------------------------------Existing Product image delete from folder end---------------------------//
						
						
				
				//**************************************************************************************************************************//
				
				
				
				
				$qr_masteroldprodinfo=$this->db->query("SELECT product_id FROM product_master WHERE sku='$sl_sku' group by sku ");
				
				if($qr_masteroldprodinfo->num_rows()>0)
				{
						$master_oldproductid=$qr_masteroldprodinfo->row()->product_id;
						$product_iddelete=$master_oldproductid;
						//-----------------------Master Product Data Delete from all seller Table start------------------------------//							
							//$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
							$this->db->query("DELETE FROM product_category WHERE product_id='$master_oldproductid' ");							
							$this->db->query("DELETE FROM product_general_info WHERE product_id='$master_oldproductid' ");							
							$this->db->query("DELETE FROM product_image WHERE product_id='$master_oldproductid' ");							
							$this->db->query("DELETE FROM product_setting WHERE product_id='$master_oldproductid' ");							
							$this->db->query("DELETE FROM product_master WHERE sku='$sl_sku' ");							
							$this->db->query("DELETE FROM product_meta_info WHERE product_id='$master_oldproductid' ");
							
							$this->db->query("DELETE FROM color_attr WHERE sku_id='$sl_sku' ");
							$this->db->query("DELETE FROM size_attr WHERE sku_id='$sl_sku' ");
							
							$this->db->query("DELETE FROM cornjob_productsearch WHERE sku='$sl_sku' ");
						//-----------------------Master Product Data Delete from all seller Table end------------------------------//
						
				}
				
			//=================================================Old product data and image delete end=============================================//
				//$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
				$data_log=array();
				$data_log=array(
				'product_id'=>$product_iddelete,
				'sku'=>$sl_sku
			
			);
			$this->db->insert('bulk_proddeletelog',$data_log);
	
			} // main for loop end
			
			
	
		} // main if conditiond end
		$this->db->query("UPDATE product_process_status SET prod_delete='not process' where status_id='1' ");
	} // main function end 
	
	
	
	public function select_orderdetail($order_sku)
	{
		
		$qr=$this->db->query("SELECT order_id,product_order_status FROM ordered_product_from_addtocart WHERE sku='$order_sku' ");	
		
		return $qr;
	
	}
	
	public function select_wishlistdetail($wishlist_sku)
	{
		$qr=$this->db->query("SELECT b.email,a.user_id,a.sku FROM wishlist a INNER JOIN user b ON a.user_id=b.user_id WHERE a.sku='$wishlist_sku' ");	
		
		return $qr;	
	}
	
	public function select_cartdetail($cart_sku)
	{
		$qr=$this->db->query("SELECT b.email,a.user_id,a.sku FROM addtocart_temp a INNER JOIN user b ON a.user_id=b.user_id WHERE a.sku='$cart_sku'  ");	
		
		return $qr;	
	}
	
	public function select_skudetail($ext_prodid)
	{
		$prodtype_qr=$this->db->query("SELECT sku FROM seller_product_master WHERE	master_product_id='$ext_prodid' ");
		
		return $prodtype_qr;	
	}
	
	public function select_allcategory()
	{
		$qr=$this->db->query("SELECT DISTINCT lvl2, lvl2_name, lvl1, lvl1_name , lvlmain_name FROM temp_category WHERE lvl1 !=0");
		return $qr;	
	}
	
	public function select_allattrb()
	{
		return $query=$this->db->query("SELECT * FROM attribute_group ");	
	}
		
}
?>