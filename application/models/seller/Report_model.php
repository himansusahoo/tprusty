<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {
	
function order_report_count(){
		@$seller_id = $this->session->userdata('seller-session');
		
		$query = $this->db->query("SELECT a.order_id FROM order_info a INNER JOIN ordered_product_from_addtocart b ON a.order_id=b.order_id 
		INNER JOIN seller_account_information c ON b.seller_id=c.seller_id 
		INNER JOIN user d ON b.user_id=d.user_id WHERE b.seller_id='$seller_id' GROUP BY b.order_id ORDER BY a.id DESC");
		if($query->num_rows() > 0){
			return $query->num_rows();
		}else{
			return false;
		}
	}
	



function retrieve_order_report($limit,$start){
		@$seller_id = $this->session->userdata('seller-session');
		
		$query = $this->db->query("SELECT b.seller_id,a.order_id,a.Total_amount,a.date_of_order,a.order_status,c.business_name,d.email FROM order_info a INNER JOIN ordered_product_from_addtocart b ON a.order_id=b.order_id 
		INNER JOIN seller_account_information c ON b.seller_id=c.seller_id 
		INNER JOIN user d ON b.user_id=d.user_id WHERE b.seller_id='$seller_id' GROUP BY b.order_id ORDER BY a.id DESC LIMIT ".$start.",".$limit."");
		return $query->result();
	}
	
	
	function export_orderreport($limit,$start){
		@$seller_id = $this->session->userdata('seller-session');
		
		$query = $this->db->query("SELECT b.seller_id,a.order_id,a.Total_amount,a.date_of_order,a.order_status,c.business_name,d.email FROM order_info a INNER JOIN ordered_product_from_addtocart b ON a.order_id=b.order_id 
		INNER JOIN seller_account_information c ON b.seller_id=c.seller_id 
		INNER JOIN user d ON b.user_id=d.user_id WHERE b.seller_id='$seller_id' GROUP BY b.order_id ORDER BY a.id DESC LIMIT ".$start.",".$limit."");
		return $query->result();
	}
	
	function filter_order_count(){
		@$seller_id = $this->session->userdata('seller-session');
			$order_date = $_REQUEST['order_date'];	
			$order_id = $_REQUEST['order_id'];
			$email = $_REQUEST['email'];
			$amount = $_REQUEST['amount'];	
			$status = $_REQUEST['status'];
			$condition = "";
				
				if($order_date != ""){
				$condition .= " a.date_of_order LIKE '%$order_date%' " ;
				$query=$this->db->query("SELECT a.order_id FROM order_info a INNER JOIN ordered_product_from_addtocart b ON a.order_id=b.order_id 
		INNER JOIN seller_account_information c ON b.seller_id=c.seller_id 
		INNER JOIN user d ON b.user_id=d.user_id WHERE b.seller_id='$seller_id' AND ".$condition." GROUP BY b.order_id ORDER BY a.id DESC ");
		
						return $query->num_rows();
					}
				if($order_id != ""){
				$condition .= " a.order_id= '$order_id' " ;
				$query=$this->db->query("SELECT a.order_id FROM order_info a INNER JOIN ordered_product_from_addtocart b ON a.order_id=b.order_id 
		INNER JOIN seller_account_information c ON b.seller_id=c.seller_id 
		INNER JOIN user d ON b.user_id=d.user_id WHERE b.seller_id='$seller_id' AND ".$condition." GROUP BY b.order_id ORDER BY a.id DESC ");
						return $query->num_rows();
					}
					if($email != ""){
				$condition .= " d.email LIKE '%$email%' " ;
				$query=$this->db->query("SELECT a.order_id FROM order_info a INNER JOIN ordered_product_from_addtocart b ON a.order_id=b.order_id 
		INNER JOIN seller_account_information c ON b.seller_id=c.seller_id 
		INNER JOIN user d ON b.user_id=d.user_id WHERE b.seller_id='$seller_id' AND  ".$condition." GROUP BY b.order_id ORDER BY a.id DESC ");
						return $query->num_rows();
					}
					if($amount != ""){
				$condition .= " a.Total_amount = '$amount' " ;
				$query=$this->db->query("SELECT a.order_id FROM order_info a INNER JOIN ordered_product_from_addtocart b ON a.order_id=b.order_id 
		INNER JOIN seller_account_information c ON b.seller_id=c.seller_id 
		INNER JOIN user d ON b.user_id=d.user_id WHERE b.seller_id='$seller_id' AND  ".$condition." GROUP BY b.order_id ORDER BY a.id DESC ");
						return $query->num_rows();
					}
				if( $status != "" ){
					 	$condition .= "a.order_status='$status'" ;
						$query=$this->db->query("SELECT a.order_id FROM order_info a INNER JOIN ordered_product_from_addtocart b ON a.order_id=b.order_id 
		INNER JOIN seller_account_information c ON b.seller_id=c.seller_id 
		INNER JOIN user d ON b.user_id=d.user_id WHERE b.seller_id='$seller_id' AND ".$condition." GROUP BY b.order_id ORDER BY a.id DESC ");
						return $query->num_rows();
					}
				if($condition == ""){
					$query=$this->db->query("SELECT a.order_id FROM order_info a INNER JOIN ordered_product_from_addtocart b ON a.order_id=b.order_id 
		INNER JOIN seller_account_information c ON b.seller_id=c.seller_id 
		INNER JOIN user d ON b.user_id=d.user_id WHERE b.seller_id='$seller_id' GROUP BY b.order_id ORDER BY a.id DESC ");
					return $query->num_rows();
					}
				}
		
		function filtered_order($limit,$start)
		{
			@$seller_id = $this->session->userdata('seller-session');
			$order_date = $_REQUEST['order_date'];	
			$order_id = $_REQUEST['order_id'];
			$email = $_REQUEST['email'];
			$amount = $_REQUEST['amount'];	
			$status = $_REQUEST['status'];
			$condition = "";
				
				if($order_date != ""){
				$condition .= " a.date_of_order LIKE '%$order_date%' " ;
				$query=$this->db->query("SELECT a.order_id,a.Total_amount,a.date_of_order,a.order_status,b.seller_id,c.business_name,d.email FROM order_info a INNER JOIN ordered_product_from_addtocart b ON a.order_id=b.order_id 
		INNER JOIN seller_account_information c ON b.seller_id=c.seller_id 
		INNER JOIN user d ON b.user_id=d.user_id WHERE b.seller_id='$seller_id' AND ".$condition." GROUP BY b.order_id ORDER BY a.id DESC LIMIT ".$start.", ".$limit."");
						return $query->result();
					}
				if($order_id != ""){
				$condition .= " a.order_id= '$order_id' " ;
				$query=$this->db->query("SELECT a.order_id,a.Total_amount,a.date_of_order,a.order_status,b.seller_id,c.business_name,d.email FROM order_info a INNER JOIN ordered_product_from_addtocart b ON a.order_id=b.order_id 
		INNER JOIN seller_account_information c ON b.seller_id=c.seller_id 
		INNER JOIN user d ON b.user_id=d.user_id WHERE b.seller_id='$seller_id' AND ".$condition." GROUP BY b.order_id ORDER BY a.id DESC LIMIT ".$start.", ".$limit."");
						return $query->result();
					}
					if($email != ""){
				$condition .= " d.email LIKE '%$email%' " ;
				$query=$this->db->query("SELECT a.order_id,a.Total_amount,a.date_of_order,a.order_status,b.seller_id,c.business_name,d.email FROM order_info a INNER JOIN ordered_product_from_addtocart b ON a.order_id=b.order_id 
		INNER JOIN seller_account_information c ON b.seller_id=c.seller_id 
		INNER JOIN user d ON b.user_id=d.user_id WHERE b.seller_id='$seller_id' AND  ".$condition." GROUP BY b.order_id ORDER BY a.id DESC LIMIT ".$start.", ".$limit."");
						return $query->result();
					}
					if($amount != ""){
				$condition .= " a.Total_amount = '$amount' " ;
				$query=$this->db->query("SELECT a.order_id,a.Total_amount,a.date_of_order,a.order_status,b.seller_id,c.business_name,d.email FROM order_info a INNER JOIN ordered_product_from_addtocart b ON a.order_id=b.order_id 
		INNER JOIN seller_account_information c ON b.seller_id=c.seller_id 
		INNER JOIN user d ON b.user_id=d.user_id WHERE b.seller_id='$seller_id' AND  ".$condition." GROUP BY b.order_id ORDER BY a.id DESC ");
						return $query->result();
					}
				if( $status != "" ){
					 	$condition .= "a.order_status='$status'" ;
						$query=$this->db->query("SELECT a.order_id,a.Total_amount,a.date_of_order,a.order_status,b.seller_id,c.business_name,d.email FROM order_info a INNER JOIN ordered_product_from_addtocart b ON a.order_id=b.order_id 
		INNER JOIN seller_account_information c ON b.seller_id=c.seller_id 
		INNER JOIN user d ON b.user_id=d.user_id WHERE b.seller_id='$seller_id' AND  ".$condition." GROUP BY b.order_id ORDER BY a.id DESC LIMIT ".$start.", ".$limit."");
						return $query->result();
					}
				if($condition == ""){
					$query=$this->db->query("SELECT a.order_id,a.Total_amount,a.date_of_order,a.order_status,b.seller_id,c.business_name,d.email FROM order_info a INNER JOIN ordered_product_from_addtocart b ON a.order_id=b.order_id 
		INNER JOIN seller_account_information c ON b.seller_id=c.seller_id 
		INNER JOIN user d ON b.user_id=d.user_id WHERE b.seller_id='$seller_id' GROUP BY b.order_id ORDER BY a.id DESC LIMIT ".$start.", ".$limit."");
					return $query->result();
					}
				}
	
		function return_report_count(){
		@$seller_id = $this->session->userdata('seller-session');
		
		$query = $this->db->query("SELECT a.return_id FROM return_product a 
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN cornjob_productsearch e ON a.sku=e.sku
		INNER JOIN USER d ON c.user_id=d.user_id WHERE b.seller_id='$seller_id' GROUP BY c.order_id ORDER BY a.id DESC");
		if($query->num_rows() > 0){
			return $query->num_rows();
		}else{
			return false;
		}
	}		
			
			
	function retrieve_return_order_report($limit,$start){
		@$seller_id = $this->session->userdata('seller-session');
		
		$query = $this->db->query("SELECT a.return_id,a.order_id,a.total_amount,a.reason,a.status,a.cdate,a.quantity,b.business_name,d.email,e.name FROM return_product a 
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN cornjob_productsearch e ON a.sku=e.sku
		INNER JOIN USER d ON c.user_id=d.user_id WHERE b.seller_id='$seller_id' GROUP BY c.order_id ORDER BY a.id DESC LIMIT ".$start.", ".$limit."");
		return $query->result();
	}
	
	
	
	
	function search_prod_name(){
		@$seller_id = $this->session->userdata('seller-session');
		$prod_name = $this->input->post('prod_name');
		$query = $this->db->query("
		SELECT e.name FROM return_product a 
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN cornjob_productsearch e ON a.sku=e.sku
		INNER JOIN USER d ON c.user_id=d.user_id WHERE b.seller_id='$seller_id' AND e.name LIKE '$prod_name%' GROUP BY e.name");
		return $query;
	}
	
	function export_returnreport($limit,$start){
		@$seller_id = $this->session->userdata('seller-session');
		
		$query = $this->db->query("SELECT a.return_id,a.order_id,a.total_amount,a.reason,a.status,a.cdate,a.quantity,b.business_name,d.email,e.name FROM return_product a 
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN cornjob_productsearch e ON a.sku=e.sku
		INNER JOIN USER d ON c.user_id=d.user_id WHERE b.seller_id='$seller_id' GROUP BY c.order_id ORDER BY a.id DESC LIMIT ".$start.", ".$limit."");
		return $query->result();
	}
	function filter_return_count(){
		@$seller_id = $this->session->userdata('seller-session');
			$retn_dt = $_REQUEST['retn_dt'];
			$order_id = $_REQUEST['order_id'];	
			$retn_id = $_REQUEST['retn_id'];
			$prod_name = $_REQUEST['prod_name'];
			$quantity = $_REQUEST['quantity'];
			//$reason= $_REQUEST['reason'];
			$amount = $_REQUEST['amount'];	
			$email = $_REQUEST['email'];
			$status = $_REQUEST['status'];
			$condition = "";
				
				if($retn_dt != ""){
				$condition .= " a.cdate LIKE '%$retn_dt%' " ;
				$query=$this->db->query("SELECT a.return_id FROM return_product a 
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN cornjob_productsearch e ON a.sku=e.sku
		INNER JOIN USER d ON c.user_id=d.user_id WHERE b.seller_id='$seller_id' AND ".$condition." GROUP BY c.order_id ORDER BY a.id DESC");
		
						return $query->num_rows();
					}
				if($order_id != ""){
				$condition .= " a.order_id= '$order_id' " ;
				$query=$this->db->query("SELECT a.return_id FROM return_product a 
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN cornjob_productsearch e ON a.sku=e.sku
		INNER JOIN USER d ON c.user_id=d.user_id WHERE b.seller_id='$seller_id' AND ".$condition." GROUP BY c.order_id ORDER BY a.id DESC");
						return $query->num_rows();
					}
					if($retn_id != ""){
				$condition .= " a.return_id = '$retn_id' " ;
				$query=$this->db->query("SELECT a.return_id FROM return_product a 
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN cornjob_productsearch e ON a.sku=e.sku
		INNER JOIN USER d ON c.user_id=d.user_id WHERE b.seller_id='$seller_id' AND ".$condition." GROUP BY c.order_id ORDER BY a.id DESC");
						return $query->num_rows();
					}
					if($prod_name != ""){
				$condition .= " e.name LIKE '%$prod_name%' " ;
				$query=$this->db->query("SELECT a.return_id FROM return_product a 
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN cornjob_productsearch e ON a.sku=e.sku
		INNER JOIN USER d ON c.user_id=d.user_id WHERE b.seller_id='$seller_id' AND ".$condition." GROUP BY c.order_id ORDER BY a.id DESC");
		
		
	
		
		
						return $query->num_rows();
					}
					if($quantity != ""){
				$condition .= " a.quantity = '$quantity' " ;
				$query=$this->db->query("SELECT a.return_id FROM return_product a 
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN cornjob_productsearch e ON a.sku=e.sku
		INNER JOIN USER d ON c.user_id=d.user_id WHERE b.seller_id='$seller_id' AND ".$condition." GROUP BY c.order_id ORDER BY a.id DESC");
		
						return $query->num_rows();
					}
					/*if($reason != ""){
				$condition .= " a.reason = '$reason' " ;
				$query=$this->db->query("SELECT a.return_id FROM return_product a 
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN cornjob_productsearch e ON a.sku=e.sku
		INNER JOIN USER d ON c.user_id=d.user_id WHERE b.seller_id='$seller_id' AND ".$condition." GROUP BY c.order_id ORDER BY a.id DESC");
		
						return $query->num_rows();
					}*/
					if($amount != ""){
				$condition .= " a.total_amount LIKE '$amount' " ;
				$query=$this->db->query("SELECT a.return_id FROM return_product a 
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN cornjob_productsearch e ON a.sku=e.sku
		INNER JOIN USER d ON c.user_id=d.user_id WHERE b.seller_id='$seller_id' AND ".$condition." GROUP BY c.order_id ORDER BY a.id DESC");
		
						return $query->num_rows();
					}
					if($email != ""){
				$condition .= " d.email LIKE '%$email%' " ;
				$query=$this->db->query("SELECT a.return_id FROM return_product a 
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN cornjob_productsearch e ON a.sku=e.sku
		INNER JOIN USER d ON c.user_id=d.user_id WHERE b.seller_id='$seller_id' AND ".$condition." GROUP BY c.order_id ORDER BY a.id DESC");
		
						return $query->num_rows();
					}
				if( $status != "" ){
					 	$condition .= "a.status='$status'" ;
						$query=$this->db->query("SELECT a.return_id FROM return_product a 
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN cornjob_productsearch e ON a.sku=e.sku
		INNER JOIN USER d ON c.user_id=d.user_id WHERE b.seller_id='$seller_id' AND ".$condition." GROUP BY c.order_id ORDER BY a.id DESC");
						return $query->num_rows();
					}
				if($condition == ""){
					$query=$this->db->query("SELECT a.return_id FROM return_product a 
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN cornjob_productsearch e ON a.sku=e.sku
		INNER JOIN USER d ON c.user_id=d.user_id WHERE b.seller_id='$seller_id' GROUP BY c.order_id ORDER BY a.id DESC");
					return $query->num_rows();
					}
				}
		
		function filtered_return($limit,$start)
		{
			@$seller_id = $this->session->userdata('seller-session');
			$retn_dt = $_REQUEST['retn_dt'];
			$order_id = $_REQUEST['order_id'];	
			$retn_id = $_REQUEST['retn_id'];
			$prod_name = $_REQUEST['prod_name'];
			$quantity = $_REQUEST['quantity'];
			//$reason= $_REQUEST['reason'];
			$amount = $_REQUEST['amount'];	
			$email = $_REQUEST['email'];
			$status = $_REQUEST['status'];
			$condition = "";
				
				if($retn_dt != ""){
				$condition .= " a.cdate LIKE '%$retn_dt%' " ;
				$query=$this->db->query("SELECT a.return_id,a.order_id,a.total_amount,a.reason,a.status,a.cdate,a.quantity,b.business_name,d.email,e.name FROM return_product a 
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN cornjob_productsearch e ON a.sku=e.sku
		INNER JOIN USER d ON c.user_id=d.user_id WHERE b.seller_id='$seller_id' AND ".$condition." GROUP BY c.order_id ORDER BY a.id DESC LIMIT ".$start.", ".$limit."");
		
						return $query->result();
					}
				if($order_id != ""){
				$condition .= " a.order_id= '$order_id' " ;
				$query=$this->db->query("SELECT a.return_id,a.order_id,a.total_amount,a.reason,a.status,a.cdate,a.quantity,b.business_name,d.email,e.name FROM return_product a 
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN cornjob_productsearch e ON a.sku=e.sku
		INNER JOIN USER d ON c.user_id=d.user_id WHERE b.seller_id='$seller_id' AND ".$condition." GROUP BY c.order_id ORDER BY a.id DESC LIMIT ".$start.", ".$limit."");
						return $query->result();
					}
					if($retn_id != ""){
				$condition .= " a.return_id = '$retn_id' " ;
				$query=$this->db->query("SELECT a.return_id,a.order_id,a.total_amount,a.reason,a.status,a.cdate,a.quantity,b.business_name,d.email,e.name FROM return_product a 
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN cornjob_productsearch e ON a.sku=e.sku
		INNER JOIN USER d ON c.user_id=d.user_id WHERE b.seller_id='$seller_id' AND ".$condition." GROUP BY c.order_id ORDER BY a.id DESC LIMIT ".$start.", ".$limit."");
						return $query->result();
					}
					if($prod_name != ""){
				$condition .= " e.name LIKE '%$prod_name%' " ;
				$query=$this->db->query("SELECT a.return_id,a.order_id,a.total_amount,a.reason,a.status,a.cdate,a.quantity,b.business_name,d.email,e.name FROM return_product a 
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN cornjob_productsearch e ON a.sku=e.sku
		INNER JOIN USER d ON c.user_id=d.user_id WHERE b.seller_id='$seller_id' AND ".$condition." GROUP BY c.order_id ORDER BY a.id DESC LIMIT ".$start.", ".$limit."");
							return $query->result();
					}
					if($quantity != ""){
				$condition .= " a.quantity = '$quantity' " ;
				$query=$this->db->query("SELECT a.return_id,a.order_id,a.total_amount,a.reason,a.status,a.cdate,a.quantity,b.business_name,d.email,e.name FROM return_product a 
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN cornjob_productsearch e ON a.sku=e.sku
		INNER JOIN USER d ON c.user_id=d.user_id WHERE b.seller_id='$seller_id' AND ".$condition." GROUP BY c.order_id ORDER BY a.id DESC LIMIT ".$start.", ".$limit."");
		
						return $query->result();
					}
					/*if($reason != ""){
				$condition .= " a.reason = '$reason' " ;
				$query=$this->db->query("SELECT a.return_id,a.order_id,a.total_amount,a.reason,a.status,a.cdate,a.quantity,b.business_name,d.email,e.name FROM return_product a 
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN cornjob_productsearch e ON a.sku=e.sku

		INNER JOIN USER d ON c.user_id=d.user_id WHERE b.seller_id='$seller_id' AND ".$condition." GROUP BY c.order_id ORDER BY a.id DESC LIMIT ".$start.", ".$limit."");
		
						return $query->result();
					}*/
					if($amount != ""){
				$condition .= " a.total_amount = '$amount' " ;
				$query=$this->db->query("SELECT a.return_id,a.order_id,a.total_amount,a.reason,a.status,a.cdate,a.quantity,b.business_name,d.email,e.name FROM return_product a 
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN cornjob_productsearch e ON a.sku=e.sku
		INNER JOIN USER d ON c.user_id=d.user_id WHERE b.seller_id='$seller_id' AND ".$condition." GROUP BY c.order_id ORDER BY a.id DESC LIMIT ".$start.", ".$limit."");
		
						return $query->result();
					}
					if($email != ""){
				$condition .= " d.email LIKE '%$email%' " ;
				$query=$this->db->query("SELECT a.return_id,a.order_id,a.total_amount,a.reason,a.status,a.cdate,a.quantity,b.business_name,d.email,e.name FROM return_product a 
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN cornjob_productsearch e ON a.sku=e.sku
		INNER JOIN USER d ON c.user_id=d.user_id WHERE b.seller_id='$seller_id' AND ".$condition." GROUP BY c.order_id ORDER BY a.id DESC LIMIT ".$start.", ".$limit."");
		
						return $query->result();
					}
				if( $status != "" ){
					 	$condition .= "a.status='$status'" ;
						$query=$this->db->query("SELECT a.return_id,a.order_id,a.total_amount,a.reason,a.status,a.cdate,a.quantity,b.business_name,d.email,e.name FROM return_product a 
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN cornjob_productsearch e ON a.sku=e.sku
		INNER JOIN USER d ON c.user_id=d.user_id WHERE b.seller_id='$seller_id' AND ".$condition." GROUP BY c.order_id ORDER BY a.id DESC LIMIT ".$start.", ".$limit."");
						return $query->result();
					}
				if($condition == ""){
					$query=$this->db->query("SELECT a.return_id,a.order_id,a.total_amount,a.reason,a.status,a.cdate,a.quantity,b.business_name,d.email,e.name FROM return_product a 
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN cornjob_productsearch e ON a.sku=e.sku
		INNER JOIN USER d ON c.user_id=d.user_id WHERE b.seller_id='$seller_id' GROUP BY c.order_id ORDER BY a.id DESC LIMIT ".$start.", ".$limit."");
					return $query->result();
					}
				}
	
	function retrieve_seller_all_payout(){
		@$seller_id = $this->session->userdata('seller-session');
		
		$query = $this->db->query("SELECT a.*,b.business_name FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
									WHERE  a.seller_id='$seller_id' ORDER BY a.id DESC");
		return $query->result();
	}

	
}