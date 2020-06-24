<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Desktop_page_catlog extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
        $this->load->library('form_validation');
        
        $this->load->library('upload');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->helper('string');
        
        $this->load->model('admin/Desktop_pagecatlog_model');
    }

    public function index() {
        if ($this->session->userdata('logged_in')) {

            $data['sel_catg'] = $this->Desktop_pagecatlog_model->select_allcategory();
            $this->load->view('admin/desktop_catlog_page', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    public function addnewsection_desktopcatlog() {
        if ($this->session->userdata('logged_in')) {
            $data['sel_catg'] = $this->Desktop_pagecatlog_model->select_allcategory();
            $this->load->view('admin/addnewsection_desktopcatlog', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    public function add_pagecatlogdata() {
        if ($this->session->userdata('logged_in')) {
            $this->Desktop_pagecatlog_model->add_pagesectioninfo();
            $this->session->set_flashdata('flshmsg', 'Data Saved Successfully');

            //$data['cat_data']=$this->Desktop_pagecatlog_model->section_dataof_desktopcatlog();
            //$this->load->view('admin/desktop_catlog_page',$data);
            //redirect('admin/Page_catlog');
            echo "<script>window.close();</script>";
        } else {
            redirect('admin/super_admin');
        }
    }

    public function edit_desktopcatlogsection() {
        if ($this->session->userdata('logged_in')) {
            $data['sec_info'] = $this->Desktop_pagecatlog_model->catlog_sectioneditedpage();
            $data['sel_catg'] = $this->Desktop_pagecatlog_model->select_allcategory();
            $this->load->view('admin/edit_desktopcatlogsection', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    public function update_catlogectiondata() {
        if ($this->session->userdata('logged_in')) {
            $this->Desktop_pagecatlog_model->update_pagesectioninfo();
            $this->session->set_flashdata('flshmsg', 'Data Saved Successfully');

            echo "<script>window.close();</script>";
        } else {
            redirect('admin/super_admin');
        }
    }

    public function select_imagesize() {
        if ($this->session->userdata('logged_in')) {
            $data['img_size'] = $this->Desktop_pagecatlog_model->select_imgsize();
            $this->load->view('admin/pagedesign_setup/pagedesigne_imagesizeajax', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    public function catlogsortby_section_up() {
        if ($this->session->userdata('logged_in')) {
            $this->Desktop_pagecatlog_model->catlogsectionsorby_up();
            $this->session->set_flashdata('flshmsg', 'Data Saved Successfully');

            $data['cat_data'] = $this->Desktop_pagecatlog_model->select_pagedesinginfo_as_menuwise();
            $this->load->view('admin/desktop_infomenuwise_catlog', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    public function catlogsortby_section_down() {
        if ($this->session->userdata('logged_in')) {
            $this->Desktop_pagecatlog_model->catlogsectionsorby_down();
            $this->session->set_flashdata('flshmsg', 'Data Saved Successfully');

            $data['cat_data'] = $this->Desktop_pagecatlog_model->select_pagedesinginfo_as_menuwise();
            $this->load->view('admin/desktop_infomenuwise_catlog', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    public function catalogsortby_section_totop() {
        if ($this->session->userdata('logged_in')) {
            $this->Desktop_pagecatlog_model->catalogsortby_section_totop();
            $this->session->set_flashdata('flshmsg', 'Data Saved Successfully');

            $data['cat_data'] = $this->Desktop_pagecatlog_model->select_pagedesinginfo_as_menuwise();
            $this->load->view('admin/desktop_infomenuwise_catlog', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    public function catalogsortby_section_todown() {
        if ($this->session->userdata('logged_in')) {
            $this->Desktop_pagecatlog_model->catalogsortby_section_todown();
            $this->session->set_flashdata('flshmsg', 'Data Saved Successfully');

            $data['cat_data'] = $this->Desktop_pagecatlog_model->select_pagedesinginfo_as_menuwise();
            $this->load->view('admin/desktop_infomenuwise_catlog', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    public function change_sec_status() {
        if ($this->session->userdata('logged_in')) {
            $this->Desktop_pagecatlog_model->changesection_status();
            $this->session->set_flashdata('flshmsg', 'Section Status Changed Successfully');

            $data['cat_data'] = $this->Desktop_pagecatlog_model->select_pagedesinginfo_as_menuwise();
            $this->load->view('admin/desktop_infomenuwise_catlog', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    public function remove_desktopcatlogsection() {
        if ($this->session->userdata('logged_in')) {
            $this->Desktop_pagecatlog_model->delete_desktopcatlog_section();
            $this->session->set_flashdata('flshmsg', 'Section Deleted Successfully');

            $data['cat_data'] = $this->Desktop_pagecatlog_model->select_pagedesinginfo_as_menuwise();
            $this->load->view('admin/desktop_infomenuwise_catlog', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    public function remove_imagedata() {
        if ($this->session->userdata('logged_in')) {
            $this->Desktop_pagecatlog_model->remove_imageinfo();
            echo 'success';
        } else {
            redirect('admin/super_admin');
        }
    }

    public function remove_csvdata() {
        if ($this->session->userdata('logged_in')) {
            $this->Desktop_pagecatlog_model->remove_csvinfo();
            echo 'success';
        } else {
            redirect('admin/super_admin');
        }
    }

    public function select_screeshot() {
        if ($this->session->userdata('logged_in')) {

            $data['screenshot_image'] = $this->Desktop_pagecatlog_model->select_screenshotimage();
            $this->load->view('admin/pagedesign_setup/desktop_catlog_screenshotajax', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    public function remove_catalogmenulink() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('admin/Desktop_pagecatlog_model');
            $this->Desktop_pagecatlog_model->remove_menulink();
        } else {
            redirect('admin/super_admin');
        }
    }

    public function remove_categorymenulink() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('admin/Desktop_pagecatlog_model');
            $this->Desktop_pagecatlog_model->remove_menulink();
        } else {
            redirect('admin/super_admin');
        }
    }

    function populate_pagedesigninfo() {
        if ($this->session->userdata('logged_in')) {

            $data['cat_data'] = $this->Desktop_pagecatlog_model->select_pagedesinginfo_as_menuwise();
            $this->load->view('admin/desktop_infomenuwise_catlog', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

}

?>