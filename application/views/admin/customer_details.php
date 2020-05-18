<?php
require_once('header.php');
?>
    <script src="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
	<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
	<link href="<?php echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
    <style>
	.Zebra_DatePicker_Icon{
		Left:82px !important;
		top:6px !important;
	}
	</style>
		<div id="content">
			<div class="top-bar">
				<div class="top-left">
						<?php include 'sub_customer.php'; ?>
				</div>
				<div class="top-right">
					<?php include 'top_right.php'; ?>
				</div>
			</div>  <!-- @end top-bar  -->
			<div class="main-content">
					<div class="row content-header"><h4> Customer Details <span style="float:right;"></span></div>
                    <div class="a-center" id="ajax_res"></div>
                    <div class="clearfix"></div>
                   	
                  
			<ul class="nav nav-tabs tabs-horiz">
				<li id="li_tab1" class="active"><a data-toggle="tab" href="#tab1">User Personal Details</a></li>
				<li id="li_tab2"><a data-toggle="tab" href="#tab2">Orders</a></li>
				<li id="li_tab3"><a data-toggle="tab" href="#tab3">Cancel Order</a></li>
				<li id="li_tab4"><a data-toggle="tab" href="#tab4">Return Order</a></li>
                <li id="li_tab5"><a data-toggle="tab" href="#tab5">Delivered Order</a></li>
               	<li id="li_tab6"><a data-toggle="tab" href="#tab6">Undelivered Order</a></li>
                <li id="li_tab7" onClick="getUserAddress('<?=$this->uri->segment(4);?>');"><a data-toggle="tab" href="#tab7">Address</a></li>
			</ul>
			<div id="ajax_res"></div>
            <div class="tab-content form_view" style="background-color:#FFF">
				<div id="tab1" class="tab-pane fade in active">
					<h3>Personal Details</h3>
						<table class="table table-bordered table-hover">
                       
								    <?php 
									foreach($customer as $rw1){
									}?>                         
                                <tr>
									<td> User Name:</td>
									<td> 
                                      <?php echo $rw1->fname." ".$rw1->lname ? $rw1->fname." ".$rw1->lname : "Not Available"; ?>
                                     </td>
								</tr>
                                 <tr>
									<td> User Email ID: </td>
									<td><?php echo $rw1->email ? $rw1->email : "Not Available"; ?>  </td>
								</tr>
                                
                                <tr>
									<td> User Number:</td>
									<td><?php echo $rw1->mob ? $rw1->mob : "Not Available"; ?>  </td>
								</tr>
                                
                                <tr>
									<td> User Address: </td>
									<td><?php echo $rw1->address ? $rw1->address : "Not Available"; ?>   </td>
								</tr>
                                 <tr>
									<td> Pin Code: </td>
									<td><?php echo $rw1->pin_code ? $rw1->pin_code : "Not Available"; ?>    </td>
								</tr>
                                 <tr>
									<td> State: </td>
									<td><?php echo $rw1->state ? $rw1->state : "Not Available"; ?>    </td>
								</tr>
                                 <tr>
									<td> Country: </td>
									<td><?php echo $rw1->country ? $rw1->country : "Not Available"; ?>    </td>
								</tr>
							</table>
				</div>
				<div id="tab2" class="tab-pane fade">
					<h3>Orders</h3>
                   <?php 
									foreach($order_details as $rw2){
										
										//$count_order=count($rw2->order_id);
										//echo $count_order;
										$image_cart=explode(',',$rw2->imag);
									
									?> 
						<table class="table table-bordered table-hover">
                            
								<tr style="background-color:#efefef;">
                                
									<th width="2%"></th>
									<th width="28%">Order Summary <br>
                                Order ID:   <?php echo $rw2->order_id ? $rw2->order_id : "Not Available"; ?>                                                
                                  </th>
														
														<th width="15%">Order Status</th>
														<th width="15%">Order Date</th>
                                                        <th width="15%">Quantity</th>
                                                        <th width="9%">Product Name</th>
														<th width="15%">Product Price</th> 
                                                        </tr>
                                                      
                                                        <tr>
                                                          <?php 
									$query = $this->db->query("SELECT d.name, e.imag, b.product_order_status, a.date_of_order, b.sub_total_amount, a.Total_amount, b.quantity
FROM ordered_product_from_addtocart b
INNER JOIN order_info a ON b.order_id = a.order_id
INNER JOIN product_general_info d ON b.product_id = d.product_id
INNER JOIN product_image e ON d.product_id = e.product_id
WHERE b.order_id = '$rw2->order_id'");
										foreach($query->result() as $rw3){
									$image_cart=explode(',',$rw3->imag);
									?>  
                                                        <td rowspan=""></td>
									
                                   
									<td> <a href="">
								<img src="<?php echo base_url().'images/product_img/'.$image_cart[0]; ?>" width="30" class="list_img"></a>  </td>
                                <td><?php echo $rw3->product_order_status ? $rw3->product_order_status : "Not Available"; ?>  </td>
                                <td><?php $date=$rw3->date_of_order ?  $date=$rw2->date_of_order : "Not Available"; echo $datee = strstr($date, ' ', true);?>  </td>
                                 <td> <?php echo $rw3->quantity ? $rw3->quantity : "Not Available"; ?>  </td>
                                <td> <?php echo $rw3->name ? $rw3->name : "Not Available"; ?>  </td>
								<td><?php echo $rw3->sub_total_amount ?  "Rs ".$rw3->sub_total_amount : "Not Available"; ?>  </td>
                                                        </tr>  <?php }?>
                                                        <tr><td colspan="7" style="text-align:right"><b>Total Amount(inclusive of tax and shipping amount):</b><?php echo $rw3->Total_amount ?  "Rs ".$rw3->Total_amount : "Not Available"; ?> </td></tr></table> <?php }?>             
                           
							 
                          
				</div>
				<div id="tab3" class="tab-pane fade">
					<h3>Cancelled Orders</h3>
                     <?php 
									foreach($cancel_details as $rw4){
										$image_cart=explode(',',$rw4->imag);
										//$count_order=count($rw2->order_id);
										//echo $count_order;
										
									
									?>   
						<table class="table table-bordered table-hover" >
                        
								<tr style="background-color:#efefef;">
									<th width="2%"></th>
									<th width="28%">Order Summary <br>
                                Order ID:   <?php echo $rw4->order_id ? $rw4->order_id : "Not Available"; ?>                                              
                                  </th>
														
														<th width="15%">Order Status</th>
														<th width="15%">Order Date</th>
                                                        <th width="15%">Quantity</th>
                                                        <th width="9%">Product Name</th>
														<th width="15%">Product Price</th> 
                                                        </tr>
								
                                   
                                 
								   <?php 
									$query = $this->db->query("SELECT d.name, e.imag, b.product_order_status, a.date_of_order, b.sub_total_amount, a.Total_amount, b.quantity
FROM ordered_product_from_addtocart b
INNER JOIN order_info a ON b.order_id = a.order_id
INNER JOIN product_general_info d ON b.product_id = d.product_id
INNER JOIN product_image e ON d.product_id = e.product_id
WHERE b.order_id = '$rw4->order_id' ");
										foreach($query->result() as $rw5){
									$image_cart=explode(',',$rw5->imag);
									?>  
                                                        <tr>
                                                        <td rowspan=""></td>
									
                                   
									<td> <a href="">
								<img src="<?php echo base_url().'images/product_img/'.$image_cart[0]; ?>" width="30" class="list_img"></a>  </td>
                                <td><?php echo $rw5->product_order_status ? $rw5->product_order_status : "Not Available"; ?>  </td>
                                <td><?php $date=$rw5->date_of_order ?  $date=$rw5->date_of_order : "Not Available"; echo $datee = strstr($date, ' ', true);?>  </td>
                                <td> <?php echo $rw5->quantity ? $rw5->quantity : "Not Available"; ?>  </td>
                                <td> <?php echo $rw5->name ? $rw5->name : "Not Available"; ?>  </td>
								<td><?php echo $rw5->sub_total_amount ?  "Rs ".$rw5->sub_total_amount : "Not Available"; ?>  </td>
                                                        </tr>  <?php }?> <tr><td colspan="7" style="text-align:right"><b>Total Amount(inclusive of tax and shipping amount):</b><?php echo $rw5->Total_amount ?  "Rs ".$rw5->Total_amount : "Not Available"; ?> </td></tr></table> <?php } ?>  
				</div>
				<div id="tab4" class="tab-pane fade">
                	<h3>Returned Orders</h3>
					 <?php 
									foreach($return_details as $rw6){
										$image_cart=explode(',',$rw6->imag);
										//$count_order=count($rw2->order_id);
										//echo $count_order;
										
									
									?>   
                  	<table class="table table-bordered table-hover" >
                        
								<tr style="background-color:#efefef;">
									<th width="2%"></th>
									<th width="28%">Order Summary <br>
                                Order ID:   <?php echo $rw6->order_id ? $rw6->order_id : "Not Available"; ?>                                             
                                  </th>
														
														<th width="15%">Order Status</th>
														<th width="15%">Order Date</th>
                                                        <th width="15%">Quantity</th>
                                                        <th width="9%">Product Name</th>
														<th width="15%">Product Price</th> 
                                                        </tr>
								
                                      
								  <?php 
									$query = $this->db->query("SELECT d.name, e.imag, b.product_order_status, a.date_of_order, b.sub_total_amount, a.Total_amount, b.quantity
FROM ordered_product_from_addtocart b
INNER JOIN order_info a ON b.order_id = a.order_id
INNER JOIN product_general_info d ON b.product_id = d.product_id
INNER JOIN product_image e ON d.product_id = e.product_id
WHERE b.order_id = '$rw6->order_id'");
										foreach($query->result() as $rw7){
									$image_cart=explode(',',$rw7->imag);
									?>  
                                  <tr>
                                                        <td rowspan=""></td>
									
                                   
									<td> <a href="">
								<img src="<?php echo base_url().'images/product_img/'.$image_cart[0]; ?>" width="30" class="list_img"></a>  </td>
                                <td><?php echo $rw7->product_order_status ? $rw7->product_order_status : "Not Available"; ?>  </td>
                                <td><?php $date=$rw7->date_of_order ?  $date=$rw7->date_of_order : "Not Available"; echo $datee = strstr($date, ' ', true);?>  </td>
                                <td> <?php echo $rw7->quantity ? $rw7->quantity : "Not Available"; ?>  </td>
                                <td> <?php echo $rw7->name ? $rw7->name : "Not Available"; ?>  </td>
								<td><?php echo $rw7->sub_total_amount ?  "Rs ".$rw7->sub_total_amount : "Not Available"; ?>  </td>
                                                        </tr>  <?php }?> <tr><td colspan="7" style="text-align:right"><b>Total Amount(inclusive of tax and shipping amount):</b><?php echo $rw7->Total_amount ?  "Rs ".$rw7->Total_amount : "Not Available"; ?> </td></tr></table> <?php } ?>  
                    
				</div>
                <div id="tab5" class="tab-pane fade">
                	<h3>Delivered Orders</h3>
					 <?php 
									foreach($delivered_products as $rw10){
										//$image_cart=explode(',',$rw10->imag);
										//$count_order=count($rw2->order_id);
										//echo $count_order;
										
									
									?>   
                  	<table class="table table-bordered table-hover" >
                        
								<tr style="background-color:#efefef;">
									<th width="2%"></th>
									<th width="28%">Order Summary <br>
                                Order ID:   <?php echo $rw10->order_id ? $rw10->order_id : "Not Available"; ?>                                             
                                  </th>
														
														<th width="15%">Order Status</th>
														<th width="15%">Order Date</th>
                                                        <th width="15%">Quantity</th>
                                                        <th width="9%">Product Name</th>
														<th width="15%">Product Price</th> 
                                                        </tr>
								
                                      
								  <?php 
									$query = $this->db->query("SELECT d.name, e.imag, b.product_order_status, a.date_of_order, b.sub_total_amount, a.Total_amount, b.quantity
FROM ordered_product_from_addtocart b
INNER JOIN order_info a ON b.order_id = a.order_id
INNER JOIN product_general_info d ON b.product_id = d.product_id
INNER JOIN product_image e ON d.product_id = e.product_id
WHERE b.order_id = '$rw10->order_id'");
										foreach($query->result() as $rw11){
									$image_cart=explode(',',$rw11->imag);
									?>  
                                  <tr>
                                                        <td rowspan=""></td>
									
                                   
									<td> <a href="">
								<img src="<?php echo base_url().'images/product_img/'.$image_cart[0]; ?>" width="30" class="list_img"></a>  </td>
                                <td><?php echo $rw11->product_order_status ? $rw11->product_order_status : "Not Available"; ?>  </td>
                                <td><?php $date=$rw11->date_of_order ?  $date=$rw11->date_of_order : "Not Available"; echo $datee = strstr($date, ' ', true);?>  </td>
                                <td> <?php echo $rw11->quantity ? $rw11->quantity : "Not Available"; ?>  </td>
                                <td> <?php echo $rw11->name ? $rw11->name : "Not Available"; ?>  </td>
								<td><?php echo $rw11->sub_total_amount ?  "Rs ".$rw11->sub_total_amount : "Not Available"; ?>  </td>
                                                        </tr>  <?php }?> <tr><td colspan="7" style="text-align:right"><b>Total Amount(inclusive of tax and shipping amount):</b><?php echo $rw11->Total_amount ?  "Rs ".$rw11->Total_amount : "Not Available"; ?> </td></tr></table> <?php } ?>  
                    
				</div>
				
				<div id="tab6" class="tab-pane fade">
                	<h3>Undelivered Orders</h3>
					 <?php 
									foreach($undelivered_products as $rw8){
										$image_cart=explode(',',$rw8->imag);
										//$count_order=count($rw2->order_id);
										//echo $count_order;
										
									
									?>   
                  	<table class="table table-bordered table-hover" >
                        
								<tr style="background-color:#efefef;">
									<th width="2%"></th>
									<th width="28%">Order Summary <br>
                                Order ID:   <?php echo $rw8->order_id ? $rw8->order_id : "Not Available"; ?>                                             
                                  </th>
														
														<th width="15%">Order Status</th>
														<th width="15%">Order Date</th>
                                                         <th width="15%">Quantity</th>
                                                        <th width="9%">Product Name</th>
														<th width="15%">Product Price</th> 
                                                        </tr>
								
                                      
								  <?php 
									$query = $this->db->query("SELECT d.name, e.imag, b.product_order_status, a.date_of_order, b.sub_total_amount, a.Total_amount, b.quantity
FROM ordered_product_from_addtocart b
INNER JOIN order_info a ON b.order_id = a.order_id
INNER JOIN product_general_info d ON b.product_id = d.product_id
INNER JOIN product_image e ON d.product_id = e.product_id
WHERE b.order_id = '$rw8->order_id'");
										foreach($query->result() as $rw9){
									$image_cart=explode(',',$rw9->imag);
									?>  
                                  <tr>
                                                        <td rowspan=""></td>
									
                                   
									<td> <a href="">
								<img src="<?php echo base_url().'images/product_img/'.$image_cart[0]; ?>" width="30" class="list_img"></a>  </td>
                                <td><?php echo $rw9->product_order_status ? $rw9->product_order_status : "Not Available"; ?>  </td>
                                <td><?php $date=$rw9->date_of_order ?  $date=$rw9->date_of_order : "Not Available"; echo $datee = strstr($date, ' ', true);?>  </td>
                                <td> <?php echo $rw9->quantity ? $rw9->quantity : "Not Available"; ?>  </td>
                                <td> <?php echo $rw9->name ? $rw9->name : "Not Available"; ?>  </td>
								<td><?php echo $rw9->sub_total_amount ?  "Rs ".$rw9->sub_total_amount : "Not Available"; ?>  </td>
                                                        </tr>  <?php }?> <tr><td colspan="7" style="text-align:right"><b>Total Amount(inclusive of tax and shipping amount):</b><?php echo $rw9->Total_amount ?  "Rs ".$rw9->Total_amount : "Not Available"; ?> </td></tr></table> <?php } ?>  
                    
				</div>
                
                <div id="tab7" class="tab-pane fade load_custmr_addrs"></div> <!--- load ajax address -->
                	
			</div>
			<div class="row">
				<div class="col-md-4 show_report">
					
				</div>
			</div>	
		</div>
    </div>
    <div class="clearfix"></div>
            <!-- @end #right-content -->

			<!--</div>--><!-- @end #content -->
</div><!-- @end #w -->


<style>
.dt {
    width: 150px;
}
.Zebra_DatePicker_Icon{left: 130px !important;}
</style>



<!--- Zebra_Datepicker link start here ---->
<!--<script src="<?php// echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script>-->
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
<!--<link href="<?php// echo base_url(); ?>Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">-->
<!--- Zebra_Datepicker link end here ---->




<!---script start for Checking for unique SKU--->

			</div>  <!-- @end #main-content -->
		</div><!-- @end #content -->
		
<script>
	function change_product_status(status, j){
		if(status == 'Rejected'){
			$('#reason_block'+j).show();
			//$('#pro_inactiv_btn'+j).show();
		}else if(status == 'Suspended'){
			$('#reason_block'+j).show();
			//$('#pro_inactiv_btn'+j).hide();
		}else{
			$('#reason_block'+j).hide();
		}
	}
	function do_save_reject_pro(product_id, sku, j){
		var base_url = '<?php echo base_url(); ?>';
		var controller = 'admin/sellers/';
		var reason = $("#reason_block"+j).val();
		var status = $("#product_status"+j).val();
		if(status == ""){
			alert("Please select status."); 
			return false;
		}else{
			$.ajax({
				url : base_url+controller+'product_inactive',
				type : 'POST',
				data : {reason:reason, status:status, sku:sku, product_id:product_id},
				'success' : function(data){
					if(data == 'success'){
						window.location.reload(true);
						$('#ajax_res').html("<div style='color:green;'>Product Status Updated Successfully.</div>");
					}else{
						window.location.reload(true);

						$('#ajax_res').html("<div style='color:red;'>Product Status Update Failed.</div>");
					}
				}
			});
		}
	}
	
</script>

<script>
function getUserAddress(user_id){
	$.ajax({
		url:'<?php echo base_url(); ?>admin/customers/getting_addresses',
		method:'post',
		data:{user_id:user_id},
		success:function(data){
			$('.load_custmr_addrs').html(data);
		}
	});
}
</script>

<?php
require_once('footer.php');
?>					