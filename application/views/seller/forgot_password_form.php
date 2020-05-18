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
	</head>
	
	<body>
		<div class="forgot_pass_outer">
			<div class="forgot_pass_inner">
			<?php
			$attributes = array('class' => 'forgot_pass_form', 'name' => 'pass_retrieve_form');
			echo form_open('seller/seller/forgot_passord', $attributes);
			?>	
				<!--<form class="forgot_pass_form">-->
					<table>
						<h3>Retrieve Password </h3>
						<tr> 
							<td>
								<input type="text" name="email" class="seller_login_input" placeholder="Enter your email addrsss">
							</td>
						</tr>
                        <tr> 
							<td>
								<input type="submit" name="submit" value="Generate OTP">
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</body>
</html>