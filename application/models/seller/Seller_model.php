<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seller_model extends CI_Model {
	
	function get_unique_id(){
		$query = $this->db->query('SELECT MAX(seller_id) AS `maxid` FROM seller_account');
		$maxId = $query->row()->maxid;
		$id = $maxId+1;
		return $id;
	}
	function get_maximaum_id($table,$uid){
			
		$query = $this->db->query('SELECT MAX('.$uid.') AS `maxid` FROM '.$table);
		$maxId = $query->row()->maxid;
		$id = $maxId+1;
		return $id;
		}
		
		function update_selleruid()
		{
			$query=$this->db->query("SELECT seller_id FROM  seller_account WHERE seller_uid=0 AND seller_id!=0");
			$rw=$query->result();
			foreach($rw as $res)
			{	
				$seller_id=$res->seller_id;
				$seller_uid=1000+$res->seller_id;
				$this->db->query("UPDATE seller_account SET seller_uid='$seller_uid' WHERE seller_id='$seller_id' ");
			}
		}
	
	
	function insert_newseller($data){
		$query = $this->db->insert('seller_account', $data);
		if($query){
			return true;
		}else{
			return false;
		}
	}
	function insert_verification_info($sell_online, $here_about, $seller_id){
		$query = $this->db->query("UPDATE seller_account SET sell_online='".$sell_online."', here_about_us='".$here_about."' WHERE seller_id='".$seller_id."'");
		if($query){
			return true;
		}else{
			return false;
		}
	}
	function seller_login($data){
		$email = $data['email'];
		$password = md5($data['password']);
		$query = $this->db->query("SELECT * FROM seller_account WHERE email = '$email' AND password = '$password'");
		$row = $query->num_rows();
		if($row > 0){
			return true;
		}else{
			return false;
		}
	}
	function check_seller_signup($seller_id){
		$this->db->where('seller_id', $seller_id); 
		$query = $this->db->get('seller_account_information');
		$result = $query->result();
		return $result;
	}
	function seller_details($email) {
		$query = $this->db->query("SELECT * FROM seller_account WHERE email='" .$email. "'");
		$row = $query->num_rows();
		if($row == 1){
			return $query->result();
		}else{
			return false;
		}
	}
	function get_seller_id($get_seller_id){ 
		$query = $this->db->query("SELECT * from seller_account WHERE seller_id='" .$get_seller_id. "'");
		$row = $query->num_rows();
		//$rw_nm=$query->row();
//		
//		$selr_data['seller_nm']=$rw_nm->name	;									
//								//-------------------------Data For message end----------------------------------
//														   
//		$this->email->set_mailtype("html");
//		$this->email->from(SUPPORT_MAIL, DOMAIN_NAME);
//		$this->email->to($rw_nm->email);
//		//$this->email->to('santanu@paramountitsolutions.co.in');
//		$this->email->subject('Seller Registration Successfully');
//		$this->email->message($this->load->view('email_template/seller_registration',$selr_data,true));
//		//$this->email->message($message1);
//		//$this->email->attach(pdf_create($html, 'order_Slip'));
//		$this->email->send();
//		
//				date_default_timezone_set('Asia/Calcutta');
//				$dt = date('Y-m-d H:i:s');
//					
//				$msg=$this->load->view('email_template/seller_registration',$selr_data,true);
//				if($this->email->send()){
//					
//					$email_data=array(
//					'to_email_id'=>$rw_nm->email,
//					'from_email_id'=>SUPPORT_MAIL,
//					'date'=>$dt,
//					'email_sub'=>'Seller Registration Successfully',
//					'email_content'=>$msg,
//					'email_send_status'=>'Success'
//					);
//				}else
//				{
//					$email_data=array(
//					'to_email_id'=>$rw_nm->email,
//					'from_email_id'=>SUPPORT_MAIL,
//					'date'=>$dt,
//					'email_sub'=>'Seller Registration Successfully',
//					'email_content'=>$msg,
//					'email_send_status'=>'Failure'
//					);	
//				}
//				$this->db->insert('email_log',$email_data);					
							
				
		if($row == 1){
			return $query->result();
		}else{
			return false;
		}
	}
	
	
	function emaito_newseller($seller_id)
	{
		$query = $this->db->query("SELECT * from seller_account WHERE seller_id='" .$seller_id. "'");
		//$row = $query->num_rows();
		$rw_nm=$query->row();
		
		$selr_data['seller_nm']=$rw_nm->name	;									
								//-------------------------Data For message end----------------------------------
														   
		$this->email->set_mailtype("html");
		$this->email->from(SUPPORT_MAIL, DOMAIN_NAME);
		$this->email->to($rw_nm->email);
		//$this->email->to('santanu@paramountitsolutions.co.in');
		$this->email->subject('Seller Account Registration Received');
		$this->email->message($this->load->view('email_template/seller_registration',$selr_data,true));
		//$this->email->message($message1);
		//$this->email->attach(pdf_create($html, 'order_Slip'));
		$this->email->send();
		
				date_default_timezone_set('Asia/Calcutta');
				$dt = date('Y-m-d H:i:s');
					
				$msg=$this->load->view('email_template/seller_registration',$selr_data,true);
				if($this->email->send()){
					
					$email_data=array(
					'to_email_id'=>$rw_nm->email,
					'from_email_id'=>SUPPORT_MAIL,
					'date'=>$dt,
					'email_sub'=>'Seller Account Registration Received',
					'email_content'=>$msg,
					'email_send_status'=>'Success'
					);
				}else
				{
					$email_data=array(
					'to_email_id'=>$rw_nm->email,
					'from_email_id'=>SUPPORT_MAIL,
					'date'=>$dt,
					'email_sub'=>'Seller Account Registration Received',
					'email_content'=>$msg,
					'email_send_status'=>'Failure'
					);	
				}
				$this->db->insert('email_log',$email_data);	
			
	}
	
	
	function insert_seller_info($pan_img_name,$tin_img_name,$tan_img_name,$gstin_img_name,$address_img_name,$ID_img_name,$Cheque_img_name){
		$seller_id = $this->session->userdata('seller-session');
		$seller_data = array(
			'seller_id' => $seller_id,
			'pname' => $this->input->post('pname'),
			'pemail' => $this->input->post('pemail'),
			'pmobile' => $this->input->post('pmobile'),
			'business_name' => $this->input->post('bname'),
			'business_desc' => $this->input->post('business_desc'),
			'pan' => $this->input->post('pan'),
			'pan_img' => $pan_img_name,
			'tin' => $this->input->post('tin'),
			'tin_img' => $tin_img_name,
			'tan' => $this->input->post('tan'),
			'tan_img' => $tan_img_name,
			
			
//---------------------------------------sujit end---------------------------------------//
			'gstin' => $this->input->post('gstin'),
			'gstin_img' => $gstin_img_name,
//---------------------------------------sujit end---------------------------------------//


			
			'ac_holder_name' => $this->input->post('ac_holder_name'),
			'ac_number' => $this->input->post('ac_number'),
			'ifsc_code' => $this->input->post('ifsc'),
			'bank' => $this->input->post('bank'),
			'state' => $this->input->post('state'),
			'city' => $this->input->post('city'),
			'branch' => $this->input->post('branch'),
			'address_img' => $address_img_name,
			'ID_img' => $ID_img_name,
			'Cheque_img' => $Cheque_img_name,
			'display_name' => $this->input->post('display_name'),
			'store_description' => $this->input->post('store_desc'),
		);
		$query = $this->db->insert('seller_account_information', $seller_data);
		if($query){
			return true;
		}else{
			return false;
		}
	}
	function insert_email_code($to, $code){
		$query = $this->db->query("INSERT INTO seller_verification_code SET email_mobile='".$to."', otp='".$code."'");
		if($query){
			return true;
		}else{
			return false;
		}
	}
	function match_otp($email_id, $otp){
		$query = $this->db->query("SELECT * FROM seller_verification_code WHERE email_mobile='".$email_id."' AND otp='".$otp."'");
		$row = $query->num_rows();
		if($row == 1){
			return true;
		}else{
			return false;
		}
	}
	function addCategory($seller_id, $category){
		$query = $this->db->query("UPDATE seller_account SET main_selleing_category='".addslashes($category)."' WHERE seller_id = '$seller_id'");
		if($query){
			return true;
		}else{
			return false;
		}
	}
	/*function match_category($seller_id, $category){
		$query = $this->db->query("SELECT * FROM seller_account WHERE seller_id='".$seller_id."' AND main_selleing_category='".addslashes($category)."'");
		$row = $query->num_rows();
		if($row == 1){
			return true;
		}else{
			return false;
		}
	}*/
	
	function check_seller_email_address($data){
		$query = $this->db->query("SELECT * FROM seller_account WHERE email="."'".$data['email']."'");
		$row = $query->num_rows();
		if($row > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	function insert_retrive_password($retrive_data, $email_data){
		if($retrive_data!=''){
		$this->db->insert('seller_forgot_password',$retrive_data);
		}
		$this->db->insert('email_log',$email_data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	function retrive_otp_details($otp){
		$this->db->where('otp',$otp);
		$this->db->order_by('id', 'DESC');
		$this->db->limit('1');
		$query = $this->db->get('seller_forgot_password');
		$row = $query->num_rows();
		if($row > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	function update_forgot_pass($data){
		$email = $data['email'];
		$pass_data = array(
			'password' => $data['password'],
		);
		$this->db->where('email', $email);
		$query = $this->db->update('seller_account', $pass_data);
		if($query){
			return true;
		}else{
			return false;
		}
	}
	
	// Account
	function get_seller_details($seller_id){
		$query = $this->db->query("SELECT a.*, b.* FROM seller_account a INNER JOIN seller_account_information b
		ON a.seller_id = b.seller_id WHERE a.seller_id = '$seller_id'");
		return $query->result();
	}
	function check_old_password($seller_id){
		$old_pass = md5($this->input->post('old_pass'));
		$query = $this->db->query("SELECT * FROM seller_account WHERE seller_id='$seller_id' AND password='$old_pass'");
		$row = $query->num_rows();
		if($row == 1){
			return true;
		}else{
			return false;
		}
	}
	function update_password($seller_id, $new_pass){
		$data = array(
			'password' => $new_pass,
		); 
		$this->db->where('seller_id', $seller_id);
		$query = $this->db->update('seller_account', $data);
		if($query){
			return true;
		}else{
			return false;
		}
	}
	function update_Pcontact($seller_id){
		$data = array(
			'pname' => $this->input->post('p_name'),
			'pemail' => $this->input->post('p_email'),
			'pmobile' => $this->input->post('p_mobile'),
		);
		$this->db->where('seller_id', $seller_id);
		$query = $this->db->update('seller_account_information', $data);
		if($query){
			return true;
		}else{
			return false;
		}
	}
	function update_bankDetails($seller_id){ 
		$data = array(
			'ac_holder_name' => $this->input->post('ac_holder_name'),
			'ac_number' => $this->input->post('ac_number'),
			'bank' => $this->input->post('bank_name'),
			'city' => $this->input->post('bank_city'),
			'branch' => $this->input->post('bank_branch'),
			'ifsc_code' => $this->input->post('bank_IFSC'),
		);
		$this->db->where('seller_id', $seller_id);
		$query = $this->db->update('seller_account_information', $data);
		if($query){
			return true;
		}else{
			return false;
		}
	}
	
	// Account End
	
	function update_signupDateTime($seller_id){
		$this->db->where('seller_id', $seller_id); 
		$this->db->set('signin_date', 'NOW()', FALSE);
		$query = $this->db->update('seller_account');
		if($query){
			return true;
		}else{
			return false;
		}
	}
	
	
	function check_session_seller_notice(){
		$query = $this->db->query("SELECT * FROM seller_notification WHERE status='Active'");
		$result = $query->result();
		$row = $query->num_rows(); 
		if($row > 0){
			return $result[0]->content;
		}
		else{
			return false;
		}
	}
	
	/*function getSellerNoticeCountValue(){
		$seller_id = $this->session->userdata('seller-session');
		$query = $this->db->query("SELECT * FROM seller_notification2 WHERE seller_id='$seller_id'");
		$result = $query->result();
		$rows = $query->num_rows();
		return $rows;
	}*/
	function getNoticeListEachSeller(){
		$seller_id = $this->session->userdata('seller-session');
		$query = $this->db->query("SELECT * FROM seller_notification2 WHERE seller_id='$seller_id'");
		$result = $query->result();
		return $result;
	}
	/*function getOrderCountValue(){
		$seller_id = $this->session->userdata('seller-session');
		$query = $this->db->query("SELECT a.* 
		FROM ordered_product_from_addtocart a
		INNER JOIN order_info b ON a.order_id = b.order_id
		WHERE a.seller_id='$seller_id' AND (b.order_status = 'Pending payment' || b.order_status = 'Processing' || b.order_status = 'Ready to shipped' || b.order_status = 'Order confirmed')");
		$result = $query->result();
		$rows = $query->num_rows();
		return $rows;
	}
	function getSellerRatingCountValue(){
		$seller_id = $this->session->userdata('seller-session');
		$query = $this->db->query("SELECT SUM(rating) AS A, COUNT(*) AS B FROM review_seller WHERE seller_id ='$seller_id'");
		$result = $query->result();
		$a = $result[0]->A; $b = $result[0]->B;
		return $rating = ceil($a/$b);
	}*/
	
	function insert_pmobile($data){
		if($data!=''){
		$this->db->insert('seller_verification_code', $data);
		}
		$this->db->insert('email_log',$email_data);
	}
	function match_pmobile_otp(){
		$email = $this->input->post('email');
		$otp = $this->input->post('otp');
		$query = $this->db->query("SELECT * FROM seller_verification_code WHERE email_mobile='".$email."' AND otp='".$otp."'");
		$row = $query->num_rows();
		if($row == 1){
			return true;
		}else{
			return false;
		}
	}
	
	function update_seller_pmobile1(){
		$seller_id = $this->session->userdata('seller-session');
		$this->db->where('seller_id', $seller_id); 
		$data = array(
			'pname' => $this->input->post('name'),
			'pemail' => $this->input->post('email'),
			'pmobile' => $this->input->post('mobile'),
		);
		$query = $this->db->update('seller_account_information', $data);
		if($query){
			return true;
		}else{
			return false;
		}
	}
	/*function update_seller_pmobile2(){
		$seller_id = $this->session->userdata('seller-session');
		$mobile = $this->input->post('mobile');
		$this->db->where('seller_id', $seller_id); 
		$this->db->set('mobile', $mobile);
		$query = $this->db->update('seller_account');
		if($query){
			return true;
		}else{
			return false;
		}
	}*/
	
	
	function select_SellerTC()
	{
		$query_tc=$this->db->query("select * from seller_termsconditions");
		$row_tc=$query_tc->result();
		
		return 	$row_tc;
	
	}
	
	
	
	
	
}
?>