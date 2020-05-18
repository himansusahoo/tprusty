<?php
require_once('header.php');
?>
			
			<div id="content">
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_config.php';?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
                	<?php
					echo form_open();
					?>
                	<!--<form onSubmit="return membershipInfo()">-->
					<div class="row content-header">
						<div class="col-md-8"><b>Commission Settings</b></div>
						<div class="col-md-4 show_report">
							<!--<button type="reset" class="all_buttons">Reset</button>
							<button type="submit" class="all_buttons">Save</button>-->
						</div>
					</div>
					<div class="form_view">
						<h3>Set Seller Commission</h3>
							<table>
								<tr>
									<td width="20%"> Choose Commission Type </td>
									<td width="35%">
                                    	<select name="commssion_typ" class="text2" onChange="ShowCommissionFunction(this.value)">
                                        	<option value="">--- select ---</option>
                                        	<option value="1">Global Commission</option>
                                            <option value="2">Membership Commission</option>
                                            <option value="3">Special Commission</option>
                                        </select>
                                    </td>
                                    <td></td>
								</tr>
							</table>
					</div>
                    <?php echo form_close(); ?>
					
				</div><!-- End of Main-content -->
		</div><!-- @end #content -->
     
<script>
function ShowCommissionFunction(val){
	if(val == 1){
		window.location.href='<?php echo base_url();?>admin/super_admin/global_commission';
	}
	else if(val == 2){
		window.location.href='<?php echo base_url();?>admin/super_admin/membership_commission';
	}
	else if(val == 3){
		window.location.href='<?php echo base_url();?>admin/super_admin/special_commission';
	}
}
</script>
<?php
require_once('footer.php');
?>	