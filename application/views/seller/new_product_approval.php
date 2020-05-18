<?php
require_once('header.php');
?>
			<div id="content">    
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_catalog.php'; ?>
					</div>			
					<!-- header_session included here -->
					<?php require_once('header_session.php'); ?>
				</div>  <!-- @end top-bar  -->
				
<!-- 31 <?php
$seller_signup_id = $this->session->userdata('seller-signup-session');
if(!$seller_signup_id) : 
?>
				<div style="padding-top:60px; margin:0px 50px;">
					<div class="alert alert-danger" role="alert"> *Important ! You have not completed signup. To complete click <a href="<?php echo base_url();?>seller/seller/incomplete_signup"><strong>here</strong></a></div>
				</div>
<?php
endif;
?>-->
				<div class="main-content">
					<?php require_once('common.php');  ?>
					<div class="page_header mb10">
						<div class="left">
							<h3>Product Approval</h3>
						</div>
						<div class="clear"></div>
					</div>
					<div class="col-md-12 mb10">
						<!--<div class="left col-md-6">You can track the status of your approval requests here.</div>-->
						<div class="right">
							<button type="button" class="all_buttons" id="filter_button">
								Filters
								<span class="caret"></span>
							</button>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<table class="table neworder_table">
								<tr style="background-color:#efefef;">
									<th>SKU</th>
									<th>Category</th>
									<th>Brand</th>
									<th>Status</th>
									<th>Comments</th>
									<th>Created Time</th>
								</tr>
<?php 
if($new_approved_products) { //var_dump($new_approved_products); exit;
	foreach($new_approved_products as $row) :
?>
								<tr>
									<td><?=$row->sku?></td>
									<td><?=$row->category_name?></td>
									<td><?=$row->business_name?></td>
									<td><?=$row->product_approve?></td>
									<td></td>
									<td><?php $date=$row->date_added; echo $date = strstr($date, ' ', true); ?></td>
								</tr>
<?php
	endforeach;
}else{
?>
								<tr>
									<td class="a-center" colspan="6">No approval requests found</td>
								</tr>
<?php
}
?>
							</table>
						</div>
					</div>
				</div>
			</div><!-- @end #content -->
			<script>
				$(document).ready(function() {
					$("#filter_button").hover(function () {
						$(this).find(".hi").toggle();
					});
				});
			</script>
<?php
require_once('footer.php');
?>