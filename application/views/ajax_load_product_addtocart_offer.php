<?php //echo '<pre>';print_r($product_data->result_array());exit; ?>
<?php if($product_data != false){
					$row=$product_data->num_rows();
					$sl=0;
					//print_r($row);exit;
					if($row>0){
					foreach($product_data->result_array() as $rw ) { $sl++;
						$cdate = date('Y-m-d');
						//echo '<pre>';print_r($rw);exit;
						$special_price_from_dt = $rw['special_pric_from_dt'];
						$special_price_to_dt = $rw['special_pric_to_dt'];
						
						$dsply_img = $rw['catelog_img_url'];
						$image_arr=explode(',',$rw['catelog_img_url']);
						$quantity=$rw['quantity'];			
				?>
        <div class="grid1_of_4 catlg products-row">
        <div class="content_box <?php 
							$cur_prodprice=0;
							$cursplprc_foroff=0;
							  if($rw['special_price'] !=0)
							  {
                                       if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt)
									   {$cur_prodprice= $rw['special_price'];
									   	$cursplprc_foroff=$rw['special_price'];
									   }
							  }
							  if($rw['price'] != 0 && $rw['special_price']==0)
							  {$cur_prodprice=$rw['price'];}
							  
							  if($rw['price'] == 0 && $cursplprc_foroff==0) 
							  {
								$cur_prodprice=	$rw['mrp'];
							  }
							  
							  $percen_curprc=((100/$rw['mrp'])*$cur_prodprice);
							  
							  $percen_off=100- round($percen_curprc); 
							  
							  $cur_splprc=0;                               		
							 ?>                            
                            <?php if($percen_off>0){ echo 'discount-off'; ?><?php } ?>"> 
        <?php 
							$cur_prodprice=0;
							$cursplprc_foroff=0;
							  if($rw['special_price'] !=0)
							  {
                                       if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt)
									   {$cur_prodprice= $rw['special_price'];
									   	$cursplprc_foroff=$rw['special_price'];
									   }
							  }
							  if($rw['price'] != 0 && $rw['special_price']==0)
							  {$cur_prodprice=$rw['price'];}
							  
							  if($rw['price'] == 0 && $cursplprc_foroff==0) 
							  {
								$cur_prodprice=	$rw['mrp'];	  
							  }
							  
							  $percen_curprc=((100/$rw['mrp'])*$cur_prodprice);
							  
							  $percen_off=100- round($percen_curprc); 
							  
							  $cur_splprc=0;                               		
							 ?>                            
                            <?php if($percen_off>0){ ?>
                
                    <h6><?=$percen_off?>% <br>OFF</h6>
                    <?php } ?>
               <div class="view view-fifth">
                     <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>">
                     <?php  if(empty($dsply_img)){?>
                        <img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" class="img-responsive" data-wow-delay="1s" alt="">
                        <?php }else { ?>
                        <img src="<?php echo base_url();?>images/product_img/<?=$image_arr[0];?>" class="img-responsive" data-wow-delay="1s" alt="<?=$rw['name'];?>">
                        <?php } ?>
                     </a>
                 </div>
                  <div class="wish-list">
                    <a class="link-wishlist inline cboxElement" href="#inline_content"> <i class="fa fa-heart"></i> </a>
                 </div>
                 <div class="product-text">              
                    <h5>
                        <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>">
                        <?php if(strlen($rw['name']) > 30){ echo substr($rw['name'],0,30).'...';}else{ echo $rw['name'];}?> 
                        </a>
                    </h5> 
                    <div class="price-through">
                    <!-----------------------------------Product price start---------------------------->
                        <!--<div class="original-price">₹999</div>-->
                        <!--<div class="original-price" style="color:#c5aa21;">₹777</div>-->
                        <!--<div class="price-recent" style="color:#6bb700;">₹539</div>-->
                        <?php
						   if($rw['special_price'] !=0){
							   if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
								   $cur_splprc=$rw['special_price'];
						?>
                        <div class="original-price"><i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;<?=$rw['mrp'];?></div>
                        <div class="original-price" style="color:#c5aa21;"><i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['price'];?></div>
                        <div style="color:#6bb700;" class="price-recent"><i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($rw['special_price'])?></div>
                        <?php }} ?>
                        <?php if($rw['price'] != 0 && $cur_splprc==0){?>
                        <div class="original-price"><i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?></div>
                         <?php } ?>
                         <?php if($rw['price'] == 0 && $cur_splprc==0){?>
                         <div class="price-recent" style="color:#6bb700;"><i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?></div>
                         
                         <?php } ?>
                                         &nbsp;&nbsp;

                         <?php
                           if($rw['special_price'] ==0 && $rw['price']>0){
                         ?>    
                          <div class="price-recent" style="color:#6bb700;"><i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($rw['price'])?></div>
                          <?php } ?>               
                    <!-----------------------------------Product Price End----------------------------->    
                    </div>
                    <?php if($rw['quantity'] ==0){?>
                    <div class="out-of-stock"><span>Out Of Stock</span></div>
                    <?php }?>
        		</div>
             </div>
        </div>
        
        <?php }}}?>
		<script>
function addWishlistFunction(product_id,sku){
	$.ajax({
		url:'<?php echo base_url(); ?>user/add_wishlist',
		method:'post',
		data:{product_id:product_id,sku:sku},
		success:function(result){
			if(result=='success'){
				//alert('successfully added');
				window.location.reload(true);
			}
			if(result=='exists'){
				window.location.href='<?php echo base_url(); ?>wish-list';
			}
		}
	});
}


function addWishlistFunction_temp(product_id,sku)
{
	$.ajax({
		url:'<?php echo base_url(); ?>user/add_wishlist_temp',
		method:'post',
		data:{product_id:product_id,sku:sku},
		success:function(result){
			if(result=='success'){
				//alert('successfully added');
				//window.location.reload(true);
			}
			if(result=='exists'){
				window.location.href='<?php echo base_url(); ?>wish-list';
			}
		}
	});
}

</script>