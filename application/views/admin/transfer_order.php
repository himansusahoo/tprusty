<?php
require_once("header.php");
?>
	<!--- Zebra_Datepicker link start here ---->
	<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
	<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
	<link href="<?php echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
	<!--- Zebra_Datepicker link end here ---->

<script>

function transfer_ordervalid()
{
		
		var order_sku = document.getElementsByName("chek_sku[]");
		var ordersku_count=order_sku.length;
		
		var count=0;
		for (var i=0; i<ordersku_count; i++)
		 {
			if (order_sku[i].checked === true) 
			{
				count++;
			}
		}
		
		if(count==0)
		{
			alert('Please select atleast one record');
			return false;
		}
		 var conf=confirm('Do you want to transfer order ?');
		 if(conf==false)
		 {
			return false;	 
		}
		
}

function chk_record(id)
{
	//
//	document.getElementById('product_id'+id).checked='checked';	
//	document.getElementById('user_id'+id).checked='checked';
//	document.getElementById('buyer_qnt'+id).checked='checked';
//	document.getElementById('chk_fixedprice'+id).checked='checked';
	
	if(document.getElementById('chek_sku'+id).checked== true)
	{
		$('#product_id'+id).prop('checked','checked');
		$('#user_id'+id).prop('checked', 'checked');
		$('#buyer_qnt'+id).prop('checked', 'checked');
		$('#chk_fixedprice'+id).prop('checked', 'checked');
		

	}
	else if(document.getElementById('chek_sku'+id).checked== false)
	{
		$('#product_id'+id).prop('checked',false);
		$('#user_id'+id).prop('checked', false);
		$('#buyer_qnt'+id).prop('checked', false);
		$('#chk_fixedprice'+id).prop('checked',false);
		
	}	
		
}

function fill_data(id)
{	
	
 document.getElementById('chk_fixedprice'+id).value=document.getElementById('txtbox_fixedprice'+id).value;	

}

function cancel_oldorder(old_ordrid)
{
	var conf=confirm("Do you want to cancel order");
	
	if(conf)
	{
		window.location.href='<?php echo base_url().'admin/sales/cancel_transfered_order/' ?>' + old_ordrid;	
		
	}
		
}



</script>  


			<div id="content">    
				<div class="top-bar">  <!-- @start top-bar  -->
					<div class="top-left">
						<?php include 'sub_sales.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
                    <div class="clearfix"></div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
                
                
                <!--Order History Start -->
               
                
                <div id="tab4" >
                	<h3>Order History: <?php echo $trans_orderid; ?></h3>
					<div id="ss"></div>
                    <table class="table table-bordered table-hover">
								<tr bgcolor="#99CCFF">
									<td style="width:20%;"> Product Name </td>	
								
									
									
									<td> Quantity </td>
									
									<td> Unit Price </td>
                                    <td> Tax amount </td>
                                    <td> Shipping Fees </td>
									
									<td> Total Price </td>
									
									
									
								</tr>
                                <?php 
								$total_price=0;
								 $qr5=$this->db->query("select * from ordered_product_from_addtocart where order_id='$trans_orderid' group by sku"); 
										foreach($qr5->result() as $rw5)
									{								
								
								?>
                                <tr>
									<td style="width:45%;">
                                    
                                    <?php  
									   //$image_cart=explode(',',$rec_cart->imag);
									   $qr6=$this->db->query("select a.imag from product_image a inner join ordered_product_from_addtocart b on a.product_id=b.product_id   where b.product_id='$rw5->product_id' group by b.product_id");
									   $rw6=$qr6->row();
									   $image_cart=explode(',',$rw6->imag);
									   
							?><div style="float:left; width:15%;">  <img src="<?php echo base_url().'images/product_img/'.$image_cart[0]; ?>" width="30" class="list_img"> </div>
                                    
                                <div style="float:left; width:83%;">      <?php  $qr7=$this->db->query("select name from product_general_info where product_id='$rw5->product_id'");
											   $rw7=$qr7->row(); 
											   echo "<b>". $rw7->name ."</b>" ; ?> <br>
                                       <?php        
                                       $color_sizecronjobquery=$this->db->query("SELECT color,size,Capacity,RAM,ROM FROM  cornjob_productsearch WHERE sku='$rw5->sku' group by sku ");
									if($color_sizecronjobquery->num_rows()>0)
									{										
										$color=$color_sizecronjobquery->row()->color;
										$size=$color_sizecronjobquery->row()->size;
										$capacity=$color_sizecronjobquery->row()->Capacity;
										$ram=$color_sizecronjobquery->row()->RAM;
										$rom=$color_sizecronjobquery->row()->ROM;
									}
									
									if($color != ''){ echo "<span class='cart_attr'>Color : ".$color.'</span><br/>'; }
									if($size != ''){ echo "<span class='cart_attr'>Size : ".$size.'</span><br/>'; }
									if($capacity != ''){ echo "<span class='cart_attr'>Capacity : ".$capacity.'</span><br/>'; }
									if($ram != ''){ echo "<span class='cart_attr'>RAM : ".$ram.'</span><br/>'; }
									if($rom != ''){ echo "<span class='cart_attr'>ROM : ".$rom.'</span><br/>'; }
                                                                                
                                            ?>        
                                              
                                       <?php        
											$query_sellername=$this->db->query("select a.business_name,c.name from seller_account_information a inner join product_master b on a.seller_id=b.seller_id inner join seller_account c on c.seller_id=a.seller_id  where b.sku='$rw5->sku'  ");
					   $count_row=$query_sellername->num_rows();
					   if($count_row!=0){
					   $rw_sellername=$query_sellername->row();
						
					//    print_r($rw_sellername->business_name);}
					   echo "Seller Name: ". $rw_sellername->business_name; }
					   else { echo "Seller Name: moonboy";}
                                               ?> </div>
                                               <div class="clearfix"></div>
                                      </td>	
								
									
									
									<td>  <?php $qr9=$this->db->query("select * from ordered_product_from_addtocart where product_id='$rw5->product_id' and                                                 sku='$rw5->sku' and order_id='$trans_orderid'  ");  
								  //$row3=$qr3->row();
								  $price=0;
								  $rw9=$qr9->row(); 
								echo  $rw9->quantity; ?> </td>
									
									<td> <?php
									
									
								  $tax_amt=$rw9->sub_tax_rate;
								  $shipping_amnt=$rw9->sub_shipping_fees;
								  $qtn=$rw9->quantity;
								  
								  $single_prod_price=(($rw9->sub_total_amount-$tax_amt)-$shipping_amnt)/$qtn;
								 	echo "Rs.".round($single_prod_price); ?>  
                                   
                                     </td>
									<td>Rs.<?php echo $rw9->sub_tax_rate; ?></td>
                                    <td>Rs. <?php echo $rw9->sub_shipping_fees; ?></td>
									<td> Rs. <?php echo $rw9->sub_total_amount; ?> </td>
									
									
									
								</tr>
                                
                                <?php } ?>
                                
                                <tr><td colspan="5" style="text-align:right;">Total Amount :(Including Tax & Shipping Fees)</td><td>Rs. <?php 
								
								$qr11=$this->db->query("select * from order_info where order_id='$trans_orderid' ");  
									  $rec11=$qr11->result();
									  echo  $rec11[0]->Total_amount;
								  ?></td>
                                  
                                  </tr>                               
                                <!--<tr><td colspan="4" style="text-align:right;">Tax</td><td> <i class="fa fa-inr"></i></td></tr>
                                 <tr><td colspan="4" style="text-align:right;">Shipping Rate</td><td> <i class="fa fa-inr"></i></td></tr>
                                <tr><td colspan="4" style="text-align:right;">Total </td><td> <i class="fa fa-inr"></i> </td></tr>-->
                                </table>
                    
                    
				</div>
                
                
                 <!--Order History End -->
                
                
                
                
               <div class="row content-header">
               
						<div class="col-md-8"><h3>Transfer Order</h3></div>
						<div class="col-md-4 show_report">
							<!--<button type="button"  class="all_buttons">Create New Order</button>-->
						</div>
                        
					</div>
                    <form action="<?php echo base_url().'admin/sales/reassign_order' ?>" method="POST" onSubmit="return transfer_ordervalid()"   >
               <!-- Fixed Total Ordered Amount <input type="text" name="ordered_mount" id="ordered_mount">-->
                
                 <input type="hidden" name="old_order_id" value='<?php echo $trans_orderid ?>' >                 
                <input type="submit" name="btn_transferorder" value="Reassign Order"    >
               
               
                                      <table class="table table-bordered table-hover">
                                      <tr class="table_th">
                                      <th></th>
                                      <th>Product Name</th>
                                      <th>MRP</th>
                                      <th>Selling Price</th>
                                      <th>Special Price</th>
                                    
                                      <th>Shipping Fees </th>
                                      <th>Buyer Order Quantity</th>
                                      <th>quantity In Stock</th>
                                      <th>Stock Status</th>
                                      <th>Product Status</th>
                                      <th>Seller Name</th>
                                      <th>Fixed Price</th>
                                      </tr>
                                      
                                      
                                      <?php 
									  	
									 
									  
						//$rows_trans=$trans_productdata->result();
						if($trans_productdata){
							$i=0;
						foreach($trans_productdata as $restransdata)
						{
								
						?>
                                      
                  <tr>
                  <td><input type="checkbox" name="chek_sku[]" id="chek_sku<?= $i ?>" value="<?= $restransdata->sku; ?>"  onClick="chk_record(<?= $i ?>)">
                 <span style="display:none;">
                  <input type="checkbox" name="product_id[]" id="product_id<?= $i ?>" value="<?= $restransdata->product_id; ?>"> 
                  <input type="checkbox" name="user_id[]" id="user_id<?= $i ?>" value="<?= $restransdata->user_id; ?>"> 
                   <input type="checkbox" name="buyer_qnt[]" id="buyer_qnt<?= $i ?>" value="<?= $restransdata->cus_qantity; ?>"> 
                  
                  </span>
                  
                  </td>
                  
                     <td><?php $image=explode(',',$restransdata->imag); ?><img src="<?php echo base_url().'images/product_img/'.$image[0]; ?>" width="30" class="list_img">
                     <?= $restransdata->name; ?>
                     </td>
                       <td>Rs.<?= $restransdata->mrp; ?></td>
                       <td>Rs.<?= $restransdata->price; ?></td>
                       <td>Rs.<?= $restransdata->special_price; ?></td>
                           
                       <td>Rs.<?= $restransdata->shipping_fee_amount; ?></td>
                       <td><?= $restransdata->cus_qantity; ?></td> 
                        <td><?= $restransdata->quantity; ?></td> 
                       <td><?= $restransdata->stock_availability; ?></td> 
                       
                       <td><?= $restransdata->approve_status; ?></td>
                        <td><?= $restransdata->business_name;  ?> </td>
                        
                        <td><input type="text" name="txtbox_fixedprice[]" id="txtbox_fixedprice<?= $i ?>" onKeyUp="fill_data(<?= $i ?>)" value=0 >
                        
                       <span style="display:none;"> <input type="checkbox" name="chk_fixedprice[]" id="chk_fixedprice<?= $i ?>" ></span>
                        
                        </td>
                        
                              </tr>
                             <?php  $i++; }  }else{
						
									  ?>   
                                      <tr> <td style="text-align:center;" colspan='12'>No sellers Available<input type="button" value="Cancel Order" onClick="cancel_oldorder('<?= $trans_orderid ?>')"></td></tr>
                                      <?php } ?>  
                                      </table> 
                                      
                                      
                
               
                 </form>
              	</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->
            

         
            
            
            
            
            
            	
<?php require_once('footer.php') ?> 
			