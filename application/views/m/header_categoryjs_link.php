 <link rel="stylesheet" href="<?php echo base_url()?>mobile_css_js/new/css/font-awesome.min.css">
			<link href="<?php echo base_url()?>mobile_css_js/new/css/bootstrap.min.css" rel="stylesheet" type="text/css">
			<link href="<?php echo base_url()?>mobile_css_js/new/css/style.css" rel="stylesheet" type="text/css"/>
            <script src="<?php echo base_url()?>mobile_css_js/new/js/bootstrap.min.js"></script>
            <script src="<?php echo base_url()?>mobile_css_js/new/js/jssor.slider-23.1.6.min.js" type="text/javascript"></script>
            <script src="<?php echo base_url()?>mobile_css_js/new/js/jquery.tinycarousel.js"></script>
  <script>
  $(document).ready(function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
  });
</script>  
     

      <script>
function myFunction(x) {
    x.classList.toggle("fa-minus");
}
</script>
	 <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> 
     <script src="<?php echo base_url()?>mobile_css_js/new/js/jquery-1.11.1.min.js"></script>
	 <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>     
    <script src="<?php echo base_url()?>mobile_css_js/new/js/js/jquery.tinycarousel.js"></script>
	<script type="text/javascript">
		$(document).ready(function()
		{
			$('#slider1').tinycarousel();
		});
	</script>
    
    <script type="text/javascript">
		$(document).ready(function()
		{
			$('#slider01').tinycarousel();
		});
	</script>
    
    
    <!--<script src="colorbox/jquery.min.js"></script>     	
	<script type="text/javascript" src="colorbox/jquery.tinycarousel.js"   ></script> -->  
	<script type="text/javascript">
		$(document).ready(function()
		{
			$('#slider4').tinycarousel({ interval: true });
			$('#slider2').tinycarousel();
			$('#slider3').tinycarousel({ interval: true });
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
          
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>mobile_css_js/new/css/easy-responsive-tabs.css" />
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
						pagination : true,
					});
				});
			</script>
           <style>
  button.first-accordion {
    background-color: #f5f5f5;
    color: #444;
    cursor: pointer;
    padding: 7px 10px;
    width: 100%;
    border: 1px solid #ddd;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
    border-radius: 3px;
    margin-bottom: 5px;
}

button.first-accordion.active, button.first-accordion:hover {
    background-color: #f5f5;
}

button.first-accordion:after {
    content: '\02C7';
    color: #777;
    font-weight: bold;
    float: right;
    margin-left: 5px;
    padding: 0px 10px;
    border: 1px solid #afadad;
    font-size: 42px;
    height: 34px;
    width: 34px;
    line-height: 56px;
    /* background: #ccc; */
    text-align: center;
    padding: 0px;
	
}

button.first-accordion.active:after {
    content: "\02C6";
    color: #777;
    font-weight: bold;
    float: right;
    margin-left: 5px;
    padding: 0px 10px;
    border: 1px solid #afadad;
    font-size: 42px;
    height: 34px;
    width: 34px;
    line-height: 56px;
    /* background: #ccc; */
    text-align: center;
    padding: 0px;
}

div.panel {
    /*padding: 0 15px*/;
    background-color: white;
    max-height: 0;
    transition: max-height 0.2s ease-out;
	margin-bottom: 0!important;
	width: 100%;
	overflow-y: scroll;
}
div.panel ul li {
    list-style: none; 
}
.catagory-banner {
    float: left;
    width: 50%;
/*    border-right: 1px solid #B9B9B9;
*/    /* height: 160px; */
    padding:10px;
/*   border-bottom: 1px solid #B9B9B9;
*/}
.catagory-banner img {
    width: 95%;
	float:left;
	margin-right: 15px;
}
.category-products .panel {
    max-height: 2000px!important;
}
.brands-name {
    border: 1px solid #F7F7F0;
     padding-bottom: 0px;
    padding-top: 0px;
    width: 48%;
    float: left;
    margin-left: 6;
    margin-right: 6px;
    margin-bottom: 6px;
}
  </style>          
           