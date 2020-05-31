<ul class="top-menu">
	<?php if($this->session->userdata('logged_in')==ADMIN_MAIL) { ?>
    <li class="<?php if($this->uri->segment(3)=="membership" ){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/super_admin/membership">Membership</a></li>
    <li class="<?php if($this->uri->segment(3)=="seller_commission" || $this->uri->segment(3)=="global_commission" || $this->uri->segment(3)=="membership_commission" || $this->uri->segment(3)=="special_commission" || $this->uri->segment(3)=="edit_special_commission" || $this->uri->segment(3)=="add_special_commission" ){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/super_admin/seller_commission">Seller Commission</a></li>
    <li class="<?php if($this->uri->segment(3)=="charges" ){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/super_admin/charges">Other Charges</a></li>
	<li class="<?php if($this->uri->segment(3)=="image_upload" || $this->uri->segment(3)=="subpage1_setting" || $this->uri->segment(3)=="subpage2_setting" || $this->uri->segment(3)=="subpage3_setting" || $this->uri->segment(3)=="ad_blog" ){echo "selected";} ?>"><a href="#">Homepage Image Setting</a>
    <ul> 
		<li><a href="<?php echo base_url(); ?>admin/configuration/image_upload">Slider Image Setting</a></li>
		<li><a href="<?php echo base_url(); ?>admin/configuration/subpage1_setting">Block1 Image setting</a></li>
		<li><a href="<?php echo base_url(); ?>admin/configuration/subpage2_setting">Block2 Image setting</a></li>
        <li><a href="<?php echo base_url(); ?>admin/configuration/subpage3_setting">Block3 Image setting</a></li>
        <li><a href="<?php echo base_url(); ?>admin/configuration/ad_blog">Advertisement Blog</a></li>
    </ul>

 <li class="<?php if($this->uri->segment(3)=="user_setup" || $this->uri->segment(3)=="user_log" || $this->uri->segment(3)=="edit_user_role"  || $this->uri->segment(3)=="load_user_setup_setting" || $this->uri->segment(3)=="new_user_setup" ){echo "selected";} ?>"><a href="#">Users </a>
 
 <ul> 
		<li><a href="<?php echo base_url(); ?>admin/super_admin/user_setup">Manage User Role</a></li>
		<li><a href="<?php echo base_url(); ?>admin/super_admin/user_log">User Log</a></li>
		
    </ul>
 </li>
 
  <li class="<?php if($this->uri->segment(3)=="voucher"){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/super_admin/voucher">Voucher</a></li>
  
  <li class="<?php if($this->uri->segment(3)=="pcmenu_setup" || $this->uri->segment(3)=="mobilemenu_setup" || $this->uri->segment(3)=="edit_pcmenu" || $this->uri->segment(3)=="edit_mobilemenu"){echo "selected";} ?>"><a href="#">Category Menu Setup</a>  
  <ul> 
		<li><a href="<?php echo base_url(); ?>admin/super_admin/pcmenu_setup">Desktop Menu</a></li>
		<li><a href="<?php echo base_url(); ?>admin/super_admin/mobilemenu_setup">Mobile Menu</a></li>
       <!-- <li><a href="#">Mobile Menu</a></li>-->
		
    </ul>
    
     
  </li>
  
  
		<li class="<?php if($this->uri->segment(3)=="cod_setup" || $this->uri->segment(3)=="cod_taxrate_setup" || $this->uri->segment(3)=="cod_amounttocharge_setup" || $this->uri->segment(3)=="cod_discount_setup"){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/super_admin/cod_setup">COD Setup</a></li>
        
       
        <li class="<?php if($this->uri->segment(3)=="productfilter_setup"){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/super_admin/productfilter_setup">Filter Setup</a></li>
        <li class="<?php if($this->uri->segment(3)=="size_setup" || $this->uri->segment(3)=="color_setup"){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/super_admin/size_setup">Size & Color Setup</a></li>
        <li class="<?php if($this->uri->segment(3)=="cateattributelink"){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/super_admin/cateattributelink">Category Attribute Link Setup</a></li>
        <li class="<?php if($this->uri->segment(3)=="bulk_newproductlog" || $this->uri->segment(3)=="bulk_newproduct_editlog" || $this->uri->segment(3)=="filter_newproduploadlog"){echo "selected";} ?>"><a href="#">Bulk Product Log</a>
    <ul>
    	<li><a href="<?php echo base_url(); ?>admin/Bulk_productlog/bulk_newproductlog">Bulk New Product Upload Log</a></li>
        <li><a href="<?php echo base_url(); ?>admin/Bulk_productlog/bulk_newproduct_editlog">Bulk New Product Edit Log</a></li>
    
    </ul>
    
    </li>
        <li class="<?php if($this->uri->segment(3)=="bulk_newprod_addexcelsheetracking" || $this->uri->segment(2)=="Bulk_newprod_reupload" ){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/Bulk_newproducttrackingexcelsheet/bulk_newprod_addexcelsheetracking">Bulk New Product Excelsheet Tracking</a></li>
		
      <li class="<?php if($this->uri->segment(3)=="bulk_newprod_deletepanel"){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/Bulk_productdelete/bulk_newprod_deletepanel">Bulk Product Delete</a></li>
      
      <!-- <ul>
    	<li><a href="<?php //echo base_url(); ?>admin/Bulk_productdelete/bulk_newprod_deletepanel">Bulk New Product Delete</a></li>
        <li><a href="<?php //echo base_url(); ?>admin/Bulk_productdelete/bulk_existingproductdelete">Bulk Existing Product Delete</a></li>
    
    </ul>-->
      <li class="<?php if($this->uri->segment(3)=="advance_productsearch" || $this->uri->segment(2)=="Advance_search"){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/super_admin/advance_productsearch">Advance Search</a></li>
      
      <li class="<?php if($this->uri->segment(2)=="search_keyword_setup"){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/search_keyword_setup">Search Keyword Setup</a></li>
      
      <li class="<?php if($this->uri->segment(2)=="page_setup" || $this->uri->segment(2)=="Page_setup" || $this->uri->segment(2)=="Page_catlog" || $this->uri->segment(2)=="Page_catlog" || $this->uri->segment(2)=="Page_catlog" || $this->uri->segment(2)=="page_catlog" || $this->uri->segment(2)=="Page_single_product"|| $this->uri->segment(2)=="Desktop_page_setup"){echo "selected";} ?>"><a href="#">Page Design</a>      	
        <ul>
		<li><!--<a href="#">Desktop</a>-->
			<a href="<?php echo base_url(); ?>admin/Desktop_page_setup">Desktop</a>
        </li>
        <li><a href="<?php echo base_url(); ?>admin/Page_setup">Mobile</a></li>       
   		</ul>      
      </li>
	 <li class="<?php if($this->uri->segment(2)=="Cache"){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/Cache/dltcachefld">Manage Cache</a></li>
    <li class="<?php if($this->uri->segment(2)=="Solar_manage"){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/Solar_manage">Manage Solar Indexing</a></li>
    <li class="<?php if($this->uri->segment(2)=="Solar_search_log"){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/Solar_search_log/solr_searchlog">Solr Search Log</a></li>
    
    <li class="<?php if($this->uri->segment(2)=="update_postal_code_cnt"){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/update_postal_code_cnt/update_postal_code">Update Postal Pincode</a></li>
  
 <!--<li><a href="<?php// echo base_url(); ?>admin/filter">Add to Filter</a></li>-->
  <!--<li><a href="<?php// echo base_url(); ?>admin/seller_penalty">Penalty</a></li>-->
 
 <?php }else {
			$user_role_id=$this->session->userdata('logged_userrole_id');
			$main_query=$this->db->query("select * from dashboard_tab_name where user_role_id='$user_role_id' and main_tab_name='Config' ");
			$row=$main_query->row();
			$main_tab_id=$row->main_tab_id;
		
			$sub_query=$this->db->query("select * from dashboard_sub_tab where main_tab_id='$main_tab_id' ");
			foreach($sub_query->result() as $rs)
				{ ?>
			<li>
				<?php if($rs->sub_tab_name=='membership'){ ?>
					<a href="<?php echo base_url(); ?>admin/super_admin/membership">Membership</a>          
				<?php } ?>
				<?php if($rs->sub_tab_name=='seller_commission'){ ?>
					<a href="<?php echo base_url(); ?>admin/super_admin/seller_commission">Seller Commission</a>          
				<?php } ?>
				<?php if($rs->sub_tab_name=='other_charges'){ ?>
					<a href="<?php echo base_url(); ?>admin/super_admin/charges">Other Charges</a>          
				<?php } ?>
				<?php if($rs->sub_tab_name=='homepage_image_setting'){ ?>
					<a href="#">Homepage Image Setting</a>
					<ul> 
						<li><a href="<?php echo base_url(); ?>admin/configuration/image_upload">Slider Image Setting</a></li>
						<li><a href="<?php echo base_url(); ?>admin/configuration/subpage1_setting">Block1 Image setting</a></li>
						<li><a href="<?php echo base_url(); ?>admin/configuration/subpage2_setting">Block2 Image setting</a></li>
						<li><a href="<?php echo base_url(); ?>admin/configuration/subpage3_setting">Block3 Image setting</a></li>
						<li><a href="<?php echo base_url(); ?>admin/configuration/ad_blog">Advertisement Blog</a></li>
					</ul>
				<?php } ?>
				<?php if($rs->sub_tab_name=='user_role'){ ?>
					<a href="#">Users</a>
					<ul>
						<li><a href="<?php echo base_url(); ?>admin/super_admin/user_setup">Manage User Role</a></li>
						<li><a href="<?php echo base_url(); ?>admin/super_admin/user_log">User Log</a></li>
					</ul>
				<?php } ?>
				<?php if($rs->sub_tab_name=='voucher'){ ?>
					<a href="<?php echo base_url(); ?>admin/super_admin/voucher">Voucher</a>          
				<?php } ?>
				<?php if($rs->sub_tab_name=='category_menu_setup'){ ?>
					<a href="#">Category Menu Setup</a>
					<ul>
						<li><a href="<?php echo base_url(); ?>admin/super_admin/pcmenu_setup">Desktop Menu</a></li>
						<li><a href="<?php echo base_url(); ?>admin/super_admin/mobilemenu_setup">Mobile Menu</a></li>
					</ul>
				<?php } ?>
				<?php if($rs->sub_tab_name=='cod_setup'){ ?>
					<a href="<?php echo base_url(); ?>admin/super_admin/cod_setup">COD Setup</a>          
				<?php } ?>
				<?php if($rs->sub_tab_name=='filter_setup'){ ?>
					<a href="<?php echo base_url(); ?>admin/super_admin/productfilter_setup">Filter Setup</a>          
				<?php } ?>
				<?php if($rs->sub_tab_name=='size_colour'){ ?>
					<a href="<?php echo base_url(); ?>admin/super_admin/size_setup">Size & Color Setup</a>          
				<?php } ?>
				<?php if($rs->sub_tab_name=='category_att_link'){ ?>
					<a href="<?php echo base_url(); ?>admin/super_admin/cateattributelink">Category Attribute Link Setup</a>          
				<?php } ?>
				<?php if($rs->sub_tab_name=='bulk_product_log'){ ?>
					<a href="#">Bulk Product Log</a>
					<ul>
						<li><a href="<?php echo base_url(); ?>admin/Bulk_productlog/bulk_newproductlog">Bulk New Product Upload Log</a></li>
						<li><a href="<?php echo base_url(); ?>admin/Bulk_productlog/bulk_newproduct_editlog">Bulk New Product Edit Log</a></li>
					</ul>
				<?php } ?>
				<?php if($rs->sub_tab_name=='bulk_product_excel_track'){ ?>
					<a href="<?php echo base_url(); ?>admin/Bulk_newproducttrackingexcelsheet/bulk_newprod_addexcelsheetracking">Bulk New Product Excelsheet Tracking</a>          
				<?php } ?>
				<?php if($rs->sub_tab_name=='bulk_product_delete'){ ?>
					<a href="<?php echo base_url(); ?>admin/Bulk_productdelete/bulk_newprod_deletepanel">Bulk Product Delete</a>          
				<?php } ?>
				<?php if($rs->sub_tab_name=='advance_search'){ ?>
					<a href="<?php echo base_url(); ?>admin/super_admin/advance_productsearch">Advance Search</a>          
				<?php } ?>
				<?php if($rs->sub_tab_name=='search_keyword_setup'){ ?>
					<a href="<?php echo base_url(); ?>admin/search_keyword_setup">Search Keyword Setup</a>          
				<?php } ?>
				<?php if($rs->sub_tab_name=='page_design'){ ?>
					<a href="#">Page Design</a>
					<ul>
						<li>
							<a href="<?php echo base_url(); ?>admin/Desktop_page_setup">Desktop</a>
						</li>
						<li>
							<a href="<?php echo base_url(); ?>admin/Page_setup">Mobile</a></li>       
						</ul>  
				<?php } ?>
				<?php if($rs->sub_tab_name=='manage_cache'){ ?>
					<a href="<?php echo base_url(); ?>admin/Cache/dltcachefld">Manage Cache</a>          
				<?php } ?>
				<?php if($rs->sub_tab_name=='manage_solar_index'){ ?>
					<a href="<?php echo base_url(); ?>admin/Solar_manage">Manage Solar Indexing</a>          
				<?php } ?>
			</li>
	<?php 
			}
		}
	?>
 </ul>