<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_category_model extends CI_Model {

    function insert_category() {
        $catg_name = $this->input->post('category_name');
        $active_status = $this->input->post('active_status');
        $catg_description = $this->input->post('catg_description');
        $page_title = $this->input->post('page_title');
        $meta_keyword = $this->input->post('meta_keyword');
        $meta_descrp = $this->input->post('meta_descrp');
        $incld_navmenu_status = $this->input->post('incld_navmenu_status');
        $display_mode = $this->input->post('display_mode');
        $cms_block = $this->input->post('cms_block');
        $anchor_status = $this->input->post('anchor_status');
        $avl_prod_list_order = $this->input->post('avl_prod_list_order');
        $def_prod_list_sortby = $this->input->post('def_prod_list_sortby');
        $navigation_price = $this->input->post('navigation_price');
        $parent_catg_stg_status = $this->input->post('parent_catg_stg_status');
        $apply_to_product_status = $this->input->post('apply_to_product_status');
        $custom_design = $this->input->post('custom_design');
        $active_date_from = date("Y-m-d", strtotime($this->input->post('date_from')));
        if ($active_date_from == "1970-01-01") {
            $active_date_from = "0000-00-00";
        }

        $active_date_to = date("Y-m-d", strtotime($this->input->post('date_to')));
        if ($active_date_to == "1970-01-01") {
            $active_date_to = "0000-00-00";
        }
        $page_layout = $this->input->post('page_layout');
        $custom_layout_update = $this->input->post('custom_layout_update');

        //$from_date = date("Y-m-d", strtotime($active_date_from));
//		echo $from_date;
//		exit;

        $max_catg_id = $this->get_unique_id('category_master', 'category_id');

        $data = array(
            'category_id' => $max_catg_id,
            'category_name' => $catg_name,
            'active_status' => $active_status,
            'catg_description' => $page_title,
            'page_title' => $page_title,
            'meta_keywords' => $meta_keyword,
            'meta_description' => $meta_descrp,
            'nav_include_status' => $incld_navmenu_status,
            'display_mode' => $display_mode,
            'cms_block' => $cms_block,
            'is_anchor_status' => $anchor_status,
            'avail_product_list_sort_by' => $avl_prod_list_order,
            'default_product_list_sort_by' => $def_prod_list_sortby,
            'layered_navigation_price_step' => $navigation_price,
            'use_parent_category_settings' => $parent_catg_stg_status,
            'apply_to_products' => $apply_to_product_status,
            'custom_design' => $custom_design,
            'active_from' => $active_date_from,
            'active_to' => $active_date_to,
            'page_layout' => $page_layout,
            'custom_layout_update' => $custom_layout_update
        );


        $this->db->insert('category_master', $data);

        $data2 = array(
            'category_id' => $max_catg_id,
            'category_name' => $catg_name,
        );

        $qr = $this->db->insert('category_indexing', $data2);
        if ($qr) {
            return true;
        } else {
            return false;
        }
    }

    function insert_pcmenu() {
        $catg_name = $this->input->post('category_name');
        $active_status = $this->input->post('active_status');
        $catg_description = $this->input->post('catg_description');
        $page_title = $this->input->post('page_title');
        $meta_keyword = $this->input->post('meta_keyword');
        $meta_descrp = $this->input->post('meta_descrp');
        $incld_navmenu_status = $this->input->post('incld_navmenu_status');
        $display_mode = $this->input->post('display_mode');
        $cms_block = $this->input->post('cms_block');
        $anchor_status = $this->input->post('anchor_status');
        $avl_prod_list_order = $this->input->post('avl_prod_list_order');
        $def_prod_list_sortby = $this->input->post('def_prod_list_sortby');
        $navigation_price = $this->input->post('navigation_price');
    }

    function get_unique_id($table, $uid) {

        $query = $this->db->query('SELECT MAX(' . $uid . ') AS `maxid` FROM ' . $table);
        $maxId = $query->row()->maxid;
        $id = $maxId + 1;
        return $id;
    }

    function select_category_list() {
        $query = $this->db->query("select a.active_status , b.*  from category_master a inner join category_indexing b on a.category_id=b.category_id where b.parent_id=0 ");
        return $query;
    }

    function select_parentcategory_list() {
        $query = $this->db->query("select a.active_status , b.*  from category_master a inner join category_indexing b on a.category_id=b.category_id where b.parent_id=0 ");
        return $query;
    }

    function retrieve_category() {
        $qr = $this->db->query("
			SELECT DISTINCT lvl2, lvl2_name, lvl1, lvl1_name , lvlmain_name
			FROM  `temp_category` 
			WHERE lvl1 !=0 ");
        return $qr->result();
    }

    function insert_subcategory() {
        $catg_name = addslashes($this->input->post('category_name'));
        $active_status = $this->input->post('active_status');
        $catg_description = addslashes($this->input->post('catg_description'));
        $page_title = addslashes($this->input->post('page_title'));
        $meta_keyword = addslashes($this->input->post('meta_keyword'));
        $meta_descrp = addslashes($this->input->post('meta_descrp'));
        $incld_navmenu_status = $this->input->post('incld_navmenu_status');
        $display_mode = $this->input->post('display_mode');
        $cms_block = $this->input->post('cms_block');
        $anchor_status = $this->input->post('anchor_status');
        $avl_prod_list_order = $this->input->post('avl_prod_list_order');
        $def_prod_list_sortby = $this->input->post('def_prod_list_sortby');
        $navigation_price = $this->input->post('navigation_price');
        $parent_catg_stg_status = $this->input->post('parent_catg_stg_status');
        $apply_to_product_status = $this->input->post('apply_to_product_status');
        $custom_design = $this->input->post('custom_design');
        $active_date_from = date("Y-m-d", strtotime($this->input->post('date_from')));
        if ($active_date_from == "1970-01-01") {
            $active_date_from = "0000-00-00";
        }

        $active_date_to = date("Y-m-d", strtotime($this->input->post('date_to')));
        if ($active_date_to == "1970-01-01") {
            $active_date_to = "0000-00-00";
        }

        $page_layout = $this->input->post('page_layout');
        $custom_layout_update = $this->input->post('custom_layout_update');

        $subcatg_id = $this->input->post('subcategory_id');

        //program start for getting category level id//
        $query = $this->db->query("SELECT cat_level FROM category_indexing WHERE category_id='$subcatg_id'");
        $row = $query->row();
        $cat_level = $row->cat_level + 1;
        //program end of getting category level id//

        $max_catg_id = $this->get_unique_id('category_master', 'category_id');

        $data = array(
            'category_id' => $max_catg_id,
            'category_name' => $catg_name,
            'active_status' => $active_status,
            'catg_description' => $catg_description,
            'page_title' => $page_title,
            'meta_keywords' => $meta_keyword,
            'meta_description' => $meta_descrp,
            'nav_include_status' => $incld_navmenu_status,
            'display_mode' => $display_mode,
            'cms_block' => $cms_block,
            'is_anchor_status' => $anchor_status,
            'avail_product_list_sort_by' => $avl_prod_list_order,
            'default_product_list_sort_by' => $def_prod_list_sortby,
            'layered_navigation_price_step' => $navigation_price,
            'use_parent_category_settings' => $parent_catg_stg_status,
            'apply_to_products' => $apply_to_product_status,
            'custom_design' => $custom_design,
            'active_from' => $active_date_from,
            'active_to' => $active_date_to,
            'page_layout' => $page_layout,
            'custom_layout_update' => $custom_layout_update
        );


        $this->db->insert('category_master', $data);

        $queryparent_id = $this->db->query("select parent_id from category_indexing where category_id='$subcatg_id' ");
        $snd_parent_id = $queryparent_id->row()->parent_id;

        if ($snd_parent_id > 0) {
            $queryparent_idthrd = $this->db->query("select parent_id from category_indexing where category_id='$snd_parent_id' and parent_id=0 ");
            if ($queryparent_idthrd->num_rows() > 0) {

                $data22 = array(
                    'cat_id' => $max_catg_id
                );

                $this->db->insert('global_commission', $data22);
            }
        }
        $data2 = array(
            'category_id' => $max_catg_id,
            'category_name' => $catg_name,
            'parent_id' => $subcatg_id,
            'cat_level' => $cat_level
        );

        $qr = $this->db->insert('category_indexing', $data2);
        if ($qr) {
            return true;
        } else {
            return false;
        }
    }

    function select_allcategoryinfo($limit, $start) {
        $query = $this->db->query("select *  from category_master  order by category_id desc limit $start,$limit");

        return $query;
    }

    function select_allcategory() {

        $query = $this->db->query("select *  from category_master order by category_id desc ");

        return $query;
    }

    function select_category_data($catg_id) {
        $query = $this->db->query("select *  from category_master where category_id='$catg_id'  ");
        $rows = $query->row();

        return $rows;
    }

    function edit_subcategory_data($catg_id) {


        $catg_name = addslashes($this->input->post('category_name'));
        $active_status = $this->input->post('active_status');
        $catg_description = addslashes($this->input->post('catg_description'));
        $page_title = addslashes($this->input->post('page_title'));
        $meta_keyword = addslashes($this->input->post('meta_keyword'));
        $meta_descrp = addslashes($this->input->post('meta_descrp'));
        $incld_navmenu_status = $this->input->post('incld_navmenu_status');
        $display_mode = $this->input->post('display_mode');
        $cms_block = $this->input->post('cms_block');
        $anchor_status = $this->input->post('anchor_status');
        $avl_prod_list_order = $this->input->post('avl_prod_list_order');
        $def_prod_list_sortby = $this->input->post('def_prod_list_sortby');
        $navigation_price = $this->input->post('navigation_price');
        $parent_catg_stg_status = $this->input->post('parent_catg_stg_status');
        $apply_to_product_status = $this->input->post('apply_to_product_status');
        $custom_design = $this->input->post('custom_design');
        $active_date_from = date("Y-m-d", strtotime($this->input->post('date_from')));
        if ($active_date_from == "1970-01-01") {
            $active_date_from = "0000-00-00";
        }

        $active_date_to = date("Y-m-d", strtotime($this->input->post('date_to')));
        if ($active_date_to == "1970-01-01") {
            $active_date_to = "0000-00-00";
        }

        $page_layout = $this->input->post('page_layout');
        $custom_layout_update = $this->input->post('custom_layout_update');

        //$query=$this->db->query("update category_master set category_name='$catg_name', active_status='$active_status', catg_description='$catg_description',page_title='$page_title',meta_keywords='$meta_keyword', meta_description='$meta_descrp',nav_include_status='$incld_navmenu_status',display_mode='$display_mode',cms_block='$cms_block',is_anchor_status='$anchor_status',		avail_product_list_sort_by='$avl_prod_list_order',default_product_list_sort_by='$def_prod_list_sortby',layered_navigation_price_step='$navigation_price',		use_parent_category_settings='$parent_catg_stg_status',apply_to_products='$apply_to_product_status',custom_design='$custom_design',active_from='$active_date_from',
//active_to='$active_date_to',page_layout='$page_layout',custom_layout_update='$custom_layout_update' where category_id='$catg_id' ");

        $data = array(
            'category_name' => $catg_name,
            'active_status' => $active_status,
            'catg_description' => $catg_description,
            'page_title' => $page_title,
            'meta_keywords' => $meta_keyword,
            'meta_description' => $meta_descrp,
            'nav_include_status' => $incld_navmenu_status,
            'display_mode' => $display_mode,
            'cms_block' => $cms_block,
            'is_anchor_status' => $anchor_status,
            'avail_product_list_sort_by' => $avl_prod_list_order,
            'default_product_list_sort_by' => $def_prod_list_sortby,
            'layered_navigation_price_step' => $navigation_price,
            'use_parent_category_settings' => $parent_catg_stg_status,
            'apply_to_products' => $apply_to_product_status,
            'custom_design' => $custom_design,
            'active_from' => $active_date_from,
            'active_to' => $active_date_to,
            'page_layout' => $page_layout,
            'custom_layout_update' => $custom_layout_update
        );

        $this->db->where('category_id', $catg_id);
        $query = $this->db->update('category_master', $data);


        //$query=$this->db->query("update category_indexing set category_name='$catg_name'  where category_id='$catg_id' ");

        $data_catgnm = array('category_name' => $catg_name);

        $this->db->where('category_id', $catg_id);
        $query = $this->db->update('category_indexing', $data_catgnm);


        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function filtered_select_allcategory() {

        $catg_id = $this->input->post('id');
        $catg_name = $this->input->post('catg_name');
        $active_from = $this->input->post('active_from');
        $active_to = $this->input->post('active_to');
        $ctg_status = $this->input->post('ctg_status');


        //$condition = "b.status='Active' AND c.status='Active'";
        $condition = '';

        if ($catg_id != '' && $catg_name == '' && $active_from == '' && $active_to == '' && $ctg_status == '') {
            $condition .= "category_id='$catg_id'";
        }
        if ($catg_id == '' && $catg_name != '' && $active_from == '' && $active_to == '' && $ctg_status == '') {
            $condition .= "category_name='$catg_name'";
        }

        if ($catg_id == '' && $catg_name == '' && $active_from != '' && $active_to != '' && $ctg_status == '') {
            $condition .= "active_from >='$active_from' and active_to <='$active_to' ";
        }

        if ($catg_id == '' && $catg_name == '' && $active_from == '' && $active_to == '' && $ctg_status != '') {
            $condition .= "active_status='$ctg_status'";
        }

        if ($catg_id == '' && $catg_name == '' && $active_from == '' && $active_to == '' && $ctg_status == '') {

            $query = $this->db->query("select * from category_master order by  category_id desc ");
            return $query;
        }

        if ($catg_id == '' && $catg_name == '' && $active_from != '' && $active_to == '' && $ctg_status == '') {

            $query = $this->db->query("select * from category_master order by  category_id desc ");
            return $query;
        }
        if ($catg_id == '' && $catg_name == '' && $active_from == '' && $active_to != '' && $ctg_status == '') {

            $query = $this->db->query("select * from category_master order by  category_id desc ");
            return $query;
        }


        $query = $this->db->query("select * from category_master where " . $condition);

        return $query;
    }

    function select_mobcategory_list() {
        $query = $this->db->query("select *  from mb_category_indexing where parent_id=0 order by order_by ");
        return $query;
    }

    function select_desktopcategory_list() {

        $qr = $this->db->query("select *  from category_menu_desktop where parent_id=0 AND order_by!=0 order by order_by ");
        return $qr;
    }

    function select_desktopmenuforurl_list() {
        $qr = $this->db->query("select *  from category_menu_desktop ");

        foreach ($qr->result_array() as $res) {
            $urlname = str_replace('---', '-', str_replace('--', '-', str_replace(',', '', preg_replace('#/#', "-", str_replace("'s", '-', str_replace('&', '', str_replace(' ', '-', strtolower($res['label_name']))))))));

            //echo '<br>';

            $data = array('url_displayname' => $urlname);

            $this->db->where('dskmenu_lbl_id', $res['dskmenu_lbl_id']);
            $this->db->update('category_menu_desktop', $data);
        }


        // url update for mobile start
        //$data2=array();
        $qr2 = $this->db->query("select *  from category_menu_mobile ");

        foreach ($qr2->result_array() as $res2) {
            $urlname1 = str_replace('---', '-', str_replace('--', '-', str_replace(',', '', preg_replace('#/#', "-", str_replace("'s", '-', str_replace('&', '', str_replace(' ', '-', strtolower($res2['label_name']))))))));

            //echo '<br>';

            $data2 = array('url_displayname' => $urlname1);

            $this->db->where('dskmenu_lbl_id', $res2['dskmenu_lbl_id']);
            $this->db->update('category_menu_mobile', $data2);
        }
    }

    function select_mobilemenu_list() {

        $qr = $this->db->query("select *  from category_menu_mobile where parent_id=0 AND order_by!=0 order by order_by ");
        return $qr;
    }

    function add_newpcmenu() {

        //print_r($this->input->post('catg_name'));exit;

        $menu_name = addslashes($this->input->post('menu_name'));
        $menu_isactive = $this->input->post('menu_isactive');
        $menu_have_Parent = $this->input->post('menu_have_Parent');
        $view_type = $this->input->post('view_type');
        $catg_id = $this->input->post('catg_name');

        $seodatalink_catg = $this->input->post('seocatg_name');

        $url_dispname = $this->input->post('urldisp_name');

        $urlfinal_dispname = str_replace('---', '-', str_replace('--', '-', str_replace(',', '', preg_replace('#/#', "-", str_replace("'s", '-', str_replace('&', '', str_replace(' ', '-', strtolower($url_dispname))))))));



        if (count($catg_id) == 0) {
            $catg_id = '';
        } else {
            $ctr_catgid = count($catg_id);
            if ($ctr_catgid > 1) {
                $catg_id = implode(',', $catg_id);
            } else {
                $catg_id = str_replace(',', '', implode(',', $catg_id));
            }
        }

        if ($menu_have_Parent == 'No') {
            $parent_id = 0;
            $qrt = $this->db->query("SELECT max(order_by) as max_orderby FROM category_menu_desktop WHERE parent_id=0 AND order_by!=0 ");
            $rw = $qrt->row();
            $order_by = $rw->max_orderby + 1;
        } else {
            $parent_id = $this->input->post('subcategory_id');
            $qrt = $this->db->query("SELECT max(order_by) as max_orderby FROM category_menu_desktop WHERE parent_id='$parent_id' AND order_by!=0 ");
            $rw = $qrt->row();
            $order_by = $rw->max_orderby + 1;
        }


        $data = array(
            'label_name' => $menu_name,
            'parent_id' => $parent_id,
            'is_active' => $menu_isactive,
            'order_by' => $order_by,
            'category_id' => $catg_id,
            'view_type' => $view_type,
            'url_displayname' => $urlfinal_dispname,
            'seo_categoryidlink' => $seodatalink_catg
        );

        $this->db->insert('category_menu_desktop', $data);
    }

    function add_newmobilemenu() {
        $menu_name = addslashes($this->input->post('menu_name'));
        $menu_isactive = $this->input->post('menu_isactive');
        $menu_have_Parent = $this->input->post('menu_have_Parent');
        $view_type = $this->input->post('view_type');
        $catg_id = $this->input->post('catg_name');

        $urldisp_name = $this->input->post('urldisp_name');

        $fin_urldispname = str_replace('---', '-', str_replace('--', '-', str_replace(',', '', preg_replace('#/#', "-", str_replace("'s", '-', str_replace('&', '', str_replace(' ', '-', strtolower($urldisp_name))))))));

        $seocatg_id = $this->input->post('seocatg_name');

        if (count($catg_id) == 0) {
            $catg_id = '';
        } else {
            $ctr_catgid = count($catg_id);
            if ($ctr_catgid > 1) {
                $catg_id = implode(',', $catg_id);
            } else {
                $catg_id = str_replace(',', '', implode(',', $catg_id));
            }
        }

        if ($menu_have_Parent == 'No') {
            $parent_id = 0;
            $qrt = $this->db->query("SELECT max(order_by) as max_orderby FROM category_menu_mobile WHERE parent_id=0 AND order_by!=0 ");
            $rw = $qrt->row();
            $order_by = $rw->max_orderby + 1;
        } else {
            $parent_id = $this->input->post('subcategory_id');
            $qrt = $this->db->query("SELECT max(order_by) as max_orderby FROM category_menu_mobile WHERE parent_id='$parent_id' AND order_by!=0 ");
            $rw = $qrt->row();
            $order_by = $rw->max_orderby + 1;
        }
        $menu_image = '';
        //-----------------------------Image Upload Start--------------------//
        if ($_FILES["userfile"]['name'] != '') {
            $dt_img = preg_replace("/[^0-9]+/", "", date('Y-m-d H:i:s'));
            $img_rndname = strtolower(random_string('alnum', 15)) . $dt_img . '.jpg';
            $config = array();
            $config['upload_path'] = './images/admin/mobile/mobile_menu/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['file_name'] = $img_rndname;

            $this->upload->initialize($config);
            $this->upload->do_upload();
            $menu_image = $img_rndname;
        }

        //-----------------------------Image upload end-----------------------//


        $data = array(
            'label_name' => $menu_name,
            'parent_id' => $parent_id,
            'is_active' => $menu_isactive,
            'order_by' => $order_by,
            'category_id' => $catg_id,
            'view_type' => $view_type,
            'url_displayname' => $fin_urldispname,
            'seo_categoryidlink' => $seocatg_id,
            'menu_image' => $menu_image
        );

        $this->db->insert('category_menu_mobile', $data);
    }

    function edit_pcmenu($lablid_pcmenu) {
        $qr = $this->db->query("SELECT * FROM category_menu_desktop WHERE dskmenu_lbl_id='$lablid_pcmenu' ");
        return $rw = $qr->row();
    }

    function edit_mobilemenu($lablid_pcmenu) {
        $qr = $this->db->query("SELECT * FROM category_menu_mobile WHERE dskmenu_lbl_id='$lablid_pcmenu' ");
        return $rw = $qr->row();
    }

    function edit_pcmenu_orderby($lablid_pcmenu) {
        $qr = $this->db->query("SELECT parent_id FROM category_menu_desktop WHERE dskmenu_lbl_id='$lablid_pcmenu' ");
        $rw = $qr->row();

        $parent_id = $rw->parent_id;

        $qr_orderby = $this->db->query("SELECT order_by FROM category_menu_desktop WHERE parent_id='$parent_id' AND order_by!=0 order by order_by ");
        return $rw_orderby = $qr_orderby->result();
    }

    function edit_mobilemenu_orderby($lablid_pcmenu) {
        $qr = $this->db->query("SELECT parent_id FROM category_menu_mobile WHERE dskmenu_lbl_id='$lablid_pcmenu' ");
        $rw = $qr->row();

        $parent_id = $rw->parent_id;

        $qr_orderby = $this->db->query("SELECT order_by FROM category_menu_mobile WHERE parent_id='$parent_id' AND order_by!=0 order by order_by ");
        return $rw_orderby = $qr_orderby->result();
    }

    function remove_pccatglink() {
        $lablel_id = $this->input->post('dskmenu_lbl_id');
        $catg_id = $this->input->post('catg_id');

        $qr_extcatg = $this->db->query("SELECT category_id FROM category_menu_desktop WHERE dskmenu_lbl_id='$lablel_id' ");
        $rw_extcatg = $qr_extcatg->row();

        //------------------------------------

        $rw_extcatg_arr = explode(',', $rw_extcatg->category_id);

        $pccatg_list = array_search($catg_id, $rw_extcatg_arr, true);

        //if($pccatg_list != false)
//			{
        unset($rw_extcatg_arr[$pccatg_list]);
        //}
        $pccatg_updatedList = implode(',', $rw_extcatg_arr);

        $this->db->query("UPDATE category_menu_desktop SET category_id='$pccatg_updatedList' WHERE dskmenu_lbl_id='$lablel_id' ");
        //--------------------------------------------------
    }

    function remove_mobilecatglink() {
        $lablel_id = $this->input->post('dskmenu_lbl_id');
        $catg_id = $this->input->post('catg_id');

        $qr_extcatg = $this->db->query("SELECT category_id FROM category_menu_mobile WHERE dskmenu_lbl_id='$lablel_id' ");
        $rw_extcatg = $qr_extcatg->row();

        //------------------------------------

        $rw_extcatg_arr = explode(',', $rw_extcatg->category_id);

        $pccatg_list = array_search($catg_id, $rw_extcatg_arr, true);

        //if($pccatg_list != false)
//			{
        unset($rw_extcatg_arr[$pccatg_list]);
        //}
        $pccatg_updatedList = implode(',', $rw_extcatg_arr);

        $this->db->query("UPDATE category_menu_mobile SET category_id='$pccatg_updatedList' WHERE dskmenu_lbl_id='$lablel_id' ");
        //--------------------------------------------------
    }

    function update_pcmenuinfo() {

        $lbl_id = $this->input->post('lbl_id');
        $menu_name = addslashes($this->input->post('menu_name'));
        $menu_isactive = $this->input->post('menu_isactive');
        $menu_have_Parent = $this->input->post('menu_have_Parent');
        $view_type = $this->input->post('view_type');
        $catg_id = $this->input->post('catg_name');
        $order_by = $this->input->post('slect_orderby');
        $old_parentid = $this->input->post('parent_idmnb');
        $parent_id = $this->input->post('subcategory_id');

        $url_dispname = $this->input->post('urldisp_name');
        //echo $url_dispname;
        $fin_urldispname = str_replace('---', '-', str_replace('--', '-', str_replace(',', '', preg_replace('#/#', "-", str_replace("'s", '-', str_replace('&', '', str_replace(' ', '-', strtolower($url_dispname))))))));

        $this->db->cache_delete('category', $fin_urldispname);
        $this->db->cache_delete($fin_urldispname, 'index');
        //echo $fin_urldispname;exit;
        $seocatg_id = $this->input->post('seocatg_name');

        if ($menu_have_Parent == 'No') {
            $parent_id = 0;
            $qrt = $this->db->query("SELECT max(order_by) as max_orderby FROM category_menu_desktop WHERE parent_id=0 AND order_by!=0 ");
            $rw = $qrt->row();
            $order_by = $rw->max_orderby + 1;
        }


        $qr_orderby = $this->db->query("SELECT * FROM category_menu_desktop WHERE dskmenu_lbl_id='$lbl_id' ");
        $rw_oldorderby = $qr_orderby->row();

        if ($order_by == $rw_oldorderby->order_by && $old_parentid == $parent_id) {
            $order_by == $rw_oldorderby->order_by;
        } else {
            $qr_orderby = $this->db->query("SELECT dskmenu_lbl_id,order_by FROM category_menu_desktop  WHERE parent_id='$parent_id' AND order_by='$order_by' ");
            $rw_order_by = $qr_orderby->row();

            $old_orderby = $rw_order_by->order_by;
            $sw_orderby = $rw_oldorderby->order_by;

            $this->db->query("update category_menu_desktop SET order_by='$sw_orderby' WHERE dskmenu_lbl_id='$rw_order_by->dskmenu_lbl_id' ");
        }

        //if($old_parentid!=$parent_id)
//				{
//					
//				$qrt=$this->db->query("SELECT max(order_by) as max_orderby FROM category_menu_desktop WHERE parent_id='$parent_id' AND order_by!=0 ");
//				$rw=$qrt->row();
//				$mxorder_by=$rw->max_orderby + 1;
//				
//					$this->db->query("update category_menu_desktop SET  order_by='$mxorder_by', parent_id='$parent_id' WHERE dskmenu_lbl_id='$lbl_id' ");	
//					
//				}

        if (count($catg_id) == 0) {
            $this->db->query("UPDATE category_menu_desktop SET
								   label_name='$menu_name',
								   parent_id='$parent_id',
								   is_active='$menu_isactive',
								   order_by='$order_by',
								   view_type='$view_type',
								   url_displayname='$fin_urldispname',
								   seo_categoryidlink='$seocatg_id'
								   WHERE dskmenu_lbl_id='$lbl_id'
				
								");
        } else {
            //$catg_id=implode(',',$catg_id);			 
            $ext_catgid = explode(',', $rw_oldorderby->category_id);
            $new_catgdarr = array_merge($ext_catgid, $catg_id);
            $new_catgstr = implode(',', $new_catgdarr);


            if (count($new_catgdarr) == 0) {
                $new_catgstr = '';
            } else {
                $ctr_catgid = count($new_catgdarr);
                if ($ctr_catgid > 1) {
                    $new_catgstr = $new_catgstr;
                } else {
                    $new_catgstr = str_replace(',', '', implode(',', $new_catgdarr));
                }
            }


            $this->db->query("UPDATE category_menu_desktop SET
								   label_name='$menu_name',
								   parent_id='$parent_id',
								   is_active='$menu_isactive',
								   order_by='$order_by',
								   category_id='$new_catgstr',
								   view_type='$view_type',
								   url_displayname='$fin_urldispname',
								   seo_categoryidlink='$seocatg_id'
								   WHERE dskmenu_lbl_id='$lbl_id'
				
								");
        }
    }

    function remove_mobilemenuimage() {
        $menu_sqlid = $this->input->post('menu_sqlid');

        $imgname = $this->input->post('img_name');
        $output_dir = "./images/admin/mobile/mobile_menu/";
        $filePath = $output_dir . $imgname;
        if (file_exists(trim($filePath))) {
            unlink($filePath);
        }

        $updateimgname = '';

        $this->db->query("UPDATE category_menu_mobile SET menu_image='$updateimgname' WHERE dskmenu_lbl_id='$menu_sqlid' ");
    }

    function update_mobilemenuinfo() {
        //echo '<pre>';print_r($_POST);exit;
        $lbl_id = $this->input->post('lbl_id');
        $menu_name = addslashes($this->input->post('menu_name'));
        $menu_isactive = $this->input->post('menu_isactive');
        $menu_have_Parent = $this->input->post('menu_have_Parent');
        $view_type = $this->input->post('view_type');
        $catg_id = $this->input->post('catg_name');
        $order_by = $this->input->post('slect_orderby');
        $old_parentid = $this->input->post('parent_idmnb');
        $parent_id = $this->input->post('subcategory_id');

        $url_dispname = $this->input->post('urldisp_name');
        //echo $url_dispname;
        $fin_urldispname = str_replace('---', '-', str_replace('--', '-', str_replace(',', '', preg_replace('#/#', "-", str_replace("'s", '-', str_replace('&', '', str_replace(' ', '-', strtolower($url_dispname))))))));
        //echo $fin_urldispname;exit;
        $this->db->cache_delete('category', $fin_urldispname);
        $this->db->cache_delete($fin_urldispname, 'index');

        $seocatg_id = $this->input->post('seocatg_name');

        //---------------------------image upload start-----------------//
        $old_imgname = $this->input->post('hdnextimg_name');

        if ($_FILES["userfile"]['name'] != '') {
            if ($old_imgname != '') {
                $output_dir = './images/admin/mobile/mobile_menu/';
                $filePath = $output_dir . $old_imgname;
                if (file_exists(trim($filePath))) {
                    unlink($filePath);
                }
            }
            $this->load->library('upload');
            $dt_img = preg_replace("/[^0-9]+/", "", date('Y-m-d H:i:s'));
            $img_rndname = strtolower(random_string('alnum', 15)) . $dt_img . '.jpg';
            $config = array();
            $config['upload_path'] = './images/admin/mobile/mobile_menu/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['file_name'] = $img_rndname;

            $this->upload->initialize($config);
            $this->upload->do_upload();

            $update_imgname = $img_rndname;
        } else {
            $update_imgname = $old_imgname;
        }
        //---------------------------image upload end-----------------//

        if ($menu_have_Parent == 'No') {
            $parent_id = 0;
            $qrt = $this->db->query("SELECT max(order_by) as max_orderby FROM category_menu_mobile WHERE parent_id=0 AND order_by!=0 ");
            $rw = $qrt->row();
            $order_by = $rw->max_orderby + 1;
        }


        $qr_orderby = $this->db->query("SELECT * FROM category_menu_mobile WHERE dskmenu_lbl_id='$lbl_id' ");
        $rw_oldorderby = $qr_orderby->row();

        if ($order_by == $rw_oldorderby->order_by && $old_parentid == $parent_id) {
            $order_by == $rw_oldorderby->order_by;
        } else {
            $qr_orderby = $this->db->query("SELECT dskmenu_lbl_id,order_by FROM category_menu_mobile  WHERE parent_id='$parent_id' AND order_by='$order_by' ");
            $rw_order_by = $qr_orderby->row();

            $old_orderby = $rw_order_by->order_by;
            $sw_orderby = $rw_oldorderby->order_by;

            $this->db->query("update category_menu_mobile SET order_by='$sw_orderby' WHERE dskmenu_lbl_id='$rw_order_by->dskmenu_lbl_id' ");
        }

        //if($old_parentid!=$parent_id)
//				{
//					
//				$qrt=$this->db->query("SELECT max(order_by) as max_orderby FROM category_menu_desktop WHERE parent_id='$parent_id' AND order_by!=0 ");
//				$rw=$qrt->row();
//				$mxorder_by=$rw->max_orderby + 1;
//				
//					$this->db->query("update category_menu_desktop SET  order_by='$mxorder_by', parent_id='$parent_id' WHERE dskmenu_lbl_id='$lbl_id' ");	
//					
//				}

        if (count($catg_id) == 0) {
            $this->db->query("UPDATE category_menu_mobile SET
								   label_name='$menu_name',
								   parent_id='$parent_id',
								   is_active='$menu_isactive',
								   order_by='$order_by',
								   view_type='$view_type',
								   url_displayname='$fin_urldispname',
								   seo_categoryidlink='$seocatg_id',
								   menu_image='$update_imgname'
								   WHERE dskmenu_lbl_id='$lbl_id'
				
								");
        } else {
            //$catg_id=implode(',',$catg_id);			 
            $ext_catgid = explode(',', $rw_oldorderby->category_id);
            $new_catgdarr = array_merge($ext_catgid, $catg_id);
            $new_catgstr = implode(',', $new_catgdarr);

            if (count($new_catgdarr) == 0) {
                $new_catgstr = '';
            } else {
                $ctr_catgid = count($new_catgdarr);
                if ($ctr_catgid > 1) {
                    $new_catgstr = $new_catgstr;
                } else {
                    $new_catgstr = str_replace(',', '', implode(',', $new_catgdarr));
                }
            }


            $this->db->query("UPDATE category_menu_mobile SET
								   label_name='$menu_name',
								   parent_id='$parent_id',
								   is_active='$menu_isactive',
								   order_by='$order_by',
								   category_id='$new_catgstr',
								   view_type='$view_type',
								   url_displayname='$fin_urldispname',
								   seo_categoryidlink='$seocatg_id',
								   menu_image='$update_imgname'
								   WHERE dskmenu_lbl_id='$lbl_id'
				
								");
        }
    }

    function delete_pcmenuinfo($mnb_lblid) {
        $this->db->query("update category_menu_desktop SET parent_id=0, order_by=0, is_active='no' , category_id='' , view_type='' WHERE dskmenu_lbl_id='$mnb_lblid' ");


        //cache dlt for menu dlt in backend 02-sep-2017
        $query = $this->db->query("SELECT `url_displayname` FROM `category_menu_desktop` WHERE `dskmenu_lbl_id`='$mnb_lblid' ");
        $fin_urldispname = $query->row()->url_displayname;
        $this->db->cache_delete('category', $fin_urldispname);
        $this->db->cache_delete($fin_urldispname, 'index');
        $query = $this->db->query("SELECT `url_displayname` FROM `category_menu_desktop` WHERE `parent_id`='$mnb_lblid' ");
        foreach ($query->result() as $rows) {
            $fin_urldispname = $rows->url_displayname;
            $this->db->cache_delete('category', $fin_urldispname);
            $this->db->cache_delete($fin_urldispname, 'index');
        }
        //cache dlt for menu in backend 02-sep-2017




        /* $qr_lvl1=$this->db->query(" SELECT dskmenu_lbl_id,parent_id FROM category_menu_desktop WHERE  parent_id='$mnb_lblid' ");

          $rw_$qr_lvl1=$qr_lvl1->result();

          if(count($rw_$qr_lvl1)>0)
          {
          foreach($rw_$qr_lvl1 as $res_$qr_lvl1){

          $qr_lvl2=$this->db->query(" SELECT dskmenu_lbl_id,parent_id FROM category_menu_desktop WHERE  parent_id='$res_$qr_lvl1->dskmenu_lbl_id' ");
          $rw_$qr_lvl2=$qr_lvl2->result();

          if(count($rw_$qr_lvl2)>0)
          {
          foreach($rw_$qr_lvl2 as $res_$qr_lvl2){

          $qr_lvl3=$this->db->query(" SELECT dskmenu_lbl_id,parent_id FROM category_menu_desktop WHERE  parent_id='$res_$qr_lvl2->dskmenu_lbl_id' ");
          $rw_$qr_lvl3=$qr_lvl3->result();

          if(count($rw_$qr_lvl3)>0)
          {
          foreach($rw_$qr_lvl3 as $res$qr_lvl3)
          {
          $this->db->query("DELETE FROM category_menu_desktop WHERE dskmenu_lbl_id='$res$qr_lvl3->dskmenu_lbl_id' ");
          }
          }
          $this->db->query("DELETE FROM category_menu_desktop WHERE dskmenu_lbl_id='$res$qr_lvl2->dskmenu_lbl_id' ");
          }
          $this->db->query("DELETE FROM category_menu_desktop WHERE dskmenu_lbl_id='$res$qr_lvl1->dskmenu_lbl_id' ");

          }

          }
          } */
    }

    function delete_mobilemenuinfo($mnb_lblid) {
        $this->db->query("update category_menu_mobile SET parent_id=0, order_by=0, is_active='no' , category_id='' , view_type='' WHERE dskmenu_lbl_id='$mnb_lblid' ");


        //cache dlt for menu dlt in backend 02-sep-2017
        $query = $this->db->query("SELECT `url_displayname` FROM `category_menu_mobile` WHERE `dskmenu_lbl_id`='$mnb_lblid' ");
        $fin_urldispname = $query->row()->url_displayname;
        $this->db->cache_delete('category', $fin_urldispname);
        $this->db->cache_delete($fin_urldispname, 'index');
        $query = $this->db->query("SELECT `url_displayname` FROM `category_menu_mobile` WHERE `parent_id`='$mnb_lblid' ");
        foreach ($query->result() as $rows) {
            $fin_urldispname = $rows->url_displayname;
            $this->db->cache_delete('category', $fin_urldispname);
            $this->db->cache_delete($fin_urldispname, 'index');
        }
        //cache dlt for menu in backend 02-sep-2017


        /* $qr_lvl1=$this->db->query(" SELECT dskmenu_lbl_id,parent_id FROM category_menu_mobile WHERE  parent_id='$mnb_lblid' ");

          $rw_$qr_lvl1=$qr_lvl1->result();

          if(count($rw_$qr_lvl1)>0)
          {
          foreach($rw_$qr_lvl1 as $res_$qr_lvl1){

          $qr_lvl2=$this->db->query(" SELECT dskmenu_lbl_id,parent_id FROM category_menu_mobile WHERE  parent_id='$res_$qr_lvl1->dskmenu_lbl_id' ");
          $rw_$qr_lvl2=$qr_lvl2->result();

          if(count($rw_$qr_lvl2)>0)
          {
          foreach($rw_$qr_lvl2 as $res_$qr_lvl2){

          $qr_lvl3=$this->db->query(" SELECT dskmenu_lbl_id,parent_id FROM category_menu_mobile WHERE  parent_id='$res_$qr_lvl2->dskmenu_lbl_id' ");
          $rw_$qr_lvl3=$qr_lvl3->result();

          if(count($rw_$qr_lvl3)>0)
          {
          foreach($rw_$qr_lvl3 as $res$qr_lvl3)
          {
          $this->db->query("DELETE FROM category_menu_mobile WHERE dskmenu_lbl_id='$res$qr_lvl3->dskmenu_lbl_id' ");
          }
          }
          $this->db->query("DELETE FROM category_menu_mobile WHERE dskmenu_lbl_id='$res$qr_lvl2->dskmenu_lbl_id' ");
          }
          $this->db->query("DELETE FROM category_menu_mobile WHERE dskmenu_lbl_id='$res$qr_lvl1->dskmenu_lbl_id' ");

          }

          }
          } */
    }

    function delete_category() {

        $catg_id = $this->input->post('category_id');

        $this->db->query("update product_process_status SET uncategories='process' WHERE status_id='1' ");

        //$catg_id=$this->uri->segment(4);799
        //$unctgr_id=696; // offline
        //$qr_catgindex=$this->db->query("SELECT * FROM category_indexing WHERE category_name='Uncategorized' ");

        $unctgr_id = 799; //online

        /* $this->db->query("UPDATE cornjob_productsearch SET lvl2='696' WHERE lvl2='$catg_id' ");

          $this->db->query("UPDATE cornjob_productsearch SET lvl1='696' WHERE lvl1='$catg_id' ");

          $this->db->query("UPDATE cornjob_productsearch SET lvlmain='696' WHERE lvlmain='$catg_id' "); */


        //$this->db->query("UPDATE category_indexing  SET parent_id='$unctgr_id'  WHERE category_id='$catg_id' ");


        $qr_catgindex = $this->db->query("SELECT * FROM category_indexing WHERE category_id='$catg_id' ");

        $catg_level = $qr_catgindex->row()->cat_level;

        if ($catg_level == '1') {
            $qr_secondlevel = $this->db->query("SELECT * FROM category_indexing WHERE parent_id='$catg_id'  ");
            if ($qr_secondlevel->num_rows() > 0) {
                foreach ($qr_secondlevel->result_array() as $res_secondlevel) {
                    $scnd_catgid = $res_secondlevel['category_id'];

                    $qr_thirdlevel = $this->db->query("SELECT * FROM category_indexing WHERE parent_id='$scnd_catgid'  ");

                    if ($qr_thirdlevel->num_rows() > 0) {
                        foreach ($qr_thirdlevel->result_array() as $res_thirdlevel) {
                            $third_catgid = $res_thirdlevel['category_id'];
                            $this->db->query("UPDATE category_indexing  SET parent_id='$unctgr_id'  WHERE category_id='$third_catgid' "); //third level
                            $this->db->query("UPDATE product_category SET category_id='$unctgr_id' WHERE category_id='$third_catgid' ");

                            $this->db->query("UPDATE seller_product_category SET category='$unctgr_id' WHERE category='$third_catgid' ");

                            $this->db->query("UPDATE cornjob_productsearch SET lvl2='$unctgr_id' WHERE lvl2='$third_catgid' ");
                        }
                    }

                    $this->db->query("UPDATE category_indexing  SET parent_id='$unctgr_id'  WHERE category_id='$scnd_catgid' "); //2nd level
                }
            }



            $this->db->query("UPDATE category_indexing  SET parent_id='$unctgr_id'  WHERE category_id='$catg_id' "); //1st level				
        } else if ($catg_level == '2') {

            $qr_thirdlevel = $this->db->query("SELECT * FROM category_indexing WHERE parent_id='$catg_id'  ");

            if ($qr_thirdlevel->num_rows() > 0) {
                foreach ($qr_thirdlevel->result_array() as $res_thirdlevel) {
                    $third_catgid = $res_thirdlevel['category_id'];
                    $this->db->query("UPDATE category_indexing  SET parent_id='$unctgr_id'  WHERE category_id='$third_catgid' "); //third level

                    $this->db->query("UPDATE product_category SET category_id='$unctgr_id' WHERE category_id='$third_catgid' ");

                    $this->db->query("UPDATE seller_product_category SET category='$unctgr_id' WHERE category='$third_catgid' ");

                    $this->db->query("UPDATE cornjob_productsearch SET lvl2='$unctgr_id' WHERE lvl2='$third_catgid' ");
                }
            }

            $this->db->query("UPDATE category_indexing  SET parent_id='$unctgr_id'  WHERE category_id='$catg_id' "); //2nd level
        } // else condition of 2nd level category
        else if ($catg_level == '3') {
            $this->db->query("UPDATE category_indexing  SET parent_id='$unctgr_id'  WHERE category_id='$catg_id' "); //third level


            $this->db->query("UPDATE product_category SET category_id='$unctgr_id' WHERE category_id='$catg_id' ");

            $this->db->query("UPDATE seller_product_category SET category='$unctgr_id' WHERE category='$catg_id' ");

            $this->db->query("UPDATE cornjob_productsearch SET lvl2='$unctgr_id' WHERE lvl2='$catg_id' ");
        }

        $this->db->query("update product_process_status SET uncategories='not process' WHERE status_id='1' ");
    }

// main function end
}
