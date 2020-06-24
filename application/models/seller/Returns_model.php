<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Returns_model extends CI_Model {

    function getReturnRequestedDetails() {
        $seller_id = $this->session->userdata('seller-session');
        $query = $this->db->query("SELECT a.*, b.*, c.mrp, d.name, e.imag, f.date_of_order, f.order_status_modified_date, g.tracking_no
		FROM return_product a
		INNER JOIN ordered_product_from_addtocart b ON (a.order_id=b.order_id AND a.sku=b.sku)
		INNER JOIN product_master c ON (b.product_id = c.product_id AND b.sku = c.sku) 
		INNER JOIN product_general_info d ON c.product_id = d.product_id
		INNER JOIN product_image e ON c.product_id = e.product_id
		INNER JOIN order_info f ON a.order_id = f.order_id
		INNER JOIN shipment_info g ON a.order_id = g.order_id
		WHERE a.seller_id='$seller_id' AND b.product_order_status = 'Return Requested'");
        $row = $query->num_rows();
        if ($row > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getReturnCompletedDetails() {
        $seller_id = $this->session->userdata('seller-session');
        $query = $this->db->query("SELECT a.*, b.*, c.mrp, d.name, e.imag, f.date_of_order, f.order_status_modified_date, g.tracking_no
		FROM return_product a
		INNER JOIN ordered_product_from_addtocart b ON (a.order_id=b.order_id AND a.sku=b.sku)
		INNER JOIN product_master c ON (b.product_id = c.product_id AND b.sku = c.sku) 
		INNER JOIN product_general_info d ON c.product_id = d.product_id
		INNER JOIN product_image e ON c.product_id = e.product_id
		INNER JOIN order_info f ON a.order_id = f.order_id
		INNER JOIN shipment_info g ON a.order_id = g.order_id
		WHERE a.seller_id='$seller_id' AND b.product_order_status = 'Return Received'");
        $row = $query->num_rows();
        if ($row > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function ReturnRequestedDetails() {
        $seller_id = $this->session->userdata('seller-session');
        $return_id = $this->uri->segment(4);
        $query = $this->db->query("SELECT a.*, b.*, c.mrp, d.name, e.imag, f.date_of_order, f.order_status_modified_date, g.tracking_no
		FROM return_product a
		INNER JOIN ordered_product_from_addtocart b ON (a.order_id=b.order_id AND a.sku=b.sku)
		INNER JOIN product_master c ON (b.product_id = c.product_id AND b.sku = c.sku) 
		INNER JOIN product_general_info d ON c.product_id = d.product_id
		INNER JOIN product_image e ON c.product_id = e.product_id
		INNER JOIN order_info f ON a.order_id = f.order_id
		INNER JOIN shipment_info g ON a.order_id = g.order_id
		WHERE a.seller_id='$seller_id' AND a.return_id = '$return_id'");
        $row = $query->num_rows();
        if ($row > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getUpdateReturnStatus($status, $order_ids) {
        
        $date1 = date("Y-m-d H:i:s");
        $count = count($order_ids);
        //print_r($order_ids);exit;
        for ($i = 0; $i < $count; $i++) {
            $query = $this->db->query("UPDATE order_info SET order_status='$status', order_status_modified_date='$date1' WHERE order_id='$order_ids[$i]'");
            $query1 = $this->db->query("UPDATE ordered_product_from_addtocart SET product_order_status='$status' WHERE order_id='$order_ids[$i]'");

            $query2 = $this->db->query("UPDATE return_product SET status='$status' WHERE order_id='$order_ids[$i]'");
        }

        //getting return order id sku
        //$sql = $this->db->query("SELECT sku FROM return_product WHERE order_id IN ()");
        return true;
    }

}
