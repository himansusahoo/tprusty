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

			
<!------ Start Content ------>

<div class="main-content">
<!--
	<div class="main-content_inn">
		<form name="persional_info_form" class="persional_info_form">
        	<input type="text">
        </form>
    </div>-->
    <div class="off-section">
		<div class="left-nav">
        	<?php include'profile_menu.php'; ?>
        </div>
	</div>
    
    <div class="profile-right">
    	<div id="load_form">
        	<h2 class="title3">Profile Settings</h2>
        	<form name="account_form" class="account_form">
            	<table>
                	<tr>
                    	<td width="150px">Profile Name</td>
        				<td><input type="text" class="input-text" name="profile_name" placeholder="Profile Name"></td>
                    </tr>
                    <tr>
        				<td colspan="2">
                        	<input  type="submit" class="btn-sign-in hvr-sweep-to-right" value="Save Changes">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<div class="clearfix">&nbsp;</div>


<?php include "footer.php" ?>


</body>

</html>