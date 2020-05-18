
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content = "width = device-width, initial-scale =1.0, user-scalable = no">
		<meta name="<?php //echo $data->meta_descrp ;?>" content=""/>
        <meta name="<?php //echo $data->meta_keyword ;?>" content="" />
        
		<title>moonboy.in and India's no 1 shopping site.</title>

    <?php
	date_default_timezone_set('Asia/Calcutta');
	 include "header.php" ; ?>
    <!-- Lightbox link start here  -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>colorbox/colorbox.css" />
		<script src="<?php echo base_url(); ?>colorbox/jquery.colorbox.js"  ></script>
		<script>
			$(document).ready(function(){
				$(".inline").colorbox({inline:true, width:"34%"});
			});
		</script>
        <!-- Lightbox link end here-->
<script>
function gosellerReview(val){
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
</script>

<script>
$(document).ready(function(){
	$('#limg').css('display','none');
});
</script>

<script>
function removeCartProduct(rec_cart){
	//window.onload = $('#limg').css('display','block');
	window.location.href="<?php echo base_url();?>mycart/remove_from_tempcart/"+rec_cart;
}
</script>
<!------ Start Content ------>
<div class="main-content">
<!--<ul class="back"> <li><i class="back_arrow"> </i>Back to <a href="index.html">Men's Clothing</a></li> </ul>-->

	<div id="limg"> <div class="ldr-img"></div> </div> <!--Loader div-->

  <div  class="checkout" >
    <h3 class="title3" style="text-transform:capitalize;"> Your Cart </h3>
    <?php //$i=0; $sku_arr=array(); foreach($sku as $key=>$rec_cart){ $sku_arr[$i]= $rec_cart; $i++; }   $j=0 ;
  //print_r($sku);exit;
 $arr = (array)$sku;
if (empty($arr)) {
?>
  <table width="100%" border="0" cellspacing="5">
  <thead class="tbl-title"> 
  <tr>
    <td width="30%"> Item </td>
    <td width="40%">Item Detail </td>
    <td> Qty </td>
    <td> Price </td>
  </tr>
  </thead> 
  <tr><td colspan="4"><div style="text-align:center;"><h3> No items in cart </h3></div></td></tr>
  </table>
     
 <div class="col-md-4" style="text-align:center; float:right;"> 
   <button type="button" title="Add to Cart"  class="button btn-cart-big" onclick="window.location.href='<?php echo base_url() ?>'" > <i class="fa fa-angle-double-left"></i>
Continue Shopping</button> 
   </div>
   
   
   
<?php }else { ?>
<table width="100%" border="0" cellspacing="5">
  <thead class="tbl-title"> 
  <tr>
    <td width="30%"> Item </td>
    <td width="40%">Item Detail </td>
    <td> Qty </td>
    <td> Price </td>
   
  </tr>
  </thead> 

<?php
   $total_price=0;  foreach($sku as $key=>$rec_cart){ 
 ?>
  
  <tr>
  
   <td>
   <div class="checkout-img"> 
   <?php  
   //$image_cart=explode(',',$rec_cart->imag);
   $qr1=$this->db->query("select a.imag,b.sku,c.name,b.product_id from product_image a inner join product_master b on a.product_id=b.product_id inner join product_general_info c on b.product_id=c.product_id where b.sku='$rec_cart'");
   $rw1=$qr1->row();
   $image_cart=explode(',',$rw1->imag);
   
    ?>  <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($rw1->name)))).'/'.$rw1->product_id.'/'.$rw1->sku  ?>" target="_blank"><img src="<?php echo base_url().'images/product_img/'.'catalog_'.$image_cart[0]; ?>"> </a>
	</div>
    <div class="chckout-desc"> 
    <?php  $qr2=$this->db->query("select a.name from product_general_info a inner join product_master b on a.product_id=b.product_id  where b.sku='$rec_cart'");
   $rw2=$qr2->row(); 
   echo "<h3 class='product-name'>"."<a href="."'".base_url().'product_description/product_detail/'.preg_replace('#/#',"-",str_replace(" ","-",strtolower($rw1->name)))."/".$rw1->product_id."/".$rw1->sku."'"." target=_blank>". $rw2->name ."</a>"."</h3> " ; 
  
   $query_sellername=$this->db->query("select a.business_name,a.seller_id from seller_account_information a inner join product_master b on a.seller_id=b.seller_id  where b.sku='$rec_cart'  ");
   $count_row=$query_sellername->num_rows();
   if($count_row!=0){
   $rw_sellername=$query_sellername->row();
   $sellerid1=$rw_sellername->seller_id;
   ?>
   <a onclick="gosellerReview(<?= $sellerid1; ?>)" id="goslr" style="cursor:pointer !important;">
   <?php  
	echo "Seller : "."<span class='blue'>".$rw_sellername->business_name."</span>"; }
	else { echo "Seller:  moonboy ";}
   ?>
   </a>
   <div class="clearfix"></div>
   <!--<div class="fulfill"> <img src="<?//php echo base_url()?>images/moon-fulfilled.png" alt="">  </div>-->

    </div> 
    <div class="clearfix"></div>
    
        <!--<div class="clearfix"> &nbsp;</div>-->
    
   <span class="item-no"> <i class="fa fa-check-square-o"></i> 100% Refund / Replacement Guarantee*  </span>
   <!--<a href="<?php// echo base_url().'mycart/remove_from_tempcart/'.$rec_cart; ?>"  class="orange right"> <i class="fa fa-times-circle"> </i> Remove </a>--> 
   
   <span class="orange right" style="cursor:pointer;" onClick="removeCartProduct('<?=$rec_cart;?>');"> <i class="fa fa-times-circle"> </i> Remove </span>
   <div class="clearfix"></div>
    </td>
    <td>
    <?php  $qr2=$this->db->query("select a.description from product_general_info a inner join product_master b on a.product_id=b.product_id  where b.sku='$rec_cart'");
   $rw2=$qr2->row(); 
   echo  $rw2->description;
   
   ?>
    
    </td>
    <td align="center"> <?php
	$ct=count($rec_cart);
	echo $ct;
	//$user_id=$this->session->userdata['session_data']['user_id'];
	  //$qr2=$this->db->query("select * from addtocart_temp where product_id='$rec_cart->product_id' and user_id='$user_id' and sku='$rec_cart->sku' ");
//   $rec_ct=$qr2->num_rows(); 
   //echo  $rec_ct;
   
   ?>
    </td>
    <td align="center">  
    <h4 class="price-blue" >Rs. <?php  //$user_id=$this->session->userdata['session_data']['user_id'];
	  $qr3=$this->db->query("select * from product_master  where sku='$rec_cart'   ");  
	  
		$rec4=$qr3->result();
	   //echo $price[0]->price;
	   $price=0;
	   //========================================================
	   
	    $cdate = date('Y-m-d');
		  $special_price_from_dt = $rec4[0]->special_pric_from_dt;
		  $special_price_to_dt = $rec4[0]->special_pric_to_dt;
		  
		  //calculatin tax amount//
		  //$tax_class = $rec4[0]->tax_class;
		  //$tax_sql = $this->db->query("SELECT tax_rate_percentage FROM tax_management WHERE tax_id='$tax_class'");
		 // $tax_res = $tax_sql->row();
		  //$tax_persent = $tax_res->tax_rate_percentage;
		  $tax_persent = $rec4[0]->tax_amount;
		  $taxdecimal = $tax_persent/100;
		  
		  //array_push($tax_arr,$taxdecimal);
		  //tax amount for product price
		 $tax_amount = $rec4[0]->price*$taxdecimal;
					
		  //tax amount for product special price
		  $tax_amount_special = $rec4[0]->special_price*$taxdecimal;
		  
		  //tax amount for product mrp price
		  $tax_amount_mrp = $rec4[0]->mrp*$taxdecimal;
		  ///calculating tax amount script end here///
		  
		  if($rec4[0]->special_price !=0){
			  if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
				  //array_push($tax_arr,$tax_amount_special*$ct);
				  
		  			$price= $price + $rec4[0]->special_price;
			  }else{
				  //array_push($tax_arr,$tax_amount*$rec_ct);
				    //$price= $price + $rec4[0]->price;
					if($rec4[0]->price != 0){
						//array_push($tax_arr,$tax_amount*$ct);
				    	$price= $price + $rec4[0]->price;
					}else{
						//array_push($tax_arr,$tax_amount_mrp*$ct);
						$price= $price + $rec4[0]->mrp;
					}
			  } //End of date condition
		  }else{
			  //array_push($tax_arr,$tax_amount*$rec_ct);
			  //$price= $price + $rec4[0]->price;
			  
			  	if($rec4[0]->price != 0){
					//array_push($tax_arr,$tax_amount*$ct);
				    $price= $price + $rec4[0]->price;
				}else{
					//array_push($tax_arr,$tax_amount_mrp*$ct);
					$price= $price + $rec4[0]->mrp;
				}
			  
		  } //End of date special_price!=0 condition
			
	  
	   echo $final_price = ceil($price/$ct);
	   
	   //========================================================
	   

	   ?> </h4>  </td>
      
  <?php $total_price=$total_price+$final_price;  
 // $j++;}
  } ?>
  
  </tr>

  <tr><td colspan="4" align="right"  style="background-color:#f6f6f6;">Total Amount Payable:  <span  style="font-size:18px; font-weight:bold;"> Rs. <?php echo " ". $total_price; ?> </span> </td></tr>
</table>

 
  <div class="clearfix">&nbsp;</div> 
    
   <div  class="col-md-6 cart-btns"> 
   <button type="button" title="Add to Cart"   class="button btn-cart-big" onclick="window.location.href='<?php echo base_url() ?>'" > <i class="fa fa-angle-double-left"></i>
Continue Shopping</button> 
<?php if($this->session->userdata('session_data')){ ?>

<button type="button" title="Proceed To Checkout" class="btn-big2" onclick="window.location.href='<?php echo base_url().'mycart/checkout_process' ?>'" >Proceed To Checkout  </button> 
<?php } else {  ?>
   <a class='inline' href="#inline_content"> <button type="button" title="Proceed To Checkout" class="btn-big2" >Proceed To Checkout  </button> </a><?php }?>
   

   
   </div> 
   <?php } ?>
     
  <div class="clearfix">&nbsp;</div>
  
 <?php 
  if($new_product_result!=''){ ?>
  <div class="best-seller">
<h3 class="title4"> <span>  Recently viewed Items </span> </h3>
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
	$result = $new_product_result->result();
	foreach($result as $product){
		$j++;
		$img = explode(',',$product->catelog_img_url);
		$cdate = date('Y-m-d');
		$special_price_from_dt = $product->special_pric_from_dt;
		$special_price_to_dt = $product->special_pric_to_dt;
		

		$quantity=$product->quantity;
		//$stock=$product->stock_availability;
?>
<?php //if($stock=="In Stock"){ ?>
<li>

 <div class="view view-fifth">
 <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($product->name)))).'/'.$product->product_id.'/'.$product->sku  ?>" >
 
	<img src="<?php echo base_url();?>images/product_img/<?= $img[0];?>" alt=""></a> </div>
    
    <!--<img src="<?php// echo base_url();?>images/product_img/<?//=$product->imag;?>" alt=""></a> </div>-->
    

   <div class="wish-list"> 
        <?php if($this->session->userdata('session_data')){ ?>            
            	<a href="#" class="link-wishlist wish_spn"  data-toggle="tooltip" title="Add To Wishlist" data-placement="right" onclick="addWishlistFunction(<?=$product->product_id; ?>,'<?=$product->sku; ?>')"><i class="fa fa-heart"></i></a>
            <?php }else{ ?>
            	<!--<a class="link-wishlist inline" href="#inline_content"  data-toggle="tooltip" title="Add To Wishlist"  data-placement="right"s> <i class="fa fa-heart"></i></a>-->
                <a class="link-wishlist wish_spn" onclick="addWishlistFunction_temp(<?=$product->product_id; ?>,'<?=$product->sku; ?>')" href="#"  data-toggle="tooltip" title="Add To Wishlist"> <i class="fa fa-heart"></i></a>
                
            <?php } ?>
            
    </div>

    <div class="best-slr-data">
    
        <h3 class="product-name"><a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($product->name)))).'/'.$product->product_id.'/'.$product->sku  ?>" title="wallet"><?= substr($product->name,0,45).'...';?></a></h3>     
       <!--- <div class="prdct-dtl"><?php// echo substr($product->short_desc,0,50).'...';?></div>  --> 
        
        <!--- price calculation div start here --->
     	<div class="price-box">
        <!---Special price exists condition start here --->
		<?php
		if($product->special_price !=0){
			if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
		?>
        
		<span class="regular-price"> Rs. <?=ceil($product->mrp); ?> </span> &nbsp;&nbsp;
        
        <?php if($product->price != 0){?>
        <span class="regular-price"> Rs. <?=ceil($product->price); ?> </span> &nbsp;&nbsp;
        <?php }?>
        
        <span class="price"> Rs. <?=ceil($product->special_price); ?> </span>
        <!---Special price exists condition end here --->
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
        <!--- price calculation div end here --->
         
         <?php
		$query= $this->db->query("SELECT count( product_id ) as product1 FROM product_master WHERE approve_status = 'Active' and product_id='$product->product_id' GROUP BY product_id");
		$qr=$query->result();
		//print_r($qr);exit;
		
        foreach($qr as $rew){
			$count_13 = $qr[0]->product1-1;
			//print_r($count_1);exit;
			if($count_13 != 0){
		?>
		
         <div class="other-seller">  <a href="#"> From <?php echo $count_13; ?> other Sellers </a> </div> 
        <?php } } ?>
    </div>
</li>

 
<?php 
	}}  //End of foreach loop

?>
			


</ul>
</div>
 <a class="buttons next" href="#">&#62;</a>	
</div>
<?php } //} //End of if condition?>
</div>
  
             
    <div class="clearfix"> &nbsp;</div>
  
  </div>
  <div class="clearfix"> &nbsp;</div>
  
<style>
#limg { background:rgba(255,255,255,0.7); /*position:absolute;*/ top:0;left:0px; z-index:10000000; position:fixed;}
.ldr-img{background:url(<?php echo base_url(); ?>images/lodr.gif) no-repeat top center; margin:25% 649px 70%; width:50px; height:50px;}
#limg{ display:none;}
</style>
  
    <!-- footer Section -->
   <?php include "footer.php"; ?>