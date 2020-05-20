<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Page_setup extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $this->load->helper(array('html', 'form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('upload');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->helper('string');
        $this->load->database();
        $this->load->model('admin/Pagesetup_model');


        $this->load->library('ckeditor');
        $this->load->library('ckfinder');
        $this->ckeditor->basePath = base_url() . 'asset/ckeditor/';
        $this->ckeditor->config['toolbar'] = array(
            array('Source', '-', 'Bold', 'Italic', 'Underline', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', '-', 'NumberedList', 'BulletedList'));
        $this->ckeditor->config['language'] = 'it';
        $this->ckeditor->config['width'] = '730px';
        $this->ckeditor->config['height'] = '300px';
        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor, 'base_url()/asset/ckfinder/');
        $this->db->cache_off();
    }

    function index() {
        if ($this->session->userdata('logged_in')) {

            $data['sec_data'] = $this->Pagesetup_model->section_dataof_mobilehomepage();
            //$this->db->cache_delete('default', 'index');	
            $this->load->view('admin/homepage_setup', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function addnewsection_formobilehomepage() {
        if ($this->session->userdata('logged_in')) {

            //$data['sizesetup']=$this->Config_model->select_size();

            $this->load->view('admin/addnewsection_mobilehomepage');
        } else {
            redirect('admin/super_admin');
        }
    }

    function select_imagesize() {
        if ($this->session->userdata('logged_in')) {

            $data['img_size'] = $this->Pagesetup_model->select_imgsize();

            $this->load->view('admin/pagedesign_setup/pagedesigne_imagesizeajax', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function select_screeshot() {
        if ($this->session->userdata('logged_in')) {


            $data['screenshot_image'] = $this->Pagesetup_model->select_screenshotimage();

            $this->load->view('admin/pagedesign_setup/pagedesigne_screenshotajax', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function add_pagesectiondata() {
        if ($this->session->userdata('logged_in')) {

            $this->Pagesetup_model->add_pagesectioninfo();
            $this->session->set_flashdata('flshmsg', 'Data Saved Successfully');

            //$data['sec_data']=$this->Pagesetup_model->section_dataof_mobilehomepage();			
            //$this->load->view('admin/homepage_setup',$data);		
            //redirect('admin/Page_setup');
            echo "<script>window.close();</script>";
        } else {
            redirect('admin/super_admin');
        }
    }

    function hompagesortby_section_up() {
        if ($this->session->userdata('logged_in')) {
            $this->Pagesetup_model->homepagesectionsorby_up();
            $this->session->set_flashdata('flshmsg', 'Data Saved Successfully');

            $data['sec_data'] = $this->Pagesetup_model->section_dataof_mobilehomepage();
            $this->load->view('admin/homepage_setup', $data);
            //redirect('admin/Page_setup');
        } else {
            redirect('admin/super_admin');
        }
    }

    function hompagesortby_section_movetop() {
        if ($this->session->userdata('logged_in')) {
            $this->Pagesetup_model->hompagesortby_section_movetop();
            $this->session->set_flashdata('flshmsg', 'Data Saved Successfully');

            $data['sec_data'] = $this->Pagesetup_model->section_dataof_mobilehomepage();
            $this->load->view('admin/homepage_setup', $data);
            //redirect('admin/Page_setup');
        } else {
            redirect('admin/super_admin');
        }
    }

    function hompagesortby_section_movedown() {
        if ($this->session->userdata('logged_in')) {
            $this->Pagesetup_model->hompagesortby_section_movedown();
            $this->session->set_flashdata('flshmsg', 'Data Saved Successfully');

            $data['sec_data'] = $this->Pagesetup_model->section_dataof_mobilehomepage();
            $this->load->view('admin/homepage_setup', $data);
            //redirect('admin/Page_setup');
        } else {
            redirect('admin/super_admin');
        }
    }

    function hompagesortby_section_down() {
        if ($this->session->userdata('logged_in')) {
            $this->Pagesetup_model->homepagesectionsorby_down();
            $this->session->set_flashdata('flshmsg', 'Data Saved Successfully');

            $data['sec_data'] = $this->Pagesetup_model->section_dataof_mobilehomepage();
            $this->load->view('admin/homepage_setup', $data);
            //redirect('admin/Page_setup');
        } else {
            redirect('admin/super_admin');
        }
    }

    function edit_mobilehomepagesection() {
        if ($this->session->userdata('logged_in')) {
            $data['sec_info'] = $this->Pagesetup_model->homepage_sectioneditedpage();

            $this->load->view('admin/edit_mobilehomepagesection', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function remove_mobilehomepagesection() {
        if ($this->session->userdata('logged_in')) {
            $this->Pagesetup_model->delete_mobilehomepage_section();
            $this->session->set_flashdata('flshmsg', 'Data Saved Successfully');

            $data['sec_data'] = $this->Pagesetup_model->section_dataof_mobilehomepage();
            $this->load->view('admin/homepage_setup', $data);
            //redirect('admin/Page_setup');	
        } else {
            redirect('admin/super_admin');
        }
    }

    function change_sec_status() {
        if ($this->session->userdata('logged_in')) {
            $this->Pagesetup_model->changesection_status();
            $this->session->set_flashdata('flshmsg', 'Section Status Changed Successfully');
        } else {
            redirect('admin/super_admin');
        }
    }

    function update_pagesectiondata() {
        if ($this->session->userdata('logged_in')) {
            $this->Pagesetup_model->update_pagesectioninfo();
            $this->session->set_flashdata('flshmsg', 'Data Saved Successfully');

            //$data['sec_data']=$this->Pagesetup_model->section_dataof_mobilehomepage();			
            //$this->load->view('admin/homepage_setup',$data);				
            //redirect('admin/Page_setup');
            echo "<script>window.close();</script>";
        } else {
            redirect('admin/super_admin');
        }
    }

    function remove_imagedata() {
        if ($this->session->userdata('logged_in')) {
            $this->Pagesetup_model->remove_imageinfo();
            echo 'success';
        } else {
            redirect('admin/super_admin');
        }
    }

    function remove_csvdata() {
        if ($this->session->userdata('logged_in')) {
            $this->Pagesetup_model->remove_csvinfo();
            echo 'success';
        } else {
            redirect('admin/super_admin');
        }
    }

}

?>