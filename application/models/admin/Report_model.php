<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

    function retrieve_order_report() {
        $query = $this->db->query("SELECT a.order_id,a.Total_amount,a.date_of_order,a.order_status,c.business_name,d.email FROM order_info a INNER JOIN ordered_product_from_addtocart b ON a.order_id=b.order_id 
		INNER JOIN seller_account_information c ON b.seller_id=c.seller_id 
		INNER JOIN user d ON b.user_id=d.user_id GROUP BY b.order_id ORDER BY a.id DESC");
        return $query;
    }

    function retrieve_filter_order_report() {
        $status = $this->input->post('order_status2');
        $seller_name = $this->input->post('fltr_seller');
        $condition = '';

        if ($status != '') {
            $condition .= " a.order_status='$status'";
        }
        if ($seller_name != '') {
            $condition .= " c.business_name='$seller_name'";
        }

        if ($condition == '') {
            $query = $this->db->query("SELECT a.order_id,a.Total_amount,a.date_of_order,a.order_status,c.business_name,d.email FROM order_info a INNER JOIN ordered_product_from_addtocart b ON a.order_id=b.order_id 
			INNER JOIN seller_account_information c ON b.seller_id=c.seller_id 
			INNER JOIN user d ON b.user_id=d.user_id GROUP BY b.order_id ORDER BY a.id DESC");
            return $query;
        } else {
            $query = $this->db->query("SELECT a.order_id,a.Total_amount,a.date_of_order,a.order_status,c.business_name,d.email FROM order_info a INNER JOIN ordered_product_from_addtocart b ON a.order_id=b.order_id 
			INNER JOIN seller_account_information c ON b.seller_id=c.seller_id 
			INNER JOIN user d ON b.user_id=d.user_id WHERE " . $condition . " GROUP BY b.order_id ORDER BY a.id DESC");
            return $query;
        }
    }

    function retrieve_return_order_report() {
        $query = $this->db->query("SELECT a.return_id,a.order_id,a.total_amount,a.reason,a.status,a.cdate,b.business_name,d.email FROM return_product a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
		INNER JOIN user d ON c.user_id=d.user_id GROUP BY c.order_id ORDER BY a.id DESC");
        return $query;
    }

    function filter_return_order_report() {
        $status = $this->input->post('order_status2');
        $seller_name = $this->input->post('fltr_seller');
        $condition = '';

        if ($status != '') {
            $condition .= " a.status='$status'";
        }
        if ($seller_name != '') {
            $condition .= " b.business_name='$seller_name'";
        }

        if ($condition == '') {
            $query = $this->db->query("SELECT a.return_id,a.order_id,a.total_amount,a.reason,a.status,a.cdate,b.business_name,d.email FROM return_product a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
			INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
			INNER JOIN user d ON c.user_id=d.user_id GROUP BY c.order_id ORDER BY a.id DESC");
            return $query;
        } else {
            $query = $this->db->query("SELECT a.return_id,a.order_id,a.total_amount,a.reason,a.status,a.cdate,b.business_name,d.email FROM return_product a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
			INNER JOIN ordered_product_from_addtocart c ON a.order_id=c.order_id 
			INNER JOIN user d ON c.user_id=d.user_id WHERE " . $condition . " GROUP BY c.order_id ORDER BY a.id DESC");
            return $query;
        }
    }

    function retrievePayoutData() {

        /* $query = "
          SELECT t.*,sai.business_name,oi.order_status,oi.cancelled_by,oi.order_status_modified_date FROM transaction t
          LEFT JOIN seller_account_information sai ON sai.seller_id = t.seller_id
          LEFT JOIN(
          SELECT * FROM order_info WHERE lower(order_status) in('delivered','return requested','undelivered')
          UNION ALL
          SELECT * FROM order_info WHERE lower(order_status)='cancelled' AND lower(cancelled_by) in('admin','seller')
          )oi ON oi.order_id=t.order_no
          WHERE t.payout_gen_status='no'
          AND oi.order_status_modified_date <= CURDATE() - INTERVAL 3 DAY
          ORDER BY t.id DESC"; */

        $query = "
                SELECT a.*,pi.payment_type,sa.full_name FROM(
                    SELECT t.*,sai.business_name,oi.date_of_order,oi.order_status,oi.cancelled_by,oi.order_status_modified_date,oi.payment_mode                    
                    FROM transaction t
                    LEFT JOIN seller_account_information sai ON sai.seller_id = t.seller_id
                    LEFT JOIN(
                        SELECT * FROM order_info WHERE lower(order_status) in('delivered','return requested')
                    )oi ON oi.order_id=t.order_no
                    WHERE t.payout_gen_status='no'
                    AND oi.order_status_modified_date <= CURDATE() - INTERVAL 3 DAY                      
                UNION ALL
                    SELECT t.*,sai.business_name,oi.date_of_order,oi.order_status,oi.cancelled_by,oi.order_status_modified_date,oi.payment_mode
                        FROM transaction t
                        LEFT JOIN seller_account_information sai ON sai.seller_id = t.seller_id
                        LEFT JOIN(
                            SELECT * FROM order_info WHERE lower(order_status) in('undelivered')
                            UNION ALL
                            SELECT * FROM order_info WHERE lower(order_status)='cancelled' AND lower(cancelled_by) in('admin','seller')
                        )oi ON oi.order_id=t.order_no
                        WHERE t.payout_gen_status='no'
                        AND oi.order_status_modified_date <= CURDATE() - INTERVAL 1 DAY 
                )a 
                LEFT JOIN payment_info pi on pi.payment_mode_id=a.payment_mode
                LEFT JOIN shipping_address sa on sa.order_id=a.order_no
                ORDER BY a.id DESC";
        //pma($query,1);
        $result = $this->db->query($query)->result_array();

        return $result;
    }

    function update_inn_settelment_discount() {
        $discount = $this->input->post('discount');
        $id = $this->input->post('id');

        if ($id) {
            $this->db->trans_begin();
            $data = array(
                'discount' => $discount,
            );
            $this->db->where('id', $id);
            $this->db->update('transaction', $data);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        }
        return true; //just to be reloaded the page
    }

    function update_inn_transaction_data() {
        date_default_timezone_set('Asia/Calcutta');
        $cdate = date('Y-m-d');

        $id_arr = $this->input->post('hidden_id[]');
        $ids = implode(',', $id_arr);
        $slr_id_arr = $this->input->post('hidden_slr_id[]');
        $stl_amt = $this->input->post('stl_amt[]');
        $discount = $this->input->post('discount[]');
        $fnl_stl_amt = $this->input->post('fnl_stl_amt[]');
        $arr_len = count($id_arr);
        for ($i = 0; $i < $arr_len; $i++) {
            $data = array(
                'discount' => $discount[$i],
                'settl_amt' => $stl_amt[$i],
                'fnal_settl_amt' => $fnl_stl_amt[$i],
                'pyt_genrted_dt' => $cdate
            );
            $this->db->where('id', $id_arr[$i]);
            $this->db->update('transaction', $data);
        }

        //seller payout insert function//
        $pyout_insrt_result = $this->insert_seller_payout_details($id_arr);
        if ($pyout_insrt_result == true) {
            //update transaction table payout_gen_status 'yes' program start//
            $data1 = array('payout_gen_status' => 'yes');
            $this->db->where_in('id', $id_arr);
            $this->db->update('transaction', $data1);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        }
    }

    function insert_ledger_data() {
        $tanscdate_arr = array();
        $sellerid_arr = array();
        $orderid_arr = array();
        $slrdramt_arr = array();
        $slrcrdamt_arr = array();


        $rtn_tanscdate_arr = array();
        $rtn_sellerid_arr = array();
        $rtn_orderid_arr = array();
        $rtn_slrdramt_arr = array();
        $rtn_slrcrdamt_arr = array();


        $query = "SELECT a. * , b.business_name, c.order_status_modified_date,c.date_of_order
                FROM transaction a
                INNER JOIN seller_account_information b ON a.seller_id = b.seller_id
                INNER JOIN order_info c ON a.order_no = c.order_id
                WHERE c.order_status =  'Delivered' AND a.payout_gen_status='no'
                AND c.order_status_modified_date <= CURDATE( ) - INTERVAL 3 
                DAY 
                ORDER BY a.id DESC ";
        $row_transcdata = $this->db->query($query)->result();


        foreach ($row_transcdata as $res_data) {
            array_push($tanscdate_arr, $res_data->date_of_order);

            $total_deduct_amt = $res_data->fixed_chgs + $res_data->season_chgs + $res_data->pg_chgs + $res_data->commission + $res_data->service_tax + $res_data->penalty;

            array_push($slrdramt_arr, $total_deduct_amt);

            if ($res_data->discount != 0) {
                $discount_amt = $res_data->discount;
                //$final_deduct_amt = $total_deduct_amt-$discount_amt;
                $settlement_value = $res_data->sale_value - $total_deduct_amt;
                $final_settelment_amt = $settlement_value + $discount_amt;

                array_push($slrcrdamt_arr, $final_settelment_amt);
            } else {

                $settlement_value = $res_data->sale_value - $total_deduct_amt;

                array_push($slrcrdamt_arr, $settlement_value);
            }

            array_push($sellerid_arr, $res_data->seller_id);

            array_push($orderid_arr, $res_data->order_no);


            //return type ledger data strat

            $query_return = $this->db->query("select * from return_product where sku='$res_data->sku' AND order_id='$res_data->order_no' ");
            $row_return = $query_return->row();

            if (count($row_return) != 0) { //retrun data save in array start
                array_push($rtn_tanscdate_arr, $res_data->date_of_order);

                $rtn_total_deduct_amt = $res_data->fixed_chgs + $res_data->season_chgs + $res_data->pg_chgs + $res_data->commission + $res_data->service_tax + $res_data->penalty;

                array_push($rtn_slrdramt_arr, $rtn_total_deduct_amt);

                if ($res_data->discount != 0) {
                    $rtn_discount_amt = $res_data->discount;
                    //$final_deduct_amt = $total_deduct_amt-$discount_amt;
                    $rtn_settlement_value = $res_data->sale_value - $rtn_total_deduct_amt;
                    $rtn_final_settelment_amt = $rtn_settlement_value + $rtn_discount_amt;

                    array_push($rtn_slrcrdamt_arr, $rtn_final_settelment_amt);
                } else {

                    $rtn_settlement_value = $res_data->sale_value - $rtn_total_deduct_amt;

                    array_push($rtn_slrcrdamt_arr, $rtn_settlement_value);
                }

                array_push($rtn_sellerid_arr, $res_data->seller_id);

                array_push($rtn_orderid_arr, $row_return->return_id);
            } //retrun data save in array end
            //return type ledger data end
        } // foreach end

        $ct = count($orderid_arr);

        for ($k = 0; $k < $ct; $k++) {
            $data = array(
                'trans_date' => $tanscdate_arr[$k],
                'seller_id' => $sellerid_arr[$k],
                'refer_id' => $orderid_arr[$k],
                'trans_type' => 'Sales',
                'slr_dr_amt' => $slrdramt_arr[$k],
                'slr_cr_amt' => $slrcrdamt_arr[$k]
            );
            pma($data);
            //$this->db->insert('seller_ledger', $data);
        }
        for ($l = 0; $l < $ct; $l++) {
            $data = array(
                'trans_date' => $tanscdate_arr[$l],
                'seller_id' => $sellerid_arr[$l],
                'refer_id' => $orderid_arr[$l],
                'trans_type' => 'Sales',
                'admin_cr_amt' => $slrdramt_arr[$l],
                'admin_dr_amt' => $slrcrdamt_arr[$l]
            );
            pma($data);
            //$this->db->insert('admin_ledger', $data);
        }
        exit;
        //insert in seller and admin ledger table when return start
        $rtn_ctr = count($rtn_orderid_arr);

        if ($rtn_ctr != 0) {

            for ($kr = 0; $kr < $rtn_ctr; $kr++) {
                $minus_rtn_slrdramt = 0 - $rtn_slrdramt_arr[$kr];
                $minus_slrcrdamt = 0 - $rtn_slrcrdamt_arr[$kr];
                $datar = array(
                    'trans_date' => $rtn_tanscdate_arr[$kr],
                    'seller_id' => $rtn_sellerid_arr[$kr],
                    'refer_id' => $rtn_orderid_arr[$kr],
                    'trans_type' => 'Return',
                    'slr_dr_amt' => $minus_rtn_slrdramt,
                    'slr_cr_amt' => $minus_slrcrdamt
                );
                pma($datar);
                //$this->db->insert('seller_ledger', $datar);
            }

            for ($lr = 0; $lr < $rtn_ctr; $lr++) {
                $minus_rtn_slrdramt = 0 - $rtn_slrdramt_arr[$lr];
                $minus_rtn_slrcrdamt = 0 - $rtn_slrcrdamt_arr[$lr];

                $datar = array(
                    'trans_date' => $rtn_tanscdate_arr[$lr],
                    'seller_id' => $rtn_sellerid_arr[$lr],
                    'refer_id' => $rtn_orderid_arr[$lr],
                    'trans_type' => 'Return',
                    'admin_cr_amt' => $minus_rtn_slrdramt,
                    'admin_dr_amt' => $minus_rtn_slrcrdamt
                );
                pma($datar);
                //$this->db->insert('admin_ledger', $datar);
            }
        }
        exit(1);
        //insert in seller and admin ledger table when return end

        return true;
    }

    function insert_seller_payout_details($id_arr) {
        $ids = implode(',', $id_arr);
        $query = $this->db->query("SELECT id,seller_id,COUNT(seller_id) AS NO_OF_ORDERS, SUM(fnal_settl_amt) AS TOTAL_FNL_STL_AMT FROM transaction WHERE id IN ($ids) GROUP BY seller_id");
        $result = $query->result();

        date_default_timezone_set('Asia/Calcutta');
        $rand_id = preg_replace("/[^0-9]+/", "", date('Y-m-d H:i:s'));
        $cdate = date('Y-m-d');

        $this->load->model('Usermodel');
        foreach ($result as $rows) {
            $final_array = array();
            //getting seller_payout table max id//			
            $max_id = $this->Usermodel->get_unique_id('seller_payout', 'id');
            $settlment_ref_no = $rand_id . $max_id;

            //program start for retrieve id from transaction table//
            $sql = $this->db->query("SELECT id FROM transaction WHERE seller_id='$rows->seller_id'");
            $res = $sql->result();
            foreach ($res as $row) {
                //$trsn_id_arr[] = $row->id;
                if (in_array($row->id, $id_arr)) {
                    $final_array[] = $row->id;
                }
            }
            $trsn_id = implode(',', $final_array);
            //program end of retrieve id from transaction table//
            $data = array(
                'seller_id' => $rows->seller_id,
                'no_of_orders' => $rows->NO_OF_ORDERS,
                'settlmnt_refno' => $settlment_ref_no,
                'transaction_ids' => $trsn_id,
                'fnl_stl_amt' => $rows->TOTAL_FNL_STL_AMT,
                'pyt_generated_dt' => $cdate
            );
            $this->db->insert('seller_payout', $data);
            $last_inserted_id_arr[] = $this->db->insert_id();
        }
        //print_r($last_inserted_id_arr);

        foreach ($last_inserted_id_arr as $id) {
            $qr1 = $this->db->query("SELECT seller_id FROM seller_payout WHERE id='$id'");
            $rs1 = $qr1->result();
            $slr_id = $rs1[0]->seller_id;

            //retrieve seller bank info//
            $qr2 = $this->db->query("SELECT ac_number,bank,ifsc_code,ac_holder_name FROM seller_account_information WHERE seller_id='$slr_id'");
            $rs2 = $qr2->result();
            $bnk_data = array(
                'bnk_acnt_no' => $rs2[0]->ac_number,
                'bnk_name' => $rs2[0]->bank,
                'bnk_ifsc_code' => $rs2[0]->ifsc_code,
                'acnt_hldr_name' => $rs2[0]->ac_holder_name
            );
            //print_r($bnk_data);
            $this->db->where('id', $id);
            $this->db->where('seller_id', $slr_id);
            $this->db->update('seller_payout', $bnk_data);
        }
        return true;
    }

    function retrieve_seller_payout() {
        //$filtr_dt = $this->input->post('srch_dt');
        //echo $filtr_dt;exit;
        //$query = $this->db->query("SELECT a.*,b.business_name FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE a.pyt_generated_dt='$filtr_dt' ORDER BY a.id DESC");

        $query = $this->db->query("SELECT a.*,b.business_name FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE a.status='Pending' ORDER BY a.id DESC");
        return $query;
    }

    function retrieve_seller_all_payout($limit, $start) {
        $query = $this->db->query("SELECT a.*,b.business_name FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id ORDER BY a.id DESC LIMIT " . $start . "," . $limit . "");
        return $query;
    }

    function retrive_sellerpayout_count() {

        $query = $this->db->query("SELECT a.seller_id FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id ORDER BY a.id DESC");
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return false;
        }
    }

    function search_slrpayout() {
        $slr_name = $this->input->post('slr_name');
        $query = $this->db->query("SELECT b.business_name FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE b.business_name LIKE '$slr_name%' GROUP BY b.business_name");
        return $query;
    }

    function export_slrpayout($limit, $start) {

        $query = $this->db->query("SELECT a.*,b.business_name FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id ORDER BY a.id DESC LIMIT " . $start . "," . $limit . "");
        return $query;
    }

    function retrieve_slr_wise_payout($settlment_ref_no) {
        $query = $this->db->query("SELECT transaction_ids FROM seller_payout WHERE settlmnt_refno='$settlment_ref_no'");
        $result = $query->row();
        $transtion_id = $result->transaction_ids;
        $query = "SELECT * 
                FROM transaction t
                LEFT JOIN order_info oi on oi.order_id=t.order_no
                WHERE t.id IN ($transtion_id)";

        $query1 = $this->db->query($query);
        if ($query1->num_rows() > 0) {
            return $query1->result();
        } else {
            return false;
        }
    }

    function select_filter_slrpayout_count() {



        $slr_name = $_REQUEST['slr_name'];
        $slr_id = $_REQUEST['slr_id'];
        $no_of_reports = $_REQUEST['no_of_reports'];
        $final_stl_amt = $_REQUEST['final_stl_amt'];
        $account_no = $_REQUEST['account_no'];
        $bank_name = $_REQUEST['bank_name'];
        $ifsc_code = $_REQUEST['ifsc_code'];
        $acnt_holder = $_REQUEST['acnt_holder'];
        $utr = $_REQUEST['utr'];
        $status = $_REQUEST['status'];

        $condition = "";





        if ($slr_name != "") {
            $condition .= "b.business_name LIKE '%$slr_name%' ";

            $query = $this->db->query("SELECT a.seller_id FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE " . $condition . " ORDER BY a.id DESC ");
            return $query->num_rows();
        }


        if ($slr_id != "") {
            $condition .= "a.seller_id = '$slr_id' ";

            $query = $this->db->query("SELECT a.seller_id FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE " . $condition . " ORDER BY a.id DESC ");
            return $query->num_rows();
        }

        if ($no_of_reports != "") {
            $condition .= "a.no_of_orders = '$no_of_reports'";
            $query = $this->db->query("SELECT a.seller_id FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE " . $condition . " ORDER BY a.id DESC");
            return $query->num_rows();
        }
        if ($final_stl_amt != "") {
            $condition .= "a.fnl_stl_amt ='$final_stl_amt'";
            $query = $this->db->query("SELECT a.seller_id FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE " . $condition . " ORDER BY a.id DESC");
            return $query->num_rows();
        }
        if ($account_no != '') {
            $condition .= "a.bnk_acnt_no ='$account_no'";
            $query = $this->db->query("SELECT a.seller_id FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE " . $condition . " ORDER BY a.id DESC");
            return $query->num_rows();
        }
        if ($bank_name != '') {
            $condition .= "a.bnk_name LIKE '%$bank_name%'";
            $query = $this->db->query("SELECT a.seller_id FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE " . $condition . " ORDER BY a.id DESC");
            return $query->num_rows();
        }
        if ($ifsc_code != '') {
            $condition .= "a.bnk_ifsc_code ='$ifsc_code'";
            $query = $this->db->query("SELECT a.seller_id FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE " . $condition . " ORDER BY a.id DESC");
            return $query->num_rows();
        }
        if ($acnt_holder != '') {
            $condition .= "a.acnt_hldr_name LIKE '%$acnt_holder%'";
            $query = $this->db->query("SELECT a.seller_id FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE " . $condition . " ORDER BY a.id DESC");
            return $query->num_rows();
        }
        if ($utr != '') {
            $condition .= "a.utr_no ='$utr'";
            $query = $this->db->query("SELECT a.seller_id FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE " . $condition . " ORDER BY a.id DESC");
            return $query->num_rows();
        }
        if ($status != '') {
            $condition .= "a.status ='$status'";
            $query = $this->db->query("SELECT a.seller_id FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE " . $condition . " ORDER BY a.id DESC");
            return $query->num_rows();
        }
        if ($condition == "") {
            $query = $this->db->query("SELECT a.*,b.business_name,b.pname FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id ORDER BY a.id DESC");
            return $query->num_rows();
        }
    }

    function select_filtered_slrpayout($limit, $start) {

        $slr_name = $_REQUEST['slr_name'];
        $no_of_reports = $_REQUEST['no_of_reports'];
        $slr_id = $_REQUEST['slr_id'];
        $final_stl_amt = $_REQUEST['final_stl_amt'];
        $account_no = $_REQUEST['account_no'];
        $bank_name = $_REQUEST['bank_name'];
        $ifsc_code = $_REQUEST['ifsc_code'];
        $acnt_holder = $_REQUEST['acnt_holder'];
        $utr = $_REQUEST['utr'];
        $status = $_REQUEST['status'];

        $condition = "";





        if ($slr_name != "") {
            $condition .= "b.business_name LIKE '%$slr_name%' ";

            $query = $this->db->query("SELECT a.*,b.business_name,b.pname FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE " . $condition . " ORDER BY a.id DESC LIMIT " . $start . " , " . $limit . "");
            return $query;
        }


        if ($slr_id != "") {
            $condition .= "a.seller_id = '$slr_id' ";

            $query = $this->db->query("SELECT a.*,b.business_name,b.pname FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE " . $condition . " ORDER BY a.id DESC LIMIT " . $start . " , " . $limit . "");
            return $query;
        }


        if ($no_of_reports != "") {
            $condition .= "a.no_of_orders = '$no_of_reports'";
            $query = $this->db->query("SELECT a.*,b.business_name,b.pname FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE " . $condition . " ORDER BY a.id DESC LIMIT " . $start . " , " . $limit . "");

            return $query;
        }
        if ($final_stl_amt != "") {
            $condition .= "a.fnl_stl_amt ='$final_stl_amt'";
            $query = $this->db->query("SELECT a.*,b.business_name,b.pname FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE " . $condition . " ORDER BY a.id DESC LIMIT " . $start . " , " . $limit . "");
            return $query;
        }
        if ($account_no != '') {
            $condition .= "a.bnk_acnt_no ='$account_no'";
            $query = $this->db->query("SELECT a.*,b.business_name,b.pname FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE " . $condition . " ORDER BY a.id DESC LIMIT " . $start . " , " . $limit . " ");
            return $query;
        }

        if ($bank_name != '') {
            $condition .= "a.bnk_name LIKE '%$bank_name%'";
            $query = $this->db->query("SELECT a.*,b.business_name,b.pname FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE " . $condition . " ORDER BY a.id DESC LIMIT " . $start . " , " . $limit . "");
            return $query;
        }
        if ($ifsc_code != '') {
            $condition .= "a.bnk_ifsc_code ='$ifsc_code'";
            $query = $this->db->query("SELECT a.*,b.business_name,b.pname FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE " . $condition . " ORDER BY a.id DESC LIMIT " . $start . " , " . $limit . "");
            return $query;
        }
        if ($acnt_holder != '') {
            $condition .= "a.acnt_hldr_name LIKE '%$acnt_holder%'";
            $query = $this->db->query("SELECT a.*,b.business_name,b.pname FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE " . $condition . " ORDER BY a.id DESC LIMIT " . $start . " , " . $limit . "");
            return $query;
        }
        if ($utr != '') {
            $condition .= "a.utr_no ='$utr'";
            $query = $this->db->query("SELECT a.*,b.business_name,b.pname FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE " . $condition . " ORDER BY a.id DESC LIMIT " . $start . " , " . $limit . "");
            return $query;
        }
        if ($status != '') {
            $condition .= "a.status ='$status'";
            $query = $this->db->query("SELECT a.*,b.business_name,b.pname FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE " . $condition . " ORDER BY a.id DESC LIMIT " . $start . " , " . $limit . "");
            return $query;
        }
        if ($condition == "") {
            $query = $this->db->query("SELECT a.*,b.business_name,b.pname FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id ORDER BY a.id DESC LIMIT " . $start . " , " . $limit . "");
            return $query;
        }
    }

    function retrieve_taxreport($limit, $start) {
        $query = $this->db->query("SELECT a.product_id,a.mrp, a.price, a.special_price,a.tax_amount, a.special_pric_from_dt, a.special_pric_to_dt, b.name, c.business_name
FROM product_master a
INNER JOIN product_general_info b ON a.product_id = b.product_id
INNER JOIN seller_account_information c ON a.seller_id = c.seller_id GROUP BY a.seller_id LIMIT " . $start . "," . $limit . "");
        return $query;
    }

    function retrive_taxreport_count() {

        $query = $this->db->query("SELECT a.product_id
FROM product_master a
INNER JOIN product_general_info b ON a.product_id = b.product_id
INNER JOIN seller_account_information c ON a.seller_id = c.seller_id GROUP BY a.seller_id");
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return false;
        }
    }

    function excel_tax() {
        $query = $this->db->query("SELECT a.product_id,a.mrp, a.price, a.special_price,a.tax_amount, a.special_pric_from_dt, a.special_pric_to_dt, b.name, c.business_name
FROM product_master a
INNER JOIN product_general_info b ON a.product_id = b.product_id
INNER JOIN seller_account_information c ON a.seller_id = c.seller_id GROUP BY a.seller_id ");
        return $query;
    }

    function search_taxprodnm() {
        $prod_name = $this->input->post('prod_name');
        $query = $this->db->query("SELECT b.name
FROM product_master a
INNER JOIN product_general_info b ON a.product_id = b.product_id
INNER JOIN seller_account_information c ON a.seller_id = c.seller_id WHERE b.name LIKE '$prod_name%' GROUP BY b.name ");
        return $query;
    }

    function search_taxseller() {
        $slr_name = $this->input->post('seller_name');
        $query = $this->db->query("SELECT c.business_name
FROM product_master a
INNER JOIN product_general_info b ON a.product_id = b.product_id
INNER JOIN seller_account_information c ON a.seller_id = c.seller_id WHERE c.business_name LIKE '$slr_name%' GROUP BY c.business_name");
        return $query;
    }

    function select_filter_tax_count() {



        $prod_name = $_REQUEST['prod_name'];
        $seller_name = $_REQUEST['seller_name'];
        $mrp = $_REQUEST['mrp'];
        $selling_prc = $_REQUEST['selling_prc'];
        $spec_prc = $_REQUEST['spec_prc'];
        $spec_prc_frm_dt = $_REQUEST['spec_prc_frm_dt'];
        $spec_prc_to_dt = $_REQUEST['spec_prc_to_dt'];
        $tax = $_REQUEST['tax'];

        $condition = "";





        if ($prod_name != "") {
            $condition .= "b.name LIKE '%$prod_name%' ";

            $query = $this->db->query("SELECT a.product_id
FROM product_master a
INNER JOIN product_general_info b ON a.product_id = b.product_id
INNER JOIN seller_account_information c ON a.seller_id = c.seller_id WHERE " . $condition . " GROUP BY a.seller_id
");
            return $query->num_rows();
        }


        if ($seller_name != "") {
            $condition .= " c.business_name LIKE '%$seller_name%' ";
            $query = $this->db->query("SELECT a.product_id
FROM product_master a
INNER JOIN product_general_info b ON a.product_id = b.product_id
INNER JOIN seller_account_information c ON a.seller_id = c.seller_id WHERE " . $condition . " GROUP BY a.seller_id ");
            return $query->num_rows();
        }


        if ($mrp != "") {
            $condition .= "a.mrp = '$mrp'";
            $query = $this->db->query("SELECT a.product_id
FROM product_master a
INNER JOIN product_general_info b ON a.product_id = b.product_id
INNER JOIN seller_account_information c ON a.seller_id = c.seller_id WHERE " . $condition . " GROUP BY a.seller_id");
            return $query->num_rows();
        }
        if ($selling_prc != "") {
            $condition .= "a.price ='$selling_prc'";
            $query = $this->db->query("SELECT a.product_id
FROM product_master a
INNER JOIN product_general_info b ON a.product_id = b.product_id
INNER JOIN seller_account_information c ON a.seller_id = c.seller_id WHERE " . $condition . " GROUP BY a.seller_id");
            return $query->num_rows();
        }
        if ($spec_prc != '') {
            $condition .= "a.special_price ='$spec_prc'";
            $query = $this->db->query("SELECT a.product_id
FROM product_master a
INNER JOIN product_general_info b ON a.product_id = b.product_id
INNER JOIN seller_account_information c ON a.seller_id = c.seller_id WHERE " . $condition . " GROUP BY a.seller_id");
            return $query->num_rows();
        }


        if ($spec_prc_frm_dt != '') {
            $condition .= "a.special_pric_from_dt ='$spec_prc_frm_dt'";
            $query = $this->db->query("SELECT a.product_id
FROM product_master a
INNER JOIN product_general_info b ON a.product_id = b.product_id
INNER JOIN seller_account_information c ON a.seller_id = c.seller_id WHERE " . $condition . " GROUP BY a.seller_id");
            return $query->num_rows();
        }


        if ($spec_prc_to_dt != "") {
            $condition .= "a.special_pric_to_dt = '$spec_prc_to_dt' ";

            $query = $this->db->query("SELECT a.product_id
FROM product_master a
INNER JOIN product_general_info b ON a.product_id = b.product_id
INNER JOIN seller_account_information c ON a.seller_id = c.seller_id WHERE " . $condition . " GROUP BY a.seller_id
");
            return $query->num_rows();
        }

        if ($tax != "") {
            $condition .= "a.tax_amount = '$tax' ";

            $query = $this->db->query("SELECT a.product_id
FROM product_master a
INNER JOIN product_general_info b ON a.product_id = b.product_id
INNER JOIN seller_account_information c ON a.seller_id = c.seller_id WHERE " . $condition . " GROUP BY a.seller_id
");
            return $query->num_rows();
        }

        if ($condition == "") {
            $query = $this->db->query("SELECT a.product_id
FROM product_master a
INNER JOIN product_general_info b ON a.product_id = b.product_id
INNER JOIN seller_account_information c ON a.seller_id = c.seller_id GROUP BY a.seller_id");
            return $query->num_rows();
        }
    }

    function select_filtered_tax($limit, $start) {

        $prod_name = $_REQUEST['prod_name'];
        $seller_name = $_REQUEST['seller_name'];
        $mrp = $_REQUEST['mrp'];
        $selling_prc = $_REQUEST['selling_prc'];
        $spec_prc = $_REQUEST['spec_prc'];
        $spec_prc_frm_dt = $_REQUEST['spec_prc_frm_dt'];
        $spec_prc_to_dt = $_REQUEST['spec_prc_to_dt'];
        $tax = $_REQUEST['tax'];

        $condition = "";





        if ($prod_name != "") {
            $condition .= "b.name LIKE '%$prod_name%' ";

            $query = $this->db->query("SELECT a.product_id,a.mrp, a.price, a.special_price,a.tax_amount, a.special_pric_from_dt, a.special_pric_to_dt, b.name, c.business_name
FROM product_master a
INNER JOIN product_general_info b ON a.product_id = b.product_id
INNER JOIN seller_account_information c ON a.seller_id = c.seller_id WHERE " . $condition . " GROUP BY a.seller_id LIMIT " . $start . " , " . $limit . "");
            return $query;
        }


        if ($seller_name != "") {
            $condition .= " c.business_name LIKE '%$seller_name%' ";
            $query = $this->db->query("SELECT a.product_id,a.mrp, a.price, a.special_price,a.tax_amount, a.special_pric_from_dt, a.special_pric_to_dt, b.name, c.business_name
FROM product_master a
INNER JOIN product_general_info b ON a.product_id = b.product_id
INNER JOIN seller_account_information c ON a.seller_id = c.seller_id WHERE " . $condition . " GROUP BY a.seller_id LIMIT " . $start . " , " . $limit . "");
            return $query;
        }


        if ($mrp != "") {
            $condition .= "a.mrp = '$mrp'";
            $query = $this->db->query("SELECT a.product_id,a.mrp, a.price, a.special_price,a.tax_amount, a.special_pric_from_dt, a.special_pric_to_dt, b.name, c.business_name
FROM product_master a
INNER JOIN product_general_info b ON a.product_id = b.product_id
INNER JOIN seller_account_information c ON a.seller_id = c.seller_id WHERE " . $condition . " GROUP BY a.seller_id LIMIT " . $start . " , " . $limit . "");

            return $query;
        }
        if ($selling_prc != "") {
            $condition .= "a.price ='$selling_prc'";
            $query = $this->db->query("SELECT a.product_id,a.mrp, a.price, a.special_price,a.tax_amount, a.special_pric_from_dt, a.special_pric_to_dt, b.name, c.business_name
FROM product_master a
INNER JOIN product_general_info b ON a.product_id = b.product_id
INNER JOIN seller_account_information c ON a.seller_id = c.seller_id WHERE " . $condition . " GROUP BY a.seller_id LIMIT " . $start . " , " . $limit . "");
            return $query;
        }
        if ($spec_prc != '') {
            $condition .= "a.special_price ='$spec_prc'";
            $query = $this->db->query("SELECT a.product_id,a.mrp, a.price, a.special_price,a.tax_amount, a.special_pric_from_dt, a.special_pric_to_dt, b.name, c.business_name
FROM product_master a
INNER JOIN product_general_info b ON a.product_id = b.product_id
INNER JOIN seller_account_information c ON a.seller_id = c.seller_id WHERE " . $condition . " GROUP BY a.seller_id LIMIT " . $start . " , " . $limit . " ");
            return $query;
        }
        if ($spec_prc_frm_dt != '') {
            $condition .= "a.special_pric_from_dt ='$spec_prc_frm_dt'";
            $query = $this->db->query("SELECT a.product_id,a.mrp, a.price, a.special_price,a.tax_amount, a.special_pric_from_dt, a.special_pric_to_dt, b.name, c.business_name
FROM product_master a
INNER JOIN product_general_info b ON a.product_id = b.product_id
INNER JOIN seller_account_information c ON a.seller_id = c.seller_id WHERE " . $condition . " GROUP BY a.seller_id LIMIT " . $start . " , " . $limit . "");
            return $query;
        }


        if ($spec_prc_to_dt != "") {
            $condition .= "a.special_pric_to_dt = '$spec_prc_to_dt' ";

            $query = $this->db->query("SELECT a.product_id,a.mrp, a.price, a.special_price,a.tax_amount, a.special_pric_from_dt, a.special_pric_to_dt, b.name, c.business_name
FROM product_master a
INNER JOIN product_general_info b ON a.product_id = b.product_id
INNER JOIN seller_account_information c ON a.seller_id = c.seller_id WHERE " . $condition . " GROUP BY a.seller_id LIMIT " . $start . " , " . $limit . "
");
            return $query;
        }

        if ($tax != "") {
            $condition .= "a.tax_amount = '$tax' ";

            $query = $this->db->query("SELECT a.product_id,a.mrp, a.price, a.special_price,a.tax_amount, a.special_pric_from_dt, a.special_pric_to_dt, b.name, c.business_name
FROM product_master a
INNER JOIN product_general_info b ON a.product_id = b.product_id
INNER JOIN seller_account_information c ON a.seller_id = c.seller_id WHERE " . $condition . " GROUP BY a.seller_id LIMIT " . $start . " , " . $limit . "
");
            return $query;
        }

        if ($condition == "") {
            $query = $this->db->query("SELECT a.product_id,a.mrp, a.price, a.special_price,a.tax_amount, a.special_pric_from_dt, a.special_pric_to_dt, b.name, c.business_name
FROM product_master a
INNER JOIN product_general_info b ON a.product_id = b.product_id
INNER JOIN seller_account_information c ON a.seller_id = c.seller_id GROUP BY a.seller_id LIMIT " . $start . " , " . $limit . "");
            return $query;
        }
    }

    function retrieve_slrprfl($limit, $start) {
        $query = $this->db->query("SELECT a.seller_id,a.seller_state, a.seller_city, a.email, a.approval_date, a.status, b.business_name,b.ac_holder_name, b.ifsc_code, b.bank, b.branch, b.state, b.pan, b.tin, b.tan
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id LIMIT " . $start . "," . $limit . "");
        return $query;
    }

    function retrive_slrprfl_count() {

        $query = $this->db->query("SELECT a.seller_id
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id");
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return false;
        }
    }

    function search_slrprfl() {
        $slr_name = $this->input->post('seller');
        $query = $this->db->query("SELECT b.business_name
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE b.business_name LIKE '$slr_name%' GROUP BY b.business_name");
        return $query;
    }

    function excel_slrprfl($limit, $start) {
        $query = $this->db->query("SELECT a.seller_id,a.seller_state, a.seller_city, a.email, a.approval_date, a.status, b.business_name,b.ac_holder_name, b.ifsc_code, b.bank, b.branch, b.state, b.pan, b.tin, b.tan
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id LIMIT " . $start . "," . $limit . "");
        return $query;
    }

    function select_filter_slrprfl_count() {


        $seller = $_REQUEST['seller'];
        $slr_state = $_REQUEST['slr_state'];
        $city = $_REQUEST['city'];
        $slr_email = $_REQUEST['slr_email'];
        $appr_dt = $_REQUEST['appr_dt'];
        $status = $_REQUEST['status'];
        $ac_holder = $_REQUEST['ac_holder'];
        $ifsc = $_REQUEST['ifsc'];
        $bank = $_REQUEST['bank'];
        $branch = $_REQUEST['branch'];
        $bank_state = $_REQUEST['bank_state'];
        $pan = $_REQUEST['pan'];
        $tin = $_REQUEST['tin'];
        $tan = $_REQUEST['tan'];

        $condition = "";






        if ($seller != "") {
            $condition .= "b.business_name LIKE '%$seller%' ";

            $query = $this->db->query("SELECT a.seller_id
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . "
");
            return $query->num_rows();
        }


        if ($slr_state != "") {
            $condition .= "a.seller_state ='$slr_state' ";

            $query = $this->db->query("SELECT a.seller_id
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . "
");
            return $query->num_rows();
        }


        if ($city != "") {
            $condition .= " a.seller_city ='$city' ";
            $query = $this->db->query("SELECT a.seller_id
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . "");
            return $query->num_rows();
        }


        if ($slr_email != "") {
            $condition .= "a.email LIKE '%$slr_email%'";
            $query = $this->db->query("SELECT a.seller_id
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . "");
            return $query->num_rows();
        }
        if ($appr_dt != "") {
            $condition .= "a.approval_date LIKE '%$appr_dt%'";
            $query = $this->db->query("SELECT a.seller_id
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . "");
            return $query->num_rows();
        }
        if ($status != '') {
            $condition .= "a.status ='$status'";
            $query = $this->db->query("SELECT a.seller_id
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . "");
            return $query->num_rows();
        }


        if ($ac_holder != '') {
            $condition .= "b.ac_holder_name ='%$ac_holder%'";
            $query = $this->db->query("SELECT a.seller_id
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . "");
            return $query->num_rows();
        }


        if ($ifsc != "") {
            $condition .= "b.ifsc_code = '$ifsc' ";

            $query = $this->db->query("SELECT a.seller_id
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . "
");
            return $query->num_rows();
        }

        if ($bank != "") {
            $condition .= "b.bank LIKE '%$bank%' ";

            $query = $this->db->query("SELECT a.seller_id
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . "
");
            return $query->num_rows();
        }


        if ($branch != "") {
            $condition .= "b.branch LIKE '%$branch%' ";

            $query = $this->db->query("SELECT a.seller_id
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . "
");
            return $query->num_rows();
        }

        if ($bank_state != "") {
            $condition .= "b.state ='$bank_state' ";

            $query = $this->db->query("SELECT a.seller_id
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . "
");
            return $query->num_rows();
        }

        if ($pan != "") {
            $condition .= "b.pan ='$pan' ";

            $query = $this->db->query("SELECT a.seller_id
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . "
");
            return $query->num_rows();
        }
        if ($tin != "") {
            $condition .= "b.tin='$tin' ";

            $query = $this->db->query("SELECT a.seller_id
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . "
");
            return $query->num_rows();
        }


        if ($tan != "") {
            $condition .= "a.seller_state ='$tan' ";

            $query = $this->db->query("SELECT a.seller_id
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . "
");
            return $query->num_rows();
        }


        if ($condition == "") {
            $query = $this->db->query("SELECT a.seller_id
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id");
            return $query->num_rows();
        }
    }

    function select_filtered_slrprfl($limit, $start) {

        $seller = $_REQUEST['seller'];
        $slr_state = $_REQUEST['slr_state'];
        $city = $_REQUEST['city'];
        $slr_email = $_REQUEST['slr_email'];
        $appr_dt = $_REQUEST['appr_dt'];
        $status = $_REQUEST['status'];
        $ac_holder = $_REQUEST['ac_holder'];
        $ifsc = $_REQUEST['ifsc'];
        $bank = $_REQUEST['bank'];
        $branch = $_REQUEST['branch'];
        $bank_state = $_REQUEST['bank_state'];
        $pan = $_REQUEST['pan'];
        $tin = $_REQUEST['tin'];
        $tan = $_REQUEST['tan'];

        $condition = "";






        if ($seller != "") {
            $condition .= "b.business_name LIKE '%$seller%' ";

            $query = $this->db->query("SELECT a.seller_id,a.seller_state, a.seller_city, a.email, a.approval_date, a.status, b.business_name,b.ac_holder_name, b.ifsc_code, b.bank, b.branch, b.state, b.pan, b.tin, b.tan
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . " LIMIT " . $start . " , " . $limit . "
");
            return $query;
        }


        if ($slr_state != "") {
            $condition .= "a.seller_state ='$slr_state' ";

            $query = $this->db->query("SELECT a.seller_id,a.seller_state, a.seller_city, a.email, a.approval_date, a.status, b.business_name,b.ac_holder_name, b.ifsc_code, b.bank, b.branch, b.state, b.pan, b.tin, b.tan
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . " LIMIT " . $start . " , " . $limit . "");
            return $query;
        }


        if ($city != "") {
            $condition .= " a.seller_city ='$city' ";
            $query = $this->db->query("SELECT a.seller_id,a.seller_state, a.seller_city, a.email, a.approval_date, a.status, b.business_name,b.ac_holder_name, b.ifsc_code, b.bank, b.branch, b.state, b.pan, b.tin, b.tan
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . " LIMIT " . $start . " , " . $limit . "");
            return $query;
        }


        if ($slr_email != "") {
            $condition .= "a.email LIKE '%$slr_email%'";
            $query = $this->db->query("SELECT a.seller_id,a.seller_state, a.seller_city, a.email, a.approval_date, a.status, b.business_name,b.ac_holder_name, b.ifsc_code, b.bank, b.branch, b.state, b.pan, b.tin, b.tan
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . " LIMIT " . $start . " , " . $limit . "");

            return $query;
        }
        if ($appr_dt != "") {
            $condition .= "a.approval_date LIKE '%$appr_dt%'";
            $query = $this->db->query("SELECT a.seller_id,a.seller_state, a.seller_city, a.email, a.approval_date, a.status, b.business_name,b.ac_holder_name, b.ifsc_code, b.bank, b.branch, b.state, b.pan, b.tin, b.tan
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . " LIMIT " . $start . " , " . $limit . "");
            return $query;
        }
        if ($status != '') {
            $condition .= "a.status ='$status'";
            $query = $this->db->query("SELECT a.seller_id,a.seller_state, a.seller_city, a.email, a.approval_date, a.status, b.business_name,b.ac_holder_name, b.ifsc_code, b.bank, b.branch, b.state, b.pan, b.tin, b.tan
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . " LIMIT " . $start . " , " . $limit . " ");
            return $query;
        }
        if ($ac_holder != '') {
            $condition .= "b.ac_holder_name LIKE '%$ac_holder%'";
            $query = $this->db->query("SELECT a.seller_id,a.seller_state, a.seller_city, a.email, a.approval_date, a.status, b.business_name,b.ac_holder_name, b.ifsc_code, b.bank, b.branch, b.state, b.pan, b.tin, b.tan
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . " LIMIT " . $start . " , " . $limit . "");
            return $query;
        }


        if ($ifsc != "") {
            $condition .= "b.ifsc_code = '$ifsc' ";

            $query = $this->db->query("SELECT a.seller_id,a.seller_state, a.seller_city, a.email, a.approval_date, a.status, b.business_name,b.ac_holder_name, b.ifsc_code, b.bank, b.branch, b.state, b.pan, b.tin, b.tan
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . " LIMIT " . $start . " , " . $limit . "
");
            return $query;
        }

        if ($bank != "") {
            $condition .= "b.bank LIKE '%$bank%' ";

            $query = $this->db->query("SELECT a.seller_id,a.seller_state, a.seller_city, a.email, a.approval_date, a.status, b.business_name,b.ac_holder_name, b.ifsc_code, b.bank, b.branch, b.state, b.pan, b.tin, b.tan
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . " LIMIT " . $start . " , " . $limit . "
");
            return $query;
        }

        if ($branch != "") {
            $condition .= "b.branch LIKE '%$branch%' ";

            $query = $this->db->query("SELECT a.seller_id,a.seller_state, a.seller_city, a.email, a.approval_date, a.status, b.business_name,b.ac_holder_name, b.ifsc_code, b.bank, b.branch, b.state, b.pan, b.tin, b.tan
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . " LIMIT " . $start . " , " . $limit . "
");
            return $query;
        }

        if ($bank_state != "") {
            $condition .= "b.state ='$bank_state' ";

            $query = $this->db->query("SELECT a.seller_id,a.seller_state, a.seller_city, a.email, a.approval_date, a.status, b.business_name,b.ac_holder_name, b.ifsc_code, b.bank, b.branch, b.state, b.pan, b.tin, b.tan
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . " LIMIT " . $start . " , " . $limit . "
");
            return $query;
        }

        if ($pan != "") {
            $condition .= "b.pan ='$pan' ";

            $query = $this->db->query("SELECT a.seller_id,a.seller_state, a.seller_city, a.email, a.approval_date, a.status, b.business_name,b.ac_holder_name, b.ifsc_code, b.bank, b.branch, b.state, b.pan, b.tin, b.tan
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . " LIMIT " . $start . " , " . $limit . "
");
            return $query;
        }
        if ($tin != "") {
            $condition .= "b.tin='$tin' ";

            $query = $this->db->query("SELECT a.seller_id,a.seller_state, a.seller_city, a.email, a.approval_date, a.status, b.business_name,b.ac_holder_name, b.ifsc_code, b.bank, b.branch, b.state, b.pan, b.tin, b.tan
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . " LIMIT " . $start . " , " . $limit . "
");
            return $query;
        }


        if ($tan != "") {
            $condition .= "b.tan ='$tan' ";

            $query = $this->db->query("SELECT a.seller_id,a.seller_state, a.seller_city, a.email, a.approval_date, a.status, b.business_name,b.ac_holder_name, b.ifsc_code, b.bank, b.branch, b.state, b.pan, b.tin, b.tan
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id WHERE " . $condition . " LIMIT " . $start . " , " . $limit . "
");
            return $query;
        }

        if ($condition == "") {
            $query = $this->db->query("SELECT a.seller_id,a.seller_state, a.seller_city, a.email, a.approval_date, a.status, b.business_name,b.ac_holder_name, b.ifsc_code, b.bank, b.branch, b.state, b.pan, b.tin, b.tan
FROM seller_account a
INNER JOIN seller_account_information b ON a.seller_id = b.seller_id LIMIT " . $start . " , " . $limit . "");
            return $query;
        }
    }

    function retrieve_byrprfl($limit, $start) {
        $query = $this->db->query("SELECT a.registration_date, a.gendr, a.mob, a.email, a.status, b.full_name, b.country, b.address, b.city, b.pin_code, c.state
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
INNER JOIN state c ON b.state = c.state_id
WHERE a.address_id = b.address_id LIMIT " . $start . "," . $limit . "");
        return $query;
    }

    function retrive_byrprfl_count() {

        $query = $this->db->query("SELECT a.user_id
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
INNER JOIN state c ON b.state = c.state_id
WHERE a.address_id = b.address_id");
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return false;
        }
    }

    function excel_buyrprfl($limit, $start) {
        $query = $this->db->query("SELECT a.registration_date, a.gendr, a.mob, a.email, a.status, b.full_name, b.country, b.address, b.city, b.pin_code, c.state
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
INNER JOIN state c ON b.state = c.state_id
WHERE a.address_id = b.address_id LIMIT " . $start . "," . $limit . "");
        return $query;
    }

    function select_filter_byrprfl_count() {


        $byrnm = $_REQUEST['byrnm'];
        $regd_dt = $_REQUEST['regd_dt'];
        $gender = $_REQUEST['gender'];
        $mob = $_REQUEST['mob'];
        $email = $_REQUEST['email'];
        $country = $_REQUEST['country'];
        $state = $_REQUEST['state'];
        $st_address = $_REQUEST['st_address'];
        $city = $_REQUEST['city'];
        //$pin = $_REQUEST['pin'];
        $status = $_REQUEST['status'];

        $condition = "";




        if ($byrnm != "") {
            $condition .= "b.full_name LIKE '%$byrnm%' ";

            $query = $this->db->query("SELECT a.user_id
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
WHERE a.address_id = b.address_id AND " . $condition . " ");
            return $query->num_rows();
        }
        if ($regd_dt != "") {
            $condition .= "a.registration_date LIKE '%$regd_dt%' ";

            $query = $this->db->query("SELECT a.user_id
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
INNER JOIN state c ON b.state = c.state_id
WHERE a.address_id = b.address_id AND " . $condition . "
");
            return $query->num_rows();
        }


        if ($gender != "") {
            $condition .= " a.gendr = '$gender' ";
            $query = $this->db->query("SELECT a.user_id
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
INNER JOIN state c ON b.state = c.state_id
WHERE a.address_id = b.address_id AND " . $condition . "");
            return $query->num_rows();
        }


        if ($mob != "") {
            $condition .= "a.mob = '$mob'";
            $query = $this->db->query("SELECT a.user_id
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
INNER JOIN state c ON b.state = c.state_id
WHERE a.address_id = b.address_id AND " . $condition . "");
            return $query->num_rows();
        }
        if ($email != "") {
            $condition .= "a.email LIKE '%$email%'";
            $query = $this->db->query("SELECT a.user_id
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
INNER JOIN state c ON b.state = c.state_id
WHERE a.address_id = b.address_id AND " . $condition . "");
            return $query->num_rows();
        }
        if ($country != '') {
            $condition .= "b.country LIKE '$country%'";
            $query = $this->db->query("SELECT a.user_id
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
INNER JOIN state c ON b.state = c.state_id
WHERE a.address_id = b.address_id AND " . $condition . "");
            return $query->num_rows();
        }


        if ($state != '') {
            $condition .= "c.state LIKE '$state%'";
            $query = $this->db->query("SELECT a.user_id
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
INNER JOIN state c ON b.state = c.state_id
WHERE a.address_id = b.address_id AND " . $condition . "");
            return $query->num_rows();
        }


        if ($st_address != "") {
            $condition .= "b.address LIKE '$st_address%' ";

            $query = $this->db->query("SELECT a.user_id
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
INNER JOIN state c ON b.state = c.state_id
WHERE a.address_id = b.address_id AND " . $condition . "
");
            return $query->num_rows();
        }

        if ($city != "") {
            $condition .= "b.city LIKE '$city%' ";

            $query = $this->db->query("SELECT a.user_id
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
INNER JOIN state c ON b.state = c.state_id
WHERE a.address_id = b.address_id AND " . $condition . "
");
            return $query->num_rows();
        }

        /* if($pin != ""){
          $condition .= "b.pin_code = '$pin' " ;

          $query = $this->db->query("SELECT a.user_id
          FROM user a
          INNER JOIN user_address b ON a.user_id = b.user_id
          INNER JOIN state c ON b.state = c.state_id
          WHERE a.address_id = b.address_id AND ".$condition."
          ");
          return $query;
          } */

        if ($status != "") {
            $condition .= "a.status = '$status' ";

            $query = $this->db->query("SELECT a.user_id
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
INNER JOIN state c ON b.state = c.state_id
WHERE a.address_id = b.address_id AND " . $condition . "
");
            return $query->num_rows();
        }

        if ($condition == "") {
            $query = $this->db->query("SELECT a.user_id
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
INNER JOIN state c ON b.state = c.state_id
WHERE a.address_id = b.address_id");
            return $query->num_rows();
        }
    }

    function select_filtered_byrprfl($limit, $start) {

        $byrnm = $_REQUEST['byrnm'];
        $regd_dt = $_REQUEST['regd_dt'];
        $gender = $_REQUEST['gender'];
        $mob = $_REQUEST['mob'];
        $email = $_REQUEST['email'];
        $country = $_REQUEST['country'];
        $state = $_REQUEST['state'];
        $st_address = $_REQUEST['st_address'];
        $city = $_REQUEST['city'];
        //$pin = $_REQUEST['pin'];
        $status = $_REQUEST['status'];

        $condition = "";





        if ($byrnm != "") {
            $condition .= "b.full_name LIKE '%$byrnm%' ";

            $query = $this->db->query("SELECT a.registration_date, a.gendr, a.mob, a.email, a.status, b.full_name, b.country, b.address, b.city, b.pin_code, c.state
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
INNER JOIN state c ON b.state = c.state_id
WHERE a.address_id = b.address_id AND " . $condition . " LIMIT " . $start . " , " . $limit . "");
            return $query;
        }

        if ($regd_dt != "") {
            $condition .= "a.registration_date LIKE '%$regd_dt%' ";

            $query = $this->db->query("SELECT a.registration_date, a.gendr, a.mob, a.email, a.status, b.full_name, b.country, b.address, b.city, b.pin_code, c.state
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
INNER JOIN state c ON b.state = c.state_id
WHERE a.address_id = b.address_id AND " . $condition . " LIMIT " . $start . " , " . $limit . "");
            return $query;
        }


        if ($gender != "") {
            $condition .= " a.gendr = '$gender' ";
            $query = $this->db->query("SELECT a.registration_date, a.gendr, a.mob, a.email, a.status, b.full_name, b.country, b.address, b.city, b.pin_code, c.state
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
INNER JOIN state c ON b.state = c.state_id
WHERE a.address_id = b.address_id AND " . $condition . " LIMIT " . $start . " , " . $limit . "");
            return $query;
        }


        if ($mob != "") {
            $condition .= "a.mob = '$mob'";
            $query = $this->db->query("SELECT a.registration_date, a.gendr, a.mob, a.email, a.status, b.full_name, b.country, b.address, b.city, b.pin_code, c.state
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
INNER JOIN state c ON b.state = c.state_id
WHERE a.address_id = b.address_id AND " . $condition . " LIMIT " . $start . " , " . $limit . "");

            return $query;
        }
        if ($email != "") {
            $condition .= "a.email LIKE '%$email%'";
            $query = $this->db->query("SELECT a.registration_date, a.gendr, a.mob, a.email, a.status, b.full_name, b.country, b.address, b.city, b.pin_code, c.state
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
INNER JOIN state c ON b.state = c.state_id
WHERE a.address_id = b.address_id AND " . $condition . " LIMIT " . $start . " , " . $limit . "");
            return $query;
        }
        if ($country != '') {
            $condition .= "b.country LIKE '$country%'";
            $query = $this->db->query("SELECT a.registration_date, a.gendr, a.mob, a.email, a.status, b.full_name, b.country, b.address, b.city, b.pin_code, c.state
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
INNER JOIN state c ON b.state = c.state_id
WHERE a.address_id = b.address_id AND " . $condition . " LIMIT " . $start . " , " . $limit . " ");
            return $query;
        }
        if ($state != '') {
            $condition .= "c.state LIKE '$state%'";
            $query = $this->db->query("SELECT a.registration_date, a.gendr, a.mob, a.email, a.status, b.full_name, b.country, b.address, b.city, b.pin_code, c.state
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
INNER JOIN state c ON b.state = c.state_id
WHERE a.address_id = b.address_id AND " . $condition . " LIMIT " . $start . " , " . $limit . "");
            return $query;
        }


        if ($st_address != "") {
            $condition .= "b.address LIKE '%$st_address%' ";

            $query = $this->db->query("SELECT a.registration_date, a.gendr, a.mob, a.email, a.status, b.full_name, b.country, b.address, b.city, b.pin_code, c.state
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
INNER JOIN state c ON b.state = c.state_id
WHERE a.address_id = b.address_id AND " . $condition . " LIMIT " . $start . " , " . $limit . "
");
            return $query;
        }

        if ($city != "") {
            $condition .= "b.city LIKE '$city%' ";

            $query = $this->db->query("SELECT a.registration_date, a.gendr, a.mob, a.email, a.status, b.full_name, b.country, b.address, b.city, b.pin_code, c.state
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
INNER JOIN state c ON b.state = c.state_id
WHERE a.address_id = b.address_id AND " . $condition . " LIMIT " . $start . " , " . $limit . "
");
            return $query;
        }

        /* if($pin != ""){
          $condition .= "b.pin_code = '$pin' " ;

          $query = $this->db->query("SELECT a.registration_date, a.gendr, a.mob, a.email, a.status, b.full_name, b.country, b.address, b.city, b.pin_code, c.state
          FROM user a
          INNER JOIN user_address b ON a.user_id = b.user_id
          INNER JOIN state c ON b.state = c.state_id
          WHERE a.address_id = b.address_id AND ".$condition." LIMIT ".$start." , ".$limit."
          ");
          return $query;
          } */

        if ($status != "") {
            $condition .= "a.status = '$status' ";

            $query = $this->db->query("SELECT a.registration_date, a.gendr, a.mob, a.email, a.status, b.full_name, b.country, b.address, b.city, b.pin_code, c.state
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
INNER JOIN state c ON b.state = c.state_id
WHERE a.address_id = b.address_id AND " . $condition . " LIMIT " . $start . " , " . $limit . "
");
            return $query;
        }

        if ($condition == "") {
            $query = $this->db->query("SELECT a.registration_date, a.gendr, a.mob, a.email, a.status, b.full_name, b.country, b.address, b.city, b.pin_code, c.state
FROM user a
INNER JOIN user_address b ON a.user_id = b.user_id
INNER JOIN state c ON b.state = c.state_id
WHERE a.address_id = b.address_id LIMIT " . $start . " , " . $limit . "");
            return $query;
        }
    }

    /* function retrieve_seller_payout(){
      //$filtr_dt = $this->input->post('srch_dt');
      //echo $filtr_dt;exit;
      //$query = $this->db->query("SELECT a.*,b.business_name FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE a.pyt_generated_dt='$filtr_dt' ORDER BY a.id DESC");

      $query = $this->db->query("SELECT a.*,b.business_name FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE a.status='Pending' ORDER BY a.id DESC");
      return $query;
      }


      function retrieve_seller_all_payout(){
      $query = $this->db->query("SELECT a.*,b.business_name FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id ORDER BY a.id DESC");
      return $query;
      } */

    function retrieve_seller_payout_datewise() {
        $filtr_dt = $this->input->post('srch_dt');
        $query = $this->db->query("SELECT a.*,b.business_name FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE a.pyt_generated_dt='$filtr_dt' AND a.status='Pending' ORDER BY a.id DESC");
        return $query;
    }

    function retrieve_seller_all_payout_datewise() {
        $filtr_dt = $this->input->post('srch_dt');
        $query = $this->db->query("SELECT a.*,b.business_name FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id WHERE a.pyt_generated_dt='$filtr_dt' ORDER BY a.id DESC");
        return $query;
    }

    function update_inn_utr_no() {
        date_default_timezone_set('Asia/Calcutta');
        $cdate = date('Y-m-d');

        $id = $this->input->post('hidden_id');
        $utr_no = $this->input->post('utr_no');
        $id_n_utr_no = array_combine($id, $utr_no);
        foreach ($id_n_utr_no as $id => $utr_no) {
            if ($utr_no != '') {
                $data = array(
                    'utr_no' => $utr_no,
                    'status' => 'Paid',
                    'pyt_updation_dt' => $cdate
                );
                $this->db->where('id', $id);
                $this->db->update('seller_payout', $data);
            }
        }
        return true;
    }

    function getPayoutExcel() {
        /* $query = $this->db->query("SELECT a. * , b.business_name, c.order_status_modified_date
          FROM transaction a
          INNER JOIN seller_account_information b ON a.seller_id = b.seller_id
          INNER JOIN order_info c ON a.order_no = c.order_id
          WHERE c.order_status =  'Delivered' AND a.payout_gen_status='no'
          AND c.order_status_modified_date <= CURDATE( ) - INTERVAL 3
          DAY
          ORDER BY a.id DESC "); */
        $query = "SELECT a. * ,sa.full_name, b.business_name, c.order_status_modified_date,c.order_status
	FROM transaction a
	INNER JOIN seller_account_information b ON a.seller_id = b.seller_id
	INNER JOIN order_info c ON a.order_no = c.order_id
        LEFT JOIN shipping_address sa ON sa.order_id = a.order_no
	WHERE a.pyt_genrted_dt IN (SELECT max(pyt_genrted_dt) FROM transaction)";
        $query = $this->db->query($query);

        return $query;
    }

    function getSellerPayoutExcel() {
        $query = $this->db->query("SELECT a.*,b.business_name FROM seller_payout a INNER JOIN seller_account_information b ON a.seller_id=b.seller_id");
        return $query;
    }

    function get_refundlist() {
        $query_return = $this->db->query("select a.*,d.fname,d.lname,d.user_id from return_product a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join user d on d.user_id=b.user_id where a.return_typ='Refund' and  a.return_request_approve_status='Approved' and refund_report_genDate='0000-00-00 00:00:00' ORDER BY a.id DESC  ");
        $row_return = $query_return->result();
        return $row_return;
    }

    function get_utrList() {
        $query_return = $this->db->query("select a.*,d.fname,d.lname from return_product a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join user d on d.user_id=b.user_id where a.return_typ='Refund' and  a.return_request_approve_status='Approved' and refund_report_genDate!='0000-00-00 00:00:00' ORDER BY a.id DESC  ");
        $row_return = $query_return->result();
        return $row_return;
    }

    function update_inn_buyerutr_no() {

        date_default_timezone_set('Asia/Calcutta');
        $cdate = date('Y-m-d');

        $id = $this->input->post('hidden_id');
        $utr_no = $this->input->post('utr_no');
        $id_n_utr_no = array_combine($id, $utr_no);
        foreach ($id_n_utr_no as $id => $utr_no) {
            if ($utr_no != '') {
                $data = array(
                    'utr_number' => $utr_no,
                    'payment_status' => 'Paid',
                    'payment_date' => $cdate
                );
                $this->db->where('return_id', $id);
                $this->db->update('return_product', $data);
            }
        }
        return true;
    }

    function get_utrList_datewise() {
        $filtr_dt = $this->input->post('srch_dt');
        $query = $this->db->query("select a.*,d.fname,d.lname from return_product a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join user d on d.user_id=b.user_id where a.return_typ='Refund' and  a.return_request_approve_status='Approved' and refund_report_genDate!='0000-00-00 00:00:00' and payment_date!='0000-00-00' and a.payment_date='$filtr_dt' ORDER BY a.id DESC ");
        $row_return = $query->result();
        return $row_return;
    }

    function get_refundlist_forExcel($order_id_arr) {

        date_default_timezone_set('Asia/Calcutta');
        $cdate = date('y-m-d H:i:s');

        for ($i = 0; $i < count($order_id_arr); $i++) {

            $this->db->query("update return_product set refund_report_genDate='$cdate' where order_id='$order_id_arr[$i]' ");
        }


        $query_return = $this->db->query("select a.*,d.fname,d.lname from return_product a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join user d on d.user_id=b.user_id where a.return_typ='Refund' and  a.return_request_approve_status='Approved' and refund_report_genDate!='0000-00-00 00:00:00' ");
        $row_return = $query_return->result();
        return $row_return;
    }

    function get_buyer_wallet_count() {
        if ($this->input->get('slrsreach_name') != '') {
            $nm = $this->input->get('slrsreach_name');
            $query = $this->db->query("select id  from user WHERE fname LIKE '%$nm%'  ");
            $ctr = $query->num_rows();
        } else {

            $query = $this->db->query("select id  from user  ");
            $ctr = $query->num_rows();
        }
        return $ctr;
    }

    function get_buyer_wallet($limit, $start) {
        //$query=$this->db->query("select a.*,b.*,a.user_id as wallet_user_id from wallet_info a inner join user b on a.user_id=b.user_id");

        if ($this->input->get('slrsreach_name') != '') {
            $nm = $this->input->get('slrsreach_name');
            $query = $this->db->query("select *  from user WHERE fname LIKE '%$nm%'  order by id DESC LIMIT " . $start . " , " . $limit . " ");

            $result_wallet = $query->result();
            return $result_wallet;
        } else {
            $query = $this->db->query("select *  from user order by id DESC LIMIT " . $start . " , " . $limit . " ");

            $result_wallet = $query->result();
            return $result_wallet;
        }
    }

    function update_wallet_statusapprove($wallet_user_id, $status) {

        $this->db->query("update wallet_info set wallet_approve_status='$status' where user_id='$wallet_user_id' ");
    }

    function walletdetail_as_user_id($wallet_user_id) {
        $query_return = $this->db->query("select a.*,c.name as prd_name,d.imag,e.fname,e.lname,f.business_name,g.wallet_balance  from return_product a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join product_general_info c on c.product_id=b.product_id inner join product_image d on c.product_id=d.product_id inner join user e on e.user_id=b.user_id inner join seller_account_information f on f.seller_id=b.seller_id inner join wallet_info g on g.user_id=e.user_id  where g.user_id='$wallet_user_id' and a.return_typ='Wallet'  ");

        $row_return = $query_return->result();

        return $row_return;
    }

    function purchased_by_wallet($wallet_user_id) {
        $query = $this->db->query("select b.order_id,c.name as prd_name,d.imag,e.business_name,b.quantity,b.sub_total_amount ,e.business_name from order_info a 
		INNER JOIN ordered_product_from_addtocart b on a.order_id=b.order_id 
		INNER JOIN product_general_info c on c.product_id=b.product_id 
		INNER JOIN  product_image d  on d.product_id=b.product_id 
		INNER JOIN seller_account_information e on b.seller_id = e.seller_id 
		WHERE b.user_id='$wallet_user_id' and a.payment_mode=3    ");

        $row = $query->result();

        return $row;
    }

    function retrieve_admn_ledger_data() {
        //$query = $this->db->query("SELECT * FROM admin_ledger");
        $query = $this->db->query("SELECT trans_date, seller_id, refer_id, trans_type, SUM( admin_dr_amt ) AS DEBIT_AMT, SUM( admin_cr_amt ) AS CREDIT_AMT FROM admin_ledger GROUP BY refer_id");
        return $query;
    }

    function retrieve_admn_ledger_data_btndates() {
        $date_strng = $this->uri->segment(4);
        $date_arr = explode('&', $date_strng);
        $form_dt = $date_arr[0];
        $to_dt = $date_arr[1];
        $query = $this->db->query("SELECT trans_date, seller_id, refer_id, trans_type, SUM( admin_dr_amt ) AS DEBIT_AMT, SUM( admin_cr_amt ) AS CREDIT_AMT FROM admin_ledger WHERE trans_date BETWEEN '$form_dt' AND '$to_dt' GROUP BY refer_id");
        return $query;
    }

    function update_wallet_debit() {
        date_default_timezone_set('Asia/Calcutta');
        $cdate = date('y-m-d H:i:s');
        $user_idarr = $this->input->post('check_userid');
        $crdr_amtarr = $this->input->post('check_drcramt');

        $ctr_uer = count($user_idarr);

        for ($i = 0; $i < $ctr_uer; $i++) {
            //foreach start
            $query = $this->db->query("select * from wallet_info where user_id='$user_idarr[$i]' ");
            $row_wl = $query->result();

            if ($crdr_amtarr[$i] == '') {
                $crdr_amtarr[$i] = 0;
            }

            $updated_waletamt = $row_wl[0]->wallet_balance - $crdr_amtarr[$i];

            $this->db->query("update wallet_info set wallet_balance='$updated_waletamt' where user_id='$user_idarr[$i]' ");

            $data_walet = array(
                'user_id' => $user_idarr[$i],
                'debit_amt' => $crdr_amtarr[$i],
                'drcr_date' => $cdate
            );

            $this->db->insert('wallet_crdr', $data_walet);
        }//foreach end
    }

    function search_buyer_name() {
        $user_nm = trim($this->input->post('buyer_nam'));

        $qr = $this->db->query("SELECT * FROM user WHERE fname LIKE '%$user_nm%' or lname LIKE '%$user_nm%' ");

        return $qr;
    }

    function update_wallet_credit() {


        date_default_timezone_set('Asia/Calcutta');
        $cdate = date('y-m-d H:i:s');
        $user_idarr = $this->input->post('check_userid');
        $crdr_amtarr = $this->input->post('check_drcramt');

        $ctr_uer = count($user_idarr);

        for ($i = 0; $i < $ctr_uer; $i++) {
            //foreach start

            $query = $this->db->query("select * from wallet_info where user_id='$user_idarr[$i]' ");
            $row_wl = $query->result();

            if (count($row_wl) != 0) {
                if ($crdr_amtarr[$i] == '') {
                    $crdr_amtarr[$i] = 0;
                }

                $updated_waletamt = $row_wl[0]->wallet_balance + $crdr_amtarr[$i];

                $this->db->query("update wallet_info set wallet_balance='$updated_waletamt' where user_id='$user_idarr[$i]' ");
            } else {
                $data_newalletinfo = array(
                    'user_id' => $user_idarr[$i],
                    'wallet_balance' => $crdr_amtarr[$i],
                );

                $this->db->insert('wallet_info', $data_newalletinfo);
            }


            $data_walet = array(
                'user_id' => $user_idarr[$i],
                'credit_amt' => $crdr_amtarr[$i],
                'drcr_date' => $cdate
            );

            $this->db->insert('wallet_crdr', $data_walet);
        }//foreach end
    }

    function update_inn_new_sku() {
        $old_sku = $this->input->post('osku');
        $new_sku = $this->input->post('nsku');
        $data = array('sku' => $new_sku);
        $this->db->where('sku', $old_sku);
        $this->db->update('seller_product_general_info', $data);
        if ($this->db->affected_rows() > 0) {
            $this->db->where('sku', $old_sku);
            $this->db->update('product_master', $data);
            if ($this->db->affected_rows() > 0) {
                $this->db->where('sku', $old_sku);
                $this->db->update('seller_product_attribute_value', $data);

                $this->db->where('sku', $old_sku);
                $this->db->update('product_attribute_value', $data);

                $this->db->where('sku', $old_sku);
                $this->db->update('seller_product_master', $data);
                return true;
            }
        }
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created:04/10/2018
     */
    public function generate_payout($trans_ids) {

        $this->db->trans_begin();
        $this->_update_ledger($trans_ids);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created: 07/10/2018
     */
    private function _update_ledger($trans_ids) {

        $sale_ledger = $return_ledger = $in_trans_data = array();
        $sale_ledger_flag = false;
        $return_ledger_flag = false;
        $in_trans_data_flag = false;

        if ($trans_ids) {
            $trans_id_condition = " AND t.id in(" . "'" . implode("','", $trans_ids) . "')";
        }
        $query = "
                SELECT * FROM(
                    SELECT t.*,sai.business_name,oi.date_of_order,oi.order_status,oi.cancelled_by,oi.order_status_modified_date 
                    FROM transaction t
                    LEFT JOIN seller_account_information sai ON sai.seller_id = t.seller_id
                    LEFT JOIN(
                        SELECT * FROM order_info WHERE lower(order_status) in('delivered','return requested')                    
                    )oi ON oi.order_id=t.order_no
                    WHERE t.payout_gen_status='no'
                    AND oi.order_status_modified_date <= CURDATE() - INTERVAL 3 DAY  
                    $trans_id_condition
                UNION ALL
                    SELECT t.*,sai.business_name,oi.date_of_order,oi.order_status,oi.cancelled_by,oi.order_status_modified_date 
                        FROM transaction t
                        LEFT JOIN seller_account_information sai ON sai.seller_id = t.seller_id
                        LEFT JOIN(
                            SELECT * FROM order_info WHERE lower(order_status) in('undelivered')
                            UNION ALL
                            SELECT * FROM order_info WHERE lower(order_status)='cancelled' AND lower(cancelled_by) in('admin','seller')
                        )oi ON oi.order_id=t.order_no
                        WHERE t.payout_gen_status='no'
                        AND oi.order_status_modified_date <= CURDATE() - INTERVAL 1 DAY  
                        $trans_id_condition
                )a    
                ORDER BY a.id DESC";

        $result = $this->db->query($query)->result_array();

        foreach ($result as $key => $record) {

            $sale_ledger_flag = true;
            //calculate salse ledger data
            $total_deduct_amt = $record['fixed_chgs'] + $record['season_chgs'] + $record['pg_chgs'] + $record['commission'] + $record['service_tax'] + $record['penalty'];

            if ($record['discount'] != 0) {
                $discount_amt = $record['discount'];
                //$final_deduct_amt = $total_deduct_amt-$discount_amt;
                $settlement_value = $record['sale_value'] - $total_deduct_amt;
                $settlement_value = $settlement_value + $discount_amt;

                //for in trans calculation
                $in_trans_settlement_val = $record['sale_value'] - $total_deduct_amt;
                $in_trans_final_settlement_value = $in_trans_settlement_val + $discount_amt;
            } else {
                $settlement_value = $record['sale_value'] - $total_deduct_amt;
                $in_trans_final_settlement_value = $in_trans_settlement_val = $settlement_value;
            }

            //prepare sales ledger array
            $sale_ledger[$key] = array(
                'trans_date' => $record['date_of_order'],
                'seller_id' => $record['seller_id'],
                'refer_id' => $record['order_no'],
                'trans_type' => 'Sales',
                'slr_dr_amt' => $total_deduct_amt,
                'slr_cr_amt' => $settlement_value
            );
            $admin_sale_ledger[$key] = array(
                'trans_date' => $record['date_of_order'],
                'seller_id' => $record['seller_id'],
                'refer_id' => $record['order_no'],
                'trans_type' => 'Sales',
                'admin_dr_amt' => $total_deduct_amt,
                'admin_cr_amt' => $settlement_value
            );

            //prepare return ledger data
            $query = "select * from return_product where sku='" . $record['sku'] . "' AND order_id='" . $record['order_no'] . "'";

            $return_result = $this->db->query($query)->result_array();

            if ($return_result) {
                foreach ($return_result as $rkey => $rresult) {
                    $return_ledger_flag = true;
                    //calculate return order values
                    $rtn_total_deduct_amt = $record['fixed_chgs'] + $record['season_chgs'] + $record['pg_chgs'] + $record['commission'] + $record['service_tax'] + $record['penalty'];
                    if ($record['discount'] != 0) {
                        $rtn_discount_amt = $record['discount'];
                        //$final_deduct_amt = $total_deduct_amt-$discount_amt;
                        $rtn_settlement_value = $record['sale_value'] - $rtn_total_deduct_amt;
                        $rtn_settlement_value = $rtn_settlement_value + $rtn_discount_amt;
                    } else {
                        $rtn_settlement_value = $record['sale_value'] - $rtn_total_deduct_amt;
                    }
                    $minus_rtn_slrdramt = 0 - $rtn_total_deduct_amt;
                    $minus_slrcrdamt = 0 - $rtn_settlement_value;

                    //prepare return ledger data array
                    $return_ledger[$rkey] = array(
                        'trans_date' => $record['date_of_order'],
                        'seller_id' => $record['seller_id'],
                        'refer_id' => $rresult['order_id'],
                        'trans_type' => 'Return',
                        'slr_dr_amt' => $minus_rtn_slrdramt,
                        'slr_cr_amt' => $minus_slrcrdamt
                    );
                    $admin_return_ledger[$rkey] = array(
                        'trans_date' => $record['date_of_order'],
                        'seller_id' => $record['seller_id'],
                        'refer_id' => $rresult['order_id'],
                        'trans_type' => 'Return',
                        'admin_dr_amt' => $minus_rtn_slrdramt,
                        'admin_cr_amt' => $minus_slrcrdamt
                    );
                }
            }

            //capture to update in transtion data
            $in_trans_data_flag = true;
            $cdate = date('Y-m-d');
            $in_trans_data[$key] = array(
                'id' => $record['id'],
                'discount' => $record['discount'],
                'settl_amt' => $in_trans_settlement_val,
                'fnal_settl_amt' => $in_trans_final_settlement_value,
                'pyt_genrted_dt' => $cdate,
            );
        }//end loop
        //save records
        if ($sale_ledger_flag) {
            $this->db->insert_batch('seller_ledger', $sale_ledger);
            $this->db->insert_batch('admin_ledger', $admin_sale_ledger);
        }

        if ($return_ledger_flag) {
            $this->db->insert_batch('seller_ledger', $return_ledger);
            $this->db->insert_batch('admin_ledger', $admin_return_ledger);
        }
        //update in trans data
        if ($in_trans_data_flag) {
            $this->db->update_batch('transaction', $in_trans_data, 'id');
            $this->_insert_seller_payout_details($trans_ids);
            if (count($trans_ids) > 0) {
                $this->db->where_in('id', $trans_ids);
                $this->db->update('transaction', array('payout_gen_status' => 'yes'));
            }
        }
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author : HimansuS
     * @created: 07/10/2018
     */
    private function _insert_seller_payout_details($trans_ids) {
        $this->load->model('Usermodel');
        date_default_timezone_set('Asia/Calcutta');
        $rand_id = preg_replace("/[^0-9]+/", "", date('Y-m-d H:i:s'));
        $cdate = date('Y-m-d');

        $query = "SELECT id,seller_id,COUNT(seller_id) AS NO_OF_ORDERS, SUM(fnal_settl_amt) AS TOTAL_FNL_STL_AMT 
                FROM transaction 
                WHERE id IN (" . implode(',', $trans_ids) . ") 
                GROUP BY seller_id";
        $result = $this->db->query($query)->result_array();

        foreach ($result as $rows) {
            $final_array = array();
            //getting seller_payout table max id//			
            $max_id = $this->Usermodel->get_unique_id('seller_payout', 'id');
            $settlment_ref_no = $rand_id . $max_id;

            //program start for retrieve id from transaction table//
            $query = "SELECT id FROM transaction WHERE seller_id='" . $rows['seller_id'] . "'";
            $res = $this->db->query($query)->result_array();

            foreach ($res as $row) {
                //$trsn_id_arr[] = $row->id;
                if (in_array($row['id'], $trans_ids)) {
                    $final_array[] = $row['id'];
                }
            }
            $trsn_id = implode(',', $final_array);

            //program end of retrieve id from transaction table//
            $data = array(
                'seller_id' => $rows['seller_id'],
                'no_of_orders' => $rows['NO_OF_ORDERS'],
                'settlmnt_refno' => $settlment_ref_no,
                'transaction_ids' => $trsn_id,
                'fnl_stl_amt' => $rows['TOTAL_FNL_STL_AMT'],
                'pyt_generated_dt' => $cdate
            );

            //fetch seller bank details
            $query = "SELECT ac_number,bank,ifsc_code,ac_holder_name 
                    FROM seller_account_information 
                    WHERE seller_id='" . $rows['seller_id'] . "'";

            $seller_bank_det = $this->db->query($query)->result_array();
            if ($seller_bank_det && isset($seller_bank_det[0])) {
                $seller_bank_det = $seller_bank_det[0];
                $data['bnk_acnt_no'] = $seller_bank_det['ac_number'];
                $data['bnk_name'] = $seller_bank_det['bank'];
                $data['bnk_ifsc_code'] = $seller_bank_det['ifsc_code'];
                $data['acnt_hldr_name'] = $seller_bank_det['ac_holder_name'];
            }
            $this->db->insert('seller_payout', $data);
        }
    }

}

?>