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
        
        <script type= "text/javascript" src = "<?php echo base_url(); ?>js/countries.js"></script>

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
        	<h2 class="title3">Add a New Address</h2>
            	<table class="account_form">
                	<tr>
                    	<td width="150px">Name</td>
        				<td>
                        	<input type="text" class="input-text" name="full_name" id="full_name" value="<?=$user_result[0]->fname.' '.$user_result[0]->lname; ?>" placeholder="Name">
                            <span class="req ad1"> This field is required.</span>
                        </td>
                    </tr>
                    <tr>
                    	<td>Country</td>
        				<td>
                        	<select id="country" name ="country" class="input-text"></select>
                            <span class="req ad2"> This field is required.</span>
                       	</td>
                    </tr>
                    <tr>
                    	<td>State</td>
        				<td>
                        	<select name ="state" id ="state" class="input-text">
                            	<option value="">---select---</option>
                                <?php
								foreach($state_result as $state){
								?>
                                <option value="<?=$state->state_id; ?>"><?=$state->state; ?></option>
                                <?php } ?>
                            </select>
                            <span class="req ad3"> This field is required.</span>
                            <script language="javascript">
								//populateCountries("country", "state");
								populateCountries("country");
 							</script>
                        </td>
                    </tr>
                    <tr>
                    	<td>City</td>
        				<td>
                        	<input type="text" class="input-text" name="city" id="city" placeholder="City">
                            <span class="req ad4"> This field is required.</span>
                        </td>
                    </tr>
                    <tr>
                    	<td>Street Address</td>
        				<td>
                        	<textarea class="input-text" name="street_addrs" id="street_addrs" placeholder="Address"></textarea>
                            <span class="req ad5"> This field is required.</span>
                        </td>
                    </tr>
                    <tr>
                    	<td>Pincode</td>
        				<td>
                        	<input type="text" class="input-text" name="pincode" id="pincode" placeholder="Pincode">
                            <span class="req ad6"> This field is required.</span>
                        </td>
                    </tr>
                    <tr>
                    	<td>Mobile Number</td>
        				<td>
                        	<input type="text" class="input-text" name="mobile" maxlength="10" id="mobile" placeholder="Mobile">
                            <span class="req ad7"> This field is required.</span>
                        </td>
                    </tr>
                    <tr>
        				<td colspan="2">
                        	<input  type="submit" id="address_btn" onClick="saveAddress()" class="btn-sign-in" value="Save Changes">
                        </td>
                    </tr>
                    <tr id="show_ssmsg">
                    	<td colspan="2">
                        	<div id="show_ssmsg_dv"></div>
                        </td>
                    </tr>
                </table>
        </div>
        
        <?php if($result != ''){ ?>
        <div class="multi_address_dv">
        	<h4>Your Saved Address</h4>
            <?php 
			$sl=0;
			foreach($result as $row){
				$sl++; 
			?>
        	<div class="multi_address_dv_inn">
            	<strong><?php echo $row->full_name; ?></strong><br/>
                <span><?php echo $row->address ;?></span><br/>
                <span><?php echo $row->city.'-'.$row->pin_code ;?></span><br/>
                <span><?php echo $row->state.', '.$row->country ;?></span><br/>
                <span><?php echo 'Ph : '.$row->phone ;?></span><br/><br/>
                <span>
                	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="addrs" <?php if($user_result[0]->address_id == $row->address_id){ echo 'checked';} ?> onClick="setDefaultaddress(<?=$row->address_id; ?>)">&nbsp;&nbsp;Default Address<br/>
                    <?php if($user_result[0]->address_id != $row->address_id){ ?>
                	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="del<?=$sl; ?> del" onClick="deleteAddress(<?php echo $row->address_id; ?>,<?=$sl; ?>)">Delete address</span>
                    <?php } ?>
                </span>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
    </div>
<div class="clearfix">&nbsp;</div>


<?php include "footer.php" ?>

<script>
function saveAddress(){
	var full_name = $('#full_name').val();
	var country = $('#country').val();
	var state = $('#state').val();
	var city = $('#city').val();
	var address = $('#street_addrs').val();
	var pin = $('#pincode').val();
	var mob = $('#mobile').val();
	if(full_name == ''){
		$('#full_name').css('border-color','red');
		$('#full_name').focus();
		$('.ad1').show();
		return false;
	}else if(country == -1){
		$('#full_name').css('border-color','#ebebeb');
		$('.ad1').hide();
		$('#country').css('border-color','red');
		$('.ad2').show();
		return false;
	}else if(state == ''){
		$('#full_name').css('border-color','#ebebeb');
		$('#country').css('border-color','#ebebeb');
		$('.ad1').hide();
		$('.ad2').hide();
		$('#state').css('border-color','red');
		$('.ad3').show();
		return false;
	}else if(city == ''){
		$('#full_name').css('border-color','#ebebeb');
		$('#country').css('border-color','#ebebeb');
		$('#state').css('border-color','#ebebeb');
		$('.ad1').hide();
		$('.ad2').hide();
		$('.ad3').hide();
		$('#city').focus();
		$('#city').css('border-color','red');
		$('.ad4').show();
		return false;
	}else if(address == ''){
		$('#full_name').css('border-color','#ebebeb');
		$('#country').css('border-color','#ebebeb');
		$('#state').css('border-color','#ebebeb');
		$('#city').css('border-color','#ebebeb');
		$('.ad1').hide();
		$('.ad2').hide();
		$('.ad3').hide();
		$('.ad4').hide();
		$('#street_addrs').focus();
		$('#street_addrs').css('border-color','red');
		$('.ad5').show();
		return false;
	}else if(pin == ''){
		$('#full_name').css('border-color','#ebebeb');
		$('#country').css('border-color','#ebebeb');
		$('#state').css('border-color','#ebebeb');
		$('#city').css('border-color','#ebebeb');
		$('#street_addrs').css('border-color','#ebebeb');
		$('.ad1').hide();
		$('.ad2').hide();
		$('.ad3').hide();
		$('.ad4').hide();
		$('.ad5').hide();
		$('#pincode').focus();
		$('#pincode').css('border-color','red');
		$('.ad6').show();
		return false;
	}else if(isNaN(pin)){
		$('#full_name').css('border-color','#ebebeb');
		$('#country').css('border-color','#ebebeb');
		$('#state').css('border-color','#ebebeb');
		$('#city').css('border-color','#ebebeb');
		$('#street_addrs').css('border-color','#ebebeb');
		$('.ad1').hide();
		$('.ad2').hide();
		$('.ad3').hide();
		$('.ad4').hide();
		$('.ad5').hide();
		$('#pincode').select();
		$('#pincode').css('border-color','red');
		$('.ad6').show();
		$('.ad6').text('Invalid pin code.');
		return false;
	}else if(mob == ''){
		$('#full_name').css('border-color','#ebebeb');
		$('#country').css('border-color','#ebebeb');
		$('#state').css('border-color','#ebebeb');
		$('#city').css('border-color','#ebebeb');
		$('#street_addrs').css('border-color','#ebebeb');
		$('#pincode').css('border-color','#ebebeb');
		$('.ad1').hide();
		$('.ad2').hide();
		$('.ad3').hide();
		$('.ad4').hide();
		$('.ad5').hide();
		$('.ad6').hide();
		$('#mobile').focus();
		$('#mobile').css('border-color','red');
		$('.ad7').show();
		return false;
	}else if(isNaN(mob)){
		$('#full_name').css('border-color','#ebebeb');
		$('#country').css('border-color','#ebebeb');
		$('#state').css('border-color','#ebebeb');
		$('#city').css('border-color','#ebebeb');
		$('#street_addrs').css('border-color','#ebebeb');
		$('#pincode').css('border-color','#ebebeb');
		$('.ad1').hide();
		$('.ad2').hide();
		$('.ad3').hide();
		$('.ad4').hide();
		$('.ad5').hide();
		$('.ad6').hide();
		$('#mobile').select();
		$('#mobile').css('border-color','red');
		$('.ad7').show();
		$('.ad7').text('Invalide Mobile number.');
		return false;
	}else if(mob.length != 10){
		$('#full_name').css('border-color','#ebebeb');
		$('#country').css('border-color','#ebebeb');
		$('#state').css('border-color','#ebebeb');
		$('#city').css('border-color','#ebebeb');
		$('#street_addrs').css('border-color','#ebebeb');
		$('#pincode').css('border-color','#ebebeb');
		$('.ad1').hide();
		$('.ad2').hide();
		$('.ad3').hide();
		$('.ad4').hide();
		$('.ad5').hide();
		$('.ad6').hide();
		$('#mobile').select();
		$('#mobile').css('border-color','red');
		$('.ad7').show();
		$('.ad7').text('Please enter 10 digit mobile number.');
		return false;
	}else{
		
		$('#address_btn').val('Processing...');
		$.ajax({
			url:'<?php echo base_url(); ?>user/save_address',
			method:'post',
			data:{
					name:full_name,
					country:country,
					state:state,
					city:city,
					address:address,
					pin:pin,
					mob:mob,
				},
			success:function(result)
			{
				
				if(result == 'saved'){
					var maddrs = $(".multi_address_dv").text();
					$("#show_ssmsg_dv").html('<img src="<?php echo base_url(); ?>images/success_icon.png"> &nbsp;Your address have been saved successfully.');
					$("#show_ssmsg_dv").css({'background-color':'#deffd0','border':'1px solid #009700','color':'green'})
					$("#show_ssmsg").fadeIn();
					$('#address_btn').val('Save Changes');
					
					setTimeout(function() { window.location.reload(true); }, 3000);
				
				}
				if(result == 'not saved'){
					$("#show_ssmsg_dv").html('<img src="<?php echo base_url(); ?>images/error.png"> &nbsp;No data Saved');
					$("#show_ssmsg_dv").css({'background-color':'pink','border':'1px solid salmon','color':'#d8000c'})
					$("#show_ssmsg").fadeIn();
					$('#address_btn').val('Save Changes');
				}
			}
		});
		
	}
}

function deleteAddress(id,sl){
		$spn_id = '.del'+sl;
		$($spn_id).text('deleting...');
		$.ajax({
			url:'<?php echo base_url(); ?>user/delete_address',
			method:'post',
			data:{id:id},
			success:function(result)
			{
				if(result == 'deleted'){
					window.location.reload(true);
				}
			}
		});
}

function setDefaultaddress(address_id){
	$.ajax({
			url:'<?php echo base_url(); ?>user/update_user_default_address',
			method:'post',
			data:{id:address_id},
			success:function(result)
			{
				if(result == 'success'){
					window.location.reload(true);
				}
			}
		});
}
</script>

</body>

</html>