<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bulkupload_category_attrblink_model extends CI_Model
{
	function getedit_attributeset_ascatg($attrb_id)
	{	
			$arr=array();
			$attrb_linkslz=array();
			$query=$this->db->query("SELECT * FROM attribute_group where attribute_group_id='$attrb_id'");
			$rw_extcatg=$query->row();
			$attrb_slz = unserialize( $rw_extcatg->cate_attributelink);
		if($attrb_slz!=''){
			foreach($attrb_slz as $key=>$val)
			{	
			    $arr[]= $val;	
				$attrb_linkslz[]=$val;
				$attrb_string=implode(',',$attrb_linkslz);
				$qr=$this->db->query("SELECT DISTINCT lvl2, lvl1, lvlmain  FROM  `temp_category` WHERE lvl1 !=0 AND lvl2 IN ($attrb_string)");
				foreach($qr->result_array() as $res)
				{
					$arr[]=$res['lvl2'];
					$arr[]=$res['lvl1'];
					$arr[]=$res['lvlmain'];	
					
				}
			}
		}
									
					 $arr_string=implode(',',array_unique($arr));
			
			return $arr_string;
			
			
	}
}