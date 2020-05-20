<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('html', 'form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('session');
        $this->load->library('upload');
        $this->load->library('encrypt');
        $this->load->library('javascript');
        $this->load->library('pagination');
        $this->load->library('user_agent');
        $this->load->database();
        $this->load->helper('cookie');
        $this->load->model('Usermodel');
        $this->load->model('Homemodel');
    }

    public function index() {

        /* $p['slider_box1']=$this->Usermodel->slider_box1_select();
          $p['sub3_box1_info']=$this->Usermodel->block3_box1_select();
          $p['sub2_box1_info']=$this->Usermodel->block2_box1_select();
          $p['sub2_box2_info']=$this->Usermodel->block2_box2_select();
          $p['sub2_box3_info']=$this->Usermodel->block2_box3_select();
          $p['sub1_box1_info']=$this->Usermodel->block1_box1_select();
          $p['sub1_box2_info']=$this->Usermodel->block1_box2_select();
          //$p['ad_blog']=$this->Usermodel->ad_blog();

          $p['data1']=$this->Usermodel->view_homepage();
          //$p['root_catg']=$this->Usermodel->select_root_categories();

          $p['new_product_result'] = $this->Usermodel->retrieve_new_product();
          //$p['product_result'] = $this->Usermodel->retrieve_product();
          $p['product_result'] = $this->Usermodel->retrieve_trending_products(); */
        $prodid = get_cookie('prodid', TRUE);
        /* if($prodid!='')
          {$p['product_result_for_scroll1'] = $this->Usermodel->retrieve_product_for_scroll1();}else
          {$p['product_result_for_scroll1']='';} */
        //$p['product_result_for_scroll2'] = $this->Usermodel->retrieve_product_for_scroll2();
        if ($this->agent->is_mobile()) {
            $this->db->cache_on();
            $data['data1'] = $this->Usermodel->view_homepage();
            $data['sec_info'] = $this->Homemodel->select_mobilehomepage_allsections();
            //$this->load->view('m/home',$p);
            $this->load->view('m/home', $data);
        } else {
            $this->db->cache_on();
            if ($prodid != '') {
                $p['product_result_for_scroll1'] = $this->Usermodel->retrieve_product_for_scroll1();
            } else {
                $p['product_result_for_scroll1'] = '';
            }
            $p['slider_box1'] = $this->Usermodel->slider_box1_select();
            $p['sub3_box1_info'] = $this->Usermodel->block3_box1_select();
            $p['sub2_box1_info'] = $this->Usermodel->block2_box1_select();
            $p['sub2_box2_info'] = $this->Usermodel->block2_box2_select();
            $p['sub2_box3_info'] = $this->Usermodel->block2_box3_select();
            $p['sub1_box1_info'] = $this->Usermodel->block1_box1_select();
            $p['sub1_box2_info'] = $this->Usermodel->block1_box2_select();
            //$p['ad_blog']=$this->Usermodel->ad_blog();

            $p['data1'] = $this->Usermodel->view_homepage();
            //$p['root_catg']=$this->Usermodel->select_root_categories();

            $p['new_product_result'] = $this->Usermodel->retrieve_new_product();
            //$p['product_result'] = $this->Usermodel->retrieve_product();
            $p['product_result'] = $this->Usermodel->retrieve_trending_products();
            $p['sec_info'] = $this->Homemodel->select_desktophomepage_allsections();
            //$p['sec_info']=$this->Homemodel->select_desktophomepage_allsections();

            $this->load->view('home', $p);
        }
    }

    /* function shopbycategory_menu()
      {
      if ($this->agent->is_mobile())
      {
      $this->load->view('m_new/menu_link');
      }
      else
      {echo "not accessible for desktop PC";}
      } */

    function login() {
        $result = $this->Usermodel->login_register();
        $user_id = $result[0]->user_id;
        if ($result[0]->fname == '') {
            $fname = 'Guest';
        } else {
            $fname = $result[0]->fname;
        }

        $user_data = array(
            'user_id' => $user_id,
            'fname' => $fname,
        );
        $this->session->set_userdata('session_data', $user_data);
        $data['data1'] = $this->Usermodel->view_homepage();

        $product_id_arr = count($this->session->userdata('addtocarttemp'));
        //$user_id=$this->session->userdata('user_id');

        if ($product_id_arr != 0) {
            $this->Usermodel->insertinto_addtocart();
        }

        $wishlisttemp_sku = count($this->session->userdata('addtowishlist_tempsku'));

        if ($wishlisttemp_sku != 0) {
            $this->Usermodel->insert_from_tempwishlist();
        }

        $data['result'] = $result;
        //$this->load->view('home',$data);
        //if($this->session->userdata['pre_session_id']['product_id']){
        //echo 'success1';exit;
        //}else{
        echo 'success';
        exit;
        //}
        /* if(@$this->session->userdata('logintobuysku_id'))
          {
          //$this->session->unset_userdata('logintobuysku_id');
          echo 'success1';exit;

          }
          else{
          echo 'success';exit;
          } */
    }

    function shopbycategory_menu() {
        if ($this->agent->is_mobile()) {
            $this->load->view('m/menu_link');
        } else {
            echo "not accessible for desktop PC";
        }
    }

    function offer_productcatalog() {
        if ($this->agent->is_mobile()) {
            $data['product_data'] = $this->Homemodel->select_offercatalogproduct();
            $data['no_of_product'] = $this->Homemodel->select_offercatalogproduct_count();

            //$this->load->model('Catalog_offerpage_model');
            //$data['catg_name']=$this->Homemodel->offerproduct_categoryname();

            $this->load->view('m/catalog_offerpage', $data);
        } else {
            $data['product_data'] = $this->Homemodel->select_offercatalogproduct_desktop();
            $data['no_of_product'] = $this->Homemodel->select_offercatalogproduct_count_desktop();
            $this->load->view('catalog_offerpage', $data);
        }
    }

    function m_login() {
        $this->load->view('m/buyer_login');
    }

    function socialLogin() {
        $email = $this->input->post('mail_id');
        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $photo = $this->input->post('photo');
        $this->session->set_userdata('user_photo', $photo);
        $customer_data = array(
            'email' => $email,
            'fname' => $fname,
        );

        $result = $this->Usermodel->check_user_email_address($customer_data);
        if ($result != false) {
            if ($result[0]->status == 'Active') {
                $user_data = array(
                    'user_id' => $result[0]->user_id,
                    'fname' => $result[0]->fname
                );
                $this->session->set_userdata('session_data', $user_data);



                //$user_id=$this->session->userdata('user_id');
                //addtocart &wishlist temp product add start
                $product_id_arr = count($this->session->userdata('addtocarttemp'));
                if ($product_id_arr != 0) {
                    $this->Usermodel->insert_addtocartfromtemp($email);
                }

                $wishlisttemp_sku = count($this->session->userdata('addtowishlist_tempsku'));

                if ($wishlisttemp_sku != 0) {
                    $this->Usermodel->insertfromtemp_wishlist($email);
                }
                //addtocart &wishlist temp product add start

                echo 'ok';
                exit;
            } else {
                echo 'blocked';
            }
        } else {
            $user_id = $this->Usermodel->get_unique_id('user', 'user_id');
            $data = array(
                'user_id' => $user_id,
                'fname' => $fname,
                'lname' => $lname,
                'email' => $email
            );
            $result = $this->Usermodel->insert_social_registration_data($data);
            if ($result == true) {

               
                $user_info['email'] = $email;

                $this->email->set_mailtype("html");
                $this->email->from(NO_REPLY_MAIL, DOMAIN_NAME);
                $this->email->to($email);
                $this->email->subject('Welcome to '. ucfirst(DOMAIN_NAME));
                //$this->email->message($message);
                $this->email->message($this->load->view('email_template/user_social_login', $user_info, true));
                $this->email->send();

                date_default_timezone_set('Asia/Calcutta');
                $dt = date('Y-m-d H:i:s');

                $msg = $this->load->view('email_template/user_social_login', $user_info, true);
                if ($this->email->send()) {

                    $email_data = array(
                        'to_email_id' => $email,
                        'from_email_id' => NO_REPLY_MAIL,
                        'date' => $dt,
                        'email_sub' => 'Welcome to '. ucfirst(DOMAIN_NAME),
                        'email_content' => $msg,
                        'email_send_status' => 'Success'
                    );
                } else {
                    $email_data = array(
                        'to_email_id' => $email,
                        'from_email_id' => NO_REPLY_MAIL,
                        'date' => $dt,
                        'email_sub' => 'Welcome to '. ucfirst(DOMAIN_NAME),
                        'email_content' => $msg,
                        'email_send_status' => 'Failure'
                    );
                }
                $this->db->insert('email_log', $email_data);

                $customer_data = array(
                    'user_id' => $user_id,
                    'fname' => $fname,
                );
                $this->session->set_userdata('session_data', $customer_data);


                //addtocart &wishlist temp product add start
                $product_id_arr = count($this->session->userdata('addtocarttemp'));
                if ($product_id_arr != 0) {
                    $this->Usermodel->insert_addtocartfromtemp($email);
                }

                $wishlisttemp_sku = count($this->session->userdata('addtowishlist_tempsku'));

                if ($wishlisttemp_sku != 0) {
                    $this->Usermodel->insertfromtemp_wishlist($email);
                }
                //addtocart &wishlist temp product add start

                echo 'ok';
                exit;
            }
        }
    }

    function mob_socialLogin() {
        $email = $this->input->post('mail_id');
        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $photo = $this->input->post('photo');
        $this->session->set_userdata('user_photo', $photo);
        $customer_data = array(
            'email' => $email,
            'fname' => $fname,
        );

        $result = $this->Usermodel->check_user_email_address($customer_data);
        if ($result != false) {
            if ($result[0]->status == 'Active') {
                $user_data = array(
                    'user_id' => $result[0]->user_id,
                    'fname' => $result[0]->fname
                );
                $this->session->set_userdata('session_data', $user_data);


                //addtocart &wishlist temp product add start
                $product_id_arr = count($this->session->userdata('addtocarttemp'));
                if ($product_id_arr != 0) {
                    $this->Usermodel->insert_addtocartfromtemp($email);
                }

                $wishlisttemp_sku = count($this->session->userdata('addtowishlist_tempsku'));

                if ($wishlisttemp_sku != 0) {
                    $this->Usermodel->insertfromtemp_wishlist($email);
                }
                //addtocart &wishlist temp product add start


                echo 'ok';
                exit;
            } else {
                echo 'blocked';
            }
        } else {
            $user_id = $this->Usermodel->get_unique_id('user', 'user_id');
            $data = array(
                'user_id' => $user_id,
                'fname' => $fname,
                'lname' => $lname,
                'email' => $email
            );
            $result = $this->Usermodel->insert_social_registration_data($data);
            if ($result == true) {

                $message = "
		<div style='padding:20px;'> <h5>Hello " . $fname . " ,</h5>
		<p>Thank you for signing up with ".ucfirst(DOMAIN_NAME)."</p>
		<strong>Your Log in ID is :  " . $email . " and<br/><br/>
			    Password is as for your social</strong><br/>
		<p>You can now log in to ".ucfirst(DOMAIN_NAME)." using this ID and the password. </p><br/>
           Thanks & regards,<br/>".ucfirst(DOMAIN_NAME)." Team <br/>
         </div>
		
		<div style='text-align:center; background-color:#0e4370; color:#fff; padding:10px;'>
	    <p> copyright@ 2015 ".ucfirst(DOMAIN_NAME)." . All rights reserved . </p>
       </div>";

                $this->email->set_mailtype("html");
                $this->email->from(NO_REPLY_MAIL, DOMAIN_NAME);
                $this->email->to($email);
                $this->email->subject('Welcome to '.ucfirst(DOMAIN_NAME));
                $this->email->message($message);
                $this->email->send();

                $customer_data = array(
                    'user_id' => $user_id,
                    'fname' => $fname,
                );
                $this->session->set_userdata('session_data', $customer_data);

                //addtocart &wishlist temp product add start
                $product_id_arr = count($this->session->userdata('addtocarttemp'));
                if ($product_id_arr != 0) {
                    $this->Usermodel->insert_addtocartfromtemp($email);
                }

                $wishlisttemp_sku = count($this->session->userdata('addtowishlist_tempsku'));

                if ($wishlisttemp_sku != 0) {
                    $this->Usermodel->insertfromtemp_wishlist($email);
                }
                //addtocart &wishlist temp product add start

                echo 'ok';
                exit;
            }
        }
    }

    function logout() {
        //clear the check out temp table if product add in check out temp table program start here
        if ($this->session->userdata('chkoutemp_session_id') != "") {
            $chkout_session_id = $this->session->userdata('chkoutemp_session_id');
            $this->db->where('checkout_session_id', $chkout_session_id);
            $this->db->delete('checkout_temp');
        }
        //clear the check out temp table if product add in check out temp table program end here
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('session_data');

        $this->session->unset_userdata('addtocarttemp');


        $this->session->unset_userdata('addtowishlist_tempsku');


        $this->session->unset_userdata('addtocart_sku');

        $data = array();
        $this->session->set_userdata('addtocarttemp', $data);
        $arr_sku = array();
        $this->session->set_userdata('addtocart_sku', $arr_sku);
        //$this->session->sess_destroy();
        redirect(base_url());
    }

    function forgot_password() {
        $data = array(
            'email' => $this->input->post('email'),
        );
        $result = $this->Usermodel->check_user_email_address($data);
        if ($result != false) {
            $id = $result[0]->id;
            $user_id = $result[0]->user_id;
            $name = $result[0]->fname;
            /* create random string for OTP start */
            $this->load->helper('string');
            $rand_string = random_string('alnum', 2);
            $otp = $id . $rand_string . rand(10, 999);
            $data['otp'] = $otp;
            $data['name'] = $name;
            /* create random string for OTP end */

            $retrive_data = array(
                'user_id' => $user_id,
                'email' => $data['email'],
                'otp' => $otp,
            );
            $this->session->set_userdata('otp_session_data', $retrive_data);
            $result1 = $this->Usermodel->insert_retrive_password_data($retrive_data);
            if ($result1 == true) {

               //sending mail to user program start here
                $sess_array = array(
                    'user_id' => $user_id,
                );

                $this->email->set_mailtype("html");
                $this->email->from(NO_REPLY_MAIL, DOMAIN_NAME);
                $this->email->to($data['email']);
                $this->email->subject('OTP from '.ucfirst(DOMAIN_NAME));
                $this->email->message($this->load->view('email_template/otp_mail', $data, true));
                $this->email->send();
                //sending mail to user program end here
                echo "mail_sent";
            }
        } else {
            echo "not_exist";
        }
    }

    function check_otp_forgot_password() {
        $otp_email = $this->session->userdata['otp_session_data']['email'];
        //echo $otp_email;
        $otp = $this->input->post('otp');
        $result = $this->Usermodel->retrive_otp_details($otp, $otp_email);
        if ($result != false) {
            $user_id = $result[0]->user_id;
            $email = $result[0]->email;
            if ($email == $otp_email) {
                //echo 'checked';
                echo $email;
            } else {
                echo 'not_exist';
            }
        } else {
            echo 'not_exist';
        }
    }

    function change_forgot_password() {
        $result = $this->Usermodel->update_forgot_password();
        if ($result != false) {
            $data = array(
                'email' => $this->session->userdata['otp_session_data']['email'],
            );
            $this->session->set_userdata('logged_in', $data);
            $result = $this->Usermodel->check_user_email_address($data);
            if ($result != false) {
                $user_data = array(
                    'user_id' => $result[0]->user_id,
                    'fname' => $result[0]->fname
                );
                $this->session->set_userdata('session_data', $user_data);

                // mail send for password change
                $email = $this->session->userdata['otp_session_data']['email'];
                $password = $this->input->post('pass');
                $fname = $result[0]->fname;

                $data['email'] = $email;
                $data['password'] = $password;
                $data['fname'] = $fname;

                $to = $email;
                $from = SUPPORT_MAIL;
                $subject = 'Regarding Password Change';

                $this->email->set_newline("\r\n");
                $this->email->set_mailtype("html");
                $this->email->from($from);
                $this->email->to($to);
                $this->email->subject($subject);
                $this->email->message($this->load->view('email_template/forgot_password', $data, true));
                
                if ($this->email->send()) {
                    echo 'ok';
                    exit;
                } else {
                    echo 'not';
                    exit;
                }
            }
        }
    }

    function profile() {
        if ($this->session->userdata['session_data']['user_id']) {
            $result = $this->Usermodel->retrive_user_address();
            $data['data1'] = $this->Usermodel->view_homepage();
            $data['persional_info'] = $this->Usermodel->retrieve_user_persional_info();
            $data['user_result'] = $this->Usermodel->retrive_user_data();
            $data['state_result'] = $this->Usermodel->retrive_state();
            if ($result != false) {
                $data['data1'] = $this->Usermodel->view_homepage();
                $data['result'] = $result;
                if ($this->agent->is_mobile()) {
                    $this->load->view('m/profile', $data);
                } else {
                    $this->load->view('profile', $data);
                }
            } else {
                $data['data1'] = $this->Usermodel->view_homepage();
                $data['result'] = '';
                if ($this->agent->is_mobile()) {
                    $this->load->view('m/profile', $data);
                } else {
                    $this->load->view('profile', $data);
                }
            }
        } else {
            redirect(base_url());
        }
    }

    function change_password() {
        if ($this->session->userdata['session_data']['user_id']) {
            $data['data1'] = $this->Usermodel->view_homepage();
            if ($this->agent->is_mobile()) {
                $this->load->view('m/change_password', $data);
            } else {
                $this->load->view('change_password', $data);
            }
        } else {
            redirect(base_url());
        }
    }

    function addresses() {
        if ($this->session->userdata['session_data']['user_id']) {
            $result = $this->Usermodel->retrive_user_address();
            $data['state_result'] = $this->Usermodel->retrive_state();
            $data['user_result'] = $this->Usermodel->retrive_user_data();
            if ($result != false) {
                $data['data1'] = $this->Usermodel->view_homepage();
                $data['result'] = $result;
                $this->load->view('address', $data);
            } else {
                $data['data1'] = $this->Usermodel->view_homepage();
                $data['result'] = '';
                $this->load->view('address', $data);
            }
        } else {
            redirect(base_url());
        }
    }

    function save_address() {
        $result = $this->Usermodel->insert_address();
        if ($result == true) {
            echo 'saved';
            exit;
        } else {
            echo 'not saved';
            exit;
        }
    }

    function update_address() {
        $result = $this->Usermodel->update_inn_address();
        if ($result == true) {
            echo 'updated';
            exit;
        } else {
            echo 'not_update';
            exit;
        }
    }

    function delete_address() {
        $result = $this->Usermodel->delete_user_address();
        if ($result == true) {
            echo 'deleted';
            exit;
        }
    }

    function update_user_default_address() {
        $result = $this->Usermodel->update_user_address();
        if ($result == true) {
            echo 'success';
            exit;
        }
    }

    function profile_setting() {
        if ($this->session->userdata['session_data']['user_id']) {
            $data['data1'] = $this->Usermodel->view_homepage();
            $this->load->view('profile_settings', $data);
        } else {
            redirect(base_url());
        }
    }

    function persional_info() {
        $otp = $this->input->post('otp');
        $email = $this->input->post('email');
        $result = $this->Usermodel->update_persional_info();
        if ($result == true) {
            echo 'success';
            exit;
        } else {
            echo 'not';
            exit;
        }
    }

    function send_mobile_change_otp() {
        if ($this->session->userdata['session_data']['user_id']) {
            $this->load->helper('string');
            $rand_string = random_string('alnum', 2);
            $otp = $seller_id . $rand_string . rand(10, 999);

            $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');
            $mobile = $this->input->post('mobile');
            $email = $this->input->post('email');

            $to = $email;
            $from = SUPPORT_MAIL;
            $subject = 'Regarding Mobile Number Change';

            $this->email->set_newline("\r\n");
            $this->email->set_mailtype("html");
            $this->email->from($from);
            $this->email->to($to);
            $this->email->subject($subject);
            $this->email->message("
				<html>
				<head>
					<title> Moonboy Customer Support </title>
				</head>
				<body>
					<div style='width:50%; margin:0px auto; padding:40px;  background-color:#f4f4f4; border:10px solid #ef3038;'>
						<p> Dear " . $fname . ", </p>
						<p> Greetings from Moonboy Marketplace! </p>
						<p> You are trying to change your Mobile number to " . $mobile . "</p><br/>
						<p> Mobile : " . $mobile . "</p>
						<p> OTP : " . $otp . "</p><br/><br/>
					   Thanks & regards,<br/>Moonboy Team <br/>
					</div>
				</body>
			</html>
			");
            if ($this->email->send()) {
                $result1 = $this->Usermodel->insert_user_mobile_otp($otp);
                if ($result1 == true) {
                    echo "success";
                    exit;
                } else {
                    echo "not";
                    exit;
                }
            }
        } else {
            redirect(base_url());
        }
    }

    function changed_password() {
        $user_id = $this->session->userdata['session_data']['user_id'];
        $password = $this->input->post('opass');
        $npassword = $this->input->post('npass');
        $result = $this->Usermodel->check_password($user_id, $password);
        if ($result == true) {
            $result1 = $this->Usermodel->update_changes_password($user_id, $npassword);
            if ($result1 == true) {
                $result2 = $this->Usermodel->getEmailbyIserID($user_id);
                $email = $result2[0]->email;
                $fname = $result2[0]->fname;
                $password = $this->input->post('opass');

                $to = $email;
                $from = SUPPORT_MAIL;
                $subject = 'Regarding Password Change';

                $this->email->set_newline("\r\n");
                $this->email->set_mailtype("html");
                $this->email->from($from);
                $this->email->to($to);
                $this->email->subject($subject);
                $this->email->message("
					<html>
					<head>
						<title> Moonboy Customer Support </title>
					</head>
					<body>
						<div style='width:50%; margin:0px auto; padding:40px;  background-color:#f4f4f4; border:10px solid #ef3038;'>
							<p> Dear " . $fname . ", </p>
							<p> Greetings from Moonboy Marketplace! </p>
							<p> You are trying to change your Password.</p><br/>
							<p> Username : " . $email . "</p>
							<p> Password : " . $npassword . "</p><br/><br/>
						   Thanks & regards,<br/>Moonboy Team <br/>
						</div>
					</body>
				</html>
				");
                if ($this->email->send()) {
                    echo 'changed_success';
                    exit;
                } else {
                    echo 'invalid_pass';
                    exit;
                }
            }
        } else {
            echo 'invalid_pass';
            exit;
        }
    }

    function product_review() {
        $result = $this->Usermodel->insert_product_review();
        if ($result == 'success') {
            echo 'success';
        }
        if ($result == 'exists') {
            echo 'exists';
        }
    }

    function seller_review() {
        $result = $this->Usermodel->insert_seller_review();
        if ($result == 'success') {
            echo 'success';
        }
        if ($result == 'exists') {
            echo 'exists';
        }
    }

    function review_rating() {
        if ($this->session->userdata['session_data']['user_id']) {
            $user_id = $this->session->userdata['session_data']['user_id'];
            $data['data1'] = $this->Usermodel->view_homepage();
            $data['seller_review'] = $this->Usermodel->retrieve_seller_review($user_id);
            $data['product_review'] = $this->Usermodel->retrieve_product_review($user_id);
            if ($this->agent->is_mobile()) {
                $this->load->view('m/user_review_pg', $data);
            } else {
                $this->load->view('user_review_pg', $data);
            }
        } else {
            redirect(base_url());
        }
    }

    function wishlist() {
        if ($this->session->userdata['session_data']['user_id']) {
            $data['data1'] = $this->Usermodel->view_homepage();
            $data['wishlist_products'] = $this->Usermodel->retrieve_wishlist_products();
            if ($this->agent->is_mobile()) {
                $data['data1'] = $this->Usermodel->view_single_product();
                $data['wishlist_products'] = $this->Usermodel->retrieve_wishlist_products();
                $this->load->view('m/wishlist_pg', $data);
            } else {
                $this->load->view('wishlist_pg', $data);
            }
        } else {
            redirect(base_url());
        }
    }

    function add_wishlist() {
        $result = $this->Usermodel->insert_inn_wishlist();
        if ($result == true) {
            echo 'success';
            exit;
        } else {
            echo 'exists';
            exit;
        }
    }

    function add_wishlist_temp() {
        $product_id = $this->input->post('product_id');
        $sku = $this->input->post('sku');
        $result = $this->Usermodel->insert_inn_wishlist_temp($product_id, $sku);
        if ($result == true) {
            echo 'success';
            exit;
        } else {
            echo 'exists';
            exit;
        }
    }

    function remove_from_wishlist() {
        $result = $this->Usermodel->delete_from_wishlist();
        if ($result == true) {
            echo 'success';
            exit;
        }
    }

    function orders() {
        if ($this->session->userdata['session_data']['user_id']) {
            $data['data1'] = $this->Usermodel->view_homepage();
            $data['order_id_result'] = $this->Usermodel->retrieve_customer_last3_mnth_order_id();
            $data['order_id_past_result'] = $this->Usermodel->retrieve_customer_past_order_id();

            if ($this->agent->is_mobile()) {
                $this->load->view('m/order_pg', $data);
            } else {
                $this->load->view('order_pg', $data);
            }
        } else {
            redirect(base_url());
        }
    }

    function order_cancelation() {
        $result = $this->Usermodel->cancel_order();
        if ($result == true) {
            echo 'success';
            exit;
        }
    }

    function product_cancelation() {
        $result = $this->Usermodel->cancel_product();
        $this->Usermodel->mail_cancel_product();
        if ($result == true) {
            echo 'success';
            exit;
        }
    }

    function order_details() {
        if ($this->session->userdata['session_data']['user_id']) {
            $id = base64_decode($this->uri->segment(2));
            $order_id = $this->encrypt->decode($id);
            $data['result'] = $this->Usermodel->retrive_indivisual_order_id_details($order_id);
            $data['result_product'] = $this->Usermodel->retrive_indivisual_order_id_product_details($order_id);
            $data['data1'] = $this->Usermodel->view_homepage();
            $data['tracking_details'] = $this->Usermodel->retrieve_tracking_details($order_id);
            if ($this->agent->is_mobile()) {
                $this->load->view('m/order_details', $data);
            } else {
                $this->load->view('order_details', $data);
            }
        } else {
            redirect(base_url());
        }
    }

    /* Customer Support Starts */
    /* function customersupport(){
      $this->load->view('costumer_support');
      } */

    function contact_us_form() {
        if ($this->agent->is_mobile()) {
            $this->load->view('m/contact_us_form');
        } else {
            $this->load->view('contact_us_form');
        }
    }

    function send_customer_support_mail() {
        //if($this->session->userdata['session_data']['user_id']){
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'mobile' => $this->input->post('mobile'),
            'subject' => $this->input->post('title'),
            'content' => $this->input->post('content'),
        );

        //$to = SUPPORT_MAIL;
        $to = SUPPORT_MAIL;
        $from = $this->input->post('email');
        $subject = $this->input->post('title');
        $content = $this->input->post('content');

        $user_info['user_name'] = $this->input->post('name');
        $user_info['user_email'] = $this->input->post('email');
        $user_info['user_mobile'] = $this->input->post('mobile');
        $user_info['user_subject'] = $this->input->post('title');
        $user_info['user_query'] = $this->input->post('content');

        $this->email->set_newline("\r\n");
        $this->email->set_mailtype("html");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($this->load->view('email_template/contact_usemail', $user_info, true));
        if ($this->email->send()) {
            $result = $this->Usermodel->insert_customer_support_data();
            if ($result == true) {
                echo 'success';
                exit;
            } else {
                echo 'not';
                exit;
            }
        } else {
            echo 'not';
            exit;
        }
        //}else{
        //redirect(base_url());
        //}
    }

    /* Customer Support End */

    function product_return() {
        $result = $this->Usermodel->insert_inn_return_product();
        if ($result == true) {
            echo 'success';
        } else {
            echo 'not';
        }
    }

    function search_product() {
        $keyword = $this->input->post('name');

        //$p['search_prod']=$this->Usermodel->search_product($keyword);
        //$p['search_prod']=false;
        $p['search_prodclause'] = $this->Usermodel->search_product_clause($keyword);

        $p['search_keyword'] = $keyword;
        //$p['search_catg']=$this->Usermodel->search_category($keyword);

        if ($this->agent->is_mobile()) {
            $this->load->view('m/search_product', $p);
        } else {
            $this->load->view('search_product', $p);
        }
    }

    function subscriber_detail() {
        $email = $this->input->post('email');
        //print_r($email);exit;
        $gender = $this->input->post('gender');
        $result1 = $this->Usermodel->select_subscriber_detail($email, $gender);
        if ($result1 == TRUE) {
            $this->session->set_flashdata('message', 'Already Registered');
            redirect(base_url());
        } else {
            $result = $this->Usermodel->insert_subscriber_detail($email, $gender);
            //$result1=$data['registered'];
            if ($result == TRUE) {
                redirect(base_url());
            }
        }
    }

    function error_page() {
        $this->load->view('404');
    }

    function show_more_catalog_data() {
        //$p['data'] = $this->Product_descrp_model->view_product_descrp();
        $p['product_data'] = $this->Homemodel->select_more_product_data_list();
        $p['sl_no'] = $this->input->get('from');

        //$p['sl_no'] = $this->uri->segment(3);

        if ($this->agent->is_mobile()) {
            $this->load->view('m/ajax_load_product_addtocart', $p);
        } else {
            $p['product_data'] = $this->Homemodel->select_more_product_data_list_desktop();
            $p['sl_no'] = $this->input->get('from');
            $this->load->view('ajax_load_product_addtocart_offer', $p);
        }
    }

}

?>