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
						<div class="col-md-8"><h3>Return Type: Wallet Detail</h3><span id="ss"></span></div>
						<div class="col-md-4 show_report"  >
                       <?php /*?> Order No.: <?php echo $order_id; ?><?php */?>
                      <span style="color:#F60; font-weight:bold;"> Buyer Name: </span><?= @$wallet_info[0]->fname. " ". @$wallet_info[0]->lname ; ?><br>
                       <span style="color:#F60; font-weight:bold;"> Wallet Balance:</span> Rs.<?= @$wallet_info[0]->wallet_balance ; ?>
							<!--<button type="button"  class="all_buttons">Create New Order</button>-->
						</div>
					</div>
                
                   <table class="table table-bordered table-hover">
								<tr bgcolor="#99CCFF">
									<th> Product  </th>	
									<!--<th> Buyer Name </th>-->
                                	<th> Return ID </th>
									<th> Return Type </th>									
									<th> Return Reason </th>
                                    <th>Return Date</th>
									<th> Seller Name</th>
									<th> Quantity </th>
                                    <th>  Amount </th>	
									
						
								</tr>
                               
                                <?php if(count($wallet_info)!=0){
									
									$alltot_amt=0; 
								foreach($wallet_info as $res_walletinfo)
								{ 
								?>
								
                                <tr>
									<td><?php @$image=explode(',',$res_walletinfo->imag); ?>
                                   <div style="float:left; width:15%;">  <img src="<?php echo base_url().'images/product_img/'.$image[0]; ?>" width="30" class="list_img"></div>
                                   
                                   <div style="float:left; width:90%;"> <?= $res_walletinfo->prd_name; ?> </div>
                                    </td>									
									<?php /*?><td> <?= $res_walletinfo->fname. " ". $res_walletinfo->lname ; ?> </td><?php */?>
									<td> <?= $res_walletinfo->return_id ; ?></td>
                                    <td><?= $res_walletinfo->return_typ ; ?></td>
									<td><?= $res_walletinfo->reason ; ?> </td>
									<td><?= $res_walletinfo->cdate ; ?> </td>									
									<td> <?= $res_walletinfo->business_name ; ?>  </td>
									<td> <?= $res_walletinfo->quantity ; ?> </td>
                                    <td>Rs. <?= $res_walletinfo->total_amount ; ?> </td>
									
									
									
								</tr>
                                
                               <?php $alltot_amt=$alltot_amt + $res_walletinfo->total_amount;} ?>
							   <tr><td colspan="7" style="text-align:right; font-weight:bold">Total Amount</td><td>Rs.<?php echo $alltot_amt; ?></td> </tr>
							   
							  <?php  }else {?>
                                
                               <tr><td colspan="8">No Records Found</td></tr>
								                             
                                <?php } ?>
                                </table>
                                
                                
                               <!--Product Purchased By Wallet --> 
                                
                                <div class="row content-header">
                                <div class="col-md-8"><h3>Product Purchased By Wallet</h3><span id="ss"></span></div>
						<div class="col-md-4 show_report"  >
                     
						</div>
					</div>
                
                   <table class="table table-bordered table-hover">
								<tr bgcolor="#99CCFF">
									<th> Product </th>	
									<!--<th> Buyer Name </th>-->
                                    <th> Order No. </th>
                                    <th>Seller</th>                                    
                                	<th> Quantity </th>
									<th> Amount </th>									
									<th> Payment Mode </th>
                                 
								</tr>
                               
                                <?php if(count($purchase_bywallet_info)!=0){
									
									$alltot_amt1=0; 
								foreach($purchase_bywallet_info as $res_purchwalletinfo)
								{ 
								?>
								
                                <tr>
                                
									<td><?php @$image=explode(',',$res_purchwalletinfo->imag); ?>
                                   <div style="float:left; width:15%;">  <img src="<?php echo base_url().'images/product_img/'.$image[0]; ?>" width="30" class="list_img"></div>
                                   
                                   <div style="float:left; width:90%;"> <?= $res_purchwalletinfo->prd_name; ?> </div>
                                    </td>
                                    <td><?php echo $res_purchwalletinfo->order_id; ?></td>
                                    <td><?php echo $res_purchwalletinfo->business_name; ?></td>									
									<?php /*?><td> <?= $res_walletinfo->fname. " ". $res_walletinfo->lname ; ?> </td><?php */?>
									<td> <?= $res_purchwalletinfo->quantity ; ?></td>
                                    <td>Rs.<?= $res_purchwalletinfo->sub_total_amount ; ?></td>
									<td>Wallet </td>
								
								</tr>
                                
                               <?php $alltot_amt1=$alltot_amt1 + $res_purchwalletinfo->sub_total_amount;} ?>
							   <tr><td colspan="5" style="text-align:right; font-weight:bold">Total Amount</td><td>Rs.<?php echo $alltot_amt1; ?></td> </tr>
							   
							  <?php  }else {?>
                                
                               <tr><td colspan="6" align="center" style="text-align:center;">No Records Found</td></tr>
								                             
                                <?php } ?>
                                </table>
                
                
                
                
                	</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->
                
 <?php
require_once('footer.php');
?>