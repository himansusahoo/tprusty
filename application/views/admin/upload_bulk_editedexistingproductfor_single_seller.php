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
        
<script>
function dwln_bulkprodtemplate(selr_id)
{
	//var subcatgid=$('#subcategory_id').val();
	
	var subcatgid = $('input[name="subcategory_id"]:checked').map(function(_, el){
        	return $(el).val();
    	}).get();
		
	var subcategoryid = document.getElementsByName("subcategory_id"); 
		var subcategoryid_count = subcategoryid.length; 
		var count = 0;
		for (var i=0; i<subcategoryid_count; i++) {
			if (subcategoryid[i].checked === true) {
				count++;
			}
		}
	if(count==0){
	 $("#show_error").text('Please Select Atleast One Category');
	 $("#show_error").show();
	 return false;	
	}
	var attrb_id=$('#attribute_set').val();
	if(attrb_id=='')
	{
	$("#show_error").text('Please Select Atleast One Attribute Set');
	 $("#show_error").show();
	 return false;	
	}
    else{		
	window.location.href='<?php echo base_url().'admin/download_bulkproducttemp/bulk_productuploadtemplate/'?>' + subcatgid + '/' + attrb_id + '/' + selr_id ; 
	
	}
}


function select_product()
{
	var attrbid=$('#attribute_set').val();
	
	var subcatgid = $('input[name="subcategory_id"]:checked').map(function(_, el){
        	return $(el).val();
    	}).get();
		
	var subcategoryid = document.getElementsByName("subcategory_id"); 
		var subcategoryid_count = subcategoryid.length; 
		var count = 0;
		for (var i=0; i<subcategoryid_count; i++) {
			if (subcategoryid[i].checked === true) {
				count++;
			}
		}
	if(count==0){
	 $("#show_error").text('Please Select Atleast One Category For Product Access');
	 $("#show_error").show();
	 return false;	
	}
	
	if(attrbid=='')
	{
		$("#show_error").text('Please Select Atleast One Attribute Set');
	 	$("#show_error").show();
	 return false;	
	}
	
	/*$('#selected_productloader_div').css('display','block');
	$('#selected_productdiv').css('display','none');
	
	
	$.ajax({
					method:"POST",
					url:"<?php //echo base_url(); ?>admin/Upload_bulk_existingproduct/select_productfor_addexistingproduct",
					data:{subcatgid:subcatgid,attrbid:attrbid},
					success:function(data){			
						
						$('#selected_productdiv').css('display','block');
						$('#selected_productdiv').html(data);
						$('#selected_productloader_div').css('display','none');
						
						
					}
				});	*/
	
			
}

/*function select_attrbset(catg_id)
{
	
	document.getElementById('hidden_subcatgtxtbox').value=catg_id;
		
	$('#attrbcatgloader').css('display','block');
	$('#product_submit').css('display','none');
	$.ajax({
					method:"POST",
					url:"<?php //echo base_url(); ?>admin/Upload_bulk_existingproduct/select_attrbsetascategorywise",
					data:{catg_id:catg_id},
					success:function(data){			
						
						$("#attrb_ascatgwise").html(data);
						$('#product_submit').css('display','block');
						$('#attrbcatgloader').css('display','none');
						//$('#hidden_subcatgtxtbox').val('');
						
					}
				});		
}*/



function select_attrbset(catg_id,seler_id)
{
	document.getElementById('hidden_subcatgtxtbox').value=catg_id;
	
	$('#attrbcatgloader').css('display','block');
	$('#product_submit').css('display','none');
	
	$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/Bulkproduct_edit/select_sellerid",
					data:{catg_id:catg_id,seler_id:seler_id},
					success:function(data){			
						
						$("#attrb_ascatgwise").html(data);
						$('#product_submit').css('display','block');
						$('#attrbcatgloader').css('display','none');
						
						
					}
				});		
}



/*$(document).ready(function(){
    $('#prod_searchbychkbox').change(function(){
        if(this.checked)
            $('#prodsearchby_div').fadeIn('slow');
        else
            $('#prodsearchby_div').fadeOut('slow');

    });
});*/




</script>
        
     <div class="main-content" style="padding:40px 10px;">   
 <div class="row content-header" style="background-color:#CCC;">
				<h3 style="margin-top:0px; font-weight:bold;"><span style="color:#F00">Edit Bulk Existing Products</span></h3>
                
                 <span style="float:right;">   
                 <a id="upload_log" class='seller_buttons' href="<?php echo base_url().'admin/Bulkexistingproduct_edit/uploadlog_extingproductlist/'.$seller_id ?>" style="cursor:pointer;" >
           				<i class="fa fa-list-alt" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Upload Log 
           		</a>
            </span>  
                <br><br>
                <div class="exist_prod_new_list" align="right"><button type="button" onclick="window.location.href='<?php echo base_url(). 'admin/Bulkexistingproduct_edit/bulk_existingeditproductupload_panel/'.$seller_id?>' " style='width:260px;'>Bulk Existing Edited Products Upload &nbsp;<i class="fa fa-upload" aria-hidden="true"></i>
</button>  </div>
             <?php /*?><span style="float:right;">   
                 <a id="product_submit" class='seller_buttons' href="<?php echo base_url().'admin/Download_bulkproducttemp/uploadlog_list/'.$seller_id ?>" style="cursor:pointer;" >
           				<i class="fa fa-list-alt" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Upload Log 
           		</a>
            </span>  <?php */?>  
			</div> 
  
  <!----------------------------------------------Category Listing Start----------------------------->
 <!-- collapsibleCheckboxTree -->
<script type="text/javascript" src="<?php echo base_url().'js/jquery.collapsibleCheckboxTree.js' ?>"></script>

<script type="text/javascript">
jQuery(document).ready(function(){
	$('ul#example').collapsibleCheckboxTree();
});
</script>
         
<?php 
$formarr=array('onSubmit'=>'return select_product()');
echo form_open('admin/Bulkexistingproduct_edit/select_productfor_editexistingproduct',$formarr); ?> 
 
  <div id="show_error" align="center" style="color:#F00; display:none;" > </div> 
										<!--<div class="left">--> <div class="left-sidebar" style="width:18%;">
											<ul id="example">
                                            
<?php 
/*$query = $this->db->query("SELECT a. * FROM category_indexing a INNER JOIN category_master b 
ON a.category_id = b.category_id WHERE b.active_status = 'yes' AND a.parent_id = 0 ");
$categories = $query->result();*/
if($editedprod_catg!='')
{
	$prodattg_arr=explode(',',$editedprod_catg);
	
foreach($categories as $category){ ?>

<?php if(in_array($category->category_id,$prodattg_arr)) { ?>
		<li id="category_li">
													<!--<input id="subcategory_id" type="radio" name="subcategory_id" value="<?php// echo $category->category_name; ?>" disabled />--><?php echo stripslashes($category->category_name); ?>
												
		<ul>

      <?php $qr=$this->db->query("select * from category_indexing where parent_id='$category->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct=$qr->num_rows();
		
	  	if($ct>0){ ?>
        
        <?php 
			foreach($qr->result() as $rs){ ?> <!--level-2 -->
            <?php if(in_array($rs->category_id,$prodattg_arr)) { ?>
       <li>		
			<input type="hidden" id="subcategory_id" name="subcategory_id" value="<?php echo $rs->category_id; ?>" />
            
		 <?php echo	stripslashes($rs->category_name);?>   
         
         <ul>
         <!--level-3-->
          <?php $qr1=$this->db->query("select * from category_indexing where parent_id='$rs->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct1=$qr1->num_rows();
		
	  	if($ct1>0){ ?>
        
        <?php 
			foreach($qr1->result() as $rs1){ 	?>
        <?php if(in_array($rs1->category_id,$prodattg_arr)) { ?>    
            
       <li>		
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs1->category_id; ?>" onClick="select_attrbset('<?php echo $rs1->category_id; ?>','<?php echo $seller_id?>')" />
            
				
		 <?php echo	stripslashes($rs1->category_name);?>&nbsp;
        
         
         <ul>
         <!--level-4-->
          <?php $qr2=$this->db->query("select * from category_indexing where parent_id='$rs1->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct2=$qr2->num_rows();
		
	  	if($ct2>0){ ?>
        
        <?php 
			foreach($qr2->result() as $rs2){ ?>
       <li>		
			<input type="hidden" id="subcategory_id" name="subcategory_id" value="<?php echo $rs2->category_id; ?>" />
			
		 <?php echo	stripslashes($rs2->category_name);?> 
         
         <ul>
         <!--level-5-->
          <?php $qr3=$this->db->query("select * from category_indexing where parent_id='$rs2->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct3=$qr3->num_rows();
		
	  	if($ct3>0){ ?>
        
        <?php 
			foreach($qr3->result() as $rs3){ ?>
       <li>		
			<input type="hidden" id="subcategory_id" name="subcategory_id" value="<?php echo $rs3->category_id; ?>" />
			
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
			<input type="hidden" id="subcategory_id" name="subcategory_id" value="<?php echo $rs4->category_id; ?>" />
					
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
			<input type="hidden" id="subcategory_id" name="subcategory_id" value="<?php echo $rs5->category_id; ?>" />
					
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
			<input type="hidden" id="subcategory_id" name="subcategory_id" value="<?php echo $rs6->category_id; ?>" />
					
		 <?php echo	$rs6->category_name;?>
         
       
          <ul>
         <!--level-9-->
          <?php $qr7=$this->db->query("select * from category_indexing where parent_id='$rs6->category_id' "); 
	  	//$rw=$qr->result();
	  	$ct7=$qr7->num_rows();
		
	  	if($ct7>0){ ?>
        
        <?php 
			foreach($qr7->result() as $rs7){?>
       <li>		
			<input type="hidden" id="subcategory_id" name="subcategory_id" value="<?php echo $rs7->category_id; ?>" />
					
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
			<input type="hidden" id="subcategory_id" name="subcategory_id" value="<?php echo $rs8->category_id; ?>" />
				
		 <?php echo	$rs8->category_name;?>
        
               
        </li> <?php } ?>  <?php } ?> </ul>              
                      
        </li> <?php } ?>  <?php } ?> </ul>
        
        </li> <?php } ?>  <?php } ?> </ul>       
                      
        </li> <?php } ?>  <?php } ?> </ul>
                      
        </li> <?php } ?>  <?php } ?> </ul>
          
        </li> <?php } ?>  <?php } ?> </ul>
         
        </li> <?php } ?>  <?php } ?> </ul>
             
        </li> <?php
		
		} //level3 categorgy display or not condition end
		 } ?>  <?php } ?> </ul>
         
        </li> <?php  
			} //level2 categorgy display or not condition end
		 } ?>  <?php } ?> </ul>
     </li>
     <?php } // main categorgy display or not condition end ?>
        <?php } ?>
  </ul>
  
<?php }
else
{?>
<span style="color:#F00; text-align:center;"> No Category Found! </span>
<?php } ?>  
		
  
  
										</div><!-- @end left-sidebar -->
  
  <!---------------------------------------------Category Listing End-------------------------------->
            
    <!-- @start #right-content -->
         
           <div class="right-cont" style="width:80%;">
           <div id="show_error" align="center" style="color:#F00;"> </div>
           <div class="form_view">
						<h3>Select Attribute Set</h3>
                        
							<table>
								
                                
                                 <tr>
									<!--<td>Attribute Set Type <sup>*</sup> </td>-->
									<td>
                                    	<?php /*?><select class="seller_input" id="attribute_set" name="attribute_set" onChange="select_product(this.value)" >
														<option value="">--Choose Attribute--</option>
													<?php 
													
													$attribute = $attrbset->result_array(); 
													if($attribute) :
														foreach($attribute as $row) : 
													?>
														<option value="<?php echo $row['attribute_group_id']; ?>"><?php echo $row['attribute_group_name']; ?></option>
													<?php endforeach;
														endif;
													?>
													</select><?php */?>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <span id="attrb_ascatgwise">
                                                    
                                                     </span> 
                                                 <input type="hidden"  id="hidden_subcatgtxtbox" name="hidden_subcatgtxtbox">   
                                               <button type="submit" id="product_submit" class="seller_buttons" style="display:none; float:right;" >
                               					<i class="fa fa-search" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Search Products
                               				   </button>
                                                      
                                                    <!--<button id="product_submit" class="seller_buttons" onClick="" >-->
                                                   <!--<button id="product_submit" class="seller_buttons" onclick="window.location.href='<?php //echo base_url().'admin/catalog/export_toexcel'?>'" > -->
           <!--<i class="fa fa-download" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Download Template 
           </button>-->
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <!--<a id="product_submit" class='seller_buttons inline' href='#inline_content_add_cur_fld'  > -->
            
            <!-- <a id="product_submit" class='seller_buttons' onClick="file_uploadivdisplay()" style="cursor:pointer;" >-->
            <!-- <a id="product_submit" class='seller_buttons' style="cursor:pointer;" >
           <i class="fa fa-upload" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Upload Template 
           </a>-->
                                   
                                    <span style="display:none; color:#F00;" id="attrbcatgloader">! Please Wait Attribute Set is Populating...<img src="<?php echo base_url().'images/progress.gif' ?>"></span>
                                   
                                    </td>
								</tr>
                                
                                <!--<tr>
                                <td colspan="2" style="color:#093; font-weight:bold">
                               <input type="checkbox" name="prod_searchbychkbox" id="prod_searchbychkbox"> &nbsp; Products Search By
                              
                              <div id="prodsearchby_div" style="color:#666; background-color:#9CF; width:100%;display:none;">
                            
                             
                             <table>
                             <tr>
                             <td>Product Name <input type="text" class="seller_input" name="prod_name" id="prod_name" style="width:285px"></td>
                              <td>SKU <input type="text" class="seller_input" name="prod_name" id="prod_name" style="width:100px"></td>
                               <td>From Date <input type="text" class="seller_input" name="prod_name" id="prod_name" style="width:100px"></td>
                               <td>To Date <input type="text" class="seller_input" name="prod_name" id="prod_name" style="width:100px"></td>
                               <td> <button id="product_submit" class="seller_buttons" onClick="" >
                               <i class="fa fa-search" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Apply</button></td>
                             </tr>
                             </table>
                              	
                              </div>
                              
                                 </td>
                                </tr>-->
                                
                               
                               
							</table>
					</div>
                    
                    
                    <span style="display:none; color:#F00;" id="selected_productloader_div">! Please Wait Product is Populating...<img src="<?php echo base_url().'images/progress.gif' ?>"></span>
                    <div id="selected_productdiv"  style="display:none;"></div>
 <?php echo form_close(); ?>                   
                    <!---------------------------------------file upload div start---------------------------------------->
       <div id="file_uploaddiv" align="center" class="alert alert-info alert-dismissable" style="display:none;">
       
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
			//$attributes = array('class' => 'cmxform', 'id' => 'myForm', 'method' => 'POST' );
			//echo form_open_multipart('admin/Upload_bulkproduct/upload_prodexcel', $attributes);
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
               <!-- <input type="submit" value="Upload" id="exl_upload" name="exl_upload"  style="background-color:#0C6;" onClick="return excelValidate()">-->
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
 <!--- light box div start here --->
<?php /*?><div style="display:none">
      <div id="inline_content_add_cur_fld" style="padding:10px; background:#fff;">
      	<div class="edit_address_dv">
         	<h4 class="title sn">Upload File </h4>
<div class="col-md-12">
<?php
			$attributes = array('class' => 'cmxform', 'id' => 'myForm', 'method' => 'POST' );
			echo form_open_multipart('admin/Upload_bulkproduct/upload_prodexcel', $attributes);
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
                <div id="loader_div" style="display:none; text-align:center;"> <img src="<?php echo base_url().'images/loading1.gif' ?>" /> 
                                                </div>
               </td>
            </tr>
            
              <tr>
                <td colspan='2' align="right"> 
                
               <!--<input type="button" value="Upload" id="exl_upload" name="exl_upload" onClick="upload_excelfile()" style="background-color:#0C6;"> -->
                <input type="submit" value="Upload" id="exl_upload" name="exl_upload"  style="background-color:#0C6;" onClick="return excelValidate()">
                <input type="button" value="Cancel" id="exl_uploadcancel" name="exl_uploadcancel" style="background-color:#FCF;">
               </td>
            </tr>
            
      </table>
<?php echo form_close(); ?>

<div id="excelrec_statisdiv" style="display:none"></div>
</div>
            
        </div>
      </div>
</div><?php */?>
<!--- light box div end here ---> 

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
            url :'<?php //echo base_url().'admin/Upload_bulkproduct/upload_prodexcel' ?>',  
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
					url:"<?php //echo base_url(); ?>admin/Upload_bulkproduct/upload_afterconfirmprodexcel",
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