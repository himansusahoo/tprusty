<div class="col-sm-12">
    <div class = 'form-group row'>
        <label for = 'role_id' class = 'col-sm-2 col-form-label'>Role id</label>
        <div class = 'col-sm-3'>
            <?php echo (isset($data["role_id"])) ? $data["role_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'permission_id' class = 'col-sm-2 col-form-label'>Permission id</label>
        <div class = 'col-sm-3'>
            <?php echo (isset($data["permission_id"])) ? $data["permission_id"] : "" ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?php echo APP_BASE ?>rbac/rbac_role_permissions/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
    </div>

</div>