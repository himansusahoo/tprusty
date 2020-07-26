<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
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
 <div class="wrap">
      <div class="info-inner">
	  <div class="section-info">
 
    <!--/msg-->
    <div class="success-msg">


<?php if($cart_data[0]->order_status=='Success') {?>
<span style="font-size:16px; font-weight:bold; color:#390">Thank You For Your Order!</span><br>
Your order has been placed and being processed.When the item(s) are shipped, you will receive an email with details.<br>
You can track this order through  <a href="<?php echo base_url(); ?>orders"> My Orders </a> page.
<br>
<br>
<div style="font-size:16px; font-weight:bold; ">
Bank Reference Number: <?php echo $cart_data[0]->bank_ref_no;  ?><br>
Payment Mode: <?php echo $cart_data[0]->payment_mode;  ?><br>
Bank Name: <?php echo $cart_data[0]->card_name;  ?><br>
Payment Status: <?php echo $cart_data[0]->order_status;  ?><br>

</div>
<?php }else { ?>

<span style="font-size:16px; font-weight:bold; color:#F00;">
Your order has been placed and cannot process due to failed in online payment.<br>
You can revise online payment through  <a href="<?php echo base_url(); ?>orders"> My Orders </a> page.</span>
<br>
<br>
<div style="font-size:16px; font-weight:bold; ">
Bank Reference Number: Not available<br>
Payment Mode: <?php echo $cart_data[0]->payment_mode;  ?><br>
Bank Name: <?php echo $cart_data[0]->card_name; ?><br>
Payment Status: <?php echo $cart_data[0]->order_status;  ?><br>

</div>


<?php } ?>
<span style="font-size:16px; font-weight:bold"> <?php echo $cus_data->fname;  ?><?php echo " ". $cus_data->lname; echo "<br>"; ?> </span>
<span style="font-size:16px; font-weight:bold">Phone Number: <?php echo "  ". $cus_data->mob;  ?></span><br>


<?php echo $cus_data->address;  ?>

</div>
    <!--/msg-->

	<div class="order">
<?php foreach($cart_data as $rec_cart) { ?>
 <div class="list">
 <div class="cart_box">
                          
   <h4 class="o-id">Order ID: <?php echo $rec_cart->order_id; ?></h4>

  <?php $user_id=$this->session->userdata['session_data']['user_id'];
  $rder_query=$this->db->query("select * from ordered_product_from_addtocart where order_id='$rec_cart->order_id' and user_id='$user_id'  group by sku ");
  
  $total_price=0; foreach($rder_query->result() as $rec_cart1){ ?>
   <div class="message">
   <div class="list_img"> 
   <?php  
   //$image_cart=explode(',',$rec_cart->imag);
   $qr1=$this->db->query("select imag from product_image  where product_id='$rec_cart1->product_id'");
   $rw1=$qr1->row();
   $image_cart=explode(',',$rw1->imag);
   
    ?> <img src="<?php echo base_url().'images/product_img/'.$image_cart[0]; ?>" width="" class="img-responsive"></div>
    
    <div class="list_desc">
    <?php  $qr2=$this->db->query("select name from product_general_info where product_id='$rec_cart1->product_id'");
   $rw2=$qr2->row(); 
   echo "<h4>". $rw2->name ."</h4>" ;
  
   $query_sellername=$this->db->query("select a.business_name from seller_account_information a inner join product_master b on a.seller_id=b.seller_id  where b.sku='$rec_cart1->sku'  ");
   $count_row=$query_sellername->num_rows();
   if($count_row!=0){
   $rw_sellername=$query_sellername->row();
    
//    print_r($rw_sellername->business_name);}
   echo "<span class='sphng'> Seller Name: </span> ". $rw_sellername->business_name; }
   else { echo "<br>"."Seller Name : ".COMPANY;}
   ?>
   <br>
    <div class="clearfix"></div>
  
   <p> <?php  $qr2=$this->db->query("select description from product_general_info where product_id='$rec_cart1->product_id'");
   $rw2=$qr2->row(); 
  // echo  $rw2->description;
   
   ?>
    </p>
    <span class="two-half"> Quantity : <?php
	  
	echo $rec_cart1->quantity;
   
   ?>
    </span>
    
    <div class="actual" > <span> Rs.

	  <?php  echo $rec_cart1->sub_total_amount;
	  
	   ?> </span> </div>  
    <div class="clearfix"></div>    
  <div class="gray-sml-btn"> <a href="#" onClick="cancel_order_valid('<?php echo $rec_cart1->addtocart_id ?>','<?php echo $rec_cart1->order_id ?>')"> <i class="fa fa-times-circle"> Cancel Order </i> </a> </div>
  
  <?php } ?>
 

  </div>
  <div class="clearfix"></div>
  
   
  <div class="cart-total">
  <div class="total_left"> Total Amount :  </div>
  <div class="total_right"> Rs. <?php echo " ". $rec_cart->Total_amount; ?>  </div>
  <div class="clearfix"> </div>
  </div>
  
  <div class="clearfix"></div>  <?php } ?>
  
   
   <div class="col-md-3 right" style="margin-top:15px;"> 
   <?php /*?><button type="button" title="Add to Cart" class="button btn-cart-big" onClick="window.location.href='<?php echo base_url() ?>'" >Continue Shopping</button><?php */?> 
   <button type="button" title="Add to Cart" class="btn btn-success" onClick="window.location.href='<?php echo base_url().'orders'; ?>' ">Track Orders</button> 
   

   
   </div>
   
     
  <div class="clearfix">&nbsp;</div>
  
 


  </div> 
    
   

</div>  
</div>

</div>

</div>
</div>
</div>
 <?php include "footer.php"; ?>

