<ul class="dashboard-menu">
	<a href="<?php echo base_url(); ?>admin/super_admin/size_setup"> <li <?php if($this->uri->segment(3)=='size_setup'){ echo 'class="selected"';} ?>> Size Setup </li></a>
	<a href="<?php echo base_url(); ?>admin/super_admin/color_setup"> <li <?php  if($this->uri->segment(3)=='color_setup'){ echo 'class="selected"';} ?>> Color Setup </li></a>
    
     </ul>
 