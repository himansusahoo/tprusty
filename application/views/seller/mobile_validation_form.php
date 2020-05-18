<link rel="stylesheet" href="<?php echo base_url();?>css/admin/colorbox.css" />
<script src="<?php echo base_url();?>js/jquery.colorbox.js"></script>
<script>
	$(document).ready(function(){
		$(".inline").colorbox({inline:true, width:"50%"});
	});
</script>

<div class="mobile_verification">
	<h4><b>Mobile number verification</b></h4>
	<!--<form>-->
		<table>
			<tr>
				<td width="20%"> Your mobile number* </td>
				<td width="25%">
					<input type="text" id="mobile" class="seller_input" name="contact_no" value="">
				</td>
				<td width="10%">
					<a class='inline' href="#inline_content">
						<input type="button" id="number_button" onclick="number_verification()" class="seller_buttons" value="Verify">
					</a>
				</td>
				<td width="25%" id="successfully_verify">Verify your mobile number to continue</td>
			</tr>
		</table>
	<!--</form>-->
</div>