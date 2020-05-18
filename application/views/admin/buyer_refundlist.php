<?php
require_once('header.php');
?>		

			<div id="content">
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_payment.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; 
						
						?>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
                
                
			<div class="row content-header">
						<div class="col-md-8"><h3>Buyer Refund List</h3><span id="ss"></span></div>
						<div class="col-md-4 show_report">
							
						</div>
					</div>
					
						
				  <div class="col-md-6 left" >
                  
					</div>
					 <!--<form action="" method="post" > -->
                     <div class="col-md-6 right">
                      	
				<button type="button"  class="all_buttons" onClick="window.location.href='<?php echo base_url().'admin/payment/update_utrno/' ?>' ">Update UTR Number </button>			
					
                   
					 <!-- <table class="multi_action">
							<tr>
								
								<td>
									
                            <input type="submit" class="all_buttons" value="Search" id="search"  />
							<input type="reset" class="all_buttons" value="Reset Filter" />
								</td>
							 </tr>
						</table>-->
                        </div>
                        <div class="clearfix"></div>
					
						<table class="table table-bordered table-hover">
                      
                            	<tr class="table_th">
								
								<th>Order ID</th>
                                <th>Buyer Name</th>
                                <th> Refund Amount </th>
                                 
                                 <th>Bank Name</th>
                                 <th>Account Holder Name</th>
                                 <th>Account No.</th>
                                  <th>IFSC Code</th>
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
                                   <input type="text" name="refund_amount" id="refund_amount" > 
                                    
								</td>
                                 
                                <td>
									<input type="text" name="bank_name" id="bank_name" >
								</td>
                                
                               
                                <td><input type="text" name="ac_holder_name" id="ac_holder_name" ></td>
                                
                                
                                <td><input type="text" name="ac_no" id="ac_no" ></td>
                                <td><input type="text" name="ifsc_code" id="ifsc_code" ></td>
                               <td></td> 
                                
							</tr>-->
                            
                           <?php
						   $refund_order_id_arr=array();
						   
						    if(count($buyer_refund)!=0){
							   
							   foreach($buyer_refund as $res_returnlist)
							   { 
							     array_push($refund_order_id_arr,$res_returnlist->order_id);
							   
							   ?>
                            <tr> 
                            <td> <?= $res_returnlist->order_id ?>  </td>
                            <td><?= $res_returnlist->fname. " ". $res_returnlist->lname  ?></td>
                            
                            <td>Rs.<?= $res_returnlist->total_amount ?>  </td>
                            
                            <td><?= $res_returnlist->bank_name ?> </td>
                            <td><?= $res_returnlist->Ac_holder_name ?> </td>
                            <td><?= $res_returnlist->Ac_no ?> </td>
                            <td><?= $res_returnlist->IFSC ?> </td>
                            
                            <td>
                        <a href='<?php echo base_url().'admin/sales/view_request_detail/'.$res_returnlist->order_id ?>' title="View Return Request Detail"> <i style="font-size:20px;" class="fa fa-eye"></i> </a>   
                          
<a href='#' onClick="conf_transferTo_wallet('<?php echo $res_returnlist->order_id ?>','<?php echo $res_returnlist->user_id ?>','<?php echo $res_returnlist->total_amount ?>')" title="Transfer To Wallet"> <img src='<?php echo base_url().'images/transfer_to_wallet.png' ?>' width="28px" height="28px"></a>
					</td> 
                            
                            </tr>
                            <?php } }else { ?>
                           
							<tr><td colspan="8" class="a-center">No Records Found ! </td></tr>
                            <?php }  ?> 
					  </table>
                    
                       <!-- </form>--> <?php if(count($buyer_refund)!=0){ ?>
<button type="button"  class="all_buttons" onClick="window.location.href='<?php echo base_url().'admin/payment/export_to_excel/'.implode(',',$refund_order_id_arr) ?>' ">Export To Excel </button>

<?php } ?>

<script>

function conf_transferTo_wallet(order_id,user_id,total_amount)
{
	var conf=confirm('Do you want to transfer refund amount to wallet ?' );
	if(conf)
	{
		window.location.href='<?php echo base_url().'admin/sales/transfer_to_wallet/' ?>' + order_id + '/' + user_id + '/' + total_amount ;	
	}	
}
</script>

  
</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->    

                
 <?php
require_once('footer.php');
?>