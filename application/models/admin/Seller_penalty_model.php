<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Seller_penalty_model extends CI_Model {

    function insert_penalty_data() {
        $order_cancel_penalty = $this->input->post('order_cancel');
        $order_notprocess_penalty = $this->input->post('order_not_process');
        $order_shipdelay_penalty = $this->input->post('order_ship_delay');
        date_default_timezone_set('Asia/Calcutta');
        $dt = date('Y-m-d H:i:s');
        $penalty_data = array(
            'order_cancel_penalty' => $order_cancel_penalty,
            'order_notprocess_penalty' => $order_notprocess_penalty,
            'order_delayship_penalty' => $order_shipdelay_penalty,
            'create_date' => $dt
        );

        $this->db->insert('penalty_setting', $penalty_data);
    }

    function select_penaltydata() {
        $query = $this->db->query("select * from penalty_setting order by Penalty_id desc");

        return $query;
    }

}
