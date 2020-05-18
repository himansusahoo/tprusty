<?php
require_once('header.php');
?>
<script>

function validcatalogform()
{ 
	var prod_id=$('#id_1').val();	
	var name1=$('#name1').val();
	var slr_nm=$('#slr_nm').val();
	var select_att_name=$('#select_att_name').val();
	var sku=$('#sku').val();
	
	var id_from1=$('#id_from1').val();
	var id_to1=$('#id_to1').val();
	
	var id_from2=$('#id_from2').val();
	var id_to2=$('#id_to2').val();
	
	var status_name1=$('#status_name1').val();
	
	
	
	
	if(prod_id=='' && name1=='' && slr_nm=='' && select_att_name=='' && sku=='' && id_from1=='' 
		&& id_to1=='' && id_from2==''  && id_to2=='' && status_name1=='')	
	{	
		$("#exlshow_error2").css('display','block');
		$("#exlshow_error2").text('!Please Enter value In Any One Textbox');
		return false;
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
				success: function () {
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
	
	if(document.getElementById('chk_product'+id).checked== true)
	{
		$('#prod_idchk'+id).prop('checked','checked');	
		$('#prod_sku'+id).prop('checked','checked');

	}
	else if(document.getElementById('chk_product'+id).checked== false)
	{
		$('#prod_idchk'+id).prop('checked',false);
		$('#prod_sku'+id).prop('checked',false);	
		
	}	
		
}
</script>

			<div id="content">
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_catalog.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
					<div class="row content-header">
					<div class="col-md-8"> <h3>Manage Products</h3> 
                    <!--<button id="product_submit" class="seller_buttons" onclick="window.location.href='<?php //echo base_url().'admin/catalog/export_toexcel'?>'" > 
           <i class="fa fa-file-excel-o" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Export To Excel All Products 
           </button>--> 
           </div>
					<div class="col-md-4 show_report">
                   
              
                    <!--<button type="button" class="all_buttons" onClick="window.location.href='<?php //echo base_url().'admin/catalog/addnew_product' ?>'">Add Product</button>-->
                     </div>
                    
					</div>
                    <div class="col-md-6 left" >	
                        <table>
                            <tr>
                                <td>Actions</td>
                                <td>
                                    <select name="admin_product_action" id="admin_product_action" onChange="getActionVal(this.value)">
                                        <option value=""></option>
                                        <option value="Delete">Delete</option>
                                        <!--<option value="Change status">Change status</option>-->
                                        <option value="Update Attributes">Update Attributes</option>
                                    </select>&nbsp;
                                    
                                    <span id="non">status <select name="admin_product_sts" id="admin_product_sts">
                                                <option value=""></option>
                                                <option value="Enabled">Enabled</option>
                                                <option value="Disabled">Disabled</option>                                               
                                            </select></span>
                                </td>
                                <td><input type="button" name="admin_product_action_btn" id="admin_product_action_btn" class="all_buttons" value="Submit"></td>
                                <td><div id="loader_div" style="display:none; text-align:center;"> <img src="<?php echo base_url().'images/loading1.gif' ?>" /> </div></td>
                                                
                                                <td>
                                                <div id="img_info"></div>
                                                <?php if($this->session->userdata('logged_in')=='santanu') { ?>
                                                <?php /*?><input type="button" class="all_buttons" id="product_imageaction_btn" onClick="changeProductimage()" value="Update Image As Per Color"><?php */?><?php } ?>
                                                </td>
                            </tr>
                        </table>
					</div>
					
					<form action="<?php echo base_url().'admin/catalog/filtered_products' ?>" method="post" onSubmit="return validcatalogform()"  autocomplete="off">
				    <div  class="col-md-6 left">
                        <table class="multi_action">
							<tr>
								
									<!--<a href="#">Select All</a>
									<span class="separator">|</span>
									<a href="#">Unselect All</a>
									<span class="separator">|</span>
									<a href="#">Select Visible</a>
									<span class="separator">|</span>
									<a href="#">Unselect Visible</a>
									<span class="separator">|</span>
									0 items selected-->
							
								<td>
								
									
							<div class="right">
								
                                <input type="submit" class="all_buttons" value="Search" id="search"   />
							<input type="reset" class="all_buttons" value="Reset Filter" />
							</div>
							
								</td>
							</tr>
						</table>
					</div>	
					<div class="clearfix"></div>
					<div class="a-center" style="font-size:14px;"><?php echo $this->session->flashdata('product_add'); ?></div>
					<div class="clearfix"></div>
					<div>
                     	<div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
                        <div id="exlshow_error2" style="color:#F00; font-weight:bold; display:none;" align="center" ></div>
						<table class="table table-bordered table-hover">
                        <tr>
                            <?php
							
							if($id){ ?>
                            <td colspan="9">Filtered Data  as  Id:- <?php echo $id;?> 
                            </td>
                           <?php }
							
							else if($name){ ?>
                            <td colspan="9">Filtered Data  as  Name:- <?php echo $name;?> 
                            </td>
                            <?php }
							
							else if($slr_name){ ?>
                            <td colspan="9">Filtered Data  as  Seller:- <?php echo $slr_name;?> 
                            </td>
                            <?php }
							
							else if($id_from && $id_to){ ?>
                            <td colspan="9">Filtered Data  as  Price:- <?php echo $id_from;?>  to <?php echo $id_to;?>
                            </td>
                             <?php }
							
							else if($id_from2 && $id_to2){ ?>
                            <td colspan="9">Filtered Data  as  Quantity:- <?php echo $id_from2;?> to  <?php echo $id_to2;?>
                            </td>
                             <?php }
							
							else if($select_att_name){ ?>
                            <td colspan="9">Filtered Data  as  Attribute Name:-<?php echo $select_att_name;?> 
                            </td>
                             <?php }
							
							else if($sku){ ?>
                            <td colspan="9">Filtered Data  as  Sku:-<?php echo $sku;?> 
                            </td>
                             <?php }
							
							else if($status){ ?>
                            <td colspan="9">Filtered Data  as  Status:-<?php echo $status;?> 
                            </td>
                           <?php } ?>
                            </tr>
							<tr class="table_th">
								<th width="3%"></th>
								<th width="5%">ID</th>
								<th width="17%">Name</th>
								<!--<th width="15%">Type</th>-->
                                <th width="15%">Seller Name</th>
								<th width="10%">Attrib. Set Name</th>
								<th width="10%">SKU</th>
								<th width="10%">Price</th>
								<th width="5%">Qty</th>
								<!--<th width="10%">Visibility</th>-->
                                <th width="10%">Added Date</th>
								<th width="10%">Status</th>
								<th width="10%">Action</th>
							</tr>
							<tr class="filter_tr">
								<td><input type="checkbox" id="check_all"/></td>
								<td><input type="text" name="id_1" id="id_1" ></td>
								<td><input type="text" name="name1" id="name1" ></td>
								<td>
                                	<input type="text" name="slr_nm" id="slr_nm">
                                	<div id="slr_nm_dv"><ul></ul></div>
                                </td>
								<td>
									<select name="select_att_name" id="select_att_name">
                                    <option value=''>--select--</option>
										<?php foreach($result_attr_group as $row){ ?>
										<option value="<?= $row->attribute_group_id; ?>"><?= $row->attribute_group_name; ?></option>
                                         <?php } ?>
									</select>
								</td>
								<td>
									<input type="text" name="sku" id="sku" >
								</td>
								<td>
									<div>
										<span class="label" style="color:#000;">From:</span>
										<input type="text" name="id_from1" id="id_from1" >
									</div>
									<div>	
										<span class="label" style="color:#000;">To:</span>
										<input type="text" name="id_to1" id="id_to1" >
									</div>
									<!--<div>
										<span class="label">In:</span>
										<select>
											<option value=""></option>
											<option value="">INR</option>
										</select>
									</div>-->
								</td>
								<td>
									<div>
										<span class="label" style="color:#000;">From:</span>
										<input type="text" name="id_from2" id="id_from2" >
									</div>
									<div>	
										<span class="label" style="color:#000;">To:</span>
										<input type="text" name="id_to2" id="id_to2" >
									</div>
								</td>
                                <td></td>
								<td>
									<select name="status_name1" id="status_name1">
										<option value=''></option>
										<option value="Enabled">Enabled</option>
										<option value="Disabled">Disabled</option>
                                         <option value=" ">No Status</option>
									</select>
								</td>
								<td>
								</td>
							</tr>
                            <?php
								/*$row = $result->num_rows();
								if($row > 0){*/
								if($result != false){$i=1;
									foreach($result->result() as $rows){
										$cdate = date('Y-m-d');
										$special_price_from_dt = $rows->special_pric_from_dt;
										$special_price_to_dt = $rows->special_pric_to_dt;
							?>
                            <tr>
                            	<td style="text-align:center">
                                <input type="checkbox" name="chk_product[]" id="chk_product<?= $i ?>" value="<?=$rows->product_id ; ?>" onClick="chk_prodidrecord(<?= $i ?>)">
                                
                                <span style="display:none;">
                  				<input type="checkbox" name="prod_idchk[]" id="prod_idchk<?= $i ?>" value="<?=$rows->product_id ; ?>">
                                <input type="checkbox" name="prod_sku[]" id="prod_sku<?= $i ?>" value="<?=$rows->sku ; ?>">          
                 	 			</span>
                                </td>
                            	<td><?= $rows->product_id; ?></td>
                                <td> 
                                
                                <span style="float:left;"> 
                                <?php 
								$qr_slrprodimg=$this->db->query("select b.catelog_img_url  from seller_product_master a INNER JOIN  seller_existingproduct_image b ON a.seller_exist_product_id=b.seller_extproduct_id WHERE  a.sku='$rows->sku' ");
								if($qr_slrprodimg->num_rows()>0)
								{
									$rw_img=$qr_slrprodimg->row()->catelog_img_url;
								
								 ?>
                                 <img  class="list_img" src="<?php echo base_url().'images/product_img/'.$rw_img; ?>" >
                                 <?php }else{ ?>
                                 
                                <img  class="list_img" src="<?php echo base_url().'images/product_img/'.$rows->catelog_img_url; ?>" >
                                <?php } ?>
                                </span>
                                <?= $rows->name; ?>
                                
                                </td>
                                <td><?php if($rows->business_name == 'MoonBoy'){ echo 'Added By Admin';}else{ echo $rows->business_name;} ?></td>
                                <td><?= $rows->attribute_group_name; ?></td>
                                <td><?= $rows->sku; ?></td>
                                <td>
								<?php
								//Final price program start here//
                                if($rows->special_price !=0){
                                    if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                                        $actual_price = $rows->special_price;
                                    }else{
                                        if($rows->price != 0){
                                            $actual_price = $rows->price;
                                        }else{
                                            $actual_price = $rows->mrp;
                                        }
                                    }
                                }else{
                                    if($rows->price != 0){
                                        $actual_price = $rows->price;
                                    }else{
                                        $actual_price = $rows->mrp;
                                    }
                                }
								//Final price program end here//
                                ?>
        					<i class="icon-inr"></i> <?= number_format($actual_price, 2, ".", ",");?>
                                </td>
                                <td><?= $rows->quantity; ?></td>
                                <td><?php $prodadddt= substr($rows->add_date,0,10); 
											echo date('d-M-Y',strtotime($prodadddt));
								?></td>
                                <td><?= $rows->status; ?></td>
                                <td>
                               <?php /*?> <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rows->name)))).'/'.$rows->product_id.'/'.$rows->sku  ?>" target="_blank" ><?php */?>
                                
                                 <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rows->name)))).'/'.$rows->product_id.'/'.$rows->sku  ?>" target="_blank" >
                                      
                                <i style="font-size:16px;" class="fa fa-eye"></i>
                                </a>
                                <a href="<?php echo base_url(); ?>admin/catalog/product_edit/<?=$rows->product_id;?>/<?= base64_encode($this->encrypt->encode($rows->sku));?>" target="_blank">Edit</a>                          
                                </td>
                            </tr>
                            <?php 
							$i++;	}
							}else{
							?>
							<tr><td class="a-center" colspan="11">No records found ! </td></tr>
                            <?php } ?>
						</table>
					</div>
                 </form>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->
            
   
<style>
.Zebra_DatePicker_Icon{left: 10px !important; top: 0px !important;}
#non,#slr_nm_dv{ display:none;}
#slr_nm_dv{position: absolute; z-index: 1000; background-color:seashell; width: 12%; border: 1px solid tan;  border-radius: 3px;}
#slr_nm_dv ul {margin-bottom:0px !important;}
#slr_nm_dv li { cursor: pointer;  list-style: outside none none;padding: 5px 5px 5px 10px;}
#slr_nm_dv li:hover{background-color:tan;}
</style>  
    
<!--- Zebra_Datepicker link start here ---->
<!--<link href="../Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
<link href="../Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">
<script src="../Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script>
<script src="../Zebra_Datepicker-master/examples/public/javascript/core.js"></script>
<script src="../Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>-->
<!--- Zebra_Datepicker link end here ---->

<script>
$(document).ready(function(){
	$('#check_all').click(function(){
		$('input:checkbox').prop('checked', this.checked);
	});
});
</script>

<script>
$(document).ready(function(){
	$('#admin_product_action_btn').click(function(){
		var sel = $('input[name="chk_product[]"]:checked').map(function(_, el){
        	return $(el).val();
    	}).get();
		
		var action_val = $('#admin_product_action').val();
		if(action_val == 'Delete'){
			alert('pending');
		}
	});
});


function getActionVal(val){
	if(val == 'Change status'){
		$('#non').show();
	}else{
		$('#non').hide();
	}
}
</script>

<script>
$(document).ready(function(){
	////seller name field script start here/////
	$("#slr_nm").keyup(function(){
		//ShowLoder1();
		var slr_nam=$(this).val();
		$('#slr_nm_dv').css('display','block');
		$.ajax({
			url:'<?php echo base_url().'admin/catalog/autofill_seller' ?>',
			method:'post',
			data:{slr_nam:slr_nam},
			success:function(data)
			{
				if(slr_nam){
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

<?php
require_once('footer.php');
?>			