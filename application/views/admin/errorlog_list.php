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
						<div class="col-md-8"><b>Error Log</b></div>
                        
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
					
					<div>
						<table class="table table-bordered table-hover">
							<tr class="table_th">
                            <th >Slno</th>								                           
								<th width="70%">Description</th>
                                <th> View Detail</th>								
								<th >Status</th>
									
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
                               
								
							</tr></form>-->
						
                          <?php 
						  $ct=count($data);
						  if($ct!=0){
						  
						  foreach($data as $res){ ?>  
                           <?php  ?>
                            <tr>
                            	<td><?php echo $res->error_id  ?></td>
                           		<td><?php echo substr($res->error_descp,0,120).'...';  ?></td>                
                                <td ><i id="view<?=$res->error_id?>" onClick="show_emailcontent(<?=$res->error_id?>)" style="font-size:18px;cursor:pointer;" class="fa fa-eye"></i>
								<div id="mailcont<?=$res->error_id?>" style="display:none;"> 
								<?php echo $res->error_descp  ?>
                                </div> 
                                </td>
                                <td><?php echo $res->error_status  ?> </td>
								
                                <!-- <a href='<?php// echo base_url().'admin/User_role_setup/user_log_details/'.$res->userole_id  ; ?>' title="View User Log Details"> <i style="font-size:18px;" class="fa fa-eye"></i> </a>-->
                                
                               
                            </tr>
                                <?php  }
						       }else{
								 ?>
                                <tr><td colspan="4" class="a-center">No records found ! </td></tr>
							
							<?php } ?>
						</table>
					</div>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->
<?php
require_once('footer.php');
?>

	