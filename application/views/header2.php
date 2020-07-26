
<meta name="yandex-verification" content="d52dd7abecd04cda" />
<!-- Favicon --> 
<?php
$this->db->cache_off();
if ($this->session->userdata('sesscoke') == false) {

    $data = array();
    $this->session->set_userdata('sesscoke', $data);
}
?>
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico">
<!-- Custom CSS -->
<link href="<?php echo base_url(); ?>css/frontend/style.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/frontend/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/frontend/fontawesome.css" rel="stylesheet">
<!-- jQuery -->
<script src="<?php echo base_url(); ?>js/jquery.js"  ></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>js/bootstrap.min.js"  ></script>       
<!-- Mobile Menu -->
<script src="<?php echo base_url(); ?>js/mobmenu_jquery-latest.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/script.js"  ></script>
<!-- Mobile Menu -->  

<!-- masonry -->   
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.1.0/masonry.pkgd.min.js"></script>
<script type="text/javascript">
    $('.grid').masonry({
        // options
        itemSelector: '.grid-item',
        columnWidth: 200
    });

</script>

<!-- Fix Navbar -->
<script type="text/javascript" src="<?php echo base_url(); ?>js/fix-nav-jquery.min.js"></script>    
<script type="text/javascript">
    var _rys = jQuery.noConflict();
    _rys("document").ready(function () {
        _rys(window).scroll(function () {
            if (_rys(this).scrollTop() > 30) {
                _rys('.site-branding').addClass("f-nav");
            } else {
                _rys('.site-branding').removeClass("f-nav");
            }
        });
    });
</script>

<script type="text/javascript">
    var fixtop = jQuery.noConflict();
    fixtop("document").ready(function () {

        fixtop(window).scroll(function () {
            if (fixtop(this).scrollTop() > 30) {
                fixtop('.mob-fixhead').addClass("f-nav");
            } else {
                fixtop('.mob-fixhead').removeClass("f-nav");
            }
        });
    });
</script>

<!-- Fix Navbar -->
<script>
    /*$(document).ready(function(){
     $('#searchdiv2').css('display','none');
     $("#search-text").keyup(function(e){
     if(e.keyCode != 13){
     $('#searchdiv2').css('display','block');
     var n=$('#search-text').val();
     
     $.ajax({
     url:'<?php //echo base_url().'user/search_product'  ?>',
     method:'post',
     data:{name:n},
     success:function(data,status)
     {
     if($('#search-text').val()!="")
     {
     $("#searchdiv2 ul").html(data);
     }
     else
     {
     $("#searchdiv2 ul").html("");
     $('#searchdiv2').css('display','none');
     }		
     }
     });
     }
     else
     {
     var xhr = $.get('/server');
     setTimeout(function(){xhr.abort();}, 2000);
     
     }
     
     });
     
     $(document).keyup(function(event){
     if(event.which === 27){
     $('#searchdiv2').hide();
     }
     });
     
     });
     */


    $(document).ready(function () {

        $('#searchdiv2').css('display', 'none');
        var timer = null;
        /*$('#search-text').keyup(function(e){
         if(e.keyCode != 13){
         clearTimeout(timer); 
         timer = setTimeout(mysearch, 500);
         }
         });*/
        /*var timer = 0;
         $('#search-text').live('keyup', function(e){
         if(timer) {
         clearTimeout(timer);
         }
         timer = setTimeout(mysearch, 500); 
         });*/

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
            /*alert(el.val());*/
            mysearch();
        }, 1000);


        $(document).keyup(function (event) {
            if (event.which === 27 || event.which === 8 || event.which === 46) {
                //$('#searchdiv2').hide();
                $('#searchdiv2').css('display', 'none');
            }
        });

    });

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
                }
                else
                {
                    $("#searchdiv2 ul").html("");
                    $('#searchdiv2').css('display', 'none');
                }
            }
        });
    }


</script>


<!--<script>
function ShowMenuDiv(){
        $('.mainCat').css('left','-240px');
        $('.menuItems').css('display','block');
        /*$('.menu-cont').animate({
               "left": "-240px",
                "opacity" : "show"
              }, {
            duration: 500
          });      */
}

function NormalMenuDiv(){
        /*$('.menu-cont').animate({
            "left": "0px",
            "opacity" : "hide"
        }, "slow");*/
        $('.mainCat').css('left','0px');
        $('.menuItems').css('display','none');
}
</script>-->

<!-- Lightbox link start here-->
<link rel="stylesheet" href="<?php echo base_url(); ?>colorbox/colorbox.css" />
<script src="<?php echo base_url(); ?>colorbox/jquery.min.js"   ></script>
<script src="<?php echo base_url(); ?>colorbox/jquery.colorbox.js"  ></script>
<script>
$(document).ready(function () {
$(".inline").colorbox({inline: true, width: "25%", height: "447px"});
$(".inline2").colorbox({inline: true, width: "35%"});
});
</script>
<!-- Lightbox link end here-->

<script>
    $(document).ready(function () {
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


    });
</script>

<!--Sign in or sign Up script start here-->
<script>
    var logintobuysku = '';
    function logSignupFunction(pname) {
        //alert(pname);return false;
        //alert(logintobuysku);
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
            ///////script start for NEW USER/////////
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
                            //$(".error_msg").html(result);
                            if (result == 'exists') {
                                $(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>This email address is already exists');
                                $(".error_msg").slideDown();
                                $('#in_up').val('login');
                            }
                            if (result == 'success' && logintobuysku != '') {
                                window.location.href = "<?php echo base_url() . 'mycart/checkout_process'; ?>";
                            }
                            if (result == 'success' && logintobuysku == '') {
                                //else{
                                /*$(".error_msg").html(result);
                                 $(".error_msg").fadeIn(500);*/
                                window.location.reload(true);
                            }
                        }
                    });

                }
            }
            ///////script end of NEW USER/////////

            ///////script start for Exiting USER/////////
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
                            /*$(".error_msg").html(result);
                             $(".error_msg").fadeIn(500);*/
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
                                //$(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>ssccdd');
                                window.location.reload(true);
                            }
                            if (result == 'success' && logintobuysku != '') {

                                window.location.href = "<?php echo base_url() . 'mycart/checkout_process'; ?>"
                            }
                        }
                    });

                }
            }
            ///////script end of Exiting USER/////////
        }
        //});
        //});
    }
</script>
<!--Sign in or sign Up script end here-->

<!--Forgot password script start here-->
<script>
    $(document).ready(function () {
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

    });

    ///////OTP Verification start here////////
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
                    }
                    else {
                        $('#chng_email').val(result);
                        $(".error_msg").slideUp();
                        $('#otp_pass_dv').slideUp();
                        $('#chng_pass_dv').slideDown();
                    }
                }
            });

        }
    }
    ///////OTP Verification end here////////

    ///////Change password script start here////////
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
    ///////Change password script end here////////	
</script> 
<!--Forgot password script end here-->

<script>
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
</script>


<!-- Product Carousel -->

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.tinycarousel.js"   ></script>
<script type="text/javascript">
    $(document).ready(function ()
    {
        $('#slider1').tinycarousel({interval: true});
        $('#slider2').tinycarousel();
        $('#slider3').tinycarousel({interval: true});
    });

</script>

<!--  google analytics code -->   

<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-69461190-1', 'auto');
    ga('send', 'pageview');

</script>


<!-- START OF ADDME LINK 
<a href="http://www.addme.com/submission/free-submission-start.php">Search Engine Submission - AddMe</a> -->
<!-- END OF ADDME LINK -->

<!--<a href="http://www.cotid.org/">submit your Url to cotid.org</a> tto improve marketing This site is listed under <a href="http://www.botid.org/Shopping/Clothing/Ethnic_And_Regional/">Ethnic and Regional Directory </a>-->


<!-- Facebook Pixel Code -->
<script>
    !function (f, b, e, v, n, t, s) {
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
    }(window,
            document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');

    fbq('init', '1673583359625937');
    fbq('track', "PageView");</script>
<noscript> <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1673583359625937&ev=PageView&noscript=1" alt="facebook" /> </noscript>
<!-- End Facebook Pixel Code -->

<!-- Google Tag Manager -->
<noscript> <iframe src="//www.googletagmanager.com/ns.html?id=GTM-N68WW2" height="0" width="0" style="display:none;visibility:hidden"></iframe> </noscript>
<script>(function (w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({'gtm.start':
                    new Date().getTime(), event: 'gtm.js'});
        var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
                '//www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-N68WW2');</script>
<!-- End Google Tag Manager -->
<script>
    function search_url()
    {
        var val = $('#search-text').val();
        if (val != "")
        {
            window.location.href = '<?php echo base_url() . 'search-by/' ?>' + val;
        }

    }



</script>
</head>

<body>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N68WW2"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Top Bar -->
    <div class="top_bar"> 
        <div class="topbar-content">

            <ul class="top-left">
                <!--<li>  <a  href="#" class="voucher"> Use Voucher: SALE25 </a>  </li>
                <li>  <a  href="#"> Get Extra 25% off on new arrivals on Minimum purchase of Rs.1999  </a></li> -->  
<!-- <li><a  href="<?php //echo base_url().'Product_description/product_search?search=valentine'  ?>"><img style="width:176px;height:25px;margin-left:500px;" src="<?php //echo base_url().'images/valentine_2017-02-02.gif'  ?>"></a></li>-->
            </ul>
            <!--<div class="top-middle"> <i class="fa fa-phone-square"></i> HOT Line  : +91 78744 60000 </div>-->
            <div  class="top-right">  
                <ul>
                    <li> <!--<a class="blog" href="https://socialmoonboy.wordpress.com/" target="_blank"> Our Blog </a>--> 

                        <a class="blog" href="<?= APP_BASE ?>blog/" target="_blank"> Our Blog </a> 
                    </li>
                        <!--<li> <a href="<?php echo base_url(); ?>user/customersupport"> 24x7 Costumer Support </a> </li>-->
                    <li> <a href="<?php echo base_url(); ?>contact-us"> Customer Support </a> </li>
                    <?php if ($this->session->userdata('session_data')) { ?>
                        <li> <a href="<?php echo base_url(); ?>orders"><i class="fa fa-map-marker"></i> Track Your Order </a> </li>
                    <?php } else { ?>
                        <li> <a class="inline" href="#inline_content"><i class="fa fa-map-marker"></i> Track Your Order</a></li>
                    <?php } ?>
                    <li><a class="last" href="<?php echo base_url(); ?>seller/seller" target="_blank"> Sell With Us </a></li>
                </ul>
            </div>
            <div class="clearfix"></div>

        </div>
    </div>

    <!-- Top Bar -->

    <!-- Site Header -->
    <div class="site-branding">
        <div class="topbar-content">

            <div class="logo"> <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>images/logo.png" alt="<?= COMPANY ?>"></a> </div>


            <?php $qrs = $this->db->query("select * from category_menu_desktop  where parent_id=0 AND order_by!=0 AND is_active='Yes' order by order_by  "); ?> 

            <div class="nav-left">   
                <ul class="menu-cat">
                    <li> <a href="#" class="triger"> All Categories  <i class="fa fa-angle-down"></i> </a>
                        <!-- <div class="menu-cont">-->
                        <ul class="mainCat" >
                            <?php foreach ($qrs->result() as $rw) { ?>				
                                <li  class="slink">  <h1 class="catgry-name"><?php echo $rw->label_name; ?> 
                                        <!--1st level-->
                                        <?php
                                        //$q_arrow=$this->db->query("select * from category_menu_desktop where parent_id='$rw->dskmenu_lbl_id' AND order_by!=0 AND is_active='Yes' order by order_by "); 
                                        //$ct_arrow=$q_arrow->num_rows();		
                                        //if($ct_arrow>0){ 
                                        ?> <?php //}  ?> <i class="fa fa-angle-right"></i> </h1>

                                    <div class="menuItems"  onMouseOver="ShowMenuDiv()" onMouseOut="NormalMenuDiv()">  
                                        <ul class="sub-category grid" data-masonry="{ &quot;columnWidth&quot;: 0 }">

                                            <?php
                                            $qr = $this->db->query("select * from category_menu_desktop where parent_id='$rw->dskmenu_lbl_id' AND order_by!=0 AND is_active='Yes' order by order_by ");
                                            //$rw=$qr->result();
                                            $ct = $qr->num_rows();

                                            if ($ct > 0) {
                                                ?>

        <?php foreach ($qr->result() as $rs) { ?> <!--level-2 -->

                                                    <li class="grid-item">

                                                        <?php //if($rs->view_type=='category'){ ?>
                                                        <?php /* ?><a href="<?php echo base_url().'product_description/product_data/'.preg_replace('#/#',"-",str_replace(' ','-',strtolower($rs->label_name))).'/'.$rs->dskmenu_lbl_id ?>"> <?php */ ?>              

                                                        <?php /* ?><a href="<?php echo base_url().'category/'.preg_replace('#/#',"-",str_replace("'",'-',str_replace('&','-',str_replace(' ','-',strtolower($rs->label_name))))) ?>"><?php */ ?>

                                                        <?php //}else{ ?>   
            <?php /* ?> <a href="<?php echo base_url().'product_description/category_catalog/'.preg_replace('#/#',"-",str_replace(' ','-',strtolower($rs->label_name))).'/'.$rs->dskmenu_lbl_id ?>"><?php */ ?> 


                                                        <a href="<?php echo base_url() . 'category/' . $rs->url_displayname ?>">
            <?php //}  ?>
                                                            <h1 class="catgry-name"><?php echo $rs->label_name; ?>  

                                                                <?php
                                                                $q_arrow1 = $this->db->query("select * from category_menu_desktop where parent_id='$rs->dskmenu_lbl_id' AND order_by!=0 AND is_active='Yes' order by order_by ");

                                                                $ct_arrow1 = $q_arrow1->num_rows();

                                                                if ($ct_arrow1 > 0) {
                                                                    ?>

            <?php } ?> </h1> </a>

                                                        <div class="sub-menuitems">
                                                            <ul>

                                                                <?php
                                                                $qr1 = $this->db->query("select * from category_menu_desktop where parent_id='$rs->dskmenu_lbl_id' AND order_by!=0 AND is_active='Yes' AND category_id!='' order by order_by ");
                                                                //$rw=$qr->result();
                                                                $ct1 = $qr1->num_rows();

                                                                if ($ct1 > 0) {
                                                                    ?>

                <?php foreach ($qr1->result() as $rs1) { ?>

                                <li> <!--<a href="<?php //echo base_url().'product_description/product_addtocart/'.preg_replace('#/#',"-",str_replace(' ','-',strtolower($rs1->label_name))).'/'.str_replace(',','-',$rs1->category_id) ?>">-->

                                                                            <a href="<?php echo base_url() . $rs1->url_displayname ?>">   

                                                                                <?php echo $rs1->label_name; ?>

                                                                                <?php
                                                                                $q_arrow2 = $this->db->query("select * from category_menu_desktop where parent_id='$rs1->dskmenu_lbl_id' AND order_by!=0 AND is_active='Yes' order by order_by ");

                                                                                $ct_arrow2 = $q_arrow2->num_rows();

                                                                                if ($ct_arrow2 > 0) {
                                                                                    ?>
                                                            <?php } ?> 
                                                                            </a>       <!-- level-3-end -->
                                                                        </li> 
                <?php } ?>  <?php } ?>
                                                            </ul> </div>
                                                        <!-- level-2-end -->	</li>							
        <?php } ?>  <?php } ?>

                                        </ul> </div>
                                </li> 

<?php } ?> </ul>  

                        <!--</div>  -->    
                    </li> 
                </ul> 
            </div>

            <div class="nav-middle"> 
                <div  class="search">
                    <?php /* ?>
                      <?php
                      $attributes = array('method'=>'get');
                      echo form_open_multipart('Product_description/product_search',$attributes);
                      ?><?php */ ?>
                    <input type="text" placeholder="Search Your Product" onKeyDown="if (event.keyCode == 13)
                    search_url();" id="search-text" name="search" autocomplete="off" required/> 
                    <div id="searchdiv2"><ul>        </ul></div>
                    <button class="search-btn" value="" type="button" onClick="search_url()" id="btn-search"> <i class="fa fa-search"></i> </button>
                    <!--</form>-->
                </div> </div>

            <div class="nav-right">
                <ul>

<?php if ($this->session->userdata('session_data')) { ?>
                        <li class="log-in" onMouseOver="OverFunction()" onMouseOut="OutFunction()"> <a href="#">Hello <span class="orange"><?php echo $this->session->userdata['session_data']['fname']; ?> </span> </a>
                            <div id="profile_menu">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>profile">Account</a></li>
                                    <li><a href="<?php echo base_url(); ?>orders">Orders</a></li>
                                    <!--<li><a href="#">Wallet</a></li>-->
                                    <li><a href="<?php echo base_url(); ?>wish-list">Wishlist</a></li>
                                    <li><a href="<?php echo base_url(); ?>review-rating">Reviews & Ratings</a></li>
                                    <!--<li><a href="#">Email Preferences</a></li>-->
                                    <li><a href="<?php echo base_url(); ?>change_password">Change Password</a></li>
                                    <li><a href="<?php echo base_url(); ?>user/logout">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                                               <?php } else { ?>
                        <li class="log-in" ><a class="inline" href="#inline_content"> Log In </a></li>
                                               <?php } ?>


                    <li class="wlist-top" > <a href="
                                               <?php if (@$this->session->userdata['session_data']['user_id'] != "") {
                                                   echo base_url() . 'user/wishlist'; ?> " title="your Wishlist!" > <i class="fa fa-heart-o"></i>
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
                            </a> </li>

                        <?php } else if (@$this->session->userdata['session_data']['user_id'] == "") {
                            ?>
                        <li class="wlist-top" onClick="addWishlistFunction()" > <a class='inline' href="#inline_content" title="your Wishlist!"><i class="fa fa-heart-o"></i> </a>

                            <?php
                            if (count($this->session->userdata('addtowishlist_tempsku')) != 0) {
                                echo "<div id='top-cart_data'>" . @count($this->session->userdata['addtowishlist_tempsku']) . " </div>";
                            }
                        }
                        ?>
                    </li>


                    </li>
                    <li  class="cart-top" onMouseOver="OverFunction_cart()" onMouseOut="OutFunction_cart()"> 
                            <?php /* ?><a href="<?php if(@$this->session->userdata['session_data']['user_id']!=""){ echo base_url().'mycart/mycart_detail'; }else {echo base_url().'mycart/guest_cart_detail'; } ?>" title="Show my cart"><?php */ ?> 

                        <a href="<?php echo base_url() . 'mycart/mycart_detail'; ?>" title="Show my cart">
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



                </ul>

            </div>
            <div class="clearfix"></div>



            <!-- navigation -->

            <div class="clearfix"></div>

        </div>
        <div class="clearfix"></div>

    </div>	<!-- header -->
    <div class="clearfix"></div>


    <!-- Mobile header -->   
    <div class="mobile-header">
        <div class="topbar-content">


            <div class="logo"> <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>images/logo.png" alt="<?= COMPANY ?>"></a> </div>

            <div class="mob-cart">
                <ul>     
                    <li class="wlist-top"><a href="#" title="your Wishlist!" ><i class="fa fa-heart-o"></i>
                            <div id="top-cart_data"> 0 </div> </a> </li>

                    <li  class="cart-top" onMouseOver="OverFunction_cart()" onMouseOut="OutFunction_cart()"> 
<?php /* ?> <a href="<?php if(@$this->session->userdata['session_data']['user_id']!=""){ echo base_url().'mycart/mycart_detail'; }else {echo base_url().'mycart/guest_cart_detail'; } ?>" title="Show my cart"> <?php */ ?> 
                        <a href="<?php echo base_url() . 'mycart/mycart_detail'; ?>" title="Show my cart"> 

                            <i class="fa fa-shopping-cart"></i> 
                            <div  id="top-cart_data">  <?php
if (@$this->session->userdata('addtocarttemp_session_id') != "" && @$this->session->userdata['session_data']['user_id'] == "") {

    $addtocart_arr = $this->session->userdata('addtocart_sku');
    $ct1 = count($addtocart_arr);
    echo @$ct1 . " ";
    ?> <?php
} elseif (@$this->session->userdata('addtocarttemp_session_id') != "" && @$this->session->userdata['session_data']['user_id'] != "") {

    $ids = $this->session->userdata('addtocarttemp_session_id');
    $user_id = $this->session->userdata['session_data']['user_id'];
    $qr = $this->db->query("select * from addtocart_temp where user_id='$user_id' ");
    $ct = $qr->num_rows();

    if ($ct != 0) {
        echo @$ct . " ";
    } else {
        echo "0 ";
    }
    ?>                     
                                <?php
                                } elseif (@$this->session->userdata('addtocarttemp_session_id') == "" && @$this->session->userdata['session_data']['user_id'] == "") {
                                    ?>
                                    0 
                                <?php
                                } elseif (@$this->session->userdata('addtocarttemp_session_id') == "" && @$this->session->userdata['session_data']['user_id'] != "") {
                                    $ids = $this->session->userdata('addtocarttemp_session_id');
                                    $user_id = $this->session->userdata['session_data']['user_id'];
                                    $qr = $this->db->query("select * from addtocart_temp where user_id='$user_id' ");
                                    $ct = $qr->num_rows();
                                    if ($ct != 0) {
                                        echo @$ct . " ";
                                    } else {
                                        echo "0 ";
                                    }
                                    ?>

                                <?php } ?>

                            </div>  </a>
                        <div class="clearfix"> </div>

                    </li>

                </ul>

            </div>

            <div class="clearfix"></div>

                                <?php $qrs = $this->db->query("select a.*,b.catg_image,b.category_id from category_indexing a inner join category_master b on a.category_name=b.category_name where a.parent_id=0 "); ?> 

<?php /* ?><div class="mob-fixhead">
  <div class="mob-menu">

  <div id='cssmenu'>
  <ul>
  <?php foreach($qrs->result() as $rw ) {?>
  <li>
  <a href="#" > <?php echo $rw->category_name; ?>
  <!--1st level-->
  <?php $q_arrow=$this->db->query("select * from category_indexing where parent_id='$rw->category_id' ");

  $ct_arrow=$q_arrow->num_rows();
  if($ct_arrow>0){ ?> <?php } ?> </a>

  <ul>

  <?php $qr=$this->db->query("select * from category_indexing where parent_id='$rw->category_id' ");

  $ct=$qr->num_rows();

  if($ct>0){ ?>

  <?php
  foreach($qr->result() as $rs){ ?> <!--level-2 -->

  <li>

  <a href="<?php echo base_url().'product_description/product_data/'.str_replace(" ","-",strtolower($rs->category_name)).'/'.$rs->category_id ?>"> <?php echo	$rs->category_name;?>

  <?php $q_arrow1=$this->db->query("select * from category_indexing where parent_id='$rs->category_id' ");

  $ct_arrow1=$q_arrow1->num_rows();

  if($ct_arrow1>0){ ?>

  <?php } ?>  </a>

  <ul>

  <?php $qr1=$this->db->query("select * from category_indexing where parent_id='$rs->category_id' ");

  $ct1=$qr1->num_rows();

  if($ct1>0){ ?>

  <?php
  foreach($qr1->result() as $rs1){ ?>

  <li> <a href="<?php echo base_url().'product_description/product_addtocart/'.str_replace(" ","-",strtolower($rs1->category_name)).'/'.$rs1->category_id ?>">  <?php echo	$rs1->category_name;?>

  <?php $q_arrow2=$this->db->query("select * from category_indexing where parent_id='$rs1->category_id' ");

  $ct_arrow2=$q_arrow2->num_rows();

  if($ct_arrow2>0){ ?>
  <?php } ?>
  </a>       <!-- level-3-end -->
  </li>
  <?php } ?>  <?php } ?>
  </ul>
  <!-- level-2-end -->	</li>
  <?php } ?>  <?php } ?>

  </ul>
  </li>

  <?php } ?>

  </ul>
  </div>


  </div>

  <div class="mob-search">
  <div  class="search">

  <?php
  $attributes = array('method'=>'get');
  echo form_open_multipart('Product_description/product_search',$attributes);?>
  <input type="text" placeholder="Search.. " id="search-text" name="search" />
  <div id="searchdiv2"><ul>        </ul></div>
  <button class="search-btn" value="" type="submit" id="btn-search"> <i class="fa fa-search"></i> </button>
  <div class="clearfix"> </div>
  </form>
  </div> </div>

  <div class="mob-login">
  <ul> <?php if($this->session->userdata('session_data')){ ?>
  <li class="log-in" onMouseOver="OverFunction1()" onMouseOut="OutFunction1()">
  <a href="#"> <i class="fa fa-user"></i> </a>
  <!-- <a href="#">Hello <span class="light-yellow"><?php //echo $this->session->userdata['session_data']['fname'] ; ?> </span> </a> -->
  <div id="profile_menu_mob">
  <ul>
  <li><a href="<?php echo base_url(); ?>profile">Account</a></li>
  <li><a href="<?php echo base_url(); ?>orders">Orders</a></li>
  <!--<li><a href="#">Wallet</a></li>-->
  <li><a href="<?php echo base_url(); ?>wish-list">Wishlist</a></li>
  <li><a href="<?php echo base_url(); ?>review-rating">Reviews & Ratings</a></li>
  <!--<li><a href="#">Email Preferences</a></li>-->
  <li><a href="<?php echo base_url(); ?>change_password">Change Password</a></li>
  <li><a href="<?php echo base_url(); ?>user/logout">Logout</a></li>
  </ul>
  </div>
  </li>
  <?php }else{ ?>
  <li class="log-in" ><a class='inline' href="#inline_content"> <i class="fa fa-user"></i>  </a></li>
  <?php } ?>

  </ul>
  </div>


  <div class="clearfix"></div>



  <!-- navigation -->

  <div class="clearfix"></div>

  </div><?php */ ?>        </div>
        <div class="clearfix"></div>

    </div>
    <!-- Mobile header -->     
    <div class="clearfix"></div>



    <div style="display:none">
        <div id="inline_content">
            <div class="sign_in_dv">
                <div class="error_msg"></div>

                <div class="col-md-12" style="padding:0px;" >
                    <div id="reg_login_dv">
                        <table class="big-table" >
                            <tr>
                                <td><input type="text" class="input-text" id="mail_id" Placeholder="Enter email address"></td>
                            </tr>
                            <tr>
                                <td>
                                    <div id="pass_dv1">
                                        <input type="password" name="npass" id="npass" class="input-text" Placeholder="Enter password">
                                        <input type="password" name="ncpass" id="ncpass" class="input-text" Placeholder="Re-enter password" onKeyDown="if (event.keyCode == 13)
                        document.getElementById('in_up').click()">

                                    </div>
                                    <div id="pass_dv2">
                                        <input type="password" name="epass" id="epass" class="input-text" Placeholder="Enter password"  onkeydown="if (event.keyCode == 13)
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
                                    <input  type="submit" class="btn1 btn-sign-in" id="in_up" value="Login" onClick="logSignupFunction('<?= $pname; ?>')">

                                </td>
                            </tr>
                            <tr>
                                <td class="new_exist">
                                        <!--<label class="radio"><input type="radio" name="radio" id="n_user"><i></i>No, I am a new User.</label>
                                        <label class="radio"><input type="radio" name="radio" id="e_user" checked><i></i>Yes, I have a password.</label>
                                    -->
                                    <span id="newtomoonboy">  <label ><input type="radio" name="radio" id="n_user"> New To <?= COMPANY ?> ??  Sign Up </label></span>
                                    <span id="exixtingusertomoonboy"><label ><input type="radio" name="radio" id="e_user" checked> Existing User ?? Login</label></span>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!--Forgot password div start here-->
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

                    <table class="big-table"  id="social_tbl">
                        <tr> 
                            <td><div class="facebook-login"> <a href="#" onClick="Login()"> <img src="<?php echo base_url(); ?>images/facebook.png"  alt="facebook"> <i> Login with Facebook</i>
                                        <div class="clearfix"> </div>  </a> </div>
                                <div class="google-login"> <a href="#" onClick="login()"> <img src="<?php echo base_url(); ?>images/gplus.png"  alt="google+"> <i> Login with Google+</i>
                                        <div class="clearfix"> </div>   </a> </div> </td>
                        </tr> </table>

                </div>   

                <div class="clearfix"> </div> 


            </div>
        </div>
    </div>


    <div class="wrap">