<?php ?> 
<style type="text/css">
    .users-list>li{
        width:20% !important;
    }
</style>
<?php if ($this->rbac->is_admin()): ?>
    <div class="row-fluid">
        <div class="box box-info collapsed-box">
            <div class="box-header with-border" data-widget="collapse">
                <h3 class="box-title">Seller Reports</h3>

                <div class="box-tools pull-right">
                    <span class="label label-danger">5 Reports</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            <div class="box-body padB10" style="display: none; ">
                <div class="row-fluid text-center">
                    <div class="col-sm-2">
                        <span class="fa fa-pie-chart fa-4x text-aqua"></span>
                        <a class="users-list-name" href="<?= base_url('seller-reports') ?>">Seller Report</a>
                    </div>
                    <div class="col-sm-2 text-center">
                        <span class="fa fa-bar-chart-o fa-4x text-blue"></span>
                        <a class="users-list-name" href="<?= base_url('seller-payout-reports') ?>">Seller Payout Report</a>
                    </div>
                    <div class="col-sm-2 text-center">
                        <span class="fa fa-user-circle fa-4x text-info"></span>
                        <a class="users-list-name" href="<?= base_url('seller-profile-reports') ?>">Seller Profile Report</a>
                    </div>
                    <div class="col-sm-2 text-center">
                        <span class="fa fa-cart-plus fa-4x text-danger"></span>
                        <a class="users-list-name" href="<?= base_url('seller-wise-top-selling-products') ?>">Top Selling Product By Seller</a>
                    </div>
                    <div class="col-sm-2 text-center">
                        <span class="fa fa-cubes fa-4x text-green"></span>
                        <a class="users-list-name" href="<?= base_url('seller-gst-reports') ?>">Seller GST Report</a>
                    </div>
                </div>

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
            <div class="box-body padB10" style="display: none;">
                <div class="row-fluid">
                    <div class="col-sm-2 text-center">
                        <span class="fa fa-pie-chart fa-4x text-aqua"></span>
                        <a class="users-list-name" href="<?= base_url('buyer-reports') ?>">Buyer Report</a>
                    </div>
                    <div class="col-sm-2 text-center">
                        <span class="fa fa-bar-chart-o fa-4x text-blue"></span>
                        <a class="users-list-name" href="<?= base_url('buyer-wallet-reports') ?>">Buyer Wallet Report</a>
                    </div>
                    <div class="col-sm-2 text-center">
                        <span class="fa fa-user-circle fa-4x text-info"></span>
                        <a class="users-list-name" href="<?= base_url('buyer-profile-reports') ?>">Buyer Profile Report</a>
                    </div>
                </div>
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
            <div class="box-body padB10" style="display: none;">
                <div class="row-fluid">
                    <div class="col-sm-12 no_pad ">
                        <div class="col-sm-2 text-center">
                            <span class="fa fa-cart-arrow-down fa-4x text-aqua"></span>
                            <a class="users-list-name" href="<?= base_url('order-reports') ?>">Order Report</a>
                        </div>
                        <div class="col-sm-2 text-center">
                            <span class="fa fa-retweet fa-4x text-danger"></span>
                            <a class="users-list-name" href="<?= base_url('return-order-reports') ?>">Return Order Report</a>
                        </div>
                        <div class="col-sm-2 text-center">
                            <span class="fa fa-gift fa-4x text-info"></span>
                            <a class="users-list-name" href="<?= base_url('product-reports') ?>">Product Report</a>
                        </div>
                        <div class="col-sm-2 text-center">
                            <span class="fa fa-cart-plus fa-4x text-green"></span>
                            <a class="users-list-name" href="<?= base_url('sale-reports') ?>">Sales Report</a>
                        </div>
                        <div class="col-sm-2 text-center">
                            <span class="fa fa-pie-chart fa-4x text-aqua"></span>
                            <a class="users-list-name" href="<?= base_url('tax-reports') ?>">Tax Report</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Latest Orders</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <div class="row-fluid">
                    <div class="col-sm-12 no_pad ">
<!--                        <div class="col-sm-2 text-center">
                            <span class="fa fa-cart-arrow-down fa-4x text-aqua"></span>
                            <a class="users-list-name" href="<?= base_url('/seller/Reports') ?>">Order Report</a>
                        </div>
                        <div class="col-sm-2 text-center">
                            <span class="fa fa-retweet fa-4x text-danger"></span>
                            <a class="users-list-name" href="<?= base_url('/seller/Reports/return_report') ?>">Return Order Report</a>
                        </div>-->
                        <div class="col-sm-2 text-center">
                            <span class="fa fa-gift fa-4x text-info"></span>
                            <a class="users-list-name" href="<?= base_url('/seller/Reports/payment_report') ?>">Payment Report</a>
                        </div>
                        <div class="col-sm-2 text-center">
                            <span class="fa fa-bar-chart fa-4x text-info"></span>
                            <a class="users-list-name" href="<?= base_url('seller-gst-reports') ?>">GST Report</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
    </div>
<?php endif; ?>
<script type="text/javascript">
    $(function ($) {


    });
</script>