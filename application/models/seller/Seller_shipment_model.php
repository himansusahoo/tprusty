<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Seller_shipment_model extends CI_Model {

    function retrive_state() {
        $query = $this->db->query("SELECT * FROM state");
        $result = $query->result();
        return $result;
    }

    function retrieve_seller_shippment_state_id() {
        $seller_id = $this->session->userdata('seller-session');
        $query = $this->db->query("SELECT state_id FROM shipment WHERE seller_id='$seller_id'");
        return $query;
    }

    function retrieve_national_shippment_details() {
        $seller_id = $this->session->userdata('seller-session');
        $query = $this->db->query("SELECT * FROM shipment WHERE seller_id='$seller_id' AND state_id=0 AND type='default'");
        return $query;
    }

    function retrieve_shippment_type() {
        $seller_id = $this->session->userdata('seller-session');
        $query = $this->db->query("SELECT * FROM shipment WHERE seller_id='$seller_id'");
        return $query;
    }

    function check_seller_in_shippment() {
        $seller_id = $this->session->userdata('seller-session');
        $query = $this->db->query("SELECT * FROM shipment WHERE seller_id='$seller_id'");
        $rows = $query->num_rows();
        return $rows;
    }

    function retrieve_seller_shippment_details() {
        $seller_id = $this->session->userdata('seller-session');
        $query = $this->db->query("SELECT a.state,b.* FROM state a INNER JOIN shipment b ON a.state_id=b.state_id WHERE b.seller_id='$seller_id' AND b.type='default' ORDER BY a.state ASC");
        return $query;
    }

    function retrieve_flat_shippment() {
        $seller_id = $this->session->userdata('seller-session');
        $query = $this->db->query("SELECT * FROM shipment WHERE seller_id='$seller_id' AND type='flat'");
        return $query;
    }

    function insert_local_shipping_fee() {
        $seller_id = $this->session->userdata('seller-session');
        $data = array(
            'seller_id' => $seller_id,
            'state_id' => $this->input->post('state'),
            'amount' => $this->input->post('amount'),
            'type' => 'default'
        );
        $query = $this->db->query("SELECT * FROM shipment WHERE seller_id='$seller_id'");
        $row = $query->num_rows();
        if ($row > 0) {
            $result = $query->result();
            $shippment_type = $result[0]->type;
            if ($shippment_type == 'free' || $shippment_type == 'flat') {
                $shipment_typ = array('type' => 'default');
                $this->db->where('seller_id', $seller_id);
                $this->db->update('shipment', $shipment_typ);
                $this->db->insert('shipment', $data);
                if ($this->db->affected_rows() > 0) {
                    return true;
                }
            } else {
                $this->db->insert('shipment', $data);
                if ($this->db->affected_rows() > 0) {
                    return true;
                }
            }
        } else {
            $this->db->insert('shipment', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        }
    }

    function insert_national_shipping_fee() {
        $seller_id = $this->session->userdata('seller-session');
        $query = $this->db->query("SELECT * FROM shipment WHERE seller_id='$seller_id' AND state_id=0");
        $row = $query->num_rows();
        if ($row > 0) {
            return false;
        } else {
            $data = array(
                'seller_id' => $seller_id,
                'state_id' => 0,
                'amount' => $this->input->post('amount'),
                'type' => 'default'
            );
            $this->db->insert('shipment', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        }
    }

    function insert_flat_shipping_fee() {
        $seller_id = $this->session->userdata('seller-session');
        $data = array(
            'seller_id' => $seller_id,
            'amount' => $this->input->post('amount'),
            'type' => 'flat'
        );
        $rows = $this->check_seller_in_shippment();
        if ($rows > 0) {
            $this->db->where('seller_id', $seller_id);
            $this->db->update('shipment', $data);
            return true;
        } else {
            $this->db->insert('shipment', $data);
            return true;
        }
    }

    function insert_free_shipping_fee() {
        $seller_id = $this->session->userdata('seller-session');
        $data = array(
            'seller_id' => $seller_id,
            'amount' => 0,
            'type' => 'free'
        );
        $rows = $this->check_seller_in_shippment();
        if ($rows > 0) {
            $this->db->where('seller_id', $seller_id);
            $this->db->update('shipment', $data);
            return true;
        } else {
            $this->db->insert('shipment', $data);
            return true;
        }
    }

    function update_inn_national_shipping_fee() {
        $seller_id = $this->session->userdata('seller-session');
        $amount = $this->input->post('amount');
        $this->db->query("UPDATE shipment SET amount='$amount' WHERE seller_id='$seller_id' and state_id=0");
        if ($this->db->affected_rows() > 0) {
            return true;
        }
    }

    function update_inn_local_shipping_fee() {
        $shippment = $this->input->post('id');
        $amount = array('amount' => $this->input->post('amount'));
        $this->db->where('shipment_id', $shippment);
        $this->db->update('shipment', $amount);
        return true;
    }

    function update_inn_flat_shipping_fee() {
        $seller_id = $this->session->userdata('seller-session');
        $amount = $this->input->post('amount');
        $this->db->query("UPDATE shipment SET amount='$amount',type='flat' WHERE seller_id='$seller_id'");
        if ($this->db->affected_rows() > 0) {
            return true;
        }
    }

}
