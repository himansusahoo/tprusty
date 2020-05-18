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

<script src="<?php echo base_url();?>js/chosen.jquery.js"></script>
<script>
  $(function() {
	$('.chosen-select').chosen();
	$('.chosen-select-deselect').chosen({ allow_single_deselect: true });
  });
</script>

<style>
	.Zebra_DatePicker_Icon{left: 383px !important; top: 0px !important;}
	.dt {width: 407px;}
	.Zebra_DatePicker{ z-index:999999 !important;}
</style>


<script>
	function membership(){
		var base_url = "<?php echo base_url(); ?>";
		var controller = "admin/sellers";
		var membership_id = $(".admin_new_form select[name='membership'] option:selected").val(); 
		var seller_id = $("#seller_name").val();
				
		if(membership_id == ""){
			$(".admin_new_form select[name='membership']").css('border-color', 'red');
			$("#error_msg").show().text("Please choose one Membership.");
			return false;
		}else if(seller_id == ""){
			$(".admin_new_form select[name='seller_name']").css('border-color', 'red');
			$("#error_msg").show().text("Please select Seller.");
			$(".admin_new_form select[name='membership']").css('border-color', '#ccc');
			return false;
		}else{
			window.location.href = base_url + controller + '/save_new_membership/'+membership_id+'/'+encodeURIComponent(seller_id) ;
		}
		
	}
	function seller_membership(){
		var base_url = '<?php echo base_url();?>';
		window.location.href = base_url+'admin/sellers/seller_membership';
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
                    	<div class="col-md-8"><b> Seller Membership </b></div>
						
					</div>
                    <div class="clearfix"></div>
					<div class="a-center error_msg" id="error_msg" style="display:none;"></div>
					<div class="form_view">
						<h3>Seller Membership Form </h3>
					</div>
					<div class="admin_new_form">

						<table>
							<tr>
								<td style="width:20%;">Membership <sup>*</sup>: </td>
								<td style="width:40%;">
									<select class="text2" name="membership" id="seller_id">
										<option value="">--Select Membership--</option>
										<?php 
											if($membership_list){ 
												foreach($membership_list as $row):
										?>
										<option value="<?=$row->mbrshp_id?>"><?=$row->membrship_name?></option>
										<?php
												endforeach;
											}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td style="width:20%;">Choose Seller Name : </td>
								<td>
									<select name="seller_name" id="seller_name" data-placeholder="Choose Sellers" class="chosen-select" multiple tabindex="4">
										<?php foreach($sellers_list as $seller_row){ ?>
										<option value="<?=$seller_row->seller_id;?>"><?=$seller_row->business_name;?></option>
										<?php }?>
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="2" class="a-center">
									<input type="submit" class="" name="submit" value="Submit" onClick="membership()">
									<input type="submit" id="edit_icon" name="cancel" value="Cancel" onClick="backtosellermembership()">
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</body>
</html>