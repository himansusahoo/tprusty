<!doctype html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Dashboard</title>
		<meta name="author" content="">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>css/admin/styles.css">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>css/admin/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>css/admin/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
		
		<!--  JS for Google reCaptach start here -->
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
        <!--  JS for Google reCaptach End here -->
		
	</head>
	
	<body>
		
				<div class="signup_outer">
					<div class="signup_inner">
						<h3 class="a-center">Account Creation</h3>
						<hr>
<?php if(validation_errors()) : ?>
<h4 class="validation_error a-center"><?php echo validation_errors(); ?></h4>
<?php
endif;
$attributes = array('name' => 'register_form');
			echo form_open('seller/seller/seller_signup', $attributes);
?>	
						<!--<form>-->
							<table>
								<tr>
									<td width="40%" class="seller_label"> Your name : </td>
									<td width="50%"><input type="text" class="seller_input" name="name" value=""></td>
								</tr>
								<tr>
									<td class="seller_label"> Your e-mail address : </td>
									<td><input type="text" class="seller_input readonly_field" name="email" value="<?php echo $email;?>" readonly></td>
								</tr>
								<tr>
									<td></td>
									<td><input type="hidden" class="seller_input" name="mobile" value="<?php echo $mobile;?>"></td>
								</tr>
								<tr>
									<td class="seller_label"> Your city pincode : </td>
									<td><input type="text" class="seller_input" name="pincode" value=""></td>
								</tr>
								<tr>
									<td class="seller_label"> Address : </td>
									<td><textarea name="address" class="textarea" rows="5" cols="32"></textarea></td>
								</tr>
								<tr>
									<td class="seller_label"> City : </td>
									<td><input type="text" class="seller_input" name="city" value=""></td>
								</tr>
								<tr>
									<td class="seller_label"> State : </td>
									<td>
                                    	<select class="seller_input" name="state">
                                        	<option value="">-- Select State --</option>
                                            <?php 
												$query = $this->db->query("select * from state");  
												$rows = $query->num_rows();
												if($rows > 0){
													foreach($query->result() as $rs){
													?>
                                                    	<option value="<?=$rs->state?>"><?=$rs->state?></option>
                                                    <?php
													}
												}
											?>
                                        </select>
                                    </td>
								</tr>
                               <!-- <tr>
									<td class="seller_label"> State : </td>
									<td><input type="text" class="seller_input" name="state" value=""></td>
								</tr>-->
								<!--<tr>
									<td> Your main selling category : </td>
									<td>
										<select class="seller_input" name="selling_category">
											<option value=""> --Select your main category-- </option>
											<optgroup label="Large">
												<option value="Adjustable Dumbells">Adjustable Dumbells</option>
												<option value="Bicycles">Bicycles</option>
												<option value="Air Conditioner">Air Conditioner</option>
												<option value="Bench">Bench</option>
												<option value="Cross Trainer">Cross Trainer</option>
												<option value="Gas Stove">Gas Stove</option>
												<option value="Home Gyms">Home Gyms</option>
												<option value="Microwaves">Microwaves</option>
												<option value="Refrigerator">Refrigerator</option>
												<option value="TV">TV</option>
												<option value="Treadmill">Treadmill</option>
												<option value="Exercise Bike">Exercise Bike</option>
												<option value="Washing Machine">Washing Machine</option>
											</optgroup>
											<optgroup label="Lifestyle">
												<option value="Artificial Jewellery">Artificial Jewellery</option>
												<option value="Babycare">Babycare</option>
												<option value="Fashion Accessories">Fashion Accessories</option>
												<option value="Kid's Clothing">Kid's Clothing</option>
												<option value="Kid's Footwear">Kid's Footwear</option>
												<option value="Makeup">Makeup</option>
												<option value="Men's Clothing">Men's Clothing</option>
												<option value="Men's Footwear">Men's Footwear</option>
												<option value="Precious Jewellery">Precious Jewellery</option>
												<option value="Perfumes">Perfumes</option>
												<option value="Storts & Fitness">Storts & Fitness</option>
												<option value="Sunglasses">Sunglasses</option>
												<option value="Toys">Toys</option>
												<option value="Watches">Watches</option>
												<option value="Women's Clothing">Women's Clothing</option>
												<option value="Women's Footwear">Women's Footwear</option>
											</optgroup>
											<optgroup label="Electronics, Kitchen & Healthcare Appliances">
												<option value="Audio and Video players">Audio and Video players</option>
												<option value="Camera & Accessories">Camera & Accessories</option>
												<option value="Computer accessory and components">Computer accessory and components</option>
												<option value="Electronis Stroage">Electronis Stroage</option>
												<option value="Gaming Hardware & Media">Gaming Hardware & Media</option>
												<option value="Home and Kitchen Appliances">Home and Kitchen Appliances</option>
												<option value="Speakers">Speakers</option>
												<option value="Networking & Cables">Networking & Cables</option>
												<option value="Mobile Accessories">Mobile Accessories</option>
												<option value="Mobile and Tablets">Mobile and Tablets</option>
												<option value="Softwares">Softwares</option>
												<option value="Laptop and computer system">Laptop and computer system</option>
												<option value="Personal and Healthcare Appliances">Personal and Healthcare Appliances</option>
											</optgroup>
											<optgroup label="FMCG, Books & Media">
												<option value="Books">Books</option>
												<option value="Home Care">Home Care</option>
												<option value="Office Supplies">Office Supplies</option>
												<option value="eLearning(Digital)">eLearning(Digital)</option>
												<option value="Eye care">Eye care</option>
												<option value="Media(Movies, Music)">Media(Movies, Music)</option>
												<option value="Health & Beauty(non-Perfumes & non-Makeup)">Health & Beauty(non-Perfumes & non-Makeup)</option>
												<option value="Pet Supplies">Pet Supplies</option>
												<option value="Sexual Wellness">Sexual Wellness</option>
												<option value="Women Supplies">Women Supplies</option>
											</optgroup>
											<optgroup label="Car & Auto Accessories">
												<option value="Car & Auto Accessories">Car & Auto Accessories</option>
											</optgroup>
											<optgroup label="Home">
												<option value="Furniture">Furniture</option>
												<option value="Home Decor">Home Decor</option>
												<option value="Home Furnishing">Home Furnishing</option>
												<option value="Tools & Hardwares">Tools & Hardwares</option>
												<option value="Household">Household</option>
											</optgroup>
										</select>
									</td>
								</tr>-->
								<tr>
									<td class="seller_label"> Create password : </td>
									<td><input type="password" class="seller_input" name="pwd" value=""></td>
								</tr>
								<tr>
									<td class="seller_label"> Retype your password : </td>
									<td><input type="password" class="seller_input" name="cnfpwd" value=""></td>
								</tr>
								<tr>
									<td></td>
									<td>
									<div class="g-recaptcha" data-sitekey="6LcR4w8TAAAAADUpAdk9LdyrIVZCdSXCLXMXEZcr"></div>
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<input type="submit" class="seller_buttons" name="submit" value="Signup">
									</td>
								</tr>
							</table>
						</form>
					</div>
				</div>  <!-- @end #main-content -->
			<!--</div><!-- @end #content -->
		<!--</div><!-- @end #w -->
	</body>
</html>