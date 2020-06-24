<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_role_setup extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
        $this->load->library('form_validation');
        $this->load->library('email');
        
        $this->load->library('encrypt');
        $this->load->library('javascript');
        
        $this->load->library('pagination');
        $this->load->model('admin/User_role_setup_model');
    }

    function index() {
        if ($this->session->userdata('logged_in')) {
            $this->User_role_setup_model->insert_user_role();

            redirect('admin/User_role_setup/load_user_setup_setting');
        } else {
            redirect('admin/super_admin');
        }
    }

    function load_user_setup_setting() {
        if ($this->session->userdata('logged_in')) {
            $user_data['user_info'] = $this->User_role_setup_model->select_user_data();
            $this->load->view('admin/manage_user_role', $user_data);

            //$this->load->view('admin/user_setup_setting');
        } else {
            redirect('admin/super_admin');
        }
    }

    function edit_user_role() {
        if ($this->session->userdata('logged_in')) {
            $user_role_id = $this->uri->segment(4);
            $user_data['user_role_info'] = $this->User_role_setup_model->select_user_roledata($user_role_id);
            $this->load->view('admin/user_role_setup_edit', $user_data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function update_user_roles() {
        if ($this->session->userdata('logged_in')) {
            $user_role_id = $this->uri->segment(4);
            $this->User_role_setup_model->update_user_rolesetup($user_role_id);

            redirect('admin/User_role_setup/load_user_setup_setting');
        } else {
            redirect('admin/super_admin');
        }
    }

    function delete_user_role() {
        if ($this->session->userdata('logged_in')) {

            $user_role_id = $this->uri->segment(4);
            $this->User_role_setup_model->delete_user_rolesetup($user_role_id);

            redirect('admin/User_role_setup/load_user_setup_setting');
        } else {
            redirect('admin/super_admin');
        }
    }

    function active_user_role() {
        if ($this->session->userdata('logged_in')) {
            $user_role_id = $this->uri->segment(4);
            $this->User_role_setup_model->active_userrole($user_role_id);

            redirect('admin/User_role_setup/load_user_setup_setting');
        } else {
            redirect('admin/super_admin');
        }
    }

    function inactive_user_role() {
        if ($this->session->userdata('logged_in')) {
            $user_role_id = $this->uri->segment(4);
            $this->User_role_setup_model->inactive_userrole($user_role_id);

            redirect('admin/User_role_setup/load_user_setup_setting');
        } else {
            redirect('admin/super_admin');
        }
    }

    function user_log_details() {
        if ($this->session->userdata('logged_in')) {

            $user_log_id = $this->uri->segment(4);
            $data_user_log['user_log_detail'] = $this->User_role_setup_model->select_userrole($user_log_id);

            $this->load->view('admin/user_logdetails_asper_userid', $data_user_log);
        } else {
            redirect('admin/super_admin');
        }
    }

}
