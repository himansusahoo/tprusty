<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Attribute_model extends CI_Model {

    function retrive_attribute_group() {
        $query = $this->db->query("select * from attribute_group");
        return $query;
    }

    function insert_attriute_group() {
        $max_attrb_group_id = $this->get_unique_id('attribute_group', 'attribute_group_id');

        $data = array(
            'attribute_group_id' => $max_attrb_group_id,
            'attribute_group_name' => $this->input->post('atrb_grp_nm')
        );


        $query = $this->db->insert('attribute_group', $data);

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function get_unique_id($table, $uid) {

        $query = $this->db->query('SELECT MAX(' . $uid . ') AS `maxid` FROM ' . $table);
        $maxId = $query->row()->maxid;
        $id = $maxId + 1;
        return $id;
    }

    function retrive_attribute() {
        $query = $this->db->query("select a.*,b.attribute_group_name from attributes a  inner join attribute_group b on a.attribute_group_id=b.attribute_group_id ");
        return $query;
    }

    function retrive_product_attribute_group() {
        $query = $this->db->query("SELECT * FROM attribute_group ORDER BY attribute_group_name ASC");
        $result = $query->result();
        return $result;
    }

    function insert_new_attributedata() {
        $max_attrb_group_id = $this->get_unique_id('attributes', 'attribute_heading_id');

        $data = array(
            'attribute_heading_id' => $max_attrb_group_id,
            'attribute_group_id' => $this->input->post('attrib_grp_id'),
            'attribute_heading_name	' => $this->input->post('atrb_nm')
        );


        $query = $this->db->insert('attributes', $data);

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function filter_attributegroup() {

        $attrb_id = $this->input->post('attrb_id');
        $name = $this->input->post('name');


        //$condition = "b.status='Active' AND c.status='Active'";
        $condition = '';

        if ($attrb_id != '' && $name == '') {
            $condition .= "attribute_group_id='$attrb_id'";
        }
        if ($attrb_id == '' && $name != '') {
            $condition .= "attribute_group_name='$name'";
        }

        if ($attrb_id == '' && $name == '') {
            $query = $this->db->query("select * from attribute_group  ");
            return $query;
        }

        $query = $this->db->query("select * from attribute_group where " . $condition);

        return $query;
    }

    function delete_attributegroup() {

        $attrbgrb_id = implode(',', $this->input->post('atrb_groupid'));

        $this->db->query("delete from attribute_group WHERE attribute_group_id IN ($attrbgrb_id)  ");
        $this->db->query("delete from attributes where attribute_group_id IN ($attrbgrb_id)  ");
    }

    function retrive_attribute_group_edit($atrb_group_id) {
        $query = $this->db->query("select * from attribute_group where attribute_group_id='$atrb_group_id' ");

        $rows = $query->row();
        return $rows;
    }

    function edit_attributegroup_info() {
        $atrb_grp_id = $this->input->post('atrb_grp_id');
        $atrb_grp_name = $this->input->post('atrb_grp_nm');

        $query = $this->db->query("update attribute_group set attribute_group_name='$atrb_grp_name' where attribute_group_id='$atrb_grp_id' ");

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function retrive_attribute_for_edit($atrb_hedng_id) {
        $query = $this->db->query("select * from attributes where attribute_heading_id='$atrb_hedng_id'");

        $rows = $query->row();
        return $rows;
    }

    function update_attributedata() {
        $atrb_id = $this->input->post('atrb_id');
        $atrb_grp_id = $this->input->post('attrib_grp_id');
        $atrb_name = $this->input->post('atrb_nm');

        $query = $this->db->query("update attributes set attribute_heading_name='$atrb_name', attribute_group_id='$atrb_grp_id' where attribute_heading_id='$atrb_id' ");

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function delete_attribute_data() {
        $attrb_id = implode(',', $this->input->post('atrb_id'));
        $this->db->query("delete from attributes WHERE attribute_heading_id IN ($attrb_id)  ");
    }

    function delete_attribute_field_data() {
        $id = implode(',', $this->input->post('atrb_id'));
        $this->db->query("delete from attribute_real WHERE id IN ($id)  ");
    }

    function filtered_attribute() {

        //$attrb_id = $this->input->post('attrb_id');
        //$attrb_name = $this->input->post('attrb_name');
        $group_name = $this->input->post('select_att_name');
        //print_r($group_name);exit;
        //$condition = "b.status='Active' AND c.status='Active'";
        $condition = '';



        if ($group_name != '') {
            $condition .= "b.attribute_group_name='$group_name'";
        }

        if ($group_name == '') {

            $query = $this->db->query("select a.*,b.attribute_group_name from attributes a  inner join attribute_group b on a.attribute_group_id=b.attribute_group_id  ");
            return $query;
        }
        //echo $condition;exit;	
        $query = $this->db->query("select a.*,b.attribute_group_name,b.attribute_group_id from attributes a  inner join attribute_group b on a.attribute_group_id=b.attribute_group_id where " . $condition);

        return $query;
    }

    function retrieve_attr_heading_n_group($attr_heading_id) {
        $query = $this->db->query("SELECT a.attribute_heading_id,a.attribute_heading_name,b.attribute_group_name,b.attribute_group_id FROM attributes a INNER JOIN attribute_group b ON a.attribute_group_id=b.attribute_group_id WHERE a.attribute_heading_id=$attr_heading_id");
        return $query->result();
    }

    function insert_attribute_field_name() {
        $data = array(
            'attribute_id' => $this->get_unique_id('attribute_real', 'attribute_id'),
            'attribute_group_id' => $this->input->post('group_id'),
            'attribute_heading_id' => $this->input->post('heading_id'),
            'attribute_field_name' => $this->input->post('name'),
        );
        $this->db->insert('attribute_real', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
    }

    function retrieve_attr_field_details($attr_heading_id) {
        $query = $this->db->query("SELECT * FROM attribute_real WHERE attribute_heading_id=$attr_heading_id");
        return $query;
    }

    function retrieve_attr_headings($attr_group_id) {
        //$attr_group_id = $this->input->post('group_id');
        $query = $this->db->query("SELECT * FROM attributes WHERE attribute_group_id='$attr_group_id'");
        return $query;
    }

    function retrieve_filter_attr_data($attr_group_id) {
        $query = $this->db->query("SELECT * FROM manage_filter WHERE attr_group_id='$attr_group_id'");
        return $query;
    }

    function update_attribute_fields() {
        $id = $this->input->post('id');
        $data = array(
            'attribute_field_name' => addslashes($this->input->post('attr_fld')),
        );
        $this->db->where('id', $id);
        $this->db->update('attribute_real', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
    }

    function retrieve_colors() {
        $query = $this->db->query("SELECT * FROM color_master");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function retrieve_size() {
        $query = $this->db->query("SELECT * FROM size_master WHERE size_cat='M'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function retrieve_sub_size() {
        $query = $this->db->query("SELECT * FROM size_master WHERE size_cat='S'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

}

?>