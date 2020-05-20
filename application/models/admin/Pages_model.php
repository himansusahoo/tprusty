<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pages_model extends CI_Model {

    function getPages() {
        $query = $this->db->query("SELECT * FROM pages");
        $row = $query->num_rows();
        if ($row > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getPageDetails($page_id) {
        $query = $this->db->query("SELECT * FROM pages WHERE page_id='$page_id'");
        $row = $query->num_rows();
        if ($row > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function updatePageContent($page_id) {
        $data = array(
            'title' => $this->input->post('title'),
            'meta_keyword' => $this->input->post('meta_keyword'),
            'meta_descrp' => $this->input->post('meta_description'),
            'content' => $this->input->post('page_content'),
        );
        $this->db->set('last_updated', 'NOW()', FALSE);
        $this->db->where('page_id', $page_id);
        $this->db->update('pages', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
