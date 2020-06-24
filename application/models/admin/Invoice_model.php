<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_model extends CI_Model {

    function select_invoices() {
        $query = $this->db->query("select a.order_id, a.order_status, a.sub_total_amount, a.date_of_order,a.invoice_id,a.invoice_date, c.fname,c.lname from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join user c on b.user_id=c.user_id group by b.order_id ");
        return $query;
    }

    //function order_detail_asper_orderid($order_id)
//	{
//		$query=$this->db->query("select a.order_id from order_info a inner join  ordered_product_from_addtocart b on a.order_id=b.order_id");
//		return $query;
//			
//		
//	}
    //function generate_invoiceid($order_id)
//	{
//		
//		$dt = date('Y-m-d H:i:s');
//		$invoice_id=random_string('alnum',5).'-'.$order_id;
//		$query=$this->db->query("update order_info set invoice_id='$invoice_id', invoice_date='$dt' where order_id='$order_id'  ");
//		
//	}
}
