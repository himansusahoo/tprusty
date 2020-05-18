<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('html', 'form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('session');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->library('upload');
        $this->load->database();
        $this->load->library('pagination');
        $this->load->model('admin/Report_model');
    }

    function index() {
        if ($this->session->userdata('logged_in')) {
            $data['payout_result'] = $this->Report_model->retrievePayoutData();
            $this->load->view('admin/payment_pg', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function update_settelment_discount() {
        $result = $this->Report_model->update_inn_settelment_discount();
        if ($result == true) {
            echo 'success';
        }
    }

    function update_transaction_data() {
        if ($this->input->post()) {
            $selected_trans_id = $this->input->post('payment_id_chk');
            if ($selected_trans_id) {
                if ($this->Report_model->generate_payout($selected_trans_id)) {
                    $this->session->set_flashdata('succ_msg', 'Payout Generated successfully !');
                } else {
                    $this->session->set_flashdata('error_msg', 'Payout Generated failed !');
                }
            }
            redirect('admin/payment');
            //$result = $this->Report_model->insert_ledger_data();
//            $result = $this->Report_model->update_inn_transaction_data();
//
//            if ($result == true) {
//                $this->session->set_flashdata('succ_msg', 'Payout Generated successfully !');
//                redirect('admin/payment');
//            }
        } else {
            echo "Invalid request type";
            exit;
        }
    }

    function download_excel() {
        //$parm = $this->uri->segment(3);
        if ($this->session->userdata('logged_in')) {
            $data['payout_result'] = $this->Report_model->retrievePayoutData();
            $this->load->view('admin/payment_pg', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function seller_payout() {
        if ($this->session->userdata('logged_in')) {
            $data['slr_payout_result'] = $this->Report_model->retrieve_seller_payout();
            $this->load->view('admin/slr_payout_pg', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function seller_all_payout() {



        if ($this->session->userdata('logged_in')) {
            $config = array();
            $config["base_url"] = base_url() . "admin/payment/seller_all_payout";
            $config["total_rows"] = $this->Report_model->retrive_sellerpayout_count();
            $config["per_page"] = 100;
            $config["uri_segment"] = 3;
            $config['page_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $data['slr_payout_result'] = $this->Report_model->retrieve_seller_all_payout($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();
            $end = $page + $this->pagination->per_page;
            $data['start'] = $page;
            $this->load->view('admin/slr_payout_report_pg', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function autofill_slrpayout() {
        $data['autofilldata'] = $this->Report_model->search_slrpayout();
        $this->load->view('admin/autofill_slrpayout', $data);
    }

    function export_slrpayout() {
        $limit = 100;
        $start = $this->uri->segment(4);
        $data['result'] = $this->Report_model->export_slrpayout($limit, $start);
        $this->load->view('admin/export_slrpayout', $data);
    }

    /* function export_onlinepaymentdata()
      {
      $data['result'] = $this->Report_model->select_onlinepaymentdata($limit,$start);
      $this->load->view('admin/exportexcel_onlinepayment_failed',$data);
      } */

    function get_slr_wise_payout() {
        $settlment_ref_no = $this->input->post('settl_ref_no');
        $data['slr_payt_result'] = $this->Report_model->retrieve_slr_wise_payout($settlment_ref_no);
        $this->load->view('admin/order_wise_slr_payout', $data);
    }

    function filter_slrpayout() {
        if ($this->session->userdata('logged_in')) {
            $data['slr_name'] = $_REQUEST['slr_name'];
            $data['slr_id'] = $_REQUEST['slr_id'];
            $data['no_of_reports'] = $_REQUEST['no_of_reports'];
            $data['final_stl_amt'] = $_REQUEST['final_stl_amt'];
            $data['account_no'] = $_REQUEST['account_no'];
            $data['bank_name'] = $_REQUEST['bank_name'];
            $data['ifsc_code'] = $_REQUEST['ifsc_code'];
            $data['acnt_holder'] = $_REQUEST['acnt_holder'];
            $data['utr'] = $_REQUEST['utr'];
            $data['status'] = $_REQUEST['status'];

            $config = array();
            $config["base_url"] = base_url() . "admin/payment/filter_slrpayout";
            $config["total_rows"] = $this->Report_model->select_filter_slrpayout_count();
            $config["per_page"] = 100;
            $config["uri_segment"] = 3;
            $config["page_query_string"] = TRUE;
            $config['enable_query_strings'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];
            //$config["num_links"] = round($choice);
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['suffix'] = '&slr_id=' . $data['slr_id'] . '&slr_name=' . $data['slr_name'] . '&no_of_reports=' . $data['no_of_reports'] . '&final_stl_amt=' . $data['final_stl_amt'] . '&account_no=' . $data['account_no'] . '&bank_name=' . $data['bank_name'] . '&ifsc_code=' . $data['ifsc_code'] . '&acnt_holder=' . $data['acnt_holder'] . '&utr=' . $data['utr'] . '&status=' . $data['status'];

            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

            $data['slr_payout_result'] = $this->Report_model->select_filtered_slrpayout($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();
            $end = $page + $this->pagination->per_page;
            $data['start'] = $page;
            $this->load->view('admin/slr_payout_report_pg', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function seller_payout_datewise() {
        if ($this->session->userdata('logged_in')) {
            $data['slr_payout_result'] = $this->Report_model->retrieve_seller_payout_datewise();
            $this->load->view('admin/slr_payout_pg', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function seller_all_payout_datewise() {
        if ($this->session->userdata('logged_in')) {
            $data['slr_payout_result'] = $this->Report_model->retrieve_seller_all_payout_datewise();
            $this->load->view('admin/slr_payout_report_pg', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function update_utr_no() {
        if ($this->session->userdata('logged_in')) {
            $result = $this->Report_model->update_inn_utr_no();
            if ($result == true) {
                redirect('admin/payment/seller_payout');
            }
        } else {
            redirect('admin/super_admin');
        }
    }

    function payout_excel_report() {
        if ($this->session->userdata('logged_in')) {
            $data['result'] = $this->Report_model->getPayoutExcel();            
            $this->load->view('admin/payout_gen', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function slr_payout_excel_report() {
        if ($this->session->userdata('logged_in')) {
            $data['result'] = $this->Report_model->getSellerPayoutExcel();
            $this->load->view('admin/slr_payout_gen', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function buyer_refund() {
        if ($this->session->userdata('logged_in')) {

            $data_buyerefund['buyer_refund'] = $this->Report_model->get_refundlist();


            $this->load->view('admin/buyer_refundlist', $data_buyerefund);
        } else {
            redirect('admin/super_admin');
        }
    }

    function update_utrno() {
        if ($this->session->userdata('logged_in')) {

            $data_buyerefund['buyer_utrNotUpdatelist'] = $this->Report_model->get_utrList();

            $this->load->view('admin/update_utrno_ofBuyerRefund', $data_buyerefund);
        } else {
            redirect('admin/super_admin');
        }
    }

    function update_utrbuyer_refund() {
        if ($this->session->userdata('logged_in')) {

            $this->Report_model->update_inn_buyerutr_no();

            redirect('admin/Payment/update_utrno');
        } else {
            redirect('admin/super_admin');
        }
    }

    function buyer_payout_datewise() {
        if ($this->session->userdata('logged_in')) {

            $data_buyerefund['buyer_utrNotUpdatelist'] = $this->Report_model->get_utrList_datewise();

            $this->load->view('admin/update_utrno_ofBuyerRefund', $data_buyerefund);
        } else {
            redirect('admin/super_admin');
        }
    }

    function export_to_excel() {
        if ($this->session->userdata('logged_in')) {

            $order_id_arr = explode(',', $this->uri->segment(4));


            $data_buyerefund['buyer_refund'] = $this->Report_model->get_refundlist_forExcel($order_id_arr);
            $this->load->view('admin/buyer_RefundExcelReport', $data_buyerefund);
        } else {
            redirect('admin/super_admin');
        }
    }

    function buyer_wallet() {
        if ($this->session->userdata('logged_in')) {


            $config = array();
            $config["base_url"] = base_url() . "admin/payment/buyer_wallet";
            $config["total_rows"] = $this->Report_model->get_buyer_wallet_count();
            $config["per_page"] = 200;
            $config["uri_segment"] = 3;
            //$config['use_page_numbers'] = TRUE;

            $choice = $config["total_rows"] / $config["per_page"];

            //$config["num_links"] = round($choice);
            $config["num_links"] = 3;
            $config["page_query_string"] = TRUE;
            $config['enable_query_strings'] = TRUE;
            $config['reuse_query_string'] = TRUE;

            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $data_buyewallet['buyer_wallet'] = $this->Report_model->get_buyer_wallet($config["per_page"], $page);


            $data_buyewallet['links'] = $this->pagination->create_links();



            //$data_buyewallet['buyer_wallet'] = $this->Report_model->get_buyer_wallet();
            $this->load->view('admin/buyer_walletlist', $data_buyewallet);
        } else {
            redirect('admin/super_admin');
        }
    }

    function autofill_buyername() {


        $data['autofilldata'] = $this->Report_model->search_buyer_name();
        $this->load->view('admin/autofill_buyer', $data);
    }

    function update_walletamt() {
        if ($this->session->userdata('logged_in')) {

            $debit_check = $this->input->post('chk_debit_amount');
            $debit_check = $this->input->post('chk_debit_amount');
            if ($debit_check == 'debit') {
                $this->Report_model->update_wallet_debit();
            } else {
                $this->Report_model->update_wallet_credit();
            }

            redirect('admin/payment/buyer_wallet');
        } else {
            redirect('admin/super_admin');
        }
    }

    function approve_wallet() {
        if ($this->session->userdata('logged_in')) {

            $wallet_user_id = $this->uri->segment(4);
            $status = 'Approved';
            $this->Report_model->update_wallet_statusapprove($wallet_user_id, $status);

            redirect('admin/payment/buyer_wallet');
        } else {
            redirect('admin/super_admin');
        }
    }

    function disapprove_wallet() {
        if ($this->session->userdata('logged_in')) {

            $wallet_user_id = $this->uri->segment(4);
            $status = 'Not Approved';
            $this->Report_model->update_wallet_statusapprove($wallet_user_id, $status);

            redirect('admin/payment/buyer_wallet');
        } else {
            redirect('admin/super_admin');
        }
    }

    function view_wallet_detail() {
        if ($this->session->userdata('logged_in')) {
            $wallet_user_id = $this->uri->segment(4);
            $walletdeatil_as_userid['wallet_info'] = $this->Report_model->walletdetail_as_user_id($wallet_user_id);
            $walletdeatil_as_userid['purchase_bywallet_info'] = $this->Report_model->purchased_by_wallet($wallet_user_id);

            $this->load->view('admin/buyer_walletdetail', $walletdeatil_as_userid);
        } else {
            redirect('admin/super_admin');
        }
    }

    function buyerwallet_detail() {
        if ($this->session->userdata('logged_in')) {
            $wallet_user_id = $this->uri->segment(4);
            $walletdeatil_as_userid['wallet_info'] = $this->Report_model->walletdetail_as_user_id($wallet_user_id);
            $walletdeatil_as_userid['purchase_bywallet_info'] = $this->Report_model->purchased_by_wallet($wallet_user_id);

            $this->load->view('admin/buyerwallet_detail', $walletdeatil_as_userid);
        } else {
            redirect('admin/super_admin');
        }
    }

    function ledger_node() {
        if ($this->session->userdata('logged_in')) {
            $data['result'] = $this->Report_model->retrieve_admn_ledger_data();
            $this->load->view('admin/adnm_ledger_node', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function ledger_daterange() {
        if ($this->session->userdata('logged_in')) {
            $data['result'] = $this->Report_model->retrieve_admn_ledger_data_btndates();
            $this->load->view('admin/adnm_ledger_node', $data);
        } else {
            redirect('seller/super_admin');
        }
    }

    function update_sku() {
        $this->load->view('admin/update_sku_pg');
    }

    function update_new_sku() {
        $result = $this->Report_model->update_inn_new_sku();
        if ($result == true) {
            $this->session->set_flashdata('ssmsg', 'Update Successful.');
            $this->load->view('admin/update_sku_pg');
        }
    }

    function tax_report() {



        if ($this->session->userdata('logged_in')) {
            $config = array();
            $config["base_url"] = base_url() . "admin/payment/tax_report";
            $config["total_rows"] = $this->Report_model->retrive_taxreport_count();
            $config["per_page"] = 100;
            $config["uri_segment"] = 3;
            $config['page_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $data['tax_report'] = $this->Report_model->retrieve_taxreport($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();
            $this->load->view('admin/tax_report', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function autofill_taxprodnm() {
        $data['autofilldata'] = $this->Report_model->search_taxprodnm();
        $this->load->view('admin/autofill_taxprodnm', $data);
    }

    function autofill_taxseller() {
        $data['autofilldata'] = $this->Report_model->search_taxseller();
        $this->load->view('admin/autofill_taxseller', $data);
    }

    function filter_tax() {
        if ($this->session->userdata('logged_in')) {
            $data['prod_name'] = $_REQUEST['prod_name'];
            $data['seller_name'] = $_REQUEST['seller_name'];
            $data['mrp'] = $_REQUEST['mrp'];
            $data['selling_prc'] = $_REQUEST['selling_prc'];
            $data['spec_prc'] = $_REQUEST['spec_prc'];
            $data['spec_prc_frm_dt'] = $_REQUEST['spec_prc_frm_dt'];
            $data['spec_prc_to_dt'] = $_REQUEST['spec_prc_to_dt'];
            $data['tax'] = $_REQUEST['tax'];

            $config = array();
            $config["base_url"] = base_url() . "admin/payment/filter_tax";
            $config["total_rows"] = $this->Report_model->select_filter_tax_count();
            $config["per_page"] = 100;
            $config["uri_segment"] = 3;
            $config["page_query_string"] = TRUE;
            $config['enable_query_strings'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];
            //$config["num_links"] = round($choice);
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['suffix'] = '&prod_name=' . $data['prod_name'] . '&seller_name=' . $data['seller_name'] . '&mrp=' . $data['mrp'] . '&selling_prc=' . $data['selling_prc'] . '&spec_prc=' . $data['spec_prc'] . '&spec_prc_frm_dt=' . $data['spec_prc_frm_dt'] . '&spec_prc_to_dt=' . $data['spec_prc_to_dt'] . '&tax=' . $data['tax'];

            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

            $data['tax_report'] = $this->Report_model->select_filtered_tax($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();

            $this->load->view('admin/tax_report', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function tax_excel_report() {
        if ($this->session->userdata('logged_in')) {
            $data['result'] = $this->Report_model->excel_tax();
            $this->load->view('admin/excel_taxreport', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function slr_profile_report() {



        if ($this->session->userdata('logged_in')) {
            $config = array();
            $config["base_url"] = base_url() . "admin/payment/slr_profile_report";
            $config["total_rows"] = $this->Report_model->retrive_slrprfl_count();
            $config["per_page"] = 100;
            $config["uri_segment"] = 3;
            $config['page_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $data['slrprfl_report'] = $this->Report_model->retrieve_slrprfl($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();

            $end = $page + $this->pagination->per_page;
            $data['start'] = $page;
            $this->load->view('admin/seller_profile_report', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function autofill_slrprfl() {
        $data['autofilldata'] = $this->Report_model->search_slrprfl();
        $this->load->view('admin/autofill_slrprfl', $data);
    }

    function slrprfl_excel_report() {

        $limit = 100;
        $start = $this->uri->segment(4);
        $data['result'] = $this->Report_model->excel_slrprfl($limit, $start);
        $this->load->view('admin/excel_slrprofile', $data);
    }

    function filter_slrprofile() {
        if ($this->session->userdata('logged_in')) {
            $data['seller'] = $_REQUEST['seller'];
            $data['slr_state'] = $_REQUEST['slr_state'];
            $data['city'] = $_REQUEST['city'];
            $data['slr_email'] = $_REQUEST['slr_email'];
            $data['appr_dt'] = $_REQUEST['appr_dt'];
            $data['status'] = $_REQUEST['status'];
            $data['ac_holder'] = $_REQUEST['ac_holder'];
            $data['ifsc'] = $_REQUEST['ifsc'];
            $data['bank'] = $_REQUEST['bank'];
            $data['branch'] = $_REQUEST['branch'];
            $data['bank_state'] = $_REQUEST['bank_state'];
            $data['pan'] = $_REQUEST['pan'];
            $data['tin'] = $_REQUEST['tin'];
            $data['tan'] = $_REQUEST['tan'];

            $config = array();
            $config["base_url"] = base_url() . "admin/payment/filter_slrprofile";
            $config["total_rows"] = $this->Report_model->select_filter_slrprfl_count();
            $config["per_page"] = 100;
            $config["uri_segment"] = 3;
            $config["page_query_string"] = TRUE;
            $config['enable_query_strings'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];
            //$config["num_links"] = round($choice);
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['suffix'] = '&seller=' . $data['seller'] . '&slr_state=' . $data['slr_state'] . '&city=' . $data['city'] . '&slr_email=' . $data['slr_email'] . '&appr_dt=' . $data['appr_dt'] . '&status=' . $data['status'] . '&ac_holder=' . $data['ac_holder'] . '&ifsc=' . $data['ifsc'] . '&bank=' . $data['bank'] . '&branch=' . $data['branch'] . '&bank_state=' . $data['bank_state'] . '&pan=' . $data['pan'] . '&tin=' . $data['tin'] . '&tan=' . $data['tan'];

            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

            $data['slrprfl_report'] = $this->Report_model->select_filtered_slrprfl($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();
            $end = $page + $this->pagination->per_page;
            $data['start'] = $page;
            $this->load->view('admin/seller_profile_report', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function buyer_profile_report() {



        if ($this->session->userdata('logged_in')) {
            $config = array();
            $config["base_url"] = base_url() . "admin/payment/buyer_profile_report";
            $config["total_rows"] = $this->Report_model->retrive_byrprfl_count();
            $config["per_page"] = 100;
            $config["uri_segment"] = 3;
            $config['page_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            $data['byrprfl_report'] = $this->Report_model->retrieve_byrprfl($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();
            $end = $page + $this->pagination->per_page;
            $data['start'] = $page;
            $this->load->view('admin/buyer_profile_report', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function filter_buyerprofile() {
        if ($this->session->userdata('logged_in')) {
            $data['byrnm'] = $_REQUEST['byrnm'];
            $data['regd_dt'] = $_REQUEST['regd_dt'];
            $data['gender'] = $_REQUEST['gender'];
            $data['mob'] = $_REQUEST['mob'];
            $data['email'] = $_REQUEST['email'];
            $data['country'] = $_REQUEST['country'];
            $data['state'] = $_REQUEST['state'];
            $data['st_address'] = $_REQUEST['st_address'];
            $data['city'] = $_REQUEST['city'];
            //$data['pin'] = $_REQUEST['pin'];
            $data['status'] = $_REQUEST['status'];

            $config = array();
            $config["base_url"] = base_url() . "admin/payment/filter_buyerprofile";
            $config["total_rows"] = $this->Report_model->select_filter_byrprfl_count();
            $config["per_page"] = 100;
            $config["uri_segment"] = 3;
            $config["page_query_string"] = TRUE;
            $config['enable_query_strings'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $choice = $config["total_rows"] / $config["per_page"];
            //$config["num_links"] = round($choice);
            $config["num_links"] = 3;
            $config['cur_tag_open'] = '&nbsp;<a class="current" style="background-color:lightblue;">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $config['suffix'] = '&byrnm=' . $data['byrnm'] . '&regd_dt=' . $data['regd_dt'] . '&gender=' . $data['gender'] . '&mob=' . $data['mob'] . '&email=' . $data['email'] . '&country=' . $data['country'] . '&state=' . $data['state'] . '&st_address=' . $data['st_address'] . '&city=' . $data['city'] . '&status=' . $data['status'];

            $this->pagination->initialize($config);
            $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

            $data['byrprfl_report'] = $this->Report_model->select_filtered_byrprfl($config["per_page"], $page);
            $data['links'] = $this->pagination->create_links();
            $end = $page + $this->pagination->per_page;
            $data['start'] = $page;
            $this->load->view('admin/buyer_profile_report', $data);
        } else {
            redirect('admin/super_admin');
        }
    }

    function buyrprfl_excel_report() {
        $limit = 100;
        $start = $this->uri->segment(4);
        $data['result'] = $this->Report_model->excel_buyrprfl($limit, $start);
        $this->load->view('admin/excel_buyer_report', $data);
    }

}

?>