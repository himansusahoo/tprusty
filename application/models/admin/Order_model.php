<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {
	
	function select_orders($limit,$start)
	{
		$query=$this->db->query("select a.order_confirm_for_seller,a.order_id, a.order_status, a.Total_amount as sub_total_amount, a.date_of_order, a.order_status_modified_date,a.order_confirm_for_seller,a.invoice_id,a.cancelled_by,a.grace_period_approve_status,a.grace_period,a.order_processstatus,a.payment_mode,b.seller_id,c.full_name from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id group by b.order_id order by a.id desc LIMIT ".$start." , ".$limit."");
		return $query;
	}
	
	function select_sellernm_rel_order($seller_id)
	{
		$sql ="SELECT pname as slr_nm, pemail as email, pmobile as mob, business_name FROM seller_account_information WHERE seller_id = ?";	
		
		$query = $this->db->query($sql,array($seller_id));
		$count = $query->num_rows();
		
		if($count>0)
		{
			$result = $query->row();
		}
		else
		{
			$sql ="SELECT name as slr_nm, email , mobile as mob, '' as  business_name FROM seller_account WHERE seller_id = ?";
			$query = $this->db->query($sql,array($seller_id));
			$result = $query->row();				
		}
		
		return $result;
		
	}
	
	function select_transferorders()
	{
		$query=$this->db->query("select a.order_confirm_for_seller,a.order_id, a.order_status, a.Total_amount as sub_total_amount, a.date_of_order, a.order_status_modified_date,a.order_confirm_for_seller,a.invoice_id,a.cancelled_by,a.grace_period_approve_status,a.grace_period,b.seller_id,c.full_name from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id group by b.order_id order by a.id desc ");
		return $query;
	}
	
	
	function retrive_select_order_count(){
		$query = $this->db->query("SELECT order_id FROM order_info");
		if($query->num_rows() > 0){
			return $query->num_rows();
		}else{
			return false;
		}
	}
	
	function generate_invoiceid($order_id)
	{
		date_default_timezone_set('Asia/Calcutta');
		$dt = date('Y-m-d H:i:s');
		
		$invoice_id=random_string('alnum',5).'-'.$order_id;
		$query=$this->db->query("update order_info set invoice_id='$invoice_id', invoice_date='$dt' where order_id='$order_id'  ");
		
		//order status log update start
		
		$order_log_status='invoice_generate_date';
		$this->update_orderstatus_log($order_id,$order_log_status);
		
		//order status log update end
		
	}
	
	function generate_shipmentid($shipment_no,$order_id)
	{
		date_default_timezone_set('Asia/Calcutta');
		$shpping_date = date('Y-m-d H:i:s');
		$shipment_id=$this->get_unique_id('shipment_info','shipment_id');
		
		$data=array(
		'shipment_id'=>$shipment_id,
		'shipment_no'=>$shipment_no,
		'order_id'=>$order_id,
		'shipping_date'=>$shpping_date
		);
		
		$this->db->insert('shipment_info',$data); 
		$query=$this->db->query("update order_info set order_status='Shipped', order_status_modified_date='$shpping_date' where order_id='$order_id'  ");
			
	}
	
	function get_unique_id($table,$uid){
			
		$query = $this->db->query('SELECT MAX('.$uid.') AS `maxid` FROM '.$table);
		$maxId = $query->row()->maxid;
		$id = $maxId+1;
		return $id;
		}
	//function select_status()
//		{
//			$qr=$this->db->query("select * from order_info");
//			
//			return $qr;	
//		}


		function change_ordertatus()
		{
			$ordered_id = implode(',',$this->input->post('orderid'));
			date_default_timezone_set('Asia/Calcutta');
			$dt = date('Y-m-d H:i:s');			
				
			$order_status =$this->input->post('ordered_status');
			
			if($order_status=='Delivered')
			{
				$this->db->query("update order_info set  order_status='$order_status', order_status_modified_date='$dt'	 WHERE order_status='Shipped' AND  order_id IN ($ordered_id)");
				
				$this->db->query("update ordered_product_from_addtocart set  product_order_status='$order_status' WHERE product_order_status='Shipped' AND order_id IN ($ordered_id)");
			}
			else
			{
				
				$this->db->query("update order_info set  order_status='$order_status', order_status_modified_date='$dt'	 WHERE order_id IN ($ordered_id)");
				
				$this->db->query("update ordered_product_from_addtocart set  product_order_status='$order_status' WHERE order_id IN ($ordered_id)");
			}
			
			if($order_status=='Delivered')
			{
				$order_log_status='delivered_date';
				$this->update_orderstatus_log($ordered_id,$order_log_status);	
			}
			
			if($order_status=='Return Received')
			{
				$order_log_status='return_received_date';
				$this->update_orderstatus_log($ordered_id,$order_log_status);	
			}		
		}
		
		
		function approve_order_by_admin()
		{
			$ordered_id = implode(',',$this->input->post('orderid'));
			date_default_timezone_set('Asia/Calcutta');
			$dt = date('Y-m-d H:i:s');
			$query1=$this->db->query("update order_info set order_status='Order confirmed',order_confirm_for_seller='Approved',order_confirm_for_seller_date='$dt' where order_id IN ($ordered_id)  ");
			$query2=$this->db->query("update ordered_product_from_addtocart set product_order_status='Order confirmed' where order_id IN ($ordered_id)   ");
			
			$order_log_status='order_approved_date';
			$this->update_orderstatus_log($ordered_id,$order_log_status);
			
			$orderid_arr=$this->input->post('orderid');
			
			foreach($orderid_arr as $ord_key=>$ord_val)
			{
				$rder_query=$this->db->query("select a.user_id,b.pemail,b.business_name from ordered_product_from_addtocart a INNER JOIN seller_account_information b 
				ON a.seller_id=b.seller_id where a.order_id='$ord_val' group by a.order_id");
				$rw_order=$rder_query->row();
				
										$cart['order_id']=$ord_val;
										$cart['user_id']=$rw_order->user_id;
										$cart['slr_name']=$rw_order->business_name;
										
										
								//-------------------------Data For message end----------------------------------
														   
										$this->email->set_mailtype("html");
										$this->email->from(SELLER_MAIL, DOMAIN_NAME);
										$this->email->to($rw_order->pemail);
										//$this->email->to('santanu@paramountitsolutions.co.in');
										$this->email->subject('New Order Received –' .$ord_val);
										$this->email->message($this->load->view('email_template/order_recived_seller',$cart,true));
										//$this->email->message($message1);
										 //$this->email->attach(pdf_create($html, 'order_Slip'));
										$this->email->send();
										
										
										date_default_timezone_set('Asia/Calcutta');
										$dt = date('Y-m-d H:i:s');
									
										$msg=$this->load->view('email_template/order_recived_seller',$cart,true);
										if($this->email->send()){
											
											$email_data=array(
											'to_email_id'=>$rw_order->pemail,
											'from_email_id'=>SELLER_MAIL,
											'date'=>$dt,
											'email_sub'=>'New Order Received –' .$ord_val,
											'email_content'=>$msg,
											'email_send_status'=>'Success'
											);
										}else
										{
											$email_data=array(
											'to_email_id'=>$rw_order->pemail,
											'from_email_id'=>SELLER_MAIL,
											'date'=>$dt,
											'email_sub'=>'New Order Received –' .$ord_val,
											'email_content'=>$msg,
											'email_send_status'=>'Failure'
											);
										}
										$this->db->insert('email_log',$email_data);		
				
			}
			
			
			
		}
		
		function update_orderstatus_log($ordered_id,$order_log_status)
		{
			date_default_timezone_set('Asia/Calcutta');
			$dt = date('Y-m-d H:i:s');
			
			$qr=$this->db->query("select * from order_status_log WHERE order_id IN ($ordered_id) ");
			$ct=$qr->num_rows();
			
			if($ct>0)
			{
				$this->db->query("update order_status_log set ".$order_log_status."='$dt' WHERE order_id IN ($ordered_id) ");	
			}else
			{
				$order_arr=explode(',',$ordered_id);
				$ct=count($order_arr);
				
				for($i=0; $i<$ct; $i++)
				{
					$data=array(
						'order_id'=>$order_arr[$i],
						$order_log_status=>$dt
					 );
					 $this->db->insert('order_status_log',$data );
				} // for loop end
			}
					
		}
		
		
		
		function disapprove_order_by_admin()
		{
			$ordered_id = implode(',',$this->input->post('orderid'));
			date_default_timezone_set('Asia/Calcutta');
			$dt = date('Y-m-d H:i:s');
			$query1=$this->db->query("update order_info set order_status='Processing',order_confirm_for_seller='Not Approved',order_confirm_for_seller_date='0000-00-00 00:00:00',order_accept_by_seller='Not Accepted' where order_id IN ($ordered_id)   ");
			
			$query2=$this->db->query("update ordered_product_from_addtocart set product_order_status='Processing' where order_id IN ($ordered_id)   ");
			
			$order_log_status='order_not_approved_date';
			$this->update_orderstatus_log($ordered_id,$order_log_status);
		}
		
	   function	change_oderstatus_log()
	   {
			$ordered_id = implode(',',$this->input->post('orderid'));
			$order_status =$this->input->post('ordered_status');
			
			date_default_timezone_set('Asia/Calcutta');
			$cdate =date('y-m-d H:i:s');
			$uid= $this->session->userdata('logged_userrole_id');
			$uname=$this->session->userdata('logged_in');
			
			$log_data="Changes of order status as ".$order_status." of Order Id  (".$ordered_id.") ";
		
				$data=array(
							
							'log_detail'=>$log_data,
							'user_id'=>$uid,
							'user_name'=>$uname,
							'log_datetime'=>$cdate
						);
						$this->db->insert('user_log',$data);	
		}
		
		function mail_change_ordertatus()
		{
		
					$ordrid_arr=$this->input->post('orderid');
					$order_status =$this->input->post('ordered_status');
					
					if($order_status=='Cancelled'){					
								foreach($ordrid_arr as $k=>$v_orderid)	
								
								//multiple time email send start froeach
								{
									
									$query_reurn_product_info=$this->db->query("select c.imag,d.name as prd_name, a.quantity, a.sub_total_amount,a.user_id,e.Total_amount from  ordered_product_from_addtocart a inner join product_master b on a.sku=b.sku inner join product_image c on c.product_id=b.product_id inner join product_general_info d on d.product_id=b.product_id inner join order_info e on e.order_id=a.order_id where a.order_id='$v_orderid'  ");
									$row_reurn_product_info=$query_reurn_product_info->result();
									//$image=explode(',',$row_reurn_product_info[0]->imag);
									
									$rtorder_id=$v_orderid;
									
									//$image_name=$image[0]; //image name
									//$prd_name=$row_reurn_product_info[0]->prd_name;
									//$prd_qnt=$row_reurn_product_info[0]->quantity;
									$prd_totamnt=$row_reurn_product_info[0]->Total_amount;
								
											
														$user_id = $row_reurn_product_info[0]->user_id;
														$mail_query1=$this->db->query("select * from user where user_id='$user_id' ");
														$mail_row1=$mail_query1->row();
														$email1=$mail_row1->email;
														$message1 = "
																 <html>
											<head>					
											<title></title>
											<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
											</head>					
											<body style='background-color:#fabd2f; font-family:'Calibri',Arial, Helvetica, sans-serif;'>
											
											<table width='600' cellspacing='0' align='center'>
											<tr> <td style='text-align:right; color:#e8442b;font-weight:bold; font-size:14px;'> 
											Call us :  <span style='color:#fff;'> 917874460000  </span><br>
											Email :   <span style='color:#fff;'> ".SELLER_MAIL." </span> 
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
											 <p> <strong style='font-size:16px;'>Dear ".$mail_row1->fname." ,</strong> <br /><br />
											
											<span style='color:#e25a0c; font-weight:bold;'> Order No.: ".$rtorder_id."</span> <br /> <br />
											
											This Order cancelled .
											
											
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
											</html>";
									
									
										//$html=$this->load->view('admin/order_slip',$rtorder_id, true) ;
//										$this->load->helper(array('dompdf/dompdf_helper', 'file'));
										//pdf_create($html, 'order_Slip');
										
										
										$this->email->set_mailtype("html");
										$this->email->from(NO_REPLY_MAIL, DOMAIN_NAME);
										$this->email->to($email1);
										$this->email->subject('Ordered Product Cancellled');
										$this->email->message($message1);
										// $this->email->attach(pdf_create($html, 'order_Slip'));
										$this->email->send();
									
									
									
								}	
						
					//multiple time email send end froeach
					}//if condition end
					
					
					
					if($order_status=='Delivered'){					
								foreach($ordrid_arr as $k=>$v_orderid)	
								
								//multiple time email send start froeach
								{
									
									$query_reurn_product_info=$this->db->query("select c.imag,d.name as prd_name, a.quantity, a.sub_total_amount,a.user_id,e.Total_amount from  ordered_product_from_addtocart a inner join product_master b on a.sku=b.sku inner join product_image c on c.product_id=b.product_id inner join product_general_info d on d.product_id=b.product_id inner join order_info e on e.order_id=a.order_id where a.order_id='$v_orderid'  ");
									$row_reurn_product_info=$query_reurn_product_info->result();
									//$image=explode(',',$row_reurn_product_info[0]->imag);
									
									$rtorder_id=$v_orderid;
									
									//$image_name=$image[0]; //image name
									//$prd_name=$row_reurn_product_info[0]->prd_name;
									//$prd_qnt=$row_reurn_product_info[0]->quantity;
									$prd_totamnt=$row_reurn_product_info[0]->Total_amount;
								
											
														$user_id = $row_reurn_product_info[0]->user_id;
														$mail_query1=$this->db->query("select * from user where user_id='$user_id' ");
														$mail_row1=$mail_query1->row();
														$email1=$mail_row1->email;
													$cart['order_id']=$rtorder_id;
													$cart['user_id']=$user_id;
							
													$this->email->set_mailtype("html");
													$this->email->from(NO_REPLY_MAIL, DOMAIN_NAME);
													$this->email->to($email1);
													$this->email->subject('Your '.DOMAIN_NAME.' Order-'. $rtorder_id.' Delivered !!!');
													$this->email->message($this->load->view('email_template/order_delivered',$cart,true));
													$this->email->send();
													
													
													date_default_timezone_set('Asia/Calcutta');
													$dt = date('Y-m-d H:i:s');
												
													$msg=$this->load->view('email_template/order_delivered',$cart,true);
													if($this->email->send()){
														
														$email_data=array(
														'to_email_id'=>$email1,
														'from_email_id'=>NO_REPLY_MAIL,
														'date'=>$dt,
														'email_sub'=>'Your '.DOMAIN_NAME.' Order-'. $rtorder_id.' Delivered !!!',
														'email_content'=>$msg,
														'email_send_status'=>'Success'
														);
													}else
													{
														
														$email_data=array(
														'to_email_id'=>$email1,
														'from_email_id'=>NO_REPLY_MAIL,
														'date'=>$dt,
														'email_sub'=>'Your'.DOMAIN_NAME.' Order-'. $rtorder_id.' Delivered !!!',
														'email_content'=>$msg,
														'email_send_status'=>'Failure'
														);
													}
													$this->db->insert('email_log',$email_data);	
												
									
									
								}	
						
					//multiple time email send end for order delivered
					}//if condition end
			
		}
		
		
		function delete_order()
		{
			$order_id =$this->input->post('orderid');
			
			$data = array(
				'order_status' => 'Cancelled',
				'cancelled_by'=>'Admin'
			);
			
			$data1 = array(
				'product_order_status' => 'Cancelled',
			);
			
			$this->db->where('order_id',$order_id);
			$this->db->update('order_info',$data);
			if($this->db->affected_rows() > 0){
				$this->db->where('order_id',$order_id);
				$this->db->update('ordered_product_from_addtocart',$data1);
				if($this->db->affected_rows() > 0){
					//program start for quantity increment in inventory//
					$query = $this->db->query("SELECT * FROM ordered_product_from_addtocart WHERE order_id='$order_id'");
					foreach($query->result() as $order_row){
						$sku_arr[] = $order_row->sku;
						$qty_arr[] = $order_row->quantity;
					}
					$sku_qty_arr = array_combine($sku_arr,$qty_arr);
					foreach($sku_qty_arr as $k=>$v){
						//program start for checking sku in products table and update quantity//
						$query = $this->db->query("SELECT quantity FROM product_master WHERE sku='$k'");
						$result = $query->result();
						$quantity = $result[0]->quantity;
						$total_qty = $quantity+$v;
						$qty_data = array('quantity' => $total_qty);
						$this->db->where('sku',$k);
						$this->db->update('product_master',$qty_data);
					
						//quantity update in seller product table start here//
						$query1 = $this->db->query("SELECT * FROM seller_product_master WHERE sku='$k'");
						if($query1->num_rows() > 0){
							$this->db->where('sku',$k);
							$this->db->update('seller_product_master',$qty_data);
						}else{
							$query2 = $this->db->query("SELECT * FROM seller_product_general_info WHERE sku='$k'");
							if($query2->num_rows() > 0){
								$result3 = $query2->result();
								$slr_prdt_id = $result3[0]->seller_product_id;
								$this->db->where('seller_product_id',$slr_prdt_id);
								$this->db->update('seller_product_inventory_info',$qty_data);
							}
						}
						//quantity update in seller product table end here//
						//program end of checking sku in products table and update quantity//
					}
				//program end of quantity increment in inventory//
				}
				//order_status_log start
					$order_log_status='admin_cancel_date';
					$this->update_orderstatus_log($order_id,$order_log_status);
				//order_status_log end
				return true;
			}
		}
		
		
		function delete_order_log()
		{
			$order_id =$this->input->post('orderid');
			
			date_default_timezone_set('Asia/Calcutta');
			$cdate =date('y-m-d H:i:s');
			$uid= $this->session->userdata('logged_userrole_id');
			$uname=$this->session->userdata('logged_in');
			$log_data="This Order(".$order_id.") has cancelled in Orders panel";
				$data=array(
							
							'log_detail'=>$log_data,
							'user_id'=>$uid,
							'user_name'=>$uname,
							'log_datetime'=>$cdate
						);
						$this->db->insert('user_log',$data);	
		}
		
		function mail_delete_order()
		{
			$order_id =$this->input->post('orderid');
			
			//email for cancellation of ordered product start
		
		$query_reurn_product_info=$this->db->query("select c.imag,d.name as prd_name, a.quantity, a.sub_total_amount,a.user_id,e.Total_amount from  ordered_product_from_addtocart a inner join product_master b on a.sku=b.sku inner join product_image c on c.product_id=b.product_id inner join product_general_info d on d.product_id=b.product_id inner join order_info e on e.order_id=a.order_id where a.order_id='$order_id'  ");
			$row_reurn_product_info=$query_reurn_product_info->result();
			//$image=explode(',',$row_reurn_product_info[0]->imag);
			
			$rtorder_id=$order_id;
			$data['rtorder_id']=$rtorder_id;
			//$image_name=$image[0]; //image name
			//$prd_name=$row_reurn_product_info[0]->prd_name;
			//$prd_qnt=$row_reurn_product_info[0]->quantity;
			$prd_totamnt=$row_reurn_product_info[0]->Total_amount;
		
				 	
								$user_id = $row_reurn_product_info[0]->user_id;
								$mail_query1=$this->db->query("select * from user where user_id='$user_id' ");
								$mail_row1=$mail_query1->row();
								$email1=$mail_row1->email;
								$fname1=$mail_row1->fname;
								$data['email1']=$email1;
								$data['fname1']=$fname1;
								$this->email->set_mailtype("html");
				$this->email->from(NO_REPLY_MAIL, DOMAIN_NAME);
				$this->email->to($email1);
				$this->email->subject('Ordered Product Cancellled');
				$this->email->message($this->load->view('email_template/ordercancel_admin',$data,true));
				//$this->email->message($message1);
				$this->email->send();
				
				//email for cancellation of ordered product end
			
			
		}
		
		function check_invoice_id($order_id){
			$query = $this->db->query("SELECT invoice_id FROM order_info WHERE order_id='$order_id'");
			$result = $query->result();
			$invoice_id = $result[0]->invoice_id;
			if($invoice_id == ''){
				return true;
			}else{
				return false;
			}
		}
		
		function select_filter_orders_count(){
				$orderid = $_REQUEST['order_id'];	
				$custname = $_REQUEST['customer_name'];
				$orderstat = $_REQUEST['order_status1'];	
				$orderdate = $_REQUEST['order_date_from'];
				$orderdateto = $_REQUEST['order_date_to'];
				$orderstatmod = $_REQUEST['status_modified_from'];
				$orderstatmodto = $_REQUEST['status_modified_to'];
				$tot_amount = $_REQUEST['tot_amount'];
				$order_approve = $_REQUEST['order_status'];
				$condition = "";
				
				if($orderid != ""){
				$condition .= " a.order_id='$orderid' " ;
				$query=$this->db->query("select a.order_id from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id where ".$condition." group by b.order_id order by a.id desc");
						return $query->num_rows();
					}
				if( $custname != "" ){
					 	$condition .= "c.full_name LIKE '%$custname%'" ;
						//echo $sql="select a.order_id from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id where ".$condition." group by b.order_id order by a.id desc";
						$query=$this->db->query("select a.order_id from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id where ".$condition." group by b.order_id order by a.id desc");
						//echo $query->num_rows();
						return $query->num_rows();
					}
				if( $orderstat != "" ){
					 	$condition .= "a.order_status='$orderstat'" ;
						$query=$this->db->query("select a.order_id from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id where ".$condition." group by b.order_id order by a.id desc");
						return $query->num_rows();
					}
				if( $tot_amount !='' ){
				  		$condition .= "b.sub_total_amount='$tot_amount'" ;
						$query=$this->db->query("select a.order_id from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id where ".$condition." group by b.order_id order by a.id desc");
						return $query->num_rows();
					}
				if($orderdate!='' && $orderdateto!='' ){
						$condition .= "DATE(a.date_of_order) between '$orderdate' and '$orderdateto'" ;
						$query=$this->db->query("select a.order_id from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id where ".$condition." group by b.order_id order by a.id desc");
						return $query->num_rows();
					}
				if($orderstatmod != '' && $orderstatmodto != ''){
					$condition .= "DATE(a.order_status_modified_date) between '$orderstatmod' and '$orderstatmodto'" ;
					$query=$this->db->query("select a.order_id from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id where ".$condition." group by b.order_id order by a.id desc");
						return $query->num_rows();	
					}
				if($order_approve != ''){
						$condition .= "a.order_confirm_for_seller = '$order_approve'" ;
						
						$query=$this->db->query("select a.order_id from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id where ".$condition." group by b.order_id order by a.id desc");
						return $query->num_rows();
					}
				if($condition == ""){
					$query=$this->db->query("select a.order_id from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id group by b.order_id order by a.id desc");
					return $query->num_rows();
					}
				}
		
		function select_filtered_orders($limit,$start)
		{
			
			$order_id = $_REQUEST['order_id'];
			$customer_name = $_REQUEST['customer_name'];
			$cus_name=substr($customer_name,0,strpos($customer_name,' '));
			$order_status = $_REQUEST['order_status1'];	
			$tot_amount =$_REQUEST['tot_amount'];
			$order_date_from = $_REQUEST['order_date_from'];
			$order_date_to = $_REQUEST['order_date_to'];
			$status_modified_from = $_REQUEST['status_modified_from'];
			$status_modified_to = $_REQUEST['status_modified_to'];
			$order_approve = $_REQUEST['order_status'];
			
			$condition = '';
			
			if( $order_id!='' ){
				
				$condition .= " a.order_id='$order_id' " ;
				$query=$this->db->query("select a.order_confirm_for_seller,a.order_id, a.order_status, a.Total_amount as sub_total_amount, a.date_of_order, a.order_status_modified_date,a.order_confirm_for_seller,a.invoice_id,a.cancelled_by,a.grace_period_approve_status,a.grace_period,a.order_processstatus,a.payment_mode,b.seller_id,c.full_name from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id where ".$condition." group by b.order_id order by a.id desc LIMIT ".$start.", ".$limit."");
			return $query;
				
			}
			if($customer_name!=''){
				$condition .= "c.full_name LIKE '%$customer_name%'" ;
				//echo $sql ="select a.order_confirm_for_seller,a.order_id, a.order_status, a.Total_amount as sub_total_amount, a.date_of_order, a.order_status_modified_date,a.order_confirm_for_seller,a.invoice_id,a.cancelled_by,a.grace_period_approve_status,a.grace_period,b.seller_id,c.full_name from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id where ".$condition." group by b.order_id order by a.id desc LIMIT ".$start.", ".$limit."";
				$query=$this->db->query("select a.order_confirm_for_seller,a.order_id, a.order_status, a.Total_amount as sub_total_amount, a.date_of_order, a.order_status_modified_date,a.order_confirm_for_seller,a.invoice_id,a.cancelled_by,a.grace_period_approve_status,a.grace_period,a.order_processstatus,a.payment_mode,b.seller_id,c.full_name from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id where ".$condition." group by b.order_id order by a.id desc LIMIT ".$start.", ".$limit."");
			return $query;
			}
			
			if( $order_status!='' ){
				
				$condition .= "a.order_status='$order_status'" ;
				$query=$this->db->query("select a.order_confirm_for_seller,a.order_id, a.order_status, a.Total_amount as sub_total_amount, a.date_of_order, a.order_status_modified_date,a.order_confirm_for_seller,a.invoice_id,a.cancelled_by,a.grace_period_approve_status,a.grace_period,a.order_processstatus,a.payment_mode,b.seller_id,c.full_name from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id where ".$condition." group by b.order_id order by a.id desc LIMIT ".$start.", ".$limit."");
			return $query;
			}
			
			if(  $tot_amount!='' ){
				
				$condition .= "b.sub_total_amount='$tot_amount'" ;
				$query=$this->db->query("select a.order_confirm_for_seller,a.order_id, a.order_status, a.Total_amount as sub_total_amount, a.date_of_order, a.order_status_modified_date,a.order_confirm_for_seller,a.invoice_id,a.cancelled_by,a.grace_period_approve_status,a.grace_period,a.order_processstatus,a.payment_mode,b.seller_id,c.full_name from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id where ".$condition." group by b.order_id order by a.id desc LIMIT ".$start.", ".$limit."");
			return $query;
			}
			
			if($order_date_from!='' && $order_date_to!=''){
				
				$query=$this->db->query("select a.order_confirm_for_seller,a.order_id, a.order_status, a.Total_amount as sub_total_amount, a.date_of_order, a.order_status_modified_date,a.order_confirm_for_seller,a.invoice_id,a.cancelled_by,a.grace_period_approve_status,a.grace_period,a.order_processstatus,a.payment_mode,b.seller_id,c.full_name from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id where DATE(a.date_of_order) between '$order_date_from' and '$order_date_to' group by b.order_id order by a.id desc LIMIT ".$start.", ".$limit."");
				return  $query;
			}
			
			if($status_modified_from != '' && $status_modified_to != '' ){
			
				$query=$this->db->query("select a.order_confirm_for_seller,a.order_id, a.order_status, a.Total_amount as sub_total_amount, a.date_of_order, a.order_status_modified_date,a.order_confirm_for_seller,a.invoice_id,a.cancelled_by,a.grace_period_approve_status,a.grace_period,a.order_processstatus,a.payment_mode,b.seller_id,c.full_name from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id where DATE(a.order_status_modified_date) between '$status_modified_from' and '$status_modified_to' group by b.order_id order by a.id desc LIMIT ".$start.", ".$limit."");
				return  $query;
			}
			if($order_approve != ''){
				$query=$this->db->query("select a.order_confirm_for_seller,a.order_id, a.order_status, a.Total_amount as sub_total_amount, a.date_of_order, a.order_status_modified_date,a.order_confirm_for_seller,a.invoice_id,a.cancelled_by,a.grace_period_approve_status,a.grace_period,a.order_processstatus,a.payment_mode,b.seller_id,c.full_name from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id where a.order_confirm_for_seller = '$order_approve' group by b.order_id order by a.id desc LIMIT ".$start.", ".$limit."");
				return  $query;
				}
			
			if( $condition == ''  ){
				
				$query=$this->db->query("select a.order_confirm_for_seller,a.order_id, a.order_status, a.Total_amount as sub_total_amount, a.date_of_order, a.order_status_modified_date,a.order_confirm_for_seller,a.invoice_id,a.cancelled_by,a.grace_period_approve_status,a.grace_period,a.order_processstatus,a.payment_mode,b.seller_id,c.full_name from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id group by b.order_id order by a.id desc LIMIT ".$start.", ".$limit."");
				return  $query;
			}
			/*
			$query=$this->db->query("select a.order_confirm_for_seller,a.order_id, a.order_status, a.Total_amount as sub_total_amount, a.date_of_order, a.order_status_modified_date,a.order_confirm_for_seller,a.invoice_id,a.cancelled_by,a.grace_period_approve_status,a.grace_period,b.seller_id,c.full_name from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join shipping_address c on a.order_id=c.order_id where ".$condition." group by b.order_id order by a.id desc LIMIT ".$start.", ".$limit."");
			return $query;*/
		}
		
		function insert_shipment_info()
		{
			$shipment_id=$this->get_unique_id('shipment_info','shipment_id');
			
			date_default_timezone_set('Asia/Calcutta');
			$shpping_date = date('Y-m-d H:i:s');
			
			$order_id=$this->input->post('txtbox_order_no');
			$shipment_no=$this->input->post('txtbox_shipment_number');
			$courier_name=$this->input->post('courier_name');
			$tracking_number=$this->input->post('tracking_number');
			
			$data=array(
			'shipment_id'=>$shipment_id,
			'shipment_no'=>$shipment_no,
			'order_id'=>$order_id,
			'shipping_date'=>$shpping_date,
			'courier_name'=>$courier_name,
			'tracking_no'=>$tracking_number
			);
			
			$this->db->insert('shipment_info',$data); 
			$query1=$this->db->query("update order_info set order_status='Shipped',order_accept_by_seller='Accepted', order_status_modified_date='$shpping_date' where order_id='$order_id'");
			
			$query2=$this->db->query("update ordered_product_from_addtocart set product_order_status='Shipped' where order_id='$order_id'  ");
			
			//Order Status log start
			
			$order_log_status='shipping_date';
			$this->update_orderstatus_log($order_id,$order_log_status);
						
			////Order Status log end
			
			
			return true;
		}
		
		function retrieve_order_shipment_details($order_id){
			$query = $this->db->query("SELECT a.name,b.user_id,b.sub_total_amount,b.quantity,b.sub_shipping_fees FROM product_general_info a INNER JOIN product_master c ON a.product_id=c.product_id INNER JOIN ordered_product_from_addtocart b ON c.sku=b.sku WHERE b.order_id='$order_id'");
			return $query->result();
		}
		
		function retrieve_order_shipment_address($order_id){
			$sql = $this->db->query("SELECT distinct user_id FROM ordered_product_from_addtocart WHERE order_id='$order_id'");
			$res = $sql->result();
			$user_id = $res[0]->user_id;
			$query = $this->db->query("SELECT a.*,b.fname,b.user_id,b.lname,b.email,c.state AS STS FROM user_address a INNER JOIN user b ON a.address_id=b.address_id INNER JOIN state c ON a.state=c.state_id WHERE a.user_id='$user_id'");
			return $query->row();
		}
		
		function retrieve_order_total_amount($order_id){
			$query = $this->db->query("SELECT Total_amount FROM order_info WHERE order_id='$order_id'");
			return $query->row();
		}
		
		function retrieve_slr_qty_data($order_id){
			$query = $this->db->query("SELECT a.business_name, SUM( b.quantity ) AS total_qty
FROM seller_account_information a
INNER JOIN ordered_product_from_addtocart b ON a.seller_id = b.seller_id
WHERE b.order_id = '$order_id'
GROUP BY b.order_id");
			return $query->row();
		}
		
		function set_status_as_undelivered($order_id)
		{
			$query=$this->db->query("update order_info set order_status='Undelivered' where order_id='$order_id'");
		}
		
		function confirm_order_by_admin()
		{
			$order_id=$this->input->post('orderid');
			date_default_timezone_set('Asia/Calcutta');
			$dt = date('Y-m-d H:i:s');
			$query1=$this->db->query("update order_info set order_status='Order confirmed',order_confirm_for_seller='Approved',order_confirm_for_seller_date='$dt' where order_id='$order_id'   ");
			$query2=$this->db->query("update ordered_product_from_addtocart set product_order_status='Order confirmed' where order_id='$order_id'   ");
			
			//------------------------------------email start------------------------------------------------
			
					$rder_query=$this->db->query("select a.user_id,b.pemail,b.business_name from ordered_product_from_addtocart a INNER JOIN seller_account_information b 
				ON a.seller_id=b.seller_id where a.order_id='$order_id' group by a.order_id");
				$rw_order=$rder_query->row();
				
										$cart['order_id']=$order_id;
										$cart['user_id']=$rw_order->user_id;
										$cart['slr_name']=$rw_order->business_name;
														   
										$this->email->set_mailtype("html");
										$this->email->from(SELLER_MAIL, DOMAIN_NAME);
										$this->email->to($rw_order->pemail);
										//$this->email->to('sisir@paramountitsolutions.co.in');
										$this->email->subject('New Order Received –' .$order_id);
										$this->email->message($this->load->view('email_template/order_recived_seller',$cart,true));
										//$this->email->message($message1);
										 //$this->email->attach(pdf_create($html, 'order_Slip'));
										//$this->load->view('email_template/order_recived_seller',$cart,true);
										$this->email->send();	
										
										
										date_default_timezone_set('Asia/Calcutta');
										$dt = date('Y-m-d H:i:s');
									
										$msg=$this->load->view('email_template/order_recived_seller',$cart,true);
										if($this->email->send()){
											
											$email_data=array(
											'to_email_id'=>$rw_order->pemail,
											'from_email_id'=>SELLER_MAIL,
											'date'=>$dt,
											'email_sub'=>'New Order Received –' .$order_id,
											'email_content'=>$msg,
											'email_send_status'=>'Success'
											);
										}else
										{
											
											$email_data=array(
											'to_email_id'=>$rw_order->pemail,
											'from_email_id'=>SELLER_MAIL,
											'date'=>$dt,
											'email_sub'=>'New Order Received –' .$order_id,
											'email_content'=>$msg,
											'email_send_status'=>'Failure'
											);
										}
										$this->db->insert('email_log',$email_data);	
				
			
			
			//-------------------------------------email end-------------------------------------------------
			
			$order_log_status='order_approved_date';
			$this->update_orderstatus_log($order_id,$order_log_status);
		}
		
		function confirm_order_by_admin_log()
		{
			$order_id=$this->input->post('orderid');
			date_default_timezone_set('Asia/Calcutta');
			$cdate =date('y-m-d H:i:s');
			$uid= $this->session->userdata('logged_userrole_id');
			$uname=$this->session->userdata('logged_in');
			$log_data="Order has confirmed for seller of order Id: ".$order_id;
			$data=array(
						'log_detail'=>$log_data,
						'user_id'=>$uid,
						'user_name'=>$uname,
						'log_datetime'=>$cdate
					);
			$this->db->insert('user_log',$data);
		}
		
		
		function hold_order_by_admin()
		{
			$order_id=$this->input->post('orderid');
			date_default_timezone_set('Asia/Calcutta');
			$dt = date('Y-m-d H:i:s');
			$query1=$this->db->query("update order_info set order_status='Processing',order_confirm_for_seller='Not Approved',order_confirm_for_seller_date='0000-00-00 00:00:00',order_accept_by_seller='Not Accepted' where order_id='$order_id'   ");
			
			$query2=$this->db->query("update ordered_product_from_addtocart set product_order_status='Processing' where order_id='$order_id'   ");
			
			$order_log_status='order_not_approved_date';
			$this->update_orderstatus_log($order_id,$order_log_status);
		}
		
		
		function hold_order_by_admin_log()
		{
			$order_id=$this->input->post('orderid');
			date_default_timezone_set('Asia/Calcutta');
			$cdate =date('y-m-d H:i:s');
			$uid= $this->session->userdata('logged_userrole_id');
			$uname=$this->session->userdata('logged_in');
			$log_data="This Order(".$order_id.") has set as hold mode ";
				$data=array(							
							'log_detail'=>$log_data,
							'user_id'=>$uid,
							'user_name'=>$uname,
							'log_datetime'=>$cdate
						);
			$this->db->insert('user_log',$data);
		}
		
		function select_penalty_list()
		{
			$query=$this->db->query("select * from penalty_seller_order where penalty_paid_status ");
			return $query;
		}
		
		//function view_penaltypaid_list()
//		{
//			$query=$this->db->query("select * from penalty_seller_order  ");
//			return $query;
//			
//		}
		function view_penaltypaid_list()
		{
			$query=$this->db->query("select a.*,b.charges_type,c.name from penalty_seller_order a inner join charges_master b on a.penalty_type_id=b.cat_id inner join seller_account c on a.seller_id=c.seller_id   ");
			return $query;
			
		}
		
		
		
		function penalty_data_insert()
		{
			
		//
//			$query = $this->db->query("SELECT a.order_confirm_for_seller,a.date_of_order,a.order_status,b.quantity,a.invoice_id,b.order_id,
//			b.sku,b.sub_tax_rate,b.sub_shipping_fees,b.sub_total_amount,c.seller_id,c.price,d.name,e.imag,g.*,h.state,f.user_id,i.payment_type,k.dispatch_days
//			FROM order_info a
//			INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id
//			INNER JOIN product_master c ON b.sku = c.sku
//			INNER JOIN product_general_info d ON c.product_id = d.product_id
//			INNER JOIN product_image e ON c.product_id = e.product_id
//			INNER JOIN user f ON b.user_id = f.user_id
//			INNER JOIN user_address g ON f.address_id = g.address_id
//			INNER JOIN state h ON g.state = h.state_id
//			INNER JOIN payment_info i on i.payment_mode_id= a.payment_mode 
//			INNER JOIN dispatched_day_setting k on k.state_id=h.state_id
//			WHERE  (a.order_status='Pending payment' OR a.order_status='Processing' OR a.order_status='Failed' OR a.order_status='Order confirmed' OR a.order_status='Ready to shipped' OR a.order_status='Cancelled') AND a.order_confirm_for_seller_date!='0000-00-00 00:00:00'
//			GROUP BY b.order_id ORDER BY a.date_of_order DESC");
			
			
			$query = $this->db->query("SELECT a.order_id, b.seller_id
			FROM order_info a
			INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id
			
			WHERE  (a.order_status='Pending payment' OR a.order_status='Processing' OR a.order_status='Failed' OR a.order_status='Order confirmed' OR a.order_status='Ready to shipped' OR a.order_status='Cancelled') AND a.order_confirm_for_seller_date!='0000-00-00 00:00:00'
			GROUP BY b.order_id ORDER BY a.date_of_order DESC");
			
			
			$row = $query->num_rows();
		
		//inner data for order start
		if($row > 0){
			
			$new_orders_as_per_orderid=$query->result();
			
			foreach($new_orders_as_per_orderid as $row_as_orderid) { 
										$seller_id = $new_orders_as_per_orderid[0]->seller_id;
										
										$qrs=$this->db->query("SELECT a.order_confirm_for_seller,a.order_confirm_for_seller_date,a.order_id_payment_gateway, a.date_of_order,a.order_status,a.Total_amount,a.grace_period_approve_status,a.order_cancel_by_seller,a.grace_period_approve_status,a.grace_period,
										b.quantity,b.order_id,b.sku,b.sub_tax_rate,b.sub_shipping_fees,b.sub_total_amount,c.seller_id,c.price,d.name,e.imag,g.*,h.state,f.user_id,i.payment_type,k.dispatch_days
										FROM order_info a
										INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id
										INNER JOIN product_master c ON b.sku = c.sku
										INNER JOIN product_general_info d ON c.product_id = d.product_id
										INNER JOIN product_image e ON c.product_id = e.product_id
										INNER JOIN user f ON b.user_id = f.user_id
										INNER JOIN user_address g ON f.address_id = g.address_id
										INNER JOIN state h ON g.state = h.state_id
										INNER JOIN payment_info i on i.payment_mode_id= a.payment_mode 
										INNER JOIN dispatched_day_setting k on k.state_id=h.state_id
										
										WHERE b.order_id='$row_as_orderid->order_id' AND  (a.order_status='Pending payment' OR a.order_status='Processing' OR                  	                                         a.order_status='Failed' OR a.order_status='Order confirmed' OR a.order_status='Ready to shipped' OR a.order_status='Cancelled')
										GROUP BY b.order_id, b.sku ORDER BY a.date_of_order DESC");
										
										$row_as_product=$qrs->result();
										
										date_default_timezone_set('Asia/Calcutta');
										
										$date1 = date('y-m-d h:i:s');
										
										
										if($row_as_product[0]->grace_period_approve_status=='Not Approved' )
										{
											$day_after_dispatchdays=date('y-m-d h:i:s' ,strtotime($row_as_product[0]->order_confirm_for_seller_date.'+'. $row_as_product[0]->dispatch_days .'day'));	
										}else
										{
											$dispatch_days=$row_as_product[0]->dispatch_days + $row_as_product[0]->grace_period;
											$day_after_dispatchdays=date('y-m-d h:i:s' ,strtotime($row_as_product[0]->order_confirm_for_seller_date.'+'. $dispatch_days .'day'));			
										}
									
										
									$order_ids=$row_as_product[0]->order_id;					 
							//shipment delay penalty start
								 if($date1 > $day_after_dispatchdays  ){
									 
									
								$query_select_penaltydata=	$this->db->query("select * from penalty_seller_order where order_id='$order_ids' ");
								
								if($query_select_penaltydata->num_rows()==0)
								{
									$this->sipment_delay_count($order_ids);
									
									$query_select_charges=$this->db->query("select * from charges_master where id=7 and cat_id=5 and charges_type='Order Shipping Delay'  ");
									
									$row_select_charges=$query_select_charges->row();
									
									//data from transaction table for access of different types of charges start
									
									$query_transaction_select=$this->db->query("select * from transaction where order_no='$order_ids' and status='Active' ");
									$row_transaction_select=$query_transaction_select->result();
									
									$fixed_chgs=0;
									$season_chgs=0;
									$pg_chgs=0;
									$commission=0;
									$service_tax=0;
									
									foreach($row_transaction_select as $res_trans)
									{
										$fixed_chgs=$fixed_chgs+$res_trans->fixed_chgs;
										$season_chgs=$season_chgs+$res_trans->season_chgs;
										$pg_chgs=$pg_chgs+$res_trans->pg_chgs;
										$commission=$commission+$res_trans->commission;
										$service_tax=$service_tax+$res_trans->service_tax;	
											
									}
									$tot_charges=$fixed_chgs+$season_chgs+$pg_chgs+$commission+$service_tax;
									//data from transaction table for access of different types of charges end
									
									
									$penalty_charge=round(($tot_charges/100)*$row_select_charges->percent);
									
									$data_penalty=array(
										'order_id'=>$order_ids,
										'seller_id'=>$row_as_product[0]->seller_id,
										'penalty_type_id'=>$row_select_charges->cat_id,
										'penalty_charges'=>$penalty_charge,
										'penalty_date'=>$date1,
										'ordered_amount'=>$row_as_product[0]->Total_amount,
										'penalty_pecentages'=>$row_select_charges->percent
									
									);
									
									$this->db->insert('penalty_seller_order',$data_penalty);
									$this->db->query("update transaction set penalty='$penalty_charge' where order_no='$order_ids'");
										
								}
									 
								 }
						//shipment delay penalty end
						
						//cancel order penalty start
						
								 //if($row_as_product[0]->order_cancel_by_seller=='yes') {
//									 
//									
//								$query_select_penaltydata=	$this->db->query("select * from penalty_seller_order where order_id='$order_ids' ");
//								
//								if($query_select_penaltydata->num_rows()==0)
//								{
//									$this->sipment_delay_count($order_ids);
//									
//									$query_select_charges=$this->db->query("select * from charges_master where id=5 and cat_id=3 and charges_type='Order Cancel Penalty'  ");
//									
//									$row_select_charges=$query_select_charges->row();
//									
//									//data from transaction table for access of different types of charges start
//									
//									$query_transaction_select=$this->db->query("select * from transaction where order_no='$order_ids' and status='Active' ");
//									$row_transaction_select=$query_transaction_select->result();
//									
//									$fixed_chgs=0;
//									$season_chgs=0;
//									$pg_chgs=0;
//									$commission=0;
//									$service_tax=0;
//									
//									foreach($row_transaction_select as $res_trans)
//									{
//										$fixed_chgs=$fixed_chgs+$res_trans->fixed_chgs;
//										$season_chgs=$season_chgs+$res_trans->season_chgs;
//										$pg_chgs=$pg_chgs+$res_trans->pg_chgs;
//										$commission=$commission+$res_trans->commission;
//										$service_tax=$service_tax+$res_trans->service_tax;	
//											
//									}
//									$tot_charges=$fixed_chgs+$season_chgs+$pg_chgs+$commission+$service_tax;
//									
//									//data from transaction table for access of different types of charges end
//									
//									$penalty_charge=round(($tot_charges/100)*$row_select_charges->percent);
//
//									
//									$data_penalty=array(
//										'order_id'=>$order_ids,
//										'seller_id'=>$row_as_product[0]->seller_id,
//										'penalty_type_id'=>$row_select_charges->cat_id,
//										'penalty_charges'=>$penalty_charge,
//										'penalty_date'=>$date1,
//										'ordered_amount'=>$row_as_product[0]->Total_amount,
//										'penalty_pecentages'=>$row_select_charges->percent
//									
//									);
//									
//									$this->db->insert('penalty_seller_order',$data_penalty);
//								$this->db->query("update transaction set penalty='$penalty_charge' where order_no='$order_ids'");
//										
//								}
//									 
//								 }
						//cancel order penalty end	
						
						
						//Order not process penalty start
						
						if($row_as_product[0]->grace_period_approve_status=='Not Approved' )
								{
										$day_after_dispatchdays=date('y-m-d h:i:s' ,strtotime($row_as_product[0]->order_confirm_for_seller_date.'+ 3 day'));
								}else
								{
									$dispatch_days=$row_as_product[0]->dispatch_days + $row_as_product[0]->grace_period;
									$day_after_dispatchdays=date('y-m-d h:i:s' ,strtotime($row_as_product[0]->order_confirm_for_seller_date.'+'.$dispatch_days .'day'));			
									}
						
						
						//$day_after_dispatchdays=date('y-m-d h:i:s' ,strtotime($row_as_product[0]->order_confirm_for_seller_date.'+ 3 day'));
							
								 if( $date1 > $day_after_dispatchdays && $row_as_product[0]->order_status!='Ready to shipped'   && $row_as_product[0]->order_confirm_for_seller_date!='0000-00-00 00:00:00'  ){
									 
									
								$query_select_penaltydata=	$this->db->query("select * from penalty_seller_order where order_id='$order_ids' ");
								
								if($query_select_penaltydata->num_rows()==0)
								{
									$this->sipment_delay_count($order_ids);
									
									$query_select_charges=$this->db->query("select * from charges_master where id=6 and cat_id=4 and charges_type='Order Not Process'  ");
									
									$row_select_charges=$query_select_charges->row();
									
									//data from transaction table for access of different types of charges start
									$query_transaction_select=$this->db->query("select * from transaction where order_no='$order_ids' and status='Active' ");
									$row_transaction_select=$query_transaction_select->result();
									
									$fixed_chgs=0;
									$season_chgs=0;
									$pg_chgs=0;
									$commission=0;
									$service_tax=0;
									
									foreach($row_transaction_select as $res_trans)
									{
										$fixed_chgs=$fixed_chgs+$res_trans->fixed_chgs;
										$season_chgs=$season_chgs+$res_trans->season_chgs;
										$pg_chgs=$pg_chgs+$res_trans->pg_chgs;
										$commission=$commission+$res_trans->commission;
										$service_tax=$service_tax+$res_trans->service_tax;	
											
									}
									$tot_charges=$fixed_chgs+$season_chgs+$pg_chgs+$commission+$service_tax;
									//data from transaction table for access of different types of charges end
									
									
									$penalty_charge=round(($tot_charges/100)*$row_select_charges->percent);

									
									$data_penalty=array(
										'order_id'=>$order_ids,
										'seller_id'=>$row_as_product[0]->seller_id,
										'penalty_type_id'=>$row_select_charges->cat_id,
										'penalty_charges'=>$penalty_charge,
										'penalty_date'=>$date1,
										'ordered_amount'=>$row_as_product[0]->Total_amount,
										'penalty_pecentages'=>$row_select_charges->percent
									
									);
									
									$this->db->insert('penalty_seller_order',$data_penalty);
								$this->db->query("update transaction set penalty='$penalty_charge' where order_no='$order_ids'");
										
								}
									 
								 }
						//Order not process penalty end
								 
											 
				
			}
			
		
		} //inner data for order end
		//}//first if condition
//		}//first foreach

			
	}
	
	
	function sipment_delay_count($order_ids)
	{
		//shipment delay count insert in product_master start
			
			
		$ship_delayCount_query=$this->db->query("select b.* from ordered_product_from_addtocart a inner join product_master b on a.sku=b.sku  where a.order_id='$order_ids' ");
		$row_delayCount=$ship_delayCount_query->result();
		
		foreach($row_delayCount  as $res_delaycount)
		{
		  	$sku_id=$res_delaycount->sku;
			
			$prd_master_query=$this->db->query("select * from product_master where sku='$sku_id' ");	
			$row_prd_master=$prd_master_query->result();
			
			$updated_shipment_delay_count=$row_prd_master[0]->shipment_delay_count+1;
			
			$this->db->query("update product_master set shipment_delay_count='$updated_shipment_delay_count' where sku='$sku_id' ");
		}			
			
		//shipment delay count insert in product_master end		
			
	}
	
	
	
	function count_transfered_order()
	{
		$transferd_order_arr=array();
		
		//$query = $this->db->query("SELECT a.order_confirm_for_seller,a.date_of_order,a.order_status,b.quantity,a.invoice_id,b.order_id,
//		b.sku,b.sub_tax_rate,b.sub_shipping_fees,b.sub_total_amount,c.seller_id,c.price,d.name,e.imag,g.*,h.state,f.user_id,i.payment_type,k.dispatch_days
//		FROM order_info a
//		INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id
//		INNER JOIN product_master c ON b.sku = c.sku
//		INNER JOIN product_general_info d ON c.product_id = d.product_id
//		INNER JOIN product_image e ON c.product_id = e.product_id
//		INNER JOIN user f ON b.user_id = f.user_id
//		INNER JOIN user_address g ON f.address_id = g.address_id
//		INNER JOIN state h ON g.state = h.state_id
//		INNER JOIN payment_info i on i.payment_mode_id= a.payment_mode 
//		INNER JOIN dispatched_day_setting k on k.state_id=h.state_id
//		WHERE   (a.order_status='Pending payment' OR a.order_status='Processing' OR a.order_status='Failed' OR a.order_status='Order confirmed' OR a.order_status='Ready to shipped') AND a.order_confirm_for_seller_date!='0000-00-00 00:00:00'
//		GROUP BY b.order_id ORDER BY a.date_of_order DESC");

		
		$query = $this->db->query("SELECT b.order_id,c.seller_id
		FROM order_info a
		INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id
		
		INNER JOIN product_master c ON b.sku = c.sku		
		WHERE   (a.order_status='Pending payment' OR a.order_status='Processing' OR a.order_status='Failed' OR a.order_status='Order confirmed' OR a.order_status='Ready to shipped' OR a.order_status='Cancelled') AND a.order_confirm_for_seller_date!='0000-00-00 00:00:00'
		GROUP BY b.order_id ORDER BY a.date_of_order DESC");
		
		$row = $query->num_rows();
		
		//inner data for order start
		if($row > 0){
			
			$new_orders_as_per_orderid=$query->result();
			
			foreach($new_orders_as_per_orderid as $row_as_orderid) { 
										$seller_id = $new_orders_as_per_orderid[0]->seller_id;
										
										$qrs=$this->db->query("SELECT a.order_confirm_for_seller,a.order_confirm_for_seller_date,a.order_id_payment_gateway, a.date_of_order,a.order_status,a.Total_amount,a.grace_period_approve_status,a.grace_period,b.quantity,
										b.order_id,b.sku,b.sub_tax_rate,b.sub_shipping_fees,b.sub_total_amount,c.seller_id,c.price,d.name,e.imag,g.*,h.state,f.user_id,i.payment_type,k.dispatch_days
										FROM order_info a
										INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id
										INNER JOIN product_master c ON b.sku = c.sku
										INNER JOIN product_general_info d ON c.product_id = d.product_id
										INNER JOIN product_image e ON c.product_id = e.product_id
										INNER JOIN user f ON b.user_id = f.user_id
										INNER JOIN user_address g ON f.address_id = g.address_id
										INNER JOIN state h ON g.state = h.state_id
										INNER JOIN payment_info i on i.payment_mode_id= a.payment_mode 
										INNER JOIN dispatched_day_setting k on k.state_id=h.state_id
										
										WHERE b.order_id='$row_as_orderid->order_id' AND  (a.order_status='Pending payment' OR a.order_status='Processing' OR                  	                                         a.order_status='Failed' OR a.order_status='Order confirmed' OR a.order_status='Ready to shipped'
																OR a.order_status='Cancelled') 
										GROUP BY b.order_id, b.sku ORDER BY a.date_of_order DESC");
										
										$row_as_product=$qrs->result();
										
										date_default_timezone_set('Asia/Calcutta');
										
										$date1 = date('y-m-d h:i:s');
										
									//$day_after_dispatchdays=date('y-m-d h:i:s' ,strtotime($row_as_product[0]->order_confirm_for_seller_date.'+'.$row_as_product[0]->dispatch_days .'day'));
									if(@$row_as_product[0]->grace_period_approve_status=='Not Approved' )
										{
											$day_after_dispatchdays=date('y-m-d h:i:s' ,strtotime($row_as_product[0]->order_confirm_for_seller_date.'+'. $row_as_product[0]->dispatch_days .'day'));	
										}else
										{
										@$dispatch_days=$row_as_product[0]->dispatch_days + $row_as_product[0]->grace_period;
										@$day_after_dispatchdays=date('y-m-d h:i:s' ,strtotime($row_as_product[0]->order_confirm_for_seller_date.'+'. $dispatch_days .'day'));			
										}
									@$order_ids=$row_as_product[0]->order_id;					 
							
								 //if($date1 > $day_after_dispatchdays ){
									
									//$trans_query=$this->db-query("select * from order_transfer");
									
									 $transfer_orderno=array();
									$query_ordtrans=$this->db->query("select * from order_transfer ");
									$row_ordtrans=$query_ordtrans->result();
									foreach($row_ordtrans as $res_transorder)
									{
										array_push($transfer_orderno,$res_transorder->old_order_id);	
									}
									if(in_array($order_ids, $transfer_orderno)==false)
								 	{
									 
										array_push($transferd_order_arr,$order_ids);
									}
									 
								 //}
						//shipment delay penalty end
					
			}
		}
		
		return $transferd_order_arr;
			
	}
		
		
	function select_transOrder_relatedseller($trans_order_id,$seller_id_trans)
	{
			$Qrs_trans=$this->db->query("select a.user_id, a.quantity as cus_qantity,b.product_id,b.sku,b.mrp,b.price,b.special_price,b.shipping_fee_amount,b.stock_availability,b.approve_status,b.quantity,c.imag,d.business_name,e.name as seller_name,f.name from 
			ordered_product_from_addtocart a inner join product_master b on a.product_id = b.product_id 
			inner join product_image c on c.product_id = b.product_id inner join seller_account_information  d on d.seller_id=b.seller_id
			inner join seller_account e on e.seller_id=b.seller_id  
			inner join product_general_info f on b.product_id=f.product_id 
			where a.order_id='$trans_order_id' and e.status='Active' and b.approve_status='Active' and b.stock_availability='In Stock' and b.seller_id NOT IN('$seller_id_trans')   group by b.seller_id    ");
			
			
			//$Qrs_trans=$this->db->query("select a.user_id, a.quantity as cus_qantity,b.product_id,b.sku,b.mrp,b.price,b.special_price,b.shipping_fee_amount,b.stock_availability,b.approve_status,b.quantity,c.imag,d.business_name,e.name as seller_name,f.name from 
//			ordered_product_from_addtocart a inner join product_master b on a.product_id = b.product_id 
//			inner join product_image c on c.product_id = b.product_id inner join seller_account_information  d on d.seller_id=b.seller_id
//			inner join seller_account e on e.seller_id=b.seller_id  
//			inner join product_general_info f on b.product_id=f.product_id
//			inner join cornjob_productsearch g on g.name=f.name 
//			where a.order_id='$trans_order_id' and e.status='Active' and b.approve_status='Active' and b.stock_availability='In Stock' and b.seller_id NOT IN('$seller_id_trans') group by b.seller_id    ");
		

									  
			$row=$Qrs_trans->result();
			return $row;
		
		
	}
	
	
	
	
	
	function reassign_order_Toseller()
	{
		$order_id=$this->input->post('old_order_id');
		$order_id_amount=$this->input->post('ordered_mount');
		$seller_id_trans=implode(',',$this->input->post('assign_seller_radio'));
		
		$new_order_id=$order_id.$seller_id_trans;
		
		$order_id_arr=array();
		$qantity_arr=array();
		$sub_total_arr=array();
		$sku_arr=array();
		$seller_id_arr=array();
		$price_arr=array();
		$shipping_fees_arr=array();
		
		array_push($order_id_arr,$new_order_id);
		array_push($seller_id_arr,$seller_id_trans);
		array_push($price_arr,$order_id_amount);
		
		
			$query_order_addtocart=$this->db->query("select * from ordered_product_from_addtocart where order_id='$order_id' ");
		
			$row_order_addtocart=$query_order_addtocart->result();
			
			foreach($row_order_addtocart as $res_addtocart)
			{
				$addtocart_id=$this->get_unique_id('ordered_product_from_addtocart','addtocart_id');
				$addtocart_session_id=$res_addtocart->addtocart_session_id;
				$product_id=$res_addtocart->product_id;
				$user_id=$res_addtocart->user_id;
				$sku=$res_addtocart->sku;
				//$order_id=$new_order_id;
				$sub_tax_rate=$res_addtocart->sub_tax_rate;
				$sub_shipping_fees=$res_addtocart->sub_shipping_fees;
				$sub_total_amount=$res_addtocart->sub_total_amount;
				//$seller_id=$seller_id_trans;
				$quantity=$res_addtocart->quantity;
				$product_order_status=$res_addtocart->product_order_status;
				
				array_push($qantity_arr,$quantity);
				array_push($sub_total_arr,$sub_total_amount);
				array_push($sku_arr,$sku);
				array_push($shipping_fees_arr,$sub_shipping_fees);
				
				$data_addtocart=array(
				'addtocart_id'=>$addtocart_id,
				'addtocart_session_id'=>$addtocart_session_id,
				'product_id'=>$product_id,
				'user_id'=>$user_id,
				'sku'=>$sku,
				'order_id'=>$new_order_id,
				'sub_tax_rate'=>$sub_tax_rate,
				'sub_shipping_fees'=>$sub_shipping_fees,
				'sub_total_amount'=>$sub_total_amount,
				'seller_id'=>$seller_id_trans,
				'quantity'=>$quantity,
				'product_order_status'=>$product_order_status			
				
				);
				
				$this->db->insert('ordered_product_from_addtocart',$data_addtocart);					
					
			}
			
			$query_order_info1=$this->db->query("select * from order_info where order_id='$order_id' ");
		
			$row_order_info1=$query_order_info1->result();
			
			date_default_timezone_set('Asia/Calcutta');
			$new_orders_date = date('Y-m-d H:i:s');
			
			foreach($row_order_info1 as $res_orderinfo1)
			{
				$addtocart_id=$this->get_unique_id('order_info','order_track_id');
				//$order_id=$new_order_id;
				//$order_id_payment_gateway=$res_orderinfo->order_id_payment_gateway;
				//$invoice_id=$res_orderinfo->invoice_id;
				//$invoice_date=$res_orderinfo->invoice_date;
				$Total_amount=$res_orderinfo1->Total_amount;
				$payment_mode=$res_orderinfo1->payment_mode;
				$date_of_order=$new_orders_date;
				$order_status='Pending payment';
				//$order_status_modified_date=$res_orderinfo->order_status_modified_date;
				//$order_confirm_for_seller=$res_orderinfo->order_confirm_for_seller;
				//$order_confirm_for_seller_date=$res_orderinfo->order_confirm_for_seller_date;
				//$order_accept_by_seller=$res_orderinfo->order_accept_by_seller;
				
				
				$data_orderinfo=array(
				
				'order_track_id'=>$addtocart_id,
				'order_id'=>$new_order_id,
				'Total_amount'=>$Total_amount,
				'payment_mode'=>$payment_mode,
				'order_status'=>$order_status,
				'date_of_order'=>$date_of_order,
				'tranfer_new_total_amt'=>$order_id_amount
				
				);
				
				
				$this->db->insert('order_info',$data_orderinfo);	
				
			}
		
			
		
		$query_order_info=$this->db->query("select * from order_info where order_id='$order_id' ");
		
		$row_order_info=$query_order_info->row();
		
		if($row_order_info->payment_mode==2) 
		{
			$PG_order_ids=$row_order_info->order_id_payment_gateway;
			
			$query_order_info=$this->db->query("select *  from payment_by_ccavenue_info where order_id='$PG_order_ids' ");
		
			$row_order_info=$query_order_info->result();
			//print_r($row_order_info);exit;
			foreach($row_order_info as $res_ccav)
			{
		   
			
			$data_payment_ccaveneue=array(
			'order_id'=>$res_ccav->order_id.$seller_id_trans,
			'tracking_id'=>$res_ccav->tracking_id,
			'bank_ref_no'=>$res_ccav->bank_ref_no,
			'order_status'=>$res_ccav->order_status,
			'order_status'=>$res_ccav->order_status,
			'failure_message'=>$res_ccav->failure_message,
			'payment_mode'=>$res_ccav->payment_mode,
			'card_name'=>$res_ccav->card_name,
			'status_code'=>$res_ccav->status_code,
			'status_message'=>$res_ccav->status_message,
			'currency'=>$res_ccav->currency,
			'amount'=>$res_ccav->amount,
			'billing_name'=>$res_ccav->billing_name,
			'billing_address'=>$res_ccav->billing_address,
			'billing_city'=>$res_ccav->billing_city,
			'billing_state'=>$res_ccav->billing_state,
			'billing_zip'=>$res_ccav->billing_zip,
			'billing_country'=>$res_ccav->billing_country,
			'billing_tel'=>$res_ccav->billing_tel,
			'billing_email'=>$res_ccav->billing_email,
			'delivery_name'=>$res_ccav->delivery_name,
			'delivery_address'=>$res_ccav->delivery_address,
			'delivery_city'=>$res_ccav->delivery_city,
			'delivery_state'=>$res_ccav->delivery_state,
			'delivery_zip'=>$res_ccav->delivery_zip,
			'delivery_country'=>$res_ccav->delivery_country,
			'delivery_tel'=>$res_ccav->delivery_tel,
			'merchant_param1'=>$res_ccav->merchant_param1,
			'merchant_param2'=>$res_ccav->merchant_param2,
			'merchant_param3'=>$res_ccav->merchant_param3,
			'merchant_param4'=>$res_ccav->merchant_param4,
			'merchant_param5'=>$res_ccav->merchant_param5,
			'vault'=>$res_ccav->vault,
			'offer_type'=>$res_ccav->offer_type,
			'offer_code'=>$res_ccav->offer_code,
			'discount_value'=>$res_ccav->discount_value,
			'mer_amount'=>$res_ccav->mer_amount
					
			);
			
			$this->db->insert('payment_by_ccavenue_info',$data_payment_ccaveneue);
			}
			
		}
		
	
		$this->insert_inn_transaction_details($order_id_arr,$qantity_arr,$sub_total_arr,$sku_arr,$seller_id_arr,$price_arr,$shipping_fees_arr);	
		
		 
		 $data_ordertransfer=array(
		 
		 'old_order_id'=>$order_id,
		 'new_order_id'=>$new_order_id,
		 'date_of_transfer'=>$new_orders_date
		 
		 );
		 
		 $this->db->insert('order_transfer',$data_ordertransfer);
		
		$this->db->query("update order_info set order_status='Cancelled', order_accept_by_seller='' where order_id='$order_id' ");
		$this->db->query("update ordered_product_from_addtocart set product_order_status='Cancelled'  where order_id='$order_id' ");
		
		//shipping address  insert start
		
		
		$query_shippingaddres=$this->db->query("select * from shipping_address where order_id='$order_id' ");
		$row_shippingaddres=$query_shippingaddres->result();
		
		$data_shippingaddress=array(
		
			'order_id'=>$new_order_id,
			'user_id'=>$row_shippingaddres[0]->user_id,
			'full_name'=>$row_shippingaddres[0]->full_name,
			'address'=>$row_shippingaddres[0]->address,
			'city'=>$row_shippingaddres[0]->city,
			'state'=>$row_shippingaddres[0]->state,
			'country'=>$row_shippingaddres[0]->country,
			'pin_code'=>$row_shippingaddres[0]->pin_code,
			'phone'=>$row_shippingaddres[0]->phone
			
		);
		
		$this->db->insert('shipping_address',$data_shippingaddress);
		
		//shipping address  insert end
				
	  }
	  
	  //transaction data insert for commission start
	  
	  
	  
	  function insert_inn_transaction_details($order_id_arr,$qantity_arr,$sub_total_arr,$sku_arr,$seller_id_arr,$price_arr,$shipping_fees_arr){
		date_default_timezone_set('Asia/Calcutta');
		$cdate = date('Y-m-d');
		//program start for getting product sale value//
		$arr_length = count($qantity_arr);
		/*for($i=0; $i<$arr_length; $i++){
			$single_product_price_without_shping_fee = $price_arr[$i]/$qantity_arr[$i];
			$single_product_price[] = $single_product_price_without_shping_fee+$shipping_fees_arr[$i];
		}
		$single_product_price_arr = $single_product_price;*/
		//program end of getting product sale value//
		
		//program start for getting fixedCharges //
		$this->load->model('seller/Catalog_model');		
		$fixed_charges_res = $this->Catalog_model->getFixedCharges();
		if($fixed_charges_res != 'NOT'){
			$fix_chg_amount = $fixed_charges_res[0]->amount;
			$fix_chg_percent = $fixed_charges_res[0]->percent;
			if($fix_chg_amount == ''){
				$percent_decimal = $fix_chg_percent/100;
				for($j=0; $j<$arr_length; $j++){
					$fixed_fee[] = round($sub_total_arr[$j]*$percent_decimal);
				}				
			}else{
				for($j=0; $j<$arr_length; $j++){
					$fixed_fee[] = $fix_chg_amount;
				}
			}
			$fixed_fee_arr = $fixed_fee;
		}else{
			for($j=0; $j<$arr_length; $j++){
					$fixed_fee[] = 0;
			}
			$fixed_fee_arr = $fixed_fee;
		}
		//program end of getting fixed Charges //
		
		//program start for getting Seasonal Charges //
		$seasonal_charge_res = $this->Catalog_model->getSeasonalCharges();
		if($seasonal_charge_res != 'NOT'){
			$seasonal_chg_amount = $seasonal_charge_res[0]->amount;
			$seasonal_chg_percent = $seasonal_charge_res[0]->percent;
			if($seasonal_chg_amount == ''){
				$seasonal_percent_decimal = $seasonal_chg_percent/100;				
				for($j=0; $j<$arr_length; $j++){
					$seasonal_fee[] = round($sub_total_arr[$j]*$seasonal_percent_decimal);
				}				
			}else{
				for($j=0; $j<$arr_length; $j++){
					$seasonal_fee[] = $seasonal_chg_amount;
				}
			}
			$seasonal_fee_arr = $seasonal_fee;				
		}else{
			for($j=0; $j<$arr_length; $j++){
					$seasonal_fee[] = 0;
			}
			$seasonal_fee_arr = $seasonal_fee;
		}
		//program end of getting Seasonal Charges //
		
		//program start for getting PG Charges //
		$pg_charge_res = $this->Catalog_model->getPgCharges();
		$pg_percent = $pg_charge_res[0]->percent;
		$pg_percent_decimal = $pg_percent/100;
		for($j=0; $j<$arr_length; $j++){
			$pg_fee[] = round($sub_total_arr[$j]*$pg_percent_decimal);
		}
		$pg_fee_arr = $pg_fee;
		//program end of getting PG Charges //
		
		$service_tax = $this->Catalog_model->getServiceTax();
		$tax_decimal = $service_tax/100;
				
		//getting second label category id start here//
		foreach($sku_arr as $sku){
			/* Second label category id query
			$query1 = $this->db->query("SELECT parent_id AS SECOND_LEABLE_CAT_ID FROM category_indexing WHERE category_id=(SELECT a.category_id FROM product_category a INNER JOIN product_master b ON a.product_id=b.product_id WHERE b.sku='$sku')");
			$result1 = $query1->result();
			$second_leable_cat_id[] = $result1[0]->SECOND_LEABLE_CAT_ID;
			*/
			
			//third label category id query
			$query1 = $this->db->query("SELECT a.category_id FROM product_category a INNER JOIN product_master b ON a.product_id=b.product_id WHERE b.sku='$sku'");
			$result1 = $query1->result();
			//$second_leable_cat_id is the third label category id
			$second_leable_cat_id[] = $result1[0]->category_id;
		}
		$second_leable_cat_id_arr = $second_leable_cat_id;
		//getting second label category id start here//
		
		$commission_arr = $this->commission_calculation($second_leable_cat_id_arr,$sub_total_arr,$seller_id_arr);
		//print_r($commission_arr);exit;
		/*foreach($commission_arr as $comsn){
			
			$servc_tx[] = round($comsn*$tax_decimal);		
		}*/
		
		for($k=0; $k<$arr_length; $k++){
			$total_fees = $fixed_fee_arr[$k]+$seasonal_fee_arr[$k]+$pg_fee_arr[$k]+$commission_arr[$k];
			$servc_tx[] = round($total_fees*$tax_decimal);
		}
		
		for($z=0; $z<$arr_length; $z++){
			$data = array(
				'seller_id' => $seller_id_arr[$z],
				'order_no' => $order_id_arr[$z],
				'sale_value' => $sub_total_arr[$z],
				'fixed_chgs' => $fixed_fee_arr[$z],
				'season_chgs' => $seasonal_fee_arr[$z],
				'pg_chgs' => $pg_fee_arr[$z],
				'commission' => $commission_arr[$z],
				'service_tax' =>$servc_tx[$z],
				'sku' => $sku_arr[$z],
				'cdate' => $cdate
			);
			$this->db->insert('transaction',$data);
		}
	}
	
	
	function commission_calculation($second_leable_cat_id_arr,$sub_total_arr,$seller_id_arr){
		date_default_timezone_set('Asia/Calcutta');
		$cdate = date('Y-m-d');
		//program start for commission calculating //
		$arr_length = count($seller_id_arr);
		$commission_arr = array();
		for($x=0; $x<$arr_length; $x++){
			$query = $this->db->query("SELECT * FROM special_commission WHERE from_date<='$cdate' AND to_date>='$cdate' AND cat_id='$second_leable_cat_id_arr[$x]'");
			$rows = $query->num_rows();
			if($rows > 0){
				$result = $query->result();
				$special_seller_id = unserialize($result[0]->seller_id);
				if($result[0]->seller_id == Null){ //if no seller id in this date range, applicable to all seller
					$spl_cmsn = $result[0]->commision;
					$spl_percent_decimal = $spl_cmsn/100;
					$spl_cmsn_amt = round($sub_total_arr[$x]*$spl_percent_decimal);
					array_push($commission_arr,$spl_cmsn_amt);
				}else if(in_array($seller_id_arr[$x],$special_seller_id)){ //program for if exist	
					//if(in_array($seller_id_arr[$x],$special_seller_id)){	
						$spl_cmsn = $result[0]->commision;
						$spl_percent_decimal = $spl_cmsn/100;
						$spl_cmsn_amt = round($sub_total_arr[$x]*$spl_percent_decimal);
						array_push($commission_arr,$spl_cmsn_amt);
					//}					
				//special commission condition program start here//
				}else{
				//Membership commission condition program start here//
					$query = $this->db->query("SELECT * FROM membership_seller WHERE seller_id='$seller_id_arr[$x]'");
					$row= $query->num_rows();
					if($row > 0){
						$result = $query->result();
						$memb_id = $result[0]->memb_id;
						$qr2 = $this->db->query("SELECT * FROM membership WHERE mbrshp_id='$memb_id'");
						$rs2 = $qr2->result();
						$MEMB_COLUMN = $rs2[0]->menbshp_column;
						$qr3 = $this->db->query("SELECT cat_id,`$MEMB_COLUMN` FROM membership_commission WHERE cat_id='$second_leable_cat_id_arr[$x]'");
						$rw3 = $qr3->num_rows();
						if($rw3 > 0){
							$rs3 = $qr3->result();
							$memb_cmsn = $rs3[0]->$MEMB_COLUMN;
							$memb_percent_decimal = $memb_cmsn/100;
							$memb_cmsn_amt = round($sub_total_arr[$x]*$memb_percent_decimal);
							array_push($commission_arr,$memb_cmsn_amt);
				//Membership commission condition program end here//
						}else{
				//Global commission condition program start here//
							$query = $this->db->query("SELECT * FROM global_commission WHERE cat_id='$second_leable_cat_id_arr[$x]'");
							$rows = $query->num_rows();
							if($rows > 0){
								$rs4 = $query->result();
								$gbl_cmsn = $rs4[0]->commission;
								$gbl_percent_decimal = $gbl_cmsn/100;
								$gbl_cmsn_amt = round($sub_total_arr[$x]*$gbl_percent_decimal);
								array_push($commission_arr,$gbl_cmsn_amt);
				//Global commission condition program end here//
							}else{
								//echo 'NOT';
								$commission_arr = array();
							}
						}									
					}else{
				//Global commission condition program start here//
						$query = $this->db->query("SELECT * FROM global_commission WHERE cat_id='$second_leable_cat_id_arr[$x]'");
						$rows = $query->num_rows();
						if($rows > 0){
							$rs4 = $query->result();
							$gbl_cmsn = $rs4[0]->commission;
							$gbl_percent_decimal = $gbl_cmsn/100;
							$gbl_cmsn_amt = round($sub_total_arr[$x]*$gbl_percent_decimal);
							array_push($commission_arr,$gbl_cmsn_amt);
			//Global commission condition program end here//
						}else{
							//echo 'NOT';
							$commission_arr = array();
						}
					}
				}
			}else{
			//Membership commission condition program start here//
				$query = $this->db->query("SELECT * FROM membership_seller WHERE seller_id='$seller_id_arr[$x]'");
				$row= $query->num_rows();
				if($row > 0){
					$result = $query->result();
					$memb_id = $result[0]->memb_id;
					$qr2 = $this->db->query("SELECT * FROM membership WHERE mbrshp_id='$memb_id'");
					$rs2 = $qr2->result();
					$MEMB_COLUMN = $rs2[0]->menbshp_column;
					$qr3 = $this->db->query("SELECT cat_id,`$MEMB_COLUMN` FROM membership_commission WHERE cat_id='$second_leable_cat_id_arr[$x]'");
					$rw3 = $qr3->num_rows();
					if($rw3 > 0){
						$rs3 = $qr3->result();
						$memb_cmsn = $rs3[0]->$MEMB_COLUMN;
						$memb_percent_decimal = $memb_cmsn/100;
						$memb_cmsn_amt = round($sub_total_arr[$x]*$memb_percent_decimal);
						array_push($commission_arr,$memb_cmsn_amt);
			//Membership commission condition program end here//
					}else{
			//Global commission condition program start here//
						$query = $this->db->query("SELECT * FROM global_commission WHERE cat_id='$second_leable_cat_id_arr[$x]'");
						$rows = $query->num_rows();
						if($rows > 0){
							$rs4 = $query->result();
							$gbl_cmsn = $rs4[0]->commission;
							$gbl_percent_decimal = $gbl_cmsn/100;
							$gbl_cmsn_amt = round($sub_total_arr[$x]*$gbl_percent_decimal);
							array_push($commission_arr,$gbl_cmsn_amt);
			//Global commission condition program end here//
						}else{
							//echo 'NOT';
							$commission_arr = array();
						}
					}		
				}else{
			//Global commission condition program start here//
					$query = $this->db->query("SELECT * FROM global_commission WHERE cat_id='$second_leable_cat_id_arr[$x]'");
					$rows = $query->num_rows();
					if($rows > 0){
						$rs4 = $query->result();
						$gbl_cmsn = $rs4[0]->commission;
						$gbl_percent_decimal = $gbl_cmsn/100;
						$gbl_cmsn_amt = round($sub_total_arr[$x]*$gbl_percent_decimal);
						array_push($commission_arr,$gbl_cmsn_amt);
			//Global commission condition program end here//
					}else{
						//echo 'NOT';
						$commission_arr = array();
					}
				}
			}
		}
		return $commission_arr;
		//print_r($commission_arr);
		//program end of commission calculating //
	}
	  
	  
	 //transaction data insert for commission end
	 
	 
	 
	 function reassign_order_Toseller1($sku_arr_trans,$productid_arr_trans,$addtocarttemp_session_id,$userid_arr_trans,$fixedcharge_arr_trans,$buyerqnt_arr_trans,$old_orderid)
	 {
		
		 $user_id=$userid_arr_trans[0];
		 
		 //insert in addtocart_temptranfer table start
		 
		 $ct_sku_trans=count($sku_arr_trans);
		 
		 
		 for($i=0; $i<$ct_sku_trans; $i++)
		 {
		 	$addtocarttemp_id=$this->get_unique_id('addtocart_temptranfer','addtocart_id');
		 
				$data=array(
					'addtocart_id'=>$addtocarttemp_id,
					'addtocart_session_id'=>$addtocarttemp_session_id,
					'product_id'=>$productid_arr_trans[$i],
					'user_id'=>$userid_arr_trans[$i],
					'sku'=>$sku_arr_trans[$i],
					'fixed_price'=>$fixedcharge_arr_trans[$i]
					
				);
							
				for($j=1; $j<=$buyerqnt_arr_trans[$i]; $j++)
				{
					$qr=$this->db->insert('addtocart_temptranfer',$data);
					
					
				}
			
		 	}
		//insert in addtocart_temptranfer table end
		
		 $cart_data=$this->db->query("select * from addtocart_temptranfer where user_id='$user_id' group by sku  ");
		
		 $this->calculate_totalamount($cart_data->result(),$user_id,$old_orderid);
		 
		 //updation of old seller product quantity start
		$query_oldsku=$this->db->query("select * from ordered_product_from_addtocart where order_id='$old_orderid' group by sku");
		$row_oldsku=$query_oldsku->result();
		$s=0;
		 foreach($row_oldsku as $res_skutrans)
		 {
			 $old_transku=$res_skutrans->sku;
			$query_sku=$this->db->query("select * from product_master where sku='$old_transku' ");
			$row_sku=$query_sku->result();
			
			$updated_qnt=$row_sku[0]->quantity + $buyerqnt_arr_trans[$s];
			
			 $this->db->query("update product_master set quantity='$updated_qnt' where sku='$old_transku' ");
			 
			 
			 //quantity update in seller product table start here//
				$query1 = $this->db->query("SELECT * FROM seller_product_master WHERE sku='$old_transku'");
				if($query1->num_rows() > 0){
					//$this->db->where('sku',$old_transku);
//					$this->db->update('seller_product_master',$updated_qnt);
					
					$this->db->query("update seller_product_master set quantity='$updated_qnt' where sku='$old_transku' ");
				}else{
					$query2 = $this->db->query("SELECT * FROM seller_product_general_info WHERE sku='$old_transku'");
					if($query2->num_rows() > 0){
						$result3 = $query2->result();
						$slr_prdt_id = $result3[0]->seller_product_id;
						//$this->db->where('seller_product_id',$slr_prdt_id);
//						$this->db->update('seller_product_inventory_info',$updated_qnt);
						
						$this->db->query("update seller_product_inventory_info set quantity='$updated_qnt' where seller_product_id='$slr_prdt_id' ");
					}
				}
		//quantity update in seller product table end here//
			 
			 
			 
		     $s++;	 
		 }
		
		 //updation of old seller product quantity end
		
		
	 }
		function reassign_order_Toseller1_log($old_orderid)
		{
			date_default_timezone_set('Asia/Calcutta');
			$cdate =date('y-m-d H:i:s');
			$uid= $this->session->userdata('logged_userrole_id');
			$uname=$this->session->userdata('logged_in');
			$log_data="This order(".$old_orderid.") has processed as transfer to other seller ";
				$data=array(
							
							'log_detail'=>$log_data,
							'user_id'=>$uid,
							'user_name'=>$uname,
							'log_datetime'=>$cdate
						);
						$this->db->insert('user_log',$data);
		}
		
		
		function calculate_totalamount($cart_data,$user_id,$old_orderid)
		{
			//access of data from addtocart_temptranfer table and calculate tax, shipping fees, subtotal amount  start
			
			
			
			$seller_id_arr=array();
  			$addtocart_id_arr=array();
  
			  $tax_arr=array();
			  $shipping_fees_arr=array();
			  $sub_total_arr=array();
			  $qantity_arr= array();
			  $sku_arr=array();
			  $price_arr = array();
		  
		  $total_price=0; 
   
   		foreach($cart_data as $rec_cart){  
 
 		if($rec_cart->fixed_price==0){ //no fixed price condition start
		   
		   $qr1=$this->db->query("select b.sku,c.name,b.product_id from product_image a inner join product_master b on a.product_id=b.product_id inner join product_general_info c on b.product_id=c.product_id where a.product_id='$rec_cart->product_id'");
		   $rw1=$qr1->row();
   
   
			$qr2=$this->db->query("select name from product_general_info where product_id='$rec_cart->product_id'");
		   $rw2=$qr2->row(); 
   
  
	   $query_sellername=$this->db->query("select a.business_name,a.seller_id from seller_account_information a inner join product_master b on a.seller_id=b.seller_id  where b.sku='$rec_cart->sku'  ");
	   $count_row=$query_sellername->num_rows();
   
	   $seller_id_arr_row=$query_sellername->row();
	   
	   array_push($seller_id_arr,$seller_id_arr_row->seller_id); 
   
   if($count_row!=0){
   $rw_sellername=$query_sellername->row();
   
    
	//$user_id=$this->session->userdata['session_data']['user_id'];
	  $qr2=$this->db->query("select * from addtocart_temptranfer where product_id='$rec_cart->product_id' and user_id='$user_id' and sku='$rec_cart->sku' ");
   $rec_ct=$qr2->num_rows(); 
   
   array_push($qantity_arr,$rec_ct);
   
	  $qr3=$this->db->query("select * from addtocart_temptranfer where product_id='$rec_cart->product_id' and user_id='$user_id' and sku='$rec_cart->sku'  ");  
	 
	  $price=0;
	  foreach($qr3->result() as $rw_price)
	  {
		  
		  $qr4=$this->db->query("select * from product_master where sku='$rw_price->sku' ");  
		  $rec4=$qr4->result();
		  
		  $cdate = date('Y-m-d');
		  $special_price_from_dt = $rec4[0]->special_pric_from_dt;
		  $special_price_to_dt = $rec4[0]->special_pric_to_dt;
		  
		  //calculatin tax amount//
		  $tax_class = $rec4[0]->tax_class;
		  $tax_sql = $this->db->query("SELECT tax_rate_percentage FROM tax_management WHERE tax_id='$tax_class'");
		  $tax_res = $tax_sql->row();
		  $tax_persent = $tax_res->tax_rate_percentage;
		  $taxdecimal = $tax_persent/100;
		  
		  //array_push($tax_arr,$taxdecimal);
		  //tax amount for product price
		 $tax_amount = $rec4[0]->price*$taxdecimal;
					
		  //tax amount for product special price
		  $tax_amount_special = $rec4[0]->special_price*$taxdecimal;
		  
		  //tax amount for product mrp price
		  $tax_amount_mrp = $rec4[0]->mrp*$taxdecimal;
		  ///calculating tax amount script end here///
		  
		  if($rec4[0]->special_price !=0){
			  if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
				  array_push($tax_arr,$tax_amount_special*$rec_ct);
				  
		  			$price= $price + $rec4[0]->special_price;
			  }else{
				  //array_push($tax_arr,$tax_amount*$rec_ct);
				    //$price= $price + $rec4[0]->price;
					if($rec4[0]->price != 0){
						array_push($tax_arr,$tax_amount*$rec_ct);
				    	$price= $price + $rec4[0]->price;
					}else{
						array_push($tax_arr,$tax_amount_mrp*$rec_ct);
						$price= $price + $rec4[0]->mrp;
					}
			  } //End of date condition
		  }else{
			  //array_push($tax_arr,$tax_amount*$rec_ct);
			  //$price= $price + $rec4[0]->price;
			  
			  	if($rec4[0]->price != 0){
					array_push($tax_arr,$tax_amount*$rec_ct);
				    $price= $price + $rec4[0]->price;
				}else{
					array_push($tax_arr,$tax_amount_mrp*$rec_ct);
					$price= $price + $rec4[0]->mrp;
				}
			  
		  } //End of date special_price!=0 condition
			
	  }
	    $final_price = ceil($price);
	   array_push($price_arr,$final_price);
	
		array_push($shipping_fees_arr,$rec4[0]->shipping_fee_amount*$rec_ct); 
	
    	$subtotal_price = 0;
     
	  
	   $subtotal_price=$subtotal_price+$rec4[0]->shipping_fee_amount*$rec_ct+ceil($price) ; 
	  array_push($sub_total_arr,$subtotal_price);
     
   
  	 $total_price=ceil($total_price+$subtotal_price); 
  
  	array_push($addtocart_id_arr,$rec_cart->addtocart_id);
 
  	array_push($sku_arr,$rec_cart->sku);
   }
   
		}// no fixed price  conditon end
		
		
		//fixed price condition start
		else{
			
			 $qr1=$this->db->query("select b.sku,c.name,b.product_id from product_image a inner join product_master b on a.product_id=b.product_id inner join product_general_info c on b.product_id=c.product_id where a.product_id='$rec_cart->product_id'");
		   $rw1=$qr1->row();
   
   
			$qr2=$this->db->query("select name from product_general_info where product_id='$rec_cart->product_id'");
		   $rw2=$qr2->row(); 
   
  
			   $query_sellername=$this->db->query("select a.business_name,a.seller_id from seller_account_information a inner join product_master b on a.seller_id=b.seller_id  where b.sku='$rec_cart->sku'  ");
			   $count_row=$query_sellername->num_rows();
		   
			   $seller_id_arr_row=$query_sellername->row();
			   
			   array_push($seller_id_arr,$seller_id_arr_row->seller_id); 
		   
		   if($count_row!=0){
		   $rw_sellername=$query_sellername->row();
		   
			
			//$user_id=$this->session->userdata['session_data']['user_id'];
			  $qr2=$this->db->query("select * from addtocart_temptranfer where product_id='$rec_cart->product_id' and user_id='$user_id' and sku='$rec_cart->sku' ");
		   $rec_ct=$qr2->num_rows(); 
		   
		   array_push($qantity_arr,$rec_ct);
		  array_push($tax_arr,'0');
		   array_push($price_arr,$rec_cart->fixed_price);
		   array_push($shipping_fees_arr,'0');
			array_push($sub_total_arr,$rec_cart->fixed_price*$rec_ct);
			
			array_push($addtocart_id_arr,$rec_cart->addtocart_id);
		 
			array_push($sku_arr,$rec_cart->sku);
			 $total_price= $total_price+$rec_cart->fixed_price*$rec_ct;
		   }
   
			
			}//fixed price condition end
			
   
   
   }
			
		$this->myorder_detail($addtocart_id_arr, $total_price , $seller_id_arr, $tax_arr,$shipping_fees_arr, $sub_total_arr, $qantity_arr,$sku_arr, $price_arr,$user_id,$old_orderid );	
			
	//access of data from addtocart_temptranfer table and calculate tax, shipping fees, subtotal amount  end
		
		}
		
		
		
		function myorder_detail($addtocart_id_arr, $total_price , $seller_id_arr, $tax_arr,$shipping_fees_arr, $sub_total_arr, $qantity_arr,$sku_arr, $price_arr,$user_id,$old_orderid )
		{
				
			$addtocart_ids=$addtocart_id_arr;
			
			$total_price=$total_price;
			
			$seller_id_arr=$seller_id_arr;
			
			$tax_arr=$tax_arr;
			
			$shipping_fees_arr=$shipping_fees_arr;
			
			$sub_total_arr=$sub_total_arr;
			
			$qantity_arr=$qantity_arr;
			
			$sku_arr=$sku_arr;
			
			$query_addressid=$this->db->query("select a.mob,a.fname,a.lname, a.email,a.mob,b.* from user a inner join user_address b on a.user_id=b.user_id where a.user_id=$user_id and a.address_id=b.address_id  ");
			$row_addressid=$query_addressid->result();
			
			$address_id=$row_addressid[0]->address_id;
			
			$price_arr = $price_arr;
			
			date_default_timezone_set('Asia/Calcutta');
			$dt = preg_replace("/[^0-9]+/","", date('Y-m-d H:i:s'));
			//$user_id=$this->session->userdata['session_data']['user_id'];
			
			$order_id_arr=array();
			
			foreach($seller_id_arr as $key=>$value)
			{		
				$order_id_arr[$key]=$user_id.implode('',$addtocart_ids).$dt.$value;
				//$cart['order_id']=$user_id.implode('',explode('-',$this->uri->segment(3))).$dt.$value;
			}
						
			//$order_id=$this->session->userdata['session_data']['user_id'].implode('',explode('-',$this->uri->segment(3))).$dt;
			$this->insert_myorderdata($addtocart_ids,$order_id_arr,$tax_arr,$shipping_fees_arr,$sub_total_arr,$qantity_arr,$sku_arr,$total_price,$seller_id_arr,$address_id,                                                   $price_arr,$user_id,$old_orderid);			
			
	}
	
	
	function insert_myorderdata($addtocart_ids,$order_id_arr,$tax_arr,$shipping_fees_arr,$sub_total_arr,$qantity_arr,$sku_arr,$total_price,$seller_id_arr,$address_id,                                                   $price_arr,$user_id,$old_orderid)
	{
		//select payment mode start
		
		$query_paymode=$this->db->query("select * from order_info where order_id='$old_orderid'  ");
		$res_paymode=$query_paymode->result();
		
		$payment_mode=$res_paymode[0]->payment_mode;
		//select payment mode end
		
		
		//transaction table insert function//
		$this->insert_inn_transaction_details($order_id_arr,$qantity_arr,$sub_total_arr,$sku_arr,$seller_id_arr,$price_arr,$shipping_fees_arr);
		
		$i=0;	
		//$user_id=$this->session->userdata['session_data']['user_id'];
		
		$query1=$this->db->query("select * from addtocart_temptranfer where user_id='$user_id' group by sku ");
		
		//$row1=$query1->result();
		
		$ct=$query1->num_rows();
		
		
		foreach($query1->result() as $rw)
		{	
			
			//product quantity update start
			
			//$qnt_query=$this->db->query("select * from product_master where sku='$sku_arr[$i]' ");
			$sku_id=$rw->sku;
			$qnt_query=$this->db->query("select * from product_master where sku='$sku_id' ");
			
			$qnt_rw=$qnt_query->row();
					
			$avl_qnt=$qnt_rw->quantity - $qantity_arr[$i];			
			
			$qnt_update_query=$this->db->query("update product_master set quantity='$avl_qnt' where sku='$sku_arr[$i]' ");
			
						
			 //quantity update in seller product table start here//
				$query1 = $this->db->query("SELECT * FROM seller_product_master WHERE sku='$sku_arr[$i]'");
				if($query1->num_rows() > 0){
					//$this->db->where('sku',$old_transku);
//					$this->db->update('seller_product_master',$updated_qnt);
					
					$this->db->query("update seller_product_master set quantity='$avl_qnt' where sku='$sku_arr[$i]' ");
				}else{
					$query2 = $this->db->query("SELECT * FROM seller_product_general_info WHERE sku='$sku_arr[$i]'");
					if($query2->num_rows() > 0){
						$result3 = $query2->result();
						$slr_prdt_id = $result3[0]->seller_product_id;
						//$this->db->where('seller_product_id',$slr_prdt_id);
//						$this->db->update('seller_product_inventory_info',$updated_qnt);
						
						$this->db->query("update seller_product_inventory_info set quantity='$avl_qnt' where seller_product_id='$slr_prdt_id' ");
					}
				}
		//quantity update in seller product table end here//
			
						
			
			//product quantity update end
			
			
			//out of stock status update start
			
			$qnt_query1=$this->db->query("select * from product_master where sku='$sku_arr[$i]' ");
			$qnt_rw1=$qnt_query1->row();
					
			if($qnt_rw1->quantity==0)
			{
				$qnt_update_query1=$this->db->query("update product_master set stock_availability='Out of Stock' where sku='$sku_arr[$i]' ");	
			}			
			//out of stock status update end		
					
			
			
			$addtocart_id=$this->get_unique_id('ordered_product_from_addtocart','addtocart_id');
			
			$data=array (
			'addtocart_id'=>$addtocart_id,
			'addtocart_session_id'=>$rw->addtocart_session_id,
			'product_id'=>$rw->product_id,
			'user_id'=>$rw->user_id,
			'sku'=>$sku_arr[$i],
			'order_id'=>$order_id_arr[$i],
			'sub_tax_rate'=>$tax_arr[$i],
			'sub_shipping_fees'=>$shipping_fees_arr[$i],
			'sub_total_amount'=>$sub_total_arr[$i],
			'seller_id'=>$seller_id_arr[$i],	
			 'quantity'=>$qantity_arr[$i],
			 'is_transfer_cart'=>'yes'
			);
			
			$qr1=$this->db->insert('ordered_product_from_addtocart',$data);	
			
			
			$check_order_id_query=$this->db->query("select * from order_info where order_id='$order_id_arr[$i]'   ");
			$ct_row=$check_order_id_query->num_rows();
			
			if($ct_row==0)
			{
					$order_track_id=$this->get_unique_id('order_info','order_track_id');
					date_default_timezone_set('Asia/Kolkata');
					$dt=date('Y-m-d H:i:s');
			
					$data_order=array (
					'order_track_id'=>$order_track_id,
					'order_id'=>$order_id_arr[$i],
					'Total_amount'=>$sub_total_arr[$i],
					'date_of_order'=>$dt,
					'payment_mode'=>$payment_mode,
					'is_transfer'=>'yes'			
					);
					
					$qr1=$this->db->insert('order_info',$data_order);				
					
			}
			
			else
			{
				$row_order_info=$check_order_id_query->row();
				$tot_amt=$row_order_info->Total_amount + $sub_total_arr[$i];
				
				$upd_query=$this->db->query("update order_info set Total_amount='$tot_amt' where order_id='$order_id_arr[$i]' ");	
			}
			
			
			//INSERT OF ADDRESS DATA START
			
			$check_shippingaddress_query=$this->db->query("select * from shipping_address where order_id='$order_id_arr[$i]'   ");
			$ct_row1=$check_shippingaddress_query->num_rows();
			
			if($ct_row1==0)
			{
				
			
			$address_data_query=$this->db->query("select * from user_address where address_id='$address_id'");
			$address_row=$address_data_query->row();
			
			$address_data=array(
			'order_id'=>$order_id_arr[$i],
			'user_id'=>	$address_row->user_id,
			'full_name'=>$address_row->full_name,
			'address'=>$address_row->address,
			'city'=>$address_row->city,
			'state'=>$address_row->state,
			'country'=>$address_row->country,
			'pin_code'=>$address_row->pin_code,
			'phone'=>$address_row->phone
			
			);				
				
			$address_insert_qr=$this->db->insert('shipping_address',$address_data);
			}	
			//INSERT OF ADDRESS DATA END	
			
			
			$this->db->query("delete from addtocart_temptranfer where sku='$rw->sku' and user_id='$rw->user_id' ");	
			
			$i++;			
			
			
		}
		
		//insert in order_tranfer table start
		
		$ct_neworderid=count($order_id_arr);

	for($k=0; $k<$ct_neworderid; $k++)
	{
		$data_ordertransfer=array(
		 
		 'old_order_id'=>$old_orderid,
		 'new_order_id'=>$order_id_arr[$k],
		 'date_of_transfer'=>$dt
		 
		 );
		 
		 $this->db->insert('order_transfer',$data_ordertransfer);		
		
		//insert in order_transfer tabel end
	}
		
			
	}
	 
	 
	 function transfreed_ordercancel($old_orderid)
	 {
		$this->db->query("update order_info set order_status='Cancelled' where order_id='$old_orderid' ");	
		$this->db->query("update ordered_product_from_addtocart set product_order_status='Cancelled' where order_id='$old_orderid' ");
		
		
		date_default_timezone_set('Asia/Calcutta');
		$date = date('Y-m-d H:i:s');
		$return_id = 'RN'.preg_replace("/[^0-9]+/","", $date);
		
		
		$return_type = 'Refund';
		
		$qury_return=$this->db->query("select * from ordered_product_from_addtocart where order_id='$old_orderid'");
		
		$row_return=$qury_return->result();
		
		foreach($row_return as $res_return)
		{
			date_default_timezone_set('Asia/Calcutta');
			$date = date('Y-m-d H:i:s');
			$return_id = 'RN'.preg_replace("/[^0-9]+/","", $date);
			
			$data=array(
				'return_id'=>$return_id,
				'order_id'=>$old_orderid,
				'sku'=>$res_return->sku,
				'quantity'=>$res_return->quantity,
				'tax_rate'=>$res_return->sub_tax_rate,
				'shipping_fee'=>$res_return->sub_shipping_fees,
				'total_amount'=>$res_return->sub_total_amount,
				'seller_id'=>$res_return->seller_id,
				'return_typ'=>'Refund',
				'cdate'=>$date
			
			);
			
			$this->db->insert('return_product', $data);
			
			
		//----------------------
		
					$sku_for_qnt=$res_return->sku;
					$cancel_qty= $res_return->quantity;
					
				//program start for quantity increment in of product//
				$query_qnt = $this->db->query("SELECT quantity FROM product_master WHERE sku='$sku_for_qnt'");
				$result_qnt = $query_qnt->row();
				$quantity = $result_qnt->quantity;
				$total_qty = $quantity+$cancel_qty;
				$qty_data = array('quantity' => $total_qty);
				$this->db->where('sku',$sku_for_qnt);
				$this->db->update('product_master',$qty_data);
				
				//quantity update in seller product table start here//
				$query1 = $this->db->query("SELECT * FROM seller_product_master WHERE sku='$sku_for_qnt'");
				if($query1->num_rows() > 0){
					$this->db->where('sku',$sku_for_qnt);
					$this->db->update('seller_product_master',$qty_data);
				}else{
					$query2 = $this->db->query("SELECT * FROM seller_product_general_info WHERE sku='$sku_for_qnt'");
					if($query2->num_rows() > 0){
						$result3 = $query2->result();
						$slr_prdt_id = $result3[0]->seller_product_id;
						$this->db->where('seller_product_id',$slr_prdt_id);
						$this->db->update('seller_product_inventory_info',$qty_data);
					}
				}
				//quantity update in seller product table end here//
				//program end of quantity increment in of product//
		
		//---------------------			
				
		}//foreach end
		//insert in order transfer table start
		
		$data_ordertransfer=array(
		 
		 'old_order_id'=>$old_orderid,
		 'new_order_id'=>'Cancelled',
		 'date_of_transfer'=>$date
		 
		 );
		 
		 $this->db->insert('order_transfer',$data_ordertransfer);		
		
		//insert in order_transfer tabel end
	
	 }
	 
	 function transfreed_ordercancel_log($old_orderid)
	 {
		date_default_timezone_set('Asia/Calcutta');
		$cdate =date('y-m-d H:i:s');
		$uid= $this->session->userdata('logged_userrole_id');
		$uname=$this->session->userdata('logged_in');
		$log_data="This order(".$old_orderid.") has cancelled in order tansfer panel ";
		
				$data=array(
							
							'log_detail'=>$log_data,
							'user_id'=>$uid,
							'user_name'=>$uname,
							'log_datetime'=>$cdate
						);
						$this->db->insert('user_log',$data); 
	 }
	 
	 
	 
	 function returned_ordercount()
	 {
		 $old_query="select a.*,c.name,d.fname,d.lname from return_product a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join seller_account c on c.seller_id=b.seller_id inner join user d on d.user_id=b.user_id where a.status='Return Requested' AND a.return_request_approve_status='Not Approved' group by a.order_id ";
		 $query="select a.*,c.name,d.fname,d.lname 
			from return_product a 
			left join ordered_product_from_addtocart b on a.order_id=b.order_id 
			left join seller_account c on c.seller_id=b.seller_id 
			left join user d on d.user_id=b.user_id 
			where a.status='Return Requested' AND 
			a.return_request_approve_status='Not Approved' 
			group by a.order_id";
		$query_return=$this->db->query($query);
		$row_return=$query_return->result();
		return 	$row_return; 
	 }
	 
	 function returned_order_approve($order_id)
	{
		$this->db->query("update return_product set return_request_approve_status='Approved' where order_id='$order_id' ");
		
		//=========================Order Status log insert start=================================
		
				$order_log_status='return_approve_date';
				$this->update_orderstatus_log($order_id,$order_log_status);			
		
		//=========================Order Status log insert end=================================
		
		//Return email send to seller start
			$query_reurn_product_info=$this->db->query("select c.imag,d.name as prd_name,a.seller_id,a.order_id, a.quantity, a.total_amount,a.return_id from return_product a inner join product_master b on a.sku=b.sku inner join product_image c on c.product_id=b.product_id inner join product_general_info d on d.product_id=b.product_id where a.order_id='$order_id' and a.return_request_approve_status='Approved'");
			$row_reurn_product_info=$query_reurn_product_info->result();
			
			//start of for each for multiple email send
			foreach($row_reurn_product_info as $res_reurn_product_info)
			{
			$image=explode(',',$res_reurn_product_info->imag);
			
			$selr_id=$res_reurn_product_info->seller_id;
			$query_seller_info=$this->db->query("select * from seller_account where seller_id='$selr_id' ");
			$mail_row=$query_seller_info->row();
			
			$rtorder_id=$res_reurn_product_info->order_id;
			$retn_id=$res_reurn_product_info->return_id;
			$image_name=$image[0]; //image name
			$prd_name=$res_reurn_product_info->prd_name;
			$prd_qnt=$res_reurn_product_info->quantity;
			$prd_totamnt=$res_reurn_product_info->total_amount;
			
			$email=$mail_row->email;
			
			$message = "			
					<html>
					<head>					
					<title></title>
					<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
					</head>					
					<body style='background-color:#fabd2f; font-family:'Calibri',Arial, Helvetica, sans-serif;'>
					
					<table width='600' cellspacing='0' align='center'>
					<tr> <td style='text-align:right; color:#e8442b;font-weight:bold; font-size:14px;'> 
					Call us :  <span style='color:#fff;'> 91-7874460000  </span><br>
					Email :   <span style='color:#fff;'> ". ucfirst(SELLER_MAIL)." </span> 
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
					 <p> <strong style='font-size:16px;'>Dear Merchant,</strong> <br /><br />
					
					<span style='color:#e25a0c; font-weight:bold;'> Order No.: ".$rtorder_id."</span> <br /> <br />
					<span style='color:#e25a0c; font-weight:bold;'> Return Id.: ".$retn_id."</span> <br /> <br />
					This Order has approved for return request by buyer with following details.<br />
					Please email courier detail of returned order with following details to ".INFO_MAIL." .
					<table border='1' ><tr bgcolor='#CCC'> <th>Product Name </th><th>Quantity </th><th> Refund Amount </th></tr> 
					<tr> 
					<td> ".$prd_name." </td> <td> ".$prd_qnt." </td> <td>Rs.".$prd_totamnt."  </td>  </tr>
					
					</table>
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
					</html>";	
			
						$order_query=$this->db->query("select * from ordered_product_from_addtocart where order_id='$rtorder_id' group by order_id ");
		 				$rw=$order_query->row();
						$query_cusdata=$this->db->query("select a.email from user a where a.user_id='$rw->user_id'  ");
						$cus_data=$query_cusdata->row();
						
						$cart['order_id']=$rtorder_id;								 			   
						$this->email->set_mailtype("html");
						$this->email->from(SUPPORT_MAIL, DOMAIN_NAME);
						$this->email->to($cus_data->email);
						$this->email->subject('Your Return Request for the Order –'. $rtorder_id.' has been Accepted !');
						$this->email->message($this->load->view('email_template/return_accepted',$cart,true));
						$this->email->send();
						
						
						date_default_timezone_set('Asia/Calcutta');
						$dt = date('Y-m-d H:i:s');
					
				$msg=$this->load->view('email_template/return_accepted',$cart,true);
				if($this->email->send()){
					
					$email_data=array(
					'to_email_id'=>$cus_data->email,
					'from_email_id'=>SUPPORT_MAIL,
					'date'=>$dt,
					'email_sub'=>'Your Return Request for the Order –'. $rtorder_id.' has been Accepted !',
					'email_content'=>$msg,
					'email_send_status'=>'Success'
					);
				}else
				{
					$email_data=array(
					'to_email_id'=>$cus_data->email,
					'from_email_id'=>SUPPORT_MAIL,
					'date'=>$dt,
					'email_sub'=>'Your Return Request for the Order –'. $rtorder_id.' has been Accepted !',
					'email_content'=>$msg,
					'email_send_status'=>'Failure'
					);
				}
				$this->db->insert('email_log',$email_data);	
						
						
						
						$this->email->set_mailtype("html");
						$this->email->from(SELLER_MAIL, DOMAIN_NAME);
						$this->email->to($email);						
						$this->email->subject('Return Request Of Order');
						$this->email->message($message);
						//$this->email->attach($this->load->view('admin/buyer_RefundExcelReport'));
						//$path=$_SERVER["DOCUMENT_ROOT"];
    					//$file=$path."/application/views/admin/buyer_RefundExcelReport.php";						
						//$this->email->attach($file);						
						$this->email->send();
						date_default_timezone_set('Asia/Calcutta');
						$dt = date('Y-m-d H:i:s');
					
				$msg=$this->email->message($message);
				if($this->email->send()){
					
					$email_data=array(
					'to_email_id'=>$email,
					'from_email_id'=>SUPPORT_MAIL,
					'date'=>$dt,
					'email_sub'=>'Return Request Of Order',
					'email_content'=>$msg,
					'email_send_status'=>'Success'
					);
				}else
				{
					$email_data=array(
					'to_email_id'=>$email,
					'from_email_id'=>SUPPORT_MAIL,
					'date'=>$dt,
					'email_sub'=>'Return Request Of Order',
					'email_content'=>$msg,
					'email_send_status'=>'Failure'
					);
				}
				$this->db->insert('email_log',$email_data);	

										
			} // end of foreach
			//Return email send to seller end
			
			
			//Return email send to Buyer start
			$query_reurn_product_info1=$this->db->query("select a.order_id,c.imag,d.name as prd_name, a.quantity, a.total_amount,a.return_id, e.user_id from  return_product a inner join product_master b on a.sku=b.sku inner join product_image c on c.product_id=b.product_id inner join product_general_info d on d.product_id=b.product_id inner join ordered_product_from_addtocart e on e.order_id=a.order_id where a.order_id='$order_id' and a.return_request_approve_status='Approved'  ");
			$row_reurn_product_info1=$query_reurn_product_info1->result();
			
			//start of for each for multiple email send
			foreach($row_reurn_product_info1 as $res_reurn_product_info1)
			{
			$image1=explode(',',$res_reurn_product_info1->imag);
			
			$user_id=$res_reurn_product_info1->user_id;
			$query_user_info=$this->db->query("select * from user where user_id='$user_id' ");
			$mail_row_user=$query_user_info->row();
			
			$rtorder_id=$res_reurn_product_info1->order_id;
			$retn_id=$res_reurn_product_info1->return_id;
			$fname=$mail_row_user->fname;
			$lname=$mail_row_user->lname;
			$image_name=$image1[0]; //image name
			$prd_name=$res_reurn_product_info1->prd_name;
			$prd_qnt=$res_reurn_product_info1->quantity;
			$prd_totamnt=$res_reurn_product_info1->total_amount;
			
			$email_buyer=$mail_row_user->email;
			$data['rtorder_id']=$rtorder_id;
			$data['retn_id']=$retn_id;
			$data['fname']=$fname;
			$data['lname']=$lname;
			$data['prd_name']=$prd_name;
			$data['prd_qnt']=$prd_qnt;
			$data['prd_totamnt']=$prd_totamnt;
			
			$this->email->set_mailtype("html");
						$this->email->from(INFO_MAIL, DOMAIN_NAME);
						$this->email->to($email_buyer);
						//$this->email->to('santanu@paramountitsolutions.co.in');
						$this->email->subject('Return Request Of Order');
						$this->email->message($this->load->view('email_template/return_approve',$data,true));
						//$this->email->message($this->load->view('email_template','',true));
						//$this->email->message($message_buyer);
						$this->email->send();
						
						date_default_timezone_set('Asia/Calcutta');
						$dt = date('Y-m-d H:i:s');
					
				$msg=$this->load->view('email_template/return_approve',$data,true);
				if($this->email->send()){
					
					$email_data=array(
					'to_email_id'=>$email_buyer,
					'from_email_id'=>INFO_MAIL,
					'date'=>$dt,
					'email_sub'=>'Return Request Of Order',
					'email_content'=>$msg,
					'email_send_status'=>'Success'
					);
				}else
				{
					$email_data=array(
					'to_email_id'=>$email_buyer,
					'from_email_id'=>INFO_MAIL,
					'date'=>$dt,
					'email_sub'=>'Return Request Of Order',
					'email_content'=>$msg,
					'email_send_status'=>'Failure'
					);
				}
				$this->db->insert('email_log',$email_data);					
			} // end of foreach
			//Return email send to Buyer end		 
	}
	
	
	function returned_order_denied($order_id)
	{
		//quantity update in product tables program start here
		$query = $this->db->query("SELECT sku,quantity FROM return_product WHERE order_id='$order_id'");
		if($query->num_rows() > 0){
			foreach($query->result() as $return_data_row){
				//$rtn_sku[] = $return_data_row->sku;
				//$rtn_qty[] = $return_data_row->quantity;
				
				//program start for quantity update in product_master
				$sql = $this->db->query("SELECT product_id,quantity,seller_id FROM product_master WHERE sku='$return_data_row->sku'");
				$res = $sql->row();
				$prev_qty = $res->quantity;
				$total_qty = $prev_qty+$return_data_row->quantity;
				$qry_data = array(
					'quantity'=>$total_qty,
				);
				$this->db->where('sku',$return_data_row->sku);
				$this->db->update('product_master',$qry_data);
				//program end of quantity update in product_master
				
				//program start for quantity update in seller_product_inventory_info
				$slr_sql = $this->db->query("SELECT seller_product_id FROM seller_product_setting WHERE master_product_id='$res->product_id' AND seller_id='$res->seller_id'");
				if($slr_sql->num_rows() > 0){
					$slr_res = $slr_sql->row();
					$this->db->where('seller_product_id',$slr_res->seller_product_id);
					$this->db->update('seller_product_inventory_info',$qry_data);
				}
				//program end of quantity update in seller_product_inventory_info
				else{
				//program start for quantity update in seller_product_master
					$this->db->where('sku',$return_data_row->sku);
					$this->db->update('seller_product_master',$qry_data);
				//program end of quantity update in seller_product_master
				}
				
				//update ordered_product_from_addtocart product_order_status status program start here
				$this->db->query("UPDATE ordered_product_from_addtocart SET product_order_status='Delivered',returned_request_deny='Yes' WHERE order_id='$order_id' AND sku='$return_data_row->sku'");
				//update ordered_product_from_addtocart product_order_status status program end here
			}
		}
		//quantity update in product tables program end here
		
		//update ordered_product_from_addtocart order_info status program start here
		$order_sql = $this->db->query("SELECT order_id FROM ordered_product_from_addtocart WHERE order_id='$order_id'");
		$total_order_row = $order_sql->num_rows();
		
		$order_return_sql = $this->db->query("SELECT order_id FROM ordered_product_from_addtocart WHERE order_id='$order_id' AND product_order_status='Delivered'");
		$order_return_row = $order_return_sql->num_rows();
		if($total_order_row == $order_return_row){
			$this->db->query("UPDATE order_info SET order_status='Delivered' WHERE order_id='$order_id'");
		}
		//update ordered_product_from_addtocart order_info status program end here
		
		//delete order details from return_product table program start here
		$this->db->where('order_id', $order_id);
		$this->db->delete('return_product');
		//delete order details from return_product table program end here
		
		//Return deny email send to seller start
			$query_reurn_product_info=$this->db->query("select c.imag,d.name as prd_name,a.seller_id,a.order_id, a.quantity, a.total_amount,a.return_id from return_product a inner join product_master b on a.sku=b.sku inner join product_image c on c.product_id=b.product_id inner join product_general_info d on d.product_id=b.product_id where a.order_id='$order_id' and a.return_request_approve_status='Approved'");
			$row_reurn_product_info=$query_reurn_product_info->result();
			
			//start of for each for multiple email send
			foreach($row_reurn_product_info as $res_reurn_product_info)
			{
			$image=explode(',',$res_reurn_product_info->imag);
			
			$selr_id=$res_reurn_product_info->seller_id;
			$query_seller_info=$this->db->query("select * from seller_account where seller_id='$selr_id' ");
			$mail_row=$query_seller_info->row();
			
			$rtorder_id=$res_reurn_product_info->order_id;
			$retn_id=$res_reurn_product_info->return_id;
			$image_name=$image[0]; //image name
			$prd_name=$res_reurn_product_info->prd_name;
			$prd_qnt=$res_reurn_product_info->quantity;
			$prd_totamnt=$res_reurn_product_info->total_amount;
			
			$email=$mail_row->email;
			
			$message = "			
					<html>
					<head>					
					<title></title>
					<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
					</head>					
					<body style='background-color:#fabd2f; font-family:'Calibri',Arial, Helvetica, sans-serif;'>
					
					<table width='600' cellspacing='0' align='center'>
					<tr> <td style='text-align:right; color:#e8442b;font-weight:bold; font-size:14px;'> 
					Call us :  <span style='color:#fff;'> 91-7874460000  </span><br>
					Email :   <span style='color:#fff;'> ".SELLER_MAIL." </span> 
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
					 <p> <strong style='font-size:16px;'>Dear Merchant,</strong> <br /><br />
					
					<span style='color:#e25a0c; font-weight:bold;'> Order No.: ".$rtorder_id."</span> <br /> <br />
					<span style='color:#e25a0c; font-weight:bold;'> Return Id.: ".$retn_id."</span> <br /> <br />
					This Order has denied for return request by buyer with following details.<br />
					<table border='1' ><tr bgcolor='#CCC'> <th>Product Name </th><th>Quantity </th><th> Refund Amount </th></tr> 
					<tr> 
					<td> ".$prd_name." </td> <td> ".$prd_qnt." </td> <td>Rs.".$prd_totamnt."  </td>  </tr>
					
					</table>
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
					</html>";	
					
								 			   
						$this->email->set_mailtype("html");
						$this->email->from(SELLER_MAIL, DOMAIN_NAME);
						$this->email->to($email);
						//$this->email->to('santanu@paramountitsolutions.co.in');
						$this->email->subject('Return Request Of Order');
						//$this->email->message($this->load->view('email_template','',true));
						$this->email->message($message);
						//$this->email->attach($this->load->view('admin/buyer_RefundExcelReport'));
						//$path=$_SERVER["DOCUMENT_ROOT"];
    					//$file=$path."/application/views/admin/buyer_RefundExcelReport.php";
						
						//$this->email->attach($file);
						
						$this->email->send();
						
					date_default_timezone_set('Asia/Calcutta');
					$dt = date('Y-m-d H:i:s');
					
				$msg=$this->email->message($message);
				if($this->email->send()){
					
					$email_data=array(
					'to_email_id'=>$email,
					'from_email_id'=>SELLER_MAIL,
					'date'=>$dt,
					'email_sub'=>'Return Request Of Order',
					'email_content'=>$msg,
					'email_send_status'=>'Success'
					);
				}else
				{
					$email_data=array(
					'to_email_id'=>$email,
					'from_email_id'=>SELLER_MAIL,
					'date'=>$dt,
					'email_sub'=>'Return Request Of Order',
					'email_content'=>$msg,
					'email_send_status'=>'Failure'
					);
				}
				$this->db->insert('email_log',$email_data);					
			} // end of foreach
			//Return deny email send to seller end
			
			
			//Return deny email send to Buyer start
			$query_reurn_product_info1=$this->db->query("select a.order_id,c.imag,d.name as prd_name, a.quantity, a.total_amount,a.return_id, e.user_id from  return_product a inner join product_master b on a.sku=b.sku inner join product_image c on c.product_id=b.product_id inner join product_general_info d on d.product_id=b.product_id inner join ordered_product_from_addtocart e on e.order_id=a.order_id where a.order_id='$order_id' and a.return_request_approve_status='Approved'  ");
			$row_reurn_product_info1=$query_reurn_product_info1->result();
			
			//start of for each for multiple email send
			foreach($row_reurn_product_info1 as $res_reurn_product_info1)
			{
			$image1=explode(',',$res_reurn_product_info1->imag);
			
			$user_id=$res_reurn_product_info1->user_id;
			$query_user_info=$this->db->query("select * from user where user_id='$user_id' ");
			$mail_row_user=$query_user_info->row();
			
			$rtorder_id=$res_reurn_product_info1->order_id;
			$retn_id=$res_reurn_product_info1->return_id;
			$fname=$mail_row_user->fname;
			$lname=$mail_row_user->lname;
			$image_name=$image1[0]; //image name
			$prd_name=$res_reurn_product_info1->prd_name;
			$prd_qnt=$res_reurn_product_info1->quantity;
			$prd_totamnt=$res_reurn_product_info1->total_amount;
			
			$email_buyer=$mail_row_user->email;
			$data['fname']=$fname;
			$data['lname']=$lname;
			$data['rtorder_id']=$rtorder_id;
			$data['retn_id']=$retn_id;
			$data['prd_name']=$prd_name;
			$data['prd_qnt']=$prd_qnt;
			$data['prd_totamnt']=$prd_totamnt;
			
			$this->email->set_mailtype("html");
					$this->email->from(INFO_MAIL, DOMAIN_NAME);
					$this->email->to($email_buyer);
					//$this->email->to('santanu@paramountitsolutions.co.in');
					$this->email->subject('Return Request Of Order');
					$this->email->message($this->load->view('email_template/return_denied',$data,true));
					//$this->email->message($this->load->view('email_template','',true));
					//$this->email->message($message_buyer);
					$this->email->send();
					
				date_default_timezone_set('Asia/Calcutta');
				$dt = date('Y-m-d H:i:s');
					
				$msg=$this->load->view('email_template/return_denied',$data,true);
				if($this->email->send()){
					
					$email_data=array(
					'to_email_id'=>$email_buyer,
					'from_email_id'=>INFO_MAIL,
					'date'=>$dt,
					'email_sub'=>'Return Request Of Order',
					'email_content'=>$msg,
					'email_send_status'=>'Success'
					);
				}else
				{
					$email_data=array(
					'to_email_id'=>$email_buyer,
					'from_email_id'=>INFO_MAIL,
					'date'=>$dt,
					'email_sub'=>'Return Request Of Order',
					'email_content'=>$msg,
					'email_send_status'=>'Failure'
					);
				}
				$this->db->insert('email_log',$email_data);								
			} // end of foreach
			//Return deny email send to Buyer end		 
	}
	 
	 
	function returned_order_approve_log($order_id)
	{
		date_default_timezone_set('Asia/Calcutta');
		$cdate =date('y-m-d H:i:s');
		$uid= $this->session->userdata('logged_userrole_id');
		$uname=$this->session->userdata('logged_in');
		$log_data="This order(".$order_id.") has approved for retrun request by buyer";
				$data=array(
							
							'log_detail'=>$log_data,
							'user_id'=>$uid,
							'user_name'=>$uname,
							'log_datetime'=>$cdate
						);
						$this->db->insert('user_log',$data);	
	}
	 
	 
	 
	 function retrun_orderinfo_as_order_id($order_id)
	 {
		$query_return=$this->db->query("select a.*,c.name,d.imag,e.fname,e.lname,f.name as seller_name from return_product a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join product_general_info c on c.product_id=b.product_id inner join product_image d on c.product_id=d.product_id inner join user e on e.user_id=b.user_id inner join seller_account f on f.seller_id=b.seller_id  where a.order_id='$order_id' and a.sku=b.sku  ");
		
		$row_return=$query_return->result();
		
		return 	$row_return;  
			 
	 }
	 
	 
	  function replacement_ordercount()
	 {
		$query_return=$this->db->query("select a.*,c.name,d.fname,d.lname from return_product a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join seller_account c on c.seller_id=b.seller_id inner join user d on d.user_id=b.user_id where a.return_typ='Replacement'  AND a.return_request_approve_status='Approved' and a.is_replace='no' group by a.order_id ");
		$row_return=$query_return->result();
		return 	$row_return; 
	 }
	 
	 
	 
	 function select_refundOrder_relatedseller($replace_order_id)
	 {
		
			$Qrs_trans=$this->db->query("select a.user_id, a.quantity as cus_qantity,b.product_id,b.sku,b.mrp,b.price,b.special_price,b.shipping_fee_amount,b.stock_availability,b.approve_status,b.quantity,c.imag,d.business_name,e.name                                     as seller_name,f.name from ordered_product_from_addtocart a inner join product_master b on a.product_id = b.product_id inner join                                      product_image c on c.product_id = b.product_id inner join seller_account_information  d on d.seller_id=b.seller_id  inner join                                      seller_account e on e.seller_id=b.seller_id  inner join product_general_info f on b.product_id=f.product_id where a.order_id='$replace_order_id' and e.status='Active' and b.approve_status='Active' and b.stock_availability='In Stock' group by b.seller_id  ");
		

									  
			$row=$Qrs_trans->result();
			return $row;
	
	 }
	 
	 
	 
	 function reassign_orderReplace_Toseller($sku_arr_trans,$productid_arr_trans,$addtocarttemp_session_id,$userid_arr_trans,$fixedcharge_arr_trans,$buyerqnt_arr_trans,$old_orderid)
	 {
		
		
		 $user_id=$userid_arr_trans[0];
		 
		 //insert in addtocart_temptranfer table start
		 
		 $ct_sku_trans=count($sku_arr_trans);
		 
		 
		 for($i=0; $i<$ct_sku_trans; $i++)
		 {
		 	$addtocarttemp_id=$this->get_unique_id('addtocart_temptranfer','addtocart_id');
		 
				$data=array(
					'addtocart_id'=>$addtocarttemp_id,
					'addtocart_session_id'=>$addtocarttemp_session_id,
					'product_id'=>$productid_arr_trans[$i],
					'user_id'=>$userid_arr_trans[$i],
					'sku'=>$sku_arr_trans[$i],
					'fixed_price'=>$fixedcharge_arr_trans[$i]
					
				);
							
				for($j=1; $j<=$buyerqnt_arr_trans[$i]; $j++)
				{
					$qr=$this->db->insert('addtocart_temptranfer',$data);
					
					
				}
			
		 	}
		//insert in addtocart_temptranfer table end
		
		 $cart_data=$this->db->query("select * from addtocart_temptranfer where user_id='$user_id' group by sku  ");
		
		 $this->calculate_totalamount($cart_data->result(),$user_id,$old_orderid);
		 
		 //updation of old seller product quantity start
		//$query_oldsku=$this->db->query("select * from ordered_product_from_addtocart where order_id='$old_orderid' group by sku");
//		$row_oldsku=$query_oldsku->result();
//		$s=0;
//		 foreach($row_oldsku as $res_skutrans)
//		 {
//			 $old_transku=$res_skutrans->sku;
//			$query_sku=$this->db->query("select * from product_master where sku='$old_transku' ");
//			$row_sku=$query_sku->result();
//			
//			$updated_qnt=$row_sku[0]->quantity + $buyerqnt_arr_trans[$s];
//			
//			 $this->db->query("update product_master set quantity='$updated_qnt' where sku='$old_transku' ");
//		     $s++;	 
//		 }
		
		 //updation of old seller product quantity end
			
		//updation of return_order table is_replace column start
		
		
		$this->db->query("update return_product set is_replace='yes' where order_id='$old_orderid' ");
		
			
		//updation of return_order table is_replace column  end	 
		 
	}
	 
	 function count_graceperiodRequest()
	 {
		
		$query_greaceperiod_request=$this->db->query("select * from order_info where request_for_grace_period='yes' AND grace_period_approve_status='Not Approved' ");
		
		$row_greaceperiod_request=$query_greaceperiod_request->result();
		
		return $row_greaceperiod_request;
		 
	 }
	 
	 function grace_period_request_list()
	 {
		
		$query_grc_prd=$this->db->query("select a.*,c.pname from order_info a inner join ordered_product_from_addtocart b on a.order_id=b.order_id inner join seller_account_information c on b.seller_id=c.seller_id where a.request_for_grace_period='yes' Group By b.order_id ");
		
		return $query_grc_prd->result();
			 
	 }
	 
	 function approve_grace_period($order_id)
	 {
			date_default_timezone_set('Asia/Calcutta');
			$new_orders_date = date('Y-m-d H:i:s');
			$this->db->query("update order_info set order_confirm_for_seller_date='$new_orders_date', grace_period_approve_status='Approved' where order_id='$order_id' "); 
		 	
		 
	}
	
	function update_graceperiod_as_deny($order_id)
	{
		$this->db->query("update order_info set grace_period_approve_status='Not Approved', grace_period=0 where order_id='$order_id' "); 	
	}
	
	function transferTo_wallet($order_id,$user_id,$totrefund_amt)
	{
		
				$query_wallet=$this->db->query("select * from wallet_info where user_id='$user_id' ");
				$row_wallet=$query_wallet->row();
				
				$wallet_user_count=$query_wallet->num_rows();
				
				//date_default_timezone_set('Asia/Calcutta');
//				$dt = preg_replace("/[^0-9]+/","", date('Y-m-d H:i:s'));
				//$user_id=$this->session->userdata['session_data']['user_id'];
				//$unique_wallet_id='WL-'.$dt.$user_id;
				
				if($wallet_user_count==0)
				{
					$data_wallet=array(
					
					'user_id'=>$user_id,
					'wallet_balance'=>$totrefund_amt
					);
					$this->db->insert('wallet_info',$data_wallet);
				}
				else
				{
					$udated_wallet=$row_wallet->wallet_balance + $totrefund_amt;
					
					$this->db->query("update wallet_info set wallet_balance='$udated_wallet' where user_id='$user_id' ");	
				}
				
			//insert in wallet table end
			
			$this->db->query("update return_product set return_typ='Wallet' where order_id='$order_id' ");
			
			
	}
	 
	
}