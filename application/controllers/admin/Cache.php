<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cache extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $this->load->helper(array('html', 'form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('session');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->helper('string');
        $this->load->database();
        $this->load->helper('file');
        $this->load->library('pagination');
        $this->load->model('admin/Cache_model');

        $this->db->cache_off();
    }

    function dlt_cache() {
        if ($this->session->userdata('logged_in')) {



            $config = array();
            $config["base_url"] = base_url() . "admin/Cache/dlt_cache";
            $config["total_rows"] = $this->Cache_model->getcache_count();
            $config["per_page"] = 30;
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


            $data['cache_list'] = $this->Cache_model->select_cache($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();
            $this->load->view('admin/dlt_cache_view', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function show_lvl_cache() {
        if ($this->session->userdata('logged_in')) {

            $lvlid = $this->input->GET("lvlid");
            //echo $lvlid;exit;
            $config = array();
            $config["base_url"] = base_url() . "admin/Cache/show_lvl_cache";
            $config["total_rows"] = $this->Cache_model->getcache_countlvl();
            $config["per_page"] = 30;
            $config["uri_segment"] = 3;
            //$config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;
            $config['enable_query_strings'] = TRUE;
            $config['reuse_query_string'] = TRUE;
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
            $data['cache_list'] = $this->Cache_model->select_cachelvl($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();
            $this->load->view('admin/dlt_cache_view', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function dltcache_folder() {
        if ($this->session->userdata('logged_in')) {
            $catg_id = $this->input->post("catg_id");
            $query = $this->db->query("SELECT folder_name from clear_catch where catg_id='$catg_id'");
            //die("SELECT folder_name from clear_catch where catg_id='$catg_id'");
            $cnt = $query->num_rows();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $res) {


                    $folder_name = $res['folder_name'];
                    list($folder_name1, $folder_name2) = explode("+", $folder_name, 2);
                    $this->db->cache_delete($folder_name1, $folder_name2);
                    $query = $this->db->query("DELETE FROM clear_catch WHERE catg_id='$catg_id'");
                    $query = $this->db->query("DELETE FROM prod_cache WHERE catg_id='$catg_id'");
                }
            }
        } else {
            redirect('admin/super_admin');
        }
    }

    function show_search_cache() {
        if ($this->session->userdata('logged_in')) {
            //echo '<pre>';print_r($_GET);die;

            $data['cache_list'] = $this->Cache_model->select_cachelvlsearch();
            $data['cache_listforsearch'] = $this->Cache_model->select_updatecacheforsearch();
            $this->load->view('admin/updae_dlt_cache_view', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function dltselectedcache_folder() {
        if ($this->session->userdata('logged_in')) {
            $catg_id = $this->input->post("selected_catg_id");
            $catg_id = implode(",", $catg_id);
            $query = $this->db->query("SELECT catg_id,folder_name from clear_catch where catg_id IN ($catg_id) ");
            //die("SELECT folder_name from clear_catch where catg_id IN ($catg_id) ");
            $cnt = $query->num_rows();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $res) {


                    $folder_name = $res['folder_name'];
                    $catg_idd = $res['catg_id'];
                    list($folder_name1, $folder_name2) = explode("+", $folder_name, 2);
                    $this->db->cache_delete($folder_name1, $folder_name2);
                    $query = $this->db->query("DELETE FROM clear_catch WHERE catg_id='$catg_idd'");
                    $query = $this->db->query("DELETE FROM prod_cache WHERE catg_id='$catg_idd'");
                }
            }
        } else {
            redirect('admin/super_admin');
        }
    }

    function dltcachefld() {
        if ($this->session->userdata('logged_in')) {
            //echo "sujit";exit;
            $config = array();
            $config["base_url"] = base_url() . "admin/Cache/dltcachefld";
            $config["total_rows"] = $this->Cache_model->getupdatecache_count();

            $config["per_page"] = 10;
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
            //$data['totalrowscnt']=$config["total_rows"];
            //echo $data['totalrowscnt'];exit;
            $data['cache_list'] = $this->Cache_model->select_updatecache($config["per_page"], $page);
            $data['cache_listforsearch'] = $this->Cache_model->select_updatecacheforsearch();
            $data['links'] = $this->pagination->create_links();

            $this->load->view('admin/updae_dlt_cache_view', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function dltcache_folder_update() {
        if ($this->session->userdata('logged_in')) {
            $catg_id = $this->input->post("catg_id");
            //echo $catg_id;exit;
            $folder_name1 = 'index';
            $folder_name3 = 'filterby';
            $folder_name2 = 'category';
            $sellers = 'sellers';

            $qr = $this->db->query("SELECT `sku` FROM `prod_cache` WHERE `catg_id` in ($catg_id) and sku!='' ");
            if ($qr->num_rows() > 0) {
                foreach ($qr->result_array() as $ress) {
                    $sku = $ress['sku'];
                    $qrr = $this->db->query("SELECT name,product_id,seller_id FROM `cornjob_productsearch` WHERE `sku`='$sku' group by sku");

                    $name = $qrr->row()->name;
                    $name = preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($name))));
                    //echo $name; 
                    $product_id = $qrr->row()->product_id;
                    $seller_id = $qrr->row()->seller_id;
                    $seller_id = base64_encode($seller_id);
                    //echo $seller_id; exit;
                    $this->db->cache_delete($sellers, $seller_id);
                    $this->db->cache_delete($name, $product_id);
                    //$query=$this->db->query("UPDATE prod_cache SET sku='' WHERE sku='$sku'");
                    //exit;
                }
            }



            //die("SELECT parent_id,url_displayname from category_menu_desktop where category_id in ($catg_id)");
            $query = $this->db->query("SELECT parent_id,url_displayname from category_menu_desktop where category_id in ($catg_id)");
            if ($query->num_rows() > 0) {


                foreach ($query->result_array() as $res) {


                    $folder_name = $res['url_displayname'];
                    $parent_id = $res['parent_id'];
                    //echo $folder_name; exit;
                    $query = $this->db->query("SELECT url_displayname from category_menu_desktop where dskmenu_lbl_id='$parent_id'");
                    $sndlbl = $query->row()->url_displayname;
                    $this->db->cache_delete($folder_name2, $sndlbl);
                    //die("SELECT url_displayname from category_menu_desktop where dskmenu_lbl_id='$parent_id'");
                    $this->db->cache_delete($folder_name, $folder_name1);
                    $this->db->cache_delete($folder_name3, $folder_name);
                    $query = $this->db->query("DELETE FROM prod_cache WHERE catg_id='$catg_id'");
                }
            }
        } else {
            redirect('admin/super_admin');
        }
    }

    function dltselectedcache_folder_update() {
        if ($this->session->userdata('logged_in')) {
            $catg_id = $this->input->post("selected_catg_id");
            //print_r($catg_id);
            $catg_id = implode(",", $catg_id);
            //echo $catg_id;exit;
            $folder_name1 = 'index';
            $folder_name3 = 'filterby';
            $folder_name2 = 'category';
            $sellers = 'sellers';


            $qr = $this->db->query("SELECT `sku` FROM `prod_cache` WHERE `catg_id` in ($catg_id) and sku!='' ");
            if ($qr->num_rows() > 0) {
                foreach ($qr->result_array() as $ress) {
                    $sku = $ress['sku'];
                    $qrr = $this->db->query("SELECT name,product_id,seller_id FROM `cornjob_productsearch` WHERE `sku`='$sku' group by sku");

                    $name = $qrr->row()->name;
                    $name = preg_replace('#"#', "-", preg_replace('#/#', "-", str_replace(' ', '-', strtolower($name))));
                    //echo $name; 
                    $product_id = $qrr->row()->product_id;
                    $seller_id = $qrr->row()->seller_id;
                    $seller_id = base64_encode($seller_id);

                    $this->db->cache_delete($name, $product_id);
                    $this->db->cache_delete($sellers, $seller_id);
                    //$query=$this->db->query("UPDATE prod_cache SET sku='' WHERE sku='$sku'");
                }
            }




            $query = $this->db->query("SELECT parent_id,url_displayname from category_menu_desktop where category_id in ($catg_id)");
            if ($query->num_rows() > 0) {


                foreach ($query->result_array() as $res) {


                    $folder_name = $res['url_displayname'];
                    $parent_id = $res['parent_id'];
                    //echo $folder_name; exit;
                    $query = $this->db->query("SELECT url_displayname from category_menu_desktop where dskmenu_lbl_id='$parent_id'");
                    $sndlbl = $query->row()->url_displayname;
                    $this->db->cache_delete($folder_name2, $sndlbl);
                    //die("SELECT url_displayname from category_menu_desktop where dskmenu_lbl_id='$parent_id'");
                    $this->db->cache_delete($folder_name, $folder_name1);
                    $this->db->cache_delete($folder_name3, $folder_name);
                    $query = $this->db->query("DELETE FROM prod_cache WHERE catg_id in ($catg_id)");
                }
            }
        } else {
            redirect('admin/super_admin');
        }
    }

    function dltallcache_folder() {
        if ($this->session->userdata('logged_in')) {
            $this->db->cache_delete_all();
            $query = $this->db->query("truncate clear_catch ");
            $query = $this->db->query("truncate prod_cache");
        } else {
            redirect('admin/super_admin');
        }
    }

    function dlthomepagecache() {
        if ($this->session->userdata('logged_in')) {

            $this->db->cache_delete('default', 'index');
        } else {
            redirect('admin/super_admin');
        }
    }

}
