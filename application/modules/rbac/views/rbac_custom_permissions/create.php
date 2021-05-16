<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "rbac_custom_permissions",
        "id" => "rbac_custom_permissions",
        "method" => "POST"
    );
    $form_action = "/rbac/rbac_custom_permissions/create";
    echo form_open($form_action, $form_attribute);
    ?>
    <div class = 'form-group row'>
        <label for = 'user_id' class = 'col-sm-2 col-form-label'>User id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "user_id",
                "id" => "user_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "number",
                "value" => (isset($data["user_id"])) ? $data["user_id"] : ""
            );
            echo form_error("user_id");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'permission_id' class = 'col-sm-2 col-form-label'>Permission id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "permission_id",
                "id" => "permission_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $permission_id = (isset($data['permission_id'])) ? $data['permission_id'] : '';
            echo form_error("permission_id");
            echo form_dropdown($attribute, $permission_id_list, $permission_id);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'assigned_by' class = 'col-sm-2 col-form-label'>Assigned by</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "assigned_by",
                "id" => "assigned_by",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $assigned_by = (isset($data['assigned_by'])) ? $data['assigned_by'] : '';
            echo form_error("assigned_by");
            echo form_dropdown($attribute, $assigned_by_list, $assigned_by);
            ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?php echo APP_BASE ?>rbac/rbac_custom_permissions/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
        <div class = 'col-sm-1'>
            <input type="submit" id="submit" value="Save" class="btn btn-primary">
        </div>
    </div>
    <?php echo form_close() ?>
</div>