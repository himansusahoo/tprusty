<?php
require_once('header.php');
?>
			<div id="content">  
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_config.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
                	<?php
					$attributes = array('onSubmit' => 'return vaucherInfo()');
					echo form_open('admin/super_admin/get_voucher_data', $attributes);
					?>
                	<!--<form onSubmit="return membershipInfo()">-->
					<div class="row content-header">
						<div class="col-md-8"><b>Create Voucher</b><div id="ssmessg"><?= $this->session->flashdata('succss_msg'); ?></div></div>
						<div class="col-md-4 show_report">
							<button type="reset" class="all_buttons">Reset</button>
							<button type="submit" class="all_buttons">Save</button>
						</div>
					</div>
					<div class="form_view">
						<h3>Add Voucher Information</h3>
							<table>
								<tr>
									<td style="width:20%;"> Generate Type <sup>*</sup> </td>
									<td>
                                    	<select name="gen_type" id="gen_type" class="text2" onChange="DisableVoucherField(this.value)">
                                        	<option value="">---select---</option>
                                        	<option value="0">Random</option>
                                            <option value="1">Series</option>
                                        </select>
                                    </td>
								</tr>
								<tr>
									<td> Voucher Number <sup>*</sup> </td>
									<td>
                                    	<input type="text" class="text2" placeholder="Enter Prefix" name="v_prifx" id="v_prifx" style="width:240px;">
                                        <input type="text" class="text2" placeholder="Enter Number" name="v_number" id="v_number" style="width:240px;">
                                   	</td>
								</tr>
								<tr>
									<td> Purchase Amount <sup>*</sup></td>
									<td><input type="text" class="text2" name="purchase_amt" id="purchase_amt"></td>
								</tr>
                                <tr>
									<td> Voucher Avail Amount / Discount <sup>*</sup><br/><span class="warng">(Fill up only one field)</span></td>
									<td>
                                    	Rs . <input type="text" class="text2" name="voucher_amt" id="voucher_amt" style="width:200px;"> &nbsp;OR&nbsp;
                                        <input type="text" class="text2" name="voucher_percent" id="voucher_percent" style="width:200px;"> %
                                    </td>
								</tr>
								<tr>
									<td> Voucher Quantity <sup>*</sup></td>
									<td><input type="text" class="text2" name="qty" id="qty"></td>
								</tr>
                                <tr>
									<td> Validity Date <sup>*</sup></td>
									<td>
                                        From <input type="text" id="datepicker-example7-start" class="text2 dt" name="from_dt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        To <input type="text" id="datepicker-example7-end" class="text2 dt" name="to_dt">
                                    </td>
								</tr>
							</table>
					</div>
                    <?php echo form_close(); ?>
                    
                    <?php $sl=0 ;if($voucher_details->num_rows() > 0){ ?>
                    <h4 style="margin-top:30px;">Voucher Details</h4>
                    <table class="table table-hover">
                    	<tr>
                        	<th>SL NO.</th>
                            <th>Voucher Number</th>
                            <th>Perchase Amount</th>
                            <th>Total Qty</th>
                            <th>Issue Qty</th>
                            <th>Discount</th>
                            <th>Amount</th>
                            <th>Validity Date</th>
                            <th></th>
                        </tr>
                        <?php foreach($voucher_details->result() as $vchr_row){$sl++; ?>
                        <tr>
                        	<td><?=$sl;?></td>
                            <td><?=$vchr_row->voucher_no;?></td>
                            <td>Rs.<?=$vchr_row->purchase_value;?></td>
                            <td><?=$vchr_row->qty;?></td>
                            <td><?=$vchr_row->issued;?></td>
                            <td><?=$vchr_row->discount;?></td>
                            <td>Rs.<?=$vchr_row->amount;?></td>
                            <td><?=$vchr_row->valid_from .' &nbsp;To&nbsp; '. $vchr_row->valid_to;?></td>
                            <td><span class="dl_spn" onClick="DeleteVoucher(<?=$vchr_row->id;?>)"><i class="fa fa-trash-o"></i></span></td>
                        </tr>
                        <?php } ?>
                    </table>
                    <?php } ?>
				</div><!--   End of Main-content  -->
		</div><!-- @end #content -->


<style>
.dt{ width:170px;}
.Zebra_DatePicker_Icon {left: 150px !important;top: 8px !important;}
.Zebra_DatePicker{ z-index:9999;}
.warng {float: right;font-size: 12px;margin-right: 35px;}
.dl_spn{cursor:pointer;}
.dl_spn:hover{color:#fbbc6b;}
</style>

<!--- Zebra_Datepicker link start here ---->
<!--<script src="<?php// echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script>-->
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
<!--<link href="<?php// echo base_url(); ?>Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">-->
<!--- Zebra_Datepicker link end here ---->
        
<script>
function DisableVoucherField(val){
	if(val == 0){
		$('#v_prifx').prop('disabled', true);
		$('#v_number').prop('disabled', true);
	}else if(val == 1){
		$('#v_prifx').prop('disabled', false);
		$('#v_number').prop('disabled', false);
	}
}


function vaucherInfo(){
	var gen_type = $('#gen_type').val();
	var vchr_prifx = $('#v_prifx').val();
	var vchr_no = $('#v_number').val();
	var perchase_amt = $('#purchase_amt').val();
	var avail_amt = $('#voucher_amt').val();
	var avail_percent = $('#voucher_percent').val();
	var qty = $('#qty').val();
	var from_dt = $('#datepicker-example7-start').val();
	var to_date = $('#datepicker-example7-end').val();
	
	if(gen_type == ''){
		alert('Please select voucher generate type.');
		return false;
	}else if(gen_type == 1 && vchr_prifx == ''){
		alert('Please enter voucher prifix code.');
		$('#v_prifx').focus();
		return false;
	}else if(gen_type == 1 && vchr_no == ''){
		alert('Please enter voucher number.');
		$('#v_number').focus();
		return false;
	}else if(perchase_amt == ''){
		alert('Please enter perchase amount.');
		$('#purchase_amt').focus();
		return false;
	}else if(isNaN(perchase_amt)){
		alert('Invalid perchase amount.');
		$('#purchase_amt').select();
		return false;
	}else if(avail_amt == '' && avail_percent == ''){
		alert('Please enter voucher available amount or percentage.');
		$('#voucher_amt').focus();
		return false;
	}else if(avail_amt != '' && avail_percent != ''){
		alert('Fill up only one field.');
		$('#voucher_amt').select();
		$('#voucher_percent').select();
		return false;
	}else if(qty == ''){
		alert('Please enter quantity.');
		$('#qty').focus();
		return false;
	}else if(from_dt == ''){
		alert('Please select validity start date.');
		$('#datepicker-example7-start').focus();
		return false;
	}else if(to_date == ''){
		alert('Please select validity end date.');
		$('#datepicker-example7-end').focus();
		return false;
	}
}

function DeleteVoucher(id){
	$.ajax({
		url:'<?php echo base_url();?>admin/super_admin/delete_voucher',
		method:'post',
		data:{id:id},
		success:function(result){
			if(result == 'success'){
				window.location.reload(true);
			}
		}
	});
}
</script>
<?php
require_once('footer.php');
?>	