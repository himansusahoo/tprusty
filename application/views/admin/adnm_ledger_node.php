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
						<?php include 'sub_payment.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
					<div class="row content-header">
					<div class="col-md-8"> <h3>Transaction Ledger</h3> </div>
					<div class="col-md-4 show_report">
                   <!--<button type="button" class="all_buttons" onClick="window.location.href='<?php// echo base_url().'admin/catalog/addnew_product' ?>'">Add Product</button>-->
                     </div>
                
					</div>
                    
                    <div class="col-md-6">
                    	<div class="input-append">
                            <label id="settelment_period_label">Transaction Period <sup>*</sup>: &nbsp </label>
                            <div id="settelment_period_date">
                                <input name="settlement_from_date" class="date_input" id="datepicker-example7-start">
                                <input name="settlement_to_date" class="date_input" id="datepicker-example7-end">
                                <input type="button" class="seller_buttons" value="Search" onclick="ledgrBtnTwoDates()">
                            </div>
						</div>
                    </div>
                    
				    <div class="col-md-6 left">
                        <table class="multi_action">
							<tr>
								<td>
                                    <div class="right" style="visibility:hidden;">
                                        <input type="submit" class="all_buttons" value="Search" id="search"  />
                                        <input type="reset" class="all_buttons" value="Reset Filter" />
                                    </div>
								</td>
							</tr>
						</table>
					</div>
					<div class="clearfix"></div>
					<div>
						<table class="table table-bordered table-hover">
							<tr class="table_th">
								<th>Trans. Date</th>
                                <th>Seller Id</th>
								<th>Reffer Id</th>
								<th>Trans. Type</th>
								<th>Debit Amount</th>
								<th>Credit Amount</th>
							</tr>
							<tr class="filter_tr">
								<td></td>
								<td></td>
                                <td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
                            <?php
							if($result->num_rows() > 0){
							 foreach($result->result() as $rows){
							?>
                            <tr>
								<td><?=$rows->trans_date;?></td>
                                <td><?=$rows->seller_id;?></td>
								<td><?=$rows->refer_id;?></td>
								<td><?=$rows->trans_type;?></td>
								<td><?=$rows->DEBIT_AMT;?></td>
								<td><?=$rows->CREDIT_AMT;?></td>
							</tr>
                            <?php } }else{?>
                            <tr>
                            	<td colspan="6">No Records Found.</td>
                            </tr>
                            <?php }?>
						</table>
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
		window.location.href='<?php echo base_url();?>admin/payment/ledger_daterange/'+from+'&'+to;
	}
}
</script>

<?php
require_once('footer.php');
?>			