<?php
require_once('header.php');
?>			
		<div id="content">    
			<div class="top-bar">
				<div class="top-left">
					<?php include 'sub_about.php'; ?>
				</div>
				<div class="top-right">
					<?php include 'top_right.php'; ?>
				</div>
			</div>  <!-- @end top-bar  -->
			<div class="main-content">
				<div class="row content-header">
					<div class="col-md-8"><b>Roles</b></div>
					<div class="col-md-4 show_report">
						<button type="button" class="all_buttons">Add New Role</button>
					</div>
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
					<div class="col-md-6 show_report">
						<button type="button" class="all_buttons">Search</button>
						<button type="button" class="all_buttons">Reset Filter</button>
					</div>
				</div>
				<div>
					<table class="table table-bordered">
						<tr class="table_th">
							<th width="5%">ID</th>
							<th width="95%">Role Name</th>
						</tr>
						<tr class="filter_tr">
							<td><input type="text" name="id" value=""></td>
							<td><input type="text" name="role" value=""></td>
						</tr>
						<tr>
							<td>1</td>
							<td>Administrators</td>
						</tr>
					</table>
				</div>
		</div><!-- @end #content -->
<?php
require_once('footer.php');
?>	