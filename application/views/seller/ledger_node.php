<?php
require_once('header.php');
?>
<!--- Zebra_Datepicker link start here ---->
<link href="<?php echo base_url();?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
<link href="<?php echo base_url();?>Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">
<!--<script src="<?php// echo base_url();?>Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script>-->
<script src="<?php echo base_url();?>Zebra_Datepicker-master/examples/public/javascript/core.js"></script>
<script src="<?php echo base_url();?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<!--- Zebra_Datepicker link end here ---->
<style>
	.Zebra_DatePicker_Icon{left: 110px !important; top: -1px !important;}
	.Zebra_DatePicker{ z-index:9999 !important;}
</style>

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
							<h3>Ledger</h3>
						</div>
						<!--<div class="right order_id_search">
							<form>
								<select>
									<option value="">Settlement Ref No</option>
									<option value="">Order ID</option>
								</select>
								<input name="transaction_id" type="text" placeholder="">
								<button type="submit"><span class="icon-search"></span></button>
							</form>
						</div>-->
						<div class="clear"></div>
					</div>
					<!--<div>
						<span class="input-append">
							<strong class="inline-label">View:  </strong>
							<div class="btn-group" data-toggle="buttons-radio">
								<button class="btn active" type="button">Settled Transactions</button>
								<button class="btn" type="button">Unsettled Transactions</button>
							</div>
						</span>
					</div>-->
					<div class="row mt20 settelment_period">
						<form>
							<div class="input-append">
								<label id="settelment_period_label">Transaction Period : &nbsp </label>
								<div id="settelment_period_date">
									<input name="settlement_from_date" class="date_input" id="datepicker-example7-start">
									<input name="settlement_to_date" class="date_input" id="datepicker-example7-end">
									<input type="button" class="seller_buttons" value="Search" onclick="ledgrBtnTwoDates()">
								</div>
							</div>
							<!--<div class="downloadAsButton right">
								<button class="btn">
									Download
									<span class="caret"></span>
								</button>
							</div>-->
						</form>
					</div>
					<div class="settelment_details_table">
						<table class="table table-hover">
							<tr>
								<th>Trans. Date</th>
                                <th>Reffer Id</th>
								<!--<th>Seller Id</th>-->
								<th>Trans. Type</th>
								<th>Debit Amount</th>
								<th>Credit Amount</th>
							</tr>
<?php
	if($result->num_rows() > 0){
		foreach($result->result() as $row):
?>
							<tr id="searched_transaction">
								<td><?=$row->trans_date;?></td>
								<td><?=$row->refer_id;?></td>
								<!--<td><?//=$row->seller_id;?></td>-->
								<td><?=$row->trans_type;?></td>
								<td><?=$row->DEBIT_AMT;?></td>
								<td><?=$row->CREDIT_AMT;?></td>
							</tr>
<?php 
	endforeach;
}else{
?>
							<tr>
								<td colspan="6" class="a-center">No record found!</td>
							</tr>
<?php
}
?>
						</table>
						<!--<div>
							<button class="show_more_btn"><span>Show More</span></button>
						</div>-->
					</div>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->
			

<script>
function ledgrBtnTwoDates(){
	var from = $("#datepicker-example7-start").val();
	var to = $("#datepicker-example7-end").val();
	if(from == ""){
		$("#datepicker-example7-start").css('border','1px solid red');
		alert("Please enter from date.");
		return false;
	}else if(to == ""){
		$("#datepicker-example7-start").css('border','1px solid #ccc');
		$("#datepicker-example7-end").css('border','1px solid red');
		alert("Please enter to date.");
		return false;
	}else{
		window.location.href='<?php echo base_url();?>seller/payments/ledger_daterange/'+from+'&'+to;
	}
}
</script>

<?php
require_once('footer.php');
?>