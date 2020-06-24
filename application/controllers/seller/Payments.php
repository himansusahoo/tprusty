<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
        $this->load->helper('string');
        $this->load->library('form_validation');
        $this->load->library('email');
        
        $this->load->library('upload');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        
        $this->load->model('seller/Payment_model');
        $this->load->helper('file');
    }

    function index() {
        if ($this->session->userdata('seller-session')) {
            $data['settelment_data'] = $this->Payment_model->retrieve_slr_payoutdata();
            $this->load->view('seller/settlements', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function settelment_pdfgen() {
        if ($this->session->userdata('seller-session')) {
            $data['settelment_data'] = $this->Payment_model->retrieve_slr_payoutdata();
            $html = $this->load->view('seller/settlements_pdfgen', $data, true);
            $this->load->helper(array('dompdf/dompdf_helper', 'file'));
            pdf_create($html, 'settlements_pdfgen');
        } else {
            redirect('seller/seller');
        }
    }

    function statements() {
        if ($this->session->userdata('seller-session')) {
            $data['statement_data'] = $this->Payment_model->getStetmentData();
            $this->load->view('seller/statements', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function statements_pdfgen() {
        if ($this->session->userdata('seller-session')) {
            $data['statement_data'] = $this->Payment_model->getStetmentData();
            $html = $this->load->view('seller/statements_pdf', $data, true);
            $this->load->helper(array('dompdf/dompdf_helper', 'file'));
            pdf_create($html, 'statements_pdf');
        } else {
            redirect('seller/seller');
        }
    }

    function daterengestatements() {
        if ($this->session->userdata('seller-session')) {
            $data['statement_data'] = $this->Payment_model->getStetmentData_inndaterange();
            $this->load->view('seller/statements', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function single_statement() {
        if ($this->session->userdata('seller-session')) {
            $ref_no = base64_decode($this->uri->segment(4));
            $ref_no = $this->encrypt->decode($ref_no);
            $data['statement_data'] = $this->Payment_model->getIndvisualStetmentData($ref_no);
            $this->load->view('seller/statements', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function getStatementDetailsByDate() {
        if ($this->session->userdata('seller-session')) {
            $data['searched_statement'] = $this->Payment_model->getStatementDetailsByDate();
        } else {
            redirect('seller/seller');
        }
    }

    function getStatementDetailsByUTR() {
        if ($this->session->userdata('seller-session')) {
            $data['searched_statement'] = $this->Payment_model->getStatementDetailsByUTR();
        } else {
            redirect('seller/seller');
        }
    }

    function invoices() {
        if ($this->session->userdata('seller-session')) {
            $this->load->view('seller/invoices');
        } else {
            redirect('seller/seller');
        }
    }

    function rewards() {
        if ($this->session->userdata('seller-session')) {
            $this->load->view('seller/rewards');
        } else {
            redirect('seller/seller');
        }
    }

    function ledger_node() {
        if ($this->session->userdata('seller-session')) {
            $data['result'] = $this->Payment_model->retrieve_slr_ledger_data();
            $this->load->view('seller/ledger_node', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function ledger_daterange() {
        if ($this->session->userdata('seller-session')) {
            $data['result'] = $this->Payment_model->retrieve_slr_ledger_data_btndates();
            $this->load->view('seller/ledger_node', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function transactions() {
        if ($this->session->userdata('seller-session')) {
            $data['result'] = $this->Payment_model->getTransactionDetails();
            $this->load->view('seller/transaction', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function searchTransByDates() {
        if ($this->session->userdata('seller-session')) {
            $data['result'] = $this->Payment_model->getTransactionDetails_daterange();
            $this->load->view('seller/transaction', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function unsetteledtransactions() {
        if ($this->session->userdata('seller-session')) {
            $data['result'] = $this->Payment_model->getUnsetteledTransactionDetails();
            $this->load->view('seller/unsetteled_transaction', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function searchUnsetteldTransByDates() {
        if ($this->session->userdata('seller-session')) {
            $data['result'] = $this->Payment_model->getUnsetteledTransactionDetails_daterange();
            $this->load->view('seller/unsetteled_transaction', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function get_slr_wise_payout() {
        $settlment_ref_no = $this->input->post('settl_ref_no');
        $data['slr_payt_result'] = $this->Payment_model->retrieve_slr_wise_payout($settlment_ref_no);
        $this->load->view('seller/order_wise_slr_payout', $data);
    }

}

?>