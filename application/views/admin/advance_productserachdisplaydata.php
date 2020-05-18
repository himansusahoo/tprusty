<?php
require_once('header.php');
?>
<style>
.wrapper {
  position: relative; margin:0px; float:none; width:100%;
  cursor: default;
  -webkit-transform: translateZ(0); /* webkit flicker fix */
  -webkit-font-smoothing: antialiased; /* webkit text rendering fix */
  z-index:999999 !important;
}
.wrapper .tooltip {
  background: #1496bb;
  bottom: 0;
  color: #fff;
  display: block;
  left: 30px;
  margin-bottom: 0px;
  opacity: 0;
  padding: 10px;
  pointer-events: none;
  position: absolute;
  width: 300px;  text-align: center;
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
		   
		   text-align:left;
}

/* This bridges the gap so you can mouse into the tooltip without it disappearing */
.wrapper .tooltip:before {
  bottom: -20px;
  content: " ";
  display: block;
  height: 20px;
  left: 0;
  position: absolute;
  width: 100%;
}

/* CSS Triangles - see Trevor's post */
.wrapper .tooltip:after {
  border-left: solid transparent 10px;
  border-right: solid #1496bb 10px;
  border-top: solid transparent 10px;
  border-bottom: solid transparent 10px;
  bottom: 7px;
  content: " ";
  height: 0;
  left: -7px;
  margin-left: -13px;
  position: absolute;
  width: 0;
}
  
.wrapper:hover .tooltip {
  opacity: 1;
  pointer-events: auto;
  -webkit-transform: translateY(0px);
     -moz-transform: translateY(0px);
      -ms-transform: translateY(0px);
       -o-transform: translateY(0px);
          transform: translateY(0px);
}

/* IE can just show/hide with no transition */
.lte8 .wrapper .tooltip {
  display: none;
}

.lte8 .wrapper:hover .tooltip {
  display: block;
 
}
.fa-question-circle {
  font-size: 15px;
}
/*.wrapper{left:5px; top:5px; position:relative;}*/

</style>

<script>
$(document).ready(function(){
	$('#check_all').click(function(){
		$('input:checkbox').prop('checked', this.checked);
	});
});
</script>

<script>


function select_tblrow(tblrowsl)
{
		
		if(document.getElementById('chk_product'+tblrowsl).checked== true)
		{
			$("#tblrow"+tblrowsl).css("background-color", "LightGoldenRodYellow ");
			//document.getElementById('prodskuid_chk'+sl).checked='checked';
			
			
		}
		else if(document.getElementById('chk_product'+tblrowsl).checked== false)
		{
			
			$("#tblrow"+tblrowsl).css("background-color", "");
			//document.getElementById('prodskuid_chk'+sl).checked='';
			
		}		  
	
}
function valid_exporttoexcel()
{
	 $("#show_productserror").hide();
	//var prodid = $('input[name="prodid_chk"]:checked').map(function(_, el){
//        	return $(el).val();
//    	}).get();
	
	var productsku = document.getElementsByName("chk_product[]");
	 
		var productsku_count = productsku.length; 
		var count = 0;
		for (var i=0; i<productsku_count; i++) {
			if (productsku[i].checked === true) 
			{
				count++;
			}
		}
	if(count==0){
	 $("#show_productserror").text('! Please Select Atleast One Product');
	 $("#show_productserror").show();
	 return false;	
	}
	
	
		
}


</script>

			<div id="content">
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_config.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
					<div class="row content-header">
					<div class="col-md-8"> <h3>Advace Search Product Result:</h3> 
                    <!--<button id="product_submit" class="seller_buttons" onclick="window.location.href='<?php //echo base_url().'admin/catalog/export_toexcel'?>'" > 
           <i class="fa fa-file-excel-o" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Export To Excel All Products 
           </button>--> 
           </div>
					<div class="col-md-4 show_report">
                    <!--<button type="button" class="all_buttons" onClick="window.location.href='<?php //echo base_url().'admin/catalog/addnew_product' ?>'">Add Product</button>-->
                     </div>
                     
                     <button type="button" class="seller_buttons" style="float:right"  onClick="window.location.href='<?php echo base_url().'admin/Advance_search/exporttoexcel_product/'?>'" >                                                    
           						<i class="fa fa-file-excel-o" aria-hidden="true" style="color:#FFF;"></i> 
                                &nbsp;Export To Excel Without Attribute
           					</button>
                            <div class="clearfix"></div>
                            
                            <?php /*?> <button type="submit" class="seller_buttons" style="float:right"  onClick="window.location.href='<?php echo base_url().'admin/Advance_search/exporttoexcel_productwithattribute/'?>'" >                                                    
           						<i class="fa fa-file-excel-o" aria-hidden="true" style="color:#FFF;"></i> 
                                &nbsp;Export To Excel With Attribute
           					</button><?php */?>
                     <?php if(@$this->session->userdata('sess_attrbgrouids_string')!='' 
					 && $this->session->userdata('sess_attrbvalueasqlis_string')==''					 
					 && $this->session->userdata('sess_pricefromto_string')==''
					 && $this->session->userdata('sess_discountfromto_string')==''
					 && $this->session->userdata('sess_sellerratingfromto_string')==''
					 && $this->session->userdata('sess_buyerfromto_string')==''
					  ) {?>
                     <a href="#" class="seller_buttons" onclick="window.open('<?php echo base_url().'admin/Advance_search/exporttoexcel_productwithattribute' ?>','DetailPanel','width=500,height=350,menubar=no,status=no,scrollbars=yes')" style="float:right">
						<i class="fa fa-file-excel-o" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Export To Excel With Attribute 
                         </a>
                    <?php } ?>
					</div>
                   <!-- <div class="col-md-6 left" >	
                        <table>
                            <tr>
                                <td>Actions</td>
                                <td>
                                   
                                </td>
                                <td><input type="button" name="admin_product_action_btn" id="admin_product_action_btn" class="all_buttons" value="Submit"></td>
                            </tr>
                        </table>
					</div>-->
					
                     <div  class="col-md-6 left">
                     
                     <div id="show_productserror" align="center" style="color:#F00; font-weight:bold; display:none;" > </div> 
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
								
									
							<!--<div class="right">
								
                                <input type="submit" class="all_buttons" value="Search" id="search"   />
							<input type="reset" class="all_buttons" value="Reset Filter" />
							</div>-->
							
								</td>
							</tr>
						</table>
					</div>	
					<div class="clearfix"></div>
					
					<div class="clearfix"></div>
					<!--<div style="overflow:scroll; width:1243px; height:1500px; ">-->
                    <div>
                     	
                        
                        Total Product Search Result : <?=$prod_count.' nos.'?></br>
                         <div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
                        <?php
						 
						$from_arr=array('onSubmit'=>'return valid_exporttoexcel()');
						echo form_open('admin/Advance_search/exporttoexcel_asselectedrow',$from_arr); 
						
						?>
                        <button type="submit" class="seller_buttons" style="float:left" >
                        <i class="fa fa-file-excel-o" aria-hidden="true" style="color:#FFF;"></i> 
                                &nbsp;Export To Excel Selected Product
           					</button>
                            <div class="clearfix"></div>
                            <div id="exlshow_error2" style="color:#F00; font-weight:bold; display:none;" align="center" ></div>
							<table class="table table-bordered table-hover" >
                        
							<tr class="table_th" style="background-color:#0CC;">
                            	<th width="3%"><input type="checkbox" id="check_all" name="check_all"></th>
								<th width="3%">Product ID</th>
								<th width="20%">SKU</th>
								<th width="30%">Name</th>
                                <th width="30%">Category</th>
                                <th width="5%">Attribute</th>
								<th width="15%">Description</th>
                                <th width="15%">Seller</th>
								<th width="5%">MRP</th>
                                <th width="5%">Selling Price</th>
                                <th width="5%">Special Price</th>
                                <th width="10%">Special Price From Date</th>
                                <th width="10%">Special Price To Date</th>
                                <th width="3%">Quantity</th>
                                <th width="3%">VAT / CST</th>
                                <th width="3%">Weight(in grams)</th>
                                <th width="10%">Image URL1</th>
                                <th width="10%">Image URL2</th>
                                <th width="10%">Image URL3</th>
                                <th width="10%">Image URL4</th>
                                <th width="10%">Image URL5</th>
                                <th width="3%">Shipping Fee Type(Free/Default)</th>
                                <th width="3%">Shipping Fee Amount</th>
                                <th width="3%">Product Approve Status</th>
                                <th width="3%">Status(Enabled/Disabled)</th>
                                <th width="10%">product highlights-1</th>
                                <th width="10%">product highlights-2</th>
                                <th width="10%">product highlights-3</th>
                                <th width="10%">product highlights-4</th>
                                <th width="10%">product highlights-5</th>
                                <th width="3%">Country of Manufacture</th>
                                <th width="10%">Meta Title</th>
                                <th width="30%">Meta Keywords</th>
                                <th width="30%">Meta Description</th>
								<th width="5%">Action</th>
							</tr>
							
                            <?php
								
								$skucheck_arr=array();
								
								if($product_info != false){
									$slno=1;
									foreach($product_info->result_array() as $rows){
									
									if(!in_array($rows['sku'],$skucheck_arr))
									{	
										$description='';
										$quantity='';
										$vatorcst='';
										$weight='';
										$imag='';
										$shipping_feetype='';
										$shipping_fee_amount='';
										$status='';
										$short_desc='';
										$manufacture_country='';
										$meta_title='';
										$meta_keywords='';
										$meta_desc='';
										
										$imageurl=array();
										
										$Prod_highlight=array();					
										
										
										$prod_sku=$rows['sku'];
										$prodid_check=$rows['product_id'];
										$qr_prodcheck=$this->db->query("SELECT sku FROM product_master WHERE sku='$prod_sku' ");
										
										if($qr_prodcheck->num_rows()>0)
										{
											$qr_prodinfo=$this->db->query("SELECT b.description as descrp				                                                                            ,a.quantity as qnt ,a.tax_amount as vatorcst,b.weight as wgth                                                                            ,c.imag as img,a.shipping_fee as shipfeetype,
																			a.shipping_fee_amount as shipfee_amt,a.status as                                                                            enableordisable,b.short_desc as shortdescrp,a.manufacture_country as manfg,
																			d.meta_title as metatile ,d.meta_keywords as metakywrd,d.meta_desc as meta_descrp
																			,f.*,h.attribute_group_name
																			FROM product_master a 
																			INNER JOIN product_general_info b ON a.product_id=b.product_id
																			INNER JOIN product_image c ON c.product_id=a.product_id
																			INNER JOIN product_meta_info d ON d.product_id=a.product_id
																			INNER JOIN product_category e ON e.product_id=a.product_id
																			INNER JOIN temp_category f ON f.lvl2=e.category_id
																			INNER JOIN product_setting g ON g.product_id=a.product_id
																			INNER JOIN attribute_group h ON h.attribute_group_id=g.attribut_set
																			WHERE a.sku='$prod_sku' GROUP BY a.sku ");
											
												
										}
										else
										{
										$qr_prodinfo=$this->db->query("SELECT a.description as descrp,b.quantity as qnt                                                                        ,c.tax_amount as vatorcst,a.weight as wgth,d.image as img,c.shipping_fee as  				                                                                         shipfeetype,c.shipping_fee_amount as shipfee_amt,a.status as                                                                         enableordisable,a.short_desc as shortdescrp ,
										                                  a.manufacture_country as manfg,e.meta_title as metatile ,
																	      e.meta_keyword as metakywrd,e.meta_description as meta_descrp,
																		  g.*,i.attribute_group_name
																	    FROM seller_product_general_info a
																	    INNER JOIN seller_product_inventory_info b ON b.seller_product_id=a.seller_product_id
																	    INNER JOIN seller_product_price_info c ON c.seller_product_id=a.seller_product_id
																	    INNER JOIN seller_product_image d ON d.seller_product_id=a.seller_product_id
																	    INNER JOIN seller_product_meta_info e ON e.seller_product_id=a.seller_product_id
																		
																		INNER JOIN seller_product_category f ON f.seller_product_id=a.seller_product_id
																		INNER JOIN temp_category g ON g.lvl2=f.category
																		INNER JOIN seller_product_setting h ON h.seller_product_id=a.seller_product_id
																		INNER JOIN attribute_group i ON i.attribute_group_id=h.attribute_set
																			
																	    WHERE a.sku='$prod_sku'GROUP BY a.sku
																	");	
										}
										
										if($qr_prodinfo->num_rows()>0)
										{
											
											$description=$qr_prodinfo->row()->descrp;
											$quantity=$qr_prodinfo->row()->qnt;
											$vatorcst=$qr_prodinfo->row()->vatorcst;
											$weight=$qr_prodinfo->row()->wgth;
											$imag=$qr_prodinfo->row()->img;
											$shipping_feetype=$qr_prodinfo->row()->shipfeetype;
											$shipping_fee_amount=$qr_prodinfo->row()->shipfee_amt;
											$status=$qr_prodinfo->row()->enableordisable;
											$short_desc=$qr_prodinfo->row()->shortdescrp;
											$manufacture_country=$qr_prodinfo->row()->manfg;
											$meta_title=$qr_prodinfo->row()->metatile;
											$meta_keywords=$qr_prodinfo->row()->metakywrd;
											$meta_desc=$qr_prodinfo->row()->meta_descrp;
											
											$ctag_name=$qr_prodinfo->row()->lvlmain_name.'>>'.$qr_prodinfo->row()->lvl1_name.'>>'.$qr_prodinfo->row()->lvl2_name;
											$attribute_gropunm=$qr_prodinfo->row()->attribute_group_name;
											
											$img_arr=explode(',',$imag);
											
											
											//$shortdescrp_unserlz=unserialize($short_desc);
											$shortdescrp_arr=unserialize($short_desc); 
											
											if(count($img_arr)>0)
											{	foreach($img_arr as $ky=>$val)
												{
													$imageurl[]=base_url().'images/product_img/'.$val;	
												}
											}
											
											if(count($shortdescrp_arr)>0)
											{
												foreach($shortdescrp_arr as $ky=>$val)
												{
													$shortdescrp_arr[]=$val;	
												}
											}
												
										}
										
									
									
									
							?>
                            
                            <tr id=tblrow<?=$slno?>>
                            	<td style="text-align:center">
                                <input type="checkbox" name="chk_product[]" id="chk_product<?=$slno?>" value="<?=$rows['sku'] ; ?>" 
                                onclick="select_tblrow('<?=$slno?>')">
                                </td>
                                <td><?=$rows['product_id'] ; ?></td>
                                <td><?=$rows['sku'] ; ?></td>
                            	<td> 
                                <span style="float:left;">
                                 <?php 
								 $filePath=base_url().'images/product_img/'.$rows['imag'];
								 if(empty($rows['imag'])){?>
    							<img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" class="list_img" >
    							<?php }else{?>
                                <img  class="list_img" src="<?php echo base_url().'images/product_img/'.$rows['imag']; ?>" ></span>
                                <?php } ?>
                                <?=$rows['name']; ?>
                                </td>
                                <td>
                                <?=@$ctag_name?>
                                </td>
                                <td>
                                <?=@$attribute_gropunm?>
                                </td>
                                <td>
                                 <?php if($description!='') {  ?>  
                                <div class="wrapper"><?=substr($description,0,25).'....'; ?><div class="tooltip"><?=$description?></div></div>
                                <?php } ?>
                                </td>
                                <td> <?php echo $rows['business_name']; ?> </td>                                
                                <td> <?php echo  $rows['mrp']; ?></td>
                                <td> <?php echo  $rows['price']; ?></td>
                               <td> <?php  echo  $rows['special_price']; ?></td>
                               <td> <?php  echo  $rows['special_pric_from_dt']; ?></td>
                               <td> <?php  echo  $rows['special_pric_to_dt']; ?></td>
                               
                                <td> <?=$quantity;?></td>
                               <td> <?=$vatorcst;?></td>
                               <td> <?=$weight;?></td>
                               <td><?php if(array_key_exists("0",$imageurl)){ echo @$imageurl[0];}?></td>
                               <td><?php if(array_key_exists("1",$imageurl)){ echo @$imageurl[1];}?></td>
                               <td><?php if(array_key_exists("2",$imageurl)){ echo @$imageurl[2];}?></td>
                               <td><?php if(array_key_exists("3",$imageurl)){ echo @$imageurl[3];}?></td>
                               <td><?php if(array_key_exists("4",$imageurl)){ echo @$imageurl[4];}?></td>
                               <td> <?php if($shipping_fee_amount==0){echo "Free";}else {echo "Default";}  ?></td>
                               <td> <?=$shipping_fee_amount?></td>
                               <td> <?php  echo  $rows['prod_status']; ?></td>
                               <td> <?=$status;?></td>
                               <td><?php if(array_key_exists("0",$shortdescrp_arr)){ echo @$shortdescrp_arr[0];}?></td>
                               <td><?php if(array_key_exists("1",$shortdescrp_arr)){ echo @$shortdescrp_arr[1];}?></td> 
                               <td><?php if(array_key_exists("2",$shortdescrp_arr)){ echo @$shortdescrp_arr[2];}?></td>                                
                               <td><?php if(array_key_exists("3",$shortdescrp_arr)){ echo @$shortdescrp_arr[3];}?></td>
                               <td><?php if(array_key_exists("4",$shortdescrp_arr)){ echo @$shortdescrp_arr[4];}?></td>
                               <td> <?=$manufacture_country;?></td>                               
                               
                               <td>
                                <?php if($meta_title!='') {  ?>                              
                               <div class="wrapper"><?=substr($meta_title,0,25).'....'; ?><div class="tooltip"><?=$meta_title?></div></div>
                              <?php } ?>
                               </td>
                               
                               <td>
                                <?php if($meta_keywords!='') {  ?>
                               <div class="wrapper"><?=substr($meta_keywords,0,25).'....'; ?><div class="tooltip"><?=$meta_keywords?></div></div>
                               <?php } ?>
                               </td>
                               <td>
                               <?php if($meta_desc!='') {  ?>                            
                               <div class="wrapper"><?=substr($meta_desc,0,25).'....'; ?><div class="tooltip"><?=$meta_desc?></div></div>
                               <?php } ?>
                               </td>
                               
                                
                               <td>
                               <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rows['name'])))).'/'.$rows['product_id'].'/'.$rows['sku']  ?>" target="_blank" tilte="View Product" ><i class="fa fa-eye" aria-hidden="true" style="color:#F93; font-size:18px;"></i>
</a></td>
                             
                            </tr>
                            <?php 
									$skucheck_arr[]=$rows['sku']; 
									$slno++;
									}
								
								}
							}else{
							?>
							<tr><td  colspan="32">No records found ! </td></tr>
                            <?php } ?>
                            
						</table>
                        <?php echo form_close(); ?>
                         <div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
					</div>
                 
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