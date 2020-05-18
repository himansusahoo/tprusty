<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
$rows = $filtered_data->num_rows(); 
echo "
		<tr style='background-color:#f8f8f8;'>
			<th width='40%'>Product details</th>
			<th width='10%'>Units in stock</th>
			<th width='10%'>MRP</th>
			<th width='10%'>Selling price</th>
			<th width='10%'>Approve Status</th>
			<th width='10%'>Status</th>
			<th width='10%'>Action</th>
		</tr>";
if($rows > 0){
	$sl=0;
	foreach($filtered_data->result() as $row) { 
	$sl++;
		$img = $row->image; 
		$image = explode(',', $img); ?>
		<tr>
				<td class='return_order_details_td'>
					<div class='row neworder_product_block'>
						<div class='col-md-12'>
							<div class='left position_relative image_block'>
								<img src='<?=base_url()?>images/product_img/<?=$image[0]?>' width='65'>
							</div>
							<div class='left details_block'>
								<div>
									<span class='block'>
										<strong>SKU: </strong>
										<?=$row->sku ?>
									</span>
									<strong><a href='#'><?=$row->name?></a></strong>
									<span class='block'>
										<strong>Description : </strong>
										<?=$row->description?>
									</span>
								</div>
							</div>
						</div>
						<div class='clear'></div>
					</div>
				</td>
				<td><?=$row->quantity?></td>
				<td><?=$row->price?></td>
				<td><?=$row->special_price?></td>
				<td><?=$row->product_approve?></td>
				<td><?=$row->status?></td>
				<td>
					
                    
                    
				</td>
			</tr>
            
  


<?php
  }
  ?>
  
  <tr><td colspan="7">
  <a class='inline' href='#abcdz' title='Edit'>
						<i class='fa fa-pencil-square-o' style='font-size:25px;'></i>
					</a>
                    
                    
  <div style="display:none">
      <div id='abcdz' style='padding:0 10px; background:#fff;'>
          <h3>dfgsdgs hdfyr dtyet dtyert</h3>
      </div>
  </div>    
  
  <td></td>
  
  
  
  
  
<?php  
}else{
	echo "<tr>
			<td colspan='6' class='a-center'>No record found !</td>
		</tr>";
}
?> 

<!--<link rel="stylesheet" href="<?php// echo base_url();?>css/admin/colorbox.css"/>-->
<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
<script src="<?php echo base_url();?>js/jquery.colorbox.js"></script>

<script>
$(document).ready(function(){
	$(".inline").colorbox({inline:true, width:"68%"});
	$(".inline").colorbox({'overlayClose': false, 'escKey': false});
});
</script>


<!-- Lightbox link start here-->
       <!-- <link rel="stylesheet" href="<?php// echo base_url(); ?>colorbox/colorbox.css" />
		<script src="<?php// echo base_url(); ?>colorbox/jquery.min.js"></script>
		<script src="<?php// echo base_url(); ?>colorbox/jquery.colorbox.js"></script>
		<script>
			$(document).ready(function(){
				$(".inline").colorbox({inline:true, width:"34%"});
				$(".inline").colorbox({'overlayClose': false, 'escKey': false});
			});
		</script>-->
        <!-- Lightbox link end here-->
