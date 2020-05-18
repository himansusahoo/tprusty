<?php ini_set('memory_limit', '-1'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content = "width = device-width, initial-scale =1.0, user-scalable = no">
		<meta name="Description" content="<?php //echo @$data->meta_desc ;?>">
        <meta name="Keywords" content="<?php //echo @$data->meta_keywords ;?>" />
        
		<title><?php
			//if($page_title->meta_title!='')
//		 	{
//				echo @$page_title->meta_title ;
//		
//     		}else
//            {
//            		$curpricequery=$this->db->query("SELECT name, current_price FROM cornjob_productsearch WHERE sku='$data_sku' ");
//					$rw_curprice=$curpricequery->row();
//					echo "Buy Online ".$rw_curprice->name.'@Rs.'.number_format($rw_curprice->current_price, 0, ".", ",");
//           	}
       		 ?></title>
             
		<?php include "header.php" ;
        date_default_timezone_set('Asia/Calcutta');
        if($this->session->userdata('addtocarttemp_session_id')==""){
        $dtm = str_replace(" ","-",date('Y-m-d H:i:s'));
        $addtocarttemp_session_id=random_string('alnum', 16).$dtm;
        $this->session->set_userdata('addtocarttemp_session_id',$addtocarttemp_session_id);
        
        $data= array();
        $this->session->set_userdata('addtocarttemp',$data);
        $arr_sku=array();
        $this->session->set_userdata('addtocart_sku',$arr_sku);
        }
        ?>

<!------ Start Content ------>

<script>
function selesct_prodas_size(prod_nm,prod_id,prod_sku)
{
	window.location.href="<?php echo base_url().'product_description/product_detail/';?>" + prod_nm + '/' + prod_id + '/' + prod_sku;	
}

</script>      
<div class="main-content">

<div class="single_top">
	 <div class="container"> 
        <div class="single_grid">
		  <div class="grid images_3_of_2">
                  
    <div class="simpleLens-gallery-container" id="demo-1">
    <?php $rec=explode(',',$product_data->imag);  ?>
        <div class="simpleLens-container">
            <div class="simpleLens-big-image-container">
                <a class="simpleLens-lens-image" data-lens-image="<?php echo base_url().'images/product_img/'.$rec[0]; ?>">
                    <img class="simpleLens-big-image" src="<?php echo base_url().'images/product_img/'.$rec[0]; ?>" style="height:auto !important;" >
                </a>
            </div>
        </div>   
        
         <div class="thmb-slider">
         <div>
<?php $rec=explode(',',$product_data->imag);  foreach($rec as $val){ ?>
 <div class="simpleLens-thumbnails-container">
            <a href="#" class="simpleLens-thumbnail-wrapper"
               data-lens-image="<?php echo base_url().'images/product_img/'.$val; ?>"
               data-big-image="<?php echo base_url().'images/product_img/'.$val; ?>">
                <img src="<?php echo base_url().'images/product_img/'.$val; ?>">
            </a>
   
     </div>  
     <?php } ?>     
        </div>


</div>

    </div>
  
 <div class="clearfix"></div>		
		  </div> 
  
  
  

<div class="desc1 span_3_of_2">

<?php $query=$this->db->query("select * from product_general_info where product_id='$product_data->product_id'");
						$recd1=$query->row();
					?>
				  	
					<h1 class="single_prdct_title"> <?php echo $recd1->name; ?> </h1>
                    
                    <div class="rate_review">   
                      <?php
					$number_review = $review_result->num_rows();
					if($number_review != 0){
						$rating = array();
						foreach($review_result->result() as $val){
							$rating[] = $val->rating;
						}
						$total_sum_of_rating = array_sum($rating);
						$average_rating = ceil($total_sum_of_rating / $number_review) ;
					}else{
						$average_rating = 0;
					}
					?>
                       <div class="stars">
                        <select id="backing4c" name="product_rating" disabled>
                            <option value="1" <?php if($average_rating == 1){ echo 'selected' ;} ?>>Bad</option>
                            <option value="2" <?php if($average_rating == 2){ echo 'selected' ;} ?>>OK</option>
                            <option value="3" <?php if($average_rating == 3){ echo 'selected' ;} ?>>Great</option>
                            <option value="4" <?php if($average_rating == 4){ echo 'selected' ;} ?>>Excellent</option>
                            <option value="5" <?php if($average_rating == 5){ echo 'selected' ;} ?>>Excellent1</option>
                        </select>
      <div class="rateit" data-rateit-backingfld="#backing4c" data-rateit-min="0"></div> </div>
             <div class="single-prdct-rvw"> | &nbsp; &nbsp; <?= $number_review ;?> reviews </div>
            <div class="clearfix"> </div>
                    
                    </div>
                    
                    <div class="prdct-desc">
                    <?php  
					$query=$this->db->query("select * from product_master where sku='$data_sku' ");
					$recd=$query->row();
					$cdate = date('Y-m-d');
					$special_price_from_dt = $recd->special_pric_from_dt;
					$special_price_to_dt = $recd->special_pric_to_dt;
					?>
                   <!--<div class="item-no">Item Number - <span> <?php //echo $recd->sku; ?> </span>-->
                   </div>
                   
                    <div class="price_single">
                     <div class="col-md-8">
                     <div class="prc">
                  
                    <!---Special price exists condition start here --->
                    <?php
					if($recd->special_price !=0){
						if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
					?>
                     	<span class="regular-price"> MRP - Rs. <span id="mrp_spn"><?=ceil($recd->mrp); ?></span> </span> <br>
                        
                        <?php if($recd->price != 0){?>
        				<strike style="color:#6bb700;"><span class="price2"> Sell Price - Rs. <?=ceil($recd->price); ?> </span></strike> <br>
       		 			<?php }?>
                        <div class="clearfix"></div>
                    	<!--<span class="price2"> Sell Price - Rs. <?php //ceil($recd->price); ?></span> <br>-->
                     	<span class="price-orange"> Special Price - Rs. <span id="finl_spn"><?=ceil($recd->special_price); ?></span> </span>
                        <!---Special price exists condition end here --->
        			<?php }else{ ?>
						
						<?php if($recd->price != 0){?>
                        <span class="regular-price"> MRP - Rs. <span id="mrp_spn"><?=ceil($recd->mrp); ?></span> </span> <br>
                        <span class="price2"> Sell Price - Rs. <span id="finl_spn"><?=ceil($recd->price); ?></span> </span> <br>
                        <?php }else{?>
                        <div class="clearfix"></div>
                        <span class="price-orange"> MRP - Rs. <span id="mrp_spn"><?=ceil($recd->mrp); ?></span> </span> &nbsp;&nbsp;
                        <?php }?>
        
        			<?php } //End of date condition ?>

                    <?php }else{ ?>
        
						<?php if($recd->price != 0){?>
                        <span class="regular-price"> MRP - Rs. <span id="mrp_spn"><?=ceil($recd->mrp); ?></span> </span> <br>
                       <span class="price2"> Sell Price - Rs. <span id="finl_spn"><?=ceil($recd->price); ?></span> </span> <br>
                        <?php }else{?>
                        <div class="clearfix"></div>
                        <span class="price-orange"> MRP - Rs. <span id="mrp_spn"><?=ceil($recd->mrp); ?></span> </span> <br>
                        <?php }?>
		
        			<?php } ?>
                    
                    <?php
					
					?>
                    
                    <!-- Shiping fee -->
                    
                     <?php $query=$this->db->query("select a.business_name,a.seller_id,b.shipping_fee_amount from seller_account_information a inner join product_master b on a.seller_id=b.seller_id where b.product_id='$product_data->product_id' and b.sku='$data_sku'");
					 $ct=$query->num_rows();
					 $rew=$query->row();
					?> 
                    
                    
                    <?php if($rew->shipping_fee_amount == 0){?>
                        <div class="shipng_spn">(Shipping charges free) &nbsp;</div>
                        <?php }else{?>
                    	<div class="shipng_spn">Shipping fee &nbsp;Rs.&nbsp; <?= $rew->shipping_fee_amount; ?></div>
                        <?php } ?>
                    

                     <?php $query=$this->db->query("select a.business_name,a.seller_id,b.quantity,b.stock_availability,a.display_name,b.max_qty_allowed_in_shopng_cart from seller_account_information a inner join product_master b on a.seller_id=b.seller_id where b.product_id='$product_data->product_id' and b.sku='$data_sku'"); 
					 $ct=$query->num_rows();
					 $rew=$query->row();
					 
					 $max_quantity=$rew->max_qty_allowed_in_shopng_cart;
					 
					 if($rew->quantity==0);
					{
					
					?> 
                   <?php 
					}
				   ?>
                         
                         </div>
                         
                      <span id="discount_spn"></span>
                      <div class="clearfix"></div>
                         </div>
                        
                         <div class="col-md-4">
                   <div class="sold-by">
                   
                    Sold by -
                    
                    <a href="<?php echo base_url() ;?>sellers/<?= base64_encode($this->encrypt->encode($rew->seller_id));?>" id="goslr" style="cursor:pointer !important;" target="_blank"> <?php if($ct!=0){echo " ". $rew->business_name;}else {echo " moonboy";} ?></a>
                 
                  <div class="badges"> 
					<?php
					if($seller_badge)
					
					{
						$badge_string = $seller_badge[0]->seller_badge_type;
						$badge_array = explode(',', $badge_string);
						
						if(in_array('Moonboy Fulfilled', $badge_array)){
					?>
                    <img src="<?php echo base_url()?>images/moon-fulfilled.png"  alt="" width="120" height="">
					<?php 
						}
						if(in_array('Fast Shipping', $badge_array)){
					?>
					<img src="<?php echo base_url()?>images/fast-delivery.png"  alt="" width="120" height="">								
					<?php
						}
						if(in_array('Star Seller', $badge_array)){
						?>
							<img src="<?php echo base_url()?>images/star-seller.png"  alt="" width="120" height="">								
					<?php	
						}
					}
					?>
					
                    </div>
                 		
					 </div>  
                 
          			<?php $qr1 = $this->db->query("SELECT c.dispatch_days
												FROM seller_account a
												INNER JOIN state b ON a.seller_state = b.state
												INNER JOIN dispatched_day_setting c ON b.state_id = c.state_id
												WHERE a.seller_id ='$rew->seller_id'");
					$ct1 = $qr1->num_rows();
					 $res = $qr1->row();
					 if($ct1 > 0){
					?>       
                     <p> Delivered By : <?php echo $res->dispatch_days+4;?> - <?php echo $res->dispatch_days+5;?> Days </p>
                     <?php  }else{  ?>
                     <p> Delivered By : 10-12 Days </p>
                     <?php } ?>
                     </div>
                                      
                     <div class="clearfix"> </div>
                     <div class="single-add-to">
                  <ul class="add-to">
                  
                  	<li>
                    
                    
        <?php if($this->session->userdata('session_data')){ ?>            
            	<span class="link-wishlist wish_spn" onClick="addWishlistFunction(<?=$product_data->product_id; ?>,'<?=$data_sku; ?>')"><i class="fa fa-heart"></i>Add to wishlist &nbsp;&nbsp;</span>
            <?php }else{ ?>
            	<a class="link-wishlist inline" href="#inline_content"><i class="fa fa-heart"></i>Add to wishlist &nbsp;&nbsp;</a>
                &nbsp;&nbsp;</span>
            <?php } ?>
    		
            <span id="ajxtst"></span>

                  </li>                  
                                      
                  </ul>
                   <div class="clearfix"></div>
                	<div class="dropdown_top">
                    <!---Program start for select size of product --->
                  
                      
                       <?php 
					   
					      
						  
						  //$prodnm_arr=array();
						 // $prodid_arr=array();
						 // $prodsku_arr=array();
						  
						
						  
						  //$prodid_othersellers=$other_seller_productid->result_array();
//						  foreach($prodid_othersellers as $resid_othreseller)
//								{   
//									  $prodnm_arr[]=preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($resid_othreseller['name']))));
//									  $prodid_arr[]=$resid_othreseller['product_id'];
//									  $prodsku_arr[]=$resid_othreseller['sku'];						  
//								}
						  ?>
                          
                          <?php 
						   
						$query_curclolr=$this->db->query("SELECT color, size,lvl2,Capacity,RAM,ROM FROM cornjob_productsearch WHERE sku='$data_sku' group by sku ");
						
						$curnt_color=$query_curclolr->row()->color;
						$curnt_size=$query_curclolr->row()->size;
						$cur_capacity=$query_curclolr->row()->Capacity;
						$cur_ram=$query_curclolr->row()->RAM;
						$cur_rom=$query_curclolr->row()->ROM;					
						$cur_lvl2=$query_curclolr->row()->lvl2;
						
						//if($attribute_color != false){							
							
							
							//******************************Recocde of color  start*****************************							
								
							if($curnt_color!=''){
							 	$cur_productid=$recd->product_id;
								
								$prodname_wisecolr=$recd1->name;
								
								$query_extngskugrp=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' group by color ");
								
								//$query_extngskugrp=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE lvl2='$cur_lvl2' group by color ");
								
								$rw_extngskugrp=$query_extngskugrp->result_array();
								?>
                                 <ul class="color_list">
                        <h4> Color : </h4>
                                <?php 
								foreach($rw_extngskugrp as $res_extngsku)
								{
									
									 $sku_ext=$res_extngsku['sku'];
									
									$query_extngsku=$this->db->query("SELECT * FROM cornjob_productsearch WHERE sku='$sku_ext' group by sku ");
									$rw_extngsku=$query_extngsku->result();
									$prod_nm=preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw_extngsku[0]->name))));
									if($rw_extngsku[0]->color!='')
									{
										
									  ?>
                                      
										 <li> <?php if($rw_extngsku[0]->quantity<=0 || $rw_extngsku[0]->quantity=='' ){  ?><div class="not-available"> </div><?php } ?>
                            <label  class="color"> 
                            <input type='radio' id='attr_colr' name='attr_colr'  value='<?php echo $rw_extngsku[0]->color; ?>' <?php if($curnt_color==$rw_extngsku[0]->color){echo "checked='checked'";} ?>  onClick="window.location.href='<?php echo base_url().'product_description/product_detail/'.$prod_nm.'/'.$rw_extngsku[0]->product_id.'/'.$rw_extngsku[0]->sku; ?>'" />	<span> <i style="background-color:<?php if($rw_extngsku[0]->color!='Multicolor'){ echo $rw_extngsku[0]->color;}?>;" <?php if($rw_extngsku[0]->color=='Multicolor'){ echo "class='multicolor'";}?> title="<?=$rw_extngsku[0]->color;?>" > </i> </span> 	 
                            </label>
                            </li>
										
							<?php				
									}	
								}
								?>
							</ul>	
						<?php	} // if color not blank condition end
							 
							//**********************************Recocde of color  end***************************************
							?>
							
                     <?php //}?>
						 <!--<div class="clearfix"></div>-->
                          
                          
					 <?php  //if($attribute_size != false){
						 
						 if($curnt_size!=''){
						 
					
							 	$cur_productid=$recd->product_id;
							
								$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' group by size ");
								
								//$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE lvl2='$cur_lvl2' group by size  ");
								
								$rw_extngsku=$query_extngsku->result_array();
								?>
                                 <ul class="size_list">
                        <h4> Size: </h4>
                                <?php
								foreach($rw_extngsku as $res_extngsku)
								{
									
									$sku_ext=$res_extngsku['sku'];
									
									$query_extngsku=$this->db->query("SELECT * FROM cornjob_productsearch WHERE sku='$sku_ext' group by sku ");
									$rw_extngsku=$query_extngsku->result();
									$prod_nm=preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw_extngsku[0]->name))));
									if($rw_extngsku[0]->size!='')
									{
									  ?>
										 
                            
                             <li> <?php if($rw_extngsku[0]->quantity<=0 || $rw_extngsku[0]->quantity==''){  ?><div class="not-available"> </div><?php } ?> 
                             <label  class="size">  
                            <input type='radio' id='attr_size' name='attr_size'  value='<?php echo $rw_extngsku[0]->size; ?>' <?php if($rw_extngsku[0]->size==$curnt_size){echo "checked='checked'";} ?>  onClick="window.location.href='<?php echo base_url().'product_description/product_detail/'.$prod_nm.'/'.@$rw_extngsku[0]->product_id.'/'.$rw_extngsku[0]->sku; ?>'" />	<span class="size-box"><?=$rw_extngsku[0]->size;?></span>	</label> </li> 
										
							<?php				
									}	
								}
								?>
                                
                                </ul>
                                <?php
					 } //condtion check for if size value is blank end
						 
						 //}?>
                    
                    <!---Program end of select size of product --->
                    
                    <!---------------------Program for capacity attribute start---------------->
                    
                    
                    	<?php  //if($attribute_capacity != false){
														
							 if($cur_capacity!=''){
						 
					
							 	$cur_productid=$recd->product_id;
							
								$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' group by sku ");
								
								//$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE lvl2='$cur_lvl2' group by size  ");
								
								$rw_extngsku=$query_extngsku->result_array();
								?>
                                 <ul class="size_list">
                        <h4> Capacity: </h4>
                                <?php
								foreach($rw_extngsku as $res_extngsku)
								{
									
									$sku_ext=$res_extngsku['sku'];
									
									$query_extngsku=$this->db->query("SELECT * FROM cornjob_productsearch WHERE sku='$sku_ext' group by sku ");
									$rw_extngsku=$query_extngsku->result();
									$prod_nm=preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw_extngsku[0]->name))));
									if($rw_extngsku[0]->Capacity!='')
									{
									  ?>
										 
                            
                             <li> 
                             <?php if($rw_extngsku[0]->quantity<=0 || $rw_extngsku[0]->quantity==''){  ?><div class="not-available"> </div><?php } ?>
                             <label  class="size">  
                            <input type='radio' id='attr_capcity' name='attr_capcity'  value='<?php echo $rw_extngsku[0]->Capacity; ?>' <?php if($rw_extngsku[0]->Capacity==$cur_capacity){echo "checked='checked'";} ?>  onClick="window.location.href='<?php echo base_url().'product_description/product_detail/'.$prod_nm.'/'.@$rw_extngsku[0]->product_id.'/'.$rw_extngsku[0]->sku; ?>'" />	<span class="size-box"><?=$rw_extngsku[0]->Capacity;?></span>	</label> </li> 
										
							<?php				
									}	
								}
								?>
                                
                                </ul>
                                <?php 
							 } // if currcpapacity not blank
								//} ?>
                    
                     <!---------------------Program for capacity attribute end---------------->
                     
                     
                     <!---------------------Program for RAM attribute start---------------->
                    
                    
                    	<?php 
						 //if($attribute_ram != false){
							
							
							if($cur_ram!=''){
						 
					
							 	$cur_productid=$recd->product_id;
							
								$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' group by sku ");
								
								//$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE lvl2='$cur_lvl2' group by size  ");
								
								$rw_extngsku=$query_extngsku->result_array();
								?>
                                 <ul class="size_list">
                        <h4> RAM: </h4>
                                <?php
								foreach($rw_extngsku as $res_extngsku)
								{
									
									$sku_ext=$res_extngsku['sku'];
									
									$query_extngsku=$this->db->query("SELECT * FROM cornjob_productsearch WHERE sku='$sku_ext' group by sku ");
									$rw_extngsku=$query_extngsku->result();
									$prod_nm=preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw_extngsku[0]->name))));
									if($rw_extngsku[0]->RAM!='')
									{
									  ?>
										 
                            
                             <li> <?php if($rw_extngsku[0]->quantity<=0 || $rw_extngsku[0]->quantity==''){  ?><div class="not-available"> </div><?php } ?> 
                             <label  class="size">  
                            <input type='radio' id='attr_ram' name='attr_ram'  value='<?php echo $rw_extngsku[0]->RAM; ?>' <?php if($rw_extngsku[0]->RAM==$cur_ram){echo "checked='checked'";} ?>  onClick="window.location.href='<?php echo base_url().'product_description/product_detail/'.$prod_nm.'/'.@$rw_extngsku[0]->product_id.'/'.$rw_extngsku[0]->sku; ?>'" />	<span class="size-box"><?=$rw_extngsku[0]->RAM;?></span>	</label> </li> 
										
							<?php				
									}	
								}
								?>
                                
                                </ul>
                                <?php 
							 } // if currcpapacity not blank
							
							//}
							?>
                    
                     <!---------------------Program for RAM attribute end---------------->
                     
                     
                        
                     <!---------------------Program for ROM attribute start---------------->
                    
                    
                    	<?php  //if($attribute_rom != false){
							
							if($cur_rom!=''){
						 
					
							 	$cur_productid=$recd->product_id;
							
								$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE product_id='$cur_productid' group by sku ");
								
								//$query_extngsku=$this->db->query("SELECT sku FROM cornjob_productsearch WHERE lvl2='$cur_lvl2' group by size  ");
								
								$rw_extngsku=$query_extngsku->result_array();
								?>
                                 <ul class="size_list">
                        <h4> ROM: </h4>
                                <?php
								foreach($rw_extngsku as $res_extngsku)
								{
									
									$sku_ext=$res_extngsku['sku'];
									
									$query_extngsku=$this->db->query("SELECT * FROM cornjob_productsearch WHERE sku='$sku_ext' group by sku ");
									$rw_extngsku=$query_extngsku->result();
									$prod_nm=preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw_extngsku[0]->name))));
									if($rw_extngsku[0]->ROM!='')
									{
									  ?>
										 
                            
                             <li> <?php if($rw_extngsku[0]->quantity<=0 || $rw_extngsku[0]->quantity==''){  ?><div class="not-available"> </div><?php } ?> 
                             <label  class="size">  
                            <input type='radio' id='attr_rom' name='attr_rom'  value='<?php echo $rw_extngsku[0]->ROM; ?>' <?php if($rw_extngsku[0]->ROM==$cur_rom){echo "checked='checked'";} ?>  onClick="window.location.href='<?php echo base_url().'product_description/product_detail/'.$prod_nm.'/'.@$rw_extngsku[0]->product_id.'/'.$rw_extngsku[0]->sku; ?>'" />	<span class="size-box"><?=$rw_extngsku[0]->ROM;?></span>	</label> </li> 
										
							<?php				
									}	
								}
								?>
                                
                                </ul>
                                <?php 
							 } // if currcpapacity not blank
							
							
							//}?>
                    
                     <!---------------------Program for ROM attribute end---------------->
                     
                        <!---Program start for select color of product --->
                      
                       <!-- <ul class="color_list">
                       <h4> Color: </h4>
							<li> <label  class="color"> <input type="radio" name="color" checked> <span> <i class="color1"> </i> </span> </label> </li>
							<li> <label  class="color"> <input type="radio" name="color"> <span> <i class="color2"> </i> </span> </label> </li>
						
						</ul>
                        
                        <ul class="size_list">
                        <h4> Size: </h4>
							<li> <label  class="size"> <input type="radio" name="size"> <span class="size-box"> S </span> </label> </li>
							<li> <label  class="size"> <input type="radio" name="size" checked> <span class="size-box"> M </span> </label> </li>
							
						</ul>
                            
                         <ul class="size_list">
                        <h4> RAM: </h4>
							<li> <label  class="ram"> <input type="radio" name="ram"> <span class="size-box"> 1 GB </span> </label> </li>
							<li> <label  class="ram"> <input type="radio" name="ram"> <span class="size-box"> 2 GB </span> </label> </li>
							<li> <label  class="ram"> <input type="radio" name="ram" checked> <span class="size-box"> 3 GB </span> </label> </li>
							
						</ul>
                        
                         <ul class="size_list">
                        <h4> ROM: </h4>
							
							<li> <label  class="rom"> <input type="radio" name="rom" checked> <span class="size-box"> 4 GB </span> </label> </li>
							<li> <label  class="rom"> <input type="radio" name="rom"> <span class="size-box"> 5 GB</span> </label> </li>
                            
						</ul>
                        
                         <ul class="size_list">
                        <h4> Capacity: </h4>
							<li> <label  class="capacity"> <input type="radio" name="capacity"> <span class="size-box"> 500 GB </span> </label> </li>
							<li> <label  class="capacity"> <input type="radio" name="capacity" checked> <span class="size-box"> 1 TB </span> </label> </li>
                            
						</ul>-->
                        
                         <!---Program start for End color of product --->
                        
                        
                        
			         </div>
                 <div class="clearfix"></div>
                 
                  
                  
                    <?php   
					 if(@$this->session->userdata['session_data']['user_id']!=""){
						 if($rew->quantity==0){
					?>
	        <button type="button" id="1" title="Add to Cart"  class="btn btn-primary disabled" disabled="disabled" >Add to Cart</button>
            
            <button type="button" title="Buy Now" class="btn btn-primary disabled">Buy Now</button> <br/>
            
            <?php } else { ?>
          
         <!-- Condition of vertual quantity not available start here-->
           <?php if($vertual_inventory_data <= 0){?>
           
            <button type="button" title="Add to Cart" id="2" onClick="alert('This product is out of stock.');" class="hvr-sweep-to-right add-to-cart disclr" >Add to Cart</button>
            <button type="button" title="Buy Now" onClick="alert('This product is out of stock.');" class="btn btn-primary add-to-cart disclr">Buy Now</button> <br/>
            <!-- Condition of vertual quantity not available end here-->
            <?php } else{?>
            <!-- Condition of vertual quantity available start here-->
            <button type="button" title="Add to Cart" id="3" onClick="goAddtoCart('<?=preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",str_replace("'", "",strtolower($recd1->name)))));?>','<?=$product_data->product_id;?>','<?=$data_sku;?>')" class="hvr-sweep-to-right add-to-cart" >Add to Cart</button>       
            
            <button type="button" title="Buy Now" class="button btn-buy-big" onClick="goAddtoCartBuyNow('<?=preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace("'", "",str_replace(" ","-",strtolower($recd1->name)))));?>','<?=$product_data->product_id;?>','<?=$data_sku;?>')" >Buy Now</button> <br/>
            
            
            
            <!-- Condition of vertual quantity available end here-->
			<?php } } ?>
            
             <?php } else if($rew->quantity==0){?>
            
            <button type="button" title="Add to Cart" id="4"  class="btn btn-primary disabled" disabled="disabled" >Add to Cart</button>
            
            <button type="button" title="Buy Now" class="btn btn-primary disabled">Buy Now</button> <br/>
             <?php } else { ?>
             
             <!-- Condition of vertual quantity not available start here-->
           <?php if($vertual_inventory_data <= 0){?>
           
           <button type="button" title="Add to Cart" id="5" onClick="alert('This product is out of stock.');" class="hvr-sweep-to-right add-to-cart disclr">Add to Cart</button>
           <button type="button" title="Buy Now" onClick="alert('This product is out of stock.');" class="btn btn-primary add-to-cart disclr">Buy Now</button> <br/>
           <!-- Condition of vertual quantity not available end here-->
           
           <?php }else{ ?>
           <!-- Condition of vertual quantity available start here-->
             <button type="button" title="Add to Cart" id="6" onClick="window.location.href='<?php echo base_url().'product_description/addtocart_temp/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace("'", "",str_replace(" ","-",strtolower($recd1->name))))).'/'.$product_data->product_id.'/'.$data_sku ?>' " class="hvr-sweep-to-right add-to-cart" >Add to Cart</button>

           <?php /*?><button type="button" title="Buy Now" onClick="StoreInSession('<?=$product_data->product_id;?>','<?=$data_sku;?>','<?=preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",str_replace("'", "",strtolower($recd1->name)))));?>')" class="button btn-buy-big by_btn">Buy Now</button> <br/>
<?php */?>           

			            <a class='inline button btn-buy-big by_btn' href="#inline_content">Log In To Buy Now</a>
            <br/>           
           <!-- Condition of vertual quantity available end here-->
            <?php } }?>
                    
                
                    </div>
                    
                    </div>
                    

                   <div class="clearfix"> &nbsp; </div>
                   
                   <div class="col-md-8 payment-mode">
                <ul>
                <li> <span> COD </span> Cash on Delivery </li>
                 <li> <span> EMI </span> EMI On Rs 3400+ <a href="#"> <i class="fa fa-question-circle" style="color:#ccc; padding-left:15px;"> </i> </a> </li>
                 <li> <i class="fa fa-exchange"></i> 100% Replacement Guarantee. </li>
                </ul>
                <div class="clearfix"> </div>
                 <div class="social-share">
                 <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <div class="addthis_native_toolbox"></div>
                  </div>
                </div>

                <div class="col-md-4 seller_desc">
                    
          <div class="trust-pay"> <a href="#"><img src="<?php echo base_url()?>images/secure-pay-2.png"> SecurePay  <i class="fa fa-question-circle"> </i></a> </div>
          <div class="sell-product"> <a  href="<?php echo base_url();?>seller/seller" target="_blank"> <i class="fa fa-shopping-basket"></i> SELL THIS PRODUCT </li> </a> </div>
               </div>
               
                    <div class="clearfix"></div>
                   
                 
                   
                   <div class="line2">&nbsp;</div>
					<div class="col-md-4 item-no">
                    <ul class="shtr-desc">
					<?php if($recd1->short_desc){
						$data = $recd1->short_desc;
						
					$short_desc = unserialize($data);
						foreach($short_desc as $value){
							if($value != ''){
						?>
							<li><?=$value?></li>
						<?php
							}
						}
					}
					?>
					</ul>
					</div>
					
				  		

				     <div class="col-md-8 check-availablety">  
                       <h4 class="title-sml"> Check Availability </h4>
                        <input type="text" placeholder="Enter Your Pincode" name="pin" id="pin" class="pncd">
                        <button type="button" class="btn1 btn-primary1 hvr-sweep-to-right" onClick="valid_pin()" style="cursor:pointer;"> <span >Check </span></button>
                       <div id="valid_msg1" style="font-weight:bold; color:red;" ></div>
                       <div id="pin-msg" style="display:none; font-weight:bold; color:#093;"> Product is available at your location. </div>
                       </div>
                             
            <div class="clearfix"></div>
              
                </div>
          	    <div class="clearfix"></div>
          	   </div>
  
               
               <!-- product features end -->
               <div class="clearfix"></div>
               
               
               <!-- related Products -->
                
               
               				<?php
							foreach($related_prod as $rw1){
								$related_id=$rw1->related_product_id;
								if($related_id!=""){
								 $arr=unserialize(substr($related_id,0));
								 $descp = array_diff($arr, array($this->uri->segment(4)));
					             $desc1=implode(',',$descp);
								
								$count=count($descp);
								
								$imagearr=explode(',',$rw1->imag);?>
        <div class="related-product">
                <h3 class="m_2"> Related Products </h3>
	                 <div class="container">
          		   
                             <?php
                           
							$query = $this->db->query("select b.price,b.special_price,b.product_id,b.sku,b.mrp,b.special_pric_from_dt,b.special_pric_to_dt,c.name,d.imag,d.catelog_img_url from product_master b inner join product_general_info c on b.product_id=c.product_id inner join product_image d on c.product_id=d.product_id where b.product_id in ($desc1) and b.status='Enabled' group by b.product_id limit 5");
							$rows=$query->result();
							foreach($rows as $rw2){
								
								$imagearr=explode(',',$rw2->catelog_img_url);
							?>
               
                        <div class="grid1_of_5">
          				<div class="content_box">
                         <div class="view view-fifth">
                        <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($rw2->name)))).'/'.$rw2->product_id.'/'.$rw2->sku  ?>" ><img src="<?php echo base_url().'images/product_img/'.$imagearr[0]; ?>" class="img-responsive"></a>
			   	        
				   	   </a> </div>
				  
				    <h2 class="prdt_title"><a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($rw2->name)))).'/'.$rw2->product_id.'/'.$rw2->sku  ?>" ><?php echo $rw2->name;?></a></h2>
				    <p><?php
		if($rw1->special_price !=0){
			if($cdate >= $rw2->special_pric_from_dt && $cdate <= $rw2->special_pric_to_dt){
		?>
        
		<span class="regular-price"> Rs. <?=ceil($rw2->mrp); ?> </span> &nbsp;&nbsp;
        
        <?php if($rw2->price != 0){?>
        <span class="regular-price"> Rs. <?=ceil($rw2->price); ?> </span> &nbsp;&nbsp;
        <?php }?>
        
        <span class="price"> Rs. <?=ceil($rw2->special_price); ?> </span>
        <!---Special price exists condition end here --->
		<?php }else{ ?>
		
        <?php if($rw2->price != 0){?>
        <span class="regular-price"> Rs. <?=ceil($rw2->mrp); ?> </span> &nbsp;&nbsp;
        <span class="price"> Rs. <?=ceil($rw2->price); ?> </span> &nbsp;&nbsp;
        <?php }else{?>
        <span class="price"> Rs. <?=ceil($rw2->mrp); ?> </span> &nbsp;&nbsp;
        <?php }?>
        
        <?php } //End of date condition ?>
        
        <?php }else{ ?>
        
		<?php if($rw2->price != 0){?>
        <span class="regular-price"> Rs. <?=ceil($rw2->mrp); ?> </span> &nbsp;&nbsp;
        <span class="price"> Rs. <?=ceil($rw2->price); ?> </span> &nbsp;&nbsp;
        <?php }else{?>
        <span class="price"> Rs. <?=ceil($rw2->mrp); ?> </span> &nbsp;&nbsp;
        <?php }?>
		
        <?php } ?> </p>
			        </div>   
                        </div>
					<?php }?>  
                    
                      <div class="clearfix"> </div> 
          		    
          	</div> 
        </div><?php }else if($related_id==""){  ?>
                    <?php }} ?>
          		
			     

  
  <div class="clearfix">  </div>  
    <!-- related Products --> 
               
               <!---- same product other seller start ----->
               <div id="other_product_dv">
               <?php
			   $other_seller_product_row = $other_seller_product->num_rows();
			   if($other_seller_product_row > 0){
				   
						foreach($other_seller_product->result() as $other_slr_product){ 
			   ?><?php } ?>
               		<h3>Sold by other <span class="no_slr_spn"><?=$other_seller_product_row; ?></span> <?php if($other_seller_product_row == 1){ echo 'Seller';}else{ echo 'Sellers';} ?></h3>
                    <table class="table-striped table-hover othr_slr_prdt_tble" width="100%">
                    	<tr>
                        	<th width="25%">SELLERS</th>
                            <th width="10%">RATING</th>
                            <th width="25%">DELIVERED BY</th>
                            <th width="10%">OFFERS</th>
                            <th width="10%">PRICE</th>
                            <th width="20%"><?php echo $other_slr_product->stock_availability; ?></th>
                        </tr>
                        <?php 
						foreach($other_seller_product->result() as $other_slr_product){ 
							$cdate = date('Y-m-d');
							$special_price_from_dt = $other_slr_product->special_pric_from_dt;
							$special_price_to_dt = $other_slr_product->special_pric_to_dt;
							
							
							$quantity=$other_slr_product->quantity;
							$max_quantity=$other_slr_product->max_qty_allowed_in_shopng_cart;
							$stock=$other_slr_product->stock_availability;
						?>
						<tr>
                        	<td><a href="<?php echo base_url() ;?>sellers/<?= base64_encode($this->encrypt->encode($other_slr_product->seller_id));?>" id="goslr" style="cursor:pointer !important;" target="_blank"><?=$other_slr_product->business_name; ?></a></td>
                            <td>
                            <?php
							if($seller_rating_result != false){
								foreach($seller_rating_result as $k => $v){
									if($k == $other_slr_product->seller_id){
										echo $v.' / 5';
									}
								}
							}else{
								echo ' ';
							}
							?>
                            </td>
                            <td>
								<?php
								$qr1 = $this->db->query("SELECT c.dispatch_days
												FROM seller_account a
												INNER JOIN state b ON a.seller_state = b.state
												INNER JOIN dispatched_day_setting c ON b.state_id = c.state_id
												WHERE a.seller_id ='$other_slr_product->seller_id'");
								$ct1 = $qr1->num_rows();
					 			$res = $qr1->row();
								if($ct1 > 0){
								?>
                                Delivered By : <?php echo $res->dispatch_days+4;?> - <?php echo $res->dispatch_days+5;?> Days 
                                <?php  }else{  ?>
                                 Delivered By : 10-12 Days 
                                 <?php } ?>
								,
                                <?php 
                             
								if($other_slr_product->shipping_fee_amount == 0){
									echo ' Free';
								}else{
									echo ' Rs. '.$other_slr_product->shipping_fee_amount;
								}
								?>
                            </td>
                            <td>
                            <?php
                            if($other_slr_product->special_price !=0){ 
								if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
        					?>
                            
                            Rs. <?=ceil($other_slr_product->special_price); ?>
                            
                            <?php } } ?>
                            </td>
                            <td>Rs. <?=ceil($other_slr_product->price); ?></td>
                            <td>
                            
                            <?php   if(@$this->session->userdata['session_data']['user_id']!=""){
								 if($quantity==0){
						 
						  ?>
                          
	        <button type="button" title="Add to Cart"  class="btn btn-primary disabled" disabled="disabled" >Add to Cart</button> 
            <button type="button" title="Buy Now" class="btn btn-primary disabled" >Buy Now</button>
            <?php } else { ?>
            <button type="button" title="Add to Cart" onClick="window.location.href='<?php echo base_url().'product_description/addtocart/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace("'", "",str_replace(" ","-",strtolower($other_slr_product->name))))).'/'.$other_slr_product->product_id.'/'.$other_slr_product->sku; ?>' " class="button add-to-cart1" >Add to Cart</button>
			<button type="button" title="Buy Now" class="button btn-buy-big1" onClick="window.location.href='<?php echo base_url().'product_description/addtocheckout/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace("'", "",str_replace(" ","-",strtolower($recd1->name))))).'/'.$product_data->product_id.'/'.$other_slr_product->sku ?>' " >Buy Now</button>
			<?php } ?>
            
             <?php } else if($quantity==0){?>
            
            <button type="button" title="Add to Cart" class="btn btn-primary disabled" disabled="disabled" >Add to Cart</button>
            <button type="button" title="Buy Now" class="btn btn-primary disabled" >Buy Now</button>
             <?php } else { ?>
             <button type="button" title="Add to Cart" onClick="window.location.href='<?php echo base_url().'product_description/addtocart_temp/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace("'", "",str_replace(" ","-",strtolower($other_slr_product->name))))).'/'.$other_slr_product->product_id.'/'.$other_slr_product->sku;?>' " class="button add-to-cart1" >Add to Cart</button>
             <button type="button" title="Buy Now" onClick="StoreInSession('<?=$other_slr_product->product_id;?>','<?=$other_slr_product->sku;?>','<?=preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace("'", "",str_replace(" ","-",strtolower($other_slr_product->name)))));?>')" class="button btn-buy-big1"> Buy Now </button>
            <?php } ?>                        
                                                            
                            </td>
                        </tr>
                        
                        <?php } //End of froeach loop ?>
                    </table>
                     <?php }//else{?>
                       <?php /*?><span>This Product is not available in any other seller </span>
                    <?php }?><?php */?>
               </div>
               
               <!---- same product other seller end ----->

               <!-- Key Features -->


   <h3>Short Description <?php //echo $recd1->name; ?></h3>
   <ul> 
		<li><?php echo stripslashes($recd1->description); ?></li>
    	<!--<li> <?php //echo $recd1->short_desc; ?> </li>-->
   </ul>

       

  
  <div class="clearfix">  </div>  
    <!-- related Products -->
    
    <!-- Product Specification -->
     <?php
	$attr_hedng_row = $product_attr_result->num_rows();
	
	if($attr_hedng_row > 0){
		
	?>
    <div class="specification">
						 <h3 class="m_2" > specification </h3>
                            <!--<span class="attr_hd_no"><?//=//$attr_hedng_row;?></span>-->
                            
                            <?php
							$prodattr_skucronj=$data_sku;
									
							$query_attrcronjob=$this->db->query("SELECT * FROM cornjob_productsearch WHERE sku='$prodattr_skucronj' ");
							$rw_attrcronjob=$query_attrcronjob->row();
							
								$r=0;
								foreach($product_attr_result->result() as $product_attr_heading_row){
								$r++;
								$sql = $this->db->query("SELECT product_id FROM product_attribute_value WHERE sku='$product_attr_heading_row->sku'");
								$sku_row = $sql->num_rows();
								
								
								if($sku_row > 0){
								$query = $this->db->query("SELECT a.attribute_field_name, b.attr_value FROM attribute_real a INNER JOIN product_attribute_value b ON a.attribute_id = b.attr_id WHERE a.attribute_heading_id ='$product_attr_heading_row->attribute_heading_id' AND b.product_id='$product_attr_heading_row->product_id' AND b.attr_value IS NOT NULL AND (b.attr_value <>  '')"
							);
							}else{
								
							
							$query = $this->db->query("SELECT a.attribute_field_name, b.attr_value FROM attribute_real a INNER JOIN seller_product_attribute_value b ON a.attribute_id = b.attr_id WHERE a.attribute_heading_id ='$product_attr_heading_row->attribute_heading_id' AND b.sku='$product_attr_heading_row->sku' AND b.attr_value IS NOT NULL AND (b.attr_value <>  '')"
							);
							}
							
							if($query->num_rows()>0)	
								{
							?>
                            <h4 class="qw<?=$r;?>"><strong><?=$product_attr_heading_row->attribute_heading_name;?></strong></h4>
                            <?php
							
							
							
							$result = $query->result();
								foreach($result as $product_attr_row){
							?>
                            <table class="table table-striped attr_tbl">
                                 <tr> 
                                 	<td width="170">									
									<?=$product_attr_row->attribute_field_name; ?> :                   
                                    </td> 
                                 	<td><?php
									if($product_attr_row->attribute_field_name=='Color')
									{echo $rw_attrcronjob->color;}
									if($product_attr_row->attribute_field_name=='Size')
									{echo $rw_attrcronjob->size;}
									if($product_attr_row->attribute_field_name=='Capacity')
									{echo $rw_attrcronjob->capacity;}
									if($product_attr_row->attribute_field_name=='RAM')
									{echo $rw_attrcronjob->RAM;}									
									if($product_attr_row->attribute_field_name=='ROM')
									{echo $rw_attrcronjob->ROM;}
									
									else if($product_attr_row->attribute_field_name != 'Color' && $product_attr_row->attribute_field_name != 'Size' && $product_attr_row->attribute_field_name != 'Capacity' && $product_attr_row->attribute_field_name != 'RAM'  && $product_attr_row->attribute_field_name != 'ROM')
									{ echo $product_attr_row->attr_value; }
									 
									 
									 ?></td> 
                                 </tr> 
                             </table>
                            <?php } }  
							
							} //if sub heading values not available condition end
							
							?>
							
                 		</div>      
                   		 <?php }  //End of if condition ?>
      
           <div class="clearfix"></div>            
                                

    <?php if($number_review > 0){ ?>
    <h3 class="m_2"> Reviews </h3>

<table width="100%" class="table-striped">
	<?php
	$sl=0;
	foreach($review_result->result() as $review_row){ 
	$sl++;
	?>
	<tr>
        <td width="20%">
            <select id="backing<?= $sl; ?>c<?= $sl; ?>" disabled>
                <option value="1" <?php if($review_row->rating == 1){ echo 'selected';} ?>>Bad</option>
                <option value="2" <?php if($review_row->rating == 2){ echo 'selected';} ?>>OK</option>
                <option value="3" <?php if($review_row->rating == 3){ echo 'selected';} ?>>Great</option>
                <option value="4" <?php if($review_row->rating == 4){ echo 'selected';} ?>>Excellent</option>
                <option value="5" <?php if($review_row->rating == 5){ echo 'selected';} ?>>Excellent1</option>
            </select>
            <div class="rateit" data-rateit-backingfld="#backing<?= $sl; ?>c<?= $sl; ?>" data-rateit-min="0"></div>
            
         
        <?php
		$date = $review_row->added_date;
		$dt = new DateTime($date);
		?>
         <h4> <span style="color:#5d9b05;"> <?= $review_row->fname ; ?> </span>   <span class="rev_date"> on <?= $dt->format('Y-m-d'); ?> </span> </h4>
        </td>
        
        <td width="80%"> <h4> <?= $review_row->title ; ?> </h4>
        <p> <?= $review_row->content ; ?> </p></td>
        
    </tr>

    <?php } } //else{?>
   <!-- <tr bgcolor="2">No reviews.</tr>-->
    <?php //} ?>
</table>
                     
	 </div>

 
<?php include "footer.php" ?>

<script type="text/javascript" src="<?php echo base_url();?>js/jquery.simpleGallery.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.simpleLens.js"></script>



<script>
    $(document).ready(function(){
        $('#demo-1 .simpleLens-thumbnails-container img').simpleGallery({
            loading_image: 'demo/images/loading.gif'
        });

        $('#demo-1 .simpleLens-big-image').simpleLens({
            loading_image: 'demo/images/loading.gif'
        });
    });
</script>



<!--Review script start here-->
<link href="<?php echo base_url(); ?>rateit/src/rateit.css" rel="stylesheet" type="text/css">

<script src="<?php echo base_url(); ?>rateit/src/jquery.rateit.js" type="text/javascript"></script>



<script>
$(document).ready(function(){
	var mrp = parseFloat($('#mrp_spn').text());
	var final_price = parseFloat($('#finl_spn').text());
	var percnt = parseFloat((final_price/mrp)*100);
	var discount_percent =  Math.round(100-percnt);
	if(isNaN(discount_percent)){
		$('#discount_spn').hide();
	}else{
		$('#discount_spn').html(discount_percent+'%<br>OFF');
	}
});
</script>

<script>
function addWishlistFunction(product_id,sku){
	
	$.ajax({
		url:'<?php echo base_url(); ?>user/add_wishlist',
		method:'post',
		data:{product_id:product_id,sku:sku},
		success:function(result){
			
			if(result=='success'){
				alert('successfully added');
				window.location.reload(true);
			}
			if(result=='exists'){
				window.location.href='<?php echo base_url(); ?>wish-list';
			}
		}
	});
}
</script>

<script>
$(document).ready(function(){
	var no_of_mor_slr = $('.no_slr_spn').text();
	if(no_of_mor_slr > 0){
		$('.more_seller_spn').text('From - '+no_of_mor_slr+' Other Sellers ');
	}
	if(no_of_mor_slr == 1){
		$('.more_seller_spn').text('From - '+no_of_mor_slr+' Other Seller');
	}
})
</script>


<!--script start for hiding not attribute data headings-->
<script>
$(document).ready(function(){
	$('.attr_hd_no').hide();
	var attr_hd_no = $('.attr_hd_no').text();
	for($i=1; $i<=attr_hd_no; $i++){
		if($('.qw'+$i).next().hasClass("attr_tbl") == false){
			$('.qw'+$i).hide();
		}
	}
});
</script>
<!--script start for hiding not attribute data headings-->

<script>
function goAddtoCart(prdt_name,prdt_id,sku){
	var attr_clr = $('#attr_color').val();
	var attr_size = $('#attr_size').val();
	
	var attr_parm='';
	if(attr_size){
		if(attr_clr){
			attr_parm += '/size='+attr_size.replace(' ','-')+'&'+'color='+attr_clr.replace(' ','-');
		}else{
			attr_parm += '/size='+attr_size.replace(' ','-');
		}
	}else if(attr_clr){
		if(attr_size){
			attr_parm += '/size='+attr_size.replace(' ','-')+'&'+'color='+attr_clr.replace(' ','-');
		}else{
			attr_parm += '/color='+attr_clr.replace(' ','-');
		}
	}
	window.location.href='<?php echo base_url();?>product_description/addtocart/'+prdt_name+'/'+prdt_id+'/'+sku+attr_parm;
}
</script>

<script>
function goAddtoCartBuyNow(prdt_name,prdt_id,sku){
	var attr_clr = $('#attr_color').val();
	var attr_size = $('#attr_size').val();
	
	var attr_parm='';
	if(attr_size){
		if(attr_clr){
			attr_parm += '/size='+attr_size.replace(' ','-')+'&'+'color='+attr_clr.replace(' ','-');
		}else{
			attr_parm += '/size='+attr_size.replace(' ','-');
		}
	}else if(attr_clr){
		if(attr_size){
			attr_parm += '/size='+attr_size.replace(' ','-')+'&'+'color='+attr_clr.replace(' ','-');
		}else{
			attr_parm += '/color='+attr_clr.replace(' ','-');
		}
	}
	window.location.href='<?php echo base_url();?>product_description/addtocart_buynow/'+prdt_name+'/'+prdt_id+'/'+sku+attr_parm;
}
</script>


<script>
function StoreInSession(pid,sku,pname){
	$('.by_btn').css('background-color','#ccc');
	$.ajax({
		url:'<?php echo base_url();?>product_description/set_buynow_session',
		method:'post',
		data:{pid:pid,sku_id:sku,pname:pname},
		success:function(result){
			
			if(result=='success'){
				window.location.href= '?restart';
			}
		}
	});
}

//script for open light box after page reload
$(document).ready(function(){
  if (window.location.search.indexOf('restart') > -1){
  setTimeout(function(){ 
	  $('.inline').trigger('click');
	  }, 500);
  };
});
</script>

      <script type="text/javascript">
         $(".simpleLens-big-image").css("height", "auto");

      </script>


<script>
	function valid_pin(){
		var pin=document.getElementById('pin').value;

		 var email_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		
		 if(pin==""){
			 $('#valid_msg1').show().text('Please enter your Pin Number!');
			return false;
			pin.focus();
			
		}
		else if(isNaN(pin)){
			$('#valid_msg1').show().text('Enter a valid Pin Number');
			return false;
			pin.focus();
			
		}
		else if(pin.length != 6){
			$('#valid_msg1').show().text('Enter a 6-digit Pin Number');
			return false;
			pin.focus();
			
		}
		else if(pin.length == 6){
			$('#pin-msg').show();
			$('#valid_msg1').hide();				
		}
		
	}
	</script>

<style>
.disclr, .disclr:hover, .disclr:focus, .disclr:active{background-color:#ccc; outline:0;}

</style>


<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-57921268b212b919"></script>

</body>

</html>