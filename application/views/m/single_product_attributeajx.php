<?php
					$attr_hedng_row = $product_attr_result->num_rows();
					if($attr_hedng_row > 0){					
				?>
               <h3 class="tittle"> Specification </h3>
               <?php    
				$prodattr_skucronj=$data_sku;
						
				$query_attrcronjob=$this->db->query("SELECT * FROM cornjob_productsearch WHERE sku='$prodattr_skucronj' ");
				$rw_attrcronjob=$query_attrcronjob->row();
		 
				 $r=0;
				 foreach($product_attr_result->result() as $product_attr_heading_row){
					$r++;
					
					$sql = $this->db->query("SELECT product_id FROM product_attribute_value WHERE sku='$product_attr_heading_row->sku'");
				$sku_row = $sql->num_rows();
				if($sku_row > 0){
					$query = $this->db->query("SELECT a.attribute_field_name, b.attr_value FROM attribute_real a INNER JOIN product_attribute_value b ON a.attribute_id = b.attr_id WHERE a.attribute_heading_id ='$product_attr_heading_row->attribute_heading_id' AND b.product_id='$product_attr_heading_row->product_id' AND b.attr_value IS NOT NULL AND (b.attr_value <>  '')"
				);
				}else{
					
				
				$query = $this->db->query("SELECT a.attribute_field_name, b.attr_value FROM attribute_real a INNER JOIN seller_product_attribute_value b ON a.attribute_id = b.attr_id WHERE a.attribute_heading_id ='$product_attr_heading_row->attribute_heading_id' AND b.sku='$product_attr_heading_row->sku' AND b.attr_value IS NOT NULL AND (b.attr_value <>  '')"
				);
				}
					if($query->num_rows()>0)	
					{
							?> 
                
                            <button class="first-accordion "><span class="menu-head"><?=$product_attr_heading_row->attribute_heading_name;?> </span></button>
                            <div class="panel" style="max-height: 478100px;">
                                <ul>
                                    <li>
                					<table class="table table-striped table-hover" width="100%">
                                    <?php
										$result = $query->result();
										foreach($result as $product_attr_row){
										?>
                                    
                                    <tr style="border-bottom:1px solid #ccc;">
                                         <td style="font-size: 13px; color: #333;" width="30%"> <?=$product_attr_row->attribute_field_name; ?> :  </td>
                                         <td style="font-size: 13px; color: #333;">
                                         	<?php
									if($product_attr_row->attribute_field_name=='Color')
									{echo $rw_attrcronjob->color;}
									if($product_attr_row->attribute_field_name=='Size')
									{echo $rw_attrcronjob->size;}
									if($product_attr_row->attribute_field_name=='Capacity')
									{echo $rw_attrcronjob->Capacity;}
									if($product_attr_row->attribute_field_name=='RAM')
									{echo $rw_attrcronjob->RAM;}
									if($product_attr_row->attribute_field_name=='ROM')
									{echo $rw_attrcronjob->ROM;}
									
									else if($product_attr_row->attribute_field_name != 'Color' && $product_attr_row->attribute_field_name != 'Size' && $product_attr_row->attribute_field_name != 'Capacity' && $product_attr_row->attribute_field_name != 'RAM'  && $product_attr_row->attribute_field_name != 'ROM')
									{ echo $product_attr_row->attr_value; }
									 
									 ?>
                                         </td> </tr> 
                                         <?php } ?>
                                </table>
                                    
									</li>
                                    </ul>
                                </div>
                               <?php } } ?>
							<?php } ?>
					