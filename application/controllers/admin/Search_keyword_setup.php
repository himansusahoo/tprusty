<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Search_keyword_setup extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
        $this->load->library('form_validation');
        
        
        $this->load->library('pagination');
        $this->load->model('admin/Search_keywordsetupmodel');
    }

    function index() {
        if ($this->session->userdata('logged_in')) {
            $data['srch_catg'] = $this->Search_keywordsetupmodel->select_catg();
            $data['all_parentcatg'] = $this->Search_keywordsetupmodel->select_catg();

            $config = array();
            $config["base_url"] = base_url() . "admin/Search_keyword_setup";
            $config["total_rows"] = $this->Search_keywordsetupmodel->kyword_count();
            $config["per_page"] = 50;
            $config["uri_segment"] = 3;
            //$config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];

            //$config["num_links"] = round($choice);
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $data['keyword_info'] = $this->Search_keywordsetupmodel->retrive_searchkeywords($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();

            $this->load->view('admin/search_keywordsetup', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function save_keywords() {
        if ($this->session->userdata('logged_in')) {
            $data['status'] = $this->Search_keywordsetupmodel->save_searchkeywords();

            if ($data['status'] == 'data Exist') {
                $this->session->set_flashdata('succss_msg', 'Keyword already added Under this Category !');
            } else {
                $this->session->set_flashdata('succss_msg', 'Data added successfully !');
            }
            redirect('admin/Search_keyword_setup');
            //$this->load->view('admin/search_keywordsetup');
        } else {
            redirect('admin/super_admin');
        }
    }

    function delete_keyword() {
        if ($this->session->userdata('logged_in')) {
            $keywrd = $this->input->post("kysqlid");
            $this->db->query("DELETE FROM search_keyword WHERE srchkwrd_sqlid='$keywrd' ");
        } else {
            redirect('admin/super_admin');
        }
    }

}
