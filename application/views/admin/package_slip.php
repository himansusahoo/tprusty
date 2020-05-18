<style type="text/css">
*{padding:0px; margin:0px;}
.content{width:90%; margin:10px auto; font-family:"Calibri", Arial, Helvetica, sans-serif;} 
.heading{background-color:#000; font-size:18px; color:#fff; padding:8px 5px; font-weight:bold;}
.content table{margin:10px 0px;  width:100%;}
.content table tr td{font-size:16px; line-height:20px; padding:10px;}
.data-table tr td{border-bottom:1px solid #333;}
</style>

<div class="content">
<div style="text-align:center; font-size:22px; font-weight:bold; margin-bottom:20px;" > moonboy.in </div>
<h1> Packing Slip </h1>

<div> 
<table style="background-color:#f9f9f9; border:1px dashed #ccc; padding:20px;">
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


<td style="text-align:right;">
Order ID: <?php echo $orderid; ?><br />

Order Date : 
<?php $qr1=$this->db->query("select * from order_info where order_id='$orderid' "); 
	 $rw1=$qr1->row();
	 echo substr($rw1->date_of_order,0,10); 
	 ?>

</td>

</tr>
</table>

<div style="clear:both;"></div>
<table cellspacing="0" cellpadding="0" style="border:1px solid #000;" class="data-table">
<tr>
<th class="heading" style="text-align:left;" >Product </th>
<th class="heading" > Quantity </th> </tr>
 <?php $total_quantity=0; 
 $qr5=$this->db->query("select * from ordered_product_from_addtocart where order_id='$orderid' group by sku"); 
										foreach($qr5->result() as $rw5)
									{
 
 
  ?> 
<tr>

<td>
<?php  $qr7=$this->db->query("select name from product_general_info where product_id='$rw5->product_id'");
											   $rw7=$qr7->row(); 
											   echo "<b>". $rw7->name ."</b>" ; ?> <br/>
                                               <?php echo "SKU:". $rw5->sku; ?>                                    
                                              


</td>

<td align="center">

 <?php   $qr9=$this->db->query("select * from ordered_product_from_addtocart where product_id='$rw5->product_id' and sku='$rw5->sku' and order_id='$orderid'  ");  
								  //$row3=$qr3->row();
								  
								  $rw9=$qr9->row(); 
								echo  $rw9->quantity; ?>  
</td> 

</tr>
<?php $total_quantity= $total_quantity+$rw9->quantity; } ?>
<tr>  <td colspan="2" align="right">Total Quantity: <?php echo $total_quantity; ?></td></tr>
</table> 

</div>
</div>