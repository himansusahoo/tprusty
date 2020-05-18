<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file')); 
		$this->load->helper(array('html','form','url'));
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->library('session');
		$this->load->library('encrypt');
		$this->load->library('javascript');
		$this->load->library('upload');
		$this->load->database();
		$this->load->model('admin/Config_model');
		$this->load->library('pagination');
		$this->load->library('image_lib');
		$this->db->cache_off();			
	}

	function index(){
		$this->load->view('admin/configuration');
	}
	
	function ad_blog(){
		if($this->session->userdata('logged_in')){
			$data['image_info']=$this->Config_model->ad_blog();
			$this->load->view('admin/ad_blog',$data);
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function upload_ad_blog(){
		if($this->session->userdata('logged_in')){
			$this->db->cache_delete('default', 'index');
			$config['upload_path'] = './images/blog/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload');
			$this->upload->initialize($config);
			//$this->load->library('upload', $config);
			if ($this->upload->do_upload()){
				$data=$this->upload->data();
				$path=$data['full_path'];
				$name_array1=$data['file_name'];
				
				$configi['image_library'] = 'gd2';
				$configi['source_image']   = $path;
				$configi['maintain_ratio'] = FALSE;
				$configi['width']  = 586;
				$configi['height'] =280;
			 
				$this->load->library('image_lib');
				$this->image_lib->initialize($configi);
				//$category=$this->input->post('categoryid1');
				if($this->image_lib->resize()){
					$result_box1=$this->Config_model->ad_blog();
					$row1=$result_box1->num_rows();
					//print_r($row1);exit;
					if($row1==""){
						$this->Config_model->insert_ad_blog($name_array1);
					}else{
						$this->Config_model->update_ad_blog($name_array1);
					}
				}
				redirect('admin/configuration/ad_blog');
			}
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function image_upload(){
		if($this->session->userdata('logged_in')){
			$data['image_info']=$this->Config_model->slider_box1_select();
			$this->load->view('admin/banner_upload',$data);
		}else{
			redirect('admin/super_admin');
		}
	}
	function edit_images(){
		if($this->session->userdata('logged_in')){
			$data['image_info']=$this->Config_model->edit_banner($this->uri->segment(4));
			$this->load->view('admin/edit_slider',$data);
		}else{
			redirect('admin/super_admin');
		}
	}
	function newslide(){
		if($this->session->userdata('logged_in')){
			$this->load->view('admin/new_slide');
		}else{
			redirect('admin/super_admin');
		}
	}
	function upload_slider_box1(){
		if($this->session->userdata('logged_in')){
			$config['upload_path'] = './images/slider/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload');
			$this->upload->initialize($config);
		
			if ($this->upload->do_upload()){
				$data=$this->upload->data();
				$path=$data['full_path'];
				$name_array1=$data['file_name'];
				
				 $configi['image_library'] = 'gd2';
				 $configi['source_image']   = $path;
				 $configi['maintain_ratio'] = FALSE;
				 $configi['width']  = 1218;
				 $configi['height'] = 413;
			 
				 $this->load->library('image_lib');
				 $this->image_lib->initialize($configi);
				if($this->image_lib->resize()){
					$result_slider=$this->Config_model->slider_box1_select();
					$row1=$result_slider->num_rows();
						if($row1==0 or $row1<5){
							$this->Config_model->insert_slider_box1($name_array1);
							redirect('admin/configuration/image_upload');
						}
						else{
							$this->session->set_flashdata('error_message', 'Cannot Upload More than 5 Images in a row.');
							redirect('admin/configuration/image_upload');
					}
				}
			}
		}else{
			redirect('admin/super_admin');
		}
	}
	function update_slider_box1(){
		    if($this->session->userdata('logged_in')){
			$config['upload_path'] = './images/slider/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload');
			$this->upload->initialize($config);
			//$this->load->library('upload', $config);
			if ($this->upload->do_upload()){
				$data=$this->upload->data();
				$path=$data['full_path'];
				$name_array1=$data['file_name'];
				
				$configi['image_library'] = 'gd2';
				$configi['source_image']   = $path;
				$configi['maintain_ratio'] = FALSE;
				$configi['width']  = 1218;
				$configi['height'] = 413;
			 
				$this->load->library('image_lib');
				$this->image_lib->initialize($configi);
					if($this->image_lib->resize())
					{
					//////image uploading script end here/////
					$category=$this->input->post('categoryid1');
					//print_r($category);exit;
					
					$this->Config_model->update_slider_box1($name_array1,$this->uri->segment(4),$category);
					redirect('admin/configuration/image_upload');
					}
					else 
					{
					redirect('admin/configuration/image_upload');
					}
				}
		}else{
			redirect('admin/super_admin');
		}
	}
	
	
	function upload_block2_box1(){
		if($this->session->userdata('logged_in')){
			$config['upload_path'] = './images/subpage2/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload');
			$this->upload->initialize($config);
			//$this->load->library('upload', $config);
			if ($this->upload->do_upload()){
				$data=$this->upload->data();
				$path=$data['full_path'];
				$name_array1=$data['file_name'];
				
				$configi['image_library'] = 'gd2';
				$configi['source_image']   = $path;
				$configi['maintain_ratio'] = FALSE;
				$configi['width']  = 357;
				$configi['height'] =291;
			 
				$this->load->library('image_lib');
				$this->image_lib->initialize($configi);
				$category=$this->input->post('categoryid1');
				if($this->image_lib->resize()){
					$result_box1=$this->Config_model->block2_box1_select();
					$row1=$result_box1->num_rows();
					//print_r($row1);exit;
					if($row1==""){
						$this->Config_model->insert_block2_box1($name_array1,$category);
					}else{
						$this->Config_model->update_block2_box1($name_array1,$category);
					}
				}
				redirect('admin/configuration/subpage2_setting');
			}
		}else{
			redirect('admin/super_admin');
		}
	}
	function upload_block2_box2(){
		if($this->session->userdata('logged_in')){
			$config['upload_path'] = './images/subpage2/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload');
			$this->upload->initialize($config);
			//$this->load->library('upload', $config);
			if ($this->upload->do_upload()){
				$data=$this->upload->data();
				$path=$data['full_path'];
				$name_array1=$data['file_name'];
				
				$configi['image_library'] = 'gd2';
				$configi['source_image']   = $path;
				$configi['maintain_ratio'] = FALSE;
				$configi['width']  = 357;
				$configi['height'] =291;
			 
				$this->load->library('image_lib');
				$this->image_lib->initialize($configi);
				$category=$this->input->post('categoryid2');
				if($this->image_lib->resize()){
					$result_box1=$this->Config_model->block2_box2_select();
					$row1=$result_box1->num_rows();
					//print_r($row1);exit;
					if($row1==""){
						$this->Config_model->insert_block2_box2($name_array1,$category);
					}else{
						$this->Config_model->update_block2_box2($name_array1,$category);
					}
				}
				redirect('admin/configuration/subpage2_setting');
			}
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function upload_block2_box3(){
		if($this->session->userdata('logged_in')){
			$config['upload_path'] = './images/subpage2/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload');
			$this->upload->initialize($config);
			//$this->load->library('upload', $config);
			if ($this->upload->do_upload()){
				$data=$this->upload->data();
				$path=$data['full_path'];
				$name_array1=$data['file_name'];
				
				$configi['image_library'] = 'gd2';
				$configi['source_image']   = $path;
				$configi['maintain_ratio'] = FALSE;
				$configi['width']  = 357;
				$configi['height'] =291;
			 
				$this->load->library('image_lib');
				$this->image_lib->initialize($configi);
				$category=$this->input->post('categoryid3');
				if($this->image_lib->resize()){
					$result_box1=$this->Config_model->block2_box3_select();
					$row1=$result_box1->num_rows();
					//print_r($row1);exit;
					if($row1==""){
						$this->Config_model->insert_block2_box3($name_array1,$category);
					}else {
						$this->Config_model->update_block2_box3($name_array1,$category);
					}
				}
				redirect('admin/configuration/subpage2_setting');
			}
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function upload_new_image_box1(){
		if($this->session->userdata('logged_in')){
			$config['upload_path'] = './images/subpage/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload');
			$this->upload->initialize($config);
			//$this->load->library('upload', $config);
			if ($this->upload->do_upload()){
				$data=$this->upload->data();
				$path=$data['full_path'];
				$name_array1=$data['file_name'];
				
				$configi['image_library'] = 'gd2';
				$configi['source_image']   = $path;
				$configi['maintain_ratio'] = FALSE;
				$configi['width']  = 517;
				$configi['height'] =296;
			 
				$this->load->library('image_lib');
				$this->image_lib->initialize($configi);
				$category=$this->input->post('categoryid1');
				if($this->image_lib->resize()){
					$result_box1=$this->Config_model->box1_select();
					$row1=$result_box1->num_rows();
					//print_r($row1);exit;
					if($row1==""){
						$this->Config_model->insert_box1($name_array1,$category);
					}else {
						$this->Config_model->update_box1($name_array1,$category);
					}
				}
				redirect('admin/configuration/subpage1_setting');
			}
		}else{
			redirect('admin/super_admin');
		}
	}
	function upload_new_image_box2(){
		if($this->session->userdata('logged_in')){
			$config['upload_path'] = './images/subpage/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload');
			$this->upload->initialize($config);
			//$this->load->library('upload', $config);
			if ($this->upload->do_upload())
			{
				$data=$this->upload->data();
				$path=$data['full_path'];
				$name_array1=$data['file_name'];
				
				$configi['image_library'] = 'gd2';
				$configi['source_image']   = $path;
				$configi['maintain_ratio'] = FALSE;
				$configi['width']  = 666;
				$configi['height'] =296;
			 
				$this->load->library('image_lib');
				$this->image_lib->initialize($configi);
				$category=$this->input->post('categoryid2');
				if($this->image_lib->resize()){
					$result_box1=$this->Config_model->box2_select();
					$row1=$result_box1->num_rows();
					if($row1==""){
						$this->Config_model->insert_box2($name_array1,$category);
					}else{
						$this->Config_model->update_box2($name_array1,$category);
				}
				}
				redirect('admin/configuration/subpage1_setting');
			}
		}else{
			redirect('admin/super_admin');
		}
	}
	function subpage1_setting(){
		if($this->session->userdata('logged_in')){
			$data['image_info']=$this->Config_model->box1_select();
			//$data['box2select']=$this->Config_model->box2_select();
			$this->load->view('admin/subpage1',$data);
		}else{
			redirect('admin/super_admin');
		}
	}
	function subpage2_setting(){
		if($this->session->userdata('logged_in')){
			$data['box1select']=$this->Config_model->block2_box1_select();
			//$data['box2select']=$this->Config_model->block2_box2_select();
			//$data['box3select']=$this->Config_model->block2_box3_select();
			$this->load->view('admin/subpage2',$data);
		}else{
			redirect('admin/super_admin');
		}
	}
	function subpage3_setting(){
		if($this->session->userdata('logged_in')){
			$data['image_info']=$this->Config_model->block3_box1_select();
			$this->load->view('admin/subpage3',$data);
		}else{
			redirect('admin/super_admin');
		}	
	}
	function upload_block3_box1(){
		if($this->session->userdata('logged_in')){
			$config['upload_path'] = './images/subpage3/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload');
			$this->upload->initialize($config);
			//$this->load->library('upload', $config);
			if ($this->upload->do_upload()){
				$data=$this->upload->data();
				$path=$data['full_path'];
				$name_array1=$data['file_name'];
				
				$configi['image_library'] = 'gd2';
				$configi['source_image']   = $path;
				$configi['maintain_ratio'] = FALSE;
				$configi['width']  = 1150;
				$configi['height'] =185;
			 
				$this->load->library('image_lib');
				$this->image_lib->initialize($configi);
				$category=$this->input->post('categoryid1');
				if($this->image_lib->resize()){
					$result_box1=$this->Config_model->block3_box1_select();
					$row1=$result_box1->num_rows();
					if($row1==""){
						$this->Config_model->insert_block3_box1($name_array1,$category);
					}else {
						$this->Config_model->update_block3_box1($name_array1,$category);
					}
				}
				redirect('admin/configuration/subpage3_setting');
			}
		}else{
			redirect('admin/super_admin');
		}
	}
	
	
	
	
	// NEW
	function upload_slider_tmp_image(){
		if($this->session->userdata('logged_in')){
			$this->db->cache_delete('default', 'index');
			if(isset($_FILES["userfile"])){
				$config['upload_path'] = './images/slider/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->load->library('upload');
				$this->upload->initialize($config);
				
				if ($this->upload->do_upload()){
					$data=$this->upload->data();
					$path=$data['full_path'];
					$name_array1=$data['file_name'];
					$ret= $name_array1;
					
					$configi['image_library'] = 'gd2';
					$configi['source_image']   = $path;
					$configi['maintain_ratio'] = FALSE;
					$configi['width']  = 1218;
					$configi['height'] = 413;
					
					$this->load->library('image_lib');
					$this->image_lib->initialize($configi);
					if($this->image_lib->resize()){
						$name_array1=$data['file_name'];
						$this->Config_model->insert_slider_tmp_img($name_array1);
						echo json_encode($ret);
					}
				}
			}
		}else{
			redirect('admin/super_admin');
		}
	}
	function delete_slider_tmp_image(){
		$output_dir = "./images/slider/";
		$fileName =$_POST['name'];
		$filePath = $output_dir. $fileName;
		if (file_exists($filePath)){
			unlink($filePath);
		}
		$this->Config_model->delete_slider_tmp_img($fileName);
		/*if(isset($_POST["op"]) && $_POST["op"] == "delete" && isset($_POST['name'])){
			$fileName =$_POST['name'];
			$fileName=str_replace("..",".",$fileName); //required. if somebody is trying parent folder files	
			$filePath = $output_dir. $fileName;
			if (file_exists($filePath)){
				unlink($filePath);
			}
			
			//delete file from temp_product_img table//
			$this->Config_model->delete_slider_tmp_img($fileName);
			echo "Deleted File ".$fileName."<br>";
		}*/
	}
	function update_slider(){
		if($this->session->userdata('logged_in')){
			$result = $this->Config_model->update_slider_image();
			if($result == true){
				redirect('admin/configuration/image_upload');
			}
		}else{
			redirect('admin/super_admin');
		}
	}
	
	function upload_tmp_box1_image(){
		if($this->session->userdata('logged_in')){
			$this->db->cache_delete('default', 'index');
			if(isset($_FILES["userfile"])){
				$config['upload_path'] = './images/subpage/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->load->library('upload');
				$this->upload->initialize($config);
				
				if ($this->upload->do_upload()){
					$data=$this->upload->data();
					$path=$data['full_path'];
					$name_array1=$data['file_name'];
					$ret= $name_array1;
					
					$configi['image_library'] = 'gd2';
					$configi['source_image']   = $path;
					$configi['maintain_ratio'] = FALSE;
					$configi['width']  = 595;
					$configi['height'] = 300;
					
					$this->load->library('image_lib');
					$this->image_lib->initialize($configi);
					if($this->image_lib->resize()){
						$name_array1=$data['file_name'];
						$this->Config_model->insert_box1_tmp_img($name_array1);
						echo json_encode($ret);
					}
				}
			}
		}else{
			redirect('admin/super_admin');
		}
	}
	function delete_tmp_box1_image(){
		$output_dir = "./images/subpage/";
		$fileName =$_POST['name'];
		$filePath = $output_dir. $fileName;
		if (file_exists($filePath)){
			unlink($filePath);
		}
		$this->Config_model->delete_box1_tmp_img($fileName);		
	}
	function update_box1_image(){
		if($this->session->userdata('logged_in')){
			$result = $this->Config_model->update_box1_image_image();
			if($result == true){
				redirect('admin/configuration/subpage1_setting');
			}
		}else{
			redirect('admin/super_admin');
		}
	}
	
	
	function upload_tmp_box2_image(){
		if($this->session->userdata('logged_in')){
			$this->db->cache_delete('default', 'index');
			if(isset($_FILES["userfile"])){
				$config['upload_path'] = './images/subpage2/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->load->library('upload');
				$this->upload->initialize($config);
				
				if ($this->upload->do_upload()){
					$data=$this->upload->data();
					$path=$data['full_path'];
					$name_array1=$data['file_name'];
					$ret= $name_array1;
					
					$configi['image_library'] = 'gd2';
					$configi['source_image']   = $path;
					$configi['maintain_ratio'] = FALSE;
					$configi['width']  = 357;
					$configi['height'] = 291;
					
					$this->load->library('image_lib');
					$this->image_lib->initialize($configi);
					if($this->image_lib->resize()){
						$name_array1=$data['file_name'];
						$this->Config_model->insert_box2_tmp_img($name_array1);
						echo json_encode($ret);
					}
				}
			}
		}else{
			redirect('admin/super_admin');
		}
	}
	function delete_tmp_box2_image(){
		$output_dir = "./images/subpage2/";
		$fileName = $_POST['name'];
		$filePath = $output_dir. $fileName;
		if (file_exists($filePath)){
			unlink($filePath);
		}
		$this->Config_model->delete_box2_tmp_img($fileName);
	}
	function update_box2_image(){
		if($this->session->userdata('logged_in')){
			$result = $this->Config_model->update_box2_image_image();
			if($result == true){
				redirect('admin/configuration/subpage2_setting');
			}
		}else{
			redirect('admin/super_admin');
		}	
	}
	
	
	function upload_tmp_box3_image(){
		if($this->session->userdata('logged_in')){
			$this->db->cache_delete('default', 'index');
			if(isset($_FILES["userfile"])){
				$config['upload_path'] = './images/subpage3/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->load->library('upload');
				$this->upload->initialize($config);
				
				if ($this->upload->do_upload()){
					$data=$this->upload->data();
					$path=$data['full_path'];
					$name_array1=$data['file_name'];
					$ret = $name_array1;
					
					$configi['image_library'] = 'gd2';
					$configi['source_image']   = $path;
					$configi['maintain_ratio'] = FALSE;
					$configi['width']  = 1150;
					$configi['height'] = 185;
					
					$this->load->library('image_lib');
					$this->image_lib->initialize($configi);
					if($this->image_lib->resize()){
						$name_array1=$data['file_name'];
						$this->Config_model->insert_box3_tmp_img($name_array1);
						echo json_encode($ret);
					}
				}
			}
		}else{
			redirect('admin/super_admin');
		}	
	}
	function delete_tmp_box3_image(){
		$output_dir = "./images/subpage3/";
		$fileName = $_POST['name'];
		$filePath = $output_dir. $fileName;
		if (file_exists($filePath)){
			unlink($filePath);
		}
		$this->Config_model->delete_box3_tmp_img($fileName);
	}
	function update_box3_image(){
		if($this->session->userdata('logged_in')){
			$result = $this->Config_model->update_box3_image_image();
			if($result == true){
				redirect('admin/configuration/subpage3_setting');
			}
		}else{
			redirect('admin/super_admin');
		}
	}
	
}


?>