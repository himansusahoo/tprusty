<?php
require_once("header.php");
?>
	<!--- Zebra_Datepicker link start here ---->
	<link href="../Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
	<link href="../Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">
	<script src="../Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script>
	<script src="../Zebra_Datepicker-master/examples/public/javascript/core.js"></script>
	<script src="../Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
	<!--- Zebra_Datepicker link end here ---->
		
	<style>
		.Zebra_DatePicker_Icon{left: 110px !important; top: 3px !important;}
	</style>
	
	<div id="content">    
		<div class="top-bar">
			<div class="top-left">
				<?php include 'sub_sales.php'; ?>
			</div>
			<div class="top-right">
				<?php include 'top_right.php'; ?>
			</div>
		</div>  <!-- @end top-bar  -->
		<div class="main-content">
			<div class="row content-header">
				<div class="col-md-8"><b>Transactions</b></div>
			</div>
			<div class="row mb10">
				<div class="col-md-6">
					Page 
					<span class="glyphicon glyphicon-chevron-left arrow_button"></span>
					<input type="text" name="page" class="input_text" value="1">
					<span class="glyphicon glyphicon-chevron-right"></span>
					of 1 pages <span class="separator">|</span> View
					<select> 
						<option selected="selected" value="">20</option>
						<option>30</option>
						<option>50</option>
						<option>100</option>
						<option>200</option>
					</select>
					per page <span class="separator">|</span> Total 0 records found
				</div>
				<div class="col-md-3 show_report">
					<div class="all_save">
						Export To:
						<select>
							<option>CSV</option>
							<option>Excel XML</option>
						</select>
						<button type="button">Export</button>
					</div>
				</div>
				<div class="col-md-3 show_report">
					<button type="button" class="all_buttons">Search</button>
					<button type="button" class="all_buttons">Reset Filter</button>
				</div>
			</div>
			<div>
				<table class="table table-bordered">
					<tr class="table_th">
						<th width="3%">ID #</th>
						<th width="15%">Order ID</th>
						<th width="15%">Transaction ID</th>
						<th width="15%">Parent Transaction ID</th>
						<th width="20%">Payment Method Name</th>
						<th width="12%">Transaction Type</th>
						<th width="10%">Is Closed</th>
						<th width="10%">Created At</th>
					</tr>
					<tr class="filter_tr">
						<td>
							<div class="base">
								<span class="label">From:</span>
								<input type="text" name="qty_from" value="">
							</div>
							<div class="base">	
								<span class="label">To:</span>
								<input type="text" name="qty_to" value="">
							</div>
						</td>
						<td>
							<input type="text" name="order_id" value="">
						</td>
						<td>
							<input type="text" name="transaction_id" value="">
						</td>
						<td>
							<input type="text" name="parent_transaction_id" value="">
						</td>
						<td>
							<select>
								<option value=""></option>
								<option value="authorizenet">Credit Card (Authorize.net)</option>
								<option value="authorizenet_directpost">Credit Card Direct Post (Authorize.net)</option>
								<optgroup label="Moneybookers">
									<option value="moneybookers_pwy">All Polish Banks</option>
									<option value="moneybookers_acc">Credit Card / Visa, Mastercard, AMEX, JCB, Diners</option>
								</optgroup>
								<optgroup label="Offline Payment Methods">
									<option value="banktransfer">Bank Transfer Payment</option>
									<option value="cashondelivery">Cash On Delivery</option>
								</optgroup>
								<optgroup label="PayPal">
									<option value="payflow_link">Credit Card</option>
									<option value="payflow_advanced">Credit Card</option>
									<option value="paypal_billing_agreement">PayPal Billing Agreement</option>
									<option value="paypal_direct">PayPal Payments Pro</option>
									<option value="paypaluk_direct">PayPal Payments Pro Payflow Edition</option>
								</optgroup>
							</select>
						</td>
						<td>
							<select>
								<option value=""></option>
								<option value="order">Order</option>
								<option value="authorization">Authorization</option>
								<option value="capture">Capture</option>
								<option value="void">Void</option>
								<option value="refund">Refund</option>
							</select>
						</td>
						<td>
							<select>
								<option value=""></option>
								<option value="order">Yes</option>
								<option value="authorization">No</option>
							</select>
						</td>
						<td>
							<div class="order">
								<span class="label">From:</span>
								<input type="text" name="order_from" id="datepicker-example15-start" value="">
							</div>
							<div class="order">	
								<span class="label">To:</span>
								<input type="text" name="order_to" id="datepicker-example15-end" value="">
							</div>
						</td>
					</tr>
					<tr><td colspan="9" class="a-center">No records found ! </td></tr>
				</table>
			</div>
		</div>  <!-- @end #main-content -->
	</div>
<?php
require_once('footer.php');
?>