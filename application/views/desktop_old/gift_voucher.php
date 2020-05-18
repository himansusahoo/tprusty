<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content = "width = device-width, initial-scale =1.0, user-scalable = no">
		<meta name="description" content="">
        <meta name="Keywords" content=""/>
        
		<title>My Wallet</title>

<?php include "header.php" ?>

<!------ Start Content ------>

<div class="main-content">
<!--
	<div class="main-content_inn">
		<form name="persional_info_form" class="persional_info_form">
        	<input type="text">
        </form>
    </div>-->
		<div class="left-nav">
        	<?php include'profile_menu.php'; ?>
        </div>
    
    <div class="profile-right">
		
    	<h2 class="title3">Available Gift Vouchers</h2>
    	<!--<div id="load_form">-->
            
            <div class="tab-content form_view">
                <div id="tab1" class="tab-pane fade in active">
                    <div class="tab-l">
                        <div id="load_form">
            				<table class="table table-bordered table-hover">
								<tr bgcolor="#99CCFF">
                                	<th>SL. NO.</th>
									<th>Voucher Number</th>	
                                	<th>Perchase Amount</th>
									<th>Quantiny</th>									
									<th>Voucher Amount</th>
                                    <th>Voucher Discount</th>
                                    <th>Valid From</th>
                                    <th>Valid To</th>
								</tr>
                                <?php 
								if($gfv_result->num_rows() > 0){
									$sl=0;
									foreach($gfv_result->result() as $gfv_row){
										$sl++;
								?>
                                <tr>
									<td><?=$sl;?></td>
                                    <td><?=$gfv_row->voucher_no; ?></td>
									<td><?=$gfv_row->purchase_value; ?></td>
									<td><?=$gfv_row->qty; ?></td>									
									<td> <?=$gfv_row->amount; ?></td>
									<td> <?=$gfv_row->discount; ?></td>
                                    <td> <?=$gfv_row->valid_from; ?></td>
                                    <td> <?=$gfv_row->	valid_to; ?></td>
								</tr>
                              <?php } }else{?>
                               <tr><td colspan="8">No Records Found</td></tr>
                                <?php } ?>
                            </table>
                                
                               <!--Product Purchased By Wallet --> 
                                
                         <div class="row content-header">
                            <div class="col-md-8"><h3>Your Purchased Gift Vouchers</h3><span id="ss"></span></div>
                            <div class="col-md-4 show_report">
                 
                            </div>
						</div>
                
                   		<table class="table table-bordered table-hover">
                            <tr bgcolor="#99CCFF">
                                <th> SL. NO. </th>
                                <th> Voucher Number </th>
                                <th> Voucher Amount<br>(in Rs.) </th>
                                <th> Voucher Discount<br>(in %) </th>                                 
                                <th> Quantity </th>
                                <th> Valid From </th>
                                <th> Valid To </th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                         </table>
            
                        </div>
                    </div>
					<div class="clearfix"></div>
                    
                </div>
                <!--- end of tab1 id div --->
                                        
              </div>
              <!--- end of tab content --->          

        <!--</div>-->
        
    </div>

<div class="clearfix">&nbsp;</div>


<?php include "footer.php";?>