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
</style>
<?php
$form_attribute = array(
    "name" => "app_config",
    "id" => "app_config",
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
                        "value" => 'CHM_APP'
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
                                            if (isset($data['chm_app']['role_priority'])) {
                                                foreach ($data['chm_app']['role_priority'] as $key => $role_code) {
                                                    if (!in_array($role_code, $data['new_roles'])) {
                                                        echo "<li class='ui-state-default' data-position='" . $role_code . "'><a href='#'>" . ucfirst($role_code) . "</a></li>";
                                                    } else {
                                                        echo "<li class='ui-state-default' data-position='" . $role_code . "'><a href='#'><span class='fa fa-star fa-pulse text-red'></span> " . ucfirst($role_code) . "</a></li>";
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
    "name" => "lib_app_config",
    "id" => "lib_app_config",
    "method" => "POST"
);
$form_action = base_url('save-app-configs');
echo form_open($form_action, $form_attribute);
?>
<div class="row">
    <div class="col-sm-12">
        <div class="box box-default  collapsed-box col-sm-10">
            <div class="box-header with-border" data-widget="collapse">
                <h3 class="box-title">Library Configurations</h3>                    
                <div class="box-tools pull-right">                        
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>                        
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: none;">
                <div class = 'form-group row'>
                    <div class="col-sm-6 no_pad">
                        <?php
                        $attribute = array(
                            "name" => "app_configs[book_qrcode_columns]",
                            "id" => "book_qrcode_columns",
                            "class" => "form-control",
                            "type" => "hidden",
                            "value" => (isset($data['library']['book_qrcode_columns'])) ? $data['library']['book_qrcode_columns'] : $data['qrcode_default_columns']
                        );
                        echo form_input($attribute);
                        ?>
                        <label class = 'col-sm-4 col-form-label no_pad'>Book QR code columns</label>
                        <div class = 'col-sm-8 no_pad'>
                            <div class="treeSelector"></div> 
                        </div>
                    </div>                    
                </div>
                <div class="row">
                    <div class="box box-info collapsed-box">
                        <div class="box-header with-border" data-widget="collapse">
                            <h3 class="box-title">Role based configuration</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="display: none;">
                            <!-- role loop -->
                            <!-- default role -->
                            <div class="box box-warning collapsed-box">
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
                                    <div class = 'form-group row'>
                                        <div class="col-sm-3 no_rpad">
                                            <label class = 'col-sm-7 col-form-label no_pad'>Max assigned book</label>
                                            <div class = 'col-sm-5 no_pad'>
                                                <?php
                                                $attribute = array(
                                                    "name" => "app_configs_category",
                                                    "id" => "default_app_configs_category",
                                                    "class" => "form-control",
                                                    "type" => "hidden",
                                                    "value" => 'LIBRARY'
                                                );
                                                echo form_input($attribute);
                                                $attribute = array(
                                                    "name" => "app_configs[role_config][default][max_assigned_book]",
                                                    "id" => "max_assigned_book",
                                                    "class" => "form-control",
                                                    "title" => "Maximum assigned book",
                                                    "type" => "number",
                                                    "min" => 1,
                                                    "placeholder" => "Maximum assigned book",
                                                    "value" => (isset($data['library']['role_config']['default']['max_assigned_book'])) ? $data['library']['role_config']['default']['max_assigned_book'] : '1'
                                                );
                                                echo form_input($attribute);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 no_rpad">
                                            <label class = 'col-sm-7 col-form-label no_pad'>Return books within</label>
                                            <div class = 'col-sm-5 no_pad'>
                                                <?php
                                                $attribute = array(
                                                    "name" => "app_configs[role_config][default][return_book_after_days]",
                                                    "id" => "default_return_book_after_days",
                                                    "class" => "form-control",
                                                    "title" => "Book shoud be returned within specified days",
                                                    "type" => "number",
                                                    "min" => 5,
                                                    "placeholder" => "Book shoud be returned within specified days",
                                                    "value" => (isset($data['library']['role_config']['default']['return_book_after_days'])) ? $data['library']['role_config']['default']['return_book_after_days'] : '5'
                                                );
                                                echo form_input($attribute);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 no_rpad">
                                            <label class = 'col-sm-7 col-form-label no_pad'>Return delay fine</label>
                                            <div class = 'col-sm-5 no_pad'>
                                                <?php
                                                $attribute = array(
                                                    "name" => "app_configs[role_config][default][return_delay_fine]",
                                                    "id" => "default_return_delay_fine",
                                                    "class" => "form-control",
                                                    "title" => "Book return delay fine per day.",
                                                    "type" => "number",
                                                    "min" => 1,
                                                    "placeholder" => "Book return delay fine per day",
                                                    "value" => (isset($data['library']['role_config']['default']['return_delay_fine'])) ? $data['library']['role_config']['default']['return_delay_fine'] : '1'
                                                );
                                                echo form_input($attribute);
                                                ?>                                        
                                            </div>
                                        </div>                                
                                        <div class="col-sm-3 no_rpad">
                                            <label class = 'col-sm-7 col-form-label no_pad'>Book lost fine</label>
                                            <div class = 'col-sm-5 no_pad'>
                                                <?php
                                                $attribute = array(
                                                    "name" => "app_configs[role_config][default][book_lost_fine]",
                                                    "id" => "default_book_lost_fine",
                                                    "class" => "form-control",
                                                    "title" => "Default book lost fine.",
                                                    "type" => "number",
                                                    "min" => 50,
                                                    "placeholder" => "Book lost fine",
                                                    "value" => (isset($data['library']['role_config']['default']['book_lost_fine'])) ? $data['library']['role_config']['default']['book_lost_fine'] : '50'
                                                );
                                                echo form_input($attribute);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = 'form-group row'>
                                        <div class="col-sm-3 no_rpad">
                                            <label class = 'col-sm-7 col-form-label no_pad'>Library card no. prefix</label>
                                            <div class = 'col-sm-5 no_pad'>
                                                <?php
                                                $attribute = array(
                                                    "name" => "app_configs[lib_card_num_prefix]",
                                                    "id" => "lib_card_num_prefix",
                                                    "class" => "form-control",
                                                    "title" => "Library card no pre-fix",
                                                    "type" => "text",
                                                    "placeholder" => "Library card no pre-fix",
                                                    "value" => (isset($data['library']['lib_card_num_prefix'])) ? $data['library']['lib_card_num_prefix'] : 'LIB'
                                                );
                                                echo form_input($attribute);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 no_rpad">
                                            <label class = 'col-sm-7 col-form-label no_pad'>Library card no. zero prefix</label>
                                            <div class = 'col-sm-5 no_pad'>
                                                <?php
                                                $attribute = array(
                                                    "name" => "app_configs[lib_card_num_zero_prefix]",
                                                    "id" => "lib_card_num_zero_prefix",
                                                    "class" => "form-control",
                                                    "title" => "Library card no pre-fix",
                                                    "type" => "text",
                                                    "placeholder" => "Library card no pre-fix",
                                                    "value" => (isset($data['library']['lib_card_num_zero_prefix'])) ? $data['library']['lib_card_num_zero_prefix'] : 5
                                                );
                                                echo form_input($attribute);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 no_rpad">
                                            <label class = 'col-sm-7 col-form-label no_pad'>I-card validity</label>
                                            <div class = 'col-sm-5 no_pad'>                                    
                                                <?php
                                                $month_list = array(
                                                    1 => '1 Month', 2 => '2 Months', 3 => '3 Months',
                                                    4 => '4 Months', 5 => '5 Months', 6 => '6 Months',
                                                    7 => '7 Months', 8 => '8 Months', 9 => '9 Months',
                                                    10 => '10 Months', 11 => '11 Months', 12 => '1 Year',
                                                    24 => '2 Years', 36 => '3 Years', 48 => '4 Years',
                                                    60 => '5 Years', 100 => 'Life time'
                                                ); //100 means life time
                                                $attribute = array(
                                                    "name" => "app_configs[lib_card_expire_month]",
                                                    "id" => "lib_card_num_prefix",
                                                    "class" => "form-control",
                                                    "title" => "Library card no pre-fix",
                                                    "type" => "text",
                                                    "placeholder" => "Library card no pre-fix",
                                                    "value" => (isset($data['library']['lib_card_expire_month'])) ? $data['library']['lib_card_expire_month'] : '6'
                                                );
                                                echo form_dropdown($attribute, $month_list, 6);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- end default role -->
                            <!-- db roles list-->
                            <?php
                            foreach ($data['all_role_codes'] as $rc):
                                $lrc = strtolower($rc);
                                $rc_format = strtolower(str_replace('_', ' ', $rc));
                                ?>
                                <div class="box box-warning collapsed-box">
                                    <div class="box-header with-border" data-widget="collapse">
                                        <h3 class="box-title"><?= ucfirst($rc_format) ?></h3>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body" style="display: none;">
                                        <div class = 'form-group row'>
                                            <div class="col-sm-3 no_rpad">
                                                <label class = 'col-sm-7 col-form-label no_pad'>Max assigned book</label>
                                                <div class = 'col-sm-5 no_pad'>
                                                    <?php
                                                    $attribute = array(
                                                        "name" => "app_configs_category",
                                                        "id" => "default_app_configs_category",
                                                        "class" => "form-control",
                                                        "type" => "hidden",
                                                        "value" => 'LIBRARY'
                                                    );
                                                    echo form_input($attribute);
                                                    $attribute = array(
                                                        "name" => "app_configs[role_config][$lrc][max_assigned_book]",
                                                        "id" => "max_assigned_book",
                                                        "class" => "form-control",
                                                        "title" => "Maximum assigned book",
                                                        "type" => "number",
                                                        "min" => 1,
                                                        "placeholder" => "Maximum assigned book",
                                                        "value" => (isset($data['library']['role_config'][$lrc]['max_assigned_book'])) ? $data['library']['role_config'][$lrc]['max_assigned_book'] : '1'
                                                    );
                                                    echo form_input($attribute);
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 no_rpad">
                                                <label class = 'col-sm-7 col-form-label no_pad'>Return books within</label>
                                                <div class = 'col-sm-5 no_pad'>
                                                    <?php
                                                    $attribute = array(
                                                        "name" => "app_configs[role_config][$lrc][return_book_after_days]",
                                                        "id" => "default_return_book_after_days",
                                                        "class" => "form-control",
                                                        "title" => "Book shoud be returned within specified days",
                                                        "type" => "number",
                                                        "min" => 5,
                                                        "placeholder" => "Book shoud be returned within specified days",
                                                        "value" => (isset($data['library']['role_config'][$lrc]['return_book_after_days'])) ? $data['library']['role_config'][$lrc]['return_book_after_days'] : '5'
                                                    );
                                                    echo form_input($attribute);
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 no_rpad">
                                                <label class = 'col-sm-7 col-form-label no_pad'>Return delay fine</label>
                                                <div class = 'col-sm-5 no_pad'>
                                                    <?php
                                                    $attribute = array(
                                                        "name" => "app_configs[role_config][$lrc][return_delay_fine]",
                                                        "id" => "default_return_delay_fine",
                                                        "class" => "form-control",
                                                        "title" => "Book return delay fine per day.",
                                                        "type" => "number",
                                                        "min" => 1,
                                                        "placeholder" => "Book return delay fine per day",
                                                        "value" => (isset($data['library']['role_config'][$lrc]['return_delay_fine'])) ? $data['library']['role_config'][$lrc]['return_delay_fine'] : '1'
                                                    );
                                                    echo form_input($attribute);
                                                    ?>                                        
                                                </div>
                                            </div>                                
                                            <div class="col-sm-3 no_rpad">
                                                <label class = 'col-sm-7 col-form-label no_pad'>Book lost fine</label>
                                                <div class = 'col-sm-5 no_pad'>
                                                    <?php
                                                    $attribute = array(
                                                        "name" => "app_configs[role_config][$lrc][book_lost_fine]",
                                                        "id" => "default_book_lost_fine",
                                                        "class" => "form-control",
                                                        "title" => "Default book lost fine.",
                                                        "type" => "number",
                                                        "min" => 50,
                                                        "placeholder" => "Book lost fine",
                                                        "value" => (isset($data['library']['role_config'][$lrc]['book_lost_fine'])) ? $data['library']['role_config'][$lrc]['book_lost_fine'] : '50'
                                                    );
                                                    echo form_input($attribute);
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = 'form-group row'>

                                            <div class="col-sm-3 no_rpad">
                                                <label class = 'col-sm-7 col-form-label no_pad'>I-card validity</label>
                                                <div class = 'col-sm-5 no_pad'>                                    
                                                    <?php
                                                    $month_list = array(
                                                        1 => '1 Month', 2 => '2 Months', 3 => '3 Months',
                                                        4 => '4 Months', 5 => '5 Months', 6 => '6 Months',
                                                        7 => '7 Months', 8 => '8 Months', 9 => '9 Months',
                                                        10 => '10 Months', 11 => '11 Months', 12 => '1 Year',
                                                        24 => '2 Years', 36 => '3 Years', 48 => '4 Years',
                                                        60 => '5 Years', 100 => 'Life time'
                                                    ); //100 means life time
                                                    $attribute = array(
                                                        "name" => "app_configs[lib_card_expire_month]",
                                                        "id" => "lib_card_num_prefix",
                                                        "class" => "form-control",
                                                        "title" => "Library card no pre-fix",
                                                        "type" => "text",
                                                        "placeholder" => "Library card no pre-fix",
                                                        "value" => (isset($data['library']['lib_card_expire_month'])) ? $data['library']['lib_card_expire_month'] : '6'
                                                    );
                                                    echo form_dropdown($attribute, $month_list, 6);
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            <?php endforeach; ?>
                            <!-- db roles list-->
                            <!-- end role loop -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>

                <span class="pull-right">
                    <button type="submit" id="library_submit" class="btn btn-primary btn-small"><i class="fa fa-save"></i> Save</button>
                </span>
            </div>
        </div>
    </div>
</div>

<?= form_close() ?>
<script type="text/javascript">
    $(function () {

//lib_card_num_prefix validateion allows only a-z A-Z 0-9
        $('#lib_card_num_prefix').on('keypress', function (event) {
            var regex = new RegExp("^[a-zA-Z0-9\b]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });

        var rootNode = <?= $data['qrcode_columns'] ?>;
        var assigned_roles = <?= $data['qrcode_default_columns'] ?>;

        $('div.treeSelector').treeSelector(rootNode, assigned_roles, function (e, values) {
            var selected_vals = values.toString();
            $('#book_qrcode_columns').val(selected_vals);
        }, {
            checkWithParent: true,
            titleWithParent: true,
            notViewClickParentTitle: true
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
    });//end ready


</script>