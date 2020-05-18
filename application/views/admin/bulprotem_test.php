<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->model('PHPExcel/Phpexcel_iofactory');
$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#00CC00');
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'SKU');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Product Name');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Category');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Description');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Product Link');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Image Link');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Product Cost');
$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Delivery Cost');

$ir=2;

								/*$row = $result->num_rows();
								if($row > 0){*/
								if($result != false){
									
									foreach($result->result() as $rows){
										
										
										$product_link=base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rows->name)))).'/'.$rows->product_id.'/'.$rows->sku  ;
									
									$qr_slrprodimg=$this->db->query("select b.catelog_img_url  from seller_product_master a INNER JOIN  seller_existingproduct_image b ON a.seller_exist_product_id=b.seller_extproduct_id WHERE  a.sku='$rows->sku' ");
								if($qr_slrprodimg->num_rows()>0)
								{
									$rw_img=str_replace('catalog_','',$qr_slrprodimg->row()->catelog_img_url);
									$prod_imglink=base_url().'images/product_img/'.$rw_img;
								}else
								{
									$rw_img=str_replace('catalog_','',$rows->catelog_img_url);
									$prod_imglink=base_url().'images/product_img/'.$rw_img;
								}
								
								
								//Final price program start here//
								$cdate = date('Y-m-d');
								$special_price_from_dt = $rows->special_pric_from_dt;
								$special_price_to_dt = $rows->special_pric_to_dt;
                                if($rows->special_price !=0){
                                    if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                                        $actual_price = $rows->special_price;
                                    }else{
                                        if($rows->price != 0){
                                            $actual_price = $rows->price;
                                        }else{
                                            $actual_price = $rows->mrp;
                                        }
                                    }
                                }else{
                                    if($rows->price != 0){
                                        $actual_price = $rows->price;
                                    }else{
                                        $actual_price = $rows->mrp;
                                    }
                                }
								//Final price program end here//
										
										
										
									$objPHPExcel->getActiveSheet()->SetCellValue('A'.$ir, $rows->sku);
									$objPHPExcel->getActiveSheet()->SetCellValue('B'.$ir, $rows->name);
									$objPHPExcel->getActiveSheet()->SetCellValue('C'.$ir, $rows->lvlmain_name.' >> '.$rows->lvl1_name.' >> '.$rows->lvl2_name);
									$objPHPExcel->getActiveSheet()->SetCellValue('D'.$ir, $rows->description);
									$objPHPExcel->getActiveSheet()->SetCellValue('E'.$ir, $product_link);
									$objPHPExcel->getActiveSheet()->SetCellValue('F'.$ir, $prod_imglink);
									$objPHPExcel->getActiveSheet()->SetCellValue('G'.$ir, $actual_price);
									$objPHPExcel->getActiveSheet()->SetCellValue('H'.$ir, $rows->shipping_fee_amount);
										
										
								$ir++;	
                               
								}
					} // main if condition end
 $RowIndex=2;
 $ColumnCount=0;
 $objPHPExcel->getActiveSheet()->freezePaneByColumnAndRow($ColumnCount, $RowIndex);						

for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet()->getHighestColumn(); $i++) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
}
// Redirect output to a client's web browser (Excel5)
header('Content-Description: File Transfer');
header('Content-Type: application/vnd.ms-excel');
//header('Content-Disposition: attachment;filename="01simple.xls"');
header("Content-Disposition: attachment; filename=export_allproduct.xls");
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
ob_end_clean();
ob_end_clean();
$objWriter->save('php://output');



?>