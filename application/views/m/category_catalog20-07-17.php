

<?php include 'header.php'; 


		$label_name=$this->uri->segment(2);
		$qr_lblid=$this->db->query("SELECT * FROM category_menu_mobile WHERE url_displayname='$label_name'  ");
		if($qr_lblid->num_rows()>0)
		{
			$label_id=$qr_lblid->row()->dskmenu_lbl_id;	
		}
		
		

?>
<meta name="Description" content="<?php echo $data1->meta_description;?>"/>
        <meta name="Keywords" content="<?php echo $data1->meta_keywords;?>" />
        
<title><?php echo $data1->page_title ;?></title>
        
 <link rel="canonical" href="<?php echo base_url().'category/'.$this->uri->segment(2); ?>"/>


<script>
//function ShowMoreData(result_no,cat_id,lastseg){
	//alert('test');
	/*var numItems = parseInt($('.col-md-12').length);
	var result_no = parseInt(result_no);
	//alert(lastseg);return false;
	$.ajax({
		url:'<?php //echo base_url(); ?>product_description/show_more_category_catalog_data',
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
			$('.products-row').append(result);
			if(numItems == result_no){
				$('.view_mor').hide();
				$('#view_more_dv').html('<span>No more product available!</span>');
			}
		}
	});*/
//}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-visible/1.2.0/jquery.visible.js"></script>
<script>
var lastScrollTop = 0;
$(window).scroll(function(event){
   var st = $(this).scrollTop();
   if (st > lastScrollTop)
   {   
			 if($('#view_more_dv').visible(true))
			 {
				$('#viewmore_prodbtnid')[0].click(); 
			} 
		
   
   
   } else {
      // upscroll code
   }
   lastScrollTop = st;
   
});


</script>


<script>
function redirectCategoryPage(category_id,sl,cat_name){
	window.location.href='<?php echo base_url();?>product_description/product_addtocart/'+cat_name.replace(" ","-")+'/'+category_id;
}


function imgError(image){
    image.onerror = "";
    image.src = "<?php echo base_url();?>images/product_img/prdct-no-img.png";
    return true;
}


function sortby_price(sortbyprice,catgnm,cat_id,lastseg)
{
	window.onload = $('#limg').css('display','block');
	
	if(lastseg == 'NOT'){
		window.location.href='<?php echo base_url();?>category/'+catgnm.replace(" ","-")+'/'+cat_id+'/'+'sortbyprice='+sortbyprice;
	}else{
		window.location.href='<?php echo base_url();?>category/'+catgnm.replace(" ","-")+'/'+cat_id+'/'+lastseg+'&sortbyprice='+sortbyprice;
	}	
}
</script>   
		<div class="wrap" >
		<!--products-->
       <div class="info-products">
	   
	      <div class="info-inner">
		  
               
               <!-- Filter Panel -->
                <?php include "category_filter_menu.php"; ?>  
               <!--Filter Panel -->
               
        
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
								<?php /*?><li onClick="redirectCategoryPage('<?=$res->category_id;?>',<?=$sl;?>,'<?= $res->label_name; ?>')" style="cursor:pointer;"><?php */?>
                                <li onClick="window.location.href='<?php echo base_url().$res->url_displayname ?>'" style="cursor:pointer;">
								<a href="#"><?php echo $res->label_name; ?></a>
                                </li>
                                <?php } ?>
                                </ul>
							</li>
							
						</ul>
					</div>
               
               <!---------------------------------subcategory list end------------------------------------------------>
				<div class="section-info">
				<h3 class="tittle">View Products</h3>
                
                    <!---------------------------------------Product Catalog start----------------------------->
                    		<div class="products" style="padding:0px;">	 
		<div class="container">
			<div class="col-md-12 product-w3ls-right">			
				<div class="products-row">
                <?php if($product_data != false){
		$row=$product_data->num_rows();
		$sl=0;
		//print_r($row);exit;
		if($row>0){
		foreach($product_data->result_array() as $rw ) { $sl++;
			$cdate = date('Y-m-d');
			$special_price_from_dt = $rw['special_pric_from_dt'];
			$special_price_to_dt = $rw['special_pric_to_dt'];
			
			$dsply_img = $rw['catelog_img_url'];
			$image_arr=explode(',',$rw['catelog_img_url']);
			//$taxdecimal = $rw->tax_rate_percentage/100;
			
			//tax amount for product price
			//$tax_amount = $rw->price*$taxdecimal;
			
			//tax amount for product special price
			//$tax_amount_special = $rw->special_price*$taxdecimal;
			$quantity=$rw['quantity'];
			
		?>
                
                		<div class="col-md-3 product-grids"> 
						<div class="agile-products" style="max-height: 350px; min-height: 250px;">
                         <?php 
							$cur_prodprice=0;
							$cursplprc_foroff=0;
							  if($rw['special_price'] !=0)
							  {
                                       if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt)
									   {$cur_prodprice= $rw['special_price'];
									   	$cursplprc_foroff=$rw['special_price'];
									   }
							  }
							  if($rw['price'] != 0 && $rw['special_price']==0)
							  {$cur_prodprice=$rw['price'];}
							  
							  if($rw['price'] == 0 && $cursplprc_foroff==0) 
							  {
								$cur_prodprice=	$rw['mrp'];	  
							  }
							  
							  $percen_curprc=((100/$rw['mrp'])*$cur_prodprice);
							  
							  $percen_off=100- round($percen_curprc); 
							  
							  $cur_splprc=0;                               		
							 ?>                            
                            <?php if($percen_off>0){ ?> 
							<div class="new-tag">
                            <!--<h6>20%<br>Off</h6>-->                           
                            <h6><?=$percen_off?>%<br>Off</h6>                            
                            </div>
                            <?php } ?>
                            
							
                            <div style="margin:auto; width:100%; text-align:center; ">
                             <?php  if(empty($dsply_img)){?>
                             <a style="margin:auto; text-align:center;" 
                             href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>">
                             <img style="height: 112px; max-width: 100%; margin: auto;text-align: center;" src="<?php echo base_url();?>images/product_img/prdct-no-img.png"  alt="<?=$rw['name'];?>"></a>
                             <?php }else { ?>
                             <a style="margin:auto; text-align:center;" 
                             href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>">
                             <img style="height: 112px;max-width: 100%;margin: auto;text-align: center;" src="<?php echo base_url();?>images/product_img/<?=$image_arr[0];?>" onerror="imgError(this);"  alt="<?=$rw['name'];?>">
                             </a>                       
                             <?php } ?>
                            </div>
							<div class="agile-product-text" >              
								<h5 style="text-align:left; margin-left:0; font-family: 'SegoeUI'; line-height: 16px;"><a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>">
								<?php if(strlen($rw['name']) > 40){ echo substr($rw['name'],0,40).'...';}else{ echo $rw['name'];}?>
                                </a></h5> 
								<!--<h6><del>$200</del> $100</h6>-->
                                
                                 <!-----------------------------------Produc price start---------------------------->
                                
                                	<?php
                                   if($rw['special_price'] !=0){
                                       if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
										   $cur_splprc=$rw['special_price'];
                                		 ?>                               
                                		<span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?> </span>
                                        &nbsp;&nbsp;
                                
                                        <span style="color:#F90;text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['price'];?> </span>&nbsp;&nbsp;
                                        <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($rw['special_price'])?> </span>
                               		<?php }} ?>
                                        
                                        <?php if($rw['price'] != 0 && $cur_splprc==0){?>
                                        <span style="color:#999; text-decoration:line-through"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?> </span>
                                        <?php } ?>
                                         <?php if($rw['price'] == 0 && $cur_splprc==0){?>
                                         <span  > <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=$rw['mrp'];?> </span>
                                         <?php } ?>
                                         &nbsp;&nbsp;
                                
                                
                                 <?php
                                   if($rw['special_price'] ==0 && $rw['price']>0){
                                 ?>                               
                                <span style="color:#079107 !important;"> <i class="fa fa-inr" aria-hidden="true" style="font-size: 14px;border: 0px;width: 0px; "></i>&nbsp;
 <?=ceil($rw['price'])?> </span>
                                <?php } ?>
                                <!-----------------------------------Product Price End----------------------------->
                                 
							<!--	<form action="#" method="post">-->
									<!--<input type="hidden" name="cmd" value="_cart" />
									<input type="hidden" name="add" value="1" /> 
									<input type="hidden" name="w3ls_item" value="Audio speaker" /> 
									<input type="hidden" name="amount" value="100.00" /> -->
									<?php /*?><button type="addtocart_prod"  class="w3ls-cart pw3ls-cart" onclick="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($rw['name'])))).'/'.$rw['product_id'].'/'.$rw['sku']  ?>">
                                    <i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button><?php */?>
								<!--</form> -->
                                
							</div>
						</div> 
					</div>
                
            <?php } } } ?>    
                <div class="clearfix"> </div>
				</div>
			</div>
			 <!--<div  class="col-md-3 product-grids">
                    	 <button type="submit" class="btn btn-primary"><i class="fa fa-backward" aria-hidden="true"></i> Previous</button>
                    </div>
           <div  class="col-md-8 product-grids" align="right">
                <button type="submit" class="btn btn-primary">Next <i class="fa fa-forward" aria-hidden="true"></i></button>
           </div>-->
		</div>
	</div>
                    <div id="view_more_dv" align="center">
           		<img src="<?php echo base_url();?>images/loader.gif" id="lodr_img" style="display:none;" width="24px"/>
                <?php if($no_of_product > $sl){ ?>
				<input style="display:none;" type="button" class="btn-sign-in"  value="View more" id="viewmore_prodbtnid" name="viewmore_prodbtnid" onClick="ShowMoreData('<?=$no_of_product;?>','<?=$label_id;?>','<?php if($this->uri->segment(4) != ''){ echo $this->uri->segment(4);}else{ echo 'NOT';}?>')">
				<?php }	?>
           </div>
                    <!----------------------------------------Product catalog end-------------------------------->
           
           <?php

//$cat_id = $this->uri->segment(4);

		$query = $this->db->query("SELECT catg_description FROM category_master WHERE category_id='$cat_id' ");
		
  if($query->num_rows()>0) {?>
<div class="col-md-12">
<div  style="color:#666; font-size:15px; font-family:Tahoma, Geneva, sans-serif; text-align:justify;">
<?php 

		echo  stripslashes($query->row()->catg_description);
?>
        </div>
        </div>
<?php } ?>     
                   
				    <div class="clearfix"> </div>
				</div>
		  </div>
	   </div>
  <!--//item-->
		
		</div>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/594c64bfe9c6d324a4736e5d/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();


function ShowMoreData(result_no,cat_id,lastseg){
	//alert('test');
	var numItems = parseInt($('.product-grids').length);
	var result_no = parseInt(result_no);
	//alert(lastseg);return false;
	$.ajax({
		url:'<?php echo base_url(); ?>product_description/show_more_category_catalog_data',
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
			$('.products-row').append(result);
			if(numItems == result_no){
				$('.view_mor').hide();
				$('#view_more_dv').html('<span>No more product available!</span>');
			}
		}
	});
}
</script>
<!--End of Tawk.to Script-->        
   
 <?php include "footer.php"; ?>      