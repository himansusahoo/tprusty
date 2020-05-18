<ul class="top-menu">

<?php if($this->session->userdata('logged_in')=='admin@moonboy.in') { ?>
    <li class="<?php if($this->uri->segment(2)=="catalog" && $this->uri->segment(3)=="" || $this->uri->segment(3)=="product_edit" ){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/catalog">Manage Products</a></li>
    <li class="<?php if($this->uri->segment(3)=="manage_category"){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/catalog/manage_category">Manage Categories</a></li>
    <li class="<?php if($this->uri->segment(2)=="attribute" || $this->uri->segment(2)=="Attribute"){echo "selected";} ?>"><a href="">Attributes</a>
    <ul> <li class="<?php if($this->uri->segment(2)=="attribute" && $this->uri->segment(3)==""){echo "selected";} ?>"> <a href="<?php echo base_url(); ?>admin/attribute">  Manage Attribute Group</a> </li>
      <li class="<?php if($this->uri->segment(2)=="attribute" && $this->uri->segment(3)=="add_new_attribute"){echo "selected";} ?>"> <a href="<?php echo base_url(); ?>admin/attribute/add_new_attribute"> Manage Attribute </a></li>
     
    </ul></li>
     <!--<li><a href="<?php// echo base_url(); ?>admin/shipment">Shipment Settings</a></li>-->
    <!--<li><a href="#">Reviews and rating</a></li>
    
    <li><a href="#">Tags</a></li>-->
    
     <?php }else {
		$user_role_id=$this->session->userdata('logged_userrole_id');
		$main_query=$this->db->query("select * from dashboard_tab_name where user_role_id='$user_role_id' and main_tab_name='Catalog' ");
		$row=$main_query->row();
		$main_tab_id=$row->main_tab_id;
		
		$sub_query=$this->db->query("select * from dashboard_sub_tab where main_tab_id='$main_tab_id' ");
		 foreach($sub_query->result() as $rs)
				{ ?>
               <li> 
                
                <?php if($rs->sub_tab_name=='manage_product'){ ?>
        
        		<a href="<?php echo base_url(); ?>admin/catalog">Manage Products</a>
        
        		<?php } ?>
                
                 <?php if($rs->sub_tab_name=='manage_catageories'){ ?>
        
        		<a href="<?php echo base_url(); ?>admin/catalog/manage_category">Manage Categories</a>
        
        		<?php } ?>
                 <?php if($rs->sub_tab_name=='attributes'){ ?>
        
        		<a href="">Attributes</a>
                    <ul> 
                    <li> <a href="<?php echo base_url(); ?>admin/attribute">  Manage Attribute Group</a> </li>
                    <li> <a href="<?php echo base_url(); ?>admin/attribute/add_new_attribute"> Manage Attribute </a></li>
             
                     </ul>    
        		<?php } ?>
                
                 <?php if($rs->sub_tab_name=='shipment_setting'){ ?>
        
        		<a href="<?php echo base_url(); ?>admin/shipment">Shipment Settings</a>
        
        		<?php } ?>
                
                
                 <?php if($rs->sub_tab_name=='review_ratings'){ ?>
        
        		<a href="#">Reviews and rating</a>
        
        		<?php } ?>
                
                
                 <?php if($rs->sub_tab_name=='tags'){ ?>
        
        		<li><a href="#">Tags</a></li>
        
        		<?php } ?>
                
             </li>     
                <?php }  }?>
				
	
</ul>