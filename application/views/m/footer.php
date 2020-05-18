	<style>
		.ftr2 .fa {
			font-size: 28px!important;
			border: 1px solid #fff !important;
			width: 45px !important;
			height: 45px !important;
			text-align: center !important;
			line-height: 45px !important;
		}
	.ftr2 {
    margin: 6px 0;
}
	</style>
	
	<div class="footer-above">  
		<div class="container" style="background-color:#25203b">
			<div class="ftr2" >
            <?php if($this->session->userdata('session_data')){ ?>
				<a style="color:#ffffff; font-size: 13px;" href="<?php echo base_url().'my_order/return_products';?>">
				<i class="fa fa-calendar"></i>   100% Replacement/Refund Guarantee*  </a>
			<?php }else{ ?>
				<a href="<?php echo base_url().'user/m_login' ?>" style="color:#ffffff; font-size: 13px;">
				<i class="fa fa-calendar"></i> 100% Replacement/Refund Guarantee*  </a>
			<?php } ?>
            </div>
			<div class="clearfix"></div>
		</div>
    </div>
<?php require_once('footer_link.php'); ?>  
        <!-----------section 30  end------------------>
      
      
    </footer>
        <!---------------------------------------footer end--------------------------------->
 
 
    
</div>

<?php if($this->uri->segment(1)=='category'){  

require_once('footer_categoryjs_link.php');
?>




<?php } else { ?> 
<script src="<?php echo base_url()?>mobile_css_js/new/js/jquery.nicescroll.js"></script>

<script src="<?php echo base_url()?>mobile_css_js/new/js/scripts.js"></script>

<script src="<?php echo base_url()?>mobile_css_js/new/js/slick.js"></script>
  <script type="text/javascript">
    $(document).on('ready', function() {
      $(".regular").slick({
        dots: true,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4
      });
     $('.autoplay').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 8000,
});
    });
  </script>

  
  <!------------old js link start------------------>
<!--  <script src="<?php //echo base_url().'mobile_css_js/' ?>js/jquery.nicescroll.js"></script>
<script src="<?php //echo base_url().'mobile_css_js/' ?>js/scripts.js"></script>
--><!------------old js link start------------------>

<?php } ?>

</body>
</html>    