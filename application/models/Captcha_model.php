<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Captcha_model extends CI_Model
{
		function insert_captcha_data(){
			$vals = array(
				
				'img_path'      => './captcha/',
				'img_url'       => 'http://example.com/captcha/'
		);
		
		$cap = create_captcha($vals);
		$data = array(
				'captcha_time'  => $cap['00:00:00'],
				'ip_address'    => $this->input->ip_address(),
				'word'          => $cap['word']
		);
		
		$query = $this->db->insert_string('captcha', $data);
		$this->db->query($query);
		
		echo 'Submit the word you see below:';
		echo $cap['image'];
		echo '<input type="text" name="captcha" value="" />';
		
		}
}