<?php include 'header.php'; 

$label_name=$this->uri->segment(1);
		$qr_lblid=$this->db->query("SELECT * FROM category_menu_mobile WHERE url_displayname='$label_name'  ");
		if($qr_lblid->num_rows()>0)
		{
			$dskcatgid_id=$qr_lblid->row()->category_id;
		}
		

	$catgstr_urlpass=str_replace(',','-',$dskcatgid_id);
?>


 <link rel="canonical" href="<?php echo base_url().$label_name; ?>"/>
<script>
function ShowMoreData(result_no,cat_id,lastseg){
	var numItems = parseInt($('.col-md-4').length);
	var result_no = parseInt(result_no);
	//alert(lastseg);return false;
	$.ajax({
		url:'<?php echo base_url(); ?>product_description/show_more_catalog_data',
		method:'get',
		data:{from:numItems,cat_id:cat_id,lastseg:lastseg},
		beforeSend: function(){
			$('.view_mor').hide();
			$('#lodr_img').show();
		},
		complete: function(){
			$('#lodr_img').hide();
			$('.view_mor').show();
		},
		success:function(result){
			$('.product-more').append(result);
			if(numItems == result_no){
				$('.view_mor').hide();
				$('#view_more_dv').html('<span>No more product available!</span>');
			}
		}
	});
}

function sortby_price(sortbyprice,catgnm,cat_id,lastseg)
{
	window.onload = $('#limg').css('display','block');
	
	if(lastseg == 'NOT'){
		window.location.href='<?php echo base_url();?>filterby/'+catgnm.replace(" ","-")+'/'+cat_id+'/'+'sortbyprice='+sortbyprice;
	}else{
		window.location.href='<?php echo base_url();?>filterby/'+catgnm.replace(" ","-")+'/'+cat_id+'/'+lastseg+'&sortbyprice='+sortbyprice;
	}	
}
</script>   
		<div class="wrap" >
		<!--products-->
       <div class="info-products">
	   
	      <div class="info-inner">
		  
               
               <!-- Filter Panel -->
                <?php include "catalog_menu.php"; ?>  
               <!--Filter Panel -->
        
           
				<div class="section-info">
				<h3 class="tittle">View Products</h3>
                <div class="product-more">
                  <?php if($product_data != false){
		$row=$product_data->num_rows();
		$sl=0;
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
		?>
				  <div class="col-md-4 pro-grid">
				     <div class="box-in">
							<div class="grid_box">	
                             <div class="wishlist"> <a href="#"><i class="fa fa-heart" aria-hidden="true"></i> </a> </div>	
                             
							 <?php /*?><a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>" ><?php */?> 
                             
                             <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>" > 
                             
                             <div class="product-thumb">
                             <?php
							 $file=base_url().'images/product_img/'.$dsply_img; 
							 
							  if(empty($dsply_img)){?>
                             <img src="<?php echo base_url();?>images/product_img/prdct-no-img.png"  alt="<?=$rw->name;?>">
                             <?php }else { ?>
                             <img src="<?php echo base_url();?>images/product_img/<?=$image_arr[0];?>" onerror="imgError(this);"  alt="<?=$rw->name;?>" class="wow fadeInDown">                       
                             <?php } ?>
                             </div>	
                             <h5> <?php if(strlen($rw->name) > 40){ echo substr($rw->name,0,30).'...';}else{ echo $rw->name;}?> </h5>  </a> 
                             
                             <!------------------Price Section Start------------------------------------------->

                                
                                	 <!--- price calculation div start here --->
                                           
                                            <!---Special price exists condition start here --->
                                            
                                            <?php
                                            if($rw->special_price !=0){
                                                if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                                            ?>
                                            
                                            <div class="cut-price"> Rs. <?=ceil($rw->mrp); ?> </div> 
                                            <?php if($rw->price != 0){?>
                                           <div class="reducedfrom"> Rs. <?=ceil($rw->price); ?> </div> 
                                            <?php }?>
                                            
                                            <div class="grid_1"><a href="#" class="cup item_add"><span class="item_price" > Rs. <?=ceil($rw->special_price); ?></span></a> </div>
                                            <!---Special price exists condition end here --->
                                            <?php }else{ ?>
                                            
                                            <?php if($rw->price != 0){?>
                                             <div class="cut-price"> Rs. <?=ceil($rw->mrp); ?> </div>
                                            <div class="grid_1"><a href="#" class="cup item_add"><span class="item_price" > Rs. <?=ceil($rw->price); ?></span></a> </div>
                                            <?php }else{?>
                                            <div class="grid_1"><a href="#" class="cup item_add"><span class="item_price" > Rs. <?=ceil($rw->mrp); ?> </span></a></div>
                                            <?php }?>
                                            
                                            <?php } //End of date condition ?>
                                            
                                            <?php }else{ ?>
                                            
                                            <?php if($rw->price != 0){?>
                                            <div class="cut-price">  Rs. <?=ceil($rw->mrp); ?> </div>
                                            <div class="grid_1"><a href="#" class="cup item_add"><span class="item_price" > Rs. <?=ceil($rw->price); ?></span></a> </div>
                                            <?php }else{?>
                                            <div class="grid_1"><a href="#" class="cup item_add"><span class="item_price" > Rs. <?=ceil($rw->mrp); ?></span></a> </div> 
                                            <?php }?>
                                            
                                            <?php } ?>
                                           
       							 <!--- price calculation div end here --->
                                
                                
                               <!---------------------------Price Section End-------------------------------> 

                              
                              <!--------------------------From Other Seller Start----------------------->
                                                            
                               <?php
										$query= $this->db->query("SELECT product_id FROM product_master WHERE approve_status = 'Active' and product_id='$rw->product_id' and seller_id!=0 GROUP BY product_id, seller_id");
		
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
                            <?php /*?> <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>" ><span> Out Of Stock </span></a><?php */?>
                              <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw->name)))).'/'.$rw->product_id.'/'.$rw->sku  ?>" ><span> Out Of Stock </span></a>
                            </div>
                            <?php }?>
					  </div>
				  </div>
                  <?php } } } else
				  {?>
                   <div>No Record Found</div>
				   <?php } ?>
                   </div>
                    <div id="view_more_dv">
           		<img src="<?php echo base_url();?>images/loader.gif" id="lodr_img" style="display:none;"/>
                <?php if($no_of_product > $sl){ ?>
				<input type="button" class="btn-sign-in"  value="View more" name="button" onClick="ShowMoreData('<?=$no_of_product;?>','<?=$catgstr_urlpass?>','<?php if($this->uri->segment(4) != ''){ echo $this->uri->segment(4);}else{ echo 'NOT';}?>')">
				<?php }	?>
           </div>
               <br>
           <div style="color:#666; font-size:15px; font-family:Tahoma, Geneva, sans-serif; text-align:justify;margin-right:20px!important;">
           <p style="margin-right:10px !important; ">
           		<?php echo stripslashes($single_desc->catg_description);?>
           </p></div>    
				    <div class="clearfix"> </div>
				</div>
		  </div>
	   </div>
  <!--//item-->
		
		</div>
        
   
 <?php include "footer.php"; ?>      