<div class="col-sm-12">
    <div class="card card-primary card-outline">
        <?php if ($this->layout->navCardTitle): ?>
            <div class="card-header">
                <h3 class="card-title"><?= $this->layout->navCardTitle ?></h3>
            </div>
        <?php endif; ?>
        <div class="card-body">
            <div class = 'form-group row'>
                <label for = 'name' class = 'col-sm-2 col-form-label'>Name</label>
                <div class = 'col-sm-3'>
                    <?php echo (isset($data["name"])) ? $data["name"] : "" ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'code' class = 'col-sm-2 col-form-label'>Code</label>
                <div class = 'col-sm-3'>
                    <?php echo (isset($data["code"])) ? $data["code"] : "" ?>
                </div>
            </div>

        </div>

        <div class="card-footer text-right">
            <span>
                <a class="text-right btn btn-default select_menu" data-parent-menu="rbac-modules-list" href="<?= base_url('rbac-modules-list') ?>">
                    <span class="glyphicon glyphicon-th-list"></span> Back
                </a>
            </span>            

        </div>
        <?php echo form_close() ?>
    </div>
</div>