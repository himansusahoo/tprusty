<?php
require_once("header.php");
?>

<style>
.wrapper {
  font-family: "Gill Sans", Impact, sans-serif;
  /*position: relative;*/
  text-align: center;
  float: right; position:relative;
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
  width: 300px;
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
.main-content {
    margin-top: 65px;
}
</style>
<!--- Zebra_Datepicker link start here ---->
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
<!--- Zebra_Datepicker link end here ---->

<script>
$(document).ready(function(){
	$('#check_all').click(function(){
		$('input:checkbox').prop('checked', this.checked);
	});
});
</script>
<link rel="stylesheet" href="<?php echo base_url(); ?>colorbox/colorbox.css" />
<?php /*?><script src="<?php echo base_url(); ?>colorbox/jquery.min.js"></script><?php */?>
<script src="<?php echo base_url(); ?>colorbox/jquery.colorbox.js"></script>
<script>
	$(document).ready(function(){
		$(".inline").colorbox({inline:true, width:"34%"});
	});
</script>

<script language="JavaScript">

function change_order_status()
{
		
		if($('#order_status').val()=="")
		{
			alert("select change status value");return false;	
		}
		var order_ids = document.getElementsByName("order_id_chk[]");
		var orderid_count=order_ids.length;
		
		var count=0;
		for (var i=0; i<orderid_count; i++) {
			if (order_ids[i].checked === true) 
			{
				count++;
			}
		}
		
		if(count==0)
		{
			alert('Please select atleast one record');
			return false;
		}
		else
		{
			//else part start
			
			var ys = confirm("Do you want to change order status ?");
		if(ys){
			var ordered_id = $('input[name="order_id_chk[]"]:checked').map(function(_, el){
        	return $(el).val();
    	}).get();
			var orderstatus=$('#order_status').val();
			//check status
			if(orderstatus!='Approved' && orderstatus!='Not Approved')
			{//alert('others');			
				$('#loader_div').css('display','block');
				$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/sales/change_order_status",
					data:{orderid:ordered_id,ordered_status:orderstatus},
					success: function (data) {
						//$("#ss").html(data);
						//if(data == 'success'){
							window.location.reload(true);
						//}
					}
				});
			
			}
			
			else if(orderstatus=='Not Approved')  //if order status is Approve start
			{ //alert('not approved');
				$('#loader_div').css('display','block');
				$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/sales/change_order_disapprovestatus",
					data:{orderid:ordered_id},
					success: function (data) {
						
							window.location.reload(true);
						
					}
				});	
			} //if order status is Approve end
			
			else  //if order status is Approve start
			{//alert('approved');
				$('#loader_div').css('display','block');
				$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/sales/change_order_approvestatus",
					data:{orderid:ordered_id},
					success: function (data) {
						
							window.location.reload(true);
						
					}
				});	
			} //if order status is Approve end
			
			
		
		}
			
	}
			
}

function delete_order(ordered_id)
{
	var ys = confirm("Do you want cancel this order ?");
	if(ys){		
		$('#loader_div').css('display','block');
		$.ajax({
			method:"POST",
			url:"<?php echo base_url(); ?>admin/sales/delete_order",
			data:{orderid:ordered_id},
			success: function (data) {
				//$("#ss").html(data);
				//if(data == 'success'){
					window.location.reload(true);
				//}
			}
		});
	}
}


function shipmnet_confirm(order_id)
{

	//date format as mysql start//
	var now     = new Date(); 
    var year    = now.getFullYear();
    var month   = now.getMonth()+1; 
    var day     = now.getDate();
    var hour    = now.getHours();
    var minute  = now.getMinutes();
    var second  = now.getSeconds(); 
    if(month.toString().length == 1) {
        var month = '0'+month;
    }
    if(day.toString().length == 1) {
        var day = '0'+day;
    }   
    if(hour.toString().length == 1) {
        var hour = '0'+hour;
    }
    if(minute.toString().length == 1) {
        var minute = '0'+minute;
    }
    if(second.toString().length == 1) {
        var second = '0'+second;
    }   
    var dateTime = year+'/'+month+'/'+day+' '+hour+':'+minute+':'+second;
	   
	//date format as mysql end// 
	  
	   dt=newString = dateTime.replace("/","").replace("/","").replace(" ","").replace(":","").replace(":","")
	  
	  
	   
	   random_string=Math.random().toString(36).slice(2);
	   shipment_id=random_string + '-' + dt;
	   

	   document.getElementById('shipment_no_spanid').innerHTML=shipment_id;
	   document.getElementById('order_number').innerHTML=order_id;
	   
	   
	   document.getElementById('txtbox_shipment_number').value=shipment_id;
	   document.getElementById('txtbox_order_no').value=order_id;

	   
	  //window.location.href=' //echo base_url().'admin/sales/generate_shipment_id/'?>' + order_id + shipment_id ;
}
	
	

</script>
<!--<script>
$(document).ready(function(){ 
  $('#search').click(function(){ 
    alert($('#order_status').val());
  });
});
//$( "#order_status option:selected" ).text();
</script>-->

 <script>    
     function valid_undeliver(order_id)
		{
		
						var ys=confirm('Do you want to set as order undelivered ?');
		
					if(ys)
					{
						window.location.href='<?php echo base_url().'admin/sales/set_order_undeliver/' ?>' + order_id;	
					}
		
		}
		
		
		function valid_order_confirm(order_id)
		{
				var ys=confirm('Do you want to confirm order ?');
		
					if(ys)
					{
						//alert(order_id);
						$('#loader_div').css('display','block');
						$.ajax({
							method:"POST",
							url:"<?php echo base_url(); ?>admin/sales/set_order_confirm",
							data:{orderid:order_id},
							success: function (data) {
								//$("#ss").html(data);
								//if(data == 'success'){
									window.location.reload(true);
									$('#loader_div').css('display','none');
								//}
							}
						});
							
					}
		}
		
		function valid_order_disconfirm(order_id)
		{
			var ys=confirm('Do you want to hold order ?');
			if(ys)
			{
				$('#loader_div').css('display','block');
				$.ajax({
							method:"POST",
							url:"<?php echo base_url(); ?>admin/sales/set_hold_order",
							data:{orderid:order_id},
							success: function (data) {
								//$("#ss").html(data);
								//if(data == 'success'){
									window.location.reload(true);
									$('#loader_div').css('display','none');
								//}
							}
						});
				
			}	
		}                    
 </script>	
<style>
	.Zebra_DatePicker_Icon{left: 0px !important; top: 3px !important;}
</style>
			<div id="content">    
				<div class="top-bar">  <!-- @start top-bar  -->
					<div class="top-left">
						<?php include 'sub_sales.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
                    <div class="clearfix"></div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
               
                <span><a href="<?php echo base_url().'admin/Sales/view_penalty_detail' ?>"><i class="fa fa-exclamation-triangle" style="font-size:18px;"></i>View Penalty</a>
                &nbsp;  &nbsp;
               <?php /*?> <?php if(count($transfer_order_data)!=0){  ?>
                <a href="<?php echo base_url().'admin/Sales/view_order_transfer_list' ?>"><i class="fa fa-reply-all"></i> Orders Available For Transfer(<?php $ct_trans=count($transfer_order_data); echo $ct_trans;?> nos.) </a> 
                <?php } ?><?php */?> 
                
                  <?php //if(count($transfer_order_data)!=0){  ?>
                <a href="<?php echo base_url().'admin/Sales/view_order_transfer_list' ?>"><i class="fa fa-reply-all"></i> Transfer Orders </a> 
                <?php //} ?> 
                &nbsp;  &nbsp;
                <?php //if(count($return_orderlist)!=0){ ?>
                 <a href="<?php echo base_url().'admin/Sales/view_returnrequested_list' ?>"><i class="fa fa-repeat"></i> Return Request </a>
                                
                 <?php //} ?>
                 
                  &nbsp;  &nbsp;
                <?php //if(count($replacement_orderlist)!=0){ ?>
                 <a href="<?php echo base_url().'admin/Sales/view_replacement_list' ?>"><i class="fa fa-repeat"></i> Replacement Request </a>
                                
                 <?php //} ?>
                 
                  &nbsp;  &nbsp;
                <?php //if(count($graceperiod_request)!=0){ ?>
                <a href="<?php echo base_url().'admin/Sales/view_graceperiodrequest_list' ?>"><i class="fa fa-exclamation-circle"></i> Grace Period Request </a>
                                
                 <?php //} ?>
                 
                </span>
					<div class="row content-header">
						<div class="col-md-8"><h3>Orders</h3><span id="ss"></span></div>
						<div class="col-md-4 show_report">
							<!--<button type="button"  class="all_buttons">Create New Order</button>-->
						</div>
					</div>
					
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
							per page <span class="separator">|</span> Total 0 records found
						</div>-->
				  <div class="col-md-6 left" >	
										
					<table>
						<tr>
							<td>Change Order Status</td>
							<td>
                                <select id="order_status" name="order_status" >
                                    <option value="">--select--</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Not Approved">Not Approved</option>
                                    <option value="Pending payment">Pending payment</option>
                                    <option value="Failed">Failed</option>
                                    <option value="Order confirmed">Order confirmed</option>
                                    <!--<option value="Processing">Processing</option>
                                    <option value="Ready to shipped">Ready to shipped</option>
                                    <option value="Shipped">Shipped</option>-->
                                    <option value="Undelivered">Undelivered</option>
                                    <option value="Delivered">Delivered</option>
                                    <!--<option value="Return Requested">Return Requested</option>-->
                                    <option value="Return Received">Return Received</option>
                                    <!--<option value="Cancelled">Cancelled</option>-->
                                </select>
                            </td>
                            <td><input type="button" name="change_order" class="all_buttons" onClick="change_order_status()" value="Submit"></td>
                        </tr>
						
						</table>
                        <div id="loader_div" style="display:none; text-align:center;"> <img src="<?php echo base_url().'images/loading1.gif' ?>" /> 
                                                </div>
					</div>
					 <form action="<?php echo base_url().'admin/sales/filter_order' ?>" method="post" >
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
									
                            <input type="submit" class="all_buttons" value="Search" id="search"  />
							<input type="reset" class="all_buttons" value="Reset Filter" />
								</td>
							 </tr>
						</table>
                        </div>
                        <div class="clearfix"></div>
					  <div>
                      <div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
						<table class="table table-bordered table-hover">
                      
                            <tr style="display:;">
                            <?php
							
							if($orderid){ ?>
                            <td colspan="9">Filtered Data  as  Order Id:- <?php echo $orderid;?> 
                            </td>
                           <?php }
							
							else if($custname){ ?>
                            <td colspan="9">Filtered Data  as  Customer Name:- <?php echo $custname;?> 
                            </td>
                            <?php }
							
							else if($orderstat){ ?>
                            <td colspan="9">Filtered Data  as  Order Status:-<?php echo $orderstat;?> 
                            </td>
                            <?php }
							
							else if($orderdate && $orderdateto){ ?>
                            <td colspan="9">Filtered Data  as  Order Date:- <?php echo $orderdate;?> <?php echo $orderdateto;?>
                            </td>
                            <?php /*?><?php }
							
							else($orderstatmod && $orderstatmodto){ ?>
                            <td colspan="9">Filtered Data:- Order Id= <?php echo $orderstatmod;?> <?php echo $orderstatmodto;?>
                            </td><?php */?><?php } ?>
                            </tr>
							<tr class="table_th">
								<th width="3%">Select All</th>
                                <th width="10%">Seller Info</th>
								<th width="10%">Order ID</th>
								<th width="10%">Customer Name</th>
                                
								<th width="12%">Order Status</th>
								<th width="6%">Total Amount</th>
								<th width="10%">Order date</th>
								<th width="10%">Status Modified Date</th>
								<th width="8%">Order Approve Status</th>
								<th width="10%">Action</th>
							</tr>
							<tr class="filter_tr">
								<td><input type="checkbox" id="check_all" name="check_all"></td> 
                                <td>
                                </td>
								<td>
									<input type="text" name="order_id" id="order_id" >
								</td>
								<td>
									<input type="text" name="customer_name" id="customer_name" >
								</td>
                               
								<td>
									<select name="order_status1" id="order_status">
										<option value="">--select--</option>
										<option value="Pending payment">Pending payment</option>
										<option value="Failed">Failed</option>
										<option value="Order confirmed">Order confirmed</option>
										<option value="Processing">Processing</option>
										<option value="Ready to shipped">Ready to shipped</option>
										<option value="Shipped">Shipped</option>
										<option value="Undelivered">Undelivered</option>
										<option value="Delivered">Delivered</option>
                                        <option value="Return Requested">Return Requested</option>
                                        <option value="Returned">Returned</option>
                                        <option value="Cancelled">Cancelled</option>	
                                            				
									</select>						
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
                                <td>
                                <select name="order_status" id="order_status">
										<option value="">--select--</option>
										<option value="Approved">Approved</option>
										<option value="Not Approved">Not Approved</option>
										                                           				
								  </select>	
                                
                                </td>
								<td>
									
								</td>
								
							</tr>
                            
                            <?php
									$transfer_orderno=array();
									$query_ordtrans=$this->db->query("select * from order_transfer ");
									$row_ordtrans=$query_ordtrans->result();
									foreach($row_ordtrans as $res_transorder)
									{
										array_push($transfer_orderno,$res_transorder->old_order_id);	
									}
									
									
							$ct=$order_list->num_rows();
							if($ct!=0){
							
							 foreach($order_list->result() as $rws ){ ?>
                             
                            <tr <?php if(in_array($rws->order_id, $transfer_orderno)==true)
								 	{?>  style="color:#F00;" <?php } ?>> 
                           
                            <td style="text-align:center;"><input type="checkbox" id="order_id_chk" name="order_id_chk[]" value="<?php echo "'".$rws->order_id."'" ?>" ></td>
                            
                             <td style="font-size:12px;">
									   <?php  
                                                $seller_dtl = $this->Order_model->select_sellernm_rel_order($rws->seller_id);
                                                
                                                echo "<strong><span>Business Name: <span></strong>". " ".$seller_dtl->business_name;
                                                echo "<hr><strong><span>Name: <span></strong>". " ".$seller_dtl->slr_nm;	
                                                echo "<hr><strong><span>Email: <span></strong>". " ".$seller_dtl->email;
                                                echo "<hr><strong><span>Contact No. : <span></strong>". " ".$seller_dtl->mob;
                                       ?>
                            </td>
                            <td> <?php echo $rws->order_id;  
								$qr_order_status_log=$this->db->query("select * from order_status_log where order_id='$rws->order_id'  ");
								$rw_order_status_log=$qr_order_status_log->row();
								if($rw_order_status_log){
								
							?> 
                            <div class="wrapper"><i class="fa fa-calendar" aria-hidden="true" style="cursor:pointer;"></i><div class="tooltip">
                            
                            <?php 
								 	if($rw_order_status_log->order_accept_date!='0000-00-00 00:00:00')
								  	{echo 'Order Accept By Seller: '.date('M-d-Y h:i:s A',strtotime($rw_order_status_log->order_accept_date)).'<hr>'; }
									if($rw_order_status_log->invoice_generate_date!='0000-00-00 00:00:00')
								  	{echo 'Invoice Generate:'.date('M-d-Y h:i:s A',strtotime($rw_order_status_log->invoice_generate_date)).'<hr>'; }									
									if($rw_order_status_log->shipping_date!='0000-00-00 00:00:00')
								  	{echo 'Shippment: '.date('M-d-Y h:i:s A',strtotime($rw_order_status_log->shipping_date)).'<hr>'; }									
									if($rw_order_status_log->grace_period_request_date!='0000-00-00 00:00:00')
								  	{echo 'Grace Period Request: '.date('M-d-Y h:i:s A',strtotime($rw_order_status_log->grace_period_request_date)).'<hr>'; }								
									if($rw_order_status_log->delivered_date!='0000-00-00 00:00:00')
								  	{echo 'Delivered: '.date('M-d-Y h:i:s A',strtotime($rw_order_status_log->delivered_date)).'<hr>'; }								
									
									
									if($rw_order_status_log->return_request_date!='0000-00-00 00:00:00')
								  	{echo 'Return Request: '.date('M-d-Y h:i:s A',strtotime($rw_order_status_log->return_request_date)).'<hr>'; }									
									if($rw_order_status_log->return_approve_date!='0000-00-00 00:00:00')
								  	{echo 'Return Approved: '.date('M-d-Y h:i:s A',strtotime($rw_order_status_log->return_approve_date)).'<hr>'; }
									
									if($rw_order_status_log->return_received_date!='0000-00-00 00:00:00')
								  	{echo 'Return Received: '.date('M-d-Y h:i:s A',strtotime($rw_order_status_log->return_received_date)).'<hr>'; }
									
									if($rw_order_status_log->admin_cancel_date!='0000-00-00 00:00:00')
								  	{echo 'Order Cancelled By Admin: '.date('M-d-Y h:i:s A',strtotime($rw_order_status_log->admin_cancel_date)).'<hr>'; }
									
									if($rw_order_status_log->seller_cancel_order_date!='0000-00-00 00:00:00')
								  	{echo 'Order Cancelled By Seller: '.date('M-d-Y h:i:s A',strtotime($rw_order_status_log->seller_cancel_order_date)).'<hr>'; }
									
									
									if($rw_order_status_log->order_approved_date!='0000-00-00 00:00:00')
								  	{echo 'Order Approve By Admin: '.date('M-d-Y h:i:s A',strtotime($rw_order_status_log->order_approved_date)).'<hr>'; }
									
									if($rw_order_status_log->order_not_approved_date!='0000-00-00 00:00:00')
								  	{echo 'Order Disapprove By Admin: '.date('M-d-Y h:i:s A',strtotime($rw_order_status_log->order_not_approved_date)).'<hr>'; }
									
									if($rw_order_status_log->buyer_cancel_date!='0000-00-00 00:00:00')
								  	{echo 'Order Cancelled By Buyer: '.date('M-d-Y h:i:s A',strtotime($rw_order_status_log->buyer_cancel_date)).'<hr>'; }
									?>                            
                            </div></div>
                            
                            <?php } ?>
                            <?php if($rws->grace_period_approve_status=='Approved'){ ?>
                            &nbsp;<i class="fa fa-clock-o" aria-hidden="true" title="Grace Period: <?php echo $rws->grace_period;  ?> days" style="cursor: pointer;"></i>
                            <?php }  ?>

                             <?php if(in_array($rws->order_id, $transfer_orderno)==true)
								 	{?><br> This order transfered to other sellers <?php } ?>
                            </td>
                            <!--<td><?php// echo $rws->fname;  ?> <?php// echo " ". $rws->lname;  ?></td>-->
                            <td><?php echo $rws->full_name;?></td> 
                            
                                                  
                            <td>
								 <?php echo $rws->order_status;  ?>&nbsp;&nbsp;
                                 
								 <?php if($rws->order_status == 'Cancelled'){?>
                                 <?php if($rws->cancelled_by == 'Customer'){ ?>
                                 <span title="<?php echo $rws->cancelled_by;?>" style="cursor:pointer; color:#3C3CFF;"><i class="fa fa-users"></i></i></span>
                                 <?php }else if($rws->cancelled_by == 'Seller'){?>
                                 <span title="<?php echo $rws->cancelled_by;?>" style="cursor:pointer; color:#F60;"><i class="fa fa-user-plus"></i></span>
                                 <?php }else if($rws->cancelled_by == 'Admin'){ ?>
                                 <span title="<?php echo $rws->cancelled_by;?>" style="cursor:pointer; color:red;"><i class="fa fa-star"></i></span>
								 <?php } } ?>
                                 
                                 <?php echo '<br>'; if($rws->payment_mode=='1' && $rws->order_processstatus=='Order Placed Successfully By Buyer'){ ?>
                                 <span style="color:#903; font-weight:bold; font-size:12px;">(Order Placed By COD)</span>                                 
                                 <?php } ?>
                            </td>
                            <td>  <i class="fa fa-inr"></i><?php echo " ". $rws->sub_total_amount;  ?></td>
                            <td><?php	$dt_order=substr($rws->date_of_order,0,10); 
										echo date('d-M-Y',strtotime($dt_order)); 
										
										?></td>
                            <td><?php  $dt_orderstatus=substr($rws->order_status_modified_date,0,10);  
										if($dt_orderstatus!=0000-00-00)
										{echo date('d-M-Y',strtotime($dt_orderstatus));}
										else
										{echo " ";}
										
									?></td>
                            <td><?php echo $rws->order_confirm_for_seller;  ?></td>
                           
                            <td>
                        <a href='<?php echo base_url().'admin/sales/order_detail_asper_order_id/'.$rws->order_id  ; ?>' title="View Order"> <i style="font-size:16px;" class="fa fa-eye"></i> </a> 		                           
                        <?php /*?><a href='<?php echo base_url().'admin/sales/generate_packing_slip/'.$rws->order_id  ; ?>' title="packagingSlip">  <i style="font-size:16px;" class="fa fa-file-pdf-o"></i></a><?php */?>
                        
                        <?php 
						if($rws->invoice_id == ''){
						?>
                        
                        <a href='<?php echo base_url().'admin/sales/generate_invoice_id1/'.$rws->order_id; ?>' title="Invoice">  <i style="font-size:16px;" class="fa fa-file-pdf-o"></i></a>
                        
                        <?php }else{?>
                        <a href='<?php echo base_url().'admin/sales/generate_invoice_slip/'.$rws->order_id ; ?>' title="Invoice">  <i style="font-size:16px;" class="fa fa-file-pdf-o"></i></a>
                        <?php } ?>
                        <!-- <a href='#' title="Edit">  <i style="font-size:16px;" class="fa fa-pencil-square-o"></i></a>-->
                          <?php if($rws->order_status!='Cancelled'){  ?>
                         <a href='#' title="Cancel Order" onClick="delete_order('<?php echo $rws->order_id ?>')">  <i style="font-size:16px;" class="fa fa-trash-o"></i></a>
                        	<?php } ?> 
                      <?php /*?>   
                      <a href="#inline_content_add_address" onClick="shipmnet_confirm('<?php echo $rws->order_id; ?>')" title="Ship order">   <i style="font-size:16px;" class="fa fa-truck"></i> </a><?php */?>
                      <?php $qrs1=$this->db->query("select * from shipment_info where order_id='$rws->order_id'"); 
					  	$cts1=$qrs1->num_rows();
						if($cts1==0){
					  ?>
                     <!-- <a class='inline' href="#inline_content_add_address" onClick="shipmnet_confirm('<?php// echo $rws->order_id; ?>')"  title="Ship order">   <i style="font-size:16px;" class="fa fa-truck"></i> </a>-->
                      <?php }else
					  { ?>
                      
					<?php /*?><a href="#" onClick="valid_undeliver('<?php echo $rws->order_id; ?>')" title="Set As Order undelivered"> <img width="20px" height="20px" src="<?php echo base_url().'images/undelivered.png' ?>"/>   </a><?php */?>
                    
                    
                    <?php } ?>
                 <?php if($rws->order_confirm_for_seller=='Not Approved') {?>   
                <a href='#' onClick="valid_order_confirm('<?php echo $rws->order_id; ?>')" title="Approve Order">    <i class="fa fa-thumbs-o-up"></i> </a>

               <?php }else{ ?><a href='#' onClick="valid_order_disconfirm('<?php echo $rws->order_id; ?>')" title="Hold Order"><i class="fa fa-thumbs-down"></i>
</a><?php } ?>
					</td> 
                            
                            </tr>  
                            <?php } } else {?>
							<tr><td colspan="10" class="a-center">No records found ! </td></tr> <?php } ?>
					  </table>
                      <div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
                      </div>
                        </form>
					
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->
            
<div style="display:none">
      <div id="inline_content_add_address" style="padding:10px; background:#fff;">
      	<div class="edit_address_dv">
         	<h4 class="title sn">Add Shipping Information</h4>
<div class="col-md-12"><form action="<?php echo base_url().'admin/sales/add_shipment_info' ?> " method="post" >
		<table class="edit_address_form">
            <tr>
            <td width="150px">Order Number</td>
                <td> <span id="order_number"></span>
                    <input type="hidden"  name="txtbox_order_no" id="txtbox_order_no" />
                </td>
                </tr>
                  <tr>
            <td >Shipment Number</td>
                <td><span id="shipment_no_spanid"></span>
                    <input type="hidden"  name="txtbox_shipment_number" id="txtbox_shipment_number" />
                </td>
                </tr>
                
            <tr>
                <td width="150px">Courier Name</td>
                <td>
                    <select name="courier_name" required>
                        <option value="">--select--</option>
                        <option value="DHL">DHL</option>
                        <option value="Federal Express">Federal Express</option>
                        <option value="United Parcel Service">United Parcel Service</option>
                        <option value="Fedex">Fedex</option>
                    </select>
                </td>
            </tr>
          
                <tr>
                <td width="150px">Tracking Number</td>
                <td>
                    <input type="text" name="tracking_number" id="tracking_number" required/>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input  type="submit" id="address_btn"   value="Ship Order"/>
                </td>
            </tr>
            
            
      </table>
</form>
</div>
            
        </div>
      </div>
</div>            
            
            
            
            
            
            	
<?php
require_once('footer.php');
?>			