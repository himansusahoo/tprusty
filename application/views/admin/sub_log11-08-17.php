<ul class="top-menu">
	<?php if($this->session->userdata('logged_in')=='admin@moonboy.in') { ?>
    <li class="selected"><a href="<?php echo base_url(); ?>admin/super_admin/email_log">Email Log</a></li>
   
    <!--<li><a href="<?php //echo base_url(); ?>admin/super_admin/errorlog">Error Log</a></li>-->
    
    
 
  
 <!--<li><a href="<?php// echo base_url(); ?>admin/filter">Add to Filter</a></li>-->
  <!--<li><a href="<?php// echo base_url(); ?>admin/seller_penalty">Penalty</a></li>-->
 
 <?php }else {  ?>
		 <li> </li>
		
		 <?php    }?> 
 
 
 
 </ul>