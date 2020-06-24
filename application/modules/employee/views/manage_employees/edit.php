<style>
    .treeSelector-container{
        width: 100% !important;
    }
    .treeSelector-container .treeSelector-wrapper.visible{
        width: 100% !important;
    }
</style>
<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "staff_users",
        "id" => "staff_users",
        "method" => "POST"
    );
    $form_action = base_url('edit-employee-profile-save');
    echo form_open($form_action, $form_attribute);
    ?>
    <?php
    $attribute = array(
        "name" => "user_id",
        "id" => "user_id",
        "class" => "form-control",
        "title" => "",
        "required" => "",
        "type" => "hidden",
        "value" => (isset($data["user_id"])) ? $data["user_id"] : ""
    );
    echo form_error("user_id");
    echo form_input($attribute);
    ?><div class = 'form-group row'>
        <label for = 'first_name' class = 'col-sm-2 col-form-label ele_required'>First name</label>
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
            echo form_input($attribute);
            echo form_error("first_name");
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'last_name' class = 'col-sm-2 col-form-label ele_required'>Last name</label>
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
            echo form_input($attribute);
            echo form_error("last_name");
            ?>
        </div>
    </div>    
    <div class = 'form-group row'>
        <label for = 'email' class = 'col-sm-2 col-form-label ele_required'>Email</label>
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
            echo form_input($attribute);
            echo form_error("email");
            ?>
        </div>
    </div> 
    <div class = 'form-group row'>
        <label for = 'mobile' class = 'col-sm-2 col-form-label ele_required'>Mobile</label>
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
            echo form_input($attribute);
            echo form_error("mobile");
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'mobile' class = 'col-sm-2 col-form-label ele_required'>Status</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "status",
                "id" => "status",
                "class" => "form-control",
                "title" => "Select user status"                
            );
            $status = (isset($data['status'])) ? $data['status'] : 'active';
            $status_list=array('active'=>'Active','inactive'=>'Inactive');
            echo form_dropdown($attribute, $status_list, $status);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'user_roles' class = 'col-sm-2 col-form-label ele_required'>Employee Roles</label>
        <div class = 'col-sm-3'> 
            <?php
            $attribute = array(
                "name" => "employee_roles",
                "id" => "employee_roles",
                "class" => "form-control",
                "type" => "hidden",
                "value" => (isset($data["employee_roles"])) ? $data["employee_roles"] : ""
            );            
            echo form_input($attribute);            
            ?>
            <div class="treeSelector"></div>            
            <?php echo form_error("employee_roles");?>
        </div>
    </div>
    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= base_url('employee-list') ?>">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
        <div class = 'col-sm-1'>
            <input type="submit" id="submit" value="Update" class="btn btn-primary">
        </div>
    </div>
    <?php echo form_close() ?>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var rootNode = <?= $data['roles_json'] ?>;
        var assigned_roles=[<?=$data['employee_roles']?>];
        $('div.treeSelector').treeSelector(rootNode, assigned_roles, function (e, values) {
            //console.info('onChange', e, values);
            var selected_vals=values.toString();
            $('#employee_roles').val(selected_vals);
            $('#employee_roles').closest('div').find('div.error').hide();
        }, {
            checkWithParent: true,
            titleWithParent: true,
            notViewClickParentTitle: true
        });
        $('#staff_users').validate({
            rules: {
                first_name: {
                    required: true,
                    letters_space_only: true
                },
                last_name: {
                    required: true,
                    letters_space_only: true
                },
                login_id: {
                    required: true,
                    letter_number_nospace: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    alphanumeric: true
                },
                re_password: {
                    required: true,
                    alphanumeric: true,
                    equalTo: "#password"
                },
                mobile: {
                    required: true,
                    'mobile_no': true
                },
                employee_roles: {
                    required: true                    
                }
            },
            messages: {
                first_name: {
                    required: "Please enter your first name.",
                    letters_space_only: "Only alphabates are allowed."
                },
                last_name: {
                    required: "Please enter your last name.",
                    letters_space_only: "Only alphabates are allowed."
                },
                login_id: {
                    required: "Please generate employee id."

                },
                email: {
                    required: "Please enter email id.",
                    email: "Please enter valid email id."
                },
                password: {
                    required: "Please enter password.",
                    alphanumeric: "Please enter alphanumeric value."
                },
                re_password: {
                    required: "Please re-enter password.",
                    alphanumeric: "Please enter alphanumeric value.",
                    equalTo: "Your password and confirmation password do not match."
                },
                mobile: {
                    required: "Please enter your 10 digit mobile number.",
                },
                employee_roles:{
                    required: "Please select roles.",
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