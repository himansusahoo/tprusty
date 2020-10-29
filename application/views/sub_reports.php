<ul class="top-menu">

<?php if($this->rbac->has_role('ADMIN')) { ?>
	<li class="selected"><a href="<?php echo base_url(); ?>admin/report">Order Report</a></li>
    <li><a href="<?php echo base_url(); ?>admin/report/return_order_report">Return Order Report</a></li>
    <li><a href="<?php echo base_url(); ?>admin/payment/seller_all_payout">Seller Payout Report</a></li>
    <!--<li><a href="#">Shopping Cart</a></li>
    <li><a href="#">Products</a></li>
    <li><a href="#">Customers</a></li>
    <li><a href="#">Tags</a></li>
    <li><a href="#">Reviews</a></li>-->
    
    
    <?php }else {
		 
		$user_role_id=$this->session->userdata('logged_userrole_id');
		$main_query=$this->db->query("select * from dashboard_tab_name where user_role_id='$user_role_id' and main_tab_name='Reports' ");
		$row=$main_query->row();
		$main_tab_id=$row->main_tab_id;
		
		$sub_query=$this->db->query("select * from dashboard_sub_tab where main_tab_id='$main_tab_id' ");
		 foreach($sub_query->result() as $rs)
				{ ?>   
                
		 <li>
          <?php if($rs->sub_tab_name=='order_report'){ ?>
        
        		<a href="<?php echo base_url(); ?>admin/report">Order Report</a>
        
        <?php } ?>
        
         <?php if($rs->sub_tab_name=='Return_order_report'){ ?>
        
        		<a href="<?php echo base_url(); ?>admin/report/return_order_report">Return Order Report</a>
        
        <?php } ?>
        
         <?php if($rs->sub_tab_name=='shopping_cart_report'){ ?>
        
        		<a href="#">Shopping Cart</a>
        
        <?php } ?>
        
         <?php if($rs->sub_tab_name=='product_report'){ ?>
        
        		<a href="#">Products</a>
        
        <?php } ?>
        
        <?php if($rs->sub_tab_name=='customer_report'){ ?>
        
        		<a href="#">Customers</a>
        
        <?php } ?>
        
        <?php if($rs->sub_tab_name=='tags_report'){ ?>
        
        		<a href="#">Tags</a>
        
        <?php } ?>
        
        <?php if($rs->sub_tab_name=='reviews_report'){ ?>
        
        		<a href="#">Reviews</a>
        
        <?php } ?>
         
         
         </li>
		   <?php }
		     }?> 
    
</ul>