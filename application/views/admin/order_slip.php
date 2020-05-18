<style type="text/css">
*{padding:0px; margin:0px;}
.content{width:80%; margin:10px auto; font-family:"Calibri", Arial, Helvetica, sans-serif;} 
.heading{background-color:#000; font-size:18px; color:#fff; padding:8px 5px; font-weight:bold;}
.content table{margin:10px 0px;  width:100%;}
.content table tr td{font-size:16px; line-height:22px; padding:10px;}
.data-table tr td{border-bottom:1px solid #333;}


</style>
<link href="<?php echo base_url();?>css/frontend/font-awesome.css" rel="stylesheet">
<div class="main">
<h1> Order </h1>

<div> 
<table style="background-color:#f9f9f9; border:1px dashed #ccc; padding:5px;">
<tr><td><h3>Delivery Address</h3></td></tr>
<tr><td>
<?php $qr=$this->db->query("select * from shipping_address where order_id='$orderid' "); 
	$rw=$qr->row();
echo $rw->full_name.'<br>';
echo $rw->address.'<br>';
echo $rw->city;echo ",". $rw->pin_code.'<br>';
echo $rw->country.'<br>';
echo $rw->phone.'<br>';

 ?>


</td></tr>
</table>

<table style="background-color:#f9f9f9; border:1px dashed #ccc; padding:5px;">
<tr><td colspan="2"><h3>Buyer Detail</h3></td></tr>

<tr>
<td> 
 <?php $qr2=$this->db->query("select a.fname, a.lname,a.mob,a.email from user a inner join ordered_product_from_addtocart b on a.user_id=b.user_id where b.order_id='$orderid' group by b.order_id "); 
	$rw2=$qr2->row();
echo $rw2->fname." ". $rw2->lname;
 ?>
 <br />
 Phone No.:<?php echo $rw2->mob ?><br />
											
 <?php //$qr2=$this->db->query("select a.fname, a.lname,a.mob,a.email from  user a inner join ordered_product_from_addtocart b on a.user_id=b.user_id  where b.order_id='$orderid' group by b.order_id ");
																		
									$qr4=$this->db->query("select a.address,a.city,a.state,a.country,a.pin_code,d.state from user_address a inner join user b on a.address_id=b.address_id inner join  ordered_product_from_addtocart c on b.user_id=c.user_id inner join state d on a.state=d.state_id where c.order_id='$orderid' group by c.order_id  ");
																		 
											$rw4=$qr4->row();
											echo $rw4->address;				
											
                                    ?>
                                    <br />
                                    <?php echo $rw4->city; ?> ,
                                   <?php echo $rw4->state; ?><br />
                                   <?php echo $rw4->country; ?>, 
                                   <?php echo $rw4->pin_code; ?><br />
                                   

</td>


<td style="text-align:center; font-size:10px;border-left:1px solid #ccc;">
Order ID: <?php echo $orderid; ?><br />
Order Date : 
<?php $qr1=$this->db->query("select * from order_info where order_id='$orderid' "); 
	 $rw1=$qr1->row();
	 echo substr($rw1->date_of_order,0,10); 
	 ?>
</tr>
</table>

<div style="clear:both;"></div>


<table style="background-color:#f9f9f9; border:1px dashed #ccc; padding:5px;">
<tr><td><h3>Sold By</h3></td></tr>
<tr>


<td style="text-align:left; font-size:10px;">

<?php
$sql = $this->db->query("SELECT a.business_name,a.tin,b.seller_address,b.seller_city,b.seller_state,b.pincode,a.display_name FROM seller_account_information a INNER JOIN seller_account b ON a.seller_id=b.seller_id INNER JOIN ordered_product_from_addtocart c ON a.seller_id=c.seller_id INNER JOIN order_info d ON c.order_id=d.order_id WHERE d.order_id='$orderid' GROUP BY c.order_id");
$rslt = $sql->result();
?>
<?= $rslt[0]->business_name;?><br/>
<?= $rslt[0]->seller_address;?>,<br/>
<?= $rslt[0]->seller_city;?>,<br/>
<?= $rslt[0]->seller_state;?>, <?= $rslt[0]->pincode;?><br/>

<?= 'VAT/TIN Number: '.$rslt[0]->tin;?><br/>
</td>

</tr>
</table>

<div style="clear:both;"></div>


<table cellspacing="0" cellpadding="0" style="border:1px solid #000;" class="data-table">

<tr>
									<th class="heading"> Product Name </td>	
								
									
									
									<th class="heading"> Quantity </td>
									
									<th class="heading">Price(Without Tax) </th>
                                    <th class="heading">Shipping Fees </th>
									<th  class="heading"> Tax Rate </th>
									<th class="heading"> Total Price</th>
									
									
									
								</tr>
                                <?php 
								$total_price=0;
								 $qr5=$this->db->query("select * from ordered_product_from_addtocart where order_id='$orderid' group by sku"); 
										foreach($qr5->result() as $rw5)
									{								
								
								?>
                                <tr >
									<td style="width:45%;">                         
                                    
                                <div style="float:left; width:83%;">  <?php  $qr7=$this->db->query("select name from product_general_info where product_id='$rw5->product_id'");
											   $rw7=$qr7->row(); 
											   echo "<b>". $rw7->name ."</b>" ; ?> <br>
                                               <?php
                                                if($rw5->prdt_color != 'not'){ echo "<span class='cart_attr'>Color : ".$rw5->prdt_color.'</span><br/>'; }
   												if($rw5->prdt_size != 'not'){ echo "<span class='cart_attr'>Size : ".$rw5->prdt_size.'</span><br/>';}
												?>
                                              
                                       </div>
                                               <div class="clearfix"></div>
                                      </td>	
								
									
									
									<td>  <?php  $qr9=$this->db->query("select * from ordered_product_from_addtocart where product_id='$rw5->product_id' and                                                 sku='$rw5->sku' and order_id='$orderid'  ");  
								  //$row3=$qr3->row();
								  $price=0;
								  $rw9=$qr9->row(); 
								echo  $rw9->quantity; ?>  </td>
									
									<td> <?php
									
									
								  $tax_amt=$rw9->sub_tax_rate;
								  $shipping_amnt=$rw9->sub_shipping_fees;
								  $qtn=$rw9->quantity;
								  
								  $tax_percentage=round((100/$rw9->sub_total_amount)*$tax_amt,2);
								  
								  $single_prod_price_without_tax=round(($rw9->sub_total_amount-$shipping_amnt)-$tax_amt);
								  
								  
								echo "Rs.".$single_prod_price_without_tax;
									
									 ?>  </td>
                                     <td><?= "Rs.".$shipping_amnt ?></td>
									<td> <?php  echo "Rs.".round($rw9->sub_tax_rate)."(". $tax_percentage."%)" ; ?>   </td>
									<td>  <?php echo "Rs.".$rw9->sub_total_amount; ?> </td>
							
									
								</tr>
                                
                                <?php } ?>
                                
          <tr><td colspan="5" style="text-align:right; border-right:1px solid #333;">Total Amount (Including Tax & Shipping Fees)</td><td>Rs.<?php 
								
								$qr12=$this->db->query("select * from order_info where order_id='$orderid' ");  
									  $rec12=$qr12->result();
									  echo  $rec12[0]->Total_amount;
								  ?> </td> </tr>
                                        
         <!-- <tr><td colspan="4" style="text-align:right; border-right:1px solid #333;">Tax</td><td> <i class="fa fa-inr"></i></td></tr>
          <tr><td colspan="4" style="text-align:right; border-right:1px solid #333;">Shipping Rate</td><td> <i class="fa fa-inr"></i></td></tr>
          <tr><td colspan="4" style="text-align:right; border-right:1px solid #333;">Total </td><td> <i class="fa fa-inr"></i> </td></tr>-->



</table> 
<table><tr><td><h3 style="color:#006400;">Thank you for buying from moonboy.in ! <br /> For any issue email : support@moonboy.in</h3></td>
<td align="right" valign="top">Ordered Through:<h2> moonboy.in </h2><?php /*?><img width="130" src="<?php echo base_url().'/images/logo1.jpg'?>" /><?php */?></td>
</tr></table>
<p style=" text-align:justify;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I <?php echo $rw2->fname." ". $rw2->lname;?>, hereby agree and confirm that the above said goods are purchased through the Seller ,<?= $rslt[0]->display_name;?> on www.moonboy.in, the above said goods are being purchased for my internal/personal purpose only and not for re-sale.I have read and understood and am legally bound by terms and conditions of sale available on www.moonboy.in  </p>
</div>
</div>






