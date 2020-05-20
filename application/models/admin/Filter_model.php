<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Filter_model extends CI_Model {

    function retrieve_attribute_set() {
        $query = $this->db->query("SELECT * FROM attribute_group ORDER BY attribute_group_name ASC");
        return $query->result();
    }

    function insert_update_filter_data() {
        $attribute_ids = serialize($this->input->post('attr_id_val'));
        $attr_group_ids = $this->input->post('attr_group_id');
        $attr_group_id = $attr_group_ids[0];
        $data = array(
            'attr_group_id' => $attr_group_id,
            'attr_id' => $attribute_ids
        );

        $data1 = array(
            'attr_id' => $attribute_ids,
        );

        $query = $this->db->query("SELECT * FROM manage_filter WHERE attr_group_id='$attr_group_id'");
        $rows = $query->num_rows();
        if ($rows > 0) {
            $this->db->where('attr_group_id', $attr_group_id);
            $this->db->update('manage_filter', $data1);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            $this->db->insert('manage_filter', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        }
    }

}

?>