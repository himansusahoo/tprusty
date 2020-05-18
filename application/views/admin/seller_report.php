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
					<div class="col-md-8"> <h3>Seller Report</h3>
                    <button id="product_submit" class="seller_buttons" onclick="window.location.href='<?php echo base_url().'admin/report/export_seller_report/'.$start?>'" > 
           <i class="fa fa-file-excel-o" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Export To Excel Seller Report 
           </button></div>
                    </div>
                    <form action="<?php echo base_url().'admin/report/filter_seller' ?>" method="post" >
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
                                <th width="10%">New  Registered</th>
                                <th width="10%">Registered Date</th>
                                <th width="10%">Status</th>
								<th width="10%">Zero Ratings</th>
								<th width="10%">Good Ratings</th>
								<th width="10%">Excellent Ratings</th>
								
							</tr>
							<tr class="filter_tr">
								<td></td>
								<td><input type="text" name="seller" id="seller" autocomplete="off">
                                <div id="slr_nm_dv"><ul></ul></div></td>
                                <td>
								<div class="purchase">
										<span >From:</span>
										<input type="text" name="slr_date_from"   id="datepicker-example7-start1">
									</div>
									<div class="purchase">	
										<span >To:</span>
										<input type="text" name="slr_date_to"   id="datepicker-example7-end1">
									</div>
                                    </td>
								<td>
                                <select name="status" id="status">
										<option value="">--select--</option>
										<option value="Active">Active</option>
										<option value="Pending">Pending</option>
                                        <option value="Rejected">Rejected</option>
                                        <option value="Suspended">Suspended</option>
                                        
										                                           				
								  </select>	</td>
								<td></td>
								<td></td>
                                <td></td>
                                
							</tr>
                            
                            <?php
						    if($slr_report->num_rows()>0){
								$sl=0;
								foreach($slr_report->result() as $report_row){
								
								$sl++;
								?>
                            <tr>
                            	<td><?php echo $report_row->seller_id;;?></td>
                                <td><?php echo $report_row->business_name;?></td>
                                <td><?php $register_date=substr($report_row->register_date,0,10); 
										echo date('d-M-Y',strtotime($register_date));?></td>
                                <td><?php echo $report_row->status;?></td>
                                <td><?php
								$seller_id= $report_row->seller_id;
								$query = $this->db->query("SELECT seller_id FROM review_seller WHERE seller_id='$seller_id' AND rating_type='Bad' GROUP BY seller_id");
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
							<?php	$query = $this->db->query("SELECT seller_id FROM review_seller WHERE seller_id='$seller_id' AND rating_type='Good' GROUP BY seller_id");
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
								<?php $query = $this->db->query("SELECT seller_id FROM review_seller WHERE seller_id='$seller_id' AND rating_type='Best' GROUP BY seller_id");
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
.Zebra_DatePicker_Icon{left: 158px !important; top: 0px !important;}
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