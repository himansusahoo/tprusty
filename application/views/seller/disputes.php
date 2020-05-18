<?php
require_once('header.php');
?>
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
					<?php require_once('common.php');  ?>
					<div class="page_header">
						<div class="left">
							<h3>Disputes</h3>
						</div>
						<div class="clear"></div>
					</div>
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#tab1"> Disputes </a></li>
					</ul>
					<div class="row">
						<div class="col-md-12">
							<div class="row order_action_block mt20">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-8">
											<a href="#" class="btn">Download</a>
										</div>
										<div class="col-md-4">
											<a href="#" class="btn right">Refiners <span class="caret"></span></a>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<table class="table neworder_table">
										<tr style="background-color:#f8f8f8;">
											<th width="40%">Order Summary</th>
											<th width="15%">Dispute Details</th>
											<th width="15%">Quantity and Price</th>
											<th width="15%">Dispute Reason</th>
											<th width="15%">Dispute Status</th>
										</tr>
										<tr>
											<td colspan="5" class="a-center"><h4>There are no new Disputes</h4></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->
<?php
require_once('footer.php');
?>					