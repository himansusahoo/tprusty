<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Corenjob_email_model extends CI_Model {
	

			function mail_sendTo_buyer()
			{
				date_default_timezone_set('Asia/Calcutta');
				
				$query_addtocart_data=$this->db->query("select * from addtocart_temp group by user_id ");
				$row_addtocart_data=$query_addtocart_data->result();
				foreach($row_addtocart_data as $res_addtocart_data)
				{
					$dt=$res_addtocart_data->added_time;
					
					$dt_after6hr=date('Y-m-d H:i:s' ,strtotime($dt.'+ 6 hour'));
					$dt_after12hr=date('Y-m-d H:i:s' ,strtotime($dt.'+ 12 hour'));
					$dt_after18hr=date('Y-m-d H:i:s' ,strtotime($dt.'+ 18 hour'));
					$dt_after72hr=date('Y-m-d H:i:s' ,strtotime($dt.'+ 72 hour'));
					
					$cur_dtime=date('Y-m-d H:i:s');
					if($cur_dtime==$dt_after6hr || $cur_dtime==$dt_after12hr || $cur_dtime==$dt_after18hr || $cur_dtime==$dt_after72hr )
					{
						$user_id=$res_addtocart_data->user_id;
						
						//email send to buyer start
						
								$query_user_info=$this->db->query("select * from user where user_id='$user_id' ");
								$mail_row_user=$query_user_info->row();
								
								$fname=$mail_row_user->fname;
								$lname=$mail_row_user->lname;
								
								
								$email_buyer=$mail_row_user->email;
								$data['fname']=$fname;
								$data['lname']=$lname;
								
								/*$message_buyer = "			
										<html>
										<head>					
										<title></title>
										<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
										</head>					
										<body style='background-color:#fabd2f; font-family:'Calibri',Arial, Helvetica, sans-serif;'>
										
										<table width='600' cellspacing='0' align='center'>
										<tr> <td style='text-align:right; color:#e8442b;font-weight:bold; font-size:14px;'> 
										Call us :  <span style='color:#fff;'> 91-7874460000  </span><br>
										Email :   <span style='color:#fff;'> seller@moonboy.in </span> 
										</td>
										</tr>
										
										<tr>
										<td> 
										
										<table style'background-color:#f1f1f1;color:#333; font-size:12px; border:2px solid #e8442b;'>
										<tr>
										
										<td align='center' colspan='3'>
										
										 Moonboy
										 <div style='clear:both;'>  </div>
										
										<div style='clear:both;'> </div>
										 </td> </tr>
										 
										 <tr> 
										 <td width='10px'> </td>
										 <td>
										 <p> <strong style='font-size:16px;'>Dear ".$fname." ".$lname."  ,</strong> <br /><br />
										
										<span style='color:#e25a0c; font-weight:bold;'> </span> <br /> <br />
										
										Please Complete your check out process from your cart(www.moonboy.in).
										
										
										<br />  <br />
										 
										
										</td> 
										<td width='10px'></td>
										</tr>
										</table>
										
										</td>
										</tr>
										
										<tr>
										<td style='background-color:#e8442b;  border:2px solid #e8442b; color:#fff; padding:15px; text-align:center;'>
										 &copy; 2015 Moonboy. 1st Floor, Khajotiya House, Beside Parsi Fire Temple , Sayedpura, Surat, GJ, IN- 395003 <br />
										You received this email because you're a registered Moonboy user. 
										</td> </tr> </table>
										
										</td> </tr> </table>
										
										</body>
										</html>";*/	
										
																   
											$this->email->set_mailtype("html");
											$this->email->from('info@moonboy.in', 'moonboy.in');
											//$this->email->to($email_buyer);
											$this->email->to('santanu@paramountitsolutions.co.in');
											$this->email->subject('Complete your Check out process');
											$this->email->message($this->load->view('email_template/cronjobmail_cartitems',$data,true));
											//$this->email->message($this->load->view('email_template','',true));
											//$this->email->message($message_buyer);
											$this->email->send();				
								} //if end
						} // foreach end
				
			}
			
			
			
			function wishlistmail_sendTo_buyer()
			{
				$query_wishlist_data=$this->db->query("select * from wishlist group by user_id ");
				$row_wishlist_data=$query_wishlist_data->result();
				
				if($query_wishlist_data->num_rows()!=0)
				{
							foreach($row_wishlist_data as $res){
								
								$user_id=$res->user_id;
								$query_user_info=$this->db->query("select * from user where user_id='$user_id' ");
								$mail_row_user=$query_user_info->row();
								
								$fname=$mail_row_user->fname;
								$lname=$mail_row_user->lname;
								
								
								$email_buyer=$mail_row_user->email;
								$data['fname']=$fname;
								$data['lname']=$lname;
								
								/*$message_buyer = "			
										<html>
										<head>					
										<title></title>
										<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
										</head>					
										<body style='background-color:#fabd2f; font-family:'Calibri',Arial, Helvetica, sans-serif;'>
										
										<table width='600' cellspacing='0' align='center'>
										<tr> <td style='text-align:right; color:#e8442b;font-weight:bold; font-size:14px;'> 
										Call us :  <span style='color:#fff;'> 91-7874460000  </span><br>
										Email :   <span style='color:#fff;'> seller@moonboy.in </span> 
										</td>
										</tr>
										
										<tr>
										<td> 
										
										<table style'background-color:#f1f1f1;color:#333; font-size:12px; border:2px solid #e8442b;'>
										<tr>
										
										<td align='center' colspan='3'>
										
										 Moonboy
										 <div style='clear:both;'>  </div>
										
										<div style='clear:both;'> </div>
										 </td> </tr>
										 
										 <tr> 
										 <td width='10px'> </td>
										 <td>
										 <p> <strong style='font-size:16px;'>Dear ".$fname." ".$lname."  ,</strong> <br /><br />
										
										<span style='color:#e25a0c; font-weight:bold;'> </span> <br /> <br />
										
										Please Complete your check out process from your wishlist(www.moonboy.in).
										
										
										<br />  <br />
										 
										
										</td> 
										<td width='10px'></td>
										</tr>
										</table>
										
										</td>
										</tr>
										
										<tr>
										<td style='background-color:#e8442b;  border:2px solid #e8442b; color:#fff; padding:15px; text-align:center;'>
										 &copy; 2015 Moonboy. 1st Floor, Khajotiya House, Beside Parsi Fire Temple , Sayedpura, Surat, GJ, IN- 395003 <br />
										You received this email because you're a registered Moonboy user. 
										</td> </tr> </table>
										
										</td> </tr> </table>
										
										</body>
										</html>";*/	
										
																   
											$this->email->set_mailtype("html");
											$this->email->from('info@moonboy.in', 'moonboy.in');
											$this->email->to($email_buyer);
											//$this->email->to('santanu@paramountitsolutions.co.in');
											$this->email->subject('Complete your Check out process from wishlist');
											$this->email->message($this->load->view('email_template/cronjobmail_wishlist',$data,true));
											//$this->email->message($this->load->view('email_template','',true));
											//$this->email->message($message_buyer);
											$this->email->send();	
								
								
							}
					
						
				}	
				
				
			}

	
}