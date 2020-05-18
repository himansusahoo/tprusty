<?php
require_once("header.php");
?>
 
 <script>
 $(document).ready(function(){
$(document).keyup(function(event){
        if(event.which === 27){
            $('#slr_nm_dv').css('display','none');
			
        }
    });
	
});

</script>


 
<script>
function search_productfordelete()
{
	
	 var formData = new FormData( $("#myForm")[0] );
	 var userfl = $("input[name='userfile']").val();
	 var ext = userfl.substring(userfl.lastIndexOf('.') + 1);
	 
	 var sku_txtarea=$('#sku_txtarea').val();
	 
	$("#datadisplay_div").css('display','none');
	 
	 if(userfl=='' && sku_txtarea=='')
	 {
	
		$("#exlshow_error").text('Please Enter Sku in Textbox Or Upload Excel File');
	 	$("#exlshow_error").show();
		$("#datadisplay_div").css('display','none');
	 	return false; 
		 
	 }
	 
	  if(userfl!='' && sku_txtarea!='')
	 {
		
		$("#exlshow_error").text('Please Search Product By SKU in Textbox OR By Upload Excel, Not Search By Both Option');
	 	$("#exlshow_error").show();
		$("#datadisplay_div").css('display','none');
	 	return false; 
		 
	 }
	 
	
	else if(ext != "xls" && userfl!='' && sku_txtarea==''){
		
		
		$("#exlshow_error").text('Invalid File Type, Please Select Excel(.xls) File');
	 	$("#exlshow_error").show();
		$("#datadisplay_div").css('display','none');
		return false;
	}
	else if(ext == "xls" && userfl!='' && sku_txtarea=='')
	{ 
		$('#process_div').css('display','block');
		
		$("#srchby_prod1").css('display','none');
		$("#srch_prod").css('display','none');
						
			$.ajax({            
			url :'<?php echo base_url().'admin/Bulk_productdelete/search_productasexcelsheet' ?>',   
            type : 'POST',
            data : formData,
            async : true,
            cache : false,
            contentType : false,
            processData : false,
            success : function(data) {
                
				$("input[name='userfile']").val('');
				$("#exlshow_error").text('');				
				$("#datadisplay_div").html(data);
				$('#process_div').css('display','none');
				$('#datadisplay_div').css('display','block');
				
				$("#srchby_prod1").css('display','block');
				$("#srch_prod").css('display','block');
						
            }
        });
	}
	
	else if(userfl=='' && sku_txtarea!='')
	{
		
		$('#process_div').css('display','block');		
		$("#exlshow_error").css('display','none');
		$("#datadisplay_div").css('display','none');
		$("#srchby_prod1").css('display','none');
		$("#srch_prod").css('display','none');
		
	$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/Bulk_productdelete/search_productselect",
					data:{sku_txtarea:sku_txtarea},
					success:function(data){			
						
						$("#datadisplay_div").html(data);
						$('#process_div').css('display','none');
						$("#datadisplay_div").css('display','block');
						$("#srchby_prod1").css('display','block');
						$("#srch_prod").css('display','block');
						
					}
				});	
			
	}
		
}

</script>
<script>

function searchby_productfordelete()
{
	var slrname=$('#slrsreach_name').val();
	var catgids=$('#catgids').val();
	var attrb=$('#allattrbids').val();	
	
	
	
	
	if(slrname=='' && catgids==null && attrb==null )
	{	$("#exlshow_error2").css('display','block');
		$("#exlshow_error2").text('Please Enter Data In any one Textbox');
		$("#datadisplay_div").css('display','none');
	}
	else
	{
		$("#srch_prod").css('display','none');
		$("#srchby_prod1").css('display','none');
		$('#process_div').css('display','block');		
		$("#exlshow_error2").css('display','none');
		$("#datadisplay_div").css('display','none');
		
	$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/Bulk_productdelete/searchby_productselect",
					data:{slrname:slrname,catgids:catgids,attrb:attrb},
					success:function(data){			
						
						$("#datadisplay_div").html(data);
						$('#process_div').css('display','none');
						$("#datadisplay_div").css('display','block');
						$("#srchby_prod1").css('display','block');
						$("#srch_prod").css('display','block');
						
					}
				});		
			
	}
	
}
</script>
<script>
function selectedprod_delete()
{
	
		var order_ids = document.getElementsByName("order_id_chk[]");
		var orderid_count=order_ids.length;
		
		var count=0;
		for (var i=0; i<orderid_count; i++) {
			if (order_ids[i].checked === true) 
			{
				count++;
			}
		}
		
		if(count==0)
		{
			alert('Please select atleast one record');
			return false;
		}
		else
		{
			
			
			var ys = confirm("Do you want to Delete Selected Products ?");
		if(ys){
			var ordered_id = $('input[name="order_id_chk[]"]:checked').map(function(_, el){
        	return $(el).val();
    	}).get();
			var orderstatus=$('#order_status').val();
			
					
				$('#process_div').css('display','block');
				$("#srchby_prod1").css('display','none');
				$("#srch_prod").css('display','none');
				$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/Bulk_productdelete/delete_selectedproduct",
					data:{productsku:ordered_id},
					success: function (data) {
						
							$('#process_div').css('display','none');
							window.location.reload(true);
						
					}
				});
			
		}
			
	}	
}
</script>

<script src="<?php echo base_url();?>js/chosen.jquery.js"></script>
<script>
  $(function() {
	$('.chosen-select').chosen();
	$('.chosen-select-deselect').chosen({ allow_single_deselect: true });
  });
</script>

<style>
#non,#slr_nm_dv{ display:none;}
#slr_nm_dv{position: absolute; z-index: 1000; background-color:seashell; width: 20%; border: 1px solid tan;  border-radius: 3px;}
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
					
				}else{
					$("#slr_nm_dv ul").html("");
					
					$('#slr_nm_dv').css('display','none');
				}
			}
		});
	});

})


function getslrname(val){
	var x = val
	var res = x.replace(/-/g,' ')
	$('#slrsreach_name').val(res);
	$('#slrsreach_name').css('color','black');
	$('#slr_nm_dv').css('display','none');
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
			<div class="row content-header" style="background-color:#CCC;">
				<div class="col-md-8"><h3 style="font-weight:bold; color:#F00;">Bulk New Product Delete</h3></div>
				<div class="col-md-4 show_report" ><br>
					 <button id="product_temdwnl" class="seller_buttons" 
                                         onClick="window.location.href='<?php echo base_url().'excel_downloaded/product_deletetemplate.xls' ?>'" style="float:right;">           																																																																																			                                         <i class="fa fa-download" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Download Template
           								</button>
				</div>
			</div>
            
            <div>
         <?php  $attributes = array('class' => 'cmxform', 'id' => 'myForm', 'method' => 'POST' );
			echo form_open_multipart('admin/Bulk_productdelete/search_productselect', $attributes);
			//echo form_open_multipart('admin/Bulk_productdelete/search_productasexcelsheet', $attributes);
			?>
            <table style="background-color:#0CC;">
            <tr>
            <td valign="top" style="width:600px; vertical-align:top">
            
            <fieldset ><legend style="background-color:#CCC;">Delete As SKU</legend>
            Enter SKU with separate by comma
            <br><textarea class="seller_input" style="width:500px;height:80px;" id="sku_txtarea" name="sku_txtarea" ></textarea>           
            </fieldset>
            
            </td>
            
            <td style="width:100px; vertical-align:middle; font-weight:bold;">
           &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;OR
            </td>
            
            <td valign="top" style="width:600px; vertical-align:middle;">
            <fieldset ><legend style="background-color:#CCC;">Delete As SKU In Excelsheet</legend>
            Upload Excel File
            <br>
           <input type="file" id="userfile" name="userfile">
            
            </fieldset>
            
            </td>
            <td style="vertical-align:middle;">
            <?php $qr_log=$this->db->query("select * from product_process_status where prod_delete='not process' AND status_id='1' "); 
		   	if($qr_log->num_rows()>0)
		   {?> 
           <input style="float:right;" class="seller_buttons" type="button" value="Search Products" id="srch_prod" name="srch_prod" onClick="search_productfordelete()" >        
           
           <?php }else { ?>
           <span style="text-align:center; color:#F00; font-weight:bold;">
			<img src="<?php echo base_url().'images/progress.gif' ?>" />
 			Please wait Product Delete is under porcess....................... </span>
           <?php } ?>
             <!--<input style="float:right;" class="seller_buttons" type="submit" value="Search Products" id="srch_prod" name="srch_prod"  >-->
            
            
            </td>
           </tr>
           <tr>
           <td colspan="2" style="text-align:center;">
            <div id="exlshow_error" style="color:#F00; font-weight:bold; display:none;" ></div> 
           </td> 
            <td >
           </td>
            </tr>
            
            </table>
            <?php echo form_close(); ?>
           <?php  	if($qr_log->num_rows()>0){ ?>
            
            <div style="float:left; background-color:#9CF; width:1235px;" id="srchby_divid" align="center">
           <fieldset><legend style="background-color:#CCC;">Search BY</legend>
           <table style="width:1215px;">
           <tr><td>
           <input type="text" name="slrsreach_name" id="slrsreach_name" class="seller_input" placeholder="Enter Seller Name">
           <div id="slr_nm_dv"><ul></ul></div>
           </td>
           <td>
           <!--<input type="text" name="catgsearch_name" id="catgsearch_name" class="seller_input" placeholder="Enter Category Name">-->
            <select name="catgids[]"  data-placeholder="Choose Category" class="chosen-select" id="catgids" multiple tabindex="4" required>
                								
                                            <?php if($srch_catg->num_rows()>0)
											foreach($srch_catg->result_array() as $rw){ ?>
                                            <option value="<?=$rw['lvl2'];?>"><?=$rw['lvlmain_name']." >> ".$rw['lvl1_name']." >> ".$rw['lvl2_name'];?></option>
                                         <?php } ?>
                                         
                                        </select>
           </td>
            <td>
          <!-- <input type="text" name="attrbsearch_name" id="attrbsearch_name" class="seller_input" placeholder="Enter attribute Name">-->
           
           <select name="allattrbids[]"  data-placeholder="Choose Attribute" class="chosen-select" id="allattrbids" multiple tabindex="4" required>
                								
                                            <?php if($srch_attrb->num_rows()>0)
											foreach($srch_attrb->result_array() as $rw_attrb){ ?>
                                            <option value="<?=$rw_attrb['attribute_group_id'];?>"><?=$rw_attrb['attribute_group_name'];?></option>
                                         <?php } ?>
                                         
            </select>
           </td>
           <td><input style="float:right; background-color:#666;" class="seller_buttons" type="button" value="Search Products" id="srchby_prod1" name="srchby_prod1" onClick="searchby_productfordelete()" ></td>
           </tr>
           </table>
           <span style="float:left; color:#900; font-weight:bold;"><i class="fa fa-info-circle" aria-hidden="true"></i>
 Product Display Result Upto 1000 Limit (Try For Multiple Times Search)</span>
           </fieldset>
           <div id="exlshow_error2" style="color:#F00; font-weight:bold; display:none;" ></div>
           </div>
           <?php } ?>
            </div>
            
             <div id="process_div" style="display:none; text-align:center"> <img src="<?php echo base_url().'images/loading1.gif' ?>" /></div>
            
            <div id="datadisplay_div" style="display:none"></div>
            
            
		</div> <!---main-content div end-->
</div>   <!---row content-header div end--->         