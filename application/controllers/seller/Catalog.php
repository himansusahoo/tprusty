<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Catalog extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
        $this->load->helper('string');
        $this->load->library('form_validation');
        $this->load->library('email');
        
        $this->load->library('upload');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->library('pagination');
        
        $this->load->model('seller/Catalog_model');
        $this->load->model('seller/Seller_model');
    }

    public function index() {
        if ($this->session->userdata('seller-session')) {
            $this->load->view('seller/add_product');
        } else {
            redirect('seller/seller');
        };
    }

    function add_new_product() {
        if ($this->session->userdata('seller-session')) {
            $data['attribute'] = $this->Catalog_model->getAttributes();
            //$data['tax_classes'] = $this->Catalog_model->getTaxClasses();
            $data['categories'] = $this->Catalog_model->getCategories();
            $this->load->view('seller/add_new_product', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function save_new_product() {
        if ($this->session->userdata('seller-session')) {
            /* $files = $_FILES;    
              $cpt = count($_FILES['userfile']['name']);

              for($i=0; $i<=$cpt-1; $i++){
              $_FILES['userfile']['name']= rand(0, 1000).'_'.$files['userfile']['name'][$i];
              $_FILES['userfile']['type']= $files['userfile']['type'][$i];
              $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
              $_FILES['userfile']['error']= $files['userfile']['error'][$i];
              $_FILES['userfile']['size']= $files['userfile']['size'][$i];

              $arr_image[$i] = $_FILES['userfile']['name'];
              $arr_image[$i] = str_replace(' ', '_', $arr_image[$i]);

              $config['upload_path'] = './images/product_img/';
              $config['allowed_types'] = 'gif|jpg|jpeg|png';
              //$config['max_size']    = '2000';
              //$config['max_width']   = '1024';
              //$config['max_height']  = '1350';

              $this->load->library('upload');
              $this->upload->initialize($config);

              if ( ! $this->upload->do_upload()){
              $error = array('error' => $this->upload->display_errors());
              $this->load->view('seller/add_new_product', $error);
              }else{
              $data = array('upload_data' => $this->upload->data());
              $path = $data['upload_data']['full_path'];
              $width = $data['upload_data']['image_width'];
              $height = $data['upload_data']['image_height'];

              if($width > $height){
              $configi['image_library'] = 'gd2';
              $configi['source_image']   = $path;
              $config['maintain_ratio'] = TRUE;
              $configi['width']  = 500;
              $configi['height'] = 500;
              $config['master_dim'] = 'width';
              //$config['master_dim'] = 'height';
              }else{
              $configi['image_library'] = 'gd2';
              $configi['source_image']   = $path;
              $config['maintain_ratio'] = TRUE;
              $configi['width']  = 500;
              $configi['height'] = 500;
              //$config['master_dim'] = 'width';
              $config['master_dim'] = 'height';
              }

              $this->load->library('image_lib');
              $this->image_lib->clear();
              $this->image_lib->initialize($configi);
              $success_resize = $this->image_lib->resize();
              }
              } */
            /* if($success_resize){ */
            $seller_id = $this->session->userdata('seller-session');
            $insert_result = $this->Catalog_model->insert_new_product($seller_id);
            if ($insert_result == true) {
                redirect('seller/catalog/new_product_list');
            } else {
                $this->load->view('seller/add_new_product');
            }
            /* }else{
              $this->load->view('seller/add_new_product');
              } */
        } else {
            redirect('seller/seller');
        }
    }

    /* function set_upload_options(){
      //upload an image options
      $config = array();
      $config['upload_path'] = './images/product_img/';
      $config['allowed_types'] = 'gif|jpg|jpeg|png';
      $config['max_size']	= '2048';
      $config['overwrite'] = FALSE;
      return $config;
      } */

    function upload_product_tmp_image() {
        //$output_dir = "./images/product_img/";
        if (isset($_FILES["userfile"])) {
            $ret = array();

            //	This is for custom errors;	
            /* 	$custom_error= array();
              $custom_error['jquery-upload-file-error']="File already exists";
              echo json_encode($custom_error);
              die();
             */
            $error = $_FILES["userfile"]["error"];
            //You need to handle  both cases
            //If Any browser does not support serializing of multiple files using FormData() 
            if (!is_array($_FILES["userfile"]["name"])) { //single file
                /* $fileName = $_FILES["userfile"]["name"];
                  move_uploaded_file($_FILES["userfile"]["tmp_name"],$output_dir.$fileName);
                  $ret[]= $fileName; */
                $fileName = $_FILES["userfile"]["name"];
                $_FILES['userfile']['type'];
                $_FILES['userfile']['tmp_name'];
                $_FILES['userfile']['error'];
                $_FILES['userfile']['size'];

                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = './images/product_img/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $this->load->library('upload');
                $this->upload->initialize($config);
                $ret[] = $fileName;

                if (!$this->upload->do_upload()) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('seller/add_new_product', $error);
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $path = $data['upload_data']['full_path'];
                    $width = $data['upload_data']['image_width'];
                    $height = $data['upload_data']['image_height'];

                    if ($width > $height) {
                        $configi['image_library'] = 'gd2';
                        $configi['source_image'] = $path;
                        $config['maintain_ratio'] = TRUE;
                        $configi['width'] = 500;
                        $configi['height'] = 500;
                        $config['master_dim'] = 'width';
                        //$config['master_dim'] = 'height';
                    } else {
                        $configi['image_library'] = 'gd2';
                        $configi['source_image'] = $path;
                        $config['maintain_ratio'] = TRUE;
                        $configi['width'] = 500;
                        $configi['height'] = 500;
                        //$config['master_dim'] = 'width';
                        $config['master_dim'] = 'height';
                    }

                    $this->load->library('image_lib');
                    $this->image_lib->initialize($configi);
                    $success_resize = $this->image_lib->resize();
                    $this->image_lib->clear();

                    if ($success_resize) {
                        /* Second size */
                        if ($width > $height) {
                            $configi2['image_library'] = 'gd2';
                            $configi2['source_image'] = $path;
                            $config['maintain_ratio'] = TRUE;
                            $configi2['width'] = 190;
                            $configi2['height'] = 190;
                            $configi2['master_dim'] = 'width';
                            $configi2['new_image'] = 'catalog_' . $data['upload_data']['file_name'];
                        } else {
                            $configi2['image_library'] = 'gd2';
                            $configi2['source_image'] = $path;
                            $config['maintain_ratio'] = TRUE;
                            $configi2['width'] = 190;
                            $configi2['height'] = 190;
                            //$config['master_dim'] = 'width';
                            $configi2['master_dim'] = 'height';
                            $configi2['new_image'] = 'catalog_' . $data['upload_data']['file_name'];
                        }

                        $this->load->library('image_lib');
                        $this->image_lib->initialize($configi2);
                        $success_resize = $this->image_lib->resize();
                        $this->image_lib->clear();
                    }

                    $name_array[] = $data['upload_data']['file_name'];
                }
            } else {  //Multiple files, file[]
                $fileCount = count($_FILES["userfile"]["name"]);
                for ($s = 0; $s < $fileCount; $s++) {
                    /* $fileName = $_FILES["userfile"]["name"][$i];
                      move_uploaded_file($_FILES["userfile"]["tmp_name"][$i],$output_dir.$fileName);
                      $ret[]= $fileName; */

                    $fileName = $_FILES['userfile']['name'][$s];
                    $_FILES['userfile']['type'][$s];
                    $_FILES['userfile']['tmp_name'][$s];
                    $_FILES['userfile']['error'][$s];
                    $_FILES['userfile']['size'][$s];

                    $config['encrypt_name'] = TRUE;
                    $config['upload_path'] = './images/product_img/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    $ret[] = $fileName;

                    if (!$this->upload->do_upload()) {
                        $error = array('error' => $this->upload->display_errors());
                        $this->load->view('seller/add_new_product', $error);
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $path = $data['upload_data']['full_path'];
                        $width = $data['upload_data']['image_width'];
                        $height = $data['upload_data']['image_height'];

                        if ($width > $height) {
                            $configi['image_library'] = 'gd2';
                            $configi['source_image'] = $path;
                            $config['maintain_ratio'] = TRUE;
                            $configi['width'] = 500;
                            $configi['height'] = 500;
                            $config['master_dim'] = 'width';
                            //$config['master_dim'] = 'height'; 
                        } else {
                            $configi['image_library'] = 'gd2';
                            $configi['source_image'] = $path;
                            $config['maintain_ratio'] = TRUE;
                            $configi['width'] = 500;
                            $configi['height'] = 500;
                            //$config['master_dim'] = 'width';
                            $config['master_dim'] = 'height';
                        }

                        $this->load->library('image_lib');
                        $this->image_lib->initialize($configi);
                        $success_resize = $this->image_lib->resize();
                        $this->image_lib->clear();
                        if ($success_resize) {
                            if ($s == 0) {
                                /* Second size */
                                if ($width > $height) {
                                    $configi2['image_library'] = 'gd2';
                                    $configi2['source_image'] = $path;
                                    $config['maintain_ratio'] = TRUE;
                                    $configi2['width'] = 190;
                                    $configi2['height'] = 190;
                                    $configi2['master_dim'] = 'width';
                                    $configi2['new_image'] = 'catalog_' . $data['upload_data']['file_name'];
                                } else {
                                    $configi2['image_library'] = 'gd2';
                                    $configi2['source_image'] = $path;
                                    $config['maintain_ratio'] = TRUE;
                                    $configi2['width'] = 190;
                                    $configi2['height'] = 190;
                                    //$config['master_dim'] = 'width';
                                    $configi2['master_dim'] = 'height';
                                    $configi2['new_image'] = 'catalog_' . $data['upload_data']['file_name'];
                                }
                                $this->load->library('image_lib');
                                $this->image_lib->initialize($configi2);
                                $success_resize = $this->image_lib->resize();
                                $this->image_lib->clear();
                            }
                        }
                    }
                    $name_array[] = $data['upload_data']['file_name'];
                }
            }
            $this->Catalog_model->insert_product_tmp_img($name_array);
            echo json_encode($name_array);
        }
    }

    function delete_product_tmp_image() {
        $output_dir = "./images/product_img/";
        if (isset($_POST["op"]) && $_POST["op"] == "delete" && isset($_POST['name'])) {
            $fileName = $_POST['name'];
            $fileName = str_replace("..", ".", $fileName); //required. if somebody is trying parent folder files	
            $filePath = $output_dir . $fileName;
            $thumb_filePath = $output_dir . 'catalog_' . $fileName;
            if (file_exists($filePath)) {
                unlink($filePath);
                unlink($thumb_filePath);
            }
            //delete file from temp_product_img table//
            $this->Catalog_model->delete_product_tmp_img($fileName);
            echo "Deleted File " . $fileName . "<br>";
        }
    }

    // Existing Product
    function search_existing_product() {
        if ($this->session->userdata('seller-session')) {
            $search_tittle = $this->input->post('search_title'); //urldecode($this->uri->segment(4));
            $data['search_result'] = $this->Catalog_model->search_existing_product_list($search_tittle);
            $this->load->view('seller/search_existing_product_list', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function add_existing_product() {
        if ($this->session->userdata('seller-session')) {

            $data = array(
                'master_product_id' => urldecode($this->uri->segment(4)),
                    //'seller_id' => $this->uri->segment(5),
            );
            $skuid = urldecode($this->uri->segment(5));
            $prod_id = urldecode($this->uri->segment(4));

            $data['tax_classes'] = $this->Catalog_model->getTaxClasses();
            $data['exist_product_info'] = $this->Catalog_model->getExistProductInfo($data);

            // product attribute access start by ssantanu dt:21-09-2016
            $data['exist_product_attrbinfo'] = $this->Catalog_model->getExistProductattributeInfo($prod_id, $skuid);
            if (count($data['exist_product_attrbinfo']) == 0) {
                $data['exist_product_attrbinfo'] = '';
            }


            $this->load->model('seller/Attribute_model');
            $data['color_result'] = $this->Attribute_model->retrieve_colors();
            $data['size_result'] = $this->Attribute_model->retrieve_size();
            $data['sub_size_result'] = $this->Attribute_model->retrieve_sub_size();
            // product attribute access start by ssantanu dt:21-09-2016

            $this->load->view('seller/add_existing_product_form', $data);
        } else {
            redirect('seller/seller');
        }
    }

    /* function add_existing_product(){
      if($this->session->userdata('seller-session')){
      $data = array(
      'master_product_id' => urldecode($this->uri->segment(4)),
      );
      $data['tax_classes'] = $this->Catalog_model->getTaxClasses();
      $data['exist_product_info'] = $this->Catalog_model->getExistProductInfo($data);
      $this->load->view('seller/add_existing_product_form', $data);
      }else{
      redirect('seller/seller');
      }
      } */

    function check_sku() {
        $sku = $this->input->post('sku');
        $data1 = $this->Catalog_model->getProductMastersku($sku);
        $data2 = $this->Catalog_model->getSellerGeneralsku($sku);
        $data3 = $this->Catalog_model->getSellerMastersku($sku);
        if ($data1 == false && $data2 == false && $data3 == false) {
            echo 'avail';
        } else {
            echo 'exist';
        }
    }

    function save_exist_new_product() {
        if ($this->session->userdata('seller-session')) {
            $exist_product_result = $this->Catalog_model->insert_existing_product();
            redirect('seller/catalog/exist_product_list');
        } else {
            redirect('seller/seller');
        }
    }

    function update_exist_new_product() {
        if ($this->session->userdata('seller-session')) {
            $result = $this->Catalog_model->update_existing_product();

            $master_prcdt_id = $this->input->post('master_prcdt_id');
            $sku = $this->input->post('sku');

            $this->load->model('Cornjob_productinsermodel');
            //$this->Cornjob_productinsermodel->update_cornjob_singleproduct_info($master_prcdt_id,$sku);
            $this->Cornjob_productinsermodel->update_cornjob_singleproduct_datainfo($master_prcdt_id, $sku);

            //if($result == true){
//				echo "success";
//			}else{
//				echo "fail";
//			}
        } else {
            redirect('seller/seller');
        }
    }

    function update_new_product() {
        if ($this->session->userdata('seller-session')) {
            $result = $this->Catalog_model->update_new_product();

            $master_product_id = $this->input->post('master_product_id');
            $sku = $this->input->post('sku');
            if ($master_product_id) {
                $this->load->model('Cornjob_productinsermodel');
                //$this->Cornjob_productinsermodel->update_cornjob_singleproduct_info($master_product_id,$sku);
                $this->Cornjob_productinsermodel->update_cornjob_singleproduct_datainfo($master_product_id, $sku);
            }
            //if($result == true){
//				echo "success";exit;
//			}else{
//				echo "fail";exit;
//			}
        } else {
            redirect('seller/seller');
        }
    }

    function filter_exist_product_status() {
        if ($this->session->userdata('seller-session')) {
            $seller_id = $this->session->userdata('seller-session');
            $result = $this->Catalog_model->filter_exist_product_status($seller_id);
            if ($result) {
                $data['filtered_data'] = $result;
                $this->load->view('seller/filtered_exist_product_list', $data);
            }
        } else {
            redirect('seller/seller');
        }
    }

    function filter_new_product_status() {
        if ($this->session->userdata('seller-session')) {
            $seller_id = $this->session->userdata('seller-session');
            $result = $this->Catalog_model->filter_new_product_status($seller_id);
            if ($result) {
                $data['filtered_data'] = $result;
                $this->load->view('seller/filtered_new_product_list', $data);
            }
        } else {
            redirect('seller/seller');
        }
    }

    function new_product_list() {
        if ($this->session->userdata('seller-session')) {
            $seller_id = $this->session->userdata('seller-session');
            $config = array();
            $config["base_url"] = base_url() . "seller/catalog/new_product_list";
            $config["total_rows"] = $this->Catalog_model->seller_new_product_count($seller_id);
            $config["per_page"] = 30;
            $config["uri_segment"] = 3;
            //$config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];
            //print_r(round($choice));exit;
            //$config["num_links"] = round($choice);
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';

            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

            $data['product_details'] = $this->Catalog_model->getProductDetails($config["per_page"], $page, $seller_id);
            $data['links'] = $this->pagination->create_links();

            //$data['product_details'] = $this->Catalog_model->getProductDetails($seller_id);
            //program start for getting settlement value//
            $data['fixed_charge_result'] = $this->Catalog_model->getFixedCharges();
            $data['pg_charge_result'] = $this->Catalog_model->getPgCharges();
            $data['seasonal_charge_result'] = $this->Catalog_model->getSeasonalCharges();
            //$data['commission_result'] =  $this->Catalog_model->getCommissionCharges();
            /* $data['special_cmsn_result'] =  $this->Catalog_model->getSpecialCommissionCharges();
              $data['membship_cmsn_result'] =  $this->Catalog_model->getMembrspCommissionCharges();
              $data['global_cmsn_result'] =  $this->Catalog_model->getGlobalCommissionCharges(); */
            $data['service_tax_res'] = $this->Catalog_model->getServiceTax();
            //program end of getting settlement value//
            $this->load->view('seller/new_product_list', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function search_nw_prdt_list_slr() {
        if ($this->session->userdata('seller-session')) {
            $seller_id = $this->session->userdata('seller-session');

            /* $search_title = $this->input->post('search_title');
              if (preg_match('/[\'^ \" ]/', $search_title))
              {
              $search_title1=preg_replace('#"#',' ',preg_replace("/'/",' ',preg_replace('#/#',' ',$search_title)));
              $search_title=substr($search_title1,0,strpos($search_title1,' '));
              }
              $data['search_title'] = $search_title; */

            $data['search_title'] = $_REQUEST['search_title'];

            $config = array();
            $config["base_url"] = base_url() . "seller/catalog/search_nw_prdt_list_slr";
            $config["total_rows"] = $this->Catalog_model->serch_seller_new_product_count($seller_id);
            $config["per_page"] = 30;
            $config["uri_segment"] = 3;
            //$config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;
            $config['enable_query_strings'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];
            //print_r(round($choice));exit;
            //$config["num_links"] = round($choice);
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['suffix'] = '&search_title=' . $data['search_title'];

            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

            $data['product_details'] = $this->Catalog_model->getProductDetails_serch_nw_prdt($config["per_page"], $page, $seller_id);
            $data['links'] = $this->pagination->create_links();

            //program start for getting settlement value//
            $data['fixed_charge_result'] = $this->Catalog_model->getFixedCharges();
            $data['pg_charge_result'] = $this->Catalog_model->getPgCharges();
            $data['seasonal_charge_result'] = $this->Catalog_model->getSeasonalCharges();
            $data['service_tax_res'] = $this->Catalog_model->getServiceTax();
            //program end of getting settlement value//
            $this->load->view('seller/new_product_list', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function retrieve_commission() {
        $data['cmsn_result'] = $this->Catalog_model->getCommission();
    }

    function exist_product_list() {
        if ($this->session->userdata('seller-session')) {
            $seller_id = $this->session->userdata('seller-session');
            $config = array();
            $config["base_url"] = base_url() . "seller/catalog/exist_product_list";
            $config["total_rows"] = $this->Catalog_model->seller_exiting_product_count($seller_id);
            $config["per_page"] = 30;
            $config["uri_segment"] = 3;
            //$config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;
            $config['enable_query_strings'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];
            //print_r(round($choice));exit;
            //$config["num_links"] = round($choice);
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';

            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

            $data['exist_newProduct_list'] = $this->Catalog_model->getExistNewProductDetails($config["per_page"], $page, $seller_id);
            $data['links'] = $this->pagination->create_links();

            $data['fixed_charge_result'] = $this->Catalog_model->getFixedCharges();
            $data['pg_charge_result'] = $this->Catalog_model->getPgCharges();
            $data['seasonal_charge_result'] = $this->Catalog_model->getSeasonalCharges();
            $data['service_tax_res'] = $this->Catalog_model->getServiceTax();
            //$data['exist_newProduct_list'] = $this->Catalog_model->getExistNewProductDetails($seller_id);
            $this->load->view('seller/exist_product_list', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function search_exits_prdt_list_slr() {
        if ($this->session->userdata('seller-session')) {
            $data['search_title'] = $_REQUEST['search_title'];

            $seller_id = $this->session->userdata('seller-session');
            $config = array();
            $config["base_url"] = base_url() . "seller/catalog/search_exits_prdt_list_slr";
            $config["total_rows"] = $this->Catalog_model->serch_seller_exiting_product_count($seller_id);
            $config["per_page"] = 30;
            $config["uri_segment"] = 3;
            //$config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;
            $config['enable_query_strings'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];
            //print_r(round($choice));exit;
            //$config["num_links"] = round($choice);
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['suffix'] = '&search_title=' . $data['search_title'];

            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

            $data['exist_newProduct_list'] = $this->Catalog_model->getExistNewProductDetails_serch($config["per_page"], $page, $seller_id);
            $data['links'] = $this->pagination->create_links();

            $data['fixed_charge_result'] = $this->Catalog_model->getFixedCharges();
            $data['pg_charge_result'] = $this->Catalog_model->getPgCharges();
            $data['seasonal_charge_result'] = $this->Catalog_model->getSeasonalCharges();
            $data['service_tax_res'] = $this->Catalog_model->getServiceTax();
            //$data['exist_newProduct_list'] = $this->Catalog_model->getExistNewProductDetails($seller_id);
            $this->load->view('seller/exist_product_list', $data);
        } else {
            redirect('seller/seller');
        }
    }

    /* function shipment_setting(){
      if($this->session->userdata('seller-session')){
      $this->load->view('seller/product_shipping_fee_form');
      }else{
      redirect('seller/seller');
      }
      } */

    function exist_approved_products_list() {
        if ($this->session->userdata('seller-session')) {
            //if($this->session->userdata['seller-session']['email']){
            $seller_id = $this->session->userdata('seller-session');
            $data['exist_approved_products'] = $this->Catalog_model->getExitApprovedProducts($seller_id);
            $this->load->view('seller/exit_product_approval', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function new_approved_products_list() {
        if ($this->session->userdata('seller-session')) {
            $seller_id = $this->session->userdata('seller-session');
            $data['new_approved_products'] = $this->Catalog_model->getNewApprovedProducts($seller_id);
            $this->load->view('seller/new_product_approval', $data);
        } else {
            redirect('seller/seller');
        }
    }

}

?>