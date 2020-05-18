<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="" content="">
        <meta name="" content="" />
		<title>Contact us</title>

		<?php include "header.php" ?>

		<!------ Start Content ------>
		
		

		<div class="main-content">
			<div class="col-md-6">
					<h2 class="title3">Contact us</h2>
					<table class="account_form">
						<tr>
							<td width="150px">Name</td>
							<td>
								<input type="text" class="input-text" name="name" id="name" value="" placeholder="Name">
								<span class="req nam1"> This field is required.</span>
							</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>
								<input type="text" class="input-text" name="email" id="email" value="" placeholder="Email">
								<span class="req nam2"> This field is required.</span>
							</td>
						</tr>
						<tr>
							<td>Mobile Number</td>
							<td>
								<input type="text" class="input-text" name="mobile" id="mobile" maxlength="10" value="" placeholder="Mobile">
								<span class="req mob1"> This field is required.</span>
							</td>
						</tr>
						<tr>
							<td>Subject</td>
							<td>
								<input type="text" class="input-text" name="title" id="title" value="" placeholder="subject">
								<span class="req titl12"> This field is required.</span>
							</td>
						</tr>
						<tr>
							<td>Content</td>
							<td>
								<textarea id="content" class="input-text" placeholder="Content" name="content"></textarea>
								<span class="req titl123"> This field is required.</span>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" id="cs_submit_btn" class="btn-sign-in" onClick="saveCustomerSupport()" value="Submit">
							</td>
						</tr>
						<tr id="show_ssmsg">
                    	<td colspan="2">
                        	<div id="show_ssmsg_dv"></div>
                        </td>
                    </tr>
						
					</table>
				</div>
	
			<div class="col-md-5 right">
            <h2 class="title3">Registered Office</h2>
				<div class="top_faq" style="margin-top:30px;">
				 <h4 class="price-orange" > Moonboy International Pvt Ltd. </h4>
                   <p style="font-size:18px;"> H No - 12/2710, 1st Floor <br>
                    Khajotiya House, Aga No Wad,<br>
                    NR. Parsi Fire Temple, Sayedpura,<br>
                    Surat, Gujarat - 395003 <br>
                  <strong>  Email - Info@moonboy.in</strong> <br>
                  <strong>  Call Now -  +91 9726130000 </strong> <br>
                  <strong> CIN No. - U70102GJ2011PTC063868 </strong> <br>
                  <strong> Service Tax No. - AAGCM9691LSD001 </strong>
					</p>
				</div>
			</div>
            
            <div class="clearfix"> </div>
            
            
		<?php include "footer.php" ?>
<script>

function saveCustomerSupport(){
	//var base_url = "<?php echo base_url(); ?>";
	//var controller = "user";
	var name = $('#name').val();
	var email = $('#email').val();
	var mobile = $('#mobile').val();
	var title = $('#title').val();
	var content = $('#content').val();
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(name == ''){
		$('#name').css('border-color','red');
		$('#name').focus();
		$('.nam1').show();
		return false;
	}else if(email == ''){
		$('#name').css('border-color','#ebebeb');
		$('.nam1').hide();
		$('#email').css('border-color','red');
		$('#email').focus();
		$('.nam2').show();
		return false;
	}else if(!filter.test(email)){
		$('#name').css('border-color','#ebebeb');
		$('.nam1').hide();
		$('#email').css('border-color','red');
		$('#email').select();
		$('.nam2').show().text("Please enter valid Email address.");
		return false;
	}else if(mobile == ''){
		$('#name').css('border-color','#ebebeb');
		$('#email').css('border-color','#ebebeb');
		$('.nam1').hide();
		$('.nam2').hide();
		$('#mobile').css('border-color','red');
		$('#mobile').focus();
		$('.mob1').show();
		return false;
	}else if(isNaN(mobile)){
		$('#name').css('border-color','#ebebeb');
		$('#email').css('border-color','#ebebeb');
		$('.nam1').hide();
		$('.nam2').hide();
		$('#mobile').css('border-color','red');
		$('#mobile').select();
		$('.mob1').show();
		$('.mob1').text('Please Enter a valide Mobile number.');
		return false;
	}else if(mobile.length != 10){
		$('#name').css('border-color','#ebebeb');
		$('#email').css('border-color','#ebebeb');
		$('.nam1').hide();
		$('.nam2').hide();
		$('#mobile').css('border-color','red');
		$('#mobile').select();
		$('.mob1').show();
		$('.mob1').text('Please enter 10 digit mobile number.');
		return false;
	}else if(title == ''){
		$('#name').css('border-color','#ebebeb');
		$('#email').css('border-color','#ebebeb');
		$('#mobile').css('border-color','#ebebeb');
		$('.nam1').hide();
		$('.nam2').hide();
		$('.mob1').hide();
		$('#title').css('border-color','red');
		$('#title').focus();
		$('.titl12').show();
		return false;
	}else if(content == ''){
		$('#name').css('border-color','#ebebeb');
		$('#email').css('border-color','#ebebeb');
		$('#mobile').css('border-color','#ebebeb');
		$('#title').css('border-color','#ebebeb');
		$('.nam1').hide();
		$('.nam2').hide();
		$('.mob1').hide();
		$('.titl12').hide();
		$('#content').css('border-color','red');
		$('#content').focus();
		$('.titl123').show();
	}else{
		$('#fname').css('border-color','#ebebeb');
		$('#email').css('border-color','#ebebeb');
		$('#mobile').css('border-color','#ebebeb');
		$('#title').css('border-color','#ebebeb');
		$('#content').css('border-color','#ebebeb');
		$('.nam1').hide();
		$('.nam2').hide();		
		$('.mob1').hide();
		$('.titl12').hide();
		$('.titl123').hide();
		
		$('#cs_submit_btn').val('Processing...');
		$.ajax({
			url:'<?php echo base_url(); ?>user/send_customer_support_mail',
			method:'post',
			data:{name:name,email:email,mobile:mobile,title:title,content:content},
			success : function(data){
				//$('#successfully_verify').html(data);
				if(data == 'success'){
					$('#show_ssmsg_dv').html('<img src="<?php echo base_url(); ?>images/success_icon.png"> &nbsp;Thank you for your kind response..');
					$("#show_ssmsg_dv").css({'background-color':'#deffd0','border':'1px solid #009700','color':'green'});
					$("#show_ssmsg").fadeIn();
					$('#cs_submit_btn').val('Submit');
					setTimeout(function() { location.reload() },1500);
				}
				if(result == 'not'){
					$("#show_ssmsg_dv").html('<img src="<?php echo base_url(); ?>images/error.png"> &nbsp;No data Updated');
					$("#show_ssmsg_dv").css({'background-color':'pink','border':'1px solid salmon','color':'#d8000c'})
					$("#show_ssmsg").fadeIn();
					$('#cs_submit_btn').val('Submit');
				}
			}
		});
		
	}
}
</script>

</body>

</html>	