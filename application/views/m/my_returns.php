<?php include "header.php"; ?>


	<div class="wrap push" id="home">
		<!--Profile-->
      <div class="profile">
	   
	      <div class="info-inner">
		     		      
		  <div class="section-info">
				<h3 class="tittle two"> Return Products </h3>
               
        <!-- Order -->
       	<div class="order">
	     
					
	      <?php
						$sl=0;
						$order_rows = $order_id_result->num_rows();
						if($order_rows > 0){
							foreach($order_id_result->result() as $order_row){
								$sl++;
								$no_of_item = $order_row->NO_OF_ITEM;
								
								$query_return = $this->db->query("SELECT distinct a.order_id
							FROM ordered_product_from_addtocart a                            
                            INNER JOIN order_info e ON a.order_id=e.order_id 
							 WHERE a.order_id='$order_row->order_id' AND e.is_transfer='no' 
							AND (a.product_order_status = 'Delivered' OR a.product_order_status='Return Requested' OR a.product_order_status='Return Received') ");
							$row_return=$query_return->result();
							foreach($row_return as $res_return){
						?>		
	      <div class="list">
          
							  <div class="cart_box">
                              <div class="o-id">
                              
                              <a href="<?php echo base_url(); ?>order-details/<?= base64_encode($this->encrypt->encode($order_row->order_id)) ;?>" target="_blank" class="order_id"><?= $order_row->order_id; ?></a>                   
                              <div class="clearfix"> </div> </div>
                              <div class="clearfix"> </div>
                               <?php
                            $query = $this->db->query("SELECT a.id,a.sub_total_amount,a.quantity,a.product_order_status,a.returned_request_deny,a.order_id,a.prdt_color,a.prdt_size,b.name,b.product_id,b.description,
							b.short_desc,c.imag,d.business_name ,e.date_of_order,e.order_status,e.Total_amount,e.order_accept_by_seller,e.order_status_modified_date,f.sku
							FROM ordered_product_from_addtocart a 
                            INNER JOIN product_general_info b ON a.product_id=b.product_id 
                            INNER JOIN product_image c ON a.product_id=c.product_id 
                            INNER JOIN seller_account_information d ON a.seller_id=d.seller_id 
                            INNER JOIN order_info e ON a.order_id=e.order_id 
							INNER JOIN product_master f ON a.sku=f.sku WHERE a.order_id='$order_row->order_id' AND e.is_transfer='no' 
							AND (a.product_order_status = 'Delivered' OR a.product_order_status='Return Requested' OR a.product_order_status='Return Received') ");
                            
                            $order_details_result = $query->result();
							
							$slr=0;
							
                            foreach($order_details_result as $order_details_row){
								$slr++;
                                $image = explode(',',$order_details_row->imag);
                           ?>
							   	 <div class="message">
					                <div class="list_img">
                                    
                                    
                                    	<a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($order_details_row->name)))).'/'.$order_details_row->product_id.'/'.$order_details_row->sku ?>" >
									<img alt="" src="<?php echo base_url();?>images/product_img/<?=$image[0]; ?>" class="img-responsive"/>
								</a>
                                    
                                    </div>
								    <div class="list_desc">
                                    
                                    <h4><a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($order_details_row->name)))).'/'.$order_details_row->product_id.'/'.$order_details_row->sku ?>" target="_blank">
										<?= $order_details_row->name; ?>
									</a></h4>
                                    
                                    
                                    
                                    <div class="actual"> <span> Rs.<?= $order_details_row->sub_total_amount; ?></span> </div>
                                    <div class="clearfix"></div>
                                    <span class="two-half"> 
                                     <?php
                                     if($order_details_row->prdt_color != 'not'){ echo "<span class='cart_attr'>Color : ".$order_details_row->prdt_color.'</span><br/>'; }
									 
   									if($order_details_row->prdt_size != 'not'){ echo "<span class='cart_attr'>Size : ".$order_details_row->prdt_size.'</span><br/>';}
									?>
                                    
                                     </span> <span class="two-half"> Quantity : <?= $order_details_row->quantity; ?> </span>
                                    <div class="clearfix"></div>
									<div class="delivery"><p> <?= $order_details_row->product_order_status; ?> </p>
                                    <!-------------------Return button start---------------------->
                                       
                                     
                                     <?php
										$qr_returnrequest_approv=$this->db->query("select * from return_product where order_id='$order_row->order_id' and return_request_approve_status='Approved'");
										
										if($order_details_row->product_order_status == 'Delivered'){
											//checking delivered date between 10 days
											$qr_delivereddate=$this->db->query("select * from order_status_log where order_id='$order_row->order_id' ");											
											$rw_delivereddate=$qr_delivereddate->row();
											
											
											$after_10days_delivereddate=date('y-m-d H:i:s' ,strtotime(@$rw_delivereddate->delivered_date.'+ 10 day'));
											$date1 = date('y-m-d H:i:s');
											
											
											//$order_date = $order_details_row->date_of_order;
//											$ordr_sts_modify_date = $order_details_row->order_status_modified_date;
//											$date1 = date_create($order_date);
//											$date2 = date_create($ordr_sts_modify_date);
//											$diff=date_diff($date1,$date2);
											//echo $diff->format("%R%a");
											//if($diff->format("%R%a") < +10){
										
										if($order_details_row->returned_request_deny == 'Yes'){
										?>
										
										<?php } else {?>
										
										<?php if($date1<=@$after_10days_delivereddate){
										?><div class="gray-sml-btn">
										<a href="<?php echo base_url(); ?>my_order/return_product/<?= base64_encode($this->encrypt->encode($order_details_row->id)); ?>/<?= base64_encode($this->encrypt->encode($order_row->order_id)); ?>" class="cancl_prdt">Return</a> </div>
                                        <?php } //End of 10 days condition 
										}
										?>
										<?php  }else{
										
											if($qr_returnrequest_approv->num_rows()!=0)
											{ ?> <div class="gray-sml-btn" style="width:110px;"> <a href='<?php echo base_url().'my_order/generate_return_slip/'.$order_row->order_id; ?>' title='Print Return Slip' ><i style="font-size:24px" class="fa fa-print"></i> Return Slip</a> <?php } ?>
											</div>
										<?php } ?>
                                     
                                     <!------------------Return Button End-------------------------->
                                    <?php
                                   /* if($order_details_row->product_order_status == 'Pending payment' || $order_details_row->product_order_status == 'Failed' || $order_details_row->product_order_status == 'Order confirmed' || $order_details_row->product_order_status == 'Processing' || $order_details_row->order_accept_by_seller == 'Not Accepted' ){*/
										
										if(($order_details_row->product_order_status == 'Pending payment' || $order_details_row->product_order_status == 'Order confirmed' || $order_details_row->product_order_status == 'Processing') && 
										$order_details_row->order_accept_by_seller =='Not Accepted'){
                                    ?> 
                                     
                                    <div class="gray-sml-btn"> Cancel </div>
                                    
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
                                <div class="slr-name"> Seller : <a href="#"> <?= $order_row->business_name; ?> </a></div>
                                <div class="order-date">  Date : <?php echo date('M-d-Y',strtotime($order_row->date_of_order));?>  </div>
                                <div class="clearfix"> </div>
							</div>
							
									  <div class="clearfix"></div>
									</div>	
               
                <?php }} }else{
	?>
		<p>No Records Found.</p>
	<?php } ?>	
               
                                
	   </div>
      
       <!-- Order -->
       
        <div class="clearfix"> </div>
				</div>
		  </div>
	   </div>
  <!--//item-->
		
		</div>

<?php include "footer.php"; ?>