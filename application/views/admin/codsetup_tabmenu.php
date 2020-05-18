<ul class="dashboard-menu">
	<a href="<?php echo base_url(); ?>admin/super_admin/cod_setup"> <li <?php if($this->uri->segment(3)=='cod_setup'){ echo 'class="selected"';} ?>> COD Charges As Per Weight </li></a>
	<a href="<?php echo base_url(); ?>admin/super_admin/cod_taxrate_setup"> <li <?php  if($this->uri->segment(3)=='cod_taxrate_setup'){ echo 'class="selected"';} ?>> Tax Entry </li></a>
    
    <a href="<?php echo base_url(); ?>admin/super_admin/cod_amounttocharge_setup"> <li <?php  if($this->uri->segment(3)=='cod_amounttocharge_setup'){ echo 'class="selected"';} ?>> Amount To Be Charge </li></a>
    
     <a href="<?php echo base_url(); ?>admin/super_admin/cod_discount_setup"> <li <?php  if($this->uri->segment(3)=='cod_discount_setup'){ echo 'class="selected"';} ?>> Discount Entry </li></a>
 </ul>
 