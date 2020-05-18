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
				<?php include 'sub_pages.php'; ?>
			</div>
			<div class="top-right">
				<?php include 'top_right.php'; ?>
			</div>
		</div>  <!-- @end top-bar  -->
		<div class="main-content">
			<div class="row content-header">
				<div class="col-md-8"><b>Manage Pages</b></div>
				<!--<div class="col-md-4 show_report">
					<button type="button" class="all_buttons">Add New Page</button>
				</div>-->
			</div>
			<!--<div class="row mb10">
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
			</div>-->
			<div>
				<table class="table table-bordered">
					<tr class="table_th">
						<th width="10%">Sl No</th>
						<th width="30%">Title</th>
						<th width="20%">Date Created</th>
						<th width="20%">Last Modified</th>
						<th width="10%">Action</th>
					</tr>
					<!--<tr class="filter_tr">
						<td></td>
						<td>
							<input type="text" name="title" value="">
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
							<div class="order">
								<span class="label">From:</span>
								<input type="text" name="order_from" id="datepicker-example15-start" value="">
							</div>
							<div class="order">	
								<span class="label">To:</span>
								<input type="text" name="order_to" id="datepicker-example15-end" value="">
							</div>
						</td>
						<td></td>
					</tr>-->
<?php
if($result) {
	foreach($result as $rows):
?>
					<tr>
						<td><?=$rows->page_id?></td>
						<td><?=$rows->title?></td>
						<td>
							<?=strstr($rows->date_created, ' ', true)?>
						</td>
						<td>
							<?=strstr($rows->last_updated, ' ', true)?>
						</td>
						<td>
							<a href="<?php echo base_url().'admin/pages/edit_page_content/'.$rows->page_id?>" id="edit_icon" data-toggle="tooltip"  title="Edit">
								<i class="fa fa-pencil-square-o"></i>
							</a>
						</td>
					</tr>
<?php
	endforeach;
}else{
?>
					<tr>
						<td class="a-center" colspan="4">No record found!</td>
					</tr>
<?php } ?>
				</table>
			</div>			
		</div>
	</div>
<?php
require_once('footer.php');
?>