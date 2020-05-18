<?php
require_once('header.php');
date_default_timezone_set('Asia/Calcutta');
?>



			<div id="content">    
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_orders.php'; ?>
					</div>
					<?php require_once('header_session.php'); ?>
				</div>  <!-- @end top-bar  -->
				
				<div class="main-content">
					<?php require_once('common.php');  ?>
                    <?php if(count($count_graceperiod_orderid)!=0) {?>
                    <a href="<?php echo base_url().'seller/orders/view_graceperiod_requestlist' ?>"> <i class="fa fa-reply-all"></i><?php echo " ".count($count_graceperiod_orderid); ?>nos. Orders Available for Request grace period
                       </a>
                    <?php }?>
					<div class="page_header">
						<div class="left">
							<h3>Orders For Grace Period Request  <span id="ajxtst"></span></h3>
						</div>
						<div class="right order_id_search">
							<!--<img class="partner_img" src="<?php// echo base_url();?>images/partner-mobile-icon-new.png">
							<a href="#"> Packaging Services </a>-->
							<div class="search_bar input-append">
								<input type="text" id="order_id_input" name="order_id" placeholder="Search Order ID" style="padding:3px;" onkeydown="if (event.keyCode == 13) {return doSearchOrderByOrderID();}">
							</div>
						</div>
						<div class="clear"></div>
					</div>
					<!-- Contents Starts-->
					<div id="search_content">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#tab1">Orders For Grace Period Request <!--<span class="muted">19</span>--></a></li>
						<!--<li><a data-toggle="tab" href="#tab2">Track Orders</a></li>-->
						<!--<li class="no_tab">
							<span>
								<i class="icon-play"></i>
								<a href="#">Take a tour</a>
							</span>
						</li>-->
					</ul>
					<div class="tab-content">
						<div id="tab1" class="tab-pane fade in active">
							<div class="order_group">
								<div class="new_order_heading">
									<a class="new_order_toggle" href="#">
										<h4>
											<!--<i class="icon-chevron-down"></i>
											 Orders to be packed-->
										</h4>
									</a>
								</div>
								<div style="height: auto;">
									<div class="new_order_inner">
										
											<div class="row">
												<div class="col-md-8">
													<div class="neworder_btn_block neworder_btn_block_border">
														
														<div class="neworder_btn_group line_height_49 left all_orders_spacing">
															<span class="select_all_orders">
																
																<input type="checkbox" name="check_all" id="check_all">
															</span>
														</div>
														<div class="neworder_btn_group line_height_49 left">
                                                        <input type="button" name="btn_graceperiod_request"  onClick="doChangeOrderStatus()" value="Request For Grace Period">
															
														
														</div>
														
														
													</div>
													<div class="right" style="margin-right:140px;">
														<div id="loader_image" style="display:none">
															<img src="<?php echo base_url();?>images/loader.gif" width="65">
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="packing_gutter">
														<div class="neworder_btn_group right">
														<!--	<a class="btn">Refiners 
																<span class="caret"></span>
															</a>-->
														</div>
													</div>
												
												</div>
											</div>
										<!--</div>order_confirm_for_seller-->
										<?php 
										if($new_orders_as_per_orderid) {
											
										foreach($new_orders_as_per_orderid as $row_as_orderid) { 
										$seller_id = $this->session->userdata('seller-session');
										$qrs=$this->db->query("SELECT a.order_confirm_for_seller,a.order_confirm_for_seller_date,a.order_id_payment_gateway,a.grace_period_approve_status, a.date_of_order,a.order_status,a.order_accept_by_seller,a.request_for_grace_period,b.quantity,b.order_id,b.sku,b.sub_tax_rate,b.sub_shipping_fees,b.sub_total_amount,c.price,d.name,e.imag,g.*,h.state,f.user_id,i.payment_type,
										k.dispatch_days
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
										WHERE b.order_id='$row_as_orderid->order_id' AND c.seller_id='$seller_id' AND (a.order_status='Pending payment' OR a.order_status='Processing' OR a.order_status='Failed' OR a.order_status='Order confirmed' OR a.order_status='Ready to shipped')
										GROUP BY b.order_id, b.sku ORDER BY a.date_of_order DESC");
										
										$row_as_product=$qrs->result();
		
		//	$row->order_confirm_for_seller_date=='0000-00-00 00:00:00'
		   ?>							
		
	 
										
										<div class="row">
											<div class="col-md-12">
                                            
                                           <?php

										 $date1 = date('y-m-d h:i:s');
															 
										//$day_after_3days=date('y-m-d h:i:s' ,strtotime($row_as_product[0]->order_confirm_for_seller_date.'+ 3 day'));
										$day_after_3days=date('y-m-d h:i:s' ,strtotime($row_as_product[0]->order_confirm_for_seller_date.'+'. $row_as_product[0]->dispatch_days .'day'));
														 
									//$date2 = new DateTime($day_after_3days);
								 //$diff = $date2->diff($date1)->format("%a"); 
								 //$row_as_product[0]->dispatch_days
								 
								 if($date1>$day_after_3days && $row_as_product[0]->order_confirm_for_seller_date!='0000-00-00 00:00:00' && $row_as_orderid->grace_period_approve_status=='Not Approved' ){
											
											?>
                                            
												<table class="table table-bordered table-hover">
													<tr style="background-color:#efefef;">
														<th width="2%"></th>
														<th width="28%">Order Summary
                                                        <br>
                                                           Order ID:   <?php echo $row_as_orderid->order_id ?>                                                  
                                                        </th>
														<th width="9%">Order Status</th>
														<th width="15%">Quantity and Price</th>
														<th width="15%">Buyer details</th>
														<th width="15%">Dispatch By</th>
                                                        <th width="7%">Grace Period Request By Seller</th>
                                                       <th width="15%">Grace Period Approve Request Status</th>
                                                        
                                                        
                                                       
													</tr>


<?php if($row_as_product) {
	foreach($row_as_product as $row) :
	//var_dump($row); exit;
	$img = $row->imag; 
	$image = explode(',', $img);
?>
													<tr>
														<td> <?php if($row->order_confirm_for_seller=='Approved' && $row->order_status=='Order confirmed'){ ?>  <input type="checkbox" name="order_id_checkbox[]"   value="<?=$row->order_id?>"> <?php } ?></td>
														<td>
                                                        
                                                     
															<div class="row neworder_product_block">
																<div class="col-md-12">
																	<div class="left image_block position_relative">
																		<img src="<?php echo base_url();?>images/product_img/<?php echo $image[0]; ?>" width="65">
																	</div>
																	<div class="left details_block">
																		<div>
																			<span class="block">
																				<strong>SKU: </strong>
																				<?=$row->sku?>
																			</span>
																			<strong>
																				<a href="#"><?=$row->name?></a>
																			</strong>
																			<table class="table attributes_table">
																				<tr>
																					<th>Order Date</th>
																					<td>
																						<?php
																						$date=date_create($row->date_of_order);
																						echo date_format($date, 'M d, Y h:i A');
																						?>
																					</td>
																				</tr>
																				<tr>
																					<th>Order ID</th>
																					<td><?=$row->order_id?></td>
																				</tr>
																			</table>
																		</div>
																	</div>
																</div>
															</div>
														</td>
														<td><?php if($row->order_status=='Pending payment'){ echo "Pending"; } else { echo $row->order_status; } ?><br> <?php if($row->order_confirm_for_seller=='Not Approved' or $row->order_status=='Pending payment' or $row->order_status=='Failed' ) { ?> <span style="color:#F00;"><?php echo 'Orders cannot be ship until confirmed' ; }?></span></td>
														<td>
															<div>

																<strong class="block">Qty : <?=$row->quantity?></strong><br>
																<span class="muted">
																	Value :
																	<i class="icon-rupee"></i>
																	<?=($row->sub_total_amount-$row->sub_shipping_fees)/$row->quantity?> each
																</span><br>
																<span class="muted">
																	Shipping : 
																	<i class="icon-rupee"></i>
																	<?=$row->sub_shipping_fees/$row->quantity?> each
																</span><br>
																<strong>
																	Total :
																	<i class="icon-rupee"></i>
																	<?php echo $row->sub_total_amount; ?>
																</strong>
																<div>
																	<span>
																		
																		 <?php  
																		 
																		 		if($row->payment_type=='COD')
																				{
																						echo  "<strong>Payment Type :</strong>".$row->payment_type;
																					
																				}else
																				{
																					//$row->order_id_payment_gateway;
																					
																			$Payment_inf_query=$this->db->query("select payment_mode,order_status from payment_by_ccavenue_info where order_id='$row->order_id_payment_gateway'");
																					
																					$row_payent_info=$Payment_inf_query->row();
																					
																					$ct_payment_info=$Payment_inf_query->num_rows();
																					
																					if($ct_payment_info>0){
																					
																					echo "<strong>Payment Type :</strong>".$row_payent_info->payment_mode. '<br>';
																					echo "<strong>Online Payment Status :</strong>".$row_payent_info->order_status;																		
																					}
																					else
																					{
																						echo "<strong>Payment Type :</strong>"."Data not available". '<br>';
																					echo "<strong>Online Payment Status :</strong>"."Transaction Failed";
																							
																					}
																					
																				}
																		 
																		 
																		 ?>
																	</span>
																</div>
<?php //} 
//} ?>
															</div>
														</td>
														<td> <?php if($row->order_accept_by_seller=='Accepted') {?>
															<?=$row->full_name?>
															<br>
															<?=$row->address?>
															<br>
															<?=$row->city?>
															<br>
															<?=$row->state?>
															<br>
															<?=$row->country?> - <?=$row->pin_code?><br>
															Mobile - <?=$row->phone?>
                                                            
                                                            <?php }else{ ?> <span style="color:#F00;"> Order Not Accepted </span>  <?php } ?>
                                                            
                                                            
                                                            
														</td>
														<td>														
															<?php $dt=$row->order_confirm_for_seller_date;
															/*$order_conf_date=date('M-d-Y h:i:s A',strtotime($dt.'+ $row_as_product[0]->dispatch_days day')); */
															
															$order_conf_date=date('M-d-Y h:i:s A',strtotime($dt.'+ '.$row_as_product[0]->dispatch_days.' day')); 
															?>
															<div><string>
                                                            <?php 
															if($row->order_confirm_for_seller_date=='0000-00-00 00:00:00' or $row->order_confirm_for_seller_date=='')
															{
																echo "Not Assigned";
																	
                                                            }else
                                                            {
                                                            	echo $order_conf_date ;?>
                                                         
                                                             </strong></div>
															<div><span class="muted">
                                                             <?php $date1 = new DateTime(date('y-m-d H:i:s' ,strtotime($row_as_product[0]->order_confirm_for_seller_date.'+ '.$row_as_product[0]->dispatch_days.' day')));
															 
															 $new_date=date('y-m-d H:i:s');
															 
															$date2 = new DateTime($new_date);
															$diff = $date2->diff($date1)->format("%a")+1; 
															//$remain_confirmdays= 90 - $diff;
									
														//echo $d=$diff.' days';  
                                                 $date_after_3rdays = new DateTime(date('y-m-d H:i:s' ,strtotime($row_as_product[0]->order_confirm_for_seller_date.'+ 3 day')));
														if($date_after_3rdays==$date2)
														{echo "<span style='color:red;'>Today is last date to ship the orders</span>";}
														elseif($date2>$date_after_3rdays)
														{echo "<span style='color:red;'>SLA breached </span>";}
														elseif($date2<$date_after_3rdays){echo "Procurement SLA:". '3 days';}
                                                       
														?>
                                                        </span>
                                                        <br />
                                                        <span style="color:#F00"> 
                                                        <?php 
														//$d2=$diff+3;
//														if($diff<=$d2){
//														   echo "Warning:  ". $d2 . "days available for despatch the order ";   
//														}
														   ?>
                                                        
                                                        </span>
                                                        
                                                        </div>	<?php } ?>
														</td>
                                                        
                                                        <td><?= $row_as_orderid->request_for_grace_period ?></td>
                                                        <td style="color:#F00;"><?= $row_as_orderid->grace_period_approve_status ." By Admin" ?></td>
                                                    
													</tr>
<?php
	endforeach;
}
else{
?>
													<tr>
														<td colspan="6" class="a-center">No record found!</td>
													</tr>
<?php
} 
?>
												</table><?php  } ?>
											</div>
										</div> 
										<?php 
										}
										}else{
										?>
											<div>
												<div class="a-center">No New Orders found!</div>
											</div>
										<?php
										}

										?>	
									</div>	
								</div>		
							</div>
						</div><!--Close Tab1-->
<script language="JavaScript">
	$(document).ready(function(){
		$('#check_all').click(function(){
			$("input[name='order_id_checkbox[]']").prop('checked', this.checked);
		});
	});
	
	function doChangeOrderStatus(){  
		var base_url = "<?php echo base_url(); ?>";
		var controller = "seller/orders";
		var ords = $('input[name="order_id_checkbox[]"]:checked').map(function(_, el){  
        	return $(el).val();
    	}).get();
		if(ords == ""){
			$('.order_status_change').prop('selectedIndex', 0);
			alert("Please select a Order.");
			return false;
		}else{
			var ys = confirm("Do you want to request for grace period of selected orders ?"); 
			if(ys == true){
				window.location.href = base_url+controller+'/request_for_graceperiod/'+encodeURIComponent(ords);
			}
		}
	}
	
</script>						
						
					</div><!-- Close of Tab-content-->	
					</div>	
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->




<script>
	function doSearchOrderByOrderID(){ 
		var base_url = "<?php echo base_url(); ?>";
		var controller = "seller/orders";
		var order_id_input = $("#order_id_input").val(); 
		if(order_id_input == ""){
			alert("Please enter valid order ID.");
			return false;
		}else{
			//window.location.href = base_url+controller+'/search_orders_by_orderID/'+order_id_input;
			$('#loader_image').show();
			$.ajax({
				'url' : base_url+controller+'/search_orders_by_orderID',
				'type' : 'POST',
				'data' : 'order_id_input='+order_id_input,
				'success' : function(data){
					$('#search_content').html(data);
				},
				complete: function(){
					$('#loader_image').hide();
				 }
			});	
		}
	}
	function inTransit(){
		$("#In_transit").show();
		$("#trackOrder1").addClass('selected_block');
		$("#trackOrder2").removeClass('selected_block');
		$("#Delivered").hide();
	}
	function delivered(){
		$("#In_transit").hide();
		$("#trackOrder1").removeClass('selected_block');
		$("#trackOrder2").addClass('selected_block');
		$("#Delivered").show();
	}
</script>


<!--<script src="../../controllers/admin/Sales.php">-->
<?php
require_once('footer.php');
?>