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
					$attributes = array('onSubmit' => 'return membershipInfo()');
					echo form_open('admin/super_admin/get_membership_data', $attributes);
					?>
                	<!--<form onSubmit="return membershipInfo()">-->
					<div class="row content-header">
						<div class="col-md-8"><b>Add Membership</b><div id="ssmessg"><?= $this->session->flashdata('succss_msg'); ?></div></div>
						<div class="col-md-4 show_report">
							<button type="reset" class="all_buttons">Reset</button>
							<button type="submit" class="all_buttons">Save</button>
						</div>
					</div>
					<div class="form_view">
						<h3>Add Membership Information</h3>
							<table>
								<tr>
									<td style="width:20%;"> Membership Name <sup>*</sup> </td>
									<td><input type="text" class="text2" name="mname" id="mname"></td>
								</tr>
								<tr>
									<td> Membership Cost <sup>*</sup> </td>
									<td><input type="text" class="text2" name="mcost" id="mcost"></td>
								</tr>
								<tr>
									<td> Description </td>
									<td><textarea name="mdesc" class="text2" id="mdesc"></textarea></td>
								</tr>
								<tr>
									<td> Membership Plan type <sup>*</sup> </td>
									<td>
                                    	<select name="memb_pln_typ" id="memb_pln_typ" class="text2">
                                        	<option value="">---select---</option>
                                        	<option value="Monthly">Monthly</option>
                                            <option value="Yearly">Yearly</option>
                                        </select>
                                    </td>
								</tr>
							</table>
					</div>
                    <?php echo form_close(); ?>
				</div><!--   End of Main-content  -->
		</div><!-- @end #content -->
        
<script>
function membershipInfo(){
	var name = $('#mname').val();
	var cost = $('#mcost').val();
	var mdesc = $('#mdesc').val();
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
	}
}
</script>
<?php
require_once('footer.php');
?>	