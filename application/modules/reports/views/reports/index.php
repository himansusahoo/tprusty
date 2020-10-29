<?php ?> 
<style type="text/css">
    .users-list>li{
        width:20% !important;
    }
</style>
<?php if ($this->rbac->is_admin()): ?>
    <div class="row-fluid">
        <div class="card card-info direct-chat collapsed-card">
            <div class="card-header">
                <h3 class="card-title text-bold hand" data-card-widget="collapse">Seller Reports</h3>
                <div class="card-tools">
                    <span data-toggle="tooltip" title="3 New Messages" class="badge bg-danger">5 Reports</span>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </button>                   
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" style="display: none;">
                <div class="row text-center pt-3 pb-3">
                    <div class="col">
                        <span class="fa fa-chart-pie fa-4x text-aqua"></span>
                        <a class="users-list-name" href="<?= base_url('seller-reports') ?>">Seller Report</a>
                    </div>
                    <div class="col text-center">
                        <span class="fa fa-chart-bar fa-4x text-blue"></span>
                        <a class="users-list-name" href="<?= base_url('seller-payout-reports') ?>">Seller Payout Report</a>
                    </div>
                    <div class="col text-center">
                        <span class="fa fa-user-circle fa-4x text-info"></span>
                        <a class="users-list-name" href="<?= base_url('seller-profile-reports') ?>">Seller Profile Report</a>
                    </div>
                    <div class="col text-center">
                        <span class="fa fa-cart-plus fa-4x text-danger"></span>
                        <a class="users-list-name" href="<?= base_url('seller-wise-top-selling-products') ?>">Top Selling Product By Seller</a>
                    </div>
                    <div class="col text-center">
                        <span class="fa fa-cubes fa-4x text-green"></span>
                        <a class="users-list-name" href="<?= base_url('seller-gst-reports') ?>">Seller GST Report</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row-fluid">
        <div class="card card-warning direct-chat direct-chat-warning collapsed-card">
            <div class="card-header">
                <h3 class="card-title text-bold hand" data-card-widget="collapse">Buyer Reports</h3>
                <div class="card-tools">
                    <span data-toggle="tooltip" title="3 New Messages" class="badge bg-danger">3 Reports</span>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </button>                   
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" style="display: none;">
                <div class="row text-center pt-3 pb-3">
                    <div class="col-2 text-center">
                        <span class="fa fa-chart-pie fa-4x text-aqua"></span>
                        <a class="users-list-name" href="<?= base_url('buyer-reports') ?>">Buyer Report</a>
                    </div>
                    <div class="col-2 text-center">
                        <span class="fa fa-chart-bar fa-4x text-blue"></span>
                        <a class="users-list-name" href="<?= base_url('buyer-wallet-reports') ?>">Buyer Wallet Report</a>
                    </div>
                    <div class="col-2 text-center">
                        <span class="fa fa-user-circle fa-4x text-info"></span>
                        <a class="users-list-name" href="<?= base_url('buyer-profile-reports') ?>">Buyer Profile Report</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row-fluid">
        <div class="card card-success direct-chat direct-chat-warning collapsed-card">
            <div class="card-header">
                <h3 class="card-title text-bold hand" data-card-widget="collapse">Miscellaneous Reports</h3>
                <div class="card-tools">
                    <span data-toggle="tooltip" title="3 New Messages" class="badge bg-danger">4 Reports</span>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </button>                   
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" style="display: none;">
                <div class="row text-center pt-3 pb-3">
                    <div class="col-2 text-center">
                        <span class="fa fa-cart-arrow-down fa-4x text-aqua"></span>
                        <a class="users-list-name" href="<?= base_url('order-reports') ?>">Order Report</a>
                    </div>
                    <div class="col-2 text-center">
                        <span class="fa fa-retweet fa-4x text-danger"></span>
                        <a class="users-list-name" href="<?= base_url('return-order-reports') ?>">Return Order Report</a>
                    </div>
                    <div class="col-2 text-center">
                        <span class="fa fa-gift fa-4x text-info"></span>
                        <a class="users-list-name" href="<?= base_url('product-reports') ?>">Product Report</a>
                    </div>
                    <div class="col-2 text-center">
                        <span class="fa fa-cart-plus fa-4x text-green"></span>
                        <a class="users-list-name" href="<?= base_url('sale-reports') ?>">Sales Report</a>
                    </div>
                    <div class="col-2 text-center">
                        <span class="fa fa-chart-pie fa-4x text-aqua"></span>
                        <a class="users-list-name" href="<?= base_url('tax-reports') ?>">Tax Report</a>
                    </div>
                </div>
            </div>
        </div>        
    </div>
<?php else: ?>
    <div class="row-fluid">
        <div class="card card-warning direct-chat direct-chat-warning collapsed-card">
            <div class="card-header">
                <h3 class="card-title text-bold hand" data-card-widget="collapse">Miscellaneous Reports</h3>
                <div class="card-tools">
                    <span data-toggle="tooltip" title="3 New Messages" class="badge bg-danger">2 Reports</span>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </button>                   
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" style="display: none;">
                <div class="row text-center pt-3 pb-3">
                    <div class="col-2 text-center">
                        <span class="fa fa-gift fa-4x text-info"></span>
                        <a class="users-list-name" href="<?= base_url('/seller/Reports/payment_report') ?>">Payment Report</a>
                    </div>
                    <div class="col-2 text-center">
                        <span class="fa fa-chart-bar fa-4x text-info"></span>
                        <a class="users-list-name" href="<?= base_url('seller-gst-reports') ?>">GST Report</a>
                    </div>
                </div>
            </div>
        </div>        

    </div>    
<?php endif; ?>
<script type="text/javascript">
    $(function ($) {


    });
</script>