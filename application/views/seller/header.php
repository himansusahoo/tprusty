<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <meta name="author" content="">
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>css/admin/styles.css">

        <link href="<?php echo base_url(); ?>css/admin/font-awesome.css" rel="stylesheet">

        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>css/admin/font-awesome.min.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>css/admin/bootstrap.min.css">
        <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>


    </head>
    <body <?php
    if (isset($signin_date)): if ($signin_date == "0000-00-00 00:00:00")
            echo "onload='light_open()'";
    endif;
    ?> >
        <div id="w">
            <ul id="sidemenu">
                <li> <a href="<?php echo base_url(); ?>seller/seller/home" class="open"><i class="icon-home icon-large"></i><span> Dashboard </span></a></li>
                <li> <a href="<?php echo base_url(); ?>seller/catalog/new_product_list"><i class="icon-lightbulb icon-large"></i><span> Catalog </span></a></li>
                <li> <a href="<?php echo base_url(); ?>seller/orders"><i class="icon-envelope icon-large"></i><span> Orders </span></a></li>
                <li> <a href="<?php echo base_url(); ?>seller/returns"><i class="icon-home icon-large"></i><span> Returns </span></a></li>
                <li> <a href="<?php echo base_url(); ?>seller/payments"><i class="icon-info-sign icon-large"></i><span> Payments </span></a></li>
                <li> <a href="<?php echo base_url(); ?>seller/account"><i class="icon-info-sign icon-large"></i><span> Account </span></a></li>
                <li> <a href="<?php echo base_url('all-reports'); ?>"><i class="fa fa-file-text"></i><span> Reports </span></a></li>
                <li> <a href="<?php echo base_url(); ?>seller/seller/terms_conditions_page"><i class="icon-home icon-large"></i><span> Terms & Conditions </span></a></li>
            </ul>


