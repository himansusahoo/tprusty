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
					//$attribute = array('onsubmit' => 'return ValidateSpecialCommission()');
					//echo form_open('admin/super_admin/get_special_commission_data',$attribute);
					echo form_open();
					?>
					<div class="row content-header">
						<div class="col-md-8"><b>Commission Settings <span id="ajxtst"></span></b></div>
						<div class="col-md-4 show_report">
							<!--<button type="reset" class="all_buttons">Reset</button>-->
							<button type="button" onClick="showSpecialGridView()" class="all_buttons">Show Special Commission</button>
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
                                            <option value="3" selected>Special Commission</option>
                                        </select>
                                    </td>
                                    <td></td>
								</tr>
							</table>
					</div>
                    <div class="commission_form">
                    	<h3 style="text-align:center;">Add Special Commission</h3>
                        <div id="ssmessg1"><?= $this->session->flashdata('succss_msg'); ?></div>
                        <div class="col-md-10">
                        	<table>
                            	<tr>
                                	<td colspan="2"><b>Choose Date Range : </b></td>
                                </tr>
                                <tr>
                                	<td width="30%">From Date <sup>*</sup>: <input tabindex="text" name="frm_date" class="text2 dt" id="datepicker-example7-start"></td>
                                    <td width="30%">To Date <sup>*</sup>: <input tabindex="text" name="to_date" class="text2 dt" id="datepicker-example7-end"></td>
                                    <td width="40%">
                                    	<b>Choose Seller Name : </b>
                                        <select name="seller_name" id="seller_name" data-placeholder="Choose Sellers" class="chosen-select" multiple tabindex="4">
                                            <?php foreach($seller_result as $seller_row){ ?>
                                            <option value="<?=$seller_row->seller_id;?>"><?=$seller_row->business_name;?></option>
                                            <?php }?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                	<td colspan="3" align="center"><input type="button" id="spl_btn" onClick="return ValidateSpecialCommission()" value="submit" class="btn-warning lsav3"></td>
                                </tr>
                            </table>
                         </div>
                         <div class="col-md-2"></div>
                         <div class="clearfix"></div>
                         
                         <div id="load_special_comission"><!--- loading special commission div ---></div>
                         
                    </div>
                    <?php echo form_close(); ?>
                    
                    <div id="cmsn_lodr"><img src="<?php echo base_url();?>images/loading1.gif"></div>
                    
				</div><!--   End of Main-content  -->
		</div><!-- @end #content -->

<style>
.dt {width: 150px;}
.Zebra_DatePicker_Icon{left: 130px !important; top: 0px !important;}
.Zebra_DatePicker{ z-index:999999 !important;}
</style>
       
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

function ValidateSpecialCommission(){
	var from_dt = $('#datepicker-example7-start').val();
	var to_dt = $('#datepicker-example7-end').val();
	var seller_id = $('#seller_name').val();
	if(from_dt == ''){
		alert('Please enter from date.');
		$('#datepicker-example7-start').focus();
		return false;
	}
	else if(to_dt == ''){
		alert('Please enter to date.');
		$('#datepicker-example7-end').focus();
		return false;
	}
	else{
		$('#datepicker-example7-start').attr('disabled',true);
		$('#datepicker-example7-end').attr('disabled',true);
		$('#spl_btn').attr('disabled',true);
		
		$('#load_mbrshp_pln_comission').fadeOut();
		$('#cmsn_lodr').fadeIn();
		
		  $.ajax({
		  url:'<?php echo base_url();?>admin/super_admin/load_special_commission',
		  method:'post',
		  data:{slr_id:seller_id,from_dt:from_dt,to_dt:to_dt},
		  success:function(result){
			  	if(result == 'not'){
					alert('Special commission already added during this date range.');
					return false;
				}else{
			 		$('#load_special_comission').html(result);
					$('#load_mbrshp_pln_comission').html(result);
					$('#load_mbrshp_pln_comission').fadeIn();
					$('#cmsn_lodr').fadeOut();
				}
		  }
	  	});
	}
}

/*insert update special commission start here*/
function SaveSpecialCommission(cat_id,sl){
	var from_dt = $('#datepicker-example7-start').val();
	var to_dt = $('#datepicker-example7-end').val();
	var seller_id = $('#seller_name').val();
	var commission = $('#spl_commission'+sl).val();
	if(commission == ''){
		alert('Please enter commission amount.');
		$('#spl_commission'+sl).focus();
		return false;
	}else if(isNaN(commission)){
		alert('Please enter a valid amount.');
		$('#spl_commission'+sl).select();
		return false;
	}else{
		$('#loder_fail'+sl).hide();
		$('#loder_complt'+sl).hide();
		$('#loder'+sl).fadeIn();
		$.ajax({
			url:'<?php echo base_url();?>admin/super_admin/save_special_commission',
			method:'post',
			data:{category_id:cat_id,special_comision:commission,seller_id:seller_id,from_dt:from_dt,to_dt:to_dt},
			success:function(result){
				if(result == 'success'){
					$('#loder'+sl).hide();
					$('#loder_complt'+sl).show();
					$('#spl_commission'+sl).attr('disabled','disabled');
					$('#sav1_spn'+sl).hide();
					$('#sav2_spn'+sl).show();
					setTimeout(function(){
					  $('#loder_complt'+sl).fadeOut();
					}, 1000);
				}
				if(result == 'not'){
					$('#loder'+sl).hide();
					$('#loder_fail'+sl).show();
					setTimeout(function(){
					  $('#loder_fail'+sl).fadeOut();
					}, 1000);
				}
			}
		});
	}
}
/*insert update special commission end here*/

function showSpecialGridView(){
	window.location.href='<?php echo base_url();?>admin/super_admin/special_commission';
}
</script>


<!--- Zebra_Datepicker link start here ---->
<!--<script src="<?php// echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script>-->
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
<!--<link href="<?php// echo base_url(); ?>Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">-->
<!--- Zebra_Datepicker link end here ---->


<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->
<script src="<?php echo base_url();?>js/chosen.jquery.js"></script>
<script>
  $(function() {
	$('.chosen-select').chosen();
	$('.chosen-select-deselect').chosen({ allow_single_deselect: true });
  });
</script>


<?php
require_once('footer.php');
?>