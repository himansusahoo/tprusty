<?php
require_once('header.php');
?>



<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
			<div id="content">    
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_reporttab.php'; ?>
					</div>
					<?php require_once('header_session.php'); ?>
				</div>  <!-- @end top-bar  -->
				
			
					<!--<div style="padding-top:60px; margin:0px 50px;">
						<div class="alert alert-danger" role="alert"> *Important ! You have not completed signup. To complete click <a href="<?php// echo base_url();?>seller/seller/incomplete_signup"><strong>here</strong></a></div>
					</div>-->
				
				
				<div class="main-content">
					<?php require_once('common.php'); ?>
					<div class="page_header">
						<div class="left">
							<h3>Returned Order Reports</h3><button id="product_submit" class="seller_buttons" onclick="window.location.href='<?php echo base_url().'seller/reports/export_returnreport/'.$start?>'" > 
           <i class="fa fa-file-excel-o" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Export To Excel Returned order Report 
           </button>
						</div>
                        <form action="<?php echo base_url().'seller/reports/filter_return' ?>" method="post" >
						<div class="col-md-6 right show_report">
							<input type="submit" class="all_buttons" value="Search" >
							<input type="reset" class="all_buttons" value="Reset Filter">
						</div>
						<!--<div class="right order_id_search">
							<img class="partner_img" src="../images/partner-mobile-icon-new.png">
							<a href="#"> Lending Services </a>
							<div class="search_bar input-append">
								Settlement Ref No : 
								<input type="text" name="ref_no">
								<button type="submit"><span class="icon-search"></span></button>
							</div>
						</div>-->
						<div class="clear"></div>
                        <div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
                        </br>
                        </br>
                        </br>
					
					<!--Take tour-->
					<!--<div class="row">
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
					</div>-->
					<!--<div class="row table_blocks">-->
					
					<div class="settelment_details_table">
						<table class="table table-bordered table-hover">
							<tr>
								<th width="5%">Sl. No.</th>
								<th width="10%">Return Date</th>
								<th width="10%">Order ID</th>
								<th width="10%">Return ID</th>
                                <th width="10%">Product Name</th>
                                <th width="10%">Quantity</th>
                                <th width="10%">Reason</th>
                                <th width="10%">Customer Email</th>
                                <th width="10%">Amount</th>
                                <th width="10%">Status</th>
							</tr>
                            
                            
                            <tr class="filter_tr">
							<td></td>
								<td>
									<input type="text" name="retn_dt" id="datepicker-example7-start" >
								</td>
								<td>
                                
									<input type="text" name="order_id" id="order_id" autocomplete="off">
                                    
								</td>
								<td>
									<input type="text" name="retn_id" id="retn_id" >
								</td>
								<td>
								<input type="text" name="prod_name" id="prod_name" autocomplete="off">
                               <div id="prod_nm_dv"><ul></ul></div>
								</td>
								<td>
									<input type="number" name="quantity" id="quantity" >
								</td>
								
								
                                
								
								<td>
									<!--<input type="text" name="reason" id="reason" >-->
								</td>
								
								<td>
									<input type="text" name="email" id="email" >
								</td>
                                <td>
									<input type="number" name="amount" id="amount" >
								</td>
                                <td>
                                	<select name="status" id="status">
										<option value="">--select--</option>
										<option value="Return Requested">Return Requested</option>
										<option value="Return Received">Return Received</option>
									</select>
                                </td>
								
							</tr>
						<?php 
						/*if($return_order_reportresult->num_rows>0){	
								$i=1;					
								foreach($return_order_reportresult->result() as $res_orderepo){*/
						
						$ct=count($return_order_reportresult);
								if($ct > 0){
									$i=1;
									foreach($return_order_reportresult as $res_orderepo){
						 ?>
                          
                            <tr>
                            	<td><?=$i; ?></td>
                                <td><?php $return_date=substr($res_orderepo->cdate,0,10);
								echo date('d-M-Y',strtotime($return_date));?></td>
                                <td><?=$res_orderepo->order_id; ?></td>                                
                                <td><?=$res_orderepo->return_id; ?></td>
                                <td><?=$res_orderepo->name; ?></td>
                                <td><?=$res_orderepo->quantity; ?></td>
                                <td><?=$res_orderepo->reason; ?></td>
                                <td><?=$res_orderepo->email; ?></td>                                
                                <td>Rs.<?=$res_orderepo->total_amount; ?></td>
                                <td><?=$res_orderepo->status; ?><a href='<?php echo base_url().'seller/returns/returned_order/'.$res_orderepo->return_id ?>' target='_blank' title="View Returned Order"> <i style="font-size:16px;" class="fa fa-eye"></i> </a></td>
                                
                            </tr>
                           <?php $i++; } //foreach end
						    }else{ ?> 
                            
                            <tr>
                            	<td colspan="10">No Record Found!</td>
                            </tr>
                            <?php } ?>
						</table>
						<!--<div>
							<button class="show_more_btn"><span>Show More</span></button>
						</div>-->
					</div>
                    
                    </form>
                    </div>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->





<style>
.Zebra_DatePicker_Icon{left: 68px !important; top: 0px !important;}
#non,#prod_nm_dv{ display:none;}
#prod_nm_dv{position: absolute; z-index: 1000; background-color:seashell; width: 12%; border: 1px solid tan;  border-radius: 3px;}
#prod_nm_dv ul {margin-bottom:0px !important;}
#prod_nm_dv li { cursor: pointer;  list-style: outside none none;padding: 5px 5px 5px 10px;}
#prod_nm_dv li:hover{background-color:tan;}
</style> 


<script>
$(document).ready(function(){
	////seller name field script start here/////
	$("#prod_name").keyup(function(){
		//ShowLoder1();
		var prod_name=$(this).val();
		$('#prod_nm_dv').css('display','block');
		$.ajax({
			url:'<?php echo base_url().'seller/reports/autofill_prodnm' ?>',
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
	var res = x.replace(/,/g,' ')
	$('#prod_name').val(res);
	$('#prod_name').css('color','black');
	$('#prod_nm_dv').css('display','none');
}
</script>
<?php
require_once('footer.php');
?>