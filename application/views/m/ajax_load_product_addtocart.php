<?php if($product_data != false){
		$row=$product_data->num_rows();
		$sl=$sl_no;
		//print_r($row);exit;
		if($row>0){
		foreach($product_data->result_array() as $rw ) { $sl++;
			$cdate = date('Y-m-d');
			$special_price_from_dt = $rw['special_pric_from_dt'];
			$special_price_to_dt = $rw['special_pric_to_dt'];
			
			$dsply_img = $rw['catelog_img_url'];
			$image_arr=explode(',',$rw['catelog_img_url']);
			//$taxdecimal = $rw->tax_rate_percentage/100;
			
			//tax amount for product price
			//$tax_amount = $rw->price*$taxdecimal;
			
			//tax amount for product special price
			//$tax_amount_special = $rw->special_price*$taxdecimal;
			$quantity=$rw['quantity'];
			
			
					$extimg_sku=$rw['sku'];
					$qr_slrprodimg=$this->db->query("select b.image  from seller_product_master a INNER JOIN  seller_existingproduct_image b ON a.seller_exist_product_id=b.seller_extproduct_id WHERE  a.sku='$extimg_sku' ");
								if($qr_slrprodimg->num_rows()>0)
								{
									$image=$qr_slrprodimg->row()->image;
									$dsply_img = $qr_slrprodimg->row()->image;
									
								}
								else
								{	$image=$image_arr[0];
									$dsply_img = $image_arr[0];
								}
		?>
				  <div class="col-md-3 product-grids"> 
						<div class="agile-products" style="max-height: 350px; height: 250px;">
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
							<div class="new-tag">
                            <!--<h6>20%<br>Off</h6>-->                           
                            <h6><?=$percen_off?>%<br>Off</h6>                            
                            </div>
                            <?php } ?>
                            
							
                            <div style="margin:auto; width:100%; text-align:center; ">
                             <?php  if(empty($dsply_img)){?>
                             <a style="margin:auto; text-align:center;" 
                             href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>">
                             <img style="height: 112px; max-width: 100%; margin: auto;text-align: center;" src="<?php echo base_url();?>images/product_img/prdct-no-img.png"  alt="<?=$rw['name'];?>"></a>
                             <?php }else { ?>
                             <a style="margin:auto; text-align:center;" 
                             href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>">
                             <img style="height: 112px;max-width: 100%;margin: auto;text-align: center;" src="<?php echo base_url();?>images/product_img/<?=$image_arr[0];?>" onerror="imgError(this);"  alt="<?=$rw['name'];?>">
                             </a>                       
                             <?php } ?>
                            </div>
							<div class="agile-product-text" >
								<h5 style="text-align:left; margin-left:0; font-family: 'SegoeUI'; line-height: 16px;"><a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>">
								<?php if(strlen($rw['name']) > 30){ echo substr($rw['name'],0,30).'...';}else{ echo $rw['name'];}?>
                                </a></h5> 
								<!--<h6><del>$200</del> $100</h6>-->
                                
                                 <!-----------------------------------Produc price start---------------------------->
                                
                                	<?php
                                   if($rw['special_price'] !=0){
                                       if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
										   $cur_splprc=$rw['special_price'];
                                		 ?>                               
                                		<span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?> </span>
                                        &nbsp;&nbsp;
                                
                                        <span style="color:#F90;text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['price'];?> </span>&nbsp;&nbsp;
                                        <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($rw['special_price'])?> </span>
                               		<?php }} ?>
                                        
                                        <?php if($rw['price'] != 0 && $cur_splprc==0){?>
                                        <span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?> </span>
                                        <?php } ?>
                                         <?php if($rw['price'] == 0 && $cur_splprc==0){?>
                                         <span  > <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?> </span>
                                         <?php } ?>
                                         &nbsp;&nbsp;
                                
                                
                                 <?php
                                   if($rw['special_price'] ==0 && $rw['price']>0){
                                 ?>                               
                                <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($rw['price'])?> </span>
                                <?php } ?>
                                <!-----------------------------------Product Price End----------------------------->
                                 
							<!--	<form action="#" method="post">-->
									<!--<input type="hidden" name="cmd" value="_cart" />
									<input type="hidden" name="add" value="1" /> 
									<input type="hidden" name="w3ls_item" value="Audio speaker" /> 
									<input type="hidden" name="amount" value="100.00" /> -->
									<?php /*?><button type="addtocart_prod"  class="w3ls-cart pw3ls-cart" onclick="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>">
                                    <i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button><?php */?>
								<!--</form> -->
                                
							</div>
						</div> 
					</div>
                  <?php } } } ?>