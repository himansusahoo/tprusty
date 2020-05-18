<?php
require_once('header.php');
?>		
		<!--- Zebra_Datepicker link start here ---->
		<!--- Zebra_Datepicker link start here ---->
	<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
	<!--- Zebra_Datepicker link end here ---->
	
	<style>
		.Zebra_DatePicker_Icon{left: 110px !important; top: 3px !important;}
		.Zebra_DatePicker{z-index:9999;}
	</style>
<script>
function show_emailcontent(lg_id)
{
	$("#mailcont"+lg_id).toggle();
}
</script>		
	
			<div id="content">  
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_log.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
					<div class="row content-header">
						<div class="col-md-8"><b>Email Log</b></div>
                        
						<div class="col-md-4 show_report">
							<!--<button type="button" class="all_buttons" onClick="window.location.href='<?php// echo base_url().'admin/Super_admin/new_user_setup' ?>'">Add New User Role </button>-->
						</div>
					</div>
					<div class="row mb10">
						<!--<div class="col-md-6">
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
						<div class="col-md-3 " >
							<!--<div class="all_save">
								Export To:
								<select>
									<option>CSV</option>
									<option>Excel XML</option>
								</select>
								<button type="button" onClick="window.location.href='<?php// echo base_url().'admin/Export_excelfile/export_to_excelfile' ?>'">Export</button>
							</div>-->
						</div>
						<!--<div class="col-md-3 show_report">
                        <form action="#" method="post">
							<input  type="submit" class="all_buttons" value="Search" onClick="return valid()" >
							<button type="button" class="all_buttons">Reset Filter</button>
						</div>-->
					</div>
					<div class="col-md-12 right">
					<form action="<?php echo base_url().'admin/super_admin/filter_emaillog' ?>" method="post" >
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
									
                            <input type="submit" class="all_buttons" value="Search" id="search"  />
							<input type="reset" class="all_buttons" value="Reset Filter" />
								</td>
							 </tr>
						</table>
						<div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
						<table class="table table-bordered table-hover">
					<tr>
                            <?php
							
							/*if($user_id){ ?>
                            <td colspan="9">Filtered Data  as  user_id:- <?php// echo $user_id;?> 
                            </td>
                           <?php// }*/
							
							
							if($toemail_id){ ?>
                            <td colspan="9">Filtered Data  as  Toemail_id:- <?php echo $toemail_id;?> 
                            </td>
                           <?php }
							
							else if($fromemail_id){ ?>
                            <td colspan="9">Filtered Data  as  Fromemail_id:- <?php echo $fromemail_id;?> 
                            </td>
                            <?php }
							
							else if($subject){ ?>
                            <td colspan="9">Filtered Data  as  Subject:- <?php echo $subject;?> 
                            </td>
                            <?php }
							
												
							else if($date){ ?>
                            <td colspan="9">Filtered Data  as  Date:-<?php echo $date;?> 
                            </td>
                             <?php }
							 
							else if($email_status){ ?>
                            <td colspan="9">Filtered Data  as  Status:- <?php echo $email_status;?> 
                            </td>
                           
                           <?php } ?>
                            </tr>
						
							<tr class="table_th">
                            <th >To EmailId</th>
								<th width="8%">From EmailId</th>                               
								<th width="8%">Subject</th>								
								<th >Date</th>
								<th >content</th>
                                <th >Status</th> 	
							</tr>
							<tr class="filter_tr">
								
								<td>
									<input type="text" name="toemail_id" id="toemail_id" >
								</td>
								<td>
									<input type="text" name="fromemail_id" id="fromemail_id" >
								</td>
								<td>
									<input type="text" name="subject" id="subject" >
								</td>
								<td>
									<input type="text" name="date" id="datepicker-example7-start1" >
								</td>
								<td>
									
								</td>
								<td>
                                <select name="email_status" id="email_status">
										<option value="">--select--</option>
										<option value="Success">Success</option>
										<option value="Failure">Failure</option>
										                                           				
								  </select>	
                                
                                </td>
								
								
								
								
							</tr>
							<!--<tr class="filter_tr">
								<td>
                                
                               <input type="text" name="name" id="name" >
									
								</td>
                                <td> 
                                <select name="user_status">
                                 <option>--select--</option>
                                 <option value="Active">Active</option>
                                 <option value="Inactive">Inactive</option>
                                
                                </select>
                                </td>
                                <td>
                                 <select name="user_type">
                                 <option>--select--</option>
                                 <option value="admin">Admin</option>

                                 <option value="user">User</option>
                                
                                </select>
                                </td>
                                <td>
                                <input type="text" name="contactno" id="contactno" >
                                
                                </td>
                                
                                
                                <td>
                               <input type="text" name="email" id="email" >
                                
                                </td>
                                <td>
                              <div class="order">
								<span >From:</span>
								<input type="text" name="logintime_from_1"  id="datepicker-example7-start" value="">
							</div>
							<div class="order">	
								<span>To:</span>
								<input type="text" name="logintime_to_1" id="datepicker-example7-end" value="">
							</div>
                                
                                </td>
                                
                                <td>
                              
                                
                                </td>
                               
								
							</tr>-->
						
                         
						  
						  <?php 
						 	/*$ct=$data->num_rows();
						  if($ct!=0){*/
						  
						  if($data->num_rows()>0){
						  foreach($data->result() as $rows){ ?>  
                                <tr>
                            	<td><?php echo $rows -> to_email_id  ?></td>
                           		<td><?php echo 	$rows -> from_email_id  ?></td>
                                 <td><?php echo $rows -> email_sub  ?></td>
                                <td ><?php echo //$res->log_date  
								date('M-d-Y h:i:s A' ,strtotime($rows-> log_date));
								?></td>
                               
                                <td ><i id="view<?=$rows ->log_id?>" onClick="show_emailcontent(<?=$rows ->log_id?>)" style="font-size:18px;cursor:pointer;" class="fa fa-eye"></i>
								<div id="mailcont<?=$rows ->log_id?>" style="display:none;"> 
								<?php echo $rows ->email_content  ?>
                                </div> 
                                </td>
                                <td><?php echo $rows ->email_send_status  ?> </td>
								                              
                                
                               
                                
                                <!-- <a href='<?php// echo base_url().'admin/User_role_setup/user_log_details/'.$res->userole_id  ; ?>' title="View User Log Details"> <i style="font-size:18px;" class="fa fa-eye"></i> </a>-->
                                
                               
                            </tr>
                                <?php  }
						       }else{
								 ?>
                                <tr><td class="a-center" colspan="6" >No records found ! </td></tr>
							
							<?php } ?>
							</table>
					</form>
					</div>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->
<?php
require_once('footer.php');
?>

<script>
function select_state(country)
{	
		var n=country;
				
		$.ajax({
			url:'<?php echo base_url().'admin/Sales/select_state' ?>',
			method:'post',
			data:{name:n},
			success:function(data,status)
			{
				$("#state").html(data);					
				
			}
		});
	
   
}

function valid()
{
	if(document.getElementById("tax_classname").value=="" && 	document.getElementById("tax_idnf_name").value=="" && document.getElementById("country").value=="" && document.getElementById("state").value=="" && document.getElementById("taxrate_from").value=="" && document.getElementById("taxrate_to").value=="")
	
	{return false;}
	
	
	
	
	
}
</script>			