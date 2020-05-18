<?php
require_once("header.php");
?>
<script>

function valid()
{
	//$(document).ready(function(){
	if($('#atrb_grp_nm').val()=='')
	{
		document.getElementById('show_error').innerHTML="Enter Group Name";
		$('#atrb_grp_nm').css('border','1px solid red');
		document.getElementById('atrb_grp_nm').focus();
		return false;	
		
	}
	
	
	//});
		
}
</script>

<div id="content">    
		<div class="top-bar">
			<div class="top-left">
				<?php include 'sub_catalog.php'; ?>
			</div>
			<div class="top-right">
				<?php include 'top_right.php'; ?>
			</div>
		</div>  <!-- @end top-bar  -->
		<div class="main-content">
               
         <form action="<?php echo base_url().'admin/Attribute/insert_new_attribute_group' ?>" method="post">
                
					<div class="row content-header">
                    	<div class="col-md-2"><b>New Attribute Group</b></div>
						<div class="col-md-10">
                        	
						<!--<div class="col-md-4 show_report">-->
							<input type="reset" class="all_buttons" value="Reset">
							<button type="button" onClick="window.location.href='<?php echo base_url(); ?>admin/Attribute'" class="all_buttons">Back</button>
						<!--</div>-->
                        </div>
					</div>
                    
                    <div class="clearfix"></div>
                   	
                    
                    
                    <!-- @start #right-content -->
                   <div align="center" style="color:#F00;" id="show_error"> </div>
					<div class="form_view">
						<h3>Create New Attribute Group</h3>
							<table>
								<tr>
									<td style="width:20%;"> Attribute Group Name <sup>*</sup> </td>
									<td><input type="text" class="text2" name="atrb_grp_nm" id="atrb_grp_nm" > 
										
									</td>
								</tr>
								
								<tr>
									<td></td>
									<td><input type="submit" id="save" name="save"  class="btn btn-warning" value="Save" onClick="return valid()" /></td>
								</tr>
							</table>
                            </div>
                           
                          
                          <div class="clearfix"> </div>
                          <!-- @end #right-content -->
						</form>
        
        
      	</div><!-- @end #content -->
			</div><!-- @end #content -->
		</div><!-- @end #w -->

	</body>
</html>