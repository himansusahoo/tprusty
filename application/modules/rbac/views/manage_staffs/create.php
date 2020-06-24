<div class="col-sm-10">
    <div class="row">
        <?php
        $form_attribute = array(
            "name" => "staff_users",
            "id" => "staff_users",
            "method" => "POST",
            "autocomplete" => "off"
        );
        $form_action = base_url('create-employee-profile');
        echo form_open($form_action, $form_attribute);
        ?>
        <div class="col-sm-6">
            <div class = 'form-group row'>
                <label for = 'first_name' class = 'col-sm-5 col-form-label ele_required'>First name</label>
                <div class = 'col-sm-7'>
                    <?php
                    $attribute = array(
                        "name" => "first_name",
                        "id" => "first_name",
                        "class" => "form-control",
                        "type" => "text",
                        "value" => (isset($data["first_name"])) ? $data["first_name"] : ""
                    );
                    echo form_error("first_name");
                    echo form_input($attribute);
                    ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'last_name' class = 'col-sm-5 col-form-label ele_required'>Last name</label>
                <div class = 'col-sm-7'>
                    <?php
                    $attribute = array(
                        "name" => "last_name",
                        "id" => "last_name",
                        "class" => "form-control",
                        "type" => "text",
                        "value" => (isset($data["last_name"])) ? $data["last_name"] : ""
                    );
                    echo form_error("last_name");
                    echo form_input($attribute);
                    ?>
                </div>
            </div>            
<!--            <div class = 'form-group row'>
                <label for = 'login_id' class = 'col-sm-5 col-form-label ele_required'>Employee id</label>
                <div class = 'col-sm-7'>
                    <?php
                    $attribute = array(
                        "name" => "login_id",
                        "id" => "login_id",
                        "class" => "form-control",
                        "type" => "text",
                        "value" => (isset($data["login_id"])) ? $data["login_id"] : ""
                    );
                    echo form_error("login_id");
                    echo form_input($attribute);
                    ?>
                </div>
            </div>-->
            <div class = 'form-group row'>
                <label for = 'email' class = 'col-sm-5 col-form-label ele_required'>Email</label>
                <div class = 'col-sm-7'>
                    <?php
                    $attribute = array(
                        "name" => "email",
                        "id" => "email",
                        "class" => "form-control",
                        "type" => "text",
                        "value" => (isset($data["email"])) ? $data["email"] : ""
                    );
                    echo form_error("email");
                    echo form_input($attribute);
                    ?>
                </div>
            </div>
        </div>

        <div class="col-sm-6">            
            <div class = 'form-group row'>
                <label for = 'password' class = 'col-sm-5 col-form-label ele_required'>Password</label>
                <div class = 'col-sm-7'>
                    <?php
                    $attribute = array(
                        "name" => "password",
                        "id" => "password",
                        "class" => "form-control",
                        "type" => "password",
                        "value" => "",
                        "autocomplete" => "off"
                    );
                    echo form_error("password");
                    echo form_input($attribute);
                    ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 're-password' class = 'col-sm-5 col-form-label ele_required'>Confirm Password</label>
                <div class = 'col-sm-7'>
                    <?php
                    $attribute = array(
                        "name" => "re_password",
                        "id" => "re_password",
                        "class" => "form-control",
                        "type" => "password",
                        "value" => "",
                        "autocomplete" => "off"
                    );
                    echo form_error("password");
                    echo form_input($attribute);
                    ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'mobile' class = 'col-sm-5 col-form-label ele_required'>Mobile</label>
                <div class = 'col-sm-7'>
                    <?php
                    $attribute = array(
                        "name" => "mobile",
                        "id" => "mobile",
                        "class" => "form-control",
                        "type" => "text",
                        "value" => (isset($data["mobile"])) ? $data["mobile"] : ""
                    );
                    echo form_error("mobile");
                    echo form_input($attribute);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class = 'form-group row'>  
            <div class="col-sm-12">
                <a class="text-right btn btn-default" href="<?=base_url('employee-list')?>">
                    <span class="glyphicon glyphicon-th-list"></span> Cancel
                </a>
                <input type="submit" id="submit" value="Save" class="btn btn-primary">
            </div>
        </div>
    </div>
    <?php echo form_close() ?>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#staff_users').validate({
            rules: {
                first_name: {
                    required: true,
                    letters_space_only: true
                },
                last_name:{
                    required: true,
                    letters_space_only: true
                },
                login_id:{
                    required: true,
                    letter_number_nospace:true
                },
                email:{
                    required: true,
                    email:true
                },
                password:{
                    required: true,
                    alphanumeric:true
                },
                re_password:{
                    required: true,
                    alphanumeric:true,
                    equalTo: "#password"
                },
                mobile:{
                    required: true,
                    'mobile_no':true
                }                
            },
            messages: {
                first_name: {
                    required: "Please enter your first name.",
                    letters_space_only: "Only alphabates are allowed."
                },
                last_name:{
                    required: "Please enter your last name.",
                    letters_space_only: "Only alphabates are allowed."
                },
                login_id:{
                    required: "Please generate employee id."
                    
                },
                email:{
                    required: "Please enter email id.",
                    email:"Please enter valid email id."
                },
                password:{
                    required: "Please enter password.",
                    alphanumeric:"Please enter alphanumeric value."
                },
                re_password:{
                    required: "Please re-enter password.",
                    alphanumeric:"Please enter alphanumeric value.",
                    equalTo:"Your password and confirmation password do not match."
                },
                mobile:{
                    required: "Please enter your 10 digit mobile number.",
                }   
            },
            submitHandler: function (form) {
                if ($(form).valid())
                    form.submit();
                return false;
            }
        });
    });
</script>