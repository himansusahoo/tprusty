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
				<div class="col-md-8"><b>Credit Memos</b></div>
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
				<table class="multi_action">
					<tr>
						<td>
							<a href="#">Select Visible</a>
							<span class="separator">|</span>
							<a href="#">Unselect Visible</a>
							<span class="separator">|</span>
							0 items selected
						</td>
						<td>
							<div class="right">
								<form>
									<table>
										<tr>
											<td>Actions</td>
											<td>
												<select>
													<option value=""></option>
													<option value="">PDF Credit Memos</option>
												</select>
											</td>
											<td><input type="submit" name="submit" class="all_buttons" value="Submit"></td>
										</tr>
									</table>
								</form>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<div>
				<table class="table table-bordered">
					<tr class="table_th">
						<th width="5%"></th>
						<th width="15%">Credit Memo #</th>
						<th width="15%">Created At</th>
						<th width="15%">Order #</th>
						<th width="10%">Order Date</th>
						<th width="15%">Bill to Name</th>
						<th width="10%">Status</th>
						<th width="10%">Refunded</th>
						<th width="5%">Action</th>
					</tr>
					<tr class="filter_tr">
						<td>
							<select>
								<option>Any</option><option>Yes</option><option>No</option>
							</select>
						</td>
						<td>
							<input type="text" name="invoice" value="">
						</td>
						<td>
							<div class="order">
								<span class="label">From:</span>
								<input type="text" name="order_from" id="datepicker-example7-start" value="">
							</div>
							<div class="order">	
								<span class="label">To:</span>
								<input type="text" name="order_to" id="datepicker-example7-end" value="">
							</div>
						</td>
						<td>
							<input type="text" name="order" value="">
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
						<td>
							<input type="text" name="billing_name" value="">
						</td>
						<td>
							<select>
								<option value=""></option>
								<option value="1">Pending</option>
								<option value="2">Refunded</option>
								<option value="3">Canceled</option>
							</select>
						</td>
						<td>
							<div class="base">
								<span class="label">From:</span>
								<input type="text" name="base_from" value="">
							</div>
							<div class="base">	
								<span class="label">To:</span>
								<input type="text" name="base_to" value="">
							</div>
						</td>
						<td></td>
					</tr>
					<tr><td colspan="9" class="a-center">No records found ! </td></tr>
				</table>
			</div>
		</div>  <!-- @end #main-content -->
	</div>
<?php
require_once('footer.php');
?>				