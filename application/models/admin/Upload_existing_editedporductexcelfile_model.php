<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_existing_editedporductexcelfile_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
		
		$this->load->model('PHPExcel/Phpexcel_iofactory');
			
	}
	
	function validwithinsert_existingeditedproductbulkupload($excl_filename)
	{
		
		
			set_time_limit(0);
			//$this->db->trans_start();
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			$rowsdata=array();
			
			date_default_timezone_set('Asia/Calcutta');
			$dt = date('Y-m-d H:i:s');
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			$parent_query=$this->db->query("SELECT * FROM bulkexisting_editprodtemplatelog WHERE excelfile_name='$excl_filename' AND status='Active' AND downlaod_parentid > 0 ");
			
			if($parent_query->num_rows()>0)
			{
						$rw_parentfileid=$parent_query->row();
						$parent_downlaodfileid=$rw_parentfileid->downlaod_parentid;
						
						if($parent_downlaodfileid>0)
						{ 
							$parent_filenamequery=$this->db->query("SELECT * FROM bulkexisting_editprodtemplatelog WHERE blk_tempid='$parent_downlaodfileid' AND (status='Expired' OR  status='Active' )");
							//$excl_filename=$rw_parentfileid->excelfile_name; 
							//$this->db->query("UPDATE bulkprod_templatelog SET status='Active' WHERE  blk_tempid='$parent_downlaodfileid'");
							$masteruploadprod_uid=$parent_filenamequery->row()->blk_tempid;
							$this->db->query("DELETE FROM  bulk_existing_editedproductupload_log WHERE uploadprod_uid='$parent_downlaodfileid' AND qc_status='Failed' AND master_productid!='' ");
							
							$this->db->query("DELETE FROM  bulk_existing_editedproductupload_log WHERE uploadprod_uid='$parent_downlaodfileid' AND (upload_status='Pending' OR upload_status='Failed') AND master_productid!='' ");
							
						}
			} 
			else
			{
				$parent_downlaodfileid=0;
				//$excl_filename=$excl_filename;	
			}
	
			$maximumupload_id = $this->get_maximum_id('bulkexisting_editprodtemplatelog', 'upload_id');
			
			if($parent_downlaodfileid>0)
			{
				
				$upload_sequenceid=$parent_downlaodfileid;
			}
			else
			{
				$upload_sequenceid=0;	
			}
			$upload_dtime=$dt;
			
					
			
			$seller_id=$this->input->post('hdntxt_sellerid');
			
			$attrbset_query=$this->db->query("SELECT * FROM bulkexisting_editprodtemplatelog WHERE excelfile_name='$excl_filename' AND seller_id='$seller_id' AND status='Active' ");
			
			
			
			if($attrbset_query->num_rows()==0)
			{
						$excl_filename=$excl_filename;
		
						$output_dir = "./bulk_existingeditedproductexcel/";						
						$filePath = $output_dir.$excl_filename;
						unlink($filePath);
				echo "<span style='text-align:center; color:#F00' > <img src=". base_url().'images/error.png'. ">Invalid File </span>";exit;
			}
			
			if($attrbset_query->num_rows()>0)
			{
				
				$attrbset_res=$attrbset_query->row();
				$dbsexcel_filename=$excl_filename;
				
				if($parent_downlaodfileid>0)
				{
					$uploadprod_uid=$masteruploadprod_uid;
				}else
				{
					$uploadprod_uid=$attrbset_query->row()->blk_tempid;
				}
				$this->db->query("UPDATE bulkexisting_editprodtemplatelog SET upload_id='$maximumupload_id', upload_sequenceid='$upload_sequenceid', upload_dtime='$upload_dtime' WHERE  blk_tempid='$attrbset_res->blk_tempid' ");
			
				$inputFileName = './bulk_existingeditedproductexcel/'.$excl_filename;
				
				$inputFileType = Phpexcel_iofactory::identify($inputFileName);
				$objReader = Phpexcel_iofactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load($inputFileName);
			
			//$objPHPExcel = Phpexcel_iofactory::load($inputFileName);
	 	

			$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			
			$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel
			
			
			
			//echo $arrayCount; exit;
			$valid_rows=0;
			$invalid_rows=0;
			
				//$seller_id=$this->input->post('hdntxt_sellerid');
				$attrbset_query=$this->db->query("SELECT * FROM bulkexisting_editprodtemplatelog WHERE excelfile_name='$excl_filename' ");
				$attrbset_res=$attrbset_query->row();
			
				$attrbset_id=$attrbset_res->attribute_set;
				$category_id=$attrbset_res->category_id;
			
			// attribute id & value list start
			
				$attr_heading_result = $this->db->query("SELECT * FROM attributes WHERE attribute_group_id='$attrbset_id'");
				
				$attr_fld_name=array();
				$attr_id=array();
				
				foreach($attr_heading_result->result_array() as $attr_heading_row){
					
					$attr_hedingid=$attr_heading_row['attribute_heading_id'];
					
					$query_attrbreal = $this->db->query("SELECT * FROM attribute_real WHERE attribute_heading_id=$attr_hedingid ");
					$field_result = $query_attrbreal->result_array();
					
					foreach($field_result as $attr_fld_row)
					{	$attribute_field_name=$attr_fld_row['attribute_field_name'];
					
						 if(($attribute_field_name=='Color' || $attribute_field_name=='color' || $attribute_field_name=='COLOR' )
							|| ($attribute_field_name=='size' || $attribute_field_name=='Size' || $attribute_field_name=='SIZE') 
		 					|| ($attribute_field_name=='Capacity' || $attribute_field_name=='capacity' || $attribute_field_name=='CAPACITY' ) 
							||  ($attribute_field_name=='RAM' || $attribute_field_name=='Ram' || $attribute_field_name=='ram')
							|| ($attribute_field_name=='ROM' || $attribute_field_name=='Rom' || $attribute_field_name=='rom'))
						 {
							 $attr_fld_name[]=$attr_fld_row['attribute_field_name'];
							 $attr_id[]=$attr_fld_row['attribute_id'];
						 }
						
					} // attribute field name inner forloop end
					
				}
				
					// attribute heading name inner forloop end
					
			// attribute id & value list end
			
			
			
			//Dynamically access of column address from excel sheet  start
			
					$attrb_countforexlcoulmn=count($attr_id)+1;
					$attrb_exlcoulmnname=array();
					$sheet = $objPHPExcel->getSheet(0);
					
					$highestRow = $sheet->getHighestRow(); 
					$highestColumn = $sheet->getHighestColumn();
					$highestColumn++;
					$c=24; 
					$row = '2';
						
							for($col = 1; $col != $attrb_countforexlcoulmn; $col++){
								
							  $cell = $sheet->getCellByColumnAndRow($c, $row);
							  $colIndex = PHPExcel_Cell::columnIndexFromString($cell->getColumn());
							  $attrb_exlcoulmnname[]=$cell->getColumn();
							  // echo $cell->getColumn().'<br>';
								$c++;
						  }
						
		//Dynamically access of column address from excel sheet  end
		
		
		//----------------------all attribute fieldbane access start---------------------------//
		
		
			$attrbid_master=array();
			$attrbname_master=array();
			$attr_id_n_valuemaster=array();
			
			$query_masterattrbreal = $this->db->query("SELECT * FROM attribute_real WHERE attribute_group_id='$attrbset_id' ");
			foreach($query_masterattrbreal->result_array() as $res_atrbmaster)
			{	$attrbid_master[]=$res_atrbmaster['attribute_id'];
				$attrbname_master[]=$res_atrbmaster['attribute_field_name'];
				
				
			}
			
			$attr_id_n_valuemaster = array_combine($attrbid_master,$attrbname_master);
		
		//----------------------all attribute fieldbane access end---------------------------//
		
		
			
			$sl=1;
			$qcfailed_resason=array();
			for($i=3; $i<=$arrayCount; $i++){
				
				$newattr_id=array();
				$newattr_value=array();
				$newattr_fld_name=array();
				$attr_id_n_value = array();				
				$attr_id_n_value_length = 0;
				$attr_value=array();
				$qcfailed_resason=array();
				$data_prodinfo=array();
				
						
						//---------------------------------------Seller Product  Data Insert Start--------------------------------------------------------- 		
								
							if(trim($allDataInSheet[$i]['E'])!='' && trim($allDataInSheet[$i]['G'])!='')
							{
								$moonboy_slno="MB".$uploadprod_uid.$sl;
								$valid_editstatus=trim($allDataInSheet[$i]['D']);
								$valid_productid=trim($allDataInSheet[$i]['E']);
								$valid_prodname=trim($allDataInSheet[$i]['F']);
								$valid_sku=trim($allDataInSheet[$i]['G']);
								//$valid_prodname=trim($allDataInSheet[$i]['F']);
								//$valid_proddecrp=trim($allDataInSheet[$i]['G']);
								$valid_mrp=trim($allDataInSheet[$i]['H']);		
								$valid_sellingprice=trim($allDataInSheet[$i]['I']);
								$valid_quantity=trim($allDataInSheet[$i]['M']);
								$valid_tax=trim($allDataInSheet[$i]['N']);
								$valid_weight=trim($allDataInSheet[$i]['O']);
								
								$valid_imageurl1=trim($allDataInSheet[$i]['P']);
								$valid_imageurl2=trim($allDataInSheet[$i]['Q']);
								$valid_imageurl3=trim($allDataInSheet[$i]['R']);
								$valid_imageurl4=trim($allDataInSheet[$i]['S']);
								$valid_imageurl5=trim($allDataInSheet[$i]['T']);
								
								
								
								$valid_shipfeetype=trim($allDataInSheet[$i]['U']);
								$valid_shipfeeamount=trim($allDataInSheet[$i]['V']);
								$valid_status=trim($allDataInSheet[$i]['W']);
								
								/*$valid_prodhlght1=trim($allDataInSheet[$i]['X']);
								$valid_prodhlght2=trim($allDataInSheet[$i]['Y']);
								$valid_prodhlght3=trim($allDataInSheet[$i]['Z']);
								$valid_prodhlght4=trim($allDataInSheet[$i]['AA']);
								$valid_prodhlght5=trim($allDataInSheet[$i]['AB']);*/
								
								$valid_specialprice=trim($allDataInSheet[$i]['J']);
								$valid_specialprc_fromdate=trim($allDataInSheet[$i]['K']);
								$valid_specialprice_todate=trim($allDataInSheet[$i]['L']);
								
								$valid_countrymfg=trim($allDataInSheet[$i]['X']);
								
								/*$valid_metatitle=trim($allDataInSheet[$i]['AD']);
								$valid_metakeyword=trim($allDataInSheet[$i]['AE']);
								$valid_metadescrp=trim($allDataInSheet[$i]['AF']);*/
								
								if($valid_productid=='')
								{array_push($qcfailed_resason,"Productid Blank");}
								
								if($valid_sku=='')
								{array_push($qcfailed_resason,"SKU Blank");}
								
								/*if($valid_prodname=='')
								{array_push($qcfailed_resason,"Product Name Blank");}*/
								
								/*if($valid_proddecrp=='')

								{array_push($qcfailed_resason,"Decription Blank");}	*/	
								
								if($valid_mrp=='')
								{array_push($qcfailed_resason,"MRP Blank");}
								
								/*if($valid_mrp!='')
								{	
									//$mrp_vald=var_dump($valid_mrp !== (int)$valid_mrp);
									if($valid_mrp !== (int)$valid_mrp)
									{array_push($qcfailed_resason,"Invalid MRP");}
									
									if($valid_sellingprice!='' && $valid_sellingprice>$valid_mrp)
									{array_push($qcfailed_resason,"Selling Price is greater than MRP");}				
									
								}*/
								
								if($valid_sellingprice=='')
								{array_push($qcfailed_resason,"Selling Price Blank");}
								
								/*if($valid_sellingprice!='')
								{
									//$sel_pricevld=var_dump($valid_sellingprice !== (int)$valid_sellingprice);
									if($valid_sellingprice !== (int)$valid_sellingprice)
									{array_push($qcfailed_resason,"Invalid Selling Price");}
									
									if($valid_specialprice!='' && $valid_specialprice>$valid_sellingprice)
									{array_push($qcfailed_resason,"Special Price is greater than Selling Price");}
									
									
								}*/
								$date_regex = '/^(19|20)\d\d[\-\/.](0[1-9]|1[012])[\-\/.](0[1-9]|[12][0-9]|3[01])$/';
								$tm_arr=array();
								$tm_arrreverse=array();
								$tm_arrreverse_strg="";
								if($valid_specialprc_fromdate!='' && $valid_specialprc_fromdate!='0000-00-00')
								{
									
									
									$tm_arr=explode('-',$valid_specialprc_fromdate);
									$tm_arrreverse=array_reverse($tm_arr);
									$tm_arrreverse_strg=implode('-',$tm_arrreverse);
									
									$splprice_frdtcreate=date_create($tm_arrreverse_strg,timezone_open("Asia/Kolkata"));
									$splprice_fr_dt=date_format($splprice_frdtcreate,'Y-d-m');
									
									
									if(!preg_match($date_regex, $splprice_fr_dt)) 
									{ //to check the date
										//$value=$valid_specialprc_fromdate->getFormattedValue();
										//array_push($qcfailed_resason,"Special price from date is invalid");
										//$splprice_fromdatestatus="wrong";
										
										$splprice_fromdatestatus="ok";
										
									}
									else
									{
											$splprice_fromdatestatus="ok";
									}
								}else
								{$splprice_fromdatestatus='';}
								
								$tm_arr1=array();
								$tm_arrreverse1=array();
								$tm_arrreverse_strg1="";
								if($valid_specialprice_todate!='' && $valid_specialprice_todate!='0000-00-00')
								{
									$tm_arr1=explode('-',$valid_specialprice_todate);
									$tm_arrreverse1=array_reverse($tm_arr);
									$tm_arrreverse_strg1=implode('-',$tm_arrreverse1);
									
									$splprice_todtcreate=date_create($tm_arrreverse_strg1);
									$splprice_to_dt=date_format($splprice_todtcreate,'Y-m-d');
									
										if(!preg_match($date_regex, $splprice_to_dt))
										{ //to check the date
											//$value=$valid_specialprice_todate->getFormattedValue();
											//array_push($qcfailed_resason,"Special price to date is invalid");
											//$splprice_toatestatus="wrong";
											
											$splprice_toatestatus="ok";
											
										}
										else
										{
												$splprice_toatestatus="ok";
										}
								
								}else
								{$splprice_fromdatestatus='';}
								
								//if($valid_specialprice!='' & $splprice_fromdatestatus=="ok" &&  $splprice_toatestatus=="ok")
								//{
									//$special_pricevld=var_dump($valid_specialprice !== (int)$valid_specialprice);
									/*if($valid_specialprice !== (int)$valid_specialprice)
									{array_push($qcfailed_resason,"Invalid Special Price");}*/
									
									//if($splprice_fr_dt > $splprice_to_dt)
									//{array_push($qcfailed_resason,"Special Date Range is invalid");}
								//}
								
								if($valid_quantity=='')
								{array_push($qcfailed_resason,"Quantity Blank");}
								
								/*if($valid_quantity!='')
								{//$qnt_vald=var_dump($valid_quantity !== (int)$valid_quantity);								
									if($valid_quantity !== (int)$valid_quantity)
									{array_push($qcfailed_resason,"Invalid Quantity Value");}
								}*/
									
								if($valid_tax=='')
								{array_push($qcfailed_resason,"VAT/CST Blank");}	
								
								/*if($valid_tax!='')
								{	
								//$tax_vald=var_dump($valid_tax !== (int)$valid_tax);
									if($valid_tax !== (int)$valid_tax)
									{array_push($qcfailed_resason,"Invalid Tax Value");}
								}*/
								
								if($valid_weight=='')	
								{array_push($qcfailed_resason,"Wight Blank");}
								
								if($valid_editstatus=='')	
								{array_push($qcfailed_resason,"Edit Status not selevted");}		
								
								/*if($valid_weight!='')
								{	
								//$weight_vald=var_dump($valid_weight !== (int)$valid_weight);
									if($valid_weight !== (int)$valid_weight)
									{array_push($qcfailed_resason,"Invalid Weight Value");}		
								}*/
								
							/*if($valid_prodhlght1=='' && $valid_prodhlght2=='' &&  $valid_prodhlght3=='' && $valid_prodhlght4=='' && $valid_prodhlght5=='')
								{	//$valid_prodhlighcell='';
									array_push($qcfailed_resason,"Product Highlights Blank");
								}*/
								//else
								//{$valid_prodhlighcell="Product Highlight Exist in any one cell"; }
								
								
								/*if($valid_imageurl1=='' && $valid_imageurl2=='' &&  $valid_imageurl3=='' && $valid_imageurl4=='' && $valid_imageurl5=='')
								{	$valid_imagecell='';
									array_push($qcfailed_resason,"Image URL Blank");
								}*/
								//else
					//			{$valid_imagecell="Image URL Exist in any one cell";}
								
								//$valid_rows=0;
								//$invalid_reows=0;
								//
					//					if($valid_sku=='' || $valid_prodname=='' || $valid_proddecrp=='' || $valid_mrp=='' || $valid_sellingprice=='' || $valid_quantity=='' || $valid_tax=='' || $valid_weight=='' || $valid_imagecell=='' || $valid_shipfeetype=='' || $valid_shipfeeamount=='' || $valid_status=='' || $valid_prodhlighcell=='')
										
										if(count($qcfailed_resason)>0)
										
										 {
											$invalid_rows=$invalid_rows+1;
											$qc_status="Failed";
										}
										else
										{	$qc_status="Passed";
											$valid_rows=$valid_rows+1;
											
										}
										
										
			//----------------------------------------------Data Insert in bulkproductupload_log start---------------------------------------//
												
										foreach($attrb_exlcoulmnname as $katrb=>$vattrbval)
										{
												$attrb_staticcolumn=@$allDataInSheet[2][$vattrbval];
													
											if((
											($attrb_staticcolumn=='Color' || $attrb_staticcolumn=='color' || $attrb_staticcolumn=='COLOR' )
												|| ($attrb_staticcolumn=='size' || $attrb_staticcolumn=='Size' || $attrb_staticcolumn=='SIZE') 
												|| ($attrb_staticcolumn=='Capacity' || $attrb_staticcolumn=='capacity' || $attrb_staticcolumn=='CAPACITY' ) 
												||  ($attrb_staticcolumn=='RAM' || $attrb_staticcolumn=='Ram' || $attrb_staticcolumn=='ram')
												|| ($attrb_staticcolumn=='ROM' || $attrb_staticcolumn=='Rom' || $attrb_staticcolumn=='rom')
												) && trim(@$allDataInSheet[$i][$vattrbval])=='' )											
												{
													//$valid_productid
													$qr_attrbbalnk=$this->db->query("SELECT * FROM cornjob_productsearch WHERE product_id='$valid_productid' group by sku ");
													if($attrb_staticcolumn=='Color' || $attrb_staticcolumn=='color' || $attrb_staticcolumn=='COLOR')																								
														{$attrb_blankvalue=$qr_attrbbalnk->row()->color;}
													if($attrb_staticcolumn=='size' || $attrb_staticcolumn=='Size' || $attrb_staticcolumn=='SIZE')
														{$attrb_blankvalue=$qr_attrbbalnk->row()->size;}
													if($attrb_staticcolumn=='Capacity' || $attrb_staticcolumn=='capacity' || $attrb_staticcolumn=='CAPACITY')
														{$attrb_blankvalue=$qr_attrbbalnk->row()->Capacity;}
													if($attrb_staticcolumn=='RAM' || $attrb_staticcolumn=='Ram' || $attrb_staticcolumn=='ram')
														{$attrb_blankvalue=$qr_attrbbalnk->row()->RAM;}
													if($attrb_staticcolumn=='ROM' || $attrb_staticcolumn=='Rom' || $attrb_staticcolumn=='rom')
														{$attrb_blankvalue=$qr_attrbbalnk->row()->ROM;}
													
													$attr_value[]=$attrb_blankvalue;	
														
												}else
												{	
													$attr_value[]=trim(@$allDataInSheet[$i][$vattrbval]);
												}
										}
							
											$ctr_attrid=count($attr_id);
											$incrattb=0;
												
											foreach($attr_value as $keyattvl=>$valattrvalue)
											{
												if($valattrvalue!='' && $incrattb<$ctr_attrid)
												{
													$newattr_id[]=$attr_id[$incrattb];
													$newattr_value[]=$valattrvalue;
													$newattr_fld_name[]=$attr_fld_name[$incrattb];	
												}
												$incrattb++;
														
											}
											
											
											
											$newattr_idmodf=array();
											$newattr_valuemodf=array();
											
											for($attrbfld_chk=0; $attrbfld_chk<count($newattr_id); $attrbfld_chk++)
											{
													foreach($attr_id_n_valuemaster as $kyattrb_master=>$attrbval_master)
													{	
														$vattrbval=$attrb_exlcoulmnname[$attrbfld_chk];
														
														$attrb_staticcolumn2=@$allDataInSheet[2][$vattrbval];
														
														if($attrb_staticcolumn2==$attrbval_master)
														{
															$newattr_idmodf[]=$kyattrb_master;
															$newattr_valuemodf[]=$newattr_value[$attrbfld_chk];break;
														}	
													}
											}	
									
											
											
											//$attr_id_n_value = array_combine($newattr_id,$newattr_value);
											
											$attr_id_n_value = array_combine($newattr_idmodf,$newattr_valuemodf);
							
											$attrid_n_valueserialz=serialize($attr_id_n_value);
										 
					//----------------------------------------------Data Insert in bulkproductupload_log end---------------------------------------//
										$prodqc_status='';	
										if(count($qcfailed_resason)>0)
										{
											$prodqc_status=serialize($qcfailed_resason);
										}
										else
										{
											$prodqc_status='';
										}
										
									
											$data_prodinfo=array(
													'uploadprod_uid'=> $uploadprod_uid,
													'moonboy_slno'=> $moonboy_slno,
													'qc_status'=>$qc_status,
													'qc_failedreason'=>$prodqc_status,
													'editstatus'=>$valid_editstatus,													
													'sku'=>$valid_sku,
													'prod_name'=>$valid_prodname, 											
													'mrp'=>$valid_mrp,
													'sell_price'=>$valid_sellingprice,
													'special_price'=>$valid_specialprice,
													'splprice_fromdt'=>$valid_specialprc_fromdate,
													'splprice_todate'=>$valid_specialprice_todate,
													'quantity'=>$valid_quantity,
													'vat_cst'=>$valid_tax,
													'weight'=>$valid_weight,
													'image_url1'=>$valid_imageurl1,
													'image_url2'=>$valid_imageurl2,
													'image_url3'=>$valid_imageurl3,
													'image_url4'=>$valid_imageurl4,
													'image_url5'=>$valid_imageurl5,
													'shipfee_type'=>$valid_shipfeetype,
													'shipfee_amount'=>$valid_shipfeeamount,
													'status'=>$valid_status,													
													'country_mafg'=>$valid_countrymfg,													
													'attrb_groupuid'=>$attrbset_id,
													'attrb_valueandid'=>$attrid_n_valueserialz,
													'upload_dtime'=>$dt,
													'upload_status'=>'Pending',
													'master_productid'=>$valid_productid  
													);
													
											$this->db->insert('bulk_existing_editedproductupload_log',$data_prodinfo);
										
										$sl++;
								}
									
									
			} // main for loop end
					
					//$records_array[]=$invalid_rows;
					//$records_array[]=$valid_rows;
					
					//return 	$records_array;
					//echo $invalid_rows." "; echo  $sl;exit;
					
					/*if(($sl-1)==$invalid_rows)
					{
						$this->db->query("DELETE FROM bulkproductupload_log WHERE uploadprod_uid='$uploadprod_uid' ");
						
						$excl_filename=$excl_filename;
		
						$output_dir = "./bulkproduct_excel/";						
						$filePath = $output_dir.$excl_filename;
						unlink($filePath);	
					}*/
					//$this->db->trans_complete();
					return $uploadprod_uid; 
				
						
			}
				//---------------------------------checking of validation of excel sheet field end-----------------------------				
			else
			{
				 //$records_array[]="File has expired";
				 $file_staus="Invalid File";
				 
				// return $records_array;
				//$this->db->trans_complete();
				  return $file_staus;
			}
			
	
			
	}
	
	
	function get_maximum_id($table, $field){
		$query = $this->db->query("SELECT MAX($field) AS `maxid` FROM ".$table);
		$maxId = $query->row()->maxid;
		$id = $maxId+1;
		return $id;
	}
	
	
	//------------------------------------------Upload existing product after validation start---------------------------------------//
	
	function update_existing_editedprod_bulkuploadafterconf($excelfiluploadid)
	{
		
		set_time_limit(0);
		//error_reporting(E_ALL);
		//ini_set('display_errors', 1);
		//$this->db->trans_start();
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			date_default_timezone_set('Asia/Calcutta');
			$dt = date('Y-m-d H:i:s');
	
		$qr_filetempdata=$this->db->query("SELECT * FROM bulkexisting_editprodtemplatelog WHERE blk_tempid='$excelfiluploadid' ");
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
						$attribute_field_name=$attr_fld_row['attribute_field_name'];
					
						  if(($attribute_field_name=='Color' || $attribute_field_name=='color' || $attribute_field_name=='COLOR' )
							|| ($attribute_field_name=='size' || $attribute_field_name=='Size' || $attribute_field_name=='SIZE') 
		 					|| ($attribute_field_name=='Capacity' || $attribute_field_name=='capacity' || $attribute_field_name=='CAPACITY' ) 
							||  ($attribute_field_name=='RAM' || $attribute_field_name=='Ram' || $attribute_field_name=='ram')
							|| ($attribute_field_name=='ROM' || $attribute_field_name=='Rom' || $attribute_field_name=='rom'))
						 	{
						 
							 	$attr_fld_name[]=$attr_fld_row['attribute_field_name'];
							 	$attr_id[]=$attr_fld_row['attribute_id'];
						 	}
						
					} // attribute field name inner forloop end
					
				}
				
					// attribute heading name inner forloop end
					
			// attribute id & value list end
		
		
		
		
		$qr_filedata=$this->db->query("SELECT * FROM bulk_existing_editedproductupload_log WHERE uploadprod_uid='$excelfiluploadid' AND qc_status='Passed' AND upload_status='Pending' AND master_productid!='' AND editstatus='Edited'  ");
		$res_filedata=$qr_filedata->result_array();
		
			$allextprod_sku=array();
			$allextslrproduct_id=array();
			$allexitprod_colorarray=array();
		
		//--------------------------------Main forloop Product Data insert start-------------------------
		foreach($res_filedata as $rw_filedata)
		{
			$image='';
			$imag=array();
			$product_info=array();
			$editedprod_sku=$rw_filedata['sku'];
			
			$allextprod_sku[]=$rw_filedata['sku'];
			
			$sku_slrprod=$rw_filedata['sku'];
			
			$qr_slr_extprod_id=$this->db->query("SELECT seller_exist_product_id FROM seller_product_master WHERE sku='$sku_slrprod' ");
			
			if($qr_slr_extprod_id->num_rows()>0)
			{
				$allextslrproduct_id[]=$qr_slr_extprod_id->row()->seller_exist_product_id;
			
				$seller_exist_product_id=$qr_slr_extprod_id->row()->seller_exist_product_id;
			}
			else
			{
				$qr_slr_extprod_id=$this->db->query("SELECT seller_product_id FROM seller_product_general_info WHERE sku='$sku_slrprod' ");
				
				$seller_exist_product_id=$qr_slr_extprod_id->row()->seller_product_id;	
			}
			
			$image_data=array();
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			
			//$seller_exist_product_id = $this->get_maximum_id('seller_product_master', 'seller_exist_product_id');
			
			$master_product_id=$rw_filedata['master_productid'];
			//----------------sku generate start----------------
			/*$chars = 4;
			$letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$rand_letter = substr(str_shuffle($letters), 0, $chars);
			$sku1 = str_replace(' ','-',$rw_filedata['sku']);
			$sku = $rand_letter.'-'.$seller_id.'-'.$sku1;*/
		//----------------sku generate end----------------	
		
		
			
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		if($rw_filedata['special_price']>0 )
		{
			/*$tm_arr=explode('-',$rw_filedata['splprice_fromdt']);
			$tm_arrreverse=array_reverse($tm_arr);
			$tm_arrreverse_strg=implode('-',$tm_arrreverse);
									
			$splprice_frdtcreate=date_create($tm_arrreverse_strg);
			$splprice_from_dt=date_format($splprice_frdtcreate,'Y-m-d');*/
			
			$splprice_from_dt=$rw_filedata['splprice_fromdt'];	
		
		
				
			/*$tm_arr1=explode('-',$rw_filedata['splprice_todate']);
			$tm_arrreverse1=array_reverse($tm_arr1);
			$tm_arrreverse_strg1=implode('-',$tm_arrreverse1);
									
			$splprice_todtcreate=date_create($tm_arrreverse_strg1);
			$splprice_to_dt=date_format($splprice_todtcreate,'Y-m-d');*/
			
			$splprice_to_dt=$rw_filedata['splprice_todate'];
			
			
		}
		else
		{
				$splprice_from_dt='0000-00-00';
				$splprice_to_dt='0000-00-00';
				
		}
		
		
		$shipping_fee_type = $rw_filedata['shipfee_type'];
		if($shipping_fee_type == 'Free'){
			$shipping_fee = 0;
			$shipping_fee_amount = 0;
		}else{
			
			$wt_inkg=$rw_filedata['weight']/1000;
			$shipping_fee=round($rw_filedata['shipfee_amount']*$wt_inkg);				
			$shipping_fee_amount = $rw_filedata['shipfee_amount'];
		}
		
		$sellerproduct_info=array();
		
		$sellerproduct_info=array(
		/*'seller_id'=>$seller_id,
		'seller_exist_product_id'=>$seller_exist_product_id,
		'master_product_id'=>$master_product_id,*/
		//'sku'=>$sku,
		'status'=>$rw_filedata['status'],
		'manufacture_country'=>$rw_filedata['country_mafg'],
		'mrp'=>$rw_filedata['mrp'],
		'price'=>$rw_filedata['sell_price'],
		'special_price'=>$rw_filedata['special_price'],
		'special_pric_from_dt'=>$splprice_from_dt,
		'special_pric_to_dt'=>$splprice_to_dt,
		'tax_amount'=>$rw_filedata['vat_cst'],
		'quantity'=>$rw_filedata['quantity'],
		'shipping_fee'=>$shipping_fee,
		'shipping_fee_amount'=>$shipping_fee_amount,
		//'product_type'=>'Grouped Product'
		);
		
		//$this->db->insert('seller_product_master',$product_info);
		
		//$this->db->where('product_id', $product_id);
		$this->db->where('sku', $editedprod_sku);
		$this->db->update('seller_product_master',$sellerproduct_info);
		
		
			//---------------------------------------------update in product master start--------------------------------------------//
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			$masterproduct_info=array();
			
				$masterproduct_info=array(
				/*'seller_id'=>$seller_id,
				'seller_exist_product_id'=>$seller_exist_product_id,
				'master_product_id'=>$master_product_id,*/
				//'sku'=>$sku,
				'status'=>$rw_filedata['status'],
				'manufacture_country'=>$rw_filedata['country_mafg'],
				'mrp'=>$rw_filedata['mrp'],
				'price'=>$rw_filedata['sell_price'],
				'special_price'=>$rw_filedata['special_price'],
				'special_pric_from_dt'=>$splprice_from_dt,
				'special_pric_to_dt'=>$splprice_to_dt,
				'tax_amount'=>$rw_filedata['vat_cst'],
				'quantity'=>$rw_filedata['quantity'],
				'shipping_fee'=>$shipping_fee,
				'shipping_fee_amount'=>$shipping_fee_amount,
				//'product_type'=>'Grouped Product'
				);
			
			$this->db->where('sku', $editedprod_sku);
			$this->db->update('product_master',$masterproduct_info);
			
			//---------------------------------------------update in product master end--------------------------------------------//
			
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
				$cron_imag='';
				//$cron_brand='';
				$cron_color='';
				$cron_size='';
				//$cronsub_size='';
				//$cron_type='';
				//$cron_occasion='';
				$cron_Capacity='';
				$cron_RAM ='';
				$cron_ROM='';
				//$current_price='';
				
				$curprice_query=$this->db->query("
				
				SELECT CASE WHEN special_price !=0 AND CURDATE() BETWEEN special_pric_from_dt AND special_pric_to_dt
				THEN special_price
				WHEN price !=0
				THEN price 
				ELSE mrp
				END FINAL_PRICE				
				FROM product_master  WHERE sku='$editedprod_sku' ;
				
				");
				
				$rw_curprice=$curprice_query->result();
				
				$current_price=$rw_curprice[0]->FINAL_PRICE;
			
			$this->db->query("UPDATE cornjob_productsearch SET current_price='$current_price' WHERE sku='$editedprod_sku' ");
			
		
		$color_check='';	
				
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
							
							  //$newattr_value[]=$attrbsvalues;
					 		  //$newattr_id[]=$attrbidskey;	
							
						}
					}
				}
				
				
				/*print_r($attr_id);
				echo '<br>';
				print_r($attr_id_n_value);
				echo '<br>';
				print_r($attr_fld_name);echo '<br>';
				print_r($newattr_fld_name);
				exit;*/
				
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
					
				foreach($newattr_id as $ky_attrbidchk=>$val_attrbidchk)
				{	
					$qr_attrbfldnmchk=$this->db->query("SELECT attribute_field_name FROM attribute_real  WHERE attribute_id='$val_attrbidchk' ");
					
					if($qr_attrbfldnmchk->row()->attribute_field_name==$newattr_fld_name[$atr])
					{
						$sz_sql = $this->db->query("SELECT size_id FROM size_master WHERE size_name='$newattr_value[$ky_attrbidchk]'");
						$sz_row = $sz_sql->row();
						$sz_id = $sz_row->size_id;
						$product_sz_attr_data = array(
							//'sku_id' => $editedprod_sku,
							'm_size_id' => $sz_id,
							'm_size_name' => $newattr_value[$ky_attrbidchk]
						);
						 $cron_size=$newattr_value[$ky_attrbidchk];
					}
					
				}
					
					
					$this->db->query("UPDATE cornjob_productsearch SET size='$cron_size' WHERE sku='$editedprod_sku' ");
						
					//$this->db->insert('size_attr',$product_sz_attr_data);
					$this->db->where('sku_id', $editedprod_sku);
					$this->db->update('size_attr',$product_sz_attr_data);
					
					
				}
			}
			
			//progrm for sub size attribute
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');		
			
			if($newattr_fld_name[$atr] == 'Color'){
				if($newattr_value[$atr] != ''){
					
			foreach($newattr_id as $ky_attrbidchk=>$val_attrbidchk)
			{	
					$qr_attrbfldnmchk=$this->db->query("SELECT attribute_field_name FROM attribute_real  WHERE attribute_id='$val_attrbidchk' ");
					
				if($qr_attrbfldnmchk->row()->attribute_field_name==$newattr_fld_name[$atr])
				{	
					$clor_sql = $this->db->query("SELECT color_id FROM color_master WHERE clr_name='$newattr_value[$ky_attrbidchk]'");
					if($clor_sql->num_rows()>0)
					{
						$clor_row = $clor_sql->row();
						$clor_id = $clor_row->color_id;
						$product_color_attr_data = array(
							//'sku_id' => $sku,
							'color_id' => $clor_id,
							'clr_name' => $newattr_value[$ky_attrbidchk]
						);
						
						$allexitprod_colorarray[]=$newattr_value[$atr];
						
						$color_check=$newattr_value[$ky_attrbidchk];
						$cron_color=$newattr_value[$ky_attrbidchk];
					}	
				}
			}
						
						
						
						$this->db->query("UPDATE cornjob_productsearch SET color='$cron_color' WHERE sku='$editedprod_sku' ");
						
						$this->db->where('sku_id', $editedprod_sku);
						$this->db->update('color_attr',$product_color_attr_data);
				
					
				}
			}
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			
			$insert_otherattrbid=$newattr_id[$atr];
			$insert_otherattrbvalue=$newattr_value[$atr];
			
			
				/*$product_attr_data = array(
					//'seller_product_id' => $seller_exist_product_id,
					//'sku' => $sku,
					'attr_id' => $newattr_id[$atr],
					'attr_value' => $newattr_value[$atr], 
				);
				
				$this->db->where('sku', $editedprod_sku);
				$this->db->update('seller_product_attribute_value',$product_attr_data);*/
				
				//$this->db->insert('seller_product_attribute_value',$product_attr_data);
								
					
					if($newattr_fld_name[$atr] == 'Capacity' || $newattr_fld_name[$atr] == 'capacity' || $newattr_fld_name[$atr] == 'CAPACITY')
					{
						foreach($newattr_id as $ky_attrbidchk=>$val_attrbidchk)
						{	
							$qr_attrbfldnmchk=$this->db->query("SELECT attribute_field_name FROM attribute_real  WHERE attribute_id='$val_attrbidchk' ");
					
							if($qr_attrbfldnmchk->row()->attribute_field_name==$newattr_fld_name[$atr])
							{
						
								if($newattr_value[$ky_attrbidchk] != '')
								{$cron_Capacity=$newattr_value[$ky_attrbidchk];
									$this->db->query("UPDATE cornjob_productsearch SET Capacity='$cron_Capacity' WHERE sku='$editedprod_sku' ");
								}
							}
						}
					
					}
					
					if($newattr_fld_name[$atr] == 'RAM' || $newattr_fld_name[$atr] == 'ram')
					{
						foreach($newattr_id as $ky_attrbidchk=>$val_attrbidchk)
						{	
							$qr_attrbfldnmchk=$this->db->query("SELECT attribute_field_name FROM attribute_real  WHERE attribute_id='$val_attrbidchk' ");
					
							if($qr_attrbfldnmchk->row()->attribute_field_name==$newattr_fld_name[$atr])
							{
						
								if($newattr_value[$ky_attrbidchk] != '')
								{$cron_RAM=$newattr_value[$ky_attrbidchk];
									$this->db->query("UPDATE cornjob_productsearch SET RAM='$cron_RAM' WHERE sku='$editedprod_sku' ");
								}
							}
						}
								
					
					}
					
					if($newattr_fld_name[$atr] == 'ROM' || $newattr_fld_name[$atr] == 'rom')
					{
						foreach($newattr_id as $ky_attrbidchk=>$val_attrbidchk)
						{	
							$qr_attrbfldnmchk=$this->db->query("SELECT attribute_field_name FROM attribute_real  WHERE attribute_id='$val_attrbidchk' ");
					
							if($qr_attrbfldnmchk->row()->attribute_field_name==$newattr_fld_name[$atr])
							{
								if($newattr_value[$ky_attrbidchk] != '')
								{$cron_ROM=$newattr_value[$ky_attrbidchk];
									$this->db->query("UPDATE cornjob_productsearch SET ROM='$cron_ROM' WHERE sku='$editedprod_sku' ");
								}
							}
						}
					
					}
			
		}
		
		//-----------------------update or insert Date in seller_product_attribute_value table start-------------//
		
				
		foreach($attr_id_n_value as $ky_attrbid=>$val_attrbval) 
		{		
			$qr_duplchkk=$this->db->query("Select * from seller_product_attribute_value WHERE sku='$editedprod_sku' AND attr_id='$ky_attrbid'  group by attr_id having count(attr_id)>1 ");
			
			if($qr_duplchkk->num_rows()>0)
			{
				$attrb_sqlid=$qr_duplchkk->row()->id;
				$this->db->query("DELETE FROM seller_product_attribute_value WHERE sku='$editedprod_sku' AND attr_id='$ky_attrbid' AND id!='$attrb_sqlid' ");
					
			}	
				$qr_attrbidextchk=$this->db->query("Select * from seller_product_attribute_value WHERE sku='$editedprod_sku' AND attr_id='$ky_attrbid'  ");
				
				if($qr_attrbidextchk->num_rows()>0)
				{
						$this->db->query("UPDATE seller_product_attribute_value SET attr_value='$val_attrbval' 
										  WHERE sku='$editedprod_sku' AND attr_id='$ky_attrbid' ");
				}
				
				else
				{
					$product_attr_data = array(
							'seller_product_id' => $seller_exist_product_id,
							'sku' => $editedprod_sku,
							'attr_id' => $ky_attrbid,
							'attr_value' => $val_attrbval, 
						);
						
						$this->db->insert('seller_product_attribute_value',$product_attr_data);	
				}
		}
				
		//-----------------------update or insert Date in seller_product_attribute_value table end-------------//		
		
		
		
	//---------------------------------------------attribute insert code end---------------------------------------//
	/*$all_image='';
	$catalog_image='';
	$qrprodimage=$this->db->query("SELECT * FROM product_image WHERE product_id='$master_product_id' group by product_id ");
	
	if($qrprodimage->num_rows()>0)
	{
		$all_image=$qrprodimage->row()->imag;
		$catalog_image=$qrprodimage->row()->catelog_img_url;
	}else
	{
		$qrprodimage=$this->db->query("select b.image  from seller_product_master a INNER JOIN  seller_existingproduct_image b ON a.seller_exist_product_id=b.seller_extproduct_id WHERE  a.master_product_id='$master_product_id' group by a.sku ");
		
		$all_image=$qrprodimage->row()->image;
		$catalog_image=$qrprodimage->row()->catelog_img_url;
	}*/
	
		
		
	//------------------------image upload  start---------------------------------------------------------------------//
		$dt_img = preg_replace("/[^0-9]+/","", date('Y-m-d H:i:s'));
		 //--------------------------------image upload for imageURL1 start------------------------------------//	
		 //$this->load->helper('download');	
		 $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
			if($rw_filedata['image_url1']!='' && $color_check!='' && (preg_match('/http/',$rw_filedata['image_url1']) || preg_match('/https/',$rw_filedata['image_url1'])) )
			//if($rw_filedata['image_url1']!='' &&  strpos($rw_filedata['image_url1'], 'https') )
			
			{ error_reporting(0);
				//$last_postslash=strripos($allDataInSheet[$i]['T'],'.');
				//$strpos_afterlastslash=$last_postslash;
				//$image_extenxion=substr($allDataInSheet[$i]['T'],$strpos_afterlastslash);
				//$random_imaghename=strtolower(random_string('alnum',15)).$i.$image_extenxion;
				$random_imaghename=strtolower(random_string('alnum',15)).$dt_img.'.jpg';
				
				if(preg_match('/dropbox/',$rw_filedata['image_url1']))
				{
					$image_url=trim(str_replace("?dl=0","?dl=1",$rw_filedata['image_url1']));
					
				}else
				{
					$image_url=trim($rw_filedata['image_url1']);	
				}
				
				$img = file_get_contents(trim($image_url));
				
				//force_download($img, $img);				
				 $im = imagecreatefromstring($img);
								
				$width = imagesx($im);				
				$height = imagesy($im);
											
				$newwidth1 = $width;				
				$newheight1 = $height;								
				$thumb1 = imagecreatetruecolor($newwidth1, $newheight1);				
				imagecopyresized($thumb1, $im, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);							
				imagejpeg($thumb1,'./images/product_img/original_'.$random_imaghename); //save image as jpg				
				imagedestroy($thumb1);
				
				
				
				//$newwidth2 = '2000';				
//				$newheight2 = '2000';	
				$newwidth2 = $width;				
				$newheight2 = $height;							
				$thumb2 = imagecreatetruecolor($newwidth2, $newheight2);				
				imagecopyresized($thumb2, $im, 0, 0, 0, 0, $newwidth2, $newheight2, $width, $height);							
				imagejpeg($thumb2,'./images/product_img/2000x2000_'.$random_imaghename); //save image as jpg				
				imagedestroy($thumb2);
				
				if($newwidth2 > $newheight2){
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/2000x2000_'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 2000;
						$configi['height'] = 2000;
						$config['master_dim'] = 'width';
						//$config['master_dim'] = 'height';
					}else{
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/2000x2000_'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 2000;
						$configi['height'] = 2000;
						//$config['master_dim'] = 'width';
						$config['master_dim'] = 'height';
					}
			
					$this->load->library('image_lib');
					$this->image_lib->initialize($configi);   
					$success_resize = $this->image_lib->resize();
					$this->image_lib->clear();
				
				
				
				//$newwidth3 = '500';				
//				$newheight3 = '500';
				$newwidth3 = $width;				
				$newheight3 = $height;								
				$thumb3 = imagecreatetruecolor($newwidth3, $newheight3);				
				imagecopyresized($thumb3, $im, 0, 0, 0, 0, $newwidth3, $newheight3, $width, $height);							
				imagejpeg($thumb3,'./images/product_img/'.$random_imaghename); //save image as jpg				
				imagedestroy($thumb3);
				
				if($newwidth3 > $newheight3){
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 500;
						$configi['height'] = 500;
						$config['master_dim'] = 'width';
						//$config['master_dim'] = 'height';
					}else{
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 500;
						$configi['height'] = 500;
						//$config['master_dim'] = 'width';
						$config['master_dim'] = 'height';
					}
			
					$this->load->library('image_lib');
					$this->image_lib->initialize($configi);   
					$success_resize = $this->image_lib->resize();
					$this->image_lib->clear();
				
				
				//$newwidth4 = '190';				
//				$newheight4 = '190';
				$newwidth4 = $width;				
				$newheight4 = $height;								
				$thumb4 = imagecreatetruecolor($newwidth4, $newheight4);				
				imagecopyresized($thumb4, $im, 0, 0, 0, 0, $newwidth4, $newheight4, $width, $height);							
				imagejpeg($thumb4,'./images/product_img/catalog_'.$random_imaghename); //save image as jpg				
				imagedestroy($thumb4);
				
				if($newwidth4 > $newheight4){
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/catalog_'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 190;
						$configi['height'] = 190;
						$config['master_dim'] = 'width';
						//$config['master_dim'] = 'height';
					}else{
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/catalog_'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 190;
						$configi['height'] = 190;
						//$config['master_dim'] = 'width';
						$config['master_dim'] = 'height';
					}
			
					$this->load->library('image_lib');
					$this->image_lib->initialize($configi);   
					$success_resize = $this->image_lib->resize();
					$this->image_lib->clear();
				
				
				//$newwidth5 = '80';				
//				$newheight5 = '80';
				$newwidth5 = $width;				
				$newheight5 = $height;								
				$thumb5= imagecreatetruecolor($newwidth5, $newheight5);				
				imagecopyresized($thumb5, $im, 0, 0, 0, 0, $newwidth5, $newheight5, $width, $height);							
				imagejpeg($thumb5,'./images/product_img/thumbnil_'.$random_imaghename); //save image as jpg				
				imagedestroy($thumb5);
				
				
				if($newwidth5 > $newheight5){
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/thumbnil_'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 80;
						$configi['height'] = 80;
						$config['master_dim'] = 'width';
						//$config['master_dim'] = 'height';
					}else{
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/thumbnil_'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 80;
						$configi['height'] = 80;
						//$config['master_dim'] = 'width';
						$config['master_dim'] = 'height';
					}
					$imag[]=$random_imaghename;
					$this->load->library('image_lib');
					$this->image_lib->initialize($configi);   
					$success_resize = $this->image_lib->resize();
					$this->image_lib->clear();
								
				imagedestroy($im);
				
				 
			}else
			{$imag[]=$rw_filedata['image_url1'];}
			
			//--------------------------------image upload for imageURL1 end------------------------------------
			
			//--------------------------------image upload for imageURL2 start------------------------------------		
			if($rw_filedata['image_url2']!='' && $color_check!='' && (preg_match('/http/',$rw_filedata['image_url2']) || preg_match('/https/',$rw_filedata['image_url2'])))
			{error_reporting(0);
				//$last_postslash=strripos($allDataInSheet[$i]['T'],'.');
				//$strpos_afterlastslash=$last_postslash;
				//$image_extenxion=substr($allDataInSheet[$i]['T'],$strpos_afterlastslash);
				//$random_imaghename=strtolower(random_string('alnum',15)).$i.$image_extenxion;
				$random_imaghename=strtolower(random_string('alnum',15)).$dt_img.'.jpg';
				
				if(preg_match('/dropbox/',$rw_filedata['image_url2']))
				{
					$image_url=trim(str_replace("?dl=0","?dl=1",$rw_filedata['image_url2']));
					
				}else
				{
					$image_url=trim($rw_filedata['image_url2']);	
				}
				
				$img = file_get_contents($image_url);				
				$im = imagecreatefromstring($img);
								
				$width = imagesx($im);				
				$height = imagesy($im);
											
				$newwidth1 = $width;				
				$newheight1 = $height;								
				$thumb1 = imagecreatetruecolor($newwidth1, $newheight1);				
				imagecopyresized($thumb1, $im, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);							
				imagejpeg($thumb1,'./images/product_img/original_'.$random_imaghename); //save image as jpg				
				imagedestroy($thumb1);
				
				
				
				//$newwidth2 = '2000';				
//				$newheight2 = '2000';	
				$newwidth2 = $width;				
				$newheight2 = $height;							
				$thumb2 = imagecreatetruecolor($newwidth2, $newheight2);				
				imagecopyresized($thumb2, $im, 0, 0, 0, 0, $newwidth2, $newheight2, $width, $height);							
				imagejpeg($thumb2,'./images/product_img/2000x2000_'.$random_imaghename); //save image as jpg				
				imagedestroy($thumb2);
				
				if($newwidth2 > $newheight2){
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/2000x2000_'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 2000;
						$configi['height'] = 2000;
						$config['master_dim'] = 'width';
						//$config['master_dim'] = 'height';
					}else{
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/2000x2000_'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 2000;
						$configi['height'] = 2000;
						//$config['master_dim'] = 'width';
						$config['master_dim'] = 'height';
					}
			
					$this->load->library('image_lib');
					$this->image_lib->initialize($configi);   
					$success_resize = $this->image_lib->resize();
					$this->image_lib->clear();
				
				
				
				//$newwidth3 = '500';				
//				$newheight3 = '500';
				$newwidth3 = $width;				
				$newheight3 = $height;								
				$thumb3 = imagecreatetruecolor($newwidth3, $newheight3);				
				imagecopyresized($thumb3, $im, 0, 0, 0, 0, $newwidth3, $newheight3, $width, $height);							
				imagejpeg($thumb3,'./images/product_img/'.$random_imaghename); //save image as jpg				
				imagedestroy($thumb3);
				
				if($newwidth3 > $newheight3){
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 500;
						$configi['height'] = 500;
						$config['master_dim'] = 'width';
						//$config['master_dim'] = 'height';
					}else{
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 500;
						$configi['height'] = 500;
						//$config['master_dim'] = 'width';
						$config['master_dim'] = 'height';
					}
			
					$this->load->library('image_lib');
					$this->image_lib->initialize($configi);   
					$success_resize = $this->image_lib->resize();
					$this->image_lib->clear();
				
				
				//$newwidth5 = '80';				
//				$newheight5 = '80';
				$newwidth5 = $width;				
				$newheight5 = $height;								
				$thumb5= imagecreatetruecolor($newwidth5, $newheight5);				
				imagecopyresized($thumb5, $im, 0, 0, 0, 0, $newwidth5, $newheight5, $width, $height);							
				imagejpeg($thumb5,'./images/product_img/thumbnil_'.$random_imaghename); //save image as jpg				
				imagedestroy($thumb5);
				
				
				if($newwidth5 > $newheight5){
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/thumbnil_'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 80;
						$configi['height'] = 80;
						$config['master_dim'] = 'width';
						//$config['master_dim'] = 'height';
					}else{
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/thumbnil_'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 80;
						$configi['height'] = 80;
						//$config['master_dim'] = 'width';
						$config['master_dim'] = 'height';
					}
					$imag[]=$random_imaghename;
					$this->load->library('image_lib');
					$this->image_lib->initialize($configi);   
					$success_resize = $this->image_lib->resize();
					$this->image_lib->clear();
								
				imagedestroy($im);
				
				 
			}else
			{$imag[]=$rw_filedata['image_url2'];}
			
			//--------------------------------image upload for imageURL2 end------------------------------------
			
			
			//--------------------------------image upload for imageURL3 start------------------------------------		
			if($rw_filedata['image_url3']!='' && $color_check!='' && (preg_match('/http/',$rw_filedata['image_url3']) || preg_match('/https/',$rw_filedata['image_url3'])))
			{error_reporting(0);
				//$last_postslash=strripos($allDataInSheet[$i]['T'],'.');
				//$strpos_afterlastslash=$last_postslash;
				//$image_extenxion=substr($allDataInSheet[$i]['T'],$strpos_afterlastslash);
				//$random_imaghename=strtolower(random_string('alnum',15)).$i.$image_extenxion;
				$random_imaghename=strtolower(random_string('alnum',15)).$dt_img.'.jpg';
				
				if(preg_match('/dropbox/',$rw_filedata['image_url3']))
				{
					$image_url=trim(str_replace("?dl=0","?dl=1",$rw_filedata['image_url3']));
					
				}else
				{
					$image_url=trim($rw_filedata['image_url3']);	
				}
				
				$img = file_get_contents($image_url);				
				$im = imagecreatefromstring($img);
								
				$width = imagesx($im);				
				$height = imagesy($im);
											
				$newwidth1 = $width;				
				$newheight1 = $height;								
				$thumb1 = imagecreatetruecolor($newwidth1, $newheight1);				
				imagecopyresized($thumb1, $im, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);							
				imagejpeg($thumb1,'./images/product_img/original_'.$random_imaghename); //save image as jpg				
				imagedestroy($thumb1);
				
				
				
				//$newwidth2 = '2000';				
//				$newheight2 = '2000';	
				$newwidth2 = $width;				
				$newheight2 = $height;							
				$thumb2 = imagecreatetruecolor($newwidth2, $newheight2);				
				imagecopyresized($thumb2, $im, 0, 0, 0, 0, $newwidth2, $newheight2, $width, $height);							
				imagejpeg($thumb2,'./images/product_img/2000x2000_'.$random_imaghename); //save image as jpg				
				imagedestroy($thumb2);
				
				if($newwidth2 > $newheight2){
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/2000x2000_'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 2000;
						$configi['height'] = 2000;
						$config['master_dim'] = 'width';
						//$config['master_dim'] = 'height';
					}else{
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/2000x2000_'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 2000;
						$configi['height'] = 2000;
						//$config['master_dim'] = 'width';
						$config['master_dim'] = 'height';
					}
			
					$this->load->library('image_lib');
					$this->image_lib->initialize($configi);   
					$success_resize = $this->image_lib->resize();
					$this->image_lib->clear();
				
				
				
				//$newwidth3 = '500';				
//				$newheight3 = '500';
				$newwidth3 = $width;				
				$newheight3 = $height;								
				$thumb3 = imagecreatetruecolor($newwidth3, $newheight3);				
				imagecopyresized($thumb3, $im, 0, 0, 0, 0, $newwidth3, $newheight3, $width, $height);							
				imagejpeg($thumb3,'./images/product_img/'.$random_imaghename); //save image as jpg				
				imagedestroy($thumb3);
				
				if($newwidth3 > $newheight3){
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 500;
						$configi['height'] = 500;
						$config['master_dim'] = 'width';
						//$config['master_dim'] = 'height';
					}else{
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 500;
						$configi['height'] = 500;
						//$config['master_dim'] = 'width';
						$config['master_dim'] = 'height';
					}
			
					$this->load->library('image_lib');
					$this->image_lib->initialize($configi);   
					$success_resize = $this->image_lib->resize();
					$this->image_lib->clear();
				
				
								
				//$newwidth5 = '80';				
//				$newheight5 = '80';
				$newwidth5 = $width;				
				$newheight5 = $height;								
				$thumb5= imagecreatetruecolor($newwidth5, $newheight5);				
				imagecopyresized($thumb5, $im, 0, 0, 0, 0, $newwidth5, $newheight5, $width, $height);							
				imagejpeg($thumb5,'./images/product_img/thumbnil_'.$random_imaghename); //save image as jpg				
				imagedestroy($thumb5);
				
				
				if($newwidth5 > $newheight5){
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/thumbnil_'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 80;
						$configi['height'] = 80;
						$config['master_dim'] = 'width';
						//$config['master_dim'] = 'height';
					}else{
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/thumbnil_'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 80;
						$configi['height'] = 80;
						//$config['master_dim'] = 'width';
						$config['master_dim'] = 'height';
					}
					$imag[]=$random_imaghename;
					$this->load->library('image_lib');
					$this->image_lib->initialize($configi);   
					$success_resize = $this->image_lib->resize();
					$this->image_lib->clear();
								
				imagedestroy($im);
			 
			}else
			{$imag[]=$rw_filedata['image_url3'];}
			
			//--------------------------------image upload for imageURL3 end------------------------------------
			
			
			
			//--------------------------------image upload for imageURL4 start------------------------------------		
			if($rw_filedata['image_url4']!='' && $color_check!='' && (preg_match('/http/',$rw_filedata['image_url4']) || preg_match('/https/',$rw_filedata['image_url4'])) )
			{error_reporting(0);
				//$last_postslash=strripos($allDataInSheet[$i]['T'],'.');
				//$strpos_afterlastslash=$last_postslash;
				//$image_extenxion=substr($allDataInSheet[$i]['T'],$strpos_afterlastslash);
				//$random_imaghename=strtolower(random_string('alnum',15)).$i.$image_extenxion;
				$random_imaghename=strtolower(random_string('alnum',15)).$dt_img.'.jpg';
				
				if(preg_match('/dropbox/',$rw_filedata['image_url4']))
				{
					$image_url=trim(str_replace("?dl=0","?dl=1",$rw_filedata['image_url4'])); 
					
				}else
				{
					$image_url=trim($rw_filedata['image_url4']);	
				}
				
				$img = file_get_contents($image_url);				
				$im = imagecreatefromstring($img);
								
				$width = imagesx($im);				
				$height = imagesy($im);
											
				$newwidth1 = $width;				
				$newheight1 = $height;								
				$thumb1 = imagecreatetruecolor($newwidth1, $newheight1);				
				imagecopyresized($thumb1, $im, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);							
				imagejpeg($thumb1,'./images/product_img/original_'.$random_imaghename); //save image as jpg				
				imagedestroy($thumb1);
				
				
				
				//$newwidth2 = '2000';				
//				$newheight2 = '2000';	
				$newwidth2 = $width;				
				$newheight2 = $height;							
				$thumb2 = imagecreatetruecolor($newwidth2, $newheight2);				
				imagecopyresized($thumb2, $im, 0, 0, 0, 0, $newwidth2, $newheight2, $width, $height);							
				imagejpeg($thumb2,'./images/product_img/2000x2000_'.$random_imaghename); //save image as jpg				
				imagedestroy($thumb2);
				
				if($newwidth2 > $newheight2){
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/2000x2000_'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 2000;
						$configi['height'] = 2000;
						$config['master_dim'] = 'width';
						//$config['master_dim'] = 'height';
					}else{
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/2000x2000_'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 2000;
						$configi['height'] = 2000;
						//$config['master_dim'] = 'width';
						$config['master_dim'] = 'height';
					}
			
					$this->load->library('image_lib');
					$this->image_lib->initialize($configi);   
					$success_resize = $this->image_lib->resize();
					$this->image_lib->clear();
				
				
				
				//$newwidth3 = '500';				
//				$newheight3 = '500';
				$newwidth3 = $width;				
				$newheight3 = $height;								
				$thumb3 = imagecreatetruecolor($newwidth3, $newheight3);				
				imagecopyresized($thumb3, $im, 0, 0, 0, 0, $newwidth3, $newheight3, $width, $height);							
				imagejpeg($thumb3,'./images/product_img/'.$random_imaghename); //save image as jpg				
				imagedestroy($thumb3);
				
				if($newwidth3 > $newheight3){
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 500;
						$configi['height'] = 500;
						$config['master_dim'] = 'width';
						//$config['master_dim'] = 'height';
					}else{
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 500;
						$configi['height'] = 500;
						//$config['master_dim'] = 'width';
						$config['master_dim'] = 'height';
					}
			
					$this->load->library('image_lib');
					$this->image_lib->initialize($configi);   
					$success_resize = $this->image_lib->resize();
					$this->image_lib->clear();
				
				
				
				
				
				//$newwidth5 = '80';				
//				$newheight5 = '80';
				$newwidth5 = $width;				
				$newheight5 = $height;								
				$thumb5= imagecreatetruecolor($newwidth5, $newheight5);				
				imagecopyresized($thumb5, $im, 0, 0, 0, 0, $newwidth5, $newheight5, $width, $height);							
				imagejpeg($thumb5,'./images/product_img/thumbnil_'.$random_imaghename); //save image as jpg				
				imagedestroy($thumb5);
				
				
				if($newwidth5 > $newheight5){
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/thumbnil_'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 80;
						$configi['height'] = 80;
						$config['master_dim'] = 'width';
						//$config['master_dim'] = 'height';
					}else{
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/thumbnil_'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 80;
						$configi['height'] = 80;
						//$config['master_dim'] = 'width';
						$config['master_dim'] = 'height';
					}
					$imag[]=$random_imaghename;
					$this->load->library('image_lib');
					$this->image_lib->initialize($configi);   
					$success_resize = $this->image_lib->resize();
					$this->image_lib->clear();
								
				imagedestroy($im);
				
				 
			}else
			{$imag[]=$rw_filedata['image_url4'];}
			
			//--------------------------------image upload for imageURL4 end------------------------------------
			
			
			//--------------------------------image upload for imageURL5 start------------------------------------		
			if($rw_filedata['image_url5']!='' && $color_check!='' && (preg_match('/http/',$rw_filedata['image_url5']) || preg_match('/https/',$rw_filedata['image_url5'])))
			{error_reporting(0);
				//$last_postslash=strripos($allDataInSheet[$i]['T'],'.');
				//$strpos_afterlastslash=$last_postslash;
				//$image_extenxion=substr($allDataInSheet[$i]['T'],$strpos_afterlastslash);
				//$random_imaghename=strtolower(random_string('alnum',15)).$i.$image_extenxion;
				$random_imaghename=strtolower(random_string('alnum',15)).$dt_img.'.jpg';
				
				if(preg_match('/dropbox/',$rw_filedata['image_url5']))
				{
					$image_url=trim(str_replace("?dl=0","?dl=1",$rw_filedata['image_url5'])); 
					
				}else
				{
					$image_url=trim($rw_filedata['image_url5']);	
				}
				
				$img = file_get_contents($image_url);				
				$im = imagecreatefromstring($img);
								
				$width = imagesx($im);				
				$height = imagesy($im);
											
				$newwidth1 = $width;				
				$newheight1 = $height;								
				$thumb1 = imagecreatetruecolor($newwidth1, $newheight1);				
				imagecopyresized($thumb1, $im, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);							
				imagejpeg($thumb1,'./images/product_img/original_'.$random_imaghename); //save image as jpg				
				imagedestroy($thumb1);
				
				
				
				//$newwidth2 = '2000';				
//				$newheight2 = '2000';	
				$newwidth2 = $width;				
				$newheight2 = $height;							
				$thumb2 = imagecreatetruecolor($newwidth2, $newheight2);				
				imagecopyresized($thumb2, $im, 0, 0, 0, 0, $newwidth2, $newheight2, $width, $height);							
				imagejpeg($thumb2,'./images/product_img/2000x2000_'.$random_imaghename); //save image as jpg				
				imagedestroy($thumb2);
				
				if($newwidth2 > $newheight2){
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/2000x2000_'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 2000;
						$configi['height'] = 2000;
						$config['master_dim'] = 'width';
						//$config['master_dim'] = 'height';
					}else{
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/2000x2000_'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 2000;
						$configi['height'] = 2000;
						//$config['master_dim'] = 'width';
						$config['master_dim'] = 'height';
					}
			
					$this->load->library('image_lib');
					$this->image_lib->initialize($configi);   
					$success_resize = $this->image_lib->resize();
					$this->image_lib->clear();
				

				
				
				//$newwidth3 = '500';				
//				$newheight3 = '500';
				$newwidth3 = $width;				
				$newheight3 = $height;								
				$thumb3 = imagecreatetruecolor($newwidth3, $newheight3);				
				imagecopyresized($thumb3, $im, 0, 0, 0, 0, $newwidth3, $newheight3, $width, $height);							
				imagejpeg($thumb3,'./images/product_img/'.$random_imaghename); //save image as jpg				
				imagedestroy($thumb3);
				
				if($newwidth3 > $newheight3){
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 500;
						$configi['height'] = 500;
						$config['master_dim'] = 'width';
						//$config['master_dim'] = 'height';
					}else{
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 500;
						$configi['height'] = 500;
						//$config['master_dim'] = 'width';
						$config['master_dim'] = 'height';
					}
			
					$this->load->library('image_lib');
					$this->image_lib->initialize($configi);   
					$success_resize = $this->image_lib->resize();
					$this->image_lib->clear();
				
				
				
				
				//$newwidth5 = '80';				
//				$newheight5 = '80';
				$newwidth5 = $width;				
				$newheight5 = $height;								
				$thumb5= imagecreatetruecolor($newwidth5, $newheight5);				
				imagecopyresized($thumb5, $im, 0, 0, 0, 0, $newwidth5, $newheight5, $width, $height);							
				imagejpeg($thumb5,'./images/product_img/thumbnil_'.$random_imaghename); //save image as jpg				
				imagedestroy($thumb5);
				
				
				if($newwidth5 > $newheight5){
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/thumbnil_'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 80;
						$configi['height'] = 80;
						$config['master_dim'] = 'width';
						//$config['master_dim'] = 'height';
					}else{
						$configi['image_library'] = 'gd2';
						$configi['source_image']   = './images/product_img/thumbnil_'.$random_imaghename;
						$config['maintain_ratio'] = TRUE;
						$configi['width']  = 80;
						$configi['height'] = 80;
						//$config['master_dim'] = 'width';
						$config['master_dim'] = 'height';
					}
					$imag[]=$random_imaghename;
					$this->load->library('image_lib');
					$this->image_lib->initialize($configi);   
					$success_resize = $this->image_lib->resize();
					$this->image_lib->clear();
								
				imagedestroy($im);
				
				 
			}else
			{$imag[]=$rw_filedata['image_url5'];}
			
			//--------------------------------image upload for imageURL5 end------------------------------------		 
				 
		//------------------------image upload  end-----------------------------------------------------------------------
			
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		if($color_check!='' && count($imag)>0)
		{
			$image=implode(',',$imag);
			
			$slrprodqr=$this->db->query("SELECT * FROM seller_product_master WHERE sku='$editedprod_sku' ");
			$ext_productid=$slrprodqr->row()->seller_exist_product_id;
			
			$image_data=array();
			$image_data = array(
				//'seller_extproduct_id' => $seller_exist_product_id,
				'image' => $image,
				'catelog_img_url' => 'catalog_'.$imag[0]
				
			);
			
			$this->db->where('seller_extproduct_id', $ext_productid);
			$this->db->update('seller_existingproduct_image',$image_data);			
			
			//$this->db->insert('seller_existingproduct_image',$image_data);
		
		}
		
		
		
		//---------------------------------Product update in cornjob_productsearch start--------------------//
		
		$cron_imag='';
				//$cron_brand='';
				$cron_color='';
				$cron_size='';
				//$cronsub_size='';
				//$cron_type='';
				//$cron_occasion='';
				$cron_Capacity='';
				$cron_RAM ='';
				$cron_ROM='';
				$current_price='';
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			$cronjobproduct_data=array();
			
			$cronjobproduct_data=array(				
				'imag'=>'catalog_'.$imag[0],				
				//'current_price'=>$current_price,
				//'color'=>$cron_color,
				//'size'=>$cron_size,	
				//'Capacity'=>$cron_Capacity,
				//'RAM'=>$cron_RAM,
				//'ROM'=>$cron_ROM,
				'mrp'=>$rw_filedata['mrp'],
				'price'=>$rw_filedata['sell_price'],
				'special_price'=>$rw_filedata['special_price'],
				'special_pric_from_dt'=> $splprice_from_dt,
				'special_pric_to_dt'=> $splprice_to_dt,
				'status'=>$rw_filedata['status'],
				'quantity'=>$rw_filedata['quantity'],
				
			);
			
			//$this->db->where('product_id',$prodcutid_mast);	
			$this->db->where('sku',$editedprod_sku);						
			$this->db->update('cornjob_productsearch',$cronjobproduct_data);
			
		//---------------------------------Product update in cornjob_productsearch end--------------------//
		
		
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		$uplodprd_id=$rw_filedata['uploadprod_sqlid'];
		$this->db->query("UPDATE bulk_existing_editedproductupload_log SET upload_status='Uploaded' , upload_dtime='$dt', seller_productid='$ext_productid'  WHERE uploadprod_sqlid='$uplodprd_id' ");
				
		}
		//--------------------------------Main forloop Product Data insert end-------------------------
		
		
		
		//-------------------------------existing product image upate start---------------------------------//		
			
			/*$attr_colorfind=array();
			$attr_allimagefind=array();
			$attrb_catalogimage=array();
			foreach($allextprod_sku as $kysku=>$valsku)
			{
				$qr_sku=$this->db->query("SELECT * FROM seller_product_master WHERE  sku='$valsku'  ");
				
				$slrext_prodid=$qr_sku->row()->seller_exist_product_id;
				
				$qr_imgaext=$this->db->query("SELECT * FROM seller_existingproduct_image WHERE seller_extproduct_id='$slrext_prodid' ");
				
				if($qr_imgaext->num_rows()>0)
				{
					$colorchk_ext=$allexitprod_colorarray[$kysku];
					$qr_slrcolorattrbvalue=$this->db->query("SELECT * FROM seller_product_attribute_value WHERE sku='$valsku' AND attr_value='$colorchk_ext'  ");	
					
					$color_extfnl=$qr_slrcolorattrbvalue->row()->attr_value;
					
					$slrext_productid_imgae=$slrext_prodid;
					
					$attr_colorfind[]=$color_extfnl;
					$attr_allimagefind[]=$qr_imgaext->row()->image;
					$attrb_catalogimage[]=$qr_imgaext->row()->catelog_img_url;
				}		
				
			}
			
			
			foreach($allexitprod_colorarray as $kyclrsku=>$valclrsku)
			{
				foreach($attr_colorfind as $kyfindclr=>$valclrfind)
				{
					if($valclrsku==$valclrfind)
					{
						$sku_clrupdate=$allextprod_sku[$kyclrsku];
						
						$qr_sku=$this->db->query("SELECT * FROM seller_product_master a
						INNER JOIN seller_existingproduct_image b ON a.seller_exist_product_id=b.seller_extproduct_id
						WHERE a.sku='$sku_clrupdate'  ");
						
						if($qr_sku->num_rows()==0)
						{
							$seller_exist_product_id=$allextslrproduct_id[$kyclrsku];
							$image=$attr_allimagefind[$kyfindclr];
							$catelog_img_url=$attrb_catalogimage[$kyfindclr];
							
							$data_slrextimg=array(
							'seller_extproduct_id'=>$seller_exist_product_id,
							'image'=>$image,
							'catelog_img_url'=>$catelog_img_url
							
							);
							
							$this->db->insert('seller_existingproduct_image',$data_slrextimg);	
						}	
					}	
				}
					
			}*/
			
		
		//--------------------------------exting Product image update end-----------------------------------//
		
		
		
		
		
		
		$maxupload_id = $this->get_maximum_id('bulkexisting_editprodtemplatelog', 'upload_id');
		
		$this->db->query("UPDATE bulkexisting_editprodtemplatelog SET status='Expired', upload_id='$maxupload_id' WHERE blk_tempid='$excelfiluploadid' AND  status='Active' ");
		
		
		$this->db->query("UPDATE bulkexisting_editprodtemplatelog SET status='Expired' WHERE downlaod_parentid='$excelfiluploadid' ");
		
		
	
		 $this->db->query("UPDATE seller_existingproduct_image SET image= REPLACE(image, ',,', '') ");
		 $this->db->query("UPDATE seller_existingproduct_image SET image= REPLACE(image, ',,,', '') ");
		  $this->db->query("UPDATE seller_existingproduct_image SET image= REPLACE(image, ',,,,', '') ");
		  
		  
		  
		
		 $this->db->query("UPDATE product_image SET imag= REPLACE(imag, ',,', '') ");
		 $this->db->query("UPDATE product_image SET imag= REPLACE(imag, ',,,', '') ");
		  $this->db->query("UPDATE product_image SET imag= REPLACE(imag, ',,,,', '') ");
	
	}
	
	//------------------------------------------Upload existing product after validation end---------------------------------------//
	
	function delete_existingproduct_bulkuploada($excelfiluploadid)
	{
		$flnm_qr=$this->db->query("SELECT excelfile_name FROM bulkexisting_editprodtemplatelog WHERE blk_tempid='$excelfiluploadid'");
		$rw_filename=$flnm_qr->row();
		
		$excl_filename=$rw_filename->excelfile_name;
		
		$output_dir = "./bulk_existingeditedproductexcel/";						
		$filePath = $output_dir.$excl_filename;
		unlink($filePath);
		
		$this->db->query("DELETE FROM bulk_existing_editedproductupload_log WHERE uploadprod_uid='$excelfiluploadid' AND upload_status='Pending' ");
			
		//$this->db->query("DELETE FROM bulkprod_templatelog WHERE blk_tempid='$excelfiluploadid' ");
		
		
			
	}	
	
}
