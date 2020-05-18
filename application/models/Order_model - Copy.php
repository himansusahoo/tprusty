<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model
{
	function show_myordered($order_id_arr)
	{  //print_r($order_id_arr);exit;
		//$order_id_arrs=explode('-',$order_id_arr);
		$ord_str=array();
		$orderid_arr=explode(',',$order_id_arr); 
		foreach($orderid_arr as $key_ord=>$val_ord)
		{
			$newordr="'".$val_ord."'";
			array_push($ord_str,$newordr);
			
		}
		
			$order_id_arr=implode(',',$ord_str);
		
		if($this->session->userdata['session_data']['user_id']!="")
		{	$user_id=$this->session->userdata['session_data']['user_id'];
			//$query=$this->db->query("select a.* from ordered_product_from_addtocart a inner join order_info b on a.order_id=b.order_id where a.user_id='$user_id' and a.order_id IN ('$order_id_arr') and b.order_status='Pending payment' or b.order_status='Order confirmed' group by a.sku  ");
			$query=$this->db->query("SELECT * FROM order_info WHERE order_id IN ($order_id_arr) and (order_status='Pending payment' or order_status='Order confirmed')");
			return $query;	
		}
		else
		{
			$this->session->set_userdata('addtocarttemp_session_id');
			$product_id_arr=array();
			$product_id_arr=$this->session->set_userdata('addtocarttemp');
			$this->session->set_userdata('addtocart_sku');
			return $product_id_arr;				
		}
	}
	
	
	function show_myordered_with_payment_detail($order_id_arr)
	{  //print_r($order_id_arr);exit;
		//$order_id_arrs=explode('-',$order_id_arr);
			if($this->session->userdata['session_data']['user_id']!="")
			{	$user_id=$this->session->userdata['session_data']['user_id'];
				
								
				$query=$this->db->query("SELECT a.*,b.bank_ref_no,b.payment_mode,b.card_name,b.order_status FROM order_info a inner join payment_by_ccavenue_info b on a.order_id_payment_gateway=b.order_id  WHERE a.order_id IN ($order_id_arr) and (a.order_status='Order confirmed' or a.order_status='Failed' ) ");
				
				return $query->result();
					
			}
			else
			{
					
					$this->session->set_userdata('addtocarttemp_session_id');
		
					$product_id_arr=array();
					$product_id_arr=$this->session->set_userdata('addtocarttemp');
					
					$this->session->set_userdata('addtocart_sku');
					
					return $product_id_arr;				
			}		
		
	}
	
	
	//function delete_from_mycart($addtocart_id)
//	{
//		$user_id=$this->session->userdata['session_data']['user_id'];
//		$qr=$this->db->query("delete from addtocart_temp where addtocart_id='$addtocart_id' ");	
//					
//	}
	
	function customer_detail_for_myorder()
	{
		$user_id=$this->session->userdata['session_data']['user_id'];
		$query=$this->db->query("select a.mob,a.fname,a.lname, a.email,a.mob,b.* from user a inner join user_address b on a.user_id=b.user_id where a.user_id=$user_id and a.address_id=b.address_id  ");
		
		$rows=$query->row();
		return $rows;	
	}
	
	
	function update_myorderdata_aftercheckout($order_id_arr,$sku_arr)
	{
		
		$user_id=$this->session->userdata['session_data']['user_id'];
		$qantity_arr=explode('-',$this->session->userdata('sessqantity_arr'));
		$total_price=$this->session->userdata('sesstotal_price');
		$cod_total_price=$this->session->userdata('sesscodtotal_price');
		//date_default_timezone_set('Asia/Kolkata');
//		$dt=date('Y-m-d H:i:s');
		
		foreach($order_id_arr as $ky_ord=>$val_ord)
		{
			$this->db->query("UPDATE order_info SET order_processstatus='Order Placed Successfully By Buyer', order_id_payment_gateway='',payment_mode='1' WHERE order_id='$val_ord' ");
			
			if($total_price!=$cod_total_price && $cod_total_price!=0)
			{$this->db->query("UPDATE order_info SET Total_amount='$cod_total_price' WHERE order_id='$val_ord' ");}
		}
				
		
				//updation product inventory quantity and stock staus start
						
						$sku_qntarr=array();
						foreach($sku_arr as $keyskuqnt=>$valskuqnt)
						{ 	$skuqnt="'".$valskuqnt."'"; 
							array_push($sku_qntarr,$skuqnt);
							
						}
						$sku_qntstr=implode(',',$sku_qntarr);
						$query_qnt=$this->db->query("select * from addtocart_temp where user_id='$user_id' AND sku IN ($sku_qntstr) group by sku ");
						$k=0;
						foreach($query_qnt->result() as $rw)
						{
						//product quantity update start
							
							//$qnt_query=$this->db->query("select * from product_master where sku='$sku_arr[$i]' "); //modified
							
							$sku_id=$rw->sku;
							$qnt_query=$this->db->query("select * from product_master where sku='$sku_id' ");
							
							$qnt_rw=$qnt_query->row();
									
							$avl_qnt=$qnt_rw->quantity - $qantity_arr[$k];			
							
							$qnt_update_query=$this->db->query("update product_master set quantity='$avl_qnt' where sku='$sku_arr[$k]' ");
							
							
							//quantity update in seller product table start here//
								$query_slr_master = $this->db->query("SELECT * FROM seller_product_master WHERE sku='$sku_arr[$k]'");
								if($query_slr_master->num_rows() > 0){
									//$this->db->where('sku',$sku_arr[$k]);
//									$this->db->update('seller_product_master',$avl_qnt);
									$this->db->query("update seller_product_master set quantity='$avl_qnt' where sku='$sku_arr[$k]' ");
								}else{
									$query_slr_prd_gen = $this->db->query("SELECT * FROM seller_product_general_info WHERE sku='$sku_arr[$k]'");
									if($query_slr_prd_gen->num_rows() > 0){
										$result_slr_prdgen = $query_slr_prd_gen->result();
										$slr_prdt_id = $result_slr_prdgen[0]->seller_product_id;
										
										//$this->db->where('seller_product_id',$slr_prdt_id);
//										$this->db->update('seller_product_inventory_info',$avl_qnt);
										$this->db->query("update seller_product_inventory_info set quantity='$avl_qnt' where seller_product_id='$slr_prdt_id' ");
									}
								}
								//quantity update in seller product table end here//
							
										
							
							//product quantity update end
							
							
							//out of stock status update start
							
							$qnt_query1=$this->db->query("select * from product_master where sku='$sku_arr[$k]' ");
							$qnt_rw1=$qnt_query1->row();
									
							if($qnt_rw1->quantity==0)
							{
								$qnt_update_query1=$this->db->query("update product_master set stock_availability='Out of Stock' where sku='$sku_arr[$k]' ");	
							}			
							//out of stock status update end
							$k++;
					    }
						
						//updation product inventory quantity and stock staus end
						
						
						
						
			
			//------------------------------Data delete form cart start---------------------------------------
			
						$sku_qntarr=array();
						foreach($sku_arr as $keyskuqnt=>$valskuqnt)
						{ 	$skuqnt="'".$valskuqnt."'"; 
							array_push($sku_qntarr,$skuqnt);
							
						}
						$sku_qntstr=implode(',',$sku_qntarr);
						$query_select_addtocartdata=$this->db->query("select * from addtocart_temp where user_id='$user_id' AND sku IN ($sku_qntstr) group by sku ");
						$row_select_addtocartdata=$query_select_addtocartdata->result();
						
						foreach($row_select_addtocartdata as $rw1)
						{
							$this->db->query("delete from addtocart_temp where sku='$rw1->sku' and user_id='$rw1->user_id' ");	
						}
						//delete data from addtoacrt_temp start
				
				
				//------------------------------COD transaction as order wise start----------------------------
				 $order_idctr=count($order_id_arr);
				 
				  //$cod_totalprice=$this->session->userdata('sesstotal_price');
				   
				  $mail_query1=$this->db->query("select a.*,b.state from user a INNER JOIN user_address b ON a.address_id=b.address_id  where a.user_id='$user_id' ");
								$mail_row1=$mail_query1->row();
								
								$codcharge_stateid=$mail_row1->state; 
				  
				 
				 //---------------------------COD Data from session start-------------------//
		
				$cod_chargeaswtghtotal=$this->session->userdata('sesstotal_weightcharge');   
    			$codtaxamount=$this->session->userdata('sesstotal_taxchrgetobuyer');   
    			$cod_totalchargetobuyer=$this->session->userdata('sesstotal_chargetocustomer');		
				$cod_totalamountchargetomoonboy=$this->session->userdata('sesstotal_chargetomoonboy');		
				$cod_totaldiscountamount=$this->session->userdata('sesstotatl_discounttobuyer');
		
				$cod_totalpricewithtax_arr=explode('-',$this->session->userdata('sesscodtotal_price_arr'));  
				$total_weightcharge_arr=explode('-',$this->session->userdata('sesstotal_weightcharge_arr'));   
    			$total_taxchrgetobuyer_arr=explode('-',$this->session->userdata('sesstotal_taxchrgetobuyer_arr'));   
    			$total_chargetocustomer_arr=explode('-',$this->session->userdata('sesstotal_chargetocustomer_arr'));		
				$total_chargetomoonboy_arr=explode('-',$this->session->userdata('total_chargetomoonboy_arr'));		
				$totatl_discounttobuyer_arr=explode('-',$this->session->userdata('sesstotatl_discounttobuyer_arr'));
				$subtotalcod_arr=explode('-',$this->session->userdata('subtotal_arr'));
				$sessqantity_arr=explode('-',$this->session->userdata('sessqantity_arr'));
				
			//---------------------------COD Data from session end-------------------//

				 
				
				 for($ordctr=0; $ordctr<$order_idctr; $ordctr++)
				 { 		
				 		$cod_orderno=$order_id_arr[$ordctr];
						
						 	$qr_codtrans=$this->db->query("SELECT * FROM cod_transaction_log WHERE order_id='$cod_orderno' ");
							
							if($qr_codtrans->num_rows()>0)
							{$wt_charge=($qr_codtrans->row()->wt_charge)+$total_weightcharge_arr[$ordctr];
							 $tax=($qr_codtrans->row()->tax)+$total_taxchrgetobuyer_arr[$ordctr];
							 $charge_tobuyer=($qr_codtrans->row()->charge_tobuyer)+$total_chargetocustomer_arr[$ordctr];
							 $charge_tomoonboy=	($qr_codtrans->row()->charge_tomoonboy)+$total_chargetomoonboy_arr[$ordctr];
							 $discount_amount=($qr_codtrans->row()->discount_amount)+$totatl_discounttobuyer_arr[$ordctr];
							 
							 $this->db->query("UPDATE cod_transaction_log SET 
							 					wt_charge='$wt_charge',												
												charge_tobuyer='$charge_tobuyer',
												charge_tomoonboy='$charge_tomoonboy',
												discount_amount='$discount_amount'
												WHERE order_id='$cod_orderno'
												");
												
							$qr_ordeinfo=$this->db->query("SELECT Total_amount FROM order_info WHERE order_id='$cod_orderno' ");
							$Total_amount=$qr_ordeinfo->row()->Total_amount;
							
							
							$cod_total_price=$Total_amount+($cod_totalpricewithtax_arr[$ordctr]-$tax);
							$this->db->query("UPDATE order_info SET Total_amount='$cod_total_price' WHERE order_id='$cod_orderno' ");						
							}
							else
							{
							$data_codinfo=array(
								'order_id'=>$cod_orderno,
								'wt_charge'=>$total_weightcharge_arr[$ordctr]*$sessqantity_arr[$ordctr],
								'tax'=>$total_taxchrgetobuyer_arr[$ordctr],
								'charge_tobuyer'=>$total_chargetocustomer_arr[$ordctr]*$sessqantity_arr[$ordctr],
								'charge_tomoonboy'=>$total_chargetomoonboy_arr[$ordctr],
								'discount_amount'=>$totatl_discounttobuyer_arr[$ordctr],
															
							);
						
						 	$this->db->insert('cod_transaction_log',$data_codinfo);
							
							
							$cod_total_price=$cod_totalpricewithtax_arr[$ordctr]*$sessqantity_arr[$ordctr];
							$this->db->query("UPDATE order_info SET Total_amount='$cod_total_price' WHERE order_id='$cod_orderno' ");
							}
							//$this->db->query("UPDATE ordered_product_from_addtocart SET sub_total_amount='$cod_totalprice' WHERE order_id='$cod_orderno' ");
						  //----------------------------------------COD Charge amount distribution end------------------------
						 
						 
				 }
				
				//------------------------------COD transaction as order wise end-------------------------------
				
				
				//email send to customer start
							$order_id_arr_formail1=implode(',',$order_id_arr);
							$check_order_id_query3=$this->db->query("select distinct order_id from order_info where order_id IN ($order_id_arr_formail1)   ");
						//$ct_row2=$check_order_id_query2->num_rows();
			
						$row_for_mail1=$check_order_id_query3->result();
				 	
					foreach($row_for_mail1 as $res_email1)
					{    
							
							
								$mail_query1=$this->db->query("select a.*,b.state from user a INNER JOIN user_address b ON a.address_id=b.address_id  where a.user_id='$user_id' ");
								$mail_row1=$mail_query1->row();
								
								//$codcharge_stateid=$mail_row1->state;
								$email1=$mail_row1->email;
								//---------------------------Data For message start------------------------------
									
										
										$cart['order_id']=$res_email1->order_id;
										$cart['user_id']=$user_id;
										
								//-------------------------Data For message end----------------------------------
														   
										$this->email->set_mailtype("html");
										$this->email->from('support@moonboy.in', 'moonboy.in');
										$this->email->to($email1);
										//$this->email->to('santanu@paramountitsolutions.co.in');
										$this->email->subject('Order Placed Successfully-'  .$res_email1->order_id);
										$this->email->message($this->load->view('email_template/order_placed',$cart,true));
										//$this->email->message($message1);
										 //$this->email->attach(pdf_create($html, 'order_Slip'));
										$this->email->send();
										
										
										date_default_timezone_set('Asia/Calcutta');
										$dt = date('Y-m-d H:i:s');
									
										$msg=$this->load->view('email_template/order_placed',$cart,true);
										if($this->email->send()){
											
											$email_data=array(
											'to_email_id'=>$email1,
											'from_email_id'=>'support@moonboy.in',
											'date'=>$dt,
											'email_sub'=>'Order Placed Successfully-'  .$res_email1->order_id,
											'email_content'=>$msg,
											'email_send_status'=>'Success'
											);
										}else
										{
											
											$email_data=array(
											'to_email_id'=>$email1,
											'from_email_id'=>'support@moonboy.in',
											'date'=>$dt,
											'email_sub'=>'Order Placed Successfully-'  .$res_email1->order_id,
											'email_content'=>$msg,
											'email_send_status'=>'Failure'
											);
										}
										$this->db->insert('email_log',$email_data);						
							
					}
				
			//email send to customer end
				
				
					
						
						
				$this->db->query("delete from checkout_temp where user_id='$user_id'");
				
				$this->session->unset_userdata('sesscodtotal_price');
				$this->session->unset_userdata('orderidarr_seesion');
				$this->session->unset_userdata('sesssku_arr');
				
				$this->session->unset_userdata('sessaddtocart_id_arr');
				$this->session->unset_userdata('sesstotal_price');
				$this->session->unset_userdata('sessseller_id_arr');
				$this->session->unset_userdata('sesstax_arr');
				$this->session->unset_userdata('sessshipping_fees_arr');
				$this->session->unset_userdata('subtotal_arr');
				$this->session->unset_userdata('price_arr');
				$this->session->unset_userdata('sessqantity_arr');				
				$this->session->unset_userdata('sesscus_data');
				$this->session->unset_userdata('color_arr');
				$this->session->unset_userdata('size_arr');
				$this->session->unset_userdata('sessccavenue_order_id');
				
				
				//---------------------------COD session Data unset start-------------------//
		
				$this->session->unset_userdata('sesstotal_weightcharge');
	   
				$this->session->unset_userdata('sesstotal_taxchrgetobuyer');
	   
				$this->session->unset_userdata('sesstotal_chargetocustomer');
			
				$this->session->unset_userdata('sesstotal_chargetomoonboy');
			
				$this->session->unset_userdata('sesstotatl_discounttobuyer');
		
		
			//---------------------------COD session Data unset end-------------------//
				
		//------------------------------------Data delete form cart end--------------------------------------------		
		
			
	}
	
	
	function insert_myorderdata($addtocart_ids,$order_id_arr,$tax_arr,$shipping_fees_arr,$sub_total_arr,$qantity_arr,$sku_arr,$total_price,$seller_id_arr,$address_id,$price_arr,$color_arr,$size_arr)
	{
		$total_price=$this->session->userdata('sesstotal_price');
		$cod_total_price=$this->session->userdata('sesscodtotal_price'); 
		//transaction table insert function start//
		$this->insert_inn_transaction_details($order_id_arr,$qantity_arr,$sub_total_arr,$sku_arr,$seller_id_arr,$price_arr,$shipping_fees_arr);
		//transaction table insert function end//
		
		$i=0;	
		$user_id=$this->session->userdata['session_data']['user_id'];
		
		$query1=$this->db->query("select * from addtocart_temp where user_id='$user_id' group by sku ");
		
		$ct=$query1->num_rows();
		
		foreach($query1->result() as $rw)
		{	
			
			//product quantity update in product master table start here
			$sku_id=$rw->sku;
			$qnt_query=$this->db->query("select * from product_master where sku='$sku_id'");
			$qnt_rw=$qnt_query->row();
			$avl_qnt=$qnt_rw->quantity - $qantity_arr[$i];
			$qnt_update_query=$this->db->query("update product_master set quantity='$avl_qnt' where sku='$sku_arr[$i]'");
			//product quantity update in product master table end here

			//quantity update in seller product table start here//
			$sql1 = $this->db->query("SELECT * FROM seller_product_master WHERE sku='$sku_id'");
			if($sql1->num_rows() > 0){
				$slr_qnt_update_query=$this->db->query("update seller_product_master set quantity='$avl_qnt' where sku='$sku_arr[$i]'");
			}else{
				$sql2 = $this->db->query("SELECT * FROM seller_product_general_info WHERE sku='$sku_id'");
				if($sql2->num_rows() > 0){
					$result3 = $sql2->result();
					$slr_prdt_id = $result3[0]->seller_product_id;
					$slr_qnt_update_query=$this->db->query("update seller_product_inventory_info set quantity='$avl_qnt' where seller_product_id='$slr_prdt_id'");
				}
			}
			//quantity update in seller product table end here//
			
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
			'prdt_color'=>$color_arr[$i],
			'prdt_size'=>$size_arr[$i]
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
					'payment_mode'=>'1',
					'order_processstatus'=>'Order Placed Successfully By Buyer'			
					);
					
					$qr1=$this->db->insert('order_info',$data_order);
					
					$cod_orderid=$order_id_arr[$i]; 
					if($total_price!=$cod_total_price && $cod_total_price!=0)
			{$this->db->query("UPDATE order_info SET Total_amount='$cod_total_price' WHERE order_id='$cod_orderid' ");}				
					
			}
			
			else
			{
				$row_order_info=$check_order_id_query->row();
				$tot_amt=$row_order_info->Total_amount + $sub_total_arr[$i];
				//$upd_query=$this->db->query("update order_info set Total_amount='$tot_amt' where order_id='$order_id_arr[$i]'");
				$updt_data = array('Total_amount' => $tot_amt);
				$this->db->where('order_id',$order_id_arr[$i]);
				$this->db->update('order_info',$updt_data);
				
				//$cod_orderid=$order_id_arr[$i];
				//if($total_price!=$cod_total_price && $cod_total_price!=0)
//			{$this->db->query("UPDATE order_info SET Total_amount='$cod_total_price' WHERE order_id='$cod_orderid' ");}
			
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
			
			$this->db->query("delete from addtocart_temp where sku='$rw->sku' and user_id='$rw->user_id' ");
			$this->db->query("delete from checkout_temp where user_id='$rw->user_id'");
			
			$i++;
		}
		
		
			
											//------------------------------COD transaction as order wise start----------------------------
				 $order_idctr=count($order_id_arr);
				 
				  //$cod_totalprice=$this->session->userdata('sesstotal_price');
				   
				   
				  $mail_query1=$this->db->query("select a.*,b.state from user a INNER JOIN user_address b ON a.address_id=b.address_id  where a.user_id='$user_id'  ");
					$mail_row1=$mail_query1->row();
											
					$codcharge_stateid=$mail_row1->state;			
					
					
					 //---------------------------COD Data from session start-------------------//
		
				$cod_chargeaswtghtotal=$this->session->userdata('sesstotal_weightcharge');
   
    			$codtaxamount=$this->session->userdata('sesstotal_taxchrgetobuyer');
   
    			$cod_totalchargetobuyer=$this->session->userdata('sesstotal_chargetocustomer');
		
				$cod_totalamountchargetomoonboy=$this->session->userdata('sesstotal_chargetomoonboy');
		
				$cod_totaldiscountamount=$this->session->userdata('sesstotatl_discounttobuyer');
		
		
			//---------------------------COD Data from session end-------------------//
			
			
				 for($ordctr=0; $ordctr<$order_idctr; $ordctr++)
				 { 		
				 		$cod_orderno=$order_id_arr[$ordctr];
						
						 	$data_codinfo=array(
								'order_id'=>$cod_orderno,
								'wt_charge'=>$cod_chargeaswtghtotal,
								'tax'=>$codtaxamount,
								'charge_tobuyer'=>$cod_totalchargetobuyer,
								'charge_tomoonboy'=>$cod_totalamountchargetomoonboy,
								'discount_amount'=>$cod_totaldiscountamount
															
							);
						 
						 	$this->db->insert('cod_transaction_log',$data_codinfo);
							
							
							$this->db->query("UPDATE order_info SET Total_amount='$cod_total_price' WHERE order_id='$cod_orderno' ");
							//$this->db->query("UPDATE ordered_product_from_addtocart SET sub_total_amount='$cod_totalprice' WHERE order_id='$cod_orderno' ");
						  //----------------------------------------COD Charge amount distribution end------------------------
						 
						 
				 }
					
				
				
				//------------------------------COD transaction as order wise end-------------------------------			
				
				
				
				//email send to customer start
			$order_id_arr_formail=implode(',',$order_id_arr);
			$check_order_id_query2=$this->db->query("select distinct order_id from order_info where order_id IN ($order_id_arr_formail)   ");
			//$ct_row2=$check_order_id_query2->num_rows();
			
			$row_for_mail=$check_order_id_query2->result();
				 	
					foreach($row_for_mail as $res_email)
					{    

											$mail_query1=$this->db->query("select a.*,b.state from user a INNER JOIN user_address b ON a.address_id=b.address_id  where a.user_id='$user_id'  ");
											$mail_row1=$mail_query1->row();
											
											$codcharge_stateid=$mail_row1->state;
											$email1=$mail_row1->email;
								//---------------------------Data For message start------------------------------
									
										
										$cart['order_id']=$res_email->order_id;
										$cart['user_id']=$user_id;
										
								//-------------------------Data For message end----------------------------------
														   
										$this->email->set_mailtype("html");
										$this->email->from('support@moonboy.in', 'moonboy.in');
										$this->email->to($email1);
										//$this->email->to('santanu@paramountitsolutions.co.in');
										$this->email->subject('Order Placed Successfully-'  .$res_email->order_id);
										$this->email->message($this->load->view('email_template/order_placed',$cart,true));
										//$this->email->message($message1);
										 //$this->email->attach(pdf_create($html, 'order_Slip'));
										$this->email->send();
										
										
										date_default_timezone_set('Asia/Calcutta');
										$dt = date('Y-m-d H:i:s');
									
										$msg=$this->load->view('email_template/order_placed',$cart,true);
										if($this->email->send()){
											
											$email_data=array(
											'to_email_id'=>$email1,
											'from_email_id'=>'support@moonboy.in',
											'date'=>$dt,
											'email_sub'=>'Order Placed Successfully-'.$res_email->order_id,
											'email_content'=>$msg,
											'email_send_status'=>'Success'
											);
										}else
										{
											
											$email_data=array(
											'to_email_id'=>$email1,
											'from_email_id'=>'support@moonboy.in',
											'date'=>$dt,
											'email_sub'=>'Order Placed Successfully-'.$res_email->order_id,
											'email_content'=>$msg,
											'email_send_status'=>'Failure'
											);
										}
										$this->db->insert('email_log',$email_data);						
							
					}
				
			//email send to customer end	
			
			
			
									//$this->session->unset_userdata('orderidarr_seesion');
									$this->session->unset_userdata('sesssku_arr');									
									$this->session->unset_userdata('sessaddtocart_id_arr');
									$this->session->unset_userdata('sesstotal_price');
									$this->session->unset_userdata('sessseller_id_arr');
									$this->session->unset_userdata('sesstax_arr');
									$this->session->unset_userdata('sessshipping_fees_arr');
									$this->session->unset_userdata('subtotal_arr');
									$this->session->unset_userdata('price_arr');
									$this->session->unset_userdata('sessqantity_arr');				
									$this->session->unset_userdata('sesscus_data');
									$this->session->unset_userdata('color_arr');
									$this->session->unset_userdata('size_arr');
									$this->session->unset_userdata('sessccavenue_order_id');
									
									
									//---------------------------COD session Data unset start-------------------//
		
										$this->session->unset_userdata('sesstotal_weightcharge');
							   
										$this->session->unset_userdata('sesstotal_taxchrgetobuyer');
							   
										$this->session->unset_userdata('sesstotal_chargetocustomer');
									
										$this->session->unset_userdata('sesstotal_chargetomoonboy');
									
										$this->session->unset_userdata('sesstotatl_discounttobuyer');
								
								
									//---------------------------COD session Data unset end-------------------//
			
	}
	
	
	function insert_myorderdata_wallet($addtocart_ids,$order_id_arr,$tax_arr,$shipping_fees_arr,$sub_total_arr,$qantity_arr,$sku_arr,$total_price,$seller_id_arr,$address_id,$price_arr,$color_arr,$size_arr,$deduct_wallet_bal)
	{
		//print_r($order_id_arr);exit;
		//generate transaction id start here
		date_default_timezone_set('Asia/Calcutta');
        $dtm = preg_replace("/[^0-9]+/","", date('Y-m-d H:i:s'));
		$transaction_id = 'ADJ-WL'.$dtm;
		//generate transaction id end here
		
		$chkout_session_id = $this->session->userdata('chkoutemp_session_id');
		//transaction table insert function start//
		$this->insert_inn_transaction_details($order_id_arr,$qantity_arr,$sub_total_arr,$sku_arr,$seller_id_arr,$price_arr,$shipping_fees_arr);
		//transaction table insert function end//
		
		$i=0;	
		$user_id=$this->session->userdata['session_data']['user_id'];
		
		$sku_qntarr=array();
		foreach($sku_arr as $keyskuqnt=>$valskuqnt)
		{ 	$skuqnt="'".$valskuqnt."'"; 
			array_push($sku_qntarr,$skuqnt);
			
		}
		$sku_qntstr=implode(',',$sku_qntarr);
		$query1=$this->db->query("select * from addtocart_temp where user_id='$user_id' AND sku IN ($sku_qntstr) group by sku ");
		$ct=$query1->num_rows();
		
		foreach($query1->result() as $rw)
		{
			//product quantity update start
			$sku_id=$rw->sku;
			$qnt_query=$this->db->query("select * from product_master where sku='$sku_id' ");
			$qnt_rw=$qnt_query->row();
			$avl_qnt=$qnt_rw->quantity - $qantity_arr[$i];			
			
			$qnt_update_query=$this->db->query("update product_master set quantity='$avl_qnt' where sku='$sku_arr[$i]' ");			
			
			//product quantity update end
			
			
			//out of stock status update start
			$qnt_query1=$this->db->query("select * from product_master where sku='$sku_arr[$i]'");
			$qnt_rw1=$qnt_query1->row();
			
			if($qnt_rw1->quantity==0)
			{
				$qnt_update_query1=$this->db->query("update product_master set stock_availability='Out of Stock' where sku='$sku_arr[$i]' ");	
			}
			//out of stock status update end
			
			$addtocart_id=$this->get_unique_id('ordered_product_from_addtocart','addtocart_id');
			
			$data=array(
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
				'prdt_color'=>$color_arr[$i],
				'prdt_size'=>$size_arr[$i],
				'product_order_status'=>'Order confirmed'
			);
			$this->db->insert('ordered_product_from_addtocart',$data);
			
			$check_order_id_query=$this->db->query("select * from order_info where order_id='$order_id_arr[$i]'");
			$ct_row=$check_order_id_query->num_rows();
			
			if($ct_row==0)
			{
				$order_track_id=$this->get_unique_id('order_info','order_track_id');
				date_default_timezone_set('Asia/Kolkata');
				$dt=date('Y-m-d H:i:s');
		
				$data_order=array (
				'order_id_payment_gateway'=>$transaction_id,
				'order_track_id'=>$order_track_id,
				'order_id'=>$order_id_arr[$i],
				'Total_amount'=>$sub_total_arr[$i],
				'date_of_order'=>$dt,
				'payment_mode'=>'3',
				'order_status'=>'Order confirmed'			
				);
				$this->db->insert('order_info',$data_order);
			}
			else
			{
				$row_order_info=$check_order_id_query->row();
				$tot_amt=$row_order_info->Total_amount + $sub_total_arr[$i];
				//$this->db->query("update order_info set Total_amount=50 AND order_id_payment_gateway='$transaction_id' where order_id='$order_id_arr[$i]'");
				$updt_data = array(
					'Total_amount' => $tot_amt,
					'order_id_payment_gateway' => $transaction_id,
				);
				$this->db->where('order_id',$order_id_arr[$i]);
				$this->db->update('order_info',$updt_data);
			}
			
			//INSERT OF ADDRESS DATA START
			$check_shippingaddress_query=$this->db->query("select * from shipping_address where order_id='$order_id_arr[$i]'");
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
			
			$this->db->query("delete from addtocart_temp where sku='$rw->sku' and user_id='$rw->user_id' ");	
			$this->db->query("delete from checkout_temp where user_id='$rw->user_id'");
			$i++;
		}
		
		//update wallet balance
		$query_wallet=$this->db->query("select * from wallet_info where user_id='$user_id'");
		$row_wallet = $query_wallet->row();
		//$udated_wallet=$row_wallet->wallet_balance - $total_price;
		$udated_wallet = $row_wallet->wallet_balance - $deduct_wallet_bal;
		$this->db->query("update wallet_info set wallet_balance='$udated_wallet' WHERE user_id='$user_id'");
		//update wallet balance
		
		//retrieving payment adjust temp data and insert into payment adjust main table program start here
		$tmp_query = $this->db->query("SELECT * FROM pay_adjust_data_temp WHERE chkout_session_id='$chkout_session_id' AND user_id='$user_id'");
		$tmp_result = $tmp_query->result();
		foreach($tmp_result as $tmp_row){
			$pay_adjust_id = $this->get_unique_id('pay_adjust_data','pay_adjust_id');
			$tmp_data = array(
				'pay_adjust_id' => $pay_adjust_id,
				'transaction_id' => $transaction_id,
				'transaction_date' => $tmp_row->transaction_date,
				'adj_type' => $tmp_row->adj_type,
				'adj_type_id' => $tmp_row->adj_type_id,
				'adj_amount' => $tmp_row->adj_amount,
				'adj_percent' => $tmp_row->adj_percent
			);
			$this->db->insert('pay_adjust_data',$tmp_data);
		}
		
		//update purchase gift voucher data program start here//
		$this->load->model('My_wallet_model');
		$gv_sql = $this->db->query("SELECT adj_type_id FROM pay_adjust_data_temp WHERE chkout_session_id='$chkout_session_id' AND adj_type='V'");
		if($gv_sql->num_rows() > 0){
			foreach($gv_sql->result() as $vchr_no_row){
				$voucher_no_arr[] = $vchr_no_row->adj_type_id;
			}
			$vchr_gft_data = array(
				'used_id' => $user_id,
				'transaction_id' => $transaction_id,
				'status' => 'U'
			);
			$this->My_wallet_model->update_purchase_gift_voucher_data($voucher_no_arr,$vchr_gft_data);
		}
		//update purchase gift voucher data program end here//
		
		//update purchase coupon data program start here//
		$cpn_sql = $this->db->query("SELECT adj_type_id FROM pay_adjust_data_temp WHERE chkout_session_id='$chkout_session_id' AND adj_type='C'");
		if($cpn_sql->num_rows() > 0){
			foreach($cpn_sql->result() as $copn_code_row){
				$copn_code_arr[] = $copn_code_row->adj_type_id;
			}
			$copn_data = array(
				'used_id' => $user_id,
				'transaction_id' => $transaction_id,
				'status' => 'U'
			);
			$this->My_wallet_model->update_purchase_coupon_data($copn_code_arr,$copn_data);
		}
		//update purchase coupon data program end here//	
		//retrieving payment adjust temp data and insert into payment adjust main table program end here
		
		//delete pay_adjust_data_temp table data
		$this->db->where('chkout_session_id',$chkout_session_id);
		$this->db->delete('pay_adjust_data_temp');
		
		//email send to customer start
			$order_id_arr_formail=implode(',',$order_id_arr);
			$check_order_id_query2=$this->db->query("select distinct order_id from order_info where order_id IN ($order_id_arr_formail)   ");
			//$ct_row2=$check_order_id_query2->num_rows();
			
			$row_for_mail=$check_order_id_query2->result();
				 
				foreach($row_for_mail as $res_email)
				{
					$mail_query=$this->db->query("select * from user where user_id='$user_id' ");
					$mail_row=$mail_query->row();
					$email=$mail_row->email;
					$message = "
							<div style='padding:20px;'> <h5>Thank You For Your Order From moonboy.in !</h5>
							<p></p>
							<strong>Your ORDER ID is : " .$res_email->order_id ."<br/><br/>
									</strong><br/>
							<p>We will send you another email once the items in your order have been shipped. Meanwhile, you can check the status of your order on 		                                   moonboy.in </p><br/>
							
							<p align='center'> <input type='button' value='Track Order'/ > </p>
							   Thanks & regards,<br/>Moonboy Team <br/>
							 </div>
							
							<div style='text-align:center; background-color:#0e4370; color:#fff; padding:10px;'>
							<p> copyright@ 2015 Moonboy . All rights reserved . </p>
						   </div>";
						   
						   
							$this->email->set_mailtype("html");
							$this->email->from('support@moonboy.in', 'moonboy.in');
							$this->email->to('$email');
							$this->email->subject('Welcome to Moonboy.in');
							$this->email->message($message);
							$this->email->send();
				}
			//email send to customer end
	}
	
	
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
	
	
	
	function insert_onlinepayment_orderdata($addtocart_ids,$order_id_arr,$tax_arr,$shipping_fees_arr,$sub_total_arr,$qantity_arr,$sku_arr,$total_price,$seller_id_arr,$address_id,$order_id_payment_gateway,$price_arr,$color_arr,$size_arr)
	{
		//transaction table insert function start//
		$this->insert_inn_transaction_details($order_id_arr,$qantity_arr,$sub_total_arr,$sku_arr,$seller_id_arr,$price_arr,$shipping_fees_arr);
		//transaction table insert function end//
		
		$i=0;	
		$user_id=$this->session->userdata['session_data']['user_id'];
		
		$query1=$this->db->query("select * from addtocart_temp where user_id='$user_id' group by sku ");
		
		//$row1=$query1->result();
		
		$ct=$query1->num_rows();
		
		
		foreach($query1->result() as $rw)
		{		
			
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
			'prdt_color'=>$color_arr[$i],
			'prdt_size'=>$size_arr[$i]
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
					'order_id_payment_gateway'=>$order_id_payment_gateway,
					'Total_amount'=>$sub_total_arr[$i],
					'date_of_order'=>$dt,
					'payment_mode'=>'2',
					//'order_confirm_for_seller'=>'Approved'			
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
			
			$i++;	
			
		}
			
		
			//Data insert from ccAvenue API START
				$this->load->model('Crypto');
				
				//error_reporting(0);
				
				$workingKey='A6E109AE1CF65837E8964E0B04552D21';		//Working Key should be provided here.
				$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
				$rcvdString=$this->Crypto->decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
				$order_status="";
				$decryptValues=explode('&', $rcvdString);
				$dataSize=sizeof($decryptValues);
				
				$payment_info=array();
							
				for($i = 0; $i < $dataSize; $i++) 
					{
						$information=explode('=',$decryptValues[$i]);
						if($i==3)	$order_status=$information[1];
					}
					$j=0;
					if($order_status=="Success")
					{
						
						//echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";					
						foreach($order_id_arr as $k=>$v)
						{ 
						
						$update_query2=$this->db->query("update ordered_product_from_addtocart set product_order_status='Order confirmed' where order_id='$order_id_arr[$j]' and user_id='$user_id' ");
						
						$qsr1=$this->db->query("select * from order_info where order_id='$order_id_arr[$j]' and order_status='Pending payment' "); 
						$ct_order_status=$qsr1->num_rows();
						if($ct_order_status>0)
						{
							$update_query1=$this->db->query("update order_info set order_status='Order confirmed' where order_id='$order_id_arr[$j]' ");
						}
						$j++;
						}
						
						//updation product inventory quantity and stock staus start
						$query_qnt=$this->db->query("select * from addtocart_temp where user_id='$user_id' group by sku ");
						$k=0;
						foreach($query_qnt->result() as $rw)
						{
						//product quantity update start
							
							//$qnt_query=$this->db->query("select * from product_master where sku='$sku_arr[$i]' "); //modified
							
							$sku_id=$rw->sku;
							$qnt_query=$this->db->query("select * from product_master where sku='$sku_id' ");
							
							$qnt_rw=$qnt_query->row();
									
							$avl_qnt=$qnt_rw->quantity - $qantity_arr[$k];			
							
							$qnt_update_query=$this->db->query("update product_master set quantity='$avl_qnt' where sku='$sku_arr[$k]' ");
							
							
							//quantity update in seller product table start here//
								$query_slr_master = $this->db->query("SELECT * FROM seller_product_master WHERE sku='$sku_arr[$k]'");
								if($query_slr_master->num_rows() > 0){
									//$this->db->where('sku',$sku_arr[$k]);
//									$this->db->update('seller_product_master',$avl_qnt);
									$this->db->query("update seller_product_master set quantity='$avl_qnt' where sku='$sku_arr[$k]' ");
								}else{
									$query_slr_prd_gen = $this->db->query("SELECT * FROM seller_product_general_info WHERE sku='$sku_arr[$k]'");
									if($query_slr_prd_gen->num_rows() > 0){
										$result_slr_prdgen = $query_slr_prd_gen->result();
										$slr_prdt_id = $result_slr_prdgen[0]->seller_product_id;
										
										//$this->db->where('seller_product_id',$slr_prdt_id);
//										$this->db->update('seller_product_inventory_info',$avl_qnt);
										$this->db->query("update seller_product_inventory_info set quantity='$avl_qnt' where seller_product_id='$slr_prdt_id' ");
									}
								}
								//quantity update in seller product table end here//
							
										
							
							//product quantity update end
							
							
							//out of stock status update start
							
							$qnt_query1=$this->db->query("select * from product_master where sku='$sku_arr[$k]' ");
							$qnt_rw1=$qnt_query1->row();
									
							if($qnt_rw1->quantity==0)
							{
								$qnt_update_query1=$this->db->query("update product_master set stock_availability='Out of Stock' where sku='$sku_arr[$k]' ");	
							}			
							//out of stock status update end
							$k++;
					    }
						
						//updation product inventory quantity and stock staus end
						
						
						
						//email send to customer start
							$order_id_arr_formail1=implode(',',$order_id_arr);
							$check_order_id_query3=$this->db->query("select distinct order_id from order_info where order_id IN ($order_id_arr_formail1)   ");
						//$ct_row2=$check_order_id_query2->num_rows();
			
						$row_for_mail1=$check_order_id_query3->result();
				 	
					foreach($row_for_mail1 as $res_email1)
					{    
							
							//$html=$this->load->view('admin/order_slip',$res_email1->order_id, true) ;
//							$this->load->helper(array('dompdf/dompdf_helper', 'file'));
							//pdf_create($html, 'order_Slip');
							
								$mail_query1=$this->db->query("select * from user where user_id='$user_id' ");
								$mail_row1=$mail_query1->row();
								$email1=$mail_row1->email;
								//---------------------------Data For message start------------------------------
									
										
										$cart['order_id']=$res_email1->order_id;
										$cart['user_id']=$user_id;
										
								//-------------------------Data For message end----------------------------------
														   
										$this->email->set_mailtype("html");
										$this->email->from('support@moonboy.in', 'moonboy.in');
										$this->email->to($email1);
										//$this->email->to('santanu@paramountitsolutions.co.in');
										$this->email->subject('Ordered Successfully from moonboy.in');
										$this->email->message($this->load->view('email_template/order_placed',$cart,true));
										//$this->email->message($message1);
										 //$this->email->attach(pdf_create($html, 'order_Slip'));
										$this->email->send();
										
										
										date_default_timezone_set('Asia/Calcutta');
										$dt = date('Y-m-d H:i:s');
									
										$msg=$this->load->view('email_template/order_placed',$cart,true);
										if($this->email->send()){
											
											$email_data=array(
											'to_email_id'=>$email1,
											'from_email_id'=>'support@moonboy.in',
											'date'=>$dt,
											'email_sub'=>'Ordered Successfully from moonboy.in',
											'email_content'=>$msg,
											'email_send_status'=>'Success'
											);
										}else
										{
											
											$email_data=array(
											'to_email_id'=>$email1,
											'from_email_id'=>'support@moonboy.in',
											'date'=>$dt,
											'email_sub'=>'Ordered Successfully from moonboy.in',
											'email_content'=>$msg,
											'email_send_status'=>'Failure'
											);
										}
										$this->db->insert('email_log',$email_data);						
							
					}
				
			//email send to customer end
						
				
						
						
					}
					else if($order_status=="Aborted" || $order_status=="Failure" )
					{
						
						//email send to customer when payment failure start 
							$order_id_arr_formail2=implode(',',$order_id_arr);
							$check_order_id_query3=$this->db->query("select distinct order_id from order_info where order_id IN ($order_id_arr_formail2)   ");
						//$ct_row2=$check_order_id_query2->num_rows();
			
						$row_for_mail2=$check_order_id_query3->result();
				 	
					foreach($row_for_mail2 as $res_email2)
					{
						//getting order details
						$order_sql = $this->db->query("SELECT sku,quantity,sub_total_amount FROM ordered_product_from_addtocart WHERE order_id='$res_email2->order_id'");
						$order_res = $order_sql->row();
						$order_sku = $order_res->sku;
						
						$order_sql1 = $this->db->query("SELECT a.name FROM product_general_info a INNER JOIN product_master b ON a.product_id=b.product_id WHERE b.sku='$order_sku'");
						$order_res1 = $order_sql1->result();
						
							$mail_query2=$this->db->query("select * from user where user_id='$user_id' ");
								$mail_row2=$mail_query2->row();
								$email2=$mail_row2->email;
								
								//---------------------------Data For message start------------------------------
									
										
										$cart['order_id']=$res_email2->order_id;
										$cart['user_id']=$user_id;
										
								//-------------------------Data For message end----------------------------------
								
									   
										$this->email->set_mailtype("html");
										$this->email->from('support@moonboy.in', 'moonboy.in');
										$this->email->to($email2);
										$this->email->subject('Online Payment Failure');
										$this->email->message($this->load->view('email_template/order_failure',$cart,true));
										$this->email->send();					
							
					}
				
			//email send to customer when payment failure end
						
						
						
						//echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
						
						
						foreach($order_id_arr as $k=>$v)
						{ 
						
						$update_query2=$this->db->query("update ordered_product_from_addtocart set product_order_status='Failed' where order_id='$order_id_arr[$j]' and user_id='$user_id' ");
						
						$qsr1=$this->db->query("select * from order_info where order_id='$order_id_arr[$j]' and order_status='Pending payment' "); 
						$ct_order_status=$qsr1->num_rows();
						if($ct_order_status>0)
						{
							$update_query1=$this->db->query("update order_info set order_status='Failed' where order_id='$order_id_arr[$j]' ");
						}
							$j++;
						}
						
					
					}					
					else
					{
						
						//email send to customer when payment failure start 
							$order_id_arr_formail3=implode(',',$order_id_arr);
							$check_order_id_query4=$this->db->query("select distinct order_id from order_info where order_id IN ($order_id_arr_formail3)   ");
						//$ct_row2=$check_order_id_query2->num_rows();
			
						$row_for_mail3=$check_order_id_query4->result();
				 	
					foreach($row_for_mail3 as $res_email3)
					{    
							//getting order details
						$order_sql = $this->db->query("SELECT sku,quantity,sub_total_amount FROM ordered_product_from_addtocart WHERE order_id='$res_email3->order_id'");
						$order_res = $order_sql->row();
						$order_sku = $order_res->sku;
						
						$order_sql1 = $this->db->query("SELECT a.name FROM product_general_info a INNER JOIN product_master b ON a.product_id=b.product_id WHERE b.sku='$order_sku'");
						$order_res1 = $order_sql1->result();
							
							$mail_query3=$this->db->query("select * from user where user_id='$user_id' ");
								$mail_row3=$mail_query3->row();
								$email3=$mail_row3->email;
								
									   
									   $cart['order_id']=$res_email3->order_id;
										$cart['user_id']=$user_id;
										$this->email->set_mailtype("html");
										$this->email->from('support@moonboy.in', 'moonboy.in');
										$this->email->to($email3);
										$this->email->subject('Online Payment Failure');
										$this->email->message($this->load->view('email_template/order_failure',$cart,true));
										$this->email->send();					
							
					}
				
			//email send to customer when payment failure end				
						
						foreach($order_id_arr as $k=>$v)
						{ 
						
						$update_query2=$this->db->query("update ordered_product_from_addtocart set product_order_status='Failed' where order_id='$order_id_arr[$j]' and user_id='$user_id' ");
						
						$qsr1=$this->db->query("select * from order_info where order_id='$order_id_arr[$j]' and order_status='Pending payment' "); 
						$ct_order_status=$qsr1->num_rows();
						if($ct_order_status>0)
						{
							$update_query1=$this->db->query("update order_info set order_status='Failed' where order_id='$order_id_arr[$j]' ");
						}
						$j++;
						}
						
						//echo "<br>Security Error. Illegal access detected";
					
					}
				
				
				
				for($i = 0; $i < $dataSize; $i++) 
				{
					$information=explode('=',$decryptValues[$i]);
					
					//$payment_info[$i]=$information[1];
						//echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
						$ky[]=$information[0];
						$val[]=$information[1];
				}
				
				$payment_info=array_combine($ky,$val);
				//print_r($payment_info);exit;
							
				$this->db->insert('payment_by_ccavenue_info',$payment_info);
								
		   //	Data insert from ccAvenue API 
		
		          //delete data from addtoacrt_temp start
						$query_select_addtocartdata=$this->db->query("select * from addtocart_temp where user_id='$user_id' group by sku ");
						$row_select_addtocartdata=$query_select_addtocartdata->result();
						
						foreach($row_select_addtocartdata as $rw1)
						{
							$this->db->query("delete from addtocart_temp where sku='$rw1->sku' and user_id='$rw1->user_id' ");	
						}
						//delete data from addtoacrt_temp start
				$this->db->query("delete from checkout_temp where user_id='$user_id'");
	}
	
	function update_onlinepaymentinfo($order_id_arr,$sku_arr)
	{
		$user_id=$this->session->userdata['session_data']['user_id'];
		$qantity_arr=explode('-',$this->session->userdata('sessqantity_arr'));
		//date_default_timezone_set('Asia/Kolkata');
//		$dt=date('Y-m-d H:i:s');
		
		foreach($order_id_arr as $ky_ord=>$val_ord)
		{
			$this->db->query("UPDATE order_info SET order_processstatus='Order Placed Successfully By Buyer' WHERE order_id='$val_ord' ");
		}

			//Data insert from ccAvenue API START
				$this->load->model('Crypto');
				
				//error_reporting(0);
				
				$workingKey='A6E109AE1CF65837E8964E0B04552D21';		//Working Key should be provided here.
				$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
				$rcvdString=$this->Crypto->decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
				$order_status="";
				$decryptValues=explode('&', $rcvdString);
				$dataSize=sizeof($decryptValues);
				
				$payment_info=array();
							
				for($i = 0; $i < $dataSize; $i++) 
					{
						$information=explode('=',$decryptValues[$i]);
						if($i==3)	$order_status=$information[1];
					}
					$j=0;
					if($order_status=="Success")
					{
						
						//echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";					
						foreach($order_id_arr as $k=>$v)
						{ 
						
						$update_query2=$this->db->query("update ordered_product_from_addtocart set product_order_status='Order confirmed' where order_id='$order_id_arr[$j]' and user_id='$user_id' ");
						
						$qsr1=$this->db->query("select * from order_info where order_id='$order_id_arr[$j]' and order_status='Pending payment' "); 
						$ct_order_status=$qsr1->num_rows();
						if($ct_order_status>0)
						{
							$update_query1=$this->db->query("update order_info set order_status='Order confirmed' where order_id='$order_id_arr[$j]' ");
						}
						$j++;
						}
						
						//updation product inventory quantity and stock staus start
						
						$sku_qntarr=array();
						foreach($sku_arr as $keyskuqnt=>$valskuqnt)
						{ 	$skuqnt="'".$valskuqnt."'"; 
							array_push($sku_qntarr,$skuqnt);
							
						}
						$sku_qntstr=implode(',',$sku_qntarr);
						$query_qnt=$this->db->query("select * from addtocart_temp where user_id='$user_id' AND sku IN ($sku_qntstr) group by sku ");
						$k=0;
						foreach($query_qnt->result() as $rw)
						{
						//product quantity update start
							
							//$qnt_query=$this->db->query("select * from product_master where sku='$sku_arr[$i]' "); //modified
							
							$sku_id=$rw->sku;
							$qnt_query=$this->db->query("select * from product_master where sku='$sku_id' ");
							
							$qnt_rw=$qnt_query->row();
									
							$avl_qnt=$qnt_rw->quantity - $qantity_arr[$k];			
							
							$qnt_update_query=$this->db->query("update product_master set quantity='$avl_qnt' where sku='$sku_arr[$k]' ");
							
							
							//quantity update in seller product table start here//
								$query_slr_master = $this->db->query("SELECT * FROM seller_product_master WHERE sku='$sku_arr[$k]'");
								if($query_slr_master->num_rows() > 0){
									//$this->db->where('sku',$sku_arr[$k]);
//									$this->db->update('seller_product_master',$avl_qnt);
									$this->db->query("update seller_product_master set quantity='$avl_qnt' where sku='$sku_arr[$k]' ");
								}else{
									$query_slr_prd_gen = $this->db->query("SELECT * FROM seller_product_general_info WHERE sku='$sku_arr[$k]'");
									if($query_slr_prd_gen->num_rows() > 0){
										$result_slr_prdgen = $query_slr_prd_gen->result();
										$slr_prdt_id = $result_slr_prdgen[0]->seller_product_id;
										
										//$this->db->where('seller_product_id',$slr_prdt_id);
//										$this->db->update('seller_product_inventory_info',$avl_qnt);
										$this->db->query("update seller_product_inventory_info set quantity='$avl_qnt' where seller_product_id='$slr_prdt_id' ");
									}
								}
								//quantity update in seller product table end here//
							
										
							
							//product quantity update end
							
							
							//out of stock status update start
							
							$qnt_query1=$this->db->query("select * from product_master where sku='$sku_arr[$k]' ");
							$qnt_rw1=$qnt_query1->row();
									
							if($qnt_rw1->quantity==0)
							{
								$qnt_update_query1=$this->db->query("update product_master set stock_availability='Out of Stock' where sku='$sku_arr[$k]' ");	
							}			
							//out of stock status update end
							$k++;
					    }
						
						//updation product inventory quantity and stock staus end
						
						
						
						//email send to customer start
							$order_id_arr_formail1=implode(',',$order_id_arr);
							$check_order_id_query3=$this->db->query("select order_id from order_info where order_id IN ($order_id_arr_formail1) AND 	order_status='Order confirmed'   ");
						//$ct_row2=$check_order_id_query2->num_rows();
			
						$row_for_mail1=$check_order_id_query3->result();
				 	
					foreach($row_for_mail1 as $res_email1)
					{    
							
							//$html=$this->load->view('admin/order_slip',$res_email1->order_id, true) ;
//							$this->load->helper(array('dompdf/dompdf_helper', 'file'));
							//pdf_create($html, 'order_Slip');
							
								$mail_query1=$this->db->query("select * from user where user_id='$user_id' ");
								$mail_row1=$mail_query1->row();
								$email1=$mail_row1->email;
								//---------------------------Data For message start------------------------------
									
										
										$cart['order_id']=$res_email1->order_id;
										$cart['user_id']=$user_id;
										
								//-------------------------Data For message end----------------------------------
														   
										$this->email->set_mailtype("html");
										$this->email->from('support@moonboy.in', 'moonboy.in');
										$this->email->to($email1);
										//$this->email->to('santanu@paramountitsolutions.co.in');
										$this->email->subject('Order Placed Successfully-'  .$res_email1->order_id);
										$this->email->message($this->load->view('email_template/order_placed',$cart,true));
										//$this->email->message($message1);
										 //$this->email->attach(pdf_create($html, 'order_Slip'));
										$this->email->send();
										
										
										date_default_timezone_set('Asia/Calcutta');
										$dt = date('Y-m-d H:i:s');
									
										$msg=$this->load->view('email_template/order_placed',$cart,true);
										if($this->email->send()){
											
											$email_data=array(
											'to_email_id'=>$email1,
											'from_email_id'=>'support@moonboy.in',
											'date'=>$dt,
											'email_sub'=>'Order Placed Successfully-'  .$res_email1->order_id,
											'email_content'=>$msg,
											'email_send_status'=>'Success'
											);
										}else
										{
											
											$email_data=array(
											'to_email_id'=>$email1,
											'from_email_id'=>'support@moonboy.in',
											'date'=>$dt,
											'email_sub'=>'Order Placed Successfully-'  .$res_email1->order_id,
											'email_content'=>$msg,
											'email_send_status'=>'Failure'
											);
										}
										$this->db->insert('email_log',$email_data);						
							
					}
				
			//email send to customer end
						
				
						
						
					}
					else if($order_status=="Aborted" || $order_status=="Failure" )
					{
						
						//email send to customer when payment failure start 
							$order_id_arr_formail2=implode(',',$order_id_arr);
							$check_order_id_query3=$this->db->query("select distinct order_id from order_info where order_id IN ($order_id_arr_formail2) AND 	order_status='Pending payment'   ");
						//$ct_row2=$check_order_id_query2->num_rows();
			
						$row_for_mail2=$check_order_id_query3->result();
				 	
					foreach($row_for_mail2 as $res_email2)
					{
						//getting order details
						$order_sql = $this->db->query("SELECT sku,quantity,sub_total_amount FROM ordered_product_from_addtocart WHERE order_id='$res_email2->order_id' AND product_order_status='Pending payment' ");
						$order_res = $order_sql->row();
						$order_sku = $order_res->sku;
						
						$order_sql1 = $this->db->query("SELECT a.name FROM product_general_info a INNER JOIN product_master b ON a.product_id=b.product_id WHERE b.sku='$order_sku'");
						$order_res1 = $order_sql1->result();
						
							$mail_query2=$this->db->query("select * from user where user_id='$user_id' ");
								$mail_row2=$mail_query2->row();
								$email2=$mail_row2->email;
								
								//---------------------------Data For message start------------------------------
									
										
										$cart['order_id']=$res_email2->order_id;
										$cart['user_id']=$user_id;
										
								//-------------------------Data For message end----------------------------------
								
									   
										$this->email->set_mailtype("html");
										$this->email->from('support@moonboy.in', 'moonboy.in');
										$this->email->to($email2);
										$this->email->subject('Online Payment Failure');
										$this->email->message($this->load->view('email_template/order_failure',$cart,true));
										$this->email->send();					
							
					}
				
			//email send to customer when payment failure end
						
						
						
						//echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
						
						
						foreach($order_id_arr as $k=>$v)
						{ 
						
						$update_query2=$this->db->query("update ordered_product_from_addtocart set product_order_status='Failed' where order_id='$order_id_arr[$j]' and user_id='$user_id' ");
						
						$qsr1=$this->db->query("select * from order_info where order_id='$order_id_arr[$j]' and order_status='Pending payment' "); 
						$ct_order_status=$qsr1->num_rows();
						if($ct_order_status>0)
						{
							$update_query1=$this->db->query("update order_info set order_status='Failed' where order_id='$order_id_arr[$j]' ");
						}
							$j++;
						}
						
					
					}					
					else
					{
						
						//email send to customer when payment failure start 
							$order_id_arr_formail3=implode(',',$order_id_arr);
							$check_order_id_query4=$this->db->query("select distinct order_id from order_info where order_id IN ($order_id_arr_formail3) AND 	order_status='Pending payment'  ");
						//$ct_row2=$check_order_id_query2->num_rows();
			
						$row_for_mail3=$check_order_id_query4->result();
				 	
					foreach($row_for_mail3 as $res_email3)
					{    
							//getting order details
						$order_sql = $this->db->query("SELECT sku,quantity,sub_total_amount FROM ordered_product_from_addtocart WHERE order_id='$res_email3->order_id'  AND product_order_status='Pending payment' ");
						$order_res = $order_sql->row();
						$order_sku = $order_res->sku;
						
						$order_sql1 = $this->db->query("SELECT a.name FROM product_general_info a INNER JOIN product_master b ON a.product_id=b.product_id WHERE b.sku='$order_sku'");
						$order_res1 = $order_sql1->result();
							
							$mail_query3=$this->db->query("select * from user where user_id='$user_id' ");
								$mail_row3=$mail_query3->row();
								$email3=$mail_row3->email;
								
									   
									   $cart['order_id']=$res_email3->order_id;
										$cart['user_id']=$user_id;
										$this->email->set_mailtype("html");
										$this->email->from('support@moonboy.in', 'moonboy.in');
										$this->email->to($email3);
										$this->email->subject('Online Payment Failure');
										$this->email->message($this->load->view('email_template/order_failure',$cart,true));
										$this->email->send();					
							
					}
				
			//email send to customer when payment failure end				
						
						foreach($order_id_arr as $k=>$v)
						{ 
						
						$update_query2=$this->db->query("update ordered_product_from_addtocart set product_order_status='Failed' where order_id='$order_id_arr[$j]' and user_id='$user_id' ");
						
						$qsr1=$this->db->query("select * from order_info where order_id='$order_id_arr[$j]' and order_status='Pending payment' "); 
						$ct_order_status=$qsr1->num_rows();
						if($ct_order_status>0)
						{
							$update_query1=$this->db->query("update order_info set order_status='Failed' where order_id='$order_id_arr[$j]' ");
						}
						$j++;
						}
						
						//echo "<br>Security Error. Illegal access detected";
					
					}
				
				
				
				for($i = 0; $i < $dataSize; $i++) 
				{
					$information=explode('=',$decryptValues[$i]);
					
					//$payment_info[$i]=$information[1];
						//echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
						$ky[]=$information[0];
						$val[]=$information[1];
				}
				
				$payment_info=array_combine($ky,$val);
				//print_r($payment_info);exit;
							
				$this->db->insert('payment_by_ccavenue_info',$payment_info);
								
		   //	Data insert from ccAvenue API 
		
		          //delete data from addtoacrt_temp start
				  
				  		$sku_qntarr=array();
						foreach($sku_arr as $keyskuqnt=>$valskuqnt)
						{ 	$skuqnt="'".$valskuqnt."'"; 
							array_push($sku_qntarr,$skuqnt);
							
						}
						$sku_qntstr=implode(',',$sku_qntarr);
						$query_select_addtocartdata=$this->db->query("select * from addtocart_temp where user_id='$user_id' AND sku IN ($sku_qntstr) group by sku ");
						$row_select_addtocartdata=$query_select_addtocartdata->result();
						
						foreach($row_select_addtocartdata as $rw1)
						{
							$this->db->query("delete from addtocart_temp where sku='$rw1->sku' and user_id='$rw1->user_id' ");	
						}
						//delete data from addtoacrt_temp start
				$this->db->query("delete from checkout_temp where user_id='$user_id'");
				
				$this->session->unset_userdata('orderidarr_seesion');
				$this->session->unset_userdata('sesssku_arr');
				
				$this->session->unset_userdata('sessaddtocart_id_arr');
				$this->session->unset_userdata('sesstotal_price');
				$this->session->unset_userdata('sessseller_id_arr');
				$this->session->unset_userdata('sesstax_arr');
				$this->session->unset_userdata('sessshipping_fees_arr');
				$this->session->unset_userdata('subtotal_arr');
				$this->session->unset_userdata('price_arr');
				$this->session->unset_userdata('sessqantity_arr');				
				$this->session->unset_userdata('sesscus_data');
				$this->session->unset_userdata('color_arr');
				$this->session->unset_userdata('size_arr');
				$this->session->unset_userdata('sessccavenue_order_id');
				
			
		
	}
	
	function manual_online_paymentinfo($addtocart_ids,$order_id_arr,$tax_arr,$shipping_fees_arr,$sub_total_arr,$qantity_arr,$sku_arr,$total_price,$seller_id_arr,$address_id,$order_id_payment_gateway,$price_arr,$color_arr,$size_arr)
	{
		
		//transaction table insert function start//
		$this->insert_inn_transaction_details($order_id_arr,$qantity_arr,$sub_total_arr,$sku_arr,$seller_id_arr,$price_arr,$shipping_fees_arr);
		//transaction table insert function end//
		
		$i=0;	
		//$user_id=$this->session->userdata['session_data']['user_id'];
		$user_id=138;
		$query1=$this->db->query("select * from addtocart_temp where user_id='$user_id' group by sku ");
		
		//$row1=$query1->result();
		
		$ct=$query1->num_rows();
		
		
		foreach($query1->result() as $rw)
		{		
			
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
			'prdt_color'=>$color_arr[$i],
			'prdt_size'=>$size_arr[$i]
			);
			
			$qr1=$this->db->insert('ordered_product_from_addtocart',$data);	
			
			
			$check_order_id_query=$this->db->query("select * from order_info where order_id='$order_id_arr[$i]'   ");
			$ct_row=$check_order_id_query->num_rows();
			
			//if($ct_row==0)
			//{
					$order_track_id=$this->get_unique_id('order_info','order_track_id');
					date_default_timezone_set('Asia/Kolkata');
					$dt=date('Y-m-d H:i:s');
			
					$data_order=array (
					'order_track_id'=>$order_track_id,
					'order_id'=>$order_id_arr[$i],
					'order_id_payment_gateway'=>$order_id_payment_gateway,
					'Total_amount'=>$sub_total_arr[$i],
					'date_of_order'=>$dt,
					'payment_mode'=>'2',
					//'order_confirm_for_seller'=>'Approved'			
					);
					
					$qr1=$this->db->insert('order_info',$data_order);				
					
			//}
			
			//else
			//{
				//$row_order_info=$check_order_id_query->row();
				//$tot_amt=$row_order_info->Total_amount + $sub_total_arr[$i];
				
				//$upd_query=$this->db->query("update order_info set Total_amount='$tot_amt' where order_id='$order_id_arr[$i]' ");	
				
			
			//}
			
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
			
			$i++;	
			
		}
			
		
			//Data insert from ccAvenue API START
				//$this->load->model('Crypto');
				
				//error_reporting(0);
				
				//$workingKey='A6E109AE1CF65837E8964E0B04552D21';		//Working Key should be provided here.
//				$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
//				$rcvdString=$this->Crypto->decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
//				$order_status="";
//				$decryptValues=explode('&', $rcvdString);
//				$dataSize=sizeof($decryptValues);
//				
//				$payment_info=array();
							
				for($i = 0; $i < $dataSize; $i++) 
					{
						$information=explode('=',$decryptValues[$i]);
						if($i==3)	$order_status=$information[1];
					}
					$j=0;
					$order_status='Success';
					if($order_status=="Success")
					{
						
						//echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";					
						foreach($order_id_arr as $k=>$v)
						{ 
						
						$update_query2=$this->db->query("update ordered_product_from_addtocart set product_order_status='Order confirmed' where order_id='$order_id_arr[$j]' and user_id='$user_id' ");
						
						$qsr1=$this->db->query("select * from order_info where order_id='$order_id_arr[$j]' and order_status='Pending payment' "); 
						$ct_order_status=$qsr1->num_rows();
						if($ct_order_status>0)
						{
							$update_query1=$this->db->query("update order_info set order_status='Order confirmed' where order_id='$order_id_arr[$j]' ");
						}
						$j++;
						}
						
						//updation product inventory quantity and stock staus start
						$query_qnt=$this->db->query("select * from addtocart_temp where user_id='$user_id' group by sku ");
						$k=0;
						foreach($query_qnt->result() as $rw)
						{
						//product quantity update start
							
							//$qnt_query=$this->db->query("select * from product_master where sku='$sku_arr[$i]' "); //modified
							
							$sku_id=$rw->sku;
							$qnt_query=$this->db->query("select * from product_master where sku='$sku_id' ");
							
							$qnt_rw=$qnt_query->row();
									
							$avl_qnt=$qnt_rw->quantity - $qantity_arr[$k];			
							
							$qnt_update_query=$this->db->query("update product_master set quantity='$avl_qnt' where sku='$sku_arr[$k]' ");
							
							
							//quantity update in seller product table start here//
								$query_slr_master = $this->db->query("SELECT * FROM seller_product_master WHERE sku='$sku_arr[$k]'");
								if($query_slr_master->num_rows() > 0){
									//$this->db->where('sku',$sku_arr[$k]);
//									$this->db->update('seller_product_master',$avl_qnt);
									$this->db->query("update seller_product_master set quantity='$avl_qnt' where sku='$sku_arr[$k]' ");
								}else{
									$query_slr_prd_gen = $this->db->query("SELECT * FROM seller_product_general_info WHERE sku='$sku_arr[$k]'");
									if($query_slr_prd_gen->num_rows() > 0){
										$result_slr_prdgen = $query_slr_prd_gen->result();
										$slr_prdt_id = $result_slr_prdgen[0]->seller_product_id;
										
										//$this->db->where('seller_product_id',$slr_prdt_id);
//										$this->db->update('seller_product_inventory_info',$avl_qnt);
										$this->db->query("update seller_product_inventory_info set quantity='$avl_qnt' where seller_product_id='$slr_prdt_id' ");
									}
								}
								//quantity update in seller product table end here//
							
										
							
							//product quantity update end
							
							
							//out of stock status update start
							
							$qnt_query1=$this->db->query("select * from product_master where sku='$sku_arr[$k]' ");
							$qnt_rw1=$qnt_query1->row();
									
							if($qnt_rw1->quantity==0)
							{
								$qnt_update_query1=$this->db->query("update product_master set stock_availability='Out of Stock' where sku='$sku_arr[$k]' ");	
							}			
							//out of stock status update end
							$k++;
					    }
						
						//updation product inventory quantity and stock staus end
						
						
						
						//email send to customer start
							$order_id_arr_formail1=implode(',',$order_id_arr);
							$check_order_id_query3=$this->db->query("select distinct order_id from order_info where order_id IN ($order_id_arr_formail1)   ");
						//$ct_row2=$check_order_id_query2->num_rows();
			
						$row_for_mail1=$check_order_id_query3->result();
				 	
					foreach($row_for_mail1 as $res_email1)
					{    
							
							//$html=$this->load->view('admin/order_slip',$res_email1->order_id, true) ;
//							$this->load->helper(array('dompdf/dompdf_helper', 'file'));
							//pdf_create($html, 'order_Slip');
							
								$mail_query1=$this->db->query("select * from user where user_id='$user_id' ");
								$mail_row1=$mail_query1->row();
								$email1=$mail_row1->email;
								//---------------------------Data For message start------------------------------
									
										
										$cart['order_id']=$res_email1->order_id;
										$cart['user_id']=$user_id;
										
								//-------------------------Data For message end----------------------------------
														   
										$this->email->set_mailtype("html");
										$this->email->from('support@moonboy.in', 'moonboy.in');
										$this->email->to($email1);
										//$this->email->to('santanu@paramountitsolutions.co.in');
										$this->email->subject('Ordered Successfully from moonboy.in');
										$this->email->message($this->load->view('email_template/order_placed',$cart,true));
										//$this->email->message($message1);
										 //$this->email->attach(pdf_create($html, 'order_Slip'));
										$this->email->send();
										
										
										date_default_timezone_set('Asia/Calcutta');
										$dt = date('Y-m-d H:i:s');
									
										$msg=$this->load->view('email_template/order_placed',$cart,true);
										if($this->email->send()){
											
											$email_data=array(
											'to_email_id'=>$email1,
											'from_email_id'=>'support@moonboy.in',
											'date'=>$dt,
											'email_sub'=>'Ordered Successfully from moonboy.in',
											'email_content'=>$msg,
											'email_send_status'=>'Success'
											);
										}else
										{
											
											$email_data=array(
											'to_email_id'=>$email1,
											'from_email_id'=>'support@moonboy.in',
											'date'=>$dt,
											'email_sub'=>'Ordered Successfully from moonboy.in',
											'email_content'=>$msg,
											'email_send_status'=>'Failure'
											);
										}
										$this->db->insert('email_log',$email_data);						
							
					}
				
			//email send to customer end
						
				
						
						
					}
					else if($order_status=="Aborted" || $order_status=="Failure" )
					{
						
						//email send to customer when payment failure start 
							$order_id_arr_formail2=implode(',',$order_id_arr);
							$check_order_id_query3=$this->db->query("select distinct order_id from order_info where order_id IN ($order_id_arr_formail2)   ");
						//$ct_row2=$check_order_id_query2->num_rows();
			
						$row_for_mail2=$check_order_id_query3->result();
				 	
					foreach($row_for_mail2 as $res_email2)
					{
						//getting order details
						$order_sql = $this->db->query("SELECT sku,quantity,sub_total_amount FROM ordered_product_from_addtocart WHERE order_id='$res_email2->order_id'");
						$order_res = $order_sql->row();
						$order_sku = $order_res->sku;
						
						$order_sql1 = $this->db->query("SELECT a.name FROM product_general_info a INNER JOIN product_master b ON a.product_id=b.product_id WHERE b.sku='$order_sku'");
						$order_res1 = $order_sql1->result();
						
							$mail_query2=$this->db->query("select * from user where user_id='$user_id' ");
								$mail_row2=$mail_query2->row();
								$email2=$mail_row2->email;
								
								//---------------------------Data For message start------------------------------
									
										
										$cart['order_id']=$res_email2->order_id;
										$cart['user_id']=$user_id;
										
								//-------------------------Data For message end----------------------------------
								
									   
										$this->email->set_mailtype("html");
										$this->email->from('support@moonboy.in', 'moonboy.in');
										$this->email->to($email2);
										$this->email->subject('Online Payment Failure');
										$this->email->message($this->load->view('email_template/order_failure',$cart,true));
										$this->email->send();					
							
					}
				
			//email send to customer when payment failure end
						
						
						
						//echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
						
						
						foreach($order_id_arr as $k=>$v)
						{ 
						
						$update_query2=$this->db->query("update ordered_product_from_addtocart set product_order_status='Failed' where order_id='$order_id_arr[$j]' and user_id='$user_id' ");
						
						$qsr1=$this->db->query("select * from order_info where order_id='$order_id_arr[$j]' and order_status='Pending payment' "); 
						$ct_order_status=$qsr1->num_rows();
						if($ct_order_status>0)
						{
							$update_query1=$this->db->query("update order_info set order_status='Failed' where order_id='$order_id_arr[$j]' ");
						}
							$j++;
						}
						
					
					}					
					else
					{
						
						//email send to customer when payment failure start 
							$order_id_arr_formail3=implode(',',$order_id_arr);
							$check_order_id_query4=$this->db->query("select distinct order_id from order_info where order_id IN ($order_id_arr_formail3)   ");
						//$ct_row2=$check_order_id_query2->num_rows();
			
						$row_for_mail3=$check_order_id_query4->result();
				 	
					foreach($row_for_mail3 as $res_email3)
					{    
							//getting order details
						$order_sql = $this->db->query("SELECT sku,quantity,sub_total_amount FROM ordered_product_from_addtocart WHERE order_id='$res_email3->order_id'");
						$order_res = $order_sql->row();
						$order_sku = $order_res->sku;
						
						$order_sql1 = $this->db->query("SELECT a.name FROM product_general_info a INNER JOIN product_master b ON a.product_id=b.product_id WHERE b.sku='$order_sku'");
						$order_res1 = $order_sql1->result();
							
							$mail_query3=$this->db->query("select * from user where user_id='$user_id' ");
								$mail_row3=$mail_query3->row();
								$email3=$mail_row3->email;
								
									   
									   $cart['order_id']=$res_email3->order_id;
										$cart['user_id']=$user_id;
										$this->email->set_mailtype("html");
										$this->email->from('support@moonboy.in', 'moonboy.in');
										$this->email->to($email3);
										$this->email->subject('Online Payment Failure');
										$this->email->message($this->load->view('email_template/order_failure',$cart,true));
										$this->email->send();					
							
					}
				
			//email send to customer when payment failure end				
						
						foreach($order_id_arr as $k=>$v)
						{ 
						
						$update_query2=$this->db->query("update ordered_product_from_addtocart set product_order_status='Failed' where order_id='$order_id_arr[$j]' and user_id='$user_id' ");
						
						$qsr1=$this->db->query("select * from order_info where order_id='$order_id_arr[$j]' and order_status='Pending payment' "); 
						$ct_order_status=$qsr1->num_rows();
						if($ct_order_status>0)
						{
							$update_query1=$this->db->query("update order_info set order_status='Failed' where order_id='$order_id_arr[$j]' ");
						}
						$j++;
						}
						
						//echo "<br>Security Error. Illegal access detected";
					
					}
				
				
				
				//for($i = 0; $i < $dataSize; $i++) 
//				{
//					$information=explode('=',$decryptValues[$i]);
//					
//					//$payment_info[$i]=$information[1];
//						//echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
//						$ky[]=$information[0];
//						$val[]=$information[1];
//				}
				
				//$payment_info=array_combine($ky,$val);
				$payment_info=array(
						'order_id'=>$order_id_payment_gateway,
						'tracking_id'=>'105090040893',
						'bank_ref_no'=>'260679',
						'order_status'=>'Success',
						'payment_mode'=>'Credit Card-Visa',
						'status_message'=>'Transaction Successful',
						'currency'=>'INR',
						'amount'=>199,
						'billing_name'=>'tk amarnath',
						'billing_address'=>'78,ambigai colony kaitharinagar nilayur  Madurai -625005 ,Tamil Nadu ,India.',
						'billing_country'=>'India',
						'billing_zip'=>'625005',
						'billing_state'=>'Tamil Nadu',
						'billing_city'=>'Madurai',
						'billing_tel'=>'8124501019',
						'billing_email'=>'tkamarnath2012@rediffmail.com',
						'mer_amount'=>'199'
						
					
				);
				
				//print_r($payment_info);exit;
							
				$this->db->insert('payment_by_ccavenue_info',$payment_info);
								
		   //	Data insert from ccAvenue API 
		
		          //delete data from addtoacrt_temp start
						$query_select_addtocartdata=$this->db->query("select * from addtocart_temp where user_id='$user_id' group by sku ");
						$row_select_addtocartdata=$query_select_addtocartdata->result();
						
						foreach($row_select_addtocartdata as $rw1)
						{
							$this->db->query("delete from addtocart_temp where sku='$rw1->sku' and user_id='$rw1->user_id' ");	
						}
						//delete data from addtoacrt_temp start
				$this->db->query("delete from checkout_temp where user_id='$user_id'");
		
	}
	
	
	function revise_onlinepayment_orderdata($order_id,$qnt_arr,$sku_arr,$ccavenue_orderid)
	{
		$user_id=$this->session->userdata['session_data']['user_id'];
		
		//--------------------------------
		
		//Data insert from ccAvenue API START
				$this->load->model('Crypto');
				
				//error_reporting(0);
				
				$workingKey='A6E109AE1CF65837E8964E0B04552D21';		//Working Key should be provided here.
				$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
				$rcvdString=$this->Crypto->decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
				$order_status="";
				$decryptValues=explode('&', $rcvdString);
				$dataSize=sizeof($decryptValues);
				
				$payment_info=array();
							
				for($i = 0; $i < $dataSize; $i++) 
					{
						$information=explode('=',$decryptValues[$i]);
						if($i==3)	$order_status=$information[1];
					}
					$j=0;
					if($order_status=="Success")
					{
						
						//echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";					
						 
						
						$update_query2=$this->db->query("update ordered_product_from_addtocart set product_order_status='Order confirmed' where order_id='$order_id' and user_id='$user_id' ");
						
						
						$update_query1=$this->db->query("update order_info set order_status='Order confirmed' where order_id='$order_id' ");
						
						
						
						//updation product inventory quantity and stock staus start
						$query_qnt=$this->db->query("select * from ordered_product_from_addtocart where user_id='$user_id' AND order_id='$order_id' ");
						$k=0;
						foreach($query_qnt->result() as $rw)
						{
						//product quantity update start
							
							//$qnt_query=$this->db->query("select * from product_master where sku='$sku_arr[$i]' "); //modified
							
							$sku_id=$rw->sku;
							$qnt_query=$this->db->query("select * from product_master where sku='$sku_arr[$k]' ");
							
							$qnt_rw=$qnt_query->row();
									
							$avl_qnt=$qnt_rw->quantity - $qnt_arr[$k];			
							
							$qnt_update_query=$this->db->query("update product_master set quantity='$avl_qnt' where sku='$sku_arr[$k]' ");
							
							//$avl_qnt_data = array('quantity' => $avl_qnt);
							//quantity update in seller product table start here//
								$query_slr_master = $this->db->query("SELECT * FROM seller_product_master WHERE sku='$sku_arr[$k]'");
								if($query_slr_master->num_rows() > 0){
									//$this->db->where('sku',$sku_arr[$k]);
//									$this->db->update('seller_product_master',$avl_qnt_data);
									$this->db->query("update seller_product_master set quantity='$avl_qnt' where sku='$sku_arr[$k]' ");
								}else{
									$query_slr_prd_gen = $this->db->query("SELECT * FROM seller_product_general_info WHERE sku='$sku_arr[$k]'");
									if($query_slr_prd_gen->num_rows() > 0){
										$result_slr_prdgen = $query_slr_prd_gen->result();
										$slr_prdt_id = $result_slr_prdgen[0]->seller_product_id;
										//$this->db->where('seller_product_id',$slr_prdt_id);
//										$this->db->update('seller_product_inventory_info',$avl_qnt_data);
										$this->db->query("update seller_product_inventory_info set quantity='$avl_qnt' where seller_product_id='$slr_prdt_id' ");
									}
								}
								//quantity update in seller product table end here//
							
										
							
							//product quantity update end
							
							
							//out of stock status update start
							
							$qnt_query1=$this->db->query("select * from product_master where sku='$sku_arr[$k]' ");
							$qnt_rw1=$qnt_query1->result();
									
							if(@$qnt_rw1[0]->quantity==0)
							{
								$qnt_update_query1=$this->db->query("update product_master set stock_availability='Out of Stock' where sku='$sku_arr[$k]' ");	
							}			
							//out of stock status update end
							$k++;
					    }
						
						//updation product inventory quantity and stock staus end
						
						
						
						//email send to customer start
							//$order_id_arr_formail1=implode(',',$order_id_arr);
							$check_order_id_query3=$this->db->query("select order_id from order_info where order_id='$order_id' ");
						//$ct_row2=$check_order_id_query2->num_rows();
			
						$row_for_mail1=$check_order_id_query3->result();
				 	
					foreach($row_for_mail1 as $res_email1)
					{    
							
							//$html=$this->load->view('admin/order_slip',$res_email1->order_id, true) ;
//							$this->load->helper(array('dompdf/dompdf_helper', 'file'));
							//pdf_create($html, 'order_Slip');
							
								$mail_query1=$this->db->query("select * from user where user_id='$user_id' ");
								$mail_row1=$mail_query1->row();
								$email1=$mail_row1->email;
								
									   
									   $cart['order_id']=$res_email1->order_id;
										$cart['user_id']=$user_id;
										$this->email->set_mailtype("html");
										$this->email->from('support@moonboy.in', 'moonboy.in');
										$this->email->to($email1);
										$this->email->subject('Ordered Successfully from moonboy.in');
										$this->email->message($this->load->view('email_template/order_placed',$cart,true));
										 //$this->email->attach(pdf_create($html, 'order_Slip'));
										$this->email->send();
										
										
										date_default_timezone_set('Asia/Calcutta');
										$dt = date('Y-m-d H:i:s');
									
										$msg=$this->load->view('email_template/order_placed',$cart,true);
										if($this->email->send()){
											
											$email_data=array(
											'to_email_id'=>$email1,
											'from_email_id'=>'support@moonboy.in',
											'date'=>$dt,
											'email_sub'=>'Ordered Successfully from moonboy.in',
											'email_content'=>$msg,
											'email_send_status'=>'Success'
											);
										}else
										{
											
											$email_data=array(
											'to_email_id'=>$email1,
											'from_email_id'=>'support@moonboy.in',
											'date'=>$dt,
											'email_sub'=>'Ordered Successfully from moonboy.in',
											'email_content'=>$msg,
											'email_send_status'=>'Failure'
											);
										}
										$this->db->insert('email_log',$email_data);						
							
					}
				
			//email send to customer end
						
				
						
						
					}
					else if($order_status=="Aborted" || $order_status=="Failure" )
					{
						
						//email send to customer when payment failure start 
							$order_id_arr_formail2=implode(',',$order_id_arr);
							$check_order_id_query3=$this->db->query("select order_id from order_info where order_id='$order_id'   ");
						//$ct_row2=$check_order_id_query2->num_rows();
			
						$row_for_mail2=$check_order_id_query3->result();
				 	
					foreach($row_for_mail2 as $res_email2)
					{    
						//getting order details
						$order_sql = $this->db->query("SELECT sku,quantity,sub_total_amount FROM ordered_product_from_addtocart WHERE order_id='$res_email2->order_id'");
						$order_res = $order_sql->row();
						$order_sku = $order_res->sku;
						
						$order_sql1 = $this->db->query("SELECT a.name FROM product_general_info a INNER JOIN product_master b ON a.product_id=b.product_id WHERE b.sku='$order_sku'");
						$order_res1 = $order_sql1->result();
							
							$mail_query2=$this->db->query("select * from user where user_id='$user_id' ");
								$mail_row2=$mail_query2->row();
								$email2=$mail_row2->email;
								
									   
									   $cart['order_id']=$res_email2->order_id;
										$cart['user_id']=$user_id;
										$this->email->set_mailtype("html");
										$this->email->from('support@moonboy.in', 'moonboy.in');
										$this->email->to($email2);
										$this->email->subject('Online Payment Failure');
										$this->email->message($this->load->view('email_template/order_failure',$cart,true));
										$this->email->send();
										
										
										date_default_timezone_set('Asia/Calcutta');
										$dt = date('Y-m-d H:i:s');
									
										$msg=$this->load->view('email_template/order_failure',$cart,true);
										if($this->email->send()){
											
											$email_data=array(
											'to_email_id'=>$email2,
											'from_email_id'=>'support@moonboy.in',
											'date'=>$dt,
											'email_sub'=>'Online Payment Failure',
											'email_content'=>$msg,
											'email_send_status'=>'Success'
											);
										}else
										{
											
											$email_data=array(
											'to_email_id'=>$email2,
											'from_email_id'=>'support@moonboy.in',
											'date'=>$dt,
											'email_sub'=>'Online Payment Failure',
											'email_content'=>$msg,
											'email_send_status'=>'Failure'
											);
										}
										$this->db->insert('email_log',$email_data);						
							
					}
				
			//email send to customer when payment failure end
						
						
						
						//echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
						
						
						
						$update_query2=$this->db->query("update ordered_product_from_addtocart set product_order_status='Failed' where order_id='$order_id' and user_id='$user_id' ");
						
							$update_query1=$this->db->query("update order_info set order_status='Failed' where order_id='$order_id' ");
						
							
					
					}					
					else
					{
						
						//email send to customer when payment failure start 
							//$order_id_arr_formail3=implode(',',$order_id_arr);
							$check_order_id_query4=$this->db->query("select order_id from order_info where order_id='$order_id'   ");
						//$ct_row2=$check_order_id_query2->num_rows();
			
						$row_for_mail3=$check_order_id_query4->result();
				 	
					foreach($row_for_mail3 as $res_email3)
					{    
						//getting order details
						$order_sql = $this->db->query("SELECT sku,quantity,sub_total_amount FROM ordered_product_from_addtocart WHERE order_id='$res_email3->order_id'");
						$order_res = $order_sql->row();
						$order_sku = $order_res->sku;
						
						$order_sql1 = $this->db->query("SELECT a.name FROM product_general_info a INNER JOIN product_master b ON a.product_id=b.product_id WHERE b.sku='$order_sku'");
						$order_res1 = $order_sql1->result();
						
							$mail_query3=$this->db->query("select * from user where user_id='$user_id' ");
								$mail_row3=$mail_query3->row();
								$email3=$mail_row3->email;
								
									   $cart['order_id']=$res_email3->order_id;
										$cart['user_id']=$user_id;
										$this->email->set_mailtype("html");
										$this->email->from('support@moonboy.in', 'moonboy.in');
										$this->email->to($email3);
										$this->email->subject('Online Payment Failure');
										$this->email->message($this->load->view('email_template/order_failure',$cart,true));
										$this->email->send();
										
										
										date_default_timezone_set('Asia/Calcutta');
										$dt = date('Y-m-d H:i:s');
									
										$msg=$this->load->view('email_template/order_failure',$cart,true);
										if($this->email->send()){
											
											$email_data=array(
											'to_email_id'=>$email3,
											'from_email_id'=>'support@moonboy.in',
											'date'=>$dt,
											'email_sub'=>'Online Payment Failure',
											'email_content'=>$msg,
											'email_send_status'=>'Success'
											);
										}else
										{
											
											$email_data=array(
											'to_email_id'=>$email3,
											'from_email_id'=>'support@moonboy.in',
											'date'=>$dt,
											'email_sub'=>'Online Payment Failure',
											'email_content'=>$msg,
											'email_send_status'=>'Failure'
											);
										}
										$this->db->insert('email_log',$email_data);						
							
					}
				
			//email send to customer when payment failure end				
						
						
						$update_query2=$this->db->query("update ordered_product_from_addtocart set product_order_status='Failed' where order_id='$order_id' and user_id='$user_id' ");
						
						
							$update_query1=$this->db->query("update order_info set order_status='Failed' where order_id='$order_id' ");
						
						
						//echo "<br>Security Error. Illegal access detected";
					
					}
				
				
				
				for($i = 0; $i < $dataSize; $i++) 
				{
					$information=explode('=',$decryptValues[$i]);
					
					//$payment_info[$i]=$information[1];
						//echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
						$ky[]=$information[0];
						$val[]=$information[1];
				}
				
				$payment_info=array_combine($ky,$val);
				//print_r($payment_info);exit;
							
								
				$this->db->query("delete from payment_by_ccavenue_info where order_id='$ccavenue_orderid' ");
				$this->db->insert('payment_by_ccavenue_info',$payment_info);				
		   //	Data insert from ccAvenue API 
		
		          //delete data from addtoacrt_temp start
						//$query_select_addtocartdata=$this->db->query("select * from addtocart_temp where user_id='$user_id' group by sku ");
//						$row_select_addtocartdata=$query_select_addtocartdata->result();
//						
//						foreach($row_select_addtocartdata as $rw1)
//						{
//							$this->db->query("delete from addtocart_temp where sku='$rw1->sku' and user_id='$rw1->user_id' ");	
//						}
						//delete data from addtoacrt_temp start
		
		//--------------------------------
		
		$this->session->unset_userdata('sess_orderid');
		 $this->session->unset_userdata('sess_qntarr');       
        $this->session->unset_userdata('sess_skuarr');
		$this->session->unset_userdata('sess_ccaavenueorderid');
			
	}
	
	
	
	function get_unique_id($table,$uid){
			
		$query = $this->db->query('SELECT MAX('.$uid.') AS maxid FROM '.$table);
		$maxId = $query->row()->maxid;
		$id = $maxId+1;
		return $id;
		}
		
		
		function delete_from_myorder($addtocart_id,$order_id)
		{				
			date_default_timezone_set('Asia/Kolkata');
			$dt=date('Y-m-d h:i:s');
			
			$query=$this->db->query("select * from ordered_product_from_addtocart where order_id='$order_id' and product_order_status='Cancelled' ");
			
			$ct=$query->num_rows();
			if($ct==1)
			{
				
				$update_query=$this->db->query("update order_info set order_status='Cancelled' where order_id='$order_id and order_status_modified_date='$dt' ");					
			}
								
					
				$qr=$this->db->query("update ordered_product_from_addtocart set product_order_status='Cancelled' where order_id='$addtocart_id' ");				
			
		}
		
		
//===========================Order status change log insert start===================================================//		
		

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

		
//===========================Order status change log insert end======================================================//

		
	function insert_return_data(){
		date_default_timezone_set('Asia/Calcutta');
		$date = date('Y-m-d H:i:s');
		$return_id = 'RN'.preg_replace("/[^0-9]+/","", $date);
		
		$product_return_id = $this->input->post('hidden_sl_id');
		$return_type = $this->input->post('return_typ');
		//if($return_type == 'Refund'){
			$reason = $this->input->post('reason1');
		// }else{
		//	$reason = $this->input->post('reason2');
		//}
		$coment = $this->input->post('comnt');
		$bank_name = $this->input->post('bank_name');
		$AC_holder_name = $this->input->post('AC_holder_name');
		$Ac_no = $this->input->post('AC_no');
		$IFSC = $this->input->post('IFSC');
		$query = $this->db->query("SELECT * FROM ordered_product_from_addtocart WHERE id=$product_return_id");
		$result = $query->result();
		
		$return_data = array(
			'return_id' => $return_id,
			'order_id' => $result[0]->order_id,
			'sku' => $result[0]->sku,
			'quantity' => $result[0]->quantity,
			'tax_rate' => $result[0]->sub_tax_rate,
			'shipping_fee' => $result[0]->sub_shipping_fees,
			'total_amount' => $result[0]->sub_total_amount,
			'seller_id' => $result[0]->seller_id,
			'return_typ' => $return_type,
			'reason' => $reason,
			'comnt' => $coment,
			'bank_name' => $bank_name,
			'Ac_holder_name' => $AC_holder_name,
			'Ac_no' => $Ac_no,
			'IFSC' => $IFSC,
			'cdate' => $date
		);
		
		$this->db->insert('return_product',$return_data);
		if($this->db->affected_rows() > 0){
			$data = array(
				'product_order_status' => 'Return Requested',
			);
			$this->db->where('id',$product_return_id);
			$this->db->update('ordered_product_from_addtocart',$data);
			
			//update status in order_info start
			$order_id_return=$result[0]->order_id;
			$query_return_request=$this->db->query("select * from ordered_product_from_addtocart where order_id='$order_id_return' and  product_order_status='Return Requested' ");
			$ct_return_request=$query_return_request->num_rows();
			
			
			$query_all_status=$this->db->query("select * from ordered_product_from_addtocart where order_id='$order_id_return' ");
			$ct_all_status=$query_all_status->num_rows();
			
			if($ct_return_request==$ct_all_status)
			{
				$this->db->query("update order_info set order_status='Return Requested' where order_id='$order_id_return' ");	
			}		
			
			//update status in order_info end
			//---------------
			
			//Product Inventory update after return start
			
			
			$sku_for_qnt=$result[0]->sku;
			$cancel_qty= $result[0]->quantity;
			
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
		
		
			//Product Inventory update after return end
			
			//Return email send to seller start
			$query_reurn_product_info=$this->db->query("select c.imag,d.name as prd_name,a.sku, a.quantity, a.total_amount,a.return_id from  return_product a inner join product_master b on a.sku=b.sku inner join product_image c on c.product_id=b.product_id inner join product_general_info d on d.product_id=b.product_id   where a.return_id='$return_id'  ");
			$row_reurn_product_info=$query_reurn_product_info->result();
			$image=explode(',',$row_reurn_product_info[0]->imag);
			
			$selr_id=$result[0]->seller_id;
			$query_seller_info=$this->db->query("select * from seller_account where seller_id='$selr_id' ");
			$mail_row=$query_seller_info->row();
			
			$rtorder_id=$result[0]->order_id;
			$retn_id=$row_reurn_product_info[0]->return_id;
			$image_name=$image[0]; //image name
			$prd_name=$row_reurn_product_info[0]->prd_name;
			$prd_qnt=$row_reurn_product_info[0]->quantity;
			$prd_totamnt=$row_reurn_product_info[0]->total_amount;
			
			$email=$mail_row->email;
						
						$rw_user_id=$query_all_status->result();
						$user_id=$rw_user_id[0]->user_id;
						$query_cusdata=$this->db->query("select a.email from user a where a.user_id='$user_id'  ");
						$cus_data=$query_cusdata->row();
						
						$cart['order_id']=$rtorder_id;
						$cart['user_id']=$user_id;						
						$cart['return_id']=$retn_id;
						$cart['sku']=$row_reurn_product_info[0]->sku;	
						 			   
						$this->email->set_mailtype("html");
						$this->email->from('support@moonboy.in', 'moonboy.in');
						$this->email->to($cus_data->email);
						//$this->email->to('santanu@paramountitsolutions.co.in');
						$this->email->subject('Return Requested Created for Order- '.$rtorder_id);						
						$this->email->message($this->load->view('email_template/order_return_request',$cart,true));
						$this->email->send();
						
						
						date_default_timezone_set('Asia/Calcutta');
						$dt = date('Y-m-d H:i:s');
					
						$msg=$this->load->view('email_template/order_return_request',$cart,true);
						if($this->email->send()){
							
							$email_data=array(
							'to_email_id'=>$cus_data->email,
							'from_email_id'=>'support@moonboy.in',
							'date'=>$dt,
							'email_sub'=>'Return Requested Created for Order- '.$rtorder_id,
							'email_content'=>$msg,
							'email_send_status'=>'Success'
							);
						}else
						{
							$email_data=array(
							'to_email_id'=>$cus_data->email,
							'from_email_id'=>'support@moonboy.in',
							'date'=>$dt,
							'email_sub'=>'Return Requested Created for Order- '.$rtorder_id,
							'email_content'=>$msg,
							'email_send_status'=>'Failure'
							);
						}
						$this->db->insert('email_log',$email_data);	
										
		
			//Return email send to seller end
			
			//insert in wallet table start
			if($return_type == 'Wallet'){
				$return_balance=$result[0]->sub_total_amount;
				$user_id=$this->session->userdata['session_data']['user_id'];
				$query_wallet=$this->db->query("select * from wallet_info where user_id='$user_id' ");
				$row_wallet=$query_wallet->row();
				
				$wallet_user_count=$query_wallet->num_rows();
				
				
				date_default_timezone_set('Asia/Calcutta');
				$dt = preg_replace("/[^0-9]+/","", date('Y-m-d H:i:s'));
				$user_id=$this->session->userdata['session_data']['user_id'];
				//$unique_wallet_id='WL-'.$dt.$user_id;
				
				if($wallet_user_count==0)
				{
					$data_wallet=array(
					
					'user_id'=>$user_id,
					'wallet_balance'=>$row_wallet->wallet_balance
					);
					$this->db->insert('wallet_info',$data_wallet);
				}
				else
				{
					$udated_wallet=$row_wallet->wallet_balance + $return_balance;
					$this->db->query("update wallet_info set wallet_balance='$udated_wallet' where user_id='$user_id' ");	
				}
				
				
			}
			//insert in wallet table end
			
//======================Order Status log insert start==========================
			
			$order_log_status='return_request_date';
			$this->update_orderstatus_log($order_id_return,$order_log_status);
			
//======================Order Status log insert end==========================
			
			if($this->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	function retrieve_customer_order_idForReturn(){
		$user_id = $user_id = $this->session->userdata['session_data']['user_id'];
		$query = $this->db->query("SELECT a.order_id,COUNT(a.order_id) AS NO_OF_ITEM,a.seller_id,b.business_name ,c.id,c.date_of_order,c.order_status,c.Total_amount FROM ordered_product_from_addtocart a 		
		INNER JOIN seller_account_information b ON a.seller_id=b.seller_id 
		INNER JOIN order_info c ON a.order_id=c.order_id WHERE a.user_id='$user_id' AND c.is_transfer='no' GROUP BY a.order_id ORDER BY c.id DESC");
		return $query;
	}
	
	function clear_inn_checkout_temp_table(){
		date_default_timezone_set('Asia/Calcutta');
		$beforeTime = date("Y-m-d H:i:s",strtotime("-15 minutes"));
		$this->db->query("DELETE FROM checkout_temp WHERE cdate <= '$beforeTime'");
	}
	
	function clear_inn_payment_adjust_temp_data(){
		date_default_timezone_set('Asia/Calcutta');
		$beforeTime = date("Y-m-d H:i:s",strtotime("-15 minutes"));
		$this->db->query("DELETE FROM pay_adjust_data_temp WHERE cdate <= '$beforeTime'");
	}
	
}
?>