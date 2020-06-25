<style>

    #back-to-top.show {
        opacity: 1;
    }
    #back-to-top {

        bottom: 44px;
        color: #444;
        cursor: pointer;
        height: 32px;
        line-height: 30px;
        opacity: 0;
        position: fixed;
        right: 30px;
        text-align: center;
        text-decoration: none;
        transition: opacity 0.2s ease-out 0s;
        width: 32px;
        z-index: 9999;
    }
    #back-to-top .fa{font-size: 30px;
                     border: none;
                     width: 32px;
                     height: 32px;
                     text-align: center;
                     line-height: 32px;
                     right: 30px;
    }
    .show {
        display: block!important;
    }
</style>
<div>
    <ul class="footer-li">
        <li><a style="font-size:13px;" href="<?php echo base_url() . 'about-us'; ?>"> About Us </a></li>
        <li><a style="font-size:13px;" href="<?php echo base_url() . 'contact-us'; ?>"> Contact Us</a></li>
        <li><a style="font-size:13px;" href="<?php echo base_url() . 'contact-us'; ?>"> Faq</a></li>  
        <li><a style="font-size:13px;" href="<?php echo base_url() . 'career'; ?>"> Career </a></li>  
        <li><a style="font-size:13px;" href="<?php echo base_url() . 'contact-us'; ?>"> Help </a></li>       
        <li><a style="font-size:13px;" href="https://socialmoonboy.wordpress.com/" target="_blank"> Our Blog </a> </li> 
        <li><a style="font-size:13px;" href="<?= APP_BASE ?>sitemap.html"> Sitemap </a></li>
        <li><a style="font-size:13px;" href="<?php echo base_url() . 'privacy-policy'; ?>"> Privacy Policy </a></li>
        <li><a style="font-size:13px;" href="<?php echo base_url() . 'terns-and-conditions'; ?>"> Terms & Conditions </a></li>

        <li>
            <?php if ($this->session->userdata('session_data')) { ?>
                <a style="font-size:13px;" href="<?php echo base_url() . 'my_order/return_products'; ?>"> Return Policy </a>
            <?php } else { ?>
                <a style="font-size:13px;" href="<?php echo base_url() . 'user/m_login' ?> "> Return Policy </a>
            <?php } ?>
        </li>

        <li><a style="font-size:13px;" href="<?php echo base_url() . 'report-listing'; ?>"> Report Listing </a></li>

    </ul>
</div>
<div class="clearfix"> </div>
<div class="copy-right">
    <span style="font-size:12px;" class="site-footer-copyright"><?= COPY_RIGHT_YEAR ?>
</div>
<a href="#" id="back-to-top" title="Back to top" class="show"><i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i></a>
</div>
<script>
    if ($('#back-to-top').length) {
        var scrollTrigger = 100, // px
                backToTop = function () {
                    var scrollTop = $(window).scrollTop();
                    if (scrollTop > scrollTrigger) {
                        $('#back-to-top').addClass('show');
                    } else {
                        $('#back-to-top').removeClass('show');
                    }
                };
        backToTop();
        $(window).on('scroll', function () {
            backToTop();
        });
        $('#back-to-top').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });

    }
    ;
</script>