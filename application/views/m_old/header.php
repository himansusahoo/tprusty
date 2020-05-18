
<?php 
		if($this->session->userdata('sesscoke')==false)
		{
			$this->load->library('session');
			$data= array();
			$this->session->set_userdata('sesscoke',$data);
		}
 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <title>Welcome to moonboy </title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta charset utf="8" >
		<meta name="yandex-verification" content="d52dd7abecd04cda" />
        <!--custom css-->
           <link rel="stylesheet" href="<?php echo base_url().'mobile_css_js/' ?>css/font-awesome.min.css" /> 
		   <link href="<?php echo base_url().'mobile_css_js/' ?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
		   <link href="<?php echo base_url().'mobile_css_js/' ?>css/style.css" rel="stylesheet" type="text/css"/>
                        
			 <!--script-->
            <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> 
			<script src="<?php echo base_url().'mobile_css_js/' ?>js/bootstrap.min.js"></script>
            <script src="<?php echo base_url().'mobile_css_js/' ?>js/bigSlide.js"></script>
            <script>
				$(document).ready(function() {
				$('.menu-link').bigSlide();
				});
            </script>
            
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

            
            <!--script-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'mobile_css_js/' ?>css/easy-responsive-tabs.css " />
    <script src="<?php echo base_url().'mobile_css_js/' ?>js/easyResponsiveTabs.js"></script>
    
    
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-69461190-1', 'auto');
  ga('send', 'pageview');

</script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5KGFZ4');</script>
<!-- End Google Tag Manager -->
			
	
    </head>
<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5KGFZ4"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


<div class="body-back">

        	<div class="masthead pdng-stn1">
		<!-- Header Bar-->
			<div class="menu-notify">
				<div class="profile-left">
					<ul>

                    <li> <a href="#menu" class="menu-link"><i class="fa fa-list-ul"></i></a> </li>   
                    <li> <a href="#" class="search" onclick="showhide()"> <i class="fa fa-search" aria-hidden="true"></i> </a> </li>
                    </ul>
				</div>
				<div class="profile-mid">
					<h5 class="pro-link"> <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url().'mobile_css_js/' ?>images/logo.png" width="196" height="47" alt=""  class="img-responsive"> </a></h5>
			  </div>
				<div class="profile-right">
                <ul>
                <li>  <!--<a href="#"><i class="fa fa-heart" aria-hidden="true"></i> </a> -->
                
                
                <a href="<?php if(@$this->session->userdata['session_data']['user_id']!=""){ echo base_url().'user/wishlist'; }else {  echo base_url().'user/m_login';} ?>" title="your Wishlist!" class="top-wshlst" >
                
                <!--<a href="#" title="your Wishlist!" class="top-wshlst" >-->
                
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
			    </li>  
                <!--------------------Cart Deatial----------------------------------------------->
       
       
       <li> <?php /*?><a href="<?php if(@$this->session->userdata['session_data']['user_id']!=""){ echo base_url().'mycart/mycart_detail'; }else {echo base_url().'mycart/guest_cart_detail'; } ?>" title="Show my cart" class="cart"><?php */?> 
       
       
       <a href="<?php echo base_url().'mycart/mycart_detail'; ?>" title="Show my cart" class="cart">
       
        
              <div  class="total"> 
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
                     </span>                    
                     </div> 
                     <i class="fa fa-shopping-cart"></i>
                     </h3>
                    </a>
       
       <!------------------------------------------Cart Deatil----------------------------------------------->             
                    
				</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
            
             <div class="search-bar" id="searchbar">
             <?php
	   $attributes = array('method'=>'get');
	   echo form_open('Product_description/product_search',$attributes);
	   ?>
          <div class="search-bar-l">
            <button type="submit" class="search-bar-submit"> <span class="fa fa-search" aria-hidden="true"></span>  </button>
          </div>
          <div class="search-bar-m">
            <!--<input type="search" id="SearchInput" name="q" value="" placeholder="Search our store" aria-label="Search our store" class="search-bar-input">-->
             <input type="search" id="search-text" name="search"  placeholder="Search our store" aria-label="Search our store" class="search-bar-input" autocomplete="off">
              <div id="searchdiv2"><ul>        </ul></div>
          </div>
          </form>
          <div class="search-bar-r">
        <button type="button" class="search-bar-close" onclick="hide()"> <i class="fa fa-times" aria-hidden="true"> </i> </button>
         </div>
          </div>
				
				
					<div class="clearfixfix"></div>
				</div>
        <!-- Header Bar-->