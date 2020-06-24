<?php ?>
<div class="row text-center">
    <div class="col-sm-12">
        <?php
        $form_attribute = array(
            "name" => "rbac_permissions",
            "id" => "module_permissions",
            "method" => "POST",
            "class" => "form-horizontal",
        );
        $form_action = base_url('rbac-role-permissions');
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
                            foreach ($role_options as $role_id => $role_name) {
                                ?>
                                <div class="panel-body no_pad criteria_panel" panel_no="<?php echo $role_id ?>" id="panel_<?php echo $role_name ?>">
                                    <div class="panel panel-default orange_border">
                                        <div class="panel-heading">
                                            <h3 class="panel-title col-sm-2 text-left white-text" data-toggle="collapse" data-target="#update_perm_panel_<?php echo $role_id ?>" aria-expanded="true" style="cursor: pointer"><?php echo ucfirst(strtolower($role_name)) ?></h3>
                                            <h3 class="panel-title" data-toggle="collapse" data-target="#update_perm_panel_<?php echo $role_id ?>" aria-expanded="true" style="cursor: pointer">
                                                &nbsp;<i class="fa fa-chevron-down pull-right"></i>
                                            </h3>
                                        </div>
                                        <div class="panel-body no_pad collapse" id="update_perm_panel_<?php echo $role_id ?>" aria-expanded="true">
                                            <div class="box-body">
                                                <div class="alert panel-default wraper_alert_bmargin main-module-action-box">                                                            
                                                    <div class="row perm_row">
                                                        <span class="pull-left">
                                                            <div class="col-sm-12">
                                                                <label class="pull-left"><input type="checkbox" class="check_all">&nbsp;&nbsp;Check all</label>
                                                            </div>
                                                        </span>
                                                        <div class="col-sm-12 no_pad text-left">                                                            
                                                            <?php
                                                            echo '<input name="permission[' . $indx . '][role_id]" type="hidden" value="' . $role_id . '">';
                                                            $permission_master_all_chunks = array_chunk($permission_master_all, 2, 1);

                                                            foreach ($permission_master_all_chunks as $chunk_perm) {
                                                                foreach ($chunk_perm as $perm) {
                                                                    ?>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">                                                                         
                                                                            <div class="col-sm-12 text-left no_pad">
                                                                                <?php
                                                                                $attribute = array(
                                                                                    "name" => "permission[$indx][permission_id][]",
                                                                                    "type" => "checkbox",
                                                                                    "value" => $perm['permission_id']
                                                                                );
                                                                                //find common permissions to update
                                                                                $perm['role_id'] = $role_id;
                                                                                $temp_perm = array($perm);
                                                                                $common_perms = array_filter(
                                                                                    $temp_perm, function ($array2Element) use ($existing_role_permissions) {
                                                                                        //pma($array2Element,1);
                                                                                        foreach ($existing_role_permissions as $array1Element) {
                                                                                            if ($array1Element['permission_id'] == $array2Element['permission_id'] && $array1Element['role_id'] == $array2Element['role_id']) {
                                                                                                return true;
                                                                                            }
                                                                                        }
                                                                                        return false;
                                                                                    }
                                                                                );

                                                                                if ($common_perms) {
                                                                                    $attribute['permission_id'] = $perm['permission_id'];
                                                                                    $attribute['checked'] = 'checked';
                                                                                }
                                                                                echo '<div class="checkbox wraper_checkbox"><label style="width: 100%;">' . form_checkbox($attribute) . ucfirst(strtolower($perm['module_name'])) . ' <span class="fa fa-long-arrow-right"> ' . ucfirst(strtolower($perm['action_name'])) . '</label></div>';
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
            $('.check_all').on('click',function(){
                $(this).closest('div.perm_row').find(':checkbox').prop('checked', this.checked);                
            });
        });
    </script>
