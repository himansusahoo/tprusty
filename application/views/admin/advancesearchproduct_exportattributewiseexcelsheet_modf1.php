<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
set_time_limit(0);
$this->load->model('PHPExcel/Phpexcel_iofactory');
$objPHPExcel = new PHPExcel();

$objWorkSheet = $objPHPExcel->createSheet();            
$objPHPExcel->setActiveSheetIndex(0); 
$objPHPExcel->getActiveSheet(0)->setTitle('Index');

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Color');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Sub Size');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Size');
$ws1_bcell=2;
$ws1_ccell=2;
$ws1_dcell=2;
	
foreach($color_result as $color_row)
{
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$ws1_bcell, $color_row->clr_name);
	$ws1_bcell++;	
}
foreach($sub_size_result as $subsize_row)
{
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$ws1_ccell, $subsize_row->size_name);
	$ws1_ccell++;	
}
foreach($size_result as $size_row)
{
	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$ws1_dcell, $size_row->size_name );
	$ws1_dcell++;	
}

for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet()->getHighestColumn(); $i++) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
}
$objSheet = $objPHPExcel->getActiveSheet();
$objSheet->getProtection()->setPassword('moonboyindex');
$objSheet->getProtection()->setSheet(true);

$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setTitle(str_replace("'",'_',stripslashes(preg_replace('#"#',"_",preg_replace('#/#',"_",str_replace(' ','_',strtolower(substr($catgnm,0,25))))))));
 
$border_style= array('borders' => array('right' => array('style' => 
PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '#A0A0A0'),)));


	 $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Moonboy Serial Number');
	 $objPHPExcel->getActiveSheet()->SetCellValue('B2', 'QC Status');
	 $objPHPExcel->getActiveSheet()->SetCellValue('C2', 'QC Failed Reason(if any)');
	 $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'Edit Status');
	  $objPHPExcel->getActiveSheet()->getStyle('A1:D2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#d8d8d8');
	
	 
	
	$objPHPExcel->getActiveSheet()->getStyle('E1:AF1')->applyFromArray($border_style); 
	
    $objPHPExcel->getActiveSheet()->SetCellValue('E2', 'SKU');	
    $objPHPExcel->getActiveSheet()->SetCellValue('F2', 'Product Name');			
    $objPHPExcel->getActiveSheet()->SetCellValue('G2', 'Description');
	$objPHPExcel->getActiveSheet()->SetCellValue('H2', 'MRP');
	$objPHPExcel->getActiveSheet()->SetCellValue('I2', 'Selling Price');
	$objPHPExcel->getActiveSheet()->SetCellValue('J2', 'Special Price');
	
	$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'YYYY-MM-DD Or YYYY/MM/DD');
	$objPHPExcel->getActiveSheet()->SetCellValue('K2', 'Special Price From Date');
	
	$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'YYYY-MM-DD Or YYYY/MM/DD');
	$objPHPExcel->getActiveSheet()->SetCellValue('L2', 'Special Price To Date');
	
	$objPHPExcel->getActiveSheet()->SetCellValue('M2', 'Quantity');
	$objPHPExcel->getActiveSheet()->SetCellValue('N2', 'VAT / CST');
	$objPHPExcel->getActiveSheet()->SetCellValue('O2', 'Weight(in grams)');	
	$objPHPExcel->getActiveSheet()->SetCellValue('P2', 'Image URL1');	
	$objPHPExcel->getActiveSheet()->SetCellValue('Q2', 'Image URL2');
	$objPHPExcel->getActiveSheet()->SetCellValue('R2', 'Image URL3');
	$objPHPExcel->getActiveSheet()->SetCellValue('S2', 'Image URL4');
	$objPHPExcel->getActiveSheet()->SetCellValue('T2', 'Image URL5');
	$objPHPExcel->getActiveSheet()->SetCellValue('U2', 'Shipping Fee Type(Free/Default)');
	$objPHPExcel->getActiveSheet()->SetCellValue('V2', 'Shipping Fee Amount');
	$objPHPExcel->getActiveSheet()->SetCellValue('W2', 'Status(Enabled/Disabled)');
	$objPHPExcel->getActiveSheet()->SetCellValue('X2', 'product highlights-1');
	$objPHPExcel->getActiveSheet()->SetCellValue('Y2', 'product highlights-2');
	$objPHPExcel->getActiveSheet()->SetCellValue('Z2', 'product highlights-3');
	$objPHPExcel->getActiveSheet()->SetCellValue('AA2', 'product highlights-4');
	$objPHPExcel->getActiveSheet()->SetCellValue('AB2', 'product highlights-5');
	$objPHPExcel->getActiveSheet()->SetCellValue('AC2', 'Country of Manufacture');
	$objPHPExcel->getActiveSheet()->SetCellValue('AD2', 'Meta Title');
	$objPHPExcel->getActiveSheet()->SetCellValue('AE2', 'Meta Keywords');
	$objPHPExcel->getActiveSheet()->SetCellValue('AF2', 'Meta Description');
	
	
	$objPHPExcel->getActiveSheet()->getStyle('E1:I2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#FF3333');
	$objPHPExcel->getActiveSheet()->getStyle('J1:L2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#00CC00');
	$objPHPExcel->getActiveSheet()->getStyle('M1:P2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#FF3333');
	$objPHPExcel->getActiveSheet()->getStyle('Q1:T2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#00CC00');
	$objPHPExcel->getActiveSheet()->getStyle('U1:X2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#FF3333');
	$objPHPExcel->getActiveSheet()->getStyle('Y1:AF2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#00CC00');
	
	$objPHPExcel->getActiveSheet()->getStyle('E2:AF2')->applyFromArray($border_style);
	 
	
  			$attr_heading_rows = $attr_heading_result->num_rows();
  		if($attr_heading_rows>0)		
  		{	 $attrb_countforexlcoulmn=$attr_heading_rows+1;
					//$attrb_exlcoulmnname=array();
					$sheet = $objPHPExcel->getSheet(1);
					
					//$highestRow = $sheet->getHighestRow(); 
					//$highestColumn = $sheet->getHighestColumn();
					//$highestColumn++;
					$c=32; 
					$row = '1';
						 
							for($col = 1; $col != $attrb_countforexlcoulmn; $col++){
								
							  $cell = $sheet->getCellByColumnAndRow($c, $row);
							  //$colIndex = PHPExcel_Cell::columnIndexFromString($cell->getColumn());
							  $attrbhead_exlcoulmnname[]=$cell->getColumn();
							  // echo $cell->getColumn().'<br>';
								$c++;
						  }
						 
   
				}  // if attribute heading count > 0 condition end
	
	
$ir=0;	$c=32;
$all_attrbfld_coulmnname=array();
$all_attribute_fieldid=array();
foreach($attr_heading_result->result() as $res_attrbheading)
{
	   $attrb_1stcoulmnname1='';
	   $attrb_lastcoulmnname1=''; 
	
	 //$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colnm_attrhed, 1, $res_attrbheading->attribute_heading_name);
     
		$query_attrbfield = $this->db->query("SELECT * FROM attribute_real WHERE attribute_heading_id=$res_attrbheading->attribute_heading_id");
							$attrb_countforexlcoulmn=$query_attrbfield->num_rows() ;
							
							$attrbfld_coulmnname=array();
														
							if($attrb_countforexlcoulmn>0)
							{			
										$row = '2';
									
									for($col = 1; $col != $attrb_countforexlcoulmn+1; $col++){
									 
									  $cell = $sheet->getCellByColumnAndRow($c, $row);
									  $colIndex = PHPExcel_Cell::columnIndexFromString($cell->getColumn());
									  $attrbfld_coulmnname[]=$cell->getColumn();
									  $all_attrbfld_coulmnname[]=$cell->getColumn(); 
										$c++;
								  } 
								   $attrb_1stcoulmnname1=$attrbfld_coulmnname[0].'1';
								   $attrb_lastcoulmnname1=$attrbfld_coulmnname[$attrb_countforexlcoulmn-1].'1';
								   
								   $attrb_1stcoulmnname2=$attrbfld_coulmnname[0].'2';
								   $attrb_lastcoulmnname2=$attrbfld_coulmnname[$attrb_countforexlcoulmn-1].'2';
									
									$colnm_attrhed=$attrb_1stcoulmnname1;
										
									$objPHPExcel->getActiveSheet()->mergeCells($attrb_1stcoulmnname1.":".$attrb_lastcoulmnname1);
									$objPHPExcel->getActiveSheet()->getStyle($attrb_1stcoulmnname1.":".$attrb_lastcoulmnname1)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#00CC00');
									
									$objPHPExcel->getActiveSheet()->getStyle($attrb_1stcoulmnname1.":".$attrb_lastcoulmnname1)->applyFromArray($border_style);
									$objPHPExcel->getActiveSheet()->getStyle($attrb_1stcoulmnname2.":".$attrb_lastcoulmnname2)->applyFromArray($border_style);
									
									$objPHPExcel->getActiveSheet()->getStyle($attrb_1stcoulmnname2.":".$attrb_lastcoulmnname2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#CC99FF');
									
							}
							
					//$colnm_attrhed=$attrbhead_exlcoulmnname[$ir].'1';
					
					//$sheet->setCellValueByColumnAndRow(0, 1, "test");
				$objPHPExcel->getActiveSheet()->SetCellValue($colnm_attrhed, $res_attrbheading->attribute_heading_name);
				$objPHPExcel->getActiveSheet()->getStyle($colnm_attrhed)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)); 
				
				
				
					 //---------------------------attribute column address for datafill start--------------------------
										
									
										
										//foreach($edited_product->result() as $resattrb_datafill)
//										{
//											$attrbuteids_array=array();
//											$attrbuteids_array=unserialize($resattrb_datafill->attrb_valueandid);
//											
//											$attrbclmname_datafillarray=array();
//											
//											foreach($attrbuteids_array as $attrb_idskey=>$attrb_idsvalue)
//											{
//												array_push($attrbclmname_datafillarray,$attrb_idskey);	
//											}
//											
//												
//										}
												
								//---------------------------attribute column address for datafill end----------------------------
				
    						//$color_valid='';
							$ifrd=0;
							
							$ctr_totclmn=$attrb_countforexlcoulmn;
							
							
							
							foreach($query_attrbfield->result() as $res_attrbfield)
							{
								 $colnm_attrfield=$attrbfld_coulmnname[$ifrd].'2';
								 $objPHPExcel->getActiveSheet()->SetCellValue($colnm_attrfield, $res_attrbfield->attribute_field_name);
								 
								 if($res_attrbfield->attribute_field_name=='Color')
								 {
									$color_valid='color_check';
									$colorcolumn_name=$attrbfld_coulmnname[$ifrd]; 
								 }
								 
								  if($res_attrbfield->attribute_field_name=='Size Type')
								 {
									$sizetype_valid='sizetype_check';
									$sizetypecolumn_name=$attrbfld_coulmnname[$ifrd]; 
								 }
								 
								  if($res_attrbfield->attribute_field_name=='Size')
								 {
									$size_valid='size_check';
									$sizecolumn_name=$attrbfld_coulmnname[$ifrd]; 
								 }
								 
								$all_attribute_fieldid[]=$res_attrbfield->attribute_id;
																 
								 $ifrd++;	
								 
								  
							}	
							$ir++;	
}


	//------------------------------------------------Data Populate of failed product start-------------------------//
					
							$edited_rowcount=3;
							
							foreach($edited_product->result() as $res_editedproduct)
							{ 
								$imgurl_1='';
								$imgurl_2='';
								$imgurl_3='';
								$imgurl_4='';
								$imgurl_5='';
								
								$prodhilght_1='';
								$prodhilght_2='';
								$prodhilght_3='';
								$prodhilght_4='';
								$prodhilght_5='';
								
								$prod_imagearr=array();
								$prod_highlightarr=array();
								
								
								if($res_editedproduct->imag!='')
								{$prod_imagearr=explode(',',$res_editedproduct->imag);}
								
								
								if(count($prod_imagearr)>0)
								{
									if(@$prod_imagearr[0]!='')
									{$imgurl_1=$prod_imagearr[0];}
									
									if(@$prod_imagearr[1]!='')
									{$imgurl_2=$prod_imagearr[1];}
									
									if(@$prod_imagearr[2]!='')
									{$imgurl_3=$prod_imagearr[2];}
									
									if(@$prod_imagearr[3]!='')
									{$imgurl_4=$prod_imagearr[3];}
									
									if(@$prod_imagearr[4]!='')
									{$imgurl_5=$prod_imagearr[4];}										
								
								}
								
								
								if($res_editedproduct->short_desc!='')
								{	
									$prod_highlightarr=unserialize($res_editedproduct->short_desc);}
								
								if(count($prod_highlightarr)>0)
								{
									if(@$prod_highlightarr[0]!='')
									{$prodhilght_1=$prod_highlightarr[0];}
									
									if(@$prod_highlightarr[1]!='')
									{$prodhilght_2=$prod_highlightarr[1];}
									
									if(@$prod_highlightarr[2]!='')
									{$prodhilght_3=$prod_highlightarr[2];}
									
									if(@$prod_highlightarr[3]!='')
									{$prodhilght_4=$prod_highlightarr[3];}
									
									if(@$prod_highlightarr[4]!='')
									{$prodhilght_5=$prod_highlightarr[4];}	
								}
								
								/*if($res_editedproduct->qc_failedreason!='')
								{
									$arr_qcfailedreason=unserialize($res_editedproduct->qc_failedreason);
									
									$str_qcfailedreason=implode(',',$arr_qcfailedreason);
								}
								else
								{$str_qcfailedreason='';}*/
								
								//$objPHPExcel->getActiveSheet()->SetCellValue('A'.$edited_rowcount, $res_editedproduct->moonboy_slno);
								//$objPHPExcel->getActiveSheet()->SetCellValue('B'.$edited_rowcount, $res_editedproduct->qc_status);								
								//$objPHPExcel->getActiveSheet()->SetCellValue('C'.$edited_rowcount, $str_qcfailedreason);
								$objPHPExcel->getActiveSheet()->SetCellValue('D'.$edited_rowcount, 'Not Edited');								
								$objPHPExcel->getActiveSheet()->SetCellValue('E'.$edited_rowcount, @$res_editedproduct->sku);
								$objPHPExcel->getActiveSheet()->SetCellValue('F'.$edited_rowcount, @$res_editedproduct->name);
								$objPHPExcel->getActiveSheet()->SetCellValue('G'.$edited_rowcount, @$res_editedproduct->description);
								$objPHPExcel->getActiveSheet()->SetCellValue('H'.$edited_rowcount, @$res_editedproduct->mrp);
								$objPHPExcel->getActiveSheet()->SetCellValue('I'.$edited_rowcount, @$res_editedproduct->price);
								$objPHPExcel->getActiveSheet()->SetCellValue('J'.$edited_rowcount, @$res_editedproduct->special_price);
								$objPHPExcel->getActiveSheet()->SetCellValue('K'.$edited_rowcount, @$res_editedproduct->special_pric_from_dt);
								$objPHPExcel->getActiveSheet()->SetCellValue('L'.$edited_rowcount, @$res_editedproduct->special_pric_to_dt);
								$objPHPExcel->getActiveSheet()->SetCellValue('M'.$edited_rowcount, @$res_editedproduct->quantity);
								$objPHPExcel->getActiveSheet()->SetCellValue('N'.$edited_rowcount, @$res_editedproduct->tax_amount);
								$objPHPExcel->getActiveSheet()->SetCellValue('O'.$edited_rowcount, @$res_editedproduct->weight);
								
								$objPHPExcel->getActiveSheet()->SetCellValue('P'.$edited_rowcount, @$imgurl_1);
								$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$edited_rowcount, @$imgurl_2);
								$objPHPExcel->getActiveSheet()->SetCellValue('R'.$edited_rowcount, @$imgurl_3);
								$objPHPExcel->getActiveSheet()->SetCellValue('S'.$edited_rowcount, @$imgurl_4);
								$objPHPExcel->getActiveSheet()->SetCellValue('T'.$edited_rowcount, @$imgurl_5);
								
								if(@$res_editedproduct->shipping_fee==0)
								{
								 $objPHPExcel->getActiveSheet()->SetCellValue('U'.$edited_rowcount, 'Free');
								}
								else
								{$objPHPExcel->getActiveSheet()->SetCellValue('U'.$edited_rowcount, 'Default');}
								
								$objPHPExcel->getActiveSheet()->SetCellValue('V'.$edited_rowcount, @$res_editedproduct->shipping_fee_amount);
								$objPHPExcel->getActiveSheet()->SetCellValue('W'.$edited_rowcount, @$res_editedproduct->status);
								
								$objPHPExcel->getActiveSheet()->SetCellValue('X'.$edited_rowcount, @$prodhilght_1);
								$objPHPExcel->getActiveSheet()->SetCellValue('Y'.$edited_rowcount, @$prodhilght_2);
								$objPHPExcel->getActiveSheet()->SetCellValue('Z'.$edited_rowcount, @$prodhilght_3);
								$objPHPExcel->getActiveSheet()->SetCellValue('AA'.$edited_rowcount, @$prodhilght_4);
								$objPHPExcel->getActiveSheet()->SetCellValue('AB'.$edited_rowcount, @$prodhilght_5);
								
								$objPHPExcel->getActiveSheet()->SetCellValue('AC'.$edited_rowcount, @$res_editedproduct->manufacture_country);
								$objPHPExcel->getActiveSheet()->SetCellValue('AD'.$edited_rowcount, @$res_editedproduct->meta_title);
								$objPHPExcel->getActiveSheet()->SetCellValue('AE'.$edited_rowcount, @$res_editedproduct->meta_keywords);
								$objPHPExcel->getActiveSheet()->SetCellValue('AF'.$edited_rowcount, @$res_editedproduct->meta_desc);
								
								
						//-------------------------------Product attribute start-----------------------//
							$attrbsku=$res_editedproduct->sku;
							$query_attrb=$this->db->query("SELECT * FROM seller_product_attribute_value WHERE sku='$attrbsku'  ");
							
							/*if($query_attrb->num_rows()==0)
							
							{$query_attrb=$this->db->query("SELECT * FROM product_attribute_value WHERE sku='$attrbsku'  ");}
							*/
							if($query_attrb->num_rows()>0)		
							{		
									$attrbclmname_datafillarray=array();
									
									$attrbdatafill_clmuname=array();
									$attrbutevalue_array=array();
									
									foreach($query_attrb->result() as $res_attrbprod)
									{	$attrbclmname_datafillarray[]=$res_attrbprod->attr_id;
										$attrbutevalue_array[]=$res_attrbprod->attr_value;
									}
									
									$ifrds=0;
									$attrbvalue_forexcelsheet=array();
									foreach($all_attribute_fieldid as $res_attrbid_key=>$res_attrbid_value)
									{ 
										  $attrb_i=0;
										foreach($attrbclmname_datafillarray as $attrbid_datakey=>$attrbid_datavalue)
										{
											
											if($attrbid_datavalue==$res_attrbid_value)
											{$attrbdatafill_clmuname[]=$all_attrbfld_coulmnname[$ifrds];
												$attrbvalue_forexcelsheet[]=$attrbutevalue_array[$attrb_i];
											}
											$attrb_i++;	
										}
										 
										 $ifrds++;	
									 
									}	
									
									
									$iclmn=0;
									foreach($attrbvalue_forexcelsheet as $attrdatafill_key=>$attrdatafill_value)
									{
										$objPHPExcel->getActiveSheet()->SetCellValue(@$attrbdatafill_clmuname[$iclmn].$edited_rowcount, $attrdatafill_value);	
										$iclmn++;
									}
											
							}
					//-------------------------------product attribute end-------------------------//
								
								
								/*if($res_editedproduct->attrb_valueandid!='')
								{
												$attrbuteids_array=array();
												$attrbuteids_array=unserialize($res_editedproduct->attrb_valueandid);
												
												$attrbclmname_datafillarray=array();
												
												foreach($attrbuteids_array as $attrb_idskey=>$attrb_idsvalue)
												{
													array_push($attrbclmname_datafillarray,$attrb_idskey);	
												}
												
												
									$ifrds=0;
									$attrbdatafill_clmuname=array();
									
									foreach($all_attribute_fieldid as $res_attrbid_key=>$res_attrbid_value)
									{ 
										 
										foreach($attrbclmname_datafillarray as $attrbid_datakey=>$attrbid_datavalue)
										{
											
											if($attrbid_datavalue==$res_attrbid_value)
											{$attrbdatafill_clmuname[]=$all_attrbfld_coulmnname[$ifrds];}	
										}
										 
										 $ifrds++;	
									 
									}	
									
									
									$iclmn=0;
									foreach($attrbuteids_array as $attrdatafill_key=>$attrdatafill_value)
									{
										$objPHPExcel->getActiveSheet()->SetCellValue($attrbdatafill_clmuname[$iclmn].$edited_rowcount, $attrdatafill_value);	
										$iclmn++;
									}
							
							
							}*/ 
							
							//if attribute & vlaue column data is blank in bulkproductupload_log table condition end
							
							
								$edited_rowcount++;	
							}
					
					//------------------------------------------------Data Populate of failed product end-------------------------//
			
        //---------------------------------------------------------------protect & unprotect worksheet start----------------------------------------//						
						
	$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
	$objPHPExcel->getActiveSheet()->getStyle('F3:'.end($all_attrbfld_coulmnname).$edited_rowcount)->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
	
	$objPHPExcel->getActiveSheet()->getStyle('D3:D'.$edited_rowcount)->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

	//---------------------------------------------------------------protect & unprotect worksheet end----------------------------------------// 
	
 //$objPHPExcel->getActiveSheet()->freezePane($colnm_attrfield);
 $RowIndex=3;
 $ColumnCount=4;
 $objPHPExcel->getActiveSheet()->freezePaneByColumnAndRow($ColumnCount, $RowIndex);	
//PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);
for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet()->getHighestColumn(); $i++) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
}
 				  
			  
	for($rw_sts=3;$rw_sts!=2000; $rw_sts++)
	{
		
		$objValidation = $objPHPExcel->getActiveSheet()->getCell('B'.$rw_sts)->getDataValidation();
		$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation->setAllowBlank(false);
		$objValidation->setShowInputMessage(true);
		$objValidation->setShowErrorMessage(true);
		$objValidation->setShowDropDown(true);
		//$objValidation->setErrorTitle('Input error');
		//$objValidation->setError('Value is not in list.');
		//$objValidation->setPromptTitle('Pick from list');
		//$objValidation->setPrompt('Please pick a value from the drop-down list.');
		$objValidation->setFormula1('"Passed,Failed"');
		
		
		
		$objValidation = $objPHPExcel->getActiveSheet()->getCell('D'.$rw_sts)->getDataValidation();
		$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation->setAllowBlank(false);
		$objValidation->setShowInputMessage(true);
		$objValidation->setShowErrorMessage(true);
		$objValidation->setShowDropDown(true);
		//$objValidation->setErrorTitle('Input error');
		//$objValidation->setError('Value is not in list.');
		//$objValidation->setPromptTitle('Pick from list');
		//$objValidation->setPrompt('Please pick a value from the drop-down list.');
		$objValidation->setFormula1('"Edited,Not Edited"');
		
		
		$objValidation = $objPHPExcel->getActiveSheet()->getCell('W'.$rw_sts)->getDataValidation();
		$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation->setAllowBlank(false);
		$objValidation->setShowInputMessage(true);
		$objValidation->setShowErrorMessage(true);
		$objValidation->setShowDropDown(true);
		$objValidation->setErrorTitle('Input error');
		$objValidation->setError('Value is not in list.');
		$objValidation->setPromptTitle('Pick from list');
		$objValidation->setPrompt('Please pick a value from the drop-down list.');
		$objValidation->setFormula1('"Enabled,Disabled"');
		
		
		$objValidation = $objPHPExcel->getActiveSheet()->getCell('U'.$rw_sts)->getDataValidation();
		$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation->setAllowBlank(false);
		$objValidation->setShowInputMessage(true);
		$objValidation->setShowErrorMessage(true);
		$objValidation->setShowDropDown(true);
		$objValidation->setErrorTitle('Input error');
		$objValidation->setError('Value is not in list.');
		$objValidation->setPromptTitle('Pick from list');
		$objValidation->setPrompt('Please pick a value from the drop-down list.');
		$objValidation->setFormula1('"Free,Default"');
		
		if(@$color_valid=='color_check')
		{ 
				$objValidation = $objPHPExcel->getActiveSheet()->getCell($colorcolumn_name.$rw_sts)->getDataValidation();				
				$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
				$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
				$objValidation->setAllowBlank(false);
				$objValidation->setShowInputMessage(true);
				$objValidation->setShowErrorMessage(true);
				$objValidation->setShowDropDown(true);
				$objValidation->setErrorTitle('Input error');
				$objValidation->setError('Value is not in list.');
				$objValidation->setPromptTitle('Pick from list');
				$objValidation->setPrompt('Please pick a value from the drop-down list.');				
				$objValidation->setFormula1('Index!B2:B'.($ws1_bcell-1));
		}
		
		
		if(@$sizetype_valid=='sizetype_check')
		{ 
				$objValidation = $objPHPExcel->getActiveSheet()->getCell($sizetypecolumn_name.$rw_sts)->getDataValidation();				
				$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
				$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
				$objValidation->setAllowBlank(false);
				$objValidation->setShowInputMessage(true);
				$objValidation->setShowErrorMessage(true);
				$objValidation->setShowDropDown(true);
				$objValidation->setErrorTitle('Input error');
				$objValidation->setError('Value is not in list.');
				$objValidation->setPromptTitle('Pick from list');
				$objValidation->setPrompt('Please pick a value from the drop-down list.');				
				$objValidation->setFormula1('Index!C2:C'.($ws1_ccell-1));
		}
		
		if(@$size_valid=='size_check')
		{ 
				$objValidation = $objPHPExcel->getActiveSheet()->getCell($sizecolumn_name.$rw_sts)->getDataValidation();				
				$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
				$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
				$objValidation->setAllowBlank(false);
				$objValidation->setShowInputMessage(true);
				$objValidation->setShowErrorMessage(true);
				$objValidation->setShowDropDown(true);
				$objValidation->setErrorTitle('Input error');
				$objValidation->setError('Value is not in list.');
				$objValidation->setPromptTitle('Pick from list');
				$objValidation->setPrompt('Please pick a value from the drop-down list.');			
				$objValidation->setFormula1('Index!D2:D'.($ws1_dcell-1));
		}
		
	}
	
	




				
							
  					
//ob_clean();
//ob_start();
// Redirect output to a client's web browser (Excel5)
header('Content-Description: File Transfer'); 
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=".str_replace("'", "",stripslashes(preg_replace('#"#',"_",preg_replace('#/#',"_",str_replace(',','_',str_replace('&','',str_replace(' ','_',strtolower($catgnm))))))))."_".$rand_string."_".$dt_rec.".xls");  
header('Cache-Control: max-age=0'); 
header('Cache-Control: max-age=1');
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); 
header ('Cache-Control: cache, must-revalidate'); 
header ('Pragma: public'); // HTTP/1.0
header("Pragma: no-cache");
header("Expires: 0");
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
if (ob_get_contents()){ob_end_clean();}
if (ob_get_length()){ob_end_clean();}
$objWriter->save('php://output');?>