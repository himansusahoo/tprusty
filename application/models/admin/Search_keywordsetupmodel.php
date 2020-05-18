<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_keywordsetupmodel extends CI_Model
{
	
	function select_catg()
	{
		$qr=$this->db->query("SELECT DISTINCT lvl2, lvl2_name, lvl1, lvl1_name , lvlmain_name FROM temp_category WHERE lvl1 !=0
			
			UNION ALL 
			
			
			SELECT DISTINCT ''lvl2, ''lvl2_name, b.category_id as  lvl1, b.category_name as lvl1_name , lvlmain_name FROM temp_category a
			INNER JOIN category_indexing b ON a.lvl1=b.category_id
			 WHERE a.lvl1 !=0 AND b.cat_level=2	
			
				");
			
			return $qr;
			
			//SELECT ''lvl2 , ''lvl2_name , category_id as lvl1, category_name as lvl1_name , ''lvlmain_name  FROM category_indexing WHERE cat_level=2	
	}
	
	function select_mainparentcategory()
	{
		$query=$this->db->query("SELECT * category_indexing WHERE parent_id=0 ");
		return $query;	
	}

	function save_searchkeywords()
	{
		$status='';
		$keyword=trim($this->input->post('kyword'));
		
		$catgids=$this->input->post('catgids');
		
		$url_link=$this->input->post('url_link');
		
		
		$qr=$this->db->query("SELECT * FROM category_indexing WHERE category_id='$catgids' ");
		
		$catg_name=$qr->row()->category_name;
		$category_level=$qr->row()->cat_level;
		
		
		$qr_check=$this->db->query("SELECT keyword FROM search_keyword WHERE category_id='$catgids' AND keyword='$keyword' ");
		
		if($qr_check->num_rows()>0)
		{
			//echo "keyword already exist under this Category";
			$status='data Exist';
			return $status;	
		}
		else
		{
		
			$data=array(
			'keyword'=>$keyword,		
			'category_name'=>$catg_name,
			'category_id'=>$catgids,
			'category_level'=>$category_level,
			'url'=>$url_link
			);
			//print_r($data);exit;
			
			$this->db->insert('search_keyword',$data);
			return $status;	
		}
			
	}
	
	function kyword_count()
	{
		$qr=$this->db->query("SELECT srchkwrd_sqlid FROM search_keyword");
		return $qr->num_rows();
			
	}
	function retrive_searchkeywords($limit,$start)
	{
		
		$qr=$this->db->query("SELECT * FROM search_keyword LIMIT ".$start.", ".$limit."");
		
		return $qr;	
	}

	
}
?>