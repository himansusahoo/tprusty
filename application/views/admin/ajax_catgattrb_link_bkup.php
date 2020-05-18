 <?php 
if( $editedprod_catg!=''){
 $query=$this->db->query("SELECT * FROM attribute_group WHERE attribute_group_id IN ($editedprod_catg)");
 
 
 ?>
 Attribute Set Type <sup>*</sup> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select class="seller_input" id="attribute_set" name="attribute_set" style="width:400px;" >
                                 <option value="">--Choose Attribute--</option>
                                 
                           <?php 
								 	$attribute = $query->result_array();
											foreach($attribute as $row) { 
											
												?>
											<option value="<?php echo $row['attribute_group_id']; ?>"><?php echo $row['attribute_group_name']; ?></option>
											<?php 
												//}
											//endforeach;
									}}else{?>
												 
										                            
</select>
<span style="color:#C00;">No Attribute Found!</span>
<?php }?>