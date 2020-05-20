<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter_model extends CI_Model {

    function getnewsletter() {
        $query = $this->db->query('SELECT * from subscriber_detail');
        return $query->result();
    }

    function search_subscriber($keyword) {
        $qr = $this->db->query("select * from subscriber_detail where user_email_id LIKE '$keyword%' ");
        //print_r($qr);exit;
        return $qr;
    }

    function selectnewsletter($email) {
        $qr = $this->db->query("select * from subscriber_detail where user_email_id='$email' ");
        //print_r($qr);exit;
        return $qr->result();
        ;
    }

}

?>