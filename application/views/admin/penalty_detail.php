<?php
require_once("header.php");
?>
<style>

.main-content {
    margin-top: 65px;
}

</style>
<div id="content">    
				<div class="top-bar">  <!-- @start top-bar  -->
					<div class="top-left">
						<?php include 'sub_sales.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
                    <div class="clearfix"></div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
                
                <div class="row content-header">
						<div class="col-md-8"><b>Penalty Detail</b></div>
                        
                        
						<div class="col-md-4 show_report">
							
						</div>
					</div>
					<div class="row mb10">
						
						<div class="col-md-3 " >
							
						</div>
						<!--<div class="col-md-3 show_report">
                        <form  method="post">
							<input  type="submit" class="all_buttons" value="Search" onClick="return valid()" >
							<button type="button" class="all_buttons">Reset Filter</button>
						</div>-->
					</div>
					
					<div>
						<table class="table table-bordered table-hover">
							<tr class="table_th">
                            <th width="20%">Order Id</th>
								<th width="10%">Seller Name</th>
                               
								<th width="20%">Penalty Type</th>
								
								<th width="10%">Ordered Total Amount</th>
								<th width="10%">Penalty Percentages</th>
								<th width="10%">Penalty Charges</th>
                                <th width="20%">Penalty Date</th>
                               
							</tr>
							<!--<tr class="filter_tr">
								<td>
                                
                               <input type="text" name="order_id" id="order_id" >
									
								</td>
                                <td> 
                               <input type="text" name="Seller Name" id="order_id" >
                                 </td>
                                 
                                <td>
                                 <select name="penalty_type">
                                 <option>--select--</option>
                                 <option value="">--select--</option>
                                 <option value="4">Order Not Process</option>
                                 <option value="5">Order Shipping Delay</option>
                                 <option value="3">Order Cancel Penalty</option>
                                
                                </select>
                                </td>
                                <td>
                                <input type="text" name="order_total_amount" id="order_total_amount" >
                                
                                </td>
                                
                                
                                <td>
                               <input type="text" name="penalty_percentages" id="penalty_percentages" >
                                
                                </td>
                                 <td>
                               <input type="text" name="penalty_carges" id="penalty_carges" >
                                
                                </td>
                                <td>
                               <input type="text" name="penalty_date" id="penalty_date" >
                                
                                </td>
                                
                                
                               
								
							</tr></form>-->
						
                          <?php 
						  $ct=$penalty_data->num_rows();
						  if($ct!=0){
						  
						  foreach($penalty_data->result() as $res){ ?>  
                          
                            <tr>
                            	<td><?php echo $res->order_id ?></td>
                           		<td><?php echo $res->name  ?></td>
                                <td><?php echo $res->charges_type  ?></td>
                                <td><?php echo "Rs.".  $res->ordered_amount;  ?></td>
                                <td><?php echo  $res->penalty_pecentages  ?>%</td>
                                 <td><?php echo "Rs.". $res->penalty_charges  ?></td>
                                <td><?php echo $res->penalty_date  ?></td>
                               
                               
                            </tr>
                                <?php } 
						       }else{
								 ?>
                                <tr><td colspan="8" class="a-center">No records found ! </td></tr>
							
							<?php } ?>
						</table>
					</div>
				</div>  <!-- @end #main-content -->
                
                </div>            	
<?php
require_once('footer.php');
?>			