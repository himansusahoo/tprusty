<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seller_model extends CI_Model {
	
	function getSellers(){
		$query = $this->db->query("SELECT a.* , b.* 
		FROM seller_account a 
		INNER JOIN seller_account_information b ON a.seller_id = b.seller_id ORDER BY a.seller_id DESC");
		return $query->result();
	}
	function getSellersForAdminList(){
		$query = $this->db->query("SELECT * FROM seller_account ORDER BY seller_id DESC");
		return $query->result();
	}
	
	function filter_sellers_data()
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
	}
	
	function update_sellers_status($seller_id, $status){
		date_default_timezone_set('Asia/Calcutta');
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
		INNER JOIN seller_account h ON a.seller_id=h.seller_id AND h.status='Active' ORDER BY a.seller_product_id DESC");
		
		/*$query = $this->db->query("SELECT a.*,b.*,c.*,e.*,f.*,g.*,h.name AS seller_name FROM seller_product_setting a 
		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 
		INNER JOIN seller_product_price_info c ON a.seller_product_id=c.seller_product_id 	
		INNER JOIN seller_product_inventory_info e ON a.seller_product_id=e.seller_product_id 
		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id 
		INNER JOIN seller_product_category g ON a.seller_product_id=g.seller_product_id 
		INNER JOIN seller_account h ON a.seller_id=h.seller_id AND h.status='Active' ORDER BY a.seller_product_id DESC");*/
		return $query;
	}
	
	function filter_seller_product_data()
	{
		    $from_dt = $this->input->post('from_dt');
		   // print_r($shipment);exit;
			
			$to_dt = $this->input->post('to_dt');			
			//print_r($to_dt);exit;		
			$fltr_product_nm = $this->input->post('fltr_product_nm');
					
			$fltr_slr_nm = $this->input->post('fltr_slr_nm');
			//print_r($fltr_slr_nm);exit;
			$product_sts = $this->input->post('product_sts');
			//print_r($product_sts);exit;
			$condition = '';
			if( $from_dt!='' && $to_dt!='' && $fltr_product_nm=='' && $fltr_slr_nm=='' && $product_sts=='' ){
				    $condition .= "a.date_added>='$from_dt' and a.date_added<='$to_dt'" ;}
			
			if( $from_dt=='' && $to_dt=='' && $fltr_product_nm!='' && $fltr_slr_nm=='' && $product_sts=='' ){
				    $condition .= "b.name='$fltr_product_nm'";}	
			
			if( $from_dt=='' && $to_dt=='' && $fltr_product_nm=='' && $fltr_slr_nm!='' && $product_sts=='' ){
				    $condition .= "h.name='$fltr_slr_nm'";}
					
			if( $from_dt=='' && $to_dt=='' && $fltr_product_nm=='' && $fltr_slr_nm=='' && $product_sts!='' ){
				    $condition .= "a.product_approve='$product_sts'";}	
					
			if( $from_dt=='' && $to_dt=='' && $fltr_product_nm=='' && $fltr_slr_nm=='' && $product_sts=='' ){	
			$query = $this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,f.*,g.*,h.name AS seller_name FROM seller_product_setting a 
		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 
		INNER JOIN seller_product_price_info c ON a.seller_product_id=c.seller_product_id 
		INNER JOIN seller_product_meta_info d ON a.seller_product_id=d.seller_product_id 
		INNER JOIN seller_product_inventory_info e ON a.seller_product_id=e.seller_product_id 
		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id 
		INNER JOIN seller_product_category g ON a.seller_product_id=g.seller_product_id 
		INNER JOIN seller_account h ON a.seller_id=h.seller_id AND h.status='Active' ORDER BY a.seller_product_id DESC");
		return $query;	
			}
			
			//echo $condition;exit;		
			$query = $this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,f.*,g.*,h.name AS seller_name FROM seller_product_setting a 
		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 
		INNER JOIN seller_product_price_info c ON a.seller_product_id=c.seller_product_id 
		INNER JOIN seller_product_meta_info d ON a.seller_product_id=d.seller_product_id 
		INNER JOIN seller_product_inventory_info e ON a.seller_product_id=e.seller_product_id 
		INNER JOIN seller_product_image f ON a.seller_product_id=f.seller_product_id 
		INNER JOIN seller_product_category g ON a.seller_product_id=g.seller_product_id 
		INNER JOIN seller_account h ON a.seller_id=h.seller_id AND h.status='Active' where ".$condition." ORDER BY a.seller_product_id DESC");
		return $query;		
	}
	
	function retrive_seller_product_exiting_data(){
		$query = $this->db->query("SELECT a.*,b.*,c.*,d.*,f.*,g.name AS seller_name FROM product_setting a 
		INNER JOIN product_general_info b ON a.product_id=b.product_id 
		INNER JOIN product_image c ON a.product_id=c.product_id 
		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		INNER JOIN seller_account g ON f.seller_id=g.seller_id WHERE a.status='Active' AND g.status='Active' ORDER BY f.seller_exist_product_id DESC");
		return $query;
	}
	
	function filter_seller_existing_product()
	{
		   $from_dt = $this->input->post('from_dt1');
		   // print_r($shipment);exit;
			
			$to_dt = $this->input->post('to_dt1');			
			//print_r($to_dt);exit;		
			$fltr_product_nm = $this->input->post('fltr_product_nm1');
					
			$fltr_slr_nm = $this->input->post('fltr_slr_nm1');
			//print_r($fltr_product_nm);exit;
			$product_sts = $this->input->post('product_sts1');
			//print_r($product_sts);exit;
			$condition = '';
			if( $from_dt!='' && $to_dt!='' && $fltr_product_nm=='' && $fltr_slr_nm=='' && $product_sts=='' ){
				    $condition .= "f.current_date>='$from_dt' and f.current_date<='$to_dt'" ;}
			
			if( $from_dt=='' && $to_dt=='' && $fltr_product_nm!='' && $fltr_slr_nm=='' && $product_sts=='' ){
				    $condition .= "b.name='$fltr_product_nm'";}	
			
			if( $from_dt=='' && $to_dt=='' && $fltr_product_nm=='' && $fltr_slr_nm!='' && $product_sts=='' ){
				    $condition .= "g.name='$fltr_slr_nm'";}
					
			if( $from_dt=='' && $to_dt=='' && $fltr_product_nm=='' && $fltr_slr_nm=='' && $product_sts!='' ){
				    $condition .= "f.approve_status='$product_sts'";}
			
			if( $from_dt=='' && $to_dt=='' && $fltr_product_nm=='' && $fltr_slr_nm=='' && $product_sts=='' ){
				
				$query = $this->db->query("SELECT a.*,b.*,c.*,d.*,f.*,g.name AS seller_name FROM product_setting a 
		INNER JOIN product_general_info b ON a.product_id=b.product_id 
		INNER JOIN product_image c ON a.product_id=c.product_id 
		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		INNER JOIN seller_account g ON f.seller_id=g.seller_id WHERE a.status='Active' AND g.status='Active' ORDER BY f.seller_exist_product_id DESC");
		return $query;
				
			}
					//echo $condition;exit;
					
			$query = $this->db->query("SELECT a.*,b.*,c.*,d.*,f.*,g.name AS seller_name FROM product_setting a 
		INNER JOIN product_general_info b ON a.product_id=b.product_id 
		INNER JOIN product_image c ON a.product_id=c.product_id 
		INNER JOIN product_meta_info d ON a.product_id=d.product_id 
		INNER JOIN seller_product_master f ON a.product_id=f.master_product_id 
		INNER JOIN seller_account g ON f.seller_id=g.seller_id WHERE a.status='Active' AND g.status='Active' AND ".$condition." ORDER BY f.seller_exist_product_id DESC");
		return $query;		
	}
	
	function changed_seller_product_status(){
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
					
					//for($i=0; $i<$array_length; $i++){
						$product_master_data = array(
							'seller_id' => $result[$j]->seller_id,
							'product_id' => $product_id,
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
							'tax_class' => $result[$j]->tax_class,
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
							'imag' => $result[$j]->image
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
				}
			}
			return true;
		}
	}
	
	/*function insert_master_product_id($seller_product_id,$arr_product_id){
		$arr_length = count($seller_product_id);
		for($i=0; $i<=$arr_length-1; $i++){
			$query = $this->db->query("UPDATE seller_product_setting SET master_product_id='$arr_product_id[$i]' WHERE seller_product_id='$seller_product_id[$i]'");
		}
	}*/
	
	function insert_master_product_id($seller_product_id,$product_id){
			$query = $this->db->query("UPDATE seller_product_setting SET master_product_id='$product_id' WHERE seller_product_id='$seller_product_id'");
	}
	
	function changed_seller_exiting_product_status(){
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
						$seller_exit_product_data[] = array(
							'seller_id' =>$result2[$j]->seller_id,
							'product_id' =>$result2[$j]->master_product_id,
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
							'tax_class' =>$result2[$j]->tax_class,
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
		}else{
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
		date_default_timezone_set('Asia/Calcutta');
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
		//date_default_timezone_set('Asia/Calcutta');
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
		date_default_timezone_set('Asia/Calcutta');
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
	
	
	
	
}
?>