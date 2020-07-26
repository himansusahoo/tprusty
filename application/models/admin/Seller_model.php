<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Seller_model extends CI_Model {

	

	function getSellers(){

		$query = $this->db->query("SELECT a.* , b.* 

		FROM seller_account a 

		INNER JOIN seller_account_information b ON a.seller_id = b.seller_id ORDER BY a.seller_id DESC");

		return $query->result();

	}

	

	function getSellersForAdminList($limit,$start){

		$query = $this->db->query("SELECT * FROM seller_account ORDER BY seller_id DESC LIMIT ".$start.", ".$limit."");

		return $query->result();

	}

	

	function getSellersForAdminListcount(){

		$query = $this->db->query("SELECT * FROM seller_account ORDER BY seller_id DESC");

		return $query->num_rows();

	} 







		function getSellerswisepnding_productcount(){

		//$query = $this->db->query("SELECT a.seller_id FROM seller_account a INNER JOIN seller_product_setting b ON a.seller_id=b.seller_id WHERE (b.product_approve='Pending' ) GROUP BY b.seller_id  ORDER BY a.seller_id DESC");

		

		

		

		 /*$sql = $this->db->query("SELECT seller_product_id FROM seller_product_setting WHERE product_approve='Pending' ");

		$res = $sql->result();

		

		$arr = array();

		foreach($res as $row)

		{ array_push($arr,$row->seller_product_id);}

		$str=implode(',',$arr);*/

		

		 $query = $this->db->query("SELECT i.* FROM seller_product_setting a 

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 	

		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id

		INNER JOIN seller_product_price_info j ON j.seller_product_id=a.seller_product_id

		INNER JOIN seller_product_inventory_info k ON k.seller_product_id=a.seller_product_id 

		INNER JOIN seller_account_information h ON a.seller_id=h.seller_id 

		INNER JOIN seller_account i ON h.seller_id=i.seller_id WHERE a.product_approve='Pending' AND (i.status='Active' OR i.status='Pending') group by a.seller_id ");

		

		

		

		return $query->num_rows();

	}

	

	function getSellerswise_productapprovedata($limit,$start){

		//$query = $this->db->query("SELECT * FROM seller_account ORDER BY seller_id DESC LIMIT ".$start.", ".$limit."");

		

		//$query = $this->db->query("SELECT a.* FROM seller_account a INNER JOIN seller_product_setting b ON a.seller_id=b.seller_id WHERE (b.product_approve='Pending' ) GROUP BY b.seller_id  ORDER BY a.seller_id DESC LIMIT ".$start.", ".$limit." ");

		

		

		/*$sql = $this->db->query("SELECT seller_product_id FROM seller_product_setting WHERE product_approve='Pending' ORDER BY date_added DESC LIMIT ".$start.", ".$limit." ");

		

		$res = $sql->result();

		

		$arr = array();

		foreach($res as $row)

		{ array_push($arr,$row->seller_product_id);}

		$str=implode(',',$arr);*/

		

		 $query = $this->db->query("SELECT i.* FROM seller_product_setting a 

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 	

		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id

		INNER JOIN seller_product_price_info j ON j.seller_product_id=a.seller_product_id

		INNER JOIN seller_product_inventory_info k ON k.seller_product_id=a.seller_product_id 

		INNER JOIN seller_account_information h ON a.seller_id=h.seller_id 

		INNER JOIN seller_account i ON h.seller_id=i.seller_id WHERE a.product_approve='Pending' AND (i.status='Active' OR i.status='Pending') group by a.seller_id LIMIT ".$start.", ".$limit.""); 

		

		

		

		return $query->result();

	}

	

	function changed_productprocess_statusstart()

	{

		$this->db->query("UPDATE product_process_status SET prod_approv='process' WHERE status_id='1' ");

	}

	

	function changed_productprocess_statusfinish()

	{

			$this->db->query("UPDATE product_process_status SET prod_approv='not process' WHERE status_id='1' ");	

		

	}  	

	

	/*function filter_sellers_data()

	{

		    $seller_from = $this->input->post('seller_id_from');



			$seller_to = $this->input->post('seller_id_to');			

			//print_r($seller_to);exit;			

			$name1 = $this->input->post('name1');

			//print_r($name1);exit;	

			$phone = $this->input->post('phone');

			//print_r($phone);exit;

			$reg_date_from = $this->input->post('reg_date_from');

			

			$reg_date_to = $this->input->post('reg_date_to');

			//print_r($reg_date_to);exit;

			$state = $this->input->post('state');	



			$city = $this->input->post('city');	

			

			$email = $this->input->post('email');

			$approval_from = $this->input->post('approval_from');

			$approval_to = $this->input->post('approval_to');

			$seller_status = $this->input->post('seller_status');

			//print_r($category_search_input);exit;

			

			$condition = '';

			if( $seller_from!='' && $seller_to!='' && $name1=='' && $phone=='' && $reg_date_from=='' && $reg_date_to=='' && $state=='' && $city=='' && $email=='' && $approval_from=='' && $approval_to=='' && $seller_status=='' ){

				    $condition .= "a.seller_id>='$seller_from' and a.seller_id<='$seller_to'" ;}

			if( $seller_from=='' && $seller_to=='' && $name1!='' && $phone=='' && $reg_date_from=='' && $reg_date_to=='' && $state=='' && $city=='' && $email=='' && $approval_from=='' && $approval_to=='' && $seller_status=='' ){

				    $condition .= "a.name='$name1'" ;}		

			

			if( $seller_from=='' && $seller_to=='' && $name1=='' && $phone!='' && $reg_date_from=='' && $reg_date_to=='' && $state=='' && $city=='' && $email=='' && $approval_from=='' && $approval_to=='' && $seller_status=='' ){

				    $condition .= "a.mobile='$phone'" ;}

			if( $seller_from=='' && $seller_to=='' && $name1=='' && $phone=='' && $reg_date_from!='' && $reg_date_to!='' && $state=='' && $city=='' && $email=='' && $approval_from=='' && $approval_to=='' && $seller_status=='' ){

				    $condition .= "a.register_date>='$reg_date_from' and a.register_date<='$reg_date_to'" ;}

			

			if( $seller_from=='' && $seller_to=='' && $name1=='' && $phone=='' && $reg_date_from=='' && $reg_date_to=='' && $state!='' && $city=='' && $email=='' && $approval_from=='' && $approval_to=='' && $seller_status=='' ){

				    $condition .= "b.state='$state'" ;}

					

			if( $seller_from=='' && $seller_to=='' && $name1=='' && $phone=='' && $reg_date_from=='' && $reg_date_to=='' && $state=='' && $city!='' && $email=='' && $approval_from=='' && $approval_to=='' && $seller_status=='' ){

				    $condition .= "b.city='$city'" ;}

			

			if( $seller_from=='' && $seller_to=='' && $name1=='' && $phone=='' && $reg_date_from=='' && $reg_date_to=='' && $state=='' && $city=='' && $email=='' && $approval_from!='' && $approval_to!='' && $seller_status=='' ){

				    $condition .= "a.approval_date>='$approval_from' and a.approval_date<='$approval_to'" ;}

				

			if( $seller_from=='' && $seller_to=='' && $name1=='' && $phone=='' && $reg_date_from=='' && $reg_date_to=='' && $state=='' && $city=='' && $email=='' && $approval_from=='' && $approval_to=='' && $seller_status!='' ){

				    $condition .= "a.status='$seller_status'" ;}

					if( $seller_from=='' && $seller_to=='' && $name1=='' && $phone=='' && $reg_date_from=='' && $reg_date_to=='' && $state=='' && $city=='' && $email!='' && $approval_from=='' && $approval_to=='' && $seller_status=='' ){

				    $condition .= "a.email='$email'" ;}	

										

			if( $seller_from=='' && $seller_to=='' && $name1=='' && $phone=='' && $reg_date_from=='' && $reg_date_to=='' && $state=='' && $city=='' && $email=='' && $approval_from=='' && $approval_to=='' && $seller_status=='' ){

			$query = $this->db->query("SELECT a.* , b.* 

		FROM seller_account a 

		INNER JOIN seller_account_information b ON a.seller_id = b.seller_id ORDER BY a.seller_id DESC");

		return $query->result();	

			}

		//echo $condition;exit; 

					

		$query = $this->db->query("SELECT a.* , b.* 

		FROM seller_account a 

		INNER JOIN seller_account_information b ON a.seller_id = b.seller_id where ".$condition." ORDER BY a.seller_id DESC");

		return $query->result();	

	}*/

	

	function filter_sellers_data($limit,$start)

	{

		    $seller_id11 = $_REQUEST['seller_id'];

			$seller_id=preg_replace("/[^0-9,.]/", "", $seller_id11);

			$name1 = $_REQUEST['name1'];

			$phone = $_REQUEST['phone'];

			$reg_date_from =$_REQUEST['regdate_from'];

			$reg_date_to = $_REQUEST['regdate_to'];

			$state = $_REQUEST['state'];	

			$city = $_REQUEST['city'];	

			$email = $_REQUEST['email'];

			$approval_from = $_REQUEST['approval_from'];

			$approval_to = $_REQUEST['approval_to'];

			$seller_status = $_REQUEST['seller_status'];

			

			$condition = '';

			if($seller_id != ""){

					$condition .= "a.seller_uid like '%$seller_id' or a.seller_uid like '%$seller_id%' or a.seller_uid like '$seller_id%'" ;

					$query = $this->db->query("SELECT a.* , b.* 

		FROM seller_account a 

		left join seller_account_information b ON a.seller_id = b.seller_id where ".$condition." ORDER BY a.seller_id DESC LIMIT ".$start.", ".$limit."");

		return $query->result();

				}

			

			if($name1 != ""){

					$condition .= "a.name  like '%$name1' or a.name  like '%$name1%' or a.name  like '$name1%' or b.business_name  like '%$name1' or b.business_name  like '%$name1%' or b.business_name  like '$name1%'" ;

					$query = $this->db->query("SELECT a.* , b.* 

		FROM seller_account a 

		left join seller_account_information b ON a.seller_id = b.seller_id where ".$condition." ORDER BY a.seller_id DESC LIMIT ".$start.", ".$limit."");

		return $query->result();

				}

				

			if($phone != ""){

					$condition .= "a.mobile='$phone' or b.pmobile='$phone'" ;

					$query = $this->db->query("SELECT a.* , b.* 

		FROM seller_account a 

		left join seller_account_information b ON a.seller_id = b.seller_id where ".$condition." ORDER BY a.seller_id DESC LIMIT ".$start.", ".$limit."");

		return $query->result();

				}

				

			if($reg_date_from != "" && $reg_date_to != ""){

					$condition .= "a.register_date>='$reg_date_from' and a.register_date<='$reg_date_to'" ;

					$query = $this->db->query("SELECT a.* , b.* 

		FROM seller_account a 

		left join seller_account_information b ON a.seller_id = b.seller_id where ".$condition." ORDER BY a.seller_id DESC LIMIT ".$start.", ".$limit."");

		return $query->result();

				}

				

			if($state != ""){

					$condition .= "b.state like '%$state' or b.state like '%$state%' or b.state like '$state%' or a.seller_state like '%$state' or a.seller_state like '%$state%' or a.seller_state like '$state%'" ;

					$query = $this->db->query("SELECT a.* , b.* 

		FROM seller_account a 

		left join seller_account_information b ON a.seller_id = b.seller_id where ".$condition." ORDER BY a.seller_id DESC LIMIT ".$start.", ".$limit."");

		return $query->result();

				}

				

			if($city != ""){

					$condition .= "b.city like '%$city' or b.city like '%$city%' or b.city like '$city%' or a.seller_city like '%$city' or a.seller_city like '%$city%' or a.seller_city like '$city%'" ;

					$query = $this->db->query("SELECT a.* , b.* 

		FROM seller_account a 

		left join seller_account_information b ON a.seller_id = b.seller_id where ".$condition." ORDER BY a.seller_id DESC LIMIT ".$start.", ".$limit."");

		return $query->result();

				}

				

			if($email != ""){

					$condition .= "a.email like '%$email' or a.email like '%$email%' or a.email like '$email%' or b.pemail like '%$email' or b.pemail like '%$email%' or b.pemail like '$email%'" ;

					$query = $this->db->query("SELECT a.* , b.* 

		FROM seller_account a 

		left join seller_account_information b ON a.seller_id = b.seller_id where ".$condition." ORDER BY a.seller_id DESC LIMIT ".$start.", ".$limit."");

		return $query->result();

				}

				

			if($approval_from != "" && $approval_to != ""){

					$condition .= "a.approval_date>='$approval_from' and a.approval_date<='$approval_to'" ;

					$query = $this->db->query("SELECT a.* , b.* 

		FROM seller_account a 

		left join seller_account_information b ON a.seller_id = b.seller_id where ".$condition." ORDER BY a.seller_id DESC LIMIT ".$start.", ".$limit."");

		return $query->result();

				}

				

			if($seller_status != ""){

					$condition .= "a.status='$seller_status'";

					$query = $this->db->query("SELECT a.* , b.* 

		FROM seller_account a 

		left join seller_account_information b ON a.seller_id = b.seller_id where ".$condition." ORDER BY a.seller_id DESC LIMIT ".$start.", ".$limit."");

		return $query->result();

				}

			

			

										

			if($condition=="" ){

			$query = $this->db->query("SELECT a.* , b.* 

		FROM seller_account a 

		left join seller_account_information b ON a.seller_id = b.seller_id ORDER BY a.seller_id DESC LIMIT ".$start.", ".$limit."");

		return $query->result();	

			}

		 

		/*echo $sql="SELECT a.* , b.* 

		FROM seller_account a 

		left join seller_account_information b ON a.seller_id = b.seller_id where ".$condition." ORDER BY a.seller_id DESC";exit;*/		

			

	}

	

	function filter_sellers_datacount()

	{

		     $seller_id11 = $_REQUEST['seller_id'];

			$seller_id=preg_replace("/[^0-9,.]/", "", $seller_id11);	

			$name1 = $_REQUEST['name1'];

			$phone = $_REQUEST['phone'];

			$reg_date_from =$_REQUEST['regdate_from'];

			$reg_date_to = $_REQUEST['regdate_to'];

			$state = $_REQUEST['state'];	

			$city = $_REQUEST['city'];	

			$email = $_REQUEST['email'];

			$approval_from = $_REQUEST['approval_from'];

			$approval_to = $_REQUEST['approval_to'];

			$seller_status = $_REQUEST['seller_status'];

			

			$condition = '';

			if($seller_id != ""){

					$condition .= "a.seller_uid like '%$seller_id' or a.seller_uid like '%$seller_id%' or a.seller_uid like '$seller_id%'" ;

					$query = $this->db->query("SELECT a.* , b.* 

		FROM seller_account a 

		left join seller_account_information b ON a.seller_id = b.seller_id where ".$condition." ORDER BY a.seller_id DESC");

		return $query->num_rows();

				}

			

			if($name1 != ""){

					$condition .= "a.name  like '%$name1' or a.name  like '%$name1%' or a.name  like '$name1%' or b.business_name  like '%$name1' or b.business_name  like '%$name1%' or b.business_name  like '$name1%'" ;

					$query = $this->db->query("SELECT a.* , b.* 

		FROM seller_account a 

		left join seller_account_information b ON a.seller_id = b.seller_id where ".$condition." ORDER BY a.seller_id DESC");

		return $query->num_rows();

				}

				

			if($phone != ""){

					$condition .= "a.mobile='$phone' or b.pmobile='$phone'" ;

					$query = $this->db->query("SELECT a.* , b.* 

		FROM seller_account a 

		left join seller_account_information b ON a.seller_id = b.seller_id where ".$condition." ORDER BY a.seller_id DESC");

		return $query->num_rows();

				}

				

			if($reg_date_from != "" && $reg_date_to != ""){

					$condition .= "a.register_date>='$reg_date_from' and a.register_date<='$reg_date_to'" ;

					$query = $this->db->query("SELECT a.* , b.* 

		FROM seller_account a 

		left join seller_account_information b ON a.seller_id = b.seller_id where ".$condition." ORDER BY a.seller_id DESC");

		return $query->num_rows();

				}

				

			if($state != ""){

					$condition .= "b.state like '%$state' or b.state like '%$state%' or b.state like '$state%' or a.seller_state like '%$state' or a.seller_state like '%$state%' or a.seller_state like '$state%'" ;

					$query = $this->db->query("SELECT a.* , b.* 

		FROM seller_account a 

		left join seller_account_information b ON a.seller_id = b.seller_id where ".$condition." ORDER BY a.seller_id DESC");

		return $query->num_rows();

				}

				

			if($city != ""){

					$condition .= "b.city like '%$city' or b.city like '%$city%' or b.city like '$city%' or a.seller_city like '%$city' or a.seller_city like '%$city%' or a.seller_city like '$city%'" ;

					$query = $this->db->query("SELECT a.* , b.* 

		FROM seller_account a 

		left join seller_account_information b ON a.seller_id = b.seller_id where ".$condition." ORDER BY a.seller_id DESC");

		return $query->num_rows();

				}

				

			if($email != ""){

					$condition .= "a.email like '%$email' or a.email like '%$email%' or a.email like '$email%' or b.pemail like '%$email' or b.pemail like '%$email%' or b.pemail like '$email%'" ;

					$query = $this->db->query("SELECT a.* , b.* 

		FROM seller_account a 

		left join seller_account_information b ON a.seller_id = b.seller_id where ".$condition." ORDER BY a.seller_id DESC");

		return $query->num_rows();

				}

				

			if($approval_from != "" && $approval_to != ""){

					$condition .= "a.approval_date>='$approval_from' and a.approval_date<='$approval_to'" ;

					$query = $this->db->query("SELECT a.* , b.* 

		FROM seller_account a 

		left join seller_account_information b ON a.seller_id = b.seller_id where ".$condition." ORDER BY a.seller_id DESC");

		return $query->num_rows();

				}

				

			if($seller_status != ""){

					$condition .= "a.status='$seller_status'";

					$query = $this->db->query("SELECT a.* , b.* 

		FROM seller_account a 

		left join seller_account_information b ON a.seller_id = b.seller_id where ".$condition." ORDER BY a.seller_id DESC");

		return $query->num_rows();

				}

			

			

										

			if($condition=="" ){

			$query = $this->db->query("SELECT a.* , b.* 

		FROM seller_account a 

		left join seller_account_information b ON a.seller_id = b.seller_id ORDER BY a.seller_id DESC");

		return $query->num_rows();	

			}

		 

		/*echo $sql="SELECT a.* , b.* 

		FROM seller_account a 

		left join seller_account_information b ON a.seller_id = b.seller_id where ".$condition." ORDER BY a.seller_id DESC";exit;*/		

			 

	}

	function update_sellers_status($seller_id, $status){

		

		$dt =  date('Y-m-d H:i:s');

		$query = $this->db->query("UPDATE seller_account SET status='$status', approval_date='$dt' WHERE seller_id='$seller_id'");

		if($query){

			return true;

		}else{

			return false;

		}

	}

	

	function getSearchedSellers($cate_search_title){

		/*echo $h = "SELECT a.*, b.*

		FROM seller_account a

		INNER JOIN seller_account_information b ON a.seller_id = b.seller_id

		WHERE a.main_selleing_category LIKE '$cate_search_title%' OR a.main_selleing_category LIKE '%$cate_search_title%' OR a.main_selleing_category LIKE '%$cate_search_title'

		ORDER BY a.seller_id DESC"; exit;*/

		$query = $this->db->query("SELECT a.*, b.*

		FROM seller_account a

		INNER JOIN seller_account_information b ON a.seller_id = b.seller_id

		WHERE a.main_selleing_category LIKE '$cate_search_title%' OR a.main_selleing_category LIKE '%$cate_search_title%' OR a.main_selleing_category LIKE '%$cate_search_title'

		ORDER BY a.seller_id DESC");

		$row = $query->num_rows();

		if($row > 0){

			return $query->result();

		}

		else{

			return false;

		}

	}

	

	function retrive_seller_product_data(){

		$query = $this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,f.*,g.*,h.name AS seller_name FROM seller_product_setting a 

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 

		INNER JOIN seller_product_price_info c ON a.seller_product_id=c.seller_product_id 

		INNER JOIN seller_product_meta_info d ON a.seller_product_id=d.seller_product_id 

		INNER JOIN seller_product_inventory_info e ON a.seller_product_id=e.seller_product_id 

		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id 

		INNER JOIN seller_product_category g ON a.seller_product_id=g.seller_product_id 

		INNER JOIN seller_account h ON a.seller_id=h.seller_id AND h.status='Active' WHERE a.product_approve='Pending' ORDER BY a.seller_product_id DESC");

		return $query;

	}

	

	function retrive_seller_product_data_4_approvecount(){

		$query = $this->db->query("SELECT a.seller_product_id

		FROM seller_product_setting a

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id			

		INNER JOIN seller_account_information h ON a.seller_id = h.seller_id

		INNER JOIN seller_account i ON h.seller_id = i.seller_id		

		WHERE a.product_approve =  'Pending' AND (i.status='Active' OR i.status='Pending') group by b.sku,a.seller_product_id ORDER BY a.date_added DESC");

		

		//$sql = $this->db->query("SELECT seller_product_id FROM seller_product_setting WHERE product_approve='Pending' ORDER BY date_added DESC ");

//		$res = $sql->result_array();

//		

//		$arr = array();

//		foreach($res as $row)

//		{ array_push($arr,$row['seller_product_id']);}

//		$str=implode(',',$arr);

//		

//		 $query = $this->db->query("SELECT count(a.seller_product_id) as tot_pendingproduct FROM seller_product_setting a 

//		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 		

//		INNER JOIN seller_account_information h ON a.seller_id=h.seller_id 

//		INNER JOIN seller_account i ON h.seller_id=i.seller_id WHERE a.seller_product_id IN ($str) AND (i.status='Active' OR i.status='Pending') group by a.seller_product_id"); 

		

		//return $tot_pendingproduct=$query->row()->tot_pendingproduct;

		

		return $query->num_rows();

	}

	

	

	function retrive_seller_product_data_4_approve($limit,$start){

		 $sql = $this->db->query("SELECT seller_product_id FROM seller_product_setting WHERE product_approve='Pending' ORDER BY date_added DESC LIMIT ".$start.", ".$limit."");

		 if($sql->num_rows()>0)

		 {

					$res = $sql->result();

				

				$arr = array();

				foreach($res as $row)

				{ array_push($arr,$row->seller_product_id);}

				$str=implode(',',$arr);

				

				 $query = $this->db->query("SELECT a.seller_product_id,a.master_product_id,a.seller_id,a.date_added,a.product_approve,b.name,b.sku,f.image,h.business_name AS seller_name,i.status,j.mrp,j.price,k.quantity FROM seller_product_setting a 

				INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 	

				INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id

				INNER JOIN seller_product_price_info j ON j.seller_product_id=a.seller_product_id

				INNER JOIN seller_product_inventory_info k ON k.seller_product_id=a.seller_product_id 

				INNER JOIN seller_account_information h ON a.seller_id=h.seller_id 

				INNER JOIN seller_account i ON h.seller_id=i.seller_id WHERE a.seller_product_id IN ($str) AND (i.status='Active' OR i.status='Pending') group by a.seller_product_id"); 

				

				

				//$query = $this->db->query("SELECT a.seller_product_id,a.master_product_id,a.seller_id,a.date_added,a.product_approve,b.name,b.sku,f.image,h.business_name AS seller_name FROM seller_product_setting a 

		//		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 	

		//		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id 

		//		INNER JOIN seller_account_information h ON a.seller_id=h.seller_id 

		//		INNER JOIN seller_account i ON h.seller_id=i.seller_id AND i.status='Active' WHERE a.product_approve='Pending' ORDER BY a.seller_product_id DESC LIMIT ".$start.", ".$limit."");



		return $query;

		 }

		 else

		 {return $sql;}

	}

	

	

	function filter_seller_product_datacount()

	{

			

			//@$from_dt = $_REQUEST['from_dt'];

//			@$to_dt = $_REQUEST['to_dt'];

			$from_dt ='';

			$to_dt = '';

			$fltr_product_nm = $_REQUEST['fltr_product_nm'];

			$fltr_slr_nm = $_REQUEST['fltr_slr_nm'];		

			$product_sts  = $_REQUEST['product_sts'];

			

			//$product_sts  ='';

			$fltr_product_sku=	$_REQUEST['fltr_product_sku'];

			$seller_sts=$_REQUEST['seller_sts'];

			$prod_mrp=$_REQUEST['prod_mrp'];

			$prod_saleprice=$_REQUEST['prod_saleprice'];

			$prod_qnt=$_REQUEST['prod_qnt'];

			$catg_id=$_REQUEST['catg_id'];

			

			$condition = '';

			

			if( $from_dt!='' && $to_dt!='' && $fltr_product_nm=='' && $fltr_slr_nm=='' && $product_sts=='' ){

				    $condition .= "a.date_added>='$from_dt' and a.date_added<='$to_dt'" ;

				

				

				$query = $this->db->query(" SELECT count(a.seller_product_id) as tot_pendingproduct  FROM seller_product_setting a 

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 	

		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id 

		INNER JOIN seller_account_information h ON a.seller_id=h.seller_id 

		INNER JOIN seller_account i ON h.seller_id=i.seller_id  where ".$condition." AND (i.status='Active' OR i.status='Pending')ORDER BY a.seller_product_id DESC");

		

		return $tot_pendingproduct=$query->row()->tot_pendingproduct;

		

		//$query =$this->db->query("SELECT a.seller_product_id

//		FROM seller_product_setting a			

//		INNER JOIN seller_account_information h ON a.seller_id = h.seller_id

//		INNER JOIN seller_account i ON h.seller_id = i.seller_id

//		AND i.status =  'Active'

//		WHERE ".$condition."  

//		ORDER BY a.seller_product_id DESC");

		

		

		//return $query->num_rows();	

					

					}

			

			if( $from_dt=='' && $to_dt=='' && $fltr_product_nm!='' && $fltr_slr_nm=='' && $product_sts=='' ){

				    $condition .= "b.name LIKE '$fltr_product_nm%'";

					

				

				

				$query = $this->db->query(" SELECT count(a.seller_product_id) as tot_pendingproduct  FROM seller_product_setting a 

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 	

		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id 

		INNER JOIN seller_account_information h ON a.seller_id=h.seller_id 

		INNER JOIN seller_account i ON h.seller_id=i.seller_id  where ".$condition." AND (i.status='Active' OR i.status='Pending') ORDER BY a.seller_product_id DESC");

		

		return $tot_pendingproduct=$query->row()->tot_pendingproduct;

					

		

			//$query =$this->db->query("SELECT a.seller_product_id

//		FROM seller_product_setting a INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id		

//		INNER JOIN seller_account_information h ON a.seller_id = h.seller_id

//		INNER JOIN seller_account i ON h.seller_id = i.seller_id

//		AND i.status =  'Active'

//		WHERE ".$condition."  

//		ORDER BY a.seller_product_id DESC");

		

		//return $query->num_rows();

					}	

			

			if( $from_dt=='' && $to_dt=='' && $fltr_product_nm=='' && $fltr_slr_nm!='' && $product_sts=='' ){

				    $condition .= "h.business_name LIKE '$fltr_slr_nm%'";

					

					

	$query = $this->db->query(" SELECT count(a.seller_product_id) as tot_pendingproduct  FROM seller_product_setting a 

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 	

		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id 

		INNER JOIN seller_account_information h ON a.seller_id=h.seller_id 

		INNER JOIN seller_account i ON h.seller_id=i.seller_id  where ".$condition." AND (i.status='Active' OR i.status='Pending') ORDER BY a.seller_product_id DESC");

		

		return $tot_pendingproduct=$query->row()->tot_pendingproduct;

		

		//$query =$this->db->query("SELECT a.seller_product_id

//		FROM seller_product_setting a			

//		INNER JOIN seller_account_information h ON a.seller_id = h.seller_id

//		INNER JOIN seller_account i ON h.seller_id = i.seller_id

//		AND i.status =  'Active'

//		WHERE ".$condition." 

//		ORDER BY a.seller_product_id DESC");

//		return $query->num_rows();

					}

					

			if( $from_dt=='' && $to_dt=='' && $fltr_product_nm=='' && $fltr_slr_nm=='' && $product_sts!='' ){

				    $condition .= "a.product_approve='$product_sts'";

					

		

		

		$query = $this->db->query(" SELECT count(a.seller_product_id) as tot_pendingproduct  FROM seller_product_setting a 

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 	

		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id 

		INNER JOIN seller_account_information h ON a.seller_id=h.seller_id 

		INNER JOIN seller_account i ON h.seller_id=i.seller_id  where ".$condition." AND (i.status='Active' OR i.status='Pending') ORDER BY a.seller_product_id DESC");

		

		return $tot_pendingproduct=$query->row()->tot_pendingproduct;

		

		//$query =$this->db->query("SELECT a.seller_product_id

//		FROM seller_product_setting a			

//		INNER JOIN seller_account_information h ON a.seller_id = h.seller_id

//		INNER JOIN seller_account i ON h.seller_id = i.seller_id

//		AND i.status =  'Active'

//		WHERE ".$condition."  

//		ORDER BY a.seller_product_id DESC");

//		return $query->num_rows();

				

				}	

		if( $fltr_product_sku!=''  ){

				    $condition .= "b.sku='$fltr_product_sku'";				

		

		

		$query = $this->db->query(" SELECT count(a.seller_product_id) as tot_pendingproduct  FROM seller_product_setting a 

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 	

		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id 

		INNER JOIN seller_account_information h ON a.seller_id=h.seller_id 

		INNER JOIN seller_account i ON h.seller_id=i.seller_id  where ".$condition." AND (i.status='Active' OR i.status='Pending') ORDER BY a.seller_product_id DESC");

		

		return $tot_pendingproduct=$query->row()->tot_pendingproduct;

		

		//$query =$this->db->query("SELECT a.seller_product_id

//		FROM seller_product_setting a

//		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id			

//		INNER JOIN seller_account_information h ON a.seller_id = h.seller_id

//		INNER JOIN seller_account i ON h.seller_id = i.seller_id

//		AND i.status =  'Active'

//		WHERE ".$condition."  

//		ORDER BY a.seller_product_id DESC");

//		return $query->num_rows();

				

				}

				

		if( $seller_sts!=''  ){

				    $condition .= "i.status='$seller_sts'";				

		

		

		$query = $this->db->query(" SELECT count(a.seller_product_id) as tot_pendingproduct  FROM seller_product_setting a 

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 	

		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id 

		INNER JOIN seller_account_information h ON a.seller_id=h.seller_id 

		INNER JOIN seller_account i ON h.seller_id=i.seller_id  where ".$condition." AND (i.status='Active' OR i.status='Pending') ORDER BY a.seller_product_id DESC");

		

		return $tot_pendingproduct=$query->row()->tot_pendingproduct;

		

		//$query =$this->db->query("SELECT a.seller_product_id

//		FROM seller_product_setting a

//		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id			

//		INNER JOIN seller_account_information h ON a.seller_id = h.seller_id

//		INNER JOIN seller_account i ON h.seller_id = i.seller_id

//		AND i.status =  'Active'

//		WHERE ".$condition."  

//		ORDER BY a.seller_product_id DESC");

//		return $query->num_rows();

				

				}

				

			if( $prod_mrp!=''  ){

			$condition .= "c.mrp='$prod_mrp'";				

		

		

		

		$query =$this->db->query("SELECT a.seller_product_id

		FROM seller_product_setting a

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id	

		INNER JOIN seller_product_price_info c ON c.seller_product_id=a.seller_product_id		

		INNER JOIN seller_account_information h ON a.seller_id = h.seller_id

		INNER JOIN seller_account i ON h.seller_id = i.seller_id

		

		WHERE ".$condition."  AND (i.status='Active' OR i.status='Pending')

		ORDER BY a.seller_product_id DESC");

		return $query->num_rows();

				

				}

				

		if( $prod_saleprice!=''  ){

		$condition .= "c.price='$prod_saleprice'";				

		

				

		$query =$this->db->query("SELECT a.seller_product_id

		FROM seller_product_setting a

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id	

		INNER JOIN seller_product_price_info c ON c.seller_product_id=a.seller_product_id		

		INNER JOIN seller_account_information h ON a.seller_id = h.seller_id

		INNER JOIN seller_account i ON h.seller_id = i.seller_id		

		WHERE ".$condition." AND (i.status='Active' OR i.status='Pending') 

		ORDER BY a.seller_product_id DESC");

		return $query->num_rows();

				

				}

				

		if($prod_qnt!=''  ){

		$condition .= "c.quantity='$prod_qnt'";				

		

				

		$query =$this->db->query("SELECT a.seller_product_id

		FROM seller_product_setting a

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id	

		INNER JOIN seller_product_inventory_info c ON c.seller_product_id=a.seller_product_id		

		INNER JOIN seller_account_information h ON a.seller_id = h.seller_id

		INNER JOIN seller_account i ON h.seller_id = i.seller_id		

		WHERE ".$condition." AND (i.status='Active' OR i.status='Pending')  

		ORDER BY a.seller_product_id DESC");

		return $query->num_rows();

				

				}

		if($catg_id!=''){

		$condition .= "c.category='$catg_id'";				

		

				

		$query =$this->db->query("SELECT a.seller_product_id

		FROM seller_product_setting a

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id	

		INNER JOIN seller_product_category c ON c.seller_product_id=a.seller_product_id		

		INNER JOIN seller_account_information h ON a.seller_id = h.seller_id

		INNER JOIN seller_account i ON h.seller_id = i.seller_id		

		WHERE ".$condition." AND (i.status='Active' OR i.status='Pending')  

		ORDER BY a.seller_product_id DESC");

		return $query->num_rows();

				

				}				

					

			

		$query = $this->db->query(" SELECT count(a.seller_product_id) as tot_pendingproduct  FROM seller_product_setting a 

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 	

		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id 

		INNER JOIN seller_account_information h ON a.seller_id=h.seller_id 

		INNER JOIN seller_account i ON h.seller_id=i.seller_id  where (i.status='Active' OR i.status='Pending') ORDER BY a.seller_product_id DESC");

		

		return $tot_pendingproduct=$query->row()->tot_pendingproduct;

		

		//$query =$this->db->query("SELECT a.seller_product_id

//		FROM seller_product_setting a			

//		INNER JOIN seller_account_information h ON a.seller_id = h.seller_id

//		INNER JOIN seller_account i ON h.seller_id = i.seller_id

//		AND i.status =  'Active'

//		WHERE a.product_approve =  'Pending'

//		ORDER BY a.seller_product_id DESC");

		

		//return $query->num_rows();	

	

	}

	

	

	function filter_seller_product_data($limit,$start)

	{

		 

			

			//$from_dt = $_REQUEST['from_dt'];

			$from_dt ='';

			//@$to_dt = $_REQUEST['to_dt'];

			

			$to_dt = '';

			$fltr_product_nm = $_REQUEST['fltr_product_nm'];

			$fltr_slr_nm = $_REQUEST['fltr_slr_nm'];		

			$product_sts  = $_REQUEST['product_sts'];

			

			//$product_sts  = '';

			$fltr_product_sku=	$_REQUEST['fltr_product_sku'];

			$seller_sts=$_REQUEST['seller_sts'];

			$prod_mrp=$_REQUEST['prod_mrp'];

			$prod_saleprice=$_REQUEST['prod_saleprice'];

			$prod_qnt=$_REQUEST['prod_qnt'];

			$catg_id=$_REQUEST['catg_id'];

			

			$condition = '';

			

			if( $fltr_product_sku!=''  ){

				    $condition .= "b.sku LIKE '$fltr_product_sku%'";

				$sql = $this->db->query("SELECT a.seller_product_id FROM seller_product_setting a INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id WHERE ".$condition."  ORDER BY a.seller_product_id DESC LIMIT ".$start.", ".$limit."");

		$res = $sql->result_array();

		

		$arr = array();

		foreach($res as $row)

		{ array_push($arr,$row['seller_product_id']);}

		$str=implode(',',$arr);

					

		

		$query = $this->db->query("SELECT a.seller_product_id,a.master_product_id,a.seller_id,a.date_added,a.product_approve,b.name,b.sku,f.image,h.business_name AS seller_name,i.status,j.mrp,j.price,k.quantity FROM seller_product_setting a 

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 	

		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id 

		INNER JOIN seller_product_price_info j ON j.seller_product_id=a.seller_product_id

		INNER JOIN seller_product_inventory_info k ON k.seller_product_id=a.seller_product_id

		INNER JOIN seller_account_information h ON a.seller_id=h.seller_id 

		INNER JOIN seller_account i ON h.seller_id=i.seller_id WHERE a.seller_product_id IN ($str) AND (i.status='Active' OR i.status='Pending')   group by a.seller_product_id ORDER BY a.seller_product_id DESC");

		return $query;	

					

					

			}

			if( $seller_sts!=''  ){

				    $condition .= "b.status='$seller_sts'";

				$sql = $this->db->query("SELECT a.seller_product_id FROM seller_product_setting a INNER JOIN seller_account b ON a.seller_id=b.seller_id WHERE ".$condition."  ORDER BY a.seller_product_id DESC LIMIT ".$start.", ".$limit."");

		$res = $sql->result_array();

		

		$arr = array();

		foreach($res as $row)

		{ array_push($arr,$row['seller_product_id']);}

		$str=implode(',',$arr);

					

		

		$query = $this->db->query("SELECT a.seller_product_id,a.master_product_id,a.seller_id,a.date_added,a.product_approve,b.name,b.sku,f.image,h.business_name AS seller_name,i.status,j.mrp,j.price,k.quantity FROM seller_product_setting a 

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 	

		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id 

		INNER JOIN seller_product_price_info j ON j.seller_product_id=a.seller_product_id

		INNER JOIN seller_product_inventory_info k ON k.seller_product_id=a.seller_product_id

		INNER JOIN seller_account_information h ON a.seller_id=h.seller_id 

		INNER JOIN seller_account i ON h.seller_id=i.seller_id WHERE a.seller_product_id IN ($str) AND (i.status='Active' OR i.status='Pending')  group by a.seller_product_id ORDER BY a.seller_product_id DESC");

		return $query;	

					

					

			}

			

			

			if( $prod_mrp!=''  ){

				 $condition .= "j.mrp='$prod_mrp'";

				$sql = $this->db->query("SELECT a.seller_product_id FROM seller_product_setting a INNER JOIN seller_product_price_info j ON j.seller_product_id=a.seller_product_id WHERE ".$condition."  ORDER BY a.seller_product_id DESC LIMIT ".$start.", ".$limit."");

		$res = $sql->result_array();

		

		$arr = array();

		foreach($res as $row)

		{ array_push($arr,$row['seller_product_id']);}

		$str=implode(',',$arr);

					

		

		$query = $this->db->query("SELECT a.seller_product_id,a.master_product_id,a.seller_id,a.date_added,a.product_approve,b.name,b.sku,f.image,h.business_name AS seller_name,i.status,j.mrp,j.price,k.quantity FROM seller_product_setting a 

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 	

		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id 

		INNER JOIN seller_product_price_info j ON j.seller_product_id=a.seller_product_id

		INNER JOIN seller_product_inventory_info k ON k.seller_product_id=a.seller_product_id

		INNER JOIN seller_account_information h ON a.seller_id=h.seller_id 

		INNER JOIN seller_account i ON h.seller_id=i.seller_id WHERE a.seller_product_id IN ($str) AND (i.status='Active' OR i.status='Pending')  group by a.seller_product_id ORDER BY a.seller_product_id DESC");

		return $query;	

					

					

			}

			

			if( $prod_saleprice!=''  ){

				 $condition .= "j.price='$prod_saleprice'";

				$sql = $this->db->query("SELECT a.seller_product_id FROM seller_product_setting a INNER JOIN seller_product_price_info j ON j.seller_product_id=a.seller_product_id WHERE ".$condition."  ORDER BY a.seller_product_id DESC LIMIT ".$start.", ".$limit."");

		$res = $sql->result_array();

		

		$arr = array();

		foreach($res as $row)

		{ array_push($arr,$row['seller_product_id']);}

		$str=implode(',',$arr);

					

		

		$query = $this->db->query("SELECT a.seller_product_id,a.master_product_id,a.seller_id,a.date_added,a.product_approve,b.name,b.sku,f.image,h.business_name AS seller_name,i.status,j.mrp,j.price,k.quantity FROM seller_product_setting a 

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 	

		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id 

		INNER JOIN seller_product_price_info j ON j.seller_product_id=a.seller_product_id

		INNER JOIN seller_product_inventory_info k ON k.seller_product_id=a.seller_product_id

		INNER JOIN seller_account_information h ON a.seller_id=h.seller_id 

		INNER JOIN seller_account i ON h.seller_id=i.seller_id WHERE a.seller_product_id IN ($str) AND (i.status='Active' OR i.status='Pending')  group by a.seller_product_id ORDER BY a.seller_product_id DESC");

		return $query;	

					

					

			}

			

		if( $prod_qnt!=''  ){

				 $condition .= "k.quantity='$prod_qnt'";

				$sql = $this->db->query("SELECT a.seller_product_id FROM seller_product_setting a INNER JOIN seller_product_inventory_info k ON k.seller_product_id=a.seller_product_id WHERE ".$condition."  ORDER BY a.seller_product_id DESC LIMIT ".$start.", ".$limit."");

		$res = $sql->result_array();

		

		$arr = array();

		foreach($res as $row)

		{ array_push($arr,$row['seller_product_id']);}

		$str=implode(',',$arr);

					

		

		$query = $this->db->query("SELECT a.seller_product_id,a.master_product_id,a.seller_id,a.date_added,a.product_approve,b.name,b.sku,f.image,h.business_name AS seller_name,i.status,j.mrp,j.price,k.quantity FROM seller_product_setting a 

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 	

		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id 

		INNER JOIN seller_product_price_info j ON j.seller_product_id=a.seller_product_id

		INNER JOIN seller_product_inventory_info k ON k.seller_product_id=a.seller_product_id

		INNER JOIN seller_account_information h ON a.seller_id=h.seller_id 

		INNER JOIN seller_account i ON h.seller_id=i.seller_id WHERE a.seller_product_id IN ($str) AND (i.status='Active' OR i.status='Pending')  group by a.seller_product_id ORDER BY a.seller_product_id DESC");

		return $query;	

					

					

			}

			

			

			

			if($catg_id!=''  ){

				 $condition .= "l.category='$catg_id'";

				$sql = $this->db->query("SELECT a.seller_product_id FROM seller_product_setting a INNER JOIN seller_product_category l ON l.seller_product_id=a.seller_product_id WHERE ".$condition."  ORDER BY a.seller_product_id DESC LIMIT ".$start.", ".$limit."");

		$res = $sql->result_array();

		

		$arr = array();

		foreach($res as $row)

		{ array_push($arr,$row['seller_product_id']);}

		$str=implode(',',$arr);

					

		

		$query = $this->db->query("SELECT a.seller_product_id,a.master_product_id,a.seller_id,a.date_added,a.product_approve,b.name,b.sku,f.image,h.business_name AS seller_name,i.status,j.mrp,j.price,k.quantity FROM seller_product_setting a 

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 	

		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id 

		INNER JOIN seller_product_price_info j ON j.seller_product_id=a.seller_product_id

		INNER JOIN seller_product_inventory_info k ON k.seller_product_id=a.seller_product_id		

		INNER JOIN seller_account_information h ON a.seller_id=h.seller_id 

		INNER JOIN seller_account i ON h.seller_id=i.seller_id WHERE a.seller_product_id IN ($str) AND (i.status='Active' OR i.status='Pending')  group by a.seller_product_id ORDER BY a.seller_product_id DESC");

		return $query;	

					

					

			}

			

			if( $from_dt!='' && $to_dt!='' && $fltr_product_nm=='' && $fltr_slr_nm=='' && $product_sts=='' ){

				    $condition .= "a.date_added>='$from_dt' and a.date_added<='$to_dt'" ;

					

					$sql = $this->db->query("SELECT a.seller_product_id FROM seller_product_setting a WHERE ".$condition."  ORDER BY a.seller_product_id DESC LIMIT ".$start.", ".$limit."");

		$res = $sql->result_array();

		

		$arr = array();

		foreach($res as $row)

		{ array_push($arr,$row['seller_product_id']);}

		$str=implode(',',$arr);

					

					

					//$query = $this->db->query("SELECT a.seller_product_id,a.master_product_id,a.seller_id,a.date_added,a.product_approve,b.name,b.sku,f.image,h.business_name AS 		         seller_name FROM seller_product_setting a 

//		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 	

//		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id 

//		INNER JOIN seller_account_information h ON a.seller_id=h.seller_id 

//		INNER JOIN seller_account i ON h.seller_id=i.seller_id AND i.status='Active' where ".$condition." ORDER BY a.seller_product_id DESC LIMIT ".$start.", ".$limit."");

		

		$query = $this->db->query("SELECT a.seller_product_id,a.master_product_id,a.seller_id,a.date_added,a.product_approve,b.name,b.sku,f.image,h.business_name AS seller_name,i.status,j.mrp,j.price,k.quantity FROM seller_product_setting a 

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 	

		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id 

		INNER JOIN seller_product_price_info j ON j.seller_product_id=a.seller_product_id

		INNER JOIN seller_product_inventory_info k ON k.seller_product_id=a.seller_product_id

		INNER JOIN seller_account_information h ON a.seller_id=h.seller_id 

		INNER JOIN seller_account i ON h.seller_id=i.seller_id WHERE a.seller_product_id IN ($str) AND (i.status='Active' OR i.status='Pending')  group by a.seller_product_id ORDER BY a.seller_product_id DESC");

		return $query;					

					

					}

			

			if( $from_dt=='' && $to_dt=='' && $fltr_product_nm!='' && $fltr_slr_nm=='' && $product_sts=='' ){

				    $condition .= "b.name LIKE '$fltr_product_nm%'";

					

					

					$sql = $this->db->query("SELECT a.seller_product_id FROM seller_product_setting a INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id WHERE ".$condition."  ORDER BY a.seller_product_id DESC LIMIT ".$start.", ".$limit."");

		$res = $sql->result();

		

		$arr = array();

		foreach($res as $row)

		{ array_push($arr,$row->seller_product_id);}

		$str=implode(',',$arr);

					

				

		

		

		$query = $this->db->query("SELECT a.seller_product_id,a.master_product_id,a.seller_id,a.date_added,a.product_approve,b.name,b.sku,f.image,h.business_name AS seller_name,i.status,j.mrp,j.price,k.quantity FROM seller_product_setting a 

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 	

		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id 

		INNER JOIN seller_product_price_info j ON j.seller_product_id=a.seller_product_id

		INNER JOIN seller_product_inventory_info k ON k.seller_product_id=a.seller_product_id

		INNER JOIN seller_account_information h ON a.seller_id=h.seller_id 

		INNER JOIN seller_account i ON h.seller_id=i.seller_id WHERE a.seller_product_id IN ($str) AND (i.status='Active' OR i.status='Pending')  group by a.seller_product_id ORDER BY a.seller_product_id DESC");

		return $query;		

					

					}	

			

			if( $from_dt=='' && $to_dt=='' && $fltr_product_nm=='' && $fltr_slr_nm!='' && $product_sts=='' ){

				    $condition .= "h.business_name LIKE '$fltr_slr_nm%'";

					

					

					$sql = $this->db->query("SELECT a.seller_product_id FROM seller_product_setting a INNER JOIN seller_account_information h ON a.seller_id=h.seller_id  WHERE ".$condition."  ORDER BY a.seller_product_id DESC LIMIT ".$start.", ".$limit."");

		$res = $sql->result();

		

		$arr = array();

		foreach($res as $row)

		{ array_push($arr,$row->seller_product_id);}

		$str=implode(',',$arr);

					

			

		$query = $this->db->query("SELECT a.seller_product_id,a.master_product_id,a.seller_id,a.date_added,a.product_approve,b.name,b.sku,f.image,h.business_name AS seller_name,i.status,j.mrp,j.price,k.quantity FROM seller_product_setting a 

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 	

		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id 

		INNER JOIN seller_product_price_info j ON j.seller_product_id=a.seller_product_id

		INNER JOIN seller_product_inventory_info k ON k.seller_product_id=a.seller_product_id

		INNER JOIN seller_account_information h ON a.seller_id=h.seller_id 

		INNER JOIN seller_account i ON h.seller_id=i.seller_id WHERE a.seller_product_id IN ($str) AND (i.status='Active' OR i.status='Pending')  group by a.seller_product_id ORDER BY a.seller_product_id DESC");

		return $query;		

					

					}

					

			if( $from_dt=='' && $to_dt=='' && $fltr_product_nm=='' && $fltr_slr_nm=='' && $product_sts!='' ){

				    $condition .= "a.product_approve='$product_sts'";

					

					

					$sql = $this->db->query("SELECT a.seller_product_id FROM seller_product_setting a WHERE ".$condition."  ORDER BY a.seller_product_id DESC LIMIT ".$start.", ".$limit."");

		$res = $sql->result();

		

		$arr = array();

		foreach($res as $row)

		{ array_push($arr,$row->seller_product_id);}

		$str=implode(',',$arr);

					

		

		

		$query = $this->db->query("SELECT a.seller_product_id,a.master_product_id,a.seller_id,a.date_added,a.product_approve,b.name,b.sku,f.image,h.business_name AS seller_name,i.status,j.mrp,j.price,k.quantity FROM seller_product_setting a 

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 	

		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id 

		INNER JOIN seller_product_price_info j ON j.seller_product_id=a.seller_product_id

		INNER JOIN seller_product_inventory_info k ON k.seller_product_id=a.seller_product_id

		INNER JOIN seller_account_information h ON a.seller_id=h.seller_id 

		INNER JOIN seller_account i ON h.seller_id=i.seller_id WHERE a.seller_product_id IN ($str) AND (i.status='Active' OR i.status='Pending')  group by a.seller_product_id ORDER BY a.seller_product_id DESC");

		return $query;		

					

					}

					

			else{		$sql = $this->db->query("SELECT seller_product_id FROM seller_product_setting WHERE product_approve='Pending' ORDER BY seller_product_id DESC LIMIT ".$start.", ".$limit."");

		$res = $sql->result();

		

		$arr = array();

		foreach($res as $row)

		{ array_push($arr,$row->seller_product_id);}

		$str=implode(',',$arr);

			

		$query = $this->db->query("SELECT a.seller_product_id,a.master_product_id,a.seller_id,a.date_added,a.product_approve,b.name,b.sku,f.image,h.business_name AS seller_name,i.status,j.mrp,j.price,k.quantity FROM seller_product_setting a 

		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 	

		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id 

		INNER JOIN seller_product_price_info j ON j.seller_product_id=a.seller_product_id

		INNER JOIN seller_product_inventory_info k ON k.seller_product_id=a.seller_product_id

		INNER JOIN seller_account_information h ON a.seller_id=h.seller_id 

		INNER JOIN seller_account i ON h.seller_id=i.seller_id WHERE a.seller_product_id IN ($str) AND (i.status='Active' OR i.status='Pending')  group by a.seller_product_id ORDER BY a.seller_product_id DESC");

		return $query;	

			}

	

			

	}

	

	function retrieve_categorysearch()

		{		

			$catg_name = $this->input->post('catg_nm');

			$qr=$this->db->query("

			SELECT DISTINCT lvl2, lvl2_name, lvl1, lvl1_name , lvlmain_name

			FROM  temp_category 

			WHERE lvl1 !=0 AND lvl2_name LIKE '%$catg_name%' ");

			

			return $qr->result_array();	

		}

	
function retrive_seller_product_exiting_datacount(){
		$query = $this->db->query("SELECT DISTINCT h.lvlmain_name,h.lvl1_name,h.lvl2_name,a.*,b.*,c.*,d.*,f.*,g.name AS seller_name,s.business_name FROM product_setting a 
		INNER JOIN product_general_info b ON a.product_id=b.product_id 
		INNER JOIN product_image c ON a.product_id=c.product_id 
		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		INNER JOIN cornjob_productsearch h ON a.product_id=h.product_id
		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		INNER JOIN seller_account g ON f.seller_id=g.seller_id 
		INNER JOIN seller_account_information s ON s.seller_id=g.seller_id
		WHERE a.status='Active' AND (g.status='Active' OR g.status='Pending')  AND f.approve_status='Pending' ORDER BY f.seller_exist_product_id DESC");
		return $query->num_rows();
	}
	
	
	
	function retrive_seller_product_exiting_data($limit,$start){
		$query = $this->db->query("
		SELECT DISTINCT h.lvlmain_name,h.lvl1_name,h.lvl2_name,a.*,b.*,c.*,d.*,f.*,g.name AS seller_name,s.business_name FROM product_setting a 
		INNER JOIN product_general_info b ON a.product_id=b.product_id 
		INNER JOIN product_image c ON a.product_id=c.product_id 
		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		INNER JOIN cornjob_productsearch h ON a.product_id=h.product_id
		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		INNER JOIN seller_account g ON f.seller_id=g.seller_id 
		INNER JOIN seller_account_information s ON s.seller_id=g.seller_id
		WHERE a.status='Active' AND (g.status='Active' OR g.status='Pending')  AND f.approve_status='Pending' ORDER BY f.seller_exist_product_id DESC LIMIT ".$start." , ".$limit."");
		return $query;
	}

	




function filter_seller_product_exiting_datacount(){
			
			
			
			$fltr_product_sku = $_REQUEST['fltr_product_sku'];
			$fltr_product_nm = $_REQUEST['fltr_product_nm'];
			$prod_cate = $_REQUEST['prod_cate'];
			$fltr_slr_nm = $_REQUEST['fltr_slr_nm'];
			$mrp = $_REQUEST['mrp'];
			$sell_prices = $_REQUEST['sell_prices'];
			$quantity = $_REQUEST['quantity'];
			$product_sts = $_REQUEST['product_sts'];
			/*$fltr_product_sku = $this->input->post('fltr_product_sku');
		   $from_dt = $this->input->post('from_dt1');
		   // print_r($shipment);exit;
			
			$to_dt = $this->input->post('to_dt1');			
			//print_r($to_dt);exit;		
			$fltr_product_nm = $this->input->post('fltr_product_nm1');
			$prod_cate = $this->input->post('prod_cate');
			$fltr_slr_nm = $this->input->post('fltr_slr_nm1');
			//print_r($fltr_product_nm);exit;
			$mrp = $this->input->post('mrp');
			$sell_prices = $this->input->post('sell_prices');
			$quantity = $this->input->post('quantity');
			$product_sts = $this->input->post('product_sts');*/
				
				$condition = "";
				
				
				
				
				
				/*if($from_dt!='' && $to_dt!=''){
				$condition .= "f.current_date>='$from_dt' and f.current_date<='$to_dt'" ;
		
		$query = $this->db->query("SELECT DISTINCT h.lvlmain_name,h.lvl1_name,h.lvl2_name,a.*,b.*,c.*,d.*,f.*,g.name AS seller_name,s.business_name FROM product_setting a 
		INNER JOIN product_general_info b ON a.product_id=b.product_id 
		INNER JOIN product_image c ON a.product_id=c.product_id 
		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		INNER JOIN cornjob_productsearch h ON a.product_id=h.product_id
		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		INNER JOIN seller_account g ON f.seller_id=g.seller_id 
		INNER JOIN seller_account_information s ON s.seller_id=g.seller_id
		WHERE a.status='Active' AND ".$condition." AND (g.status='Active' OR g.status='Pending')  AND f.approve_status='Pending' ORDER BY f.seller_exist_product_id DESC ");
						return $query->num_rows();
					}*/
					
					
				if($fltr_product_sku != ""){
				$condition .= "f.sku LIKE '%$fltr_product_sku%'" ;
				$query = $this->db->query("SELECT a.product_id FROM product_setting a 

		INNER JOIN product_general_info b ON a.product_id=b.product_id 

		INNER JOIN product_image c ON a.product_id=c.product_id 

		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		
		INNER JOIN cornjob_productsearch h ON a.product_id=h.product_id

		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		
		INNER JOIN seller_account g ON f.seller_id=g.seller_id

		INNER JOIN seller_account_information s ON s.seller_id=g.seller_id
		
		WHERE a.status='Active' AND g.status='Active' AND ".$condition." GROUP BY a.product_id ORDER BY f.seller_exist_product_id DESC " );
						return $query->num_rows();
					}
					
					
				if($fltr_product_nm != "" ){
					 	$condition .= "b.name LIKE '%$fltr_product_nm%'";
						$query = $this->db->query("SELECT a.product_id FROM product_setting a 

		INNER JOIN product_general_info b ON a.product_id=b.product_id 

		INNER JOIN product_image c ON a.product_id=c.product_id 

		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		
		INNER JOIN cornjob_productsearch h ON a.product_id=h.product_id

		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		
		INNER JOIN seller_account g ON f.seller_id=g.seller_id

		INNER JOIN seller_account_information s ON s.seller_id=g.seller_id
		
		WHERE a.status='Active' AND g.status='Active' AND ".$condition." GROUP BY a.product_id ORDER BY f.seller_exist_product_id DESC ");
					 
							return $query->num_rows();
					}
					
					
					if($prod_cate != ""){
				$condition .= "h.lvl2_name LIKE '%$prod_cate%'" ;
				$query = $this->db->query("SELECT a.product_id FROM product_setting a 

		INNER JOIN product_general_info b ON a.product_id=b.product_id 

		INNER JOIN product_image c ON a.product_id=c.product_id 

		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		
		INNER JOIN cornjob_productsearch h ON a.product_id=h.product_id

		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		
		INNER JOIN seller_account g ON f.seller_id=g.seller_id

		INNER JOIN seller_account_information s ON s.seller_id=g.seller_id
		
		WHERE a.status='Active' AND g.status='Active' AND ".$condition." GROUP BY a.product_id ORDER BY f.seller_exist_product_id DESC " );
						return $query->num_rows();
					}
				if($fltr_slr_nm != "" ){
					 	$condition .= "s.business_name = '$fltr_slr_nm'";
						$query = $this->db->query("SELECT a.product_id FROM product_setting a 

		INNER JOIN product_general_info b ON a.product_id=b.product_id 

		INNER JOIN product_image c ON a.product_id=c.product_id 

		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		
		INNER JOIN cornjob_productsearch h ON a.product_id=h.product_id

		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		
		INNER JOIN seller_account g ON f.seller_id=g.seller_id

		INNER JOIN seller_account_information s ON s.seller_id=g.seller_id
		
		WHERE a.status='Active' AND g.status='Active' AND ".$condition." GROUP BY a.product_id ORDER BY f.seller_exist_product_id DESC ");
						return $query->num_rows();
					}
				if($mrp !='' ){
				  		$condition .= "f.mrp='$mrp'";
						$query = $this->db->query("SELECT a.product_id FROM product_setting a 

		INNER JOIN product_general_info b ON a.product_id=b.product_id 

		INNER JOIN product_image c ON a.product_id=c.product_id 

		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		
		INNER JOIN cornjob_productsearch h ON a.product_id=h.product_id

		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		
		INNER JOIN seller_account g ON f.seller_id=g.seller_id

		INNER JOIN seller_account_information s ON s.seller_id=g.seller_id
		
		WHERE a.status='Active' AND g.status='Active' AND ".$condition." GROUP BY a.product_id ORDER BY f.seller_exist_product_id DESC ");
						return $query->num_rows();
					}
					if($sell_prices !='' ){
				  		$condition .= "f.price='$sell_prices'";
						$query = $this->db->query("SELECT a.product_id FROM product_setting a 

		INNER JOIN product_general_info b ON a.product_id=b.product_id 

		INNER JOIN product_image c ON a.product_id=c.product_id 

		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		
		INNER JOIN cornjob_productsearch h ON a.product_id=h.product_id

		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		
		INNER JOIN seller_account g ON f.seller_id=g.seller_id

		INNER JOIN seller_account_information s ON s.seller_id=g.seller_id
		
		WHERE a.status='Active' AND g.status='Active' AND ".$condition." GROUP BY a.product_id ORDER BY f.seller_exist_product_id DESC ");
						return $query->num_rows();
					}
					if($quantity !='' ){
				  		$condition .= "f.quantity='$quantity'";
						$query = $this->db->query("SELECT a.product_id FROM product_setting a 

		INNER JOIN product_general_info b ON a.product_id=b.product_id 

		INNER JOIN product_image c ON a.product_id=c.product_id 

		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		
		INNER JOIN cornjob_productsearch h ON a.product_id=h.product_id

		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		
		INNER JOIN seller_account g ON f.seller_id=g.seller_id

		INNER JOIN seller_account_information s ON s.seller_id=g.seller_id
		
		WHERE a.status='Active' AND g.status='Active' AND ".$condition." GROUP BY a.product_id ORDER BY f.seller_exist_product_id DESC ");
						return $query->num_rows();
					}
					
					
					if($product_sts !='' ){
				  		$condition .= "f.approve_status='$product_sts'";
						$query = $this->db->query("SELECT a.product_id FROM product_setting a 

		INNER JOIN product_general_info b ON a.product_id=b.product_id 

		INNER JOIN product_image c ON a.product_id=c.product_id 

		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		
		INNER JOIN cornjob_productsearch h ON a.product_id=h.product_id

		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		
		INNER JOIN seller_account g ON f.seller_id=g.seller_id

		INNER JOIN seller_account_information s ON s.seller_id=g.seller_id
		
		WHERE a.status='Active' AND g.status='Active' AND ".$condition." GROUP BY a.product_id ORDER BY f.seller_exist_product_id DESC ");
						return $query->num_rows();
					}
					
					
				if($condition == ""){
					$query = $this->db->query("SELECT a.product_id FROM product_setting a 
		INNER JOIN product_general_info b ON a.product_id=b.product_id 
		INNER JOIN product_image c ON a.product_id=c.product_id 
		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		INNER JOIN cornjob_productsearch h ON a.product_id=h.product_id
		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		INNER JOIN seller_account g ON f.seller_id=g.seller_id
		INNER JOIN seller_account_information s ON s.seller_id=g.seller_id
		WHERE a.status='Active' AND (g.status='Active' OR g.status='Pending')  AND f.approve_status='Pending' ORDER BY f.seller_exist_product_id DESC ");
					return $query->num_rows();
					}
				}
				
				
				
				
				
				
	function filter_seller_existing_product($limit,$start){
		$fltr_product_sku = $_REQUEST['fltr_product_sku'];
			$fltr_product_nm = $_REQUEST['fltr_product_nm'];
			$prod_cate = $_REQUEST['prod_cate'];
			$fltr_slr_nm = $_REQUEST['fltr_slr_nm'];
			$mrp = $_REQUEST['mrp'];
			$sell_prices = $_REQUEST['sell_prices'];
			$quantity = $_REQUEST['quantity'];
			$product_sts = $_REQUEST['product_sts'];
			

			/*$fltr_product_sku = $this->input->post('fltr_product_sku');
		   //$from_dt = $this->input->post('from_dt1');
		   // print_r($shipment);exit;
			
			//$to_dt = $this->input->post('to_dt1');			
			//print_r($to_dt);exit;		
			$fltr_product_nm = $this->input->post('fltr_product_nm');
			$prod_cate = $this->input->post('prod_cate');
			$fltr_slr_nm = $this->input->post('fltr_slr_nm');
			//print_r($fltr_product_nm);exit;
			$mrp = $this->input->post('mrp');
			$sell_prices = $this->input->post('sell_prices');
			$quantity = $this->input->post('quantity');
			$product_sts = $this->input->post('product_sts');*/
				
				$condition = "";
				
				
				
				
				
				/*if($from_dt!='' && $to_dt!=''){
				$condition .= "f.current_date>='$from_dt' and f.current_date<='$to_dt'" ;
		
		$query = $this->db->query("SELECT DISTINCT h.lvlmain_name,h.lvl1_name,h.lvl2_name,a.*,b.*,c.*,d.*,f.*,g.name AS seller_name,s.business_name FROM product_setting a 
		INNER JOIN product_general_info b ON a.product_id=b.product_id 
		INNER JOIN product_image c ON a.product_id=c.product_id 
		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		INNER JOIN cornjob_productsearch h ON a.product_id=h.product_id
		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id
		INNER JOIN seller_account g ON f.seller_id=g.seller_id 
		INNER JOIN seller_account_information s ON s.seller_id=g.seller_id
		WHERE a.status='Active' AND ".$condition." AND (g.status='Active' OR g.status='Pending')  AND f.approve_status='Pending' ORDER BY f.seller_exist_product_id DESC LIMIT ".$start." , ".$limit."");
						return $query;
					}*/
					
					
				if($fltr_product_sku != ""){
				$condition .= "f.sku LIKE '%$fltr_product_sku%'" ;
				$query = $this->db->query("
				
				
				SELECT DISTINCT h.lvlmain_name,h.lvl1_name,h.lvl2_name,a.*,b.*,c.*,d.*,f.*,g.name AS seller_name,s.business_name FROM product_setting a 

		INNER JOIN product_general_info b ON a.product_id=b.product_id 

		INNER JOIN product_image c ON a.product_id=c.product_id 

		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		
		INNER JOIN cornjob_productsearch h ON a.product_id=h.product_id

		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		
		INNER JOIN seller_account g ON f.seller_id=g.seller_id

		INNER JOIN seller_account_information s ON s.seller_id=g.seller_id
		
		WHERE a.status='Active' AND g.status='Active' AND ".$condition." GROUP BY a.product_id ORDER BY f.seller_exist_product_id DESC LIMIT ".$start." , ".$limit."" );
				
				
				
				
				
				
				/*SELECT DISTINCT h.lvlmain_name,h.lvl1_name,h.lvl2_name,a.*,b.*,c.*,d.*,f.*,g.name AS seller_name,s.business_name FROM product_setting a 
				
		INNER JOIN product_general_info b ON a.product_id=b.product_id 
		
		INNER JOIN product_image c ON a.product_id=c.product_id 
		
		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		
		INNER JOIN cornjob_productsearch h ON a.product_id=h.product_id
		
		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id
		 
		INNER JOIN seller_account g ON f.seller_id=g.seller_id
		
		INNER JOIN seller_account_information s ON s.seller_id=g.seller_id
		
		WHERE a.status='Active' AND ".$condition." AND (g.status='Active' OR g.status='Pending')  AND f.approve_status='Pending' ORDER BY f.seller_exist_product_id DESC LIMIT ".$start." , ".$limit."" );*/
						return $query;
					}
					
					
				if($fltr_product_nm != "" ){
					 	$condition .= "b.name LIKE '%$fltr_product_nm%'";
						$query = $this->db->query("SELECT DISTINCT h.lvlmain_name,h.lvl1_name,h.lvl2_name,a.*,b.*,c.*,d.*,f.*,g.name AS seller_name,s.business_name FROM product_setting a 

		INNER JOIN product_general_info b ON a.product_id=b.product_id 

		INNER JOIN product_image c ON a.product_id=c.product_id 

		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		
		INNER JOIN cornjob_productsearch h ON a.product_id=h.product_id

		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		
		INNER JOIN seller_account g ON f.seller_id=g.seller_id

		INNER JOIN seller_account_information s ON s.seller_id=g.seller_id
		
		WHERE a.status='Active' AND g.status='Active' AND ".$condition." GROUP BY a.product_id ORDER BY f.seller_exist_product_id DESC LIMIT ".$start." , ".$limit."");
					 
							return $query;
					}
					
					
					if($prod_cate != ""){
				$condition .= "h.lvl2_name LIKE '%$prod_cate%'" ;
				$query = $this->db->query("SELECT DISTINCT h.lvlmain_name,h.lvl1_name,h.lvl2_name,a.*,b.*,c.*,d.*,f.*,g.name AS seller_name,s.business_name FROM product_setting a 

		INNER JOIN product_general_info b ON a.product_id=b.product_id 

		INNER JOIN product_image c ON a.product_id=c.product_id 

		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		
		INNER JOIN cornjob_productsearch h ON a.product_id=h.product_id

		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		
		INNER JOIN seller_account g ON f.seller_id=g.seller_id

		INNER JOIN seller_account_information s ON s.seller_id=g.seller_id
		
		WHERE a.status='Active' AND g.status='Active' AND ".$condition." GROUP BY a.product_id ORDER BY f.seller_exist_product_id DESC LIMIT ".$start." , ".$limit."" );
						return $query;
					}
				if($fltr_slr_nm != "" ){
					 	$condition .= "s.business_name LIKE '%$fltr_slr_nm%'";
						$query = $this->db->query("SELECT DISTINCT h.lvlmain_name,h.lvl1_name,h.lvl2_name,a.*,b.*,c.*,d.*,f.*,g.name AS seller_name,s.business_name FROM product_setting a 

		INNER JOIN product_general_info b ON a.product_id=b.product_id 

		INNER JOIN product_image c ON a.product_id=c.product_id 

		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		
		INNER JOIN cornjob_productsearch h ON a.product_id=h.product_id

		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		
		INNER JOIN seller_account g ON f.seller_id=g.seller_id

		INNER JOIN seller_account_information s ON s.seller_id=g.seller_id
		
		WHERE a.status='Active' AND g.status='Active' AND ".$condition." GROUP BY a.product_id ORDER BY f.seller_exist_product_id DESC LIMIT ".$start." , ".$limit."");
						return $query;
					}
				
					if($mrp !='' ){
				  		$condition .= "f.mrp='$mrp'";
						$query = $this->db->query("SELECT DISTINCT h.lvlmain_name,h.lvl1_name,h.lvl2_name,a.*,b.*,c.*,d.*,f.*,g.name AS seller_name,s.business_name FROM product_setting a 

		INNER JOIN product_general_info b ON a.product_id=b.product_id 

		INNER JOIN product_image c ON a.product_id=c.product_id 

		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		
		INNER JOIN cornjob_productsearch h ON a.product_id=h.product_id

		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		
		INNER JOIN seller_account g ON f.seller_id=g.seller_id

		INNER JOIN seller_account_information s ON s.seller_id=g.seller_id
		
		WHERE a.status='Active' AND g.status='Active' AND ".$condition." GROUP BY a.product_id ORDER BY f.seller_exist_product_id DESC LIMIT ".$start." , ".$limit."");
						return $query;
					}
					if($sell_prices !='' ){
				  		$condition .= "f.price='$sell_prices'";
						$query = $this->db->query("SELECT DISTINCT h.lvlmain_name,h.lvl1_name,h.lvl2_name,a.*,b.*,c.*,d.*,f.*,g.name AS seller_name,s.business_name FROM product_setting a 

		INNER JOIN product_general_info b ON a.product_id=b.product_id 

		INNER JOIN product_image c ON a.product_id=c.product_id 

		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		
		INNER JOIN cornjob_productsearch h ON a.product_id=h.product_id

		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		
		INNER JOIN seller_account g ON f.seller_id=g.seller_id

		INNER JOIN seller_account_information s ON s.seller_id=g.seller_id
		
		WHERE a.status='Active' AND g.status='Active' AND ".$condition." GROUP BY a.product_id ORDER BY f.seller_exist_product_id DESC LIMIT ".$start." , ".$limit."");
						return $query;
					}
					if($quantity !='' ){
				  		$condition .= "f.quantity='$quantity'";
						$query = $this->db->query("SELECT DISTINCT h.lvlmain_name,h.lvl1_name,h.lvl2_name,a.*,b.*,c.*,d.*,f.*,g.name AS seller_name,s.business_name FROM product_setting a 

		INNER JOIN product_general_info b ON a.product_id=b.product_id 

		INNER JOIN product_image c ON a.product_id=c.product_id 

		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		
		INNER JOIN cornjob_productsearch h ON a.product_id=h.product_id

		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		
		INNER JOIN seller_account g ON f.seller_id=g.seller_id

		INNER JOIN seller_account_information s ON s.seller_id=g.seller_id
		
		WHERE a.status='Active' AND g.status='Active' AND ".$condition." GROUP BY a.product_id ORDER BY f.seller_exist_product_id DESC LIMIT ".$start." , ".$limit."");
						return $query;
					}
					
					if($product_sts !='' ){
				  		$condition .= "f.approve_status='$product_sts'";
						$query = $this->db->query("SELECT DISTINCT h.lvlmain_name,h.lvl1_name,h.lvl2_name,a.*,b.*,c.*,d.*,f.*,g.name AS seller_name,s.business_name FROM product_setting a 

		INNER JOIN product_general_info b ON a.product_id=b.product_id 

		INNER JOIN product_image c ON a.product_id=c.product_id 

		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		
		INNER JOIN cornjob_productsearch h ON a.product_id=h.product_id

		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		
		INNER JOIN seller_account g ON f.seller_id=g.seller_id

		INNER JOIN seller_account_information s ON s.seller_id=g.seller_id
		
		WHERE a.status='Active' AND g.status='Active' AND ".$condition." GROUP BY a.product_id ORDER BY f.seller_exist_product_id DESC LIMIT ".$start." , ".$limit."");
						return $query;
					}
				if($condition == ""){
					$query = $this->db->query("SELECT DISTINCT h.lvlmain_name,h.lvl1_name,h.lvl2_name,a.*,b.*,c.*,d.*,f.*,g.name AS seller_name,s.business_name FROM product_setting a 
		INNER JOIN product_general_info b ON a.product_id=b.product_id 
		INNER JOIN product_image c ON a.product_id=c.product_id 
		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		INNER JOIN cornjob_productsearch h ON a.product_id=h.product_id
		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		INNER JOIN seller_account g ON f.seller_id=g.seller_id 
		INNER JOIN seller_account_information s ON s.seller_id=g.seller_id
		WHERE a.status='Active' AND (g.status='Active' OR g.status='Pending')  AND f.approve_status='Pending' ORDER BY f.seller_exist_product_id DESC LIMIT ".$start." , ".$limit."");
					return $query;
					}
				}

	
function search_existseller_name(){
		$slr_name = $this->input->post('fltr_slr_nm');
		$query = $this->db->query("SELECT business_name FROM seller_account_information WHERE business_name LIKE '$slr_name%' ORDER BY business_name");
		return $query;
	}
	/*function search_existprod_name(){
		$prod_name = $this->input->post('fltr_product_nm');
		$query = $this->db->query("SELECT b.name FROM product_setting a 
		INNER JOIN product_general_info b ON a.product_id=b.product_id 
		WHERE b.name LIKE '%$prod_name%'  GROUP BY b.name ");
		return $query;
	}*/
	function search_existprod_name(){
		$prod_name = $this->input->post('fltr_product_nm');
		$query = $this->db->query("SELECT b.name FROM product_setting a 
		INNER JOIN product_general_info b ON a.product_id=b.product_id 
		INNER JOIN product_image c ON a.product_id=c.product_id 
		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		INNER JOIN cornjob_productsearch h ON a.product_id=h.product_id
		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		INNER JOIN seller_account g ON f.seller_id=g.seller_id 
		INNER JOIN seller_account_information s ON s.seller_id=g.seller_id
		WHERE a.status='Active' AND b.name LIKE '%$prod_name%' AND (g.status='Active' OR g.status='Pending')  AND f.approve_status='Pending' GROUP BY b.name ");
		return $query;
	}
	function existcategorysearch()
		{		
			$cate_name = $this->input->post('cate_name');
			$qr=$this->db->query("
			SELECT DISTINCT lvl2, lvl2_name, lvl1, lvl1_name , lvlmain_name
			FROM  temp_category 
			WHERE lvl1 !=0 AND lvl2_name LIKE '%$cate_name%' ");
			
			return $qr->result_array();	
		}
	//==================================== check product approve process status start================================//

	

	function productapprove_precessstatus($loged_username)

	{

		if($loged_username==ADMIN_MAIL)

		{

			$qr=$this->db->query("SELECT * FROM user_role_previleges WHERE uname='Adminstrator' ");

			return $process_status=$qr->row()->product_approve;	

		}

		else

		{

			$qr=$this->db->query("SELECT * FROM user_role_previleges WHERE uname='$loged_username' ");

			return $process_status=$qr->row()->product_approve;		

		}

	}

	

	function productapprove_start_precessstatus($loged_username)

	{

		if($loged_username==ADMIN_MAIL)

		{

			$this->db->query("UPDATE user_role_previleges SET product_approve='process' WHERE uname='Adminstrator' ");

		}

		else

		{

			$this->db->query("UPDATE user_role_previleges SET product_approve='process' WHERE uname='$loged_username' ");	

		}

	}

	

	function productapprove_finish_precessstatus($loged_username)

	{

		if($loged_username==ADMIN_MAIL)

		{

			$this->db->query("UPDATE user_role_previleges SET product_approve='not process' WHERE uname='Adminstrator' ");

		}

		else

		{

			$this->db->query("UPDATE user_role_previleges SET product_approve='not process' WHERE uname='$loged_username' ");	

		}

	}

	//==================================== check product approve process status end================================//

	

//===============================================Product Approval Start=========================================================================//	

	function changed_seller_product_status(){

		

		//$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');

		$ids = implode(',',$this->input->post('id'));

		$status = $this->input->post('status');



		if($status == 'Active'){

			$query2 = $this->db->query("SELECT master_product_id FROM seller_product_setting WHERE seller_product_id IN ($ids)");

			$result2 = $query2->result();

			//print_r($result2);exit;

			foreach($result2 as $val){

				//echo $val->master_product_id.'<br/>';

				$master_product_id[] = $val->master_product_id;		

			}

			//print_r($master_product_id);exit;

			$master_product_id_length = count($master_product_id);



			for($j=0; $j<$master_product_id_length; $j++){

				if($master_product_id[$j] == 0){

				

				//$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');

				

					///////start retrieve seller_product_id whose master_product_id is 0 ////////////

					$query4 = $this->db->query("SELECT seller_product_id FROM seller_product_setting WHERE seller_product_id IN ($ids) AND master_product_id=0");

					$result4 = $query4->result();

					foreach($result4 as $val1){

						$slr_prdt_id[] = $val1->seller_product_id;

					}

					$slr_prdt_ids = implode(',',$slr_prdt_id);

					///////end retrieve seller_product_id whose master_product_id is 0 ////////////

					

					/////retrieve selected seller's product data and insert into admin product tables script start here//////

					$query = $this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,f.*,g.* FROM seller_product_setting a 

					INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 

					INNER JOIN seller_product_price_info c ON a.seller_product_id=c.seller_product_id 

					INNER JOIN seller_product_meta_info d ON a.seller_product_id=d.seller_product_id 

					INNER JOIN seller_product_inventory_info e ON a.seller_product_id=e.seller_product_id 

					INNER JOIN seller_product_category f ON a.seller_product_id=f.seller_product_id 

					INNER JOIN seller_product_image g ON a.seller_product_id=g.seller_product_id 

					WHERE a.seller_product_id IN ($slr_prdt_ids)");

					$result = $query->result();

					//$array_length = count($result);

					$array_length = $query->num_rows();

					

					$this->load->model('Usermodel');

					$product_id = $this->Usermodel->get_unique_id('product_setting','product_id');

					

					//program start for generating product unique id//

					$product_uid = $this->generate_product_unique_id($result[$j]->category);

					//program start for generating product unique id//

					 

					//for($i=0; $i<$array_length; $i++){

						$product_master_data = array(

							'seller_id' => $result[$j]->seller_id,

							'product_id' => $product_id,

							'product_uid' => $product_uid,

							'sku' => $result[$j]->sku,

							'set_product_as_nw_frm_dt' => $result[$j]->product_fr_dt,

							'set_product_as_nw_to_dt' => $result[$j]->product_to_dt,

							'status' => $result[$j]->status,

							'manufacture_country' => $result[$j]->manufacture_country,

							'mrp' => $result[$j]->mrp,

							'price' => $result[$j]->price,

							'special_price' => $result[$j]->special_price,

							'special_pric_from_dt' => $result[$j]->price_fr_dt,

							'special_pric_to_dt' => $result[$j]->price_to_dt,

							'tax_amount' => $result[$j]->tax_amount,

							'shipping_fee' => $result[$j]->shipping_fee,

							'shipping_fee_amount' => $result[$j]->shipping_fee_amount,

							'quantity' => $result[$j]->quantity,

							'max_qty_allowed_in_shopng_cart' => $result[$j]->max_quantity,

							'enable_qty_increment' => $result[$j]->qty_increment,

							'stock_availability' => $result[$j]->stock_avail

						);

						

						$product_setting_data = array(

							'product_id' => $product_id,

							'attribut_set' => $result[$j]->attribute_set,

							'product_type' => $result[$j]->product_type,

							'add_date' => $result[$j]->date_added,

							'status' => 'Active'

						);

						

						$product_general_info_data = array(

							'product_id' => $product_id,

							'name' => $result[$j]->name,

							'description' => $result[$j]->description,

							'short_desc' => $result[$j]->short_desc,

							'weight' => $result[$j]->weight,

							'featured' => $result[$j]->featured

						);

						

						$product_meta_data = array(

							'product_id' => $product_id,

							'meta_title' => $result[$j]->meta_title,

							'meta_keywords' => $result[$j]->meta_keyword,

							'meta_desc' => $result[$j]->meta_description

						);

						

						$product_category_data = array(

							'product_id' => $product_id,

							'category_id' => $result[$j]->category

						);

						

						$product_image_data = array(

							'product_id' => $product_id,

							'imag' => $result[$j]->image,

							'catelog_img_url' => $result[$j]->catelog_img_url

						);

						

						//$arr_seller_product_id = $result[$j]->seller_product_id;

						//$arr_product_id = $product_id;						

						

						$this->db->insert('product_master',$product_master_data);

						$this->db->insert('product_setting',$product_setting_data);

						$this->db->insert('product_general_info',$product_general_info_data);

						$this->db->insert('product_meta_info',$product_meta_data);

						$this->db->insert('product_category',$product_category_data);

						$this->db->insert('product_image',$product_image_data);



						$this->insert_master_product_id($slr_prdt_id[$j],$product_id);

						

					//}

					//$this->insert_master_product_id($slr_prdt_id,$arr_product_id);

										

					

					/*$this->db->insert_batch('product_master',$product_master_data);

					$this->db->insert_batch('product_setting',$product_setting_data);

					$this->db->insert_batch('product_general_info',$product_general_info_data);

					$this->db->insert_batch('product_meta_info',$product_meta_data);

					$this->db->insert_batch('product_category',$product_category_data);

					$this->db->insert_batch('product_image',$product_image_data);*/

					/////retrieve selected seller's product data and insert into admin product tables script start here//////

					$query1 = $this->db->query("UPDATE seller_product_setting SET product_approve='$status' WHERE seller_product_id IN ($slr_prdt_ids)");

					//continue ;

				}else{

					///////start retrieve seller_product_id whose master_product_id is not 0 ////////////

					//$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');

					

					$query5 = $this->db->query("SELECT seller_product_id,master_product_id FROM seller_product_setting WHERE seller_product_id IN ($ids) AND master_product_id!=0");

					$result5 = $query5->result();

					foreach($result5 as $val2){

						$slr_prdt_id1[] = $val2->seller_product_id;

						$slr_master_product_id1[] = $val2->master_product_id;

					}

					$slr_prdt_ids1 = implode(',',$slr_prdt_id1);

					$slr_master_product_ids1 = implode(',',$slr_master_product_id1);

					///////end retrieve seller_product_id whose master_product_id is not 0 ////////////

					$query3 = $this->db->query("UPDATE seller_product_setting SET product_approve='$status' WHERE seller_product_id IN ($slr_prdt_ids1)");



					$querys1 = $this->db->query("UPDATE product_setting SET status='Active' WHERE product_id IN ($slr_master_product_ids1)");

					$this->db->query("update cornjob_productsearch SET prod_status='Active' WHERE product_id IN ($slr_master_product_ids1) ");

					//continue ;

				}

			}

			return true;

		}else{

			

			//$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');

			

			$query7 = $this->db->query("SELECT master_product_id FROM seller_product_setting WHERE seller_product_id IN ($ids)");

			$result7 = $query7->result();

			foreach($result7 as $val){

				$master_product_id[] = $val->master_product_id;			

			}

			$master_product_id_length = count($master_product_id);

			for($j=0; $j<$master_product_id_length; $j++){

				if($master_product_id[$j] == 0){

					

					//$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');

					

					///////start retrieve seller_product_id whose master_product_id is 0 ////////////

					$query6 = $this->db->query("SELECT seller_product_id FROM seller_product_setting WHERE seller_product_id IN ($ids) AND master_product_id=0");

					$result6 = $query6->result();

					foreach($result6 as $val1){

						$slr_prdt_id[] = $val1->seller_product_id;

					}

					$slr_prdt_ids = implode(',',$slr_prdt_id);

					///////end retrieve seller_product_id whose master_product_id is 0 ////////////					

					

					$query8 = $this->db->query("UPDATE seller_product_setting SET product_approve='$status' WHERE seller_product_id IN ($slr_prdt_ids)");

				}else{

					///////start retrieve seller_product_id whose master_product_id is not 0 ////////////

					

					//$this->db->query('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');

					

					$query9 = $this->db->query("SELECT seller_product_id,master_product_id,seller_id FROM seller_product_setting WHERE seller_product_id IN ($ids) AND master_product_id!=0");

					$result9 = $query9->result();

					foreach($result9 as $val2){

						$slr_prdt_id1[] = $val2->seller_product_id;

						$slr_master_product_id[] = $val2->master_product_id;

						$seller_id[] = $val2->seller_id;

					}

					$slr_prdt_ids1 = implode(',',$slr_prdt_id1);

					$slr_master_product_ids = implode(',',$slr_master_product_id);

					$seller_ids1 = implode(',',$seller_id);

					///////end retrieve seller_product_id whose master_product_id is not 0 ////////////

					$querys = $this->db->query("UPDATE seller_product_setting SET product_approve='$status' WHERE seller_product_id IN ($slr_prdt_ids1)");

					

				$querys1 = $this->db->query("UPDATE product_master SET approve_status='Inactive' WHERE product_id IN ($slr_master_product_ids) AND seller_id IN ($seller_ids1)");					

					$this->db->query("update cornjob_productsearch SET prod_status='Inactive' WHERE product_id IN ($slr_master_product_ids) ");

				}

			}

			return true;

		}

	}

	//=======================================================================Product Approval End =============================================//





			function changed_sellerwiseproduct_status_sp()

			{		set_time_limit(0);					

					$seller_ids = $this->input->post('id');				

					//$seller_ids=440;				

									

						/*$qr=$this->db->query("SELECT seller_id FROM seller_product_setting WHERE seller_id='$seller_ids' AND master_product_id=0 AND product_approve='Pending' GROUP BY  seller_id");						

							while($qr->num_rows()>0)

							{*/

									$sql="call bulk_newproductapproval(".$seller_ids.");";

									$this->db->query($sql);

																		

									/*if($qr->num_rows()==0){break;}														

								

							}*/

							

							$this->db->query("UPDATE product_process_status SET prod_approv='not process' WHERE status_id='1' ");

							//return true;

						

				}







	//=========================================sellerwise Approval Start=============================================================================//	

	function changed_sellerwiseproduct_status()

	{

		$ids = implode(',',$this->input->post('id'));

		

		//-----------------------seller product id for approve start-----------//

			

		$query_slrprod = $this->db->query("SELECT b.seller_product_id FROM seller_product_setting b WHERE (b.product_approve='Pending')  AND b.seller_id IN ($ids)  GROUP BY b.seller_product_id  ");

		

		$ids='';

		$slrprodarr=array();

		foreach($query_slrprod->result_array() as $res_slrprod )

		{

			$slrprodarr[]= $res_slrprod['seller_product_id'];	

		}

		$ids=implode(',',$slrprodarr);

		

		//-----------------------seller product id for approve end-------------//

		

		$status = $this->input->post('status');



		if($status == 'Active'){

			$query2 = $this->db->query("SELECT master_product_id FROM seller_product_setting WHERE seller_product_id IN ($ids)");

			$result2 = $query2->result();

			//print_r($result2);exit;

			foreach($result2 as $val){

				//echo $val->master_product_id.'<br/>';

				$master_product_id[] = $val->master_product_id;		

			}

			//print_r($master_product_id);exit;

			$master_product_id_length = count($master_product_id);



			for($j=0; $j<$master_product_id_length; $j++){

				if($master_product_id[$j] == 0){

					///////start retrieve seller_product_id whose master_product_id is 0 ////////////

					$query4 = $this->db->query("SELECT seller_product_id FROM seller_product_setting WHERE seller_product_id IN ($ids) AND master_product_id=0");

					$result4 = $query4->result();

					foreach($result4 as $val1){

						$slr_prdt_id[] = $val1->seller_product_id;

					}

					$slr_prdt_ids = implode(',',$slr_prdt_id);

					///////end retrieve seller_product_id whose master_product_id is 0 ////////////

					

					/////retrieve selected seller's product data and insert into admin product tables script start here//////

					$query = $this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,f.*,g.* FROM seller_product_setting a 

					INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 

					INNER JOIN seller_product_price_info c ON a.seller_product_id=c.seller_product_id 

					INNER JOIN seller_product_meta_info d ON a.seller_product_id=d.seller_product_id 

					INNER JOIN seller_product_inventory_info e ON a.seller_product_id=e.seller_product_id 

					INNER JOIN seller_product_category f ON a.seller_product_id=f.seller_product_id 

					INNER JOIN seller_product_image g ON a.seller_product_id=g.seller_product_id 

					WHERE a.seller_product_id IN ($slr_prdt_ids)");

					$result = $query->result();

					//$array_length = count($result);

					$array_length = $query->num_rows();

					

					$this->load->model('Usermodel');

					$product_id = $this->Usermodel->get_unique_id('product_setting','product_id');

					

					//program start for generating product unique id//

					$product_uid = $this->generate_product_unique_id($result[$j]->category);

					//program start for generating product unique id//

					 

					//for($i=0; $i<$array_length; $i++){

						$product_master_data = array(

							'seller_id' => $result[$j]->seller_id,

							'product_id' => $product_id,

							'product_uid' => $product_uid,

							'sku' => $result[$j]->sku,

							'set_product_as_nw_frm_dt' => $result[$j]->product_fr_dt,

							'set_product_as_nw_to_dt' => $result[$j]->product_to_dt,

							'status' => $result[$j]->status,

							'manufacture_country' => $result[$j]->manufacture_country,

							'mrp' => $result[$j]->mrp,

							'price' => $result[$j]->price,

							'special_price' => $result[$j]->special_price,

							'special_pric_from_dt' => $result[$j]->price_fr_dt,

							'special_pric_to_dt' => $result[$j]->price_to_dt,

							'tax_amount' => $result[$j]->tax_amount,

							'shipping_fee' => $result[$j]->shipping_fee,

							'shipping_fee_amount' => $result[$j]->shipping_fee_amount,

							'quantity' => $result[$j]->quantity,

							'max_qty_allowed_in_shopng_cart' => $result[$j]->max_quantity,

							'enable_qty_increment' => $result[$j]->qty_increment,

							'stock_availability' => $result[$j]->stock_avail

						);

						

						$product_setting_data = array(

							'product_id' => $product_id,

							'attribut_set' => $result[$j]->attribute_set,

							'product_type' => $result[$j]->product_type,

							'add_date' => $result[$j]->date_added,

							'status' => 'Active'

						);

						

						$product_general_info_data = array(

							'product_id' => $product_id,

							'name' => $result[$j]->name,

							'description' => $result[$j]->description,

							'short_desc' => $result[$j]->short_desc,

							'weight' => $result[$j]->weight,

							'featured' => $result[$j]->featured

						);

						

						$product_meta_data = array(

							'product_id' => $product_id,

							'meta_title' => $result[$j]->meta_title,

							'meta_keywords' => $result[$j]->meta_keyword,

							'meta_desc' => $result[$j]->meta_description

						);

						

						$product_category_data = array(

							'product_id' => $product_id,

							'category_id' => $result[$j]->category

						);

						

						$product_image_data = array(

							'product_id' => $product_id,

							'imag' => $result[$j]->image,

							'catelog_img_url' => $result[$j]->catelog_img_url

						);

						

						//$arr_seller_product_id = $result[$j]->seller_product_id;

						//$arr_product_id = $product_id;						

						

						$this->db->insert('product_master',$product_master_data);

						$this->db->insert('product_setting',$product_setting_data);

						$this->db->insert('product_general_info',$product_general_info_data);

						$this->db->insert('product_meta_info',$product_meta_data);

						$this->db->insert('product_category',$product_category_data);

						$this->db->insert('product_image',$product_image_data);



						$this->insert_master_product_id($slr_prdt_id[$j],$product_id);

						

					//}

					//$this->insert_master_product_id($slr_prdt_id,$arr_product_id);

										

					

					/*$this->db->insert_batch('product_master',$product_master_data);

					$this->db->insert_batch('product_setting',$product_setting_data);

					$this->db->insert_batch('product_general_info',$product_general_info_data);

					$this->db->insert_batch('product_meta_info',$product_meta_data);

					$this->db->insert_batch('product_category',$product_category_data);

					$this->db->insert_batch('product_image',$product_image_data);*/

					/////retrieve selected seller's product data and insert into admin product tables script start here//////

					$query1 = $this->db->query("UPDATE seller_product_setting SET product_approve='$status' WHERE seller_product_id IN ($slr_prdt_ids)");

					//continue ;

				}else{

					///////start retrieve seller_product_id whose master_product_id is not 0 ////////////

					$query5 = $this->db->query("SELECT seller_product_id,master_product_id FROM seller_product_setting WHERE seller_product_id IN ($ids) AND master_product_id!=0");

					$result5 = $query5->result();

					foreach($result5 as $val2){

						$slr_prdt_id1[] = $val2->seller_product_id;

						$slr_master_product_id1[] = $val2->master_product_id;

					}

					$slr_prdt_ids1 = implode(',',$slr_prdt_id1);

					$slr_master_product_ids1 = implode(',',$slr_master_product_id1);

					///////end retrieve seller_product_id whose master_product_id is not 0 ////////////

					$query3 = $this->db->query("UPDATE seller_product_setting SET product_approve='$status' WHERE seller_product_id IN ($slr_prdt_ids1)");



					$querys1 = $this->db->query("UPDATE product_setting SET status='Active' WHERE product_id IN ($slr_master_product_ids1)");

					$this->db->query("update cornjob_productsearch SET prod_status='Active' WHERE product_id IN ($slr_master_product_ids1) ");

					//continue ;

				}

			}

			return true;

		}else{

			$query7 = $this->db->query("SELECT master_product_id FROM seller_product_setting WHERE seller_product_id IN ($ids)");

			$result7 = $query7->result();

			foreach($result7 as $val){

				$master_product_id[] = $val->master_product_id;			

			}

			$master_product_id_length = count($master_product_id);

			for($j=0; $j<$master_product_id_length; $j++){

				if($master_product_id[$j] == 0){

					///////start retrieve seller_product_id whose master_product_id is 0 ////////////

					$query6 = $this->db->query("SELECT seller_product_id FROM seller_product_setting WHERE seller_product_id IN ($ids) AND master_product_id=0");

					$result6 = $query6->result();

					foreach($result6 as $val1){

						$slr_prdt_id[] = $val1->seller_product_id;

					}

					$slr_prdt_ids = implode(',',$slr_prdt_id);

					///////end retrieve seller_product_id whose master_product_id is 0 ////////////					

					

					$query8 = $this->db->query("UPDATE seller_product_setting SET product_approve='$status' WHERE seller_product_id IN ($slr_prdt_ids)");

				}else{

					///////start retrieve seller_product_id whose master_product_id is not 0 ////////////

					$query9 = $this->db->query("SELECT seller_product_id,master_product_id,seller_id FROM seller_product_setting WHERE seller_product_id IN ($ids) AND master_product_id!=0");

					$result9 = $query9->result();

					foreach($result9 as $val2){

						$slr_prdt_id1[] = $val2->seller_product_id;

						$slr_master_product_id[] = $val2->master_product_id;

						$seller_id[] = $val2->seller_id;

					}

					$slr_prdt_ids1 = implode(',',$slr_prdt_id1);

					$slr_master_product_ids = implode(',',$slr_master_product_id);

					$seller_ids1 = implode(',',$seller_id);

					///////end retrieve seller_product_id whose master_product_id is not 0 ////////////

					$querys = $this->db->query("UPDATE seller_product_setting SET product_approve='$status' WHERE seller_product_id IN ($slr_prdt_ids1)");

					

				$querys1 = $this->db->query("UPDATE product_master SET approve_status='Inactive' WHERE product_id IN ($slr_master_product_ids) AND seller_id IN ($seller_ids1)");					

					$this->db->query("update cornjob_productsearch SET prod_status='Inactive' WHERE product_id IN ($slr_master_product_ids) ");

				}

			}

			return true;

		}

	}

	//=============================sellerwise Product Approval End =============================================================================//

	

	

	

	/*function insert_master_product_id($seller_product_id,$arr_product_id){

		$arr_length = count($seller_product_id);

		for($i=0; $i<=$arr_length-1; $i++){

			$query = $this->db->query("UPDATE seller_product_setting SET master_product_id='$arr_product_id[$i]' WHERE seller_product_id='$seller_product_id[$i]'");

		}

	}*/

	

	

	function insert_master_product_id($seller_product_id,$product_id){

			$query = $this->db->query("UPDATE seller_product_setting SET master_product_id='$product_id' WHERE seller_product_id='$seller_product_id'");

	}

	

	/*function changed_seller_exiting_product_status(){

		$ids = implode(',',$this->input->post('id'));

		$status = $this->input->post('status');

		if($status == 'Active'){

			$query = $this->db->query("SELECT * FROM seller_product_master WHERE seller_exist_product_id IN ($ids)");

			$result = $query->result();

			foreach ($result as $row){

				$seller_id[] = $row->seller_id;

				$master_product_id[] = $row->master_product_id;

				$seller_exiting_product_id[] = $row->seller_exist_product_id;

			}

			$seller_exiting_product_ids = implode(',',$seller_exiting_product_id);

			$arr_length = count($seller_id);

			for($i=0; $i<$arr_length; $i++){

				//////script start for selected product id and seller id is exit in product master or not//////

				$query1 = $this->db->query("SELECT * FROM product_master WHERE seller_id='$seller_id[$i]' AND product_id='$master_product_id[$i]'");

				$row1 = $query1->num_rows();

				//////start script for selected product id and seller id is not in product master ///////

				if($row1 < 1){

					$query2 = $this->db->query("SELECT * FROM seller_product_master WHERE seller_exist_product_id='$seller_exiting_product_id[$i]'");

					$result2 = $query2->result();

					$length = count($result2);

					for($j=0; $j<$length; $j++){

						

					//program start for generating product unique id//

					$this->load->model('Usermodel');

					$mstr_product_id = $result2[$j]->master_product_id;

					$cat_sql = $this->db->query("SELECT a.category_id FROM category_indexing a INNER JOIN product_category b ON a.category_id=b.category_id WHERE b.product_id='$mstr_product_id'");

					$cat_res = $cat_sql->result();

					$cat_id = $cat_res[0]->category_id;			

					$product_uid = $this->generate_product_unique_id($cat_id);

					//echo $product_uid;exit;

					//program start for generating product unique id//

						

						$seller_exit_product_data[] = array(

							'seller_id' =>$result2[$j]->seller_id,

							'product_id' =>$result2[$j]->master_product_id,

							'product_uid' => $product_uid,

							'sku' =>$result2[$j]->sku,

							'set_product_as_nw_frm_dt' =>$result2[$j]->set_product_as_nw_frm_dt,

							'set_product_as_nw_to_dt' =>$result2[$j]->set_product_as_nw_to_dt,

							'status' =>$result2[$j]->status,

							'manufacture_country' =>$result2[$j]->manufacture_country,

							'mrp' =>$result2[$j]->mrp,

							'price' =>$result2[$j]->price,

							'special_price' =>$result2[$j]->special_price,

							'special_pric_from_dt' =>$result2[$j]->special_pric_from_dt,

							'special_pric_to_dt' =>$result2[$j]->special_pric_to_dt,

							'tax_amount' =>$result2[$j]->tax_amount,

							'shipping_fee' =>$result2[$j]->shipping_fee,

							'shipping_fee_amount' =>$result2[$j]->shipping_fee_amount,

							'quantity' =>$result2[$j]->quantity,

							'max_qty_allowed_in_shopng_cart' =>$result2[$j]->max_qty_allowed_in_shopng_cart,

							'enable_qty_increment' =>$result2[$j]->enable_qty_increment,

							'stock_availability' =>$result2[$j]->stock_availability,

							'approve_status' =>$status

						);

					}

					

					$this->db->insert_batch('product_master',$seller_exit_product_data);

					$this->db->query("UPDATE seller_product_master SET approve_status='$status' WHERE seller_exist_product_id IN ($seller_exiting_product_ids)");

				//////end script for selected product id and seller id is not in product master ///////

				//////start script for selected product id and seller id is avail in product master ///////

				}else{

					$query3 = $this->db->query("SELECT * FROM seller_product_master WHERE seller_exist_product_id='$seller_exiting_product_id[$i]'");

					$result3 = $query3->result();

					foreach($result3 as $val){

						$slr_id[] = $val->seller_id;

						$prdt_id[] = $val->master_product_id;

					}

					$slr_ids = implode(',',$slr_id);

					$prdt_ids = implode(',',$prdt_id);

					

					$this->db->query("UPDATE seller_product_master SET approve_status='$status' WHERE seller_exist_product_id IN ($seller_exiting_product_ids)");

					

					$this->db->query("UPDATE product_master SET approve_status='$status' WHERE seller_id IN ($slr_ids) AND product_id IN ($prdt_ids)");

				}

				//////end script for selected product id and seller id is avail in product master ///////

				//////script end for selected product id and seller id is exit in product master or not//////

			}

			return true;

		} //if status is not avtive condtion else part start

		

		else{

			$query = $this->db->query("SELECT * FROM seller_product_master WHERE seller_exist_product_id IN ($ids)");

			$result = $query->result();

			foreach ($result as $row){

				$seller_id[] = $row->seller_id;

				$master_product_id[] = $row->master_product_id;

				$seller_exiting_product_id[] = $row->seller_exist_product_id;

			}

			$seller_exiting_product_ids = implode(',',$seller_exiting_product_id);

			$arr_length = count($seller_id);

			for($i=0; $i<$arr_length; $i++){

				//////script start for selected product id and seller id is exit in product master or not//////

				$query1 = $this->db->query("SELECT * FROM product_master WHERE seller_id='$seller_id[$i]' AND product_id='$master_product_id[$i]'");

				$row1 = $query1->num_rows();

				//////start script for selected product id and seller id is not in product master ///////

				if($row1 < 1){

					$query2 = $this->db->query("SELECT * FROM seller_product_master WHERE seller_exist_product_id='$seller_exiting_product_id[$i]'");

					$result2 = $query2->result();

					$length = count($result2);

					for($j=0; $j<$length; $j++){

						$seller_exiting_product_id1[] = $result2[$j]->seller_exist_product_id;

					}

					$seller_exiting_product_ids1 = implode(',',$seller_exiting_product_id1);		

					$this->db->query("UPDATE seller_product_master SET approve_status='$status' WHERE seller_exist_product_id IN ($seller_exiting_product_ids1)");

				//////end script for selected product id and seller id is not in product master ///////

				//////start script for selected product id and seller id is avail in product master ///////

				}else{

					$query3 = $this->db->query("SELECT * FROM seller_product_master WHERE seller_exist_product_id='$seller_exiting_product_id[$i]'");

					$result3 = $query3->result();

					foreach($result3 as $val){

						$slr_id[] = $val->seller_id;

						$prdt_id[] = $val->master_product_id;

						$slr_ext_prdt_id[] = $val->seller_exist_product_id;

					}

					$slr_ids = implode(',',$slr_id);

					$prdt_ids = implode(',',$prdt_id);

					$slr_ext_prdt_ids = implode(',',$slr_ext_prdt_id);

					

					$this->db->query("UPDATE seller_product_master SET approve_status='$status' WHERE seller_exist_product_id IN ($slr_ext_prdt_ids)");

					

					$this->db->query("UPDATE product_master SET approve_status='Inactive' WHERE seller_id IN ($slr_ids) AND product_id IN ($prdt_ids)");

					$this->db->query("update cornjob_productsearch SET prod_status='Inactive'  WHERE product_id IN ($prdt_ids) ");

				}

				//////end script for selected product id and seller id is avail in product master ///////

				//////script end for selected product id and seller id is exit in product master or not//////

			}	

			return true;

		}

	}*/

	

	

	



	function changed_seller_exiting_product_status(){

		$ids = implode(',',$this->input->post('id'));
		//$prodskuids = $this->input->post('prodextsku');	

		$status = $this->input->post('status');
		
		if($status == 'Active'){

			$query = $this->db->query("SELECT * FROM seller_product_master WHERE seller_exist_product_id IN ($ids)");

			$result = $query->result();

			foreach ($result as $row){

				$seller_id[] = $row->seller_id;

				$master_product_id[] = $row->master_product_id;

				$seller_exiting_product_id[] = $row->seller_exist_product_id;

				$seller_sku[]=$row->sku;

			}

			$seller_exiting_product_ids = implode(',',$seller_exiting_product_id);

			

			$arr_length = count($seller_id);

			for($i=0; $i<$arr_length; $i++){

				//////script start for selected product id and seller id is exit in product master or not//////

				$query1 = $this->db->query("SELECT * FROM product_master WHERE seller_id='$seller_id[$i]' AND product_id='$master_product_id[$i]' AND sku='$seller_sku[$i]'  ");

				$row1 = $query1->num_rows();

				//////start script for selected product id and seller id is not in product master ///////

				if($row1 < 1){

					$query2 = $this->db->query("SELECT * FROM seller_product_master WHERE seller_exist_product_id='$seller_exiting_product_id[$i]'");

					$result2 = $query2->result();

					$length = count($result2);

					for($j=0; $j<$length; $j++){

						

					//program start for generating product unique id//

					$this->load->model('Usermodel');

					$mstr_product_id = $result2[$j]->master_product_id;

					$cat_sql = $this->db->query("SELECT a.category_id FROM category_indexing a INNER JOIN product_category b ON a.category_id=b.category_id WHERE b.product_id='$mstr_product_id'");

					$cat_res = $cat_sql->result();

					$cat_id = $cat_res[0]->category_id;			

					$product_uid = $this->generate_product_unique_id($cat_id);

					//echo $product_uid;exit;

					//program start for generating product unique id//

						//------------------------------------major problem in $seller_exit_product_data array initialize --------------------//
						$seller_exit_product_data=array();
						$seller_exit_product_data = array(

							'seller_id' =>$result2[$j]->seller_id,

							'product_id' =>$result2[$j]->master_product_id,

							'product_uid' => $product_uid,

							'sku' =>$result2[$j]->sku,

							'set_product_as_nw_frm_dt' =>$result2[$j]->set_product_as_nw_frm_dt,

							'set_product_as_nw_to_dt' =>$result2[$j]->set_product_as_nw_to_dt,

							'status' =>$result2[$j]->status,

							'manufacture_country' =>$result2[$j]->manufacture_country,

							'mrp' =>$result2[$j]->mrp,

							'price' =>$result2[$j]->price,

							'special_price' =>$result2[$j]->special_price,

							'special_pric_from_dt' =>$result2[$j]->special_pric_from_dt,

							'special_pric_to_dt' =>$result2[$j]->special_pric_to_dt,

							'tax_amount' =>$result2[$j]->tax_amount,

							'shipping_fee' =>$result2[$j]->shipping_fee,

							'shipping_fee_amount' =>$result2[$j]->shipping_fee_amount,

							'quantity' =>$result2[$j]->quantity,

							'max_qty_allowed_in_shopng_cart' =>$result2[$j]->max_qty_allowed_in_shopng_cart,

							'enable_qty_increment' =>$result2[$j]->enable_qty_increment,

							'stock_availability' =>$result2[$j]->stock_availability,

							'approve_status' =>$status

						);

					}

					

					$this->db->insert('product_master',$seller_exit_product_data);

					$this->db->query("UPDATE seller_product_master SET approve_status='$status' WHERE seller_exist_product_id IN ($seller_exiting_product_ids)");

				//////end script for selected product id and seller id is not in product master ///////

				//////start script for selected product id and seller id is avail in product master ///////

				}else{

					$query3 = $this->db->query("SELECT * FROM seller_product_master WHERE seller_exist_product_id='$seller_exiting_product_id[$i]'");

					$result3 = $query3->result();

					foreach($result3 as $val){

						$slr_id[] = $val->seller_id;

						$prdt_id[] = $val->master_product_id;

					}

					$slr_ids = implode(',',$slr_id);

					$prdt_ids = implode(',',$prdt_id);

					

					$this->db->query("UPDATE seller_product_master SET approve_status='$status' WHERE seller_exist_product_id IN ($seller_exiting_product_ids)");

					

					$this->db->query("UPDATE product_master SET approve_status='$status' WHERE seller_id IN ($slr_ids) AND product_id IN ($prdt_ids)");

				}

				//////end script for selected product id and seller id is avail in product master ///////

				//////script end for selected product id and seller id is exit in product master or not//////

			}

			return true;

		} //if status is not avtive condtion else part start

		

		else{

			$query = $this->db->query("SELECT * FROM seller_product_master WHERE seller_exist_product_id IN ($ids)");

			$result = $query->result();

			foreach ($result as $row){

				$seller_id[] = $row->seller_id;

				$master_product_id[] = $row->master_product_id;

				$seller_exiting_product_id[] = $row->seller_exist_product_id;

			}

			$seller_exiting_product_ids = implode(',',$seller_exiting_product_id);

			$arr_length = count($seller_id);

			for($i=0; $i<$arr_length; $i++){

				//////script start for selected product id and seller id is exit in product master or not//////

				$query1 = $this->db->query("SELECT * FROM product_master WHERE seller_id='$seller_id[$i]' AND product_id='$master_product_id[$i]'");

				$row1 = $query1->num_rows();

				//////start script for selected product id and seller id is not in product master ///////

				if($row1 < 1){

					$query2 = $this->db->query("SELECT * FROM seller_product_master WHERE seller_exist_product_id='$seller_exiting_product_id[$i]'");

					$result2 = $query2->result();

					$length = count($result2);

					for($j=0; $j<$length; $j++){

						$seller_exiting_product_id1[] = $result2[$j]->seller_exist_product_id;

					}

					$seller_exiting_product_ids1 = implode(',',$seller_exiting_product_id1);		

					$this->db->query("UPDATE seller_product_master SET approve_status='$status' WHERE seller_exist_product_id IN ($seller_exiting_product_ids1)");

				//////end script for selected product id and seller id is not in product master ///////

				//////start script for selected product id and seller id is avail in product master ///////

				}else{

					$query3 = $this->db->query("SELECT * FROM seller_product_master WHERE seller_exist_product_id='$seller_exiting_product_id[$i]'");

					$result3 = $query3->result();

					foreach($result3 as $val){

						$slr_id[] = $val->seller_id;

						$prdt_id[] = $val->master_product_id;

						$slr_ext_prdt_id[] = $val->seller_exist_product_id;

					}

					$slr_ids = implode(',',$slr_id);

					$prdt_ids = implode(',',$prdt_id);

					$slr_ext_prdt_ids = implode(',',$slr_ext_prdt_id);

					

					$this->db->query("UPDATE seller_product_master SET approve_status='$status' WHERE seller_exist_product_id IN ($slr_ext_prdt_ids)");

					

					$this->db->query("UPDATE product_master SET approve_status='Inactive' WHERE seller_id IN ($slr_ids) AND product_id IN ($prdt_ids)");

					$this->db->query("update cornjob_productsearch SET prod_status='Inactive'  WHERE product_id IN ($prdt_ids) ");

				}

				//////end script for selected product id and seller id is avail in product master ///////

				//////script end for selected product id and seller id is exit in product master or not//////

			}	

			return true;

		}

	}

	

	/*function retrive_approved_seller_product_data(){

		$query = $this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,f* FROM ");

	}*/

	

	

	function generate_product_unique_id($cat_id){

		//echo $cat_id;exit;

		$sql_id = $this->Usermodel->get_unique_id('product_master','id');

		//echo $sql_id;exit;

		

		$dt_id = preg_replace("/[^0-9]+/","", date('Y-m-d H:i:s'));

		

		$query = $this->db->query("SELECT category_name	FROM category_indexing WHERE category_id='$cat_id'");

		$result = $query->result();

		$cat_name = $result[0]->category_name;

		$hlf_cat_name = strtoupper(substr($cat_name, 0, 3));

		$product_uid = $hlf_cat_name.$dt_id.$sql_id;

		return $product_uid;

	}

	

	

	

	/** Seller Notification Start **/

	function getSellerNotification(){

		$query = $this->db->query("SELECT * FROM seller_notification");

		$row = $query->num_rows();

		if($row > 0){

			return $query->result();

		}

		else{

			return false;

		}

	}

	function getSellerNotificationForEdit($id){

		$query = $this->db->query("SELECT * FROM seller_notification WHERE id='$id'");

		$row = $query->num_rows();

		if($row > 0){

			return $query->result();

		}

		else{

			return false;

		}

	}

	function getSellerNotification2(){

		$query = $this->db->query("SELECT a.*, b.business_name FROM seller_notification2 a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id");

		$row = $query->num_rows();

		if($row > 0){

			return $query->result();

		}

		else{

			return false;

		}

	}

	function getSellerNotificationForEdit2($id){

		$query = $this->db->query("SELECT a.*, b.business_name FROM seller_notification2 a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE a.id='$id'");

		$row = $query->num_rows();

		if($row > 0){

			return $query->result();

		}

		else{

			return false;

		}

	}

	function insert_newseller_notice(){

		

		$dt =  date('Y-m-d H:i:s');

		$notice_data = array(

			'title' => $this->input->post('title'),

			'content' => $this->input->post('page_content'),

			'create_date' => $dt,

			'status' => $this->input->post('status'),

		);

		$query = $this->db->insert('seller_notification', $notice_data);

		if($query){

			return true;

		}else{

			return false;

		}

	}

	

	function insert_newseller_notice2(){

		//

		//$dt =  date('Y-m-d H:i:s');

		$notice_data = array(

			'title' => $this->input->post('title'),

			'content' => $this->input->post('page_content'),

			'seller_id' => $this->input->post('seller'),

			'status' => $this->input->post('status'),

		);

		$query = $this->db->insert('seller_notification2', $notice_data);

		if($query){

			return true;

		}else{

			return false;

		}

	}

	function getSellerEmail($seller_id){

		$this->db->where('seller_id', $seller_id);

		$d = $this->db->get('seller_account');

		$h = $d->result(); 

		return $h[0]->email;

	}

	function getseller_notification_update(){

		

		$dt =  date('Y-m-d H:i:s');

		$id = $this->input->post('hidden_id');

		$notice_data = array(

			'title' => $this->input->post('title'),

			'content' => $this->input->post('page_content'),

			'modify_date' => $dt,

			'status' => $this->input->post('status'),

		);

		$this->db->where('id', $id);

		$query = $this->db->update('seller_notification', $notice_data);

		if($query){

			return true;

		}else{

			return false;

		}

	}

	function getseller_notification_update2(){

		$id = $this->input->post('hidden_id');

		$notice_data = array(

			'title' => $this->input->post('title'),

			'content' => $this->input->post('page_content'),

			'seller_id' => $this->input->post('seller'),

			'status' => $this->input->post('status'),

		);

		$this->db->where('id', $id);

		$query = $this->db->update('seller_notification2', $notice_data);

		if($query){

			return true;

		}else{

			return false;

		}

	}

	function delete_seller_notification($id){

		$this->db->where('id', $id);

		$query = $this->db->delete('seller_notification'); 

		if($query){

			return true;

		}else{

			return false;

		}

	}

	function delete_seller_notification2($id){

		$this->db->where('id', $id);

		$query = $this->db->delete('seller_notification2'); 

		if($query){

			return true;

		}else{

			return false;

		}

	}

	

	function getSellersBadgeDetails(){

		$query = $this->db->query("SELECT a.*, b.business_name

		FROM seller_badge a 

		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id");

		$row = $query->num_rows();

		if($row > 0){

			return $query->result();

		}else{

			return false;

		}

	}

	function getBadgeSellersList(){

		$query = $this->db->query("SELECT a.*, b.* 

		FROM seller_account a

		INNER JOIN seller_account_information b ON a.seller_id = b.seller_id

		WHERE a.seller_id NOT IN (SELECT seller_id FROM membership_seller) ");

		$row = $query->num_rows();

		if($row > 0){

			return $query->result();

		}else{

			return false;

		}

	}

	function insert_newseller_badge(){

		$seller_type1 = $this->input->post('seller_type'); 

		$seller_type2 = implode(',', $seller_type1);

		$badge_data = array(

			'seller_id' => $this->input->post('seller_list'),

			'seller_badge_type' => $seller_type2,

			'from_date' => $this->input->post('from_date'),

			'to_date' => $this->input->post('to_date'),

		);

		$query = $this->db->insert('seller_badge', $badge_data);

		if($query){

			return true;

		}else{

			return false;

		}

	}

	function deleteSellerBadge($id){

		$this->db->where('id', $id);

		$query = $this->db->delete('seller_badge'); 

		if($query){

			return true;

		}else{

			return false;

		}

	}

	function getBadgeSellerList(){

		$query = $this->db->query("SELECT b.business_name, b.seller_id

		FROM seller_account a 

		INNER JOIN seller_account_information b ON a.seller_id = b.seller_id 

		ORDER BY a.seller_id DESC");

		$row = $query->num_rows();

		if($row > 0){

			return $query->result();

		}else{

			return false;

		}

	}

	function getSellerBadgeDetails($id){

		$query = $this->db->query("SELECT a.*, b.business_name

		FROM seller_badge a 

		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id

		WHERE a.id='$id'");

		$row = $query->num_rows();

		if($row > 0){

			return $query->result();

		}else{

			return false;

		}

	}

	function seller_badge_update(){

		$id = $this->input->post('hidden_id');

		$seller_type1 = $this->input->post('seller_type'); 

		$seller_type2 = implode(',', $seller_type1);

		$badge_data = array(

			'seller_id' => $this->input->post('seller_list'),

			'seller_badge_type' => $seller_type2,

			'from_date' => $this->input->post('from_date'),

			'to_date' => $this->input->post('to_date'),

		);

		$this->db->where('id', $id);

		$query = $this->db->update('seller_badge', $badge_data);

		if($query){

			return true;

		}else{

			return false;

		}

	}

	

	function insert_dispatched_data(){

		$state_id = $this->input->post('state');

		$data = array(

			'state_id' => $state_id,

			'dispatch_days' => $this->input->post('dispatch_time')

		);		

		$query = $this->db->query("SELECT * FROM dispatched_day_setting WHERE state_id=$state_id");

		$rows = $query->num_rows();

		

		if($rows > 0){

			return 0;

		}else{

			$this->db->insert('dispatched_day_setting',$data);

			if($this->db->affected_rows() > 0){

				return 1;

			}

		}

	}

	

	function insert_update_dispatched_data(){

		$state_id = $this->input->post('state');

		$data = array(

			'state_id' => $state_id,

			'dispatch_days' => $this->input->post('dispatch_time')

		);

		$query = $this->db->query("SELECT * FROM dispatched_day_setting WHERE state_id=$state_id");

		$rows = $query->num_rows();

		if($rows > 0){

			$this->db->where('state_id',$state_id);

			$this->db->update('dispatched_day_setting',$data);

			if($this->db->affected_rows() > 0){

				return true;

			}

		}else{

			$this->db->insert('dispatched_day_setting',$data);

			if($this->db->affected_rows() > 0){

				return true;

			}

		}

	}

	

	function retrieve_dispatch_details(){

		$query = $this->db->query("SELECT a.state, a.state_id, b.dispatch_days FROM state a LEFT JOIN dispatched_day_setting b ON a.state_id = b.state_id");

		return $query->result();

	}

	

	

	function getMembershipDetails(){

		$query = $this->db->query("SELECT b.membrship_name, c.business_name 

		FROM membership_seller a

		INNER JOIN membership b ON a.memb_id = b.mbrshp_id

		INNER JOIN seller_account_information c ON a.seller_id=c.seller_id");

		return $query->result();

	}

	function getMembershipSellersList(){

		$query = $this->db->query("SELECT a.*, b.* 

		FROM seller_account a

		INNER JOIN seller_account_information b ON a.seller_id = b.seller_id

		WHERE a.seller_id NOT IN (SELECT seller_id FROM membership_seller) ");

		$row = $query->num_rows();

		if($row > 0){

			return $query->result();

		}else{

			return false;

		}

	}

	function getMembershipList(){

		$query = $this->db->query("SELECT * FROM membership");

		$row = $query->num_rows();

		if($row > 0){

			return $query->result();

		}else{

			return false;

		}

	}

	function insert_newseller_membership($membership, $seller_id){ 

		$seller_id = explode(',', $seller_id);

		$count = count($seller_id);

		for($i=0; $i<$count; $i++){

			$data = array(

				'memb_id' => $membership,

				'seller_id' => $seller_id[$i],

			);

			$this->db->insert('membership_seller',$data);

		}

		return true;

	}

	

	// Update Product Reject Reason

	function update_pro_reject_data(){

		$status = $this->input->post('status'); 

		$reason = $this->input->post('reason'); 

		$sku = $this->input->post('sku'); 

		$product_id = $this->input->post('product_id');   //echo $sku; exit;

		

		if($status == 'Active'){

			$data1 = array(

				'approve_status' => $status,

			);

			$this->db->where('product_id', $product_id);

			$this->db->where('sku', $sku);

			$query = $this->db->update('product_master', $data1);

			

			$qr = $this->db->query("SELECT b.seller_product_id FROM seller_product_general_info a INNER JOIN seller_product_setting b ON a.seller_product_id = b.seller_product_id WHERE a.sku = '$sku'");

			$row = $qr->num_rows();

			$res = $qr->result(); //print_r($res); exit;

			if($row > 0){

				$data2 = array('product_approve' => $status);

				$this->db->where('seller_product_id', $res[0]->seller_product_id);

				$this->db->update('seller_product_setting', $data2);

			}else{

				$data3 = array('approve_status' => $status);

				$this->db->where('sku', $sku);

				$this->db->update('seller_product_master', $data3);

			}

			return true;

		}else if($status == 'Suspended'){ 

			$data1 = array(

				'approve_status' => 'Inactive',

			);

			$this->db->where('product_id', $product_id);

			$this->db->where('sku', $sku);

			$query = $this->db->update('product_master', $data1);

			

			$qr = $this->db->query("SELECT b.seller_product_id FROM seller_product_general_info a INNER JOIN seller_product_setting b ON a.seller_product_id = b.seller_product_id WHERE a.sku = '$sku'");

			$row = $qr->num_rows();

			$res = $qr->result(); //print_r($res); exit;

			if($row > 0){

				$data2 = array(

					'product_approve' => $status,

					'reject_reason' => $reason

				);

				$this->db->where('seller_product_id', $res[0]->seller_product_id);

				$this->db->update('seller_product_setting', $data2);

			}else{

				$data3 = array(

					'approve_status' => $status,

					'reject_reason' => $reason

				);

				$this->db->where('sku', $sku);

				$this->db->update('seller_product_master', $data3);

			}

			return true;

		}else{

			$data1 = array(

				'approve_status' => 'Inactive',

				'reject_reason' => $reason

			);

			$this->db->where('product_id', $product_id);

			$this->db->where('sku', $sku);

			$query = $this->db->update('product_master', $data1);

			

			$qr = $this->db->query("SELECT b.seller_product_id FROM seller_product_general_info a INNER JOIN seller_product_setting b ON a.seller_product_id = b.seller_product_id WHERE a.sku = '$sku'");

			$row = $qr->num_rows();

			$res = $qr->result();

			if($row > 0){

				$data2 = array(

					'product_approve' => $status,

					'reject_reason' => $reason

				);

				$this->db->where('seller_product_id', $res[0]->seller_product_id);

				$this->db->update('seller_product_setting', $data2);

			}else{

				$data3 = array(

					'approve_status' => $status,

					'reject_reason' => $reason

				);

				$this->db->where('sku', $sku);

				$this->db->update('seller_product_master', $data3);

			}

			return true;

		}

		

	}

	

	function select_defailt_seller()

	{

		

		$default_seller_query=$this->db->query("select * from product_master where seller_id!=0 AND shipment_delay_count > 1 ");

		$row_default_seller_query=$default_seller_query->result();

		

		return $row_default_seller_query;

	}

	

	function select_defulter_seller()

	{

		$default_seller_query=$this->db->query("select a.*,a.sku as prd_sku, a.approve_status as prd_status,b.name,c.imag,d.name as product_name from product_master a inner join seller_account b on a.seller_id=b.seller_id inner join product_image c on c.product_id=a.product_id inner join product_general_info d on a.product_id=d.product_id where  a.seller_id != 0 AND a.shipment_delay_count > 1 ");

		

		

		$row_default_seller_query=$default_seller_query->result();

		

		return $row_default_seller_query;

			

	}

	

	function change_defulterseller_status($sku_id)

	{

		

		$this->db->query("update product_master set approve_status='Inactive' where sku='$sku_id' ");

		

		$query_seller_product_master=$this->db->query("select * from seller_product_master  where sku='$sku_id' ");

		

		if($query_seller_product_master->num_rows()!=0)

		{

			$this->db->query("update seller_product_master set approve_status='Suspended' where sku='$sku_id' ");

		}

		

		

		$query_seller_product_geninfo=$this->db->query("select * from seller_product_general_info  where sku='$sku_id' ");

		

		if($query_seller_product_geninfo->num_rows()!=0)

		{

			$rows_seller_product_geninfo=$query_seller_product_geninfo->result();

			$seller_product_id=$rows_seller_product_geninfo[0]->seller_product_id;

			$this->db->query("update seller_product_setting set product_approve='Suspended' where seller_product_id='$seller_product_id' ");	



		}

	}

	

	

	

	

	function update_inn_slr_info(){

		$sl = $this->input->post('sl');

		$slr_id = $this->input->post('slr_id');

		$slr_data = $this->input->post('slr_data');

		if($sl == 1 || $sl == 13){

			$query = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

			$rows = $query->num_rows();

			if($rows > 0){

				$data = array('pname' => $slr_data);

				$this->db->where('seller_id',$slr_id);

				$this->db->update('seller_account_information',$data);

				

				if($this->db->affected_rows() > 0){

					//return true;

					$query1 = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

					return $query1->row()->pname;

				}

			}else{

				$data = array('seller_id' => $slr_id,'pname' => $slr_data);

				$this->db->insert('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					return true;

				}

			}

		}

		else if($sl == 2){

			$query = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

			$rows = $query->num_rows();

			if($rows > 0){

				$data = array('pemail' => $slr_data);

				$this->db->where('seller_id',$slr_id);

				$this->db->update('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					$query1 = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

					return $query1->row()->pemail;

					//return true;

				}

			}else{

				$data = array('seller_id' => $slr_id,'pemail' => $slr_data);

				$this->db->insert('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					return true;

				}

			}

		}

		else if($sl == 3){

			$query = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

			$rows = $query->num_rows();

			if($rows > 0){

				$data = array('pmobile' => $slr_data);

				$this->db->where('seller_id',$slr_id);

				$this->db->update('seller_account_information',$data);

				if($this->db->affected_rows() > 0){	

					$query1 = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

					return $query1->row()->pmobile;		

					//return true;

				}

			}else{

				$data = array('seller_id' => $slr_id,'pmobile' => $slr_data);

				$this->db->insert('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					return true;

				}

			}

		}

		else if($sl == 4){

			$query = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

			$rows = $query->num_rows();

			if($rows > 0){

				$data = array('business_name' => $slr_data);

				$this->db->where('seller_id',$slr_id);

				$this->db->update('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					$query1 = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

					return $query1->row()->business_name;	

				}

			}else{

				$data = array('seller_id' => $slr_id,'business_name' => $slr_data);

				$this->db->insert('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					return true;

				}

			}

		}

		else if($sl == 5){

			$query = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

			$rows = $query->num_rows();

			if($rows > 0){

				$data = array('business_desc' => $slr_data);

				$this->db->where('seller_id',$slr_id);

				$this->db->update('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

				$query1 = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

					return $query1->row()->business_desc;

				}

			}else{

				$data = array('seller_id' => $slr_id,'business_desc' => $slr_data);

				$this->db->insert('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					return true;

				}

			}

		}

		else if($sl == 6){

			$data = array('name' => $slr_data);

			$this->db->where('seller_id',$slr_id);

			$this->db->update('seller_account',$data);

			if($this->db->affected_rows() > 0){



				$query1 = $this->db->query("SELECT * FROM seller_account WHERE seller_id='$slr_id'");

					return $query1->row()->name;

			}

		}else if($sl == 7){

			$data = array('email' => $slr_data);

			$this->db->where('seller_id',$slr_id);

			$this->db->update('seller_account',$data);

			if($this->db->affected_rows() > 0){				

				$query1 = $this->db->query("SELECT * FROM seller_account WHERE seller_id='$slr_id'");

					return $query1->row()->email;

			}

		}else if($sl == 8){

			$data = array('mobile' => $slr_data);

			$this->db->where('seller_id',$slr_id);

			$this->db->update('seller_account',$data);

			if($this->db->affected_rows() > 0){			

				$query1 = $this->db->query("SELECT * FROM seller_account WHERE seller_id='$slr_id'");

					return $query1->row()->mobile;

			}

		}else if($sl == 9){

			$data = array('seller_address' => $slr_data);

			$this->db->where('seller_id',$slr_id);

			$this->db->update('seller_account',$data);

			if($this->db->affected_rows() > 0){

				$query1 = $this->db->query("SELECT * FROM seller_account WHERE seller_id='$slr_id'");

					return $query1->row()->seller_address;

			}

		}

		else if($sl == 10){

			$data = array('seller_city' => $slr_data);

			$this->db->where('seller_id',$slr_id);

			$this->db->update('seller_account',$data);

			if($this->db->affected_rows() > 0){

				$query1 = $this->db->query("SELECT * FROM seller_account WHERE seller_id='$slr_id'");

					return $query1->row()->seller_city;

			}

		}

		else if($sl == 11){

			$data = array('pincode' => $slr_data);

			$this->db->where('seller_id',$slr_id);

			$this->db->update('seller_account',$data);

			if($this->db->affected_rows() > 0){

				$query1 = $this->db->query("SELECT * FROM seller_account WHERE seller_id='$slr_id'");

					return $query1->row()->pincode;

			}

		}

		else if($sl == 12){

			/*$query = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

			$rows = $query->num_rows();

			if($rows > 0){

				$data = array('seller_state' => $slr_data);

				$this->db->where('seller_id',$slr_id);

				$this->db->update('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					$query1 = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

					return $query1->row()->seller_state;*/

					

			$data = array('seller_state' => $slr_data);

			$this->db->where('seller_id',$slr_id);

			$this->db->update('seller_account',$data);

			if($this->db->affected_rows() > 0){

				$query1 = $this->db->query("SELECT * FROM seller_account WHERE seller_id='$slr_id'");

					return $query1->row()->seller_state;

			}

				

		}

		else if($sl == 14){

			$query = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

			$rows = $query->num_rows();

			if($rows > 0){

				$data = array('ac_holder_name' => $slr_data);

				$this->db->where('seller_id',$slr_id);

				$this->db->update('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					$query1 = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

					return $query1->row()->ac_holder_name;

				}

			}else{

				$data = array('seller_id' => $slr_id,'ac_holder_name' => $slr_data);

				$this->db->insert('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					return true;

				}

			}

		}

		else if($sl == 15){

			$query = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

			$rows = $query->num_rows();

			if($rows > 0){

				$data = array('ac_number' => $slr_data);

				$this->db->where('seller_id',$slr_id);

				$this->db->update('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					$query1 = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

					return $query1->row()->ac_number;

				}

			}else{

				$data = array('seller_id' => $slr_id,'ac_number' => $slr_data);

				$this->db->insert('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					return true;

				}

			}

		}

		else if($sl == 16){

			$query = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

			$rows = $query->num_rows();

			if($rows > 0){

				$data = array('ifsc_code' => $slr_data);

				$this->db->where('seller_id',$slr_id);

				$this->db->update('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					$query1 = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

					return $query1->row()->ifsc_code;

				}

			}else{

				$data = array('seller_id' => $slr_id,'ifsc_code' => $slr_data);

				$this->db->insert('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					return true;

				}

			}

		}

		else if($sl == 17){

			$query = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

			$rows = $query->num_rows();

			if($rows > 0){

				$data = array('bank' => $slr_data);

				$this->db->where('seller_id',$slr_id);

				$this->db->update('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					$query1 = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

					return $query1->row()->bank;

				}

			}else{

				$data = array('seller_id' => $slr_id,'bank' => $slr_data);

				$this->db->insert('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					return true;

				}

			}

		}

		else if($sl == 18){

			$query = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

			$rows = $query->num_rows();

			if($rows > 0){

				$data = array('branch' => $slr_data);

				$this->db->where('seller_id',$slr_id);

				$this->db->update('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					$query1 = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

					return $query1->row()->branch;

				}

			}else{

				$data = array('seller_id' => $slr_id,'branch' => $slr_data);

				$this->db->insert('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					return true;

				}

			}

		}

		else if($sl == 22){

			$query = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

			$rows = $query->num_rows();

			if($rows > 0){

				$data = array('city' => $slr_data);

				$this->db->where('seller_id',$slr_id);

				$this->db->update('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					$query1 = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

					return $query1->row()->city;

				}

			}else{

				$data = array('seller_id' => $slr_id,'branch' => $slr_data);

				$this->db->insert('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					return true;

				}

			}

		}

		else if($sl == 23){

			$query = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

			$rows = $query->num_rows();

			if($rows > 0){

				$data = array('state' => $slr_data);

				$this->db->where('seller_id',$slr_id);

				$this->db->update('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					$query1 = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

					return $query1->row()->state;

				}

			}else{

				$data = array('seller_id' => $slr_id,'state' => $slr_data);

				$this->db->insert('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					return true;

				}

			}

		}

		else if($sl == 28){

			$query = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

			$rows = $query->num_rows();

			if($rows > 0){

				$data = array('display_name' => $slr_data);

				$this->db->where('seller_id',$slr_id);

				$this->db->update('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					$query1 = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

					return $query1->row()->display_name;

				}

			}else{

				$data = array('seller_id' => $slr_id,'display_name' => $slr_data);

				$this->db->insert('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					return true;

				}

			}

		}

		else if($sl == 29){

			$query = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

			$rows = $query->num_rows();

			if($rows > 0){

				$data = array('store_description' => $slr_data);

				$this->db->where('seller_id',$slr_id);

				$this->db->update('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					$query1 = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

					return $query1->row()->store_description;

				}

			}else{

				$data = array('seller_id' => $slr_id,'store_description' => $slr_data);

				$this->db->insert('seller_account_information',$data);

				if($this->db->affected_rows() > 0){

					return true;

				}

			}

		}

	}

	

	

	function update_inn_slr_proof($fileName){

		$case = $this->input->post('fldnm');

		$slr_id = $this->input->post('slr_id');

		$number = $this->input->post('cardno');

		$query = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

		$rows = $query->num_rows();

		if($rows > 0){

			if($fileName == ''){

				if($case == 'pan'){

					$data = array(

						'pan' => $number,

					);

					$this->db->where('seller_id',$slr_id);

					$this->db->update('seller_account_information',$data);

					return true;

				}

				else if($case == 'tin'){

					$data = array(

						'tin' => $number,				

					);

					$this->db->where('seller_id',$slr_id);

					$this->db->update('seller_account_information',$data);

					return true;

				}

				else if($case == 'tan'){

					$data = array(

						'tan' => $number,				

					);

					$this->db->where('seller_id',$slr_id);

					$this->db->update('seller_account_information',$data);

					return true;

				}
//----------------------------------sujit start for gstin-----------------------------//			
				else if($case == 'gstin'){

					$data = array(

						'gstin' => $number,				

					);

					$this->db->where('seller_id',$slr_id);

					$this->db->update('seller_account_information',$data);

					return true;

				}
//----------------------------------sujit end for gstin-----------------------------//				
			}else{

				if($case == 'pan'){

					$data = array(

						'pan' => $number,

						'pan_img' => $fileName,

					);

					$this->db->where('seller_id',$slr_id);

					$this->db->update('seller_account_information',$data);

					return true;

				}

				else if($case == 'tin'){

					$data = array(

						'tin' => $number,

						'tin_img' => $fileName,

					);

					$this->db->where('seller_id',$slr_id);

					$this->db->update('seller_account_information',$data);

					return true;

				}

				else if($case == 'tan'){

					$data = array(

						'tan' => $number,

						'tan_img' => $fileName,

					);

					$this->db->where('seller_id',$slr_id);

					$this->db->update('seller_account_information',$data);

					return true;

				}

//----------------------------------sujit start for gstin_img-----------------------------//
				else if($case == 'gstin'){

					$data = array(

						'gstin' => $number,

						'gstin_img' => $fileName,

					);

					$this->db->where('seller_id',$slr_id);

					$this->db->update('seller_account_information',$data);

					return true;

				}

//----------------------------------sujit end for gstin_img-----------------------------//

			}

		}else{

			if($case == 'pan'){

				$data = array(

					'seller_id' => $slr_id,

					'pan' => $number,

					'pan_img' => $fileName,

				);

				$this->db->insert('seller_account_information',$data);

				return true;

			}

			else if($case == 'tin'){

				$data = array(

					'seller_id' => $slr_id,

					'tin' => $number,

					'tin_img' => $fileName,

				);				

				$this->db->insert('seller_account_information',$data);

				return true;

			}

			else if($case == 'tan'){

				$data = array(

					'seller_id' => $slr_id,

					'tan' => $number,

					'tan_img' => $fileName,

				);				

				$this->db->insert('seller_account_information',$data);

				return true;

			}
//----------------------------sujit start else part for gstin_img & gstin--------------------------//
			else if($case == 'gstin'){

				$data = array(

					'seller_id' => $slr_id,

					'gstin' => $number,

					'gstin_img' => $fileName,

				);				

				$this->db->insert('seller_account_information',$data);

				return true;

			}
//-------------------------------sujit end else part for gstin_img & gstin------------------------//

		}

	}

	

	

	

	

	

	function update_kyc_details($fileName){

		$case = $this->input->post('fldnm');

		$slr_id = $this->input->post('slr_id');

		$number = $this->input->post('cardno');

		$query = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$slr_id'");

		$rows = $query->num_rows();

		if($rows > 0){

			if($fileName !== ''){

				if($case == 'address_img'){

					$data = array(

						'address_img' => $fileName,

					);

					$this->db->where('seller_id',$slr_id);

					$this->db->update('seller_account_information',$data);

					return true;

				}

				else if($case == 'id_proof'){

					$data = array(

						'ID_img' => $fileName,

					);

					$this->db->where('seller_id',$slr_id);

					$this->db->update('seller_account_information',$data);

					return true;

				}

				else if($case == 'cancle_cheque'){

					$data = array(

						'Cheque_img' => $fileName,

					);

					$this->db->where('seller_id',$slr_id);

					$this->db->update('seller_account_information',$data);

					return true;

				}

			}

		}else{

			if($case == 'address_img'){

				$data = array(

					'seller_id' => $slr_id,

					'address_img' => $fileName,

				);

				$this->db->insert('seller_account_information',$data);

				return true;

			}

			else if($case == 'id_proof'){

				$data = array(

					'seller_id' => $slr_id,

					'ID_img' => $fileName,

				);				

				$this->db->insert('seller_account_information',$data);

				return true;

			}

			else if($case == 'cancle_cheque'){

				$data = array(

					'seller_id' => $slr_id,

					'Cheque_img' => $fileName,

				);				

				$this->db->insert('seller_account_information',$data);

				return true;

			}

		}

	}

	// Admin adding products for seller starts

	function get_seller_product_id($table, $field){

		$query = $this->db->query("SELECT MAX($field) AS `maxid` FROM ".$table);

		$maxId = $query->row()->maxid;

		$id = $maxId+1;

		return $id;

	}

	

	function insert_new_product($seller_id){

		$sesson_seller_id = $this->session->userdata('seller_session_id');

		$seller_product_id = $this->get_seller_product_id('seller_product_setting', 'seller_product_id');

		$chars = 4;

		$letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

		$rand_letter = substr(str_shuffle($letters), 0, $chars);

		$sku1 = str_replace(' ','-',$this->input->post('sku'));

		$sku = $rand_letter.'-'.$seller_id.'-'.$sku1;

		

		$product_setting_data = array(

			'seller_product_id' => $seller_product_id,

			'seller_id' => $seller_id,

			'attribute_set' => $this->input->post('attribute_set'),

			//'product_type' => $this->input->post('product_type'),

		);

		$this->db->insert('seller_product_setting', $product_setting_data);

		

		$product_general_data = array(

			'seller_product_id' => $seller_product_id,

			'name' => $this->input->post('name'),

			'sku' => $sku,

			'description' => $this->input->post('description'),

			'short_desc' => serialize($this->input->post('seller_prodt_highlit[]')),

			'weight' => $this->input->post('weight'),

			'status' => $this->input->post('status'),

			'product_fr_dt' => $this->input->post('product_from_date'),

			'product_to_dt' => $this->input->post('product_to_date'),

			//'visibility' => $this->input->post('visibility'),

			'manufacture_country' => $this->input->post('country2'),

			'featured' => $this->input->post('featured'),

		); 

		$this->db->insert('seller_product_general_info', $product_general_data);

		

		/* On 26/10/15

		$shipping_fee_type = $this->input->post('shippingfee');

		if($shipping_fee_type == ''){

			$shipping_fee = $this->input->post('local_shipng_fee').','.$this->input->post('zonal_shipng_fee').','.$this->input->post('national_shipng_fee');

		}else if($shipping_fee_type == 'flat'){

			$shipping_fee = $this->input->post('flat_shipng_fee');

		}else{

			$shipping_fee = $this->input->post('shippingfee');

		}

		*/

		$shipping_fee_type = $this->input->post('shipping_typ');

		if($shipping_fee_type == 'Free'){

			$shipping_fee = 0;

			$shipping_fee_amount = 0;

		}else{

			$shipping_fee = $this->input->post('default_shipng_fee');

			$shipping_fee_amount = $this->input->post('hidden_shipping_fee');

		}

		

		$product_price_data = array(

			'seller_product_id' => $seller_product_id,

			'mrp' => $this->input->post('price'),

			'special_price' => $this->input->post('special_price'),

			'price' => $this->input->post('selling_price'),

			'price_fr_dt' => $this->input->post('price_from_date'),

			'price_to_dt' => $this->input->post('price_to_date'),

			'tax_amount' => $this->input->post('vat_cst'),

			'shipping_fee' => $shipping_fee,

			'shipping_fee_amount' => $shipping_fee_amount,

		);

		$this->db->insert('seller_product_price_info', $product_price_data);

		

		/*$img_list = implode(",", $arr_image);

		$product_image_data = array(

			'seller_product_id' => $seller_product_id,

			'image' => $img_list,

		);

		$this->db->insert('seller_product_image', $product_image_data);*/

				

		$product_meta_data = array(

			'seller_product_id' => $seller_product_id,

			'meta_title' => $this->input->post('meta_title'),

			'meta_keyword' => $this->input->post('meta_keyword'),

			'meta_description' => $this->input->post('meta_description'),

		);

		$this->db->insert('seller_product_meta_info', $product_meta_data);

		

		

		$product_inventory_data = array(

			'seller_product_id' => $seller_product_id,

			'quantity' => $this->input->post('qty'),

			//'max_quantity' => $this->input->post('max_qty_allowed'),

			//'qty_increment' => $this->input->post('qty_increment'),

			//'stock_avail' => $this->input->post('stock_avail'),

		);

		$this->db->insert('seller_product_inventory_info', $product_inventory_data);

		

		$product_categoy_data = array(

			'seller_product_id' => $seller_product_id,

			'category' => $this->input->post('subcategory_id'),

		);

		$this->db->insert('seller_product_category', $product_categoy_data);

		

		//Attribute program start here//

		

		//if($seller_id=='296')

//		{  // $seller_id."in model";exit;

//			$pattr_id = $this->input->post('hidden_attr_id');

//			$pattr_fld_name = $this->input->post('attr_fld_nm');

//			$pattr_value = $this->input->post('attr_value');

//			

//			$ctr_attrid=count($pattr_id);

//			$incrattb=0;

//				

//			foreach($pattr_value as $keyattvl=>$valattrvalue)

//			{

//				if($valattrvalue!='' && $incrattb<$ctr_attrid)

//				{

//					$attr_id[]=$pattr_id[$incrattb];

//					$attr_value[]=$valattrvalue;

//					$attr_fld_name[]=$pattr_fld_name[$incrattb];	

//				}

//				$incrattb++;

//						

//			}

//		}else

		

		//{

				

			$attr_id = $this->input->post('hidden_attr_id');

			$attr_fld_name = $this->input->post('attr_fld_nm');

			$attr_value = $this->input->post('attr_value');

		//}

		

		$attr_id_n_value = array_combine($attr_id,$attr_value);

		$attr_id_n_value_length = count($attr_id_n_value);

		

		for($i=0; $i<$attr_id_n_value_length; $i++){

			/*$attr_value = $attr_value[$i];

			if($attr_value == ''){

				$attr_value = NULL;

			}else{

				$attr_value = $attr_value;

			}*/

			

			if($attr_fld_name[$i] == 'Size'){

				if($attr_value[$i] != ''){

					$sz_sql = $this->db->query("SELECT size_id FROM size_master WHERE size_name='$attr_value[$i]'");

					$sz_row = $sz_sql->row();

					$sz_id = $sz_row->size_id;

					$product_sz_attr_data = array(

						'sku_id' => $sku,

						'm_size_id' => $sz_id,

						'm_size_name' => $attr_value[$i]

					);

					$this->db->insert('size_attr',$product_sz_attr_data);

				}

			}

			

			//progrm for sub size attribute

			if($attr_fld_name[$i] == 'Size Type'){

				if($attr_value[$i] != ''){

					$sb_sz_sql = $this->db->query("SELECT size_id FROM size_master WHERE size_name='$attr_value[$i]'");

					$sb_sz_row = $sb_sz_sql->row();

					$sb_sz_id = $sb_sz_row->size_id;

					$product_sb_sz_attr_data = array(

						'sku_id' => $sku,

						's_size_id' => $sb_sz_id,

						's_size_name' => $attr_value[$i]

					);

					

					//program start for checking if sku is exits or not in size_attr table and insert or update

					$sq = $this->db->query("SELECT * FROM size_attr WHERE sku_id='$sku'");

					if($sq->num_rows() > 0){

						$product_sb_sz_attr_data1 = array(

							's_size_id' => $sb_sz_id,

							's_size_name' => $attr_value[$i]

						);

						$this->db->where('sku_id',$sku);

						$this->db->update('size_attr',$product_sb_sz_attr_data1);

					}else{

						$this->db->insert('size_attr',$product_sb_sz_attr_data);

					}

					//program end of checking if sku is exits or not in size_attr table and insert or update

				}

			}

			

			if($attr_fld_name[$i] == 'Color'){

				if($attr_value[$i] != ''){

					$clor_sql = $this->db->query("SELECT color_id FROM color_master WHERE clr_name='$attr_value[$i]'");

					$clor_row = $clor_sql->row();

					$clor_id = $clor_row->color_id;

					$product_color_attr_data = array(

						'sku_id' => $sku,

						'color_id' => $clor_id,

						'clr_name' => $attr_value[$i]

					);

					$this->db->insert('color_attr',$product_color_attr_data);

				}

			}

			

			$product_attr_data = array(

				'seller_product_id' => $seller_product_id,

				'sku' => $sku,

				'attr_id' => $attr_id[$i],

				'attr_value' => $attr_value[$i],

			);

			

			$this->db->insert('seller_product_attribute_value',$product_attr_data);

		}

		//Attribute program end here//

		

		//program start for retrieve image from temp_imge table and insert in product_imag table//

		$query = $this->db->query("SELECT imag FROM temp_product_img WHERE seller_id='$seller_id' AND session_id='$sesson_seller_id'");

		foreach($query->result() as $img_row){

			$imag[] = $img_row->imag;

		}

		if($query->num_rows()>0)

		{

			@$image_zero=@$imag[0];	

		}else

		{

			@$image_zero='';

		}

		

		@$image = implode(',',@$imag);

		$image_data = array(

			'seller_product_id' => $seller_product_id,

			'image' => $image,

			'catelog_img_url' => 'catalog_'.$image_zero

		);

		$this->db->insert('seller_product_image',$image_data);

		//program end of retrieve image from temp_imge table and insert in product_imag table//

		

		//program start for delete image from temp_img table//

		$this->db->where('session_id',$sesson_seller_id);

		$this->db->where('seller_id',$seller_id);

		$this->db->delete('temp_product_img');

		//program end of delete image from temp_img table//	

		return true;

	}

	

	function insert_product_tmp_img($img_name, $seller_id){

		$sesson_seller_id = $this->session->userdata('seller_session_id');

		$img_strng = implode(',',$img_name);

		$data = array(

			'session_id' => $sesson_seller_id,

			'seller_id' => $seller_id,

			'imag' => $img_strng

		);

		$this->db->insert('temp_product_img',$data);

	}

	

	/* function delete_product_tmp_img($fileName, $seller_id){

		//$seller_id = $this->session->userdata('seller_session_id');

		$this->db->where('imag',$fileName);

		$this->db->where('seller_id',$seller_id);

		$this->db->delete('temp_product_img');

	} */

	

	function delete_product_tmp_img($fileName, $seller_id){

		$sesson_seller_id = $this->session->userdata('seller_session_id');

		$this->db->where('imag',$fileName);

		$this->db->where('seller_id',$seller_id);

		$this->db->where('session_id',$sesson_seller_id);

		$this->db->delete('temp_product_img');

	}

	

	

	function search_existing_product_list($search_tittle, $seller_id){

		//$seller_id = $this->session->userdata('seller-session');

		//$query = $this->db->query("SELECT a.*, b.status, c.*, d.imag, f.category_name 

//		FROM product_general_info a 

//		INNER JOIN product_setting b ON a.product_id = b.product_id

//		INNER JOIN product_image d ON a.product_id = d.product_id

//		INNER JOIN product_category e ON a.product_id = e.product_id

//		INNER JOIN category_indexing f ON e.category_id = f.category_id

//		INNER JOIN product_master c ON a.product_id = c.product_id

//		WHERE (a.name LIKE '$search_tittle%' OR a.name LIKE '%$search_tittle%' OR a.name LIKE '%$search_tittle')

//		AND c.product_id NOT IN (SELECT master_product_id FROM seller_product_master WHERE seller_id = '$seller_id')

//		AND b.status = 'Active' GROUP BY a.product_id");

		//$search_title1=preg_replace('#"#',' ',preg_replace("/'/",' ',preg_replace('#/#',' ',$search_tittle)));

		//$search_tittle=substr($search_title1,0,strpos($search_title1,' '));

		

		

		//$query=$this->db->query("select a.*, a.lvl2_name as category_name  from cornjob_productsearch a 		 

//		  WHERE a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active'

//		 AND (a.name LIKE '$search_tittle%' OR a.name LIKE '%$search_tittle%' OR a.name LIKE '%$search_tittle')

//		AND a.product_id NOT IN (SELECT master_product_id FROM seller_product_master WHERE seller_id = '$seller_id')

//		 group by a.product_id order by a.product_id DESC");

			

			$last_postslash=strripos($search_tittle,'/');

			$strpos_afterlastslash=$last_postslash+1;

			$sub_stringsku=substr($search_tittle,$strpos_afterlastslash);

		 	

		$query=$this->db->query("select a.*, a.lvl2_name as category_name  from cornjob_productsearch a 		 

		  WHERE a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active'

		 AND a.sku='$sub_stringsku'	 group by a.sku ");

		

		$row = $query->num_rows();

		if($row > 0){

			return $query->result();

		}

		else{

			return false;

		}

	}

	function getTaxClasses(){

		$query = $this->db->query("SELECT * FROM tax_management");

		return $query->result();

	}

	function getExistProductInfo($data){

		$product_id = $data['master_product_id']; 

		//$seller_id = $data['seller_id']; 

		$query = $this->db->query("SELECT a.*, b.*, c.*, d.*, e.*, f.* 

		FROM product_master a

		INNER JOIN product_general_info b ON a.product_id = b.product_id

		INNER JOIN product_setting c ON a.product_id = c.product_id

		INNER JOIN product_image d ON a.product_id = d.product_id

		INNER JOIN product_category e ON a.product_id = e.product_id

		INNER JOIN category_indexing f ON e.category_id = f.category_id

		WHERE a.product_id = '$product_id' AND a.id = (

		SELECT id FROM product_master WHERE product_id ='$product_id' GROUP BY product_id ORDER BY id ASC)");

		return $query->result();

	}

	

	function getExistProductattributeInfo($prod_id,$skuid)

	{

$query = $this->db->query("SELECT attribut_set FROM product_setting WHERE product_id='$prod_id'");

		$attr_group_id_res = $query->result();

		$attr_group_id=$attr_group_id_res[0]->attribut_set;

		

		$sql = $this->db->query("SELECT * FROM attribute_real WHERE attribute_group_id='$attr_group_id' AND (attribute_field_name='Color' OR attribute_field_name='Size' OR attribute_field_name='Size Type' OR attribute_field_name='Capacity' OR  attribute_field_name='RAM' OR  attribute_field_name='ROM' ) ");

		//$rows = $sql->num_rows();	

		

			return $sql->result();

		

	}

	

	function getProductAttrValues1($sku){

		$query1 = $this->db->query("SELECT * FROM product_attribute_value WHERE sku='$sku' ");

		$row = $query1->num_rows();

		if($row > 0){

			return $query1->result();

		}else{

			return false;

		}

	}

	

	function getProductMastersku($sku){

		$query = $this->db->query("SELECT * from product_master WHERE sku='$sku'");

		$row = $query->num_rows();

		if($row > 0){

			return true;

		}

		else{

			return false;

		}

	}

	function getSellerGeneralsku($sku){

		$query = $this->db->query("SELECT * from seller_product_general_info WHERE sku='$sku'");

		$row = $query->num_rows();

		if($row > 0){

			return true;

		}

		else{

			return false;

		}

	}

	function getSellerMastersku($sku){

		$query = $this->db->query("SELECT * from seller_product_master WHERE sku='$sku'");

		$row = $query->num_rows();

		if($row > 0){

			return true;

		}

		else{

			return false;

		}

	}

	

	function get_seller_productid($table, $field){

		$query = $this->db->query("SELECT MAX($field) AS `maxid` FROM ".$table);

		$maxId = $query->row()->maxid;

		$id = $maxId+1;

		return $id;

	}

/*	

	//comented by santanu dt:26-09-2016

	

	function insert_existing_product($seller_id){ 

		$seller_product_id = $this->get_seller_productid('seller_product_master', 'seller_exist_product_id');

		

		

		$shipping_fee_type = $this->input->post('shipping_typ');

		if($shipping_fee_type == 'Free'){

			$shipping_fee = 0;

			$shipping_fee_amount = 0;

		}else{

			$shipping_fee = $this->input->post('default_shipng_fee');

			$shipping_fee_amount = $this->input->post('hidden_shipping_fee');

		}

		

		

		$chars = 4;

		$letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

		$rand_letter = substr(str_shuffle($letters), 0, $chars);

		$sku1 = str_replace(' ','-',$this->input->post('sku'));

		$sku_modfied = $rand_letter.'-'.$seller_id.'-'.$sku1;

		

		$exist_product_data = array(

			'seller_id' => $seller_id,

			'seller_exist_product_id' => $seller_product_id,

			'master_product_id' => $this->input->post('hidden_master_productID'),

			'sku' => $sku_modfied,

			'set_product_as_nw_frm_dt' => $this->input->post('product_fr_date'),

			'set_product_as_nw_to_dt' => $this->input->post('product_to_date'),

			'status' => $this->input->post('status'),

			'manufacture_country' => $this->input->post('country2'),

			'mrp' => $this->input->post('price'),

			'price' => $this->input->post('selling_price'),

			'special_price' => $this->input->post('special_price'),

			'special_pric_from_dt' => $this->input->post('price_from_date'),

			'special_pric_to_dt' => $this->input->post('price_to_date'),

			'tax_amount' => $this->input->post('vat_cst'),

			'quantity' => $this->input->post('qty'),

			'shipping_fee' => $shipping_fee,

			'shipping_fee_amount' => $shipping_fee_amount,

		);

		$query = $this->db->insert('seller_product_master', $exist_product_data);

		

		

		if($query){

			return true;

		}else{

			return false;

		}

	}

	*/

	

	function insert_existing_product($seller_id){

		$seller_product_id = $this->get_seller_productid('seller_product_master', 'seller_exist_product_id');		

		$shipping_fee_type = $this->input->post('shipping_typ');

		if($shipping_fee_type == 'Free'){

			$shipping_fee = 0;

			$shipping_fee_amount = 0;

		}else{

			$shipping_fee = $this->input->post('default_shipng_fee');

			$shipping_fee_amount = $this->input->post('hidden_shipping_fee');

		}


		$chars = 4;

		$letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

		$rand_letter = substr(str_shuffle($letters), 0, $chars);

		$sku1 = str_replace(' ','-',$this->input->post('sku'));

		$sku_modfied = $rand_letter.'-'.$seller_id.'-'.$sku1;
		

		$exist_product_data = array(

			'seller_id' => $seller_id,

			'seller_exist_product_id' => $seller_product_id,

			'master_product_id' => $this->input->post('hidden_master_productID'),

			'sku' => $sku_modfied,

			'set_product_as_nw_frm_dt' => $this->input->post('product_fr_date'),

			'set_product_as_nw_to_dt' => $this->input->post('product_to_date'),

			'status' => $this->input->post('status'),

			'manufacture_country' => $this->input->post('country2'),

			'mrp' => $this->input->post('price'),

			'price' => $this->input->post('selling_price'),

			'special_price' => $this->input->post('special_price'),

			'special_pric_from_dt' => $this->input->post('price_from_date'),

			'special_pric_to_dt' => $this->input->post('price_to_date'),

			'tax_amount' => $this->input->post('vat_cst'),

			'quantity' => $this->input->post('qty'),

			'shipping_fee' => $shipping_fee,

			'shipping_fee_amount' => $shipping_fee_amount,

			'product_type'=>$this->input->post('prod_type')

		);

		$query = $this->db->insert('seller_product_master', $exist_product_data);

		//----------------------Attribute program start here--------------------------//

		

		//$attr_id = $this->input->post('hidden_attr_id');

//		$attr_fld_name = $this->input->post('attr_fld_nm');

//		$attr_value = $this->input->post('attr_value');

//		$attr_id_n_value = array_combine($attr_id,$attr_value);

//		$attr_id_n_value_length = count($attr_id_n_value);

		

		

			/*$attr_value = $attr_value[$i];

			if($attr_value == ''){

				$attr_value = NULL;

			}else{

				$attr_value = $attr_value;

			}*/

			$size_nm=$this->input->post('sizeattr_value');

			if($size_nm!='')
			{
					$sz_sql = $this->db->query("SELECT size_id FROM size_master WHERE size_name='$size_nm'");

					$sz_row = $sz_sql->row();

					$sz_id = $sz_row->size_id;

					$product_sz_attr_data = array(

						'sku_id' => $sku_modfied,

						'm_size_id' => $sz_id,

						'm_size_name' => $size_nm

					);

					$this->db->insert('size_attr',$product_sz_attr_data);

			} // if size not blank condition end


			//progrm for sub size attribute


				$sub_size=$this->input->post('attr_subsize');

				if($sub_size!='')
				{
					$sb_sz_sql = $this->db->query("SELECT size_id FROM size_master WHERE size_name='$sub_size'");

					$sb_sz_row = $sb_sz_sql->row();

					$sb_sz_id = $sb_sz_row->size_id;

					$product_sb_sz_attr_data = array(

						'sku_id' => $sku_modfied,

						's_size_id' => $sb_sz_id,

						's_size_name' => $sub_size

					);

					//program start for checking if sku is exits or not in size_attr table and insert or update

					$sq = $this->db->query("SELECT * FROM size_attr WHERE sku_id='$sku1'");

					if($sq->num_rows() > 0){

						$product_sb_sz_attr_data1 = array(

							's_size_id' => $sb_sz_id,

							's_size_name' => $sub_size

						);

						$this->db->where('sku_id',$sku_modfied);

						$this->db->update('size_attr',$product_sb_sz_attr_data1);

					}else{

						$this->db->insert('size_attr',$product_sb_sz_attr_data);

					}

					//program end of checking if sku is exits or not in size_attr table and insert or update

				

				} // subsize not blank end

				$color_attrb=$this->input->post('attr_color');

				if($color_attrb!='')
				{
					$clor_sql = $this->db->query("SELECT color_id FROM color_master WHERE clr_name='$color_attrb'");

					$clor_row = $clor_sql->row();

					$clor_id = $clor_row->color_id;

					$product_color_attr_data = array(

						'sku_id' => $sku_modfied,

						'color_id' => $clor_id,

						'clr_name' => $color_attrb

					);

					$this->db->insert('color_attr',$product_color_attr_data);

				}

			$attr_id=array();

			$attr_value=array();


			$capacity_attrid=$this->input->post('hidden_attrcapacity_id');

			$capacity_attrvalue=$this->input->post('cpacity');

			if($capacity_attrid!='' && $attr_value!='')
			{
					array_push($attr_id,$capacity_attrid);

					array_push($attr_value,$capacity_attrvalue);

			}

			$attrram_id=$this->input->post('hidden_attrram_id');

			$ram_attrvalue=$this->input->post('ram_memory');

			if($attrram_id!='' && $ram_attrvalue!='')
			{
					array_push($attr_id,$attrram_id);

					array_push($attr_value,$ram_attrvalue);
			}


			$attrrom_id=$this->input->post('hidden_attrrom_id');

			$rom_memoryattrvalue=$this->input->post('rom_memory');


			if($attrrom_id!='' && $rom_memoryattrvalue!='')
			{
					array_push($attr_id,$attrrom_id);

					array_push($attr_value,$rom_memoryattrvalue);

			}

			$attr_idcount=count($attr_id);

			$attr_valuecount=count($attr_value);


			if($attr_idcount!=0 && $attr_valuecount!=0 )
			{	$i=0;

				foreach($attr_id as $attrkey=>$attrval)
				{
					$product_attr_data = array(

						'seller_product_id' => $seller_product_id,

						'sku' => $sku_modfied,

						'attr_id' => $attr_id[$i],

						'attr_value' => $attr_value[$i],

					);


					$this->db->insert('seller_product_attribute_value',$product_attr_data);

					$i++;
				}
		}

		//----------------------Attribute program end here---------------------------//


		//-----------Product image insert start-------------------------------------//

			$sesson_seller_id = $this->session->userdata('seller_session_id');

			$query = $this->db->query("SELECT imag FROM temp_product_img WHERE seller_id='$seller_id' AND session_id='$sesson_seller_id'");

			if($query->num_rows()>0)
			{
				foreach($query->result() as $img_row){

					$imag[] = $img_row->imag;
				}

				$image = implode(',',$imag);

				$image_data = array(

					'seller_extproduct_id' => $seller_product_id,

					'image' => $image,

					'catelog_img_url' => 'catalog_'.$imag[0]

				);

				$this->db->insert('seller_existingproduct_image',$image_data);

				//program end of retrieve image from temp_imge table and insert in product_imag table//

				

				//program start for delete image from temp_img table//

				$this->db->where('session_id',$sesson_seller_id);

				$this->db->where('seller_id',$seller_id);

				$this->db->delete('temp_product_img');				

			} // temp image table check condtion end

		//------------product image insert end -------------------------------------//

		if($query){

			return true;

		}else{

			return false;

		}

	}

	

	function getCategories(){

		$query = $this->db->query("SELECT a. * FROM category_indexing a INNER JOIN category_master b 

		ON a.category_id = b.category_id WHERE b.active_status = 'yes' AND a.parent_id = 0 ");

		return $query->result();

	}

	

	// Admin adding products for seller End

	

	

	function select_courierlist()

	{

		$query=$this->db->query("select * from courier_info order by courier_id desc");

		$row_courier=$query->result();

		return $row_courier;	

	}

	

	function update_courierinfo()

	{

		$courier_id=$this->input->post('courier_id');

		$courier_nm=$this->input->post('edt_courier_name');

		$courier_url=$this->input->post('edt_courier_url');	

		

		$this->db->query("update courier_info set courier_name='$courier_nm' , courier_url='$courier_url' where courier_id='$courier_id' ");

	}

	

	function insert_newcourierinfo()

	{

			

			$courier_nm=$this->input->post('new_courier_name');

			$courier_url=$this->input->post('new_courier_url');	

			

			$data=array(

				

				'courier_name'=>$courier_nm,

				'courier_url'=>$courier_url

			);

			$this->db->insert('courier_info',$data);

			

	}

	

	function select_SellerTC()

	{

		$query_tc=$this->db->query("select * from seller_termsconditions");

		$row_tc=$query_tc->result();

		

		return 	$row_tc;

	

	}

	function getSellerTC_ForEdit()

	{

		$tc_content=$this->input->post('page_content');

		$this->db->query("update seller_termsconditions set tc_content='$tc_content' ");	

	}

	

	

	

	

	function retrieve_sales_report($limit,$start){

			$query = $this->db->query("SELECT a.order_id,a.seller_id, count(a.seller_id) as tot_order, b.business_name

			FROM ordered_product_from_addtocart a INNER JOIN seller_account_information b ON a.seller_id = b.seller_id 

			GROUP BY b.seller_id LIMIT ".$start.",".$limit."");

	

	return $query;

	}

	

	

	function retrive_sales_details_count(){

		$query = $this->db->query("SELECT a.seller_id

			FROM ordered_product_from_addtocart a INNER JOIN seller_account_information b ON a.seller_id = b.seller_id 

			GROUP BY b.seller_id");

		if($query->num_rows() > 0){

			return $query->num_rows();

		}else{

			return false;

		}

	}

	

	

	

	function search_seller_name(){

		$seller = $this->input->post('seller');

		$query = $this->db->query("SELECT b.business_name FROM ordered_product_from_addtocart AS a INNER JOIN seller_account_information AS b ON a.seller_id = b.seller_id where  b.business_name LIKE '$seller%' GROUP BY b.business_name");

		return $query;

	}

	

	

	function export_salereport($limit,$start)

	{

		$query = $this->db->query("SELECT a.order_id,a.seller_id, count(a.seller_id) as tot_order, b.business_name

			FROM ordered_product_from_addtocart a INNER JOIN seller_account_information b ON a.seller_id = b.seller_id 

			GROUP BY b.seller_id LIMIT ".$start.",".$limit."");

		

		

		return $query;	

	}

	

	function select_filter_sales_count(){

				$seller = $_REQUEST['seller'];	

				/*$totl_order = $_REQUEST['totl_order'];

				$sale = $_REQUEST['sale'];	

				$cancel = $_REQUEST['cancel'];

				$return = $_REQUEST['return'];

				$replacement = $_REQUEST['replacement'];*/

				$condition = "";

				

				

				

				if($seller != ""){

				$condition .= "b.business_name LIKE '%$seller%' " ;

				$query = $this->db->query("SELECT a.seller_id FROM ordered_product_from_addtocart AS a INNER JOIN seller_account_information AS b ON a.seller_id = b.seller_id 

			where ".$condition." ");

						return $query->num_rows();

					}

				

					

				if($condition == ""){

					$query = $this->db->query("SELECT a.seller_id FROM ordered_product_from_addtocart AS a INNER JOIN seller_account_information AS b ON a.seller_id = b.seller_id ");

					return $query->num_rows();

					}

				}

				

				

	

	

	

	

	function select_filtered_sales($limit,$start){

				$seller = $_REQUEST['seller'];	

				/*$totl_order = $_REQUEST['totl_order'];

				$sale = $_REQUEST['sale'];	

				$cancel = $_REQUEST['cancel'];

				$return = $_REQUEST['return'];

				$replacement = $_REQUEST['replacement'];*/

				$condition = "";

				

				

				

				if($seller != ""){

				$condition .= "b.business_name LIKE '%$seller%' " ;

				$query = $this->db->query("SELECT a.order_id,a.seller_id, count(a.seller_id) as tot_order, b.business_name

			FROM ordered_product_from_addtocart a INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE ".$condition."

			GROUP BY b.seller_id

			  LIMIT ".$start." , ".$limit."");

						return $query;

					}

				

					

				if($condition == ""){

					$query = $this->db->query("SELECT a.seller_id, count( a.seller_id ) as tot_order, b.business_name, a.product_order_status,count(a.product_order_status) as sale

			FROM ordered_product_from_addtocart a INNER JOIN seller_account_information b ON a.seller_id = b.seller_id 

			GROUP BY a.seller_id, b.business_name LIMIT ".$start.",".$limit."");

					return $query;

					}

				}

				

				

				

				

				

				

				

				function retrive_slr_details_count(){

		$query = $this->db->query("SELECT a.seller_id,a.register_date,a.status,b.business_name FROM seller_account a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id GROUP BY b.business_name ORDER BY a.register_date DESC ");

		if($query->num_rows() > 0){

			return $query->num_rows();

		}else{

			return false;

		}

	} 	

	

	

	function retrieve_slr_report($limit,$start){

			$query = $this->db->query("SELECT a.seller_id,a.register_date,a.status,b.business_name FROM seller_account a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id GROUP BY b.business_name ORDER BY a.register_date DESC  LIMIT ".$start.",".$limit." ");

	

	return $query;

	}

	

	

	

	function search_register_name(){

		$seller = $this->input->post('seller');

		$query = $this->db->query("SELECT a.seller_id,a.register_date,a.status,b.business_name FROM seller_account a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id where  b.business_name LIKE '$seller%' GROUP BY b.business_name");

		return $query;

	} 

	

	

	function export_slrreport($limit,$start)

	{

		$query = $this->db->query("SELECT a.seller_id,a.register_date,a.status,b.business_name FROM seller_account a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id GROUP BY b.business_name ORDER BY a.register_date DESC  LIMIT ".$start.",".$limit." ");

		

		

		return $query;	

	}

	

	

	

	function select_filter_slr_count(){

			$seller = $_REQUEST['seller'];	

			$slr_date_from = $_REQUEST['slr_date_from'];

			$slr_date_to = $_REQUEST['slr_date_to'];	

			$status = $_REQUEST['status'];

			$condition = "";

				

				if($seller != ""){

				$condition .= " b.business_name LIKE '%$seller%' " ;

				$query=$this->db->query("SELECT a.seller_id,a.register_date,a.status,b.business_name FROM seller_account a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id  where ".$condition." GROUP BY b.business_name ORDER BY a.register_date DESC ");

						return $query->num_rows();

					}

				if($slr_date_from!='' && $slr_date_to!='' ){

						$condition .= "DATE(a.register_date) between '$slr_date_from' and '$slr_date_to'" ;

						$query=$this->db->query("SELECT a.seller_id,a.register_date,a.status,b.business_name FROM seller_account a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id where ".$condition." GROUP BY b.business_name ORDER BY a.register_date DESC ");

						return $query->num_rows();

					}

				if( $status != "" ){

					 	$condition .= "a.status='$status'" ;

						$query=$this->db->query("SELECT a.seller_id,a.register_date,a.status,b.business_name FROM seller_account a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id where ".$condition." GROUP BY b.business_name ORDER BY a.register_date DESC ");

						return $query->num_rows();

					}

				if($condition == ""){

					$query=$this->db->query("SELECT a.seller_id,a.register_date,a.status,b.business_name FROM seller_account a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id GROUP BY b.business_name ORDER BY a.register_date DESC ");

					return $query->num_rows();

					}

				}

		

		function select_filtered_slr($limit,$start)

		{

			

			$seller = $_REQUEST['seller'];	

			$slr_date_from = $_REQUEST['slr_date_from'];

			$slr_date_to = $_REQUEST['slr_date_to'];	

			$status = $_REQUEST['status'];

			$condition = "";

				

				if($seller != ""){

				$condition .= " b.business_name LIKE '%$seller%' " ;

				$query=$this->db->query("SELECT a.seller_id,a.register_date,a.status,b.business_name FROM seller_account a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id  where ".$condition." GROUP BY b.business_name ORDER BY a.register_date DESC  LIMIT ".$start.", ".$limit."");

						return $query;

					}

				if($slr_date_from!='' && $slr_date_to!='' ){

						$condition .= "DATE(a.register_date) between '$slr_date_from' and '$slr_date_to'" ;

						$query=$this->db->query("SELECT a.seller_id,a.register_date,a.status,b.business_name FROM seller_account a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id where ".$condition." GROUP BY b.business_name ORDER BY a.register_date DESC  LIMIT ".$start.", ".$limit."");

						return $query;

					}

				if( $status != "" ){

					 	$condition .= "a.status='$status'" ;

						$query=$this->db->query("SELECT a.seller_id,a.register_date,a.status,b.business_name FROM seller_account a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id where ".$condition." GROUP BY b.business_name ORDER BY a.register_date DESC  LIMIT ".$start.", ".$limit."");

						return $query;

					}

				if($condition == ""){

					$query=$this->db->query("SELECT a.seller_id,a.register_date,a.status,b.business_name FROM seller_account a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id GROUP BY b.business_name ORDER BY a.register_date DESC  LIMIT ".$start.", ".$limit."");

					return $query;

					}

			

			}

				function retrieve_product_report($limit,$start){

			

			$query = $this->db->query("SELECT a.seller_id, a.product_id, a.price, a.mrp, a.special_price, a.tax_amount, a.quantity, a.status, a.approve_status, b.lvl2,b.lvl2_name, b.lvl1, b.lvl1_name ,b.lvlmain_name, c.business_name, b.name

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.sku = b.sku

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id GROUP BY b.sku ORDER BY b.product_id DESC  LIMIT ".$start.",".$limit.	" ");

		return $query;

	}

	function retrive_product_details_count(){

		

		$query = $this->db->query("SELECT a.seller_id, a.product_id

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.sku = b.sku

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id GROUP BY b.sku  ");

		if($query->num_rows() > 0){

			return $query->num_rows();

		}else{

			return false;

		}

		

	}

	

function search_prodseller_name(){

		$seller_name = $this->input->post('seller_name');

		$query = $this->db->query("SELECT c.business_name

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.product_id = b.product_id

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN product_general_info d ON a.product_id = d.product_id

		WHERE c.business_name LIKE '$seller_name%' GROUP BY c.business_name");

		return $query;

	}

	

	function search_prod_name(){

		$prod_name = $this->input->post('prod_name');

		$query = $this->db->query("SELECT b.name

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.product_id = b.product_id

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN product_general_info d ON a.product_id = d.product_id WHERE b.name LIKE '$prod_name%' GROUP BY b.name");

		return $query;

	}



function select_filter_product_count(){







			$cate_name = $_REQUEST['cate_name'];

			$prod_name = $_REQUEST['prod_name'];	

			$add_date = $_REQUEST['add_date'];

			$seller_name = $_REQUEST['seller_name'];

			$quantity = $_REQUEST['quantity'];

			$approve_status = $_REQUEST['approve_status'];

			$dispy_stas = $_REQUEST['dispy_stas'];

			$mrp = $_REQUEST['mrp'];

			$sell_price = $_REQUEST['sell_price'];

			$spec_price = $_REQUEST['spec_price'];

			$vat = $_REQUEST['vat'];

				

				$condition = "";

				

				

				

				

				

				if($cate_name != ""){

				$condition .= "b.lvl2_name LIKE '%$cate_name%' " ;

				/*$query = $this->db->query("SELECT a.seller_id, a.product_id, a.price, a.mrp, a.special_price, a.tax_amount, a.quantity, a.status, a.approve_status, b.lvl2,b.lvl2_name, b.lvl1, b.lvl1_name ,b.lvlmain_name, c.business_name, b.name

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.product_id = b.product_id

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN product_general_info d ON a.product_id = d.product_id where ".$condition."");*/

		

		

		$query = $this->db->query("SELECT  a.product_id,b.product_id

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.sku = b.sku

	    INNER JOIN product_general_info d ON a.product_id = a.product_id where ".$condition." GROUP BY b.sku ORDER BY b.product_id DESC");

						return $query->num_rows();

					}

					

					

				if($prod_name != ""){

				$condition .= " b.name LIKE '%$prod_name%' " ;

				$query = $this->db->query("SELECT a.seller_id, b.product_id

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.sku = b.sku

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN product_general_info d ON a.product_id = d.product_id where ".$condition." GROUP BY b.sku ORDER BY b.product_id DESC" );

						return $query->num_rows();

					}

					

					

				if( $add_date != "" ){

					 	$condition .= "e.date_added	like '%$add_date%'" ;

						//echo $sql="select a.order_id from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id where ".$condition." group by b.order_id order by a.id desc";

						$query = $this->db->query("SELECT  a.product_id

		FROM product_master a

		INNER JOIN seller_product_general_info q ON a.sku = q.sku

		INNER JOIN seller_product_setting e ON e.seller_product_id = q.seller_product_id

										 where ".$condition." ");

						//echo $query->num_rows();

						return $query->num_rows();

					}

				if( $seller_name != "" ){

					 	$condition .= "c.business_name LIKE '%$seller_name%'" ;

						$query = $this->db->query("SELECT a.product_id,b.product_id

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.sku = b.sku

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN product_general_info d ON a.product_id = d.product_id where ".$condition." GROUP BY b.sku ORDER BY b.product_id DESC");

						return $query->num_rows();

					}

				if( $quantity !='' ){

				  		$condition .= "a.quantity ='$quantity'" ;

						$query = $this->db->query("SELECT a.seller_id, a.product_id,b.product_id,

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.sku = b.sku

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN product_general_info d ON a.product_id = d.product_id where ".$condition." GROUP BY b.sku ORDER BY b.product_id DESC");

						return $query->num_rows();

					}

				if($approve_status != ''){

						$condition .= "a.approve_status = '$approve_status'" ;

						

						$query = $this->db->query("SELECT a.seller_id, b.product_id

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.sku = b.sku

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN product_general_info d ON a.product_id = d.product_id where ".$condition." GROUP BY b.sku ORDER BY b.product_id DESC");

						return $query->num_rows();

					}

					

					if($dispy_stas != ''){

						$condition .= "a.status = '$dispy_stas'" ;

						

						$query = $this->db->query("SELECT a.seller_id, b.product_id

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.sku = b.sku

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN product_general_info d ON a.product_id = d.product_id where ".$condition." GROUP BY b.sku ORDER BY b.product_id DESC");

						return $query->num_rows();

					}

					

					

					if($mrp != ''){

						$condition .= "a.mrp = '$mrp'" ;

						
						$query = $this->db->query("SELECT a.seller_id, b.product_id

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.sku = b.sku

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN product_general_info d ON a.product_id = d.product_id where ".$condition." GROUP BY b.sku ORDER BY b.product_id DESC");

						return $query->num_rows();

					}

					if($sell_price != ''){

						$condition .= "a.price = '$sell_price'" ;

						

						$query = $this->db->query("SELECT a.seller_id, b.product_id

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.sku = b.sku

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN product_general_info d ON a.product_id = d.product_id where ".$condition." GROUP BY b.sku ORDER BY b.product_id DESC");

						return $query->num_rows();

					}

					

					

					if($spec_price != ''){

						$condition .= "a.special_price = '$spec_price'" ;

						

						$query = $this->db->query("SELECT a.seller_id, b.product_id

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.sku = b.sku

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN product_general_info d ON a.product_id = d.product_id where ".$condition." GROUP BY b.sku ORDER BY b.product_id DESC");

						return $query->num_rows();

					}

					

					if($vat != ''){

						$condition .= "a.tax_amount = '$vat'" ;

						

						$query = $this->db->query("SELECT a.seller_id, b.product_id

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.sku = b.sku

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN product_general_info d ON a.product_id = d.product_id where ".$condition." GROUP BY b.sku ORDER BY b.product_id DESC");

						return $query->num_rows();

					}

					

					

				if($condition == ""){

					$query = $this->db->query("SELECT a.seller_id, b.product_id

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.sku = b.sku

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN product_general_info d ON a.product_id = d.product_id GROUP BY b.sku ORDER BY b.product_id DESC");

					return $query->num_rows();

					}

				}

				

				

				

				

				

				

		function select_filtered_product($limit,$start){



			$cate_name = $_REQUEST['cate_name'];

			$prod_name = $_REQUEST['prod_name'];	

			$add_date = $_REQUEST['add_date'];

			$seller_name = $_REQUEST['seller_name'];

			$quantity = $_REQUEST['quantity'];

			$approve_status = $_REQUEST['approve_status'];

			$dispy_stas = $_REQUEST['dispy_stas'];

			$mrp = $_REQUEST['mrp'];

			$sell_price = $_REQUEST['sell_price'];

			$spec_price = $_REQUEST['spec_price'];

			$vat = $_REQUEST['vat'];

				

				$condition = "";

				

				

				

				

				

				if($cate_name != ""){

				$condition .= " b.lvl2_name LIKE '%$cate_name%' " ;

				$query = $this->db->query("SELECT a.seller_id, a.product_id, a.price, a.mrp, a.special_price, a.tax_amount, a.quantity, a.status, a.approve_status, b.lvl2,b.lvl2_name, b.lvl1, b.lvl1_name ,b.lvlmain_name, c.business_name, b.name

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.sku = b.sku

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN product_general_info d ON a.product_id = d.product_id where ".$condition."  GROUP BY b.sku ORDER BY b.product_id DESC LIMIT ".$start." , ".$limit."");

						return $query;

					}

					

					

				if($prod_name != ""){

				$condition .= " b.name LIKE '%$prod_name%' " ;

				$query = $this->db->query("SELECT a.seller_id, a.product_id, a.price, a.mrp, a.special_price, a.tax_amount, a.quantity, a.status, a.approve_status, b.lvl2,b.lvl2_name, b.lvl1, b.lvl1_name ,b.lvlmain_name, c.business_name, b.name

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.sku = b.sku

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN product_general_info d ON a.product_id = d.product_id where ".$condition."  GROUP BY b.sku ORDER BY b.product_id DESC LIMIT ".$start." , ".$limit."");

			

						return $query;

					}

				if($add_date != "" ){

				

					 	$condition .= "e.date_added LIKE '%$add_date%'" ;

						$query = $this->db->query("SELECT a.seller_id, a.product_id, a.price, a.mrp, a.special_price, a.tax_amount, a.quantity, a.status, a.approve_status, b.lvl2,b.lvl2_name, b.lvl1, b.lvl1_name ,b.lvlmain_name, c.business_name, b.name,e.date_added

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.product_id = b.product_id

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN seller_product_general_info q ON b.sku = q.sku

		INNER JOIN seller_product_setting e ON e.seller_product_id = q.seller_product_id

										 where ".$condition." GROUP BY GROUP BY b.sku LIMIT ".$start." , ".$limit."");

										 return $query;

					}

				if( $seller_name != "" ){

					 	$condition .= "c.business_name LIKE '%$seller_name%'" ;

						$query = $this->db->query("SELECT a.seller_id, a.product_id, a.price, a.mrp, a.special_price, a.tax_amount, a.quantity, a.status, a.approve_status, b.lvl2,b.lvl2_name, b.lvl1, b.lvl1_name ,b.lvlmain_name, c.business_name, b.name

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.sku = b.sku

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN product_general_info d ON a.product_id = d.product_id where ".$condition." GROUP BY b.sku ORDER BY b.product_id DESC LIMIT ".$start." , ".$limit."");

						return $query;

					}

				if( $quantity !='' ){

				  		$condition .= "a.quantity ='$quantity'" ;

						$query = $this->db->query("SELECT a.seller_id, a.product_id, a.price, a.mrp, a.special_price, a.tax_amount, a.quantity, a.status, a.approve_status, b.lvl2,b.lvl2_name, b.lvl1, b.lvl1_name ,b.lvlmain_name, c.business_name, b.name

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.product_id = b.product_id

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN product_general_info d ON a.product_id = d.product_id where ".$condition."  GROUP BY b.sku ORDER BY b.product_id DESC LIMIT ".$start." , ".$limit."");

						return $query;

					}

				if($approve_status != ''){

						$condition .= "a.approve_status = '$approve_status'" ;

						

						$query = $this->db->query("SELECT a.seller_id, a.product_id, a.price, a.mrp, a.special_price, a.tax_amount, a.quantity, a.status, a.approve_status, b.lvl2,b.lvl2_name, b.lvl1, b.lvl1_name ,b.lvlmain_name, c.business_name, b.name

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.sku = b.sku

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN product_general_info d ON a.product_id = d.product_id where ".$condition." GROUP BY b.sku ORDER BY b.product_id DESC LIMIT ".$start." , ".$limit."");

						return $query;

					}

					

					if($dispy_stas != ''){

						$condition .= "a.status = '$dispy_stas'" ;

						

						$query = $this->db->query("SELECT a.seller_id, a.product_id, a.price, a.mrp, a.special_price, a.tax_amount, a.quantity, a.status, a.approve_status, b.lvl2,b.lvl2_name, b.lvl1, b.lvl1_name ,b.lvlmain_name, c.business_name, b.name

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.sku = b.sku

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN product_general_info d ON a.product_id = d.product_id where ".$condition." GROUP BY b.sku ORDER BY b.product_id DESC LIMIT ".$start." , ".$limit."");

						return $query;

					}

					

					

					if($mrp != ''){

						$condition .= "a.mrp = '$mrp'" ;

						

						$query = $this->db->query("SELECT a.seller_id, a.product_id, a.price, a.mrp, a.special_price, a.tax_amount, a.quantity, a.status, a.approve_status, b.lvl2,b.lvl2_name, b.lvl1, b.lvl1_name ,b.lvlmain_name, c.business_name, b.name

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.sku = b.sku

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN product_general_info d ON a.product_id = d.product_id where ".$condition." GROUP BY b.sku ORDER BY b.product_id DESC LIMIT ".$start." , ".$limit."");

						return $query;

					}

					if($sell_price != ''){

						$condition .= "a.price = '$sell_price'" ;

						

						$query = $this->db->query("SELECT a.seller_id, a.product_id, a.price, a.mrp, a.special_price, a.tax_amount, a.quantity, a.status, a.approve_status, b.lvl2,b.lvl2_name, b.lvl1, b.lvl1_name ,b.lvlmain_name, c.business_name, b.name

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.sku = b.sku

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN product_general_info d ON a.product_id = d.product_id where ".$condition." GROUP BY b.sku ORDER BY b.product_id DESC LIMIT ".$start." , ".$limit."");

						return $query;

					}

					

					

					if($spec_price != ''){

						$condition .= "a.special_price = '$spec_price'" ;

						

						$query = $this->db->query("SELECT a.seller_id, a.product_id, a.price, a.mrp, a.special_price, a.tax_amount, a.quantity, a.status, a.approve_status, b.lvl2,b.lvl2_name, b.lvl1, b.lvl1_name ,b.lvlmain_name, c.business_name, b.name

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.sku = b.sku

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN product_general_info d ON a.product_id = d.product_id where ".$condition." GROUP BY b.sku ORDER BY b.product_id DESC LIMIT ".$start." , ".$limit."");

						return $query;

					}

					

					if($vat != ''){

						$condition .= "a.tax_amount = '$vat'" ;

						

						$query = $this->db->query("SELECT a.seller_id, a.product_id, a.price, a.mrp, a.special_price, a.tax_amount, a.quantity, a.status, a.approve_status, b.lvl2,b.lvl2_name, b.lvl1, b.lvl1_name ,b.lvlmain_name, c.business_name, b.name

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.sku = b.sku

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN product_general_info d ON a.product_id = d.product_id where ".$condition." GROUP BY b.sku ORDER BY b.product_id DESC LIMIT ".$start." , ".$limit."");

						return $query;

					}

					

					

				if($condition == ""){

					$query = $this->db->query("SELECT a.seller_id, a.product_id, a.price, a.mrp, a.special_price, a.tax_amount, a.quantity, a.status, a.approve_status, b.lvl2,b.lvl2_name, b.lvl1, b.lvl1_name ,b.lvlmain_name, c.business_name, b.name

		FROM product_master a

		INNER JOIN cornjob_productsearch b ON a.sku = b.sku

		INNER JOIN seller_account_information c ON a.seller_id = c.seller_id

		INNER JOIN product_general_info d ON a.product_id = d.product_id GROUP BY b.sku ORDER BY b.product_id DESC LIMIT ".$start." , ".$limit."");

					return $query;

					}

				}

				

				

				

				

				function retrive_topselling_count(){

		

		$query = $this->db->query("SELECT a.product_id, count( a.product_id ) AS salesqnty, b.seller_id, c.product_id, b.business_name, c.name, e.status, e.approve_status

FROM ordered_product_from_addtocart a

INNER JOIN seller_account_information b ON a.seller_id = b.seller_id

INNER JOIN product_general_info c ON a.product_id = c.product_id

INNER JOIN product_master e ON a.product_id = e.product_id

WHERE a.product_order_status = 'Delivered'

GROUP BY a.sku

ORDER BY count( a.product_id ) DESC ");

		if($query->num_rows() > 0){

			return $query->num_rows();

		}else{

			return false;

		}

		

	}



function retrieve_topselling_report($limit,$start){

			

			$query = $this->db->query("SELECT a.product_id, count( a.product_id ) AS salesqnty, b.seller_id, c.product_id, b.business_name, c.name, e.status, e.approve_status

FROM ordered_product_from_addtocart a

INNER JOIN seller_account_information b ON a.seller_id = b.seller_id

INNER JOIN product_general_info c ON a.product_id = c.product_id

INNER JOIN product_master e ON a.product_id = e.product_id

WHERE a.product_order_status = 'Delivered'

GROUP BY a.sku

ORDER BY count( a.product_id ) DESC LIMIT ".$start.",".$limit.	"");

		return $query;

	}

	
function excel_topselling(){

			

			$query = $this->db->query("SELECT a.product_id, count( a.product_id ) AS salesqnty, b.seller_id, c.product_id, b.business_name, c.name, e.status, e.approve_status

FROM ordered_product_from_addtocart a

INNER JOIN seller_account_information b ON a.seller_id = b.seller_id

INNER JOIN product_general_info c ON a.product_id = c.product_id

INNER JOIN product_master e ON a.product_id = e.product_id

WHERE a.product_order_status = 'Delivered'

GROUP BY a.sku

ORDER BY count( a.product_id ) DESC LIMIT 5000");

		return $query;

	}
	function search_topseller(){

		$seller_name = $this->input->post('seller_name');

		$query = $this->db->query("SELECT b.business_name

FROM ordered_product_from_addtocart a

INNER JOIN seller_account_information b ON a.seller_id = b.seller_id

WHERE b.business_name LIKE '$seller_name%'

GROUP BY b.business_name");

		return $query;

	}

	

	function search_topprodnm(){

		$prod_name = $this->input->post('prod_name');

		$query = $this->db->query("SELECT a.product_id, count( a.product_id ) AS salesqnty, b.seller_id, c.product_id, b.business_name, c.name, e.status, e.approve_status

FROM ordered_product_from_addtocart a

INNER JOIN seller_account_information b ON a.seller_id = b.seller_id

INNER JOIN product_general_info c ON a.product_id = c.product_id

INNER JOIN product_master e ON a.product_id = e.product_id

WHERE a.product_order_status = 'Delivered' AND c.name LIKE '$prod_name%'

GROUP BY c.name 

");

		return $query;

	}

	

	

	

	function select_filter_topselling_count(){







			$prod_name = $_REQUEST['prod_name'];

			$seller_name = $_REQUEST['seller_name'];	

			//$selling_qnty = $_REQUEST['selling_qnty'];

			$approve_status = $_REQUEST['approve_status'];

			$dispy_stas = $_REQUEST['dispy_stas'];

				

				$condition = "";

				

				

				

				

				

				if($prod_name != ""){

				$condition .= "c.name LIKE '%$prod_name%' " ;

		

		$query = $this->db->query("SELECT a.product_id, count( a.product_id ) AS salesqnty, b.seller_id, c.product_id, b.business_name, c.name, e.status, e.approve_status

FROM ordered_product_from_addtocart a

INNER JOIN seller_account_information b ON a.seller_id = b.seller_id

INNER JOIN product_general_info c ON a.product_id = c.product_id

INNER JOIN product_master e ON a.product_id = e.product_id

WHERE a.product_order_status = 'Delivered' AND ".$condition."

GROUP BY a.sku

ORDER BY count( a.product_id ) DESC ");

						return $query->num_rows();

					}

					

					

				if($seller_name != ""){

				$condition .= " b.business_name LIKE '%$seller_name%' " ;

				$query = $this->db->query("SELECT a.product_id, count( a.product_id ) AS salesqnty, b.seller_id, c.product_id, b.business_name, c.name, e.status, e.approve_status

FROM ordered_product_from_addtocart a

INNER JOIN seller_account_information b ON a.seller_id = b.seller_id

INNER JOIN product_general_info c ON a.product_id = c.product_id

INNER JOIN product_master e ON a.product_id = e.product_id

WHERE a.product_order_status = 'Delivered' AND ".$condition."

GROUP BY a.sku

ORDER BY count(a.product_id) DESC " );

						return $query->num_rows();

					}

					

					

				/*if($selling_qnty != "" ){

					 	$condition .= "count( a.product_id ) = '$selling_qnty'" ;

						$query = $this->db->query("SELECT a.product_id, count( a.product_id ) AS salesqnty, b.seller_id, c.product_id, b.business_name, c.name, e.status, e.approve_status

FROM ordered_product_from_addtocart a

INNER JOIN seller_account_information b ON a.seller_id = b.seller_id

INNER JOIN product_general_info c ON a.product_id = c.product_id

INNER JOIN product_master e ON a.product_id = e.product_id

WHERE a.product_order_status = 'Delivered' AND ".$condition."

GROUP BY a.sku

ORDER BY count( a.product_id ) DESC");

							return $query->num_rows();

					}*/

				if($approve_status != "" ){

					 	$condition .= "e.approve_status ='$approve_status'" ;

						$query = $this->db->query("SELECT a.product_id, count( a.product_id ) AS salesqnty, b.seller_id, c.product_id, b.business_name, c.name, e.status, e.approve_status

FROM ordered_product_from_addtocart a

INNER JOIN seller_account_information b ON a.seller_id = b.seller_id

INNER JOIN product_general_info c ON a.product_id = c.product_id

INNER JOIN product_master e ON a.product_id = e.product_id

WHERE a.product_order_status = 'Delivered' AND ".$condition."

GROUP BY a.sku

ORDER BY count( a.product_id ) DESC");

						return $query->num_rows();

					}

				if($dispy_stas !='' ){

				  		$condition .= "e.status ='$dispy_stas'" ;

						$query = $this->db->query("SELECT a.product_id, count( a.product_id ) AS salesqnty, b.seller_id, c.product_id, b.business_name, c.name, e.status, e.approve_status

FROM ordered_product_from_addtocart a

INNER JOIN seller_account_information b ON a.seller_id = b.seller_id

INNER JOIN product_general_info c ON a.product_id = c.product_id

INNER JOIN product_master e ON a.product_id = e.product_id

WHERE a.product_order_status = 'Delivered' AND ".$condition."

GROUP BY a.sku

ORDER BY count( a.product_id ) DESC ");

						return $query->num_rows();

					}

				if($condition == ""){

					$query = $this->db->query("SELECT a.product_id, count( a.product_id ) AS salesqnty, b.seller_id, c.product_id, b.business_name, c.name, e.status, e.approve_status

FROM ordered_product_from_addtocart a

INNER JOIN seller_account_information b ON a.seller_id = b.seller_id

INNER JOIN product_general_info c ON a.product_id = c.product_id

INNER JOIN product_master e ON a.product_id = e.product_id

WHERE a.product_order_status = 'Delivered'

GROUP BY a.sku

ORDER BY count( a.product_id ) DESC");

					return $query->num_rows();

					}

				}

				

				

				

				

				

				

		function select_filtered_topselling($limit,$start){



			$prod_name = $_REQUEST['prod_name'];

			$seller_name = $_REQUEST['seller_name'];	

			//$selling_qnty = $_REQUEST['selling_qnty'];

			$approve_status = $_REQUEST['approve_status'];

			$dispy_stas = $_REQUEST['dispy_stas'];

				

				$condition = "";

				

				

				

				

				

				if($prod_name != ""){

				$condition .= "c.name LIKE '%$prod_name%' " ;

		

		$query = $this->db->query("SELECT a.product_id, count( a.product_id ) AS salesqnty, b.seller_id, c.product_id, b.business_name, c.name, e.status, e.approve_status

FROM ordered_product_from_addtocart a

INNER JOIN seller_account_information b ON a.seller_id = b.seller_id

INNER JOIN product_general_info c ON a.product_id = c.product_id

INNER JOIN product_master e ON a.product_id = e.product_id

WHERE a.product_order_status = 'Delivered' AND ".$condition."

GROUP BY a.sku

ORDER BY count( a.product_id ) DESC LIMIT ".$start." , ".$limit."");

						return $query;

					}

					

					

				if($seller_name != ""){

				$condition .= " b.business_name LIKE '%$seller_name%' " ;

				$query = $this->db->query("SELECT a.product_id, count( a.product_id ) AS salesqnty, b.seller_id, c.product_id, b.business_name, c.name, e.status, e.approve_status

FROM ordered_product_from_addtocart a

INNER JOIN seller_account_information b ON a.seller_id = b.seller_id

INNER JOIN product_general_info c ON a.product_id = c.product_id

INNER JOIN product_master e ON a.product_id = e.product_id

WHERE a.product_order_status = 'Delivered' AND ".$condition."

GROUP BY a.sku

ORDER BY count( a.product_id ) DESC LIMIT ".$start." , ".$limit."" );

						return $query;

					}

					

					

				/*if($selling_qnty != "" ){

					 	$condition .= "count( a.product_id ) = '$selling_qnty'" ;

						$query = $this->db->query("SELECT a.product_id, count( a.product_id ) AS salesqnty, b.seller_id, c.product_id, b.business_name, c.name, e.status, e.approve_status

FROM ordered_product_from_addtocart a

INNER JOIN seller_account_information b ON a.seller_id = b.seller_id

INNER JOIN product_general_info c ON a.product_id = c.product_id

INNER JOIN product_master e ON a.product_id = e.product_id

WHERE a.product_order_status = 'Delivered' AND ".$condition."

GROUP BY a.sku

ORDER BY count( a.product_id ) DESC LIMIT ".$start." , ".$limit."");

					 

							return $query;

					}*/

				if($approve_status != "" ){

					 	$condition .= "e.approve_status ='$approve_status'" ;

						$query = $this->db->query("SELECT a.product_id, count( a.product_id ) AS salesqnty, b.seller_id, c.product_id, b.business_name, c.name, e.status, e.approve_status

FROM ordered_product_from_addtocart a

INNER JOIN seller_account_information b ON a.seller_id = b.seller_id

INNER JOIN product_general_info c ON a.product_id = c.product_id

INNER JOIN product_master e ON a.product_id = e.product_id

WHERE a.product_order_status = 'Delivered' AND ".$condition."

GROUP BY a.sku

ORDER BY count( a.product_id ) DESC LIMIT ".$start." , ".$limit."");

						return $query;

					}

				if($dispy_stas !='' ){

				  		$condition .= "e.status ='$dispy_stas'" ;

						$query = $this->db->query("SELECT a.product_id, count( a.product_id ) AS salesqnty, b.seller_id, c.product_id, b.business_name, c.name, e.status, e.approve_status

FROM ordered_product_from_addtocart a

INNER JOIN seller_account_information b ON a.seller_id = b.seller_id

INNER JOIN product_general_info c ON a.product_id = c.product_id

INNER JOIN product_master e ON a.product_id = e.product_id

WHERE a.product_order_status = 'Delivered' AND ".$condition."

GROUP BY a.sku

ORDER BY count( a.product_id ) DESC LIMIT ".$start." , ".$limit." ");

						return $query;

					}

					

					

				if($condition == ""){

					$query = $this->db->query("SELECT a.product_id, count( a.product_id ) AS salesqnty, b.seller_id, c.product_id, b.business_name, c.name, e.status, e.approve_status

FROM ordered_product_from_addtocart a

INNER JOIN seller_account_information b ON a.seller_id = b.seller_id

INNER JOIN product_general_info c ON a.product_id = c.product_id

INNER JOIN product_master e ON a.product_id = e.product_id

WHERE a.product_order_status = 'Delivered'

GROUP BY a.sku

ORDER BY count( a.product_id ) DESC LIMIT ".$start." , ".$limit."");

					return $query;

					}

				}

				

				

				function retrive_buyer_count(){

		

		$query = $this->db->query("SELECT a.email, a.mob, a.user_id, b.user_id, b.order_id, count( b.user_id ) as totl_order , c.address, c.full_name

FROM user a

INNER JOIN ordered_product_from_addtocart b ON a.user_id = b.user_id

INNER JOIN user_address c ON a.address_id = c.address_id

GROUP BY a.user_id");

		if($query->num_rows() > 0){

			return $query->num_rows();

		}else{

			return false;

		}

		

	}



function retrieve_buyer_report($limit,$start){

			

			$query = $this->db->query("SELECT a.email, a.mob, a.user_id, b.user_id, b.order_id, count( b.user_id ) as totl_order , c.address, c.full_name

FROM user a

INNER JOIN ordered_product_from_addtocart b ON a.user_id = b.user_id

INNER JOIN user_address c ON a.address_id = c.address_id

GROUP BY a.user_id LIMIT ".$start.",".$limit.	"");

		return $query;

	}

	

	

	function export_byurreport($limit,$start){

			

			$query = $this->db->query("SELECT a.email, a.mob, a.user_id, b.user_id, b.order_id, count( b.user_id ) as totl_order , c.address, c.full_name

FROM user a

INNER JOIN ordered_product_from_addtocart b ON a.user_id = b.user_id

INNER JOIN user_address c ON a.address_id = c.address_id

GROUP BY a.user_id LIMIT ".$start.",".$limit."");

		return $query;

	}

	

	

	function select_filter_buyer_count(){







			$name = $_REQUEST['name'];

			$email = $_REQUEST['email'];	

			$phno = $_REQUEST['phno'];

			$address = $_REQUEST['address'];

			//$totl_order = $_REQUEST['totl_order'];

				

				$condition = "";

				

				

				

				

				

				if($name != ""){

				$condition .= "c.full_name LIKE '%$name%' " ;

		

		$query = $this->db->query("SELECT a.email, a.mob, a.user_id, b.user_id, b.order_id, count( b.user_id ) as totl_order , c.address, c.full_name

FROM user a

INNER JOIN ordered_product_from_addtocart b ON a.user_id = b.user_id

INNER JOIN user_address c ON a.address_id = c.address_id WHERE ".$condition."

GROUP BY a.user_id ");

						return $query->num_rows();

					}

					

					

				if($email != ""){

				$condition .= " a.email LIKE '%$email%' " ;

				$query = $this->db->query("SELECT a.email, a.mob, a.user_id, b.user_id, b.order_id, count( b.user_id ) as totl_order , c.address, c.full_name

FROM user a

INNER JOIN ordered_product_from_addtocart b ON a.user_id = b.user_id

INNER JOIN user_address c ON a.address_id = c.address_id WHERE ".$condition."

GROUP BY a.user_id" );

						return $query->num_rows();

					}

					

					

				if($phno != "" ){

					 	$condition .= "a.mob = '$phno'" ;

						$query = $this->db->query("SELECT a.email, a.mob, a.user_id, b.user_id, b.order_id, count( b.user_id ) as totl_order , c.address, c.full_name

FROM user a

INNER JOIN ordered_product_from_addtocart b ON a.user_id = b.user_id

INNER JOIN user_address c ON a.address_id = c.address_id WHERE ".$condition."

GROUP BY a.user_id");

							return $query->num_rows();

					}

				if($address != "" ){

					 	$condition .= "c.address LIKE '%$address%'" ;

						$query = $this->db->query("SELECT a.email, a.mob, a.user_id, b.user_id, b.order_id, count( b.user_id ) as totl_order , c.address, c.full_name

FROM user a

INNER JOIN ordered_product_from_addtocart b ON a.user_id = b.user_id

INNER JOIN user_address c ON a.address_id = c.address_id WHERE ".$condition."

GROUP BY a.user_id");

						return $query->num_rows();

					}

				/*if($totl_order !='' ){

				  		$condition .= "count( b.user_id ) ='$totl_order'" ;

						$query = $this->db->query("SELECT a.email, a.mob, a.user_id, b.user_id, b.order_id, count( b.user_id ) as totl_order , c.address, c.full_name

FROM user a

INNER JOIN ordered_product_from_addtocart b ON a.user_id = b.user_id

INNER JOIN user_address c ON a.address_id = c.address_id WHERE ".$condition."

GROUP BY a.user_id");

						return $query->num_rows();

					}*/

				if($condition == ""){

					$query = $this->db->query("SELECT a.email, a.mob, a.user_id, b.user_id, b.order_id, count( b.user_id ) as totl_order , c.address, c.full_name

FROM user a

INNER JOIN ordered_product_from_addtocart b ON a.user_id = b.user_id

INNER JOIN user_address c ON a.address_id = c.address_id

GROUP BY a.user_id ");

					return $query->num_rows();

					}

				}

				

				

				

				

				

				

		function select_filtered_buyer($limit,$start){



			$name = $_REQUEST['name'];

			$email = $_REQUEST['email'];	

			$phno = $_REQUEST['phno'];

			$address = $_REQUEST['address'];

			//$totl_order = $_REQUEST['totl_order'];

				

				$condition = "";

				

				

				

				

				

				if($name != ""){

				$condition .= "c.full_name LIKE '%$name%' " ;

		

		$query = $this->db->query("SELECT a.email, a.mob, a.user_id, b.user_id, b.order_id, count( b.user_id ) as totl_order , c.address, c.full_name

FROM user a

INNER JOIN ordered_product_from_addtocart b ON a.user_id = b.user_id

INNER JOIN user_address c ON a.address_id = c.address_id WHERE ".$condition."

GROUP BY a.user_id LIMIT ".$start." , ".$limit."");

						return $query;

					}

					

					

				if($email != ""){

				$condition .= " a.email LIKE '%$email%' " ;

				$query = $this->db->query("SELECT a.email, a.mob, a.user_id, b.user_id, b.order_id, count( b.user_id ) as totl_order , c.address, c.full_name

FROM user a

INNER JOIN ordered_product_from_addtocart b ON a.user_id = b.user_id

INNER JOIN user_address c ON a.address_id = c.address_id WHERE ".$condition."

GROUP BY a.user_id LIMIT ".$start." , ".$limit."" );

						return $query;

					}

					

					

				if($phno != "" ){

					 	$condition .= "a.mob = '$phno'" ;

						$query = $this->db->query("SELECT a.email, a.mob, a.user_id, b.user_id, b.order_id, count( b.user_id ) as totl_order , c.address, c.full_name

FROM user a

INNER JOIN ordered_product_from_addtocart b ON a.user_id = b.user_id

INNER JOIN user_address c ON a.address_id = c.address_id WHERE ".$condition."

GROUP BY a.user_id LIMIT ".$start." , ".$limit."");

					 

							return $query;

					}

				if($address != "" ){

					 	$condition .= "c.address LIKE '%$address%'" ;

						$query = $this->db->query("SELECT a.email, a.mob, a.user_id, b.user_id, b.order_id, count( b.user_id ) as totl_order , c.address, c.full_name

FROM user a

INNER JOIN ordered_product_from_addtocart b ON a.user_id = b.user_id

INNER JOIN user_address c ON a.address_id = c.address_id WHERE ".$condition."

GROUP BY a.user_id LIMIT ".$start." , ".$limit."");

						return $query;

					}

				/*if($totl_order !='' ){

				  		$condition .= "count( b.user_id ) ='$totl_order'" ;

						$query = $this->db->query("SELECT a.email, a.mob, a.user_id, b.user_id, b.order_id, count( b.user_id ) as totl_order , c.address, c.full_name

FROM user a

INNER JOIN ordered_product_from_addtocart b ON a.user_id = b.user_id

INNER JOIN user_address c ON a.address_id = c.address_id WHERE ".$condition."

GROUP BY a.user_id LIMIT ".$start." , ".$limit." ");

						return $query;

					}*/

					

					

				if($condition == ""){

					$query = $this->db->query("SELECT a.email, a.mob, a.user_id, b.user_id, b.order_id, count( b.user_id ) as totl_order , c.address, c.full_name

FROM user a

INNER JOIN ordered_product_from_addtocart b ON a.user_id = b.user_id

INNER JOIN user_address c ON a.address_id = c.address_id

GROUP BY a.user_id LIMIT ".$start.",".$limit.	"");

					return $query;

					}

				}

				

				

				function retrive_byrwallet_count(){

		

		$query = $this->db->query("SELECT a.user_id,a.fname,a.lname,a.email,a.mob,b.wallet_balance,sum(c.debit_amt) as debit,sum(c.credit_amt) as credit FROM user a 

													INNER JOIN wallet_info b ON a.user_id=b.user_id 

													INNER JOIN wallet_crdr c ON a.user_id=c.user_id

														GROUP BY a.user_id");

		if($query->num_rows() > 0){

			return $query->num_rows();

		}else{

			return false;

		}

		

	}



function retrieve_byrwallet_report($limit,$start){

			

			$query = $this->db->query("SELECT a.user_id,a.fname,a.lname,a.email,a.mob,b.wallet_balance,sum(c.debit_amt) as debit,sum(c.credit_amt) as credit FROM user a 

										INNER JOIN wallet_info b ON a.user_id=b.user_id 

										INNER JOIN wallet_crdr c ON a.user_id=c.user_id

										GROUP BY a.user_id LIMIT ".$start.",".$limit.	"");

		return $query;

	}	

	

	

	

	

	

	function export_byurwallet($limit,$start){

			

			$query = $this->db->query("SELECT a.user_id,a.fname,a.lname,a.email,a.mob,b.wallet_balance,sum(c.debit_amt) as debit,sum(c.credit_amt) as credit FROM user a 

										INNER JOIN wallet_info b ON a.user_id=b.user_id 

										INNER JOIN wallet_crdr c ON a.user_id=c.user_id

										GROUP BY a.user_id LIMIT ".$start.",".$limit."");

		return $query;

	}

	

	

	

	function select_filter_wallet_count(){







			$buyer = $_REQUEST['buyer'];

			$email = $_REQUEST['email'];

			$contact = $_REQUEST['contact'];

				

				$condition = "";

				

				

				

				

				

				if($buyer != ""){

				$condition .= "a.fname OR a.lname LIKE '%$buyer%' " ;

		

		$query = $this->db->query("SELECT a.user_id FROM user a 

													INNER JOIN wallet_info b ON a.user_id=b.user_id 

													INNER JOIN wallet_crdr c ON a.user_id=c.user_id WHERE ".$condition."

														GROUP BY a.user_id ");

						return $query->num_rows();

					}

					

					

				if($email != ""){

				$condition .= " a.email LIKE '%$email%' " ;

				$query = $this->db->query("SELECT a.user_id FROM user a 

													INNER JOIN wallet_info b ON a.user_id=b.user_id 

													INNER JOIN wallet_crdr c ON a.user_id=c.user_id WHERE ".$condition."

														GROUP BY a.user_id" );

						return $query->num_rows();

					}

					

					

				if($contact != "" ){

					 	$condition .= "a.mob = '$contact'" ;

						$query = $this->db->query("SELECT a.user_id FROM user a 

													INNER JOIN wallet_info b ON a.user_id=b.user_id 

													INNER JOIN wallet_crdr c ON a.user_id=c.user_id WHERE ".$condition."

														GROUP BY a.user_id");

							return $query->num_rows();

					}

				

				if($condition == ""){

					$query = $this->db->query("SELECT a.user_id FROM user a 

													INNER JOIN wallet_info b ON a.user_id=b.user_id 

													INNER JOIN wallet_crdr c ON a.user_id=c.user_id  

														GROUP BY a.user_id");

					return $query->num_rows();

					}

				}

				

				

				

				

				

				

		function select_filtered_wallet($limit,$start){



			$buyer = $_REQUEST['buyer'];

			$email = $_REQUEST['email'];

			$contact = $_REQUEST['contact'];

				

				$condition = "";

				

				

				

				

				

				if($buyer != ""){

				$condition .= "a.fname LIKE '%$buyer%' " ;

		

		$query = $this->db->query("SELECT a.user_id,a.fname,a.lname,a.email,a.mob,b.wallet_balance,sum(c.debit_amt) as debit,sum(c.credit_amt) as credit FROM user a 

													INNER JOIN wallet_info b ON a.user_id=b.user_id 

													INNER JOIN wallet_crdr c ON a.user_id=c.user_id WHERE ".$condition."

														GROUP BY a.user_id LIMIT ".$start.",".$limit.	"");

						return $query;

					}

					

					

				if($email != ""){

				$condition .= " a.email LIKE '%$email%' " ;

				$query = $this->db->query("SELECT a.user_id,a.fname,a.lname,a.email,a.mob,b.wallet_balance,sum(c.debit_amt) as debit,sum(c.credit_amt) as credit FROM user a 

													INNER JOIN wallet_info b ON a.user_id=b.user_id 

													INNER JOIN wallet_crdr c ON a.user_id=c.user_id WHERE ".$condition."

														GROUP BY a.user_id LIMIT ".$start.",".$limit.	"" );

						return $query;

					}

					

					

				if($contact != "" ){

					 	$condition .= "a.mob = '$contact'" ;

						$query = $this->db->query("SELECT a.user_id,a.fname,a.lname,a.email,a.mob,b.wallet_balance,sum(c.debit_amt) as debit,sum(c.credit_amt) as credit FROM user a 

													INNER JOIN wallet_info b ON a.user_id=b.user_id 

													INNER JOIN wallet_crdr c ON a.user_id=c.user_id WHERE ".$condition."

														GROUP BY a.user_id LIMIT ".$start.",".$limit.	"");

							return $query;

					}

				

				if($condition == ""){

					$query = $this->db->query("SELECT a.user_id,a.fname,a.lname,a.email,a.mob,b.wallet_balance,sum(c.debit_amt) as debit,sum(c.credit_amt) as credit FROM user a 

										INNER JOIN wallet_info b ON a.user_id=b.user_id 

										INNER JOIN wallet_crdr c ON a.user_id=c.user_id

										GROUP BY a.user_id LIMIT ".$start.",".$limit.	"");

					return $query;

					}

				}




function seller_productcount($seller_id){
		$query = $this->db->query("SELECT b.product_id
FROM product_master b 
INNER JOIN product_category e ON e.product_id = b.product_id
INNER JOIN product_general_info c ON c.product_id = b.product_id
INNER JOIN product_image d ON d.product_id = c.product_id
WHERE b.seller_id = '$seller_id' GROUP BY b.sku ");
		return $query->num_rows();
	}
	
	
	
				function seller_product($limit,$start,$seller_id){
			
			$query = $this->db->query("SELECT b.seller_id,b.product_id,b.quantity,b.price,b.tax_amount,b.special_pric_to_dt,b.shipping_fee,b.shipping_fee_amount,c.name, d.imag, b.mrp,b.special_price, b.approve_status, b.status, b.sku,e.category_id
FROM product_master b 
INNER JOIN product_category e ON e.product_id = b.product_id
INNER JOIN product_general_info c ON c.product_id = b.product_id
INNER JOIN product_image d ON d.product_id = c.product_id
WHERE b.seller_id = '$seller_id' GROUP BY b.sku ORDER BY b.product_id DESC LIMIT ".$start.",".$limit."");
		return $query;
	}
	
	function exportseller_allproduct($seller_id)
	{
		$query = $this->db->query("SELECT a.seller_product_id,a.master_product_id,a.product_approve,b.name,b.sku,c.catelog_img_url,d.category
FROM seller_product_setting a 
INNER JOIN seller_product_general_info b ON a.seller_product_id = b.seller_product_id
INNER JOIN seller_product_image c ON c.seller_product_id = a.seller_product_id 
INNER JOIN seller_product_category d ON d.seller_product_id = a.seller_product_id

WHERE a.seller_id = '$seller_id' GROUP BY b.sku ORDER BY a.id DESC ");
		return $query;	
	}
	

function bussiness_nm($seller_id){
			
			$query = $this->db->query("SELECT *
FROM seller_account_information WHERE seller_id = '$seller_id' ");
		return $query;
	}
	
	
	
	function getCommission(){
		$sl = $this->input->post('serial');
		//'$second_leable_cat_id' is the third label category id//
		$second_leable_cat_id = $this->input->post('cat_id');
		$selling_price = $this->input->post('price');
		$shipping_fee = $this->input->post('shipping_fee');
		$seller_id = $this->input->post('seller_id');
		$final_price = $selling_price+$shipping_fee;
		$sty_id = 'fcmsn'.$sl;
		
		$cdate = date('Y-m-d');
		//$seller_id = $this->session->userdata('seller-session');
		//special commission condition program start here//
		$query = $this->db->query("SELECT * FROM special_commission WHERE from_date<='$cdate' AND to_date>='$cdate' AND cat_id='$second_leable_cat_id'");
		$rows = $query->num_rows();
		if($rows > 0){
			$result = $query->result();
			$special_seller_id = unserialize($result[0]->seller_id);
			if($result[0]->seller_id == Null){ //if no seller id in this date range , applicable to all seller
				$spl_cmsn = $result[0]->commision;
				$spl_percent_decimal = $spl_cmsn/100;
				$spl_cmsn_amt = round($final_price*$spl_percent_decimal);
				echo '<span class="'.$sty_id.'">'.$spl_cmsn_amt.'</span><br/><br/>';
				echo '<span class="vspn">( '.$spl_cmsn.'% of total sale value)</span>';
			}else if(in_array($seller_id,$special_seller_id)){ //program for if exist
				//if(in_array($seller_id,$special_seller_id)){
					$spl_cmsn = $result[0]->commision;
					$spl_percent_decimal = $spl_cmsn/100;
					$spl_cmsn_amt = round($final_price*$spl_percent_decimal);
					echo '<span class="'.$sty_id.'">'.$spl_cmsn_amt.'</span><br/><br/>';
					echo '<span class="vspn">( '.$spl_cmsn.'% of total sale value)</span>';
				//}
			//special commission condition program end here//
			}else{
			//Membership commission condition program start here//
				$query = $this->db->query("SELECT * FROM membership_seller WHERE seller_id='$seller_id'");
				$row= $query->num_rows();
				if($row > 0){
					$result = $query->result();
					$memb_id = $result[0]->memb_id;
					$qr2 = $this->db->query("SELECT * FROM membership WHERE mbrshp_id='$memb_id'");
					$rs2 = $qr2->result();
					$MEMB_COLUMN = $rs2[0]->menbshp_column;
					$qr3 = $this->db->query("SELECT cat_id,`$MEMB_COLUMN` FROM membership_commission WHERE cat_id='$second_leable_cat_id'");
					$rw3 = $qr3->num_rows();
					if($rw3 > 0){
						$rs3 = $qr3->result();
						$memb_cmsn = $rs3[0]->$MEMB_COLUMN;
						$memb_percent_decimal = $memb_cmsn/100;
						$memb_cmsn_amt = round($final_price*$memb_percent_decimal);
						echo '<span class="'.$sty_id.'">'.$memb_cmsn_amt.'</span><br/><br/>';
						echo '<span class="vspn">( '.$memb_cmsn.'% of total sale value)</span>';
			//Membership commission condition program end here//
					}else{
			//Global commission condition program end here//
						$query = $this->db->query("SELECT * FROM global_commission WHERE cat_id='$second_leable_cat_id'");
						$rows = $query->num_rows();
						if($rows > 0){
							$rs4 = $query->result();
							$gbl_cmsn = $rs4[0]->commission;
							$gbl_percent_decimal = $gbl_cmsn/100;
							$gbl_cmsn_amt = round($final_price*$gbl_percent_decimal);
							echo '<span class="'.$sty_id.'">'.$gbl_cmsn_amt.'</span><br/><br/>';
							echo '<span class="vspn">( '.$gbl_cmsn.'% of total sale value)</span>';
			//Global commission condition program end here//
						}else{
							echo 'NOT';
						}
					}
				}else{
			//Global commission condition program end here//
					$query = $this->db->query("SELECT * FROM global_commission WHERE cat_id='$second_leable_cat_id'");
					$rows = $query->num_rows();
					if($rows > 0){
						$rs4 = $query->result();
						$gbl_cmsn = $rs4[0]->commission;
						$gbl_percent_decimal = $gbl_cmsn/100;
						$gbl_cmsn_amt = round($final_price*$gbl_percent_decimal);
						echo '<span class="'.$sty_id.'">'.$gbl_cmsn_amt.'</span><br/><br/>';
						echo '<span class="vspn">( '.$gbl_cmsn.'% of total sale value)</span>';
		//Global commission condition program end here//
					}else{
						echo 'NOT';
					}
				}
			}
		}else{
		//Membership commission condition program start here//
			$query = $this->db->query("SELECT * FROM membership_seller WHERE seller_id='$seller_id'");
			$row= $query->num_rows();
			if($row > 0){
				$result = $query->result();
				$memb_id = $result[0]->memb_id;
				$qr2 = $this->db->query("SELECT * FROM membership WHERE mbrshp_id='$memb_id'");
				$rs2 = $qr2->result();
				$MEMB_COLUMN = $rs2[0]->menbshp_column;
				$qr3 = $this->db->query("SELECT cat_id,`$MEMB_COLUMN` FROM membership_commission WHERE cat_id='$second_leable_cat_id'");
				$rw3 = $qr3->num_rows();
				if($rw3 > 0){
					$rs3 = $qr3->result();
					$memb_cmsn = $rs3[0]->$MEMB_COLUMN;
					$memb_percent_decimal = $memb_cmsn/100;
					$memb_cmsn_amt = round($final_price*$memb_percent_decimal);
					echo '<span class="'.$sty_id.'">'.$memb_cmsn_amt.'</span><br/><br/>';
					echo '<span class="vspn">( '.$memb_cmsn.'% of total sale value)</span>';
		//Membership commission condition program end here//
				}else{
		//Global commission condition program end here//
					$query = $this->db->query("SELECT * FROM global_commission WHERE cat_id='$second_leable_cat_id'");
					$rows = $query->num_rows();
					if($rows > 0){
						$rs4 = $query->result();
						$gbl_cmsn = $rs4[0]->commission;
						$gbl_percent_decimal = $gbl_cmsn/100;
						$gbl_cmsn_amt = round($final_price*$gbl_percent_decimal);
						echo '<span class="'.$sty_id.'">'.$gbl_cmsn_amt.'</span><br/><br/>';
						echo '<span class="vspn">( '.$gbl_cmsn.'% of total sale value)</span>';
		//Global commission condition program end here//
					}else{
						echo 'NOT';
					}
				}		
			}else{
		//Global commission condition program end here//
				$query = $this->db->query("SELECT * FROM global_commission WHERE cat_id='$second_leable_cat_id'");
				$rows = $query->num_rows();
				if($rows > 0){
					$rs4 = $query->result();
					$gbl_cmsn = $rs4[0]->commission;
					$gbl_percent_decimal = $gbl_cmsn/100;
					$gbl_cmsn_amt = round($final_price*$gbl_percent_decimal);
					echo '<span class="'.$sty_id.'">'.$gbl_cmsn_amt.'</span><br/><br/>';
					echo '<span class="vspn">( '.$gbl_cmsn.'% of total sale value)</span>';
		//Global commission condition program end here//
				}else{
					echo 'NOT';
				}
			}
		}
	}
	
	
	
	function select_filter_sellprod_count($seller_id){


			$prod_id = $_REQUEST['prod_id'];	
			$prod_nms = addslashes($_REQUEST['prod_nm']);
			$prod_nm = str_replace( array( '\'', '"', ',' ,'/', ';','*',' ', '<', '>' ), '', $prod_nms);
			$sku = $_REQUEST['sku'];
			$stock = $_REQUEST['stock'];	
			$mrp = $_REQUEST['mrp'];
			$sellprce = $_REQUEST['sellprce'];
			$specprce = $_REQUEST['specprce'];
			$status = $_REQUEST['status'];
			$stat = $_REQUEST['stat'];	
				$condition = "";
				
				
				
				
				if($prod_id != ""){
				$condition .= "b.product_id = '$prod_id' " ; 
		
		$query = $this->db->query("SELECT b.product_id
FROM product_master b 
INNER JOIN product_category e ON e.product_id = b.product_id
INNER JOIN product_general_info c ON c.product_id = b.product_id
INNER JOIN product_image d ON d.product_id = c.product_id
WHERE b.seller_id = '$seller_id' AND ".$condition." GROUP BY b.sku ");
						return $query->num_rows();
					}
					if($sku != ""){
				$condition .= "b.sku LIKE '%$sku%' " ; 
		
		$query = $this->db->query("SELECT b.product_id
FROM product_master b 
INNER JOIN product_category e ON e.product_id = b.product_id
INNER JOIN product_general_info c ON c.product_id = b.product_id
INNER JOIN product_image d ON d.product_id = c.product_id
WHERE b.seller_id = '$seller_id' AND ".$condition." GROUP BY b.sku ");
						return $query->num_rows();
					}
				if($prod_nm != ""){
				$condition .= "c.name LIKE '%$prod_nm%' " ;
		
		$query = $this->db->query("SELECT b.product_id
FROM product_master b 
INNER JOIN product_category e ON e.product_id = b.product_id
INNER JOIN product_general_info c ON c.product_id = b.product_id
INNER JOIN product_image d ON d.product_id = c.product_id
WHERE b.seller_id = '$seller_id' AND ".$condition." GROUP BY b.sku ");
						return $query->num_rows();
					}
					
					
				if($stock != ""){
				$condition .= "b.quantity ='$stock'" ;
				$query = $this->db->query("SELECT b.product_id
FROM product_master b ON 
INNER JOIN product_category e ON e.product_id = b.product_id
INNER JOIN product_general_info c ON c.product_id = b.product_id
INNER JOIN product_image d ON d.product_id = c.product_id
WHERE b.seller_id = '$seller_id' AND ".$condition." GROUP BY b.sku " );
						return $query->num_rows();
					}
					
					
				if($mrp != "" ){
					 	$condition .= "b.mrp ='$mrp'" ;
						$query = $this->db->query("SELECT b.product_id
FROM product_master b 
INNER JOIN product_category e ON e.product_id = b.product_id
INNER JOIN product_general_info c ON c.product_id = b.product_id
INNER JOIN product_image d ON d.product_id = c.product_id
WHERE b.seller_id = '$seller_id' AND ".$condition." GROUP BY b.sku ");
							return $query->num_rows();
					}
				if($sellprce != "" ){
					 	$condition .= "b.price = '$sellprce'" ;
						$query = $this->db->query("SELECT b.product_id
FROM product_master b 
INNER JOIN product_category e ON e.product_id = b.product_id
INNER JOIN product_general_info c ON c.product_id = b.product_id
INNER JOIN product_image d ON d.product_id = c.product_id
WHERE b.seller_id = '$seller_id' AND ".$condition." GROUP BY b.sku ");
						return $query->num_rows();
					}
				if($specprce !='' ){
				  		$condition .= "b.special_price ='$specprce'" ;
						$query = $this->db->query("SELECT b.product_id
FROM product_master b 
INNER JOIN product_category e ON e.product_id = b.product_id
INNER JOIN product_general_info c ON c.product_id = b.product_id
INNER JOIN product_image d ON d.product_id = c.product_id
WHERE b.seller_id = '$seller_id' AND ".$condition." GROUP BY b.sku ");
						return $query->num_rows();
					}
					
							
					if($status != ""){
				$condition .= "b.approve_status = '$status' " ;
		
		$query = $this->db->query("SELECT b.product_id
FROM product_master b 
INNER JOIN product_category e ON e.product_id = b.product_id
INNER JOIN product_general_info c ON c.product_id = b.product_id
INNER JOIN product_image d ON d.product_id = c.product_id
WHERE b.seller_id = '$seller_id' AND ".$condition." GROUP BY b.sku  
");
						return $query->num_rows();
					}
					
					
					
					
					if($stat != ""){
				$condition .= "b.status = '$stat' " ;
		
		$query = $this->db->query("SELECT b.product_id
FROM product_master b 
INNER JOIN product_category e ON e.product_id = b.product_id
INNER JOIN product_general_info c ON c.product_id = b.product_id
INNER JOIN product_image d ON d.product_id = c.product_id
WHERE b.seller_id = '$seller_id' AND ".$condition." GROUP BY b.sku  
");
						return $query->num_rows();
					}
					
					
					
					
					
					
					
					
				if($condition == ""){
					$query = $this->db->query("SELECT b.product_id
FROM product_master b 
INNER JOIN product_category e ON e.product_id = b.product_id
INNER JOIN product_general_info c ON c.product_id = b.product_id
INNER JOIN product_image d ON d.product_id = c.product_id
WHERE b.seller_id = '$seller_id' GROUP BY b.sku ");
					return $query->num_rows();
					}
				}	
				
				
				
				
				function select_filtered_sell_prod($limit,$start,$seller_id){


			$prod_id = $_REQUEST['prod_id'];
			$prod_nms = addslashes($_REQUEST['prod_nm']);
			$prod_nm = str_replace( array( '\'', '"', ',' ,'/', ';','*',' ', '<', '>' ), '', $prod_nms);
			$sku = $_REQUEST['sku'];
			$stock = $_REQUEST['stock'];	
			$mrp = $_REQUEST['mrp'];
			$sellprce = $_REQUEST['sellprce'];
			$specprce = $_REQUEST['specprce'];
			$status = $_REQUEST['status'];
			$stat = $_REQUEST['stat'];
				
				$condition = "";
				
				
				
				
				if($prod_id != ""){
				$condition .= "b.product_id = '$prod_id' " ; 
		
		$query = $this->db->query("SELECT b.seller_id,b.product_id,b.quantity,b.price,b.tax_amount,b.special_pric_to_dt,b.shipping_fee,b.shipping_fee_amount,c.name, d.imag, b.mrp,b.special_price, b.approve_status, b.status, b.sku,e.category_id
FROM product_master b 
INNER JOIN product_category e ON e.product_id = b.product_id
INNER JOIN product_general_info c ON c.product_id = b.product_id
INNER JOIN product_image d ON d.product_id = c.product_id
WHERE b.seller_id = '$seller_id' AND ".$condition." GROUP BY b.sku LIMIT ".$start." , ".$limit."");
						return $query;
					}
					if($sku != ""){
				$condition .= "b.sku LIKE '%$sku%' " ; 
		
		$query = $this->db->query("SELECT b.seller_id,b.product_id,b.quantity,b.price,b.tax_amount,b.special_pric_to_dt,b.shipping_fee,b.shipping_fee_amount,c.name, d.imag, b.mrp,b.special_price, b.approve_status, b.status, b.sku,e.category_id
FROM product_master b 
INNER JOIN product_category e ON e.product_id = b.product_id
INNER JOIN product_general_info c ON c.product_id = b.product_id
INNER JOIN product_image d ON d.product_id = c.product_id
WHERE b.seller_id = '$seller_id' AND ".$condition." GROUP BY b.sku LIMIT ".$start." , ".$limit."");
						return $query;
					}
				if($prod_nm != ""){
				$condition .= "c.name LIKE '%$prod_nm%' " ;
		
		$query = $this->db->query("SELECT b.seller_id,b.product_id,b.quantity,b.price,b.tax_amount,b.special_pric_to_dt,b.shipping_fee,b.shipping_fee_amount,c.name, d.imag, b.mrp,b.special_price, b.approve_status, b.status, b.sku,e.category_id
FROM product_master b 
INNER JOIN product_category e ON e.product_id = b.product_id
INNER JOIN product_general_info c ON c.product_id = b.product_id
INNER JOIN product_image d ON d.product_id = c.product_id
WHERE b.seller_id = '$seller_id' AND ".$condition." GROUP BY b.sku LIMIT ".$start.",".$limit."");
						return $query;
					}
					
					
				if($stock != ""){
				$condition .= " b.quantity ='$stock' " ;
				$query = $this->db->query("SELECT b.seller_id,b.product_id,b.quantity,b.price,b.tax_amount,b.special_pric_to_dt,b.shipping_fee,b.shipping_fee_amount,c.name, d.imag, b.mrp,b.special_price, b.approve_status, b.status, b.sku,e.category_id
FROM product_master b 
INNER JOIN product_category e ON e.product_id = b.product_id
INNER JOIN product_general_info c ON c.product_id = b.product_id
INNER JOIN product_image d ON d.product_id = c.product_id
WHERE b.seller_id = '$seller_id' AND ".$condition." GROUP BY b.sku ORDER BY b.product_id LIMIT ".$start.",".$limit."" );
						return $query;
					}
					
					
				if($mrp != "" ){
					 	$condition .= " b.mrp ='$mrp' " ;
						$query = $this->db->query("SELECT b.seller_id,b.product_id,b.quantity,b.price,b.tax_amount,b.special_pric_to_dt,b.shipping_fee,b.shipping_fee_amount,c.name, d.imag, b.mrp,b.special_price, b.approve_status, b.status, b.sku,e.category_id
FROM product_master b 
INNER JOIN product_category e ON e.product_id = b.product_id
INNER JOIN product_general_info c ON c.product_id = b.product_id
INNER JOIN product_image d ON d.product_id = c.product_id
WHERE b.seller_id = '$seller_id' AND ".$condition." GROUP BY b.sku LIMIT ".$start.",".$limit."");
							return $query;
					}
				if($sellprce != "" ){
					 	$condition .= "b.price ='$sellprce'" ;
						$query = $this->db->query("SELECT b.seller_id,b.product_id,b.quantity,b.price,b.tax_amount,b.special_pric_to_dt,b.shipping_fee,b.shipping_fee_amount,c.name, d.imag, b.mrp,b.special_price, b.approve_status, b.status, b.sku,e.category_id
FROM product_master b 
INNER JOIN product_category e ON e.product_id = b.product_id
INNER JOIN product_general_info c ON c.product_id = b.product_id
INNER JOIN product_image d ON d.product_id = c.product_id
WHERE b.seller_id = '$seller_id' AND ".$condition." GROUP BY b.sku LIMIT ".$start.",".$limit."");
						return $query;
					}
				if($specprce !='' ){
				  		$condition .= "b.special_price ='$specprce'" ;
						$query = $this->db->query("SELECT b.seller_id,b.product_id,b.quantity,b.price,b.tax_amount,b.special_pric_to_dt,b.shipping_fee,b.shipping_fee_amount,c.name, d.imag, b.mrp,b.special_price, b.approve_status, b.status, b.sku,e.category_id
FROM product_master b 
INNER JOIN product_category e ON e.product_id = b.product_id
INNER JOIN product_general_info c ON c.product_id = b.product_id
INNER JOIN product_image d ON d.product_id = c.product_id
WHERE b.seller_id = '$seller_id' AND ".$condition." GROUP BY b.sku LIMIT ".$start.",".$limit."");
						return $query;
					}
					
							
					if($status != ""){
				$condition .= "b.approve_status = '$status' " ;
		
		$query = $this->db->query("SELECT b.seller_id,b.product_id,b.quantity,b.price,b.tax_amount,b.special_pric_to_dt,b.shipping_fee,b.shipping_fee_amount,c.name, d.imag, b.mrp,b.special_price, b.approve_status, b.status, b.sku,e.category_id
FROM product_master b 
INNER JOIN product_category e ON e.product_id = b.product_id
INNER JOIN product_general_info c ON c.product_id = b.product_id
INNER JOIN product_image d ON d.product_id = c.product_id
WHERE b.seller_id = '$seller_id' AND ".$condition." GROUP BY b.sku LIMIT ".$start.",".$limit."
");
						return $query;
					}
					
					
					if($stat != ""){
				$condition .= "b.status = '$stat' " ;
		
		$query = $this->db->query("SELECT b.seller_id,b.product_id,b.quantity,b.price,b.tax_amount,b.special_pric_to_dt,b.shipping_fee,b.shipping_fee_amount,c.name, d.imag, b.mrp,b.special_price, b.approve_status, b.status, b.sku,e.category_id
FROM product_master b 
INNER JOIN product_category e ON e.product_id = b.product_id
INNER JOIN product_general_info c ON c.product_id = b.product_id
INNER JOIN product_image d ON d.product_id = c.product_id
WHERE b.seller_id = '$seller_id' AND ".$condition." GROUP BY b.sku LIMIT ".$start.",".$limit."
");
						return $query;
					}
					
					
					
					
					
					
				if($condition == ""){
					$query = $this->db->query("SELECT b.seller_id,b.product_id,b.quantity,b.price,b.tax_amount,b.special_pric_to_dt,b.shipping_fee,b.shipping_fee_amount,c.name, d.imag, b.mrp,b.special_price, b.approve_status,b.status, b.sku,e.category_id
FROM product_master b 
INNER JOIN product_category e ON e.product_id = b.product_id
INNER JOIN product_general_info c ON c.product_id = b.product_id
INNER JOIN product_image d ON d.product_id = c.product_id
WHERE b.seller_id = '$seller_id' GROUP BY b.sku LIMIT ".$start.",".$limit."");
					return $query;
					}
				}
}

?>