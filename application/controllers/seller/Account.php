<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('html', 'form', 'url'));
        $this->load->helper('string');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('session');
        $this->load->library('upload');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->database();
        $this->load->model('seller/Seller_model');
    }

    function index() {
        if ($this->session->userdata('seller-session')) {
            $seller_id = $this->session->userdata('seller-session');
            $data['seller_details'] = $this->Seller_model->get_seller_details($seller_id);
            $this->load->view('seller/my_profile', $data);
        } else {
            redirect('seller/seller');
        };
    }

    function change_password() {
        $seller_id = $this->session->userdata('seller-session');
        $result = $this->Seller_model->check_old_password($seller_id);
        if ($result == true) {
            $this->form_validation->set_rules('new_pass', 'Password', 'required|matches[cnf_pass]|md5');
            $this->form_validation->set_rules('cnf_pass', 'Confirm Password', 'required|md5');

            if ($this->form_validation->run() != false) {
                $new_pass = $this->input->post('new_pass');
                $result1 = $this->Seller_model->update_password($seller_id, $new_pass);
                if ($result1 == true) {
                    echo "Password Updated Successfully.";
                }
            } else {
                echo "Password & Confirm Password should be match.";
            }
        } else {
            echo "Incorrect Old Password.";
        }
    }

    function change_PContact() {
        $seller_id = $this->session->userdata('seller-session');
        $result = $this->Seller_model->update_Pcontact($seller_id);
        if ($result == true) {
            echo "success";
            exit;
        } else {
            echo "fail";
            exit;
        }
    }

    function change_bankAC_details() {
        $seller_id = $this->session->userdata('seller-session');
        $result = $this->Seller_model->update_bankDetails($seller_id);
        if ($result == true) {
            echo "success";
            exit;
        } else {
            echo "fail";
            exit;
        }
    }

    function mail_send_change_pmobile() {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');

        /* create random string for OTP start */
        $this->load->helper('string');
        $rand_string = random_string('alnum', 2);
        $otp = $seller_id . $rand_string . rand(10, 999);
        /* create random string for OTP end */

        $to = $email;

        $from = SUPPORT_MAIL;
        $subject = "OTP for changing Seller Primary Contact in " . DOMAIN_NAME;

        $this->email->set_newline("\r\n");
        $this->email->set_mailtype("html");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message("
			<html>
			<head>
				<title> Moonboy Seller Primary Contact Changing. </title>
			</head>
			<body>
				<div style='width:50%; margin:0px auto; padding:40px;  background-color:#f4f4f4; border:10px solid #ef3038;'>
					<p> Dear " . $name . ", </p>
					<p> Greetings from " . ucfirst(DOMAIN_NAME) . " Seller Marketplace! </p>
					<p>As requested your OTP for " . ucfirst(DOMAIN_NAME) . " is:</p>
					<p>OTP: " . $otp . "</p>
					<p>To change primary contact details, Please use the above OTP </p><br/>  <br/>
				   Thanks & regards,<br/>" . ucfirst(DOMAIN_NAME) . " Team <br/>
				</div>
			</body>
		</html>
		");

        date_default_timezone_set('Asia/Calcutta');
        $dt = date('Y-m-d H:i:s');

        $msg = $this->email->message("
			<html>
			<head>
				<title> Moonboy Seller Primary Contact Changing. </title>
			</head>
			<body>
				<div style='width:50%; margin:0px auto; padding:40px;  background-color:#f4f4f4; border:10px solid #ef3038;'>
					<p> Dear " . $name . ", </p>
					<p> Greetings from Moonboy Seller Marketplace! </p>
					<p>As requested your OTP for " . ucfirst(DOMAIN_NAME) . " is:</p>
					<p>OTP: " . $otp . "</p>
					<p>To change primary contact details, Please use the above OTP </p><br/>  <br/>
				   Thanks & regards,<br/>" . ucfirst(DOMAIN_NAME) . " Team <br/>
				</div>
			</body>
		</html>
		");

        if ($this->email->send()) {
            $data = array(
                'email_mobile' => $email,
                'otp' => $otp,
            );
            $email_data = array(
                'to_email_id' => $to,
                'from_email_id' => '$from',
                'date' => $dt,
                'email_sub' => '$subject',
                'email_content' => $msg,
                'email_send_status' => 'Success'
            );
            $result1 = $this->Seller_model->insert_pmobile($data, $email_data);
            echo "yes";
            exit;
        } else {
            $email_data = array(
                'to_email_id' => $to,
                'from_email_id' => '$from',
                'date' => $dt,
                'email_sub' => '$subject',
                'email_content' => $msg,
                'email_send_status' => 'Failure'
            );
            echo "no";
            exit;
            $data = '';
            $result1 = $this->Seller_model->insert_pmobile($data, $email_data);
        }
    }

    function otp_verificationForPcontact() {
        if ($this->session->userdata('seller-session')) {
            //$result = $this->Seller_model->match_pmobile_otp();
            //if($result === true){
            $result1 = $this->Seller_model->update_seller_pmobile1();
            //$result2 = $this->Seller_model->update_seller_pmobile2();
            if ($result1 === true) {
                echo "success";
            } else {
                echo "fail";
            }
        } else {
            redirect('seller/seller');
        }
    }

}

?>