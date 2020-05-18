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
            
			<form action="<?php echo base_url(); ?>admin/configuration/upload_slider_box1/" enctype="multipart/form-data" method="post">
            
            
				<input type="file" id="files" name="userfile" size="20" style=" position:absolute;" />
				<input type="hidden" name="hidden_id" value=""/>
				<button type="submit" class="all_buttons">Save</button>
				<input type="reset" class="all_buttons" value="Reset"> 
            </form>
			</div>
           
                            
			</div>  <!-- @end #main-content -->
		</div><!-- @end #content -->

<script>
	$(document).ready(function(){
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
<?php
require_once('footer.php');
?>	