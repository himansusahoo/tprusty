<?php
require_once('header.php');
date_default_timezone_set('Asia/Calcutta');
?>	

<div id="content">    
    <div class="top-bar">
        <div class="seller_support_mail">Seller Support ID- <?=SELLER_MAIL?> </div>
        <!-- header_session included here -->
        <?php require_once('header_session.php'); ?>
    </div>  <!-- @end top-bar  -->

    <div class="main-content">

        <?php require_once('common.php'); ?>


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
                                <div class="huge">
                                    <?php
                                    $seller_id = $this->session->userdata('seller-session');
                                    $query = $this->db->query("SELECT * FROM seller_notification2 WHERE seller_id='$seller_id'");
                                    $result = $query->result();
                                    echo $rows = $query->num_rows();
                                    ?>
                                </div>
                                <div>My Notification</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url(); ?>seller/seller/seller_notices">
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
                            <div class="col-xs-3 text-right">
                                <i class="fa fa-star-half-o fa-5x"></i></br>
                            </div>
                            <div class="col-xs-9 text-right">
                                <?php
                                $seller_id = $this->session->userdata('seller-session');
                                $query1 = $this->db->query("SELECT * FROM review_seller WHERE seller_id='$seller_id' AND rating_type='Best'");
                                $best_count = $query1->num_rows();
                                $query2 = $this->db->query("SELECT * FROM review_seller WHERE seller_id='$seller_id' AND rating_type='Bad'");
                                $bad_count = $query2->num_rows();

                                $ini_total = $best_count + $bad_count;
                                if ($ini_total > 0) {
                                    $positive_percent = round(($best_count / $ini_total * 100), 2);
                                    ?>			
                                    <div class="huge"><?= $positive_percent ?>%</div>
                                    <div>
                                        <span>Positive : <?= $best_count ?></span> </br>
                                        <span>Negative : <?= $bad_count ?></span>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="huge">0%</div> 
                                    <div>
                                        <span>Positive : <?= $best_count ?></span>
                                        <span>Negative : <?= $bad_count ?></span>
                                    </div>
                                    <?php
                                }
                                ?>

                                <!--<div>My Rating</div>-->
                            </div>
                            <div class="clearfix"></div>

                        </div>
                    </div>
                    <a href="<?php echo base_url(); ?>seller/seller/seller_review_rating">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
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
                                <div class="huge">
                                    <?php
                                    $array_ord = array();
//$date1 = date('y-m-d h:i:s');
                                    $seller_id = $this->session->userdata('seller-session');
                                    $q1 = $this->db->query("SELECT a.order_id FROM order_info a INNER JOIN ordered_product_from_addtocart b ON a.order_id=b.order_id
		 						WHERE b.seller_id='$seller_id' AND b.seller_id!=0 AND(a.order_status='Order confirmed' OR a.order_status='Ready to shipped') 
								AND a.order_confirm_for_seller='Approved' GROUP BY b.order_id");
                                    $row_order = $q1->result();

                                    if ($row_order) {
                                        foreach ($row_order as $result1) {
                                            $q2 = $this->db->query("SELECT a.order_confirm_for_seller_date,k.dispatch_days,a.order_id,a.order_confirm_for_seller,a.order_status,a.order_accept_by_seller,a.grace_period,
		a.invoice_id,a.request_for_grace_period,a.grace_period_approve_status,a.Total_amount
FROM order_info a
INNER JOIN ordered_product_from_addtocart b ON a.order_id = b.order_id
INNER JOIN user f ON b.user_id = f.user_id
INNER JOIN user_address g ON f.address_id = g.address_id
INNER JOIN state h ON g.state = h.state_id
INNER JOIN dispatched_day_setting k on k.state_id=h.state_id
WHERE a.order_id='$result1->order_id' group by b.order_id ");
                                            $new_orders_as_per_orderid = $q2->result();
                                            //============================
                                            foreach ($new_orders_as_per_orderid as $row_as_orderid) {
                                                $date1 = date('y-m-d h:i:s');

                                                //$day_after_3days=date('y-m-d h:i:s' ,strtotime($row_as_product[0]->order_confirm_for_seller_date.'+ 3 day'));
                                                $day_after_3days = date('y-m-d h:i:s', strtotime($row_as_orderid->order_confirm_for_seller_date . '+' . $row_as_orderid->dispatch_days . 'day'));
                                                $grace_days = $row_as_orderid->dispatch_days + $row_as_orderid->grace_period;

                                                $day_after_gracedays = date('y-m-d h:i:s', strtotime($row_as_orderid->order_confirm_for_seller_date . '+' . $grace_days . 'day'));
                                                //$date2 = new DateTime($day_after_3days);
                                                //$diff = $date2->diff($date1)->format("%a"); 
                                                //$row_as_product[0]->dispatch_days

                                                if (($date1 <= $day_after_3days or $date1 <= $day_after_gracedays) and $row_as_orderid->order_confirm_for_seller == 'Approved') {
                                                    foreach ($new_orders_as_per_orderid as $res_ordid) {
                                                        array_push($array_ord, $res_ordid->order_id);
                                                    }
                                                }

                                                //============================
                                            } //2nd foreach End
                                        } //1st foreach end
                                    }

                                    if (count($array_ord) != 0) {
                                        echo count($array_ord);
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </div>
                                <div>Pending Orders</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url(); ?>seller/orders">
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
                                    <?php
                                    $seller_id = $this->session->userdata('seller-session');
                                    $q3 = $this->db->query("SELECT SUM( fnl_stl_amt ) AS pending_payment FROM seller_payout WHERE seller_id ='$seller_id' AND STATUS = 'Pending'");
                                    $result3 = $q3->row();
                                    $pending_payment = $result3->pending_payment;
                                    $pending_payment = number_format($pending_payment);
                                    echo ($pending_payment) ? $pending_payment : '0';
                                    ?>										
                                </div>
                                <div>Pending Payment</div>
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
        </div>
        <!-- /.row -->

        <!--<div class="row" style=" height:10px;">
          <div class="col-lg-12" style=" height:2px;">
              <div class="panel panel-default"   style=" visibility:hidden;">
                  <div class="panel-heading" >
                      <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Area Chart</h3>
                  </div>
                  <div class="panel-body" style=" visibility:hidden; height:5px;">
                      <div id="morris-area-chart"></div>
                  </div>
              </div>
          </div>
      </div>-->

        <!-- /.row -->

        <!--<div class="row">
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> Donut Chart</h3>
                    </div>
                    <div class="panel-body">
                        <div id="morris-donut-chart"></div>
                        <div class="text-right">
                            <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
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
            </div>
            <div class="col-lg-4">
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
            </div>
        </div>-->
        <!-- /.row -->






    </div>  <!-- @end #main-content -->
</div><!-- @end #content -->
<?php
require_once('footer.php');
?>		