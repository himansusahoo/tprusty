<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Filter extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('html', 'form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('session');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->library('upload');
        $this->load->database();
        $this->load->model('admin/Manage_category_model');
        $this->load->model('admin/Filter_model');
        $this->load->library('pagination');
    }

    function index() {
        if ($this->session->userdata('logged_in')) {
            $data['attribute_set_result'] = $this->Filter_model->retrieve_attribute_set();
            $this->load->view('admin/filter_setup', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function get_filter_data() {
        $result = $this->Filter_model->insert_update_filter_data();
        if ($result == true) {
            $this->session->set_flashdata('ssmsg', 'Submitted Successfully !');
            redirect("admin/filter");
        }
    }

}

?>