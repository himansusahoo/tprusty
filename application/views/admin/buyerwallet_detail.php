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