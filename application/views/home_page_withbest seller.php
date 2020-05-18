<!DOCTYPE html>
<html lang="en">

<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content = "width = device-width, initial-scale =1.0, user-scalable = no">
        
		<meta name="Description" content="<?php echo $data1->meta_descrp ;?>">
        <meta name="Keywords" content="<?php echo $data1->meta_keyword ;?>" />
        
		<title><?php echo $data1->title ;?></title>
        
		<?php
        include "header.php";
        $data_for_wishlist= array();
        $this->session->set_userdata('addtowishlisttemp_prdid',$data_for_wishlist);
        $temp_wishlistsku=array();
        $this->session->set_userdata('addtowishlist_tempsku',$temp_wishlistsku);
        ?>

<script>
function goproductpage(val){
	//alert (val); return false;
	$('#goslr').css('color','#a4f068');
	$.ajax({
		  url:'<?php echo base_url(); ?>product_description/seller_rev_pg',
		  method:'post',
		  data:{seller_id:val},
		  success:function(result)
		  {
			//$('#ajxtest').html(result);
			if(result == 'success'){
				window.location.href='<?php echo base_url() ;?>seller';
				  //window.location.reload(true);
				  //setTimeout(function() { location.reload() },1500);
			  }
		  }
	  });
}


function imgError(image){
    image.onerror = "";
    image.src = "<?php echo base_url();?>images/product_img/prdct-no-img.png";
    return true;
}
</script>

<div class="main-content">

<div class="banner">
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
    <li data-target="#carousel-example-generic" data-slide-to="4"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
   
     <a href="<?php echo base_url().'product_description/product_addtocart/'.$slider_box1[0]->box1_id.'/'.$slider_box1[0]->category_id ?>">  <img alt="Ethnic Wear" src="<?php echo base_url();?>images/slider/<?php echo $slider_box1[0]->box1_image; ?>"  /> </a>
  <!--    <div class="carousel-caption"> Welcome to Moonboy </div>-->
    </div>
    <div class="item">  <a href="<?php echo base_url().'product_description/product_addtocart/'.$slider_box1[0]->box1_id.'/'.$slider_box1[1]->category_id ?>">  <img alt="Selfie Stick" src="<?php echo base_url();?>images/slider/<?php echo $slider_box1[1]->box1_image; ?>" /> </a> </div>
    <div class="item">  <a href="<?php echo base_url().'product_description/product_addtocart/'.$slider_box1[0]->box1_id.'/'.$slider_box1[2]->category_id ?>">  <img alt="LED TV" src="<?php echo base_url();?>images/slider/<?php echo $slider_box1[2]->box1_image; ?>" /> </a> </div>
    <div class="item">  <a href="<?php echo base_url().'product_description/product_addtocart/'.$slider_box1[0]->box1_id.'/'.$slider_box1[3]->category_id ?>">  <img alt="Genuine Battery" src="<?php echo base_url();?>images/slider/<?php echo $slider_box1[3]->box1_image; ?>"  /> </a> </div>
    <div class="item">  <a href="<?php echo base_url().'product_description/product_addtocart/'.$slider_box1[0]->box1_id.'/'.$slider_box1[4]->category_id ?>">  <img alt="Designer Kurtis
com" src="<?php echo base_url();?>images/slider/<?php echo $slider_box1[4]->box1_image; ?>"  /> </a> </div>
   
  </div> <!-- Wrapper for slides -->
</div>

</div>
<div class="clearfix"></div>

<!-- Start Content -->

<div class="banner-bellow">
 <?php
	 $rows1 = $sub1_box1_info->num_rows();
	  
	  if($rows1 > 0){
	foreach($sub1_box1_info->result() as $row){
		
?>
<div class="bnr-l"> <img alt="ad-banner" src="<?php echo './images/subpage/'.$row->image_name;?>" />

<a href="<?php echo base_url().'product_description/product_addtocart/'.$row->image_id.'/'.$row->category_id ?>"> <div class="off-txt-container"> 
<div class="off-text"> Shop  Now <span> <i class="fa fa-chevron-circle-right"></i> </span> </div>   </div></a>

 </div><?php } } ?>
<?php
						 $rows1 = $sub1_box2_info->num_rows();
						  
						  if($rows1 > 0){
                        foreach($sub1_box2_info->result() as $row){
							
							?>
<div class="bnr-r"> <img alt="ad-banner" src="<?php echo './images/subpage/'.$row->image_name;?>" />

<a href="<?php echo base_url().'product_description/product_addtocart/'.$row->image_id.'/'.$row->category_id ?>">
<div class="off-txt-container"> 
<div class="off-text"> Shop  Now <span> <i class="fa fa-chevron-circle-right"></i> </span> </div>   </div> </a> 

</div><?php } } ?>

<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="cont">
<div class="off-section">
 <?php
						 $rows1 = $sub2_box1_info->num_rows();
						  
						  if($rows1 > 0){
                        foreach($sub2_box1_info->result() as $row){
							
							?>
<div class="off"><img alt="ad-banner" src="<?php echo './images/subpage2/'.$row->image_name;?>"  /><?php } } ?>
<a href="<?php echo base_url().'product_description/product_addtocart/'.$row->image_id.'/'.$row->category_id ?>"> <div class="off-txt-container"> 
<div class="off-text"> Shop  Now <span> <i class="fa fa-chevron-circle-right"></i> </span> </div>   </div> </a>
<!--<h3>lenovo a7000</h3>-->
</div>
<?php
						 $rows1 = $sub2_box2_info->num_rows();
						  
						  if($rows1 > 0){
                        foreach($sub2_box2_info->result() as $row){
							
							?>
<div class="off"><img alt="ad-banner" src="<?php echo './images/subpage2/'.$row->image_name;?>" /><?php } } ?>
<a href="<?php echo base_url().'product_description/product_addtocart/'.$row->image_id.'/'.$row->category_id ?>"> <div class="off-txt-container"> 
<div class="off-text"> Shop  Now <span> <i class="fa fa-chevron-circle-right"></i> </span> </div>  </div> </a>
<!--<h3>Sony Xperia</h3>-->
</div>
<?php
						 $rows1 = $sub2_box3_info->num_rows();
						  
						  if($rows1 > 0){
                        foreach($sub2_box3_info->result() as $row){
							
							?>
<div class="off"><img alt="ad-banner" src="<?php echo './images/subpage2/'.$row->image_name;?>" /><?php } } ?>
<a href="<?php echo base_url().'product_description/product_addtocart/'.$row->image_id.'/'.$row->category_id ?>">  <div class="off-txt-container"> 
 <div class="off-text">  Shop Now  <span> <i class="fa fa-chevron-circle-right"></i> </span> </div> </div> </a>
<!--<h3>iPhone 5S</h3>-->
</div>
<div class="clearfix">&nbsp;</div>
</div>
<?php
						 $rows1 = $sub3_box1_info->num_rows();
						  
						  if($rows1 > 0){
                        foreach($sub3_box1_info->result() as $row){
							
							?>

<div class="offer-panel"><img alt="ad-banner" src="<?php echo './images/subpage3/'.$row->image_name;?>" /><?php } } ?>
<a href="<?php echo base_url().'product_description/product_addtocart/'.$row->image_id.'/'.$row->category_id ?>"> <div class="off-txt-container"> 
<div class="off-text"> Shop  Now <span> <i class="fa fa-chevron-circle-right"></i> </span> </div>  </div> </a>
</div>
<div class="clearfix">&nbsp;</div>

    
<div class="best-seller">
<h3 class="title"> <span> New Arrivals </span> </h3>
<?php
$product_row = $new_product_result->num_rows();
$j = 0;
if($product_row > 0){
?>
<div id="slider1">
		<a class="buttons prev" href="#">&#60;</a>
                  <div class="viewport">
			<ul class="overview best-selr-prdct">
<?php
/*$product_row = $new_product_result->num_rows();
$j = 0;
if($product_row > 0){*/
	$result = $new_product_result->result();
	foreach($result as $product){
		$j++;
		//$img = explode(',',$product->imag);
		$dsply_img = $product->catelog_img_url;
		$img = explode(',',$product->catelog_img_url);
		$cdate = date('Y-m-d');
		$special_price_from_dt = $product->special_pric_from_dt;
		$special_price_to_dt = $product->special_pric_to_dt;
		
		//$taxdecimal = $product->tax_rate_percentage/100;
		
		//tax amount for product price
		//$tax_amount = $product->price*$taxdecimal;
		
		//tax amount for product special price
		//$tax_amount_special = $product->special_price*$taxdecimal;
		$quantity=$product->quantity;
		//$stock=$product->stock_availability;
?>
<?php //if($stock=="In Stock"){ ?>
<li>


<div class="view view-fifth">
   <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($product->name)))).'/'.$product->product_id.'/'.$product->sku  ?>" >
   
  
    <?php if(empty($dsply_img)){?>
    <img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" width="184" height="154" alt="<?=$product->name?>">
    <?php }else{?>
<img src="<?php echo base_url();?>images/product_img/<?=$img[0];?>" onerror="imgError(this);" width="184" height="154" class="wow flipInY grow" data-wow-delay="1s" alt="<?=$product->name?>">
   	<?php } ?>
</a></div>

   <div class="wish-list"> 
        <?php if($this->session->userdata('session_data')){ ?>            
            	<a href="#" class="link-wishlist wish_spn"  data-toggle="tooltip" title="Add To Wishlist" data-placement="right" onClick="addWishlistFunction(<?=$product->product_id; ?>,'<?=$product->sku; ?>')"><i class="fa fa-heart"></i></a>
            <?php }else{ ?>
            	<!--<a class="link-wishlist inline" href="#inline_content"  data-toggle="tooltip" title="Add To Wishlist"  data-placement="right"s> <i class="fa fa-heart"></i></a>-->
                <a class="link-wishlist wish_spn" onClick="addWishlistFunction_temp(<?=$product->product_id; ?>,'<?=$product->sku; ?>')" href="#"  data-toggle="tooltip" title="Add To Wishlist"  > <i class="fa fa-heart"></i></a>
                
            <?php } ?>
            
    </div>

    <div class="best-slr-data">
    
        <h2 class="product-name"><a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($product->name)))).'/'.$product->product_id.'/'.$product->sku  ?>" title="wallet"><?= substr($product->name,0,45).'...';?></a></h2>     
       
        
        <!-- price calculation div start here -->
     	<div class="price-box">
        <!--Special price exists condition start here -->
		<?php
		if($product->special_price !=0){
			if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
		?>
        
		<span class="regular-price"> Rs. <?=ceil($product->mrp); ?> </span> &nbsp;&nbsp;
        
        <?php if($product->price != 0){?>
        <span class="regular-price"> Rs. <?=ceil($product->price); ?> </span> &nbsp;&nbsp;
        <?php }?>
        
        <span class="price"> Rs. <?=ceil($product->special_price); ?> </span>
        <!--Special price exists condition end here -->
		<?php }else{ ?>
		
        <?php if($product->price != 0){?>
        <span class="regular-price"> Rs. <?=ceil($product->mrp); ?> </span> &nbsp;&nbsp;
        <span class="price"> Rs. <?=ceil($product->price); ?> </span> &nbsp;&nbsp;
        <?php }else{?>
        <span class="price"> Rs. <?=ceil($product->mrp); ?> </span> &nbsp;&nbsp;
        <?php }?>
        
        <?php } //End of date condition ?>
        
        <?php }else{ ?>
        
		<?php if($product->price != 0){?>
        <span class="regular-price"> Rs. <?=ceil($product->mrp); ?> </span> &nbsp;&nbsp;
        <span class="price"> Rs. <?=ceil($product->price); ?> </span> &nbsp;&nbsp;
        <?php }else{?>
        <span class="price"> Rs. <?=ceil($product->mrp); ?> </span> &nbsp;&nbsp;
        <?php }?>
		
        <?php } ?>
        </div>
        <!-- price calculation div end here -->
         
      
        
        
        
         <?php
		$query= $this->db->query("SELECT  product_id   FROM product_master WHERE approve_status = 'Active' and product_id='$product->product_id' and seller_id!=0 GROUP BY product_id, seller_id");
		
		if($query->num_rows()!=0)
		{
			$count_13 = $query->num_rows()-1;
			
			if($count_13 != 0)
			{
			//?>

         <div class="other-seller">  <a href="#"> From <?php echo $count_13; ?> other Sellers </a> </div> 
		 <?php }}  ?>
        
        
        
        
        
        
    </div>
</li>

 
<?php 
	}}  //End of foreach loop

?>
</ul>
</div>
 <a class="buttons next" href="#">&#62;</a>	
</div>
<?php //} //End of if condition?>
</div>


<!-- Best Seller -->

<div class="best-seller">
<h3 class="title5"> <span> Best Sellers </span> </h3>
<?php
$k=0;
$product_row = $product_result->num_rows();

if($product_row > 0){
?>
<div id="slider2">
		<a class="buttons prev" href="#">&#60;</a>
                  <div class="viewport">
			<ul class="overview best-selr-prdct">
<?php
/*$k=0;
$product_row = $product_result->num_rows();
if($product_row > 0){*/
	$result = $product_result->result();
	foreach($result as $product){
		$k++;
		//$img = explode(',',$product->imag);
		$dsply_img = $product->catelog_img_url;
		$img = explode(',',$product->catelog_img_url);
		$cdate = date('Y-m-d');
		$special_price_from_dt = $product->special_pric_from_dt;
		$special_price_to_dt = $product->special_pric_to_dt;
		//$taxdecimal = $product->tax_rate_percentage/100;
		
		/*inclusive tax calculation*/
		//$tax_amount = $product->price*$taxdecimal;
		
		//tax amount for product price
		//$tax_amount = $product->price*$taxdecimal;
		
		//tax amount for product special price
		//$tax_amount_special = $product->special_price*$taxdecimal;
		$quantity=$product->quantity;
		//$stock=$product->stock_availability;
?>
<?php //if($stock=="In Stock"){ ?>
<li>
<!-- <div class="catlog-img">
 <div class="cat-img-warper"></div></div>-->
<div class="view view-fifth">
  <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($product->name)))).'/'.$product->product_id.'/'.$product->sku  ?>" >
    
    <?php if(empty($dsply_img)){?>
    <img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" width="184" height="154" alt="<?=$product->name?>">
    <?php }else{?>
<img src="<?php echo base_url();?>images/product_img/<?=$img[0];?>" onerror="imgError(this);" width="184" height="154" class="wow flipInY grow" data-wow-delay="1s" alt="<?=$product->name?>">
   	<?php } ?>
    
    </a></div>
    
    <div class="wish-list"> 
        <?php if($this->session->userdata('session_data')){ ?>            
            	<span class="link-wishlist wish_spn" onClick="addWishlistFunction(<?=$product->product_id; ?>,'<?=$product->sku; ?>')"><i class="fa fa-heart"></i></span>
            <?php }else{ ?>
            	<!--<a class="link-wishlist inline" href="#inline_content"><i class="fa fa-heart"></i></a>-->
                <a class="link-wishlist wish_spn" onClick="addWishlistFunction_temp(<?=$product->product_id; ?>,'<?=$product->sku; ?>')" href="#"  data-toggle="tooltip" title="Add To Wishlist"  > <i class="fa fa-heart"></i></a>
            <?php } ?>
    </div>
    
    <div class="best-slr-data">

        <h2 class="product-name"><a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($product->name)))).'/'.$product->product_id.'/'.$product->sku  ?>" title="wallet"><?= substr($product->name,0,45).'...';?></a></h2>     
        
        
    
        
        
        <!-- price calculation div start here -->
     	<div class="price-box">
        <!-- Special price exists condition start here -->
		<?php
		if($product->special_price !=0){
			if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
		?>
        
		<span class="regular-price"> Rs. <?=ceil($product->mrp); ?> </span> &nbsp;&nbsp;
        
        <?php if($product->price != 0){?>
        <span class="regular-price"> Rs. <?=ceil($product->price); ?> </span> &nbsp;&nbsp;
        <?php }?>
        
        <span class="price"> Rs. <?=ceil($product->special_price); ?> </span>
        <!--Special price exists condition end here -->
		<?php }else{ ?>
		
        <?php if($product->price != 0){?>
        <span class="regular-price"> Rs. <?=ceil($product->mrp); ?> </span> &nbsp;&nbsp;
        <span class="price"> Rs. <?=ceil($product->price); ?> </span> &nbsp;&nbsp;
        <?php }else{?>
        <span class="price"> Rs. <?=ceil($product->mrp); ?> </span> &nbsp;&nbsp;
        <?php }?>
        
        <?php } //End of date condition ?>
        
        <?php }else{ ?>
        
		<?php if($product->price != 0){?>
        <span class="regular-price"> Rs. <?=ceil($product->mrp); ?> </span> &nbsp;&nbsp;
        <span class="price"> Rs. <?=ceil($product->price); ?> </span> &nbsp;&nbsp;
        <?php }else{?>
        <span class="price"> Rs. <?=ceil($product->mrp); ?> </span> &nbsp;&nbsp;
        <?php }?>
		
        <?php } ?>
        </div>
        <!-- price calculation div end here -->
        
        
        
        
        <!-- price calculation div end here -->
       
         
         
         <?php
		$query= $this->db->query("SELECT  product_id   FROM product_master WHERE approve_status = 'Active' and product_id='$product->product_id' and seller_id!=0 GROUP BY product_id, seller_id");
		
		if($query->num_rows()!=0)
		{
			$count_13 = $query->num_rows()-1;
			
			if($count_13 != 0)
			{
			//?>

         <div class="other-seller">  <a href="#"> From <?php echo $count_13; ?> other Sellers </a> </div> 
		 <?php }}//} ?>
         
         
           
    </div>
</li>

<?php 
	}}  //End of foreach loop
?>
</ul>

</div>
 <a class="buttons next" href="#">&#62;</a>	
</div>
<?php //} //End of if condition ?>

</div>
<div class="clearfix"></div>
 
<?php if($product_result_for_scroll1!=''){
$prows = $product_result_for_scroll1->num_rows();
if($prows > 0){
$i=0;
?>    <h3 class="title4"> <span> Recently viewed Items </span> </h3>
<section class="product-carousel-section">
       
    <div class="container">
           
           <ul id="flexiselDemo3">
           <?php
			foreach($product_result_for_scroll1->result() as $presult){
				$dsply_img = $presult->catelog_img_url;
				$imge = explode(',',$presult->catelog_img_url);
				$i++;
			?>
                
                
           <li><a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($product->name)))).'/'.$presult->product_id.'/'.$presult->sku  ?>" >
           
          <!-- <img src="<?php //echo base_url();?>images/product_img/<?//=$dsply_img;?>" width="184" height="154" alt="">-->
           
           	<?php if(empty($dsply_img)){?>
    		<img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" onerror="imgError(this);" width="184" height="154" alt="<?=$product->name?>">
    		<?php }else{?>
			<img src="<?php echo base_url();?>images/product_img/<?=$imge[0];?>" width="184" height="154" alt="<?=$product->name?>" class="wow flipInY grow" data-wow-delay="1s">
   			<?php } ?>
           
           </a> </li>
           
           <?php }  /*<?php ?>else{?>
          <!--<li> <strong>No Product Found.</strong> </li>-->
          
          <?php }?><?php */?>
           </ul>     
                
</div>
                
              
 
                  
</section>
<?php }} // End of if condition ?>
<div class="clearfix">&nbsp;</div>

<div class="brand">
<h3 class="title3"> Top Brands</h3>
<ul>
<li> <img alt="Jdidas" src="<?php echo base_url();?>images/brand1.jpg" /></li>
<li> <img alt="Joyrich" src="<?php echo base_url();?>images/brand2.jpg" /></li>
<li> <img alt="ysl" src="<?php echo base_url();?>images/brand3.jpg" /></li>
<li> <img alt="chocotoy studios" src="<?php echo base_url();?>images/brand4.jpg" /></li>
<li> <img alt="lazyoaf" src="<?php echo base_url();?>images/brand5.jpg" /></li>
<li> <img alt="maiaco" src="<?php echo base_url();?>images/brand6.jpg" /></li>
</ul>
</div>

<div class="clearfix">&nbsp;</div>
                 
<div>
<!--<div class="one-half-right">-->
<h4 class="title3"> Know Moonboy a little more  </h4>



<div class="about-clm">
<h5 style="font-weight:bold; color:#333;"> Terms &amp; Conditions :</h5>
<p>We only accept payment in Indian currency ( INR) for all products purchased.Purchases are subjected to delivery charges as stated in the Cart at time of purchase.</p>


<h5 style="font-weight:bold; color:#333;"> Shipping &amp; Delivery : </h5>

<p> Please allow at least 10-12 business days for your order to arrive after payment has been confirmed. If the product ordered is out of stocks, we will contact you immediately to confirm a new delivery date or other arrangements. Shipping through Reputed Couriers &ndash; Fedex/ DHL (Blue Dart)/ &nbsp;Professional/ DTDC / First Flight /Speed Post. We will provide a tracking number as soon as we send out the parcel. Please use the tracking number to track the status of the delivery. If you have any difficulties with this process, please do not hesitate to contact us at info@moonboy.in Exchange (return and/or resend) shipping cost are borne by Buyer.All shipping and handling fees are not refundable. </p> 
<h5 style="font-weight:bold; color:#333;"> Payment Terms :</h5>

<p>We accept various forms of payment modes e.g. Credit Card / Debit Card Online Bank Transfer . We will process your order immediately after the payments has been confirmed cleared by Online Payment Acceptance Service Provider.</p>

</div>
<div class="clearfix">&nbsp;</div>
</div>

<?php include "footer.php" ?>


<script>
function addWishlistFunction(product_id,sku){
	/*var succ_dv = '#wiss_succs'+sl;
	$(succ_dv).show();
	$(succ_dv).text('process...');*/
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


function addWishlistFunction_temp(product_id,sku)
{
	$.ajax({
		url:'<?php echo base_url(); ?>user/add_wishlist_temp',
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



  <script src="<?php echo base_url();?>js/wow.js"></script>
<script>
    wow = new WOW(
      {
        animateClass: 'animated',
        offset:       100,
        callback:     function(box) {
          console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
      }
    );
    wow.init();
    document.getElementById('moar').onclick = function() {
      var section = document.createElement('section');
      section.className = 'wow fadeInDown';
      this.parentNode.insertBefore(section, this);
    };
	
	wow.init();
    document.getElementById('moar').onclick = function() {
      var section = document.createElement('section');
      section.className = 'wow flipInY';
      this.parentNode.insertBefore(section, this);
    };
  </script>


</body>

</html>