<!doctype html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Dashboard</title>
		<meta name="author" content="">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>css/admin/styles.css">
		<link rel="stylesheet" href="<?php echo base_url();?>css/admin/colorbox.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>css/admin/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>css/admin/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>js/jquery.colorbox.js"></script>
	</head>
	<script>
		$(document).ready(function(){
			$(".inline").colorbox({inline:true, width:"70%"});
			$(".inline").colorbox({'overlayClose': false, 'escKey': false});
		});
	</script>
	<script>
		$(document).ready(function(){
			//Disable Submit button
			$("#verify_submit_id").prop("disabled", true).css({'background-color':'#ccc', 'border':'1px solid #ccc'});
			
			$(sell_online_input).attr("disabled","disabled");
			
			$('#item_shipping_true').click(function(){
				$('#sell_online_input').removeAttr("disabled");
			});

			$('#item_shipping_false').click(function(){
				$('#sell_online_input').attr("disabled","disabled");
			});
		});
	</script>
	<script type="text/javascript">
		/*On 26/10/15
		function ShowVerificationForm(val){
			$('#verification_form_dv').load('<?php echo base_url() ?>seller/seller/loadForm', {"validation_type": val});
		}
		*/
		function here_about_us(val){
			var base_url = "<?php echo base_url(); ?>";
			var controller = "seller/seller";
			var seller_id = $('#session_seller_id').val(); 
			var here_about = $("#here_about option:selected").val();
			var sell_online = $('#sell_online_input').val();
			$.ajax({
				'url' : base_url + controller + '/more_seller_info',
				'type' : 'POST',
				'data' : 'seller_id='+seller_id+'&sell_online='+sell_online+'&here_about='+here_about,
				/*'success' : function(data){
					$('#category').html(data);
					//document.getElementById("review_from").reset();
				}*/
			});
		}
		/* On 26/10/15
		function number_verification(){
			var base_url = "<?php echo base_url(); ?>";
			var controller = "seller/seller";
			var mobile = $('#mobile').val();   //alert(mobile); return false;
			$("#myDiv").val(mobile);
			$.ajax({
				'url' : base_url + controller + '/send_otp',
				'type' : 'POST',
				'data' : 'mobile=' + mobile,
				//'success' : function(data){
					//$('#successfully_verify').html(data);
					//document.getElementById("review_from").reset();
				//}
			});
		}*/
		
		function email_verification(){
			var base_url = "<?php echo base_url(); ?>";
			var controller = "seller/seller";
			var email = $('#email').val();
			$("#myDiv").val(email);//alert(email); return false;
			$.ajax({
				'url' : base_url + controller + '/send_email_code',
				'type' : 'POST',
				'data' : 'email=' + email,
			});
		}
		function submit_opt(){
			var base_url = "<?php echo base_url(); ?>";
			var controller = "seller/seller";
			var otp = $('#otp').val(); 
			var email_id = $('#myDiv').val(); //alert(email_id); return false;
			if(otp == ""){
				$("#otp_validate").show();
				$("#otp_validate").focus().text("Please enter correct OTP.");
				return false;
			}else{
				$.ajax({
					'url' : base_url + controller + '/otp_verification',
					'type' : 'POST',
					'data' : 'email_id=' + email_id + '&otp=' + otp,
					'success' : function(data){
						$.colorbox.close();
						//$('#successfully_verify').html(data);
						if(data == 'success'){
							$("#verify_submit_id").prop('disabled', false).css({'background-color':'#000', 'border':'1px solid #000'});
							$("#number_button").prop('disabled', true);
							$('#successfully_verify').html("<div style='color:green;'><img src='<?php echo base_url();?>images/tick.png' width='15'>  Verify successfully.</div>");
						}else{
							$("#otp").val("");
							$('#successfully_verify').html("<div style='color:red;'><img src='<?php echo base_url();?>images/cross.png' width='15'>  Verification Failed.</div>");
						}
					}
				});
			}
		}
		function submit_category(){
			var base_url = "<?php echo base_url(); ?>";
			var controller = "seller/seller";
			// Code for category verification n submit
			/*var subcategoryid = document.getElementsByName("large"); 
			var subcategoryid_count = subcategoryid.length; 

			var count = 0;
			for (var i=0; i<subcategoryid_count; i++) {
				if (subcategoryid[i].checked === true) {
					count++;
				}
			}
			if(count==0){
				alert("Please select a category.");
				return false;
			}else{
				var cate = $("input[name='large']:checked").val();  alert(cate); return false;
				window.location.href = base_url + controller + '/cate_verification/'+encodeURIComponent(cate);
			}*/
			

			var checkboxes = document.getElementsByName('large');
			var vals = "";
			for (var i=0, n=checkboxes.length;i<n;i++) {
				if (checkboxes[i].checked){
					vals += ","+checkboxes[i].value;
				}
			}
			if (vals){
				val = vals.substring(1); 
				window.location.href = base_url + controller + '/add_category/'+encodeURIComponent(val);
			}else{
				alert("Please select category.");
				return false;
			}

		}
	</script>
	
	<body>
		<!--<div id="w">
			<ul id="sidemenu">
				<li> <a href="#" class="open"><i class="icon-home icon-large"></i><span> Dashboard </span></a></li>
				<li> <a href="add_product.php"><i class="icon-lightbulb icon-large"></i><span> Catalog </span></a></li>
				<li> <a href="active_orders.php"><i class="icon-envelope icon-large"></i><span> Orders </span></a></li>
				<li> <a href="returns.php"><i class="icon-home icon-large"></i><span> Returns </span></a></li>
				<li> <a href="settlements.php"><i class="icon-info-sign icon-large"></i><span> Payments </span></a></li>
				<!--<li> <a href="#"><i class="icon-lightbulb icon-large"></i><span> Metrics </span></a></li>
				<li> <a href="my_promotions.php"><i class="icon-home icon-large"></i><span> Promotions </span></a></li>-->
				<!--<li> <a href="my_profile.php"><i class="icon-info-sign icon-large"></i><span> Account </span></a></li>
			</ul>
			<div id="content">    
				<div class="top-bar">
					<div class="top-right">
						<ul>
							<li> Welcome Admin </li>
							<li><a href="#"> Login </a></li> 
							<li><a href="#"> Logout </a></li> 
						</ul>
					</div>
				</div>  <!-- @end top-bar  -->
				<!--<div class="main-content">
					<div class="row ac_create_form">-->
					
		
				
				<div class="signup_outer">
              
                <div class="verify_later">You can fill below information later  <a href="<?php echo base_url();?>seller/seller/seller_info_form_page"><span class="seller_buttons">SKIP</span></a></div>
                <div class="clerafix"></div>
					<div class="signup_inner">
						<h3 class="a-center">Verification of Details</h3>
						<hr>
						<div>
							<h4><b>Email verification <sup>*</sup></b></h4>
							<table>
								<tr>
									<td width="20%"> Your Email ID* </td>
									<td width="25%">
										<input type="text" id="email" class="seller_input readonly_field" name="email" value="<?php echo $email; ?>" readonly>
									</td>
									<td width="10%">
										<a class='inline' href="#inline_content">
											<input type="button" id="number_button" onClick="email_verification()" class="seller_buttons" value="Send OTP">
										</a>
									</td>
									<td width="25%" id="successfully_verify">Verify your email to continue</td>
								</tr>
							</table>
						</div>
						<div id="verification_form_dv"></div>
						<!--<div class="mobile_verification">
							<h4><b>Contact number verification</b></h4>
							<form>
								<table>
									<tr>
										<td width="20%"> Your contact number* </td>
										<td width="25%">
											<input type="text" id="mobile" class="seller_input" name="contact_no" value="<?php echo $mobile; ?>">
										</td>
										<td width="10%">
											<a class='inline' href="#inline_content">
												<input type="button" id="number_button" onclick="number_verification()" class="seller_buttons" value="Verify">
											</a>
										</td>
										<td width="25%">Verify your phone number to continue</td>
									</tr>
								</table>
							</form>
						</div>-->
						
						<div style='display:none'>
							<div id='inline_content' style='padding:10px; background:#fff;'>
								<p>Verification Form</p>
								<div>
									Enter the OTP : <input type="text" id="otp" name="code" class="text2"> 
									<input type="hidden" id="myDiv">
									<input type="button" name="submit" id="otp_submit" class="seller_buttons" value="Submit" onClick="submit_opt()">
									<span class="error_msg" id="otp_validate" style="display:none;"> Please enter correct OTP.</span>
								</div>
							</div>
						</div>
						<hr>
						<div>
							<!--<form>
								<!--<div>
									<h4><b>Address verification</b></h4>
									<table>
										<tr>
											<td width="15%"> Pick up address * : </td>
											<td width="85%">
												<input type="text" class="text2" name="address1" value="">
											</td>
										</tr>
										<tr>
											<td></td>
											<td><input type="text" class="text2" name="address2" value=""></td>
										</tr>
										<tr>
											<td> Pincode* : </td>
											<td><input type="text" class="text2" name="pincode" value="<?php echo $pincode; ?>"></td>
										</tr>
										<tr>
											<td> City : </td>
											<td><input type="text" class="text2" name="city" value=""></td>
										</tr>
										<tr>
											<td> State : </td>
											<td><input type="text" class="text2" name="state" value=""></td>
										</tr>
									</table>
								</div>
								<hr>-->
								<?php if(isset($error)) : ?>
								<div class="error_msg a-center"><?php echo $error;?></div>
								<?php endif; ?>
								<div>
									<!--<h4><b>Category verification</b></h4>
									* Select atleast one category<br>-->
										<h4><b>Category</b></h4>
										Please select at-least one category <sup>*</sup><br>
										<table class="verifctn-details">
											<tbody>
												<tr>
													<td>
														<table>
															<tr><td colspan="4"><strong>Large</strong></td></tr>	
															<tr>
																<td><input type="checkbox" name="large" value="Adjustable Dumbells"> Adjustable Dumbells </td>
																<td><input type="checkbox" name="large" value="Bicycles"> Bicycles </td>
																<td><input type="checkbox" name="large" value="Air Conditioner"> Air Conditioner </td>
																<td><input type="checkbox" name="large" value="Bench"> Bench </td>
																<td><input type="checkbox" name="large" value="Cross Trainer"> Cross Trainer </td>
																<td><input type="checkbox" name="large" value="Gas Stove"> Gas Stove </td>
																<td><input type="checkbox" name="large" value="Home Gyms"> Home Gyms </td>
															</tr>
															<tr>
																<td><input type="checkbox" name="large" value="Microwaves"> Microwaves </td>
																<td><input type="checkbox" name="large" value="Refrigerator"> Refrigerator </td>
																<td><input type="checkbox" name="large" value="TV"> TV </td>
																<td><input type="checkbox" name="large" value="Treadmil"> Treadmil </td>
																<td><input type="checkbox" name="large" value="Exercise Bike"> Exercise Bike </td>
																<td><input type="checkbox" name="large" value="Washing Machine"> Washing Machine </td>
																<td></td>
															</tr>
														</table>
													</td>
												</tr>
												<tr>
													<td>
														<table>
															<tr><td colspan="4"><strong>Lifestyle</strong></td></tr>	
															<tr>
																<td><input type="checkbox" name="large" value="Artificial Jewellery"> Artificial Jewellery </td>
																<td><input type="checkbox" name="large" value="Babycare"> Babycare </td>
																<td><input type="checkbox" name="large" value="Fashion Accessories"> Fashion Accessories </td>
																<td><input type="checkbox" name="large" value="Kid's Clothing"> Kid's Clothing </td>
																<td><input type="checkbox" name="large" value="Kid's Footwear"> Kid's Footwear </td>
																<td><input type="checkbox" name="large" value="Makeup"> Makeup </td>
															</tr>
															<tr>
															   <td><input type="checkbox" name="large" value="Men's Clothing"> Men's Clothing </td>
																<td><input type="checkbox" name="large" value="Men's Footwear"> Men's Footwear </td>
																<td><input type="checkbox" name="large" value="Precious Jewellery"> Precious Jewellery </td>
																<td><input type="checkbox" name="large" value="Perfumes"> Perfumes </td>
																<td><input type="checkbox" name="large" value="Storts & Fitness"> Storts & Fitness </td>
																<td><input type="checkbox" name="large" value="Sunglasses"> Sunglasses </td>
															</tr>
															<tr>
																<td><input type="checkbox" name="large" value="Toys"> Toys </td>
																<td><input type="checkbox" name="large" value="Watches"> Watches </td>
																<td><input type="checkbox" name="large" value="Women's Clothing"> Women's Clothing </td>
																<td><input type="checkbox" name="large" value="Women's Footwear"> Women's Footwear </td>
															</tr>
														</table>
													</td>
												</tr>
												<tr>
													<td>
														<table>
															<tr><td colspan="4"><strong>Electronics, Kitchen & Healthcare Appliances</strong></td></tr>	
															<tr>
																<td><input type="checkbox" name="large" value="Audio and Video players"> Audio and Video players </td>
																<td><input type="checkbox" name="large" value="Camera & Accessories"> Camera & Accessories </td>
																<td><input type="checkbox" name="large" value="Computer accessory and components"> Computer accessory and components </td>
																<td><input type="checkbox" name="large" value="Electronis Stroage"> Electronis Stroage </td>
															</tr>
															<tr>
																<td><input type="checkbox" name="large" value="Gaming Hardware & Media"> Gaming Hardware & Media </td>
																<td><input type="checkbox" name="large" value="Home and Kitchen Appliances"> Home and Kitchen Appliances </td>
																<td><input type="checkbox" name="large" value="Speakers"> Speakers </td>
																<td><input type="checkbox" name="large" value="Networking & Cables"> Networking & Cables </td>
															</tr>
															<tr>
																<td><input type="checkbox" name="large" value="Mobile Accessories"> Mobile Accessories </td>
																<td><input type="checkbox" name="large" value="Mobile and Tablets"> Mobile and Tablets </td>
																<td><input type="checkbox" name="large" value="Softwares"> Softwares </td>
																<td><input type="checkbox" name="large" value="Laptop and computer system"> Laptop and computer system </td>
															</tr>
															<tr>
																<td><input type="checkbox" name="large" value="Personal and Healthcare Appliances"> Personal and Healthcare Appliances </td>
															</tr>
														</table>
													</td>
												</tr>
												<tr>
													<td>
														<table>
															<tr><td colspan="4"  ><strong> FMCG, Books & Media </strong></td></tr>
										
															<tr>
																<td ><input type="checkbox" name="large" value="Books"> Books </td>
																<td ><input type="checkbox" name="large" value="Home Care"> Home Care </td>
																<td ><input type="checkbox" name="large" value="Office Supplies"> Office Supplies </td>
																<td ><input type="checkbox" name="large" value="eLearning(Digital)"> eLearning(Digital) </td>
															</tr>
															<tr>
																<td ><input type="checkbox" name="large" value="Eye care"> Eye care </td>
																<td ><input type="checkbox" name="large" value="Media(Movies, Music)"> Media(Movies, Music) </td>
																<td ><input type="checkbox" name="large" value="Health & Beauty(non-Perfumes & non-Makeup)"> Health & Beauty(non-Perfumes & non-Makeup) </td>
																<td ><input type="checkbox" name="large" value="Sexual Wellness"> Sexual Wellness </td>
															</tr>
															<tr>
																<td ><input type="checkbox" name="large" value="Pet Supplies"> Pet Supplies </td>
																<td ><input type="checkbox" name="large" value="Women Supplies"> Women Supplies </td>
																<td ></td>
																 <td ></td>
															</tr>
														</table>
													</td>
												</tr>
												<tr>
													<td> 
														<table>
															<tr><td colspan="3"><strong> Car & Auto Accessories </strong></td></tr>
															<tr>
																<td ><input type="checkbox" name="large" value="Car & Auto Accessories"> Car & Auto Accessories </td>
																<td ></td>
																<td></td>
															</tr>
														</table>
													</td>
												</tr>
												<tr>
													<td>
														<table>			
															<tr><td colspan="5"  ><strong>Home</strong></td></tr>
										
															<tr>
																<td ><input type="checkbox" name="large" value="Furniture"> Furniture </td>
																<td ><input type="checkbox" name="large" value="Home Decor"> Home Decor </td>
																<td ><input type="checkbox" name="large" value="Home Furnishing"> Home Furnishing </td>
																<td ><input type="checkbox" name="large" value="Tools & Hardwares"> Tools & Hardwares </td>
																<td><input type="checkbox" name="large" value="Household"> Household </td>
															</tr>
														</table>
													</td>
												</tr>
			<!--<tr>
			<td colspan="4">Other Category* : <input type="text" name="other_cat" class="text2"> Enter you category if you didnot find it above</td>
			</tr>-->
										
										
										
												<tr>
													<td>Do you sell product online by own website or registered with another e-Commence website as seller<br>
														<input type="radio" name="imgsel" id="item_shipping_true" value="yes" /> Yes
														<input type="radio" name="imgsel" id="item_shipping_false" value="no" checked="checked" /> No  
														<br>
														<input type="text" class="text2" id="sell_online_input" />
													</td>
												</tr>
										
												<tr>
													<td>Where did you hear about us ?
														<select class="text2" id="here_about" onChange="here_about_us(this.value)">
															<option> --- Select --- </option>
															<option value="from advertisement">From Advertisement</option>
															<option value="from google">From Google</option>
															<option value="from other market place">From other Market Place</option>
															<option value="from my friend">From my friend</option>
														</select>
													</td>
												</tr>
										
												<!-- On 27/10/15
												<tr>
													<td><input type="checkbox"> I have read and agree to comply with and/or be bound by the Terms and Conditions of Moonboy</td>
												</tr>-->
                                        
												<tr>
<?php $seller_id = $this->session->userdata('seller-session'); ?>
													<td>
														<input type="hidden" name="hidden_session_id" id="session_seller_id" value="<?php echo $seller_id; ?>">
														<input type="button" name="submit" id="verify_submit_id" class="seller_buttons" value="Continue" onClick="submit_category()">
													</td>
												<!--<td><div id="category"></div></td>-->
												</tr>
											</tbody>
										</table>
								</div>
							<!--</form>-->
						</div>
					</div>
				</div>  <!-- @end #main-content -->
                

			<!--</div><!-- @end #content -->
		<!--</div><!-- @end #w -->
	<!--</body>
</html>-->