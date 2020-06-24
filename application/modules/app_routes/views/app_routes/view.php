<div class="col-sm-12">
    <div class = 'form-group row'>
        <label for = 'module' class = 'col-sm-2 col-form-label'>Module</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["module"])) ? $data["module"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'slug' class = 'col-sm-2 col-form-label'>Slug</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["slug"])) ? $data["slug"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'path' class = 'col-sm-2 col-form-label'>Path</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["path"])) ? $data["path"] : "" ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>app_routes/app_routes/index">
                <span class="glyphicon glyphicon-th-list"></span> Back
            </a>
        </div>
    </div>

</div>