<?php ?>
<div class="row">
    <div class="col">        
        <div class="card card-primary card-outline">
            <div class="card-header text-left text-bold hand_cursor" id="super_panel">
                Set module permissions
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
                $indx = 1;
                foreach ($tree as $module) {
                    $form_attribute = array(
                        "name" => "rbac_permissions".$module['module_id'],
                        "id" => "module_permissions".$module['module_id'],
                        "method" => "POST",
                        "class" => "form-horizontal",
                    );
                    $form_action = base_url('rbac-module-permissions');
                    echo form_open($form_action, $form_attribute);
                    ?>

                    <div class="card card-primary card-outline collapsed-card" panel_no="<?= $module['module_id'] ?>" id="panel_<?= $module['module_id'] ?>">
                        <div class="card-header text-left text-bold" data-card-widget="collapse">
                            <?php echo ucwords(strtolower($module['module_name'])) ?>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>           
                            </div>
                        </div>
                        <div class="card-body" style="display: none;">
                            <div class="row">
                                <?php
                                if (array_key_exists('children', $module) && is_array($module['children'])) {

                                    $chunks = array_chunk($module['children'], 3, 1);
                                    foreach ($chunks as $array_data) :
                                        ?>
                                        <div class="col">
                                            <div class="row">
                                                <input name="permission[module_id]" type="hidden" value="<?= $module['module_id'] ?>">    
                                                <div class="col text-left">
                                                    <?php
                                                    foreach ($array_data as $key => $option) {
                                                        $attribute = array(
                                                            "name" => "permission[action_id][]",
                                                            "type" => "checkbox",
                                                            "value" => $option['action_id']
                                                        );
                                                        if(isset($existing_perms[$module['module_id']]['children'])){
                                                            if (array_key_exists($option['action_id'], $existing_perms[$module['module_id']]['children'])) {
                                                                $attribute['permission_id'] = $existing_perms[$module['module_id']]['children'][$option['action_id']]['permission_id'];
                                                                $attribute['checked'] = 'checked';
                                                            }
                                                        }
                                                            
                                                        echo '<div class="checkbox wraper_checkbox"><label style="width: 100%;">' . form_checkbox($attribute) . ucfirst($option['action_name']) . '</label></div>';
                                                    }
                                                    ?>                                                                
                                                </div>
                                            </div>                                                                
                                        </div>
                                        <?php
                                    endforeach;
                                }
                                ?>
                            </div>   
                        </div>
                        <div class="card-footer" style="display: none;">
                            <input type="submit" class="btn btn-sm btn-primary float-right" value="Save">
                        </div>
                    </div>
                    <?php
                    echo form_close();
                }
                ?>
            </div>
        </div>

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