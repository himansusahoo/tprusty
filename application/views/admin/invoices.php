<?php
require_once("header.php");
?>		
		<!--- Zebra_Datepicker link start here ---->
		<link href="../Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
		<link href="../Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">
		<script src="../Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script>
		<script src="../Zebra_Datepicker-master/examples/public/javascript/core.js"></script>
		<script src="../Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
		<!--- Zebra_Datepicker link end here ---->
		
		<style>
			.Zebra_DatePicker_Icon{left: 110px !important; top: 3px !important;}
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
						<div class="col-md-8"><b>Invoices</b></div>
						<!--<div class="col-md-4 show_report">
							<button type="button" class="all_buttons">Create New Order</button>
						</div>-->
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
							<div class="all_save">
								Export To:
								<select>
									<option>CSV</option>
									<option>Excel XML</option>
								</select>
								<button type="button">Export</button>
							</div>
						</div>
						<div class="col-md-3 show_report">
							<button type="button" class="all_buttons">Search</button>
							<button type="button" class="all_buttons">Reset Filter</button>
						</div>
					</div>
					<div>
						<table class="multi_action">
							<tr>
								<td>
									<a href="#">Select Visible</a>
									<span class="separator">|</span>
									<a href="#">Unselect Visible</a>
									<span class="separator">|</span>
									0 items selected
								</td>
								<td>
									<div class="right">
										<form>
											<table>
												<tr>
													<td>Actions</td>
													<td>
														<select>
															<option value=""></option>
															<option value="">PDF Invoices</option>
														</select>
													</td>
													<td><input type="submit" name="submit" class="all_buttons" value="Submit"></td>
												</tr>
											</table>
										</form>
									</div>
								</td>
							</tr>
						</table>
					</div>
					<div>
						<table class="table table-bordered table-hover">
							<tr class="table_th">
								
								<th width="20%">Invoice No.</th>
								<th width="15%">Invoice Date</th>
								<th width="15%">Order No.</th>
								<th width="10%">Order Date</th>
								<th width="15%">Bill to Name</th>
								<th width="10%">Status</th>
								<th width="6%">Amount</th>
								<th width="9%">Action</th>
							</tr>
							<tr class="filter_tr">
								
								<td>
									<input type="text" name="invoice" value="">
								</td>
								<td>
									<div class="order">
										<span >From:</span>
										<input type="text" name="order_from" id="datepicker-example7-start" value="">
									</div>
									<div class="order">	
										<span >To:</span>
										<input type="text" name="order_to" id="datepicker-example7-end" value="">
									</div>
								</td>
								<td>
									<input type="text" name="order" value="">
								</td>
								<td>
									<div class="order">
										<span >From:</span>
										<input type="text" name="order_from" id="datepicker-example15-start" value="">
									</div>
									<div class="order">	
										<span >To:</span>
										<input type="text" name="order_to" id="datepicker-example15-end" value="">
									</div>
								</td>
								<td>
									<input type="text" name="billing_name" value="">
								</td>
								<td>
									<select>
										<option value=""></option>
										<option value="1">Pending</option>
										<option value="2">Paid</option>
										<option value="3">Canceled</option>
									</select>
								</td>
								<td>
									<div class="base">
										<span >From:</span>
										<input type="text" name="base_from" value="">
									</div>
									<div class="base">	
										<span >To:</span>
										<input type="text" name="base_to" value="">
									</div>
								</td>
								<td></td>
							</tr>
                            
                            <tr>
								<?php
							$ct=$invoice_list->num_rows();
							if($ct!=0){
							
							 foreach($invoice_list->result() as $rws ){  ?>
                            <tr> 
                            
                            <td> <?php if($rws->invoice_id!=""){ echo $rws->invoice_id; } else { ?> 
                            
                            <input type="button" name="invoice_id_btn" value="Generate invoice ID" onClick="window.location.href='<?php echo base_url().'admin/sales/create_invoice_id/'.$rws->order_id ?>' ">
                            
                             <?php }  ?>  </td>
                            
                             <td> <?php echo substr($rws->invoice_date,0,10);  ?>  </td>
                             
                            <td> <?php echo $rws->order_id;  ?>  </td>
                            <td><?php echo substr($rws->date_of_order,0,10);  ?></td>
                            <td><?php echo $rws->fname;  ?> <?php echo " ". $rws->lname;  ?></td>
                            <td><?php echo  $rws->order_status;  ?></td>
                            <td>  <i class="fa fa-inr"></i><?php echo " ". $rws->sub_total_amount;  ?></td>
                            
                            
                            <td>
                       <!-- <a href='<?php //echo base_url().'admin/sales/order_detail_asper_order_id/'.$rws->order_id  ; ?>' title="View Order"> <i style="font-size:18px;" class="fa fa-eye"></i> </a> 		-->                           &nbsp;   
                        <!--<a href='<?php //echo base_url().'admin/sales/generate_packing_slip/'.$rws->order_id  ; ?>' title="packagingSlip">  <i style="font-size:18px;" class="fa fa-file-pdf-o"></i></a>&nbsp;--> 
                        <a href='<?php echo base_url().'admin/sales/invoice_detail_asper_order_id/'.$rws->order_id  ; ?>' title="view_invoice_detail"><i style="font-size:18px;" class="fa fa-eye"></i></a>
                        <a href='<?php echo base_url().'admin/sales/generate_invoice_slip/'.$rws->order_id  ; ?>' title="Invoice">  <i style="font-size:18px;" class="fa fa-file-pdf-o"></i></a>
                         <a href='#' title="Edit">  <i style="font-size:18px;" class="fa fa-pencil-square-o"></i></a>
                         
                         <a href='#' title="Delete">  <i style="font-size:18px;" class="fa fa-trash-o"></i></a>
					</td> 
                            
                            </tr>
                            <?php  } } else {?>
							<tr><td colspan="9" class="a-center">No records found ! </td></tr> <?php } ?>
							</tr>
                           </table>
					</div>
				</div>  <!-- @end #main-content -->
			</div>
<?php
require_once("footer.php");
?>			