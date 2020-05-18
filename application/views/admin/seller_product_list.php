<?php
require_once('header.php');
?>
		<div id="content">
			<div class="top-bar">
				<div class="top-left">
					<?php include 'sub_sellers.php'; ?>
				</div>
				<div class="top-right">
					<?php include 'top_right.php'; ?>
				</div>
			</div>  <!-- @end top-bar  -->
			<div class="main-content">
            <form action="#">
				<div class="row content-header">
					<!--<div class="col-md-8"><b>Seller</b></div>
					<div class="col-md-4 show_report">
						<button type="button" class="all_buttons">Add Seller</button>
					</div>-->
                     <h4>New Product Approval List</h4>
				</div>
				<div class="row mb10">
					<div class="col-md-6">
						<!--Page 
						<span class="glyphicon glyphicon-chevron-left arrow_button"></span>
						<input type="text" name="page" class="input_text" value="1">
						<span class="glyphicon glyphicon-chevron-right"></span>
						of 1 pages <span class="separator">|</span> View
						<select> 
							<option selected="selected" value="">20</option>
							<option>30</option>
							<option>50</option>
							<option>100</option>
							<option>200</option>
						</select>
						per page <span class="separator">|</span> Total 2 records found-->
					</div>
					
					<div class="col-md-6 show_report">
						<button type="submit" class="all_buttons">Search</button>
						<button type="reset" class="all_buttons">Reset Filter</button>
					</div>
				</div>
				<div>
					<table class="multi_action">
						<tr>
							<td>
								<!--<a href="#" >Select All</a>
								<span class="separator">|</span>
								<a href="#">Unselect All</a>
								<span class="separator">|</span>
								<a href="#">Select Visible</a>
								<span class="separator">|</span>
								<a href="#">Unselect Visible</a>
								<span class="separator">|</span>
								0 items selected-->
                                <span id="show"></span>
							</td>
							<td>
								<div class="right">
									<!--<form>-->
										<table>
											<tr>
												<td>Actions</td>
												<td>
                                                   	<select name="product_action" id="product_action">
														<option value="">--Choose Action--</option>
														<option value="Active">Active</option>
                                                        <option value="Pending">Pending</option>
                                                        <option value="Suspended">Suspended</option>
                                                        <option value="Rejected">Rejected</option>
													</select>
												</td>
												<td><input type="button" class="all_buttons" id="product_action_btn" onClick="changeProductStatus()" value="Submit"></td>
											</tr>
										</table>
									<!--</form>-->
								</div>
							</td>
						</tr>
					</table>
				</div>
				<div>
					<table class="table table-bordered">
						<tr class="table_th">
							<th class="a-center" width="5%"><input type="checkbox" id="check_all"/></th>
							<th width="10%">Image</th>
                            <th width="10%">Date</th>
							<th width="20%">Name</th>
							<th width="10%">Seller Name</th>
							<th width="10%">Status</th>
						</tr>
							<td></td>
							<td></td>
							<td>
								<div class="dt_dv"><div class="lft">From : </div><div class="rit"><input type="text" name="from_dt" id="datepicker-example7-start1" class="dt"></div></div>
                                <div class="dt_dv"><div class="lft">To : </div><div class="rit"><input type="text" name="to_dt" id="datepicker-example7-end1" class="dt"></div></div>
							</td>
							<td>
								<input type="text" name="fltr_product_nm" value="">
							</td>
							<td>
								<input type="text" name="fltr_slr_nm" value="">
							</td>
							<td>
								<select name="product_sts">
                                	<option value="Active">Active</option>
                                	<option value="Pending">Pending</option>
                                    <option value="Suspended">Suspended</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
							</td>
						</tr>
						
						<?php 
                            $rows = $result->num_rows();
                            if($rows > 0){
                            	foreach ($result->result() as $row){
									$arr_img = explode(',',$row->image);
									$first_img = $arr_img[0];
                        ?>
						<tr>
							<td class="a-center">
                            	<input type="checkbox" name="chk_sellr[]" id="chk_sellr" value="<?=$row->seller_product_id ; ?>">
							</td>
                            <td><img src="<?php echo base_url().'images/product_img/'.$first_img; ?>" class="list_img"></td>
							<td><?=$row->date_added ;?></td>
							<td><?=$row->name ;?></td>
							<td><?=$row->seller_name ;?></td>
							<td><?=$row->product_approve?></td>
						</tr>
						<?php 
							}
                          }
                        ?>
					</table>
				</div>
              </form>
			</div>  <!-- @end #main-content -->
            <div id="show"></div>
		</div><!-- @end #content -->

<style>
.dt {
    width: 150px;
}
.Zebra_DatePicker_Icon{left: 130px !important;}
.Zebra_DatePicker{z-index: 99999 !important;}
</style>
	
<script>
$(document).ready(function(){
	$('#check_all').click(function(){
		$('input:checkbox').prop('checked', this.checked);
	});
});
</script>

<script>
function changeProductStatus(){
	var sel = $('input[name="chk_sellr[]"]:checked').map(function(_, el){
        	return $(el).val();
    	}).get();
	
	var approval_status = $('#product_action').val();
	if(approval_status == ''){
		alert('Please choose an action.');
		return false;
	}else if(sel == ''){
		alert('Please select any product.');
		return false;
	}else{
		var ys = confirm("Do you want to change those product status ?");
		if(ys){
			
			$('#product_action_btn').val('Wait.....');
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>admin/sellers/change_seller_product_status",
				data: {'status':approval_status,'id':sel},
				success: function (data) {
					//$("#show").html(data);
					if(data == 'success'){
						window.location.reload(true);
					}
				}
			});
		
		}
		
	}
	
}
</script>

<!--- Zebra_Datepicker link start here ---->
<!--<script src="<?php// echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script>-->
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
<!--<link href="<?php// echo base_url(); ?>Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">-->
<!--- Zebra_Datepicker link end here ---->

<?php
require_once('footer.php');
?>					