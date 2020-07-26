<?php include "header.php"; 

$arr = (array)$sku;
 $total_price=0;
?>

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
                      <?php     foreach($sku as $key=>$rec_cart){ ?>
							  <div class="cart_box">
							   	 <div class="message">
							   	     <div class="alert-close" onClick="removeCartProduct('<?=$rec_cart;?>');"> Remove <i class="fa fa-times-circle"> </i> </div> 
					                <div class="list_img">
                                   <?php  
									   //$image_cart=explode(',',$rec_cart->imag);
									   $qr1=$this->db->query("select a.imag,b.sku,c.name,b.product_id from product_image a inner join product_master b on a.product_id=b.product_id 			                                                               inner join product_general_info c on b.product_id=c.product_id where b.sku='$rec_cart'");
									   $rw1=$qr1->row();
									   $image_cart=explode(',',$rw1->imag);
   
                                       ?>   <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($rw1->name)))).'/'.$rw1->product_id.'/'.$rw1->sku  ?>"><img src="<?php echo base_url().'images/product_img/'.$image_cart[0]; ?>" class="img-responsive" alt=""> </a>
                                     </div>
								    <div class="list_desc"><h4><!--<a href="#">Velit esse molestie</a>-->
                                    
                                    
                                    <?php  $qr2=$this->db->query("select a.name from product_general_info a inner join product_master b on a.product_id=b.product_id  where b.sku='$rec_cart'");
   $rw2=$qr2->row(); 
   echo "<a href='#'>". $rw2->name ."</a>" ; ?>
                                    </h4>
                                    <div class="actual"> <span> 
                                    <!---------------------------price section start------------------------------->
                                    
                                    <?php  //$user_id=$this->session->userdata['session_data']['user_id'];
									$ct=count($rec_cart);
	  $qr3=$this->db->query("select * from product_master  where sku='$rec_cart'   ");  
	  
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
			
	  
	   echo "Rs.".$final_price = ceil($price/$ct);
	   $total_price=$total_price+$final_price;  
	   ?>
                                    <!---------------------------price section end---------------------------------->
                                    
                                    </span> </div>
                                    <!--<div class="quantity"> 
                                    <input type="text" class="quantity_added" name="quantity_added" value="" placeholder="qty" />
                                    <input type="button"  value="save" class="btn-success add-btn">
                                    </div>-->
                                    <div class="clearfix"></div>
									    <div class="delivery">
										 <p><i class="fa fa-check-square-o"></i> 100% Refund / Replacement Guarantee* </p>
										
                                    <?php     
                                         $query_sellername=$this->db->query("select a.business_name,a.seller_id from seller_account_information a inner join product_master b on a.seller_id=b.seller_id  where b.sku='$rec_cart'  ");
   $count_row=$query_sellername->num_rows();
   if($count_row!=0){
   $rw_sellername=$query_sellername->row();
   $sellerid1=$rw_sellername->seller_id;
   ?>
   <a onclick="gosellerReview(<?= $sellerid1; ?>)" id="goslr" style="cursor:pointer !important;">
   <?php  
	echo "Seller : "."<span class='blue'>".$rw_sellername->business_name."</span>"; }
	else { echo "Seller: ".COMPANY;}?>
                                         
                                         </a>
										 <div class="clearfix"></div>
                                        
                                         <!--<div class="total-price"> Sub Total : Rs. 3443 </div>-->
									    </div>
                                        
									 </div>
		                              <div class="clearfix"></div>
	                              </div>
								 
	                            </div>
	                            <?php } ?>
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


<?php include "footer.php";  ?>