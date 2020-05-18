<!DOCTYPE html>
<html lang="en">
<head>

	<?php 
		if($this->session->userdata('sesscoke')==false)
		{
			$this->load->library('session');
			 $data= array();
			$this->session->set_userdata('sesscoke',$data);
		}
 	?>
    <link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url();?>new_css/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>new_css/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="<?php echo base_url();?>new_js/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>new_js/js/jssor.slider-23.1.6.min.js"></script>
    <script>
	$(document).ready(function(){
		$('#itemslider').carousel({ interval: 9000 });

			$('.carousel-showmanymoveone .item').each(function(){
			var itemToClone = $(this);
			
			for (var i=1;i<6;i++) {
			itemToClone = itemToClone.next();
			
			if (!itemToClone.length) {
			itemToClone = $(this).siblings(':first');
			}
			
			itemToClone.children(':first-child').clone()
			.addClass("cloneditem-"+(i))
			.appendTo($(this));
			}
		});
	});
    </script>
	
	<script>
		$(document).ready(function(){
			$(".inline").colorbox({inline:true, width:"25%", height:"447px"});
			$(".inline2").colorbox({inline:true, width:"35%"});
		});
	</script>
    <script>
		$(document).ready(function(){
			$('#exixtingusertomoonboy').css('display','none');
			
			$('#e_user').click(function(){
				$('#exixtingusertomoonboy').css('display','none');
				$('#pass_dv1').slideUp();
				$('#pass_dv2').slideDown();
				$('#in_up').val('Login');
				$('#newtomoonboy').css('display','block');
			});
			
			$('#n_user').click(function(){
				$('#newtomoonboy').css('display','none');
				$('#pass_dv1').slideDown();
				$('#pass_dv2').slideUp();
				$('#in_up').val('Sign Up');
				$('#exixtingusertomoonboy').css('display','block');
			});
			
			
		});
	</script>
    <script>
		var logintobuysku='';
		function logSignupFunction(pname){
			//alert(pname);return false;
			//alert(logintobuysku);
			var mail_id = $('#mail_id').val();
			var pattern = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			
			if($("#n_user").is(":checked")){
				var user = 'new_user';
			}
			if($("#e_user").is(":checked")){
				var user = 'ext_user';
			}
			
			if(mail_id == ''){
				alert('please enter your email address.');
				$('#mail_id').focus();
				return false;
			}else if(!pattern.test(mail_id)) {
				alert('Please provide a valid email address');
				$('#mail_id').select();
				return false;
			}else{
				///////script start for NEW USER/////////
				if(user == 'new_user'){
					var pass = $('#npass').val();
					var cpass = $('#ncpass').val();
					if(pass == ''){
						alert('Please enter password');
						$('#npass').focus();
						return false;
					}else if(cpass == ''){
						alert('Please re-enter password');
						$('#ncpass').focus();
						return false;
					}else if(pass != cpass){
						alert('Password mismatch');
						$('#ncpass').select();
						return false;
					}else{
						
						$('#in_up').val('Processing...');
						$.ajax({
							url:'<?php echo base_url(); ?>user/login',
							method:'post',
							data:{email:mail_id,password:pass,flag:1},
							success:function(result)
							{
								//$(".error_msg").html(result);
								if(result == 'exists'){
									$(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>This email address is already exists');
									$(".error_msg").slideDown();
									$('#in_up').val('login');
								}
								if(result == 'success' && logintobuysku!=''){
									window.location.href="<?php echo base_url().'mycart/checkout_process';?>";
								}
								if(result == 'success' && logintobuysku==''){
								//else{
									/*$(".error_msg").html(result);
									$(".error_msg").fadeIn(500);*/
									window.location.reload(true);
								}
							}
						});
						
					}
				}
				///////script end of NEW USER/////////
				
				///////script start for Exiting USER/////////
				if(user == 'ext_user'){
					var pass = $('#epass').val();
					if(pass == ''){
						alert('please enter your password.');
						$('#epass').focus();
						return false;
					}else{
						
						$('#in_up').val('Processing...');
						$.ajax({
							url:'<?php echo base_url(); ?>user/login',
							method:'post',
							data:{email:mail_id,password:pass,flag:2},
							success:function(result)
							{
								/*$(".error_msg").html(result);
								$(".error_msg").fadeIn(500);*/
								if(result == 'blocked'){
									$(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>This user is already blocked');
									$(".error_msg").slideDown(200);
									$('#in_up').val('Login');
								}
								if(result == 'invalid'){
									$(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>Invalid Username or Password');
									$(".error_msg").slideDown(200);
									$('#in_up').val('Login');
								}
								if(result == 'success' && logintobuysku==''){
									//$(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>ssccdd');
									window.location.reload(true);
								}
								if(result == 'success'  && logintobuysku!=''){
									
									window.location.href="<?php echo base_url().'mycart/checkout_process';?>"							
								}
							}
						});
						
					}
				}
				///////script end of Exiting USER/////////
			}
		//});
	//});
	}
	</script>
    <script>
			$(document).ready(function(){
				$('.forgot_p').click(function(){
					$('#reg_login_dv').slideUp();
					$('#forgot_dv').slideDown();
					$('.sn').slideUp();
					$('.forgt').slideDown();
					$('#social_tbl').hide();
				});
				
				$('#forgt_btn').click(function(){
					var mail_id = $('#mail').val();
					var pattern = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					if(mail_id == ''){
						alert('Please enter your email address');
						$('#mail').focus();
						return false;
					}else if(!pattern.test(mail_id)) {
    					alert('Please provide a valid email address');
						$('#mail').select();
    					return false;
					}else{
						$('#forgt_btn').val('Processing...');
						$.ajax({
							url:'<?php echo base_url(); ?>user/forgot_password',
							method:'post',
							data:{email:mail_id},
							success:function(result)
							{

							  if(result == 'not_exist'){
								  $(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>This email address is not exist');
								  $(".error_msg").slideDown(300);
								  $('#forgt_btn').val('Continue');
							  }
							  if(result == 'mail_sent'){
								  $(".error_msg").html('<i class="fa fa-info-circle"></i>Check your email and enter that OTP to reset your password.'
);
								  $(".error_msg").css({"background-color":"#bde5f8","border":"1px solid #8598e1","text-align":"left","color":"#00529b"});
							  	  $(".error_msg").slideDown(300);
								  $('#forgot_dv').slideUp();
								  $('#otp_pass_dv').slideDown();
							  }
							  
							}
						});
					}
					
				});
				
			});

		///////OTP Verification start here////////
		function checkOtp(){
			var otp = $('#otp').val();
			if(otp == ''){
				alert('Please enter your OTP');
				$('#otp').focus();
				return false;
			}else{
				
				$('#otp_btn').val('Processing...');
				$.ajax({
					url:'<?php echo base_url(); ?>user/check_otp_forgot_password',
					method:'post',
					data:{otp:otp},
					success:function(result)
					{
						if(result === 'not_exist'){
							$(".error_msg").css({'background-color':'pink','border':'1px solid salmon','color':'#790606'});
							$(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>This OTP is not matched.');
							$('#otp_btn').val('Continue');
						}
						else{
							$('#chng_email').val(result);
							$(".error_msg").slideUp();
							$('#otp_pass_dv').slideUp();
							$('#chng_pass_dv').slideDown();
						}
					}
				});
				
			}
		}
		///////OTP Verification end here////////
		
		///////Change password script start here////////
		function changedPassword(){
		var email = $('#chng_email').val();
		var psss = $('#new_pass').val();
		var cpsss = $('#cnew_pass').val();
		if(psss == ''){
			alert('Enter your new password');
			$('#new_pass').focus();
			return false;
		}else if(cpsss == ''){
			alert('Enter your confirm password');
			$('#cnew_pass').focus();
			return false;
		}else if(psss != cpsss){
			alert('Password mismatch.');
			$('#cnew_pass').select();
			return false;
		}else{
			
			$('#chng_btn').val('Processing...');
			$.ajax({
				url:'<?php echo base_url(); ?>user/change_forgot_password',
				method:'post',
				data:{email:email,pass:psss},
				success:function(result)
				{
					if(result === 'not'){
						$(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>Password not changed');
						$('#chng_btn').val('Change Password');
					}
					if(result == 'ok'){
						window.location.reload(true);
					}
				}
			});
			
		}
	}
	///////Change password script end here////////	
	</script>
    <script>
			function OverFunction(){
				$("#profile_menu").show();
			}
			
			function OutFunction(){
				$("#profile_menu").hide();
			}
			
			function OverFunction1(){
				$("#profile_menu_mob").show();
			}
			
			function OutFunction1(){
				$("#profile_menu_mob").hide();
			}
	</script>
    <!--  Google Analytics Code Start-->
    <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-69461190-1', 'auto');
	  ga('send', 'pageview');

	</script>
    <!--  Google Analytics Code End-->
    
    <!-- Facebook Pixel Code Start-->
    <script>
		!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
		n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
		document,'script','https://connect.facebook.net/en_US/fbevents.js');
		
		fbq('init', '1673583359625937');
		fbq('track', "PageView");
    </script>
    <noscript> 
    	<img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1673583359625937&ev=PageView&noscript=1" 
        alt="facebook" />
	</noscript>
    <!-- End Facebook Pixel Code -->
    
    <!-- Google Tag Manager -->
    <noscript> 
    	<iframe src="//www.googletagmanager.com/ns.html?id=GTM-N68WW2" height="0" width="0" style="display:none;visibility:hidden">
		</iframe> 
    </noscript>
    <script>
		(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-N68WW2');
    </script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.tinycarousel.js"   ></script>
	<script type="text/javascript">
		$(document).ready(function()
		{
			$('#slider1').tinycarousel({ interval: true });
			$('#slider2').tinycarousel({ interval: true });
			$('#slider3').tinycarousel({ interval: true });
		});
		
	</script>
	<style>
		 /* carousel */
		.media-carousel 
		{
		  margin-bottom: 0;
		  padding: 0 40px 0px 40px;
		}
		/* Previous button  */
		.media-carousel .carousel-control.left 
		{
		  
			  background-image: none;
			background: none;
			border: 2px solid #ccc;
			border-radius: 50%;
			height: 30px;
			width: 30px;
			margin-top: 20px;
			color: #ccc;
			padding-top: 0;
			font-size: 31px;
			line-height: 21px;
			text-shadow: none;
		  
		}
		/* Next button  */
		.media-carousel .carousel-control.right 
		{
		  
			background-image: none;
			background: none;
			border: 2px solid #ccc;
			border-radius: 50%;
			height: 30px;
			width: 30px;
			margin-top: 20px;
			color: #ccc;
			padding-top: 0;
			font-size: 31px;
			line-height: 21px;
			text-shadow: none;
		}
		/* Changes the position of the indicators */
		.media-carousel .carousel-indicators 
		{
		  right: 50%;
		  top: auto;
		  bottom: 0px;
		  margin-right: -19px;
		}
		/* Changes the colour of the indicators */
		.media-carousel .carousel-indicators li 
		{
		  background: #c0c0c0;
		}
		.media-carousel .carousel-indicators .active 
		{
		  background: #333333;
		}
		
		.thumbnail{ margin-bottom:0;}
		/* End carousel */
	</style> 
</head>
<body>
<!----------------------------------------Header Section start------------------------------------------------------>
	<div class="site-branding">
        <!------------------------- Logo Section  Start-------------------------------------->
        <div class="logo">
                <a href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url();?>images/logo.png" alt="moonboy" width="100%">
                </a>
         </div>
         <!------------------------- Logo Section  End-------------------------------------------------------------->
             
         <!------------------------- Categories Section  Start------------------------------------------------------>
         <?php
             $qrs=$this->db->query("select * from category_menu_desktop where parent_id=0 AND order_by!=0 
                                    AND is_active='Yes' order by order_by");
         ?>
         <div class="nav-left">
              <ul class="menu-cat">
                    <li> <a href="#" class="triger"> All Categories  <i class="fa fa-angle-down"></i> </a>
                   <!-- <div class="menu-cont">-->
                         <ul class="mainCat">
                            <?php foreach($qrs->result() as $rw ) {?>
                            <li class="slink">  <h1 class="catgry-name"><?php echo $rw->label_name; ?> 
                                <?php 
                                    $q_arrow=$this->db->query("select * from category_menu_desktop where 
                                            parent_id='$rw->dskmenu_lbl_id' AND order_by!=0 AND is_active='Yes' order by order_by ");
                                    $ct_arrow=$q_arrow->num_rows();
                                    if($ct_arrow>0){
                                ?>
                                <?php
                                    }
                                ?>
                                <!--1st level-->
                                <i class="fa fa-angle-right"></i> </h1>
                                 <div class="menuItems" onmouseover="ShowMenuDiv()" onmouseout="NormalMenuDiv()">  
                                     <ul class="sub-category grid" data-masonry="{ &quot;columnWidth&quot;: 0 }">
                                      <?php 
                                        $qr=$this->db->query("select * from category_menu_desktop where 
                                        parent_id='$rw->dskmenu_lbl_id' AND order_by!=0 AND is_active='Yes' order by order_by ");
                                        $ct=$qr->num_rows();
                                        if($ct>0){
                                        foreach($qr->result() as $rs){
                                      ?>
                                                                        
                                    <li class="grid-item">
                                        <a href="<?php echo base_url().'category-demo/'.$rs->url_displayname ?>">
                                             <h1 class="catgry-name"><?php echo $rs->label_name;?>
                                                <?php 
                                                     $q_arrow1=$this->db->query("select * from category_menu_desktop where 
                                                     parent_id='$rs->dskmenu_lbl_id' AND order_by!=0 AND is_active='Yes' order by order_by ");
                                                     $ct_arrow1=$q_arrow1->num_rows();
                                                     if($ct_arrow1>0){
                                                ?>
                                                <?php }?>
                                             </h1>
                                        </a>
                                            <div class="sub-menuitems">
                                                 <ul>
                                                    <?php 
                                                        $qr1=$this->db->query("select * from category_menu_desktop where 
                                                            parent_id='$rs->dskmenu_lbl_id' AND order_by!=0 AND is_active='Yes' 
                                                            AND category_id!='' order by order_by ");
                                                            $ct1=$qr1->num_rows();
                                                            if($ct1>0){ 
                                                            foreach($qr1->result() as $rs1){
                                                    ?>
                                                    <li> <!--<a href="">-->
                                                        <a href="<?php echo base_url().$rs1->url_displayname?>"><?php echo	$rs1->label_name;?>
                                                        <?php 
                                                            $q_arrow2=$this->db->query("select * from category_menu_desktop 
                                                                where parent_id='$rs1->dskmenu_lbl_id' AND order_by!=0 
                                                                AND is_active='Yes' order by order_by ");
                                                            $ct_arrow2=$q_arrow2->num_rows();
                                                            if($ct_arrow2>0){
                                                        ?>
                                                        <?php } ?>
                                                        </a>
                                                    </li>
                                                    <?php }?>
                                                <?php }?>
                                            </ul>
                                        </div>
                                    </li>
                                <?php }?>
                        <?php }?>
                    </ul>
                </div>
           </li>
           <?php }?>
       </ul>
  </li> 
</ul> 
</div>
	<!------------------------- Categories Section  End--------------------------------------------------------->
 
	<!-------------------------------------------Search bar----------------------------------------------------->
 
 <div class="nav-middle"> 
        <div class="search">
        <?php
		   $attributes = array('method'=>'get');
		   echo form_open_multipart('Product_description_search/product_search',$attributes);
	   ?>       
        <input type="text" id="search-text" name="search" placeholder="Search Your Product" autocomplete="off" required > 
        	<div id="searchdiv2"><ul></ul></div>
        <button class="search-btn" value="" type="submit" id="btn-search"> <i class="fa fa-search"></i> </button>
        </form>
        </div> 
 </div>
 
 <!-------------------------------------add to cart ----------------------------------------------------------->
 
<div class="nav-right">
    <ul>
        <?php if($this->session->userdata('session_data')){ ?>
		<li class="log-in" onMouseOver="OverFunction()" onMouseOut="OutFunction()"> <a href="#">Hello 
             	<span class="orange"><?php echo $this->session->userdata['session_data']['fname'] ; ?> </span> </a>
             	<div id="profile_menu">
                    <ul>
                        <li><a href="<?php echo base_url(); ?>profile">Account</a></li>
                        <li><a href="<?php echo base_url(); ?>orders">Orders</a></li>
                        <!--<li><a href="#">Wallet</a></li>-->
                        <li><a href="<?php echo base_url(); ?>wish-list">Wishlist</a></li>
                        <li><a href="<?php echo base_url(); ?>review-rating">Reviews & Ratings</a></li>
                        <!--<li><a href="#">Email Preferences</a></li>-->
                        <li><a href="<?php echo base_url(); ?>change_password">Change Password</a></li>
                        <li><a href="<?php echo base_url(); ?>user/logout">Logout</a></li>
                    </ul>
                 </div>
             </li>
             <?php }else{ ?>
        <li class="log-in" ><a class="inline" href="#inline_content"> Log In </a></li>
             <?php } ?>
        <li class="wlist-top">
        	<a href="#" class=" wlist-top"="" onclick="addWishlistFunction()"> </a>
        	<a class="inline cboxElement" href="#inline_content" title="your Wishlist!"><i class="fa fa-heart-o"></i> </a>
        </li>
        <li class="cart-top" onmouseover="OverFunction_cart()" onmouseout="OutFunction_cart()"> 
        	<a href="https://www.moonboy.in/mycart/mycart_detail" title="Show my cart"><i class="fa fa-shopping-cart"></i> </a>
        </li>
        <?php if($this->session->userdata('session_data')){ ?>
        <li class="track"> 
        	<a href="<?php echo base_url(); ?>orders"><i class="fa fa-map-marker"></i> Track Your Order</a>
        </li>
        <?php } else {?>
        <li class="track"> 
        	<a href="#"><i class="fa fa-map-marker"></i> Track Your Order</a>
        </li>
        <?php }?>
        <li class="customer"> 
        	<a href="<?php echo base_url();?>contact-us"> Customer Support </a> 
        </li>
        <li style="margin-top:13px;">  
        	<a class="blog" href="https://www.moonboy.in/blog/" target="_blank"> Our Blog </a>
        </li>
    </ul>
</div>

<!--------------------------------------------------------Log In Section Start---------------------------------------->
<div style="display:none">
	<div id="inline_content">
      	<div class="sign_in_dv">
		<div class="error_msg"></div>
        <div class="col-md-12" style="padding:0px;" >
        <div id="reg_login_dv">
        <table class="big-table" >
          <tr>
            <td><input type="text" class="input-text" id="mail_id" Placeholder="Enter email address"></td>
          </tr>
          <tr>
            <td>
                <div id="pass_dv1">
                    <input type="password" name="npass" id="npass" class="input-text" Placeholder="Enter password">
                    <input type="password" name="ncpass" id="ncpass" class="input-text" Placeholder="Re-enter password" 
                    	onKeyDown="if (event.keyCode == 13) document.getElementById('in_up').click()">
                </div>
                <div id="pass_dv2">
                    <input type="password" name="epass" id="epass" class="input-text" Placeholder="Enter password"  
                    	onkeydown="if (event.keyCode == 13) document.getElementById('in_up').click()">
                    <p class="forgot_p">Forgot Password</p>
                </div>
            </td>
          </tr>
          <tr>
            <td>
            <?php
            if($this->session->userdata('pre_session_id')){
                $pname =  preg_replace('#"#','-',preg_replace('#/#','-',str_replace(' ','-',strtolower($this->session->userdata['pre_session_id']['product_name'])))).'/'.$this->session->userdata['pre_session_id']['product_id'].'/'.$this->session->userdata['pre_session_id']['sku'];
            }else{
                $pname = '';
            }
            ?>
                <input  type="submit" class="btn1 btn-sign-in" id="in_up" value="Login" onClick="logSignupFunction('<?=$pname;?>')">
                
          </td>
          </tr>
            <tr>
            <td class="new_exist">
              <span id="newtomoonboy">  <label ><input type="radio" name="radio" id="n_user"> New To Moonboy ??  Sign Up </label></span>
                <span id="exixtingusertomoonboy"><label ><input type="radio" name="radio" id="e_user" checked> Existing User ?? Login</label>
                </span>
            </td>
          </tr>
        </table>
        </div>
        <div id="forgot_dv">
         <h4 class="title6 forgt">Moonboy Password Assistance</h4>
            <table class="big-table" >
                <tr>
                    <td>
                        <span>Enter your email address to regenerate password</span><br/>
                        <input type="text" class="input-text" id="mail" Placeholder="Enter email address">
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" id="forgt_btn" class="btn1 btn-sign-in" value="Continue"></td>
                </tr>
            </table>
        </div>
        
        <div id="otp_pass_dv">
            <table class="big-table" >
                <tr>
                    <td>
                        <span>Enter the OTP</span><br/>
                        <input type="text" class="input-text" name="otp" id="otp" placeholder="Enter OTP">
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" id="otp_btn" onClick="checkOtp()" class="btn1 btn-sign-in" value="Continue"></td>
                </tr>
            </table>
        </div>
        
        <div id="chng_pass_dv">
            <table class="big-table" >
                <tr>
                    <td>
                        <span>Chenge your password</span><br/>
                        <input type="text" class="input-text" name="chng_email" id="chng_email" readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" class="input-text" name="new_pass" id="new_pass" placeholder="Enter new password">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" class="input-text" name="cnew_pass" id="cnew_pass" placeholder="Confirm new password">
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" id="chng_btn" onClick="changedPassword()" class="btn1 btn-sign-in" value="Change Password"></td>
                </tr>
            </table>
        </div>
        <!--Forgot password div end here-->
        
        <div class="clearfix"></div>
        
        <table class="big-table"  id="social_tbl">
         <tr> 
        <td><div class="facebook-login"> 
        		<a href="#" onClick="Login()"><img src="<?php echo base_url();?>images/facebook.png"  alt="facebook"> <i> Login with Facebook</i>
			<div class="clearfix"> </div></a></div>
        	<div class="google-login">
            	<a href="#" onClick="login()"><img src="<?php echo base_url();?>images/gplus.png"  alt="google+"> <i> Login with Google+</i>
			<div class="clearfix"></div></a> </div> </td>
        </tr> </table>
        </div>
		<div class="clearfix"> </div>
        </div>
      </div>
</div>

<!--------------------------------------------------------Log In Section End---------------------------------------->
</div>  

<!----------------------------------------Header Section end------------------------------------------------------>