<?php
require_once('header.php');
?>		
<!-- Lightbox link start here-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>colorbox/colorbox.css" />
  <script src="<?php echo base_url(); ?>colorbox/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>colorbox/jquery.colorbox.js"></script>
  <script>
      $(document).ready(function(){
          $(".inline").colorbox({inline:true, width:"34%"});
      });
  </script>
<!-- Lightbox link end here-->
			<div id="content">
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_sellers.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; 
						
						?>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
                
                
			<div class="row content-header">
						<div class="col-md-8"><h3>Courier Setup</h3><span id="ss"></span></div>
						<div class="col-md-4 show_report">
							
						</div>
					</div>
					
						
				  <div class="col-md-6 left" >
                  
					</div>
					 <!--<form action="" method="post" > -->
                     <div class="col-md-6 right">
                      	
				<!--<button type="button"  class="all_buttons" onClick="window.location.href='<?php //echo base_url().'admin/sellers/add_new_courier' ?>' ">Add New Courier </button>-->			
                <!--<button type="button"  class="all_buttons inline" onClick="#inline_content_add_cur_fld add_newcourier()">Add New Courier </button>	-->		
					<a class='all_buttons inline' href="#inline_content_add_cur_fld" onClick="add_newcourier()" style="color:#FFF" title="Add New Courier">Add New Courier</a>
                   
					 <!-- <table class="multi_action">
							<tr>
								
								<td>
									
                            <input type="submit" class="all_buttons" value="Search" id="search"  />
							<input type="reset" class="all_buttons" value="Reset Filter" />
								</td>
							 </tr>
						</table>-->
                        </div>
                        <div class="clearfix"></div>
					
						<table class="table table-bordered table-hover">
                      
                            	<tr class="table_th">
								
								<th>Sl No.</th>
                                <th>Courier Name</th>
                                <th>Courier URL </th>
                                 <th>Action</th>
                               
							</tr>
							<!--<tr class="filter_tr">
								
								<td>
									<input type="text" name="order_id" id="order_id" >
								</td>
								<td>
									<input type="text" name="buyer_name" id="buyer_name" >
								</td>
                                
                                <td>									
                                   <input type="text" name="refund_amount" id="refund_amount" > 
                                    
								</td>
                                 
                                <td>
									<input type="text" name="bank_name" id="bank_name" >
								</td>
                                
                               
                                <td><input type="text" name="ac_holder_name" id="ac_holder_name" ></td>
                                
                                
                                <td><input type="text" name="ac_no" id="ac_no" ></td>
                                <td><input type="text" name="ifsc_code" id="ifsc_code" ></td>
                               <td></td> 
                                
							</tr>-->
                            
                           <?php
						  $i=1;
						   
						    if(count($courier_info)!=0){
							   
							   foreach($courier_info as $res_courier)
							   { 
							  
							   
							   ?>
                            <tr> 
                            <td><?= $i; ?>   </td>
                            <td><?= $res_courier->courier_name	; ?></td>
                            
                            <td><?= $res_courier->courier_url; ?> </td>
                            
                            <td><a class='inline' href="#inline_content_edit_cour_fld" onClick="edit_courier(<?= $res_courier->courier_id	; ?>,'<?= $res_courier->courier_name	; ?>','<?= $res_courier->courier_url	; ?>')" title="Edit"><i class="fa fa-pencil-square-o"></i></a></td>
                            
                            
                           
                            
                            </tr>
                            <?php $i++; }  }else { ?>
                           
							<tr><td colspan="8" class="a-center">No Records Found ! </td></tr>
                            <?php  }  ?> 
					  </table>
                    
                      



  
</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->    
<script>
function edit_courier(curior_id,courier_nm,courier_url)
{
	
	$('#inline_content_edit_attr_fld').css('display','block');
	
	document.getElementById('courier_id').value=curior_id;
	document.getElementById('edt_courier_url').value=courier_url;
	document.getElementById('edt_courier_name').value=courier_nm;
	
}

function add_newcourier()
{
	$('#inline_content_add_attr_fld').css('display','block');	
}
</script>

<!--- light box div start here --->
<div style="display:none">
      <div id="inline_content_edit_cour_fld" style="padding:10px; background:#fff;">
      	<div class="edit_address_dv">
         	<h4 class="title sn">Edit courier</h4>
<div class="col-md-12">
<form action="<?php echo base_url().'admin/Sellers/update_courierinfo' ?>" method="POST">
		<table class="edit_address_form">
            <tr>
                <td>Courier Name: </td>
                <td>
                <input type="hidden" class="text" size="32px" name="courier_id" id="courier_id" value="">
                <input type="text" class="text" size="32px" name="edt_courier_name" id="edt_courier_name" value="" required></td>
            </tr>
            <tr>
                <td>Courier URL: </td>
                <td><input type="text" class="text" size="32px" name="edt_courier_url" id="edt_courier_url" value="" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input  type="submit" class="all_buttons" id="updt_attr_sav_btn" value="Update" >
                </td>
            </tr>
      </table>
</form>
</div>
            
        </div>
      </div>
</div>
<!--- light box div end here --->                               
     <!--- light box div start here --->
<div style="display:none">
      <div id="inline_content_add_cur_fld" style="padding:10px; background:#fff;">
      	<div class="edit_address_dv">
         	<h4 class="title sn">Add New courier </h4>
<div class="col-md-12">
<form action="<?php echo base_url().'admin/Sellers/addnew_courierinfo' ?>" method="POST">
		<table class="edit_address_form">
            <tr>
                <td>Courier Name: </td>
                <td>
                
                <input type="text" class="text" size="32px" name="new_courier_name" id="edt_courier_name" value=""></td>
            </tr>
            <tr>
                <td>Courier URL: </td>
                <td><input type="text" class="text" size="32px" name="new_courier_url" id="edt_courier_url" value=""></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input  type="submit" class="all_buttons" id="new_courier_btn" value="Save" >
                </td>
            </tr>
      </table>
</form>
</div>
            
        </div>
      </div>
</div>
<!--- light box div end here --->                                  
                
 <?php
require_once('footer.php');
?>