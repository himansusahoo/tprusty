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
                                                
                                                <td>
                                                <div id="img_info"></div>
                                                <input type="button" class="all_buttons" id="product_imageaction_btn" onClick="changeProductimage()" value="Update Image As Per Color"></td>
											</tr>
										</table>
									<!--</form>-->
								</div>
							<form action="<?php echo base_url().'admin/sellers/filter_seller_existing_product/' ?>" method="post" >
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
                <div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
				<div>
					<table class="table table-bordered">
                     <tr style="display:;">
                     <?php
							
							if($fltr_product_sku){ ?>
                            <td colspan="11">Filtered Data  as  SKU:- <?php echo $fltr_product_sku;?> 
                            </td>
                           <?php }
                           
							
							if($fltr_product_nm){ ?>
                            <td colspan="11">Filtered Data  as  Product Name:- <?php echo $fltr_product_nm;?> 
                            </td>
                           <?php }
							
							
							
							else if(@$prod_cate){ ?>
                            <td colspan="11">Filtered Data  as  Product Category:-<?php echo @$prod_cate;?> 
                            </td>
                            <?php }
							
							
							
							
							else if($fltr_slr_nm){ ?>
                            <td colspan="11">Filtered Data  as Seller Name:- <?php echo $fltr_slr_nm;?> 
                            </td>
                            <?php }
							
							else if(@$mrp){ ?>
                            <td colspan="11">Filtered Data  as  MRP:-<?php echo @$mrp;?> 
                            </td>
                            <?php }
							
							
							
							
							else if(@$sell_prices){ ?>
                            <td colspan="11">Filtered Data  as  Selling Price:-<?php echo @$sell_prices;?> 
                            </td>
                            <?php }
							else if(@$quantity){ ?>
                            <td colspan="11">Filtered Data  as  Quantity:-<?php echo @$quantity;?> 
                            </td>
                            <?php }
							
							
							
							else if($product_sts){ ?>
                            <td colspan="11">Filtered Data  as  Product Status:-<?php echo $product_sts;?> 
                            </td>
                            <?php }
							
							else if($from_dt && $to_dt){ ?>
                            <td colspan="11">Filtered Data  as  Seller Applied Date:- <?php echo $from_dt;?> to <?php echo $to_dt;?>
                            </td>
                            <?php } ?>
                            </tr>
						<tr class="table table-bordered table-hover" style="background-color:#FC6;color:#FFF;">
							<th class="a-center" width="5%"><input type="checkbox" id="check_all"/></th>
							<th width="4%">Image</th>
                            <th width="8%">SKU</th>
                            <!--<th width="5%">Seller applied date</th>-->
							<th width="8%">Name</th>
                            <th width="8%">Product Category</th>
							<th width="8%">Seller Name</th>
                            <th width="5%">MRP</th>
                            <th width="5%">Selling Price</th>
                            <th width="4%">Quantity</th>
							<th width="5%">Status</th>
                            <th width="4%"> Action </th>
						</tr>
						<tr class="filter_tr">	<td></td>
							<td></td>
                            <td><input type="text" name="fltr_product_sku" id="sku" autocomplete="off">
                            <!--<div id="sku_dv" style="display:none;"><ul></ul></div>--></td>
							<!--<td>
								<div class="dt_dv"><div class="lft">From : </div><div class="rit"><input type="text" name="from_dt1" id="datepicker-example7-start1" class="dt"></div></div>
                                <div class="dt_dv"><div class="lft">To : </div><div class="rit"><input type="text" name="to_dt1" id="datepicker-example7-end1" class="dt"></div></div>
							</td>-->
							<td>
								<input type="text" name="fltr_product_nm" id="prod_nm" autocomplete="off">
                                <div id="prodnm_dv" style="display:none;"><ul></ul></div>
							</td>
                            <td><input type="text" name="prod_cate" id="prod_cate" autocomplete="off">
                            <div id="catg_nm_dv" style="display:none;"><ul></ul></div></td>
							<td>
								<input type="text" name="fltr_slr_nm" id="slr_nm" autocomplete="off">
                                <div id="slr_nm_dv"><ul></ul></div>
							</td>
                            <td><input type="number" name="mrp" value="" min="0"></td>
                            <td><input type="number" name="sell_prices" value="" min="0"></td>
                            <td><input type="number" name="quantity" value="" min="0"></td>
							<td>
								<select name="product_sts">
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
                  				<input type="checkbox" name="prod_idchk[]" id="prod_idchk<?= $i ?>" value="<?=$row->master_product_id ; ?>">
                                <input type="checkbox" name="prod_sku[]" id="prod_sku<?= $i ?>" value="<?=$row->sku ; ?>">          
                 	 			</span>
							</td>
                            <td><img src="<?php echo base_url().'images/product_img/catalog_'.$first_img; ?>" class="list_img"></td>
                            <td><?=$row->sku ;?></td>
							<?php /*?><td><?=date('M-d-Y h:i:s A',strtotime($row->current_date))?></td><?php */?>
							<td><?=$row->name ;?></td>
                            <td> 
                          <?php
					echo $row->lvlmain_name." >> ".$row->lvl1_name." >> ".$row->lvl2_name;
			 
			 ?>
                            </td>
							<td><?=$row->business_name ;?></td>
                            <td>Rs.<?=$row->mrp ;?></td>
                            <td>Rs.<?=$row->price ;?></td>
                            <td><?=$row->quantity ;?></td>
							<td><?=$row->approve_status ;?></td>
                            <td>
                            <a href="<?php echo base_url(); ?>admin/catalog/existing_product_edit/<?=$row->master_product_id;?>/<?=base64_encode($this->encrypt->encode($row->sku));?>">Edit</a>
                            
                           <!-- <a href="#">Edit</a>-->
                            
                            
                            </td>
						</tr>
						<?php $i++;}
							 }
							else{?>
                             <tr>
                            	<td colspan="11">No Record Found!</td>
                            </tr>
                            <?php }?>
					</table>
				</div>
              </form>
			</div>  <!-- @end #main-content -->
            <div id="show"></div>
		</div><!-- @end #content -->

<!--<style>
.dt {
    width: 150px;
}
.Zebra_DatePicker_Icon{left: 130px !important;}
.Zebra_DatePicker{z-index: 99999 !important;}
</style>
<style>
.Zebra_DatePicker_Icon{left: 10px !important; top: 0px !important;}
#non,#slr_nm_dv{ display:none;}
#sku_dv{position: absolute; z-index: 1000; background-color:seashell; width: 12%; border: 1px solid tan;  border-radius: 3px;}
#sku_dv ul {margin-bottom:0px !important;}
#sku_dv li { cursor: pointer;  list-style: outside none none;padding: 5px 5px 5px 10px;}
#sku_dv li:hover{background-color:tan;}
</style>
<script>
$(document).ready(function(){
	////seller name field script start here/////
	$("#sku").keyup(function(){
		//ShowLoder1();
		var sku=$(this).val();
		$('#sku_dv').css('display','block');
		$.ajax({
			url:'<?php// //echo //base_url().'admin/sellers/autofill_sku' ?>',
			method:'post',
			data:{fltr_product_sku:fltr_product_sku},
			success:function(data)
			{
				if(sku){
					$("#sku_dv ul").html(data);
					//HideLoder1();
				}else{
					$("#sku_dv ul").html("");
					//HideLoder1();
					$('#sku_dv').css('display','none');
				}
			}
		});
	});
////seller name field script end here/////
})


function getsku(val){
	var x = val
	var res = x.replace(/-/g,' ')
	$('#sku').val(res);
	$('#sku').css('color','black');
	$('#slr_nm_dv').css('display','none');
}
</script>-->
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
	$("#slr_nm").keyup(function(){
		//ShowLoder1();
		var fltr_slr_nm=$(this).val();
		$('#slr_nm_dv').css('display','block');
		$.ajax({
			url:'<?php echo base_url().'admin/sellers/autofill_seller' ?>',
			method:'post',
			data:{fltr_slr_nm:fltr_slr_nm},
			success:function(data)
			{
				if(fltr_slr_nm){
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
	$('#slr_nm').val(res);
	$('#slr_nm').css('color','black');
	$('#slr_nm_dv').css('display','none');
}
</script>	
<script>
$(document).ready(function(){
	$('#check_all').click(function(){
		$('input:checkbox').prop('checked', this.checked);
	});
});
</script>



<!--<style>
.Zebra_DatePicker_Icon{left: 10px !important; top: 0px !important;}
#non,#prodnm_dv{ display:none;}
#prodnm_dv{position: absolute; z-index: 1000; background-color:seashell; width: 12%; border: 1px solid tan;  border-radius: 3px;}
#prodnm_dv ul {margin-bottom:0px !important;}
#prodnm_dv li { cursor: pointer;  list-style: outside none none;padding: 5px 5px 5px 10px;}
#prodnm_dv li:hover{background-color:tan;}
</style>-->
<script>
/*$(document).ready(function(){
	////seller name field script start here/////
	$("#prod_nm").keyup(function(){
		//ShowLoder1();
		var fltr_product_nm=$(this).val();
		$('#prodnm_dv').css('display','block');
		$.ajax({
			url:'<?php //echo base_url().'admin/sellers/autofill_existprodnm' ?>',
			method:'post',
			data:{fltr_product_nm:fltr_product_nm},
			success:function(data)
			{
				if(fltr_product_nm){
					$("#prodnm_dv ul").html(data);
					//HideLoder1();
				}else{
					$("#prodnm_dv ul").html("");
					//HideLoder1();
					$('#prodnm_dv').css('display','none');
				}
			}
		});
	});
////seller name field script end here/////
})*/


//function getprodnm(val){
//	var x = val
//	var res = x.replace(/-/g,' ')
//	$('#prod_nm').val(res);
//	$('#prod_nm').css('color','black');
//	$('#prodnm_dv').css('display','none');
//}
</script>

<style>
#non,#slr_nm_dv{ display:none;}
#catg_nm_dv{position: absolute; z-index: 1000; background-color:seashell;  border: 1px solid tan;  border-radius: 3px;}
#catg_nm_dv ul {margin-bottom:0px !important;}
#catg_nm_dv li { cursor: pointer;  list-style: outside none none;padding: 5px 5px 5px 10px;}
#catg_nm_dv li:hover{background-color:tan;}
</style>
<script>
$(document).ready(function(){
	////seller name field script start here/////
	$("#prod_cate").keyup(function(){
		
		var cate_name=$(this).val();
		$('#catg_nm_dv').css('display','block');
		$.ajax({
			url:'<?php echo base_url().'admin/sellers/autofill_existcategory' ?>',
			method:'post',
			data:{cate_name:cate_name},
			success:function(data)
			{
				if(cate_name){
					$("#catg_nm_dv ul").html(data);
					//HideLoder1();
				}else{
					$("#catg_nm_dv ul").html("");
					//HideLoder1();
					$('#catg_nm_dv').css('display','none');
				}
			}
		});
	});
////seller name field script end here/////
})


function getcatgname(val,catgid){
	var x = val
	var res = x.replace(/-/g,' ')
	$('#prod_cate').val(res);
	
	//$('#catg_id').val(catgid);
	$('#prod_cate').css('color','black');
	$('#catg_nm_dv').css('display','none');
}

$(document).keyup(function(event){
        if(event.which === 27){
            $('#catg_nm_dv').hide();
        }
    });
	
</script>	
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

function changeProductimage()
{
	var prodsku = $('input[name="prod_sku[]"]:checked').map(function(_, el){
        	return $(el).val();
    	}).get();
		
		var prodids = $('input[name="prod_idchk[]"]:checked').map(function(_, el){
        	return $(el).val();
    	}).get();
		
		var sku_ids = document.getElementsByName("prod_sku[]");
		var skuid_count=sku_ids.length;
		
		var count=0;
		for (var i=0; i<skuid_count; i++) {
			if (sku_ids[i].checked === true) 
			{
				count++;
			}
		}
		
		if(count==0)
		{
			alert('Please select atleast one record');
			return false;
		}
		
		else{
		var ys = confirm("Do you want to change image ?");
		if(ys){
			
			//$('#product_imageaction_btn').val('Wait.....');
			$("#loader_div").css('display','block');
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>admin/sellers/change_seller_exiting_product_image",
				data: {prodextsku:prodsku,prodids:prodids},
				success: function (data) {
					//$("#img_info").html(data);
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
				