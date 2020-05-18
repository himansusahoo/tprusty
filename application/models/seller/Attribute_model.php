<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attribute_model extends CI_Model{
	
	function retrieve_attr_headings(){
		$attr_group_id = $this->input->post('group_id');
		$query = $this->db->query("SELECT * FROM attributes WHERE attribute_group_id=$attr_group_id");
		return $query;
	}


function retrieve_colors(){
		$query = $this->db->query("SELECT * FROM color_master");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function retrieve_size(){
		$query = $this->db->query("SELECT * FROM size_master WHERE size_cat='M'");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function retrieve_sub_size(){
		$query = $this->db->query("SELECT * FROM size_master WHERE size_cat='S'");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
}

?>