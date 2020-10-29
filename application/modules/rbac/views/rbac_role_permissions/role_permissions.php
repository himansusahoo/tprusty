<?php ?>
<div class="card text-bold card-primary card-outline">

    <div class="card-header text-left text-bold hand" id="super_panel">
        Set role permissions
        <div class="card-tools">
            <button type="button" id="collapse-all" class="btn btn-primary btn-sm">
                Collapse-all
            </button>
            <button type="button" class="btn btn-warning btn-sm" id="expand-all">
                Expand-all
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>           
        </div>
    </div>
    <div class="card-body">
        <?php
        //pmo($all_permissions);
        $indx = 1;
        foreach ($role_options as $role_id => $role_name) {

            $form_attribute = array(
                "name" => "rbac_permissions" . $role_id,
                "id" => "module_permissions" . $role_id,
                "method" => "POST",
                "class" => "form-horizontal",
            );
            $form_action = base_url('rbac-role-permissions');
            echo form_open($form_action, $form_attribute);            
            ?>
            <div class="card card card-warning card-outline collapsed-card">
                <div class="card-header text-left text-bold" >
                    <span  class="hand" data-card-widget="collapse"><?= ucfirst(strtolower($role_name)) ?></span>
                    <div class="card-tools">
                        <input type="submit" class="btn btn-primary btn-xs " value="Save">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>           
                    </div>
                </div>
                <div class="card-body" style="display: none;">
                    <input type="hidden" id="role_id" name="role_id" value="<?=$role_id?>">
                    <?php
                    $indx = 1;
                    $permissionsChunk = array_chunk($all_permissions, 3, 1);
                    //pmo($moduleChunks,1);
                    foreach ($permissionsChunk as $modules) :
                        ?>
                        <div class="card-deck mb-2">
                            <?php
                            foreach ($modules as $module) :
                                //pmo($module);
                                ?>
                                <h3> </h3>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <label><?= ucwords($module['module_name']) ?></label>
                                        </div>
                                        <div class="card-text">                                            
                                            <?php
                                            foreach ($module['children'] as $key => $option) {
                                                $attribute = array(
                                                    "name" => "permission[".$module['module_id']."][]",
                                                    "type" => "checkbox",
                                                    "value" => $option['permission_id']
                                                );
                                                if (isset($existing_role_permissions[$role_id]['children'])) {
                                                    
                                                    if (array_key_exists($option['permission_id'], $existing_role_permissions[$role_id]['children'])) {
                                                        $attribute['role_permission_id'] = $existing_role_permissions[$role_id]['children'][$option['permission_id']]['role_permission_id'];
                                                        $attribute['checked'] = 'checked';
                                                    }
                                                }

                                                echo '<div class="checkbox wraper_checkbox"><label style="width: 100%; font-weight:normal; font-size:14px; cursor:pointer;">' . form_checkbox($attribute) . ucfirst($option['action_name']) . '</label></div>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>                                

                                <?php
                            endforeach;
                            ?>
                        </div>
                        <?php
                    endforeach;
                    ?>

                </div>
                <div class="card-footer text-muted p-1">
                    <input type="submit" class="btn btn-xs btn-primary float-right" value="Save">
                </div>
            </div>
            <?php
            $indx++;

            echo form_close();
        }
        ?>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        //exapand/collapse all panel
        $('#expand-all').on('click', function () {
            $('.card-header').each(function () {
                if ($(this).closest('div.card').hasClass('collapsed-card')) {
                    $(this).click();
                }
            });
        });
        $('#collapse-all').on('click', function () {
            $('.card-header').each(function () {
                if (!$(this).closest('div.card').hasClass('collapsed-card')) {
                    $(this).click();
                }
            });
        });
    });
</script>
