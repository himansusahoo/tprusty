<?php
require_once('header.php');
?>			
			<div id="content">    
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_config.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
                	<?php
					$attributes = array('onSubmit' => 'return chargesinfo()');
					echo form_open('admin/super_admin/get_membership_data', $attributes);
					?>
                	<!--<form onSubmit="return membershipInfo()">-->
					<div class="row content-header">
						<div class="col-md-8"><b>Charges</b><div id="ssmessg"><?= $this->session->flashdata('succss_msg'); ?></div></div>
						<div class="col-md-4 show_report">
							<button type="reset" class="all_buttons">Reset</button>
							<button type="submit" class="all_buttons">Save</button>
						</div>
					</div>
					<div class="form_view">
						<h3>Set Charges</h3>
							<table>
								<tr>
									<td style="width:20%;"> Fixed Charges <!--<sup>*</sup>--> </td>
									<td>
                                    	Amount : <input type="text" class="text2 chg" name="amt_fixedcharges" id="amt_fixedcharges">&nbsp;&nbsp;
                                        Persent : <input type="text" class="text2 chg" name="per_fixedcharges" id="per_fixedcharges">&nbsp;%
                                    </td>
								</tr>
								<tr>
									<td> Payment gateway Charges </td>
									<td><input type="text" class="text2 chg" name="pgcharges" id="pgcharges">&nbsp;%</td>
								</tr>
							</table>
					</div>
                    <?php echo form_close(); ?>
				</div><!--   End of Main-content  -->
		</div><!-- @end #content -->
        
<script>
function chargesinfo(){
	var charges = $('#fixedcharges').val();
	var pgcharges = $('#pgcharges').val();
	return false;
	/*var mdesc = $('#mdesc').val();
	var memb_pln_typ = $('#memb_pln_typ').val();
	if(name == ''){
		alert('Membership name is required.');
		$('#mname').focus();
		return false;
	}else if(cost == ''){
		alert('Membership cost is required.');
		$('#mcost').focus();
		return false;
	}else if(isNaN(cost)){
		alert('Invalid cost amount');
		$('#mcost').select();
		return false;
	}else if(memb_pln_typ == ''){
		alert('Membership plan type is required.');
		return false;
	}*/
}
</script>
<?php
require_once('footer.php');
?>	