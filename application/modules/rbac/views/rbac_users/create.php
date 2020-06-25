<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "rbac_users",
        "id" => "rbac_users",
        "method" => "POST"
    );
    $form_action = "/rbac/rbac_users/create";
    echo form_open($form_action, $form_attribute);
    ?>
    <div class = 'form-group row'>
        <label for = 'first_name' class = 'col-sm-2 col-form-label'>First name</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "first_name",
                "id" => "first_name",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["first_name"])) ? $data["first_name"] : ""
            );
            echo form_error("first_name");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'last_name' class = 'col-sm-2 col-form-label'>Last name</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "last_name",
                "id" => "last_name",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["last_name"])) ? $data["last_name"] : ""
            );
            echo form_error("last_name");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'login_id' class = 'col-sm-2 col-form-label'>Login id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "login_id",
                "id" => "login_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["login_id"])) ? $data["login_id"] : ""
            );
            echo form_error("login_id");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'email' class = 'col-sm-2 col-form-label'>Email</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "email",
                "id" => "email",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["email"])) ? $data["email"] : ""
            );
            echo form_error("email");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'password' class = 'col-sm-2 col-form-label'>Password</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "password",
                "id" => "password",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "password",
                "value" => ""
            );
            echo form_error("password");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 're-password' class = 'col-sm-2 col-form-label'>Confirm Password</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "re-password",
                "id" => "re-password",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "password",
                "value" => ""
            );
            echo form_error("password");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    
    <div class = 'form-group row'>
        <label for = 'mobile' class = 'col-sm-2 col-form-label'>Mobile</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "mobile",
                "id" => "mobile",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["mobile"])) ? $data["mobile"] : ""
            );
            echo form_error("mobile");
            echo form_input($attribute);
            ?>
        </div>
    </div>   

    <div class = 'form-group row'>
        <div class = 'col-sm-2'>
            <a class="text-right btn btn-default" href="<?=base_url('user-list')?>">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
            <input type="submit" id="submit" value="Save" class="btn btn-primary">
        </div>
    </div>
    <?php echo form_close() ?>
</div>