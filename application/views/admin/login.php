<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=COMPANY?> :: SuperAdmin</title>
<link href="<?php echo base_url(); ?>css/admin/styles.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="login">
 <h1>Log in</h1>
	<div class="req_err_dv">
		<?php echo validation_errors();?>
        <?php echo '<p>'.$this->session->flashdata('invalid_uname').'</p>'; ?>
    </div>
	<?php
		$attributes = array('class' => 'admin_login_form', 'name' => 'admin_login_form');
		echo form_open('admin/super_admin/login',$attributes) ;	
	?>
	<table align="center" cellpadding="5px">
    	<tr>
            <td><input type="text" name="username"  placeholder="Username"></td>
        </tr>
        <tr>
            <td><input type="password" name="password"  placeholder="Password"></td>
        </tr>
        <tr>
            <td colspan="3" align="center"><input type="submit" name="submit" value="Login"></td>
        </tr>
    </table>
    <?php echo form_close(); ?>
</div>

</body>
</html>
