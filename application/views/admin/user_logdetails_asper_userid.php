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
						<div class="col-md-8"><b>User Log Details</b></div>
                        
						<div class="col-md-4 show_report">
							
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
                            <th width="12%">Date Time</th>
								<th >Log Details</th>
                               
								
							</tr>
							<tr class="filter_tr">
								
                               
                              
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
                                
                                <td></td>
                              
							</tr></form>
						
                          <?php 
						  $ct=count($user_log_detail);
						  if($ct!=0){
						  
						  foreach($user_log_detail as $res){ ?>  
                          
                            <tr>
                            	<td><?php echo $res->log_datetime  ?></td>
                           		<td><?php echo $res->log_detail  ?></td>
                                                            
                                
                               
                            </tr>
                                <?php }
						       }else{
								 ?>
                                <tr><td colspan="2" class="a-center">No records found ! </td></tr>
							
							<?php } ?>
						</table>
           
                
          
		</div>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->
<?php
require_once('footer.php');
?>