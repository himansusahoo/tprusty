<?php

class Moonboy404 extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('html', 'form', 'url'));

        $this->load->library('session');
        $this->load->helper('cookie');
        $this->load->library('user_agent');
        $this->load->database();
    }

    public function index() {
        $this->output->set_status_header('404');
        $data['content'] = 'error_404'; // View name
        if ($this->agent->is_mobile()) {
            $this->load->view('m/error_404', $data);
        } else {
            $this->load->view('error_404', $data);
        }
    }

}

// class end 
?>