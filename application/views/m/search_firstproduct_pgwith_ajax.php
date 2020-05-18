<?php //echo '<pre>';print_r($product_data);exit;?>
         <?php
		$cntt=count($product_data['response']['docs']);
		if($cntt>0){
			?>
<!--------------- grid view html1 start for first product ajax start ----------------->            
            <div id="html1">
			<?php
		for($i_arr=0; $i_arr<$cntt; $i_arr++ ) {
			//$cdate=time();
			$cdate=date("Y-m-d");
		?>

				<div class="col-md-3 product-grids"> 
						<div class="agile-products" style="max-height: 350px; height: 250px;">
                         
							<div class="<?php 
if($product_data['response']['docs'][$i_arr]['Special_Price']!=0)
{
	if($cdate >= substr($product_data['response']['docs'][$i_arr]['Special_Price_From_Date'], 0, -10) && $cdate <= substr($product_data['response']['docs'][$i_arr]['Special_Price_To_Date'], 0, -10))
	{
		echo 'new-tag';
	}else{
			if($product_data['response']['docs'][$i_arr]['Price']!=0)
			{
				if($product_data['response']['docs'][$i_arr]['Price']!=$product_data['response']['docs'][$i_arr]['Mrp'])
				{
					echo 'new-tag';
				}
			}
		 }
}else{
		if($product_data['response']['docs'][$i_arr]['Price']!=0)
			{
				if($product_data['response']['docs'][$i_arr]['Price']!=$product_data['response']['docs'][$i_arr]['Mrp'])
				{
					echo 'new-tag';
				}
				
			}
	 }
?>">
                            <!--<h6>20%<br>Off</h6>-->                           
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
                            </div>
                            
                            
							
                            <div style="margin:auto; width:100%; text-align:center; ">
                             
                             <a style="margin:auto; text-align:center;" 
                             href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower(@$product_data['response']['docs'][$i_arr]['Title'])))).'/'.$product_data['response']['docs'][$i_arr]['Product_Id'].'/'.$product_data['response']['docs'][$i_arr]['Sku']  ?>">
                             <?php if(empty($product_data['response']['docs'][$i_arr]['Catalog_Image'][0])){?>
                             <img style="height: 112px;max-width: 100%;margin: auto;text-align: center;" src="<?php echo base_url();?>images/product_img/prdct-no-img.png" onerror="imgError(this);"  alt="">
                             <?php }else{?>
                              <img style="height: 112px;max-width: 100%;margin: auto;text-align: center;" src="<?php echo base_url();?>images/product_img/<?=$product_data['response']['docs'][$i_arr]['Catalog_Image'][0];?>" onerror="imgError(this);"  alt="">
                             <?php } ?>
                             </a>                       
                             
                            </div>
							<div class="agile-product-text" >              
								<h5 style="text-align:left; margin-left:0; font-family: 'SegoeUI'; line-height: 16px;"><a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower(@$product_data['response']['docs'][$i_arr]['Title'])))).'/'.$product_data['response']['docs'][$i_arr]['Product_Id'].'/'.$product_data['response']['docs'][$i_arr]['Sku']  ?>">
								<?php if(strlen(@$product_data['response']['docs'][$i_arr]['Title']) > 30){echo substr(@$product_data['response']['docs'][$i_arr]['Title'],0,30).'...';}else{echo @$product_data['response']['docs'][$i_arr]['Title'];} ?>
                                </a></h5> 
								<!--<h6><del>$200</del> $100</h6>-->
                                
                                 <!-----------------------------------Produc price start---------------------------->
                                
                                
                                <?php
		if($product_data['response']['docs'][$i_arr]['Special_Price'] !=0){
			//$cdate=time();
			if($cdate >= substr($product_data['response']['docs'][$i_arr]['Special_Price_From_Date'], 0, -10) && $cdate <= substr($product_data['response']['docs'][$i_arr]['Special_Price_To_Date'], 0, -10)){
		?>
        
                                
                                
                                
                                
                                	                              
                                		<span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$product_data['response']['docs'][$i_arr]['Mrp'] ?> </span>
                                        &nbsp;
             <?php if($product_data['response']['docs'][$i_arr]['Price'] != 0){?>
                                        <span style="color:#F90;text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($product_data['response']['docs'][$i_arr]['Price']); ?> </span>&nbsp;
 <?php }?>
                                        <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($product_data['response']['docs'][$i_arr]['Special_Price']); ?> </span>
 <!---Special price exists condition end here --->
		<?php }else{ ?>
        <?php if($product_data['response']['docs'][$i_arr]['Price'] != 0){?>
        	<span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($product_data['response']['docs'][$i_arr]['Mrp']); ?> </span>
            &nbsp;&nbsp;
            <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($product_data['response']['docs'][$i_arr]['Price']); ?> </span>                  		
        	<?php }else{?> 
            <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($product_data['response']['docs'][$i_arr]['Mrp']); ?> </span>
            <?php }?>
        
        <?php } //End of date condition ?>
        
        <?php }else{ ?>
		<?php if($product_data['response']['docs'][$i_arr]['Price'] != 0){?>                               
          <span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($product_data['response']['docs'][$i_arr]['Mrp']); ?> </span>
          &nbsp;&nbsp;
          <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($product_data['response']['docs'][$i_arr]['Price']); ?> </span>                             
        <?php }else{?>
        
        <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($product_data['response']['docs'][$i_arr]['Mrp']); ?> </span>
        <?php }?>
		
        <?php } ?>                       
                                
							</div>
						</div> 
					</div>
                    
                    
            <?php } // End of foreach loop?>
            </div>
<!--------------- grid view html1 start for first product ajax end ----------------->



            
<!--------------- list view html2 start for first product ajax start ----------------->            
            <div id="html2">
			<?php
		for($i_arr=0; $i_arr<$cntt; $i_arr++ ) {
			?>
            
<!--------------- list view start for first product ajax start ----------------->
			<div style="text-align:center; font-size:15px;">
       <div class="pad-res singleproduct-grids">
		<div class="today-deal-left">
			<a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower(@$product_data['response']['docs'][$i_arr]['Title'])))).'/'.$product_data['response']['docs'][$i_arr]['Product_Id'].'/'.$product_data['response']['docs'][$i_arr]['Sku']  ?>">
            <?php if(empty($product_data['response']['docs'][$i_arr]['Catalog_Image'][0])){?>
			<img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" alt="<?php if(strlen(@$product_data['response']['docs'][$i_arr]['Title']) > 40){echo substr(@$product_data['response']['docs'][$i_arr]['Title'],0,40).'...';}else{echo @$product_data['response']['docs'][$i_arr]['Title'];} ?>">
            <?php }else{?>
            <img src="<?php echo base_url();?>images/product_img/<?=$product_data['response']['docs'][$i_arr]['Catalog_Image'][0];?>" alt="<?php if(strlen(@$product_data['response']['docs'][$i_arr]['Title']) > 40){echo substr(@$product_data['response']['docs'][$i_arr]['Title'],0,40).'...';}else{echo @$product_data['response']['docs'][$i_arr]['Title'];} ?>">
            <?php }?>
    		</a>
		</div>
        
		<div class="today-deal-right">
			<h5 style="text-align:left; margin-left:0; margin-bottom:8px; font-size:18px; font-family: 'SegoeUI';">
			<a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower(@$product_data['response']['docs'][$i_arr]['Title'])))).'/'.$product_data['response']['docs'][$i_arr]['Product_Id'].'/'.$product_data['response']['docs'][$i_arr]['Sku']  ?>">
            <?php if(strlen(@$product_data['response']['docs'][$i_arr]['Title']) > 30){echo substr(@$product_data['response']['docs'][$i_arr]['Title'],0,30).'...';}else{echo @$product_data['response']['docs'][$i_arr]['Title'];} ?>
            </a>
			</h5>
            <p style="margin-left:0px; float:left; display:inline-block;">
<!-----------------------------------Produc price start---------------------------->
            <!--<span style="color:#999; text-decoration:line-through">
            <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp; 3555 </span>&nbsp;&nbsp;
            
            <span style="color:#fb8928; text-decoration:line-through">
            <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp; 3555 </span>&nbsp;&nbsp;
            
            <span style="color:#079107 !important;  font-weight:bold;">
                                       <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp; 1199 </span>-->
                          
            <?php
		if($product_data['response']['docs'][$i_arr]['Special_Price'] !=0){
			//$cdate=time();
			if($cdate >= substr($product_data['response']['docs'][$i_arr]['Special_Price_From_Date'], 0, -10) && $cdate <= substr($product_data['response']['docs'][$i_arr]['Special_Price_To_Date'], 0, -10)){
		?>
        
                                
                                
                                
                                
                                	                              
                                		<span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$product_data['response']['docs'][$i_arr]['Mrp'] ?> </span>
                                        &nbsp;
             <?php if($product_data['response']['docs'][$i_arr]['Price'] != 0){?>
                                        <span style="color:#F90;text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($product_data['response']['docs'][$i_arr]['Price']); ?> </span>&nbsp;
 <?php }?>
                                        <span style="color:#079107 !important; font-weight:bold;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($product_data['response']['docs'][$i_arr]['Special_Price']); ?> </span>
 <!---Special price exists condition end here --->
		<?php }else{ ?>
        <?php if($product_data['response']['docs'][$i_arr]['Price'] != 0){?>
        	<span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($product_data['response']['docs'][$i_arr]['Mrp']); ?> </span>
            &nbsp;&nbsp;
            <span style="color:#079107 !important; font-weight:bold;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($product_data['response']['docs'][$i_arr]['Price']); ?> </span>                  		
        	<?php }else{?> 
            <span style="color:#079107 !important; font-weight:bold;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($product_data['response']['docs'][$i_arr]['Mrp']); ?> </span>
            <?php }?>
        
        <?php } //End of date condition ?>
        
        <?php }else{ ?>
		<?php if($product_data['response']['docs'][$i_arr]['Price'] != 0){?>                               
          <span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($product_data['response']['docs'][$i_arr]['Mrp']); ?> </span>
          &nbsp;&nbsp;
          <span style="color:#079107 !important; font-weight:bold;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($product_data['response']['docs'][$i_arr]['Price']); ?> </span>                             
        <?php }else{?>
        
        <span style="color:#079107 !important; font-weight:bold;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($product_data['response']['docs'][$i_arr]['Mrp']); ?> </span>
        <?php }?>
		
        <?php } ?>                            
<!-----------------------------------Produc price end---------------------------->
         	<span style="display:inline-block;"></span>
            </p>
            <div class="<?php 
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
                   <!--<p> 66% off </p>-->
                   <?php 
if($product_data['response']['docs'][$i_arr]['Special_Price']!=0)
{
	//echo $product_data['response']['docs'][$i_arr]['Special_Price_From_Date'];
	//echo substr($product_data['response']['docs'][$i_arr]['Special_Price_From_Date'], 0, -10);exit;
	if($cdate >= substr($product_data['response']['docs'][$i_arr]['Special_Price_From_Date'], 0, -10) && $cdate <= substr($product_data['response']['docs'][$i_arr]['Special_Price_To_Date'], 0, -10))
	{ ?>
		<p><?php echo round(100-($product_data['response']['docs'][$i_arr]['Special_Price']/$product_data['response']['docs'][$i_arr]['Mrp']*100)) ?>% OFF</p>
        <?php
	}else{
			if($product_data['response']['docs'][$i_arr]['Price']!=0)
			{
				if($product_data['response']['docs'][$i_arr]['Price']!=$product_data['response']['docs'][$i_arr]['Mrp'])
				{
				 ?>
				<p><?php echo round(100-($product_data['response']['docs'][$i_arr]['Price']/$product_data['response']['docs'][$i_arr]['Mrp']*100)) ?>% OFF</p>
			<?php }}
		 }
}else{
		if($product_data['response']['docs'][$i_arr]['Price']!=0)
			{ 
			if($product_data['response']['docs'][$i_arr]['Price']!=$product_data['response']['docs'][$i_arr]['Mrp'])
				{
			?>
				<p><?php echo round(100-($product_data['response']['docs'][$i_arr]['Price']/$product_data['response']['docs'][$i_arr]['Mrp']*100)) ?>% OFF</p>
			<?php }}
	 }
?>
            </div>
                  
		</div>
          <!--<div class="out-of-stock"><span>Out Of Stock</span></div>--> 
           <div style="clear:both;"></div>
	   </div>
    </div>
<!--------------- list view start for first product ajax end ----------------->
            
            
            <?php
			} // End of foreach loop?>
            </div>
<!--------------- list view html2 start for first product ajax end ----------------->  



<!--------------- product count start ----------------->             
            <div id="htmlcount">
            <a style="border:none; background:none; list-style:none;">( <?php echo $product_data['response']['numFound'];?> Product )</a>
            </div>
<!--------------- product count end ----------------->             
<!--------------- view more btn start ----------------->           
            <div id="htmlviewmorecount">
            <img src="<?php echo base_url();?>images/loader.gif" id="lodr_img" height="25px" width="25px"/>
            <input type="button" style="display:none;" class="add-to-cart view_mor" id="viewmore_prodbtnid" value="view more new" name="button" onClick="ShowMoreData('<?php echo $product_data['response']['numFound'];?>')">
            <input type="hidden" name="scrol_tracktxtbox" id="scrol_tracktxtbox" value="wait to scroll" />
            </div>
<!--------------- view more btn end ----------------->            
            
		<?php }else{ ?>
			<div id="htmlcount">
            <a style="border:none; background:none; list-style:none;">( 0 Product )</a>
            </div>
            <div id="html1">NO Record Found</div>
           <div id="html2">NO Record Found</div>
		<?php } ?>