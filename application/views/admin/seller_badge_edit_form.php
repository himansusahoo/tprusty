<?php
require_once("header.php");
?>

<!--- Zebra_Datepicker link start here ---->
<link href="<?php echo base_url();?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
<link href="<?php echo base_url();?>Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">
<!--<script src="<?php echo base_url();?>Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script>-->
<script src="<?php echo base_url();?>Zebra_Datepicker-master/examples/public/javascript/core2.js"></script>
<script src="<?php echo base_url();?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<!--- Zebra_Datepicker link end here ---->
<style>
	.Zebra_DatePicker_Icon{left: 383px !important; top: 0px !important;}
	.dt {width: 407px;}
	.Zebra_DatePicker{ z-index:999999 !important;}
</style>
<script>
	function valid(){
		var seller_id = $(".admin_new_form select[name='seller_list'] option:selected").val(); 
		var from_date = $(".admin_new_form input[name='from_date']").val();
		var to_date = $(".admin_new_form input[name='to_date']").val();
		//var type = $(".admin_new_form input[name='seller_type[]']:checked").val(); alert(type);return false;
		// Get Multiple checkbox value
		var type_vals = [];
        $(':checkbox:checked').each(function(i){
          type_vals[i] = $(this).val();
        });
		
		if(seller_id == ""){
			$(".admin_new_form select[name='seller_list']").css('border-color', 'red');
			$("#error_msg").show().text("Please choose one Seller.");
			return false;
		}else if(from_date == ""){
			$(".admin_new_form input[name='from_date']").css('border-color', 'red');
			$("#error_msg").show().text("Please select from date.");
			$(".admin_new_form select[name='seller_list']").css('border-color', '#ccc');
			return false;
		}else if(to_date == ""){
			$(".admin_new_form input[name='to_date']").css('border-color', 'red');
			$("#error_msg").show().text("Please select to date.");
			$(".admin_new_form select[name='seller_list']").css('border-color', '#ccc');
			$(".admin_new_form input[name='from_date']").css('border-color', '#ccc');
			return false;
		}else if(type_vals == ""){
			$("#error_msg").show().text("Please select one type.");
			$(".admin_new_form select[name='seller_list']").css('border-color', '#ccc');
			$(".admin_new_form input[name='from_date']").css('border-color', '#ccc');
			$(".admin_new_form input[name='to_date']").css('border-color', '#ccc');
			return false;
		}else{
			$(".admin_new_form select[name='seller_list']").css('border-color', '#ccc');
			$(".admin_new_form input[name='from_date']").css('border-color', '#ccc');
			$(".admin_new_form input[name='to_date']").css('border-color', '#ccc');
			$("#error_msg").hide();
		}
	}
	function backtosellerbadge(){
		var base_url = '<?php echo base_url();?>';
		window.location.href = base_url+'admin/sellers/seller_badge';
	}
</script>

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
					<div class="row content-header">
                    	<div class="col-md-8"><b> Seller Badge </b></div>
						
					</div>
                    <div class="clearfix"></div>
					<div class="a-center error_msg" id="error_msg" style="display:none;"></div>
					<div class="form_view">
						<h3>Seller Badge Form </h3>
					</div>
					<div class="admin_new_form">
<?php
			echo form_open_multipart('admin/sellers/update_sellerbadge');
?>
							<table>
								<tr>
									<td style="width:20%;">Seller : </td>
									<td style="width:40%;">
										<select class="text2" name="seller_list" id="seller_id" >
											<!--<option value="">--Select Seller--</option>-->
											<?php 
												if($sellers_list){ 
													//foreach($sellers_list as $row):
											?>
											<option value="<?=$seller_badge_details[0]->seller_id?>"  ><?=$seller_badge_details[0]->business_name?></option>
											<?php
													//endforeach;
												}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td>From Date : </td>
									<td>
										<input class="text2" name="from_date" id="datepicker-example7-start" value="<?php echo $seller_badge_details ? $seller_badge_details[0]->from_date : " "; ?>">
										<input type="hidden" name="hidden_id" value="<?=$seller_badge_details[0]->id?>">
									</td>
								</tr>
								<tr>
									<td>To Date : </td>
									<td><input class="text2" name="to_date" id="datepicker-example7-end" value="<?php echo $seller_badge_details ? $seller_badge_details[0]->to_date : " "; ?>"></td>
								</tr>
								<tr>
									<td>Type : </td>
<?php
	$type = explode(',', $seller_badge_details[0]->seller_badge_type);
?>
									<td>
										<input type="checkbox" name="seller_type[]" value="Fast Shipping" <?php if(in_array("Fast Shipping", $type)) {echo "checked";}?> >&nbsp;Fast Shipping&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="seller_type[]" value="Moonboy Fulfilled" <?php if(in_array("Moonboy Fulfilled", $type)) {echo "checked";}?> >&nbsp;Moonboy Fulfilled&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="seller_type[]" value="Star Seller" <?php if(in_array("Star Seller", $type)) {echo "checked";}?> >&nbsp;Star Seller&nbsp;&nbsp;&nbsp;
									</td>
								</tr>
								<tr>
									<td colspan="2" class="a-center">
										<input type="submit" id="edit_icon" name="submit" value="Submit" onClick="return valid()">
										<input type="submit" id="edit_icon" name="cancel" value="Cancel" onClick="backtosellerbadge()">
									</td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>
		</body>
</html>