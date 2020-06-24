<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_existing_editedproductexcelfile Extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
        $this->load->library('form_validation');
        //$this->load->library('email');
        
        $this->load->library('upload');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->helper('string');
        $this->load->library('pagination');
        
        //$this->load->model('admin/Bulkporductupload_model');	
        $this->load->model('admin/Upload_existing_editedporductexcelfile_model');
    }

    function upload_extprodexcel() {

        if ($this->session->userdata('logged_in')) {

            //$this->Bulkporductupdate_model->productupdate_process_statusstart();

            $config['upload_path'] = './bulk_existingeditedproductexcel/';
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

                $data['insertvalid_staus'] = $this->Upload_existing_editedporductexcelfile_model->validwithinsert_existingeditedproductbulkupload($excl_filename);

                $excelfiluploadid = $data['insertvalid_staus'];
                // $this->Bulkporductupload_model->insert_bulkuploadafterconf($excelfiluploadid); echo "success";exit;

                $file_sts = $data['insertvalid_staus'];

                if ($file_sts == "File has expired") {
                    $output_dir = "./bulk_existingeditedproductexcel/";
                    $filePath = $output_dir . $excl_filename;
                    unlink($filePath);
                }
                //$this->Bulkporductupdate_model->productupdate_process_statusfinish(); 

                $this->load->view('admin/existing_editedproductdata_validationstatus_ajax', $data);
            }
        } else {
            redirect('admin/super_admin');
        }
    }

    function upload_editedexitingproduct_afterconfirmprodexcel() {

        $excelfiluploadid = $this->input->post('fileuploadid');
        $conf_status = $this->input->post('confsts');



        /* $excelfiluploadid='37';
          $conf_status='yes'; */

        $this->session->set_userdata('prod_uploaduid', $excelfiluploadid);

        if ($conf_status == 'yes') {
            $this->Upload_existing_editedporductexcelfile_model->update_existing_editedprod_bulkuploadafterconf($excelfiluploadid);

            $data['excelupload_statu'] = $excelfiluploadid;
            //$this->load->view('admin/success_exitingprodedituploadexcel_ajax',$data); 

            $this->load->view('admin/success_exitingeditedproduploadexcel_ajax', $data);
        } else {

            $this->Upload_existing_editedporductexcelfile_model->delete_existingproduct_bulkuploada($excelfiluploadid);
            $data['excelupload_statu'] = "cancelled";
            $this->load->view('admin/success_exitingeditedproduploadexcel_ajax', $data);
        }
    }

}

// class end