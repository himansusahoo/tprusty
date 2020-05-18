<?php
require_once('header.php');
?>
<script>
//function valid_user_role()
//{
//	if($('#fname').val()=='')
//	{
//		document.getElementById('show_error').innerHTML="Enter First Name";
//		$('#fname').css('border','1px solid red');
//		document.getElementById('fname').focus();
//		return false;
//	}
//}
//    </script>
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
                
                
                 <form action='<?php echo base_url().'admin/Seller_penalty/insert_penalty_data' ?>' method='post' onSubmit="return valid_user_role()">
                <div class="row content-header">
						<div class="col-md-8"><b>Penalty Setup</b></div>
						<div class="col-md-4 show_report">
							
						</div>
                       
					</div>
                    <div id='show_error' align="center" style="color:#F00;"> </div>
					<div class="form_view"><div id="ss" ></div>
						<h3>Penalty Setting </h3>
							<table>
                            <tr>
									<td style="width:20%;">Order Cancel <!--<sup>*</sup>--> </td>
									<td><input type="text" class="text2" name="order_cancel" id="order_cancel" > &nbsp;%</td>
								</tr> <tr>
									<td style="width:20%;">Order not process<!--<sup>*</sup>-->  </td>
									<td><input type="text" class="text2" name="order_not_process" id="order_not_process">&nbsp;%</td>
								</tr>
								<tr>
									<td style="width:20%;">Delay in order Shippment <!--<sup>*</sup>-->  </td>
									<td><input type="text" class="text2" name="order_ship_delay" id="order_ship_delay">&nbsp;%</td>
								</tr>
                                <tr><td colspan="2">
                                <button type="reset" class="all_buttons">Reset</button>
							<input type="submit" class="all_buttons" value="Save"  >
                                </td></tr>
                           
								</table>
                </form>
                <?php if($penalty_result->num_rows()!=0) {?>
                <table class="table table-bordered table-hover">
							<tr class="table_th">
                            <th width="5%">Penalty ID</th>
								<th width="10%">Order Cancel Penalty</th>
                               
								<th width="10%">Order Not Process Penalty</th>
								
								<th width="15%">Order Shipment Delay Penalty</th>
								<th width="15%">Penalty creation Date</th>
								
							</tr>
                            
							<?php	foreach($penalty_result->result() as $res){?>
                                
							<tr><td><?= $res->Penalty_id ?></td>
                            <td><?= $res->order_cancel_penalty ?>%</td>
                            <td><?= $res->order_notprocess_penalty ?>%</td>
                            <td><?= $res->order_delayship_penalty ?>%</td>
                            <td><?= $res->create_date ?></td>
                            </tr>
                            
                            <?php } }?>
                            </table>
                </div>