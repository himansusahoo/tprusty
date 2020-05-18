<?php
require_once('header.php');
?>
		<div id="content">    
			<div class="top-bar">
				<div class="top-left">
					<?php include 'sub_orders.php'; ?>
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
				<?php require_once('common.php');  ?>
				<div class="page_header">
					<div class="left">
						<h3>Cancelled Orders</h3>
					</div>
					<div class="right order_id_search">
						<form>
							<!--<select>
								<option value="">Order Item Id</option>
								<option value="">Order Id</option>
							</select>-->
							<input name="cancel_order_id" type="text" style="padding:3px;" placeholder="Search Order Id">
							<button type="submit" class="seller_buttons"><span class="icon-search"></span></button>
						</form>
					</div>
					<div class="clear"></div>
				</div>
				<div class="order_filter_dropdown row">
					<div class="col-md-12">
						<form>
							<div class="input-append right">
								<span class="add-on">
									Invoice Time Period  
									<i class="icon-caret-right"></i>
								</span>
								<select>
									<option value="" selected="selected">Status - All</option>
									<option value="">Status - Cancelled by buyer</option>
									<option value="">Status - Cancelled by seller</option>
									<option value="">Status - Cancelled by Market Place</option>
								</select>
							</div>
						</form>
					</div>
				</div>
				<div class="cancel_content">
					<table class="table neworder_table" cellspacing="0" cellpadding="0" border="0">
						<tr>
							<th width="45%">Order summary</th>
							<th width="15%">Status</th>
							<th width="15%">Quantity & price</th>
							<th width="10%">Cancelled on</th>
							<th width="15%">Buyer details</th>
						</tr>
<?php
if($cancel_order_details){
	foreach($cancel_order_details as $row):
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
												<strong><?=$row->sku?></strong>
												<br>
												<strong>
													<a href="#"> <?=$row->name?> </a>
												</strong>												
												<br>
												<a class="muted" href="#">
													ORDER Date: <?php $date = date_create($row->date_of_order); echo date_format($date, 'M d, Y h:i A');?></a>
												<br>
												<a class="muted" href="#">ORDER ID: <?=$row->order_id?></a>
											</div>
										</div>
									</div>
								</div>
							</td>
							<td>
								<span class="msg-lines">Cancelled by <?=$row->cancelled_by?></span>
								<span class="msg-lines muted">Reason: <?=$row->reason?></span>
							</td>
							<td>
								<strong>Qty: <?=$row->quantity?></strong>
								<br>
								<span class="muted">Value: Rs. <?=$row->price?> each</span>
								<br>
								<span class="muted small">Shipping: Rs. <?=$row->sub_shipping_fees?> each</span>
								<br>
								<span> </span>
								<br>
								<strong>TOTAL: Rs. <?php echo $h = ($row->quantity*$row->price) + $row->sub_shipping_fees; ?></strong>
								<br>
								<br>
							</td>
							<td>
								<strong><?php $date = date_create($row->order_status_modified_date); echo date_format($date, 'M d, Y h:i A');?></strong>
							</td>
							<td class="break_anywhere">
								<?=$row->full_name?>
								<br>
								<?=$row->address?>
								<br>
								<br>
								<?=$row->country?> - <?=$row->pin_code?>
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
						<!--<tr>
							<td>
								<div class="row neworder_product_block">
									<div class="col-md-12">
										<div class="left image_block position_relative">
											<img src="<?php echo base_url();?>images/d30986_2.jpg" width="65">
										</div>
										<div class="left details_block">
											<div>
												<strong>SKU: MSV_002</strong>
												<br>
												<strong>
													<a href="#"> Selfie And Zoom Selfie Stick </a>
												</strong>
												<br>
												<span class="muted small">FSN: LLR2E98JHG78KJLL</span>
												<br>
												<a class="muted small" href="#">ORDER ITEM ID: 475645968458</a>
												<br>
												<a class="muted small" href="#">ORDER ID: OD0036854684565445</a>
											</div>
										</div>
									</div>
								</div>
							</td>
							<td>
								<span class="msg-lines">Cancelled by buyer</span>
								<span class="msg-lines muted">Reason: Ordered wrong item</span>
							</td>
							<td>
								<strong>Qty: 1</strong>
								<br>
								<span class="muted">Value: Rs. 298.00 each</span>
								<br>
								<span class="muted small">Shipping: Rs. 100.00 each</span>
								<br>
								<span> </span>
								<br>
								<strong>TOTAL: Rs. 398.00</strong>
								<br>
								<br>
							</td>
							<td>
								<strong>Aug 19, 2015</strong>
							</td>
							<td class="break_anywhere">
								Ghyslain
								<br>
								Plumeria Garden Estate, Omicron III, Greater Noida, house number(E603)Uttar Pradesh, India
								<br>
								<br>
								Gautam Buddh Nagar - 201310
							</td>
						</tr>-->
					</table>
				</div>
			</div>  <!-- @end #main-content -->
		</div><!-- @end #content -->
<?php
	require_once('footer.php');
?>