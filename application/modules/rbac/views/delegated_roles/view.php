<div class="col-sm-12">
    <div class = 'form-group row'>
        <label for = 'role_id' class = 'col-sm-2 col-form-label'>Role id</label>
        <div class = 'col-sm-3'>
            <?php echo (isset($data["role_id"])) ? $data["role_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'role_code' class = 'col-sm-2 col-form-label'>Role code</label>
        <div class = 'col-sm-3'>
            <?php echo (isset($data["role_code"])) ? $data["role_code"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'user_id' class = 'col-sm-2 col-form-label'>User id</label>
        <div class = 'col-sm-3'>
            <?php echo (isset($data["user_id"])) ? $data["user_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'delegated_by' class = 'col-sm-2 col-form-label'>Delegated by</label>
        <div class = 'col-sm-3'>
            <?php echo (isset($data["delegated_by"])) ? $data["delegated_by"] : "" ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?php echo APP_BASE ?>rbac/delegated_roles/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
    </div>

</div>