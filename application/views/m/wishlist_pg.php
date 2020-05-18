 <?php include 'header.php'; ?>   
 <style>
 .info-inner, .view-product {
    /* padding-top: 2px; */
    margin-top: 100px;
}
.btn-save {
    width: auto;
}
.price_single .dlvry-date {
    color: #212020;
    text-align: right;
    padding: 0px;
    font-size: 11px;
}
</style>
 	<div class="view-product">
  
				<!--/cart-->
				  <div class="checkout">
				      <h3 class="tittle two"> My Wishlist </h3>
					
						<div class="list">
                       <?php $wishlist_row = $wishlist_products->num_rows(); ?>
						  <h3> <?=$wishlist_row?> Items in Your Wishlist</h3>
						  <div class="shopping_cart">
							  <?php
			if($wishlist_row > 0){
				foreach($wishlist_products->result() as $wishlist_result){
					$image = explode(',',$wishlist_result->imag);
					$cdate = date('Y-m-d');
					$special_price_from_dt = $wishlist_result->special_pric_from_dt;
					$special_price_to_dt = $wishlist_result->special_pric_to_dt;
					
					//$taxdecimal = $wishlist_result->tax_rate_percentage/100;
		
					//tax amount for product price
					//$tax_amount = $wishlist_result->price*$taxdecimal;
					
					//tax amount for product special price
					//$tax_amount_special = $wishlist_result->special_price*$taxdecimal;
			?>	                            
	                            <div class="cart_box">
								  <div class="message">
							   	     <div class="alert-close" onClick="removeFromWishlist(<?=$wishlist_result->wishlist_id; ?>)" > Remove <i class="fa fa-times-circle"> </i> </div> 
					                <div class="list_img"> <a href="#"> 
                                    <img src="<?php echo base_url();?>images/product_img/<?=$image[0]; ?>" class="img-responsive" alt="<?=$wishlist_result->name;?>"/> </a> </div>
										<div class="list_desc">
                                        <h4><a href="<?php echo base_url().'product_description/addtocart_temp/'.preg_replace('#/#',"-",str_replace(" ","-",strtolower($wishlist_result->name))).'/'.$wishlist_result->product_id.'/'.$wishlist_result->sku; ?>" target="_blank"><?=$wishlist_result->name; ?></a></h4>
										<!--<div class="actual"> <span> Rs.12.00</span> </div>-->
                                        
                                        <!--- price calculation div start here --->
                                           
                                            <!---Special price exists condition start here --->
                                            
                                            <?php
                                            if($wishlist_result->special_price !=0){
                                                if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                                            ?>
                                            
                                            <div class="cut-price"> Rs. <?=ceil($wishlist_result->mrp); ?> </div> 
                                            <?php if($wishlist_result->price != 0){?>
                                           <div class="reducedfrom"> Rs. <?=ceil($wishlist_result->price); ?> </div> 
                                            <?php }?>
                                            
                                            <div class="actual"><span> Rs. <?=ceil($wishlist_result->special_price); ?></span> </div>
                                            <!---Special price exists condition end here --->
                                            <?php }else{ ?>
                                            
                                            <?php if($wishlist_result->price != 0){?>
                                             <div class="cut-price"> Rs. <?=ceil($wishlist_result->mrp); ?> </div>
                                            <div class="actual"><span> Rs. <?=ceil($wishlist_result->price); ?></span> </div>
                                            <?php }else{?>
                                            <div class="actual"><span> Rs. <?=ceil($wishlist_result->mrp); ?> </span></div>
                                            <?php }?>
                                            
                                            <?php } //End of date condition ?>
                                            
                                            <?php }else{ ?>
                                            
                                            <?php if($wishlist_result->price != 0){?>
                                            <div class="cut-price">  Rs. <?=ceil($wishlist_result->mrp); ?> </div>
                                            <div class="actual"><span> Rs. <?=ceil($wishlist_result->price); ?></span> </div>
                                            <?php }else{?>
                                            <div class="actual"><span> Rs. <?=ceil($wishlist_result->mrp); ?></span> </div> 
                                            <?php }?>
                                            
                                            <?php } ?>
                                           
       							 <!--- price calculation div end here --->
                                        <div class="quantity"> 
                                        
                                        <input type="button"  value="View Details" class="btn-save" onClick="window.open('<?php echo base_url().preg_replace('#/#',"-",str_replace(" ","-",strtolower($wishlist_result->name))).'/'.$wishlist_result->product_id.'/'.$wishlist_result->sku; ?>','_blank')">
                                        </div>

										  <div class="delivery">
										  <div class="sphng"> <?=$wishlist_result->stock_availability ; ?>. </div>
									    </div>
                                        
                                        <?php $desc=$wishlist_result->short_desc;
											 $descp=unserialize(substr($desc,0));
											 $desc1=implode(',',$descp);
											// print_r($desc1);exit;
										?>
                                         <p class="m_desc"> <?=$desc1?> </p>
                                <?php //echo substr($wishlist_result->description,0,100).'...';?><a href="<?php echo base_url().preg_replace('#/#',"-",str_replace(" ","-",strtolower($wishlist_result->name))).'/'.$wishlist_result->product_id.'/'.$wishlist_result->sku; ?>"> View More </a>
                                <!--<p>  premium quality...     </p>-->
                                        
									 </div>

		                              <div class="clearfix"></div>
	                              </div>
	                            </div>
                                <?php }}else{
			 ?>
            <p>No wishlist Record.</p>
            <?php } ?>
	                        </div>
				            
                           <!-- <div class="cart-total">
								<div class="total_left">CartSubtotal : </div>
								<div class="total_right">Rs. 250.00</div>
								<div class="clearfix"> </div>
							</div>-->
								<!--<div class="btn_form">
				  <a href="cart.html"> <span class="submit">  Continue Shopping </span> </a>
                  <a href="cart.html"> <span class="buy-btn">  Proceed To Checkout  </span> </a>
				</div>-->
									  <div class="clearfix"></div>
									</div>
					
							<script>$(document).ready(function(c) {
								$('.alert-close').on('click', function(c){
									$('.message').fadeOut('slow', function(c){
										$('.message').remove();
									});
								});	  
							});
							</script>
							
						</div>
				  <!--/cart-->
				  
  </div>
  
  <script>
function removeFromWishlist(wishlist_id){
	$.ajax({
		url:'<?php echo base_url(); ?>user/remove_from_wishlist',
		method:'post',
		data:{id:wishlist_id},
		success:function(result){
			if(result == 'success'){
				window.location.reload(true);
			}
		}
	});
}
</script>

 
 
 <?php include 'footer_single_product.php'; ?>