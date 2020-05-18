
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

<?php } ?>

</body>
</html>    