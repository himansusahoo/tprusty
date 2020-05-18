<?php
require_once('header.php');
?>	

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
                    <?php
					$return_order_report_rows = $return_order_report_result->num_rows();
					if($return_order_report_rows > 0){
						foreach($return_order_report_result->result() as $rw){
							$amount[] = $rw->total_amount;
							//$order_status[] = $rw->order_status;
						}
						$total_amount = array_sum($amount);
					}else{
						$total_amount = 0;
					}
					?>
					<div class="col-md-6"> <h3 style="width:100%;">Return Order Report &nbsp;(<?=$return_order_report_rows;?> Orders)</h3> </div>
					<div class="col-md-6">
                    <!--<button type="button" class="all_buttons" onClick="window.location.href='<?php// echo base_url().'admin/catalog/addnew_product' ?>'">Add Product</button>-->
                    <h3 style="width:100%; text-align:right;">Total Amount : Rs. <?=number_format((float)$total_amount, 2, '.', '');?></h3>
                     </div>
					</div>
						<?php 
							//echo form_open('admin/sales/filter_order');
							$attributes = array('id' => 'filter_form');
							echo form_open('admin/report/filter_return_order_report',$attributes);
						?>
						<div class="col-md-6 right show_report">
							<input type="submit" class="all_buttons" value="Search" onClick="return validFilter()">
							<input type="reset" class="all_buttons" value="Reset Filter">
						</div>

				    <div  class="col-md-6 left">	
                        <table class="multi_action">
							<tr>
                            	<td></td>
							</tr>
						</table>
					</div>	
					<div class="clearfix"></div>
					<div>
						<table class="table table-bordered table-hover">
                        	<tr>
                        	<?php if($status){ ?>
                            	<td colspan="7">Filtered Data  as  Order Status : <strong><?=$status; ?></strong></td>
                            <?php }else if($seller_name){?>
                            	<td colspan="7">Filtered Data  as  Seller : <strong><?=$seller_name; ?></strong></td>
                            <?php }?>
                            </tr>
							<tr class="table_th">
								<th width="5%">SL NO.</th>
                                <th width="10%">Return Date</th>
								<th width="10%">Order ID</th>
                                <th width="10%">Return Order ID</th>
                                <th width="10%">Reason</th>
								<th width="10%">Seller Name</th>
								<th width="15%">Customer Email</th>
								<th width="10%">Amount</th>
								<th width="10%">Status</th>
							</tr>
							<tr class="filter_tr">
								<td></td>
								<td></td>
								<td></td>
                                <td></td>
								<td></td>
								<td><input type="text" name="fltr_seller" id="fltr_seller"></td>
								<td></td>
								<td></td>
                                <td>
                                	<select name="order_status2" id="order_status">
										<option value="">--select--</option>
										<option value="Return Requested">Return Requested</option>
                                        <option value="Return Received">Return Received</option>
									</select>
                                </td>
							</tr>
                            <?php
							if($return_order_report_rows > 0){
								$sl=0;
								foreach($return_order_report_result->result() as $order_row){
									$sl++;
							?>
                            <tr>
                            	<td><?=$sl;?></td>
                                <td><?=date('Y-m-d',strtotime($order_row->cdate));?></td>
                                <td><?=$order_row->order_id;?></td>
                                <td><?=$order_row->return_id;?></td>
                                <td><?=$order_row->reason;?></td>
                                <td><?=$order_row->business_name;?></td>
                                <td><?=$order_row->email;?></td>
                                <td>Rs. <?=$order_row->total_amount;?></td>
                                <td><?=$order_row->status;?></td>
                            </tr>
                            <?php } }else{?>
                             <tr>
                            	<td colspan="7">No Record Found.</td>
                            </tr>
                            <?php }?>
						</table>
					</div>
                    <?php echo form_close(); ?>
				</div>
        
        	
	</div><!-- @end #content -->


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