<ul>
	<li>Welcome <span  style="color:#fbbc6b; font-weight:bold; "><?php
		if($this->session->userdata('logged_in')=='admin@moonboy.in')
	{
	 echo "Admin";
	}else
	{
		echo 	$this->session->userdata('logged_in');
	}
	
	 
	 ?> </span> </li>
	<li><a href="<?php echo base_url(); ?>admin/super_admin/logout">Logout</a></li> 
</ul>