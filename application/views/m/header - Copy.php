<?php 
		if($this->session->userdata('sesscoke')==false)
		{
			$this->load->library('session');
			$data= array();
			$this->session->set_userdata('sesscoke',$data);
		}
 ?>

<!DOCTYPE html>
<html lang="en"><head>
       <meta charset utf="8">
        <title>Welcome to moonboy </title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!--css-->
            <link rel="stylesheet" href="<?php echo base_url()?>mobile_css_js/new/css/font-awesome.min.css"> 
			<link href="<?php echo base_url()?>mobile_css_js/new/css/bootstrap.min.css" rel="stylesheet" type="text/css">
			<link href="<?php echo base_url()?>mobile_css_js/new/css/style.css" rel="stylesheet" type="text/css"/>
      <script src="<?php echo base_url()?>mobile_css_js/new/js/jssor.slider-23.1.6.min.js" type="text/javascript"></script>   
	 <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
	  <!-- <script type="text/javascript" src="<?php //echo base_url()?>mobile_css_js/new/js/dc_carousel_ver.js"></script> -->    
    <script src="<?php echo base_url()?>mobile_css_js/new/js/jquery.nicescroll.js"></script>
		<script src="<?php echo base_url()?>mobile_css_js/new/js/scripts.js"></script>

   
    
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
      width: 100%;
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
.log-in-out ul{
  display:block;
  list-style-type: none;
  text-align:center;
  
}
.log-in-out ul li{
	font-size: 14px;
    padding: 5px;
    width: 126px;
    /* margin: 2px auto 0px; */
    height: auto;
    /* background: #f7f7f7; */
    color: #777;
    /* border: 2px solid #dedede; */
    display: block;
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
    /* width: 200px; */
    display: block;
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
}
  </style> 
  
 <script>
$(document).ready(function(){
	$('#searchdiv2').css('display','none');
	$("#search-text").keyup(function(){
		$('#searchdiv2').css('display','block');
		var n=$('#search-text').val();
		
		$.ajax({
			url:'<?php echo base_url().'user/search_product' ?>',
			method:'post',
			data:{name:n},
			success:function(data,status)
			{
				if($('#search-text').val()!="")
				{
					$("#searchdiv2 ul").html(data);
				}
				else
				{
					$("#searchdiv2 ul").html("");
					$('#searchdiv2').css('display','none');
				}		
			}
		});
	});
	
	$(document).keyup(function(event){
        if(event.which === 27){
            $('#searchdiv2').hide();
        }
    });
	
});


function getuname(val){
	var x = val;
	$('#search-text').val(x);
	$('#searchdiv2').css('display','none');
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
        
        <div class="log-in-out"> 
                <ul>
                      <li><label for="dd" style="color:#0066c0;">
                      <i class="fa fa-user" aria-hidden="true"></i> 
        <span> <?php echo @$this->session->userdata['session_data']['fname'] ; ?> </span> 
                      </label>
                        <input type="checkbox" id="dd" hidden>
                            <ul class="dropdown">
                             <li><a href="<?php echo base_url(); ?>profile">Account</a></li>
                            <li><a href="<?php echo base_url(); ?>orders">Orders</a></li>
                            <!--<li><a href="#">Wallet</a></li>-->
                            <li><a href="<?php echo base_url(); ?>wish-list">Wishlist</a></li>
                            <li><a href="<?php echo base_url(); ?>review-rating">Reviews & Ratings</a></li>
                            <!--<li><a href="#">Email Preferences</a></li>-->
                            <li><a href="<?php echo base_url(); ?>change_password">Change Password</a></li>
                           
                              <li><a class="login" href="<?php echo base_url(); ?>user/logout">  Logout </a></li>
                            </ul>
                      </li>
                </ul>
                
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
            if(count(@$this->session->userdata('addtowishlist_tempsku'))!=0)
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
              <a href="<?php echo base_url().'shopby' ?>" ><span >Shop By</span> <!--Category--></a>
              <?php } ?>
              </li></a></li>
              </div>
              
             <!-----------------------------search item populate start------------------------->
            
            <div class="right search_big">
            	<?php
	   				$attributes = array('method'=>'get');
	  				 echo form_open('Product_description/product_search',$attributes);
	   			?>
					<input type="search" id="search-text"  name="search" placeholder="Search for a Product..." autocomplete="off" required>
					<button type="submit" class="btn btn-default search" aria-label="Left Align">
					<i class="fa fa-search" aria-hidden="true"> </i>
					</button>
                    
                   <!-- <div id="searchdiv2"><ul></ul></div>-->
				<?php echo form_close(); ?>
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


<!------------------------google analytics code start-------------------> 
<?php require_once('googleanalytics_jscode.php'); ?>
<!------------------------google analytics code end------------------->   
      