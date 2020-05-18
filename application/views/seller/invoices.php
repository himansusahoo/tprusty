<?php
require_once('header.php');
?>
			<div id="content">    
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_payments.php'; ?>
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
							<h3>Invoices</h3>
						</div>
						<div class="clear"></div>
					</div>
					<div class="note_update_current_date" style="display: inline-block;">
						* Note: You can download transactions for maximum period of 1 month. It may take up to 2-3 days before settled transactions appear on dashboard.
					</div>
					<div class="cancel_content">
						<div class="invoices settelment_details_table">
							<table class="table table-hover" cellspacing="0" cellpadding="0" border="0">
								<tr class="order_filter">
									<th class="order_filter_dropdown" colspan="3">
										<div class="row">
											<div class="col-md-12">
												<form>
													<div class="input-append">
														<span class="add-on">
															Invoice Time Period  
															<i class="icon-caret-right"></i>
														</span>
														<input class="add-on" type="text" id="settelment_period_date">
														<i class="add-on">
															<i class="icon-calendar"></i>
														</i>
													</div>
												</form>
											</div>
										</div>
									</th>
								</tr>
								<tr>
									<th>Invoice Date</th>
									<th>Invoice ID</th>	
									<th>Download</th>
								</tr>
								<tr>
									<td>Jul 31, 2015</td>
									<td>FKIR/2015-16/0000079238</td>
									<td>
										<a href="#">
											Download  
											<i class="icon-download"></i>
										</a>
									</td>
								</tr>
								<tr>
									<td>Jul 31, 2015</td>
									<td>FKIR/2015-16/0000074562</td>
									<td>
										<a href="#">
											Download  
											<i class="icon-download"></i>
										</a>
									</td>
								</tr>
								<tr>
									<td>Jul 31, 2015</td>
									<td>FKIR/2015-16/00000023560</td>
									<td>
										<a href="#">
											Download  
											<i class="icon-download"></i>
										</a>
									</td>
								</tr>
								<tr>
									<td>Jul 31, 2015</td>
									<td>FKIR/2015-16/0000075896</td>
									<td>
										<a href="#">
											Download  
											<i class="icon-download"></i>
										</a>
									</td>
								</tr>
								<tr>
									<td>Jul 30, 2015</td>
									<td>FKIR/2015-16/0000014569</td>
									<td>
										<a href="#">
											Download  
											<i class="icon-download"></i>
										</a>
									</td>
								</tr>
								<tr>
									<td>Jul 29, 2015</td>
									<td>FKIR/2015-16/0000015632</td>
									<td>
										<a href="#">
											Download  
											<i class="icon-download"></i>
										</a>
									</td>
								</tr>
							</table>
							<div>
								<button class="show_more_btn"><span>Show More</span></button>
							</div>
						</div>
					</div>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->
<?php
require_once('footer.php');
?>