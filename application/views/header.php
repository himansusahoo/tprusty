<!DOCTYPE html>
<html lang="en">
    <head>

        <?php
        $this->db->cache_off();
        if ($this->session->userdata('sesscoke') == false) {

            $data = array();
            $this->session->set_userdata('sesscoke', $data);
        }
        ?>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url(); ?>new_css/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>new_css/css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="<?php echo base_url(); ?>new_js/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>new_js/js/jssor.slider-23.1.6.min.js"></script>        
        <link rel="stylesheet" href="<?php echo base_url(); ?>colorbox/colorbox.css" />
        <script src="<?php echo base_url(); ?>colorbox/jquery.colorbox.js"  ></script>       
        <!--  Google Analytics Code Start-->
        <?php include "google_api.php"; ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.tinycarousel.js"   ></script>

        <style>
            /* carousel */
            .media-carousel 
            {
                margin-bottom: 0;
                padding: 0 40px 0px 40px;
            }
            /* Previous button  */
            .media-carousel .carousel-control.left 
            {

                background-image: none;
                background: none;
                border: 2px solid #ccc;
                border-radius: 50%;
                height: 30px;
                width: 30px;
                margin-top: 20px;
                color: #ccc;
                padding-top: 0;
                font-size: 31px;
                line-height: 21px;
                text-shadow: none;

            }
            /* Next button  */
            .media-carousel .carousel-control.right 
            {

                background-image: none;
                background: none;
                border: 2px solid #ccc;
                border-radius: 50%;
                height: 30px;
                width: 30px;
                margin-top: 20px;
                color: #ccc;
                padding-top: 0;
                font-size: 31px;
                line-height: 21px;
                text-shadow: none;
            }
            /* Changes the position of the indicators */
            .media-carousel .carousel-indicators 
            {
                right: 50%;
                top: auto;
                bottom: 0px;
                margin-right: -19px;
            }
            /* Changes the colour of the indicators */
            .media-carousel .carousel-indicators li 
            {
                background: #c0c0c0;
            }
            .media-carousel .carousel-indicators .active 
            {
                background: #333333;
            }

            .thumbnail{ margin-bottom:0;}
            .col-md-1{ height:90px;}
            @import url("http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css");
            .col-item
            {
                border-radius: 5px;
                background: #FFF;
            }
            .col-item .photo img
            {
                margin: 0 auto;
                width: 100%;
            }

            .col-item .info
            {
                padding: 10px;
                border-radius: 0 0 5px 5px;
                margin-top: 1px;
            }

            .col-item:hover .info {
                background-color: #F5F5DC;
            }


            .col-item .price h5
            {
                line-height: 20px;
                margin: 0;
            }

            .price-text-color
            {
                color: #219FD1;
            }

            .col-item .info .rating
            {
                color: #777;
            }

            .col-item .rating
            {
                float: left;
                font-size: 17px;
                text-align: right;
                line-height: 52px;
                margin-bottom: 10px;
                height: 52px;
            }

            .col-item .separator
            {
                border-top: 1px solid #E1E1E1;
            }

            .clear-left
            {
                clear: left;
            }

            .col-item .separator p
            {
                line-height: 20px;
                margin-bottom: 0;
                margin-top: 10px;
                text-align: center;
            }

            .col-item .separator p i
            {
                margin-right: 5px;
            }
            .col-item .btn-add
            {
                width: 50%;
                float: left;
            }

            .col-item .btn-add
            {
                border-right: 1px solid #E1E1E1;
            }

            .col-item .btn-details
            {
                width: 50%;
                float: left;
                padding-left: 10px;
            }
            .controls
            {
                margin-top: 20px;
            }
            [data-slide="prev"]
            {
                margin-right: 10px;
            }
            .carousel-control.left{    background-image: none;}
            .carousel-control.right{    background-image: none; margin-right:1.3%;}
            .carousel-control .fa-chevron-left, .carousel-control .fa-chevron-right {
                width: 30px;
                height: 30px;
                line-height: 29px;
                margin-top: -35px;
                font-size: 14px;
                color: #fff;
                background: #ed2541;
                border-radius: 50px;
            }
            .left-banner{

                width: 100%;
                margin: auto;

            }

            .right-banner{              
                background-color: #fff !important;

            }

            .col:first-child {
                margin-left: 0;
            }

            .col {
                display: block;
                float: left;
            }

            .images_1_of_3 {
                margin-top: .3em;
                line-height: 1.9em;
                width: 25%;
                padding: 2px;
            }
            .images_1_of_5 {
                width: 18.4%;
                text-align: center;
            }

            .col1 {
                display: block;
                float: left;
                margin-right: 4px;
            }

            .images_1_of_5 {
                margin-top: .3em;
                line-height: 1.9em;
            }
            .images_1_of_5 img {
                max-width: 100%;
                display: inline-block;
            }
            .tickering-right-banner{
                margin-top: 5px; background: #333; padding:2px 8px 0;
            }
            .tickering-right-banner ul{
                width:100%;
            }
            .tickering-right-banner ul li{
                border-bottom:1px dotted #fff;
            }
            .tickering-right-banner ul li img{
                width:100%; height:58px; margin:5px 0px;
            }
            #tabbed-Carousel .nav a small {
                display:block;
            }
            #tabbed-Carousel .nav {
                background:#eeac0d;
            }
            #tabbed-Carousel .nav a {
                border-radius:0px;
            }

            .nav-justified>li {
                width: auto;
            }

            .nav-justified>li:hover {
                width: auto;
            }
            .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover{
                background:#ed313b;}
            .bnnr_container .latest_offers {
                float: right;
                width: 240px;
                background: #fff;
                -webkit-box-shadow: 0px 2px 8px 0px rgba(0,0,0,0.06);
                -moz-box-shadow: 0px 2px 8px 0px rgba(0,0,0,0.06);
                box-shadow: 0px 2px 8px 0px rgba(0,0,0,0.06);
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                -moz-background-clip: padding;
                -webkit-background-clip: padding-box;
                background-clip: padding-box;
                height: 409px;
                position: absolute;
                top: 0;
                right: 20px;
                overflow: hidden;
            }
            .bnnr_container .latest_offers li {
                list-style: none;
                padding: 0;
                border-bottom: 1px solid #f0f0f0;
                text-align: center;
                overflow: hidden;
                height: 126px;
                position: relative;
            }
            .latest_offers li img {
                max-width: inherit;
                height: 126px;
                left: 50%;
                -webkit-transform: translateX(-50%);
                -moz-transform: translateX(-50%);
                -o-transform: translateX(-50%);
                -ms-transform: translateX(-50%);
                transform: translateX(-50%);
                position: relative;
                z-index: 0;
            }

            .menu-link-product-held {
                float: left;
                width: 47%;               
                margin: 0 1%;
            }	
            .today-deal-left {
                width: 30%;
                float: left;
                padding: 5px;
                text-align: center;
            }
            .today-deal-left img {
                display: inline-block;
                height: auto;
                width: auto;
                margin: 0 auto;
                max-height: 165px;
                max-width: 170px;
            }
            .today-deal-right {
                width: 70%;
                float: right;
                padding: 5px;
                text-align: left;
            }
            .today-deal-right h4 {
                text-align: left;
                margin-top: 5px;
                font-family: "Helvetica Neue",Helvetica,Arial,sans-serif !important;
                font-weight: normal;
                font-size: 17px;
                color: #337ab7 !important;
            }	
            .today-deal-right p {
                font-size: 14px;
                color: #999;
                width: 280px;
                text-align: justify;
            }
            .nav>li>a:focus, .nav>li>a:hover{
                text-decoration: none;
                background-color: #ed313b;
            }
            #cboxLoadedContent,#cboxContent{border-radius: 10px;}
        </style>

        <script>
            $(document).ready(function () {
                $('#itemslider').carousel({interval: 9000});

                $('.carousel-showmanymoveone .item').each(function () {
                    var itemToClone = $(this);

                    for (var i = 1; i < 6; i++) {
                        itemToClone = itemToClone.next();

                        if (!itemToClone.length) {
                            itemToClone = $(this).siblings(':first');
                        }

                        itemToClone.children(':first-child').clone()
                                .addClass("cloneditem-" + (i))
                                .appendTo($(this));
                    }
                });
                $(".inline").colorbox({inline: true, width: "25%",initialHeight:'260px'});
                $(".inline2").colorbox({inline: true, width: "35%"});
                $('#exixtingusertomoonboy').css('display', 'none');

                $('#e_user').click(function () {
                    $('#exixtingusertomoonboy').css('display', 'none');
                    $('#pass_dv1').slideUp();
                    $('#pass_dv2').slideDown();
                    $('#in_up').val('Login');
                    $('#newtomoonboy').css('display', 'block');
                });

                $('#n_user').click(function () {
                    $('#newtomoonboy').css('display', 'none');
                    $('#pass_dv1').slideDown();
                    $('#pass_dv2').slideUp();
                    $('#in_up').val('Sign Up');
                    $('#exixtingusertomoonboy').css('display', 'block');
                });

                $('.forgot_p').click(function () {
                    $('#reg_login_dv').slideUp();
                    $('#forgot_dv').slideDown();
                    $('.sn').slideUp();
                    $('.forgt').slideDown();
                    $('#social_tbl').hide();
                });

                $('#forgt_btn').click(function () {
                    var mail_id = $('#mail').val();
                    var pattern = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    if (mail_id == '') {
                        alert('Please enter your email address');
                        $('#mail').focus();
                        return false;
                    } else if (!pattern.test(mail_id)) {
                        alert('Please provide a valid email address');
                        $('#mail').select();
                        return false;
                    } else {
                        $('#forgt_btn').val('Processing...');
                        $.ajax({
                            url: '<?php echo base_url(); ?>user/forgot_password',
                            method: 'post',
                            data: {email: mail_id},
                            success: function (result)
                            {

                                if (result == 'not_exist') {
                                    $(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>This email address is not exist');
                                    $(".error_msg").slideDown(300);
                                    $('#forgt_btn').val('Continue');
                                }
                                if (result == 'mail_sent') {
                                    $(".error_msg").html('<i class="fa fa-info-circle"></i>Check your email and enter that OTP to reset your password.'
                                            );
                                    $(".error_msg").css({"background-color": "#bde5f8", "border": "1px solid #8598e1", "text-align": "left", "color": "#00529b"});
                                    $(".error_msg").slideDown(300);
                                    $('#forgot_dv').slideUp();
                                    $('#otp_pass_dv').slideDown();
                                }

                            }
                        });
                    }

                });





                $('#searchdiv2').css('display', 'none');
                var timer = null;
                $.fn.delayKeyup = function (callback, ms) {
                    var timer = 0;
                    var el = $(this);
                    $(this).keyup(function () {
                        clearTimeout(timer);
                        timer = setTimeout(function () {
                            callback(el)
                        }, ms);
                    });
                    return $(this);
                };

                $('#search-text').delayKeyup(function (el) {
                    mysearch();
                }, 600);


                $(document).keyup(function (event) {
                    if (event.which === 27 || event.which === 8 || event.which === 46) {
                        $('#searchdiv2').css('display', 'none');
                    }
                });





                $('#slider1').tinycarousel({interval: true});
                $('#slider2').tinycarousel({interval: true});
                $('#slider3').tinycarousel({interval: true});



                $('#tabbed-Carousel').carousel({
                    interval: 4000
                });

                var clickEvent = false;
                $('#tabbed-Carousel').on('click', '.nav a', function () {
                    clickEvent = true;
                    $('.nav li').removeClass('active');
                    $(this).parent().addClass('active');
                }).on('slid.bs.carousel', function (e) {
                    if (!clickEvent) {
                        var count = $('.nav').children().length - 1;
                        var current = $('.nav li.active');
                        current.removeClass('active').next().addClass('active');
                        var id = parseInt(current.data('slide-to'));
                        if (count == id) {
                            $('.nav li').first().addClass('active');
                        }
                    }
                    clickEvent = false;
                });
            });//ready
            var logintobuysku = '';
            function logSignupFunction(pname) {
                var mail_id = $('#mail_id').val();
                var pattern = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

                if ($("#n_user").is(":checked")) {
                    var user = 'new_user';
                }
                if ($("#e_user").is(":checked")) {
                    var user = 'ext_user';
                }

                if (mail_id == '') {
                    alert('please enter your email address.');
                    $('#mail_id').focus();
                    return false;
                } else if (!pattern.test(mail_id)) {
                    alert('Please provide a valid email address');
                    $('#mail_id').select();
                    return false;
                } else {
                    if (user == 'new_user') {
                        var pass = $('#npass').val();
                        var cpass = $('#ncpass').val();
                        if (pass == '') {
                            alert('Please enter password');
                            $('#npass').focus();
                            return false;
                        } else if (cpass == '') {
                            alert('Please re-enter password');
                            $('#ncpass').focus();
                            return false;
                        } else if (pass != cpass) {
                            alert('Password mismatch');
                            $('#ncpass').select();
                            return false;
                        } else {

                            $('#in_up').val('Processing...');
                            $.ajax({
                                url: '<?php echo base_url(); ?>user/login',
                                method: 'post',
                                data: {email: mail_id, password: pass, flag: 1},
                                success: function (result)
                                {
                                    if (result == 'exists') {
                                        $(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>This email address is already exists');
                                        $(".error_msg").slideDown();
                                        $('#in_up').val('login');
                                    }
                                    if (result == 'success' && logintobuysku != '') {
                                        window.location.href = "<?php echo base_url() . 'mycart/checkout_process'; ?>";
                                    }
                                    if (result == 'success' && logintobuysku == '') {
                                        window.location.reload(true);
                                    }
                                }
                            });

                        }
                    }
                    if (user == 'ext_user') {
                        var pass = $('#epass').val();
                        if (pass == '') {
                            alert('please enter your password.');
                            $('#epass').focus();
                            return false;
                        } else {

                            $('#in_up').val('Processing...');
                            $.ajax({
                                url: '<?php echo base_url(); ?>user/login',
                                method: 'post',
                                data: {email: mail_id, password: pass, flag: 2},
                                success: function (result)
                                {
                                    if (result == 'blocked') {
                                        $(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>This user is already blocked');
                                        $(".error_msg").slideDown(200);
                                        $('#in_up').val('Login');
                                    }
                                    if (result == 'invalid') {
                                        $(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>Invalid Username or Password');
                                        $(".error_msg").slideDown(200);
                                        $('#in_up').val('Login');
                                    }
                                    if (result == 'success' && logintobuysku == '') {
                                        window.location.reload(true);
                                    }
                                    if (result == 'success' && logintobuysku != '') {

                                        window.location.href = "<?php echo base_url() . 'mycart/checkout_process'; ?>"
                                    }
                                }
                            });

                        }
                    }
                }
            }

            function search_url() {
                var val = $('#search-text').val();
                if (val != "")
                {
                    window.location.href = '<?php echo base_url(); ?>Product_description/suggestword?search_title=' + val;
                }
            }

            function getuname(val) {
                var x = val;
                $('#search-text').val(x);
                $('#searchdiv2').css('display', 'none');
            }
            function mysearch() {

                var n = $('#search-text').val();

                $.ajax({
                    url: '<?php echo base_url() . 'user/search_product' ?>',
                    method: 'post',
                    data: {name: n},
                    success: function (data, status)
                    {
                        if ($('#search-text').val() != "")
                        {
                            $("#searchdiv2 ul").html(data);
                            $('#searchdiv2').css('display', 'block');
                        } else
                        {
                            $("#searchdiv2 ul").html("");
                            $('#searchdiv2').css('display', 'none');
                        }
                    }
                });
            }

            function checkOtp() {
                var otp = $('#otp').val();
                if (otp == '') {
                    alert('Please enter your OTP');
                    $('#otp').focus();
                    return false;
                } else {

                    $('#otp_btn').val('Processing...');
                    $.ajax({
                        url: '<?php echo base_url(); ?>user/check_otp_forgot_password',
                        method: 'post',
                        data: {otp: otp},
                        success: function (result)
                        {
                            if (result === 'not_exist') {
                                $(".error_msg").css({'background-color': 'pink', 'border': '1px solid salmon', 'color': '#790606'});
                                $(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>This OTP is not matched.');
                                $('#otp_btn').val('Continue');
                            } else {
                                $('#chng_email').val(result);
                                $(".error_msg").slideUp();
                                $('#otp_pass_dv').slideUp();
                                $('#chng_pass_dv').slideDown();
                            }
                        }
                    });

                }
            }
            function changedPassword() {
                var email = $('#chng_email').val();
                var psss = $('#new_pass').val();
                var cpsss = $('#cnew_pass').val();
                if (psss == '') {
                    alert('Enter your new password');
                    $('#new_pass').focus();
                    return false;
                } else if (cpsss == '') {
                    alert('Enter your confirm password');
                    $('#cnew_pass').focus();
                    return false;
                } else if (psss != cpsss) {
                    alert('Password mismatch.');
                    $('#cnew_pass').select();
                    return false;
                } else {

                    $('#chng_btn').val('Processing...');
                    $.ajax({
                        url: '<?php echo base_url(); ?>user/change_forgot_password',
                        method: 'post',
                        data: {email: email, pass: psss},
                        success: function (result)
                        {
                            if (result === 'not') {
                                $(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>Password not changed');
                                $('#chng_btn').val('Change Password');
                            }
                            if (result == 'ok') {
                                window.location.reload(true);
                            }
                        }
                    });

                }
            }
            function OverFunction() {
                $("#profile_menu").show();
            }

            function OutFunction() {
                $("#profile_menu").hide();
            }

            function OverFunction1() {
                $("#profile_menu_mob").show();
            }

            function OutFunction1() {
                $("#profile_menu_mob").hide();
            }
            //dummy method added to avoid error
            function OverFunction_cart() {

            }
            function OutFunction_cart() {

            }
// Facebook Pixel Code 04jan2019
            !function (f, b, e, v, n, t, s)
            {
                if (f.fbq)
                    return;
                n = f.fbq = function () {
                    n.callMethod ?
                            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq)
                    f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script',
                    'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '137266173574817');
            fbq('track', 'PageView');
        </script>
        <noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=137266173574817&ev=PageView&noscript=1"/>
    </noscript>
</head>
<body>
    <!----------------------------------------Header Section start------------------------------------------------------>
    <div class="site-branding">
        <!------------------------- Logo Section  Start-------------------------------------->
        <div class="logo">
            <a href="<?php echo base_url(); ?>" title="<?= DOMAIN_NAME ?>">
                <img src="<?php echo base_url(); ?>images/logo.png" alt="<?= COMPANY ?>" width="100%">
            </a>
        </div>
        <?php
        $qrs = $this->db->query("select * from category_menu_desktop where parent_id=0 AND order_by!=0 
                                    AND is_active='Yes' order by order_by");
        ?>
        <div class="nav-left">
            <ul class="menu-cat">
                <li> <a href="#" class="triger"> All Categories  <i class="fa fa-angle-down"></i> </a>
                    <!-- <div class="menu-cont">-->
                    <ul class="mainCat">
                        <?php foreach ($qrs->result() as $rw) { ?>
                            <li class="slink">  <h1 class="catgry-name"><?php echo $rw->label_name; ?> 
                                    <?php
                                    $q_arrow = $this->db->query("select * from category_menu_desktop where 
                                            parent_id='$rw->dskmenu_lbl_id' AND order_by!=0 AND is_active='Yes' order by order_by ");
                                    $ct_arrow = $q_arrow->num_rows();
                                    if ($ct_arrow > 0) {
                                        ?>
                                        <?php
                                    }
                                    ?>
                                    <!--1st level-->
                                    <i class="fa fa-angle-right"></i> </h1>
                                <div class="menuItems" onmouseover="ShowMenuDiv()" onmouseout="NormalMenuDiv()">  
                                    <ul class="sub-category grid" data-masonry="{ &quot;columnWidth&quot;: 0 }">
                                        <?php
                                        $qr = $this->db->query("select * from category_menu_desktop where 
                                        parent_id='$rw->dskmenu_lbl_id' AND order_by!=0 AND is_active='Yes' order by order_by ");
                                        $ct = $qr->num_rows();
                                        if ($ct > 0) {
                                            foreach ($qr->result() as $rs) {
                                                ?>

                                                <li class="grid-item">
                                                    <a href="<?php echo base_url() . 'category/' . $rs->url_displayname ?>">
                                                        <h1 class="catgry-name"><?php echo $rs->label_name; ?>
                                                            <?php
                                                            $q_arrow1 = $this->db->query("select * from category_menu_desktop where 
                                                     parent_id='$rs->dskmenu_lbl_id' AND order_by!=0 AND is_active='Yes' order by order_by ");
                                                            $ct_arrow1 = $q_arrow1->num_rows();
                                                            if ($ct_arrow1 > 0) {
                                                                ?>
                                                            <?php } ?>
                                                        </h1>
                                                    </a>
                                                    <div class="sub-menuitems">
                                                        <ul>
                                                            <?php
                                                            $qr1 = $this->db->query("select * from category_menu_desktop where 
                                                            parent_id='$rs->dskmenu_lbl_id' AND order_by!=0 AND is_active='Yes' 
                                                            AND category_id!='' order by order_by ");
                                                            $ct1 = $qr1->num_rows();
                                                            if ($ct1 > 0) {
                                                                foreach ($qr1->result() as $rs1) {
                                                                    ?>
                                                                    <li> <!--<a href="">-->
                                                                        <a href="<?php echo base_url() . $rs1->url_displayname ?>"><?php echo $rs1->label_name; ?>
                                                                            <?php
                                                                            $q_arrow2 = $this->db->query("select * from category_menu_desktop 
                                                                where parent_id='$rs1->dskmenu_lbl_id' AND order_by!=0 
                                                                AND is_active='Yes' order by order_by ");
                                                                            $ct_arrow2 = $q_arrow2->num_rows();
                                                                            if ($ct_arrow2 > 0) {
                                                                                ?>
                                                                            <?php } ?>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </li> 
            </ul> 
        </div>

        <div class="nav-middle"> 
            <div class="search">
                <input type="text" title="Search For Products, Brands and More" id="search-text" onKeyDown="if (event.keyCode == 13)
                            search_url();" name="search" placeholder="Search For Products, Brands and More" autocomplete="off" required >
                <div id="searchdiv2"><ul></ul></div>
                <button class="search-btn" value="" type="button" onClick="search_url()" id="btn-search"> <i class="fa fa-search"></i> </button>
            </div>
        </div>
        <div class="nav-right">
            <ul>
                <?php if ($this->session->userdata('session_data')) { ?>
                    <li style="margin-right:2px;" class="log-in" onMouseOver="OverFunction()" onMouseOut="OutFunction()"> <a href="#">Hello 
                            <span class="orange"><?php echo $this->session->userdata['session_data']['fname']; ?> </span> </a>
                        <div id="profile_menu">
                            <ul>
                                <li><a href="<?php echo base_url(); ?>profile">Account</a></li>
                                <li><a href="<?php echo base_url(); ?>orders">Orders</a></li>
                                <li><a href="<?php echo base_url(); ?>wish-list">Wishlist</a></li>
                                <li><a href="<?php echo base_url(); ?>review-rating">Reviews & Ratings</a></li>
                                <li><a href="<?php echo base_url(); ?>change_password">Change Password</a></li>
                                <li><a href="<?php echo base_url(); ?>user/logout">Logout</a></li>
                            </ul>
                        </div>
                    </li>

                <?php } else { ?>
                    <li class="log-in" ><a style="margin-right:12px; " title="Login" class="inline" href="#inline_content"> Log in </a></li>
                <?php } ?>
                <li class="wlist-top" >
                    <a style="margin-right:-10px;" href="<?php
                    if (@$this->session->userdata['session_data']['user_id'] != "") {
                        echo base_url() . 'user/wishlist';
                        ?> " title="Your Wishlist!" >
                            <i class="fa fa-heart-o"></i>
                            <?php
                            $user_id = $this->session->userdata['session_data']['user_id'];
                            $query = $this->db->query("SELECT * from wishlist where user_id='$user_id'");
                            $wishlist_row = $query->num_rows();
                            if ($wishlist_row != 0) {
                                echo "<div id='top-cart_data'>" . @$wishlist_row . " </div>";
                            } else {
                                echo " ";
                            }
                            ?>          

                        </a>
                    </li>
                    <?php
                } else if (@$this->session->userdata['session_data']['user_id'] == "") {
                    ?>
                    <li style="margin-right:-2px;" class="wlist-top" onClick="addWishlistFunction()" >
                        <a  class='inline' href="#inline_content" title="your Wishlist!"><i class="fa fa-heart-o"></i></a>

                        <?php
                        $addtowish_arr = $this->session->userdata('addtowishlist_tempsku');
                        $wishlist = 0;
                        if (is_array($addtowish_arr)) {
                            $wishlist = count($addtowish_arr);
                        }

                        if ($wishlist != 0) {
                            echo "<div id='top-cart_data'>" . @$wishlist . " </div>";
                        } else if ($wishlist == "") {
                            echo " ";
                        }
                    }
                    ?>
                </li>

                <li style="margin-right:0px;"  class="cart-top" onMouseOver="OverFunction_cart()" onMouseOut="OutFunction_cart()" style="margin-right:5px;">
                    <a href="<?php echo base_url() . 'mycart/mycart_detail'; ?>" title="Show My Cart">
                        <i class="fa fa-shopping-cart"></i> 
                        <?php
                        if (@$this->session->userdata('addtocarttemp_session_id') != "" && @$this->session->userdata['session_data']['user_id'] == "") {

                            $addtocart_arr = $this->session->userdata('addtocart_sku');
                            $ct1 = count($addtocart_arr);
                            if ($ct1 != 0) {
                                echo "<div id='top-cart_data'>" . @$ct1 . " </div>";
                            } else if ($ct1 == "") {
                                echo " ";
                            }
                            ?> <?php
                        } elseif (@$this->session->userdata('addtocarttemp_session_id') != "" && @$this->session->userdata['session_data']['user_id'] != "") {

                            $ids = $this->session->userdata('addtocarttemp_session_id');
                            $user_id = $this->session->userdata['session_data']['user_id'];
                            $qr = $this->db->query("select * from addtocart_temp where user_id='$user_id' ");
                            $ct = $qr->num_rows();

                            if ($ct != 0) {

                                echo "<div id='top-cart_data'>" . @$ct . " </div>";
                            } else if ($ct == 0) {
                                echo " ";
                            }
                            ?>                     
                            <?php
                        } elseif (@$this->session->userdata('addtocarttemp_session_id') == "" && @$this->session->userdata['session_data']['user_id'] == "") {
                            ?>

                            <?php
                        } elseif (@$this->session->userdata('addtocarttemp_session_id') == "" && @$this->session->userdata['session_data']['user_id'] != "") {
                            $ids = $this->session->userdata('addtocarttemp_session_id');
                            $user_id = $this->session->userdata['session_data']['user_id'];
                            $qr = $this->db->query("select * from addtocart_temp where user_id='$user_id' ");
                            $ct = $qr->num_rows();
                            if ($ct != 0) {
                                echo "<div id='top-cart_data'>" . @$ct . " </div>";
                            } else if ($ct == 0) {
                                echo " ";
                            }
                            ?>

                        <?php } ?>                          
                    </a>
                    <div class="clearfix"> </div>  
                </li>
                <?php if ($this->session->userdata('session_data')) { ?>
                    <li class="track" style="margin-right:2px;"> 
                            <a title="Track Orders" style="background-color:white;margin-right:5px;"  href="<?php echo base_url(); ?>orders"><!--<i class="fa fa-map-marker"></i>--><img src="<?php echo base_url() . 'images/trackorder.png'; ?>"style="width:32px; height:32px; margin-top:-8px;"  alt="support"></a>
                    </li>
                <?php } ?>       
                <li class="track" style="background-color:white;margin-right:0px;"> 
                    <a title="Support" style="background-color:white;" href="<?php echo base_url(); ?>contact-us"> <img src="<?php echo base_url(); ?>images/supports.png" style="width:29px; height:29px; margin-top:-8px;"  alt="support"> </a> 
                </li>
                <?php if (!$this->session->userdata('session_data')) { ?>
                    <li class="track"  style="background-color:white;margin-right:1px;"> 
                        <a title="Sell With Us" style="background-color:white;margin-right:1px;" target="_blank" href="<?php echo base_url(); ?>seller/seller"><img src="<?php echo base_url(); ?>images/sell_with_us.png" style="width:29px; height:29px; margin-top:-5px; margin-left: 9px;"  ></a> 
                    </li>
                <?php } ?>       

                <li  style="margin-top:20px;margin-left:0px;">  
                    <a  class="blog" title="Our Blog" style="background-color:white;color: black" href="<?= APP_BASE ?>blog/" target="_blank"><img src="<?php echo base_url(); ?>images/blog.png" style="width:29px; height:29px; margin-top:-18px; margin-left: -9px;"  ></a>
                </li>
            </ul>
        </div>

        <div style="display:none">
            <div id="inline_content">
                <div class="sign_in_dv">                    
                    <div class="col-md-12" style="padding:0px;" >
                        <div id="reg_login_dv">
                            <table class="big-table" >
                                <tr>
                                    <td height="30"><div class="error_msg" style="margin-top:5px; border-radius: 10px; font-size: 12px"></div></td>
                                </tr>
                                
                                <tr>
                                    <td><input type="text" class="input-text" id="mail_id" Placeholder="Enter email address"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="pass_dv1">
                                            <input type="password" name="npass" id="npass" class="input-text" Placeholder="Enter password">
                                            <input type="password" name="ncpass" id="ncpass" class="input-text" Placeholder="Re-enter password" 
                                                   onKeyDown="if (event.keyCode == 13)
                                                               document.getElementById('in_up').click()">
                                        </div>
                                        <div id="pass_dv2">
                                            <input type="password" name="epass" id="epass" class="input-text" Placeholder="Enter password"  
                                                   onkeydown="if (event.keyCode == 13)
                                                               document.getElementById('in_up').click()">
                                            <p class="forgot_p">Forgot Password</p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php
                                        if ($this->session->userdata('pre_session_id')) {
                                            $pname = preg_replace('#"#', '-', preg_replace('#/#', '-', str_replace(' ', '-', strtolower($this->session->userdata['pre_session_id']['product_name'])))) . '/' . $this->session->userdata['pre_session_id']['product_id'] . '/' . $this->session->userdata['pre_session_id']['sku'];
                                        } else {
                                            $pname = '';
                                        }
                                        ?>
                                        <input  style="margin-right:12px;" type="submit" class="btn1 btn-sign-in" id="in_up" value="Login" onClick="logSignupFunction('<?= $pname; ?>')">

                                    </td>
                                </tr>
                                <tr>
                                    <td class="new_exist">
                                        <span id="newtomoonboy">  <label ><input type="radio" name="radio" id="n_user"> New To <?= COMPANY ?> ??  Sign Up </label></span>
                                        <span id="exixtingusertomoonboy"><label ><input type="radio" name="radio" id="e_user" checked> Existing User ?? Login</label>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div id="forgot_dv">
                            <h4 class="title6 forgt"><?= COMPANY ?> Password Assistance</h4>
                            <table class="big-table" >
                                <tr>
                                    <td>
                                        <span>Enter your email address to regenerate password</span><br/>
                                        <input type="text" class="input-text" id="mail" Placeholder="Enter email address">
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="submit" id="forgt_btn" class="btn1 btn-sign-in" value="Continue"></td>
                                </tr>
                            </table>
                        </div>

                        <div id="otp_pass_dv">
                            <table class="big-table" >
                                <tr>
                                    <td>
                                        <span>Enter the OTP</span><br/>
                                        <input type="text" class="input-text" name="otp" id="otp" placeholder="Enter OTP">
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="submit" id="otp_btn" onClick="checkOtp()" class="btn1 btn-sign-in" value="Continue"></td>
                                </tr>
                            </table>
                        </div>

                        <div id="chng_pass_dv">
                            <table class="big-table" >
                                <tr>
                                    <td>
                                        <span>Chenge your password</span><br/>
                                        <input type="text" class="input-text" name="chng_email" id="chng_email" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="password" class="input-text" name="new_pass" id="new_pass" placeholder="Enter new password">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="password" class="input-text" name="cnew_pass" id="cnew_pass" placeholder="Confirm new password">
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="submit" id="chng_btn" onClick="changedPassword()" class="btn1 btn-sign-in" value="Change Password"></td>
                                </tr>
                            </table>
                        </div>
                        <!--Forgot password div end here-->

                        <div class="clearfix"></div>
                        <?php if (DOMAIN_NAME == 'moonboy.in'): ?>
                            <table class="big-table"  id="social_tbl">
                                <tr> 
                                    <td>
                                        <div class="facebook-login"> 
                                            <a href="#" onClick="Login()"><img src="<?php echo base_url(); ?>images/facebook.png"  alt="facebook"> <i> Login with Facebook</i>
                                                <div class="clearfix"> </div></a></div>
                                        <div class="google-login">
                                            <a href="#" onClick="login()"><img src="<?php echo base_url(); ?>images/gplus.png"  alt="google+"> <i> Login with Google+</i>
                                                <div class="clearfix"></div></a> 
                                        </div> 
                                    </td>
                                </tr> 
                            </table>
                        <?php endif; ?>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>
    </div>  