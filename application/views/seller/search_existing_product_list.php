<?php
require_once('header.php');
?>
<script>
function add_exist_product(product_id,skuid){
	var base_url = "<?php echo base_url(); ?>";
	var controller = "seller/catalog";
	window.location.href = base_url + controller + '/add_existing_product/'+ encodeURIComponent(product_id)+ '/'+encodeURIComponent(skuid);
}
</script>

			<div id="content">  
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_catalog.php'; ?>
					</div>

					<?php
					require_once('header_session.php');
					?>
				</div>
				
				<!-- 31 <?php
				$seller_signup_id = $this->session->userdata('seller-signup-session');
				if(!$seller_signup_id) : 
				?>
				<div style="padding-top:60px; margin:0px 50px;">
					<div class="alert alert-danger" role="alert"> *Important ! You have not completed signup. To complete click <a href="<?php echo base_url();?>seller/seller/incomplete_signup"><strong>here</strong></a></div>
				</div>
				<?php
				endif;
				?>-->
				
				<!-- @end top-bar  -->
				<div class="main-content">
					<?php require_once('common.php'); ?>
					<div class="">
						<h3>Add a Product</h3>
					</div>
					<div class="row">
						<!--<div class="row">
							<div class="col-md-4">
								<form>
									<div class="controls controls-row">
										<input type="text" name="search_title" class="seller_input">
										<button type="submit" name="" class="seller_buttons">Search</button>
									</div>
								<form>
							</div>
							<div class="col-md-8">
								Or,<a href="#">Create a New Listing</a> yourself
							</div>
							<div class="clearfix"></div>
							<hr>
						</div>-->
						<div class="search_products">
							<table class="table table-hover" style="border: 1px solid #c8c8c8;">
								<tr>
									<th width="70%">Product Specification</th>
									<th width="20%">Subcategory</th>
									<th width="10%">Action</th>
								</tr>
								<?php if($search_result) { //var_dump($search_result); exit;
									foreach($search_result as $row) :
									//var_dump($search_result); exit;
									/*$arr_img = explode(',',$row->imag);
									$first_img = $arr_img[0];*/
								?>
								<tr>
									<td>
										<div class="row">
											<div class="col-md-4 prdct-list">
												<img src="<?php echo base_url(); ?>images/product_img/<?=$row->imag;?>">
											</div>
											<div class="col-md-8">
												<div>
													<strong><?=$row->name?></strong>
													<table class="exist_product_list_table">
														<!--<tr>
															<td>Brand : </td>
															<td><?//=$row->category_name?></td>
														</tr>-->
														<tr>
															<td>SKU ID : </td>
															<td><?=$row->sku?></td>
														</tr>
														<tr>
															<td width="90px">Description : </td>
															<td><?php if(strlen($row->description) > 150){ echo substr($row->description,0,150).'...';}else{ echo $row->description;}?></td>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</td>
									<td>
										<!--<h5><?//=$row->category_name?></h5>-->
                                        <h5><?=$row->lvl2_name?></h5>
									</td>
									<td>
										<button class="seller_buttons" onclick="add_exist_product(<?=$row->product_id?>,'<?=$row->sku?>')"><i class="icon-plus"></i>&nbsp; Add</button>
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