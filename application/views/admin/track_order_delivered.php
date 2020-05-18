<?php
require_once("header.php");
?>	
	<!--- Zebra_Datepicker link start here ---->
	<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
	<!--- Zebra_Datepicker link end here ---->
	
	<style>
		.Zebra_DatePicker_Icon{left: 110px !important; top: 3px !important;}
		.main-content {
    margin-top: 65px;
}

	</style>
    <script>
	function change_order_status(){
		if($('#order_status').val()=="")
		{
			alert("select change status value");return false;	
		}
		var order_ids = document.getElementsByName("order_id_chk[]");
		var orderid_count=order_ids.length;
		
		var count=0;
		for (var i=0; i<orderid_count; i++) {
			if (order_ids[i].checked === true) 
			{
				count++;
			}
		}
		
		if(count==0)
		{
			alert('Please select atleast one record');
			return false;
		}
		else
		{
			//else part start
			
			var ys = confirm("Do you want to change order status ?");
		if(ys){
			var ordered_id = $('input[name="order_id_chk[]"]:checked').map(function(_, el){
        	return $(el).val();
    	}).get();
			var orderstatus=$('#order_status').val();
			
			$.ajax({
				method:"POST",
				url:"<?php echo base_url(); ?>admin/Track_orders/change_orderstatus",
				data:{orderid:ordered_id,ordered_status:orderstatus},
				success: function (data) {
					//$("#ss").html(data);
					if(data == 'success'){
						window.location.reload(true);
					}
				}
			});
		
		}
			
	}
			
}
	
</script>

<script>

$(document).ready(function(){
	$('#check_all').click(function(){
		$('input:checkbox').prop('checked', this.checked);
	});
});
</script>

	<div id="content">    
		<div class="top-bar">
			<div class="top-left">
				<?php include 'sub_sales.php'; ?>
			</div>
			<div class="top-right">
				<?php include 'top_right.php'; ?>
			</div>
		</div>  <!-- @end top-bar  -->
		<div class="main-content">
			<div class="row content-header">
				<div class="col-md-8"><b>In Transist Orders Tracking</b></div>
			</div>
			<div class="row mb10">
				<!--<div class="col-md-6">
					Page 
					<span class="glyphicon glyphicon-chevron-left arrow_button"></span>
					<input type="text" name="page" class="input_text" value="1">
					<span class="glyphicon glyphicon-chevron-right"></span>
					of 1 pages <span class="separator">|</span> View
					<select> 
						<option selected="selected" value="">20</option>
						<option>30</option>
						<option>50</option>
						<option>100</option>
						<option>200</option>
					</select>
					per page <span class="separator">|</span> Total 0 records found
				</div>-->
				<div class="col-md-3 show_report">
					<!--<div class="all_save">
						Export To:
						<select>
							<option>CSV</option>
							<option>Excel XML</option>
						</select>
						<button type="button">Export</button>
					</div>-->
				</div>
				<div class="col-md-3 show_report">
					<!--<form>
									<table>
										<tr>
											<td>Actions</td>
											<td>
												<select>
													<option value=""></option>
													
												</select>
											</td>
											<td><input type="submit" name="submit" class="all_buttons" value="Submit"></td>
										</tr>
									</table>
								</form>-->
				</div>
			</div>
            
            <div class="col-md-6 left" >	
										
					<table>
						<tr>
							<td>Change Order Status</td>
							<td>
														<select id="order_status" name="order_status" >
															<option value="">--select--</option>
															<!--<option value="Pending payment">Pending payment</option>
															<option value="Failed">Failed</option>
															<option value="Order confirmed">Order confirmed</option>-->
															<!--<option value="Processing">Processing</option>
															<option value="Ready to shipped">Ready to shipped</option>-->
															<!--<option value="Shipped">Shipped</option>-->
                                                           <!-- <option value="Delivered">Delivered</option>
															<option value="Undelivered">Undelivered</option>-->
															
                                                            <!--<option value="Return Requested">Return Requested</option>-->
                                                           <option value="Return Received">Return Received</option>
                                                           <!-- <option value="Cancelled">Cancelled</option>-->
														</select>
													</td>
													<td><input type="button" name="change_order" class="all_buttons" onClick="change_order_status()" value="Submit"></td>
												</tr>
						
						</table>
					</div>
			<div><form action="<?php echo base_url().'admin/track_orders/filter_delivered' ?>" method="post">	
				<table class="multi_action">
					<tr>
						<!--<td>
							<a href="#">Select Visible</a>
							<span class="separator">|</span>
							<a href="#">Unselect Visible</a>
							<span class="separator">|</span>
							0 items selected
						</td>-->
						<td>
							<div class="right">
							
                                <input type="submit" class="all_buttons" value="Search" id="search"  />
							<input type="reset" class="all_buttons" value="Reset Filter" />
							</div>
						</td>
					</tr>
				</table>
			</div>
			<div>
				<table class="table table-bordered table-hover">
					<tr class="table_th">
                    <th width="3%">Select All</th>
						<th width="15%">Order No.</th>
						
						<th width="12%">Date Shipped</th>
						
						<th width="12%">Order Date</th>
                        <th width="5%"> Order Status </th>
						<th width="15%">Ship to Name</th>
                        <th width="15%">Courier Name</th>
                        <th width="15%">Tracking Number</th>
						<?php /*?><th width="20%">Total Qty</th><?php */?>
						<th width="5%">Action</th>
					</tr>
					<tr class="filter_tr">
						<td><input type="checkbox" id="check_all" name="check_all"></td>
						<td>
							
                            <input type="text" name="order_no" id="order_no" required value="">
						</td>
						<td>
							<!--<div class="order">
								<span >From:</span>
								<input type="text" name="shipped_from_1"  id="datepicker-example7-start" value="">
							</div>
							<div class="order">	
								<span>To:</span>
								<input type="text" name="shipped_to_1" id="datepicker-example7-end" value="">
							</div>-->
						</td>
                        <td>
							<!--<div class="order">
								<span >From:</span>
								<input type="text" name="order_from" id="datepicker-example7-start1" value="">
							</div>
							<div class="order">	
								<span >To:</span>
								<input type="text" name="order_to" id="datepicker-example7-end1" value="">
							</div>-->
						</td>
						<td>
							
						</td>
                        <td>
							<!--<input type="text" name="ship_to_name" id="ship_to_name" >-->
						</td>
						<td>
                        
                       <!-- <select name="courier_name" id="courier_name">
                        <option>--select--</option>
                        <?php// foreach($couriename_list as $res_courieinfo){ ?>
                        
                        <option value="<?php// $res_courieinfo->courier_name ?>"> <?php// $res_courieinfo->courier_name ?> </option>
                         <?php// } ?>
                        
                         </select>-->
							
						</td>
                        <td>
							<!--<input type="text" name="tracking_no" id="tracking_no" >-->
						</td>
                         
                        <td>
                        </td>
						
						<!--<td>
							<div class="base">
								<span >From:</span>
								<input type="text" name="qty_from" value="">
							</div>
							<div class="base">	
								<span >To:</span>
								<input type="text" name="qty_to" value="">
							</div>
						</td>-->
						</form>
					</tr>
                    <?php $ct=$delivered_list->num_rows(); 
					if($ct!=0){
							
							 foreach($delivered_list->result() as $rws ){
					
					?>
                    <tr>
                        <!--<td> <?php// echo $rws->shipment_no;  ?></td>-->
                        <td style="text-align:center;"><input type="checkbox"  id="order_id_chk" name="order_id_chk[]" value="<?php echo $rws->order_id ?>" ></td>
                        <td> <?php echo $rws->order_id;  ?></td> 
                        <td> <?php echo substr($rws->shipping_date,0,10);  ?></td>
                                              
                        <td> <?php echo substr($rws->date_of_order,0,10);  ?></td>
                         <td> <?php echo $rws->order_status;  ?>  </td>
                        <td> <?php echo $rws->full_name; ?></td>
                        <td> <?php echo $rws->courier_name;  ?>  </td>
                        <td> <?php echo $rws->tracking_no;  ?>  </td>
                        <td>
                      <a href='<?php echo base_url().'admin/sales/order_detail_asper_order_id/'.$rws->order_id  ; ?>' title="View Shipment Details "> <i style="font-size:18px;" class="fa fa-eye"></i> </a>
                      
                        </td>  
                        
                    </tr>
                    
                    <?php }} else {
					 ?>
					<tr><td colspan="8" class="a-center">No records found ! </td></tr>
					<?php } ?>
					
				</table>
			</div>
		</div>  <!-- @end #main-content -->
	</div>
<?php
require_once("footer.php");
?>			