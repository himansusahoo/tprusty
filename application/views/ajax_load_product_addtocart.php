<?php //echo '<pre>';print_r($product_data->result());exit;?>
   
<!-- grids_of_4 -->
		
        <?php if($product_data != false){
		$row=$product_data->num_rows();
		$sl=0;
		if($row>0){ ?>
		<div id="htmlmore1">
        <?php
		foreach($product_data->result() as $rw ) { $sl++;
			$cdate = date('Y-m-d');
			$special_price_from_dt = $rw->special_pric_from_dt;
			$special_price_to_dt = $rw->special_pric_to_dt;
			$dsply_img = $rw->catelog_img_url;
			$image_arr=explode(',',$rw->catelog_img_url);
			$quantity=$rw->quantity;
		?>
        <div class="grid1_of_4 catlg">
                <div class="content_box <?php 
if($rw->special_price!=0)
{
	if($cdate >= $rw->special_pric_from_dt && $cdate <= $rw->special_pric_to_dt)
	{
		echo 'discount-off';
	}else{
			if($rw->price!=0)
			{
				if($rw->price!=$rw->mrp)
				{
					echo 'discount-off';
				}
			}
		 }
}else{
		if($rw->price!=0)
			{
				if($rw->price!=$rw->mrp)
				{
					echo 'discount-off';
				}
				
			}
	 }
?>">
                
                 
                    
                    <?php 
if($rw->special_price!=0)
{
	
	if($cdate >= $rw->special_pric_from_dt && $cdate <= $rw->special_pric_to_dt)
	{ ?>
		<h6><?php echo round(100-($rw->special_price/$rw->mrp*100)) ?>% <br>OFF</h6>
        <?php
	}else{
			if($rw->price!=0)
			{
				if($rw->price!=$rw->mrp)
				{
				 ?>
				<h6><?php echo round(100-($rw->price/$rw->mrp*100)) ?>% <br>OFF</h6>
			<?php }}
		 }
}else{
		if($rw->price!=0)
			{ 
			if($rw->price!=$rw->mrp)
				{
			?>
				<h6><?php echo round(100-($rw->price/$rw->mrp*100)) ?>% <br>OFF</h6>
			<?php }}
	 }
?>
                    
                    
                    
                    
                    
                    
                    
               <div class="view view-fifth">
                     <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>">
                     <?php if(empty($dsply_img)){?>
                        <img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" class="img-responsive" data-wow-delay="1s" alt="<?=$rw->name ?>">
                     <?php }else{?>
                     	<img src="<?php echo base_url();?>images/product_img/<?=$image_arr[0];?>" class="img-responsive" data-wow-delay="1s" alt="<?=$rw->name.'_moonboy' ?>">
                     <?php }?>
                     </a>
                 </div>
                  <div class="wish-list"> 
                  <?php if($this->session->userdata('session_data')){ ?>            
            	<span class="link-wishlist wish_spn" onClick="addWishlistFunction(<?=$rw->product_id; ?>,'<?=$rw->sku; ?>')"> <i class="fa fa-heart"></i> </span>
            <?php }else{ ?>
                    <a class="link-wishlist" href="#"> <i class="fa fa-heart"></i> </a>
                    <?php }?>
                 </div>
                 <div class="product-text">              
                    <h5>
                        <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>">
                        <?php if(strlen($rw->name) > 30){ echo substr($rw->name,0,30).'...';}else{ echo $rw->name;}?> 
                        </a>
                    </h5> 
                    <div class="price-through">
                        <!--<div class="original-price"><i class="fa fa-inr" aria-hidden="true"></i>999</div>
                        <div class="original-price" style="color:#ff7e00;"><i class="fa fa-inr" aria-hidden="true"></i>666</div>&nbsp;
                        <div class="price-recent" style="color:#6bb700;"><i class="fa fa-inr" aria-hidden="true"></i>539</div>-->
                        
                        
                        
                        <?php
		if($rw->special_price !=0){
			//$cdate=time();
			if($cdate >= $rw->special_pric_from_dt && $cdate <= $rw->special_pric_to_dt){
		?>
        
		
        <div class="original-price"><i class="fa fa-inr" aria-hidden="true"></i><?=$rw->mrp; ?></div>
        <?php if($rw->price != 0){?>
        <div class="original-price" style="color:#ff7e00;"><i class="fa fa-inr" aria-hidden="true"></i><?=ceil($rw->price); ?></div>
        <?php }?>
        <div class="price-recent" style="color:#6bb700;"><i class="fa fa-inr" aria-hidden="true"></i><?=ceil($rw->special_price); ?></div>
        <!---Special price exists condition end here --->
		<?php }else{ ?>
		
        <?php if($rw->price != 0){?>
        <div class="original-price"><i class="fa fa-inr" aria-hidden="true"></i> <?=ceil($rw->mrp); ?> </div>
        <div class="price-recent" style="color:#6bb700;"><i class="fa fa-inr" aria-hidden="true"></i> <?=ceil($rw->price); ?> </div>
        <?php }else{?>
        <div class="price-recent" style="color:#6bb700;"><i class="fa fa-inr" aria-hidden="true"></i> <?=ceil($rw->mrp); ?> </div>
        <?php }?>
        
        <?php } //End of date condition ?>
        
        <?php }else{ ?>
        
		<?php if($rw->price != 0){?>
        <div class="original-price"><i class="fa fa-inr" aria-hidden="true"></i> <?=ceil($rw->mrp); ?> </div>
        <div class="price-recent" style="color:#6bb700;"><i class="fa fa-inr" aria-hidden="true"></i> <?=ceil($rw->price); ?> </div>
        <?php }else{?>
        <div class="price-recent" style="color:#6bb700;"><i class="fa fa-inr" aria-hidden="true"></i> <?=ceil($rw->mrp); ?> </div>
        <?php }?>
		
        <?php } ?>
                        
                        
                        
                    </div>
                    <?php if($rw->quantity==0){?>
                    <div class="out-of-stock"><span>Out Of Stock</span></div>
                    <?php }?>
        		</div>
             </div>
        </div>
        <?php }?>
		</div>
        
        <div id="htmlmore2">
        <?php 
        foreach($product_data->result() as $rw ) { $sl++;
			$cdate = date('Y-m-d');
			$special_price_from_dt = $rw->special_pric_from_dt;
			$special_price_to_dt = $rw->special_pric_to_dt;
			$dsply_img = $rw->catelog_img_url;
			$image_arr=explode(',',$rw->catelog_img_url);
			$quantity=$rw->quantity;
		?>
      <div class="row catlog" style="padding-top:10px;">
           	<div class="col-lg-3 catlg">
               <div class="view view-fifth">
                     <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>">
                     <?php if(empty($dsply_img)){?>
                        <img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" class="img-responsive" data-wow-delay="1s" alt="<?=$rw->name ?>">
                     <?php }else{?>
                     <img src="<?php echo base_url();?>images/product_img/<?=$image_arr[0];?>" class="img-responsive" data-wow-delay="1s" alt="<?=$rw->name.'_moonboy' ?>">
                     <?php }?>
                     </a>
                 </div>
                  <div class="wish-list"> 
                    <a class="link-wishlist" href="#"> <i class="fa fa-heart"></i> </a>
                 </div>
                 <?php if($rw->quantity==0){?>
				<div class="out-of-stock"><span>Out Of Stock</span></div>
                <?php }?>
        </div>
        <div class="col-lg-7 liner-shadow">
        	<div class="listing-title">
            <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>">
            <?php  echo $rw->name;?>
            </a>
            </div>
            <div style="clear:both;"></div>
            <p style="margin-left:0px; float:left; display:inline-block; margin-bottom:0;">
               <!--<span style="color:#999; text-decoration:line-through; font-size: 18px;">
					<i class="fa fa-inr" aria-hidden="true" style="font-size:18px;border: 0px;width: 0px; "></i>&nbsp; 14500
			   </span>&nbsp;&nbsp;
               <span style="color:#F90;text-decoration:line-through;font-size: 18px;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 18px;border: 0px;width: 0px; "></i>&nbsp;
 29790 </span>&nbsp;&nbsp;
			   <span style="color:#079107 !important;font-size: 18px; font-weight:bold;">
					 <i class="fa fa-inr" aria-hidden="true" style="font-size: 18px;border: 0px;width: 0px; "></i>&nbsp; 12200
               </span>-->
			   <?php
		if($rw->special_price !=0){
			//$cdate=time();
			if($cdate >= $rw->special_pric_from_dt && $cdate <= $rw->special_pric_to_dt){
		?>
        		<span style="color:#999; text-decoration:line-through; font-size: 18px;">
					<i class="fa fa-inr" aria-hidden="true" style="font-size:18px;border: 0px;width: 0px; "></i>&nbsp; <?=$rw->mrp; ?>
			   </span>&nbsp;&nbsp;
               <?php if($rw->price != 0){?>
               <span style="color:#F90;text-decoration:line-through;font-size: 18px;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 18px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($rw->price); ?> </span>&nbsp;&nbsp;
 			   <?php }?>
               <span style="color:#079107 !important;font-size: 18px; font-weight:bold;">
					 <i class="fa fa-inr" aria-hidden="true" style="font-size: 18px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($rw->special_price); ?>
               </span>
               <!---Special price exists condition end here --->
		<?php }else{ ?>
		
        <?php if($rw->price != 0){?>
              <span style="color:#999; text-decoration:line-through; font-size: 18px;">
					<i class="fa fa-inr" aria-hidden="true" style="font-size:18px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($rw->mrp); ?>
			   </span>&nbsp;&nbsp; 
              <span style="color:#079107 !important;font-size: 18px; font-weight:bold;">
					 <i class="fa fa-inr" aria-hidden="true" style="font-size: 18px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($rw->price); ?>
               </span>
              <?php }else{?>
              <span style="color:#079107 !important;font-size: 18px; font-weight:bold;">
					 <i class="fa fa-inr" aria-hidden="true" style="font-size: 18px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($rw->mrp); ?>
               </span>
       		  <?php }?>
        
        <?php } //End of date condition ?>
        
        <?php }else{ ?>
        
		<?php if($rw->price != 0){?>
        	  <span style="color:#999; text-decoration:line-through; font-size: 18px;">
					<i class="fa fa-inr" aria-hidden="true" style="font-size:18px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($rw->mrp); ?>
			   </span>&nbsp;&nbsp;
               <span style="color:#079107 !important;font-size: 18px; font-weight:bold;">
					 <i class="fa fa-inr" aria-hidden="true" style="font-size: 18px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($rw->price); ?>
               </span>
         <?php }else{?>
        	  <span style="color:#079107 !important;font-size: 18px; font-weight:bold;">
					 <i class="fa fa-inr" aria-hidden="true" style="font-size: 18px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($rw->mrp); ?>
               </span>
               <?php }?>
		
        <?php } ?>
            </p>
            <div style="clear:both;"></div>
            <div class="payment-mode">
                <ul>
                <li> <span> COD </span> Cash on Delivery </li>
                 <li> <i class="fa fa-exchange"></i> 100% Replacement Guarantee. </li>
                 <?php if($rw->prod_status !='Active' || $rw->prod_status !='Active'){?> 
                 <li><b style="color:#900; font-size:18px;">
			Product has been Discontinued</b></li>
            <?php }?>
                </ul>
                <div class="clearfix"> </div>
                 
                </div>
        </div>
        <div class="col-lg-2" style="text-align:center;">
        	<p style="margin-left:0px; float:left; display:inline-block;">
			   <span style="display:inline-block;"><div class="<?php 
if($rw->special_price!=0)
{
	if($cdate >= $rw->special_pric_from_dt && $cdate <= $rw->special_pric_to_dt)
	{
		echo 'discount';
	}else{
			if($rw->price!=0)
			{
				if($rw->price!=$rw->mrp)
				{
					echo 'discount';
				}
			}
		 }
}else{
		if($rw->price!=0)
			{
				if($rw->price!=$rw->mrp)
				{
					echo 'discount';
				}
				
			}
	 }
?>">




				<?php 
if($rw->special_price!=0)
{
	
	if($cdate >= $rw->special_pric_from_dt && $cdate <= $rw->special_pric_to_dt)
	{ ?>
		<p><?php echo round(100-($rw->special_price/$rw->mrp*100)) ?>% OFF</p>
        <?php
	}else{
			if($rw->price!=0)
			{
				if($rw->price!=$rw->mrp)
				{
				 ?>
				<p><?php echo round(100-($rw->price/$rw->mrp*100)) ?>% OFF</p>
			<?php }}
		 }
}else{
		if($rw->price!=0)
			{ 
			if($rw->price!=$rw->mrp)
				{
			?>
				<p><?php echo round(100-($rw->price/$rw->mrp*100)) ?>% OFF</p>
			<?php }}
	 }
?>
                
                
                
			</div></span>
            </p>
        </div>
      </div>
      <?php }?>
        </div>
		
		
		<?php
		}else{?>
        <div>NO Record Found</div>
		<?php }}?>

<!-- end grids_of_4 -->

