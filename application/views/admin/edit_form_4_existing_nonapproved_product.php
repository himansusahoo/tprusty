<?php
require_once("header.php");
?>
<link href="<?php echo base_url();?>css/admin/uploadfile.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url(); ?>js/countries.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url().'js/jquery.collapsibleCheckboxTree.js' ?>"></script>

<script type="text/javascript">
jQuery(document).ready(function(){
	$('ul#example').collapsibleCheckboxTree();
});
</script>

<script>
function delete_image(product_id, sku, image_name){
	$.ajax({
		url:'<?php echo base_url(); ?>admin/catalog/edit_productimg',
		method:'post',
		data:{product_id:product_id,image_name:image_name,sku:sku},
		success:function(data){
			//$('.valid_msg_dv').show();
			//$('.valid_msg_dv').html(data);
			if(data == 'success'){
				window.location.reload(true);
				/*setTimeout(function(){
   				//$("#edit_img_tbl").load("<?php// echo current_url(); ?> #edit_img_tbl");
				$("#condn").load("<?php// echo current_url();?> #condn");
				}, 1000);*/
			}
		}
	});
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
                
                <?php echo form_open_multipart('admin/catalog/update_nonapproved_existing_product_data');?>
					<div class="row content-header">
                    	<div class="col-md-2">&nbsp;</div>
						<div class="col-md-10">
                        	&nbsp;
						<!--<div class="col-md-4 show_report">-->
							<input type="button" class="all_buttons" value="Cancel" onClick="window.location.href='<?php echo base_url();?>admin/sellers/product_exiting_for_approve'">
							<!--<button type="button" onClick="window.location.href='<?php// echo base_url().'admin/catalog' ?>'" class="all_buttons">Back</button>-->
                            <button type="submit" class="all_buttons" onClick="return Valid_existing_approved_product_edit_form()">Save</button>
						<!--</div>-->
                        </div>
					</div>
                    
                    <div class="clearfix"></div>
                   	
                    <!--<div class="left-sidebar border_non">
                    	<ul>
                        	<li><a href="#">Settings</a></li>
                        </ul>
                    </div>-->
                    
                           
           <!-- @start #right-content -->
           <!--<div class="right-cont">-->
           
          <!-- <div id="show_error" align="center" style="color:#F00;"></div>-->
		  <div id="searched_transaction"></div>
          <div class="valid_msg_dv"></div>
           
			<ul class="nav nav-tabs tabs-horiz">
				<!--<li id="li_tab1" class="active"><a data-toggle="tab" href="#tab1">Create Product Settings</a></li>-->
				<li id="li_tab2" class="active"><a data-toggle="tab" href="#tab2">General Information</a></li>
				<li id="li_tab3"><a data-toggle="tab" href="#tab3">Inventory & Prices</a></li>
				<!--<li id="li_tab4"><a data-toggle="tab" href="#tab4">Meta Information</a></li>-->
               	<!--<li id="li_tab5"><a data-toggle="tab" href="#tab5">Images</a></li>-->
               <!-- <li id="li_tab6"><a data-toggle="tab" href="#tab6">Inventory</a></li>
                <li id="li_tab7"><a data-toggle="tab" href="#tab7">Categories</a></li>-->
               <!-- <li id="li_tab8"><a data-toggle="tab" href="#tab8">Related Products</a></li>-->
			</ul>
			
			<!--<div class="tab-content form_view">-->
			<div class="tab-content form_view">                
				<div id="tab2" class="tab-pane fade in active">
					<h3>General</h3>
					<table>
                    	<tr>
                            <td width="30%">Category Name: </td>
                            <td><?=$edit_product_details[0]->category_name;?></td>
                  		</tr>   
						<tr>
							<td>Attribute Set Name : </td>
							<td>
								<?php foreach($result as $row){ ?>
                                       <?php if($edit_product_details[0]->attribute_group_name == $row->attribute_group_name){ ?>
                                        <?php echo $row->attribute_group_name ;?>
                                        <?php } ?>
                                <?php } ?>
                            </td>
						</tr>
						<tr>
							<td style="width:20%;"> Name </td>
							<td>
								<input type="hidden" name="hidden_product_sellerid" value="<?=$edit_product_details[0]->seller_id;?>">
								<input type="hidden" name="hidden_product_id" value="<?=$edit_product_details[0]->product_id;?>">
								<input type="hidden" name="hidden_product_sku" value="<?=$edit_product_details[0]->sku?>">
								<!--<input type="hidden" name="hidden_product_image" value="<?//=$edit_product_details[0]->imag?>">-->
								<!--<input type="hidden" name="name" id="prdt_name" class="text" value="<?php// echo $edit_product_details ? $edit_product_details[0]->name : " "; ?>">-->
								<span><?php echo $edit_product_details ? $edit_product_details[0]->name : " "; ?></span>
							</td>
						</tr>
						<tr>
							<td> Description </td>
							<td> 
								<?php /*?><textarea rows="7" class="text" name="prdt_desc" id="prdt_desc"><?php echo $edit_product_details ? $edit_product_details[0]->description : " "; ?></textarea><?php */?>
								<p><?php echo $edit_product_details ? $edit_product_details[0]->description : " "; ?></p>
							</td>
						</tr>
						<tr>
							<td> product highlights </td>
							<td> 
								<?php $data = unserialize($edit_product_details[0]->short_desc); ?>
								<?php /*?><input type="text" name="prdt_short_desc[]" id="prdt_short_desc" class="text" maxlength="30" value="<?=$data['0'];?>"><br/><br/>
                                <input type="text" name="prdt_short_desc[]" class="text" maxlength="30" value="<?=$data['1'];?>"><br/><br/>
                                <input type="text" name="prdt_short_desc[]" class="text" maxlength="30" value="<?=$data['2'];?>"><br/><br/>
                                <input type="text" name="prdt_short_desc[]" class="text" maxlength="30" value="<?=$data['3'];?>"><br/><br/>
                                <input type="text" name="prdt_short_desc[]" class="text" maxlength="30" value="<?=$data['4'];?>"><?php */?>
                                <?php if($data['0'] != ''){ ?><span><?=$data['0'];?></span><br/><br/><?php }?>
                                <?php if($data['1'] != ''){ ?><span><?=$data['1'];?></span><br/><br/><?php }?>
                                <?php if($data['2'] != ''){ ?><span><?=$data['2'];?></span><br/><br/><?php }?>
                                <?php if($data['3'] != ''){ ?><span><?=$data['3'];?></span><br/><br/><?php }?>
                                <?php if($data['4'] != ''){ ?><span><?=$data['4'];?></span><br/><br/><?php }?>
							</td>
						</tr>
						<tr>
							<td> SKU <sup>*</sup> </td>
							<!--<td> <input type="text" name="sku1" id="prdt_sku" class="text" onBlur="checkSku(this.value)" value="<?php// echo $edit_product_details ? $edit_product_details[0]->sku : " "; ?>"> </td>-->
                            
                            <td> <input type="text" name="sku1" id="prdt_sku" class="text" readonly value="<?php echo $edit_product_details ? $edit_product_details[0]->sku : " "; ?>"> </td>
						</tr>
						<!--<tr>
							<td> Weight <sup>*</sup> </td>
							<td> <input type="text" name="weight" id="prdt_weight" class="text" value="<?php// echo $edit_product_details ? $edit_product_details[0]->weight : " "; ?>"> </td>
						</tr>-->
						<tr>
							<td>Set Product as New from Date</td>
							<td><input name="from_date" class="text2 dt" id="datepicker-example7-start" value="<?php echo $edit_product_details ? $edit_product_details[0]->set_product_as_nw_frm_dt : " "; ?>"></td>
						</tr>
						<tr>
							<td>Set Product as New to Date</td>
							<td><input name="to_date" class="text2 dt" id="datepicker-example7-end" value="<?php echo $edit_product_details ? $edit_product_details[0]->set_product_as_nw_to_dt : " "; ?>"></td>
						</tr>
						<tr>
							<td> Status <sup>*</sup> </td>
							<td> 
								<select id="prdt_sts" name="prdt_sts" class="text2">
									<option value="">-- Please Select --</option>
									<option value="Enabled" <?php if($edit_product_details[0]->status == 'Enabled') {echo "selected";}?> >Enabled</option>
									<option value="Disabled" <?php if($edit_product_details[0]->status == 'Disabled') {echo "selected";}?> >Disabled</option>
								</select>
							</td>
						</tr>
						<!--<tr>
							<td> Visibility <sup>*</sup> </td>
							<td> 
								<select class="text2" name="prdt_visibility" id="prdt_visibility">
									<option value="">-- Please Select --</option>
									<option value="Not Visible Individually">Not Visible Individually</option>
									<option value="Catalog">Catalog</option>
									<option value="Search">Search</option>
									<option selected="selected" value="Catalog, Search">Catalog, Search</option>
								</select>
							</td>
						</tr>-->
						<tr>
							<td> Country of Manufacture </td>
							<td> 
								<select class="text2" id="country2" name="country2"></select>
								 <script language="javascript">
									populateCountries("country2");
								 </script>
							</td>
						</tr>
						<?php /*?><tr>
							<td> Is Featured </td>
							<td> 
								<select class="text2" name="featured">
									<option value="Yes" <?php if($edit_product_details[0]->featured == 'Yes') {echo "selected";}?> > Yes </option>
									<option value="No" <?php if($edit_product_details[0]->featured == 'No') {echo "selected";}?> > No </option>
								</select>
							</td>
						</tr><?php */?>
					</table>
				</div>
				<div id="tab3" class="tab-pane fade">
					<h3>Prices</h3>
					<table>
                    	 <tr>
                            <td style="width:20%;"> MRP <sup>*</sup> </td>
                            <td colspan="2"> 
                                <input type="text" name="mrp" id="mrp" class="text" value="<?=$edit_product_details[0]->mrp;?>">
                                <label>[INR]</label>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;"> Selling Price </td>
                            <td colspan="2"> 
                                <input type="text" name="price" id="price" class="text" value="<?php echo $edit_product_details ? $edit_product_details[0]->price : " "; ?>">
                                <label>[INR]</label>
                                <!--<input type="hidden" name="product_id" value="<?php// echo $product_id; ?>">-->
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;"> Special Price </td>
                            <td colspan="2"> 
                                <input type="text" name="special_price" id="special_price" class="text" value="<?php echo $edit_product_details ? $edit_product_details[0]->special_price : " "; ?>">
                                <label>[INR]</label>
                            </td>
                        </tr>
                        <tr>
                            <td>Special Price From Date</td>
                            <td><input name="spcil_price_from_date" class="text2 dt" id="datepicker-example7-start1" value="<?php echo $edit_product_details ? $edit_product_details[0]->special_pric_from_dt : " "; ?>"></td>
                        </tr>
                        <tr>
                            <td>Special Price To Date</td>
                            <td><input name="spcil_price_to_date" class="text2 dt" id="datepicker-example7-end1" value="<?php echo $edit_product_details ? $edit_product_details[0]->special_pric_to_dt : " "; ?>"></td>
                        </tr>
                        <tr>
                            <td> GST <sup>*</sup> : </td>
                            <td> 
                                <input type="text" name="vat_cst" id="vat_cst" value="<?=$edit_product_details[0]->tax_amount;?>" class="seller_input">&nbsp;%
                            </td>
                            <td></td>
                        </tr>
                         <tr>
							<td> Weight (in gram) <sup>*</sup> </td>
							<td> <input type="text" name="weight" onFocus="removeDefaultShipping()" readonly id="prdt_weight" class="text" value="<?php echo $edit_product_details ? $edit_product_details[0]->weight : " "; ?>"> </td>
						</tr>
                        <tr>
                            <td> Shipping Fee <sup>*</sup></td>
                            <td>
                            	<select name="shipping_typ" id="shipping_typ" class="text" style="width:200px;" onChange="showshippingAmount(this.value)">
                                	<option value="">Choose shipping type</option>
                                    <option value="Free" <?php if($edit_product_details[0]->shipping_fee == 0) {echo "selected";} ?> >Free</option>
                                    <!--<option value="Flat">Flat</option>-->
                                    <option value="Default" <?php if($edit_product_details[0]->shipping_fee > 0) {echo "selected";} ?> >Default</option>
                                </select>
                               <!-- <input type="radio" name="shippingfee" value="Free"> Free &nbsp;&nbsp;
                                <input type="radio" name="shippingfee" value="Flat"> Flat &nbsp;&nbsp;
                                <input type="radio" name="shippingfee" value="Default"> Default-->
                            </td>
                            <td>
                            <!--<div id="shipping_fee_dv">Local : <input type="text" class="text dt" name="local_shipng_fee" id="local_shipng_fee">[INR] &nbsp;&nbsp;&nbsp;&nbsp; Zonal : <input type="text" class="text dt" name="zonal_shipng_fee" id="zonal_shipng_fee">[INR]&nbsp;&nbsp;&nbsp;&nbsp; National : <input type="text" class="text dt" name="national_shipng_fee" id="national_shipng_fee">[INR]</div>
                            <div id="flat_fee">Set Amount : <input type="text" class="text dt" name="flat_shipng_fee" id="flat_shipng_fee">[INR]</div>-->
                            <!--<div id="flat_fee">Set Amount : <input type="text" onBlur="CheckValue(this.value,this.id)" class="text dt" name="flat_shipng_fee" id="flat_shipng_fee">[INR]</div>-->
                            
							<div id="default_fee">Set Amount : <input type="text" class="text dt" onKeyUp="calculateshippingCost(this.value)" name="default_shipng_fee" id="default_shipng_fee" onBlur="CheckVal(this.value)" value="<?php echo $edit_product_details ? $edit_product_details[0]->shipping_fee : " "; ?>">[INR] (per 1kg.) &nbsp;&nbsp;&nbsp;&nbsp;<span id="shpng_spn">Shipping fee : Rs.<?php echo $edit_product_details ? $edit_product_details[0]->shipping_fee_amount : " "; ?></span></div>
                            <input type="hidden" id="hidden_shipping_fee" name="hidden_shipping_fee">
							
                            </td>
                        </tr>
                        <tr>
                          <td>Qty<sup>*</sup></td>
                          <td><input type="text" class="text" name="qty" id="qty" value="<?php echo $edit_product_details ? $edit_product_details[0]->quantity : " "; ?>"></td>
                        </tr>
					</table>
				</div>
				<?php /*?><div id="tab4" class="tab-pane fade">
                	<h3>Meta Information</h3>
					<table>
                        <tr>
                            <td style="width:20%;">Meta Title</td>
                            <td><input type="text" name="meta_title" class="text" value="<?php echo $edit_product_details ? $edit_product_details[0]->meta_title : " "; ?>"></td>
                        </tr>
                        <tr>
                            <td style="width:20%;">Meta Keywords<br/><span style="font-size:11px;">(keywords should be separated by comma)</span></td>
                            <td><textarea name="meta_keyword" class="text" rows="7"><?php echo $edit_product_details ? $edit_product_details[0]->meta_keywords : " "; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>Meta Description</td>
                            <td><textarea name="meta_description" class="text" rows="7"> <?php echo $edit_product_details ? $edit_product_details[0]->meta_desc : " "; ?></textarea></td>
                        </tr>
					</table>
				</div><?php */?>
				
                <?php /*?><div id="tab5" class="tab-pane fade">
                	<h3>Images</h3>
					<table id="edit_img_tbl">
                        <tr>
                            <td style="width:20%;">Upload Image<sup>*</sup></td>
                            <td class="product_image">
                            	<!--<input type="file" id="files" name="userfile[]" multiple>-->
                                
                                <div id="uploadfile">Upload</div>
                                
                                Image Guidelines for a Vertical<br>
								<ul id="condn">
									<li> Maximum images supported :- 5 </li>
									<li> Minimum images requirded :- 1 </li>
									<li> Maximum images size :- 1MB </li>
									<li> Minimum Image Resolution :- 500 X 500 </li>
									<?php
										$img = $edit_product_details[0]->imag; //print_r($image); exit;
										$image = explode(',', $img);
										foreach($image as $img){
									?>
										<div class="prdct-thumb-img">
                                        <?php if($img != ''){?>
											<img src="<?php echo base_url();?>images/product_img/<?=$img?>" alt=""> 
											<div class="delete" onClick="delete_image('<?=$edit_product_details[0]->product_id;?>', '<?=$edit_product_details[0]->sku;?>', '<?=$img?>')"> <span style="cursor:pointer;"> <i class="fa fa-trash"></i> </span></div>
                                            <?php }?>
										</div>
									<?php } ?>
								</ul>
                                
									<!--<img class="prdct-thumb-img" src="<?php// echo base_url();?>images/1.jpg" alt=""> 
										<div class="delete"> <a href="#"> <i class="fa fa-trash"></i> </a></div>-->
									
                            </td>
                        </tr>
					</table>
				</div><?php */?>
                
                <div id="tab6" class="tab-pane fade" style="display:none;">
                	<h3>Inventory</h3>
						<table>
                          <tr>
                              <td> Maximum Qty Allowed in Shopping Cart </td>
                              <td> 
                                  <input type="text" class="text2" name="max_qty" id="max_qty" value="<?php echo $edit_product_details ? $edit_product_details[0]->max_qty_allowed_in_shopng_cart : " "; ?>">
                                  <input id="manage_stock" class="checkbox" type="checkbox" checked="checked" />
                                  <label> Use Config Settings </label>
                              </td>
                          </tr>
                          <tr>
                              <td> Enable Qty Increments </td>
                              <td> 
                                  <select class="text2" name="enable_qty_increment">
									  <option value="">--Select Qty Increment Type--</option>
                                      <option value="Yes" <?php if($edit_product_details[0]->enable_qty_increment == 'Yes') {echo "selected";}?> > Yes </option>
                                      <option value="No" <?php if($edit_product_details[0]->enable_qty_increment == 'No') {echo "selected";}?> > No </option>
                                  </select>
                              </td>
                          </tr>
                          <tr>
                              <td> Stock Availability </td>
                              <td> 
                                  <select class="text2" name="stock_avail">
									  <option value="">--Select Stock Available Type--</option>
                                      <option value="In Stock" <?php if($edit_product_details[0]->stock_availability == 'In Stock') {echo "selected";}?> > In Stock </option>
                                      <option value="Out of Stock" <?php if($edit_product_details[0]->stock_availability == 'Out of Stock') {echo "selected";}?> > Out of Stock </option>
                                  </select>
                              </td>
                          </tr>
					</table>
				</div>
                
                <div id="tab7" class="tab-pane fade">
						
				</div>
                
                <?php /*?><div id="tab8" class="tab-pane fade">
                	<h3>Related Products</h3>
                    <div class="row content-header">
					</div>
                    <div class="row">
						<div class="col-md-4 show_report">
							<button type="button" class="all_buttons">Reset</button>
							<button type="button" class="all_buttons">Search</button>
						</div>
					</div>
					<table class="table table-bordered table-hover">
						<tr class="table_th">
							<th width="5%" class="a-center"><input type="checkbox" id="check_all"></th>
							<th width="5%">ID</th>
							<th width="20%">Name</th>
							<th width="5%">Type</th>
							<th width="10%">Attrib. Set Name</th>
							<th width="8%">Status</th>
							<th width="8%">SKU</th>
							<th width="15%">Price</th>
							<!--<th width="15%">Position</th>-->
						
						</tr>
						<tr style="background-color:#e3eff1;">
							<td class="a-center">
								<select>
									<option selected="selected">Any</option>
									<option>Yes</option><option>No</option>
								</select>
							</td>
							<td><input type="text" name="page_no" class="input_text" value=""></td>
							<td><input type="text" name="page_no" value=""></td>
							<td>
								<select>
									<option value=""></option>
									<option value=""> Simple Product </option>
									<option value=""> Grouped Product </option>
									<option value=""> Configurable Product </option>
									<option value=""> Virtual Product </option>
									<option value=""> Bundle Product </option>
									<option value=""> Downloadable Product </option>
								</select>
							</td>
							<td>
								<select>
									<?php foreach($result_attr_group as $row){ ?>
										<option value="<?=$row->attribute_group_id; ?>"><?= $row->attribute_group_name; ?></option>
                                    <?php } ?>
								</select>
							</td>
							<td>
								<select>
									<option value=""></option>
									<option value="">Enabled</option>
									<option value="">Disabled</option>
								</select>
							</td>
							<td><input type="text" name="sku" class="input_text" value=""></td>
							<td>
								<div class="price">
									<span class="label">From:</span>
									<input type="text" name="price_from" value="">
								</div><br/>
								<div class="price">	
									<span class="label">To:</span>
									<input type="text" name="price_to" value="">
								</div>
							</td>
						</tr>
                        <?php
						  $only_related_product_row = $only_related_product->num_rows();
						  if($only_related_product_row > 0){
							  	foreach($only_related_product->result() as $rows1){
									 $related_products = unserialize($rows1->related_product_id);
								}
						  }else{
							      $related_products = array();
						  }
						  
						  $row = $result_product_related->num_rows();
						  if($row > 0){
							  foreach($result_product_related->result() as $rows){
						?>
                        <tr>
                            <td style="text-align:center"><input type="checkbox" name="chk_product[]" id="chk_product" value="<?=$rows->product_id ; ?>" <?php if($related_products != ''){if(in_array($rows->product_id,$related_products)){ echo 'checked';}} ?>></td>
                            <td><?=$rows->product_id; ?></td>
                            <td><?=$rows->name; ?></td>
                            <td><?=$rows->product_type; ?></td>
                            <td><?=$rows->attribute_group_name; ?></td>
                            <td><?=$rows->status; ?></td>
                            <td><?=$rows->sku; ?></td>
                            <!--<td><?//= $rows->price; ?></td>-->
                            
							<td><i class="icon-inr"></i> 
							<?php
								$amount = $rows->price;
								print number_format( $amount, 2, ".", "," );
							?>
                            </td>
                        </tr>
						  <?php 
                              }
                          }else{
                          ?>
                          <tr><td class="a-center" colspan="8">No records found ! </td></tr>
                          <?php } ?>
					</table>
				</div><?php */?>
                
            </div>
           </form>
            <div class="clearfix"></div>
            <!-- @end #right-content -->

			<!--</div>--><!-- @end #content -->
		</div><!-- @end #w -->


<style>
.dt {
    width: 150px;
}
.Zebra_DatePicker_Icon{left: 130px !important;}
</style>

<script src="<?php echo base_url(); ?>js/myscript.js" type="text/javascript"></script>

<!--- Zebra_Datepicker link start here ---->
<!--<script src="<?php// echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script>-->
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
<!--<link href="<?php// echo base_url(); ?>Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">-->
<!--- Zebra_Datepicker link end here ---->

<script>
$(document).ready(function(){
	$('#max_qty').attr('readonly',true);
	$('#max_qty').css('background-color','#e5e5e5');
	$('#manage_stock').click(function(){
		if($(this).is(':checked')){
			$('#max_qty').attr('readonly',true);
			$('#max_qty').css('background-color','#e5e5e5');
		}else{
			$('#max_qty').attr('readonly',false);
			$('#max_qty').css('background-color','#fff');
		}
	});
});
</script>

<!--<script>
	$(document).ready(function(){
		if(window.File && window.FileList && window.FileReader) {
			var _URL = window.URL || window.webkitURL;
			
			$("#files").on("change",function(e) {
				var file, img;
				var files = e.target.files ,
				filesLength = files.length ; //alert(filesLength); return false;
				if(filesLength < 1){
					$('#files').val('');
					alert("Please Upload atleast 2 Images.");
					return false;
				}else if(filesLength > 5){
					$('#files').val('');
					alert("Please Upload maximun 5 Images.");
					return false;
				}else{ 
					for (var i = 0; i < filesLength ; i++) {
						var imgpath=document.getElementById('files');
						if (!imgpath.value == ""){
							var img_name = imgpath.files[i].name;
							var img = imgpath.files[i].size;
							var imgsize = Math.floor(img/1024);
							
							if ((file = this.files[i])) {
								img = new Image();
								img.onload = function() {
									var img_width = this.width; 
									var img_height = this.height; 
									if(img_width < 500 || img_height < 500){
										$('#files').val('');
										$("img#uploadImgID").remove();
										alert("Image resolution should be Minimum 500 X 500."); 
										return false;
									}
									//alert(this.width + " " + this.height);
								};
								img.src = _URL.createObjectURL(file);
							}
							
							if(imgsize > 1024){
								$('#files').val('');
								alert("Image size should Maximum 1 MB."); 
								return false;
							}else{
								var f = files[i];
								var fileReader = new FileReader();
								fileReader.onload = (function(e) {
									var file = e.target;
									$("<img></img>",{
										class : "imageThumb",
										id : "uploadImgID",
										src : e.target.result,
										title : file.name
									}).insertAfter("#condn");
								});
								fileReader.readAsDataURL(f);
							}
						}
					}
				}
			});
		} else { alert("Your browser doesn't support to File API") }
	});	
		


/*var _URL = window.URL || window.webkitURL;

$("#file").change(function(e) {
    var file, img;

    if ((file = this.files[0])) {
        img = new Image();
        img.onload = function() {
            alert(this.width + " " + this.height);
        };
        img.onerror = function() {
            alert( "not a valid file: " + file.type);
        };
        img.src = _URL.createObjectURL(file);
    }

});*/

</script>-->

<script>
$(document).ready(function(){
	$("input:radio[name=shippingfee]").click(function(){
		$('#shipping_fee_dv').hide();
    	var val = $(this).val();
		if(val == 'flat'){
			$('#flat_fee').show();
		}else{
			$('#flat_fee').hide();
		}
	});
});
</script>


<!---Image uploading Script Start here --->
<script src="<?php echo base_url();?>js/img_uplod_script/jquery.uploadfile1.min.js"></script>

<script>
$(document).ready(function()
{
	var count_img = $("#condn").find('img').length;
	
$("#uploadfile").uploadFile({
url: "<?php echo base_url();?>admin/catalog/upload_product_tmp_image",
dragDrop: true,
fileName: "userfile",
returnType: "json",
showDelete: true,
//showDownload:true,
statusBarWidth:600,
dragdropWidth:600,
showPreview:true,
previewHeight: "100px",
previewWidth: "100px",

maxFileCount:5-count_img,
//maxFileSize:100*1024,
maxFileSize:100*500,
//minFileSize:500*500,

deleteCallback: function (data, pd) {
    for (var i = 0; i < data.length; i++) {
        $.post("<?php echo base_url();?>admin/catalog/delete_product_tmp_image", {op: "delete",name: data[i]},
            function (resp,textStatus, jqXHR) {
                //Show Message
                alert("File Deleted");
            });
    }
    pd.statusbar.hide(); //You choice.
},
downloadCallback:function(filename,pd)
	{
		location.href="<?php echo base_url();?>admin/catalog/download_product_tmp_image?filename="+filename;
	}

});  
});
</script>
<!---Image uploading Script end here --->


<script>
$(document).ready(function(){
	$('#check_all').click(function(){
		$('input:checkbox').prop('checked', this.checked);
	});
});
</script>

<!---script start for Checking for unique SKU--->
<script>
function ShowAttrHeadings(){
	var attr_group_id = $('#attribute_set').val();
	if(attr_group_id == ''){
		alert('Please select the attribute set.');
		return false;
	}else{
		$('#go_btn').attr('disabled', true);
		$('#go_btn').css('cursor','no-drop');
		$('#go_btn').val('wait..');
		$.ajax({
			url:'<?php echo base_url(); ?>admin/attribute/show_attr_headings',
			method:'post',
			data:{group_id:attr_group_id},
			success:function(result){
				$('#attr_flds_td').fadeIn();
				$('#attr_flds_td').html(result);
				$('#go_btn').attr('disabled', false);
				$('#go_btn').css('cursor','pointer');
				$('#go_btn').val('Go');
			}
		});
	}
}

function checkSku(val){
	var sku_len = val.length;
	var sku_non_spc_len = val.replace(/\s/g, '').length;
	if(sku_len != sku_non_spc_len){
		$(".valid_msg_dv").show();
		$(".valid_msg_dv").html('sku must not contain space.');
		$('#prdt_sku').css('border-color','red');		
		$('#prdt_sku').val('');
		$('#prdt_sku').focus();
		return false;
	}else{
		$.ajax({
			  url:'<?php echo base_url(); ?>admin/catalog/checksku',
			  method:'post',
			  data:{sku:val},
			  success:function(result)
			  {
				if(result == 'exists'){
					$(".valid_msg_dv").show();
					$(".valid_msg_dv").html('This SKU is already exists.');
					$('#prdt_sku').css('border-color','red');
					$('#prdt_sku').select();
					$('#prdt_sku').val('');
					return false;
				}else{
					$(".valid_msg_dv").hide();
					$('#prdt_sku').css('border-color','#ccc');
					return true;
				}
			 }
		 });
	}
}
</script>
<!---script End for Checking for unique SKU--->

<script>
$(document).ready(function(){
	$( ".attr_tab_ul li:first-child" ).addClass( "active" );
	$(".attr_fld_dv div:first-child").addClass( "active" );
	
	$('#default_fee').show();
	var shipping_typ = $('#shipping_typ').val(); 
	if(shipping_typ == 'Free'){
		$('#default_fee').hide();
	}
});

</script>

<script>
function showshippingAmount(shipping_typ){ 
	if(shipping_typ == 'Free'){
		$('#default_fee').hide();
		/*$('#flat_fee').hide();*/
	}else if(shipping_typ == 'Default'){
		$('#flat_fee').hide();
		$('#default_fee').show();
	}
}
	
function calculateshippingCost(amount){
	var product_weight_in_gm = $('#prdt_weight').val();
	var product_weight_in_kg = product_weight_in_gm/1000;
	var product_rounded_weight = Math.ceil(product_weight_in_kg);
	
	//allowed maximum shipping fee amount//
	var max_shipping_fee = product_rounded_weight*60;
	
	var input_shipping_fee = $('#default_shipng_fee').val();

	//var product_shipping_fee = Math.ceil(product_weight_in_kg*amount);
		
	if(input_shipping_fee > max_shipping_fee){
		alert('Your Maximum shipping amount Allowed  : Rs. '+ max_shipping_fee);
		$('#default_shipng_fee').val('');
		return false;
	}else{
		var shipping_amt = input_shipping_fee;
	}
	
	$('#shpng_spn').text('Shipping fee : Rs.'+ shipping_amt);
	$('#hidden_shipping_fee').val(shipping_amt);
}


function CheckVal(val){
	var input_shipping_fee_ten = (val/10);
	if(Number.isInteger(input_shipping_fee_ten) === false){
		alert('Shipping fee amount should be multiple with 10');
		$('#default_shipng_fee').val('');
		return false;
	}
}

	
function removeDefaultShipping(){
	$('#default_shipng_fee').val('');
	$('#shpng_spn').text('Shipping fee : Rs.'+ 0);
	$('#hidden_shipping_fee').val(0);
}

function reset_images(){
	$("img#uploadImgID").remove();
}
</script>

	</body>
</html>