<?php
require_once('header.php');
?>
<script src="<?php echo base_url();?>js/chosen.jquery.js"></script>
<script>
  $(function() {
	$('.chosen-select').chosen();
	$('.chosen-select-deselect').chosen({ allow_single_deselect: true });
  });
</script>

<script>

function delete_keyword(kysqlid)
{
	var conf=confirm('DO You Want To Delete');
	
	if(conf)
	{
		$('#process_div_catg'+kysqlid).css('display','block');
		$.ajax({
						method:"POST",
						url:"<?php echo base_url(); ?>admin/Search_keyword_setup/delete_keyword",
						data:{kysqlid:kysqlid},
						success:function(data){			
							
							//$("#category_div").html(data);
							//$('#category_div').css('display','block');
							$('#process_div_catg'+kysqlid).css('display','none');
							window.location.reload(true);
							
							
						}
					});
					
	}
	
		
}
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
                	<?php
					//$attributes = array('onSubmit' => 'return membershipInfo()');
					$attributes = array('0' => '');
					echo form_open('admin/Search_keyword_setup/save_keywords', $attributes);
					?>
                	<!--<form onSubmit="return membershipInfo()">-->
					<div class="row content-header">
                    
                    
						<div class="col-md-8"><b>Add Search Keywords</b>
                        
                         <?php if($this->session->flashdata('succss_msg')=='Keyword already added Under this Category') {?>
                        <span align="center" style="color:#F00;"><?= $this->session->flashdata('succss_msg'); ?></span>
                        <?php }else{ ?>
                        <div id="ssmessg"><?= $this->session->flashdata('succss_msg'); ?></div>
                        <?php } ?>  
                        
                        </div>
                      
                        
						<div class="col-md-4 show_report">
							<button type="button" class="all_buttons" onClick="window.location.href='<?php echo base_url().'admin/search_keyword_setup' ?>'">Reset</button>
							<button type="submit" class="all_buttons">Save</button>
						</div>
					</div>
					<div class="form_view">
						<h3>Add Search Keyword </h3>
							<table>
								<tr>
									<td style="width:20%;">Keywords(separate By Comma) <sup>*</sup> </td>
									<td>
                                   <!-- <input type="text" class="text2" name="kyword" id="kyword" required>-->
                                    
                                    <textarea name="kyword" class="text2" id="kyword" style="width:800px; height:200px;" required></textarea>
                                    </td>
								</tr>
								<tr>
									<td> Category Name <sup>*</sup> </td>
									<td> <select name="catgids"  data-placeholder="Choose Category" class="chosen-select" id="catgids" tabindex="4" >
                							<option value=''>--select Category-- </option>	
                                            <?php if($srch_catg->num_rows()>0)
											foreach($srch_catg->result_array() as $rw){ ?>
                                            
                                            <option value="<?php if($rw['lvl2']!=''){echo $rw['lvl2'];}else{echo $rw['lvl1']; }?>">
											<?php echo 
											$rw['lvlmain_name']." >> ".$rw['lvl1_name']; if($rw['lvl2_name']!=''){echo " >> ".$rw['lvl2_name'];}
											
											?>
                                            </option>
                                         <?php } ?>
                                         
                                        </select></td>
								</tr>
								<tr>
									<td> URL </td>
									<td><textarea name="url_link" class="text2" id="url_link"></textarea></td>
								</tr>
								
							</table>
					</div>
                    <?php echo form_close(); ?>
                    
                    
                    <div id="keywordlist">
                    <div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
                     <table width="500" class="table table-bordered table-hover" > 
                            
                            <tr class="table_th " style="background-color:#099">								
								<th width="5%">Sl No. </th>
                                <th width="5%">Keyword </th>
								<th width="10%">Category Name</th>
                                <th width="10%">Category Level</th>
                                <th width="10%">URL</th>								
								<th width="8%">Action</th>
								
							</tr>
							
                          <?php if($keyword_info->num_rows()>0) {
							  foreach($keyword_info->result_array() as $res_kyword){
							  ?>
                            
                             <tr >
                             	<td><?=$res_kyword['srchkwrd_sqlid']?></td>
								<td><?=$res_kyword['keyword']?></td>
								<td><?=$res_kyword['category_name']?></td>
								<td><?php if($res_kyword['category_level']=='2'){echo "2nd Level";}else if($res_kyword['category_level']=='3') {echo "3rd Level";}?></td>
                                <td><?=$res_kyword['url']?></td>							
								<td style="color:#F00;"><i class="fa fa-times" aria-hidden="true" title="Delete" onClick="delete_keyword('<?=$res_kyword['srchkwrd_sqlid']?>')" style="cursor:pointer;"></i>
                                <div id="process_div_catg<?=$res_kyword['srchkwrd_sqlid']?>" style="display:none; color:#090;"> <img src="<?php echo base_url().'images/progress.gif' ?>" />Deleting...</div>
</td>								
								
								
							</tr>
                            <?php
							  }
							 }else{ ?>
							
							<tr><td colspan="9" class="a-center">No Record Found ! </td></tr>
                            
                            <?php } ?>
					  </table>
                      <div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
                    </div>
                    
				</div><!--   End of Main-content  -->
		</div><!-- @end #content -->
        
<script>
function membershipInfo(){
	var name = $('#mname').val();
	var cost = $('#mcost').val();
	var mdesc = $('#mdesc').val();
	var memb_pln_typ = $('#memb_pln_typ').val();
	if(name == ''){
		alert('Membership name is required.');
		$('#mname').focus();
		return false;
	}else if(cost == ''){
		alert('Membership cost is required.');
		$('#mcost').focus();
		return false;
	}else if(isNaN(cost)){
		alert('Invalid cost amount');
		$('#mcost').select();
		return false;
	}else if(memb_pln_typ == ''){
		alert('Membership plan type is required.');
		return false;
	}
}
</script>
<?php
require_once('footer.php');
?>	