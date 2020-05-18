<?php
require_once("header.php");
?>
			<div id="content">    
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_sales.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
                
                <!--<form action="<?php// echo base_url().'admin/catalog/get_new_product_data' ?>" method="post">-->
                <?php echo form_open_multipart('admin/catalog/get_new_product_data'); ?>
                
					<div class="row content-header"><h4> Ordered Product Details <!--<span style="float:right;">
                   <a href="<?php// echo base_url().'admin/sales/generate_order_slip/'.$orderid  ; ?>" title="Print Order"><i style="font-size:18px;" class="fa fa-print"></i></a>
                    </span>--> </h4>
                    	<div class="col-md-2" >&nbsp;</div>
						<div class="col-md-10">
                        	
						<!--<div class="col-md-4 show_report">-->
							<!--<input type="reset" class="all_buttons" value="Reset">-->
							<!--<button type="button" onClick="window.location.href='<?php// echo base_url().'admin/catalog' ?>'" class="all_buttons">Back</button>-->
                            <!--<button type="submit" class="all_buttons" onClick="return ValidProduct_form()">Save</button>-->
						<!--</div>-->
                        </div>
					</div>
                    
                    <div class="clearfix"></div>
                   	
                    <!--<div class="left-sidebar border_non">
                    	<ul>
                        	<li><a href="#">Settings</a></li>
                        </ul>
                    </div>-->
                    
                           
           <!-- @start #right-content -->
           <!--<div class="right-cont">-->
           
          <!-- <div id="show_error" align="center" style="color:#F00;"></div>-->
          <div class="valid_msg_dv"></div>
           
			<ul class="nav nav-tabs tabs-horiz">
				<li id="li_tab1" class="active"><a data-toggle="tab" href="#tab1">Order Detail</a></li>
				<li id="li_tab2"><a data-toggle="tab" href="#tab2">Payment Detail</a></li>
				<li id="li_tab3"><a data-toggle="tab" href="#tab3">Shipping Detail</a></li>
				<li id="li_tab4"><a data-toggle="tab" href="#tab4">Ordered Product List</a></li>
               	<!--<li id="li_tab5"><a data-toggle="tab" href="#tab5">Images</a></li>
                <li id="li_tab6"><a data-toggle="tab" href="#tab6">Inventory</a></li>
                <li id="li_tab7"><a data-toggle="tab" href="#tab7">Categories</a></li>
                <li id="li_tab8"><a data-toggle="tab" href="#tab8">Related Products</a></li>-->
			</ul>

			<!--<div class="tab-content form_view">-->
			<div class="tab-content form_view">
				<div id="tab1" class="tab-pane fade in active">
					<h3>Order Details</h3>
						<table class="table table-bordered table-hover">
								<tr>
									<td style="width:20%;"> Order ID: </td>
                                    
									<td> 
										<?php echo $orderid; ?>
									</td>
								</tr>
								<tr>
									<td> Invoice Number: </td>
									
                                    <td> 
                                    
                                    <?php $qr1=$this->db->query("select * from order_info where order_id='$orderid' "); 
											$rw1=$qr1->row();
											
											if($rw1->invoice_id==""){
									?>
                                    <span> <input type="button" name="invoice_id_btn" value="Generate invoice ID" onClick="window.location.href='<?php echo base_url().'admin/sales/generate_invoice_id/'.$orderid ?>' "> </span>                 
                                    <?php }else{ echo $rw1->invoice_id; }?>
                                    </td>
								</tr>                                
                                <tr>
									<td> Customer Name: </td>
									<td> 
                                      <?php $qr2=$this->db->query("select a.fname, a.lname,a.mob,a.email,c.full_name,c.phone from user a inner join ordered_product_from_addtocart b on a.user_id=b.user_id inner join shipping_address c on b.order_id=c.order_id where b.order_id='$orderid' group by b.order_id "); 
											$rw2=$qr2->row();
											echo $rw2->full_name;
											
                                    ?>
                                     </td>
								</tr>
                                
                               <?php /*?> <tr>
									<td> Seller Name: </td>
									<td>
                                    
                                    <?php $qr3=$this->db->query("select a.business_name from seller_account_information a inner join product_master b on a.seller_id=b.seller_id inner join ordered_product_from_addtocart c on b.sku=c.sku inner join order_info d on c.order_id=d.order_id  where d.order_id='$orderid' group by b.seller_id    "); 
											$rw3=$qr3->row();
											echo $rw3->business_name;
											
                                    ?>
                                     </td>
								</tr><?php */?>
                                 <tr>
									<td> Customer Email ID: </td>
									<td> <?php echo $rw2->email ?> </td>
								</tr>
                                
                                <tr>
									<td> Customer Phone Number </td>
									<td> <?php echo $rw2->phone ?></td>
								</tr>
                                
                                <tr>
									<td> Order Status: </td>
									<td> <?php echo $rw1->order_status; ?> </td>
								</tr>
                                 <tr>
									<td> Ordered Date: </td>
									<td> <?php echo   date('d-M-Y h:i:s A',strtotime($rw1->date_of_order))?> </td>
								</tr>
                                
                                <tr>
									<td> Order Status Modified Date: </td>
									<td><?php if($rw1->order_status_modified_date!='0000-00-00 00:00:00')
									{echo date('d-M-Y h:i:s A',strtotime($rw1->order_status_modified_date)); }
									 ?>  </td>
								</tr>
								<!--<tr>
									<td></td>
									<td><input type="submit" name="save"  class="btn btn-warning" value="Continue" /></td>
								</tr>-->
							</table>
                            
				</div>
				<div id="tab2" class="tab-pane fade">
					<h3>Payment Details</h3>
						<table class="table table-bordered table-hover">
								<tr>
									<td style="width:20%;"> Total Payment Amount: </td>
									<td> 
										Rs.<?php echo $rw1->Total_amount; ?>
									</td>
								</tr>
								<tr>
									<td> Payment Mode </td>
									<td> 
									
									<?php $rw_payinfo=$qr1->row(); 
										
										  if($rw_payinfo->payment_mode==1)
										  {
											echo "Cash On Delivery";  
										   }
										   elseif($rw_payinfo->payment_mode==2)
										   {
											   echo "<div style='background-color:#ccc; height:25px; line-height:25px'><b>&nbsp;&nbsp;Online Payment</b></div>"; 
											   $query_paymentinfo=$this->db->query("select a.date_of_order,b.* from order_info a inner join payment_by_ccavenue_info b on a.order_id_payment_gateway=b.order_id where a.order_id='$orderid'");
											   $row_paymentinfo=$query_paymentinfo->result();
											   ?>
											   
											<table>
                                           
                                            <?php if(count($row_paymentinfo)!=0) {?>
                                           <tr><td >CCAvenue Tracking Number</td><td > <?= $row_paymentinfo[0]->tracking_id; ?></td></tr>
                                            <tr><td>Bank Reference Number</td><td> <?php if($row_paymentinfo[0]->bank_ref_no!='null'){echo $row_paymentinfo[0]->bank_ref_no;} ?> </td></tr>
                                            <tr><td>Payment Status</td><td> <?= $row_paymentinfo[0]->order_status; ?> </td></tr>
                                            <tr><td>Status Message</td><td> <?= $row_paymentinfo[0]->status_message; ?> </td></tr>
                                            <tr><td>Card Name</td><td> <?= $row_paymentinfo[0]->card_name; ?> </td></tr>                                            
                                            
											   <?php } else {?>
                                               <tr><td colspan="2" style="color:#F00; text-align:center;"> Online Payment Detail Not Available </td></tr>
                                               <?php } ?>
                                                <tr><td style="font-weight:bold;">CCAvenue Order ID</td><td style="color:#390; font-weight:bold; text-align:left" > <?=$rw1->order_id_payment_gateway; ?> </td></tr>   
                                               </table>
										 <?php  }
										 elseif($rw_payinfo->payment_mode==3)
										 {
											echo "Wallet Payment";	 
										 }	
									
									?> 
                                    
                                    </td>
								</tr>
                                
                                <tr>
									<td> Order Date </td>
									<td> <?php	
										echo date('d-M-Y h:i:s A',strtotime($rw1->date_of_order)); 
									
									 ?></td>
								</tr>
                               <tr>
									<td> Order Placed By Buyer </td>
									<td> <?php	if($rw1->order_processstatus!=''){echo $rw1->order_processstatus;}else {echo "Data Not Available" ;} ?></td>
								</tr>

                                
                               
							</table>
				</div>
				<div id="tab3" class="tab-pane fade">
					<h3>Shipping Detail</h3>
					<table class="table table-bordered table-hover">
						<?php
                                /*$qr4=$this->db->query("select a.address,a.city,a.state,a.country,a.pin_code,d.state from user_address a inner join user b on a.address_id=b.address_id inner join  ordered_product_from_addtocart c on b.user_id=c.user_id inner join state d on a.state=d.state_id where c.order_id='$orderid' group by c.order_id  ");*/
                            $qr4=$this->db->query("select a.*,c.state as state_name from shipping_address a inner join order_info b on a.order_id=b.order_id inner join state c on a.state=c.state_id where b.order_id='$orderid'");
                            $rw4=$qr4->row();
                        ?>
                        <tr>
                            <td style="width:20%;"> Customer Name </td>
                            <td><?php echo $rw4->full_name;?></td>
                        </tr>
                        <tr>
                            <td> Street Address </td>
                            <td><?php echo $rw4->address;?></td>
                        </tr>
                        <tr>
                            <td> City </td>
                            <td> <?php echo $rw4->city;?> </td>
                        </tr>
                        <tr>
                            <td> State </td>
                            <td>  <?php echo $rw4->state_name; ?> </td>
                        </tr>
                        <tr>
                            <td> Country </td>
                            <td>  <?php echo $rw4->country; ?> </td>
                        </tr>
                         <tr>
                            <td> Pincode </td>
                            <td> <?php echo $rw4->pin_code; ?> </td>
                        </tr>
                        <tr>
                            <td> Phone Number </td>
                            <td><?php echo $rw4->phone ;?></td>
                        </tr>
                    </table>
				</div>
				<div id="tab4" class="tab-pane fade">
                	<h3>Product Details</h3>
					
                    <table class="table table-bordered table-hover">
								<tr>
									<td style="width:20%;"> Product Name </td>	
									<td> SKU </td>
									<td> Quantity </td>
									<td> Unit Price </td>
                                    <td> Tax amount </td>
                                    <td> Shipping Fees </td>
                                    <td> COD Charges</td>
									<td> Total Price </td>
								</tr>
                                <?php 
								$total_price=0;
								 $qr5=$this->db->query("select * from ordered_product_from_addtocart where order_id='$orderid' group by sku"); 
										foreach($qr5->result() as $rw5)
									{								
								
								?>
                                <tr>
									<td style="width:45%;">
                                    
                                    <?php  
									   //$image_cart=explode(',',$rec_cart->imag);
									   $qr6=$this->db->query("select a.imag from product_image a inner join ordered_product_from_addtocart b on a.product_id=b.product_id   where b.product_id='$rw5->product_id' group by b.product_id");
									   $rw6=$qr6->row();
									   $image_cart=explode(',',$rw6->imag);
									   
							?><div style="float:left; width:15%;"><img src="<?php echo base_url().'images/product_img/'.$image_cart[0]; ?>" width="30" class="list_img"> </div>
                                    
                                <div style="float:left; width:83%;"><?php  $qr7=$this->db->query("select name from product_general_info where product_id='$rw5->product_id'");
											   $rw7=$qr7->row(); 
											   echo "<b>". $rw7->name ."</b><br>" ; 
//											   if($rw5->prdt_size!='' && $rw5->prdt_size!='not')
//											   {echo "Size: " .$rw5->prdt_size."<br>";}
//											   if($rw5->prdt_color!='' && $rw5->prdt_color!='not')
//											   {echo "Color: " .$rw5->prdt_color."<br>";} 
											   
											   
											   $color_sizecronjobquery=$this->db->query("SELECT color,size,Capacity,RAM,ROM FROM  cornjob_productsearch WHERE sku='$rw5->sku' group by sku ");
									if($color_sizecronjobquery->num_rows()>0)
									{										
										$color=$color_sizecronjobquery->row()->color;
										$size=$color_sizecronjobquery->row()->size;
										$capacity=$color_sizecronjobquery->row()->Capacity;
										$ram=$color_sizecronjobquery->row()->RAM;
										$rom=$color_sizecronjobquery->row()->ROM;
									}
									
									if($color != ''){ echo "<span class='cart_attr'>Color : ".$color.'</span><br/>'; }
									if($size != ''){ echo "<span class='cart_attr'>Size : ".$size.'</span><br/>'; }
									if($capacity != ''){ echo "<span class='cart_attr'>Capacity : ".$capacity.'</span><br/>'; }
									if($ram != ''){ echo "<span class='cart_attr'>RAM : ".$ram.'</span><br/>'; }
									if($rom != ''){ echo "<span class='cart_attr'>ROM : ".$rom.'</span><br/>'; }
											   
											   ?> 
                                               
                                              
                                       <?php        
											$query_sellername=$this->db->query("select a.business_name from seller_account_information a inner join product_master b on a.seller_id=b.seller_id  where b.sku='$rw5->sku'  ");
					   $count_row=$query_sellername->num_rows();
					   if($count_row!=0){
					   $rw_sellername=$query_sellername->row();
						
					//    print_r($rw_sellername->business_name);}
					   echo "Seller Name: ". $rw_sellername->business_name; }
					   else { echo "Seller Name: moonboy";}
                                               ?> </div>
                                               <div class="clearfix"></div>
                                      </td>	
								
									<td><?php echo $rw5->sku; ?> </td>
									
									<td>  <?php $qr9=$this->db->query("select * from ordered_product_from_addtocart where product_id='$rw5->product_id' and                                                 sku='$rw5->sku' and order_id='$orderid'  ");  
								  //$row3=$qr3->row();
								  $price=0;
								  $rw9=$qr9->row(); 
								echo  $rw9->quantity; ?> </td>
									
									<td> <?php
									
									 $tax_amt=$rw9->sub_tax_rate;
								  $shipping_amnt=$rw9->sub_shipping_fees;
								  $qtn=$rw9->quantity;
								  
									$codchrg=$this->db->query("SELECT * FROM cod_transaction_log WHERE order_id='$orderid' ");
									if($codchrg->num_rows()>0)
									{
										$rw_codcharge=$codchrg->result();
										$cod_chargetobuyer=$rw_codcharge[0]->charge_tobuyer/$qtn;
										$cod_tax=$rw_codcharge[0]->tax/$qtn;										
										$cod_totalcharges=($cod_chargetobuyer+$cod_tax);
										
										$single_prod_price=((($rw9->sub_total_amount-$tax_amt)-$shipping_amnt)/$qtn)-$cod_totalcharges;	
										echo "<i class='fa fa-inr'></i>".round($single_prod_price);
									
									}else
								 
								 {
								  	$single_prod_price=(($rw9->sub_total_amount-$tax_amt)-$shipping_amnt)/$qtn;	
									echo "<i class='fa fa-inr'></i>".round($single_prod_price);
									}
									
									
									 ?>  </td>
									<td><i class="fa fa-inr"></i> <?php echo $rw9->sub_tax_rate; ?></td>
                                    <td><i class="fa fa-inr"></i> <?php echo $rw9->sub_shipping_fees; ?></td>
                                    <td> <?php 
									$codchrg=$this->db->query("SELECT * FROM cod_transaction_log WHERE order_id='$orderid' ");
									if($codchrg->num_rows()>0)
									{
										$rw_codcharge=$codchrg->result();
										$cod_chargetobuyer=$rw_codcharge[0]->charge_tobuyer;
										$cod_tax=$rw_codcharge[0]->tax;
										
										$cod_totalcharges=($cod_chargetobuyer+$cod_tax);
										
										echo "<i class='fa fa-inr'></i>".$cod_totalcharges; 
									}
									else
									{
										echo "<i class='fa fa-inr'></i>0";
									}
									
									
									?></td>
									<td> <i class="fa fa-inr"></i> <?php echo $rw9->sub_total_amount; ?> </td>
									
									
									
								</tr>
                                
                                <?php } ?>
                                
                                <tr><td colspan="7" style="text-align:right;">Total Amount :(Including Tax & Shipping Fees)</td><td><i class="fa fa-inr"></i> <?php 
								
								$qr11=$this->db->query("select * from order_info where order_id='$orderid' ");  
									  $rec11=$qr11->result();
									  echo  $rec11[0]->Total_amount;
								  ?></td>
                                  
                                  </tr>                               
                                <!--<tr><td colspan="4" style="text-align:right;">Tax</td><td> <i class="fa fa-inr"></i></td></tr>
                                 <tr><td colspan="4" style="text-align:right;">Shipping Rate</td><td> <i class="fa fa-inr"></i></td></tr>
                                <tr><td colspan="4" style="text-align:right;">Total </td><td> <i class="fa fa-inr"></i> </td></tr>-->
                                </table>
                    
                    
				</div>
                <!--<div id="tab5" class="tab-pane fade">
                	<h3>Images</h3>
					<table>
                        <tr>
                            <td style="width:20%;">Upload Image</td>
                            <td class="product_image">
                            	<input type="file" id="files" name="userfile[]" multiple>
                                <ul id="condn">
                                	<li>Maximum images supported : 5</li>
                                    <li>Minimum images requirded : 2</li>
                                </ul>
                            </td>
                        </tr>
					</table>
				</div>
                <div id="tab6" class="tab-pane fade">
                	<h3>Inventory</h3>
						<table>
                          <tr>
                              <td>Qty<sup>*</sup></td>
                              <td><input type="text" class="text2" name="qty" id="qty"></td>
                          </tr>
                          <tr>
                              <td> Maximum Qty Allowed in Shopping Cart </td>
                              <td> 
                                  <input type="text" class="text2" name="max_qty" id="max_qty">
                                  <input id="manage_stock" class="checkbox" type="checkbox" checked="checked" />
                                  <label> Use Config Settings </label>
                              </td>
                          </tr>
                          <tr>
                              <td> Enable Qty Increments </td>
                              <td> 
                                  <select class="text2" name="enable_qty_increment">
                                      <option value="Yes"> Yes </option>
                                      <option selected="selected" value="No"> No </option>
                                  </select>
                              </td>
                          </tr>
                          <tr>
                              <td> Stock Availability </td>
                              <td> 
                                  <select class="text2" name="stock_avail">
                                      <option value="In Stock" selected="selected"> In Stock </option>
                                      <option value="Out of Stock"> Out of Stock </option>
                                  </select>
                              </td>
                          </tr>
					</table>
				</div>
                <div id="tab7" class="tab-pane fade">
                	<h3>Categories</h3>
						
				</div>
                <div id="tab8" class="tab-pane fade">
                	<h3>Related Products</h3>
                    <div class="row content-header">
						<!--<div class="col-md-8"><b>New Product (Default)</b></div>
						<div class="col-md-4 show_report">
							<button type="button" class="all_buttons">Save and Continue Edit</button>
							<button type="button" class="all_buttons">Save</button>
							<button type="button" class="all_buttons">Reset</button>
							<button type="button" class="all_buttons">Back</button>
						</div>-->
					</div>
                    <div class="row">
						<!--<div class="col-md-8">
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

	</body>
</html>