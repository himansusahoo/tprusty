<ul class="dashboard-menu">
	<a href="<?php echo base_url(); ?>seller/catalog/new_product_list"> <li <?php if($this->uri->segment(3)=='new_product_list'){ echo 'class="selected"';} ?>> New Product List </li></a>
	<a href="<?php echo base_url(); ?>seller/catalog/exist_product_list"> <li <?php  if($this->uri->segment(3)=='exist_product_list'){ echo 'class="selected"';} ?>> Exist Product List </li></a>
 </ul>