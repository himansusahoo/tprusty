
                  <?php if($product_data != false){
		$row=$product_data->num_rows();
		$sl=0;
		//print_r($row);exit;
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
				  <div class="col-md-4 pro-grid">
				     <div class=" box-in">
							<div class=" grid_box">	
                             <div class="wishlist"> <a href="#"><i class="fa fa-heart" aria-hidden="true"></i> </a> </div>	
							 <?php /*?><a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($qr2->row()->name)))).'/'.$qr2->row()->product_id.'/'.$qr2->row()->sku  ?>" ><?php */?> 
                             
                             
                              <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($qr2->row()->name)))).'/'.$qr2->row()->product_id.'/'.$qr2->row()->sku  ?>" > 
                             <?php
							 $file=base_url().'images/product_img/'.$dsply_img; 
							 
							  if(empty($dsply_img)){?>
                             <img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" class="img-responsive" alt="<?=$qr2->row()->name;?>">
                             <?php }else { ?>
                                  <img src="<?php echo base_url();?>images/product_img/<?=$image;?>" onerror="imgError(this);" class="img-responsive" alt="<?=$qr2->row()->name;?>">                       
                            <!-- <img src="images/s8.jpg" class="img-responsive" alt="">-->
                             <?php } ?>
                             <h5> <?php if(strlen($qr2->row()->name) > 40){ echo substr($qr2->row()->name,0,30).'...';}else{ echo $qr2->row()->name;}?> </h5>  </a> 	
                             <!------------------Price Section Start------------------------------------------->
                            <!-- <div class="cut-price">Sell Price -  Rs. 566.00</div>
                              <div class="reducedfrom"> MRP - Rs. 566.00</div> 
                              
						    
								<div class="grid_1 simpleCart_shelfItem">
									<a href="#" class="cup item_add"><span class=" item_price" >Rs. 183  </span></a>					
								</div>-->
                                
                                <!---------------------------------------------------->
                                
                                	 <!--- price calculation div start here --->
                                           
                                            <!---Special price exists condition start here --->
                                            
                                            <?php
                                            if($qr2->row()->special_price !=0){
                                                if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                                            ?>
                                            
                                            <div class="cut-price"> Rs. <?=ceil($qr2->row()->mrp); ?> </div> 
                                            <?php if($qr2->row()->price != 0){?>
                                           <div class="reducedfrom"> Rs. <?=ceil($qr2->row()->price); ?> </div> 
                                            <?php }?>
                                            
                                            <div class="grid_1 simpleCart_shelfItem"><a href="#" class="cup item_add"><span class=" item_price" > Rs. <?=ceil($qr2->row()->special_price); ?></span></a> </div>
                                            <!---Special price exists condition end here --->
                                            <?php }else{ ?>
                                            
                                            <?php if($qr2->row()->price != 0){?>
                                             <div class="cut-price"> Rs. <?=ceil($qr2->row()->mrp); ?> </div>
                                            <div class="grid_1 simpleCart_shelfItem"><a href="#" class="cup item_add"><span class=" item_price" > Rs. <?=ceil($qr2->row()->price); ?></span></a> </div>
                                            <?php }else{?>
                                            <div class="grid_1 simpleCart_shelfItem"><a href="#" class="cup item_add"><span class=" item_price" > Rs. <?=ceil($qr2->row()->mrp); ?> </span></a></div>
                                            <?php }?>
                                            
                                            <?php } //End of date condition ?>
                                            
                                            <?php }else{ ?>
                                            
                                            <?php if($qr2->row()->price != 0){?>
                                            <div class="cut-price">  Rs. <?=ceil($qr2->row()->mrp); ?> </div>
                                            <div class="grid_1 simpleCart_shelfItem"><a href="#" class="cup item_add"><span class=" item_price" > Rs. <?=ceil($qr2->row()->price); ?></span></a> </div>
                                            <?php }else{?>
                                            <div class="grid_1 simpleCart_shelfItem"><a href="#" class="cup item_add"><span class=" item_price" > Rs. <?=ceil($qr2->row()->mrp); ?></span></a> </div> 
                                            <?php }?>
                                            
                                            <?php } ?>
                                           
       							 <!--- price calculation div end here --->
                                
                                <!----------------------------------------------------->
                                
                                
                               <!---------------------------Price Section End-------------------------------> 
								<!--<div class="clearfix"></div>                                
                              <span> <a href="#" > From 5 Other Sellers </a></span>	-->
                              
                              <!--------------------------From Other Seller Start----------------------->
                                                            
                               <?php
							   $srch_prodid=$qr2->row()->product_id;
										$query= $this->db->query("SELECT product_id FROM product_master WHERE approve_status = 'Active' and product_id='$srch_prodid' and seller_id!=0 GROUP BY product_id, seller_id");
		
							if($query->num_rows()!=0)
							{	$count_13 = $query->num_rows()-1;
								
								if($count_13 > 0)
								{
								?>
					
							 <span> <a href="#" > From <?php echo $count_13; ?> other Sellers </a> </span> 
							 <?php }} ?>
                              
                              <!----------------------------From Other Seller End----------------------->
                              
						   </div>
                            <?php if($quantity == 0){ ?>
                            <div class="outofstock">
                             <?php /*?><a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($qr2->row()->name)))).'/'.$qr2->row()->product_id.'/'.$qr2->row()->sku  ?>" ><?php */?>
                             
                             
                             <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($qr2->row()->name)))).'/'.$qr2->row()->product_id.'/'.$qr2->row()->sku  ?>" >
                             
                             <span> Out Of Stock </span></a>
                            </div>
                            <?php }?>
					  </div>
				  </div>
                  <?php } } }?>
                  