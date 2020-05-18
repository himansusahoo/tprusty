<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$rows = $searched_order->num_rows();
echo "<div class='row'>
			<div class='col-md-12'>
				<table class='table neworder_table'>
					<tr style='background-color:#efefef;'>
						<th width='45%'>Order Summary</th>
						<th width='10%'>Order Status</th>
						<th width='15%'>Quantity and Price</th>
						<th width='15%'>Buyer details</th>
						<th width='15%'>Tracking</th>
					</tr>";
if($rows > 0){
	foreach($searched_order->result() as $row) :
	$img = $row->imag; 
	$image = explode(',', $img);
					echo "<tr>
							<td>
								<div class='row neworder_product_block'>
									<div class='col-md-12'>
										<div class='left image_block position_relative'>
											<img src='".base_url()."images/product_img/".$image[0]."' width='65'>
										</div>
										<div class='left details_block'>
											<div>
												<span class='block'>
													<strong>SKU: </strong>
														".$row->sku."
												</span>
												<strong>
													<a href='#'>".$row->name."</a>
												</strong>
												<table class='table attributes_table'>	
													<tr>
														<th>Order Date</th>
														<td>
														".$date = date_format(date_create($row->date_of_order), 'M d, Y h:i A')."
														</td>
													</tr>
													<tr>
														<th>Order ID</th>
														<td>".$row->order_id."</td>
													</tr>
												</table>
											</div>
										</div>
									</div>
								</div>
							</td>
							<td>".$row->order_status."</td>
							<td>
								<div>";
								
$seller_id = $this->session->userdata('seller-session');
$query = $this->db->query("SELECT COUNT( b.sku ) AS qty, f.user_id, b.order_id
FROM order_info a
INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id
INNER JOIN product_master c ON b.sku = c.sku
INNER JOIN user f ON b.user_id = f.user_id
INNER JOIN user_address g ON b.user_id = g.user_id
WHERE c.seller_id ='$seller_id'
GROUP BY b.order_id, b.sku, b.user_id");
$rw1 = $query->result();
$uid = $row->user_id;
$oid = $row->order_id;
foreach($rw1 as $ew) :
	if($uid == $ew->user_id && $oid == $ew->order_id):
		
								echo "<strong class='block'>Qty : ".$ew->qty."</strong><br>
									<span class='muted'>
										Value :
										<i class='icon-rupee'></i>
										".$row->price." each
									</span><br>
									<span class='muted'>
										Shipping : 
										<i class='icon-rupee'></i>
										100.00 each
									</span><br>
									<strong>
										Total :
										<i class='icon-rupee'></i>
										".($row->price * $ew->qty + 100)."
									</strong>
									<div>
										<span>
											<strong>Payment Type :</strong>
											 Prepaid
										</span>
									</div>";
	endif;
	endforeach;
							echo "</div>
							</td>
							<td>
								".$row->full_name."
								<br>
								".$row->address."
								<br>
								".$row->city."
								<br>
								".$row->state."
								<br>
								".$row->country."-".$row->pin_code."
								<br>
								Mobile - ".$row->phone."
							</td>
							<td>
								<span><strong>Today</strong> , </span>
								<strong></strong>
								<div>Aug 20, 2015 11:59:59 PM</div>
								<div><span class='muted'>Procurement SLA: 1 Days</span></div>
							</td>";
				echo "</tr>";
	endforeach;
}else{
				echo "<tr>
						<td colspan='6' class='a-center'>No record found!</td>
					</tr>";
}					
		   echo "</table>
			</div>
		</div>";
?>