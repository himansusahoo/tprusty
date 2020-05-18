<?php
		$attr_hedng_row = $product_attr_result->num_rows();	
		if($attr_hedng_row > 0){
	?>
  <div class="row" style="width:98%; margin:auto;">
  	<div class="col-lg-12" style="padding:0;">
    	<h3 class="tittle">Specification</h3>
    </div>
    <div class="col-lg-6">
    </div>
  </div>
	<div class="row" style="width:98%; margin:auto;">
		<?php 
			$prodattr_skucronj=$data_sku;
			$query_attrcronjob=$this->db->query("SELECT * FROM cornjob_productsearch WHERE sku='$prodattr_skucronj'  GROUP BY sku");
			$rw_attrcronjob=$query_attrcronjob->row();
			
			$r=1;
			foreach($product_attr_result->result() as $product_attr_heading_row){
				//$r++;
				$sql = $this->db->query("SELECT product_id FROM product_attribute_value WHERE sku='$product_attr_heading_row->sku'");
				$sku_row = $sql->num_rows();
				if($sku_row > 0){
					$query = $this->db->query("SELECT a.attribute_field_name, b.attr_value FROM attribute_real a INNER JOIN product_attribute_value b ON a.attribute_id = b.attr_id WHERE a.attribute_heading_id ='$product_attr_heading_row->attribute_heading_id' AND b.product_id='$product_attr_heading_row->product_id' AND b.attr_value IS NOT NULL AND (b.attr_value <>  '') group by b.attr_value" );
				}
				else{
					$query = $this->db->query("SELECT a.attribute_field_name, b.attr_value FROM attribute_real a INNER JOIN seller_product_attribute_value b ON a.attribute_id = b.attr_id WHERE a.attribute_heading_id ='$product_attr_heading_row->attribute_heading_id' AND b.sku='$product_attr_heading_row->sku' AND b.attr_value IS NOT NULL AND (b.attr_value <>  '') group by b.attr_value");
				}
		?>
		<div class="col-lg-6">
			<ul id="accordion<?php echo $r;?>" class="accordion<?php echo $r;?>">
				<li>
					<?php 
						
							if($query->num_rows()>0)	
								{
					?>
					<div class="link"><?=$product_attr_heading_row->attribute_heading_name;?><i class="fa fa-chevron-down"></i></div>
					<ul class="submenu" style="display:block;">
						<?php
							$result = $query->result();
								foreach($result as $product_attr_row){
						?>
						<li>
							<a href="#">
								<div class="row">
									<div class="col-lg-6"><?=$product_attr_row->attribute_field_name; ?> :</div>
									<div class="col-lg-6">
										<?php
											if($product_attr_row->attribute_field_name=='Color')
												{
													echo $rw_attrcronjob->color;
												}
											if($product_attr_row->attribute_field_name=='Size')
												{
													echo $rw_attrcronjob->size;
												}
											if($product_attr_row->attribute_field_name=='Capacity')
												{
													echo $rw_attrcronjob->Capacity;
												}
											if($product_attr_row->attribute_field_name=='RAM')
												{
													echo $rw_attrcronjob->RAM;
												}									
											if($product_attr_row->attribute_field_name=='ROM')
												{
													echo $rw_attrcronjob->ROM;
												}
											else if($product_attr_row->attribute_field_name != 'Color' && $product_attr_row->attribute_field_name != 'Size' && $product_attr_row->attribute_field_name != 'Capacity' && $product_attr_row->attribute_field_name != 'RAM'  && $product_attr_row->attribute_field_name != 'ROM')
												{ 
													echo $product_attr_row->attr_value;
												}
										?>
									</div>
								</div>
							</a>
						</li>
						<?php } ?>
					</ul>
					<?php } ?>
					
				</li>
			</ul>
		</div>
		<?php $r++; } ?>
	</div>
	<?php } ?>