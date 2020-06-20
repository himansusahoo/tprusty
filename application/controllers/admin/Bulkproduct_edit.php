<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bulkproduct_edit Extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('html', 'form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('upload');
        $this->load->library('javascript');
        $this->load->helper('string');
        $this->load->database();
        //$this->load->model('admin/Bulkporductupload_model');
        $this->load->model('admin/Bulkporductedit_model');
    }

    function bulkproduct_editpanel() {
        if ($this->session->userdata('logged_in')) {

            $seller_id = $this->uri->segment(4);

            $this->load->model('admin/Seller_model');
            $this->load->model('admin/Bulkporductupload_model');
            $data['categories'] = $this->Seller_model->getCategories();
            //$data['attrbset'] = $this->Bulkporductupload_model->getattributeset();
            //$data['edit_attrbset'] = $this->Bulkporductedit_model->getedit_attributeset($seller_id);
            $data['editedprod_catg'] = $this->Bulkporductedit_model->sellerprod_category($seller_id);


            $data['seller_id'] = $this->uri->segment(4);

            $this->load->view('admin/bulkproductedit_singleseller', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function bulk_producteditemplate() {
        if ($this->session->userdata('logged_in')) {

            $catg_id = $this->uri->segment(4);
            $attr_group_id = $this->uri->segment(5);
            $seller_id = $this->uri->segment(6);

            $data['edited_product'] = $this->Bulkporductedit_model->select_editprodtemplatedidwise($seller_id, $catg_id, $attr_group_id);


            $dt_rec = preg_replace("/[^0-9]+/", "", date('d-m-Y H:i:s'));
            $rand_string = random_string('alnum', 10);

            $this->load->model('admin/Downlaod_bulkprodtemplatemodel');
            $data['catgnm'] = $this->Downlaod_bulkprodtemplatemodel->select_catgnm($catg_id);
            $data['rand_string'] = $rand_string;
            $data['dt_rec'] = $dt_rec;
            $catgnm = $data['catgnm'];
            //attribute headin retrive start			
            $this->load->model('admin/Attribute_model');
            $data['attr_heading_result'] = $this->Attribute_model->retrieve_attr_headings($attr_group_id);

            $cur_dt = date('y-m-d H:i:s');
            $exl_filename = str_replace("'", "", stripslashes(preg_replace('#"#', "_", preg_replace('#/#', "_", str_replace(',', '_', str_replace('&', '', str_replace(' ', '_', strtolower($catgnm)))))))) . "_" . $rand_string . "_" . $dt_rec . "_edited.xls";
            $this->Bulkporductedit_model->insertedit_excelsheetlog($cur_dt, $exl_filename, $seller_id, $catg_id, $attr_group_id);


            $data['color_result'] = $this->Attribute_model->retrieve_colors();
            $data['size_result'] = $this->Attribute_model->retrieve_size();
            $data['sub_size_result'] = $this->Attribute_model->retrieve_sub_size();


            $this->load->view('admin/editedproduct_singlesellerexcelsheet', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function edituploadlog_list() {
        if ($this->session->userdata('logged_in')) {

            $seller_id = $this->uri->segment(4);

            $data['uploadlist'] = $this->Bulkporductedit_model->select_edituploadlistsellerwise($seller_id);
            $data['seller_id'] = $seller_id;
            $this->load->view('admin/bulk_editedproductupload_log', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function generate_failededitedproductexcelsheet() {

        if ($this->session->userdata('logged_in')) {

            $upload_templateid = $this->uri->segment(4);
            $catg_id = $this->uri->segment(5);
            $attr_group_id = $this->uri->segment(6);
            $seller_id = $this->uri->segment(7);


            $data['failed_product'] = $this->Bulkporductedit_model->select_failed_editedprodtemplatedidwise($upload_templateid);


            date_default_timezone_set('Asia/Calcutta');

            $dt_rec = preg_replace("/[^0-9]+/", "", date('d-m-Y H:i:s'));
            $rand_string = random_string('alnum', 10);

            $data['catgnm'] = $this->Bulkporductedit_model->selectcatgnm($catg_id);
            $data['rand_string'] = $rand_string;
            $data['dt_rec'] = $dt_rec;
            $catgnm = $data['catgnm'];
            //attribute headin retrive start			
            $this->load->model('admin/Attribute_model');
            $data['attr_heading_result'] = $this->Attribute_model->retrieve_attr_headings($attr_group_id);

            $cur_dt = date('y-m-d H:i:s');
            $exl_filename = str_replace("'", "", stripslashes(preg_replace('#"#', "_", preg_replace('#/#', "_", str_replace(',', '_', str_replace('&', '', str_replace(' ', '_', strtolower($catgnm)))))))) . "_" . $rand_string . "_" . $dt_rec . "_editedfailed.xls";
            $this->Bulkporductedit_model->insertfailededited_excelsheetlog($cur_dt, $exl_filename, $seller_id, $attr_group_id, $catg_id, $upload_templateid);


            $data['color_result'] = $this->Attribute_model->retrieve_colors();
            $data['size_result'] = $this->Attribute_model->retrieve_size();
            $data['sub_size_result'] = $this->Attribute_model->retrieve_sub_size();


            $this->load->view('admin/failededitedproduct_singlesellerexcelsheet', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function select_sellerid() {
        $seller_id = $this->input->post('seler_id');
        $catg_id = $this->input->post('catg_id');

        $data['edit_attrbset'] = $this->Bulkporductedit_model->getedit_attributeset_ascatg($seller_id, $catg_id);

        $this->load->view('admin/attrbset_as_categorywise', $data);
    }

    function download_extprodtemplate() {


        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Existingproductadd_temmodel');
            /* $catg_id=$this->uri->segment(4);
              $attr_group_id=$this->uri->segment(5);
              $seller_id=$this->uri->segment(6); */

            $catg_id = $this->input->post('hiddenbox_catgrid');
            $attr_group_id = $this->input->post('hiddenbox_attrbsetid');
            $seller_id = $this->input->post('hiddenbox_sellerid');
            $productids = $this->input->post('prodid_chk');
            $prodchked_sku = $this->input->post('prodskuid_chk');

            $srlz_prodiids = serialize($productids);

            $data['exist_product'] = $this->Existingproductadd_temmodel->select_existprodtemplat($catg_id, $attr_group_id, $productids, $prodchked_sku);


            $dt_rec = preg_replace("/[^0-9]+/", "", date('d-m-Y H:i:s'));
            $rand_string = random_string('alnum', 10);

            //$this->load->model('admin/Downlaod_bulkprodtemplatemodel');
            $data['catgnm'] = $this->Existingproductadd_temmodel->select_catgnm($catg_id);
            $data['rand_string'] = $rand_string;
            $data['dt_rec'] = $dt_rec;
            $catgnm = $data['catgnm'];
            //attribute headin retrive start			
            $this->load->model('admin/Attribute_model');
            $data['attr_heading_result'] = $this->Attribute_model->retrieve_attr_headings($attr_group_id);
            $data['attr_extheading_result'] = $this->Existingproductadd_temmodel->retrieve_extprodattr_headings($attr_group_id);
            $cur_dt = date('y-m-d H:i:s');

            $exl_filename = str_replace("'", "", stripslashes(preg_replace('#"#', "_", preg_replace('#/#', "_", str_replace(',', '_', str_replace('&', '', str_replace(' ', '_', strtolower($catgnm)))))))) . "_" . $rand_string . "_" . $dt_rec . "_existingproduct.xls";

            $this->Existingproductadd_temmodel->insertexist_excelsheetlog($cur_dt, $exl_filename, $seller_id, $catg_id, $attr_group_id, $srlz_prodiids);


            $data['color_result'] = $this->Attribute_model->retrieve_colors();
            $data['size_result'] = $this->Attribute_model->retrieve_size();
            $data['sub_size_result'] = $this->Attribute_model->retrieve_sub_size();


            $this->load->view('admin/existingproduct_singlesellerexcelsheet', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function download_exting_editprodtemplate() {


        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Existing_editproductaddtemplatemodel');
            /* $catg_id=$this->uri->segment(4);
              $attr_group_id=$this->uri->segment(5);
              $seller_id=$this->uri->segment(6); */

            $catg_id = $this->input->post('hiddenbox_catgrid');
            $attr_group_id = $this->input->post('hiddenbox_attrbsetid');
            $seller_id = $this->input->post('hiddenbox_sellerid');
            $productids = $this->input->post('prodid_chk');
            $prod_sku = $this->input->post('ckh_sku');

            $srlz_prodiids = serialize($productids);

            //$data['exist_product']=$this->Existing_editproductaddtemplatemodel->select_existprodtemplat($catg_id,$attr_group_id,$productids);


            $data['exist_editproduct'] = $this->Existing_editproductaddtemplatemodel->select_existeditprodtemplat($catg_id, $attr_group_id, $productids, $seller_id, $prod_sku);


            $dt_rec = preg_replace("/[^0-9]+/", "", date('d-m-Y H:i:s'));
            $rand_string = random_string('alnum', 10);

            //$this->load->model('admin/Downlaod_bulkprodtemplatemodel');
            $data['catgnm'] = $this->Existing_editproductaddtemplatemodel->select_catgnm($catg_id);
            $data['rand_string'] = $rand_string;
            $data['dt_rec'] = $dt_rec;
            $catgnm = $data['catgnm'];
            //attribute headin retrive start			
            $this->load->model('admin/Attribute_model');
            $data['attr_heading_result'] = $this->Attribute_model->retrieve_attr_headings($attr_group_id);
            $data['attr_extheading_result'] = $this->Existing_editproductaddtemplatemodel->retrieve_extprodattr_headings($attr_group_id);
            $cur_dt = date('y-m-d H:i:s');

            $exl_filename = str_replace("'", "", stripslashes(preg_replace('#"#', "_", preg_replace('#/#', "_", str_replace(',', '_', str_replace('&', '', str_replace(' ', '_', strtolower($catgnm)))))))) . "_" . $rand_string . "_" . $dt_rec . "_existingeditproduct.xls";

            $this->Existing_editproductaddtemplatemodel->insertexist_editprodexcelsheetlog($cur_dt, $exl_filename, $seller_id, $catg_id, $attr_group_id, $srlz_prodiids);

            $data['color_result'] = $this->Attribute_model->retrieve_colors();
            $data['size_result'] = $this->Attribute_model->retrieve_size();
            $data['sub_size_result'] = $this->Attribute_model->retrieve_sub_size();


            $this->load->view('admin/existing_editeproductexcelsheet', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function bulkprod_process_status() {
        $data = $this->db->query("UPDATE product_process_status SET prod_edit='not process' WHERE status_id='1'");
        $this->load->view('admin/bulkproductedit_singleseller', $data);
    }

}

?>