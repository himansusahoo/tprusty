<?php
require_once("header.php");
?>
			<div id="content">    
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_catalog.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
                
                
                
                 <form action="<?php //echo base_url().'admin/shipment/insert_shipment_settings' ?>" method="post">
                
					<div class="row content-header">
                    	<div class="col-md-2"><b> Shipmnet Fees Settings </b></div>
						<div class="col-md-10">
                        	
						<!--<div class="col-md-4 show_report">-->
							<!--<input type="reset" class="all_buttons" value="Reset">
							<button type="button" onClick="window.location.href='<?php// echo base_url(); ?>admin/Attribute'" class="all_buttons">Back</button>-->
						<!--</div>-->
                        </div>
					</div>
                    
                    <div class="clearfix"></div>
                    
                    
                    <!-- @start #right-content -->
                   <div align="center" style="color:#F00;" id="show_error"> </div>
					<div class="form_view">
						<h3>Create New Shipment Fees Settings </h3>
							<table>
                            	 <tr>
									<td style="width:20%;">Choose Shippment Type</td>
									<td>
                                    <?php
									$shprow = $shippment_type_result->num_rows();
									if($shprow > 0){
										$ship_result = $shippment_type_result->result();
										$ship_type = $ship_result[0]->type;
									?>
                                    	<input type="radio" name="shipping_type" id="default" value="default" <?php if($ship_type == 'default'){ echo 'checked';} ?>/>Default &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                		<input type="radio" name="shipping_type" id="flat" value="flat" <?php if($ship_type == 'flat'){ echo 'checked';} ?> />Flat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="shipping_type" id="free" value="free" <?php if($ship_type == 'free'){ echo 'checked';} ?> />Free &nbsp;&nbsp;&nbsp;<span class="show_msg3"></span>
                                     <?php 
									 }else{ 
									 $ship_type = 'null';
									 ?>
                                     	
                                     <input type="radio" name="shipping_type" id="default" value="default" checked/>Default &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                	 <input type="radio" name="shipping_type" id="flat" value="flat" />Flat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     <input type="radio" name="shipping_type" id="free" value="free" />Free &nbsp;&nbsp;&nbsp;<span class="show_msg3"></span>

                                     <?php } ?>
                                    </td>
								</tr>
                            	<tr class="default_tr">
									<td style="width:20%;">Local Shipping Amount</td>
									<td>
                                    <?php
									$admin_shipment_state_row = $admin_state->num_rows();
									if($admin_shipment_state_row > 0){
										foreach($admin_state->result() as $state_id_row){
											$arr_state[] = $state_id_row->state_id;
										}
									}else{
										$arr_state[] = '';
									}
									 ?>
                                        <select class="text2 shpng" name="state" id="state">
                                        	<option value="">select state</option>
                                        	<?php foreach($result as $row){ ?>									
                                            	<option value="<?= $row->state_id; ?>" <?php if(in_array($row->state_id, $arr_state)){ echo 'disabled';} ?>><?= $row->state ;?></option>
                                            <?php 
											}
											?>
                                        </select> 
                                        &nbsp;	<input type="text" class="text2 shpng" name="local_amt" id="local_amt"> [INR] &nbsp;
                                        <input type="button" id="local_spng_fee_btn" onClick="get_local_shipping_fee()" name="save"  class="btn btn-warning" value="Save" />&nbsp;&nbsp;&nbsp;<span class="show_msg"></span>
									</td>
								</tr>
								<tr class="default_tr">
									<td style="width:20%;">National Shipping Amount</td>
									<td><input type="text" class="text2 shpng" name="national_fees" id="national_fees" > [INR] &nbsp;<input type="button" id="national_shpng_btn" onClick="get_national_shipping_fee()" name="save" class="btn btn-warning" value="Save" />&nbsp;&nbsp;&nbsp;<span class="show_msg1"></span></td>
								</tr>
                                <tr class="flat_tr">
									<td style="width:20%;">Flat Shipping Amount</td>
									<td><input type="text" class="text2 shpng" name="flat_fees" id="flat_fees"> [INR] &nbsp;<input type="button" id="flat_shpng_btn" name="save" onClick="get_flat_shipping_fee()" class="btn btn-warning" value="Save" />&nbsp;&nbsp;&nbsp;<span class="show_msg2"></span></td>
								</tr>
							</table>
                            </div>
                          </form>
                          <div class="clearfix"> </div>
                          <!-- @end #right-content -->
                          
        <div class="grid_dv">
        <?php if($ship_type == 'default' || $ship_type == 'null'){ ?>
        	<div class="default_result_dv">
        <?php
		$national_shipment_row = $national_shipping_result->num_rows();
		if($national_shipment_row > 0){
			$nfee_result = $national_shipping_result->result();
			$national_shipping_fee = $nfee_result[0]->amount;
		}else{
			$national_shipping_fee = 0;
		}
		?>
        	<div class="ntfee">
            	National shipping fee : <span id="national_span"><strong><?= $national_shipping_fee; ?></strong>&nbsp;&nbsp;&nbsp;
                <span class="edt">Edit</span></span>
                <span class="fld_spn">
                <input type="text" class="text2 shpng" value="<?= $national_shipping_fee; ?>" name="national_fee_update_fld" id="national_fee_update_fld">
                <input type="button" id="national_fee_update_btn" name="save" class="btn btn-warning" value="Update" onClick="update_national_shippment_fee()"/>&nbsp;&nbsp;<span class="canc">Cancel</span>
                </span>
            </div><hr>
        	<h4>Local shipping fee details</h4>
        	<table class="table table-bordered table-hover">
            	<tr class="table_th">
                	<th>Sl No.</th>
                	<th>State</th>
                    <th>Amount</th>
                    <th>Shipping Type</th>
                    <th>Action</th>
                </tr>
                <?php
				$sl = 0;
				$shipment_row = $shipment_result->num_rows();
				if($shipment_row > 0){
					foreach($shipment_result->result() as $shippment_val){
						$sl++;
				?>
                <tr>
                	<td><?= $sl; ?></td>
                    <td><?= $shippment_val->state; ?></td>
                    <td>
                    	<span id="amt_spn<?=$sl;?>"><?= $shippment_val->amount; ?></span>
                    	<input type="text" value="<?= $shippment_val->amount; ?>" class="text2 shpngd" id="l_amt_fld<?=$sl; ?>">
                    </td>
                    <td><?= $shippment_val->type; ?></td>
                    <td><span class="edt1" id="upde<?=$sl; ?>" onClick="change_to_edit_mode(<?=$sl; ?>)">Edit</span><input type="button" id="sav<?=$sl;?>" name="save" class="btn-warning lsav" value="Update" onClick="updateLocalShipment_amt(<?= $shippment_val->shipment_id; ?>,<?=$sl; ?>)"/>&nbsp;&nbsp;<span class="canc1" id="cancl_edt<?=$sl; ?>" onClick="cancelEditmode(<?=$sl; ?>)">Cancel</span></td>
                </tr>
                <?php } }else{ ?>
                <tr>
                	<td colspan="5">No Record Found.</td>
                </tr>
                <?php }?>
            </table>
            </div> <!--- End of default div --->
            <?php } // End of default condition ?>
            <?php if($ship_type == 'flat'){ ?>
            <div class="flat_result_dv">
            	<?php
				$flat_shippment_row = $flat_shippment_result->num_rows();
				if($flat_shippment_row > 0){
					$flat_result = $flat_shippment_result->result();
					$flat_amount = $flat_result[0]->amount;
				}else{
					$flat_amount = 0;
				}
				?>
            	<table class="table table-bordered">
                	<tr>
                    	<td>Flat Shippment Amount : </td>
                        <td>
                            <span id="flat_amt_spn"><strong><?= $flat_amount; ?></strong></span>
                            <input type="text" value="<?= $flat_amount; ?>" id="input_flat_amt" class="text2 shpng">&nbsp;&nbsp;&nbsp;
                            <input type="button" name="save" id="flat_updt_btn" class="btn-warning lsav1" value="Update" onClick="updateFlatshipping_amt()"/>&nbsp;&nbsp;&nbsp;
                            <span class="canc2" onClick="cancenFlateditmode()">Cancel</span>
                            <span class="edt" id="edt_flt" onClick="editFlatamount()">Edit</span></span>
                        </td>
                    </tr>
                </table>
            </div>
            <?php } // End of flat condition?>
            <?php if($ship_type == 'free'){ ?>
            <div class="free_result_dv">
            	<table class="table table-bordered">
                	<tr>
                    	<td>Your Shippment charges is free.</td>
                    </tr>
                </table>
            </div>
            <?php } //// End of free condition ?>
        </div>
        
      	</div><!-- @end #content -->
			</div><!-- @end #content -->
                
<script>
$(document).ready(function(){
	$('.flat_tr').hide();
	$("input:radio[name=shipping_type]").click(function(){
    	var val = $(this).val();
		if(val == 'default'){
			var m = confirm('Are you sure to change the shipment setting ?');
			if(m){
				$('.default_result_dv').show();
				$('.default_tr').show();
				$('.flat_tr').hide();
				
				$.ajax({
				  url:'<?php echo base_url(); ?>admin/shipment/update_shipping_type',
				  method:'post',
				  data:{type:'default'},
				  success:function(result)
				  {
					if(result == 'success'){
						window.location.reload(true);
					}
				 }
			 });
				
			}else{
				return false;
			}
		}
		else if(val == 'flat'){
			var m = confirm('Are you sure to change the shipment setting ?');
			if(m){
				$('.default_result_dv').hide();
				$('.default_tr').hide();
				$('.flat_tr').show();
				
				$.ajax({
				  url:'<?php echo base_url(); ?>admin/shipment/update_shipping_type',
				  method:'post',
				  data:{type:'flat'},
				  success:function(result)
				  {
					if(result == 'success'){
						window.location.reload(true);
					}
				 }
			 });
				
				
			}else{
				return false;
			}
		}
		else if(val == 'free'){
			var m = confirm('Are you sure to set the shipping amount is free ?');
			if(m){
				$('.default_tr').hide();
				$('.flat_tr').hide();
				$('.default_result_dv').hide();
				
				$.ajax({
				  url:'<?php echo base_url(); ?>admin/shipment/get_shipping_fee',
				  method:'post',
				  data:{flag:4},
				  success:function(result)
				  {
					if(result == 'success'){
						$('.show_msg3').show();
						$(".show_msg3").html('successfully saved.');
						setTimeout(function() { location.reload() },1000);
					}
				 }
			 });
				  
			}else{
				return false;
			}
		}
	});
});

/////////local shipping charges script start here//////////
function get_local_shipping_fee(){
	var state = $('#state').val();
	var amount = $('#local_amt').val();
	if(state == ''){
		alert('Please select the state.');
		return false;
	}else if(amount == ''){
		alert('Please enter the amount.');
		$('#local_amt').focus();
		return false;
	}else if(isNaN(amount)){
		alert('Please enter a valid amount.');
		$('#local_amt').select();
		return false;
	}else{
		
		$('#local_spng_fee_btn').val('wait..');
		$.ajax({
			  url:'<?php echo base_url(); ?>admin/shipment/get_shipping_fee',
			  method:'post',
			  data:{state:state,amount:amount,flag:1},
			  success:function(result)
			  {
				if(result == 'success'){
					$('.show_msg').show();
					$(".show_msg").html('successfully saved.');
					//$('#local_spng_fee_btn').val('Save');
					setTimeout(function() { location.reload() },1000);
				}
			 }
		 });
		
	}
}
/////////local shipping charges script end here//////////

/////////national shipping charges script start here/////////
function get_national_shipping_fee(){
	var amount = $('#national_fees').val();
	if(amount == ''){
		alert('Please enter the amount.');
		$('#national_fees').focus();
		return false;
	}else if(isNaN(amount)){
		alert('Please enter a valid amount.');
		$('#national_fees').select();
		return false;
	}else{
		
		$('#national_shpng_btn').val('wait..');
		$.ajax({
			  url:'<?php echo base_url(); ?>admin/shipment/get_shipping_fee',
			  method:'post',
			  data:{amount:amount,flag:2},
			  success:function(result)
			  {
				if(result == 'success'){
					$('.show_msg1').show();
					$(".show_msg1").html('successfully saved.');
					$('#national_shpng_btn').val('Save');
					//setTimeout(function() { location.reload() },1500);
				}
				if(result === 'already exits'){
					$('.show_msg1').show();
					$(".show_msg1").css('color','red');
					$('#national_fees').val('');
					$(".show_msg1").html('National shipping fee is already exists, now you can edit it only.');
					$('#national_shpng_btn').val('Save');
					
				}
			 }
		 });
		
	}
}
/////////national shipping charges script end here//////////

/////////flat shipping charges script start here//////////
function get_flat_shipping_fee(){
	var amount = $('#flat_fees').val();
	if(amount == ''){
		alert('Please enter the amount.');
		$('#flat_fees').focus();
		return false;
	}else if(isNaN(amount)){
		alert('Please enter a valid amount.');
		$('#flat_fees').select();
		return false;
	}else{
		
		$('#flat_shpng_btn').val('wait..');
		$.ajax({
			  url:'<?php echo base_url(); ?>admin/shipment/get_shipping_fee',
			  method:'post',
			  data:{amount:amount,flag:3},
			  success:function(result)
			  {
				if(result == 'success'){
					$('.show_msg2').show();
					$(".show_msg2").html('successfully saved.');
					//$('#flat_shpng_btn').val('Save');
					setTimeout(function() { location.reload() },1000);
				}
			 }
		 });
		
	}
}
/////////flat shipping charges script end here//////////

///////update nation shippment fee script start here///////
$(document).ready(function(){
	$('.edt').click(function(){
		$('#national_span').hide();		
		$('.fld_spn').show();
		$('#national_fee_update_fld').select();
	});
});


function update_national_shippment_fee(){
	var national_shipping_fee = $('#national_fee_update_fld').val();
	if(national_shipping_fee == ''){
		alert('Please enter national shippment amount.');
		$('#national_fee_update_fld').focus();
		return false;
	}else if(isNaN(national_shipping_fee)){
		alert('Please enter a valid amount.');
		$('#national_fee_update_fld').select();
		return false;
	}else{
		
		$('#national_fee_update_btn').val('wait..');
		$.ajax({
			  url:'<?php echo base_url(); ?>admin/shipment/update_national_shipping_fee',
			  method:'post',
			  data:{amount:national_shipping_fee},
			  success:function(result)
			  {
				// $('#q').html(result);
				if(result == 'success'){
					window.location.reload(true);
				}
			 }
		 });
		
	}
}

///////update nation shippment fee script start here///////

$(document).ready(function(){
	$('.canc').click(function(){
		$('.fld_spn').hide();
		$('#national_span').show();		
	})
});
</script>

<script>
function change_to_edit_mode(sl){
	var input_id = '#l_amt_fld'+sl;
	var spn = '#amt_spn'+sl;
	var edit_link = '#upde'+sl;
	var updt_btn = '#sav'+sl;
	var cancel_edt = '#cancl_edt'+sl;
	$(spn).hide();
	$(edit_link).hide();
	$(updt_btn).show();
	$(input_id).show();
	$(cancel_edt).show();
	$(input_id).select();
}

function updateLocalShipment_amt(shippment_id,sl){
	var input_id = '#l_amt_fld'+sl;
	var amount = $(input_id).val();
	var updt_btn = '#sav'+sl;
	if(amount == ''){
		alert('Please enter shippment amount.');
		$(input_id).focus();
		return false;
	}else if(isNaN(amount)){
		alert('Please enter a valid amount.');
		$(input_id).select();
		return false;
	}else{
		
		$(updt_btn).val('wait..');
		$.ajax({
			  url:'<?php echo base_url(); ?>admin/shipment/update_local_shipping_fee',
			  method:'post',
			  data:{id:shippment_id,amount:amount},
			  success:function(result)
			  {
				if(result == 'success'){
					window.location.reload(true);
				}
			 }
		 });
		
	}
	
}

function cancelEditmode(sl){
	var input_id = '#l_amt_fld'+sl;
	var spn = '#amt_spn'+sl;
	var edit_link = '#upde'+sl;
	var updt_btn = '#sav'+sl;
	var cancel_edit = '#cancl_edt'+sl;
	$(input_id).hide();
	$(updt_btn).hide();
	$(cancel_edit).hide();
	$(edit_link).show();
	$(spn).show();
}

function editFlatamount(){
	$('#flat_amt_spn').hide();
	$('#edt_flt').hide();
	$('#input_flat_amt').show();
	$('.lsav1').show();
	$('.canc2').show();
	$('#input_flat_amt').select();
}

function cancenFlateditmode(){
	$('#input_flat_amt').hide();
	$('.lsav1').hide();
	$('.canc2').hide();
	$('#flat_amt_spn').show();
	$('#edt_flt').show();
}

function updateFlatshipping_amt(){
	var flat_amount = $('#input_flat_amt').val();
	if(flat_amount == ''){
		alert('Please enter flat shippment amount.');
		$('#input_flat_amt').focus();
		return false;
	}else if(isNaN(flat_amount)){
		alert('Please enter a valid amount.');
		$('#input_flat_amt').select();
		return false;
	}else{
		
		$('#flat_updt_btn').val('wait..');
		$.ajax({
			  url:'<?php echo base_url(); ?>admin/shipment/update_flat_shipping_fee',
			  method:'post',
			  data:{amount:flat_amount},
			  success:function(result)
			  {
				if(result == 'success'){
					window.location.reload(true);
				}
			 }
		 });
		
	}
	
}
</script>              


	</body>
</html>               