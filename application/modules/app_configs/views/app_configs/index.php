<style>
    .label_adj{
        padding: 4px 0px 0px 5px;
        padding-to:4px;
    }
    .fieldset_hold{
        border:1px solid gray !important;
    }
    .legend_hold{
        widht:auto !important;
    }
    .treeSelector-container{
        width: 100% !important;
    }
    .treeSelector-container .treeSelector-wrapper.visible{
        width: 100% !important;
    }
    .bradious{
        border-radius: 50% !important;
        padding: 3px !important;
        margin-left: 2px !important;
        height: 25px !important;
    }

</style>
<div class="row-fluid scroll-container" style="height:500px; overflow-y: auto; overflow-x: hidden;">
    <div class="col-sm-12 no_pad">    
        <?php
        $form_attribute = array(
            "name" => "app_rbac_config",
            "id" => "app_rbac_config",
            "method" => "POST"
        );
        $form_action = base_url('save-app-configs');
        echo form_open($form_action, $form_attribute);
        ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-default  collapsed-box col-sm-10">
                    <div class="box-header with-border" data-widget="collapse">
                        <h3 class="box-title">RBAC Configurations</h3>                    
                        <div class="box-tools pull-right">                        
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>                        
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no_pad" style="display: none;">
                        <div class="row">
                            <?php
                            $attribute = array(
                                "name" => "app_configs_category",
                                "id" => "app_configs_category",
                                "class" => "form-control",
                                "type" => "hidden",
                                "value" => 'RBAC'
                            );
                            echo form_input($attribute);
                            ?>
                            <div class="col-sm-6">
                                <div class="box box-warning collapsed-box">
                                    <div class="box-header with-border" data-widget="collapse">
                                        <h3 class="box-title">Set Role Priority</h3>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body" style="display: none;">                        
                                        <div class="col-sm-12">
                                            <div class="list-type1">
                                                <span class='fa fa-star fa-pulse text-red'></span> Newly added role, which should be prioritized.
                                                <ol id="sortable">
                                                    <?php
                                                    if (isset($data['rbac']['role_priority'])) {
                                                        foreach ($data['rbac']['role_priority'] as $key => $role_code) {
                                                            if (!in_array($role_code, $data['new_roles'])) {
                                                                echo "<li class='ui-state-default' data-position='" . $role_code . "'><a href='#'>" . ucwords($role_code) . "</a></li>";
                                                            } else {
                                                                echo "<li class='ui-state-default' data-position='" . $role_code . "'><a href='#'><span class='fa fa-star fa-pulse text-red'></span> " . ucwords($role_code) . "</a></li>";
                                                            }
                                                        }
                                                    }
                                                    ?>                                            
                                                </ol>
                                            </div> 
                                            <?php
                                            $attribute = array(
                                                "name" => "app_configs[role_priority]",
                                                "id" => "role_priority",
                                                "class" => "form-control",
                                                "type" => "hidden",
                                                "value" => ''
                                            );
                                            echo form_input($attribute);
                                            ?>
                                        </div>                       
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <span class="pull-right marginB10">
                                <button type="submit" id="app_submit" class="btn btn-primary btn-small"><i class="fa fa-save"></i> Save</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= form_close() ?>
        <?php
        $form_attribute = array(
            "name" => "app_employee_config",
            "id" => "app_employee_config",
            "method" => "POST"
        );
        $form_action = base_url('save-app-configs');
        echo form_open($form_action, $form_attribute);
        ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-default  collapsed-box col-sm-10">
                    <div class="box-header with-border" data-widget="collapse">
                        <h3 class="box-title">Employee Configurations</h3>                    
                        <div class="box-tools pull-right">                        
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>                        
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no_pad" style="display: none;">
                        <?php
                        $attribute = array(
                            "name" => "app_configs_category",
                            "id" => "app_configs_category",
                            "class" => "form-control",
                            "type" => "hidden",
                            "value" => 'EMPLOYEE'
                        );
                        echo form_input($attribute);
                        ?>
                        <div class = 'form-group row'>
                            <div class="col-sm-3 no_rpad">
                                <label class = 'col-sm-7 col-form-label no_pad'>Employee id prefix</label>
                                <div class = 'col-sm-5 no_pad'>
                                    <?php
                                    $attribute = array(
                                        "name" => "app_configs[employee_id_prefix]",
                                        "id" => "employee_id_prefix",
                                        "class" => "form-control",
                                        "title" => "Employee id pre-fix",
                                        "type" => "text",
                                        "placeholder" => "Employee id pre-fix",
                                        "value" => (isset($data['employee']['employee_id_prefix'])) ? $data['employee']['employee_id_prefix'] : 'EMP'
                                    );
                                    echo form_input($attribute);
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-3 no_rpad">
                                <label class = 'col-sm-7 col-form-label no_pad'>Employee id zero prefix</label>
                                <div class = 'col-sm-5 no_pad'>
                                    <?php
                                    $attribute = array(
                                        "name" => "app_configs[employee_id_zero_prefix]",
                                        "id" => "employee_id_zero_prefix",
                                        "class" => "form-control",
                                        "title" => "Employee id zero prefix",
                                        "type" => "text",
                                        "placeholder" => "Employee id zero prefix",
                                        "value" => (isset($data['employee']['employee_id_zero_prefix'])) ? $data['employee']['employee_id_zero_prefix'] : 5
                                    );
                                    echo form_input($attribute);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <span class="pull-right marginB10">
                                <button type="submit" id="app_submit" class="btn btn-primary btn-small"><i class="fa fa-save"></i> Save</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= form_close() ?>

        <?php
        $form_attribute = array(
            "name" => "app_reports_config",
            "id" => "app_reports_config",
            "method" => "POST"
        );
        $form_action = base_url('save-app-configs');
        echo form_open($form_action, $form_attribute);
        ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-default  collapsed-box col-sm-10">
                    <div class="box-header with-border" data-widget="collapse">
                        <h3 class="box-title"><?= COMPANY ?> Configurations</h3>                    
                        <div class="box-tools pull-right">                        
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>                        
                        </div>
                        <?php
                        $attribute = array(
                            "name" => "app_configs_category",
                            "id" => "app_configs_category",
                            "class" => "form-control",
                            "type" => "hidden",
                            "value" => 'REPORTS'
                        );
                        echo form_input($attribute);
                        $total_info_view_column = count($order_info_view_fields);
                        ?>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="display: none;">
                        <div class = 'form-group row'>
                            <div class="col-sm-6 no_pad">                        
                                <label class = 'col-sm-4 col-form-label no_pad'>Role Based Configurations</label>
                                <div class = 'col-sm-8 no_pad'>
                                    <div class="treeSelector"></div> 
                                </div>
                            </div>                    
                        </div>
                        <div class="row">
                            <!-- role loop -->
                            <!-- default role -->
                            <div class="box box-info collapsed-box">
                                <div class="box-header with-border" data-widget="collapse">
                                    <h3 class="box-title">Default</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body" style="display: none;">
                                    <div class="box box-warning collapsed-box">
                                        <div class="box-header with-border" data-widget="collapse">
                                            <h3 class="box-title">Reports</h3>

                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                            <!-- /.box-tools -->
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body" style="display: none;">
                                            <div class ='form-group row checkbox_container'>
                                                <div class="col-sm-12 no_rpad">                                            
                                                    <div class = 'col-sm-11 no_pad check_box_row pull-right'>
                                                        <?php
                                                        $optionCount = count($order_info_view_fields);
                                                        $chunk_size = $optionCount / 6;
                                                        $field_chunk = array_chunk($order_info_view_fields, $chunk_size);
                                                        $count_checked = 0;
                                                        foreach ($field_chunk as $field_row) {
                                                            echo '<div class="row-fluid">';
                                                            foreach ($field_row as $field) {
                                                                echo '<div class="col-sm-2 check_parent">';

                                                                $attribute = array(
                                                                    "class" => "column_check_box",
                                                                    "name" => "app_configs[seller_gst_report][default][$field][column]",
                                                                    "type" => "checkbox",
                                                                    "value" => $field
                                                                );
                                                                $label = $field;
                                                                $order = "";
                                                                $checkedFlag = false;

                                                                if (isset($data['reports']['seller_gst_report']['default']) && array_key_exists($field, $data['reports']['seller_gst_report']['default'])) {
                                                                    $count_checked++;
                                                                    $attribute['checked'] = "checked";
                                                                    if (array_key_exists('label', $data['reports']['seller_gst_report']['default'][$field])) {
                                                                        $label = $data['reports']['seller_gst_report']['default'][$field]['label'];
                                                                    }
                                                                    if (array_key_exists('order', $data['reports']['seller_gst_report']['default'][$field])) {
                                                                        $order = $data['reports']['seller_gst_report']['default'][$field]['order'];
                                                                    }
                                                                    $checkedFlag = true;
                                                                }

                                                                echo "<div class='checkbox wraper_checkbox' option_count='$optionCount'>
                                                            <div class='pull-left'>" . form_checkbox($attribute) . "
                                                                <label class='no_lpad'>" . "<span class=check_box_lebel>" . ucwords(str_replace('_', ' ', $label)) . "</span></label>
                                                                <span class='order-label label label-danger' prev='".$order."' style='border-radius: 10px;'>".$order."</span>
                                                            </div>
                                                            <div class='pull-left padL5'><a href='#' title='click to add lebel'><span class='fa fa-pencil-square-o marginT2 edit_lebel' ></span></a></div>";
                                                                if ($checkedFlag) {
                                                                    $attribute = array(
                                                                        "name" => "app_configs[seller_gst_report][default][$field][label]",
                                                                        "class" => "form-control field_label",
                                                                        "type" => "hidden",
                                                                        "value" => "$label"
                                                                    );
                                                                    echo form_input($attribute);
                                                                    $attribute = array(
                                                                        "name" => "app_configs[seller_gst_report][default][$field][order]",
                                                                        "class" => "form-control field_order",
                                                                        "type" => "hidden",
                                                                        "value" => "$order"
                                                                    );
                                                                    echo form_input($attribute);
                                                                }

                                                                echo "</div>";

                                                                echo '</div>';
                                                            }
                                                            echo '</div>';
                                                        }
                                                        ?>
                                                    </div>
                                                    <label class = 'col-sm-1 col-form-label no_pad text-left'>
                                                        <div>Seler GST Reports</div>
                                                        <div>
                                                            <span class="pull-left">
                                                                <div class="col-sm-12">
                                                                    <?php
                                                                    $checked = "";
                                                                    if ($count_checked == $total_info_view_column) {
                                                                        $checked = " checked='checked'";
                                                                    }
                                                                    ?>
                                                                    <label class="pull-left"><input type="checkbox" class="check_all" <?= $checked ?>>&nbsp;&nbsp;Check all</label>
                                                                </div>
                                                            </span>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.box-body -->
                                    </div>

                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- end default role -->

                            <!-- Admin Role-->

                            <div class="box box-info collapsed-box">
                                <div class="box-header with-border" data-widget="collapse">
                                    <h3 class="box-title">Admin</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body" style="display: none;">
                                    <div class="box box-warning collapsed-box">
                                        <div class="box-header with-border" data-widget="collapse">
                                            <h3 class="box-title">Reports</h3>

                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                            <!-- /.box-tools -->
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body" style="display: none;">
                                            <div class ='form-group row checkbox_container'>
                                                <div class="col-sm-12 no_rpad">                                            
                                                    <div class = 'col-sm-11 no_pad check_box_row pull-right'>
                                                        <?php
                                                        $optionCount = count($order_info_view_fields);
                                                        $chunk_size = $optionCount / 4;
                                                        $field_chunk = array_chunk($order_info_view_fields, $chunk_size);
                                                        $count_checked = 0;

                                                        foreach ($field_chunk as $field_row) {
                                                            echo '<div class="row-fluid">';
                                                            foreach ($field_row as $field) {
                                                                echo '<div class="col-sm-3 check_parent">';

                                                                $attribute = array(
                                                                    "class" => "column_check_box",
                                                                    "name" => "app_configs[seller_gst_report][admin][$field][column]",
                                                                    "type" => "checkbox",
                                                                    "value" => $field
                                                                );
                                                                $label = $field;
                                                                $checkedFlag = false;
                                                                $order = "";
                                                                if (isset($data['reports']['seller_gst_report']['admin']) && array_key_exists($field, $data['reports']['seller_gst_report']['admin'])) {
                                                                    $count_checked++;
                                                                    $attribute['checked'] = "checked";
                                                                    if (array_key_exists('label', $data['reports']['seller_gst_report']['admin'][$field])) {
                                                                        $label = $data['reports']['seller_gst_report']['admin'][$field]['label'];
                                                                    }
                                                                    if (array_key_exists('order', $data['reports']['seller_gst_report']['admin'][$field])) {
                                                                        $order = $data['reports']['seller_gst_report']['admin'][$field]['order'];
                                                                    }
                                                                    $checkedFlag = true;
                                                                }

                                                                echo "<div class='checkbox wraper_checkbox' option_count='$optionCount'>
                                                            <div class='pull-left'>" . form_checkbox($attribute) . "
                                                                <label class='no_lpad'>" . "<span class=check_box_lebel>" . ucwords(str_replace('_', ' ', $label)) . "</span></label>
                                                                <span class='order-label label label-danger' prev='".$order."' style='border-radius: 10px;'>".$order."</span>
                                                            </div>
                                                            <div class='pull-left padL5'><a href='#' title='click to add lebel'><span class='fa fa-pencil-square-o marginT2 edit_lebel'></span></a></div>";
                                                                if ($checkedFlag) {
                                                                    $attribute = array(
                                                                        "name" => "app_configs[seller_gst_report][admin][$field][label]",
                                                                        "class" => "form-control field_label",
                                                                        "type" => "hidden",
                                                                        "value" => "$label"
                                                                    );
                                                                    echo form_input($attribute);
                                                                    if((int)$order>0){
                                                                        $attribute = array(
                                                                            "name" => "app_configs[seller_gst_report][admin][$field][order]",
                                                                            "class" => "form-control field_order",
                                                                            "type" => "hidden",
                                                                            "value" => "$order"
                                                                        );
                                                                        echo form_input($attribute);
                                                                    }
                                                                }

                                                                echo "</div>";

                                                                echo '</div>';
                                                            }
                                                            echo '</div>';
                                                        }
                                                        ?>
                                                    </div>
                                                    <label class = 'col-sm-1 col-form-label no_pad text-left'>
                                                        <div>Seler GST Reports</div>
                                                        <div>
                                                            <span class="pull-left">
                                                                <div class="col-sm-12">
                                                                    <?php
                                                                    $checked = "";
                                                                    if ($count_checked == $total_info_view_column) {
                                                                        $checked = " checked='checked'";
                                                                    }
                                                                    ?>
                                                                    <label class="pull-left"><input type="checkbox" class="check_all" <?= $checked ?>>&nbsp;&nbsp;Check all</label>
                                                                </div>
                                                            </span>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.box-body -->
                                    </div>

                                </div>
                                <!-- /.box-body -->
                            </div>                   
                            <!-- End Admin role-->

                            <!-- db roles list-->
                            <?php
                            foreach ($data['all_role_codes'] as $rc):
                                $lrc = strtolower($rc);
                                $rc_format = strtolower(str_replace('_', ' ', $rc));
                                ?>
                                <div class="box box-info collapsed-box">
                                    <div class="box-header with-border" data-widget="collapse">
                                        <h3 class="box-title"><?= ucwords($rc_format) ?></h3>

                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body" style="display: none;">
                                        <div class="box box-warning collapsed-box">
                                            <div class="box-header with-border" data-widget="collapse">
                                                <h3 class="box-title">Reports</h3>

                                                <div class="box-tools pull-right">
                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                                <!-- /.box-tools -->
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body" style="display: none;">
                                                <div class = 'form-group row'>
                                                    <div class="col-sm-12 no_rpad checkbox_container">

                                                        <div class = 'col-sm-11 no_pad check_box_row pull-right'>
                                                            <?php
                                                            $count_checked = 0;
                                                            $optionCount = count($order_info_view_fields);
                                                            $chunk_size = $optionCount / 4;
                                                            $field_chunk = array_chunk($order_info_view_fields, $chunk_size);
                                                            foreach ($field_chunk as $field_row) {
                                                                echo '<div class="row-fluid">';
                                                                foreach ($field_row as $field) {
                                                                    echo '<div class="col-sm-3 check_parent">';

                                                                    $attribute = array(
                                                                        "class" => "column_check_box",
                                                                        "name" => "app_configs[seller_gst_report][$lrc][$field][column]",
                                                                        "type" => "checkbox",
                                                                        "value" => $field
                                                                    );
                                                                    $label = $field;
                                                                    $checkedFlag = false;
                                                                    $order = "";
                                                                    if (isset($data['reports']['seller_gst_report'][$lrc]) && array_key_exists($field, $data['reports']['seller_gst_report'][$lrc])) {
                                                                        $count_checked++;
                                                                        $attribute['checked'] = "checked";
                                                                        if (array_key_exists('label', $data['reports']['seller_gst_report'][$lrc][$field])) {
                                                                            $label = $data['reports']['seller_gst_report'][$lrc][$field]['label'];
                                                                        }
                                                                        if (array_key_exists('order', $data['reports']['seller_gst_report'][$lrc][$field])) {
                                                                            $order = $data['reports']['seller_gst_report'][$lrc][$field]['order'];
                                                                        }
                                                                        $checkedFlag = true;
                                                                    }

                                                                    echo "<div class='checkbox wraper_checkbox' option_count='$optionCount'>
                                                                <div class='pull-left'>" . form_checkbox($attribute) . "
                                                                    <label class='no_lpad'>" . "<span class=check_box_lebel>" . ucwords(str_replace('_', ' ', $label)) . "</span></label>
                                                                    <span class='order-label label label-danger' prev='".$order."' style='border-radius: 10px;'>".$order."</span>
                                                                </div>
                                                                <div class='pull-left padL5'><a href='#' title='click to add lebel'><span class='fa fa-pencil-square-o marginT2 edit_lebel'></span></a></div>";
                                                                    if ($checkedFlag) {
                                                                        $attribute = array(
                                                                            "name" => "app_configs[seller_gst_report][$lrc][$field][label]",
                                                                            "class" => "form-control field_label",
                                                                            "type" => "hidden",
                                                                            "value" => "$label"
                                                                        );
                                                                        echo form_input($attribute);
                                                                        if((int)$order>0){
                                                                            $attribute = array(
                                                                                "name" => "app_configs[seller_gst_report][$lrc][$field][order]",
                                                                                "class" => "form-control field_order",
                                                                                "type" => "hidden",
                                                                                "value" => "$order"
                                                                            );
                                                                            echo form_input($attribute);
                                                                        }
                                                                    }

                                                                    echo "</div>";

                                                                    echo '</div>';
                                                                }
                                                                echo '</div>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <label class = 'col-sm-1 col-form-label no_pad'>
                                                            <div>Seler GST Reports</div>
                                                            <div>
                                                                <span class="pull-left">
                                                                    <div class="col-sm-12">
                                                                        <?php
                                                                        $checked = "";
                                                                        if ($count_checked == $total_info_view_column) {
                                                                            $checked = " checked='checked'";
                                                                        }
                                                                        ?>
                                                                        <label class="pull-left"><input type="checkbox" class="check_all" <?= $checked ?>>&nbsp;&nbsp;Check all</label>
                                                                    </div>
                                                                </span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- /.box-body -->
                                        </div>

                                    </div>
                                    <!-- /.box-body -->
                                </div>                        
                            <?php endforeach; ?>
                            <!-- db roles list-->
                            <!-- end role loop -->

                        </div>

                        <span class="pull-right">
                            <button type="submit" id="library_submit" class="btn btn-primary btn-small"><i class="fa fa-save"></i> Save</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <?= form_close() ?>
    </div>
</div>
<script type="text/javascript">
    $(function () {

        var InlineEdit = {
    editElementFlag: false,
            label : "",
            labelValue : "",
            linkObj: "",
            checkBox: "",
            checkBoxStatus: false,
            optionsList: '',
            inputTemplate: '<div class="input-group input-group-sm">'
            + '<input type="text" class="form-control new_lebel_text" style="width:70%">'
            + '<select placeholder="Order" class="form-control pull-left order_dropdown" style="width:30%; padding:0px; text-align-left;" title="Set Column Order">'
            + '<option value="">Order</option>'
            + '[OPTIONS_LIST]'
            + '</select>'
            + '    <span class="input-group-btn">'
            + '      <button type="button" class="btn btn-info bradious close_edit_lebel"><span class="fa fa-close"></span></button>'
            + '    </span>'
            + '    <span class="input-group-btn">'
            + '      <button type="button" class="btn btn-info bradious save_edit_lebel"><span class="fa fa-check"></span></button>'
            + '    </span>'
            + '</div>',
            inputHidden: '<input type="hidden" name="field_name" value="" class="form-control field_label">',
            inputHiddenClone:'',
            inputHiddenSelect: '<input type="hidden" name="field_name" value="" class="form-control field_order">',
            inputHiddenSelectClone:'',
            cancel:function()
            {
                this.label.html(this.labelValue);
                this.label.closest('div.wraper_checkbox').find('.field_label').val(this.labelValue);
                this.linkObj.show();
                if (this.checkBoxStatus){
                    this.checkBox.attr("checked", true);
                } else{
                    this.checkBox.attr("checked", false);
                }
                
                var orderSapn=this.label.closest('div.wraper_checkbox').find('span.order-label');
                var orderSpanPrev=orderSapn.attr('prev');                
                orderSapn.html(orderSpanPrev)
            },
            save:function(){
                    var newVal = this.label.find('input').val();
                    var newOrderVal = this.label.find('select').val();
                    var wrapperChkBox = this.label.closest('div.wraper_checkbox');
                    this.linkObj.show();
                    this.editElementFlag = false;
                    this.label.html(newVal);
                    this.checkBox.attr("checked", true);
                    wrapperChkBox.find('input.field_label').remove();
                    var checkBoxName = this.checkBox.attr('name');
                    var lebelName = checkBoxName;
                    
                    const regex = /\[column\]/gi;
                    if(newVal){                        
                        lebelName = lebelName.replace(regex, '[label]');
                        this.inputHiddenClone=this.inputHidden;
                        this.inputHiddenClone = this.inputHiddenClone.replace(/field_name/gi, lebelName);
                        wrapperChkBox.append(this.inputHiddenClone);
                        wrapperChkBox.find('input.field_label').val(newVal);                        
                    }
                    
                    if (newOrderVal.toString().toLowerCase() != ''){
                        //set selected order value hidden field
                        var orderName = checkBoxName;
                        wrapperChkBox.find('input.field_order').remove();
                        orderName = orderName.replace(regex, '[order]');
                        this.inputHiddenSelectClone=this.inputHiddenSelect;
                        this.inputHiddenSelectClone = this.inputHiddenSelectClone.replace(/field_name/gi, orderName);
                        wrapperChkBox.append(this.inputHiddenSelectClone);
                        wrapperChkBox.find('input.field_order').val(newOrderVal);
                    }
                    //set selected order as prev attribute
                    var orderSapn=wrapperChkBox.find('span.order-label');                    
                    orderSapn.attr('prev',newOrderVal);

            },
            edit:function(labelEleObj, linkEleObj, checkBoxObj){
                    this.editElementFlag = true;
                    this.label = labelEleObj;
                    this.linkObj = linkEleObj;
                    this.checkBox = checkBoxObj;
                    this.checkBoxStatus = this.checkBox.is(':checked');
                    this.labelValue = this.label.html();
                    //get count options
                    var optionLength = labelEleObj.closest('div.wraper_checkbox').attr('option_count');
                    if (parseInt(optionLength) > 0){
                        this.optionsList = this.get_options(optionLength);
                        const optLengthRegex = /\[OPTIONS_LIST\]/gi;
                        this.inputTemplate = this.inputTemplate.replace(optLengthRegex, this.optionsList);
                    }
                    this.label.html(this.inputTemplate);
                    this.label.find('input').val(this.labelValue);
                    this.label.find('input').attr('title', this.labelValue);
                    //set order selected
                    var selectedHiddenVal = this.label.closest('div.wraper_checkbox').find('input:hidden.field_order').val();
                    
                    if (selectedHiddenVal){
                        this.label.find('select').val(selectedHiddenVal);
                    }

                this.linkObj.hide();
            },
            get_options:function(count){
            var optionList = '';
                    for (var len = 1; len <= count; len++){
            optionList += '<option value="'+len+'">' + len + '</option>';
            }
            return optionList;
            }

    }; //end class
         $(document).on('click', '.edit_lebel', function () {
            $('.close_edit_lebel').trigger('click');
            var label = $(this).closest('div.wraper_checkbox').find('.check_box_lebel');
            var chkbox = $(this).closest('div.wraper_checkbox').find('input:checkbox');            
            
            InlineEdit.edit(label, $(this), chkbox);
        });
        $(document).on('click', '.close_edit_lebel', function () {
            InlineEdit.cancel();
        });
        $(document.body).on('click', '.save_edit_lebel', function () {
            InlineEdit.save();
        });
        $('.check_all').on('click', function () {
            var beforeCheckedCount=$(this).closest('div.checkbox_container').find('div.check_box_row').find(':checkbox:checked').length;
            $(this).closest('div.checkbox_container').find('div.check_box_row').find(':checkbox').prop('checked', this.checked);
            var checkedCount=$(this).closest('div.checkbox_container').find('div.check_box_row').find(':checkbox:checked').length;            
            console.log('before',beforeCheckedCount,' after',checkedCount);
            if(beforeCheckedCount && checkedCount==0){
                $(this).closest('div.checkbox_container').find('div.check_box_row').find('input:hidden').remove();
            }
            
        });
        $('.column_check_box').on('click', function () {
            $(this).closest('div.checkbox_container').find('div.check_box_row').find('input:hidden').remove();
        });
        //lib_card_num_prefix validateion allows only a-z A-Z 0-9
        $('#lib_card_num_prefix').on('keypress', function (event) {
            var regex = new RegExp("^[a-zA-Z0-9\b]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });
        $("#sortable").sortable({
            placeholder: "ui-state-highlight",
            refreshPositions: true,
            update: function (event, ui) {
                var code_priority = [];
                $('#sortable li').each(function (index, li) {
                    code_priority[index + 1] = $(this).attr('data-position');
                });
                $('#role_priority').val(code_priority);
            }
        });
        $(document).on('change','.order_dropdown',function(){
            var selectedVal=$(this).val();
            var orderSapn=$(this).closest('div.wraper_checkbox').find('span.order-label');
            if(selectedVal!=''){
                orderSapn.show();                
                orderSapn.html(selectedVal);
            }else{
                orderSapn.hide();
            }
        });
    }); //end ready
</script>