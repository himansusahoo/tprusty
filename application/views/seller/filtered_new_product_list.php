<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
	foreach($filtered_data->result() as $row) { 
		$img = $row->image; 
		$image = explode(',', $img);
		echo "<tr>
				<td class='return_order_details_td'>
					<div class='row neworder_product_block'>
						<div class='col-md-12'>
							<div class='left position_relative image_block'>
								<img src='".base_url()."images/product_img/".$image[0]."' width='65'>
							</div>
							<div class='left details_block'>
								<div>
									<span class='block'>
										<strong>SKU: </strong>
										".$row->sku."
									</span>
									<strong><a href='#'>".$row->name."</a></strong>
									<span class='block'>
										<strong>Description : </strong>
										".$row->description."
									</span>
								</div>
							</div>
						</div>
						<div class='clear'></div>
					</div>
				</td>
				<td>".$row->quantity."</td>
				<td>".$row->price."</td>
				<td>".$row->special_price."</td>
				<td>".$row->product_approve."</td>
				<td>".$row->status."</td>
				<td>
					<a class='inline' href='#inline_content".$row->seller_product_id."' data-toggle='tooltip' title='Edit'>
						<i class='fa fa-pencil-square-o' style='font-size:25px;'></i>
					</a>
				</td>
			</tr>"; 
	 }
}else{
	echo "<tr>
			<td colspan='7' class='a-center'>No record found !</td>
		</tr>";
}

?>
<link rel="stylesheet" href="<?php echo base_url();?>css/admin/colorbox.css" />
<script src="<?php echo base_url();?>js/jquery.colorbox.js"></script>
<script>
	$(document).ready(function(){
		$(".inline").colorbox({inline:true, width:"68%"});
		$(".inline").colorbox({'overlayClose': false, 'escKey': false});
	});
</script>
<script>
	/*function validate_form(sl, seller_product_id, master_product_id, product_approve){ 
		var base_url = "<?php// echo base_url(); ?>";
		var controller = "seller/catalog/"; 
		
		var status = $("#product_status"+sl).val();
		var price = $("#price"+sl).val(); 
		var special_price = $("#special_price"+sl).val();
		var qty = $("#qty"+sl).val(); 
		
		if(status == ""){ 
			$("#product_status"+sl).css('border-color','red');
			$(".validate_msg").show().text('Product status is required.');	
			return false;
		}else if(special_price == ""){
			$("#product_status"+sl).css('border-color','#ccc');
			$("#special_price"+sl).css('border-color','red').focus();
			$(".validate_msg").show().text('Product Special Price is required.');
			return false;
		}else if(isNaN(special_price)){
			$("#product_status"+sl).css('border-color','#ccc');
			$("#special_price"+sl).select().css('border-color','red');
			$(".validate_msg").show().text('Special Price should be an Integer value.');
			return false;
		}else if(qty == ""){
			$("#product_status"+sl).css('border-color','#ccc');
			$("#special_price"+sl).css('border-color','#ccc');
			$("#qty"+sl).css('border-color','red').focus();
			$(".validate_msg").show().text('Product Quantity is required.');
			return false;
		}else if(isNaN(qty)){
			$("#product_status"+sl).css('border-color','#ccc');
			$("#special_price"+sl).css('border-color','#ccc');
			$("#qty"+sl).select().css('border-color','red');
			$(".validate_msg").show().text('Product Quantity should be an Integer value.');
			return false;
		}else{  
			$.ajax({
				url : base_url + controller + 'update_new_product',
				type : 'POST',
				data : {status:status, special_price:special_price, qty:qty, seller_product_id:seller_product_id, master_product_id:master_product_id},
				'success' : function(data){
					$.colorbox.close();
					$('#successfully_verify').html(data); return false;
					if(data == 'success'){
						window.location.reload(true);
					}else{
						$('#successfully_verify').html("<div style='color:red;'> Product update Failed.</div>");
					}
				}
			});
		}
	}*/
</script>