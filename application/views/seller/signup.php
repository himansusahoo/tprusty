<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sell With <?=COMPANY?></title>
        <meta name="author" content="">
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>css/admin/styles.css">
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>css/admin/font-awesome.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/admin/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="wraper">
            <div class="header"> 
                <div class="col-md-6"> <img src="<?php echo base_url(); ?>images/seller-logo.png" alt=""></div>
                <div class="col-md-6"> <h4 class="help-line"> <i class="fa fa-envelope"></i> 24x7 Seller Support </h4> </div>
                <div class="clearfix"></div>
            </div>

            <div class="banner">
                <div class="signup_outer">
                    <div class="signup_inner">
                        <?php if (isset($error)) { ?>
                            <h4 style="color: red;"><?php echo $error; ?></h4>
                            <?php
                        }
                        $attributes = array('class' => 'login_form divider', 'name' => 'login_form');
                        echo form_open('seller/seller/seller_login', $attributes);
                        ?>
                        <!--<form class="login_form divider">-->
                        <div class="col-md-12">
                            <h3>Seller Login</h3>
                            <ul>
                                <li><input type="text" class="seller_login_input" name="email" placeholder="Username"></li>
                                <li><input type="password" class="seller_login_input" name="password" placeholder="Password"></li>
                                <input type="submit" name="submit" value="Login">
                                <div class="remembr">
                                    <input type="checkbox" checked="" name="checkbox">
                                    <i></i>
                                    Remember me
                                </div>
                                <div class="forgot">
                                    <a href="<?php echo base_url(); ?>seller/seller/forgot_password_form">Forgot Password ?</a>
                                </div>
                            </ul>
                        </div>
                        </form>
                        <?php if (validation_errors()) : ?>
                            <h4 class="validation_error"><?php echo validation_errors(); ?></h4>
                            <?php
                        endif;

                        $attributes = array('class' => 'signup_form', 'name' => 'register_form');
                        echo form_open('seller/seller/seller_register', $attributes);
                        ?>				
                        <!--<form class="signup_form">-->
                        <div class="col-md-12">
                            <h3>Seller Signup</h3>
                            <ul>
                                <li><input type="text" class="seller_login_input" name="email" placeholder="Email ID" ></li>
                                <li><input type="text" class="seller_login_input" name="mobile" placeholder="Mobile Number" ></li>
                                <input type="submit" name="submit" value="Signup">
                            </ul>
                        </div>   
                        </form>
                        <div class="clearfix"></div>  
                    </div>
                </div>

            </div>

            <div class="how-to-sell">
                <h2 class="title-sell"> Grow your Business with <?=COMPANY?> </h2>
                <ul>
                    <li> <div class="step">
                            <div class="circle1"> <i class="fa fa-list-alt"></i> </div>
                            <h4> Register and Sell Products</h4>
                        </div>
                        <p> Register absolutly free with <?=COMPANY?> and start selling. </p>
                    </li>

                    <li>  <div class="step">
                            <div class="circle2"> <i class="fa fa-globe"></i> </div>
                            <h4> Receive Orders</h4>
                        </div>
                        <p> Start your online store and recive orders across India. </p></li>

                    <li>  <div class="step">
                            <div class="circle3"> <i class="fa fa-shopping-bag"></i> </div>
                            <h4> Order Fulfillment</h4>
                        </div>
                        <p> <?=COMPANY?> will  help to speed up your order fulfilment. </p> </li>

                    <li> <div class="step">
                            <div class="circle4"> <i class="fa fa-money"></i> </div>
                            <h4> Receive Payment</h4>
                        </div>
                        <p> Get your payments within 5-7 days of sales. </p> </li>  
                    <div class="clearfix"> </div>      
                </ul>
            </div>



            <div class="footer">    
                <ul>
                    <li> <a href="#"> Terms of Service </a> | </li>
                    <li> <a href="#"> Privacy Policy  </a>  | </li>
                    <li> <a href="#"> Help & Support  </a>  </li>        
                </ul>
                <p class="copy"> © Copyright 2015 <?= DOMAIN_NAME ?>  </p>
            </div>   
        </div>   

    </body>
</html>
