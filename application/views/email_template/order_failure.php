<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="initial-scale=1.0"/>
<meta name="format-detection" content="telephone=no">
<title>Moonboy.in - Shop Your Heart Out!</title>  

<style type="text/css">

/* Resets: see reset.css for details */
html{width: 100%;margin:0; padding:0; }
body {margin:0; padding:0; font-family: Arial,Tahoma, Helvetica, sans-serif; background-color:#eeeeee; }
table {border-spacing:0;}
img{display:block !important; outline:none; text-decoration:none; border:none; height: auto; line-height: 100%;}
p{padding: 0; margin: 0; font-size:12px; line-height:20px;}
table td, table tr { border-collapse: collapse; } a{text-decoration:none;}
table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; font-size:12px; }
.logo{width:150px; float:left;} .container-social{width:200px; float:right;}
.nav{color:#fff; padding:5px; text-decoration:none; display:block; font-size:12px;}
.f-nav{color:#fff; padding:5px; text-decoration:none; display:inline-block; font-size:12px;}
.gretings{ padding-bottom:0px;} .status{padding-top:0px;}
.notice{ background-color:#ffeaef; border:1px solid #5c0116; padding:5px; text-align:center; font-size:12px;}
.container-social tr td{padding-top:3px;} .prdct-dtls tr td{padding:5px;}

@media only screen and (max-width: 640px){
  table[class="container"], td[class="container"]{ width: 100%!important; }
  }

@media only screen and (max-width: 490px){
  .container-social,.logo{ float:none; text-align:center; margin:5px auto; }
}
</style>
  
</head>

<body>
  <div  style="background-color:#eeeeee;margin: 0; width:100%; padding:10px 0; ">
    <table border="0" cellspacing="0" cellpadding="0" style="width:450px; background-color: #ffffff; border-top:3px solid #25203b;" align="center" class="container">
      <tr>
        <td align="center" valign="top" style="padding:10px;">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" >

            <tr>
              
             <td align="center" valign="top" width="100%">

               <!-- logo -->
                <div class="logo">
                   <img src="https://www.moonboy.in/images/logo.png" alt="logo"  hspace="0" vspace="0" width="150" style="border:none;"/>
                </div>
                <!-- end logo -->

                <!-- social icons -->
                <div class="container-social">
                      <table border="0" cellspacing="0" cellpadding="5" align="center">
                        <tr>
                    <td align="left" valign="middle">
                      <a href="https://www.facebook.com/MoonboyIN/"  target="blank_">
                      <img src="https://www.moonboy.in/images/facebook-icon.png" alt="" width="28" style="border:none;" vspace="0" /></a>
                    </td>
                    <td align="left" valign="middle">
                       <a href="https://twitter.com/moonboy_ltd"  target="blank_">
                       <img src="https://www.moonboy.in/images/twitter-icon.png" alt="" width="28"  style="border:none;" vspace="0" /></a>
                    </td>
                    <td align="left" valign="middle">
                       <a href="https://plus.google.com/107116566163445169044"  target="blank_" >
                       <img src="https://www.moonboy.in/images/google-icon.png" alt="" width="28"  style="border:none;" vspace="0" /></a>
                    </td>
                    <td align="left" valign="middle">
                       <a href="http://in.linkedin.com/in/moonboy"  target="blank_" >
                       <img src="https://www.moonboy.in/images/linkedin-icon.png" alt="" width="28"  style="border:none;" vspace="0" /></a>
                     </td>      
                    <td align="left" valign="middle">
                       <a href="https://www.pinterest.com/moonboy_ltd/"  target="blank_">
                       <img src="https://www.moonboy.in/images/pinit-icon.png" alt="" width="28"  style="border:none;" vspace="0" /></a>
                    </td>
                    </tr>
                      </table>
                </div>   
                <!-- end social icons -->         
                 
              </td> 
              
            </tr>

          </table>       
                  
          <!-- start layout-1 block -->

          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <!-- start space -->
            <tr>
              <td valign="top" height="14">
              </td>
            </tr>
            <!-- end space -->
          </table>


          <table width="100%" bgcolor="#25203b" border="0" cellspacing="0" cellpadding="0" align="center">
            <tr>
           <td align="center" style="padding-bottom:3px;"> <span class="nav"><img src="https://www.moonboy.in/images/original_products.png" width="20" height="20" alt="" style="float:left;" /> Original Products </span> </td>
              <td align="center" style="padding-bottom:3px;"> <span class="nav"><img src="https://www.moonboy.in/images/cash_on.png" width="20" height="20" alt="" style="float:left;"/> Cash On Delivery </span> </td>
              <td align="center" style="padding-bottom:3px;"> <span class="nav"><img src="https://www.moonboy.in/images/easy_returns.png" width="20" height="20" alt="" style="float:left;" /> Easy Return </span> </td>
              <td align="center" style="padding-bottom:3px;"> <span class="nav"><img src="https://www.moonboy.in/images/secure_pay.png" width="20" height="20" alt="" style="float:left;" /> Secured Payment  </span> </td>
            </tr>      
          </table>
<?php 

	$query_paymentinfo=$this->db->query("SELECT a.*,b.bank_ref_no,b.payment_mode,b.card_name,b.order_status FROM order_info a inner join payment_by_ccavenue_info b on a.order_id_payment_gateway=b.order_id  WHERE a.order_id='$order_id' and (a.order_status='Order confirmed' or a.order_status='Failed' ) ");
										$cart_data=$query_paymentinfo->result();
										
										$query_cusdata=$this->db->query("select a.mob,a.fname,a.lname, a.email,a.mob,b.* from user a inner join user_address b on a.user_id=b.user_id where a.user_id=$user_id and a.address_id=b.address_id  ");
										$cus_data=$query_cusdata->row();

 ?>      

          <!-- start hor-line -->
          <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
            <!--start space height --> 
            <tr>
              <td height="24"></td>
            </tr>
             <tr>
             <td>
               <p class="gretings"> <strong> Hi  <?php echo $cus_data->fname." ".$cus_data->lname  ?>,</strong>   <br /> <br /> </p>

               <p class="gretings"> Thank you for your order! <br />  <br /> </p>
               <p> Your order has been placed and cannot process due to failed in online payment.<br>
					You can revise online payment through<a href="https://www.moonboy.in" target="_blank" style="color:#6cb702; font-weight:bold; text-decoration:underline;">  My Orders</a>
<!--               <a href="http://www.moonboy.in" style="color:#6cb702; font-weight:bold; text-decoration:underline;" target="_blank">TRACK ORDER</a>.
-->              </p>
               <br /> <br />
              <p class="status"> Please find below, the summary of your order with Order ID <strong><?=$order_id?> </strong></p>
             <?php if(count($cart_data)!=0){ ?>
              <p class="status">
                Bank Reference Number: <?php  echo $cart_data[0]->bank_ref_no;  ?><br>
                Payment Mode: <?php echo $cart_data[0]->payment_mode;  ?><br>
                Bank Name: <?php echo $cart_data[0]->card_name;  ?><br>
                Payment Status: <?php echo $cart_data[0]->order_status;  ?><br>

				</p>
                <?php } ?>

                </td>
               </tr> <tr> <td height="24"></td>  </tr>

                <tr>
                
                <td>
                <table border="1" width="100%" class="prdct-dtls">
                <?php $rder_query=$this->db->query("select * from ordered_product_from_addtocart where order_id='$order_id' and user_id='$user_id'  group by sku ");
  
  $total_price=0; foreach($rder_query->result() as $rec_cart){ ?>
  
                <tr>
                <td> Seller : 
                	<?php $query_sellername=$this->db->query("select a.business_name from seller_account_information a inner join product_master b on a.seller_id=b.seller_id  where b.sku='$rec_cart->sku'  ");   
   $rw_sellername=$query_sellername->row(); 
   
   	echo $rw_sellername->business_name;
   ?>              
                 </td>
                 
                <td > 
				<?php $qr1=$this->db->query("select imag from product_image  where product_id='$rec_cart->product_id'");
   					  $rw1=$qr1->row();
   					  $image_cart=explode(',',$rw1->imag);
   
    ?> <img src="<?php echo base_url().'images/product_img/'.$image_cart[0]; ?>" width="50px" height="50px" style="float:left;">
				<?php $qr2=$this->db->query("select name from product_general_info where product_id='$rec_cart->product_id'");
   					$rw2=$qr2->row();  
   			        echo $rw2->name;
   					?>
   
   			</td>
                <td> Item Price  <strong> Rs.(<?php echo $rec_cart->sub_total_amount/$rec_cart->quantity; ?>) </strong></td>
                <td> Qty <?php echo $rec_cart->quantity; ?>  </td>
                <td> <strong>Subtotal </strong>  Rs. <?php echo $rec_cart->sub_total_amount; $total_price=$total_price+ $rec_cart->sub_total_amount; ?></td>
                </tr>
                <tr> 
                <?php } ?>
                <td colspan="5" align="right">
                <span style="font-size:16px;"><strong>Total  Rs. <?=$total_price;?>  </strong></span>
                </td>
                </tr>
                </table>
                </td>
                </tr>
            <tr>
            <td>
              <p class="status">
               <br /> 
                  <strong> <?php echo $cus_data->fname." ".$cus_data->lname;  ?> </strong>  <br />
                  <?php if($cus_data->mob!='') {?><strong>PHONE NO.:</strong> <?=$cus_data->mob;?> <br /> <?php }?>
                  <strong style="color:#6cb702;">DELIVERY ADDRESS: </strong> <br />
                  <?php echo $cus_data->address;  ?>                  
                 </p>

             </td>
             </tr>
        <tr>
        <td height="28"></td>
      </tr>
             <tr>
             <td>
             <p> <strong>Thanks & Regards,</strong> <br />
                       Moonboy Team </p>
             </td>
             </tr>

          </table>
          <!-- start hor-line -->

          
    


    <!-- start layout-6 container -->
    <table border="0" cellspacing="0" cellpadding="0" style="width:100%; background-color: #ffffff;" align="center" class="container">
      <!--start space height --> 
      <tr>
        <td height="28"></td>
      </tr>
      <!--end space height -->      
      <tr>
        <td valign="top" style="padding: 0 10px;" bgcolor="#f3f3f3">
       <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
         <td align="center" valign="top" style="padding: 10px 3px; margin: 0; font-size: 13px;line-height: 18px; color:#3a3f50;">
           You're receiving this email because you signed up for <strong>moonboy.in</strong>. 
         </td>
         </tr>
          </table>
        </td>
      </tr>      
      <!--start space height --> 
      <tr>
        <td height="28"></td>
      </tr>
      <!--end space height -->
    </table>
    <!-- end layout-6 container -->

    <!-- start layout-7 container -->
    <table border="0" cellspacing="0" cellpadding="0" style="width:100%; background-color: #25203b;" align="center">
      <tr>
        <td valign="top">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
            <tr>
            
			 <td height="25" align="center" class="ftr-nav">
<a href="https://www.moonboy.in/about-us" class="f-nav" target="blank_"> About Us |</a>
<a href="https://www.moonboy.in/privacy-policy" class="f-nav" target="blank_"> Privacy Policy |</a>
<a href="https://www.moonboy.in/contact-us" class="f-nav" target="blank_"> Faqs | </a>
<a href="https://www.moonboy.in/terns-and-conditions" class="f-nav" target="blank_"> Terms |</a>
<a href="https://www.moonboy.in/return-policy" class="f-nav" target="blank_"> Return Policy</a>
              </td>
              </tr>
              <tr>
               <td align="center" valign="middle" class="copy" style="text-transform:uppercase; text-align:center; color:#fff; font-size:12px; padding: 2px; margin: 0;">
                &copy; <strong>moonboy.in</strong></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <!-- end layout-7 container -->


    </td>
      </tr>
    </table>
  </div>
</body>
</html>
            
              