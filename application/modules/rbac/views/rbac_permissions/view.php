<div class="col-sm-12">
    <div class = 'form-group row'>
        <label for = 'module_id' class = 'col-sm-2 col-form-label'>Module id</label>
        <div class = 'col-sm-3'>
            <?php echo (isset($data["module_id"])) ? $data["module_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'action_id' class = 'col-sm-2 col-form-label'>Action id</label>
        <div class = 'col-sm-3'>
            <?php echo (isset($data["action_id"])) ? $data["action_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'status' class = 'col-sm-2 col-form-label'>Status</label>
        <div class = 'col-sm-3'>
            <?php echo (isset($data["status"])) ? $data["status"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'created' class = 'col-sm-2 col-form-label'>Created</label>
        <div class = 'col-sm-3'>
            <?php echo (isset($data["created"])) ? $data["created"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'modified' class = 'col-sm-2 col-form-label'>Modified</label>
        <div class = 'col-sm-3'>
            <?php echo (isset($data["modified"])) ? $data["modified"] : "" ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?php echo APP_BASE ?>rbac/rbac_permissions/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
    </div>

</div>