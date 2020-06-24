<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "rbac_actions",
        "id" => "rbac_actions",
        "method" => "POST"
    );
    $form_action =  base_url('edit-rbac-action-save');
    echo form_open($form_action, $form_attribute);
    ?>
    <?php
    $attribute = array(
        "name" => "action_id",
        "id" => "action_id",
        "class" => "form-control",
        "title" => "",
        "required" => "",
        "type" => "hidden",
        "value" => (isset($data["action_id"])) ? $data["action_id"] : ""
    );
    echo form_error("action_id");
    echo form_input($attribute);
    ?><div class = 'form-group row'>
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

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= base_url('rbac-actions-list')?>">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
        <div class = 'col-sm-1'>
            <input type="submit" id="submit" value="Update" class="btn btn-primary">
        </div>
    </div>
    <?php echo form_close() ?>
</div>