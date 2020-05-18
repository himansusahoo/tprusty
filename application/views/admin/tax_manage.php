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
			#servc_tax,.um{ display:none;}
			.main-content {
    margin-top: 65px;
}

		</style>
		
		
			<div id="content">
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_sales.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content"><?php if(@$data==true){ ?><div align="center" style="color:#0C6"> <?php  echo $data ?> </div> <?php } ?>
					<div class="row content-header">
						<div class="col-md-8"><b>Manage Tax Rates <span id="ajxtst"></span></b></div>
                        
                        
						<div class="col-md-4 show_report">
							<!--<button type="button" class="all_buttons" onClick="window.location.href='<?php// echo base_url().'admin/sales/addnew_tax_rate' ?>'">Add New Tax Rates</button>-->
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
						<!--<div class="col-md-3 " >
							<div class="all_save">
								Export To:
								<select>
									<option>CSV</option>
									<option>Excel XML</option>
								</select>
								<button type="button" onClick="window.location.href='<?php// echo base_url().'admin/Export_excelfile/export_to_excelfile' ?>'">Export</button>
							</div>
						</div>
						<div class="col-md-3 show_report">
                        <form action="<?php// echo base_url().'admin/sales/filter_tax' ?>" method="post">
							<input  type="submit" class="all_buttons" value="Search" onClick="return valid()" >
							<button type="button" class="all_buttons">Reset Filter</button>
						</div>
					</div>-->
					
					<div>
						<?php /*?><table class="table table-bordered table-hover">
							<tr class="table_th">
                            <th width="10%">Tax Class</th>
								<th width="5%">Tax Indentifier Name</th>
								<th width="10%">Country</th>
								<th width="10%">State</th>
								<th width="10%">Tax Rate</th>
							</tr>                            
                            <?php foreach($res->result() as $rw){ ?>
                            <tr>
                            	<td><?php echo $rw->tax_class; ?></td>
                                <td><?php echo $rw->tri_name; ?></td>
                                <td><?php echo $rw->country; ?></td>
                                <td><?php echo $rw->state; ?></td>
                                <td><?php echo $rw->tax_rate_percentage; ?></td>
                            </tr>
							<?php  } ?>
                            
                             <?php $ct=$res->num_rows();
							    if($ct==0)
								{ ?>
                                
                                <tr><td colspan="9" class="a-center">No records found ! </td></tr>
							
							<?php } ?> 
						</table><?php */?>
                        
                        
                        <table class="table table-bordered table-hover">
                            <?php foreach($res->result() as $rw){ ?>
                            <?php if($rw->tri_name == 'Service Tax'){?>
                            <tr>
                                <td><?php echo $rw->tri_name; ?></td>
                                <td>
								<span class="svt"><?php echo $rw->tax_rate_percentage; ?></span>
                                <input type="text" name="servc_tax" id="servc_tax" value="<?=$rw->tax_rate_percentage;?>">
                                </td>
                                <td>
                                <span class="edt em" onClick="edit_serve_tax()">Edit</span>
                                <span class="edt um" onClick="updt_serve_tax(<?=$rw->tax_id;?>)">Update</span>
                                </td>
                            </tr>
							<?php  } }?>
                            
                             <?php $ct=$res->num_rows();
							    if($ct==0)
								{ ?>
                                
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


function edit_serve_tax(){
	$('.svt').hide();
	$('.em').hide();
	$('.um').show();
	$('#servc_tax').show();
}


function updt_serve_tax(tx_id){
	var servc_tax = $('#servc_tax').val();
	if(servc_tax == ''){
		alert('Please enter service tax amount.');
		$('#servc_tax').focus();
		return false;
	}else if(isNaN(servc_tax)){
		alert('Please enter a valid amount.');
		$('#servc_tax').select();
		return false;
	}else{
		$.ajax({
			url:'<?php echo base_url();?>admin/sales/update_servc_tax',
			method:'post',
			data:{tx_id:tx_id,amt:servc_tax},
			success:function(result)
			{
				//$("#ajxtst").html(data);
				if(result == 'success'){
					window.location.reload(true);
				}			
			}
		});
	}
}
</script>			