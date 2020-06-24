<?php ?>
<style>
    #login_error>label{
        font-weight: 500;
    }
</style>
<div class="login-box" style="margin:0% auto;">
    <div class="login-logo" style="font-size: 14px; color: red; height: 48px;">
        <div id="login_error">
            <?php echo validation_errors(); 
             if($this->session->flashdata('error')){
                 echo $this->session->flashdata('error');
             };?>
        </div>
    </div>
<!--    <div class="login-logo">
        <a href="<?=base_url('admin_users/sign_in');?>"><b>Admin</b>Login</a>
    </div>    -->
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Log in to start your session</p>
        <form action="<?=base_url('admin_users/sign_in');?>" method="post" id="admin_login" name="admin_login">
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email" id="user_email" name="user_email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" id="user_pass" name="user_pass">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>            
            <div class="row">
                <div class="col-xs-8"></div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" id="admin_login_submit" name="admin_login_submit" class="btn btn-primary btn-block btn-flat">Log in</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.login-box-body -->
</div>