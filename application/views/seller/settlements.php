<?php
require_once('header.php');
?>
			<div id="content">    
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_payments.php'; ?>
					</div>
					<?php require_once('header_session.php'); ?>
				</div>  <!-- @end top-bar  -->
				
				<!-- 31 <?php
				$seller_signup_id = $this->session->userdata('seller-signup-session');
				if(!$seller_signup_id) : 
				?>
					<div style="padding-top:60px; margin:0px 50px;">
						<div class="alert alert-danger" role="alert"> *Important ! You have not completed signup. To complete click <a href="<?php// echo base_url();?>seller/seller/incomplete_signup"><strong>here</strong></a></div>
					</div>
				<?php endif; ?>-->
				
				<div class="main-content">
					<?php require_once('common.php'); ?>
					<div class="page_header">
						<div class="left">
							<h3>Payout</h3>
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
						<!--<div class="unsettled_box">
							<table class="table unsettlement_table">
								<tr>
									<th colspan="2">
										<span class="box_title">
											Total Unsettled Balance
											<a href="#"><i class="icon-info-sign"></i></a>
										</span>
									</th>
								</tr>
								<tr>
									<th colspan="2">
										<span class="note_text">
											Payment will be made only if account balance is positive.
											<a href="#"><i>Know more</i></a>
										</span>
									</th>
								</tr>
								<tr>
									<td style="width:50%;">
										<div class="row td_data">
											<div>
												<div>
													<a href="#">
														<i class="icon-inr"></i>
														8772.06
													</a>
												</div>
												<div><p>Prepaid</p></div>
											</div>
										</div>
									</td>
									<td style="width:50%;">
										<div class="row td_data no_border">
											<div>
												<div>
													<a href="#">
														<i class="icon-inr"></i>
														44044.67
													</a>
												</div>
												<div><p>Postpaid</p></div>
											</div>
										</div>
									</td>
								</tr>
							</table>
						</div>--><!-- Unsettled Box-->
						<!--<div class="settled_box">
							<table class="table settlement_table">
								<tr>
									<th colspan="3">
										<span class="box_title">
											Next Settlement Amount
											<a href="#"><i class="icon-info-sign"></i></a>
										</span>
									</th>
								</tr>
								<tr>
									<th colspan="3">
										<span class="note_text">
											It is an estimate amount and can change due to additional transactions before settlement date
										</span>
									</th>
								</tr>
								<tr>
									<th><div class="data_block">24th August 2015</div></th>
									<th><div class="data_block">26th August 2015</div></th>
									<th><div class="data_block no_border">28th August 2015</div></th>
								</tr>
								<tr>
									<td class="col-md-4">
										<div class="row td_data">
											<div class="one">
												<div>
													<a href="#">
														<i class="icon-inr"></i>
														2807.31
													</a>
													<p>Prepaid</p>
												</div>
											</div>
											<div class="two">
												<div>
													<a href="#">
														<i class="icon-inr"></i>
														15102.31
													</a>
													<p>Postpaid</p>
												</div>
											</div>
										</div>
									</td>
									<td class="col-md-4">
										<div class="row td_data">
											<div class="one">
												<div>
													<a href="#">
														<i class="icon-inr"></i>
														0
													</a>
													<p>Prepaid</p>
												</div>
											</div>
											<div class="two">
												<div>
													<a href="#">
														<i class="icon-inr"></i>
														0
													</a>
													<p>Postpaid</p>
												</div>
											</div>
										</div>
									</td>
									<td class="col-md-4">
										<div class="row td_data no_border">
											<div class="one">
												<div>
													<a href="#">
														<i class="icon-inr"></i>
														0
													</a>
													<p>Prepaid</p>
												</div>
											</div>
											<div class="two">
												<div>
													<a href="#">
														<i class="icon-inr"></i>
														0
													</a>
													<p>Postpaid</p>
												</div>
											</div>
										</div>
									</td>
								</tr>
							</table>
						</div>-->
					</div><!--Settled & Unsettled table-->
					<div class="row mt20 settelment_period" style="margin-bottom:20px;">
						<form>
							<div class="input-append">
								<!--<label id="settelment_period_label">Settlement Period:  </label>
								<input type="text" id="settelment_period_date" value="2015-07-23 - 2015-08-21">
								<i class="icon-calendar add-on"></i>-->
							</div>
							<div class="downloadAsButton right">
								<a href="<?php echo base_url();?>seller/payments/settelment_pdfgen"><!--<button class="btn">-->
									<i class="icon icon-download-alt"></i> &nbsp;Download
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
						<table class="table table-hover">
							<tr>
								<th>Settlement Date</th>
								<th>Bank Account</th>
								<th>Settlement Reference#</th>
								<th class="a-center">Settlement Value (Rs.)</th>
                                <th>Status</th>
							</tr>
							<!--<tr>
								<td>Aug 19, 2015</td>
								<td>XXXXXXXXXX3319</td>
								<td>
									<a href="#">NFT-150819038GN00128XXXXXXX</a>
								</td>
								<td>prepaid</td>
								<td class="a-center">3864.25</td>
							</tr>-->
                            <?php
							$settelment_data_row = $settelment_data->num_rows();
							if($settelment_data_row > 0){
								$sl=0;
								foreach($settelment_data->result() as $rows){
									$sl++;
							?>
                            <tr>
                            	<td><?=$rows->pyt_generated_dt;?></td>
                                <td><?=$rows->bnk_acnt_no;?></td>
                                <td>
                                	<a title="Click here to see the statement" href="<?php echo base_url(); ?>seller/payments/single_statement/<?= base64_encode($this->encrypt->encode($rows->settlmnt_refno));?>"><?=$rows->settlmnt_refno;?></a>&nbsp;<span title="Click here to see orderwise payout" class="plus_icn pls_expnd<?=$sl;?>" onClick="showSlrWisePayout('<?=$sl;?>','<?=$rows->settlmnt_refno;?>')">+</span>
                                    <span class="minus_icn minus_icn_squitch<?=$sl;?>" onClick="squitch('<?=$sl;?>')">-</span>
                                </td>
                                <td style="text-align:center !important;"><?=number_format($rows->fnl_stl_amt,2, ".", ",");?></td>
                                <td><?=$rows->status;?></td>
                            </tr>
                            <tr class="expndtr" id="expnd_tr<?=$sl;?>">
                            	<td colspan="5" id="load_ajx_data<?=$sl;?>"></td>
                            </tr>
                            <?php
								} //End of foreach loop
							 }else{?>
                            <tr>
                            	<td colspan="5">No Record Found!</td>
                            </tr>
                            <?php }?>
						</table>
						<!--<div>
							<button class="show_more_btn"><span>Show More</span></button>
						</div>-->
					</div>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->



<script>
function showSlrWisePayout(sl,settl_ref_no){
	$.ajax({
		url:'<?php echo base_url();?>seller/payments/get_slr_wise_payout',
		method:'post',
		data:{settl_ref_no:settl_ref_no},
		success:function(result){
			$('#expnd_tr'+sl).slideDown();
			$('.pls_expnd'+sl).hide();
			$('.minus_icn_squitch'+sl).show();
			$('#load_ajx_data'+sl).html(result);
		}
	});
}

function squitch(sl){
	$('#expnd_tr'+sl).slideUp();
	$('.pls_expnd'+sl).show();
	$('.minus_icn_squitch'+sl).hide();
}
</script>

<?php
require_once('footer.php');
?>