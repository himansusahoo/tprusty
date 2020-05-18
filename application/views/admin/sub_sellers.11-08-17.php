<ul class="top-menu">

<?php if($this->session->userdata('logged_in')=='admin@moonboy.in') { ?>

	<li class="<?php if($this->uri->segment(2)=="sellers" && $this->uri->segment(3)=="" ){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/sellers">Sellers</a></li>
	
    <li class="<?php if($this->uri->segment(3)=="product_for_approve" || $this->uri->segment(3)=="product_exiting_for_approve" || $this->uri->segment(3)=="sellerwiseproduct_approve" || $this->uri->segment(3)=="filter_seller_product_data" || $this->uri->segment(3)=="filter_seller_existing_product" || $this->uri->segment(3)=="seller_notification_form" ){echo "selected";} ?>">
    	<a href="#">Product for approval</a>
        <ul>
        	 <?php   
		  /*$qr=$this->db->query("SELECT prod_approv FROM product_process_status WHERE status_id=1 ");
			$rw=$qr->row();
			if($rw->prod_approv=='process')
			{echo "<li><a href='#'>Please wait product approval is under process.....</a></li>";
			 //redirect('admin/super_admin/home');
			 }else{*/
			 ?>
	
            
            <li> <a href="<?php echo base_url() ; ?>admin/sellers/product_for_approve">New product</a> </li>
      		<li><a href="<?php echo base_url(); ?>admin/sellers/product_exiting_for_approve">Exiting product</a></li>
            
            
            <?php //} ?>
            <li><a href="<?php echo base_url(); ?>admin/sellers/sellerwiseproduct_approve">Sellerwise Product Approve</a></li>
    	</ul>
    </li>
    
    <?php /*?><li><a href="#">Bulk Product Log</a>
    <ul>
    	<li><a href="<?php echo base_url(); ?>admin/Bulk_productlog/bulk_newproductlog">Bulk New Product Upload Log</a></li>
        <li><a href="<?php echo base_url(); ?>admin/Bulk_productlog/bulk_newproduct_editlog">Bulk New Product Edit Log</a></li>
    
    </ul>
    
    </li><?php */?>
    
	<li class="<?php if($this->uri->segment(3)=="seller_notification" || $this->uri->segment(3)=="seller_notification_edit" ){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/sellers/seller_notification">Notification</a></li>
    <li class="<?php if($this->uri->segment(3)=="seller_dispatch_time"){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/sellers/seller_dispatch_time">Dispatch Time</a></li>
    <li class="<?php if($this->uri->segment(3)=="seller_badge" || $this->uri->segment(3)=="seller_membership"|| $this->uri->segment(3)=="sellerbadgeaddform"){echo "selected";} ?>">
		<a href="#">Badge & Membership</a>
		<ul>
        	<li> <a href="<?php echo base_url(); ?>admin/sellers/seller_badge">Seller Badge</a> </li>
      		<li><a href="<?php echo base_url(); ?>admin/sellers/seller_membership">Seller Membership</a></li>
    	</ul>
	</li>
    <li class="<?php if($this->uri->segment(3)=="default_sellerlist" || $this->uri->segment(3)=="change_productstatus"){echo "selected";} ?>"><a href="<?php echo base_url().'admin/sellers/default_sellerlist' ?>">Defaulter Seller</a></li>
    <li class="<?php if($this->uri->segment(3)=="seller_courier_setting" ){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/sellers/seller_courier_setting">Courier Setup</a></li>
   <!-- <li><a href="<?php //echo base_url(); ?>admin/super_admin/seller_commission">Seller Commission</a></li>-->
    <li class="<?php if($this->uri->segment(3)=="terms_conditions_setup" ){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/sellers/terms_conditions_setup">Terms & Condtions</a></li>
    <!--<li><a href="#">Seller's Billing</a></li>-->
    

     <?php }else {
		 
		$user_role_id=$this->session->userdata('logged_userrole_id');
		$main_query=$this->db->query("select * from dashboard_tab_name where user_role_id='$user_role_id' and main_tab_name='Sellers' ");
		$row=$main_query->row();
		$main_tab_id=$row->main_tab_id;
		
		$sub_query=$this->db->query("select * from dashboard_sub_tab where main_tab_id='$main_tab_id' ");
		 foreach($sub_query->result() as $rs)
				{ ?>
		 <li> 
                
                <?php if($rs->sub_tab_name=='sellers'){ ?>
        
        		<a href="<?php echo base_url(); ?>admin/sellers">Sellers</a>
        
        		<?php } ?>
                
               <?php if($rs->sub_tab_name=='promotion'){ ?>
        
        		<a href="#">Promotion</a>
        
        		<?php } ?> 
                
                 <?php if($rs->sub_tab_name=='product_approval'){ ?>
        
        		<a href="#">Product for approval</a>
                    <ul>
					
					<?php   
		  /*$qr=$this->db->query("SELECT prod_approv FROM product_process_status WHERE status_id=1 ");
			$rw=$qr->row();
			if($rw->prod_approv=='process')
			{echo "<li><a href='#'>Please wait product approval is under process.....</a></li>";
			 //redirect('admin/super_admin/home');
			 }else{*/
			 ?>
                        <li> <a href="<?php echo base_url() ; ?>admin/sellers/product_for_approve">New product</a> </li>
                        <li><a href="<?php echo base_url(); ?>admin/sellers/product_exiting_for_approve">Exiting product</a></li>
						
			 <?php //} ?>			
                    </ul>
        
        		<?php } ?> 
                
                <?php if($rs->sub_tab_name=='product_list'){ ?>
        
        		<a href="#">Product list</a>
        
        		<?php } ?> 
                
                
                <?php if($rs->sub_tab_name=='notification_despatch_time'){ ?>
        
        		<a href="<?php echo base_url(); ?>admin/sellers/seller_notification">Notification & Dispatch Time</a>
        
        		<?php } ?> 
                
                 <?php if($rs->sub_tab_name=='membership_badge'){ ?>
        
        		<a href="<?php echo base_url(); ?>admin/sellers/seller_badge">Seller's Badge</a>
        
        		<?php } ?>
                
                <?php if($rs->sub_tab_name=='seller_billing'){ ?>
        
        		<a href="#">Seller's Billing</a>
        
        		<?php } ?>  
		 
		 </li>
		   <?php }
		     }?>
</ul>