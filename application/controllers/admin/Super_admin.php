<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Super_admin extends MX_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('upload');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->library('pagination');
        $this->load->helper('string');
        $this->load->library('user_agent');
        $this->load->model('Super_admin_model');
        $this->load->model('admin/User_role_setup_model');
        //$this->load->model('rbac_user');
        //$this->load->model('Admin_model');
    }

    function index() {
        $this->load->view('admin/login');
    }

    function login() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/login');
        } else {
            $uname = $this->input->post('username');
            $pass = $this->input->post('password');
            $result = $this->Super_admin_model->super_admin_login();
            if ($result != false) {
                $username = $result[0]->uname;
                //Add Admin username in session id
                $this->session->set_userdata('logged_in', $username);

                $data['tot_prdqnt'] = $this->Super_admin_model->graph_data_totprdqnt();

                //chart data access start

                $data['results'] = $this->Super_admin_model->get_chart_data(); //chart data access end
                $data['deliver_count'] = $this->Super_admin_model->get_delivered_ordercount();
                $data['cancel_count'] = $this->Super_admin_model->get_Cancelled_ordercount();
                $data['confirm_count'] = $this->Super_admin_model->get_confirmed_ordercount();
                $data['undelivered_count'] = $this->Super_admin_model->get_Undelivered_ordercount();
                $data['return_count'] = $this->Super_admin_model->get_return_ordercount();
                $data['order_confirm'] = $this->Super_admin_model->count_orderconfirmed();

                $data['seller_weekly_sale'] = $this->Super_admin_model->get_seller_sale_weekly();
                $data['moonboy_sale'] = $this->Super_admin_model->get_moonboy_turnover_monthly();
                //seller weekly chart access data end
                //workaround for rbac module
                $manageEmployee = modules::load('employee/manage_employees');
                $manageEmployee->login_workaround($uname, $pass);
                
                redirect('admin/super_admin/home', $data);
            } else {
                $this->session->set_flashdata('invalid_uname', 'Invalid username or password');
                redirect('admin/super_admin');
            }
        }
    }

    function home() {
        if ($this->session->userdata('logged_in')) {

            //chart data access start
            $data['results'] = $this->Super_admin_model->get_chart_data();
            $data['deliver_count'] = $this->Super_admin_model->get_delivered_ordercount();
            $data['cancel_count'] = $this->Super_admin_model->get_Cancelled_ordercount();
            $data['confirm_count'] = $this->Super_admin_model->get_confirmed_ordercount();
            $data['undelivered_count'] = $this->Super_admin_model->get_Undelivered_ordercount();
            $data['return_count'] = $this->Super_admin_model->get_return_ordercount();
            $data['order_confirm'] = $this->Super_admin_model->count_orderconfirmed();
            //seller weekly chart access data start

            $data['seller_weekly_sale'] = $this->Super_admin_model->get_seller_sale_weekly();
            //chart data access end
            $this->load->view('admin/home', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function logout() {

        if ($this->session->userdata('logged_in') != ADMIN_MAIL) {
            $this->Super_admin_model->update_user_logouttime();
        }
        $this->session->unset_userdata('logged_in');
        $manageEmployee = modules::run('employee/manage_employees/rbac_logout');
        redirect('admin/super_admin');
    }

    function membership() {
        if ($this->session->userdata('logged_in')) {
            $this->load->view('admin/membership');
        } else {
            redirect('admin/super_admin');
        }
    }

    function get_membership_data() {
        $result = $this->Super_admin_model->insert_membership_data();
        if ($result == true) {
            $this->session->set_flashdata('succss_msg', 'Membership added successfully !');
            redirect('admin/super_admin/membership');
        }
    }

    function seller_commission() {
        if ($this->session->userdata('logged_in')) {
            $this->load->view('admin/seller_commission');
        } else {
            redirect('admin/super_admin');
        }
    }

    function global_commission() {
        if ($this->session->userdata('logged_in')) {
            //$data['category_n_gcomisn_result'] = $this->Super_admin_model->retrieve_2nd_leable_product_category_wth_global_commission();
            $data['category_n_gcomisn_result'] = $this->Super_admin_model->retrieve_3rd_leable_product_category_wth_global_commission();
            $this->load->view('admin/global_commission', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function insert_update_global_commission() {
        $result = $this->Super_admin_model->insert_update_inn_global_commission();
        if ($result == true) {
            echo 'success';
        } else {
            echo 'not';
        }
    }

    function membership_commission() {
        if ($this->session->userdata('logged_in')) {
            $data['membership_plan_result'] = $this->Super_admin_model->retrieve_membership_details();
            $this->load->view('admin/membership_commission', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function load_membershp_plan_commission() {
        $memb_column = $this->input->post('memb_column');
        //$data['category_n_membcommission_result'] = $this->Super_admin_model->retrieve_2nd_leable_product_category_wth_memb_commission($memb_column);
        $data['category_n_membcommission_result'] = $this->Super_admin_model->retrieve_3rd_leable_product_category_wth_memb_commission($memb_column);
        $this->load->view('admin/load_membrship_plan_commossion', $data);
    }

    function insert_update_membership_commission() {
        $result = $this->Super_admin_model->insert_update_inn_membership_commission();
        if ($result == true) {
            echo 'success';
        } else {
            echo 'not';
        }
    }

    function special_commission() {
        if ($this->session->userdata('logged_in')) {
            $data['seller_result'] = $this->Super_admin_model->retrieve_seller_name();
            $data['special_comsn_result'] = $this->Super_admin_model->retrieve_special_commission_details();
            $this->load->view('admin/special_commission', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function load_special_commission() {
        $result = $this->Super_admin_model->check_special_commission_date_range();
        if ($result != false) {
            //$data['category_result'] = $this->Super_admin_model->retrieve_2nd_leable_product_category();
            $data['category_result'] = $this->Super_admin_model->retrieve_3rd_leable_product_category();
            $this->load->view('admin/load_special_commossion', $data);
        } else {
            echo 'not';
        }
    }

    function add_special_commission() {
        if ($this->session->userdata('logged_in')) {
            $data['seller_result'] = $this->Super_admin_model->retrieve_seller_name();
            $this->load->view('admin/add_special_commission', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function save_special_commission() {
        $result = $this->Super_admin_model->insert_inn_special_commission();
        if ($result == true) {
            echo 'success';
        } else {
            echo 'not';
        }
    }

    function charges() {
        if ($this->session->userdata('logged_in')) {
            $data['fixed_chrgs_result'] = $this->Super_admin_model->retrieve_fixed_charges();
            $data['pg_chrgs_result'] = $this->Super_admin_model->retrieve_pg_charges();
            $data['season_chrgs_result'] = $this->Super_admin_model->retrieve_season_charges();
            $data['ordr_cancel_penlty_result'] = $this->Super_admin_model->retrieve_ordr_cancel_penlty_charges();
            $data['ordr_notprocess_penlty_result'] = $this->Super_admin_model->retrieve_ordr_notprocess_penlty_charges();
            $data['ordr_shpngdely_penlty_result'] = $this->Super_admin_model->retrieve_shpngdely_penlty_charges();
            $this->load->view('admin/other_charges', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function get_fixed_charges() {
        $result = $this->Super_admin_model->insert_update_fixed_charges_data();
        if ($result == true) {
            $this->session->set_flashdata('fixed_chargs_succ_msg', 'Saved Successfully !');
            redirect("admin/super_admin/charges");
        }
    }

    function get_pg_charges() {
        $result = $this->Super_admin_model->insert_update_pg_charges_data();
        if ($result == true) {
            $this->session->set_flashdata('pg_chargs_succ_msg', 'Saved Successfully !');
            redirect("admin/super_admin/charges");
        }
    }

    function get_seasonal_charges() {
        $result = $this->Super_admin_model->insert_update_season_charges_data();
        if ($result == true) {
            $this->session->set_flashdata('season_chargs_succ_msg', 'Saved Successfully !');
            redirect("admin/super_admin/charges");
        }
    }

    function cancel_penalty_charges() {
        $result = $this->Super_admin_model->insert_update_cancel_charges_data();
        if ($result == true) {
            $this->session->set_flashdata('cancel_chargs_succ_msg', 'Saved Successfully !');
            redirect("admin/super_admin/charges");
        }
    }

    function order_not_process_penalty_charges() {
        $result = $this->Super_admin_model->insert_update_order_not_process_charges_data();
        if ($result == true) {
            $this->session->set_flashdata('not_process_chargs_succ_msg', 'Saved Successfully !');
            redirect("admin/super_admin/charges");
        }
    }

    function ship_delay_penalty_charges() {
        $result = $this->Super_admin_model->insert_update_ship_delay_charges_data();
        if ($result == true) {
            $this->session->set_flashdata('ship_delay_chargs_succ_msg', 'Saved Successfully !');
            redirect("admin/super_admin/charges");
        }
    }

    function edit_special_commission() {
        if ($this->session->userdata('logged_in')) {
            $data['seller_result'] = $this->Super_admin_model->retrieve_seller_name();
            //$data['category_result'] = $this->Super_admin_model->retrieve_2nd_leable_product_category();
            $data['spl_commission_result'] = $this->Super_admin_model->edit_inn_special_commission();
            $this->load->view('admin/edit_special_commission', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function update_special_commission() {
        $result = $this->Super_admin_model->update_inn_special_commission();
        if ($result == true) {
            echo 'success';
            exit;
        }
    }

    function delete_special_commission() {
        $result = $this->Super_admin_model->delete_special_commission();
        if ($result == true) {
            echo 'success';
            exit;
        }
    }

    function user_setup() {

        if ($this->session->userdata('logged_in')) {

            //$this->load->view('admin/user_setup_setting');
            $this->load->model('admin/User_role_setup_model');
            $user_data['user_info'] = $this->User_role_setup_model->select_user_data();
            $this->load->view('admin/manage_user_role', $user_data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function new_user_setup() {

        if ($this->session->userdata('logged_in')) {

            $this->load->view('admin/user_setup_setting');
        } else {
            redirect('admin/super_admin');
        }
    }

    function user_log() {

        if ($this->session->userdata('logged_in')) {


            $user_data['name'] = $this->input->post('name');
            $user_data['user_status'] = $this->input->post('user_status');
            $user_data['user_type'] = $this->input->post('user_type');
            $user_data['contactno'] = $this->input->post('contactno');
            $user_data['email'] = $this->input->post('email');
            $user_data['logintime_from_1'] = $this->input->post('logintime_from_1');
            $user_data['logintime_to_1'] = $this->input->post('logintime_to_1');

            $config = array();
            $config["base_url"] = base_url() . "admin/super_admin/user_log";
            $config["total_rows"] = $this->User_role_setup_model->select_user_logdata_count();
            $config["per_page"] = 20;
            $config["uri_segment"] = 3;
            //$config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];

            //$config["num_links"] = round($choice);
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $user_data['user_info'] = $this->User_role_setup_model->select_user_logdata($config["per_page"], $page);
            //$data['result'] = $this->Product->retrive_product_details_catalog($config["per_page"], $page);
            $user_data['links'] = $this->pagination->create_links();

            //$data['result'] = $this->Product->retrive_product_details();
            //$data['result_attr_group'] = $this->Product->retrive_product_attribute_group();
            $this->load->view('admin/user_log_list', $user_data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function filter_userlog() {
        if ($this->session->userdata('logged_in')) {
            //$order_data['user_id'] = $_REQUEST['user_id'];
            $data['name'] = $_REQUEST['name'];
            $data['user_status'] = $_REQUEST['user_status'];
            $data['user_type'] = $_REQUEST['user_type'];
            $data['contactno'] = $_REQUEST['contactno'];
            $data['email'] = $_REQUEST['email'];
            //$user_data['logintime_from_1'] = $_REQUEST['logintime_from_1'];
            //$user_data['logintime_to_1'] = $_REQUEST['logintime_to_1'];

            $config = array();
            $config["base_url"] = base_url() . "admin/super_admin/filter_userlog";
            $config["total_rows"] = $this->User_role_setup_model->select_filter_user_count();
            $config["per_page"] = 20;
            $config["uri_segment"] = 3;
            $config["page_query_string"] = TRUE;
            $config['enable_query_strings'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];
            //$config["num_links"] = round($choice);
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['suffix'] = '&name=' . $data['name'] . '&user_status=' . $data['user_status'] . '&user_type=' . $data['user_type'] . '&contactno=' . $data['contactno'] . '&email=' . $data['email'];
            //'&user_id='.$order_data['user_id'].
            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $data['user_info'] = $this->User_role_setup_model->select_filtered_user($config["per_page"], $page);
            //$data['user_info']= $this->User_role_setup_model->select_filtered_user($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();

            $this->load->view('admin/user_log_list', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    /* {
      if($this->session->userdata('logged_in'))
      {
      $this->load->model('admin/User_role_setup_model');
      //$user_data['user_info']=$this->User_role_setup_model->select_user_data();
      $user_data['user_info']=$this->User_role_setup_model->select_user_logdata();
      $this->load->view('admin/user_log_list',$user_data);
      }
      else{
      redirect('admin/super_admin');
      }
      } */

    function voucher() {
        if ($this->session->userdata('logged_in')) {
            $data['voucher_details'] = $this->Super_admin_model->retrieve_voucher_details();
            $this->load->view('admin/voucher_create', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function get_voucher_data() {
        $data['result'] = $this->Super_admin_model->insert_voucher_data();
        redirect('admin/super_admin/voucher');
    }

    function delete_voucher() {
        $result = $this->Super_admin_model->delete_inn_voucher_data();
        if ($result == true) {
            echo 'success';
        }
    }

    function email_log() {
        if ($this->session->userdata('logged_in')) {
            $email['toemail_id'] = $this->input->post('toemail_id');
            $email['fromemail_id'] = $this->input->post('fromemail_id');
            $email['subject'] = $this->input->post('subject');
            $email['date'] = $this->input->post('date');
            $email['email_status'] = $this->input->post('email_status');

            $config = array();
            $config["base_url"] = base_url() . "admin/super_admin/email_log";
            $config["total_rows"] = $this->Super_admin_model->retrieve_emailog_count();
            $config["per_page"] = 20;
            $config["uri_segment"] = 3;
            //$config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];

            //$config["num_links"] = round($choice);
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $email['data'] = $this->Super_admin_model->retrieve_emailog($config["per_page"], $page);
            //$data['result'] = $this->Product->retrive_product_details_catalog($config["per_page"], $page);
            $email['links'] = $this->pagination->create_links();

            //$data['result'] = $this->Product->retrive_product_details();
            //$data['result_attr_group'] = $this->Product->retrive_product_attribute_group();
            $this->load->view('admin/emaillog_list', $email);
        } else {
            redirect('admin/super_admin');
        }
    }

    function filter_emaillog() {
        if ($this->session->userdata('logged_in')) {
            //$order_data['user_id'] = $_REQUEST['user_id'];
            $data['toemail_id'] = $_REQUEST['toemail_id'];
            $data['fromemail_id'] = $_REQUEST['fromemail_id'];
            $data['subject'] = $_REQUEST['subject'];
            $data['date'] = $_REQUEST['date'];
            $data['email_status'] = $_REQUEST['email_status'];

            $config = array();
            $config["base_url"] = base_url() . "admin/super_admin/filter_emaillog";
            $config["total_rows"] = $this->Super_admin_model->select_filter_emaillog_count();
            $config["per_page"] = 20;
            $config["uri_segment"] = 3;
            $config["page_query_string"] = TRUE;
            $config['enable_query_strings'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];
            //$config["num_links"] = round($choice);
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['suffix'] = '&toemail_id=' . $data['toemail_id'] . '&fromemail_id=' . $data['fromemail_id'] . '&subject=' . $data['subject'] . '&date=' . $data['date'] . '&email_status=' . $data['email_status'];
            //'&user_id='.$order_data['user_id'].
            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

            $data['data'] = $this->Super_admin_model->select_filtered_emaillog($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();

            $this->load->view('admin/emaillog_list', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    /* {
      if($this->session->userdata('logged_in')){
      $email['data']=$this->Super_admin_model->retrieve_emailog();
      $this->load->view('admin/emaillog_list', $email);

      }else{
      redirect('admin/super_admin');
      }

      } */

    function errorlog() {
        if ($this->session->userdata('logged_in')) {
            $this->load->helper("file");
            $err['data'] = $this->Super_admin_model->retrieve_errorlog();
            $this->load->view('admin/errorlog_list', $err);
        } else {
            redirect('admin/super_admin');
        }
    }

    function pcmenu_setup() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('admin/Manage_category_model');

            $res['data2'] = $this->Manage_category_model->select_desktopcategory_list();
            //$res['catglist_data']=$this->Manage_category_model->select_parentcategory_list();
            $res['category_result'] = $this->Manage_category_model->retrieve_category();
            $res['pcmenu_edit'] = '';
            $this->load->view('admin/pc_categorymenu_setup', $res);
        } else {
            redirect('admin/super_admin');
        }
    }

    function manual_urldatafeedfordesktop() {
        $this->load->model('admin/Manage_category_model');
        $this->Manage_category_model->select_desktopmenuforurl_list();
    }

    function mobilemenu_setup() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('admin/Manage_category_model');

            $res['data2'] = $this->Manage_category_model->select_mobilemenu_list();
            //$res['catglist_data']=$this->Manage_category_model->select_parentcategory_list();
            $res['category_result'] = $this->Manage_category_model->retrieve_category();
            $res['mobilemenu_edit'] = '';


            $this->load->view('admin/mobile_categorymenu_setup', $res);
        } else {
            redirect('admin/super_admin');
        }
    }

    function add_newmenu() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('admin/Manage_category_model');
            $this->Manage_category_model->add_newpcmenu();
            redirect('admin/Super_admin/pcmenu_setup');
        } else {
            redirect('admin/super_admin');
        }
    }

    function add_newmobilemenu() {
        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Manage_category_model');
            $this->Manage_category_model->add_newmobilemenu();

            redirect('admin/Super_admin/mobilemenu_setup');
        } else {
            redirect('admin/super_admin');
        }
    }

    function edit_pcmenu() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('admin/Manage_category_model');

            $lablid_pcmenu = $this->uri->segment(4);

            $res['pcmenu_edit'] = $this->Manage_category_model->edit_pcmenu($lablid_pcmenu);
            $res['pcmenu_orderby'] = $this->Manage_category_model->edit_pcmenu_orderby($lablid_pcmenu);

            $res['data2'] = $this->Manage_category_model->select_desktopcategory_list();
            $res['category_result'] = $this->Manage_category_model->retrieve_category();


            $this->load->view('admin/editpc_categorymenu_setup', $res);

            //redirect('admin/Super_admin/pcmenu_setup');
        } else {
            redirect('admin/super_admin');
        }
    }

    function edit_mobilemenu() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('admin/Manage_category_model');

            $lablid_pcmenu = $this->uri->segment(4);

            $res['pcmenu_edit'] = $this->Manage_category_model->edit_mobilemenu($lablid_pcmenu);
            $res['pcmenu_orderby'] = $this->Manage_category_model->edit_mobilemenu_orderby($lablid_pcmenu);

            $res['data2'] = $this->Manage_category_model->select_mobilemenu_list();
            $res['category_result'] = $this->Manage_category_model->retrieve_category();


            $this->load->view('admin/editmobile_categorymenu_setup', $res);

            //redirect('admin/Super_admin/pcmenu_setup');
        } else {
            redirect('admin/super_admin');
        }
    }

    function remove_pccategorylink() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('admin/Manage_category_model');
            $this->Manage_category_model->remove_pccatglink();
        } else {
            redirect('admin/super_admin');
        }
    }

    function remove_mobilecategorylink() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('admin/Manage_category_model');
            $this->Manage_category_model->remove_mobilecatglink();
        } else {
            redirect('admin/super_admin');
        }
    }

    function update_pcmenusetup() {
        if ($this->session->userdata('logged_in')) {
            $lbl_id = $this->input->post('lbl_id');
            $this->load->model('admin/Manage_category_model');
            $this->Manage_category_model->update_pcmenuinfo();

            redirect('admin/super_admin/edit_pcmenu/' . $lbl_id);
        } else {
            redirect('admin/super_admin');
        }
    }

    function update_mobilemenusetup() {
        if ($this->session->userdata('logged_in')) {
            $lbl_id = $this->input->post('lbl_id');
            $this->load->model('admin/Manage_category_model');
            $this->Manage_category_model->update_mobilemenuinfo();

            redirect('admin/super_admin/edit_mobilemenu/' . $lbl_id);
        } else {
            redirect('admin/super_admin');
        }
    }

    function remov_menuimg() {
        if ($this->session->userdata('logged_in')) {
            $lbl_id = $this->input->post('menu_sqlid');
            $this->load->model('admin/Manage_category_model');
            $this->Manage_category_model->remove_mobilemenuimage();

            redirect('admin/super_admin/edit_mobilemenu/' . $lbl_id);
        } else {
            redirect('admin/super_admin');
        }
    }

    function delete_pcmenu() {
        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Manage_category_model');
            $mnb_lblid = $this->uri->segment(4);
            $this->Manage_category_model->delete_pcmenuinfo($mnb_lblid);

            redirect('admin/Super_admin/pcmenu_setup');
        } else {
            redirect('admin/super_admin');
        }
    }

    function delete_mobilemenu() {
        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Manage_category_model');
            $mnb_lblid = $this->uri->segment(4);
            $this->Manage_category_model->delete_mobilemenuinfo($mnb_lblid);

            redirect('admin/Super_admin/mobilemenu_setup');
        } else {
            redirect('admin/super_admin');
        }
    }

    function cod_setup() {
        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Config_model');
            $data['codwtcharges'] = $this->Config_model->select_codchargesasweight();

            $this->load->view('admin/cod_setupforproduct', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function add_codchargesasperweight() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('admin/Config_model');
            $this->Config_model->addnew_codchargesasperweight();

            $this->session->set_flashdata('msgcod_wtchrg', 'Data Saved Successfully');

            redirect('admin/super_admin/cod_setup');
        } else {
            redirect('admin/super_admin');
        }
    }

    public function edit_codchargesasperweight() {
        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Config_model');
            $this->Config_model->edit_codchargesasperweight();

            $this->session->set_flashdata('msgcod_wtchrg', 'Data Saved Successfully');

            redirect('admin/super_admin/cod_setup');
        } else {
            redirect('admin/super_admin');
        }
    }

    public function delete_codchargesasperweight() {
        if ($this->session->userdata('logged_in')) {


            $this->load->model('admin/Config_model');
            $this->Config_model->delete_codchargesasperweight();

            $this->session->set_flashdata('msgcod_wtchrg', 'Data Deleted Successfully');

            //redirect('admin/super_admin/cod_setup');		
        } else {
            redirect('admin/super_admin');
        }
    }

    function size_setup() {
        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Config_model');
            $data['sizesetup'] = $this->Config_model->select_size();

            $this->load->view('admin/size_setup', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function add_sizes() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('admin/Config_model');
            $this->Config_model->addnew_sizes();

            $this->session->set_flashdata('msgcod_wtchrg', 'Data Saved Successfully');

            redirect('admin/super_admin/size_setup');
        } else {
            redirect('admin/super_admin');
        }
    }

    public function edit_sizes() {
        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Config_model');
            $this->Config_model->edit_sizes();

            $this->session->set_flashdata('msgcod_wtchrg', 'Data Saved Successfully');

            redirect('admin/super_admin/size_setup');
        } else {
            redirect('admin/super_admin');
        }
    }

    function color_setup() {
        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Config_model');
            $data['colorsetup'] = $this->Config_model->select_color();

            $this->load->view('admin/color_setup', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function add_colors() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('admin/Config_model');
            $this->Config_model->addnew_colors();

            $this->session->set_flashdata('msgcod_wtchrg', 'Data Saved Successfully');

            redirect('admin/super_admin/color_setup');
        } else {
            redirect('admin/super_admin');
        }
    }

    public function edit_colors() {
        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Config_model');
            $this->Config_model->edit_colors();

            $this->session->set_flashdata('msgcod_wtchrg', 'Data Saved Successfully');

            redirect('admin/super_admin/color_setup');
        } else {
            redirect('admin/super_admin');
        }
    }

    function cod_taxrate_setup() {
        if ($this->session->userdata('logged_in')) {

            $this->load->model('Usermodel');
            $data['state_result'] = $this->Usermodel->retrive_state();

            $this->load->model('admin/Config_model');
            $data['codwtcharges'] = $this->Config_model->select_codtaxrate();

            $this->load->view('admin/cod_taxraetesetupforproduct', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function add_codtaxcharges() {
        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Config_model');
            $this->Config_model->addnew_codtaxcharges();

            $this->session->set_flashdata('msgcod_wtchrg', 'Data Saved Successfully');

            redirect('admin/super_admin/cod_taxrate_setup');
        } else {
            redirect('admin/super_admin');
        }
    }

    function saveedited_codtaxcharges() {
        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Config_model');
            $this->Config_model->update_codtaxcharges();

            $this->session->set_flashdata('msgcod_wtchrg', 'Data Saved Successfully');
            redirect('admin/super_admin/cod_taxrate_setup');
        } else {
            redirect('admin/super_admin');
        }
    }

    function delete_taxcharges() {
        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Config_model');
            $this->Config_model->delete_taxcharges();

            $this->session->set_flashdata('msgcod_wtchrg', 'Data Deleted Successfully');

            //redirect('admin/super_admin/cod_setup');			
        } else {
            redirect('admin/super_admin');
        }
    }

    function cod_amounttocharge_setup() {
        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Config_model');
            $data['codwtcharges'] = $this->Config_model->select_codtobecharged();

            $this->load->view('admin/cod_setupforchargedapplied', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function edit_codtobecharged() {
        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Config_model');
            $this->Config_model->update_codtobcherged();
            $this->session->set_flashdata('msgcod_wtchrg', 'Data Saved Successfully');
            redirect('admin/super_admin/cod_amounttocharge_setup');
        } else {
            redirect('admin/super_admin');
        }
    }

    function cod_discount_setup() {

        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Config_model');
            $data['codwtcharges'] = $this->Config_model->select_coddiscountlist();

            $this->load->view('admin/cod_discountsetup', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function cateattributelink() {
        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Config_model');
            $data['attrlink'] = $this->Config_model->select_attrilink();
            $data['cateattr_link'] = '';
            $this->load->view('admin/category_attributelink', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function add_attrilink() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('admin/Config_model');
            $this->Config_model->addnew_attrilink();

            $this->session->set_flashdata('msgcod_wtchrg', 'Data Saved Successfully');

            redirect('admin/super_admin/cateattributelink');
        } else {
            redirect('admin/super_admin');
        }
    }

    function remove_attrilink() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('admin/Config_model');
            $this->Config_model->delete_allattrilink();
        } else {
            redirect('admin/super_admin');
        }
    }

    function remove_oneattrilink() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('admin/Config_model');
            $this->Config_model->remove_oneattrilink();
        } else {
            redirect('admin/super_admin');
        }
    }

    function add_coddiscount() {
        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Config_model');

            $this->Config_model->add_coddiscountpercentage();
            $this->session->set_flashdata('msgcod_wtchrg', 'Data Saved Successfully');

            redirect('admin/super_admin/cod_discount_setup');
        } else {
            redirect('admin/super_admin');
        }
    }

    function edit_coddiscount() {
        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Config_model');

            $this->Config_model->update_coddiscountpercentage();
            $this->session->set_flashdata('msgcod_wtchrg', 'Data Saved Successfully');

            redirect('admin/super_admin/cod_discount_setup');
        } else {
            redirect('admin/super_admin');
        }
    }

    function delete_coddiscountpercentage() {
        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Config_model');

            $this->Config_model->delete_discountpercentage();
            $this->session->set_flashdata('msgcod_wtchrg', 'Data Deleted Successfully');
        } else {
            redirect('admin/super_admin');
        }
    }

    function getattribute_menuwise() {
        $attr_menuwise = $this->input->post('subcategory_id');
        //echo $attr_menuwise;exit;
        $this->load->model('admin/Bulkporductupload_model');
        $data['attrbset_data'] = $this->Bulkporductupload_model->getattributeset($attr_menuwise);
        $this->load->view('admin/attribute_menuajax', $data);
    }

    function productfilter_setup() {
        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Seller_model');
            $data['categories'] = $this->Seller_model->getCategories();
            //$this->load->model('admin/Bulkporductupload_model');
            //$data['attrbset'] = $this->Bulkporductupload_model->getattributeset();
            //$data['seller_id']=$this->uri->segment(4);	
            //$this->load->view('admin/upload_bulkproductfor_single_seller',$data);

            $this->load->view('admin/productfilter_setup', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function showall_attribute() {

        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Config_model');
            $data['attrb_subset'] = $this->Config_model->selectall_subattributeid();

            $catgid = $this->input->post('subcategory_id');

            $data['attrb_catg'] = $this->Config_model->check_filterdata($catgid);
            $ctr = $data['attrb_catg'];
            if ($ctr->num_rows() > 0) {
                $this->load->view('admin/editallattributefor_filtersetup', $data);
            } else {
                $this->load->view('admin/allattributefor_filtersetup', $data);
            }
        } else {
            redirect('admin/super_admin');
        }
    }

    function save_filterdata() {
        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Config_model');
            $this->Config_model->save_productfilterdata();
            $this->session->set_flashdata('msgcod_wtchrg', 'Data Saved Successfully');
        } else {
            redirect('admin/super_admin');
        }
    }

    function advance_productsearch() {
        if ($this->session->userdata('logged_in')) {

            //$this->load->model('admin/Bulk_productdeletemodel');
            //$data['srch_catg']=$this->Bulk_productdeletemodel->select_allcategory();
            //$data['srch_attrb']=$this->Bulk_productdeletemodel->select_allattrb();
            //$this->load->view('admin/advance_filterdisplay',$data);
            //$this->load->model('admin/Advance_search_model');
            //$data['srch_attrb']=$this->Advance_search_model->crta_maintemptable();

            $this->load->view('admin/advance_filterdisplay');
        } else {
            redirect('admin/super_admin');
        }
    }

    function showall_attributeforadvancesearch() {

        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Config_model');
            $data['attrb_subset'] = $this->Config_model->selectall_subattributeid();

            $catgid = $this->input->post('subcategory_id');


            $this->load->view('admin/advance_search/attributefield_foradvancesearch', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function show_allattributefieldname() {

        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Config_model');
            $data['attrb_subset'] = $this->Config_model->selectall_subattributeid();

            $catgid = $this->input->post('subcategory_id');


            $this->load->view('admin/advance_search/allattributefield_foradvancesearch', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

}

?>