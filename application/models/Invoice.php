<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * @name isOrderTransferred
     * @param Int $orderId
     * @desc used to validate order is transferred or not
     * @return Boolean
     */
    public function isOrderTransferred($orderId) {
        $query = "select old_order_id from order_transfer where new_order_id='$orderId'";
        $result = $this->db->query($query)->row();
        if ($result) {
            return $result->old_order_id;
        }
        return false;
    }

    /**
     * @name getInvoiceSlipData
     * @param Int $orderId
     * @desc used to fetch invoice slip data for admin
     * @return Array $result
     */
    public function getInvoiceSlipData($orderId) {
        $orderTransferred = $this->isOrderTransferred($orderId);
        if ($orderTransferred) {
            $orderId = $orderTransferred;
        }
        //generate invoice id if not exists
        $this->generateInvoiceId($orderId);

        $query = "
            SELECT 
                IF(u.fname='',ua.full_name,CONCAT(u.fname,' ',u.lname)) buyer_name
                ,IF(trim(u.mob)='',ua.phone,u.mob) mob,u.email
                ,ua.address,ua.city,ua.country,ua.pin_code buyer_pincode
                ,s.state user_state
                ,oi.date_of_order,oi.invoice_id ,oi.order_id,oi.total_amount
                ,sai.business_name,sai.gstin,sai.display_name
                ,sa.seller_address,sa.seller_city,sa.seller_state,sa.pincode                
                ,opfac.product_id,opfac.quantity,opfac.sub_tax_rate,opfac.sub_shipping_fees,opfac.sub_total_amount
                ,pgi.name product_name
                ,cps.color,cps.size,cps.capacity,cps.ram,cps.rom
                ,saddr.full_name,saddr.address ship_addrress ,saddr.city ship_city,saddr.pin_code ship_pincode,saddr.country ship_country
                ,saddr.phone ship_phone
                ,pm.tax_amount tax_rate
                ,pi.payment_mode_id,pi.payment_type
                ,(ctl.charge_tobuyer+ctl.tax) as cod_charge
                ,lower(ship_st.state) state
            FROM order_info oi
            LEFT JOIN ordered_product_from_addtocart opfac ON opfac.order_id=oi.order_id
            LEFT JOIN user u ON u.user_id=opfac.user_id
            LEFT JOIN user_address ua ON ua.address_id=u.address_id
            LEFT JOIN state s ON s.state_id=ua.state
            LEFT JOIN seller_account sa ON sa.seller_id=opfac.seller_id 
            LEFT JOIN seller_account_information sai ON sai.seller_id=sa.seller_id
            LEFT JOIN product_general_info pgi ON pgi.product_id=opfac.product_id
            LEFT JOIN cornjob_productsearch cps ON cps.sku=opfac.sku
            LEFT JOIN shipping_address saddr ON saddr.order_id=oi.order_id
            LEFT JOIN state ship_st ON ship_st.state_id=saddr.state
            LEFT JOIN product_master pm ON pm.product_id=pgi.product_id
            LEFT JOIN payment_info pi ON pi.payment_mode_id=oi.payment_mode
            LEFT JOIN cod_transaction_log ctl ON ctl.order_id=oi.order_id
            WHERE oi.order_id=?
            GROUP BY opfac.product_id";        
        $result = $this->db->query($query, array($orderId))->result_array();
        return $result;
    }

    /**
     * @name generate_invoiceid
     * @param string $order_id
     * @desc used to generate invoice id whose is not generated already
     * @return void
     */
    private function generateInvoiceId($orderId) {
        $query = "SELECT count(invoice_id) no_invoice_id 
                FROM order_info oi
                WHERE order_id='$orderId' AND trim(invoice_id) ='' || invoice_id is null";
        $result = $this->db->query($query)->row();
        if ($result && $result->no_invoice_id) {
            $today = date('Y-m-d H:i:s');
            $invoiceId = random_string('alnum', 5) . '-' . $orderId;
            $query = "update order_info set invoice_id='$invoiceId', invoice_date='$today' where order_id='$orderId'";
            $this->db->query($query);
            //order status log update start
            $order_log_status = 'invoice_generate_date';
            $this->updateOrderStatusLog($orderId, $order_log_status);
        }
    }

    /**
     * @name updateOrderStatusLog
     * @param string $order_id
     * @param string $orderLogStatus
     * @desc used log the order status
     * @return void
     */
    private function updateOrderStatusLog($orderId, $orderLogStatus) {

        $today = date('Y-m-d H:i:s');
        $query = "SELECT count(*) total_order 
                FROM order_status_log 
                WHERE order_id IN ($orderId)";
        $count = $this->db->query($query)->row();

        if (isset($count->total_order) && $count->total_order > 0) {
            $this->db->query("update order_status_log set " . $orderLogStatus . "='$today' WHERE order_id IN ($orderId) ");
        } else {
            $orderIds = explode(',', $orderId);
            if (is_array($orderIds)) {
                foreach ($orderIds as $id) {
                    $data = array(
                        'order_id' => $id,
                        $orderLogStatus => $today
                    );
                    $this->db->insert('order_status_log', $data);
                }
            }
        }
    }

}

?>