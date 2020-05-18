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

<!--<script src="<?php //echo base_url();?>js/chosen.jquery.js"></script>-->
<script>
 /* $(function() {
	$('.chosen-select').chosen();
	$('.chosen-select-deselect').chosen({ allow_single_deselect: true });
  });*/
</script>

<link href="<?php echo base_url(); ?>js/datetime/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/1.0.0/js/bootstrap-datetimepicker.min.js"></script>


<script type="text/javascript">
    $(function () {
        $('#datetimepicker6').datetimepicker();
        $('#datetimepicker7').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker8').datetimepicker();
        $('#datetimepicker9').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#datetimepicker8").on("dp.change", function (e) {
            $('#datetimepicker9').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker9").on("dp.change", function (e) {
            $('#datetimepicker8').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker10').datetimepicker();
        $('#datetimepicker11').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#datetimepicker10").on("dp.change", function (e) {
            $('#datetimepicker11').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker11").on("dp.change", function (e) {
            $('#datetimepicker10').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>
<script>
$(document).ready(function(){
	$('#check_all').click(function(){
		$('input:checkbox').prop('checked', this.checked);
	});
});
</script>

<script>

function disp_catgattrb(displayoption)
{
	if(displayoption=='seller_op')
	{
		
		
		$('#slrsreach_name').css('display','block');
		$('#retirve_catg').css('display','block');
			
		$('#category_div').css('display','none');
		$('#attrbpopulate_div').css('display','none');
		
	}
	else if(displayoption=='category_op')
	{
		$('#category_div').css('display','none');
		$('#attrbpopulate_div').css('display','none');	
		
		$('#slrsreach_name').css('display','none');	
		$('#slrsreach_name').val('');
		$('#retirve_catg').css('display','none');
		
	$('#process_div_catg').css('display','block');
		
		var catg='';

		$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/advance_search/select_allcategory",
					data:{catg:catg},
					success:function(data){			
						
						$("#category_div").html(data);
						$('#category_div').css('display','block');
						$('#process_div_catg').css('display','none');
						
						
					}
				});
	}
		
}


function populate_attribiuteas_catg(catgid)
{
	$('#attrbpopulate_div').css('display','none');
	$('#process_div_attarb').css('display','block');
	
	
	$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/advance_search/selectattrb_as_category",
					data:{catgid:catgid},
					success:function(data){			
						
						$("#attrbpopulate_div").html(data);
						$('#attrbpopulate_div').css('display','block');
						$('#process_div_attarb').css('display','none');
						
						
					}
				});	

}
</script>


<script>
$(document).ready(function(){
	
	$("#slrsreach_name").keyup(function(){
		
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
	$('#slrsreach_name').val(res);
	$('#slrsreach_name').css('color','black');
	$('#slr_nm_dv').css('display','none');
}
</script>
 <script>
 $(document).ready(function(){
$(document).keyup(function(event){
        if(event.which === 27){
            $('#slr_nm_dv').css('display','none');
			
        }
    });
	
});

</script>

<style>
#non,#slr_nm_dv{ display:none;}
#slr_nm_dv{position: absolute; z-index: 1000; background-color:seashell; width: 21%; border: 1px solid tan;  border-radius: 3px;}
#slr_nm_dv ul {margin-bottom:0px !important;}
#slr_nm_dv li { cursor: pointer;  list-style: outside none none;padding: 5px 5px 5px 10px;}
#slr_nm_dv li:hover{background-color:tan;}
</style>
<!--- Zebra_Datepicker link end here ---->

<script>

function populetslr_catgattrb()
{  
    var slr_name=$('#slrsreach_name').val();
	
	$('#category_div').css('display','none');
	
  if(slr_name!=''){
	  
	$('#process_div_catg').css('display','block');
	
	
	$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/advance_search/selectcategory_as_seller",
					data:{slr_name:slr_name},
					success:function(data){			
						
						$("#category_div").html(data);
						$('#category_div').css('display','block');
						$('#process_div_catg').css('display','none');
						
						
					}
				});	
  }
  else
  {alert('Enter Seller Name');}
		
		
}

function populate_attribute(catgid)
{
	var slr_name=$('#slrsreach_name').val();
	
	$('#attrbpopulate_div').css('display','none');
	$('#process_div_attarb').css('display','block');
	
	
	$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/advance_search/selectattrb_as_seller",
					data:{slr_name:slr_name,catgid:catgid},
					success:function(data){			
						
						$("#attrbpopulate_div").html(data);
						$('#attrbpopulate_div').css('display','block');
						$('#process_div_attarb').css('display','none');
						
						
					}
				});	
}

</script>
    
       
  <div class="main-content" style="padding:40px 10px; margin-top:45px;">   
 <div class="row content-header" style="background-color:#CCC;">
				<h3 style="margin-top:0px; font-weight:bold;"><span style="color:#F00">Advance Product Search</span></h3>
   
   
           
</div>
		<!-------------------------------------------Listing start--------------------------------------------------------------------->
                 
                      <table width="100%">
                     
                      <tr>
                      <td>
                      
                      <div class="form_view" style="width: 400px;min-height:255px;">
						<p class="t-head">Choose Seller / Category with Attribute</p>
                      <table>
                      <tr>
                      <td style="width:30%;" align="left">Seller  </td>
                      <td><select name="slr_ctagattrb" id="slr_ctagattrb" class="seller_input" onchange="disp_catgattrb(this.value)" style="width:236px;">
                                        	<option value='' selected="selected">---select---</option>
                                        	<option value="seller_op">Seller</option>
                                            <option value="category_op">Category</option>                                
                                        </select></td>
                      </tr>
                      
                      
                      <tr>                      
                      <td colspan="2" >
                      
                      <input type="text" name="slrsreach_name" id="slrsreach_name" class="seller_input" placeholder="Enter Seller Name" style="width:280px; display:none; float:left "><input type="button" id="retirve_catg" name="retirve_catg" onclick="populetslr_catgattrb()" value="Go" style="display:none; ">
                     
           			<div id="slr_nm_dv"><ul></ul></div>                      
                      
                      </td>
                      </tr>
                      <tr>
                      
                      <td colspan="2"> 
                       <div id="process_div_catg" style="display:none; color:#090;"> <img src="<?php echo base_url().'images/progress.gif' ?>" />Loading Categories...</div>
                      <div id="category_div" style="display:none;"> </div>                                      
                      </td>
                      </tr>
                      <tr>                      
                      <td colspan="2">
                       <div id="process_div_attarb" style="display:none; color:#090;"> <img src="<?php echo base_url().'images/progress.gif' ?>" />Loading Attributes... </div>
                      <div id="attrbpopulate_div" style="display:none;"> </div> 
                      
                      
                      <!-- <select name="attrb_name" id="attrb_name" class="" style="width:280px;">
                                        	<option value="">---Choose Attribute---</option>
                                        	<option value="Mobile">Power Bank</option>
                                            <option value="Dress">Dress</option> 
                                             <option value="Ring">Ring</option>                                
                                        </select>--></td>
                      </tr>
                      <tr>
                      <td></td>
                      <td><input type="submit" value="Add To List" /> </td>
                      </tr>
                      
                      </table>
                      </div> 
                    </td>
                    <td>                 
                    <div class="form_view" style="width: 400px;min-height:255px;">
						<p class="t-head">Product Add / Modified Date</p>						
							
                       <table width="100%">
                       
                       <tr>
                       <td >
                      Select Add/Modified
                       </td>
                       <td valign="middle" >
                       
                        <select name="addormodfdate" id="addormodfdate" class="seller_input">
                                        	<option value="">---select---</option>
                                        	<option value="add">Product Add</option>
                                            <option value="modified">Product Modified</option> 
                                                                            
                        </select>
                       </td>
                       </tr>
								
								<tr >
									<td > From Date:    </td>
									<td valign="middle" >
                                    	    <div class="form-group"  style="width:200px">
                                        <div class='input-group date' id='datetimepicker6'>
                                            <input type='text' class="form-control" name="from_dtm" style="width:191px" id="datepicker-example7-start" />
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
                                <td><input type="submit" value="Add To List" /></td>
                                </tr>
                               
							</table> 
                            
					</div>
                    
                    </td>
                   
                    <td>
                      
                      
                        <div class="form_view" style="width:400px; min-height:255px;">
						<p class="t-head">Product Name / SKU</p>
							<table>
                            
                        <tr>
                       <td>
                       Select Name/SKU
                       </td>
                       <td >
                       
                        <select name="pronameorsku" id="pronameorsku" class="seller_input">
                                        	<option value="">---select---</option>
                                        	<option value="prod_name">Name</option>
                                            <option value="prod_sku">SKU</option> 
                                                                            
                        </select>
                       </td>
                       </tr>
								
								<tr >
									<td>  </td>
									<td >
                                    	<input type="text" class="seller_input" name="prod_namesku" id="prod_namesku" placeholder="Enter Product Name / SKU">
                                        
                                    </td>
                                    
								</tr>
                                
                               <tr><td></td><td> <input type="submit" value="Add To List" /></td></tr>
							</table>
                            
					</div>
                       
                     </td>
                     </tr>
                     <tr>
                     <td> 
                     <div class="form_view" style="width:400px;min-height:255px;">
						<p class="t-head">Price / Discount Range</p>
							<table>
                       <tr>
                       <td>
                      Select Price/Discount
                       </td>
                       <td >
                       
                        <select name="pronameorsku" id="pronameorsku" class="seller_input">
                                        	<option value="">---select---</option>
                                        	<option value="add">Price</option>
                                            <option value="modified">Discount</option> 
                                                                            
                        </select>
                       </td>
                       </tr>
								
								<tr >
									<td style="width:40%;">From Price/Discount </td>
									<td >
                                    	<input type="text" class="seller_input" name="prod_frompriceordis" id="prod_frompriceordis">
                                        
                                    </td>
                                    
								</tr>
                               <tr >
									<td >To Price/Discount </td>
									<td >
                                    	<input type="text" class="seller_input" name="prod_topriceordis" id="prod_topriceordis">
                                        
                                    </td>
                                    
								</tr>
                               
                                <tr >
                                <td></td>
                                <td >
                                 <input type="submit" value="Add To List" />
                               </td></tr>
                               
                               
							</table>
                            
					</div>
                    
                   </td>
                     
                  <td>  
                   
                     <div class="form_view" style="width:400px;min-height:255px;">
						<p class="t-head">Seller / Buyer Rating Range</p>
							<table>
                                <tr>
                                   <td>
                                  Select Seller/Buyer
                                   </td>
                                   <td >
                                   
                                    <select name="pronameorsku" id="pronameorsku" class="seller_input">
                                                        <option value="">---select---</option>
                                                        <option value="add">Seller</option>
                                                        <option value="modified">Buyer</option> 
                                                                                        
                                    </select>
                                   </td>
                                   </tr>
								<tr >
									<td style="width:40%;" >From Rank  </td>
									<td >
                                    	<input type="text"  name="mcost" class="seller_input" id="mcost">
                                        
                                    </td>
                                    
								</tr>
                                <tr >
									<td >To Rank   </td>
									<td >
                                    	<input type="text" name="mcost" class="seller_input" id="mcost">
                                       
                                    </td>
                                    
								</tr>
                                
                                <tr>
                                <td></td>
                                <td><input type="submit" value="Add To List" /></td>
                                </tr>
							</table>
                            
					</div>
                    
                    </td>                 
	
                     
                      </tr>
                      </table>
                      
                      <div>
                      
                      <table width="500" class="table table-bordered table-hover" >
                      
                            <tr ><td colspan="7" align="right" valign="" style="background:#099; padding:6px "><input type="submit" value="Search" style="float:right" /></td></tr>
							
                            
                            <tr class="table_th " style="background-color:#099">
								<th width="4%"><input type="checkbox" id="check_all" name="check_all">Select All</th>
								<th width="5%">Seller Name</th>
								<th width="10%">Category</th>
                                <th width="10%">Attribute</th>
								<th width="12%">Product Add Date Range</th>							
								<th width="10%">Rating</th>
								<th width="8%">Seller Rank Range</th>
								
							</tr>
							
                            <tr >
								<td><input type="checkbox" id="check_all" name="check_all"></td>
								<td>Ankit</td>
								<td>Mobile</td>
                                <td>Mobile</td>							
								<td>01-02-2017 To 28-02-2017</td>								
								<td>3</td>
								<td>1</td>
								
							</tr>
                            
                             <tr >
								<td><input type="checkbox" id="check_all" name="check_all"></td>
								<td>Dj Impex</td>
								<td>Mobile</td>
                                <td>Mobile</td>							
								<td>01-02-2017 To 28-02-2017</td>								
								<td>3</td>
								<td>1</td>
								
							</tr>
                            
							
							<!--<tr><td colspan="9" class="a-center">No Orders Available For Transfer ! </td></tr>-->
					  </table>
                      </div>
 <!-- end of rowcontent-header div -->
</div> <!-- end of main-content div -->
<script>

function dwlnbulk_existingprodtemplate()
{
	 $("#show_productserror").hide();
	//var prodid = $('input[name="prodid_chk"]:checked').map(function(_, el){
//        	return $(el).val();
//    	}).get();
	
	var productid = document.getElementsByName("prodid_chk[]");
	 
		var productid_count = productid.length; 
		var count = 0;
		for (var i=0; i<productid_count; i++) {
			if (productid[i].checked === true) 
			{
				count++;
			}
		}
	if(count==0){
	 $("#show_productserror").text('! Please Select Atleast One Product');
	 $("#show_productserror").show();
	 return false;	
	}
	
	/*$.ajax({
					method:"POST",
					url:"<?php //echo base_url(); ?>admin/Download_bulkexisting_prodtemplate/download_extprodtemplate",
					data:{catg_id:catg_id,attrbsetid:attrbsetid,prodid:prodid},
					success:function(data){			
						
						$("#excelrec_statisdiv").html(data);
						$('#process_div').css('display','none');
						$("#excelrec_statisdiv").css('display','block');
						
					}
				});	*/
		
}

function add_exist_product(prodid,selrid,sku)
{
		
		if(document.getElementById('prodchk'+prodid).checked== true)
		{
			$("#prod"+prodid).css("background-color", "LightGoldenRodYellow ");
			
		}
		else if(document.getElementById('prodchk'+prodid).checked== false)
		{
			
			$("#prod"+prodid).css("background-color", "");
			
		}		  
	
}
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