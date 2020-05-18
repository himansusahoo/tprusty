<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_activity_model extends CI_Model
{
	
	function insert_user_log($log_data)
	{
		
		date_default_timezone_set('Asia/Calcutta');
		$cdate =date('y-m-d H:i:s');
		$uid= $this->session->userdata('logged_userrole_id');
		$uname=$this->session->userdata('logged_in');
		
				$data=array(
							
							'log_detail'=>$log_data,
							'user_id'=>$uid,
							'user_name'=>$uname,
							'log_datetime'=>$cdate
						);
						$this->db->insert('user_log',$data);
						
						
		
			
	}

	
}