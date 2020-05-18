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
	function valid_deleteuser(user_roleid)
	{
		var conf=confirm("Do you want to remove user permanetly ?");
		if(conf)
		{
			window.location.href='<?php echo base_url().'admin/User_role_setup/delete_user_role/'?>' + user_roleid ;	
		}
			
	}
	
	function active_user(user_roleid)
	{
		var conf=confirm("Do you want to activate user ?");
		if(conf)
		{
			window.location.href='<?php echo base_url().'admin/User_role_setup/active_user_role/'?>' + user_roleid ;	
		}	
	}
	
	function inactive_user(user_roleid)
	{
		var conf=confirm("Do you want to inactivate user ?");
		if(conf)
		{
			window.location.href='<?php echo base_url().'admin/User_role_setup/inactive_user_role/'?>' + user_roleid ;	
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
				<div class="main-content"><?php if(@$data==true){ ?><div align="center" style="color:#0C6"> <?php  echo $data ?> </div> <?php } ?>
					<div class="row content-header">
						<div class="col-md-8"><b>Manage User Roles</b></div>
                        
                        
						<div class="col-md-4 show_report">
							<button type="button" class="all_buttons" onClick="window.location.href='<?php echo base_url().'admin/Super_admin/new_user_setup' ?>'">Add New User Role </button>
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
                        <form action="#" method="post">
							<input  type="submit" class="all_buttons" value="Search" onClick="return valid()" >
							<button type="button" class="all_buttons">Reset Filter</button>
						</div>
					</div>
					
					<div>
						<table class="table table-bordered table-hover">
							<tr class="table_th">
                            <th width="20%">Name</th>
								<th width="10%">Status</th>
                               
								<th width="10%">Type</th>
								
								<th width="15%">Contact Number</th>
								<th width="20%">Email</th>
								<th width="20%">Action</th>
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
                               
                             <!--  <a href="#"> <i class="fa fa-pencil-square-o"></i> </a>
                               <a href="#"><i class="fa fa-times"></i></a>
								<a href="#"><input type="button" value="Set Active"></a>
								<a href="#"><input type="button" value="Set Inactive"></a>-->
                                </td>
								
							</tr></form>
						
                          <?php 
						  $ct=$user_info->num_rows();
						  if($ct!=0){
						  
						  foreach($user_info->result() as $res){ ?>  
                           <?php if($this->session->userdata('logged_userrole_id')!=$res->userole_id){ ?>
                            <tr>
                            	<td><?php echo $res->first_name." ".$res->last_name  ?></td>
                           		<td><?php echo $res->previleges_status  ?></td>
                                <td><?php echo $res->user_category  ?></td>
                                <td><?php echo $res->contact_no  ?></td>
                                <td><?php echo $res->email  ?></td>
                                
                                <td> 
                                
                                <a href="<?php echo base_url().'admin/User_role_setup/edit_user_role/'.$res->userole_id ?>" title="Edit"> <i class="fa fa-pencil-square-o" style="font-size:24px;"></i> </a>
                                <a href="#" onClick="valid_deleteuser(<?php echo $res->userole_id  ?>)" title="Delete"><i class="fa fa-times" style="font-size:24px;"></i></a>
                                
                                <?php if($res->previleges_status=='Active'){ ?>
                                <a><input type="button" value="Set Inactive" onClick="inactive_user(<?php echo $res->userole_id  ?>)"></a>
                                <?php }else { ?>
								<a><input type="button" value="Set Active" onClick="active_user(<?php echo $res->userole_id  ?>)"></a>
                                
								<?php } ?>
                                
                                </td>
                            </tr>
                                <?php } }
						       }else{
								 ?>
                                <tr><td colspan="9" class="a-center">No records found ! </td></tr>
							
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