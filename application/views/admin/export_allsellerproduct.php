<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->model('PHPExcel/Phpexcel_iofactory');
$objPHPExcel = new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('#00CC00');
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Product Id');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'SKU');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Product Name');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Category');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Image URL');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Product Status');


$ir=2;

								/*$row = $result->num_rows();
								if($row > 0){*/
								if($seller_product != false){
									
									foreach($seller_product->result() as $rows){
										
										
										
									
									$qr_slrprodimg=$this->db->query("select b.catelog_img_url  from seller_product_master a INNER JOIN  seller_existingproduct_image b ON a.seller_exist_product_id=b.seller_extproduct_id WHERE  a.sku='$rows->sku' ");
								if($qr_slrprodimg->num_rows()>0)
								{
									$rw_img=str_replace('catalog_','original_',$qr_slrprodimg->row()->catelog_img_url);
									$prod_imglink=base_url().'images/product_img/'.$rw_img;
								}else
								{
									$rw_img=str_replace('catalog_','original_',$rows->catelog_img_url);
									$prod_imglink=base_url().'images/product_img/'.$rw_img;
								}
								
									//$product_iddisplay='';
									if($rows->master_product_id!='')
									{$product_iddisplay=$rows->master_product_id;}
									else
									{$product_iddisplay=$rows->seller_product_id;}
									
									$objPHPExcel->getActiveSheet()->SetCellValue('A'.$ir, $product_iddisplay);
									$objPHPExcel->getActiveSheet()->SetCellValue('B'.$ir, $rows->sku);
									
									$objPHPExcel->getActiveSheet()->SetCellValue('C'.$ir, $rows->name);
									
									$catg_id=$rows->category;
									$qr_ctg=$this->db->query("SELECT * FROM temp_category WHERE lvl2='$catg_id' ");
									
									
									$objPHPExcel->getActiveSheet()->SetCellValue('D'.$ir, $qr_ctg->row()->lvlmain_name.' >> '.$qr_ctg->row()->lvl1_name.' >> '.$qr_ctg->row()->lvl2_name);
									
									
									$objPHPExcel->getActiveSheet()->SetCellValue('E'.$ir, $prod_imglink);
									
									$objPHPExcel->getActiveSheet()->SetCellValue('F'.$ir, $rows->product_approve);
										
										
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
header("Content-Disposition: attachment; filename=export_allsellerproduct.csv");
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