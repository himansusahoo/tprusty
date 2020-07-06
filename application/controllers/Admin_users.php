<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user');
        $this->load->library('form_validation');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
        $this->load->model('dashboard');
    }

    /**
     * @param  : NA
     * @desc   : lising the users
     * @return : NA
     * @author : himansus
     */
    public function index() {
        if (!$this->rbac->is_login()) {
            redirect(base_url('employee-login'));
        } else {
            
        }
        $this->layout->render();
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author :
     */
    public function sign_in() {
        $this->scripts_include->includePlugins(array('jq_validation'), 'js');
        $this->load->library('rbac/rbac_user');
        $this->layout->layout = 'blank_layout';
        if ($this->input->post()) {
            //server side validation
            $rules = array(
                array(
                    'field' => 'user_email',
                    'label' => 'Email',
                    'rules' => 'required|valid_email'
                ),
                array(
                    'field' => 'user_pass',
                    'label' => 'Password',
                    'rules' => 'required'
                )
            );
            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run() == TRUE) {

                $email = $this->input->post('user_email');
                $pass = $this->input->post('user_pass');
                $condition = "email='$email' and password='" . md5($pass) . "' and user_type in('employee','developer','admin','seller')";
                $user_detail = $this->user->get_user_detail(null, $condition);
                //pma($user_detail, 1);
                if ($user_detail) {
                    if (isset($user_detail['status']) && $user_detail['status'] == 'active') {
                        $menus = $permissions = array();
                        if (in_array('DEVELOPER', $user_detail['role_codes'])) {
                            //fetch all the permissions
                            $condition = '';
                            $permissions = $this->rbac_role_permission->get_rbac_role_permission_lib(null, null, TRUE);
                        } else {
                            //fetch only assigned permissions
                            $role_ids = array_column($user_detail['roles'], 'role_id');
                            if ($role_ids) {
                                $condition = 'rrp.role_id IN(' . implode(',', $role_ids) . ')';
                                $permissions = $this->rbac_role_permission->get_rbac_role_permission_lib(null, $condition);
                            }
                        }
                        //get app configs
                        $condition=" AND category IN('RBAC','EMPLOYEE')";
                        $app_configs = $this->rbac_user->get_app_configs($condition);
                        //remove action list, does not required her..
                        unset($permissions['action_list']);
                        $user_detail['permissions'] = $permissions;
                        $user_detail['permission_modules'] = array_keys($permissions);
                        $user_detail['app_configs'] = $app_configs;
                        $this->session->set_userdata('user_data', $user_detail);

                        //collect dashboard deta
                        $this->session->set_userdata('logged_in', $user_detail['email']);
                        $data['tot_prdqnt'] = $this->dashboard->graph_data_totprdqnt();
                        $data['results'] = $this->dashboard->get_chart_data(); //chart data access end
                        $data['deliver_count'] = $this->dashboard->get_delivered_ordercount();
                        $data['cancel_count'] = $this->dashboard->get_Cancelled_ordercount();
                        $data['confirm_count'] = $this->dashboard->get_confirmed_ordercount();
                        $data['undelivered_count'] = $this->dashboard->get_Undelivered_ordercount();
                        $data['return_count'] = $this->dashboard->get_return_ordercount();
                        $data['order_confirm'] = $this->dashboard->count_orderconfirmed();
                        $data['seller_weekly_sale'] = $this->dashboard->get_seller_sale_weekly();
                        $data['moonboy_sale'] = $this->dashboard->get_moonboy_turnover_monthly();
                
                        //change the redirect url string based on the user type.
                        $redirect = $this->rbac->get_admin_dashboard_url();
                        $this->breadcrumbs->home($redirect);
                        redirect($redirect);
                    } else {
                        $this->session->set_flashdata('error', 'You are not authorised to access the application.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Invalid login credentials.');
                }
            }
        }
        $this->layout->render();
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author :
     */
    public function dashboard() {
        if (!$this->rbac->is_login()) {
            redirect(base_url('employee-login'));
        } else {
            //pma($this->session->all_userdata(),1);
            //$this->layout->navTitle='test title';
            $this->layout->layout = 'admin_layout';
            $this->layout->title = 'Dashboard';
            $data = array();
            $this->layout->data = $data;
            $this->breadcrumbs->push('dashboard', base_url('employee-dashboard'));
            //$this->layout->navTitleFlag=0;
            $this->layout->breadcrumbsFlag = 0;
            $this->layout->render();
        }
    }

    /**
     * @param  : 
     * @desc   :
     * @return :
     * @author :
     */
    public function sign_out() {
        $this->session->unset_userdata('user_data');
        $this->session->unset_userdata('selected_left_menu');
        $this->session->unset_userdata('logged_in');
        $admin_login=base_url('admin-login');
        redirect($admin_login);
    }

}
