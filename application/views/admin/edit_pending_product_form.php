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
function delete_image(product_id, sku, image_name,sl){
	$('#del_orgnl'+sl).css('display','none');
	$('#delt_disble'+sl).css('display','block');
	$('#wt_spn'+sl).html('wait..');
	$.ajax({
		url:'<?php echo base_url(); ?>admin/catalog/edit_pending_productimg',
		method:'post',
		data:{product_id:product_id,image_name:image_name,sku:sku},
		success:function(data){
			//$('.valid_msg_dv').show();
			//$('.valid_msg_dv').html(data);
			if(data == 'success'){
				window.location.reload(true);
			}
		}
	});
}
</script>

<script>
function loadMetaInfo(seller_product_id){
	$.ajax({
		url:'<?php echo base_url(); ?>admin/catalog/load_pending_product_meta_info',
		method:'post',
		data:{slr_prod_id:seller_product_id},
		success:function(data){
			$('.load_meta_info').html(data);
		}
	});
}


function loadPriceInfo(seller_product_id){
	//$('.load_price_info').html('wait..');
	$.ajax({
		url:'<?php echo base_url(); ?>admin/catalog/load_pending_product_prc_n_invtry_info',
		method:'post',
		data:{slr_prod_id:seller_product_id},
		success:function(data){
			$('.load_price_info').html(data);
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
                
                <?php echo form_open_multipart('admin/catalog/update_pending_product_data');?>
					<div class="row content-header">
                    	<div class="col-md-2">&nbsp;</div>
						<div class="col-md-10">
                        	&nbsp;
						<!--<div class="col-md-4 show_report">-->
							<input type="button" class="all_buttons" value="Cancel" onClick="window.location.href='<?php echo base_url() ?>admin/catalog'">
							<!--<button type="button" onClick="window.location.href='<?php// echo base_url().'admin/catalog' ?>'" class="all_buttons">Back</button>-->
                            <button type="submit" class="all_buttons" onClick="return ValidProduct_edit_form()">Save</button>
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
				<li id="li_tab1" class="active"><a data-toggle="tab" href="#tab1">Create Product Settings</a></li>
				<li id="li_tab2"><a data-toggle="tab" href="#tab2">General</a></li>
				<li id="li_tab3" onClick="loadPriceInfo('<?=$edit_product_details[0]->seller_product_id?>');"><a data-toggle="tab" href="#tab3">Prices</a></li>
				<li id="li_tab4" onClick="loadMetaInfo('<?=$edit_product_details[0]->seller_product_id?>');"><a data-toggle="tab" href="#tab4">Meta Information</a></li>
               	<li id="li_tab5"><a data-toggle="tab" href="#tab5">Images</a></li>
               <!-- <li id="li_tab6"><a data-toggle="tab" href="#tab6">Inventory</a></li>
                <li id="li_tab7"><a data-toggle="tab" href="#tab7">Categories</a></li>-->
                <!--<li id="li_tab8"><a data-toggle="tab" href="#tab8">Related Products</a></li>-->
			</ul>
<?php
//var_dump($edit_product_details);exit;
//var_dump($tax_class_result);exit;
?>
			<!--<div class="tab-content form_view">-->
			<div class="tab-content form_view">
				<div id="tab1" class="tab-pane fade in active">
					<h3>Create Product Settings</h3>
					<table>
                    	<tr>
                            <td width="30%"><strong>Category Name: </strong></td>
                            <td>
                            	<strong><?=$edit_product_details[0]->category_name;?></strong>
                            </td>
                  		</tr>   
						<tr>
							<td><strong>Attribute Set Name : </strong></td>
							<td><strong>
								<!--<select name="attribute_set" class="text2" onChange="ShowAttrHeadings(this.value, '<?//=$edit_product_details[0]->sku?>')">-->
									<!--<option value="">--Select--</option>-->
									<?php /*?><?php foreach($result as $row){ ?>
										<option value="<?=$row->attribute_group_id;?>" <?php if($edit_product_details[0]->attribute_group_name==$row->attribute_group_name){echo "selected";}?> ><?= $row->attribute_group_name; ?></option>
									<?php } ?><?php */?>
								<!--</select>-->
                                
                                <?php
								//print_r($edit_product_details);exit;
								$atr_set = $edit_product_details[0]->attribute_set;
								//echo $atr_set;exit;
								$attr_sql = $this->db->query("SELECT attribute_group_id,attribute_group_name FROM attribute_group WHERE attribute_group_id='$atr_set' ");
								$attr_res = $attr_sql->result();
								$attribute_group_name = $attr_res[0]->attribute_group_name;
								$attribute_group_id = $attr_res[0]->attribute_group_id;
								
								foreach($result as $row){ ?>
                                       <?php 
									   //if($edit_product_details[0]->attribute_group_name == $row->attribute_group_name){ 
									   if($attribute_group_name == $row->attribute_group_name){ 
									   ?>
                                        <?php echo $row->attribute_group_name ;?>
										<?php } ?>
								<?php } ?>
							</strong>
                            </td>
						</tr>
						
						<tr>
							<!--<td colspan="2" id="attr_flds_td">-->
							<td colspan="2">
							<?php
								//$attr_group_id = $edit_product_details[0]->attribute_group_id;
								$attr_group_id = $attribute_group_id;
								$query = $this->db->query("SELECT * FROM attributes WHERE attribute_group_id='$attr_group_id'");
								$attr_heading_rows = $query->num_rows();
								$attr_heading_rows_length = count($attr_heading_rows);
								if($attr_heading_rows > 0){ 
							?>
								<ul class="nav nav-pills nav-stacked col-md-2 attr_tab_ul">
							<?php
							$sl=0;
							foreach($query->result() as $attr_heading_row){
								$sl++;
							?>
									<li><a href="#tab_a<?=$sl; ?>" data-toggle="pill"><?=$attr_heading_row->attribute_heading_name;?></a></li>
							<?php } ?>
								</ul>
								
                                <div class="tab-content col-md-6 attr_fld_dv">
									<?php
                                    $sl=0;
                                    //foreach($attr_heading_result->result() as $attr_heading_row){
									foreach($query->result() as $attr_heading_row){
                                    $sl++;
                                    ?>
                                    
                                        <div class="tab-pane" id="tab_a<?=$sl; ?>">
                                            <table>
                                            <?php
                                            $query = $this->db->query("SELECT * FROM attribute_real WHERE attribute_heading_id=$attr_heading_row->attribute_heading_id");
                                            $field_result = $query->result();
                                            foreach($field_result as $attr_fld_row){
                                            ?>
                                                <tr>
                                                    <td width="30%">
													<?=$attr_fld_row->attribute_field_name; ?>
                                                    <input type="hidden" name="attr_fld_nm[]" value="<?=$attr_fld_row->attribute_field_name;?>">
                                                    </td>
                                                    <td>
                                                    <?php if($attr_fld_row->attribute_field_name == 'Color'){ ?>
                                                        
                                                        <input type="hidden" name="hidden_attr_id[]" value="<?=$attr_fld_row->attribute_id;?>">
                                                        <?php
														$product_id = $edit_product_details[0]->seller_product_id;
														$product_sku = $edit_product_details[0]->sku;
														//checking this sku is exit in product_attribute_value table or seller_product_attribute_value table
														$sku_sql = $this->db->query("SELECT * FROM product_attribute_value WHERE sku='$product_sku'");
														//condition start for exit in product_attribute_value table
														if($sku_sql->num_rows() > 0){
															$attr_sql = $this->db->query("SELECT * FROM product_attribute_value WHERE sku='$product_sku' AND attr_id='$attr_fld_row->attribute_id'");
															if($attr_sql->num_rows() > 0){
															$attr_res = $attr_sql->result();
														?>
                                                        	<!--<input type="text" class="text" name="attr_value[]" value="<?//=$attr_res[0]->attr_value;?>">-->
                                                            
                                                            <select name="attr_value[]">
                                                                <option value="">Choose color</option>
                                                                <?php foreach($color_result as $color_row){ ?>
                                                                
                                                                <option style="background-color:<?=$color_row->clr_cod;?>;" value="<?=$color_row->clr_name;?>" <?php if($attr_res[0]->attr_value == $color_row->clr_name){ echo 'selected';} ?>><?=$color_row->clr_name;?></option>
                                                                <?php } // End of foreach loop ?>
                                                                
                                                            </select>
                                                            
                                                            
                                                            
                                                        	<?php }else{?>
                                                        	<!--<input type="text" class="text" name="attr_value[]" value="">-->
                                                            
                                                            
                                                            <select name="attr_value[]">
                                                                <option value="">Choose color</option>
                                                                <?php foreach($color_result as $color_row){ ?>
                                                                
                                                                <option style="background-color:<?=$color_row->clr_cod;?>;" value="<?=$color_row->clr_name;?>"><?=$color_row->clr_name;?></option>
                                                                <?php } // End of foreach loop ?>
                                                                
                                                            </select>
                                                            
                                                            
                                                        	<?php }
                                                        //condition end of exit in product_attribute_value table
														?>
                                                        <?php }else{ //condition start for exit in seller_product_attribute_value table
														$sku_sql1 = $this->db->query("SELECT * FROM seller_product_attribute_value WHERE sku='$product_sku'");
														if($sku_sql1->num_rows() > 0){
															$attr_sql1 = $this->db->query("SELECT * FROM seller_product_attribute_value WHERE sku='$product_sku' AND attr_id='$attr_fld_row->attribute_id'");
															if($attr_sql1->num_rows() > 0){
															$attr_res1 = $attr_sql1->result();
														?>
                                                        	<!--<input type="text" class="text" name="slr_attr_value[]" value="<?//=$attr_res1[0]->attr_value;?>">-->
                                                            
                                                            <select name="slr_attr_value[]">
                                                                <option value="">Choose color</option>
                                                                <?php foreach($color_result as $color_row){ ?>
                                                                
                                                                <option style="background-color:<?=$color_row->clr_cod;?>;" value="<?=$color_row->clr_name;?>" <?php if($attr_res1[0]->attr_value == $color_row->clr_name){ echo 'selected';} ?>><?=$color_row->clr_name;?></option>
                                                                <?php } // End of foreach loop ?>
                                                                
                                                            </select>
                                                            
                                                            
                                                        	<?php }else{?>
                                                        	<!--<input type="text" class="text" name="slr_attr_value[]" value="">-->
                                                            
                                                            <select name="slr_attr_value[]">
                                                                <option value="">Choose color</option>
                                                                <?php foreach($color_result as $color_row){ ?>
                                                                
                                                                <option style="background-color:<?=$color_row->clr_cod;?>;" value="<?=$color_row->clr_name;?>"><?=$color_row->clr_name;?></option>
                                                                <?php } // End of foreach loop ?>
                                                                
                                                            </select>
                                                            
                                                            
                                                        	<?php }
                                                        //condition end of exit in seller_product_attribute_value table
														} }
														?>
                                                        
                                                      <!--End of if attribute name is color-->  
                                                        
                                                    <?php }else{ ?>
                                                        <input type="hidden" name="hidden_attr_id[]" value="<?=$attr_fld_row->attribute_id;?>">
                                                        <?php
														$product_id = $edit_product_details[0]->seller_product_id;
														$product_sku = $edit_product_details[0]->sku;
														//checking this sku is exit in product_attribute_value table or seller_product_attribute_value table 
														$sku_sql = $this->db->query("SELECT * FROM product_attribute_value WHERE sku='$product_sku'");
														//condition start for exit in product_attribute_value table
														if($sku_sql->num_rows() > 0){
															$attr_sql = $this->db->query("SELECT * FROM product_attribute_value WHERE sku='$product_sku' AND attr_id='$attr_fld_row->attribute_id'");
															if($attr_sql->num_rows() > 0){
															$attr_res = $attr_sql->result();
														?>
                                                        	<input type="text" class="text" name="attr_value[]" value="<?=$attr_res[0]->attr_value;?>">
                                                        	<?php }else{?>
                                                        	<input type="text" class="text" name="attr_value[]" value="">
                                                        	<?php }
                                                        //condition end of exit in product_attribute_value table
														?>
                                                        <?php }else{ //condition start for exit in seller_product_attribute_value table
														$sku_sql1 = $this->db->query("SELECT * FROM seller_product_attribute_value WHERE sku='$product_sku'");
														if($sku_sql1->num_rows() > 0){
															$attr_sql1 = $this->db->query("SELECT * FROM seller_product_attribute_value WHERE sku='$product_sku' AND attr_id='$attr_fld_row->attribute_id'");
															if($attr_sql1->num_rows() > 0){
															$attr_res1 = $attr_sql1->result();
														?>
                                                        	<input type="text" class="text" name="slr_attr_value[]" value="<?=$attr_res1[0]->attr_value;?>">
                                                        	<?php }else{?>
                                                        	<input type="text" class="text" name="slr_attr_value[]" value="">
                                                        	<?php }
                                                        //condition end of exit in seller_product_attribute_value table
														} }
														?>
                                                        <?php } // End of attribute not color condition ?>
                                                    </td>
                                                </tr>
                                            <?php } //End of attribute field foreach loop?>
                                            </table>
                                        </div>
                                            
                                    <?php } ?>    
                                </div>
							<!-- tab content -->
                            

							<?php } //end of if condition ?>
                            
							<!--</div>-->
								
							</td>
						</tr>
						<!--<tr>
							<td> Product Type </td>
							<td> 
								<select name="product_type" id="product_type" class="text2"/>
									<option value="">---select---</option>
									<option value="Simple Product" <?php//if($edit_product_details[0]->product_type == 'Simple Product') {echo "selected";}?> >Simple Product</option>
									<option value="Grouped Product" <?php//if($edit_product_details[0]->product_type == 'Grouped Product') {echo "selected";}?> >Grouped Product</option>
								</select>
							</td>
						</tr>-->
					</table>
                    
  <!--<h3>Categories</h3>
 <table style="margin-left:10px;">
                        	<tr>
                            	<td>Category : <?//=$edit_product_details[0]->category_name;?></td>
                  			</tr>        
					</table>-->
                    
                    
				</div>
                
				<div id="tab2" class="tab-pane fade">
					<h3>General</h3>
					<table>
						<tr>
							<td style="width:20%;"> Name <sup>*</sup> </td>
							<td>
								<input type="hidden" name="hidden_product_sellerid" value="<?=$edit_product_details[0]->seller_id;?>">
								<input type="hidden" name="hidden_product_id" value="<?=$edit_product_details[0]->seller_product_id;?>">
								<input type="hidden" name="hidden_product_sku" value="<?=$edit_product_details[0]->sku?>">
								<input type="hidden" name="hidden_product_image" value="<?=$edit_product_details[0]->image?>">
								<input type="text" name="name" id="prdt_name" class="text" value="<?php echo $edit_product_details ? $edit_product_details[0]->name : " "; ?>">
								<!--<input type="hidden" name="product_id" value="<?php// echo $product_id; ?>">-->
							</td>
						</tr>
						<tr>
							<td> Description <sup>*</sup> </td>
							<td> 
								<textarea rows="7" class="text" name="prdt_desc" id="prdt_desc"><?php echo $edit_product_details ? $edit_product_details[0]->description : " "; ?></textarea>
								<!--<button type="button" class="all_buttons">WYSIWYG Editor</button>--> 
							</td>
						</tr>
						<tr>
							<td> product highlights <sup>*</sup> </td>
							<td> 
								<?php $data = unserialize($edit_product_details[0]->short_desc); ?>
							
								<!--<textarea rows="7" name="prdt_short_desc" id="prdt_short_desc" class="text"><//?php echo $edit_product_details ? $edit_product_details[0]->short_desc : " "; ?></textarea>-->
								<!--<button type="button" class="all_buttons">WYSIWYG Editor</button>--> 
								<input type="text" name="prdt_short_desc[]" id="prdt_short_desc" class="text" maxlength="30" value="<?=$data['0'];?>"><br/><br/>
                                <input type="text" name="prdt_short_desc[]" class="text" maxlength="30" value="<?=$data['1'];?>"><br/><br/>
                                <input type="text" name="prdt_short_desc[]" class="text" maxlength="30" value="<?=$data['2'];?>"><br/><br/>
                                <input type="text" name="prdt_short_desc[]" class="text" maxlength="30" value="<?=$data['3'];?>"><br/><br/>
                                <input type="text" name="prdt_short_desc[]" class="text" maxlength="30" value="<?=$data['4'];?>">
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
							<td><input name="from_date" class="text2 dt" id="datepicker-example7-start" value="<?php echo $edit_product_details ? $edit_product_details[0]->product_fr_dt : " "; ?>"></td>
						</tr>
						<tr>
							<td>Set Product as New to Date</td>
							<td><input name="to_date" class="text2 dt" id="datepicker-example7-end" value="<?php echo $edit_product_details ? $edit_product_details[0]->product_to_dt : " "; ?>"></td>
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
						<tr>
							<td> Is Featured </td>
							<td> 
								<select class="text2" name="featured">
									<option value="Yes" <?php if($edit_product_details[0]->featured == 'Yes') {echo "selected";}?> > Yes </option>
									<option value="No" <?php if($edit_product_details[0]->featured == 'No') {echo "selected";}?> > No </option>
								</select>
							</td>
						</tr>
					</table>
				</div>
                
				<div id="tab3" class="tab-pane fade load_price_info"></div> <!--- Price & inventory information load in ajax --->
                
				<div id="tab4" class="tab-pane fade load_meta_info"></div>  <!--- Meta information load in ajax --->
                					
                <div id="tab5" class="tab-pane fade">
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
										$img = $edit_product_details[0]->image; //print_r($image); exit;
										$image = explode(',', $img);
										$sl=0;
										foreach($image as $img){ $sl++;
									?>
										<div class="prdct-thumb-img">
                                        <?php if($img != ''){?>
											<img src="<?php echo base_url();?>images/product_img/<?=$img?>" alt=""> 
											<div class="delete" id="del_orgnl<?=$sl;?>" onClick="delete_image('<?=$edit_product_details[0]->seller_product_id;?>', '<?=$edit_product_details[0]->sku;?>', '<?=$img?>','<?=$sl?>')"> <span style="cursor:pointer;"> <i class="fa fa-trash"></i> </span></div>
                                            
                                            <span id="wt_spn<?=$sl;?>"></span>
                                            <div class="delete dlt_dsble" id="delt_disble<?=$sl;?>"><span> <i class="fa fa-trash"></i> </span></div>
                                            
                                            <?php }?>
										</div>
									<?php } ?>
								</ul>
                                
									<!--<img class="prdct-thumb-img" src="<?php// echo base_url();?>images/1.jpg" alt=""> 
										<div class="delete"> <a href="#"> <i class="fa fa-trash"></i> </a></div>-->
									
                            </td>
                        </tr>
					</table>
				</div>
                
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
                
                <div id="tab8" class="tab-pane fade">
                	<!--related product in designing copy from edit_product_form page and paste in edit_pending_product_form page-
				if required in feature-->
				</div>
                
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
.dlt_dsble{display:none;}
.dlt_dsble i{color:#ccc !important;}
.prdct-thumb-img > span {
    left: 142px;
    position: absolute;
    top: -9px;
}
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