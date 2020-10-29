<div class="col-sm-12">
    <div class="card card-primary card-outline">
        <?php if ($this->layout->navCardTitle): ?>
            <div class="card-header">
                <h3 class="card-title"><?= $this->layout->navCardTitle ?></h3>
            </div>
            <?php
        endif;
        $form_attribute = array(
            "name" => "rbac_roles",
            "id" => "rbac_roles",
            "method" => "POST"
        );
        $form_action = base_url('edit-rbac-role-save');
        echo form_open($form_action, $form_attribute);
        $attribute = array(
            "name" => "role_id",
            "id" => "role_id",
            "class" => "form-control",
            "title" => "",
            "required" => "",
            "type" => "hidden",
            "value" => (isset($data["role_id"])) ? $data["role_id"] : ""
        );
        echo form_error("role_id");
        echo form_input($attribute);
        ?>
        <div class="card-body">
            <div class = 'form-group row'>
                <label for = 'name' class = 'col-sm-2 col-form-label'>Name</label>
                <div class = 'col-sm-3'>
                    <?php
                    $attribute = array(
                        "name" => "name",
                        "id" => "name",
                        "class" => "form-control",
                        "title" => "",
                        "required" => "",
                        "type" => "text",
                        "value" => (isset($data["name"])) ? $data["name"] : ""
                    );
                    echo form_error("name");
                    echo form_input($attribute);
                    ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'code' class = 'col-sm-2 col-form-label'>Code</label>
                <div class = 'col-sm-3'>
                    <?php
                    $attribute = array(
                        "name" => "code",
                        "id" => "code",
                        "class" => "form-control",
                        "title" => "",
                        "required" => "",
                        "type" => "text",
                        "value" => (isset($data["code"])) ? $data["code"] : ""
                    );
                    echo form_error("code");
                    echo form_input($attribute);
                    ?>
                </div>
            </div>
        </div>

        <div class="card-footer text-right">
            <span>
                <a class="text-right btn btn-default select_menu" data-parent-menu="rbac-roles-list" href="<?= base_url('rbac-roles-list') ?>">
                    <span class="glyphicon glyphicon-th-list"></span> Cancel
                </a>
            </span>
            <span>
                <input type="submit" id="submit" value="Save" class="btn btn-primary">
            </span>

        </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#rbac_roles').validate({
            errorElement: 'div',
            rules: {
                name: {
                    required: true,
                    letters_space_only: true
                }, code: {
                    required: true,
                    alphanumeric: true
                }
            },
            messages: {
                name: {
                    required: 'Please enter role name.'
                },
                code: {
                    required: 'Please enter role code.'
                }
            },
            submitHandler: function (form) {
                if ($(form).valid())
                    form.submit();
                return false; // prevent normal form posting
            }
        });
    });
</script>