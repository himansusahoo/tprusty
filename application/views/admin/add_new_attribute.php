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
	$('#selectall_attribute').click(function(){
		$('input:checkbox').prop('checked', this.checked);
	});
});
</script>


<script language="JavaScript">

function atrb_group_delete()
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
				url:"<?php echo base_url(); ?>admin/attribute/delete_attribute",
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
						<div class="col-md-8"><b>Attribute List</b></div>
						<div class="col-md-4 show_report">						
                            
                            <button type="button" class="all_buttons" onClick="window.location.href='<?php echo base_url().'admin/Attribute/insert_new_attribute' ?>'">Add Attribute </button>
                            
						</div>
					</div>
					<div class="row mb10">
						
						<form action="<?php echo base_url().'admin/Attribute/filter_attribute' ?>" method="post">
						<div class="col-md-6 show_report">
							<input type="submit" class="all_buttons" value="Search">
							<input type="reset" class="all_buttons" value="Reset Filter">
						</div>
					</div>
					<div>
						<table class="multi_action">
							<tr>
								
								<td>
									<div class="right">
										
									</div>
								</td>
							</tr>
						</table>
					</div>
					<div>
						<table class="table table-bordered table-hover">
							<tr class="table_th">
								<th width="5%">Select All</th>
								<th width="25%">Attrubute Heading Id</th>
								<th width="30%">Attrubute Heading Name</th>
								<th width="30%">Attrubute Group Name</th>
                                <th width="60%">Action</th>
							</tr>
							<tr class="filter_tr">
								<td>
									<input type="checkbox" name="selectall_attribute" id="selectall_attribute"/>
								</td>
								<td>
									<!--<input type="text" name="attrb_id" />-->
								</td>
                                
                                <td>
									<!--<input type="text" name="attrb_name" />-->
								</td>
								<td>
									<select name="select_att_name">
                                    <option value="">--select--</option>
										<?php foreach($result_attr_group as $row){ ?>
										<option value="<?= addslashes($row->attribute_group_name); ?>"><?= $row->attribute_group_name; ?></option>
                                         <?php } ?>
									</select>
								</td>
                                <td> </td>
								
							</tr></form>
                            <?php
								$row = $result->num_rows();
								if($row > 0){
									foreach($result->result() as $rows){
							?>
                            <tr>
                            	<td style="text-align:center;"><input type="checkbox" name="attribute[]" id="attribute" value="<?= $rows->attribute_heading_id; ?>"/></td>
                            	<td><?= $rows->attribute_heading_id; ?></td>
                                <td><?= $rows->attribute_heading_name; ?><span onClick="goAddAttrDetails(<?= $rows->attribute_heading_id; ?>,<?= $rows->attribute_group_id; ?>);" class="add_attr_detail_spn">Attr. Details</span></td>
                                <td><?= $rows->attribute_group_name; ?></td>
                                <td><?php /*?><a href='<?php echo base_url().'admin/attribute/edit_attribute/'.$rows->attribute_heading_id; ?>' title="Edit"><i class="fa fa-pencil-square-o"></i></a><?php */?></td>
                                
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

<script>
function goAddAttrDetails(attr_heading_id,attr_group_id){
	window.location.href='<?php echo base_url(); ?>admin/attribute/add_attribute_details/'+attr_group_id+'/'+attr_heading_id;
}
</script>
<?php
require_once('footer.php');
?>			