<?php 
	if($product_data != false){
		$row=$product_data->num_rows();
		$sl=0;
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
		?>
        <div class="pad-res singleproduct-grids">
			<div class="today-deal-left">
				<?php  if(empty($dsply_img)){?>
				<a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>">
					<img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" alt="<?=$rw['name'];?>"/>
				</a>
				<?php } else {?>
				<a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>">
					<img src="http://server-pc/moonboy/images/product_img/<?=$image_arr[0];?>" alt="<?=$rw['name'];?>"/>
				</a>
				<?php }?>
			</div>
			<div class="today-deal-right">
				<h5 style="text-align:left; margin-left:0; margin-bottom:8px; font-size:18px; font-family: 'SegoeUI';">
					<a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>"><?php if(strlen($rw['name']) > 30){ echo substr($rw['name'],0,30).'...';}else{ echo $rw['name'];}?>
					</a>
				</h5>
				<p style="margin-left:0px; float:left; display:inline-block;">
					<?php
						$cur_splprc=0;
						if($rw['special_price'] !=0){
							   if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
									$cur_splprc=$rw['special_price'];
					?>
					<span style="color:#999; text-decoration:line-through">
						<i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; ">
						</i>&nbsp; <?=$rw['mrp'];?>
					</span>&nbsp;&nbsp;
					<span style="color:#F90;text-decoration:line-through">
						<i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; ">
						</i>&nbsp; <?=$rw['price'];?>
					</span>&nbsp;&nbsp;
					<span style="color:#079107 !important;  font-weight:bold;">
						<i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; ">
						</i>&nbsp; <?=ceil($rw['special_price'])?>
					</span>
					<?php
							}
						}
					?>
					<?php if($rw['price'] != 0 && $cur_splprc==0){ ?>
						<span style="color:#999; text-decoration:line-through">
							<i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; ">
							</i>&nbsp; <?=$rw['mrp'];?>
						</span>&nbsp;&nbsp;
					<?php }?>
					<?php if($rw['price'] == 0 && $cur_splprc==0){ ?>
						<span style="color:#079107 !important;  font-weight:bold;">
							<i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; ">
							</i>&nbsp; <?=$rw['mrp'];?>
						</span>
					<?php }?>
					<?php if($cur_splprc ==0 && $rw['price']>0){ ?>
						<span style="color:#079107 !important;  font-weight:bold;">
							<i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; ">
							</i>&nbsp; <?=ceil($rw['price'])?>
						</span>
					<?php }?>
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
						  
					?>
					<span style="display:inline-block;">
                    	<?php if($percen_off>0){ ?>
						<div class="discount">
							<p> <?=$percen_off?>% off </p>
						</div>
						<?php } ?>
                    </span>
				</p>
			</div>
            <div style="clear:both;"></div>
		</div>
		<?php 
					}
				}
			}
		?>