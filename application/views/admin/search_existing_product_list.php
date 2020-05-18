<?php
require_once('header.php');
?> 

<script>
	function add_exist_product(product_id, seller_id,skuid){
		var base_url = "<?php echo base_url(); ?>";
		var controller = "admin/sellers"; 
		window.location.href = base_url + controller + '/add_existing_product/'+ encodeURIComponent(product_id)+'/'+ seller_id + '/'+encodeURIComponent(skuid) ;
	}	
</script>

			<div id="content"> 
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_sellers.php';?>
					</div>

					<div class="top-right">
						<?php include 'top_right.php';?>
					</div>
				</div>
				
				<!-- @end top-bar  -->
				<div class="main-content">
					<div class="">
						<h3>Add Exist Product</h3>
					</div>
					<div class="row">
						<div class="search_products">
							<table class="table table-hover" style="border: 1px solid #c8c8c8;">
								<tr>
									<th width="70%">Product Specification</th>
									<th width="20%">Subcategory</th>
									<th width="10%">Action</th>
								</tr>
								<?php if($search_result) { 
									foreach($search_result as $row) :
									//var_dump($search_result); exit;
									$arr_img = explode(',',$row->imag);
									$first_img = $arr_img[0];
								?>
								<tr>
									<td>
										<div class="row">
											<div class="col-md-4">
												<img src="<?php echo base_url(); ?>images/product_img/<?=$first_img?>" width="100" height="100">
											</div>
											<div class="col-md-8">
												<div>
													<strong><?=$row->name?></strong>
													<table class="exist_product_list_table">
														<tr>
															<td>Category : </td>
															<td><?=$row->lvlmain_name.' >> '.$row->lvl1_name;?></td>
														</tr>
														<tr>
															<td>SKU ID : </td>
															<td><?=$row->sku?></td>
														</tr>
														<tr>
															<!--<td>Description : </td>-->
															<td><?php //echo $row->description; ?></td>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</td>
									<td>
										<h5><?=$row->category_name?></h5>
									</td>
									<td>
										<button class="seller_buttons" onclick="add_exist_product(<?=$row->product_id?>, <?=$seller_id?>,'<?=$row->sku?>')"><i class="icon-plus"></i>&nbsp; Add</button>
									</td>
								</tr>
								<?php
								endforeach;
								}else{
								?>
								<tr>
									<td colspan="3" class="a-center">No record found !</td>
								</tr>
								<?php
								}
								?>
							</table>
						</div>
					</div>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->
<?php
require_once('footer.php');
?>