<?php
require_once('header.php');
?>		
<style>

.main-content {
    margin-top: 65px;
}

</style>


<script>

function valid_graceperiod_confirm(order_id)
{
	var conf=confirm("Do you want to approve grace period ?");
	
	if(conf)
	{
		window.location.href="<?php echo base_url().'admin/sales/approve_graceperiod/' ?>" + order_id;	
	}
		
}

function graceperiod_denied(orderid)
{
	var conf=confirm("Do you want to Denied Grace Period Request ?");
	if(conf)
	{
		window.location.href="<?php echo base_url().'admin/sales/graceperiod_deny/' ?>" + orderid;	
	}
	
	
		
}
</script>

			<div id="content">
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_sales.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; 
						
						?>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
                
                
			<div class="row content-header">
						<div class="col-md-8"><h3>Grace Period Approval To Seller</h3><span id="ss"></span></div>
						<div class="col-md-4 show_report">
							
						</div>
					</div>
					
						
				 <!-- <div class="col-md-6 left" >	
										
					
					</div>-->
					
                     <div class="col-md-6 right">
					  <table class="multi_action">
							<tr >
								
								<td>
									
                            <input type="submit" class="all_buttons" value="Search" id="search"  />
							<input type="reset" class="all_buttons" value="Reset Filter" />
								</td>
							 </tr>
						</table>
                        </div>
                        <div class="clearfix"></div>
					
						<table class="table table-bordered table-hover">
                      
                            	<tr class="table_th">
								
								<th>Order ID</th>
                                <th>Seller Name</th>
                                <th>Order Date </th>                                 
                                 <th>Order Status </th>
                                 <th>Total Amount</th>
                                 <th>Grace Period</th>
                                 <th>Reason</th>
                                 <th>Grace Period Approve Status </th>
                                 <th width="6%">Action</th>
							</tr>
							<tr class="filter_tr">
								
								<td>
									<input type="text" name="order_id" id="order_id" >
								</td>
								<td>
									<input type="text" name="seller_name" id="seller_name" >
								</td>
                                
                                <td>									
                                  From <input type="text" name="order_date_to" id="order_date_to" > <br>
                                  To <input type="text" name="order_date_from" id="order_date_from" >
                                    
								</td>
                                 
                                <td>
									<select name="order_status" id="order_status">
                                  <option value="">--select--</option>
								<option value="Pending payment">Pending payment</option>
								 <option value="Failed">Failed</option>
								<option value="Order confirmed">Order confirmed</option>
								<option value="Processing">Processing</option>
								<option value="Ready to shipped">Ready to shipped</option>
							<!--<option value="Shipped">Shipped</option>-->
							<!--<option value="Undelivered">Undelivered</option>-->
								<!--<option value="Delivered">Delivered</option>-->
                            <!--<option value="Return Requested">Return Requested</option>-->
                                 <!--<option value="Returned">Returned</option>-->
                                 <option value="Cancelled">Cancelled</option>						
                                    </select>
								</td>
                                
                               
                                <td><input type="text" name="total_amount" id="total_amount" ></td>
                                 <td></td>  
                                <td></td>
                              <td></td> 
                              <td></td> 
							</tr>
                            
                           <?php
						  
						   
						    if(count($grc_periodrqst_list)!=0){
							   
							   foreach($grc_periodrqst_list as $res_grc_periodrqst_list)
							   { 
							     
							   
							   ?>
                            <tr> 
                            <td><?= $res_grc_periodrqst_list->order_id ?>  </td>
                            <td> <?= $res_grc_periodrqst_list->pname ?></td>
                            
                            <td> <?= $res_grc_periodrqst_list->date_of_order ?> </td>
                            
                            <td> <?= $res_grc_periodrqst_list->order_status ?> </td>
                            <td> Rs.<?= $res_grc_periodrqst_list->Total_amount ?> </td>
                              <td> <?= $res_grc_periodrqst_list->grace_period ?> days </td>
                              <td> <?= $res_grc_periodrqst_list->grace_period_reason ?>  </td>  
                              <td><?= $res_grc_periodrqst_list->grace_period_approve_status ?></td>                        
                            <td>
                        <a href='<?php echo base_url().'admin/sales/order_detail_asper_order_id/'.$res_grc_periodrqst_list->order_id ?>' title="View Return Request Detail"> <i style="font-size:16px;" class="fa fa-eye"></i> </a>     

					<?php if($res_grc_periodrqst_list->grace_period_approve_status=='Not Approved' && $res_grc_periodrqst_list->grace_period!=0 && $res_grc_periodrqst_list->grace_period_reason!='')  {?>

						<a href='#' onClick="valid_graceperiod_confirm('<?php echo $res_grc_periodrqst_list->order_id; ?>')" title="Approve Order">    <i class="fa fa-thumbs-o-up"></i> </a><?php } ?>
                        
                <?php if( $res_grc_periodrqst_list->grace_period!=0 && $res_grc_periodrqst_list->grace_period_reason!='' && $res_grc_periodrqst_list->request_for_grace_period=='yes')  {?>        
                        
                   <a href='#' onClick="graceperiod_denied('<?php echo $res_grc_periodrqst_list->order_id; ?>')" title="Denied Grace Period Request">     <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> </a>
	<?php } ?>
					</td> 
                            
                            </tr>
                            <?php } }else { ?>
                           
							<tr><td colspan="8" class="a-center">No Records Found ! </td></tr>
                            <?php }  ?> 
					  </table>
                    
                       



</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->    

                
 <?php
require_once('footer.php');
?>