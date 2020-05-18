<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->model('PHPExcel/Phpexcel_iofactory');
set_time_limit(0);
$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getStyle('A1:AH1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#00CC00');

$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Product_id');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'SKU');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Name');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Category');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Attribute');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Description');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Seller');
$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'MRP');
$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Selling Price');
$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Special Price');
$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Special Price From Date');
$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Special Price To Date');
$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Quantity');
$objPHPExcel->getActiveSheet()->SetCellValue('N1', 'VAT / CST');
$objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Weight(in grams)');
$objPHPExcel->getActiveSheet()->SetCellValue('P1', 'Product URl');
$objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'Image URL1');
$objPHPExcel->getActiveSheet()->SetCellValue('R1', 'Image URL2');
$objPHPExcel->getActiveSheet()->SetCellValue('S1', 'Image URL3');
$objPHPExcel->getActiveSheet()->SetCellValue('T1', 'Image URL4');
$objPHPExcel->getActiveSheet()->SetCellValue('U1', 'Image URL5');
$objPHPExcel->getActiveSheet()->SetCellValue('V1', 'Shipping Fee Type(Free/Default)');
$objPHPExcel->getActiveSheet()->SetCellValue('W1', 'Shipping Fee Amount');
$objPHPExcel->getActiveSheet()->SetCellValue('X1', 'Product Approve Status');
$objPHPExcel->getActiveSheet()->SetCellValue('Y1', 'Status(Enabled/Disabled)');
$objPHPExcel->getActiveSheet()->SetCellValue('Z1', 'product highlights-1');
$objPHPExcel->getActiveSheet()->SetCellValue('AA1', 'product highlights-2');
$objPHPExcel->getActiveSheet()->SetCellValue('AB1', 'product highlights-3');
$objPHPExcel->getActiveSheet()->SetCellValue('AC1', 'product highlights-4');
$objPHPExcel->getActiveSheet()->SetCellValue('AD1', 'product highlights-5');
$objPHPExcel->getActiveSheet()->SetCellValue('AE1', 'Country of Manufacture');
$objPHPExcel->getActiveSheet()->SetCellValue('AF1', 'Meta Title');
$objPHPExcel->getActiveSheet()->SetCellValue('AG1', 'Meta Keywords');
$objPHPExcel->getActiveSheet()->SetCellValue('AH1', 'Meta Description');






$ir=2;


								$skucheck_arr=array();
								
								if($product_info != false){
									
									foreach($product_info->result() as $rows)
									{
										$excel_sku=$rows->sku;
										
										
										
																		
										if(!in_array($rows->sku,$skucheck_arr))
										{
											$product_url=base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rows->name)))).'/'.$rows->product_id.'/'.$rows->sku;
											
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
																			,f.*,h.attribute_group_name
																			FROM product_master a 
																			INNER JOIN product_general_info b ON a.product_id=b.product_id
																			INNER JOIN product_image c ON c.product_id=a.product_id
																			INNER JOIN product_meta_info d ON d.product_id=a.product_id
																			
																			INNER JOIN product_category e ON e.product_id=a.product_id
																			INNER JOIN temp_category f ON f.lvl2=e.category_id
																			INNER JOIN product_setting g ON g.product_id=a.product_id
																			INNER JOIN attribute_group h ON h.attribute_group_id=g.attribut_set
																			WHERE a.sku='$prod_sku' GROUP BY a.sku ");
											
												
										}
										else
										{
										$qr_prodinfo=$this->db->query("SELECT a.description as descrp,b.quantity as qnt                                                                        ,c.tax_amount as vatorcst,a.weight as wgth,d.image as img,c.shipping_fee as  				                                                                         shipfeetype,c.shipping_fee_amount as shipfee_amt,a.status as                                                                         enableordisable,a.short_desc as shortdescrp ,
										                                  a.manufacture_country as manfg,e.meta_title as metatile ,
																	      e.meta_keyword as metakywrd,e.meta_description as meta_descrp
																	    ,g.*,i.attribute_group_name
																		FROM seller_product_general_info a
																	    INNER JOIN seller_product_inventory_info b ON b.seller_product_id=a.seller_product_id
																	    INNER JOIN seller_product_price_info c ON c.seller_product_id=a.seller_product_id
																	    INNER JOIN seller_product_image d ON d.seller_product_id=a.seller_product_id
																	    INNER JOIN seller_product_meta_info e ON e.seller_product_id=a.seller_product_id
																		
																		INNER JOIN seller_product_category f ON f.seller_product_id=a.seller_product_id
																		INNER JOIN temp_category g ON g.lvl2=f.category
																		INNER JOIN seller_product_setting h ON h.seller_product_id=a.seller_product_id
																		INNER JOIN attribute_group i ON i.attribute_group_id=h.attribute_set
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
											
											$ctag_name=stripslashes($qr_prodinfo->row()->lvlmain_name.'>>'.$qr_prodinfo->row()->lvl1_name.'>>'.$qr_prodinfo->row()->lvl2_name);
											$attribute_gropunm=$qr_prodinfo->row()->attribute_group_name;
											
											
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
											$objPHPExcel->getActiveSheet()->SetCellValue('D'.$ir, $ctag_name);
											$objPHPExcel->getActiveSheet()->SetCellValue('E'.$ir, $attribute_gropunm);
											$objPHPExcel->getActiveSheet()->SetCellValue('F'.$ir, $description);										
											$objPHPExcel->getActiveSheet()->SetCellValue('G'.$ir, $rows->business_name);										
											$objPHPExcel->getActiveSheet()->SetCellValue('H'.$ir, $rows->mrp);									
											$objPHPExcel->getActiveSheet()->SetCellValue('I'.$ir, $rows->price);
											$objPHPExcel->getActiveSheet()->SetCellValue('J'.$ir, $rows->special_price);
											$objPHPExcel->getActiveSheet()->SetCellValue('K'.$ir, $rows->special_pric_from_dt);
											$objPHPExcel->getActiveSheet()->SetCellValue('L'.$ir, $rows->special_pric_to_dt);
											$objPHPExcel->getActiveSheet()->SetCellValue('M'.$ir, $quantity);
											$objPHPExcel->getActiveSheet()->SetCellValue('N'.$ir, $vatorcst);
											$objPHPExcel->getActiveSheet()->SetCellValue('O'.$ir, $weight);
											
											$objPHPExcel->getActiveSheet()->SetCellValue('P'.$ir, $product_url);
											
											if(array_key_exists("0",$imageurl)){ $imageurl1= @$imageurl[0];}else{$imageurl1= '';}
											$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$ir, $imageurl1);
											
											if(array_key_exists("1",$imageurl)){ $imageurl2= @$imageurl[1];}else{$imageurl2= '';}
											$objPHPExcel->getActiveSheet()->SetCellValue('R'.$ir, $imageurl2);
											
											if(array_key_exists("2",$imageurl)){ $imageurl3= @$imageurl[2];}else{$imageurl3= '';}
											$objPHPExcel->getActiveSheet()->SetCellValue('S'.$ir, $imageurl3);
											
											if(array_key_exists("3",$imageurl)){ $imageurl4= @$imageurl[3];}else{$imageurl4= '';}
											$objPHPExcel->getActiveSheet()->SetCellValue('T'.$ir, $imageurl4);
											
											if(array_key_exists("4",$imageurl)){ $imageurl5= @$imageurl[4];}else{$imageurl5= '';}
											$objPHPExcel->getActiveSheet()->SetCellValue('U'.$ir, $imageurl5);
											
																						
											if($shipping_fee_amount==0){$shpfee_type= "Free";}else {$shpfee_type= "Default";}  
											$objPHPExcel->getActiveSheet()->SetCellValue('V'.$ir, $shpfee_type);
											
											$objPHPExcel->getActiveSheet()->SetCellValue('W'.$ir, $shipping_fee_amount);
												
											$objPHPExcel->getActiveSheet()->SetCellValue('X'.$ir, $rows->prod_status);			
											
											$objPHPExcel->getActiveSheet()->SetCellValue('Y'.$ir, $status);
											
											
											if(array_key_exists("0",$shortdescrp_arr)){ $prod_highltht_1= @$shortdescrp_arr[0];}else{$prod_highltht_1='';}
											$objPHPExcel->getActiveSheet()->SetCellValue('Z'.$ir, $prod_highltht_1);	
											
											if(array_key_exists("1",$shortdescrp_arr)){ $prod_highltht_2= @$shortdescrp_arr[1];}else{$prod_highltht_2='';}
											$objPHPExcel->getActiveSheet()->SetCellValue('AA'.$ir, $prod_highltht_2);
											
											
											if(array_key_exists("2",$shortdescrp_arr)){ $prod_highltht_3= @$shortdescrp_arr[2];}else{$prod_highltht_3='';}
											$objPHPExcel->getActiveSheet()->SetCellValue('AB'.$ir, $prod_highltht_3);
											
											if(array_key_exists("3",$shortdescrp_arr)){ $prod_highltht_4= @$shortdescrp_arr[3];}else{$prod_highltht_4='';}
											$objPHPExcel->getActiveSheet()->SetCellValue('AC'.$ir, $prod_highltht_4);
											
											if(array_key_exists("4",$shortdescrp_arr)){ $prod_highltht_5= @$shortdescrp_arr[4];}else{$prod_highltht_5='';}
											$objPHPExcel->getActiveSheet()->SetCellValue('AD'.$ir, $prod_highltht_5);
											
											$objPHPExcel->getActiveSheet()->SetCellValue('AE'.$ir, $manufacture_country);	
											
											$objPHPExcel->getActiveSheet()->SetCellValue('AF'.$ir, $meta_title);	
											
											$objPHPExcel->getActiveSheet()->SetCellValue('AG'.$ir, $meta_keywords);	
											
											$objPHPExcel->getActiveSheet()->SetCellValue('AH'.$ir, $meta_desc);	
										
											$ir++;
											
											$skucheck_arr[]=$rows->sku;
										}
                               
								  }
					} // main if condition end
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