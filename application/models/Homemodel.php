<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Homemodel extends CI_Model {

    function select_mobilehomepage_allsections() {
        $qr = $this->db->query("SELECT * FROM mobilesite_pagesectioninfo WHERE page_id='1' AND page_name='home' AND Status='active' ORDER BY Order_by ");
        //$this->db->cache_on();
        return $qr;
    }

    /* public function select_category_allsections()
      {
      $qr=$this->db->query("SELECT * FROM mobilesite_pagesectioninfo WHERE page_id='2' AND page_name='category' AND Status='active' ORDER BY Order_by ");

      return 	$qr;
      } */

    public function select_category_allsections() {
        $qr_seg = $this->uri->segment(2);
        $dsk_menu_id = $this->db->query("SELECT * FROM category_menu_mobile WHERE url_displayname='$qr_seg'");

        $dskmenu = $dsk_menu_id->row()->dskmenu_lbl_id;
        $mob_site_menu = $this->db->query("SELECT * FROM mobilesite_pagesectioninfo WHERE page_id='2' AND page_name='category' AND menu_id!='' AND Status='active' ");

        $sec_array = array();
        foreach ($mob_site_menu->result_array() as $mob_menu) {
            $unserial_menu = unserialize($mob_menu['menu_id']);
            if (in_array($dskmenu, $unserial_menu)) {
                $sec_array[] = $mob_menu['Sec_id'];
            }
        }

        if (count($sec_array) > 0) {
            $sec_id_string = implode(',', $sec_array);
            $qr = $this->db->query("SELECT * FROM mobilesite_pagesectioninfo WHERE page_id='2' AND page_name='category' AND Status='active' AND Sec_id IN ($sec_id_string) ORDER BY Order_by ");
            return $qr;
        } else {
            return $qr = false;
        }
    }

    /* public function select_catlog_allsections()
      {
      //$qr=$this->db->query("SELECT * FROM mobilesite_pagesectioninfo WHERE page_id='1' AND page_name='home' AND Status='active' ORDER BY Order_by ");
      $qr=$this->db->query("SELECT * FROM mobilesite_pagesectioninfo WHERE page_id='3' AND page_name='catalog' AND Status='active' ORDER BY Order_by ");

      return 	$qr;
      } */

    public function select_catlog_allsections() {
        if ($this->uri->segment(1) != 'category' && $this->uri->segment(1) != 'filterby') {
            $qr_seg = $this->uri->segment(1);
        } else {
            $qr_seg = $this->uri->segment(2);
        }
        $dsk_menu_id = $this->db->query("SELECT * FROM category_menu_mobile WHERE url_displayname='$qr_seg'");

        $dskmenu = $dsk_menu_id->row()->dskmenu_lbl_id;
        $mob_site_menu = $this->db->query("SELECT * FROM mobilesite_pagesectioninfo WHERE page_id='3' AND page_name='catalog' AND menu_id!='' AND Status='active' ");

        $sec_array = array();
        foreach ($mob_site_menu->result_array() as $mob_menu) {
            $unserial_menu = unserialize($mob_menu['menu_id']);
            if (in_array($dskmenu, $unserial_menu)) {
                $sec_array[] = $mob_menu['Sec_id'];
            }
        }

        if (count($sec_array) > 0) {
            $sec_id_string = implode(',', $sec_array);
            $qr = $this->db->query("SELECT * FROM mobilesite_pagesectioninfo WHERE page_id='3' AND page_name='catalog' AND Status='active' AND Sec_id IN ($sec_id_string) ORDER BY Order_by ");
            return $qr;
        } else {
            return $qr = false;
        }
    }

    public function single_product_allsections($segment_url) {
        $this->db->cache_off();
        $cornjob_all = $this->db->query("SELECT * FROM cornjob_productsearch WHERE sku='$segment_url'");
        $lvl2 = $cornjob_all->row()->lvl2;
        $mob_site_menu = $this->db->query("SELECT * FROM mobilesite_pagesectioninfo WHERE page_id='4' AND page_name='single product' AND Status='active' AND menu_id!='' ");

        $sec_array = array();
        foreach ($mob_site_menu->result_array() as $mob_menu) {
            $unserial_menu = unserialize($mob_menu['menu_id']);
            if (in_array($lvl2, $unserial_menu)) {
                $sec_array[] = $mob_menu['Sec_id'];
            }
        }
        if (count($sec_array) > 0) {
            $sec_id_string = implode(',', $sec_array);
            $qr = $this->db->query("SELECT * FROM mobilesite_pagesectioninfo WHERE page_id='4' AND page_name='single product' AND Status='active' AND Sec_id IN ($sec_id_string) ORDER BY Order_by ");

            if ($qr->num_rows() > 0) {
                return $qr;
            } else {
                return $qr = false;
            }
        }
    }

    function select_mobile_search_allsections() {
        $qr = $this->db->query("SELECT * FROM mobilesite_pagesectioninfo WHERE page_id='5' AND page_name='searchpage' AND Status='active' ORDER BY Order_by ");

        return $qr;
    }

    function select_offercatalogproduct() {
        $img_sqlid = $this->uri->segment(3);

        $qr_sku = $this->db->query("SELECT sort_by_info, sku FROM mobilesite_imageinfo WHERE img_sqlid='$img_sqlid' ");

        $skuids_arr = unserialize($qr_sku->row()->sku);
        $sort_by = $qr_sku->row()->sort_by_info;

        $modf_skuidsarr = array();

        foreach ($skuids_arr as $key => $val) {
            $modf_skuidsarr[] = "'" . $val . "'";
        }

        $prod_skustr = implode(',', $modf_skuidsarr);

        if ($sort_by == 'random') {
            $query_prod = $this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr)  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by RAND() LIMIT 10 ");
        }
        if ($sort_by == 'prc_asc') {
            $query_prod = $this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr)  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by current_price DESC LIMIT 10 ");
        }
        if ($sort_by == 'pric_dec') {
            $query_prod = $this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr)  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by current_price ASC LIMIT 10 ");
        }
        if ($sort_by == 'as_per_sku') {
            $query_prod = $this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr)  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid DESC LIMIT 10 ");
        }
        if ($sort_by == '') {
            $query_prod = $this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr)  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid DESC LIMIT 10 ");
        }
        return $query_prod;
    }

    function select_offercatalogproduct_count() {
        $img_sqlid = $this->uri->segment(3);

        $qr_sku = $this->db->query("SELECT sku FROM mobilesite_imageinfo WHERE img_sqlid='$img_sqlid' ");

        $skuids_arr = unserialize($qr_sku->row()->sku);

        $modf_skuidsarr = array();
        foreach ($skuids_arr as $key => $val) {
            $modf_skuidsarr[] = "'" . $val . "'";
        }

        $prod_skustr = implode(',', $modf_skuidsarr);

        $query_prod = $this->db->query("select b.prod_search_sqlid from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr) AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku   ");

        return $query_prod->num_rows();
    }

    function select_more_product_data_list() {
        $limit = 12;
        $tart = $this->input->get('from');
        //echo $tart;exit;
        $img_sqlid = $this->input->get('cat_id');
        //echo $img_sqlid;exit;
        //$img_sqlid=$this->uri->segment(3);
        $qr_sku = $this->db->query("SELECT sort_by_info, sku FROM mobilesite_imageinfo WHERE img_sqlid='$img_sqlid' ");

        $skuids_arr = unserialize($qr_sku->row()->sku);
        $sort_by = $qr_sku->row()->sort_by_info;
        $modf_skuidsarr = array();
        foreach ($skuids_arr as $key => $val) {
            $modf_skuidsarr[] = "'" . $val . "'";
        }

        $prod_skustr = implode(',', $modf_skuidsarr);

        if ($sort_by == 'random') {
            $query = $this->db->query("select a.product_id,a.name,a.imag AS catelog_img_url,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku from cornjob_productsearch a  WHERE a.sku IN ($prod_skustr) AND a.quantity>0  AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' group by a.product_id order by RAND() LIMIT $limit ,$tart");
        }
        if ($sort_by == 'prc_asc') {
            $query = $this->db->query("select a.product_id,a.name,a.imag AS catelog_img_url,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku from cornjob_productsearch a  WHERE a.sku IN ($prod_skustr) AND a.quantity>0  AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' group by a.product_id order by current_price DESC LIMIT $limit ,$tart");
        }
        if ($sort_by == 'pric_dec') {
            $query = $this->db->query("select a.product_id,a.name,a.imag AS catelog_img_url,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku from cornjob_productsearch a  WHERE a.sku IN ($prod_skustr) AND a.quantity>0  AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' group by a.product_id order by current_price ASC LIMIT $limit ,$tart");
        }
        if ($sort_by == 'as_per_sku') {
            $query = $this->db->query("select a.product_id,a.name,a.imag AS catelog_img_url,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku from cornjob_productsearch a  WHERE a.sku IN ($prod_skustr) AND a.quantity>0  AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' group by a.product_id order by prod_search_sqlid DESC LIMIT $limit ,$tart");
        }
        if ($sort_by == '') {
            $query = $this->db->query("select a.product_id,a.name,a.imag AS catelog_img_url,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku from cornjob_productsearch a  WHERE a.sku IN ($prod_skustr) AND a.quantity>0  AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' group by a.product_id order by prod_search_sqlid DESC LIMIT  $limit ,$tart");
        }

        return $query;
    }

    function select_desktophomepage_allsections() {
        $qr = $this->db->query("SELECT * FROM desktopsite_pagesectioninfo WHERE page_id='1' AND page_name='home' AND Status='active' ORDER BY Order_by ");

        return $qr;
    }

    function desktop_category_allsections() {
        $qr_seg = $this->uri->segment(2);
        $dsk_menu_id = $this->db->query("SELECT * FROM category_menu_desktop WHERE url_displayname='$qr_seg'");

        $dskmenu = $dsk_menu_id->row()->dskmenu_lbl_id;
        $mob_site_menu = $this->db->query("SELECT * FROM desktopsite_pagesectioninfo WHERE page_id='2' AND page_name='category' AND menu_id!='' AND Status='active' ");

        $sec_array = array();
        foreach ($mob_site_menu->result_array() as $mob_menu) {
            $unserial_menu = unserialize($mob_menu['menu_id']);
            if (in_array($dskmenu, $unserial_menu)) {
                $sec_array[] = $mob_menu['Sec_id'];
            }
        }
        if (count($sec_array) > 0) {
            $sec_id_string = implode(',', $sec_array);
            $qr = $this->db->query("SELECT * FROM desktopsite_pagesectioninfo WHERE page_id='2' AND page_name='category' AND Status='active' AND Sec_id IN ($sec_id_string) ORDER BY Order_by ");
            return $qr;
        } else {
            return $qr = false;
        }
    }

    //sujit offer page start for desktop
    function select_offercatalogproduct_desktop() {
        $img_sqlid = $this->uri->segment(3);

        $qr_sku = $this->db->query("SELECT sort_by_info, sku FROM desktopsite_imageinfo WHERE img_sqlid='$img_sqlid' ");

        $skuids_arr = unserialize($qr_sku->row()->sku);
        $sort_by = $qr_sku->row()->sort_by_info;

        $modf_skuidsarr = array();

        foreach ($skuids_arr as $key => $val) {
            $modf_skuidsarr[] = "'" . $val . "'";
        }

        $prod_skustr = implode(',', $modf_skuidsarr);

        if ($sort_by == 'random') {
            $query_prod = $this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr)  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by RAND() LIMIT 50 ");
        }
        if ($sort_by == 'prc_asc') {
            $query_prod = $this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr)  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by current_price DESC LIMIT 50 ");
        }
        if ($sort_by == 'pric_dec') {
            $query_prod = $this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr)  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by current_price ASC LIMIT 50 ");
        }
        if ($sort_by == 'as_per_sku') {
            $query_prod = $this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr)  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid DESC LIMIT 50 ");
        }
        if ($sort_by == '') {
            $query_prod = $this->db->query("select b.product_id,b.name,b.imag AS catelog_img_url,b.mrp,b.price,b.special_price,b.quantity,b.special_pric_from_dt,b.seller_id,b.special_pric_to_dt,b.sku from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr)  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku order by prod_search_sqlid DESC LIMIT 50 ");
        }
        return $query_prod;
    }

    function select_offercatalogproduct_count_desktop() {
        $img_sqlid = $this->uri->segment(3);

        $qr_sku = $this->db->query("SELECT sku FROM desktopsite_imageinfo WHERE img_sqlid='$img_sqlid' ");

        $skuids_arr = unserialize($qr_sku->row()->sku);

        $modf_skuidsarr = array();
        foreach ($skuids_arr as $key => $val) {
            $modf_skuidsarr[] = "'" . $val . "'";
        }

        $prod_skustr = implode(',', $modf_skuidsarr);

        $query_prod = $this->db->query("select b.prod_search_sqlid from cornjob_productsearch b  WHERE b.sku IN ($prod_skustr) AND b.quantity>0  AND b.prod_status='Active' AND b.status='Enabled' AND b.seller_status='Active' group by b.sku   ");

        return $query_prod->num_rows();
    }

    function select_more_product_data_list_desktop() {
        //echo '<pre>';print_r($_GET);exit;
        $limit = 50;
        $tart = $this->input->get('from');
        //echo $tart;exit;
        $img_sqlid = $this->input->get('cat_id');
        //echo $img_sqlid;exit;
        //$img_sqlid=$this->uri->segment(3);
        //die("SELECT sort_by_info, sku FROM desktopsite_imageinfo WHERE img_sqlid='$img_sqlid' ");
        $qr_sku = $this->db->query("SELECT sort_by_info, sku FROM desktopsite_imageinfo WHERE img_sqlid='$img_sqlid' ");

        $skuids_arr = unserialize($qr_sku->row()->sku);
        $sort_by = $qr_sku->row()->sort_by_info;
        $modf_skuidsarr = array();
        foreach ($skuids_arr as $key => $val) {
            $modf_skuidsarr[] = "'" . $val . "'";
        }

        $prod_skustr = implode(',', $modf_skuidsarr);


        if ($sort_by == 'random') {
            $query = $this->db->query("select a.product_id,a.name,a.imag AS catelog_img_url,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku from cornjob_productsearch a  WHERE a.sku IN ($prod_skustr) AND a.quantity>0  AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' group by a.product_id order by RAND() LIMIT $limit ,$tart");
        }
        if ($sort_by == 'prc_asc') {
            $query = $this->db->query("select a.product_id,a.name,a.imag AS catelog_img_url,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku from cornjob_productsearch a  WHERE a.sku IN ($prod_skustr) AND a.quantity>0  AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' group by a.product_id order by current_price DESC LIMIT $limit ,$tart");
        }
        if ($sort_by == 'pric_dec') {
            $query = $this->db->query("select a.product_id,a.name,a.imag AS catelog_img_url,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku from cornjob_productsearch a  WHERE a.sku IN ($prod_skustr) AND a.quantity>0  AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' group by a.product_id order by current_price ASC LIMIT $limit ,$tart");
        }
        if ($sort_by == 'as_per_sku') {
            //die("select a.product_id,a.name,a.imag AS catelog_img_url,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku from cornjob_productsearch a  WHERE a.sku IN ($prod_skustr) AND a.quantity>0  AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' group by a.product_id order by prod_search_sqlid DESC LIMIT $limit ,$tart");
            $query = $this->db->query("select a.product_id,a.name,a.imag AS catelog_img_url,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku from cornjob_productsearch a  WHERE a.sku IN ($prod_skustr) AND a.quantity>0  AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' group by a.product_id order by prod_search_sqlid DESC LIMIT $limit ,$tart");
        }
        if ($sort_by == '') {
            $query = $this->db->query("select a.product_id,a.name,a.imag AS catelog_img_url,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku from cornjob_productsearch a  WHERE a.sku IN ($prod_skustr) AND a.quantity>0  AND a.prod_status='Active' AND a.status='Enabled' AND a.seller_status='Active' group by a.product_id order by prod_search_sqlid DESC LIMIT  $limit ,$tart");
        }

        return $query;
    }

    //sujit offer page end for desktop

    public function desktop_catlog_allsections() {
        if ($this->uri->segment(1) != 'category' && $this->uri->segment(1) != 'filterby') {
            $qr_seg = $this->uri->segment(1);
        } else {
            $qr_seg = $this->uri->segment(2);
        }
        $dsk_menu_id = $this->db->query("SELECT * FROM category_menu_desktop WHERE url_displayname='$qr_seg'");

        $dskmenu = $dsk_menu_id->row()->dskmenu_lbl_id;
        $mob_site_menu = $this->db->query("SELECT * FROM desktopsite_pagesectioninfo WHERE page_id='3' AND page_name='catalog' AND menu_id!='' AND Status='active' ");

        $sec_array = array();
        foreach ($mob_site_menu->result_array() as $mob_menu) {
            $unserial_menu = unserialize($mob_menu['menu_id']);
            if (in_array($dskmenu, $unserial_menu)) {
                $sec_array[] = $mob_menu['Sec_id'];
            }
        }

        if (count($sec_array) > 0) {
            $sec_id_string = implode(',', $sec_array);
            $qr = $this->db->query("SELECT * FROM desktopsite_pagesectioninfo WHERE page_id='3' AND page_name='catalog' AND Status='active' AND Sec_id IN ($sec_id_string) ORDER BY Order_by ");
            return $qr;
        } else {
            return $qr = false;
        }
    }

    public function desktop_single_product_allsections($segment_url) {
        $this->db->cache_off();
        $cornjob_all = $this->db->query("SELECT * FROM cornjob_productsearch WHERE sku='$segment_url'");
        $lvl2 = $cornjob_all->row()->lvl2;
        $mob_site_menu = $this->db->query("SELECT * FROM desktopsite_pagesectioninfo WHERE page_id='4' AND page_name='single product' AND Status='active' AND menu_id!='' ");

        $sec_array = array();
        foreach ($mob_site_menu->result_array() as $mob_menu) {
            $unserial_menu = unserialize($mob_menu['menu_id']);
            if (in_array($lvl2, $unserial_menu)) {
                $sec_array[] = $mob_menu['Sec_id'];
            }
        }
        if (count($sec_array) > 0) {
            $sec_id_string = implode(',', $sec_array);
            $qr = $this->db->query("SELECT * FROM desktopsite_pagesectioninfo WHERE page_id='4' AND page_name='single product' AND Status='active' AND Sec_id IN ($sec_id_string) ORDER BY Order_by ");

            if ($qr->num_rows() > 0) {
                return $qr;
            } else {
                return $qr = false;
            }
        }
    }

    function select_desktop_search_allsections() {
        $qr = $this->db->query("SELECT * FROM desktopsite_pagesectioninfo WHERE page_id='5' AND page_name='searchpage' AND Status='active' ORDER BY Order_by ");

        return $qr;
    }

}

?>