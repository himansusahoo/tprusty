<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->model('PHPExcel/Phpexcel_iofactory');
$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#00CC00');
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'SKU');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Name');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Seller');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'MRP');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Selling Price');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Special Price');

$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Special Price From Date');
$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Special Price To Date');
$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Product Status');

$ir=2;


								$skucheck_arr=array();
								
								if($product_info != false){
									
									foreach($product_info->result() as $rows)
									{
																		
										if(!in_array($rows->sku,$skucheck_arr))
										{	
									
											$objPHPExcel->getActiveSheet()->SetCellValue('A'.$ir, $rows->sku);
											$objPHPExcel->getActiveSheet()->SetCellValue('B'.$ir, $rows->name);										
											$objPHPExcel->getActiveSheet()->SetCellValue('C'.$ir, $rows->business_name);										
											$objPHPExcel->getActiveSheet()->SetCellValue('D'.$ir, $rows->mrp);									
											$objPHPExcel->getActiveSheet()->SetCellValue('E'.$ir, $rows->price);
											$objPHPExcel->getActiveSheet()->SetCellValue('F'.$ir, $rows->special_price);
											$objPHPExcel->getActiveSheet()->SetCellValue('G'.$ir, $rows->special_pric_from_dt);
											$objPHPExcel->getActiveSheet()->SetCellValue('H'.$ir, $rows->special_pric_to_dt);
											$objPHPExcel->getActiveSheet()->SetCellValue('I'.$ir, $rows->prod_status);
												
										
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