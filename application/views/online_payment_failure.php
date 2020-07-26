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
	
		
	

<script>
function cancel_order_valid(addtocart_id,order_id)
{
 //var conf=confirm('Do you want to cancel order ?');
 
 //if(conf)
// {
	 
	//window.location.href='<?php //echo base_url().'my_order/remove_from_myorder/'?>' + addtocart_id + '/' + order_id ;	 
 //}
 
 window.location.href='<?php echo base_url().'orders'; ?>';	
	
}

</script>
<div class="main-content">
<!--<ul class="back"> <li><i class="back_arrow"> </i>Back to <a href="index.html">Men's Clothing</a></li> </ul>-->
<div class="clearfix">  </div>

<div  class="checkout" >

<table>
<tr>
<td width="auto" style="text-align:justify; "><span style="font-size:24px; font-weight:bold; color:#390">Thank You For Your Order!</span><br>
Your order has been placed and cannot process due to failure of Online Payment Process<br>
Please Revise your payment process In <a href="<?php echo base_url(); ?>orders"> My Orders </a> page.
<br>
<br>
<div style="font-size:18px; font-weight:bold; ">

Payment Mode: <?php echo $cart_data[0]->payment_mode;  ?><br>
Card Name: <?php echo $cart_data[0]->card_name;  ?><br>
Payment Status: <?php echo $cart_data[0]->order_status;  ?><br>

</div>

</td>

<td valign="top"><span style="font-size:20px; font-weight:bold"> <?php echo $cus_data->fname;  ?><?php echo " ". $cus_data->lname; echo "<br>"; ?> </span>
<span style="font-size:14px; font-weight:bold">Phone Number: <?php echo "  ". $cus_data->mob;  ?></span><br>


<?php echo $cus_data->address;  ?>

</td>

</tr>
</table>

</div>

<?php foreach($cart_data as $rec_cart) { ?>
<span style="font-size:20px; font-weight:bold">Order ID: <?php echo $rec_cart->order_id; ?></span>
  <div  class="checkout" >
  <table width="100%" border="0" cellspacing="5">
  <thead class="tbl-title"> 
  <tr>
    <td width="35%"> Item </td>
    <td width="35%">Item Detail </td>
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
   $qr1=$this->db->query("select imag from product_image  where product_id='$rec_cart1->product_id'");
   $rw1=$qr1->row();
   $image_cart=explode(',',$rw1->imag);
   
    ?> <img src="<?php echo base_url().'images/product_img/'.$image_cart[0]; ?>" width="30"></div>
    <div > 
    <?php  $qr2=$this->db->query("select name from product_general_info where product_id='$rec_cart1->product_id'");
   $rw2=$qr2->row(); 
   echo "<b>". $rw2->name ."</b>" ;
  
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
   echo  $rw2->description;
   
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




