<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

    function select_user($limit, $start) {
        $query = $this->db->query("SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address
FROM user a
LEFT OUTER JOIN user_address b ON b.address_id = a.address_id
LEFT OUTER JOIN state c ON b.state = c.state_id order by a.user_id DESC LIMIT " . $start . " , " . $limit . "");
        return $query->result();
    }

    function retrive_customer_details_count() {
        $query = $this->db->query("SELECT a.user_id FROM user a LEFT OUTER JOIN user_address b ON b.address_id = a.address_id LEFT OUTER JOIN state c ON b.state = c.state_id order by a.user_id DESC");
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return false;
        }
    }

    function select_filter_customer_count() {
        //$user_id = $_REQUEST['user_id'];
        $cust_name = $_REQUEST['cust_name'];
        $email = $_REQUEST['email'];
        $phone = $_REQUEST['phone'];
        $zip = $_REQUEST['zip'];
        $country_id = $_REQUEST['country_id'];
        $state_province = $_REQUEST['state_province'];
        $cust_since = $_REQUEST['cust_since'];
        $condition = "";


        /* if($user_id != ""){
          $condition .= " a.user_id ='$user_id' " ;
          $query = $this->db->query("SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address
          FROM user a LEFT OUTER JOIN user_address b ON b.address_id = a.address_id LEFT OUTER JOIN state c ON b.state = c.state_id order by a.user_id DESC");
          return $query->num_rows();
          } */
        if ($cust_name != "") {
            $condition .= " a.fname='$cust_name' ";
            $query = $this->db->query("SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address
				FROM user a LEFT OUTER JOIN user_address b ON b.address_id = a.address_id LEFT OUTER JOIN state c ON b.state = c.state_id where " . $condition . " order by a.user_id DESC");
            return $query->num_rows();
        }
        if ($email != "") {
            $condition .= "a.email LIKE '%$email%'";
            //echo $sql="select a.order_id from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id where ".$condition." group by b.order_id order by a.id desc";
            $query = $this->db->query("SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address
				FROM user a LEFT OUTER JOIN user_address b ON b.address_id = a.address_id LEFT OUTER JOIN state c ON b.state = c.state_id where " . $condition . " order by a.user_id DESC");
            //echo $query->num_rows();
            return $query->num_rows();
        }
        if ($phone != "") {
            $condition .= "a.mob='$phone'";
            $query = $this->db->query("SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address
				FROM user a LEFT OUTER JOIN user_address b ON b.address_id = a.address_id LEFT OUTER JOIN state c ON b.state = c.state_id where " . $condition . " order by a.user_id DESC");
            return $query->num_rows();
        }
        if ($zip != '') {
            $condition .= "b.pin_code='$zip'";
            $query = $this->db->query("SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address
				FROM user a LEFT OUTER JOIN user_address b ON b.address_id = a.address_id LEFT OUTER JOIN state c ON b.state = c.state_id where " . $condition . " order by a.user_id DESC");
            return $query->num_rows();
        }
        if ($country_id != '') {
            $condition .= "b.country = '$country_id'";

            $query = $this->db->query("SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address
				FROM user a LEFT OUTER JOIN user_address b ON b.address_id = a.address_id LEFT OUTER JOIN state c ON b.state = c.state_id where " . $condition . " order by a.user_id DESC");
            return $query->num_rows();
        }
        if ($state_province != '') {
            $condition .= "c.state = '$state_province'";

            $query = $this->db->query("SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address
				FROM user a LEFT OUTER JOIN user_address b ON b.address_id = a.address_id LEFT OUTER JOIN state c ON b.state = c.state_id where " . $condition . " order by a.user_id DESC");
            return $query->num_rows();
        }
        if ($cust_since != '') {
            $condition .= "a.registration_date = '$cust_since'";

            $query = $this->db->query("SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address
				FROM user a LEFT OUTER JOIN user_address b ON b.address_id = a.address_id LEFT OUTER JOIN state c ON b.state = c.state_id where " . $condition . " order by a.user_id DESC");
            return $query->num_rows();
        }
        if ($condition == "") {
            $query = $this->db->query("SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address FROM user a LEFT OUTER JOIN user_address b ON b.address_id = a.address_id LEFT OUTER JOIN state c ON b.state = c.state_id order by a.user_id DESC ");
            return $query->num_rows();
        }
    }

    function select_filtered_customers($limit, $start) {


        //$user_id = $_REQUEST['user_id'];
        $cust_name = $_REQUEST['cust_name'];
        $email = $_REQUEST['email'];
        $phone = $_REQUEST['phone'];
        $zip = $_REQUEST['zip'];
        $country_id = $_REQUEST['country_id'];
        $state_province = $_REQUEST['state_province'];
        $cust_since = $_REQUEST['cust_since'];
        //$cus_name=substr($customer_name,0,strpos($cust_name,' '));

        $condition = '';

        /* if( $user_id!='' ){

          $condition .= " a.user_id='$user_id' " ;
          $query=$this->db->query("SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address FROM user a
          LEFT OUTER JOIN user_address b ON b.address_id = a.address_id LEFT OUTER JOIN state c ON b.state = c.state_id where ".$condition." order by a.user_id DESC LIMIT ".$start." , ".$limit."");
          return $query->result();

          } */
        if ($cust_name != '') {
            $condition .= "a.fname LIKE '%$cust_name%'";
            //echo $sql ="select a.order_confirm_for_seller,a.order_id, a.order_status, a.Total_amount as sub_total_amount, a.date_of_order, a.order_status_modified_date,a.order_confirm_for_seller,a.invoice_id,a.cancelled_by,a.grace_period_approve_status,a.grace_period,b.seller_id,c.full_name from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id where ".$condition." group by b.order_id order by a.id desc LIMIT ".$start.", ".$limit."";
            /* echo $sql="SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address FROM user a
              LEFT OUTER JOIN user_address b ON b.address_id = a.address_id LEFT OUTER JOIN state c ON b.state = c.state_id where ".$condition." order by a.user_id DESC LIMIT ".$start." , ".$limit."";exit; */
            $query = $this->db->query("SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address FROM user a
LEFT OUTER JOIN user_address b ON b.address_id = a.address_id LEFT OUTER JOIN state c ON b.state = c.state_id where " . $condition . " order by a.user_id DESC LIMIT " . $start . " , " . $limit . "");


            return $query->result();
        }


        if ($email != '') {

            $condition .= "a.email='$email'";
            $query = $this->db->query("SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address FROM user a
LEFT OUTER JOIN user_address b ON b.address_id = a.address_id LEFT OUTER JOIN state c ON b.state = c.state_id where " . $condition . " order by a.user_id DESC LIMIT " . $start . " , " . $limit . "");
            return $query->result();
        }

        if ($phone != '') {

            $condition .= "a.mob='$phone'";
            $query = $this->db->query("SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address FROM user a
LEFT OUTER JOIN user_address b ON b.address_id = a.address_id LEFT OUTER JOIN state c ON b.state = c.state_id where " . $condition . " order by a.user_id DESC LIMIT " . $start . " , " . $limit . "");
            return $query->result();
        }

        if ($zip != '') {

            $condition .= "b.pin_code='$zip'";
            $query = $this->db->query("SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address FROM user a
LEFT OUTER JOIN user_address b ON b.address_id = a.address_id LEFT OUTER JOIN state c ON b.state = c.state_id where " . $condition . " order by a.user_id DESC LIMIT " . $start . " , " . $limit . "");
            return $query->result();
        }


        if ($country_id != '') {

            $condition .= "b.country='$country_id'";
            $query = $this->db->query("SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address FROM user a
LEFT OUTER JOIN user_address b ON b.address_id = a.address_id LEFT OUTER JOIN state c ON b.state = c.state_id where " . $condition . " order by a.user_id DESC LIMIT " . $start . " , " . $limit . "");
            return $query->result();
        }


        if ($state_province != '') {

            $condition .= "c.state='$state_province'";
            $query = $this->db->query("SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address FROM user a
LEFT OUTER JOIN user_address b ON b.address_id = a.address_id LEFT OUTER JOIN state c ON b.state = c.state_id where " . $condition . " order by a.user_id DESC LIMIT " . $start . " , " . $limit . "");
            return $query->result();
        }

        if ($cust_since != '') {

            $condition .= "a.registration_date LIKE '%$cust_since%'";
            $query = $this->db->query("SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address FROM user a
LEFT OUTER JOIN user_address b ON b.address_id = a.address_id LEFT OUTER JOIN state c ON b.state = c.state_id where " . $condition . " order by a.user_id DESC LIMIT " . $start . " , " . $limit . "");
            return $query->result();
        }




        if ($condition == '') {

            $query = $this->db->query("SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address FROM user a
LEFT OUTER JOIN user_address b ON b.address_id = a.address_id LEFT OUTER JOIN state c ON b.state = c.state_id order by a.user_id DESC LIMIT " . $start . " , " . $limit . "");
            return $query->result();
        }
        /*
          $query=$this->db->query("select a.order_confirm_for_seller,a.order_id, a.order_status, a.Total_amount as sub_total_amount, a.date_of_order, a.order_status_modified_date,a.order_confirm_for_seller,a.invoice_id,a.cancelled_by,a.grace_period_approve_status,a.grace_period,b.seller_id,c.full_name from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id where ".$condition." group by b.order_id order by a.id desc LIMIT ".$start.", ".$limit."");
          return $query; */
    }

    function filter_customer() {
        //$data['user_id_from'] = $this->input->post('user_id_from');
//
//			$data['user_id_to'] = $this->input->post('user_id_to');			
//			print_r($user_id_to);exit;			
//			$data['name'] = $this->input->post('name');
//			//print_r($name1);exit;	
//			$data['email'] = $this->input->post('email');
//			//print_r($phone);exit;
//			$data['telephone'] = $this->input->post('telephone');
//			
//			$data['zip'] = $this->input->post('zip');
//			//print_r($reg_date_to);exit;
//			$data['country_id'] = $this->input->post('country_id');	
//
//			$data['state_province'] = $this->input->post('state_province');	
//			
//			$data['id_from1'] = $this->input->post('id_from1');
//			$data['id_to1'] = $this->input->post('id_to1');
        $user_id_from = $this->input->post('user_id_from');

        $user_id_to = $this->input->post('user_id_to');
        //print_r($user_id_from);exit;			
        $name = $this->input->post('name');
        //print_r($name1);exit;	
        $email = $this->input->post('email');
        //print_r($phone);exit;
        $telephone = $this->input->post('telephone');

        $zip = $this->input->post('zip');
        //print_r($reg_date_to);exit;
        $country_id = $this->input->post('country_id');

        $state_province = $this->input->post('state_province');

        $id_from1 = $this->input->post('id_from1');
        $id_to1 = $this->input->post('id_to1');
        $condition = '';
        if ($user_id_from != '' && $user_id_to != '' && $name == '' && $email == '' && $telephone == '' && $zip == '' && $country_id == '' && $state_province == '' && $id_from1 == '' && $id_to1 == '') {
            $condition .= "a.user_id>='$user_id_from' and a.user_id<='$user_id_to'";
        }
        if ($user_id_from == '' && $user_id_to == '' && $name != '' && $email == '' && $telephone == '' && $zip == '' && $country_id == '' && $state_province == '' && $id_from1 == '' && $id_to1 == '') {
            $condition .= "a.fname='$name'";
        }
        if ($user_id_from == '' && $user_id_to == '' && $name == '' && $email != '' && $telephone == '' && $zip == '' && $country_id == '' && $state_province == '' && $id_from1 == '' && $id_to1 == '') {
            $condition .= "a.email='$email'";
        }
        if ($user_id_from == '' && $user_id_to == '' && $name == '' && $email == '' && $telephone != '' && $zip == '' && $country_id == '' && $state_province == '' && $id_from1 == '' && $id_to1 == '') {
            $condition .= "a.mob='$telephone'";
        }
        if ($user_id_from == '' && $user_id_to == '' && $name == '' && $email == '' && $telephone == '' && $zip != '' && $country_id == '' && $state_province == '' && $id_from1 == '' && $id_to1 == '') {
            $condition .= "b.pin_code='$zip'";
        }
        if ($user_id_from == '' && $user_id_to == '' && $name == '' && $email == '' && $telephone == '' && $zip == '' && $country_id != '' && $state_province == '' && $id_from1 == '' && $id_to1 == '') {
            $condition .= "b.country='$country_id'";
        }
        if ($user_id_from == '' && $user_id_to == '' && $name == '' && $email == '' && $telephone == '' && $zip == '' && $country_id == '' && $state_province != '' && $id_from1 == '' && $id_to1 == '') {
            $condition .= "c.state='$state_province'";
        }
        if ($user_id_from == '' && $user_id_to == '' && $name == '' && $email == '' && $telephone == '' && $zip == '' && $country_id == '' && $state_province == '' && $id_from1 != '' && $id_to1 != '') {
            $condition .= "a.registration_date>='$id_from1' and a.registration_date<='$id_to1'";
        }

        if ($user_id_from == '' && $user_id_to == '' && $name == '' && $email == '' && $telephone == '' && $zip == '' && $country_id == '' && $state_province == '' && $id_from1 == '' && $id_to1 == '') {
            $query = $this->db->query("SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address
FROM user a
LEFT OUTER JOIN user_address b ON b.address_id = a.address_id
LEFT OUTER JOIN state c ON b.state = c.state_id order by a.user_id DESC");
            return $query->result();
        }
        //echo $condition;exit;
        $query = $this->db->query("SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address
FROM user a
LEFT OUTER JOIN user_address b ON b.address_id = a.address_id
LEFT OUTER JOIN state c ON b.state = c.state_id  where " . $condition . " order by a.user_id DESC");
        return $query->result();
    }

    function customer_details($id) {
        $query = $this->db->query("SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.address,b.country,c.state,a.registration_date, b.address
FROM user a
LEFT OUTER JOIN user_address b ON b.address_id = a.address_id
LEFT OUTER JOIN state c ON b.state = c.state_id  where a.user_id='$id'");
        return $query->result();
    }

    function order_details($id) {
        $query = $this->db->query("SELECT a.user_id,b.order_id,d.name,c.mrp,e.imag,b.quantity,b.product_order_status,f.date_of_order,b.sub_total_amount,f.Total_amount
FROM user a
inner JOIN ordered_product_from_addtocart b ON a.user_id = b.user_id inner join order_info f on b.order_id=f.order_id
inner JOIN product_master c ON b.product_id = c.product_id inner join product_general_info d on c.product_id=d.product_id inner join product_image e on d.product_id=e.product_id where a.user_id='$id' and (b.product_order_status='Pending payment' or b.product_order_status='Failed' or b.product_order_status='Order confirmed' or b.product_order_status='Processing' or b.product_order_status='Ready to shipped' or b.product_order_status='Shipped') group by b.order_id");
        return $query->result();
    }

    function cancel_details($id) {
        $query = $this->db->query("SELECT b.order_id,b.product_order_status,d.name,c.mrp,e.imag
FROM ordered_product_from_addtocart b inner join order_info a on b.order_id=a.order_id
inner JOIN product_master c ON b.product_id = c.product_id inner join product_general_info d on c.product_id=d.product_id inner join product_image e on d.product_id=e.product_id where b.user_id='$id' and b.product_order_status='Cancelled' group by b.order_id ");
        return $query->result();
    }

    function return_details($id) {
        $query = $this->db->query("SELECT b.order_id,b.product_order_status,d.name,c.mrp,e.imag
FROM ordered_product_from_addtocart b inner join order_info a on b.order_id=a.order_id
inner JOIN product_master c ON b.product_id = c.product_id inner join product_general_info d on c.product_id=d.product_id inner join product_image e on d.product_id=e.product_id where b.user_id='$id' and (b.product_order_status='Return Requested' or b.product_order_status='Return Received') group by b.order_id ");
        return $query->result();
    }

    function delivered_products($id) {
        $query = $this->db->query("SELECT b.order_id,b.product_order_status,d.name,c.mrp,e.imag
FROM ordered_product_from_addtocart b inner join order_info a on b.order_id=a.order_id
inner JOIN product_master c ON b.product_id = c.product_id inner join product_general_info d on c.product_id=d.product_id inner join product_image e on d.product_id=e.product_id where b.user_id='$id' and b.product_order_status='Delivered' group by b.order_id ");
        return $query->result();
    }

    function undelivered_products($id) {
        $query = $this->db->query("SELECT b.order_id,b.product_order_status,a.imag
FROM ordered_product_from_addtocart b inner join product_image a on a.product_id=b.product_id where b.user_id='$id' and b.product_order_status='Undelivered' group by b.order_id ");
        return $query->result();
    }

    function retriving_custmr_addrs() {
        $user_id = $this->input->post('user_id');
        $query = $this->db->query("SELECT a.*,b.state AS state_name FROM user_address a INNER JOIN state b ON a.state=b.state_id WHERE a.user_id='$user_id'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

}

?>