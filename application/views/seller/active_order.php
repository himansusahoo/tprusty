<?php
require_once('header.php');
date_default_timezone_set('Asia/Calcutta');
?>
 <link rel="stylesheet" href="<?php echo base_url(); ?>colorbox/colorbox.css" />
		<?php /*?><script src="<?php echo base_url(); ?>colorbox/jquery.min.js"></script><?php */?>
		<script src="<?php echo base_url(); ?>colorbox/jquery.colorbox.js"></script>
		<script>
			$(document).ready(function(){
				$(".inline").colorbox({inline:true, width:"60%"});
			});
		</script>
        
        <script>
			function addother_courier()
			{
				if(document.getElementById('other_courier').checked==true)
				{
					$('#spn_othercourier').css('display','block');
					$('#address_btn').attr('disabled',true);
					
				}else
				{
					$('#spn_othercourier').css('display','none');
					$('#address_btn').attr('disabled',false);	
				}
			}
			
			
			function save_couriername()
			{
				 var cour_name=$('#txtbox_othercourier').val();
				 var cour_URL=$('#txtbox_othercourierURL').val();
				 
				$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>seller/Orders/add_couriername",
					data:{courier_nm:cour_name,cour_url:cour_URL},
					success: function (data) {
						//$("#ss").html(data);
						if(data == 'success'){
							window.location.reload(true);
						}
					}
				});
			}
		</script>

<script>

function shipmnet_confirm(order_id)
{
	//date format as mysql start//
	var now     = new Date(); 
    var year    = now.getFullYear();
    var month   = now.getMonth()+1; 
    var day     = now.getDate();
    var hour    = now.getHours();
    var minute  = now.getMinutes();
    var second  = now.getSeconds(); 
    if(month.toString().length == 1) {
        var month = '0'+month;
    }
    if(day.toString().length == 1) {
        var day = '0'+day;
    }   
    if(hour.toString().length == 1) {
        var hour = '0'+hour;
    }
    if(minute.toString().length == 1) {
        var minute = '0'+minute;
    }
    if(second.toString().length == 1) {
        var second = '0'+second;
    }   
    var dateTime = year+'/'+month+'/'+day+' '+hour+':'+minute+':'+second;
	   
	//date format as mysql end// 
	  
	   dt=newString = dateTime.replace("/","").replace("/","").replace(" ","").replace(":","").replace(":","")	  
	   
			 random_string=Math.random().toString(36).slice(2);
			 shipment_id=random_string + '-' + dt;
	 
			 //document.getElementById('shipment_no_spanid').innerHTML=shipment_id;
			 document.getElementById('order_number').innerHTML=order_id;
			 
			 document.getElementById('txtbox_shipment_number').value=shipment_id;
			 document.getElementById('txtbox_order_no').value=order_id;
			 
			//window.location.href=' //echo base_url().'admin/sales/generate_shipment_id/'?>' + order_id + shipment_id ;	
	}
	
	function fill_orderid(order_id)
	{
		document.getElementById('grctxtbox_order_no').value=order_id;	
	}
	
	function valid_undeliver(order_id){
		var ys=confirm('Do you want to set as order undelivered ?');
		if(ys){
			window.location.href='<?php echo base_url().'admin/sales/set_order_undeliver/' ?>' + order_id;	
		}
	}
	
	
	function show_alert()
	{
		alert('You can not do any action till order confirm.');
		return false;
	}
</script>

<script>
function accept_order(ordered_id)
{
	var conf=confirm('Do you accept the order ?');
	if(conf){
		window.location.href='<?php echo base_url().'seller/orders/accept_order/'?>' + ordered_id;				
	}
}
</script>

			<div id="content">    
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_orders.php'; ?>
					</div>
					<?php require_once('header_session.php'); ?>
				</div>  <!-- @end top-bar  -->
				
				<div class="main-content">
					<?php require_once('common.php');  ?>
                    <?php //if(count($count_graceperiod_orderid)!=0) {?>
                    <!--<a href="<?php// echo base_url().'seller/orders/view_graceperiod_requestlist' ?>"> <i class="fa fa-reply-all"></i><?php echo " ".count($count_graceperiod_orderid); ?>nos. Orders Available for Request grace period
                       </a>-->
                    <?php //}?>
					<div class="page_header">
						
						
						<div class="clear"></div>
					</div>
					<!-- Contents Starts-->
					<div id="search_content">
					
					<div class="tab-content">
						<div id="tab1" class="tab-pane fade in active">
							<div class="order_group">
								
								<div style="height: auto;">
									<div class="new_order_inner">
											
										
										<?php 
										if($new_orders_as_per_orderid){
											$seller_id = $this->session->userdata('seller-session');
											foreach($new_orders_as_per_orderid as $res_neword){
												
										$query = $this->db->query("SELECT a.order_confirm_for_seller_date,k.dispatch_days,a.order_id,a.order_confirm_for_seller,a.order_status,a.order_accept_by_seller,a.grace_period,
		a.invoice_id,a.request_for_grace_period,a.grace_period_reason,a.grace_period_approve_status,a.Total_amount
FROM order_info a
INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id
INNER JOIN user f ON b.user_id = f.user_id
INNER JOIN user_address g ON f.address_id = g.address_id
INNER JOIN state h ON g.state = h.state_id
INNER JOIN dispatched_day_setting k on k.state_id=h.state_id
WHERE a.order_id='$res_neword->order_id' group by b.order_id 
  ");

 $new_orders_as_per_orderid=$query->result();										
										
										
										//print_r($new_orders_as_per_orderid);
										if($new_orders_as_per_orderid) {
										foreach($new_orders_as_per_orderid as $row_as_orderid) { 
										$seller_id = $this->session->userdata('seller-session');
										
										//$row->order_confirm_for_seller_date=='0000-00-00 00:00:00'
		   								?>							
										
										<div class="row">
											<div class="col-md-12">
                                            
                                           <?php

										 $date1 = date('y-m-d h:i:s');
															 
										//$day_after_3days=date('y-m-d h:i:s' ,strtotime($row_as_product[0]->order_confirm_for_seller_date.'+ 3 day'));
										$day_after_3days=date('y-m-d h:i:s' ,strtotime($row_as_orderid->order_confirm_for_seller_date.'+'. $row_as_orderid->dispatch_days .'day'));
										$grace_days=$row_as_orderid->dispatch_days + $row_as_orderid->grace_period;
										
										$day_after_gracedays=date('y-m-d h:i:s' ,strtotime($row_as_orderid->order_confirm_for_seller_date.'+'. $grace_days .'day'));				 
									//$date2 = new DateTime($day_after_3days);
								 //$diff = $date2->diff($date1)->format("%a"); 
								 //$row_as_product[0]->dispatch_days
								 
								//if(($date1<=$day_after_3days or $date1<=$day_after_gracedays) and $row_as_orderid->order_confirm_for_seller=='Approved'){
										//if($row_as_orderid->order_confirm_for_seller=='Approved'){	
											?>
                                            
												<table class="table table-bordered table-hover">
													<tr style="background-color:#efefef;">
														
														<th width="28%">Order Summary
                                                        <br>
                                                           Order ID:   <?php echo $row_as_orderid->order_id ?>                                                  
                                                        </th>
														<th width="9%">Order Status</th>
														<th width="15%">Quantity and Price</th>
														<th width="15%">Buyer details</th>
                                                       
                                                     
                                                       
													</tr>


<?php
										
										$qrs=$this->db->query("SELECT a.order_confirm_for_seller,a.order_confirm_for_seller_date,a.order_id_payment_gateway, a.date_of_order,a.order_status,a.order_accept_by_seller,a.grace_period_approve_status,a.grace_period,b.product_order_status,										b.quantity,b.order_id,b.sku,b.sub_tax_rate,b.sub_shipping_fees,b.sub_total_amount,c.name,c.imag,g.*,h.state,i.payment_type,
										k.dispatch_days
										FROM order_info a
										INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id 										
										INNER JOIN cornjob_productsearch c ON c.sku=b.sku
										INNER JOIN shipping_address g ON a.order_id = g.order_id
										INNER JOIN state h ON g.state = h.state_id
										INNER JOIN payment_info i on i.payment_mode_id= a.payment_mode 
										INNER JOIN dispatched_day_setting k on k.state_id=h.state_id
										WHERE a.order_id='$row_as_orderid->order_id'  ");
										
										$row_as_product=$qrs->result();

 if($row_as_product) {
	foreach($row_as_product as $row) :
	//var_dump($row); exit;
	$img = $row->imag; 
	$image = explode(',', $img);
?>
													<tr>
													
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
																		
																				<a href="#"><?=$row->name?></a> <br />
                                                                        
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
														<td><?=$row->order_status?></td>
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
																					
																				}elseif($row->payment_type=='Online Payment')
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
																				elseif($row->payment_type=='Wallet')
																				{
																						echo  "<strong>Payment Type :</strong>".$row->payment_type;
																					
																				}
																		 
																		 
																		 ?>
																	</span>
																</div>
<?php //} 
//} ?>
															</div>
														</td>
														<td> <?php if($row->order_accept_by_seller=='Accepted') {?>
															<?=$row->full_name;?>
															<br>
															<?=$row->address;?>
															<br>
															<?=$row->city;?>
															<br>
															<?=$row->state;?>
															<br>
															<?=$row->country;?> - <?=$row->pin_code;?><br>
															Mobile - <?=$row->phone;?>
                                                            
                                                            <?php }else{ ?> <span style="color:#F00;"> Order Not Accepted </span>  <?php } ?>
                                                            
                                                            
                                                            
														</td>
														
                                                    
													</tr>
														<?php 
                                                            endforeach;
                                                        } 
                                                        else{
                                                        ?>
													<tr>
														<td colspan="7" class="a-center">No record found!</td>
													</tr>
														<?php
                                                        } 
                                                        ?>
												</table><!--<?php  //} ?>-->
											</div>
										</div> 
										<?php }}
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
	
	
	
	
	$(document).ready(function(){
		$('#check_all_intransit').click(function(){
			$("input[name='orderid_intransit_checkbox[]']").prop('checked', this.checked);
		});
	});
	/*function toggle(source) {
		checkboxes = document.getElementsByName('order_id_checkbox[]');
		for(var i=0, n=checkboxes.length; i<n;i++) {
			checkboxes[i].checked = source.checked;
			var len = $("input[name='order_id_checkbox[]']:checked").length;
			if(len){
				$(".order_count").text(len);
			}
		}
	}*/
	
			
	/*function doSearchOrderByOrderID(){ 
		var base_url = "<?php// echo base_url(); ?>";
		var controller = "seller/orders";
		var order_id_input = $("#order_id_input").val(); 
		if(order_id_input == ""){
			alert("Please enter valid order ID.");
			return false;
		}else{
			window.location.href = base_url+controller+'/search_orders_by_orderID/'+order_id_input;
		}
	}*/
	function doChangeOrderStatus(status){  
		var base_url = "<?php echo base_url(); ?>";
		var controller = "seller/orders";
		var del = $('input[name="order_id_checkbox[]"]:checked').map(function(_, el){  
        	return $(el).val();
    	}).get();
		if(del == ""){
			$('.order_status_change').prop('selectedIndex', 0);
			alert("Please select a Order.");
			return false;
		}else{
			var ys = confirm("Do you want to change the status ?"); 
			if(ys == true){
				window.location.href = base_url+controller+'/change_order_status/'+encodeURIComponent(status)+'/'+encodeURIComponent(del);
			}
		}
	}
	
	function doChangeOrderStatus_intransit(status)
	{
		
		var base_url = "<?php echo base_url(); ?>";
		var controller = "seller/orders";
		var del = $('input[name="orderid_intransit_checkbox[]"]:checked').map(function(_, el){  
        	return $(el).val();
    	}).get();
		if(del == ""){
			$('#select_intransit_status').prop('selectedIndex', 0);
			alert("Please select a Order.");
			return false;
		}else{
			var ys = confirm("Do you want to change the status ?"); 
			if(ys == true){
				window.location.href = base_url+controller+'/change_order_status/'+encodeURIComponent(status)+'/'+encodeURIComponent(del);
			}
		}
	}
</script>						
						<div id="tab2" class="tab-pane fade">
							<div class="row track_orders_nav">
								<div class="around_float inner_navigation overflow_hidden">
									<div class="inner_navigation_block left selected_block" id="trackOrder1">
										<a href="#"><span class="block block_small" onclick="inTransit()">In Transit</span></a>
									</div>
									<div class="inner_navigation_block left" id="trackOrder2">
										<a href="#"><span class="block block_small" onclick="delivered()">Delivered</span></a>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-12">
											<div class="row btn_orders_tracking">
												<div class="track_order_lnk_gr txt_downld downld_manifest_rts">
													<!--<i class="icon-download-alt"></i>
													<a href="#">Export orders</a>-->
                                                    
                                                   
														</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<!-- Delivered Div Starts-->
								<!-- Close of Tab2-->
					</div><!-- Close of Tab-content-->	
					</div>	
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->





<!-- Request For Grace Period Div Strat -->




<!-- Request For Grace Period Div End -->


<script>

	function valid_graceperiod()
	{
		
		var grc=document.getElementById('grc_periodselect').value;
		var reson=document.getElementById('txtarea_graceperiod').value.length;
		
		if(grc=="")		
		{
			alert('Select days');
			return false;
		}
		
		else if(reson==0)
		{
			alert('Please Enter Reason');
			return false;
		}
		
		
			
	}

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

<script>
function delete_order(ordered_id,totl_amt){
	//alert(ordered_id);return false; 
	var ys = confirm("Do you want cancel this order ?");
		if(ys){		
			$.ajax({
				method:"POST",
				url:"<?php echo base_url(); ?>seller/orders/cancel_order",
				data:{orderid:ordered_id,total_amount:totl_amt},
				success: function (data) {
					//$("#ajxtst").html(data);
					if(data == 'success'){
						window.location.reload(true);
					}
				}
			});
		}
}
</script>
<!--<script src="../../controllers/admin/Sales.php">-->
<?php
require_once('footer.php');
?>