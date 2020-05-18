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
				<div class="col-md-8"><b>Returned Order In progress Tracking</b></div>
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
            <form action="<?php echo base_url().'admin/returned_orders/filter_returned_orders' ?>" method="post" >
			<div>
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
						<th width="15%">Order No.</th>
						<th width="15%">Shipment No.</th>
						<th width="11%">Date Shipped</th>
						
						<th width="11%">Order Date</th>
                        <th width="5%"> Order Status </th>
						<th width="15%">Ship to Name</th>
						<?php /*?><th width="20%">Total Qty</th><?php */?>
						<th width="5%">Action</th>
					</tr>
					<tr class="filter_tr">
						<td>
							<input type="text" name="order" required >
						</td>
						<td>
							<!--<input type="text" name="shipment" value="">-->
						</td>
						<td>
							<!--<div class="order">
								<span >From:</span>
								<input type="text" name="shipped_from2" id="datepicker-example7-start1" value="">
							</div>
							<div class="order">	
								<span>To:</span>
								<input type="text" name="shipped_to2" id="datepicker-example7-end1" value="">
							</div>-->
						</td>
						
						<td>
							<!--<div class="order">
								<span >From:</span>
								<input type="text" name="order_from" id="datepicker-example7-start" value="">
							</div>
							<div class="order">	
								<span >To:</span>
								<input type="text" name="order_to" id="datepicker-example7-end" value="">
							</div>-->
						</td>
                        <td>
                       <!-- <select name="order_status1" id="order_status">
										<option value="">--select--</option>
										<option value="Pending payment">Pending payment</option>
										<option value="Failed">Failed</option>
										<option value="Order confirmed">Order confirmed</option>
										<option value="Processing">Processing</option>
										<option value="Ready to shipped">Ready to shipped</option>
										<option value="Shipped">Shipped</option>
										<option value="Undelivered">Undelivered</option>
										<option value="Delivered">Delivered</option>
                                        <option value="Return Requested">Return Requested</option>
                                        <option value="Returned">Returned</option>
                                        <option value="Cancelled">Cancelled</option>	
                                            				
									</select>-->
                        </td>
						<td>
							<!--<input type="text" name="billing_name" value="">-->
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
						<td></td>
					</tr>
                    <?php $ct=$return_data->num_rows(); 
					if($ct!=0){
							
							 foreach($return_data->result() as $rws ){
					
					?>
                    <tr>
                    	<td> <?php echo $rws->order_id;  ?></td> 
                        <td> <?php echo $rws->shipment_no;  ?></td>
                        <td> <?php echo substr($rws->shipping_date,0,10);  ?></td>
                                              
                        <td> <?php echo substr($rws->date_of_order,0,10);  ?></td>
                         <td> <?php echo $rws->order_status;  ?>  </td>
                        <td> <?php echo $rws->full_name; ?></td>
                        <td>
                      <a href='<?php echo base_url().'admin/sales/order_detail_asper_order_id/'.$rws->order_id  ; ?>' title="View Shipment Details "> <i style="font-size:18px;" class="fa fa-eye"></i> </a>
                        </td>  
                        
                    </tr>
                    
                    <?php }} else {
					 ?>
					<tr><td colspan="7" class="a-center">No records found ! </td></tr>
					<?php } ?>
					
				</table>
			</div>
            </form>
		</div>  <!-- @end #main-content -->
	</div>
<?php
require_once("footer.php");
?>			