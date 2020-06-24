<div class="col-sm-12">
    <div class = 'form-group row'>
        <label for = 'first_name' class = 'col-sm-2 col-form-label'>First name</label>
        <div class = 'col-sm-3'>
            <?php echo (isset($data["first_name"])) ? $data["first_name"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'last_name' class = 'col-sm-2 col-form-label'>Last name</label>
        <div class = 'col-sm-3'>
            <?php echo (isset($data["last_name"])) ? $data["last_name"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'login_id' class = 'col-sm-2 col-form-label'>Login id</label>
        <div class = 'col-sm-3'>
            <?php echo (isset($data["login_id"])) ? $data["login_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'email' class = 'col-sm-2 col-form-label'>Email</label>
        <div class = 'col-sm-3'>
            <?php echo (isset($data["email"])) ? $data["email"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'password' class = 'col-sm-2 col-form-label'>Password</label>
        <div class = 'col-sm-3'>
            <?php echo (isset($data["password"])) ? $data["password"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'login_status' class = 'col-sm-2 col-form-label'>Login status</label>
        <div class = 'col-sm-3'>
            <?php echo (isset($data["login_status"])) ? $data["login_status"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'mobile' class = 'col-sm-2 col-form-label'>Mobile</label>
        <div class = 'col-sm-3'>
            <?php echo (isset($data["mobile"])) ? $data["mobile"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'mobile_verified' class = 'col-sm-2 col-form-label'>Mobile verified</label>
        <div class = 'col-sm-3'>
            <?php echo (isset($data["mobile_verified"])) ? $data["mobile_verified"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'email_verified' class = 'col-sm-2 col-form-label'>Emial verified</label>
        <div class = 'col-sm-3'>
            <?php echo (isset($data["email_verified"])) ? $data["email_verified"] : "" ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?php echo APP_BASE ?>rbac/rbac_users/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
    </div>

</div>