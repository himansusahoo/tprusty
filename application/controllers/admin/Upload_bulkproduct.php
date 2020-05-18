<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_bulkproduct Extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('html', 'form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('session');
        $this->load->library('upload');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->helper('string');
        $this->load->database();
        $this->load->model('admin/Bulkporductupload_model');
    }

    function bulkproductupload_forseller() {
        if ($this->session->userdata('logged_in')) {

            $this->load->model('admin/Seller_model');
            $data['categories'] = $this->Seller_model->getCategories();
            $data['attrbset'] = $this->Bulkporductupload_model->getattributeset();
            $data['seller_id'] = $this->uri->segment(4);



            $this->load->view('admin/upload_bulkproductfor_single_seller', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    /* function upload_prodexcel()
      {
      if($this->session->userdata('logged_in')){

      $config['upload_path'] = './bulkproduct_excel/';
      //$config['allowed_types'] = 'doc|pdf|docx|zip|rar';
      $config['allowed_types'] = 'xls|xlsx';
      $config['max_size'] = '100000';
      $this->load->library('upload');
      $this->upload->initialize($config);
      //$this->load->library('upload', $config);

      if(!$this->upload->do_upload()){
      $this->upload->display_errors();

      }else{
      $data=$this->upload->data();
      $excl_filename = $data['file_name'];

      //$rowsdata=$this->Bulkporductupload_model->validbeforeinsert_bulkupload($excl_filename);

      //if($rowsdata[0]=="0")
      //{
      $this->Bulkporductupload_model->insert_bulkupload($excl_filename);
      $data['rows_status']=$rowsdata;
      $data['excl_filename']=$excl_filename;
      redirect('admin/Upload_bulkproduct/bulkproductupload_forseller');
      //$this->load->view('admin/exceldata_validationstatus_ajax',$data);
      //echo "success";
      //}
      //else if((int)$rowsdata[0]>0 && $rowsdata[0]!="File has expired")
      //					{
      //						//$output_dir = "./bulkproduct_excel/";
      ////						$filePath = $output_dir. $excl_filename;
      ////						unlink($filePath);
      //
      //						$data['rows_status']=$rowsdata;
      //						$data['excl_filename']=$excl_filename;
      //
      //						$this->load->view('admin/exceldata_validationstatus_ajax',$data);
      //					}
      //					if($rowsdata[0]=="File has expired" && $rowsdata[0]!="0")
      //					{
      //						$output_dir = "./bulkproduct_excel/";
      //						$filePath = $output_dir.$excl_filename;
      //						unlink($filePath);
      //						$data['rows_status']=$rowsdata;
      //						$this->load->view('admin/exceldata_validationstatus_ajax',$data);
      //					}

      }

      //echo 'success';exit;
      //redirect('admin/Upload_bulkproduct');
      }else{
      redirect('admin/super_admin');
      }
      } */

    function upload_prodexcel() {
        if ($this->session->userdata('logged_in')) {

            $config['upload_path'] = './bulkproduct_excel/';
            //$config['allowed_types'] = 'doc|pdf|docx|zip|rar';
            $config['allowed_types'] = 'xls';
            $config['max_size'] = '100000';
            $this->load->library('upload');
            $this->upload->initialize($config);
            //$this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $this->upload->display_errors();
            } else {
                $data = $this->upload->data();
                $excl_filename = $data['file_name'];

                //$rowsdata=$this->Bulkporductupload_model->validbeforeinsert_bulkupload($excl_filename);

                $data['insertvalid_staus'] = $this->Bulkporductupload_model->validwithinsert_bulkupload($excl_filename);
                $excelfiluploadid = $data['insertvalid_staus'];
                // $this->Bulkporductupload_model->insert_bulkuploadafterconf($excelfiluploadid); echo "success";exit;

                $file_sts = $data['insertvalid_staus'];

                if ($file_sts == "File has expired") {
                    $output_dir = "./bulkproduct_excel/";
                    $filePath = $output_dir . $excl_filename;
                    unlink($filePath);
                }

                $this->load->view('admin/exceldata_validationstatus_ajax', $data);
            }
        } else {
            redirect('admin/super_admin');
        }
    }

    function manualupload_bulckproduct() {
        $excelfiluploadid = '198';
        $this->Bulkporductupload_model->insert_bulkuploadafterconf($excelfiluploadid);
    }

    function manualupload_bulkproductexcel() {
        $this->Bulkporductupload_model->manual_uploadbulkprodmultiseller();
        //echo "pleae uncomment code to run";exit;
    }

    function upload_afterconfirmprodexcel() {
        $excelfiluploadid = $this->input->post('fileuploadid');
        $conf_status = $this->input->post('confsts');

        if ($conf_status == 'yes') {
            $this->Bulkporductupload_model->insert_bulkuploadafterconf($excelfiluploadid);

            $data['excelupload_statu'] = $excelfiluploadid;
            $this->load->view('admin/successuploadexcel_ajax', $data);
        } else {

            $this->Bulkporductupload_model->delete_bulkuploadaproduct($excelfiluploadid);
            $data['excelupload_statu'] = "cancelled";
            $this->load->view('admin/successuploadexcel_ajax', $data);
        }



        /* //$rowsdata=$this->Bulkporductupload_model->validbeforeinsert_bulkupload($excelfiluploadid);

          if($rowsdata[0]=="0")
          {	if($conf_status=='yes')
          {	$this->Bulkporductupload_model->insert_bulkupload($excl_filename);
          $rowsdata[]='allproductadded';
          $data['rows_status']=$rowsdata;
          }
          else
          {
          $output_dir = "./bulkproduct_excel/";
          $filePath = $output_dir.$excl_filename;
          unlink($filePath);
          //$data['rows_status']=$rowsdata;
          }
          $this->load->view('admin/exceldata_validationstatus_ajax',$data);
          //echo "success";
          }else if($rowsdata[0]>0)
          {
          if($conf_status=='yes')
          {	$this->Bulkporductupload_model->insert_bulkupload($excl_filename);
          $rowsdata[]='confirmedproductadded';
          $data['rows_status']=$rowsdata;
          }
          else
          {
          $output_dir = "./bulkproduct_excel/";
          $filePath = $output_dir.$excl_filename;
          unlink($filePath);
          }


          $this->load->view('admin/exceldata_validationstatus_ajax',$data);
          }
          if($rowsdata[0]=="File has expired")
          {
          $output_dir = "./bulkproduct_excel/";
          $filePath = $output_dir.$excl_filename;
          unlink($filePath);
          $data['rows_status']=$rowsdata;
          $this->load->view('admin/exceldata_validationstatus_ajax',$data);
          } */
    }

    function prod_addstatus() {
        $data['uploadid'] = $this->input->post('fileuploadid');
        $this->load->view('admin/bulkadd_productstatus_ajaxpage', $data);
    }

}

?>