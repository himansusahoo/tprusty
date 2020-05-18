<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export_excel_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
		
		$this->load->model('admin/PHPExcel/Phpexcel_iofactory');
		$this->load->model('admin/PHPExcel');	
	}

	function export_to_excel()
	{
			  //$this->load->model('admin/PHPExcel');
			  $objPHPExcel = new PHPExcel();
			  
			  $query1=$this->db->query("select * from tax_management");
			 
			 $serialnumber=0;
			 		  
			  $tmparray =array("Sr.Number","Tax ID","Tax Class Name","Tax Rate Identifier Name","Country","State","Tax Rate Percentage");
			 
			  $sheet =array($tmparray);
			
			 foreach($query1->result() as $row)
			  {
				$tmparray =array();
				$serialnumber = $serialnumber + 1;
				array_push($tmparray,$serialnumber);
				$Tax_ID = $row->tax_id;
				array_push($tmparray,$Tax_ID);
				$Tax_Class_Name = $row->tax_class;
				array_push($tmparray,$Tax_Class_Name);
				$Tax_Rate_Identifier_Name = $row->tri_name;
				array_push($tmparray,$Tax_Rate_Identifier_Name);
				$Country = $row->country;
				array_push($tmparray,$Country);
				$State = $row->state;
				array_push($tmparray,$State);
				$Tax_Rate_Percentage = $row->tax_rate_percentage;
				array_push($tmparray,$Tax_Rate_Percentage);			
				   
				array_push($sheet,$tmparray);
			  }
			   //header('Content-type: application/vnd.ms-excel; charset=UTF-8;');
//			   header('Content-Disposition: attachment; filename="test1.xls"');
//			   header("Pragma: no-cache"); 
//				header("Expires: 0");
				
			  $worksheet = $objPHPExcel->getActiveSheet();
			  foreach($sheet as $row => $columns) {
				foreach($columns as $column => $data) {
					$worksheet->setCellValueByColumnAndRow($column, $row + 1, $data);
				}
			  }		
			  
			  $objPHPExcel->getActiveSheet()->getStyle("A1:G1")->getFont()->setBold(true);
			  $objPHPExcel->setActiveSheetIndex(0);
			  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			  $objWriter->save(str_replace(__FILE__,'test1.xls',__FILE__));
			  
			  //$objWriter->save(__DIR__."/test1.xls");
			  
			  
			  //$objWriter->save(str_replace(__FILE__,'excel_downloaded/test1.xls',__FILE__));
			  
			 
			  //$objWriter->readfile("test1.xls");
			
	}
	
	function getNewsletterExcel(){
		//$this->load->model('admin/PHPExcel');
		$objPHPExcel = new PHPExcel();
			  
		$query = $this->db->query("select * from subscriber_detail");
			 
		$serialnumber = 0;
		$tmparray = array("Email");
			 
		$sheet = array($tmparray);
			
		foreach($query->result() as $row){
			$tmparray =array();
			//$serialnumber = $serialnumber + 1;
			//array_push($tmparray,$serialnumber);
			$email = $row->user_email_id;
			array_push($tmparray,$email);
			//$gender = $row->user_gender;
			//array_push($tmparray,$gender);
			//$date = $row->user_reg_date;
			//array_push($tmparray,$date);
			//$status = $row->scb_status;
			//array_push($tmparray,$status);
			   
			array_push($sheet,$tmparray);
		}
		//header('Content-type: application/vnd.ms-excel; charset=UTF-8;');
//		header('Content-Disposition: attachment; filename="newsletter.xls"');
//		header("Pragma: no-cache"); 
//		header("Expires: 0");
				
		$worksheet = $objPHPExcel->getActiveSheet();
		foreach($sheet as $row => $columns) {
			foreach($columns as $column => $data) {
				$worksheet->setCellValueByColumnAndRow($column, $row + 1, $data);
			}
		}		
			  
		$objPHPExcel->getActiveSheet()->getStyle("A1:E1")->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
		$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(15);
		$objPHPExcel->setActiveSheetIndex(0);
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$h = $objWriter->save(str_replace(__FILE__,'excel_downloaded/newsletter.xls',__FILE__));
		//$objWriter->save(str_replace('.php', '.xls', __FILE__));
		return true;
	}
	
	
	/*function getPayoutExcel(){
		//$this->load->model('admin/PHPExcel');
		$objPHPExcel = new PHPExcel();
		
		$query = $this->db->query("SELECT a.*,b.business_name FROM transaction a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id");
		//print_r($query->result());exit;
		
		$serialnumber=0;
		$tmparray =array("SL NO.","Seller Name","Seller ID","Order ID","Fixed charges","Seasonal charges","PG charges","Commission","Service Tax","Penalty","Settlement amount","Discount","Final Settlement amount");
		$sheet =array($tmparray);
		foreach($query->result() as $row){
			$tmparray =array();
			$serialnumber = $serialnumber + 1;
			array_push($tmparray,$serialnumber);
			$Seller_Name = $row->business_name;
			array_push($tmparray,$Seller_Name);
			$Seller_ID = $row->seller_id;
			array_push($tmparray,$Seller_ID);
			$Order_ID = "'".$row->order_no."'";			
			array_push($tmparray,$Order_ID);
			$Fixed_charges = $row->fixed_chgs;
			array_push($tmparray,$Fixed_charges);
			$Seasonal_charges = $row->season_chgs;
			array_push($tmparray,$Seasonal_charges);
			$PG_charges = $row->pg_chgs;
			array_push($tmparray,$PG_charges);
			$Commission = $row->commission;
			array_push($tmparray,$Commission);
			$Service_Tax = $row->service_tax;
			array_push($tmparray,$Service_Tax);
			$Penalty = $row->penalty;
			array_push($tmparray,$Penalty);
			$Settlement_amount = $row->settl_amt;
			array_push($tmparray,$Settlement_amount);
			$Discount = $row->discount;
			array_push($tmparray,$Discount);
			$Final_Settlement_amount = $row->fnal_settl_amt;
			array_push($tmparray,$Final_Settlement_amount);
			   
			array_push($sheet,$tmparray);
		}
		
		//header('Content-type: application/vnd.ms-excel; charset=UTF-8;');
//		header('Content-Disposition: attachment; filename="payout_report.xls"');
//		header("Pragma: no-cache"); 
//		header("Expires: 0");
				
		$worksheet = $objPHPExcel->getActiveSheet();
		foreach($sheet as $row => $columns) {
			foreach($columns as $column => $data) {
				$worksheet->setCellValueByColumnAndRow($column, $row + 1, $data);
			}
		}		
			  
		$objPHPExcel->getActiveSheet()->getStyle("A1:E1")->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
		$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(15);
		$objPHPExcel->setActiveSheetIndex(0);
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$h = $objWriter->save(str_replace(__FILE__,'excel_downloaded/payout_report.xls',__FILE__));
		//$objWriter->save(str_replace('.php', '.xls', __FILE__));
		return true;
	}*/
	
	/*function getSellerPayoutExcel(){
		//$this->load->model('admin/PHPExcel');
		$objPHPExcel = new PHPExcel();
		
		$query = $this->db->query("SELECT a.*,b.business_name FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id");
		//print_r($query->result());exit;
		
		$serialnumber=0;
		$tmparray =array("SL NO.","Seller Name","Seller ID","No of Orders","Final stld Amt","Accnt No","Bank Name","Ifsc Code","Accnt holder Name","UTR No.");
		$sheet =array($tmparray);
		foreach($query->result() as $row){
			$tmparray =array();
			$serialnumber = $serialnumber + 1;
			array_push($tmparray,$serialnumber);
			$Seller_Name = $row->business_name;
			array_push($tmparray,$Seller_Name);
			$Seller_ID = $row->seller_id;
			array_push($tmparray,$Seller_ID);
			$No_of_Orders = $row->no_of_orders;
			array_push($tmparray,$No_of_Orders);
			$Final_stld_Amt = $row->fnl_stl_amt;
			array_push($tmparray,$Final_stld_Amt);
			$Accnt_No =  "'".$row->bnk_acnt_no."'";
			array_push($tmparray,$Accnt_No);
			$Bank_Name = $row->bnk_name;
			array_push($tmparray,$Bank_Name);
			$Ifsc_Code = $row->bnk_ifsc_code;
			array_push($tmparray,$Ifsc_Code);
			$Accnt_holder_Name = $row->acnt_hldr_name;
			array_push($tmparray,$Accnt_holder_Name);
			$UTR_No = $row->utr_no;
			array_push($tmparray,$UTR_No);
			   
			array_push($sheet,$tmparray);
		}
		
		//header('Content-type: application/vnd.ms-excel; charset=UTF-8;');
//		header('Content-Disposition: attachment; filename="slr_payout_report.xls"');
//		header("Pragma: no-cache"); 
//		header("Expires: 0");
				
		$worksheet = $objPHPExcel->getActiveSheet();
		foreach($sheet as $row => $columns) {
			foreach($columns as $column => $data) {
				$worksheet->setCellValueByColumnAndRow($column, $row + 1, $data);
			}
		}		
			  
		$objPHPExcel->getActiveSheet()->getStyle("A1:E1")->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
		$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(15);
		$objPHPExcel->setActiveSheetIndex(0);
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$h = $objWriter->save(str_replace(__FILE__,'excel_downloaded/slr_payout_report.xls',__FILE__));
		//$objWriter->save(str_replace('.php', '.xls', __FILE__));
		return true;
	}*/
}
?>