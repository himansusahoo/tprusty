<div class="col-sm-12">
    <div class = 'form-group row'>
        <label for = 'user_id' class = 'col-sm-2 col-form-label'>User id</label>
        <div class = 'col-sm-3'>
            <?php echo (isset($data["user_id"])) ? $data["user_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'permission_id' class = 'col-sm-2 col-form-label'>Permission id</label>
        <div class = 'col-sm-3'>
            <?php echo (isset($data["permission_id"])) ? $data["permission_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'assigned_by' class = 'col-sm-2 col-form-label'>Assigned by</label>
        <div class = 'col-sm-3'>
            <?php echo (isset($data["assigned_by"])) ? $data["assigned_by"] : "" ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?php echo APP_BASE ?>rbac/rbac_custom_permissions/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
    </div>

</div>