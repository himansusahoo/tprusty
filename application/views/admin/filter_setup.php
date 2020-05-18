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
                	<?php
					echo form_open();
					?>
                	<!--<form onSubmit="return membershipInfo()">-->
					<div class="row content-header">
						<div class="col-md-8"><b>Filter Settings</b></div>
						<div class="col-md-4 show_report">
							<!--<button type="reset" class="all_buttons">Reset</button>
							<button type="submit" class="all_buttons">Save</button>-->
						</div>
					</div>
					<div class="form_view">
						<h3>Add In Filter List</h3>
							<table>
								<tr>
									<td width="20%"> Choose Attribute Set </td>
									<td width="35%">
                                    	<select name="attribute_set" id="attribute_set" class="text2">
                                        	<option value="">--- select ---</option>
                                            <?php
											foreach($attribute_set_result as $attr_set_row){
											?>
                                        	<option value="<?=$attr_set_row->attribute_group_id;?>"><?=$attr_set_row->attribute_group_name;?></option>
                                            <?php }?>
                                        </select>
                                        <input type="button" value="Go" id="go_btn" onClick="ShowAttrHeadings()">
                                    </td>
                                    <td style="color:#009B00;"><?=$this->session->flashdata('ssmsg');?></td>
								</tr>
							</table>
					</div>
                    <?php echo form_close(); ?>
                    
                    <div id="load_attr_ajx"></div>
				</div><!--   End of Main-content  -->
		</div><!-- @end #content -->
        
<script>
///show attr heading script start here///
function ShowAttrHeadings(){
	var attr_group_id = $('#attribute_set').val();
	if(attr_group_id == ''){
		alert('Please select the attribute set.');
		return false;
	}else{
		$('#go_btn').attr('disabled', true);
		$('#go_btn').css('cursor','no-drop');
		$('#go_btn').val('wait..');
		$.ajax({
			url:'<?php echo base_url(); ?>admin/attribute/show_attr_headings_for_filter',
			method:'post',
			data:{group_id:attr_group_id},
			success:function(result){
				$('#load_attr_ajx').fadeIn();
				$('#load_attr_ajx').html(result);
				$('#go_btn').attr('disabled', false);
				$('#go_btn').css('cursor','pointer');
				$('#go_btn').val('Go');
			}
		});
	}
}
///show attr heading script end here///


</script>
<?php
require_once('footer.php');
?>	