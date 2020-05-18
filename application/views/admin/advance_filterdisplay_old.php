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


<style>
	/*.Zebra_DatePicker_Icon{	
	top:6px !important;
}
.Zebra_DatePicker{ z-index:999999 !important;}*/
</style>


<script>
$(document).ready(function(){
	$('#check_all').click(function(){
		$('input:checkbox').prop('checked', this.checked);
	});
});
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
#slr_nm_dv{position: absolute; z-index: 1000; background-color:seashell; width: 22%; border: 1px solid tan;  border-radius: 3px;}
#slr_nm_dv ul {margin-bottom:0px !important;}
#slr_nm_dv li { cursor: pointer;  list-style: outside none none;padding: 5px 5px 5px 10px;}
#slr_nm_dv li:hover{background-color:tan;}
</style>

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

function disp_catgattrb(displayoption)
{
	if(displayoption=='seller_op')
	{
		$('#slrsreach_name').css('display','block');	
		$('#catg_name').css('display','none');
		$('#attrb_name').css('display','none');
	}
	else if(displayoption=='category_op')
	{
		$('#slrsreach_name').css('display','none');	
		$('#catg_name').css('display','block');
		$('#attrb_name').css('display','block');	
	}
	
		
}
</script>

<!--- Zebra_Datepicker link end here ---->
    <br />
    <br />    
  <div class="main-content" style="padding:40px 10px;">   
 <div class="row content-header" style="background-color:#CCC;">
				<h3 style="margin-top:0px; font-weight:bold;"><span style="color:#F00">Advance Product Search</span></h3>
   
   
           
</div>
		<!-------------------------------------------Listing start--------------------------------------------------------------------->
        
        
					
                     
                        <div class="clearfix"></div>
  
					  <div>
                      
                      <table>
                      <tr>
                      <td><div width="60%" style="float:left;">
                        <div class="form_view" style="width:380px">
						<h3>Choose Seller / Category with Attribute</h3>
							<table style="margin:20px 0px;">
								
								<tr >
									<td style="width:20%;"> Seller  <sup>*</sup> </td>
									<td >
                                    	<select name="slr_ctagattrb" id="slr_ctagattrb" class="seller_input" onchange="disp_catgattrb(this.value)" style="width:100px;">
                                        	<option value=''>---select---</option>
                                        	<option value="seller_op">Seller</option>
                                            <option value="category_op">Category</option>                                 
                                        </select>
                                       
                                    </td>
                                    <td>                                  
                                        
                                        <input type="text" name="slrsreach_name" id="slrsreach_name" class="seller_input" placeholder="Enter Seller Name" style="width:300px; display:none;">
           								<div id="slr_nm_dv"><ul></ul></div>
                                        <br />
                                         <br />
                                        <!--<select name="catg_name" id="catg_name" class="text2"  style="width:300px; display:none;">
                                        	<option value="">---Choose Category---</option>
                                        	<option value="Mobile">Mobile</option>
                                            <option value="Ankit">Fashoin</option> 
                                             <option value="Toys">Toys</option>                                
                                        </select>-->
                                        
                                        
                                         <select name="catg_name"  data-placeholder="Choose Category"  id="catg_name" class="text2"  style="width:300px; display:none;">
                							<option value=''>---Choose Category---</option>	
                                            <?php if($srch_catg->num_rows()>0)
											foreach($srch_catg->result_array() as $rw){ ?>
                                            <option value="<?=$rw['lvl2'];?>"><?=$rw['lvlmain_name']." >> ".$rw['lvl1_name']." >> ".$rw['lvl2_name'];?></option>
                                         <?php } ?>
                                         
                                        </select>
                                        
                                         <br />
                                         <br />
                                       <!-- <select name="attrb_name" id="attrb_name" class="text2" style="width:300px; display:none;">
                                        	<option value="">---Choose Attribute---</option>
                                        	<option value="Mobile">Power Bank</option>
                                            <option value="Dress">Dress</option> 
                                             <option value="Ring">Ring</option>                                
                                        </select>-->
                                                                              
                                        
                                         <select name="attrb_name"  id="attrb_name" class="text2"  style="width:300px; display:none;">
                							<option value=''>---Choose Attribute---</option>	
                                            <?php if($srch_attrb->num_rows()>0)
											foreach($srch_attrb->result_array() as $rw_attrb){ ?>
                                            <option value="<?=$rw_attrb['attribute_group_id'];?>"><?=$rw_attrb['attribute_group_name'];?></option>
                                         <?php } ?>
                                         
            </select>
                                         <br />
                                         <br />
                                        <input type="submit" value="Add To List" /> 
                                    
                                    </td>
                                    
								</tr>
                               
                               
							</table>
                            
					</div>
                     <br />
                    
                    <div class="form_view" style="width: 500px">
						<h3>Product Add Date</h3>
							
								
							
                       <table style="margin:20px 0px;">
								
								<tr >
									<td style="width:20%;"> From Date:   <sup>*</sup> </td>
									<td >
                                    	    <div class="form-group"  style="width:200px; " >
                                        <div class='input-group date' id='datetimepicker6'>
                                            <input type='text' class="form-control" name="from_dtm" style="width:250px" id="datepicker-example7-start" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                    </td>
                                    
								</tr>
                                
                                <tr >
									<td style="width:20%;">   To Date:  <sup>*</sup> </td>
									<td >
                                    	          
                          <div class="form-group" style="width:200px">
                            <div class='input-group date' id='datetimepicker7'>
                                <input type='text' class="form-control" name="to_dtm" style="width:250px" id="datepicker-example7-end" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                                
                            </div>
                        </div>
              
						<input type="submit" value="Add To List" />
                                    </td>
                                    
								</tr>
                               
							</table> 
                            
					</div>
                       <br />
                      
                        <div class="form_view" style="width:500px">
						<h3>SKU</h3>
							<table style="margin:20px 0px;">
								
								<tr >
									<td style="width:20%;"> SKU </td>
									<td >
                                    	<input type="text" class="text2" name="mcost" id="mcost">
                                        <input type="submit" value="Add To List" />
                                    </td>
                                    
								</tr>
                               
							</table>
                            
					</div>
                       
                       <br />
                       <div class="form_view" style="width:500px">
						<h3>Product</h3>
							<table style="margin:20px 0px;">
								
								<tr >
									<td style="width:20%;"> Product Name <sup>*</sup> </td>
									<td  >
                                    	<input type="text" class="text2" name="mcost" id="mcost" width="300">
                                        <input type="submit" value="Add To List" />
                                    </td>
                                    
								</tr>
                               
							</table>
                            
					</div>
                    
                     <br />
                     
                     
                     <div class="form_view" style="width:500px">
						<h3>Added Date Range</h3>
							<table style="margin:20px 0px;">
								
								<tr >
									<td style="width:20%;"> From Date:   <sup>*</sup> </td>
									<td >
                                    	    <div class="form-group"  style="width:200px">
                                        <div class='input-group date' id='datetimepicker9'>
                                            <input type='text' class="form-control" name="from_dtm" style="width:250px" id="datepicker-example7-start" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                    </td>
                                    
								</tr>
                                
                                <tr >
									<td style="width:20%;">   To Date:  <sup>*</sup> </td>
									<td >
                                    	          
                          <div class="form-group" style="width:200px">
                            <div class='input-group date' id='datetimepicker8'>
                                <input type='text' class="form-control" name="to_dtm" style="width:250px" id="datepicker-example7-end" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                                
                            </div>
                        </div>
              
						<input type="submit" value="Add To List" />
                                    </td>
                                    
								</tr>
                               
							</table>
                            
					</div>
                    
                     <br />
                     
                     
                     <div class="form_view" style="width:500px">
						<h3>Modified Date Range</h3>
							<table style="margin:20px 0px;">
								
								<tr >
									<td style="width:20%;"> From Date:   <sup>*</sup> </td>
									<td >
                                    	    <div class="form-group"  style="width:200px">
                                        <div class='input-group date' id='datetimepicker10'>
                                            <input type='text' class="form-control" name="from_dtm" style="width:250px" id="datepicker-example7-start" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                    </td>
                                    
								</tr>
                                
                                <tr >
									<td style="width:20%;">   To Date:  <sup>*</sup> </td>
									<td >
                                    	          
                          <div class="form-group" style="width:200px">
                            <div class='input-group date' id='datetimepicker11'>
                                <input type='text' class="form-control" name="to_dtm" style="width:250px" id="datepicker-example7-end" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                                
                            </div>
                        </div>
              
						<input type="submit" value="Add To List" />
                                    </td>
                                    
								</tr>
                               
							</table>
                            
					</div>
                    
                     <br />
                     
                     
                     <div class="form_view" style="width:500px">
						<h3>Price Range</h3>
							<table style="margin:20px 0px;">
								
								<tr >
									<td style="width:20%;">From Price </td>
									<td >
                                    	<input type="text" class="text2" name="mcost" id="mcost">
                                        
                                    </td>
                                    
								</tr>
                               <tr >
									<td style="width:20%;"> To Price </td>
									<td >
                                    	<input type="text" class="text2" name="mcost" id="mcost">
                                        
                                    </td>
                                    
								</tr>
                               
                                <tr ><td colspan="2">
                                 <input type="submit" value="Add To List" />
                               </td></tr>
                               
                               
							</table>
                            
					</div>
                    
                     <br />
                     <div class="form_view" style="width:500px">
						<h3>Discount Range</h3>
							<table style="margin:20px 0px;">
								
								<tr >
									<td style="width:20%;"> From Discount <sup>*</sup> </td>
									<td >
                                    	<input type="text" class="text2" name="mcost" id="mcost">
                                        
                                    </td>
                                    
								</tr>
                                <tr >
									<td style="width:20%;"> To Discount <sup>*</sup> </td>
									<td >
                                    	<input type="text" class="text2" name="mcost" id="mcost">
                                       
                                    </td>
                                    
								</tr>
                                
                                 <tr ><td colspan="2">
                                 <input type="submit" value="Add To List" />
                               </td></tr>
                               
							</table>
                            
					</div>
                    
                     <br />
                     <div class="form_view" style="width:500px">
						<h3>Seller Rank Range</h3>
							<table class="responsive" >
								
								<tr >
									<td  >From Rank Range <sup>*</sup> </td>
									<td  >
                                    	<input type="text" class="text2" name="mcost" id="mcost">
                                        
                                    </td>
                                    
								</tr>
                                <tr >
									<td >To Rank Range <sup>*</sup> </td>
									<td >
                                    	<input type="text" class="text2" name="mcost" id="mcost">
                                       
                                    </td>
                                    
								</tr>
                                
                                <tr ><td colspan="2">
                                 <input type="submit" value="Add To List" />
                               </td></tr>
							</table>
                            
					</div>
                    
                     <br />
                     <div class="form_view" style="width:500px">
						<h3>Buyer Rating Range</h3>
							<table>
								
								<tr >
									<td style="width:30%;">From Rating  <sup>*</sup> </td>
									<td >
                                    	<input type="text" class="" name="mcost" id="mcost">
                                       
                                    </td>
                                    
								</tr>
                               <tr >
									<td >To Rating  <sup>*</sup> </td>
									<td >
                                    	<input type="text" class="" name="mcost" id="mcost">
                                       
                                    </td>
                                    
								</tr>
                               
                               
                               <tr ><td colspan="2" align="center">
                                 <input type="submit" value="Add To List" />
                               </td></tr>
							</table>
                            
					</div>
                    
                     <br />
                     
                     
                     
                     
                     
                     
                    <div width="40%" style="float:left;">
                    
                    
                    <table>
            
             </table>
                    </div> 
                       
                        
              
                        
                       <br />

                
	</div></td>
                      <td><table width="500" class="table table-bordered table-hover" >
                      
                            <tr ><td colspan="7" align="right" valign="" style="background:#C90; padding:6px "><input type="submit" value="Search" style="float:right" /></td></tr>
							
                            
                            <tr class="table_th">
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
					  </table></td>
                      </tr>
                      </table>
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