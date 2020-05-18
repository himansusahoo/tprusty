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
						<div class="col-md-8"><b>Manage User Log</b></div>
                        
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
						<div class="col-md-3 show_report">
                        <form action="<?php echo base_url().'admin/super_admin/filter_userlog' ?>" method="post">
							<input  type="submit" class="all_buttons" value="Search" onClick="return valid()" >
							<button type="button" class="all_buttons">Reset Filter</button>
						</div>
						
					</div>
					<div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
					
					<div>
						<table class="table table-bordered table-hover">
							<tr class="table_th">
                            <th >Name</th>
								<th width="8%">Status</th>
                               
								<th width="8%">Type</th>
								
								<th >Contact Number</th>
								<th >Email</th>
                               <!-- <th width='12%' >Last Login Time</th>
                                <th width='12%'>Last Logout Time</th>-->
                                <th width="12%">Transaction Datetime  </th>
                                <th>Transaction  Particulars</th>
								
							</tr>
							<tr class="filter_tr">
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
                               
								
							</tr></form>
						
                          <?php 
						  $ct=$user_info->num_rows();
						  if($ct!=0){
						  
						  foreach($user_info->result() as $res){ ?>  
                           <?php  ?>
                            <tr>
                            	<td><?php echo $res->first_name." ".$res->last_name  ?></td>
                           		<td><?php echo $res->previleges_status  ?></td>
                                <td><?php echo $res->user_category  ?></td>
                                <td><?php echo $res->contact_no  ?></td>
                                <td><?php echo $res->email  ?></td>
                                <td><?php echo $res->log_datetime  ?> </td>
								<td><?php echo $res->log_detail  ?> </td>                                
                                
                               
                                
                                <!-- <a href='<?php// echo base_url().'admin/User_role_setup/user_log_details/'.$res->userole_id  ; ?>' title="View User Log Details"> <i style="font-size:18px;" class="fa fa-eye"></i> </a>-->
                                
                               
                            </tr>
                                <?php  }
						       }else{
								 ?>
                                <tr><td colspan="7" class="a-center">No records found ! </td></tr>
							
							<?php } ?>
						</table>
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