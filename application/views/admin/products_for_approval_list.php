<?php require_once('header.php');  ?>
		<div id="content">
			<div class="top-bar">
				<div class="top-left">
					<?php include 'sub_sellers.php'; ?>
				</div>
				<div class="top-right">
					<?php include 'top_right.php'; ?>
				</div>
			</div>  <!-- @end top-bar  -->
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
	$("#catg_name").keyup(function(){
		
		var catg_nm=$(this).val();
		$('#catg_nm_dv').css('display','block');
		$.ajax({
			url:'<?php echo base_url().'admin/sellers/autofill_category' ?>',
			method:'post',
			data:{catg_nm:catg_nm},
			success:function(data)
			{
				if(catg_nm){
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
	$('#catg_name').val(res);
	
	$('#catg_id').val(catgid);
	$('#catg_name').css('color','black');
	$('#catg_nm_dv').css('display','none');
}

$(document).keyup(function(event){
        if(event.which === 27){
            $('#catg_nm_dv').hide();
        }
    });
	
</script>            
			<div class="main-content">
            
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
					
					
				</div>
                <div class="col-md-6 left" >
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
                                                <td><div id="loader_div" style="display:none; text-align:center;"> <img src="<?php echo base_url().'images/loading1.gif' ?>" /> 
                                                </div></td>
											</tr>
										</table>
                                        
                                        <?php } ?>
									<!--</form>-->
								</div>
                                <form action="<?php echo base_url().'admin/sellers/filter_seller_product_data';?>" method="post" >
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
								
						 	<!--<input type="button" class="all_buttons" value="Search" id="search" onClick="filter_newprord_approv()"  />-->
                            <input type="submit" class="all_buttons" value="Search" id="search"  />
							<input type="button" class="all_buttons" value="Reset Filter" onClick="window.location.href='<?php echo base_url().'admin/sellers/product_for_approve'; ?>' " />
					
							</td>
						</tr>
					</table>
				</div>
                <div class="clearfix"></div>
                
                <div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
				<div class="table-responsive">
               

					<table class="table table-bordered">
                    <tr style="display:;">
                            <?php
							
							if($fltr_product_nm){ ?>
                            <td colspan="11">Filtered Data  as  Product Name:- <?php echo $fltr_product_nm;?> 
                            </td>
                           <?php }
							
							else if($fltr_slr_nm){ ?>
                            <td colspan="11">Filtered Data  as Seller Name:- <?php echo $fltr_slr_nm;?> 
                            </td>
                            <?php }
							
							else if($product_sts){ ?>
                            <td colspan="11">Filtered Data  as  Product Status:-<?php echo $product_sts;?> 
                            </td>
                            <?php }
							
							else if($from_dt && $to_dt){ ?>
                            <td colspan="11">Filtered Data  as  Date:- <?php echo $from_dt;?> <?php echo $to_dt;?>
                            </td>
                            <?php } ?>
                            </tr>
						<tr class="table_th">
							<th class="a-center" width="5%"><input type="checkbox" id="check_all"/></th>
							<th width="10%">Image</th>
                           <!-- <th width="10%">Date</th>-->
                             <th width="5%">SKU</th>
							<th width="10%">Product Name</th>
                            <th width="15%">Product Category</th>
                            <th width="3%">Product Status</th>
							<th width="7%">Seller Business Name</th>
							<th width="3%">Seller Status</th>
                            
                            <th width="5%">MRP</th>
                            <th width="5%">Selling Price</th>
                            <th width="5%">Quantity</th>
                            <th width="5%"> Action </th>
						</tr>
                        <tr style="background-color:#9CF;">
							<td></td>
							
                            <td></td>
							<td>
                            <input type="text" name="fltr_product_sku" id="fltr_product_sku" style="width:100px;" value="">
								<!--<div class="dt_dv"><div class="lft">From : </div><div class="rit"><input type="text" name="from_dt" id="datepicker-example7-start1" class="dt"></div></div>
                                <div class="dt_dv"><div class="lft">To : </div><div class="rit"><input type="text" name="to_dt" id="datepicker-example7-end1" class="dt"></div></div>-->
							</td>
							<td>
								<input type="text" name="fltr_product_nm" id="fltr_product_nm" value=''  style="width:150px;">
							</td>
                            <td><input type="text" name="catg_name" id="catg_name" autocomplete="off" value=''  style="width:150px;">
                            <input type="hidden" name="catg_id" id="catg_id" >
                            <div id="catg_nm_dv" style="display:none;"><ul></ul></div>
                          <?php /*?> <select name="catg_name" id="catg_name" data-placeholder="Choose Category" style="width:200px;" >
                                            <option value=''>--Select Catrgory--</option>
											<?php foreach($category_result as $catg_row){ ?>
                                            
                                            <option value="<?=$catg_row->lvl2;?>">
										<?=$catg_row->lvl2_name;?></option>
                                         
                                            <?php }?>
                                        </select><?php */?>
                                </td>
                                
                            <td><select name="product_sts" id="product_sts" style="width:70px;">
                                <option value="">--select--</option>
                                	<option value="Active">Active</option>
                                	<option value="Pending">Pending</option>
                                    <option value="Suspended">Suspended</option>
                                    <option value="Rejected">Rejected</option>
                                </select></td>
							<td>
								<input type="text" name="fltr_slr_nm" id="fltr_slr_nm" value='' >
							</td>
							<td>
                           <select name="seller_sts" id="seller_sts" style="width:70px;">
                                <option value=''>--select--</option>
                                	<option value="Active">Active</option>
                                	<option value="Pending">Pending</option>
                                    <option value="Suspended">Suspended</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
                            
								
							</td>
                            
                            <td>
                            <input type="text" name="prod_mrp" id="prod_mrp" value='' style="width:70px;">
                           <!-- <input type="button" class="all_buttons" value="Search" id="search" onClick="filter_newprord_approv()"  />-->
                            </td>
                            <td><input type="text" name="prod_saleprice" id="prod_saleprice" value='' style="width:70px;"></td>
                            <td><input type="text" name="prod_qnt" id="prod_qnt" value='' style="width:40px;"></td>
                            <td></td>
						</tr>
                        
                        
						<?php $i=1;
                            $rows = $result->num_rows();
                            if($rows > 0){
                            	foreach ($result->result() as $row){
									$arr_img = explode(',',$row->image);
									$first_img = $arr_img[0];
									
									//script start for registration process not completed seller condition.
									$slr_sql = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$row->seller_id'");
									$slr_sql_row = $slr_sql->num_rows();
									if($slr_sql_row < 1){
                        ?>
						<tr style="color:#FF3737;">
							<td class="a-center">
                            <input type="checkbox" name="chk_sellr[]" id="chk_sellr<?= $i ?>" value="<?=$row->seller_product_id ; ?>" onClick="chk_skurecord(<?= $i ?>)">
                             <span style="display:none;">
                  			<input type="checkbox" name="sku_id[]" id="sku_idchk<?= $i ?>" value="<?=$row->sku ; ?>">          
                 	 		</span>
                            </td>
                            <td><img src="<?php echo base_url().'images/product_img/catalog_'.$first_img; ?>" class="list_img"></td>
							<!--<td><?//=//$row->date_added ;?></td>-->
                            <td><?=$row->sku ;?></td>
							<td><?=$row->name ;?></td>
                            <td> 
                           <?php  $prodcatg_query=$this->db->query("SELECT DISTINCT a.lvl2, a.lvl2_name, a.lvl1, a.lvl1_name , a.lvlmain_name
			FROM  temp_category a INNER JOIN seller_product_category b ON a.lvl2=b.category WHERE b.seller_product_id='$row->seller_product_id'
			 "); 
			 		$rw_prodcatg=$prodcatg_query->row();
					echo $rw_prodcatg->lvlmain_name." >> ".$rw_prodcatg->lvl1_name." >> ".$rw_prodcatg->lvl2_name;
			 
			 ?>
                            </td>
                            <td><?=$row->product_approve?></td>
							<td><?=$row->seller_name ;?></td>
							<td>
                            <?=$row->status?>
                            <br/><span style="font-size:10px;">Incomplete Registration</span></td>
                            <td>Rs.<?=$row->mrp?></td>
                            <td>Rs.<?=@$row->price?></td>
                            <td><?=$row->quantity?></td>
						</tr>
                        <?php }else{ // End of registration process not completed seller condition.?>
                        <tr>
							<td class="a-center">
                            <input type="checkbox" name="chk_sellr[]" id="chk_sellr<?= $i ?>" value="<?=$row->seller_product_id ; ?>" onClick="chk_skurecord(<?= $i ?>)">
                              <span style="display:none;">
                  				<input type="checkbox" name="sku_id[]" id="sku_idchk<?= $i ?>" value="<?=$row->sku ; ?>">          
                 	 		</span>
                            </td>
                            <td><img src="<?php echo base_url().'images/product_img/catalog_'.$first_img; ?>" class="list_img"></td>
							<?php /*?><td><?= date('M-d-Y h:i:s A',strtotime($row->date_added)) ;?></td><?php */?>
                            <td> <?=$row->sku ;?></td>
							<td><?=$row->name ;?></td>
                            <td>
                            <?php  $prodcatg_query=$this->db->query("SELECT DISTINCT a.lvl2, a.lvl2_name, a.lvl1, a.lvl1_name , a.lvlmain_name
			FROM  temp_category a INNER JOIN seller_product_category b ON a.lvl2=b.category WHERE b.seller_product_id='$row->seller_product_id'
			 "); 
			 		$rw_prodcatg=$prodcatg_query->row();
					if($rw_prodcatg!=""){
					echo $rw_prodcatg->lvlmain_name." >> ".$rw_prodcatg->lvl1_name." >> ".$rw_prodcatg->lvl2_name;
					}
			 
			 ?>
                            </td>
                            <td><?=$row->product_approve?></td>
							<td><?=$row->seller_name ;?></td>
							<td>
                            
                            <?=$row->status?>
                            </td>
                            <td>Rs.<?=$row->mrp?></td>
                            <td>Rs.<?=@$row->price?></td>
                            <td><?=$row->quantity?></td>
                           <td>
                           <?php if($row->master_product_id == 0){?>
                           		<?php /*?><a href="<?php echo base_url(); ?>admin/catalog/pending_product_edit/<?=$row->seller_product_id;?>/<?= base64_encode($this->encrypt->encode($row->sku));?>">Edit</a><?php */?>
                               <?php /*?> <a href="<?php echo base_url().'admin/Sellers/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($row->name)))).'/'.$row->seller_product_id.'/'.$row->sku  ?>" target="_blank" ><i style="font-size:16px;" class="fa fa-eye"></i></a><?php */?>
                                
                                <a href="#">Edit</a>
                           <?php }else{?>
                          <?php /*?> <a href="<?php echo base_url().'admin/Sellers/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($row->name)))).'/'.$row->master_product_id.'/'.$row->sku  ?>" target="_blank" ><i style="font-size:16px;" class="fa fa-eye"></i></a><?php */?>
                           
                            <a href="#">Edit</a>
                           		<?php /*?><a href="<?php echo base_url(); ?>admin/catalog/product_edit/<?=$row->master_product_id;?>/<?= base64_encode($this->encrypt->encode($row->sku));?>">Edit</a><?php */?>
                           <?php } ?>
                           </td>
						</tr>
						<?php 
								}
							$i++;}
                          }else{
                        ?>
                        <tr><td colspan="12" style="text-align:center;">No Record Found !</td></tr>
                        <?php } ?>
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
		
		var sku_ids = $('input[name="sku_id[]"]:checked').map(function(_, el){
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
				url: "<?php echo base_url(); ?>admin/sellers/change_seller_product_status",
				data: {'status':approval_status,'id':sel,'sku_chkids':sku_ids},
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


function chk_skurecord(id)
{
	
	
	if(document.getElementById('chk_sellr'+id).checked== true)
	{
		$('#sku_idchk'+id).prop('checked','checked');	

	}
	else if(document.getElementById('chk_sellr'+id).checked== false)
	{
		$('#sku_idchk'+id).prop('checked',false);	
		
	}	
		
}




</script>


<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">


<?php
require_once('footer.php');
?>					