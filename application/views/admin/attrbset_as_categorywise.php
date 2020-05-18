 Attribute Set Type <sup>*</sup> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select class="seller_input" id="attribute_set" name="attribute_set" style="width:400px;" >
                                 <option value="">--Choose Attribute--</option>
                                 
                           <?php 
								 	$attribute = $edit_attrbset->result_array(); 
									if($attribute) :
											foreach($attribute as $row) : 
											//if(in_array($row['attribute_group_id'],$edit_attrbsetarr)){
												?>
											<option value="<?php echo $row['attribute_group_id']; ?>"><?php echo $row['attribute_group_name']; ?></option>
											<?php 
												//}
											endforeach;
											endif;
										?>
                                 
</select>