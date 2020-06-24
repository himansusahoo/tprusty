<?php
require_once("header.php");
$this->load->helper('string');

if($this->session->userdata('seller_session_id')==""){
	$dtm = str_replace(" ","-",date('Y-m-d H:i:s'));
	$session_slr_id = random_string('alnum', 16).$dtm;
	$this->session->set_userdata('seller_session_id',$session_slr_id);
}
?>

<link href="<?php echo base_url();?>css/admin/uploadfile.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url(); ?>js/countries.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url().'js/jquery.collapsibleCheckboxTree.js' ?>"></script>

<script type="text/javascript">
jQuery(document).ready(function(){
	$('ul#example').collapsibleCheckboxTree();
});
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
                
                <!--<form action="<?php// echo base_url().'admin/catalog/get_new_product_data' ?>" method="post">-->
                <?php
				$attributes = array('id' => 'product_add_form');
				echo form_open_multipart('admin/catalog/get_new_product_data',$attributes); 
				?>
                
					<div class="row content-header">
                    	<div class="col-md-2">&nbsp;</div> 
						<div class="col-md-10">
                        	&nbsp;
						<!--<div class="col-md-4 show_report">-->
							<input type="reset" class="all_buttons" value="Reset">
                            <button type="submit" class="all_buttons" onClick="return ValidProduct_form()">Save</button>
                            <!--<button type="submit" class="all_buttons">Save</button>-->
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
          <div class="valid_msg_dv"></div>
           
			<ul class="nav nav-tabs tabs-horiz">
				<li id="li_tab1" class="active"><a data-toggle="tab" href="#tab1">Create Product Settings</a></li>
				<li id="li_tab2"><a data-toggle="tab" href="#tab2">General</a></li>
				<li id="li_tab3"><a data-toggle="tab" href="#tab3">Prices</a></li>
				<li id="li_tab4"><a data-toggle="tab" href="#tab4">Meta Information</a></li>
               	<li id="li_tab5"><a data-toggle="tab" href="#tab5">Images</a></li>
                <!--<li id="li_tab6"><a data-toggle="tab" href="#tab6">Inventory</a></li>
                <li id="li_tab7"><a data-toggle="tab" href="#tab7">Categories</a></li>-->
                <li id="li_tab8"><a data-toggle="tab" href="#tab8">Related Products</a></li>
			</ul>

			<!--<div class="tab-content form_view">-->
			<div class="tab-content form_view">
				<div id="tab1" class="tab-pane fade in active">
					<h3>Create Product Settings</h3>
					<table>
						<tr>
							<td style="width:20%;"> Attribute Set <sup>*</sup> </td>
							<td> 
								<select name="attribute_set" id="attribute_set" class="chosen-select_attr" onChange="ShowAttrHeadings()">
                                	<option value="">--- select ---</option>
									<?php foreach($result_attr_group as $row){ ?>
										<option value="<?= $row->attribute_group_id; ?>"><?= $row->attribute_group_name; ?></option>
									<?php } ?>
								</select>
                                <!--<input type="button" value="Go" id="go_btn" onClick="ShowAttrHeadings()">-->
                                <img src="<?php echo base_url();?>/images/progress.gif" id="attr_lodr">
							</td>
						</tr>
						<tr>
							<td colspan="2" id="attr_flds_td">
								
							</td>
						</tr>
                        
                        <tr>
                        	<td colspan="2">
                            	
                            </td>
                        </tr>
                        
						<tr style="display:none;">
							<td> Product Type </td>
							<td> 
								<select name="product_type" id="product_type" class="text2"/>
									<!--<option value="">---select---</option>-->
									<option value="Simple Product">Simple Product</option>
									<option value="Grouped Product">Grouped Product</option>
								</select>
							</td>
						</tr>
					</table>
                    
                    <h3 style="margin-top:20px;">Categories </h3>
                    <table style="width:100%;">
                    		<tr>
                            	<td>Category Name <sup>*</sup></td>
                                <td>
                                	<select name="auto_category_name" id="auto_category_name" data-placeholder="Choose Category" class="chosen-select"  tabindex="4">
                                    	<option value="">Choose Category</option>
										<?php foreach($all_category_result as $crows){ ?>
                                        <option value="<?=$crows->category_id;?>"><?=$crows->category_name;?></option>
                                        <?php }?>
                                    </select>
                                </td>
                            </tr>
                        	<tr>
                            	<td>
                          
<ul id="example">
  <?php foreach($data2->result() as $rows){ ?> <!--level-1 -->
    <li id="category_li">
      <!--<input id="subcategory_id"  type="radio" name="subcategory_id"   value="<?php// echo $rows->category_id; ?> "       />-->
      <?php echo $rows->category_name; ?>
      <ul >
      <?php $qr=$this->db->query("select * from category_indexing where parent_id='$rows->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct=$qr->num_rows();
		
	  	if($ct>0){ ?>
        
        <?php 
			foreach($qr->result() as $rs){ ?> <!--level-2 -->
       <li>		
			<!--<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php// echo $rs->category_id; ?>"   />-->
				
		 <?php echo	$rs->category_name;?>
         
         <ul>
         <!--level-3-->
          <?php $qr1=$this->db->query("select * from category_indexing where parent_id='$rs->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct1=$qr1->num_rows();
		
	  	if($ct1>0){ ?>
        
        <?php 
			foreach($qr1->result() as $rs1){ ?>
       <li>		
			<!--<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php// echo $rs1->category_id; ?>"   />-->
				
		 <?php echo	$rs1->category_name;?>
         
         
         <ul>
         <!--level-4-->
          <?php $qr2=$this->db->query("select * from category_indexing where parent_id='$rs1->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct2=$qr2->num_rows();
		
	  	if($ct2>0){ ?>
        
        <?php 
			foreach($qr2->result() as $rs2){ ?>
       <li>		
			<!--<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php// echo $rs2->category_id; ?>"   />-->
				
		 <?php echo	$rs2->category_name;?>
         
         
         <ul>
         <!--level-5-->
          <?php $qr3=$this->db->query("select * from category_indexing where parent_id='$rs2->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct3=$qr3->num_rows();
		
	  	if($ct3>0){ ?>
        
        <?php 
			foreach($qr3->result() as $rs3){ ?>
       <li>		
			<!--<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php// echo $rs3->category_id; ?>"     />-->
				
		 <?php echo	$rs3->category_name;?>
         
                 
         <ul>
         <!--level-6-->
          <?php $qr4=$this->db->query("select * from category_indexing where parent_id='$rs3->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct4=$qr4->num_rows();
		
	  	if($ct4>0){ ?>
        
        <?php 
			foreach($qr4->result() as $rs4){ ?>
       <li>		
			<!--<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php// echo $rs4->category_id; ?>"    />-->
				
		 <?php echo	$rs4->category_name;?>
         
                 
          <ul>
         <!--level-7-->
          <?php $qr5=$this->db->query("select * from category_indexing where parent_id='$rs4->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct5=$qr5->num_rows();
		
	  	if($ct5>0){ ?>
        
        <?php 
			foreach($qr5->result() as $rs5){ ?>
       <li>		
			<!--<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php// echo $rs5->category_id; ?>"    />-->
				
		 <?php echo	$rs5->category_name;?>
         
         
         <ul>
         <!--level-8-->
          <?php $qr6=$this->db->query("select * from category_indexing where parent_id='$rs5->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct6=$qr6->num_rows();
		
	  	if($ct6>0){ ?>
        
        <?php 
			foreach($qr6->result() as $rs6){ ?>
       <li>		
			<!--<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php// echo $rs6->category_id; ?>"    />-->
				
		 <?php echo	$rs6->category_name;?>
         
         
          <ul>
         <!--level-9-->
          <?php $qr7=$this->db->query("select * from category_indexing where parent_id='$rs6->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct7=$qr7->num_rows();
		
	  	if($ct7>0){ ?>
        
        <?php 
			foreach($qr7->result() as $rs7){ ?>
       <li>		
			<!--<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php// echo $rs7->category_id; ?>"    />-->
				
		 <?php echo	$rs7->category_name;?>
         
            <ul>
         <!--level-10-->
          <?php $qr8=$this->db->query("select * from category_indexing where parent_id='$rs7->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct8=$qr8->num_rows();
		
	  	if($ct8>0){ ?>
        
        <?php 
			foreach($qr8->result() as $rs8){ ?>
       <li>		
			<!--<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php// echo $rs8->category_id; ?>"    />-->
				
		 <?php echo	$rs8->category_name;?>
         
        </li> <?php } ?>  <?php } ?> </ul>              
                      
        </li> <?php } ?>  <?php } ?> </ul>
                      
        </li> <?php } ?>  <?php } ?> </ul>       
                      
        </li> <?php } ?>  <?php } ?> </ul>
                             
        </li> <?php } ?>  <?php } ?> </ul>
         
        </li> <?php } ?>  <?php } ?> </ul>
         
        </li> <?php } ?>  <?php } ?> </ul>
        
        </li> <?php } ?>  <?php } ?> </ul>
         
        </li> <?php } ?>  <?php } ?> </ul>
     </li>
        <?php } ?>
  </ul>
                          	</td>
                  		</tr>        
					</table>
                    
                    
				</div>
				<div id="tab2" class="tab-pane fade">
					<h3>General</h3>
					<table>
						<tr>
							<td style="width:20%;"> Name <sup>*</sup> </td>
							<td>
								<input type="text" name="name" id="prdt_name" class="text">
								<!--<input type="hidden" name="product_id" value="<?php// echo $product_id; ?>">-->
							</td>
						</tr>
						<tr>
							<td> Description <sup>*</sup> </td>
							<td> 
								<textarea rows="7" class="text" name="prdt_desc" id="prdt_desc"></textarea>
								<!--<button type="button" class="all_buttons">WYSIWYG Editor</button>--> 
							</td>
						</tr>
						<tr>
							<td> product highlights <sup>*</sup> </td>
							<td> 
								<!--<textarea rows="7" name="prdt_short_desc" id="prdt_short_desc" class="text"></textarea>-->
								<!--<button type="button" class="all_buttons">WYSIWYG Editor</button>-->
                                <input type="text" name="prdt_short_desc[]" id="prdt_short_desc" class="text" maxlength="30" placeholder='product highlights'><br/><br/>
                                <input type="text" name="prdt_short_desc[]" class="text" maxlength="30" placeholder='product highlights'><br/><br/>
                                <input type="text" name="prdt_short_desc[]" class="text" maxlength="30" placeholder='product highlights'><br/><br/>
                                <input type="text" name="prdt_short_desc[]" class="text" maxlength="30" placeholder='product highlights'><br/><br/>
                                <input type="text" name="prdt_short_desc[]" class="text" maxlength="30" placeholder='product highlights'>
							</td>
						</tr>
						<!--<tr>
							<td> SKU <sup>*</sup> </td>
							<td> <input type="text" name="sku1" id="prdt_sku" class="text" onBlur="checkSku(this.value)"> </td>
						</tr>-->
						<tr>
							<td>Set Product as New from Date</td>
							<td><input name="from_date" class="text2 dt" id="datepicker-example7-start"></td>
						</tr>
						<tr>
							<td>Set Product as New to Date</td>
							<td><input name="to_date" class="text2 dt" id="datepicker-example7-end"></td>
						</tr>
						<tr>
							<td> Status <sup>*</sup> </td>
							<td> 
								<select id="prdt_sts" name="prdt_sts" class="text2">
									<option value="">-- Please Select --</option>
									<option value="Enabled">Enabled</option>
									<option value="Disabled">Disabled</option>
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
								<select class="text2" id="country2" name ="country2"></select>
								 <script language="javascript">
									populateCountries("country2");
								 </script>
							</td>
						</tr>
						<tr>
							<td> Is Featured </td>
							<td> 
								<select class="text2" name="featured">
									<option value="Yes"> Yes </option>
									<option selected="selected" value="No"> No </option>
								</select>
							</td>
						</tr>
					</table>
				</div>
				<div id="tab3" class="tab-pane fade">
					<h3>Prices</h3>
					<table>
                    	<tr>
                            <td style="width:20%;"> MRP <sup>*</sup> </td>
                            <td colspan="2"> 
                                <input type="text" name="mrp" id="mrp" class="text">
                                <label>[INR]</label>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;"> Selling Price </td>
                            <td colspan="2"> 
                                <input type="text" name="price" id="price" class="text">
                                <label>[INR]</label>
                                <!--<input type="hidden" name="product_id" value="<?php// echo $product_id; ?>">-->
                            </td>
                        </tr>
                        <tr>
                            <td style="width:20%;"> Special Price </td>
                            <td colspan="2"> 
                                <input type="text" name="special_price" id="special_price" class="text">
                                <label>[INR]</label>
                            </td>
                        </tr>
                        <tr>
                            <td>Special Price From Date</td>
                            <td><input name="spcil_price_from_date" class="text2 dt" id="datepicker-example7-start1"></td>
                        </tr>
                        <tr>
                            <td>Special Price To Date</td>
                            <td><input name="spcil_price_to_date" class="text2 dt" id="datepicker-example7-end1"></td>
                        </tr>
                        <tr style="display:none;">
                            <td> GST <sup>*</sup> </td>
                            <td width="175px"> 
                                <?php /*?><select class="text2" name="tax_cls" id="tax_cls" style="width:91%;">
                                    <option selected="selected" value="">-- Please Select --</option>
                                    <?php foreach($tax_class_result as $row){ ?>
                                    <option value="<?= $row->tax_id; ?>"><?= $row->tri_name; ?></option>
                                    <?php } ?>
                                </select><?php */?>
                                <input type="text" name="vat_cst" id="vat_cst" value="0" class="seller_input">
                            </td>
                            <td></td>
                        </tr>
                        <tr>
							<td> Weight (in gram) <sup>*</sup> </td>
							<td> <input type="text" name="weight" onFocus="removeDefaultShipping()" id="prdt_weight" class="text"> </td>
						</tr>
                        <tr style="display:none;">
                            <td> Shipping Fee <sup>*</sup></td>
                            <td>
                            	<select name="shipping_typ" id="shipping_typ" class="text" style="width:200px;" onChange="showshippingAmount(this.value)">
                                	<option value="">Choose shipping type</option>
                                    <option value="Free">Free</option>
                                    <!--<option value="Flat">Flat</option>-->
                                    <option value="Default">Default</option>
                                </select>
                               <!-- <input type="radio" name="shippingfee" value="Free"> Free &nbsp;&nbsp;
                                <input type="radio" name="shippingfee" value="Flat"> Flat &nbsp;&nbsp;
                                <input type="radio" name="shippingfee" value="Default"> Default-->
                            </td>
                            <td>
                            <!--<div id="shipping_fee_dv">Local : <input type="text" class="text dt" name="local_shipng_fee" id="local_shipng_fee">[INR] &nbsp;&nbsp;&nbsp;&nbsp; Zonal : <input type="text" class="text dt" name="zonal_shipng_fee" id="zonal_shipng_fee">[INR]&nbsp;&nbsp;&nbsp;&nbsp; National : <input type="text" class="text dt" name="national_shipng_fee" id="national_shipng_fee">[INR]</div>
                            <div id="flat_fee">Set Amount : <input type="text" class="text dt" name="flat_shipng_fee" id="flat_shipng_fee">[INR]</div>-->
                            <!--<div id="flat_fee">Set Amount : <input type="text" onBlur="CheckValue(this.value,this.id)" class="text dt" name="flat_shipng_fee" id="flat_shipng_fee">[INR]</div>-->
                            <div id="default_fee">Set Amount : <input type="text" class="text dt" onKeyUp="calculateshippingCost(this.value)" name="default_shipng_fee" id="default_shipng_fee">[INR] (per 1kg.) &nbsp;&nbsp;&nbsp;&nbsp;<span id="shpng_spn"></span></div>
                            <input type="hidden" id="hidden_shipping_fee" name="hidden_shipping_fee">
                            </td>
                        </tr>
                        <tr style="display:none;">
                            <td>Qty<sup>*</sup></td>
                            <td><input type="text" class="text" name="qty" id="qty"></td>
                        </tr>
					</table>
				</div>
				<div id="tab4" class="tab-pane fade">
                	<h3>Meta Information</h3>
					<table>
                        <tr>
                            <td style="width:20%;">Page Title</td>
                            <td><input type="text" name="meta_title" class="text"></td>
                        </tr>
                        <tr>
                            <td style="width:20%;">Meta Keywords<br/><span style="font-size:11px;">(keywords should be separated by comma)</span></td>
                            <td><textarea name="meta_keyword" class="text" rows="7"></textarea></td>
                        </tr>
                        <tr>
                            <td>Meta Description</td>
                            <td><textarea name="meta_description" class="text" rows="7"></textarea></td>
                        </tr>
					</table>
				</div>
                <div id="tab5" class="tab-pane fade">
                	<h3>Images <span id="ajxtst"></span></h3>
					<table>
                        <tr>
                            <td style="width:20%;">Upload Image<sup>*</sup></td>
                            <td class="product_image">
                            	<!--<input type="file" id="files" name="userfile[]" multiple> <br>
                                <input type="reset" class="all_buttons" value="Reset" onClick="reset_images()">-->
                                <div id="uploadfile">Upload</div>
								
								Image Guidelines for a Vertical<br>
								<ul id="condn">
									<li> Maximum images supported :- 5 </li>
									<li> Minimum images requirded :- 1 </li>
									<li> First Image is Default Image.  </li>
									<li> Maximum images size :- 1MB </li>
									<li> Minimum Image Resolution :- 500 X 500 </li>
								</ul>
                            </td>
                        </tr>
					</table>
				</div>
                <div id="tab6" class="tab-pane fade" style="display:none;">
                	<h3>Inventory</h3>
						<table>
                          <tr style="display:none;">
                              <td> Maximum Qty Allowed in Shopping Cart </td>
                              <td> 
                                  <input type="text" class="text2" name="max_qty" id="max_qty">
                                  <input id="manage_stock" class="checkbox" type="checkbox" checked="checked" />
                                  <label> Use Config Settings </label>
                              </td>
                          </tr>
                          <tr style="display:none;">
                              <td> Enable Qty Increments </td>
                              <td> 
                                  <select class="text2" name="enable_qty_increment">
                                      <option value="Yes"> Yes </option>
                                      <option selected="selected" value="No"> No </option>
                                  </select>
                              </td>
                          </tr>
                          <tr style="display:none;">
                              <td> Stock Availability </td>
                              <td> 
                                  <select class="text2" name="stock_avail">
                                      <option value="In Stock" selected="selected"> In Stock </option>
                                      <option value="Out of Stock"> Out of Stock </option>
                                  </select>
                              </td>
                          </tr>
					</table>
				</div>
               <!-- <div id="tab7" class="tab-pane fade">
                	
						
				</div>-->
                <div id="tab8" class="tab-pane fade">
                	<h3>Related Products</h3>
                    <div class="row content-header">
						<!--<div class="col-md-8"><b>New Product (Default)</b></div>
						<div class="col-md-4 show_report">
							<button type="button" class="all_buttons">Save and Continue Edit</button>
							<button type="button" class="all_buttons">Save</button>
							<button type="button" class="all_buttons">Reset</button>
							<button type="button" class="all_buttons">Back</button>
						</div>-->
					</div>
                    <div class="row">
						<!--<div class="col-md-8">
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
							per page <span class="separator">|</span> Total 11 records found
						</div>-->
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
							<!--<th width="5%">Type</th>-->
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
							<!--<td>
								<select>
									<option value=""></option>
									<option value=""> Simple Product </option>
									<option value=""> Grouped Product </option>
									<option value=""> Configurable Product </option>
									<option value=""> Virtual Product </option>
									<option value=""> Bundle Product </option>
									<option value=""> Downloadable Product </option>
								</select>
							</td>-->
							<td>
								<select>
									<?php foreach($result_attr_group as $row){ ?>
										<option value="<?= $row->attribute_group_id; ?>"><?= $row->attribute_group_name; ?></option>
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
						  $row = $result_product->num_rows();
						  if($row > 0){
							  foreach($result_product->result() as $rows){
						?>
                        <tr>
                            <td style="text-align:center"><input type="checkbox" name="chk_product[]" id="chk_product" value="<?=$rows->product_id ; ?>"></td>
                            <td><?= $rows->product_id; ?></td>
                            <td><?= $rows->name; ?></td>
                           <!-- <td><?//= $rows->product_type; ?></td>-->
                            <td><?= $rows->attribute_group_name; ?></td>
                            <td><?= $rows->status; ?></td>
                            <td><?= $rows->sku; ?></td>
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
</style>

<!--<script src="<?//php echo base_url(); ?>js/myscript.js" type="text/javascript"></script>-->

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

<script>
function ValidProduct_form(){
	var product_attr_set = $('#attribute_set').val();
	var category = $('#auto_category_name').val();
	var name = $('#prdt_name').val();
	var description = $('#prdt_desc').val();
	var short_description = $('#prdt_short_desc').val();
	//var sku = $('#prdt_sku').val();
	var weight = $('#prdt_weight').val();
	var shipping_typ = $('#shipping_typ').val();
	var default_shipng_fee = $('#default_shipng_fee').val();
	var sts = $('#prdt_sts').val();
	//var shipping_fee_type = $('input[name=shippingfee]:checked').val();
	var mrp = $('#mrp').val();
	var price = $('#price').val();
	var special_price = $('#special_price').val();
	var spcil_price_from_date = $('#datepicker-example7-start1').val();
	var spcil_price_to_date = $('#datepicker-example7-end1').val();
	//var tax_class = $('#tax_cls').val();
	//var local_shiping_fee = $('#local_shipng_fee').val();
	//var zonal_shiping_fee = $('#zonal_shipng_fee').val();
	//var national_shiping_fee = $('#national_shipng_fee').val();
	//var photo = $('#files').val();
	var photo = $('.ajax-file-upload-container').text();
	//var photo_count = $("img#uploadImgID").length;
	var quantity = $('#qty').val();
	
	
	////start script for getting shipping fee value /////
	/*if($("input[name='shippingfee']").is(':checked')) {
   		var shipping_fee_type = $('input[name="shippingfee"]:checked').val(); 	
	}else{
		var shipping_fee_type = '';
	}
	
	var flat_shipping_fee = $('#flat_shipng_fee').val();*/
	////start script for getting shipping fee value /////
	
	///////category validation start////////
	/*var subcategoryid = document.getElementsByName("subcategory_id");
	var subcategoryid_count = subcategoryid.length;
	
	var count = 0;
	for (var i=0; i<subcategoryid_count; i++) {
		if(subcategoryid[i].checked === true) {
			count++;
		}
	}*/
	///////category validation end////////
	
	if(product_attr_set == ''){
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Product attribute is required.');		
		$('#attribute_set').css('border-color','red');
		
		$('.form_view').find('#tab1').addClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').addClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		return false;
	}else if(category == ''){
		$('.form_view').find('#tab1').addClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').addClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
		$('#tax_cls').css('border-color','#ccc');
		$('#files').css('border','none');
		$('#qty').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Category is required.');
		return false;
	}else if(name == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').addClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').addClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Name field is required.');
		$('#prdt_name').css('border-color','red');
		$('#prdt_name').focus();
		return false;
	}else if(description == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').addClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').addClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Description field is required.');
		$('#prdt_desc').css('border-color','red');
		$('#prdt_desc').focus();
		return false;
	}else if(short_description == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').addClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').addClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Short description field is required.');
		$('#prdt_short_desc').css('border-color','red');
		$('#prdt_short_desc').focus();
		return false;
	}/*else if(sku == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').addClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').addClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('SKU field is required.');
		$('#prdt_sku').css('border-color','red');
		$('#prdt_sku').focus();
		return false;
	}*/else if(sts == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').addClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').addClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Status field is required.');
		$('#prdt_sts').css('border-color','red');
		return false;
	}else if(mrp == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('MRP field is required.');
		$('#mrp').focus();
		$('#mrp').css('border-color','red');
		return false;
	}else if(isNaN(mrp)){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Invalid MRP amount.');
		$('#mrp').select();
		$('#mrp').css('border-color','red');
		return false;
	}/*else if(price == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#mrp').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Price field is required.');
		$('#price').focus();
		$('#price').css('border-color','red');
		return false;
	}*/else if(isNaN(price)){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#mrp').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Invalid price amount.');
		$('#price').select();
		$('#price').css('border-color','red');
		return false;
	}else if(isNaN(special_price)){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#mrp').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
		
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Invalid special price amount.');
		$('#special_price').select();
		$('#special_price').css('border-color','red');
		return false;
	}else if(parseFloat(special_price) > parseFloat(mrp)){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#mrp').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
		
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Special price should be less than MRP.');
		$('#special_price').select();
		$('#special_price').css('border-color','red');
		return false;
	}else if(special_price != "" && spcil_price_from_date == ""){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#mrp').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
		$('#special_price').css('border-color','#ccc');
		
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Special price from date is requirded.');
		$('#datepicker-example7-start1').css('border-color','red');
		return false;
	}else if(special_price != "" && spcil_price_to_date == ""){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#mrp').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
		$('#special_price').css('border-color','#ccc');
		
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Special price to date is requirded.');
		$('#datepicker-example7-end1').css('border-color','red');
		return false;
	}/*else if(tax_class == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
		$('#special_price').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Tax class field is required.');
		$('#tax_cls').css('border-color','red');
		return false;
	}*/else if(weight == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#tax_cls').css('border-color','#ccc');
		$('#special_price').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Weight field is required.');
		$('#prdt_weight').css('border-color','red');
		$('#prdt_weight').focus();
		return false;
	}else if(isNaN(weight)){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#tax_cls').css('border-color','#ccc');
		$('#special_price').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Invalid weight amount.');
		$('#prdt_weight').css('border-color','red');
		$('#prdt_weight').select();
		return false;
	}/*else if(shipping_typ == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#tax_cls').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#special_price').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Shipping type is required.');
		$('#shipping_typ').css('border-color','red');
		$('#shipping_typ').focus();
		return false;
	}else if(shipping_typ == 'Default' && default_shipng_fee == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#tax_cls').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#shipping_typ').css('border-color','#ccc');
		$('#special_price').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Shipping fee is required.');
		$('#default_shipng_fee').css('border-color','red');
		$('#default_shipng_fee').focus();
		return false;
	}else if(shipping_typ == 'Default' && isNaN(default_shipng_fee)){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#tax_cls').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#shipping_typ').css('border-color','#ccc');
		$('#special_price').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Invalid shipping amount.');
		$('#default_shipng_fee').css('border-color','red');
		$('#default_shipng_fee').select();
		return false;
	}else if(shipping_typ == 'Default' && default_shipng_fee > 60){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#tax_cls').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#shipping_typ').css('border-color','#ccc');
		$('#special_price').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Minimum shipping amount should be Rs. 60');
		$('#default_shipng_fee').css('border-color','red');
		$('#default_shipng_fee').select();
		return false;
	}else if(quantity == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').addClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').removeClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').addClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').removeClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
		$('#special_price').css('border-color','#ccc');
		$('#tax_cls').css('border-color','#ccc');
		$('#files').css('border','none');
		$('#default_shipng_fee').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Quantity field is required.');
		$('#qty').focus();
		$('#qty').css('border-color','red');
		return false;
	}*/else if(photo == ''){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').addClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').addClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
		$('#special_price').css('border-color','#ccc');
		$('#tax_cls').css('border-color','#ccc');
		$('#default_shipng_fee').css('border-color','#ccc');
		$('#qty').css('border-color','#ccc');
				
		$('.valid_msg_dv').show();
		$('.valid_msg_dv').text('Product image is required.');
		$('#files').css('border','1px solid red');
		return false;
	}/*else if(photo_count < 1 || photo_count > 5){
		$('.form_view').find('#tab1').removeClass('in active');
		$('.form_view').find('#tab2').removeClass('in active');
		$('.form_view').find('#tab3').removeClass('in active');
		$('.form_view').find('#tab4').removeClass('in active');
		$('.form_view').find('#tab5').addClass('in active');
		$('.form_view').find('#tab6').removeClass('in active');
		$('.form_view').find('#tab7').removeClass('in active');
		$('.form_view').find('#tab8').removeClass('in active');
		
		$('.tabs-horiz').find('#li_tab1').removeClass('active');
		$('.tabs-horiz').find('#li_tab2').removeClass('active');
		$('.tabs-horiz').find('#li_tab3').removeClass('active');
		$('.tabs-horiz').find('#li_tab4').removeClass('active');
		$('.tabs-horiz').find('#li_tab5').addClass('active');
		$('.tabs-horiz').find('#li_tab6').removeClass('active');
		$('.tabs-horiz').find('#li_tab7').removeClass('active');
		$('.tabs-horiz').find('#li_tab8').removeClass('active');
		
		$('#attribute_set').css('border-color','#ccc');
		$('#prdt_name').css('border-color','#ccc');
		$('#prdt_desc').css('border-color','#ccc');
		$('#prdt_short_desc').css('border-color','#ccc');
		$('#prdt_sku').css('border-color','#ccc');
		$('#prdt_weight').css('border-color','#ccc');
		$('#prdt_sts').css('border-color','#ccc');
		$('#prdt_visibility').css('border-color','#ccc');
		$('#price').css('border-color','#ccc');
		$('#special_price').css('border-color','#ccc');
		$('#tax_cls').css('border-color','#ccc');
		$('#default_shipng_fee').css('border-color','#ccc');

		$("#files").val('');
		$("img#uploadImgID").remove();
		$('.valid_msg_dv').show().text('Please Upload required no of Images.');
		$('#files').css('border','1px solid red');
		return false;
	}*/
}
</script>

<script>
$(document).ready(function(){
    $(":radio[name='subcategory_id']").attr('disabled','disabled');
});

</script>

<!--<script>
	$(document).ready(function(){
		// Multiple Image uploading
		if(window.File && window.FileList && window.FileReader){
			var _URL = window.URL || window.webkitURL;
			$("#files").on("change",function(e){
				var files = e.target.files ,
				filesLength = files.length ; //alert(filesLength); return false;
				if(filesLength < 1){
					$('#files').val('');
					alert("Please Upload atleast One Images.");
					return false;
				}else if(filesLength > 5){
					$('#files').val('');
					alert("Please Upload maximun 5 Images.");
					return false;
				}else{
					for (var i = 0; i < filesLength ; i++){
						// Size Validation
						var imgpath=document.getElementById('files');
						//alert(imgpath);return false;
						if (!imgpath.value == ""){ 
							var img_name = imgpath.files[i].name;
							var img = imgpath.files[i].size;
							var imgsize = Math.floor(img/1024);
							
							if ((file = this.files[i])){
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
								fileReader.onload = (function(e){
									var file = e.target;
									$("<img></img>",{
										class : "imageThumb",
										id : "uploadImgID",
										src : e.target.result,
										title : file.name
									}).insertAfter("#files");
								});
								fileReader.readAsDataURL(f);
								
							//image uploading script start for temp_img table//
							$.ajax({
								url:'<?php// echo base_url();?>/admin/catalog/upload_tmp_product_img',
								method:'post',
								data:{seller_id:0,imag:file.name},
								success:function(result){
									$('#ajxtst').html(result);
								}
								
								/*var formData = new FormData($('#uploadForm')[0]);
								$.ajax({
									url: "<?php// echo base_url();?>/admin/catalog/upload_tmp_product_img",
									type: "POST",
									dataType: 'text',
									contentType: false,
									processData: false,
									cache: false,
									data: formData,
									success: function(response) {
										alert("success");
									},
									error: function() {
										alert("unable to create the record");
									}
								
								});*/
							
							//image uploading script end of temp_img table//
							
							}
						}
						// End
					}
				}
			});
		} else { alert("Your browser doesn't support to File API") }
	});	
</script>-->


<!---Image uploading Script Start here --->
<script src="<?php echo base_url();?>js/img_uplod_script/jquery.uploadfile1.min.js"></script>

<script>
$(document).ready(function()
{
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

maxFileCount:5,
//maxFileSize:100*1024,
maxFileSize:100*500,
//minFileSize:500*500,

deleteCallback: function (data, pd) {
    for (var i = 0; i < data.length; i++) {
        $.post("<?php echo base_url();?>admin/catalog/delete_product_tmp_image", {op: "delete",name: data[i]},
            function (resp,textStatus, jqXHR) {
                //Show Message
				//alert(name);
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
<!--<script>
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
			  url:'<?php// echo base_url(); ?>admin/catalog/checksku',
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
--><!---script start for Checking for unique SKU--->

<script>
///show attr heading script start here///
function ShowAttrHeadings(){
	var attr_group_id = $('#attribute_set').val();
	if(attr_group_id == ''){
		alert('Please select the attribute set.');
		return false;
	}else{
		//$('#go_btn').attr('disabled', true);
		//$('#go_btn').css('cursor','no-drop');
		//$('#go_btn').val('wait..');
		$('#attr_flds_td').hide();
		$('#attr_lodr').show();		
		
		$.ajax({
			url:'<?php echo base_url(); ?>admin/attribute/show_attr_headings',
			method:'post',
			data:{group_id:attr_group_id},
			success:function(result){
				$('#attr_flds_td').fadeIn();
				$('#attr_flds_td').html(result);
				/*$('#go_btn').attr('disabled', false);
				$('#go_btn').css('cursor','pointer');
				$('#go_btn').val('Go');*/
				$('#attr_lodr').hide();
				$('#attr_flds_td').show();
			}
		});
	}
}
///show attr heading script end here///

///show attr field script start here///
/*function showAttrFields(attr_heading_id){
	alert(attr_heading_id);return false;
	$.ajax({
		url:'<?php// echo base_url();?>admin/attribute/show_attr_fields',
		method:'post',
		data:{heading_id:attr_heading_id},
		success:function(result){
			
		}
	});
}
*////show attr field script end here///

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
	var shipping_fee_4_1kg = $('#default_shipng_fee').val();
	/*if(product_weight_in_kg < 1){
		var product_weight = 1;
	}else{
		var product_weight = product_weight_in_kg;
	}*/
	var product_shipping_fee = Math.ceil(product_weight_in_kg*amount);
	if(shipping_fee_4_1kg > 60){
		alert('Maximum shipping amount Rs.60 for 1kg.');
		$('#default_shipng_fee').val('');
		return false;
	}else{
		var shipping_amt = product_shipping_fee;
	}
	
	$('#shpng_spn').text('Shipping fee : Rs.'+ shipping_amt);
	$('#hidden_shipping_fee').val(shipping_amt);
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

<script src="<?php echo base_url();?>js/chosen.jquery.js"></script>
<script>
$(function() {
	$('.chosen-select').chosen();
	$('.chosen-select-deselect').chosen({ allow_single_deselect: true });
});


$(function() {
	$('.chosen-select_attr').chosen();
	$('.chosen-select-deselect').chosen({ allow_single_deselect: true });
});
</script>

	</body>
</html>