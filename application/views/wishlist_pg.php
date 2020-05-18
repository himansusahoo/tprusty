<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content = "width = device-width, initial-scale =1.0, user-scalable = no">
		<meta name="<?php echo $data1->meta_descrp ;?>" content="" />
        <meta name="<?php echo $data1->meta_keyword ;?>" content="" />

		<title><?php echo $data1->title ;?></title>

<?php include "header.php" ?>
<style>
.main-content {
    padding: 100px 0px 10px;
	width:100%;
}
.category h4 {
    font-size: 19px;
}

.my_account_menu>h5 {
    font-size: 14px;
}
.title3 {
    font-size: 26px;
	margin-bottom: 10px;
	margin-top: -4px;
}
</style>		
<!------ Start Content ------>

<div class="main-content">
<div style="width:90%; margin:auto;">
		<div class="left-nav">
        	<?php include'profile_menu.php'; ?>
        </div>
	
    <div class="profile-right">
    	<div id="load_form">
        <?php $wishlist_row = $wishlist_products->num_rows(); ?>
        	<h2 class="title3">My Wishlist <span>(<?=$wishlist_row; ?> Items)</span></h2>
            
            <!--- Start of wishlist div --->
            <?php
			if($wishlist_row > 0){
				foreach($wishlist_products->result() as $wishlist_result){
					$image = explode(',',$wishlist_result->imag);
					$cdate = date('Y-m-d');
					$special_price_from_dt = $wishlist_result->special_pric_from_dt;
					$special_price_to_dt = $wishlist_result->special_pric_to_dt;
					
					//$taxdecimal = $wishlist_result->tax_rate_percentage/100;
		
					//tax amount for product price
					//$tax_amount = $wishlist_result->price*$taxdecimal;
					
					//tax amount for product special price
					//$tax_amount_special = $wishlist_result->special_price*$taxdecimal;
			?>
            <div class="wishlist_item">
            	<div class="wishlist_img"> <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($wishlist_result->name)))).'/'.$wishlist_result->product_id.'/'.$wishlist_result->sku; ?>" target="_blank"><img alt="<?=$wishlist_result->name;?>" src="<?php echo base_url();?>images/product_img/<?=$image[0]; ?>" /> </a></div>
                <div class="wishlist_data">
                
                 <div class="col-md-6 left">
                 
                <h4> <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($wishlist_result->name)))).'/'.$wishlist_result->product_id.'/'.$wishlist_result->sku; ?>" target="_blank"><?=$wishlist_result->name; ?></a> </h4>
                
                <!--- Pricing script start here --->
                <!---Special price exists condition start here --->
                <?php
                if($wishlist_result->special_price !=0){
                    if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                ?>
                
                <span class="regular-price"> Rs. <?=ceil($wishlist_result->mrp); ?> </span> &nbsp;&nbsp;
                
                <?php if($wishlist_result->price != 0){?>
                <span class="regular-price"> Rs. <?=ceil($wishlist_result->price); ?> </span> &nbsp;&nbsp;
                <?php }?>
                
                <span class="price"> Rs. <?=ceil($wishlist_result->special_price); ?> </span>
                <!---Special price exists condition end here --->
                <?php }else{ ?>
                
                <?php if($wishlist_result->price != 0){?>
                <span class="regular-price"> Rs. <?=ceil($wishlist_result->mrp); ?> </span> &nbsp;&nbsp;
                <span class="price"> Rs. <?=ceil($wishlist_result->price); ?> </span> &nbsp;&nbsp;
                <?php }else{?>
                <span class="price"> Rs. <?=ceil($wishlist_result->mrp); ?> </span> &nbsp;&nbsp;
                <?php }?>
                
                <?php } //End of date condition ?>
                
                <?php }else{ ?>
                
                <?php if($wishlist_result->price != 0){?>
                <span class="regular-price"> Rs. <?=ceil($wishlist_result->mrp); ?> </span> &nbsp;&nbsp;
                <span class="price"> Rs. <?=ceil($wishlist_result->price); ?> </span> &nbsp;&nbsp;
                <?php }else{?>
                <span class="price"> Rs. <?=ceil($wishlist_result->mrp); ?> </span> &nbsp;&nbsp;
                <?php }?>
                
                <?php } ?>
                <!--- Pricing script end here --->
                                
                <!--<div class="clearfix"></div>
-->
               
               <!-- 8 Sellers <br> -->
               
                <h4 style="color:#6bb700;"> <?=$wishlist_result->stock_availability ; ?>. </h4> 
                <!--Delivered in 4-5 business days. <a href="#"> [?] </a>-->
                <!--<button class="button add-to-cart" onClick="window.location.href='<?php// echo base_url().'product_description/addtocart_temp/'.preg_replace('#/#',"-",str_replace(" ","-",strtolower($wishlist_result->name))).'/'.$wishlist_result->product_id.'/'.$wishlist_result->sku; ?>'">View Details</button>  <br>   <br>-->
                
                <button class="button add-to-cart" onClick="window.open('<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($wishlist_result->name)))).'/'.$wishlist_result->product_id.'/'.$wishlist_result->sku; ?>','_blank')">View Details</button><br><br>
                
                
                <span class="wish_spn a_spn" onClick="removeFromWishlist(<?=$wishlist_result->wishlist_id; ?>)"> <i class="fa fa-times-circle"> </i> Remove from List </span>
                 </div>
            
			<div class="col-md-6 right">

                <p> <?php echo substr($wishlist_result->description,0,100).'...';?><br/><a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($wishlist_result->name)))).'/'.$wishlist_result->product_id.'/'.$wishlist_result->sku; ?>"> View More</a> </p> 
                
                <ul>
                <?php $desc=$wishlist_result->short_desc;
					 $descp=unserialize(substr($desc,0));
					 $desc1=implode(',',$descp);
					// print_r($desc1);exit;
?>
                	 <li><?=$desc1?></li>
                </ul>    
			</div>
<div class="clearfix"></div>
                
                 </div>
                 
                 <div class="clearfix"></div>
            </div> <!--- End of wishlist div --->
			<?php 
				} //End of foreach loop
			}else{
			 ?>
            <p>No wishlist Record.</p>
            <?php } ?>
        </div>
    </div>
</div>
<div class="clearfix">&nbsp;</div>

<?php include "footer.php" ?>

<script>
function removeFromWishlist(wishlist_id){
	$.ajax({
		url:'<?php echo base_url(); ?>user/remove_from_wishlist',
		method:'post',
		data:{id:wishlist_id},
		success:function(result){
			if(result == 'success'){
				window.location.reload(true);
			}
		}
	});
}
</script>

</body>

</html>