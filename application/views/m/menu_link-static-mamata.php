 <?php require_once('header.php') ?>
          
<link rel="stylesheet" href="<?php echo base_url()?>mobile_css_js/new/css/font-awesome.min.css"> 
			<link href="<?php echo base_url()?>mobile_css_js/new/css/bootstrap.min.css" rel="stylesheet" type="text/css">
			<link href="<?php echo base_url()?>mobile_css_js/new/css/style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php echo base_url()?>mobile_css_js/new/js/jquery.min.js"></script>
      <script src="<?php echo base_url()?>mobile_css_js/new/js/bootstrap.min.js"></script><!-- requried-jsfiles-for owl -->
<style>
.panel-group .panel-heading + .panel-collapse > .panel-body {
  
}
.panel-group,
.panel-group .panel,
.panel-group .panel-heading,
.panel-group .panel-heading a,
.panel-group .panel-title,
.panel-group .panel-title a,
.panel-group .panel-body,
.panel-group .panel-group .panel-heading + .panel-collapse > .panel-body {
  border-radius: 2px;
  border: 0;
}
.panel-group .panel-heading {
  padding: 0;
}
.panel-group .panel-heading a {
  display: block;
  background: #f5f5f5;
  color: #444;
  padding: 7px 10px;
  text-decoration: none;
  text-align: left;
  position: relative;
  border: 1px solid #ddd;
  width: 100%;
    border: 1px solid #ddd;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
    border-radius: 3px;
    margin-bottom: 5px;
}
#nested.panel-group .panel-heading a {
  cursor: pointer;
    display: block;
    padding: 10px;
    color: #4D4D4D;
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 2px;
	
    background: #e3e3e3;
    border: 1px solid #CCC;
    position: relative;
    -webkit-transition: all 0.4s ease;
    -o-transition: all 0.4s ease;
    transition: all 0.4s ease;
}

.panel-group .panel-heading a.collapsed {
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

#nested.panel-group .panel-heading a.collapsed {
  cursor: pointer;
    display: block;
    padding: 10px;
    color: #4D4D4D;
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 2px;
	
    background: #e3e3e3;
    border: 1px solid #CCC;
    position: relative;
    -webkit-transition: all 0.4s ease;
    -o-transition: all 0.4s ease;
    transition: all 0.4s ease;
}
#nested.panel-group {
    width: 98%;
    margin: auto;
    border: 1px solid #ccc;
    /* padding-top: 2px; */
}
#nested.panel-title {
    margin-top: 0 !important;
    margin-bottom: -3px !important;
    font-size: 16px;
    color: inherit;
}
#nested.panel-group .panel-heading a.collapsed:after {
    content: '\02C7';
    color: #333;
    font-weight: bold;
    float: right;
    margin-left: 5px;
    padding: 0px 10px;
    border: none;
    font-size: 42px;
    height: 34px;
    width: 34px;
    line-height: 56px;
    /* background: #ccc; */
    text-align: center;
    padding: 0px;
}

#nested.panel-group .panel-heading a:after {
    content: "\02C6";
    color: #777;
    font-weight: bold;
    float: right;
    margin-left: 5px;
    padding: 0px 10px;
    border: none;
    font-size: 42px;
    height: 34px;
    width: 34px;
    line-height: 56px;
    /* background: #ccc; */
    text-align: center;
    padding: 0px;
}
#nested.panel-title {
    margin-top: -3px;
    /* margin-bottom: 11px; */
    font-size: 16px;
    color: inherit;
}

.panel-group .panel-heading a:after {
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
.panel-group .panel-heading a.collapsed:after {
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
.panel-group .panel-collapse {
  margin-top: 5px !important;
}
.panel-group .panel-body {
  background: #ffffff;
  padding: 15px;
}
.panel-group .panel {
  background-color: transparent;
}
.panel-group .panel-body p:last-child,
.panel-group .panel-body ul:last-child,
.panel-group .panel-body ol:last-child {
  margin-bottom: 0;
}

.panel-group .panel-collapse {
    margin-top: 0px !important;
}
.menu-link-product-held{
	float: left;
    width: 47%;
    border: 1px solid #B9B9B9;
    height: 80px;
    max-height: 120px;
    padding: 1px 4px 2px 10px;
    border-bottom: 1px solid #B9B9B9;
    margin: 1%;
}
.menu-link-product-held-left{
	 width: 30%;float: left;padding: 5px;text-align: center;
}
.menu-link-product-held-left img{height: auto !important; max-width: 100%;  max-height: 60px;}
.menu-link-product-held-right{width: 70%; float: right;  padding: 5px; text-align: left;}
@media only screen and (min-width:0px) and (max-width:320px){
.menu-link-product-held-right p {
    padding: 8px 0 0 0;
}
}
@media only screen and (min-width:321px) and (max-width:360px){
	.menu-link-product-held-right p {
    padding: 12px 0 0 0;
}
}
@media only screen and (min-width:361px) and (max-width:375px){
	.menu-link-product-held-right p {
    padding: 14px 0 0 0;
}
}
</style>

		
</head>
<body>
<div class="wrap">       
<!------------single banner------> 
  <div style="padding-top:9px;">                
	<div class="left-sidebar">	           
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h4 class="panel-title">
                     <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                     <img src="https://www.moonboy.in/images/admin/mobile/mobile_menu/tkmb0nlzryw37ju20170708121348.jpg" class="sbdCategoryIcon">
                     <span class="menu-head">Mobiles,Tablets &amp; Accessories </span>
                     </a>
                  </h4>
               </div><!--/.panel-heading -->
               <div id="collapse1" class="panel-collapse collapse">
                  <div class="panel-body">
						<ul style="float: none; padding: 0;">
                           
                <li>
                    <div class="inn-single" onclick="window.location.href='https://www.moonboy.in/category/mobiles'"> 
                                                  
                    <div class="menu-link-product-held"> 
                    <div class="menu-link-product-held-left">
                         <img src="https://www.moonboy.in/images/admin/mobile/mobile_menu/uhgxm0bamf8tlid20170609174915.jpg" onclick="window.location.href='#'">
                    </div> 
                    <div class="menu-link-product-held-right">
                    	<p><strong>Mobiles</strong></p>
                    </div>                 
                    
                    </div>
                   </div>
                </li>
                               
                <li>
                    <div class="inn-single" onclick="window.location.href='https://www.moonboy.in/category/tablets'"> 
                                                  
                    <div class="menu-link-product-held"> 
                    <div class="menu-link-product-held-left">
                         <img src="https://www.moonboy.in/images/admin/mobile/mobile_menu/gnizdq6fmc3kjey20170609174937.jpg" onclick="window.location.href='#'">
                    </div> 
                    <div class="menu-link-product-held-right">
                    	<p><strong>Tablets</strong></p>
                    </div>                 
                    
                    </div>
                   </div>
                </li>
                               
                <li>
                    <div class="inn-single" onclick="window.location.href='https://www.moonboy.in/category/mobile-accessories'"> 
                                                  
                    <div class="menu-link-product-held"> 
                    <div class="menu-link-product-held-left">
                         <img src="https://www.moonboy.in/images/admin/mobile/mobile_menu/nkz89yr5meisc0220170710122033.jpg" onclick="window.location.href='#'">
                    </div> 
                    <div class="menu-link-product-held-right">
                    	<p><strong>Mobile Accessories</strong></p>
                    </div>                 
                    
                    </div>
                   </div>
                </li>
                               
                <li>
                    <div class="inn-single" onclick="window.location.href='https://www.moonboy.in/category/tablet-accessories'"> 
                                                  
                    <div class="menu-link-product-held"> 
                    <div class="menu-link-product-held-left">
                         <img src="https://www.moonboy.in/images/admin/mobile/mobile_menu/8wemydoigjtt0in20170710121059.jpg" onclick="window.location.href='#'">
                    </div> 
                    <div class="menu-link-product-held-right">
                    	<p><strong>Tablet Accessories</strong></p>
                    </div>                 
                    
                    </div>
                   </div>
                </li>
                               
                <li>
                    <div class="inn-single" onclick="window.location.href='https://www.moonboy.in/category/smart-devices'"> 
                                                  
                    <div class="menu-link-product-held"> 
                    <div class="menu-link-product-held-left">
                         <img src="https://www.moonboy.in/images/admin/mobile/mobile_menu/m0es7x6xv1iqata20170619175528.jpg" onclick="window.location.href='#'">
                    </div> 
                    <div class="menu-link-product-held-right">
                    	<p><strong>Smart Devices</strong></p>
                    </div>                 
                    
                    </div>
                   </div>
                </li>
                            </ul>

                  </div><!--/.panel-body -->
               </div><!--/.panel-collapse -->
            </div><!-- /.panel -->
            
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h4 class="panel-title">
                     <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
<img src="https://www.moonboy.in/images/admin/mobile/mobile_menu/tkmb0nlzryw37ju20170708121348.jpg" class="sbdCategoryIcon">
                     <span class="menu-head">Mobiles,Tablets &amp; Accessories </span>                     </a>
                  </h4>
               </div><!--/.panel-heading -->
               <!-----------------------------------------------------Second-main-menu--------------------------->
               <div id="collapseTwo" class="panel-collapse collapse">
                  <div class="panel-body">

                    <!-- nested -->

		 <div style="width:95%; margin:auto;">
         <div class="panel-group" id="nested">
         
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h4 class="panel-title" style="margin-bottom: 0px;">
                     <a class="collapsed" data-toggle="collapse" data-parent="#nested" href="#8">
                     <img src="https://www.moonboy.in/images/admin/mobile/mobile_menu/5anpj3ql9ob2xuz20170708195041.jpg" class="sbdCategoryIcon" height="28" width="28">
                     <span class="menu-head">Men;s Fashion </span>
                     </a>
                  </h4>
               </div><!--/.panel-heading -->
               <div id="8" class="panel-collapse collapse">
                  <div class="panel-body " style="padding:0px !important;">
						<ul style="width:100%; background:#fef9e7; padding-left:0px;">
                        	<li style="width:100%;display:list-item; height:auto;border-bottom:1px solid #ccc;padding:5px;">
  <a style="font-size: 13px;padding: 0;font-weight: bold; text-transform: capitalize; margin-left: 0; color: #333; width: 100%; text-align: left;margin-top: 0px;font-family: "SegoeUI", Arial, Helvetica, sans-serif;" href="https://www.moonboy.in/category/mens-watches">Watches</a>
                            </li>
                            <li style="width:100%;display:list-item; height:auto;border-bottom:1px solid #ccc;padding:5px;">
  <a style="font-size: 13px;padding: 0;font-weight: bold; text-transform: capitalize; margin-left: 0; color: #333; width: 100%; text-align: left;margin-top: 0px;font-family: "SegoeUI", Arial, Helvetica, sans-serif;" href="https://www.moonboy.in/category/mens-watches">Watches</a>
                            </li>
                            <li style="width:100%;display:list-item; height:auto;border-bottom:1px solid #ccc;padding:5px;">
  <a style="font-size: 13px;padding: 0;font-weight: bold; text-transform: capitalize; margin-left: 0; color: #333; width: 100%; text-align: left;margin-top: 0px;font-family: "SegoeUI", Arial, Helvetica, sans-serif;" href="https://www.moonboy.in/category/mens-watches">Watches</a>
                            </li>
                        </ul>
                  </div><!--/.panel-body -->
               </div><!--/.panel-collapse --> 
            </div><!-- /.panel --> 
            
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h4 class="panel-title" style="margin-bottom: 0px;">
                     <a class="collapsed" data-toggle="collapse" data-parent="#nested" href="#nested-collapse9">
                     <img src="https://www.moonboy.in/images/admin/mobile/mobile_menu/5anpj3ql9ob2xuz20170708195041.jpg" class="sbdCategoryIcon" height="28" width="28">
                     <span class="menu-head">Men;s Fashion </span>
                     </a>
                  </h4>
               </div><!--/.panel-heading -->
               <div id="nested-collapse9" class="panel-collapse collapse">
                  <div class="panel-body " style="padding:0px !important;">
						<ul style="width:100%; background:#fef9e7; padding-left:0px;">
                        	<li style="width:100%;display:list-item; height:auto;border-bottom:1px solid #ccc;padding:5px;">
  <a style="font-size: 13px;padding: 0;font-weight: bold; text-transform: capitalize; margin-left: 0; color: #333; width: 100%; text-align: left;margin-top: 0px;font-family: "SegoeUI", Arial, Helvetica, sans-serif;" href="https://www.moonboy.in/category/mens-watches">Watches</a>
                            </li>
                            <li style="width:100%;display:list-item; height:auto;border-bottom:1px solid #ccc;padding:5px;">
  <a style="font-size: 13px;padding: 0;font-weight: bold; text-transform: capitalize; margin-left: 0; color: #333; width: 100%; text-align: left;margin-top: 0px;font-family: "SegoeUI", Arial, Helvetica, sans-serif;" href="https://www.moonboy.in/category/mens-watches">Watches</a>
                            </li>
                            <li style="width:100%;display:list-item; height:auto;border-bottom:1px solid #ccc;padding:5px;">
  <a style="font-size: 13px;padding: 0;font-weight: bold; text-transform: capitalize; margin-left: 0; color: #333; width: 100%; text-align: left;margin-top: 0px;font-family: "SegoeUI", Arial, Helvetica, sans-serif;" href="https://www.moonboy.in/category/mens-watches">Watches</a>
                            </li>
                        </ul>
                  </div><!--/.panel-body -->
               </div><!--/.panel-collapse --> 
            </div><!-- /.pane2 --> 
            
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h4 class="panel-title" style="margin-bottom: 0px;">
                     <a class="collapsed" data-toggle="collapse" data-parent="#nested" href="#nested-collapse10">
                     <img src="https://www.moonboy.in/images/admin/mobile/mobile_menu/5anpj3ql9ob2xuz20170708195041.jpg" class="sbdCategoryIcon" height="28" width="28">
                     <span class="menu-head">Men;s Fashion </span>
                     </a>
                  </h4>
               </div><!--/.panel-heading -->
               <div id="nested-collapse10" class="panel-collapse collapse">
                  <div class="panel-body " style="padding:0px !important;">
						<ul style="width:100%; background:#fef9e7; padding-left:0px;">
                        	<li style="width:100%;display:list-item; height:auto;border-bottom:1px solid #ccc;padding:5px;">
  <a style="font-size: 13px;padding: 0;font-weight: bold; text-transform: capitalize; margin-left: 0; color: #333; width: 100%; text-align: left;margin-top: 0px;font-family: "SegoeUI", Arial, Helvetica, sans-serif;" href="https://www.moonboy.in/category/mens-watches">Watches</a>
                            </li>
                            <li style="width:100%;display:list-item; height:auto;border-bottom:1px solid #ccc;padding:5px;">
  <a style="font-size: 13px;padding: 0;font-weight: bold; text-transform: capitalize; margin-left: 0; color: #333; width: 100%; text-align: left;margin-top: 0px;font-family: "SegoeUI", Arial, Helvetica, sans-serif;" href="https://www.moonboy.in/category/mens-watches">Watches</a>
                            </li>
                            <li style="width:100%;display:list-item; height:auto;border-bottom:1px solid #ccc;padding:5px;">
  <a style="font-size: 13px;padding: 0;font-weight: bold; text-transform: capitalize; margin-left: 0; color: #333; width: 100%; text-align: left;margin-top: 0px;font-family: "SegoeUI", Arial, Helvetica, sans-serif;" href="https://www.moonboy.in/category/mens-watches">Watches</a>
                            </li>
                        </ul>
                  </div><!--/.panel-body -->
               </div><!--/.panel-collapse --> 
            </div><!-- /.pane3 -->
         </div>
         </div>
         <!-- /.panel-group -->


<!-- nested -->
                    
                     
                  </div><!--/.panel-body -->
               </div>
               
            </div><!-- /.panel -->
            
            <!-- /.panel -->
         </div>
 </div>   


<footer class="site-footer">

<div class="container-fluid">
      <div class="copy-right">
          <span class="site-footer-copyright">&copy; 2016, <a href="#">Moonboy</a>. <a target="_blank" rel="nofollow" href="#">Powered by SPIS</a></span>
        </div>
    
 
   <!-- Slide Menu -->  
  </div>
  </footer>
</div>
</div>
</div>
</div>

<script src="<?php echo base_url()?>mobile_css_js/new/js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url()?>mobile_css_js/new/js/scripts.js"></script>
</body>
</html>