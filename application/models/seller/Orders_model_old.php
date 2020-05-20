<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Orders_model extends CI_Model {

    function getNewOrdersDetails() {
        $seller_id = $this->session->userdata('seller-session');
        $query = $this->db->query("SELECT a.order_confirm_for_seller,a.order_confirm_for_seller_date,a.date_of_order,a.order_status,a.request_for_grace_period,a.grace_period_approve_status,a.grace_period,b.quantity,
		b.order_id,b.sku,b.sub_tax_rate,b.sub_shipping_fees,b.sub_total_amount,c.price,d.name,e.imag,g.*,h.state,f.user_id,i.payment_type,k.dispatch_days
		FROM order_info a
		INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id
		INNER JOIN product_master c ON b.sku = c.sku
		INNER JOIN product_general_info d ON c.product_id = d.product_id
		INNER JOIN product_image e ON c.product_id = e.product_id
		INNER JOIN user f ON b.user_id = f.user_id
		INNER JOIN user_address g ON f.address_id = g.address_id
		INNER JOIN state h ON g.state = h.state_id
		INNER JOIN payment_info i on i.payment_mode_id= a.payment_mode 
		INNER JOIN dispatched_day_setting k on k.state_id=h.state_id
		WHERE c.seller_id='$seller_id' AND (a.order_status='Pending payment' OR a.order_status='Processing' OR a.order_status='Failed' OR a.order_status='Order confirmed')
		GROUP BY b.order_id, b.sku ORDER BY a.date_of_order DESC");


        $row = $query->num_rows();
        if ($row > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getNewOrdersDetails_as_order_id() {
        $seller_id = $this->session->userdata('seller-session');
        //$query = $this->db->query("SELECT a.order_confirm_for_seller,a.date_of_order,a.order_status,a.order_accept_by_seller,a.request_for_grace_period,b.quantity,a.invoice_id,
//		a.grace_period_approve_status,a.grace_period,b.order_id,
//		b.sku,b.sub_tax_rate,b.sub_shipping_fees,b.sub_total_amount,c.price,d.name,e.imag,g.*,h.state,f.user_id,i.payment_type,k.dispatch_days
//		FROM order_info a
//		INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id
//		INNER JOIN product_master c ON b.sku = c.sku
//		INNER JOIN product_general_info d ON c.product_id = d.product_id
//		INNER JOIN product_image e ON c.product_id = e.product_id
//		INNER JOIN user f ON b.user_id = f.user_id
//		INNER JOIN user_address g ON f.address_id = g.address_id
//		INNER JOIN state h ON g.state = h.state_id
//		INNER JOIN payment_info i on i.payment_mode_id= a.payment_mode 
//		INNER JOIN dispatched_day_setting k on k.state_id=h.state_id
//		WHERE c.seller_id='$seller_id' AND (a.order_status='Pending payment' OR a.order_status='Processing' OR a.order_status='Failed' OR a.order_status='Order confirmed' OR a.order_status='Ready to shipped')
//		GROUP BY b.order_id ORDER BY a.date_of_order DESC");

        $query = $this->db->query("SELECT a.order_confirm_for_seller_date,k.dispatch_days,a.order_id,a.order_confirm_for_seller,a.order_status,a.order_accept_by_seller,
		a.invoice_id,a.request_for_grace_period,a.grace_period_approve_status
FROM order_info a
INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id
INNER JOIN product_master c ON b.sku = c.sku
INNER JOIN user f ON b.user_id = f.user_id
INNER JOIN user_address g ON f.address_id = g.address_id
INNER JOIN state h ON g.state = h.state_id
INNER JOIN dispatched_day_setting k on k.state_id=h.state_id
WHERE c.seller_id='$seller_id' AND (a.order_status='Order confirmed' OR a.order_status='Ready to shipped' AND a.order_confirm_for_seller='Approved')

GROUP BY b.order_id, b.sku ORDER BY a.date_of_order DESC");


        $row = $query->num_rows();
        if ($row > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getOrdersByOrderID($order_id) {
        $seller_id = $this->session->userdata('seller-session');
        $query = $this->db->query("SELECT a.date_of_order,a.order_status,b.order_id,b.sku,c.price,d.name,e.imag,g.*,h.state,f.user_id
		FROM order_info a
		INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id
		INNER JOIN product_master c ON b.sku = c.sku
		INNER JOIN product_general_info d ON c.product_id = d.product_id
		INNER JOIN product_image e ON c.product_id = e.product_id
		INNER JOIN user f ON b.user_id = f.user_id
		INNER JOIN user_address g ON b.user_id = g.user_id
		INNER JOIN state h ON g.state = h.state_id
		WHERE a.order_id='$order_id' AND c.seller_id='$seller_id'
		GROUP BY b.order_id, b.sku ORDER BY a.date_of_order DESC");

        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    function getUpdateOrderStatus($status, $order_ids) {
        $count = count($order_ids);
        for ($i = 0; $i < $count; $i++) {
            $query = $this->db->query("UPDATE order_info SET order_status='$status' WHERE order_id='$order_ids[$i]'");
            $query1 = $this->db->query("UPDATE ordered_product_from_addtocart SET product_order_status='$status' WHERE order_id='$order_ids[$i]'");
        }

        return true;
    }

    function getTransitOrdersDetails() {
        $seller_id = $this->session->userdata('seller-session');
        $query = $this->db->query("SELECT a.date_of_order,a.order_status,a.order_confirm_for_seller_date,a.order_id_payment_gateway,a.order_status_modified_date,b.order_id,b.sku,b.sub_total_amount,b.sub_shipping_fees,c.price,b.quantity,c.shipping_fee_amount,d.name,e.imag,g.*,h.state,f.user_id, i.tracking_no,j.payment_type,k.dispatch_days FROM order_info a
		INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id
		INNER JOIN product_master c ON b.sku = c.sku
		INNER JOIN product_general_info d ON c.product_id = d.product_id
		INNER JOIN product_image e ON c.product_id = e.product_id
		INNER JOIN user f ON b.user_id = f.user_id
		INNER JOIN user_address g ON f.address_id = g.address_id
		INNER JOIN state h ON g.state = h.state_id
		INNER JOIN shipment_info i ON a.order_id = i.order_id
		INNER JOIN payment_info j on j.payment_mode_id= a.payment_mode
		INNER JOIN dispatched_day_setting k on k.state_id=h.state_id
		WHERE c.seller_id='$seller_id' AND (a.order_status='Shipped')
		GROUP BY b.order_id, b.sku ORDER BY a.date_of_order DESC");
        $row = $query->num_rows();
        if ($row > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getDelieveredOrderDetails() {
        $seller_id = $this->session->userdata('seller-session');
        $query = $this->db->query("SELECT a.date_of_order,a.order_status,a.order_status_modified_date,b.order_id,a.order_id_payment_gateway,b.quantity,b.sub_total_amount,b.sub_shipping_fees,b.sku,c.shipping_fee_amount,c.price,d.name,e.imag,g.*,h.state,f.user_id,i.payment_type
		FROM order_info a
		INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id
		INNER JOIN product_master c ON b.sku = c.sku
		INNER JOIN product_general_info d ON c.product_id = d.product_id
		INNER JOIN product_image e ON c.product_id = e.product_id
		INNER JOIN user f ON b.user_id = f.user_id
		INNER JOIN user_address g ON f.address_id = g.address_id
		INNER JOIN state h ON g.state = h.state_id
		INNER JOIN payment_info i ON a.payment_mode = i.payment_mode_id
		WHERE c.seller_id='$seller_id' AND a.order_status='Delivered'
		GROUP BY b.order_id, b.sku ORDER BY a.date_of_order DESC");
        $row = $query->num_rows();
        if ($row > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getCancelOrderDetails() {
        $seller_id = $this->session->userdata('seller-session');
        $query = $this->db->query("SELECT a.order_confirm_for_seller, a.order_confirm_for_seller_date, a.date_of_order,
		a.order_status, a.order_status_modified_date, b.quantity, b.order_id, b.sku, b.sub_tax_rate, b.sub_shipping_fees,
		b.sub_total_amount, c.price, d.name, e.imag, g.*, h.state, f.user_id, i.payment_type, j.reason
		FROM order_info a
		INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id
		INNER JOIN product_master c ON b.sku = c.sku
		INNER JOIN product_general_info d ON c.product_id = d.product_id
		INNER JOIN product_image e ON c.product_id = e.product_id
		INNER JOIN user f ON b.user_id = f.user_id
		INNER JOIN user_address g ON f.address_id = g.address_id
		INNER JOIN state h ON g.state = h.state_id
		INNER JOIN payment_info i ON i.payment_mode_id = a.payment_mode
		INNER JOIN cancel_product j ON (b.order_id = j.order_id AND b.sku = j.sku) 
		WHERE c.seller_id ='$seller_id' AND a.order_status = 'Cancelled'
		GROUP BY b.order_id, b.sku
		ORDER BY a.date_of_order DESC");
        $row = $query->num_rows();
        if ($row > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function penalty_data_insert() {

        $seller_id = $this->session->userdata('seller-session');
        //$query = $this->db->query("SELECT a.order_confirm_for_seller,a.date_of_order,a.order_status,b.quantity,a.invoice_id,b.order_id,
//		b.sku,b.sub_tax_rate,b.sub_shipping_fees,b.sub_total_amount,c.price,d.name,e.imag,g.*,h.state,f.user_id,i.payment_type,k.dispatch_days
//		FROM order_info a
//		INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id
//		INNER JOIN product_master c ON b.sku = c.sku
//		INNER JOIN product_general_info d ON c.product_id = d.product_id
//		INNER JOIN product_image e ON c.product_id = e.product_id
//		INNER JOIN user f ON b.user_id = f.user_id
//		INNER JOIN user_address g ON f.address_id = g.address_id
//		INNER JOIN state h ON g.state = h.state_id
//		INNER JOIN payment_info i on i.payment_mode_id= a.payment_mode 
//		INNER JOIN dispatched_day_setting k on k.state_id=h.state_id
//		WHERE c.seller_id='$seller_id' AND (a.order_status='Pending payment' OR a.order_status='Processing' OR a.order_status='Failed' OR a.order_status='Order confirmed' OR a.order_status='Ready to shipped')
//		GROUP BY b.order_id ORDER BY a.date_of_order DESC");
//		$row = $query->num_rows();
//		
//		//inner data for order start
//		if($row > 0){
//			
//			$new_orders_as_per_orderid=$query->result();
//			
//			foreach($new_orders_as_per_orderid as $row_as_orderid) { 
//										$seller_id = $this->session->userdata('seller-session');

        $qrs = $this->db->query("SELECT a.order_confirm_for_seller,a.order_confirm_for_seller_date,a.order_id_payment_gateway, a.date_of_order,a.order_status,a.Total_amount,b.quantity,b.order_id,b.sku,b.sub_tax_rate,b.sub_shipping_fees,b.sub_total_amount,c.price,d.name,e.imag,g.*,h.state,f.user_id,i.payment_type,k.dispatch_days
										FROM order_info a
										INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id
										INNER JOIN product_master c ON b.sku = c.sku
										INNER JOIN product_general_info d ON c.product_id = d.product_id
										INNER JOIN product_image e ON c.product_id = e.product_id
										INNER JOIN user f ON b.user_id = f.user_id
										INNER JOIN user_address g ON f.address_id = g.address_id
										INNER JOIN state h ON g.state = h.state_id
										INNER JOIN payment_info i on i.payment_mode_id= a.payment_mode 
										INNER JOIN dispatched_day_setting k on k.state_id=h.state_id
										WHERE  c.seller_id='$seller_id' AND (a.order_status='Pending payment' OR a.order_status='Processing' OR a.order_status='Failed' OR a.order_status='Order confirmed' OR a.order_status='Ready to shipped')
										GROUP BY b.order_id, b.sku ORDER BY a.date_of_order DESC");

        $row_as_product = $qrs->result();

        date_default_timezone_set('Asia/Calcutta');

        $date1 = date('y-m-d h:i:s');

        $day_after_3days = date('y-m-d h:i:s', strtotime($row_as_product[0]->order_confirm_for_seller_date . '+' . $row_as_product[0]->dispatch_days . 'day'));
        $order_ids = $row_as_product[0]->order_id;
        //shipment delay penalty start
        if ($date1 > $day_after_3days) {


            $query_select_penaltydata = $this->db->query("select * from penalty_seller_order where order_id='$order_ids' ");

            if ($query_select_penaltydata->num_rows() == 0) {
                $query_select_charges = $this->db->query("select * from charges_master where id=7 and cat_id=5 and charges_type='Order Shipping Delay'  ");

                $row_select_charges = $query_select_charges->row();

                $penalty_charge = ($row_as_product[0]->Total_amount / 100) * $row_select_charges->percent;

                $data_penalty = array(
                    'order_id' => $order_ids,
                    'seller_id' => $seller_id,
                    'penalty_type_id' => $row_select_charges->cat_id,
                    'penalty_charges' => $penalty_charge,
                    'penalty_date' => $date1,
                    'ordered_amount' => $row_as_product[0]->Total_amount,
                    'penalty_pecentages' => $row_select_charges->percent
                );

                $this->db->insert('penalty_seller_order', $data_penalty);
            }
        }
        //shipment delay penalty end
        //cancel order penalty start
        if ($date1 <= $day_after_3days && $row_as_product[0]->order_status == 'Cancelled') {


            $query_select_penaltydata = $this->db->query("select * from penalty_seller_order where order_id='$order_ids' ");

            if ($query_select_penaltydata->num_rows() == 0) {
                $query_select_charges = $this->db->query("select * from charges_master where id=5 and cat_id=3 and charges_type='Order Cancel Penalty'  ");

                $row_select_charges = $query_select_charges->row();

                $penalty_charge = ($row_as_product[0]->Total_amount / 100) * $row_select_charges->percent;

                $data_penalty = array(
                    'order_id' => $order_ids,
                    'seller_id' => $seller_id,
                    'penalty_type_id' => $row_select_charges->cat_id,
                    'penalty_charges' => $penalty_charge,
                    'penalty_date' => $date1,
                    'ordered_amount' => $row_as_product[0]->Total_amount,
                    'penalty_pecentages' => $row_select_charges->percent
                );

                $this->db->insert('penalty_seller_order', $data_penalty);
            }
        }
        //cancel order penalty end	
        //Order not process penalty start

        $order_process_days = $row_as_product[0]->dispatch_days - 2;

        $day_after_3days = date('y-m-d h:i:s', strtotime($row_as_product[0]->order_confirm_for_seller_date . '+' . $order_process_days . 'day'));

        if ($date1 <= $day_after_3days && $row_as_product[0]->order_status != 'Ready to shipped' && $row_as_product[0]->order_confirm_for_seller_date != '0000-00-00 00:00:00') {


            $query_select_penaltydata = $this->db->query("select * from penalty_seller_order where order_id='$order_ids' ");

            if ($query_select_penaltydata->num_rows() == 0) {
                $query_select_charges = $this->db->query("select * from charges_master where id=6 and cat_id=4 and charges_type='Order Not Process'  ");

                $row_select_charges = $query_select_charges->row();

                $penalty_charge = ($row_as_product[0]->Total_amount / 100) * $row_select_charges->percent;

                $data_penalty = array(
                    'order_id' => $order_ids,
                    'seller_id' => $seller_id,
                    'penalty_type_id' => $row_select_charges->cat_id,
                    'penalty_charges' => $penalty_charge,
                    'penalty_date' => $date1,
                    'ordered_amount' => $row_as_product[0]->Total_amount,
                    'penalty_pecentages' => $row_select_charges->percent
                );

                $this->db->insert('penalty_seller_order', $data_penalty);
            }
        }
        //Order not process penalty end
        //}
        //} //inner data for order end
    }

    function order_accept_update($order_id) {

        $this->db->query("update order_info set order_accept_by_seller='Accepted' where order_id='$order_id'");

        $this->db->query("update ordered_product_from_addtocart set order_accept_by_seller='Accepted' where order_id='$order_id'");
        //return true;	
    }

    function getcourier_Details() {
        $query_courierinfo = $this->db->query("select * from courier_info");
        return $query_courierinfo;
    }

    function insert_courier_name() {

        $courier_name = $this->input->post('courier_nm');
        $courier_url = $this->input->post('cour_url');

        $data = array(
            'courier_name' => $courier_name,
            'courier_url' => $courier_url
        );

        $insert_result = $this->db->insert('courier_info', $data);
        return $insert_result;
    }

    function count_graceperiod_orderidsAs_sellerid() {
        $arr_orderId = array();

        $seller_id = $this->session->userdata('seller-session');
        $query = $this->db->query("SELECT a.order_confirm_for_seller,a.order_confirm_for_seller_date, a.date_of_order,
		a.order_status,b.quantity,b.order_id,b.sku,b.sub_tax_rate,b.sub_shipping_fees,b.sub_total_amount,c.price,d.name,
		e.imag,g.*,h.state,f.user_id,i.payment_type,k.dispatch_days
		FROM order_info a
		INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id
		INNER JOIN product_master c ON b.sku = c.sku
		INNER JOIN product_general_info d ON c.product_id = d.product_id
		INNER JOIN product_image e ON c.product_id = e.product_id
		INNER JOIN user f ON b.user_id = f.user_id
		INNER JOIN user_address g ON f.address_id = g.address_id
		INNER JOIN state h ON g.state = h.state_id
		INNER JOIN payment_info i on i.payment_mode_id= a.payment_mode 
		INNER JOIN dispatched_day_setting k on k.state_id=h.state_id
		WHERE c.seller_id='$seller_id' AND (a.order_status='Pending payment' OR a.order_status='Processing' OR a.order_status='Failed' OR a.order_status='Order confirmed')
		GROUP BY b.order_id, b.sku ORDER BY a.date_of_order DESC");
        $row = $query->num_rows();

        $new_orders_as_per_orderid = $query->result();


        if ($new_orders_as_per_orderid) {
            foreach ($new_orders_as_per_orderid as $row_as_orderid) {
                $seller_id = $this->session->userdata('seller-session');
                $qrs = $this->db->query("SELECT a.order_confirm_for_seller,a.order_confirm_for_seller_date,a.order_id_payment_gateway, a.date_of_order,a.order_status,a.order_accept_by_seller,b.quantity,b.order_id,b.sku,b.sub_tax_rate,b.sub_shipping_fees,b.sub_total_amount,c.price,d.name,e.imag,g.*,h.state,f.user_id,i.payment_type,
										k.dispatch_days
										FROM order_info a
										INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id
										INNER JOIN product_master c ON b.sku = c.sku
										INNER JOIN product_general_info d ON c.product_id = d.product_id
										INNER JOIN product_image e ON c.product_id = e.product_id
										INNER JOIN user f ON b.user_id = f.user_id
										INNER JOIN user_address g ON f.address_id = g.address_id
										INNER JOIN state h ON g.state = h.state_id
										INNER JOIN payment_info i on i.payment_mode_id= a.payment_mode 
										INNER JOIN dispatched_day_setting k on k.state_id=h.state_id
										WHERE b.order_id='$row_as_orderid->order_id' AND c.seller_id='$seller_id' AND (a.order_status='Pending payment' OR a.order_status='Processing' OR a.order_status='Failed' OR a.order_status='Order confirmed' OR a.order_status='Ready to shipped')
										GROUP BY b.order_id, b.sku ORDER BY a.date_of_order DESC");

                $row_as_product = $qrs->result();


                $date1 = date('y-m-d h:i:s');

                //$day_after_3days=date('y-m-d h:i:s' ,strtotime($row_as_product[0]->order_confirm_for_seller_date.'+ 3 day'));
                $day_after_3days = date('y-m-d h:i:s', strtotime($row_as_product[0]->order_confirm_for_seller_date . '+' . $row_as_product[0]->dispatch_days . 'day'));


                if ($date1 > $day_after_3days && $row_as_product[0]->order_confirm_for_seller_date != '0000-00-00 00:00:00') {

                    array_push($arr_orderId, $row_as_orderid->order_id);
                }
            }//foreach end
        }//if condition end


        return $arr_orderId;
    }

    function UpdateOrder_gracePeriodStatus($order_ids) {
        $order_id_str = implode(',', $order_ids);
        $this->db->query("update order_info set request_for_grace_period='yes' where order_id IN ('$order_id_str')  ");
    }

    function Update_Order_gracePeriodStatus() {
        $order_id = $this->input->post('grctxtbox_order_no');
        $grace_days = $this->input->post('grc_periodselect');
        $grc_reason = $this->input->post('txtarea_graceperiod');
        $this->db->query("update order_info set request_for_grace_period='yes' , grace_period='$grace_days' , grace_period_reason='$grc_reason' where order_id= '$order_id'  ");
    }

    function cancel_inn_order() {
        $order_id = $this->input->post('orderid');
        $data = array(
            'order_status' => 'Cancelled',
            'order_cancel_by_seller' => 'yes'
        );

        $data1 = array(
            'product_order_status' => 'Cancelled',
        );

        $this->db->where('order_id', $order_id);
        $this->db->update('order_info', $data);
        if ($this->db->affected_rows() > 0) {
            $this->db->where('order_id', $order_id);
            $this->db->update('ordered_product_from_addtocart', $data1);
            if ($this->db->affected_rows() > 0) {
                //program start for quantity increment in inventory//
                $query = $this->db->query("SELECT * FROM ordered_product_from_addtocart WHERE order_id='$order_id'");
                foreach ($query->result() as $order_row) {
                    $sku_arr[] = $order_row->sku;
                    $qty_arr[] = $order_row->quantity;
                }
                $sku_qty_arr = array_combine($sku_arr, $qty_arr);
                foreach ($sku_qty_arr as $k => $v) {
                    //program start for checking sku in products table and update quantity//
                    $query = $this->db->query("SELECT quantity FROM product_master WHERE sku='$k'");
                    $result = $query->result();
                    $quantity = $result[0]->quantity;
                    $total_qty = $quantity + $v;
                    $qty_data = array('quantity' => $total_qty);
                    $this->db->where('sku', $k);
                    $this->db->update('product_master', $qty_data);

                    //quantity update in seller product table start here//
                    $query1 = $this->db->query("SELECT * FROM seller_product_master WHERE sku='$k'");
                    if ($query1->num_rows() > 0) {
                        $this->db->where('sku', $k);
                        $this->db->update('seller_product_master', $qty_data);
                    } else {
                        $query2 = $this->db->query("SELECT * FROM seller_product_general_info WHERE sku='$k'");
                        if ($query2->num_rows() > 0) {
                            $result3 = $query2->result();
                            $slr_prdt_id = $result3[0]->seller_product_id;
                            $this->db->where('seller_product_id', $slr_prdt_id);
                            $this->db->update('seller_product_inventory_info', $qty_data);
                        }
                    }
                    //quantity update in seller product table end here//
                    //program end of checking sku in products table and update quantity//
                }
                //program end of quantity increment in inventory//
            }
            return true;
        }
    }

}
