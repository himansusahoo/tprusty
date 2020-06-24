<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Attribute extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
        $this->load->library('form_validation');
        $this->load->library('email');
        
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->library('upload');
        
        $this->load->model('admin/Attribute_model');
        $this->load->library('pagination');
    }

    function index() {
        if ($this->session->userdata('logged_in')) {
            $data['msg'] = "";

            $data['result'] = $this->Attribute_model->retrive_attribute_group();
            $this->load->view('admin/manage_attribute_group', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function add_new_attribute_group() {

        if ($this->session->userdata('logged_in')) {

            $this->load->view('admin/add_attribute_group');
        } else {
            redirect('admin/super_admin');
        }
    }

    function insert_new_attribute_group() {
        if ($this->session->userdata('logged_in')) {
            $p = $this->Attribute_model->insert_attriute_group();

            redirect('admin/Attribute/load_attribute_group/' . $p);
        } else {
            redirect('admin/super_admin');
        }
    }

    function load_attribute_group() {
        $data['msg'] = "";
        if ($this->session->userdata('logged_in')) {

            $res = $this->uri->segment(4);
            if ($res == true) {
                $data['msg'] = "Record Saved Successfully";
            } else {
                $data['msg'] = "Record Saved Failure";
            }

            $data['result'] = $this->Attribute_model->retrive_attribute_group();
            $this->load->view('admin/manage_attribute_group', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function add_new_attribute() {
        if ($this->session->userdata('logged_in')) {
            $data['msg'] = "";
            $data['result'] = $this->Attribute_model->retrive_attribute();
            $data['result_attr_group'] = $this->Attribute_model->retrive_product_attribute_group();
            $this->load->view('admin/add_new_attribute', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function insert_new_attribute() {
        if ($this->session->userdata('logged_in')) {

            $data['result'] = $this->Attribute_model->retrive_attribute_group();
            $this->load->view('admin/create_new_attribute', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function insert_new_attribute_data() {
        if ($this->session->userdata('logged_in')) {

            $res = $this->Attribute_model->insert_new_attributedata();

            redirect('admin/Attribute/load_attribute_list/' . $res);
        } else {
            redirect('admin/super_admin');
        }
    }

    function load_attribute_list() {
        if ($this->session->userdata('logged_in')) {


            $data['msg'] = "";
            $res = $this->uri->segment(4);
            if ($res == true) {
                $data['msg'] = "Record Saved Successfully";
            } else {
                $data['msg'] = "Record Saved Failure";
            }

            $data['result'] = $this->Attribute_model->retrive_attribute();
            $data['result_attr_group'] = $this->Attribute_model->retrive_product_attribute_group();
            $this->load->view('admin/add_new_attribute', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function filter_attribute_group() {
        if ($this->session->userdata('logged_in')) {

            $data['msg'] = "";


            $data['result'] = $this->Attribute_model->filter_attributegroup();
            $this->load->view('admin/manage_attribute_group', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function delete_attribute_group() {
        if ($this->session->userdata('logged_in')) {

            $data['result'] = $this->Attribute_model->delete_attributegroup();
            echo "success";
            exit;
        } else {
            redirect('admin/super_admin');
        }
    }

    function edit_attribute_group() {
        if ($this->session->userdata('logged_in')) {

            $atrb_group_id = $this->uri->segment(4);
            $data['result'] = $this->Attribute_model->retrive_attribute_group_edit($atrb_group_id);
            $this->load->view('admin/edit_attribute_group', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function edit_attributegroup_data() {
        if ($this->session->userdata('logged_in')) {

            $p = $this->Attribute_model->edit_attributegroup_info();

            redirect('admin/Attribute/load_attribute_group/' . $p);
        } else {
            redirect('admin/super_admin');
        }
    }

    function edit_attribute() {
        if ($this->session->userdata('logged_in')) {
            $atrb_hedng_id = $this->uri->segment(4);
            $data['result'] = $this->Attribute_model->retrive_attribute_group();
            $data['atrb_data'] = $this->Attribute_model->retrive_attribute_for_edit($atrb_hedng_id);
            $this->load->view('admin/edit_attribute', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function update_attribute_data() {
        if ($this->session->userdata('logged_in')) {

            $res = $this->Attribute_model->update_attributedata();

            redirect('admin/attribute/load_attribute_list/' . $res);
        } else {
            redirect('admin/super_admin');
        }
    }

    function delete_attribute() {
        if ($this->session->userdata('logged_in')) {

            $data['result'] = $this->Attribute_model->delete_attribute_data();
            echo "success";
            exit;
        } else {
            redirect('admin/super_admin');
        }
    }

    function delete_attribute_field() {
        if ($this->session->userdata('logged_in')) {
            $data['result'] = $this->Attribute_model->delete_attribute_field_data();
            echo "success";
            exit;
        } else {
            redirect('admin/super_admin');
        }
    }

    function filter_attribute() {
        if ($this->session->userdata('logged_in')) {

            $data['msg'] = "";
            $data['result'] = $this->Attribute_model->filtered_attribute();
            $data['result_attr_group'] = $this->Attribute_model->retrive_product_attribute_group();
            $this->load->view('admin/add_new_attribute', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function add_attribute_details() {
        if ($this->session->userdata('logged_in')) {
            $attr_group_id = $this->uri->segment(4);  //not required now
            $attr_heading_id = $this->uri->segment(5);
            $data['attr_group_heading_res'] = $this->Attribute_model->retrieve_attr_heading_n_group($attr_heading_id);
            $data['attr_fld_res'] = $this->Attribute_model->retrieve_attr_field_details($attr_heading_id);
            $this->load->view('admin/add_attribute_details', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function save_atribute_name() {
        $result = $this->Attribute_model->insert_attribute_field_name();
        if ($result == true) {
            echo 'success';
        }
    }

    function show_attr_headings() {
        $attr_group_id = $this->input->post('group_id');
        $data['attr_heading_result'] = $this->Attribute_model->retrieve_attr_headings($attr_group_id);
        //$data['attr_field_result'] = $this->Attribute_model->retrieve_all_attribute_field();
        $data['color_result'] = $this->Attribute_model->retrieve_colors();
        $data['size_result'] = $this->Attribute_model->retrieve_size();
        $data['sub_size_result'] = $this->Attribute_model->retrieve_sub_size();
        $this->load->view('admin/load_attr_ajx', $data);
    }

    function show_attr_headings_for_filter() {
        $attr_group_id = $this->input->post('group_id');
        $data['attr_heading_result'] = $this->Attribute_model->retrieve_attr_headings($attr_group_id);
        $data['filter_attr_result'] = $this->Attribute_model->retrieve_filter_attr_data($attr_group_id);
        $this->load->view('admin/load_attr_ajx_for_filter', $data);
    }

    function edit_attribute_field() {
        $result = $this->Attribute_model->update_attribute_fields();
        if ($result == true) {
            echo 'success';
        }
    }

}

?>