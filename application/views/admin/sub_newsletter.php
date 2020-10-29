<ul class="top-menu">

	<?php if($this->rbac->has_role('ADMIN')) { ?>
    <li class="selected"><a href="<?php echo base_url(); ?>admin/newsletter">Newsletter</a></li>
     <?php }else {		 
				$user_role_id=$this->session->userdata('logged_userrole_id');
				$main_query=$this->db->query("select * from dashboard_tab_name where user_role_id='$user_role_id' and main_tab_name='Newsletter' ");
				$row=$main_query->row();
				$main_tab_id=$row->main_tab_id;		
				$sub_query=$this->db->query("select * from dashboard_sub_tab where main_tab_id='$main_tab_id' ");
				foreach($sub_query->result() as $rs)
					{ ?>
				<li>
				<?php if($rs->sub_tab_name=='News_letter'){ ?>        
					<a href="<?php echo base_url(); ?>admin/newsletter">Newsletter</a>
				<?php } ?>
				</li>
		<?php
			}
		}
		?> 
    </ul>