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
					<div class="col-md-8"> <h3>Sales Report</h3>
                    <button id="product_submit" class="seller_buttons" onclick="window.location.href='<?php echo base_url().'admin/report/export_salereport/'.$start?>'" > 
           <i class="fa fa-file-excel-o" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Export To Excel Sale Report 
           </button></div>
                    </div>
                    <form action="<?php echo base_url().'admin/report/filter_sales' ?>" method="post" >
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
								<th width="5%">Seller ID</th>
                                <th width="10%">Seller </th>
								<th width="10%">Total Orders</th>
								<th width="10%">Sale</th>
								<th width="10%">Cancel</th>
								<th width="10%">Return</th>
								<th width="10%">Replacement</th>
							</tr>
							<tr class="filter_tr">
								<td></td>
								<td><input type="text" name="seller" id="seller" autocomplete="off">
                                <div id="slr_nm_dv"><ul></ul></div></td>
								<td><!--<input type="text" name="totl_order" id="totl_order">--></td>
								<td><!--<input type="text" name="sale" id="sale">--></td>
								<td><!--<input type="text" name="cancel" id="cancel">--></td>
								<td><!--<input type="text" name="return" id="return">--></td>
								<td><!--<input type="text" name="replacement" id="replacement">--></td>
                                
							</tr>
                            
                            <?php
						    if($sales_report->num_rows()>0){
								foreach($sales_report->result() as $report_row){
								
								
								?>
                            <tr>
                            	<td><?php echo $report_row->seller_id;?></td>
                                <td><?php echo $report_row->business_name;?></td>
                                <td><?php echo $report_row->tot_order;?></td>
                                <td><?php
								$seller_id= $report_row->seller_id;
								$query = $this->db->query("SELECT order_id FROM ordered_product_from_addtocart WHERE seller_id='$seller_id' AND product_order_status='Delivered' GROUP BY order_id");
								if($query->num_rows()>0)
								{
									echo $query->num_rows();
								}
								else
								{
									echo '0';
								}
								?></td>
                                <td>
							<?php	$query = $this->db->query("SELECT order_id FROM ordered_product_from_addtocart WHERE seller_id='$seller_id' AND product_order_status='Cancelled' GROUP BY order_id");
								if($query->num_rows()>0)
								{
									echo $query->num_rows();
								}
								else
								{
									echo '0';
								}
								?>
								</td>
                                <td>
								<?php $query = $this->db->query("SELECT order_id FROM ordered_product_from_addtocart WHERE seller_id='$seller_id' AND product_order_status='Return Received' GROUP BY order_id");
								if($query->num_rows()>0)
								{
									echo $query->num_rows();
								}
								else
								{
									echo '0';
								}
								?>
								</td>
                                <td><?php $query = $this->db->query("SELECT a.order_id
									FROM ordered_product_from_addtocart a
									INNER JOIN order_status_log b ON a.order_id = b.order_id
									WHERE a.seller_id='$seller_id' AND b.return_received_date!='0000-00-00 00:00:00' AND a.product_order_status='Delivered'");
								if($query->num_rows()>0)
								{
									echo $query->num_rows();
								}
								else
								{
									echo '0';
								}
								?></td>
                            </tr>
                             <?php }
							 }else{?>
                             <tr>
                            	<td colspan="7">No Record Found.</td>
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
	$("#seller").keyup(function(){
		//ShowLoder1();
		var seller=$(this).val();
		$('#slr_nm_dv').css('display','block');
		$.ajax({
			url:'<?php echo base_url().'admin/report/autofill_seller' ?>',
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