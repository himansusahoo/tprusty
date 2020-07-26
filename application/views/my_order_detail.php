<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content = "width = device-width, initial-scale =1.0, user-scalable = no">
		<meta name="<?php //echo $data->meta_descrp ;?>" content="">
        <meta name="<?php //echo $data->meta_keyword ;?>" content="" />

		<title><?php //echo $data->title ;?></title>

    <?php include "header.php" ; ?>	

<!--<script>
function cancel_order_valid(addtocart_id,order_id)
{
 //var conf=confirm('Do you want to cancel order ?');
 
 //if(conf)
// {
	 
	//window.location.href='<?php// echo base_url().'my_order/remove_from_myorder/'?>' + addtocart_id + '/' + order_id ;	 
 //}
 window.location.href='<?php// echo base_url().'orders'; ?>';	
}
</script>-->

<script>
function cancel_order_valid(){
	 window.location.href='<?php echo base_url().'orders'; ?>';
}
</script>


<!-- Google Code for Moonboy-Battery Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 935712555;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "QiYLCJ_VoWUQq66XvgM";
var google_conversion_value = 0.00;
var google_conversion_currency = "INR";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
<style>
.main-content {
    padding: 100px 0px 10px;
	width:95%;
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
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/935712555/?value=0.00&amp;currency_code=INR&amp;label=QiYLCJ_VoWUQq66XvgM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


<div class="main-content">
<!--<ul class="back"> <li><i class="back_arrow"> </i>Back to <a href="index.html">Men's Clothing</a></li> </ul>-->
<div class="clearfix">  </div>
<div  class="checkout" >
<table>
<tr>
<td width="auto" style="text-align:justify; "><span style="font-size:24px; font-weight:bold; color:#390">Thank You For Your Order!</span><br>
Your order has been placed and being processed.When the item(s) are shipped, you will receive an email with details.<br>
You can track this order through  <a href="<?php echo base_url(); ?>orders"> My Orders </a> page.
<br>
<br>


</td>

<td valign="top"><span style="font-size:20px; font-weight:bold"> <?php echo $cus_data->fname;  ?><?php echo " ". $cus_data->lname; echo "<br>"; ?> </span>
<span style="font-size:14px; font-weight:bold">Phone Number: <?php echo "  ". $cus_data->mob;  ?></span><br>


<?php echo $cus_data->address;  ?>

</td>

</tr>
</table>

</div>

<?php foreach($cart_data->result() as $rec_cart) { ?>
<span style="font-size:20px; font-weight:bold">Order ID: <?php echo $rec_cart->order_id; ?></span>
  <div  class="checkout" >
  <table width="100%" border="0" cellspacing="5">
  <thead class="tbl-title"> 
  <tr>
    <td width="35%"> Item </td>
    <td width="35%">Item Detail</td>
    <td> Qty </td>
    <td> Price </td>
    <td></td>
    <!--<td> Delivery Details  </td>
    <td> Subtotal </td>-->
   
  </tr>
  </thead>
  <?php $user_id=$this->session->userdata['session_data']['user_id'];
  $rder_query=$this->db->query("select * from ordered_product_from_addtocart where order_id='$rec_cart->order_id' and user_id='$user_id'  group by sku ");
  
  $total_price=0; foreach($rder_query->result() as $rec_cart1){ ?>
  <tr>
  
   <td> <div class="checkout-img">  
   <?php  
   //$image_cart=explode(',',$rec_cart->imag);
   $qr1=$this->db->query("SELECT a.product_id, a.name, b.sku, c.imag FROM product_general_info a INNER JOIN product_master b on a.product_id = b.product_id INNER JOIN product_image c on a.product_id = c.product_id WHERE a.product_id='$rec_cart1->product_id'");
   $rw1=$qr1->row();
   $image_cart=explode(',',$rw1->imag);
    ?> 
    <a href="<?php echo base_url().str_replace(" ","-",strtolower($rw1->name)).'/'.$rw1->product_id.'/'.$rw1->sku ?>" >
    		<img src="<?php echo base_url().'images/product_img/'.$image_cart[0]; ?>" width="30" alt="<?=$rw1->name;?>"></a>
        </div>
    <div > 
    <?php  $qr2=$this->db->query("select name from product_general_info where product_id='$rec_cart1->product_id'");
   $rw2=$qr2->row(); 
   ?>
   <a href="<?php echo base_url().str_replace(" ","-",strtolower($rw1->name)).'/'.$rw1->product_id.'/'.$rw1->sku ?>" >
   	<b><?=$rw2->name?></b>
   </a>
   <br/>
   
   <?php
    if($rec_cart1->prdt_color != 'not'){ echo "<span class='cart_attr'>Color : ".$rec_cart1->prdt_color.'</span><br/>'; }
   	if($rec_cart1->prdt_size != 'not'){ echo "<span class='cart_attr'>Size : ".$rec_cart1->prdt_size.'</span><br/>';}
  
   $query_sellername=$this->db->query("select a.business_name from seller_account_information a inner join product_master b on a.seller_id=b.seller_id  where b.sku='$rec_cart1->sku'  ");
   $count_row=$query_sellername->num_rows();
   if($count_row!=0){
   $rw_sellername=$query_sellername->row();
    
//    print_r($rw_sellername->business_name);}
   echo "<br>"."Seller Name: ". $rw_sellername->business_name; }
   else { echo "<br>"."Seller Name: ".COMPANY;}
   ?>
    </div>
    <div class="clearfix"></div>
    </td>
    <td>
    <?php  $qr2=$this->db->query("select description from product_general_info where product_id='$rec_cart1->product_id'");
   $rw2=$qr2->row(); 
   //echo  $rw2->description;
   if(strlen($rw2->description) > 120){ echo substr(str_replace('\\', '',$rw2->description),0,120).'...';}else{ echo str_replace('\\', '',$rw2->description);}
   
   ?>
    
    </td>
    <td> <?php
	  

	echo $rec_cart1->quantity;
   
   ?>
    </td>
    <td>  
    <h4 class="catalog-price" > <i class="fa fa-inr" style="font-size:20px; padding-right:5px;"></i>
	  <?php  echo $rec_cart1->sub_total_amount;
	  
	   ?> </h4>  </td>
       
       <td>
   <a href="#" onClick="cancel_order_valid('<?php echo $rec_cart1->addtocart_id ?>','<?php echo $rec_cart1->order_id ?>')"> <i class="fa fa-times-circle"> Cancel Order </i>
 </a>
  
  </td>
   
  </tr><?php } ?>
  <tr><td colspan=5 align="right" style="font-size:18px; font-weight:bold;">Total Amount :  <i class="fa fa-inr" ></i> <?php echo " ". $rec_cart->Total_amount; ?> </td></tr>
</table>

  </div>
  
 
  
  <div class="clearfix">&nbsp;</div>  <?php } ?>
  
   
   <div class="col-md-3 right" style="margin-top:15px;"> 
   <?php /*?><button type="button" title="Add to Cart" class="button btn-cart-big" onClick="window.location.href='<?php echo base_url() ?>'" >Continue Shopping</button><?php */?> &nbsp;  &nbsp; &nbsp; &nbsp;&nbsp;  &nbsp; &nbsp; &nbsp;&nbsp;  &nbsp; &nbsp; &nbsp;&nbsp;  &nbsp; &nbsp; &nbsp;
   <button type="button" title="Add to Cart" class="button btn-cart-big" onClick="window.location.href='<?php echo base_url().'orders'; ?>' ">Track Orders</button> 
   
   <!--<p> <a href="#"> <h4> <u> Checkout with Multiple Addresses </u> </h4> </a> </p>-->
   
   </div>
   
     
  <div class="clearfix">&nbsp;</div>
  
  
  
  
  
  
  <!--<div class="line">&nbsp;</div>-->
<div class="clearfix">&nbsp;</div>



  </div> <!-- end main content -->
    
    <!-- footer Section -->
   <?php include "footer.php"; ?>


</div>  <!-- end warp -->




