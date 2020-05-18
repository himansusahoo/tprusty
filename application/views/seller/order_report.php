<?php
require_once('header.php');
?>




<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
<style>
.Zebra_DatePicker_Icon{left: 148px !important; top: 0px !important;}
</style>



			<div id="content">    
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_reporttab.php'; ?>
					</div>
					<?php require_once('header_session.php'); ?>
				</div>  <!-- @end top-bar  -->
				
			
					<!--<div style="padding-top:60px; margin:0px 50px;">
						<div class="alert alert-danger" role="alert"> *Important ! You have not completed signup. To complete click <a href="<?php// echo base_url();?>seller/seller/incomplete_signup"><strong>here</strong></a></div>
					</div>-->
				
				
				<div class="main-content">
					<?php require_once('common.php'); ?>
					<div class="page_header">
						<div class="left">
							<h3>Order Reports</h3><button id="product_submit" class="seller_buttons" onclick="window.location.href='<?php echo base_url().'seller/reports/export_orderreport/'.$start?>'" > 
           <i class="fa fa-file-excel-o" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Export To Excel Order Report 
           </button>
						</div>
						<!--<div class="right order_id_search">
							<img class="partner_img" src="../images/partner-mobile-icon-new.png">
							<a href="#"> Lending Services </a>
							<div class="search_bar input-append">
								Settlement Ref No : 
								<input type="text" name="ref_no">
								<button type="submit"><span class="icon-search"></span></button>
							</div>
						</div>-->
                        <form action="<?php echo base_url().'seller/reports/filter_order' ?>" method="post" >
						<div class="col-md-6 right show_report">
							<input type="submit" class="all_buttons" value="Search" >
							<input type="reset" class="all_buttons" value="Reset Filter">
						</div>
						<div class="clear"></div>
                        <div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
					<div>
					</div>
					<!--Take tour-->
					<!--<div class="row">
						<div class="payment_btn_group">
							<ul class="nav nav-tabs">
								<li class="no_tab">
									<span>
										<i class="icon-play"></i>
										<a href="#">Take a tour</a>
									</span>
								</li>
								<li class="no_tab" style="border-right: 1px solid #999999; margin-right: 10px; padding-right: 10px;">
									<span class="new_returns_policy">
										<i class="icon-info-sign"></i>
										<a href="#"> Understand payments better </a>
									</span>
								</li>
							</ul>
						</div>
					</div>-->
					<!--<div class="row table_blocks">-->
					<div class="row mt20">
						
					</div><!--Settled & Unsettled table-->
					
					<div class="settelment_details_table">
						<table class="table table-bordered table-hover">
							<tr>
								<th>Sl. No.</th>
								<th>Ordered Date</th>
								<th>Order ID</th>
								<th >Customer Email</th>
                                <th >Amount</th>
                                <th>Status</th>
							</tr>
                            <tr class="filter_tr">
								<td></td>
								<td><input type="text" name="order_date" id="datepicker-example7-start" autocomplete="off"></td>
								<td><input type="text" name="order_id" id="order_id"></td>
								<td><input type="text" name="email" id="email"></td>
								<td><input type="number" name="amount" id="amount"></td>
								<td>
                                	<select name="status" id="status">
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
                                        <option value="Return Received">Return Received</option>
										<option value="Cancelled">Cancelled</option>
									</select>
                                </td>
							
                                
							</tr>
						<?php $ct=count($order_report);
								if($ct > 0){
									$i=1;
									foreach($order_report as $res_orderepo){
										
										/*if($order_report){
											$i=1;
								foreach($order_report as $res_orderepo){*/
						 ?>
                          
                            <tr>
                            	<td><?=$i; ?></td>
                                <td><?php $date_of_order=substr($res_orderepo->date_of_order,0,10); 
										echo date('d-M-Y',strtotime($date_of_order));?></td>
                                <td><?=$res_orderepo->order_id; ?></td>
                                <td ><?=$res_orderepo->email; ?></td>
                                <td>Rs.<?=$res_orderepo->Total_amount; ?></td>
                                <td><?=$res_orderepo->order_status; ?><a href='<?php echo base_url().'seller/orders/order_report/'.$res_orderepo->order_id ?>' target='_blank' title="View Wallet Detail"> <i style="font-size:16px;" class="fa fa-eye"></i> </a></td>
                                
                                
                            </tr>
                           <?php $i++; } //foreach end
						    }else{ ?> 
                            
                            <tr>
                            	<td colspan="6">No Record Found!</td>
                            </tr>
                            <?php } ?>
						</table>
						<!--<div>
							<button class="show_more_btn"><span>Show More</span></button>
						</div>-->
					</div>
                    </form>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->




<?php
require_once('footer.php');
?>