<?php
require_once('header.php');
?>
			<div id="content">    
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_catalog.php'; ?>
					</div>
										
					<!-- header_session included here -->
					<?php
					require_once('header_session.php');
					?>
				</div>  <!-- @end top-bar  -->
				<!-- 31 <?php
				$seller_signup_id = $this->session->userdata('seller-signup-session');
				if(!$seller_signup_id) : 
				?>
					<div style="padding-top:60px; margin:0px 50px;">
						<div class="alert alert-danger" role="alert"> *Important ! You have not completed signup. To complete click <a href="<?php echo base_url();?>seller/seller/incomplete_signup"><strong>here</strong></a></div>
					</div>
				<?php
				endif;
				?>-->
				<div class="main-content">
					<?php require_once('common.php');  ?>
					<div class="page_header mb10">
						<div class="left">
							<h3>Shipment Configuration</h3>
						</div>
						<div class="clear"></div>
					</div>
					<div class="form_view">
						<h3>Create New Shipment Fees Settings</h3>
						<table>
							<tr>
								<td width="30%"> Choose Shipment Type : </td>
								<td width="70%">
								<?php
								$shprow = $shippment_type_result->num_rows();
								if($shprow > 0){
									$ship_result = $shippment_type_result->result();
									$ship_type = $ship_result[0]->type;
								?>
									<input type="radio" name="shippingfee" id="default" value="default" <?php if($ship_type == 'default'){ echo 'checked';} ?>/> Default &nbsp;&nbsp;
									<input type="radio" name="shippingfee" id="flat" value="free" <?php if($ship_type == 'free'){ echo 'checked';} ?>/> Free &nbsp;&nbsp;
									<input type="radio" name="shippingfee" id="free" value="flat" <?php if($ship_type == 'flat'){ echo 'checked';} ?>/> Flat    <span class="show_msg3"></span>
								<?php 
								}else{ 
									$ship_type = 'null';
								?>
									<input type="radio" name="shippingfee" id="default" value="default" checked> Default &nbsp;&nbsp;
									<input type="radio" name="shippingfee" id="flat" value="free"> Free &nbsp;&nbsp;
									<input type="radio" name="shippingfee" id="free" value="flat"> Flat    <span class="show_msg3"></span>
								 <?php } ?>
								</td>
							</tr>
							<tr class="default_tr">
								<td> Local Shipping Amount : </td>
								<td>
									<?php
										$seller_shipment_state_row = $seller_state->num_rows();
										if($seller_shipment_state_row > 0){
											foreach($seller_state->result() as $state_id_row){
												$arr_state[] = $state_id_row->state_id;
											}
										}else{
											$arr_state[] = '';
										}
									?>
									<select class="seller_input" name="state" id="state">
										<option value="">--Select State--</option>
										<?php foreach($result as $row): ?>	
											<option value="<?=$row->state_id?>" <?php if(in_array($row->state_id, $arr_state)){ echo 'disabled';} ?>><?= $row->state ;?></option>
										<?php 
										endforeach;
										?>
									</select>
									<input type="text" class="seller_input" name="local_fee" id="local_fee">[INR]
									<button class="seller_buttons" id="local_shippment_btn" onclick="get_local_shippng_fee()">ADD</button> <span class="show_msg"></span>
								</td>
							</tr>
							<tr class="default_tr">	
								<td> National Shipping Amount : </td>
								<td>
									<input type="text" class="seller_input" name="national_fee" id="national_fees">[INR]
									<button class="seller_buttons" id="national_shipment_btn" onclick="get_national_shipping_fee()">ADD</button>  <span class="show_msg1">
								</td>
							</tr>
							<tr class="flat_tr">
								<td>Flat Shipping Amount : </td>
								<td>
									<input type="text" class="text dt" name="flat_shipng_fee" id="flat_fees">[INR]
									<button class="seller_buttons" id="flat_shipment_btn" onclick="get_flat_shipping_fee()">ADD</button>   <span class="show_msg2"></span>
								</td>
							</tr>
						</table>	
					</div>
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
								National Shipping Fee : 
								<span id="national_span">
									<strong><?= $national_shipping_fee; ?></strong>&nbsp;&nbsp;&nbsp;
									<span class="edt">Edit</span>
								</span>
								<span class="fld_spn">
									<input type="text" class="text2 shpng" value="<?= $national_shipping_fee; ?>" name="national_fee_update_fld" id="national_fee_update_fld">
									<input type="button" id="national_fee_update_btn" name="save" class="seller_buttons" value="Update" onClick="update_national_shippment_fee()"/>&nbsp;&nbsp;<span class="canc">Cancel</span>
								</span>						
							</div>						
							<hr>
							<h4>Local Shipping Fee Details : </h4>
							<table class="table table-bordered table-hover">
								<tr style="background-color:#6f8992; color:#fff;">
									<th width="10%">Sl No</th>
									<th width="20%">State</th>
									<th width="20%">Shipping Type</th>
									<th width="20%">Amount</th>
									<th width="30%">Action</th>
								</tr>
<?php
$sl = 0;
$shipment_row = $local_shipment_result->num_rows();
if($shipment_row > 0){
	foreach($local_shipment_result->result() as $shippment_val){
		$sl++;
?>
								<tr>
									<td><?= $sl; ?></td>
									<td><?= $shippment_val->state; ?></td>
									<td><?= $shippment_val->type; ?></td>
									<td>
										<span id="amt_spn<?=$sl;?>"><?= $shippment_val->amount; ?></span>
										<input type="text" value="<?= $shippment_val->amount; ?>" class="text2 shpngd" id="l_amt_fld<?=$sl; ?>">
									</td>
									<td><span class="edt1" id="upde<?=$sl; ?>" onClick="change_to_edit_mode(<?=$sl?>)">Edit</span><input type="button" id="sav<?=$sl;?>" name="save" class="seller_buttons lsav" value="Update" onClick="updateLocalShipment_amt(<?= $shippment_val->shipment_id; ?>,<?=$sl; ?>)"/>&nbsp;&nbsp;<span class="canc1" id="cancl_edt<?=$sl; ?>" onClick="cancelEditmode(<?=$sl?>)">Cancel</span></td>
								</tr>
<?php } }else{ ?>
								<tr>
									<td class="a-center" colspan="5">No Record Found.</td>
								</tr>
<?php }?>
							</table>
						</div>
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
					</div>
				</div>
			</div><!-- @end #content -->
			
<script>
	$(document).ready(function(){
		$('.flat_tr').hide();
		$("input:radio[name=shippingfee]").click(function(){
			var val = $(this).val();
			if(val == 'default'){
				$('.default_result_dv').show();
				$('.default_tr').show();
				$('.flat_tr').hide();
			}
			else if(val == 'flat'){
				$('.default_result_dv').hide();
				$('.default_tr').hide();
				$('.flat_tr').show();
			}else if(val == 'free'){
				var m = confirm('Are you sure to set the shipping amount is free ?');
				if(m){
					$('.default_tr').hide();
					$('.flat_tr').hide();
					$('.default_result_dv').hide();
					
					$.ajax({
					  url:'<?php echo base_url(); ?>seller/seller_shipment/add_shipping_fee',
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
	
	// Local Shipping fee 
	function get_local_shippng_fee(){
		var state = $('#state').val();
		var amount = $('#local_fee').val();
		if(state == ''){
			alert('Please select the state.');
			return false;
		}else if(amount == ''){
			alert('Please enter the amount.');
			$('#local_fee').focus();
			return false;
		}else if(isNaN(amount)){
			alert('Please enter a valid amount.');
			$('#local_fee').select();
			return false;
		}else{ 
			$('#local_shippment_btn').val('wait..');
			$.ajax({
				url:'<?php echo base_url(); ?>seller/seller_shipment/add_shipping_fee',
				method:'post',
				data:{state:state, amount:amount, flag:1},
				success:function(result){
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
	
	// National shipping fee
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
			
			$('#national_shipment_btn').val('wait..');
			$.ajax({
				url:'<?php echo base_url(); ?>seller/seller_shipment/add_shipping_fee',
				method:'post',
				data:{amount:amount,flag:2},
				success:function(result){
					if(result == 'success'){
						$('.show_msg1').show();
						$(".show_msg1").html('successfully saved.');
						$('#national_shipment_btn').val('Save');
						setTimeout(function() { location.reload() },1500);
					}
					if(result === 'already exits'){
						$('.show_msg1').show();
						$(".show_msg1").css('color','red');
						$('#national_fees').val('');
						$(".show_msg1").html('National shipping fee is already exists, now you can edit it only.');
						$('#national_shipment_btn').val('Save');
						
					}
				}
			});
		}
	}
	
	// Flat shipping fee
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
			
			$('#flat_shipment_btn').val('wait..');
			$.ajax({
				url:'<?php echo base_url(); ?>seller/seller_shipment/add_shipping_fee',
				method:'post',
				data:{amount:amount,flag:3},
				success:function(result){
					if(result == 'success'){
						$('.show_msg2').show();
						$(".show_msg2").html('successfully saved.');
						//$('#flat_shipment_btn').val('Save');
						setTimeout(function() { location.reload() },1000);
					}
				}
			});
		}
	}
	
	
	// Update National fee
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
				url:'<?php echo base_url(); ?>seller/seller_shipment/update_national_shipping_fee',
				method:'post',
				data:{amount:national_shipping_fee},
				success:function(result){
					if(result == 'success'){
						window.location.reload(true);
					}
				}
			});
		}
	}
	
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
				  url:'<?php echo base_url(); ?>seller/seller_shipment/update_local_shipping_fee',
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
		var input_id = '#l_amt_fld'+sl; alert(input_id); return false;
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
				url:'<?php echo base_url(); ?>seller/seller_shipment/update_flat_shipping_fee',
				method:'post',
				data:{amount:flat_amount},
				success:function(result){
					if(result == 'success'){
						window.location.reload(true);
					}
				}
			});
		}
	}
	
	
</script>


<?php
require_once('footer.php');
?>