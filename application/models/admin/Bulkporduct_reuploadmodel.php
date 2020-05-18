
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bulkporduct_reuploadmodel extends CI_Model
{
	public function __construct(){
		parent::__construct();
		
		$this->load->model('PHPExcel/Phpexcel_iofactory');
	}
	
	public function reupload_bulkuploadafterconf($excelfiluploadid)
	{ 
	
		set_time_limit(0);
	
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		$startdtm = date('Y-m-d H:i:s');
		$this->db->query("UPDATE bulkprod_templatelog set reupload_processstatus='process',reupload_startdatetime='$startdtm' where blk_tempid='$excelfiluploadid' ");
		//$this->db->trans_start();
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		$qr_olddata=$this->db->query("SELECT * FROM bulkproductupload_log WHERE uploadprod_uid='$excelfiluploadid' ");
		
		
		foreach($qr_olddata->result_array() as $res_oldproduct)
		{$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');	
		$data_oldprodinfo=array();
							$data_oldprodinfo=array(
													'uploadprod_uid'=> $res_oldproduct['uploadprod_uid'],
													'moonboy_slno'=> $res_oldproduct['moonboy_slno'],
													'qc_status'=> $res_oldproduct['qc_status'],
													'qc_failedreason'=>$res_oldproduct['qc_failedreason'],													
													'sku'=>$res_oldproduct['sku'],
													'prod_name'=>$res_oldproduct['prod_name'],
													'descrp'=>$res_oldproduct['descrp'],
													'mrp'=>$res_oldproduct['mrp'],
													'sell_price'=>$res_oldproduct['sell_price'],
													'special_price'=>$res_oldproduct['special_price'],
													'splprice_fromdt'=>$res_oldproduct['splprice_fromdt'],
													'splprice_todate'=>$res_oldproduct['splprice_todate'],
													'quantity'=>$res_oldproduct['quantity'],
													'vat_cst'=>$res_oldproduct['vat_cst'],
													'weight'=>$res_oldproduct['weight'],
													'image_url1'=>$res_oldproduct['image_url1'],
													'image_url2'=>$res_oldproduct['image_url2'],
													'image_url3'=>$res_oldproduct['image_url3'],
													'image_url4'=>$res_oldproduct['image_url4'],
													'image_url5'=>$res_oldproduct['image_url5'],
													'shipfee_type'=>$res_oldproduct['shipfee_type'],
													'shipfee_amount'=>$res_oldproduct['shipfee_amount'],
													'status'=>$res_oldproduct['status'],
													'prod_highlt1'=>$res_oldproduct['prod_highlt1'],
													'prod_highlt2'=>$res_oldproduct['prod_highlt2'],
													'prod_highlt3'=>$res_oldproduct['prod_highlt3'],
													'prod_highlt4'=>$res_oldproduct['prod_highlt4'],
													'prod_highlt5'=>$res_oldproduct['prod_highlt5'],
													'country_mafg'=>$res_oldproduct['country_mafg'],
													'meta_title'=>$res_oldproduct['meta_title'],
													'meta_keyword'=>$res_oldproduct['meta_keyword'],
													'meta_descrp'=>$res_oldproduct['meta_descrp'],
													'attrb_groupuid'=>$res_oldproduct['attrb_groupuid'],
													'attrb_valueandid'=>$res_oldproduct['attrb_valueandid'],
													'upload_dtime'=>$res_oldproduct['upload_dtime'],
													'upload_status'=>$res_oldproduct['upload_status'],
													'new_sku'=>$res_oldproduct['new_sku'],
													'seller_productid'=>$res_oldproduct['seller_productid'],
													
												);
												
						$this->db->insert('bulkproduct_reuploadtemplog',$data_oldprodinfo);
						
						
						$this->db->insert('bulkproduct_reuploadlog',$data_oldprodinfo);	
						
											
		
		} // for loop end for product insert in bulkproduct_reuploadtemplog
		
		
		//-----------------------------------------------------Product Update In All Table Start-------------------------------------------//
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		$qr_excelfilname=$this->db->query("SELECT * FROM bulkprod_templatelog WHERE blk_tempid='$excelfiluploadid' ");
		$excl_filename=$qr_excelfilname->row()->excelfile_name;
		$upload_uid=$qr_excelfilname->row()->blk_tempid;
		
			//date_default_timezone_set('Asia/Calcutta');
			$dt = date('Y-m-d H:i:s');
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			$parent_query=$this->db->query("SELECT * FROM bulkprod_templatelog WHERE excelfile_name='$excl_filename' AND status='Expired' AND downlaod_parentid > 0 ");
			
			if($parent_query->num_rows()>0)
			{
						$rw_parentfileid=$parent_query->row();
						$parent_downlaodfileid=$rw_parentfileid->downlaod_parentid;
						
						if($parent_downlaodfileid>0)
						{ 
							$parent_filenamequery=$this->db->query("SELECT * FROM bulkprod_templatelog WHERE blk_tempid='$parent_downlaodfileid' AND (status='Expired' OR  status='Active' )");
							//$excl_filename=$rw_parentfileid->excelfile_name; 
							//$this->db->query("UPDATE bulkprod_templatelog SET status='Active' WHERE  blk_tempid='$parent_downlaodfileid'");
							$masteruploadprod_uid=$parent_filenamequery->row()->blk_tempid;
							//$this->db->query("DELETE FROM  bulkproductupload_log WHERE uploadprod_uid='$parent_downlaodfileid' AND qc_status='Failed' ");
							
							//$this->db->query("DELETE FROM  bulkproductupload_log WHERE uploadprod_uid='$parent_downlaodfileid' AND (upload_status='Pending' OR upload_status='Failed') ");
							
						}
			} 
			else
			{
				$parent_downlaodfileid=0;
				//$excl_filename=$excl_filename;	
			}
	
			//$maximumupload_id = $this->get_maximum_id('bulkprodedit_templatelog', 'upload_id');
			
			if($parent_downlaodfileid>0)
			{
				
				$upload_sequenceid=$parent_downlaodfileid;
			}
			else
			{
				$upload_sequenceid=0;	
			}
			$upload_dtime=$dt;
			
					
			
			//$seller_id=$this->input->post('hdntxt_sellerid');
			$seller_id=$qr_excelfilname->row()->seller_id;;
			
			$attrbset_query=$this->db->query("SELECT * FROM bulkprod_templatelog WHERE excelfile_name='$excl_filename' AND seller_id='$seller_id' AND status='Expired' ");
			
			
			
			if($attrbset_query->num_rows()==0)
			{
						/*$excl_filename=$excl_filename;
		
						$output_dir = "./bulkproductedit_excel/";						
						$filePath = $output_dir.$excl_filename;
						unlink($filePath);*/
				echo "<span style='text-align:center; color:#F00' > <img src=". base_url().'images/error.png'. ">Invalid File </span>";exit;
			}
			
			
				
				$attrbset_res=$attrbset_query->row();
				$dbsexcel_filename=$excl_filename;
				
				if($parent_downlaodfileid>0)
				{
					$uploadprod_uid=$masteruploadprod_uid;
				}else
				{
					$uploadprod_uid=$attrbset_query->row()->blk_tempid;
				}
				//$this->db->query("UPDATE bulkprodedit_templatelog SET upload_id='$maximumupload_id', upload_sequenceid='$upload_sequenceid', upload_dtime='$upload_dtime' WHERE  blk_tempid='$attrbset_res->blk_tempid' ");
			
				$inputFileName = './bulkproduct_excel/'.$excl_filename;
				
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
				$attrbset_query=$this->db->query("SELECT * FROM bulkprod_templatelog WHERE excelfile_name='$excl_filename' ");
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
					{
						 $attr_fld_name[]=$attr_fld_row['attribute_field_name'];
						 $attr_id[]=$attr_fld_row['attribute_id'];
						
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
					$c=31; 
					$row = '2';
						
							for($col = 1; $col != $attrb_countforexlcoulmn; $col++){
								
							  $cell = $sheet->getCellByColumnAndRow($c, $row);
							  $colIndex = PHPExcel_Cell::columnIndexFromString($cell->getColumn());
							  $attrb_exlcoulmnname[]=$cell->getColumn();
							 
								$c++;
						  }
						
		//Dynamically access of column address from excel sheet  end
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		$old_prodskuarr=array();
		$old_produploadstatus=array();
		
		$qr_oldproddata=$this->db->query("SELECT new_sku,upload_status FROM bulkproduct_reuploadtemplog WHERE uploadprod_uid='$upload_uid' ");
		foreach($qr_oldproddata->result_array() as $res_oldproddata)
		{
			$old_prodskuarr[]=$res_oldproddata['new_sku'];
			$old_produploadstatus[]=$res_oldproddata['upload_status'];
				
		}
		
			
			$oldprodku_sl=0;
			
			$sl=1;
			$qcfailed_resason=array();
			for($i=3; $i<=$arrayCount; $i++)
			{
				
				$newattr_id=array();
				$newattr_value=array();
				$newattr_fld_name=array();
				$attr_id_n_value = array();				
				$attr_id_n_value_length = 0;
				$attr_value=array();
				$qcfailed_resason=array();
				$data_prodinfo=array();
				
						
						//---------------------------------------Seller Product  Data Insert Start--------------------------------------------------------- 		
								
							if(trim($allDataInSheet[$i]['D'])!='')
							{
								//$moonboy_slno="MB".$uploadprod_uid.$sl;
								//$valid_editstatus=trim($allDataInSheet[$i]['D']);
								$valid_sku=trim($allDataInSheet[$i]['D']);
								$valid_prodname=trim($allDataInSheet[$i]['E']);
								$valid_proddecrp=trim($allDataInSheet[$i]['F']);
								$valid_mrp=trim($allDataInSheet[$i]['G']);		
								$valid_sellingprice=trim($allDataInSheet[$i]['H']);
								$valid_quantity=trim($allDataInSheet[$i]['L']);
								$valid_tax=trim($allDataInSheet[$i]['M']);
								$valid_weight=trim($allDataInSheet[$i]['N']);
								
								$valid_imageurl1=trim($allDataInSheet[$i]['O']);
								$valid_imageurl2=trim($allDataInSheet[$i]['P']);
								$valid_imageurl3=trim($allDataInSheet[$i]['Q']);
								$valid_imageurl4=trim($allDataInSheet[$i]['R']);
								$valid_imageurl5=trim($allDataInSheet[$i]['S']);
								
								
								
								$valid_shipfeetype=trim($allDataInSheet[$i]['T']);
								$valid_shipfeeamount=trim($allDataInSheet[$i]['U']);
								$valid_status=trim($allDataInSheet[$i]['V']);
								
								$valid_prodhlght1=trim($allDataInSheet[$i]['W']);
								$valid_prodhlght2=trim($allDataInSheet[$i]['X']);
								$valid_prodhlght3=trim($allDataInSheet[$i]['Y']);
								$valid_prodhlght4=trim($allDataInSheet[$i]['Z']);
								$valid_prodhlght5=trim($allDataInSheet[$i]['AA']);
								
								$valid_specialprice=trim($allDataInSheet[$i]['I']);
								$valid_specialprc_fromdate=trim($allDataInSheet[$i]['J']);
								$valid_specialprice_todate=trim($allDataInSheet[$i]['K']);
								
								$valid_countrymfg=trim($allDataInSheet[$i]['AB']);
								$valid_metatitle=trim($allDataInSheet[$i]['AC']);
								$valid_metakeyword=trim($allDataInSheet[$i]['AD']);
								$valid_metadescrp=trim($allDataInSheet[$i]['AE']);
								
								if($valid_sku=='')
								{array_push($qcfailed_resason,"SKU Blank");}
								
								if($valid_prodname=='')
								{array_push($qcfailed_resason,"Product Name Blank");}
								
								if($valid_proddecrp=='')
								{array_push($qcfailed_resason,"Decription Blank");}		
								
								if($valid_mrp=='')
								{array_push($qcfailed_resason,"MRP Blank");}
								
								
								
								if($valid_sellingprice=='')
								{array_push($qcfailed_resason,"Selling Price Blank");}
								
								
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
									{ 
										
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
										{ 
											
											$splprice_toatestatus="ok";
											
										}
										else
										{
												$splprice_toatestatus="ok";
										}
								
								}else
								{$splprice_fromdatestatus='';}
								
								
								
								if($valid_quantity=='')
								{array_push($qcfailed_resason,"Quantity Blank");}
								
								
									
								if($valid_tax=='')
								{array_push($qcfailed_resason,"VAT/CST Blank");}	
								
								
								
								if($valid_weight=='')	
								{array_push($qcfailed_resason,"Wight Blank");}	
								
								
								
							if($valid_prodhlght1=='' && $valid_prodhlght2=='' &&  $valid_prodhlght3=='' && $valid_prodhlght4=='' && $valid_prodhlght5=='')
								{	//$valid_prodhlighcell='';
									array_push($qcfailed_resason,"Product Highlights Blank");
								}
								
								
								if($valid_imageurl1=='' && $valid_imageurl2=='' &&  $valid_imageurl3=='' && $valid_imageurl4=='' && $valid_imageurl5=='')
								{	$valid_imagecell='';
									array_push($qcfailed_resason,"Image URL Blank");
								}
								
										
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
												
													$attr_value[]=trim($allDataInSheet[$i][$vattrbval]);
													
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
									
											$attr_id_n_value = array_combine($newattr_id,$newattr_value);
							
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
										$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
											$data_prodinfo=array();
											
											$data_prodinfo=array(													
													'qc_status'=>$qc_status,
													'qc_failedreason'=>$prodqc_status,													
													'sku'=>$valid_sku,
													'prod_name'=>$valid_prodname,
													'descrp'=>$valid_proddecrp,
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
													'prod_highlt1'=>$valid_prodhlght1,
													'prod_highlt2'=>$valid_prodhlght2,
													'prod_highlt3'=>$valid_prodhlght3,
													'prod_highlt4'=>$valid_prodhlght4,
													'prod_highlt5'=>$valid_prodhlght5,
													'country_mafg'=>$valid_countrymfg,
													'meta_title'=>$valid_metatitle,
													'meta_keyword'=>$valid_metakeyword,
													'meta_descrp'=>$valid_metadescrp,
													'attrb_groupuid'=>$attrbset_id,
													'attrb_valueandid'=>$attrid_n_valueserialz,
													'upload_dtime'=>$dt,
													'upload_status'=>$old_produploadstatus[$oldprodku_sl]
													);
																								
											
											$this->db->where('new_sku',$old_prodskuarr[$oldprodku_sl]);
											$this->db->update('bulkproduct_reuploadtemplog',$data_prodinfo);
											
										$oldprodku_sl++;
										$sl++;
								}
								
			} 
			
			
			//------------------------update in bulkproductupload_log start------------------//
							$qr_updtedoldproddata=$this->db->query("SELECT * FROM bulkproduct_reuploadtemplog WHERE uploadprod_uid='$excelfiluploadid' ");
								
								foreach($qr_updtedoldproddata->result_array() as $res_updtedoldproddata)
								{ $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
									
									$data_updatedprodinfo=array();
									$data_updatedprodinfo=array(													
													'qc_status'=>$res_updtedoldproddata['qc_status'],
													'qc_failedreason'=>$res_updtedoldproddata['qc_failedreason'],													
													'sku'=>$res_updtedoldproddata['sku'],
													'prod_name'=>$res_updtedoldproddata['prod_name'],
													'descrp'=>$res_updtedoldproddata['descrp'],
													'mrp'=>$res_updtedoldproddata['mrp'],
													'sell_price'=>$res_updtedoldproddata['sell_price'],
													'special_price'=>$res_updtedoldproddata['special_price'],
													'splprice_fromdt'=>$res_updtedoldproddata['splprice_fromdt'],
													'splprice_todate'=>$res_updtedoldproddata['splprice_todate'],
													'quantity'=>$res_updtedoldproddata['quantity'],
													'vat_cst'=>$res_updtedoldproddata['vat_cst'],
													'weight'=>$res_updtedoldproddata['weight'],
													'image_url1'=>$res_updtedoldproddata['image_url1'],
													'image_url2'=>$res_updtedoldproddata['image_url2'],
													'image_url3'=>$res_updtedoldproddata['image_url3'],
													'image_url4'=>$res_updtedoldproddata['image_url4'],
													'image_url5'=>$res_updtedoldproddata['image_url5'],
													'shipfee_type'=>$res_updtedoldproddata['shipfee_type'],
													'shipfee_amount'=>$res_updtedoldproddata['shipfee_amount'],
													'status'=>$res_updtedoldproddata['status'],
													'prod_highlt1'=>$res_updtedoldproddata['prod_highlt1'],
													'prod_highlt2'=>$res_updtedoldproddata['prod_highlt2'],
													'prod_highlt3'=>$res_updtedoldproddata['prod_highlt3'],
													'prod_highlt4'=>$res_updtedoldproddata['prod_highlt4'],
													'prod_highlt5'=>$res_updtedoldproddata['prod_highlt5'],
													'country_mafg'=>$res_updtedoldproddata['country_mafg'],
													'meta_title'=>$res_updtedoldproddata['meta_title'],
													'meta_keyword'=>$res_updtedoldproddata['meta_keyword'],
													'meta_descrp'=>$res_updtedoldproddata['meta_descrp'],
													'attrb_groupuid'=>$res_updtedoldproddata['attrb_groupuid'],
													'attrb_valueandid'=>$res_updtedoldproddata['attrb_valueandid'],
													'upload_dtime'=>$res_updtedoldproddata['upload_dtime'],
													'upload_status'=>$res_updtedoldproddata['upload_status']
													);
													
											
											
											$this->db->where('new_sku',$res_updtedoldproddata['new_sku']);
											$this->db->update('bulkproductupload_log',$data_updatedprodinfo);
											
											/*$new_skureupload=reupload_status;
											$this->db->query("UPDATE bulkproduct_reuploadlog SET reupload_status='Uploaded' WHERE new_sku='$new_skureupload' ");*/
										
								}
								
								//------------------------update in bulkproductupload_log end------------------//
								$this->db->query("TRUNCATE bulkproduct_reuploadtemplog");
								
								$this->update_reuploadedbulkupload($excelfiluploadid);
		//-----------------------------------------------------Product Update In All Table End----------------------------------------------//
		
		
			
			
			
	} // function end
	
	function update_reuploadedbulkupload($excelfiluploadid)
	{
		
		set_time_limit(0);
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			date_default_timezone_set('Asia/Calcutta');
			$dt = date('Y-m-d H:i:s');
	
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
		
		
		
		
		$qr_filedata=$this->db->query("SELECT * FROM bulkproductupload_log WHERE uploadprod_uid='$excelfiluploadid' AND qc_status='Passed' AND upload_status='uploaded' ");
		$res_filedata=$qr_filedata->result_array();
		
		
		
		//--------------------------------Main forloop Product Data insert start-------------------------
	foreach($res_filedata as $rw_filedata)
	{	
			$sl_sku=$rw_filedata['new_sku'];
			
			$qr_cronjobserch=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE sku='$sl_sku' ");
			
		if($qr_cronjobserch->num_rows()>0)
		{	
			$image='';
			$imag=array();
			$product_categoy_data=array();
			$product_inventory_data=array();
			$product_meta_data=array();
			$product_price_data=array();
			$product_general_data=array();
			$product_setting_data=array();
			$image_data=array();
			
		
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		
		
		/*$qr_slrprod1=$this->db->query("SELECT * FROM seller_product_general_info WHERE sku='$sl_sku' group by sku ");
		$rw_slr=$qr_slrprod1->row();
		
		$sl_sellerprodid=$rw_slr->seller_product_id;*/
		
		$sl_sellerprodid=$rw_filedata['seller_productid'];
		
		$qr_slrprod2=$this->db->query("SELECT * FROM product_master WHERE sku='$sl_sku' group by sku ");
		$rw_prodmast=$qr_slrprod2->row();
		
		$prodcutid_mast=$qr_slrprod2->row()->product_id;
		
		$product_setting_data = array(
						
			'seller_id' => $seller_id,
			'attribute_set' => $attrbset_id,
			'master_product_id'=>$prodcutid_mast
		);
		
		$this->db->where('seller_product_id',$rw_filedata['seller_productid']);
		$this->db->update('seller_product_setting',$product_setting_data);
		
	//--------------------------------Product update in seller_product_general_info table start------------------//
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		$prod_hlights=array();
		
		if($rw_filedata['prod_highlt1']!='')
		{$prod_hlights[]=$rw_filedata['prod_highlt1'];}
		
		if($rw_filedata['prod_highlt2']!='')
		{$prod_hlights[]=$rw_filedata['prod_highlt2'];}
		
		if($rw_filedata['prod_highlt3']!='')
		{$prod_hlights[]=$rw_filedata['prod_highlt3'];}
		
		if($rw_filedata['prod_highlt4']!='')
		{$prod_hlights[]=$rw_filedata['prod_highlt4'];}
		
		if($rw_filedata['prod_highlt5'])
		{$prod_hlights[]=$rw_filedata['prod_highlt5'];}
		
		
		$product_general_data = array(
			'seller_product_id'=>$sl_sellerprodid, 
			'name' => $rw_filedata['prod_name'],			
			'description' => $rw_filedata['descrp'],
			'short_desc' => serialize($prod_hlights),   
			'weight' =>$rw_filedata['weight'], 
			'status' => $rw_filedata['status'],			
			'manufacture_country' => $rw_filedata['country_mafg'],
			
		);	
		
		
		$this->db->where('sku',$sl_sku);
		$this->db->update('seller_product_general_info',$product_general_data);
		
		//--------------------------------Product update in seller_product_general_info table end------------------//
	
	 //--------------------------------Product update in seller_product_price_info table start------------------//
			
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		if($rw_filedata['special_price']>0 && $rw_filedata['splprice_fromdt']!='0000-00-00' && $rw_filedata['splprice_todate']!='0000-00-00')
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
		
		
		$product_price_data = array(
			
			'mrp' => $rw_filedata['mrp'],
			'special_price' => $rw_filedata['special_price'],
			'price' => $rw_filedata['sell_price'],
			'price_fr_dt' => $splprice_from_dt,
			'price_to_dt' => $splprice_to_dt,
			'tax_amount' => $rw_filedata['vat_cst'], 
			'shipping_fee' => $shipping_fee,
			'shipping_fee_amount' => $shipping_fee_amount,
		);
		
		$this->db->where('seller_product_id',$sl_sellerprodid);		
		$this->db->update('seller_product_price_info',$product_price_data);		
		
		
	 //--------------------------------Product update in seller_product_price_info table end------------------//
	 
	 
	  //--------------------------------Product update in seller_product_inventory_info table start------------------//		
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		$product_meta_data = array(
			
			'meta_title' => $rw_filedata['meta_title'],
			'meta_keyword' => $rw_filedata['meta_keyword'],
			'meta_description' => $rw_filedata['meta_descrp'] 
		);
		
		$this->db->where('seller_product_id',$sl_sellerprodid);		
		$this->db->update('seller_product_meta_info',$product_meta_data);
		
	//--------------------------------Product update in seller_product_inventory_info table end------------------//			
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		$product_inventory_data = array(			
			'quantity' => $rw_filedata['quantity'],		
			
		);
		
		
		$this->db->where('seller_product_id',$sl_sellerprodid);		
		$this->db->update('seller_product_inventory_info',$product_inventory_data);
				
		
		//--------------------------------Product update in seller_product_inventory_info table stop------------------//
		
		//---------------------------------------seller product data update in seller category table start----------------------//
	    $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			$sellr_productcatg=array();
			
			$sellr_productcatg=array(
				'category' => $category_id,
				
			);
			
			$this->db->where('seller_product_id',$sl_sellerprodid);
			$this->db->update('seller_product_category',$sellr_productcatg);
		
		//---------------------------------------seller product data update in seller category table end----------------------//
		
			
		
		//--------------------------------Product update in product_general_info table end------------------//
			
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			$masterproduct_general_data=array();
			
			$masterproduct_general_data=array(
				'name'=>$rw_filedata['prod_name'],
				'description'=>$rw_filedata['descrp'],
				'short_desc'=>serialize($prod_hlights),
				'weight'=>$rw_filedata['weight'],
			
			);
		
			$this->db->where('product_id',$prodcutid_mast);			
			$this->db->update('product_general_info',$masterproduct_general_data);
		
		//----------------------------------Product update in product_general_info table start---------------//
		
		
		//--------------------------------Product update in product_master table start------------------//
			
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			$masterproduct_master_data=array();
			
			$masterproduct_master_data=array(
				'seller_id'=>$seller_id, 
				'status'=>$rw_filedata['status'],
				'manufacture_country'=>$rw_filedata['country_mafg'],
				'price'=>$rw_filedata['sell_price'],
				'mrp'=>$rw_filedata['mrp'],
				'special_price'=>$rw_filedata['special_price'],
				'special_pric_from_dt'=> $splprice_from_dt,
				'special_pric_to_dt'=> $splprice_to_dt, 
				'tax_amount'=>$rw_filedata['vat_cst'],
				'shipping_fee'=>$shipping_fee,
				'shipping_fee_amount'=>$shipping_fee_amount,
				'quantity'=>$rw_filedata['quantity'],
				
			
			);
		
			//$this->db->where('product_id',$prodcutid_mast);
			$this->db->where('sku',$sl_sku);				
			$this->db->update('product_master',$masterproduct_master_data);
		
		//----------------------------------Product update in product_master table end---------------//
		
		
		//---------------------------------Product update in product_meta_info start-------------------------//
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			$masterproduct_meta_data=array();
			
			$masterproduct_meta_data=array(
				'meta_title'=>$rw_filedata['meta_title'],
				'meta_keywords'=>$rw_filedata['meta_keyword'],
				'meta_desc'=>$rw_filedata['meta_descrp']
			
			);
			
			$this->db->where('product_id',$prodcutid_mast);							
			$this->db->update('product_meta_info',$masterproduct_meta_data);
		//---------------------------------Product update in product_meta_info end-------------------------//
		
		
		
		//---------------------------------------------attribute insert code start---------------------------------------//
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
				$cron_imag='';
				$cron_brand='';
				$cron_color='';
				$cron_size='';
				$cronsub_size='';
				$cron_type='';
				$cron_occasion='';
				$cron_Capacity='';
				$cron_RAM ='';
				$cron_ROM='';
				
				$curprice_query=$this->db->query("
				
				SELECT CASE WHEN special_price !=0 AND CURDATE() BETWEEN price_fr_dt AND price_to_dt
				THEN special_price
				WHEN price !=0
				THEN price 
				ELSE mrp
				END FINAL_PRICE				
				FROM seller_product_price_info  WHERE seller_product_id='$sl_sellerprodid' ;
				
				");
				
				$rw_curprice=$curprice_query->result();
				
				$current_price=$rw_curprice[0]->FINAL_PRICE;
		
				
				
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
					if($sz_sql->num_rows()>0)
					{
						$sz_row = $sz_sql->row();
						$sz_id = $sz_row->size_id;
						$product_sz_attr_data = array(
							//'sku_id' => $sku,
							'm_size_id' => $sz_id,
							'm_size_name' => $newattr_value[$atr]
						);
						
						$cron_size=$newattr_value[$atr];
						
						$this->db->where('sku_id',$sl_sku);
						$this->db->where('m_size_id',$sz_id);
								
						$this->db->update('size_attr',$product_sz_attr_data);
					}
					
				}
			}
			
			//progrm for sub size attribute
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			
			if($newattr_fld_name[$atr] == 'Size Type'){
				if($attr_value[$atr] != ''){
					$sb_sz_sql = $this->db->query("SELECT size_id FROM size_master WHERE size_name='$newattr_value[$atr]'");
					if($sb_sz_sql->num_rows() > 0)
					{
							$sb_sz_row = $sb_sz_sql->row();
							$sb_sz_id = $sb_sz_row->size_id;
							$product_sb_sz_attr_data = array(
								//'sku_id' => $sku,
								's_size_id' => $sb_sz_id,
								's_size_name' => $newattr_value[$atr]
							);
							
							//program start for checking if sku is exits or not in size_attr table and insert or update
							$sq = $this->db->query("SELECT * FROM size_attr WHERE sku_id='$sl_sku'");
							if($sq->num_rows() > 0){
								$product_sb_sz_attr_data1 = array(
									's_size_id' => $sb_sz_id,
									's_size_name' => $newattr_value[$atr]
								);
								$this->db->where('sku_id',$sl_sku);
								$this->db->update('size_attr',$product_sb_sz_attr_data1);
							}else{
								$this->db->insert('size_attr',$product_sb_sz_attr_data);
							}
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
						$clor_row = $clor_sql->row();
						$clor_id = $clor_row->color_id;
						$product_color_attr_data = array(
							//'sku_id' => $sku,
							'color_id' => $clor_id,
							'clr_name' => $newattr_value[$atr]
						);
						
						$cron_color=$newattr_value[$atr];
						
						$this->db->where('sku_id',$sl_sku);
						$this->db->update('color_attr',$product_color_attr_data);					
						
					}
					
				}
			}
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			
			$insert_otherattrbid=$newattr_id[$atr];
			$insert_otherattrbvalue=$newattr_value[$atr];
			
			$qr_attrbupdate=$this->db->query("SELECT * FROM seller_product_attribute_value WHERE sku='$sl_sku' AND  attr_id='$insert_otherattrbid' ");
			if($qr_attrbupdate->num_rows()==0)
			{
				$product_attr_data = array(
					'seller_product_id' => $sl_sellerprodid,
					'sku' => $sl_sku,
					'attr_id' => $newattr_id[$atr],
					'attr_value' => $newattr_value[$atr], 
				);
				$this->db->insert('seller_product_attribute_value',$product_attr_data);	
			}
			else{
								
				$this->db->query("UPDATE seller_product_attribute_value SET attr_id='$insert_otherattrbid' ,attr_value='$insert_otherattrbvalue' WHERE sku='$sl_sku' AND attr_id='$insert_otherattrbid'  ");	 
			}
			
			
					if($newattr_fld_name[$atr] == 'Brand' || $newattr_fld_name[$atr] == 'brand')
					{
						if($newattr_value[$atr] != '')
						{$cron_brand=$newattr_value[$atr];}
					
					}
					
					if($newattr_fld_name[$atr] == 'Sub size' || $newattr_fld_name[$atr] == 'sub size')
					{
						if($newattr_value[$atr] != '')
						{$cronsub_size=$newattr_value[$atr];}
					
					}
					
					
					if($newattr_fld_name[$atr] == 'Type' || $newattr_fld_name[$atr] == 'type')
					{
						if($newattr_value[$atr] != '')
						{$cron_type=$newattr_value[$atr];}
					
					}
					
					if($newattr_fld_name[$atr] == 'Occasion' || $newattr_fld_name[$atr] == 'occasion')
					{
						if($newattr_value[$atr] != '')
						{$cron_occasion=$newattr_value[$atr];}
					
					}
					
					if($newattr_fld_name[$atr] == 'Capacity' || $newattr_fld_name[$atr] == 'capacity')
					{
						if($newattr_value[$atr] != '')
						{$cron_Capacity=$newattr_value[$atr];}
					
					}
					
					if($newattr_fld_name[$atr] == 'RAM' || $newattr_fld_name[$atr] == 'ram')
					{
						if($newattr_value[$atr] != '')
						{$cron_RAM=$newattr_value[$atr];}
					
					}
					
					if($newattr_fld_name[$atr] == 'ROM' || $newattr_fld_name[$atr] == 'rom')
					{
						if($newattr_value[$atr] != '')
						{$cron_ROM=$newattr_value[$atr];}
					
					}
		
			
		
			
		}
		
	//---------------------------------------------attribute insert code end---------------------------------------//
	
	
		
		
	//------------------------image upload  start---------------------------------------------------------------------//
		
		 //--------------------------------image upload for imageURL1 start------------------------------------//	
		 //$this->load->helper('download');	
		 $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		 
		 $all_imgarray=array();
		 $all_imgarray=array('0'=>'','1'=>'','2'=>'','3'=>'','4'=>'');
		 
			 $qr_oldprodimage=$this->db->query("SELECT * FROM seller_product_image WHERE seller_product_id='$sl_sellerprodid' ");
			 
			 $all_dbimgstr=$qr_oldprodimage->row()->image;
			 $all_dbimgarr=explode(',', $all_dbimgstr);			 
			 
			 $catalog_dbimgname=$qr_oldprodimage->row()->catelog_img_url;
			 
		 	 
			 for($img_ctr=0; $img_ctr<count($all_dbimgarr); $img_ctr++)
			 {
				$all_imgarray[$img_ctr]=$all_dbimgarr[$img_ctr];		 
			 }
			 
			$dt_img = preg_replace("/[^0-9]+/","", date('Y-m-d H:i:s'));
			
			if($rw_filedata['image_url1']!=''   )
			{ 	error_reporting(0);
				//---------------old image delete from folder start-----------------------//
					if($all_imgarray[0]!='')	
					{	$oldimage_filename=$all_imgarray[0];
		
						$output_dir = "./images/product_img/";					
						
						$filePath = $output_dir.$catalog_dbimgname;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
												
						$filePath = $output_dir.'original_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'2000x2000_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'thumbnil_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
					}
				//---------------old image delete from folder end-----------------------//
						 
				
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
				
				 
			}
			
			//--------------------------------image upload for imageURL1 end------------------------------------
			
			//--------------------------------image upload for imageURL2 start------------------------------------		
			if($rw_filedata['image_url2']!=''  )
			{error_reporting(0);
				
				
				//---------------old image delete from folder start-----------------------//
					if($all_imgarray[1]!='')
					{	
						$oldimage_filename=$all_imgarray[1];
		
						$output_dir = "./images/product_img/";					
											
						$filePath = $output_dir.'original_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'2000x2000_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'thumbnil_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
					}
				//---------------old image delete from folder end-----------------------//
				
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
				
				 
			}
			
			//--------------------------------image upload for imageURL2 end------------------------------------
			
			
			//--------------------------------image upload for imageURL3 start------------------------------------		
			if($rw_filedata['image_url3']!=''   )
			{error_reporting(0);
				
				//---------------old image delete from folder start-----------------------//
					if($all_imgarray[2]!='')	
					{	$oldimage_filename=$all_imgarray[2];
		
						$output_dir = "./images/product_img/";					
											
						$filePath = $output_dir.'original_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'2000x2000_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'thumbnil_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
					}
				//---------------old image delete from folder end-----------------------//
				
				
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
			 
			}
			
			//--------------------------------image upload for imageURL3 end------------------------------------
			
			
			
			//--------------------------------image upload for imageURL4 start------------------------------------		
			if($rw_filedata['image_url4']!=''   )
			{error_reporting(0);
				
				
				//---------------old image delete from folder start-----------------------//
					if($all_imgarray[3]!='')
					{	$oldimage_filename=$all_imgarray[3];
		
						$output_dir = "./images/product_img/";					
											
						$filePath = $output_dir.'original_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'2000x2000_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'thumbnil_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
					}
				//---------------old image delete from folder end-----------------------//
				
				
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
				
				 
			}
			
			//--------------------------------image upload for imageURL4 end------------------------------------
			
			
			//--------------------------------image upload for imageURL5 start------------------------------------		
			if($rw_filedata['image_url5']!=''   )
			{error_reporting(0);
				
				
				//---------------old image delete from folder start-----------------------//
				if($all_imgarray[4]!='')
				{		$oldimage_filename=$all_imgarray[4];
		
						$output_dir = "./images/product_img/";					
											
						$filePath = $output_dir.'original_'.$oldimage_filename;					
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'2000x2000_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'thumbnil_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
				}
				//---------------old image delete from folder end-----------------------//
				
				
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
				
				 
			}
			
			//--------------------------------image upload for imageURL5 end------------------------------------		 
				 
		//------------------------image upload  end-----------------------------------------------------------------------
			
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		$image=implode(',',$imag);
		
		$image_data=array();
		$image_data = array(
			//'seller_product_id' => $sl_sellerprodid,
			'image' => $image,
			'catelog_img_url' => 'catalog_'.$imag[0]
			
		);
		
		
		$this->db->where('seller_product_id',$sl_sellerprodid);		
		$this->db->update('seller_product_image',$image_data);
		
		$masterimage_data=array();
		$masterimage_data = array(
			
			'imag' => $image,
			'catelog_img_url' => 'catalog_'.$imag[0]
			
		);
		
		
		$this->db->where('product_id',$prodcutid_mast);		
		$this->db->update('product_image',$masterimage_data);	
		
		//$this->db->insert('seller_product_image',$image_data);
		//program end of retrieve image from temp_imge table and insert in product_imag table//
		
		
				//---------------------------------Product update in cornjob_productsearch start--------------------//
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			$cronjobproduct_data=array();
			
			$qr_ctginfo=$this->db->query("SELECT * FROM temp_category WHERE lvl2='$category_id' ");
			$lvl2=$qr_ctginfo->row()->lvl2;
			$lvl2_name=$qr_ctginfo->row()->lvl2_name;
			$lvl1=$qr_ctginfo->row()->lvl1;
			$lvl1_name=$qr_ctginfo->row()->lvl1_name;
			$lvlmain=$qr_ctginfo->row()->lvlmain;
			$lvlmain_name=$qr_ctginfo->row()->lvlmain_name;
			
			$cronjobproduct_data=array(
				'lvl2'=>$lvl2,
				'lvl2_name'=>$lvl2_name,
				'lvl1'=>$lvl1,
				'lvl1_name'=>$lvl1_name,
				'lvlmain'=>	$lvlmain,
				'lvlmain_name'=>$lvlmain_name,	
				'name'=>$rw_filedata['prod_name'],
				'seller_id'=>$seller_id, 
				'imag'=>'catalog_'.$imag[0],
				'brand'=>$cron_brand, 
				'current_price'=>$current_price,
				'color'=>$cron_color,
				'size'=>$cron_size,
				'sub_size'=>$cronsub_size,
				'type'=>$cron_type,
				'occasion'=>$cron_occasion,
				'Capacity'=>$cron_Capacity,
				'RAM'=>$cron_RAM,
				'ROM'=>$cron_ROM,
				'mrp'=>$rw_filedata['mrp'],
				'price'=>$rw_filedata['sell_price'],
				'special_price'=>$rw_filedata['special_price'],
				'special_pric_from_dt'=> $splprice_from_dt,
				'special_pric_to_dt'=> $splprice_to_dt,
				'status'=>$rw_filedata['status'],
				'quantity'=>$rw_filedata['quantity'],
				'seller_status'=>'Active',
				'prod_status'=>'Active'
				
			);
			
			
			$this->db->where('sku',$sl_sku);						
			$this->db->update('cornjob_productsearch',$cronjobproduct_data);
			
		//---------------------------------Product update in cornjob_productsearch end--------------------//
		
		
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		
		$this->db->query("UPDATE bulkproduct_reuploadlog SET reupload_status='Uploaded' WHERE new_sku='$sl_sku' ");
		
		/*$uplodprd_id=$rw_filedata['uploadprod_sqlid'];
		$this->db->query("UPDATE bulk_editedproductupload_log SET upload_status='Uploaded' , upload_dtime='$dt', 
		seller_productid='$sl_sellerprodid',master_productid='$prodcutid_mast' WHERE uploadprod_sqlid='$uplodprd_id' ");*/
		
	} //main if condition else part start 
	
	
	else
	{
		
		//*********************************************else part if product not in cronjobproduct_search table start*********************************//
		
			//=================================================Old product data and image delete start=============================================//
			
				$qr_slroldprodinfo=$this->db->query("SELECT seller_product_id FROM seller_product_general_info WHERE sku='$sl_sku' group by sku ");
				
				if($qr_slroldprodinfo->num_rows()>0)
				{
						$seller_oldproductid=$qr_slroldprodinfo->row()->seller_product_id;
						
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
									
									} // image value not blank condition end
									
								}
										 
							 }		
							
							
						
						}
						//-------------------------------------image delete from folder end---------------------------//
						
						//-----------------------Seller Product Data Delete from all seller Table start------------------------------//
							
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
				
				$qr_masteroldprodinfo=$this->db->query("SELECT product_id FROM product_master WHERE sku='$sl_sku' group by sku ");
				
				if($qr_masteroldprodinfo->num_rows()>0)
				{
						$master_oldproductid=$qr_masteroldprodinfo->row()->product_id;
						
						//-----------------------Master Product Data Delete from all seller Table start------------------------------//							
							
							$this->db->query("DELETE FROM product_category WHERE product_id='$master_oldproductid' ");							
							$this->db->query("DELETE FROM product_general_info WHERE product_id='$master_oldproductid' ");							
							$this->db->query("DELETE FROM product_image WHERE product_id='$master_oldproductid' ");							
							$this->db->query("DELETE FROM product_setting WHERE product_id='$master_oldproductid' ");							
							$this->db->query("DELETE FROM product_master WHERE sku='$sl_sku' ");							
							$this->db->query("DELETE FROM product_meta_info WHERE product_id='$master_oldproductid' ");
							
							$this->db->query("DELETE FROM color_attr WHERE sku_id='$sl_sku' ");
							$this->db->query("DELETE FROM size_attr WHERE sku_id='$sl_sku' ");
							
						//-----------------------Master Product Data Delete from all seller Table end------------------------------//
				}
				
			//=================================================Old product data and image delete end=============================================//
			
			
		//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Product Add as New Product Start~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
		
			
			
			$image='';
			$imag=array();
			$product_categoy_data=array();
			$product_inventory_data=array();
			$product_meta_data=array();
			$product_price_data=array();
			$product_general_data=array();
			$product_setting_data=array();
			$image_data=array();
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			$seller_product_id = $this->get_seller_product_id('seller_product_setting', 'seller_product_id');
			//----------------sku generate start----------------
			$chars = 4;
			$letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$rand_letter = substr(str_shuffle($letters), 0, $chars);
			$sku1 = str_replace(' ','-',$rw_filedata['sku']);
			$sku = $rand_letter.'-'.$seller_id.'-'.$sku1;
		//----------------sku generate end----------------	
		
			$product_setting_data = array(
			'seller_product_id' => $seller_product_id,
			'seller_id' => $seller_id,
			'attribute_set' => $attrbset_id,
			//'product_type' => $this->input->post('product_type'),
		);
		$this->db->insert('seller_product_setting', $product_setting_data);
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		$prod_hlights=array();
		
		if($rw_filedata['prod_highlt1']!='')
		{$prod_hlights[]=$rw_filedata['prod_highlt1'];}
		
		if($rw_filedata['prod_highlt2']!='')
		{$prod_hlights[]=$rw_filedata['prod_highlt2'];}
		
		if($rw_filedata['prod_highlt3']!='')
		{$prod_hlights[]=$rw_filedata['prod_highlt3'];}
		
		if($rw_filedata['prod_highlt4']!='')
		{$prod_hlights[]=$rw_filedata['prod_highlt4'];}
		
		if($rw_filedata['prod_highlt5'])
		{$prod_hlights[]=$rw_filedata['prod_highlt5'];}
		
		
		$product_general_data = array(
			'seller_product_id' => $seller_product_id,
			'name' => $rw_filedata['prod_name'], 
			'sku' => $sku,
			'description' => $rw_filedata['descrp'],
			'short_desc' => serialize($prod_hlights),   
			'weight' =>$rw_filedata['weight'], 
			'status' => $rw_filedata['status'],
			//'product_fr_dt' =>$product_fr_dt,
			//'product_to_dt' =>$product_to_dt,
			//'visibility' => $this->input->post('visibility'),
			'manufacture_country' => $rw_filedata['country_mafg'],
			//'featured' => ' ',
		);	
		
		$this->db->insert('seller_product_general_info', $product_general_data);
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		if($rw_filedata['special_price']>0)
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
		
		
		$product_price_data = array(
			'seller_product_id' => $seller_product_id,
			'mrp' => $rw_filedata['mrp'],
			'special_price' => $rw_filedata['special_price'],
			'price' => $rw_filedata['sell_price'],
			'price_fr_dt' => $splprice_from_dt,
			'price_to_dt' => $splprice_to_dt,
			'tax_amount' => $rw_filedata['vat_cst'], 
			'shipping_fee' => $shipping_fee,
			'shipping_fee_amount' => $shipping_fee_amount,
		);
		$this->db->insert('seller_product_price_info', $product_price_data);
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		$product_meta_data = array(
			'seller_product_id' => $seller_product_id,
			'meta_title' => $rw_filedata['meta_title'],
			'meta_keyword' => $rw_filedata['meta_keyword'],
			'meta_description' => $rw_filedata['meta_descrp'] 
		);
		$this->db->insert('seller_product_meta_info', $product_meta_data);
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		$product_inventory_data = array(
			'seller_product_id' => $seller_product_id,
			'quantity' => $rw_filedata['quantity'], 
			//'max_quantity' => $this->input->post('max_qty_allowed'),
			//'qty_increment' => $this->input->post('qty_increment'),
			//'stock_avail' => $this->input->post('stock_avail'),
		);
		$this->db->insert('seller_product_inventory_info', $product_inventory_data);	
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		$product_categoy_data = array(
			'seller_product_id' =>$seller_product_id,
			'category' =>$category_id,
		);
		$this->db->insert('seller_product_category', $product_categoy_data);
		
		
		
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
					$sz_row = $sz_sql->row();
					$sz_id = $sz_row->size_id;
					$product_sz_attr_data = array(
						'sku_id' => $sku,
						'm_size_id' => $sz_id,
						'm_size_name' => $newattr_value[$atr]
					);
					$this->db->insert('size_attr',$product_sz_attr_data);
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
						$clor_row = $clor_sql->row();
						$clor_id = $clor_row->color_id;
						$product_color_attr_data = array(
							'sku_id' => $sku,
							'color_id' => $clor_id,
							'clr_name' => $newattr_value[$atr]
						);
						$this->db->insert('color_attr',$product_color_attr_data);
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
			 	 $newattr_id[$atr];
			 	 $newattr_value[$atr];
			
			$this->db->insert('seller_product_attribute_value',$product_attr_data);
		}
		
	//---------------------------------------------attribute insert code end---------------------------------------	
		
		
				//------------------------image upload  start---------------------------------------------------------------------
		$dt_img = preg_replace("/[^0-9]+/","", date('Y-m-d H:i:s'));
		 //--------------------------------image upload for imageURL1 start------------------------------------	
		 //$this->load->helper('download');	
		 $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		 
			if($rw_filedata['image_url1']!='')
			{ error_reporting(0);
				
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
				
				 
			}
			//--------------------------------image upload for imageURL1 end------------------------------------
			
			//--------------------------------image upload for imageURL2 start------------------------------------		
			if($rw_filedata['image_url2']!='')
			{error_reporting(0);
				
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
				
				 
			}
			//--------------------------------image upload for imageURL2 end------------------------------------
			
			
			//--------------------------------image upload for imageURL3 start------------------------------------		
			if($rw_filedata['image_url3']!='')
			{error_reporting(0);
				
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
				
				 
			}
			//--------------------------------image upload for imageURL3 end------------------------------------
			
			
			
			//--------------------------------image upload for imageURL4 start------------------------------------		
			if($rw_filedata['image_url4']!='')
			{error_reporting(0);
				
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
				
				 
			}
			//--------------------------------image upload for imageURL4 end------------------------------------
			
			
			//--------------------------------image upload for imageURL5 start------------------------------------		
			if($rw_filedata['image_url5']!='')
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
				
				 
			}
			//--------------------------------image upload for imageURL5 end------------------------------------		 
				 
		//------------------------image upload  end-----------------------------------------------------------------------
		
				
		$image=implode(',',$imag); 
		$image_data = array(
			'seller_product_id' => $seller_product_id,
			'image' => $image,
			'catelog_img_url' => 'catalog_'.$imag[0]
			
		);
		$this->db->insert('seller_product_image',$image_data);
		//program end of retrieve image from temp_imge table and insert in product_imag table//
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		$uplodprd_id=$rw_filedata['uploadprod_sqlid'];
		$this->db->query("UPDATE bulkproductupload_log SET upload_status='Uploaded' , upload_dtime='$dt', new_sku='$sku' ,
		seller_productid='$seller_product_id' WHERE uploadprod_sqlid='$uplodprd_id' ");
				
		
		//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Product Approve Start>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//
		
				//$sql="call single_newproductapproval(".$seller_product_id.");";

				//$this->db->query($sql);
			
		//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Product Approve End>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//	
			
			
		//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Product Add as New Product End~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
			
				
	
	//***********************************************else part if product not in cronjobproduct_search table end******************************************//
	
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		
		$this->db->query("UPDATE bulkproduct_reuploadlog SET reupload_status='Uploaded' WHERE new_sku='$sl_sku' ");
	
	
	} // main if condition end
	
	
		
  } // main for loop end
		
		//--------------------------------Main forloop Product Data insert end-------------------------
		//$maxupload_id = $this->get_maximum_id('bulkprod_templatelog', 'upload_id');
		
		/*$this->db->query("UPDATE bulkprodedit_templatelog SET status='Expired', upload_id='$maxupload_id' WHERE blk_tempid='$excelfiluploadid' AND  status='Active' ");*/
		
		
		//$this->db->query("UPDATE bulkprodedit_templatelog SET status='Expired' WHERE downlaod_parentid='$excelfiluploadid' ");
		
		//$this->db->trans_complete();
	
	$enddtm = date('Y-m-d H:i:s');
	$this->db->query("UPDATE bulkprod_templatelog set reupload_processstatus='not process',reupload_enddatetime='$enddtm' where blk_tempid='$excelfiluploadid' ");
	
	} // function end
	
	function select_reuploadloglist()
	{
		$query=$this->db->query("SELECT * FROM bulkprod_templatelog a INNER JOIN  bulkproduct_reuploadlog b ON a.blk_tempid=b.uploadprod_uid
		WHERE upload_status='Uploaded' GROUP BY b.uploadprod_uid ORDER BY a.blk_tempid DESC ");

		
		return $query;	
	}
	
	
	
	function get_seller_product_id($table, $field){
		$query = $this->db->query("SELECT MAX($field) AS `maxid` FROM ".$table);
		$maxId = $query->row()->maxid;
		$id = $maxId+1;
		return $id;
	}
	
	
	function manualcheck_reuploadfail($excelfiluploadid,$chkskuids_string)
	{
		
		
		set_time_limit(0);
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			date_default_timezone_set('Asia/Calcutta');
			$dt = date('Y-m-d H:i:s');
	
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
		
		
		
		
		$qr_filedata=$this->db->query("SELECT * FROM bulkproductupload_log WHERE uploadprod_uid='$excelfiluploadid' AND qc_status='Passed' AND upload_status='uploaded' AND new_sku IN ($chkskuids_string) ");
		$res_filedata=$qr_filedata->result_array();
		
		
		
		//--------------------------------Main forloop Product Data insert start-------------------------
	foreach($res_filedata as $rw_filedata)
	{	
			$sl_sku=$rw_filedata['new_sku'];
			
			$qr_cronjobserch=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE sku='$sl_sku' ");
			
		if($qr_cronjobserch->num_rows()>0)
		{	
			$image='';
			$imag=array();
			$product_categoy_data=array();
			$product_inventory_data=array();
			$product_meta_data=array();
			$product_price_data=array();
			$product_general_data=array();
			$product_setting_data=array();
			$image_data=array();
			
		
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		
		
		/*$qr_slrprod1=$this->db->query("SELECT * FROM seller_product_general_info WHERE sku='$sl_sku' group by sku ");
		$rw_slr=$qr_slrprod1->row();
		
		$sl_sellerprodid=$rw_slr->seller_product_id;*/
		
		$sl_sellerprodid=$rw_filedata['seller_productid'];
		
		$qr_slrprod2=$this->db->query("SELECT * FROM product_master WHERE sku='$sl_sku' group by sku ");
		$rw_prodmast=$qr_slrprod2->row();
		
		$prodcutid_mast=$qr_slrprod2->row()->product_id;
		
		$product_setting_data = array(
						
			'seller_id' => $seller_id,
			'attribute_set' => $attrbset_id,
			'master_product_id'=>$prodcutid_mast
		);
		
		$this->db->where('seller_product_id',$rw_filedata['seller_productid']);
		$this->db->update('seller_product_setting',$product_setting_data);
		
	//--------------------------------Product update in seller_product_general_info table start------------------//
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		$prod_hlights=array();
		
		if($rw_filedata['prod_highlt1']!='')
		{$prod_hlights[]=$rw_filedata['prod_highlt1'];}
		
		if($rw_filedata['prod_highlt2']!='')
		{$prod_hlights[]=$rw_filedata['prod_highlt2'];}
		
		if($rw_filedata['prod_highlt3']!='')
		{$prod_hlights[]=$rw_filedata['prod_highlt3'];}
		
		if($rw_filedata['prod_highlt4']!='')
		{$prod_hlights[]=$rw_filedata['prod_highlt4'];}
		
		if($rw_filedata['prod_highlt5'])
		{$prod_hlights[]=$rw_filedata['prod_highlt5'];}
		
		
		$product_general_data = array(
			'seller_product_id'=>$sl_sellerprodid, 
			'name' => $rw_filedata['prod_name'],			
			'description' => $rw_filedata['descrp'],
			'short_desc' => serialize($prod_hlights),   
			'weight' =>$rw_filedata['weight'], 
			'status' => $rw_filedata['status'],			
			'manufacture_country' => $rw_filedata['country_mafg'],
			
		);	
		
		
		$this->db->where('sku',$sl_sku);
		$this->db->update('seller_product_general_info',$product_general_data);
		
		//--------------------------------Product update in seller_product_general_info table end------------------//
	
	 //--------------------------------Product update in seller_product_price_info table start------------------//
			
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		if($rw_filedata['special_price']>0 && $rw_filedata['splprice_fromdt']!='0000-00-00' && $rw_filedata['splprice_todate']!='0000-00-00')
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
		
		
		$product_price_data = array(
			
			'mrp' => $rw_filedata['mrp'],
			'special_price' => $rw_filedata['special_price'],
			'price' => $rw_filedata['sell_price'],
			'price_fr_dt' => $splprice_from_dt,
			'price_to_dt' => $splprice_to_dt,
			'tax_amount' => $rw_filedata['vat_cst'], 
			'shipping_fee' => $shipping_fee,
			'shipping_fee_amount' => $shipping_fee_amount,
		);
		
		$this->db->where('seller_product_id',$sl_sellerprodid);		
		$this->db->update('seller_product_price_info',$product_price_data);		
		
		
	 //--------------------------------Product update in seller_product_price_info table end------------------//
	 
	 
	  //--------------------------------Product update in seller_product_inventory_info table start------------------//		
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		$product_meta_data = array(
			
			'meta_title' => $rw_filedata['meta_title'],
			'meta_keyword' => $rw_filedata['meta_keyword'],
			'meta_description' => $rw_filedata['meta_descrp'] 
		);
		
		$this->db->where('seller_product_id',$sl_sellerprodid);		
		$this->db->update('seller_product_meta_info',$product_meta_data);
		
	//--------------------------------Product update in seller_product_inventory_info table end------------------//			
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		$product_inventory_data = array(			
			'quantity' => $rw_filedata['quantity'],		
			
		);
		
		
		$this->db->where('seller_product_id',$sl_sellerprodid);		
		$this->db->update('seller_product_inventory_info',$product_inventory_data);
				
		
		//--------------------------------Product update in seller_product_inventory_info table stop------------------//
		
		//---------------------------------------seller product data update in seller category table start----------------------//
	    $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			$sellr_productcatg=array();
			
			$sellr_productcatg=array(
				'category' => $category_id,
				
			);
			
			$this->db->where('seller_product_id',$sl_sellerprodid);
			$this->db->update('seller_product_category',$sellr_productcatg);
		
		//---------------------------------------seller product data update in seller category table end----------------------//
		
			
		
		//--------------------------------Product update in product_general_info table end------------------//
			
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			$masterproduct_general_data=array();
			
			$masterproduct_general_data=array(
				'name'=>$rw_filedata['prod_name'],
				'description'=>$rw_filedata['descrp'],
				'short_desc'=>serialize($prod_hlights),
				'weight'=>$rw_filedata['weight'],
			
			);
		
			$this->db->where('product_id',$prodcutid_mast);			
			$this->db->update('product_general_info',$masterproduct_general_data);
		
		//----------------------------------Product update in product_general_info table start---------------//
		
		
		//--------------------------------Product update in product_master table start------------------//
			
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			$masterproduct_master_data=array();
			
			$masterproduct_master_data=array(
				'seller_id'=>$seller_id, 
				'status'=>$rw_filedata['status'],
				'manufacture_country'=>$rw_filedata['country_mafg'],
				'price'=>$rw_filedata['sell_price'],
				'mrp'=>$rw_filedata['mrp'],
				'special_price'=>$rw_filedata['special_price'],
				'special_pric_from_dt'=> $splprice_from_dt,
				'special_pric_to_dt'=> $splprice_to_dt, 
				'tax_amount'=>$rw_filedata['vat_cst'],
				'shipping_fee'=>$shipping_fee,
				'shipping_fee_amount'=>$shipping_fee_amount,
				'quantity'=>$rw_filedata['quantity'],
				
			
			);
		
			//$this->db->where('product_id',$prodcutid_mast);
			$this->db->where('sku',$sl_sku);				
			$this->db->update('product_master',$masterproduct_master_data);
		
		//----------------------------------Product update in product_master table end---------------//
		
		
		//---------------------------------Product update in product_meta_info start-------------------------//
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			$masterproduct_meta_data=array();
			
			$masterproduct_meta_data=array(
				'meta_title'=>$rw_filedata['meta_title'],
				'meta_keywords'=>$rw_filedata['meta_keyword'],
				'meta_desc'=>$rw_filedata['meta_descrp']
			
			);
			
			$this->db->where('product_id',$prodcutid_mast);							
			$this->db->update('product_meta_info',$masterproduct_meta_data);
		//---------------------------------Product update in product_meta_info end-------------------------//
		
		
		
		//---------------------------------------------attribute insert code start---------------------------------------//
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
				$cron_imag='';
				$cron_brand='';
				$cron_color='';
				$cron_size='';
				$cronsub_size='';
				$cron_type='';
				$cron_occasion='';
				$cron_Capacity='';
				$cron_RAM ='';
				$cron_ROM='';
				
				$curprice_query=$this->db->query("
				
				SELECT CASE WHEN special_price !=0 AND CURDATE() BETWEEN price_fr_dt AND price_to_dt
				THEN special_price
				WHEN price !=0
				THEN price 
				ELSE mrp
				END FINAL_PRICE				
				FROM seller_product_price_info  WHERE seller_product_id='$sl_sellerprodid' ;
				
				");
				
				$rw_curprice=$curprice_query->result();
				
				$current_price=$rw_curprice[0]->FINAL_PRICE;
		
				
				
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
					if($sz_sql->num_rows()>0)
					{
						$sz_row = $sz_sql->row();
						$sz_id = $sz_row->size_id;
						$product_sz_attr_data = array(
							//'sku_id' => $sku,
							'm_size_id' => $sz_id,
							'm_size_name' => $newattr_value[$atr]
						);
						
						$cron_size=$newattr_value[$atr];
						
						$this->db->where('sku_id',$sl_sku);
						$this->db->where('m_size_id',$sz_id);
								
						$this->db->update('size_attr',$product_sz_attr_data);
					}
					
				}
			}
			
			//progrm for sub size attribute
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			
			if($newattr_fld_name[$atr] == 'Size Type'){
				if($attr_value[$atr] != ''){
					$sb_sz_sql = $this->db->query("SELECT size_id FROM size_master WHERE size_name='$newattr_value[$atr]'");
					if($sb_sz_sql->num_rows() > 0)
					{
							$sb_sz_row = $sb_sz_sql->row();
							$sb_sz_id = $sb_sz_row->size_id;
							$product_sb_sz_attr_data = array(
								//'sku_id' => $sku,
								's_size_id' => $sb_sz_id,
								's_size_name' => $newattr_value[$atr]
							);
							
							//program start for checking if sku is exits or not in size_attr table and insert or update
							$sq = $this->db->query("SELECT * FROM size_attr WHERE sku_id='$sl_sku'");
							if($sq->num_rows() > 0){
								$product_sb_sz_attr_data1 = array(
									's_size_id' => $sb_sz_id,
									's_size_name' => $newattr_value[$atr]
								);
								$this->db->where('sku_id',$sl_sku);
								$this->db->update('size_attr',$product_sb_sz_attr_data1);
							}else{
								$this->db->insert('size_attr',$product_sb_sz_attr_data);
							}
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
						$clor_row = $clor_sql->row();
						$clor_id = $clor_row->color_id;
						$product_color_attr_data = array(
							//'sku_id' => $sku,
							'color_id' => $clor_id,
							'clr_name' => $newattr_value[$atr]
						);
						
						$cron_color=$newattr_value[$atr];
						
						$this->db->where('sku_id',$sl_sku);
						$this->db->update('color_attr',$product_color_attr_data);					
						
					}
					
				}
			}
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			
			$insert_otherattrbid=$newattr_id[$atr];
			$insert_otherattrbvalue=$newattr_value[$atr];
			
			$qr_attrbupdate=$this->db->query("SELECT * FROM seller_product_attribute_value WHERE sku='$sl_sku' AND  attr_id='$insert_otherattrbid' ");
			if($qr_attrbupdate->num_rows()==0)
			{
				$product_attr_data = array(
					'seller_product_id' => $sl_sellerprodid,
					'sku' => $sl_sku,
					'attr_id' => $newattr_id[$atr],
					'attr_value' => $newattr_value[$atr], 
				);
				$this->db->insert('seller_product_attribute_value',$product_attr_data);	
			}
			else{
								
				$this->db->query("UPDATE seller_product_attribute_value SET attr_id='$insert_otherattrbid' ,attr_value='$insert_otherattrbvalue' WHERE sku='$sl_sku' AND attr_id='$insert_otherattrbid'  ");	 
			}
			
			
					if($newattr_fld_name[$atr] == 'Brand' || $newattr_fld_name[$atr] == 'brand')
					{
						if($newattr_value[$atr] != '')
						{$cron_brand=$newattr_value[$atr];}
					
					}
					
					if($newattr_fld_name[$atr] == 'Sub size' || $newattr_fld_name[$atr] == 'sub size')
					{
						if($newattr_value[$atr] != '')
						{$cronsub_size=$newattr_value[$atr];}
					
					}
					
					
					if($newattr_fld_name[$atr] == 'Type' || $newattr_fld_name[$atr] == 'type')
					{
						if($newattr_value[$atr] != '')
						{$cron_type=$newattr_value[$atr];}
					
					}
					
					if($newattr_fld_name[$atr] == 'Occasion' || $newattr_fld_name[$atr] == 'occasion')
					{
						if($newattr_value[$atr] != '')
						{$cron_occasion=$newattr_value[$atr];}
					
					}
					
					if($newattr_fld_name[$atr] == 'Capacity' || $newattr_fld_name[$atr] == 'capacity')
					{
						if($newattr_value[$atr] != '')
						{$cron_Capacity=$newattr_value[$atr];}
					
					}
					
					if($newattr_fld_name[$atr] == 'RAM' || $newattr_fld_name[$atr] == 'ram')
					{
						if($newattr_value[$atr] != '')
						{$cron_RAM=$newattr_value[$atr];}
					
					}
					
					if($newattr_fld_name[$atr] == 'ROM' || $newattr_fld_name[$atr] == 'rom')
					{
						if($newattr_value[$atr] != '')
						{$cron_ROM=$newattr_value[$atr];}
					
					}
		
			
		
			
		}
		
	//---------------------------------------------attribute insert code end---------------------------------------//
	
	
		
		
	//------------------------image upload  start---------------------------------------------------------------------//
		
		 //--------------------------------image upload for imageURL1 start------------------------------------//	
		 //$this->load->helper('download');	
		 $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		 
		 $all_imgarray=array();
		 $all_imgarray=array('0'=>'','1'=>'','2'=>'','3'=>'','4'=>'');
		 
			 $qr_oldprodimage=$this->db->query("SELECT * FROM seller_product_image WHERE seller_product_id='$sl_sellerprodid' ");
			 
			 $all_dbimgstr=$qr_oldprodimage->row()->image;
			 $all_dbimgarr=explode(',', $all_dbimgstr);			 
			 
			 $catalog_dbimgname=$qr_oldprodimage->row()->catelog_img_url;
			 
		 	 
			 for($img_ctr=0; $img_ctr<count($all_dbimgarr); $img_ctr++)
			 {
				$all_imgarray[$img_ctr]=$all_dbimgarr[$img_ctr];		 
			 }
			 
			
			
			if($rw_filedata['image_url1']!=''   )
			{ 	error_reporting(0);
				//---------------old image delete from folder start-----------------------//
					if($all_imgarray[0]!='')	
					{	$oldimage_filename=$all_imgarray[0];
		
						$output_dir = "./images/product_img/";					
						
						$filePath = $output_dir.$catalog_dbimgname;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
												
						$filePath = $output_dir.'original_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'2000x2000_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'thumbnil_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
					}
				//---------------old image delete from folder end-----------------------//
						 
				
				$random_imaghename=strtolower(random_string('alnum',15)).'.jpg';
				
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
				
				 
			}
			
			//--------------------------------image upload for imageURL1 end------------------------------------
			
			//--------------------------------image upload for imageURL2 start------------------------------------		
			if($rw_filedata['image_url2']!=''  )
			{error_reporting(0);
				
				
				//---------------old image delete from folder start-----------------------//
					if($all_imgarray[1]!='')
					{	
						$oldimage_filename=$all_imgarray[1];
		
						$output_dir = "./images/product_img/";					
											
						$filePath = $output_dir.'original_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'2000x2000_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'thumbnil_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
					}
				//---------------old image delete from folder end-----------------------//
				
				$random_imaghename=strtolower(random_string('alnum',15)).'.jpg';
				
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
				
				 
			}
			
			//--------------------------------image upload for imageURL2 end------------------------------------
			
			
			//--------------------------------image upload for imageURL3 start------------------------------------		
			if($rw_filedata['image_url3']!=''   )
			{error_reporting(0);
				
				//---------------old image delete from folder start-----------------------//
					if($all_imgarray[2]!='')	
					{	$oldimage_filename=$all_imgarray[2];
		
						$output_dir = "./images/product_img/";					
											
						$filePath = $output_dir.'original_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'2000x2000_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'thumbnil_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
					}
				//---------------old image delete from folder end-----------------------//
				
				
				$random_imaghename=strtolower(random_string('alnum',15)).'.jpg';
				
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
			 
			}
			
			//--------------------------------image upload for imageURL3 end------------------------------------
			
			
			
			//--------------------------------image upload for imageURL4 start------------------------------------		
			if($rw_filedata['image_url4']!=''   )
			{error_reporting(0);
				
				
				//---------------old image delete from folder start-----------------------//
					if($all_imgarray[3]!='')
					{	$oldimage_filename=$all_imgarray[3];
		
						$output_dir = "./images/product_img/";					
											
						$filePath = $output_dir.'original_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'2000x2000_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'thumbnil_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
					}
				//---------------old image delete from folder end-----------------------//
				
				
				$random_imaghename=strtolower(random_string('alnum',15)).'.jpg';
				
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
				
				 
			}
			
			//--------------------------------image upload for imageURL4 end------------------------------------
			
			
			//--------------------------------image upload for imageURL5 start------------------------------------		
			if($rw_filedata['image_url5']!=''   )
			{error_reporting(0);
				
				
				//---------------old image delete from folder start-----------------------//
				if($all_imgarray[4]!='')
				{		$oldimage_filename=$all_imgarray[4];
		
						$output_dir = "./images/product_img/";					
											
						$filePath = $output_dir.'original_'.$oldimage_filename;					
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'2000x2000_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'thumbnil_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
				}
				//---------------old image delete from folder end-----------------------//
				
				
				$random_imaghename=strtolower(random_string('alnum',15)).'.jpg';
				
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
				
				 
			}
			
			//--------------------------------image upload for imageURL5 end------------------------------------		 
				 
		//------------------------image upload  end-----------------------------------------------------------------------
			
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		$image=implode(',',$imag);
		
		$image_data=array();
		$image_data = array(
			//'seller_product_id' => $sl_sellerprodid,
			'image' => $image,
			'catelog_img_url' => 'catalog_'.$imag[0]
			
		);
		
		
		$this->db->where('seller_product_id',$sl_sellerprodid);		
		$this->db->update('seller_product_image',$image_data);
		
		$masterimage_data=array();
		$masterimage_data = array(
			
			'imag' => $image,
			'catelog_img_url' => 'catalog_'.$imag[0]
			
		);
		
		
		$this->db->where('product_id',$prodcutid_mast);		
		$this->db->update('product_image',$masterimage_data);	
		
		//$this->db->insert('seller_product_image',$image_data);
		//program end of retrieve image from temp_imge table and insert in product_imag table//
		
		
				//---------------------------------Product update in cornjob_productsearch start--------------------//
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			$cronjobproduct_data=array();
			
			$qr_ctginfo=$this->db->query("SELECT * FROM temp_category WHERE lvl2='$category_id' ");
			$lvl2=$qr_ctginfo->row()->lvl2;
			$lvl2_name=$qr_ctginfo->row()->lvl2_name;
			$lvl1=$qr_ctginfo->row()->lvl1;
			$lvl1_name=$qr_ctginfo->row()->lvl1_name;
			$lvlmain=$qr_ctginfo->row()->lvlmain;
			$lvlmain_name=$qr_ctginfo->row()->lvlmain_name;
			
			$cronjobproduct_data=array(
				'lvl2'=>$lvl2,
				'lvl2_name'=>$lvl2_name,
				'lvl1'=>$lvl1,
				'lvl1_name'=>$lvl1_name,
				'lvlmain'=>	$lvlmain,
				'lvlmain_name'=>$lvlmain_name,	
				'name'=>$rw_filedata['prod_name'],
				'seller_id'=>$seller_id, 
				'imag'=>'catalog_'.$imag[0],
				'brand'=>$cron_brand, 
				'current_price'=>$current_price,
				'color'=>$cron_color,
				'size'=>$cron_size,
				'sub_size'=>$cronsub_size,
				'type'=>$cron_type,
				'occasion'=>$cron_occasion,
				'Capacity'=>$cron_Capacity,
				'RAM'=>$cron_RAM,
				'ROM'=>$cron_ROM,
				'mrp'=>$rw_filedata['mrp'],
				'price'=>$rw_filedata['sell_price'],
				'special_price'=>$rw_filedata['special_price'],
				'special_pric_from_dt'=> $splprice_from_dt,
				'special_pric_to_dt'=> $splprice_to_dt,
				'status'=>$rw_filedata['status'],
				'quantity'=>$rw_filedata['quantity'],
				'seller_status'=>'Active',
				'prod_status'=>'Active'
				
			);
			
			
			$this->db->where('sku',$sl_sku);						
			$this->db->update('cornjob_productsearch',$cronjobproduct_data);
			
		//---------------------------------Product update in cornjob_productsearch end--------------------//
		
		
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		
		$this->db->query("UPDATE bulkproduct_reuploadlog SET reupload_status='Uploaded' WHERE new_sku='$sl_sku' ");
		
		/*$uplodprd_id=$rw_filedata['uploadprod_sqlid'];
		$this->db->query("UPDATE bulk_editedproductupload_log SET upload_status='Uploaded' , upload_dtime='$dt', 
		seller_productid='$sl_sellerprodid',master_productid='$prodcutid_mast' WHERE uploadprod_sqlid='$uplodprd_id' ");*/
		
	} //main if condition else part start 
	
	
	else
	{
		
		//*********************************************else part if product not in cronjobproduct_search table start*********************************//
		
			//=================================================Old product data and image delete start=============================================//
			
				$qr_slroldprodinfo=$this->db->query("SELECT seller_product_id FROM seller_product_general_info WHERE sku='$sl_sku' group by sku ");
				
				if($qr_slroldprodinfo->num_rows()>0)
				{
						$seller_oldproductid=$qr_slroldprodinfo->row()->seller_product_id;
						
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
									
									} // image value not blank condition end
									
								}
										 
							 }		
							
							
						
						}
						//-------------------------------------image delete from folder end---------------------------//
						
						//-----------------------Seller Product Data Delete from all seller Table start------------------------------//
							
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
				
				$qr_masteroldprodinfo=$this->db->query("SELECT product_id FROM product_master WHERE sku='$sl_sku' group by sku ");
				
				if($qr_masteroldprodinfo->num_rows()>0)
				{
						$master_oldproductid=$qr_masteroldprodinfo->row()->product_id;
						
						//-----------------------Master Product Data Delete from all seller Table start------------------------------//							
							
							$this->db->query("DELETE FROM product_category WHERE product_id='$master_oldproductid' ");							
							$this->db->query("DELETE FROM product_general_info WHERE product_id='$master_oldproductid' ");							
							$this->db->query("DELETE FROM product_image WHERE product_id='$master_oldproductid' ");							
							$this->db->query("DELETE FROM product_setting WHERE product_id='$master_oldproductid' ");							
							$this->db->query("DELETE FROM product_master WHERE sku='$sl_sku' ");							
							$this->db->query("DELETE FROM product_meta_info WHERE product_id='$master_oldproductid' ");
							
							$this->db->query("DELETE FROM color_attr WHERE sku_id='$sl_sku' ");
							$this->db->query("DELETE FROM size_attr WHERE sku_id='$sl_sku' ");
							
						//-----------------------Master Product Data Delete from all seller Table end------------------------------//
				}
				
			//=================================================Old product data and image delete end=============================================//
			
			
		//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Product Add as New Product Start~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
		
			
			
			$image='';
			$imag=array();
			$product_categoy_data=array();
			$product_inventory_data=array();
			$product_meta_data=array();
			$product_price_data=array();
			$product_general_data=array();
			$product_setting_data=array();
			$image_data=array();
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			$seller_product_id = $this->get_seller_product_id('seller_product_setting', 'seller_product_id');
			//----------------sku generate start----------------
			$chars = 4;
			$letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$rand_letter = substr(str_shuffle($letters), 0, $chars);
			$sku1 = str_replace(' ','-',$rw_filedata['sku']);
			$sku = $rand_letter.'-'.$seller_id.'-'.$sku1;
		//----------------sku generate end----------------	
		
			$product_setting_data = array(
			'seller_product_id' => $seller_product_id,
			'seller_id' => $seller_id,
			'attribute_set' => $attrbset_id,
			//'product_type' => $this->input->post('product_type'),
		);
		$this->db->insert('seller_product_setting', $product_setting_data);
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		$prod_hlights=array();
		
		if($rw_filedata['prod_highlt1']!='')
		{$prod_hlights[]=$rw_filedata['prod_highlt1'];}
		
		if($rw_filedata['prod_highlt2']!='')
		{$prod_hlights[]=$rw_filedata['prod_highlt2'];}
		
		if($rw_filedata['prod_highlt3']!='')
		{$prod_hlights[]=$rw_filedata['prod_highlt3'];}
		
		if($rw_filedata['prod_highlt4']!='')
		{$prod_hlights[]=$rw_filedata['prod_highlt4'];}
		
		if($rw_filedata['prod_highlt5'])
		{$prod_hlights[]=$rw_filedata['prod_highlt5'];}
		
		
		$product_general_data = array(
			'seller_product_id' => $seller_product_id,
			'name' => $rw_filedata['prod_name'], 
			'sku' => $sku,
			'description' => $rw_filedata['descrp'],
			'short_desc' => serialize($prod_hlights),   
			'weight' =>$rw_filedata['weight'], 
			'status' => $rw_filedata['status'],
			//'product_fr_dt' =>$product_fr_dt,
			//'product_to_dt' =>$product_to_dt,
			//'visibility' => $this->input->post('visibility'),
			'manufacture_country' => $rw_filedata['country_mafg'],
			//'featured' => ' ',
		);	
		
		$this->db->insert('seller_product_general_info', $product_general_data);
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		if($rw_filedata['special_price']>0)
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
		
		
		$product_price_data = array(
			'seller_product_id' => $seller_product_id,
			'mrp' => $rw_filedata['mrp'],
			'special_price' => $rw_filedata['special_price'],
			'price' => $rw_filedata['sell_price'],
			'price_fr_dt' => $splprice_from_dt,
			'price_to_dt' => $splprice_to_dt,
			'tax_amount' => $rw_filedata['vat_cst'], 
			'shipping_fee' => $shipping_fee,
			'shipping_fee_amount' => $shipping_fee_amount,
		);
		$this->db->insert('seller_product_price_info', $product_price_data);
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		$product_meta_data = array(
			'seller_product_id' => $seller_product_id,
			'meta_title' => $rw_filedata['meta_title'],
			'meta_keyword' => $rw_filedata['meta_keyword'],
			'meta_description' => $rw_filedata['meta_descrp'] 
		);
		$this->db->insert('seller_product_meta_info', $product_meta_data);
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		$product_inventory_data = array(
			'seller_product_id' => $seller_product_id,
			'quantity' => $rw_filedata['quantity'], 
			//'max_quantity' => $this->input->post('max_qty_allowed'),
			//'qty_increment' => $this->input->post('qty_increment'),
			//'stock_avail' => $this->input->post('stock_avail'),
		);
		$this->db->insert('seller_product_inventory_info', $product_inventory_data);	
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		$product_categoy_data = array(
			'seller_product_id' =>$seller_product_id,
			'category' =>$category_id,
		);
		$this->db->insert('seller_product_category', $product_categoy_data);
		
		
		
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
					$sz_row = $sz_sql->row();
					$sz_id = $sz_row->size_id;
					$product_sz_attr_data = array(
						'sku_id' => $sku,
						'm_size_id' => $sz_id,
						'm_size_name' => $newattr_value[$atr]
					);
					$this->db->insert('size_attr',$product_sz_attr_data);
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
						$clor_row = $clor_sql->row();
						$clor_id = $clor_row->color_id;
						$product_color_attr_data = array(
							'sku_id' => $sku,
							'color_id' => $clor_id,
							'clr_name' => $newattr_value[$atr]
						);
						$this->db->insert('color_attr',$product_color_attr_data);
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
			 	 $newattr_id[$atr];
			 	 $newattr_value[$atr];
			
			$this->db->insert('seller_product_attribute_value',$product_attr_data);
		}
		
	//---------------------------------------------attribute insert code end---------------------------------------	
		
		
				//------------------------image upload  start---------------------------------------------------------------------
		$dt_img = preg_replace("/[^0-9]+/","", date('Y-m-d H:i:s'));
		 //--------------------------------image upload for imageURL1 start------------------------------------	
		 //$this->load->helper('download');	
		 $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		 
			if($rw_filedata['image_url1']!='')
			{ error_reporting(0);
				
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
				
				 
			}
			//--------------------------------image upload for imageURL1 end------------------------------------
			
			//--------------------------------image upload for imageURL2 start------------------------------------		
			if($rw_filedata['image_url2']!='')
			{error_reporting(0);
				
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
				
				 
			}
			//--------------------------------image upload for imageURL2 end------------------------------------
			
			
			//--------------------------------image upload for imageURL3 start------------------------------------		
			if($rw_filedata['image_url3']!='')
			{error_reporting(0);
				
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
				
				 
			}
			//--------------------------------image upload for imageURL3 end------------------------------------
			
			
			
			//--------------------------------image upload for imageURL4 start------------------------------------		
			if($rw_filedata['image_url4']!='')
			{error_reporting(0);
				
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
				
				 
			}
			//--------------------------------image upload for imageURL4 end------------------------------------
			
			
			//--------------------------------image upload for imageURL5 start------------------------------------		
			if($rw_filedata['image_url5']!='')
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
				
				 
			}
			//--------------------------------image upload for imageURL5 end------------------------------------		 
				 
		//------------------------image upload  end-----------------------------------------------------------------------
		
				
		$image=implode(',',$imag); 
		$image_data = array(
			'seller_product_id' => $seller_product_id,
			'image' => $image,
			'catelog_img_url' => 'catalog_'.$imag[0]
			
		);
		$this->db->insert('seller_product_image',$image_data);
		//program end of retrieve image from temp_imge table and insert in product_imag table//
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		$uplodprd_id=$rw_filedata['uploadprod_sqlid'];
		$this->db->query("UPDATE bulkproductupload_log SET upload_status='Uploaded' , upload_dtime='$dt', new_sku='$sku' ,
		seller_productid='$seller_product_id' WHERE uploadprod_sqlid='$uplodprd_id' ");
				
		
		//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Product Approve Start>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//
		
				//$sql="call single_newproductapproval(".$seller_product_id.");";

				//$this->db->query($sql);
			
		//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Product Approve End>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//	
			
			
		//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Product Add as New Product End~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
			
				
	
	//***********************************************else part if product not in cronjobproduct_search table end******************************************//
	
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		
		$this->db->query("UPDATE bulkproduct_reuploadlog SET reupload_status='Uploaded' WHERE new_sku='$sl_sku' ");
	
	
	} // main if condition end
	
	
		
  } // main for loop end
		
		//--------------------------------Main forloop Product Data insert end-------------------------
		//$maxupload_id = $this->get_maximum_id('bulkprod_templatelog', 'upload_id');
		
		/*$this->db->query("UPDATE bulkprodedit_templatelog SET status='Expired', upload_id='$maxupload_id' WHERE blk_tempid='$excelfiluploadid' AND  status='Active' ");*/
		
		
		//$this->db->query("UPDATE bulkprodedit_templatelog SET status='Expired' WHERE downlaod_parentid='$excelfiluploadid' ");
		
		//$this->db->trans_complete();
	
	$enddtm = date('Y-m-d H:i:s');
	$this->db->query("UPDATE bulkprod_templatelog set reupload_processstatus='not process',reupload_enddatetime='$enddtm' where blk_tempid='$excelfiluploadid' ");
	
		
	}
	
	
	function reupload_pendingproductsstart()
	{	
		set_time_limit(0);
		
		//$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		$excelfiluploadid=$this->input->post('fileuploadid');
		//$excelfiluploadid=$this->uri->segment(4);
		
		$this->db->query("UPDATE bulkprod_templatelog set reupload_processstatus='process' where blk_tempid='$excelfiluploadid' ");
		
		$qrpendingreupload=$this->db->query("SELECT new_sku FROM bulkproduct_reuploadlog WHERE uploadprod_uid='$excelfiluploadid' AND                                              reupload_status='Pending' ");
		$skuidarr_strng=array();
		foreach($qrpendingreupload->result_array() as $res_pendingprodreupload)
		{
			$skuidarr_strng[]="'".$res_pendingprodreupload['new_sku']."'";
		}
		
		$chkskuids_string=implode(',',$skuidarr_strng);
		
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			date_default_timezone_set('Asia/Calcutta');
			$dt = date('Y-m-d H:i:s');
	
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
		
		
		
		
		$qr_filedata=$this->db->query("SELECT * FROM bulkproductupload_log WHERE uploadprod_uid='$excelfiluploadid' AND qc_status='Passed' AND upload_status='uploaded' AND new_sku IN ($chkskuids_string) ");
		$res_filedata=$qr_filedata->result_array();
		
		
		
		//--------------------------------Main forloop Product Data insert start-------------------------
	foreach($res_filedata as $rw_filedata)
	{	
			$sl_sku=$rw_filedata['new_sku'];
			
			$qr_cronjobserch=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE sku='$sl_sku' ");
			
		if($qr_cronjobserch->num_rows()>0)
		{	
			$image='';
			$imag=array();
			$product_categoy_data=array();
			$product_inventory_data=array();
			$product_meta_data=array();
			$product_price_data=array();
			$product_general_data=array();
			$product_setting_data=array();
			$image_data=array();
			
		
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		
		
		/*$qr_slrprod1=$this->db->query("SELECT * FROM seller_product_general_info WHERE sku='$sl_sku' group by sku ");
		$rw_slr=$qr_slrprod1->row();
		
		$sl_sellerprodid=$rw_slr->seller_product_id;*/
		
		$sl_sellerprodid=$rw_filedata['seller_productid'];
		
		$qr_slrprod2=$this->db->query("SELECT * FROM product_master WHERE sku='$sl_sku' group by sku ");
		$rw_prodmast=$qr_slrprod2->row();
		
		$prodcutid_mast=$qr_slrprod2->row()->product_id;
		
		$product_setting_data = array(
						
			'seller_id' => $seller_id,
			'attribute_set' => $attrbset_id,
			'master_product_id'=>$prodcutid_mast
		);
		
		$this->db->where('seller_product_id',$rw_filedata['seller_productid']);
		$this->db->update('seller_product_setting',$product_setting_data);
		
	//--------------------------------Product update in seller_product_general_info table start------------------//
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		$prod_hlights=array();
		
		if($rw_filedata['prod_highlt1']!='')
		{$prod_hlights[]=$rw_filedata['prod_highlt1'];}
		
		if($rw_filedata['prod_highlt2']!='')
		{$prod_hlights[]=$rw_filedata['prod_highlt2'];}
		
		if($rw_filedata['prod_highlt3']!='')
		{$prod_hlights[]=$rw_filedata['prod_highlt3'];}
		
		if($rw_filedata['prod_highlt4']!='')
		{$prod_hlights[]=$rw_filedata['prod_highlt4'];}
		
		if($rw_filedata['prod_highlt5'])
		{$prod_hlights[]=$rw_filedata['prod_highlt5'];}
		
		
		$product_general_data = array(
			'seller_product_id'=>$sl_sellerprodid, 
			'name' => $rw_filedata['prod_name'],			
			'description' => $rw_filedata['descrp'],
			'short_desc' => serialize($prod_hlights),   
			'weight' =>$rw_filedata['weight'], 
			'status' => $rw_filedata['status'],			
			'manufacture_country' => $rw_filedata['country_mafg'],
			
		);	
		
		
		$this->db->where('sku',$sl_sku);
		$this->db->update('seller_product_general_info',$product_general_data);
		
		//--------------------------------Product update in seller_product_general_info table end------------------//
	
	 //--------------------------------Product update in seller_product_price_info table start------------------//
			
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		if($rw_filedata['special_price']>0 && $rw_filedata['splprice_fromdt']!='0000-00-00' && $rw_filedata['splprice_todate']!='0000-00-00')
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
		
		
		$product_price_data = array(
			
			'mrp' => $rw_filedata['mrp'],
			'special_price' => $rw_filedata['special_price'],
			'price' => $rw_filedata['sell_price'],
			'price_fr_dt' => $splprice_from_dt,
			'price_to_dt' => $splprice_to_dt,
			'tax_amount' => $rw_filedata['vat_cst'], 
			'shipping_fee' => $shipping_fee,
			'shipping_fee_amount' => $shipping_fee_amount,
		);
		
		$this->db->where('seller_product_id',$sl_sellerprodid);		
		$this->db->update('seller_product_price_info',$product_price_data);		
		
		
	 //--------------------------------Product update in seller_product_price_info table end------------------//
	 
	 
	  //--------------------------------Product update in seller_product_inventory_info table start------------------//		
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		$product_meta_data = array(
			
			'meta_title' => $rw_filedata['meta_title'],
			'meta_keyword' => $rw_filedata['meta_keyword'],
			'meta_description' => $rw_filedata['meta_descrp'] 
		);
		
		$this->db->where('seller_product_id',$sl_sellerprodid);		
		$this->db->update('seller_product_meta_info',$product_meta_data);
		
	//--------------------------------Product update in seller_product_inventory_info table end------------------//			
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		$product_inventory_data = array(			
			'quantity' => $rw_filedata['quantity'],		
			
		);
		
		
		$this->db->where('seller_product_id',$sl_sellerprodid);		
		$this->db->update('seller_product_inventory_info',$product_inventory_data);
				
		
		//--------------------------------Product update in seller_product_inventory_info table stop------------------//
		
		//---------------------------------------seller product data update in seller category table start----------------------//
	    $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			$sellr_productcatg=array();
			
			$sellr_productcatg=array(
				'category' => $category_id,
				
			);
			
			$this->db->where('seller_product_id',$sl_sellerprodid);
			$this->db->update('seller_product_category',$sellr_productcatg);
		
		//---------------------------------------seller product data update in seller category table end----------------------//
		
			
		
		//--------------------------------Product update in product_general_info table end------------------//
			
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			$masterproduct_general_data=array();
			
			$masterproduct_general_data=array(
				'name'=>$rw_filedata['prod_name'],
				'description'=>$rw_filedata['descrp'],
				'short_desc'=>serialize($prod_hlights),
				'weight'=>$rw_filedata['weight'],
			
			);
		
			$this->db->where('product_id',$prodcutid_mast);			
			$this->db->update('product_general_info',$masterproduct_general_data);
		
		//----------------------------------Product update in product_general_info table start---------------//
		
		
		//--------------------------------Product update in product_master table start------------------//
			
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			$masterproduct_master_data=array();
			
			$masterproduct_master_data=array(
				'seller_id'=>$seller_id, 
				'status'=>$rw_filedata['status'],
				'manufacture_country'=>$rw_filedata['country_mafg'],
				'price'=>$rw_filedata['sell_price'],
				'mrp'=>$rw_filedata['mrp'],
				'special_price'=>$rw_filedata['special_price'],
				'special_pric_from_dt'=> $splprice_from_dt,
				'special_pric_to_dt'=> $splprice_to_dt, 
				'tax_amount'=>$rw_filedata['vat_cst'],
				'shipping_fee'=>$shipping_fee,
				'shipping_fee_amount'=>$shipping_fee_amount,
				'quantity'=>$rw_filedata['quantity'],
				
			
			);
		
			//$this->db->where('product_id',$prodcutid_mast);
			$this->db->where('sku',$sl_sku);				
			$this->db->update('product_master',$masterproduct_master_data);
		
		//----------------------------------Product update in product_master table end---------------//
		
		
		//---------------------------------Product update in product_meta_info start-------------------------//
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			$masterproduct_meta_data=array();
			
			$masterproduct_meta_data=array(
				'meta_title'=>$rw_filedata['meta_title'],
				'meta_keywords'=>$rw_filedata['meta_keyword'],
				'meta_desc'=>$rw_filedata['meta_descrp']
			
			);
			
			$this->db->where('product_id',$prodcutid_mast);							
			$this->db->update('product_meta_info',$masterproduct_meta_data);
		//---------------------------------Product update in product_meta_info end-------------------------//
		
		
		
		//---------------------------------------------attribute insert code start---------------------------------------//
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
				$cron_imag='';
				$cron_brand='';
				$cron_color='';
				$cron_size='';
				$cronsub_size='';
				$cron_type='';
				$cron_occasion='';
				$cron_Capacity='';
				$cron_RAM ='';
				$cron_ROM='';
				
				$curprice_query=$this->db->query("
				
				SELECT CASE WHEN special_price !=0 AND CURDATE() BETWEEN price_fr_dt AND price_to_dt
				THEN special_price
				WHEN price !=0
				THEN price 
				ELSE mrp
				END FINAL_PRICE				
				FROM seller_product_price_info  WHERE seller_product_id='$sl_sellerprodid' ;
				
				");
				
				$rw_curprice=$curprice_query->result();
				
				$current_price=$rw_curprice[0]->FINAL_PRICE;
		
				
				
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
					if($sz_sql->num_rows()>0)
					{
						$sz_row = $sz_sql->row();
						$sz_id = $sz_row->size_id;
						$product_sz_attr_data = array(
							//'sku_id' => $sku,
							'm_size_id' => $sz_id,
							'm_size_name' => $newattr_value[$atr]
						);
						
						$cron_size=$newattr_value[$atr];
						
						$this->db->where('sku_id',$sl_sku);
						$this->db->where('m_size_id',$sz_id);
								
						$this->db->update('size_attr',$product_sz_attr_data);
					}
					
				}
			}
			
			//progrm for sub size attribute
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			
			if($newattr_fld_name[$atr] == 'Size Type'){
				if($attr_value[$atr] != ''){
					$sb_sz_sql = $this->db->query("SELECT size_id FROM size_master WHERE size_name='$newattr_value[$atr]'");
					if($sb_sz_sql->num_rows() > 0)
					{
							$sb_sz_row = $sb_sz_sql->row();
							$sb_sz_id = $sb_sz_row->size_id;
							$product_sb_sz_attr_data = array(
								//'sku_id' => $sku,
								's_size_id' => $sb_sz_id,
								's_size_name' => $newattr_value[$atr]
							);
							
							//program start for checking if sku is exits or not in size_attr table and insert or update
							$sq = $this->db->query("SELECT * FROM size_attr WHERE sku_id='$sl_sku'");
							if($sq->num_rows() > 0){
								$product_sb_sz_attr_data1 = array(
									's_size_id' => $sb_sz_id,
									's_size_name' => $newattr_value[$atr]
								);
								$this->db->where('sku_id',$sl_sku);
								$this->db->update('size_attr',$product_sb_sz_attr_data1);
							}else{
								$this->db->insert('size_attr',$product_sb_sz_attr_data);
							}
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
						$clor_row = $clor_sql->row();
						$clor_id = $clor_row->color_id;
						$product_color_attr_data = array(
							//'sku_id' => $sku,
							'color_id' => $clor_id,
							'clr_name' => $newattr_value[$atr]
						);
						
						$cron_color=$newattr_value[$atr];
						
						$this->db->where('sku_id',$sl_sku);
						$this->db->update('color_attr',$product_color_attr_data);					
						
					}
					
				}
			}
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			
			$insert_otherattrbid=$newattr_id[$atr];
			$insert_otherattrbvalue=$newattr_value[$atr];
			
			$qr_attrbupdate=$this->db->query("SELECT * FROM seller_product_attribute_value WHERE sku='$sl_sku' AND  attr_id='$insert_otherattrbid' ");
			if($qr_attrbupdate->num_rows()==0)
			{
				$product_attr_data = array(
					'seller_product_id' => $sl_sellerprodid,
					'sku' => $sl_sku,
					'attr_id' => $newattr_id[$atr],
					'attr_value' => $newattr_value[$atr], 
				);
				$this->db->insert('seller_product_attribute_value',$product_attr_data);	
			}
			else{
								
				$this->db->query("UPDATE seller_product_attribute_value SET attr_id='$insert_otherattrbid' ,attr_value='$insert_otherattrbvalue' WHERE sku='$sl_sku' AND attr_id='$insert_otherattrbid'  ");	 
			}
			
			
					if($newattr_fld_name[$atr] == 'Brand' || $newattr_fld_name[$atr] == 'brand')
					{
						if($newattr_value[$atr] != '')
						{$cron_brand=$newattr_value[$atr];}
					
					}
					
					if($newattr_fld_name[$atr] == 'Sub size' || $newattr_fld_name[$atr] == 'sub size')
					{
						if($newattr_value[$atr] != '')
						{$cronsub_size=$newattr_value[$atr];}
					
					}
					
					
					if($newattr_fld_name[$atr] == 'Type' || $newattr_fld_name[$atr] == 'type')
					{
						if($newattr_value[$atr] != '')
						{$cron_type=$newattr_value[$atr];}
					
					}
					
					if($newattr_fld_name[$atr] == 'Occasion' || $newattr_fld_name[$atr] == 'occasion')
					{
						if($newattr_value[$atr] != '')
						{$cron_occasion=$newattr_value[$atr];}
					
					}
					
					if($newattr_fld_name[$atr] == 'Capacity' || $newattr_fld_name[$atr] == 'capacity')
					{
						if($newattr_value[$atr] != '')
						{$cron_Capacity=$newattr_value[$atr];}
					
					}
					
					if($newattr_fld_name[$atr] == 'RAM' || $newattr_fld_name[$atr] == 'ram')
					{
						if($newattr_value[$atr] != '')
						{$cron_RAM=$newattr_value[$atr];}
					
					}
					
					if($newattr_fld_name[$atr] == 'ROM' || $newattr_fld_name[$atr] == 'rom')
					{
						if($newattr_value[$atr] != '')
						{$cron_ROM=$newattr_value[$atr];}
					
					}
		
			
		
			
		}
		
	//---------------------------------------------attribute insert code end---------------------------------------//
	
	
		
		
	//------------------------image upload  start---------------------------------------------------------------------//
		
		 //--------------------------------image upload for imageURL1 start------------------------------------//	
		 //$this->load->helper('download');	
		 $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		 
		 $all_imgarray=array();
		 $all_imgarray=array('0'=>'','1'=>'','2'=>'','3'=>'','4'=>'');
		 
			 $qr_oldprodimage=$this->db->query("SELECT * FROM seller_product_image WHERE seller_product_id='$sl_sellerprodid' ");
			 
			 $all_dbimgstr=$qr_oldprodimage->row()->image;
			 $all_dbimgarr=explode(',', $all_dbimgstr);			 
			 
			 $catalog_dbimgname=$qr_oldprodimage->row()->catelog_img_url;
			 
		 	 
			 for($img_ctr=0; $img_ctr<count($all_dbimgarr); $img_ctr++)
			 {
				$all_imgarray[$img_ctr]=$all_dbimgarr[$img_ctr];		 
			 }
			 
			
			$dt_img = preg_replace("/[^0-9]+/","", date('Y-m-d H:i:s'));
			if($rw_filedata['image_url1']!=''   )
			{ 	error_reporting(0);
				//---------------old image delete from folder start-----------------------//
					if($all_imgarray[0]!='')	
					{	$oldimage_filename=$all_imgarray[0];
		
						$output_dir = "./images/product_img/";					
						
						$filePath = $output_dir.$catalog_dbimgname;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
												
						$filePath = $output_dir.'original_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'2000x2000_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'thumbnil_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
					}
				//---------------old image delete from folder end-----------------------//
						 
				
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
				
				 
			}
			
			//--------------------------------image upload for imageURL1 end------------------------------------
			
			//--------------------------------image upload for imageURL2 start------------------------------------		
			if($rw_filedata['image_url2']!=''  )
			{error_reporting(0);
				
				
				//---------------old image delete from folder start-----------------------//
					if($all_imgarray[1]!='')
					{	
						$oldimage_filename=$all_imgarray[1];
		
						$output_dir = "./images/product_img/";					
											
						$filePath = $output_dir.'original_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'2000x2000_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'thumbnil_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
					}
				//---------------old image delete from folder end-----------------------//
				
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
				
				 
			}
			
			//--------------------------------image upload for imageURL2 end------------------------------------
			
			
			//--------------------------------image upload for imageURL3 start------------------------------------		
			if($rw_filedata['image_url3']!=''   )
			{error_reporting(0);
				
				//---------------old image delete from folder start-----------------------//
					if($all_imgarray[2]!='')	
					{	$oldimage_filename=$all_imgarray[2];
		
						$output_dir = "./images/product_img/";					
											
						$filePath = $output_dir.'original_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'2000x2000_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'thumbnil_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
					}
				//---------------old image delete from folder end-----------------------//
				
				
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
			 
			}
			
			//--------------------------------image upload for imageURL3 end------------------------------------
			
			
			
			//--------------------------------image upload for imageURL4 start------------------------------------		
			if($rw_filedata['image_url4']!=''   )
			{error_reporting(0);
				
				
				//---------------old image delete from folder start-----------------------//
					if($all_imgarray[3]!='')
					{	$oldimage_filename=$all_imgarray[3];
		
						$output_dir = "./images/product_img/";					
											
						$filePath = $output_dir.'original_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'2000x2000_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'thumbnil_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
					}
				//---------------old image delete from folder end-----------------------//
				
				
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
				
				 
			}
			
			//--------------------------------image upload for imageURL4 end------------------------------------
			
			
			//--------------------------------image upload for imageURL5 start------------------------------------		
			if($rw_filedata['image_url5']!=''   )
			{error_reporting(0);
				
				
				//---------------old image delete from folder start-----------------------//
				if($all_imgarray[4]!='')
				{		$oldimage_filename=$all_imgarray[4];
		
						$output_dir = "./images/product_img/";					
											
						$filePath = $output_dir.'original_'.$oldimage_filename;					

						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'2000x2000_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
						
						$filePath = $output_dir.'thumbnil_'.$oldimage_filename;						
						if(file_exists(trim($filePath)))						
						{unlink($filePath);}
				}
				//---------------old image delete from folder end-----------------------//
				
				
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
				
				 
			}
			
			//--------------------------------image upload for imageURL5 end------------------------------------		 
				 
		//------------------------image upload  end-----------------------------------------------------------------------
			
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		$image=implode(',',$imag);
		
		$image_data=array();
		$image_data = array(
			//'seller_product_id' => $sl_sellerprodid,
			'image' => $image,
			'catelog_img_url' => 'catalog_'.$imag[0]
			
		);
		
		
		$this->db->where('seller_product_id',$sl_sellerprodid);		
		$this->db->update('seller_product_image',$image_data);
		
		$masterimage_data=array();
		$masterimage_data = array(
			
			'imag' => $image,
			'catelog_img_url' => 'catalog_'.$imag[0]
			
		);
		
		
		$this->db->where('product_id',$prodcutid_mast);		
		$this->db->update('product_image',$masterimage_data);	
		
		//$this->db->insert('seller_product_image',$image_data);
		//program end of retrieve image from temp_imge table and insert in product_imag table//
		
		
				//---------------------------------Product update in cornjob_productsearch start--------------------//
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			$cronjobproduct_data=array();
			
			$qr_ctginfo=$this->db->query("SELECT * FROM temp_category WHERE lvl2='$category_id' ");
			$lvl2=$qr_ctginfo->row()->lvl2;
			$lvl2_name=$qr_ctginfo->row()->lvl2_name;
			$lvl1=$qr_ctginfo->row()->lvl1;
			$lvl1_name=$qr_ctginfo->row()->lvl1_name;
			$lvlmain=$qr_ctginfo->row()->lvlmain;
			$lvlmain_name=$qr_ctginfo->row()->lvlmain_name;
			
			$cronjobproduct_data=array(
				'lvl2'=>$lvl2,
				'lvl2_name'=>$lvl2_name,
				'lvl1'=>$lvl1,
				'lvl1_name'=>$lvl1_name,
				'lvlmain'=>	$lvlmain,
				'lvlmain_name'=>$lvlmain_name,	
				'name'=>$rw_filedata['prod_name'],
				'seller_id'=>$seller_id, 
				'imag'=>'catalog_'.$imag[0],
				'brand'=>$cron_brand, 
				'current_price'=>$current_price,
				'color'=>$cron_color,
				'size'=>$cron_size,
				'sub_size'=>$cronsub_size,
				'type'=>$cron_type,
				'occasion'=>$cron_occasion,
				'Capacity'=>$cron_Capacity,
				'RAM'=>$cron_RAM,
				'ROM'=>$cron_ROM,
				'mrp'=>$rw_filedata['mrp'],
				'price'=>$rw_filedata['sell_price'],
				'special_price'=>$rw_filedata['special_price'],
				'special_pric_from_dt'=> $splprice_from_dt,
				'special_pric_to_dt'=> $splprice_to_dt,
				'status'=>$rw_filedata['status'],
				'quantity'=>$rw_filedata['quantity'],
				'seller_status'=>'Active',
				'prod_status'=>'Active'
				
			);
			
			
			$this->db->where('sku',$sl_sku);						
			$this->db->update('cornjob_productsearch',$cronjobproduct_data);
			
		//---------------------------------Product update in cornjob_productsearch end--------------------//
		
		
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		
		$this->db->query("UPDATE bulkproduct_reuploadlog SET reupload_status='Uploaded' WHERE new_sku='$sl_sku' ");
		
		/*$uplodprd_id=$rw_filedata['uploadprod_sqlid'];
		$this->db->query("UPDATE bulk_editedproductupload_log SET upload_status='Uploaded' , upload_dtime='$dt', 
		seller_productid='$sl_sellerprodid',master_productid='$prodcutid_mast' WHERE uploadprod_sqlid='$uplodprd_id' ");*/
		
	} //main if condition else part start 
	
	
	else
	{
		
		//*********************************************else part if product not in cronjobproduct_search table start*********************************//
		
			//=================================================Old product data and image delete start=============================================//
			
				$qr_slroldprodinfo=$this->db->query("SELECT seller_product_id FROM seller_product_general_info WHERE sku='$sl_sku' group by sku ");
				
				if($qr_slroldprodinfo->num_rows()>0)
				{
						$seller_oldproductid=$qr_slroldprodinfo->row()->seller_product_id;
						
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
									
									} // image value not blank condition end
									
								}
										 
							 }		
							
							
						
						}
						//-------------------------------------image delete from folder end---------------------------//
						
						//-----------------------Seller Product Data Delete from all seller Table start------------------------------//
							
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
				
				$qr_masteroldprodinfo=$this->db->query("SELECT product_id FROM product_master WHERE sku='$sl_sku' group by sku ");
				
				if($qr_masteroldprodinfo->num_rows()>0)
				{
						$master_oldproductid=$qr_masteroldprodinfo->row()->product_id;
						
						//-----------------------Master Product Data Delete from all seller Table start------------------------------//							
							
							$this->db->query("DELETE FROM product_category WHERE product_id='$master_oldproductid' ");							
							$this->db->query("DELETE FROM product_general_info WHERE product_id='$master_oldproductid' ");							
							$this->db->query("DELETE FROM product_image WHERE product_id='$master_oldproductid' ");							
							$this->db->query("DELETE FROM product_setting WHERE product_id='$master_oldproductid' ");							
							$this->db->query("DELETE FROM product_master WHERE sku='$sl_sku' ");							
							$this->db->query("DELETE FROM product_meta_info WHERE product_id='$master_oldproductid' ");
							
							$this->db->query("DELETE FROM color_attr WHERE sku_id='$sl_sku' ");
							$this->db->query("DELETE FROM size_attr WHERE sku_id='$sl_sku' ");
							
						//-----------------------Master Product Data Delete from all seller Table end------------------------------//
				}
				
			//=================================================Old product data and image delete end=============================================//
			
			
		//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Product Add as New Product Start~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
		
			
			
			$image='';
			$imag=array();
			$product_categoy_data=array();
			$product_inventory_data=array();
			$product_meta_data=array();
			$product_price_data=array();
			$product_general_data=array();
			$product_setting_data=array();
			$image_data=array();
			$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			$seller_product_id = $this->get_seller_product_id('seller_product_setting', 'seller_product_id');
			//----------------sku generate start----------------
			$chars = 4;
			$letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$rand_letter = substr(str_shuffle($letters), 0, $chars);
			$sku1 = str_replace(' ','-',$rw_filedata['sku']);
			$sku = $rand_letter.'-'.$seller_id.'-'.$sku1;
		//----------------sku generate end----------------	
		
			$product_setting_data = array(
			'seller_product_id' => $seller_product_id,
			'seller_id' => $seller_id,
			'attribute_set' => $attrbset_id,
			//'product_type' => $this->input->post('product_type'),
		);
		$this->db->insert('seller_product_setting', $product_setting_data);
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		$prod_hlights=array();
		
		if($rw_filedata['prod_highlt1']!='')
		{$prod_hlights[]=$rw_filedata['prod_highlt1'];}
		
		if($rw_filedata['prod_highlt2']!='')
		{$prod_hlights[]=$rw_filedata['prod_highlt2'];}
		
		if($rw_filedata['prod_highlt3']!='')
		{$prod_hlights[]=$rw_filedata['prod_highlt3'];}
		
		if($rw_filedata['prod_highlt4']!='')
		{$prod_hlights[]=$rw_filedata['prod_highlt4'];}
		
		if($rw_filedata['prod_highlt5'])
		{$prod_hlights[]=$rw_filedata['prod_highlt5'];}
		
		
		$product_general_data = array(
			'seller_product_id' => $seller_product_id,
			'name' => $rw_filedata['prod_name'], 
			'sku' => $sku,
			'description' => $rw_filedata['descrp'],
			'short_desc' => serialize($prod_hlights),   
			'weight' =>$rw_filedata['weight'], 
			'status' => $rw_filedata['status'],
			//'product_fr_dt' =>$product_fr_dt,
			//'product_to_dt' =>$product_to_dt,
			//'visibility' => $this->input->post('visibility'),
			'manufacture_country' => $rw_filedata['country_mafg'],
			//'featured' => ' ',
		);	
		
		$this->db->insert('seller_product_general_info', $product_general_data);
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		if($rw_filedata['special_price']>0)
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
		
		
		$product_price_data = array(
			'seller_product_id' => $seller_product_id,
			'mrp' => $rw_filedata['mrp'],
			'special_price' => $rw_filedata['special_price'],
			'price' => $rw_filedata['sell_price'],
			'price_fr_dt' => $splprice_from_dt,
			'price_to_dt' => $splprice_to_dt,
			'tax_amount' => $rw_filedata['vat_cst'], 
			'shipping_fee' => $shipping_fee,
			'shipping_fee_amount' => $shipping_fee_amount,
		);
		$this->db->insert('seller_product_price_info', $product_price_data);
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		$product_meta_data = array(
			'seller_product_id' => $seller_product_id,
			'meta_title' => $rw_filedata['meta_title'],
			'meta_keyword' => $rw_filedata['meta_keyword'],
			'meta_description' => $rw_filedata['meta_descrp'] 
		);
		$this->db->insert('seller_product_meta_info', $product_meta_data);
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		$product_inventory_data = array(
			'seller_product_id' => $seller_product_id,
			'quantity' => $rw_filedata['quantity'], 
			//'max_quantity' => $this->input->post('max_qty_allowed'),
			//'qty_increment' => $this->input->post('qty_increment'),
			//'stock_avail' => $this->input->post('stock_avail'),
		);
		$this->db->insert('seller_product_inventory_info', $product_inventory_data);	
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		$product_categoy_data = array(
			'seller_product_id' =>$seller_product_id,
			'category' =>$category_id,
		);
		$this->db->insert('seller_product_category', $product_categoy_data);
		
		
		
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
					$sz_row = $sz_sql->row();
					$sz_id = $sz_row->size_id;
					$product_sz_attr_data = array(
						'sku_id' => $sku,
						'm_size_id' => $sz_id,
						'm_size_name' => $newattr_value[$atr]
					);
					$this->db->insert('size_attr',$product_sz_attr_data);
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
						$clor_row = $clor_sql->row();
						$clor_id = $clor_row->color_id;
						$product_color_attr_data = array(
							'sku_id' => $sku,
							'color_id' => $clor_id,
							'clr_name' => $newattr_value[$atr]
						);
						$this->db->insert('color_attr',$product_color_attr_data);
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
			 	 $newattr_id[$atr];
			 	 $newattr_value[$atr];
			
			$this->db->insert('seller_product_attribute_value',$product_attr_data);
		}
		
	//---------------------------------------------attribute insert code end---------------------------------------	
		
		
				//------------------------image upload  start---------------------------------------------------------------------
		$dt_img = preg_replace("/[^0-9]+/","", date('Y-m-d H:i:s'));
		 //--------------------------------image upload for imageURL1 start------------------------------------	
		 //$this->load->helper('download');	
		 $this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		 
			if($rw_filedata['image_url1']!='')
			{ error_reporting(0);
				
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
				
				 
			}
			//--------------------------------image upload for imageURL1 end------------------------------------
			
			//--------------------------------image upload for imageURL2 start------------------------------------		
			if($rw_filedata['image_url2']!='')
			{error_reporting(0);
				
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
				
				 
			}
			//--------------------------------image upload for imageURL2 end------------------------------------
			
			
			//--------------------------------image upload for imageURL3 start------------------------------------		
			if($rw_filedata['image_url3']!='')
			{error_reporting(0);
				
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
				
				 
			}
			//--------------------------------image upload for imageURL3 end------------------------------------
			
			
			
			//--------------------------------image upload for imageURL4 start------------------------------------		
			if($rw_filedata['image_url4']!='')
			{error_reporting(0);
				
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
				
				 
			}
			//--------------------------------image upload for imageURL4 end------------------------------------
			
			
			//--------------------------------image upload for imageURL5 start------------------------------------		
			if($rw_filedata['image_url5']!='')
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
				
				 
			}
			//--------------------------------image upload for imageURL5 end------------------------------------		 
				 
		//------------------------image upload  end-----------------------------------------------------------------------
		
				
		$image=implode(',',$imag); 
		$image_data = array(
			'seller_product_id' => $seller_product_id,
			'image' => $image,
			'catelog_img_url' => 'catalog_'.$imag[0]
			
		);
		$this->db->insert('seller_product_image',$image_data);
		//program end of retrieve image from temp_imge table and insert in product_imag table//
		
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		$uplodprd_id=$rw_filedata['uploadprod_sqlid'];
		$this->db->query("UPDATE bulkproductupload_log SET upload_status='Uploaded' , upload_dtime='$dt', new_sku='$sku' ,
		seller_productid='$seller_product_id' WHERE uploadprod_sqlid='$uplodprd_id' ");
				
		
		//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Product Approve Start>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//
		
				//$sql="call single_newproductapproval(".$seller_product_id.");";

				//$this->db->query($sql);
			
		//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Product Approve End>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>//	
			
			
		//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Product Add as New Product End~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
			
				
	
	//***********************************************else part if product not in cronjobproduct_search table end******************************************//
	
		$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
		
		
		$this->db->query("UPDATE bulkproduct_reuploadlog SET reupload_status='Uploaded' WHERE new_sku='$sl_sku' ");
	
	
	} // main if condition end
	
	
		
  } // main for loop end
		
		//--------------------------------Main forloop Product Data insert end-------------------------
		//$maxupload_id = $this->get_maximum_id('bulkprod_templatelog', 'upload_id');
		
		/*$this->db->query("UPDATE bulkprodedit_templatelog SET status='Expired', upload_id='$maxupload_id' WHERE blk_tempid='$excelfiluploadid' AND  status='Active' ");*/
		
		
		//$this->db->query("UPDATE bulkprodedit_templatelog SET status='Expired' WHERE downlaod_parentid='$excelfiluploadid' ");
		
		//$this->db->trans_complete();
	
	$enddtm = date('Y-m-d H:i:s');
	$this->db->query("UPDATE bulkprod_templatelog set reupload_processstatus='not process',reupload_enddatetime='$enddtm' where blk_tempid='$excelfiluploadid' ");
	
		
	
	
			
	}
	
} // class end