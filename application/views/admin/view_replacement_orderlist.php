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
						<div class="col-md-8"><h3>Replacement Orders List</h3><span id="ss"></span></div>
						<div class="col-md-4 show_report">
							<!--<button type="button"  class="all_buttons">Create New Order</button>-->
						</div>
					</div>
					
						
				  <div class="col-md-6 left" >	
										
					
					</div>
					 <form action="" method="post" >
                     <div class="col-md-6 right">
					  <table class="multi_action">
							<tr>
								
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
								
								<th >Order ID</th>
                                <th>Buyer Name</th>
                                
                                 <th>Return Type</th>
                                 <th>Seller Name</th>
								
								<th>Action</th>
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
                            
                           <?php if(count($order_refundlist!=0)){
							  
							   foreach($order_refundlist as $res_refundlist)
							   { ?>
                            <tr> 
                            <td> <?= $res_refundlist->order_id ?>  </td>
                            <td><?= $res_refundlist->fname. " ". $res_refundlist->lname  ?></td>
                           
                            <td> <?= $res_refundlist->return_typ ?> </td>
                            
                            <td><?= $res_refundlist->name ?></td>
                            
                            <td>
                        <a href='<?php echo base_url().'admin/sales/view_request_detail/'.$res_refundlist->order_id ?>' title="View Return Request Detail"> <i style="font-size:16px;" class="fa fa-eye"></i> </a> 		                           
                        
						 
                     <a  href="<?php echo base_url().'admin/sales/add_order_replacementinfo/'.$res_refundlist->order_id  ?>"   title="Replacement Order "><i style="font-size:16px;"  class="fa fa-recycle"></i></a>

					</td> 
                            
                            </tr>
                            <?php } }else { ?>
                           
							<tr><td colspan="5" class="a-center">No Records Found ! </td></tr>
                            <?php } ?> 
					  </table>
                        </form>             
                
                
                
                
                
                
                
                
      </div>
</div>            
            
            
            
            
            
            	
<?php
require_once('footer.php');
?>			