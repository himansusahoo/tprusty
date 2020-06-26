<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mycart_model extends CI_Model {

    function show_mycart() {
        if ($this->session->userdata['session_data']['user_id'] != "") {
            $user_id = $this->session->userdata['session_data']['user_id'];
            $query = $this->db->query("select * from addtocart_temp where user_id='$user_id' group by sku ");
            return $query;
        } else {
            $this->session->set_userdata('addtocarttemp_session_id');
            $product_id_arr = array();
            $product_id_arr = $this->session->set_userdata('addtocarttemp');
            $this->session->set_userdata('addtocart_sku');
            return $product_id_arr;
        }
    }

    function get_unique_id($table, $uid) {

        $query = $this->db->query('SELECT MAX(' . $uid . ') AS `maxid` FROM ' . $table);
        $maxId = $query->row()->maxid;
        $id = $maxId + 1;
        return $id;
    }

    function insert_mycart($product_id, $sku_id) {
        array_push($this->session->userdata['addtocarttemp'], $product_id);
        array_push($this->session->userdata['addtocart_sku'], $sku_id);
        $addtocarttemp_id = $this->get_unique_id('addtocart_temp', 'addtocart_id');
        $addtocart_session_id = $this->session->userdata('addtocarttemp_session_id');
        $dtd = date('Y-m-d H:i:s');
        $data = array(
            'addtocart_id' => $addtocarttemp_id,
            'addtocart_session_id' => $addtocart_session_id,
            'product_id' => $product_id,
            'user_id' => $this->session->userdata['session_data']['user_id'],
            'sku' => $sku_id,
            'added_time' => $dtd
        );

        $qr = $this->db->insert('addtocart_temp', $data);
    }

    function insert_addtocart_temp_withlogin() {
        $quantity = $this->input->post('quantity_added');
        $product_id = $this->input->post('product_id');
        $sku = $this->input->post('sku_id');
        $session_id = $this->input->post('session_id');
        $user_id = $this->input->post('user_id');
        $rec_ct = $this->input->post('rec_count');
        $addtocart_id = $this->input->post('addtocart_id');
        $master_quantity = $this->input->post('quantity');
        $sl = $this->input->post('sl');
       
        for ($i = $rec_ct; $i < $quantity; $i++) {
            array_push($this->session->userdata['addtocarttemp'], $product_id);
            array_push($this->session->userdata['addtocart_sku'], $sku);
            $addtocarttemp_id = $this->get_unique_id('addtocart_temp', 'addtocart_id');
            $addtocart_session_id = $this->session->userdata('addtocarttemp_session_id');
            $dtd = date('Y-m-d H:i:s');
            $data = array(
                'addtocart_id' => $addtocarttemp_id,
                'addtocart_session_id' => $addtocart_session_id,
                'product_id' => $product_id,
                'user_id' => $this->session->userdata['session_data']['user_id'],
                'sku' => $sku,
                'added_time' => $dtd
            );
            $qr = $this->db->insert('addtocart_temp', $data);
        }
    }

    function delete_addtocart_temp_withlogin() {
        $quantity = $this->input->post('quantity_added');
        $product_id = $this->input->post('product_id');
        $sku = $this->input->post('sku_id');
        $session_id = $this->input->post('session_id');
        $user_id = $this->input->post('user_id');
        $rec_ct = $this->input->post('rec_count');
        $addtocart_id1 = $this->input->post('addtocart_id');
        $master_quantity = $this->input->post('quantity');
        $sl = $this->input->post('sl');
        $slr = 0;

        for ($i = $rec_ct; $i > $quantity; $i--) {
            $query = $this->db->query("select addtocart_id from addtocart_temp where user_id='$user_id' and sku='$sku' ");
            $qr = $query->result();
            foreach ($qr as $row) {

                $addtocart_id = $row->addtocart_id;
            }

            $qr = $this->db->query("delete from addtocart_temp where sku='$sku' and user_id='$user_id' and addtocart_id='$addtocart_id'");
        }
        return $qr;
    }

    function delete_from_mycart($addtocart_id) {
        $qr = $this->db->query("delete from addtocart_temp where addtocart_id='$addtocart_id' ");
    }

    function delete_from_mycart_final($addtocart_id) {
        $query = $this->db->query("delete from addtocart_temp where addtocart_id='$addtocart_id'");
        if ($this->db->affected_rows()) {
            return true;
        }
    }

    function delete_from_tempmycart($sku_id) {
        $sku_arr = $this->session->userdata['addtocart_sku'];
        foreach ($sku_arr as $key => $value) {
            if ($value == $sku_id) {
                unset($sku_arr[$key]);
            }
        }
        $this->session->unset_userdata['addtocart_sku'];
        $this->session->set_userdata('addtocart_sku', $sku_arr);
        if (count($sku_arr) == 0) {
            $this->session->unset_userdata['addtocart_sku'];
            $this->session->unset_userdata['addtocarttemp_session_id'];
            $this->session->unset_userdata['addtocarttemp'];
        }
    }

    function customer_detail_for_checkout() {
        $user_id = $this->session->userdata['session_data']['user_id'];
        $query = $this->db->query("select a.mob, a.email,a.mob,a.address_id,b.*,c.state AS state_name,b.state as cod_stateid from user a inner join user_address b on a.user_id=b.user_id INNER JOIN state c ON b.state=c.state_id where a.user_id=$user_id and a.address_id=b.address_id  ");

        $rows = $query->row();
        return $rows;
    }

    function retrive_shipping_amount_seller_wise() {
        $user_id = $this->session->userdata['session_data']['user_id'];
        //program start for getting user state id//
        $user_state_query = $this->db->query("SELECT b.state FROM user_address b INNER JOIN user a ON a.address_id=b.address_id WHERE a.user_id='$user_id'");
        $user_state_result = $user_state_query->result();
        $user_sate_id = $user_state_result[0]->state;
        //program start for getting user state id//
        //program start for getting shipment data seller wise///
        $shipment_query = $this->db->query("SELECT * FROM shipment WHERE state_id='$user_sate_id'");
        $shipment_result = $shipment_query->result();
        foreach ($shipment_result as $row) {
            $shipment_seller_id[] = $row->seller_id;
            $shipment_amount[] = $row->amount;
        }
        $shipment_seller_id_amount = array_combine($shipment_seller_id, $shipment_amount);
        //return $shipment_seller_id_amount;
        //program end for getting shipment data seller wise///
        //program start for getting shipment seller_id where user state id not in same row//
        $query = $this->db->query("SELECT seller_id FROM shipment");
        $result = $query->result();
        foreach ($result as $seller_id_row) {
            $all_shipment_seller_id[] = $seller_id_row->seller_id;
        }
        $all_shipment_seller_id = array_unique($all_shipment_seller_id);
        $other_shipment_seller_id = array_diff($all_shipment_seller_id, $shipment_seller_id);
        $other_shipment_seller_id_length = count($other_shipment_seller_id);
        for ($i = 0; $i < $other_shipment_seller_id_length; $i++) {
            @$query1 = $this->db->query("SELECT * FROM shipment WHERE seller_id='$other_shipment_seller_id[$i]' AND state_id=0");
            $result1 = $query1->result();
            $other_shipment_amount[] = $result1[0]->amount;
        }
        $other_shipment_seller_id_amount = array_combine($other_shipment_seller_id, $other_shipment_amount);
        $total_shipment_seller_id_amount = ($shipment_seller_id_amount + $other_shipment_seller_id_amount);
        return $total_shipment_seller_id_amount;
    }

    function retrive_national_shipping_amount_seller_wise() {
        $query = $this->db->query("SELECT * FROM shipment WHERE state_id=0");
        $result = $query->result();
        foreach ($result as $row) {
            $shipment_seller_id[] = $row->seller_id;
            $shipment_amount[] = $row->amount;
        }
        $shipment_seller_id_n_amount = array_combine($shipment_seller_id, $shipment_amount);
        return $shipment_seller_id_n_amount;
    }

    function inserted_into_checkout_temp() {

        $cdate = date('Y-m-d H:i:s');
        $chkout_session_id = $this->session->userdata('chkoutemp_session_id');
        $user_id = $this->session->userdata['session_data']['user_id'];
        $sku_arr = json_decode($_POST['sku']);
        $qty_arr = json_decode($_POST['qty']);
        foreach ($sku_arr as $val) {
            $query = $this->db->query("SELECT product_id FROM product_master WHERE sku='$val'");
            $result = $query->result();
            foreach ($result as $row) {
                $product_id[] = $row->product_id;
            }
        }
        $length = count($product_id);
        for ($i = 0; $i < $length; $i++) {
            //update program start for checkout_temp table
            $sql = $this->db->query("SELECT id FROM checkout_temp WHERE checkout_session_id='$chkout_session_id' AND sku='$sku_arr[$i]'");
            if ($sql->num_rows() > 0) {
                $update_sql = $this->db->query("UPDATE checkout_temp SET quantity='$qty_arr[$i]' WHERE checkout_session_id='$chkout_session_id' AND sku='$sku_arr[$i]'");
            }
            //update program end of checkout_temp table
            else {
                //insert program start for checkout_temp table
                $data = array(
                    'checkout_session_id' => $chkout_session_id,
                    'user_id' => $user_id,
                    'product_id' => $product_id[$i],
                    'sku' => $sku_arr[$i],
                    'quantity' => $qty_arr[$i],
                    'cdate' => $cdate,
                );
                $this->db->insert('checkout_temp', $data);
                //insert program end of checkout_temp table
            }
        }

        //update purchase gift voucher status form temporary block to available, If page refreshed when payment process going on
        $sql1 = $this->db->query("SELECT adj_type_id FROM pay_adjust_data_temp WHERE chkout_session_id='$chkout_session_id' AND adj_type='V'");
        if ($sql1->num_rows() > 0) {
            foreach ($sql1->result() as $vchr_no_row) {
                $voucher_no_arr[] = $vchr_no_row->adj_type_id;
            }
            $this->load->model('My_wallet_model');
            $this->My_wallet_model->update_purchase_gift_voucher_status($voucher_no_arr, 'A');
        }

        //update purchase coupon status form temporary block to available, If page refreshed when payment process going on
        $sql2 = $this->db->query("SELECT adj_type_id FROM pay_adjust_data_temp WHERE chkout_session_id='$chkout_session_id' AND adj_type='C'");
        if ($sql2->num_rows() > 0) {
            foreach ($sql2->result() as $copn_code_row) {
                $copn_code_arr[] = $copn_code_row->adj_type_id;
            }
            $this->load->model('My_wallet_model');
            $this->My_wallet_model->update_purchase_copn_status($copn_code_arr, 'A');
        }

        //program start for remove pay_adjust_data_temp table data, if this session id data is already exists
        $this->db->where('chkout_session_id', $chkout_session_id);
        $this->db->delete('pay_adjust_data_temp');
        //program end of remove pay_adjust_data_temp table data, if this session id data is already exists
        return true;
    }

    function getting_rest_payble_amount() {
        $chkout_session_id = $this->session->userdata('chkoutemp_session_id');
        $total_payble_amt = $this->session->userdata('sesstotal_price');
        $query = $this->db->query("SELECT SUM(adj_amount) AS TOTAL_ADJ_AMT FROM pay_adjust_data_temp WHERE chkout_session_id='$chkout_session_id'");
        if ($query->num_rows() > 0) {
            $result = $query->result();
            $adjust_amt = $result[0]->TOTAL_ADJ_AMT;
            $rest_payble_amt = $total_payble_amt - $adjust_amt;
            return $rest_payble_amt;
        } else {
            return $total_payble_amt;
        }
    }

    function insert_orderdata_beforecheckout($addtocart_ids, $order_id_arr, $tax_arr, $shipping_fees_arr, $sub_total_arr, $qantity_arr, $sku_arr, $total_price, $seller_id_arr, $address_id, $order_id_payment_gateway, $price_arr, $color_arr, $size_arr) {

        //transaction table insert function start//
        $this->insert_inn_transaction_details($order_id_arr, $qantity_arr, $sub_total_arr, $sku_arr, $seller_id_arr, $price_arr, $shipping_fees_arr);
        //transaction table insert function end//

        $i = 0;
        $user_id = $this->session->userdata['session_data']['user_id'];
        $sku_qntarr = array();
        foreach ($sku_arr as $keyskuqnt => $valskuqnt) {
            $skuqnt = "'" . $valskuqnt . "'";
            array_push($sku_qntarr, $skuqnt);
        }
        $sku_qntstr = implode(',', $sku_qntarr);
        $query1 = $this->db->query("select * from addtocart_temp where user_id='$user_id' AND sku IN ($sku_qntstr) group by sku ");
        $ct = $query1->num_rows();


        foreach ($query1->result() as $rw) {

            $addtocart_id = $this->get_unique_id('ordered_product_from_addtocart', 'addtocart_id');

            $data = array(
                'addtocart_id' => $addtocart_id,
                'addtocart_session_id' => $rw->addtocart_session_id,
                'product_id' => $rw->product_id,
                'user_id' => $rw->user_id,
                'sku' => $sku_arr[$i],
                'order_id' => $order_id_arr[$i],
                'sub_tax_rate' => $tax_arr[$i],
                'sub_shipping_fees' => $shipping_fees_arr[$i],
                'sub_total_amount' => $sub_total_arr[$i],
                'seller_id' => $seller_id_arr[$i],
                'quantity' => $qantity_arr[$i],
                'prdt_color' => $color_arr[$i],
                'prdt_size' => $size_arr[$i]
            );

            $qr1 = $this->db->insert('ordered_product_from_addtocart', $data);


            $check_order_id_query = $this->db->query("select * from order_info where order_id='$order_id_arr[$i]'   ");
            $ct_row = $check_order_id_query->num_rows();

            if ($ct_row == 0) {
                $order_track_id = $this->get_unique_id('order_info', 'order_track_id');
                date_default_timezone_set('Asia/Kolkata');
                $dt = date('Y-m-d H:i:s');

                $data_order = array(
                    'order_track_id' => $order_track_id,
                    'order_id' => $order_id_arr[$i],                    
                    'Total_amount' => $sub_total_arr[$i],
                    'date_of_order' => $dt,                    
                    'order_processstatus' => 'Order has initiated(Pending Of Payment) ',
                    'order_status' => 'Pending payment'
                );

                $qr1 = $this->db->insert('order_info', $data_order);
            } else {
                $row_order_info = $check_order_id_query->row();
                $tot_amt = $row_order_info->Total_amount + $sub_total_arr[$i];

                $upd_query = $this->db->query("update order_info set Total_amount='$tot_amt' where order_id='$order_id_arr[$i]' ");
            }

            //INSERT OF ADDRESS DATA START

            $check_shippingaddress_query = $this->db->query("select * from shipping_address where order_id='$order_id_arr[$i]'   ");
            $ct_row1 = $check_shippingaddress_query->num_rows();

            if ($ct_row1 == 0) {
                $address_data_query = $this->db->query("select * from user_address where address_id='$address_id'");
                $address_row = $address_data_query->row();

                $address_data = array(
                    'order_id' => $order_id_arr[$i],
                    'user_id' => $address_row->user_id,
                    'full_name' => $address_row->full_name,
                    'address' => $address_row->address,
                    'city' => $address_row->city,
                    'state' => $address_row->state,
                    'country' => $address_row->country,
                    'pin_code' => $address_row->pin_code,
                    'phone' => $address_row->phone
                );

                $address_insert_qr = $this->db->insert('shipping_address', $address_data);
            }


            $i++;
        }
    }

    function insert_inn_transaction_details($order_id_arr, $qantity_arr, $sub_total_arr, $sku_arr, $seller_id_arr, $price_arr, $shipping_fees_arr) {

        $cdate = date('Y-m-d');
        //program start for getting product sale value//
        $arr_length = count($qantity_arr);
        
        //program start for getting fixedCharges //
        $this->load->model('seller/Catalog_model');
        $fixed_charges_res = $this->Catalog_model->getFixedCharges();
        if ($fixed_charges_res != 'NOT') {
            $fix_chg_amount = $fixed_charges_res[0]->amount;
            $fix_chg_percent = $fixed_charges_res[0]->percent;
            if ($fix_chg_amount == '') {
                $percent_decimal = $fix_chg_percent / 100;
                for ($j = 0; $j < $arr_length; $j++) {
                    $fixed_fee[] = round($sub_total_arr[$j] * $percent_decimal);
                }
            } else {
                for ($j = 0; $j < $arr_length; $j++) {
                    $fixed_fee[] = $fix_chg_amount;
                }
            }
            $fixed_fee_arr = $fixed_fee;
        } else {
            for ($j = 0; $j < $arr_length; $j++) {
                $fixed_fee[] = 0;
            }
            $fixed_fee_arr = $fixed_fee;
        }
        //program end of getting fixed Charges //
        //program start for getting Seasonal Charges //
        $seasonal_charge_res = $this->Catalog_model->getSeasonalCharges();
        if ($seasonal_charge_res != 'NOT') {
            $seasonal_chg_amount = $seasonal_charge_res[0]->amount;
            $seasonal_chg_percent = $seasonal_charge_res[0]->percent;
            if ($seasonal_chg_amount == '') {
                $seasonal_percent_decimal = $seasonal_chg_percent / 100;
                for ($j = 0; $j < $arr_length; $j++) {
                    $seasonal_fee[] = round($sub_total_arr[$j] * $seasonal_percent_decimal);
                }
            } else {
                for ($j = 0; $j < $arr_length; $j++) {
                    $seasonal_fee[] = $seasonal_chg_amount;
                }
            }
            $seasonal_fee_arr = $seasonal_fee;
        } else {
            for ($j = 0; $j < $arr_length; $j++) {
                $seasonal_fee[] = 0;
            }
            $seasonal_fee_arr = $seasonal_fee;
        }
        //program end of getting Seasonal Charges //
        //program start for getting PG Charges //
        $pg_charge_res = $this->Catalog_model->getPgCharges();
        $pg_percent = $pg_charge_res[0]->percent;
        $pg_percent_decimal = $pg_percent / 100;
        for ($j = 0; $j < $arr_length; $j++) {
            $pg_fee[] = round($sub_total_arr[$j] * $pg_percent_decimal);
        }
        $pg_fee_arr = $pg_fee;
        //program end of getting PG Charges //

        $service_tax = $this->Catalog_model->getServiceTax();
        $tax_decimal = $service_tax / 100;

        //getting second label category id start here//
        foreach ($sku_arr as $sku) {
            //third label category id query
            $query1 = $this->db->query("SELECT a.category_id FROM product_category a INNER JOIN product_master b ON a.product_id=b.product_id WHERE b.sku='$sku'");
            $result1 = $query1->result();
            //$second_leable_cat_id is the third label category id
            $second_leable_cat_id[] = $result1[0]->category_id;
        }
        $second_leable_cat_id_arr = $second_leable_cat_id;
        //getting second label category id start here//

        $commission_arr = $this->commission_calculation($second_leable_cat_id_arr, $sub_total_arr, $seller_id_arr);       

        for ($k = 0; $k < $arr_length; $k++) {
            $total_fees = $fixed_fee_arr[$k] + $seasonal_fee_arr[$k] + $pg_fee_arr[$k] + $commission_arr[$k];
            $servc_tx[] = round($total_fees * $tax_decimal);
        }

        for ($z = 0; $z < $arr_length; $z++) {
            $data = array(
                'seller_id' => $seller_id_arr[$z],
                'order_no' => $order_id_arr[$z],
                'sale_value' => $sub_total_arr[$z],
                'fixed_chgs' => $fixed_fee_arr[$z],
                'season_chgs' => $seasonal_fee_arr[$z],
                'pg_chgs' => $pg_fee_arr[$z],
                'commission' => $commission_arr[$z],
                'service_tax' => $servc_tx[$z],
                'sku' => $sku_arr[$z],
                'cdate' => $cdate
            );
            $this->db->insert('transaction', $data);
        }
    }

    function commission_calculation($second_leable_cat_id_arr, $sub_total_arr, $seller_id_arr) {

        $cdate = date('Y-m-d');
        //program start for commission calculating //
        $arr_length = count($seller_id_arr);
        $commission_arr = array();
        for ($x = 0; $x < $arr_length; $x++) {
            $query = $this->db->query("SELECT * FROM special_commission WHERE from_date<='$cdate' AND to_date>='$cdate' AND cat_id='$second_leable_cat_id_arr[$x]'");
            $rows = $query->num_rows();
            if ($rows > 0) {
                $result = $query->result();
                $special_seller_id = unserialize($result[0]->seller_id);
                if ($result[0]->seller_id == Null) { //if no seller id in this date range, applicable to all seller
                    $spl_cmsn = $result[0]->commision;
                    $spl_percent_decimal = $spl_cmsn / 100;
                    $spl_cmsn_amt = round($sub_total_arr[$x] * $spl_percent_decimal);
                    array_push($commission_arr, $spl_cmsn_amt);
                } else if (in_array($seller_id_arr[$x], $special_seller_id)) { //program for if exist	
                    $spl_cmsn = $result[0]->commision;
                    $spl_percent_decimal = $spl_cmsn / 100;
                    $spl_cmsn_amt = round($sub_total_arr[$x] * $spl_percent_decimal);
                    array_push($commission_arr, $spl_cmsn_amt);
                } else {
                    //Membership commission condition program start here//
                    $query = $this->db->query("SELECT * FROM membership_seller WHERE seller_id='$seller_id_arr[$x]'");
                    $row = $query->num_rows();
                    if ($row > 0) {
                        $result = $query->result();
                        $memb_id = $result[0]->memb_id;
                        $qr2 = $this->db->query("SELECT * FROM membership WHERE mbrshp_id='$memb_id'");
                        $rs2 = $qr2->result();
                        $MEMB_COLUMN = $rs2[0]->menbshp_column;
                        $qr3 = $this->db->query("SELECT cat_id,`$MEMB_COLUMN` FROM membership_commission WHERE cat_id='$second_leable_cat_id_arr[$x]'");
                        $rw3 = $qr3->num_rows();
                        if ($rw3 > 0) {
                            $rs3 = $qr3->result();
                            $memb_cmsn = $rs3[0]->$MEMB_COLUMN;
                            $memb_percent_decimal = $memb_cmsn / 100;
                            $memb_cmsn_amt = round($sub_total_arr[$x] * $memb_percent_decimal);
                            array_push($commission_arr, $memb_cmsn_amt);
                            //Membership commission condition program end here//
                        } else {
                            //Global commission condition program start here//
                            $query = $this->db->query("SELECT * FROM global_commission WHERE cat_id='$second_leable_cat_id_arr[$x]'");
                            $rows = $query->num_rows();
                            if ($rows > 0) {
                                $rs4 = $query->result();
                                $gbl_cmsn = $rs4[0]->commission;
                                $gbl_percent_decimal = $gbl_cmsn / 100;
                                $gbl_cmsn_amt = round($sub_total_arr[$x] * $gbl_percent_decimal);
                                array_push($commission_arr, $gbl_cmsn_amt);
                                //Global commission condition program end here//
                            } else {
                                $commission_arr = array();
                            }
                        }
                    } else {
                        //Global commission condition program start here//
                        $query = $this->db->query("SELECT * FROM global_commission WHERE cat_id='$second_leable_cat_id_arr[$x]'");
                        $rows = $query->num_rows();
                        if ($rows > 0) {
                            $rs4 = $query->result();
                            $gbl_cmsn = $rs4[0]->commission;
                            $gbl_percent_decimal = $gbl_cmsn / 100;
                            $gbl_cmsn_amt = round($sub_total_arr[$x] * $gbl_percent_decimal);
                            array_push($commission_arr, $gbl_cmsn_amt);
                            //Global commission condition program end here//
                        } else {
                            $commission_arr = array();
                        }
                    }
                }
            } else {
                //Membership commission condition program start here//
                $query = $this->db->query("SELECT * FROM membership_seller WHERE seller_id='$seller_id_arr[$x]'");
                $row = $query->num_rows();
                if ($row > 0) {
                    $result = $query->result();
                    $memb_id = $result[0]->memb_id;
                    $qr2 = $this->db->query("SELECT * FROM membership WHERE mbrshp_id='$memb_id'");
                    $rs2 = $qr2->result();
                    $MEMB_COLUMN = $rs2[0]->menbshp_column;
                    $qr3 = $this->db->query("SELECT cat_id,`$MEMB_COLUMN` FROM membership_commission WHERE cat_id='$second_leable_cat_id_arr[$x]'");
                    $rw3 = $qr3->num_rows();
                    if ($rw3 > 0) {
                        $rs3 = $qr3->result();
                        $memb_cmsn = $rs3[0]->$MEMB_COLUMN;
                        $memb_percent_decimal = $memb_cmsn / 100;
                        $memb_cmsn_amt = round($sub_total_arr[$x] * $memb_percent_decimal);
                        array_push($commission_arr, $memb_cmsn_amt);
                        //Membership commission condition program end here//
                    } else {
                        //Global commission condition program start here//
                        $query = $this->db->query("SELECT * FROM global_commission WHERE cat_id='$second_leable_cat_id_arr[$x]'");
                        $rows = $query->num_rows();
                        if ($rows > 0) {
                            $rs4 = $query->result();
                            $gbl_cmsn = $rs4[0]->commission;
                            $gbl_percent_decimal = $gbl_cmsn / 100;
                            $gbl_cmsn_amt = round($sub_total_arr[$x] * $gbl_percent_decimal);
                            array_push($commission_arr, $gbl_cmsn_amt);
                            //Global commission condition program end here//
                        } else {
                            $commission_arr = array();
                        }
                    }
                } else {
                    //Global commission condition program start here//
                    $query = $this->db->query("SELECT * FROM global_commission WHERE cat_id='$second_leable_cat_id_arr[$x]'");
                    $rows = $query->num_rows();
                    if ($rows > 0) {
                        $rs4 = $query->result();
                        $gbl_cmsn = $rs4[0]->commission;
                        $gbl_percent_decimal = $gbl_cmsn / 100;
                        $gbl_cmsn_amt = round($sub_total_arr[$x] * $gbl_percent_decimal);
                        array_push($commission_arr, $gbl_cmsn_amt);
                        //Global commission condition program end here//
                    } else {
                        //echo 'NOT';
                        $commission_arr = array();
                    }
                }
            }
        }
        return $commission_arr;
    }

    function update_ccavenuedata($order_id_payment_gateway, $order_id_arr) {
        foreach ($order_id_arr as $ord_key => $ord_value) {
            $this->db->query("UPDATE order_info SET order_id_payment_gateway='$order_id_payment_gateway', payment_mode='2' WHERE order_id='$ord_value' ");
        }
    }

    function update_tempcartproductqnt() {
        $prod_sku = $this->input->post('prod_sku');
        $prod_qnt = $this->input->post('prod_qnt');

        $sku_arr = $this->session->userdata['addtocart_sku'];
        //print_r($sku_arr); echo count($sku_arr);exit;
        foreach ($sku_arr as $key => $value) {
            if ($value == $prod_sku) {
                unset($sku_arr[$key]);
            }
        }

        $this->session->unset_userdata['addtocart_sku'];
        $this->session->set_userdata('addtocart_sku', $sku_arr);

        for ($i = 0; $i < $prod_qnt; $i++) {
            array_push($this->session->userdata['addtocart_sku'], $prod_sku);
        }
    }

    function select_tempcartskuids() {
        $prod_arr = @$this->session->userdata['addtocart_sku'];

        if (count($prod_arr) != 0) {
            $productsku_array = array();
            foreach ($prod_arr as $key => $res_product) {
                $sku = "'" . $res_product . "'";
                array_push($productsku_array, $sku);
            }
            $productsku_str = implode(',', $productsku_array);

            $query_prodcart = $this->db->query("select sku FROM product_master where sku IN ($productsku_str) group by sku ");
            return $query_prodcart->result();
        }
    }

    function check_codavilstatus($pincode) {
        $pincode_query = $this->db->query("SELECT cod_serviceable_domestic FROM postalpincodemaster_fedexin WHERE postalcode='$pincode' ");

        if ($pincode_query->num_rows() > 0) {
            if ($pincode_query->row()->cod_serviceable_domestic == 'COD') {
                return $cod_status = "COD";
            } else {
                return $cod_status = "No COD";
            }
        } else {
            return $cod_status = "No COD";
        }
    }

    function prodcod_charges() {
        $total_price = $this->input->post('curprice');
        $cod_totalprice = $total_price;
        $cod_chargeaswtgh = 0;
        $cod_chargetobuyer = 0;
        $codtaxamount = 0;
        $cod_chargeaswtgheach = 0;

        $total_weightcharge = 0; // varaible for session
        $total_taxchrgetobuyer = 0; // varaible for session
        $total_chargetocustomer = 0; // varaible for session
        $total_chargetomoonboy = 0; // varaible for session
        $totatl_discounttobuyer = 0; // varaible for session
        $pincode = $this->input->post('pincode');

        $prod_id = $this->input->post('prodid');
        $wt_qr = $this->db->query("SELECT * FROM product_general_info WHERE product_id='$prod_id' GROUP BY  product_id");

        $prod_weighteach = $wt_qr->row()->weight;

        $wtchrg_query = $this->db->query("SELECT * FROM cod_chargeasper_weight WHERE (wt_from <= '$prod_weighteach') AND (wt_to >= '$prod_weighteach') ");


        $wtchrg_row = $wtchrg_query->row();
        $cod_chargeaswtgheach = $wtchrg_row->wt_charge;

        //-------------------amount to be charge start--------------------------

        $cod_percen_query = $this->db->query("SELECT * FROM cod_tobecharged WHERE charge_to='Buyer' ");
        if ($cod_percen_query->num_rows() > 0) {
            $cod_percen_row = $cod_percen_query->row();
            $cod_percen_charge = $cod_percen_row->Percentage_charge;

            $cod_chargetobuyer = $cod_chargetobuyer + round(($cod_chargeaswtgheach / 100) * $cod_percen_charge);

            $total_weightcharge = $cod_chargetobuyer; // total weight for session
            $total_chargetocustomer = $cod_chargetobuyer; // total charge to buyer for session

            if ($cod_percen_charge != '100') {
                $total_chargetomoonboy = $total_chargetomoonboy + round(($cod_chargeaswtgheach / 100) * (100 - $cod_percen_charge));
            }
        } else {
            $cod_totalprice = $cod_totalprice + $cod_chargeaswtgheach;
        }

        // if condition of tobe charge end
        //--------------------------tax charge to buyer start--------------------
        $query = "
            SELECT a.state_id 
            FROM state a 
            INNER JOIN postalpincodemaster_fedexin b ON a.state_code=b.State 
            WHERE b.postalcode='$pincode'";
        $result = $this->db->query($query)->row();
        $codcharge_stateid = '';
        if (isset($result->state_id)) {
            $codcharge_stateid = $result->state_id;
        }

        if ($codcharge_stateid != "") {

            $codtax_query = $this->db->query("SELECT * FROM cod_taxratecharges WHERE state_id='$codcharge_stateid' ");
            if ($codtax_query->num_rows() > 0) {
                $row_codtax = $codtax_query->row();
                $cod_taxpercentage = $row_codtax->taxrate;

                $codtaxamount = $codtaxamount + ($total_price / 100) * $cod_taxpercentage;

                $total_taxchrgetobuyer = $codtaxamount; // tax for session variable

                $cod_chargetobuyer = $cod_chargetobuyer + $codtaxamount;
            } else {
                $cod_totalprice = $cod_totalprice + $cod_chargetobuyer;
            }
            // if condition of tax ends	
        } // cus_data condition end
        //--------------------------tax charge to buyer end----------------------

        return round($cod_chargetobuyer);
    }

}

?>