<ul class="top-menu">

<?php if($this->session->userdata('logged_in')==ADMIN_MAIL) { ?>
	<li class="<?php if($this->uri->segment(2)=="report" && $this->uri->segment(3)=="" || $this->uri->segment(3)=="filter_order_report" ){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/report">Order Report</a></li>
    <li class="<?php if($this->uri->segment(3)=="return_order_report" || $this->uri->segment(3)=="filter_return_order_report" ){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/report/return_order_report">Return Order Report</a></li>
	
	<li class="<?php if($this->uri->segment(3)=="sales_report" || $this->uri->segment(3)=="filter_sales" ){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/report/sales_report">Sales Report</a></li>
    <li class="<?php if($this->uri->segment(3)=="seller_report" || $this->uri->segment(3)=="filter_seller" ){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/report/seller_report">Seller Report</a></li>
	<li><a href="<?php echo base_url(); ?>admin/report/product_report">Product Report</a></li>
    <li class="<?php if($this->uri->segment(3)=="top_selling" || $this->uri->segment(3)=="filter_topselling" ){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/report/top_selling">Top Selling Product By Seller</a></li>
    <li class="<?php if($this->uri->segment(3)=="buyer_report" || $this->uri->segment(3)=="filter_buyer" ){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/report/buyer_report">Buyer Report</a></li>
    <li class="<?php if($this->uri->segment(3)=="byrwallet_report" || $this->uri->segment(3)=="filter_wallet" ){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/report/byrwallet_report">Buyer Wallet Report</a></li>
    <li class="<?php if($this->uri->segment(3)=="seller_all_payout" || $this->uri->segment(3)=="filter_slrpayout" ){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/payment/seller_all_payout">Seller Payout Report</a></li>
    <li class="<?php if($this->uri->segment(3)=="tax_report" || $this->uri->segment(3)=="filter_tax" ){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/payment/tax_report">Tax Report</a></li>
    <li class="<?php if($this->uri->segment(3)=="slr_profile_report" || $this->uri->segment(3)=="filter_slrprofile" ){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/payment/slr_profile_report">Seller Profile Report</a></li>
    <li class="<?php if($this->uri->segment(3)=="buyer_profile_report" || $this->uri->segment(3)=="filter_buyerprofile" ){echo "selected";} ?>"><a href="<?php echo base_url(); ?>admin/payment/buyer_profile_report">Buyer Profile Report</a></li>
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
					{
			?>
			<li>
				<?php if($rs->sub_tab_name=='order_report'){ ?>
					<a href="<?php echo base_url(); ?>admin/report">Order Report</a>
				<?php } ?>
				<?php if($rs->sub_tab_name=='return_order_report'){ ?>
					<a href="<?php echo base_url(); ?>admin/report/return_order_report">Return Order Report</a>
				<?php } ?>
				
				<?php /* ?><?php if($rs->sub_tab_name=='sales_report'){ ?>
					<a href="<?php echo base_url(); ?>admin/report/sales_report">Sales Report</a>
				<?php } ?>
				<?php if($rs->sub_tab_name=='seller_report'){ ?>
					<a href="<?php echo base_url(); ?>admin/report/seller_report">Seller Report</a>
				<?php } ?>
				<?php if($rs->sub_tab_name=='product_report'){ ?>
					<a href="<?php echo base_url(); ?>admin/report/product_report">Product Report</a>
				<?php } ?>
				<?php if($rs->sub_tab_name=='top_selling_by_seller'){ ?>
					<a href="<?php echo base_url(); ?>admin/report/top_selling">Top Selling Product By Seller</a>
				<?php } ?>
				<?php if($rs->sub_tab_name=='buyer_report'){ ?>
					<a href="<?php echo base_url(); ?>admin/report/buyer_report">Buyer Report</a>
				<?php } ?>
				<?php if($rs->sub_tab_name=='buyer_wallet_report'){ ?>
					<a href="<?php echo base_url(); ?>admin/report/byrwallet_report">Buyer Wallet Report</a>
				<?php } ?>
				<?php if($rs->sub_tab_name=='seller_payout_report'){ ?>
					<a href="<?php echo base_url(); ?>admin/payment/seller_all_payout">Seller Payout Report</a>
				<?php } ?>
				<?php if($rs->sub_tab_name=='tax_report'){ ?>
					<a href="<?php echo base_url(); ?>admin/payment/tax_report">Tax Report</a>
				<?php } ?>
				<?php if($rs->sub_tab_name=='seller_profile_report'){ ?>
					<a href="<?php echo base_url(); ?>admin/payment/slr_profile_report">Seller Profile Report</a>
				<?php } ?>
				<?php if($rs->sub_tab_name=='buyer_profile_report'){ ?>
					<a href="<?php echo base_url(); ?>admin/payment/buyer_profile_report">Buyer Profile Report</a>
				<?php } ?><?php */?>
			</li>
	<?php 
			}
		}
	?> 
    
</ul>