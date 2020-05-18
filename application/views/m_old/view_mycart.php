<?php if(@$this->session->userdata['session_data']['user_id']!='') {?>


<?php 
include "header.php"; 

if($this->session->userdata('addtocarttemp_session_id')=="")
{
		$dtm = str_replace(" ","-",date('Y-m-d H:i:s'));
		$addtocarttemp_session_id=random_string('alnum', 16).$dtm;
		$this->session->set_userdata('addtocarttemp_session_id',$addtocarttemp_session_id);
		
		$data= array();
		$this->session->set_userdata('addtocarttemp',$data);
		$arr_sku=array();
		$this->session->set_userdata('addtocart_sku',$arr_sku);
	}


?>
 <link rel="canonical" href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2)?>"/>
<script>
function valid_function(product_id,sku_id,session_id,user_id,rec_count,addtocart_id,quantity,sl){
		//alert(sl);return false;
	var quantity_added = $('#quantity_added'+sl).val();
   // alert(quantity_added);return false;
    if(isNaN(quantity_added)){
		alert('Entered value is not a number,please enter a number');
		$('#quantity_added'+sl).focus();
		return false;
	}
	$('#submit1'+sl).val('Wait..');
		$.ajax({
			url:'<?php echo base_url(); ?>mycart/insert_detail',
			method:'post',
			data:{product_id:product_id,sku_id:sku_id,session_id:session_id,user_id:user_id,rec_count:rec_count,addtocart_id:addtocart_id,quantity:quantity,sl:sl,quantity_added:quantity_added},
			success:function(result){
				if(result == 'success'){
					window.location.reload('<?php echo base_url(); ?>mycart/mycart_detail');
				}
			}
		});
	
}
</script>

<script>
function removeCartProduct(rec_cart){
	//window.onload = $('#limg').css('display','block');
	window.location.href="<?php echo base_url();?>mycart/remove_from_cart/"+rec_cart;
}
</script>	
    
  <div class="wrap push" id="home">
    <!--/view-product-->
  <div class="view-product">
  
				<!--/checkout-->
				  <div class="checkout" id="checkout">
				      <h3 class="tittle two"> My Cart </h3>
					<ul class="icon1 sub-icon1 profile_img">
						<ul class="sub-icon1 list">
						  <h3>My Shopping Bag(<?php if($cart_data->num_rows()!=0){echo @$cart_data->num_rows();}else{echo '0';} ?>)</h3>
						  <div class="shopping_cart">
                         <?php  $arr=$cart_data->num_rows();
   								
									$total_price=0; $sl=0;foreach($cart_data->result() as $rec_cart){$sl++; 
   									$product_id=$rec_cart->product_id;
									
	   						 $qr1=$this->db->query("select d.name, b.image as imag , c.product_id, e.quantity,e.sku  from product_general_info d inner join 		                                                   seller_product_master a ON a.master_product_id=d.product_id
	   												INNER JOIN  seller_existingproduct_image b ON a.seller_exist_product_id=b.seller_extproduct_id 
	   												INNER JOIN product_image c ON c.product_id=a.master_product_id
	   												INNER JOIN product_master e on d.product_id=e.product_id 
													WHERE  a.sku='$rec_cart->sku' ");
		
						if($qr1->num_rows()==0)
						{
							
							$qr1=$this->db->query("select a.product_id,a.name,b.sku,b.quantity,c.imag from product_general_info a inner join product_master b on a.product_id=b.product_id inner join product_image c on a.product_id=c.product_id where a.product_id='$rec_cart->product_id'");
						}
							
						   $rw1=$qr1->row();
						   $image_cart=explode(',',$rw1->imag);
    						$avail_qnt=$rw1->quantity;
								?>
                          
                          <!-------------------------------------- cart box ctart--------------------------------------------->
							  <div class="cart_box">
							   	 <div class="message">
							   	     <div class="alert-close" onClick="removeCartProduct('<?=$rec_cart->addtocart_id;?>');"> Remove <i class="fa fa-times-circle"> </i> </div> 
					                <div class="list_img">
                                   <!-- <a href="#"><img src="images/1.jpg" class="img-responsive" alt=""/> </a>-->
                                    
                                     <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($rw1->name)))).'/'.$rw1->product_id.'/'.$rw1->sku  ?>"  class="img-responsive" alt="">
                                    <img src="<?php echo base_url().'images/product_img/'.$image_cart[0]; ?>" alt="<?=$rw1->name;?>"></a>
                                    
                                    </div>
                                    
								    <div class="list_desc"><h4>                                    
                                   <!-- <a href="#">Velit esse molestie</a>-->
                                    
                                     <?php  $qr2=$this->db->query("select name from product_general_info where product_id='$rec_cart->product_id'");
   $rw2=$qr2->row(); 
   echo "<a href="."'".base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($rw1->name))))."/".$rw1->product_id."/".$rw1->sku."'".">". $rw2->name ."</a> <br><br>" ;
   
   //	if($rec_cart->prdt_color != ''){ echo "<span class='cart_attr'>Color : ".$rec_cart->prdt_color.'</span><br/>'; }
//   	if($rec_cart->prdt_size != ''){ echo "<span class='cart_attr'>Size : ".$rec_cart->prdt_size.'</span><br/>';} 

		$color_sizecronjobquery=$this->db->query("SELECT color,size,Capacity,RAM,ROM FROM  cornjob_productsearch WHERE sku='$rec_cart->sku' group by sku ");
   	if($color_sizecronjobquery->num_rows()>0)
	{
		$color_rw=$color_sizecronjobquery->row()->color;
		$size_rw=$color_sizecronjobquery->row()->size;
		$capacity=$color_sizecronjobquery->row()->Capacity;
		$ram=$color_sizecronjobquery->row()->RAM;
		$rom=$color_sizecronjobquery->row()->ROM;
	  
	   
		//if($rec_cart->prdt_color != ''){ echo "<span class='cart_attr'>Color : ".$rec_cart->prdt_color.'</span><br/>'; }
	//   	if($rec_cart->prdt_size != ''){ echo "<span class='cart_attr'>Size : ".$rec_cart->prdt_size.'</span><br/>';}
		
		if($color_rw != ''){ echo "<span class='cart_attr'>Color : ".$color_rw.'</span><br/>'; }
		if($size_rw != ''){ echo "<span class='cart_attr'>Size : ".$size_rw.'</span><br/>';}
		if($capacity != ''){ echo "<span class='cart_attr'>Capacity : ".$capacity.'</span><br/>';}
		if($ram != ''){ echo "<span class='cart_attr'>RAM : ".$ram.'</span><br/>';}
		if($rom != ''){ echo "<span class='cart_attr'>ROM : ".$rom.'</span><br/>';}
	}
?>
                                    </h4>
                                    <div class="actual"> <span> Rs. 
                                    <!----------------------------Price Section Start----------------------->
                                    
                                    	<?php  $user_id=$this->session->userdata['session_data']['user_id'];
	  $qr3=$this->db->query("select * from addtocart_temp where product_id='$rec_cart->product_id' and user_id='$user_id' and sku='$rec_cart->sku'");  
	  //$row3=$qr3->row();
	  $price=0;
	  $ct_rec = $qr3->num_rows();
	  foreach($qr3->result() as $rw_price)
	  {
		  
		  $qr4=$this->db->query("select * from product_master where sku='$rw_price->sku'"); 
		  $rec4=$qr4->result();
		  
		  $cdate = date('Y-m-d');
		  $special_price_from_dt = $rec4[0]->special_pric_from_dt;
		  $special_price_to_dt = $rec4[0]->special_pric_to_dt;
		 
		  
		  if($rec4[0]->special_price !=0){
			  if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
		  			$price= $price + $rec4[0]->special_price;
			  }else{
				  	if($rec4[0]->price != 0){
				    	$price= $price + $rec4[0]->price;
					}else{
						$price= $price + $rec4[0]->mrp;
					}
			  } //End of date condition
		  }else{
			  	if($rec4[0]->price != 0){
				    $price= $price + $rec4[0]->price;
				}else{
					$price= $price + $rec4[0]->mrp;
				}
		  } //End of date special_price!=0 condition
	  }
	  echo ceil($price/$ct_rec);
	  
	   ?>
                                    <?php
									  
									$user_id=$this->session->userdata['session_data']['user_id'];
									$qr2=$this->db->query("select * from addtocart_temp  where product_id='$rec_cart->product_id' and user_id='$user_id' and sku='$rec_cart->sku' ");
								   $rec_ct=$qr2->num_rows(); 
								  // echo ($rec_ct);
								   foreach($qr2->result() as $rw){
									 $product_id1=$rw->product_id;
									 $sku_id1=$rw->sku;
									 $session_id=$rw->addtocart_session_id;}
									$qr3=$this->db->query("select * from product_master where product_id='$product_id1' and sku='$sku_id1' ");
								   $query=$qr3->num_rows(); 
								  // echo ($rec_ct);  
								  
								   foreach($qr3->result() as $row1){
									 $product_id1=$row1->product_id;
									 $sku_id1=$row1->sku;
									 $quantity_table=$row1->quantity;}
									// echo ($quantity_table);  
								   ?>
                                    <!----------------------------Price Section End-------------------------->
                                  <?php
								  
								  $user_id=$this->session->userdata['session_data']['user_id'];
                                    $qr2=$this->db->query("select * from addtocart_temp  where product_id='$rec_cart->product_id' and user_id='$user_id' and sku='$rec_cart->sku' ");
                                   $rec_ct=$qr2->num_rows(); 
                                    ?>
                                    </span> </div>
                                    <div class="quantity">
                                     <?php if($avail_qnt>0) {?> 
                                    <input type="number" step="1" min="1" class="quantity_added" id="quantity_added<?=$sl;?>" name="quantity_added" value="<?php echo ($rec_ct); ?>" placeholder="qty" />
                                    <input type="button"  value="save" class="btn-success add-btn" onClick="valid_function('<?=$product_id1;?>','<?=$sku_id1;?>','<?=$session_id;?>','<?=$user_id;?>','<?=$rec_ct;?>','<?=$rec_cart->addtocart_id;?>','<?=@$quantity_table;?>','<?=$sl;?>')" id="submit1<?=$sl;?>">
                                    <?php }else{ ?>
                                    <label>Quantity: <?php echo ($rec_ct); ?></label>
                                    <?php } ?>
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                    <?php if($avail_qnt<=0) {?> <span style="background-color:#900; color:#FFF; font-weight:bold;">Out Of Stock. </span> <?php } ?>
									    <div class="delivery">
										 <p><i class="fa fa-check-square-o"></i> 100% Refund / Replacement Guarantee* </p>
                                         <?php 
										 		
										$query_sellername=$this->db->query("select a.business_name,a.seller_id from seller_account_information a inner join product_master b on                                                                             a.seller_id=b.seller_id where b.sku='$rec_cart->sku'");
									   $count_row=$query_sellername->num_rows();
									   if($count_row!=0){
									   $rw_sellername=$query_sellername->row();
										  ?>
										 <!--<a href="#"> <span> Seller : </span> Omm International</a>-->
                                         
                                        <a href="<?php echo base_url() ;?>sellers/<?= base64_encode($this->encrypt->encode($rw_sellername->seller_id));?>" id="goslr" style="cursor:pointer !important;">
                                        <span>  Seller :</span>
									   <?php 
                                       echo $rw_sellername->business_name; }
                                       else { echo "Seller:  moonboy ";}
                                       ?>
                                       </a>
                                         
                                         
										 <div class="clearfix"></div>
                                         <div class="sphng"> 
                                         <?php if($rec4[0]->shipping_fee_amount!=0)
											{
												echo 'Shipping Fees Rs.'.$rec4[0]->shipping_fee_amount*$rec_ct;
											}
										?>
                                         </div>
                                         <div class="dlvry-date">  
                                         
                                         <?php 
											$qr11 = $this->db->query("SELECT c.dispatch_days
											FROM seller_account a 
											INNER JOIN state b ON a.seller_state = b.state
											INNER JOIN dispatched_day_setting c ON b.state_id = c.state_id
											WHERE a.seller_id = '$rw_sellername->seller_id'");
											$ct11 = $qr11->num_rows();
											$res11 = $qr11->row();
											if($ct11 > 0){
												$days = $res11->dispatch_days+5; 
												   
												date_default_timezone_set('Asia/Calcutta');
												$dt =  date('d M', strtotime(+$days.'days'));
												echo "Standard delivery by ". $dt;
											}else{
												$dt1 =  date('d M', strtotime(+'12 days'));
												echo $dt1;
												//echo "Standard delivery by 10-12 Days";
											}
									?>
                                         
                                         <?php
										 	$subtotal_price = 0;
			
											 $subtotal_price=$subtotal_price+$rec4[0]->shipping_fee_amount*$rec_ct+ceil($price) ;
											if($avail_qnt>0) {  $total_price=ceil($total_price+$subtotal_price);}
										 
										  ?>
                                         </div>
                                         <div class="clearfix"></div>
                                         <div class="total-price"> Sub Total : Rs. <?php echo   number_format($subtotal_price, 0, ".", ",")?> </div>
									    </div>
                                        
									 </div>
		                              <div class="clearfix"></div>
	                              </div>
								 
	                            </div>
	                  <?php 
					  
					  					  
					  }  ?>          
	            <!-------------------------------------- cart box end---------------------------------------------->                
	                        </div>
				            
                            
                            <div class="cart-total">
								<div class="total_left">Cart Total : </div>
								<div class="total_right">Rs. <?php echo " ".  number_format($total_price, 0, ".", ",")?></div>
								<div class="clearfix"> </div>
							</div>
								<div class="btn_form">
				  
                  <?php if($cart_data->num_rows()!=0 && $total_price>0) { ?>
                  <a href="<?php echo base_url() ?>"> <span class="submit">  Continue Shopping </span> </a>
                  <a href="<?php echo base_url().'mycart/checkout_process' ?>"> <span class="buy-btn">  Proceed To Checkout  </span> </a>
                  <?php }else{ ?>
                  <a href="<?php echo base_url() ?>"> <span class="submit" style="width:400px;">  Continue Shopping </span> </a>
                  <?php } ?>
				</div>
									  <div class="clearfix"></div>
									</ul>
								 </li>
						  </ul>
							<!--<script>$(document).ready(function(c) {
								$('.alert-close').on('click', function(c){
									$('.message').fadeOut('slow', function(c){
										$('.message').remove();
									});
								});	  
							});
							</script>
							<script>$(document).ready(function(c) {
								$('.alert-close1').on('click', function(c){
									$('.message1').fadeOut('slow', function(c){
										$('.message1').remove();
									});
								});	  
							});
							</script>
							<script>$(document).ready(function(c) {
								$('.alert-close2').on('click', function(c){
									$('.message2').fadeOut('slow', function(c){
										$('.message2').remove();
									});
								});	  
							});
							</script>-->
						</div>
				  <!--//checkout-->
				  
  </div>

     <!--/view-product-->
				
		</div>  
    
    

<?php include "footer.php"; ?>

<?php }else{ ?>
<!---------------------------------------guset cart page start here---------------------------------------------->


<?php include "header.php"; 

$arr = (array)$sku;
 $total_price=0;
?>
 <link rel="canonical" href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2)?>"/>
<script>
function removeCartProduct(rec_cart){
	//window.onload = $('#limg').css('display','block');
	window.location.href="<?php echo base_url();?>mycart/remove_from_tempcart/"+rec_cart;
}
</script>	
<div class="wrap push" id="home">
    <!--/view-product-->
  <div class="view-product">
  
				<!--/checkout-->
				  <div class="checkout" id="checkout">
				      <h3 class="tittle two"> My Cart </h3>
					<ul class="icon1 sub-icon1 profile_img">
						<ul class="sub-icon1 list">
						  <h3> My Shopping Bag(<?php echo count($arr); ?>)</h3>
						  <div class="shopping_cart">
                          <!---------------------carbtox start----------------------------->
                      <?php 
					  $txtboxsl=0; 
					  @$prodsku_arr=$this->session->userdata['addtocart_sku'];
					  if(count($prodsku_arr)>0){
					     foreach($sku as $rec_cart){ 
						 
						 $prod_qnt=0;
						 foreach($prodsku_arr as $k=>$val)
						{	
							if($val==$rec_cart->sku)
							{$prod_qnt=$prod_qnt+1;}	
						}  
						 ?>
							  <div class="cart_box">
							   	 <div class="message">
							   	     <div class="alert-close" onClick="removeCartProduct('<?=$rec_cart->sku;?>');"> Remove <i class="fa fa-times-circle"> </i> </div> 
					                <div class="list_img">
                                   <?php
								   
								   $qr1=$this->db->query("select d.name, b.image as imag , c.product_id, e.quantity,e.sku  from product_general_info d inner join 		                                                   seller_product_master a ON a.master_product_id=d.product_id
	   												INNER JOIN  seller_existingproduct_image b ON a.seller_exist_product_id=b.seller_extproduct_id 
	   												INNER JOIN product_image c ON c.product_id=a.master_product_id
	   												INNER JOIN product_master e on d.product_id=e.product_id 
													WHERE  a.sku='$rec_cart->sku' ");
		
								if($qr1->num_rows()==0)
								{
							
								     
									   //$image_cart=explode(',',$rec_cart->imag);
									$qr1=$this->db->query("select a.imag,b.sku,c.name,b.product_id from product_image a inner join product_master b on                                                           a.product_id=b.product_id inner join product_general_info c on b.product_id=c.product_id where                                                            b.sku='$rec_cart->sku'");
								}
									   $rw1=$qr1->row();
									   $image_cart=explode(',',$rw1->imag);
   
                                       ?>   <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($rw1->name)))).'/'.$rw1->product_id.'/'.$rw1->sku  ?>"><img src="<?php echo base_url().'images/product_img/'.$image_cart[0]; ?>" class="img-responsive" alt=""> </a>
                                     </div>
								    <div class="list_desc"><h4><!--<a href="#">Velit esse molestie</a>-->
                                    
                                    
                                    <?php  $qr2=$this->db->query("select a.name from product_general_info a inner join product_master b on a.product_id=b.product_id  where b.sku='$rec_cart->sku'");
   $rw2=$qr2->row(); 
   echo "<a href='#'>". $rw2->name ."</a> <br><br>" ; 
   
   
   $color_sizecronjobquery=$this->db->query("SELECT color,size,Capacity,RAM,ROM FROM  cornjob_productsearch WHERE sku='$rec_cart->sku' group by sku ");
   	if($color_sizecronjobquery->num_rows()>0)
	{
		$color_rw=$color_sizecronjobquery->row()->color;
		$size_rw=$color_sizecronjobquery->row()->size;
		$capacity=$color_sizecronjobquery->row()->Capacity;
		$ram=$color_sizecronjobquery->row()->RAM;
		$rom=$color_sizecronjobquery->row()->ROM;
	  
	   
		//if($rec_cart->prdt_color != ''){ echo "<span class='cart_attr'>Color : ".$rec_cart->prdt_color.'</span><br/>'; }
	//   	if($rec_cart->prdt_size != ''){ echo "<span class='cart_attr'>Size : ".$rec_cart->prdt_size.'</span><br/>';}
		
		if($color_rw != ''){ echo "<span class='cart_attr'>Color : ".$color_rw.'</span><br/>'; }
		if($size_rw != ''){ echo "<span class='cart_attr'>Size : ".$size_rw.'</span><br/>';}
		if($capacity != ''){ echo "<span class='cart_attr'>Capacity : ".$capacity.'</span><br/>';}
		if($ram != ''){ echo "<span class='cart_attr'>RAM : ".$ram.'</span><br/>';}
		if($rom != ''){ echo "<span class='cart_attr'>ROM : ".$rom.'</span><br/>';}
	}
   
   
   ?>
                                    </h4>
                                    <div class="actual"> <span> 
                                    <!---------------------------price section start------------------------------->
                                    
                                    <?php  //$user_id=$this->session->userdata['session_data']['user_id'];
									$ct=count($rec_cart->sku);
	  $qr3=$this->db->query("select * from product_master  where sku='$rec_cart->sku'   ");  
	  
		$rec4=$qr3->result();
	   //echo $price[0]->price;
	   $price=0;
	   //========================================================
	   
	    $cdate = date('Y-m-d');
		  $special_price_from_dt = $rec4[0]->special_pric_from_dt;
		  $special_price_to_dt = $rec4[0]->special_pric_to_dt;
		  
		  //calculatin tax amount//
		  //$tax_class = $rec4[0]->tax_class;
		  //$tax_sql = $this->db->query("SELECT tax_rate_percentage FROM tax_management WHERE tax_id='$tax_class'");
		 // $tax_res = $tax_sql->row();
		  //$tax_persent = $tax_res->tax_rate_percentage;
		  $tax_persent = $rec4[0]->tax_amount;
		  $taxdecimal = $tax_persent/100;
		  
		  //array_push($tax_arr,$taxdecimal);
		  //tax amount for product price
		 $tax_amount = $rec4[0]->price*$taxdecimal;
					
		  //tax amount for product special price
		  $tax_amount_special = $rec4[0]->special_price*$taxdecimal;
		  
		  //tax amount for product mrp price
		  $tax_amount_mrp = $rec4[0]->mrp*$taxdecimal;
		  ///calculating tax amount script end here///
		  
		  if($rec4[0]->special_price !=0){
			  if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
				  //array_push($tax_arr,$tax_amount_special*$ct);
				  
		  			$price= $price + $rec4[0]->special_price;
			  }else{
				  //array_push($tax_arr,$tax_amount*$rec_ct);
				    //$price= $price + $rec4[0]->price;
					if($rec4[0]->price != 0){
						//array_push($tax_arr,$tax_amount*$ct);
				    	$price= $price + $rec4[0]->price;
					}else{
						//array_push($tax_arr,$tax_amount_mrp*$ct);
						$price= $price + $rec4[0]->mrp;
					}
			  } //End of date condition
		  }else{
			  //array_push($tax_arr,$tax_amount*$rec_ct);
			  //$price= $price + $rec4[0]->price;
			  
			  	if($rec4[0]->price != 0){
					//array_push($tax_arr,$tax_amount*$ct);
				    $price= $price + $rec4[0]->price;
				}else{
					//array_push($tax_arr,$tax_amount_mrp*$ct);
					$price= $price + $rec4[0]->mrp;
				}
			  
		  } //End of date special_price!=0 condition
			
	  
	  //echo "Rs.".$final_price = ceil($price/$ct);
	    echo "Rs.".$final_price = ceil($price*$prod_qnt);
	   $total_price=$total_price+$final_price;  
	   ?>
                                    <!---------------------------price section end---------------------------------->
                                    
                                    </span> </div>
                                    <div class="quantity"> 
                                    <input type="number" step="1" min="1" id="tmpquantity_added<?=$txtboxsl;?>" class="quantity_added" name="tmpquantity_added" value="<?php echo $prod_qnt; ?>" placeholder="qty" />
                                    <input type="button"  value="save" class="btn-success add-btn" onClick="valid_qtysave('<?=$txtboxsl;?>','<?=$rec_cart->sku;?>')" id="submit1<?=$txtboxsl;?>">
                                    </div>
                                    <div class="clearfix"></div>
									    <div class="delivery">
										 <p><i class="fa fa-check-square-o"></i> 100% Refund / Replacement Guarantee* </p>
										
                                    <?php     
                                         $query_sellername=$this->db->query("select a.business_name,a.seller_id from seller_account_information a inner join product_master b on a.seller_id=b.seller_id  where b.sku='$rec_cart->sku'  ");
   $count_row=$query_sellername->num_rows();
   if($count_row!=0){
   $rw_sellername=$query_sellername->row();
   $sellerid1=$rw_sellername->seller_id;
   ?>
   <a onclick="gosellerReview(<?= $sellerid1; ?>)" id="goslr" style="cursor:pointer !important;">
   <?php  
	echo "Seller : "."<span class='blue'>".$rw_sellername->business_name."</span>"; }
	else { echo "Seller:  moonboy ";}?>
                                         
                                         </a>
										 <div class="clearfix"></div>
                                         <!--<div class="sphng"> Shipping Fees Rs.100</div>-->
                                        <!-- <div class="dlvry-date"> Standard delivery by 07 Jul  </div>-->
									    </div>
                                        
									 </div>
		                              <div class="clearfix"></div>
	                              </div>
								 
	                            </div>
	                            <?php $txtboxsl++;} 
					  } // if condition end
								?>
	                            <!---------------------carbtox end----------------------------->
	                        </div>
				            
                            <div class="cart-total">
								<div class="total_left">Cart Total : </div>
								<div class="total_right">Rs. <?php echo $total_price; ?> </div>
								<div class="clearfix"> </div>
							</div>
								<div class="btn_form">
                            <?php  if(count($arr)>0 ) {?>
				  <a href="<?php echo base_url(); ?>"> <span class="submit">  Continue Shopping </span> </a>
                  <a href="<?php echo base_url().'user/m_login' ?>"> <span class="buy-btn">  Proceed To Checkout  </span> </a>
                  <?php }else { ?>
                  	<a href="<?php echo base_url() ?>"> <span class="submit" style="width:400px;">  Continue Shopping </span> </a>
                  <?php } ?>
				</div>
									  <div class="clearfix"></div>
									</ul>
								 </li>
						  </ul>
							<!--<script>$(document).ready(function(c) {
								$('.alert-close').on('click', function(c){
									$('.message').fadeOut('slow', function(c){
										$('.message').remove();
									});
								});	  
							});
							</script>
							<script>$(document).ready(function(c) {
								$('.alert-close1').on('click', function(c){
									$('.message1').fadeOut('slow', function(c){
										$('.message1').remove();
									});
								});	  
							});
							</script>
							<script>$(document).ready(function(c) {
								$('.alert-close2').on('click', function(c){
									$('.message2').fadeOut('slow', function(c){
										$('.message2').remove();
									});
								});	  
							});
							</script>-->
						</div>
				  <!--//checkout-->
				  
  </div>

     <!--/view-product-->
				
		</div>

<script>
 function valid_qtysave(txtboxsl,prod_sku)
{
	
	var qnt=$('#tmpquantity_added' + txtboxsl).val();
	 
		  
		  if(isNaN(qnt)){
		alert('Entered value is not a number,please enter a number');
		$('#tmpquantity_added' + txtboxsl).focus();
		return false;
	}
	if(qnt==''){
		alert('Enter quantity ');
		$('#tmpquantity_added' + txtboxsl).focus();
		return false;
	}
	if(qnt<=0){
		alert('Quantity should be greater than zero ');
		$('#tmpquantity_added' + txtboxsl).focus();
		return false;
	}
	$('#submit1'+txtboxsl).val('Wait..');
		$.ajax({
			url:'<?php echo base_url(); ?>mycart/update_tempprodqnt',
			method:'post',
			data:{prod_sku:prod_sku,prod_qnt:qnt},
			success:function(result){
				if(result == 'success'){
					window.location.reload(true);
				}
			}
		});
			
}
 </script> 
<?php include "footer.php";  ?>

<?php } ?>