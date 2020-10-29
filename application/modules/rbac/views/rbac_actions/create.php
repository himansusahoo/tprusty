<div class="col-sm-12">
    <div class="card card-primary card-outline">
        <?php if ($this->layout->navCardTitle): ?>
            <div class="card-header">
                <h3 class="card-title"><?= $this->layout->navCardTitle ?></h3>
            </div>
            <?php
        endif;
        $form_attribute = array(
            "name" => "rbac_actions",
            "id" => "rbac_actions",
            "method" => "POST"
        );
        $form_action = base_url('create-rbac-action');
        echo form_open($form_action, $form_attribute);
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
            <div class = 'form-group row'>
                <label for = 'code' class = 'col-sm-2 col-form-label'>Module</label>
                <div class = 'col-sm-3'>
                    <?php
                    $attribute = array(
                        "id" => "module_id",
                        "class" => "form-control",
                        "title" => "",
                        "type" => "text",
                        "value" => (isset($data["module_id"])) ? $data["module_id"] : ""
                    );
                    echo form_dropdown('module_id', $module_list, (isset($data["module_id"])) ? $data["module_id"] : "", $attribute);
                    echo form_error("module_id");
                    ?>
                </div>
            </div>
        </div>

        <div class="card-footer text-right">
            <span>
                <a class="text-right btn btn-default select_menu" data-parent-menu="rbac-actions-list" href="<?= base_url('rbac-actions-list') ?>">
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
        $('#module_id').select2({
            theme: 'bootstrap4',
            allowClear: true,
            placeholder: {
                id: "", // the value of the option
                text: 'Select Module'
            }
        });
        $('#rbac_actions').validate({
            errorElement:'div',
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
                    required: 'Please enter action name.'
                },
                code: {
                    required: 'Please enter action code.'
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

