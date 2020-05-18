<?php
require_once('header.php');
?>  
<style>
ul ul{
    display:none;   
}
ul{
    margin:3px;
}
ul li{
	margin-left: 10px;
	list-style: none;
}
</style>
<script>
	$(document).ready(function(){
		$('li').click(function(ev) {
			$(this).find('>ul').slideToggle();
			ev.stopPropagation();
		});
	});
</script>
			<div id="content">    
				<div class="top-bar">    
					<div class="top-right">
						<ul>
							<li> Welcome Admin</li>
							<li><a href="#">Login</a></li> 
							<li><a href="#">Logout</a></li> 
						</ul>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
					<div class="bs-example">
						<div class="panel-group" id="accordion">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Select Category</a>
									</h4>
								</div>
								<div id="collapseOne" class="panel-collapse collapse in">
									<div class="panel-body">
										<div class="category_menu">
											<ul>
												<!--<li>
													level 2
													<ul>
														<li>a</li>
														<li>b</li>
													</ul>
												</li>-->
												<li>
													Clothing
													<ul>
														<li>
															School Uniforms
															<ul>
																<li><a>Uniform Shirt</a></li>
																<li><a>Uniform Tie</a></li>
																<li><a>Uniform Belt</a></li>
																<li><a>Uniform Sweater</a></li>
																<li><a>Uniform Sock</a></li>
																<li></li>
																<li></li>
															</ul>
														</li>
														<li>Suits & Sets
															<ul>
																<li>Suit</li>
																<li>Sari</li>
																<li>Gown</li>
																<li>Kid Costume_wear</li>
																<li>Salwar Kurta_dupatta</li>
																<li>Sherwani</li>
																<li>Fabric</li>
															</ul>
														</li>
														<li>Tops
															<ul>
																<li>Blazer</li>
																<li>Dress</li>
																<li>Jacket</li>
																<li>Kurta</li>
																<li>Shirt</li>
																<li>Top</li>
																<li>T-Shirt</li>
															</ul>
														</li>
													</ul>
												</li>
												<li>Mobiles & Cameras</li>
												<li>Footwear & Accessories</li>
												<li>Home & Kitchen</li>
												<li>Jewellery</li>
												<li>Baby Care & Toys</li>
												<li>Books & Media</li>
												<li>Computers & Gaming</li>
												<li>Footwear & Accessories</li>
											</ul>
										</div>
										<div class="category_details">
											<div class="category_details_title">Uniform Shirt</div>
											<div class="category_details_content">Uniform Shirt refers to the shirt worn by students at school.</div>
										</div>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Product Identifiers</a>
									</h4>
								</div>
								<div id="collapseTwo" class="panel-collapse collapse">
									<div class="panel-body">
										<table id="albums" style="width:100%;"  cellspacing="0px">
											<tr>
												<td width="20%">Are there variants for this products</td>
												<td width="20%">
													<input type="radio" name="variant_product" value="no" check="checked">No
													<input type="radio" name="variant_product" value="yes">Yes
												</td>
												<td width="10%"></td>
												<td width="20%"></td><td width="20%"></td><td width="10%"></td>
											</tr>
											<tr>
												<td>Sku Id</td>
												<td><input name="sku_id" class="seller_input" type="text" value=""></td>
												<td></td><td></td>
											</tr>
											<tr>
												<td>Maximum Age (month) - Only for Kids</td>
												<td><input name="max_age" class="seller_input" type="text" placeholder="Ex:14" value=""></td>
												<td class="add_icon"> <button type="button" class="icon-plus-sign"></button> </td>
												<td>Minimum Age (month) - Only for Kids</td>
												<td><input name="max_age" class="seller_input" type="text" placeholder="Ex:1" value=""></td>
												<td class="add_icon"> <button type="button" class="icon-plus-sign"></button> </td>
											</tr>
											<tr>
												<td>Brand</td>
												<td><input name="brand" class="seller_input" type="text" placeholder="Killer" value=""></td>
												<td></td>
												<td>Style Code</td>
												<td><input name="style_code" class="seller_input" type="text" placeholder="Killer001" value=""></td>
												<td></td>
											</tr>
											<tr>
												<td>SIze</td>
												<td>
													<select class="seller_input">
														<option> -- Choose Size -- </option>
														<option> 40 </option><option> 42 </option><option> 44 </option><option> 40 </option><option> 40 </option>
													</select>
												</td>
												<td>
													<select>
														<option> Choose </option>
														<option> 40 </option><option> 42 </option><option> 44 </option><option> 40 </option><option> 40 </option>
													</select>
												</td>
												<td></td><td></td><td></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Product Images</a>
									</h4>
								</div>
								<div id="collapseThree" class="panel-collapse collapse">
									<div class="panel-body">
										<div style="border: 1px solid #f1f1f1;">
											<div class="product_image">
												<img src="<?php echo base_url();?>images/Tulips.jpg" width="500" height="400" alt="">
												<div class="product_img_upload">
													<p>Image</p>
													<input type="file" name="product_img" multiple>
													<input type="submit" name="submit" value="Upload image">
													</br>
													Image Guidelines for a Vertical<br>
													<ul><li> Maximum images supported :- 5 </li>
													<li> Minimum images requirded :- 2 </li></ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"> Mandatory Information </a>
									</h4>
								</div>
								<div id="collapseFour" class="panel-collapse collapse">
									<div class="panel-body">
										<table id="albums" style="width:100%;"  cellspacing="0px">
											<tr>
												<td width="20%">EAN/UPC</td>
												<td width="20%"><input type="text" class="seller_input" name="ean/upc" placeholder="Ex: 123456789"></td>
												<td width="10%"> <button type="button" class="icon-plus-sign"></button> </td>
												<td width="20%">Occasion</td>
												<td width="20%">
													<select class="seller_input">
														<option> -- Choose Occasion -- </option>
														<option> Occasion 1 </option><option> Occasion 2 </option><option> Occasion 3 </option><option> Occasion 4 </option><option> Occasion 5 </option>
													</select>
												</td>
												<td width="10%"> <button type="button" class="icon-plus-sign"></button> </td>
											</tr>
											<tr>
												<td>Ideal For</td>
												<td>
													<select class="seller_input">
														<option> -- Choose ideal for -- </option>
														<option> Ideal For 1 </option><option> Ideal For 2 </option><option> Ideal For 3 </option><option> Ideal For 4 </option><option> Ideal For 5 </option>
													</select>
												</td>
												<td> <button type="button" class="icon-plus-sign"></button> </td>
												<td>Fabric</td>
												<td><input type="text" class="seller_input" name="fabric" placeholder="Ex: Cotton"></td>
												<td> <button type="button" class="icon-plus-sign"></button> </td>
											</tr>
											<tr>
												<td>Pattern</td>
												<td>
													<select class="seller_input">
														<option> -- Choose pattern -- </option>
														<option> pattern 1 </option><option> pattern 2 </option><option> pattern 3 </option><option> pattern 4 </option><option> pattern 5 </option>
													</select>
												</td>
												<td> <button type="button" class="icon-plus-sign"></button> </td>
												<td>Group ID</td>
												<td><input type="text" class="seller_input" name="gr_id" placeholder="Ex: DA 1002"></td>
												<td> <button type="button" class="icon-plus-sign"></button> </td>
											</tr>
											<tr>
												<td>Type</td>
												<td>
													<select class="seller_input">
														<option> -- Choose type -- </option>
														<option> type 1 </option><option> type 2 </option><option> type 3 </option><option> type 4 </option><option> type 5 </option>
													</select>
												</td>
												<td></td>
												<td>Color</td>
												<td>
													<select class="seller_input">
														<option> -- Choose color -- </option>
														<option> color 1 </option><option> color 2 </option><option> color 3 </option><option> color 4 </option><option> color 5 </option>
													</select>
												</td>
												<td> <button type="button" class="icon-plus-sign"></button> </td>
											</tr>
											<tr>
												<td>Fabric</td>
												<td><input type="text" class="seller_input" name="fabric" placeholder="Ex: Cotton"></td>
												<td> <button type="button" class="icon-plus-sign"></button> </td>
												<td></td><td></td><td></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">Additional Information</a>
									</h4>
								</div>
								<div id="collapseFive" class="panel-collapse collapse">
									<div class="panel-body">
										<table id="albums" style="width:100%;"  cellspacing="0px">
											<tr>
												<td width="20%">Warranty Service Type</td>
												<td width="20%"><input type="text" class="seller_input" name="warranty_type" placeholder="Ex: On-site Service"></td>
												<td width="10%"></td>
												<td width="20%">Video URL</td>
												<td width="20%"><input type="text" class="seller_input" name="video_url" placeholder="Ex: www.youtube.com/watch/.."></td>
												<td width="10%"></td>
											</tr>
											<tr>
												<td>Domestic Warranty</td>
												<td><input type="text" class="seller_input" name="domestic_warranty" placeholder="Ex: 2"</td>
												<td>
													<select>
														<option> -- Choose -- </option>
														<option> 1yr </option><option> 2yr </option><option> 3yr </option><option> 4yr </option><option> 5yr </option>
													</select>
												</td>
												<td>Description</td>
												<td><textarea class="seller_input" rows="2" name="description"></textarea></td>
												<td></td>
											</tr>
											<tr>
												<td>Sleeve</td>
												<td><input type="text" class="seller_input" name="sleeve" placeholder="Ex: Full Sleeve"</td>
												<td></td>
												<td>Search Keyword</td>
												<td><input type="text" class="seller_input" name="search_keyword" placeholder="Ex: keyword"></td>
												<td> <button type="button" class="icon-plus-sign"></button> </td>
											</tr>
											<tr>
												<td>International Warranty</td>
												<td><input type="text" class="seller_input" name="international_warranty" placeholder="Ex: 1"</td>
												<td>
													<select>
														<option> -- Choose -- </option>
														<option> 1yr </option><option> 2yr </option><option> 3yr </option><option> 4yr </option><option> 5yr </option>
													</select>
												</td>
												<td>Not Covered in Warranty</td>
												<td><input type="text" class="seller_input" name="not_cover_warranty" placeholder="Ex: Warranty dosent covered any"</td>
												<td></td>
											</tr>
											<tr>
												<td>Other Dimensions</td>
												<td><input type="text" class="seller_input" name="other_dimn" placeholder="Ex: Dummy"></td>
												<td> <button type="button" class="icon-plus-sign"></button> </td>
												<td>Pack of</td>
												<td><input type="text" class="seller_input" name="pack_of" placeholder="Ex: 2"</td>
												<td></td>
											</tr>
											<tr>
												<td>Closure</td>
												<td><input type="text" class="seller_input" name="closure" placeholder="Ex: Laced"></td>
												<td> <button type="button" class="icon-plus-sign"></button> </td>
												<td>Model Name</td>
												<td><input type="text" class="seller_input" name="model_name" placeholder="Ex: Pro"</td>
												<td></td>
											</tr>
											<tr>
												<td>Key Features</td>
												<td><input type="text" class="seller_input" name="key_features" placeholder="Ex: key_features1|key_features2"></td>
												<td> <button type="button" class="icon-plus-sign"></button> </td>
												<td>Fit</td>
												<td><input type="text" class="seller_input" name="fit" placeholder="Ex: Slim fit"</td>
												<td></td>
											</tr>
											<tr>
												<td>Pockets</td>
												<td><input type="text" class="seller_input" name="pockets" placeholder="Ex: 2front slip poskets"></td>
												<td> <button type="button" class="icon-plus-sign"></button> </td>
												<td>Vents</td>
												<td><input type="text" class="seller_input" name="vents" placeholder="Ex: Vent at Back"></td>
												<td> <button type="button" class="icon-plus-sign"></button> </td>
											</tr>
											<tr>
												<td>Sales Package</td>
												<td><input type="text" class="seller_input" name="sales_package" placeholder="Ex: Blazer"></td>
												<td> <button type="button" class="icon-plus-sign"></button> </td>
												<td>Lining</td>
												<td><input type="text" class="seller_input" name="lining" placeholder="Ex: Sile Lining"</td>
												<td></td>
											</tr>
											<tr>
												<td>Warranty Summary</td>
												<td><input type="text" class="seller_input" name="lining" placeholder="Ex: 1 Year Dummy Warranty"</td>
												<td></td>
												<td>Key Spec</td>
												<td><input type="text" class="seller_input" name="sales_package" placeholder="Ex: Key Spec1|Key Spec1|Key Spec1"></td>
												<td> <button type="button" class="icon-plus-sign"></button> </td>
											</tr>
											<tr>
												<td>Fabric Care</td>
												<td><input type="text" class="seller_input" name="fabric_care" placeholder="Ex: Wash with Similar Color"></td>
												<td> <button type="button" class="icon-plus-sign"></button> </td>
												<td>Other Details</td>
												<td><input type="text" class="seller_input" name="other_details" placeholder="Ex: Dummy1|Dummy1|Dummy1"></td>
												<td> <button type="button" class="icon-plus-sign"></button> </td>
											</tr>
											<tr>
												<td>Covered in Warranty</td>
												<td><input type="text" class="seller_input" name="covered_in_warranty" placeholder="Ex: Warranty for the Product is limited"</td>
												<td></td><td></td><td></td><td></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="right">
						<button type="button" class="seller_buttons"> Save Draft </button>
						<button type="button" class="seller_buttons"> Submit </button>
					</div>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->
<?php
require_once('footer.php');
?>		