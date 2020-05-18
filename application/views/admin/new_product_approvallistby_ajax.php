<table class="table table-bordered">

<tr style="display:;">
                            <?php
							
							if($fltr_product_nm){ ?>
                            <td colspan="9">Filtered Data  as  Product Name:- <?php echo $fltr_product_nm;?> 
                            </td>
                           <?php }
							
							else if($fltr_slr_nm){ ?>
                            <td colspan="9">Filtered Data  as Seller Name:- <?php echo $fltr_slr_nm;?> 
                            </td>
                            <?php }
							
							else if($product_sts){ ?>
                            <td colspan="9">Filtered Data  as  Product Status:-<?php echo $product_sts;?> 
                            </td>
                            <?php }
							
							else if($from_dt && $to_dt){ ?>
                            <td colspan="9">Filtered Data  as  Date:- <?php echo $from_dt;?> <?php echo $to_dt;?>
                            </td>
                            <?php } ?>
                            </tr>
                            
                           
                            
                            
                            <tr class="table_th">
							<th class="a-center" width="5%"><input type="checkbox" id="check_all"/></th>
							<th width="10%">Image</th>
                            <th width="10%">Date</th>
							<th width="20%">Name</th>
							<th width="10%">Seller Name</th>
							<th width="10%">Status</th>
                            <th width="5%"> Action </th>
						</tr>

<?php 
                            $rows = $result->num_rows();
                            if($rows > 0){ ?>
                            
                            
                             <tr>
												
												<td colspan="7">Actions
                                                   	<select name="product_action" id="product_action">
														<option value="">--Choose Action--</option>
														<option value="Active">Active</option>
                                                        <option value="Pending">Pending</option>
                                                        <option value="Suspended">Suspended</option>
                                                        <option value="Rejected">Rejected</option>
													</select>
												
												<input type="button" class="all_buttons" id="product_action_btn" onClick="changeProductStatus()" value="Submit">
											</td></tr>
                            	<?php foreach ($result->result() as $row){
									$arr_img = explode(',',$row->image);
									$first_img = $arr_img[0];
									
									//script start for registration process not completed seller condition.
									$slr_sql = $this->db->query("SELECT * FROM seller_account_information WHERE seller_id='$row->seller_id'");
									$slr_sql_row = $slr_sql->num_rows();
									if($slr_sql_row < 1){
                        ?>
						<tr style="color:#FF3737;">
							<td class="a-center"><input type="checkbox" name="chk_sellr[]" id="chk_sellr" value="<?=$row->seller_product_id ; ?>"></td>
                            <td><img src="<?php echo base_url().'images/product_img/'.$first_img; ?>" class="list_img"></td>
							<td><?=$row->date_added ;?></td>
							<td><?=$row->name ;?></td>
							<td><?=$row->seller_name ;?></td>
							<td><?=$row->product_approve?><br/><span style="font-size:10px;">Incomplete Registration</span></td>
						</tr>
                        <?php }else{ // End of registration process not completed seller condition.?>
                        <tr>
							<td class="a-center"><input type="checkbox" name="chk_sellr[]" id="chk_sellr" value="<?=$row->seller_product_id ; ?>"></td>
                            <td><img src="<?php echo base_url().'images/product_img/'.$first_img; ?>" class="list_img"></td>
							<td><?=$row->date_added ;?></td>
							<td><?=$row->name ;?></td>
							<td><?=$row->seller_name ;?></td>
							<td><?=$row->product_approve?></td>
                           <td>
                           <?php if($row->master_product_id == 0){?>
                           		<a href="<?php echo base_url(); ?>admin/catalog/pending_product_edit/<?=$row->seller_product_id;?>/<?= base64_encode($this->encrypt->encode($row->sku));?>">Edit</a>
                           <?php }else{?>
                           		<a href="<?php echo base_url(); ?>admin/catalog/product_edit/<?=$row->master_product_id;?>/<?= base64_encode($this->encrypt->encode($row->sku));?>">Edit</a>
                           <?php } ?>
                           </td>
						</tr>
						<?php 
								}
							}
                          }else{
                        ?>
                       <tr> <td  colspan="7"> No Data Found</td></tr> 
                        <?php } ?>
						
                 </table>       