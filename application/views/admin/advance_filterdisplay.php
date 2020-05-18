<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	require_once('header.php');
?>

<div id="content">
		<div class="top-bar">
			<div class="top-left">
				<?php include 'sub_config.php';?>
			</div>
			<div class="top-right">
				<?php include 'top_right.php';?>
			</div>
		</div>
        
        <!--- Zebra_Datepicker link start here ---->
<!--<script src="<?php //echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
<script src="<?php //echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php //echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">-->

<script src="<?php echo base_url();?>js/chosen.jquery.js"></script>
<script>
  $(function() {
	$('.chosen-select').chosen();
	$('.chosen-select-deselect').chosen({ allow_single_deselect: true });
	
  });
</script>

<link href="<?php echo base_url(); ?>js/datetime/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/1.0.0/js/bootstrap-datetimepicker.min.js"></script>


<style>
#non,#slr_nm_dv{ display:none;}
#slr_nm_dv{position: absolute; z-index: 1000; background-color:seashell; width: 21%; border: 1px solid tan;  border-radius: 3px;}
#slr_nm_dv ul {margin-bottom:0px !important;}
#slr_nm_dv li { cursor: pointer;  list-style: outside none none;padding: 5px 5px 5px 10px;}
#slr_nm_dv li:hover{background-color:tan;}
</style>

 <?php 
 	   
	   include 'advance_search/advance_searchpaneljsfile.php'; 
 	   include 'advance_search/advancesearchaddtolistjs.php'; 
 		
 ?>   
       
  <div class="main-content" style="padding:40px 10px; margin-top:45px;">   
 <div class="row content-header" style="background-color:#CCC;">
				<h3 style="margin-top:0px; font-weight:bold;"><span style="color:#F00">Advance Product Search</span></h3>
                
                <?php /*?><input type="button" value="Reset All" name="advsrch_reset" id="advsrch_reset" onclick="window.location.href='<?php echo base_url().'admin/super_admin/advance_productsearch'; ?>'" style="float:right; width:100px; font-weight:bold;" /><?php */?>
   
   <button type="button" class="seller_buttons" style="float:right" onclick="window.location.href='<?php echo base_url().'admin/super_admin/advance_productsearch'; ?>'"  >                                                    
           						<i class="fa fa-refresh" aria-hidden="true"></i>
 
                                &nbsp;Reset All 
           					</button>
           
</div>
		<!-------------------------------------------Listing start--------------------------------------------------------------------->
        
        <div id="slr_catgdiv">
                <table>
                <tr>
                <td>
                              
                              <div class="form_view" style="min-height:255px; min-width:1230px;">
                                <p style="background-color:#3C0" class="t-head">Choose Seller / Category with Attribute</p>
                              <table>
                              <tr>
                              <td align="left"> </td>
                              <td><select name="slr_ctagattrb" id="slr_ctagattrb" class="seller_input" onchange="disp_catgattrb(this.value)" style="width:100px;" >
                                                    <option value='' selected="selected">---select---</option>
                                                    <option value="seller_op">Seller</option>
                                                    <option value="category_op">Category</option>                                
                                                </select></td>
                                                  
                              <td >
                              
                              <input type="text" name="slrsreach_name" id="slrsreach_name" class="seller_input" placeholder="Enter Seller Name" style=" display:none; float:left "><input type="button" id="retirve_catg" name="retirve_catg" onclick="populetslr_catgattrb()" value="Go" style="display:none;" >
                             
                            <div id="slr_nm_dv"><ul></ul></div>                      
                              
                              </td>
                             
                              
                              <td> 
                               <div id="process_div_catg" style="display:none; color:#090;"> <img src="<?php echo base_url().'images/progress.gif' ?>" />Loading Categories...</div>
                              <div id="category_div" style="display:none;"> </div>                                      
                              </td>
                                                  
                              <td style="float:left;">
                               <div id="process_div_attarb" style="display:none; color:#090;"> <img src="<?php echo base_url().'images/progress.gif' ?>" />Loading Attributes... </div>
                              <div id="attrbpopulate_div" style="display:none;"> </div> 
                              
                              
                            </td>
                             
                            
                              <td><input type="button" name="slrorcatgwithattrb_btn" id="slrorcatgwithattrb_btn" onclick="addtolist_slrorcatgwithattrb()" value="Add To List" /> </td>
                              </tr>
                              
                              <tr>
                              <td colspan="6">
                             <div id="loader_div" style="display:none; text-align:center;"> <img src="<?php echo base_url().'images/loading1.gif' ?>" /> 
                             </div>
                            <div id="filter_slabdiv" class="alert alert-info alert-dismissable" style="display:none; overflow-y:scroll; height:450px;"> </div>
                              
                              </td>
                              
                              </tr>
                              
                              </table>
                              </div> 
                            </td>
                </tr>
                </table>
        </div>
                 
                      <table width="100%">
                     
                      <tr>
                      
                    <td>                 
                    <div class="form_view" style="min-height:255px;">
						<p style="background-color:#C90"  class="t-head">Product Add / Modified Date</p>						
					<form action="#">		
                       <table width="100%">
                       
                       <tr>
                       <td >
                      Select Add/Modified
                       </td>
                       <td valign="middle" >
                       
                        <select name="addormodfdate" id="addormodfdate" class="seller_input">
                                        	<option value="">---select---</option>
                                        	<option value="Add Date">Product Add</option>
                                            <option value="Modified Date">Product Modified</option> 
                                                                            
                        </select>
                       </td>
                       </tr>
								
								<tr >
									<td > From Date:    </td>
									<td valign="middle" >
                                    	    <div class="form-group"  style="width:200px">
                                        <div class='input-group date' id='datetimepicker6'>
                                            <input type='text'  class="form-control" name="from_dtm" style="width:191px" id="datepicker-example7-start" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                    </td>
                                    
								</tr>
                                
                                <tr >
									<td >  To Date:   </td>
									<td valign="middle">
                                    	          
                          <div class="form-group" style="width:200px">
                            <div class='input-group date' id='datetimepicker7'>
                                <input type='text' class="form-control" name="to_dtm" style="width:191px" id="datepicker-example7-end" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                                
                            </div>
                        </div>
						
                                    </td>
                                    
								</tr>
                                <tr>
                                <td></td>
                                <td><input type="button" value="Add To List" id="prodaddmodf_btn" name="prodaddmodf_btn" onclick="addtolist_prodaddormodfdate()" />
                                
                                <input type="reset" value="Reset" id="prodaddmodf_resetbtn" name="prodaddmodf_resetbtn" style="width:80px" />
                                
                                </td>
                                </tr>
                               
							</table> 
                        
                        </form>    
					</div>
                    
                    </td>
                   
                    <td>
                      
                      
                        <div class="form_view" style="min-height:255px;">
						<p style="background-color:#930" class="t-head">Product Name / SKU</p>
							<form action="#">
                            <table>
                            
                        <tr>
                       <td>
                       Select Name/SKU
                       </td>
                       <td >
                       
                        <select name="pronameorsku" id="pronameorsku" class="seller_input">
                                        	<option value="">---select---</option>
                                        	<option value="Product Name">Name</option>
                                            <option value="SKU">SKU</option> 
                                                                            
                        </select>
                       </td>
                       </tr>
								
								<tr >
									<td>  </td>
									<td >
                                    	<input type="text"  class="seller_input" name="prod_nameskutxtbox" id="prod_nameskutxtbox" placeholder="Enter Product Name / SKU">
                                        
                                    </td>
                                    
								</tr>
                                
                               <tr><td></td><td> <input type="button" value="Add To List" id="prodnamorsku_btn" onclick="addtolist_prodnameorsku()" />
                               
                               <input type="reset" value="Reset" id="prodnamorsku_resetbtn" name="prodnamorsku_resetbtn" style="width:80px" />
                               </td></tr>
							</table>
                            </form>
					</div>
                       
                     </td>
                     </tr>
                     
                     
                     <tr>
                     <td> 
                     <div class="form_view" style="min-height:255px;">
						<p style="background-color:#CC0" class="t-head">Price / Discount Range</p>
						
                        <form action="#">
                        <table>
                       <tr>
                       <td>
                      Select Price/Discount
                       </td>
                       <td >
                       
                        <select name="prodprc_dis" id="prodprc_dis" class="seller_input">
                                        	<option value=''>---select---</option>
                                        	<option value="Price">Price</option>
                                            <option value="Discount">Discount</option> 
                                                                            
                        </select>
                       </td>
                       </tr>
								
								<tr >
									<td style="width:40%;">From Price/Discount </td>
									<td >
                                    	<input type="text" class="seller_input" name="prcordisfrom_txtbox" id="prcordisfrom_txtbox">
                                        
                                    </td>
                                    
								</tr>
                               <tr >
									<td >To Price/Discount </td>
									<td >
                                    	<input type="text" class="seller_input" name="prcordisto_txtbox" id="prcordisto_txtbox">
                                        
                                    </td>
                                    
								</tr>
                               
                                <tr >
                                <td></td>
                                <td >
                                 <input type="button" value="Add To List" id="prodprcdis_btn" name="prodprcdis_btn" onclick="addtolist_prodpriceordisc()"  />
                               
                               <input type="reset" value="Reset" id="prodprcdis_resetbtn" name="prodprcdis_resetbtn" style="width:80px" />
                               </td></tr>
                               
                               
							</table>
                          </form>  
					</div>
                    
                   </td>
                     
                  <td>  
                   
                     <div class="form_view" style="min-height:255px;">
						<p style="background-color:#F93" class="t-head">Seller / Product Rating Range</p>
							<form action="#">
                            	<table>
                                <tr>
                                   <td>
                                  Select Seller/Buyer
                                   </td>
                                   <td >
                                   
                                    <select name="sellerorbuyer_rating" id="sellerorbuyer_rating" class="seller_input">
                                                        <option value="">---select---</option>
                                                        <option value="Seller Rating">Seller</option>
                                                        <option value="Buyer Rating">Product</option>                                                                                         
                                    </select>
                                   </td>
                                   </tr>
								<tr >
									<td style="width:40%;" >From Rating  </td>
									<td >
                                    	<input type="text"  name="fromrating_txtbox" id="fromrating_txtbox" class="seller_input" >
                                        
                                    </td>
                                    
								</tr>
                                <tr >
									<td >To Rating   </td>
									<td >
                                    	<input type="text" name="torating_txtbox" class="seller_input" id="torating_txtbox">
                                       
                                    </td>
                                    
								</tr>
                                
                                <tr>
                                <td></td>
                                <td><input type="button" value="Add To List" id="slrorbuyerrating_btn" name="slrorbuyerrating_btn" onclick="addtolist_slrorbuyerrating()" />
                                
                                <input type="reset" value="Reset" id="slrorbuyerrating_resetbtn" name="slrorbuyerrating_resetbtn" style="width:80px" />
                                </td>
                                </tr>
							</table>
                            </form>
                            
					</div>
                    
                    </td>                 
	
                     
                      </tr>
                      </table>
                      
                      <div id="addtolist_divid">
                      <span id="addedtolistmsg" style="color:#0C0; text-align:center; font-weight:bold; display:none;">&nbsp;<img src="<?php echo base_url().'images/success_icon.png' ?>"> Data Added To List</span>
                   <?php $attr=array('target'=>"_blank",'method'=>'GET');
				   		  echo form_open('admin/Advance_search/advancesearch_productinfo',$attr);	
				    ?>   
                      <table width="500" class="table table-bordered table-hover" >
                      
                            <tr style="background:#099; padding:6px ">                           
                            <td  align="right" valign="" style="background:#099; padding:6px ">
                        	<span style="float:left; color:#FFF; font-weight:bold;">
                            
                             Product Status </span> &nbsp;
                             </td>
                             <td>
                            <select name="prod_status" id="prod_status" class="seller_input" onchange="disp_catgattrb(this.value)" style="width:100px;" >					                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>                                
                                                </select>
                           
                            
                             <button type="submit" class="seller_buttons" style="float:right"  >                                                    
           						<i class="fa fa-search" aria-hidden="true" style="color:#FFF;"></i> 
                                &nbsp;Search Product 
           					</button>
                            </td></tr>					
                            
                            	<tr ><th class="table_th " style="background-color:#3C0" width="5%">Seller Name</th>
                                <td style="background-color:#3C0;"> 
                                 <select name="slr_nmsrchfinl[]" placeholder=""   class="chosen-select" id="slr_nmsrchfinl" multiple tabindex="4" style="width:980px;" ></select>
                                     
                                   <select style="display:none;" name="slr_nmsrchfinlhidn[]" id="slr_nmsrchfinlhidn" multiple ></select>
                                   
                                   <input type="button" value="Reset" id="slr_nmsrchfinl_resetbtn" name="slr_nmsrchfinl_resetbtn" 
                                   onclick="slr_nmsrchfinlreset()" style="width:80px; float:right;" /> 
                                   
                                </td>
                                </tr>
                                
								<tr><th class="table_th " style="background-color:#3C0" width="10%">Category</th>
                                <td style="background-color:#3C0">
                                <select name="catg_nmsrchfnl[]"   class="chosen-select" id="catg_nmsrchfnl" multiple tabindex="4" style="width:980px;" ></select>
                                     
                               <select name="catg_nmsrchfnlhdn[]"   id="catg_nmsrchfnlhdn" multiple style="display:none;"></select>
                               
                               <input type="button" value="Reset" id="catg_nmsrchfnl_resetbtn" name="catg_nmsrchfnl_resetbtn" 
                                   onclick="catg_nmsrchfnl_resetbtnreset()" style="width:80px; float:right;" /> 
                                </td>
                                </tr>
                                
                               	<tr> <th class="table_th " style="background-color:#3C0" width="10%">Attribute</th>
                                <td style="background-color:#3C0">
                                <select name="attrb_srchfnl[]"   class="chosen-select" id="attrb_srchfnl" multiple tabindex="4" style="width:980px;" ></select>			
                                <select name="hdnattrb_groupids[]"   id="hdnattrb_groupids" multiple style="display:none;"  ></select>
                                <select name="hdnattrb_ids[]"   id="hdnattrb_ids" multiple style="display:none;"  ></select>
                                 <select name="hdnattrb_values[]"   id="hdnattrb_values" multiple  style="display:none;" ></select>
                                
                                 <input type="button" value="Reset" id="attrb_srchfnl_resetbtn" name="attrb_srchfnl_resetbtn" 
                                   onclick="attrbsrchfnl_reset()" style="width:80px; float:right;" /> 
                                </td>
                                </tr>
                                
								<tr><th class="table_th " style="background-color:#C90" width="12%">Product Add/Modified Date Range</th>
                                <td style="background-color:#C90"> 
                                <select name="prodadmodfdate_srchfnl[]"   class="chosen-select" id="prodadmodfdate_srchfnl" multiple tabindex="4" style="width:980px;" ></select>
                                 <input type="button" value="Reset" id="prodadmodfdate_srchfnl_resetbtn" name="prodadmodfdate_srchfnl_resetbtn" 
                                   onclick="prodadmodfdate_srchfnlreset()" style="width:80px; float:right;" />      
                                     
                                <select name="hdndate_filtertype[]"   id="hdndate_filtertype" multiple style="display:none" ></select>
                                <select name="hdndate_fromfilter[]"   id="hdndate_fromfilter" multiple style="display:none" ></select>
                                 <select name="hdndate_tofilter[]"    id="hdndate_tofilter" multiple  style="display:none"></select>      
                                     
                                     
                                     </td>
                                </tr>
                                	
                               	<tr> <th class="table_th " style="background-color:#930" width="12%">Product Name/SKU</th>
                                <td style="background-color:#930">
                                 <select name="prodnmsku_srchfnl[]"   class="chosen-select" id="prodnmsku_srchfnl" multiple tabindex="4" style="width:980px;"> </select>
                                <input type="button" value="Reset" id="prodnmsku_srchfnl_resetbtn" name="prodnmsku_srchfnl_resetbtn" 
                                   onclick="prodnmsku_srchfnlreset()" style="width:80px; float:right;" />   
                                        
                                <select name="hdnprodnmsku_tyefilter[]" id="hdnprodnmsku_tyefilter" multiple style="display:none" ></select>
                                <select name="hdnprodnmsku_datafilter[]" id="hdnprodnmsku_datafilter" multiple style="display:none"></select>
                                
                                
                                
                                </td>
                                </tr>
                                
                             	 <tr><th class="table_th " style="background-color:#CC0" width="12%">Product Price / Discount Range</th>
                                 <td style="background-color:#CC0">
                                 
                                 <select name="pricedsi_srchfnl[]"   class="chosen-select" id="pricedsi_srchfnl" multiple tabindex="4" style="width:980px;" > </select>
                                      <input type="button" value="Reset" id="pricedsi_srchfnl_resetbtn" name="pricedsi_srchfnl_resetbtn" 
                                   onclick="pricedsi_srchfnl_reset()" style="width:80px; float:right;" />   
                                   
                                   
                                     <select name="hdnpricedsi_type[]"  id="hdnpricedsi_type" multiple  style="display:none;" ></select>
                                     <select name="hdnpricedsi_from[]"  id="hdnpricedsi_from" multiple style="display:none;" ></select>
                                     <select name="hdnpricedsi_to[]"    id="hdnpricedsi_to" multiple  style="display:none;" ></select>
                                     
                                     
                                 </td>
                                 </tr>
                                 
                              	<tr><th class="table_th " style="background-color:#F93" width="12%">Seller / Product Rating Range</th>
                                <td style="background-color:#F93">
                                <select name="slrbuyerrating_srchfnl[]"   class="chosen-select" id="slrbuyerrating_srchfnl" multiple tabindex="4" style="width:980px;"> </select>
                                     
                                   <input type="button" value="Reset" id="slrbuyerrating_srchfnl_resetbtn" name="slrbuyerrating_srchfnl_resetbtn" 
                                   onclick="slrbuyerrating_srchfnlreset()" style="width:80px; float:right;" />   
                                     
                                     <select name="hdnslrbuyerrating_type[]"    id="hdnslrbuyerrating_type" multiple style="display:none;" ></select>
                                     <select name="hdnslrbuyerrating_from[]"    id="hdnslrbuyerrating_from" multiple style="display:none;"></select>
                                     <select name="hdnslrbuyerrating_to[]"    id="hdnslrbuyerrating_to" multiple style="display:none;"></select>
                                </td>
                                </tr>
                                
                                
                                 <tr style="background:#099; ">                           
                            
                             <td colspan="2">
                           
                           <button type="button" class="seller_buttons" style="float:left" onclick="window.location.href='<?php echo base_url().'admin/super_admin/advance_productsearch'; ?>'"  >                                                    
           						<i class="fa fa-refresh" aria-hidden="true"></i>
 
                                &nbsp;Reset All 
           					</button>
                            &nbsp; &nbsp;
                             <button type="submit" class="seller_buttons" style="float:right"  >                                                    
           						<i class="fa fa-search" aria-hidden="true" style="color:#FFF;"></i> 
                                &nbsp;Search Product 
           					</button>
                            </td></tr>		
                                
					  </table>
                      <?php echo form_close(); ?>
                      
                      </div>
 <!-- end of rowcontent-header div -->
</div> <!-- end of main-content div -->
<script>

function validetdate()
{
	var fromdate=$('#datepicker-example7-start').val();
	var todate=	$('#datepicker-example7-end').val();
	
	if(fromdate!='' && todate=='')
	{ 	$("#show_error").text('! Please Select To Date');
	 	$("#show_error").show();
	 	return false;
	 }
	if(fromdate=='' && todate!='')
	{ 	$("#show_error").text('! Please Select From Date');
	 	$("#show_error").show();
	 	return false;
	 }
	
}
</script>

<?php
	require_once('footer.php');
?>                      