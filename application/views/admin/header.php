<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html">
        <title>Dashboard</title>
        <meta name="author" content="">
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>css/admin/styles.css">
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>css/admin/font-awesome.min.css">
        <link href="<?php echo base_url(); ?>css/admin/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/admin/bootstrap.min.css">
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
        <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    </head>

    <body>
        <div id="w">
            <ul id="sidemenu">
                <?php
                if ($this->rbac->has_role('ADMIN')) {
                    ?>
                    <li> <a href="<?php echo base_url(); ?>admin/super_admin/home" class="<?php
                        if ($this->uri->segment(3) == "home") {
                            echo "open";
                        }
                        ?>"> <i class="fa fa-tachometer"></i> <span> Dashboard </span></a></li>
                    <li> <a href="<?php echo base_url(); ?>admin/sales" class="<?php
                        if ($this->uri->segment(2) == "sales" && $this->uri->segment(3) != "tax" || $this->uri->segment(2) == "track_orders" || $this->uri->segment(2) == "returned_orders" || $this->uri->segment(2) == "sales" && $this->uri->segment(3) == "tax") {
                            echo "open";
                        }
                        ?>"> <i class="fa fa-shopping-cart"></i> <span> Orders </span></a></li>


                    <li> <a href="<?php echo base_url(); ?>admin/payment" class="<?php
                        if ($this->uri->segment(2) == "payment" && $this->uri->segment(3) == "" || $this->uri->segment(3) == "ledger_node" || $this->uri->segment(3) == "buyer_wallet" || $this->uri->segment(3) == "buyer_refund" || $this->uri->segment(3) == "seller_payout") {
                            echo "open";
                        }
                        ?>"> <i class="fa fa-shopping-cart"></i> <span> Payments </span></a></li>



                    <li> <a href="<?php echo base_url(); ?>admin/catalog" class="<?php
                        if ($this->uri->segment(2) == "catalog" || $this->uri->segment(2) == "attribute") {
                            echo "open";
                        }
                        ?>"> <i class="fa fa-list"></i> <span> Catalog </span></a></li>
                    <li> <a href="<?php echo base_url(); ?>admin/sellers" class="<?php
                        if ($this->uri->segment(2) == "sellers" && $this->uri->segment(3) != "seller_porfile") {
                            echo "open";
                        }
                        ?>"> <i class="fa fa-user"></i> <span>Sellers </span></a></li>
                    <li> <a href="<?php echo base_url(); ?>admin/customers" class="<?php
                        if ($this->uri->segment(2) == "customers") {
                            echo "open";
                        }
                        ?>"> <i class="fa fa-users"></i> <span>Customers </span></a></li>
                    <!--<li> <a href="<?php //echo base_url();                ?>admin/promotions"> <i class="fa fa-file-text-o"></i> <span> Promotions </span></a></li>-->
                    <li> <a href="<?php echo base_url(); ?>admin/pages" class="<?php
                        if ($this->uri->segment(2) == "pages") {
                            echo "open";
                        }
                        ?>"> <i class="fa fa-files-o"></i> <span> Pages </span></a></li>


                    <li> 
                        <a href="<?php echo base_url('all-reports'); ?>" class="<?php
                        if ($this->uri->segment(1) == "all-reports" || array_key_exists($this->uri->segment(1), $this->rbac->temp_sub_menus('admin_reports'))) {
                            echo "open";
                        }
                        ?>"> <i class="fa fa-file-text"></i> <span>Reports </span></a>
                    </li>

                    <li> <a href="<?php echo base_url(); ?>admin/newsletter" class="<?php
                        if ($this->uri->segment(2) == "newsletter") {
                            echo "open";
                        }
                        ?>"> <i class="fa fa-file-text"></i> <span>Newsletter</span></a></li>
                                    <!--<li> <a href="<?php //echo base_url();               ?>admin/configuration"> <i class="fa fa-cogs"></i> <span>Config </span></a></li>-->
                    <li> <a href="<?php echo base_url(); ?>admin/super_admin/membership" class="<?php
                        if ($this->uri->segment(3) == "membership" || $this->uri->segment(3) == "charges" || $this->uri->segment(3) == "image_upload" || $this->uri->segment(3) == "subpage1_setting" || $this->uri->segment(3) == "subpage2_setting" || $this->uri->segment(3) == "subpage3_setting" || $this->uri->segment(3) == "ad_blog" || $this->uri->segment(3) == "user_setup" || $this->uri->segment(3) == "user_log" || $this->uri->segment(3) == "edit_user_role" || $this->uri->segment(3) == "load_user_setup_setting" || $this->uri->segment(3) == "new_user_setup" || $this->uri->segment(3) == "voucher" || $this->uri->segment(3) == "pcmenu_setup" || $this->uri->segment(3) == "mobilemenu_setup" || $this->uri->segment(3) == "edit_pcmenu" || $this->uri->segment(3) == "edit_mobilemenu" || $this->uri->segment(3) == "cod_setup" || $this->uri->segment(3) == "cod_taxrate_setup" || $this->uri->segment(3) == "cod_amounttocharge_setup" || $this->uri->segment(3) == "cod_discount_setup" || $this->uri->segment(3) == "productfilter_setup" || $this->uri->segment(3) == "size_setup" || $this->uri->segment(3) == "color_setup" || $this->uri->segment(3) == "cateattributelink" || $this->uri->segment(3) == "bulk_newproductlog" || $this->uri->segment(3) == "bulk_newproduct_editlog" || $this->uri->segment(3) == "filter_newproduploadlog" || $this->uri->segment(3) == "bulk_newprod_addexcelsheetracking" || $this->uri->segment(2) == "Bulk_newprod_reupload" || $this->uri->segment(3) == "bulk_newprod_deletepanel" || $this->uri->segment(3) == "advance_productsearch" || $this->uri->segment(2) == "Advance_search" || $this->uri->segment(2) == "search_keyword_setup" || $this->uri->segment(2) == "page_setup" || $this->uri->segment(2) == "Page_setup" || $this->uri->segment(2) == "Page_catlog" || $this->uri->segment(2) == "Page_catlog" || $this->uri->segment(2) == "Page_catlog" || $this->uri->segment(2) == "page_catlog" || $this->uri->segment(2) == "Page_single_product" || $this->uri->segment(3) == "seller_commission" || $this->uri->segment(3) == "global_commission" || $this->uri->segment(3) == "membership_commission" || $this->uri->segment(3) == "special_commission" || $this->uri->segment(3) == "edit_special_commission" || $this->uri->segment(3) == "add_special_commission" || $this->uri->segment(2) == "Solar_manage" || $this->uri->segment(2) == "Desktop_page_setup" || $this->uri->segment(2) == "Cache" || $this->uri->segment(2) == "Solar_search_log") {
                            echo "open";
                        }
                        ?>"> <i class="fa fa-cogs"></i> <span>Config </span></a></li>
                    <li> <a href="<?php echo base_url(); ?>admin/super_admin/email_log" class="<?php
                        if ($this->uri->segment(3) == "filter_emaillog" || $this->uri->segment(3) == "email_log") {
                            echo "open";
                        }
                        ?>"> <i class="fa fa-cogs"></i> <span>Log </span></a></li>

                    <li><a href="<?php echo base_url(); ?>admin/sellers/seller_porfile" class="<?php
                        if ($this->uri->segment(2) == "sellers" && $this->uri->segment(3) == "seller_porfile") {
                            echo "open";
                        }
                        ?>"><i class="fa fa-user" aria-hidden="true"></i> <span>BDM </span></a></li>



                    <?php
                } else {
                    $user_role_id = $this->session->userdata('logged_userrole_id');
                    $query = $this->db->query("select * from dashboard_tab_name where user_role_id='$user_role_id' ");
                    ?>
                    <li> <a href="<?php echo base_url(); ?>admin/super_admin/home" class="open"> <i class="fa fa-tachometer"></i> <span> Dashboard </span></a></li>

                    <?php
                    foreach ($query->result() as $rs) {
                        ?>

                        <li> 
                            <?php if ($rs->main_tab_name == 'Sales') { ?>

                                <a href="<?php echo base_url(); ?>admin/sales"> <i class="fa fa-shopping-cart"></i> <span> Orders</span></a>
                            <?php } ?>

                            <?php if ($rs->main_tab_name == 'Catalog') { ?>

                                <a href="<?php echo base_url(); ?>admin/catalog"> <i class="fa fa-list"></i> <span> Catalog </span></a>
                            <?php } ?>


                            <?php if ($rs->main_tab_name == 'Sellers') { ?>

                                <a href="<?php echo base_url(); ?>admin/sellers"><i class="fa fa-user"></i> <span>Sellers </span></a>
                            <?php } ?>

                            <?php if ($rs->main_tab_name == 'Payments') { ?>

                                <a href="<?php echo base_url(); ?>admin/payment"> <i class="fa fa-user"></i> <span>Payments </span></a>
                            <?php } ?>

                            <?php if ($rs->main_tab_name == 'Customer') { ?>

                                <a href="<?php echo base_url(); ?>admin/customers"> <i class="fa fa-users"></i> <span>Customers </span></a>
                            <?php } ?>


                            <?php if ($rs->main_tab_name == 'Promotions_main') { ?>

                                <a href="<?php echo base_url(); ?>admin/promotions"> <i class="fa fa-file-text-o"></i> <span> Promotions </span></a>

                            <?php } ?>

                            <?php if ($rs->main_tab_name == 'Pages') { ?>

                                <a href="<?php echo base_url(); ?>admin/pages"> <i class="fa fa-files-o"></i> <span> Pages </span></a>

                            <?php } ?>


                            <?php if ($rs->main_tab_name == 'Reports') { ?>

                                <a href="<?php echo base_url(); ?>admin/report"> <i class="fa fa-file-text"></i> <span>Reports </span></a>

                            <?php } ?>

                            <?php if ($rs->main_tab_name == 'Newsletter') { ?>

                                <a href="<?php echo base_url(); ?>admin/newsletter"> <i class="fa fa-file-text"></i> <span>Newsletter</span></a>

                            <?php } ?>


                            <?php if ($rs->main_tab_name == 'Config') { ?>

                                <a href="<?php echo base_url(); ?>admin/super_admin/membership"> <i class="fa fa-cogs"></i> <span>Config </span></a>

                            <?php } ?>

                            <?php if ($rs->main_tab_name == 'Log') { ?>

                                <a href="<?php echo base_url(); ?>admin/super_admin/email_log"> <i class="fa fa-cogs"></i> <span>Log </span></a>

                            <?php } ?>

                            <?php if ($rs->main_tab_name == 'BDM') { ?>

                                <a href="<?php echo base_url(); ?>admin/sellers/seller_porfile"> <i class="fa fa-user" aria-hidden="true"></i> <span>BDM </span></a>

                            <?php } ?>

                        </li>


                        <?php
                    }
                }//main else part end
                ?>
            </ul>