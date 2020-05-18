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
                    	<h3 style="text-align:center;">Edit Special Commission</h3>
                        <div class="col-md-10">
                        <?php
						foreach($spl_commission_result as $spl_commission_date_row){
							if($spl_commission_date_row->from_date == '' && $spl_commission_date_row->to_date == ''){
								continue;
							}else{
								$from_date = $spl_commission_date_row->from_date;
								$to_date = $spl_commission_date_row->to_date;
								break;
							}
						}
						//echo $from_date.' , '.$to_date;exit;
						?>
                        	<table>
                            	<tr>
                                	<td colspan="2"><b>Choose Date Range : </b></td>
                                </tr>
                                <tr>
                                	<td width="30%">From Date: <input tabindex="text" disabled value="<?=$from_date;?>" name="frm_date" class="text2 dt" id="datepicker-example7-start"></td>
                                    <td width="30%">To Date: <input tabindex="text" disabled value="<?=$to_date;?>" name="to_date" class="text2 dt" id="datepicker-example7-end"></td>
                                    <td width="40%">
                                    <?php
									//program for retrieve seller id from special commission table start here//
									foreach($spl_commission_result as $spl_comsn_rw){
										$seller_ids[] = unserialize($spl_comsn_rw->seller_id);
									}
									//print_r($seller_ids);exit;
									
									$slr_id_arr = array();
									foreach($seller_ids as $k => $v){
										if($v == ''){
											continue;
										}else{
											array_push($slr_id_arr,$v);
										}
									}
									//print_r($slr_id_arr);exit;
									
									$id_arr = array();
									foreach($slr_id_arr as $key => $val){
										foreach($val as $ky => $vl){
											array_push($id_arr,$vl);
										}
									}
									//print_r($id_arr);exit;
									$final_slr_ad_arr = array_unique($id_arr);
									//program for retrieve seller id from special commission table start here//
									?>
                                    
                                    	<b>Choose Seller Name : </b>
                                        <select name="seller_name" id="seller_name" data-placeholder="Choose Sellers" class="chosen-select" multiple tabindex="4">
                                            <?php foreach($seller_result as $seller_row){ ?>
                                            
                                            <option value="<?=$seller_row->seller_id;?>" <?php if(in_array($seller_row->seller_id,$final_slr_ad_arr)){ echo 'selected';} ?>><?=$seller_row->business_name;?></option>
                                         
                                            <?php }?>
                                        </select>
                                    </td>
                                </tr>
                               <!-- <tr>
                                	<td colspan="3" align="center"><input type="button" onClick="return ValidateSpecialCommission()" value="submit" class="btn-warning lsav3"></td>
                                </tr>-->
                            </table>
                         </div>
                         <div class="col-md-2"></div>
                         <div class="clearfix"></div>
                         
                         <div id="load_special_comission">
                         	<h4 style="margin-left:50px;">Commission by product category</h4>
                            <table class="table-bordered table-hover commission_tbl" align="center" style=" width:100%; margin:0px;">
                                <tr class="commision_tr_hed">
                                    <th> &nbsp;Product category</th>
                                    <th> &nbsp;Seller Commission</th>
                                    <th> &nbsp;Action</th>
                                </tr>
                                <?php
                                $sl=0;
                                foreach($spl_commission_result as $cat_row){
                                    $sl++;
                                ?>
                                <tr>
                                    <td>
									<span class="first_cat">
									<?php
                                    $sql = $this->db->query("SELECT category_name,category_id FROM category_indexing 
                                    WHERE category_id=(SELECT parent_id FROM category_indexing WHERE category_id='$cat_row->parent_id')");
                                    $row = $sql->row();
                                    echo $row->category_name;
                                    ?>
                                    <span class="thrd_cart"><?=$cat_row->category_name;?></span>
                                    </span>
									
									<!--<?//=$cat_row->category_name;?>-->
                                    </td>
                                    <td>
                                        <input type="text" class="text2" name="spl_commission" id="spl_commission<?=$sl;?>" value="<?=$cat_row->commision;?>">
                                        <img src="<?php echo base_url();?>images/progress.gif" class="comsn_loader" id="loder<?=$sl;?>">
                                        <img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader" id="loder_complt<?=$sl;?>">
                                        <img src="<?php echo base_url();?>images/error.png" class="comsn_loader" id="loder_fail<?=$sl;?>">	
                                    </td>
                                    <td>
                                        <span class="edt" id="sav1_spn<?=$sl;?>" onclick="UpdateSpecialCommission(<?=$cat_row->category_id;?>,<?=$sl;?>)">Update</span>
                                        <span class="edt edt_sv" id="sav2_spn<?=$sl;?>">Update</span>
                                   </td>
                                </tr>
                                <?php } ?>
                                 <tr>
                            </table>
                         </div>
                         
                    </div>
                    <?php echo form_close(); ?>
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

/*function ValidateSpecialCommission(){
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
		  $.ajax({
		  url:'<?php// echo base_url();?>admin/super_admin/load_special_commission',
		  method:'post',
		  data:{slr_id:seller_id,from_dt:from_dt,to_dt:to_dt},
		  success:function(result){
			  	if(result == 'not'){
					alert('Special commission already added during this date range.');
					return false;
				}else{
			 		$('#load_special_comission').html(result);
				}
		  }
	  	});
	}
}*/

/*update special commission start here*/
function UpdateSpecialCommission(cat_id,sl){
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
			url:'<?php echo base_url();?>admin/super_admin/update_special_commission',
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
					  $('#loder_fail'+sl).hide();
					}, 1000);
				}
			}
		});
	}
}
/*update special commission end here*/

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