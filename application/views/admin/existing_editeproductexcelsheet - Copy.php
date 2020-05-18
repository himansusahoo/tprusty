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
//$objPHPExcel->getActiveSheet()->setTitle(preg_replace('#"#',"_",preg_replace('#/#',"_",str_replace(' ','_',strtolower($catgnm)))));
$objPHPExcel->getActiveSheet()->setTitle('product_info');
 
$border_style= array('borders' => array('right' => array('style' => 
PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '#A0A0A0'),)));


	 /*$objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Moonboy Serial Number');
	 $objPHPExcel->getActiveSheet()->SetCellValue('B2', 'QC Status');*/
	 $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Product Id');
	// $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'Edit Status');
	  //$objPHPExcel->getActiveSheet()->getStyle('A1:C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#d8d8d8');
	
	 
	
	$objPHPExcel->getActiveSheet()->getStyle('A2:AC1')->applyFromArray($border_style); 
	
    $objPHPExcel->getActiveSheet()->SetCellValue('B2', 'SKU');	
    $objPHPExcel->getActiveSheet()->SetCellValue('C2', 'Product Name');			
    $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'Description');
	$objPHPExcel->getActiveSheet()->SetCellValue('E2', 'MRP');
	$objPHPExcel->getActiveSheet()->SetCellValue('F2', 'Selling Price');
	$objPHPExcel->getActiveSheet()->SetCellValue('G2', 'Special Price');
	$objPHPExcel->getActiveSheet()->SetCellValue('H2', 'Special Price From Date');
	$objPHPExcel->getActiveSheet()->SetCellValue('I2', 'Special Price To Date');
	$objPHPExcel->getActiveSheet()->SetCellValue('J2', 'Quantity');
	$objPHPExcel->getActiveSheet()->SetCellValue('K2', 'VAT / CST');
	$objPHPExcel->getActiveSheet()->SetCellValue('L2', 'Weight(in grams)');	
	$objPHPExcel->getActiveSheet()->SetCellValue('M2', 'Image URL1');	
	$objPHPExcel->getActiveSheet()->SetCellValue('N2', 'Image URL2');
	$objPHPExcel->getActiveSheet()->SetCellValue('O2', 'Image URL3');
	$objPHPExcel->getActiveSheet()->SetCellValue('P2', 'Image URL4');
	$objPHPExcel->getActiveSheet()->SetCellValue('Q2', 'Image URL5');
	$objPHPExcel->getActiveSheet()->SetCellValue('R2', 'Shipping Fee Type(Free/Default)');
	$objPHPExcel->getActiveSheet()->SetCellValue('S2', 'Shipping Fee Amount');
	$objPHPExcel->getActiveSheet()->SetCellValue('T2', 'Status(Enabled/Disabled)');
	$objPHPExcel->getActiveSheet()->SetCellValue('U2', 'product highlights-1');
	$objPHPExcel->getActiveSheet()->SetCellValue('V2', 'product highlights-2');
	$objPHPExcel->getActiveSheet()->SetCellValue('W2', 'product highlights-3');
	$objPHPExcel->getActiveSheet()->SetCellValue('X2', 'product highlights-4');
	$objPHPExcel->getActiveSheet()->SetCellValue('Y2', 'product highlights-5');
	$objPHPExcel->getActiveSheet()->SetCellValue('Z2', 'Country of Manufacture');
	$objPHPExcel->getActiveSheet()->SetCellValue('AA2', 'Meta Title');
	$objPHPExcel->getActiveSheet()->SetCellValue('AB2', 'Meta Keywords');
	$objPHPExcel->getActiveSheet()->SetCellValue('AC2', 'Meta Description');
	
	
	$objPHPExcel->getActiveSheet()->getStyle('A1:F2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#FF3333');
	$objPHPExcel->getActiveSheet()->getStyle('G1:I2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#00CC00');
	$objPHPExcel->getActiveSheet()->getStyle('J1:M2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#FF3333');
	$objPHPExcel->getActiveSheet()->getStyle('N1:Q2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#00CC00');
	$objPHPExcel->getActiveSheet()->getStyle('R1:U2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#FF3333');
	$objPHPExcel->getActiveSheet()->getStyle('V1:AC2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#00CC00');
	
	$objPHPExcel->getActiveSheet()->getStyle('B2:AC2')->applyFromArray($border_style);
	 
	
  			$attr_heading_rows = $attr_heading_result->num_rows();
  		if($attr_heading_rows>0)		
  		{	 $attrb_countforexlcoulmn=$attr_heading_rows+1;
					//$attrb_exlcoulmnname=array();
					$sheet = $objPHPExcel->getSheet(1);
					
					//$highestRow = $sheet->getHighestRow(); 
					//$highestColumn = $sheet->getHighestColumn();
					//$highestColumn++;
					$c=29; 
					$row = '1';
						 
							for($col = 1; $col != $attrb_countforexlcoulmn; $col++){
								
							  $cell = $sheet->getCellByColumnAndRow($c, $row);
							  //$colIndex = PHPExcel_Cell::columnIndexFromString($cell->getColumn());
							  $attrbhead_exlcoulmnname[]=$cell->getColumn();
							  // echo $cell->getColumn().'<br>';
								$c++;
						  }
						 
   
				}  // if attribute heading count > 0 condition end
	
	
$ir=0;	$c=29;
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
										
									
										
										//foreach($exist_product->result() as $resattrb_datafill)
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
					
							$exist_rowcount=3;
							
							$prodid_arrcheck=array();
							
						foreach($exist_product->result() as $res_existproduct)
						{ 
							if(!in_array($res_existproduct->product_id,$prodid_arrcheck))
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
								
								
								if($res_existproduct->imag!='')
								{$prod_imagearr=explode(',',$res_existproduct->imag);}
								
								
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
								
								
								if($res_existproduct->short_desc!='')
								{	
									$prod_highlightarr=unserialize($res_existproduct->short_desc);}

								
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
								
								/*if($res_existproduct->qc_failedreason!='')
								{
									$arr_qcfailedreason=unserialize($res_existproduct->qc_failedreason);
									
									$str_qcfailedreason=implode(',',$arr_qcfailedreason);
								}
								else
								{$str_qcfailedreason='';}*/
								
								//$objPHPExcel->getActiveSheet()->SetCellValue('A'.$exist_rowcount, $res_existproduct->moonboy_slno);
								//$objPHPExcel->getActiveSheet()->SetCellValue('B'.$exist_rowcount, $res_existproduct->qc_status);								
								//$objPHPExcel->getActiveSheet()->SetCellValue('C'.$exist_rowcount, $str_qcfailedreason);
								//$objPHPExcel->getActiveSheet()->SetCellValue('D'.$exist_rowcount, 'Not Edited');
								$objPHPExcel->getActiveSheet()->SetCellValue('A'.$exist_rowcount, @$res_existproduct->product_id);								
								$objPHPExcel->getActiveSheet()->SetCellValue('B'.$exist_rowcount, @$res_existproduct->sku);
								$objPHPExcel->getActiveSheet()->SetCellValue('C'.$exist_rowcount, @$res_existproduct->name);
								$objPHPExcel->getActiveSheet()->SetCellValue('D'.$exist_rowcount, @$res_existproduct->description);
								$objPHPExcel->getActiveSheet()->SetCellValue('E'.$exist_rowcount, @$res_existproduct->mrp);
								$objPHPExcel->getActiveSheet()->SetCellValue('F'.$exist_rowcount, @$res_existproduct->price);
								$objPHPExcel->getActiveSheet()->SetCellValue('G'.$exist_rowcount, @$res_existproduct->special_price);
								$objPHPExcel->getActiveSheet()->SetCellValue('H'.$exist_rowcount, @$res_existproduct->special_pric_from_dt);
								$objPHPExcel->getActiveSheet()->SetCellValue('I'.$exist_rowcount, @$res_existproduct->special_pric_to_dt);
								$objPHPExcel->getActiveSheet()->SetCellValue('J'.$exist_rowcount, @$res_existproduct->quantity);
								$objPHPExcel->getActiveSheet()->SetCellValue('K'.$exist_rowcount, @$res_existproduct->tax_amount);
								$objPHPExcel->getActiveSheet()->SetCellValue('L'.$exist_rowcount, @$res_existproduct->weight);
								
								$objPHPExcel->getActiveSheet()->SetCellValue('M'.$exist_rowcount, @$imgurl_1);
								$objPHPExcel->getActiveSheet()->SetCellValue('N'.$exist_rowcount, @$imgurl_2);
								$objPHPExcel->getActiveSheet()->SetCellValue('O'.$exist_rowcount, @$imgurl_3);
								$objPHPExcel->getActiveSheet()->SetCellValue('P'.$exist_rowcount, @$imgurl_4);
								$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$exist_rowcount, @$imgurl_5);
								
								if(@$res_existproduct->shipping_fee==0)
								{
								 $objPHPExcel->getActiveSheet()->SetCellValue('R'.$exist_rowcount, 'Free');
								}
								else
								{$objPHPExcel->getActiveSheet()->SetCellValue('R'.$exist_rowcount, 'Default');}
								
								$objPHPExcel->getActiveSheet()->SetCellValue('S'.$exist_rowcount, @$res_existproduct->shipping_fee_amount);
								$objPHPExcel->getActiveSheet()->SetCellValue('T'.$exist_rowcount, @$res_existproduct->status);
								
								$objPHPExcel->getActiveSheet()->SetCellValue('U'.$exist_rowcount, @$prodhilght_1);
								$objPHPExcel->getActiveSheet()->SetCellValue('V'.$exist_rowcount, @$prodhilght_2);
								$objPHPExcel->getActiveSheet()->SetCellValue('W'.$exist_rowcount, @$prodhilght_3);
								$objPHPExcel->getActiveSheet()->SetCellValue('X'.$exist_rowcount, @$prodhilght_4);
								$objPHPExcel->getActiveSheet()->SetCellValue('Y'.$exist_rowcount, @$prodhilght_5);
								
								$objPHPExcel->getActiveSheet()->SetCellValue('Z'.$exist_rowcount, @$res_existproduct->manufacture_country);
								$objPHPExcel->getActiveSheet()->SetCellValue('AA'.$exist_rowcount, @$res_existproduct->meta_title);
								$objPHPExcel->getActiveSheet()->SetCellValue('AB'.$exist_rowcount, @$res_existproduct->meta_keywords);
								$objPHPExcel->getActiveSheet()->SetCellValue('AC'.$exist_rowcount, @$res_existproduct->meta_desc);
								
								
						//-------------------------------Product attribute start-----------------------//
							$attrbsku=$res_existproduct->sku;
							$query_attrb=$this->db->query("SELECT * FROM seller_product_attribute_value WHERE sku='$attrbsku'  ");
							
							if($query_attrb->num_rows()==0)
							
							{$query_attrb=$this->db->query("SELECT * FROM product_attribute_value WHERE sku='$attrbsku'  ");}
							
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
									foreach($attrbutevalue_array as $attrdatafill_key=>$attrdatafill_value)
									{
										$objPHPExcel->getActiveSheet()->SetCellValue(@$attrbdatafill_clmuname[$iclmn].$exist_rowcount, $attrdatafill_value);	
										$iclmn++;
									}
											
							}
					//-------------------------------product attribute end-------------------------//
								
								
								/*if($res_existproduct->attrb_valueandid!='')
								{
												$attrbuteids_array=array();
												$attrbuteids_array=unserialize($res_existproduct->attrb_valueandid);
												
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
										$objPHPExcel->getActiveSheet()->SetCellValue($attrbdatafill_clmuname[$iclmn].$exist_rowcount, $attrdatafill_value);	
										$iclmn++;
									}
							
							
							}*/ 
							
							//if attribute & vlaue column data is blank in bulkproductupload_log table condition end
							
							$prodid_arrcheck[]=$res_existproduct->product_id;
							
								$exist_rowcount++;	
								} //array check of productid if condtion end
							}
					
					//------------------------------------------------Data Populate of failed product end-------------------------//
			
        //---------------------------------------------------------------protect & unprotect worksheet start----------------------------------------//						
						
	$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
	/*$objPHPExcel->getActiveSheet()->getStyle('E3:'.end($all_attrbfld_coulmnname).$exist_rowcount)->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
	
	$objPHPExcel->getActiveSheet()->getStyle('C3:C'.$exist_rowcount)->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);*/

	//---------------------------------------------------------------protect & unprotect worksheet end----------------------------------------// 
	
 //$objPHPExcel->getActiveSheet()->freezePane($colnm_attrfield);
 $RowIndex=2;
 $ColumnCount=2;
 $objPHPExcel->getActiveSheet()->freezePaneByColumnAndRow($ColumnCount, $RowIndex);	
//PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);
for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet()->getHighestColumn(); $i++) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
}
 				  
			  
	for($rw_sts=3;$rw_sts!=2000; $rw_sts++)
	{
		
		/*$objValidation = $objPHPExcel->getActiveSheet()->getCell('A'.$rw_sts)->getDataValidation();
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
		$objValidation->setFormula1('"Passed,Failed"');*/
		
		
		
		/*$objValidation = $objPHPExcel->getActiveSheet()->getCell('C'.$rw_sts)->getDataValidation();
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
		$objValidation->setFormula1('"Edited,Not Edited"');*/
		
		
		$objValidation = $objPHPExcel->getActiveSheet()->getCell('T'.$rw_sts)->getDataValidation();
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
		
		
		$objValidation = $objPHPExcel->getActiveSheet()->getCell('R'.$rw_sts)->getDataValidation();
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
				$objValidation->setFormula1('Index!B2:B156');
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
				$objValidation->setFormula1('Index!C2:C14');
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
				$objValidation->setFormula1('Index!D2:D95');
		}
		
	}

	/*-------------------------------------------------------Existing Product Add Excelsheet Fromar Start----------------------------------------------*/
	$objWorkSheet = $objPHPExcel->createSheet();            
	$objPHPExcel->setActiveSheetIndex(2); 
	$objPHPExcel->setActiveSheetIndex(2);
	$objPHPExcel->getActiveSheet()->setTitle(preg_replace('#"#',"_",preg_replace('#/#',"_",str_replace(' ','_',strtolower($catgnm)))));
	
	
		$border_style= array('borders' => array('right' => array('style' => 
	PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '#A0A0A0'),)));


	 $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Moonboy Serial Number');
	 $objPHPExcel->getActiveSheet()->SetCellValue('B2', 'QC Status');
	 $objPHPExcel->getActiveSheet()->SetCellValue('C2', 'QC Failed Reason(if any)');
	 $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'Product Id');
	 $objPHPExcel->getActiveSheet()->getStyle('A1:D2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#d8d8d8');
	
	 
	
	$objPHPExcel->getActiveSheet()->getStyle('E1:X1')->applyFromArray($border_style); 
	
    $objPHPExcel->getActiveSheet()->SetCellValue('E2', 'SKU');	
    //$objPHPExcel->getActiveSheet()->SetCellValue('E2', 'Product Name');			
    //$objPHPExcel->getActiveSheet()->SetCellValue('F2', 'Description');
	$objPHPExcel->getActiveSheet()->SetCellValue('F2', 'MRP');
	$objPHPExcel->getActiveSheet()->SetCellValue('G2', 'Selling Price');
	$objPHPExcel->getActiveSheet()->SetCellValue('H2', 'Special Price');	
	$objPHPExcel->getActiveSheet()->SetCellValue('I2', 'Special Price From Date');	
	$objPHPExcel->getActiveSheet()->SetCellValue('J2', 'Special Price To Date');	
	$objPHPExcel->getActiveSheet()->SetCellValue('K2', 'Quantity');	
	$objPHPExcel->getActiveSheet()->SetCellValue('L2', 'VAT / CST');	
	$objPHPExcel->getActiveSheet()->SetCellValue('M2', 'Weight(in grams)');		
	$objPHPExcel->getActiveSheet()->SetCellValue('N2', 'Image URL1');	
	$objPHPExcel->getActiveSheet()->SetCellValue('O2', 'Image URL2');
	$objPHPExcel->getActiveSheet()->SetCellValue('P2', 'Image URL3');
	$objPHPExcel->getActiveSheet()->SetCellValue('Q2', 'Image URL4');
	$objPHPExcel->getActiveSheet()->SetCellValue('R2', 'Image URL5');	
	$objPHPExcel->getActiveSheet()->SetCellValue('S2', 'Shipping Fee Type(Free/Default)');	
	$objPHPExcel->getActiveSheet()->SetCellValue('T2', 'Shipping Fee Amount');	
	$objPHPExcel->getActiveSheet()->SetCellValue('U2', 'Status(Enabled/Disabled)');	
	$objPHPExcel->getActiveSheet()->SetCellValue('V2', 'Country of Manufacture');
	
	
	
	
	$objPHPExcel->getActiveSheet()->getStyle('E1:G2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#FF3333');
	$objPHPExcel->getActiveSheet()->getStyle('H1:J2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#00CC00');
	$objPHPExcel->getActiveSheet()->getStyle('K1:M2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#FF3333');
	$objPHPExcel->getActiveSheet()->getStyle('N1:R2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#00CC00');
	$objPHPExcel->getActiveSheet()->getStyle('S1:U2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#FF3333');
	$objPHPExcel->getActiveSheet()->getStyle('V1:V2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#00CC00');
	
	$objPHPExcel->getActiveSheet()->getStyle('E2:V2')->applyFromArray($border_style);
	 
	
  			$attr_heading_rows = $attr_extheading_result->num_rows();
  		if($attr_heading_rows>0)		
  		{	 $attrb_countforexlcoulmn=$attr_heading_rows+1;
					
					$sheet = $objPHPExcel->getSheet(1);
					
					
					$c=22; 
					$row = '1';
						 
							for($col = 1; $col != $attrb_countforexlcoulmn; $col++){
								
							  $cell = $sheet->getCellByColumnAndRow($c, $row);
							  //$colIndex = PHPExcel_Cell::columnIndexFromString($cell->getColumn());
							  $attrbhead_exlcoulmnname[]=$cell->getColumn();
							  // echo $cell->getColumn().'<br>';
								$c++;
						  }
						 
   
				}  // if attribute heading count > 0 condition end
	
	
$ir=0;	$c=22;
$all_attrbfld_coulmnname=array();
$all_attribute_fieldid=array();
foreach($attr_extheading_result->result() as $res_attrbheading)
{
	   $attrb_1stcoulmnname1='';
	   $attrb_lastcoulmnname1=''; 
	
	 
     
		$query_attrbfield = $this->db->query("SELECT * FROM attribute_real WHERE attribute_heading_id=$res_attrbheading->attribute_heading_id 
		AND ((attribute_field_name='Color' or attribute_field_name='color' or attribute_field_name='COLOR' )
		 OR (attribute_field_name='size' or attribute_field_name='Size' or attribute_field_name='SIZE') 
		 OR (attribute_field_name='Capacity' or attribute_field_name='capacity' or attribute_field_name='CAPACITY' ) 
		OR  (attribute_field_name='RAM' or attribute_field_name='Ram' or attribute_field_name='ram')
		OR (attribute_field_name='ROM' OR attribute_field_name='Rom' or attribute_field_name='rom') )");
							
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
							
				
				//$objPHPExcel->getActiveSheet()->SetCellValue($colnm_attrhed, $res_attrbheading->attribute_heading_name);
				//$objPHPExcel->getActiveSheet()->SetCellValue($colnm_attrhed, 'Attributes');
				$objPHPExcel->getActiveSheet()->getStyle($colnm_attrhed)->getAlignment()->applyFromArray(array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)); 
				
				
				
					 
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
					
							$exist_rowcount=3;
							$prodid_arrcheck=array();
							
							foreach($exist_product->result() as $res_existproduct)
							{ 	if(!in_array($res_existproduct->product_id,$prodid_arrcheck))
								{
									$prodid_arrcheck[]=$res_existproduct->product_id;
									$exist_rowcount++;
								}
									
							}
					
					//------------------------------------------------Data Populate of failed product end-------------------------//
			
        //---------------------------------------------------------------protect & unprotect worksheet start----------------------------------------//						
						
	/*$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
	$objPHPExcel->getActiveSheet()->getStyle('D3:'.end($all_attrbfld_coulmnname).$exist_rowcount)->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);*/
	
	

	//---------------------------------------------------------------protect & unprotect worksheet end----------------------------------------// 
	

 $RowIndex=3;
 $ColumnCount=3;
 $objPHPExcel->getActiveSheet()->freezePaneByColumnAndRow($ColumnCount, $RowIndex);	

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
		$objValidation->setFormula1('"Passed,Failed"');
		
		
		
		$objValidation = $objPHPExcel->getActiveSheet()->getCell('D'.$rw_sts)->getDataValidation();
		$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation->setAllowBlank(false);
		$objValidation->setShowInputMessage(true);
		$objValidation->setShowErrorMessage(true);
		$objValidation->setShowDropDown(true);		
		//$objValidation->setFormula1('"Edited,Not Edited"');
		$objValidation->setErrorTitle('Input error');
		$objValidation->setError('Value is not in list.');
		$objValidation->setPromptTitle('Pick from list');
		$objValidation->setPrompt('Please pick a value from the drop-down list.');	
		$objValidation->setFormula1('product_info!A3:A'.($exist_rowcount-1));
		
		
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
		$objValidation->setFormula1('"Enabled,Disabled"');
		
		
		$objValidation = $objPHPExcel->getActiveSheet()->getCell('S'.$rw_sts)->getDataValidation();
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
				$objValidation->setFormula1('Index!B2:B'.$ws1_bcell);
		}
		
		
		/*if(@$sizetype_valid=='sizetype_check')
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
				$objValidation->setFormula1('Index!C2:C14');
		}*/
		
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
				$objValidation->setFormula1('Index!D2:D'.$ws1_dcell);
		}
		
	}
	
	
	
	/*-------------------------------------------------------Existing Product Add Excelsheet Fromar Start----------------------------------------------*/

	
			
//ob_clean();
//ob_start();
// Redirect output to a client's web browser (Excel5)
header('Content-Description: File Transfer'); 
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=".preg_replace('#"#',"_",preg_replace('#/#',"_",str_replace(',','_',str_replace('&','',str_replace(' ','_',strtolower($catgnm))))))."_".$rand_string."_".$dt_rec."_existingeditproduct.xls"); 
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