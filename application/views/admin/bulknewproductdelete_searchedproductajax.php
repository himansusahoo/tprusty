<script>

$(document).ready(function(){
	$('#check_all').click(function(){
		$('input:checkbox').prop('checked', this.checked);
	});
});


function add_exist_product(sl)
{
		
		if(document.getElementById('order_id_chk'+sl).checked== true)
		{
			$("#prod"+sl).css("background-color", "LightGoldenRodYellow");
			
		}
		else if(document.getElementById('order_id_chk'+sl).checked== false)
		{
			
			$("#prod"+sl).css("background-color", "");
			
		}		  
	
}
</script>
<form action='<?php echo base_url().'admin/Bulk_productdelete/delete_selectedproduct' ?>' method="post">

<table class="table table-bordered table-hover">
					<tr class="table_th"><td colspan="9">
                    <input type="button" name="delete_product" id="delete_product" class="seller_buttons" value="Delete Product" onclick="selectedprod_delete()" >
                    
                    <!-- <input type="submit" name="delete_product" id="delete_product" class="seller_buttons" value="Delete Product" >-->
                    
                    
                    </td></tr>
					<tr class="table_th">
                    <th width="3%">
                   <input type="checkbox" id="check_all" name="check_all">
                    Select All</th>
						<th width="5%">Product Id</th>						
						<th width="40%">Product Name</th>						
						<th width="25%">SKU</th>
                        <th width="5%">In Cart</th>
						<th width="5%">In Wishlist</th>
                        <th width="5%">Orders</th>
                        <th width="10%">Product Status</th>
                        <th width="25%">Product Type</th>
						
					</tr>
					
                    <?php $ct=$srch_prod->num_rows(); $sl=1; 
					if($ct!=0){
						$array_skucheck=array();
						
						foreach($srch_prod->result_array() as $rws ){
						if(!in_array($rws['sku'],$array_skucheck))
						{	
							 $srch_sku=$rws['sku'];
							 $cart_qr=$this->db->query("SELECT sku FROM addtocart_temp WHERE sku='$srch_sku' ");
							 $tot_cart=$cart_qr->num_rows();
						 
						 
						 	$wishlist_qr=$this->db->query("SELECT sku FROM wishlist WHERE sku='$srch_sku' ");
						 	$tot_wishlist= $wishlist_qr->num_rows(); 
							
							$order_qr=$this->db->query("SELECT sku FROM ordered_product_from_addtocart WHERE sku='$srch_sku' ");
						 	$tot_order=$order_qr->num_rows();
							
							
							$masterproduct_id=$rws['product_id'];
							
						 	$prodtype_qr=$this->db->query("SELECT seller_exist_product_id FROM seller_product_master WHERE    		    								                                                           master_product_id='$masterproduct_id' ");
						 	$ctr_prodtype=$prodtype_qr->num_rows();
							
							
							$parentprod_qr=$this->db->query("SELECT sku FROM seller_product_master WHERE sku='$srch_sku' ");
						 	$ctr_parentprod=$parentprod_qr->num_rows();
					?>
                    <tr id="prod<?=$sl;?>">
                        
                        <td style="text-align:center;">
                        <?php if(($tot_order==0 &&  $tot_cart==0 && $tot_wishlist==0 && $ctr_prodtype==0) ||
								($tot_order==0 &&  $tot_cart==0 && $tot_wishlist==0 && $ctr_parentprod>0) ) 
						{
							
							?>
                        <input type="checkbox"  id="order_id_chk<?=$sl;?>" name="order_id_chk[]" value="<?php echo $rws['sku'] ?>" onclick="add_exist_product('<?=$sl;?>')" ></td>
                        <?php } ?>
                        <td> <?php echo $rws['product_id'];  ?></td> 
                        <td> 
						<a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($rws['name'])))).'/'.$rws['product_id'].'/'.$rws['sku']  ?>" target="_blank" >
                        	<img class="list_img" src="<?php echo base_url().'images/product_img/'.$rws['imag']; ?>">
                            <?php echo $rws['name'];?>
                            </a>
                        </td>
                        <td> 							
                            <?php echo $rws['sku'];?>
                        </td>
                         <td> 
						 
						 <?php
						 						 
						 echo  $tot_cart;						 
						  if($tot_cart>0) {?>
                             <a href="#" onclick="window.open('<?php echo base_url().'admin/Bulk_productdelete/cart_details/'.$rws['sku'] ?>','DetailPanel','width=500,height=350,menubar=no,status=no,scrollbars=yes')">
						<i style="font-size:16px;" class="fa fa-eye" title="view cart detail"></i>
                         </a>
                       <?php  }?>
                         
                         </td>
                        <td>
                         <?php
						 	echo $tot_wishlist;
							 if($tot_wishlist>0) {?>
                             <a href="#" onclick="window.open('<?php echo base_url().'admin/Bulk_productdelete/wishlist_details/'.$rws['sku'] ?>','DetailPanel','width=500,height=350,menubar=no,status=no,scrollbars=yes')">
						<i style="font-size:16px;" class="fa fa-eye" title="view wishlist detail"></i>
                         </a>
                       <?php  }?>
                             
                             
                             </td>
                        <td> 
						<?php 
							echo  $tot_order;
						 if($tot_order>0) {  ?>
						<a href="#" onclick="window.open('<?php echo base_url().'admin/Bulk_productdelete/order_details/'.$rws['sku'] ?>','DetailPanel','width=500,height=350,menubar=no,status=no,scrollbars=yes')">
						<i style="font-size:16px;" class="fa fa-eye" title="view orders"></i>
                         </a>
                       <?php  }?>
                         </td>
                        <td> <?php echo $rws['prod_status']; ?></td>
                        <td>
                     <?php
							
							
							if($ctr_prodtype>0 && $ctr_parentprod==0 )
							{ ?>
								
								<a href="#" onclick="window.open('<?php echo base_url().'admin/Bulk_productdelete/extingprodsku_details/'.$masterproduct_id ?>','DetailPanel','width=500,height=350,menubar=no,status=no,scrollbars=yes')">
								<?php echo "New Product"." (".$ctr_prodtype."Nos. Existing Products)";	 ?>
                             </a>   
                                
						<?php	}
							if($ctr_prodtype>0 && $ctr_parentprod>0)
							{
								echo "Existing Product(Grouped Product)";	
							}
							if($ctr_prodtype==0 && $ctr_parentprod==0)
							{
								echo "New Product";	
							}
							if($ctr_prodtype==0 && $ctr_parentprod>0)
							{
								echo "Existing Product(Grouped Product)";	
							}
							/*if($ctr_prodtype>0 && $ctr_parentprod>0 && $rws['prod_status']=='Pending')
							{echo "Existing Product(Grouped Product)";}*/
							
						 ?>
                        </td>  
                        
                    </tr>
                    
                    <?php $sl++;
						$array_skucheck[]=$rws['sku'];} // sku array chekc end
					}} else {
					 ?>
					<tr><td colspan="9" class="a-center">No records found ! </td></tr>
					<?php } ?>
					
				</table>
                </form>