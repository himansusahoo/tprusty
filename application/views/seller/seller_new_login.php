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
	<script>
		function valid(){
			var pass = $(".forgot_pass_form input[name='pass']").val();
			var conf_pass = $(".forgot_pass_form input[name='cnf_pass']").val();
			if(pass != conf_pass){
				$("#pass_error").show();
				$(".forgot_pass_form input[name='pass']").val('');
				$(".forgot_pass_form input[name='pass']").css('border-color', 'red');
				$(".forgot_pass_form input[name='cnf_pass']").val('');
				$(".forgot_pass_form input[name='cnf_pass']").css('border-color', 'red');
				return false;
			}
		}
	</script>
	
	<body>
		<div class="forgot_pass_outer">
			<div class="forgot_pass_inner">
			<?php
			if (validation_errors()) :
			?>
			<h3 style="color: red;"><?php echo validation_errors(); ?></h3>
			<?php
			endif;
			$attributes = array('class' => 'forgot_pass_form', 'name' => 'new_login_form');
			echo form_open('seller/seller/forgot_pass_login', $attributes);
			?>	
				<!--<form class="forgot_pass_login">-->
					<table>
						<h3>Change your password</h3>
						<h5 id="pass_error" style="display: none;">Password and Confirm Password must be same.</h5>
						<tr> 
							<td>
								<input type="text" name="email" class="seller_login_input" value="<?php echo $email; ?>">
							</td>
						</tr>
						<tr> 
							<td>
								<input type="password" name="pass" class="seller_login_input" placeholder="Enter your password">
							</td>
						</tr>
						<tr> 
							<td>
								<input type="password" name="cnf_pass" class="seller_login_input" placeholder="Enter your confirm password">
							</td>
						</tr>
                        <tr> 
							<td>
								<input type="submit" name="submit" value="Login" onClick="return valid()">
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</body>
</html>