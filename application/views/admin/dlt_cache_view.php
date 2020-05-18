<?php
require_once('header.php');
?>
<script src="<?php echo base_url();?>js/chosen.jquery.js"></script>

<script>
  $(function() {
	$('.chosen-select').chosen();
	$('.chosen-select-deselect').chosen({ allow_single_deselect: true });
  });
  
  
  function apply_delete(){
	var selected_catg_id = $('input[name="chk_sku[]"]:checked').map(function(_, el){
        	return $(el).val();
    	}).get();	
		//alert(selected_catg_id);
		if(selected_catg_id == ''){
		alert('Please select any record.');
		return false;
		}
		var ys = confirm("Do you want to change apply indexing.. ?");
		if(ys){
			for (i = 0; i < selected_catg_id.length; i++) 
			{
				var test=selected_catg_id[i]
   			 $('#process_div_catg'+test).css('display','block');
			}
			
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>admin/Cache/dltselectedcache_folder",
				data: {selected_catg_id:selected_catg_id},
				success: function (data) {
					//alert(data);
					//$("#show").html(data);
					//if(data == 'success'){
						window.location.reload(true);
						//$("#loader_div").css('display','none');
					//}
				}
			});
		
		}
	}
	
</script>
<script>

function dltallcache_folder()
{
	var conf=confirm('DO You Want To Flush All Cache');
	if(conf)
	{
		$('.allprocess_div_catg').css('display','block');
		$.ajax({
						method:"POST",
						url:"<?php echo base_url(); ?>admin/Cache/dltallcache_folder",
						data:{dlt_all:"dlt_all"},
						success:function(data){			
							//alert(data);return false;
							
							$('.allprocess_div_catg').css('display','none');
							window.location.reload(true);
							
							
						}
					});
					
	}
}

function dltcache_folder(catg_id)
{
	var conf=confirm('DO You Want To Flush This Cache');
	
	if(conf)
	{
		$('#process_div_catg'+catg_id).css('display','block');
		$.ajax({
						method:"POST",
						url:"<?php echo base_url(); ?>admin/Cache/dltcache_folder",
						data:{catg_id:catg_id},
						success:function(data){			
							//alert(data);return false;
							
							$('#process_div_catg'+catg_id).css('display','none');
							window.location.reload(true);
							
							
						}
					});
					
	}
	
		
}

/*function get(){
		
      var myObject = new ActiveXObject("Scripting.FileSystemObject");alert("folder_path");
      var myFolder = myObject.GetFolder(server-pc/moonboy_cache/application/cache);
      alert (myFolder.Size);
    }*/
</script>
<script>
$(document).ready(function(){
	$('#check_all').click(function(){
		$('input:checkbox').prop('checked', this.checked);
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
                    <div id="keywordlist">
                    <div style="font-size:20px; margin-top:10px;">Manage Cache <button title="Flush All Cache" onClick="dltallcache_folder()" class="all_buttons">Delete All Cache </button></div><a href="<?php echo base_url(); ?>admin/Cache/dltcachefld">dltcachefld</a>
                    <div class="col-md-6 pagination">
				<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
			</div> <button type="button" style="background-color:#ff6666; margin-left: -575px;
    margin-top: 68px;" onClick="apply_delete()" class="seller_buttons" id="indxsearch_btn"  ><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Delete</button>
           
                
                	
              <div style="clear:both;"></div>
                     <table width="500" class="table table-bordered table-hover" > 
                            
                            <tr class="table_th " style="background-color:#099">								
								<th class="a-center" width="1%"></th>
                                <th width="4%">Sl No. </th>
								<th width="16%">Category Name</th>
                                <th width="4%">Category Level</th>								
								<th width="4%">Action </th>
								
							</tr>
                             <?php $attrb=array('method'=>'GET'); echo form_open('admin/Cache/show_lvl_cache',$attrb); ?> 
							 <tr class="filter_tr">
								<td><input type="checkbox" id="check_all"/> </td>
								<td></td>
								<td></td>
								<td>
									 <select class="text2" name="lvlid" id="" required>
										<option value="">--select--</option>
										<option <?php if(@$this->input->GET("lvlid")==2){echo "selected";} ?> value="2">2nd Level Category</option>
										<option <?php if(@$this->input->GET("lvlid")==3){echo "selected";} ?> value="3">3rd Level Category</option>
										                                           				
								  </select>	
								</td>
                                <td>
                                <button type="submit" style="background-color:#0699e5;"  class="seller_buttons" id="indxsearch_btn"  ><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
                              
                               <button type="button" onClick="window.location.href='<?php echo base_url().'admin/Cache/dlt_cache' ?>'" 
                               style="background-color: #52be80 ;"  class="seller_buttons" id=""  ><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Reset</button>
								</td>
							</tr>
                            <?php echo form_close(); ?>
                            
                          <?php if($cache_list->num_rows()>0) {
							  if(@$this->input->get('per_page')){$i=@$this->input->get('per_page')+1;}else{$i=1;}
							  foreach($cache_list->result_array() as $res_cache_list){
							  ?>
                             <tr >
                             	<td class="a-center">
                            	 
                                <input type="checkbox" name="chk_sku[]" id="chk_sku" value="<?=$res_cache_list['catg_id']?>"  onClick="select_tblrow()">
                               
							</td>
								<td><?=$i++;?></td>
								<td><?php $catid=$res_cache_list['catg_id'];?>
								<?php 
								if($res_cache_list['cat_level']=='3')
								{
									$query = $this->db->query("SELECT `lvlmain_name`,`lvl1_name` FROM `temp_category` WHERE `lvl2`='$catid' ");
									echo $query->row()->lvlmain_name."  >>".$query->row()->lvl1_name."  >>";
								} 
								if($res_cache_list['cat_level']=='2')
								{
									$query = $this->db->query("SELECT `lvlmain_name` FROM `temp_category` WHERE `lvl1`='$catid' ");
									echo $query->row()->lvlmain_name."  >>";
								}
								?>
								
								
								<?=$res_cache_list['lvl2_name']?></td>
                                <td><?=$res_cache_list['cat_level']?><?php if($res_cache_list['cat_level']=='3'){echo "rd Level";} if($res_cache_list['cat_level']=='2'){echo "nd Level";}?></td>
                               <?php /*?><?php	   
								  $file_path =  base_url().'application/cache/Product_description+product_search/0f8658be54f9d71a461dcebc69428c25';	
								  //echo $file_path;
								  $file = file_get_contents($file_path);
								  $filesize = mb_strlen($file);	
								  echo round(($filesize)/1024);
								  
								
							   ?><?php */?>
                               <?php
							   
							   ?>
                               
                               <!--<input type="Button" value="Get Size" onClick="get()">-->
								<?php /*?><?=$res_cache_list['catg_id']?><?php */?>						
								<td style="color:#F00;"><i class="fa fa-times" aria-hidden="true" title="Flush Cache" onClick="dltcache_folder(<?=$res_cache_list['catg_id']?>)" style="cursor:pointer;"></i>
                                <div class="allprocess_div_catg" id="process_div_catg<?=$res_cache_list['catg_id']?>" style="display:none; color:#090;"> <img src="<?php echo base_url().'images/progress.gif' ?>" />Flushing...</div>
</td>								
								
								
							</tr>
                            <?php
							  }
							 }else{ ?>
							
							<tr><td colspan="9" class="a-center">No Record Found ! </td></tr>
                            <?php } ?>
                            
					  </table>
                      <div class="pagination">
							<p></p>
						</div>
                    </div>
                    
				</div><!--   End of Main-content  -->
		</div><!-- @end #content -->
        

<?php
require_once('footer.php');
?>	