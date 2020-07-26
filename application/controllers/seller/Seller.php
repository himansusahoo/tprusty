<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Seller extends MX_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('string');
        $this->load->library('form_validation');
        $this->load->library('email');

        $this->load->library('upload');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->library('pagination');

        $this->load->model('seller/Seller_model');
        $this->load->model('Product_descrp_model');
        $this->load->helper('date');
    }

    public function index() {
        $this->load->view('seller/signup');
    }

    function home() {
        if ($this->session->userdata('seller-session')) {
            $this->load->view('seller/home');
        } else {
            redirect('seller/seller');
        }
    }

    function terms_conditions_page() {
        if ($this->session->userdata('seller-session')) {

            $data['tc_data'] = $this->Seller_model->select_SellerTC();
            $this->load->view('seller/terms_conditions_page', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function seller_register() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[seller_account.email]');
        $this->form_validation->set_message('valid_email', 'Please enter valid email.');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|is_unique[seller_account.mobile]|min_length[10]|max_length[10]');
        $this->form_validation->set_message('is_unique', '%s already registered with a seller.');

        if ($this->form_validation->run() != false) {
            $data = array(
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
            );
            $this->load->view('seller/account_creation', $data);
        } else {
            $this->load->view('seller/signup');
        }
    }

    function seller_signup() {
        $password = $this->input->post('pwd');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('pincode', 'Pincode', 'required|numeric');
        $this->form_validation->set_message('numeric', 'Pincode should be numeric character.');
        //$this->form_validation->set_rules('selling_category', 'Selling Category', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('pwd', 'Password', 'required|matches[cnfpwd]|md5');
        $this->form_validation->set_message('matches', 'Password should match with Confirm Password.');
        $this->form_validation->set_rules('cnfpwd', 'Confirm Password', 'required|md5');

        if ($this->form_validation->run() != false) {
            $seller_id = $this->Seller_model->get_unique_id();
            $seller_uidcode = 'MBS';
            $seller_maxid = $this->Seller_model->get_maximaum_id('seller_account', 'seller_uid');
            $dt = date('Y-m-d H:i:s');
            $data = array(
                'seller_id' => $seller_id,
                'seller_uidcode' => $seller_uidcode,
                'seller_uid' => $seller_maxid,
                'name' => trim($this->input->post('name')),
                'email' => trim($this->input->post('email')),
                'password' => trim($this->input->post('pwd')),
                'pincode' => trim($this->input->post('pincode')),
                'seller_address' => trim($this->input->post('address')),
                'seller_city' => trim($this->input->post('city')),
                'seller_state' => trim($this->input->post('state')),
                //'main_selleing_category' => $this->input->post('selling_category'),
                'mobile' => trim($this->input->post('mobile')),
                'approval_date' => $dt,
            );
            //pma($data,1);
            $result = $this->Seller_model->insert_newseller($data);
            if ($result == true) {
                $feedRbacUser = array(
                    'first_name' => $data['name'],
                    'last_name' => $data['name'],
                    'email' => $data['email'],
                    'password' => c_encode($password),
                    'mobile' => $data['mobile'],
                    'user_type' => 'seller',
                    'created_by' => 1, //default set to developer
                    'status' => 'active'
                );

                $manageEmployee = modules::load('employee/manage_employees');
                $manageEmployee->feed_rbac_user($feedRbacUser, 'SELLER');
                $email = $this->input->post('email');
                $result = $this->Seller_model->seller_details($email);
                $sessiondata = $result[0]->seller_id;
                $this->session->set_userdata('seller-session', $sessiondata);
                $this->load->view('seller/verification_ac_details', $data);
            }
        } else {
            $data = array(
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile')
            );
            $this->load->view('seller/account_creation', $data);
        }
    }

    function getResponse($str) {
        $secret_key = "6LcR4w8TAAAAADj1GLz3kBIuWRFrMVWWx9g5fjzk";
        $ip_user = $this->input->ip_address();
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret_key . "&response=" . $str . "&remoteip=" . $ip_user;
        $user_agent = 'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $data = curl_exec($ch);
        curl_close($ch);
        $status = json_decode($data, true);
        if ($status['success']) {
            return true;
        } else {
            $this->session->set_flashdata('recaptcha', 'incorrect captcha');
            return false;
        }
    }

    function seller_login() {
        $data = array(
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $result = $this->Seller_model->seller_login($data);
        if ($result == true) {
            //workaround for rbac module
            $manageEmployee = modules::load('employee/manage_employees');
            $manageEmployee->login_workaround($email, $password);
            
            $email = $this->input->post('email');
            $result = $this->Seller_model->seller_details($email);
            $sessiondata = $result[0]->seller_id;
            $this->session->set_userdata('seller-session', $sessiondata);
            $result1 = $this->Seller_model->seller_details($email);
            if ($result1 != false) {
                $data = array(
                    'name' => $result1[0]->name,
                    'ac_status' => $result1[0]->status,
                );
                $this->session->set_userdata($data);
            }
            // Session declaration to complete signup 
            $seller_id = $this->session->userdata('seller-session');
            $return_value = $this->Seller_model->check_seller_signup($seller_id);
            $this->session->set_userdata('seller-signup-session', $return_value);
            // Seller Notification
            $seller_notice = $this->Seller_model->check_session_seller_notice();
            if ($seller_notice) {
                $this->session->set_userdata('seller-notice-session', $seller_notice);
            }
            // Session declaration to accept T&C
            $data['signin_date'] = $result1[0]->signin_date;
            $result2 = $this->Seller_model->update_signupDateTime($seller_id);
            $this->session->set_flashdata('all_data', $data);

            

            redirect('seller/seller/home');
            //$this->load->view('seller/home', $data);
        } else {
            $data["error"] = "Invalid Username or Password";
            $this->load->view('seller/signup', $data);
        }
    }

    function forgot_password_form() {
        $this->load->view('seller/forgot_password_form');
    }

    function forgot_passord() {
        $data = array(
            'email' => $this->input->post('email'),
        );
        $result = $this->Seller_model->check_seller_email_address($data);
        if ($result != false) {
            $seller_id = $result[0]->seller_id;
            $name = $result[0]->name;
            /* create random string for OTP start */
            $this->load->helper('string');
            $rand_string = random_string('alnum', 2);
            $otp = $seller_id . $rand_string . rand(10, 999);
            $data['name'] = $name;
            $data['otp'] = $otp;
            /* create random string for OTP end */

            $to = $data['email'];

            $from = SUPPORT_MAIL;
            $subject = "OTP for Seller in ".DOMAIN_NAME;

            $this->email->set_newline("\r\n");
            $this->email->set_mailtype("html");
            $this->email->from($from);
            $this->email->to($to);
            $this->email->subject($subject);
            $this->email->message($this->load->view('email_template/otp_seller', $data, true));
            $dt = date('Y-m-d H:i:s');

            $msg = $this->load->view('email_template/otp_seller', $data, true);

            if ($this->email->send()) {
                $retrive_data = array(
                    'seller_id' => $seller_id,
                    'email' => $data['email'],
                    'otp' => $otp,
                );

                $email_data = array(
                    'to_email_id' => $to,
                    'from_email_id' => '$form',
                    'date' => $dt,
                    'email_sub' => '$subject',
                    'email_content' => $msg,
                    'email_send_status' => 'Success'
                );
                $this->session->set_userdata('otp_session_data', $retrive_data);
                $result1 = $this->Seller_model->insert_retrive_password($retrive_data, $email_data);
                $this->load->view('seller/forgot_pass_otp_form');
            } else {
                $email_data = array(
                    'to_email_id' => $to,
                    'from_email_id' => '$form',
                    'date' => $dt,
                    'email_sub' => '$subject',
                    'email_content' => $msg,
                    'email_send_status' => 'failuer'
                );
                $retrive_data = '';
                $result1 = $this->Seller_model->insert_retrive_password($retrive_data, $email_data);
                $this->load->view('seller/forgot_password_form');
            }
        } else {
            $data['resultfalse'] = "Seller doesn't exist with this Email.";
            $this->load->view('seller/forgot_password_form', $data);
        }
    }

    function forgot_pass_otp() {
        $otp_email = $this->session->userdata['otp_session_data']['email'];
        $otp = $this->input->post('otp');
        $result = $this->Seller_model->retrive_otp_details($otp);
        if ($result != false) {
            $data = array(
                'email' => $result[0]->email,
            );
            if ($data['email'] == $otp_email) {
                $this->load->view('seller/seller_new_login', $data);
            } else {
                $data['message'] = "OTP doesn't matched !";
                $this->load->view('seller/forgot_pass_otp_form', $data);
            }
        } else {
            $data['message'] = "Incorrect OTP!";
            $this->load->view('seller/forgot_pass_otp_form', $data);
        }
    }

    function forgot_pass_login() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('pass', 'Password', 'required|matches[cnf_pass]|md5');
        $this->form_validation->set_rules('cnf_pass', 'Confirm Password', 'required|md5');

        if ($this->form_validation->run() != false) {
            $data = array(
                'email' => $this->input->post('email'),
                'password' => $this->input->post('pass')
            );
            $result = $this->Seller_model->update_forgot_pass($data);
            if ($result == true) {
                $email = $this->input->post('email');
                $result = $this->Seller_model->seller_details($email);
                $sessiondata = $result[0]->seller_id;
                $this->session->set_userdata('seller-session', $sessiondata);
                $result1 = $this->Seller_model->seller_details($email);
                if ($result1 != false) {
                    $data = array(
                        'name' => $result1[0]->name,
                        'ac_status' => $result1[0]->status
                    );
                    $this->session->set_userdata($data);
                }
                $seller_id = $this->session->userdata('seller-session');
                $return_value = $this->Seller_model->check_seller_signup($seller_id);
                $this->session->set_userdata('seller-signup-session', $return_value);
                //Seller Notice Session Declaration
                $seller_notice = $this->Seller_model->check_session_seller_notice();
                if ($seller_notice) {
                    $this->session->set_userdata('seller-notice-session', $seller_notice);
                }
                $this->session->set_flashdata('all_data', $data);
                redirect('seller/seller/home');
            } else {
                $data["message"] = "Invalid Username or Password";
                $this->load->view('seller/seller_new_login', $data);
            }
        } else {
            $this->load->view('seller/seller_new_login');
        }
    }

    function seller_logout() {
        $this->session->sess_destroy(); 
        redirect(site_url('seller/seller'));
    }

    function send_email_code() {
        if ($this->session->userdata('seller-session')) {
            $code = random_string('alnum', 7);
            $data['code'] = $code;
            $to = $this->input->post('email');
            $from = DEMO_SELLER_SUPPORT;
            $subject = "[".COMPANY." Marketplace] - Account Verification";

            $this->email->set_newline("\r\n");
            $this->email->set_mailtype("html");
            $this->email->from($from);
            $this->email->to($to);
            $this->email->subject($subject);
            $this->email->message($this->load->view('email_template/email_verificationcode', $data, true));

            if ($this->email->send()) {
                $result = $this->Seller_model->insert_email_code($to, $code);
            }
        } else {
            redirect('seller/seller');
        }
    }

    function otp_verification() {
        if ($this->session->userdata('seller-session')) {
            $email_id = $this->input->post('email_id'); //echo $email_id; exit;
            $otp = $this->input->post('otp');

            $result = $this->Seller_model->match_otp($email_id, $otp);
            if ($result == true) {
                echo "success";
            } else {
                echo "fail";
            }
        } else {
            redirect('seller/seller');
        }
    }

    function more_seller_info() {
        if ($this->session->userdata('seller-session')) {
            $sell_online = $this->input->post('sell_online');
            $here_about = $this->input->post('here_about');
            $seller_id = $this->input->post('seller_id');
            $result1 = $this->Seller_model->insert_verification_info($sell_online, $here_about, $seller_id);
        } else {
            redirect('seller/seller');
        }
    }

    function add_category() {
        if ($this->session->userdata('seller-session')) {
            $category = urldecode($this->uri->segment(4));
            $seller_id = $this->session->userdata('seller-session');

            $result = $this->Seller_model->addCategory($seller_id, $category);


            if ($result == true) {
                $result1 = $this->Seller_model->get_seller_id($seller_id);
                if ($result != false) {
                    $data['result'] = $result1;

                    $this->Seller_model->emaito_newseller($seller_id);
                    $this->load->view('seller/seller_information', $data);
                }
            } else {
                $data['error'] = "Incorrect Category !";
                $this->load->view('seller/verification_ac_details', $data);
            }
        } else {
            redirect('seller/seller');
        }
    }

    function seller_info_form_page() {
        if ($this->session->userdata('seller-session')) {
            $seller_id = $this->session->userdata('seller-session');
            $result = $this->Seller_model->get_seller_id($seller_id);
            if ($result != false) {
                $data['result'] = $result;
                $this->load->view('seller/seller_information', $data);
            }
        } else {
            redirect('seller/seller');
        }
    }

    function add_seller_information() {
        if ($this->session->userdata('seller-session')) {
            $config['upload_path'] = './images/seller_image_doc/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = '20480000';
            $config['max_width'] = '3000';
            $config['max_height'] = '3000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $this->upload->do_upload('pan_img');
            $data = array('pan_img_upload_data' => $this->upload->data());
            $pan_img_name = $data['pan_img_upload_data']['file_name'];

            $this->upload->do_upload('tin_img');
            $data = array('tin_img_upload_data' => $this->upload->data());
            $tin_img_name = $data['tin_img_upload_data']['file_name'];

            $this->upload->do_upload('tan_img');
            $data = array('tan_img_upload_data' => $this->upload->data());
            $tan_img_name = $data['tan_img_upload_data']['file_name'];

            $this->upload->do_upload('gstin_img');
            $data = array('gstin_img_upload_data' => $this->upload->data());
            $gstin_img_name = $data['gstin_img_upload_data']['file_name'];
            $this->upload->do_upload('address_img');
            $data = array('address_img_upload_data' => $this->upload->data());
            $address_img_name = $data['address_img_upload_data']['file_name'];

            $this->upload->do_upload('ID_img');
            $data = array('ID_img_upload_data' => $this->upload->data());
            $ID_img_name = $data['ID_img_upload_data']['file_name'];

            $this->upload->do_upload('Cheque_img');
            $data = array('Cheque_img_upload_data' => $this->upload->data());
            $Cheque_img_name = $data['Cheque_img_upload_data']['file_name'];
            $result = $this->Seller_model->insert_seller_info($pan_img_name, $tin_img_name, $tan_img_name, $gstin_img_name, $address_img_name, $ID_img_name, $Cheque_img_name);
            if ($result == true) {
                $seller_id = $this->session->userdata('seller-session');
                $return_value = $this->Seller_model->check_seller_signup($seller_id);
                $this->session->set_userdata('seller-signup-session', $return_value);
                //Seller Notice Session Declaration
                $seller_notice = $this->Seller_model->check_session_seller_notice();
                if ($seller_notice) {
                    $this->session->set_userdata('seller-notice-session', $seller_notice);
                }

                $result1 = $this->Seller_model->get_seller_id($seller_id);
                $data = array(
                    'name' => $result1[0]->name,
                    'ac_status' => $result1[0]->status,
                );
                $this->session->set_userdata($data);
                $data['signin_date'] = $result1[0]->signin_date;
                $this->session->set_flashdata('all_data', $data);
                redirect('seller/seller/home');
                //Comment for issue after login
            } else {
                $seller_id = $this->session->userdata('seller-session');
                $data['result'] = $this->Seller_model->get_seller_id($seller_id);
                $this->load->view('seller/seller_information', $data);
            }
        } else {
            redirect('seller/seller');
        }
    }

    function incomplete_signup() {
        if ($this->session->userdata('seller-session')) {
            $seller_id = $this->session->userdata('seller-session');
            $result = $this->Seller_model->get_seller_id($seller_id);
            if ($result != false) {
                $data = array(
                    'email' => $result[0]->email,
                );
            }
            $this->load->view('seller/verification_ac_details', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function terms_conditions() {
        if ($this->session->userdata('seller-session')) {
            $seller_id = $this->session->userdata('seller-session');
            $result = $this->Seller_model->update_signupDateTime($seller_id);
            if ($result == true) {
                $result = $this->Seller_model->get_seller_id($seller_id);
                if ($result != false) {
                    $data = array(
                        'name' => $result[0]->name,
                    );
                    $this->session->set_userdata($data);
                }
                $this->load->view('seller/home', $data);
            }
        } else {
            redirect('seller/seller');
        }
    }

    function seller_notices() {
        if ($this->session->userdata('seller-session')) {
            $data['notice_list'] = $this->Seller_model->getNoticeListEachSeller();
            $this->load->view('seller/seller_notification_page', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function seller_review_rating() {
        if ($this->session->userdata('seller-session')) {
            $seller_id = $this->session->userdata('seller-session');
            $data['seller_review_data'] = $this->Product_descrp_model->retrieve_seller_review($seller_id);
            $this->load->view('seller/seller_review_rating_page', $data);
        } else {
            redirect('seller/seller');
        }
    }

    function update_manual_selleruid() {
        //$this->Seller_model->update_selleruid();	
    }

}

?>