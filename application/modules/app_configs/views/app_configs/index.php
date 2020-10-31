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
    .check_box_lebel{font-weight: 400 !important; font-size: 14px;}
    .edit_lebel{font-size: 14px;}
    .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active{
        border: none !important;
    }


</style>
<?php
$form_attribute = array(
    "name" => "app_rbac_config",
    "id" => "app_rbac_config",
    "method" => "POST"
);
$form_action = base_url('save-app-configs');
echo form_open($form_action, $form_attribute);
?>
<div class="card card-warning card-outline collapsed-card">
    <div class="card-header">
        <h3 class="card-title text-bold hand" data-card-widget="collapse">RBAC Configurations</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>                   
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body" style="display: none;">
        <div class="row">
            <div class="col-6 pl-4">
                <div class="card pb-0">
                    <div class="card-body pb-0">
                        <h5 class="card-title text-bold">Set Role Priority</h5>
                        <div class="list-type1">
                            <div style="clear:both;">
                                <span class='fa fa-star fa-pulse text-red'></span> Newly added role, which should be prioritized.
                            </div>
                            <ol id="sortable" class="mb-0">
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
                            "name" => "app_configs_category",
                            "id" => "app_configs_category",
                            "class" => "form-control",
                            "type" => "hidden",
                            "value" => 'RBAC'
                        );
                        echo form_input($attribute);
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
            </div>
        </div>
    </div>
    <div class="card-footer text-muted">
        <button type="submit" id="app_submit" class="btn btn-primary btn-xs float-right"><i class="fa fa-save"></i> Save</button>
    </div>
</div>
<?= form_close() ?>

<?php
$form_attribute = array(
    "name" => "app_employee_config",
    "id" => "app_employee_config",
    "method" => "POST",
    "class" => "form-horizontal"
);
$form_action = base_url('save-app-configs');
echo form_open($form_action, $form_attribute);
?>
<div class="card card-warning card-outline collapsed-card">
    <div class="card-header">
        <h3 class="card-title text-bold hand" data-card-widget="collapse">Employee Configurations</h3>
        <div class="card-tools">            
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>                   
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body" style="display: none;">        

        <div class="row text-center">
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
            <div class="col-4">
                <div class="form-group row">
                    <label for="employee_id_prefix" class="col-sm-8 col-form-label text-left">Employee id prefix</label>
                    <div class="col-sm-4">
                        <?php
                        $attribute = array(
                            "name" => "app_configs[employee_id_prefix]",
                            "id" => "employee_id_prefix",
                            "class" => "form-control form-control-sm",
                            "title" => "Employee id pre-fix",
                            "type" => "text",
                            "placeholder" => "Employee id pre-fix",
                            "value" => (isset($data['employee']['employee_id_prefix'])) ? $data['employee']['employee_id_prefix'] : 'EMP'
                        );
                        echo form_input($attribute);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group row">
                    <label for="employee_id_zero_prefix" class="col-sm-8 col-form-label text-left">Employee id zero prefix</label>
                    <div class="col-sm-4">
                        <?php
                        $attribute = array(
                            "name" => "app_configs[employee_id_zero_prefix]",
                            "id" => "employee_id_zero_prefix",
                            "class" => "form-control form-control-sm",
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
        </div>
    </div>
    <div class="card-footer text-muted">
        <button type="submit" id="app_submit" class="btn btn-primary btn-xs float-right"><i class="fa fa-save"></i> Save</button>
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
<!--collapsed-card-->
<div class="card card-warning card-outline">
    <div class="card-header">
        <h3 class="card-title text-bold hand" data-card-widget="collapse"><?= COMPANY ?> Configurations</h3>
        <div class="card-tools">            
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>                   
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body" style="display: block;">
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
        <div class="row">
            <h3 class="card-title text-bold ml-2">Role Based Configurations</h3>
        </div>
        <div class="row">
            <div class="col">                
                <div class="card card-success card-outline collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title text-bold hand" data-card-widget="collapse">Default</h3>
                        <div class="card-tools">                        
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>                   
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body pb-0" style="display: none;">
                        <div class="row pl-2">
                            <h3 class="card-title text-bold">Reports</h3>
                        </div>                        
                        <div class="row">
                            <div class="col">
                                <div class="card collapsed-card">
                                    <div class="card-header">
                                        <h3 class="card-title text-bold hand" data-card-widget="collapse">Seler GST Reports</h3>
                                        <label class = 'col-form-label pt-0 pb-0 pl-4'>
                                            <?php
                                            $checked = "";
//                                                    if ($count_checked == $total_info_view_column) {
//                                                        $checked = " checked='checked'";
//                                                    }
                                            ?>
                                            <label class="float-left"><input type="checkbox" class="check_all" <?= $checked ?>>&nbsp;&nbsp;Check all</label>
                                        </label>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                            </button>                                            
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body pb-0" style="display: none;">

                                        <div class ='row checkbox_container'>
                                            <div class ="col check_box_row">
                                                <?php
                                                $optionCount = count($order_info_view_fields);
                                                $chunk_size = $optionCount / 4;
                                                $field_chunk = array_chunk($order_info_view_fields, $chunk_size);
                                                $count_checked = 0;
                                                $div = "col-3";
                                                foreach ($field_chunk as $field_row) {
                                                    echo '<div class="row">';
                                                    foreach ($field_row as $field) {
                                                        echo '<div class="' . $div . ' check_parent">';

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
                                                            <div class='float-left'>" . form_checkbox($attribute) . "
                                                                <label class='no_lpad'>" . "<span class=check_box_lebel>" . ucwords(str_replace('_', ' ', $label)) . "</span></label>
                                                                <span class='badge-label badge badge-danger' prev='" . $order . "' style='border-radius: 10px;'>" . $order . "</span>
                                                            </div>
                                                            <div class='float-left padL5'><a href='#' title='click to add lebel'><span class='fas fa-edit marginT2 edit_lebel' ></span></a></div>";
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
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card card-success card-outline collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title text-bold hand" data-card-widget="collapse">Admin</h3>
                        <div class="card-tools">                        
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>                   
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body pb-0" style="display: none;">                       
                        <div class="row pl-2">
                            <h3 class="card-title text-bold">Reports</h3>
                        </div>                        
                        <div class="row">
                            <div class="col">
                                <div class="card collapsed-card">
                                    <div class="card-header">
                                        <h3 class="card-title text-bold hand" data-card-widget="collapse">Seler GST Reports</h3>
                                        <label class = 'col-form-label pt-0 pb-0 pl-4'>
                                            <?php
                                            $checked = "";
//                                                    if ($count_checked == $total_info_view_column) {
//                                                        $checked = " checked='checked'";
//                                                    }
                                            ?>
                                            <label class="float-left"><input type="checkbox" class="check_all" <?= $checked ?>>&nbsp;&nbsp;Check all</label>
                                        </label>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                            </button>                                            
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body pb-0 mb-0" style="display: none;">

                                        <div class ='row checkbox_container'>
                                            <div class ="col check_box_row">
                                                <?php
                                                $optionCount = count($order_info_view_fields);
                                                $chunk_size = $optionCount / 4;
                                                $field_chunk = array_chunk($order_info_view_fields, $chunk_size);
                                                $count_checked = 0;
                                                $div = "col-3";
                                                foreach ($field_chunk as $field_row) {
                                                    echo '<div class="row">';
                                                    foreach ($field_row as $field) {
                                                        echo '<div class="' . $div . ' check_parent">';

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
                                                            <div class='float-left'>" . form_checkbox($attribute) . "
                                                                <label class='no_lpad'>" . "<span class=check_box_lebel>" . ucwords(str_replace('_', ' ', $label)) . "</span></label>
                                                                <span class='badge-label badge badge-danger' prev='" . $order . "' style='border-radius: 10px;'>" . $order . "</span>
                                                            </div>
                                                            <div class='float-left padL5'><a href='#' title='click to add lebel'><span class='fas fa-edit marginT2 edit_lebel'></span></a></div>";
                                                        if ($checkedFlag) {
                                                            $attribute = array(
                                                                "name" => "app_configs[seller_gst_report][admin][$field][label]",
                                                                "class" => "form-control field_label",
                                                                "type" => "hidden",
                                                                "value" => "$label"
                                                            );
                                                            echo form_input($attribute);
                                                            if ((int) $order > 0) {
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
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>                        
                    </div>                    
                </div>
            </div>
        </div>

        <?php
        foreach ($data['all_role_codes'] as $rc):
            $lrc = strtolower($rc);
            $rc_format = strtolower(str_replace('_', ' ', $rc));
            ?>
            <div class="row">
                <div class="col">
                    <div class="card card-success card-outline collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title text-bold hand" data-card-widget="collapse"><?= ucwords($rc_format) ?></h3>
                            <div class="card-tools">                        
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>                   
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body pb-0 mb-0" style="display: none;">
                            <div class="row pl-2">
                                <h3 class="card-title text-bold">Reports</h3>
                            </div>  
                            <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title text-bold hand" data-card-widget="collapse">Seler GST Reports</h3>
                                            <label class = 'col-form-label pt-0 pb-0 pl-4'>
                                                <?php
                                                $checked = "";
//                                                    if ($count_checked == $total_info_view_column) {
//                                                        $checked = " checked='checked'";
//                                                    }
                                                ?>
                                                <label class="float-left"><input type="checkbox" class="check_all" <?= $checked ?>>&nbsp;&nbsp;Check all</label>
                                            </label>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                                </button>                                            
                                            </div>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body pb-0 mb-0" style="display: block;">

                                            <div class ='row checkbox_container'>
                                                <div class ="col check_box_row">
                                                    <?php
                                                    $optionCount = count($order_info_view_fields);
                                                    $chunk_size = $optionCount / 4;
                                                    $field_chunk = array_chunk($order_info_view_fields, $chunk_size);
                                                    $count_checked = 0;
                                                    $div = "col-3";
                                                    foreach ($field_chunk as $field_row) {
                                                        echo '<div class="row">';
                                                        foreach ($field_row as $field) {
                                                            echo '<div class="' . $div . ' check_parent">';

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
                                                                <div class='float-left'>" . form_checkbox($attribute) . "
                                                                    <label class='no_lpad'>" . "<span class=check_box_lebel>" . ucwords(str_replace('_', ' ', $label)) . "</span></label>
                                                                    <span class='badge-label badge badge-danger' prev='" . $order . "' style='border-radius: 10px;'>" . $order . "</span>
                                                                </div>
                                                                <div class='float-left padL5'><a href='#' title='click to add lebel'><span class='fas fa-edit marginT2 edit_lebel'></span></a></div>";
                                                            if ($checkedFlag) {
                                                                $attribute = array(
                                                                    "name" => "app_configs[seller_gst_report][$lrc][$field][label]",
                                                                    "class" => "form-control field_label",
                                                                    "type" => "hidden",
                                                                    "value" => "$label"
                                                                );
                                                                echo form_input($attribute);
                                                                if ((int) $order > 0) {
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
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                            </div>  
                        </div>                        
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
    <div class="card-footer text-muted">
        <span class="float-right">
            <button type="submit" id="library_submit" class="btn btn-primary btn-xs"><i class="fa fa-save"></i> Save</button>
        </span>
    </div>
</div>

<?= form_close() ?>

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
            + '<input type="text" class="form-control form-control-sm new_lebel_text" style="width:70%">'
            + '<select placeholder="Order" class="form-control form-control-sm float-left order_dropdown" style="width:30%; padding:0px; text-align-left;" title="Set Column Order">'
            + '<option value="">Order</option>'
            + '[OPTIONS_LIST]'
            + '</select>'
            + '    <span class="input-group-btn">'
            + '      <a href="#" class="close_edit_lebel"><span class="fas fa-times-circle"></span></a>'
            + '    </span>'
            + '    <span class="input-group-btn">'
            + '      <a href="#" class="save_edit_lebel"><span class="far fa-check-circle"></span></a>'
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

            var orderSapn = this.label.closest('div.wraper_checkbox').find('span.badge-label');
                    var orderSpanPrev = orderSapn.attr('prev');
                    orderSapn.html(orderSpanPrev)
            },
            save:function(){
            var newVal = this.label.find('input').val();
                    var newOrderVal = this.label.find('select').val();
                    var wrapperChkBox = this.label.closest('div.wraper_checkbox');
                    this.linkObj.show();
                    this.editElementFlag = false;
                    this.label.html(newVal);
                    this.checkBox.prop("checked", true);
                    wrapperChkBox.find('input.field_label').remove();
                    var checkBoxName = this.checkBox.attr('name');
                    var lebelName = checkBoxName;
                    const regex = /\[column\]/gi;
                    if (newVal){
            lebelName = lebelName.replace(regex, '[label]');
                    this.inputHiddenClone = this.inputHidden;
                    this.inputHiddenClone = this.inputHiddenClone.replace(/field_name/gi, lebelName);
                    wrapperChkBox.append(this.inputHiddenClone);
                    wrapperChkBox.find('input.field_label').val(newVal);
            }

            if (newOrderVal.toString().toLowerCase() != ''){
            //set selected order value hidden field
            var orderName = checkBoxName;
                    wrapperChkBox.find('input.field_order').remove();
                    orderName = orderName.replace(regex, '[order]');
                    this.inputHiddenSelectClone = this.inputHiddenSelect;
                    this.inputHiddenSelectClone = this.inputHiddenSelectClone.replace(/field_name/gi, orderName);
                    wrapperChkBox.append(this.inputHiddenSelectClone);
                    wrapperChkBox.find('input.field_order').val(newOrderVal);
            }
            //set selected order as prev attribute
            var orderSapn = wrapperChkBox.find('span.badge-label');
                    orderSapn.attr('prev', newOrderVal);
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
            optionList += '<option value="' + len + '">' + len + '</option>';
            }
            return optionList;
            }

    }; //end class
            $(document).on('click', '.edit_lebel', function (e) {
    e.preventDefault();
            $('.close_edit_lebel').trigger('click');
            var label = $(this).closest('div.wraper_checkbox').find('.check_box_lebel');
            var chkbox = $(this).closest('div.wraper_checkbox').find('input:checkbox');
            InlineEdit.edit(label, $(this), chkbox);
    });
            $(document).on('click', '.close_edit_lebel', function (e) {
    e.preventDefault();
            InlineEdit.cancel();
    });
            $(document.body).on('click', '.save_edit_lebel', function (e) {
    e.preventDefault();
            InlineEdit.save();
    });
            $('.check_all').on('click', function () {
    var checkBoxContainer = $(this).closest('div.card').find('div.checkbox_container');
            var beforeCheckedCount = checkBoxContainer.find('div.check_box_row').find(':checkbox:checked').length;
            checkBoxContainer.find('div.check_box_row').find(':checkbox').prop('checked', this.checked);
            var checkedCount = checkBoxContainer.find('div.check_box_row').find(':checkbox:checked').length;
            console.log('before', beforeCheckedCount, ' after', checkedCount);
            if (beforeCheckedCount && checkedCount == 0){
    checkBoxContainer.find('div.check_box_row').find('input:hidden').remove();
            checkBoxContainer.find('span.badge-label').hide();
    }

    });
            $('.column_check_box').on('click', function () {
    $(this).closest('div.wraper_checkbox').find('div.check_box_row').find('input:hidden').remove();
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
            $(document).on('change', '.order_dropdown', function(){
    var selectedVal = $(this).val();
            var orderSapn = $(this).closest('div.wraper_checkbox').find('span.badge-label');
            if (selectedVal != ''){
    orderSapn.show();
            orderSapn.html(selectedVal);
    } else{
    orderSapn.hide();
    }
    });
    }); //end ready
</script>