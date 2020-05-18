<?php
class My_Exceptions extends CI_Exceptions {

public function __construct(){
    parent::__construct();
}

		function show_404($page = ''){ // error page logic
		
			header("HTTP/1.1 404 Not Found");
			$heading = "404 Page Not Found";
			$message = "The page you requested was not found ";
			$CI =& get_instance();
			$CI->load->view('error_404');
		
		}
}
?>