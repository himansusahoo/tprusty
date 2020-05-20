<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_description_search extends CI_Controller {

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
        $this->load->helper('string');
        $this->load->helper('cookie');
        $this->load->library('user_agent');
        $this->load->database();
        $this->load->model('Product_descrp_search_model');
        $this->load->model('Mycart_model');
        //$this->load->library('breadcrumbs');
        //$this->load->model('Admin_model');
    }

    function product_search() {
        $p['data'] = $this->Product_descrp_search_model->view_product_descrp();
        $search_title = urldecode($this->input->get('search'));

        if ($this->session->userdata('sugstword')) {
            $this->session->unset_userdata('sugstword');
            $this->session->set_userdata('sugstword', '');
        }

        if ($this->agent->is_mobile()) {
            $this->load->view('m/search_product_pg', $p);
        } else {
            $this->load->view('d_new/newsearch_product_pgwith_ajax_view', $p);
        }
    }

    function search_firstproductloadajax() {
        $search_title = $this->input->post('search_data');
        $p['product_data'] = $this->Product_descrp_search_model->select_firstproductajax_search($search_title);

        if ($this->agent->is_mobile()) {
            $this->load->view('m/search_firstproduct_pgwith_ajax', $p);
        } else {
            $this->load->view('d_new/newsearch_firstproduct_pgwith_ajaxview', $p);
        }
    }

    /* function search_firstproductloadajaxmore()
      {	//echo '<pre>';print_r($_REQUEST);exit;
      $search_title=$this->input->post('search_data');
      $more=$this->input->post('more');
      $p['product_data']=$this->Product_descrp_search_model->select_firstproductajax_searchmore($search_title,$more);

      if ($this->agent->is_mobile())
      {$this->load->view('m/search_firstproduct_pgwith_ajax',$p);	}
      else
      {$this->load->view('d_new/newsearch_firstproduct_pgwith_ajaxview',$p);	}
      } */

    function show_more_search_product_data() {

        //echo '<pre>';print_r($_REQUEST);exit;
        $search_title = $this->input->get('title');
        $p['data'] = $this->Product_descrp_search_model->view_product_descrp();
        $p['sl_no'] = $this->input->get('from');
        $p['product_data'] = $this->Product_descrp_search_model->select_more_product_search_data($search_title);
        //echo '<pre>';print_r($p['product_data']);exit;
        if ($this->agent->is_mobile()) {
            $this->load->view('m/ajax_load_product_addtocart', $p);
        } else {
            $this->load->view('d_new/newsearch_moreproduct_pgwith_ajaxview', $p);
        }
    }

    function product_searchvewmorebtn_ajax() {
        $search_title = $this->input->post('search_data');
        //$p['product_data']=$this->Product_descrp_model->select_product_searchfirstcount($search_title);
        if ($this->session->userdata('prodcount_solr')) {
            //$p['no_of_product'] = $this->Product_descrp_model->select_product_search_count($search_title);

            $p['no_of_product'] = $this->session->userdata('prodcount_solr');

            if ($this->agent->is_mobile()) {
                $this->load->view('m/searchproductpg_viewmoreajaxbutton', $p);
            } else {
                $this->load->view('d_new/searchproductpg_viewmoreajaxbuttonn', $p);
            }
        }

        //echo "test mode";exit;
    }

    function product_searchcategory_ajax() {
        //echo "success";exit;
        $search_title = $this->input->post('search_data');
        $p['product_data'] = $this->Product_descrp_model->select_product_searchfirstcount($search_title);
        if ($p['product_data']->num_rows() > 0) {
            $p['catg_ids'] = $this->Product_descrp_model->select_categoryfor_searchpage($search_title);
            if ($this->agent->is_mobile()) {
                $this->load->view('m/searchproductpg_categoryajax', $p);
            } else {

                $this->load->view('d_new/searchproductpg_categoryajax', $p);
            }
        }
        //echo "test mode";exit;
    }

}

?>