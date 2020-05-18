<?php
# replace excelfile.xls with whatever you want the filename to default to
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=advance_searchexport.xls");
header("Pragma: no-cache");
header("Expires: 0"); ?>
<div id="container">
<div id="header">
<div id="mainContent" align="center">   
 
<div style="padding-left:250px;">
	<table border="1">
    	<tr>
        	<th bgcolor="#FBFB00">SKU</th>
            <th bgcolor="#FBFB00">Name</th>
            <th bgcolor="#FBFB00">Seller</th>
            <th bgcolor="#FBFB00">MRP</th>
            <th bgcolor="#FBFB00">Selling Price</th>
            <th bgcolor="#FBFB00">Special Price</th>
            <th bgcolor="#FBFB00">Special Price From Date</th>
            <th bgcolor="#FBFB00">Special Price To Date</th>
            <th bgcolor="#FBFB00">Product Status</th>
            
            
        </tr>
         <?php
								
								$skucheck_arr=array();
								
								if($product_info != false){
									foreach($product_info->result_array() as $rows){
									
									if(!in_array($rows['sku'],$skucheck_arr))
									{	
							?>
                            <tr>
                            	
                                <td><?=$rows['sku'] ; ?></td>
                            	<td> 
                                <?php /*?><span style="float:left;">
                                 <?php 
								 $filePath=base_url().'images/product_img/'.$rows['imag'];
								 if(empty($rows['imag'])){?>
    							<img src="<?php echo base_url();?>images/product_img/prdct-no-img.png" class="list_img" >
    							<?php }else{?>
                                <img  class="list_img" src="<?php echo base_url().'images/product_img/'.$rows['imag']; ?>" ></span>
                                <?php } ?><?php */?>
                                <?=$rows['name']; ?>
                                </td>
                                
                                <td> 
                                <?php echo $rows['business_name']; ?>
                                </td>
                                
                                <td> <?php echo  $rows['mrp']; ?></td>
                                <td> <?php echo  $rows['price']; ?></td>
                               <td> <?php  echo  $rows['special_price']; ?></td>
                               <td> <?php  echo  $rows['special_pric_from_dt']; ?></td>
                               <td> <?php  echo  $rows['special_pric_to_dt']; ?></td>
                               <td> <?php  echo  $rows['prod_status']; ?></td>
                               
                            </tr>
                            <?php 
									$skucheck_arr[]=$rows['sku'];
									}
								
								}
							}else{
							?>
         <tr>
        	<td colspan="9">No Record Found.</td>
        </tr>
        <?php }?>
    </table>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/> 
        
</div>