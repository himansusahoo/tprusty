<div class="col-sm-12">
    <div class="card card-primary card-outline">
        <?php if ($this->layout->navCardTitle): ?>
            <div class="card-header">
                <h3 class="card-title"><?= $this->layout->navCardTitle ?></h3>
            </div>
            <?php
        endif;
        $form_attribute = array(
            "name" => "rbac_modules",
            "id" => "rbac_modules",
            "method" => "POST"
        );
        $form_action = "/rbac/rbac_modules/edit";
        echo form_open($form_action, $form_attribute);
        $attribute = array(
            "name" => "module_id",
            "id" => "module_id",
            "class" => "form-control",
            "title" => "",
            "required" => "",
            "type" => "hidden",
            "value" => (isset($data["module_id"])) ? $data["module_id"] : ""
        );
        echo form_error("module_id");
        echo form_input($attribute);
        ?>
        <div class="card-body">
            <div class = 'form-group row'>
                <label for = 'name' class = 'col-sm-2 col-form-label ele_required'>Name</label>
                <div class = 'col-sm-3'>
                    <?php
                    $attribute = array(
                        "name" => "name",
                        "id" => "name",
                        "class" => "form-control",
                        "title" => "",
                        "type" => "text",
                        "value" => (isset($data["name"])) ? $data["name"] : ""
                    );                    
                    echo form_input($attribute);
                    echo form_error("name");
                    ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'code' class = 'col-sm-2 col-form-label ele_required'>Code</label>
                <div class = 'col-sm-3'>
                    <?php
                    $attribute = array(
                        "name" => "code",
                        "id" => "code",
                        "class" => "form-control",
                        "title" => "",
                        "type" => "text",
                        "value" => (isset($data["code"])) ? $data["code"] : ""
                    );                    
                    echo form_input($attribute);
                    echo form_error("code");
                    ?>
                </div>
            </div>

        </div>

        <div class="card-footer text-right">
            <span>
                <a class="text-right btn btn-default select_menu" data-parent-menu="rbac-modules-list" href="<?= base_url('rbac-modules-list') ?>">
                    <span class="glyphicon glyphicon-th-list"></span> Cancel
                </a>
            </span>
            <span>
                <input type="submit" id="submit" value="Update" class="btn btn-primary">
            </span>

        </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>
    $(document).ready(function () {

        $('#rbac_modules').validate({
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
                    required: 'Please enter module name.'
                },
                code: {
                    required: 'Please enter module code.'
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