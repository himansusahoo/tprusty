<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cache_model extends CI_Model {

    function select_cache($limit, $start) {
        $query = $this->db->query("select category_indexing.cat_level,category_indexing.category_name as lvl2_name,clear_catch.catg_id from clear_catch inner join category_indexing on clear_catch.catg_id=category_indexing.category_id group by clear_catch.catg_id ORDER BY category_indexing.cat_level LIMIT " . $start . ", " . $limit . " ");

        return $query;
    }

    function select_cachelvl($limit, $start) {
        $lvlid = $this->input->GET("lvlid");
        $query = $this->db->query("select category_indexing.cat_level,category_indexing.category_name as lvl2_name,clear_catch.catg_id from clear_catch inner join category_indexing on clear_catch.catg_id=category_indexing.category_id where category_indexing.cat_level='$lvlid' group by clear_catch.catg_id ORDER BY category_indexing.cat_level LIMIT " . $start . ", " . $limit . " ");

        return $query;
    }

    function getcache_countlvl() {

        $lvlid = $this->input->GET("lvlid");
        $query = $this->db->query("select category_indexing.category_name as lvl2_name,clear_catch.catg_id from clear_catch inner join category_indexing on clear_catch.catg_id=category_indexing.category_id where category_indexing.cat_level='$lvlid' group by clear_catch.catg_id");

        return $query->num_rows();
    }

    function getcache_count() {

        $query = $this->db->query("select category_indexing.category_name as lvl2_name,clear_catch.catg_id from clear_catch inner join category_indexing on clear_catch.catg_id=category_indexing.category_id group by clear_catch.catg_id");

        return $query->num_rows();
    }

    function select_updatecache($limit, $start) {

        $query = $this->db->query("SELECT catg_id from prod_cache group by catg_id");
        if ($query->num_rows() > 0) {
            $resarr = $query->result_array();
            //print_r($resarr);
            foreach ($resarr as $sub) {
                $tmpArr[] = implode(',', $sub);
            }
            $result = implode(',', $tmpArr);
            //echo $result;
            //exit;
            $query = $this->db->query("SELECT  category_indexing.cat_level,category_menu_desktop.label_name,category_menu_desktop.url_displayname as lvl2_name, category_menu_desktop.category_id as catg_id FROM `category_menu_desktop` inner join category_indexing on category_menu_desktop.category_id=category_indexing.category_id WHERE category_menu_desktop.category_id in ($result)  LIMIT " . $start . ", " . $limit . " ");
        }
        return $query;
    }

    function select_updatecacheforsearch() {

        $query = $this->db->query("SELECT catg_id from prod_cache group by catg_id");
        if ($query->num_rows() > 0) {
            $resarr = $query->result_array();
            //print_r($resarr);
            foreach ($resarr as $sub) {
                $tmpArr[] = implode(',', $sub);
            }
            $result = implode(',', $tmpArr);
            //echo $result;
            //exit;
            //die("SELECT  category_indexing.cat_level,category_menu_desktop.label_name,category_menu_desktop.url_displayname as lvl2_name, category_menu_desktop.category_id as catg_id FROM `category_menu_desktop` inner join category_indexing on category_menu_desktop.category_id=category_indexing.category_id WHERE category_menu_desktop.category_id in ($result)   ");
            $query = $this->db->query("SELECT  category_indexing.cat_level,category_menu_desktop.label_name,category_menu_desktop.url_displayname as lvl2_name, category_menu_desktop.category_id as catg_id FROM `category_menu_desktop` inner join category_indexing on category_menu_desktop.category_id=category_indexing.category_id WHERE category_menu_desktop.category_id in ($result)   ");

            return $query;
        }
    }

    function select_cachelvlsearch() {
        $lvlid = $this->input->GET("lvlid");
        $result = implode(",", $lvlid);
        //echo $result; exit;
        $query = $this->db->query("SELECT  category_indexing.cat_level,category_menu_desktop.url_displayname as lvl2_name, category_menu_desktop.category_id as catg_id,category_menu_desktop.label_name FROM `category_menu_desktop` inner join category_indexing on category_menu_desktop.category_id=category_indexing.category_id WHERE category_menu_desktop.category_id in ($result)   ");

        return $query;
    }

    function getupdatecache_count() {

        $query = $this->db->query("SELECT catg_id from prod_cache group by catg_id");
        if ($query->num_rows() > 0) {
            $resarr = $query->result_array();
            //print_r($resarr);

            foreach ($resarr as $sub) {
                $tmpArr[] = implode(',', $sub);
            }
            $result = implode(',', $tmpArr);
            //echo $result;
            //exit;
            $query = $this->db->query("SELECT  category_indexing.cat_level,category_menu_desktop.label_name,category_menu_desktop.url_displayname as lvl2_name, category_menu_desktop.category_id as catg_id FROM `category_menu_desktop` inner join category_indexing on category_menu_desktop.category_id=category_indexing.category_id WHERE category_menu_desktop.category_id in ($result) ");

            return $query->num_rows();
        } else {
            return $cnt = 0;
        }
    }

}

?>