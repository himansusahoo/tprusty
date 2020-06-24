<?php
require_once('header.php');
?>
<link rel="stylesheet" href="<?php echo base_url();?>css/admin/colorbox.css"/>
<script src="<?php echo base_url();?>js/jquery.colorbox.js"></script>

<!--- Zebra_Datepicker link start here ---->
<link href="<?php echo base_url();?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
<link href="<?php echo base_url();?>Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">

<script src="<?php echo base_url();?>Zebra_Datepicker-master/examples/public/javascript/core.js"></script>
<script src="<?php echo base_url();?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<!--- Zebra_Datepicker link end here ---->

<style>
.Zebra_DatePicker_Icon{left: 250px !important; top: 3px !important;}
.Zebra_DatePicker{ z-index:9999999 !important;}
.shipping_dv{ display:none;}
.fa-database{ color:#DCC232;}
</style>

<script>
$(document).ready(function(){
	$(".inline").colorbox({inline:true, width:"68%", height:"650px"});
	$(".inline").colorbox({'overlayClose': false, 'escKey': false});
});
</script>

<script>
$(document).ready(function(){
	$('li').click(function(ev){
		$(this).find('>ul').slideToggle();
		ev.stopPropagation();
	});
	
	$('input[name="productStatus[]"]').click(function(){ 
		var base_url = "<?php echo base_url(); ?>";
		var controller = "seller/catalog/"; 
		
		var checkboxes = document.getElementsByName('productStatus[]');
		var vals = "";
		for (var i=0, n=checkboxes.length; i<n; i++){
			if (checkboxes[i].checked) {
				vals += ","+checkboxes[i].value;
			}
		}
		
		var val = vals.substring(1);
		if(val){
			$.ajax({
				'url' : base_url + controller + 'filter_new_product_status',
				'type' : 'POST',
				'data' : 'approve_status='+val,
				'success' : function(data){
					$('#filtered_new_product_table').html(data);
				}
			});
		}else{
			window.location.reload(true);
		}
	
	});
	
});
</script>
			<div id="content">   
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_catalog.php';?>
					</div>
										
					<!-- header_session included here -->
					<?php
					require_once('header_session.php');
					?>
				</div>  <!-- @end top-bar  -->
				
				<!-- 31 <?php
				$seller_signup_id = $this->session->userdata('seller-signup-session');
				if(!$seller_signup_id) : 
				?>
							
				<?php
				endif;
				?>-->
			 <!-- @end top-bar  -->
				<div class="main-content">
					<?php require_once('common.php');
						require_once('product_tabmenu.php');
					?>
					<div class="row gray_bg">
						<div class="col-md-2 sidebar">
							<div><h3>My Products</h3></div>
							<!--<div class="row">
								<div class="col-md-12">
									<strong class="fsize15">BROWSE</strong>
									<hr>
								</div>
							</div>-->
							<div class="row">
								<div class="col-md-12">
									<h5><b>REFINE</b></h5>
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h5><b>Product Status</b></h5>
									<ul>
										<li><input type="checkbox" name="productStatus[]" value="Active"> Active </li>
										<li><input type="checkbox" name="productStatus[]" value="Pending"> Pending </li>
										<li><input type="checkbox" name="productStatus[]" value="Suspended"> Suspended </li>
										<li><input type="checkbox" name="productStatus[]" value="Rejected"> Rejected </li>
									</ul>
									<hr>
								</div>
							</div>
							<!--<div class="row">
								<div class="col-md-12">
									<h5><b>Stock Level</b></h5>
									<ul>
										<li><input type="checkbox"> Less than 5 </li>
										<li><input type="checkbox"> Out of Stock </li>
										<li><input type="checkbox"> 5 or More </li>
									</ul>
									<hr>
								</div>
							</div>-->
						</div>
						<div class="col-md-10 mt20">
							
							<div id="successfully_verify"></div>
							<div class="tab-content">
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											<div class="right mb10">
												<!--<span>
													<a href="#">Export</a>
													<span> | </span>
													<a href="#">Export All</a>
												</span>-->
											</div>
                                            <div class="pagination">
												<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
											</div>
                                            
                                            <div class="search_field_dv">
                                           		<?php	
                            					$attributes = array('class' => 'search');
                            					echo form_open_multipart('seller/catalog/search_nw_prdt_list_slr', $attributes);
                            					?>
                                            		<input type="text" name="search_title" id="search_title" placeholder="Search Product.." >
													<input type="submit" id="search_submit" class="srch-btn" value="Search">
												</form>
                                            </div>
											<table style="background-color:#fff;" class="table neworder_table table_first" id="filtered_new_product_table">
												<tr style="background-color:#f8f8f8;">
													<th width="35%">Product details</th>
													<th width="10%">Units in stock</th>
													<th width="10%">MRP</th>
													<th width="8%">Selling price</th>
                                                    <th width="8%">Special price</th>
													<th width="7%">Approve Status</th>
													<th width="10%">Status</th>
													<th width="5%">Action</th>
                                                    <th width="7%">Settl. Value</th>
												</tr>
												<?php
												if($product_details) {
													$sl=0;
												foreach ($product_details as $row):
												$sl++;
												$img = $row->image;
												$image = explode(',', $img);
                                                ?>
												<tr>
													<td class="return_order_details_td">
														<div class="row neworder_product_block">
															<div class="col-md-12">
                                                            <div class="left position_relative image_block">
																
                                                                	<?php 
																	if($row->product_approve == 'Active'){
																		//condition for if seller disabled the product
																		if($row->status=='Disabled'){
																	?>
                                                                    
                                                                   
                                                                    
                                                                    <img src="<?php echo base_url();?>images/product_img/<?php echo $row->catelog_img_url; ?>" onClick="alert('This product is Disabled \n So, you can not view in frontend.');return false;">
                                                                    
                                                                    <?php }else{?>
                                                                    
                                                                     <?php /*?><a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($row->name)))).'/'.$row->master_product_id.'/'.$row->sku;?>" target="_blank"><?php */?>
                                                                     <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($row->name)))).'/'.$row->master_product_id.'/'.$row->sku;?>" target="_blank">
                                                                     
                                                                     <img src="<?php echo base_url();?>images/product_img/<?php echo $row->catelog_img_url; ?>"></a>
																	
                                                                    <?php } }else{?>
                                                                    <img src="<?php echo base_url();?>images/product_img/<?php echo $row->catelog_img_url; ?>" onClick="alert('This product is not Active \n So, you can not view in frontend.');return false;">
                                                                    <?php }?>
																</div>
                                                                
                                                              
																<div class="left details_block">
																	<div>
																		<span class="block">
																			<?php 
																			if($row->product_approve=='Active'){
																				//condition for if seller disabled the product
																				if($row->status=='Disabled'){
																			?> 
                                                                             <img src="<?php echo base_url();?>images/block.png " width="15" height="15">
                                                                             <?php }else{?>
                                                                             <img src="<?php echo base_url();?>images/active.png " width="15" height="15">
                                                                             <?php } }?>
																			 
                                                                             <?php if($row->product_approve=='Suspended' || $row->product_approve=='Pending'){?> 
                                                                             <img src="<?php echo base_url();?>images/block.png " width="15" height="15"> 
																			 <?php }?>
                                                                             
                                                                              <?php if($row->product_approve=='Rejected'){?> 
                                                                             <img src="<?php echo base_url();?>images/banned.png " width="15" height="15"> 
																			 <?php }?>
                                                                            <strong>SKU: </strong>
																			<?php
																			//$newstr = substr($row->sku, 0, strpos($row->sku, '-', strpos($row->sku, '-')+1));
																			$newstr = substr($row->sku, 5);
																			
																			//$newstr1 = strpos($newstr,'-');
																			$newstr1 = substr($newstr,strpos($newstr,'-')+1);
																			
																			echo $newstr1.'</br>';
																			//echo $row->sku;
																			?>
																		</span>
                                                                        <?php
                                                                        if($row->product_approve == 'Active'){
																			//condition for if seller disabled the product
																			if($row->status=='Disabled'){
																		?>
                                                                         <strong><a href="#" onClick="alert('This product is Disabled \n So, you can not view in frontend.');return false;"><?=$row->name?></a></strong>
                                                                        	<?php }else{ ?>
																		<strong>
                                                                        <?php /*?><a href="<?php echo base_url().'product_description/product_detail/'.str_replace(" ","-",strtolower($row->name)).'/'.$row->master_product_id.'/'.$row->sku;?>" target="_blank"><?php */?>
																		
																		 <a href="<?php echo base_url().str_replace(" ","-",strtolower($row->name)).'/'.$row->master_product_id.'/'.$row->sku;?>" target="_blank">
                                                                         
																		<?=$row->name?></a></strong>
                                                                        
                                                                        <?php } }else{?>
                                                                        <strong><a href="#" onClick="alert('This product is not Active \n So, you can not view in frontend.');return false;"><?=$row->name?></a></strong>
                                                                        <?php }?>
																		<!--<table class="table attributes_table">
																			<tr>
																				<th>Brand</th>
																				<td>Selfie</td>
																			</tr>
																			<tr>
																				<th>Color</th>
																				<td>Black</td>
																			</tr>
																			<tr>
																				<th>Model Id</th>
																				<td>Stick With Bluetooth Shutter
																				</td>
																			</tr>
																		</table>-->
																		<span class="block">
																			<strong>Description : </strong>
																			<?php
																			$chr_desc = substr($row->description,0,50);
																			if(strlen($row->description) > 50){
																				echo $chr_desc.'...';
																			}else{
																				echo $chr_desc;
																			}
																			?>
																		</span>
																		<!--<span class="block">
																			<strong>Stock Status : </strong>
																			<?=$row->stock_avail?>
																		</span>-->
																	</div>
																</div>
															</div>
															<div class="clear"></div>
														</div>
													</td>
													<td><?=$row->quantity?></td>
													<td><?=$row->mrp?></td>
													<td><?=$row->price?></td>
                                                    <td>
													<?php
													
													$cdate = date('Y-m-d');
													if($row->price_to_dt >= $cdate){
														echo $row->special_price;
													}
													?>
                                                    </td>
													<td><?=$row->product_approve?></td>
													<td><?=$row->status?></td>
													<td>
														<a class='inline' href="#inline_content<?=$row->seller_product_id?>" title="Edit">
															<i class="fa fa-pencil-square-o" style="font-size:25px;"></i>
														</a>
													</td>
                                                    <?php
													//program start for getting product price//
													if($row->price_to_dt >= $cdate && $row->special_price != 0){
														$final_price = $row->special_price;
														$finalprc_n_shipping_fee = $final_price+$row->shipping_fee_amount;
													}else{
														if($row->price != 0){
															$final_price = $row->price;
															$finalprc_n_shipping_fee = $final_price+$row->shipping_fee_amount;
														}else{
															$final_price = $row->mrp;
															$finalprc_n_shipping_fee = $final_price+$row->shipping_fee_amount;
														}
													}
													//program end of getting product price//

													//program start for getting second leable category//
													  
													/*  $qr = $this->db->query("SELECT parent_id AS SECOND_LEABLE_CAT_ID FROM category_indexing WHERE category_id='$row->category'");
													 
													  $rs = $qr->result();
													  $secnd_leable_cat_id = $rs[0]->SECOND_LEABLE_CAT_ID;*/
													  
													  //program end of getting second leable category//
													?>
                                                    <td>
                                                    	
                                                        
                                                        
                                                        <span class="cal_spn" onClick="ShowCalculateDv(<?=$sl;?>,<?=$row->category;?>,'<?=$final_price;?>','<?=$service_tax_res;?>','<?=$row->shipping_fee_amount;?>')"><i class="fa fa-database"></i></span>
                                                        
                                                        <div class="calculate_dv" id="calculate_dv<?=$sl;?>">
                                                        	<div class="col-md-12" style="background:#227786;">
                                                            	<strong style="color:#fff;">Commission Calculator</strong>
                                                        		<span class="close_cal_dv" onClick="closeCalculateDv(<?=$sl;?>)"><i class="fa fa-times"></i></span>
                                                            </div>
                                                            <div class="col-md-12">
                                                            	<table class="table">
                                                                	
                                                                    <tr>
                                                                    	<td colspan="4">Selling Price (<i class="fa fa-inr"></i> <?=$final_price;?>) + Shipping fee (<i class="fa fa-inr"></i> <?=$row->shipping_fee_amount;?>) = Total Sale Value (<i class="fa fa-inr"></i> <?=$finalprc_n_shipping_fee;?>)</td>
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
                                                                        	<span id="cmsn_spn<?=$sl;?>"></span>
                                                                        </td>
                                                                        <?php 
																		if($fixed_charge_result != 'NOT'){ 
																		?>
                                                                        <td style="text-align:center;">
                                                                        <?php
																		$fix_chg_amount = $fixed_charge_result[0]->amount;
																		$fix_chg_percent = $fixed_charge_result[0]->percent;
																		$fixed_spn_id = 'fixed_spn'.$sl;
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
																		$pg_spn_id = 'pg_spn'.$sl;
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
																		$season_spn_id = 'season_spn'.$sl;
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
                                                                        	<span id="servc_tax_spn<?=$sl?>"></span><br/><br/>
                                                                            <span id="servc_tax_spn_detail<?=$sl?>" class="vspn"></span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                    	<td colspan="5" style="text-align:right;">Settlement Value: <i class="fa fa-inr"></i> <span id="settled_spn<?=$sl;?>"></span></td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </td>
												</tr>
<?php 
endforeach; 
	}else{
?>
												<tr>
													<td colspan="9" class="a-center">No record found !</td>
												</tr>
<?php
}
?>
											</table>
										</div>
									</div>
								</div>
								<div id="tab2" class="tab-pane fade">
									
								</div>
							</div>
                            
<?php 
	if($product_details) {				 
		$sl=0;
	foreach ($product_details as $row):
		$sl++;
	$img = $row->image; 
	$image = explode(',', $img);  
?>                            
							<div style="display:none">
								<div id='inline_content<?=$row->seller_product_id?>' style='padding:0 10px; background:#fff;'>
								
									<div class="lightbox_content">
										<div>
											<span class="validate_msg"></span>
											<h3>Edit Product</h3>
										</div>
										<div class="edit_form_content">
											<div class="row">
												<div class="col-md-4 right_border">
													<div><img src="<?php echo base_url(); ?>images/product_img/<?php echo $image[0]; ?>" width="65"></div>
													<div class="product-details">
														<h4 class="product-title"> <?=$row->name?> </h4>
														<table width="100%" border="0" cellspacing="5">
															<tr>
																<td>SKU :</td>
																<td id="sk<?=$sl;?>"><?=$row->sku;?></td>
															</tr>
															<tr>
																<td>Status :</td>
																<td>
																	<select id="product_status<?=$sl;?>" style="height:25px;">
																		<option value="">--Choose Status--</option>
																		<option value="Enabled" <?php if($row->status == 'Enabled'){?>selected="selected"<?php } ?> >Enabled</option>
																		<option value="Disabled" <?php if($row->status == 'Disabled'){?>selected="selected"<?php } ?> >Disabled</option>
																	</select>
																</td>
															</tr>
														</table>
													</div>
												</div>
												<div class="col-md-8">
													<table width="100%" border="0" cellspacing="5">
														<tr>
															<td>
																<label>MRP : </label><br>
																<input type="text" id="price<?=$sl; ?>" class="seller_input readonly_field" value="<?=$row->mrp?>" readonly>[INR]
																<input type="hidden" id="hidden_id<?=$sl; ?>" value="<?=$row->seller_product_id?>">
															</td>
															<td>
																<label>Selling Price : </label><br>
																<input type="text" id="selling_price<?=$sl; ?>" class="seller_input" value="<?=$row->price?>">[INR]
															</td>
														</tr>
														<tr>
															<td>
																<label>Quantity : </label><br>
																<input type="text" id="qty<?=$sl; ?>" class="seller_input" value="<?=$row->quantity?>">
															</td>
															<td>
																<label>Special Price : </label><br>
																<input type="text" id="special_price<?=$sl?>" class="seller_input" value="<?=$row->special_price?>">
															</td>
														</tr>
														<tr>
															<td>
																<label>Special Price From Date : </label><br>
																<input name="price_from_date" id="datepicker-example15-start<?=$sl?>" class="seller_input NEW_FROM_DATE" type="text" value="<?=$row->price_fr_dt?>">
															</td>
															<td>
																<label>Special Price To Date : </label><br>
																<input name="price_to_date" id="datepicker-example15-end<?=$sl?>" class="seller_input NEW_TO_DATE" type="text" value="<?=$row->price_to_dt?>">
															</td>
														</tr>
                                                        <tr>
															<td>
																<label>GST : </label><br>
																<input type="text" name="vat_cst" id="vat_cst<?=$sl?>" class="seller_input" value="<?=$row->tax_amount;?>" style="width:240px;">&nbsp;%
															</td>
															<td>
                                                				<label>Weight (in grams) <sup>*</sup> : </label><br>
																<input type="text" name="weight" id="prdt_weight<?=$sl?>" onFocus="removeDefaultShipping(<?=$sl?>)" value="<?=$row->weight?>" class="seller_input">
															</td>
														</tr>
                                                        <tr>
															<td>
																<label>Shipping Fee <sup>*</sup></label><br>
																<select name="shipping_typ" id="shipping_typ<?=$sl?>" class="seller_input" style="width:200px;" onChange="showshippingAmount(this.value, <?=$sl?>)">
																	<option value="">Choose shipping type</option>
																	<option value="Free" <?php if($row->shipping_fee == 0) {echo "selected";} ?> >Free</option>
																	<!--<option value="Flat">Flat</option>-->
																	<option value="Default" <?php if($row->shipping_fee > 0) {echo "selected";} ?> >Default</option>
																</select>
																<div class="req_shippingType">This is a required field.</div>
															</td>
															<td colspan="2">
                                                            
                                                            <?php if($row->shipping_fee == 0){ ?>
															<script>
                                                                $(document).ready(function(){
                                                                    $('#default_fee<?=$sl?>').hide();
                                                                });
                                                            </script>
                                                            <?php } ?>
															
																<div id="default_fee<?=$sl?>">Set Amount : 
																	<input type="text" class="seller_input" onKeyUp="calculateshippingCost(this.value, <?=$sl?>)" name="default_shipng_fee" id="default_shipng_fee<?=$sl?>" onBlur="CheckVal(this.value, <?=$sl?>)" value="<?php echo $row ? $row->shipping_fee : " "; ?>">[INR] (per 1kg.) &nbsp;&nbsp;&nbsp;&nbsp;
																	<span id="shpng_spn<?=$sl?>">Shipping fee : Rs.<?php echo $row ? $row->shipping_fee_amount : " "; ?></span>
																</div>
																<div class="req_shippingAmt">This is a required field.</div>
																<input type="hidden" id="hidden_shipping_fee<?=$sl?>" name="hidden_shipping_fee">
															</td>
														</tr>
					<tr><td><input type="button" name="submit" class="seller_buttons" onClick="validate_form(<?=$sl?>, <?=$row->seller_product_id?>,<?=$row->master_product_id?>,'<?=$row->product_approve?>' )" value="Save">
                                                  
                                                        </td></tr>
                                                        
													</table> 
                                                    
                    <div class="loader_div_seller" style="text-align:center;"> <img src="<?php echo base_url().'images/loading1.gif' ?>" /></div>
                                                   
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
<?php 
endforeach; 
	}
?>
							
						</div>
					</div>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->


			
<script>
$(document).ready(function(){
	$('#default_fee').show();
	var shipping_typ = $('#shipping_typ').val(); 
	if(shipping_typ == 'Free'){
		$('#default_fee').hide();
	}
});

</script>

<script>
function showshippingAmount(shipping_typ, sl){ 
	if(shipping_typ == 'Free'){ 
		$('#default_fee'+sl).hide();
		$('#default_shipng_fee'+sl).removeAttr('value');
		/*$('#flat_fee').hide();*/
	}else if(shipping_typ == 'Default'){ 
		//$('#flat_fee').hide(); 
		$('#default_fee'+sl).show();
	}
}
	
function calculateshippingCost(amount, sl){ 
	var product_weight_in_gm = $('#prdt_weight'+sl).val();
	var product_weight_in_kg = product_weight_in_gm/1000;
	var product_rounded_weight = Math.ceil(product_weight_in_kg);
	
	
	//allowed maximum shipping fee amount//
	var max_shipping_fee = product_rounded_weight*60;
	
	var input_shipping_fee = $('#default_shipng_fee'+sl).val(); 
	//alert(input_shipping_fee);return false;
	//var product_shipping_fee = Math.ceil(product_weight_in_kg*amount);
		
	if(input_shipping_fee > max_shipping_fee){
		alert('Your Maximum shipping amount Allowed  : Rs. '+ max_shipping_fee);
		$('#default_shipng_fee'+sl).val('');
		return false;
	}else{
		var shipping_amt = input_shipping_fee;
	}
	
	$('#shpng_spn'+sl).text('Shipping fee : Rs.'+ shipping_amt);
	$('#hidden_shipping_fee'+sl).val(shipping_amt);
}


function CheckVal(val, sl){
	if(isNaN(val)){
		alert("Please enter valid Shipping fee.");
		$('#default_shipng_fee'+sl).val('');
		$("#default_shipng_fee"+sl).css('border-color','red');
		return false;
	}else{
		var input_shipping_fee_ten = (val/10);
		if(Number.isInteger(input_shipping_fee_ten) === false){
			alert('Shipping fee amount should be multiple with 10');
			$('#default_shipng_fee'+sl).val('');
			$('#shpng_spn'+sl).text('Shipping fee : Rs.'+ 0);
			return false;
		}
	}
}

	
function removeDefaultShipping(sl){
	$('#default_shipng_fee'+sl).val('');
	$('#shpng_spn'+sl).text('Shipping fee : Rs.'+ 0);
	$('#hidden_shipping_fee').val(0);
}
</script>     
<style>
.loader_div_seller{display:none;}
</style>            

<script>
	function validate_form(sl, seller_product_id, master_product_id, product_approve){ 
	
	
		var base_url = "<?php echo base_url(); ?>";
		var controller = "seller/catalog/"; 
		
		var sku = $("#sk"+sl).text();
		var status = $("#product_status"+sl).val();
		var price = $("#price"+sl).val(); 
		var selling_price = $("#selling_price"+sl).val(); 
		var special_price = $("#special_price"+sl).val();
		var special_price_fr_date = $("#datepicker-example15-start"+sl).val(); 
		var special_price_to_date = $("#datepicker-example15-end"+sl).val(); 
		var qty = $("#qty"+sl).val();
		var vat_cst = $("#vat_cst"+sl).val();
		var weight = $("#prdt_weight"+sl).val();
		var shipping_typ = $("#shipping_typ"+sl).val(); 
		var default_shipng_fee = $("#default_shipng_fee"+sl).val();  
		var hidden_shipping_fee = $("#hidden_shipping_fee"+sl).val(); 
		
		if(status == ""){ 
			$("#product_status"+sl).css('border-color','red');
			$(".validate_msg").show().text('Product status is required.');	
			return false;
		}else if(selling_price == ""){
			$("#product_status"+sl).css('border-color','#ccc');
			$("#selling_price"+sl).css('border-color','red').focus();
			$(".validate_msg").show().text('Product Selling Price is required.');
			return false;
		}else if(isNaN(selling_price)){
			$("#product_status"+sl).css('border-color','#ccc');
			$("#selling_price"+sl).select().css('border-color','red');
			$(".validate_msg").show().text('Product Selling Price should be Integer value.');
			return false;
		}else if(parseFloat(selling_price) > parseFloat(price)){
			$("#product_status"+sl).css('border-color','#ccc');
			$("#selling_price"+sl).select().css('border-color','red');
			$(".validate_msg").show().text('Selling Price should be less than MRP.');
			return false;
		}else if(special_price == ""){
			$("#product_status"+sl).css('border-color','#ccc');
			$("#selling_price"+sl).css('border-color','#ccc');
			$("#special_price"+sl).select().css('border-color','red');
			$(".validate_msg").show().text('Product Special Price is required.');
			return false;
		}else if(isNaN(special_price)){
			$("#product_status"+sl).css('border-color','#ccc');
			$("#selling_price"+sl).css('border-color','#ccc');
			$("#special_price"+sl).select().css('border-color','red');
			$(".validate_msg").show().text('Special Price should be an Integer value.');
			return false;
		}else if(parseFloat(special_price) > parseFloat(price)){
			$("#product_status"+sl).css('border-color','#ccc');
			$("#selling_price"+sl).css('border-color','#ccc');
			$("#special_price"+sl).select().css('border-color','red');
			$(".validate_msg").show().text('Special Price should be less than MRP.');
			return false;
		}else if((special_price != "" && special_price != 0) && special_price_fr_date == "0000-00-00"){
			$("#product_status"+sl).css('border-color','#ccc');
			$("#selling_price"+sl).css('border-color','#ccc');
			$("#special_price"+sl).css('border-color','#ccc');
			$("#datepicker-example15-start"+sl).css('border-color','red');
			$(".validate_msg").show().text('Special Price from date is required.');
			return false;
		}else if((special_price != "" && special_price != 0) && special_price_to_date == "0000-00-00"){
			$("#product_status"+sl).css('border-color','#ccc');
			$("#selling_price"+sl).css('border-color','#ccc');
			$("#special_price"+sl).css('border-color','#ccc');
			$("#datepicker-example15-start"+sl).css('border-color','#ccc');
			$("#datepicker-example15-end"+sl).css('border-color','red');
			$(".validate_msg").show().text('Special Price to date is required.');
			return false;
		}else if(qty == ""){
			$("#product_status"+sl).css('border-color','#ccc');
			$("#selling_price"+sl).css('border-color','#ccc');
			$("#special_price"+sl).css('border-color','#ccc');
			$("#qty"+sl).css('border-color','red').focus();
			$(".validate_msg").show().text('Product Quantity is required.');
			return false;
		}else if(isNaN(qty)){
			$("#product_status"+sl).css('border-color','#ccc');
			$("#selling_price"+sl).css('border-color','#ccc');
			$("#special_price"+sl).css('border-color','#ccc');
			$("#qty"+sl).select().css('border-color','red');
			$(".validate_msg").show().text('Product Quantity should be an Integer value.');
			return false;
		}else if(vat_cst == ""){
			$("#product_status"+sl).css('border-color','#ccc');
			$("#selling_price"+sl).css('border-color','#ccc');
			$("#special_price"+sl).css('border-color','#ccc');
			$("#qty"+sl).css('border-color','#ccc');
			$("#vat_cst"+sl).css('border-color','red').focus();
			$(".validate_msg").show().text('GST is required.');
			return false;
		}else if(isNaN(vat_cst)){
			$("#product_status"+sl).css('border-color','#ccc');
			$("#selling_price"+sl).css('border-color','#ccc');
			$("#special_price"+sl).css('border-color','#ccc');
			$("#qty"+sl).css('border-color','#ccc');
			$("#vat_cst"+sl).css('border-color','red').select();
			$(".validate_msg").show().text('Invalid Amount.');
			return false;
		}else if(weight == ""){
			$("#product_status"+sl).css('border-color','#ccc');
			$("#selling_price"+sl).css('border-color','#ccc');
			$("#special_price"+sl).css('border-color','#ccc');
			$("#qty"+sl).css('border-color','#ccc');
			$("#vat_cst"+sl).css('border-color','#ccc');
			$("#prdt_weight"+sl).focus().css('border-color','red');
			$(".validate_msg").show().text('Weight required.');
			return false;
		}else if(isNaN(weight)){
			$("#product_status"+sl).css('border-color','#ccc');
			$("#selling_price"+sl).css('border-color','#ccc');
			$("#special_price"+sl).css('border-color','#ccc');
			$("#qty"+sl).css('border-color','#ccc');
			$("#vat_cst"+sl).css('border-color','#ccc');
			$("#prdt_weight"+sl).css('border-color','red').select();
			$(".validate_msg").show().text('Invalid Weight.');
			return false;
		}else if(shipping_typ == ""){
			$("#product_status"+sl).css('border-color','#ccc');
			$("#selling_price"+sl).css('border-color','#ccc');
			$("#special_price"+sl).css('border-color','#ccc');
			$("#qty"+sl).css('border-color','#ccc');
			$("#vat_cst"+sl).css('border-color','#ccc');
			$("#prdt_weight"+sl).css('border-color','#ccc');
			$("#shipping_typ"+sl).css('border-color','red');
			$(".validate_msg").show().text('Shipping Type required.');
			return false;			
		}else if(shipping_typ == "Default" && default_shipng_fee == 0){
			$("#product_status"+sl).css('border-color','#ccc');
			$("#selling_price"+sl).css('border-color','#ccc');
			$("#special_price"+sl).css('border-color','#ccc');
			$("#qty"+sl).css('border-color','#ccc');
			$("#vat_cst"+sl).css('border-color','#ccc');
			$("#prdt_weight"+sl).css('border-color','#ccc');
			$("#shipping_typ"+sl).css('border-color','#ccc');
			$("#default_shipng_fee"+sl).css('border-color','red');
			$(".validate_msg").show().text('Shipping fee required.');
			return false;
		}else if(shipping_typ == "Default" && isNaN(default_shipng_fee)){
			$("#product_status"+sl).css('border-color','#ccc');
			$("#selling_price"+sl).css('border-color','#ccc');
			$("#special_price"+sl).css('border-color','#ccc');
			$("#qty"+sl).css('border-color','#ccc');
			$("#vat_cst"+sl).css('border-color','#ccc');
			$("#prdt_weight"+sl).css('border-color','#ccc');
			$("#shipping_typ"+sl).css('border-color','#ccc');
			$("#default_shipng_fee"+sl).css('border-color','red').select();
			$(".validate_msg").show().text('Invalid Shipping fee.');
			return false;
		}else{ 
			
			$("#product_status"+sl).css('border-color','#ccc');
			$("#selling_price"+sl).css('border-color','#ccc');
			$("#qty"+sl).css('border-color','#ccc');
			$("#special_price"+sl).css('border-color','#ccc');
			$("#vat_cst"+sl).css('border-color','#ccc');
			$("#prdt_weight"+sl).css('border-color','#ccc');
			$("#shipping_typ"+sl).css('border-color','#ccc');
			$("#default_shipng_fee"+sl).css('border-color','#ccc');
			$(".validate_msg").hide();
			
			$('.loader_div_seller').css('display','block');
			$.ajax({
				url : base_url + controller + 'update_new_product',
				type : 'POST',
				data : {status:status,price:price,selling_price:selling_price,special_price:special_price,special_price_fr_date:special_price_fr_date, special_price_to_date:special_price_to_date, qty:qty, seller_product_id:seller_product_id, master_product_id:master_product_id,vat_cst:vat_cst,weight:weight,shipping_typ:shipping_typ,default_shipng_fee:default_shipng_fee,hidden_shipping_fee:hidden_shipping_fee,sku:sku},
				success : function(data){
					
					//if(data == "success"){
						//$('.loader_div_seller').css('display','none');
						window.location.reload(true);
					//}else{
//						$('#loader_div_seller').css('display','none');
//						$("#successfully_verify").html("<div style='color:red;' class='a-center'> Product update Failed.</div>");
//					}
				}
			});
		}
	}
</script>

<script>
//function ShowCalculateDv(sl,second_leable_cat_id,final_price,service_tax,shipping_fee){
function ShowCalculateDv(sl,third_leable_cat_id,final_price,service_tax,shipping_fee){
	var tax_percent_decimal = service_tax/100;
	
	$.ajax({
		url:'<?php echo base_url(); ?>seller/catalog/retrieve_commission',
		method:'post',
		data:{cat_id:third_leable_cat_id,price:final_price,shipping_fee:shipping_fee,serial:sl},
		success:function(result){
			$('#cmsn_spn'+sl).html(result);

			/*settelment value calculation program start here*/
			var fixed_fee = $('#fixed_spn'+sl).text();
			if(fixed_fee == '' || fixed_fee == 0){
				var fixed_fee = 0;
			}else{
				var fixed_fee = parseFloat($('#fixed_spn'+sl).text());
			}
			
			var pg_fee = parseFloat($('#pg_spn'+sl).text());
			
			var seasonal_fee = $('#season_spn'+sl).text();
			if(seasonal_fee == '' || seasonal_fee == 0){
				seasonal_fee = 0;
			}else{
				var seasonal_fee = parseFloat($('#season_spn'+sl).text());
			}
			
			/*service tax calculation in commission start here*/
			var commission = parseFloat($('.fcmsn'+sl).text());
			var total_fees = fixed_fee+pg_fee+seasonal_fee+commission;
			var service_tax_amount = Math.round(total_fees*tax_percent_decimal);
			$('#servc_tax_spn'+sl).text(service_tax_amount);
			$('#servc_tax_spn_detail'+sl).text('( '+service_tax+'% of total fees value)');
			/*service tax calculation in commission end here*/
			
			var total_deduct_fee = fixed_fee+pg_fee+seasonal_fee+commission+service_tax_amount;
			var total_product_selling_price = parseFloat(final_price)+parseFloat(shipping_fee);
			var total_setteled_value = parseFloat(total_product_selling_price)-parseFloat(total_deduct_fee);
			$('#settled_spn'+sl).text(total_setteled_value);
			/*settelment value calculation program end here*/
			$('#calculate_dv'+sl).fadeIn();
			//alert(commission);
		}
	});
}

function closeCalculateDv(sl){
	$('#calculate_dv'+sl).fadeOut();
}
</script>

</div>
	</body>
</html>