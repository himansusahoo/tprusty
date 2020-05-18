
<?php if(@$this->session->userdata['session_data']['user_id']!='') {?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content = "width = device-width, initial-scale =1.0, user-scalable = no">
		<meta name="<?php //echo $data->meta_descrp ;?>" content=""/>
        <meta name="<?php //echo $data->meta_keyword ;?>" content=""/>
        
        <link rel="canonical" href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2); ?>"/>
        
		<title>Online Shopping India: Shop Online at India's Lowest Price Online Store- moonboy.in </title>

    <?php include "header.php" ;
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
<script>
/*function gosellerReview(val){
	//alert (val); return false;
	$('#goslr').css('color','#a4f068');
	$.ajax({
		  url:'<?//php echo base_url(); ?>product_description/seller_rev_pg',
		  method:'post',
		  data:{seller_id:val},
		  success:function(result)
		  {
			//$('#ajxtest').html(result);
			if(result == 'success'){
				window.location.href='<?//php echo base_url() ;?>seller';
				  //window.location.reload(true);
				  //setTimeout(function() { location.reload() },1500);
			  }
		  }
	  });
}*/
</script>
<script>
/*$(document).ready(function() {
//$("#submit1").attr('disabled', 'disabled');
$("form").keyup(function() {
// To Disable Submit Button
$("#submit1").attr('disabled', 'disabled');
// Validating Fields*/

	function valid_function(product_id,sku_id,session_id,user_id,rec_count,addtocart_id,quantity,sl){
		//alert(sl);return false;
	var quantity_added = $('#quantity_added'+sl).val();
   // alert(quantity_added);return false;
    if(isNaN(quantity_added)){
		alert('Entered value is not a number,please enter a number');
		$('#quantity_added'+sl).focus();
		return false;
	}
	if(quantity_added==''){
		alert('Enter quantity ');
		$('#quantity_added'+sl).focus();
		return false;
	}
	if(quantity_added<=0){
		alert('Quantity should be greater than zero ');
		$('#quantity_added'+sl).focus();
		return false;
	}
	$('#submit1'+sl).val('Wait..');
		$.ajax({
			url:'<?php echo base_url(); ?>mycart/insert_detail',
			method:'post',
			data:{product_id:product_id,sku_id:sku_id,session_id:session_id,user_id:user_id,rec_count:rec_count,addtocart_id:addtocart_id,quantity:quantity,sl:sl,quantity_added:quantity_added},
			success:function(result){
				if(result == 'success'){
					window.location.reload('<?php echo base_url(); ?>mycart/mycart_detail');
				}
			}
		});
	
}
	

</script>
<script>

$(document).ready(function(sl) {
//$("#submit1").attr('disabled', 'disabled');
$("form").keyup(function() {
	var reason = $('#cancel_reson'+sl).val();
// To Disable Submit Button
$("#submit1"+sl).attr('disabled', 'disabled');
// Validating Fields
var quantity_added = $('#quantity_added'+sl).val();
alert (quantity_added); return false;
if(isNaN(quantity_added))
	 {
		 
		 alert("Please enter a number");
		 $('#quantity_added'+sl).focus();
		 return false;
	 }
	 else if(quantity_added == "")
	 {
		 alert("Field value cannot be null,Please enter some number");
		 $('#quantity_added[]').focus();
		 return false;
	 }
	 else if(quantity_added == 0)
	 {
		 alert("Quantity you entered is not valid");
		 $('#quantity_added[]').focus();
		 return false;
	 }

   else if (!(quantity_added == "")) {

// To Enable Submit Button
$("#submit1").removeAttr('disabled');
$("#submit1").css({
"cursor": "pointer",
"box-shadow": "1px 0px 6px #333"
});
}
});
});
</script>

<!--<script>
$(document).ready(function(){
	$('#limg').css('display','none');
});
</script>-->

<script>
function removeCartProduct(rec_cart){
	window.onload = $('#limg').css('display','block');
	window.location.href="<?php echo base_url();?>mycart/remove_from_cart/"+rec_cart;
}
</script>

<!------ Start Content ------>
<div class="main-content">
<!--<ul class="back"> <li><i class="back_arrow"> </i>Back to <a href="index.html">Men's Clothing</a></li> </ul>-->
<!--<div id="limg"> <div class="ldr-img"></div> </div>--> <!--Loader div-->

<div class="clearfix">  </div>

  <div  class="checkout cont" >
  
  <h3 class="title3" style="text-transform:capitalize;"> Your Cart </h3>
    <?php 
  $arr=$cart_data->num_rows();
   if(empty($arr)) {
?>
  <table width="100%" border="0" cellspacing="5">
  <thead class="tbl-title"> 
  <tr>
    <td width="40%"> Item </td>
    <td width="10%"> Qty </td>
    <td width="15%"> Price </td>
   	<td width="20%"> Delivery Details </td>
    <td width="15%"> Sub Total </td>
  </tr>
  </thead>

   <tr><td colspan="5"><div style="text-align:center;"><h3> No items in cart </h3></div></td></tr>
  </table>

 <div  class="col-md-4" style="text-align:center; float:right;"> 
   <button type="button" title="Add to Cart"  class="button btn-cart-big" onClick="window.location.href='<?php echo base_url() ?>'" > <i class="fa fa-angle-double-left"></i>
Continue Shopping</button> 
   </div>

<?php }else { 

?>

<table width="100%" border="0" cellspacing="5">
  <thead class="tbl-title"> 
  <tr>
    <td width="40%"> Item </td>
    <td width="10%"> Qty </td>
    <td width="15%"> Price </td>
   	<td width="20%"> Delivery Details </td>
    <td width="15%"> Sub Total </td>
  </tr>
  </thead>
<?php
   $total_price=0; $sl=0;foreach($cart_data->result() as $rec_cart){$sl++; 
   $product_id=$rec_cart->product_id;
   ?>
   <?php  
	   //$image_cart=explode(',',$rec_cart->imag);
	   //data for existing product start
	   $qr1=$this->db->query("select d.name, b.image as imag , c.product_id, e.quantity,e.status,e.approve_status,e.sku  from product_general_info d inner join seller_product_master a ON a.master_product_id=d.product_id
	   INNER JOIN  seller_existingproduct_image b ON a.seller_exist_product_id=b.seller_extproduct_id 
	   INNER JOIN product_image c ON c.product_id=a.master_product_id
	   INNER JOIN product_master e on d.product_id=e.product_id 
		WHERE  a.sku='$rec_cart->sku' ");
		
		if($qr1->num_rows()==0)
		{
		 $qr1=$this->db->query("select a.product_id,a.name,b.quantity,b.status,b.approve_status,b.sku,c.imag from product_general_info a inner join product_master b on a.product_id=b.product_id inner join product_image c on a.product_id=c.product_id where b.sku='$rec_cart->sku'");
		}
		//data for existing product end
		
		//sujit-seller work31-aug-2017 start
	   $qrseller_status=$this->db->query("select a.business_name,a.seller_id,c.status from seller_account_information a inner join product_master b on a.seller_id=b.seller_id inner join seller_account c on a.seller_id=c.seller_id where b.sku='$rec_cart->sku'");
	   //sujit-seller work31-aug-2017 end
	
	   
	  
	   
	   $rw1=$qr1->row();
	   $image_cart=explode(',',$rw1->imag);
	   $avail_qnt=$rw1->quantity;
	   //sujit-seller work31-aug-2017 start
	   $avail_status=$rw1->status;
	   $avail_approve_status=$rw1->approve_status;
	   $seller_status=$qrseller_status->row()->status;
	   //sujit-seller work31-aug-2017 end
    ?>  
  
  <tr>
  
   <td> <div class="checkout-img">  
  
    
    <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($rw1->name)))).'/'.$rw1->product_id.'/'.$rw1->sku  ?>" target="_blank">
     <img src="<?php echo base_url().'images/product_img/'.'catalog_'.$image_cart[0]; ?>" width="30" alt="<?=$rw1->name ?>"></a></div>
    
    <div class="chckout-desc"> 
    <?php  $qr2=$this->db->query("select name from product_general_info where product_id='$rw1->product_id'");
   $rw2=$qr2->row(); 
   echo "<h3  class='product-name'>"."<a href="."'".base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($rw1->name))))."/".$rw1->product_id."/".$rw1->sku."'"."target=_blank>". $rw2->name ."</a>"."</h3> " ;
  
    $color_sizecronjobquery=$this->db->query("SELECT color,size,Capacity,RAM,ROM FROM  cornjob_productsearch WHERE sku='$rec_cart->sku' group by sku ");
   	if($color_sizecronjobquery->num_rows()>0)
	{
		$color_rw=$color_sizecronjobquery->row()->color;
		$size_rw=$color_sizecronjobquery->row()->size;
		$capacity=$color_sizecronjobquery->row()->Capacity;
		$ram=$color_sizecronjobquery->row()->RAM;
		$rom=$color_sizecronjobquery->row()->ROM;
	  
	   
		//if($rec_cart->prdt_color != ''){ echo "<span class='cart_attr'>Color : ".$rec_cart->prdt_color.'</span><br/>'; }
	//   	if($rec_cart->prdt_size != ''){ echo "<span class='cart_attr'>Size : ".$rec_cart->prdt_size.'</span><br/>';}
		
		if($color_rw != ''){ echo "<span class='cart_attr'>Color : ".$color_rw.'</span><br/>'; }
		if($size_rw != ''){ echo "<span class='cart_attr'>Size : ".$size_rw.'</span><br/>';}
		if($capacity != ''){ echo "<span class='cart_attr'>Capacity : ".$capacity.'</span><br/>';}
		if($ram != ''){ echo "<span class='cart_attr'>RAM : ".$ram.'</span><br/>';}
		if($rom != ''){ echo "<span class='cart_attr'>ROM : ".$rom.'</span><br/>';}
	}
  	
   $query_sellername=$this->db->query("select a.business_name,a.seller_id from seller_account_information a inner join product_master b on a.seller_id=b.seller_id where b.sku='$rec_cart->sku'");
   $count_row=$query_sellername->num_rows();
   if($count_row!=0){
   $rw_sellername=$query_sellername->row();
   
   ?>
   <!--<a onClick="gosellerReview(<?//= $rw_sellername->seller_id; ?>)" id="goslr" style="cursor:pointer !important;">-->
   <a href="<?php echo base_url() ;?>sellers/<?= base64_encode($this->encrypt->encode($rw_sellername->seller_id));?>" id="goslr" style="cursor:pointer !important;">
   <?php 
   echo "Seller : "."<span class='blue'>".$rw_sellername->business_name."</span>"; }
   else { echo "Seller:  moonboy ";}
   ?>
   </a>
   
   <!-- <div class="fulfill"> <img src="<?php// echo base_url()?>images/moon-fulfilled.png"  alt="">  </div>-->
    
    </div>
    <?php if($avail_qnt<=0 || $avail_status=='Disabled' || $avail_approve_status=='Inactive' || $seller_status!='Active') { if($avail_qnt<=0){?> <span style="background-color:#900; color:#FFF; font-weight:bold;">This Product is currently Out Of Stock. </span> <?php }else{ ?>
    <span style="background-color:#900; color:#FFF; font-weight:bold;">This Product is currently Discontinued. </span>
    <?php }} ?>
    <div class="clearfix"> </div>
    
   <span class="item-no"> <i class="fa fa-check-square-o"></i> 100% Refund / Replacement Guarantee*  </span>
   <!--<a href="<?php// echo base_url().'mycart/remove_from_cart/'.$rec_cart->addtocart_id; ?>" class="orange right"> <i class="fa fa-times-circle"> </i> Remove </a>-->
   
   <span class="orange right" style="cursor:pointer;" onClick="removeCartProduct('<?=$rec_cart->addtocart_id;?>');"> <i class="fa fa-times-circle"> </i> Remove </span>

     <div class="clearfix"></div>
    </td>

    <td align="center"> 
   
  
   
   <?php
      
	$user_id=$this->session->userdata['session_data']['user_id'];
	  $qr2=$this->db->query("select * from addtocart_temp  where product_id='$rec_cart->product_id' and user_id='$user_id' and sku='$rec_cart->sku' ");
   $rec_ct=$qr2->num_rows(); 
  // echo ($rec_ct);
   foreach($qr2->result() as $rw){
	 $product_id1=$rw->product_id;
	 $sku_id1=$rw->sku;
	 $session_id=$rw->addtocart_session_id;}
	$qr3=$this->db->query("select * from product_master where product_id='$product_id1' and sku='$sku_id1' ");
   $query=$qr3->num_rows(); 
  // echo ($rec_ct);  
  
   foreach($qr3->result() as $row1){
	 $product_id1=$row1->product_id;
	 $sku_id1=$row1->sku;
	 $quantity_table=$row1->quantity;}
	// echo ($quantity_table);  
   ?>
   
   
  <?php /*?> <?php 

 
   echo form_open_multipart('mycart/insert_detail/'.$product_id1.'/'.$sku_id1.'/'.$session_id.'/'.$user_id.'/'.$rec_ct.'/'.$rec_cart->addtocart_id.'/'.$quantity);

?><?php */?>
<?php 
if($this->session->flashdata('sl_number')==$sl){
if ($this->session->flashdata('message')) { ?>
            <div style="color:#F00;" id="message<?=$sl;?>"> <?= $this->session->flashdata('message') ?> </div>
           <?php }} ?>
 <?php if($avail_qnt>0 && $avail_status=='Enabled' && $avail_approve_status=='Active' && $seller_status=='Active') {?>         
   <input type="number" step="1" min="1" id="quantity_added<?=$sl;?>" name="quantity_added" value="<?php echo ($rec_ct); ?>" style="width:40px; height:30px;" /></br>
   <input type="button"  value="save" class="btn btn-primary" onClick="valid_function('<?=$product_id1;?>','<?=$sku_id1;?>','<?=$session_id;?>','<?=$user_id;?>','<?=$rec_ct;?>','<?=$rec_cart->addtocart_id;?>','<?=@$quantity_table;?>','<?=$sl;?>')" id="submit1<?=$sl;?>">
   <?php }else{ ?>
   <label><?php echo ($rec_ct); ?> </label>
   <?php } ?>
   
   
   
    </td>
    <td align="center">  
    <h4> Rs. <?php  $user_id=$this->session->userdata['session_data']['user_id'];
	  $qr3=$this->db->query("select * from addtocart_temp where product_id='$rec_cart->product_id' and user_id='$user_id' and sku='$rec_cart->sku'");  
	  //$row3=$qr3->row();
	  $price=0;
	  $ct_rec = $qr3->num_rows();
	  foreach($qr3->result() as $rw_price)
	  {
		  
		  $qr4=$this->db->query("select * from product_master where sku='$rw_price->sku'"); 
		  $rec4=$qr4->result();
		  
		  $cdate = date('Y-m-d');
		  $special_price_from_dt = $rec4[0]->special_pric_from_dt;
		  $special_price_to_dt = $rec4[0]->special_pric_to_dt;
		  
		  //calculatin tax amount//
		/*  $tax_class = $rec4[0]->tax_class;
		  $tax_sql = $this->db->query("SELECT tax_rate_percentage FROM tax_management WHERE tax_id='$tax_class'");
		  $tax_res = $tax_sql->row();
		  $tax_persent = $tax_res->tax_rate_percentage;
		  $taxdecimal = $tax_persent/100;*/
		  
		  //tax amount for product price
		  //$tax_amount = $rec4[0]->price*$taxdecimal;
		  
		  //tax amount for product special price
		  //$tax_amount_special = $rec4[0]->special_price*$taxdecimal;
		  ///calculating tax amount script end here///
		  
		  if($rec4[0]->special_price !=0){
			  if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
		  			$price= $price + $rec4[0]->special_price;
			  }else{
				  	if($rec4[0]->price != 0){
				    	$price= $price + $rec4[0]->price;
					}else{
						$price= $price + $rec4[0]->mrp;
					}
			  } //End of date condition
		  }else{
			  	if($rec4[0]->price != 0){
				    $price= $price + $rec4[0]->price;
				}else{
					$price= $price + $rec4[0]->mrp;
				}
		  } //End of date special_price!=0 condition
	  }
	  echo ceil($price/$ct_rec);
	  
	   ?> </h4>  </td>
   	<td align="center">  
    <?php
	if($rec4[0]->shipping_fee_amount!=0)
	{
		echo 'Shipping Fees Rs.'.$rec4[0]->shipping_fee_amount*$rec_ct;
	}
	 ?>
     <br>
     <span class="item-no">
     	<?php 
			$qr11 = $this->db->query("SELECT c.dispatch_days
			FROM seller_account a 
			INNER JOIN state b ON a.seller_state = b.state
			INNER JOIN dispatched_day_setting c ON b.state_id = c.state_id
			WHERE a.seller_id = '$rw_sellername->seller_id'");
			$ct11 = $qr11->num_rows();
			$res11 = $qr11->row();
			if($ct11 > 0){
				$days = $res11->dispatch_days+5; 
				   
				date_default_timezone_set('Asia/Calcutta');
				$dt =  date('d M', strtotime(+$days.'days'));
				echo "Standard delivery by ". $dt;
			}else{
				$dt1 =  date('d M', strtotime(+'12 days'));
				echo $dt1;
				//echo "Standard delivery by 10-12 Days";
			}
		?>
		
      </span>
     </td>
     <td align="center">
         <span class="price-blue">Rs.&nbsp; 
         	<?php
			$subtotal_price = 0;
			/*foreach($shipping_fee_data as $k => $v){
				if($k == $rw_sellername->seller_id){ echo $subtotal_price=$subtotal_price+$v*$rec_ct+ceil($price) ;}
			}*/
			echo $subtotal_price=$subtotal_price+$rec4[0]->shipping_fee_amount*$rec_ct+ceil($price) ;
			?>
         </span><br>
         <?php if($avail_qnt<=0 || $avail_status=='Disabled' || $avail_approve_status=='Inactive' || $seller_status!='Active') {?> <span style="color:#F00; font-weight:bold;">This Price Not Included</span> <?php } ?>
     </td>
 
  
  </tr><?php if($avail_qnt>0 && $avail_status=='Enabled' && $avail_approve_status=='Active' && $seller_status=='Active') { $total_price=ceil($total_price+$subtotal_price); }
  
  } //for loop end ?>
  <tr><td colspan="5" align="right" style="background-color:#f6f6f6;">Total Amount Payable: <span  style="font-size:18px; font-weight:bold;"> Rs. <?php echo " ". $total_price; ?> </span> </td></tr>
</table>

  </div>
  
  <div class="clearfix">&nbsp;</div> 
  
   
   <div class="col-md-6 cart-btns"> 
<button type="button" title="Continue Shopping" class="button btn-cart-big" onClick="window.location.href='<?php echo base_url() ?>'" > <i class="fa fa-angle-double-left"></i>
Continue Shopping</button> 
  <?php if($total_price>0){ ?> 
   <button type="button" title="Proceed To Checkout"  class="btn-big2" onClick="window.location.href='<?php echo base_url().'mycart/checkout_process' ?>'" > Proceed To Checkout </button> 
   <?php } ?>
   </div>
   
     
  <?php } ?>
  <!--<div class="line">&nbsp;</div>-->
<div class="clearfix">&nbsp;</div>


<div class="best-seller">
<h3 class="title4"> <span> Customers Who Bought Items in Your Cart Also Bought </span> </h3>
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

<!-- <div class="catlog-img">
 <div class="cat-img-warper"></div> </div> -->
<!-- <a href="<?php// echo base_url().'product_description/product_detail/'.str_replace(" ","-",strtolower($product->name)).'/'.$product->product_id.'/'.$product->sku  ?>" >-->
 <div class="view view-fifth">
 <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($product->name)))).'/'.$product->product_id.'/'.$product->sku  ?>" >
 
	<img src="<?php echo base_url();?>images/product_img/<?= $img[0];?>" width="184" height="154" alt="<?=$product->name;?>"></a></div>

   <div class="wish-list"> 
        <?php if($this->session->userdata('session_data')){ ?>            
            	<a href="#" class="link-wishlist wish_spn"  data-toggle="tooltip" title="Add To Wishlist" data-placement="right" onClick="addWishlistFunction(<?=$product->product_id; ?>,'<?=$product->sku; ?>')"><i class="fa fa-heart"></i></a>
            <?php }else{ ?>
            	<!--<a class="link-wishlist inline" href="#inline_content"  data-toggle="tooltip" title="Add To Wishlist"  data-placement="right"s> <i class="fa fa-heart"></i></a>-->
                <a class="link-wishlist wish_spn" onClick="addWishlistFunction_temp(<?=$product->product_id; ?>,'<?=$product->sku; ?>')" href="#"  data-toggle="tooltip" title="Add To Wishlist"  > <i class="fa fa-heart"></i></a>
                
            <?php } ?>
            
    </div>

    <div class="best-slr-data">
    
        <h2 class="product-name"><a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($product->name)))).'/'.$product->product_id.'/'.$product->sku  ?>" title="wallet"><?= substr($product->name,0,45).'...';?></a></h2>     
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
		
		//if(count($qr) != 0){
			//$count_1=$qr[0]->product1;
		
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
<?php //} //End of if condition?>
</div>

<!-- Recently Viewed -->
<!--<div class="recent-view">
<h3 class="title5"> Your Recently Viewed Items </h3>

<ul class="recently-viewed-product">
         <li class="prdct">
                <a href="#" title="wallet" class="product-image"><img src="<?php// echo base_url();?>images/pic1.jpg" width="85" height="85" alt="wallet" /></a>
                <div class="product-shop">          
                <h3 class="product-name"><a href="#" title="wallet">Wallet</a></h3>                                              
                <div class="price-box2"> <span class="regular-price"> Rs.699.00 </span> <span class="price">Rs.599.00</span> </div>
                <button type="button" title="Add to Cart" class="button btn-cart" >Add to Cart</button>               
               
                <ul class="star"> 
                <li> <i class="fa fa-star"> </i> </li>
                <li> <i class="fa fa-star"> </i> </li>
                <li> <i class="fa fa-star"> </i> </li>
                <li> <i class="fa fa-star"> </i> </li>
                <li> <i class="fa fa-star"> </i> </li>                   
                </ul>                              
            </div>
                 <div class="clearfix"></div>
         </li>
         <li class="prdct">
             <a href="#" title="ring" class="product-image"><img src="<?php echo base_url();?>images/pic2.jpg" width="85" height="85" alt="ring" /></a>
                <div class="product-shop">
               <h3 class="product-name"><a href="#" title="ring">Ring</a></h3>                                                                      
                <div class="price-box2"><span class="regular-price" >Rs.28,00.00  </span> <span class="price">Rs.24,00.00</span>  </div>
                <button type="button" title="Add to Cart" class="button btn-cart" > Add to Cart </button>
               <ul class="star"> 
                <li> <i class="fa fa-star"> </i> </li>
                <li> <i class="fa fa-star"> </i> </li>
                <li> <i class="fa fa-star"> </i> </li>
                <li> <i class="fa fa-star"> </i> </li>
                <li> <i class="fa fa-star"> </i> </li>
                    
                </ul>
                </div>
                  <div class="clearfix"></div>
          </li>
           <li class="prdct">
             <a href="#" title="ring" class="product-image"><img src="<?php echo base_url();?>images/pic3.jpg" width="85" height="85" alt="ring" /></a>
                <div class="product-shop">
               <h3 class="product-name"><a href="#" title="ring">Ring</a></h3>                                                                      
                <div class="price-box2"><span class="regular-price" > Rs.26,00.00 </span> <span class="price">Rs.25,00.00</span>  </div>
                <button type="button" title="Add to Cart" class="button btn-cart" > Add to Cart </button>
               <ul class="star"> 
                <li> <i class="fa fa-star"> </i> </li>
                <li> <i class="fa fa-star"> </i> </li>
                <li> <i class="fa fa-star"> </i> </li>
                <li> <i class="fa fa-star"> </i> </li>
                <li> <i class="fa fa-star"> </i> </li>
                    
                </ul>
                </div>
                  <div class="clearfix"></div>
          </li>
          <li class="prdct">
                <a href="#" title="Jeans" class="product-image"><img src="<?php echo base_url();?>images/pic4.jpg" width="85" height="85" alt="Jeans" /></a>
                <div class="product-shop">
                 
                        <h3 class="product-name"><a href="#" title="Jeans">Jeans</a></h3>
                        <div class="price-box2"> <span class="regular-price"> </span><span class="price">Rs.1,800.00</span > </div>
              <button type="button" title="Add to Cart" class="button btn-cart" > Add to Cart </button>
              <ul class="star"> 
                <li> <i class="fa fa-star"> </i> </li>
                <li> <i class="fa fa-star"> </i> </li>
                <li> <i class="fa fa-star"> </i> </li>
                <li> <i class="fa fa-star"> </i> </li>
                <li> <i class="fa fa-star"> </i> </li>
             </ul>
         </div> 
         
           <div class="clearfix"></div>
          </li>
                </ul>
            </div>    -->
  <!-- Recently Viewed -->              
              
         <div class="clearfix"> &nbsp;</div>  
         <div class="clearfix"> &nbsp;</div>
 
<!--<style>
#limg { background:rgba(255,255,255,0.7); /*position:absolute;*/ top:0;left:0px; z-index:10000000; position:fixed;}
.ldr-img{background:url(<?php echo base_url(); ?>images/lodr.gif) no-repeat top center; margin:25% 649px 70%; width:50px; height:50px;}
</style>-->
             
    <!-- footer Section -->
   <?php include "footer.php"; ?>

</div>  <!-- end warp -->
<!-----------------------------------------------------------Guest Cart Page Strat---------------------------------------------->
<?php }else{ ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content = "width = device-width, initial-scale =1.0, user-scalable = no">
		<meta name="<?php //echo $data->meta_descrp ;?>" content=""/>
        <meta name="<?php //echo $data->meta_keyword ;?>" content="" />
        <link rel="canonical" href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2)?>"/>
        
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

<!--<script>
$(document).ready(function(){
	$('#limg').css('display','none');
});
</script>-->

<script>
function removeCartProduct(rec_cart){
	//window.onload = $('#limg').css('display','block');
	window.location.href="<?php echo base_url();?>mycart/remove_from_tempcart/"+rec_cart;
}
</script>


<script>
 function valid_qtysave(txtboxsl,prod_sku)
{
	
	var qnt=$('#tmpquantity_added' + txtboxsl).val();
	 
		  
		  if(isNaN(qnt)){
		alert('Entered value is not a number,please enter a number');
		$('#tmpquantity_added' + txtboxsl).focus();
		return false;
	}
	if(qnt==''){
		alert('Enter quantity ');
		$('#tmpquantity_added' + txtboxsl).focus();
		return false;
	}
	if(qnt<=0){
		alert('Quantity should be greater than zero ');
		$('#tmpquantity_added' + txtboxsl).focus();
		return false;
	}
	$('#submit1'+txtboxsl).val('Wait..');
		$.ajax({
			url:'<?php echo base_url(); ?>mycart/update_tempprodqnt',
			method:'post',
			data:{prod_sku:prod_sku,prod_qnt:qnt},
			success:function(result){
				if(result == 'success'){
					window.location.reload(true);
				}
			}
		});
			
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
   $total_price=0;  $txtboxsl=0; 
   @$prodsku_arr=$this->session->userdata['addtocart_sku'];
   
   foreach($sku as $rec_cart){
	   
	   $prod_qnt=0;
	 foreach($prodsku_arr as $k=>$val)
	{	
		if($val==$rec_cart->sku)
		{$prod_qnt=$prod_qnt+1;}	
	}  
 ?>
  
  <tr>
  
   <td>
   <div class="checkout-img"> 
   <?php  
   //$image_cart=explode(',',$rec_cart->imag);
   //$qr1=$this->db->query("select b.image as imag ,b.catelog_img_url as catelog_img_url, c.product_id  from seller_product_master a INNER JOIN  seller_existingproduct_image b ON a.seller_exist_product_id=b.seller_extproduct_id INNER JOIN product_image c ON c.product_id=a.master_product_id
//   inner join product_master d on d.product_id=c.product_id inner join product_general_info e on e.product_id=e.product_id 
//		WHERE  a.sku='$rec_cart->sku'  AND c.sku='$rec_cart->sku' ");
   
   
   $qr1=$this->db->query("select d.name, b.image as imag , c.product_id, e.quantity,e.sku  from product_general_info d inner join seller_product_master a ON a.master_product_id=d.product_id
	   INNER JOIN  seller_existingproduct_image b ON a.seller_exist_product_id=b.seller_extproduct_id 
	   INNER JOIN product_image c ON c.product_id=a.master_product_id
	   INNER JOIN product_master e on d.product_id=e.product_id 
		WHERE  a.sku='$rec_cart->sku' ");
		
   if($qr1->num_rows()==0)
   {
   $qr1=$this->db->query("select a.imag,b.quantity,b.sku,c.name,b.product_id from product_image a inner join product_master b on a.product_id=b.product_id inner join product_general_info c on b.product_id=c.product_id where b.sku='$rec_cart->sku'");
   }
   $rw1=$qr1->row();
   $image_cart=explode(',',$rw1->imag);
   $avail_qnt=$rw1->quantity;
    ?>  <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($rw1->name)))).'/'.$rw1->product_id.'/'.$rw1->sku  ?>" target="_blank"><img src="<?php echo base_url().'images/product_img/'.'catalog_'.$image_cart[0]; ?>"> </a>
	</div>
    <div class="chckout-desc"> 
    <?php  $qr2=$this->db->query("select a.name from product_general_info a inner join product_master b on a.product_id=b.product_id  where b.sku='$rec_cart->sku'");
   $rw2=$qr2->row(); 
   echo "<h3 class='product-name'>"."<a href="."'".base_url().preg_replace('#/#',"-",str_replace(" ","-",strtolower($rw1->name)))."/".$rw1->product_id."/".$rw1->sku."'"." target=_blank>". $rw2->name ."</a>"."</h3> " ;
   
   
    $color_sizecronjobquery=$this->db->query("SELECT color,size,Capacity,RAM,ROM FROM  cornjob_productsearch WHERE sku='$rec_cart->sku' group by sku ");
	if($color_sizecronjobquery->num_rows()>0)
	{
		$color_rw=$color_sizecronjobquery->row()->color;
		$size_rw=$color_sizecronjobquery->row()->size;
		$capacity=$color_sizecronjobquery->row()->Capacity;
		$ram=$color_sizecronjobquery->row()->RAM;
		$rom=$color_sizecronjobquery->row()->ROM;
	  
	   
		//if($rec_cart->prdt_color != ''){ echo "<span class='cart_attr'>Color : ".$rec_cart->prdt_color.'</span><br/>'; }
	//   	if($rec_cart->prdt_size != ''){ echo "<span class='cart_attr'>Size : ".$rec_cart->prdt_size.'</span><br/>';}
		
		if($color_rw != ''){ echo "<span class='cart_attr'>Color : ".$color_rw.'</span><br/>'; }
		if($size_rw != ''){ echo "<span class='cart_attr'>Size : ".$size_rw.'</span><br/>';}
		if($capacity != ''){ echo "<span class='cart_attr'>Capacity : ".$capacity.'</span><br/>';}
		if($ram != ''){ echo "<span class='cart_attr'>RAM : ".$ram.'</span><br/>';}
		if($rom != ''){ echo "<span class='cart_attr'>ROM : ".$rom.'</span><br/>';}
	}
   $query_sellername=$this->db->query("select a.business_name,a.seller_id from seller_account_information a inner join product_master b on a.seller_id=b.seller_id  where b.sku='$rec_cart->sku'  ");
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
    <?php if($avail_qnt<=0) {?> <span style="background-color:#900; color:#FFF; font-weight:bold;">This Product is currently Out Of Stock, You Cannot Buy. </span> <?php } ?></br>
   <span class="item-no"> <i class="fa fa-check-square-o"></i> 100% Refund / Replacement Guarantee*  </span>
   <!--<a href="<?php// echo base_url().'mycart/remove_from_tempcart/'.$rec_cart; ?>"  class="orange right"> <i class="fa fa-times-circle"> </i> Remove </a>--> 
   
   <span class="orange right" style="cursor:pointer;" onClick="removeCartProduct('<?=$rec_cart->sku;?>');"> <i class="fa fa-times-circle"> </i> Remove </span>
   <div class="clearfix"></div>
    </td>
    <td>
    <?php  $qr2=$this->db->query("select a.description from product_general_info a inner join product_master b on a.product_id=b.product_id  where b.sku='$rec_cart->sku'");
   $rw2=$qr2->row(); 
   //echo  $rw2->description;
   echo str_replace('\\', '', $rw2->description); 
   ?>
    
    </td>
    <td align="center"> <?php
	//$ct=count($rec_cart);
	//echo $ct;
	//$user_id=$this->session->userdata['session_data']['user_id'];
	  //$qr2=$this->db->query("select * from addtocart_temp where product_id='$rec_cart->product_id' and user_id='$user_id' and sku='$rec_cart->sku' ");
//   $rec_ct=$qr2->num_rows(); 
   //echo  $rec_ct;
   
   ?>
   <?php if($avail_qnt>0) {?> 
   <input type="number" step="1" min="1" id="tmpquantity_added<?=$txtboxsl;?>" name="tmpquantity_added" value="<?php echo ($prod_qnt); ?>" style="width:40px; height:30px;" /></br>
   <input type="button"  value="save" class="btn btn-primary" onClick="valid_qtysave('<?=$txtboxsl;?>','<?=$rec_cart->sku;?>')" id="submit1<?=$txtboxsl;?>">  <?php }else { ?>
 <label><?php echo ($prod_qnt); ?> </label>
   <?php } ?> 
    </td>
    <td align="center">  
    <h4 class="price-blue" >Rs. <?php  //$user_id=$this->session->userdata['session_data']['user_id'];
	  $qr3=$this->db->query("select * from product_master  where sku='$rec_cart->sku'   ");  
	  
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
			
	  
	   echo $final_price = ceil($price*$prod_qnt);
	  
	   //========================================================
	   
	   ?> </h4>  
        <?php if($avail_qnt<=0) {?> <span style="color:#F00; font-weight:bold;">This Price Not Included</span> <?php } ?>
       
       </td>
      
  <?php  if($avail_qnt>0){ $total_price=$total_price+$final_price; } 
 // $j++; }
  $txtboxsl++;} //for loop end ?>
  
  </tr>

  <tr><td colspan="4" align="right"  style="background-color:#f6f6f6;">Total Amount Payable:  <span  style="font-size:18px; font-weight:bold;"> Rs. <?php echo " ". $total_price; ?> </span> </td></tr>
</table>

 
  <div class="clearfix">&nbsp;</div> 
    
   <div  class="col-md-6 cart-btns"> 
   <button type="button" title="Add to Cart"   class="button btn-cart-big" onclick="window.location.href='<?php echo base_url() ?>'" > <i class="fa fa-angle-double-left"></i>
Continue Shopping</button>
<?php if($total_price>0){ ?> 
<?php if($this->session->userdata('session_data')){ ?>

<button type="button" title="Proceed To Checkout" class="btn-big2" onclick="window.location.href='<?php echo base_url().'mycart/checkout_process' ?>'" >Proceed To Checkout  </button> 
<?php } else { ?>
   <a class='inline' href="#inline_content"> <button type="button" title="Proceed To Checkout" class="btn-big2" >Proceed To Checkout  </button> </a><?php }?>
 <?php } // total price>0 check consiton end ?>
   </div> 
   <?php }

    ?>
     
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
 <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($product->name)))).'/'.$product->product_id.'/'.$product->sku  ?>" >
 
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
    
        <h3 class="product-name"><a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($product->name)))).'/'.$product->product_id.'/'.$product->sku  ?>" title="wallet"><?= substr($product->name,0,45).'...';?></a></h3>     
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

<?php } ?>

>>