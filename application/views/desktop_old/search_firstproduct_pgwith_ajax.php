<div class="grids_of_4" >
        <?php  
		$row=$product_data->num_rows();
		//print_r($row);exit;
		$sl=0;
		if($row>0){
		foreach($product_data->result() as $rw ) { $sl++;
			$cdate = date('Y-m-d');
			$srch_sku=$rw->sku;
			$qr2=$this->db->query("select a.name, a.imag AS catelog_img_url,a.product_id,a.mrp,a.price,a.special_price,a.quantity,a.special_pric_from_dt,a.seller_id,a.special_pric_to_dt,a.sku , a.lvl2 as category_id from cornjob_productsearch a WHERE a.sku='$srch_sku' ");			
			
			$special_price_from_dt = $qr2->row()->special_pric_from_dt;
			$special_price_to_dt = $qr2->row()->special_pric_to_dt;
			
			$dsply_img = $qr2->row()->catelog_img_url;
			$image_arr=explode(',',$qr2->row()->catelog_img_url);
			//$taxdecimal = $qr2->row()->tax_rate_percentage/100;
		
			//tax amount for product price
			//$tax_amount = $qr2->row()->price*$taxdecimal;
		
			//tax amount for product special price
			//$tax_amount_special = $qr2->row()->special_price*$taxdecimal;
			$quantity=$qr2->row()->quantity;	
			
			
					$extimg_sku=$srch_sku;
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
                <?php /*?><a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($qr2->row()->name)))).'/'.$qr2->row()->product_id.'/'.$qr2->row()->sku  ?>" ><?php */?>
                 <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($qr2->row()->name)))).'/'.$qr2->row()->product_id.'/'.$qr2->row()->sku  ?>" >
                
                Out of Stock </a> </div><?php }?>
               <?php /*?> <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($qr2->row()->name)))).'/'.$qr2->row()->product_id.'/'.$qr2->row()->sku  ?>" ><?php */?>
			   	  
   <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($qr2->row()->name)))).'/'.$qr2->row()->product_id.'/'.$qr2->row()->sku  ?>" >
                    <?php if(empty($dsply_img)){?>
    				<img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" class="img-responsive" alt="<?=$qr2->row()->name;?>">
    				<?php }else{?>
					<img src="<?php echo base_url();?>images/product_img/<?=$image;?>" onerror="imgError(this);" class="wow flipInY grow" data-wow-delay="1s" alt="<?=$qr2->row()->name;?>">
   					<?php } ?>
                      
				   </a> </div>
                   
                  <div class="wish-list">    <?php if($this->session->userdata('session_data')){ ?>            
            	<span class="link-wishlist wish_spn" onClick="addWishlistFunction(<?=$qr2->row()->product_id; ?>,'<?=$qr2->row()->sku; ?>')"> <i class="fa fa-heart"></i> </span>
            <?php }else{ ?>
            	<a class="link-wishlist inline" href="#inline_content"> <i class="fa fa-heart"></i> </a>
            <?php } ?>
            </div>
				    <h2 class="prdt_title"> <?php /*?><a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($qr2->row()->name)))).'/'.$qr2->row()->product_id.'/'.$qr2->row()->sku  ?>" > <?php */?>
					
					<a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($qr2->row()->name)))).'/'.$qr2->row()->product_id.'/'.$qr2->row()->sku  ?>" >
					
					<?php if(strlen($qr2->row()->name) > 40){ echo substr($qr2->row()->name,0,40).'...';}else{ echo $qr2->row()->name;}?> </a> </h2>
                     
                      <!--- <h6><?php// echo substr($qr2->row()->description,0,50).'...';  ?> </h6> -->
                     
                     <!--- price calculation div start here --->
                    <?php /*?><div class="price-box">
                    <?php 
                    if($qr2->row()->special_price !=0){ 
                        if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                    ?> 
                    
                    <span class="regular-price"> Rs. <?=ceil($qr2->row()->price); ?> </span> &nbsp;&nbsp;
                    <span class="price"> Rs. <?=ceil($qr2->row()->special_price); ?> </span>
                    <?php }else{ ?>
                    <span class="price"> Rs. <?=ceil($qr2->row()->price); ?> </span>
                        <?php } //End of date condition ?>
                    

                    <?php }else{ ?>
                    <span class="price"> Rs. <?=ceil($qr2->row()->price); ?> </span>
                    <?php } ?>
                    </div><?php */?>
                    
                    
        <!--- price calculation div start here --->
     	<div class="price-box" >
        <!---Special price exists condition start here --->
		<?php
		if($qr2->row()->special_price !=0){
			if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
		?>
        
		<span class="regular-price"> Rs. <?=ceil($qr2->row()->mrp); ?> </span> &nbsp;&nbsp;
        
        <?php if($qr2->row()->price != 0){?>
        <span class="regular-price"> Rs. <?=ceil($qr2->row()->price); ?> </span> &nbsp;&nbsp;
        <?php }?>
        
        <span class="price"> Rs. <?=ceil($qr2->row()->special_price); ?> </span>
        <!---Special price exists condition end here --->
		<?php }else{ ?>
		
        <?php if($qr2->row()->price != 0){?>
        <span class="regular-price"> Rs. <?=ceil($qr2->row()->mrp); ?> </span> &nbsp;&nbsp;
        <span class="price"> Rs. <?=ceil($qr2->row()->price); ?> </span> &nbsp;&nbsp;
        <?php }else{?>
        <span class="price"> Rs. <?=ceil($qr2->row()->mrp); ?> </span> &nbsp;&nbsp;
        <?php }?>
        
        <?php } //End of date condition ?>
        
        <?php }else{ ?>
        
		<?php if($qr2->row()->price != 0){?>
        <span class="regular-price"> Rs. <?=ceil($qr2->row()->mrp); ?> </span> &nbsp;&nbsp;
        <span class="price"> Rs. <?=ceil($qr2->row()->price); ?> </span> &nbsp;&nbsp;
        <?php }else{?>
        <span class="price"> Rs. <?=ceil($qr2->row()->mrp); ?> </span> &nbsp;&nbsp;
        <?php }?>
		
        <?php } ?>
        </div>
        <!--- price calculation div end here --->
      
       <?php
	   $srch_productid=$qr2->row()->product_id;
		$query= $this->db->query("SELECT  product_id   FROM product_master WHERE approve_status = 'Active' and product_id='$srch_productid' and seller_id!=0 GROUP BY product_id, seller_id");
		
		
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
                   
                 
                   
        <!--<div  class="btn-bg">
			<button type="button" title="Quick View" class="button btn-cart" data-toggle="modal" data-target="#myModal<?=$sl?>"> View Details</button> 
            
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
                              <img src="<?php $image_arr1=explode(',',$qr2->row()->imag); echo base_url().'images/product_img/'.$image_arr1[0]; ?>" class="" width="500" alt=""/>
                            </div>
                                
                            <div class="col-md-4 quick_view_data">
                                <div class="light-box-product-details">
                                    <h2 class="single_prdct_title"><?=$qr2->row()->name?></h2>
                                    
                                    <!--- price calculation div start here --->
                                    <div class="price-box">
                                    <!---Special price exists condition start here --->
                                    <?php
                                    if($qr2->row()->special_price !=0){
                                        if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                                    ?>
                                    
                                    <span class="regular-price"> Rs. <?=ceil($qr2->row()->mrp); ?> </span> &nbsp;&nbsp;
                                    
                                    <?php if($qr2->row()->price != 0){?>
                                    <span class="regular-price"> Rs. <?=ceil($qr2->row()->price); ?> </span> &nbsp;&nbsp;
                                    <?php }?>
                                    
                                    <span class="price"> Rs. <?=ceil($qr2->row()->special_price); ?> </span>
                                    <!---Special price exists condition end here --->
                                    <?php }else{ ?>
                                    
                                    <?php if($qr2->row()->price != 0){?>
                                    <span class="regular-price"> Rs. <?=ceil($qr2->row()->mrp); ?> </span> &nbsp;&nbsp;
                                    <span class="price"> Rs. <?=ceil($qr2->row()->price); ?> </span> &nbsp;&nbsp;
                                    <?php }else{?>
                                    <span class="price"> Rs. <?=ceil($qr2->row()->mrp); ?> </span> &nbsp;&nbsp;
                                    <?php }?>
                                    
                                    <?php } //End of date condition ?>
                                    
                                    <?php }else{ ?>
                                    
                                    <?php if($qr2->row()->price != 0){?>
                                    <span class="regular-price"> Rs. <?=ceil($qr2->row()->mrp); ?> </span> &nbsp;&nbsp;
                                    <span class="price"> Rs. <?=ceil($qr2->row()->price); ?> </span> &nbsp;&nbsp;
                                    <?php }else{?>
                                    <span class="price"> Rs. <?=ceil($qr2->row()->mrp); ?> </span> &nbsp;&nbsp;
                                    <?php }?>
                                    
                                    <?php } ?>
                                    </div>
                                    <!--- price calculation div end here --->
                                    <!--<button type="button" title="Add to Cart" onClick="window.location.href='<?//php echo base_url().'product_description/addtocart/'.str_replace(" ","-",strtolower($qr2->row()->name)).'/'.$qr2->row()->product_id.'/'.$qr2->row()->sku; ?>' " class="btn btn-primary" >Add to Cart</button>--> 
                                    <div>
                                        <ul>
                                            <?php if($qr2->row()->short_desc){
                                                $data = $qr2->row()->short_desc;
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
            
		
			   	</div>
			</div>
            <?php } // End of foreach loop?>
            <?php }else{ ?>
           <div>NO Record Found</div>
			<?php } ?>
        </div>