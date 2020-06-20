<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Solar_manage extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('html', 'form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->database();
        $this->load->library('pagination');
        $this->load->model('admin/Solar_manage_model');
    }

    function index() {

        if ($this->session->userdata('logged_in')) {

            $config = array();
            $config["base_url"] = base_url() . "admin/Solar_manage/";
            $config["total_rows"] = $this->Solar_manage_model->solar_indexing_count();
            $config["per_page"] = 1000;
            $config["uri_segment"] = 2;
            //$config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;

            $config['enable_query_strings'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];

            //$config["num_links"] = round($choice);
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $data['solar_indx_info'] = $this->Solar_manage_model->select_solar_indexing($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();


            $data['totrec'] = $config["total_rows"];
            $this->load->view('admin/solar_manage_indexing', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function edited_productindex() {
        if ($this->session->userdata('logged_in')) {

            $config = array();
            $config["base_url"] = base_url() . "admin/Solar_manage/edited_productindex";
            $config["total_rows"] = $this->Solar_manage_model->solar_editprodindexing_count();
            $config["per_page"] = 1000;
            $config["uri_segment"] = 2;
            //$config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;
            $config['enable_query_strings'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];

            //$config["num_links"] = round($choice);
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $data['solar_indx_info'] = $this->Solar_manage_model->select_solar_editedindexing($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();

            $data['totrec'] = $config["total_rows"];
            $this->load->view('admin/solar_manage_editedindexing', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function removed_productindex() {

        if ($this->session->userdata('logged_in')) {

            $config = array();
            $config["base_url"] = base_url() . "admin/Solar_manage/removed_productindex";
            $config["total_rows"] = $this->Solar_manage_model->solar_deletedprodindexing_count();
            $config["per_page"] = 1000;
            $config["uri_segment"] = 2;
            //$config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;
            $config['enable_query_strings'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];

            //$config["num_links"] = round($choice);
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $data['solar_indx_info'] = $this->Solar_manage_model->select_solar_deletedindexing($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();


            $data['totrec'] = $config["total_rows"];
            $this->load->view('admin/solar_manage_deletedindexing', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function add_solrindex() {

        $data['indx_sts'] = $this->Solar_manage_model->addsolr_indesing();
        //$this->load->view('admin/solar_indexingresult_ajax',$data);
        //redirect('admin/Solar_manage');
    }

    function update_editedprodsolrindex() {
        $data['indx_sts'] = $this->Solar_manage_model->updatesolr_indesing();
    }

    function update_deletedprodsolrindex() {
        $data['indx_sts'] = $this->Solar_manage_model->deletesolr_indesing();
    }

    function update_indexstatus() {
        $qr = $this->db->query("SELECT sku FROM solar_indexing WHERE indexing_status='Pending' LIMIT 10 ");

        foreach ($qr->result_array() as $res_solr) {
            $search_txt = $res_solr['sku'];
            $ch = SOLR_BASE_URL . "mycollection1/select?q=sku:" . $search_txt . "&wt=json&spellcheck=true&spellcheck.collate=true&spellcheck.build=true";



            $curl2 = curl_init($ch);
            $output = curl_exec($curl2);
            $data2 = json_decode($output, true);


            $skuid = $res_solr['sku'];

            if ($data2['response']['numFound'] > 0) {
                $this->db->query("UPDATE solar_indexing SET indexing_status='Completed' WHERE sku='$skuid' ");
            }
        }
    }

}
