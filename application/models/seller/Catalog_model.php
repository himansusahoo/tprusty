<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Catalog_model extends CI_Model {

    function get_seller_product_id($table, $field) {
        $query = $this->db->query("SELECT MAX($field) AS `maxid` FROM " . $table);
        $maxId = $query->row()->maxid;
        $id = $maxId + 1;
        return $id;
    }

    function insert_new_product($seller_id) {
        $sesson_seller_id = $this->session->userdata('seller_session_id');
        $seller_product_id = $this->get_seller_product_id('seller_product_setting', 'seller_product_id');
        $seller_id = $this->session->userdata('seller-session');
        $chars = 4;
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rand_letter = substr(str_shuffle($letters), 0, $chars);
        $sku1 = str_replace(' ', '-', $this->input->post('sku'));
        $sku = $rand_letter . '-' . $seller_id . '-' . $sku1;

        $product_setting_data = array(
            'seller_product_id' => $seller_product_id,
            'seller_id' => $seller_id,
            'attribute_set' => $this->input->post('attribute_set')
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
        if ($shipping_fee_type == 'Free') {
            $shipping_fee = 0;
            $shipping_fee_amount = 0;
        } else {
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

        /* $img_list = implode(",", $arr_image);
          $product_image_data = array(
          'seller_product_id' => $seller_product_id,
          'image' => $img_list,
          );
          $this->db->insert('seller_product_image', $product_image_data); */

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
        $attr_id = $this->input->post('hidden_attr_id');
        $attr_fld_name = $this->input->post('attr_fld_nm');
        $attr_value = $this->input->post('attr_value');
        $attr_id_n_value = array_combine($attr_id, $attr_value);
        $attr_id_n_value_length = count($attr_id_n_value);

        for ($i = 0; $i < $attr_id_n_value_length; $i++) {
            /* $attr_value = $attr_value[$i];
              if($attr_value == ''){
              $attr_value = NULL;
              }else{
              $attr_value = $attr_value;
              } */

            if ($attr_fld_name[$i] == 'Size') {
                if ($attr_value[$i] != '') {
                    $sz_sql = $this->db->query("SELECT size_id FROM size_master WHERE size_name='$attr_value[$i]'");
                    $sz_row = $sz_sql->row();
                    $sz_id = $sz_row->size_id;
                    $product_sz_attr_data = array(
                        'sku_id' => $sku,
                        'm_size_id' => $sz_id,
                        'm_size_name' => $attr_value[$i]
                    );
                    $this->db->insert('size_attr', $product_sz_attr_data);
                }
            }

            //progrm for sub size attribute
            if ($attr_fld_name[$i] == 'Size Type') {
                if ($attr_value[$i] != '') {
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
                    if ($sq->num_rows() > 0) {
                        $product_sb_sz_attr_data1 = array(
                            's_size_id' => $sb_sz_id,
                            's_size_name' => $attr_value[$i]
                        );
                        $this->db->where('sku_id', $sku);
                        $this->db->update('size_attr', $product_sb_sz_attr_data1);
                    } else {
                        $this->db->insert('size_attr', $product_sb_sz_attr_data);
                    }
                    //program end of checking if sku is exits or not in size_attr table and insert or update
                }
            }

            //program for colour attribute
            if ($attr_fld_name[$i] == 'Color') {
                if ($attr_value[$i] != '') {
                    $clor_sql = $this->db->query("SELECT color_id FROM color_master WHERE clr_name='$attr_value[$i]'");
                    $clor_row = $clor_sql->row();
                    $clor_id = $clor_row->color_id;
                    $product_color_attr_data = array(
                        'sku_id' => $sku,
                        'color_id' => $clor_id,
                        'clr_name' => $attr_value[$i]
                    );
                    $this->db->insert('color_attr', $product_color_attr_data);
                }
            }

            $product_attr_data = array(
                'seller_product_id' => $seller_product_id,
                'sku' => $sku,
                'attr_id' => $attr_id[$i],
                'attr_value' => $attr_value[$i],
            );

            $this->db->insert('seller_product_attribute_value', $product_attr_data);
        }
        //Attribute program end here//
        //program start for retrieve image from temp_imge table and insert in product_imag table//
        $query = $this->db->query("SELECT imag FROM temp_product_img WHERE seller_id='$seller_id' AND session_id='$sesson_seller_id'");
        foreach ($query->result() as $img_row) {
            $imag[] = $img_row->imag;
        }
        $image = implode(',', $imag);
        $image_data = array(
            'seller_product_id' => $seller_product_id,
            'image' => $image,
            'catelog_img_url' => 'catalog_' . $imag[0]
        );
        $this->db->insert('seller_product_image', $image_data);
        //program end of retrieve image from temp_imge table and insert in product_imag table//
        //program start for delete image from temp_img table//
        $this->db->where('session_id', $sesson_seller_id);
        $this->db->where('seller_id', $seller_id);
        $this->db->delete('temp_product_img');
        //program end of delete image from temp_img table//	
        return true;
    }

    // Existing Product
    function search_existing_product_list($search_tittle) {
        $seller_id = $this->session->userdata('seller-session');

        $last_postslash = strripos($search_tittle, '/');
        $strpos_afterlastslash = $last_postslash + 1;
        $sub_stringsku = substr($search_tittle, $strpos_afterlastslash);

        /* if (preg_match('/[\'^ \" ]/', $search_tittle))
          {
          $search_tittle1=preg_replace('#"#',' ',preg_replace("/'/",' ',preg_replace('#/#',' ',$search_tittle)));
          $search_tittle=substr($search_tittle1,0,strpos($search_tittle1,' '));
          } */

        /* $query = $this->db->query("SELECT a.*, b.status, c.*, d.imag, f.category_name 
          FROM product_general_info a
          INNER JOIN product_setting b ON a.product_id = b.product_id
          INNER JOIN product_image d ON a.product_id = d.product_id
          INNER JOIN product_category e ON a.product_id = e.product_id
          INNER JOIN category_indexing f ON e.category_id = f.category_id
          INNER JOIN product_master c ON a.product_id = c.product_id
          WHERE (a.name LIKE '$search_tittle%' OR a.name LIKE '%$search_tittle%' OR a.name LIKE '%$search_tittle')
          AND c.product_id NOT IN (SELECT master_product_id FROM seller_product_master WHERE seller_id = '$seller_id')
          AND b.status = 'Active' GROUP BY a.product_id"); */

        $query = $this->db->query("select a.*, a.lvl2_name as category_name,b.description from cornjob_productsearch a 
			INNER JOIN product_general_info b ON a.product_id=b.product_id		 
		  WHERE a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active'
		 AND a.sku='$sub_stringsku'	group by a.sku");

        /* $query = $this->db->query("SELECT a.*,b.description FROM cornjob_productsearch a INNER JOIN product_general_info b ON a.product_id=b.product_id
          WHERE (a.name LIKE '$search_tittle%' OR a.name LIKE '%$search_tittle%' OR a.name LIKE '%$search_tittle')
          AND a.product_id NOT IN (SELECT master_product_id FROM seller_product_master WHERE seller_id = '$seller_id')
          AND a.prod_status = 'Active' GROUP BY a.product_id"); */

        $row = $query->num_rows();
        if ($row > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_seller_productid($table, $field) {
        $query = $this->db->query("SELECT MAX($field) AS `maxid` FROM " . $table);
        $maxId = $query->row()->maxid;
        $id = $maxId + 1;
        return $id;
    }

    function insert_existing_product() {
        $seller_id = $this->session->userdata('seller-session');
        $seller_product_id = $this->get_seller_productid('seller_product_master', 'seller_exist_product_id');

        /* On 26/10/15
          $shipping_fee_type = $this->input->post('shippingfee');
          if($shipping_fee_type == ''){
          $shipping_fee = $this->input->post('local_shipng_fee').','.$this->input->post('zonal_shipng_fee').','.$this->input->post('national_shipng_fee');
          }else if($shipping_fee_type == 'flat'){
          $shipping_fee = $this->input->post('flat_shipng_fee');
          }else{
          $shipping_fee = $this->input->post('shippingfee');
          } */

        $shipping_fee_type = $this->input->post('shipping_typ');
        if ($shipping_fee_type == 'Free') {
            $shipping_fee = 0;
            $shipping_fee_amount = 0;
        } else {
            $shipping_fee = $this->input->post('default_shipng_fee');
            $shipping_fee_amount = $this->input->post('hidden_shipping_fee');
        }


        $chars = 4;
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rand_letter = substr(str_shuffle($letters), 0, $chars);
        $sku1 = str_replace(' ', '-', $this->input->post('sku'));
        $sku_modfied = $rand_letter . '-' . $seller_id . '-' . $sku1;

        $exist_product_data = array(
            'seller_id' => $seller_id,
            'seller_exist_product_id' => $seller_product_id,
            'master_product_id' => $this->input->post('hidden_master_productID'),
            'product_type' => $this->input->post('prod_type'),
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
                //'max_qty_allowed_in_shopng_cart' => $this->input->post('max_qty_allowed'),
                //'enable_qty_increment' => $this->input->post('qty_increment'),
                //'stock_availability' => $this->input->post('stock_avail'),
        );
        $query = $this->db->insert('seller_product_master', $exist_product_data);



        //----------------------Attribute program start here--------------------------//
        //$attr_id = $this->input->post('hidden_attr_id');
//		$attr_fld_name = $this->input->post('attr_fld_nm');
//		$attr_value = $this->input->post('attr_value');
//		$attr_id_n_value = array_combine($attr_id,$attr_value);
//		$attr_id_n_value_length = count($attr_id_n_value);


        /* $attr_value = $attr_value[$i];
          if($attr_value == ''){
          $attr_value = NULL;
          }else{
          $attr_value = $attr_value;
          } */

        $size_nm = $this->input->post('sizeattr_value');
        if ($size_nm != '') {
            $sz_sql = $this->db->query("SELECT size_id FROM size_master WHERE size_name='$size_nm'");
            $sz_row = $sz_sql->row();
            $sz_id = $sz_row->size_id;
            $product_sz_attr_data = array(
                'sku_id' => $sku_modfied,
                'm_size_id' => $sz_id,
                'm_size_name' => $size_nm
            );
            $this->db->insert('size_attr', $product_sz_attr_data);
        } // if size not blank condition end
        //progrm for sub size attribute

        $sub_size = $this->input->post('attr_subsize');

        if ($sub_size != '') {
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
            if ($sq->num_rows() > 0) {
                $product_sb_sz_attr_data1 = array(
                    's_size_id' => $sb_sz_id,
                    's_size_name' => $sub_size
                );
                $this->db->where('sku_id', $sku_modfied);
                $this->db->update('size_attr', $product_sb_sz_attr_data1);
            } else {
                $this->db->insert('size_attr', $product_sb_sz_attr_data);
            }
            //program end of checking if sku is exits or not in size_attr table and insert or update
        } // subsize not blank end


        $color_attrb = $this->input->post('attr_color');

        if ($color_attrb != '') {
            $clor_sql = $this->db->query("SELECT color_id FROM color_master WHERE clr_name='$color_attrb'");
            $clor_row = $clor_sql->row();
            $clor_id = $clor_row->color_id;
            $product_color_attr_data = array(
                'sku_id' => $sku_modfied,
                'color_id' => $clor_id,
                'clr_name' => $color_attrb
            );
            $this->db->insert('color_attr', $product_color_attr_data);
        }

        $attr_id = array();
        $attr_value = array();


        $capacity_attrid = $this->input->post('hidden_attrcapacity_id');
        $capacity_attrvalue = $this->input->post('cpacity');

        if ($capacity_attrid != '' && $attr_value != '') {
            array_push($attr_id, $capacity_attrid);
            array_push($attr_value, $capacity_attrvalue);
        }

        $attrram_id = $this->input->post('hidden_attrram_id');
        $ram_attrvalue = $this->input->post('ram_memory');

        if ($attrram_id != '' && $ram_attrvalue != '') {
            array_push($attr_id, $attrram_id);
            array_push($attr_value, $ram_attrvalue);
        }

        $attrrom_id = $this->input->post('hidden_attrrom_id');
        $rom_memoryattrvalue = $this->input->post('rom_memory');

        if ($attrrom_id != '' && $rom_memoryattrvalue != '') {
            array_push($attr_id, $attrrom_id);
            array_push($attr_value, $rom_memoryattrvalue);
        }
        $attr_idcount = count($attr_id);
        $attr_valuecount = count($attr_value);

        if ($attr_idcount != 0 && $attr_valuecount != 0) {
            $i = 0;
            foreach ($attr_id as $attrkey => $attrval) {
                $product_attr_data = array(
                    'seller_product_id' => $seller_product_id,
                    'sku' => $sku_modfied,
                    'attr_id' => $attr_id[$i],
                    'attr_value' => $attr_value[$i],
                );

                $this->db->insert('seller_product_attribute_value', $product_attr_data);
                $i++;
            }
        }
        //----------------------Attribute program end here---------------------------//
        //-----------Product image insert start-------------------------------------//
        $sesson_seller_id = $this->session->userdata('seller_session_id');
        $query = $this->db->query("SELECT imag FROM temp_product_img WHERE seller_id='$seller_id'AND session_id='$sesson_seller_id' ");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $img_row) {
                $imag[] = $img_row->imag;
            }
            $image = implode(',', $imag);
            $image_data = array(
                'seller_extproduct_id' => $seller_product_id,
                'image' => $image,
                'catelog_img_url' => 'catalog_' . $imag[0]
            );
            $this->db->insert('seller_existingproduct_image', $image_data);
            //program end of retrieve image from temp_imge table and insert in product_imag table//
            //program start for delete image from temp_img table//
            $this->db->where('session_id', $sesson_seller_id);
            $this->db->where('seller_id', $seller_id);
            $this->db->delete('temp_product_img');
        } // temp image table check condtion end
        //------------product image insert end -------------------------------------//


        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    /* function insert_existing_product(){
      $seller_id = $this->session->userdata('seller-session');
      $seller_product_id = $this->get_seller_productid('seller_product_master', 'seller_exist_product_id');

      /* On 26/10/15
      $shipping_fee_type = $this->input->post('shippingfee');
      if($shipping_fee_type == ''){
      $shipping_fee = $this->input->post('local_shipng_fee').','.$this->input->post('zonal_shipng_fee').','.$this->input->post('national_shipng_fee');
      }else if($shipping_fee_type == 'flat'){
      $shipping_fee = $this->input->post('flat_shipng_fee');
      }else{
      $shipping_fee = $this->input->post('shippingfee');
      } */

    /* $shipping_fee_type = $this->input->post('shipping_typ');
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
      //'max_qty_allowed_in_shopng_cart' => $this->input->post('max_qty_allowed'),
      //'enable_qty_increment' => $this->input->post('qty_increment'),
      //'stock_availability' => $this->input->post('stock_avail'),
      );
      $query = $this->db->insert('seller_product_master', $exist_product_data);
      if($query){
      return true;
      }else{
      return false;
      }
      } */

    function update_existing_product() {
        $seller_exist_product_id = $this->input->post('seller_exist_product_id');
        $approve_status = $this->input->post('approve_status');
        $seller_id = $this->session->userdata('seller-session');
        $master_prcdt_id = $this->input->post('master_prcdt_id');
        $sku = $this->input->post('sku');

        $shipping_fee_type = $this->input->post('shipping_typ');
        if ($shipping_fee_type == 'Free') {
            $shipping_fee = 0;
            $shipping_fee_amount = 0;
        } else {
            $shipping_fee = $this->input->post('default_shipng_fee');
            $shipping_fee_amount = $this->input->post('hidden_shipping_fee');
        }
        $data = array(
            'status' => $this->input->post('status'),
            'mrp' => $this->input->post('price'),
            'price' => $this->input->post('selling_price'),
            'special_price' => $this->input->post('special_price'),
            'special_pric_from_dt' => $this->input->post('special_price_fr_date'),
            'special_pric_to_dt' => $this->input->post('special_price_to_date'),
            'quantity' => $this->input->post('qty'),
            'tax_amount' => $this->input->post('vat_cst'),
            'shipping_fee' => $shipping_fee,
            'shipping_fee_amount' => $shipping_fee_amount,
        );
        if ($approve_status == 'Pending') {
            $this->db->where('seller_exist_product_id', $seller_exist_product_id);
            $this->db->where('seller_id', $seller_id);
            $query1 = $this->db->update('seller_product_master', $data);
            $row1 = $this->db->affected_rows();
            if ($row1) {
                return true;
            } else {
                return false;
            }
        } else {
            //$this->db->where('product_id', $master_prcdt_id);
            $this->db->where('sku', $sku);
            $query2 = $this->db->update('product_master', $data);
            $row2 = $this->db->affected_rows();

            $this->db->where('seller_exist_product_id', $seller_exist_product_id);
            $this->db->where('seller_id', $seller_id);
            $query3 = $this->db->update('seller_product_master', $data);
            $row3 = $this->db->affected_rows();

            //Insert updated product id and sku in cornjob_product_update table
            $updt_data = array(
                'product_id' => $master_prcdt_id,
                'sku' => $sku
            );
            $this->db->insert('cornjob_product_update', $updt_data);

            if ($row2 || $row3) {
                return true;
            } else {
                return false;
            }
        }
    }

    function update_new_product() {
        $master_product_id = $this->input->post('master_product_id');
        $seller_product_id = $this->input->post('seller_product_id');
        $sku = $this->input->post('sku');
        if ($master_product_id == 0) {
            $data1 = array(
                'status' => $this->input->post('status'),
                'weight' => $this->input->post('weight')
            );
            $this->db->where('seller_product_id', $seller_product_id);
            $query1 = $this->db->update('seller_product_general_info', $data1);
            $row1 = $this->db->affected_rows();


            $shipping_fee_type = $this->input->post('shipping_typ');
            if ($shipping_fee_type == 'Free') {
                $shipping_fee = 0;
                $shipping_fee_amount = 0;
            } else {
                $shipping_fee = $this->input->post('default_shipng_fee');
                $shipping_fee_amount = $this->input->post('hidden_shipping_fee');
            }
            $data2 = array(
                'mrp' => $this->input->post('price'),
                'price' => $this->input->post('selling_price'),
                'special_price' => $this->input->post('special_price'),
                'price_fr_dt' => $this->input->post('special_price_fr_date'),
                'price_to_dt' => $this->input->post('special_price_to_date'),
                'tax_amount' => $this->input->post('vat_cst'),
                'shipping_fee' => $shipping_fee,
                'shipping_fee_amount' => $shipping_fee_amount,
            );
            $this->db->where('seller_product_id', $seller_product_id);
            $query2 = $this->db->update('seller_product_price_info', $data2);
            $row2 = $this->db->affected_rows();

            $data3 = array('quantity' => $this->input->post('qty'));
            $this->db->where('seller_product_id', $seller_product_id);
            $query3 = $this->db->update('seller_product_inventory_info', $data3);
            $row3 = $this->db->affected_rows();


            if ($row1 || $row2 || $row3) {
                return true;
            } else {
                return false;
            }
        } else {
            // Edit admin table in Exist Product
            $shipping_fee_type = $this->input->post('shipping_typ');
            if ($shipping_fee_type == 'Free') {
                $shipping_fee = 0;
                $shipping_fee_amount = 0;
            } else {
                $shipping_fee = $this->input->post('default_shipng_fee');
                $shipping_fee_amount = $this->input->post('hidden_shipping_fee');
            }
            $data4 = array(
                'status' => $this->input->post('status'),
                'mrp' => $this->input->post('price'),
                'price' => $this->input->post('selling_price'),
                'special_price' => $this->input->post('special_price'),
                'special_pric_from_dt' => $this->input->post('special_price_fr_date'),
                'special_pric_to_dt' => $this->input->post('special_price_to_date'),
                'quantity' => $this->input->post('qty'),
                'tax_amount' => $this->input->post('vat_cst'),
                'shipping_fee' => $shipping_fee,
                'shipping_fee_amount' => $shipping_fee_amount
            );
            $data5 = array(
                'product_id' => $master_product_id,
                'seller_id' => $this->session->userdata('seller-session')
            );
            $this->db->where($data5);
            $query4 = $this->db->update('product_master', $data4);
            $row4 = $this->db->affected_rows();

            $data9 = array('weight' => $this->input->post('weight'));
            $data10 = array(
                'product_id' => $master_product_id
            );
            $this->db->where($data10);
            $query8 = $this->db->update('product_general_info', $data9);
            $row8 = $this->db->affected_rows();

            // Edit seller table in exist Product
            $data6 = array(
                'status' => $this->input->post('status'),
                'weight' => $this->input->post('weight')
            );
            $this->db->where('seller_product_id', $seller_product_id);
            $query5 = $this->db->update('seller_product_general_info', $data6);
            $row5 = $this->db->affected_rows();

            $shipping_fee_type = $this->input->post('shipping_typ');
            if ($shipping_fee_type == 'Free') {
                $shipping_fee = 0;
                $shipping_fee_amount = 0;
            } else {
                $shipping_fee = $this->input->post('default_shipng_fee');
                $shipping_fee_amount = $this->input->post('hidden_shipping_fee');
            }
            $data7 = array(
                'mrp' => $this->input->post('price'),
                'price' => $this->input->post('selling_price'),
                'special_price' => $this->input->post('special_price'),
                'price_fr_dt' => $this->input->post('special_price_fr_date'),
                'price_to_dt' => $this->input->post('special_price_to_date'),
                'tax_amount' => $this->input->post('vat_cst'),
                'shipping_fee' => $shipping_fee,
                'shipping_fee_amount' => $shipping_fee_amount,
            );
            $this->db->where('seller_product_id', $seller_product_id);
            $query6 = $this->db->update('seller_product_price_info', $data7);
            $row6 = $this->db->affected_rows();

            $data8 = array('quantity' => $this->input->post('qty'));
            $this->db->where('seller_product_id', $seller_product_id);
            $query7 = $this->db->update('seller_product_inventory_info', $data8);
            $row7 = $this->db->affected_rows();

            //Insert updated product id and sku in cornjob_product_update table
            $updt_data = array(
                'product_id' => $master_product_id,
                'sku' => $sku
            );
            $this->db->insert('cornjob_product_update', $updt_data);

            if ($row4 || $row8 || $row5 || $row6 || $row7) {
                return true;
            } else {
                return false;
            }
        }
    }

    /*  ON 07/11
      function update_new_product_status(){
      $id = $this->input->post('product_id');
      $data = array(
      'status' => $this->input->post('status')
      );
      $this->db->where('seller_product_id', $id);
      $query = $this->db->update('seller_product_general_info', $data);
      if($query){
      return true;
      }else{
      return false;
      }
      }
      function update_new_product_selleingPrice(){
      $id = $this->input->post('product_id');
      $data = array(
      'special_price' => $this->input->post('special_price')
      );
      $this->db->where('seller_product_id', $id);
      $query = $this->db->update('seller_product_price_info', $data);
      if($query){
      return true;
      }else{
      return false;
      }
      }
      function update_new_product_quantity(){
      $id = $this->input->post('product_id');
      $data = array(
      'quantity' => $this->input->post('qty')
      );
      $this->db->where('seller_product_id', $id);
      $query = $this->db->update('seller_product_inventory_info', $data);
      if($query){
      return true;
      }else{
      return false;
      }
      } */

    function getExistProductInfo($data) {
        $product_id = $data['master_product_id'];
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

    function getExistProductattributeInfo($prod_id, $skuid) {
        $query = $this->db->query("SELECT attribut_set FROM product_setting WHERE product_id='$prod_id'");
        $attr_group_id_res = $query->result();
        $attr_group_id = $attr_group_id_res[0]->attribut_set;

        $sql = $this->db->query("SELECT * FROM attribute_real WHERE attribute_group_id='$attr_group_id' AND (attribute_field_name='Color' OR attribute_field_name='Size' OR attribute_field_name='Size Type' OR attribute_field_name='Capacity' OR  attribute_field_name='RAM' OR  attribute_field_name='ROM' ) ");
        //$rows = $sql->num_rows();	

        return $sql->result();
    }

    function getProductDetails($limit, $start, $seller_id) {
        $sql = $this->db->query("SELECT seller_product_id FROM seller_product_setting WHERE seller_id='$seller_id' GROUP BY seller_product_id ORDER BY seller_product_id DESC LIMIT " . $start . ", " . $limit . "");
        if ($sql->num_rows() > 0) {
            $res = $sql->result();
            foreach ($res as $row) {
                $slr_prdt_id_arr[] = $row->seller_product_id;
            }
            $slr_prdt_id = implode(',', $slr_prdt_id_arr);
            $query = $this->db->query("SELECT a.*, b.*, c.*, d.*, e.*,f.category
			FROM seller_product_setting a
			INNER JOIN seller_product_general_info b ON a.seller_product_id = b.seller_product_id
			INNER JOIN seller_product_price_info c ON a.seller_product_id = c.seller_product_id
			INNER JOIN seller_product_image d ON a.seller_product_id = d.seller_product_id
			INNER JOIN seller_product_inventory_info e ON a.seller_product_id = e.seller_product_id
			INNER JOIN seller_product_category f ON a.seller_product_id = f.seller_product_id
			WHERE a.seller_product_id IN ($slr_prdt_id) group by b.sku");
            return $query->result();
            ;
        } else {
            return false;
        }

        // $query = $this->db->query("SELECT a.*, b.*, c.*, d.*, e.*,f.category
        // FROM seller_product_setting a
        // INNER JOIN seller_product_general_info b ON a.seller_product_id = b.seller_product_id
        // INNER JOIN seller_product_price_info c ON a.seller_product_id = c.seller_product_id
        // INNER JOIN seller_product_image d ON a.seller_product_id = d.seller_product_id
        // INNER JOIN seller_product_inventory_info e ON a.seller_product_id = e.seller_product_id
        // INNER JOIN seller_product_category f ON a.seller_product_id = f.seller_product_id
        // WHERE a.seller_id = '$seller_id' GROUP BY d.seller_product_id ORDER BY a.seller_product_id DESC LIMIT ".$start.", ".$limit."");
        // if($query->num_rows() > 0){
        // return $query->result();
        // }else{
        // return false;
        // }
    }

    function getProductDetails_serch_nw_prdt($limit, $start, $seller_id) {
        $search_title = $_REQUEST['search_title'];

        if ($search_title != '') {
            $sql = $this->db->query("SELECT a.seller_product_id FROM seller_product_setting a INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id WHERE a.seller_id='$seller_id' AND (b.name LIKE '$search_title%' OR b.name LIKE '%$search_title%' OR b.name LIKE '%$search_title') GROUP BY a.seller_product_id ORDER BY a.seller_product_id DESC LIMIT " . $start . ", " . $limit . "");
            if ($sql->num_rows() > 0) {
                $res = $sql->result();
                foreach ($res as $row) {
                    $slr_prdt_id_arr[] = $row->seller_product_id;
                }
                $slr_prdt_id = implode(',', $slr_prdt_id_arr);
                $query = $this->db->query("SELECT a.*, b.*, c.*, d.*, e.*,f.category
				FROM seller_product_setting a
				INNER JOIN seller_product_general_info b ON a.seller_product_id = b.seller_product_id
				INNER JOIN seller_product_price_info c ON a.seller_product_id = c.seller_product_id
				INNER JOIN seller_product_image d ON a.seller_product_id = d.seller_product_id
				INNER JOIN seller_product_inventory_info e ON a.seller_product_id = e.seller_product_id
				INNER JOIN seller_product_category f ON a.seller_product_id = f.seller_product_id
				WHERE a.seller_product_id IN ($slr_prdt_id)");
                return $query->result();
            } else {
                return false;
            }
        } else if ($search_title == '') {
            $sql = $this->db->query("SELECT a.seller_product_id FROM seller_product_setting a INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id WHERE a.seller_id='$seller_id' GROUP BY a.seller_product_id ORDER BY a.seller_product_id DESC LIMIT " . $start . ", " . $limit . "");
            if ($sql->num_rows() > 0) {
                $res = $sql->result();
                foreach ($res as $row) {
                    $slr_prdt_id_arr[] = $row->seller_product_id;
                }
                $slr_prdt_id = implode(',', $slr_prdt_id_arr);
                $query = $this->db->query("SELECT a.*, b.*, c.*, d.*, e.*,f.category
				FROM seller_product_setting a
				INNER JOIN seller_product_general_info b ON a.seller_product_id = b.seller_product_id
				INNER JOIN seller_product_price_info c ON a.seller_product_id = c.seller_product_id
				INNER JOIN seller_product_image d ON a.seller_product_id = d.seller_product_id
				INNER JOIN seller_product_inventory_info e ON a.seller_product_id = e.seller_product_id
				INNER JOIN seller_product_category f ON a.seller_product_id = f.seller_product_id
				WHERE a.seller_product_id IN ($slr_prdt_id)");
                return $query->result();
            } else {
                return false;
            }
        }
    }

    function seller_new_product_count($seller_id) {
        $query = $this->db->query("SELECT a.id FROM seller_product_setting a 
		INNER JOIN seller_product_general_info b on a.seller_product_id = b.seller_product_id
		 WHERE a.seller_id = '$seller_id' group by b.sku");
        return $query->num_rows();
    }

    function serch_seller_new_product_count($seller_id) {
        $search_title = $_REQUEST['search_title'];
        if ($search_title != '') {
            $query = $this->db->query("SELECT a.id FROM seller_product_setting a INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id WHERE a.seller_id = '$seller_id' AND (b.name LIKE '$search_title%' OR b.name LIKE '%$search_title%' OR b.name LIKE '%$search_title')");
            return $query->num_rows();
        } else if ($search_title == '') {
            $query = $this->db->query("SELECT a.id FROM seller_product_setting a INNER JOIN seller_product_general_info b ON a.seller_product_id=b.seller_product_id WHERE a.seller_id = '$seller_id'");
            return $query->num_rows();
        }
    }

    function getExistNewProductDetails($limit, $start, $seller_id) {
        $query = $this->db->query("SELECT a.*, b.name,b.weight, b.description, c.imag,c.catelog_img_url,d.category_id AS category, e.category_name
		FROM seller_product_master a
		INNER JOIN product_general_info b ON a.master_product_id = b.product_id
		INNER JOIN product_image c ON a.master_product_id = c.product_id
		INNER JOIN product_category d ON a.master_product_id = d.product_id
		INNER JOIN category_indexing e ON d.category_id = e.category_id
		WHERE a.seller_id ='$seller_id'
		ORDER BY a.seller_exist_product_id DESC LIMIT " . $start . ", " . $limit . "");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getExistNewProductDetails_serch($limit, $start, $seller_id) {
        $search_title = $_REQUEST['search_title'];

        if ($search_title != '') {
            $query = $this->db->query("SELECT a.*, b.name,b.weight, b.description, c.imag,c.catelog_img_url,d.category_id AS category, e.category_name
			FROM seller_product_master a
			INNER JOIN product_general_info b ON a.master_product_id = b.product_id
			INNER JOIN product_image c ON a.master_product_id = c.product_id
			INNER JOIN product_category d ON a.master_product_id = d.product_id
			INNER JOIN category_indexing e ON d.category_id = e.category_id
			WHERE a.seller_id ='$seller_id' AND (b.name LIKE '$search_title%' OR b.name LIKE '%$search_title%' OR b.name LIKE '%$search_title') ORDER BY a.seller_exist_product_id DESC LIMIT " . $start . ", " . $limit . "");
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        } else if ($search_title == '') {
            $query = $this->db->query("SELECT a.*, b.name,b.weight, b.description, c.imag,c.catelog_img_url,d.category_id AS category, e.category_name
			FROM seller_product_master a
			INNER JOIN product_general_info b ON a.master_product_id = b.product_id
			INNER JOIN product_image c ON a.master_product_id = c.product_id
			INNER JOIN product_category d ON a.master_product_id = d.product_id
			INNER JOIN category_indexing e ON d.category_id = e.category_id
			WHERE a.seller_id ='$seller_id'
			ORDER BY a.seller_exist_product_id DESC LIMIT " . $start . ", " . $limit . "");
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }
    }

    function seller_exiting_product_count($seller_id) {
        $query = $this->db->query("SELECT id FROM seller_product_master WHERE seller_id ='$seller_id'");
        return $query->num_rows();
    }

    function serch_seller_exiting_product_count($seller_id) {
        $search_title = $_REQUEST['search_title'];
        if ($search_title != '') {
            $query = $this->db->query("SELECT a.id FROM seller_product_master a INNER JOIN product_general_info b ON a.master_product_id=b.product_id WHERE a.seller_id = '$seller_id' AND (b.name LIKE '$search_title%' OR b.name LIKE '%$search_title%' OR b.name LIKE '%$search_title')");
            return $query->num_rows();
        } else if ($search_title == '') {
            $query = $this->db->query("SELECT a.id FROM seller_product_master a INNER JOIN product_general_info b ON a.master_product_id=b.product_id WHERE a.seller_id = '$seller_id'");
            return $query->num_rows();
        }
    }

    function filter_new_product_status($seller_id) {
        $status = $this->input->post('approve_status');
        $status = explode(',', $status);
        $query = $this->db->query("SELECT a.*, b.*, c.*, d.*, e.*
			FROM seller_product_setting a
			INNER JOIN seller_product_general_info b ON a.seller_product_id = b.seller_product_id
			INNER JOIN seller_product_price_info c ON a.seller_product_id = c.seller_product_id
			INNER JOIN seller_product_image d ON a.seller_product_id = d.seller_product_id
			INNER JOIN seller_product_inventory_info e ON a.seller_product_id = e.seller_product_id
			WHERE a.seller_id = '$seller_id' AND a.product_approve IN ('" . implode("', '", $status) . "') 
			GROUP BY d.seller_product_id ORDER BY a.seller_product_id DESC");
        return $query;
    }

    function filter_exist_product_status($seller_id) {
        $approve_status = $this->input->post('approve_status');
        $approve_status = explode(',', $approve_status);
        $query = $this->db->query("SELECT a.*, b.*, c.*, f.*
		FROM seller_product_master a
		INNER JOIN product_general_info b ON a.master_product_id = b.product_id
		INNER JOIN product_image c ON a.master_product_id = c.product_id
		INNER JOIN product_category e ON a.master_product_id = e.product_id
		INNER JOIN category_indexing f ON e.category_id = f.category_id
		WHERE a.seller_id = '$seller_id' AND a.approve_status IN ('" . implode("', '", $approve_status) . "') 
		ORDER BY a.seller_exist_product_id DESC");
        return $query;
    }

    //  SKU Checking
    function getProductMastersku($sku) {
        $query = $this->db->query("SELECT * from product_master WHERE sku='$sku'");
        $row = $query->num_rows();
        if ($row > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getSellerGeneralsku($sku) {
        $query = $this->db->query("SELECT * from seller_product_general_info WHERE sku='$sku'");
        $row = $query->num_rows();
        if ($row > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getSellerMastersku($sku) {
        $query = $this->db->query("SELECT * from seller_product_master WHERE sku='$sku'");
        $row = $query->num_rows();
        if ($row > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getTaxClasses() {
        $query = $this->db->query("SELECT * FROM tax_management");
        return $query->result();
    }

    function getCategories() {
        $query = $this->db->query("SELECT a. * FROM category_indexing a INNER JOIN category_master b 
		ON a.category_id = b.category_id WHERE b.active_status = 'yes' AND a.parent_id = 0 ");
        return $query->result();
    }

    function getAttributes() {
        $query = $this->db->query("SELECT * FROM attribute_group");
        return $query->result();
    }

    function getSubcategories($cate_id) {
        $query = $this->db->query("SELECT a. * FROM category_indexing a INNER JOIN category_master b 
		ON a.category_id = b.category_id WHERE b.active_status = 'yes' AND a.parent_id = '$cate_id' ");
        return $query->result();
    }

    // Approve product model function
    function getExitApprovedProducts($seller_id) {
        $query = $this->db->query("SELECT a.sku, a.approve_status, a.current_date, d.category_name, e.business_name
		FROM seller_product_master a
		INNER JOIN product_master b ON a.master_product_id = b.product_id
		INNER JOIN product_category c ON a.master_product_id = c.product_id
		INNER JOIN category_indexing d ON c.category_id = d.category_id
		INNER JOIN seller_account_information e ON a.seller_id = e.seller_id
		WHERE a.seller_id ='$seller_id' AND b.seller_id ='$seller_id'");

        $row = $query->num_rows();
        if ($row > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getNewApprovedProducts($seller_id) {
        $query = $this->db->query("SELECT a.date_added, a.product_approve, c.sku, e.category_name, f.business_name
		FROM seller_product_setting a
		INNER JOIN product_master b ON a.master_product_id = b.product_id
		INNER JOIN seller_product_general_info c ON a.seller_product_id = c.seller_product_id
		INNER JOIN seller_product_category d ON a.seller_product_id = d.seller_product_id
		INNER JOIN category_indexing e ON d.category = e.category_id
		INNER JOIN seller_account_information f ON a.seller_id = f.seller_id
		WHERE a.seller_id ='$seller_id' AND b.seller_id ='$seller_id'");
        $row = $query->num_rows();
        if ($row > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getFixedCharges() {
        date_default_timezone_set('Asia/Calcutta');
        $cdate = date('Y-m-d');
        $query = $this->db->query("SELECT * FROM charges_master WHERE charges_type='Seasonal Charges'");
        $result = $query->result();
        $seasonal_charges_first_dt = $result[0]->from_dt;
        $seasonal_charges_last_dt = $result[0]->to_date;
        $seasonal_charges_status = $result[0]->status;
        if ($cdate >= $seasonal_charges_first_dt && $cdate <= $seasonal_charges_last_dt) {
            if ($seasonal_charges_status != 'fix_include') {
                return 'NOT';
            } else {
                $query1 = $this->db->query("SELECT * FROM charges_master WHERE charges_type='Fixed Charges'");
                return $query1->result();
            }
        } else {
            $query2 = $this->db->query("SELECT * FROM charges_master WHERE charges_type='Fixed Charges'");
            return $query2->result();
        }
    }

    function getPgCharges() {
        $query = $this->db->query("SELECT * FROM charges_master WHERE charges_type='Payment gateway Charges'");
        return $query->result();
    }

    function getSeasonalCharges() {
        date_default_timezone_set('Asia/Calcutta');
        $cdate = date('Y-m-d');
        $query = $this->db->query("SELECT * FROM charges_master WHERE charges_type='Seasonal Charges' AND from_dt<='$cdate' AND to_date>='$cdate'");
        $row = $query->num_rows();
        if ($row > 0) {
            return $query->result();
        } else {
            return 'NOT';
        }
    }

    /* function getCommissionCharges(){
      date_default_timezone_set('Asia/Calcutta');
      $cdate = date('Y-m-d');
      $seller_id = $this->session->userdata('seller-session');
      //program start for any special commission exists or not//
      $query = $this->db->query("SELECT * FROM special_commission WHERE from_date<='$cdate' AND to_date>='$cdate'");
      $rows = $query->num_rows();
      if($rows > 0){
      return $query->result();
      }else{
      //Membership commission program start here//
      $query1 = $this->db->query("SELECT * FROM membership_seller WHERE seller_id='$seller_id'");
      $row1= $query1->num_rows();
      if($row1 > 0){
      $result = $query1->result();
      $memb_id = $result[0]->memb_id;
      $qr2 = $this->db->query("SELECT * FROM membership WHERE mbrshp_id='$memb_id'");
      $rs2 = $qr2->result();
      $MEMB_COLUMN = $rs2[0]->menbshp_column;
      $qr3 = $this->db->query("SELECT cat_id,'$MEMB_COLUMN' FROM membership_commission");
      }
      //Membership commission program end here//
      }
      //program end of any special commission exists or not//
      } */


    /* function getSpecialCommissionCharges(){
      date_default_timezone_set('Asia/Calcutta');
      $cdate = date('Y-m-d');
      $seller_id = $this->session->userdata('seller-session');
      $query = $this->db->query("SELECT * FROM special_commission WHERE from_date<='$cdate' AND to_date>='$cdate'");
      $rows = $query->num_rows();
      if($rows > 0){
      //Program start for check if seller id exists or not in special commission//
      $result = $query->result();
      foreach($result as $row){
      $special_seller_id = unserialize($row->seller_id);
      $spl_category_id[] = $row->cat_id;
      $spl_commission[] = $row->commision;
      foreach($special_seller_id as $k=>$v){
      $special_seller_ids[] = $v;
      }
      }
      if(in_array($seller_id,array_unique($special_seller_ids))){ //program for if exist
      $spl_cat_id_n_commission = array_combine($spl_category_id,$spl_commission);
      return $spl_cat_id_n_commission;
      }else{
      return 'NOT';
      }
      }else{
      return 'NOT';
      }
      } */

    /* function getMembrspCommissionCharges(){
      $seller_id = $this->session->userdata('seller-session');
      $query = $this->db->query("SELECT * FROM membership_seller WHERE seller_id='$seller_id'");
      $row= $query->num_rows();
      if($row > 0){
      $result = $query->result();
      $memb_id = $result[0]->memb_id;
      $qr2 = $this->db->query("SELECT * FROM membership WHERE mbrshp_id='$memb_id'");
      $rs2 = $qr2->result();
      $MEMB_COLUMN = $rs2[0]->menbshp_column;
      $qr3 = $this->db->query("SELECT cat_id,`$MEMB_COLUMN` FROM membership_commission");
      foreach($qr3->result() as $rw){
      $memb_cat_id[] = $rw->cat_id;
      $memb_commission[] = $rw->$MEMB_COLUMN;
      }
      return array_combine($memb_cat_id,$memb_commission);
      }else{
      return 'NOT';
      }
      } */

    /* function getGlobalCommissionCharges(){
      $query = $this->db->query("SELECT * FROM global_commission");
      $rows = $query->num_rows();
      if($rows > 0){
      foreach($query->result() as $row){
      $global_cat_id[] = $row->cat_id;
      $global_commission[] = $row->commission;
      }
      return array_combine($global_cat_id,$global_commission);
      }else{
      return 'NOT';
      }
      } */

    function getCommission() {
        $sl = $this->input->post('serial');
        //'$second_leable_cat_id' is the third label category id//
        $second_leable_cat_id = $this->input->post('cat_id');
        $selling_price = $this->input->post('price');
        $shipping_fee = $this->input->post('shipping_fee');
        $final_price = $selling_price + $shipping_fee;
        $sty_id = 'fcmsn' . $sl;
        date_default_timezone_set('Asia/Calcutta');
        $cdate = date('Y-m-d');
        $seller_id = $this->session->userdata('seller-session');
        //special commission condition program start here//
        $query = $this->db->query("SELECT * FROM special_commission WHERE from_date<='$cdate' AND to_date>='$cdate' AND cat_id='$second_leable_cat_id'");
        $rows = $query->num_rows();
        if ($rows > 0) {
            $result = $query->result();
            $special_seller_id = unserialize($result[0]->seller_id);
            if ($result[0]->seller_id == Null) { //if no seller id in this date range , applicable to all seller
                $spl_cmsn = $result[0]->commision;
                $spl_percent_decimal = $spl_cmsn / 100;
                $spl_cmsn_amt = round($final_price * $spl_percent_decimal);
                echo '<span class="' . $sty_id . '">' . $spl_cmsn_amt . '</span><br/><br/>';
                echo '<span class="vspn">( ' . $spl_cmsn . '% of total sale value)</span>';
            } else if (in_array($seller_id, $special_seller_id)) { //program for if exist
                //if(in_array($seller_id,$special_seller_id)){
                $spl_cmsn = $result[0]->commision;
                $spl_percent_decimal = $spl_cmsn / 100;
                $spl_cmsn_amt = round($final_price * $spl_percent_decimal);
                echo '<span class="' . $sty_id . '">' . $spl_cmsn_amt . '</span><br/><br/>';
                echo '<span class="vspn">( ' . $spl_cmsn . '% of total sale value)</span>';
                //}
                //special commission condition program end here//
            } else {
                //Membership commission condition program start here//
                $query = $this->db->query("SELECT * FROM membership_seller WHERE seller_id='$seller_id'");
                $row = $query->num_rows();
                if ($row > 0) {
                    $result = $query->result();
                    $memb_id = $result[0]->memb_id;
                    $qr2 = $this->db->query("SELECT * FROM membership WHERE mbrshp_id='$memb_id'");
                    $rs2 = $qr2->result();
                    $MEMB_COLUMN = $rs2[0]->menbshp_column;
                    $qr3 = $this->db->query("SELECT cat_id,`$MEMB_COLUMN` FROM membership_commission WHERE cat_id='$second_leable_cat_id'");
                    $rw3 = $qr3->num_rows();
                    if ($rw3 > 0) {
                        $rs3 = $qr3->result();
                        $memb_cmsn = $rs3[0]->$MEMB_COLUMN;
                        $memb_percent_decimal = $memb_cmsn / 100;
                        $memb_cmsn_amt = round($final_price * $memb_percent_decimal);
                        echo '<span class="' . $sty_id . '">' . $memb_cmsn_amt . '</span><br/><br/>';
                        echo '<span class="vspn">( ' . $memb_cmsn . '% of total sale value)</span>';
                        //Membership commission condition program end here//
                    } else {
                        //Global commission condition program end here//
                        $query = $this->db->query("SELECT * FROM global_commission WHERE cat_id='$second_leable_cat_id'");
                        $rows = $query->num_rows();
                        if ($rows > 0) {
                            $rs4 = $query->result();
                            $gbl_cmsn = $rs4[0]->commission;
                            $gbl_percent_decimal = $gbl_cmsn / 100;
                            $gbl_cmsn_amt = round($final_price * $gbl_percent_decimal);
                            echo '<span class="' . $sty_id . '">' . $gbl_cmsn_amt . '</span><br/><br/>';
                            echo '<span class="vspn">( ' . $gbl_cmsn . '% of total sale value)</span>';
                            //Global commission condition program end here//
                        } else {
                            echo 'NOT';
                        }
                    }
                } else {
                    //Global commission condition program end here//
                    $query = $this->db->query("SELECT * FROM global_commission WHERE cat_id='$second_leable_cat_id'");
                    $rows = $query->num_rows();
                    if ($rows > 0) {
                        $rs4 = $query->result();
                        $gbl_cmsn = $rs4[0]->commission;
                        $gbl_percent_decimal = $gbl_cmsn / 100;
                        $gbl_cmsn_amt = round($final_price * $gbl_percent_decimal);
                        echo '<span class="' . $sty_id . '">' . $gbl_cmsn_amt . '</span><br/><br/>';
                        echo '<span class="vspn">( ' . $gbl_cmsn . '% of total sale value)</span>';
                        //Global commission condition program end here//
                    } else {
                        echo 'NOT';
                    }
                }
            }
        } else {
            //Membership commission condition program start here//
            $query = $this->db->query("SELECT * FROM membership_seller WHERE seller_id='$seller_id'");
            $row = $query->num_rows();
            if ($row > 0) {
                $result = $query->result();
                $memb_id = $result[0]->memb_id;
                $qr2 = $this->db->query("SELECT * FROM membership WHERE mbrshp_id='$memb_id'");
                $rs2 = $qr2->result();
                $MEMB_COLUMN = $rs2[0]->menbshp_column;
                $qr3 = $this->db->query("SELECT cat_id,`$MEMB_COLUMN` FROM membership_commission WHERE cat_id='$second_leable_cat_id'");
                $rw3 = $qr3->num_rows();
                if ($rw3 > 0) {
                    $rs3 = $qr3->result();
                    $memb_cmsn = $rs3[0]->$MEMB_COLUMN;
                    $memb_percent_decimal = $memb_cmsn / 100;
                    $memb_cmsn_amt = round($final_price * $memb_percent_decimal);
                    echo '<span class="' . $sty_id . '">' . $memb_cmsn_amt . '</span><br/><br/>';
                    echo '<span class="vspn">( ' . $memb_cmsn . '% of total sale value)</span>';
                    //Membership commission condition program end here//
                } else {
                    //Global commission condition program end here//
                    $query = $this->db->query("SELECT * FROM global_commission WHERE cat_id='$second_leable_cat_id'");
                    $rows = $query->num_rows();
                    if ($rows > 0) {
                        $rs4 = $query->result();
                        $gbl_cmsn = $rs4[0]->commission;
                        $gbl_percent_decimal = $gbl_cmsn / 100;
                        $gbl_cmsn_amt = round($final_price * $gbl_percent_decimal);
                        echo '<span class="' . $sty_id . '">' . $gbl_cmsn_amt . '</span><br/><br/>';
                        echo '<span class="vspn">( ' . $gbl_cmsn . '% of total sale value)</span>';
                        //Global commission condition program end here//
                    } else {
                        echo 'NOT';
                    }
                }
            } else {
                //Global commission condition program end here//
                $query = $this->db->query("SELECT * FROM global_commission WHERE cat_id='$second_leable_cat_id'");
                $rows = $query->num_rows();
                if ($rows > 0) {
                    $rs4 = $query->result();
                    $gbl_cmsn = $rs4[0]->commission;
                    $gbl_percent_decimal = $gbl_cmsn / 100;
                    $gbl_cmsn_amt = round($final_price * $gbl_percent_decimal);
                    echo '<span class="' . $sty_id . '">' . $gbl_cmsn_amt . '</span><br/><br/>';
                    echo '<span class="vspn">( ' . $gbl_cmsn . '% of total sale value)</span>';
                    //Global commission condition program end here//
                } else {
                    echo 'NOT';
                }
            }
        }
    }

    function getServiceTax() {
        $query = $this->db->query("SELECT * FROM tax_management WHERE tri_name='Service Tax'");
        $result = $query->result();
        $service_tax = $result[0]->tax_rate_percentage;
        return $service_tax;
    }

    function insert_product_tmp_img($img_name) {
        $sesson_seller_id = $this->session->userdata('seller_session_id');
        $seller_id = $this->session->userdata('seller-session');
        $img_strng = implode(',', $img_name);
        $data = array(
            'session_id' => $sesson_seller_id,
            'seller_id' => $seller_id,
            'imag' => $img_strng
        );
        $this->db->insert('temp_product_img', $data);
    }

    function delete_product_tmp_img($fileName) {
        $sesson_seller_id = $this->session->userdata('seller_session_id');
        $seller_id = $this->session->userdata('seller-session');
        $this->db->where('imag', $fileName);
        $this->db->where('seller_id', $seller_id);
        $this->db->where('session_id', $sesson_seller_id);
        $this->db->delete('temp_product_img');
    }

}

?>