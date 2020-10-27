<ul class="top-menu">
    <?php 
    if ($this->rbac->has_role('ADMIN')) { ?>

        <li class="<?php
        if ($this->uri->segment(2) == "sellers" && $this->uri->segment(3) == "") {
            echo "selected";
        }
        ?>"><a href="<?php echo base_url(); ?>admin/sellers">Sellers</a></li>

        <li class="<?php
        if ($this->uri->segment(3) == "product_for_approve" || $this->uri->segment(3) == "product_exiting_for_approve" || $this->uri->segment(3) == "sellerwiseproduct_approve" || $this->uri->segment(3) == "filter_seller_product_data" || $this->uri->segment(3) == "filter_seller_existing_product" || $this->uri->segment(3) == "seller_notification_form") {
            echo "selected";
        }
        ?>">
            <a href="#">Product for approval</a>
            <ul>
                <li> <a href="<?php echo base_url(); ?>admin/sellers/product_for_approve">New product</a> </li>
                <li><a href="<?php echo base_url(); ?>admin/sellers/product_exiting_for_approve">Exiting product</a></li>
                <li><a href="<?php echo base_url(); ?>admin/sellers/sellerwiseproduct_approve">Sellerwise Product Approve</a></li>
            </ul>
        </li>
        <li class="<?php
        if ($this->uri->segment(3) == "seller_notification" || $this->uri->segment(3) == "seller_notification_edit") {
            echo "selected";
        }
        ?>"><a href="<?php echo base_url(); ?>admin/sellers/seller_notification">Notification</a></li>
        <li class="<?php
        if ($this->uri->segment(3) == "seller_dispatch_time") {
            echo "selected";
        }
        ?>"><a href="<?php echo base_url(); ?>admin/sellers/seller_dispatch_time">Dispatch Time</a></li>
        <li class="<?php
        if ($this->uri->segment(3) == "seller_badge" || $this->uri->segment(3) == "seller_membership" || $this->uri->segment(3) == "sellerbadgeaddform") {
            echo "selected";
        }
        ?>">
            <a href="#">Badge & Membership</a>
            <ul>
                <li> <a href="<?php echo base_url(); ?>admin/sellers/seller_badge">Seller Badge</a> </li>
                <li><a href="<?php echo base_url(); ?>admin/sellers/seller_membership">Seller Membership</a></li>
            </ul>
        </li>
        <li class="<?php
        if ($this->uri->segment(3) == "default_sellerlist" || $this->uri->segment(3) == "change_productstatus") {
            echo "selected";
        }
        ?>"><a href="<?php echo base_url() . 'admin/sellers/default_sellerlist' ?>">Defaulter Seller</a></li>
        <li class="<?php
        if ($this->uri->segment(3) == "seller_courier_setting") {
            echo "selected";
        }
        ?>"><a href="<?php echo base_url(); ?>admin/sellers/seller_courier_setting">Courier Setup</a></li>
       <!-- <li><a href="<?php //echo base_url();      ?>admin/super_admin/seller_commission">Seller Commission</a></li>-->
        <li class="<?php
        if ($this->uri->segment(3) == "terms_conditions_setup") {
            echo "selected";
        }
        ?>"><a href="<?php echo base_url(); ?>admin/sellers/terms_conditions_setup">Terms & Condtions</a></li>        
        <?php
    } else {

        $user_role_id = $this->session->userdata('logged_userrole_id');
        $main_query = $this->db->query("select * from dashboard_tab_name where user_role_id='$user_role_id' and main_tab_name='Sellers' ");
        $row = $main_query->row();
        $main_tab_id = $row->main_tab_id;

        $sub_query = $this->db->query("select * from dashboard_sub_tab where main_tab_id='$main_tab_id' ");
        foreach ($sub_query->result() as $rs) {
            ?>
            <li>
                <?php if ($rs->sub_tab_name == 'sellers') { ?>
                    <a href="<?php echo base_url(); ?>admin/sellers">Sellers</a>
                <?php } ?>

                <?php if ($rs->sub_tab_name == 'product_for_approval') { ?>
                    <a href="#">Product for approval</a>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>admin/sellers/product_for_approve">New product</a> </li>
                        <li><a href="<?php echo base_url(); ?>admin/sellers/product_exiting_for_approve">Exiting product</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/sellers/sellerwiseproduct_approve">Sellerwise Product Approve</a></li>
                    </ul>
                <?php } ?>
                <?php if ($rs->sub_tab_name == 'notification') { ?>
                    <a href="<?php echo base_url(); ?>admin/sellers/seller_notification">Notification</a>
                <?php } ?>
                <?php if ($rs->sub_tab_name == 'dispatch_time') { ?>
                    <a href="<?php echo base_url(); ?>admin/sellers/seller_dispatch_time">Dispatch Time</a>
                <?php } ?>
                <?php if ($rs->sub_tab_name == 'badge_membership') { ?>
                    <a href="#">Badge & Membership</a>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>admin/sellers/seller_badge">Seller Badge</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/sellers/seller_membership">Seller Membership</a></li>
                    </ul>
                <?php } ?>
                <?php if ($rs->sub_tab_name == 'defaulter_seller') { ?>
                    <a href="<?php echo base_url(); ?>admin/sellers/default_sellerlist">Defaulter Seller</a>
                <?php } ?>
                <?php if ($rs->sub_tab_name == 'courier_setup') { ?>
                    <a href="<?php echo base_url(); ?>admin/sellers/seller_courier_setting">Courier Setup</a>
                <?php } ?>
                <?php if ($rs->sub_tab_name == 'terms_conditions') { ?>
                    <a href="<?php echo base_url(); ?>admin/sellers/terms_conditions_setup">Terms & Condtions</a>
                <?php } ?>
            </li>
            <?php
        }
    }
    ?>
</ul>