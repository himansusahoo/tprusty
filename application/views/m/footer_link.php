<style>

#back-to-top.show {
    opacity: 1;
}
#back-to-top {
    /* background: #ccc none repeat scroll 0 0; */
     /*border: 2px solid #333;
    border-radius: 50%;*/
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
		   <li><a style="font-size:13px;" href="<?php echo base_url().'about-us';?>"> About Us </a></li>
            <li><a style="font-size:13px;" href="<?php echo base_url().'contact-us';?>"> Contact Us</a></li>
            <li><a style="font-size:13px;" href="<?php echo base_url().'contact-us';?>"> Faq</a></li>  
            <li><a style="font-size:13px;" href="<?php echo base_url().'career';?>"> Career </a></li>  
            <li><a style="font-size:13px;" href="<?php echo base_url().'contact-us';?>"> Help </a></li>       
            <li><a style="font-size:13px;" href="https://socialmoonboy.wordpress.com/" target="_blank"> Our Blog </a> </li> 
            <li><a style="font-size:13px;" href="<?=APP_BASE?>sitemap.html"> Sitemap </a></li>
            <li><a style="font-size:13px;" href="<?php echo base_url().'privacy-policy';?>"> Privacy Policy </a></li>
            <li><a style="font-size:13px;" href="<?php echo base_url().'terns-and-conditions';?>"> Terms & Conditions </a></li>
            
            <li><!--<a href="#"> Return Policy </a> -->    
            
            
            <?php if($this->session->userdata('session_data')){ ?>
				<a style="font-size:13px;" href="<?php echo base_url().'my_order/return_products';?>"> Return Policy </a>
<?php }else{ ?>
				<a style="font-size:13px;" href="<?php echo base_url().'user/m_login' ?> "> Return Policy </a>
<?php } ?>
			</li>
            
            <li><a style="font-size:13px;" href="<?php echo base_url().'report-listing';?>"> Report Listing </a></li>
            
          </ul>
          </div>
          
          <!--<div class="ftr-list">
          <ul class="social-icons-footer">            
            <li> <a href="https://twitter.com/moonboy_ltd" target="_blank" title="Twitter"> <i class="fa fa-twitter" aria-hidden="true"></i> Twitter </a>  </li>            
            <li> <a href="https://www.facebook.com/MoonboyIN/" target="_blank" title="Facebook"> <i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>  </li>
            <li> <a href="https://plus.google.com/107116566163445169044" target="_blank" title="Google+"> <i class="fa fa-google-plus" aria-hidden="true"></i> Google + </span> </a> </li>         
            <li> <a href="http://in.linkedin.com/in/moonboy" target="_blank" title="linkedin"> <i class="fa fa-linkedin" aria-hidden="true"></i> linkedin </a>  </li>
            <li> <a href="https://www.pinterest.com/moonboy_ltd/" target="_blank" title="Pinterest"> <i class="fa fa-pinterest-p" aria-hidden="true"></i> Pinterest </span> </a> </li>
          </ul>
         </a> 
        </div>
        
        <div class="clearfix"> </div>
        
        <div class="paymnt-optn">
          
            <ul class="payment-icons-footer">        
                <li> <i class="fa fa-cc-visa" aria-hidden="true"></i> </li>
                <li> <i class="fa fa-cc-mastercard" aria-hidden="true"></i> </li>
                <li> <i class="fa fa-cc-amex" aria-hidden="true"></i> </li>
                <li> <i class="fa fa-cc-paypal" aria-hidden="true"></i>  </li>
                <li> <i class="fa fa-cc-diners-club" aria-hidden="true"></i> </li>
                <li> <i class="fa fa-cc-discover" aria-hidden="true"></i> </li>    
                <div class="clearfix"> </div>
            </ul>
      </div>-->
       <div class="clearfix"> </div>
      <div class="copy-right">
          <span style="font-size:12px;" class="site-footer-copyright">&copy; 2011-<?php echo date("Y"); ?> <a href="<?php echo base_url() ?>">Moonboy</a>
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
	
 };
</script>