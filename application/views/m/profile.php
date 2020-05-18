<?php include "header.php"; ?>
<!--<script type= "text/javascript" src = "<?php //echo base_url(); ?>js/countries.js"></script>-->	
<style>
.lable-width{
	width:25%; margin-top:19px;
}
.field-width{
	width:75%;float: right;
}
</style>
	<div class="wrap">
		<!--Profile-->
      <div class="profile">
	   
	      <div class="info-inner">
		     		      
		  <div class="section-info">
				<h3 class="tittle"> My Account </h3>
               
                <?php include "profile_menu.php"; ?>
                     
                    <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#tab1" aria-controls="home" role="tab" data-toggle="tab">Personal Information</a></li>
    <li role="presentation"><a href="#tab2" aria-controls="profile" role="tab" data-toggle="tab">Add a New Address</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="tab1">
       <div class="login-frm">
            	<table width="100%">
                	<tr>
                    <td>
                    	<label class="lable-width">First Name</label>
                        <input type="text" class="input-text field-width" name="fname" id="fname" value="<?=$persional_info[0]->fname; ?>" placeholder="Fname">
                        <span class="req nam1"> This field is required.</span>
                     </td>
                    </tr>
        			<tr>
                    	<td>
                    		<label class="lable-width">Last Name</label>
                        	<input type="text" class="input-text field-width" name="lname" id="lname" value="<?=$persional_info[0]->lname; ?>" placeholder="Lname">
                            <span class="req nam2"> This field is required.</span>
                        </td>
                    </tr>
                    
        			<tr> 
                    	 <td>
                    		<label class="lable-width">Number <i class="fa fa-question-circle"></i></label>
                      <div class="tooltip">To change mobile number, Email OTP verification is mandatory</div>
           
                        	<input type="text" class="input-text field-width" name="mob" id="mob" maxlength="10" value="<?=$persional_info[0]->mob; ?>" placeholder="Mobile" >
                            <span class="req mob1"> This field is required.</span>
							<input type="text" class="input-text req otp" name="otp" id="otp" placeholder="Enter the OTP">
                            <span class="req otp1"> This field is required.</span>
                        </td>
                    </tr>
        			<tr>
                    	<td>
                        <label class="lable-width">Gender</label>
                        <div class="field-width">
         <div style="width:50%; float:left;" class="single-bottom"><label class="radio"><input type="radio" name="sex" value="Male" <?php if($persional_info[0]->gendr == 'Male'){ echo 'checked';} ?> checked> <span></span>Male</label> </div>
         <div style="width:50%; float:right;" class="single-bottom"> <label class="radio"><input type="radio" name="sex" value="Female" <?php if($persional_info[0]->gendr == 'Female'){ echo 'checked';} ?>><span></span>Female</label> </div>
                        </div>
                        </td>
                    </tr>
                    <tr>
        				<td >
							<input type="hidden" id="hidden_mail" class="hidden_mail" value="<?=$persional_info[0]->email?>">
							<input type="submit" class="btn-sign-in" id="persional_btn" onClick="savePersionalInfo()" value="Save Changes">
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
    <div role="tabpanel" class="tab-pane" id="tab2">
    
     <div class="login-frm">
            	
                    <input type="text" class="input-text" name="full_name" id="full_name" value="<?=$user_result[0]->fname.' '.$user_result[0]->lname; ?>" placeholder="Name">
                            <span class="req ad1"> This field is required.</span>
                      
                        	<select id="country2" name ="country2" placeholder="country">
                            	<option value="India">India</option>
                            </select>
                            <span class="req ad2"> This field is required.</span>
                            <!--<script language="javascript">
								//populateCountries("country", "state");
								populateCountries("country2");
 							</script>-->
                       
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
                        
                        	<input type="text" class="input-text" name="city" id="city" placeholder="City">
                            <span class="req ad4"> This field is required.</span>
                        
                        	<textarea class="input-text" name="street_addrs" id="street_addrs" placeholder="Address"></textarea>
                            <span class="req ad5"> This field is required.</span>
                    
                        	<input type="text" class="input-text" name="pincode" id="pincode" placeholder="Pincode">
                            <span class="req ad6"> This field is required.</span>
                   
                        	<input type="text" class="input-text" name="mobile" maxlength="10" id="mobile" placeholder="Mobile">
                            <span class="req ad7"> This field is required.</span>
                        
                        	<input  type="submit" id="address_btn" onClick="saveAddress()" class="btn-sign-in hvr-sweep-to-right" value="Save Changes">
                   
                        	<div id="show_ssmsg_dv"></div>
 
                  
                   <?php 
			$sl=0;
			if($result){
			foreach($result as $row){
				$sl++; 
			?>
                  <?php if($result != ''){ ?>
                  <div class="multi_address">
                       <p> <strong><?php echo $row->full_name; ?></strong> <br>
                        <?php echo $row->address ;?>  <br>
                        <?php echo $row->city.'-'.$row->pin_code ;?><br>
                        <?php echo $row->state.', '.$row->country ;?><br> 
                        <?php echo 'Ph : '.$row->phone ;?>
                        </p>
                <div class="single-bottom"><label for="dadrs"><input type="radio"  name="addrs" id="dadrs" <?php if($user_result[0]->address_id == $row->address_id){ echo 'checked';} ?> onClick="setDefaultaddress(<?=$row->address_id; ?>)"> <span> Default Address </span> </label> </div>
                  <?php if($user_result[0]->address_id != $row->address_id){ ?>
                 <span class="del<?=$sl; ?> del gray-sml-btn" onClick="deleteAddress(<?php echo $row->address_id; ?>,<?=$sl; ?>)"> 
                 <i class="fa fa-trash-o"></i>Delete address </span>
                 <?php } ?>
                </div>
                 <?php } 
				 } }?>
                <div class="clearfix"></div>
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