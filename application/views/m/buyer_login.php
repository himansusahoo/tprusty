
<?php include "header.php"; ?>

<?php
if ($this->session->userdata('sesscoke') == false) {

    $data = array();
    $this->session->set_userdata('sesscoke', $data);
}
?>

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> 
<script>
            $(document).ready(function () {
    $('#exixtingusertomoonboy').css('display', 'none');
            $('#e_user').click(function () {
    $('#exixtingusertomoonboy').css('display', 'none');
            $('#pass_dv1').slideUp();
            $('#pass_dv2').slideDown();
            $('#in_up').val('Login');
            $('#newtomoonboy').css('display', 'block');
    });
            $('#n_user').click(function () {     $('#newtomoonboy').css('display', 'none');
            $('#pass_dv1').slideDown();
            $('#pass_dv2').slideUp();
            $('#in_up').val('Sign Up');
            $('#exixtingusertomoonboy').css('display', 'block'); });
    });</script>

<!--Sign in or sign Up script start here-->
<script>
            logintobuysku = "<?php echo $this->session->userdata('logintobuysku'); ?>";
            function logSignupFunction(pname) {
            //alert(pname);return false;

            //alert(logintobuysku);
            var mail_id = $('#mail_id').val();
                    var pattern = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    if ($("#n_user").is(":checked")) {
            var user = 'new_user';
            }
            if ($("#e_user").is(":checked")) {
            var user = 'ext_user';
            }

            if (mail_id == '') {
            alert('please enter your email address.');
                    $('#mail_id').focus();
                    return false;
            } else if (!pattern.test(mail_id)) {
            alert('Please provide a valid email address');
                    $('#mail_id').select();
                    return false; } else {             ///////script start for NEW USER/////////
            if (user == 'new_user') {
            var pass = $('#npass').val();
                    var cpass = $('#ncpass').val();
                    if (pass == '') {
            alert('Please enter password');
                    $('#npass').focus();
                    return false;
            } else if (cpass == '') {
            alert('Please re-enter password');
                    $('#ncpass').focus();
                    return false;
            } else if (pass != cpass) {
            alert('Password mismatch');
                    $('#ncpass').select();
                    return false;
            } else {

            $('#in_up').val('Processing...');
                    $.ajax({
                    url: '<?php echo base_url(); ?>user/login',
                            method: 'post',
                            data: {email: mail_id, password: pass, flag: 1},
                            success: function (result)
                            {
                            //$(".error_msg").html(result);
                            if (result == 'exists') {
                            $(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>This email address is already exists');
                                    $(".error_msg").slideDown();
                                    $('#in_up').val('Login');
                            }
                            //if(result == 'success1'){
                            //window.location.href="<?php //echo base_url().'product_description/addtocheckout_buynow/';          ?>"+pname;
                            //}
                            //if(result == 'success'){                             if (result == 'success' && logintobuysku != '') {
<?php echo $this->session->unset_userdata('logintobuysku'); ?>
                            window.location.href = "<?php echo base_url() . 'mycart/checkout_process'; ?>";
                            }
                    /*else{*/
                    /*$(".error_msg").html(result);
                     $(".error_msg").fadeIn(500);*/
                    //window.location.reload(true);
                    //window.location.href='<?php //echo base_url().'user/profile'           ?>';
                    if (result == 'success' && logintobuysku == '')
                    {
                    var referrer = document.referrer;
                            window.location.href = referrer;
                    }
                    /*}*/
                    }
                    });
            }
            }
            ///////script end of NEW USER/////////
            ///////script start for Exiting USER/////////
            if (user == 'ext_user') {
            var pass = $('#epass').val();
                    if (pass == '') {
            alert('please enter your password.');
                    $('#epass').focus();
                    return false;
            } else {

            $('#in_up').val('Processing...');
                    $.ajax({
                    url: '<?php echo base_url(); ?>user/login',
                            method: 'post',
                            data: {email: mail_id, password: pass, flag: 2},
                            success: function (result)
                            {
                            /*$(".error_msg").html(result);
                             $(".error_msg").fadeIn(500);*/
                            if (result == 'blocked') {
                            $(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>This user is already blocked');
                                    $(".error_msg").slideDown(200);
                                    $('#in_up').val('Login'); }
                            if (result == 'invalid') {
                            $(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>Invalid Username or Password');
                                    $(".error_msg").slideDown(200);
                                    $('#in_up').val('Login');
                            }
                            //if(result == 'success'){
                            //$(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>ssccdd');
                            //window.location.reload(true);
                            //window.location.href="<?php //echo base_url().'user/profile'           ?>";
                            //}
                            //if(result == 'success1'){
                            if (result == 'success' && logintobuysku != '') {
<?php echo $this->session->unset_userdata('logintobuysku'); ?>
                            window.location.href = "<?php echo base_url() . 'mycart/checkout_process'; ?>";
                            }
                            /*else{*/
                            //window.location.href="<?php //echo base_url().'product_description/addtocheckout_buynow/';          ?>"+pname;
                            if (result == 'success' && logintobuysku == '')
                            {
                            var referrer = document.referrer;
                                    window.location.href = referrer;
                            }
                            /*}*/
                            }
                    });
            }
            }
            ///////script end of Exiting USER/////////
            }
            //});
            //});
            }
</script>
<!--Sign in or sign Up script end here-->

<!--Forgot password script start here-->
<script>
    $(document).ready(function () {
    $('.forgot_p').click(function () {
    $('#reg_login_dv').slideUp();
            $('#forgot_dv').slideDown();
            $('.sn').slideUp();
            $('.forgt').slideDown();
            $('#social_tbl').hide();
    });
            $('#forgt_btn').click(function () {
    var mail_id = $('#mail').val();
            var pattern = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (mail_id == '') {
    alert('Please enter your email address');
            $('#mail').focus();
            return false;
    } else if (!pattern.test(mail_id)) {
    alert('Please provide a valid email address');
            $('#mail').select();
            return false;
    } else {
    $('#forgt_btn').val('Processing...');
            $.ajax({
            url: '<?php echo base_url(); ?>user/forgot_password',
                    method: 'post',
                    data: {email: mail_id},
                    success: function (result)
                    {

                    if (result == 'not_exist') {
                    $(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>This email address is not exist');
                            $(".error_msg").slideDown(300);
                            $('#forgt_btn').val('Continue');
                    }
                    if (result == 'mail_sent') {
                    $(".error_msg").html('<i class="fa fa-info-circle"></i>Check your email and enter that OTP to reset your password.'
                            );
                            $(".error_msg").css({"background-color": "#bde5f8", "border": "1px solid #8598e1", "text-align": "left", "color": "#00529b"});
                            $(".error_msg").slideDown(300);
                            $('#forgot_dv').slideUp();
                            $('#otp_pass_dv').slideDown();
                    }

                    }
            });
    }

    });
    });
            ///////OTP Verification start here////////
                    function checkOtp() {         var otp = $('#otp').val();
                            if (otp == '') {
                    alert('Please enter your OTP');
                            $('#otp').focus();
                            return false;
                    } else {

                    $('#otp_btn').val('Processing...');
                            $.ajax({
                            url: '<?php echo base_url(); ?>user/check_otp_forgot_password',
                                    method: 'post',
                                    data: {otp: otp},
                                    success: function (result)                                     {                                     if (result === 'not_exist') {
                                    $(".error_msg").css({'background-color': 'pink', 'border': '1px solid salmon', 'color': '#790606'});
                                            $(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>This OTP is not matched.');
                                            $('#otp_btn').val('Continue');
                                    }
                                    else {
                                    $('#chng_email').val(result);
                                            $(".error_msg").slideUp();
                                            $('#otp_pass_dv').slideUp();
                                            $('#chng_pass_dv').slideDown();
                                    }
                                    }
                            });
                    }
                    }             ///////OTP Verification end here////////

            ///////Change password script start here////////
            function changedPassword() {         var email = $('#chng_email').val(); var psss = $('#new_pass').val(); var cpsss = $('#cnew_pass').val();
                    if (psss == '') {
            alert('Enter your new password');
                    $('#new_pass').focus();
                    return false;
            } else if (cpsss == '') {
            alert('Enter your confirm password'); $('#cnew_pass').focus();
                    return false;
            } else if (psss != cpsss) {
            alert('Password mismatch.');
                    $('#cnew_pass').select();
                    return false;
            } else {

            $('#chng_btn').val('Processing...');
                    $.ajax({
                    url: '<?php echo base_url(); ?>user/change_forgot_password',
                            method: 'post',
                            data: {email: email, pass: psss},
                            success: function (result)
                            {
                            if (result === 'not') {
                            $(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>Password not changed');
                                    $('#chng_btn').val('Change Password');
                            }
                            if (result == 'ok') {
                            window.location.reload(true);
                            }
                            }
                    });
            }
            }
            ///////Change password script end here////////	
</script> 
<!--Forgot password script end here-->

<div class="wrap" id="home">
    <!--/sign up-->
    <div class="info-inner">



        <div class="sign_in_dv">
            <div class="error_msg"></div>      

            <div id="reg_login_dv">

                <input type="text" class="input-text" id="mail_id" Placeholder="Enter email address">
               <!--<div class="single-bottom">  <label class="radio"><input type="radio" name="radio" id="n_user"> <span>No, I am a new User. </span></label> </div>
                       <div class="single-bottom"> <label class="radio"><input type="radio" name="radio" id="e_user" checked> <span> Yes, I have a password.</span></label> </div>-->

                <div id="pass_dv1">
                    <input type="password" name="npass" id="npass" class="input-text" Placeholder="Enter password">
                    <input type="password" name="ncpass" id="ncpass" class="input-text" Placeholder="Re-enter password" onKeyDown="if (event.keyCode == 13)
                                        document.getElementById('in_up').click()">
                </div>
                <div id="pass_dv2">
                    <input type="password" name="epass" id="epass" class="input-text" Placeholder="Enter password"  onkeydown="if (event.keyCode == 13)
                                                document.getElementById('in_up').click()">
                    <p class="forgot_p">Forgot Password ?? </p>
                </div>

                <?php
                if ($this->session->userdata('pre_session_id')) {
                    $pname = preg_replace('#"#', '-', preg_replace('#/#', '-', str_replace(' ', '-', strtolower($this->session->userdata['pre_session_id']['product_name'])))) . '/' . $this->session->userdata['pre_session_id']['product_id'] . '/' . $this->session->userdata['pre_session_id']['sku'];
                } else {
                    $pname = '';
                }
                ?>
                <input  type="submit" class="btn-sign-in" id="in_up" value="Login" onClick="logSignupFunction('<?= $pname; ?>')">

                <div class="new_exist">
                    <span id="newtomoonboy">  <label ><input type="radio" name="radio" id="n_user" style="display:none;"> New To <?= COMPANY ?> ??  Sign Up </label></span>
                    <span id="exixtingusertomoonboy"><label ><input type="radio" name="radio" id="e_user" checked style="display:none;"> Existing User ?? Login</label></span>
                </div>

                <div class="social-login">
                    <ul>
                        <li><a class="fb" href="#" onClick="Login()"> <i></i> Sign in with Facebook</a></li>
                        <li><a class="goog" href="#" onClick="login()"> <i></i> Sign in with Google</a></li>
                    </ul>
                </div>

            </div>

            <!--Forgot password div start here-->
            <div id="forgot_dv">
                <h4><?= COMPANY ?> Password Assistance</h4>
                <span>Enter your email address to regenerate password</span><br/>
                <input type="text" class="input-text" id="mail" Placeholder="Enter email address">
                <input type="submit" id="forgt_btn" class="btn1 btn-sign-in" value="Continue">
            </div>

            <div id="otp_pass_dv">
                <h4>Enter the OTP</h4>
                <input type="text" class="input-text" name="otp" id="otp" placeholder="Enter OTP">
                <input type="submit" id="otp_btn" onClick="checkOtp()" class="btn1 btn-sign-in" value="Continue"></td>
            </div>

            <div id="chng_pass_dv">

                <h4>Chenge your password</h4>
                <input type="text" class="input-text" name="chng_email" id="chng_email" readonly>

                <input type="password" class="input-text" name="new_pass" id="new_pass" placeholder="Enter new password">

                <input type="password" class="input-text" name="cnew_pass" id="cnew_pass" placeholder="Confirm new password">

                <input type="submit" id="chng_btn" onClick="changedPassword()" class="btn1 btn-sign-in" value="Change Password">

            </div>
            <!--Forgot password div end here-->

            <div class="clearfix"></div>



        </div>   

        <div class="clearfix"> </div> 
    </div>
</div>
<script type="text/javascript">
                    function logout()
                    {
                    gapi.auth.signOut();
                            location.reload();
                    }

            function login()
            {
            //alert(logintobuysku);         var myParams = {
            'clientid': '374135531965-v38pq554dp7ficmeuvnoqvnvoig7c2vv.apps.googleusercontent.com',
                    'cookiepolicy': 'single_host_origin',
                    'callback': 'loginCallback',
                    'approvalprompt': 'auto',
                    'scope': 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.profile.emails.read'
            };
                    gapi.auth.signIn(myParams);
            }
    function loginCallback(result)
    {
    if (result['status']['signed_in'])
    {
    var request = gapi.client.plus.people.get(
    {
    'userId': 'me'
    });
            request.execute(function (resp)
            {
            var email = '';
                    if (resp['emails'])
            {
            for (i = 0; i < resp['emails'].length; i++)
            {
            if (resp['emails'][i]['type'] == 'account')
            {
            email = resp['emails'][i]['value'];
            }
            }
            }

            /*var str = "Name:" + resp['displayName'] + "<br>";
             str += "Image:" + resp['image']['url'] + "<br>";
             str += "<img src='" + resp['image']['url'] + "' /><br>";
             str += "URL:" + resp['url'] + "<br>";
             str += "Email:" + email + "<br>";
             document.getElementById("profile").innerHTML = str;*/
            //var name = resp['displayName'];  //get the full name//
            var fname = resp['name']['givenName'];
                    var lname = resp['name']['familyName'];
                    var mail = email;
                    //alert(name);return false;
                    var photo = resp['image']['url'];
                    /*document.getElementById('user_name').value = name ;
                     document.getElementById('user_email').value = mail ;                      document.getElementById('user_photo').value = photo ;*/


                    //var url = "profile_fillup.php?name="+name+"&mail="+email;
                    //var url = "social_login/gpluslogin/manage_start_profile_fillup.php?name="+name+"&mail="+email;

                    /*var url = "<?php //echo site_url();           ?>chm/socialLogin/" + encodeURIComponent(mail+','+name);			
                     window.location.href = url;*/
                    //var url = 'myprofile.php';			

                    $.ajax({
                    url: '<?php echo base_url(); ?>user/mob_socialLogin',
                            method: 'post',
                            data: {fname: fname, lname: lname, mail_id: mail, photo: photo},
                            success: function (result)
                            {
                            //$(".error_msg").html(result);return false;
                            if (result == 'blocked') {
                            $(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>This user is already blocked');
                                    $(".error_msg").slideDown(200);
                            }
                            if (result == 'ok' || logintobuysku != '') {
                            if (logintobuysku != '')
                            {
<?php echo $this->session->unset_userdata('logintobuysku'); ?>
                            window.location.href = "<?php echo base_url() . 'mycart/checkout_process'; ?>";
                            }
                            else {
                            if (logintobuysku != '')
                            {
<?php echo $this->session->unset_userdata('logintobuysku'); ?>
                            window.location.href = "<?php echo base_url() . 'mycart/checkout_process'; ?>";
                            } else {                             var referrer = document.referrer;
                                    window.location.href = referrer;
                            }
                            }
                            //window.location.reload(true);
                            }
                            }
                    });
            });
    }
    }
    function onLoadCallback()
    {
    gapi.client.setApiKey('AIzaSyBXmP5Od2YA_lFq-qUAwt8s9tDFtvUcvcE');
            gapi.client.load('plus', 'v1', function () {
            });
    }

</script>




<script type="text/javascript">
    (function () {         var po = document.createElement('script');
            po.type = 'text/javascript';
            po.async = true; po.src = 'https://apis.google.com/js/client.js?onload=onLoadCallback';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(po, s);
    })();</script>

<!---End Script for g+ Login --->


<!---Start Script for FB Login --->
<script>
            window.fbAsyncInit = function () {
            FB.init({
            appId: '<?= FB_APP_ID ?>', // Set YOUR APP ID
                    //channelUrl : 'http://hayageek.com/examples/oauth/facebook/oauth-javascript/channel.html', // Channel File
                    status: true, // check login status
                    cookie: true, // enable cookies to allow the server to access the session
                    xfbml: true  // parse XFBML
            });
                    FB.Event.subscribe('auth.authResponseChange', function (response)
                    {             if (response.status === 'connected')
                    {
                    document.getElementById("message").innerHTML += "<br>Connected to Facebook"; //SUCCESS

                    }
                    else if (response.status === 'not_authorized')
                    {
                    document.getElementById("message").innerHTML += "<br>Failed to Connect";
                            //FAILED
                    } else
                    {
                    document.getElementById("message").innerHTML += "<br>Logged Out";
                            //UNKNOWN ERROR
                    }
                    });
            };
            function Login()
            {
            //alert(logintobuysku);
            FB.login(function (response) {             if (response.authResponse)
            {
            getUserInfo();
            } else
            {
            console.log('User cancelled login or did not fully authorize.');
            }
            }, {scope: 'email,user_photos,user_videos'});
            }

    function getUserInfo() {
    FB.api('/me', {fields: ['name', 'email', 'picture']}, function (response) {

    //FB.api('/me',{fields: ['first_name', 'last_name', 'email', 'picture', 'address']}, function(response) {

    /*var str="<b>Name</b> : "+response.name+"<br>";
     str +="<b>Link: </b>"+response.link+"<br>";
     str +="<b>Username:</b> "+response.username+"<br>";
     str +="<b>id: </b>"+response.id+"<br>";
     str +="<b>Email:</b> "+response.email+"<br>";
     str +="<input type='button' value='Get Photo' onclick='getPhoto();'/>";
     str +="<input type='button' value='Logout' onclick='Logout();'/>";
     document.getElementById("status").innerHTML=str;*/

    //console.log(response);return false;

    var name = response.name;
            //separate fname and lname script start //
            var array = name.split(" "); var fname = array[0];
            var lname = array[1];
            //separate fname and lname script end //

            var mail = response.email;
            var photo = response.picture.data.url;
            $.ajax({
            url: '<?php echo base_url(); ?>user/mob_socialLogin',
                    method: 'post',
                    data: {fname: fname, lname: lname, mail_id: mail, photo: photo},
                    success: function (result)
                    {
                    //$(".error_msg").html(result);return false;
                    if (result == 'blocked') {
                    $(".error_msg").html('<i class="glyphicon glyphicon-exclamation-sign"></i>This user is already blocked');
                            $(".error_msg").slideDown(200);
                    }
                    if (result == 'ok' || logintobuysku != '') {

                    if (logintobuysku != '')
                    {
<?php echo $this->session->unset_userdata('logintobuysku'); ?>
                    window.location.href = "<?php echo base_url() . 'mycart/checkout_process'; ?>";
                    }
                    else {

                    if (logintobuysku != '')
                    {
<?php echo $this->session->unset_userdata('logintobuysku'); ?>
                    window.location.href = "<?php echo base_url() . 'mycart/checkout_process'; ?>";
                    } else {
                    var referrer = document.referrer;
                            window.location.href = referrer;
                    }
                    }
                    //window.location.reload(true);
                    }
                    }
            });
    });
    }

    /*function getPhoto()
     {
     FB.api('/me/picture?type=normal', function(response) {
     
     var str="<br/><b>Pic</b> : <img src='"+response.data.url+"'/>";
     document.getElementById("status").innerHTML+=str;
     
     });
     
     }*/

    function Logout()
    {
    FB.logout(function () {
    document.location.reload();
    });
    }

    // Load the SDK asynchronously
    (function (d) {
    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
            if (d.getElementById(id)) {
    return;
    }
    js = d.createElement('script');
            js.id = id;
            js.async = true; js.src = "//connect.facebook.net/en_US/all.js";
            ref.parentNode.insertBefore(js, ref);
    }(document));

</script>     

<?php include "footer.php"; ?>      