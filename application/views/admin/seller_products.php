<?php
require_once('header.php');
?>
<link rel="stylesheet" href="<?php echo base_url();?>css/admin/colorbox.css"/>
<script src="<?php echo base_url();?>js/jquery.colorbox.js"></script>


<link href="<?php echo base_url();?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
<link href="<?php echo base_url();?>Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">

<script src="<?php echo base_url();?>Zebra_Datepicker-master/examples/public/javascript/core.js"></script>
<script src="<?php echo base_url();?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>



<!--<script src="<?php// //echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
<script src="<?php// //echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php// //echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">-->
<style>
.Zebra_DatePicker_Icon{left: 250px !important; top: 3px !important;}
.Zebra_DatePicker{ z-index:9999999 !important;}
.shipping_dv{ display:none;}
.fa-database{ color:#DCC232;}
</style>
<style>
.Zebra_DatePicker_Icon{
	Left:82px !important;
	top:6px !important;
}
.Zebra_DatePicker{ z-index:999999 !important;}
</style>



		<div id="content">
			<div class="top-bar">
				<div class="top-left">
					<?php include 'sub_sellers.php';?>
				</div>
				<div class="top-right">
					<?php include 'top_right.php';?>
				</div>
			</div>  <!-- @end top-bar  -->
			<div class="main-content">
				<div class="row content-header">
					<h4>Product Details of Seller 
                    
                    <?php echo $buss_name->row()->business_name; ?>, Total Count : <?php echo $seller_product->num_rows();
                ?></h4>
					<div class="a-center">
					<?php
					if($this->session->flashdata('seller_approve')):echo $this->session->flashdata('seller_approve');endif;
					?>
					</div>
					<!--<div class="col-md-4 show_report">
						<button type="button" class="all_buttons">Add Seller</button>
					</div>-->
				</div>
				<div class="row mb10">
					<!--<div class="col-md-6">
						Page 
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
						per page <span class="separator">|</span> Total 2 records found
					</div>-->
					<div class="error_msg a-center"></div>
					<!--<div class="col-md-6 show_report">
						<button type="button" class="all_buttons" onClick="searchSeller()">Search</button>
						<button type="button" class="all_buttons">Reset Filter</button>
					</div>-->
				</div>
               
               
               
             <div class="a-center" id="ajax_res"></div>
             <!--<?php //if($this->session->flashdata('success')){ ?> 
   <p style="color:green"><?php //echo $this->session->flashdata('success'); ?></p>
  <?php //} ?>-->  
               <!--<?php// //if($this->session->flashdata('seller_products')){ ?>	<div style="color:#0C0;">
						<img src="<?php// //echo base_url().'images/success_icon.png' ?>">&nbsp<?php// //echo $this->session->flashdata('seller_products'); ?>
                        </div>
                        <?php// //} ?>-->
				<!--<form>-->
					<!--<table>
						<tr>
							<td>Actions</td>
							<td>
								<select name="action">
									<option value="">--Choose Action--</option>
									<option value="Delete">Delete</option>
									<option value="Change status">Change status</option>
									<option value="">Update Attributes</option>
								</select>
							</td>
							<td id="action_status" style="display:none;">
								<select>
									<option value="">--Status--</option>
									<option value="Enabled">Active</option>
									<option value="Disabled">Inactive</option>
								</select>
							</td>
							<td><input type="button" class="all_buttons" onclick="doAction()" value="Submit"></td>
						</tr>
					</table>-->
				<!--</form>-->
                <div id="loader_div" style="display:none; text-align:center;"> <img src="<?php echo base_url().'images/loading1.gif' ?>" /></div>
                <?php $seller_id=$this->uri->segment(4);?>
                <form action="<?php echo base_url().'admin/sellers/filter_sellprod/'.$seller_id; ?>" method="post" >
						<div class="col-md-6 right show_report">
							<input type="submit" class="all_buttons" value="Search" >
							<input type="reset" class="all_buttons" value="Reset Filter">
						</div>
                <div class="col-md-6 pagination">
				<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
			</div>
				
          
                
                <div class="clearfix"> </div>
             
				<div>                                 
                    <!--<a href="<?php// //echo base_url().'admin/sellers/seller_products/'.$seller_id ; ?>" target="_blank">View More</a>-->
					<table class="table table-bordered table-hover">
						<tr>
							<td width="5%">Product Id</td>
                            <td width="5%">SKU</td>
							<td width="18%">Product Name</td>
							<td width="5%">Product Image</td>
                            <td width="3%">Units in stock</td>
							<td width="6%">MRP</td>
                            <td width="6%">Selling price</td>
                            <td width="6%">Special Price</td>
							<td width="5%">Approve Status</td>
                            <td width="5%">Status</td>
							<td width="23%" colspan="2">Action</td>
                            <td width="4%">Settl. Value</td>
						</tr>
                        <tr class="filter_tr">
                            <td>
									<input type="text" name="prod_id" id="prod_id" >
								</td>
                                <td>
									<input type="text" name="sku" id="sku" >
								</td>
								<td>
									<input type="text" name="prod_nm" id="prod_nm" >
								</td>
								<td>
                                	
                                </td>
								<td>
									<input type="number" name="stock" id="stock" >
								</td>
								<td>
								<input type="number" name="mrp" id="mrp">
								</td>
                                <td>
									<input type="number" name="sellprce" id="sellprce" >
								</td>
                                <td>
									<input type="number" name="specprce" id="specprce" >
								</td>
                                
                                
								
                                <td>
                                	<select name="status" id="status">
										<option value="">--select--</option>
										<option value="Active">Active</option>
										<option value="Inactive">Inactive</option>
									</select>
                                </td>
                                <td>
                                	<select name="stat" id="stat">
										<option value="">--select--</option>
										<option value="Enabled">Enabled</option>
										<option value="Disabled">Disabled</option>
									</select>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                
								</tr>
                        <?php
								$product_row = $seller_product->num_rows();
								$j = 0;
								if($product_row > 0){
								foreach($seller_product->result() as $product){
								$j++;
								$cdate = date('Y-m-d');
								$image_cart=explode(',',$product->imag);
							?>
							<tr>
							<td> <?php echo $product->product_id; ?> </td>
                            <td> <?php echo $product->sku; ?> </td>
							<td> <?php echo $product->name; ?> </td>
                            
							<td> <?php /*?><a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($product->name)))).'/'.$product->product_id.'/'.$product->sku;?>" target="_blank"><?php */?>
                            
                             <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($product->name)))).'/'.$product->product_id.'/'.$product->sku;?>" target="_blank">
                            
                            
							<?php 
									$qr_slrprodimg=$this->db->query("select b.image  from seller_product_master a INNER JOIN  seller_existingproduct_image b ON a.seller_exist_product_id=b.seller_extproduct_id WHERE  a.sku='$product->sku' ");
								if($qr_slrprodimg->num_rows()>0)
								{
									$rw_img=$qr_slrprodimg->row()->image;
									$image_cart=explode(',',$rw_img);
								
							  ?>	
                                 <img  class="list_img" src="<?php echo base_url().'images/product_img/catalog_'.$image_cart[0]; ?>" width="30" >
                                <?php }else{ ?>
                                <img src="<?php echo base_url().'images/product_img/catalog_'.$image_cart[0]; ?>" width="30" class="list_img">
                                <?php } ?>
                                
                                </a>							
							</td>
                            <td> <?php echo $product->quantity; ?> </td>
							<td> <?php echo $product->mrp; ?> </td>
                            <td> <?php echo $product->price; ?> </td>
                            <td> <?php echo $product->special_price; ?> </td>
							<td> <?php echo $product->approve_status; ?> </td>
                            <td> <?php echo $product->status; ?> </td>
							<td>
								<select id="product_status<?=$j?>" onchange="change_product_status(this.value, <?=$j?>)" style="vertical-align: top;">
									<option value="">--Select Status--</option>
									<option value="Active">Active</option>
									<option value="Suspended">Blocked</option>
									<option value="Rejected">Permanently Blocked</option>
								</select>
								<textarea rows="5" cols="40" class="reason_block" id="reason_block<?=$j?>"></textarea>
								<button class="reason_block_btn" id="pro_inactiv_btn<?=$j?>" onclick="do_save_reject_pro(<?=$product->product_id?>, '<?=$product->sku?>', <?=$j?>)">Save</button>
							</td>
                            

                            <td><a href="<?php echo base_url(); ?>admin/catalog/product_edit/<?=$product->product_id;?>/<?= base64_encode($this->encrypt->encode($product->sku));?>" target="_blank">Edit</a>
                            
                            
                            
                            
                            <?php	
                              //program start for getting product price//
													if($product->special_pric_to_dt >= $cdate && $product->special_price != 0){
														$final_price = $product->special_price;
														$finalprc_n_shipping_fee = $final_price+$product->shipping_fee_amount;
													}else{
														if($product->price != 0){
															$final_price = $product->price;
															$finalprc_n_shipping_fee = $final_price+$product->shipping_fee_amount;
														}else{
															$final_price = $product->mrp;
															$finalprc_n_shipping_fee = $final_price+$product->shipping_fee_amount;
														}
													}
													?>
                       <td>
                                                    	
                                                        
                                                        
                                                        <span class="cal_spn" onClick="ShowCalculateDv(<?=$j;?>,<?=$product->category_id;?>,<?=$product->seller_id;?>,'<?=$final_price;?>','<?=$service_tax_res;?>','<?=$product->shipping_fee_amount;?>')"><i class="fa fa-database"></i></span>
                                                        <span>  <img src="<?php echo base_url();?>images/progress.gif" class="timer<?=$j;?>" style="display:none;float:right" /> </span><span class="loader<?=$j;?>" style="display:none;">wait...</span>
                                                        <div class="calculate_dv" id="calculate_dv<?=$j;?>">
                                                        	<div class="col-md-12" style="background:#227786;">
                                                            	<strong style="color:#fff;">Commission Calculator</strong>
                                                        		<span class="close_cal_dv" onClick="closeCalculateDv(<?=$j;?>)"><i class="fa fa-times"></i></span>
                                                            </div>
                                                            <div class="col-md-12">
                                                            	<table class="table">
                                                                	
                                                                    <tr>
                                                                    	<td colspan="4">Selling Price (<i class="fa fa-inr"></i> <?=$final_price;?>) + Shipping fee (<i class="fa fa-inr"></i> <?=$product->shipping_fee_amount;?>) = Total Sale Value (<i class="fa fa-inr"></i> <?=$finalprc_n_shipping_fee;?>)</td>
                                                                    </tr>
                                                                 </table>
                                                                 <table class="table-bordered">
                                                                	<tr class="commision_tr_hed cmn_box">
                                                                    	<th>Commission (<i class="fa fa-inr"></i>)</th>
                                                                        <?php if($fixed_charge_result != 'NOT'){ ?>
                                                                        <th>Fixed Fee (<i class="fa fa-inr"></i>)</th>
                                                                        <?php }?>
                                                                        <th>P.G Fee (<i class="fa fa-inr"></i>)</th>
                                                                        <?php if($seasonal_charge_result != 'NOT'){?>
                                                                        <th>Seasonal Fee (<i class="fa fa-inr"></i>)</th>
                                                                        <?php }?>
                                                                        <th>Service Tax (<i class="fa fa-inr"></i>)</th>
                                                                    </tr>
                                                                    <tr>
                                                                    	<td style="text-align:center;">
                                                                        	<span id="cmsn_spn<?=$j;?>"></span>
                                                                        </td>
                                                                        <?php 
																		if($fixed_charge_result != 'NOT'){ 
																		?>
                                                                        <td style="text-align:center;">
                                                                        <?php
																		$fix_chg_amount = $fixed_charge_result[0]->amount;
																		$fix_chg_percent = $fixed_charge_result[0]->percent;
																		$fixed_spn_id = 'fixed_spn'.$j;
																		if($fix_chg_amount == ''){
																			$percent_decimal = $fix_chg_percent/100;
																			$fixed_fee = round($finalprc_n_shipping_fee*$percent_decimal);
																			echo '<span id="'.$fixed_spn_id.'">'.$fixed_fee.'</span><br/><br/>';
																			echo '<span class="vspn">( '.$fix_chg_percent.'% of total sale value)</span>';
																		}else{
																			echo '<span id="'.$fixed_spn_id.'">'.$fix_chg_amount.'</span>';
																		}
																		?>
                                                                        </td>
                                                                        <?php } //end of $fixed_charge_result if condition?>
                                                                        <td style="text-align:center;">
                                                                        <!---Payment gateway Charges Program start here --->
																		<?php 
																		$pg_percent = $pg_charge_result[0]->percent;
																		$pg_spn_id = 'pg_spn'.$j;
																		$pg_percent_decimal = $pg_percent/100;
																		$pg_fee = round($finalprc_n_shipping_fee*$pg_percent_decimal);
																		echo '<span id="'.$pg_spn_id.'">'.$pg_fee.'</span><br/><br/>';
																		echo '<span class="vspn">( '.$pg_percent.'% of total sale value)</span>';
																		?>
                                                                        <!---Payment gateway Charges Program end here --->
                                                                        </td>
                                                                        <?php if($seasonal_charge_result != 'NOT'){?>
                                                                        <!---Seasonal Charges Program start here --->
                                                                        <td style="text-align:center;">
                                                                        <?php
                                                                        $seasonal_chg_amount = $seasonal_charge_result[0]->amount;
																		$seasonal_chg_percent = $seasonal_charge_result[0]->percent;
																		$season_spn_id = 'season_spn'.$j;
																		if($seasonal_chg_amount == ''){
																			$seasonal_percent_decimal = $seasonal_chg_percent/100;
																			$seasonal_fee = round($finalprc_n_shipping_fee*$seasonal_percent_decimal);
																			echo '<span id="'.$season_spn_id.'">'.$seasonal_fee.'</span><br/><br/>';
																			echo '<span class="vspn">( '.$seasonal_chg_percent.'% of total sale value)</span>';
																		}else{
																			echo '<span id="'.$season_spn_id.'">'.$seasonal_chg_amount.'</span>';
																		}
																		?>
                                                                        </td>
                                                                        <!---Seasonal Charges Program end here --->
                                                                        <?php }?>
                                                                        <td style="text-align:center">
                                                                        	<span id="servc_tax_spn<?=$j?>"></span><br/><br/>
                                                                            <span id="servc_tax_spn_detail<?=$j?>" class="vspn"></span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                    	<td colspan="5" style="text-align:right;">Settlement Value: <i class="fa fa-inr"></i> <span id="settled_spn<?=$j;?>"></span></td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </td>     
                           
                          </tr>
                                                    
							<?php }}else{
?>
						<tr>
							<td class="a-center" colspan="13">No record found!</td>
						</tr>
							<?php } ?>
					</table>
				</div>
                <!--<?php// } ?>-->
                                
							
                </form>
                <div class="pagination">
				<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
			</div>
			</div>  <!-- @end #main-content -->
		</div><!-- @end #content -->
		
<!--<script language="JavaScript">
function toggle(source) {
  checkboxes = document.getElementsByName('seller_id');
  for(var i=0, n=checkboxes.length; i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>-->
<script>
//function ShowCalculateDv(sl,second_leable_cat_id,final_price,service_tax,shipping_fee){
function ShowCalculateDv(j,third_leable_cat_id,seller_id,final_price,service_tax,shipping_fee){
    alert(final_price);
	var tax_percent_decimal = service_tax/100;
	$('.timer'+j).css('display','block');
	$('.loader'+j).css('display','block');
	
	$.ajax({
		//url:'<?php //echo base_url(); ?>seller/catalog/retrieve_commission',
		url:'<?php echo base_url(); ?>admin/sellers/retrieve_commission',
		method:'post',
		data:{cat_id:third_leable_cat_id,price:final_price,shipping_fee:shipping_fee,serial:j,seller_id:seller_id},
		success:function(result){
			$('#cmsn_spn'+j).html(result);

			/*settelment value calculation program start here*/
			var fixed_fee = $('#fixed_spn'+j).text();
			if(fixed_fee == '' || fixed_fee == 0){
				var fixed_fee = 0;
			}else{
				var fixed_fee = parseFloat($('#fixed_spn'+j).text());
			}
			
			var pg_fee = parseFloat($('#pg_spn'+j).text());
			
			var seasonal_fee = $('#season_spn'+j).text();
			if(seasonal_fee == '' || seasonal_fee == 0){
				seasonal_fee = 0;
			}else{
				var seasonal_fee = parseFloat($('#season_spn'+j).text());
			}
			
			/*service tax calculation in commission start here*/
			var commission = parseFloat($('.fcmsn'+j).text());
			var total_fees = fixed_fee+pg_fee+seasonal_fee+commission;
			var service_tax_amount = Math.round(total_fees*tax_percent_decimal);
			$('#servc_tax_spn'+j).text(service_tax_amount);
			$('#servc_tax_spn_detail'+j).text('( '+service_tax+'% of total fees value)');
			/*service tax calculation in commission end here*/
			
			var total_deduct_fee = fixed_fee+pg_fee+seasonal_fee+commission+service_tax_amount;
			var total_product_selling_price = parseFloat(final_price)+parseFloat(shipping_fee);
			var total_setteled_value = parseFloat(total_product_selling_price)-parseFloat(total_deduct_fee);
			$('#settled_spn'+j).text(total_setteled_value);
			/*settelment value calculation program end here*/
			$('#calculate_dv'+j).fadeIn();
			$('.timer'+j).css('display','none');
			$('.loader'+j).css('display','none');
			//alert(commission);
		}
	});
}

function closeCalculateDv(j){
	$('#calculate_dv'+j).fadeOut();
}
</script>
<script>
	function change_product_status(status, j){
		if(status == 'Rejected'){
			$('#reason_block'+j).show();
			//$('#pro_inactiv_btn'+j).show();
		}else if(status == 'Suspended'){
			$('#reason_block'+j).show();
			//$('#pro_inactiv_btn'+j).hide();
		}else{
			$('#reason_block'+j).hide();
		}
	}
	function do_save_reject_pro(product_id, sku, j){
		var base_url = '<?php echo base_url(); ?>';
		var controller = 'admin/sellers/';
		var reason = $("#reason_block"+j).val();
		var status = $("#product_status"+j).val();
		if(status == ""){
			alert("Please select status."); 
			return false;
		}else{
			$.ajax({
				url : base_url+controller+'product_inactive',
				type : 'POST',
				data : {reason:reason, status:status, sku:sku, product_id:product_id},
				success : function(){
					//if(data == 'success'){
						window.location.reload(true);
						$('#ajax_res').html("<div style='color:green;'>Product Status Updated Successfully.</div>");
						$('#reason_block'+j).hide();
					//}else{
						//window.location.reload(true);
						//$('#ajax_res').html("<div style='color:red;'>Product Status Update Failed.</div>");
					//}
				}
			});
		}
	}
	
</script>





		
<!--<script>
function getVal(val, seller_id, email){ 
	var base_url = "<?php //echo base_url(); ?>";
	var controller = "admin/sellers/";
	/*var checkboxes = document.getElementsByName('seller_id');
	var vals = "";
	for (var i=0, n=checkboxes.length; i<n; i++) {
		if (checkboxes[i].checked) {
			vals += ","+checkboxes[i].value;
		}
	}
	var val = vals.substring(1);
	alert(val);return false;
	*/
	 
	var m = confirm("Are you sure to change the status ?");  
	if(m){ 
	$("#loader_div").css('display','block');
		/*window.location.href = "<?php //echo site_url('admin/sellers/change_seller_status'); ?>/"+val+'/'+seller_id+'/'+email;*/
		$.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>admin/sellers/change_seller_status",
				data:{val:val, seller_id:seller_id, email:email},
				success:function(data) {
					window.location.reload(true);
					$("#loader_div").css('display','none');
				}
			});
	}
}

function doAction(){
	var base_url = "<?php echo base_url(); ?>";
	//var m = confirm("Are you Sure to change the Action ?");
	var action_val = $("select[name='action'] option:selected").val(); //alert(action_val); return false;
	
	// Code action functionality	
	
}

// Category filter
function searchSeller(){
	var base_url = "<?php echo base_url(); ?>"; 
	var controller = "admin/sellers/";
	var category_search_input = $("input[name='category_search_input']").val(); 
	if(category_search_input == ""){
		$("input[name='category_search_input']").focus().css('border','1px solid red');
		$(".error_msg").show().text('Please enter category name.');
		return false;
	}else{
		window.location.href = base_url+controller+"seller_search/" + category_search_input;
	}
}
</script>-->
<?php
require_once('footer.php');
?>					