<?php
require_once('header.php');
?>

<!--- Zebra_Datepicker link start here ---->
<link href="<?php echo base_url();?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
<link href="<?php echo base_url();?>Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">
<!--<script src="<?php echo base_url();?>Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script>-->
<script src="<?php echo base_url();?>Zebra_Datepicker-master/examples/public/javascript/core.js"></script>
<script src="<?php echo base_url();?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<!--- Zebra_Datepicker link end here ---->
<style>
	.Zebra_DatePicker_Icon{left: 110px !important; top: 0px !important;}
	.ng-scope{ font-size:12px; color:#999;}
	.Zebra_DatePicker{ z-index:9999;}
</style>

<style>
.wrapper {
  background: #ececec;
  font-family: "Gill Sans", Impact, sans-serif;
  /*position: relative;*/
  text-align: center;
  width: 0px;
  float: right;
  right: 55px;
  cursor: default;
  -webkit-transform: translateZ(0); /* webkit flicker fix */
  -webkit-font-smoothing: antialiased; /* webkit text rendering fix */
}
.wrapper {
	left: -180px !important;
    position: relative;
    top: 0 !important;
}
.wrapper .tooltip {
  background: #1496bb;
  bottom: 0;
  color: #fff;
  display: block;
  left: 30px;
  margin-bottom: 0px;
  opacity: 0;
  padding: 10px;
  pointer-events: none;
  position: absolute;
  width: 275px;
  -webkit-transform: translateY(10px);
     -moz-transform: translateY(10px);
      -ms-transform: translateY(10px);
       -o-transform: translateY(10px);
          transform: translateY(10px);
  -webkit-transition: all .25s ease-out;
     -moz-transition: all .25s ease-out;
      -ms-transition: all .25s ease-out;
       -o-transition: all .25s ease-out;
          transition: all .25s ease-out;
  -webkit-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
     -moz-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
      -ms-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
       -o-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
          box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
}

/* This bridges the gap so you can mouse into the tooltip without it disappearing */
.wrapper .tooltip:before {
  bottom: -20px;
  content: " ";
  display: block;
  height: 20px;
  left: 0;
  position: absolute;
  width: 100%;
}  

/* CSS Triangles - see Trevor's post */
.wrapper .tooltip:after {
  border-left: solid transparent 10px;
  border-right: solid #1496bb 10px;
  border-top: solid transparent 10px;
  border-bottom: solid transparent 10px;
  bottom: 7px;
  content: " ";
  height: 0;
  left: -7px;
  margin-left: -13px;
  position: absolute;
  width: 0;
}
  
.wrapper:hover .tooltip {
  opacity: 1;
  pointer-events: auto;
  -webkit-transform: translateY(0px);
     -moz-transform: translateY(0px);
      -ms-transform: translateY(0px);
       -o-transform: translateY(0px);
          transform: translateY(0px);
}

/* IE can just show/hide with no transition */
.lte8 .wrapper .tooltip {
  display: none;
}

.lte8 .wrapper:hover .tooltip {
  display: block;
}
.fa-question-circle {
  font-size: 15px;
}
.wrapper{left:5px; top:5px; position:relative;}
</style>

<script>
	$(document).ready(function(){
		$('#utr_number').prop('disabled', true);
		
		$('#statement_radio_true').click(function(){
			$('#utr_number').prop('disabled', true).addClass('readonly_field');
			$('#ac_type').prop('disabled', false).removeClass('readonly_field');
			$('#datepicker-example7-start').prop('disabled', false).removeClass('readonly_field');
			$('#datepicker-example7-end').prop('disabled', false).removeClass('readonly_field');
		});
		$('#statement_radio_false').click(function(){
			$('#ac_type').prop('disabled', true).addClass('readonly_field');
			$('#datepicker-example7-start').prop('disabled', true).addClass('readonly_field');
			$('#datepicker-example7-end').prop('disabled', true).addClass('readonly_field');
			$('#utr_number').prop('disabled', false).removeClass('readonly_field');
		});
	});
	
	function getStatement(){
		var base_url = '<?php echo base_url();?>';
		var controller = 'seller/payments/';
		var button_value = $('input[name="statement_radio"]:checked').val(); 
		if(button_value == 'statement_radio_first'){ 
			var ac_type = $('#ac_type').val();
			var from_date = $('#datepicker-example7-start').val();
			var to_date = $('#datepicker-example7-end').val();
			$.ajax({
				url : base_url+controller+'getStatementDetailsByDate',
				type : 'POST',
				data : {ac_type:ac_type,from_date:from_date,to_date:to_date},
				'success' : function(data){
					$('#searched_statement_details').html(data);
				}
			});
		}else{ 
			var utr = $('#utr_number').val();
			$.ajax({
				url : base_url+controller+'getStatementDetailsByUTR',
				type : 'POST',
				data : {utr:utr},
				'success' : function(data){
					$('#searched_statement_details').html(data);
				}
			});
		}
	}
</script>

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
						<div class="alert alert-danger" role="alert"> *Important ! You have not completed signup. To complete click <a href="<?php echo base_url();?>seller/seller/incomplete_signup"><strong>here</strong></a></div>
					</div>
				<?php endif; ?>-->
				
				<div class="main-content">
					<?php require_once('common.php'); ?>
					<div class="page_header">
						<div class="left">
							<h3>Statements</h3>
						</div>
						<div class="clear"></div>
					</div>
					<div class="row">
						<div class="row statement_filter">
							<div class="statement_filter_container">
								<div class="type_date_filter">
									<div class="left filter_radio">
										<!--<input type="radio" name="statement_radio" id="statement_radio_true" value="statement_radio_first" checked>-->
									</div>
									<!--<span class="">Enter type and date range</span>-->
                                     Type : 
                                        <select name="payput_typ" id="payput_typ">
                                        	<option value="All">All</option>
                                        	<option value="Paid">Paid</option>
                                            <option value="Pending">Pending</option>
                                        </select>
							
                                         
									<div class="left"></div>
									
									<div class="right">  
										Date range :
										<input name="statement_from_date" class="date_input" id="datepicker-example7-start">
										<input name="statement_to_date" class="date_input" id="datepicker-example7-end">
									</div>
									<div class="clear"></div>  
								</div>
								<div class="wrapper">
									<div class="line"></div>
									<!--<div class="wordwrapper">
										<div class="word">or</div>
									</div>-->
								</div>
								<div class="type_date_filter">
									<div class="left filter_radio">
										<!--<input type="radio" name="statement_radio" id="statement_radio_false" value="statement_radio_second">-->
									</div>
									<!--<span class="">Enter settlement reference number</span>-->
									<!--<div class="clear"></div> --> 
									<!--<input type="text" class="seller_input" id="utr_number" placeholder="UTR Number">
									<input class="right seller_buttons" type="button" value="Generate" onclick="getStatement()">-->
                                    <input class="right seller_buttons" type="button" value="Generate" onClick="getFiltrStatement()">
								</div>
								<div class="clear"></div>
							</div>
						</div>
						<div class="statement_details">
							<div class="note_update_current_date" style="display: inline-block;">
								<!--* Note: Statements are available only for durations after 15th April 2015-->
							</div>
							<div class="row stempt_for_invalid_date">
								<div class="col-md-10">
									<!--<span>Statement for Invalid date (PREPAID AND POSTPAID)</span>-->
                                     <?php
									if($this->uri->segment(5) != ''){
										$date_range_arr = explode('&',$this->uri->segment(5));
										$from_dt = $date_range_arr[0];
										$to_dt = $date_range_arr[1];
									?>
                                    <span><?=$this->uri->segment(4);?>&nbsp;Statements from Date: <?=$from_dt;?> &nbsp;&nbsp;To: <?=$to_dt;?></span>
                                    <?php } ?>
								</div>
								<div class="col-md-2">
									<!--<a href="#">Know More <i class="icon-info-sign"></i></a>-->
									<a href="<?php echo base_url();?>seller/payments/statements_pdfgen"><i class="icon icon-download-alt"></i> Download</a>
								</div>
								<table class="table table-striped statement_table" style="border:1px solid #ccc;" id="searched_statement_details">
                                <?php
								if($statement_data != false){
								?>
									<!--<tr>
										<td colspan="2">
											<div class="right">
												<a href="#">View Settlements</a>
												<span> | </span>
												<a href="#">View Transactions</a>
											</div>
											
										</td>
									</tr>-->
									<tr>
										<td colspan="2">
											<strong>Settled balance</strong>
											<!--<i class="icon icon-question-sign ng-scope"></i>-->
										</td>
									</tr>
									<tr>
										<td class="settelment_details_table" colspan="2">
											<table class="table table-hover statement_desc_table">
												<tr>
													<th>Description</th>
													<th>Credits(<i class="icon icon-inr"></i>)</th>
													<th>Debits(<i class="icon icon-inr"></i>)</th>
													<th>Net settled amount(<i class="icon icon-inr"></i>)</th>
												</tr>
												<tr>
													<td>Sale Amount <div class="wrapper"><i class="icon icon-question-sign ng-scope"></i><div class="tooltip">Total sale amount of product</div></div></td>
													<td><?=number_format($statement_data[0]->TOTAL_SALE_AMT,2, ".", ",");?></td>
													<td></td>
													<td><?=number_format($statement_data[0]->TOTAL_SALE_AMT,2, ".", ",");?></td>
												</tr>
												<!--<tr>
													<td>Refunds <i class="icon icon-question-sign ng-scope"></i></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>-->
												<tr>
													<td>Offer Amount <div class="wrapper"><i class="icon icon-question-sign ng-scope"></i><div class="tooltip">Total discount amount</div></div></td>
													<td><?=number_format($statement_data[0]->TOTAL_DISCOUNT_AMT,2, ".", ",");?></td>
													<td></td>
													<td></td>
												</tr>
												<tr>
													<td>Commission <div class="wrapper"><i class="icon icon-question-sign ng-scope"></i><div class="tooltip">Commission in product category</div></div></td>
													<td></td>
													<td><?=number_format($statement_data[0]->TOTAL_COMMISION,2, ".", ",");?></td>
													<td></td>
												</tr>
												<tr>
													<td>Fixed Fee <div class="wrapper"><i class="icon icon-question-sign ng-scope"></i><div class="tooltip">Amount Product Selling Price</div></div></td>
													<td></td>
													<td><?=number_format($statement_data[0]->TOTAL_FIXED_FEE,2, ".", ",");?></td>
													<td></td>
												</tr>
                                                <?php 
												if($statement_data[0]->TOTAL_SEASON_FEE != 0){ 
												?>
                                                <tr>
													<td>Seasonal Fee <div class="wrapper"><i class="icon icon-question-sign ng-scope"></i><div class="tooltip">Amount or Percentage of Product Selling Price</div></div></td>
													<td></td>
													<td><?=number_format($statement_data[0]->TOTAL_SEASON_FEE,2, ".", ",");?></td>
													<td></td>
												</tr>
                                                <?php } ?>
                                                <tr>
													<td>P.G Fee <div class="wrapper"><i class="icon icon-question-sign ng-scope"></i><div class="tooltip">Percentage Product of Selling Price</div></div></td>
													<td></td>
													<td><?=number_format($statement_data[0]->TOTAL_PG_FEE,2, ".", ",");?></td>
													<td></td>
												</tr>
												<tr>
													<td>Service Tax <div class="wrapper"><i class="icon icon-question-sign ng-scope"></i><div class="tooltip">Percentage of Total deducted Amount .<br/>( commission + fixed charges + P.G charges + seasonal charges + service tax )</div></div></td>
													<td></td>
													<td><?=number_format($statement_data[0]->TOTAL_SERVC_TAX,2, ".", ",");?></td>
													<td></td>
												</tr>
												
											</table>
										</td>
									</tr>
									<tr>
										<td>
											<b>Total settled amount </b>
										</td>
										<td class="right">
											<b>
												<i class="icon icon-inr set-icon"></i>
												<?=number_format($statement_data[0]->TOTAL_FNL_STL_AMT,2, ".", ",");?>
											</b>
										</td>
									</tr>
                                    <?php }else{?>
                                    <tr>
                                    	<td colspan="4">No Record Found!</td>
                                    </tr>
                                    <?php } ?>
								</table>
							</div>
						</div>
					</div>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->

<script>
function getFiltrStatement(){
	var payout_typ = $('#payput_typ').val();
	var from_date = $('#datepicker-example7-start').val();
	var to_date = $('#datepicker-example7-end').val();
	/*if(from_date == '' && to_date == ''){
		alert('Please enter both date range.');
		return false;
	}else{
		window.location.href='<?php// echo base_url();?>seller/payments/daterengestatements/'+ payout_typ +'/'+from_date+'&'+to_date
	}*/
	if(from_date != ''){
		if(to_date == ''){
			alert('Please enter both date range.');
			return false;
		}else{
			window.location.href='<?php echo base_url();?>seller/payments/daterengestatements/'+ payout_typ +'/'+from_date+'&'+to_date
		}
	}
	else if(to_date != ''){
		if(from_date == ''){
			alert('Please enter both date range.');
			return false;
		}else{
			window.location.href='<?php echo base_url();?>seller/payments/daterengestatements/'+ payout_typ +'/'+from_date+'&'+to_date
		}
	}
	else if(from_date == '' && to_date == ''){
		window.location.href='<?php echo base_url();?>seller/payments/daterengestatements/'+ payout_typ ;
	}
}
</script>
<?php
require_once('footer.php');
?>