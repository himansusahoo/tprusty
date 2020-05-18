 <?php require_once('header.php') ?>
          
<link rel="stylesheet" href="<?php echo base_url()?>mobile_css_js/new/css/font-awesome.min.css"> 
			<link href="<?php echo base_url()?>mobile_css_js/new/css/bootstrap.min.css" rel="stylesheet" type="text/css">
			<link href="<?php echo base_url()?>mobile_css_js/new/css/style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php echo base_url()?>mobile_css_js/new/js/jquery.min.js"></script>
      <script src="<?php echo base_url()?>mobile_css_js/new/js/bootstrap.min.js"></script><!-- requried-jsfiles-for owl -->
<style>
.wrap {
position: relative;
margin-top: 50px;
}
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
    padding: 0 15px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
	    margin-bottom: 0!important;
}
div.panel ul li {
    list-style: none; 
}
.top-accordian{
	    background-color: #f2f2f2;
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
    margin-bottom: 6px;
}
.search_big1 {
    height: 50px;
    width: 100%;
}
.search_big1 input[type="search"] {
    width: 90%;
}
.search_big1 .search{
	position: absolute;
    margin-top: 5px;
    margin-right: 14px;
    height: 42px;
}
.brands-name {
    border: 1px solid #ccc;
    width: 45.9%;
    margin: 2%;
}
.pro-1 img {
    width: 35%;
	float:left;
	margin-right: 15px;
}
.pro-1 p{ margin-top:15px;}
.pro-1 {
    float: left;
    width: 47%;
    border: 1px solid #B9B9B9;
    height: 74px; 
    padding: 1px 4px 2px 10px;
    border-bottom: 1px solid #B9B9B9;
    margin: 1%;
}
.brands-held{
	width:100%; 
	margin:auto; 
	padding:5px;
}
.brands_products ul{ background:#e3e3e3; padding:0!important;}
.brands_products ul li{
	padding:7px; margin:auto; width:100%; border-bottom:1px solid #ccc;
}
.brands_products ul li a{font-size:17px; text-decoration:none; color:#000;}
.accordion {
      width: 100%;
    margin: 0px auto 0px;
    background: #FFF;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    background: #f2f2f2;
}

.accordion .link {
  cursor: pointer;
  display: block;
  padding: 15px 15px 15px 42px;
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

.accordion li:last-child .link { border-bottom: 0; }

.accordion li i {
  position: absolute;
  top: 16px;
  left: 12px;
  font-size: 18px;
  color: #595959;
  -webkit-transition: all 0.4s ease;
  -o-transition: all 0.4s ease;
  transition: all 0.4s ease;
}

.accordion li i.fa-chevron-down {
  right: 12px;
  left: auto;
  font-size: 16px;
}

.accordion li.open .link { color: #b63b4d; }

.accordion li.open i { color: #b63b4d; }

.accordion li.open i.fa-chevron-down {
  -webkit-transform: rotate(180deg);
  -ms-transform: rotate(180deg);
  -o-transform: rotate(180deg);
  transform: rotate(180deg);
}

/**
 * Submenu
 -----------------------------*/


.submenu {
  display: none;
  font-size: 14px;
}

.submenu li {
    border-bottom: 1px solid #4b4a5e;background: #444359;
}

.submenu a {
  display: block;
  text-decoration: none;
  color: #d9d9d9;
  padding: 12px;
  padding-left: 42px;
  -webkit-transition: all 0.25s ease;
  -o-transition: all 0.25s ease;
  transition: all 0.25s ease;
}
.submenu ul li a:hover{background:#F39;}



.lifestyle-submenu {
  display: none;
  font-size: 14px;
}
<!--.lifestyle-submenu li:nth-child(3){background:#fff;}-->
.lifestyle-submenu li { /*border-bottom: 1px solid #e3e3e3;*/background: #fff; }

.lifestyle-submenu a {
  display: block;
  text-decoration: none;
  color: #000;
  padding: 12px;
  padding-left: 42px;
  -webkit-transition: all 0.25s ease;
  -o-transition: all 0.25s ease;
  transition: all 0.25s ease;
}
.lifestyle-submenu ul li a:hover{background: #f5cba7; padding:5px 0;}
</style>		
            

    <!--</head>
<body>
<div class="body-back">
        	<div class="masthead pdng-stn1">-->
		<!-- Header Bar-->
			<!--<div class="menu-notify">
				<div class="profile-left left">
					<h5 class="pro-link"> <a href="index.html"><img src="images/logo.png" width="180" height="55" alt=""  class="img-responsive"> </a></h5>
				</div>
				
				<div class="profile-right">
                <ul>
                <li><a href="#"><i class="fa fa-user"></i> Account</a></li>
                <li>  <a href="#"><i class="fa fa-heart" aria-hidden="true"></i> </a> </li>
			   <li>  <a href="#checkout" class="cart">
						 <div class="total"> 
                             <span id="simpleCart_quantity" class="simpleCart_quantity">1</span> </div>
						<i class="fa fa-shopping-cart"></i> </h3>
					</a>
				</li>
                 
                
					</ul>
                  
					
				</div>
				<div class="clearfix"></div>
            </div>
            </div>-->
        <!-- Header Bar--> 
       
              
              
		<div class="wrap">       
		
	
           <!------------single banner------> 
  <div style="padding-top:60px;">                
	<div class="left-sidebar">	           
        <!------------- toogle start------------>
 <?php $qrs=$this->db->query("select * from category_menu_mobile where parent_id=0 AND order_by!=0 AND is_active='Yes' order by order_by "); ?>
             
				
<!--------------------------------- product Box Start here------------------------------------>
<?php foreach($qrs->result() as $rw ) {
	 
	
	 $q_arrow=$this->db->query("select * from category_menu_mobile where parent_id='$rw->dskmenu_lbl_id' AND order_by!=0 AND is_active='Yes' order by order_by "); 
   if($rw->label_name=='Life Style'){	
	?>
    <!--------------------------------- product list Child-menu start here------------------------------------>

        <button class="first-accordion">
         <?php if($rw->menu_image!='') {?> <img src="<?php echo base_url().'images/admin/mobile/mobile_menu/'.$rw->menu_image;?>" class="sbdCategoryIcon"> <?php } ?>
            <span class="menu-head"><?=$rw->label_name?> </span>
        </button>
            <div class="panel">
                <ul id="accordion" class="accordion" style="border:1px solid #ccc;">
          <?php foreach($q_arrow->result() as $res_arrow) {
              
               $qr=$this->db->query("select * from category_menu_mobile where parent_id='$res_arrow->dskmenu_lbl_id' AND order_by!=0 AND is_active='Yes' order by order_by "); 
               
              ?>     
         <!-----lifestyle menu------------------------->
         <li>
    <div class="link"> 
	<?php if($res_arrow->menu_image!='') {?>  <img src="<?php echo base_url().'images/admin/mobile/mobile_menu/'.$res_arrow->menu_image;?>" class="sbdCategoryIcon" height="28" width="28"> <?php } ?><?=$res_arrow->label_name ?>
    <i class="fa fa-chevron-down"></i></div>
    <ul class="lifestyle-submenu">
     <?php foreach($qr->result() as $rs){ ?>
      <li>
      <!---- This is for image box ---------->
      <?php if($rs->menu_image!=''){ ?>
      	<div class="pro-1" onclick="window.location.href='<?php echo base_url().'category/'.$rs->url_displayname ?>'">                   
            <img src="<?php echo base_url().'images/admin/mobile/mobile_menu/'.$rs->menu_image;?>" >
            <p><strong><?=$rs->label_name?></strong></p>
        </div>
        <?php }
			  else
			  {	
		 ?>
        <!---- This is for end image box ---------->
        
        <!---- This is for listing ---------->
        <div class="brands_products" style="clear: both;">
              <ul>              
                <li style="padding:7px; margin:auto; width:100%; border-bottom:1px solid #ccc; background: #fef9e7;">
                    <a style=" font-size:14px; padding:0;" href="<?php echo base_url().'category/'.$rs->url_displayname ?>"><?=$rs->label_name?></a>
                </li>                
              </ul>
        <div class="clearfix"></div>
       </div>
       <?php } ?>
        <!---- This is for listing ---------->            
      </li>
      <?php } ?>
    </ul>
  </li>
         
        <?php } // for loop end 
           
        ?>  </ul>  </div>   
<!--------------------------------- product list Child-menu End here------------------------------------>

<?php } // if condition is life style
else { 

/*$tot_2ndlvlcount=$q_arrow->num_rows();

$checktot_image2ndlvlarr=array();
 foreach($q_arrow->result() as $res_arrowimg) {
	if($res_arrowimg->menu_image!='')
	{$checktot_image2ndlvlarr[]=$res_arrowimg->menu_image;} 
 }
$tot_img2ndlvlcount=count($checktot_image2ndlvlarr);
if($tot_2ndlvlcount==$tot_img2ndlvlcount)
*/
?>    	
        <button class="first-accordion">
          <?php if($rw->menu_image!='') {?>  <img src="<?php echo base_url().'images/admin/mobile/mobile_menu/'.$rw->menu_image;?>" class="sbdCategoryIcon">
           <?php } ?>
            <span class="menu-head"><?php echo $rw->label_name; ?> </span>
        </button>
        <div class="panel">
            <ul>
            <?php foreach($q_arrow->result() as $res_arrow) { 
				   if($res_arrow->menu_image!=''){	
			?>               
                <li>
                    <div class="inn-single" onclick="window.location.href='<?php echo base_url().'category/'.$res_arrow->url_displayname ?>'">                  
                    <div class="pro-1">                   
                    <img src="<?php echo base_url().'images/admin/mobile/mobile_menu/'.$res_arrow->menu_image;?>" onclick="window.location.href='#'">
                    <p><strong><?=$res_arrow->label_name?></strong></p>
                    </div> 
                   </div>
                </li>
                <?php }else { ?>
                 
                    <div class="brands_products" style="clear: both;">
                          <ul>              
                            <li style="padding:7px; margin:auto; width:100%; border-bottom:1px solid #ccc;">
                                <a style=" font-size:14px;" href="<?php echo base_url().'category/'.$res_arrow->url_displayname ?>"><?=$res_arrow->label_name?></a>
                            </li>                
                          </ul>
                          
                          <div class="clearfix"></div>
                    </div>
    			
                
                
				<?php } // if image not avaliable condition end
				 } ?>
            </ul>
        </div>

<?php  } 
} // if category not life style end
?>
<!--------------------------------- product Box End here------------------------------------>


<!--------------------------------- product list Start here------------------------------------>
<!--<button class="first-accordion">
<img src="images/home-appliance.png" class="sbdCategoryIcon">
<span class="menu-head"> TV, Appliances, Electronics </span>
</button>
<div class="panel">
<ul>
    <li>
        <div class="brands_products">
              <ul>
              	<li>
                	<a href="#">TV, Appliances, Electronics </a>
                </li>
                <li style="padding:7px; margin:auto; width:100%; border-bottom:1px solid #ccc;">
                	<a style=" font-size:14px;" href="#">TV, Appliances, Electronics </a>
                </li>
                <li style="padding:7px; margin:auto; width:100%; border-bottom:1px solid #ccc;">
                	<a style=" font-size:14px;" href="#">TV, Appliances, Electronics </a>
                </li>
              </ul>
              
              <div class="clearfix"></div>
        </div>
    </li>
</ul>
</div>-->
<!--------------------------------- product list End here------------------------------------>


<!--------------------------------- product list Child-menu start here------------------------------------>

<!--<button class="first-accordion">
    <img src="images/mob-com.png" class="sbdCategoryIcon">
    <span class="menu-head">Mobiles, Computers </span>
</button>
    <div class="panel">
        <ul id="accordion" class="accordion">
  <li>
    <div class="link"><i class="fa fa-database"></i>Web Design<i class="fa fa-chevron-down"></i></div>
    <ul class="submenu">
      <li><a href="#">Photoshop</a></li>
      <li><a href="#">HTML</a></li>
      <li><a href="#">CSS</a></li>
    </ul>
  </li>
  <li>
    <div class="link"><i class="fa fa-code"></i>Coding<i class="fa fa-chevron-down"></i></div>
    <ul class="submenu">
      <li><a href="#">Javascript</a></li>
      <li><a href="#">jQuery</a></li>
      <li><a href="#">Ruby</a></li>
    </ul>
  </li>
  <li>
    <div class="link"><i class="fa fa-mobile"></i>Devices<i class="fa fa-chevron-down"></i></div>
    <ul class="submenu">
      <li><a href="#">Tablet</a></li>
      <li><a href="#">Mobile</a></li>
      <li><a href="#">Desktop</a></li>
    </ul>
  </li>
  <li>
    <div class="link"><i class="fa fa-globe"></i>Global<i class="fa fa-chevron-down"></i></div>
    <ul class="submenu">
      <li><a href="#">Google</a></li>
      <li><a href="#">Bing</a></li>
      <li><a href="#">Yahoo</a></li>
    </ul>
  </li>
</ul>
            
  			
      </div> -->
<!--------------------------------- product list Child-menu End here------------------------------------>
 <script>
    var acc = document.getElementsByClassName("first-accordion");
    var i;
    
    for (i = 0; i < acc.length; i++) {
      acc[i].onclick = function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight){
          panel.style.maxHeight = null;
        } else {
          panel.style.maxHeight = panel.scrollHeight + "120px";
        } 
      }
    }
    </script>	
<!--<div class="container-fluid">
<div class="left search_big1">
<form action="#" method="post">
<input type="search" name="Search" placeholder="Search for a Product..." required="">
<button type="submit" class="btn search right" ><i class="fa fa-search" aria-hidden="true"></i></button>
</form>
</div>
<div class="clearfix"> </div>
</div>-->  
 
<footer class="site-footer">

<div class="container-fluid">
<strong>Terms & Conditions :</strong>

<p class="para">We only accept payment in Indian currency ( INR) for all products purchased.Purchases are subjected to delivery charges as stated in the Cart at time of purchase.</p>
<strong>Shipping & Delivery :</strong>
      <p class="para"> Please allow at least 10-12 business days for your order to arrive after payment has been confirmed. If the product ordered is out of stocks, we will contact you immediately to confirm a new delivery date or other arrangements. Shipping through Reputed Couriers – Fedex/ DHL (Blue Dart)/ &nbsp;Professional/ DTDC / First Flight /Speed Post.</p>
      
        
        <div class="clearfix"> </div>
         
          <ul class="footer-li">
		   <li><a href="#">Cart</a></li>
           <li><a href="#">Your Moonboy.in</a></li>
           <li><a href="#">Your Subscribe & Save Items</a></li>
           <li><a href="#">Yours Orders</a></li>
           <li><a href="#">Amazone Pay</a></li>
           <li><a href="#">Wish List</a></li>
           <li><a href="#">Find a Wish List</a></li>
           <li><a href="#">Your Recently Viewed Items</a></li>
           <li><a href="#">Sell</a></li>
           <li><a href="#">Customer</a></li>
           <li><a href="#">Service Help</a></li>
          </ul>
          
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
<script>
$(function() {
	var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;

		// Variables privadas
		var links = this.el.find('.link');
		// Evento
		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	}

	Accordion.prototype.dropdown = function(e) {
		var $el = e.data.el;
			$this = $(this),
			$next = $this.next();

		$next.slideToggle();
		$this.parent().toggleClass('open');

		if (!e.data.multiple) {
			$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
		};
		if (!e.data.multiple) {
			$el.find('.lifestyle-submenu').not($next).slideUp().parent().removeClass('open');
		};
	}	

	var accordion = new Accordion($('#accordion'), false);
});

</script>
<script src="<?php echo base_url()?>mobile_css_js/new/js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url()?>mobile_css_js/new/js/scripts.js"></script>
</body>
</html>