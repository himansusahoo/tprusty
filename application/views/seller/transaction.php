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
							<h3>Transactions</h3>
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
					<div>
						<span class="input-append">
							<strong class="inline-label">View:  </strong>
							<div class="btn-group" data-toggle="buttons-radio">
								<button class="btn active" style="background-color:#aaa;" type="button">Settled Transactions</button>
								<button class="btn" type="button" onClick="goUnsetteledTrans()">Unsettled Transactions</button>
							</div>
						</span>
						<!--Take tour-->
						<!--<span>
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
						</span>-->
					</div>
					<div class="row mt20 settelment_period">
						<form>
							<div class="input-append">
								<label id="settelment_period_label">Settlement Period : &nbsp </label>
								<div id="settelment_period_date">
									<input name="settlement_from_date" class="date_input" id="datepicker-example7-start">
									<input name="settlement_to_date" class="date_input" id="datepicker-example7-end">
									<input type="button" class="seller_buttons" value="Search" onclick="transBtnTwoDates()">
								</div>
							</div>
							<div class="downloadAsButton right">
								<!--<button class="btn">
									Download
									<span class="caret"></span>
								</button>-->
							</div>
						</form>
						<div class="note_update_current_date" style="display: inline-block;">
							<!--* Note: You can download transactions for maximum period of 1 month. It may take up to 2-3 days before settled transactions appear on dashboard.-->
						</div>
					</div>
					<div class="settelment_details_table">
						<table class="table table-hover">
							<tr>
								<th width="3%"></th>
								<th width="20%">Order ID</th>
								<th width="10%">SKU ID</th>
								<th width="10%">Order Date</th>
								<th width="15%">Order Status</th>
								<th width="15%">Order Item Value (Rs.)</th>
								<th width="12%">Settled Value (Rs.)</th>
								<th width="15%">Settlement Date</th>
							</tr>
<?php
	if($result){
		foreach($result as $row):
?>
							<tr id="searched_transaction">
								<!--<td>+</td>-->
                                <td></td>
								<td><?=$row->order_id;?></td>
								<td><?=$row->sku;?></td>
								<td>
									<?php
										$date=date_create($row->date_of_order);
										echo date_format($date, 'M d, Y');
									?>
								</td>
								<td><?=$row->product_order_status;?></td>
								<td><?=$row->sub_total_amount;?></td>
								<td><?=$row->fnal_settl_amt;?></td>
								<td><?=$row->pyt_genrted_dt;?></td>
							</tr>
<?php 
	endforeach;
}else{
?>
							<tr>
								<td colspan="8" class="a-center">No record found !</td>
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
	function transBtnTwoDates(){
		// Create Base64 Object
		var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/\r\n/g,"\n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}

		var from = $("#datepicker-example7-start").val();
		var to = $("#datepicker-example7-end").val();
		if(from == ""){
			$("#datepicker-example7-start").css('border','1px solid red');
			alert("Please enter from date.");
			return false;
		}else if(to == ""){
			$("#datepicker-example7-start").css('border','1px solid #ccc');
			$("#datepicker-example7-end").css('border','1px solid red');
			alert("Please enter from date.");
			return false;
		}else{
			window.location.href = '<?php echo base_url();?>seller/payments/searchTransByDates/'+Base64.encode(from)+'&'+Base64.encode(to);
		}
	}
</script>

<script>
function goUnsetteledTrans(){
	window.location.href='<?php echo base_url();?>seller/payments/unsetteledtransactions';
}
</script>

<?php
require_once('footer.php');
?>