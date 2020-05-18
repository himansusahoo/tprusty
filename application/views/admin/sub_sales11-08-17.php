<ul class="top-menu">
<?php if($this->session->userdata('logged_in')=='admin@moonboy.in') { ?>
    <li class="<?php if($this->uri->segment(2)=="sales" && $this->uri->segment(3)!="tax" ){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/sales">Orders</a></li>
    <?php /*?><li><a href="<?php echo base_url(); ?>admin/sales/invoice">Invoices</a></li><?php */?>
    <li class="<?php if($this->uri->segment(2)=="track_orders"){echo "selected";} ?>"><a href="#">Track Orders</a>
     <ul> <li> <a href="<?php echo base_url(); ?>admin/track_orders">  In Transist</a> </li>
      <li> <a href="<?php echo base_url(); ?>admin/track_orders/delivered_orders_tracking"> Delivered </a></li>     
    </ul>   
    </li>
    <li class="<?php if($this->uri->segment(2)=="returned_orders"){echo "selected";} ?>"><a href="#">Returns</a>
    
    <ul> <li> <a href="<?php echo base_url(); ?>admin/returned_orders/return_in_progress"> In Progress</a> </li>
      <li> <a href="<?php echo base_url(); ?>admin/returned_orders/return_completed">Completed </a></li>     
    </ul>
    
    </li>
   <?php /*?> <li><a href="<?php echo base_url(); ?>admin/sales/credit_memo">Credit Memos</a></li><?php */?>
    <!--<li><a href="<?//php echo base_url(); ?>admin/sales/transaction">Transaction</a></li>
    <li><a href="<?//php echo base_url(); ?>admin/sales/terms_condition">Terms and Conditions</a></li>-->
    <li class="<?php if($this->uri->segment(2)=="sales" && $this->uri->segment(3)=="tax"){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/sales/tax">Tax</a></li>
    
    <?php }else {
		$user_role_id=$this->session->userdata('logged_userrole_id');
		$main_query=$this->db->query("select * from dashboard_tab_name where user_role_id='$user_role_id' and main_tab_name='Sales' ");
		$row=$main_query->row();
		$main_tab_id=$row->main_tab_id;
		
		$sub_query=$this->db->query("select * from dashboard_sub_tab where main_tab_id='$main_tab_id' ");
		 foreach( $sub_query->result() as $rs)
				{ 
				
				?>
		<li>
		
        <?php if($rs->sub_tab_name=='orders'){ ?>
        
        <a href="<?php echo base_url(); ?>admin/sales">Orders</a>
        
        <?php } ?>
        
        <?php if($rs->sub_tab_name=='track_orders'){ ?>
        
        <a href="#">Track Orders</a>
     	<ul> <li> <a href="<?php echo base_url(); ?>admin/track_orders">  In Transist</a> </li>
      		<li> <a href="<?php echo base_url(); ?>admin/track_orders/delivered_orders_tracking"> Delivered </a></li>     
    	</ul>   
        
        <?php } ?>
        
        <?php if($rs->sub_tab_name=='returns'){ ?>
        
       <a href="#">Returns</a>
    
    	<ul> <li> <a href="<?php echo base_url(); ?>admin/returned_orders/return_in_progress"> In Progress</a> </li>
      		<li> <a href="<?php echo base_url(); ?>admin/returned_orders/return_completed">Completed </a></li>     
    	</ul>
        
        <?php } ?>
        
         <?php if($rs->sub_tab_name=='credit_memos'){ ?>
        
        <a href="<?php echo base_url(); ?>admin/sales/credit_memo">Credit Memos</a>
        
        <?php } ?>
        
        <?php if($rs->sub_tab_name=='transactions'){ ?>
        
        <a href="<?php echo base_url(); ?>admin/sales/transaction">Transaction</a>
        
        <?php } ?>
        
        
         <?php if($rs->sub_tab_name=='terms_conditions'){ ?>
        
        <a href="<?php echo base_url(); ?>admin/sales/terms_condition">Terms and Conditions</a>
        
        <?php } ?>
        
         <?php if($rs->sub_tab_name=='tax'){ ?>
        
        <a href="<?php echo base_url(); ?>admin/sales/tax">Tax</a>
        
        <?php } ?>
        
        
		</li>
		
		<?php }
		
		} ?>
        
        
        
</ul>