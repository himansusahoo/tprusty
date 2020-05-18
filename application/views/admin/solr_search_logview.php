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
		//alert(selected_catg_id);return false;
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
				url: "<?php echo base_url(); ?>admin/Solar_search_log/dltselected_solr_log",
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
	var conf=confirm('DO You Want To Delete All Log');
	if(conf)
	{
		$('.allprocess_div_catg').css('display','block');
		$.ajax({
						method:"POST",
						url:"<?php echo base_url(); ?>admin/Solar_search_log/dltall_log",
						data:{dlt_all:"dlt_all"},
						success:function(data){			
							//alert(data);return false;
							
							$('.allprocess_div_catg').css('display','none');
							window.location.reload(true);
							
							
						}
					});
					
	}
}

function dltsolr_log(logsql_id)
{
	var conf=confirm('DO You Want To Delete This Log');
	
	if(conf)
	{
		$('#process_div_catg'+logsql_id).css('display','block');
		$.ajax({
						method:"POST",
						url:"<?php echo base_url(); ?>admin/Solar_search_log/dltsolr_logsingle",
						data:{logsql_id:logsql_id},
						success:function(data){			
							//alert(data);
							$('#process_div_catg'+logsql_id).css('display','none');
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
                    <div style="font-size:20px; margin-top:10px;">Solr Search Log<!--<button title="Solr Search Log" onClick="dltallcache_folder()" class="all_buttons">Delete All Log </button>--></div>
                    <div class="col-md-6 pagination">
				<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
			</div> <button type="button" style="background-color:#ff6666; margin-left: -575px;
    margin-top: 68px;" onClick="apply_delete()" class="seller_buttons" id="indxsearch_btn"  ><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Delete</button>
           
                
                	
              <div style="clear:both;"></div>
                     <table width="500" class="table table-bordered table-hover" > 
                            
                            <tr class="table_th " style="background-color:#099">								
								<th class="a-center" width="1%"></th>
                                <th width="1%">Sl No. </th>
								<th width="4%">Query String</th>
                                <th width="4%">Date</th>
                                <th width="4%">Email</th>
                                <th width="4%">Device(Os)</th>
                                <th width="4%">Ip</th>
                                <th width="4%">Category Level1 Response</th>
                                <th width="4%">Category Level2 Response</th>
                                <th width="4%">Category Level3 Response</th>
                                <th width="4%">SKU</th>
                                <th width="4%">Response Title</th>								
								<th width="4%">Action </th>
								
							</tr>
                             <?php $attrb=array('method'=>'GET'); echo form_open('admin//',$attrb); ?> 
							 <tr class="filter_tr">
								<td><input type="checkbox" id="check_all"/> </td>
								<td></td>
								<td></td>
                                <td></td>
								<td></td>
                                <td></td>
								<td></td>
                                <td></td>
								<td></td>
                                <td></td>
								<td></td>
								<td>
									 <!--<select class="text2" name="lvlid" id="" required>
										<option value="">--select--</option>
										<option <?php //if(@$this->input->GET("lvlid")==2){echo "selected";} ?> value="2">2nd Level Category</option>
										<option <?php //if(@$this->input->GET("lvlid")==3){echo "selected";} ?> value="3">3rd Level Category</option>
										                                           				
								  </select>	-->
								</td>
                                <td>
                                <!--<button type="submit" style="background-color:#0699e5;"  class="seller_buttons" id="indxsearch_btn"  ><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
                              
                               <button type="button" onClick="window.location.href='<?php //echo base_url().'admin/Cache/dlt_cache' ?>'" 
                               style="background-color: #52be80 ;"  class="seller_buttons" id=""  ><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Reset</button>-->
								</td>
							</tr>
                            <?php echo form_close(); ?>
                            
                          <?php if(@$solr_search_log_list->num_rows()>0) {
							  if(@$this->input->get('per_page')){$i=@$this->input->get('per_page')+1;}else{$i=1;}
							  foreach($solr_search_log_list->result_array() as $res_solr_search_log_list){
							  ?>
                             <tr >
                             	<td class="a-center">
                            	 
                                <input type="checkbox" name="chk_sku[]" id="chk_sku" value="<?=$res_solr_search_log_list['logsql_id']?>"  onClick="select_tblrow()">
                               
							</td>
								<td><?=$i++;?></td>
								<td><?=$res_solr_search_log_list['query_string']?>(<?=$res_solr_search_log_list['sku_count']?>)</td>
                                <td><?=$res_solr_search_log_list['date_time']?></td>
                                <td><?=$res_solr_search_log_list['user_email_id']?></td>
                                <td><?=$res_solr_search_log_list['user_device_type']?>(<?=$res_solr_search_log_list['user_device_os']?>)</td>
                                <td><?=$res_solr_search_log_list['user_ip']?></td>
                                <td>
                                <?php 
								$lvl1=$res_solr_search_log_list['category_lvl1'];
								$lvl1=explode('",',$lvl1);
								$lvl1cnt=$res_solr_search_log_list['category_lvl1_count'];
								$lvl1cnt=explode(',',$lvl1cnt);
								//print_r($lvl1);
								//echo $lvl1[0];exit;
								//echo count($lvl1);exit;
								$lvl1response=array();
								for($j=0; $j<count($lvl1); $j++ )
								{
									$lvl1response[]=$lvl1[$j]."(".$lvl1cnt[$j].")";
								}
								echo implode("|",$lvl1response);
								?>
                                
                                </td>
                                <td>
                                <?php 
								$lvl2=$res_solr_search_log_list['category_lvl2'];
								$lvl2=explode('",',$lvl2);
								$lvl2cnt=$res_solr_search_log_list['category_lvl2_count'];
								$lvl2cnt=explode(',',$lvl2cnt);
								//print_r($lvl1);
								//echo $lvl1[0];exit;
								//echo count($lvl1);exit;
								$lvl2response=array();
								for($j=0; $j<count($lvl2); $j++ )
								{
									$lvl2response[]=$lvl2[$j]."(".$lvl2cnt[$j].")";
								}
								echo implode("|",$lvl2response);
								?>
                                </td>
                                <td>
                                <?php 
								$lvl3=$res_solr_search_log_list['category_lvl3'];
								$lvl3=explode('",',$lvl3);
								$lvl3cnt=$res_solr_search_log_list['category_lvl3_count'];
								$lvl3cnt=explode(',',$lvl3cnt);
								//print_r($lvl1);
								//echo $lvl1[0];exit;
								//echo count($lvl1);exit;
								$lvl3response=array();
								for($j=0; $j<count($lvl3); $j++ )
								{
									$lvl3response[]=$lvl3[$j]."(".$lvl3cnt[$j].")";
								}
								echo implode("|",$lvl3response);
								?>
                                </td>
                                <td><?=$res_solr_search_log_list['search_sku']?></td>
                                <td><?=$res_solr_search_log_list['search_title']?></td>
								<td style="color:#F00;"><i class="fa fa-times" aria-hidden="true" title="Flush Cache" onClick="dltsolr_log(<?=$res_solr_search_log_list['logsql_id']?>)" style="cursor:pointer;"></i>
                                <div class="allprocess_div_catg" id="process_div_catg<?=$res_solr_search_log_list['logsql_id']?>" style="display:none; color:#090;"> <img src="<?php echo base_url().'images/progress.gif' ?>" />Flushing...</div>
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