<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class App_configs extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('app_config');
        $this->load->library('form_validation');
        $this->layout->layout = 'admin_lte';
        $this->layout->layoutsFolder = 'layouts/admin_lte';
    }

    public function index() {
        $this->breadcrumbs->push('edit', base_url('manage-app-configs'));
        $this->scripts_include->includePlugins(array('bs_timepicker', 'jq_multitag_select'), 'css');
        $this->scripts_include->includePlugins(array('jq_validation', 'jq_multitag_select'), 'js');
        $this->layout->navTitle = 'Manage App configs';
        $this->layout->title = 'Manage App configs';
        $db_configs = $this->app_config->get_app_config();
        //pma($db_configs,1);
        $role_codes = $this->app_config->get_role_code_list();
        $role_codes = flattenArray($role_codes);

        $data = array('data' => array());
        $configs = $new_roles = array();

        foreach ($db_configs as $key => $rec) {
            $configs[strtolower($rec['category'])] = json_decode($rec['configs'], true);
        }
        //pma($configs,1);
        //manage role priorities
        if (isset($configs['rbac']['role_priority']) && $configs['rbac']['role_priority'] != '') {

            //add new roles with existing
            $new_roles = array_diff($role_codes, $configs['rbac']['role_priority']);
            $new_roles = flattenArray($new_roles);
            foreach ($new_roles as $role_code) {
                array_push($configs['rbac']['role_priority'], $role_code);
            }
        } else {
            //php 7.3.2 compatibility
            if (!isset($configs['rbac'])) {
                $configs['rbac'] = array();
                if (!isset($configs['rbac']['role_priority'])) {
                    $configs['rbac']['role_priority'] = array();
                }
            }
            $configs['rbac']['role_priority'] = $role_codes;
            $new_roles = $role_codes;
        }
        
        //manage reports configs
       
        $info_view_columns=$this->db->list_fields('order_info_vw_materialized');
        asort($info_view_columns);
        $data['order_info_view_fields'] = $info_view_columns;
        //pma($configs, 1);
        $data['data'] = $configs;
        $data['data']['new_roles'] = $new_roles;
        $data['data']['all_role_codes'] = $role_codes;
        //pma($data,1);
        //manage selected book qrcode columns
        

        $this->layout->data = $data;
        $this->layout->render();
    }

    public function save_configs() {
        $this->scripts_include->includePlugins(array('bs_timepicker'), 'css');
        $this->scripts_include->includePlugins(array('jq_validation', 'bs_timepicker'), 'js');
        $data = array();

        if ($this->input->post()):
            $post_data = $this->input->post();            
            //add block specific conditions
            if ($post_data['app_configs_category'] == 'RBAC') {
                if ($post_data['app_configs']['role_priority']) {
                    $role_priority = $post_data['app_configs']['role_priority'];
                    $role_priority = trim($role_priority, ',');
                    $post_data['app_configs']['role_priority'] = explode(',', $role_priority);
                }
            }
            
            $result = $this->app_config->save_config($post_data);
            if ($result):
                $this->session->set_flashdata('success', 'Record successfully updated!');
                redirect(base_url('manage-app-configs'));
            else:
                $this->session->set_flashdata('error', 'Unable to store the data, please conatact site admin!');
            endif;

        endif;

        $this->layout->data = $data;
        $this->layout->render();
    }

}
