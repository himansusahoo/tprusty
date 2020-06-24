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
        //$this->load->library('breadcrumbs');
        //$this->load->model('Admin_model');
    }

    function product_data() {
        $p['data'] = $this->Product_descrp_model->retrieve_category_meta_info();
        //$this->benchmark->mark('code_start');
        $catg_id = $this->uri->segment(4);
        $search_title = urldecode($this->input->post('search'));
        //$catg_id=strtoupper($this->$this->uri->segement(2));
        //$p['data']=$this->Product_descrp_model->view_product_descrp();
        //$catg_name=str_replace("-"," ",$this->uri->segment(3));	
        $p['brand_name'] = $this->Product_descrp_model->select_brand_name($catg_id);
        $p['product_image'] = $this->Product_descrp_model->select_product_image($catg_id);
        //$this->benchmark->mark('code_end'); 
        if ($this->agent->is_mobile()) {
            $this->load->view('m/subcategory_detail', $p);
        } else {
            $this->load->view('subcategory_detail', $p);
        }
    }

    /* function product_addtocart()
      {
      $p['data']=$this->Product_descrp_model->view_product_descrp();
      $catg_id=$this->uri->segment(4); */

    //$catg_name=str_replace("-"," ",$this->uri->segment(3));
    /* $parent_cat_id = $this->Product_descrp_model->retrieve_parent_cat_id($catg_id);
      $p['brand_name']=$this->Product_descrp_model->select_brand_name($parent_cat_id); */
    //$parent_category = $this->Product_descrp_model->retrieve_category_to_attribute($catg_id);
    //$p['brand_name'] = $this->Product_descrp_model->retrieve_attribute_brand_name($catg_id);
    //$p['filter_result'] = $this->Product_descrp_model->retrieve_filter_list_data();
    //$p['price_fltr_list'] = $this->Product_descrp_model->retrieve_price_fltr_list($catg_id);
    //$p['color_fltr_list'] = $this->Product_descrp_model->retrieve_color_fltr_list();
    /* $p['product_data'] = $this->Product_descrp_model->select_product_data_list($catg_id);
      $p['no_of_product'] = $this->Product_descrp_model->select_product_data_count($catg_id);
      $p['filter_fld_result'] = $this->Product_descrp_model->retrieve_filter_fld_data($catg_id);
      $this->load->view('product_addtocart',$p);
      } */

    function product_addtocart() {
        //$data['data'] = $this->Product_descrp_model->retrieve_category_meta_info();

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
            }
            $dskcatgid_id = $qr_lblid->row()->category_id;
        }

        $data['data'] = $this->Product_descrp_model->modf_retrieve_category_meta_info($seodskcatgid_id);
        $data['single_desc'] = $this->Product_descrp_model->single_category_meta_info($seodskcatgid_id);

        //$catg_id=str_replace('-',',',$this->uri->segment(4));

        $catg_id = str_replace('-', ',', $dskcatgid_id);

        if ($this->uri->segment(2) == '') {
            $data['product_data'] = $this->Product_descrp_model->select_product_data_list($catg_id, 'NOT');
            $data['no_of_product'] = $this->Product_descrp_model->select_product_data_count($catg_id, 'NOT');
            //$data['filter_fld_result'] = $this->Product_descrp_model->retrieve_filter_fld_data($catg_id,'NOT');
        } else {
            //$price_slab = ltrim($this->uri->segment(5),'price=');
            $last_segmt = $this->uri->segment(2);
            $data['product_data'] = $this->Product_descrp_model->select_product_data_list($catg_id, $last_segmt);
            $data['no_of_product'] = $this->Product_descrp_model->select_product_data_count($catg_id, $last_segmt);
            //$data['filter_fld_result'] = $this->Product_descrp_model->retrieve_filter_fld_data($catg_id,$last_segmt);
        }
        if ($this->agent->is_mobile()) {
            $this->load->model('Homemodel');
            $data['sec_info'] = $this->Homemodel->select_catlog_allsections();
            $data['data1'] = $this->Product_descrp_model->modf_retrieve_category_meta_info($seodskcatgid_id);
            $this->load->view('m/product_addtocart', $data);
        } else {
            $this->load->view('product_addtocart', $data);
        }
    }

    function product_addtocart_filter() {
        $label_name = $this->uri->segment(2);

        if ($this->agent->is_mobile()) {
            $qr_lblid = $this->db->query("SELECT * FROM category_menu_mobile WHERE url_displayname='$label_name'  ");
            if ($qr_lblid->num_rows() > 0) {
                $seocatg_id = $qr_lblid->row()->seo_categoryidlink;
                if ($seocatg_id > 0) {
                    $seodskcatgid_id = $seocatg_id;
                } else {
                    $seodskcatgid_id = $qr_lblid->row()->category_id;
                }
            }

            //$dskcatgid_id=$qr_lblid->row()->category_id;
        } else {

            $qr_lblid = $this->db->query("SELECT * FROM category_menu_desktop WHERE url_displayname='$label_name'  ");
            if ($qr_lblid->num_rows() > 0) {
                $seocatg_id = $qr_lblid->row()->seo_categoryidlink;

                if ($seocatg_id > 0) {
                    $seodskcatgid_id = $seocatg_id;
                } else {
                    $seodskcatgid_id = $qr_lblid->row()->category_id;
                }
            }
            //$dskcatgid_id=$qr_lblid->row()->category_id;
        }


        //$data['data'] = $this->Product_descrp_model->retrieve_category_meta_info();
        //$catg_id=str_replace('-',',',$this->uri->segment(4));
        $catg_id = str_replace('-', ',', $this->uri->segment(3));

        $data['data'] = $this->Product_descrp_model->modf_retrieve_category_meta_info($seodskcatgid_id);
        $data['single_desc'] = $this->Product_descrp_model->single_category_meta_info($seodskcatgid_id);

        if ($this->uri->segment(4) == '') {
            $data['product_data'] = $this->Product_descrp_model->select_product_data_listfilter($catg_id, 'NOT');
            $data['no_of_product'] = $this->Product_descrp_model->select_product_data_countfilter($catg_id, 'NOT');
            //$data['filter_fld_result'] = $this->Product_descrp_model->retrieve_filter_fld_data($catg_id,'NOT');
        } else {
            //$price_slab = ltrim($this->uri->segment(5),'price=');
            $last_segmt = $this->uri->segment(4);
            $data['product_data'] = $this->Product_descrp_model->select_product_data_listfilter($catg_id, $last_segmt);
            $data['no_of_product'] = $this->Product_descrp_model->select_product_data_countfilter($catg_id, $last_segmt);
            //$data['filter_fld_result'] = $this->Product_descrp_model->retrieve_filter_fld_data($catg_id,$last_segmt);
        }
        if ($this->agent->is_mobile()) {
            $this->load->model('Homemodel');
            $data['sec_info'] = $this->Homemodel->select_catlog_allsections();
            $this->load->view('m/product_addtocart', $data);
        } else {
            $this->load->view('product_addtocart', $data);
        }
    }

    function category_catalog() {
        //$data['data'] = $this->Product_descrp_model->retrieve_category_meta_info();
        //$catg_id=$this->uri->segment(4);

        $label_name = $this->uri->segment(2);

        if ($this->agent->is_mobile()) {

            $qr_lblid = $this->db->query("SELECT * FROM category_menu_mobile WHERE url_displayname='$label_name'  ");
            if ($qr_lblid->num_rows() > 0) {
                $label_id = $qr_lblid->row()->dskmenu_lbl_id;
                //$catg_id=$qr_lblid->row()->category_id;
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
                $this->load->view('m/category_catalog', $data);
            }
        } else {
            if ($view_type == 'category') {
                $this->load->view('subcategory_detail', $p);
            } else {
                $data['brand_name'] = $this->Product_descrp_model->catg_brand_name($label_id);
                $this->load->view('category_catalog', $data);
            }
        }
    }

    function category_catalog_filter() {
        //$data['data'] = $this->Product_descrp_model->retrieve_category_meta_info();
        //$catg_id=$this->uri->segment(4);
        //$label_id=$this->uri->segment(4);

        $label_name = $this->uri->segment(2);

        if ($this->agent->is_mobile()) {

            $qr_lblid = $this->db->query("SELECT * FROM category_menu_mobile WHERE url_displayname='$label_name'  ");
            if ($qr_lblid->num_rows() > 0) {
                $label_id = $qr_lblid->row()->dskmenu_lbl_id;
                //$catg_id=$qr_lblid->row()->category_id;
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


        $label_id = $this->uri->segment(3);
        $data['data'] = $this->Product_descrp_model->modf_retrieve_category_meta_info($label_id);
        $data['cat_id'] = $main_catgid;
        if ($this->uri->segment(4) == '') {
            $data['product_data'] = $this->Product_descrp_model->select_category_product_data_listfilter($label_id, 'NOT');
            $data['no_of_product'] = $this->Product_descrp_model->select_category_product_data_countfilter($label_id, 'NOT');
            //$data['filter_fld_result'] = $this->Product_descrp_model->category_catalog_filter_fld_data($label_id,'NOT');
            //$data['brand_name']=$this->Product_descrp_model->catg_brand_name($label_id);
        } else {
            //$price_slab = ltrim($this->uri->segment(5),'price=');
            $last_segmt = $this->uri->segment(4);
            $data['product_data'] = $this->Product_descrp_model->select_category_product_data_listfilter($label_id, $last_segmt);
            $data['no_of_product'] = $this->Product_descrp_model->select_category_product_data_countfilter($label_id, $last_segmt);
            //$data['filter_fld_result'] = $this->Product_descrp_model->category_catalog_filter_fld_data($label_id,$last_segmt);
            //$data['brand_name']=$this->Product_descrp_model->catg_brand_name($label_id);
        }
        if ($this->agent->is_mobile()) {
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
        //$p['sl_no'] = $this->uri->segment(3);

        if ($this->agent->is_mobile()) {
            $this->load->view('m/ajax_load_product_addtocart', $p);
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

    function filteredbrand() {
        $data['data'] = $this->Product_descrp_model->view_product_descrp();
        $cat_id = $this->uri->segment(4);
        $brand = ltrim($this->uri->segment(5), 'brnd&');
        $data['brand_name'] = $this->Product_descrp_model->retrieve_attribute_brand_name($cat_id);
        //$data['price_fltr_list'] = $this->Product_descrp_model->retrieve_price_fltr_list($cat_id);
        $data['product_data'] = $this->Product_descrp_model->filter_category_brand_data($cat_id, $brand);
        $this->load->view('product_addtocart', $data);
    }

    /* function filteredprice_data(){
      $data['data'] = $this->Product_descrp_model->view_product_descrp();
      $cat_id = $this->uri->segment(4);
      $price_slab = ltrim($this->uri->segment(5),'price=');
      $data['product_data'] = $this->Product_descrp_model->filter_category_price_data($cat_id,$price_slab);
      $data['no_of_product'] = $this->Product_descrp_model->filter_category_price_data_count($cat_id,$price_slab);
      $this->load->view('product_addtocart',$data);
      } */

    function multifilter() {
        $cat_id = $this->uri->segment(4);
        $data['data'] = $this->Product_descrp_model->view_product_descrp();
        $data['brand_name'] = $this->Product_descrp_model->retrieve_attribute_brand_name($cat_id);
        //$data['price_fltr_list'] = $this->Product_descrp_model->retrieve_price_fltr_list($cat_id);
        $data['product_data'] = $this->Product_descrp_model->filter_third_multi_data($cat_id);
        $this->load->view('product_addtocart', $data);
    }

    function filteredbrand_color() {
        $data['data'] = $this->Product_descrp_model->view_product_descrp();
        $cat_id = $this->uri->segment(4);
        $brand = ltrim($this->uri->segment(5), 'brnd&');
        $color_name = substr($this->uri->segment(6), 4);
        $data['brand_name'] = $this->Product_descrp_model->retrieve_attribute_brand_name($cat_id);
        //$data['price_fltr_list'] = $this->Product_descrp_model->retrieve_price_fltr_list($cat_id);
        $data['product_data'] = $this->Product_descrp_model->filter_category_brand_color_data($cat_id, $brand, $color_name);
        //$data['color_fltr_list'] = $this->Product_descrp_model->retrieve_color_fltr_list($brand);
        $this->load->view('product_addtocart', $data);
    }

    function filteredprice_color() {
        $data['data'] = $this->Product_descrp_model->view_product_descrp();
        $cat_id = $this->uri->segment(4);
        $price_slab = ltrim($this->uri->segment(5), 'prce&');
        $color_name = substr($this->uri->segment(6), 4);
        $data['brand_name'] = $this->Product_descrp_model->retrieve_attribute_brand_name($cat_id);
        //$data['price_fltr_list'] = $this->Product_descrp_model->retrieve_price_fltr_list($cat_id);
        $data['product_data'] = $this->Product_descrp_model->filter_category_price_color_data($cat_id, $price_slab, $color_name);
        //$data['color_fltr_list'] = $this->Product_descrp_model->retrieve_color_fltr_list($brand);
        $this->load->view('product_addtocart', $data);
    }

    function multifiltered() {
        $cat_id = $this->uri->segment(4);
        $data['data'] = $this->Product_descrp_model->view_product_descrp();
        $data['brand_name'] = $this->Product_descrp_model->retrieve_attribute_brand_name($cat_id);
        //$data['price_fltr_list'] = $this->Product_descrp_model->retrieve_price_fltr_list($cat_id);
        $data['product_data'] = $this->Product_descrp_model->filtered_multi_data($cat_id);
        $this->load->view('product_addtocart', $data);
    }

    function product_add() {
        $p['data'] = $this->Product_descrp_model->view_product_descrp();
        //$catg_name=str_replace("-"," ",$this->uri->segment(3));
        $name = urldecode($this->uri->segment(3));
        $cat_id = ($this->uri->segment(4));
        $p['product_data'] = $this->Product_descrp_model->select_product_list($name);
        $this->load->view('product_addtocart', $p);
    }

    /* function product_search()
      {
      $p['data']=$this->Product_descrp_model->view_product_descrp();
      $search_title=urldecode($this->input->get('search'));
      $p['product_data']=$this->Product_descrp_model->select_product_search($search_title);
      $p['catg_ids']=$this->Product_descrp_model->select_categoryfor_searchpage($search_title);
      $p['no_of_product'] = $this->Product_descrp_model->select_product_search_count($search_title);
      if ($this->agent->is_mobile())
      {
      $this->load->view('m/search_product_pg',$p);
      }
      else
      {

      $this->load->view('search_product_pg',$p);
      }
      } */

    function product_search() {
        $p['data'] = $this->Product_descrp_model->view_product_descrp();
        $search_title = urldecode($this->input->get('search'));


        //if(@$this->session->userdata['session_data']['user_id']!='5')
        //{
        // $p['catg_ids']=$this->Product_descrp_model->select_categoryfor_searchpage($search_title);
        //$p['no_of_product'] = $this->Product_descrp_model->select_product_search_count($search_title);

        if ($this->agent->is_mobile()) {
            //$p['product_data']=$this->Product_descrp_model->select_product_search($search_title); 
            //$p['catg_ids']=$this->Product_descrp_model->select_categoryfor_searchpage($search_title);
            //$p['no_of_product'] = $this->Product_descrp_model->select_product_search_count($search_title);	
            $this->load->view('m/search_product_pg', $p);
        } else {
            //$p['no_of_product'] = $this->Product_descrp_model->select_product_search_count($search_title);
            $this->load->view('search_product_pgwith_ajax', $p);
            //$this->load->view('search_product_pg',$p);
        }
        // }
        //else
        //{		  
        // $p['no_of_product'] = $this->Product_descrp_model->select_product_search_count($search_title); 
        //$this->load->view('search_product_pgwith_ajax',$p);  
        //}
    }

    function search_firstproductloadajax() {
        $search_title = $this->input->post('search_data');
        $p['product_data'] = $this->Product_descrp_model->select_firstproductajax_search($search_title);

        if ($this->agent->is_mobile()) {
            $this->load->view('m/search_firstproduct_pgwith_ajax', $p);
        } else {
            $this->load->view('search_firstproduct_pgwith_ajax', $p);
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
        //echo "test mode";exit;
    }

    function product_searchproductcount_ajax() {
        $search_title = $this->input->post('search_data');
        $p['product_data'] = $this->Product_descrp_model->select_product_searchfirstcount($search_title);
        if ($p['product_data']->num_rows() > 0) {
            $p['no_of_product'] = $this->Product_descrp_model->select_product_search_count($search_title);
            $this->load->view('searchproductpg_productcountajax', $p);
        }

        echo "test mode";
        exit;
    }

    function product_searchvewmorebtn_ajax() {
        $search_title = $this->input->post('search_data');
        $p['product_data'] = $this->Product_descrp_model->select_product_searchfirstcount($search_title);
        if ($p['product_data']->num_rows() > 0) {
            $p['no_of_product'] = $this->Product_descrp_model->select_product_search_count($search_title);

            if ($this->agent->is_mobile()) {
                $this->load->view('m/searchproductpg_viewmoreajaxbutton', $p);
            } else {
                $this->load->view('searchproductpg_viewmoreajaxbutton', $p);
            }
        }

        echo "test mode";
        exit;
    }

    function show_more_search_product_data() {
        $search_title = $this->input->get('title');
        $p['data'] = $this->Product_descrp_model->view_product_descrp();
        $p['sl_no'] = $this->input->get('from');
        $p['product_data'] = $this->Product_descrp_model->select_more_product_search_data($search_title);
        if ($this->agent->is_mobile()) {
            $this->load->view('m/ajax_load_product_addtocart', $p);
        } else {
            $this->load->view('ajax_load_product_addtocart', $p);
        }
    }

    function product_detail() {
        //$urisegment_prodname=$this->uri->segment(3);
        /* $product_id=$this->uri->segment(4);
          $sku_id = $this->uri->segment(5); */

        $product_id = $this->uri->segment(2);
        $sku_id = $this->uri->segment(3);

        /* $qr_prodnm=$this->db->query("SELECT * FROM cornjob_productsearch WHERE product_id='$product_id' AND sku='$sku_id' group by sku ");
          $proddbname=$qr_prodnm->row()->name;
          $proddbname_conv=preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($proddbname))));

          if($urisegment_prodname!=$proddbname_conv)
          {redirect('product_description/product_detail/'.$proddbname_conv.'/'.$product_id.'/'.$sku_id);} */


        $ctr = $this->Product_descrp_model->select_proddisplaystatus($product_id, $sku_id);
        if ($ctr > 0) {
            $qr_prodvwcount = $this->db->query("SELECT cronprod_viewcount FROM cornjob_productsearch WHERE product_id='$product_id' AND sku='$sku_id' group by sku ");
            $proddbviewcount = $qr_prodvwcount->row()->cronprod_viewcount + 1;

            $this->db->query("UPDATE cornjob_productsearch SET cronprod_viewcount='$proddbviewcount' WHERE product_id='$product_id' AND sku='$sku_id' ");

            $qr_prodcount = $this->db->query("SELECT prodview_count FROM product_viewcount WHERE product_id='$product_id' AND sku='$sku_id' group by sku ");
            $view_data = array();
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
                    'expire' => time() + 86500000
                );

                set_cookie($cookie);
            }

            //$p['other_seller_productid']=$this->Product_descrp_model->retrieve_same_productid_different_seller($product_id); //code by santanu dt:28-09-2016

            $p['other_seller_product'] = $this->Product_descrp_model->retrieve_same_product_different_seller($product_id, $sku_id);
            $p['seller_rating_result'] = $this->Product_descrp_model->retrieve_all_seller_rating();
            $p['product_attr_result'] = $this->Product_descrp_model->retrieve_indivisual_product_attr_headings($sku_id, $product_id);
            //$p['attribute_color'] = $this->Product_descrp_model->retrieve_attr_color_option($product_id);
            //$p['attribute_size'] = $this->Product_descrp_model->retrieve_attr_size_option($product_id);				
            //$p['attribute_capacity'] = $this->Product_descrp_model->retrieve_attr_capacity($product_id); //code by santanu dt:28-09-2016
            //$p['attribute_ram'] = $this->Product_descrp_model->retrieve_attr_ram($product_id);//code by santanu dt:28-09-2016
            //$p['attribute_rom'] = $this->Product_descrp_model->retrieve_attr_rom($product_id);//code by santanu dt:28-09-2016

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
                    $p['sec_info'] = $this->Homemodel->single_product_allsections($sku_id);
                    $this->load->view('m/single_product', $p);
                } else {
                    $this->load->view('single_product', $p);
                }
            }
        } else {
            redirect(base_url());
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
        //redirect('Product_description/load_product_descrp/'.$product_id.'/'.$sku_id);

        redirect($prod_name . '/' . $product_id . '/' . $sku_id);
    }

    function load_product_descrp() {
        $product_id = $this->uri->segment(3);
        $p['data_sku'] = $this->uri->segment(4);
        $sku_id = $this->uri->segment(4);
        $ctr = $this->Product_descrp_model->select_proddisplaystatus($product_id, $sku_id);
        if ($ctr > 0) {
            //$p['other_seller_productid']=$this->Product_descrp_model->retrieve_same_productid_different_seller($product_id); //code by santanu dt:28-09-2016
            $p['data'] = $this->Product_descrp_model->select_prodmeta_info($product_id, $sku_id);
            $p['page_title'] = $this->Product_descrp_model->select_pagetitle($product_id);

            $p['other_seller_product'] = $this->Product_descrp_model->retrieve_same_product_different_seller($product_id, $sku_id);
            $p['seller_rating_result'] = $this->Product_descrp_model->retrieve_all_seller_rating();
            $p['product_attr_result'] = $this->Product_descrp_model->retrieve_indivisual_product_attr_headings($sku_id, $product_id);
            $p['seller_badge'] = $this->Product_descrp_model->getSellerBadge($sku_id);

            //$p['attribute_color'] = $this->Product_descrp_model->retrieve_attr_color_option($product_id);
            //$p['attribute_size'] = $this->Product_descrp_model->retrieve_attr_size_option($product_id);
            //$p['attribute_capacity'] = $this->Product_descrp_model->retrieve_attr_capacity($product_id); //code by santanu dt:28-09-2016
            //$p['attribute_ram'] = $this->Product_descrp_model->retrieve_attr_ram($product_id);//code by santanu dt:28-09-2016
            //$p['attribute_rom'] = $this->Product_descrp_model->retrieve_attr_rom($product_id);//code by santanu dt:28-09-2016


            $p['related_prod'] = $this->Product_descrp_model->related_prod($product_id);
            $p['vertual_inventory_data'] = $this->Product_descrp_model->checking_vertual_inventory_data($sku_id);
            if (@$this->session->userdata['session_data']['user_id']) {
                //$p['shipping_fee_result'] = $this->Product_descrp_model->retrieve_shipping_fee($sku_id);
                //shipping fee function other seller product start///
                /* $user_address_id = $this->Product_descrp_model->retrieve_user_address_id();
                  if($user_address_id == 0){
                  $p['shipping_fee_data']=$this->Mycart_model->retrive_national_shipping_amount_seller_wise();
                  }else{
                  $p['shipping_fee_data']=$this->Mycart_model->retrive_shipping_amount_seller_wise();
                  } */
                //shipping fee function other seller product end///				

                /* $user_address_id = $this->Product_descrp_model->retrieve_user_address_id();
                  if($user_address_id == 0){
                  $p['shipping_fee_result'] = $this->Product_descrp_model->retrieve_shipping_fee_withount_login_n_address($sku_id);
                  }else{
                  $p['shipping_fee_result'] = $this->Product_descrp_model->retrieve_shipping_fee($sku_id);
                  } */
            } else {
                //$p['shipping_fee_result'] = 'non';
                //shipping fee function other seller product start///
                //$p['shipping_fee_data']=$this->Mycart_model->retrive_national_shipping_amount_seller_wise();
                //shipping fee function other seller product end///
            }
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
        //print_r($product_id);exit;
        $sku_id = $this->uri->segment(5);
        //echo current_url();exit;
        $attr_val = $this->uri->segment(6);
        if ($attr_val == '') {

            $this->Product_descrp_model->insert_addtocart_temp_withlogin($product_id, $sku_id);
        } else {
            $this->Product_descrp_model->insert_addtocart_temp_withlogin_attr($product_id, $sku_id, $attr_val);
        }
        //redirect('Product_description/load_product_descrp/'.$product_id.'/'.$sku_id);

        redirect($prod_name . '/' . $product_id . '/' . $sku_id);
    }

    function addtocart_buynow() {
        $product_id = $this->uri->segment(4);
        //print_r($product_id);exit;
        $sku_id = $this->uri->segment(5);
        //echo current_url();exit;
        $attr_val = $this->uri->segment(6);
        if ($attr_val == '') {
            $this->Product_descrp_model->insert_addtocart_temp_withlogin($product_id, $sku_id);
        } else {
            $this->Product_descrp_model->insert_addtocart_temp_withlogin_attr($product_id, $sku_id, $attr_val);
        }
        redirect('mycart/mycart_detail');
    }

    function addtocheckout() {
        $product_id = $this->uri->segment(4);
        //print_r($product_id);exit;
        $sku_id = $this->uri->segment(5);
        $this->Product_descrp_model->insert_checkout_withlogin($product_id, $sku_id);
        redirect('mycart/checkout_process');
    }

    function addtocheckout_buynow() {
        $product_id = $this->uri->segment(4);
        //print_r($product_id);exit;
        $sku_id = $this->uri->segment(5);
        $this->Product_descrp_model->insert_checkout_withlogin($product_id, $sku_id);
        redirect('mycart/mycart_detail');
    }

    function seller_rev_pg() {
        $seller_id = $this->input->post('seller_id');
        //print_r($seller_id);exit;
        $this->session->set_userdata('session_seller_id', $seller_id);
        echo 'success';
    }

    function seller_review_refresh_pg() {
        $seller_id = base64_decode($this->uri->segment(2));
        $seller_id = $this->encrypt->decode($seller_id);
        //$seller_id = $this->session->userdata('session_seller_id');
        //print_r($seller_id);exit;
        $p['seller_review_data'] = $this->Product_descrp_model->retrieve_seller_review($seller_id);

        $config = array();
        //$config["base_url"] = base_url()."Product_description/seller_review_refresh_pg";

        $config["base_url"] = base_url() . "sellers/" . base64_encode($this->encrypt->encode($seller_id));
        $config["total_rows"] = $this->Product_descrp_model->retrieve_seller_datacount($seller_id);
        $config["per_page"] = 24;
        $config["uri_segment"] = 3;
        //$config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = TRUE;
        $choice = $config["total_rows"] / $config["per_page"];
        //print_r(round($choice));exit;
        //$config["num_links"] = round($choice);
        $config["num_links"] = 3;
        $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';


        $this->pagination->initialize($config);
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

        $p['seller_data'] = $this->Product_descrp_model->retrieve_seller_data($config["per_page"], $page, $seller_id);
        $p['links'] = $this->pagination->create_links();


        //$p['seller_data'] = $this->Product_descrp_model->retrieve_seller_data($seller_id);
        $p['seller_badge'] = $this->Product_descrp_model->retrieve_seller_badge($seller_id);
        //print_r($p);exit;
        $p['data'] = $this->Product_descrp_model->view_product_descrp();
        if ($this->agent->is_mobile()) {
            $this->load->view('m/seller_review_pg', $p);
        } else {
            $this->load->view('seller_review_pg', $p);
        }
    }

}

?>