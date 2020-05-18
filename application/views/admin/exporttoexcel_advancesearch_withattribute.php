<?php
defined('BASEPATH') OR exit('No direct script access allowed');
set_time_limit(0);
$this->load->model('PHPExcel/Phpexcel_iofactory');
$objPHPExcel = new PHPExcel();
//$attrbexcel_i=0;

$fltr_attrbgrpidarr=explode(',',$fltr_attrbgrpid);
$fltrcatg_idarr=explode(',',$fltrcatg_id);

foreach($fltrcatg_idarr as $kycatgfltr=>$valcatgfltr)
{
	foreach($fltr_attrbgrpidarr as $kyfltrattb=>$valfltrattrbs)			
	{		$objWorkSheet = $objPHPExcel->createSheet();
			
			$qr_attrbgrpname=$this->db->query("SELECT * FROM attribute_group WHERE attribute_group_id='$valfltrattrbs' ");
			$attrbgroup_name=$qr_attrbgrpname->row()->attribute_group_name;
			
			$objPHPExcel->setActiveSheetIndex($kyfltrattb);
			$objPHPExcel->getActiveSheet($kyfltrattb)->setTitle($attrbgroup_name);
			$objPHPExcel->getActiveSheet()->getStyle('A1:AE1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#00CC00');
			
			$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Product_id');
			$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'SKU');
			$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Description');
			$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Seller');
			$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'MRP');
			$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Selling Price');
			$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Special Price');
			$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Special Price From Date');
			$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Special Price To Date');
			$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Quantity');
			$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'VAT / CST');
			$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Weight(in grams)');
			$objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Image URL1');
			$objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Image URL2');
			$objPHPExcel->getActiveSheet()->SetCellValue('P1', 'Image URL3');
			$objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'Image URL4');
			$objPHPExcel->getActiveSheet()->SetCellValue('R1', 'Image URL5');
			$objPHPExcel->getActiveSheet()->SetCellValue('S1', 'Shipping Fee Type(Free/Default)');
			$objPHPExcel->getActiveSheet()->SetCellValue('T1', 'Shipping Fee Amount');
			$objPHPExcel->getActiveSheet()->SetCellValue('U1', 'Product Approve Status');
			$objPHPExcel->getActiveSheet()->SetCellValue('V1', 'Status(Enabled/Disabled)');
			$objPHPExcel->getActiveSheet()->SetCellValue('W1', 'product highlights-1');
			$objPHPExcel->getActiveSheet()->SetCellValue('X1', 'product highlights-2');
			$objPHPExcel->getActiveSheet()->SetCellValue('Y1', 'product highlights-3');
			$objPHPExcel->getActiveSheet()->SetCellValue('Z1', 'product highlights-4');
			$objPHPExcel->getActiveSheet()->SetCellValue('AA1', 'product highlights-5');
			$objPHPExcel->getActiveSheet()->SetCellValue('AB1', 'Country of Manufacture');
			$objPHPExcel->getActiveSheet()->SetCellValue('AC1', 'Meta Title');
			$objPHPExcel->getActiveSheet()->SetCellValue('AD1', 'Meta Keywords');
			$objPHPExcel->getActiveSheet()->SetCellValue('AE1', 'Meta Description');
			
			
			
			
			
			
			$ir=2;
			
			
											$skucheck_arr=array();
											
											if($product_info != false){
												
												foreach($product_info->result() as $rows)
												{
													$excel_sku=$rows->sku;
													
													
													
																					
													if(!in_array($rows->sku,$skucheck_arr))
													{
														$description='';
														$quantity='';
														$vatorcst='';
														$weight='';
														$imag='';
														$shipping_feetype='';
														$shipping_fee_amount='';
														$status='';
														$short_desc='';
														$manufacture_country='';
														$meta_title='';
														$meta_keywords='';
														$meta_desc='';
													
														$imageurl=array();
														
														$Prod_highlight=array();					
														
														
														$prod_sku=$excel_sku;
														$prodid_check=$rows->product_id;
														$qr_prodcheck=$this->db->query("SELECT sku FROM product_master WHERE sku='$prod_sku' ");
														
													if($qr_prodcheck->num_rows()>0)
													{
														$qr_prodinfo=$this->db->query("SELECT b.description as descrp				                                                                            ,a.quantity as qnt ,a.tax_amount as vatorcst,b.weight as wgth                                                                            ,c.imag as img,a.shipping_fee as shipfeetype,
																						a.shipping_fee_amount as shipfee_amt,a.status as                                                                            enableordisable,b.short_desc as shortdescrp,a.manufacture_country as manfg,
																						d.meta_title as metatile ,d.meta_keywords as metakywrd,d.meta_desc as meta_descrp
																						FROM product_master a 
																						INNER JOIN product_general_info b ON a.product_id=b.product_id
																						INNER JOIN product_image c ON c.product_id=a.product_id
																						INNER JOIN product_meta_info d ON d.product_id=a.product_id
																						WHERE a.sku='$prod_sku' GROUP BY a.sku ");
														
															
													}
													else
													{
													$qr_prodinfo=$this->db->query("SELECT a.description as descrp,b.quantity as qnt                                                                        ,c.tax_amount as vatorcst,a.weight as wgth,d.image as img,c.shipping_fee as  				                                                                         shipfeetype,c.shipping_fee_amount as shipfee_amt,a.status as                                                                         enableordisable,a.short_desc as shortdescrp ,
																					  a.manufacture_country as manfg,e.meta_title as metatile ,
																					  e.meta_keyword as metakywrd,e.meta_description as meta_descrp
																					FROM seller_product_general_info a
																					INNER JOIN seller_product_inventory_info b ON b.seller_product_id=a.seller_product_id
																					INNER JOIN seller_product_price_info c ON c.seller_product_id=a.seller_product_id
																					INNER JOIN seller_product_image d ON d.seller_product_id=a.seller_product_id
																					INNER JOIN seller_product_meta_info e ON e.seller_product_id=a.seller_product_id
																					WHERE a.sku='$prod_sku'GROUP BY a.sku
																				");	
													}
													
													if($qr_prodinfo->num_rows()>0)
													{
														
														$description=$qr_prodinfo->row()->descrp;
														$quantity=$qr_prodinfo->row()->qnt;
														$vatorcst=$qr_prodinfo->row()->vatorcst;
														$weight=$qr_prodinfo->row()->wgth;
														$imag=$qr_prodinfo->row()->img;
														$shipping_feetype=$qr_prodinfo->row()->shipfeetype;
														$shipping_fee_amount=$qr_prodinfo->row()->shipfee_amt;
														$status=$qr_prodinfo->row()->enableordisable;
														$short_desc=$qr_prodinfo->row()->shortdescrp;
														$manufacture_country=$qr_prodinfo->row()->manfg;
														$meta_title=$qr_prodinfo->row()->metatile;
														$meta_keywords=$qr_prodinfo->row()->metakywrd;
														$meta_desc=$qr_prodinfo->row()->meta_descrp;
														
														$img_arr=explode(',',$imag);
														
														
														//$shortdescrp_unserlz=unserialize($short_desc);
														$shortdescrp_arr=unserialize($short_desc); 
														
														if(count($img_arr)>0)
														{	foreach($img_arr as $ky=>$val)
															{
																$imageurl[]=base_url().'images/product_img/'.$val;	
															}
														}
														
														if(count($shortdescrp_arr)>0)
														{
															foreach($shortdescrp_arr as $ky=>$val)
															{
																$shortdescrp_arr[]=$val;	
															}
														}
															
													}
													
												
														$objPHPExcel->getActiveSheet()->SetCellValue('A'.$ir, $rows->product_id);
														$objPHPExcel->getActiveSheet()->SetCellValue('B'.$ir, $rows->sku);
														$objPHPExcel->getActiveSheet()->SetCellValue('C'.$ir, $rows->name);
														$objPHPExcel->getActiveSheet()->SetCellValue('D'.$ir, $description);										
														$objPHPExcel->getActiveSheet()->SetCellValue('E'.$ir, $rows->business_name);										
														$objPHPExcel->getActiveSheet()->SetCellValue('F'.$ir, $rows->mrp);									
														$objPHPExcel->getActiveSheet()->SetCellValue('G'.$ir, $rows->price);
														$objPHPExcel->getActiveSheet()->SetCellValue('H'.$ir, $rows->special_price);
														$objPHPExcel->getActiveSheet()->SetCellValue('I'.$ir, $rows->special_pric_from_dt);
														$objPHPExcel->getActiveSheet()->SetCellValue('J'.$ir, $rows->special_pric_to_dt);
														$objPHPExcel->getActiveSheet()->SetCellValue('K'.$ir, $quantity);
														$objPHPExcel->getActiveSheet()->SetCellValue('L'.$ir, $vatorcst);
														$objPHPExcel->getActiveSheet()->SetCellValue('M'.$ir, $weight);
														
														if(array_key_exists("0",$imageurl)){ $imageurl1= @$imageurl[0];}else{$imageurl1= '';}
														$objPHPExcel->getActiveSheet()->SetCellValue('N'.$ir, $imageurl1);
														
														if(array_key_exists("1",$imageurl)){ $imageurl2= @$imageurl[1];}else{$imageurl2= '';}
														$objPHPExcel->getActiveSheet()->SetCellValue('O'.$ir, $imageurl2);
														
														if(array_key_exists("2",$imageurl)){ $imageurl3= @$imageurl[2];}else{$imageurl3= '';}
														$objPHPExcel->getActiveSheet()->SetCellValue('P'.$ir, $imageurl3);
														
														if(array_key_exists("3",$imageurl)){ $imageurl4= @$imageurl[3];}else{$imageurl4= '';}
														$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$ir, $imageurl4);
														
														if(array_key_exists("4",$imageurl)){ $imageurl5= @$imageurl[4];}else{$imageurl5= '';}
														$objPHPExcel->getActiveSheet()->SetCellValue('R'.$ir, $imageurl5);
														
																									
														if($shipping_fee_amount==0){$shpfee_type= "Free";}else {$shpfee_type= "Default";}  
														$objPHPExcel->getActiveSheet()->SetCellValue('S'.$ir, $shpfee_type);
														
														$objPHPExcel->getActiveSheet()->SetCellValue('T'.$ir, $shipping_fee_amount);
															
														$objPHPExcel->getActiveSheet()->SetCellValue('U'.$ir, $rows->prod_status);			
														
														$objPHPExcel->getActiveSheet()->SetCellValue('V'.$ir, $status);
														
														
														if(array_key_exists("0",$shortdescrp_arr)){ $prod_highltht_1= @$shortdescrp_arr[0];}else{$prod_highltht_1='';}
														$objPHPExcel->getActiveSheet()->SetCellValue('W'.$ir, $prod_highltht_1);	
														
														if(array_key_exists("1",$shortdescrp_arr)){ $prod_highltht_2= @$shortdescrp_arr[1];}else{$prod_highltht_2='';}
														$objPHPExcel->getActiveSheet()->SetCellValue('X'.$ir, $prod_highltht_2);
														
														
														if(array_key_exists("2",$shortdescrp_arr)){ $prod_highltht_3= @$shortdescrp_arr[2];}else{$prod_highltht_3='';}
														$objPHPExcel->getActiveSheet()->SetCellValue('Y'.$ir, $prod_highltht_3);
														
														if(array_key_exists("3",$shortdescrp_arr)){ $prod_highltht_4= @$shortdescrp_arr[3];}else{$prod_highltht_4='';}
														$objPHPExcel->getActiveSheet()->SetCellValue('Z'.$ir, $prod_highltht_4);
														
														if(array_key_exists("4",$shortdescrp_arr)){ $prod_highltht_5= @$shortdescrp_arr[4];}else{$prod_highltht_5='';}
														$objPHPExcel->getActiveSheet()->SetCellValue('AA'.$ir, $prod_highltht_5);
														
														$objPHPExcel->getActiveSheet()->SetCellValue('AB'.$ir, $manufacture_country);	
														
														$objPHPExcel->getActiveSheet()->SetCellValue('AC'.$ir, $meta_title);	
														
														$objPHPExcel->getActiveSheet()->SetCellValue('AD'.$ir, $meta_keywords);	
														
														$objPHPExcel->getActiveSheet()->SetCellValue('AE'.$ir, $meta_desc);	
													
														$ir++;
														
														$skucheck_arr[]=$rows->sku;
													}
										   
											  }
								} // main if condition end
								
								
	//$attrbexcel_i++;
	} // attrbute wise excelsheet generate end
} // category wise excel sheet generate end
	
	$objPHPExcel->getSheetByName('Worksheet')->setSheetState(PHPExcel_Worksheet::SHEETSTATE_VERYHIDDEN);
	
	foreach($fltrcatg_idarr as $kycatgfltr=>$valcatgfltr)
	{
		foreach($fltr_attrbgrpidarr as $kyfltrattb=>$valfltrattrbs)			
		{ $sheetnm='Worksheet '.$kyfltrattb;
			//$objPHPExcel->getSheetByName('Worksheet')->setSheetState(PHPExcel_Worksheet::SHEETSTATE_VERYHIDDEN);
			
			$objPHPExcel->removeSheetByIndex($objWorkSheet->getIndex($objWorkSheet->getSheetByName($sheetnm)));
			
		}
	}

 /*$RowIndex=2;
 $ColumnCount=0;
 $objPHPExcel->getActiveSheet()->freezePaneByColumnAndRow($ColumnCount, $RowIndex);						
*/
/*for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet()->getHighestColumn(); $i++) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
}*/
// Redirect output to a client's web browser (Excel5)
header('Content-Description: File Transfer');
header('Content-Type: application/vnd.ms-excel');
//header('Content-Disposition: attachment;filename="01simple.xls"');
header("Content-Disposition: attachment; filename=export_advanceproductsearch.csv");
header('Cache-Control: max-age=0');
 // If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
header("Pragma: no-cache");

header("Expires: 0");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
if (ob_get_contents()){ob_end_clean();}
if (ob_get_length()){ob_end_clean();}
$objWriter->save('php://output');




?>