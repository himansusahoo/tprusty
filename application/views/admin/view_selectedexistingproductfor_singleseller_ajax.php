<div class="row">
						<div class="search_products">
							<table class="table table-hover" style="border: 1px solid #c8c8c8;">
								<tr>
									<th width="70%">Product Specification</th>
									<th width="20%">Subcategory</th>
									<!--<th width="10%">Action</th>-->
								</tr>
								<?php if($search_result->num_rows()>0) { 
									foreach($search_result->result_array() as $row) :
									//var_dump($search_result); exit;
									//$arr_img = explode(',',$row->imag);
									//$first_img = $arr_img[0];
								?>
								<tr>
									<td>
										<div class="row">
											<div class="col-md-4">
												<img src="<?php echo base_url(); ?>images/product_img/<?=$row['imag']?>" width="100" height="100">
											</div>
											<div class="col-md-8">
												<div>
													<strong><?=$row['name']?></strong>
													<table class="exist_product_list_table">
														<tr>
                                                        <td>
										<input type='checkbox'  onclick="add_exist_product('<?=$row['product_id']?>', '<?=$row['seller_id']?>','<?=$row['sku']?>')">
									</td>
															<td>Category : </td>
															<td><?=$row['lvlmain_name'].' >> '.$row['lvl1_name'];?></td>
														</tr>
														<tr>
															<td>SKU ID : </td>
															<td><?=$row['sku']?></td>
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
										<h5><?=$row['lvl2_name']?></h5>
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