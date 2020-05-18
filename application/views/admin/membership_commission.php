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
                                    	<select name="commssion_typ" id="commssion_typ" class="text2" onChange="ShowCommissionFunction(this.value)">
                                        	<option value="">--- select ---</option>
                                        	<option value="1">Global Commission</option>
                                            <option value="2" selected>Membership Commission</option>
                                            <option value="3">Special Commission</option>
                                        </select>
                                    </td>
                                    <td></td>
								</tr>
							</table>
					</div>
                    <div class="commission_form">
                    	<h3 style="text-align:center;">Membership Commission</h3>
                        <div class="col-md-5">
                        	<span><b>Choose Membership Plan : </b></span>
                            <span>
                            	<select name="membershp_pln" id="membershp_pln" class="text2" onChange="shomembershpPlnCommisn(this.value)">
                                    <option value="">--- select ---</option>
                                    <?php foreach($membership_plan_result as $membership_row){ ?>
                                    <option value="<?=$membership_row->menbshp_column;?>"><?=$membership_row->membrship_name;?></option>
                                    <?php } ?>
                           	 	</select>
                            </span>
                         </div>
                         <div class="col-md-7"></div>
                         <div class="clearfix"></div>
                         
                         <div id="load_mbrshp_pln_comission"><!--- Membership plan loading commission div ---></div>
                         
                    </div>
                    <?php echo form_close(); ?>
                    
                    <div id="cmsn_lodr"><img src="<?php echo base_url();?>images/loading1.gif"></div>
                    
				</div><!--   End of Main-content  -->
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

function shomembershpPlnCommisn(val){
	$('#load_mbrshp_pln_comission').fadeOut();
	$('#cmsn_lodr').fadeIn();
	$('#commssion_typ').attr('disabled',true);
	$('#membershp_pln').attr('disabled',true);
	$.ajax({
		url:'<?php echo base_url();?>admin/super_admin/load_membershp_plan_commission',
		method:'post',
		data:{memb_column:val},
		success:function(result){
			$('#load_mbrshp_pln_comission').html(result);
			$('#load_mbrshp_pln_comission').fadeIn();
			$('#cmsn_lodr').fadeOut();
			$('#commssion_typ').attr('disabled',false);
			$('#membershp_pln').attr('disabled',false);
		}
	});
}


/*update membership commission start here*/
function InserUpdateMembershipCommission(cat_id,sl){
	var memb_fld_name = $('#membershp_pln').val();
	var memb_commission = $('#memb_commission'+sl).val();
	if(memb_commission == ''){
		alert('Please enter commission amount.');
		$('#memb_commission'+sl).focus();
		return false;
	}else if(isNaN(memb_commission)){
		alert('Please enter a valid amount.');
		$('#memb_commission'+sl).select();
		return false;
	}else{
		$('#loder_fail'+sl).hide();
		$('#loder_complt'+sl).hide();
		$('#loder'+sl).fadeIn();
		$.ajax({
			url:'<?php echo base_url();?>admin/super_admin/insert_update_membership_commission',
			method:'post',
			data:{category_id:cat_id,field_name:memb_fld_name,memb_comision:memb_commission},
			success:function(result){
				if(result == 'success'){
					$('#loder'+sl).hide();
					$('#loder_complt'+sl).show();
				}
				if(result == 'not'){
					$('#loder'+sl).hide();
					$('#loder_fail'+sl).show();
				}
			}
		});
	}
}
/*update membership commission end here*/
</script>
<?php
require_once('footer.php');
?>	