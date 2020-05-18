<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content = "width = device-width, initial-scale =1.0, user-scalable = no">
		<meta name="<?php echo $data1->meta_descrp ;?>" content="">
        <meta name="<?php echo $data1->meta_keyword ;?>" content="" />

		<title><?php echo $data1->title ;?></title>

<?php include "header.php" ?>

<style>
.main-content {
    padding: 100px 0px 10px;
	width:100%;
}
.category h4 {
    font-size: 19px;
}

.my_account_menu>h5 {
    font-size: 14px;
}
.title3 {
    font-size: 26px;
	margin-bottom: 10px;
	margin-top: -4px;
}
</style>		
			
<!------ Start Content ------>

<div class="main-content">
<!--
	<div class="main-content_inn">
		<form name="persional_info_form" class="persional_info_form">
        	<input type="text">
        </form>
    </div>-->
    <div style="width:90%; margin:auto;">
    <div class="off-section">
		<div class="left-nav">
        	<?php include'profile_menu.php'; ?>
        </div>
	</div>
    
    <div class="profile-right">
    	<div id="load_form">
        	<h2 class="title3">Change Password</h2>
            	<table class="account_form">
                	<tr>
                    	<td width="150px">Old Password</td>
        				<td>
                        	<input type="password" class="input-text" name="old_pass" id="old_pass">
                            <span class="req pass1"> This field is required.</span>
                        </td>
                    </tr>
                    <tr>
                    	<td>New Password</td>
        				<td>
                        	<input type="password" class="input-text" name="change_new_pass" id="change_new_pass">
                            <span class="req pass2"> This field is required.</span>
                        </td>
                    </tr>
                    <tr>
                    	<td>Retype New Password</td>
        				<td>
                        	<input type="password" class="input-text" name="change_rnew_pass" id="change_rnew_pass">
                            <span class="req pass3"> This field is required.</span>
                        </td>
                    </tr>
                    <tr>
        				<td colspan="2">
                        	<input  type="submit" class="btn-sign-in" id="change_pass_btn" onClick="changePassword()" value="Save Changes">
                        </td>
                    </tr>
                    <tr id="show_ssmsg">
                    	<td colspan="2">
                        	<div id="show_ssmsg_dv"></div>
                        </td>
                    </tr>
                </table>
        </div>
    </div>
</div>
<div class="clearfix">&nbsp;</div>


<?php include "footer.php" ?>

<script>
function changePassword(){
	var old_pass = $('#old_pass').val();
	var change_new_pass = $('#change_new_pass').val();
	var change_rnew_pass = $('#change_rnew_pass').val();
	if(old_pass == ''){
		$('#old_pass').css('border-color','red');
		$('#old_pass').focus();
		$('.pass1').show();
		return false;
	}else if(change_new_pass == ''){
		$('#old_pass').css('border-color','#ebebeb');
		$('.pass1').hide();
		$('#change_new_pass').css('border-color','red');
		$('#change_new_pass').focus();
		$('.pass2').show();
		return false;
	}else if(change_rnew_pass == ''){
		$('#old_pass').css('border-color','#ebebeb');
		$('#change_new_pass').css('border-color','#ebebeb');
		$('.pass1').hide();
		$('.pass2').hide();
		$('#change_rnew_pass').css('border-color','red');
		$('#change_rnew_pass').focus();
		$('.pass3').show();
		return false;
	}else if(change_new_pass != change_rnew_pass){
		$('#old_pass').css('border-color','#ebebeb');
		$('#change_new_pass').css('border-color','#ebebeb');
		$('.pass1').hide();
		$('.pass2').hide();
		$('#change_rnew_pass').css('border-color','red');
		$('#change_rnew_pass').select();
		$('.pass3').show();
		$('.pass3').text('Password mismatch.');
		return false;
	}else{
		$('#old_pass').css('border-color','#ebebeb');
		$('#change_new_pass').css('border-color','#ebebeb');
		$('#change_rnew_pass').css('border-color','#ebebeb');
		$('.pass1').hide();
		$('.pass2').hide();
		$('.pass3').hide();
		
		$('#change_pass_btn').val('Processing...');
		$.ajax({
			url:'<?php echo base_url(); ?>user/changed_password',
			method:'post',
			data:{opass:old_pass,npass:change_new_pass},
			success:function(result)
			{
				
				if(result == 'changed_success'){
					$("#show_ssmsg_dv").html('<img src="<?php echo base_url(); ?>images/success_icon.png"> &nbsp;Password changes have been saved successfully.');
					$("#show_ssmsg_dv").css({'background-color':'#deffd0','border':'1px solid #009700','color':'green'})
					$("#show_ssmsg").fadeIn();
					$('#change_pass_btn').val('Save Changes');
					$('#old_pass').val('');
					$('#change_new_pass').val('');
					$('#change_rnew_pass').val('');
				}
				if(result == 'invalid_pass'){
					$("#show_ssmsg_dv").html('<img src="<?php echo base_url(); ?>images/error.png"> &nbsp;Invalid old password');
					$("#show_ssmsg_dv").css({'background-color':'pink','border':'1px solid salmon','color':'#d8000c'})
					$("#show_ssmsg").fadeIn();
					$('#change_pass_btn').val('Save Changes');
					$('#old_pass').val('');
					$('#change_new_pass').val('');
					$('#change_rnew_pass').val('');
				}
			}
		});
		
	}
}
</script>

</body>

</html>