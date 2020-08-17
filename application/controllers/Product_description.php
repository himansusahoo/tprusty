<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_description extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->library('email');

        $this->load->library('upload');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->library('pagination');
        $this->load->helper('string');
        $this->load->helper('cookie');
        $this->load->library('user_agent');
        $this->load->model('Product_descrp_model');
        $this->load->model('Mycart_model');
    }

    function product_data() {
        $p['data'] = $this->Product_descrp_model->retrieve_category_meta_info();
        $catg_id = $this->uri->segment(4);
        $search_title = urldecode($this->input->post('search'));
        $p['brand_name'] = $this->Product_descrp_model->select_brand_name($catg_id);
        $p['product_image'] = $this->Product_descrp_model->select_product_image($catg_id);
        if ($this->agent->is_mobile()) {
            $this->load->view('m/subcategory_detail', $p);
        } else {
            $this->load->view('subcategory_detail', $p);
        }
    }

    function product_addtocart() {
        $this->db->cache_on();
        $label_name = $this->uri->segment(1);

        if ($this->agent->is_mobile()) {
            $qr_lblid = $this->db->query("SELECT * FROM category_menu_mobile WHERE url_displayname='$label_name'  ");
            if ($qr_lblid->num_rows() > 0) {
                $seocatg_id = $qr_lblid->row()->seo_categoryidlink;
                if ($seocatg_id > 0) {
                    $seodskcatgid_id = $seocatg_id;
                } else {
                    $seodskcatgid_id = $qr_lblid->row()->category_id;
                }
            } else {
                redirect(base_url());
            }

            $dskcatgid_id = $qr_lblid->row()->category_id;
        } else {

            $qr_lblid = $this->db->query("SELECT * FROM category_menu_desktop WHERE url_displayname='$label_name'  ");
            if ($qr_lblid->num_rows() > 0) {
                $seocatg_id = $qr_lblid->row()->seo_categoryidlink;

                if ($seocatg_id > 0) {
                    $seodskcatgid_id = $seocatg_id;
                } else {
                    $seodskcatgid_id = $qr_lblid->row()->category_id;
                }
            } else {
                redirect(base_url());
            }
            $dskcatgid_id = $qr_lblid->row()->category_id;
        }

        $data['data'] = $this->Product_descrp_model->modf_retrieve_category_meta_info($seodskcatgid_id);
        $data['single_desc'] = $this->Product_descrp_model->single_category_meta_info($seodskcatgid_id);
        $catg_id = str_replace('-', ',', $dskcatgid_id);

        if ($this->uri->segment(2) == '') {
            $data['product_data'] = $this->Product_descrp_model->select_product_data_list($catg_id, 'NOT');
            $data['no_of_product'] = $this->Product_descrp_model->select_product_data_count($catg_id, 'NOT');
        } else {
            $last_segmt = $this->uri->segment(2);
            $data['product_data'] = $this->Product_descrp_model->select_product_data_list($catg_id, $last_segmt);
            $data['no_of_product'] = $this->Product_descrp_model->select_product_data_count($catg_id, $last_segmt);
        }

        $this->db->cache_on();
        if ($this->agent->is_mobile()) {
            $this->load->model('Homemodel');
            $this->db->cache_off();
            $data['sec_info'] = $this->Homemodel->select_catlog_allsections();
            $this->db->cache_on();
            $data['data1'] = $this->Product_descrp_model->modf_retrieve_category_meta_info($seodskcatgid_id);
            $this->load->view('m/product_addtocart', $data);
        } else {
            $this->load->model('Homemodel');
            $data['sec_info'] = $this->Homemodel->desktop_catlog_allsections();
            $this->load->view('product_addtocart', $data);
        }
    }

    function product_addtocart_filter() {
        $this->db->cache_on();
        $label_name = $this->uri->segment(2);
        $data=array(
            'sec_info'=>''
        );
        if ($this->agent->is_mobile()) {
            $qr_lblid = $this->db->query("SELECT * FROM category_menu_mobile WHERE url_displayname='$label_name'  ");
            if ($qr_lblid->num_rows() > 0) {
                $seocatg_id = $qr_lblid->row()->seo_categoryidlink;
                if ($seocatg_id > 0) {
                    $seodskcatgid_id = $seocatg_id;
                } else {
                    $seodskcatgid_id = $qr_lblid->row()->category_id;
                }
            } else {
                redirect(base_url());
            }
        } else {

            $qr_lblid = $this->db->query("SELECT * FROM category_menu_desktop WHERE url_displayname='$label_name'  ");
            if ($qr_lblid->num_rows() > 0) {
                $seocatg_id = $qr_lblid->row()->seo_categoryidlink;

                if ($seocatg_id > 0) {
                    $seodskcatgid_id = $seocatg_id;
                } else {
                    $seodskcatgid_id = $qr_lblid->row()->category_id;
                }
            } else {
                redirect(base_url());
            }
        }
        $catg_id = str_replace('-', ',', $this->uri->segment(3));
        $this->db->cache_on();
        $data['data'] = $this->Product_descrp_model->modf_retrieve_category_meta_info($seodskcatgid_id);
        $data['single_desc'] = $this->Product_descrp_model->single_category_meta_info($seodskcatgid_id);

        if ($this->uri->segment(4) == '') {
            $data['product_data'] = $this->Product_descrp_model->select_product_data_listfilter($catg_id, 'NOT');
            $data['no_of_product'] = $this->Product_descrp_model->select_product_data_countfilter($catg_id, 'NOT');
        } else {
            $last_segmt = $this->uri->segment(4);
            $data['product_data'] = $this->Product_descrp_model->select_product_data_listfilter($catg_id, $last_segmt);
            $data['no_of_product'] = $this->Product_descrp_model->select_product_data_countfilter($catg_id, $last_segmt);
        }
        if ($this->agent->is_mobile()) {
            $this->load->model('Homemodel');
            $this->db->cache_off();
            $data['sec_info'] = $this->Homemodel->select_catlog_allsections();
            $this->db->cache_on();
            $this->load->view('m/product_addtocart', $data);
        } else {
            $this->load->view('product_addtocart', $data);
        }
    }

    function category_catalog() {
        $this->db->cache_on();
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
            } else {
                redirect(base_url());
            }
        } else {
            $qr_lblid = $this->db->query("SELECT * FROM category_menu_desktop WHERE url_displayname='$label_name'  ");
            if ($qr_lblid->num_rows() > 0) {
                $label_id = $qr_lblid->row()->dskmenu_lbl_id;
                $view_type = $qr_lblid->row()->view_type;

                $qr_catg = $this->db->query("SELECT category_id FROM category_menu_desktop WHERE parent_id='$label_id' LIMIT 1 ");

                $child_catgid = $qr_catg->row()->category_id;

                $qr_maincatg = $this->db->query("SELECT parent_id FROM category_indexing WHERE category_id='$child_catgid' LIMIT 1 ");

                $main_catgid = $qr_maincatg->row()->parent_id;
            } else {
                redirect(base_url());
            }
        } // query condition for desktop or mobile end

        $data['data'] = $this->Product_descrp_model->modf_retrieve_category_meta_info($main_catgid);
        $this->load->model('Homemodel');
        if ($view_type == 'category') {

            $p['data'] = $this->Product_descrp_model->modf_retrieve_category_meta_info($main_catgid);
            $catg_id = $main_catgid;
            $p['cat_id'] = $main_catgid;
            $p['brand_name'] = $this->Product_descrp_model->catg_brand_name($label_id);
            $p['product_image'] = $this->Product_descrp_model->select_product_image($label_id);
            $this->db->cache_off();
            $p['sec_info'] = $this->Homemodel->select_category_allsections();
            $this->db->cache_on();
        } else {
            $this->db->cache_off();
            $data['sec_info'] = $this->Homemodel->select_category_allsections();

            $this->db->cache_on();
            if ($this->uri->segment(5) == '') {
                $data['product_data'] = $this->Product_descrp_model->select_category_product_data_list($label_id, 'NOT');
                $data['no_of_product'] = $this->Product_descrp_model->select_category_product_data_count($label_id, 'NOT');
                $data['filter_fld_result'] = $this->Product_descrp_model->category_catalog_filter_fld_data($label_id, 'NOT');
                $data['cat_id'] = $main_catgid;
            } else {
                $last_segmt = $this->uri->segment(5);
                $data['product_data'] = $this->Product_descrp_model->select_category_product_data_list($label_id, $last_segmt);
                $data['no_of_product'] = $this->Product_descrp_model->select_category_product_data_count($label_id, $last_segmt);
                $data['filter_fld_result'] = $this->Product_descrp_model->category_catalog_filter_fld_data($label_id, $last_segmt);
                $data['cat_id'] = $main_catgid;
            }
        } // if view page not category
        if ($this->agent->is_mobile()) {
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
                $p['data3'] = $this->Product_descrp_model->modf_retrieve_category_meta_info($main_catgid);
                $p['sec_info'] = $this->Homemodel->desktop_category_allsections();
                $this->load->view('subcategory_detail', $p);
            } else {
                $this->load->view('subcategory_detail', $p);
            }
        }
    }

    function category_catalog_cacheclear($main_catgid) {

        $this->db->cache_on();
    }

    function category_catalog_filter() {
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
            } else {
                redirect(base_url());
            }
        } else {
            $qr_lblid = $this->db->query("SELECT * FROM category_menu_desktop WHERE url_displayname='$label_name'  ");
            if ($qr_lblid->num_rows() > 0) {
                $label_id = $qr_lblid->row()->dskmenu_lbl_id;
                $view_type = $qr_lblid->row()->view_type;
                $qr_catg = $this->db->query("SELECT category_id FROM category_menu_desktop WHERE parent_id='$label_id' LIMIT 1 ");
                $child_catgid = $qr_catg->row()->category_id;
                $qr_maincatg = $this->db->query("SELECT parent_id FROM category_indexing WHERE category_id='$child_catgid' LIMIT 1 ");
                $main_catgid = $qr_maincatg->row()->parent_id;
            } else {
                redirect(base_url());
            }
        } // query condition for desktop or mobile end


        $label_id = $this->uri->segment(3);
        $data['data'] = $this->Product_descrp_model->modf_retrieve_category_meta_info($label_id);
        $data['cat_id'] = $main_catgid;
        if ($this->uri->segment(4) == '') {
            $data['product_data'] = $this->Product_descrp_model->select_category_product_data_listfilter($label_id, 'NOT');
            $data['no_of_product'] = $this->Product_descrp_model->select_category_product_data_countfilter($label_id, 'NOT');
        } else {
            $last_segmt = $this->uri->segment(4);
            $data['product_data'] = $this->Product_descrp_model->select_category_product_data_listfilter($label_id, $last_segmt);
            $data['no_of_product'] = $this->Product_descrp_model->select_category_product_data_countfilter($label_id, $last_segmt);
        }
        if ($this->agent->is_mobile()) {
            $data['data1'] = $this->Product_descrp_model->modf_retrieve_category_meta_info($main_catgid);
            $data['brand_name'] = $this->Product_descrp_model->catg_brand_name_mobile($label_id);
            $this->load->view('m/category_catalog', $data);
        } else {
            $data['brand_name'] = $this->Product_descrp_model->catg_brand_name($label_id);
            $this->load->view('category_catalog', $data);
        }
    }

    function show_more_catalog_data() {
        $p['data'] = $this->Product_descrp_model->view_product_descrp();
        $p['product_data'] = $this->Product_descrp_model->select_more_product_data_listfilter();
        $p['sl_no'] = $this->input->get('from');
        if ($this->agent->is_mobile()) {
            $this->load->view('m/ajax_load_product_addtocart', $p);
        } else {
            $this->load->view('ajax_load_product_addtocart', $p);
        }
    }

    function show_more_single_catalog_data() {
        $p['data'] = $this->Product_descrp_model->view_product_descrp();
        $p['product_data'] = $this->Product_descrp_model->select_more_product_data_listfilter();
        $p['sl_no'] = $this->input->get('from');
        if ($this->agent->is_mobile()) {
            $this->load->view('m/ajax_load_single_product_addtocart', $p);
        } else {
            $this->load->view('ajax_load_product_addtocart', $p);
        }
    }

    function show_more_category_catalog_data() {

        $p['data'] = $this->Product_descrp_model->view_product_descrp();
        $p['product_data'] = $this->Product_descrp_model->select_more_categoryproduct_data_listfilter();
        $p['sl_no'] = $this->input->get('from');
        if ($this->agent->is_mobile()) {
            $this->load->view('m/ajax_load_product_addtocart', $p);
        } else {
            $this->load->view('ajax_load_product_addtocart', $p);
        }
    }

    function show_more_single_category_catalog_data() {

        $p['data'] = $this->Product_descrp_model->view_product_descrp();
        $p['product_data'] = $this->Product_descrp_model->select_more_categoryproduct_data_listfilter();
        $p['sl_no'] = $this->input->get('from');
        if ($this->agent->is_mobile()) {
            $this->load->view('m/ajax_load_single_product_addtocart', $p);
        } else {
            $this->load->view('ajax_load_product_addtocart', $p);
        }
    }

    function filteredbrand() {
        $data['data'] = $this->Product_descrp_model->view_product_descrp();
        $cat_id = $this->uri->segment(4);
        $brand = ltrim($this->uri->segment(5), 'brnd&');
        $data['brand_name'] = $this->Product_descrp_model->retrieve_attribute_brand_name($cat_id);
        $data['product_data'] = $this->Product_descrp_model->filter_category_brand_data($cat_id, $brand);
        $this->load->view('product_addtocart', $data);
    }

    function multifilter() {
        $cat_id = $this->uri->segment(4);
        $data['data'] = $this->Product_descrp_model->view_product_descrp();
        $data['brand_name'] = $this->Product_descrp_model->retrieve_attribute_brand_name($cat_id);
        $data['product_data'] = $this->Product_descrp_model->filter_third_multi_data($cat_id);
        $this->load->view('product_addtocart', $data);
    }

    function filteredbrand_color() {
        $data['data'] = $this->Product_descrp_model->view_product_descrp();
        $cat_id = $this->uri->segment(4);
        $brand = ltrim($this->uri->segment(5), 'brnd&');
        $color_name = substr($this->uri->segment(6), 4);
        $data['brand_name'] = $this->Product_descrp_model->retrieve_attribute_brand_name($cat_id);
        $data['product_data'] = $this->Product_descrp_model->filter_category_brand_color_data($cat_id, $brand, $color_name);
        $this->load->view('product_addtocart', $data);
    }

    function filteredprice_color() {
        $data['data'] = $this->Product_descrp_model->view_product_descrp();
        $cat_id = $this->uri->segment(4);
        $price_slab = ltrim($this->uri->segment(5), 'prce&');
        $color_name = substr($this->uri->segment(6), 4);
        $data['brand_name'] = $this->Product_descrp_model->retrieve_attribute_brand_name($cat_id);
        $data['product_data'] = $this->Product_descrp_model->filter_category_price_color_data($cat_id, $price_slab, $color_name);
        $this->load->view('product_addtocart', $data);
    }

    function multifiltered() {
        $cat_id = $this->uri->segment(4);
        $data['data'] = $this->Product_descrp_model->view_product_descrp();
        $data['brand_name'] = $this->Product_descrp_model->retrieve_attribute_brand_name($cat_id);
        $data['product_data'] = $this->Product_descrp_model->filtered_multi_data($cat_id);
        $this->load->view('product_addtocart', $data);
    }

    function product_add() {
        $p['data'] = $this->Product_descrp_model->view_product_descrp();
        $name = urldecode($this->uri->segment(3));
        $cat_id = ($this->uri->segment(4));
        $p['product_data'] = $this->Product_descrp_model->select_product_list($name);
        $this->load->view('product_addtocart', $p);
    }

    function product_search() {
        $p['data'] = $this->Product_descrp_model->view_product_descrp();
        if ($this->session->userdata('sugstword')) {
            $this->session->unset_userdata('sugstword');
            $this->session->set_userdata('sugstword', '');
        }

        if ($this->agent->is_mobile()) {
            $this->load->model('Homemodel');
            $p['sec_info'] = $this->Homemodel->select_mobile_search_allsections();
            $this->load->view('m/search_product_pg', $p);
        } else {
            $this->load->model('Homemodel');
            $data['sec_info'] = $this->Homemodel->select_desktop_search_allsections();
            $this->load->view('search_product_pg', $data);
        }
    }

    function search_firstproductloadajax() {
        $search_title = $this->input->post('search_data');
        $p['product_data'] = $this->Product_descrp_model->select_firstproductajax_search($search_title);

        if ($this->agent->is_mobile()) {
            $this->load->view('m/search_firstproduct_pgwith_ajax', $p);
        } else {
            $this->load->view('newsearch_firstproduct_pgwith_ajaxview', $p);
        }
    }

    function ponsored_product() {
        $search_title = $this->input->post('search_data');
        $p['ponsored_product_data'] = $this->Product_descrp_model->select_ponsored_product_data($search_title);

        if ($this->agent->is_mobile()) {
            $this->load->view('m/search_sponsored_product_ajax', $p);
        } else {
            $this->load->view('search_sponsored_product_ajaxview', $p);
        }
    }

    function filter_product_mtree() {
        $search_title = $this->input->post('search_data');
        $p['search_title'] = $search_title;
        $p['filter_data'] = $this->Product_descrp_model->select_filter_datamtree($search_title);

        if ($this->agent->is_mobile()) {
            $this->load->view('m/mtree_filter_data_ajaxview', $p);
        } else {
            $this->load->view('mtree_filter_data_ajaxview', $p);
        }
    }

    function product_searchcategory_ajax() {
        $search_title = $this->input->post('search_data');
        $p['product_data'] = $this->Product_descrp_model->select_product_searchfirstcount($search_title);
        if ($p['product_data']->num_rows() > 0) {
            $p['catg_ids'] = $this->Product_descrp_model->select_categoryfor_searchpage($search_title);
            if ($this->agent->is_mobile()) {
                $this->load->view('m/searchproductpg_categoryajax', $p);
            } else {

                $this->load->view('searchproductpg_categoryajax', $p);
            }
        }
    }

    function filter_product_list() {
        $checked_product = $this->input->post('checked_product');
        $search_title = $this->input->post('search_title');
        $start_from = $this->input->post('start_from');
        $cnt_arr = count($checked_product);
        $fqq = '';
        for ($i = 0; $i < $cnt_arr; $i++) {
            list($v1, $v2, $v3) = explode("|", $checked_product[$i], 3);
            $v3 = str_replace(' ', '%20', $v3);
            if (strpos($fqq, $v2 . ':') !== false) {
                $fqq = rtrim($fqq, ")");
                $fqq = $fqq . 'OR"' . $v3 . '")';
            } else {
                if ($fqq == '') {
                    $fqq = $v2 . ':("' . $v3 . '")';
                } else {
                    $fqq = $fqq . '&fq=' . $v2 . ':("' . $v3 . '")';
                }
            }
        }
        $p['product_data'] = $this->Product_descrp_model->select_filter_menudata($v1, $fqq, $search_title, $start_from);

        if ($this->agent->is_mobile()) {
            $this->load->view('m/search_firstproduct_pgwith_ajax', $p);
        } else {
            $this->load->view('newsearch_firstproduct_pgwith_ajaxview', $p);
        }
    }

    function show_more_filter_search_product_data() {
        $checked_product = $this->input->post('checked_product');
        $search_title = $this->input->post('search_title');
        $start_from = $this->input->post('start_from');

        $cnt_arr = count($checked_product);
        $fqq = '';
        for ($i = 0; $i < $cnt_arr; $i++) {


            list($v1, $v2, $v3) = explode("|", $checked_product[$i], 3);

            $v3 = str_replace(' ', '%20', $v3);
            if (strpos($fqq, $v2 . ':') !== false) {
                $fqq = rtrim($fqq, ")");
                $fqq = $fqq . 'OR"' . $v3 . '")';
            } else {
                if ($fqq == '') {
                    $fqq = $v2 . ':("' . $v3 . '")';
                } else {
                    $fqq = $fqq . '&fq=' . $v2 . ':("' . $v3 . '")';
                }
            }
        }
        $p['product_data'] = $this->Product_descrp_model->select_filter_menudata($v1, $fqq, $search_title, $start_from);

        if ($this->agent->is_mobile()) {
            $this->load->view('m/newsearch_moreproduct_pgwith_ajaxviewm', $p);
        } else {
            $this->load->view('newsearch_moreproduct_pgwith_ajaxview', $p);
        }
    }

    function search_click_filterdata() {
        $fqq = $this->input->post('fqq');
        $qsearch_title = $this->input->post('qsearch_title');
        $start_from = $this->input->post('start_from');

        $p['product_data'] = $this->Product_descrp_model->select_search_click_suggestdata($fqq, $qsearch_title, $start_from);

        if ($this->agent->is_mobile()) {
            $this->load->view('m/search_firstproduct_pgwith_ajax', $p);
        } else {
            $this->load->view('newsearch_firstproduct_pgwith_ajaxview', $p);
        }
    }

    function show_more_search_click_filterdata() {
        $fqq = $this->input->post('fqq');
        $qsearch_title = $this->input->post('qsearch_title');
        $start_from = $this->input->post('start_from');

        $p['product_data'] = $this->Product_descrp_model->select_search_click_suggestdata($fqq, $qsearch_title, $start_from);

        if ($this->agent->is_mobile()) {
            $this->load->view('m/newsearch_moreproduct_pgwith_ajaxviewm', $p);
        } else {
            $this->load->view('newsearch_moreproduct_pgwith_ajaxview', $p);
        }
    }

    function product_searchproductcount_ajax() {
        $search_title = $this->input->post('search_data');
        if ($this->session->userdata('prodcount_solr')) {
            $p['no_of_product'] = $this->session->userdata('prodcount_solr');
            $this->load->view('searchproductpg_productcountajax', $p);
        }
    }

    function product_searchvewmorebtn_ajax() {
        $search_title = $this->input->post('search_data');
        if ($this->session->userdata('prodcount_solr')) {
            $p['no_of_product'] = $this->session->userdata('prodcount_solr');

            if ($this->agent->is_mobile()) {
                $this->load->view('m/searchproductpg_viewmoreajaxbutton', $p);
            } else {
                $this->load->view('searchproductpg_viewmoreajaxbuttonn', $p);
            }
        }
    }

    function show_more_search_product_data() {
        $search_title = $this->input->get('title');
        $p['data'] = $this->Product_descrp_model->view_product_descrp();
        $p['sl_no'] = $this->input->get('from');
        $p['product_data'] = $this->Product_descrp_model->select_more_product_search_data($search_title);
        if ($this->agent->is_mobile()) {
            $this->load->view('m/newsearch_moreproduct_pgwith_ajaxviewm', $p);
        } else {
            $this->load->view('newsearch_moreproduct_pgwith_ajaxview', $p);
        }
    }

    function singlepord_colorsizeajax() {
        $data['data_sku'] = $this->input->post('prod_skuclrsize');
        if ($this->agent->is_mobile()) {
            $this->load->view('m/single_productcolr_sizeajax', $data);
        } else {
            $this->load->view('single_productcolr_sizeajax', $data);
        }
    }

    function product_detail() {
        $this->db->cache_on();
        $product_id = $this->uri->segment(2);
        $sku_id = $this->uri->segment(3);
        $this->db->cache_on();
        $qr_prodvwcount = $this->db->query("SELECT cronprod_viewcount FROM cornjob_productsearch WHERE product_id='$product_id' AND sku='$sku_id' group by sku ");

        if ($qr_prodvwcount->num_rows() > 0) {
            $proddbviewcount = $qr_prodvwcount->row()->cronprod_viewcount + 1;
            $qr_prodcount = $this->db->query("SELECT prodview_count FROM product_viewcount WHERE product_id='$product_id' AND sku='$sku_id' group by sku ");
            $view_data = array();
            $p=array(
                'sec_info'=>''
            );
            $view_data = array(
                'product_id' => $product_id,
                'sku' => $sku_id,
                'prodview_count' => $proddbviewcount
            );

            if ($qr_prodcount->num_rows() > 0) {
                $this->db->where('sku', $sku_id);
                $this->db->update('product_viewcount', $view_data);
            } else {
                $this->db->insert('product_viewcount', $view_data);
            }
            $p['data'] = $this->Product_descrp_model->select_prodmeta_info($product_id, $sku_id);
            $p['page_title'] = $this->Product_descrp_model->select_pagetitle($product_id);

            if ($this->session->userdata('sesscoke') != '') {
                array_push($this->session->userdata['sesscoke'], $product_id);
                $prodskarrctr = implode(',', $this->session->userdata('sesscoke'));
                $cookie = array(
                    'name' => 'prodid',
                    'value' => $prodskarrctr,
                    'expire' => 86400
                );
               
                set_cookie($cookie);
            }
            $p['other_seller_product'] = $this->Product_descrp_model->retrieve_same_product_different_seller($product_id, $sku_id);
            $p['seller_rating_result'] = $this->Product_descrp_model->retrieve_all_seller_rating();
            $p['seller_badge'] = $this->Product_descrp_model->getSellerBadge($sku_id);
            $p['vertual_inventory_data'] = $this->Product_descrp_model->checking_vertual_inventory_data($sku_id);
            if (@$this->session->userdata['session_data']['user_id']) {
                $p['data_sku'] = $sku_id;
                $p['product_data'] = $this->Product_descrp_model->select_single_product_data($product_id, $sku_id);

                $p['review_result'] = $this->Product_descrp_model->retrieve_product_review($sku_id);
                $p['related_prod'] = $this->Product_descrp_model->related_prod($product_id);
                if ($this->agent->is_mobile()) {
                    $this->load->view('m/single_product', $p);
                } else {
                    $this->load->view('single_product', $p);
                }
            } else {

                $p['data_sku'] = $sku_id;

                $p['product_data'] = $this->Product_descrp_model->select_single_product_data($product_id, $sku_id);

                $p['review_result'] = $this->Product_descrp_model->retrieve_product_review($sku_id);
                $p['related_prod'] = $this->Product_descrp_model->related_prod($product_id);
                if ($this->agent->is_mobile()) {
                    $this->load->model('Homemodel');
                    $p['data'] = $this->Product_descrp_model->select_prodmeta_info($product_id, $sku_id);
                    $this->db->cache_off();
                    $p['sec_info'] = $this->Homemodel->single_product_allsections($sku_id);
                    $this->db->cache_on();
                    $this->load->view('m/single_product', $p);
                } else {
                    $this->load->model('Homemodel');
                    $p['sec_info'] = $this->Homemodel->desktop_single_product_allsections($sku_id);
                    $this->load->view('single_product', $p);
                }
            }
        } else {
            redirect(base_url());
        }
    }

    function singlepord_attributeajax() {
        $sku_id = $this->input->post('prod_skuclrsize');
        $product_id = $this->input->post('prod_idajx');
        $p['data_sku'] = $sku_id;
        $p['product_attr_result'] = $this->Product_descrp_model->retrieve_indivisual_product_attr_headings($sku_id, $product_id);
        if ($this->agent->is_mobile()) {
            $this->load->view('m/single_product_attributeajx', $p);
        } else {
            $this->load->view('single_product_attributeajx', $p);
        }
    }

    function set_buynow_session() {
        $product_data = array(
            'product_id' => $this->input->post('pid'),
            'sku' => $this->input->post('sku_id'),
            'product_name' => $this->input->post('pname')
        );
        $this->session->set_userdata('pre_session_id', $product_data);
        echo 'success';
    }

    function addtocart_temp() {
        $prod_name = $this->uri->segment(3);
        $product_id = $this->uri->segment(4);
        $sku_id = $this->uri->segment(5);
        $this->Product_descrp_model->insert_addtocart_temp($product_id, $sku_id);
        redirect($prod_name . '/' . $product_id . '/' . $sku_id);
    }

    function logintobuynowaddtocart_temp() {
        $prod_name = $this->input->post('lbn_prod_name');
        $product_id = $this->input->post('lbn_product_id');
        $sku_id = $this->input->post('lbn_sku_id');
        $ltbn_id = $this->input->post('ltbn_id');
        $this->session->set_userdata('logintobuysku', $ltbn_id);
        $this->Product_descrp_model->insert_addtocart_temp($product_id, $sku_id);
    }

    function load_product_descrp() {
        $product_id = $this->uri->segment(3);
        $p['data_sku'] = $this->uri->segment(4);
        $sku_id = $this->uri->segment(4);
        $ctr = $this->Product_descrp_model->select_proddisplaystatus($product_id, $sku_id);
        if ($ctr > 0) {
            $p['data'] = $this->Product_descrp_model->select_prodmeta_info($product_id, $sku_id);
            $p['page_title'] = $this->Product_descrp_model->select_pagetitle($product_id);
            $p['other_seller_product'] = $this->Product_descrp_model->retrieve_same_product_different_seller($product_id, $sku_id);
            $p['seller_rating_result'] = $this->Product_descrp_model->retrieve_all_seller_rating();
            $p['product_attr_result'] = $this->Product_descrp_model->retrieve_indivisual_product_attr_headings($sku_id, $product_id);
            $p['seller_badge'] = $this->Product_descrp_model->getSellerBadge($sku_id);
            $p['related_prod'] = $this->Product_descrp_model->related_prod($product_id);
            $p['vertual_inventory_data'] = $this->Product_descrp_model->checking_vertual_inventory_data($sku_id);
            $p['product_data'] = $this->Product_descrp_model->select_single_product_data($product_id, $sku_id);
            $p['data'] = $this->Product_descrp_model->view_product_descrp();
            $p['review_result'] = $this->Product_descrp_model->retrieve_product_review($sku_id);
            $p['related_prod'] = $this->Product_descrp_model->related_prod($product_id);
            if ($this->agent->is_mobile()) {
                $this->load->view('m/single_product', $p);
            } else {
                $this->load->view('single_product', $p);
            }
        } else {
            redirect(base_url());
        }
    }

    function addtocart() {
        $prod_name = $this->uri->segment(3);
        $product_id = $this->uri->segment(4);
        $sku_id = $this->uri->segment(5);
        $attr_val = $this->uri->segment(6);
        if ($attr_val == '') {
            $this->Product_descrp_model->insert_addtocart_temp_withlogin($product_id, $sku_id);
        } else {
            $this->Product_descrp_model->insert_addtocart_temp_withlogin_attr($product_id, $sku_id, $attr_val);
        }
        redirect($prod_name . '/' . $product_id . '/' . $sku_id);
    }

    function addtocart_buynow() {
        $product_id = $this->uri->segment(4);
        $sku_id = $this->uri->segment(5);
        $attr_val = $this->uri->segment(6);
        if ($attr_val == '') {
            $this->Product_descrp_model->insert_addtocart_temp_withlogin($product_id, $sku_id);
        } else {
            $this->Product_descrp_model->insert_addtocart_temp_withlogin_attr($product_id, $sku_id, $attr_val);
        }
        redirect('mycart/checkout_process');
    }

    function addtocheckout() {
        $product_id = $this->uri->segment(4);
        $sku_id = $this->uri->segment(5);
        $this->Product_descrp_model->insert_checkout_withlogin($product_id, $sku_id);
        redirect('mycart/checkout_process');
    }

    function addtocheckout_buynow() {
        $product_id = $this->uri->segment(4);
        $sku_id = $this->uri->segment(5);
        $this->Product_descrp_model->insert_checkout_withlogin($product_id, $sku_id);
        redirect('mycart/mycart_detail');
    }

    function seller_rev_pg() {
        $seller_id = $this->input->post('seller_id');
        $this->session->set_userdata('session_seller_id', $seller_id);
        echo 'success';
    }

    function seller_review_refresh_pg() {
        $seller_id = base64_decode($this->uri->segment(2));
        $this->db->cache_on();
        $p['seller_review_data'] = $this->Product_descrp_model->retrieve_seller_review($seller_id);
        $config = array();
        $config["base_url"] = base_url() . "sellers/" . base64_encode($seller_id);
        $config["total_rows"] = $this->Product_descrp_model->retrieve_seller_datacount($seller_id);
        $config["per_page"] = 24;
        $config["uri_segment"] = 3;
        $config['page_query_string'] = TRUE;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 3;
        $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $this->pagination->initialize($config);
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $p['seller_data'] = $this->Product_descrp_model->retrieve_seller_data($config["per_page"], $page, $seller_id);
        $p['links'] = $this->pagination->create_links();
        $p['seller_badge'] = $this->Product_descrp_model->retrieve_seller_badge($seller_id);
        $p['data'] = $this->Product_descrp_model->view_product_descrp();
        if ($this->agent->is_mobile()) {
            $this->load->view('m/seller_review_pg', $p);
        } else {
            $this->load->view('seller_review_pg', $p);
        }
    }

    function click_ul_lifilter_dataajax() {
        $search_title = $this->input->post('search_title');
        $fq = str_replace('|||', '"', $this->input->post('fq'));
        $start_from = 0;
        $p['product_data'] = $this->Product_descrp_model->select_click_ul_lifilter_dataajax($search_title, $fq, $start_from);
        if ($this->agent->is_mobile()) {
            $this->load->view('m/search_firstproduct_pgwith_ajax', $p);
        } else {
            $this->load->view('newsearch_firstproduct_pgwith_ajaxview', $p);
        }
    }

    function click_ul_lifilter_moredataajax() {
        $search_title = $this->input->post('search_title');
        $fq = str_replace('|||', '"', $this->input->post('fq'));
        $start_from = $this->input->post('start_from');
        $p['product_data'] = $this->Product_descrp_model->select_click_ul_lifilter_dataajax($search_title, $fq, $start_from);

        if ($this->agent->is_mobile()) {
            $this->load->view('m/newsearch_moreproduct_pgwith_ajaxviewm', $p);
        } else {
            $this->load->view('newsearch_moreproduct_pgwith_ajaxview', $p);
        }
    }

    function filter_product_type() {
        $search_title = $this->input->post('search_data');
        $p['search_title'] = $search_title;
        $p['filter_data'] = $this->Product_descrp_model->select_product_type3rdsection($search_title);

        if ($this->agent->is_mobile()) {
            $this->load->view('m/product_typefilter_m', $p);
        } else {
            $this->load->view('product_typefilter', $p);
        }
    }

    function pricesortajax() {
        $search_title = $this->input->post('search_title');
        $sort_val = $this->input->post('sort_val');
        $start_from = $this->input->post('start_from');
        if ($sort_val == 'asc' || $sort_val == 'desc') {
            $p['product_data'] = $this->Product_descrp_model->select_pricesort_dataajax($search_title, $sort_val, $start_from);
        } else {
            $p['product_data'] = $this->Product_descrp_model->select_oldnewsort_dataajax($search_title, $sort_val, $start_from);
        }
        if ($this->agent->is_mobile()) {
            $this->load->view('m/search_firstproduct_pgwith_ajax', $p);
        } else {
            $this->load->view('newsearch_firstproduct_pgwith_ajaxview', $p);
        }
    }

    function show_more_pricesortajax() {
        $search_title = $this->input->post('search_title');
        $sort_val = $this->input->post('sort_val');
        $start_from = $this->input->post('start_from');
        if ($sort_val == 'asc' || $sort_val == 'desc') {
            $p['product_data'] = $this->Product_descrp_model->select_pricesort_dataajax($search_title, $sort_val, $start_from);
        } else {
            $p['product_data'] = $this->Product_descrp_model->select_oldnewsort_dataajax($search_title, $sort_val, $start_from);
        }
        if ($this->agent->is_mobile()) {
            $this->load->view('m/newsearch_moreproduct_pgwith_ajaxviewm', $p);
        } else {
            $this->load->view('newsearch_moreproduct_pgwith_ajaxview', $p);
        }
    }

    function pricesortajaxseg3() {
        $search_title = $this->input->post('search_title');
        $sort_val = $this->input->post('sort_val');
        $start_from = $this->input->post('start_from');
        $fqq = $this->input->post('fqq');

        if ($sort_val == 'asc' || $sort_val == 'desc') {
            $p['product_data'] = $this->Product_descrp_model->select_pricesortajaxseg3($search_title, $sort_val, $start_from, $fqq);
        } else {
            $p['product_data'] = $this->Product_descrp_model->select_oldnewsortajaxseg3($search_title, $sort_val, $start_from, $fqq);
        }
        if ($this->agent->is_mobile()) {
            $this->load->view('m/search_firstproduct_pgwith_ajax', $p);
        } else {
            $this->load->view('newsearch_firstproduct_pgwith_ajaxview', $p);
        }
    }

    function chk_box_pricesort() {
        $checked_product = $this->input->post('checked_product');
        $search_title = $this->input->post('search_title');
        $sort_val = $this->input->post('sort_val');
        $start_from = $this->input->post('start_from');
        $cnt_arr = count($checked_product);
        $fqq = '';
        for ($i = 0; $i < $cnt_arr; $i++) {

            list($v1, $v2, $v3) = explode("|", $checked_product[$i], 3);
            $v3 = str_replace(' ', '%20', $v3);
            if (strpos($fqq, $v2 . ':') !== false) {
                $fqq = rtrim($fqq, ")");
                $fqq = $fqq . 'OR"' . $v3 . '")';
            } else {
                if ($fqq == '') {
                    $fqq = $v2 . ':("' . $v3 . '")';
                } else {
                    $fqq = $fqq . '&fq=' . $v2 . ':("' . $v3 . '")';
                }
            }
        }
        if ($sort_val == 'asc' || $sort_val == 'desc') {
            $p['product_data'] = $this->Product_descrp_model->select_chk_box_pricesort($v1, $fqq, $search_title, $sort_val, $start_from);
        } else {
            $p['product_data'] = $this->Product_descrp_model->select_chk_box_oldnewsort($v1, $fqq, $search_title, $sort_val, $start_from);
        }

        if ($this->agent->is_mobile()) {
            $this->load->view('m/search_firstproduct_pgwith_ajax', $p);
        } else {
            $this->load->view('newsearch_firstproduct_pgwith_ajaxview', $p);
        }
    }

    function show_more_chk_box_pricesort() {
        $checked_product = $this->input->post('checked_product');
        $search_title = $this->input->post('search_title');
        $sort_val = $this->input->post('sort_val');
        $start_from = $this->input->post('start_from');

        $cnt_arr = count($checked_product);
        $fqq = '';
        for ($i = 0; $i < $cnt_arr; $i++) {


            list($v1, $v2, $v3) = explode("|", $checked_product[$i], 3);

            $v3 = str_replace(' ', '%20', $v3);
            if (strpos($fqq, $v2 . ':') !== false) {
                $fqq = rtrim($fqq, ")");
                $fqq = $fqq . 'OR"' . $v3 . '")';
            } else {
                if ($fqq == '') {
                    $fqq = $v2 . ':("' . $v3 . '")';
                } else {
                    $fqq = $fqq . '&fq=' . $v2 . ':("' . $v3 . '")';
                }
            }
        }
        if ($sort_val == 'asc' || $sort_val == 'desc') {
            $p['product_data'] = $this->Product_descrp_model->select_chk_box_pricesort($v1, $fqq, $search_title, $sort_val, $start_from);
        } else {
            $p['product_data'] = $this->Product_descrp_model->select_chk_box_oldnewsort($v1, $fqq, $search_title, $sort_val, $start_from);
        }
        if ($this->agent->is_mobile()) {
            $this->load->view('m/newsearch_moreproduct_pgwith_ajaxviewm', $p);
        } else {
            $this->load->view('newsearch_moreproduct_pgwith_ajaxview', $p);
        }
    }

    function ul_li_radio_pricesort() {
        $search_title = $this->input->post('search_title');
        $sort_val = $this->input->post('sort_val');
        $start_from = $this->input->post('start_from');
        $fq = str_replace(' ', '%20', str_replace('|||', '"', $this->input->post('fq')));
        $fq = $fq[0];

        if ($sort_val == 'asc' || $sort_val == 'desc') {
            $p['product_data'] = $this->Product_descrp_model->select_ul_li_radio_pricesort($search_title, $fq, $sort_val, $start_from);
        } else {
            $p['product_data'] = $this->Product_descrp_model->select_ul_li_radio_oldnewsort($search_title, $fq, $sort_val, $start_from);
        }
        if ($this->agent->is_mobile()) {
            $this->load->view('m/search_firstproduct_pgwith_ajax', $p);
        } else {
            $this->load->view('newsearch_firstproduct_pgwith_ajaxview', $p);
        }
    }

    function ul_li_radio_pricesortmore() {
        $search_title = $this->input->post('search_title');
        $sort_val = $this->input->post('sort_val');
        $start_from = $this->input->post('start_from');
        $fq = str_replace(' ', '%20', str_replace('|||', '"', $this->input->post('fq')));
        if ($sort_val == 'asc' || $sort_val == 'desc') {
            $p['product_data'] = $this->Product_descrp_model->select_ul_li_radio_pricesort($search_title, $fq, $sort_val, $start_from);
        } else {
            $p['product_data'] = $this->Product_descrp_model->select_ul_li_radio_oldnewsort($search_title, $fq, $sort_val, $start_from);
        }
        if ($this->agent->is_mobile()) {
            $this->load->view('m/newsearch_moreproduct_pgwith_ajaxviewm', $p);
        } else {
            $this->load->view('newsearch_moreproduct_pgwith_ajaxview', $p);
        }
    }

    function show_more_pricesortajaxseg3() {
        $search_title = $this->input->post('search_title');
        $sort_val = $this->input->post('sort_val');
        $start_from = $this->input->post('start_from');
        $fqq = $this->input->post('fqq');
        if ($sort_val == 'asc' || $sort_val == 'desc') {
            $p['product_data'] = $this->Product_descrp_model->select_pricesortajaxseg3($search_title, $sort_val, $start_from, $fqq);
        } else {
            $p['product_data'] = $this->Product_descrp_model->select_oldnewsortajaxseg3($search_title, $sort_val, $start_from, $fqq);
        }
        if ($this->agent->is_mobile()) {
            $this->load->view('m/newsearch_moreproduct_pgwith_ajaxviewm', $p);
        } else {
            $this->load->view('newsearch_moreproduct_pgwith_ajaxview', $p);
        }
    }

    function mtree2() {
        $search_title = $this->input->post('search_title');
        $mtree2id = $this->input->post('mtree2id');
        $p['mtree2id'] = $mtree2id;
        $Category_Lvl3_Id = urlencode($this->input->post('Category_Lvl3_Id'));
        $curl_strngparamid = SOLR_BASE_URL . SOLR_CORE_NAME . "/select?indent=on&wt=json&rows=1&start=0&fq=Category_Lvl3:(%22" . $Category_Lvl3_Id . "%22)&fl=Category_Lvl1_Id,Category_Lvl2_Id,Category_Lvl3_Id";

        $curl3 = curl_init($curl_strngparamid);
        curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
        $output3 = curl_exec($curl3);
        $data3 = json_decode($output3, true);
        $id = $data3['response']['docs'][0]['Category_Lvl1_Id'][0] . $data3['response']['docs'][0]['Category_Lvl2_Id'][0] . $data3['response']['docs'][0]['Category_Lvl3_Id'][0];
        $p['id'] = $id;
        $p['category_id'] = $data3['response']['docs'][0]['Category_Lvl3_Id'][0];
        $p['filter_dataid'] = $this->Product_descrp_model->select_datamtree2($search_title, $id, $Category_Lvl3_Id);

        if ($this->agent->is_mobile()) {
            $this->load->view('m/filter_data_ajaxview', $p);
        } else {
            $this->load->view('mtree_filter_data_ajaxview2', $p);
        }
    }

    function pricefilter_fromto() {
        $search_title = $this->input->post('search_title');
        $low_price = $this->input->post('low_price');
        $high_price = $this->input->post('high_price');
        $start_from = $this->input->post('start_from');

        $p['product_data'] = $this->Product_descrp_model->select_pricefilter_fromto_dataajax($search_title, $low_price, $high_price, $start_from);

        if ($this->agent->is_mobile()) {
            $this->load->view('m/search_firstproduct_pgwith_ajax', $p);
        } else {
            $this->load->view('newsearch_firstproduct_pgwith_ajaxview', $p);
        }
    }

    function pricefilter_fromto_more() {
        $search_title = $this->input->post('search_title');
        $low_price = $this->input->post('low_price');
        $high_price = $this->input->post('high_price');
        $start_from = $this->input->post('start_from');

        $p['product_data'] = $this->Product_descrp_model->select_pricefilter_fromto_dataajax($search_title, $low_price, $high_price, $start_from);

        if ($this->agent->is_mobile()) {
            $this->load->view('m/newsearch_moreproduct_pgwith_ajaxviewm', $p);
        } else {
            $this->load->view('newsearch_moreproduct_pgwith_ajaxview', $p);
        }
    }

    function ul_li_radio_pricefilter_fromto() {
        $search_title = $this->input->post('search_title');
        $low_price = $this->input->post('low_price');
        $high_price = $this->input->post('high_price');
        $start_from = $this->input->post('start_from');
        $fq = str_replace(' ', '%20', str_replace('|||', '"', $this->input->post('fq')));
        $fq = $fq[0];
        $p['product_data'] = $this->Product_descrp_model->select_ul_li_radio_pricefilter_fromto($search_title, $fq, $low_price, $high_price, $start_from);
        if ($this->agent->is_mobile()) {
            $this->load->view('m/search_firstproduct_pgwith_ajax', $p);
        } else {
            $this->load->view('newsearch_firstproduct_pgwith_ajaxview', $p);
        }
    }

    function ul_li_radio_pricefilter_fromto_more() {
        $search_title = $this->input->post('search_title');
        $low_price = $this->input->post('low_price');
        $high_price = $this->input->post('high_price');
        $start_from = $this->input->post('start_from');
        $fq = str_replace(' ', '%20', str_replace('|||', '"', $this->input->post('fq')));
        $fq = $fq[0];
        $p['product_data'] = $this->Product_descrp_model->select_ul_li_radio_pricefilter_fromto($search_title, $fq, $low_price, $high_price, $start_from);
        if ($this->agent->is_mobile()) {
            $this->load->view('m/newsearch_moreproduct_pgwith_ajaxviewm', $p);
        } else {
            $this->load->view('newsearch_moreproduct_pgwith_ajaxview', $p);
        }
    }

    function chk_box_pricefilter_fromto() {
        $checked_product = $this->input->post('checked_product');
        $search_title = $this->input->post('search_title');
        $low_price = $this->input->post('low_price');
        $high_price = $this->input->post('high_price');
        $start_from = $this->input->post('start_from');
        $cnt_arr = count($checked_product);
        $fqq = '';
        for ($i = 0; $i < $cnt_arr; $i++) {

            list($v1, $v2, $v3) = explode("|", $checked_product[$i], 3);
            $v3 = str_replace(' ', '%20', $v3);
            if (strpos($fqq, $v2 . ':') !== false) {
                $fqq = rtrim($fqq, ")");
                $fqq = $fqq . 'OR"' . $v3 . '")';
            } else {
                if ($fqq == '') {
                    $fqq = $v2 . ':("' . $v3 . '")';
                } else {
                    $fqq = $fqq . '&fq=' . $v2 . ':("' . $v3 . '")';
                }
            }
        }

        $p['product_data'] = $this->Product_descrp_model->select_chk_box_pricefilter_fromto($v1, $fqq, $search_title, $low_price, $high_price, $start_from);

        if ($this->agent->is_mobile()) {
            $this->load->view('m/search_firstproduct_pgwith_ajax', $p);
        } else {
            $this->load->view('newsearch_firstproduct_pgwith_ajaxview', $p);
        }
    }

    function chk_box_pricefilter_fromto_more() {
        $checked_product = $this->input->post('checked_product');
        $search_title = $this->input->post('search_title');
        $low_price = $this->input->post('low_price');
        $high_price = $this->input->post('high_price');
        $start_from = $this->input->post('start_from');
        $cnt_arr = count($checked_product);
        $fqq = '';
        for ($i = 0; $i < $cnt_arr; $i++) {

            list($v1, $v2, $v3) = explode("|", $checked_product[$i], 3);
            $v3 = str_replace(' ', '%20', $v3);
            if (strpos($fqq, $v2 . ':') !== false) {
                $fqq = rtrim($fqq, ")");
                $fqq = $fqq . 'OR"' . $v3 . '")';
            } else {
                if ($fqq == '') {
                    $fqq = $v2 . ':("' . $v3 . '")';
                } else {
                    $fqq = $fqq . '&fq=' . $v2 . ':("' . $v3 . '")';
                }
            }
        }
        $p['product_data'] = $this->Product_descrp_model->select_chk_box_pricefilter_fromto($v1, $fqq, $search_title, $low_price, $high_price, $start_from);
        if ($this->agent->is_mobile()) {
            $this->load->view('m/newsearch_moreproduct_pgwith_ajaxviewm', $p);
        } else {
            $this->load->view('newsearch_moreproduct_pgwith_ajaxview', $p);
        }
    }

    function pricefilter_fromto_seg3() {
        $search_title = $this->input->post('search_title');
        $low_price = $this->input->post('low_price');
        $high_price = $this->input->post('high_price');
        $start_from = $this->input->post('start_from');
        $fqq = $this->input->post('fqq');
        $p['product_data'] = $this->Product_descrp_model->select_pricefilter_fromto_ajaxseg3($search_title, $low_price, $high_price, $start_from, $fqq);

        if ($this->agent->is_mobile()) {
            $this->load->view('m/search_firstproduct_pgwith_ajax', $p);
        } else {
            $this->load->view('newsearch_firstproduct_pgwith_ajaxview', $p);
        }
    }

    function pricefilter_fromto_seg3_more() {
        $search_title = $this->input->post('search_title');
        $low_price = $this->input->post('low_price');
        $high_price = $this->input->post('high_price');
        $start_from = $this->input->post('start_from');
        $fqq = $this->input->post('fqq');
        $p['product_data'] = $this->Product_descrp_model->select_pricefilter_fromto_ajaxseg3($search_title, $low_price, $high_price, $start_from, $fqq);

        if ($this->agent->is_mobile()) {
            $this->load->view('m/newsearch_moreproduct_pgwith_ajaxviewm', $p);
        } else {
            $this->load->view('newsearch_moreproduct_pgwith_ajaxview', $p);
        }
    }

    function suggestword() {
        $this->load->helper('url');
        $search_title = urlencode($this->input->get('search_title'));
        $curl_strng = SOLR_BASE_URL . SOLR_CORE_NAME . "/select?indent=on&q=" . $search_title . "&facet=true&facet.field=Category_Lvl3&facet.field=Category_Lvl2&facet.field=Category_Lvl1&facet.mincount=1&wt=json&rows=1&start=0";
        $curl2 = curl_init($curl_strng);
        curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($curl2);
        $product_data = json_decode($output, true);
        if ($product_data['response']['numFound'] == 0) {
            $suggestword_arr = array();
            $cnt = count($product_data['spellcheck']['collations']);
            if ($cnt > 1) {
                $hitcount = 0;

                for ($i = 1; $i < $cnt; $i += 2) {
                    if ($product_data['spellcheck']['collations'][$i]['hits'] > $hitcount) {
                        $hitcount = $product_data['spellcheck']['collations'][$i]['hits'];
                        $hitname = $product_data['spellcheck']['collations'][$i]['collationQuery'];
                    }
                    array_push($suggestword_arr, $product_data['spellcheck']['collations'][$i]['collationQuery']);
                }
                $this->session->unset_userdata('sesson_searchword');
                $this->session->set_userdata('sesson_searchword', $search_title);
                $this->session->unset_userdata('sesson_suggestword_arr');
                $this->session->set_userdata('sesson_suggestword_arr', $suggestword_arr);
                redirect(base_url() . 'search-by/' . $hitname);
            } else {
                $this->session->unset_userdata('sesson_searchword');
                $this->session->unset_userdata('sesson_suggestword_arr');
                redirect(base_url() . 'search-by/' . $search_title);
            }
        } else {
            $this->session->unset_userdata('sesson_searchword');
            $this->session->unset_userdata('sesson_suggestword_arr');
            redirect(base_url() . 'search-by/' . $search_title);
        }
    }

    function arrck() {
        $textbox_val = $this->input->post('textbox_val');
        $textbox_id = $this->input->post('textbox_id');
        $checked_product = $this->input->post('checked_product');
        $search_title = $this->input->post('search_title');
        $start_from = $this->input->post('start_from');
        $cnt_arr = count($checked_product);
        $fqq = '';
        for ($i = 0; $i < $cnt_arr; $i++) {
            list($v1, $v2, $v3) = explode("|", $checked_product[$i], 3);
            $v3 = str_replace(' ', '%20', $v3);
            if (strpos($fqq, $v2 . ':') !== false) {
                $fqq = rtrim($fqq, ")");
                $fqq = $fqq . 'OR"' . $v3 . '")';
            } else {
                if ($fqq == '') {
                    $fqq = $v2 . ':("' . $v3 . '")';
                } else {
                    $fqq = $fqq . '&fq=' . $v2 . ':("' . $v3 . '")';
                }
            }
        }
        if (strpos($fqq, '&fq=') !== false) {
            $fqq = substr($fqq, 0, strpos($fqq, "&fq="));
        }
        $curl_strng = SOLR_BASE_URL . SOLR_CORE_NAME . '/select?indent=on&wt=json&rows=1&start=0&q=' . $search_title . '&useParams=' . $v1 . '&fq=' . $fqq . ' ';
        $curl2 = curl_init($curl_strng);
        curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($curl2);
        $filter_data = json_decode($output, true);

        $arrbrand1 = array('0' => 'Type', '1' => 'Brand', '2' => 'Color', '3' => 'Size', '4' => 'Age Group', '5' => 'Design');
        if (@$filter_data['facet_counts']['facet_fields']) {
            $arrbrand = array_keys($filter_data['facet_counts']['facet_fields']);
            $cnt_brand = count($arrbrand);
            if ($cnt_brand > 0) {

                $afterckbox_val = array();
                $productcount = array();
                for ($i_arrbrand = 0; $i_arrbrand < $cnt_brand; $i_arrbrand++) {
                    $attrb_chk = str_replace('_', ' ', $attribute = $arrbrand[$i_arrbrand]);
                    if (in_array($attrb_chk, $arrbrand1)) {
                        if (count($filter_data['facet_counts']['facet_fields'][$attribute]) > 0) {
                            $cnt = count($filter_data['facet_counts']['facet_fields'][$attribute]);
                            for ($i = 0, $j = 1; $i < $cnt - 1; $i += 2, $j += 2) {
                                if ($filter_data['facet_counts']['facet_fields'][$attribute][$j] > 0) {
                                    array_push($afterckbox_val, $attribute . ':' . @$filter_data['facet_counts']['facet_fields'][$attribute][$i]);
                                    array_push($productcount, @$filter_data['facet_counts']['facet_fields'][$attribute][$j]);
                                }
                            }
                        }
                    }
                }
            }
        }
        $final_divid = array();
        $final_productcount = array();

        for ($key_i = 0; $key_i < count($afterckbox_val); $key_i++) {
            $key = array_search($afterckbox_val[$key_i], $textbox_val);
            array_push($final_divid, $textbox_id[$key]);
            array_push($final_productcount, $productcount[$key_i]);
        }
        $finalid = implode(",", $final_divid);
        $productcount = implode(",", $final_productcount);
        echo $finalid_count = $finalid . '|' . $productcount;
        exit;
    }

    function arrck2() {
        $textbox_val = $this->input->post('textbox_val');
        $textbox_id = $this->input->post('textbox_id');
        $checked_product = $this->input->post('checked_product');
        $search_title = $this->input->post('search_title');
        $start_from = $this->input->post('start_from');
        $cnt_arr = count($checked_product);
        $fqq = '';
        for ($i = 0; $i < $cnt_arr; $i++) {
            list($v1, $v2, $v3) = explode("|", $checked_product[$i], 3);
            $v3 = str_replace(' ', '%20', $v3);
            if (strpos($fqq, $v2 . ':') !== false) {
                $fqq = rtrim($fqq, ")");
                $fqq = $fqq . 'OR"' . $v3 . '")';
            } else {
                if ($fqq == '') {
                    $fqq = $v2 . ':("' . $v3 . '")';
                } else {
                    $fqq = $fqq . '&fq=' . $v2 . ':("' . $v3 . '")';
                }
            }
        }
        if (strpos($fqq, '&fq=') !== false) {
            if (strpos($fqq, 'Brand:') !== false) {
                $split = explode("Brand:", $fqq);
                $fqq = $split[1];
                if (strpos($fqq, '&fq=') !== false) {
                    $fqq = substr($fqq, 0, strpos($fqq, "&fq="));
                }
            } else {
                echo 'nobrandselect';
                exit;
            }
        } else {
            if (strpos($fqq, 'Brand:') !== false) {
                $fqq = substr($fqq, 6);
            } else {
                echo 'nobrandselect';
                exit;
            }
        }
        $curl_strng = SOLR_BASE_URL . SOLR_CORE_NAME . '/select?indent=on&wt=json&rows=1&start=0&q=' . $search_title . '&useParams=' . $v1 . '&fq=Brand:' . $fqq . ' ';
        $curl2 = curl_init($curl_strng);
        curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($curl2);
        $filter_data = json_decode($output, true);
        if (@$filter_data['facet_counts']['facet_fields']) {
            $arrbrand = array_keys($filter_data['facet_counts']['facet_fields']);
            $cnt_brand = count($arrbrand);
            if ($cnt_brand > 0) {
                $afterckbox_val = array();
                $productcount = array();
                for ($i_arrbrand = 0; $i_arrbrand < $cnt_brand; $i_arrbrand++) {
                    $attrb_chk = str_replace('_', ' ', $attribute = $arrbrand[$i_arrbrand]);
                    if (count($filter_data['facet_counts']['facet_fields'][$attribute]) > 0) {
                        $cnt = count($filter_data['facet_counts']['facet_fields'][$attribute]);
                        for ($i = 0, $j = 1; $i < $cnt - 1; $i += 2, $j += 2) {
                            if ($filter_data['facet_counts']['facet_fields'][$attribute][$j] > 0) {
                                array_push($afterckbox_val, $filter_data['responseHeader']['params']['useParams'] . ':' . $attribute . ':' . @$filter_data['facet_counts']['facet_fields'][$attribute][$i]);
                                array_push($productcount, @$filter_data['facet_counts']['facet_fields'][$attribute][$j]);
                            }
                        }
                    }
                }
            }
        }
        $final_divid = array();
        $final_productcount = array();

        for ($key_i = 0; $key_i < count($afterckbox_val); $key_i++) {
            if (in_array($afterckbox_val[$key_i], $textbox_val)) {
                $key = array_search($afterckbox_val[$key_i], $textbox_val);
                array_push($final_divid, $textbox_id[$key]);
                array_push($final_productcount, $productcount[$key_i]);
            }
        }
        $finalid = implode(",", $final_divid);
        $productcount = implode(",", $final_productcount);
        echo $finalid_count = $finalid . '|' . $productcount;
        exit;
    }

}

?>