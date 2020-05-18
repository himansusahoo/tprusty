<?php
require_once('header.php');
?>

<link href="<?php echo base_url();?>css/admin/uploadfile.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>colorbox/colorbox.css" />
<script src="<?php echo base_url(); ?>colorbox/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>colorbox/jquery.colorbox.js"></script>

<!-- style for slider Image upload  --->
<style>
.ajax-upload-dragdrop, .ajax-file-upload-statusbar{width: 400px !important;}
</style>
<!-- style for slider Image upload  --->

<!---Image uploading Script Start here --->
<script src="<?php echo base_url();?>js/img_uplod_script/jquery.uploadfile1.min.js"></script>

<script>
$(document).ready(function(){
	$("#uploadfile").uploadFile({
		url: "<?php echo base_url();?>admin/configuration/upload_tmp_box3_image",
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
				$.post("<?php echo base_url();?>admin/configuration/delete_tmp_box3_image", {op: "delete",name: data},
					function (resp,textStatus, jqXHR) {
						//Show Message
						//alert("File Deleted");
					});
			//}
			pd.statusbar.hide(); //You choice.
		},
		//image download not mandatory
		//downloadCallback:function(filename,pd){
			//location.href="<?php echo base_url();?>admin/catalog/download_product_tmp_image?filename="+filename;
		//}
	});
});
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
			<div class="row mb10">
			</div>
			
			<div>
            <?php /*?><button type="button" class="all_buttons" onClick="window.location.href='<?php echo base_url().'admin/configuration/new_slide_box1' ?>'">Add new Slide</button><?php */?>
            
             
              </div>
           
            <div class="row content-header">
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-10">
                        	&nbsp;
          <!-- <button type="submit" class="all_buttons">update</button>-->
            </div><h3>Block3 Setting</h3></div>
            
            <div>
             <h4>Box1 Image</h4>Minimum Image Size to be Uploaded is 1150*185
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
							foreach($image_info->result() as $row){
						?>
                        <tr>
							<td><?=$row->category_name?></td>
							<td>   
								<img src="<?php echo base_url().'images/subpage3/'.$row->image_name; ?>" class="list_img"> &nbsp; &nbsp;&nbsp;&nbsp;
							</td>
							<td><?=$row->image_name;?></td>
							<td><a class='inline' href="#inline_content_edit_banner_img" title="Edit"><button class="seller_buttons">EDIT</button></a></td>
							<td>
                            	<div style="display:none">
                                	<div id="inline_content_edit_banner_img" style="padding:10px; background:#fff;">
                                    	<div class="edit_address_dv">
                                        	<h4 class="title sn">Update Block Images</h4>
                                            <div class="col-md-12">
                                            	<div class="form_view">
                                                	<h3>Update Box Image</h3>
                                                    	<h4>Exist Slider Info</h4>
                                                        <table style="padding:10px;">
                                                            <tr>
                                                                <td>Image URL : </td>
                                                                <td><?php echo base_url()."images/subpage/".$row->image_name;?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Category Name : </td>
                                                                <td><?=$row->category_name?></td>
                                                            </tr>
                                                        </table>
														<h4>Slider Update form</h4>
<?php
   echo form_open_multipart('admin/configuration/update_box3_image');
?>		
														<table>
                                                            <tr>
                                                                <td width="20%">Choose a file : </td>
                                                                <td>
                                                                	<div id="uploadfile">Upload</div>
                                                                    <!--<input type="file" name="slider_img" class="text2" value="">-->
                                                                    <input type="hidden" id="slider_id" class="slider_id" name="hidden_slider_id" value="<?=$row->image_id?>">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Choose Category:</td>
                                                                <td>
                                                                    <select id="category_id" class="text2" name="categoryid2">
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
                                                                <td colspan="2" class="a-center"><button type="submit" class="seller_buttons" onClick="return validate_box3_image_form()">Update</button></td>
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
						<?php } ?></table><?php } ?>
							
                          </div>
                        
</div>  <!-- @end #main-content -->
		</div><!-- @end #content -->

<script>
function validate_box3_image_form(){
	var images = $(".ajax-file-upload-container").text();
	var category_id = $("#category_id").val(); 
	
	if(images == ''){
		alert("Please select a slider Image file.");
		return false;
	}else if(category_id == ""){
		alert("Please select a category.");
		return false;
	}
}

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
	$(document).ready(function(){
		$(".inline").colorbox({inline:true, width:"50%"});
		$(".inline").colorbox({'overlayClose': false, 'escKey': false});
		
		// Multiple Image uploading
		if(window.File && window.FileList && window.FileReader) {
			$("#files").on("change",function(e) {
				var files = e.target.files ,
				filesLength = files.length ; //alert(filesLength); return false;
				if(filesLength > 2){
					$('#files').val('');
					alert("Please Upload maximum 2 Images.");
					return false;
				}/*else if(filesLength > 5){
					$('#files').val('');
					alert("Please Upload maximun 5 Images.");
					return false;
				}*/else{ 
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
        <script>
         function replaceimage(imageid,imagename)
 
 {
	 alert(imagename);
// document.getElementById('image_edit').style.display = 'none';
window.location.href="<?php echo base_url()?>admin/configuration/box1_delete/"+imageid+"/"+imagename;
 }
 </script>
<?php
require_once('footer.php');
?>	