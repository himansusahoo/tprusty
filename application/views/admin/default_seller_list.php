<?php
require_once('header.php');
?>
<script>
function set_productstatus(sku)
{

	var conf=confirm('Do you want change product status ?');
	
	if(conf)
	{
		
		window.location.href='<?php echo base_url().'admin/sellers/change_productstatus/' ?>' + sku ;
			
	}
		
}
</script>

<div id="content">
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_sellers.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; 
						
						?>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
           
           
           <div class="row content-header">
						<div class="col-md-8"><h3>Seller Defaulter List</h3><span id="ss"></span></div>
						<div class="col-md-4 show_report">
							
						</div>
					</div>
					
						
				  <div class="col-md-6 left" >	
										
					
					</div>
					 <form action="" method="post" >
                     <div class="col-md-6 right">
					  <table class="multi_action">
							<!--<tr>
								
								<td>
									
                            <input type="submit" class="all_buttons" value="Search" id="search"  />
							<input type="reset" class="all_buttons" value="Reset Filter" />
								</td>
							 </tr>-->
						</table>
                        </div>
                        <div class="clearfix"></div>
					
						<table class="table table-bordered table-hover">
                      
                            	<tr class="table_th">
								
								<th>Seller Name</th>
                                 <th>Image</th>
                                <th> Product Name </th>
                                <th> Shipment Delay Counts  </th>
                                <th> Product Status </th>
                                <th> Action </th>
                               
							</tr>
							<!--<tr class="filter_tr">
								
								<td>
									<input type="text" name="seller_name" id="seller_name" >
								</td>
								<td>
									
								</td>
                                
                                <td>									
                                   <input type="text" name="product_name" id="product_name" > 
                                    
								</td>
                                 
                                <td>
									<select name="product_status">
                                    
                                    <option >--select--</option>
                                    <option value="1">Once</option>
                                    <option value="2">2 times </option>
                                    <option value="3">3 times </option>
                                    <option value="4">4 times </option>
                                    <option value="5">5 times </option>
                                    <option value="6">6 times </option>
                                    <option value="7">7 times </option>
                                    <option value="8">8 times </option>
                                    <option value="9">9 times </option>
                                    <option value="10">10 times </option>
                                    
                                    </select>
								</td>
                                
                               
                                <td><input type="text" name="product_status" id="product_status" ></td>
                                
                              
                                <td></td>
                         
							</tr>-->
                            
                           <?php
						   
						    if(count($defaulter_seller)!=0){
							   
							   foreach($defaulter_seller as $res_sellerDefault)
							   { 
							    
							   ?>
                            <tr> 
                            <td><?php echo $res_sellerDefault->name;  ?>   </td>
                            <td> <?php $image=explode(',',$res_sellerDefault->imag);  ?> <img src="<?php echo base_url().'images/product_img/'.$image[0]; ?>" width="30" class="list_img">  </td>
                            
                            <td> <?php echo $res_sellerDefault->product_name;  ?>  </td>
                            
                            <td> <?php echo $res_sellerDefault->shipment_delay_count;  ?> times   </td>
                            <td>  <?php echo $res_sellerDefault->prd_status;  ?></td>
                            <td>  
                            
                            <a title="Block Product" href="#" onClick="set_productstatus('<?php echo $res_sellerDefault->prd_sku ?>')"> <i style="font-size:18px;" class="fa fa-lock"></i> </a>
                            
                            </td>
                            
                           

                            </tr>
                            <?php } }else { ?>
                           
							<tr><td colspan="8" class="a-center">No Records Found ! </td></tr>
                            <?php }  ?> 
					  </table>
                    
                        </form> 


                
                
</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->    

                
 <?php
require_once('footer.php');
?>
                
                