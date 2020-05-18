<?php
require_once('header.php');
?>		
<link rel="stylesheet" href="<?php echo base_url();?>jquery_date_picker/jquery-ui.css">
<!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>-->
<script src="<?php echo base_url();?>jquery_date_picker/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">

<script>
 $(function() {
       $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" }).val()
  });

  $(function() {
	$( "#datepicker" ).datepicker();
  });
</script>
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
						<div class="col-md-8"><h3>Buyer Refund UTR Updation</h3><span id="ss"></span></div>
						<div class="col-md-4 show_report">
							
						</div>
					</div>
					
						
				  <div class="col-md-6 left" >
                  <form action="<?php echo base_url().'admin/payment/buyer_payout_datewise';?>" method="post">
                    Select Date : <input type="text" id="datepicker" name="srch_dt">
                         <input type="submit" value="Search" id="dt_sch_btn" class="all_buttons" style="float:none; margin-bottom:10px;">
                         </form>
					</div>
					
                     <div class="col-md-6 right">
                    <form action="<?php echo base_url().'admin/payment/update_utrbuyer_refund';?>" method="post" > 
				 <button type="submit" class="all_buttons" style="float:right;">Update UTR NO.</button>			
					
                   
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
                                  <th> UTR No. </th>
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
						   
						   
						    if(count($buyer_utrNotUpdatelist)!=0){
							   
							   foreach($buyer_utrNotUpdatelist as $res_returnlist)
							   { 
							    
							   
							   ?>
                            <tr> 
                            <td> 
							<input type="hidden" name="hidden_id[]" value="<?=$res_returnlist->return_id;?>">
							<?= $res_returnlist->order_id ?>  </td>
                            <td><?= $res_returnlist->fname. " ". $res_returnlist->lname  ?></td>
                            
                            <td>Rs.<?= $res_returnlist->total_amount ?>  </td>
                            
                            <td><?= $res_returnlist->bank_name ?> </td>
                            <td><?= $res_returnlist->Ac_holder_name ?> </td>
                            <td><?= $res_returnlist->Ac_no ?> </td>
                            <td><?= $res_returnlist->IFSC ?> </td>
                            <td> <?php if($res_returnlist->utr_number == ''){ ?>
									<input type="text" name="utr_no[]" class="text">
                                <?php }else{ ?>
                                	<?=$res_returnlist->utr_number;?>
                                    <input type="text" name="utr_no[]" class="text" style="display:none">
                                <?php }?>
                                 </td>
                            
                            <td>
                        <a href='<?php echo base_url().'admin/sales/view_request_detail/'.$res_returnlist->order_id ?>' title="View Return Request Detail"> <i style="font-size:16px;" class="fa fa-eye"></i> </a>     

					</td> 
                            
                            </tr>
                            <?php } }else { ?>
                           
							<tr><td colspan="8" class="a-center">No Records Found ! </td></tr>
                            <?php }  ?> 
					  </table>
                    
                        </form> 



  
</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->    

                
 <?php
require_once('footer.php');
?>