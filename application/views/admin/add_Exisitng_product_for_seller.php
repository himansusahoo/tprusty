<?php
require_once('header.php');
?> 
<script type="text/javascript" src ="<?php echo base_url();?>js/countries.js"></script>

<!--- Zebra_Datepicker link start here ---->
<link href="<?php echo base_url();?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
<link href="<?php echo base_url();?>Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">
<!--<script src="<?php echo base_url();?>Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script>-->
<script src="<?php echo base_url();?>Zebra_Datepicker-master/examples/public/javascript/core.js"></script>
<script src="<?php echo base_url();?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<!--- Zebra_Datepicker link end here ---->

<style>
	.Zebra_DatePicker_Icon{left: 250px !important; top: 7px !important;}
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
				</div>
		
	<script>
	 function prod_coloredited()
	 {
			$('#image_addforcolorgange').css('display','block');	 
	 }
	
   </script>	
		
		<div class="main-content">
			
<?php
$this->load->helper('string');
if($exist_product_info) :   //var_dump($exist_product_info); exit;
	foreach($exist_product_info as $row) : 
	$arr_img = explode(',',$row->imag);
	$first_img = $arr_img[0]; 
?>
<?php

	date_default_timezone_set('Asia/Calcutta');
	if($this->session->userdata('seller_session_id')==""){
		$dtm = str_replace(" ","-",date('Y-m-d H:i:s'));
		$session_slr_id = random_string('alnum', 16).$dtm;
		$this->session->set_userdata('seller_session_id',$session_slr_id);
	}	
	echo form_open_multipart('admin/sellers/save_Exist_new_product');
?>	
			<div class="row">
				<div class="valid_msg_dv"></div>
				<div class="col-md-4 search_product_image"> 
					<img src="<?php echo base_url(); ?>images/product_img/<?php echo $first_img; ?>">
					<div class="product-details">
						<h4 class="product-title"> <?=$row->name?> </h4>
						<table width="100%" border="0" cellspacing="5">
							<tr>  
								<td>category :</td>
								<td><?=$row->category_name?></td>
							</tr>
							<tr>  
								<td>Product Type :</td>
								<td><?=$row->product_type?></td>
							</tr>
							<tr>
								<td>Description :</td>
								<td><?=$row->description?></td>
							</tr>
                            
                    <!--------------------Product color,size,capacity,RAM, ROM attaribute setting start  -------------------------->        
                           
                            <?php 
							$extpordsku=$exist_product_info[0]->sku;
							if($exist_product_attrbinfo!='') {
							 foreach($exist_product_attrbinfo as $res_product_attrbinfo){ 
							   if($res_product_attrbinfo->attribute_field_name=='Color') {
								   $query_colorattrb=$this->db->query("SELECT * FROM product_attribute_value WHERE attr_id= '$res_product_attrbinfo->attribute_id' AND sku='$extpordsku' ");	
															
								if($query_colorattrb->num_rows()==0)
								{
									$query_colorattrb=$this->db->query("SELECT attr_value FROM seller_product_attribute_value WHERE attr_id= '$res_product_attrbinfo->attribute_id' AND sku='$extpordsku' ");
								}
									
								if($query_colorattrb->num_rows()!=0)
								{ 
											
									$row_colorattrb=$query_colorattrb->row();
								    $colo_val=$row_colorattrb->attr_value;
									
								}
								else
								{$colo_val='';}
								
								if($colo_val!=''){													 	
							 ?>
                            <tr>
								<td>Color :</td>
								<td>                              
                                
                    
                    <select name="attr_color" id="attr_color"  onchange="prod_coloredited()" class='seller_input' >
                                                                <option value="">Choose color</option>
                                                                <?php foreach($color_result as $color_row){ 
															
																?>
                                                                
                                                                <option style="background-color:<?=$color_row->clr_cod;?>;" value="<?=$color_row->clr_name;?>" <?php if($colo_val == $color_row->clr_name){ echo 'selected';} ?>><?=$color_row->clr_name;?></option>
                                                                <?php } // End of foreach loop ?>
                                                                
                                                            </select>
                                </td>
							</tr>
                           <?php 
								} // if color value not blank condition end
						   } // Color condition check end ?>
							
                          <tr>                            
                            <td colspan='2' >
                            <div id="image_addforcolorgange" style="display:none;">
                            <span>Upload Image </span>                            	
                                <div id="uploadfile">Upload</div>
								
								Image Guidelines for a Vertical<br>
								<ul id="condn">
									<li> Maximum images supported :- 5 </li>
									<li> Minimum images requirded :- 1 </li>
									<li> First Image is Default Image.  </li>
									<li> Maximum images size :- 1MB </li>
									<li> Minimum Image Resolution :- 500 X 500 </li>
								</ul>
                              </div>  
                            </td>
                        </tr>    
                         <!---------------------------checking of size start---------------------->
                        <?php  
                         if($res_product_attrbinfo->attribute_field_name=='Size') {
								   $query_sizeattrb=$this->db->query("SELECT * FROM product_attribute_value WHERE attr_id= '$res_product_attrbinfo->attribute_id' AND sku='$extpordsku' ");	
															
								if($query_sizeattrb->num_rows()==0)
								{
									$query_sizeattrb=$this->db->query("SELECT attr_value FROM seller_product_attribute_value WHERE attr_id= '$res_product_attrbinfo->attribute_id' AND sku='$extpordsku' ");
								}
									
								if($query_sizeattrb->num_rows()!=0)
								{ 
											
									$row_sizeattrb=$query_sizeattrb->row();
								    $size_val=$row_sizeattrb->attr_value;
									
								}
								else
								{$size_val='';}
								if($size_val!='')
								{													 	
							 ?>
                            <tr>
								<td>Size :</td>
								<td>                                
                               
                   <select name="sizeattr_value" id="sizeattr_value" class='seller_input'>
                    	<option value="">Select size</option>
                        <?php foreach($size_result as $size_row){ ?>
                        <option value="<?=$size_row->size_name;?>" <?php if($size_val==$size_row->size_name){echo 'selected';}?>><?=$size_row->size_name;?></option>
                        <?php } // End of foreach loop ?>
                    </select>
                                </td>
							</tr>
                           <?php 
								} // if size value not blank
						   
						   } // size condition check end ?>
                         <!---------------------------checking Of size end------------------------->
                         
                         
                         
                         
                          <!---------------------------checking of subsize start---------------------->
                        <?php  
                         if($res_product_attrbinfo->attribute_field_name=='Size Type') {
								   $query_subsizeattrb=$this->db->query("SELECT * FROM product_attribute_value WHERE attr_id= '$res_product_attrbinfo->attribute_id' AND sku='$extpordsku' ");	
															
								if($query_subsizeattrb->num_rows()==0)
								{
									$query_subsizeattrb=$this->db->query("SELECT attr_value FROM seller_product_attribute_value WHERE attr_id= '$res_product_attrbinfo->attribute_id' AND sku='$extpordsku' ");
								}
									
								if($query_subsizeattrb->num_rows()!=0)
								{ 
											
									$row_subsizeattrb=$query_subsizeattrb->row();
								    $subsize_val=$row_subsizeattrb->attr_value;
									
								}
								else
								{$subsize_val='';}
								if($subsize_val!=''){													 	
							 ?>
                            <tr>
								<td>Size Type :</td>
								<td>                                
                               
                   <select name="attr_subsize" id="attr_subsize" class='seller_input'>
                    	<option value="">Select</option>
                        <?php foreach($sub_size_result as $sub_size_row){ ?>
                        <option value="<?=$sub_size_row->size_name;?>" <?php if($sub_size_row->size_name==$subsize_val){echo "selected";} ?>><?=$sub_size_row->size_name;?></option>
                        <?php } // End of foreach loop ?>
                    </select>
                                </td>
							</tr>
                           <?php
						   
								} // if subsize not blank condition end
						    } // size condition check end ?>
                         <!---------------------------checking Of subsize end------------------------->
                         
                         <!---------------------------checking of capacity start---------------------->
                        <?php  
                         if($res_product_attrbinfo->attribute_field_name == 'Capacity') {
								   $query_capcityattrb=$this->db->query("SELECT * FROM product_attribute_value WHERE attr_id= '$res_product_attrbinfo->attribute_id' AND sku='$extpordsku' ");	
															
								if($query_capcityattrb->num_rows()==0)
								{
									$query_capcityattrb=$this->db->query("SELECT attr_value,attr_id FROM seller_product_attribute_value WHERE attr_id= '$res_product_attrbinfo->attribute_id' AND sku='$extpordsku' ");
								}
									
								if($query_capcityattrb->num_rows()!=0)
								{ 
											
									$row_capacityattrb=$query_capcityattrb->row();
								    $capacity_val=$row_capacityattrb->attr_value;
									
								}
								else
								{$capacity_val='';}
								if($capacity_val!='')
								{													 	
							 ?>
                            <tr>
								<td>Capacity :</td>
								<td>
                                <input type="hidden" name="hidden_attrcapacity_id" id="hidden_attrcapacity_id" value="<?=$res_product_attrbinfo->attribute_id;?>">                                
                               <input type="text" name="cpacity" id="cpacity" class="seller_input" value='<?php if($capacity_val!=''){echo $capacity_val;} ?>'>
                  				
                                </td>
							</tr>
                           <?php 
								} // if capacity value not balnk conditon end 
						   
						   } // size condition check end ?>
                         <!---------------------------checking Of capacity end------------------------->
                         
                          <!---------------------------checking of RAM start---------------------->
                        <?php  
                         if($res_product_attrbinfo->attribute_field_name == 'RAM') {
								   $query_ramattrb=$this->db->query("SELECT * FROM product_attribute_value WHERE attr_id= '$res_product_attrbinfo->attribute_id' AND sku='$extpordsku' ");	
															
								if($query_ramattrb->num_rows()==0)
								{
									$query_ramattrb=$this->db->query("SELECT attr_value FROM seller_product_attribute_value WHERE attr_id= '$res_product_attrbinfo->attribute_id' AND sku='$extpordsku' ");
								}
									
								if($query_ramattrb->num_rows()!=0)
								{ 
											
									$row_ramattrb=$query_ramattrb->row();
								    $ram_val=$row_ramattrb->attr_value;
									
								}
								else
								{$ram_val='';}
								if($ram_val!='')
								{													 	
							 ?>
                            <tr>
								<td>RAM :</td>
								<td>
                                <input type="hidden" name="hidden_attrram_id" id="hidden_attrram_id" value="<?=$res_product_attrbinfo->attribute_id;?>">                                
                               <input type="text" name="ram_memory" id="ram_memory" class="seller_input" value='<?php if($ram_val!=''){echo $ram_val;} ?>'>
                  				
                                </td>
							</tr>
                           <?php 
								} // if Ram vlaue not blank condition end
						   } // size condition check end ?>
                         <!---------------------------checking Of RAM end------------------------->
                         
                         
                         
                          <!---------------------------checking of ROM start---------------------->
                        <?php  
                         if($res_product_attrbinfo->attribute_field_name == 'ROM') {
								   $query_romattrb=$this->db->query("SELECT * FROM product_attribute_value WHERE attr_id= '$res_product_attrbinfo->attribute_id' AND sku='$extpordsku' ");	
															
								if($query_romattrb->num_rows()==0)
								{
									$query_romattrb=$this->db->query("SELECT attr_value FROM seller_product_attribute_value WHERE attr_id= '$res_product_attrbinfo->attribute_id' AND sku='$extpordsku' ");
								}
									
								if($query_romattrb->num_rows()!=0)
								{ 
											
									$row_romattrb=$query_romattrb->row();
								    $rom_val=$row_romattrb->attr_value;
									
								}
								else
								{$rom_val='';}
								if($rom_val!='')
								{													 	
							 ?>
                            <tr>
								<td>ROM :</td>
								<td>
                                <input type="hidden" name="hidden_attrrom_id" id="hidden_attrrom_id" value="<?=$res_product_attrbinfo->attribute_id;?>">                                
                               <input type="text" name="rom_memory" id="rom_memory" class="seller_input" value='<?php if($rom_val!=''){echo $rom_val;} ?>'>
                  				
                                </td>
							</tr>
                           <?php 
								} // if rom value not blank conditon end 
						   
						   } // size condition check end ?>
                         <!---------------------------checking Of ROM end------------------------->
                         
							<?php   } // for loop end 
						   
							} //if condtion end
						   ?> 
                    <!--------------------Product color,size,capacity,RAM, ROM attaribute setting end  -------------------------->
                    
                       
                            
						</table>
					</div> 
				</div>
				<div class="col-md-8">

					<table width="100%" border="0" cellspacing="5">
						<h4> Product Information </h4>
                        <tr>
							<td>Product Type <sup>*</sup> :<br>
								<select name="prod_type" id="prod_type" class="seller_input" >
									<option value=''>--Select--</option>
									<option value="Simple Product">Simple Product</option>
									<option value="Grouped Product">Grouped Product</option>
								</select>
								<div class="req_visibility">This is a required field.</div>
							</td>
						</tr>
						<tr>
							<td> 
								Seller Sku<sup>*</sup> <div class="wrapper"><i class="fa fa-question-circle"></i><div class="tooltip"> Only A-Za-z0-9_-   characters are allowed.</div></div> : <br>
								<input type="text" name="sku" class="seller_input">
								<input type="hidden" name="hidden_seller_id" value="<?=$seller_id?>">
								<div id="success_sku"></div>
							</td>
							<td>
								Quantity<sup>*</sup> : <br>
								<input type="text" name="qty" class="seller_input">
							</td>
						</tr>
						<tr>
							<td>
								Product From date : <br>
								<input type="text" name="product_fr_date" class="seller_input" id="datepicker-example7-start">
							</td>
							<td>
								Product To date : <br>
								<input type="text"  class="seller_input" name="product_to_date" id="datepicker-example7-end">
							</td>
						</tr>
						<tr>
							<td>
								Status<sup>*</sup> : <br>
								<select class="seller_input" name="status">
									<option selected="selected" value="">-- Please Select --</option>
									<option value="Enabled">Enabled</option>
									<option value="Disabled">Disabled</option>
								</select>
							</td>
							<td>
								Country of Manufacture : <br>
								<select class="seller_input" id="country2" name="country2"></select>
								<script language="javascript">
									populateCountries("country2");
								</script>
							</td>
						</tr>
						<tr>
							<td>
								MRP<sup>*</sup> : <br>
								<!--<input type="hidden" name="hidden_mrp" id="hidden_mrp" value="">-->
								<input type="text" name="price" class="seller_input" onBlur="showPriceNotice(this.value, <?=$row->mrp?>)">
								<label>[INR]</label>
							</td>
							<td>
								Selling Price : <br>
								<input type="text" name="selling_price" class="seller_input">
								<label>[INR]</label>
							</td>
						</tr>
						<tr>
							<td>
								Special Price : <br>
								<input type="text" name="special_price" class="seller_input">
								<label>[INR]</label>
							</td>
							<td></td>
						</tr>
						<tr>
							<td>
								Special Price From Date : <br>
								<input name="price_from_date" id="datepicker-example15-start" class="seller_input" type="text">
							</td>
							<td>
								Special Price To Date : <br>
								<input name="price_to_date" id="datepicker-example15-end" class="seller_input" type="text">
							</td>
						</tr>
						<tr>
                            <td>
                            	GST <sup>*</sup> : <br> 
                                <input type="text" name="vat_cst" class="seller_input">&nbsp;%
                            </td>
                            
							<td>
								Weight (in grams) <sup>*</sup> : <br>
								<input type="text" name="weight" id="prdt_weight" class="seller_input" onFocus="removeDefaultShipping()">
							</td>
						</tr>
						<tr>
							<td>Shipping Type <sup>*</sup> :<br>
								<select name="shipping_typ" id="shipping_typ" class="seller_input" onChange="showshippingAmount(this.value)">
									<option value="">Choose shipping type</option>
									<option value="Free">Free</option>
									<option value="Default">Default</option>
								</select>
								<div class="req_visibility">This is a required field.</div>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<div id="default_fee"><span>Set Amount<sup>*</sup> : </span>
									<input type="text" class="seller_input" onKeyUp="calculateshippingCost(this.value)" name="default_shipng_fee" id="default_shipng_fee" onBlur="CheckVal(this.value)"><label>[INR] (per Kg.)</label> &nbsp;&nbsp;&nbsp;
									<div class="req_flat_fee">This is a required field.</div>
									<span id="shpng_spn"></span>
								</div>
								<input type="hidden" id="hidden_shipping_fee" name="hidden_shipping_fee">
							</td>
						</tr>
						
						<tr>
							<td> 
								<input type="hidden" name="hidden_master_productID" value="<?=$master_product_id?>">
								<input type="submit"  class="seller_buttons" onClick="return Valid_exist_product_form()" value="Save"> 
								<!--<input type="button" class="seller_buttons" value="cancel">-->
							</td>
							<td>&nbsp;</td>
						</tr>
					</table>
					</form>
				</div>    
				<div class="clearfix"></div>
			</div>
<?php 
	endforeach;
endif;
?>
		</div>  <!-- @end #main-content -->
	</div><!-- @end #content -->
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
</script>

<script>
function removeDefaultShipping(){
		$('#default_shipng_fee').val('');
		$('#shpng_spn').text('Shipping fee : Rs.'+ 0);
		$('#hidden_shipping_fee').val(0);
	}
</script>

<script>
	function Valid_exist_product_form(){
		//Line for SKU valid characters
		var prod_type=$('#prod_type').val();
		if(prod_type == ""){
			$('.valid_msg_dv').show().text('Select Product Type');	
			$("input[name='prod_type']").css('border-color','red');
			$("input[name='prod_type']").focus();
			return false;
		}
		
		var re = /^[A-Za-z0-9_-]*$/
		var sku = $("input[name='sku']").val();
		 
		if(sku == ""){
			$('.valid_msg_dv').show().text('Seller SKU is required.');	
			$("input[name='sku']").css('border-color','red');
			$("input[name='sku']").focus();
			return false;
		}else if(!re.test(sku)){
			$('.valid_msg_dv').show().text('Special characters are not allowed in SKU.');
			$("input[name='sku']").css('border-color','red');
			$("input[name='sku']").select();
			return false;
		}else{
			var base_url = "<?php echo base_url(); ?>";
			var controller = "admin/sellers";
			$.ajax({
				'url' : base_url+controller+'/check_sku',
				'type' : 'POST',
				'data' : 'sku='+sku,
				'success' : function(data){
					//$('#success_sku').html(data);
					if(data == 'exist'){
						//window.location.reload(true);
						$('.valid_msg_dv').show().text('SKU already exist.');
						$("input[name='sku']").css('border-color','red');
						$("input[name='sku']").select().focus();
						return false;
					}else{
						$("input[name='sku']").css('border-color','#ccc');
						//$('.valid_msg_dv').show()
					}
				}
			});
		}
		
		var qty = $("input[name='qty']").val();
		if(qty == ""){
			$("input[name='sku']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('Product quantity is required.');	
			$("input[name='qty']").css('border-color','red').focus();
			return false;
		}else if(isNaN(qty)){
			$("input[name='sku']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('Please enter valid quantity.');	
			$("input[name='qty']").css('border-color','red').select().focus();
			return false;
		}
		
		/*28/11
		var product_fr_date = $("input[name='product_fr_date']").val(); 
		if(product_fr_date == ""){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='qty']").css('border-color', '#ccc');
			$('.valid_msg_dv').show().text('Product From Date is required.');	
			$("input[name='product_fr_date']").css('border-color','red').focus();
			return false;
		}
		var product_to_date = $("input[name='product_to_date']").val(); 
		if(product_to_date == ""){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='qty']").css('border-color', '#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('Product To Date is required.');
			$("input[name='product_to_date']").css('border-color','red').focus();
			return false;
		}
		*/
		
		var status = $("select[name='status'] option:selected").val(); //alert(status);return false;
		if(status == ""){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='qty']").css('border-color', '#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('Product status is required.');
			$("select[name='status']").css('border-color','red').focus();
			return false;
		}
		var price = $("input[name='price']").val();
		if(price == ""){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='qty']").css('border-color', '#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('MRP is required.');
			$("input[name='price']").css('border-color','red').focus();
			return false;
		}else if(isNaN(price)){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='qty']").css('border-color', '#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('MRP should be an Integer value.');
			$("input[name='price']").css('border-color','red').select().focus();
			return false;
		}
		
		
		var selling_price = $("input[name='selling_price']").val();
		if(isNaN(selling_price)){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='qty']").css('border-color', '#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$("input[name='price']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('selling Price should be an Integer value.');
			$("input[name='selling_price']").css('border-color','red').select().focus();
			return false;
		}else if(parseFloat(price) < parseFloat(selling_price)){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='qty']").css('border-color', '#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$("input[name='price']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('Selling Price should be less than MRP.');
			$("input[name='selling_price']").css('border-color','red').select().focus();
			return false;
		}
		
		var special_price = $("input[name='special_price']").val();
		if(isNaN(special_price)){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='qty']").css('border-color', '#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$("input[name='price']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('Special Price Should be Integer value.');
			$("input[name='special_price']").css('border-color','red').select().focus();
			return false;
		}else if(parseFloat(price) < parseFloat(special_price)){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='qty']").css('border-color', '#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$("input[name='price']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('Special Price Should be less than MRP.');
			$("input[name='special_price']").css('border-color','red').select().focus();
			return false;
		}
		
		var price_from_date = $("input[name='price_from_date']").val();
		if(special_price != "" && price_from_date == ""){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='qty']").css('border-color', '#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$("input[name='price']").css('border-color','#ccc');
			$("input[name='selling_price']").css('border-color','#ccc');
			$("input[name='special_price']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('Product Price from date is required.');
			$("input[name='price_from_date']").css('border-color','red').focus();
			return false;
		}
		var price_to_date = $("input[name='price_to_date']").val();
		if(special_price != "" && price_to_date == ""){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='qty']").css('border-color', '#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$("input[name='price']").css('border-color','#ccc');
			$("input[name='selling_price']").css('border-color','#ccc');
			$("input[name='special_price']").css('border-color','#ccc');
			$("input[name='price_from_date']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('Product Price to date is required.');
			$("input[name='price_to_date']").css('border-color','red').focus();
			return false;
		}
		
		
		var vat_cst = $("input[name='vat_cst']").val();
		if(vat_cst == ""){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='qty']").css('border-color', '#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$("input[name='price']").css('border-color','#ccc');
			$("input[name='selling_price']").css('border-color','#ccc');
			$("input[name='special_price']").css('border-color','#ccc');
			$("input[name='price_from_date']").css('border-color','#ccc');
			$("input[name='price_to_date']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('VAT / CST is required.');
			$("input[name='vat_cst']").css('border-color','red').focus();
			return false;
		}else if(isNaN(vat_cst)){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='qty']").css('border-color', '#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$("input[name='price']").css('border-color','#ccc');
			$("input[name='selling_price']").css('border-color','#ccc');
			$("input[name='special_price']").css('border-color','#ccc');
			$("input[name='price_from_date']").css('border-color','#ccc');
			$("input[name='price_to_date']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('Invalid Amount !');
			$("input[name='vat_cst']").css('border-color','red').select();
			return false;
		}
		
		var weight = $("input[name='weight']").val();
		if(weight == ""){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='qty']").css('border-color', '#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$("input[name='price']").css('border-color','#ccc');
			$("input[name='selling_price']").css('border-color','#ccc');
			$("input[name='special_price']").css('border-color','#ccc');
			$("input[name='price_from_date']").css('border-color','#ccc');
			$("input[name='price_to_date']").css('border-color','#ccc');
			$("input[name='vat_cst']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('Product weight is required.');
			$("input[name='weight']").css('border-color','red').focus();
			return false;
		}else if(isNaN(weight)){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='qty']").css('border-color', '#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$("input[name='price']").css('border-color','#ccc');
			$("input[name='selling_price']").css('border-color','#ccc');
			$("input[name='special_price']").css('border-color','#ccc');
			$("input[name='price_from_date']").css('border-color','#ccc');
			$("input[name='price_to_date']").css('border-color','#ccc');
			$("input[name='vat_cst']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('Please enter valid weight.');
			$("input[name='weight']").css('border-color','red').select();
			return false;
		}
		
		var shipping_typ = $('#shipping_typ').val(); 
		var default_shipng_fee = $('#default_shipng_fee').val();
		if(shipping_typ == ''){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='qty']").css('border-color', '#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$("input[name='price']").css('border-color','#ccc');
			$("input[name='selling_price']").css('border-color','#ccc');
			$("input[name='special_price']").css('border-color','#ccc');
			$("input[name='price_from_date']").css('border-color','#ccc');
			$("input[name='price_to_date']").css('border-color','#ccc');
			$("input[name='vat_cst']").css('border-color','#ccc');
			$("input[name='weight']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('Please choose Shipping Type.');
			$('#shipping_typ').css('border-color','red').focus();
			return false;
		}
		if(shipping_typ == 'Default' && default_shipng_fee == ''){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='qty']").css('border-color', '#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$("input[name='price']").css('border-color','#ccc');
			$("input[name='selling_price']").css('border-color','#ccc');
			$("input[name='special_price']").css('border-color','#ccc');
			$("input[name='price_from_date']").css('border-color','#ccc');
			$("input[name='price_to_date']").css('border-color','#ccc');
			$("input[name='vat_cst']").css('border-color','#ccc');
			$("input[name='weight']").css('border-color','#ccc');
			$('#shipping_typ').css('border-color','#ccc');
			$('.valid_msg_dv').show().text('Shipping amount is required.');
			$('#default_shipng_fee').css('border-color','red').focus();
			return false;
		}
		if(shipping_typ == 'Default' && isNaN(default_shipng_fee)){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='qty']").css('border-color', '#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$("input[name='price']").css('border-color','#ccc');
			$("input[name='selling_price']").css('border-color','#ccc');
			$("input[name='special_price']").css('border-color','#ccc');
			$("input[name='price_from_date']").css('border-color','#ccc');
			$("input[name='price_to_date']").css('border-color','#ccc');
			$("input[name='vat_cst']").css('border-color','#ccc');
			$("input[name='weight']").css('border-color','#ccc');
			$('#shipping_typ').css('border-color','#ccc');
			$('.valid_msg_dv').show().text('Invalid shipping amount.');
			$('#default_shipng_fee').css('border-color','red').select();
			return false;
		}	
		/*if(shipping_typ == 'Default' && default_shipng_fee > 60){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='qty']").css('border-color', '#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$("input[name='price']").css('border-color','#ccc');
			$("input[name='selling_price']").css('border-color','#ccc');
			$("input[name='special_price']").css('border-color','#ccc');
			$("input[name='price_from_date']").css('border-color','#ccc');
			$("input[name='price_to_date']").css('border-color','#ccc');
			$("input[name='vat_cst']").css('border-color','#ccc');
			$("input[name='weight']").css('border-color','#ccc');
			$('#shipping_typ').css('border-color','#ccc');
			$('.valid_ms g_dv').show().text('Invalid shipping amount.');
			$('#default_shipng_fee').css('border-color','red').select().focus();
			return false;
		}*/	
			
		/* On 26/10/15
		if($("input[name='shippingfee']").is(':checked')) {
			var shipping_fee_type = $('input[name="shippingfee"]:checked').val(); 	
		}else{
			var shipping_fee_type = '';
		}
		
		var local_shipng_fee = $("input[name='local_shipng_fee']").val();
		if(local_shipng_fee == "" && shipping_fee_type == ''){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$("input[name='price']").css('border-color','#ccc');
			$("input[name='special_price']").css('border-color','#ccc');
			$("input[name='price_from_date']").css('border-color','#ccc');
			$("input[name='price_to_date']").css('border-color','#ccc');
			$("input[name='tax_class']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('Local shipping fee is required.');
			$("input[name='local_shipng_fee']").css('border-color','red').focus();
			return false;
		}
		if(isNaN(local_shipng_fee) && shipping_fee_type == ''){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$("input[name='price']").css('border-color','#ccc');
			$("input[name='special_price']").css('border-color','#ccc');
			$("input[name='price_from_date']").css('border-color','#ccc');
			$("input[name='price_to_date']").css('border-color','#ccc');
			$("input[name='tax_class']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('Local shipping fee should be an Integer value.');
			$("input[name='local_shipng_fee']").css('border-color','red').select().focus();
			return false;
		}
		var zonal_shipng_fee = $("input[name='zonal_shipng_fee']").val();
		if(zonal_shipng_fee == "" && shipping_fee_type == ''){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$("input[name='price']").css('border-color','#ccc');
			$("input[name='special_price']").css('border-color','#ccc');
			$("input[name='price_from_date']").css('border-color','#ccc');
			$("input[name='price_to_date']").css('border-color','#ccc');
			$("input[name='tax_class']").css('border-color','#ccc');
			$("input[name='local_shipng_fee']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('Zonal shipping fee is required.');
			$("input[name='zonal_shipng_fee']").css('border-color','red').focus();
			return false;
		}
		if(isNaN(zonal_shipng_fee) && shipping_fee_type == ''){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$("input[name='price']").css('border-color','#ccc');
			$("input[name='special_price']").css('border-color','#ccc');
			$("input[name='price_from_date']").css('border-color','#ccc');
			$("input[name='price_to_date']").css('border-color','#ccc');
			$("input[name='tax_class']").css('border-color','#ccc');
			$("input[name='local_shipng_fee']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('Zonal shipping fee should be an Integer value.');
			$("input[name='zonal_shipng_fee']").css('border-color','red').select().focus();
			return false;
		}
		var national_shipng_fee = $("input[name='national_shipng_fee']").val();
		if(national_shipng_fee == "" && shipping_fee_type == ''){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$("input[name='price']").css('border-color','#ccc');
			$("input[name='special_price']").css('border-color','#ccc');
			$("input[name='price_from_date']").css('border-color','#ccc');
			$("input[name='price_to_date']").css('border-color','#ccc');
			$("input[name='tax_class']").css('border-color','#ccc');
			$("input[name='local_shipng_fee']").css('border-color','#ccc');
			$("input[name='zonal_shipng_fee']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('National shipping fee is required.');
			$("input[name='national_shipng_fee']").css('border-color','red').focus();
			return false;
		}
		if(isNaN(national_shipng_fee) && shipping_fee_type == ''){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$("input[name='price']").css('border-color','#ccc');
			$("input[name='special_price']").css('border-color','#ccc');
			$("input[name='price_from_date']").css('border-color','#ccc');
			$("input[name='price_to_date']").css('border-color','#ccc');
			$("input[name='tax_class']").css('border-color','#ccc');
			$("input[name='local_shipng_fee']").css('border-color','#ccc');
			$("input[name='zonal_shipng_fee']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('National shipping fee should be an Integer value.');
			$("input[name='national_shipng_fee']").css('border-color','red').select().focus();
			return false;
		}
		var flat_shipping_fee = $('#flat_shipng_fee').val();
		if(shipping_fee_type == 'flat' && flat_shipping_fee == ''){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$("input[name='price']").css('border-color','#ccc');
			$("input[name='special_price']").css('border-color','#ccc');
			$("input[name='price_from_date']").css('border-color','#ccc');
			$("input[name='price_to_date']").css('border-color','#ccc');
			$("input[name='tax_class']").css('border-color','#ccc');
			$("input[name='local_shipng_fee']").css('border-color','#ccc');
			$("input[name='zonal_shipng_fee']").css('border-color','#ccc');
			$("input[name='national_shipng_fee']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('Flat shipping fee is required.');
			$("input[name='flat_shipng_fee']").css('border-color','red').focus();
			return false;
		}
		if(isNaN(flat_shipping_fee)){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$("input[name='price']").css('border-color','#ccc');
			$("input[name='special_price']").css('border-color','#ccc');
			$("input[name='price_from_date']").css('border-color','#ccc');
			$("input[name='price_to_date']").css('border-color','#ccc');
			$("input[name='tax_class']").css('border-color','#ccc');
			$("input[name='local_shipng_fee']").css('border-color','#ccc');
			$("input[name='zonal_shipng_fee']").css('border-color','#ccc');
			$("input[name='national_shipng_fee']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('Flat shipping fee should be an Integer value.');
			$("input[name='flat_shipng_fee']").css('border-color','red').select().focus();
			return false;
		}*/
		
		
		
		
		/* On 26/10/15
		var stock_avail = $("select[name='stock_avail']").val();
		if(stock_avail == ""){
			$("input[name='sku']").css('border-color','#ccc');
			$("input[name='product_fr_date']").css('border-color','#ccc');
			$("input[name='product_to_date']").css('border-color','#ccc');
			$("select[name='status']").css('border-color','#ccc');
			$("input[name='price']").css('border-color','#ccc');
			$("input[name='special_price']").css('border-color','#ccc');
			$("input[name='price_from_date']").css('border-color','#ccc');
			$("input[name='price_to_date']").css('border-color','#ccc');
			$("input[name='tax_class']").css('border-color','#ccc');
			$("input[name='local_shipng_fee']").css('border-color','#ccc');
			$("input[name='zonal_shipng_fee']").css('border-color','#ccc');
			$("input[name='qty']").css('border-color','#ccc');
			$('.valid_msg_dv').show().text('Stock Availability is required.');
			$("select[name='stock_avail']").css('border-color','red').focus();
			return false;
		}*/
	}
</script>
<script>
	function showPriceNotice(mrp, exist_mrp){ 
		if(isNaN(mrp)){
			$("input[name='price']").css('border-color','red').select().focus();
			alert('MRP should be an Integer value.');
			return false;
		}
		if(exist_mrp > mrp){ 
			alert("Exist Product MRP is greater than given MRP.");
			return false;
		}else{  
			alert("Exist Product MRP is less than given MRP.");
			return false;
		}
	}
</script>

<!---Image uploading Script Start here --->
<script src="<?php echo base_url();?>js/img_uplod_script/jquery.uploadfile1.min.js"></script>
<link href="<?php echo base_url();?>css/admin/uploadfile.css" rel="stylesheet" type="text/css">

<script>
$(document).ready(function()
{
$("#uploadfile").uploadFile({
url: "<?php echo base_url();?>admin/sellers/upload_product_tmp_image/<?php echo $seller_id; ?>",
dragDrop: true,
fileName: "userfile",
returnType: "json",
showDelete: true,
//showDownload:true,
statusBarWidth:350,
dragdropWidth:350,
showPreview:true,
previewHeight: "100px",
previewWidth: "100px",

maxFileCount:5,
//maxFileSize:100*1024,
maxFileSize:100*500,
//minFileSize:500*500,

deleteCallback: function (data, pd) {
    for (var i = 0; i < data.length; i++) {
		var seller_id = "<?php echo $this->uri->segment(4); ?>";
        $.post("<?php echo base_url();?>admin/sellers/delete_product_tmp_image", {op: "delete",seller_id:seller_id,name: data[i]},
            function (resp,textStatus, jqXHR) {
                //Show Message
				//alert(name);
                alert("File Deleted");
            });
    }
    pd.statusbar.hide(); //You choice.
},
//image download not mandatory
downloadCallback:function(filename,pd)
	{
		location.href="<?php echo base_url();?>admin/sellers/download_product_tmp_image?filename="+filename;
	}
});  
});
</script>
<!---Image uploading Script end here --->

<style>
.wrapper{background: #ececec; font-family: "Gill Sans", Impact, sans-serif; position: relative; text-align: center; width: 0px; float: right; right: 305px; cursor: default;
  -webkit-transform: translateZ(0); /* webkit flicker fix */
  -webkit-font-smoothing: antialiased; /* webkit text rendering fix */
}

.wrapper .tooltip{ background: #1496bb; bottom: 100%; color: #fff; display: block; left: -130px; margin-bottom: 8px; opacity: 0; padding: 10px; pointer-events: none; position: absolute; width: 275px;
  -webkit-transform: translateY(10px);
     -moz-transform: translateY(10px);
      -ms-transform: translateY(10px);
       -o-transform: translateY(10px);
          transform: translateY(10px);
  -webkit-transition: all .25s ease-out;
     -moz-transition: all .25s ease-out;
      -ms-transition: all .25s ease-out;
       -o-transition: all .25s ease-out;
          transition: all .25s ease-out;
  -webkit-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
     -moz-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
      -ms-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
       -o-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
          box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
}

/* This bridges the gap so you can mouse into the tooltip without it disappearing */
.wrapper .tooltip:before {bottom: -20px; content: " "; display: block; height: 20px; left: 0; position: absolute; width: 100%;}  

/* CSS Triangles - see Trevor's post */
.wrapper .tooltip:after { border-left: solid transparent 10px; border-right: solid transparent 10px; border-top: solid #1496bb 10px; bottom: -10px; content: " "; height: 0; left: 50%; margin-left: -13px; position: absolute; width: 0;}
  
.wrapper:hover .tooltip {opacity: 1; pointer-events: auto;
  -webkit-transform: translateY(0px);
     -moz-transform: translateY(0px);
      -ms-transform: translateY(0px);
       -o-transform: translateY(0px);
          transform: translateY(0px);
}

/* IE can just show/hide with no transition */
.lte8 .wrapper .tooltip { display: none;}

.lte8 .wrapper:hover .tooltip { display: block;}
</style>	
<!------ Start Content ------>
	
<?php
require_once('footer.php');
?>