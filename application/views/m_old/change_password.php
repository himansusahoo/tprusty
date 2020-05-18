<?php include "header.php"; ?>
<!--<script type= "text/javascript" src = "<?php //echo base_url(); ?>js/countries.js"></script>-->	
	<div class="wrap">
		<!--Profile-->
      <div class="profile">
	   
	      <div class="info-inner">
		     		      
		  <div class="section-info">
				<h3 class="tittle"> My Account </h3>
               
                <?php include "profile_menu.php"; ?>
                     
                    <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="tab1">
       <div class="login-frm">
            	<table width="100%">
                	<tr> <td >Old Password</td></tr>
        			<tr> <td>
                        	<input type="password" class="input-text" name="old_pass" id="old_pass" value="" placeholder="Old Password">
                        	<span class="req pass1"> This field is required.</span>
                        </td>
                    </tr>
                    <tr> <td>New Password</td> </tr>
        			<tr> <td>
                        	<input type="password" class="input-text" name="change_new_pass" id="change_new_pass" value="" placeholder="New Password">
                            <span class="req pass2"> This field is required.</span>
                        </td>
                    </tr>
					
					<tr> <td>Retype New Password</td> </tr>
        			<tr> <td>
                        	<input type="password" class="input-text" name="change_rnew_pass" id="change_rnew_pass" value="" placeholder="Retype New Password">
                            <span class="req pass3"> This field is required.</span>
                        </td>
                    </tr>
                    
					
					<tr>
        				<td colspan="2">
                        	<input  type="submit" class="btn-sign-in" id="change_pass_btn" onClick="changePasswords()" value="Save Changes">
                        </td>
                    </tr>
                    
        				
                     <tr id="show_ssmsg">
                    	<td>
                        	<div id="show_ssmsg_dv"></div>
                        </td>
                    </tr>
                </table>
       </div>	
    </div>
    
  </div>

     
  <!-- Tab panes -->   
				    <div class="clearfix"> </div>
				</div>
		  </div>
	   </div>
  <!--//profile-->
		
		</div>





<script>
function changePasswords(){
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
//		$('.otp').show();
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
<?php include "footer.php"; ?>