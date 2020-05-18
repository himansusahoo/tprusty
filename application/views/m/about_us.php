<?php include "header.php"; ?>

<style>
h3.tittle, h3.tittle.two {
    width: 80%;
    margin: auto;
}
h3.tittle:before {
    position: absolute;
    left: -43px;
    top: 21px;
	width: 17%;
}
h3.tittle:after {
    position: absolute;
    right: -43px;
    top: 21px;
	width: 17%;
}
p {
    text-align: justify;
	margin-top:15px;
}

</style>
	<div class="wrap">
		<!--Aboutus-->
   <div class="info-inner">
		     		      
		  <div class="section-info i-page">
				<h3 class="tittle"><?=$result->title?></h3>
               <?=$result->content?>

		  </div>
  </div>
  <!--//Aboutus-->
		
   </div>


<?php include "footer.php"; ?>