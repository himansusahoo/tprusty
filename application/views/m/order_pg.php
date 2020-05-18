<?php include "header.php"; ?>

<!----------extra start---------------->

		<link rel="stylesheet" href="<?php echo base_url(); ?>colorbox/colorbox.css" />
		<script src="<?php echo base_url(); ?>colorbox/jquery.min.js"   ></script>
		<script src="<?php echo base_url(); ?>colorbox/jquery.colorbox.js"  ></script>
		<script>
			$(document).ready(function(){
				$(".inline").colorbox({inline:true, width:"90%", height:"300px", overflow:"hidden"});
				$(".inline2").colorbox({inline:true, width:"35%"});
			});
		</script>
 <!----------extra end---------------->
	
	<div class="wrap">
		<!--Profile-->
      <div class="profile">
	   
	      <div class="info-inner">
		     		      
		  <div class="section-info">
				<h3 class="tittle"> My Account </h3>
               
                   <?php include "profile_menu.php"; ?>
                     
                    <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#tab1" aria-controls="home" role="tab" data-toggle="tab">Recent Orders (Last 3 month)</a></li>
    <li role="presentation"><a href="#tab2" aria-controls="profile" role="tab" data-toggle="tab">Past Orders</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="tab1">
        <!-- Order -->
       	<div class="order">
        <?php if($this->session->flashdata('return_req')):?><h4><?php echo $this->session->flashdata('return_req');?></h4><?php endif; ?>
	     <h3 class="tittle two"> My Order </h3>
			<?php
						$sl=0;
						$order_rows = $order_id_result->num_rows();
						if($order_rows > 0){
							foreach($order_id_result->result() as $order_row){
								$sl++;
								$no_of_item = $order_row->NO_OF_ITEM;
								
								$after_10days_delivereddate=date('y-m-d H:i:s' ,strtotime($order_row->date_of_order.'+ 1 day'));
								$date1 = date('y-m-d H:i:s');
								//if($date1<=@$after_10days_delivereddate){
						?>		
							<div class="list">
          
							  <div class="cart_box">
                              <div class="o-id">
                              
                             <?php /*?> <a href="<?php echo base_url(); ?>order-details/<?= base64_encode($this->encrypt->encode($order_row->order_id)) ;?>" class="order_id"><?= $order_row->order_id; ?></a><?php */?>  
                              <a href="<?php echo base_url(); ?>order-details/<?= base64_encode($this->encrypt->encode($order_row->order_id)) ;?>"><?= $order_row->order_id; ?></a>                 
                              <div class="clearfix"> </div> </div>
                              <div class="clearfix"> </div>
                               <?php
                            $query = $this->db->query("SELECT a.id,a.sub_total_amount,a.quantity,a.product_order_status,a.order_id,
							a.prdt_color,a.prdt_size,a.order_accept_by_seller,b.name,b.product_id,b.description,b.short_desc,c.imag,d.business_name,e.date_of_order,e.order_status,
							e.Total_amount,e.order_processstatus,f.sku 
							FROM ordered_product_from_addtocart a 
                            INNER JOIN product_general_info b ON a.product_id=b.product_id 
                            INNER JOIN product_image c ON a.product_id=c.product_id 
                            INNER JOIN seller_account_information d ON a.seller_id=d.seller_id 
                            INNER JOIN order_info e ON a.order_id=e.order_id 
							INNER JOIN product_master f ON a.sku=f.sku WHERE a.order_id='$order_row->order_id' AND e.is_transfer='no' group by f.sku ");
                            
                            $order_details_result = $query->result();
							$slr=0;
                            foreach($order_details_result as $order_details_row){
								$slr++;
                                $image = explode(',',$order_details_row->imag);
                           ?>
							   	 <div class="message">
					                <div class="list_img">
                                    
                                    
                                    	<a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($order_details_row->name)))).'/'.$order_details_row->product_id.'/'.$order_details_row->sku ?>" >
									<img src="<?php echo base_url();?>images/product_img/<?=$image[0]; ?>" class="img-responsive" alt="<?=$order_details_row->name;?>"/>
								</a>
                                    
                                    </div>
								    <div class="list_desc">
                                    
                                    <h4><a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($order_details_row->name)))).'/'.$order_details_row->product_id.'/'.$order_details_row->sku ?>">
										<?= $order_details_row->name; ?>
									</a></h4>
                                    
                                    
                                    
                                    <div class="actual"> <span> Rs.<?= $order_details_row->sub_total_amount; ?></span> </div>
                                    <div class="clearfix"></div>
                                    <span class="two-half"> 
                                     <?php
                                     //if($order_details_row->prdt_color != 'not'){ echo "<span class='cart_attr'>Color : ".$order_details_row->prdt_color.'</span><br/>'; }
									 
   									//if($order_details_row->prdt_size != 'not'){ echo "<span class='cart_attr'>Size : ".$order_details_row->prdt_size.'</span><br/>';}
									
									//---------------------------Capacity,RAM,ROM display start--------------------
									
										
									$color_sizecronjobquery=$this->db->query("SELECT color,size,Capacity,RAM,ROM FROM  cornjob_productsearch WHERE sku='$order_details_row->sku' group by sku ");
									if($color_sizecronjobquery->num_rows()>0)
									{	
									
										$color=$color_sizecronjobquery->row()->color;
										$size=$color_sizecronjobquery->row()->size;									
										$capacity=$color_sizecronjobquery->row()->Capacity;
										$ram=$color_sizecronjobquery->row()->RAM;
										$rom=$color_sizecronjobquery->row()->ROM;
									}
									
									if($color != ''){ echo "<span class='cart_attr'>Color : ".$color.'</span><br/>';} 
									if($size != ''){ echo "<span class='cart_attr'>Size : ".$size.'</span><br/>'; }
									if($capacity != ''){ echo "<span class='cart_attr'>Capacity : ".$capacity.'</span><br/>'; }
									if($ram != ''){ echo "<span class='cart_attr'>RAM : ".$ram.'</span><br/>'; }
									if($rom != ''){ echo "<span class='cart_attr'>ROM : ".$rom.'</span><br/>'; }
									//---------------------------Capacity,RAM,ROM display end--------------------
									
									
									?>
                                    
                                     </span> <span class="two-half"> Quantity : <?= $order_details_row->quantity; ?> </span>
                                    <div class="clearfix"></div>
									<?php
										if($order_details_row->order_status == 'Pending payment' && $order_details_row->order_processstatus == 'Order Placed Successfully By Buyer'){
									?>
										<div class="delivery"><p>Order Placed by COD</p>
									<?php } else { ?>
										<div class="delivery"><p> <?= $order_details_row->product_order_status; ?> </p>
									<?php }?>
                                    <?php
                                   /* if($order_details_row->product_order_status == 'Pending payment' || $order_details_row->product_order_status == 'Failed' || $order_details_row->product_order_status == 'Order confirmed' || $order_details_row->product_order_status == 'Processing' || $order_details_row->order_accept_by_seller == 'Not Accepted' ){*/
										
										if(($order_details_row->product_order_status == 'Pending payment' || $order_details_row->product_order_status == 'Order confirmed' || $order_details_row->product_order_status == 'Processing') && 
										$order_details_row->order_accept_by_seller =='Not Accepted'){
                                    ?> 
                                     
                                    <a href="#inline_content_cancel_details<?=$sl.$slr;?>" class="gray-sml-btn inline">Cancel</a>
                                    
									<div style="display:none">
										<div id="inline_content_cancel_details<?=$sl.$slr;?>" style="padding:10px; background:#fff;">
											<div class="edit_address_dv">
											 <h4 class="title6 sn" style="font-size:17px; margin-bottom:10px;">Give Your Cancellation Details<span id="ajxtst<?=$sl.$slr;?>"></span></h4>
												<div class="col-md-12">
													<table class="edit_address_form">
														<tr>
															<td>Cancellation Reason: </td>
                                                        </tr>
														<tr>
															<td>
																<textarea cols="52" id="cancel_reson<?=$sl.$slr;?>" class="input-text" style="border: 1px solid #b8b6b3;"></textarea>
															</td>
														</tr>
														<tr>
															<td colspan="2">
																<input  type="button" id="return_btn<?=$sl.$slr; ?>"onClick="cancelProduct1(<?= $order_details_row->id; ?>,'<?= $order_details_row->sku; ?>','<?= $order_details_row->order_id; ?>',<?=$sl.$slr;?>,'<?= $order_details_row->quantity; ?>')" class="btn-sign-in" value="Submit">
															</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</div>
                                    
                                   <?php } ?> 
                                    </div>
                                        
									 </div>
		                              <div class="clearfix"></div>
	                              </div>
								<?php } ?> 
	                            </div>
	                            
	                      
				            
                            <div class="cart-total">
								<div class="total_left">CartSubtotal : </div>
								<div class="total_right">Rs. <?=$order_row->Total_amount;?></div>
								<div class="clearfix"> </div>
                                <div class="slr-name"> Seller : <a href="<?php echo base_url() ;?>sellers/<?= base64_encode($order_row->seller_id);?>"> <?= $order_row->business_name; ?> </a></div>
                                <div class="order-date">  Date : <?php echo date('M-d-Y',strtotime($order_row->date_of_order));?>  </div>
                                <div class="clearfix"> </div>
							</div>
							
									  <div class="clearfix"></div>
									</div>	
               
                <?php // }?>
				
				<?php } ?>
				<?php } ?> 
	   </div>
      
       <!-- Order -->
       
    </div>
        <div role="tabpanel" class="tab-pane" id="tab2">
		<div class="order">
			<h3 class="tittle two"> Past Order </h3>
			<?php
				$sl=0;
				$order_rows = $order_id_past_result->num_rows();
					if($order_rows > 0){
						foreach($order_id_past_result->result() as $order_row){
							$sl++;
							$no_of_item = $order_row->NO_OF_ITEM;
			?>		
			<div class="list">
				<div class="cart_box">
				<div class="o-id">
					<a href="<?php echo base_url(); ?>order-details/<?= base64_encode($this->encrypt->encode($order_row->order_id)) ;?>"><?= $order_row->order_id; ?></a>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"> </div>
					<?php
						$query = $this->db->query("SELECT a.id,a.sub_total_amount,a.quantity,a.product_order_status,a.order_id,							a.prdt_color,a.prdt_size,a.order_accept_by_seller,b.name,b.product_id,b.description,b.short_desc,c.imag,d.business_name,e.date_of_order,e.order_status, e.Total_amount,e.order_processstatus,f.sku FROM ordered_product_from_addtocart a 
						INNER JOIN product_general_info b ON a.product_id=b.product_id 
						INNER JOIN product_image c ON a.product_id=c.product_id 
						INNER JOIN seller_account_information d ON a.seller_id=d.seller_id INNER JOIN order_info e ON a.order_id=e.order_id 
						INNER JOIN product_master f ON a.sku=f.sku WHERE a.order_id='$order_row->order_id' AND e.is_transfer='no' group by f.sku ");
						
                            $order_details_result = $query->result();
							$slr=0;
                            foreach($order_details_result as $order_details_row){
								$slr++;
                                $image = explode(',',$order_details_row->imag);
                           ?>
					<div class="message">
						<div class="list_img">
							<a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($order_details_row->name)))).'/'.$order_details_row->product_id.'/'.$order_details_row->sku ?>" >
							<img src="<?php echo base_url();?>images/product_img/<?=$image[0]; ?>" class="img-responsive" alt="<?=$order_details_row->name;?>"/>
						</a>
						</div>
						<div class="list_desc">
							<h4>
								<a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($order_details_row->name)))).'/'.$order_details_row->product_id.'/'.$order_details_row->sku ?>">
								<?= $order_details_row->name; ?>
								</a>
							</h4>
							<div class="actual"> <span> Rs.<?= $order_details_row->sub_total_amount; ?></span> </div>
								<div class="clearfix"></div>
								<span class="two-half"> Quantity : <?= $order_details_row->quantity; ?> </span>
								<div class="clearfix"></div>
								<?php
									if($order_details_row->order_status == 'Pending payment' && $order_details_row->order_processstatus == 'Order Placed Successfully By Buyer'){
								?>
								<div class="delivery"><p>Order Placed by COD</p>
								<?php } else { ?>
								<div class="delivery"><p> <?= $order_details_row->product_order_status; ?> </p>
								<?php }?>
                                    <?php
										if(($order_details_row->product_order_status == 'Pending payment' || $order_details_row->product_order_status == 'Order confirmed' || $order_details_row->product_order_status == 'Processing') && 
										$order_details_row->order_accept_by_seller =='Not Accepted'){
                                    ?> 
                                     
                                    <?php /* ?><a href="#inline_content_cancel_details<?=$sl.$slr;?>" class="gray-sml-btn inline">Cancel</a><?php */ ?>
                                    
									<div style="display:none">
										<div id="inline_content_cancel_details<?=$sl.$slr;?>" style="padding:10px; background:#fff;">
											<div class="edit_address_dv">
											 <h4 class="title6 sn" style="font-size:17px; margin-bottom:10px;">Give Your Cancellation Details<span id="ajxtst<?=$sl.$slr;?>"></span></h4>
												<div class="col-md-12">
													<table class="edit_address_form">
														<tr>
															<td>Cancellation Reason: </td>
                                                        </tr>
														<tr>
															<td>
																<textarea cols="52" id="cancel_reson<?=$sl.$slr;?>" class="input-text" style="border: 1px solid #b8b6b3;"></textarea>
															</td>
														</tr>
														<tr>
															<td colspan="2">
																<input  type="button" id="return_btn<?=$sl.$slr; ?>"onClick="cancelProduct1(<?= $order_details_row->id; ?>,'<?= $order_details_row->sku; ?>','<?= $order_details_row->order_id; ?>',<?=$sl.$slr;?>,'<?= $order_details_row->quantity; ?>')" class="btn-sign-in" value="Submit">
															</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</div>
                                    
                                   <?php } ?> 
                                    </div>
                                        
									 </div>
		                              <div class="clearfix"></div>
	                              </div>
								<?php } ?> 
	                            </div>
                            <div class="cart-total">
								<div class="total_left">CartSubtotal : </div>
								<div class="total_right">Rs. <?=$order_row->Total_amount;?></div>
								<div class="clearfix"> </div>
                                <div class="slr-name"> Seller : <?= $order_row->business_name; ?></div>
                                <div class="order-date">  Date : <?php echo date('M-d-Y',strtotime($order_row->date_of_order));?>  </div>
                                <div class="clearfix"> </div>
							</div>
							
									  <div class="clearfix"></div>
									</div>	
               
                <?php }} ?>
	   </div>
      
       <!-- Order -->
       
    </div>
     
    </div>
  </div>

     
     
				    <div class="clearfix"> </div>
				</div>
		  </div>
	   </div>
  <!--//item-->
		
		</div>
    <script>
		function cancelOrder(val){
			var m = confirm('Are you sure to cancel this order ?');
			if(m){
				$.ajax({
					url:'<?php echo base_url(); ?>user/order_cancelation',
					method:'post',
					data:{id:val},
					success:function(result){
						if(result == 'success'){
							window.location.reload(true);
						}
					}
				});
			}else{
				return false;
			}
		}
		
		function cancelProduct1(id,sku,order_id,sl,qty){
			var reason = $('#cancel_reson'+sl).val();
			//alert(reason);return false;
			if(reason == ''){
				alert('Please enter reason.');
				return false;
			}else{
				$('#return_btn'+sl).val('Wait..');
				$.ajax({
					url:'<?php echo base_url(); ?>user/product_cancelation',
					method:'post',
					data:{id:id,sku_id:sku,order_id:order_id,reason:reason,qty:qty},
					success:function(result){
						//$('#ajxtst'+sl).html(result);
						if(result == 'success'){
							window.location.reload(true);
						}
					}
				});
			}
		}
	</script>
    
<?php include "footer.php"; ?>