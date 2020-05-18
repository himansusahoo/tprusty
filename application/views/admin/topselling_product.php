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
					<div class="col-md-8"> <h3>Top Selling Product By Seller</h3>
                    <button id="product_submit" class="seller_buttons" onClick="window.location.href='<?php echo base_url().'admin/report/topselling_excel_report'?>'" > 
           <i class="fa fa-file-excel-o" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Export To Excel Top Selling Report 
           </button></div>
                    </div>
						<form action="<?php echo base_url().'admin/report/filter_topselling' ?>" method="post" >
						<div class="col-md-6 right show_report">
							<input type="submit" class="all_buttons" value="Search" >
							<input type="reset" class="all_buttons" value="Reset Filter">
						</div>
                       
						<div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
				    	
					
					<div>
						<table class="table table-bordered table-hover">
                        	
							<tr class="table_th">
								<th width="5%">SL NO.</th>
                                <th width="10%">Product Name</th>
								<th width="10%">Seller Name</th>
								<th width="10%">Selling Quantity</th>
								<th width="10%">Sale Ranking</th>
								<th width="10%">Approve Status</th>
                                <th width="10%">Display Status</th>
								
							</tr>
							<tr class="filter_tr">
							<td></td>
								<td>
									<input type="text" name="prod_name" id="prod_names" autocomplete="off">
                                    <div id="prod_nm_dv"><ul></ul></div>
								</td>
								<td>
                                
									<input type="text" name="seller_name" id="seller_names" autocomplete="off">
                                    <div id="slr_nm_dv"><ul></ul></div>
								</td>
								<td>
									<!--<input type="text" name="selling_qnty" id="add_date" >-->
								</td>
								<td>
								<!--<input type="text" name="selling_rank" id="seller_name">-->
								</td>
								<td>
                                	<select name="approve_status" id="approve_status">
										<option value="">--select--</option>
										<option value="Active">Active</option>
										<option value="Inactive">Inactive</option>
									</select>
                                </td>
								<td>
                                	<select name="dispy_stas" id="dispy_stas">
										<option value="">--select--</option>
										<option value="Enabled">Enabled</option>
										<option value="Disabled">Disabled</option>
									</select>
                                </td>
								
								
                                
								
							</tr>
                            <?php
							//$ct=$seller_report->num_rows();
						    if($topselling_report->num_rows()>0){	
								$i=1;					
								foreach($topselling_report->result() as $report_row){
								
								
								?>
                            <tr>
                            	<td><?php echo $i;?></td>
                                <td> <?php echo $report_row->name;?></td>
                                <td> <?php echo $report_row->business_name; ?></td>
                                <td> <?php echo $report_row->salesqnty;?></td>
                                <td></td>
                                <td> <?php echo $report_row->approve_status;?></td>
                                <td> <?php echo $report_row->status;?></td>
								
                                
									
                            </tr>
                            <?php $i++;}
							 }
							else{?>
                             <tr>
                            	<td colspan="12">No Record Found.</td>
                            </tr>
                            <?php }?>
						</table>
					</div>
                    </form>
                    <!--<?php// echo form_close(); ?>-->
				</div>
        
        	
	</div><!-- @end #content -->

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
	$("#seller_names").keyup(function(){
		//ShowLoder1();
		var seller_name=$(this).val();
		$('#slr_nm_dv').css('display','block');
		$.ajax({
			url:'<?php echo base_url().'admin/report/autofill_topseller' ?>',
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
	$('#seller_names').val(res);
	$('#seller_names').css('color','black');
	$('#slr_nm_dv').css('display','none');
}
</script>

<style>
.Zebra_DatePicker_Icon{left: 10px !important; top: 0px !important;}
#non,#prod_nm_dv{ display:none;}
#prod_nm_dv{position: absolute; z-index: 1000; background-color:seashell; width: 12%; border: 1px solid tan;  border-radius: 3px;}
#prod_nm_dv ul {margin-bottom:0px !important;}
#prod_nm_dv li { cursor: pointer;  list-style: outside none none;padding: 5px 5px 5px 10px;}
#prod_nm_dv li:hover{background-color:tan;}
</style> 


<script>
$(document).ready(function(){
	////seller name field script start here/////
	$("#prod_names").keyup(function(){
		//ShowLoder1();
		var prod_name=$(this).val();
		$('#prod_nm_dv').css('display','block');
		$.ajax({
			url:'<?php echo base_url().'admin/report/autofill_topprodnm' ?>',
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
	$('#prod_names').val(res);
	$('#prod_names').css('color','black');
	$('#prod_nm_dv').css('display','none');
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