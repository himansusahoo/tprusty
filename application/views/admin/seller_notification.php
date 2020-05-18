<?php
require_once('header.php');
?>
		<div id="content">
			<div class="top-bar">
				<div class="top-left">
					<?php include 'sub_sellers.php'; ?>
				</div>
				<div class="top-right">
					<?php include 'top_right.php'; ?>
				</div>
			</div>  <!-- @end top-bar  -->
			<div class="main-content">
            <form action="#">
				<div class="row content-header">
                    <h4>Seller Notification</h4>
				</div>
				<div class="row mb10">
					<div class="col-md-6"> 
						<!--Page 
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
						per page <span class="separator">|</span> Total 2 records found-->
					</div>
					<!--  Code for add & status change					
					<div class="col-md-6 show_report">
					<?//php if(!$result){ ?>
						<a class="all_buttons" href="<?//php echo base_url(); ?>admin/sellers/seller_notification_form">Add New Notice</a>
					<?//php }else{ ?>
						<div class="right">
							Change Status :
							<select name="status" class="seller_input">
								<option value="">--Select Status--</option>
								<option value="Active">Active</option>
								<option value="Inactive">Inactive</option>
							</select>
						</div>
					
					<?//php } ?>
					</div>-->
					<div class="col-md-6 show_report">
						<a class="all_buttons" href="<?php echo base_url(); ?>admin/sellers/seller_notification_form">Add Notice for All Seller</a>
					</div>
				</div>
				
				<div>
					<table class="table table-bordered">
						<tr class="table_th">
                            <th width="10%">Title</th>
							<th width="0%">Content</th>
							<th width="15%">Create Date</th>
							<!--<th width="15%">Modified Date</th>-->
							<th width="10%">Status</th>
							<th width="10%">Action</th>
						</tr>
<?php
if($result){
	foreach($result as $row):
?>
						<tr>
							<td><?=$row->title?></td>
							<td><?=$row->content?></td>
							<td><?=$date = strstr($row->create_date, ' ', true)?></td>
							<!--<td><?//=$date = strstr($row->modify_date, ' ', true)?></td>-->
							<td><?=$row->status?></td>
							<td>
								<a href="<?php echo base_url(); ?>admin/sellers/seller_notification_edit/<?=$row->id?>" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o" style="font-size:25px;"></i></a>&nbsp;&nbsp;
								<a href="<?php echo base_url(); ?>admin/sellers/seller_notification_delete/<?=$row->id?>" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o" style="font-size:25px;"></i></a>&nbsp;&nbsp;
							</td>
						</tr>	
<?php	endforeach;
	}else{
?>
						<tr>
							<td class="a-center" colspan="6">No record found !</td>
						</tr>
<?php }  ?>
					</table>
				</div>
              </form>
			  
			  <div>
				<div class="col-md-6 show_report mb10">
					<a class="all_buttons" href="<?php echo base_url(); ?>admin/sellers/seller_notification_form2">Add Notice to Indivisual Seller</a>
				</div>
				<div>
					<table class="table table-bordered">
						<tr class="table_th">
                            <th width="10%">Title</th>
							<th width="0%">Content</th>
							<th width="15%">Seller</th>
							<th width="10%">Status</th>
							<th width="10%">Action</th>
						</tr>
<?php
if($result2){
	foreach($result2 as $row):
?>
						<tr>
							<td><?=$row->title?></td>
							<td><?=$row->content?></td>
							<td><?=$row->business_name?></td>
							<td><?=$row->status?></td>
							<td>
								<a href="<?php echo base_url(); ?>admin/sellers/seller_notification_edit2/<?=$row->id?>" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o" style="font-size:25px;"></i></a>&nbsp;&nbsp;
								<a href="<?php echo base_url(); ?>admin/sellers/seller_notification_delete2/<?=$row->id?>" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o" style="font-size:25px;"></i></a>&nbsp;&nbsp;
							</td>
						</tr>	
<?php	endforeach;
	}else{
?>
						<tr>
							<td class="a-center" colspan="6">No record found !</td>
						</tr>
<?php }  ?>
					</table>
				</div>
				
			  </div>
              
			</div> <!-- @end #main-content -->
            <div id="show"></div>
            
		</div><!-- @end #content -->


<script>
function dispatchValid(){
	var state = $('#state').val();
	var dispatch_time = $('#dispatch_time').val();
	if(state == ''){
		alert('Please choose state.');
		return false;
	}else if(dispatch_time == ''){
		alert('Please enter dispatched days.');
		$('#dispatch_time').focus();
		return false;
	}else if(isNaN(dispatch_time)){
		alert('Please enter valid days.');
		$('#dispatch_time').select();
		return false;
	}
}

function dispatchValid1(){
	var state = $('#edt_state').val();
	var dispatch_time = $('#edit_dispatch_time').val();
	if(state == ''){
		alert('Please choose state.');
		return false;
	}else if(dispatch_time == ''){
		alert('Please enter dispatched days.');
		$('#dispatch_time').focus();
		return false;
	}else if(isNaN(dispatch_time)){
		alert('Please enter valid days.');
		$('#dispatch_time').select();
		return false;
	}
}
</script>

<script>
function saveUpdaeDispatch(state_id,dispatched_days){
	$('#add_dv').hide();
	$('#edit_dv').show();
	$('#edit_dispatch_time').val(dispatched_days);
	$('#edt_state').val(state_id).attr("selected", "selected");
}
</script>
<?php
require_once('footer.php');
?>					