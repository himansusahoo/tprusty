<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Seller_penalty extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
        $this->load->library('form_validation');
        $this->load->library('email');
        
        $this->load->library('encrypt');
        $this->load->library('javascript');
        

        $this->load->model('admin/Seller_penalty_model');
    }

    function index() {
        if ($this->session->userdata('logged_in')) {

            $penalty['penalty_result'] = $this->Seller_penalty_model->select_penaltydata();
            $this->load->view('admin/penalty_setting', $penalty);
        } else {
            redirect('admin/super_admin');
        }
    }

    function insert_penalty_data() {

        if ($this->session->userdata('logged_in')) {

            $this->Seller_penalty_model->insert_penalty_data();
            //$this->load->view('admin/penalty_setting');
            redirect('admin/Seller_penalty/load_penalty_info');
        } else {
            redirect('admin/super_admin');
        }
    }

    function load_penalty_info() {
        if ($this->session->userdata('logged_in')) {

            $penalty['penalty_result'] = $this->Seller_penalty_model->select_penaltydata();
            $this->load->view('admin/penalty_setting', $penalty);
        } else {
            redirect('admin/super_admin');
        }
    }

}
