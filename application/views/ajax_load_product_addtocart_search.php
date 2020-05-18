	 	<?php if($product_data != false){ ?>
        <?php
		$row=$product_data->num_rows();
		$sl=$sl_no;
		//print_r($row);exit;
		if($row>0){
		foreach($product_data->result() as $rw ) { $sl++;
			$cdate = date('Y-m-d');
			$special_price_from_dt = $rw->special_pric_from_dt;
			$special_price_to_dt = $rw->special_pric_to_dt;
			
			$dsply_img = $rw->catelog_img_url;
			$image_arr=explode(',',$rw->catelog_img_url);
			//$taxdecimal = $rw->tax_rate_percentage/100;
			
			//tax amount for product price
			//$tax_amount = $rw->price*$taxdecimal;
			
			//tax amount for product special price
			//$tax_amount_special = $rw->special_price*$taxdecimal;
			$quantity=$rw->quantity;
			
					$extimg_sku=$rw->sku;
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
          <div class="grid1_of_4 catlg">
				<div class="content_box"> 
               <div class="view view-fifth">
                 <?php if($quantity == 0){ ?>
                 <div class="outofstock">
               <?php /*?> <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>" ><?php */?>
                <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>" >
                
                
                
                
                Out of Stock </a> </div><?php }?>
                
               <?php /*?> <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>" ><?php */?>
                
                
                 <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>" >
                  	
                    <?php if(empty($dsply_img)){?>
    				<img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" class="img-responsive" alt="<?=$rw->name;?>">
    				<?php }else{?>
					<img src="<?php echo base_url();?>images/product_img/<?=$image;?>" onerror="imgError(this);" class="img-responsive wow flipInY" data-wow-delay="0.5s" alt="<?=$rw->name;?>">
   					<?php } ?>
                    
				   </a> </div>
                   
                  <div class="wish-list">    <?php if($this->session->userdata('session_data')){ ?>            
            	<span class="link-wishlist wish_spn" onClick="addWishlistFunction(<?=$rw->product_id; ?>,'<?=$rw->sku; ?>')"> <i class="fa fa-heart"></i> </span>
            <?php }else{ ?>
            	<a class="link-wishlist inline" href="#inline_content"> <i class="fa fa-heart"></i> </a>
            <?php } ?>
            </div>
				   <?php /*?> <h2 class="prdt_title"> <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>" > <?php if(strlen($rw->name) > 40){ echo substr($rw->name,0,40).'...';}else{ echo $rw->name;}?> <?php */?>
                    <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>" > <?php if(strlen($rw->name) > 40){ echo substr($rw->name,0,40).'...';}else{ echo $rw->name;}?> 
                    
                    
                    
                    
                    </a> </h2>
                    
                    
        <!--- price calculation div start here --->
     	<div class="price-box">
        <!---Special price exists condition start here --->
		<?php
		if($rw->special_price !=0){
			if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
		?>
        
		<span class="regular-price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
        
        <?php if($rw->price != 0){?>
        <span class="regular-price"> Rs. <?=ceil($rw->price); ?> </span> &nbsp;&nbsp;
        <?php }?>
        
        <span class="price"> Rs. <?=ceil($rw->special_price); ?> </span>
        <!---Special price exists condition end here --->
		<?php }else{ ?>
		
        <?php if($rw->price != 0){?>
        <span class="regular-price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
        <span class="price"> Rs. <?=ceil($rw->price); ?> </span> &nbsp;&nbsp;
        <?php }else{?>
        <span class="price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
        <?php }?>
        
        <?php } //End of date condition ?>
        
        <?php }else{ ?>
        
		<?php if($rw->price != 0){?>
        <span class="regular-price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
        <span class="price"> Rs. <?=ceil($rw->price); ?> </span> &nbsp;&nbsp;
        <?php }else{?>
        <span class="price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
        <?php }?>
		
        <?php } ?>
        </div>
        <!--- price calculation div end here --->
      
       <?php
		$query= $this->db->query("SELECT  product_id FROM product_master WHERE approve_status = 'Active' and product_id='$rw->product_id' and seller_id!=0 GROUP BY product_id, seller_id");
		
		
		//$qr=$query->result();
		//print_r($qr);exit;
		    //foreach($qr as $rew){
			$count_13 = $query->num_rows()-1;
			//print_r($count_1);exit;
			if($count_13 > 0)
			{
			//?>

         <div class="other-seller">  <a href="#"> From <?php echo $count_13; ?> other Sellers </a> </div> 
		 <?php }//} ?>

           <!--<ul class="add-to-links">
            <li><span class="separator"> <input type="checkbox"> </span> <a href="#" class="link-compare">Add to Compare</a></li>
           </ul>-->


        <!--<div class="btn-bg">
			<button type="button" title="Quick View" class="button btn-cart" data-toggle="modal" data-target="#myModal<?=$sl?>">View Details</button> 
		</div> -->
		
         <!-- Modal --> 
		<?php /*?><div class="modal fade" id="myModal<?=$sl?>" role="dialog" aria-labelledby="myModalLabel"> 
            <div class="vertical-alignment-helper">
                 <div class="modal-dialog vertical-align-center">
                     <div class="modal-content">
                         <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         </div>
                         
                         <div class="modal-body">
                            <div class="col-md-8 quick_view_img">
                              <img src="<?php $image_arr1=explode(',',$rw->imag); echo base_url().'images/product_img/'.$image_arr1[0]; ?>" class="" width="500" alt=""/>
                            </div>
                                
                            <div class="col-md-4 quick_view_data">
                                <div class="light-box-product-details">
                                    <h2 class="single_prdct_title"><?=$rw->name?></h2>
                                    
                                    <!--- price calculation div start here --->
                                    <div class="price-box">
                                    <!---Special price exists condition start here --->
                                    <?php
                                    if($rw->special_price !=0){
                                        if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                                    ?>
                                    
                                    <span class="regular-price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
                                    
                                    <?php if($rw->price != 0){?>
                                    <span class="regular-price"> Rs. <?=ceil($rw->price); ?> </span> &nbsp;&nbsp;
                                    <?php }?>
                                    
                                    <span class="price"> Rs. <?=ceil($rw->special_price); ?> </span>
                                    <!---Special price exists condition end here --->
                                    <?php }else{ ?>
                                    
                                    <?php if($rw->price != 0){?>
                                    <span class="regular-price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
                                    <span class="price"> Rs. <?=ceil($rw->price); ?> </span> &nbsp;&nbsp;
                                    <?php }else{?>
                                    <span class="price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
                                    <?php }?>
                                    
                                    <?php } //End of date condition ?>
                                    
                                    <?php }else{ ?>
                                    
                                    <?php if($rw->price != 0){?>
                                    <span class="regular-price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
                                    <span class="price"> Rs. <?=ceil($rw->price); ?> </span> &nbsp;&nbsp;
                                    <?php }else{?>
                                    <span class="price"> Rs. <?=ceil($rw->mrp); ?> </span> &nbsp;&nbsp;
                                    <?php }?>
                                    
                                    <?php } ?>
                                    </div>
                                    <!--- price calculation div end here --->
                                    <!--<button type="button" title="Add to Cart" onClick="window.location.href='<?//php echo base_url().'product_description/addtocart/'.str_replace(" ","-",strtolower($rw->name)).'/'.$rw->product_id.'/'.$rw->sku; ?>' " class="btn btn-primary" >Add to Cart</button>--> 
                                    <div>
                                        <ul>
                                            <?php if($rw->short_desc){
                                                $data = $rw->short_desc;
                                                //$description = preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $data);
                                            	//$short_desc = unserialize($description);
												$short_desc = unserialize($data);
                                                foreach($short_desc as $value){
                                                ?>
                                                    <li><?=$value?></li>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    
                                </div>
                            </div>
                                
                            <div class="clearfix"></div>
                          </div>
                        </div>
                      </div>
                    </div>
            </div><?php */?>
		
          <!-- Modal --> 
		
			   	</div>
				</div>
            
            <?php } // End of foreach loop?>
            <?php } ?>

          <?php } // End of product data is not false condition ?>
		<!-- end grids_of_4 -->

