<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
        $this->load->library('form_validation');
        $this->load->library('email');
        
        $this->load->library('encrypt');
        $this->load->library('javascript');
        
    }

    function index() {
        $this->load->view('admin/pages');
    }

}

?>