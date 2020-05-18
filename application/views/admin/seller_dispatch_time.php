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
                                <td width="180px">Choose State <sup>*</sup>: </td>
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
                                <td>Dispatched Time(in days)<sup>*</sup>: </td>
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