<?php error_reporting(0);//echo '<pre>';print_r($product_data);exit; ?>
        <?php
		$cntt=count($product_data['response']['docs']);
		if($cntt>0){
			?>
            <div id="html1">
			<?php
		for($i_arr=0; $i_arr<$cntt; $i_arr++ ) {
			//$cdate=time();
			$cdate=date("Y-m-d");
		?>
		  <div class="grid1_of_4 catlg">
          
				<div class="content_box <?php 
if($product_data['response']['docs'][$i_arr]['Special_Price']!=0)
{
	if($cdate >= substr($product_data['response']['docs'][$i_arr]['Special_Price_From_Date'], 0, -10) && $cdate <= substr($product_data['response']['docs'][$i_arr]['Special_Price_To_Date'], 0, -10))
	{
		echo 'discount-off';
	}else{
			if($product_data['response']['docs'][$i_arr]['Price']!=0)
			{
				if($product_data['response']['docs'][$i_arr]['Price']!=$product_data['response']['docs'][$i_arr]['Mrp'])
				{
					echo 'discount-off';
				}
			}
		 }
}else{
		if($product_data['response']['docs'][$i_arr]['Price']!=0)
			{
				if($product_data['response']['docs'][$i_arr]['Price']!=$product_data['response']['docs'][$i_arr]['Mrp'])
				{
					echo 'discount-off';
				}
				
			}
	 }
?>"> 
                    
                    
                    
                    
                    
                    
                    
                    
                    
                <?php 
if($product_data['response']['docs'][$i_arr]['Special_Price']!=0)
{
	//echo $product_data['response']['docs'][$i_arr]['Special_Price_From_Date'];
	//echo substr($product_data['response']['docs'][$i_arr]['Special_Price_From_Date'], 0, -10);exit;
	if($cdate >= substr($product_data['response']['docs'][$i_arr]['Special_Price_From_Date'], 0, -10) && $cdate <= substr($product_data['response']['docs'][$i_arr]['Special_Price_To_Date'], 0, -10))
	{ ?>
		<h6><?php echo round(100-($product_data['response']['docs'][$i_arr]['Special_Price']/$product_data['response']['docs'][$i_arr]['Mrp']*100)) ?>% <br>OFF</h6>
        <?php
	}else{
			if($product_data['response']['docs'][$i_arr]['Price']!=0)
			{
				if($product_data['response']['docs'][$i_arr]['Price']!=$product_data['response']['docs'][$i_arr]['Mrp'])
				{
				 ?>
				<h6><?php echo round(100-($product_data['response']['docs'][$i_arr]['Price']/$product_data['response']['docs'][$i_arr]['Mrp']*100)) ?>% <br>OFF</h6>
			<?php }}
		 }
}else{
		if($product_data['response']['docs'][$i_arr]['Price']!=0)
			{ 
			if($product_data['response']['docs'][$i_arr]['Price']!=$product_data['response']['docs'][$i_arr]['Mrp'])
				{
			?>
				<h6><?php echo round(100-($product_data['response']['docs'][$i_arr]['Price']/$product_data['response']['docs'][$i_arr]['Mrp']*100)) ?>% <br>OFF</h6>
			<?php }}
	 }
?>    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
               <div class="view view-fifth">
                     <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower(@$product_data['response']['docs'][$i_arr]['Title'])))).'/'.$product_data['response']['docs'][$i_arr]['Product_Id'].'/'.$product_data['response']['docs'][$i_arr]['Sku']  ?>">
                       
                       <?php 
					   //$path=FCPATH.base_url()."images/product_img/".$product_data['response']['docs'][$i_arr]['Catalog_Image'][0]; 
					  // echo file_exists(realpath(APPPATH . $path));exit;

					  // echo file_exists(FCPATH.$path);
					   ?>
                                              
					   <?php if(empty($product_data['response']['docs'][$i_arr]['Catalog_Image'][0])){?>
                       <img src="<?php echo base_url();?>images/product_img/prdct-no-img.png"  class="img-responsive" data-wow-delay="1s" alt="">
                       <?php }else{?>
                        <img src="<?php echo base_url();?>images/product_img/<?=$product_data['response']['docs'][$i_arr]['Catalog_Image'][0];?>"  class="img-responsive" data-wow-delay="1s" alt="">
                        <?php } ?>
                     </a>
                 </div>
                  <div class="wish-list"> 
                    <a class="link-wishlist inline cboxElement" href="#inline_content"> <i class="fa fa-heart"></i> </a>
                 </div>
                 <div class="product-text">              
                    <h5>
                        <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower(@$product_data['response']['docs'][$i_arr]['Title'])))).'/'.$product_data['response']['docs'][$i_arr]['Product_Id'].'/'.$product_data['response']['docs'][$i_arr]['Sku']  ?>">
                        <?php if(strlen(@$product_data['response']['docs'][$i_arr]['Title']) > 30){echo substr(@$product_data['response']['docs'][$i_arr]['Title'],0,30).'...';}else{echo @$product_data['response']['docs'][$i_arr]['Title'];} ?> 
                        </a>
                    </h5> 
                    <div class="price-through">
                        <!--<div class="price-recent">₹539</div>
                        <div class="original-price">₹999</div>
                        <div class="off-price">46% off</div>-->
                        
                        
                        
                        
                 		<?php
		if($product_data['response']['docs'][$i_arr]['Special_Price'] !=0){
			//$cdate=time();
			if($cdate >= substr($product_data['response']['docs'][$i_arr]['Special_Price_From_Date'], 0, -10) && $cdate <= substr($product_data['response']['docs'][$i_arr]['Special_Price_To_Date'], 0, -10)){
		?>
        
		
        <div class="original-price"><i class="fa fa-inr" aria-hidden="true"></i><?=$product_data['response']['docs'][$i_arr]['Mrp'] ?></div>
        <?php if($product_data['response']['docs'][$i_arr]['Price'] != 0){?>
        <div class="original-price" style="color:#c5aa21;"><i class="fa fa-inr" aria-hidden="true"></i><?=ceil($product_data['response']['docs'][$i_arr]['Price']); ?></div>
        <?php }?>
        <div class="price-recent" style="color:#6bb700;"><i class="fa fa-inr" aria-hidden="true"></i><?=ceil($product_data['response']['docs'][$i_arr]['Special_Price']); ?></div>
        <!---Special price exists condition end here --->
		<?php }else{ ?>
		
        <?php if($product_data['response']['docs'][$i_arr]['Price'] != 0){?>
        <div class="original-price"><i class="fa fa-inr" aria-hidden="true"></i> <?=ceil($product_data['response']['docs'][$i_arr]['Mrp']); ?> </div>
        <div class="price-recent" style="color:#6bb700;"><i class="fa fa-inr" aria-hidden="true"></i> <?=ceil($product_data['response']['docs'][$i_arr]['Price']); ?> </div>
        <?php }else{?>
        <div class="price-recent" style="color:#6bb700;"><i class="fa fa-inr" aria-hidden="true"></i> <?=ceil($product_data['response']['docs'][$i_arr]['Mrp']); ?> </div>
        <?php }?>
        
        <?php } //End of date condition ?>
        
        <?php }else{ ?>
        
		<?php if($product_data['response']['docs'][$i_arr]['Price'] != 0){?>
        <div class="original-price"><i class="fa fa-inr" aria-hidden="true"></i> <?=ceil($product_data['response']['docs'][$i_arr]['Mrp']); ?> </div>
        <div class="price-recent" style="color:#6bb700;"><i class="fa fa-inr" aria-hidden="true"></i> <?=ceil($product_data['response']['docs'][$i_arr]['Price']); ?> </div>
        <?php }else{?>
        <div class="price-recent" style="color:#6bb700;"><i class="fa fa-inr" aria-hidden="true"></i> <?=ceil($product_data['response']['docs'][$i_arr]['Mrp']); ?> </div>
        <?php }?>
		
        <?php } ?>
        
        
        
        
        
                    </div>
                    <?php if($product_data['response']['docs'][$i_arr]['quantity']==0){ ?>
                    <div class="out-of-stock"><span>Out Of Stock</span></div>
                    <?php }?>
        		</div>
             </div>
			</div>
            <?php } // End of foreach loop?>
            </div>
            
            
            
            
            
            <div id="html2">
			<?php
		for($i_arr=0; $i_arr<$cntt; $i_arr++ ) {
			?>
			
      		<div class="row catlog" style="padding-top:10px;">
           	<div class="col-lg-3 catlg">
               <div class="view view-fifth">
                     <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower(@$product_data['response']['docs'][$i_arr]['Title'])))).'/'.$product_data['response']['docs'][$i_arr]['Product_Id'].'/'.$product_data['response']['docs'][$i_arr]['Sku']  ?>">
                         <?php if(empty($product_data['response']['docs'][$i_arr]['Catalog_Image'][0])){?>
                        <img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" class="img-responsive" data-wow-delay="1s" alt="">
                     <?php }else{?>
                     	<img src="<?php echo base_url();?>images/product_img/<?=$product_data['response']['docs'][$i_arr]['Catalog_Image'][0];?>" class="img-responsive" data-wow-delay="1s" alt="">
                     <?php } ?>
                     </a>
                 </div>
                  <div class="wish-list"> 
                    <a class="link-wishlist inline cboxElement" href="#inline_content"> <i class="fa fa-heart"></i> </a>
                 </div>
                 <?php if($product_data['response']['docs'][$i_arr]['quantity']==0){ ?>
				<div class="out-of-stock"><span>Out Of Stock</span></div>
                 <?php }?>
        </div>
        <div class="col-lg-7 liner-shadow">
        	<div class="listing-title"><a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower(@$product_data['response']['docs'][$i_arr]['Title'])))).'/'.$product_data['response']['docs'][$i_arr]['Product_Id'].'/'.$product_data['response']['docs'][$i_arr]['Sku']  ?>">
			<?php echo @$product_data['response']['docs'][$i_arr]['Title']; ?>
            </a></div>
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
		if($product_data['response']['docs'][$i_arr]['Special_Price'] !=0){
			//$cdate=time();
			if($cdate >= substr($product_data['response']['docs'][$i_arr]['Special_Price_From_Date'], 0, -10) && $cdate <= substr($product_data['response']['docs'][$i_arr]['Special_Price_To_Date'], 0, -10)){
		?>
        		<span style="color:#999; text-decoration:line-through; font-size: 18px;">
					<i class="fa fa-inr" aria-hidden="true" style="font-size:18px;border: 0px;width: 0px; "></i>&nbsp; <?=$product_data['response']['docs'][$i_arr]['Mrp'] ?>
			   </span>&nbsp;&nbsp;
               <?php if($product_data['response']['docs'][$i_arr]['Price'] != 0){?>
               <span style="color:#F90;text-decoration:line-through;font-size: 18px;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 18px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($product_data['response']['docs'][$i_arr]['Price']); ?> </span>&nbsp;&nbsp;
 			   <?php }?>
               <span style="color:#079107 !important;font-size: 18px; font-weight:bold;">
					 <i class="fa fa-inr" aria-hidden="true" style="font-size: 18px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($product_data['response']['docs'][$i_arr]['Special_Price']); ?>
               </span>
               <!---Special price exists condition end here --->
		<?php }else{ ?>
		
        <?php if($product_data['response']['docs'][$i_arr]['Price'] != 0){?>
              <span style="color:#999; text-decoration:line-through; font-size: 18px;">
					<i class="fa fa-inr" aria-hidden="true" style="font-size:18px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($product_data['response']['docs'][$i_arr]['Mrp']); ?>
			   </span>&nbsp;&nbsp; 
              <span style="color:#079107 !important;font-size: 18px; font-weight:bold;">
					 <i class="fa fa-inr" aria-hidden="true" style="font-size: 18px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($product_data['response']['docs'][$i_arr]['Price']); ?>
               </span>
              <?php }else{?>
              <span style="color:#079107 !important;font-size: 18px; font-weight:bold;">
					 <i class="fa fa-inr" aria-hidden="true" style="font-size: 18px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($product_data['response']['docs'][$i_arr]['Mrp']); ?>
               </span>
       		  <?php }?>
        
        <?php } //End of date condition ?>
        
        <?php }else{ ?>
        
		<?php if($product_data['response']['docs'][$i_arr]['Price'] != 0){?>
        	  <span style="color:#999; text-decoration:line-through; font-size: 18px;">
					<i class="fa fa-inr" aria-hidden="true" style="font-size:18px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($product_data['response']['docs'][$i_arr]['Mrp']); ?>
			   </span>&nbsp;&nbsp;
               <span style="color:#079107 !important;font-size: 18px; font-weight:bold;">
					 <i class="fa fa-inr" aria-hidden="true" style="font-size: 18px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($product_data['response']['docs'][$i_arr]['Price']); ?>
               </span>
         <?php }else{?>
        	  <span style="color:#079107 !important;font-size: 18px; font-weight:bold;">
					 <i class="fa fa-inr" aria-hidden="true" style="font-size: 18px;border: 0px;width: 0px; "></i>&nbsp; <?=ceil($product_data['response']['docs'][$i_arr]['Mrp']); ?>
               </span>
               <?php }?>
		
        <?php } ?>
			   
            </p>
            <div style="clear:both;"></div>
            <div class="payment-mode">
                <ul>
                <li> <span> COD </span> Cash on Delivery </li>
                 <li> <i class="fa fa-exchange"></i> 100% Replacement Guarantee. </li>
                 <?php if($product_data['response']['docs'][$i_arr]['seller_status']!='Active' || $product_data['response']['docs'][$i_arr]['prod_status']!='Active'){ ?>
                 <li><b style="color:#900; font-size:15px;">
			Product has been Discontinued</b></li>
            	<?php }?>
                </ul>
                <div class="clearfix"> </div>
                 
                </div>
        </div>
        <div class="col-lg-2" style="text-align:center;">
        	<p style="margin-left:0px; float:left; display:inline-block;">
			   <span style="display:inline-block;"><div class="<?php 
if($product_data['response']['docs'][$i_arr]['Special_Price']!=0)
{
	if($cdate >= substr($product_data['response']['docs'][$i_arr]['Special_Price_From_Date'], 0, -10) && $cdate <= substr($product_data['response']['docs'][$i_arr]['Special_Price_To_Date'], 0, -10))
	{
		echo 'discount';
	}else{
			if($product_data['response']['docs'][$i_arr]['Price']!=0)
			{
				if($product_data['response']['docs'][$i_arr]['Price']!=$product_data['response']['docs'][$i_arr]['Mrp'])
				{
					echo 'discount';
				}
			}
		 }
}else{
		if($product_data['response']['docs'][$i_arr]['Price']!=0)
			{
				if($product_data['response']['docs'][$i_arr]['Price']!=$product_data['response']['docs'][$i_arr]['Mrp'])
				{
					echo 'discount';
				}
				
			}
	 }
?>">
				<?php 
if($product_data['response']['docs'][$i_arr]['Special_Price']!=0)
{
	//echo $product_data['response']['docs'][$i_arr]['Special_Price_From_Date'];
	//echo substr($product_data['response']['docs'][$i_arr]['Special_Price_From_Date'], 0, -10);exit;
	if($cdate >= substr($product_data['response']['docs'][$i_arr]['Special_Price_From_Date'], 0, -10) && $cdate <= substr($product_data['response']['docs'][$i_arr]['Special_Price_To_Date'], 0, -10))
	{ ?>
		<p><?php echo round(100-($product_data['response']['docs'][$i_arr]['Special_Price']/$product_data['response']['docs'][$i_arr]['Mrp']*100)) ?>% off </p>
        <?php
	}else{
			if($product_data['response']['docs'][$i_arr]['Price']!=0)
			{
				if($product_data['response']['docs'][$i_arr]['Price']!=$product_data['response']['docs'][$i_arr]['Mrp'])
				{
				 ?>
				<p><?php echo round(100-($product_data['response']['docs'][$i_arr]['Price']/$product_data['response']['docs'][$i_arr]['Mrp']*100)) ?>% off </p>
			<?php }}
		 }
}else{
		if($product_data['response']['docs'][$i_arr]['Price']!=0)
			{ 
			if($product_data['response']['docs'][$i_arr]['Price']!=$product_data['response']['docs'][$i_arr]['Mrp'])
				{
			?>
				<p><?php echo round(100-($product_data['response']['docs'][$i_arr]['Price']/$product_data['response']['docs'][$i_arr]['Mrp']*100)) ?>% off </p>
			<?php }}
	 }
?>
			</div></span>
            </p>
        </div>
      </div>
			<?php
			} // End of foreach loop?>
            </div>
            
            <div id="htmlcount">
            <span>(Showing <?php echo $product_data['response']['numFound'];?> products)</span>
            </div>
            
            
            <div id="htmlviewmorecount">
            <img src="<?php echo base_url();?>images/loader.gif" id="lodr_img"/>
            <input type="button" style="display:none;" class="add-to-cart view_mor" id="viewmore_prodbtnid" value="view more new" name="button" onClick="ShowMoreData('<?php echo $product_data['response']['numFound'];?>')">
            <input type="hidden" name="scrol_tracktxtbox" id="scrol_tracktxtbox" value="wait to scroll" />
            </div>
            
            
            <?php }else{ ?>
            <div id="htmlcount">
            <span>(Showing 0 products)</span>
            </div>
           <div id="html1">NO Record Found</div>
           <div id="html2">NO Record Found</div>
			<?php } ?>
        
