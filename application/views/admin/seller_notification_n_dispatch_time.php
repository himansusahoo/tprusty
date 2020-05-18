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
					<?php if(!$result){ ?>
						<a class="all_buttons" href="<?php echo base_url(); ?>admin/sellers/seller_notification_form">Add New Notice</a>
					<?php }else{ ?>
						<div class="right">
							Change Status :
							<select name="status" class="seller_input">
								<option value="">--Select Status--</option>
								<option value="Active">Active</option>
								<option value="Inactive">Inactive</option>
							</select>
						</div>
					
					<?php } ?>
					</div>-->
					<div class="col-md-6 show_report">
						<?php if(!$result){ ?>
							<a class="all_buttons" href="<?php echo base_url(); ?>admin/sellers/seller_notification_form">Add New Notice</a>
						<?php } ?>
					</div>
				</div>
				
				<div>
					<table class="table table-bordered">
						<tr class="table_th">
                            <th width="10%">Title</th>
							<th width="0%">Content</th>
							<th width="15%">Create Date</th>
							<th width="15%">Modified Date</th>
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
							<td><?=$date = strstr($row->modify_date, ' ', true)?></td>
							<td><?=$row->status?></td>
							<td>
								<a href="<?php echo base_url(); ?>admin/sellers/seller_notification_edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o" style="font-size:25px;"></i></a>&nbsp;&nbsp;
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
              
              <div id="dispath_time_dv">
            	<div class="row content-header">
                    <h4>Set Dispatched Time</h4>
				</div>
                <div id="dispatch_form_dv">
                	<div id="add_dv">
                	<?php
					$attributes = array('class' => 'dispatched_form');
					echo form_open('admin/sellers/get_dispatched_time_data',$attributes); 
					?>
                        <table width="100%">
                            <tr>
                                <td width="180px">Choose State : </td>
                                <td>
                                    <select name="state" class="text2" id="state" style="width:200px !important;">
                                        <option value="">---select---</option>
                                        <?php foreach($state_result as $state_row){ ?>
                                        <option value="<?=$state_row->state_id;?>"><?=$state_row->state;?></option>
                                        <?php }?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Dispatched Time(in days) : </td>
                                <td><input type="text" class="text2" name="dispatch_time" id="dispatch_time" style="width:200px !important;"></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><input onClick="return dispatchValid()" type="submit" class="btn-warning lsav3" style="width:100px;" value="submit"></td>
                            </tr>
                            <tr>
                            	<td colspan="2" style="text-align:center;">
                                	<span class="ss_msg"><?=$this->session->flashdata('ss_msg');?></span>
                                	<span class="error_msg"><?=$this->session->flashdata('err_msg');?></span>
                                </td>
                            </tr>
                        </table>
                    <?php echo form_close(); ?>
                    </div>
                    
                    <div id="edit_dv">
                    	<?php
					$attributes = array('class' => 'dispatched_form');
					echo form_open('admin/sellers/edit_dispatched_time_data',$attributes); 
					?>
                        <table width="100%">
                            <tr>
                                <td width="180px">Choose State : </td>
                                <td>
                                    <select name="state" class="text2" id="edt_state" style="width:200px !important;">
                                        <option value="">---select---</option>
                                        <?php foreach($state_result as $state_row){ ?>
                                        <option value="<?=$state_row->state_id;?>"><?=$state_row->state;?></option>
                                        <?php }?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Dispatched Time(in days) : </td>
                                <td><input type="text" class="text2" name="dispatch_time" id="edit_dispatch_time" style="width:200px !important;"></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><input onClick="return dispatchValid1()" type="submit" class="btn-warning lsav3" style="width:100px;" value="Update"></td>
                            </tr>
                            <tr>
                            	<td colspan="2" style="text-align:center;">
                                	<span class="ss_msg"><?=$this->session->flashdata('ss_msg');?></span>
                                    <span class="error_msg"><?=$this->session->flashdata('err_msg');?></span>
                                    </td>
                            </tr>
                        </table>
                    <?php echo form_close(); ?>
                    </div>
                    
                    <table class="table-bordered table-hover commission_tbl">
                    	<tr class="commision_tr_hed">
                        	<th> &nbsp;State</th>
                            <th> &nbsp;Dispatch Days</th>
                            <th> &nbsp;Action</th>
                        </tr>
                        <?php foreach($dispatched_result as $dispatch_row){ ?>
                        <tr>
                        	<td> &nbsp;<?=$dispatch_row->state;?></td>
                            <td> &nbsp;<?=$dispatch_row->dispatch_days;?></td>
                            <td align="center"><span class="edt" onClick="saveUpdaeDispatch(<?=$dispatch_row->state_id;?>,<?php if($dispatch_row->dispatch_days==''){ echo 0;}else{ echo $dispatch_row->dispatch_days;};?>)">Edit</span></td>
                        </tr>
                        <?php } ?>
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