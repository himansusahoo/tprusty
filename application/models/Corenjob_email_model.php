<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Corenjob_email_model extends CI_Model {

    function mail_sendTo_buyer() {
        

        $query_addtocart_data = $this->db->query("select * from addtocart_temp group by user_id ");
        $row_addtocart_data = $query_addtocart_data->result();
        foreach ($row_addtocart_data as $res_addtocart_data) {
            $dt = $res_addtocart_data->added_time;

            $dt_after6hr = date('Y-m-d H:i:s', strtotime($dt . '+ 6 hour'));
            $dt_after12hr = date('Y-m-d H:i:s', strtotime($dt . '+ 12 hour'));
            $dt_after18hr = date('Y-m-d H:i:s', strtotime($dt . '+ 18 hour'));
            $dt_after72hr = date('Y-m-d H:i:s', strtotime($dt . '+ 72 hour'));

            $cur_dtime = date('Y-m-d H:i:s');
            if ($cur_dtime == $dt_after6hr || $cur_dtime == $dt_after12hr || $cur_dtime == $dt_after18hr || $cur_dtime == $dt_after72hr) {
                $user_id = $res_addtocart_data->user_id;

                //email send to buyer start
                $query_user_info = $this->db->query("select * from user where user_id='$user_id' ");
                $mail_row_user = $query_user_info->row();

                $fname = $mail_row_user->fname;
                $lname = $mail_row_user->lname;
                $email_buyer = $mail_row_user->email;
                $data['fname'] = $fname;
                $data['lname'] = $lname;

                $this->email->set_mailtype("html");
                $this->email->from(INFO_MAIL, DOMAIN_NAME);
                $this->email->subject('Complete your Check out process');
                $this->email->message($this->load->view('email_template/cronjobmail_cartitems', $data, true));
                $this->email->send();
            } //if end
        } // foreach end
    }

    function wishlistmail_sendTo_buyer() {
        $query_wishlist_data = $this->db->query("select * from wishlist group by user_id ");
        $row_wishlist_data = $query_wishlist_data->result();

        if ($query_wishlist_data->num_rows() != 0) {
            foreach ($row_wishlist_data as $res) {

                $user_id = $res->user_id;
                $query_user_info = $this->db->query("select * from user where user_id='$user_id' ");
                $mail_row_user = $query_user_info->row();

                $fname = $mail_row_user->fname;
                $lname = $mail_row_user->lname;
                $email_buyer = $mail_row_user->email;
                $data['fname'] = $fname;
                $data['lname'] = $lname;

                $this->email->set_mailtype("html");
                $this->email->from(INFO_MAIL, DOMAIN_NAME);
                $this->email->to($email_buyer);
                $this->email->subject('Complete your Check out process from wishlist');
                $this->email->message($this->load->view('email_template/cronjobmail_wishlist', $data, true));
                $this->email->send();
            }
        }
    }

}
