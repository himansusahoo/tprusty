<?php $this->db->cache_off();
		if($this->session->userdata('sesscoke')==false)
		{
			
			$data= array();
			$this->session->set_userdata('sesscoke',$data);
		}
 ?>

<!DOCTYPE html>
<html lang="en"><head>
       <meta charset utf="8">
        <!--<title>Welcome to moonboy </title>-->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!--css-->
            <link rel="stylesheet" href="<?php echo base_url()?>mobile_css_js/new/css/font-awesome.min.css"> 
			<link href="<?php echo base_url()?>mobile_css_js/new/css/bootstrap.min.css" rel="stylesheet" type="text/css">
			<link href="<?php echo base_url()?>mobile_css_js/new/css/style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" rel="stylesheet" type="text/css"/>
      <script src="<?php echo base_url()?>mobile_css_js/new/js/jssor.slider-23.1.6.min.js" type="text/javascript"></script>   
	 <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
	  <!-- <script type="text/javascript" src="<?php //echo base_url()?>mobile_css_js/new/js/dc_carousel_ver.js"></script> -->    
    <script src="<?php echo base_url()?>mobile_css_js/new/js/jquery.nicescroll.js"></script>
		<script src="<?php echo base_url()?>mobile_css_js/new/js/scripts.js"></script>

   <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script> var logintobuysku='';  </script>
<script>
function myFunction(x) 
{
    x.classList.toggle("fa-minus");
}
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
             
 <link rel="stylesheet" href="<?php echo base_url()?>mobile_css_js/new/css/slick.css"> 
 <link rel="stylesheet" href="<?php echo base_url()?>mobile_css_js/new/css/slick-theme.css"> 
  <style type="text/css">
    .slider {
        width: 80%;
        margin: 1px auto 0;
		padding:5px 0;
		
    }

    .slick-slide {
      margin: 0px 5px;
    }

    .slick-slide img {
	  margin:auto;
    }
	.multiple.slick-slide
	{
		padding: 5px;
		height:230px;
	}

    .slick-prev:before,
    .slick-next:before {
        color: black;
		background: #fff;
    padding: 1px 5px;
    border-radius: 50%;
    }
/*.log-in-out ul{
  display:block;
  list-style-type: none;
  text-align:center;
  
}*/
/*.log-in-out ul li{
	font-size: 14px;
    padding: 5px;
    width: 126px;*/
    /* margin: 2px auto 0px; */
/*    height: auto;
*/    /* background: #f7f7f7; */
/*    color: #777;
*/    /* border: 2px solid #dedede; */
/*    display: block;
    display: inline-block;
    color: white;
    font-family: sans-serif;
    font-weight: 800;
    position: relative;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
. log-in-out ul li:hover{
  background: #f9a1c6;
  color: #000;
}
.log-in-out ul li .dropdown{
  display:none;
  width: 100%;
  padding:0; margin:0;
  background: green;
  position: absolute;
  top: 45px;
  left:0;
}
.log-in-out ul li .dropdown li {
*/    /* width: 200px; */
/*    display: block;
    padding: 2px 0px;
    margin: 0px;
    color: #0066c0;
    font-weight: normal;
    border: none;
    font-size: 12px;
    border-bottom: 1px solid #eed496;


}
#dd:checked ~ .dropdown{
  display:block;
  margin-top: -10px;
  background:#fff;
  border:1px solid #ccc;
  z-index: 9999;
}	
.log-in-out ul {
    display: block;
    list-style-type: none;
    text-align: center;
    padding-bottom: 0;
    margin-bottom: -37px;
	margin-top: -27px;
	margin-left: 0px;
}*/
.dropbtn {
    background-color: #fff;
    color: #000;
    padding: 0px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}



.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 128px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    padding: 4px 16px;
    text-decoration: none;
    display: block;
	text-align: center;
	border-bottom: 1px solid #e4d289;
}

.dropdown a:hover {background-color: #f1f1f1}

.show {display:block;}
  </style> 
  
 <script>
$(document).ready(function(){
	//$('#searchdiv2').css('display','none');
	$('#searchdiv2').css('display','none');
 	var timer = null;
	$.fn.delayKeyup = function(callback, ms){
     var timer = 0;
     var el = $(this);
     $(this).keyup(function(){                   
         clearTimeout (timer);
         timer = setTimeout(function(){
             callback(el)
                 }, ms);
     });
     return $(this);
 };

$('#search-text').delayKeyup(function(el){
        /*alert(el.val());*/
		mysearch();
},300);
	
	
	$(document).keyup(function(event){
        if(event.which === 27 || event.which === 8 || event.which === 46){
            $('#searchdiv2').hide();
        }
    });
	
});

function mysearch (){
	
		//$('#searchdiv2').css('display','block');
		var n=$('#search-text').val();
		
		$.ajax({
			url:'<?php echo base_url().'user/search_product' ?>',
			method:'post',
			data:{name:n},
			success:function(data,status)
			{
				if($('#search-text').val()!="")
				{	$('#searchdiv2').css('display','block');
					$("#searchdiv2 ul").html(data);
				}
				else
				{
					$("#searchdiv2 ul").html("");
					$('#searchdiv2').css('display','none');
				}		
			}
		});
	
	
}


function getuname(val){
	var x = val;
	$('#search-text').val(x);
	$('#searchdiv2').css('display','none');
}
    
</script>
<script>
$(window).scroll(function() {

    if ($(this).scrollTop()>0)
     {
        $('.dropdown-content').hide();
     }
    else
     {
      $('.dropdown-content').hide();
     }
 });
</script>
<script>
  		 function search_url()
		 {
			 var val = $('#search-text').val();
			 if(val!="")
			 {
				//window.location.href='<?php //echo base_url().'search-by/'?>'+val ; 
				window.location.href='<?php echo base_url(); ?>Product_description/suggestword?search_title='+val ;
			 }
			 
		 }
    
	
	
    </script>            
            
    </head>
<body>
<div class="body-back">
        	<div class="masthead pdng-stn1">
		<!-- Header Bar-->
			<div class="menu-notify">
				<div class="profile-left left">
					<h5 class="pro-link"> <a href="<?php echo base_url() ?>"><img src="<?php echo base_url()?>mobile_css_js/new/images/logo.png" width="150" height="55" alt=""  class="img-responsive"> </a></h5>
				</div>
				
<div class="profile-right">
        <ul>
        <!--------------------------user account login start------------------------>
            <li>
        		<?php if(@$this->session->userdata('session_data')){ ?>
        		<div class="dropdown">
<button onclick="myFunction()" class="dropbtn">
    <i class="fa fa-user" aria-hidden="true"></i>
    <?php echo @$this->session->userdata['session_data']['fname'] ; ?>
</button>
  <div id="myDropdown" class="dropdown-content">
    <a href="<?php echo base_url(); ?>profile">Account</a>
    <a href="<?php echo base_url(); ?>orders">Orders</a>
    <a href="<?php echo base_url(); ?>wish-list">Wishlist</a>
    <a href="<?php echo base_url(); ?>review-rating">Reviews & Ratings</a>
    <a href="<?php echo base_url(); ?>change_password">Change Password</a>
    <a href="<?php echo base_url(); ?>user/logout">Logout</a>

  </div>
</div>
         <?php }else{ ?>
         <a href="<?php echo base_url().'user/m_login' ?>" class="logout"><i class="fa fa-user" aria-hidden="true"></i> Account</a>
         <?php } ?>
            </li>
        
        <!--------------------------user account login end------------------------>
        
        
        <!--------------------------wishlist start------------------------>
        <li>  
        <?php if(@$this->session->userdata['session_data']['user_id']==""){ ?>
        <a style="margin-right: 15px;" href="<?php if(@$this->session->userdata['session_data']['user_id']!=""){ echo base_url().'user/wishlist'; }else {  echo base_url().'user/m_login';} ?>" title="your Wishlist!" class="top-wshlst" >
        
        <i class="fa fa-heart"></i>
         <div  class="total"> 
        <span id="simpleCart_quantity" class="simpleCart_quantity">
            <?php $user_id=@$this->session->userdata['session_data']['user_id'];
            
            $query = $this->db->query("SELECT * from wishlist where user_id='$user_id'");
            $wishlist_row = $query->num_rows(); 
            
            if($wishlist_row!=0){
                echo @$wishlist_row; 
            }
            else{
                echo  "0";
            }
            ?>                    
                
            <?php  if(@$this->session->userdata['session_data']['user_id']==""){ ?>
            
           
            
             
            <?php
            if(@count(@$this->session->userdata('addtowishlist_tempsku'))!=0)
            {
                echo @count($this->session->userdata['addtowishlist_tempsku']);
            }
             } ?>
       </span></div>
            </a>
         <?php } ?>   
        </li>
       
       <!--------------------------wishlist end------------------------>
       
       <!--------------------------Mycart Start------------------------>
       <li>  <a style="margin-right: 10px;" href="<?php echo base_url().'mycart/mycart_detail'; ?>" class="cart">
                 <div class="total"> 
                     <span id="simpleCart_quantity" class="simpleCart_quantity">
                     
                     <?php if(@$this->session->userdata('addtocarttemp_session_id')!="" && @$this->session->userdata['session_data']['user_id']==""){
                        
            $addtocart_arr=$this->session->userdata('addtocart_sku');
            $ct1=count($addtocart_arr);
            echo @$ct1. " "; 		
             ?> <?php }
             elseif(@$this->session->userdata('addtocarttemp_session_id')!="" && @$this->session->userdata['session_data']['user_id']!="")
            { 
                                  
             $ids=$this->session->userdata('addtocarttemp_session_id');
             $user_id=$this->session->userdata['session_data']['user_id'];
            $qr=$this->db->query("select * from addtocart_temp where user_id='$user_id' ");
            $ct=$qr->num_rows();
                                
            if($ct!=0)
            {					
            echo @$ct. " ";
            }
            else
            {
                echo "0 ";
            }
        ?>                     
             <?php }
             elseif(@$this->session->userdata('addtocarttemp_session_id')=="" && @$this->session->userdata['session_data']['user_id']=="")
            { ?>
            0 
            <?php } elseif(@$this->session->userdata('addtocarttemp_session_id')=="" && @$this->session->userdata['session_data']['user_id']!="")
            {
                 $ids=$this->session->userdata('addtocarttemp_session_id');
                $user_id=$this->session->userdata['session_data']['user_id'];
                $qr=$this->db->query("select * from addtocart_temp where user_id='$user_id' ");
                $ct=$qr->num_rows();
            if($ct!=0)
            {					
            echo @$ct. " ";
            }
            else
            {
                echo "0 ";
                }
                
                 ?>
         
            <?php } ?>
                     
                     </span> </div>
                <i class="fa fa-shopping-cart"></i> </h3>
            </a>
        </li>
       <!--------------------------Mycart end------------------------>  
        
            </ul>
                  
					
</div>
                
				<div class="clearfix"></div>
                    
              <div class="menu left"><li style="list-style-type:none">
              <?php if($this->uri->segment(1)=='shopby') {?>
                <a href="#"  onClick="previous_visitedpage()"><span style="color:#F93; font-weight:bold; font-size:18px;"><i style="color:#F93;" class="fa fa-arrow-left" aria-hidden="true"></i><!--Back--></span></a>
              <?php }else{ ?>
             <a href="<?php echo base_url().'shopby' ?>" ><span><img src="<?php echo base_url();?>/images/catagory.png" width="100%"> <!--<span class="fa fa-caret-down" style="font-size:30px!important; margin-left:-7px !important;vertical-align: middle;color:red"></span>--></span> <!--Category--></a>
              <?php } ?>
              </li></a></li>
              </div>
              
             <!-----------------------------search item populate start------------------------->
            
            <div class="right search_big">
            	<?php /*?><?php
	   				$attributes = array('method'=>'get');
	  				 echo form_open('Product_description/product_search',$attributes);
	   			?><?php */?>
					<input type="search" id="search-text" onKeyDown="if(event.keyCode==13) search_url();" name="search" placeholder="Search for a Product..." autocomplete="off" required>
					<button type="button" onClick="search_url()" class="btn btn-default search" aria-label="Left Align">
					<i class="fa fa-search" aria-hidden="true"> </i>
					</button>
                    
                    <div id="searchdiv2" style="display:none;"><ul></ul></div>
				<?php /*?><?php echo form_close(); ?><?php */?>
            </div>
            
            <!------------------------------search item populate end-------------------------->
             
              
            
            
              <div class="clearfix"></div>  
 </div>             
            </div>
            
            
            
  </div>          
        <!-- Header Bar--> 
         <div class="clearfix"></div>
<script>
function previous_visitedpage()
{
	var referrer =  document.referrer;
	window.location.href=referrer;
}

</script> 

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}


</script>

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function shortFunction() {
    document.getElementById("shortDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

</script>
<!------------------------google analytics code start-------------------> 
<?php require_once('googleanalytics_jscode.php'); ?>
<!------------------------google analytics code end------------------->

