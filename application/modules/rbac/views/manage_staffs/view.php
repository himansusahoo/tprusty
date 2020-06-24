<div class="col-sm-10">
    <div class="row">        
        <div class="col-sm-6">
            <div class = 'form-group row'>
                <label for = 'first_name' class = 'col-sm-5 col-form-label '>First name</label>
                <div class = 'col-sm-7'>
                    <?php echo (isset($data["first_name"])) ? $data["first_name"] : "" ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'last_name' class = 'col-sm-5 col-form-label '>Last name</label>
                <div class = 'col-sm-7'>
                    <?php echo (isset($data["last_name"])) ? $data["last_name"] : "" ?>
                </div>
            </div>            
            <div class = 'form-group row'>
                <label for = 'login_id' class = 'col-sm-5 col-form-label '>Employee id</label>
                <div class = 'col-sm-7'>
                    <?php echo (isset($data["login_id"])) ? $data["login_id"] : "" ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'email' class = 'col-sm-5 col-form-label '>Email</label>
                <div class = 'col-sm-7'>
                    <?php echo (isset($data["email"])) ? $data["email"] : "" ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'email_verified' class = 'col-sm-5 col-form-label '>Email Verified</label>
                <div class = 'col-sm-7'>
                    <?php echo (isset($data["email_verified"])) ? $data["email_verified"] : "" ?>
                </div>
            </div>
        </div>

        <div class="col-sm-6">                        
            <div class = 'form-group row'>
                <label for = 'mobile' class = 'col-sm-5 col-form-label '>Mobile</label>
                <div class = 'col-sm-7'>
                    <?php echo (isset($data["mobile"])) ? $data["mobile"] : "" ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'mobile_verified' class = 'col-sm-5 col-form-label '>Mobile Verified</label>
                <div class = 'col-sm-7'>
                    <?php echo (isset($data["mobile_verified"])) ? $data["mobile_verified"] : "" ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'login_status' class = 'col-sm-5 col-form-label '>Login Status</label>
                <div class = 'col-sm-7'>
                    <?php echo (isset($data["login_status"])) ? $data["login_status"] : "" ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'status' class = 'col-sm-5 col-form-label '>Status</label>
                <div class = 'col-sm-7'>
                    <?php echo (isset($data["status"])) ? $data["status"] : "" ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class = 'form-group row'>  
            <div class="col-sm-12">
                <a class="text-right btn btn-default" href="<?=base_url('employee-list')?>">
                    <span class="glyphicon glyphicon-th-list"></span> Back
                </a>
            </div>
        </div>
    </div>    
</div>