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
					<div class="col-md-8"> <h3>Buyer Wallet Report</h3>
                    <button id="product_submit" class="seller_buttons" onclick="window.location.href='<?php echo base_url().'admin/report/export_buyer_wallet/'.$start?>'" > 
           <i class="fa fa-file-excel-o" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Export To Excel Buyer Wallet Report 
           </button></div>
                    </div>
                    <form action="<?php echo base_url().'admin/report/filter_wallet' ?>" method="post" >
						<div class="col-md-6 right show_report">
							<input type="submit" class="all_buttons" value="Search" >
							<input type="reset" class="all_buttons" value="Reset Filter">
						</div>
							
				   	<div class="clearfix"></div>
                    <div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
					<div>
						<table class="table table-bordered table-hover">
                        
                        
                        
                        <tr class="table_th">
								<th width="5%">User ID</th>
                                <th width="10%">Buyer Name</th>
                                <th width="10%">Email</th>
                                <th width="10%">Contact Number</th>
								<th width="10%">Total Credited</th>
								<th width="10%">Total Debited</th>
								<th width="10%">Total Used</th>
                                <th width="10%">Total Available</th>
                                <th width="10%">Action</th>
								
							</tr>
							<tr class="filter_tr">
								<td></td>
								<td><input type="text" name="buyer" id="buyer" autocomplete="off"></td>
                               <td><input type="text" name="email" id="email" autocomplete="off"></td>
								<td><input type="number" name="contact" id="contact" autocomplete="off"></td>
								<td></td>
								<td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                
							</tr>
                            
                            <?php
						    if($byrwallet_report->num_rows()>0){
								$sl=0;
								foreach($byrwallet_report->result() as $report_row){
								
								$sl++;
								?>
                            <tr>
                            	<td><?php echo $report_row->user_id;?></td>
                                <td><?php echo $report_row->fname." ".$report_row->fname;?></td>
                                <td><?php echo $report_row->email;?></td>
                                <td><?php echo $report_row->mob;?></td>
                                <td><?php echo  $report_row->credit;?>
								</td>
                                <td><?php echo  $report_row->debit;?>
								</td>
                                
                              
                                <td><?php $query = $this->db->query("select b.order_id,c.name as prd_name,d.imag,e.business_name,b.quantity,sum(b.sub_total_amount) as total_used,e.business_name from order_info a 
		INNER JOIN ordered_product_from_addtocart b on a.order_id=b.order_id 
		INNER JOIN product_general_info c on c.product_id=b.product_id 
		INNER JOIN  product_image d  on d.product_id=b.product_id 
		INNER JOIN seller_account_information e on b.seller_id = e.seller_id 
		WHERE b.user_id='$report_row->user_id' and a.payment_mode=3 ");
								$sub_total_amount=$query->row();
											if($sub_total_amount){
										echo $sub_total_amount->total_used;
								?></td>
                                <?php } ?>
                                <td><?php echo $report_row->wallet_balance;?></td>
							     <td><a href='<?php echo base_url().'admin/payment/buyerwallet_detail/'.$report_row->user_id ?>' target='_blank' title="View Wallet Detail"> <i style="font-size:16px;" class="fa fa-eye"></i> </a></td>
                                </tr>
                             <?php }
							 }else{?>
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
.Zebra_DatePicker_Icon{left: 121px !important; top: 0px !important;}
#non,#slr_nm_dv{ display:none;}
#slr_nm_dv{position: absolute; z-index: 1000; background-color:seashell; width: 12%; border: 1px solid tan;  border-radius: 3px;}
#slr_nm_dv ul {margin-bottom:0px !important;}
#slr_nm_dv li { cursor: pointer;  list-style: outside none none;padding: 5px 5px 5px 10px;}
#slr_nm_dv li:hover{background-color:tan;}
</style> 


<script>
$(document).ready(function(){
	////seller name field script start here/////
	$("#seller").keyup(function(){
		//ShowLoder1();
		var seller=$(this).val();
		$('#slr_nm_dv').css('display','block');
		$.ajax({
			url:'<?php echo base_url().'admin/report/autofill_register' ?>',
			method:'post',
			data:{seller:seller},
			success:function(data)
			{
				if(seller){
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
	$('#seller').val(res);
	$('#seller').css('color','black');
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