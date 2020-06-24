<?php ?>
<style>

</style>
<div class="row text-center">
    <div class="col-sm-12">
        <?php
        $form_attribute = array(
            "name" => "rbac_permissions",
            "id" => "module_permissions",
            "method" => "POST",
            "class" => "form-horizontal",
        );
        $form_action = base_url('rbac-module-permissions');
        echo form_open($form_action, $form_attribute);
        ?>        
        <div class="panel-body">
            <div class="panel panel-default orange_border">
                <div class="panel-heading orange_bg" style="min-height: 40px;">
                    <div class="row">
                        <div class="col-sm-3">                                
                            <h3 class="panel-title text-left white-text">Set module permissions</h3>
                        </div>                            
                        <div class="col-sm-9 pull-right" style="text-align: right;">                    
                            <a class="btn btn-default pannel_button pannel_button_w90" id="collapse-all" href="#">Collapse All</a>&nbsp;
                            <a class="btn btn-default pannel_button pannel_button_w90" id="expand-all" href="#">Expand All</a>&nbsp;
                            <input type="submit" class="btn btn-default pannel_button pannel_button_w90" id="save_criteria" value="Save ">&nbsp;                            
                        </div>
                    </div>
                </div>
                <div class="panel-body collapse in" id="super_panel" aria-expanded="true">
                    <div class="row-fluid panel_container">                        
                        <!--UPDATE PERMISSIONS-->

                        <div class="panel-body">
                            <?php
                            $indx = 1;
                            foreach ($module_options as $module_id => $module_name) {
                                $one_existing_perm = $existing_actions = array();
                                if (array_key_exists($module_id, $existing_perms)) {
                                    $one_existing_perm = $existing_perms[$module_id];
                                    $permission_id = array_column($one_existing_perm['actions'], 'permission_id');
                                    if ($permission_id) {
                                        $permission_id = current($permission_id);
                                    }
                                    $existing_actions = array_column($one_existing_perm['actions'], 'action_id');
                                }
                                ?>
                                <div class="panel-body no_pad criteria_panel" panel_no="<?php echo $module_id ?>" id="panel_<?php echo $module_id ?>">
                                    <div class="panel panel-default orange_border">
                                        <div class="panel-heading" data-toggle="collapse" data-target="#update_perm_panel_<?php echo $module_id ?>" aria-expanded="true" style="cursor: pointer">
                                            <h1 class="panel-title text-left white-text" data-toggle="collapse" data-target="#update_perm_panel_<?php echo $module_id ?>" aria-expanded="true" style="cursor: pointer">
                                                <?php echo ucfirst(strtolower($module_name)) ?>
                                                <span><i class="fa fa-chevron-down pull-right"></i></span>
                                            </h2>
                                            
                                        </div>
                                        <div class="panel-body no_pad collapse" id="update_perm_panel_<?php echo $module_id ?>" aria-expanded="true">
                                            <div class="box-body">
                                                <div class="alert panel-default wraper_alert_bmargin main-module-action-box">                                                            
                                                    <div class="row">
                                                        <div class="col-sm-12 no_pad">
                                                            <?php
                                                            if (isset($action_options) && is_array($action_options)) {
                                                                $chunks = array_chunk($action_options, 3, 1);
                                                                foreach ($chunks as $array_data) {
                                                                    ?>
                                                                    <div class="col-sm-4">
                                                                        <div class="row">
                                                                            <input name="permission[<?php echo $indx ?>][module_id]" type="hidden" value="<?php echo $module_id ?>">    
                                                                            <div class="col-sm-12 text-left">
                                                                                <?php
                                                                                foreach ($array_data as $key => $val) {
                                                                                    if ($key != '') {
                                                                                        $attribute = array(
                                                                                            "name" => "permission[$indx][action_id][]",
                                                                                            "type" => "checkbox",
                                                                                            "value" => $key
                                                                                        );
                                                                                        if (in_array($key, $existing_actions)) {
                                                                                            $attribute['permission_id'] = $permission_id;
                                                                                            $attribute['checked'] = 'checked';
                                                                                        }
                                                                                        echo '<div class="checkbox wraper_checkbox"><label style="width: 100%;">' . form_checkbox($attribute) . ucfirst($val) . '</label></div>';
                                                                                    }
                                                                                }
                                                                                ?>                                                                
                                                                            </div>
                                                                        </div>                                                                
                                                                    </div>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>  
                                                </div>                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $indx++;
                            }
                            ?>
                        </div>


                    </div><!--end panel container row-->                    
                </div>
            </div>
        </div>
        </form><?php echo form_close() ?>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {

            //exapand/collapse all panel
            $('#expand-all').on('click', function () {
                $('.collapse').collapse('show');
            });
            $('#collapse-all').on('click', function () {
                $('.collapse:not("#super_panel")').collapse('hide');
            });
        });
    </script>
