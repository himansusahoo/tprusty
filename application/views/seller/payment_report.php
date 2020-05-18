<?php
require_once('header.php');
?>
			<div id="content">    
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_reporttab.php'; ?>
					</div>
					<?php require_once('header_session.php'); ?>
				</div>  <!-- @end top-bar  -->
				
			
					<!--<div style="padding-top:60px; margin:0px 50px;">
						<div class="alert alert-danger" role="alert"> *Important ! You have not completed signup. To complete click <a href="<?php// echo base_url();?>seller/seller/incomplete_signup"><strong>here</strong></a></div>
					</div>-->
				
				
				<div class="main-content">
					<?php require_once('common.php'); ?>
					<div class="page_header">
						<div class="left">
							<h3>Payment Reports</h3>
						</div>
						<!--<div class="right order_id_search">
							<img class="partner_img" src="../images/partner-mobile-icon-new.png">
							<a href="#"> Lending Services </a>
							<div class="search_bar input-append">
								Settlement Ref No : 
								<input type="text" name="ref_no">
								<button type="submit"><span class="icon-search"></span></button>
							</div>
						</div>-->
						<div class="clear"></div>
					</div>
					<!--Take tour-->
					<!--<div class="row">
						<div class="payment_btn_group">
							<ul class="nav nav-tabs">
								<li class="no_tab">
									<span>
										<i class="icon-play"></i>
										<a href="#">Take a tour</a>
									</span>
								</li>
								<li class="no_tab" style="border-right: 1px solid #999999; margin-right: 10px; padding-right: 10px;">
									<span class="new_returns_policy">
										<i class="icon-info-sign"></i>
										<a href="#"> Understand payments better </a>
									</span>
								</li>
							</ul>
						</div>
					</div>-->
					<!--<div class="row table_blocks">-->
					<div class="row mt20">
						
					</div><!--Settled & Unsettled table-->
					<div class="row mt20 settelment_period" style="margin-bottom:20px;">
						<form>
							<div class="input-append">
								<!--<label id="settelment_period_label">Settlement Period:  </label>
								<input type="text" id="settelment_period_date" value="2015-07-23 - 2015-08-21">
								<i class="icon-calendar add-on"></i>-->
							</div>
							<div class="downloadAsButton right">
								<a href="<?php echo base_url();?>"><!--<button class="btn">-->
									<!--<i class="icon icon-download-alt"></i> &nbsp;Download-->
									<!--<span class="caret"></span>-->
								<!--</button>--></a>
							</div>
						</form>
						<!--<div class="note_update_current_date" style="display: inline-block;">
							* Note: Last updated at
							<span id="currentDate">19/08/2015</span>
							12.00 AM.
							<span id="disclaimer-note">Transfers made to your bank account may take up to 3-5 days before appearing on the dashboard.</span>
						</div>-->
					</div>
					<div class="settelment_details_table">
						<table class="table table-bordered table-hover">
							<tr>
								<th>Sl. No.</th>
								<th>Pay Out Gen. Date</th>
								<th>No of Orders</th>
								<th>Final stl Amt</th>
                                <th >Accnt. No</th>
                                <th>Bank Name</th>
                                <th>IFSC Code</th>
                                <th>Accnt. Holder Name</th>
                                <th>UTR No.</th>
                                <th>Status</th>
							</tr>
						<?php $ct=count($payment_reportresult);
								if($ct > 0){
									$i=1;
									foreach($payment_reportresult as $res_repo){
						 ?>
                          
                            <tr>
                            	<td><?=$i; ?></td>
                                <td><?=$res_repo->pyt_generated_dt; ?></td>
                                <td><?=$res_repo->no_of_orders; ?></td>                                
                                <td>Rs.<?=$res_repo->fnl_stl_amt; ?></td>
                                <td><?=$res_repo->bnk_acnt_no; ?></td>
                                <td><?=$res_repo->bnk_name; ?></td>                                
                                <td><?=$res_repo->bnk_ifsc_code; ?></td>
                                <td><?=$res_repo->acnt_hldr_name; ?></td>
                                <td><?=$res_repo->utr_no; ?></td>
                                <td><?=$res_repo->status; ?></td>
                            </tr>
                           <?php $i++; } //foreach end
						    }else{ ?> 
                            
                            <tr>
                            	<td colspan="9">No Record Found!</td>
                            </tr>
                            <?php } ?>
						</table>
						<!--<div>
							<button class="show_more_btn"><span>Show More</span></button>
						</div>-->
					</div>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->




<?php
require_once('footer.php');
?>