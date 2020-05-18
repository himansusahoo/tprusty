<?php
	require_once('header.php');
?>

<div id="content">
		<div class="top-bar">
			<div class="top-left">
				<?php include 'sub_sellers.php';?>
			</div>
			<div class="top-right">
				<?php include 'top_right.php';?>
			</div>
		</div>
   <br>
   <br>     
        <!-- Lightbox link start here-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>colorbox/colorbox.css" />
   <link rel="stylesheet" href="<?php echo base_url(); ?>css/progressbar/css/style.css">
<style>
 #process_div{display:none; text-align:center;}
</style> 
  <!--<link href='http://fonts.googleapis.com/css?family=PT+Sans+Caption:400,700' rel='stylesheet' type='text/css'>-->
  <!--<script src="<?php //echo base_url(); ?>colorbox/jquery.min.js"></script>
  <script src="<?php //echo base_url(); ?>colorbox/jquery.colorbox.js"></script>-->
  <script>
      //$(document).ready(function(){
//          $(".inline").colorbox({inline:true, width:"50%",height:"50%"});
//      });
  </script>
<!-- Lightbox link end here-->
        

     <div class="main-content" style="padding:40px 10px;">   
 <div class="row content-header" style="background-color:#CCC;">
				<h3 style="margin-top:0px; font-weight:bold;"><span style="color:#F00">Upload Bulk Existing Products</span></h3>
             <?php /*?><span style="float:right;">   
                 <a id="product_submit" class='seller_buttons' href="<?php echo base_url().'admin/Download_bulkproducttemp/uploadlog_list/'.$seller_id ?>" style="cursor:pointer;" >
           				<i class="fa fa-list-alt" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Upload Log 
           		</a>
            </span>  <?php */?>  
			</div> 
  
  <!----------------------------------------------Category Listing Start----------------------------->
 
         

 
  <div id="show_error" align="center" style="color:#F00; display:none;" > </div> 
										<!--<div class="left">--> 
                                       <!-- <div class="left-sidebar" style="width:18%;">
											
  
  
										</div>-->
                                        
                                        <!-- @end left-sidebar -->
  
  <!---------------------------------------------Category Listing End-------------------------------->
            
    <!-- @start #right-content -->
         
          <!-- <div class="right-cont" style="width:80%;">-->
           <div class="right-cont" style="width:100%;">
          
           <div class="form_view">
						<h3>Upload Bulk Eixsting Products </h3>
                        
							<table>
								
                                
                                 <tr>
									<!--<td>Attribute Set Type <sup>*</sup> </td>-->
									<td>
                                    	
           
            <!--<a id="product_submit" class='seller_buttons inline' href='#inline_content_add_cur_fld'  > 
            
             <a id="product_submit" class='seller_buttons' onClick="file_uploadivdisplay()" style="cursor:pointer;" >
             <a id="product_submit" class='seller_buttons' style="cursor:pointer;" >
           <i class="fa fa-upload" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Upload Template 
           </a>-->
                                    </td>
								</tr>
                               
							</table>
					</div>
                    
                    
                    
        
                    <!---------------------------------------file upload div start---------------------------------------->
       <div id="file_uploaddiv" align="center" class="alert alert-info alert-dismissable" style="display:block; background-color:#CCC;">
       
               <!--------------------------progress bar code start-------------------------->
               	<div class="checkout-wrap" style="height:70px;">
                          <ul class="checkout-bar">
                            <li class="visited first"> File Validation </li> 
                            <li class="visited first">QC Checked</li>                           
                            <li class="visited first">Uplaoding</li>                            
                            <!--<li class="next">Review & Payment</li>
                            <li class="active">Complete</li>-->
                               
                          </ul>
				</div>
            <div class="clearfix"> &nbsp; </div>   		
               <!--------------------------progress bar code end-----------------------------> 
        
        <h4 class="title sn">Upload File </h4> 
        <?php
			$attributes = array('class' => 'cmxform', 'id' => 'myForm', 'method' => 'POST' );
			echo form_open_multipart('admin/Upload_existingproduct_excelfile/upload_extprodexcel', $attributes);
			
			?>  
        <table class="edit_address_form">
       <tr>
       <td colspan="2">
        <div id="exlshow_error" align="center" style="color:#F00; display:none;" > </div> 
       </td>
        </tr>
            <tr>
                <td>Select a file to upload </td>
                <td>
                <input type="hidden" value='<?=$seller_id?>' name='hdntxt_sellerid' id='hdntxt_sellerid'>
                <input  type="file" class="text" size="32px" id="userfile" name="userfile" ></td>
            </tr>
            
            <tr>
                
                <td colspan='2' align="center">
                <div id="process_div"> <img src="<?php echo base_url().'images/loading1.gif' ?>" /></div>
               </td>
            </tr>
            
              <tr>
                <td colspan='2' align="right"> 
                
               <input type="button" value="Upload" id="exl_upload" name="exl_upload" onClick="upload_excelfile()" style="background-color:#0C6;"> 
                <!--<input type="submit" value="Upload" id="exl_upload" name="exl_upload"  style="background-color:#0C6;" onClick="return excelValidate()">-->
                <input type="button" value="Cancel" id="exl_uploadcancel" name="exl_uploadcancel" style="background-color:#FCF;">
               </td>
            </tr>
            
      </table>
          <?php echo form_close() ?> 
          
          <div id="excelrec_statisdiv" style="display:none"></div>

       </div>    
           
           <!----------------------------------------file upload div end------------------------------------------>

           
           
          </div>
				
			</div>
            </div>
            <div class="clearfix"> </div>
            <!-- @end #right-content -->         
        
          
</div>  <!-------div content main end tag-------->                  
</div>  <!-------div content end tag-------->       


<script>

function file_uploadivdisplay()
{	
	$('#file_uploaddiv').css('display','block');
   

}

function upload_excelfile()
{  
 
	 var formData = new FormData( $("#myForm")[0] );
	 var userfl = $("input[name='userfile']").val();
	 var ext = userfl.substring(userfl.lastIndexOf('.') + 1);
	 
	 $("#excelrec_statisdiv").css('display','none');
	 
	 
	if(userfl=='')
	{
		$("#excelrec_statisdiv").css('display','none');
		$("#exlshow_error").text('Please Select One File To Upload');
	 	$("#exlshow_error").show();
	 	return false;	
	}
	else if(ext != "xls"){
		
		$("#excelrec_statisdiv").css('display','none');
		$("#exlshow_error").text('Invalid File Type, Please Select Excel(.xls) File');
	 	$("#exlshow_error").show();
		return false;
	}
	else if(ext == "xls" && userfl!='')
	{ 
		$('#process_div').css('display','block');
			$.ajax({
            url :'<?php echo base_url().'admin/Upload_existingproduct_excelfile/upload_extprodexcel' ?>',  
            type : 'POST',
            data : formData,
            async : true,
            cache : false,
            contentType : false,
            processData : false,
            success : function(data) {
                
				$("input[name='userfile']").val('');
				$("#exlshow_error").text('');
				$("#excelrec_statisdiv").css('display','block');
				$("#excelrec_statisdiv").html(data);
				$('#process_div').css('display','none');
            }
        });
	}
		
}

function confirm_tosaveproduct(fileuploadid,confsts)
{
	$('#process_div').css('display','block');
	$("#excelrec_statisdiv").css('display','none');
	$("#exlshow_error").css('display','none');
	$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/Upload_existingproduct_excelfile/upload_exitingproduct_afterconfirmprodexcel",
					data:{fileuploadid:fileuploadid,confsts:confsts},
					success:function(data){			
						
						$("#excelrec_statisdiv").html(data);
						$('#process_div').css('display','none');
						$("#excelrec_statisdiv").css('display','block');
						
					}
				});	
	
}

</script>  

<script>
function excelValidate(){
	var file_name = $("input[name='userfile']").val();
	
	var ext = file_name.substring(file_name.lastIndexOf('.') + 1);
	if(file_name == ''){
		alert('Please select an excel file to upload');
		return false;
	}else if(ext != "xlsx" && ext != "xls"){
		alert('Invalid file extension');
		return false;
	}
}
</script>   

  
<?php
	require_once('footer.php');
?>	