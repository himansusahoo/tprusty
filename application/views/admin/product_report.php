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
					<div class="col-md-8"> <h3>Product Report</h3></div>
                    </div>
						<form action="<?php echo base_url().'admin/report/filter_product' ?>" method="post" >
						<div class="col-md-6 right show_report">
							<input type="submit" class="all_buttons" value="Search" >
							<input type="reset" class="all_buttons" value="Reset Filter">
						</div>
                        </br>
                        </br>
                        <div class="clearfix"></div>
						<div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
				    	
					
					<div>
						<table class="table table-bordered table-hover">
                        		<tr class="table_th">
								<th width="5%">Product ID</th>
                                <th width="10%">Category Name</th>
								<th width="10%">Product Name</th>
								<th width="8%">Product Added Date</th>
								<th width="8%">Seller Name</th>
								<th width="8%">Quantity</th>
								<th width="8%">Approve Status</th>
								<th width="8%">Display Status</th>
								<th width="8%">MRP</th>
								<th width="8%">Selling Price</th>
								<th width="8%">Special Price</th>
								<th width="10%">GST</th>
								
							</tr>
							<tr class="filter_tr">
							<td></td>
								<td>
									<input type="text" name="cate_name" id="cate_name" >
								</td>
								<td>
                                
									<input type="text" name="prod_name" id="prod_names" autocomplete="off">
                                    <div id="prod_nm_dv"><ul></ul></div>
								</td>
								<td>
									<input type="text" name="add_date" id="datepicker-example7-start" >
								</td>
								<td>
								<input type="text" name="seller_name" id="seller_names" autocomplete="off">
                                <div id="slr_nm_dv"><ul></ul></div>
								</td>
								<td>
									<input type="number" name="quantity" id="quantity" >
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
								<td>
									<input type="number" name="mrp" id="mrp" >
								</td>
								<td>
									<input type="number" name="sell_price" id="sell_price" >
								</td>
								<td>
									<input type="number" name="spec_price" id="spec_price" >
								</td>
								<td>
									<input type="number" class="text" size="32px" id="tax_percenrage"  name="vat">
								</td>
								
							</tr>
                            <?php
							//$ct=$seller_report->num_rows();
						    if($seller_report->num_rows()>0){	
								$i=1;					
								foreach($seller_report->result() as $report_row){
								
								
								?>
                            <tr>
                            	<td><?php echo $report_row->product_id;?></td>
                                <td> <?php
					echo $report_row->lvlmain_name." >> ".$report_row->lvl1_name." >> ".$report_row->lvl2_name;
			 
			 ?></td>
                                <td>
								<?php echo $report_row->name; ?>
								
								</td>
                                <td>
                                
                                <?php 
											
								$lvl2= $report_row->lvl2;
											 $query = $this->db->query("SELECT c.date_added
											FROM seller_product_category a
										INNER JOIN seller_product_setting c ON a.seller_product_id = c.seller_product_id AND a.category=$lvl2"); 
											$date=$query->row();
											if($date){
												$dates=substr($date->date_added,0,10); 
										echo date('d-M-Y',strtotime($dates));
									
														
										?>
                                      </td>
                                      <?php } ?>
                                <td><?php echo $report_row->business_name; ?></td>
                                
									
                                <td>
								<?php echo $report_row->quantity; ?>
								</td>
                                
									<td><?php echo $report_row->approve_status; ?>	</td>
								<td><?php echo $report_row->status; ?></td>
								
								<td><?php echo $report_row->mrp; ?></td>
								<td><?php echo $report_row->price; ?></td>
								<td><?php echo $report_row->special_price; ?></td>
								<td><?php echo $report_row->tax_amount; ?>%</td>
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
#non,#slr_nm_dv{ display:none;}
#slr_nm_dv{position: absolute; z-index: 1000; background-color:seashell; width: 12%; border: 1px solid tan;  border-radius: 3px;}
#slr_nm_dv ul {margin-bottom:0px !important;}
#slr_nm_dv li { cursor: pointer;  list-style: outside none none;padding: 5px 5px 5px 10px;}
#slr_nm_dv li:hover{background-color:tan;}
#non,#prod_nm_dv{ display:none;}
#prod_nm_dv{position: absolute; z-index: 1000; background-color:seashell; width: 12%; border: 1px solid tan;  border-radius: 3px;}
#prod_nm_dv ul {margin-bottom:0px !important;}
#prod_nm_dv li { cursor: pointer;  list-style: outside none none;padding: 5px 5px 5px 10px;}
#prod_nm_dv li:hover{background-color:tan;}
</style> 


<script>
$(document).ready(function(){
	////seller name field script start here/////
	$("#seller_names").keyup(function(){
		//ShowLoder1();
		var seller_name=$(this).val();
		$('#slr_nm_dv').css('display','block');
		$.ajax({
			url:'<?php echo base_url().'admin/report/autofill_prodseller' ?>',
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


<script>
$(document).ready(function(){
	////seller name field script start here/////
	$("#prod_names").keyup(function(){
		//ShowLoder1();
		var prod_name=$(this).val();
		$('#prod_nm_dv').css('display','block');
		$.ajax({
			url:'<?php echo base_url().'admin/report/autofill_prodnm' ?>',
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