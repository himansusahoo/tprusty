<?php include "header.php"; ?>

<link rel="canonical" href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2)?>"/>
	<div class="wrap">
		<!--products-->
       <div class="info-products seller" id="info">
	  
	      <div class="info-inner">
		     		<div class="section-info">
                    <!-------------------------------Seller Rivew Start---------------------------------------------->
                   <?php
                $seller_review_row = $seller_review_data->num_rows();
                if($seller_review_row > 0){
                    ////script start for avarage rating/////////
                    $rating = array();
                    foreach($seller_review_data->result() as $val){
                        $rating[] = $val->rating;
                    }
                    $total_sum_of_rating = array_sum($rating);
                    $average_rating = ceil($total_sum_of_rating / $seller_review_row) ;		
                    ////script end for avarage rating/////////
                            
                    $slr_data = $seller_review_data->result();
                    $seller_business = $slr_data[0]->business_name;
                    $seller_desc = $slr_data[0]->business_desc;
                    $seller_id = $slr_data[0]->seller_id;
                    //print_r($seller_id);exit;
                    
                ?>               
                 <h3> <?= $seller_business ;?> </h3>
                    
                    <ul class="star">
                    <?php  
					for($i=1; $i<=5; $i++)
					{
						if($average_rating==$i){?>
                       <li> <i class="fa fa-star" aria-hidden="true"></i> </li>                    	
                        <?php }else{ ?>
                        <li> <i class="fa fa-star-o" aria-hidden="true"></i> </li>                        
					<?php } 
					}
					?>
                           <!--<li> <i class="fa fa-star-half-o" aria-hidden="true"></i> </li>-->
                            <li class="review"> | &nbsp; <?= $seller_review_row ;?> reviews </li>
                            <li><?= $seller_desc ;?></li>
                            
   <?php
	 $query=$this->db->query("select sum(quantity) as quantity_count from  ordered_product_from_addtocart where seller_id='$seller_id' and product_order_status='Delivered'");
	 $row=$query->result();
	 $c = $row['0']->quantity_count;
	 if($c <= 99){
		 echo "<li> <strong> Less than 100 Products sold </strong> </li> ";
	 }else if($c > 99 && $c <= 199){
		 echo "<li> <strong> More than 100 Products sold </strong> </li> ";
	 }else if($c > 199 && $c <= 499){
		 echo "<li> <strong> More than 200 Products sold </strong> </li> ";
	 }else{
		 echo "<li> <strong> More than 500 Products sold </strong> </li> ";
	 }
	 ?>
   
     <li>
     <?php
   foreach($seller_badge as $val){
	   					$badge = $val->seller_badge_type;
						if($badge){
					$badge_array = explode(',', $badge);
					
						?>
					
	                <?php
	
                        if(in_array('Moonboy Fulfilled', $badge_array)){
					?>
                    <img src="<?php echo base_url()?>images/moon-fulfilled.png" >
					<?php
						}
						if(in_array('Fast Shipping', $badge_array)){
					?>
					<img src="<?php echo base_url()?>images/fast-delivery.png">								
					<?php
						}
						if(in_array('Star Seller', $badge_array)){
						?>
							<img src="<?php echo base_url()?>images/star-seller.png">								
					<?php	
						} ?><?php }} ?></li>
    
                            
                            
                            </ul>
                    
             
                  <ul class="inner-nav">
                  <li> <a href="#"> Product From This Seller </a></li>
                  <li> <a href="#"> Reviews </a></li>
                 </ul>
              <?php }else{ ?>
              
              	<h3><?= $seller_data[0]->business_name ;?></h3>
 					<ul class="star">
                             <?php  
					for($i=1; $i<=5; $i++)
					{ ?>                                        	
                        
                        <li> <i class="fa fa-star-o" aria-hidden="true"></i> </li>                        
					<?php } ?> 
					
                            
                            <!--<li> <i class="fa fa-star" aria-hidden="true"></i> </li>
                            <li> <i class="fa fa-star" aria-hidden="true"></i> </li>
                            <li> <i class="fa fa-star" aria-hidden="true"></i> </li>
                            <li> <i class="fa fa-star" aria-hidden="true"></i> </li>
                            <li> <i class="fa fa-star-half-o" aria-hidden="true"></i> </li>-->
                            <li class="review"> | &nbsp; <?= $seller_review_row ;?> reviews </li>
                            </ul>
                    
             
                  <ul class="inner-nav">
                  <li> <a href="#"> Product From This Seller </a></li>
                  <li> <a href="#"> Reviews </a></li>
                  
                  <li><?= $seller_data[0]->business_desc ;?></li>
                            
     <?php
	 $seller_id=$seller_data[0]->seller_id;
	 //print_r($seller_id);exit;
	 $query=$this->db->query("select sum(quantity) as quantity_count from  ordered_product_from_addtocart where seller_id='$seller_id' and product_order_status='Delivered'");
	 $row=$query->result();
	 $c = $row['0']->quantity_count;
	 if($c <= 99){
		 echo "<li> <strong> Less than 100 Products sold </strong> </li> ";
	 }else if($c > 99 && $c <= 199){
		 echo "<li> <strong> More than 100 Products sold </strong> </li> ";
	 }else if($c > 199 && $c <= 499){
		 echo "<li> <strong> More than 200 Products sold </strong> </li> ";
	 }else{
		 echo "<li> <strong> More than 500 Products sold </strong> </li> ";
	 }
	 ?>
     <?php //echo $row['0']->quantity_count; ?>
     
     <li>
     <?php
   foreach($seller_badge as $val){
					$badge = $val->seller_badge_type;
					if($badge){
					$badge_array = explode(',', $badge);
					
						?>
					
	                <?php   
	
                        if(in_array('Moonboy Fulfilled', $badge_array)){
					?>
                    <img src="<?php echo base_url()?>images/moon-fulfilled.png" >
					<?php 
						}
						if(in_array('Fast Shipping', $badge_array)){
					?>
					<img src="<?php echo base_url()?>images/fast-delivery.png">								
					<?php
						}
						if(in_array('Star Seller', $badge_array)){
						?>
							<img src="<?php echo base_url()?>images/star-seller.png">								
					<?php	
						} ?><?php }} ?></li>
                  
                  
                  
                  
                 </ul>
              
              
              <?php } ?> 
              <!--------------------------------Seller Review End--------------------------------------->
                  <?php
   foreach($seller_data as $val){ 
					//$seller_badge = $val->seller_badge_type;
					//$badge_array = explode(',', $seller_badge);
					
					$extimg_sku=$val->sku;
					$qr_slrprodimg=$this->db->query("select b.catelog_img_url  from seller_product_master a INNER JOIN  seller_existingproduct_image b ON a.seller_exist_product_id=b.seller_extproduct_id WHERE  a.sku='$extimg_sku' ");
								if($qr_slrprodimg->num_rows()>0)
								{
									$image=$qr_slrprodimg->row()->catelog_img_url;								
									
								}
								else
								{	$image=$val->catelog_img_url;
									
								}
					
					//$image=$val->catelog_img_url;
					//$skuid=$val->sku;
					// echo $val->name;exit;
					$image_arr=explode(',',$image); 
					$cdate = date('Y-m-d');
					$special_price_from_dt = $val->special_pric_from_dt;
					$special_price_to_dt = $val->special_pric_to_dt;
					
					if($val->product_id!='' && $val->sku!='' && $image!=''){
					?>

				  <div class="col-md-4 pro-grid">
				     <div class="box-in">
							<div class="grid_box">	
                            
                             <!--<div class="wishlist"> <a href="#"><i class="fa fa-heart" aria-hidden="true"></i> </a> </div>	-->
							<?php /*?> <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($val->name)))).'/'.$val->product_id.'/'.$val->sku  ?>" > <?php */?>
                             
                             <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($val->name)))).'/'.$val->product_id.'/'.$val->sku  ?>" > 
                             
                             <div class="product-thumb">
                             <?php
							// $file=base_url().'images/product_img/'.$image_arr[0]; 
							 
							  if(empty($image)){?>
                             <img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" class="img-responsive" alt="<?=$val->name;?>">
                             <?php }else { ?>
                             <img src="<?php echo base_url();?>images/product_img/<?=$image;?>" onerror="imgError(this);"  alt="<?=$val->name;?>">                       
                             <?php } ?>
                              </div>
                             <h5> <?php if(strlen($val->name) > 40){ echo substr($val->name,0,30).'...';}else{ echo $val->name;}?> </h5>  </a> 	
                             <!------------------Price Section Start------------------------------------------->
                               
                                	 <!--- price calculation div start here --->
                                           
                                            <!---Special price exists condition start here --->
                                            
                                            <?php
                                            if($val->special_price !=0){
                                                if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                                            ?>
                                            
                                            <div class="cut-price"> Rs. <?=ceil($val->mrp); ?> </div> 
                                            <?php if($val->price != 0){?>
                                           <div class="reducedfrom"> Rs. <?=ceil($val->price); ?> </div> 
                                            <?php }?>
                                            
                                            <div class="grid_1"><a href="#" class="cup item_add"><span class="item_price" > Rs. <?=ceil($val->special_price); ?></span></a> </div>
                                            <!---Special price exists condition end here --->
                                            <?php }else{ ?>
                                            
                                            <?php if($val->price != 0){?>
                                             <div class="cut-price"> Rs. <?=ceil($val->mrp); ?> </div>
                                            <div class="grid_1"><a href="#" class="cup item_add"><span class="item_price" > Rs. <?=ceil($val->price); ?></span></a> </div>
                                            <?php }else{?>
                                            <div class="grid_1"><a href="#" class="cup item_add"><span class="item_price" > Rs. <?=ceil($val->mrp); ?> </span></a></div>
                                            <?php }?>
                                            
                                            <?php } //End of date condition ?>
                                            
                                            <?php }else{ ?>
                                            
                                            <?php if($val->price != 0){?>
                                            <div class="cut-price">  Rs. <?=ceil($val->mrp); ?> </div>
                                            <div class="grid_1"><a href="#" class="cup item_add"><span class="item_price" > Rs. <?=ceil($val->price); ?></span></a> </div>
                                            <?php }else{?>
                                            <div class="grid_1"><a href="#" class="cup item_add"><span class="item_price" > Rs. <?=ceil($val->mrp); ?></span></a> </div> 
                                            <?php }?>
                                            
                                            <?php } ?>
                                           
       							 <!--- price calculation div end here --->
                                
                                
                               <!---------------------------Price Section End-------------------------------> 

                              
                            
                              
                           
					  </div>
				  </div>
				    
				    
				  	  
				   
				    
				    <div class="clearfix"> </div>
				</div><?php } } ?>
                
                 <div class="clearfix"> </div>
                 <div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
                      <div class="clearfix"> &nbsp; </div>

                  <!----------------------Seller Review Description Start----------------------->
                  
                  <h4>REVIEWS & RATINGS</h4><hr/>

                  	<?php	if($seller_review_row > 0){?>
                  		
                  	<table width="100%" class="table-striped">
	<?php
		$sl=0;
		foreach($seller_review_data->result() as $review_row){ 
		$sl++;
	?>
	<tr>
        <td width="20%">
            <ul class="star">
                    <?php  
					for($i=1; $i<=5; $i++)
					{
						if($average_rating==$i){?>
                       <li> <i class="fa fa-star" aria-hidden="true"></i> </li>                    	
                        <?php }else{ ?>
                        <li> <i class="fa fa-star-o" aria-hidden="true"></i> </li>                        
					<?php } 
					}
					?>
                           <!--<li> <i class="fa fa-star-half-o" aria-hidden="true"></i> </li>-->
                            <li class="review"> | &nbsp; <?= $seller_review_row ;?> reviews </li>
                </ul>
            <div class="rateit" data-rateit-backingfld="#backing<?= $sl; ?>c<?= $sl; ?>" data-rateit-min="0"></div>
       
        <?php
		$date = $review_row->added_date;
		$dt = new DateTime($date);
		?>
      <h4> <span style="color:#5d9b05;"> <?= $review_row->fname ; ?> </span> <span class="rev_date">on <?= $dt->format('Y-m-d'); ?> </span></h4>
     </td>
        <td width="80%"> <h4> <?= $review_row->title ; ?> </h4>
       <p> <?= $review_row->content ; ?> </p></td>
        
    </tr>
    
    <?php } ?>
</table>

				  
				  <?php }else{ ?>
                  
                  <table width="100%" class="table-striped">
     			<tr height="20px"><td colspan="5">No Reviews.</td></tr>
				</table>
                  <?php } ?>
                  <!----------------------Seller Review Description End-------------------------->      
                        
                        
                        
		  </div>
	   </div>
  <!--//item-->
		
		</div>


<?php include "footer.php"; ?>