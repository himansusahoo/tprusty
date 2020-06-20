<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bulk_productdelete extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('html', 'form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('upload');
        $this->load->library('javascript');
        $this->load->helper('string');
        $this->load->database();
        //$this->load->model('Corenjob_product_model')
        $this->load->model('admin/Bulk_productdeletemodel');
    }

    function bulk_newprod_deletepanel() {
        if ($this->session->userdata('logged_in')) {

            $data['srch_catg'] = $this->Bulk_productdeletemodel->select_allcategory();
            $data['srch_attrb'] = $this->Bulk_productdeletemodel->select_allattrb();

            $this->load->view('admin/bulknewproduct_deletepanel', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function search_productselect() {
        if ($this->session->userdata('logged_in')) {

            $data['srch_prod'] = $this->Bulk_productdeletemodel->search_bulknewprodfordelete();

            $this->load->view('admin/bulknewproductdelete_searchedproductajax', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function search_productasexcelsheet() {
        if ($this->session->userdata('logged_in')) {

            $config['upload_path'] = './bulk_proddeleteexcelsheet/';
            //$config['allowed_types'] = 'doc|pdf|docx|zip|rar';
            $config['allowed_types'] = '*';
            $config['max_size'] = '100000';

            $this->upload->initialize($config);


            if (!$this->upload->do_upload()) {
                $this->upload->display_errors();
            } else {
                $data = $this->upload->data();
                $excl_filename = $data['file_name'];


                $data['srch_prod'] = $this->Bulk_productdeletemodel->validwithinsert_bulkproddelete($excl_filename);


                $output_dir = "./bulk_proddeleteexcelsheet/";
                $filePath = $output_dir . $excl_filename;
                unlink($filePath);


                $this->load->view('admin/bulknewproductdelete_searchedproductajax', $data);
            }
        } else {
            redirect('admin/super_admin');
        }
    }

    public function delete_selectedproduct() {
        if ($this->session->userdata('logged_in')) {

            $this->Bulk_productdeletemodel->delete_bulkselectedproduct();
        } else {
            redirect('admin/super_admin');
        }
    }

    function order_details() {
        if ($this->session->userdata('logged_in')) {

            $order_sku = $this->uri->segment(4);
            $order_data['orderinfo'] = $this->Bulk_productdeletemodel->select_orderdetail($order_sku);

            $this->load->view('admin/deleteproduct_orderinfo', $order_data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function wishlist_details() {
        if ($this->session->userdata('logged_in')) {

            $wishlist_sku = $this->uri->segment(4);
            $wishlist_data['wishlistinfo'] = $this->Bulk_productdeletemodel->select_wishlistdetail($wishlist_sku);

            $this->load->view('admin/deleteproduct_wishlistinfo', $wishlist_data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function cart_details() {
        if ($this->session->userdata('logged_in')) {

            $cart_sku = $this->uri->segment(4);
            $cart_data['cartinfo'] = $this->Bulk_productdeletemodel->select_cartdetail($cart_sku);

            $this->load->view('admin/deleteproduct_cartinfo', $cart_data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function extingprodsku_details() {
        if ($this->session->userdata('logged_in')) {

            $ext_prodid = $this->uri->segment(4);
            $sku_data['skuinfo'] = $this->Bulk_productdeletemodel->select_skudetail($ext_prodid);

            $this->load->view('admin/deleteexitingproduct_skuinfo', $sku_data);
        } else {
            redirect('admin/super_admin');
        }
    }

    public function searchby_productselect() {
        if ($this->session->userdata('logged_in')) {

            $data['srch_prod'] = $this->Bulk_productdeletemodel->searchby_bulknewprodfordelete();

            $this->load->view('admin/bulknewproductdelete_searchedproductajax', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

}

?>