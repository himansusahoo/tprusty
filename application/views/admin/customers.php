<?php
require_once('header.php');
?>			
		<!--- Zebra_Datepicker link start here ---->
		<link href="../Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
		<link href="../Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">
		<script src="../Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script>
		<script src="../Zebra_Datepicker-master/examples/public/javascript/core.js"></script>
		<script src="../Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
		<!--- Zebra_Datepicker link end here ---->

		<style>
			.Zebra_DatePicker_Icon{left: 10px !important; top: 0px !important;}
		</style>

	<div id="content">    
		<div class="top-bar">
			<div class="top-left">
				<?php include 'sub_customer.php'; ?>
			</div>
			<div class="top-right">
				<?php include 'top_right.php'; ?>
			</div>
		</div>  <!-- @end top-bar  -->
		<div class="main-content">
			<div class="row content-header">
				<div class="col-md-8"><b>Customers</b></div>
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
					per page <span class="separator">|</span> Total 11 records found
				</div>
				<div class="col-md-6">
					<button type="button" class="all_buttons">Search</button>
					<button type="button" class="all_buttons">Reset Filter</button>
				</div>
			</div>	
			<div>
				<table class="table table-bordered">
					<tr class="table_th">
						<th width="10%">ID</th>
						<th width="15%">First Name</th>
						<th width="15%">Last Name</th>
						<th width="15%">Email</th>
						<th width="7%">IP Address</th>
						<th width="12%">Session Start Time</th>
						<th width="12%">Last Activity</th>
						<th width="7%">Type</th>
						<th width="15%">Last URL</th>
					</tr>
					<tr class="filter_tr">
						<td>
							<div class="customer_id">
								<span class="label">From:</span>
								<input type="text" name="customer_id_from" value="">
							</div>
							<div class="customer_id">	
								<span class="label">To:</span>
								<input type="text" name="customer_id_to" value="">
							</div>
						</td>
						<td>
							<input type="text" name="fname" value="">
						</td>
						<td>
							<input type="text" name="lname" value="">
						</td>
						<td>
							<input type="text" name="email" value="">
						</td>
						<td></td>
						<td>
							<div class="id">
								<span class="label">From:</span>
								<input type="text" name="id_from" id="datepicker-example7-start" value="">
							</div>
							<div class="id">	
								<span class="label">To:</span>
								<input type="text" name="id_to" id="datepicker-example7-end" value="">
							</div>
						</td>
						<td>
							<div class="id">
								<span class="label">From:</span>
								<input type="text" name="id_from" id="datepicker-example15-start" value="">
							</div>
							<div class="id">	
								<span class="label">To:</span>
								<input type="text" name="id_to" id="datepicker-example15-end" value="">
							</div>
						</td>
						<td>
							<select>
								<option value=""></option>
								<option value="">Customer</option>
								<option value="">Visitor</option>
							</select>
						</td>
						<td>
							<input type="text" name="last_url" value="">
						</td>
					</tr>
					<tr>
						<td class="a-center" colspan="11">No records found ! </td>
					</tr>
				</table>
			</div>
		</div>  <!-- @end #main-content -->
	</div>
<?php
require_once('footer.php');
?>				