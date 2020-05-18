<?php
require_once('header.php');
?>		

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
					<div class="col-md-8"> <h3>Payout</h3> </div>
					<div class="col-md-4 show_report">
                   <!-- <button type="button" class="all_buttons" onClick="window.location.href='<?php// echo base_url().'admin/catalog/addnew_product' ?>'">Add Product</button>-->
                     </div>
                
					</div>
					<form action="<?php echo base_url().'admin/payment/update_transaction_data' ?>" method="post" >
                    
                    <div class="col-md-6">
						<?php
                        $payout_row = $payout_result->num_rows();
                        if($payout_row > 0){
                        ?> 
                         <input type="submit" class="all_buttons" name="payout_generate" value="Generate Payout" style="float:left !important;">
                         <?php }else{ ?>
                         <input type="button" class="all_buttons_disable" value="Generate Payout" style="float:left !important;" onClick="alert('No data available for Payout Generation.')">
                         <?php }?>
                         <input type="button" class="all_buttons" name="export_excl" value="Export Payout" onClick="exportPayoutReport()" style="float:left !important;">
                          <input type="button" class="all_buttons" name="export_excl" value="Export Seller Payout" onClick="exportSlrPayoutReport()" style="float:left !important;">
                         
                         <?php /*?><?php if($this->uri->segment(3) == 'download_excel'){?>
                         <input type="button" id="dwn_btn1" class="all_buttons" name="export_excl" value="Doenload Total Report" onClick="window.location.href='<?php echo base_url();?>excel_downloaded/payout_report.xls'" style="float:left !important;">
                         
                         <input type="button" id="dwn_btn2" class="all_buttons" name="export_excl" value="Doenload Slr Payout" onClick="window.location.href='<?php echo base_url();?>excel_downloaded/slr_payout_report.xls'" style="float:left !important;">
                         <?php }?><?php */?>
                         
                         <span style="float:right; color:#090;"><?=$this->session->flashdata('succ_msg');?></span>
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
								<th>Seller Name</th>
								<th>Seller ID</th>
								<th>Sale Value</th>
								<th>Order ID.</th>
								<th>Fixed charges</th>
								<th>Seasonal charges</th>
								<th>PG charges</th>
								<th>Commission</th>
								<th>Service Tax</th>
                                <th>Penalty</th>
								<th>settlement amount</th>
								<th>Discount<br/>(in Amount)</th>
								<th>Final Settlement amount</th>
							</tr>
							<tr class="filter_tr">
								<td></td>
								<td></td>
                                <td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
                                <td></td>
								<td></td>
								<td></td>
                                <td></td>
								<td></td>
								<td></td>
							</tr>
                            <?php
							$payout_row = $payout_result->num_rows();
							if($payout_row > 0){
								$sl=0;
							 foreach($payout_result->result() as $rows){
								 $sl++; 
							?>
                            <tr>
								<td><?=$rows->business_name;?></td>
								<td>
									<?=$rows->seller_id;?>
                                    <input type="hidden" name="hidden_slr_id[]" value="<?=$rows->seller_id;?>">
                                </td>
                                <td><?=$rows->sale_value;?></td>
								<td><?=$rows->order_no;?></td>
								<td><?=$rows->fixed_chgs;?></td>
								<td><?=$rows->season_chgs;?></td>
								<td><?=$rows->pg_chgs;?></td>
                                <td><?=$rows->commission;?></td>
								<td><?=$rows->service_tax;?></td>
                                <td><?=$rows->penalty;?></td>
								<td>
                                <?php
								$total_deduct_amt = $rows->fixed_chgs+$rows->season_chgs+$rows->pg_chgs+$rows->commission+$rows->service_tax+$rows->penalty;
								$settlement_value = $rows->sale_value-$total_deduct_amt;
								echo $settlement_value;
								?>
                                <input type="hidden" name="hidden_id[]" value="<?=$rows->id;?>">
                                <input type="hidden" name="stl_amt[]" value="<?=$settlement_value;?>">
                                </td>
								<td style="text-align:center;" width="12px">
                                	<input type="text" name="discount[]" id="discount<?=$sl;?>" value="<?=$rows->discount;?>" style="width:50px;">
                                    <span class="edt" id="dcnt_spn<?=$sl;?>" onClick="UpdateDiscount(<?=$sl;?>,'<?=$rows->id;?>')">Calculate</span>
                                     <!--<span class="edt" id="dcnt_spn<?//=$sl;?>" onClick="UpdateDiscount(<?//=$sl;?>,'<?//=$rows->order_no;?>')">Calculate</span>-->
                                </td>
								<td>
                                <?php
								if($rows->discount !=0){
									/*$discount_decimal = $rows->discount/100;
									$discount_amt = round($settlement_value*$discount_decimal);*/
									$discount_amt = $rows->discount;
									//$final_deduct_amt = $total_deduct_amt-$discount_amt;
									$final_settelment_amt = $settlement_value+$discount_amt;
									echo $final_settelment_amt;
								}else{
									$final_settelment_amt = $settlement_value;
								}
								?>
                                <input type="hidden" name="fnl_stl_amt[]" value="<?=$final_settelment_amt;?>">
                                </td>
							</tr>
                            <?php } }else{?>
                            <tr>
                            	<td colspan="13">No Records Found.</td>
                            </tr>
                            <?php }?>
						</table>
					</div>
                 </form>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->    


<style>
.all_buttons_disable{
	background-color: #b6b4b4;
    border: 0 none;
    color: #fff;
    float: right;
    font-size: 12px;
    margin: 0 5px;
    padding: 3px 8px;
}
.all_buttons_disable:hover{background-color: #b6b4b4;}
</style>
<script>
function UpdateDiscount(sl,id){
	var discount_percent = $('#discount'+sl).val();
	if(discount_percent == '' || discount_percent == 0){
		alert('Please enter discount percent.');
		$('#discount'+sl).focus();
		return false;
	}else if(isNaN(discount_percent)){
		alert('Please enter a valid percent.');
		$('#discount'+sl).select();
		return false;
	}else{
		$('#dcnt_spn'+sl).css({"color":"#ccc","cursor":"not-allowed"});
		$.ajax({
			url:'<?php echo base_url();?>admin/payment/update_settelment_discount',
			method:'post',
			data:{discount:discount_percent,id:id},
			success:function(result){
				if(result == 'success'){
					window.location.reload(true);
				}
			}
		});
	}
}

function exportPayoutReport(){
	window.location.href='<?php echo base_url().'admin/payment/payout_excel_report';?>';
}

function exportSlrPayoutReport(){
	window.location.href='<?php echo base_url().'admin/payment/slr_payout_excel_report';?>';
}
</script>

<?php
require_once('footer.php');
?>			