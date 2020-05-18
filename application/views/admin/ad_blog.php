<?php
require_once('header.php');

?>
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
             <h4>Box1 Image</h4>Minimum Image Size to be Uploaded is 586*280
						<table class="table table-bordered table-hover">
                        <tr class="table_th"><td></td><td></td></tr>
                        <?php
						 $rows1 = $image_info->num_rows();
						  
						  if($rows1 > 0){
                        foreach($image_info->result() as $row){
							//$arr_img = explode(',',$row->box1_image);
							//print_r($arr_img);exit;
							?>
                        <tr>
                        <td width="5%">
                        
                        <?php echo $row->image_id; ?>
                        </td>
                        
                        <td  width="60%">  
                                         
          
          <img src="<?php echo base_url().'images/blog/'.$row->image_name; ?>" class="list_img" id="image_edit">
          
                   </td>
                   
                        </tr>
							<?php } ?><?php } ?>
                            <tr>
                            <td colspan="2">
                   <form action="<?php echo base_url(); ?>admin/configuration/upload_ad_blog/" enctype="multipart/form-data" method="post">                  
			
            
			<div class=" col-md-3 left">
			<input type="file" id="files" name="userfile" size="20" style=" position:absolute;" /></div>
           
			<div class="left">	 <button type="submit" class="all_buttons" onClick="">Update</button>
                     
            <input type="reset" class="all_buttons" value="Reset"> </div>
            

					
          </form>
                  </td>
                            </tr>
                           </table>
                          </div>
                        
</div>  <!-- @end #main-content -->
		</div><!-- @end #content -->

<script>

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