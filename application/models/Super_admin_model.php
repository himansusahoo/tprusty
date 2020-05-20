<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Super_admin_model extends CI_Model {

    private $performance = 'performance';

    function super_admin_login() {
        $uname = $this->input->post('username');
        $pass = md5($this->input->post('password'));

        $query_sql = "SELECT * FROM admin WHERE uname= ? AND password= ? ";
        $query = $this->db->query($query_sql, array($uname, $pass));

        $row = $query->num_rows();
        $result = $query->result();

        if ($row == 1) {
            return $result;
        } else {

            $pass_user = $this->input->post('password');
            $user_sessdata = array();
            //$user_sessdata=$this->session->all_userdata();
            //echo $this->agent->browser().'<br>';
            $user_agentinfo = $this->agent->agent_string();
            $user_ip = $this->input->ip_address();
            //echo $this->input->user_agent().'<br>';
//		exit;
            date_default_timezone_set('Asia/Calcutta');
            $date_userlogin = date('y-m-d H:i:s');
            $this->db->query("update user_role_previleges set log_in_dtime ='$date_userlogin', ip_address='$user_ip', user_agent='$user_agentinfo' where uname='$uname' AND password='$pass_user'   ");

            $query1 = $this->db->query("SELECT * FROM user_role_previleges WHERE uname='$uname' AND password='$pass_user' AND previleges_status='Active'");
            $row1 = $query1->num_rows();
            $result1 = $query1->result();

            if ($row1 == 1) {
                $user_role_id = $result1[0]->userole_id;

                $this->session->set_userdata('logged_userrole_id', $user_role_id);

                return $result1;
            } else
                return false;
        }
    }

    function update_user_logouttime() {
        $uname = $this->session->userdata('logged_in');
        date_default_timezone_set('Asia/Calcutta');

        $date_userlogout = date('y-m-d H:i:s');

        $this->db->query("update user_role_previleges set log_out_dtime='$date_userlogout' where uname='$uname' ");
    }

    function insert_membership_data() {
        $this->load->model('Usermodel');
        $membership_id = $this->Usermodel->get_unique_id('membership', 'mbrshp_id');
        $column_name = 'MEMB-' . $membership_id;
        $data = array(
            'mbrshp_id' => $membership_id,
            'membrship_name' => $this->input->post('mname'),
            'membrship_cost' => $this->input->post('mcost'),
            'membrship_dsc' => $this->input->post('mdesc'),
            'membrship_pln_typ' => $this->input->post('memb_pln_typ'),
            'menbshp_column' => $column_name
        );

        //start program for add column in membership_commission table//
        $this->db->query("ALTER TABLE `membership_commission` ADD `$column_name` FLOAT NOT NUll");
        //end program for add column in membership_commission table//

        $this->db->insert('membership', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
    }

    function retrieve_2nd_leable_product_category() {
        $query = $this->db->query("SELECT * FROM category_indexing WHERE parent_id IN (SELECT category_id FROM category_indexing WHERE parent_id =0) ORDER BY category_name ASC");
        return $query->result();
    }

    function retrieve_3rd_leable_product_category() {
        $query = $this->db->query("SELECT * FROM category_indexing WHERE cat_level=3 ORDER BY category_name ASC");
        return $query->result();
    }

    /* function retrieve_2nd_leable_product_category_wth_global_commission(){
      $query = $this->db->query("SELECT a.category_id, a.category_name, b.cat_id, b.commission AS GLOBAL_COMMISSION
      FROM category_indexing a
      LEFT JOIN global_commission b ON a.category_id = b.cat_id
      WHERE a.parent_id
      IN (
      SELECT category_id
      FROM category_indexing
      WHERE parent_id =0
      )ORDER BY a.category_name ASC");
      return $query->result();
      } */

    function retrieve_3rd_leable_product_category_wth_global_commission() {
        /* $query = $this->db->query("SELECT a.category_id, a.category_name, b.cat_id, b.commission AS GLOBAL_COMMISSION
          FROM category_indexing a
          LEFT JOIN global_commission b ON a.category_id = b.cat_id
          WHERE a.parent_id
          IN (
          SELECT category_id
          FROM view_second_leable_category
          )
          ORDER BY a.category_name ASC "); */

        /* $query = $this->db->query("SELECT a.category_id, a.category_name,a.parent_id, b.cat_id, b.commission AS GLOBAL_COMMISSION
          FROM category_indexing a
          LEFT JOIN global_commission b ON a.category_id = b.cat_id
          WHERE a.cat_level=3 ORDER BY a.category_name ASC"); */


        $query = $this->db->query("SELECT a.category_id, a.category_name,a.parent_id, b.cat_id, b.commission AS GLOBAL_COMMISSION
		FROM category_indexing a
		LEFT JOIN global_commission b ON a.category_id = b.cat_id
		WHERE 
		 parent_id IN 
		(SELECT category_id FROM category_indexing WHERE parent_id IN 
		(SELECT category_id FROM category_indexing WHERE parent_id=0) )
				
		ORDER BY a.category_name ASC");
        return $query->result();
    }

    /* function retrieve_2nd_leable_product_category_wth_memb_commission($memb_column){
      $query = $this->db->query("SELECT a.category_id, a.category_name, b.cat_id, b.`$memb_column` AS MEMB_COMMISSION
      FROM category_indexing a
      LEFT JOIN membership_commission b ON a.category_id = b.cat_id
      WHERE a.parent_id
      IN (
      SELECT category_id
      FROM category_indexing
      WHERE parent_id =0
      )ORDER BY a.category_name ASC");
      return $query->result();
      } */

    function retrieve_3rd_leable_product_category_wth_memb_commission($memb_column) {
        $query = $this->db->query("SELECT a.category_id, a.category_name,a.parent_id, b.cat_id, b.`$memb_column` AS MEMB_COMMISSION 
		FROM category_indexing a
		LEFT JOIN membership_commission b ON a.category_id = b.cat_id
		WHERE a.cat_level=3 ORDER BY a.category_name ASC");
        return $query->result();
    }

    function insert_update_inn_global_commission() {
        $category_id = $this->input->post('category_id');
        $global_commission = $this->input->post('global_comision');
        $query = $this->db->query("SELECT * FROM global_commission WHERE cat_id=$category_id");
        $cat_row = $query->num_rows();

        date_default_timezone_set('Asia/Calcutta');
        $cdate = date('Y-m-d');

        if ($cat_row > 0) {
            $data = array(
                'commission' => $global_commission,
                'cdate' => $cdate
            );
            $this->db->where('cat_id', $category_id);
            $this->db->update('global_commission', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            $data = array(
                'cat_id' => $category_id,
                'commission' => $global_commission,
                'cdate' => $cdate
            );
            $this->db->insert('global_commission', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    function insert_update_inn_membership_commission() {
        $category_id = $this->input->post('category_id');
        $membership_field_name = $this->input->post('field_name');
        $memb_commission = $this->input->post('memb_comision');

        $query = $this->db->query("SELECT * FROM membership_commission WHERE cat_id=$category_id");
        $cat_row = $query->num_rows();
        if ($cat_row > 0) {
            $data = array(
                $membership_field_name => $memb_commission
            );
            $this->db->where('cat_id', $category_id);
            $this->db->update('membership_commission', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            $data = array(
                'cat_id' => $category_id,
                $membership_field_name => $memb_commission
            );
            $this->db->insert('membership_commission', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    function retrieve_membership_details() {
        $query = $this->db->query("SELECT * FROM membership ORDER BY membrship_name ASC");
        return $query->result();
    }

    function retrieve_seller_name() {
        $query = $this->db->query("SELECT seller_id,business_name FROM seller_account_information ORDER BY business_name ASC");
        return $query->result();
    }

    function check_special_commission_date_range() {
        $seller_id = $this->input->post('slr_id');
        $from_dt = $this->input->post('from_dt');
        $to_dt = $this->input->post('to_dt');
        $query = $this->db->query("SELECT MAX(to_date) AS TO_DATE FROM special_commission");
        $result = $query->result();
        $max_to_date = $result[0]->TO_DATE;
        if ($from_dt <= $max_to_date) {
            return false;
        } else {
            return true;
        }
    }

    function insert_inn_special_commission() {
        $category_id = $this->input->post('category_id');
        if ($this->input->post('seller_id') == '') {
            $seller_id = NULL;
        } else {
            $seller_id = serialize($this->input->post('seller_id'));
        }
        $commission_val = $this->input->post('special_comision');
        $from_dt = $this->input->post('from_dt');
        $to_dt = $this->input->post('to_dt');

        date_default_timezone_set('Asia/Calcutta');
        $cdate = date('Y-m-d');
        $special_data = array(
            'cat_id' => $category_id,
            'seller_id' => $seller_id,
            'commision' => $commission_val,
            'from_date' => $from_dt,
            'to_date' => $to_dt,
            'seting_date' => $cdate
        );
        $this->db->insert('special_commission', $special_data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function retrieve_special_commission_details() {
        $query = $this->db->query("SELECT a.*,b.category_name FROM special_commission a INNER JOIN category_indexing b ON a.cat_id=b.category_id ORDER BY a.id DESC");
        return $query;
    }

    function edit_inn_special_commission() {
        $spl_commsn_id = $this->uri->segment(4);
        $sql = $this->db->query("SELECT * FROM special_commission WHERE id=$spl_commsn_id");
        $res = $sql->result();
        $from_date = $res[0]->from_date;
        $to_date = $res[0]->to_date;

        //query for second label category
        /* $query = $this->db->query("SELECT a.category_id, a.category_name,b.id, b.cat_id, b.seller_id, b.commision, b.from_date, b.to_date
          FROM category_indexing a
          LEFT JOIN special_commission b ON a.category_id = b.cat_id
          AND b.from_date =  '$from_date'
          AND b.to_date =  '$to_date'
          WHERE a.parent_id
          IN (
          SELECT category_id
          FROM category_indexing
          WHERE parent_id =0
          )
          ORDER BY a.category_name ASC"); */

        $query = $this->db->query("SELECT a.category_id, a.category_name,a.parent_id,b.id, b.cat_id, b.seller_id, b.commision, b.from_date, b.to_date
		FROM category_indexing a
		LEFT JOIN special_commission b ON a.category_id = b.cat_id
		AND b.from_date =  '$from_date'
		AND b.to_date =  '$to_date'
		WHERE a.cat_level=3
		ORDER BY a.category_name ASC");
        $result = $query->result();
        return $result;
    }

    function update_inn_special_commission() {
        $category_id = $this->input->post('category_id');
        if ($this->input->post('seller_id') == '') {
            $seller_id = NULL;
        } else {
            $seller_id = serialize($this->input->post('seller_id'));
        }
        $commission_val = $this->input->post('special_comision');
        $from_dt = $this->input->post('from_dt');
        $to_dt = $this->input->post('to_dt');

        date_default_timezone_set('Asia/Calcutta');
        $cdate = date('Y-m-d');

        $query = $this->db->query("SELECT * FROM special_commission WHERE cat_id=$category_id AND from_date='$from_dt' AND to_date='$to_dt'");
        $spl_rows = $query->num_rows();
        if ($spl_rows > 0) {
            $result = $query->result();
            $id = $result[0]->id;

            $special_data = array(
                'seller_id' => $seller_id,
                'commision' => $commission_val
            );
            $this->db->where('id', $id);
            $this->db->update('special_commission', $special_data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            $special_data = array(
                'cat_id' => $category_id,
                'seller_id' => $seller_id,
                'commision' => $commission_val,
                'from_date' => $from_dt,
                'to_date' => $to_dt,
                'seting_date' => $cdate
            );
            $this->db->insert('special_commission', $special_data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        }
    }

    function delete_special_commission() {
        $spl_cmsn_id = $this->input->post('id');
        $this->db->where('id', $spl_cmsn_id);
        $this->db->delete('special_commission');
        return true;
    }

    function insert_update_fixed_charges_data() {
        date_default_timezone_set('Asia/Calcutta');
        $cdate = date('Y-m-d');

        $query = $this->db->query("SELECT * FROM charges_master WHERE charges_type='Fixed Charges'");
        $row = $query->num_rows();
        if ($row > 0) {
            $data = array(
                'percent' => $this->input->post('per_fixedcharges'),
                'amount' => $this->input->post('amt_fixedcharges'),
                'modified_date' => $cdate
            );
            $this->db->where('cat_id', 0);
            $this->db->update('charges_master', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            $data = array(
                'cat_id' => 0,
                'charges_type' => 'Fixed Charges',
                'percent' => $this->input->post('per_fixedcharges'),
                'amount' => $this->input->post('amt_fixedcharges'),
                'modified_date' => $cdate
            );
            $this->db->insert('charges_master', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        }
    }

    function insert_update_pg_charges_data() {
        date_default_timezone_set('Asia/Calcutta');
        $cdate = date('Y-m-d');

        $query = $this->db->query("SELECT * FROM charges_master WHERE charges_type='Payment gateway Charges'");
        $row = $query->num_rows();
        if ($row > 0) {
            $data = array(
                'percent' => $this->input->post('pgcharges'),
                'modified_date' => $cdate
            );
            $this->db->where('cat_id', 1);
            $this->db->update('charges_master', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            $data = array(
                'cat_id' => 1,
                'charges_type' => 'Payment gateway Charges',
                'percent' => $this->input->post('pgcharges'),
                'modified_date' => $cdate
            );
            $this->db->insert('charges_master', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        }
    }

    function insert_update_season_charges_data() {
        date_default_timezone_set('Asia/Calcutta');
        $cdate = date('Y-m-d');

        $query = $this->db->query("SELECT * FROM charges_master WHERE charges_type='Seasonal Charges'");
        $row = $query->num_rows();

        if ($row > 0) {
            $data = array(
                'amount' => $this->input->post('amt_season_charges'),
                'percent' => $this->input->post('per_season_charges'),
                'from_dt' => $this->input->post('from_dt'),
                'to_date' => $this->input->post('to_dt'),
                'modified_date' => $cdate,
                'status' => $this->input->post('include_sts')
            );
            $this->db->where('cat_id', 2);
            $this->db->update('charges_master', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            $data = array(
                'cat_id' => 2,
                'charges_type' => 'Seasonal Charges',
                'amount' => $this->input->post('amt_season_charges'),
                'percent' => $this->input->post('per_season_charges'),
                'from_dt' => $this->input->post('from_dt'),
                'to_date' => $this->input->post('to_dt'),
                'modified_date' => $cdate,
                'status' => $this->input->post('include_sts')
            );
            $this->db->insert('charges_master', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        }
    }

    function insert_update_cancel_charges_data() {
        date_default_timezone_set('Asia/Calcutta');
        $cdate = date('Y-m-d');

        $query = $this->db->query("SELECT * FROM charges_master WHERE charges_type='Order Cancel Penalty'");
        $row = $query->num_rows();

        if ($row > 0) {
            $data = array(
                'percent' => $this->input->post('order_cancel'),
                'modified_date' => $cdate
            );
            $this->db->where('cat_id', 3);
            $this->db->update('charges_master', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            $data = array(
                'cat_id' => 3,
                'charges_type' => 'Order Cancel Penalty',
                'percent' => $this->input->post('order_cancel'),
                'modified_date' => $cdate,
            );
            $this->db->insert('charges_master', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        }
    }

    function insert_update_order_not_process_charges_data() {
        date_default_timezone_set('Asia/Calcutta');
        $cdate = date('Y-m-d');

        $query = $this->db->query("SELECT * FROM charges_master WHERE charges_type='Order Not Process'");
        $row = $query->num_rows();

        if ($row > 0) {
            $data = array(
                'percent' => $this->input->post('order_not_process'),
                'modified_date' => $cdate
            );
            $this->db->where('cat_id', 4);
            $this->db->update('charges_master', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            $data = array(
                'cat_id' => 4,
                'charges_type' => 'Order Not Process',
                'percent' => $this->input->post('order_not_process'),
                'modified_date' => $cdate,
            );
            $this->db->insert('charges_master', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        }
    }

    function insert_update_ship_delay_charges_data() {
        date_default_timezone_set('Asia/Calcutta');
        $cdate = date('Y-m-d');

        $query = $this->db->query("SELECT * FROM charges_master WHERE charges_type='Order Shipping Delay'");
        $row = $query->num_rows();

        if ($row > 0) {
            $data = array(
                'percent' => $this->input->post('order_ship_delay'),
                'modified_date' => $cdate
            );
            $this->db->where('cat_id', 5);
            $this->db->update('charges_master', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            $data = array(
                'cat_id' => 5,
                'charges_type' => 'Order Shipping Delay',
                'percent' => $this->input->post('order_ship_delay'),
                'modified_date' => $cdate,
            );
            $this->db->insert('charges_master', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        }
    }

    function retrieve_fixed_charges() {
        $query = $this->db->query("SELECT * FROM charges_master WHERE charges_type='Fixed Charges'");
        $result = $query->result();
        return $result;
    }

    function retrieve_pg_charges() {
        $query = $this->db->query("SELECT * FROM charges_master WHERE charges_type='Payment gateway Charges'");
        $result = $query->result();
        return $result;
    }

    function retrieve_season_charges() {
        $query = $this->db->query("SELECT * FROM charges_master WHERE charges_type='Seasonal Charges'");
        $result = $query->result();
        return $result;
    }

    function retrieve_ordr_cancel_penlty_charges() {
        $query = $this->db->query("SELECT * FROM charges_master WHERE charges_type='Order Cancel Penalty'");
        $result = $query->result();
        return $result;
    }

    function retrieve_ordr_notprocess_penlty_charges() {
        $query = $this->db->query("SELECT * FROM charges_master WHERE charges_type='Order Not Process'");
        $result = $query->result();
        return $result;
    }

    function retrieve_shpngdely_penlty_charges() {
        $query = $this->db->query("SELECT * FROM charges_master WHERE charges_type='Order Shipping Delay'");
        $result = $query->result();
        return $result;
    }

    function graph_data_totprdqnt() {
        $query = $this->db->query("select sum(quantity) as total_quant from product_master where seller_id!=0  ");

        $row = $query->row();

        return $row;
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

    function count_orderconfirmed() {
        $query = $this->db->query("SELECT COUNT( order_status ) as confirm_ordered_count FROM  order_info WHERE order_status = 'Order confirmed'  ");
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

    function get_chart_data() {
        $query_max = $this->db->query("select *, min(delivered_count) as min_dlcount, max(delivered_count) as mx_dlcount from view_sale_performance  ");

        $results = $query_max->result();


        //$query = $this->db->get($this->performance);
//        $results['chart_data'] = $query->result();
//        $this->db->select_min('performance_year');
//        $this->db->limit(1);
//        $query = $this->db->get($this->performance);
//        $results['min_year'] = $query->row()->performance_year;
//        $this->db->select_max('performance_year');
//        $this->db->limit(1);
//        $query = $this->db->get($this->performance);
//        $results['max_year'] = $query->row()->performance_year;

        return $results;
    }

    function get_seller_sale_weekly() {


        // $monday = strtotime("last monday");
//		$monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
//												 
//		$sunday = strtotime(date("Y-m-d H:i:s",$monday)." +6 days");
//												 
//		$this_week_sd = date("Y-m-d H:i:s",$monday);
//		$this_week_ed = date("Y-m-d H:i:s",$sunday);
        //between date_sub(now(),INTERVAL 1 WEEK) and now()

        $query = $this->db->query("SELECT a.order_status_modified_date, SUM( b.quantity) as sale_qnt , c.business_name
									FROM order_info a
									INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id
									INNER JOIN seller_account_information c ON c.seller_id = b.seller_id
									WHERE a.order_status =  'Delivered'
									GROUP BY b.seller_id");

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

    function insert_voucher_data() {
        $voucher_gen_typ = $this->input->post('gen_type');
        if ($voucher_gen_typ == 0) {
            //generating voucher number
            $voucher_no = $this->checking_unique_string('gift_voucher_master', 'voucher_no');
            $vdata = array(
                'voucher_no' => $voucher_no,
                'gen_type' => $voucher_gen_typ,
                'purchase_value' => $this->input->post('purchase_amt'),
                'qty' => $this->input->post('qty'),
                'discount' => $this->input->post('voucher_percent'),
                'amount' => $this->input->post('voucher_amt'),
                'valid_from' => $this->input->post('from_dt'),
                'valid_to' => $this->input->post('to_dt'),
            );
        } else if ($voucher_gen_typ == 1) {
            $vdata = array(
                'voucher_no' => $this->input->post('v_prifx') . $this->input->post('v_number'),
                'gen_type' => $voucher_gen_typ,
                'purchase_value' => $this->input->post('purchase_amt'),
                'qty' => $this->input->post('qty'),
                'discount' => $this->input->post('voucher_percent'),
                'amount' => $this->input->post('voucher_amt'),
                'valid_from' => $this->input->post('from_dt'),
                'valid_to' => $this->input->post('to_dt'),
            );
        }

        $this->db->insert('gift_voucher_master', $vdata);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
    }

    function checking_unique_string($table, $colunm) {
        $this->load->helper('string');
        date_default_timezone_set('Asia/Calcutta');
        while (2 > 1) {
            $dtm = preg_replace("/[^0-9]+/", "", date('Y-m-d H:i:s'));

            $strng = strtoupper(random_string('alnum', 4));
            $vnumber = $strng . $dtm;

            $query = $this->db->query("SELECT $colunm FROM $table WHERE $colunm='$vnumber'");
            if ($query->num_rows() == 0) {
                break;
            }
        }
        return $vnumber;
    }

    function retrieve_voucher_details() {
        $query = $this->db->query("SELECT * FROM gift_voucher_master");
        return $query;
    }

    function delete_inn_voucher_data() {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('gift_voucher_master');
        return true;
    }

    function retrieve_emailog($limit, $start) {
        $qr = $this->db->query("select *, date as log_date from email_log order by log_id desc LIMIT " . $start . " , " . $limit . "");
        return $qr;
    }

    function retrieve_emailog_count() {
        $query = $this->db->query("select *, date as log_date from email_log order by log_id desc");
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return false;
        }
    }

    function select_filter_emaillog_count() {
        //$user_id = $_REQUEST['user_id'];
        $toemail_id = $_REQUEST['toemail_id'];
        $fromemail_id = $_REQUEST['fromemail_id'];
        $subject = $_REQUEST['subject'];
        $date = $_REQUEST['date'];
        $email_status = $_REQUEST['email_status'];
        $condition = "";


        /* if($user_id != ""){
          $condition .= " a.user_id ='$user_id' " ;
          $query = $this->db->query("SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address
          FROM user a LEFT OUTER JOIN user_address b ON b.address_id = a.address_id LEFT OUTER JOIN state c ON b.state = c.state_id order by a.user_id DESC");
          return $query->num_rows();
          } */
        if ($toemail_id != "") {
            $condition .= "to_email_id LIKE '%$toemail_id%'";
            $query = $this->db->query("select *, date as log_date from email_log where " . $condition . " order by log_id desc");
            return $query->num_rows();
        }
        if ($fromemail_id != "") {
            $condition .= "from_email_id LIKE '%$fromemail_id%'";
            //echo $sql="select a.order_id from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id where ".$condition." group by b.order_id order by a.id desc";
            $query = $this->db->query("select *, date as log_date from email_log where " . $condition . " order by log_id desc");
            //echo $query->num_rows();
            return $query->num_rows();
        }
        if ($subject != "") {
            $condition .= "email_sub='$subject'";
            $query = $this->db->query("select *, date as log_date from email_log where " . $condition . " order by log_id desc");
            return $query->num_rows();
        }
        if ($date != '') {
            $condition .= "DATE(date) ='$date'";
            $query = $this->db->query("select *, date as log_date from email_log where " . $condition . " order by log_id desc");
            return $query->num_rows();
        }
        if ($email_status != '') {
            $condition .= "email_send_status = '$email_status'";

            $query = $this->db->query("select *, date as log_date from email_log where " . $condition . " order by log_id desc");
            return $query->num_rows();
        }

        if ($condition == "") {
            $query = $this->db->query("select *, date as log_date from email_log order by log_id desc");
            return $query->num_rows();
        }
    }

    function select_filtered_emaillog($limit, $start) {


        //$user_id = $_REQUEST['user_id'];
        $toemail_id = $_REQUEST['toemail_id'];
        $fromemail_id = $_REQUEST['fromemail_id'];
        $subject = $_REQUEST['subject'];
        $date = $_REQUEST['date'];
        $email_status = $_REQUEST['email_status'];
        $condition = "";
        //$cus_name=substr($customer_name,0,strpos($cust_name,' '));

        $condition = '';

        /* if( $user_id!='' ){

          $condition .= " a.user_id='$user_id' " ;
          $query=$this->db->query("SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address FROM user a
          LEFT OUTER JOIN user_address b ON b.address_id = a.address_id LEFT OUTER JOIN state c ON b.state = c.state_id where ".$condition." order by a.user_id DESC LIMIT ".$start." , ".$limit."");
          return $query->result();

          } */
        if ($toemail_id != '') {
            $condition .= "to_email_id LIKE '%$toemail_id%'";
            //echo $sql ="select a.order_confirm_for_seller,a.order_id, a.order_status, a.Total_amount as sub_total_amount, a.date_of_order, a.order_status_modified_date,a.order_confirm_for_seller,a.invoice_id,a.cancelled_by,a.grace_period_approve_status,a.grace_period,b.seller_id,c.full_name from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id where ".$condition." group by b.order_id order by a.id desc LIMIT ".$start.", ".$limit."";
            /* echo $sql="SELECT a.user_id ,a.fname,a.lname,a.email,a.mob,b.pin_code,b.country,c.state,a.registration_date, b.address FROM user a
              LEFT OUTER JOIN user_address b ON b.address_id = a.address_id LEFT OUTER JOIN state c ON b.state = c.state_id where ".$condition." order by a.user_id DESC LIMIT ".$start." , ".$limit."";exit; */
            $query = $this->db->query("select *, date as log_date from email_log where " . $condition . " order by log_id desc LIMIT " . $start . " , " . $limit . "");


            return $query;
        }


        if ($fromemail_id != '') {

            $condition .= "from_email_id LIKE '%$fromemail_id%'";
            $query = $this->db->query("select *, date as log_date from email_log where " . $condition . " order by log_id desc LIMIT " . $start . " , " . $limit . "");
            return $query;
        }

        if ($subject != '') {

            $condition .= "email_sub LIKE '%$subject%'";
            $query = $this->db->query("select *, date as log_date from email_log where " . $condition . " order by log_id desc LIMIT " . $start . " , " . $limit . "");
            return $query;
        }

        if ($date != '') {

            $condition .= "DATE(date)= '$date'";
            $query = $this->db->query("select *, date as log_date from email_log where " . $condition . " order by log_id desc LIMIT " . $start . " , " . $limit . "");
            return $query;
        }


        if ($email_status != '') {

            $condition .= "email_send_status = '$email_status'";
            $query = $this->db->query("select *, date as log_date from email_log where " . $condition . " order by log_id desc LIMIT " . $start . " , " . $limit . "");
            return $query;
        }







        if ($condition == '') {

            $query = $this->db->query("select *, date as log_date from email_log order by log_id desc LIMIT " . $start . " , " . $limit . "");
            return $query;
        }
        /*
          $query=$this->db->query("select a.order_confirm_for_seller,a.order_id, a.order_status, a.Total_amount as sub_total_amount, a.date_of_order, a.order_status_modified_date,a.order_confirm_for_seller,a.invoice_id,a.cancelled_by,a.grace_period_approve_status,a.grace_period,b.seller_id,c.full_name from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id where ".$condition." group by b.order_id order by a.id desc LIMIT ".$start.", ".$limit."");
          return $query; */
    }

    function retrieve_errorlog() {
        //echo readfile(base_url().'error_log');exit;

        $handle = fopen(base_url() . 'error_log', "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {

                //$qr_err=$this->db->query("SELECT * from error_log WHERE error_descp='$line' ");
//					if($qr_err->num_rows()==0)
//					{
                $data = array(
                    'error_descp' => $line
                );

                $this->db->insert('error_log', $data);
                //}
            } // while loop end


            fclose($handle);
        }

        $qr = $this->db->query("select *  from error_log order by error_id desc");
        return $qr->result();
    }

    function select_onlinepaymentdata() {
        $query = $this->db->query("SELECT * FROM order_info WHERE (order_status='Delivered' OR order_status='Shipped' OR order_status='Failed' OR order_status='Order confirmed') AND order_id_payment_gateway!='' AND payment_mode='2' 
		AND order_id_payment_gateway NOT IN (SELECT order_id FROM payment_by_ccavenue_info) ");

        return $query;
    }

}

?>