<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bulkupload_category_attrblink_model extends CI_Model {

    function getedit_attributeset_ascatg($catg_id) {                
        $attrb_arr = array();
        $query = $this->db->query("SELECT * FROM attribute_group WHERE cate_attributelink!=''");
        foreach ($query->result_array() as $res) {
            $catg_slz = array();
            $catg_slz = unserialize($res['cate_attributelink']);            
            if (in_array($catg_id, $catg_slz)) {
                $attrb_arr[] = $res['attribute_group_id'];
            }
        }
        $arr_string = implode(',', $attrb_arr);        
        return $arr_string;
    }

}

?>