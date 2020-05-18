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
				<div class="col-md-8"><b>Manage Terms and Conditions</b></div>
				<div class="col-md-4 show_report">
					<button type="button" class="all_buttons">Add New Condition</button>
				</div>
			</div>
			<div class="row mb10">
				<div class="col-md-8">
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
				<div class="col-md-4 show_report">
					<button type="button" class="all_buttons">Search</button>
					<button type="button" class="all_buttons">Reset Filter</button>
				</div>
			</div>	
			<div>
				<table class="table table-bordered">
					<tr class="table_th">
						<th width="10%">ID</th>
						<th width="70%">Condition Name</th>
						<th width="20%">Status</th>
					</tr>
					<tr class="filter_tr">
						<td>
							<input type="text" name="order" value="">
						</td>
						<td>
							<input type="text" name="name" value="">
						</td>
						<td>
							<select>
								<option value=""></option>
								<option value="">Disabled</option>
								<option value="">Enabled</option>
							</select>
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