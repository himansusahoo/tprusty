<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Demo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('html', 'form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('session');
        $this->load->library('upload');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->library('pagination');
        $this->load->library('user_agent');
        $this->load->database();
        $this->load->helper('cookie');
        $this->load->model('Product_descrp_model');
        $this->load->model('Homemodel');
    }

    public function mobile_test() {
        $data['sec_info'] = $this->Homemodel->select_mobilehomepage_allsections();

        if ($this->agent->is_mobile()) {
            $this->load->view('m_new/home', $data);
        } else {
            echo "Not accessible for desktop PC";
            exit;
        }
    }

    public function mobile_old() {
        $this->load->model('Usermodel');
        $p['slider_box1'] = $this->Usermodel->slider_box1_select();
        $p['sub3_box1_info'] = $this->Usermodel->block3_box1_select();
        $p['sub2_box1_info'] = $this->Usermodel->block2_box1_select();
        $p['sub2_box2_info'] = $this->Usermodel->block2_box2_select();
        $p['sub2_box3_info'] = $this->Usermodel->block2_box3_select();
        $p['sub1_box1_info'] = $this->Usermodel->block1_box1_select();
        $p['sub1_box2_info'] = $this->Usermodel->block1_box2_select();
        $p['data1'] = $this->Usermodel->view_homepage();
        $p['new_product_result'] = $this->Usermodel->retrieve_new_product();
        $p['product_result'] = $this->Usermodel->retrieve_trending_products();

        $prodid = get_cookie('prodid', TRUE);
        if ($prodid != '') {
            $p['product_result_for_scroll1'] = $this->Usermodel->retrieve_product_for_scroll1();
        } else {
            $p['product_result_for_scroll1'] = '';
        }

        if ($this->agent->is_mobile()) {
            $this->load->view('m_old/home', $p);
        } else {
            echo "Not accessible for desktop PC";
            exit;
        }
    }

    function shopbycategory_menu() {
        if ($this->agent->is_mobile()) {
            $this->load->view('m_new/menu_link');
        } else {
            echo "not accessible for desktop PC";
        }
    }

    function offer_productcatalog() {
        if ($this->agent->is_mobile()) {
            $data['product_data'] = $this->Homemodel->select_offercatalogproduct();
            $data['no_of_product'] = $this->Homemodel->select_offercatalogproduct_count();
            $this->load->view('m_new/catalog_offerpage', $data);
        } else {
            echo "not accessible for desktop PC";
        }
    }

    function show_more_catalog_data() {
        //$p['data'] = $this->Product_descrp_model->view_product_descrp();
        $p['product_data'] = $this->Homemodel->select_more_product_data_list();
        $p['sl_no'] = $this->input->get('from');
        //$p['sl_no'] = $this->uri->segment(3);

        if ($this->agent->is_mobile()) {
            $this->load->view('m_new/ajax_load_product_addtocart', $p);
        } else {
            echo "not accessible for desktop PC";
        }
    }

    public function desktop_test() {
        $data['sec_info'] = $this->Homemodel->select_desktophomepage_allsections();
        $this->load->view('d_new/home', $data);
    }

    function category_catalog() {
        //$data['data'] = $this->Product_descrp_model->retrieve_category_meta_info();
        //$catg_id=$this->uri->segment(4);

        $label_name = $this->uri->segment(2);

        if ($this->agent->is_mobile()) {

            $qr_lblid = $this->db->query("SELECT * FROM category_menu_mobile WHERE url_displayname='$label_name'  ");
            if ($qr_lblid->num_rows() > 0) {
                $label_id = $qr_lblid->row()->dskmenu_lbl_id;
                $view_type = $qr_lblid->row()->view_type;

                $qr_catg = $this->db->query("SELECT category_id FROM category_menu_mobile WHERE parent_id='$label_id' LIMIT 1 ");

                $child_catgid = $qr_catg->row()->category_id;

                $qr_maincatg = $this->db->query("SELECT parent_id FROM category_indexing WHERE category_id='$child_catgid' LIMIT 1 ");

                $main_catgid = $qr_maincatg->row()->parent_id;
            }
        } else {
            $qr_lblid = $this->db->query("SELECT * FROM category_menu_desktop WHERE url_displayname='$label_name'  ");
            if ($qr_lblid->num_rows() > 0) {
                $label_id = $qr_lblid->row()->dskmenu_lbl_id;
                //$catg_id=$qr_lblid->row()->category_id;
                $view_type = $qr_lblid->row()->view_type;

                $qr_catg = $this->db->query("SELECT category_id FROM category_menu_desktop WHERE parent_id='$label_id' LIMIT 1 ");

                $child_catgid = $qr_catg->row()->category_id;

                $qr_maincatg = $this->db->query("SELECT parent_id FROM category_indexing WHERE category_id='$child_catgid' LIMIT 1 ");

                $main_catgid = $qr_maincatg->row()->parent_id;
            }
        } // query condition for desktop or mobile end

        $data['data'] = $this->Product_descrp_model->modf_retrieve_category_meta_info($main_catgid);

        if ($view_type == 'category') {
            $this->load->model('Homemodel');
            $p['data'] = $this->Product_descrp_model->modf_retrieve_category_meta_info($main_catgid);
            $catg_id = $main_catgid;
            $p['cat_id'] = $main_catgid;
            $p['brand_name'] = $this->Product_descrp_model->catg_brand_name($label_id);
            $p['product_image'] = $this->Product_descrp_model->select_product_image($label_id);

            $p['sec_info'] = $this->Homemodel->select_category_allsections();
        } else {
            //$label_id=$this->uri->segment(4);
            if ($this->uri->segment(5) == '') {
                $data['product_data'] = $this->Product_descrp_model->select_category_product_data_list($label_id, 'NOT');
                $data['no_of_product'] = $this->Product_descrp_model->select_category_product_data_count($label_id, 'NOT');
                $data['filter_fld_result'] = $this->Product_descrp_model->category_catalog_filter_fld_data($label_id, 'NOT');
                //$data['brand_name']=$this->Product_descrp_model->catg_brand_name($label_id);
                $data['cat_id'] = $main_catgid;
            } else {
                //$price_slab = ltrim($this->uri->segment(5),'price=');
                $last_segmt = $this->uri->segment(5);
                $data['product_data'] = $this->Product_descrp_model->select_category_product_data_list($label_id, $last_segmt);
                $data['no_of_product'] = $this->Product_descrp_model->select_category_product_data_count($label_id, $last_segmt);
                $data['filter_fld_result'] = $this->Product_descrp_model->category_catalog_filter_fld_data($label_id, $last_segmt);
                //$data['brand_name']=$this->Product_descrp_model->catg_brand_name($label_id);
                $data['cat_id'] = $main_catgid;
            }
        } // if view page not category

        if ($this->agent->is_mobile()) {
            /* $data['cat_id']=$main_catgid;
              $data['brand_name']=$this->Product_descrp_model->catg_brand_name_mobile($label_id);
              $this->load->view('m/category_catalog',$data); */

            if ($view_type == 'category') {
                $p['data1'] = $this->Product_descrp_model->modf_retrieve_category_meta_info($main_catgid);
                $this->load->view('m/subcategory_detail', $p);
            } else {
                $data['data1'] = $this->Product_descrp_model->modf_retrieve_category_meta_info($main_catgid);
                $data['cat_id'] = $main_catgid;

                $data['brand_name'] = $this->Product_descrp_model->catg_brand_name_mobile($label_id);

                $data['product_image'] = $this->Product_descrp_model->select_product_image($label_id);
                $this->load->view('m/category_catalog', $data);
            }
        } else {
            if ($view_type == 'category') {
                $this->load->model('Homemodel');
                $p['sec_info'] = $this->Homemodel->desktop_category_allsections();
                $this->load->view('d_new/subcategory_detail', $p);
            } else { //$data['brand_name']=$this->Product_descrp_model->catg_brand_name($label_id);
                $data['product_image'] = $this->Product_descrp_model->select_product_image($label_id);
                $this->load->view('d_new/category_catalog', $data);
            }
        }
    }

}

?>