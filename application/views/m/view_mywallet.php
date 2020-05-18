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


  <!-- Tab panes -->
  
  <div class="order">
        	     <h3 class="tittle two">My Wallet </h3>
				<span style="font-size:18px; color:#930"> Wallet Balance: Rs. <?php if(@$walet_info->wallet_balance!='')
						{ echo $walet_info->wallet_balance; }else
						{
							echo "0";
						}
						?></span>
                        
                        
                        
                    <?php if(count($wallet_info)!=0){
						$alltot_amt=0;
						foreach($wallet_info as $res_walletinfo)
						{ 
					?>	
	      <div class="list">
          
							  <div class="cart_box">
                              <div class="o-id">
                              
                               
                              <a href="#"><?= $res_walletinfo->return_id ; ?></a>                 
                              <div class="clearfix"> </div> </div>
                              <div class="clearfix"> </div>
                               	<div class="message">
					                <div class="list_img">
                                    
                                   <?php @$image=explode(',',$res_walletinfo->imag); ?>
                                <a href="">
									<img src="<?php echo base_url().'images/product_img/'.$image[0]; ?>" class="img-responsive" alt="<?=$res_walletinfo->prd_name;?>">
								</a>
                                    
                                    </div>
								    <div class="list_desc">
                                    <h4><a href="" target="">
										<?= $res_walletinfo->prd_name; ?>								
                                        </a>
                                    </h4>
                                    
                                    <div class="actual"> <span> Rs.<?= $res_walletinfo->total_amount ; ?></span> </div>
                                    <div class="clearfix"></div>
                                    <span class=""> 
                                     <span class="cart_attr">Return Type  : <?= $res_walletinfo->return_typ ; ?></span><br>                        <span class="cart_attr">Return Reason   : <?= $res_walletinfo->reason ; ?></span><br>
                                     <span class="cart_attr"> Quantity : <?= $res_walletinfo->quantity ; ?></span><br>
                                     </span> 
                                    <div class="clearfix"></div>
									
                                        
									 </div>
		                              <div class="clearfix"></div>
	                              </div>
								 
	                            </div>
	                            
	                      
				            
                            <div class="cart-total">
								<div class="total_left">Total Amount: </div>
								<div class="total_right">Rs. <?= $res_walletinfo->total_amount ; ?></div>
								<div class="clearfix"> </div>
                                <div class="slr-name"> Seller : <a href="#"> <?= $res_walletinfo->business_name ; ?> </a></div>
                                <div class="order-date">  Date : <?= $res_walletinfo->cdate ; ?>  </div>
                                <div class="clearfix"> </div>
							</div>
							
			<div class="clearfix"></div>
			</div>	
               <?php  $alltot_amt=$alltot_amt + $res_walletinfo->total_amount;}?>
               <div class="list">                 
             		<span style="font-size:14px; color:#63F;">Sub Total Amount :Rs.<?php echo $alltot_amt; ?></span>
               </div>
            <?php  }else{?>
            
               <div class="list">                 
             		<span style="font-size:14px; color:#63F;">No Records Found</span>
               </div>
            <?php  }?>                    
	   </div>
       
       
       
       
  <div class="order">
        	     <h3 class="tittle two">Purchased By Wallet</h3>
				
                    <?php if(count($purchase_bywallet_info)!=0){
						$alltot_amt1=0;
						foreach($purchase_bywallet_info as $res_purchwalletinfo)
						{ 
					?>	
	      <div class="list">
          
							  <div class="cart_box">
                              <div class="o-id">
                              
                               
                              <a href="#"><?php echo $res_purchwalletinfo->order_id; ?></a>                 
                              <div class="clearfix"> </div> </div>
                              <div class="clearfix"> </div>
                               	<div class="message">
					                <div class="list_img">
                                    
                                   <?php @$image=explode(',',$res_purchwalletinfo->imag); ?>
                                <a href="">
									<img src="<?php echo base_url().'images/product_img/'.$image[0]; ?>" class="img-responsive" alt="<?= $res_purchwalletinfo->prd_name; ?>">
								</a>
                                    
                                    </div>
								    <div class="list_desc">
                                    <h4><a href="" target="">
										<?= $res_purchwalletinfo->prd_name; ?>								
                                        </a>
                                    </h4>
                                    
                                    <div class="actual"> <span> Rs.<?= $res_purchwalletinfo->sub_total_amount ; ?></span> </div>
                                    <div class="clearfix"></div>
                                    <span class=""> 
                                     <span class="cart_attr"> Quantity : <?= $res_purchwalletinfo->quantity ; ?></span><br>
                                     <span class="cart_attr"> Payment Mode : Wallet</span>
                                     </span> 
                                    <div class="clearfix"></div>
									
                                        
									 </div>
		                              <div class="clearfix"></div>
	                              </div>
								 
	                            </div>
	                            
	                      
				            
                            <div class="cart-total">
								<div class="total_left">Total Amount: </div>
								<div class="total_right">Rs. <?= $res_purchwalletinfo->sub_total_amount ; ?></div>
								<div class="clearfix"> </div>
                                <div class="slr-name"> Seller : <a href="#"> <?php echo $res_purchwalletinfo->business_name; ?> </a></div>
                                <div class="clearfix"> </div>
							</div>
							
			<div class="clearfix"></div>
			</div>	
               <?php  $alltot_amt1=$alltot_amt1 + $res_purchwalletinfo->sub_total_amount;}?>
               <div class="list">                 
             		<span style="font-size:14px; color:#63F;">Sub Total Amount :Rs.<?php echo $alltot_amt1; ?></span>
               </div>
            <?php  }else{?>
            
               <div class="list">                 
             		<span style="font-size:14px; color:#63F;">No Records Found</span>
               </div>
            <?php  }?>                    
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