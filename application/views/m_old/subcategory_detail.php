 <?php include 'header.php'; ?>  
 
 <div class="wrap">
		<!--products-->
      <div class="info-products catgry" id="info">
	   
	      <div class="info-inner">
		     		      
		  <div class="section-info">
				<h3 class="tittle"> Mobiles </h3>
               <!--<div class="category-banner"> <img src="<?php// echo base_url().'mobile_css_js/' ?>images/category-banner.jpg" width="600" height="259" alt="" class="img-responsive"> </div>-->
             
               <!---------------------------------subcategory list start---------------------------------------------->
               
               		 <div class="category">
					 <ul class="cssmenu">
						<li class="has-sub"><a href="#"> Categories </a>
							 <ul>
                            <?php
							$sl=0;
							foreach($brand_name->result() as $res){ 
							$sl++;
							?>
								<li onClick="redirectCategoryPage('<?=$res->category_id;?>',<?=$sl;?>,'<?= $res->category_name; ?>')" style="cursor:pointer;">
								<a href="#"><?php echo $res->category_name; ?></a>
                                </li>
                                <?php } ?>
                                </ul>
							</li>
							
						</ul>
					</div>
               
               <!---------------------------------subcategory list end------------------------------------------------>
               
     <!--<div class="col-md-4 pro-grid">
				     <div class="box-in">
							<div class="grid_box">		
							 <a href="catalog.html" > <img src="images/s4.jpg" class="img-responsive" alt="">
                             <h5 class="category-name"> Shoe </h5>
							  </a> 	
						   </div>
		  </div>
				  </div>-->
                  
                  
                  <!-----------------------prodduct category image list start----------------------------------------------->
                 <?php if($product_image!=""){ ?>
                  		
    
        <?php  foreach($product_image->result() as $rw ) { 
		
		$file=base_url().'images/product_img/'.$rw->imag;
		 //$image_arr=explode(',',$rw->catelog_img_url); 
		$dsply_img = $rw->imag;?> <div class="col-md-4 pro-grid">
		  <div class="box-in">
				<div class="grid_box">
                
         <a href="<?php echo base_url().'product_description/product_addtocart/'.preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->category_name))).'/'.$rw->category_id ?>">
			   	<!-- <img src="<?php// echo base_url().'images/product_img/'.$image_arr[0];?>" class="img-responsive" alt=""/>-->
                 <div class="product-thumb">
                <?php if(empty($dsply_img)){?>
                <img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" class="img-responsive" alt="">
                <?php }else{?>
                <img src="<?php echo base_url();?>images/product_img/<?=$rw->imag;?>" onerror="imgError(this);" class="img-responsive" alt="">
                <?php } ?>
                 </div>
                <h5 class="category-name"> <!--<?//= substr($rw->name,0,45).'...';?>--> <?=$rw->category_name; ?></h5><!--</a>--> 
		  </a>  	
				 
         <!--<a href="<?php //echo base_url().'product_description/product_addtocart/'.preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->category_name))).'/'.$rw->category_id ?>">-->
         
			   	
			 </div></div></div>
            <?php } ?>
           
            <?php } ?>
            
		
                  
                  
                 
				    <div class="clearfix"> </div>
				</div>
		  </div>
	   </div>
  <!--//item-->
		
		</div>
   <script>
function redirectCategoryPage(category_id,sl,cat_name){
	window.location.href='<?php echo base_url();?>product_description/product_addtocart/'+cat_name.replace(" ","-")+'/'+category_id;
}


function imgError(image){
    image.onerror = "";
    image.src = "<?php echo base_url();?>images/product_img/prdct-no-img.png";
    return true;
}
</script>     
          <?php include 'footer.php'; ?>  