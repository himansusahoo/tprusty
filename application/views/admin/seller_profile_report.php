<?php
require_once('header.php');
?>	
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
	<div id="content">    
		<div class="top-bar">
			<div class="top-left">
				<?php include 'sub_reports.php'; ?>
			</div>
			<div class="top-right">
				<?php include 'top_right.php'; ?>
			</div>
		</div>  <!-- @end top-bar  -->
        
        <div class="main-content">
					<div class="row content-header">
					<div class="col-md-8"> <h3>Seller Profile</h3>
                    <button id="product_submit" class="seller_buttons" onclick="window.location.href='<?php echo base_url().'admin/payment/slrprfl_excel_report/'.$start?>'" > 
           <i class="fa fa-file-excel-o" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Export To Excel Seller Profile Report 
           </button></div>
                    </div>
						<form action="<?php echo base_url().'admin/payment/filter_slrprofile' ?>" method="post" >
						<div class="col-md-6 right show_report">
							<input type="submit" class="all_buttons" value="Search" >
							<input type="reset" class="all_buttons" value="Reset Filter">
						</div>
						<div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
				    
					
					<div class="table-responsive">
                    
						<table class="table table-bordered table-hover">
                        	<!--<tr>
                        	<?php// if($status){ ?>
                            	<td colspan="7">Filtered Data  as  Order Status : <strong><?//=$status; ?></strong></td>
                            <?php// }else if($seller_name){?>
                            	<td colspan="7">Filtered Data  as  Seller : <strong><?//=$seller_name; ?></strong></td>
                            <?php// }?>
                            </tr>-->
							<tr class="table_th">
								<th width="5%">SL NO.</th>
                                <th width="10%">Seller</th>
                                <th width="10%">State</th>
								<th width="10%">City</th>
								<th width="10%">Seller Email Address</th>
								<th width="10%">Approval Date</th>
								<th width="10%">Status</th>
                                <th width="10%">Bank Account Holder Name</th>
                                <th width="10%">IFSC Code</th>
                                <th width="10%">Bank Name</th>
                                <th width="10%">Branch Name</th>
								<th width="10%">Bank account State</th>
								<th width="10%">PAN CARD</th>
								<th width="10%">TIN NO</th>
                                <th width="10%">TAN ID</th>
								
							</tr>
							<tr class="filter_tr">
							<td></td>
                            <td>
									<input type="text" name="seller" id="seller" autocomplete="off">
                                    <div id="slr_nm_dv"><ul></ul></div>
								</td>
								<td>
									<input type="text" name="slr_state" id="slr_state" >
								</td>
								<td>
                                
									<input type="text" name="city" id="city" >
								</td>
								<td>
									<input type="text" name="slr_email" id="slr_email" >
								</td>
								<td>
								<input type="text" name="appr_dt" id="datepicker-example7-start">
								</td>
                                <td>
                                	<select name="status" id="status">
										<option value="">--select--</option>
										<option value="Active">Active</option>
										<option value="Rejected">Rejected</option>
                                        <option value="Pending">Pending</option>
										<option value="Suspended">Suspended</option>
									</select>
                                </td>
                                <td>
									<input type="text" name="ac_holder" id="ac_holder" >
								</td>
                                <td>
									<input type="text" name="ifsc" id="ifsc" >
								</td>
                                <td>
									<input type="text" name="bank" id="bank" >
								</td>
                                <td><input type="text" name="branch" id="branch" ></td>
								<td>
									<input type="text" name="bank_state" id="bank_state" >
								</td>
								<td>
                                
									<input type="text" name="pan" id="pan" >
								</td>
								<td>
									<input type="text" name="tin" id="tin" >
								</td>
								<td>
								<input type="text" name="tan" id="tan">
								</td>
								
							</tr>
                            <?php
						    if($slrprfl_report->num_rows()>0){	
								$sl=0;					
								foreach($slrprfl_report->result() as $report_row){
								
								$sl++;
								?>
                            <tr>
                            	<td><?php echo $sl;?></td>
                                <td> <?php echo $report_row->business_name;?></td>
                                <td> <?php echo $report_row->seller_state;?></td>
                                <td> <?php echo $report_row->seller_city; ?></td>
                                <td> <?php echo $report_row->email;?></td>
                                <td> <?php $approval_date=substr($report_row->approval_date,0,10); 
										echo date('d-M-Y',strtotime($approval_date));?></td>
                                 <td><?php echo $report_row->status;?></td>
                                 <td> <?php echo $report_row->ac_holder_name;?></td>
                                 <td> <?php echo $report_row->ifsc_code;?></td>
                                <td> <?php echo $report_row->bank;?></td>
                                <td><?php echo $report_row->branch;?></td>
                                <td> <?php echo $report_row->state;?></td>
                                <td> <?php echo $report_row->pan; ?></td>
                                <td> <?php echo $report_row->tin;?></td>
                                <td> <?php echo $report_row->tan;?></td>
                               
                            </tr>
                            <?php }
							 }
							else{?>
                             <tr>
                            	<td colspan="15">No Record Found.</td>
                            </tr>
                            <?php }?>
						</table>
					</div>
                    </form>
                    <!--<?php// echo form_close(); ?>-->
				</div>
        
        	
	</div><!-- @end #content -->


<style>
.Zebra_DatePicker_Icon{left:56px !important; top: 6px !important;}
#non,#slr_nm_dv{ display:none;}
#slr_nm_dv{position: absolute; z-index: 1000; background-color:seashell; width: 12%; border: 1px solid tan;  border-radius: 3px;}
#slr_nm_dv ul {margin-bottom:0px !important;}
#slr_nm_dv li { cursor: pointer;  list-style: outside none none;padding: 5px 5px 5px 10px;}
#slr_nm_dv li:hover{background-color:tan;}
</style> 


<script>
$(document).ready(function(){
	////seller name field script start here/////
	$("#seller").keyup(function(){
		//ShowLoder1();
		var seller=$(this).val();
		$('#slr_nm_dv').css('display','block');
		$.ajax({
			url:'<?php echo base_url().'admin/payment/autofill_slrprfl' ?>',
			method:'post',
			data:{seller:seller},
			success:function(data)
			{
				if(seller){
					$("#slr_nm_dv ul").html(data);
					//HideLoder1();
				}else{
					$("#slr_nm_dv ul").html("");
					//HideLoder1();
					$('#slr_nm_dv').css('display','none');
				}
			}
		});
	});
////seller name field script end here/////
})


function getslrname(val){
	var x = val
	var res = x.replace(/-/g,' ')
	$('#seller').val(res);
	$('#seller').css('color','black');
	$('#slr_nm_dv').css('display','none');
}
</script>
<script>
function validFilter(){
	var seller_name = $('#fltr_seller').val();
	var status = $('#order_status').val();
	if(seller_name!='' && status!=''){
		alert('You should filtered data only one field in a time.');
		$('#filter_form').trigger("reset");
		return false;
	}
}
</script>
<?php
require_once('footer.php');
?>	