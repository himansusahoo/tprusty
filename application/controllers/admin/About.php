<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
        $this->load->library('form_validation');
        $this->load->library('email');
        
        $this->load->library('encrypt');
        $this->load->library('javascript');
        
    }

    function index() {
        $this->load->view('admin/my_account');
    }

    function users() {
        $this->load->view('admin/users');
    }

    function roles() {
        $this->load->view('admin/roles');
    }

}

?>