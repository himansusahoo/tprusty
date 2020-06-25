<?php

class Dashboard extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('rbac/rbac_user');
        $this->load->model('rbac/rbac_role_permission');
    }

    function graph_data_totprdqnt() {
        $query = $this->db->query("select sum(quantity) as total_quant from product_master where seller_id!=0");
        $row = $query->row();
        return $row;
    }

    function get_chart_data() {
        $query_max = $this->db->query("select *, min(delivered_count) as min_dlcount, max(delivered_count) as mx_dlcount from view_sale_performance");
        $results = $query_max->result();
        return $results;
    }

    function get_delivered_ordercount() {
        $query = $this->db->query("SELECT COUNT( product_order_status ) as delv_ordercount FROM ordered_product_from_addtocart WHERE product_order_status =  'Delivered'");
        $row_Delivered = $query->row();
        return $row_Delivered;
    }

    function get_Cancelled_ordercount() {
        $query = $this->db->query("SELECT COUNT( product_order_status ) as cancel_ordercount FROM  ordered_product_from_addtocart WHERE product_order_status =  'Cancelled'");
        $row_Cancelled = $query->row();
        return $row_Cancelled;
    }

    function get_confirmed_ordercount() {
        $query = $this->db->query("SELECT COUNT( product_order_status ) as confirm_ordercount FROM  ordered_product_from_addtocart WHERE product_order_status =  'Order confirmed'or  product_order_status =  'Pending payment' or product_order_status =  'Failed'  ");
        $row_Orderconfirmed = $query->row();
        return $row_Orderconfirmed;
    }

    function get_Undelivered_ordercount() {
        $query = $this->db->query("SELECT COUNT( product_order_status ) as undelivered_ordercount FROM  ordered_product_from_addtocart WHERE product_order_status =  'Undelivered'");
        $row_Undelivered = $query->row();
        return $row_Undelivered;
    }

    function get_return_ordercount() {
        $query = $this->db->query("SELECT COUNT( product_order_status ) as return_ordercount FROM  ordered_product_from_addtocart WHERE product_order_status =  'Return Requested'  OR product_order_status =  'Return Received' ");
        $row_return = $query->row();
        return $row_return;
    }

    function count_orderconfirmed() {
        $query = $this->db->query("SELECT COUNT( order_status ) as confirm_ordered_count FROM  order_info WHERE order_status = 'Order confirmed'  ");
        $row_Orderconfirmed = $query->row();
        return $row_Orderconfirmed;
    }

    function get_seller_sale_weekly() {
        $query="SELECT a.order_status_modified_date, SUM( b.quantity) as sale_qnt , c.business_name
        FROM order_info a
        INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id
        INNER JOIN seller_account_information c ON c.seller_id = b.seller_id
        WHERE a.order_status =  'Delivered'
        GROUP BY b.seller_id";
        $query = $this->db->query($query);
        $row = $query->result();
        return $row;
    }

    function get_moonboy_turnover_monthly() {
        $query = $this->db->query("SELECT YEAR( order_status_modified_date ) AS sale_year, MONTH( order_status_modified_date ) AS sale_month, SUM( Total_amount ) AS sale_amt
		FROM order_info
		WHERE order_status =  'Delivered'
		GROUP BY MONTH( order_status_modified_date )  ");
        $row = $query->result();
        return $row;
    }

}
