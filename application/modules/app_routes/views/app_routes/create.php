<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "app_routes",
        "id" => "app_routes",
        "method" => "POST"
    );
    $form_action = base_url('create-app-routes');
    echo form_open($form_action, $form_attribute);
    ?>
    <div class = 'form-group row'>
        <label for = 'module' class = 'col-sm-2 col-form-label'>Module</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "module",
                "id" => "module",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["module"])) ? $data["module"] : ""
            );
            echo form_error("module");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'slug' class = 'col-sm-2 col-form-label'>Slug</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "slug",
                "id" => "slug",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $value = (isset($data["slug"])) ? $data["slug"] : "";
            echo form_error("slug");
            echo form_input($attribute, $value);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'path' class = 'col-sm-2 col-form-label'>Path</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "path",
                "id" => "path",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $value = (isset($data["path"])) ? $data["path"] : "";
            echo form_error("path");
            echo form_input($attribute, $value);
            ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>app_routes/app_routes/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
        <div class = 'col-sm-1'>
            <input type="submit" id="submit" value="Save" class="btn btn-primary">
        </div>
    </div>
    <?= form_close() ?>
</div>