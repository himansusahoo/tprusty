<footer class="site-footer">
      
       <div class="ftr-list">
          <ul>         
            <li><a href="<?php echo base_url().'about-us';?>"> About Us </a></li>
            <li><a href="<?php echo base_url().'contact-us';?>"> Contact Us</a></li>
            <li><a href="<?php echo base_url().'contact-us';?>"> Faq</a></li>  
            <li><a href="#"> Career </a></li>  
            <li><a href="#"> Help </a></li>       
            <li><a href="https://socialmoonboy.wordpress.com/" target="_blank"> Our Blog </a> </li> 
            <li><a href="https://www.moonboy.in/sitemap.html"> Sitemap </a></li>
        </ul>
      </div>
      
      <div class="ftr-list">
        <ul>         
            <li><a href="<?php echo base_url().'privacy-policy';?>"> Privacy Policy </a></li>
            <li><a href="<?php echo base_url().'terns-and-conditions';?>"> Terms & Conditions </a></li>
            
            <li><!--<a href="#"> Return Policy </a> -->    
            
            
            <?php if($this->session->userdata('session_data')){ ?>
				<a href="<?php echo base_url().'my_order/return_products';?>"> Return Policy </a>
<?php }else{ ?>
				<a href="<?php echo base_url().'user/m_login' ?> "> Return Policy </a>
<?php } ?>
			</li>
            <li><a href="<?php echo base_url().'report-listing';?>"> Report Listing </a></li>      
        </ul>
      </div>
       <div class="ftr-list">
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
      </div>
       <div class="clearfix"> </div>
      <div class="copy-right">
          <span class="site-footer-copyright">&copy; 2016, <a href="#">Moonboy</a>. <a target="_blank" rel="nofollow" href="http://www.saiparamount.com/">Powered by SPIS</a></span>
        </div>
    </footer>
  </div> 
  
  
  
  <?php include "mobile_menu.php"; ?> 
  
</div>

<!--<script src="<?php //echo base_url().'mobile_css_js/' ?>js/wow.js"></script>-->
<script>
    /*wow = new WOW(
      {
        animateClass: 'animated',
        offset:       100,
        callback:     function(box) {
          console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
      }
    );
	
	 wow.init();
    document.getElementById('moar').onclick = function() {
      var section = document.createElement('section');
      section.className = 'wow fadeInDown';
      this.parentNode.insertBefore(section, this);
    };*/
  </script>

<script src="<?php echo base_url().'mobile_css_js/' ?>js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url().'mobile_css_js/' ?>js/scripts.js"></script>
</body>
</html>