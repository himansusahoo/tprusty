<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('html','form','url'));
		$this->load->library('form_validation');
		$this->load->helper('file');
		$this->load->database();
		//$this->load->helper(array('solariumphp/library/solarium/Autoloader', 'file'));
		
		//$this->load->library('email');
		//$this->load->library('session');
		//$this->load->library('upload');
		//$this->load->library('encrypt');
		//$this->load->library('javascript');
		//$this->load->library('pagination');
		//$this->load->helper('string');
		//$this->load->helper('cookie');
		//$this->load->library('user_agent');
		
		//$this->load->model('Product_descrp_model');
		//$this->load->model('Mycart_model');
		//$this->load->library('breadcrumbs');
		//$this->load->model('Admin_model');
	}
	function index()
	{
		echo phpinfo();exit;
	}
	
	function update_desktopmenuas_categorydisplay()
	{
		$qr=$this->db->query("SELECT * FROM `category_menu_desktop` WHERE `parent_id` in (select `dskmenu_lbl_id` from `category_menu_desktop` WHERE `parent_id`=0) ");
		
		foreach($qr->result_array() as $res_catg)
		{
			$dsklblid=$res_catg['dskmenu_lbl_id'];
			$this->db->query("UPDATE category_menu_desktop SET view_type='category' WHERE dskmenu_lbl_id='$dsklblid' ");	
		}
		
		echo "Finish";exit;	
	}
	
	function solr_test()
	{
		
			$curl = curl_init("http://74.208.217.65:8983/solr/mycollection1/admin/ping/?wt=json");
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$output = curl_exec($curl);
			$data = json_decode($output, true);
			echo "Ping Status : ".$data["status"].PHP_EOL;
			
			exit;
			
			/*$curl=" '[{".'"'."prodnm".'":'.'"mobile"'."}]'";
			
			$curl_strng="http://54.83.83.19:80/solr/product1/update -d ".$curl;
			https://ec2-6-1-usa-va.opensolr.com/solr/product1/select?indent=on&q=prod:%22Bluedio%20I4%20Bluetooth%20Headset%20V3.0%20Stereo%20Wireless%20HeadPhones|%20MultiPoint%20+%20VoIp%22&wt=json
			*/
			
			echo "<br><br><br><br>";
			
			$start=0;
			$count=100000;
			$cleanSolr=true;
			
			$fields = array(
			'debug' => false,
			'commit' => true,
			'command' => 'full-import',
			'optimize' => false,
			'indent' => true,
			'rows' => $count,
			'start' => $start,
			'verbose' => false,
			'clean' => $cleanSolr, // true at first time and false after it
			'wt' => 'json',
		);
			
			/*$search_txt = "Bluedio%20I4%20Bluetooth%20Headset";
			$curl_strng = "http://54.83.83.19:80/solr/product1/select?indent=on&q=prodnm:".$search_txt."&wt=php";*/
			
			$curl_strng = 'http://54.83.83.19:80/solr/product1/dataimport?' . http_build_query($fields);
			
			
			$curl2 = curl_init($curl_strng);
			$output = curl_exec($curl2);
			 $data1 = json_decode($output, true);

			echo $data1.PHP_EOL;
			echo "<br><br><br><br>";
			
			$search_txt = "Bluedio%20I4%20Bluetooth%20Headset";
			$curl_strng = "http://54.83.83.19:80/solr/product1/select?indent=on&q=prodnm:".$search_txt."&wt=php";
			
			//$curl_strng ="http://54.83.83.19:80/solr/product1/update?commit=true&stream.body=<delete><query>*:*</query></delete>";
			
			$curl2 = curl_init($curl_strng);
			$output = curl_exec($curl2);
			 $data2 = json_decode($output, true);
			
			echo $data2.PHP_EOL;
			
			
   }
	
	
	function solr_test()
	{
		//$curl_strng="http://74.208.217.65:8983/solr/mycollection1/solr/update?commit=true -H" .'"'."Content-Type: text/xml".'"'." --data-binary '<add><doc><field name=".'id'.">ZXVO-991-700-0579001</field><field name=".'prodname'.">Hamee Designer High Quality Hard Case Cover for Xiaomi Mi 4i</field><field name=".'firstname'.">John</field><field name=".'lastname'.">Collins</field><field name=".'classname'.">User</field></doc></add>'";
		
		$curl_strng="http://74.208.217.65:8983/solr/mycollection1/solr/update?commit=true -H" .'"'."Content-Type: text/xml".'"'." --data-binary '<add><doc><field name=".'id'.">ZXVO-991-700-0579001</field><field name=".'prodname'.">Hamee Designer High Quality Hard Case Cover for Xiaomi Mi 4i</field><field name=".'firstname'.">John</field><field name=".'lastname'.">Collins</field><field name=".'classname'.">User</field></doc></add>'";
		
		
		
	}
	
	
	
}
?>