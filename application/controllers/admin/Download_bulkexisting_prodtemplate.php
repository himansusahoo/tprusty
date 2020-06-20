<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Download_bulkexisting_prodtemplate Extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('html', 'form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('upload');
        $this->load->library('javascript');
        $this->load->helper('string');
        $this->load->database();
        $this->load->model('admin/Download_bulkexisitng_porducttemplate_model');
    }

    function download_extprodtemplate() {
        if ($this->session->userdata('logged_in')) {

            /* $catg_id=$this->uri->segment(4);
              $attr_group_id=$this->uri->segment(5);
              $seller_id=$this->uri->segment(6); */

            $catg_id = $this->input->post('hiddenbox_catgrid');
            $attr_group_id = $this->input->post('hiddenbox_attrbsetid');
            $seller_id = $this->input->post('hiddenbox_sellerid');
            $productids = $this->input->post('prodid_chk');

            $srlz_prodiids = serialize($productids);

            $data['exist_product'] = $this->Download_bulkexisitng_porducttemplate_model->select_existprodtemplat($catg_id, $attr_group_id, $productids);


            $dt_rec = preg_replace("/[^0-9]+/", "", date('d-m-Y H:i:s'));
            $rand_string = random_string('alnum', 10);

            //$this->load->model('admin/Downlaod_bulkprodtemplatemodel');
            $data['catgnm'] = $this->Download_bulkexisitng_porducttemplate_model->select_catgnm($catg_id);
            $data['rand_string'] = $rand_string;
            $data['dt_rec'] = $dt_rec;
            $catgnm = $data['catgnm'];
            //attribute headin retrive start			
            $this->load->model('admin/Attribute_model');
            $data['attr_heading_result'] = $this->Attribute_model->retrieve_attr_headings($attr_group_id);
            $data['attr_extheading_result'] = $this->Download_bulkexisitng_porducttemplate_model->retrieve_extprodattr_headings($attr_group_id);
            $cur_dt = date('y-m-d H:i:s');

            $exl_filename = str_replace("'", "", stripslashes(preg_replace('#"#', "_", preg_replace('#/#', "_", str_replace(',', '_', str_replace('&', '', str_replace(' ', '_', strtolower($catgnm)))))))) . "_" . $rand_string . "_" . $dt_rec . "_existingproduct.xls";

            $this->Download_bulkexisitng_porducttemplate_model->insertexist_excelsheetlog($cur_dt, $exl_filename, $seller_id, $catg_id, $attr_group_id, $srlz_prodiids);


            $data['color_result'] = $this->Attribute_model->retrieve_colors();
            $data['size_result'] = $this->Attribute_model->retrieve_size();
            $data['sub_size_result'] = $this->Attribute_model->retrieve_sub_size();


            $this->load->view('admin/existingproduct_singlesellerexcelsheet', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

}

?>	