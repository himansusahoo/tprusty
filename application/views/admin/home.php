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
<?php //foreach($seller_weekly_sale as $res_selr_salewk) {     ?>

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

<?php //}       ?>

        ]);

        var options = {
            title: 'Sale As On : <?php echo date('M-d-Y h:i:s A'); ?> ',
            vAxis: {title: 'Sales'},
            hAxis: {title: 'Date<?php //echo date('F',strtotime(date('Y-m-d H:i:s'))) ;echo " ".date('Y');      ?> '},
            seriesType: 'bars',
            series: {5: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);

//var chart = new google.visualization.ComboChart(document.getElementById('chart_div1'));
//    chart.draw(data, options);

//var chart = new google.visualization.ComboChart(document.getElementById('chart_div2'));
//    chart.draw(data, options);
//	
//	var chart = new google.visualization.ComboChart(document.getElementById('chart_div3'));
//    chart.draw(data, options);
//	
//	var chart = new google.visualization.ComboChart(document.getElementById('chart_div4'));
//    chart.draw(data, options);
//	
//	var chart = new google.visualization.ComboChart(document.getElementById('chart_div5'));
//    chart.draw(data, options);
//	
//	var chart = new google.visualization.ComboChart(document.getElementById('chart_div6'));
//    chart.draw(data, options);


    }



</script>


<!--<script type="text/javascript">
google.charts.load("current", {packages:['corechart']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
var data = google.visualization.arrayToDataTable([
["Element", "Density", { role: "style" } ],
["Copper", 8.94, "#b87333"],
["Silver", 10.49, "silver"],
["Gold", 19.30, "gold"],
["Platinum", 21.45, "color: #e5e4e2"]
]);

var view = new google.visualization.DataView(data);
view.setColumns([0, 1,
               { calc: "stringify",
                 sourceColumn: 1,
                 type: "string",
                 role: "annotation" },
               2]);

var options = {
title: "Density of Precious Metals, in g/cm^3",
width: 600,
height: 400,
bar: {groupWidth: "95%"},
legend: { position: "none" },
};
var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
chart.draw(view, options);
}
</script>-->



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
        <!--<div class="top-left">
                <ul class="top-menu">
                        <li class="selected"><a href="#">Lorem</a></li>
                        <li><a href="#">Using other templates</a></li>
                        <li><a href="#">Advanced</a></li>
                </ul>
        </div>-->
        <div class="top-right">
            <?php include 'top_right.php'; ?>
        </div>
    </div>  <!-- @end top-bar  -->
    <div class="main-content">
        <?php if ($this->session->userdata('logged_in') == ADMIN_MAIL) { ?>	

            <!-- /.row -->

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
                                <?php //if(count($transfer_order_data)!=0){  ?> 
                                <a href="<?php echo base_url() . 'admin/Sales/view_order_transfer_list' ?>"> Orders Available For Transfer <img src='<?php echo base_url() . 'images/new.gif' ?>'>   </a>                                        <br> <?php //}    ?>

                                <?php //if(count($return_orderlist)!=0){ ?>
                                <a href="<?php echo base_url() . 'admin/Sales/view_returnrequested_list' ?>">Approval Of Return Request <img src='<?php echo base_url() . 'images/new.gif' ?>'> </a><br>
                                <?php //}   ?>

                                <?php //if(count($replacement_orderlist)!=0) {  ?> 
                                <a href="<?php echo base_url() . 'admin/Sales/view_replacement_list' ?>">Orders For Replacement <img src='<?php echo base_url() . 'images/new.gif' ?>'> </a><br>
                                <?php //}	  ?>										
                                <?php //if(count($graceperiod_request)!=0){   ?> 
                                <a href="<?php echo base_url() . 'admin/Sales/view_graceperiodrequest_list' ?>">
                                    Approve Grace Period Request <img src='<?php echo base_url() . 'images/new.gif' ?>'> </a><br>
                                <?php // }   ?>

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
                                        <?php //$total_payout_cout=$payout_result->num_rows() + count($buyer_refund); echo $total_payout_cout; ?>
                                        <!--13--></div>
                                    <div>Pending Payment<!--Support Tickets!--></div>
                                    <div align="left"> 
                                        <?php /* ?> <?php 
                                          if($payout_result->num_rows()!=0){ echo $payout_result->num_rows() ."nos. Seller Payout Pending<br>"; }
                                          if(count($buyer_refund)!=0){ echo count($buyer_refund) ."nos. Buyer Refund Pending <br>"; }
                                          ?><?php */ ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-footer">
                            <span class="pull-left">
                                <?php //if($payout_result->num_rows()!=0){  ?>
                                <a href="<?php echo base_url(); ?>admin/payment">Seller Payout<img src='<?php echo base_url() . 'images/new.gif' ?>'> <span class="pull-right"> </a><br>
                                <?php //}   ?>

                                <?php //if(count($buyer_refund)!=0){   ?> 
                                <a href="<?php echo base_url(); ?>admin/payment/buyer_refund">Buyer Refund<img src='<?php echo base_url() . 'images/new.gif' ?>'></a>
                                <?php //}   ?>

                                <!--View Details--></span>
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
                <!--<div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Tasks Panel</h3>
                        </div>
                        <div class="panel-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item">
                                    <span class="badge">just now</span>
                                    <i class="fa fa-fw fa-calendar"></i> Calendar updated
                                </a>
                                <a href="#" class="list-group-item">
                                    <span class="badge">4 minutes ago</span>
                                    <i class="fa fa-fw fa-comment"></i> Commented on a post
                                </a>
                                <a href="#" class="list-group-item">
                                    <span class="badge">23 minutes ago</span>
                                    <i class="fa fa-fw fa-truck"></i> Order 392 shipped
                                </a>
                                <a href="#" class="list-group-item">
                                    <span class="badge">46 minutes ago</span>
                                    <i class="fa fa-fw fa-money"></i> Invoice 653 has been paid
                                </a>
                                <a href="#" class="list-group-item">
                                    <span class="badge">1 hour ago</span>
                                    <i class="fa fa-fw fa-user"></i> A new user has been added
                                </a>
                                <a href="#" class="list-group-item">
                                    <span class="badge">2 hours ago</span>
                                    <i class="fa fa-fw fa-check"></i> Completed task: "pick up dry cleaning"
                                </a>
                                <a href="#" class="list-group-item">
                                    <span class="badge">yesterday</span>
                                    <i class="fa fa-fw fa-globe"></i> Saved the world
                                </a>
                                <a href="#" class="list-group-item">
                                    <span class="badge">two days ago</span>
                                    <i class="fa fa-fw fa-check"></i> Completed task: "fix error on sales page"
                                </a>
                            </div>
                            <div class="text-right">
                                <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>-->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Seller Performance</h3>

                            </div>
                            <div class="panel-body"> 
                            </div><div id="chart_div" style="width: 900px; height: 500px;" ></div>
                            <!--
                              <ul class="nav nav-tabs tabs-horiz">
                                  <li id="li_tab1" class="active"><a data-toggle="tab" href="#tab1">Weekly</a></li>
                                  <li id="li_tab2" ><a data-toggle="tab" href="#tab2">Monthly</a></li>
                                  <li id="li_tab3" ><a data-toggle="tab" href="#tab3">Yearly</a></li>-->
                            <!--<li id="li_tab4"><a data-toggle="tab" href="#tab4">Daily</a></li>-->

                            <!--</ul>

                    <div class="tab-content form_view">
                                    <div id="tab1" class="tab-pane fade in active">
                                            <h3>Weekly</h3>
                                            
                          <div id="chart_div" style="width: 900px; height: 500px;" ></div>
                        
                    </div>
                                    <div id="tab2"  class="tab-pane fade" >
                                            <h3>Monthly</h3>
                                             <div id="chart_div1" style="width: 900px; height: 500px;" ></div>
                         
                                    </div>
                    
                                    <div id="tab3" class="tab-pane fade">
                                            <h3>Yearly</h3>
                                             <div id="chart_div2"  style="width: 900px; height: 500px;" ></div>
                                    </div>-->

                            <!--<div id="morris-area-chart"></div>-->


                        </div>
                    </div>
                </div>
            </div>


            <!-- <div class="row">
                 <div class="col-lg-12">
                     <div class="panel panel-default">
                         <div class="panel-heading">
                             <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i>Moonboy Turnover</h3>                              
                         </div>
                         <div class="panel-body"><div id="columnchart_values" style="width: 900px; height: 300px;"  ></div>-->


            <!--<ul class="nav nav-tabs tabs-horiz">
                            <li id="li_tab4" class="active"><a data-toggle="tab" href="#tab4">Daily</a></li>
                            <li id="li_tab5"><a data-toggle="tab" href="#tab5">weekly</a></li>
                            <li id="li_tab6"><a data-toggle="tab" href="#tab6">Monthly</a></li>
                            <li id="li_tab7"><a data-toggle="tab" href="#tab7">Yearly</a></li>
            
                    </ul>

    <div class="tab-content form_view">
                            <div id="tab4" class="tab-pane fade in active">
                                    <h3>Daily</h3>
                                    
                  <div id="chart_div3" style="width: 900px; height: 500px;"  ></div>
                            
            </div>
                            <div id="tab5" class="tab-pane fade">
                                    <h3>Weekly</h3>
                                     <div id="chart_div4"  style="width: 900px; height: 500px;" ></div> 
                            </div>
            
                            <div id="tab6" class="tab-pane fade">
                                    <h3>Monthly</h3>
                                    <div id="chart_div5"  style="width: 900px; height: 500px;" ></div>
                            </div>
            
                            <div id="tab7" class="tab-pane fade">
                    <h3>Yearly</h3>
                                     <div id="chart_div6" style="width: 900px; height: 500px;"  ></div>
                            </div>-->


            <!--<div id="morris-area-chart"></div>-->
            <!--</div>
        </div>
    </div>
    </div>-->
            <!-- /.row -->

            <!-- <div class="col-lg-4">
                 <div class="panel panel-default">
                     <div class="panel-heading">
                         <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Transactions Panel</h3>
                     </div>
                     <div class="panel-body">
                         <div class="table-responsive">
                             <table class="table table-bordered table-hover table-striped">
                                 <thead>
                                     <tr>
                                         <th>Order #</th>
                                         <th>Order Date</th>
                                         <th>Order Time</th>
                                         <th>Amount (USD)</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <tr>
                                         <td>3326</td>
                                         <td>10/21/2013</td>
                                         <td>3:29 PM</td>
                                         <td>$321.33</td>
                                     </tr>
                                     <tr>
                                         <td>3325</td>
                                         <td>10/21/2013</td>
                                         <td>3:20 PM</td>
                                         <td>$234.34</td>
                                     </tr>
                                     <tr>
                                         <td>3324</td>
                                         <td>10/21/2013</td>
                                         <td>3:03 PM</td>
                                         <td>$724.17</td>
                                     </tr>
                                     <tr>
                                         <td>3323</td>
                                         <td>10/21/2013</td>
                                         <td>3:00 PM</td>
                                         <td>$23.71</td>
                                     </tr>
                                     <tr>
                                         <td>3322</td>
                                         <td>10/21/2013</td>
                                         <td>2:49 PM</td>
                                         <td>$8345.23</td>
                                     </tr>
                                     <tr>
                                         <td>3321</td>
                                         <td>10/21/2013</td>
                                         <td>2:23 PM</td>
                                         <td>$245.12</td>
                                     </tr>
                                     <tr>
                                         <td>3320</td>
                                         <td>10/21/2013</td>
                                         <td>2:15 PM</td>
                                         <td>$5663.54</td>
                                     </tr>
                                     <tr>
                                         <td>3319</td>
                                         <td>10/21/2013</td>
                                         <td>2:13 PM</td>
                                         <td>$943.45</td>
                                     </tr>
                                 </tbody>
                             </table>
                         </div>
                         <div class="text-right">
                             <a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                         </div>
                     </div>
                 </div>
             </div>-->
        </div>
        <!-- /.row -->
    <?php } else { ?>
        <div align="center"> <h2>WELCOME TO <img src="<?php echo base_url(); ?>images/logo.png" alt="" > DASHBOARD CONTROL PANEL</h2></div>


    <?php } ?>             




</div>  <!-- @end #main-content -->
</div><!-- @end #content -->
<?php
require_once('footer.php');
?>			