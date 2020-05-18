<?php
require_once('header.php');
?>

<script>
$(document).ready(function(){
	$('#check_all').click(function(){
		$("input[name='checkbox_returnID[]']").prop('checked', this.checked);
	});
});


function doChangeReturnStatus(status){
	var base_url = "<?php echo base_url();?>"; 
	var controller = "seller/returns";
	var del = $('input[name="checkbox_returnID[]"]:checked').map(function(_, el){  
		return $(el).val();
	}).get();
	if(del == ""){
		$('#select_return_status').prop('selectedIndex', 0);
		alert("Please select a return order.");
		return false;
	}else{
		var ys = confirm("Do you want to change the status ?"); 
		if(ys == true){
			window.location.href = base_url+controller+'/change_return_status/'+encodeURIComponent(status)+'/'+encodeURIComponent(del);
		}
	}
}
</script>

			<div id="content">    
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_returns.php'; ?>
					</div>
					<?php require_once('header_session.php'); ?>
				</div>  <!-- @end top-bar  -->
				
				<!-- 31 <?php
				$seller_signup_id = $this->session->userdata('seller-signup-session');
				if(!$seller_signup_id) : 
				?>
					<div style="padding-top:60px; margin:0px 50px;">
						<div class="alert alert-danger" role="alert"> *Important ! You have not completed signup. To complete click <a href="<?php echo base_url();?>seller/seller/incomplete_signup"><strong>here</strong></a></div>
					</div>
				<?php endif; ?>-->
				
				<div class="main-content">
					<?php require_once('common.php'); ?>
					<div class="page_header">
						<div class="left">
							<h3>Returns</h3>
						</div>
						<!--<div class="right order_id_search">
							<div class="search_bar input-append">
								<input type="text" name="order_id" placeholder=" Search Return ID/Order ID/Item ID ">
							</div>
						</div>-->
						<div class="clear"></div>
					</div>
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#tab1"> In-Progress </a></li>
						<li><a data-toggle="tab" href="#tab2"> Completed </a></li>
						<!--Take tour-->
						<!--<li class="no_tab">
							<span class="new_returns_policy">
								<i class="icon-info-sign"></i>
								<a href="#"> Return Policy </a>
							</span>
							<span class="seperater">|</span>
							<span>
								<i class="icon-play"></i>
								<a href="#"> Take a tour </a>
							</span>
						</li>-->
					</ul>
					<div class="tab-content">
						<div id="tab1" class="tab-pane fade in active">
							<div class="row">
								<!--<div class="col-md-2 sidebar">
									<div class="row">
										<div class="col-md-12">
											<strong class="fsize15">Refine</strong>
											<hr>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<h5><b>Fulfillment Type</b></h5>
											<ul>
												<li><input type="checkbox"> FA </li>
												<li><input type="checkbox"> Non FA </li>
											</ul>
											<hr>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<h5><b>Return Type</b></h5>
											<ul>
												<li><input type="checkbox"> Courier Return </li>
												<li><input type="checkbox"> Customer Return </li>
											</ul>
											<hr>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<h5><b>Shipment Status</b></h5>
											<ul>
												<li><input type="checkbox"> With Customer </li>
												<li><input type="checkbox"> In Transit </li>
												<li><input type="checkbox"> Out for Delivery /Reached Warehouse </li>
											</ul>
											<hr>
										</div>
									</div>
								</div>-->
                                
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-12">
                                            <p><input type="checkbox" name="check_all" id="check_all">
                                                <select name="select_return_status" id="select_return_status" onChange="doChangeReturnStatus(this.value)" >
                                                <option>--Change Status--</option>
                                                <option value="Return Received">Return Received</option>
                                                </select>
                                             </p>
										<!--Take tour-->
											<!--<div class="right mb10">
												<span>
													<a href="#">Export</a>
													<span> | </span>
													<a href="#">Export All</a>
												</span>
											</div>-->
											<table class="table neworder_table">
												<tr style="background-color:#f8f8f8;">
                                                	<th width="3%"></th>
													<th width="32%">Order Summary</th>
													<th width="15%">Quantity and Price</th>
													<th width="20%">Return Details</th>
													<th width="15%">Return Reason</th>
													<th width="15%">Tracking Details</th>
												</tr>
<?php
if($result){
		foreach($result as $row): 
		$img = $row->imag; 
		$image = explode(',', $img);
?>
												<tr>
                                                	<td><input type="checkbox" name="checkbox_returnID[]" value="<?=$row->order_id?>"></td>
													<td class="return_order_details_td">
														<div class="row neworder_product_block">
															<div class="col-md-12">
																<div class="left position_relative image_block">
																	<img src="<?php echo base_url();?>images/product_img/<?php echo $image[0]; ?>" width="65">
																</div>
																<div class="left details_block">
																	<div>
																		<span class="block">
																			<strong>SKU: </strong>
																			<?=$row->sku?>
																		</span>
																		<strong><a href="#"><?=$row->name?></a>
                                                                        <br>
                                                                        
                                                                         <?php        
                                                                                $color_sizecronjobquery=$this->db->query("SELECT color,size,Capacity,RAM,ROM FROM  cornjob_productsearch WHERE sku='$row->sku' group by sku ");
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
																		<!--<tr>
																			<th>FSN</th>
																			<td>ACCE2EN2G9QAWQXF</td>
																		</tr>-->
																		<tr>
																			<th>Order Date</th>
																			<td>
																				<?php
																					$date=date_create($row->date_of_order);
																					echo date_format($date, 'M d, Y h:i A');
																				?>
																			</td>
																		</tr>
																		<!--<tr>
																			<th>Order Item ID</th>
																			<td>
																				<span>232401298</span>
																			</td>
																		</tr>-->
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
													<td>
														<div>
															<strong class="block">Qty : <?=$row->quantity?></strong><br>
															<span class="muted">
																Value :
																<i class="icon-rupee"></i>
																<?=$row->sub_total_amount/$row->quantity?> each
															</span>
															<br>
															<strong>
																Total :
																<i class="icon-rupee"></i>
																<?php //echo $T = $row->quantity * $row->mrp;
																	echo $row->sub_total_amount;
																 ?> 
															</strong>
														</div>
													</td>
													<td>
														<strong class="block">Return ID: <?=$row->return_id?></strong><br>
														<span class="muted">Requested On: 
															<?php
																$date=date_create($row->cdate);
																echo date_format($date, 'M d, Y');
															?>
														</span><br>
														<span class="muted">Delivery Date: 
                                                        	<?php 
                                                            	$date1 = date_create($row->order_status_modified_date);
																echo date_format($date1, 'M d, Y');
                                                            ?>
                                                        </span><br>
														<strong class="block">Request Type: <?=$row->return_typ?></strong><br>
														<!--<strong class="block">Courier Return</strong><br>-->
													</td>
													<td>
														<strong><?=$row->reason?></strong><br>
														<!--<div>
															<span>
																<a href="#">Comment</a>
															</span>
														</div>-->
													</td>
													<td>
														<div>
															<strong>Return Status</strong>
															: <?=$row->product_order_status?>
														</div>
														<div>
															<span class="muted">
																<strong>Tracking Id :</strong>
																<!--<a href="#">--><?=$row->tracking_no?><!--</a>-->
															</span>
														</div>
													</td>
												</tr>
<?php 
	endforeach;
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
								</div>
							</div>   
						</div><!-- @end tab1 -->
						<div id="tab2" class="tab-pane fade">
							<div class="row">
								<!--<div class="col-md-2 sidebar">
									<div class="row">
										<div class="col-md-12">
											<strong class="fsize15">Refine</strong>
											<hr>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<h5><b>Fulfillment Type</b></h5>
											<ul>
												<li><input type="checkbox"> FA </li>
												<li><input type="checkbox"> Non FA </li>
											</ul>
											<hr>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<h5><b>Return Type</b></h5>
											<ul>
												<li><input type="checkbox"> Courier Return </li>
												<li><input type="checkbox"> Customer Return </li>
											</ul>
											<hr>
										</div>
									</div>
								</div>-->
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-12">
											<!--<div class="right mb10">
												<span>
													<a href="#">Export</a>
													<span> | </span>
													<a href="#">Export All</a>
												</span>
											</div>
											<div class="mb10">The total count: 126</div>-->
											<table class="table neworder_table">
												<tr style="background-color:#f8f8f8;">
													<th width="40%">Order Summary</th>
													<th width="15%">Quantity and Price</th>
													<th width="15%">Return Details</th>
													<th width="15%">Return Reason</th>
													<th width="15%">Tracking Details</th>
												</tr>
<?php
if($result1){
		foreach($result1 as $row): 
		$img = $row->imag; 
		$image = explode(',', $img);
?>
												<tr>
													<td class="return_order_details_td">
														<div class="row neworder_product_block">
															<div class="col-md-12">
																<div class="left position_relative image_block">
																	<img src="<?php echo base_url();?>images/product_img/<?php echo $image[0]; ?>" width="65">
																</div>
																<div class="left details_block">
																	<div>
																		<span class="block">
																			<strong>SKU: </strong>
																			<?=$row->sku?>
																		</span>
																		<strong><a href="#"><?=$row->name?></a>
                                                                        <br>
                                                                         <?php        
                                                                                $color_sizecronjobquery=$this->db->query("SELECT color,size,Capacity,RAM,ROM FROM  cornjob_productsearch WHERE sku='$row->sku' group by sku ");
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
																			<td><?php
																					$date=date_create($row->date_of_order);
																					echo date_format($date, 'M d, Y h:i A');
																				?></td>
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
													<td>
														<div>
															<strong class="block">Qty : <?=$row->quantity?></strong><br>
															<span class="muted">
																Value :
																<i class="icon-rupee"></i>
																<?=$row->sub_total_amount/$row->quantity;?> each
															</span>
															<br>
															<strong>
																Total :
																<i class="icon-rupee"></i>
																<?php //echo $T = $row->quantity * $row->mrp; 
																		echo $row->sub_total_amount;
																?> 
															</strong>
														</div>
													</td>
													<td>
														<strong class="block">Return ID: <?=$row->return_id?></strong><br>
														<span class="muted">Requested On: 
															<?php
																$date=date_create($row->cdate);
																echo date_format($date, 'M d, Y');
															?>
														</span><br>
														<span class="muted">Return Received Date: 
                                                        	<?php
																$date=date_create($row->order_status_modified_date);
																echo date_format($date, 'M d, Y');
															?>
                                                        </span><br>
														<strong class="block">Request Type: <?=$row->return_typ?></strong><br>
														<!--<strong class="block">Courier Return</strong><br>-->
													</td>
													<td>
														<strong><?=$row->reason?></strong><br>
														<div>
															<span>
																<!--<a href="#">Comment</a>-->
															</span>
														</div>
													</td>
													<td>
                                                    	<div>
															<strong>Return Status</strong>
															: <?=$row->product_order_status?>
														</div>
														<div>
															<span class="muted">
																<strong>Tracking Id :</strong>
																<!--<a href="#">--><?=$row->tracking_no?><!--</a>-->
															</span>
														</div>
														<!--<div class="action_top">
															<a class="btn btn_small">Contact SS</a>
														</div>
														<div>
															<a class="action_link" href="#">Payment History</a>
															<a href="#">Shipment History</a>
														</div>-->
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
									</div>
								</div>
							</div>
						</div>
					</div>	<!-- @end tab_content -->				
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->
<?php
require_once('footer.php');
?>