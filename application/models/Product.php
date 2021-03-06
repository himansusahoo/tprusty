<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Model {
    /* function insert_product_setting(){
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
      } */

    /* function insert_product_general_info(){
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
      } */

    /* function insert_product_price_info(){
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
      } */

    function insert_product_data() {
        //$img_name = implode(',', $name_array);
        //$name_array_length = count($name_array);

        $this->load->model('Usermodel');
        $product_id = $this->Usermodel->get_unique_id('product_setting', 'product_id');

        if ($this->input->post('country2') == -1) {
            $country = '';
        } else {
            $country = $this->input->post('country2');
        }

        $shipping_fee_type = $this->input->post('shipping_typ');
        if ($shipping_fee_type == 'Free') {
            $shipping_fee = 0;
            $shipping_fee_amount = 0;
        } else {
            $shipping_fee = $this->input->post('default_shipng_fee');
            $shipping_fee_amount = $this->input->post('hidden_shipping_fee');
        }

        //program start for sku generate//
        $prdt_name = $this->input->post('name');
        $first_three_char = substr($prdt_name, 0, 3);
        
        $code = preg_replace("/[^0-9]+/", "", date('Y-m-d H:i:s'));
        $this->load->helper('string');
        $randon_strng = random_string('alnum', 5);
        $sku = strtoupper($first_three_char . $randon_strng . $product_id . $code);
        //program end of sku generate//

        $product_setting_data = array(
            'product_id' => $product_id,
            'attribut_set' => $this->input->post('attribute_set'),
            'product_type' => $this->input->post('product_type'),
        );

        $product_master_data = array(
            'seller_id' => 0,
            'product_id' => $product_id,
            'sku' => $sku,
            'set_product_as_nw_frm_dt' => $this->input->post('from_date'),
            'set_product_as_nw_to_dt' => $this->input->post('to_date'),
            'status' => $this->input->post('prdt_sts'),
            'manufacture_country' => $country,
            'mrp' => $this->input->post('mrp'),
            'price' => $this->input->post('price'),
            'special_price' => $this->input->post('special_price'),
            'special_pric_from_dt' => $this->input->post('spcil_price_from_date'),
            'special_pric_to_dt' => $this->input->post('spcil_price_to_date'),
            'tax_amount' => $this->input->post('vat_cst'),
            'shipping_fee' => $shipping_fee,
            'shipping_fee_amount' => $shipping_fee_amount,
            'quantity' => $this->input->post('qty'),
            'max_qty_allowed_in_shopng_cart' => $this->input->post('max_qty'),
            'enable_qty_increment' => $this->input->post('enable_qty_increment'),
            'stock_availability' => $this->input->post('stock_avail'),
        );

        $product_general_data = array(
            'product_id' => $product_id,
            'name' => $this->input->post('name'),
            'description' => addslashes($this->input->post('prdt_desc')),
            'short_desc' => serialize($this->input->post('prdt_short_desc')),
            'weight' => $this->input->post('weight'),
            'featured' => $this->input->post('featured'),
        );

        /* $product_price_data = array(
          'product_id' => $product_id,
          'price' => $this->input->post('price'),
          'special_price' => $this->input->post('special_price'),
          'from_dt' => $this->input->post('from_date'),
          'to_dt' => $this->input->post('to_date'),
          'tax_class' => $this->input->post('tax_cls'),
          ); */

        $product_meta_data = array(
            'product_id' => $product_id,
            'meta_title' => $this->input->post('meta_title'),
            'meta_keywords' => $this->input->post('meta_keyword'),
            'meta_desc' => $this->input->post('meta_description'),
        );

        /* $product_inventory_data = array(
          'product_id' => $product_id,
          'quantity' => $this->input->post('qty'),
          'max_qty_allow_shopping' => $this->input->post('max_qty'),
          'enable_qty_increment' => $this->input->post('enable_qty_increment'),
          'stock_avail' => $this->input->post('stock_avail'),
          ); */

        $product_category_data = array(
            'product_id' => $product_id,
            'category_id' => $this->input->post('auto_category_name'),
        );

        /* $product_image_data = array(
          'product_id' => $product_id,
          'imag' => $img_name
          ); */

        $rltd_prdt_ids = $this->input->post('chk_product');
        if ($rltd_prdt_ids == '') {
            $related_prdt_ids = '';
        } else {
            $related_prdt_ids = serialize($rltd_prdt_ids);
        }

        $product_related_data = array(
            'product_id' => $product_id,
            'sku_id' => $sku,
            'related_product_id' => $related_prdt_ids
        );

        //data for product attribute//
        $attr_id = $this->input->post('hidden_attr_id');
        $attr_value = $this->input->post('attr_value');
        $attr_id_n_value = array_combine($attr_id, $attr_value);
        $attr_id_n_value_length = count($attr_id_n_value);
        //echo $attr_id_n_value_length;exit;
        //print_r($attr_id_n_value);exit;
        //data for product attribute//

        /* for($i=0; $i<$attr_id_n_value_length; $i++){
          $attr_val = $attr_value[$i];
          if($attr_val == ''){
          $attr_val = NULL;
          }else{
          $attr_val = $attr_value;
          }
          //print_r($attr_val);
          $product_attr_data = array(
          'product_id' => $product_id,
          'sku' => $sku,
          'attr_id' => $attr_id[$i],
          'attr_value' =>$attr_value[$i]
          );
          $this->db->insert('product_attribute_value',$product_attr_data);
          } */

        $this->db->insert('product_master', $product_master_data);
        $this->db->insert('product_setting', $product_setting_data);
        $this->db->insert('product_general_info', $product_general_data);
        $this->db->insert('product_meta_info', $product_meta_data);
        $this->db->insert('product_category', $product_category_data);
        //$this->db->insert('product_image',$product_image_data);
        $this->db->insert('product_related', $product_related_data);

        for ($i = 0; $i < $attr_id_n_value_length; $i++) {
            $attr_value = $attr_value[$i];
            if ($attr_value == '') {
                $attr_value = NULL;
            } else {
                $attr_value = $attr_value;
            }

            $product_attr_data = array(
                'product_id' => $product_id,
                'sku' => $sku,
                'attr_id' => $attr_id[$i],
                'attr_value' => $attr_value[$i]
            );
            $this->db->insert('product_attribute_value', $product_attr_data);
        }

        //program start for retrieve image from temp_imge table and insert in product_imag table//
        $query = $this->db->query("SELECT imag FROM temp_product_img WHERE seller_id=0");
        foreach ($query->result() as $img_row) {
            $imag[] = $img_row->imag;
        }
        $image = implode(',', $imag);
        $image_data = array(
            'product_id' => $product_id,
            'imag' => $image
        );
        $this->db->insert('product_image', $image_data);
        //program end of retrieve image from temp_imge table and insert in product_imag table//
        //program start for delete image from temp_img table//
        $this->db->where('seller_id', 0);
        $this->db->delete('temp_product_img');
        //program end of delete image from temp_img table//
        return true;
    }

    function insert_product_data_log() {
        
        $cdate = date('y-m-d H:i:s');
        $uid = $this->session->userdata('logged_userrole_id');
        $uname = $this->session->userdata('logged_in');
        $product_name = $this->input->post('name');
        $log_data = "This product(" . $product_name . ") has added as new product.";

        $data = array(
            'log_detail' => $log_data,
            'user_id' => $uid,
            'user_name' => $uname,
            'log_datetime' => $cdate
        );
        $this->db->insert('user_log', $data);
    }

    // Product Update
    function update_new_product() {
        //$img_name = implode(',', $arr_image);
        $product_id = $this->input->post('hidden_product_id');
        $seller_id = $this->input->post('hidden_product_sellerid');
        $product_sku = $this->input->post('hidden_product_sku');
        //$product_image = $this->input->post('hidden_product_image');  //echo $img_name; exit;
        //echo $product_image;exit;
        $query1 = $this->db->query("SELECT b.imag FROM product_master a INNER JOIN product_image b ON a.product_id = b.product_id WHERE a.sku ='$product_sku'");
        $res = $query1->result();
        $product_image = $res[0]->imag;
        //var_dump($h);exit;
        //program start for if added any new image//
        $tmp_img_sql = $this->db->query("SELECT imag FROM temp_product_img WHERE seller_id=0");
        $tmp_img_row = $tmp_img_sql->num_rows();
        if ($tmp_img_row > 0) {
            foreach ($tmp_img_sql->result() as $img_row) {
                $tmp_img[] = $img_row->imag;
            }
            $tmp_product_img = implode(',', $tmp_img);
        } else {
            $tmp_product_img = '';
        }

        //program end of if added any new image//

        $shipping_fee_type = $this->input->post('shipping_typ');
        if ($shipping_fee_type == 'Free') {
            $shipping_fee = 0;
            $shipping_fee_amount = 0;
        } else {
            $shipping_fee = $this->input->post('default_shipng_fee');
            $shipping_fee_amount = $this->input->post('hidden_shipping_fee');
        }

        /* $product_setting_data = array(
          'attribut_set'=>$this->input->post('attribute_set'),
          );
          $this->db->where('product_id', $product_id);
          $this->db->update('product_setting',$product_setting_data); */

        $product_master_data = array(
            'seller_id' => $seller_id,
            'sku' => $this->input->post('sku1'),
            'set_product_as_nw_frm_dt' => $this->input->post('from_date'),
            'set_product_as_nw_to_dt' => $this->input->post('to_date'),
            'status' => $this->input->post('prdt_sts'),
            'manufacture_country' => $this->input->post('country2'),
            'mrp' => $this->input->post('mrp'),
            'price' => $this->input->post('price'),
            'special_price' => $this->input->post('special_price'),
            'special_pric_from_dt' => $this->input->post('spcil_price_from_date'),
            'special_pric_to_dt' => $this->input->post('spcil_price_to_date'),
            'tax_amount' => $this->input->post('vat_cst'),
            'shipping_fee' => $shipping_fee,
            'shipping_fee_amount' => $shipping_fee_amount,
            'quantity' => $this->input->post('qty'),
            'max_qty_allowed_in_shopng_cart' => $this->input->post('max_qty'),
            'enable_qty_increment' => $this->input->post('enable_qty_increment'),
            'stock_availability' => $this->input->post('stock_avail'),
        );
        $this->db->where('product_id', $product_id);
        $this->db->where('sku', $product_sku);
        $this->db->update('product_master', $product_master_data);

        $product_general_data = array(
            'name' => $this->input->post('name'),
            'description' => addslashes($this->input->post('prdt_desc')),
            'short_desc' => serialize($this->input->post('prdt_short_desc')),
            'weight' => $this->input->post('weight'),
            'featured' => $this->input->post('featured'),
        );

        $this->db->where('product_id', $product_id);
        $this->db->update('product_general_info', $product_general_data);

        $product_meta_data = array(
            'meta_title' => $this->input->post('meta_title'),
            'meta_keywords' => $this->input->post('meta_keyword'),
            'meta_desc' => $this->input->post('meta_description'),
        );
        $this->db->where('product_id', $product_id);
        $this->db->update('product_meta_info', $product_meta_data);

        /* $product_category_data = array(
          'category_id' => $this->input->post('subcategory_id'),
          );
          $this->db->where('product_id', $product_id);
          $this->db->update('product_category', $product_category_data); */

        //echo $product_image.','.$img_name; exit;
        $product_image_data = array(
            'imag' => $product_image . ',' . $tmp_product_img,
        );

        $this->db->where('product_id', $product_id);
        $this->db->update('product_image', $product_image_data);

        //program start for delete image from temp_img table//
        $this->db->where('seller_id', 0);
        $this->db->delete('temp_product_img');
        //program end of delete image from temp_img table//
        //related product insert and update program start here//
        $sku_id = $this->input->post('sku1');
        $rltd_prdt_ids = $this->input->post('chk_product');
        if ($rltd_prdt_ids == '') {
            $related_prdt_ids = '';
        } else {
            $related_prdt_ids = serialize($rltd_prdt_ids);
        }

        $rel_qr = $this->db->query("SELECT * FROM product_related WHERE sku_id='$sku_id'");
        $row = $rel_qr->num_rows();
        if ($row > 0) {
            $product_related_data = array(
                'product_id' => $product_id,
                'related_product_id' => $related_prdt_ids
            );
            $this->db->where('sku_id', $sku_id);
            $this->db->update('product_related', $product_related_data);
        } else {
            $product_related_data = array(
                'product_id' => $product_id,
                'sku_id' => $sku_id,
                'related_product_id' => $related_prdt_ids
            );
            $this->db->insert('product_related', $product_related_data);
        }
        //related product insert and update program end here//
        //attribute program start here//
        $attr_id = $this->input->post('hidden_attr_id');
        $attr_value = $this->input->post('attr_value');
        $slr_attr_value = $this->input->post('slr_attr_value');

        //condition start for insert update in product_attribute_value table//
        if ($slr_attr_value == '') {
            $attr_id_n_value = array_combine($attr_id, $attr_value);
            $attr_id_n_value_length = count($attr_id_n_value);
            foreach ($attr_id_n_value as $k => $v) {
                if ($v != '') {
                    $atr_id[] = $k;
                    $atr_val[] = $v;
                }
            }
            $entry_atrid_n_atrval = array_combine($atr_id, $atr_val);

            foreach ($entry_atrid_n_atrval as $k => $v) {
                $qr = $this->db->query("SELECT * FROM product_attribute_value WHERE sku='$product_sku' AND attr_id='$k'");
                if ($qr->num_rows() > 0) {
                    $attr_data = array(
                        'attr_value' => $v,
                    );
                    $this->db->where('sku', $product_sku);
                    $this->db->where('attr_id', $k);
                    $this->db->update('product_attribute_value', $attr_data);
                } else {
                    $attr_data = array(
                        'product_id' => $product_id,
                        'sku' => $product_sku,
                        'attr_id' => $k,
                        'attr_value' => $v
                    );
                    $this->db->insert('product_attribute_value', $attr_data);
                }
            }
            //condition end of insert update in product_attribute_value table//
        } else {
            //condition start for insert update in seller_product_attribute_value table//
            //getting seller product id program start//
            $qr1 = $this->db->query("SELECT seller_product_id FROM seller_product_general_info WHERE sku='$product_sku'");
            $slr_product_id = $qr1->result()[0]->seller_product_id;
            //getting seller product id program end//

            $attr_id_n_value = array_combine($attr_id, $slr_attr_value);
            $attr_id_n_value_length = count($attr_id_n_value);
            foreach ($attr_id_n_value as $k => $v) {
                if ($v != '') {
                    $atr_id[] = $k;
                    $atr_val[] = $v;
                }
            }
            $entry_atrid_n_atrval = array_combine($atr_id, $atr_val);

            foreach ($entry_atrid_n_atrval as $k => $v) {
                $qr = $this->db->query("SELECT * FROM seller_product_attribute_value WHERE sku='$product_sku' AND attr_id='$k'");
                if ($qr->num_rows() > 0) {
                    $attr_data = array(
                        'attr_value' => $v,
                    );
                    $this->db->where('sku', $product_sku);
                    $this->db->where('attr_id', $k);
                    $this->db->update('seller_product_attribute_value', $attr_data);
                } else {
                    $attr_data = array(
                        'seller_product_id' => $slr_product_id,
                        'sku' => $product_sku,
                        'attr_id' => $k,
                        'attr_value' => $v
                    );
                    $this->db->insert('seller_product_attribute_value', $attr_data);
                }
            }
            //condition end of insert update in seller_product_attribute_value table//
        }
        //attribute program end here//
        return true;
    }

    //update new product without image
    /* function update_new_product1(){
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
      } */

    function update_new_product_log() {
        $product_name = $this->input->post('name');
        
        $cdate = date('y-m-d H:i:s');
        $uid = $this->session->userdata('logged_userrole_id');
        $uname = $this->session->userdata('logged_in');
        $log_data = "Product(" . $product_name . ") Data has modified ";
        $data = array(
            'log_detail' => $log_data,
            'user_id' => $uid,
            'user_name' => $uname,
            'log_datetime' => $cdate
        );
        $this->db->insert('user_log', $data);
    }

    function retrive_product_details() {
        $query = $this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,f.attribute_group_name,g.business_name FROM product_setting a 
		INNER JOIN product_general_info b ON a.product_id=b.product_id 
		INNER JOIN product_master c ON a.product_id=c.product_id 
		INNER JOIN product_category d ON a.product_id=d.product_id 
		INNER JOIN product_image e ON a.product_id=e.product_id  
		INNER JOIN attribute_group f ON a.attribut_set=f.attribute_group_id 
		INNER JOIN seller_account_information g ON c.seller_id=g.seller_id GROUP BY e.product_id ORDER BY a.id DESC");
        return $query;
    }

    function filter_product_details() {
        $id = $this->input->post('id_1');
        //print_r($id);exit;	
        $name = $this->input->post('name1');
        //print_r($name);exit;			
        $selected_type = $this->input->post('selected_type1');
        //print_r($selected_type);exit;	
        $select_att_name = $this->input->post('select_att_name');
        //print_r($select_att_name);exit;
        $sku = $this->input->post('sku');
        //print_r($sku);exit;
        $id_from = $this->input->post('id_from1');

        $id_to = $this->input->post('id_to1');
        //print_r($id_from);exit;			

        $id_from2 = $this->input->post('id_from2');
        $id_to2 = $this->input->post('id_to2');
        //print_r($id_from2);exit;	
        $status = $this->input->post('status_name1');
        //print_r($status);exit;

        $condition = '';

        if ($id != '' && $name == '' && $selected_type == '' && $select_att_name == '' && $sku == '' && $id_from == '' && $id_to == '' && $id_from2 == '' && $id_to2 == '' && $status == '') {
            $condition .= "a.product_id='$id'";
        }

        if ($id == '' && $name != '' && $selected_type == '' && $select_att_name == '' && $sku == '' && $id_from == '' && $id_to == '' && $id_from2 == '' && $id_to2 == '' && $status == '') {
            $condition .= "b.name='$name'";
        }

        if ($id == '' && $name == '' && $selected_type != '' && $select_att_name == '' && $sku == '' && $id_from == '' && $id_to == '' && $id_from2 == '' && $id_to2 == '' && $status == '') {
            $condition .= "a.product_type='$selected_type'";
        }

        if ($id == '' && $name == '' && $selected_type == '' && $select_att_name != '' && $sku == '' && $id_from == '' && $id_to == '' && $id_from2 == '' && $id_to2 == '' && $status == '') {
            $condition .= "f.attribute_group_id='$select_att_name'";
        }

        if ($id == '' && $name == '' && $selected_type == '' && $select_att_name == '' && $sku != '' && $id_from == '' && $id_to == '' && $id_from2 == '' && $id_to2 == '' && $status == '') {
            $condition .= "c.sku='$sku'";
        }

        if ($id == '' && $name == '' && $selected_type == '' && $select_att_name == '' && $sku == '' && $id_from != '' && $id_to != '' && $id_from2 == '' && $id_to2 == '' && $status == '') {
            $condition .= "c.price>='$id_from' and c.price<='$id_to'";
        }

        if ($id == '' && $name == '' && $selected_type == '' && $select_att_name == '' && $sku == '' && $id_from == '' && $id_to == '' && $id_from2 != '' && $id_to2 != '' && $status == '') {
            $condition .= "c.quantity>='$id_from2' and c.quantity<='$id_to2'";
        }

        if ($id == '' && $name == '' && $selected_type == '' && $select_att_name != '' && $sku == '' && $id_from == '' && $id_to == '' && $id_from2 == '' && $id_to2 == '' && $status != '') {
            $condition .= "c.status='$status'";
        }

        if ($id == '' && $name == '' && $selected_type == '' && $select_att_name == '' && $sku == '' && $id_from == '' && $id_to == '' && $id_from2 == '' && $id_to2 == '' && $status == '') {

            $query = $this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,f.attribute_group_name,g.business_name FROM product_setting a 
		INNER JOIN product_general_info b ON a.product_id=b.product_id 
		INNER JOIN product_master c ON a.product_id=c.product_id 
		INNER JOIN product_category d ON a.product_id=d.product_id 
		INNER JOIN product_image e ON a.product_id=e.product_id  
		INNER JOIN attribute_group f  ON a.attribut_set=f.attribute_group_id INNER JOIN seller_account_information g ON c.seller_id=g.seller_id GROUP BY e.product_id ORDER BY a.id DESC");
            return $query;
        }
        //echo $condition;exit;

        $query = $this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,f.attribute_group_name,g.business_name FROM product_setting a 
		INNER JOIN product_general_info b ON a.product_id=b.product_id 
		INNER JOIN product_master c ON a.product_id=c.product_id 
		INNER JOIN product_category d ON a.product_id=d.product_id 
		INNER JOIN product_image e ON a.product_id=e.product_id  
		INNER JOIN attribute_group f ON a.attribut_set=f.attribute_group_id INNER JOIN seller_account_information g ON c.seller_id=g.seller_id  where " . $condition . " GROUP BY e.product_id ORDER BY a.id DESC");
        return $query;
    }

    function retrive_product_details_for_relative($sku) {
        $query = $this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,f.attribute_group_name,g.related_product_id FROM product_setting a 
		INNER JOIN product_general_info b ON a.product_id=b.product_id 
		INNER JOIN product_master c ON a.product_id=c.product_id 
		INNER JOIN product_category d ON a.product_id=d.product_id 
		INNER JOIN product_image e ON a.product_id=e.product_id  
		INNER JOIN attribute_group f ON a.attribut_set=f.attribute_group_id 
		LEFT JOIN product_related g ON a.product_id=g.product_id WHERE c.sku NOT IN ('$sku') AND c.approve_status='Active' AND a.status='Active' GROUP BY e.product_id ORDER BY a.id DESC");
        return $query;
    }

    function retrieve_only_related_products($sku) {
        $query = $this->db->query("SELECT related_product_id FROM product_related WHERE sku_id='$sku'");
        return $query;
    }

    function insert_newtaxrate() {
        $tax_class = $this->input->post('tax_class');
        $txri_name = $this->input->post('txri_name');
        $country = $this->input->post('country');
        $state = $this->input->post('state');
        $tax_rate = $this->input->post('tax_rate');

        $data = array(
            'tax_class' => $tax_class,
            'tri_name' => $txri_name,
            'country' => $country,
            'state' => $state,
            'tax_rate_percentage' => $tax_rate
        );

        $qr = $this->db->insert('tax_management', $data);

        if (!$this->rbac->has_role('ADMIN')) {
            
            $cdate = date('y-m-d H:i:s');
            $uid = $this->session->userdata('logged_userrole_id');
            $uname = $this->session->userdata('logged_in');
            $log_data = "New tax rate has inserted ";
            $data = array(
                'log_detail' => $log_data,
                'user_id' => $uid,
                'user_name' => $uname,
                'log_datetime' => $cdate
            );
            $this->db->insert('user_log', $data);
        }

        if ($qr) {
            return true;
        } else {
            return false;
        }
    }

    function select_tax_list() {
        $qr = $this->db->query("select * from tax_management ");
        return $qr;
    }

    function select_taxclass() {
        $qr = $this->db->query("select distinct tax_class from tax_management ");
        return $qr;
    }

    function select_triname() {
        $qr = $this->db->query("select distinct tri_name from tax_management ");
        return $qr;
    }

    function select_country() {
        $qr = $this->db->query("select distinct country from tax_management ");
        return $qr;
    }

    function select_state_data() {
        $country_name = $this->input->post('name');
        $qr = $this->db->query("select distinct state from tax_management where country='$country_name' ");
        return $qr;
    }

    function select_filtered_tax_list() {
        $tax_classname = $this->input->post('tax_classname');
        $tax_idnf_name = $this->input->post('tax_idnf_name');
        $country = $this->input->post('country');
        $state = $this->input->post('state');
        $taxrate_from = $this->input->post('taxrate_from');
        $taxrate_to = $this->input->post('taxrate_to');

        //$condition = "b.status='Active' AND c.status='Active'";
        $condition = '';

        if ($tax_classname != '' && $tax_idnf_name == '' && $country == '' && $state == '' && $taxrate_from == '' && $taxrate_to == '') {
            $condition .= "tax_class='$tax_classname'";
        }
        if ($tax_classname == '' && $tax_idnf_name != '' && $country == '' && $state == '' & $taxrate_from == '' && $taxrate_to == '') {
            $condition .= "tri_name='$tax_idnf_name'";
        }
        //if($country != ''){
//				$condition .= "country='$country'";
//			}
        if ($tax_classname == '' && $tax_idnf_name == '' && $country != '' && $state != '' && $taxrate_from == '' && $taxrate_to == '') {
            $condition .= "country='$country' AND state='$state'";
        }

        if ($tax_classname == '' && $tax_idnf_name == '' && $country == '' && $state == '' && $taxrate_from != '' && $taxrate_to != '') {
            $condition .= " tax_rate_percentage>='$taxrate_from' and tax_rate_percentage<='$taxrate_to' ";
        }

        if ($tax_classname != '' && $tax_idnf_name != '' && $country == '' && $state == '' && $taxrate_from == '' && $taxrate_to == '') {
            $condition .= " tax_class='$tax_classname' and tri_name='$tax_idnf_name' ";
        }

        if ($tax_classname != '' && $tax_idnf_name == '' && $country != '' && $state != '' && $taxrate_from == '' && $taxrate_to == '') {
            $condition .= " tax_class='$tax_classname' and country='$country' AND state='$state' ";
        }

        if ($tax_classname != '' && $tax_idnf_name == '' && $country == '' && $state == '' && $taxrate_from != '' && $taxrate_to != '') {
            $condition .= " tax_class='$tax_classname' and tax_rate_percentage>='$taxrate_from' and tax_rate_percentage<='$taxrate_to' ";
        }

        if ($tax_classname == '' && $tax_idnf_name != '' && $country != '' && $state != '' && $taxrate_from == '' && $taxrate_to == '') {
            $condition .= " tri_name='$tax_idnf_name' and country='$country' AND state='$state' ";
        }
        if ($tax_classname != '' && $tax_idnf_name != '' && $country != '' && $state != '' && $taxrate_from == '' && $taxrate_to == '') {
            $condition .= "tax_class='$tax_classname' and tri_name='$tax_idnf_name' and country='$country' AND state='$state' ";
        }

        if ($tax_classname == '' && $tax_idnf_name != '' && $country == '' && $state == '' && $taxrate_from != '' && $taxrate_to != '') {
            $condition .= " tri_name='$tax_idnf_name' and tax_rate_percentage>='$taxrate_from' and tax_rate_percentage<='$taxrate_to' ";
        }
        if ($tax_classname == '' && $tax_idnf_name == '' && $country != '' && $state != '' && $taxrate_from != '' && $taxrate_to != '') {
            $condition .= " country='$country' AND state='$state' and tax_rate_percentage>='$taxrate_from' and tax_rate_percentage<='$taxrate_to' ";
        }
        if ($tax_classname == '' && $tax_idnf_name != '' && $country != '' && $state != '' && $taxrate_from != '' && $taxrate_to != '') {
            $condition .= " tri_name='$tax_idnf_name' and country='$country' AND state='$state' and tax_rate_percentage>='$taxrate_from' and tax_rate_percentage<='$taxrate_to' ";
        }

        if ($tax_classname != '' && $tax_idnf_name != '' && $country != '' && $state != '' && $taxrate_from != '' && $taxrate_to != '') {
            $condition .= " tax_class='$tax_classname' and tri_name='$tax_idnf_name' and country='$country' AND state='$state' and tax_rate_percentage>='$taxrate_from' and tax_rate_percentage<='$taxrate_to' ";
        }

        if ($tax_classname != '' && $tax_idnf_name == '' && $country != '' && $state != '' && $taxrate_from != '' && $taxrate_to != '') {
            $condition .= " tax_class='$tax_classname' and country='$country' AND state='$state' and tax_rate_percentage>='$taxrate_from' and tax_rate_percentage<='$taxrate_to' ";
        }

        $query = $this->db->query("select * from tax_management where " . $condition);

        return $query;
    }

    function retrive_product_attribute_group() {
        $query = $this->db->query("SELECT * FROM attribute_group ORDER BY attribute_group_name ASC");
        $result = $query->result();
        return $result;
    }

    function retrive_product_tax_class() {
        $query = $this->db->query("SELECT tax_id,tri_name FROM tax_management");
        $result = $query->result();
        return $result;
    }

    function checking_sku() {
        $sku = $this->input->post('sku');
        $query = $this->db->query("SELECT sku FROM product_master WHERE sku='$sku'");
        $row = $query->num_rows();
        if ($row <= 0) {
            return false;
        } else {
            return true;
        }
    }

    // Admin Product Edit
    function getProductDetails($product_id, $sku) {
        /* $sql = $this->db->query("SELECT seller_id FROM product_master WHERE sku='$sku'");
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
          }else{ */
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
        if ($row > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getProductAttrValues($product_id, $sku) {
        $res = $this->getSellerType($product_id, $sku);
        if ($res == true) {
            $query = $this->db->query("SELECT attr_value
			FROM product_attribute_value
			WHERE sku = '$sku'
			AND product_id ='$product_id'");
            $row = $query->num_rows();
            if ($row > 0) {
                return $query->result();
            } else {
                return false;
            }
        } else {
            $query = $this->db->query("SELECT c.attr_value
			FROM product_master a
			INNER JOIN seller_product_setting b ON a.product_id = b.master_product_id
			INNER JOIN seller_product_attribute_value c ON b.seller_product_id = c.seller_product_id
			WHERE c.sku = '$sku'");
            $row = $query->num_rows();
            if ($row > 0) {
                return $query->result();
            } else {
                return false;
            }
        }
    }

    function getSellerType($product_id, $sku) {
        $query = $this->db->query("SELECT seller_id FROM product_master WHERE sku='$sku'");

        $d = $query->result();
        if ($d[0]->seller_id == 0) {
            return true;
        } else {
            return false;
        }
    }

    function getProductAttrValues1($sku) {
        $query1 = $this->db->query("SELECT * FROM product_attribute_value WHERE sku='$sku'");
        $row = $query1->num_rows();
        if ($row > 0) {
            return $query1->result();
        } else {
            return false;
        }
    }

    function getDeleteProductImage() {
        $product_id = $this->input->post('product_id');
        $sku = $this->input->post('sku');
        $image_name = $this->input->post('image_name');
        $query1 = $this->db->query("SELECT b.imag FROM product_master a INNER JOIN product_image b ON a.product_id = b.product_id WHERE a.sku ='$sku'");
        $res = $query1->result();
        $re = explode(',', $res[0]->imag);
        $result1 = array_diff($re, [$image_name]);
        $impl = implode(',', $result1);
        //var_dump($impl);exit;
        $qr = $this->db->query("UPDATE product_image SET imag='$impl' WHERE product_id='$product_id'");
        return true;
    }

    function retrieve_all_category() {
        $query = $this->db->query("SELECT * FROM category_indexing ORDER BY category_name ASC");
        return $query->result();
    }

    function insert_product_tmp_img($img_name) {
        $img_strng = implode(',', $img_name);
        $data = array(
            'seller_id' => 0,
            'imag' => $img_strng
        );
        $this->db->insert('temp_product_img', $data);
    }

    function delete_product_tmp_img($fileName) {
        $this->db->where('imag', $fileName);
        $this->db->where('seller_id', 0);
        $this->db->delete('temp_product_img');
    }

}
