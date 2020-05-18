<?php
require_once('header.php');
?>		
		<!--- Zebra_Datepicker link start here ---->
		<link href="<?php echo base_url();?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
		<link href="<?php echo base_url();?>Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">
		<script src="<?php echo base_url();?>Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script>
		<script src="<?php echo base_url();?>Zebra_Datepicker-master/examples/public/javascript/core.js"></script>
		<script src="<?php echo base_url();?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
		<!--- Zebra_Datepicker link end here ---->
		<style>
			.Zebra_DatePicker_Icon{left: 160px !important; top: 7px !important;}
		</style>
	
			<div id="content">    
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_payments.php'; ?>
					</div>
					<?php require_once('header_session.php'); ?>
				</div>  <!-- @end top-bar  -->
				
				<!--<?php
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
							<h3>Add-On Transactions</h3>
						</div>
						<div class="clear"></div>
					</div>
					<div class="row">				
						<div class="col-md-12 sectionHeader">		
							<h4>Summary</h4>
						</div>
					</div>
					<form class="row form-horizontal btn_orders_tracking">
						<div class="col-md-4 mt10">
							Unconsumed CoD Budget
							<input type="text" class="paynt_trans_input" readonly="" value="0">
						</div>
						<div class="col-md-4"> </div>
						<div class="col-md-4 mt10"> 
							Free Credit Balance
							<input type="text" class="paynt_trans_input" readonly="" value="0">
						</div>
					</form>
					<div class="row">				
						<div class="col-md-12 sectionHeader">		
							<h4>Enter Search Criteria</h4>
						</div>
					</div>
					<form class="row form-horizontal btn_orders_tracking">
						<div class="col-md-4">
							<table class="mt10">
								<tr>
									<td>Payment Type:*</td>
									<td>
										<select class="paynt_trans_input">
											<option>--Select Payment Type--</option>
											<option>Reserved from CoD</option>
											<option>Free Credit</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Service Type:</td>
									<td>
										<select class="paynt_trans_input">
											<option>ADS</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>From Date:*</td>
									<td>
										<input type="text" class="paynt_trans_input" name="from" id="datepicker-example1">
									</td>
								</tr>
							</table>
						</div>	
						<div class="col-md-4"> 
							<table class="mt10">
								<tr>
									<td>Item Description:</td>
									<td><input type="text" class="paynt_trans_input" name="from" placeholder="campaign name"></td>
								</tr>
								<tr>
									<td>Free Credit Expiry on/before:</td>
									<td><input type="text" class="paynt_trans_input" readonly=""></td>
								</tr>
								<tr>
									<td>To Date:*</td>
									<td>
										<input type="text" class="paynt_trans_input" name="from" id="datepicker-example2">
									</td>
								</tr>
							</table>
						</div>
						<div class="col-md-4">
							<table class="mt10 transaction_type_table">
								<tr>
									<td>
										<span>
											<strong>Transaction Type:*</strong><br>
											<span class="muted">(select atleast one)</span>
										</span>
									</td>
									<td>
										<ul>
											<li>
												<input type="checkbox" name="transaction_type">
												Consumption
											</li>
											<li>
												<input type="checkbox" name="transaction_type">
												Reward
											</li>
											<li>
												<input type="checkbox" name="transaction_type">
												Budgeted
											</li>
											<li>
												<input type="checkbox" name="transaction_type">
												Reversal
											</li>
										</ul>
									</td>
								</tr>
							</table>
						</div>
					</form>
					<div class="row">				
						<div class="col-md-12 sectionHeader a-center">
							<div class="mtb10">
								<button type="button">clear</button>
								<button type="button">Search</button>
							</div>
						</div>
					</div>
					<div class="cancel_content">
						<div class="invoices mt20">
							<table class="table table-hover">
								<tr>
									<th>Transaction Date</th>
									<th>Payment Type</th>	
									<th>Transaction Type</th>
									<th>Service Type</th>
									<th>Description</th>
									<th>Credit</th>
									<th>Debit</th>
								</tr>
								<tr>
									<td> 31-07-2015</td>
									<td> Reserved from CoD</td>
									<td> Reversal</td>
									<td> ADS</td>
									<td> FK</td>
									<td> 80</td>
									<td> </td>
								</tr>
								<tr>
									<td> 31-07-2015</td>
									<td> Reserved from CoD</td>
									<td> Reversal</td>
									<td> ADS</td>
									<td> FK</td>
									<td> 64</td>
									<td> </td>
								</tr>
								<tr>
									<td> 31-07-2015</td>
									<td> Reserved from CoD</td>
									<td> Consumption</td>
									<td> ADS</td>
									<td> FK</td>
									<td> </td>
									<td> 80.01</td>
								</tr>
								<tr>
									<td> 30-07-2015</td>
									<td> Reserved from CoD</td>
									<td> Reversal</td>
									<td> ADS</td>
									<td> FK</td>
									<td> 106</td>
									<td> </td>
								</tr>
								<tr>
									<td> 30-07-2015</td>
									<td> Reserved from CoD</td>
									<td> Consumption</td>
									<td> ADS</td>
									<td> FK</td>
									<td> </td>
									<td> 106</td>
								</tr>
								<tr>
									<td> 29-07-2015</td>
									<td> Reserved from CoD</td>
									<td> Reversal</td>
									<td> ADS</td>
									<td> FK</td>
									<td> 50</td>
									<td> </td>
								</tr>
							</table>
						</div>
						<ul class="pager">
							<li><a href="#">Previous</a></li>
							<li><a href="#">Next</a></li>
						</ul>
					</div>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->
<?php
require_once('header.php');
?>