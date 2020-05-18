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
			echo form_open_multipart('admin/sellers/save_new_sellerbadge');
?>
						<table>
							<tr>
								<td style="width:20%;">Seller <sup>*</sup>: </td>
								<td style="width:40%;">
									<select class="text2" name="seller_list" id="seller_id">
										<option value="">--Select Seller--</option>
										<?php 
											if($seller_list){ 
												foreach($seller_list as $row):
										?>
										<option value="<?=$row->seller_id?>"><?=$row->business_name?></option>
										<?php
												endforeach;
											}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>From Date <sup>*</sup>: </td>
								<td><input class="text2 dt" name="from_date" id="datepicker-example16-start"></td>
							</tr>
							<tr>
								<td>To Date <sup>*</sup>: </td>
								<td><input class="text2 dt" name="to_date" id="datepicker-example16-end"></td>
							</tr>
							<tr>
								<td>Type <sup>*</sup>: </td>
								<td>
									<input type="checkbox" name="seller_type[]" value="Fast Shipping">&nbsp;Fast Shipping&nbsp;&nbsp;&nbsp;
									<input type="checkbox" name="seller_type[]" value="Moonboy Fulfilled">&nbsp;Moonboy Fulfilled&nbsp;&nbsp;&nbsp;
									<input type="checkbox" name="seller_type[]" value="Star Seller">&nbsp;Star Seller&nbsp;&nbsp;&nbsp;
								</td>
							</tr>
							<tr>
								<td colspan="2" class="a-center"><input type="submit" class="" name="submit" value="Submit" onClick="return valid()"></td>
							</tr>
						</table>
						</form>
					</div>
				</div>
			</div>
		</body>
</html>