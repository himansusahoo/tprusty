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
                                    	<select name="commssion_typ" class="text2" onChange="ShowCommissionFunction(this.value)">
                                        	<option value="">--- select ---</option>
                                        	<option value="1" selected>Global Commission</option>
                                            <option value="2">Membership Commission</option>
                                            <option value="3">Special Commission</option>
                                        </select>
                                    </td>
                                    <td></td>
								</tr>
							</table>
					</div>
                    <div class="commission_form">
                    	<h3 style="text-align:center;">Global Commission</h3>
                        <h4>Commission by product category</h4>
                        <table class="table-bordered table-hover commission_tbl" align="center" style=" width:100%; margin:0px;">
                        	<tr class="commision_tr_hed">
                            	<th width="50%"> &nbsp;Product category</th>
                                <th> &nbsp;Seller Commission</th>
                                <th>Action</th>
                            </tr>
                            <?php
							$sl=0;
							foreach($category_n_gcomisn_result as $cat_globalcommision_row){
							$sl++;
							?>
                            <tr>
                            	<td>
                                    <span class="first_cat">
                                    <?php
                                   // $sql = $this->db->query("SELECT category_name,category_id FROM category_indexing 
                                   // WHERE category_id=(SELECT parent_id FROM category_indexing WHERE category_id='$cat_globalcommision_row->parent_id')");
									 $sql = $this->db->query("SELECT category_name,category_id FROM category_indexing 
                                    WHERE category_id='$cat_globalcommision_row->parent_id'");
                                    $row = $sql->row();
                                    echo $row->category_name;
                                    ?>
                                    <span class="thrd_cart"><?=$cat_globalcommision_row->category_name;?></span>
                                    </span>
                                </td>
                                <td>
                                	<input type="text" class="text2" name="global_commission" id="global_commission<?=$sl;?>" value="<?=$cat_globalcommision_row->GLOBAL_COMMISSION;?>">
                                    <img src="<?php echo base_url();?>images/progress.gif" class="comsn_loader" id="loder<?=$sl;?>">
           							<img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader" id="loder_complt<?=$sl;?>">
            						<img src="<?php echo base_url();?>images/error.png" class="comsn_loader" id="loder_fail<?=$sl;?>">
                                </td>
                                <td><span class="edt" onClick="InserUpdateGlobalCommission(<?=$cat_globalcommision_row->category_id;?>,<?=$sl;?>)">update</span></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <?php echo form_close(); ?>
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


/*update global commission start here*/
function InserUpdateGlobalCommission(cat_id,sl){
	var commission_val = $('#global_commission'+sl).val();
	if(commission_val == ''){
		alert('Please enter commission amount.');
		$('#global_commission'+sl).focus();
		return false;
	}else if(isNaN(commission_val)){
		alert('Please enter a valid amount.');
		$('#global_commission'+sl).select();
		return false;
	}else{
		$('#loder_fail'+sl).hide();
		$('#loder_complt'+sl).hide();
		$('#loder'+sl).fadeIn();
		$.ajax({
			url:'<?php echo base_url();?>admin/super_admin/insert_update_global_commission',
			method:'post',
			data:{category_id:cat_id,global_comision:commission_val},
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
/*update global commission end here*/
</script>
<?php
require_once('footer.php');
?>	