<?php
require_once("header.php");
?>
<script>
function returnrequest_confirm(order_id)
{
	var conf=confirm('Do You want to approve return request ?');
	if(conf)
	{
		window.location.href='<?php echo base_url().'admin/sales/return_request_approve/'?>' + order_id;
	}
}

function return_request_denied(order_id){
	var conf=confirm('Do You want to deny return request ?');
	if(conf)
	{
		window.location.href='<?php echo base_url().'admin/sales/return_request_denied/'?>' + order_id;
	}
}
</script>
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
						<div class="col-md-8"><h3>Return Request Orders For Approval OR Denied</h3><span id="ss"></span></div>
						<div class="col-md-4 show_report">
							<!--<button type="button"  class="all_buttons">Create New Order</button>-->
						</div>
					</div>
					
						
				  <div class="col-md-6 left" >	
										
					
					</div>
					 <!--<form action="" method="post" >-->
                    <!-- <div class="col-md-6 right">
					  <table class="multi_action">
							<tr>
								
								<td>
									
                            <input type="submit" class="all_buttons" value="Search" id="search"  />
							<input type="reset" class="all_buttons" value="Reset Filter" />
								</td>
							 </tr>
						</table>
                        </div>-->
                        <div class="clearfix"></div>
					
						<table class="table table-bordered table-hover">
                      
                            	<tr class="table_th">
								
								<th width="20%">Order ID</th>
                                <th width="20%">Buyer Name</th>
                                
                                 <th width="15%">Return Type</th>
                                 <th width="20%">Seller Name</th>
								
								<th width="10%">Action</th>
							</tr>
							<!--<tr class="filter_tr">
								
								<td>
									<input type="text" name="order_id" id="order_id" >
								</td>
								<td>
									<input type="text" name="buyer_name" id="buyer_name" >
								</td>
                                
                                <td>									
                                    <select name="return_type" id="return_type">
                                    <option>--select--</option>
                                    <option value="Refund">Refund</option>
                                    <option value="Replacement">Replacement</option>
                                    </select>
                                    
								</td>
                                 
                                <td>
									<input type="text" name="seller_name" id="seller_name" >
								</td>
                                
                               
                                <td></td>
							</tr>-->
                            
                           <?php if(count($return_orderlist)!=0){
							   
							   foreach($return_orderlist as $res_returnlist)
							   { ?>
                            <tr> 
                            <td> <?= $res_returnlist->order_id ?>  </td>
                            <td><?= $res_returnlist->fname. " ". $res_returnlist->lname  ?></td>
                           
                            <td> <?= $res_returnlist->return_typ ?> </td>
                            
                            <td><?= $res_returnlist->name ?></td>
                            
                            <td>
                        <a href='<?php echo base_url().'admin/sales/view_request_detail/'.$res_returnlist->order_id ?>' title="View Return Request Detail"> <i style="font-size:16px;" class="fa fa-eye"></i> </a> 		                           
                        
						 
                       <a href='#' onClick="returnrequest_confirm('<?php echo $res_returnlist->order_id;?>')" title="Approve Return Request"> <i class="fa fa-thumbs-o-up"></i> </a>
                       <a href='#' onClick="return_request_denied('<?php echo $res_returnlist->order_id;?>')" title="Deny Return Request"><i class="fa fa-exclamation-triangle"></i></a>

					</td> 
                            
                            </tr>
                            <?php } }else { ?>
                           
							<tr><td colspan="7" class="a-center">No Records Found ! </td></tr>
                            <?php } ?> 
					  </table>
                       <!-- </form>  -->           
            
      </div>
</div>            
            
      
            	
<?php
require_once('footer.php');
?>			