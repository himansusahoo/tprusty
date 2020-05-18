<?php
require_once('header.php');
?>	
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
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
					<div class="col-md-8"> <h3>Tax Report</h3>
                    <button id="product_submit" class="seller_buttons" onClick="window.location.href='<?php echo base_url().'admin/payment/tax_excel_report'?>'" > 
           <i class="fa fa-file-excel-o" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Export To Excel Tax Report 
           </button>
                   </div>
                    </div>
						<form action="<?php echo base_url().'admin/payment/filter_tax' ?>" method="post" >
						<div class="col-md-6 right show_report">
							<input type="submit" class="all_buttons" value="Search" >
							<input type="reset" class="all_buttons" value="Reset Filter">
						</div>
						<div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
				    <div  class="col-md-6 left">	
                        <table class="multi_action">
							<tr>
                            	<td></td>
							</tr>
						</table>
					</div>	
					<div class="clearfix"></div>
                    </br>
					<div>
						<table class="table table-bordered table-hover">
                        	<!--<tr>
                        	<?php// if($status){ ?>
                            	<td colspan="7">Filtered Data  as  Order Status : <strong><?//=$status; ?></strong></td>
                            <?php// }else if($seller_name){?>
                            	<td colspan="7">Filtered Data  as  Seller : <strong><?//=$seller_name; ?></strong></td>
                            <?php// }?>
                            </tr>-->
							<tr class="table_th">
								<th width="5%">Product ID</th>
                                <th width="10%">Product Name</th>
								<th width="10%">Seller Name</th>
								<th width="10%">MRP</th>
								<th width="10%">Selling Price</th>
								<th width="10%">Special Price</th>
                                <th width="10%">Special Price from date</th>
                                <th width="10%">Special Price to date</th>
                                <th width="10%">GST</th>
								
							</tr>
							<tr class="filter_tr">
							<td></td>
								<td>
									<input type="text" name="prod_name" id="prod_name" autocomplete="off">
                                    <div id="prod_nm_dv"><ul></ul></div>
								</td>
								<td>
									<input type="text" name="seller_name" id="seller_name" autocomplete="off">
                                    <div id="slr_nm_dv"><ul></ul></div>
								</td>
								<td>
									<input type="number" name="mrp" id="mrp" >
								</td>
								<td>
								<input type="number" name="selling_prc" id="selling_prc">
								</td>
                                <td>
									<input type="number" name="spec_prc" id="spec_prc" >
								</td>
                                <td>
									<input type="text" name="spec_prc_frm_dt" id="datepicker-example7-start" >
								</td>
                                <td>
									<input type="text" name="spec_prc_to_dt" id="datepicker-example7-start1" >
								</td>
                                <td><input type="number" step="0.01" class="text" size="32px" name="tax" min="0" id="tax" ></td>
								
								
							</tr>
                            <?php
						    if($tax_report->num_rows()>0){	
								//$sl=0;					
								foreach($tax_report->result() as $report_row){
								
								//$sl++;
								?>
                            <tr>
                            	<td><?php echo $report_row->product_id;?></td>
                                <td> <?php echo $report_row->name;?></td>
                                <td> <?php echo $report_row->business_name; ?></td>
                                <td> <?php echo $report_row->mrp;?></td>
                                <td> <?php echo $report_row->price;?></td>
                                 <td><?php echo $report_row->special_price;?></td>
                                 <td> <?php $special_pric_from_dt=substr($report_row->special_pric_from_dt,0,10); 
										echo date('d-M-Y',strtotime($special_pric_from_dt));
										?></td>
                                 <td> <?php $special_pric_to_dt=substr($report_row->special_pric_to_dt,0,10); 
										echo date('d-M-Y',strtotime($special_pric_to_dt));?></td>
                                <td> <?php echo $report_row->tax_amount;?>%</td>
                               
                            </tr>
                            <?php }
							 }
							else{?>
                             <tr>
                            	<td colspan="9">No Record Found.</td>
                            </tr>
                            <?php }?>
						</table>
					</div>
                    </form>
                    <!--<?php// echo form_close(); ?>-->
				</div>
        
        	
	</div><!-- @end #content -->




<style>

#non,#prod_nm_dv{ display:none;}
#prod_nm_dv{position: absolute; z-index: 1000; background-color:seashell; width: 12%; border: 1px solid tan;  border-radius: 3px;}
#prod_nm_dv ul {margin-bottom:0px !important;}
#prod_nm_dv li { cursor: pointer;  list-style: outside none none;padding: 5px 5px 5px 10px;}
#prod_nm_dv li:hover{background-color:tan;}
#non,#slr_nm_dv{ display:none;}
#slr_nm_dv{position: absolute; z-index: 1000; background-color:seashell; width: 12%; border: 1px solid tan;  border-radius: 3px;}
#slr_nm_dv ul {margin-bottom:0px !important;}
#slr_nm_dv li { cursor: pointer;  list-style: outside none none;padding: 5px 5px 5px 10px;}
#slr_nm_dv li:hover{background-color:tan;}
</style> 


<script>
$(document).ready(function(){
	////seller name field script start here/////
	$("#prod_name").keyup(function(){
		//ShowLoder1();
		var prod_name=$(this).val();
		$('#prod_nm_dv').css('display','block');
		$.ajax({
			url:'<?php echo base_url().'admin/payment/autofill_taxprodnm' ?>',
			method:'post',
			data:{prod_name:prod_name},
			success:function(data)
			{
				if(prod_name){
					$("#prod_nm_dv ul").html(data);
					//HideLoder1();
				}else{
					$("#prod_nm_dv ul").html("");
					//HideLoder1();
					$('#prod_nm_dv').css('display','none');
				}
			}
		});
	});
////seller name field script end here/////
})


function getprodname(val){
	var x = val
	var res = x.replace(/-/g,' ')
	$('#prod_name').val(res);
	$('#prod_name').css('color','black');
	$('#prod_nm_dv').css('display','none');
}
</script>

<script>
$(document).ready(function(){
	////seller name field script start here/////
	$("#seller_name").keyup(function(){
		//ShowLoder1();
		var seller_name=$(this).val();
		$('#slr_nm_dv').css('display','block');
		$.ajax({
			url:'<?php echo base_url().'admin/payment/autofill_taxseller' ?>',
			method:'post',
			data:{seller_name:seller_name},
			success:function(data)
			{
				if(seller_name){
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
	$('#seller_name').val(res);
	$('#seller_name').css('color','black');
	$('#slr_nm_dv').css('display','none');
}
</script>
<script>
function validFilter(){
	var seller_name = $('#fltr_seller').val();
	var status = $('#order_status').val();
	if(seller_name!='' && status!=''){
		alert('You should filtered data only one field in a time.');
		$('#filter_form').trigger("reset");
		return false;
	}
}
</script>
<?php
require_once('footer.php');
?>	