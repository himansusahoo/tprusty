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
					//$attribute = array('onsubmit' => 'return ValidateSpecialCommission()');
					//echo form_open('admin/super_admin/get_special_commission_data',$attribute);
					echo form_open();
					?>
					<div class="row content-header">
						<div class="col-md-8"><b>Commission Settings</b></div>
						<div class="col-md-4 show_report">
							<button type="button" onClick="AddSpecialCommission()" class="all_buttons">Add Special Commission</button>
							<!--<button type="submit" class="all_buttons">Save</button>-->
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
                    	<h3 style="text-align:center;">Special Commission</h3>
                         <div class='col-md-12'>
                         	<table class="table table-bordered table-hover spl_com_tbl">
                            	<tr>
                                	<th>From Date</th>
                                    <th>To Date</th>
                                    <th>Category Name</th>
                                    <th>Seller Name</th>
                                    <th>Action</th>
                                </tr>
                                <?php
								$special_commission_row = $special_comsn_result->num_rows();
								if($special_commission_row > 0){
									$sl=0;
									foreach($special_comsn_result->result() as $spl_com_rows){
										$sl++;
								?>
                                <tr>
                                	<td><?=$spl_com_rows->from_date;?></td>
                                    <td><?=$spl_com_rows->to_date;?></td>
                                    <td><?=$spl_com_rows->category_name;?></td>
                                    <td class="a">
										<?php
											$seller_name = '';
											if($spl_com_rows->seller_id == ''){
												print_r($seller_name);
											}else{
												$seller_ids = unserialize($spl_com_rows->seller_id);
												$seller_id_length = count($seller_ids);
												for($i=0; $i<$seller_id_length; $i++){
													//echo $seller_ids[$i].',';
													$query = $this->db->query("SELECT business_name FROM seller_account_information WHERE seller_id=$seller_ids[$i]");
													$result = $query->result();
													$seller_name[] = $result[0]->business_name;
													echo $result[0]->business_name.'<span>, </span>';
												}
											}
										?>
                                    </td>
                                    <td>
                                    	<a class="inline" href="#inline_content_view<?=$sl;?>" title="View"><i class="fa fa-eye" style="font-size:16px;"></i></a> &nbsp; 
                                        <a href="<?php echo base_url(); ?>admin/super_admin/edit_special_commission/<?=$spl_com_rows->id;?>" title="Edit"><i class="fa fa-pencil-square-o" style="font-size:16px;"></i></a> &nbsp;
                                        
                                        <a href="#" onClick="DeleteSpecialCommission(<?=$spl_com_rows->id;?>)" title="Delete"><i class="fa fa-trash-o" style="font-size:16px;"></i></a>

                                        

                                                                            
<div style="display:none">
      <div id="inline_content_view<?=$sl;?>" style="padding:10px; background:#fff;">
      	<div class="edit_address_dv">
         	<h4 class="title6 sn" style="text-align:center">Special Commission</h4>
	<div class="col-md-12">
		<table class="edit_address_form">
            <tr>
                <td width="150px">Seller Name : </td>
                <td>
				<?php
				if($seller_name == ''){
					echo '';
				}else{
					echo implode(',',$seller_name);
				}
				?>
                </td>
            </tr>
            <tr>
                <td>Category Name : </td>
                <td><?=$spl_com_rows->category_name;?></td>
            </tr>
            <tr>
                <td>Commission Amount : </td>
                <td>Rs. &nbsp;<?=$spl_com_rows->commision;?></td>
            </tr>
            <tr>
                <td>From Date : </td>
                <td><?=$spl_com_rows->from_date;?></td>
            </tr>
             <tr>
                <td>To Date : </td>
                <td><?=$spl_com_rows->to_date;?></td>
            </tr>
            <tr>
                <td class="2"></td>
            </tr>
      </table>
	</div>
            
        </div>
      </div>
</div>
                                        
                                        
                                        
                                    </td>
                                </tr>
                                <?php } //end of foreach loop ?>
								<?php }else{?>
                                <tr>
                                	<td colspan="5">No Record Found.</td>
                                </tr>
                                <?php }?>
                            </table>
                         </div>
                         
                         <div id="load_special_comission"><!--- loading special commission div ---></div>
                         
                    </div>
                    <?php echo form_close(); ?>
				</div><!--   End of Main-content  -->
		</div><!-- @end #content -->

<style>
.dt {width: 150px;}
.Zebra_DatePicker_Icon{left: 130px !important; top: 0px !important;}
.Zebra_DatePicker{ z-index:999999 !important;}
.a span:last-child {display: none;}
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

function DeleteSpecialCommission(id){
	var m = confirm('Are you sure to delete this commission ?');
	if(m){
		$.ajax({
			url:'<?php echo base_url();?>admin/super_admin/delete_special_commission',
			method:'post',
			data:{id:id},
			success:function(result){
				if(result == 'success'){
					window.location.reload(true);
				}
			}
		});
	}else{
		return false;
	}
}


/*insert update special commission start here*/
/*function InsertUpdateSpecialCommission(cat_id,sl){
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
			url:'<?php// echo base_url();?>admin/super_admin/insert_update_special_commission',
			method:'post',
			data:{category_id:cat_id,special_comision:commission,seller_id:seller_id,from_dt:from_dt,to_dt:to_dt},
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
}*/
/*insert update special commission end here*/

function AddSpecialCommission(){
	window.location.href="<?php echo base_url();?>admin/super_admin/add_special_commission";
}
</script>

<!-- Lightbox link start here-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>colorbox/colorbox.css" />
  <script src="<?php echo base_url(); ?>colorbox/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>colorbox/jquery.colorbox.js"></script>
  <script>
      $(document).ready(function(){
          $(".inline").colorbox({inline:true, width:"34%"});
      });
  </script>
<!-- Lightbox link end here-->


<!--- Zebra_Datepicker link start here ---->
<!--<script src="<?php// echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script>-->
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
<!--<link href="<?php// echo base_url(); ?>Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">-->
<!--- Zebra_Datepicker link end here ---->

<?php
require_once('footer.php');
?>