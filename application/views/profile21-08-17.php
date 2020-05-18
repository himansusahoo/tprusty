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
<script type= "text/javascript" src = "<?php echo base_url(); ?>js/countries.js"></script>
<script src="<?php echo base_url();?>js/jquery.colorbox.js"></script>
<script>
	$(document).ready(function(){
		$(".inline").colorbox({inline:true, width:"40%"});
		$(".inline").colorbox({'overlayClose': false, 'escKey': false});
	});
</script>	
<style>
.wrapper {
  background: #ececec;
  font-family: "Gill Sans", Impact, sans-serif;
  position: relative;
  text-align: center;
  width: 0px;
  float: right;
  right: 55px;
  cursor: default;
  -webkit-transform: translateZ(0); /* webkit flicker fix */
  -webkit-font-smoothing: antialiased; /* webkit text rendering fix */
}

.wrapper .tooltip {
  background: #1496bb;
  bottom: 100%;
  color: #fff;
  display: block;
  left: -195px;
  margin-bottom: 8px;
  opacity: 0;
  padding: 10px;
  pointer-events: none;
  position: absolute;
  width: 407px;
  -webkit-transform: translateY(10px);
     -moz-transform: translateY(10px);
      -ms-transform: translateY(10px);
       -o-transform: translateY(10px);
          transform: translateY(10px);
  -webkit-transition: all .25s ease-out;
     -moz-transition: all .25s ease-out;
      -ms-transition: all .25s ease-out;
       -o-transition: all .25s ease-out;
          transition: all .25s ease-out;
  -webkit-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
     -moz-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
      -ms-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
       -o-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
          box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
}

/* This bridges the gap so you can mouse into the tooltip without it disappearing */
.wrapper .tooltip:before {
  bottom: -20px;
  content: " ";
  display: block;
  height: 20px;
  left: 0;
  position: absolute;
  width: 100%;
}  

/* CSS Triangles - see Trevor's post */
.wrapper .tooltip:after {
  border-left: solid transparent 10px;
  border-right: solid transparent 10px;
  border-top: solid #1496bb 10px;
  bottom: -10px;
  content: " ";
  height: 0;
  left: 50%;
  margin-left: -13px;
  position: absolute;
  width: 0;
}
  
.wrapper:hover .tooltip {
  opacity: 1;
  pointer-events: auto;
  -webkit-transform: translateY(0px);
     -moz-transform: translateY(0px);
      -ms-transform: translateY(0px);
       -o-transform: translateY(0px);
          transform: translateY(0px);
}

/* IE can just show/hide with no transition */
.lte8 .wrapper .tooltip {
  display: none;
}

.lte8 .wrapper:hover .tooltip {
  display: block;
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
		<div class="left-nav">
        	<?php include'profile_menu.php'; ?>
        </div>
    
    <div class="profile-right">
    <div class=" col-md-6">
    	<div id="load_form" >
        	<h2 class="title3">Personal Information</h2>
            	<table class="account_form">
                	<tr>
                    	<td width="150px">First Name</td>
        				<td>
                        	<input type="text" class="input-text" name="fname" id="fname" value="<?=$persional_info[0]->fname; ?>" placeholder="Fname">
                        	<span class="req nam1"> This field is required.</span>
                        </td>
                    </tr>
                    <tr>
                    	<td>Last Name</td>
        				<td>
                        	<input type="text" class="input-text" name="lname" id="lname" value="<?=$persional_info[0]->lname; ?>" placeholder="Lname">
                            <span class="req nam2"> This field is required.</span>
                        </td>
                    </tr>
                    <tr>
                    	<td>Mobile Number <div class="wrapper"><i class="fa fa-question-circle"></i><div class="tooltip">To change mobile number, Email OTP verification is mandatory</div></div> </td>
        				<td>
                        	<input type="text" class="input-text" name="mob" id="mob" maxlength="10" value="<?=$persional_info[0]->mob; ?>" placeholder="Mobile" >
                            <span class="req mob1"> This field is required.</span>
							<input type="text" class="input-text req otp" name="otp" id="otp" placeholder="Enter the OTP">
                            <span class="req otp1"> This field is required.</span>
                        </td>
                    </tr>
                    <tr>
                    	<td>Gender</td>
        				<td class="filter-form">
                        	<label class="radio"><input type="radio" name="sex" value="Male" <?php if($persional_info[0]->gendr == 'Male'){ echo 'checked';} ?> checked><i></i>Male</label>
                            <label class="radio"><input type="radio" name="sex" value="Female" <?php if($persional_info[0]->gendr == 'Female'){ echo 'checked';} ?>><i></i>Female</label>
                        </td>
                    </tr>
                    <tr>
        				<td colspan="2">
							<input type="hidden" id="hidden_mail" class="hidden_mail" value="<?=$persional_info[0]->email?>">
							<input type="submit" class="btn-sign-in hvr-sweep-to-right" id="persional_btn" onClick="savePersionalInfo()" value="Save Changes">
						</td>
                    </tr>
                    <tr id="show_ssmsg">
                    	<td colspan="2">
                        	<div id="show_ssmsg_dv">,nxdgfbn</div>
                        </td>
                    </tr>
                </table>
        </div>
    </div>
		
        <div class="col-md-6">
        
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
                        	<select id="country2" name ="country2" class="input-text"><Option>India<option></select>
                           <!-- <span class="req ad2"> This field is required.</span>
                            <script language="javascript">
								//populateCountries("country", "state");
								populateCountries("country2");
 							</script>-->
                       	</td>
                    </tr>
                    <tr>
                    	<td>State</td>
        				<td>
                        	<select name ="state" id ="state" class="input-text">
                            	<option value="">Select State</option>
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
                        	<input  type="submit" id="address_btn" onClick="saveAddress()" class="btn-sign-in hvr-sweep-to-right" value="Save Changes">
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
<div class="clearfix">&nbsp;</div>


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
                	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="del<?=$sl; ?> del gray-sml-btn" onClick="deleteAddress(<?php echo $row->address_id; ?>,<?=$sl; ?>)"> <i class="fa fa-trash-o"></i>Delete address</span>
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
	var country = $('#country2').val();
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
		$('#country2').css('border-color','#ebebeb');
		$('.ad1').hide();
		$('.ad2').hide();
		$('#state').css('border-color','red');
		$('.ad3').show();
		return false;
	}else if(city == ''){
		$('#full_name').css('border-color','#ebebeb');
		$('#country2').css('border-color','#ebebeb');
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
		$('#country2').css('border-color','#ebebeb');
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
		$('#country2').css('border-color','#ebebeb');
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
		$('#country2').css('border-color','#ebebeb');
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
		$('#country2').css('border-color','#ebebeb');
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
		$('#country2').css('border-color','#ebebeb');
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
		$('#country2').css('border-color','#ebebeb');
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
					var referrer =  document.referrer;
					if(referrer=='<?php echo base_url(); ?>'+'mycart/checkout_process'){
						window.location.href=referrer;
					}else {
						setTimeout(function() { location.reload() },1500);
					}
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


<script>
///////User Persional Information script start here///////
function savePersionalInfo(){
	var fname = $('#fname').val();
	var lname = $('#lname').val();
	var mobile = $('#mob').val();
	var email = $('#hidden_mail').val();
	//var otp = $('.otp').val();
	var sex = $("input[name='sex']:checked").val();
	if(fname == ''){
		$('#fname').css('border-color','red');
		$('#fname').focus();
		$('.nam1').show();
		return false;
	}else if(lname == ''){
		$('#fname').css('border-color','#ebebeb');
		$('.nam1').hide();
		$('#lname').css('border-color','red');
		$('#lname').focus();
		$('.nam2').show();
		return false;
	}else if(mobile == ''){
		$('#fname').css('border-color','#ebebeb');
		$('#lname').css('border-color','#ebebeb');
		$('.nam1').hide();
		$('.nam2').hide();
		$('#mob').css('border-color','red');
		$('#mob').focus();
		$('.mob1').show();
		return false;
	}else if(isNaN(mobile)){
		$('#fname').css('border-color','#ebebeb');
		$('#lname').css('border-color','#ebebeb');
		$('.nam1').hide();
		$('.nam2').hide();
		$('#mob').css('border-color','red');
		$('#mob').select();
		$('.mob1').show();
		$('.mob1').text('Please Enter a valide Mobile number.');
		return false;
	}else if(mobile.length != 10){
		$('#fname').css('border-color','#ebebeb');
		$('#lname').css('border-color','#ebebeb');
		$('.nam1').hide();
		$('.nam2').hide();
		$('#mob').css('border-color','red');
		$('#mob').select();
		$('.mob1').show();
		$('.mob1').text('Please enter 10 digit mobile number.');
		return false;
	}
	//else if(otp == ""){
//		$('#fname').css('border-color','#ebebeb');
//		$('#lname').css('border-color','#ebebeb');
//		$('.otp').css('border-color','#ebebeb');
//		$('.nam1').hide();
//		$('.nam2').hide();
//		$('.mob1').hide();
//		$('.otp').css('border-color','red');
//		$('.otp').focus();
//		$('.otp1').show();
//		return false;
//	}
	else{
		$('#fname').css('border-color','#ebebeb');
		$('#lname').css('border-color','#ebebeb');
		$('#mob').css('border-color','#ebebeb');
		$('.nam1').hide();
		$('.nam2').hide();		
		$('.mob1').hide();
		
		$('#persional_btn').val('Processing...');
		$.ajax({
			url:'<?php echo base_url(); ?>user/persional_info',
			method:'post',
			//data:{fname:fname,lname:lname,mobile:mobile,otp:otp,email:email,gen:sex},
			data:{fname:fname,lname:lname,mobile:mobile,email:email,gen:sex},
			success:function(result){
				if(result == 'success'){
					$("#show_ssmsg_dv").html('<img src="<?php echo base_url(); ?>images/success_icon.png"> &nbsp;Your changes have been saved successfully.');
					$("#show_ssmsg_dv").css({'background-color':'#deffd0','border':'1px solid #009700','color':'green'})
					$("#show_ssmsg").fadeIn();
					$('#persional_btn').val('Save Changes');
					//window.location.reload(true);
					setTimeout(function() { location.reload() },1500);
				}
				if(result == 'not'){
					$("#show_ssmsg_dv").html('<img src="<?php echo base_url(); ?>images/error.png"> &nbsp;No data Updated');
					$("#show_ssmsg_dv").css({'background-color':'pink','border':'1px solid salmon','color':'#d8000c'})
					$("#show_ssmsg").fadeIn();
					$('#persional_btn').val('Save Changes');
				}
			}
		});
		
	}
}
///////User Persional Information script end here///////

//$.fn.delayKeyup = function(callback, ms){
//     var timer = 0;
//     var el = $(this);
//     $(this).keyup(function(){                   
//         clearTimeout (timer);
//         timer = setTimeout(function(){
//             callback(el)
//                 }, ms);
//     });
//     return $(this);
// };
// 
// $('#mob').delayKeyup(function(el){
//	var mobile = el.val();  
//	var otp = $('#otp').val();
//	var email = $('#hidden_mail').val();
//	if(mobile == ''){
//		$('#mob').css('border-color','red');
//		$('#mob').focus();
//		$('.mob1').show();
//		return false;
//	}else if(isNaN(mobile)){
//		$('#mob').css('border-color','red');
//		$('#mob').select();
//		$('.mob1').show();
//		$('.mob1').text('Please Enter a valide Mobile number.');
//	}else if(mobile.length != 10){
//		$('#mob').select().css('border-color','red');
//		$('#mob').select();
//		$('.mob1').show();
//		$('.mob1').show().text('Please enter 10 digit mobile number.');
//	}else{
//		$('#mob').css('border-color','#ccc');
//		$('.mob1').hide();
//		$('.otp').show();
//		$('.otp1').show().text('Please chech your mail for OTP').css('color','green');
//		$('.account_form').find('#otp').removeClass('req');
//		
//		
//		var base_url = "<?php //echo base_url(); ?>";
//		var fname = $('#fname').val();
//		var lname = $('#lname').val();
//		var mobile = $('#mob').val();
//		var email = $('#hidden_mail').val();
//		$.ajax({
//			url : base_url+'user/send_mobile_change_otp',
//			type : 'POST',
//			data : {fname:fname, lname:lname, mobile:mobile, email:email},
//			success:function(result){
//				if(result == 'success'){
//					alert("To get OTP, Please check your email.");
//					return false;
//				}
//			}
//		});
//	}
//},1800);

</script>

</body>

</html>