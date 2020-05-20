<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Model{	

	/*function insert_product_setting(){
		$this->load->model('Usermodel');
		$product_id = $this->Usermodel->get_unique_id('product_setting','product_id');
		$attrb_set=$this->input->post('attribute_set');
		$product_type=$this->input->post('product_type');
		
		$data=array(
			'product_id'=>$product_id,
			'attribut_set'=>$attrb_set,
			'product_type'=>$product_type
		);		
		$qr=$this->db->insert('product_setting',$data);
		return $product_id;
	}*/
	
	/*function insert_product_general_info(){
		$product_id = $this->input->post('product_id');
		$data = array(
			'product_id' => $product_id,
			'name' => $this->input->post('name'),
			'description' => $this->input->post('prdt_desc'),
			'short_desc' => $this->input->post('product_id'),
			'sku' => $this->input->post('sku'),
			'weight' => $this->input->post('weight'),
			'from_dt' => $this->input->post('from_date'),
			'to_dt' => $this->input->post('to_date'),
			'status' => $this->input->post('prdt_sts'),
			'visibility' => $this->input->post('prdt_visibility'),
			'manufacture_country' => $this->input->post('country2'),
			'featured' => $this->input->post('featured'),					
		);
		$this->db->insert('product_general_info',$data);
		return $product_id;
	}*/
	
	/*function insert_product_price_info(){
		$product_id = $this->input->post('product_id');
		$data = array(
			'product_id' => $product_id,
			'price' => $this->input->post('price'),
			'special_price' => $this->input->post('special_price'),
			'from_dt' => $this->input->post('from_date'),
			'to_dt' => $this->input->post('to_date'),
			'tax_class' => $this->input->post('tax_cls'),
		);
		$this->db->insert('product_price_info',$data);
		return $product_id;
	}*/
	
	function insert_product_data(){
		//$img_name = implode(',', $name_array);
		//$name_array_length = count($name_array);
		$sesson_seller_id = $this->session->userdata('seller_session_id');
		$this->load->model('Usermodel');
		$product_id = $this->Usermodel->get_unique_id('product_setting','product_id');
		
		if($this->input->post('country2') == -1){
			$country = '';
		}else{
			$country = $this->input->post('country2');
		}
		
		$shipping_fee_type = $this->input->post('shipping_typ');
		if($shipping_fee_type == 'Free'){
			$shipping_fee = 0;
			$shipping_fee_amount = 0;
		}else{
			$shipping_fee = $this->input->post('default_shipng_fee');
			$shipping_fee_amount = $this->input->post('hidden_shipping_fee');
		}
		
		//program start for sku generate//
		$prdt_name = $this->input->post('name');
		$first_three_char = substr($prdt_name, 0, 3);		
		date_default_timezone_set('Asia/Calcutta');
		$code = preg_replace("/[^0-9]+/","", date('Y-m-d H:i:s'));		
		$this->load->helper('string');
		$randon_strng = random_string('alnum',5);		
		$sku = strtoupper($first_three_char.$randon_strng.$product_id.$code);
		//program end of sku generate//
		
		$product_setting_data = array(
			'product_id'=>$product_id,
			'attribut_set'=>$this->input->post('attribute_set'),
			'product_type'=>$this->input->post('product_type'),
		);
		
		$product_master_data = array(
			'seller_id'=>0,
			'product_id'=>$product_id,
			'sku'=>$sku,
			'set_product_as_nw_frm_dt'=>$this->input->post('from_date'),
			'set_product_as_nw_to_dt'=>$this->input->post('to_date'),
			'status'=>$this->input->post('prdt_sts'),
			'manufacture_country'=>$country,
			'mrp'=>$this->input->post('mrp'),
			'price'=>$this->input->post('price'),
			'special_price'=>$this->input->post('special_price'),
			'special_pric_from_dt'=>$this->input->post('spcil_price_from_date'),
			'special_pric_to_dt'=>$this->input->post('spcil_price_to_date'),
			'tax_amount'=>$this->input->post('vat_cst'),
			'shipping_fee'=>$shipping_fee,
			'shipping_fee_amount' => $shipping_fee_amount,
			'quantity'=>$this->input->post('qty'),
			'max_qty_allowed_in_shopng_cart'=>$this->input->post('max_qty'),
			'enable_qty_increment'=>$this->input->post('enable_qty_increment'),
			'stock_availability'=>$this->input->post('stock_avail'),
		);
		
		$product_general_data = array(
			'product_id' => $product_id,
			'name' => $this->input->post('name'),
			'description' => addslashes($this->input->post('prdt_desc')),
			'short_desc' => serialize($this->input->post('prdt_short_desc')),
			'weight' => $this->input->post('weight'),
			'featured' => $this->input->post('featured'),
		);
		
		/*$product_price_data = array(
			'product_id' => $product_id,
			'price' => $this->input->post('price'),
			'special_price' => $this->input->post('special_price'),
			'from_dt' => $this->input->post('from_date'),
			'to_dt' => $this->input->post('to_date'),
			'tax_class' => $this->input->post('tax_cls'),
		);*/
		
		$product_meta_data = array(
			'product_id' => $product_id,
			'meta_title' => $this->input->post('meta_title'),
			'meta_keywords' => $this->input->post('meta_keyword'),
			'meta_desc' => $this->input->post('meta_description'),
		);		
		
		/*$product_inventory_data = array(
			'product_id' => $product_id,
			'quantity' => $this->input->post('qty'),
			'max_qty_allow_shopping' => $this->input->post('max_qty'),
			'enable_qty_increment' => $this->input->post('enable_qty_increment'),
			'stock_avail' => $this->input->post('stock_avail'),
		);*/
		
		$product_category_data = array(
			'product_id' => $product_id,
			'category_id' => $this->input->post('auto_category_name'),
		);
		
		/*$product_image_data = array(
			'product_id' => $product_id,
			'imag' => $img_name
		);*/
		
		$rltd_prdt_ids = $this->input->post('chk_product');
		if($rltd_prdt_ids == ''){
			$related_prdt_ids = '';
		}else{
			$related_prdt_ids = serialize($rltd_prdt_ids);
		}
		
		$product_related_data = array(
			'product_id' => $product_id,
			'sku_id' => $sku,
			'related_product_id' => $related_prdt_ids
		);
		
		$this->db->insert('product_master',$product_master_data);
		$this->db->insert('product_setting',$product_setting_data);
		$this->db->insert('product_general_info',$product_general_data);
		$this->db->insert('product_meta_info',$product_meta_data);
		$this->db->insert('product_category',$product_category_data);
		//$this->db->insert('product_image',$product_image_data);
		$this->db->insert('product_related',$product_related_data);		
		
		
		//Attribute program start here//
		$attr_id = $this->input->post('hidden_attr_id');
		$attr_fld_name = $this->input->post('attr_fld_nm');
		$attr_value = $this->input->post('attr_value');
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
				$clor_sql = $this->db->query("SELECT color_id FROM color_master WHERE clr_name='$attr_value[$i]'");
				if($clor_sql->num_rows() > 0){
					$clor_row = $clor_sql->row();
					$clor_id = $clor_row->color_id;
				}else{
					$clor_id = '';
				}
				$product_color_attr_data = array(
					'sku_id' => $sku,
					'color_id' => $clor_id,
					'clr_name' => $attr_value[$i]
				);
				$this->db->insert('color_attr',$product_color_attr_data);
			}
			
			$product_attr_data = array(
				'product_id' => $product_id,
				'sku' => $sku,
				'attr_id' => $attr_id[$i],
				'attr_value' =>$attr_value[$i]
			);
			$this->db->insert('product_attribute_value',$product_attr_data);
		}
		//Attribute program end here//

		//program start for retrieve image from temp_imge table and insert in product_imag table//
		$query = $this->db->query("SELECT imag FROM temp_product_img WHERE seller_id=0 AND session_id='$sesson_seller_id'");
		foreach($query->result() as $img_row){
			$imag[] = $img_row->imag;
		}
		$image = implode(',',$imag);
		$image_data = array(
			'product_id' => $product_id,
			'imag' => $image,
			'catelog_img_url' => 'catalog_'.$imag[0]
		);
		$this->db->insert('product_image',$image_data);
		//program end of retrieve image from temp_imge table and insert in product_imag table//
		
		//program start for delete image from temp_img table//
		$this->db->where('session_id',$sesson_seller_id);
		$this->db->where('seller_id',0);
		$this->db->delete('temp_product_img');
		//program end of delete image from temp_img table//
		return true;
	}
	
	function insert_product_data_log()
	{
		date_default_timezone_set('Asia/Calcutta');
		$cdate =date('y-m-d H:i:s');
		$uid= $this->session->userdata('logged_userrole_id');
		$uname=$this->session->userdata('logged_in');
		$product_name=$this->input->post('name');
		$log_data="This product(".$product_name.") has added as new product.";
		
				$data=array(
							
							'log_detail'=>$log_data,
							'user_id'=>$uid,
							'user_name'=>$uname,
							'log_datetime'=>$cdate
						);
						$this->db->insert('user_log',$data);		
		
	}
	
	// Product Update
	//function update_new_product(){
//		
//		$prodsetting_edited = $this->input->post('prod_setting');
//		$prodgeninfo_edited = $this->input->post('prod_geninfo');
//		
//		$prodmetapart_edited = $this->input->post('prod_metaedited');
//		
//		$sesson_seller_id = $this->session->userdata('seller_session_id');
//		//$img_name = implode(',', $arr_image);
//		$product_id = $this->input->post('hidden_product_id'); 
//		$seller_id = $this->input->post('hidden_product_sellerid');
//		$product_sku = $this->input->post('hidden_product_sku'); 
//		//$product_image = $this->input->post('hidden_product_image');  //echo $img_name; exit;
//		//echo $product_image;exit;
//		$query1 = $this->db->query("SELECT b.imag FROM product_master a INNER JOIN product_image b ON a.product_id = b.product_id WHERE a.sku ='$product_sku'");
//		$res = $query1->result();
//		$product_image=$res[0]->imag;
//		//var_dump($h);exit;
//		
//		//program start for if added any new image//
//		$tmp_img_sql = $this->db->query("SELECT imag FROM temp_product_img WHERE seller_id=0 AND session_id='$sesson_seller_id'");
//		$tmp_img_row = $tmp_img_sql->num_rows();
//		if($tmp_img_row > 0){
//			foreach($tmp_img_sql->result() as $img_row){
//				$tmp_img[] = $img_row->imag;
//			}
//			$tmp_product_img = implode(',',$tmp_img);
//		}else{
//			$tmp_product_img = '';
//		}
//				
//		//program end of if added any new image//
//		if($prodgeninfo_edited=='prodgeninfo_edited'){
//		$shipping_fee_type = $this->input->post('shipping_typ');
//		if($shipping_fee_type == 'Free'){
//			$shipping_fee = 0;
//			$shipping_fee_amount = 0;
//		}else{
//			$shipping_fee = $this->input->post('default_shipng_fee');
//			$shipping_fee_amount = $this->input->post('hidden_shipping_fee');
//		}
//		
//		/*$product_setting_data = array(
//			'attribut_set'=>$this->input->post('attribute_set'),
//		);
//		$this->db->where('product_id', $product_id);
//		$this->db->update('product_setting',$product_setting_data);*/
//		
//		$product_master_data = array(
//			'seller_id'=>$seller_id,
//			'sku'=>$this->input->post('sku1'),
//			'set_product_as_nw_frm_dt'=>$this->input->post('from_date'),
//			'set_product_as_nw_to_dt'=>$this->input->post('to_date'),
//			'status'=>$this->input->post('prdt_sts'),
//			'manufacture_country'=>$this->input->post('country2'),
//			'mrp'=>$this->input->post('mrp'),
//			'price'=>$this->input->post('price'),
//			'special_price'=>$this->input->post('special_price'),
//			'special_pric_from_dt'=>$this->input->post('spcil_price_from_date'),
//			'special_pric_to_dt'=>$this->input->post('spcil_price_to_date'),
//			'tax_amount'=>$this->input->post('vat_cst'),
//			'shipping_fee'=>$shipping_fee,
//			'shipping_fee_amount' => $shipping_fee_amount,
//			'quantity'=>$this->input->post('qty'),
//			'max_qty_allowed_in_shopng_cart'=>$this->input->post('max_qty'),
//			'enable_qty_increment'=>$this->input->post('enable_qty_increment'),
//			'stock_availability'=>$this->input->post('stock_avail'),
//		);
//		$this->db->where('product_id', $product_id);
//		$this->db->where('sku', $product_sku);
//		$this->db->update('product_master',$product_master_data);
//		
//		$product_general_data = array(
//			'name' => $this->input->post('name'),
//			'description' => addslashes($this->input->post('prdt_desc')),
//			'short_desc' => serialize($this->input->post('prdt_short_desc')),
//			'weight' => $this->input->post('weight'),
//			'featured' => $this->input->post('featured'),
//		);
//		
//		$this->db->where('product_id', $product_id);
//		$this->db->update('product_general_info',$product_general_data);
//		} // prod gen ifno & price edit or not checked end
//		
//		if($prodmetapart_edited =='prodmetainfo_edited'){
//		$product_meta_data = array(
//			'meta_title' => $this->input->post('meta_title'),
//			'meta_keywords' => $this->input->post('meta_keyword'),
//			'meta_desc' => $this->input->post('meta_description'),
//		);
//		$this->db->where('product_id', $product_id);
//		$this->db->update('product_meta_info', $product_meta_data);
//		}
//		/*$product_category_data = array(
//			'category_id' => $this->input->post('subcategory_id'),
//		);
//		$this->db->where('product_id', $product_id);
//		$this->db->update('product_category', $product_category_data);*/
//		
//		//echo $product_image.','.$img_name; exit;
//		if($tmp_product_img == ''){
//			$img_string = $product_image;
//		}else{
//			if($product_image == ''){
//				$img_string = $tmp_product_img;
//			}else{
//				$img_string = $product_image.','.$tmp_product_img;
//			}
//		}
//		$img_arr = explode(',',$img_string);
//		$product_image_data = array(
//			'imag' => $img_string,
//			'catelog_img_url' => 'catalog_'.$img_arr[0]
//		);
//		
//		$this->db->where('product_id', $product_id);
//		$this->db->update('product_image',$product_image_data);
//
//		//program start for delete image from temp_img table//
//		$this->db->where('session_id',$sesson_seller_id);
//		$this->db->where('seller_id',0);
//		$this->db->delete('temp_product_img');
//		//program end of delete image from temp_img table//
//		
//		//related product insert and update program start here//
//		$sku_id = $this->input->post('sku1');
//		$rltd_prdt_ids = $this->input->post('chk_product');
//		if($rltd_prdt_ids == ''){
//			$related_prdt_ids = '';
//		}else{
//			$related_prdt_ids = serialize($rltd_prdt_ids);
//		}
//		if(count($rltd_prdt_ids)>0){
//		$rel_qr = $this->db->query("SELECT * FROM product_related WHERE sku_id='$sku_id'");
//		$row = $rel_qr->num_rows();
//		if($row > 0){						
//			$product_related_data = array(
//				'product_id' => $product_id,
//				'related_product_id' => $related_prdt_ids
//			);			
//			$this->db->where('sku_id',$sku_id);
//			$this->db->update('product_related',$product_related_data);
//		}else{
//			$product_related_data = array(
//				'product_id' => $product_id,
//				'sku_id' => $sku_id,
//				'related_product_id' => $related_prdt_ids
//			);
//			$this->db->insert('product_related',$product_related_data);
//		}
//		//related product insert and update program end here//
//		}
//		
//		//program start for update seller product tables//
//		$slr_sql = $this->db->query("SELECT seller_product_id FROM seller_product_setting WHERE master_product_id='$product_id'");
//		if($slr_sql->num_rows() > 0){
//			if($prodgeninfo_edited=='prodgeninfo_edited'){
//				
//			$slr_res = $slr_sql->result();
//			$seller_product_id = $slr_res[0]->seller_product_id;
//			
//			//product general data
//			$slr_product_general_data = array(
//				'name' => $this->input->post('name'),
//				'description' => addslashes($this->input->post('prdt_desc')),
//				'short_desc' => serialize($this->input->post('prdt_short_desc')),
//				'weight' => $this->input->post('weight'),
//				'featured' => $this->input->post('featured'),
//				'product_fr_dt' => $this->input->post('from_date'),
//				'product_to_dt' => $this->input->post('to_date'),
//				'status' => $this->input->post('prdt_sts'),
//				'manufacture_country' => $this->input->post('country2')
//			);
//			$this->db->where('seller_product_id', $seller_product_id);
//			$this->db->update('seller_product_general_info',$slr_product_general_data);
//			
//			//product inventory data
//			$slr_product_inventory_data = array(
//				'quantity' => $this->input->post('qty'),
//				'stock_avail' => $this->input->post('stock_avail'),
//				'max_quantity'=>$this->input->post('max_qty'),
//				'qty_increment'=>$this->input->post('enable_qty_increment')
//			);
//			$this->db->where('seller_product_id', $seller_product_id);
//			$this->db->update('seller_product_inventory_info',$slr_product_inventory_data);
//			
//			//product price data
//			$slr_product_price_data = array(
//				'mrp' => $this->input->post('mrp'),
//				'price' => $this->input->post('price'),
//				'special_price' => $this->input->post('special_price'),
//				'price_fr_dt' => $this->input->post('spcil_price_from_date'),
//				'price_to_dt' => $this->input->post('spcil_price_to_date'),
//				'tax_amount' => $this->input->post('vat_cst'),
//				'shipping_fee' =>$shipping_fee,
//				'shipping_fee_amount' => $shipping_fee_amount
//			);
//			$this->db->where('seller_product_id', $seller_product_id);
//			$this->db->update('seller_product_price_info',$slr_product_price_data);
//		} // prod gen info & price editee or not checked end for seller
//			//product meta data
//			if($prodmetapart_edited =='prodmetainfo_edited'){
//				$slr_product_meta_data = array(
//					'meta_title' => $this->input->post('meta_title'),
//					'meta_keyword' => $this->input->post('meta_keyword'),
//					'meta_description' => $this->input->post('meta_description')
//				);
//				$this->db->where('seller_product_id', $seller_product_id);
//				$this->db->update('seller_product_meta_info',$slr_product_meta_data);
//			}
//			//product image data
//			$slr_product_image_data = array(
//				'image' => $img_string,
//				'catelog_img_url' => 'catalog_'.$img_arr[0]
//			);
//			$this->db->where('seller_product_id', $seller_product_id);
//			$this->db->update('seller_product_image',$slr_product_image_data);
//		}
//		//program end of update seller product tables//
//		
//		//attribute program start here//
//		if($prodsetting_edited =='prodsetting_edited'){
//			
//		$attr_id = $this->input->post('hidden_attr_id');
//		$attr_fld_name = $this->input->post('attr_fld_nm');
//		$attr_value = $this->input->post('attr_value');
//		$slr_attr_value = $this->input->post('slr_attr_value');
//		
//		//condition start for insert update in product_attribute_value table//
//	 // condition check for attribute id & value esit or not start	
//		if($slr_attr_value == ''){
//			if(count($attr_id)>0){
//			$attr_id_n_value = array_combine(@$attr_id,@$attr_value);
//			$attr_id_n_value_length = count($attr_id_n_value);
//			foreach($attr_id_n_value as $k => $v){
//				if($v != ''){
//					$atr_id[] = $k;
//					$atr_val[] = $v;
//				}
//			}
//			$entry_atrid_n_atrval = array_combine($atr_id,$atr_val);
//			
//			foreach($entry_atrid_n_atrval as $k => $v){
//				$qr = $this->db->query("SELECT * FROM product_attribute_value WHERE sku='$product_sku' AND attr_id='$k'");
//				if($qr->num_rows() > 0){
//					$attr_data = array(
//						'attr_value' => $v,
//					);
//					$this->db->where('sku',$product_sku);
//					$this->db->where('attr_id',$k);
//					$this->db->update('product_attribute_value',$attr_data);
//				}else{
//					$attr_data = array(
//						'product_id' => $product_id,
//						'sku' => $product_sku,
//						'attr_id' => $k,
//						'attr_value' => $v
//					);
//					$this->db->insert('product_attribute_value',$attr_data);
//				}
//			
//		}
//		//condition end of insert update in product_attribute_value table//
//			
//		//Program start for insert update color_attr table//
//			$fill_attr_id_length = count($atr_id); //attribute ids whose value is not blank or null
//			for($i=0; $i<$fill_attr_id_length; $i++){
//				$sql1 = $this->db->query("SELECT a.*,b.attr_value FROM attribute_real a INNER JOIN product_attribute_value b ON a.attribute_id=b.attr_id WHERE a.attribute_id='$atr_id[$i]' AND a.attribute_field_name='Color' AND b.sku='$product_sku'");
//				if($sql1->num_rows() > 0){
//					$res1 = $sql1->row();
//					//echo $res1->attribute_field_name;
//					//echo $res1->attribute_id;
//					//echo $res1->attr_value;
//					
//					//getting color id
//					$sql3 = $this->db->query("SELECT color_id FROM color_master WHERE clr_name='$res1->attr_value'");
//					$crow = $sql3->row();
//					$color_id = $crow->color_id;
//					
//					$sql2 = $this->db->query("SELECT * FROM color_attr WHERE sku_id='$product_sku'");
//					if($sql2->num_rows() > 0){
//						$color_attr_data = array(
//							'color_id' => $color_id,
//							'clr_name' => $res1->attr_value,
//						);
//						$this->db->where('sku_id',$product_sku);
//						$this->db->update('color_attr',$color_attr_data);
//					}else{
//						$color_attr_data = array(
//							'sku_id' => $product_sku,
//							'color_id' => $color_id,
//							'clr_name' => $res1->attr_value,
//						);
//						$this->db->insert('color_attr',$color_attr_data);
//					}
//				}
//			}
//			}// condition check for attribute id & value esit or not end
//		//Program end of insert update color_attr table//
//		}else{
//		//condition start for insert update in seller_product_attribute_value table//
//			//getting seller product id program start//
//			$qr1 = $this->db->query("SELECT seller_product_id FROM seller_product_general_info WHERE sku='$product_sku'");
//			$slr_product_id = $qr1->result()[0]->seller_product_id;
//			//getting seller product id program end//
//			if(count($attr_id)>0 ){ // condition check for attribute id & value esit or not start
//			
//			$attr_id_n_value = array_combine($attr_id,$slr_attr_value);
//			$attr_id_n_value_length = count($attr_id_n_value);
//			foreach($attr_id_n_value as $k => $v){
//				if($v != ''){
//					$atr_id[] = $k;
//					$atr_val[] = $v;
//				}
//			}
//			$entry_atrid_n_atrval = array_combine($atr_id,$atr_val);
//			
//			foreach($entry_atrid_n_atrval as $k => $v){
//				$qr = $this->db->query("SELECT * FROM seller_product_attribute_value WHERE sku='$product_sku' AND attr_id='$k'");
//				if($qr->num_rows() > 0){
//					$attr_data = array(
//						'attr_value' => $v,
//					);
//					$this->db->where('sku',$product_sku);
//					$this->db->where('attr_id',$k);
//					$this->db->update('seller_product_attribute_value',$attr_data);
//				}else{
//					$attr_data = array(
//						'seller_product_id' => $slr_product_id,
//						'sku' => $product_sku,
//						'attr_id' => $k,
//						'attr_value' => $v
//					);
//					$this->db->insert('seller_product_attribute_value',$attr_data);
//				}
//			}
//		//condition end of insert update in seller_product_attribute_value table//
//		
//		//Program start for insert update color_attr table//
//			$fill_attr_id_length = count($atr_id); //attribute ids whose value is not blank or null
//			for($i=0; $i<$fill_attr_id_length; $i++){
//				$sql1 = $this->db->query("SELECT a.*,b.attr_value FROM attribute_real a INNER JOIN seller_product_attribute_value b ON a.attribute_id=b.attr_id WHERE a.attribute_id='$atr_id[$i]' AND a.attribute_field_name='Color' AND b.sku='$product_sku'");
//				if($sql1->num_rows() > 0){
//					$res1 = $sql1->row();
//					//echo $res1->attribute_field_name;
//					//echo $res1->attribute_id;
//					//echo $res1->attr_value;
//					
//					//getting color id
//					$sql3 = $this->db->query("SELECT color_id FROM color_master WHERE clr_name='$res1->attr_value'");
//					$crow = $sql3->row();
//					$color_id = $crow->color_id;
//					
//					$sql2 = $this->db->query("SELECT * FROM color_attr WHERE sku_id='$product_sku'");
//					if($sql2->num_rows() > 0){
//						$color_attr_data = array(
//							'color_id' => $color_id,
//							'clr_name' => $res1->attr_value,
//						);
//						$this->db->where('sku_id',$product_sku);
//						$this->db->update('color_attr',$color_attr_data);
//					}else{
//						$color_attr_data = array(
//							'sku_id' => $product_sku,
//							'color_id' => $color_id,
//							'clr_name' => $res1->attr_value,
//						);
//						$this->db->insert('color_attr',$color_attr_data);
//					}
//				}
//			}
//			} // condition check for attribute id & value esit or not start
//		//Program end of insert update color_attr table//
//		}
//		//attribute program end here//
//		} // attribute edit or not checked
//		//Insert updated product id and sku in cornjob_product_update table
//		$updt_data = array(
//			'product_id' => $product_id,
//			'sku' => $product_sku
//		);
//		$this->db->insert('cornjob_product_update',$updt_data);
//		
//		return true;
//	}
	
		
	
	function update_new_product(){
		
		$prodsetting_edited = $this->input->post('prod_setting');
		$prodgeninfo_edited = $this->input->post('prod_geninfo');
		
		$prodmetapart_edited = $this->input->post('prod_metaedited');
		
		$sesson_seller_id = $this->session->userdata('seller_session_id');
		//$img_name = implode(',', $arr_image);
		$product_id = $this->input->post('hidden_product_id'); 
		$seller_id = $this->input->post('hidden_product_sellerid');
		$product_sku = $this->input->post('hidden_product_sku');
		
		$cronjob_prodnm=$this->input->post('name');
		$cronjob_status=$this->input->post('prdt_sts');
		$cronjob_mrp=$this->input->post('mrp'); 
		$cronjob_saleprice=$this->input->post('price');		
		$cronjob_specialprice=$this->input->post('special_price');
		$cronjob_splpricefromdate=$this->input->post('spcil_price_from_date'); 
		$cronjob_splpricetodate=$this->input->post('spcil_price_to_date');
		$cronjob_quantity=$this->input->post('qty');
		
		$cronjob_brand= '';
		$cronjob_size= '';
		$cronjob_subsize= '';
		$cronjob_occasion= '';
		$cronjob_capacity= '';	
		$cronjob_RAM= '';
		$cronjob_ROM= '';
		
		date_default_timezone_set('Asia/Calcutta');
		$cur_price=0;
		$curdate=date('Y-m-d');
		//if($cronjob_splpricefromdate!='0000-00-00' && $cronjob_splpricetodate!='0000-00-00')
		//{
			if($curdate>=$cronjob_splpricefromdate && $curdate<=$cronjob_splpricetodate)
			{if($cronjob_specialprice!=0){$cronjob_curprice=$cronjob_specialprice;} }	
		//}
		else if($cronjob_saleprice!='' && $cronjob_saleprice>0)
		{$cronjob_curprice=$cronjob_saleprice;}
		else
		{$cronjob_curprice=$cronjob_mrp;}
		
		
		$query1 = $this->db->query("SELECT b.imag FROM product_master a INNER JOIN product_image b ON a.product_id = b.product_id WHERE a.sku ='$product_sku'");
		$res = $query1->result();
		$product_image=$res[0]->imag;
		
		
		//program start for if added any new image//
		$tmp_img_sql = $this->db->query("SELECT imag FROM temp_product_img WHERE seller_id=0 AND session_id='$sesson_seller_id'");
		$tmp_img_row = $tmp_img_sql->num_rows();
		if($tmp_img_row > 0){
			foreach($tmp_img_sql->result() as $img_row){
				$tmp_img[] = $img_row->imag;
			}
			$tmp_product_img = implode(',',$tmp_img);
		}else{
			$tmp_product_img = '';
		}
				
		//program end of if added any new image//
		//if($prodgeninfo_edited=='prodgeninfo_edited')
		//{
		$shipping_fee_type = $this->input->post('shipping_typ');
		if($shipping_fee_type == 'Free'){
			$shipping_fee = 0;
			$shipping_fee_amount = 0;
		}else{
			$shipping_fee = $this->input->post('default_shipng_fee');
			$shipping_fee_amount = $this->input->post('hidden_shipping_fee');
		}
		
		/*$product_setting_data = array(
			'attribut_set'=>$this->input->post('attribute_set'),
		);
		$this->db->where('product_id', $product_id);
		$this->db->update('product_setting',$product_setting_data);*/
		
		$product_master_data = array(
			'seller_id'=>$seller_id,
			'sku'=>$this->input->post('sku1'),
			'set_product_as_nw_frm_dt'=>$this->input->post('from_date'),
			'set_product_as_nw_to_dt'=>$this->input->post('to_date'),
			'status'=>$this->input->post('prdt_sts'),
			'manufacture_country'=>$this->input->post('country2'),
			'mrp'=>$this->input->post('mrp'),
			'price'=>$this->input->post('price'),
			'special_price'=>$this->input->post('special_price'),
			'special_pric_from_dt'=>$this->input->post('spcil_price_from_date'),
			'special_pric_to_dt'=>$this->input->post('spcil_price_to_date'),
			'tax_amount'=>$this->input->post('vat_cst'),
			'shipping_fee'=>$shipping_fee,
			'shipping_fee_amount' => $shipping_fee_amount,
			'quantity'=>$this->input->post('qty'),
			'max_qty_allowed_in_shopng_cart'=>$this->input->post('max_qty'),
			'enable_qty_increment'=>$this->input->post('enable_qty_increment'),
			'stock_availability'=>$this->input->post('stock_avail'),
		);
		$this->db->where('product_id', $product_id);
		$this->db->where('sku', $product_sku);
		$this->db->update('product_master',$product_master_data);
		
		
		
		$product_general_data = array(
			'name' => $this->input->post('name'),
			'description' => addslashes($this->input->post('prdt_desc')),
			'short_desc' => serialize($this->input->post('prdt_short_desc')),
			'weight' => $this->input->post('weight'),
			'featured' => $this->input->post('featured'),
		);
		
		$this->db->where('product_id', $product_id);
		$this->db->update('product_general_info',$product_general_data);
		//} // prod gen ifno & price edit or not checked end
		
		if($prodmetapart_edited =='prodmetainfo_edited'){
		$product_meta_data = array(
			'meta_title' => $this->input->post('meta_title'),
			'meta_keywords' => $this->input->post('meta_keyword'),
			'meta_desc' => $this->input->post('meta_description'),
		);
		$this->db->where('product_id', $product_id);
		$this->db->update('product_meta_info', $product_meta_data);
		}
		/*$product_category_data = array(
			'category_id' => $this->input->post('subcategory_id'),
		);
		$this->db->where('product_id', $product_id);
		$this->db->update('product_category', $product_category_data);*/
		
		//echo $product_image.','.$img_name; exit;
		if($tmp_product_img == ''){
			$img_string = $product_image;
		}else{
			if($product_image == ''){
				$img_string = $tmp_product_img;
			}else{
				$img_string = $product_image.','.$tmp_product_img;
			}
		}
		$img_arr = explode(',',$img_string);
		$product_image_data = array(
			'imag' => $img_string,
			'catelog_img_url' => 'catalog_'.$img_arr[0]
		);
		$cronjob_prodimage='catalog_'.$img_arr[0];
		
		$this->db->where('product_id', $product_id);
		$this->db->update('product_image',$product_image_data);
		
		//cronjon table update start for prod iamg
			$cronjob_prodimage=array(
			'imag'=>$cronjob_prodimage
			);
			$cronjob_sku=$this->input->post('sku1');
			$this->db->where('sku', $cronjob_sku);		
			$this->db->update('cornjob_productsearch',$cronjob_prodimage);
			
		//cronjon table update end for prod image

		//program start for delete image from temp_img table//
		$this->db->where('session_id',$sesson_seller_id);
		$this->db->where('seller_id',0);
		$this->db->delete('temp_product_img');
		//program end of delete image from temp_img table//
		
		//related product insert and update program start here//
		$sku_id = $this->input->post('sku1');
		$rltd_prdt_ids = $this->input->post('chk_product');
		if($rltd_prdt_ids == ''){
			$related_prdt_ids = '';
		}else{
			$related_prdt_ids = serialize($rltd_prdt_ids);
		}
		if(count($rltd_prdt_ids)>0){
		$rel_qr = $this->db->query("SELECT * FROM product_related WHERE sku_id='$sku_id'");
		$row = $rel_qr->num_rows();
		if($row > 0){						
			$product_related_data = array(
				'product_id' => $product_id,
				'related_product_id' => $related_prdt_ids
			);			
			$this->db->where('sku_id',$sku_id);
			$this->db->update('product_related',$product_related_data);
		}else{
			$product_related_data = array(
				'product_id' => $product_id,
				'sku_id' => $sku_id,
				'related_product_id' => $related_prdt_ids
			);
			$this->db->insert('product_related',$product_related_data);
		}
		//related product insert and update program end here//
		}
		
		//program start for update seller product tables//
		$slr_sql = $this->db->query("SELECT seller_product_id FROM seller_product_setting WHERE master_product_id='$product_id'");
		if($slr_sql->num_rows() > 0){
			$slr_res = $slr_sql->result();
			$seller_product_id = $slr_res[0]->seller_product_id;
			
			//if($prodgeninfo_edited=='prodgeninfo_edited'){
				
			
			
			//product general data
			$slr_product_general_data = array(
				'name' => $this->input->post('name'),
				'description' => addslashes($this->input->post('prdt_desc')),
				'short_desc' => serialize($this->input->post('prdt_short_desc')),
				'weight' => $this->input->post('weight'),
				'featured' => $this->input->post('featured'),
				'product_fr_dt' => $this->input->post('from_date'),
				'product_to_dt' => $this->input->post('to_date'),
				'status' => $this->input->post('prdt_sts'),
				'manufacture_country' => $this->input->post('country2')
			);
			$this->db->where('seller_product_id', $seller_product_id);
			$this->db->update('seller_product_general_info',$slr_product_general_data);
			
			//product inventory data
			$slr_product_inventory_data = array(
				'quantity' => $this->input->post('qty'),
				'stock_avail' => $this->input->post('stock_avail'),
				'max_quantity'=>$this->input->post('max_qty'),
				'qty_increment'=>$this->input->post('enable_qty_increment')
			);
			$this->db->where('seller_product_id', $seller_product_id);
			$this->db->update('seller_product_inventory_info',$slr_product_inventory_data);
			
			//product price data
			$slr_product_price_data = array(
				'mrp' => $this->input->post('mrp'),
				'price' => $this->input->post('price'),
				'special_price' => $this->input->post('special_price'),
				'price_fr_dt' => $this->input->post('spcil_price_from_date'),
				'price_to_dt' => $this->input->post('spcil_price_to_date'),
				'tax_amount' => $this->input->post('vat_cst'),
				'shipping_fee' =>$shipping_fee,
				'shipping_fee_amount' => $shipping_fee_amount
			);
			$this->db->where('seller_product_id', $seller_product_id);
			$this->db->update('seller_product_price_info',$slr_product_price_data);
			
			//cronjon table update start for prod name, price,qnt
			$cronjo_prodgeninfo=array(
			'name'=>$cronjob_prodnm, 
			'price'=>$cronjob_saleprice,
			'special_price'=>$cronjob_specialprice,
			'mrp'=>$cronjob_mrp,					
			'special_pric_from_dt'=>$cronjob_splpricefromdate,
			'special_pric_to_dt'=>$cronjob_splpricetodate,
			'current_price'=>$cronjob_curprice,
			'status'=>$cronjob_status,
			'quantity'=>$cronjob_quantity	
			);
			$cronjob_sku=$this->input->post('sku1');
			$this->db->where('sku', $cronjob_sku);		
			$this->db->update('cornjob_productsearch',$cronjo_prodgeninfo);
			
			//cronjon table update end for prod name, price,qnt
			
		//} // prod gen info & price editee or not checked end for seller
			//product meta data
			if($prodmetapart_edited =='prodmetainfo_edited'){
				$slr_product_meta_data = array(
					'meta_title' => $this->input->post('meta_title'),
					'meta_keyword' => $this->input->post('meta_keyword'),
					'meta_description' => $this->input->post('meta_description')
				);
				$this->db->where('seller_product_id', $seller_product_id);
				$this->db->update('seller_product_meta_info',$slr_product_meta_data);
			}
			//product image data
			$seller_product_id = $slr_res[0]->seller_product_id;			
			$slr_product_image_data = array(
				'image' => $img_string,
				'catelog_img_url' => 'catalog_'.$img_arr[0]
			);
			$this->db->where('seller_product_id', $seller_product_id);
			$this->db->update('seller_product_image',$slr_product_image_data);
		}
		//program end of update seller product tables//
		
		//attribute program start here//
		if($prodsetting_edited =='prodsetting_edited'){
			
		$attr_id = $this->input->post('hidden_attr_id');
		$attr_fld_name = $this->input->post('attr_fld_nm');
		$attr_value = $this->input->post('attr_value');
		$slr_attr_value = $this->input->post('slr_attr_value');
		
		//condition start for insert update in product_attribute_value table//
	 // condition check for attribute id & value esit or not start	
		if($slr_attr_value == ''){
			if(count($attr_id)>0){
			$attr_id_n_value = array_combine(@$attr_id,@$attr_value);
			$attr_id_n_value_length = count($attr_id_n_value);
			
			$attr_i=0; //counter for increament of count value for storing cronjon attribute value
			
			foreach($attr_id_n_value as $k => $v){
				if($v != ''){
					$atr_id[] = $k;
					$atr_val[] = $v;
					
				}
				// program start for attribute value for cronjob table
				if($attr_fld_name[$attr_i]=='Color' || $attr_fld_name[$attr_i]=='color' )
				{
					$cron_prodcolor= $v;	
				}				
				
				if($attr_fld_name[$attr_i]=='Brand' || $attr_fld_name[$attr_i]=='brand' )
				{
					$cronjob_brand= $v;	
				}
				
				if($attr_fld_name[$attr_i]=='Size' || $attr_fld_name[$attr_i]=='size' )
				{
					$cronjob_size= $v;	
				}
				if($attr_fld_name[$attr_i]=='Sub size' || $attr_fld_name[$attr_i]=='sub size' )
				{
					$cronjob_subsize= $v;	
				}
				if($attr_fld_name[$attr_i]=='Occasion' || $attr_fld_name[$attr_i]=='occasion' )
				{
					$cronjob_occasion= $v;	
				}
				if($attr_fld_name[$attr_i]=='Capacity' || $attr_fld_name[$attr_i]=='capacity' )
				{
					$cronjob_capacity= $v;	
				}
				if($attr_fld_name[$attr_i]=='RAM')
				{
					$cronjob_RAM= $v;	
				}
				if($attr_fld_name[$attr_i]=='ROM')
				{
					$cronjob_ROM= $v;	
				}
				$attr_i++;
				// program end for attribute value for cronjob table
			}
			$entry_atrid_n_atrval = array_combine($atr_id,$atr_val);
			
			foreach($entry_atrid_n_atrval as $k => $v){
				$qr = $this->db->query("SELECT * FROM product_attribute_value WHERE sku='$product_sku' AND attr_id='$k'");
				if($qr->num_rows() > 0){
					$attr_data = array(
						'attr_value' => $v,
					);
					$this->db->where('sku',$product_sku);
					$this->db->where('attr_id',$k);
					$this->db->update('product_attribute_value',$attr_data);
				}else{
					$attr_data = array(
						'product_id' => $product_id,
						'sku' => $product_sku,
						'attr_id' => $k,
						'attr_value' => $v
					);
					$this->db->insert('product_attribute_value',$attr_data);
				}
			
		}
		//condition end of insert update in product_attribute_value table//
			
		//Program start for insert update color_attr table//
			$fill_attr_id_length = count($atr_id); //attribute ids whose value is not blank or null
			for($i=0; $i<$fill_attr_id_length; $i++){
				$sql1 = $this->db->query("SELECT a.*,b.attr_value FROM attribute_real a INNER JOIN product_attribute_value b ON a.attribute_id=b.attr_id WHERE a.attribute_id='$atr_id[$i]' AND a.attribute_field_name='Color' AND b.sku='$product_sku'");
				if($sql1->num_rows() > 0){
					$res1 = $sql1->row();
					//echo $res1->attribute_field_name;
					//echo $res1->attribute_id;
					//echo $res1->attr_value;
					
					//getting color id
					$sql3 = $this->db->query("SELECT color_id FROM color_master WHERE clr_name='$res1->attr_value'");
					$crow = $sql3->row();
					$color_id = $crow->color_id;
					
					$sql2 = $this->db->query("SELECT * FROM color_attr WHERE sku_id='$product_sku'");
					if($sql2->num_rows() > 0){
						$color_attr_data = array(
							'color_id' => $color_id,
							'clr_name' => $res1->attr_value,
						);
						$this->db->where('sku_id',$product_sku);
						$this->db->update('color_attr',$color_attr_data);
						
					}else{
						$color_attr_data = array(
							'sku_id' => $product_sku,
							'color_id' => $color_id,
							'clr_name' => $res1->attr_value,
						);
						
						$this->db->insert('color_attr',$color_attr_data);
					}
				}
			}
			}// condition check for attribute id & value esit or not end
		//Program end of insert update color_attr table//
		}else{
		//condition start for insert update in seller_product_attribute_value table//
			//getting seller product id program start//
			
			
			
			$attr_id_n_value = array_combine($attr_id,$slr_attr_value);
			$attr_id_n_value_length = count($attr_id_n_value);
			$attr_i=0;
			foreach($attr_id_n_value as $k => $v){
				if($v != ''){
					$atr_id[] = $k;
					$atr_val[] = $v;
				}
				
				
				// program start for attribute value for cronjob table
				if($attr_fld_name[$attr_i]=='Color' || $attr_fld_name[$attr_i]=='color' )
				{
					$cron_prodcolor= $v;	
				}
				
				if($attr_fld_name[$attr_i]=='Brand' || $attr_fld_name[$attr_i]=='brand' )
				{
					$cronjob_brand= $v;	
				}
				
				if($attr_fld_name[$attr_i]=='Size' || $attr_fld_name[$attr_i]=='size' )
				{
					$cronjob_size= $v;	
				}
				if($attr_fld_name[$attr_i]=='Sub size' || $attr_fld_name[$attr_i]=='sub size' )
				{
					$cronjob_subsize= $v;	
				}
				if($attr_fld_name[$attr_i]=='Occasion' || $attr_fld_name[$attr_i]=='occasion' )
				{
					$cronjob_occasion= $v;	
				}
				if($attr_fld_name[$attr_i]=='Capacity' || $attr_fld_name[$attr_i]=='capacity' )
				{
					$cronjob_capacity= $v;	
				}
				if($attr_fld_name[$attr_i]=='RAM')
				{
					$cronjob_RAM= $v;	
				}
				if($attr_fld_name[$attr_i]=='ROM')
				{
					$cronjob_ROM= $v;	
				}
				$attr_i++;
				// program end for attribute value for cronjob table
				
			}
			$entry_atrid_n_atrval = array_combine($atr_id,$atr_val);
			
			$qr1 = $this->db->query("SELECT seller_product_id FROM seller_product_general_info WHERE sku='$product_sku'");
			@$slr_product_id = $qr1->result()[0]->seller_product_id;
			
			if(@$slr_product_id!='')
			{
			//getting seller product id program end//
			if(count($attr_id)>0 ){ // condition check for attribute id & value esit or not start
			
			foreach($entry_atrid_n_atrval as $k => $v){
				$qr = $this->db->query("SELECT * FROM seller_product_attribute_value WHERE sku='$product_sku' AND attr_id='$k'");
				if($qr->num_rows() > 0){
					$attr_data = array(
						'attr_value' => $v,
					);
					$this->db->where('sku',$product_sku);
					$this->db->where('attr_id',$k);
					$this->db->update('seller_product_attribute_value',$attr_data);
				}else{
					$attr_data = array(
						'seller_product_id' => $slr_product_id,
						'sku' => $product_sku,
						'attr_id' => $k,
						'attr_value' => $v
					);
					$this->db->insert('seller_product_attribute_value',$attr_data);
				}
			}
		//condition end of insert update in seller_product_attribute_value table//
		
		//Program start for insert update color_attr table//
			$fill_attr_id_length = count($atr_id); //attribute ids whose value is not blank or null
			for($i=0; $i<$fill_attr_id_length; $i++){
				$sql1 = $this->db->query("SELECT a.*,b.attr_value FROM attribute_real a INNER JOIN seller_product_attribute_value b ON a.attribute_id=b.attr_id WHERE a.attribute_id='$atr_id[$i]' AND a.attribute_field_name='Color' AND b.sku='$product_sku'");
				if($sql1->num_rows() > 0){
					$res1 = $sql1->row();
					//echo $res1->attribute_field_name;
					//echo $res1->attribute_id;
					//echo $res1->attr_value;
					
					//getting color id
					$sql3 = $this->db->query("SELECT color_id FROM color_master WHERE clr_name='$res1->attr_value'");
					$crow = $sql3->row();
					$color_id = $crow->color_id;
					
					$sql2 = $this->db->query("SELECT * FROM color_attr WHERE sku_id='$product_sku'");
					if($sql2->num_rows() > 0){
						$color_attr_data = array(
							'color_id' => $color_id,
							'clr_name' => $res1->attr_value,
						);
						$this->db->where('sku_id',$product_sku);
						$this->db->update('color_attr',$color_attr_data);
						
					}else{
						$color_attr_data = array(
							'sku_id' => $product_sku,
							'color_id' => $color_id,
							'clr_name' => $res1->attr_value,
						);
						
						$this->db->insert('color_attr',$color_attr_data);
					}
				}
			}
			} // condition check for attribute id & value esit or not start
		//Program end of insert update color_attr table//
		}
		//attribute program end here//
		
			// cronjob product attribute update start
	} // if slrproductid not blank condition end		
			$cronjob_attributedata=array(
				'brand'=>$cronjob_brand,		
				'color'=>$cron_prodcolor,
				'size'=>$cronjob_size,
				'sub_size'=>$cronjob_subsize,
				'occasion'=>$cronjob_occasion,
				'Capacity'=>$cronjob_capacity,
				'RAM'=>$cronjob_RAM,
				'ROM'=>$cronjob_ROM,
			);
			
			$cronjob_sku=$this->input->post('sku1');
			$product_id = $this->input->post('hidden_product_id');
			$this->db->where('sku', $cronjob_sku);
			$this->db->where('product_id',$product_id);		
			$this->db->update('cornjob_productsearch',$cronjob_attributedata);
			

			// cronjob product attribute update end			
		
		} // attribute edit or not checked
		//Insert updated product id and sku in cornjob_product_update table
		$updt_data = array(
			'product_id' => $product_id,
			'sku' => $product_sku
		);
		$this->db->insert('cornjob_product_update',$updt_data);
		 $this->db->query("UPDATE seller_existingproduct_image SET image= REPLACE(image, ',,', '') ");
		 $this->db->query("UPDATE seller_existingproduct_image SET image= REPLACE(image, ',,,', '') ");
		  $this->db->query("UPDATE seller_existingproduct_image SET image= REPLACE(image, ',,,,', '') ");
		  
		  
		  
		
		 $this->db->query("UPDATE product_image SET imag= REPLACE(imag, ',,', '') ");
		 $this->db->query("UPDATE product_image SET imag= REPLACE(imag, ',,,', '') ");
		  $this->db->query("UPDATE product_image SET imag= REPLACE(imag, ',,,,', '') ");
		 		
		return true;
	}
	
	
	function update_inn_approved_existing_product_data(){
		//$img_name = implode(',', $arr_image);
		$product_id = $this->input->post('hidden_product_id'); 
		$seller_id = $this->input->post('hidden_product_sellerid');
		$product_sku = $this->input->post('hidden_product_sku');
		
		$shipping_fee_type = $this->input->post('shipping_typ');
		if($shipping_fee_type == 'Free'){
			$shipping_fee = 0;
			$shipping_fee_amount = 0;
		}else{
			$shipping_fee = $this->input->post('default_shipng_fee');
			$shipping_fee_amount = $this->input->post('hidden_shipping_fee');
		}
		
		$product_master_data = array(
			'seller_id'=>$seller_id,
			'sku'=>$this->input->post('sku1'),
			'set_product_as_nw_frm_dt'=>$this->input->post('from_date'),
			'set_product_as_nw_to_dt'=>$this->input->post('to_date'),
			'status'=>$this->input->post('prdt_sts'),
			'manufacture_country'=>$this->input->post('country2'),
			'mrp'=>$this->input->post('mrp'),
			'price'=>$this->input->post('price'),
			'special_price'=>$this->input->post('special_price'),
			'special_pric_from_dt'=>$this->input->post('spcil_price_from_date'),
			'special_pric_to_dt'=>$this->input->post('spcil_price_to_date'),
			'tax_amount'=>$this->input->post('vat_cst'),
			'shipping_fee'=>$shipping_fee,
			'shipping_fee_amount' => $shipping_fee_amount,
			'quantity'=>$this->input->post('qty'),
			'max_qty_allowed_in_shopng_cart'=>$this->input->post('max_qty'),
			'enable_qty_increment'=>$this->input->post('enable_qty_increment'),
			'stock_availability'=>$this->input->post('stock_avail'),
		);
		$this->db->where('product_id', $product_id);
		$this->db->where('sku', $product_sku);
		$this->db->update('product_master',$product_master_data);
		
		//program start for update seller product master table//
		$slr_product_master_data = array(
			'set_product_as_nw_frm_dt'=>$this->input->post('from_date'),
			'set_product_as_nw_to_dt'=>$this->input->post('to_date'),
			'status'=>$this->input->post('prdt_sts'),
			'manufacture_country'=>$this->input->post('country2'),
			'mrp'=>$this->input->post('mrp'),
			'price'=>$this->input->post('price'),
			'special_price'=>$this->input->post('special_price'),
			'special_pric_from_dt'=>$this->input->post('spcil_price_from_date'),
			'special_pric_to_dt'=>$this->input->post('spcil_price_to_date'),
			'tax_amount'=>$this->input->post('vat_cst'),
			'shipping_fee'=>$shipping_fee,
			'shipping_fee_amount' => $shipping_fee_amount,
			'quantity'=>$this->input->post('qty'),
			'max_qty_allowed_in_shopng_cart'=>$this->input->post('max_qty'),
			'enable_qty_increment'=>$this->input->post('enable_qty_increment'),
			'stock_availability'=>$this->input->post('stock_avail'),
		);
		
		$this->db->where('sku',$product_sku);
		$this->db->update('seller_product_master',$slr_product_master_data);
		//program end of update seller product master tables//
		
		//Insert updated product id and sku in cornjob_product_update table
		$updt_data = array(
			'product_id' => $product_id,
			'sku' => $product_sku
		);
		$this->db->insert('cornjob_product_update',$updt_data);
		
		$this->db->query("UPDATE seller_existingproduct_image SET image= REPLACE(image, ',,', '') ");
		 $this->db->query("UPDATE seller_existingproduct_image SET image= REPLACE(image, ',,,', '') ");
		  $this->db->query("UPDATE seller_existingproduct_image SET image= REPLACE(image, ',,,,', '') ");
		  
		  
		  
		
		 $this->db->query("UPDATE product_image SET imag= REPLACE(imag, ',,', '') ");
		 $this->db->query("UPDATE product_image SET imag= REPLACE(imag, ',,,', '') ");
		  $this->db->query("UPDATE product_image SET imag= REPLACE(imag, ',,,,', '') ");
		
		return true;
	}
	
	
	function update_inn_nonapproved_existing_product_data(){
		//$img_name = implode(',', $arr_image);
		$product_id = $this->input->post('hidden_product_id'); 
		$seller_id = $this->input->post('hidden_product_sellerid');
		$product_sku = $this->input->post('hidden_product_sku');
		
		$shipping_fee_type = $this->input->post('shipping_typ');
		if($shipping_fee_type == 'Free'){
			$shipping_fee = 0;
			$shipping_fee_amount = 0;
		}else{
			$shipping_fee = $this->input->post('default_shipng_fee');
			$shipping_fee_amount = $this->input->post('hidden_shipping_fee');
		}
		
		//program start for update seller product master table//
		$slr_product_master_data = array(
			'set_product_as_nw_frm_dt'=>$this->input->post('from_date'),
			'set_product_as_nw_to_dt'=>$this->input->post('to_date'),
			'status'=>$this->input->post('prdt_sts'),
			'manufacture_country'=>$this->input->post('country2'),
			'mrp'=>$this->input->post('mrp'),
			'price'=>$this->input->post('price'),
			'special_price'=>$this->input->post('special_price'),
			'special_pric_from_dt'=>$this->input->post('spcil_price_from_date'),
			'special_pric_to_dt'=>$this->input->post('spcil_price_to_date'),
			'tax_amount'=>$this->input->post('vat_cst'),
			'shipping_fee'=>$shipping_fee,
			'shipping_fee_amount' => $shipping_fee_amount,
			'quantity'=>$this->input->post('qty'),
			'max_qty_allowed_in_shopng_cart'=>$this->input->post('max_qty'),
			'enable_qty_increment'=>$this->input->post('enable_qty_increment'),
			'stock_availability'=>$this->input->post('stock_avail'),
		);
		
		$this->db->where('sku',$product_sku);
		$this->db->update('seller_product_master',$slr_product_master_data);
		//program end of update seller product master tables//
		
		
		$this->db->query("UPDATE seller_existingproduct_image SET image= REPLACE(image, ',,', '') ");
		 $this->db->query("UPDATE seller_existingproduct_image SET image= REPLACE(image, ',,,', '') ");
		  $this->db->query("UPDATE seller_existingproduct_image SET image= REPLACE(image, ',,,,', '') ");
		  
		  
		  
		
		 $this->db->query("UPDATE product_image SET imag= REPLACE(imag, ',,', '') ");
		 $this->db->query("UPDATE product_image SET imag= REPLACE(imag, ',,,', '') ");
		  $this->db->query("UPDATE product_image SET imag= REPLACE(imag, ',,,,', '') ");
		return true;
	}
	
	
	function update_pending_new_product(){
		$product_id = $this->input->post('hidden_product_id'); 
		$seller_id = $this->input->post('hidden_product_sellerid');
		$product_sku = $this->input->post('hidden_product_sku');
		$query1 = $this->db->query("SELECT b.image FROM seller_product_general_info a INNER JOIN seller_product_image b ON a.seller_product_id = b.seller_product_id WHERE a.sku ='$product_sku'");
		$res = $query1->result();
		$product_image=$res[0]->image;
		//var_dump($h);exit;
		
		//program start for if added any new image//
		$tmp_img_sql = $this->db->query("SELECT imag FROM temp_product_img WHERE seller_id='$seller_id'");
		$tmp_img_row = $tmp_img_sql->num_rows();
		if($tmp_img_row > 0){
			foreach($tmp_img_sql->result() as $img_row){
				$tmp_img[] = $img_row->imag;
			}
			$tmp_product_img = implode(',',$tmp_img);
		}else{
			$tmp_product_img = '';
		}
		//program end of if added any new image//
		
		$shipping_fee_type = $this->input->post('shipping_typ');
		if($shipping_fee_type == 'Free'){
			$shipping_fee = 0;
			$shipping_fee_amount = 0;
		}else{
			$shipping_fee = $this->input->post('default_shipng_fee');
			$shipping_fee_amount = $this->input->post('hidden_shipping_fee');
		}

		if($tmp_product_img == ''){
			$img_string = $product_image;
		}else{
			if($product_image == ''){
				$img_string = $tmp_product_img;
			}else{
				$img_string = $product_image.','.$tmp_product_img;
			}
		}
		$img_arr = explode(',',$img_string);

		//program start for delete image from temp_img table//
		$this->db->where('seller_id',$seller_id);
		$this->db->delete('temp_product_img');
		//program end of delete image from temp_img table//
		
		//program start for update seller product tables//
		$seller_product_id = $product_id;
		
		//product general data
		$slr_product_general_data = array(
			'name' => $this->input->post('name'),
			'description' => addslashes($this->input->post('prdt_desc')),
			'short_desc' => serialize($this->input->post('prdt_short_desc')),
			'weight' => $this->input->post('weight'),
			'featured' => $this->input->post('featured'),
			'product_fr_dt' => $this->input->post('from_date'),
			'product_to_dt' => $this->input->post('to_date'),
			'status' => $this->input->post('prdt_sts'),
			'manufacture_country' => $this->input->post('country2')
		);
		$this->db->where('seller_product_id', $seller_product_id);
		$this->db->update('seller_product_general_info',$slr_product_general_data);
		
		//product inventory data
		$slr_product_inventory_data = array(
			'quantity' => $this->input->post('qty'),
			'stock_avail' => $this->input->post('stock_avail'),
			'max_quantity'=>$this->input->post('max_qty'),
			'qty_increment'=>$this->input->post('enable_qty_increment')
		);
		$this->db->where('seller_product_id', $seller_product_id);
		$this->db->update('seller_product_inventory_info',$slr_product_inventory_data);
		
		//product price data
		$slr_product_price_data = array(
			'mrp' => $this->input->post('mrp'),
			'price' => $this->input->post('price'),
			'special_price' => $this->input->post('special_price'),
			'price_fr_dt' => $this->input->post('spcil_price_from_date'),
			'price_to_dt' => $this->input->post('spcil_price_to_date'),
			'tax_amount' => $this->input->post('vat_cst'),
			'shipping_fee' =>$shipping_fee,
			'shipping_fee_amount' => $shipping_fee_amount
		);
		$this->db->where('seller_product_id', $seller_product_id);
		$this->db->update('seller_product_price_info',$slr_product_price_data);
		
		//product meta data
		$slr_product_meta_data = array(
			'meta_title' => $this->input->post('meta_title'),
			'meta_keyword' => $this->input->post('meta_keyword'),
			'meta_description' => $this->input->post('meta_description')
		);
		$this->db->where('seller_product_id', $seller_product_id);
		$this->db->update('seller_product_meta_info',$slr_product_meta_data);
		
		//product image data
		$slr_product_image_data = array(
			'image' => $img_string,
			'catelog_img_url' => 'catalog_'.$img_arr[0]
		);
		$this->db->where('seller_product_id', $seller_product_id);
		$this->db->update('seller_product_image',$slr_product_image_data);
		//program end of update seller product tables//
		
		//attribute program start here//
		$attr_id = $this->input->post('hidden_attr_id');
		$attr_fld_name = $this->input->post('attr_fld_nm');
		$attr_value = $this->input->post('attr_value');
		$slr_attr_value = $this->input->post('slr_attr_value');
		
		//condition start for insert update in seller_product_attribute_value table//
		$attr_id_n_value = array_combine($attr_id,$slr_attr_value);
		$attr_id_n_value_length = count($attr_id_n_value);
		foreach($attr_id_n_value as $k => $v){
			if($v != ''){
				$atr_id[] = $k;
				$atr_val[] = $v;
			}
		}
		$entry_atrid_n_atrval = array_combine($atr_id,$atr_val);
		
		foreach($entry_atrid_n_atrval as $k => $v){
			$qr = $this->db->query("SELECT * FROM seller_product_attribute_value WHERE sku='$product_sku' AND attr_id='$k'");
			if($qr->num_rows() > 0){
				$attr_data = array(
					'attr_value' => $v,
				);
				$this->db->where('sku',$product_sku);
				$this->db->where('attr_id',$k);
				$this->db->update('seller_product_attribute_value',$attr_data);
			}else{
				$attr_data = array(
					'seller_product_id' => $seller_product_id,
					'sku' => $product_sku,
					'attr_id' => $k,
					'attr_value' => $v
				);
				$this->db->insert('seller_product_attribute_value',$attr_data);
			}
		}
		//condition end of insert update in seller_product_attribute_value table//
		
		//Program start for insert update color_attr table//
		$fill_attr_id_length = count($atr_id); //attribute ids whose value is not blank or null
		for($i=0; $i<$fill_attr_id_length; $i++){
			$sql1 = $this->db->query("SELECT a.*,b.attr_value FROM attribute_real a INNER JOIN seller_product_attribute_value b ON a.attribute_id=b.attr_id WHERE a.attribute_id='$atr_id[$i]' AND a.attribute_field_name='Color' AND b.sku='$product_sku'");
			if($sql1->num_rows() > 0){
				$res1 = $sql1->row();
				//echo $res1->attribute_field_name;
				//echo $res1->attribute_id;
				//echo $res1->attr_value;
				
				//getting color id
				$sql3 = $this->db->query("SELECT color_id FROM color_master WHERE clr_name='$res1->attr_value'");
				$crow = $sql3->row();
				$color_id = $crow->color_id;
				
				$sql2 = $this->db->query("SELECT * FROM color_attr WHERE sku_id='$product_sku'");
				if($sql2->num_rows() > 0){
					$color_attr_data = array(
						'color_id' => $color_id,
						'clr_name' => $res1->attr_value,
					);
					$this->db->where('sku_id',$product_sku);
					$this->db->update('color_attr',$color_attr_data);
				}else{
					$color_attr_data = array(
						'sku_id' => $product_sku,
						'color_id' => $color_id,
						'clr_name' => $res1->attr_value,
					);
					$this->db->insert('color_attr',$color_attr_data);
				}
			}
		}
		//Program end of insert update color_attr table//
			
		//attribute program end here//
		
		
		$this->db->query("UPDATE seller_existingproduct_image SET image= REPLACE(image, ',,', '') ");
		 $this->db->query("UPDATE seller_existingproduct_image SET image= REPLACE(image, ',,,', '') ");
		  $this->db->query("UPDATE seller_existingproduct_image SET image= REPLACE(image, ',,,,', '') ");
		  
		  
		  
		
		 $this->db->query("UPDATE product_image SET imag= REPLACE(imag, ',,', '') ");
		 $this->db->query("UPDATE product_image SET imag= REPLACE(imag, ',,,', '') ");
		  $this->db->query("UPDATE product_image SET imag= REPLACE(imag, ',,,,', '') ");
		
		return true;
	}
	
	//update new product without image
	/*function update_new_product1(){
		$product_id = $this->input->post('hidden_product_id'); 
		$seller_id = $this->input->post('hidden_product_sellerid'); //echo $seller_id; exit;
		$product_sku = $this->input->post('hidden_product_sku');	
		
		$shipping_fee_type = $this->input->post('shipping_typ');
		if($shipping_fee_type == 'Free'){
			$shipping_fee = 0;
			$shipping_fee_amount = 0;
		}else{
			$shipping_fee = $this->input->post('default_shipng_fee');
			$shipping_fee_amount = $this->input->post('hidden_shipping_fee');
		}
		
		$product_master_data = array(
			'seller_id'=>$seller_id,
			'sku'=>$this->input->post('sku1'),
			'set_product_as_nw_frm_dt'=>$this->input->post('from_date'),
			'set_product_as_nw_to_dt'=>$this->input->post('to_date'),
			'status'=>$this->input->post('prdt_sts'),
			'manufacture_country'=>$this->input->post('country2'),
			'mrp'=>$this->input->post('mrp'),
			'price'=>$this->input->post('price'),
			'special_price'=>$this->input->post('special_price'),
			'special_pric_from_dt'=>$this->input->post('spcil_price_from_date'),
			'special_pric_to_dt'=>$this->input->post('spcil_price_to_date'),
			'tax_class'=>$this->input->post('tax_cls'),
			'shipping_fee'=>$shipping_fee,
			'shipping_fee_amount' => $shipping_fee_amount,
			'quantity'=>$this->input->post('qty'),
			'max_qty_allowed_in_shopng_cart'=>$this->input->post('max_qty'),
			'enable_qty_increment'=>$this->input->post('enable_qty_increment'),
			'stock_availability'=>$this->input->post('stock_avail'),
		);
		$this->db->where('product_id', $product_id);
		$this->db->where('sku', $product_sku);
		$this->db->update('product_master',$product_master_data);
		
		$product_general_data = array(
			'name' => $this->input->post('name'),
			'description' => addslashes($this->input->post('prdt_desc')),
			'short_desc' => serialize($this->input->post('prdt_short_desc')),
			'weight' => $this->input->post('weight'),
			'featured' => $this->input->post('featured'),
		);
		
		$this->db->where('product_id', $product_id);
		$this->db->update('product_general_info',$product_general_data);
		
		$product_meta_data = array(
			'meta_title' => $this->input->post('meta_title'),
			'meta_keywords' => $this->input->post('meta_keyword'),
			'meta_desc' => $this->input->post('meta_description'),
		);
		$this->db->where('product_id', $product_id);
		$this->db->update('product_meta_info', $product_meta_data);		
	
		//related product insert and update program start here//
		$sku_id = $this->input->post('sku1');
		$rltd_prdt_ids = $this->input->post('chk_product');
		if($rltd_prdt_ids == ''){
			$related_prdt_ids = '';
		}else{
			$related_prdt_ids = serialize($rltd_prdt_ids);
		}
		
		$rel_qr = $this->db->query("SELECT * FROM product_related WHERE sku_id='$sku_id'");
		$row = $rel_qr->num_rows();
		if($row > 0){						
			$product_related_data = array(
				'product_id' => $product_id,
				'related_product_id' => $related_prdt_ids
			);			
			$this->db->where('sku_id',$sku_id);
			$this->db->update('product_related',$product_related_data);
		}else{
			$product_related_data = array(
				'product_id' => $product_id,
				'sku_id' => $sku_id,
				'related_product_id' => $related_prdt_ids
			);
			$this->db->insert('product_related',$product_related_data);
		}	
		//related product insert and update program end here//
		
		//attribute program start here//
		$attr_id = $this->input->post('hidden_attr_id');
		$attr_value = $this->input->post('attr_value');
		$slr_attr_value = $this->input->post('slr_attr_value');
		
		//condition start for insert update in product_attribute_value table//
		if($slr_attr_value == ''){
			$attr_id_n_value = array_combine($attr_id,$attr_value);
			$attr_id_n_value_length = count($attr_id_n_value);
			foreach($attr_id_n_value as $k => $v){
				if($v != ''){
					$atr_id[] = $k;
					$atr_val[] = $v;
				}
			}
			$entry_atrid_n_atrval = array_combine($atr_id,$atr_val);
			
			foreach($entry_atrid_n_atrval as $k => $v){
				$qr = $this->db->query("SELECT * FROM product_attribute_value WHERE sku='$product_sku' AND attr_id='$k'");
				if($qr->num_rows() > 0){
					$attr_data = array(
						'attr_value' => $v,
					);
					$this->db->where('sku',$product_sku);
					$this->db->where('attr_id',$k);
					$this->db->update('product_attribute_value',$attr_data);
				}else{
					$attr_data = array(
						'product_id' => $product_id,
						'sku' => $product_sku,
						'attr_id' => $k,
						'attr_value' => $v
					);
					$this->db->insert('product_attribute_value',$attr_data);
				}
			}
		//condition end of insert update in product_attribute_value table//
		}else{
		//condition start for insert update in seller_product_attribute_value table//
			//getting seller product id program start//
			$qr1 = $this->db->query("SELECT seller_product_id FROM seller_product_general_info WHERE sku='$product_sku'");
			$slr_product_id = $qr1->result()[0]->seller_product_id;
			//getting seller product id program end//
			
			$attr_id_n_value = array_combine($attr_id,$slr_attr_value);
			$attr_id_n_value_length = count($attr_id_n_value);
			foreach($attr_id_n_value as $k => $v){
				if($v != ''){
					$atr_id[] = $k;
					$atr_val[] = $v;
				}
			}
			$entry_atrid_n_atrval = array_combine($atr_id,$atr_val);
			
			foreach($entry_atrid_n_atrval as $k => $v){
				$qr = $this->db->query("SELECT * FROM seller_product_attribute_value WHERE sku='$product_sku' AND attr_id='$k'");
				if($qr->num_rows() > 0){
					$attr_data = array(
						'attr_value' => $v,
					);
					$this->db->where('sku',$product_sku);
					$this->db->where('attr_id',$k);
					$this->db->update('seller_product_attribute_value',$attr_data);
				}else{
					$attr_data = array(
						'seller_product_id' => $slr_product_id,
						'sku' => $product_sku,
						'attr_id' => $k,
						'attr_value' => $v
					);
					$this->db->insert('seller_product_attribute_value',$attr_data);
				}
			}
		//condition end of insert update in seller_product_attribute_value table//
		}		
		//attribute program end here//
		return true;
	}*/
	
	function update_new_product_log()
	{	$product_name=$this->input->post('name');
		date_default_timezone_set('Asia/Calcutta');
		$cdate =date('y-m-d H:i:s');
		
		if($this->session->userdata('logged_in')!=ADMIN_MAIL)
	{
		$uid= $this->session->userdata('logged_userrole_id');
		$uname=$this->session->userdata('logged_in');
	}
	{	$uid=37;
		$uname='admin';	
	}
		$log_data="Product(".$product_name.") Data has modified ";
				$data=array(
							
							'log_detail'=>$log_data,
							'user_id'=>$uid,
							'user_name'=>$uname,
							'log_datetime'=>$cdate
						);
						$this->db->insert('user_log',$data);	
	}
	
	function retrive_product_details(){
		/* $query = $this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,f.attribute_group_name,g.business_name FROM product_setting a 
		INNER JOIN product_general_info b ON a.product_id=b.product_id 
		INNER JOIN product_master c ON a.product_id=c.product_id 
		INNER JOIN product_category d ON a.product_id=d.product_id 
		INNER JOIN product_image e ON a.product_id=e.product_id  
		INNER JOIN attribute_group f ON a.attribut_set=f.attribute_group_id 
		INNER JOIN seller_account_information g ON c.seller_id=g.seller_id GROUP BY e.product_id ORDER BY a.id DESC"); */
		
		$query = $this->db->query("SELECT b.product_id,b.name,c.sku,c.mrp,c.price,c.special_price,c.special_pric_from_dt,c.special_pric_to_dt,c.	status,c.quantity,d.category_id,e.imag,f.attribute_group_name,g.business_name FROM product_setting a 
		INNER JOIN product_general_info b ON a.product_id=b.product_id 
		INNER JOIN product_master c ON a.product_id=c.product_id 
		INNER JOIN product_category d ON a.product_id=d.product_id 
		INNER JOIN product_image e ON a.product_id=e.product_id  
		INNER JOIN attribute_group f ON a.attribut_set=f.attribute_group_id 
		INNER JOIN seller_account_information g ON c.seller_id=g.seller_id GROUP BY e.product_id ORDER BY a.id DESC");
		return $query;
	}
	function export_product_details()
	{
		$query = $this->db->query("SELECT a.product_id,b.name,b.description,a.sku,a.mrp,a.price,a.special_price,a.special_pric_from_dt,a.special_pric_to_dt,a.	status,a.quantity,a.shipping_fee_amount,c.catelog_img_url,d.lvlmain_name,d.lvl1_name,d.lvl2_name FROM 
		product_general_info b  
		INNER JOIN product_master a ON a.product_id=b.product_id		 
		INNER JOIN product_image c ON a.product_id=c.product_id
		INNER JOIN  cornjob_productsearch d ON d.sku=a.sku		 
		INNER JOIN seller_account_information g ON a.seller_id=g.seller_id GROUP BY a.sku ORDER BY a.product_id DESC");
		
		
		return $query;	
	}
	function retrive_product_details_catalog($limit,$start){
		//$query = $this->db->query("SELECT b.product_id,b.name,c.sku,c.mrp,c.price,c.special_price,c.special_pric_from_dt,c.special_pric_to_dt,c.	status,c.quantity,d.category_id,e.imag,f.attribute_group_name,g.business_name FROM product_setting a 
//		INNER JOIN product_general_info b ON a.product_id=b.product_id 
//		INNER JOIN product_master c ON a.product_id=c.product_id 
//		INNER JOIN product_category d ON a.product_id=d.product_id 
//		INNER JOIN product_image e ON a.product_id=e.product_id  
//		INNER JOIN attribute_group f ON a.attribut_set=f.attribute_group_id 
//		INNER JOIN seller_account_information g ON c.seller_id=g.seller_id GROUP BY e.product_id ORDER BY a.id DESC LIMIT ".$start.", ".$limit."");
		
		
		$query_prodid = $this->db->query("SELECT a.product_id FROM product_setting a INNER JOIN cornjob_productsearch b ON a.product_id=b.product_id  ORDER BY a.id DESC LIMIT ".$start.", ".$limit."");
		$row_prod_id=$query_prodid->result_array();
		
		$prod_arr=array();
		foreach($row_prod_id as $res_prodid)
		{ array_push($prod_arr,$res_prodid['product_id']);}
		$prodid_str=implode(',',$prod_arr);
		
		if($prodid_str=='')
		{$prodid_str='0';}
		$query1 = $this->db->query("SELECT a.add_date, b.product_id, b.name, b.sku, b.mrp, b.price, b.special_price, b.special_pric_from_dt, b.special_pric_to_dt, b.status, b.quantity, b.lvl2, b.imag as catelog_img_url, f.attribute_group_name, g.business_name
FROM product_setting a INNER JOIN  cornjob_productsearch b ON a.product_id=b.product_id
INNER JOIN attribute_group f ON a.attribut_set = f.attribute_group_id
INNER JOIN seller_account_information g ON b.seller_id = g.seller_id
WHERE a.product_id
IN ($prodid_str) 
GROUP BY b.sku  ORDER BY a.product_id DESC  ");

	if($query1->num_rows()>0)
	{
		return $query1;
	}else
		{	$query2 = $this->db->query("SELECT a.add_date, b.product_id, b.name, c.sku, c.mrp, c.price, c.special_price, c.special_pric_from_dt, c.special_pric_to_dt, c.status, c.quantity, d.category_id, e.catelog_img_url, f.attribute_group_name, g.business_name
	FROM product_setting a
	INNER JOIN product_general_info b ON a.product_id = b.product_id
	INNER JOIN product_master c ON a.product_id = c.product_id
	INNER JOIN product_category d ON a.product_id = d.product_id
	INNER JOIN product_image e ON a.product_id = e.product_id
	INNER JOIN attribute_group f ON a.attribut_set = f.attribute_group_id
	INNER JOIN seller_account_information g ON c.seller_id = g.seller_id
	WHERE a.product_id
	IN ($prodid_str) 
	GROUP BY c.sku ORDER BY a.product_id DESC ");
			
			return $query2;
		} //if condition end
	}
	
	function retrive_product_details_count(){
		//$query = $this->db->query("SELECT id FROM product_master group by sku");
		
		$query = $this->db->query("SELECT a.product_id FROM product_setting a INNER JOIN cornjob_productsearch b ON a.product_id=b.product_id");
		if($query->num_rows() > 0){
			return $query->num_rows();
		}else{
			return false;
		}
	}
	
	function retrive_seller_product_details(){
		$query = $this->db->query("SELECT a.*,b.*,d.*,e.*,f.attribute_group_name,g.business_name FROM seller_product_setting a 
		INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id 
		INNER JOIN seller_product_category d ON a.seller_product_id=d.seller_product_id 
		INNER JOIN seller_product_image e ON a.seller_product_id=e.seller_product_id  
		INNER JOIN attribute_group f ON a.attribute_set=f.attribute_group_id 
		INNER JOIN seller_account_information g ON a.seller_id=g.seller_id GROUP BY e.seller_product_id ORDER BY a.id DESC");
		return $query;
	}
	
	function filter_product_details($limit,$start)
	{
		$id = $_REQUEST['id_1'];
		$name = addslashes($_REQUEST['name1']);	
		$slr_name = addslashes($_REQUEST['slr_nm']);
		$select_att_name = $_REQUEST['select_att_name'];
		$sku = $_REQUEST['sku'];
		$id_from = $_REQUEST['id_from1'];
		$id_to = $_REQUEST['id_to1'];
		$id_from2 = $_REQUEST['id_from2'];	
		$id_to2 = $_REQUEST['id_to2'];
		$status = $_REQUEST['status_name1'];
		$condition = '';
		
		
		if( $id!=''){
			$condition .= "a.product_id='$id'" ;
			$query = $this->db->query("SELECT a.add_date,b.product_id,b.name,c.sku, c.mrp, c.price, c.special_price, c.special_pric_from_dt, c.special_pric_to_dt, c.status, c.quantity,d.category_id,e.catelog_img_url,f.attribute_group_name,g.business_name FROM product_setting a 
	INNER JOIN product_general_info b ON a.product_id=b.product_id 
	INNER JOIN product_master c ON a.product_id=c.product_id 
	INNER JOIN product_category d ON a.product_id=d.product_id 
	INNER JOIN product_image e ON a.product_id=e.product_id  
	INNER JOIN attribute_group f ON a.attribut_set=f.attribute_group_id INNER JOIN seller_account_information g ON c.seller_id=g.seller_id  where ".$condition." GROUP BY c.sku  ORDER BY a.id DESC LIMIT ".$start.", ".$limit."");
	return $query;
		}
		else if($name!=''){
			$condition .= "b.name LIKE '%$name%'" ;
	
			$query_prodid = $this->db->query("SELECT b.product_id FROM product_general_info b WHERE $condition LIMIT ".$start.", ".$limit."");
			if($query_prodid->num_rows() > 0){
				$row_prod_id=$query_prodid->result();
				
				$prod_arr=array();
				foreach($row_prod_id as $res_prodid)
				{ array_push($prod_arr,$res_prodid->product_id);}
				$prodid_str=implode(',',$prod_arr);
				
				$query1 = $this->db->query("SELECT a.add_date, b.product_id, b.name, b.sku, b.mrp, b.price, b.special_price, b.special_pric_from_dt, b.special_pric_to_dt, b.status, b.quantity, b.lvl2, b.imag as catelog_img_url, f.attribute_group_name, g.business_name
FROM product_setting a INNER JOIN  cornjob_productsearch b ON a.product_id=b.product_id
INNER JOIN attribute_group f ON a.attribut_set = f.attribute_group_id
INNER JOIN seller_account_information g ON b.seller_id = g.seller_id
WHERE a.product_id
IN ($prodid_str) 
GROUP BY b.sku ORDER BY b.product_id DESC  ");

	if($query1->num_rows()>0)
	{
		return $query1;
	}else
		{
				$query2 = $this->db->query("SELECT a.add_date,b.product_id,b.name,c.sku, c.mrp, c.price, c.special_price, c.special_pric_from_dt, c.special_pric_to_dt, c.status, c.quantity,d.category_id,e.catelog_img_url,f.attribute_group_name,g.business_name 
				FROM product_setting a 
				INNER JOIN product_general_info b ON a.product_id=b.product_id 
				INNER JOIN product_master c ON a.product_id=c.product_id 
				INNER JOIN product_category d ON a.product_id=d.product_id 
				INNER JOIN product_image e ON a.product_id=e.product_id  
				INNER JOIN attribute_group f ON a.attribut_set=f.attribute_group_id INNER JOIN seller_account_information g ON c.seller_id=g.seller_id  where b.product_id IN ($prodid_str) GROUP BY c.sku ORDER BY a.id DESC ");
				return $query2;
		}
				
			}else{
				return false;
			}
		}
		else if($slr_name!=''){
			$condition .= "g.business_name LIKE '%$slr_name%'";
			
			$query_prodid = $this->db->query("SELECT c.product_id FROM product_master c INNER JOIN seller_account_information g ON c.seller_id=g.seller_id WHERE $condition LIMIT ".$start.", ".$limit."");
			if($query_prodid->num_rows() > 0){
				$row_prod_id=$query_prodid->result();
					
				$prod_arr=array();
				foreach($row_prod_id as $res_prodid)
				{ array_push($prod_arr,$res_prodid->product_id);}
				$prodid_str=implode(',',$prod_arr);
				
				$query1 = $this->db->query("SELECT a.add_date, b.product_id, b.name, b.sku, b.mrp, b.price, b.special_price, b.special_pric_from_dt, b.special_pric_to_dt, b.status, b.quantity, b.lvl2, b.imag as catelog_img_url, f.attribute_group_name, g.business_name
FROM product_setting a INNER JOIN  cornjob_productsearch b ON a.product_id=b.product_id
INNER JOIN attribute_group f ON a.attribut_set = f.attribute_group_id
INNER JOIN seller_account_information g ON b.seller_id = g.seller_id
WHERE a.product_id
IN ($prodid_str) 
GROUP BY b.sku ORDER BY b.product_id DESC  ");

	if($query1->num_rows()>0)
	{
		return $query1;
	}else
		{
				$query2 = $this->db->query("SELECT a.add_date,b.product_id,b.name,c.sku, c.mrp, c.price, c.special_price, c.special_pric_from_dt, c.special_pric_to_dt, c.status, c.quantity,d.category_id,e.catelog_img_url,f.attribute_group_name,g.business_name 
				FROM product_setting a 
				INNER JOIN product_general_info b ON a.product_id=b.product_id 
				INNER JOIN product_master c ON a.product_id=c.product_id 
				INNER JOIN product_category d ON a.product_id=d.product_id 
				INNER JOIN product_image e ON a.product_id=e.product_id  
				INNER JOIN attribute_group f ON a.attribut_set=f.attribute_group_id INNER JOIN seller_account_information g ON c.seller_id=g.seller_id  where b.product_id IN ($prodid_str) GROUP BY c.sku ORDER BY a.id DESC ");
				return $query2;
		}
			}else{
				return false;
			}
		}
		else if($select_att_name!=''){
			$condition .= "f.attribute_group_id='$select_att_name'" ;
			
			$query_prodid = $this->db->query("SELECT a.product_id FROM product_setting a INNER JOIN attribute_group f ON a.attribut_set=f.attribute_group_id WHERE $condition LIMIT ".$start.", ".$limit."");
			if($query_prodid->num_rows() > 0){
				$row_prod_id=$query_prodid->result();
					
				$prod_arr=array();
				foreach($row_prod_id as $res_prodid)
				{ array_push($prod_arr,$res_prodid->product_id);}
				$prodid_str=implode(',',$prod_arr);
				
				$query1 = $this->db->query("SELECT a.add_date, b.product_id, b.name, b.sku, b.mrp, b.price, b.special_price, b.special_pric_from_dt, b.special_pric_to_dt, b.status, b.quantity, b.lvl2, b.imag as catelog_img_url, f.attribute_group_name, g.business_name
FROM product_setting a INNER JOIN  cornjob_productsearch b ON a.product_id=b.product_id
INNER JOIN attribute_group f ON a.attribut_set = f.attribute_group_id
INNER JOIN seller_account_information g ON b.seller_id = g.seller_id
WHERE a.product_id
IN ($prodid_str) 
GROUP BY b.sku ORDER BY b.product_id DESC ");

	if($query1->num_rows()>0)
	{
		return $query1;
	}else
		{
				$query2 = $this->db->query("SELECT a.add_date,b.product_id,b.name,c.sku, c.mrp, c.price, c.special_price, c.special_pric_from_dt, c.special_pric_to_dt, c.status, c.quantity,d.category_id,e.catelog_img_url,f.attribute_group_name,g.business_name 
				FROM product_setting a 
				INNER JOIN product_general_info b ON a.product_id=b.product_id 
				INNER JOIN product_master c ON a.product_id=c.product_id 
				INNER JOIN product_category d ON a.product_id=d.product_id 
				INNER JOIN product_image e ON a.product_id=e.product_id  
				INNER JOIN attribute_group f ON a.attribut_set=f.attribute_group_id INNER JOIN seller_account_information g ON c.seller_id=g.seller_id  where b.product_id IN ($prodid_str) GROUP BY c.sku ORDER BY a.id DESC ");
				return $query2;
		}
			}else{
				return false;
			}
		}
		else if($sku!=''){
			$condition .= "c.sku='$sku'" ;
			
			$query_prodid = $this->db->query("SELECT c.product_id FROM product_master c WHERE $condition LIMIT ".$start.", ".$limit."");
			if($query_prodid->num_rows() > 0){
				$row_prod_id=$query_prodid->result();
					
				$prod_arr=array();
				foreach($row_prod_id as $res_prodid)
				{ array_push($prod_arr,$res_prodid->product_id);}
				$prodid_str=implode(',',$prod_arr);
			
			// $query = $this->db->query("SELECT a.add_date,b.product_id,b.name,c.sku, c.mrp, c.price, c.special_price, c.special_pric_from_dt, c.special_pric_to_dt, c.status, c.quantity,d.category_id,e.catelog_img_url,f.attribute_group_name,g.business_name  FROM product_setting a 
	// INNER JOIN product_general_info b ON a.product_id=b.product_id 
	// INNER JOIN product_master c ON a.product_id=c.product_id 
	// INNER JOIN product_category d ON a.product_id=d.product_id 
	// INNER JOIN product_image e ON a.product_id=e.product_id  
	// INNER JOIN attribute_group f ON a.attribut_set=f.attribute_group_id INNER JOIN seller_account_information g ON c.seller_id=g.seller_id  where ".$condition." GROUP BY e.product_id ORDER BY a.id DESC LIMIT ".$start.", ".$limit."");
	
			$query1 = $this->db->query("SELECT a.add_date, b.product_id, b.name, b.sku, b.mrp, b.price, b.special_price, b.special_pric_from_dt, b.special_pric_to_dt, b.status, b.quantity, b.lvl2, b.imag as catelog_img_url, f.attribute_group_name, g.business_name
FROM product_setting a INNER JOIN  cornjob_productsearch b ON a.product_id=b.product_id
INNER JOIN attribute_group f ON a.attribut_set = f.attribute_group_id
INNER JOIN seller_account_information g ON b.seller_id = g.seller_id
WHERE a.product_id
IN ($prodid_str) 
GROUP BY b.sku ORDER BY b.product_id DESC  ");

	if($query1->num_rows()>0)
	{
		return $query1;
	}else
		{
				$query2 = $this->db->query("SELECT a.add_date,b.product_id,b.name,c.sku, c.mrp, c.price, c.special_price, c.special_pric_from_dt, c.special_pric_to_dt, c.status, c.quantity,d.category_id,e.catelog_img_url,f.attribute_group_name,g.business_name 
				FROM product_setting a 
				INNER JOIN product_general_info b ON a.product_id=b.product_id 
				INNER JOIN product_master c ON a.product_id=c.product_id 
				INNER JOIN product_category d ON a.product_id=d.product_id 
				INNER JOIN product_image e ON a.product_id=e.product_id  
				INNER JOIN attribute_group f ON a.attribut_set=f.attribute_group_id INNER JOIN seller_account_information g ON c.seller_id=g.seller_id  where b.product_id IN ($prodid_str) GROUP BY c.sku ORDER BY a.id DESC ");
				return $query2;
		}
			}else{
				return false;
			}
		}
		else if($id_from!='' && $id_to!=''){
			$condition .= "c.price>='$id_from' and c.price<='$id_to'";
			
			$query_prodid = $this->db->query("SELECT c.product_id FROM product_master c WHERE $condition LIMIT ".$start.", ".$limit."");
			if($query_prodid->num_rows() > 0){
				$row_prod_id=$query_prodid->result();
					
				$prod_arr=array();
				foreach($row_prod_id as $res_prodid)
				{ array_push($prod_arr,$res_prodid->product_id);}
				$prodid_str=implode(',',$prod_arr);
				
				$query1 = $this->db->query("SELECT a.add_date, b.product_id, b.name, b.sku, b.mrp, b.price, b.special_price, b.special_pric_from_dt, b.special_pric_to_dt, b.status, b.quantity, b.lvl2, b.imag as catelog_img_url, f.attribute_group_name, g.business_name
FROM product_setting a INNER JOIN  cornjob_productsearch b ON a.product_id=b.product_id
INNER JOIN attribute_group f ON a.attribut_set = f.attribute_group_id
INNER JOIN seller_account_information g ON b.seller_id = g.seller_id
WHERE a.product_id
IN ($prodid_str) 
GROUP BY b.sku ORDER BY b.product_id DESC ");

	if($query1->num_rows()>0)
	{
		return $query1;
	}else
		{
				$query2 = $this->db->query("SELECT a.add_date,b.product_id,b.name,c.sku, c.mrp, c.price, c.special_price, c.special_pric_from_dt, c.special_pric_to_dt, c.status, c.quantity,d.category_id,e.catelog_img_url,f.attribute_group_name,g.business_name 
				FROM product_setting a 
				INNER JOIN product_general_info b ON a.product_id=b.product_id 
				INNER JOIN product_master c ON a.product_id=c.product_id 
				INNER JOIN product_category d ON a.product_id=d.product_id 
				INNER JOIN product_image e ON a.product_id=e.product_id  
				INNER JOIN attribute_group f ON a.attribut_set=f.attribute_group_id INNER JOIN seller_account_information g ON c.seller_id=g.seller_id  where b.product_id IN ($prodid_str) GROUP BY c.sku ORDER BY a.id DESC ");
				return $query2;
		}
			}else{
				return false;
			}
		}
		else if($id_from2!='' && $id_to2!=''){
			$condition .= "c.quantity>='$id_from2' and c.quantity<='$id_to2'";
			
			$query_prodid = $this->db->query("SELECT c.product_id FROM product_master c WHERE $condition LIMIT ".$start.", ".$limit."");
			if($query_prodid->num_rows() > 0){
				$row_prod_id=$query_prodid->result();
					
				$prod_arr=array();
				foreach($row_prod_id as $res_prodid)
				{ array_push($prod_arr,$res_prodid->product_id);}
				$prodid_str=implode(',',$prod_arr);
				
			$query1 = $this->db->query("SELECT a.add_date, b.product_id, b.name, b.sku, b.mrp, b.price, b.special_price, b.special_pric_from_dt, b.special_pric_to_dt, b.status, b.quantity, b.lvl2, b.imag as catelog_img_url, f.attribute_group_name, g.business_name
FROM product_setting a INNER JOIN  cornjob_productsearch b ON a.product_id=b.product_id
INNER JOIN attribute_group f ON a.attribut_set = f.attribute_group_id
INNER JOIN seller_account_information g ON b.seller_id = g.seller_id
WHERE a.product_id
IN ($prodid_str) 
GROUP BY b.sku ORDER BY b.product_id DESC  ");

	if($query1->num_rows()>0)
	{
		return $query1;
	}else
		{
				$query2 = $this->db->query("SELECT a.add_date,b.product_id,b.name,c.sku, c.mrp, c.price, c.special_price, c.special_pric_from_dt, c.special_pric_to_dt, c.status, c.quantity,d.category_id,e.catelog_img_url,f.attribute_group_name,g.business_name 
				FROM product_setting a 
				INNER JOIN product_general_info b ON a.product_id=b.product_id 
				INNER JOIN product_master c ON a.product_id=c.product_id 
				INNER JOIN product_category d ON a.product_id=d.product_id 
				INNER JOIN product_image e ON a.product_id=e.product_id  
				INNER JOIN attribute_group f ON a.attribut_set=f.attribute_group_id INNER JOIN seller_account_information g ON c.seller_id=g.seller_id  where b.product_id IN ($prodid_str) GROUP BY c.sku ORDER BY a.id DESC ");
				return $query2;
		}
			}else{
				return false;
			}
		}
		else if($status!='' ){
			$condition .= "c.status='$status'";
			$query_prodid = $this->db->query("SELECT c.product_id FROM product_master c WHERE $condition LIMIT ".$start.", ".$limit."");
			if($query_prodid->num_rows() > 0){
				$row_prod_id=$query_prodid->result();
					
				$prod_arr=array();
				foreach($row_prod_id as $res_prodid)
				{ array_push($prod_arr,$res_prodid->product_id);}
				$prodid_str=implode(',',$prod_arr);
				
			$query1 = $this->db->query("SELECT a.add_date, b.product_id, b.name, b.sku, b.mrp, b.price, b.special_price, b.special_pric_from_dt, b.special_pric_to_dt, b.status, b.quantity, b.lvl2, b.imag as catelog_img_url, f.attribute_group_name, g.business_name
FROM product_setting a INNER JOIN  cornjob_productsearch b ON a.product_id=b.product_id
INNER JOIN attribute_group f ON a.attribut_set = f.attribute_group_id
INNER JOIN seller_account_information g ON b.seller_id = g.seller_id
WHERE a.product_id
IN ($prodid_str) 
GROUP BY b.sku ORDER BY b.product_id DESC  ");

	if($query1->num_rows()>0)
	{
		return $query1;
	}else
		{
				$query2 = $this->db->query("SELECT a.add_date,b.product_id,b.name,c.sku, c.mrp, c.price, c.special_price, c.special_pric_from_dt, c.special_pric_to_dt, c.status, c.quantity,d.category_id,e.catelog_img_url,f.attribute_group_name,g.business_name 
				FROM product_setting a 
				INNER JOIN product_general_info b ON a.product_id=b.product_id 
				INNER JOIN product_master c ON a.product_id=c.product_id 
				INNER JOIN product_category d ON a.product_id=d.product_id 
				INNER JOIN product_image e ON a.product_id=e.product_id  
				INNER JOIN attribute_group f ON a.attribut_set=f.attribute_group_id INNER JOIN seller_account_information g ON c.seller_id=g.seller_id  where b.product_id IN ($prodid_str) GROUP BY c.sku ORDER BY a.id DESC ");
				return $query2;
		}
			}else{
				return false;
			}
		}
		else if($id=='' && $name=='' && $slr_name=='' && $select_att_name=='' && $sku=='' && $id_from=='' && $id_to=='' && $id_from2=='' && $id_to2=='' && $status==''){
			
			
			$query1 = $this->db->query("SELECT a.add_date, b.product_id, b.name, b.sku, b.mrp, b.price, b.special_price, b.special_pric_from_dt, b.special_pric_to_dt, b.status, b.quantity, b.lvl2, b.imag as catelog_img_url, f.attribute_group_name, g.business_name
FROM product_setting a INNER JOIN  cornjob_productsearch b ON a.product_id=b.product_id
INNER JOIN attribute_group f ON a.attribut_set = f.attribute_group_id
INNER JOIN seller_account_information g ON b.seller_id = g.seller_id
WHERE a.product_id
IN ($prodid_str) 
GROUP BY b.sku ORDER BY b.product_id DESC LIMIT ".$start.", ".$limit." ");

	if($query1->num_rows()>0)
	{
		return $query1;
	}else
		{
				$query2 = $this->db->query("SELECT a.add_date,b.product_id,b.name,c.sku, c.mrp, c.price, c.special_price, c.special_pric_from_dt, c.special_pric_to_dt, c.status, c.quantity,d.category_id,e.catelog_img_url,f.attribute_group_name,g.business_name 
				FROM product_setting a 
				INNER JOIN product_general_info b ON a.product_id=b.product_id 
				INNER JOIN product_master c ON a.product_id=c.product_id 
				INNER JOIN product_category d ON a.product_id=d.product_id 
				INNER JOIN product_image e ON a.product_id=e.product_id  
				INNER JOIN attribute_group f ON a.attribut_set=f.attribute_group_id INNER JOIN seller_account_information g ON c.seller_id=g.seller_id  where b.product_id IN ($prodid_str) GROUP BY c.sku ORDER BY a.id DESC LIMIT ".$start.", ".$limit."");
				//return $query2;
		}
			
			
			if($query2->num_rows() > 0){
				return $query2;
			}else{
				return false;
			}
		}
	}
	
	
	function filter_product_details_count(){
		$id = $_REQUEST['id_1'];
		$name = addslashes($_REQUEST['name1']);	
		$slr_name = addslashes($_REQUEST['slr_nm']);
		$select_att_name = $_REQUEST['select_att_name'];
		$sku = $_REQUEST['sku'];
		$id_from = $_REQUEST['id_from1'];
		$id_to = $_REQUEST['id_to1'];
		$id_from2 = $_REQUEST['id_from2'];	
		$id_to2 = $_REQUEST['id_to2'];
		$status = $_REQUEST['status_name1'];
		$condition = '';
		
		if( $id!=''){
			$condition .= "a.product_id='$id'";
			$query = $this->db->query("SELECT a.id FROM product_setting a 
		INNER JOIN product_general_info b ON a.product_id=b.product_id 
		INNER JOIN product_master c ON a.product_id=c.product_id 
		INNER JOIN product_category d ON a.product_id=d.product_id 
		INNER JOIN product_image e ON a.product_id=e.product_id  
		INNER JOIN attribute_group f ON a.attribut_set=f.attribute_group_id INNER JOIN seller_account_information g ON c.seller_id=g.seller_id  where ".$condition." GROUP BY e.product_id,c.sku ORDER BY a.id DESC");
			return $query->num_rows();
		}
		else if($name!=''){
			$condition .= "b.name LIKE '%$name%'";
			/* $query = $this->db->query("SELECT a.id FROM product_setting a 
		INNER JOIN product_general_info b ON a.product_id=b.product_id 
		INNER JOIN product_master c ON a.product_id=c.product_id 
		INNER JOIN product_category d ON a.product_id=d.product_id 
		INNER JOIN product_image e ON a.product_id=e.product_id  
		INNER JOIN attribute_group f ON a.attribut_set=f.attribute_group_id INNER JOIN seller_account_information g ON c.seller_id=g.seller_id  where ".$condition." GROUP BY e.product_id ORDER BY a.id DESC"); */
		
		$query = $this->db->query("SELECT b.product_id FROM product_general_info b where ".$condition." ");
			return $query->num_rows();
		}
		else if($slr_name!=''){
			$condition .= "g.business_name LIKE '%$slr_name%'";
			$query = $this->db->query("SELECT c.product_id FROM product_master c INNER JOIN seller_account_information g ON c.seller_id=g.seller_id WHERE $condition group by c.sku");
			return $query->num_rows();
		}
		else if($select_att_name!=''){
			$condition .= "f.attribute_group_id='$select_att_name'";
			$query = $this->db->query("SELECT a.product_id FROM product_setting a INNER JOIN attribute_group f ON a.attribut_set=f.attribute_group_id WHERE $condition");
			return $query->num_rows();
		}
		else if($sku!=''){
			$condition .= "c.sku='$sku'" ;
			$query = $this->db->query("SELECT c.product_id FROM product_master c WHERE $condition group by c.sku");
			return $query->num_rows();
		}
		else if($id_from!='' && $id_to!=''){
			$condition .= "c.price>='$id_from' and c.price<='$id_to'" ;
			$query = $this->db->query("SELECT c.product_id FROM product_master c WHERE $condition group by c.sku");
			return $query->num_rows();
		}
		else if($id_from2!='' && $id_to2!=''){
			$condition .= "c.quantity>='$id_from2' and c.quantity<='$id_to2'" ;
			$query = $this->db->query("SELECT c.product_id FROM product_master c WHERE $condition group by c.sku");
			return $query->num_rows();
		}
		else if($status!=''){
			$condition .= "c.status='$status'";
			$query = $this->db->query("SELECT c.product_id FROM product_master c WHERE $condition group by c.sku");
			return $query->num_rows();
		}
		else if( $id=='' && $name=='' && $slr_name=='' && $select_att_name=='' && $sku=='' && $id_from=='' && $id_to=='' && $id_from2=='' && $id_to2=='' && $status=='' ){
		$query = $this->db->query("SELECT id FROM product_setting");
		return $query->num_rows();
		}
	}
	
	
	function retrive_product_details_for_relative($sku){
		/* $query = $this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,f.attribute_group_name,g.related_product_id FROM product_setting a 
		INNER JOIN product_general_info b ON a.product_id=b.product_id 
		INNER JOIN product_master c ON a.product_id=c.product_id 
		INNER JOIN product_category d ON a.product_id=d.product_id 
		INNER JOIN product_image e ON a.product_id=e.product_id  
		INNER JOIN attribute_group f ON a.attribut_set=f.attribute_group_id 
		LEFT JOIN product_related g ON a.product_id=g.product_id WHERE c.sku NOT IN ('$sku') AND c.approve_status='Active' AND a.status='Active' GROUP BY e.product_id ORDER BY a.id DESC"); */
		
		$query = $this->db->query("SELECT a.*,b.*,c.*,f.attribute_group_name,g.related_product_id FROM product_setting a 
		INNER JOIN product_general_info b ON a.product_id=b.product_id 
		INNER JOIN product_master c ON a.product_id=c.product_id 
		INNER JOIN attribute_group f ON a.attribut_set=f.attribute_group_id 
		LEFT JOIN product_related g ON a.product_id=g.product_id WHERE c.sku NOT IN ('$sku') AND c.approve_status='Active' AND a.status='Active' ORDER BY a.id DESC");
		return $query;
	}
	
	function retrieve_only_related_products($sku){
		$query = $this->db->query("SELECT related_product_id FROM product_related WHERE sku_id='$sku'");
		return $query;
	}
	
	function insert_newtaxrate()
	{
		$tax_class=$this->input->post('tax_class');
		$txri_name=$this->input->post('txri_name');
		$country=$this->input->post('country');
		$state=$this->input->post('state');
		$tax_rate=$this->input->post('tax_rate');
				
		$data=array(
			'tax_class'=>$tax_class,
			'tri_name'=>$txri_name,
			'country'=>$country,
			'state'=>$state,
			'tax_rate_percentage'=>$tax_rate
		);
		
		$qr=$this->db->insert('tax_management',$data);
		
		if($this->session->userdata('logged_in')!=ADMIN_MAIL)
		{
			date_default_timezone_set('Asia/Calcutta');
			$cdate =date('y-m-d H:i:s');
			$uid= $this->session->userdata('logged_userrole_id');
			$uname=$this->session->userdata('logged_in');
			$log_data="New tax rate has inserted ";
				$data=array(
							
							'log_detail'=>$log_data,
							'user_id'=>$uid,
							'user_name'=>$uname,
							'log_datetime'=>$cdate
						);
						$this->db->insert('user_log',$data);
		}
		
		if($qr)
		{return true;}
		else
		{return false;}
	
	}
	
	function select_tax_list()
	{
		$qr=$this->db->query("select * from tax_management ");
		return $qr;
	}
	
	function select_taxclass()
	{
		$qr=$this->db->query("select distinct tax_class from tax_management ");
		return $qr;
			
	}
	function select_triname()
	{
		$qr=$this->db->query("select distinct tri_name from tax_management ");
		return $qr;
	}
	
	
	function select_country()
	{
		$qr=$this->db->query("select distinct country from tax_management ");
		return $qr;	
	}
	
	function select_state_data()
	{
		$country_name=$this->input->post('name');
			$qr=$this->db->query("select distinct state from tax_management where country='$country_name' ");
		return $qr;	
	}
	
	
	function select_filtered_tax_list()
	{
			$tax_classname = $this->input->post('tax_classname');
			$tax_idnf_name = $this->input->post('tax_idnf_name');
			$country = $this->input->post('country');
			$state = $this->input->post('state');
			$taxrate_from = $this->input->post('taxrate_from');
			$taxrate_to = $this->input->post('taxrate_to');
			
			//$condition = "b.status='Active' AND c.status='Active'";
			$condition = '';
			
			if($tax_classname != '' && $tax_idnf_name=='' && $country == '' && $state == '' && $taxrate_from == '' && $taxrate_to == '' ){
				$condition .= "tax_class='$tax_classname'" ;
			}
			if( $tax_classname == '' && $tax_idnf_name != '' && $country == '' && $state == '' & $taxrate_from == '' && $taxrate_to == ''){
				$condition .= "tri_name='$tax_idnf_name'" ;
			}
			//if($country != ''){
//				$condition .= "country='$country'";
//			}
			if($tax_classname == '' && $tax_idnf_name == '' && $country != '' && $state != '' && $taxrate_from == '' && $taxrate_to == ''){
				$condition .= "country='$country' AND state='$state'";
			}		
			
			if($tax_classname == '' && $tax_idnf_name == '' && $country == '' && $state == '' && $taxrate_from != '' && $taxrate_to != ''){
				$condition .= " tax_rate_percentage>='$taxrate_from' and tax_rate_percentage<='$taxrate_to' ";
			}
			
			if($tax_classname != '' && $tax_idnf_name != '' && $country == '' && $state == '' && $taxrate_from == '' && $taxrate_to == ''){
				$condition .= " tax_class='$tax_classname' and tri_name='$tax_idnf_name' ";
			}
			
			if($tax_classname != '' && $tax_idnf_name == '' && $country != '' && $state != '' && $taxrate_from == '' && $taxrate_to == ''){
				$condition .= " tax_class='$tax_classname' and country='$country' AND state='$state' ";
			}
			
			if($tax_classname != '' && $tax_idnf_name == '' && $country == '' && $state == '' && $taxrate_from != '' && $taxrate_to != ''){
				$condition .= " tax_class='$tax_classname' and tax_rate_percentage>='$taxrate_from' and tax_rate_percentage<='$taxrate_to' ";
			}
			
			if($tax_classname == '' && $tax_idnf_name != '' && $country != '' && $state != '' && $taxrate_from == '' && $taxrate_to == ''){
				$condition .= " tri_name='$tax_idnf_name' and country='$country' AND state='$state' ";
			}
			if($tax_classname != '' && $tax_idnf_name != '' && $country != '' && $state != '' && $taxrate_from == '' && $taxrate_to == ''){
				$condition .= "tax_class='$tax_classname' and tri_name='$tax_idnf_name' and country='$country' AND state='$state' ";
			}
			
			if($tax_classname == '' && $tax_idnf_name != '' && $country == '' && $state == '' && $taxrate_from != '' && $taxrate_to != ''){
				$condition .= " tri_name='$tax_idnf_name' and tax_rate_percentage>='$taxrate_from' and tax_rate_percentage<='$taxrate_to' ";
			}
			if($tax_classname == '' && $tax_idnf_name == '' && $country != '' && $state != '' && $taxrate_from != '' && $taxrate_to != ''){
				$condition .= " country='$country' AND state='$state' and tax_rate_percentage>='$taxrate_from' and tax_rate_percentage<='$taxrate_to' ";
			}
			if($tax_classname == '' && $tax_idnf_name != '' && $country != '' && $state != '' && $taxrate_from != '' && $taxrate_to != ''){
				$condition .= " tri_name='$tax_idnf_name' and country='$country' AND state='$state' and tax_rate_percentage>='$taxrate_from' and tax_rate_percentage<='$taxrate_to' ";
			}
			
			if($tax_classname != '' && $tax_idnf_name != '' && $country != '' && $state != '' && $taxrate_from != '' && $taxrate_to != ''){
				$condition .= " tax_class='$tax_classname' and tri_name='$tax_idnf_name' and country='$country' AND state='$state' and tax_rate_percentage>='$taxrate_from' and tax_rate_percentage<='$taxrate_to' ";
			}
			
			if($tax_classname != '' && $tax_idnf_name == '' && $country != '' && $state != '' && $taxrate_from != '' && $taxrate_to != ''){
				$condition .= " tax_class='$tax_classname' and country='$country' AND state='$state' and tax_rate_percentage>='$taxrate_from' and tax_rate_percentage<='$taxrate_to' ";
			}
					
			$query=$this->db->query("select * from tax_management where ".$condition);
			
			return $query;	
	
	}
	
	function retrive_product_attribute_group(){
		$query = $this->db->query("SELECT * FROM attribute_group ORDER BY attribute_group_name ASC");
		
		
		
		$result = $query->result();
		return $result;
	}
	function retrive_product_attribute_group1($product_id){
		//$query = $this->db->query("SELECT * FROM attribute_group ORDER BY attribute_group_name ASC");
		
		$query = $this->db->query("SELECT c.*
		FROM  product_setting b 
		INNER JOIN attribute_group c ON b.attribut_set = c.attribute_group_id		
		WHERE b.product_id='$product_id' ");
		
		
		$result = $query->result();
		return $result;
	}
	
	function retrive_product_tax_class(){
		$query = $this->db->query("SELECT tax_id,tri_name FROM tax_management");
		$result = $query->result();
		return $result;
	}
	
	function checking_sku(){
		$sku = $this->input->post('sku');
		$query = $this->db->query("SELECT sku FROM product_master WHERE sku='$sku'");
		$row = $query->num_rows();
		if($row <= 0){
			return false;
		}else{
			return true;
		}
	}
	
	// Admin Product Edit
	function getProductDetails($product_id, $sku){
		/*$sql = $this->db->query("SELECT seller_id FROM product_master WHERE sku='$sku'");
		$res = $sql->result();
		$slr_id = $res[0]->seller_id;
		if($slr_id == 0){
			$query = $this->db->query("SELECT a.*,b.product_type, c.attribute_group_name, c.attribute_group_id, d.*, e.imag,e.id AS IMAG_ID ,f.*, h.category_name,h.category_id
		FROM product_master a
		INNER JOIN product_setting b ON a.product_id = b.product_id
		INNER JOIN attribute_group c ON b.attribut_set = c.attribute_group_id
		INNER JOIN product_general_info d ON a.product_id = d.product_id
		INNER JOIN product_image e ON a.product_id = e.product_id
		INNER JOIN product_meta_info f ON a.product_id = f.product_id
		INNER JOIN product_category g ON a.product_id = g.product_id
		INNER JOIN category_indexing h ON g.category_id = h.category_id
		WHERE a.product_id='$product_id' AND a.sku='$sku'");
		}else{*/
			/* $query = $this->db->query("SELECT a.*,b.product_type, c.attribute_group_name, c.attribute_group_id, d.*, e.imag,e.id AS IMAG_ID ,f.*, h.category_name,h.category_id
		FROM product_master a
		INNER JOIN product_setting b ON a.product_id = b.product_id
		INNER JOIN attribute_group c ON b.attribut_set = c.attribute_group_id
		INNER JOIN product_general_info d ON a.product_id = d.product_id
		INNER JOIN product_image e ON a.product_id = e.product_id
		INNER JOIN product_meta_info f ON a.product_id = f.product_id
		INNER JOIN product_category g ON a.product_id = g.product_id
		INNER JOIN category_indexing h ON g.category_id = h.category_id
		WHERE a.product_id='$product_id' AND a.sku='$sku'"); */
		
		$query = $this->db->query("SELECT a.*,b.product_type, c.attribute_group_name, c.attribute_group_id, d.*, e.imag,e.id AS IMAG_ID ,f.*, h.category_name,h.category_id
		FROM product_master a
		INNER JOIN product_setting b ON a.product_id = b.product_id
		INNER JOIN attribute_group c ON b.attribut_set = c.attribute_group_id
		INNER JOIN product_general_info d ON a.product_id = d.product_id
		INNER JOIN product_image e ON a.product_id = e.product_id
		INNER JOIN product_meta_info f ON a.product_id = f.product_id
		INNER JOIN product_category g ON a.product_id = g.product_id
		INNER JOIN category_indexing h ON g.category_id = h.category_id
		WHERE a.product_id='$product_id' AND a.sku='$sku'");
		//}		
		$row = $query->num_rows();
		if($row > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	
	
	function getProductExitingDetails_4_edit($product_id, $sku){
		$query = $this->db->query("SELECT a.*,b.product_type, c.attribute_group_name, c.attribute_group_id, d.*, h.category_name,h.category_id
		FROM product_master a
		INNER JOIN product_setting b ON a.product_id = b.product_id
		INNER JOIN attribute_group c ON b.attribut_set = c.attribute_group_id
		INNER JOIN product_general_info d ON a.product_id = d.product_id
		INNER JOIN product_category g ON a.product_id = g.product_id
		INNER JOIN category_indexing h ON g.category_id = h.category_id
		WHERE a.product_id='$product_id' AND a.sku='$sku'");	
		$row = $query->num_rows();
		if($row > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	
	
	function get_nonapproved_existing_product_edit($product_id, $sku){
		/* $query = $this->db->query("SELECT a.*,b.product_type, c.attribute_group_name, c.attribute_group_id, d.*, e.imag,e.id AS IMAG_ID ,f.*, h.category_name,h.category_id
		FROM seller_product_master a
		INNER JOIN product_setting b ON a.master_product_id = b.product_id
		INNER JOIN attribute_group c ON b.attribut_set = c.attribute_group_id
		INNER JOIN product_general_info d ON a.master_product_id = d.product_id
		INNER JOIN product_image e ON a.master_product_id = e.product_id
		INNER JOIN product_meta_info f ON a.master_product_id = f.product_id
		INNER JOIN product_category g ON a.master_product_id = g.product_id
		INNER JOIN category_indexing h ON g.category_id = h.category_id
		WHERE a.master_product_id='$product_id' AND a.sku='$sku'"); */
		
		$query = $this->db->query("SELECT a.*,b.product_type, c.attribute_group_name, c.attribute_group_id, d.*, h.category_name,h.category_id
		FROM seller_product_master a
		INNER JOIN product_setting b ON a.master_product_id = b.product_id
		INNER JOIN attribute_group c ON b.attribut_set = c.attribute_group_id
		INNER JOIN product_general_info d ON a.master_product_id = d.product_id
		INNER JOIN product_category g ON a.master_product_id = g.product_id
		INNER JOIN category_indexing h ON g.category_id = h.category_id
		WHERE a.master_product_id='$product_id' AND a.sku='$sku'");
		$row = $query->num_rows();
		if($row > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function get_pending_ProductDetails($slr_product_id,$sku){
		/* $query = $this->db->query("SELECT a.* , b.image, b.id AS IMAG_ID, d . * , f.category_name, f.category_id, x.seller_id,x.attribute_set
	FROM seller_product_general_info a
	INNER JOIN seller_product_image b ON a.seller_product_id = b.seller_product_id
	INNER JOIN seller_product_setting x ON a.seller_product_id = x.seller_product_id
	INNER JOIN seller_product_price_info d ON a.seller_product_id = d.seller_product_id
	INNER JOIN seller_product_category e ON a.seller_product_id = e.seller_product_id
	INNER JOIN category_indexing f ON e.category = f.category_id
	WHERE a.sku='$sku' AND a.seller_product_id='$slr_product_id'"); */
	
	$query = $this->db->query("SELECT a.* , b.image, b.id AS IMAG_ID , f.category_name, f.category_id, x.seller_id,x.attribute_set
	FROM seller_product_general_info a
	INNER JOIN seller_product_image b ON a.seller_product_id = b.seller_product_id
	INNER JOIN seller_product_setting x ON a.seller_product_id = x.seller_product_id
	INNER JOIN seller_product_category e ON a.seller_product_id = e.seller_product_id
	INNER JOIN category_indexing f ON e.category = f.category_id
	WHERE a.sku='$sku' AND a.seller_product_id='$slr_product_id'");

		$row = $query->num_rows();
		if($row > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	
	
	function getting_pending_product_meta_info(){
		$slr_product_id = $this->input->post('slr_prod_id');
		$query = $this->db->query("SELECT * FROM seller_product_meta_info WHERE seller_product_id='$slr_product_id'");
		return $query->result();
	}
	
	function getting_pending_product_prc_n_invntry_info(){
		$slr_product_id = $this->input->post('slr_prod_id');
		$query = $this->db->query("SELECT a.*,b.quantity,c.weight FROM seller_product_price_info a 
		INNER JOIN seller_product_inventory_info b ON a.seller_product_id=b.seller_product_id 
		INNER JOIN seller_product_general_info c ON a.seller_product_id=c.seller_product_id WHERE a.seller_product_id='$slr_product_id'");
		return $query->result();
	}
	
	
	function getProductAttrValues($product_id, $sku){
		$res = $this->getSellerType($product_id, $sku);
		if($res == true){ 
			$query = $this->db->query("SELECT attr_value
			FROM product_attribute_value
			WHERE sku = '$sku'
			AND product_id ='$product_id'");
			$row = $query->num_rows();
			if($row > 0){
				return $query->result();
			}else{
				return false;
			}
		}else{
			$query = $this->db->query("SELECT c.attr_value
			FROM product_master a
			INNER JOIN seller_product_setting b ON a.product_id = b.master_product_id
			INNER JOIN seller_product_attribute_value c ON b.seller_product_id = c.seller_product_id
			WHERE c.sku = '$sku'");
			$row = $query->num_rows();
			if($row > 0){
				return $query->result();
			}else{
				return false;
			}
		}
	}
	
	function getSellerType($product_id, $sku){
		$query = $this->db->query("SELECT seller_id FROM product_master WHERE sku='$sku'");
		
		$d=$query->result(); 
		if($d[0]->seller_id == 0){
			return true;
		}else{
			return false;
		}
	}
	
	function getProductAttrValues1($sku){
		$query1 = $this->db->query("SELECT * FROM product_attribute_value WHERE sku='$sku'");
		$row = $query1->num_rows();
		if($row > 0){
			return $query1->result();
		}else{
			return false;
		}
	}
	
	function get_pending_ProductAttrValues($sku){
		$query1 = $this->db->query("SELECT * FROM seller_product_attribute_value WHERE sku='$sku'");
		$row = $query1->num_rows();
		if($row > 0){
			return $query1->result();
		}else{
			return false;
		}
	}
	
	function getDeleteProductImage(){
		$product_id = $this->input->post('product_id');
		$sku = $this->input->post('sku'); 
		$image_name = $this->input->post('image_name');
		$query1 = $this->db->query("SELECT b.imag FROM product_master a INNER JOIN product_image b ON a.product_id = b.product_id WHERE a.sku ='$sku'");
		$res = $query1->result(); 
		$re = explode(',', $res[0]->imag);
		$result1 = array_diff($re, [$image_name]);
		$impl = implode(',', $result1);
		//var_dump($impl);exit;
		$this->db->query("UPDATE product_image SET imag='$impl' WHERE product_id='$product_id'");
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	
	function getDelete_pending_ProductImage(){
		$slr_product_id = $this->input->post('product_id');
		$sku = $this->input->post('sku'); 
		$image_name = $this->input->post('image_name');
		$query1 = $this->db->query("SELECT a.image FROM seller_product_image a INNER JOIN seller_product_general_info b ON a.seller_product_id = b.seller_product_id WHERE b.sku ='$sku'");
		$res = $query1->result(); 
		$re = explode(',', $res[0]->image);
		$result1 = array_diff($re, [$image_name]);
		$impl = implode(',', $result1);
		//var_dump($impl);exit;
		$this->db->query("UPDATE seller_product_image SET image='$impl' WHERE seller_product_id='$slr_product_id'");
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	
	function retrieve_all_category(){
		$query = $this->db->query("SELECT * FROM category_indexing ORDER BY category_name ASC");
		return $query->result();
	}
	
	function insert_product_tmp_img($img_name){
		$seller_id = $this->session->userdata('session_slr_id');
		$img_strng = implode(',',$img_name);
		$data = array(
			'seller_id' => $seller_id,
			'imag' => $img_strng
		);
		$this->db->insert('temp_product_img',$data);
	}
	
	function insert_product_tmp_img_4_admin($img_name){
		$sesson_seller_id = $this->session->userdata('seller_session_id');
		$img_strng = implode(',',$img_name);
		$data = array(
			'session_id' => $sesson_seller_id,
			'seller_id' => 0,
			'imag' => $img_strng
		);
		$this->db->insert('temp_product_img',$data);
	}
	
	function delete_product_tmp_img($fileName){
		$sesson_seller_id = $this->session->userdata('seller_session_id');
		$this->db->where('imag',$fileName);
		$this->db->where('seller_id',0);
		$this->db->where('session_id',$sesson_seller_id);
		$this->db->delete('temp_product_img');
	}
	
	function getting_seller_id($sku){
		$query = $this->db->query("SELECT a.seller_id FROM seller_product_setting a INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id WHERE b.sku='$sku'");
		$result = $query->row();
		return $result->seller_id;
	}
	
	function getting_exiting_product_seller_id($sku){
		$query = $this->db->query("SELECT seller_id FROM seller_product_master WHERE sku='$sku'");
		$result = $query->row();
		return $result->seller_id;
	}
	
	function check_existing_product_approved_r_not($sku){
		$query = $this->db->query("SELECT sku FROM product_master WHERE sku='$sku'");
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	
	function update_inn_servc_tax(){
		$tx_id = $this->input->post('tx_id');
		$data = array('tax_rate_percentage' => $this->input->post('amt'));
		$this->db->where('tax_id',$tx_id);
		$this->db->update('tax_management',$data);
		if($this->db->affected_rows() > 0){
			return true;
		}
	}
	
	function search_seller_name(){
		$slr_name = $this->input->post('slr_nam');
		$query = $this->db->query("SELECT business_name FROM seller_account_information WHERE LOWER(business_name) LIKE '%$slr_name%' ORDER BY business_name");
		return $query;
	}
}