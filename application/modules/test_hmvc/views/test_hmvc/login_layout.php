<?php ?>
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<style>
    #login_error>label{
        font-weight: 500;
    }
</style>
<div class="login-box">
    <div class="text-center" >
        <div id="login_error">
            <?php
            echo validation_errors();
            if ($this->session->flashdata('error')) {
                echo $this->session->flashdata('error');
            };
            ?>
        </div>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form action="<?= base_url('admin_users/sign_in'); ?>" method="post" id="admin_login" name="admin_login">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" id="user_email" name="user_email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" id="user_pass" name="user_pass">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8"></div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block" id="admin_login_submit" name="admin_login_submit">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            
        </div>
        <!-- /.login-card-body -->
    </div>
</div>