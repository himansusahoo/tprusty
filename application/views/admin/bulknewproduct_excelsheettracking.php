<?php
require_once("header.php");

?>
	<!--- Zebra_Datepicker link start here ---->
	<!--<link href="../Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
	<link href="../Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">
	<script src="../Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script>
	<script src="../Zebra_Datepicker-master/examples/public/javascript/core.js"></script>
	<script src="../Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>-->
	<!--- Zebra_Datepicker link end here ---->
		
	<style>
		.Zebra_DatePicker_Icon{left: 110px !important; top: 3px !important;}
	</style>
    
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
							url:"<?php echo base_url(); ?>admin/Bulk_newprod_reupload/bulknewproduct_reupload",
							data:{fileuploadid:fileuploadid},
							success:function(data){							
								$('#process_div'+sli).css('display','none');								
								window.location.reload(true);
								
							}
						});
						
						//window.location.href='<?php //echo base_url() ?>'+'admin/Bulk_newprod_reupload/bulknewproduct_reupload/'+ fileuploadid;	
						
	}
	else
	{return false;}
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
			<div class="row content-header">
				<div class="col-md-8"><b>Bulk New Product Uploaded Excel Sheet List of Multiple Seller on Same Day</b></div>
				<div class="col-md-4 show_report" >
					 <button id="product_submit" class="seller_buttons" 
                                         onClick="window.location.href='<?php echo base_url().'admin/Bulk_newprod_reupload/reuploadlog_list' ?>'" style="float:right;">           																																																																																			                                         <i class="fa fa-list" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Reupload Log
           								</button>
                                       
                
				</div>
			</div>
			<!--<div class="row mb10">
				<div class="col-md-8">
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
					per page <span class="separator">|</span> Total 0 records found
				</div>
				<div class="col-md-4 show_report">
					<button type="button" class="all_buttons">Search</button>
					<button type="button" class="all_buttons">Reset Filter</button>
				</div>
			</div>-->
			<div id="reuplodid">
				<table class="table table-bordered">
					<tr class="table_th">
						<th width="5%">Sl No</th>
						<th width="10%">Upload Date</th>
						<th width="85%">Excel Detail</th>
						
					</tr>
					<!--<tr class="filter_tr">
						<td></td>
						<td>
							<input type="text" name="title" value="">
						</td>
						<td>
							<div class="order">
								<span class="label">From:</span>
								<input type="text" name="order_from" id="datepicker-example7-start" value="">
							</div>
							<div class="order">	
								<span class="label">To:</span>
								<input type="text" name="order_to" id="datepicker-example7-end" value="">
							</div>
						</td>
						<td>
							<div class="order">
								<span class="label">From:</span>
								<input type="text" name="order_from" id="datepicker-example15-start" value="">
							</div>
							<div class="order">	
								<span class="label">To:</span>
								<input type="text" name="order_to" id="datepicker-example15-end" value="">
							</div>
						</td>
						<td></td>
					</tr>-->
<?php
$qr_reupload=$this->db->query("SELECT * FROM bulkprod_templatelog where reupload_processstatus='process' ");
$check_reuploadprocess=$qr_reupload->num_rows();
@$check_reuploadprocessuploadid=$qr_reupload->row()->blk_tempid;
if($check_reuploadprocess>0)
{ ?>
<span style="text-align:center; color:#900; font-weight:bold;">If Reupload is in hang mode then, Click on "Stop Reupload",else donot click on it.</span>
                       <br>
                  <button id="product_reuploadstop" class="seller_buttons" onClick="window.location.href='<?php echo base_url().'admin/Bulk_newproducttrackingexcelsheet/reset_reuploadprocess' ?>'" style="float:left; background-color:#F00">           																																																																																			                                         <i class="fa fa-ban" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Stop Reupload
           								</button>
                
	
<span style="text-align:center; color:#F00; font-weight:bold;">
<img src="<?php echo base_url().'images/progress.gif' ?>" />
 Please wait Reupload is under porcess....................... </span>

<?php } ?> 
<?php 	if($excelinfo) {
		$sl=1;
		$sl_i=1;
		foreach($excelinfo->result_array() as $rows){
?>				
                    <?php
							$upload_dtm=$rows['upload_dtime'];
							$gendtm=substr($rows['gen_dt'],0,10);
							
							$slr_id=array();
							$array_sellerunique=array();
							$upload_dtm=substr($upload_dtm,0,10);
							
							$qr_excel=$this->db->query("SELECT blk_tempid,seller_id,excelfile_name,upload_dtime,gen_dt,reupload_enddatetime FROM bulkprod_templatelog WHERE upload_dtime LIKE '%$upload_dtm%'  AND status='Expired' ");
							$rws_excelinfo=$qr_excel->result_array();
							
							foreach($rws_excelinfo as $res_excelsheet)
							{
								$slr_id[]=$res_excelsheet['seller_id'];	
							}
							
							$array_sellerunique=array_unique($slr_id);
							
							//if(count($array_sellerunique)>1)
							//{
									
						
						 ?>
                    
                                    <tr>
                                        <td><?=$sl?></td>
                                        <td><?php 
										if($upload_dtm!='0000-00-00')
										{
											$date=date_create($upload_dtm);
											echo date_format($date, 'M d, Y ');
										}
										else
										{
											$date=date_create($gendtm);
											echo date_format($date, 'M d, Y ');
										}
										
										?></td>
                                                                             
                                        <td>
										<table class="table table-bordered">
                                        
                                        <tr class="table_th" style="background-color:#6CF;">
                                        <th width="5%">Sl.</th>
                                        <th width="5%">Template Id</th>
                                        <th width="35%">Excel File NAme</th>
                                        <th width="20%">Seller Name</th>
                                        <th width="10%">Upload Date Time</th>
                                        <th width="10%">Latest Reupload Date Time</th>
                                        <th width="3%"> Total Products </th>
                                        <th width="50%">Action</th>                                     
                                        
                                    	</tr>
                                        
										<?php 
										foreach($rws_excelinfo as $res_excelsheetinfo)
										{?>
										
                                        <tr <?php if($check_reuploadprocessuploadid==$res_excelsheetinfo['blk_tempid']) { echo "style='background-color:#900; color:#FFF;' ";}?> >
                                        <td><?=$sl_i?></td>
                                        <td><?=$res_excelsheetinfo['blk_tempid']?></td>
                                        <td><a 
                                        <?php if($check_reuploadprocessuploadid==$res_excelsheetinfo['blk_tempid']) { echo "style='color:#FFF;'";}?>
                                        href="<?php echo base_url().'bulkproduct_excel/'.$res_excelsheetinfo['excelfile_name'] ?>"><?=$res_excelsheetinfo['excelfile_name']?></a></td>
                                        <td>
                                        <?php $sellr_id=$res_excelsheetinfo['seller_id']; 
										$slr_qr=$this->db->query("SELECT business_name FROM seller_account_information WHERE seller_id='$sellr_id' ");  
										
										echo @$slr_qr->row()->business_name;
										?>
                                        
                                        </td>
                                        <td>
                                       	<?php	 
											if($res_excelsheetinfo['upload_dtime']!='0000-00-00 00:00:00')
											{	$upload_date=date_create($res_excelsheetinfo['upload_dtime']);
												 echo date_format($upload_date, 'M d, Y h:i A');
											}
											else
											{
												$upload_date=date_create($res_excelsheetinfo['gen_dt']);
												 echo date_format($upload_date, 'M d, Y h:i A');
											}
										?>	
                                        </td>
                                        
                                        <td <?php if($res_excelsheetinfo['reupload_enddatetime']!='0000-00-00 00:00:00'){ echo "style='background-color:#0C0; color:white;'" ;}?>   >
                                        	<?php
												 
											if($res_excelsheetinfo['reupload_enddatetime']!='0000-00-00 00:00:00')
											{	$lastupload_date=date_create($res_excelsheetinfo['reupload_enddatetime']);
												 echo date_format($lastupload_date, 'M d, Y h:i A');
											}
											else
											{
												
												 echo " ";
											}
										?>	
                                        
                                        </td>
                                        <td>
                                        <?php
											$upload_uid=$res_excelsheetinfo['blk_tempid']; 
											$qr_prodcount=$this->db->query("SELECT uploadprod_sqlid FROM bulkproductupload_log WHERE uploadprod_uid='$upload_uid' AND upload_status='Uploaded'   ");
											echo $qr_prodcount->num_rows();
										 ?>
                                        </td>
                                        <td>
                                      <?php   if($check_reuploadprocess==0) { ?>
                                         <button id="reuploadproduct<?=$sl_i?>" class="seller_buttons" name="reuploadproduct[]"
                                         onClick="reupload_bulkprodtemplate('<?=$res_excelsheetinfo['blk_tempid']?>','<?=$sl_i?>')" >           																																																																																			                                         <i class="fa fa-upload" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Reupload 
           								</button>
                                        <?php } ?>
                                         <div style=" <?php if($check_reuploadprocess>0 && $check_reuploadprocessuploadid==$res_excelsheetinfo['blk_tempid']) {echo "display:block;background-color:#FFF;";}else {echo "display:none;"; } ?> color:#F00;" id="process_div<?=$sl_i?>"> <img
                                         <?php if($check_reuploadprocessuploadid==$res_excelsheetinfo['blk_tempid']) { echo "style='background-color:#FFF; ' ";}?>
                                          src="<?php echo base_url().'images/progress.gif' ?>" /> 
                                         &nbsp;Reupload is running...
                                         </div>
                                        </td>
                                        </tr>
                                        	
									<?php	$sl_i++; }
										
										 ?>
                                         
										</table>
										
                                        
                                        
                                        </td>
                                        
                                    </tr>
<?php
$sl++;
								

							//} //if conditon for unique seller end
	} // main for loop end
}else{
?>
					<tr>
						<td class="a-center" colspan="4">No record found!</td>
					</tr>
<?php } ?>
				</table>
                
               
			</div>			
		</div>
	</div>
<?php
require_once('footer.php');
?>