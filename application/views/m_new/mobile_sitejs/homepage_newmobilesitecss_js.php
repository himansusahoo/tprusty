    
<script>
function myFunction(x) 
{
    x.classList.toggle("fa-minus");
}
</script>
<script type="text/javascript">
		$(document).ready(function()
		{
			$('#slider1').tinycarousel();
		});
</script>    
	
<script src="<?php echo base_url()?>mobile_css_js/new/js/bootstrap.min.js"></script>            
<script src="<?php echo base_url()?>mobile_css_js/new/js/bigSlide.js"></script>
            
<script>
	$(document).ready(function() {
	$('.menu-link').bigSlide();
	});
</script>
            <script>$(document).ready(function() {
  $('#media').carousel({
	  items : 1,
    pause: true,
    interval: false,
	autoPlay : true,
  });
});</script>
          
 <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>mobile_css_js/new/css/easy-responsive-tabs.css " />
 <script src="<?php echo base_url()?>mobile_css_js/new/js/easyResponsiveTabs.js"></script>
		<!-- requried-jsfiles-for owl -->
		<link href="<?php echo base_url()?>mobile_css_js/new/css/owl.carousel.css" rel="stylesheet">
		<script src="<?php echo base_url()?>mobile_css_js/new/js/owl.carousel.js"></script>
        
			<script>
				$(document).ready(function() {
					$("#owl-demo").owlCarousel({
						items : 3,
						lazyLoad : true,
						autoPlay : true,
						//pagination : true,
					});
				});
			</script>

 <script type="text/javascript">jssor_9_slider_init();</script>
 
 <script type="text/javascript">
		$(document).ready(function()
		{
			$('#slider4').tinycarousel({ interval: true });
			$('#slider2').tinycarousel();
			$('#slider3').tinycarousel({ interval: true });
		});
		
	</script>
    
    <script type="text/javascript">
		$(document).ready(function()
		{
			$('#slider7').tinycarousel({ interval: true });
			$('#slider8').tinycarousel();
			$('#slider9').tinycarousel({ interval: true });
		});
		
	</script>          
<script type="text/javascript">
		$(document).ready(function()
		{
			$('#slider21').tinycarousel({ interval: true });
			$('#slider22').tinycarousel();
			$('#slider23').tinycarousel({ interval: true });
		});
		
	</script>
    
    <script type="text/javascript">jssor_7_slider_init();</script>
    
    <script type="text/javascript">jssor_8_slider_init();</script>
    
    <script type="text/javascript">
		$(document).ready(function()
		{
			$('#slider13').tinycarousel({ interval: true });
			$('#slider14').tinycarousel();
			$('#slider15').tinycarousel({ interval: true });
		});
		
</script>		 

<script type="text/javascript">
		$(document).ready(function()
		{
			$('#slider16').tinycarousel({ interval: true });
			$('#slider17').tinycarousel();
			$('#slider18').tinycarousel({ interval: true });
		});
</script>		 


<script type="text/javascript">
    $(document).ready(function() {

        //Vertical Tab
        $('#parentVerticalTab').easyResponsiveTabs({
            type: 'vertical', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo2');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
    });
</script>


<script src="<?php echo base_url()?>mobile_css_js/new/js/jquery.nicescroll.js"></script>

<script src="<?php echo base_url()?>mobile_css_js/new/js/scripts.js"></script>
