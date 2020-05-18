<?php
require_once("header.php");
?>
<script>

function valid()
{
	//$(document).ready(function(){
	
	
	if($('#attrib_grp_id').val()=='')
	{
		document.getElementById('show_error').innerHTML="Select Attribute Group Name";
		$('#attrib_grp_id').css('border','1px solid red');
		document.getElementById('attrib_grp_id').focus();
		return false;	
		
	}
	
	
	if($('#atrb_nm').val()=='')
	{
		document.getElementById('show_error').innerHTML="Enter Attribute Name";
		$('#atrb_nm').css('border','1px solid red');
		document.getElementById('atrb_nm').focus();
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
               
         <form action="<?php echo base_url().'admin/attribute/update_attribute_data' ?>" method="post">
                
					<div class="row content-header">
                    	<div class="col-md-2"><b>Edit Attribute</b></div>
						<div class="col-md-10">
                        	
						<!--<div class="col-md-4 show_report">-->
							<input type="reset" class="all_buttons" value="Reset">
							<button type="button" onClick="window.location.href='<?php echo base_url(); ?>admin/attribute/add_new_attribute'" class="all_buttons">Back</button>
						<!--</div>-->
                        </div>
					</div>
                    
                    <div class="clearfix"></div>
                   	
                    
                    
                    <!-- @start #right-content -->
                   <div align="center" style="color:#F00;" id="show_error"> </div>
					<div class="form_view">
						<h3>Create New Attribute </h3>
							<table>
                            <tr>
									<td style="width:20%;">Select  Attribute Group <sup>*</sup></td>
									<td><select class="text2" name="attrib_grp_id" id="attrib_grp_id">
                                    
                                    <option value="">--select--</option>
                                    <?php foreach($result->result() as $rs){ ?>
                                    <option value="<?php echo $rs->attribute_group_id; ?>" <?php if($atrb_data->attribute_group_id==$rs->attribute_group_id) {echo "selected" ;} ?> ><?php echo $rs->attribute_group_name;  ?></option>
                                    <?php } ?>
                                    </select> 
										
									</td>
								</tr>
                            
								<tr>
									<td style="width:20%;"> Attribute Name <sup>*</sup></td>
									<td>
                                    
                                    <input type="hidden" name="atrb_id" id="atrb_id" value="<?php echo $atrb_data->attribute_heading_id; ?>" >
                                    <input type="text" class="text2" name="atrb_nm" id="atrb_nm" value="<?php echo $atrb_data->	attribute_heading_name; ?>" > 
										
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