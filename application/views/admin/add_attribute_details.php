<?php
require_once('header.php');
?>
		
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
					<div class="row content-header"> 
                    	<div align="center" style="color:#0C6">  </div> 
						<div class="col-md-8"><b>Attribute Details</b></div>
						<div class="col-md-4 show_report">
							
                            
                            <a class='inline' href="#inline_content_add_address"><button type="button" class="all_buttons">Add New </button></a>
                            
						</div>
					</div>
					<div class="row mb10">					
						
						<div class="col-md-6 show_report">
							
						</div>
					</div>
					<div>
						<table class="multi_action">
							<tr>
								<td>
                                	<span><?=$attr_group_heading_res[0]->attribute_group_name;?> / <?=$attr_group_heading_res[0]->attribute_heading_name;?></span>
									<div class="right">
										<!--<input type="button" name="delete_attrtbute"  class="all_buttons" onClick="atrb_field_delete()"  value="Delete">-->
									</div>
								</td>
							</tr>
						</table>
					</div>
					<div>
						<table class="table table-bordered table-hover">
							<tr class="table_th">
                            	<th><input type="checkbox" name="selectall_attribute" id="selectall_attribute"></th>
								<th width="10%">Sl. No</th>
                                <th>Attribute Name</th>
                                <th>Action</th>
							</tr>
                            <?php
							$attr_field_row = $attr_fld_res->num_rows();
							if($attr_field_row > 0){
								$sl=0;
								foreach($attr_fld_res->result() as $fld_row){
									$sl++;
							?>
							<tr>
                            	<td width="3%"><input type="checkbox" name="attribute[]" id="attribute" value="<?=$fld_row->id;?>"></td>
                            	<td width="5%"><?=$sl;?></td>
                                <td><?=$fld_row->attribute_field_name;?></td>
                                <td>
                                	<?php /*?><a class='inline' href="#inline_content_edit_attr_fld<?=$sl;?>" href='<?php echo base_url().'admin/attribute/edit_attribute_field/'.$fld_row->id; ?>' title="Edit"><i class="fa fa-pencil-square-o"></i></a><?php */?>
                                    
<!--- light box div start here --->
<div style="display:none">
      <div id="inline_content_edit_attr_fld<?=$sl;?>" style="padding:10px; background:#fff;">
      	<div class="edit_address_dv">
         	<h4 class="title sn">Edit Attribute Field Name</h4>
<div class="col-md-12">
		<table class="edit_address_form">
            <tr>
                <td>Attribute Name : </td>
                <td><input type="text" class="text" size="32px" name="edt_attribute_name" id="edt_attribute_name<?=$sl;?>" value="<?=$fld_row->attribute_field_name;?>"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input  type="button" class="all_buttons" id="updt_attr_sav_btn<?=$sl;?>" value="Update" onClick="UpdateAttrName('<?=$fld_row->id; ?>',<?=$sl;?>);">
                </td>
            </tr>
      </table>

</div>
            
        </div>
      </div>
</div>
<!--- light box div end here --->                               
                                    
                                    
                                </td>
							</tr>
                            <?php
								} //end for foreach loop
							}else{
							?>
                            <tr><td align="center" colspan="3">No Record Found.</td></tr>
                            <?php } ?>
                            
                            <!--</form>-->
						</table>
					</div>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->
            
            

<div style="display:none">
      <div id="inline_content_add_address" style="padding:10px; background:#fff;">
      	<div class="edit_address_dv">
         	<h4 class="title sn">Add <?=$attr_group_heading_res[0]->attribute_heading_name;?> Attribute for <?=$attr_group_heading_res[0]->attribute_group_name;?></h4>
<div class="col-md-12">
		<table class="edit_address_form">
            <tr>
                <td>Attribute Name : </td>
                <td><input type="text" class="text" size="32px" name="attribute_name" id="attribute_name"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input  type="button" class="all_buttons" id="attr_sav_btn" value="Save" onClick="SaveAttrName(<?=$attr_group_heading_res[0]->attribute_heading_id; ?>,<?=$attr_group_heading_res[0]->attribute_group_id; ?>);">
                </td>
            </tr>
      </table>

</div>
            
        </div>
      </div>
</div>

<!-- Lightbox link start here-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>colorbox/colorbox.css" />
  <script src="<?php echo base_url(); ?>colorbox/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>colorbox/jquery.colorbox.js"></script>
  <script>
      $(document).ready(function(){
          $(".inline").colorbox({inline:true, width:"34%"});
      });
  </script>
<!-- Lightbox link end here-->


<script>
function SaveAttrName(attr_heading_id,attr_group_id){
	var attr_name = $('#attribute_name').val();
	if(attr_name == ''){
		alert('Attribute name field is required.');
		$('#attribute_name').focus();
		return false;
	}else{
		
		$('#attr_sav_btn').val('wait..');
		$.ajax({
			url:'<?php echo base_url(); ?>admin/attribute/save_atribute_name',
			method:'post',
			data:{heading_id:attr_heading_id,group_id:attr_group_id,name:attr_name},
			success:function(result){
				if(result == 'success'){
					window.location.reload(true);
				}
			}
		});
		
	}
}
</script>

<script>
$(document).ready(function(){
	$('#selectall_attribute').click(function(){
		$('input:checkbox').prop('checked', this.checked);
	});
});
</script>


<script language="JavaScript">
function atrb_field_delete()
{
		
		var artb_id = document.getElementsByName("attribute[]");
		var atrbid_count=artb_id.length;
		
		var count=0;
		for (var i=0; i<atrbid_count; i++) {
			if (artb_id[i].checked === true) 
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
			//else part start
			
			var ys = confirm("Do you want to delete records ?");
		if(ys){
			var atrb_id = $('input[name="attribute[]"]:checked').map(function(_, el){
        	return $(el).val();
    	}).get();
			
			$.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>admin/attribute/delete_attribute_field",
				data:{'atrb_id':atrb_id},
				success: function (data) {
					//$("#show").html(data);
					if(data == 'success'){
						window.location.reload(true);
					}
				}
			});
		
		}
			
	}
			
}


// update attribute field name script start here //
function UpdateAttrName(id,sl){
	var attr_fld = $('#edt_attribute_name'+sl).val();
	if(attr_fld == ''){
		alert('Please enter attribute field name.');
		$('#edt_attribute_name'+sl).focus();
	}else{
		$('#updt_attr_sav_btn'+sl).val('wait..');
		$.ajax({
			type:"POST",
			url:"<?php echo base_url(); ?>admin/attribute/edit_attribute_field",
			data:{'id':id,'attr_fld':attr_fld},
			success: function (data) {
				if(data == 'success'){
					window.location.reload(true);
				}
			}
		});
	}
}
// update attribute field name script end here //
</script>
   
<?php
require_once('footer.php');
?>			