<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model {

    function getStetmentData() {
        $seller_id = $this->session->userdata('seller-session');
        /* $query = $this->db->query("SELECT SUM(sub_total_amount) as sale_mount
          FROM ordered_product_from_addtocart
          WHERE seller_id ='$seller_id' AND product_order_status IN ('Delivered', 'Shipped', 'Return Requested', 'Return Received')"); */

        $query = $this->db->query("SELECT * FROM seller_payout WHERE seller_id='$seller_id' ORDER BY id DESC LIMIT 1");
        if ($query->num_rows() > 0) {
            $result = $query->result();
            $trans_ids = $result[0]->transaction_ids;

            $trans_qr = $this->db->query("SELECT seller_id,COUNT(seller_id) AS NO_OF_ORDERS,SUM(sale_value) AS TOTAL_SALE_AMT,SUM(discount) AS TOTAL_DISCOUNT_AMT,SUM(commission) AS TOTAL_COMMISION,SUM(fixed_chgs) AS TOTAL_FIXED_FEE,SUM(season_chgs) AS TOTAL_SEASON_FEE, SUM(pg_chgs) AS TOTAL_PG_FEE, SUM(service_tax) AS TOTAL_SERVC_TAX, SUM(fnal_settl_amt) AS TOTAL_FNL_STL_AMT FROM transaction WHERE id IN ($trans_ids) GROUP BY seller_id");
            if ($trans_qr->num_rows() > 0) {
                $trans_res = $trans_qr->result();
                return $trans_res;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getIndvisualStetmentData($ref_no) {
        $sql = $this->db->query("SELECT transaction_ids FROM seller_payout WHERE settlmnt_refno='$ref_no'");
        $res = $sql->result();
        $trans_ids = $res[0]->transaction_ids;

        $query = $this->db->query("SELECT seller_id,COUNT(seller_id) AS NO_OF_ORDERS,SUM(sale_value) AS TOTAL_SALE_AMT,SUM(discount) AS TOTAL_DISCOUNT_AMT,SUM(commission) AS TOTAL_COMMISION,SUM(fixed_chgs) AS TOTAL_FIXED_FEE,SUM(season_chgs) AS TOTAL_SEASON_FEE, SUM(pg_chgs) AS TOTAL_PG_FEE, SUM(service_tax) AS TOTAL_SERVC_TAX, SUM(fnal_settl_amt) AS TOTAL_FNL_STL_AMT FROM transaction WHERE id IN ($trans_ids) GROUP BY seller_id");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getStetmentData_inndaterange() {
        $seller_id = $this->session->userdata('seller-session');
        $status = $this->uri->segment(4);
        $date_range_arr = explode('&', $this->uri->segment(5));
        $from_date = $date_range_arr[0];
        $to_date = $date_range_arr[1];
        if ($status == 'All') {
            $sql = $this->db->query("SELECT transaction_ids FROM seller_payout WHERE pyt_generated_dt>='$from_date' AND pyt_generated_dt<='$to_date' AND seller_id='$seller_id'");
        } else {
            $sql = $this->db->query("SELECT transaction_ids FROM seller_payout WHERE pyt_generated_dt>='$from_date' AND pyt_generated_dt<='$to_date' AND seller_id='$seller_id' AND status='$status'");
        }
        if ($sql->num_rows() > 0) {
            $res = $sql->result();
            foreach ($res as $row) {
                $trans_id_arr[] = $row->transaction_ids;
            }
            $trans_ids = implode(',', $trans_id_arr);

            $query = $this->db->query("SELECT seller_id,COUNT(seller_id) AS NO_OF_ORDERS,SUM(sale_value) AS TOTAL_SALE_AMT,SUM(discount) AS TOTAL_DISCOUNT_AMT,SUM(commission) AS TOTAL_COMMISION,SUM(fixed_chgs) AS TOTAL_FIXED_FEE,SUM(season_chgs) AS TOTAL_SEASON_FEE, SUM(pg_chgs) AS TOTAL_PG_FEE, SUM(service_tax) AS TOTAL_SERVC_TAX, SUM(fnal_settl_amt) AS TOTAL_FNL_STL_AMT FROM transaction WHERE id IN ($trans_ids) GROUP BY seller_id");
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getStatementDetailsByDate() {
        $ac_type = $this->input->post('ac_type');
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        echo $ac_type . ' ' . $from_date . ' ' . $to_date;
        exit;
    }

    function getStatementDetailsByUTR() {
        $UTR = $this->input->post('utr');
        echo $UTR;
        exit;
    }

    function retrieve_slr_payoutdata() {
        $seller_id = $this->session->userdata('seller-session');
        $query = $this->db->query("SELECT * FROM seller_payout WHERE seller_id='$seller_id'");
        return $query;
    }

    function retrieve_slr_ledger_data() {
        $seller_id = $this->session->userdata('seller-session');
        //$query = $this->db->query("SELECT * FROM seller_ledger WHERE seller_id='$seller_id'");
        $query = $this->db->query("SELECT trans_date, seller_id, refer_id, trans_type, SUM( slr_dr_amt ) AS DEBIT_AMT, SUM( slr_cr_amt ) AS CREDIT_AMT
FROM  `seller_ledger` 
WHERE seller_id='$seller_id' GROUP BY refer_id");
        return $query;
    }

    function retrieve_slr_ledger_data_btndates() {
        $seller_id = $this->session->userdata('seller-session');
        $date_strng = $this->uri->segment(4);
        $date_arr = explode('&', $date_strng);
        $form_dt = $date_arr[0];
        $to_dt = $date_arr[1];
        //$query = $this->db->query("SELECT * FROM seller_ledger WHERE trans_date BETWEEN '$form_dt' AND '$to_dt' AND seller_id='$seller_id'");
        $query = $this->db->query("SELECT trans_date, seller_id, refer_id, trans_type, SUM( slr_dr_amt ) AS DEBIT_AMT, SUM( slr_cr_amt ) AS CREDIT_AMT FROM seller_ledger WHERE trans_date BETWEEN '$form_dt' AND '$to_dt' AND seller_id='$seller_id' GROUP BY refer_id");
        return $query;
    }

    function getTransactionDetails() {
        $seller_id = $this->session->userdata('seller-session');
        $query = $this->db->query("SELECT a.order_id, a.sku, a.product_order_status, c.date_of_order, a.sub_total_amount, d.fnal_settl_amt, d.pyt_genrted_dt, d.payout_gen_status
FROM ordered_product_from_addtocart a
INNER JOIN order_info c ON a.order_id = c.order_id
INNER JOIN transaction d ON ( a.sku = d.sku
AND a.order_id = d.order_no )
WHERE a.seller_id =  '$seller_id'
AND d.payout_gen_status =  'yes'
AND a.product_order_status
IN (
 'Shipped', 'Delivered', 'Return Requested', 'Return Received'
)");
        $row = $query->num_rows();
        if ($row > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getTransactionDetails_daterange() {
        $seller_id = $this->session->userdata('seller-session');
        $date_encode_strng = $this->uri->segment(4);
        $date_encode_arr = explode('&', $date_encode_strng);
        $from_date = base64_decode($date_encode_arr[0]);
        $to = base64_decode($date_encode_arr[1]);
        $query = $this->db->query("SELECT a.order_id, a.sku, a.product_order_status, c.date_of_order, a.sub_total_amount, d.fnal_settl_amt, d.pyt_genrted_dt, d.payout_gen_status
FROM ordered_product_from_addtocart a
INNER JOIN order_info c ON a.order_id = c.order_id
INNER JOIN transaction d ON ( a.sku = d.sku
AND a.order_id = d.order_no )
WHERE a.seller_id =  '$seller_id'
AND d.payout_gen_status =  'yes'
AND a.product_order_status
IN (
 'Shipped',  'Delivered',  'Return Requested',  'Return Received'
) AND d.pyt_genrted_dt BETWEEN '$from_date' AND '$to'");
        $row = $query->num_rows();
        if ($row > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getUnsetteledTransactionDetails() {
        $seller_id = $this->session->userdata('seller-session');
        $query = $this->db->query("SELECT a.order_id, a.sku, a.product_order_status, c.date_of_order,c.order_status_modified_date ,a.sub_total_amount, d.settl_amt + d.discount AS FINAL_SETTELED_AMT, d.pyt_genrted_dt, d.payout_gen_status
FROM ordered_product_from_addtocart a
INNER JOIN order_info c ON a.order_id = c.order_id
INNER JOIN transaction d ON ( a.sku = d.sku
AND a.order_id = d.order_no ) 
WHERE a.seller_id =  '$seller_id'
AND d.payout_gen_status =  'no'
AND a.product_order_status
IN (
 'Shipped', 'Delivered', 'Return Requested', 'Return Received'
)");
        $row = $query->num_rows();
        if ($row > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getUnsetteledTransactionDetails_daterange() {
        $seller_id = $this->session->userdata('seller-session');
        $date_encode_strng = $this->uri->segment(4);
        $date_encode_arr = explode('&', $date_encode_strng);
        $from_date = base64_decode($date_encode_arr[0]);
        $to = base64_decode($date_encode_arr[1]);
        $from_date1 = date('Y-m-d', strtotime($from_date . ' - 3 days'));
        $to1 = date('Y-m-d', strtotime($to . ' - 3 days'));

        $query = $this->db->query("SELECT a.order_id, a.sku, a.product_order_status, c.date_of_order,c.order_status_modified_date ,a.sub_total_amount,d.settl_amt + d.discount AS FINAL_SETTELED_AMT, d.pyt_genrted_dt, d.payout_gen_status
FROM ordered_product_from_addtocart a
INNER JOIN order_info c ON a.order_id = c.order_id
INNER JOIN transaction d ON ( a.sku = d.sku
AND a.order_id = d.order_no ) 
WHERE a.seller_id =  '$seller_id'
AND d.payout_gen_status =  'no'
AND a.product_order_status
IN (
 'Shipped', 'Delivered', 'Return Requested', 'Return Received'
) AND c.order_status_modified_date BETWEEN '$from_date1' AND '$to1'");
        $row = $query->num_rows();
        if ($row > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function retrieve_slr_wise_payout($settlment_ref_no) {
        $query = $this->db->query("SELECT transaction_ids FROM seller_payout WHERE settlmnt_refno='$settlment_ref_no'");
        $result = $query->row();
        $transtion_id = $result->transaction_ids;

        $query1 = $this->db->query("SELECT * FROM transaction WHERE id IN ($transtion_id)");
        if ($query1->num_rows() > 0) {
            return $query1->result();
        } else {
            return false;
        }
    }

}
