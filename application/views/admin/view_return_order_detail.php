<?php
require_once("header.php");
?>


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
						<div class="col-md-8"><h3>Return Request Detail</h3><span id="ss"></span></div>
						<div class="col-md-4 show_report">
                        Order No.: <?php echo $order_id; ?>
							<!--<button type="button"  class="all_buttons">Create New Order</button>-->
						</div>
					</div>
                
                   <table class="table table-bordered table-hover">
								<tr bgcolor="#99CCFF">
									<th> Product Name </th>	
									<th> Buyer Name </th>
                                	<th> Return ID </th>
									<th> Return Type </th>									
									<th> Return Reason </th>
                                    <th>Return Date</th>
									<th> Seller Name</th>
									<th> Quantity </th>
                                    <th> Total Amount </th>	
									
						
								</tr>
                               
                                <?php if(count($return_info)!=0){ 
								foreach($return_info as $res_returninfo)
								{
								?>
								
                                <tr>
									<td><?php @$image=explode(',',$res_returninfo->imag); ?>
                                   <div style="float:left; width:15%;">  <img src="<?php echo base_url().'images/product_img/'.$image[0]; ?>" width="30" class="list_img"></div>
                                   
                                   <div style="float:left; width:90%;"> <?= $res_returninfo->name; ?> </div>
                                    </td>									
									<td> <?= $res_returninfo->fname. " ". $res_returninfo->lname ; ?> </td>
									<td> <?= $res_returninfo->return_id ; ?></td>
                                    <td><?= $res_returninfo->return_typ ; ?></td>
									<td><?= $res_returninfo->reason ; ?> </td>
									<td><?= $res_returninfo->cdate ; ?> </td>									
									<td> <?= $res_returninfo->seller_name ; ?>  </td>
									<td> <?= $res_returninfo->quantity ; ?> </td>
                                    <td>Rs. <?= $res_returninfo->total_amount ; ?> </td>
									
									
									
								</tr>
                                
                               <?php } }else {?>
                                
                               <tr><td colspan="9">No Records Found</td></tr>
								                             
                                <?php } ?>
                                </table>
                
                
                
                
                	</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->
            

         
            
            
            
            
            
            	
<?php require_once('footer.php') ?> 