<ul class="top-menu">
	<?php if($this->session->userdata('logged_in')=='admin@moonboy.in') { ?>
    <li class="selected"><a href="<?php echo base_url(); ?>admin/super_admin/email_log">Email Log</a></li>
   
    <!--<li><a href="<?php //echo base_url(); ?>admin/super_admin/errorlog">Error Log</a></li>-->
    
    
 
  
 <!--<li><a href="<?php// echo base_url(); ?>admin/filter">Add to Filter</a></li>-->
  <!--<li><a href="<?php// echo base_url(); ?>admin/seller_penalty">Penalty</a></li>-->
 
 <?php }else {
			$user_role_id=$this->session->userdata('logged_userrole_id');
			$main_query=$this->db->query("select * from dashboard_tab_name where user_role_id='$user_role_id' and main_tab_name='Log' ");
			$row=$main_query->row();
			$main_tab_id=$row->main_tab_id;
			
			$sub_query=$this->db->query("select * from dashboard_sub_tab where main_tab_id='$main_tab_id' ");
			foreach( $sub_query->result() as $rs)
				{ ?>
					<li> 
						<?php if($rs->sub_tab_name=='email_log'){ ?>
							<a href="<?php echo base_url(); ?>admin/super_admin/email_log">Email Log</a>
						<?php } ?>
					</li>
		<?php  
				}
			}
		?>
 </ul>