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
          
				<div class="row content-header">
					<!--<div class="col-md-8"><b>Seller</b></div>
					<div class="col-md-4 show_report">
						<button type="button" class="all_buttons">Add Seller</button>
					</div>-->
                     <h4>Exiting Product Approval List</h4>
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
					
					
				</div>
                <div class="col-md-6 left">
									<!--<form>-->
                                    
                                    <?php   $qr=$this->db->query("SELECT prod_approv FROM product_process_status WHERE status_id=1 ");
			$rw=$qr->row();
			if($rw->prod_approv=='process')
			{echo "Please wait product approval is under process.....";
			 //redirect('admin/super_admin/home');
			 }else{ ?> 
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
                                                <td><div id="loader_div" style="display:none; text-align:center;"> <img src="<?php echo base_url().'images/loading1.gif' ?>" /> </div></td>
											</tr>
                                            
										</table><?php } ?>
									<!--</form>-->
								</div>
							<form action="<?php echo base_url().'admin/sellers/filter_seller_existing_product' ?>" method="post" >
				<div class="col-md-6 right">
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
							
						<input type="submit" class="all_buttons" value="Search" id="search"  />
							<input type="reset" class="all_buttons" value="Reset Filter" />
					
                    </td>	
						</tr>
					</table>
				</div>
                <div class="clearfix"></div>
				<div>
					<table class="table table-bordered">
                     <tr style="display:;">
                            <?php
							
							if($fltr_product_nm){ ?>
                            <td colspan="9">Filtered Data  as  Product Name:- <?php echo $fltr_product_nm;?> 
                            </td>
                           <?php }
							
							else if($fltr_slr_nm){ ?>
                            <td colspan="9">Filtered Data  as Seller Name:- <?php echo $fltr_slr_nm;?> 
                            </td>
                            <?php }
							
							else if($product_sts){ ?>
                            <td colspan="9">Filtered Data  as  Product Status:-<?php echo $product_sts;?> 
                            </td>
                            <?php }
							
							else if($from_dt && $to_dt){ ?>
                            <td colspan="9">Filtered Data  as  Seller Applied Date:- <?php echo $from_dt;?> to <?php echo $to_dt;?>
                            </td>
                            <?php } ?>
                            </tr>
						<tr class="table_th">
							<th class="a-center" width="5%"><input type="checkbox" id="check_all"/></th>
							<th width="10%">Image</th>
                            <th width="10%">Seller applied date</th>
							<th width="20%">Name</th>
							<th width="10%">Seller Name</th>
							<th width="10%">Status</th>
                            <th width="5%"> Action </th>
						</tr>
						<tr style="background-color:#9CF;">	<td></td>
							<td></td>
							<td>
								<div class="dt_dv"><div class="lft">From : </div><div class="rit"><input type="text" name="from_dt1" id="datepicker-example7-start1" class="dt"></div></div>
                                <div class="dt_dv"><div class="lft">To : </div><div class="rit"><input type="text" name="to_dt1" id="datepicker-example7-end1" class="dt"></div></div>
							</td>
							<td>
								<input type="text" name="fltr_product_nm1" value="">
							</td>
							<td>
								<input type="text" name="fltr_slr_nm1" value="">
							</td>
							<td>
								<select name="product_sts1">
                                <option value="">--select--</option>
                                	<option value="Active">Active</option>
                                	<option value="Pending">Pending</option>
                                    <option value="Suspended">Suspended</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
							</td>
                            <td></td>
						</tr>
						
						<?php 
                            $rows = $result->num_rows();
                            if($rows > 0){$i=1;
                            	foreach ($result->result() as $row){
									$arr_img = explode(',',$row->imag);
									$first_img = $arr_img[0];
									$qr_prodimg=$this->db->query("SELECT image FROM seller_existingproduct_image WHERE seller_extproduct_id='$row->seller_exist_product_id' ");
									if($qr_prodimg->num_rows()>0)
									{
										$rw_extnewimg=$qr_prodimg->row();
										$arr_img = explode(',',$rw_extnewimg->image);
										$first_img = $arr_img[0];
										
									}									
                        ?>
						<tr> 
							<td class="a-center">
                            	<input type="checkbox" name="chk_sellr[]" id="chk_sellr<?= $i ?>" value="<?=$row->seller_exist_product_id ; ?>"  onClick="chk_prodidrecord(<?= $i ?>)">
                                <span style="display:none;">
                  				<input type="checkbox" name="prod_id[]" id="prod_idchk<?= $i ?>" value="<?=$row->master_prodid ; ?>">
                                <input type="checkbox" name="prod_sku[]" id="prod_sku<?= $i ?>" value="<?=$row->sku ; ?>">          
                 	 			</span>
							</td>
                            <td><img src="<?php echo base_url().'images/product_img/catalog_'.$first_img; ?>" class="list_img"></td>
							<td><?=date('M-d-Y h:i:s A',strtotime($row->current_date))?></td>
							<td><?=$row->name ;?></td>
							<td><?=$row->seller_name ;?></td>
							<td><?=$row->approve_status ;?></td>
                            <td>
                            <a href="<?php echo base_url(); ?>admin/catalog/existing_product_edit/<?=$row->master_product_id;?>/<?=base64_encode($this->encrypt->encode($row->sku));?>">Edit</a>
                            
                           <!-- <a href="#">Edit</a>-->
                            
                            
                            </td>
						</tr>
						<?php 
							$i++;}
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
		prod_id
		var prod_id = $('input[name="prod_id[]"]:checked').map(function(_, el){
        	return $(el).val();
    	}).get();
		
		var prodsku = $('input[name="prod_sku[]"]:checked').map(function(_, el){
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
			$("#loader_div").css('display','block');
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>admin/sellers/change_seller_exiting_product_status",
				data: {'status':approval_status,'id':sel,'prod_id':prod_id,'prodextsku':prodsku},
				success: function () {
					//$("#show").html(data);
					//if(data == 'success'){
						window.location.reload(true);
						$("#loader_div").css('display','none');
					//}
				}
			});
		
		}
		
	}
	
}

function chk_prodidrecord(id)
{
	
	if(document.getElementById('chk_sellr'+id).checked== true)
	{
		$('#prod_idchk'+id).prop('checked','checked');	
		$('#prod_sku'+id).prop('checked','checked');

	}
	else if(document.getElementById('chk_sellr'+id).checked== false)
	{
		$('#prod_idchk'+id).prop('checked',false);
		$('#prod_sku'+id).prop('checked',false);	
		
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