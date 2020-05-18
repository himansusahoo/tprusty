<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermodel extends CI_Model
{
	
	
	function slider_box1_select()
  {
	  $results = array();
       $qr=$this->db->query("select * from slider_box1");
   		//$row=$qr->row();
    
       return $qr->result();
   

  }
  
 
	 function block1_box1_select()
{
	//print_r($id);exit;
	$qr=$this->db->query("select * from block_and_box_images WHERE image_id = 1");	
    return $qr;
	
	}

function block1_box2_select()

{
	//print_r($id);exit;
	$qr=$this->db->query("select * from block_and_box_images WHERE image_id = 2");	
    return $qr;
	
	}
function block2_box1_select()

{
	//print_r($id);exit;
	$qr=$this->db->query("select * from block_and_box_images WHERE image_id = 3");	
    return $qr;
	
	}
	function block2_box2_select()

{
	//print_r($id);exit;
	$qr=$this->db->query("select * from block_and_box_images WHERE image_id = 4");	
    return $qr;
	
	}
	function block2_box3_select()

{
	//print_r($id);exit;
	$qr=$this->db->query("select * from block_and_box_images WHERE image_id = 5");	
    return $qr;
	
	}
	function block3_box1_select()

{
	//print_r($id);exit;
	$qr=$this->db->query("select * from block_and_box_images WHERE image_id = 6");	
    return $qr;
	
	}
	
	function ad_blog(){
		$qr=$this->db->query("select * from block_and_box_images WHERE image_id=7");	
		return $qr;
	}
	
	function search_product($keyword)
{
	/*$qr=$this->db->query("select * from product_general_info p INNER JOIN product_image i where p.name LIKE '%$keyword%' and p.product_id=i.product_id ");*/	
$qr=$this->db->query("select a.imag,b.product_id,c.name,c.description,d.price,d.special_price,d.special_pric_from_dt,d.special_pric_to_dt,d.quantity,d.sku,f.tax_rate_percentage from product_image a inner join product_category b on a.product_id=b.product_id inner join product_general_info c on c.product_id=b.product_id inner join product_master d on d.product_id=c.product_id inner join product_setting e on e.product_id=a.product_id inner join tax_management f on d.tax_class=f.tax_id inner join seller_account g on g.seller_id=d.seller_id inner join category_indexing h on b.category_id=h.category_id inner join category_indexing i on h.parent_id=i.category_id inner join category_indexing j on i.parent_id=j.category_id   where c.name LIKE '%$keyword%' or j.category_name LIKE '%$keyword%' or i.category_name LIKE '%$keyword%' or h.category_name LIKE '%$keyword%' AND e.status='Active' AND g.status='Active' ");
		   return $qr;
}

	
	function view_homepage()
	{
		$product_id_arr=count($this->session->userdata('addtocarttemp'));
		
		if($product_id_arr!=0 && $this->session->userdata('user_id')!="")
		{ 	   
			$addtocart_seesid=$this->session->userdata('addtocarttemp_session_id');
			$product_ids_arr=array();
			$product_ids_arr=$this->session->userdata('addtocarttemp');
			
			$sku_arr=array();
			$sku_arr=$this->session->userdata('addtocart_sku');
			
			//$user_id=$this->session->userdata['session_data']['user_id'];
			$user_id=$this->session->userdata('user_id');
			//echo $user_id;exit;
			
			$ct=count($product_ids_arr);
			for($i=0;$i<$ct;$i++)
			{
			//$qr=$this->db->query("select * from addtocart_temp where addtocart_session_id='$addtocart_seesid' and product_id='$product_ids_arr[$i]' and user_id='$user_id' and sku='$sku_arr[$i]' ");
//				$count_rows=$qr->num_rows();
//				if($count_rows==0){				
				
				$addtocarttemp_id=$this->get_unique_id('addtocart_temp','addtocart_id');
				$data=array(
					'addtocart_id'=>$addtocarttemp_id,
					'addtocart_session_id'=>$addtocart_seesid,
					'product_id'=>$product_ids_arr[$i],
					'user_id'=>$user_id,
					'sku'=>$sku_arr[$i]
				);			
				
				$qr=$this->db->insert('addtocart_temp',$data);
				//}
					
			}
			
		}
		
		$qr=$this->db->query("select * from pages where page_name='home'");
		$row=$qr->row();		
		return $row;	
	}
	
	
	
	function select_root_categories()
	{
		$qr=$this->db->query("select a.*,b.catg_image,b.category_id from category_indexing a inner join category_master b on a.category_name=b.category_name where a.parent_id=0 ");
		
		return $qr;	
	
	}
	
	function get_unique_id($table,$uid){
		$query = $this->db->query('SELECT MAX('.$uid.') AS `maxid` FROM '.$table);
		$maxId = $query->row()->maxid;
		$id = $maxId+1;
		return $id;
	}
	
	function retrive_state(){
		$query = $this->db->query("SELECT * FROM state");
		return $query->result();
	}
	
	function login_register(){
		date_default_timezone_set('Asia/Calcutta');
		$cdate = date('Y-m-d');
		$email = $this->input->post('email');
		$pass = $this->input->post('password');
		$encript_pass = md5($pass);
		$case = $this->input->post('flag');
		/////programming for new user start here//////
		if($case == 1){
			$query = $this->db->query("SELECT email FROM user WHERE email='$email'");
			$row = $query->num_rows();
			if($row > 0){
				echo 'exists';exit;	
			}else{
				$user_id = $this->get_unique_id('user','user_id');
				$data = array(
					'user_id' => $user_id,
					'email' => $email,
					'password' => $encript_pass,
				);
				
				$news_letter_data = array(
					'user_unique_id' => $user_id,
					'user_email_id' => $email,
					'user_reg_date' => $cdate
				);
				
				$this->db->insert('subscriber_detail',$news_letter_data);
				
				$query1 = $this->db->insert('user',$data);
				$insert_id = $this->db->insert_id();
				
				$message = "
		<div style='padding:20px;'> <h5>Hi ,</h5>
		<p>Thank you for signing up with Moonboy.in</p>
		<strong>Your Log in ID is :  ".$email." and<br/><br/>
			    Password is : ".$pass."</strong><br/>
		<p>You can now log in to Moonboy using this ID and the password. </p><br/>
           Thanks & regards,<br/>Moonboy Team <br/>
         </div>
		
		<div style='text-align:center; background-color:#0e4370; color:#fff; padding:10px;'>
	    <p> copyright@ 2015 Moonboy . All rights reserved . </p>
       </div>";
			
				$this->email->set_mailtype("html");
				$this->email->from('noreply@moonboy.in', 'Moonboy.in');
				$this->email->to($email);
				$this->email->subject('Welcome to Moonboy.in');
				$this->email->message($message);
				$this->email->send();
								
				$query2 = $this->db->query("SELECT * FROM user WHERE id='$insert_id'");
				return $query2->result();
			}
		}
		/////programming for new user end here//////
		/////programming for existing user start here//////
		if($case == 2){
			$query = $this->db->query("SELECT * FROM user WHERE email='$email' AND password='$encript_pass'");
			$result = $query->result();
			$row = $query->num_rows();
			if($row > 0){
				if($result[0]->status == 'Active'){
					return $result;
				}else{
					echo 'blocked';exit;
				}
			}else{
				echo 'invalid';exit;
			}
		}
		/////programming for existing user end here//////		
	}
	
	function check_user_email_address($data){
		$query = $this->db->query("SELECT * FROM user WHERE email="."'".$data['email']."'");
		$row = $query->num_rows();
		if($row > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function insert_social_registration_data($data){
		$this->db->insert('user',$data);
		if($this->db->affected_rows() > 0){
			return true;
		}
	}
	
	function insert_retrive_password_data($retrive_data){
		$this->db->insert('retrive_password',$retrive_data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	function retrive_otp_details($otp,$otp_email){
		$query = $this->db->query("SELECT * FROM retrive_password WHERE email='$otp_email' ORDER BY id DESC LIMIT 1");
		$result = $query->result();
		$last_otp = $result[0]->otp;
		if($otp == $last_otp){
			return $result;
		}else{
			return false;
		}
	}
	
	function update_forgot_password(){
		$email_id = $this->input->post('email');
		$data = array(			
			'password' => md5($this->input->post('pass')),
		);		
		$this->db->where('email',$email_id);
		$this->db->update('user',$data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	
	function check_password($user_id,$password){		
		$encrpt_pass = md5($password);
		$query = $this->db->query("SELECT * FROM user WHERE user_id='$user_id' AND password='$encrpt_pass'");
		$row = $query->num_rows();
		if($row > 0){
			return true;
		}else{
			return false;
		}
	}
	
	function update_changes_password($user_id,$password){
		$encrpt_pass = md5($password);
		$query = $this->db->query("UPDATE user SET password='$encrpt_pass' WHERE user_id='$user_id'");
		if($this->db->affected_rows() > 0){
			return true;
		}
	}
	
	function update_persional_info(){
		$user_id = $this->session->userdata['session_data']['user_id'];
		$data = array(
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
			'mob' => $this->input->post('mobile'),
			'gendr' => $this->input->post('gen'),			
		);
		$this->db->where('user_id',$user_id);
		$this->db->update('user',$data);
		if($this->db->affected_rows() > 0){
			$user_data = array(
				'user_id' => $user_id,
				'fname' => $data['fname']
			);
			
			//update programming start for newsletter//
			$query = $this->db->query("SELECT email FROM user WHERE user_id=$user_id");
			$result = $query->result();
			$mail_id = $result[0]->email;
			$news_data = array(
				'user_gender' => $this->input->post('gen'),
			);			
			$this->db->where('user_email_id',$mail_id);
			$this->db->update('subscriber_detail',$news_data);
			//update programming end of newsletter//
			
			$this->session->set_userdata('session_data', $user_data);
			return true;
		}else{
			return false;
		}
	}
	
	function insert_address(){
		$user_id = $this->session->userdata['session_data']['user_id'];
		$data = array(
			'user_id' => $user_id,
			'full_name' => $this->input->post('name'),
			'address' => $this->input->post('address'),
			'city' => $this->input->post('city'),
			'state' => $this->input->post('state'),
			'country' => $this->input->post('country'),
			'pin_code' => $this->input->post('pin'),
			'phone' => $this->input->post('mob'),
		);
		$this->db->insert('user_address',$data);
		$insert_id = $this->db->insert_id();
		$data_id = array('address_id' => $insert_id);
		$this->db->where('user_id',$user_id);
		$this->db->update('user',$data_id);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	function update_inn_address(){
		$user_id = $this->session->userdata['session_data']['user_id'];
		$address_id = $this->input->post('id');
		$data = array(
			'user_id' => $user_id,
			'full_name' => $this->input->post('name'),
			'address' => $this->input->post('address'),
			'city' => $this->input->post('city'),
			'state' => $this->input->post('state'),
			//'country' => $this->input->post('country'),
			'pin_code' => $this->input->post('pin'),
			'phone' => $this->input->post('mob'),
		);
		$this->db->where('address_id',$address_id);
		$this->db->update('user_address',$data);
		//update user address id in user table script start////
		$data_id = array('address_id' => $address_id);
		$this->db->where('user_id',$user_id);
		$this->db->update('user',$data_id);
		//update user address id in user table script end////
		//return ($this->db->affected_rows() != 1) ? false : true;		
		return true;
	}
	
	function retrive_user_address(){
		$user_id = $this->session->userdata['session_data']['user_id'];
		$query = $this->db->query("SELECT a.*,b.state_id,b.state AS state_name FROM user_address a INNER JOIN state b ON a.state=b.state_id WHERE a.user_id='$user_id'");
		$row = $query->num_rows();
		if($row > 0){
			return $query->result();			
		}else{
			return false;
		}
	}
	
	function retrieve_user_persional_info(){
		$user_id = $this->session->userdata['session_data']['user_id'];
		$query = $this->db->query("SELECT * FROM user WHERE user_id='$user_id'");
		$result = $query->result();
		return $result;
	}
	
	function delete_user_address(){
		$addrs_id = $this->input->post('id');
		$this->db->where('address_id',$addrs_id);
		$this->db->delete('user_address');
		return true;
	}
	
	function update_user_address(){
		$data = array('address_id' => $this->input->post('id'));		
		$user_id = $this->session->userdata['session_data']['user_id'];
		$this->db->where('user_id',$user_id);
		$this->db->update('user',$data);
		if($this->db->affected_rows() > 0){
			return true;
		}
	}
	
	function insert_product_review(){
			$user_id = $this->session->userdata['session_data']['user_id'];
			$sku = $this->input->post('sku_id');
			$query = $this->db->query("SELECT * FROM review_product WHERE user_id='$user_id' AND sku_id='$sku'");
			$rows = $query->num_rows();
			if($rows > 0){
				return 'exists';
			}else{
				$data = array(
					'user_id' => $user_id,
					'product_id' => $this->input->post('product_id'),
					'sku_id' =>$sku,
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					'rating' => $this->input->post('rating')
				);		
				$this->db->insert('review_product',$data);
				if($this->db->affected_rows() > 0){
					return 'success';
				}
			}
	}
	
	function insert_seller_review(){
		$rating = $this->input->post('rating');
		$user_id = $this->session->userdata['session_data']['user_id'];
		$seller_id = $this->input->post('seller_id');
		$query = $this->db->query("SELECT * FROM review_seller WHERE seller_id='$seller_id' AND user_id='$user_id'");
		$rows = $query->num_rows();
		if($rows > 0){
			return 'exists';
		}else{
			if($rating >= 4){
				$data = array(
					'user_id' => $user_id,
					'seller_id' => $seller_id,
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					'rating' => $this->input->post('rating'),
					'rating_type' => 'Best',
				);
			}else if($rating <= 2){
				$data = array(
					'user_id' => $user_id,
					'seller_id' => $seller_id,
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					'rating' => $this->input->post('rating'),
					'rating_type' => 'Bad'
				);
			}else{
				$data = array(
					'user_id' => $user_id,
					'seller_id' => $seller_id,
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					'rating' => $this->input->post('rating'),
					'rating_type' => 'Good'
				);
			}
			$this->db->insert('review_seller',$data);
			if($this->db->affected_rows() > 0){
				return 'success';
			}
		}
	}
	
	function retrieve_seller_review($user_id){
		$query = $this->db->query("SELECT a.*,b.business_name FROM review_seller a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE a.user_id='$user_id' AND a.status='Active' ORDER BY a.review_id DESC");
		return $query;
	}
	
	function retrieve_product_review($user_id){
		$query = $this->db->query("SELECT a.*,b.mrp,b.price,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt,c.name,c.short_desc,d.imag,e.fname,f.tax_rate_percentage FROM review_product a INNER JOIN product_master b ON a.sku_id=b.sku INNER JOIN product_general_info c ON a.product_id=c.product_id INNER JOIN product_image d ON a.product_id=d.product_id INNER JOIN user e ON a.user_id=e.user_id INNER JOIN tax_management f ON b.tax_class=f.tax_id WHERE a.user_id='$user_id' AND a.status='Active' ORDER BY a.review_id DESC");
		return $query;
	}
	
	function retrieve_new_product(){
		$query = $this->db->query("SELECT a.*,b.sku,b.price,b.special_price,b.quantity,b.stock_availability,b.special_pric_from_dt,b.special_pric_to_dt,b.mrp,c.*,e.tax_rate_percentage FROM product_general_info a 
		INNER JOIN product_master b ON a.product_id=b.product_id 
		INNER JOIN product_image c ON a.product_id=c.product_id 
		INNER JOIN product_setting d ON a.product_id=d.product_id 
		INNER JOIN tax_management e ON b.tax_class=e.tax_id INNER JOIN seller_account f on b.seller_id=f.seller_id WHERE d.status='Active' AND b.approve_status='Active' AND f.status='Active' AND b.seller_id
IN (
SELECT seller_id
FROM seller_account_information
) GROUP BY b.product_id ORDER BY d.product_id DESC LIMIT 5");

/*$query = $this->db->query("SELECT a.*,b.sku,b.price,b.special_price,b.quantity,b.stock_availability,b.special_pric_from_dt,b.special_pric_to_dt,b.mrp,c.*,e.tax_rate_percentage FROM product_general_info a 
		INNER JOIN product_master b ON a.product_id=b.product_id 
		INNER JOIN product_image c ON a.product_id=c.product_id 
		INNER JOIN product_setting d ON a.product_id=d.product_id 
		INNER JOIN tax_management e ON b.tax_class=e.tax_id INNER JOIN seller_account f on b.seller_id=f.seller_id WHERE d.status='Active' AND b.approve_status='Active' AND f.status='Active' GROUP BY b.product_id ORDER BY d.product_id DESC LIMIT 5");*/
		return $query;
	}
	
	function retrieve_product(){
		$query = $this->db->query("SELECT a.*,b.sku,b.mrp,b.price,b.quantity,b.stock_availability,b.special_price,b.product_id,b.sku,b.special_pric_from_dt,b.special_pric_to_dt,c.*,e.tax_rate_percentage FROM product_general_info a 
		INNER JOIN product_master b ON a.product_id=b.product_id 
		INNER JOIN product_image c ON a.product_id=c.product_id 
		INNER JOIN product_setting d ON a.product_id=d.product_id 
		INNER JOIN tax_management e ON b.tax_class=e.tax_id INNER JOIN seller_account f on b.seller_id=f.seller_id WHERE d.status='Active' AND b.approve_status='Active' AND f.status='Active' AND b.seller_id
IN (
SELECT seller_id
FROM seller_account_information
) ORDER BY RAND() LIMIT 5");
		return $query;
	}
	
	function retrieve_product_for_scroll1(){
		/*$query = $this->db->query("SELECT a.*,b.sku,b.price,b.special_price,c.* FROM product_general_info a 
		INNER JOIN product_master b ON a.product_id=b.product_id 
		INNER JOIN product_image c ON a.product_id=c.product_id 
		INNER JOIN product_setting d ON  a.product_id=d.product_id INNER JOIN seller_account e on e.seller_id=b.seller_id  WHERE d.status='Active' AND b.approve_status='Active' AND e.status='Active' ORDER BY d.product_id DESC LIMIT 5");*/
		$query = $this->db->query("SELECT a. * , b.sku, b.price, b.special_price, c. * 
FROM product_general_info a
INNER JOIN product_master b ON a.product_id = b.product_id
INNER JOIN product_image c ON a.product_id = c.product_id
INNER JOIN product_setting d ON a.product_id = d.product_id
INNER JOIN seller_account e ON e.seller_id = b.seller_id
WHERE d.status = 'Active'
AND b.approve_status = 'Active'
AND e.status = 'Active'
AND b.seller_id
IN (
SELECT seller_id
FROM seller_account_information
)
ORDER BY d.product_id DESC 
LIMIT 5");
		return $query;
	}
	
	function retrieve_product_for_scroll2(){
		$query = $this->db->query("SELECT a.*,b.sku,b.price,b.special_price,c.* FROM product_general_info a 
		INNER JOIN product_master b ON a.product_id=b.product_id 
		INNER JOIN product_image c ON a.product_id=c.product_id 
		INNER JOIN product_setting d ON  a.product_id=d.product_id INNER JOIN seller_account e on e.seller_id=b.seller_id  WHERE d.status='Active' AND b.approve_status='Active' AND e.status='Active' AND b.seller_id
IN (
SELECT seller_id
FROM seller_account_information
) ORDER BY b.product_id DESC LIMIT 5,10");
		return $query;
	}
	
	function retrive_user_data(){
		$user_id = $this->session->userdata['session_data']['user_id'];
		$query = $this->db->query("SELECT * FROM user WHERE user_id='$user_id'");
		return $query->result();
	}
	
	function insert_inn_wishlist(){
		$user_id = $this->session->userdata['session_data']['user_id'];
		$product_id = $this->input->post('product_id');
		$sku = $this->input->post('sku');
		$query = $this->db->query("SELECT * FROM wishlist WHERE user_id='$user_id' AND sku='$sku'");
		$row = $query->num_rows();
		if($row > 0){
			return false;
		}else{
			$data = array(
				'user_id' => $user_id,
				'product_id' => $product_id,
				'sku' => $sku
			);
			$this->db->insert('wishlist',$data);
			if($this->db->affected_rows()>0){
				return true;
			}
		}
	}
	
	function retrieve_wishlist_products(){
		$user_id = $this->session->userdata['session_data']['user_id'];
		$query = $this->db->query("SELECT a.*,b.mrp,b.price,b.sku,b.special_price,b.special_pric_from_dt,b.special_pric_to_dt,b.stock_availability,c.imag,e.wishlist_id,f.tax_rate_percentage FROM product_general_info a 
		INNER JOIN product_master b ON a.product_id=b.product_id 
		INNER JOIN product_image c ON a.product_id=c.product_id
		INNER JOIN product_setting d ON a.product_id=d.product_id
		INNER JOIN wishlist e ON e.sku=b.sku 
		INNER JOIN tax_management f ON b.tax_class=f.tax_id WHERE b.approve_status='Active' AND d.status='Active' AND e.user_id='$user_id'");
		return $query;
	}
	
	function delete_from_wishlist(){
		$wishlist_id = $this->input->post('id');
		$this->db->where('wishlist_id', $wishlist_id);
		$this->db->delete('wishlist');
		return true;
	}
	
	/*function retrieve_customer_order_details(){
		$user_id = $user_id = $this->session->userdata['session_data']['user_id'];
		$query = $this->db->query("SELECT a.order_id,a.sub_total_amount,a.quantity,b.name,b.description,b.short_desc,c.imag,d.business_name ,e.date_of_order,e.order_status,e.Total_amount FROM ordered_product_from_addtocart a 
		INNER JOIN product_general_info b ON a.product_id=b.product_id 
		INNER JOIN product_image c ON a.product_id=c.product_id 
		INNER JOIN seller_account_information d ON a.seller_id=d.seller_id 
		INNER JOIN order_info e ON a.order_id=e.order_id WHERE a.user_id='$user_id'");
		return $query;
	}*/
	
	function retrieve_customer_last3_mnth_order_id(){
		$user_id = $user_id = $this->session->userdata['session_data']['user_id'];
		$query = $this->db->query("SELECT a.order_id,COUNT(a.order_id) AS NO_OF_ITEM,a.seller_id,b.business_name ,c.id,c.date_of_order,c.order_status,c.Total_amount FROM ordered_product_from_addtocart a 		
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN order_info c ON a.order_id=c.order_id WHERE a.user_id='$user_id' AND c.is_transfer='no' AND c.date_of_order >= now()-interval 3 month GROUP BY a.order_id ORDER BY c.id DESC");
		return $query;
	}
	
	function retrieve_customer_past_order_id(){
		$user_id = $user_id = $this->session->userdata['session_data']['user_id'];
		$query = $this->db->query("SELECT a.order_id,COUNT(a.order_id) AS NO_OF_ITEM,a.seller_id,b.business_name ,c.id,c.date_of_order,c.order_status,c.Total_amount FROM ordered_product_from_addtocart a 		
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN order_info c ON a.order_id=c.order_id WHERE a.user_id='$user_id' AND c.is_transfer='no' AND c.date_of_order <= now()-interval 3 month GROUP BY a.order_id ORDER BY c.id DESC");
		return $query;
	}
	
	function cancel_order(){
		$id = $this->input->post('id');
		$cdate = date('Y-m-d H:i:s');
		$data = array(
			'order_status' => 'Cancelled',
			'order_status_modified_date' => $cdate
		);
		$this->db->where('id',$id);
		$this->db->update('order_info',$data);
		if($this->db->affected_rows() > 0){
			return true;
		}
	}
	
	function cancel_product(){
		$id = $this->input->post('id');
		$sku = $this->input->post('sku_id');
		$order_id = $this->input->post('order_id');
		$reason = $this->input->post('reason');
		$cdate = date('Y-m-d H:i:s');
		$data = array(
			'product_order_status' => 'Cancelled',			
		);
		
		$cancel_data = array(
			'order_id' => $order_id,
			'sku' => $sku,
			'reason' => $reason,
		);
		
		$this->db->where('id',$id);
		$this->db->update('ordered_product_from_addtocart',$data);
		if($this->db->affected_rows() > 0){
			$this->db->insert('cancel_product',$cancel_data);
			if($this->db->affected_rows() > 0){
				return true;
			}
		}
	}
	
	
	/*function retrive_indivisual_order_id_details($order_id){
		$query = $this->db->query("SELECT a.order_id,a.Total_amount,a.date_of_order,a.order_status,b.name,b.description,b.short_desc,c.imag,d.*,f.business_name,g.state,
		h.payment_type FROM order_info a INNER JOIN ordered_product_from_addtocart e ON a.order_id=e.order_id 
		INNER JOIN product_general_info b ON b.product_id=e.product_id 
		INNER JOIN product_image c ON b.product_id=c.product_id 
		INNER JOIN shipping_address d ON a.order_id=d.order_id 
		INNER JOIN seller_account_information f ON e.seller_id=f.seller_id 
		INNER JOIN state g ON d.state=g.state_id 
		INNER JOIN payment_info h ON a.payment_mode=h.payment_mode_id WHERE a.order_id='$order_id'");
		return $query->result();
	}*/
	
	
	function retrive_indivisual_order_id_details($order_id){
		$query = $this->db->query("SELECT a.order_id,a.Total_amount,a.date_of_order,a.order_status,a.invoice_id, a.order_id_payment_gateway,d.*,f.business_name,g.state,
		h.payment_type FROM order_info a INNER JOIN ordered_product_from_addtocart e ON a.order_id=e.order_id 				
		INNER JOIN shipping_address d ON a.order_id=d.order_id 
		INNER JOIN seller_account_information f ON e.seller_id=f.seller_id 
		INNER JOIN state g ON d.state=g.state_id 
		INNER JOIN payment_info h ON a.payment_mode=h.payment_mode_id WHERE a.order_id='$order_id'");
		return $query->result();
	}
	
	function retrive_indivisual_order_id_product_details($order_id){
		$query = $this->db->query("SELECT a.id,a.product_id,a.sku,a.sub_total_amount,a.quantity,a.product_order_status,a.prdt_color,a.prdt_size,b.name,b.description,b.short_desc,c.imag FROM ordered_product_from_addtocart a INNER JOIN product_general_info b ON a.product_id=b.product_id 
		INNER JOIN product_image c ON a.product_id=c.product_id 
		WHERE a.order_id='$order_id'");
		return $query->result();
	}
	
	function get_customer_referenceid($table, $field){
		$query = $this->db->query("SELECT MAX($field) AS `maxid` FROM ".$table);
		$maxId = $query->row()->maxid;
		$id = $maxId+1;
		return $id;
	}
	
	function insert_customer_support_data(){
		date_default_timezone_set('Asia/Calcutta');
		$dt =  date('Y-m-d H:i:s');
		$customer_reference_id = $this->get_customer_referenceid('customer_support', 'customer_reference_id');
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$mobile = $this->input->post('mobile');
		$subject = $this->input->post('title');
		$content = $this->input->post('content');
		$query = $this->db->query("INSERT INTO customer_support SET customer_reference_id='$customer_reference_id', name='$name',
		email='$email',subject='$subject',content='$content',mobile='$mobile',create_date='$dt'");
		if($query){
			return true;
		}else{
			return false;
		}
	}
	
	function insert_inn_return_product(){
		date_default_timezone_set('Asia/Calcutta');
		$date = date('Y-m-d H:i:s');
		$return_id = 'RN'.preg_replace("/[^0-9]+/","", $date);
		
		$product_return_id = $this->input->post('return_prdt_id');
		$return_type = $this->input->post('retn_typ');
		$reason = $this->input->post('reason');
		$coment = $this->input->post('comnt');
		$query = $this->db->query("SELECT * FROM ordered_product_from_addtocart WHERE id=$product_return_id");
		$result = $query->result();
		
		$return_data = array(
			'return_id' => $return_id,
			'order_id' => $result[0]->order_id,
			'sku' => $result[0]->sku,
			'quantity' => $result[0]->quantity,
			'tax_rate' => $result[0]->sub_tax_rate,
			'shipping_fee' => $result[0]->sub_shipping_fees,
			'total_amount' => $result[0]->sub_total_amount,
			'seller_id' => $result[0]->seller_id,
			'return_typ' => $return_type,
			'reason' => $reason,
			'comnt' => $coment,
			'cdate' => $date
		);
		
		$this->db->insert('return_product',$return_data);
		if($this->db->affected_rows() > 0){
			$data = array(
				'product_order_status' => 'Return Requested',
			);
			$this->db->where('id',$product_return_id);
			$this->db->update('ordered_product_from_addtocart',$data);
			if($this->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	/*$data = array(
				'order_status' => 'Return Requested',
			);
			$this->db->where('order_id',$result[0]->order_id);
			$this->db->update('order_info',$data);
			if($this->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}*/
			
			function insert_subscriber_detail($email,$gender)
	{
		//print_r($email);exit;
		$query = $this->db->query("select max(user_unique_id) as scb_unique from subscriber_detail");
		$qr=$query->row()->scb_unique;
		//print_r($qr);exit;
		$unique1d=$qr+1;
		date_default_timezone_set('Asia/Calcutta');
		$dt =  date('Y-m-d H:i:s');
		//$x="insert into subscriber_detail(user_unique_id,user_email_id,user_gender) values('$unique1d','$email','$gender')";echo $x;exit;
		//print_r($unique1d);exit;
		$insert_scb=$this->db->query("insert into subscriber_detail(user_unique_id,user_email_id,user_gender,user_reg_date) values('$unique1d','$email','$gender','$dt')");
		return $insert_scb;
	}
	
	function select_subscriber_detail($email,$gender)
	{
		$query = $this->db->query("select * from subscriber_detail where user_email_id='$email' and user_gender='$gender'");
		$scb_register=$query->num_rows();
		//print_r($scb_register);exit;
		if($scb_register>0)
		{
			return $query->result();
		}
		else{
			return false;
		}
	}
	
	function insert_user_mobile_otp($otp){
		date_default_timezone_set('Asia/Calcutta');
		$dt =  date('Y-m-d H:i:s');

		$user_otp_data = array(
			'user_email' => $this->input->post('email'),
			'user_otp' => $otp,
			'creat_time' => $dt,
		);
		$this->db->insert('user_mobile_change_otp', $user_otp_data);
		return true;
	}
	
	function retrive_mob_otp_details($otp){
		$query = $this->db->query("SELECT * FROM user_mobile_change_otp WHERE user_otp = '$otp' ORDER BY creat_time DESC LIMIT 1");
		return $query->result();
	}
	function getEmailbyIserID($user_id){
		$query = $this->db->query("SELECT * FROM user WHERE user_id = '$user_id'");
		return $query->result();
	}
	
}