<?php
require_once('header.php');
?>
<link href="<?php echo base_url();?>css/admin/uploadfile.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>colorbox/colorbox.css" />
<script src="<?php echo base_url(); ?>colorbox/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>colorbox/jquery.colorbox.js"></script>
<script>
	$(document).ready(function(){
		$(".inline").colorbox({inline:true, width:"50%"});
		$(".inline").colorbox({'overlayClose': false, 'escKey': false});
		
		// Multiple Image uploading
		if(window.File && window.FileList && window.FileReader) {
			$("#files").on("change",function(e) {
				var files = e.target.files ,
				filesLength = files.length ; //alert(filesLength); return false;
				if(filesLength < 1){
					$('#files').val('');
					alert("Please Upload atleast 5 Images.");
					return false;
				}else if(filesLength > 5){
					$('#files').val('');
					alert("Please Upload maximun 5 Images.");
					return false;
				}else{ 
					for (var i = 0; i < filesLength ; i++) {
						var f = files[i]
						var fileReader = new FileReader();
						fileReader.onload = (function(e) {
							var file = e.target;
							$("<img></img>",{
								class : "imageThumb",
								src : e.target.result,
								title : file.name
							}).insertAfter("#condn");
						});
						fileReader.readAsDataURL(f);
					}
				}
			});
		} else { alert("Your browser doesn't support to File API") }
		});	
</script>

<!-- style for slider Image upload  --->
<style>
.ajax-upload-dragdrop, .ajax-file-upload-statusbar{width: 400px !important;}

</style>
<!-- style for slider Image upload  --->

<!---Image uploading Script Start here --->
<script src="<?php echo base_url();?>js/img_uplod_script/jquery.uploadfile2.min.js"></script>

<script>
$(document).ready(function(){
	for(var sl = 1; sl<6; sl++){
		$("#uploadfile"+sl).uploadFile({
			url: "<?php echo base_url();?>admin/configuration/upload_slider_tmp_image",
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
			
			maxFileCount:1,
			//maxFileSize:100*1024,
			maxFileSize:100*500,
			//minFileSize:500*500,
			
			deleteCallback: function (data, pd) { 
				//for (var i = 0; i < data.length; i++) {
					$.post("<?php echo base_url();?>admin/configuration/delete_slider_tmp_image", {op: "delete",name: data},
						function (resp,textStatus, jqXHR) {
							//Show Message
							//alert("File Deleted");
						});
				//}
				pd.statusbar.hide(); //You choice.
			},
			//image download not mandatory
			downloadCallback:function(filename,pd){
				location.href="<?php echo base_url();?>admin/catalog/download_product_tmp_image?filename="+filename;
			}
		});
	}
});
</script>
<!---Image uploading Script end here --->


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
			<div class="row mb10">
			</div>
			
			<div>
            <?php if ($this->session->flashdata('error_message')) { ?>
            <div class="alert alert-danger"> <?= $this->session->flashdata('error_message') ?> </div>
           <?php } ?>
			
						<!--<div class="col-md-4 show_report">-->
							
							<!--<button type="button" onClick="window.location.href='<?php// echo base_url().'admin/catalog' ?>'" class="all_buttons">Back</button>-->
                           <!-- <button type="button" class="all_buttons" onClick="window.location.href='<?//php echo base_url().'admin/configuration/newslide' ?>'">Add new Slide</button>-->
				
			</div>
           
            <div class="row content-header">
           
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-10">
                        	&nbsp;
          <!-- <button type="submit" class="all_buttons">update</button>-->
            </div><h3>Slider Setting</h3></div>
            
                <div>Minimum Image Size to be Uploaded is 1218*413
                    <table class="table table-bordered table-hover">
                        <tr class="table_th">
                            <th width="30%">Category Name</th>
                            <th width="10%">Slider Images</th>
                            <th width="20%">Images Name</th>
                            <th width="20%">Action</th>
                            <th width="20%">Other</th>
                        </tr>
                           
                           <?php
                            $rows1 = $image_info->num_rows();
                              if($rows1 > 0){
								  $sl=0;
                              foreach($image_info->result() as $row) { //var_dump($row); exit;
							  	$sl++;
                                  $arr_img = explode(',', $row->box1_image);
                             ?> 
                         <tr>
                            <td><?=$row->category_name?></td>
                            <td>
                                <?php /*?>	<?php foreach($arr_img as $ky=>$val){?>  <?php */?>   
                                <img src="<?php echo base_url().'images/slider/'.$row->box1_image; ?>" class="list_img"> &nbsp; &nbsp;&nbsp;&nbsp;
                            </td>
                            <td><?=$row->box1_image;?></td>
                             <td><a class='inline' href="#inline_content_edit_banner_img<?=$sl;?>" title="Edit"><button class="seller_buttons">EDIT</button></a></td>
                             <td>
                                <div style="display:none">
                                    <div id="inline_content_edit_banner_img<?=$sl;?>" style="padding:10px; background:#fff;">
                                     <div class="edit_address_dv">
                                         <h4 class="title sn">Update Slider Image</h4>
                                            <div class="col-md-12">
                                            	<div class="form_view">
                                                <h3>Update Slider</h3>
                                                	<h4>Exist Slider Info</h4>
                                                	<table style="padding:10px;">
                                                    	<tr>
                                                        	<td>Image URL : </td>
                                                            <td><?php echo base_url()."images/slider/".$row->box1_image;?></td>
                                                        </tr>
                                                        <tr>
                                                        	<td>Category Name : </td>
                                                            <td><?=$row->category_name?></td>
                                                        </tr>
                                                    </table>
                                                	<h4>Slider Update form</h4>
<?php
   echo form_open_multipart('admin/configuration/update_slider');
?>
                                                        <table>
                                                            <tr>
                                                                <td width="20%">Choose a file : </td>
                                                                <td>
                                                                	<div id="uploadfile<?=$sl;?>">Upload</div>
                                                                    <!--<input type="file" name="slider_img" class="text2" value="">-->
                                                                    <input type="hidden" id="slider_id" class="slider_id" name="hidden_slider_id" value="<?=$row->box1_id?>">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Choose Category:</td>
                                                                <td>
                                                                    <select id="category_id<?=$sl;?>" class="text2" name="categoryid1">
                                                                        <option value="">--Select Category--</option>
                                                                            <?php $query=$this->db->query("SELECT * FROM view_catinfo"); 
                                                                                foreach($query->result() as $row1){  
                                                                            ?> 
                                                                        <option value="<?=$row1->lvl2?>"><?php echo $row1->lvl2_name; ?></option>
                                                                            <?php } ?> 
                                                                     </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="a-center"><button type="submit" class="seller_buttons" onClick="return validate_slider_image_form(<?=$sl;?>)">Update</button></td>
                                                            </tr>
                                                        </table>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                             </td>
                         </tr> 
               				 <?php  } ?>
                         </table>
					<?php } ?>
                </div> 
                
                
                
                
                      	
                       
			</div>  <!-- @end #main-content -->
		</div><!-- @end #content -->
<script>
	function validate_slider_image_form(sl){
		var images = $(".ajax-file-upload-container").text();
		var category_id = $("#category_id"+sl).val();  
		
		if(images == ''){
			alert("Please select a slider Image file.");
			return false;
		}else if(category_id == ""){
			alert("Please select a category.");
			return false;
		}
	}
</script>
<script>
///////User Persional Information script start here///////
/*$( document ).ready(function() {
    $('#nam1').hide();
});*/

function categoryid_function(){
	var category_id = $('#category_id').val();  
	var files = $('#files').val();
	var files_ext = $('#files').val().split('.').pop().toLowerCase();
	
	 if(category_id=="")
	{
		alert("Please choose a category");
		return false;
	}
	else if(files==""){
		
		alert("Please choose a related image");
		return false;
	}
	else if($.inArray(files_ext, ['gif','jpg','png','jpeg']) == -1){
		alert('Please enter a file with valid file extension gif|jpg|png|jpeg');
		return false;
	}
	}
</script>

<script>
    // SELECT SINGLE RADIO BUTTON ONLY.
    function check(objID) 
	{
		
        var rbSelEmp = $(document.getElementById(objID));
        $(rbSelEmp).attr('checked', true);      // CHECK RADIO BUTTON WHICH IS SELECTED.

        // UNCHECK ALL OTHER RADIO BUTTONS IN THE GRID.
        var rbUnSelect = 
            rbSelEmp.closest('table')
                .find("input[type='radio']")
                .not(rbSelEmp);

        rbUnSelect.attr('checked', false);
    }
   

</script>

 <script>
 function del(imageid)
 
 {
	// alert(imagename);
// document.getElementById('image_edit').style.display = 'none';
window.location.href="<?php echo base_url()?>admin/configuration/slider_box1_delete/"+imageid+"/";
 }
 </script>

<script type="text/javascript">
function Validate(){
   if(!validateForm()){
       alert("Something happened");
       return false;
   }
return true
}
function validateForm()
{
    var c=document.getElementsByTagName('input');
    for (var i = 0; i<c.length; i++){
        if (c[i].type=='checkbox')
        {
            if (c[i].checked){return true}
        }
    }
    return false;
}
</script>

<?php
require_once('footer.php');
?>	