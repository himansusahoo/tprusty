
<?php 
	include "header.php";
?>
		
	<link href="<?php echo base_url();?>new_css/css/color-box.css" rel="stylesheet" />
	<script src="<?php echo base_url();?>new_js/js/jquery.min.js"   ></script>
	<script src="<?php echo base_url();?>new_js/js/jquery.colorbox.js"  ></script>
	<script>
		$(document).ready(function(){
			$(".inline").colorbox({inline:true, width:"25%", height:"447px"});
			$(".inline2").colorbox({inline:true, width:"35%"});
		});
	</script>
    <!-- Lightbox link end here-->
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
	
       <!--Sign in or sign Up script start here-->
	   
	<script>
		function logSignupFunction(pname){
			//alert(pname);return false;
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
							url:'https://www.moonboy.in/user/login',
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
								if(result == 'success1'){
									window.location.href="https://www.moonboy.in/product_description/addtocheckout_buynow/"+pname;
								}
								if(result == 'success'){
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
							url:'https://www.moonboy.in/user/login',
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
								if(result == 'success'){
									//$(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>ssccdd');
									window.location.reload(true);
								}
								if(result == 'success1'){
									
									window.location.href="https://www.moonboy.in/product_description/addtocheckout_buynow/"+pname;							
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
			border: 4px solid #FFFFFF;
			border-radius: 23px 23px 23px 23px;
			height: 35px;
			width: 35px;
			margin-top: 8px;
			color: #000;
			padding-top: 0;
			font-size: 31px;
			line-height: 23px;
			text-shadow: none;
		  
		}
		/* Next button  */
		.media-carousel .carousel-control.right 
		{
		  
		  background-image: none;
			background: none;
			border: 4px solid #FFFFFF;
			border-radius: 23px 23px 23px 23px;
			height: 35px;
			width: 35px;
			margin-top: 8px;
			color: #000;
			padding-top: 0;
			font-size: 31px;
			line-height: 23px;
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

		.title:after, .title:before {
			display: inline-block;
			height: 3px;
			content: " ";
			text-shadow: none;
			background-color: #ed2541;
			width: 290px;
		}
		.form-control {
			padding: 6px 2px;
		}
		/*.content_box{ border:1px solid #f2f2f2;}*/
		.content_box h6 {
			color: #fff;
			z-index: 1;
			position: absolute;
			top: -5px;
			left: 2%;
			font-size: .8em;
		}

		.discount-off:before {
			content: '';
			width: 0;
			height: 0;
			border-top: 60px solid #0280e1;
			border-right: 60px solid transparent;
			position: absolute;
			top: 0;
			left: 0;
			-webkit-transition: .5s all;
			-moz-transition: .5s all;
			-o-transition: .5s all;
			-ms-transition: .5s all;
			transition: .5s all;
		}
		.content_box h5{
			margin:0;
			text-align:center; margin-left:0; font-family: 'SegoeUI'; line-height: 16px;
		}
		.content_box h5 a {
			 color: #0280e1;
			 font-weight: normal;
			font-size: 14px;
			margin:0;
		}
		.price-through{
			margin-bottom:10px;
		}
		.price-recent{
			display: inline-block;font-size: 16px;font-weight: 500; color: #212121;
		}
		.original-price{
			text-decoration: line-through; display: inline-block; margin-left: 8px;font-size: 14px; color: #878787;
		}
		.off-price{
			display: inline-block;
			margin-left: 8px;
			color: #388e3c;
			font-size: 13px;
			letter-spacing: -0.2px;
			font-weight: 500;
		}
		.out-of-stock{
			width: 100%;
			font-size: 16px;
			margin: 0 auto;
			border-radius: 2px;
			background-color: #fff;
			box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .12);
			text-align: center;
			padding: 10px 15px;
			text-transform: uppercase;
			pointer-events: none;
			position: absolute;
			left: 50%;
			-webkit-transform: translateX(-50%);
			transform: translateX(-50%);
			top:50%;
		}
		.out-of-stock span{color: #ff6161; line-height:1;}
		.row1 {
			height: 110px;
		}
		.jspPane {
			padding: 3px!important; 
		}
		.btn-go {
			background-color: #6bb700;
			color: #fff;
			font-size: 13px;
			padding: 4px 10px;
			float: none;
			border: 0;
			margin: 10px 0px;
			text-align: center;
		}
		.rst_spn {
			cursor: pointer;
			display: inline-block;
			font-size: 12px;
			background-color: #ececec;
			box-shadow: 0 2px 4px 0 rgba(255, 255, 255, .5);
			border-radius: 3px;
			margin: 2px 4px;
			overflow: hidden;
			transition: background-color 0.1s;
			max-width: 200px;
			padding: 8px;
			
		}
		.rst_spn:hover{ text-decoration:line-through;}

		.filter-form h4 {
			margin-top: 10px;
			padding: 12px;
			color: #333;
			/* border-bottom: 1px solid #f0f0f0; */
			margin-bottom: 0;
			font-weight: bold;
			font-size: 12px;
			text-transform: uppercase;
			letter-spacing: 0.3px;
			font-family: Roboto, Arial, sans-serif;
		}
		.f_sidebar {
			border: none;
			margin-bottom: 20px;
		}
		.KG9X1F ._2Wy-am {
			font-weight: bold;
			font-size: 16px;
			margin-top: 8px;
			display: inline-block;
			font-family: Roboto, Arial, sans-serif;
			letter-spacing: 0;
		}
		.dropdown_left {
			float: left;
			width: 100%;
		}
		.C5rIv_ {
			display: inline-block;
			margin-left: 10px;
			color: #878787;
			font-size: 12px;
			font-family: Roboto, Arial, sans-serif;
			letter-spacing: 0;
		}
		.catlg {
			height: auto !important;
		}
		.grid1_of_4:hover{box-shadow: 0 3px 16px 0 rgba(0, 0, 0, .11);
		}
		/* End carousel */
		div#more-brand{
		position: absolute;
		color: black;
		display: none;
		display: block;
		height: 245px;
		width: 868px;
		border: 1px solid #CCC;
		z-index: 999;
		margin: -86px 24px 20px -88px;
		background: #fff;
		overflow-x: scroll;
		white-space: nowrap;
		border-radius: 2px;
		display: flex;
		flex-wrap: wrap;
		flex-direction: column;
		}
		#more-close {
			float:right;
			display:inline-block;
			padding:2px 5px;
		 
		}
		.alfa{
			letter-spacing: 2px;
			font-size: 12px;
			padding: 6px;
			color: #888;
		}
		.padd{
				padding: 6px;
		}
		.column-more{
			float: left;
			width: 100%;
			height: 176px;
			white-space: nowrap;
			display: flex;
			flex-wrap: wrap;
			flex-direction: column;
		}
		.column-more2{
			float: left;
			height: 176px;
			width: 125px;
			white-space: nowrap;
			display: flex;
			flex-wrap: wrap;
			flex-direction: column;
		}
		.column-more label.checkbox{ width:125px;}
	</style> 

	<script language="JavaScript">
		function setVisibility(id, visibility) {
			document.getElementById(id).style.display = visibility;
		}
	</script>
	<script>
		function scrollWin(x, y) {
			window.scrollBy(x, y);
		}
	</script>


<div style="clear:both;"></div> 
<!----------------------------------------Body Section start------------------------------------------------------> 
<div class="container" style="width: 100%; margin-top: 58px; padding: 0; background:#f3f3f3; padding:5px;">
<div class="row" style="margin-top:10px;">

   <!--------------------------------- Start of Filter bar------------------------------------------------------------------------------------------>
	<div class="col-md-3 filter" style="width:250px; padding: 0;position: relative;background: #fff;box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .08); margin-left:16px;">
		<div style="width:50%; float:left; padding: 10px; text-align:left;"><h4 style="margin:10px 0 0 0;">Filter</h4></div>
			<div style="width:50%; float:right; padding: 10px; text-align:right"><h6 style="color:blue;">Clear All</h6></div>
			<div style="clear:both;"></div>
				<div style="width:100%; height:auto; margin:5px 0 10px 0;">
					<span class="rst_spn"> Apple&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>
					<span class="rst_spn"> Apple&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>
					<span class="rst_spn"> Apple&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>
					<span class="rst_spn"> Apple&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>
					<span class="rst_spn"> Apple&nbsp;<i class="fa fa-times close_filter" aria-hidden="true"></i></span>
				</div>
				<div style="clear:both"></div>
        
				  <!-- Price filtering section start-->
				<div class="f_sidebar" style="background:#fff;">
					<section class="filter-form" style="margin: -12px 10px 10px;border: 1px solid #ececec;">
						<h4 style="background:#ececec; padding:10px 20px; margin-top: 0px; font-size:15px;">Price</h4>
						<div class="row1 scroll-pane" style="overflow: hidden; padding: 0px; width:100%;">
							<div class="jspContainer" style="width:100%; height: 110px;">
								<div class="jspPane" style="padding: 0px; top: 0px; left: 0px; width: 100%;">
									<div class="col-sm-12">
									<div class="jspPane" style="padding: 0px; top: 0px; left: 0px;">
										<div class="col col-4">
											<div class="price-range"> FROM : <br> <input type="text" name="start_pric" id="start_pric" placeholder="(Rs.)"> </div>
											<div class="price-range"> TO :  <br> <input type="text" name="end_pric" id="end_pric" placeholder="(Rs.)"> </div>
											<div style="width:100%; margin:auto; text-align:center;">
												<input class="btn-go hvr-sweep-to-right" type="button" value="Search" onclick="">
											</div>
										</div>
									</div>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
        <!-- Price filtering section end-->
        
		<!-- Type filtering section Start-->
		<div class="f_sidebar" style="border:none !important;">           
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="panel panel-default">
					<section class="filter-form">
						<div class="panel-heading" role="tab" id="headingOne">
						  <h4 class="panel-title">
							<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne0" aria-expanded="true" aria-controls="collapseOne0">
							  Brand <i class="fa fa-angle-down"></i>
							</a>
						  </h4>
						</div>
                        <div id="collapseOne0" class="panel-collapse  
                        collapse" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                               <label class="checkbox">
                                   <input type="checkbox" id="" name="" value="" onchange="">
                                   		<i></i> Apple  
                               </label>
                               <label class="checkbox">
                               		<input type="checkbox" id="" name="" value="" onchange="">
                               			<i></i> HTC
                                </label>
                               <a  href="#1" onclick="setVisibility('more-brand', 'inline');" ;>195 More</a>
                               
                               <div style="display:none;" id="more-brand">
                               <div class="row" style="background:#f2f2f2; padding:2px 0; margin:0;">
                               		<div class="col-lg-2 padd">Brand</div>
                                    <div class="col-lg-3 padd"><input type="text" placeholder="Search Brand" class="_2rhM-s"></div>
                                    <div class="col-lg-6 alfa" ># A B C D E F G H I J K L M N O P Q R S T U V W X Y Z</div>
                                    <div class="col-lg-1 padd"><a id="more-close" href="#" onclick="setVisibility('more-brand', 'none');";>x</a></div>
                               </div>
                               	<ul style="padding:10px;">
                                	<li class="column-more">
                                      <h5 style="font-size:15px; font-weight:bold; width: 125px;">Popular</h5>
                                    	<label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        
                                        <h5 style="font-size:15px; font-weight:bold; width: 125px;">A</h5>
                                    	<label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        
                                        <h5 style="font-size:15px; font-weight:bold; width: 125px;">B</h5>
                                    	<label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        
                                        <h5 style="font-size:15px; font-weight:bold; width: 125px;">C</h5>
                                    	<label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                        <label class="checkbox">
                                           <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> Apple  
                               			</label>
                               			<label class="checkbox">
                                            <input type="checkbox" id="" name="" value="" onchange="">
                                                <i></i> HTC
                                		</label>
                                    </li>
                                </ul>
                              </div>
                          </div>
                        </div>              
            	</section>   
				</div>  
			</div>
		</div>
		
		<div class="f_sidebar">           
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="panel panel-default">
					<section class="filter-form">
						<div class="panel-heading" role="tab" id="headingOne">
							  <h4 class="panel-title">
								<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1">
								  Color <i class="fa fa-angle-down"></i>
								</a>
							  </h4>
						</div>
							<div id="collapseOne1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
							  <div class="panel-body">
								   <label class="checkbox">
									   <input type="checkbox" id="" name="" value="" onchange="">
											<i></i> Apple  
								   </label>
								   <label class="checkbox">
										<input type="checkbox" id="" name="" value="" onchange="">
											<i></i> HTC
									</label>
							  </div> 
							</div>              
					</section>   
				</div>  
			</div>
		</div>
		
		<div class="f_sidebar">           
			  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				   <div class="panel panel-default">
					   <section class="filter-form">
						<div class="panel-heading" role="tab" id="headingOne">
							  <h4 class="panel-title">
									<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne2" aria-expanded="true" aria-controls="collapseOne2">
									  4G <i class="fa fa-angle-down"></i>
									</a>
							  </h4>
						</div>
							<div id="collapseOne2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
							  <div class="panel-body">
									<label class="checkbox">
										<input type="checkbox" id="" name="" value="" onchange="">
										<i></i> Apple  
									</label>
									<label class="checkbox">
										<input type="checkbox" id="" name="" value="" onchange="">
											<i></i> HTC
									</label>
								</div>
							</div>              
						</section>   
				   </div>  
			 </div>
		</div>
       <!-- Type filtering section end-->        
        <div class="clearfix"></div>
   </div>
   
   <!--------------------------------- End of Filter bar------------------------------------------------------------------------------------------>
    <div class="col-md-9" style="width:80%; background:#fff; padding-top:10px; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .08); float:right;">
    		<div style="width:1000%;">
            	<a href="https://www.moonboy.in/" style="color:#878787; font-size:12px;">Home > </a>
                <a href="https://www.moonboy.in/category/mobiles" style="color:#878787; font-size:12px;">Mobiles > </a>
                <a href="https://www.moonboy.in/smart-phones" style="color:#878787; font-size:12px;">Smart Phones </a>
            </div>
            
            
            <div style="clear:both;"></div>
            
            <div style="width:70%; float:left;">
            	<div class="KG9X1F">
            <h2 class="_2Wy-am">Samsung Mobiles</h2>
            <div class="C5rIv_">
            <span><!-- react-text: 19571 -->(Showing 1 – 18 products of 292 products)<!-- /react-text --></span>
            </div>
            </div>
            </div>
            
            <div style="width:30%; float:right; text-align:right;">
            	<div class="dropdown_left">
			       Sort By Price &nbsp;<select class="dropdown selectpicker" id="attr_size" data-style="btn-info" style="width:auto;" onchange="sortby_price(this.value,'smart-phones','71-73','NOT')">        <option value="">--Select--</option>
						  <option value="Low-To-High">Price: Low To High</option>						  
						  <option value="High-To-Low">Price: High To Low</option>
						  
					   </select>
					  </div>
            </div>
            
	<div class="w_content">
		<div class="catlog">
		     <div class="clearfix"> </div>
		</div>
         <!-- grids_of_4 -->
		<div class="grids_of_4" id="catlog_dv">
              <div class="grid1_of_4 catlg">
                <div class="content_box discount-off"> 
                    <h6>20% <br>OFF</h6>
               <div class="view view-fifth">
                     <a href="#">
                        <img src="<?php echo base_url();?>images/poduct-mobile/1.jpeg" class="img-responsive" data-wow-delay="1s" alt="">
                     </a>
                 </div>
                  <div class="wish-list"> 
                    <a class="link-wishlist inline cboxElement" href="#inline_content"> <i class="fa fa-heart"></i> </a>
                 </div>
                 <div class="product-text">              
                    <h5>
                        <a href="#">
                        Apple iPhone 7 Plus Silver- 32GB 
                        </a>
                    </h5> 
                    <div class="price-through">
                        <div class="price-recent">₹539</div>
                        <div class="original-price">₹999</div>
                        <div class="off-price">46% off</div>
                    </div>
        		</div>
             </div>
        </div>
    <div class="grid1_of_4 catlg">
                <div class="content_box"> 
                    <h6>20% <br>OFF</h6>
               <div class="view view-fifth">
                     <a href="#">
                        <img src="<?php echo base_url();?>images/poduct-mobile/2.jpeg"  class="img-responsive" data-wow-delay="1s" alt="">
                     </a>
                 </div>
                  <div class="wish-list"> 
                    <a class="link-wishlist inline cboxElement" href="#inline_content"> <i class="fa fa-heart"></i> </a>
                 </div>
                 <div class="product-text">              
                    <h5>
                        <a href="#">
                        Apple iPhone 7 Plus Silver- 32GB 
                        </a>
                    </h5> 
                    <div class="price-through">
                        <div class="price-recent">₹539</div>
                        <div class="original-price">₹999</div>
                        <div class="off-price">46% off</div>
                    </div>
                    <div class="out-of-stock"><span>Out Of Stock</span></div>
        		</div>
             </div>
        </div>
        
        <div class="grid1_of_4 catlg">
                <div class="content_box"> 
                    <h6>20% <br>OFF</h6>
               <div class="view view-fifth">
                     <a href="#">
                        <img src="<?php echo base_url();?>images/poduct-mobile/3.jpeg"  class="img-responsive" data-wow-delay="1s" alt="">
                     </a>
                 </div>
                  <div class="wish-list"> 
                    <a class="link-wishlist inline cboxElement" href="#inline_content"> <i class="fa fa-heart"></i> </a>
                 </div>
                 <div class="product-text">              
                    <h5>
                        <a href="#">
                        Apple iPhone 7 Plus Silver- 32GB 
                        </a>
                    </h5> 
                    <div class="price-through">
                        <div class="price-recent">₹539</div>
                        <div class="original-price">₹999</div>
                        <div class="off-price">46% off</div>
                    </div>
        		</div>
             </div>
        </div>
        
        <div class="grid1_of_4 catlg">
                <div class="content_box"> 
                    <h6>20% <br>OFF</h6>
               <div class="view view-fifth">
                     <a href="#">
                        <img src="<?php echo base_url();?>images/poduct-mobile/4.jpeg"  class="img-responsive" data-wow-delay="1s" alt="">
                     </a>
                 </div>
                  <div class="wish-list"> 
                    <a class="link-wishlist inline cboxElement" href="#inline_content"> <i class="fa fa-heart"></i> </a>
                 </div>
                 <div class="product-text">              
                    <h5>
                        <a href="#">
                        Apple iPhone 7 Plus Silver- 32GB 
                        </a>
                    </h5> 
                    <div class="price-through">
                        <div class="price-recent">₹539</div>
                        <div class="original-price">₹999</div>
                        <div class="off-price">46% off</div>
                    </div>
        		</div>
             </div>
        </div>
        
        <div class="grid1_of_4 catlg">
                <div class="content_box"> 
                    <h6>20% <br>OFF</h6>
               <div class="view view-fifth">
                     <a href="#">
                        <img src="<?php echo base_url();?>images/poduct-mobile/5.jpeg"  class="img-responsive" data-wow-delay="1s" alt="">
                     </a>
                 </div>
                  <div class="wish-list"> 
                    <a class="link-wishlist inline cboxElement" href="#inline_content"> <i class="fa fa-heart"></i> </a>
                 </div>
                 <div class="product-text">              
                    <h5>
                        <a href="#">
                        Apple iPhone 7 Plus Silver- 32GB 
                        </a>
                    </h5> 
                    <div class="price-through">
                        <div class="price-recent">₹539</div>
                        <div class="original-price">₹999</div>
                        <div class="off-price">46% off</div>
                    </div>
        		</div>
             </div>
        </div>
        
        <div class="grid1_of_4 catlg">
                <div class="content_box"> 
                    <h6>20% <br>OFF</h6>
               <div class="view view-fifth">
                     <a href="#">
                        <img src="<?php echo base_url();?>images/poduct-mobile/6.jpeg"  class="img-responsive" data-wow-delay="1s" alt="">
                     </a>
                 </div>
                  <div class="wish-list"> 
                    <a class="link-wishlist inline cboxElement" href="#inline_content"> <i class="fa fa-heart"></i> </a>
                 </div>
                 <div class="product-text">              
                    <h5>
                        <a href="#">
                        Apple iPhone 7 Plus Silver- 32GB 
                        </a>
                    </h5> 
                    <div class="price-through">
                        <div class="price-recent">₹539</div>
                        <div class="original-price">₹999</div>
                        <div class="off-price">46% off</div>
                    </div>
        		</div>
             </div>
        </div>
        
        <div class="grid1_of_4 catlg">
                <div class="content_box"> 
                    <h6>20% <br>OFF</h6>
               <div class="view view-fifth">
                     <a href="#">
                        <img src="https://www.moonboy.in/images/product_img/catalog_fvyticodlkxqwu320170628175416.jpg"  class="img-responsive" data-wow-delay="1s" alt="">
                     </a>
                 </div>
                  <div class="wish-list"> 
                    <a class="link-wishlist inline cboxElement" href="#inline_content"> <i class="fa fa-heart"></i> </a>
                 </div>
                 <div class="product-text">              
                    <h5>
                        <a href="#">
                        Apple iPhone 7 Plus Silver- 32GB 
                        </a>
                    </h5> 
                    <div class="price-through">
                        <div class="price-recent">₹539</div>
                        <div class="original-price">₹999</div>
                        <div class="off-price">46% off</div>
                    </div>
        		</div>
             </div>
        </div>
        
        <div class="grid1_of_4 catlg">
                <div class="content_box"> 
                    <h6>20% <br>OFF</h6>
               <div class="view view-fifth">
                     <a href="#">
                        <img src="https://www.moonboy.in/images/product_img/catalog_fvyticodlkxqwu320170628175416.jpg"  class="img-responsive" data-wow-delay="1s" alt="">
                     </a>
                 </div>
                  <div class="wish-list"> 
                    <a class="link-wishlist inline cboxElement" href="#inline_content"> <i class="fa fa-heart"></i> </a>
                 </div>
                 <div class="product-text">              
                    <h5>
                        <a href="#">
                        Apple iPhone 7 Plus Silver- 32GB 
                        </a>
                    </h5> 
                    <div class="price-through">
                        <div class="price-recent">₹539</div>
                        <div class="original-price">₹999</div>
                        <div class="off-price">46% off</div>
                    </div>
        		</div>
             </div>
        </div>
        
        <div class="grid1_of_4 catlg">
                <div class="content_box"> 
                    <h6>20% <br>OFF</h6>
               <div class="view view-fifth">
                     <a href="#">
                        <img src="https://www.moonboy.in/images/product_img/catalog_fvyticodlkxqwu320170628175416.jpg"  class="img-responsive" data-wow-delay="1s" alt="">
                     </a>
                 </div>
                  <div class="wish-list"> 
                    <a class="link-wishlist inline cboxElement" href="#inline_content"> <i class="fa fa-heart"></i> </a>
                 </div>
                 <div class="product-text">              
                    <h5>
                        <a href="#">
                        Apple iPhone 7 Plus Silver- 32GB 
                        </a>
                    </h5> 
                    <div class="price-through">
                        <div class="price-recent">₹539</div>
                        <div class="original-price">₹999</div>
                        <div class="off-price">46% off</div>
                    </div>
        		</div>
             </div>
        </div>
        
        <div class="grid1_of_4 catlg">
                <div class="content_box"> 
                    <h6>20% <br>OFF</h6>
               <div class="view view-fifth">
                     <a href="#">
                        <img src="https://www.moonboy.in/images/product_img/catalog_fvyticodlkxqwu320170628175416.jpg"  class="img-responsive" data-wow-delay="1s" alt="">
                     </a>
                 </div>
                  <div class="wish-list"> 
                    <a class="link-wishlist inline cboxElement" href="#inline_content"> <i class="fa fa-heart"></i> </a>
                 </div>
                 <div class="product-text">              
                    <h5>
                        <a href="#">
                        Apple iPhone 7 Plus Silver- 32GB 
                        </a>
                    </h5> 
                    <div class="price-through">
                        <div class="price-recent">₹539</div>
                        <div class="original-price">₹999</div>
                        <div class="off-price">46% off</div>
                    </div>
        		</div>
             </div>
        </div>
        
        <div class="grid1_of_4 catlg">
                <div class="content_box"> 
                    <h6>20% <br>OFF</h6>
               <div class="view view-fifth">
                     <a href="#">
                        <img src="https://www.moonboy.in/images/product_img/catalog_fvyticodlkxqwu320170628175416.jpg"  class="img-responsive" data-wow-delay="1s" alt="">
                     </a>
                 </div>
                  <div class="wish-list"> 
                    <a class="link-wishlist inline cboxElement" href="#inline_content"> <i class="fa fa-heart"></i> </a>
                 </div>
                 <div class="product-text">              
                    <h5>
                        <a href="#">
                        Apple iPhone 7 Plus Silver- 32GB 
                        </a>
                    </h5> 
                    <div class="price-through">
                        <div class="price-recent">₹539</div>
                        <div class="original-price">₹999</div>
                        <div class="off-price">46% off</div>
                    </div>
        		</div>
             </div>
        </div>
        
        <div class="grid1_of_4 catlg">
                <div class="content_box"> 
                    <h6>20% <br>OFF</h6>
               <div class="view view-fifth">
                     <a href="#">
                        <img src="https://www.moonboy.in/images/product_img/catalog_fvyticodlkxqwu320170628175416.jpg"  class="img-responsive" data-wow-delay="1s" alt="">
                     </a>
                 </div>
                  <div class="wish-list"> 
                    <a class="link-wishlist inline cboxElement" href="#inline_content"> <i class="fa fa-heart"></i> </a>
                 </div>
                 <div class="product-text">              
                    <h5>
                        <a href="#">
                        Apple iPhone 7 Plus Silver- 32GB 
                        </a>
                    </h5> 
                    <div class="price-through">
                        <div class="price-recent">₹539</div>
                        <div class="original-price">₹999</div>
                        <div class="off-price">46% off</div>
                    </div>
        		</div>
             </div>
        </div>
        
        <div class="grid1_of_4 catlg">
                <div class="content_box"> 
                    <h6>20% <br>OFF</h6>
               <div class="view view-fifth">
                     <a href="#">
                        <img src="https://www.moonboy.in/images/product_img/catalog_fvyticodlkxqwu320170628175416.jpg"  class="img-responsive" data-wow-delay="1s" alt="">
                     </a>
                 </div>
                  <div class="wish-list"> 
                    <a class="link-wishlist inline cboxElement" href="#inline_content"> <i class="fa fa-heart"></i> </a>
                 </div>
                 <div class="product-text">              
                    <h5>
                        <a href="#">
                        Apple iPhone 7 Plus Silver- 32GB 
                        </a>
                    </h5> 
                    <div class="price-through">
                        <div class="price-recent">₹539</div>
                        <div class="original-price">₹999</div>
                        <div class="off-price">46% off</div>
                    </div>
        		</div>
             </div>
        </div>
        
        <div class="grid1_of_4 catlg">
                <div class="content_box"> 
                    <h6>20% <br>OFF</h6>
               <div class="view view-fifth">
                     <a href="#">
                        <img src="https://www.moonboy.in/images/product_img/catalog_fvyticodlkxqwu320170628175416.jpg"  class="img-responsive" data-wow-delay="1s" alt="">
                     </a>
                 </div>
                  <div class="wish-list"> 
                    <a class="link-wishlist inline cboxElement" href="#inline_content"> <i class="fa fa-heart"></i> </a>
                 </div>
                 <div class="product-text">              
                    <h5>
                        <a href="#">
                        Apple iPhone 7 Plus Silver- 32GB 
                        </a>
                    </h5> 
                    <div class="price-through">
                        <div class="price-recent">₹539</div>
                        <div class="original-price">₹999</div>
                        <div class="off-price">46% off</div>
                    </div>
        		</div>
             </div>
        </div>
        
        <div class="grid1_of_4 catlg">
                <div class="content_box"> 
                    <h6>20% <br>OFF</h6>
               <div class="view view-fifth">
                     <a href="#">
                        <img src="https://www.moonboy.in/images/product_img/catalog_fvyticodlkxqwu320170628175416.jpg"  class="img-responsive" data-wow-delay="1s" alt="">
                     </a>
                 </div>
                  <div class="wish-list"> 
                    <a class="link-wishlist inline cboxElement" href="#inline_content"> <i class="fa fa-heart"></i> </a>
                 </div>
                 <div class="product-text">              
                    <h5>
                        <a href="#">
                        Apple iPhone 7 Plus Silver- 32GB 
                        </a>
                    </h5> 
                    <div class="price-through">
                        <div class="price-recent">₹539</div>
                        <div class="original-price">₹999</div>
                        <div class="off-price">46% off</div>
                    </div>
        		</div>
             </div>
        </div>
</div>
<!-- end grids_of_4 -->

           <div class="clearfix"></div>
           <div id="view_more_dv">
           		<img src="https://www.moonboy.in/images/loader.gif" id="lodr_img" style="display:none;">
                				<input type="button" id="" class="add-to-cart view_mor" value="View More" name="button" onclick="">
		</div>
          
</div>
    </div>
</div>


  
</div>
<div class="above-footer">
<div style="color:#666; font-size:15px; font-family:Tahoma, Geneva, sans-serif; text-align:justify;margin:20px!important; padding:10px;">
           <p style="margin-right:10px !important; ">
           		</p><p>How to <strong>Buy Best Smartphones Online</strong>? While purchasing mobiles online, you will need to keep a few things in mind. Such as: Type of handset The first thing you will need to decide on is which type of cellular device you wish to buy. If it's a featured model, then it will be designed with a small screen and a keypad that will have numbers, call and answer buttons. But if it's a smartphone, then it comes with a big display that uses touchscreen technology to operate the device. Which OS The popular cell phones available online come equipped with operating systems like Android, Windows, iOS and Blackberry OS. So read about them online and check out videos to know which operating system suits you better. Feature Sets Every person has his own requirement and hence, would like to have specific features that he will need more often. These can be high resolution front and back camera, Bluetooth, music player, radio, dual SIM and such. You also need to look for its hardware. For example, If&nbsp;It's <strong>Android Phone</strong> Or <strong>Windows Phone</strong> if it's dual core or quad core, if it supports 3G and 4G network, its screen size, RAM and the available storage space. Brands The top brands offering highly-advanced cell phones today in the market are Motorola, LeEco, Sony, Samsung, HTC, Apple, MI Redmi, Gionee, Vivo, Oppo, Lenovo, Nokia, Microsoft, Asus and OnePlus. What ever might be your budget, you can definitely find a handset that suits your pocket and meets your needs. What Else Should you Check? Apart from checking the availability of these features, you should also read the reviews from various experts to know more about the models. These reviews will give you practical insights about the performance of a mobile phone and also a first-hand experience which will help you make better decisions. So do your research and have fun buying your desired mobile phones online.</p>
           <p></p></div>
<div style="width:100%; margin:auto; text-align:center; color:#000; padding:10px 0;">
        	<h2 style="float:left; margin-left:15px;">Top Brands</h2>
        </div>
        <div style="width:98%; margin:auto; padding:10px;">
        	<div id="jssor_6" style="position:relative;margin:0 auto;top:0px;left:0px;width:1600px;height:100px;overflow:hidden;visibility:hidden; border:1px solid #ccc;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position:absolute;top:0px;left:0px;background:url('img/loading.gif') no-repeat 50% 50%;background-color:rgba(0, 0, 0, 0.7);"></div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1600px;height:100px;overflow:hidden;">
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/android.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/bitly.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/blogger.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/dnn.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/drupal.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/facebook.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/google.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/ibm.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/ios.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/joomla.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/linkedin.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/mac.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/pinterest.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/samsung.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/twitter.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/windows.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/wordpress.jpg" />
            </div>
            <div>
                <img data-u="image" src="<?php echo base_url();?>img/youtube.jpg" />
            </div>
            <a data-u="any" href="https://www.jssor.com" style="display:none">js slider</a>
        </div>
    </div>
    <script type="text/javascript">jssor_6_slider_init();</script> 
        </div>
		<div class="container-fluid">
      <div class="row" style="width:100%; padding:0; margin:auto;">
            <div style="width:100%; margin:auto; text-align:center; color:#000; padding:10px 0;">
        	<h2 style="float:left; margin-left:15px;">Know Moonboy a little more</h2>
        </div>
      </div>
      <div class="col-lg-12" style="background:#f5f5f5; padding:10px;">
      <h5><strong>Term & Condition</strong></h5>
		<p>est Please allow at least 10-12 business days for your order to arrive after payment has been confirmed.</p> 
        <h5><strong>Shipping & Delivery</strong></h5>
		<p>Test Please allow at least 10-12 business days for your order to arrive after payment has been confirmed. If the product ordered is out of stocks, we will contact you immediately to confirm a new delivery date or other arrangements. Shipping through Reputed Couriers – Fedex/ DHL (Blue Dart)/ &nbsp;Professional/ DTDC / First Flight /Speed Post.</p> 
        <h5><strong>Payment terms</strong></h5>
		<p>est Please allow at least 10-12 business days for your order to arrive after payment has been confirmed.</p>      
      </div>
  </div>
<?php 
	include "footer.php";
?>