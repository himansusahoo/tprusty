<?php ?> 
<style type="text/css">
    .users-list>li{
        width:20% !important;
    }
</style>
<div class="row-fluid">
    <div class="box box-info collapsed-box">
        <div class="box-header with-border" data-widget="collapse">
            <h3 class="box-title">Seller Reports</h3>

            <div class="box-tools pull-right">
                <span class="label label-danger">5 Reports</span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="box-body no-padding" style="display: none;">
            <ul class="users-list clearfix">
                <li>
                    <span class="fa fa-pie-chart fa-5x text-aqua"></span>
                    <a class="users-list-name" href="<?= base_url('seller-reports') ?>">Seller Report</a>
                </li>
                <li>
                    <span class="fa fa-bar-chart-o fa-5x text-blue"></span>
                    <a class="users-list-name" href="<?= base_url('seller-payout-reports') ?>">Seller Payout Report</a>
                </li>
                <li>
                    <span class="fa fa-user-circle fa-5x text-info"></span>
                    <a class="users-list-name" href="<?= base_url('seller-profile-reports') ?>">Seller Profile Report</a>
                </li>
                <li>
                    <span class="fa fa-cart-plus fa-5x text-danger"></span>
                    <a class="users-list-name" href="<?= base_url('seller-wise-top-selling-products') ?>">Top Selling Product By Seller</a>
                </li>
                <li>
                    <span class="fa fa-cubes fa-5x text-green"></span>
                    <a class="users-list-name" href="<?= base_url('seller-gst-reports') ?>">Seller GST Report</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="box box-info collapsed-box">
        <div class="box-header with-border" data-widget="collapse">
            <h3 class="box-title">Buyer Reports</h3>

            <div class="box-tools pull-right">
                <span class="label label-danger">3 Reports</span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="box-body no-padding" style="display: none;">
            <ul class="users-list clearfix">
                <li>
                    <span class="fa fa-pie-chart fa-5x text-aqua"></span>
                    <a class="users-list-name" href="<?= base_url('buyer-reports') ?>">Buyer Report</a>
                </li>
                <li>
                    <span class="fa fa-bar-chart-o fa-5x text-blue"></span>
                    <a class="users-list-name" href="<?= base_url('buyer-wallet-reports') ?>">Buyer Wallet Report</a>
                </li>
                <li>
                    <span class="fa fa-user-circle fa-5x text-info"></span>
                    <a class="users-list-name" href="<?= base_url('buyer-profile-reports') ?>">Buyer Profile Report</a>
                </li>                
            </ul>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="box box-info collapsed-box">
        <div class="box-header with-border" data-widget="collapse">
            <h3 class="box-title">Miscellaneous Reports</h3>

            <div class="box-tools pull-right">
                <span class="label label-danger">4 Reports</span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="box-body no-padding" style="display: none;">
            <ul class="users-list clearfix">
                <li>
                    <span class="fa fa-cart-arrow-down fa-5x text-aqua"></span>
                    <a class="users-list-name" href="<?= base_url('order-reports') ?>">Order Report</a>
                </li>
                <li>
                    <span class="fa fa-retweet fa-5x text-danger"></span>
                    <a class="users-list-name" href="<?= base_url('return-order-reports') ?>">Return Order Report</a>
                </li>
                <li>
                    <span class="fa fa-gift fa-5x text-info"></span>
                    <a class="users-list-name" href="<?= base_url('product-reports') ?>">Product Report</a>
                </li>  
                <li>
                    <span class="fa fa-cart-plus fa-5x text-green"></span>
                    <a class="users-list-name" href="<?= base_url('sale-reports') ?>">Sales Report</a>
                </li> 
                <li>
                    <span class="fa fa-pie-chart fa-5x text-aqua"></span>
                    <a class="users-list-name" href="<?= base_url('tax-reports') ?>">Tax Report</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function ($) {


    });
</script>