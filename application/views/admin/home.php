<?php
require_once('header.php');
?>
<style>
    .main-content {
        margin-top: 65px;
    }
</style>
<!-- Load Google chart api -->
       <!-- <script type="text/javascript" src="https://www.google.com/jsapi"></script>-->
<script type="text/javascript" src="<?php echo base_url() . 'js/google_graph/jsapi.js' ?>"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawVisualization);

    function drawVisualization() {
// Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Month',<?php
$i = 1;
$ct = count($seller_weekly_sale);
foreach ($seller_weekly_sale as $res_selrnm) {
    ?>  '<?php echo $res_selrnm->business_name; ?>'  <?php
    if ($i != $ct) {
        echo ",";
    } $i++;
}
?> ],
<?php //foreach($seller_weekly_sale as $res_selr_salewk) {          ?>

            ['<?php echo date('M-d-Y h:i:s A'); ?>',
<?php
$j = 1;
$ctr = count($seller_weekly_sale);
foreach ($seller_weekly_sale as $res_selr_saleqnt) {
    echo $res_selr_saleqnt->sale_qnt;
    if ($j != $ctr) {
        echo ",";
    } $j++;
}
?>

            ],
<?php //}            ?>

        ]);

        var options = {
            title: 'Sale As On : <?php echo date('M-d-Y h:i:s A'); ?> ',
            vAxis: {title: 'Sales'},
            hAxis: {title: 'Date<?php //echo date('F',strtotime(date('Y-m-d H:i:s'))) ;echo " ".date('Y');           ?> '},
            seriesType: 'bars',
            series: {5: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);

    }



</script>


<script type="text/javascript">
    google.load("visualization", "1", {packages: ["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Ordered', <?php echo $confirm_count->confirm_ordercount ?>],
            ['Cancelled', <?php echo $cancel_count->cancel_ordercount ?>],
            ['Undelivered', <?php echo $undelivered_count->undelivered_ordercount ?>],
            ['Delivered', <?php echo $deliver_count->delv_ordercount ?>],
            ['Return', <?php echo $return_count->return_ordercount ?>]
        ]);

        var options = {
            title: 'Order Status Graph',
            pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
    }
</script>     



<div id="content">    
    <div class="top-bar">           
        <div class="top-right">
            <?php include 'top_right.php'; ?>
        </div>
    </div>  <!-- @end top-bar  -->
    <div class="main-content">
        <?php if ($this->rbac->has_role('ADMIN')) { ?>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">26</div>
                                    <div>New Comments!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        <?php
                                        //$total_task=count($transfer_order_data)+count($return_orderlist)+count($replacement_orderlist)+count($graceperiod_request);
                                        echo $total_task = 4;
                                        ?>

                                        <!--12--></div>
                                    <div>New Tasks!

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-footer">
                            <span class="pull-left">
                                <?php //if(count($transfer_order_data)!=0){   ?> 
                                <a href="<?php echo base_url() . 'admin/Sales/view_order_transfer_list' ?>"> Orders Available For Transfer <img src='<?php echo base_url() . 'images/new.gif' ?>'>   </a>                                        <br> <?php //}         ?>

                                <?php //if(count($return_orderlist)!=0){  ?>
                                <a href="<?php echo base_url() . 'admin/Sales/view_returnrequested_list' ?>">Approval Of Return Request <img src='<?php echo base_url() . 'images/new.gif' ?>'> </a><br>
                                <?php //}   ?>

                                <?php //if(count($replacement_orderlist)!=0) {  ?> 
                                <a href="<?php echo base_url() . 'admin/Sales/view_replacement_list' ?>">Orders For Replacement <img src='<?php echo base_url() . 'images/new.gif' ?>'> </a><br>
                                <?php //}	  ?>										
                                <?php //if(count($graceperiod_request)!=0){    ?> 
                                <a href="<?php echo base_url() . 'admin/Sales/view_graceperiodrequest_list' ?>">
                                    Approve Grace Period Request <img src='<?php echo base_url() . 'images/new.gif' ?>'> </a><br>
                                <?php // }    ?>

                                <!--View Details--></span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $order_confirm->confirm_ordered_count ?></div>
                                    <div>New Orders!</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo base_url(); ?>admin/sales" >
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                    </div>
                                    <div>Pending Payment<!--Support Tickets!--></div>
                                    <div align="left"> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-footer">
                            <span class="pull-left">
                                <a href="<?php echo base_url(); ?>admin/payment">Seller Payout<img src='<?php echo base_url() . 'images/new.gif' ?>'> <span class="pull-right"> </a><br>
                                <a href="<?php echo base_url(); ?>admin/payment/buyer_refund">Buyer Refund<img src='<?php echo base_url() . 'images/new.gif' ?>'></a>
                            </span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.row -->



            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> Order Status</h3>
                            <div id="donutchart" style="width: 750px; height: 500px;"></div>
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart"></div>
                            <div class="text-right">
                                <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Seller Performance</h3>

                            </div>
                            <div class="panel-body"> 
                            </div><div id="chart_div" style="width: 900px; height: 500px;" ></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div align="center"> <h2>WELCOME TO <img src="<?php echo base_url(); ?>images/logo.png" alt="" > DASHBOARD CONTROL PANEL</h2></div>
    <?php } ?>             
</div>  <!-- @end #main-content -->
</div><!-- @end #content -->
<?php
require_once('footer.php');
?>			