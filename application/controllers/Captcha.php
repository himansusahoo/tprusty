<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Captcha extends CI_Controller {
    /* Initialize the controller by calling the necessary helpers and libraries */

    public function __construct() {
        parent::__construct();
        /* Load the libraries and helpers */
        $this->load->library('form_validation');
        
        $this->load->helper(array('form', 'url', 'captcha'));

       
        $this->load->library('form_validation');
        $this->load->library('email');
        
        $this->load->library('upload');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->library('pagination');
        
        $this->load->model('Mycart_model');
        $this->load->model('Captcha_model');
        $this->load->helper('captcha');
    }

    /* The default function that gets called when visiting the page */

    public function index() {

        //$this->form_validation->set_rules($this->login_rules);
        $userCaptcha = set_value('captcha');
        $word = $this->session->userdata('captchaWord');

        if ($this->form_validation->run() == TRUE && strcmp(strtoupper($userCaptcha), strtoupper($word)) == 0) {
            $this->session->unset_userdata('captchaWord');
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if (!$this->autentifikasi->login($username, $password)) {
                $this->session->set_flashdata('pesan', '<div class="error">Login gagal</div>');
                redirect(site_url('user/login'));
            } else {
                $this->session->set_flashdata('pesan', '<div class="sukses">Anda telah berhasil login, selamat berbelanja.</div>');
                redirect(site_url('user/login'));
            }
        }

        $original_string = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
        $original_string = implode("", $original_string);
        $captcha = substr(str_shuffle($original_string), 0, 6);

        $vals = array(
            'word' => $captcha,
            'img_path' => base_url() . '/images/',
            'img_url' => base_url() . 'images/',
            'font_path' => './fonts/texb.ttf',
            'img_width' => '150',
            'img_height' => 30,
            'expiration' => 3600
        );

        $cap = create_captcha($vals);

        $cart['image'] = $cap['image'];
        $this->session->set_userdata('captchaWord', $captcha);

        $this->template->set_judul('PT. Columbindo Perdana')
                ->set_css('style')
                ->set_parsial('sidebar', 'sidebar_view', $this->data)
                ->set_parsial('topmenu', 'top_view', $this->data)
                ->render('user_login', $this->data);




        $cart['cart_data'] = $this->Mycart_model->show_mycart();
        $cart['cus_data'] = $this->Mycart_model->customer_detail_for_checkout();
        $this->load->view('checkout', $cart);
    }

}

?>