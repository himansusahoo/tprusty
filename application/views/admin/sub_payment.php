<ul class="top-menu">

<?php if($this->session->userdata('logged_in')==ADMIN_MAIL) { ?>
    <li class="<?php if($this->uri->segment(2)=="payment" && $this->uri->segment(3)==""){echo "selected";} ?>"><a href="<?php echo base_url();?>admin/payment">Payout</a></li>
    <li class="<?php if($this->uri->segment(3)=="seller_payout" || $this->uri->segment(3)=="seller_payout_datewise"){echo "selected";} ?>"><a href="<?php echo base_url();?>admin/payment/seller_payout">Seller Payout</a></li>
     <li class="<?php if($this->uri->segment(3)=="buyer_refund"){echo "selected";} ?>"><a href="<?php echo base_url();?>admin/payment/buyer_refund">Buyer Refund</a></li>
     <li class="<?php if($this->uri->segment(3)=="buyer_wallet" || $this->uri->segment(3)=="view_wallet_detail"){echo "selected";} ?>"><a href="<?php echo base_url();?>admin/payment/buyer_wallet">Buyer Wallet</a></li>
     <li class="<?php if($this->uri->segment(3)=="ledger_node" || $this->uri->segment(3)=="ledger_daterange"){echo "selected";} ?>"><a href="<?php echo base_url();?>admin/payment/ledger_node">Ledger</a></li>
     <!--<li><a href="<?php// echo base_url();?>admin/payment/update_sku">UPDATE SKU</a></li>-->
    
     <?php }else {
			$user_role_id=$this->session->userdata('logged_userrole_id');
			$main_query=$this->db->query("select * from dashboard_tab_name where user_role_id='$user_role_id' and main_tab_name='Payments' ");
			$row=$main_query->row();
			$main_tab_id=$row->main_tab_id;
			
			$sub_query=$this->db->query("select * from dashboard_sub_tab where main_tab_id='$main_tab_id' ");
			foreach( $sub_query->result() as $rs)
				{ ?>
				<li>
					<?php if($rs->sub_tab_name=='payout'){ ?>
						<a href="<?php echo base_url(); ?>admin/payment">Payout</a>
					<?php } ?>
					<?php if($rs->sub_tab_name=='seller_payout'){ ?>
						<a href="<?php echo base_url(); ?>admin/payment/seller_payout">Seller Payout</a>
					<?php } ?>
					<?php if($rs->sub_tab_name=='buyer_refund'){ ?>
						<a href="<?php echo base_url(); ?>admin/payment/buyer_refund">Buyer Refund</a>
					<?php } ?>
					<?php if($rs->sub_tab_name=='buyer_wallet'){ ?>
						<a href="<?php echo base_url(); ?>admin/payment/buyer_wallet">Buyer Wallet</a>
					<?php } ?>
					<?php if($rs->sub_tab_name=='ledger'){ ?>
						<a href="<?php echo base_url(); ?>admin/payment/ledger_node">Ledger</a>
					<?php } ?>
				</li>     
        <?php 
				}
			}
		?>				
	
</ul>