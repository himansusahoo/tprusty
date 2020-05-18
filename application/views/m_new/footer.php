<script src="<?php echo base_url()?>mobile_css_js/new/js/jquery.nicescroll.js"></script>

<script src="<?php echo base_url()?>mobile_css_js/new/js/scripts.js"></script>
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
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
  autoplaySpeed: 2000,
});
    });
  </script>

</body>
</html>    