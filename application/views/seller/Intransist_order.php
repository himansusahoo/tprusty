<?php
require_once('header.php');

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
                    <!--<a href="<?php// echo base_url().'seller/orders/view_graceperiod_requestlist' ?>"> <i class="fa fa-reply-all"></i><?php// echo " ".count($count_graceperiod_orderid); ?>nos. Orders Available for Request grace period
                       </a>-->
                    <?php //}?>
					<div class="page_header">
						<div class="left">
							<h3>In Transit Orders <span id="ajxtst"></span></h3>
						</div>
						<div class="right order_id_search">
							<!--<img class="partner_img" src="<?php// echo base_url();?>images/partner-mobile-icon-new.png">
							<a href="#"> Packaging Services </a>-->
							<div class="search_bar input-append">
								<input type="text" id="order_id_input" name="order_id" placeholder="Search Order ID" style="padding:3px;" onkeydown="if(event.keyCode == 13) {return doSearchOrderByOrderID();}">
                                
                               <!-- <input type="text" id="order_id_input" name="order_id" placeholder="Search Order ID" style="padding:3px;" onclick="doSearchOrderByOrderID()"/>-->
							</div>
						</div>
						<div class="clear"></div>
					</div>
					<!-- Contents Starts-->
					<div id="search_content">
					<ul class="nav nav-tabs">
						<li ><a  href="<?php echo base_url().'seller/Orders' ?>">New Orders <!--<span class="muted">19</span>--></a></li>
						<li class="active"><a data-toggle="tab" href="#tab2">Track Orders</a></li>
						<!--<li class="no_tab">
							<span>
								<i class="icon-play"></i>
								<a href="#">Take a tour</a>
							</span>
						</li>-->
					</ul>
					<div class="tab-content">
						<div id="tab1" class="tab-pane fade">
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
										<!--<div class="order_action_block">-->
											<div class="row">
												<div class="col-md-8">
													<div class="neworder_btn_block neworder_btn_block_border">
														<!--<div class="neworder_btn_group line_height_49 left all_orders_spacing">
															<span class="badge order_count">0</span>
														</div>-->
														<div class="neworder_btn_group line_height_49 left all_orders_spacing">
															<span class="select_all_orders">
																<!--<input type="checkbox" name="check_all_order" onClick="toggle(this)">-->
																<input type="checkbox" name="check_all" id="check_all">
															</span>
														</div>
														<div class="neworder_btn_group line_height_49 left">
															<select class="order_status_change" onchange="doChangeOrderStatus(this.value)">
																<option value="">--Select status--</option>
																<!--<option value="Processing">Processing</option>-->
																<option value="Ready to shipped">Ready to shipped</option>
                                                                <!--<option value="Shipped">Shipped</option>-->
																<!--<option value="Return Received">Return Received</option>
                                                                
																<option value="Cancelled">Cancelled</option>-->
															</select>
															<!--<select class="order_bulk_action">
																<option value="">--Choose Bulk Action--</option>
																<option value="Order Slip">Order Slip</option>
																<option value="Packing Slip">Packing Slip</option>
																<option value="Invoice">Invoice</option>
															</select>-->
														</div>
														
														
														<!--Take tour-->
														<!--<div class="neworder_btn_group line_height_49 left">
															<button class="btn pack_orders"> Pack Orders </button>
															<button class="btn"> Cancel Orders </button>
														</div>
														<div class="neworder_btn_group line_height_49 left"> OR </div>
														<div class="neworder_btn_group line_height_49 left" style="">
															<i class="icon-download-alt"></i>
															<a href="">1. Download for Bulk Action</a>
														</div>
														<div class="neworder_btn_group line_height_49 left border_right">
															<span >
																<button class="btn pack_orders"> 2.Upload Bulk File </button>
															</span>
														</div>
														<span class="download_bulk_result line_height_49 left">
															<a href="#">
																<i class="icon-info-sign"></i>
															</a>
														</span>-->
													</div>
													<div class="right" style="margin-right:140px;">
														
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
													<!--Take tour-->
													<!--<div class="neworder_btn_group right text_download download_packing_list">
														<i class="icon-download-alt"></i>
														<a href="#">Download Packing List</a>
													</div>-->
												</div>
											</div>
										<!--</div>order_confirm_for_seller-->
											
										<div class="row">
											<div class="col-md-12">
                                            
												<table class="table table-bordered table-hover">
													<tr style="background-color:#efefef;">
														<th width="2%"></th>
														<th width="28%">Order Summary
                                                        <br>
                                                           Order ID:   <?php //echo $row_as_orderid->order_id ?>                                                  
                                                        </th>
														<th width="9%">Order Status</th>
														<th width="15%">Quantity and Price</th>
														<th width="15%">Buyer details</th>
														<th width="15%">Dispatch By</th>
                                                        <th width="31%">Action:
                                                       
                                                        
														
                                                        <a href='#' onClick="accept_order()" title="Accept Order">    
                                                        <i class="fa fa-thumbs-o-up"></i> </a> 
                                                        
                                                        
                                                       
						                            
                                                          
                        <a href='' title="Invoice"> <i style="font-size:18px;" class="fa fa-file-pdf-o"></i></a>
						
						
                                                        
                                                       </th>
													</tr>



													<tr>
														<td> </td>
														<td>
                                                        
                                                     
															<div class="row neworder_product_block" >
																<div class="col-md-12">
																	<div class="left image_block position_relative">
																		
																	</div>
																	<div class="left details_block">
																		<div>
																			<span class="block">
																				<strong>SKU: </strong>
																				
																			</span>
																			<strong>
																				<a href="#"></a>
																			</strong>
																			<table class="table attributes_table">
																				<tr>
																					<th>Order Date</th>
																					<td>
																						
																					</td>
																				</tr>
																				<tr>
																					<th>Order ID</th>
																					<td></td>
																				</tr>
																			</table>
																		</div>
																	</div>
																</div>
															</div>
														</td>
														<td></span></td>
														<td>
															
                                                            
                                                            
														</td>
														<td colspan="2">														
															
															<div><string>
                                                           
                                                         
                                                             </strong></div>
															<div><span class="muted">
                                                            
                                                        
                                                        <br />
                                                        <span style="color:#F00"> 
                                                        
														   
                                                        
                                                        </span>
                                                        
                                                        </div>	
														</td>
                                                    
													</tr>
													<tr>
														<td colspan="6" class="a-center">No record found!</td>
													</tr>

												</table>
											</div>
										</div> 
										
											<div>
												<div class="a-center">No New Orders found!</div>
											</div>
											
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
						<div id="tab2" class="tab-pane fade in active">
							<div class="row track_orders_nav">
								<div class="around_float inner_navigation overflow_hidden">
									<div class="inner_navigation_block left selected_block" id="trackOrder1">
										<a href="<?php echo base_url().'seller/Orders/intransist_orders' ?>"><span class="block block_small" >In Transit</span></a>
									</div>
									<div class="inner_navigation_block left" id="trackOrder2">
										<a href="<?php echo base_url().'seller/Orders/delivered_orders' ?>"><span class="block block_small" >Delivered</span></a>
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
								<div class="row" id="In_transit" >
									<div class="col-md-12">
                                     <div id="loader_image" style="display:none; text-align:center">
										<img src="<?php echo base_url();?>images/loader.gif" width="65">
									</div>
                                    <div class="pagination">
					<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
				</div>
                                  
										<table class="table neworder_table">
											<tr style="background-color:#efefef;">
												<th width="45%">Order Summary</th>
												<th width="10%">Order Status</th>
												<th width="15%">Quantity and Price</th>
												<th width="15%">Tracking</th>
												<th width="15%">Buyer details </th>
											</tr>
<?php 
$seller_id = $this->session->userdata('seller-session');
//======intransist orderquery======
if($inTransit_orders1){
	foreach($inTransit_orders1 as $row) {
	
		//$query = $this->db->query("SELECT a.date_of_order,a.order_status,a.order_confirm_for_seller_date,a.order_id_payment_gateway,a.order_status_modified_date,b.order_id,b.sku,b.sub_total_amount,b.sub_shipping_fees,b.quantity,d.name,e.imag,g.*,h.state, i.tracking_no,j.payment_type,k.dispatch_days FROM order_info a
//		INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id
//		
//		INNER JOIN product_general_info d ON b.product_id = d.product_id
//		INNER JOIN product_image e ON b.product_id = e.product_id
//		INNER JOIN shipping_address g ON a.order_id = g.order_id
//		INNER JOIN state h ON g.state = h.state_id
//		INNER JOIN shipment_info i ON a.order_id = i.order_id
//		INNER JOIN payment_info j on j.payment_mode_id= a.payment_mode
//		INNER JOIN dispatched_day_setting k on k.state_id=h.state_id
//		WHERE a.order_id='$row->order_id' AND b.sku='$row->sku'  ");
		
		
		
		$query = $this->db->query("SELECT a.date_of_order,a.order_status,a.order_confirm_for_seller_date,a.order_id_payment_gateway,a.order_status_modified_date,b.order_id,b.sku,b.sub_total_amount,b.sub_shipping_fees,b.quantity,c.name,c.imag,g.*,i.tracking_no,j.payment_type,k.dispatch_days FROM order_info a
		INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id		
		INNER JOIN cornjob_productsearch c ON c.sku=b.sku
		INNER JOIN shipping_address g ON a.order_id = g.order_id
		INNER JOIN state h ON g.state = h.state_id		
		INNER JOIN shipment_info i ON a.order_id = i.order_id
		INNER JOIN payment_info j on j.payment_mode_id= a.payment_mode
		INNER JOIN dispatched_day_setting k on k.state_id=h.state_id
		WHERE a.order_id='$row->order_id' AND b.sku='$row->sku'  ");
		
		
		
$inTransit_orders=$query->result();
//======intransist orderquery======
if($inTransit_orders){
	foreach($inTransit_orders as $row1) :
	//var_dump($row1); exit;
	$img = $row1->imag;
	$image1 = explode(',', $img);
?> <?php         
										$date3 = date('y-m-d h:i:s');
										//$day_after_3days=date('y-m-d h:i:s' ,strtotime($row_as_product[0]->order_confirm_for_seller_date.'+ 3 day'));
										$day_after_7days=date('y-m-d h:i:s' ,strtotime($row1->order_confirm_for_seller_date.'+ 7 day'));
												 ?>	
											<tr <?php if($date3>$day_after_7days ){ ?> style="color:#F00" <?php } ?>>
												<td><!--<input type="checkbox" name="orderid_intransit_checkbox[]"   value="<?php// echo $row1->order_id?>">-->
													<div class="row neworder_product_block">
														<div class="col-md-12">
                                               	
															<div class="left image_block position_relative">
																<img src="<?php echo base_url();?>images/product_img/<?php echo $image1[0]; ?>" width="65">
															</div>
															<div class="left details_block">
																<div>
																	<span class="block">
																		<strong>SKU: </strong>
																		<?=$row1->sku;?>
																	</span>
																	<strong>
																		<a href="#"><?=$row1->name;?></a>
                                                                        
                                                                         <br />
                                                                        
                                                                        <?php        
                                                                                $color_sizecronjobquery=$this->db->query("SELECT color,size,Capacity,RAM,ROM FROM  cornjob_productsearch WHERE sku='$row1->sku' group by sku ");
									if($color_sizecronjobquery->num_rows()>0)
									{										
										$color=$color_sizecronjobquery->row()->color;
										$size=$color_sizecronjobquery->row()->size;
										$capacity=$color_sizecronjobquery->row()->Capacity;
										$ram=$color_sizecronjobquery->row()->RAM;
										$rom=$color_sizecronjobquery->row()->ROM;
									}
									
									if($color != ''){ echo "<span class='cart_attr'>Color : ".$color.'</span><br/>'; }
									if($size != ''){ echo "<span class='cart_attr'>Size : ".$size.'</span><br/>'; }
									if($capacity != ''){ echo "<span class='cart_attr'>Capacity : ".$capacity.'</span><br/>'; }
									if($ram != ''){ echo "<span class='cart_attr'>RAM : ".$ram.'</span><br/>'; }
									if($rom != ''){ echo "<span class='cart_attr'>ROM : ".$rom.'</span><br/>'; }
                                                                                
                                            ?>                              
                                                                        
																	</strong>
																	<table class="table attributes_table">
																		<tr>
																			<th>Order Date</th>
																			<td>
																				<?php
																				$date=date_create($row1->date_of_order);
																				echo date_format($date, 'M d, Y h:i A');
																				?>
																			</td>
																		</tr>
																		<tr>
																			<th>Order ID</th>
																			<td><?=$row1->order_id?></td>
																		</tr>
																	</table>
																</div>
															</div>
														</div>
													</div>
												</td>
												<td><?=$row1->order_status?></td>
												<td>
													<div>
														<strong class="block">Qty : <?=$row1->quantity?></strong><br>
														<span class="muted">
															Price :
															<i class="icon-rupee"></i>
															<?=($row1->sub_total_amount-$row1->sub_shipping_fees)/$row1->quantity?> each
														</span><br>
														<span class="muted">
															Shipping : 
															<i class="icon-rupee"></i>
															<?=$row1->sub_shipping_fees/$row1->quantity;?> each
														</span><br>
														<strong>
															Total :
															<i class="icon-rupee"></i>
															<?php echo $row1->sub_total_amount;?>
														</strong>
														<div>
															<span>
																<!--<strong>Payment Type :</strong>-->
																 
                                                                  <?php  
																		 
																		 		if($row1->payment_type=='COD')
																				{
																						echo  "<strong>Payment Type :</strong>".$row1->payment_type;
																					
																				}elseif($row1->payment_type=='Online Payment')
																				{
																					//$row->order_id_payment_gateway;
																					
																			$Payment_inf_query1=$this->db->query("select payment_mode,order_status from payment_by_ccavenue_info where order_id='$row1->order_id_payment_gateway'");
																					
																					$row_payent_info1=$Payment_inf_query1->row();
																					
																					$ct_payment_info1=$Payment_inf_query1->num_rows();
																					
																					if($ct_payment_info1>0){
																					
																					echo "<strong>Payment Type :</strong>".$row_payent_info1->payment_mode. '<br>';
																					echo "<strong>Online Payment Status :</strong>".$row_payent_info1->order_status;																		
																					}
																					else
																					{
																						echo "<strong>Payment Type :</strong>"."Data not available". '<br>';
																					echo "<strong>Online Payment Status :</strong>"."Transaction Failed";
																							
																					}
																					
																				}
																				elseif($row1->payment_type=='Wallet')
																				{
																						echo  "<strong>Payment Type :</strong>".$row1->payment_type;
																					
																				}
																		 
																		 
																		 ?>
                                                                 
															</span>
														</div>														
													</div>
												</td>
												<td>
													<span> <?php 
													
													$query_courierinfo=$this->db->query("select * from shipment_info where order_id='$row1->order_id'  ");
													$row_courierinfo=$query_courierinfo->result();
													if(count($row_courierinfo)!=0)
													{
													echo "Courier Name: ".$row_courierinfo[0]->courier_name. "<br>" ;
													}
						$date7 = new DateTime(date('y-m-d H:i:s' ,strtotime($row1->order_confirm_for_seller_date)));
						$date8 = new DateTime(date('y-m-d H:i:s' ,strtotime($row1->order_status_modified_date)));									 
															/* $new_date7=date('y-m-d H:i:s');*/
															 
															$cur_date = new DateTime(date('y-m-d H:i:s'));
															//$diff7 = $date8->diff($date7)->format("%a"); 
															$diff7 = $date8->diff($date7)->format("%a");
															$dispatch_days = $row1->dispatch_days;
														
										$date_despatch_by = new DateTime(date('y-m-d H:i:s' ,strtotime($row1->order_confirm_for_seller_date .'+'.$dispatch_days .'day')));
															
													if($cur_date<=$date_despatch_by){
														echo "Dispatched in ". $diff7.' days'; }else{echo "Delivered days has expired";}?></span>
													<div>
														<strong>Forward Tracking ID</strong>
														:
														<a href="#"><?php if($row1->tracking_no){echo $row1->tracking_no;}?></a>
													</div>
												</td>
												<td>
													<?=$row1->full_name;?>
													<br>
													<?=$row1->address;?>
													<br>
													<?=$row1->city;?>
													<br>
													<?=$row1->state;?>
													<br>
													<?=$row1->country;?> - <?=$row1->pin_code;?><br>
													Mobile - <?=$row1->phone?>
												</td>
											</tr>
<?php 
	endforeach; }}
}else{
?>
													<tr>
														<td colspan="6" class="a-center">No record found!</td>
													</tr>
<?php
}
?>
										</table>
									</div>
								</div>
								<!-- Delivered Div Starts-->
								<div class="row" id="Delivered" style="display:none;">
									<div class="col-md-12">
										<table class="table neworder_table">
											<tr style="background-color:#efefef;">
												<th width="45%">Order Summary</th>
												<th width="10%">Order Status</th>
												<th width="15%">Quantity and Price</th>
												<th width="15%">Delivery</th>
												<th width="15%">Buyer details</th>
											</tr>
<?php
if($delivered_orders){
	foreach($delivered_orders as $row2):
	$img = $row2->imag; 
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
																		<?=$row2->sku?>
																	</span>
																	<strong>
																		<a href="#"><?=$row2->name?></a>
																	</strong>
																	<table class="table attributes_table">
																		<tr>
																			<th>Order Date</th>
																			<td>
																				<?php
																				$date = date_create($row2->date_of_order);
																				echo date_format($date, 'M d, Y h:i A');
																				?>
																			</td>
																		</tr>
																		<tr>
																			<th>Order ID</th>
																			<td><?=$row2->order_id?></td>
																		</tr>
																	</table>
																</div>
															</div>
														</div>
													</div>
												</td>
												<td><?=$row2->order_status?></td>
												<td>
													<div>
														<strong class="block">Qty : <?=$row2->quantity?></strong><br>
														<span class="muted">
															Price :
															<i class="icon-rupee"></i>
															<?=$row2->price?> each
														</span><br>
														<span class="muted">
															Shipping : 
															<i class="icon-rupee"></i>
															<?=$row2->shipping_fee_amount?> each
														</span><br>
														<strong>
															Total :
															<i class="icon-rupee"></i>
															<?php echo ($row2->price * $row2->quantity) + $row2->shipping_fee_amount; ?>
														</strong>
														<div>
															<span>
																<!--<strong>Payment Type :</strong>-->
																  <?php  
																		 
																		 		if($row2->payment_type=='COD')
																				{
																						echo  "<strong>Payment Type :</strong>".$row2->payment_type;
																					
																				}elseif($row2->payment_type=='Online Payment')
																				{
																					//$row->order_id_payment_gateway;
																					
																			$Payment_inf_query2=$this->db->query("select payment_mode,order_status from payment_by_ccavenue_info where order_id='$row2->order_id_payment_gateway'");
																					
																					$row_payent_info2=$Payment_inf_query2->row();
																					
																					$ct_payment_info2=$Payment_inf_query2->num_rows();
																					
																					if($ct_payment_info2>0){
																					
																					echo "<strong>Payment Type :</strong>".$row_payent_info2->payment_mode. '<br>';
																					echo "<strong>Online Payment Status :</strong>".$row_payent_info2->order_status;																		
																					}
																					else
																					{
																						echo "<strong>Payment Type :</strong>"."Data not available". '<br>';
																					echo "<strong>Online Payment Status :</strong>"."Transaction Failed";
																							
																					}
																					
																				}
																				elseif($row2->payment_type=='Wallet')
																				{
																						echo  "<strong>Payment Type :</strong>".$row2->payment_type;
																					
																				}
																		 
																		 
																		 ?>
															</span>
														</div>														
													</div>
												</td>
												<td>
													<?php
														$now = time();
														$then = strtotime($row2->order_status_modified_date);
														$difference = $now - $then;
														$days = floor($difference / (60*60*24) );
													?>
													Delivered in <?=$days?> days
												</td>
												<td> 
													<?=$row2->full_name?>
													<br>
													<?=$row2->address?>
													<br>
													<?=$row2->city?>
													<br>
													<?=$row2->state?>
													<br>
													<?=$row2->country?> - <?=$row2->pin_code?><br>
													Mobile - <?=$row2->phone?>
												</td>
												
											</tr>
<?php
	endforeach;
}else{
?>
													<tr>
														<td colspan="5" class="a-center">No record found!</td>
													</tr>
<?php
}
?>									
										</table>
									</div>
								<div>
								
							</div>
						</div><!-- Close of Tab2-->
					</div><!-- Close of Tab-content-->	
					</div>	
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->


<div style="display:none">
      <div id="inline_content_add_address" style="padding:10px; background:#fff;">
      	<div class="edit_address_dv" style="width:500px;">
         	<h4 class="title sn">Add Shipping Information</h4>
<div class="col-md-12"><form action="<?php echo base_url().'seller/orders/add_shipment_info' ?> " method="post" >
		<table class="edit_address_form">
            <tr>
            <td >Order Number</td>
                <td> <span id="order_number"></span>
                    <input type="hidden"  name="txtbox_order_no" id="txtbox_order_no" />
                </td>
                </tr>
                  <tr>
            <td ><!--Shipment Number--></td>
                <td><!--<span id="shipment_no_spanid"></span>-->
                    <input type="hidden"  name="txtbox_shipment_number" id="txtbox_shipment_number" />
                </td>
                </tr>
                
            <tr>
                <td >Courier Name</td>
                <td>
                    <select name="courier_name" required>
                        <option value="">--select--</option>
                       <?php foreach($courier_info->result() as $res_courierinfo){ ?>
                       
                       <option value="<?= $res_courierinfo->courier_name ?>"> <?= $res_courierinfo->courier_name ?> </option>
                        <?php } ?>
                    </select>
                    
                     
                </td>
            </tr>
            <tr>
            <td > <input type="checkbox" id="other_courier" name="other_courier"  onclick="addother_courier()"   />Add Other Courier </td>
            <td>
            <span style="display:none;" id="spn_othercourier"> 
           Courier Name<input type="text" name="txtbox_othercourier" id="txtbox_othercourier" /> <br/><br/>
            Courier URL<input type="text" name="txtbox_othercourierURL" id="txtbox_othercourierURL" />
            <input type='button' value='Add' id="btn_addothercourier" onclick="save_couriername()" /> </span></td>
            
            </tr>
            
            <tr>
                <td >Tracking Number</td>
                <td>
                    <input type="text" name="tracking_number" id="tracking_number" required/>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input  type="submit" id="address_btn"   value="Ship Order" />
                </td>
            </tr>
            
            
      </table>
</form>
</div>
            
        </div>
      </div>
</div>


<!-- Request For Grace Period Div Strat -->

<div style="display:none">
      <div id="inline_content_request_graceperiod" style="padding:10px; background:#fff;">
      	<div class="edit_address_dv" style="width:600px;">
         	<h4 class="title sn">Request For Grace Period</h4>
<div class="col-md-12"><form action="<?php echo base_url().'seller/orders/request_forgraceperiod' ?> "  method="post" onsubmit="return valid_graceperiod()" >
		<table class="edit_address_form">
            <tr>
            <td align="right">Number Of Days </td>
            <td>
            <input type="hidden"  name="grctxtbox_order_no" id="grctxtbox_order_no" />
            <select name="grc_periodselect" id="grc_periodselect">
            <option value="">--select--</option>
            <option value="5">5 Days</option>
            <option value="7">7 Days</option>
            <option value="10">10 Days</option>
            
            </select>
             </td>
            
            </tr>
            <tr><td align="right">Reason</td>
            <td><textarea name="txtarea_graceperiod" id="txtarea_graceperiod"  ></textarea>
            </td>
            </tr>
            
            <tr><td colspan="2" align="center"><input type="Submit" value="Submit" /></td></tr>
      </table>
</form>
</div>
            
        </div>
      </div>
</div>


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
	
	
	
	
	
	function inTransit(){
		window.location.href='<?php echo base_url().'seller/Orders/intransist_orders' ?>';
		//$("#In_transit").show();
//		$("#trackOrder1").addClass('selected_block');
//		$("#trackOrder2").removeClass('selected_block');
//		$("#Delivered").hide();
	}
	function delivered(){
		$("#In_transit").hide();
		$("#trackOrder1").removeClass('selected_block');
		$("#trackOrder2").addClass('selected_block');
		$("#Delivered").show();
	}
</script>

<script>
function delete_order(ordered_id){
	//alert(ordered_id);return false; 
	var ys = confirm("Do you want cancel this order ?");
		if(ys){		
			$.ajax({
				method:"POST",
				url:"<?php echo base_url(); ?>seller/orders/cancel_order",
				data:{orderid:ordered_id},
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