<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class App_configs extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('app_config');
        $this->load->library('form_validation');
        $this->layout->layout = 'admin_layout';
        $this->layout->layoutsFolder = 'layouts/admin';
    }

    public function index() {
        $this->breadcrumbs->push('edit', base_url('manage-app-configs'));
        $this->scripts_include->includePlugins(array('bs_timepicker', 'jq_multitag_select'), 'css');
        $this->scripts_include->includePlugins(array('jq_validation', 'jq_multitag_select'), 'js');
        $this->layout->navTitle = 'Manage App configs';
        $this->layout->title = 'Manage App configs';
        $db_configs = $this->app_config->get_app_config();

        $role_codes = $this->app_config->get_role_code_list();
        $role_codes = flattenArray($role_codes);

        $data = array('data' => array());
        $configs = $new_roles = array();

        foreach ($db_configs as $key => $rec) {
            $configs[strtolower($rec['category'])] = json_decode($rec['configs'], true);
        }
        //pma($configs);
        //manage role priorities
        if (isset($configs['chm_app']['role_priority']) && $configs['chm_app']['role_priority']!='') {
            
            //add new roles with existing
            $new_roles = array_diff($role_codes, $configs['chm_app']['role_priority']);
            $new_roles = flattenArray($new_roles);
            foreach ($new_roles as $role_code) {
                array_push($configs['chm_app']['role_priority'], $role_code);
            }
        } else {
            //php 7.3.2 compatibility
            if (!isset($configs['chm_app'])) {
                $configs['chm_app'] = array();
                if (!isset($configs['chm_app']['role_priority'])) {
                    $configs['chm_app']['role_priority'] = array();
                }
            }
            $configs['chm_app']['role_priority'] = $role_codes;
            $new_roles = $role_codes;
        }

        //pma($configs, 1);
        $data['data'] = $configs;
        $data['data']['new_roles'] = $new_roles;
        $data['data']['qrcode_columns'] = $this->config->item('LIB_BOOK_QR_COLUMNS_JSON');
        $data['data']['all_role_codes']=$role_codes;
        //manage selected book qrcode columns
        if (isset($configs['library']['book_qrcode_columns']) && $configs['library']['book_qrcode_columns'] != '') {
            $qr_cols=explode(',',$configs['library']['book_qrcode_columns']);
            $data['data']['qrcode_default_columns'] = json_encode($qr_cols);
        } else {
            $data['data']['qrcode_default_columns'] = json_encode($this->config->item('LIB_BOOK_QR_DEFAULT_COLUMNS'));
        }
        
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
            if ($post_data['app_configs_category'] == 'CHM_APP') {
                if ($post_data['app_configs']['role_priority']) {
                    $role_priority = $post_data['app_configs']['role_priority'];
                    $role_priority = trim($role_priority, ',');
                    $post_data['app_configs']['role_priority'] = explode(',', $role_priority);
                }
            }
            //pma($post_data,1);
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
