<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	require_once('header.php');

 $curprocess_query=$this->db->query("SELECT * FROM bulkprod_templatelog WHERE reupload_processstatus='process' "); 
 @$curentprocesstemplate_id=$curprocess_query->row()->blk_tempid;
							 
							

?>


<style>
.wrapper {
  position: relative; margin:0px; float:none; width:100%;
  cursor: default;
  -webkit-transform: translateZ(0); /* webkit flicker fix */
  -webkit-font-smoothing: antialiased; /* webkit text rendering fix */
}
.wrapper .tooltip {
  background: #1496bb;
  bottom: 0;
  color: #fff;
  display: block;
  left: 30px;
  margin-bottom: 0px;
  opacity: 0;
  padding: 10px;
  pointer-events: none;
  position: absolute;
  width: 300px;  text-align: center;
  -webkit-transform: translateY(10px);
     -moz-transform: translateY(10px);
      -ms-transform: translateY(10px);
       -o-transform: translateY(10px);
          transform: translateY(10px);
  -webkit-transition: all .25s ease-out;
     -moz-transition: all .25s ease-out;
      -ms-transition: all .25s ease-out;
       -o-transition: all .25s ease-out;
          transition: all .25s ease-out;
  -webkit-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
     -moz-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
      -ms-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
       -o-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
          box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
}

/* This bridges the gap so you can mouse into the tooltip without it disappearing */
.wrapper .tooltip:before {
  bottom: -20px;
  content: " ";
  display: block;
  height: 20px;
  left: 0;
  position: absolute;
  width: 100%;
}

/* CSS Triangles - see Trevor's post */
.wrapper .tooltip:after {
  border-left: solid transparent 10px;
  border-right: solid #1496bb 10px;
  border-top: solid transparent 10px;
  border-bottom: solid transparent 10px;
  bottom: 7px;
  content: " ";
  height: 0;
  left: -7px;
  margin-left: -13px;
  position: absolute;
  width: 0;
}
  
.wrapper:hover .tooltip {
  opacity: 1;
  pointer-events: auto;
  -webkit-transform: translateY(0px);
     -moz-transform: translateY(0px);
      -ms-transform: translateY(0px);
       -o-transform: translateY(0px);
          transform: translateY(0px);
}

/* IE can just show/hide with no transition */
.lte8 .wrapper .tooltip {
  display: none;
}

.lte8 .wrapper:hover .tooltip {
  display: block;
}
.fa-question-circle {
  font-size: 15px;
}
/*.wrapper{left:5px; top:5px; position:relative;}*/

</style>

<script>
<?php //if($curprocess_query->num_rows()>0){ ?>
/*$(document).ready(function(){
 setInterval(function(){cache_clear()},3000);
 });
 function cache_clear()
{
 window.location.reload(true);
}*/
<?php //} ?> 
</script>


<script>
function reupload_bulkprodtemplate(fileuploadid,sli)
{ 
	var conf=confirm('Do You want to Reupload Excel File');
	
	if(conf)
	{
			$('#process_div'+sli).css('display','block');
			
			
			var prodbtn_ids = document.getElementsByName("reuploadproduct[]");
			var prodbtnid_count=prodbtn_ids.length;
		
			var count=1;
			for (var i=0; i<prodbtnid_count; i++)
			{
				$('#reuploadproduct'+count).css('display','none');
				
				count++;
			}
			
			$.ajax({
							method:"POST",
							url:"<?php echo base_url(); ?>admin/Bulk_newprod_reupload/reupload_pendingproducts",
							data:{fileuploadid:fileuploadid},
							success:function(data){							
								$('#process_div'+sli).css('display','none');								
								window.location.reload(true);
								
							}
						});
						
						//window.location.href='<?php //echo base_url() ?>'+'admin/Bulk_newprod_reupload/reupload_pendingproducts/'+ fileuploadid;	
						
	}
	else
	{return false;}
}

</script>    


<div id="content">
		<div class="top-bar">
			<div class="top-left">
				<?php include 'sub_config.php';?>
			</div>
			<div class="top-right">
				<?php include 'top_right.php';?>
			</div>
		</div>
   <br>  
   <br>    
  <div class="main-content" style="padding:40px 10px;">   
 <div class="row content-header">
				<h3 style="margin-top:0px;">Bulk Products Reupload Log</h3>
   
   <div  align="left"><button class="seller_buttons" type="button" onclick="window.location.href='<?php echo base_url(). 'admin/Bulk_newprod_reupload/reuploadlog_list' ?>' " style="width:150px;"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Refresh Log 
</button>  </div>
             <div class="exist_prod_new_list" align="right"><button type="button" onclick="window.location.href='<?php echo base_url(). 'admin/Bulk_newproducttrackingexcelsheet/bulk_newprod_addexcelsheetracking' ?>' " style="width:200px;">Bulk Products Reupload &nbsp;<i class="fa fa-upload" aria-hidden="true"></i>
</button>  </div>
</div>
		<!-------------------------------------------Listing start--------------------------------------------------------------------->
        
         <div class="col-md-6 left" >	
										
					
					</div>
					
                     <div class="col-md-6 right">
					  <table class="multi_action">
							<tr>
								<!--<td>
									<a href="#">Select Visible</a>
									<span class="separator">|</span>
									<a href="#">Unselect Visible</a>
									<span class="separator">|</span>
									0 items selected
								</td>-->
								<td>
									
                           
								</td>
							 </tr>
                             
                            
                             
                             
						</table>
                        
                        
                        </div>
                        <div class="clearfix"></div>
					  <div>
						<table class="table table-bordered table-hover">
                       <form action="<?php echo base_url().'admin/sales/filter_order' ?>" method="post" >
                           
							<tr class="table_th">
								
								<th width="5%">Template ID</th>
								<th width="10%">File Name</th>
                                <th width="10%">Upload Start Date Time</th>
								<th width="12%">Pending</th>
								<th width="6%">Failed</th>
								<th width="10%">Uploaded</th>
								<th width="10%">Total</th>								
								<th width="10%">Upload Finish Date Time</th>
                                <th width="15%">Action</th>
                                
							</tr>
							<!--<tr class="filter_tr" >
								
								<td>
									<input type="text" name="order_id" id="order_id" >
								</td>
								<td>
									<input type="text" name="customer_name" id="customer_name" >
								</td>
								<td>
									<input type="text" name="customer_name" id="customer_name" >						
								</td>
								<td>
									<input type="text" name="tot_amount" id="tot_amount" >
								</td>
								<td>
									<div class="purchase">
										<span >From:</span>
										<input type="text" name="order_date_from"   id="datepicker-example7-start1">
									</div>
									<div class="purchase">	
										<span >To:</span>
										<input type="text" name="order_date_to"   id="datepicker-example7-end1">
									</div>
									
								</td>
								<td>
									<div class="purchase">
										<span >From:</span>
										<input type="text" name="status_modified_from"   id="datepicker-example7-start">
									</div>
									<div class="purchase">	
										<span >To:</span>
										<input type="text" name="status_modified_to"   id="datepicker-example7-end">
									</div>
								</td>
                                <td> <input type="submit" class="all_buttons" value="Search" id="search"  /> &nbsp;
							<input type="reset" class="all_buttons" value="Reset Filter" />                               
                                </td>
							</tr>-->
                            
                            </form>
                            <?php if($uploadlist->num_rows()>0){
								
								$qr_reupload=$this->db->query("SELECT * FROM bulkprod_templatelog where reupload_processstatus='process' ");
								$check_reuploadprocess=$qr_reupload->num_rows();
								 @$check_reuploadprocessuploadid=$qr_reupload->row()->blk_tempid;
								$sl_i=1;
								foreach($uploadlist->result_array() as $res_uploadlist)
								{	
									
									
									$upload_id=$res_uploadlist['blk_tempid'];
									$prod_query=$this->db->query("SELECT uploadprod_sqlid,uploadprod_uid,reupload_status FROM bulkproduct_reuploadlog WHERE uploadprod_uid='$upload_id'  ");
									$tot=$prod_query->num_rows();
									$pending=0;
									$upload=0;
									$failed=0;
									foreach($prod_query->result_array() as $res_produploadsts)
									{
										if($res_produploadsts['reupload_status']=='Pending')
										{
											$pending++;	
										}
										if($res_produploadsts['reupload_status']=='Uploaded')
										{
											$upload++;
										}
										if($res_produploadsts['reupload_status']=='Failed')
										{
											$failed++;
										}	
									}
									
									
									
							?>
                            <tr <?php if($curentprocesstemplate_id==$res_uploadlist['blk_tempid']) { echo "style='background-color:#900; color:#FFF;' ";}?>  > 
                            <td><?=$res_uploadlist['blk_tempid']; ?> </td>
                            <td><a <?php if($curentprocesstemplate_id==$res_uploadlist['blk_tempid']) { echo "style='color:#FFF;' ";}?> 
                            href="<?php echo base_url().'bulkproduct_excel/'.$res_uploadlist['excelfile_name']?>"><div class="wrapper"><img src="<?php echo base_url().'images/Excel.png' ?>" width="30" height="30"  title="<?=$res_uploadlist['excelfile_name']; ?>"/><?=$res_uploadlist['excelfile_name']; ?><div class="tooltip">Click to download the file as you have original uploaded</div></div></a><!--<i style="font-size:16px;" class="fa fa-eye"></i>--></td>
                            <td><?php
							$uploaddatestart=date_create($res_uploadlist['reupload_startdatetime']);
							echo date_format($uploaddatestart, 'M d, Y h:i A');
							?> </td>
                            <td><?=$pending?> </td>                           
                            <td><?=$failed?> </td> 
                            <td><?=$upload?> </td>
                            <td><?=$tot?> </td>
                            <td>
                            <?php 	$uploaddatefinish=date_create($res_uploadlist['reupload_enddatetime']);
									echo date_format($uploaddatefinish, 'M d, Y h:i A');
                            ?>
                            </td>
                            
                            <td>
                            <?php if($pending>0 || $failed>0) {?>
                             <button id="reuploadproduct<?=$sl_i?>" class="seller_buttons"  name="reuploadproduct[]"
                             style="float:right; <?php if($check_reuploadprocess>0 ) {echo "display:none;"; } ?> "          
                                          onclick="reupload_bulkprodtemplate('<?=$res_uploadlist['blk_tempid']?>','<?=$sl_i?>')" 
                                          >           																																																																																			                                         <i class="fa fa-upload" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Reupload Pending Products
           						</button>
                                        
                                        <div style=" <?php if($check_reuploadprocess>0 && $check_reuploadprocessuploadid==$res_uploadlist['blk_tempid']) {echo "display:block;background-color:#FFF;";}else {echo "display:none;"; } ?> color:#F00;" id="process_div<?=$sl_i?>"> 
                                   <img <?php if($check_reuploadprocessuploadid==$res_uploadlist['blk_tempid']) { echo "style='background-color:#FFF; ' ";}?>
                                          src="<?php echo base_url().'images/progress.gif' ?>" /> 
                                         &nbsp;Reupload is running...
                                         </div>
                             <?php } ?>           
                            </td>
                           
                            </tr>
                           <?php
								$sl_i++;} // forloop end 
						    } else { ?>
							<tr><td colspan="9" class="a-center">No Uploaded File Found ! </td></tr>
                            <?php } ?> 
					  </table>
                        

   		<!------------------------------------------Listing End------------------------------------------------------------------------->
                
	</div> <!-- end of rowcontent-header div -->
</div> <!-- end of main-content div -->


<?php
	require_once('footer.php');
?>                      