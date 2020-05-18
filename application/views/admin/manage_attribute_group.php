<?php
require_once('header.php');
?>		
		<!--- Zebra_Datepicker link start here ---->
		<link href="../Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
		<link href="../Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">
		<script src="../Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script>
		<script src="../Zebra_Datepicker-master/examples/public/javascript/core.js"></script>
		<script src="../Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
		<!--- Zebra_Datepicker link end here ---->

		<style>
			.Zebra_DatePicker_Icon{left: 10px !important; top: 0px !important;}
		</style>
        
        
        <script>
$(document).ready(function(){
$('#selectall_attribute_group').click(function(){
$('input:checkbox').prop('checked', this.checked);
});
});
</script>
		<script language="JavaScript">
//function toggle(source) {
//  checkboxes = document.getElementsByName('attribute_group1');
//  for(var i=0, n=checkboxes.length; i<n;i++) {
//    checkboxes[i].checked = source.checked;
//  }
//}


function atrb_group_delete()
{
		
		var artb_id = document.getElementsByName("attribute_group[]");
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
			var atrb_grp_id = $('input[name="attribute_group[]"]:checked').map(function(_, el){
        	return $(el).val();
    	}).get();
			
			$.ajax({
				type:"POST",
				url:"<?php echo base_url(); ?>admin/attribute/delete_attribute_group",
				data:{'atrb_groupid':atrb_grp_id},
				success: function (data) {
					//$("#show").html(data);
					if(data == 'success'){
						window.location.reload(true);
					}
				}
			});
		
		}
			
		//else part end	
			
		}
			
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
					<div class="row content-header"><?php if($msg==true){ ?><div align="center" style="color:#0C6"> <?php  echo $msg ?> </div> <?php } ?>
						<div class="col-md-8"><b>Attribute Group List</b></div>
						<div class="col-md-4 show_report">
							<!--<button type="button" class="all_buttons" onClick="window.location.href='<?php// echo base_url().'admin/catalog/addnew_product_form1' ?>'">Add Product</button>-->
                            
                            <button type="button" class="all_buttons" onClick="window.location.href='<?php echo base_url().'admin/attribute/add_new_attribute_group' ?>'">Add Attribute Group</button>
                            
						</div>
					</div>
					<!--<div class="row mb10">
						<div class="col-md-6">
							Page 
							<span class="glyphicon glyphicon-chevron-left arrow_button"></span>
							<input type="text" name="page" class="input_text" value="1">
							<span class="glyphicon glyphicon-chevron-right"></span>
							of 1 pages <span class="separator">|</span> View
							<select> 
								<option selected="selected" value="">20</option>
								<option>30</option>
								<option>50</option>
								<option>100</option>
								<option>200</option>
							</select>
							per page <span class="separator">|</span> Total 11 records found
						</div>-->
						<form action="<?php echo base_url().'admin/attribute/filter_attribute_group' ?>" method="post">
						<div class="col-md-6 show_report">
							<input type="submit" class="all_buttons" value="Search">
                            <input type="reset" class="all_buttons" value="Reset Filter">
						</div>
					</div>
					<div>
						<table class="multi_action">
							<tr>
								<!--<td>
									<a href="#">Select All</a>
									<span class="separator">|</span>
									<a href="#">Unselect All</a>
									<span class="separator">|</span>
									<a href="#">Select Visible</a>
									<span class="separator">|</span>
									<a href="#">Unselect Visible</a>
									<span class="separator">|</span>
									0 items selected
								</td>-->
								<td>
									<div class="right">
										<!--<form>-->
											<table>
												<tr>
													
													<td>
														<!--<input type="button" name="delete" class="all_buttons" value="Delete"  onClick="atrb_group_delete()">-->
													</td>
													
												</tr>
											</table>
										<!--</form>-->
									</div>
								</td>
							</tr>
						</table>
					</div>
					<div>
						<table class="table table-bordered table-hover">
							<tr class="table_th">
								<th>Select All</th>
								<th>Attribute Group Id</th>
								<th>Attribute Group Name</th>
								<th>Action</th>
							</tr>
							<tr class="filter_tr">
								<td>
									<!--<input type="checkbox" name="selectall_attribute_group" id="selectall_attribute_group" />-->
								</td>
								<td>
									<!--<input type="text" name="attrb_id" />-->
								</td>
								<td>
									<!--<input type="text" name="name" />-->
								</td>
								<td></td>
							</tr></form>
                            <?php
								$row = $result->num_rows();
								if($row > 0){
									foreach($result->result() as $rows){
							?>
                            <tr>
                            	<td style="text-align:center;"><input type="checkbox" value="<?php echo $rows->attribute_group_id; ?>" name="attribute_group[]" id="attribute_group"/></td>
                            	<td><?= $rows->attribute_group_id; ?></td>
                                <td><?= $rows->attribute_group_name; ?></td>
                                <!--<td><a href='<?php// echo base_url().'admin/attribute/edit_attribute_group/'.$rows->attribute_group_id; ?>' title="Edit"><i class="icon-edit" style="font-size:18px"></i></a></td>-->
                                
                                <td><?php /*?><a href='<?php echo base_url().'admin/attribute/edit_attribute_group/'.$rows->attribute_group_id; ?>' title="Edit"><i class="fa fa-pencil-square-o"></i></a><?php */?></td>
								
                            </tr>
                            <?php 
								}
							}else{
							?>
							<tr><td class="a-center" colspan="3">No records found ! </td>
                               
                            </tr>
                            <?php } ?>
						</table>
					</div>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->
<?php
require_once('footer.php');
?>			