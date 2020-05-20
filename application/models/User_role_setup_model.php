<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_role_setup_model extends CI_Model {

    function insert_user_role() {
        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $user_nm = $this->input->post('uname');
        $desg_nm = $this->input->post('user_desgn');
        $ucatg_nm = $this->input->post('user_category');
        $user_email = $this->input->post('emailid');
        $contact_no = $this->input->post('conct_no');
        $pwd = $this->input->post('Set_pwd');

        $main_tab_arr = $this->input->post('main_tab');

        $sales_tab = $this->input->post('sales_tab');
        $Catalog_tab = $this->input->post('Catalog_tab');
        $Sellers_tab = $this->input->post('Sellers_tab');
        $Customer_tab = $this->input->post('Customer_tab');
        $Promotions_tab = $this->input->post('Promotions_tab');
        $Pages_tab = $this->input->post('Pages_tab');
        $Reports_tab = $this->input->post('Reports_tab');
        $newsletter_chk = $this->input->post('newsletter_chk');
        $Config_tab = $this->input->post('Config_tab');

        $user_data = array(
            'first_name' => $fname,
            'last_name' => $lname,
            'uname' => $user_nm,
            'designation' => $desg_nm,
            'user_category' => $ucatg_nm,
            'email' => $user_email,
            'contact_no' => $contact_no,
            'password' => $pwd
        );
        $insert_userdata_query = $this->db->insert('user_role_previleges', $user_data);

        $select_userid_query = $this->db->query("select max(userole_id) as max_user_roleid  from user_role_previleges");
        $row1 = $select_userid_query->row();
        $user_id = $row1->max_user_roleid;

        foreach ($main_tab_arr as $k => $v) {
            $data1 = array(
                'main_tab_name' => $v,
                'user_role_id' => $user_id
            );
            $query1 = $this->db->insert("dashboard_tab_name", $data1);
        }

        $select_userid_query = $this->db->query("select *  from dashboard_tab_name where user_role_id='$user_id' ");
        $row_maintab = $select_userid_query->result();

        foreach ($row_maintab as $rec1) {
            if ($rec1->main_tab_name == 'Sales') {
                foreach ($sales_tab as $k1 => $v1) {
                    $sale_tab_data = array(
                        'main_tab_id' => $rec1->main_tab_id,
                        'sub_tab_name' => $v1
                    );
                    $this->db->insert('dashboard_sub_tab', $sale_tab_data);
                }
            } elseif ($rec1->main_tab_name == 'Catalog') {
                foreach ($Catalog_tab as $k2 => $v2) {
                    $catalog_tab_data = array(
                        'main_tab_id' => $rec1->main_tab_id,
                        'sub_tab_name' => $v2
                    );

                    $this->db->insert('dashboard_sub_tab', $catalog_tab_data);
                }
            } elseif ($rec1->main_tab_name == 'Sellers') {
                foreach ($Sellers_tab as $k3 => $v3) {
                    $seller_tab_data = array(
                        'main_tab_id' => $rec1->main_tab_id,
                        'sub_tab_name' => $v3
                    );
                    $this->db->insert('dashboard_sub_tab', $seller_tab_data);
                }
            } elseif ($rec1->main_tab_name == 'Customer') {
                foreach ($Customer_tab as $k4 => $v4) {
                    $customer_tab_data = array(
                        'main_tab_id' => $rec1->main_tab_id,
                        'sub_tab_name' => $v4
                    );
                    $this->db->insert('dashboard_sub_tab', $customer_tab_data);
                }
            } elseif ($rec1->main_tab_name == 'Promotions_main') {
                //foreach($Promotions as $k5=>$v5)
//					{
                $promotion_tab_data = array(
                    'main_tab_id' => $rec1->main_tab_id,
                    'sub_tab_name' => 'manage_coupons'
                );
                $this->db->insert('dashboard_sub_tab', $promotion_tab_data);
                //}
            } elseif ($rec1->main_tab_name == 'Pages') {
                foreach ($Pages_tab as $k6 => $v6) {
                    $pages_tab_data = array(
                        'main_tab_id' => $rec1->main_tab_id,
                        'sub_tab_name' => $v6
                    );
                    $this->db->insert('dashboard_sub_tab', $pages_tab_data);
                }
            } elseif ($rec1->main_tab_name == 'Reports') {
                foreach ($Reports_tab as $k7 => $v7) {
                    $report_tab_data = array(
                        'main_tab_id' => $rec1->main_tab_id,
                        'sub_tab_name' => $v7
                    );
                    $this->db->insert('dashboard_sub_tab', $report_tab_data);
                }
            } elseif ($rec1->main_tab_name == 'Newsletter') {
                foreach ($newsletter_chk as $k8 => $v8) {
                    $newsletter_tab_data = array(
                        'main_tab_id' => $rec1->main_tab_id,
                        'sub_tab_name' => $v8
                    );
                    $this->db->insert('dashboard_sub_tab', $newsletter_tab_data);
                }
            } elseif ($rec1->main_tab_name == 'Config') {
                foreach ($Config_tab as $k9 => $v9) {
                    $config_tab_data = array(
                        'main_tab_id' => $rec1->main_tab_id,
                        'sub_tab_name' => $v9
                    );
                    $this->db->insert('dashboard_sub_tab', $config_tab_data);
                }
            }
        }
    }

    function select_user_roledata($user_role_id) {
        $query = $this->db->query("select a.*,b.main_tab_name,c.sub_tab_name from user_role_previleges a INNER JOIN dashboard_tab_name b on a.userole_id=b.user_role_id INNER JOIN dashboard_sub_tab c on b.main_tab_id=c.main_tab_id WHERE a.userole_id='$user_role_id'  ");

        $row = $query->result();
        //print_r($row);exit;
        return $row;
    }

    function update_user_rolesetup($user_role_id) {

        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $user_nm = $this->input->post('uname');
        $desg_nm = $this->input->post('user_desgn');
        $ucatg_nm = $this->input->post('user_category');
        $user_email = $this->input->post('emailid');
        $contact_no = $this->input->post('conct_no');
        $pwd = $this->input->post('Set_pwd');

        $main_tab_arr = $this->input->post('main_tab');

        $sales_tab = $this->input->post('sales_tab');
        $Catalog_tab = $this->input->post('Catalog_tab');
        $Sellers_tab = $this->input->post('Sellers_tab');
        $Customer_tab = $this->input->post('Customer_tab');
        $Promotions_tab = $this->input->post('Promotions_tab');
        $Pages_tab = $this->input->post('Pages_tab');
        $Reports_tab = $this->input->post('Reports_tab');
        $newsletter_chk = $this->input->post('newsletter_chk');
        $Config_tab = $this->input->post('Config_tab');

        $user_data = array(
            'first_name' => $fname,
            'last_name' => $lname,
            'uname' => $user_nm,
            'designation' => $desg_nm,
            'user_category' => $ucatg_nm,
            'email' => $user_email,
            'contact_no' => $contact_no,
        );



        //$insert_userdata_query=$this->db->insert('user_role_previleges',$user_data);
        $query_update = $this->db->query("update user_role_previleges set first_name='$fname', last_name='$lname', uname='$user_nm', designation='$desg_nm', user_category='$ucatg_nm' , email='$user_email', contact_no='$contact_no', password='$pwd' where userole_id='$user_role_id' ");

        $query_maintab = $this->db->query("select * from dashboard_tab_name where  user_role_id='$user_role_id' ");
        //$row_maintab=$query_maintab->result();

        foreach ($query_maintab->result() as $res1) {
            $main_tab_id = $res1->main_tab_id;

            $query_delete = $this->db->query("delete from dashboard_sub_tab where main_tab_id='$main_tab_id'");
        }

        $this->db->query("delete from dashboard_tab_name where user_role_id='$user_role_id'");

        //$select_userid_query=$this->db->query("select max(userole_id) as max_user_roleid  from user_role_previleges");
//		$row1=$select_userid_query->row();
//		$user_id=$row1->max_user_roleid;

        foreach ($main_tab_arr as $k => $v) {
            $data1 = array(
                'main_tab_name' => $v,
                'user_role_id' => $user_role_id
            );
            $query1 = $this->db->insert("dashboard_tab_name", $data1);
        }

        $select_userid_query = $this->db->query("select *  from dashboard_tab_name where user_role_id='$user_role_id' ");
        $row_maintab = $select_userid_query->result();

        foreach ($row_maintab as $rec1) {
            if ($rec1->main_tab_name == 'Sales') {
                foreach ($sales_tab as $k1 => $v1) {
                    $sale_tab_data = array(
                        'main_tab_id' => $rec1->main_tab_id,
                        'sub_tab_name' => $v1
                    );
                    $this->db->insert('dashboard_sub_tab', $sale_tab_data);
                }
            } elseif ($rec1->main_tab_name == 'Catalog') {
                foreach ($Catalog_tab as $k2 => $v2) {
                    $catalog_tab_data = array(
                        'main_tab_id' => $rec1->main_tab_id,
                        'sub_tab_name' => $v2
                    );

                    $this->db->insert('dashboard_sub_tab', $catalog_tab_data);
                }
            } elseif ($rec1->main_tab_name == 'Sellers') {
                foreach ($Sellers_tab as $k3 => $v3) {
                    $seller_tab_data = array(
                        'main_tab_id' => $rec1->main_tab_id,
                        'sub_tab_name' => $v3
                    );
                    $this->db->insert('dashboard_sub_tab', $seller_tab_data);
                }
            } elseif ($rec1->main_tab_name == 'Customer') {
                foreach ($Customer_tab as $k4 => $v4) {
                    $customer_tab_data = array(
                        'main_tab_id' => $rec1->main_tab_id,
                        'sub_tab_name' => $v4
                    );
                    $this->db->insert('dashboard_sub_tab', $customer_tab_data);
                }
            } elseif ($rec1->main_tab_name == 'Promotions_main') {
                //foreach($Promotions as $k5=>$v5)
//					{
                $promotion_tab_data = array(
                    'main_tab_id' => $rec1->main_tab_id,
                    'sub_tab_name' => 'manage_coupons'
                );
                $this->db->insert('dashboard_sub_tab', $promotion_tab_data);
                //}
            } elseif ($rec1->main_tab_name == 'Pages') {
                foreach ($Pages_tab as $k6 => $v6) {
                    $pages_tab_data = array(
                        'main_tab_id' => $rec1->main_tab_id,
                        'sub_tab_name' => $v6
                    );
                    $this->db->insert('dashboard_sub_tab', $pages_tab_data);
                }
            } elseif ($rec1->main_tab_name == 'Reports') {
                foreach ($Reports_tab as $k7 => $v7) {
                    $report_tab_data = array(
                        'main_tab_id' => $rec1->main_tab_id,
                        'sub_tab_name' => $v7
                    );
                    $this->db->insert('dashboard_sub_tab', $report_tab_data);
                }
            } elseif ($rec1->main_tab_name == 'Newsletter') {
                foreach ($newsletter_chk as $k8 => $v8) {
                    $newsletter_tab_data = array(
                        'main_tab_id' => $rec1->main_tab_id,
                        'sub_tab_name' => $v8
                    );
                    $this->db->insert('dashboard_sub_tab', $newsletter_tab_data);
                }
            } elseif ($rec1->main_tab_name == 'Config') {
                foreach ($Config_tab as $k9 => $v9) {
                    $config_tab_data = array(
                        'main_tab_id' => $rec1->main_tab_id,
                        'sub_tab_name' => $v9
                    );
                    $this->db->insert('dashboard_sub_tab', $config_tab_data);
                }
            }
        }
    }

    function delete_user_rolesetup($user_role_id) {
        $query_maintab = $this->db->query("select * from dashboard_tab_name where  user_role_id='$user_role_id' ");
        //$row_maintab=$query_maintab->result();

        foreach ($query_maintab->result() as $res1) {
            $main_tab_id = $res1->main_tab_id;

            $query_delete = $this->db->query("delete from dashboard_sub_tab where main_tab_id='$main_tab_id'");
        }

        $this->db->query("delete from dashboard_tab_name where user_role_id='$user_role_id'");
        $this->db->query("delete from user_role_previleges where userole_id='$user_role_id'");
    }

    function active_userrole($user_role_id) {
        $this->db->query("update user_role_previleges set previleges_status='Active' where userole_id='$user_role_id'");
    }

    function inactive_userrole($user_role_id) {
        $this->db->query("update user_role_previleges set previleges_status='Inactive' where userole_id='$user_role_id'");
    }

    function select_userrole($user_log_id) {
        $query_user_log = $this->db->query("select a.* from user_log a inner join user_role_previleges b on a.user_id=b.userole_id where a.user_id='$user_log_id' order by user_log_id desc ");

        return $row_user_log = $query_user_log->result();
    }

    function select_user_data() {
        $query = $this->db->query("select * from user_role_previleges  order by userole_id desc");
        return $query;
    }

    function select_user_logdata() {
        $query = $this->db->query("select a.*,b.* from user_role_previleges a inner join user_log b on a.userole_id=b.user_id  order by b.user_log_id desc ");
        return $query;
    }

}
