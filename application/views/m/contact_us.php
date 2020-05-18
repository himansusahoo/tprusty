<?php include "header.php"; ?>
<style>
h3.tittle:before {
    left: -11px;
}
h3.tittle:after {
    right: -11px;
}
p {
    text-align: justify;
}

</style>

<div class="wrap">
    
		<!--Aboutus-->
   <!--<div class="info-inner">
   
	<div class="col-md-4">
<div class="cs_right">
<div class="top_faq mgtop15">
<p><strong>Issue still not resolved?</strong></p>
<a class="title2" href="user/contact_us_form">Contact Us</a></div>
</div>
</div>
<div class="clearfix">&nbsp;</div>
</div>-->	     		      
		  <div class="section-info">
				<h3 class="tittle"><?=$result->title?></h3>
               <?=$result->content?>
       <div class="clearfix"> </div>
		  </div>
          
<div class="cs_right">
<div class="top_faq mgtop15" style="text-align: right;margin-right: 30px; margin-top: -25px; margin-bottom: 10px;">
<p style="text-align:right; margin-bottom:5px;"><strong>Issue still not resolved?</strong></p>
<a style="margin: 10px 0px;background: #eeac0d;padding: 5px; border-radius: 5px;color: #fff !IMPORTANT;" class="title2" href="user/contact_us_form">Contact Us</a></div>
</div>
  
  <!--//Aboutus-->
  
  	
   </div>


<?php include "footer.php"; ?>