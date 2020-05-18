<?php
require_once('header.php');
?>

<link rel="stylesheet" href="<?php echo base_url();?>css/admin/colorbox.css" />
<script src="<?php echo base_url();?>js/jquery.colorbox.js"></script>


<!--<script type="text/javascript" src="<?//php echo base_url();?>js/jquery.min.js"></script>-->
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-contained-sticky-scroll.js"></script>
<!--<script type="text/javascript" src="<?//php echo base_url();?>js/jquery-contained-sticky-scroll-min.js"></script>-->
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('#sidebar').containedStickyScroll();
	});
</script>

<script>
	$(document).ready(function(){
		$(".inline").colorbox({inline:true, width:"50%"});
		$(".inline").colorbox({'overlayClose': false, 'escKey': false});
		
		// For password changing
		$("#pass_form_open").click(function(){
			$(this).hide();
			$("div #slide_pass_form").slideDown();
		});
		$("#cancelLoginForm").click(function(){
			$("#pass_form_open").show();
			$("div #slide_pass_form").slideUp(20);
		});
		
		// For Primary Contact
		$("#primary_contact_edit").click(function(){
			$("#primary_contact").hide();
			$("table#primary_cont_hide").show();
		});
		$("#cancelPContactForm").click(function(){
			$("#primary_contact").show();
			$("table#primary_cont_hide").hide();
		});
		
		// For changing Bank Details
		$("#bank_account_edit").click(function(){
			$("#bank_account").hide();
			$("table#bank_account_hide").show();
		});
		$("#cancelBankACForm").click(function(){
			$("#bank_account").show();
			$("table#bank_account_hide").hide();
		});
		
		//$('ul.nav').find('a').click(function(){
		$('ul.nav li a').click(function(){
			$(this).closest('li').addClass('active').siblings().removeClass('active');
			var $href = $(this).attr('href');
			var $anchor = $('#'+$href).offset();
			window.scrollTo($anchor.left,$anchor.top);
			return false;
		});
		
		
		//$("#changePContactSave").click(function(){
//			var base_url = "<?php //echo base_url(); ?>";
//			var controller = "seller/account";
//			var p_name = $("input[name=p_name]").val(); 
//			var p_email = $("input[name=p_email]").val(); 
//			var p_mobile = $("input[name=p_mobile]").val();
//			$("#pname_val").val(p_name);
//			$("#pemail_val").val(p_email);
//			$("#pmobile_val").val(p_mobile);
//			$.ajax({
//				'url' : base_url + controller + '/mail_send_change_pmobile',
//				'type' : 'POST',
//				'data' : 'name='+p_name+'&email='+p_email+'&mobile='+p_mobile ,
//			}); 
//		});
//		
	});
	
	function submit_opt(){
		var base_url = "<?php echo base_url(); ?>";
		var controller = "seller/account";  
		//var otp = $('#otp').val();
		//var name = $('#pname_val').val();
//		var email = $('#pemail_val').val();
//		var mobile = $('#pmobile_val').val();

		var name = $("input[name=p_name]").val();
		var email = $("input[name=p_email]").val();
		var mobile = $("input[name=p_mobile]").val();
		
		//if(otp == ""){
			//$("#otp_validate").focus();
			//$("#otp_validate").show().text("Please enter correct OTP.");
			//return false;
		//}else{
			$.ajax({
				'url' : base_url + controller + '/otp_verificationForPcontact',
				'type' : 'POST',
				//'data' : 'name='+ name +'&email=' + email + '&otp=' + otp +'&mobile=' + mobile,
				'data' : {name:name,email:email,mobile:mobile},
				'success' : function(data){
					//$.colorbox.close();
					if(data == 'success'){
						$('#success_PContact').html("<div style='color:green;'>Primary contact details updated successfully.</div>");
						setTimeout(function() { window.location.reload(true); }, 3000);
					}else{
						$('#success_PContact').html("<div style='color:red;'>Primary contact details updatation Failed.</div>");
						setTimeout(function() { window.location.reload(true); }, 3000);
					}
				}
			});	
		//}
	}
	
	function change_password(){
		var base_url = "<?php echo base_url(); ?>";
		var controller = "seller/account"; 
		var old_pass = $("input[name=old_pass]").val();  
		var new_pass = $("input[name=new_pass]").val();  
		var cnf_pass = $("input[name=cnf_pass]").val();  //alert(old_pass); return false;
		$.ajax({
			'url' : base_url + controller + '/change_password',
			'type' : 'POST',
			'data' : 'old_pass='+old_pass+'&new_pass='+new_pass+'&cnf_pass='+cnf_pass ,
			'success' : function(data){
				$('#success_pass').html(data);
				$("#pass_form_open").show();
				$("div #slide_pass_form").slideUp(20);
				//document.getElementById("review_from").reset();
			}
		});
	}
	function change_PContact(){
		var base_url = "<?php echo base_url(); ?>";
		var controller = "seller/account";
		var p_name = $("input[name=p_name]").val(); 
		var p_email = $("input[name=p_email]").val(); 
		var p_mobile = $("input[name=p_mobile]").val(); 
		$.ajax({
			'url' : base_url+controller+'/change_PContact',
			'type' : 'POST',
			'data' : 'p_name='+p_name+'&p_email='+p_email+'&p_mobile='+p_mobile,
			'success' : function(data){
				//$('#success_PContact').html(data);
				//$("table#primary_cont_hide").hide();
				//$("#primary_contact").show();
				//$("div #slide_pass_form").slideUp(20);
				//document.getElementById("review_from").reset();
				if(data == 'success'){
					window.location.reload(true);
				}
			}
		});
	}
	function change_BankAC(){
		var base_url = "<?php echo base_url(); ?>";
		var controller = "seller/account";
		var ac_holder_name = $("input[name=ac_holder_name]").val();
		var ac_number = $("input[name=ac_number]").val();
		var cnf_ac_number = $("input[name=cnf_ac_number]").val();
		var bank_name = $("input[name=bank_name]").val();
		var bank_city = $("input[name=bank_city]").val();
		var bank_branch = $("input[name=bank_branch]").val();
		var bank_IFSC = $("input[name=bank_IFSC]").val();
		if(ac_holder_name == ""){
			alert("Please enter account Holder Name.");
			$("input[name=ac_holder_name]").focus();
			return false;
		}else if(ac_number == ""){
			alert("Please enter account Number.");
			$("input[name=ac_number]").focus();
			return false;
		}else if(cnf_ac_number == ""){
			alert("Please enter confirm account Number.");
			$("input[name=cnf_ac_number]").focus();
			return false;
		}else if(ac_number != cnf_ac_number){
			alert("Account number and confirm account Number must same.");
			$("input[name=cnf_ac_number]").focus();
			return false;
		}else if(bank_name == ""){
			alert("Please enter Bank Name.");
			$("input[name=bank_name]").focus();
			return false;
		}else if(bank_city == ""){
			alert("Please enter Bank City.");
			$("input[name=bank_city]").focus();
			return false;
		}else if(bank_branch == ""){
			alert("Please enter Branch of Bank.");
			$("input[name=bank_branch]").focus();
			return false;
		}else if(bank_IFSC == ""){
			alert("Please enter IFS Code.");
			$("input[name=bank_IFSC]").focus();
			return false;
		}else{
			$.ajax({
				'url' : base_url+controller+'/change_bankAC_details',
				'type' : 'POST',
				'data' : 'ac_holder_name='+ac_holder_name+'&ac_number='+ac_number+'&cnf_ac_number='+cnf_ac_number+'&bank_name='+bank_name+'&bank_city='+bank_city+'&bank_branch='+bank_branch+'&bank_IFSC='+bank_IFSC,
				'success' : function(data){
					//$('#success_PContact').html(data); return false;
					if(data == 'success'){
						window.location.reload(true);
					}
				}
			});
		}
	}
</script>

			<div id="content">    
				 <div class="top-bar">
					<div class="top-left">
						<ul class="top-menu">
							<li class="selected"><a href="<?php echo base_url(); ?>seller/account">My Profile</a></li>
						</ul>
					</div>
										
					<!-- header_session included here -->
					<?php
					require_once('header_session.php');
					?>
				</div>  <!-- @end top-bar  -->
				
				<!-- 31 <?php
				$seller_signup_id = $this->session->userdata('seller-signup-session');
				if(!$seller_signup_id) : 
				?>
							<div style="padding-top:60px; margin:0px 50px;">
								<div class="alert alert-danger" role="alert"> *Important ! You have not completed signup. To complete click <a href="<?//php echo base_url();?>seller/seller/incomplete_signup"><strong>here</strong></a></div>
							</div>
				<?php
				endif;
				?>-->
				<div class="main-content">
						<?php require_once('common.php'); ?>
<?php 
if($seller_details) :
	foreach($seller_details as $seller_detail):
 ?>
					<div class="page_header">
						<div class="left">
							<h3>Manage Profile</h3>
						</div>
						<div class="clear"></div>
					</div>
					<div class="tab_content">
						<div class="row">
							<div class="col-md-3 sidebar" id="sidebar">
								<ul id="manage_prof_sidemenu" class="nav nav-pills nav-stacked">
									<li class="profile_sidemenu_header">ACCOUNT</li>
									<li class="active"><a href="#info">Display Information</a></li>
									<li><a href="#address">Pickup Address</a></li>
									<li><a href="#login">Login Details</a></li>
									<li><a href="#contact">Primary Contact</a></li>
									
									<li class="profile_sidemenu_header">BUSINESS</li>
									<li><a href="#business">Business Details</a></li>
									<li><a href="#bank">Bank Account</a></li>
									<li><a href="#kyc">KYC Documents</a></li>
									
									<li class="profile_sidemenu_header">SELLER SUPPORT</li>
									<li><a href="#seller_support">Contact Seller Support</a></li>
								</ul>
							</div>

							<div class="manage_profile col-md-9">
								<div class="tab-pane active">
									<div class="row display_info" id="info">
										<div class="header">
											<span>Display Information</span>
											<!--<a class="right" href="#">
												<i class="icon-pencil"></i>
												Edit
											</a>-->
											<hr style="margin-top:10px;">
										</div>
										<form>
											<table>
												<tr>
													<td width="30%">
														Your display name :<br>
														<span class="visibletobuyertext">(Visible to buyers)</span>
													</td>
													<td width="70%">
														<span><?php echo $seller_detail->business_name; ?></span>
													</td>
												</tr>
												<tr>
													<td>Describe your business :<br></td>
													<td>
														<span><?php echo $seller_detail->business_desc; ?></span>
													</td>
												</tr>
												<!--<tr>
													<td>Returns and refunds policy</td>
													<td><a href="#">Click here for Return Policy</a></td>
												</tr>-->
											</table>
										</form>
									</div>
									<div class="row display_info" id="address">
										<div class="header">
											<span>Pickup Address</span>
											<hr style="margin-top:10px;">
										</div>
										<form>
											<table>
												<tr>
													<td width="30%">
														Address :
													</td>
													<td width="70%">
														<span><?php echo $seller_detail->seller_address; ?></span>
													</td>
												</tr>
												<!--<tr>
													<td>Address Line 2 :</td>
													<td>
														<span>OPP. SRINATHJI MEDICAL,  NR. SAYIEDPURA PETROL PUMP SAYIEDPURA</span>
													</td>
												</tr>-->
												<tr>
													<td>Pin code :</td>
													<td><?php echo $seller_detail->pincode ; ?></td>
												</tr>
												<tr>
													<td>Your pickup city :</td>
													<td><?php echo $seller_detail->seller_city; ?></td>
												</tr>
											</table>
										</form>
									</div>
									<div class="row display_info" id="login">
										<div class="header">
											<span>Login Details</span>
											<hr style="margin-top:10px;">
										</div>
										<form>
											<table>
												<tr>
													<td width="30%">Your name :</td>
													<td width="70%">
														<span><?php echo $seller_detail->name; ?></span>
													</td>
												</tr>
												<tr>
													<td>Your mobile number :</td>
													<td>
														<span><?php echo $seller_detail->mobile; ?></span>
													</td>
												</tr>
												<tr>
													<td>Your email address :</td>
													<td><?php echo $seller_detail->email; ?></td>
												</tr>
												<tr>
													<td></td>
													<td id="success_pass"></></td>
												</tr>

												<tr>
													<td></td>
													<td><button type="button" class="seller_buttons" id="pass_form_open">Change Password</button></td>
												</tr>
												<div>
													<table id="slide_pass_form" style="display:none;">
														<tr>
															<td width="">Enter old password</td>
															<td width="">
																<input type="password" name="old_pass" class="seller_input" value="">
															</td>
														</tr>
														<tr>
															<td width="30%">Enter new password</td>
															<td width="70%">
																<input type="password" name="new_pass" class="seller_input" value="">
															</td>
														</tr>
														<tr>
															<td width="30%">Retype new password</td>
															<td width="70%">
																<input type="password" name="cnf_pass" class="seller_input" value="">
															</td>
														</tr>
														<tr>
															<td></td>
															<td>
																<button class="seller_buttons" id="changePasswordSave" type="button" onclick="change_password()">Save</button>
																<button class="seller_buttons" id="cancelLoginForm" type="button">Cancel</button>
															</td>
														</tr>
													</table>
												</div>
											</table>
										</form>
									</div>
									<div class="row display_info" id="contact">
										<div class="header">
											<span>
												Primary Contact
												<small class="visibletobuyertext" style="font-weight: normal; margin-left: 15px;">All confirmations, updates, transaction details, and other business communications will be sent to this primary contact</small>
											</span>
											<input type="button" class="seller_buttons right" id="primary_contact_edit" value="Edit" />
												<!--<i class="icon-pencil right"></i>-->
											<hr style="margin-top:10px;">
										</div>
										<form>
											<table id="primary_cont_hide" style="display:none;">
                                            	<tr>
													<td></td>
													<td id="success_PContact"></></td>
												</tr>
												<tr>
													<td width="30%">Name</td>
													<td width="70%"><input type="text" name="p_name" class="seller_input" value="<?php echo $seller_detail->pname; ?>"></td>
												</tr>
												<tr>
													<td>Email address</td>
													<td>
														<input type="text" name="p_email" class="seller_input" value="<?php echo $seller_detail->pemail; ?>">
													</td>
												</tr>
												<tr>
													<td>Mobile number</td>
													<td><input type="text" name="p_mobile" class="seller_input" value="<?php echo $seller_detail->pmobile; ?>"></td>
												</tr>
												<tr>
													<td></td>
													<td>
														<!--<button class="seller_buttons" id="changePContactSave" type="button" onclick="change_PContact()">Save</button>-->
                                                        <!--<button class="seller_buttons" id="changePContactSave" type="button">Save</button>-->
                                                       <!-- <a class='inline' href="#inline_content1234">
                                                            <input type="button" id="changePContactSave" class="seller_buttons" value="Save">
                                                        </a>-->
                                                        <input type="button" id="changePContactSave" class="seller_buttons" onClick="submit_opt()" value="Save">
														<button class="seller_buttons" id="cancelPContactForm" type="button">Cancel</button>
													</td>
												</tr>
											</table>
                                            <div style="display:none">
                                            	<div id='inline_content1234' style='padding:10px; background:#fff;'>
                                                    <p>Verification Form</p>
                                                    <div>
                                                        Enter the OTP : <input type="text" id="otp" name="code" class="seller_input"> 
                                                        <input type="hidden" id="pname_val">
                                                        <input type="hidden" id="pemail_val">
                                                        <input type="hidden" id="pmobile_val">
                                                        <input type="button" name="submit" id="otp_submit" class="seller_buttons" value="Submit" onClick="submit_opt()">
                                                        <span class="error_msg" id="otp_validate"></span>
                                                    </div>
                                                </div>
                                            </div>
											<table id="primary_contact">
												<tr>
													<td></td>
													<td id="success_PContact"></></td>
												</tr>
												<tr>
													<td width="30%">Name :</td>
													<td width="70%"><span><?php echo $seller_detail->pname; ?></span></td>
												</tr>
												<tr>
													<td>Email address :</td>
													<td>
														<span><?php echo $seller_detail->pemail; ?></span>
													</td>
												</tr>
												<tr>
													<td>Mobile number :</td>
													<td><?php echo $seller_detail->pmobile; ?></td>
												</tr>
											</table>
										</form>
									</div>
									<div class="row display_info" id="business">
										<div class="header">
											<span>Business Details</span>
											<hr style="margin-top:10px;">
										</div>
										<form>
											<table>
												<tr>
													<td width="30%">Business name :</td>
													<td width="70%"><span><?php echo $seller_detail->business_name; ?></span></td>
												</tr>
												<tr>
													<td>PAN ID :</td>
													<td><span><?php echo $seller_detail->pan; ?></span></td>
												</tr>
												<tr>
													<td>PAN Document :</td>
													<td>
														<img src="<?php echo base_url(); ?>images/seller_image_doc/<?php echo $seller_detail->pan_img; ?>" width="400">
													</td>
												</tr>
												<tr>
													<td>TIN :</td>
													<td><span><?php echo $seller_detail->tin; ?></span></td>
												</tr>	
												<tr>
													<td> TIN proof :</td>
													<td>
														<img src="<?php echo base_url(); ?>images/seller_image_doc/<?php echo $seller_detail->tin_img; ?>" width="400">
													</td>
												</tr>
												<?php if($seller_detail->tan_img) { ?>
												<tr>
													<td>TAN ID :</td>
													<td><span><?php echo $seller_detail->tan; ?></span></td>
												</tr>
												<tr>
													<td>TAN Document :</td>
													<td><img src="<?php echo base_url(); ?>images/seller_image_doc/<?php echo $seller_detail->tan_img; ?>" width="400"></td>
												</tr>
												<?php } ?>
<!-------------------------------sujit start gstin_img56ghi----------------------------------------->
												<?php if($seller_detail->gstin_img) { ?>
												<tr>
													<td>GSTIN ID :</td>
													<td><span><?php echo $seller_detail->gstin; ?></span></td>
												</tr>
												<tr>
													<td>GSTIN Document :</td>
													<td><img src="<?php echo base_url(); ?>images/seller_image_doc/<?php echo $seller_detail->gstin_img; ?>" width="400"></td>
												</tr>
												<?php } ?>



<!-----------------------------------------sujit end---------------------------------------------->                                                
											</table>
										</form>
									</div>
									<div class="row display_info" id="bank">
										<div class="header">
											<span>Bank Account</span>
											<!--<input class="seller_buttons right" type="button" id="bank_account_edit" value="Edit">-->
											<hr style="margin-top:10px;">
										</div>
										<form>
											<table id="bank_account_hide" style="display: none;">
												<tr>
													<td width="30%">Account Holder's Name</td>
													<td width="70%">
														<input type="text" name="ac_holder_name" class="seller_input" value="<?php echo $seller_detail->ac_holder_name; ?>" >
													</td>
												</tr>
												<tr>
													<td>Account number</td>
													<td><input type="text" name="ac_number" class="seller_input" value="<?php echo $seller_detail->ac_number; ?>" ></td>
												</tr>
												<tr>
													<td>Retype account number</td>
													<td><input type="text" name="cnf_ac_number" class="seller_input" value="<?php echo $seller_detail->ac_number; ?>" ></td>
												</tr>
												<tr>
													<td>Bank name</td>
													<td>
														<input type="text" name="bank_name" class="seller_input" value="<?php echo $seller_detail->bank; ?>" >
													</td>
												</tr>
												<tr>
													<td>City</td>
													<td>
														<input type="text" name="bank_city" class="seller_input" value="<?php echo $seller_detail->city; ?>" >
													</td>
												</tr>	
												<tr>
													<td> Branch</td>
													<td>
														<input type="text" name="bank_branch" class="seller_input" value="<?php echo $seller_detail->branch; ?>" >
													</td>
												</tr>
												<tr>
													<td>IFSC Code</td>
													<td>
														<input type="text" name="bank_IFSC" class="seller_input" value="<?php echo $seller_detail->ifsc_code; ?>" >
													</td>
												</tr>
												<tr>
													<td></td>
													<td>
														<button class="seller_buttons" id="changeBankACSave" type="button" onclick="change_BankAC()">Save</button>
														<button class="seller_buttons" id="cancelBankACForm" type="button">Cancel</button>
													</td>
												</tr>
											</table>
											<table id="bank_account">
												<tr>
													<td width="30%">Account Holder's Name :</td>
													<td width="70%"><span><?php echo $seller_detail->ac_holder_name; ?></span></td>
												</tr>
												<tr>
													<td>Account number :</td>
													<td><span><?php echo $seller_detail->ac_number; ?></span></td>
												</tr>
												<tr>
													<td>Bank name :</td>
													<td><?php echo $seller_detail->bank; ?></td>
												</tr>
												<tr>
													<td>City :</td>
													<td><?php echo $seller_detail->city; ?></td>
												</tr>	
												<tr>
													<td> Branch :</td>
													<td><?php echo $seller_detail->branch; ?></td>
												</tr>
												<tr>
													<td>IFSC Code :</td>
													<td><?php echo $seller_detail->ifsc_code; ?></td>
												</tr>
											</table>
										</form>
									</div>
									<div class="row display_info" id="kyc">
										<div class="header">
											<span>
												KYC Documents
												<small class="visibletobuyertext" style="font-weight: normal; margin-left: 15px;">Please submit documents belonging to bank account holder</small>
											</span>
											<hr style="margin-top:10px;">
										</div>
										<form>
											<table>
												<tr>
													<td width="30%">Upload address proof :</td>
													<td width="70%"><img src="<?php echo base_url(); ?>images/seller_image_doc/<?php echo $seller_detail->address_img; ?>" width="400"></td>
												</tr>
												<tr>
													<td>Upload ID proof :</td>
													<td><img src="<?php echo base_url(); ?>images/seller_image_doc/<?php echo $seller_detail->ID_img; ?>" width="400"></td>
												</tr>
												<tr>
													<td>Upload Cancelled Cheque :</td>
													<td><img src="<?php echo base_url(); ?>images/seller_image_doc/<?php echo $seller_detail->Cheque_img; ?>" width="400"></td>
												</tr>
											</table>
										</form>
									</div>
									<div class="row display_info" id="seller_support">
										<div class="header">
											<span>Seller Support</span>
											<hr style="margin-top:10px;">
										</div>
										<div>
											<p class="col-md-12">For any help regarding seller, Please mail us 'seller@moonboy.in'.</p>
										</div>
									</div>
								</div>
							</div>
<?php 
endforeach; 
endif;
?>
						</div>					
					</div>					
				</div>	<!-- @end tab_content -->				
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->
<style>
	#changePContactSave a{color:#fff;}
	.scrollFixIt{display:none;}
</style>

<?php
require_once('footer.php');
?>			