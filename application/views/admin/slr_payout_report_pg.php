<?php
require_once('header.php');
?>		

			<div id="content">
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_reports.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
					<div class="row content-header">
					<div class="col-md-8"> <h3>Seller Payout</h3>
                    <button id="product_submit" class="seller_buttons" onclick="window.location.href='<?php echo base_url().'admin/payment/export_slrpayout/'.$start?>'" > 
           <i class="fa fa-file-excel-o" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Export To Excel Seller Payout Report 
           </button></div>
                    </div>
                    
                   <form action="<?php echo base_url().'admin/payment/filter_slrpayout';?>" method="post" >
				
                        <div class="col-md-6 right show_report">
							<input type="submit" class="all_buttons" value="Search" >
							<input type="reset" class="all_buttons" value="Reset Filter">
						
                        <!--<button type="submit" class="all_buttons" style="float:right;">Update UTR NO.</button>-->
					</div>
                    
					<div class="clearfix"></div>
                    <div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
					<div>
						<table class="table table-bordered table-hover">
							<tr class="table_th">
                            	<th width="5%">Pay Out Gen. Date</th>
								<th width="8%">Seller Name</th>
								<th width="8%">Seller ID</th>
								<th width="8%">No of Orders</th>
                                <th width="8%">Settlement Reference</th>
								<th width="8%">Final stl Amt</th>
								<th width="8%">Accnt. No</th>
								<th width="8%">Bank Name</th>
								<th width="8%">IFSC Code</th>
								<th width="8%">Accnt. Holder Name</th>
								<th width="8%">UTR No.</th>
                                <th width="8%">Status</th>
							</tr>
							<tr class="filter_tr">
                            	<td></td>
								<td><input type="text" name="slr_name" id="slr_name" autocomplete="off" >
                                <div id="slr_nm_dv"><ul></ul></div>
                                </td>
								<td><input type="number" name="slr_id" id="slr_id" ></td>
                                <td><input type="number" name="no_of_reports" id="no_of_reports" ></td>
                                <td><!--<input type="number" name="stl_ref" id="stl_ref" >--></td>
								<td><input type="number" name="final_stl_amt" id="final_stl_amt" ></td>
								<td><input type="text" name="account_no" id="account_no" ></td>
                                <td><input type="text" name="bank_name" id="bank_name" ></td>
                                <td><input type="text" name="ifsc_code" id="ifsc_code" ></td>
                                <td><input type="text" name="acnt_holder" id="acnt_holder" ></td>
                                <td><input type="number" name="utr" id="utr" ></td>
                                <td>
                                	<select name="status" id="status">
										<option value="">--select--</option>
										<option value="Paid">Paid</option>
										<option value="Pending">Pending</option>
									</select>
                                </td>
							</tr>
                            <?php
							$slr_payout_row = $slr_payout_result->num_rows();
							if($slr_payout_row > 0){
								$sl=0;
							 foreach($slr_payout_result->result() as $rows){
								 $sl++; 
							?>
                            <tr>
                            	<td><?=$rows->pyt_generated_dt;?></td>
								<td>
                                	<input type="hidden" name="hidden_id[]" value="<?=$rows->id;?>">
									<?=$rows->business_name;?>
                                </td>
								<td><?=$rows->seller_id;?></td>
                                <td><?=$rows->no_of_orders;?></td>
                                <td><?=$rows->settlmnt_refno;?><span title="Click here to see orderwise payout" class="plus_icn pls_expnd<?=$sl;?>" onClick="showSlrWisePayout('<?=$sl;?>','<?=$rows->settlmnt_refno;?>')">+</span>
                                <span class="minus_icn minus_icn_squitch<?=$sl;?>" onClick="squitch('<?=$sl;?>')">-</span>
                                </td>
								<td><?=$rows->fnl_stl_amt;?></td>
								<td><?=$rows->bnk_acnt_no;?></td>
								<td><?=$rows->bnk_name;?></td>
								<td><?=$rows->bnk_ifsc_code;?></td>
                                <td><?=$rows->acnt_hldr_name;?></td>
								<td width="10%"><?=$rows->utr_no;?>
                                </td>
                                <td width="10%"><?=$rows->status;?></td>
							</tr>
                            <tr class="expndtr" id="expnd_tr<?=$sl;?>">
                            	<td colspan="12" id="load_ajx_data<?=$sl;?>"></td>
                            </tr>
                            <?php } }else{?>
                            <tr>
                            	<td colspan="11">No Records Found.</td>
                            </tr>
                            <?php }?>
						</table>
					</div>
                 </form>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->    

<script>
function showSlrWisePayout(sl,settl_ref_no){
	$.ajax({
		url:'<?php echo base_url();?>admin/payment/get_slr_wise_payout',
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
<style>
.Zebra_DatePicker_Icon{left: 134px !important; top: 6px !important;}
.Zebra_DatePicker{ margin-top: 10px; z-index: 9999 !important;}
</style>
<style>
.Zebra_DatePicker_Icon{left: 10px !important; top: 0px !important;}
#non,#slr_nm_dv{ display:none;}
#slr_nm_dv{position: absolute; z-index: 1000; background-color:seashell; width: 12%; border: 1px solid tan;  border-radius: 3px;}
#slr_nm_dv ul {margin-bottom:0px !important;}
#slr_nm_dv li { cursor: pointer;  list-style: outside none none;padding: 5px 5px 5px 10px;}
#slr_nm_dv li:hover{background-color:tan;}
</style> 


<script>
$(document).ready(function(){
	////seller name field script start here/////
	$("#slr_name").keyup(function(){
		//ShowLoder1();
		var slr_name=$(this).val();
		$('#slr_nm_dv').css('display','block');
		$.ajax({
			url:'<?php echo base_url().'admin/payment/autofill_slrpayout' ?>',
			method:'post',
			data:{slr_name:slr_name},
			success:function(data)
			{
				if(slr_name){
					$("#slr_nm_dv ul").html(data);
					//HideLoder1();
				}else{
					$("#slr_nm_dv ul").html("");
					//HideLoder1();
					$('#slr_nm_dv').css('display','none');
				}
			}
		});
	});
////seller name field script end here/////
})


function getslrname(val){
	var x = val
	var res = x.replace(/-/g,' ')
	$('#slr_name').val(res);
	$('#slr_name').css('color','black');
	$('#slr_nm_dv').css('display','none');
}
</script>
<!--- Zebra_Datepicker link start here ---->
<!--<script src="<?php// echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script>-->
<!--<script src="<?php// echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core.js"></script>
<script src="<?php// echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php// echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
--><!--<link href="<?php// echo base_url(); ?>Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">-->
<!--- Zebra_Datepicker link end here ---->


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

<?php
require_once('footer.php');
?>			