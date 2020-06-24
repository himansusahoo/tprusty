<?php ?>
<style>

    .chosen-container .chosen-drop, .chosen-single {
        text-align: left !important;
    }
    .chosen-container .chosen-results{
        max-height: 150px !important;
    }
    .remove_criteria{
        margin-top: 0px;
    }
    .has-error2{
        border: 1px solid red !important;
    }
    .left_align{
        text-align: left !important;
    }
    .padB10{
        padding-bottom: 10px;
    }
</style>

<div class="row">    
    <div id="criteria_success" class="success col-sm-6" style="max-height: 300px; overflow-y: auto">
        <?php
        //pma($criteria);
        if ($this->session->flashdata('criteria_success')) {
            echo $this->session->flashdata('criteria_success');
        }
        ?>
    </div>
</div>
<div class="row">    
    <div id="criteria_error" class="error col-sm-6" style="max-height: 300px; overflow-y: auto">
    </div>
</div>
<div class="row text-center">
    <div class="col-sm-12">
        <?php
        $form_attribute = array(
            "name" => "rbac_permissions",
            "id" => "module_permissions",
            "method" => "POST",
            "class" => "form-horizontal",
        );
        $form_action = "/rbac/rbac_permissions/new_module_action";
        echo form_open($form_action, $form_attribute);
        ?>        
        <div class="panel-body">
            <div class="panel panel-default ">
                <div class="panel-heading" style="min-height: 40px;">
                    <div class="row">
                        <div class="col-sm-3">                                
                            <h3 class="panel-title text-left ">Create module permissions</h3>
                        </div>                            
                        <div class="col-sm-9 pull-right" style="text-align: right;">                    
                            <a class="btn btn-default" id="collapse-all" href="#">Collapse All</a>&nbsp;
                            <a class="btn btn-default" id="expand-all" href="#">Expand All</a>&nbsp;
                            <input type="button" class="btn btn-default" id="save_criteria" value="Save ">&nbsp;                            
                        </div>
                    </div>
                </div>
                <div class="panel-body collapse in" id="super_panel" aria-expanded="true">
                    <div class="row-fluid panel_container">
                        <?php
                        $counter = 1;
                        if ($existing_perms) :
                            //pma($existing_perms);
                            foreach ($existing_perms as $key => $rec):
                                //pma($rec);
                                ?>
                                <div class="panel-body no_pad perm_panel" panel_no="<?php echo $counter ?>" id="panel_<?php echo $counter ?>">
                                    <div class="panel panel-default ">
                                        <div class="panel-heading">
                                            <?php
                                            $module_name = (isset($rec['module_name'])) ? $rec['module_name'] : '';
                                            if ($module_name) {
                                                $module_code = (isset($rec['module_code'])) ? $rec['module_code'] : '';
                                                if ($module_code) {
                                                    $module_name.=' - ' . $module_code;
                                                }
                                            }
                                            ?>
                                            <h3 class="panel-title col-sm-10 text-left" data-toggle="collapse" data-target="#new_perm_panel_<?php echo $counter ?>" aria-expanded="true" style="cursor: pointer">Permission-<?php echo $counter ?> - <?php echo $module_name ?></h3>
                                            <h3 class="panel-title" data-toggle="collapse" data-target="#new_perm_panel_<?php echo $counter ?>" aria-expanded="true" style="cursor: pointer">
                                                &nbsp;<i class="fa fa-chevron-down pull-right"></i>
                                            </h3>
                                        </div>
                                        <div class="panel-body no_pad collapse" id="new_perm_panel_<?php echo $counter ?>" aria-expanded="true">
                                            <div class="box-body">
                                                <div class="col-sm-12 no_pad">                                                        
                                                    <div class="col-sm-6">                                                        
                                                        <div class="col-sm-6">
                                                            <input name="permission[<?php echo $counter ?>][module_id]" value="<?php echo (isset($rec['module_id']) ? $rec['module_id'] : '') ?>" type="hidden">
                                                            <input name="permission[<?php echo $counter ?>][permission_id]" value="<?php echo (isset($rec['permission_id']) ? $rec['permission_id'] : '') ?>" type="hidden">
                                                            <input name="permission[<?php echo $counter ?>][module_name]" value="<?php echo (isset($rec['module_name']) ? $rec['module_name'] : '') ?>" class="form-control module_name_input" title="" type="text" placeholder="Module Name">

                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input name="permission[<?php echo $counter ?>][module_code]" value="<?php echo (isset($rec['module_code'])) ? $rec['module_code'] : '' ?>" class="form-control module_code_input perm_module_code" title="" type="text" placeholder="Module Code">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <div class="col-sm-12 text-left">
                                                                <?php
                                                                if ($actions && is_array($actions)) {
                                                                    $extist_act_ids = array_column($rec['actions'], 'action_id');
                                                                    $extist_perm_ids = array_column($rec['actions'], 'permission_id');
                                                                    $exist_perms = array_combine($extist_act_ids, $extist_perm_ids);

                                                                    foreach ($actions as $key => $val) {
                                                                        $attribute = array(
                                                                            "name" => "permission[$counter][action_id][]",
                                                                            "type" => "checkbox",
                                                                            "value" => $key
                                                                        );
                                                                        if (array_key_exists($key, $exist_perms)) {
                                                                            $attribute['checked'] = 'checked';
                                                                            $attribute['name'] = "permission[$counter][permission_id][]";
                                                                            $attribute['value'] = $exist_perms[$key]; //permission id
                                                                            //app_log('CUSTOM', 'APP', $exist_perms[$key]);
                                                                        }
                                                                        echo form_error("action_id");
                                                                        echo '<div class="checkbox wraper_checkbox">' . form_checkbox($attribute) . ucfirst($val) . '</div>';
                                                                    }
                                                                }
                                                                ?>      
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12 no_pad action_holder" data-panel-no="<?php echo $counter ?>">
                                                                <div class="row-fluid no_pad">
                                                                    <div class="col-sm-12 no_pad">
                                                                        <div class="col-sm-6">
                                                                            <input name="permission[<?php echo $counter ?>][action_name][]" value="" class="form-control action_name_input" title="" type="text" placeholder="Action Name">    
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <input name="permission[<?php echo $counter ?>][action_code][]" value="" class="form-control action_code_input perm_action_code" title="" type="text" placeholder="Action Code">    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <span data-toggle="tooltip" class="fa fa-plus-square fa-lg pull-right add-single-action hand" title="add"> </span>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $counter++;
                            endforeach;
                        else:
                            ?>
                            <div class="panel-body no_pad perm_panel" panel_no="1" id="panel_1">
                                <div class="panel panel-default ">
                                    <div class="panel-heading">
                                        <h3 class="panel-title col-sm-10 text-left ">Permission-1</h3>
                                        <h3 class="panel-title" data-toggle="collapse" data-target="#new_perm_panel_1" aria-expanded="true" style="cursor: pointer">
                                            &nbsp;<i class="fa fa-chevron-down pull-right"></i>
                                        </h3>
                                    </div>
                                    <div class="panel-body no_pad collapse in" id="new_perm_panel_1" aria-expanded="true">
                                        <div class="box-body">
                                            <div class="col-sm-12 no_pad">                                                        
                                                <div class="col-sm-6">                                                        
                                                    <div class="col-sm-6">
                                                        <input name="permission[1][module_name]" value="" class="form-control module_name_input " title="" type="text" placeholder="Module Name">

                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input name="permission[1][module_code]" value="" class="form-control module_code_input perm_module_code" title="" type="text" placeholder="Module Code">    
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-12 text-left">
                                                            <?php
                                                            if ($actions && is_array($actions)) {
                                                                foreach ($actions as $key => $val) {
                                                                    $attribute = array(
                                                                        "name" => "permission[1][action_id][]",
                                                                        "type" => "checkbox",
                                                                        "value" => $key
                                                                    );
                                                                    echo form_error("action_id");
                                                                    echo '<div class="checkbox wraper_checkbox">' . form_checkbox($attribute) . ucfirst($val) . '</div>';
                                                                }
                                                            }
                                                            ?>      
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12 no_pad action_holder" data-panel-no="1">
                                                            <div class="row-fluid no_pad">
                                                                <div class="col-sm-12 marginT5 no_pad">
                                                                    <div class="col-sm-6">
                                                                        <input name="permission[1][action_name][]" value="" class="form-control action_name_input" title="" type="text" placeholder="Action Name">    
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input name="permission[1][action_code][]" value="" class="form-control action_code_input perm_action_code" title="" type="text" placeholder="Action Code">    
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <span data-toggle="tooltip" class="fa fa-plus-square fa-lg pull-right add-single-action hand" title="add"> </span>
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif;
                        ?>
                    </div><!--end panel container row-->
                    <span id="module_perm_add" data-toggle="tooltip" class="fa fa-plus-square fa-lg pull-right hand"  title="add"> </span>
                </div>
            </div>
        </div>
        </form><?php echo form_close() ?>
    </div>

    <script type="text/javascript">

        $(document).ready(function () {

            var MP = {
                panelHeading: "Permission",
                get_panel_no: function (element) {
                    return parseInt($(element).find('.perm_panel').last().attr('panel_no'));
                },
                get_action_no: function () {

                },
                is_action_exist: function () {
                    console.log(this.action_codes);
                },
                push_action: function () {

                },
                pop_action: function () {

                },
                remove_module_on_edit_field: function (module_code) {
                    MP.current_module_code = module_code.trim();
                    //console.log('MP.current_module_code',MP.current_module_code,MP.src_module_codes.indexOf(MP.current_module_code));

                    if (MP.current_module_code && MP.src_module_codes.indexOf(MP.current_module_code) === -1) {
                        MP.pop_module(MP.current_module_code);
                    }
                    //console.log('focus',MP.current_module_code,MP.module_codes);
                },
                is_module_exist: function (module_code) {
                    console.log('is_module_exist= ', this.module_codes, this.module_codes.indexOf(module_code));
                    if (this.module_codes.indexOf(module_code) !== -1) {
                        return true;
                    }
                    return false;
                },
                push_module: function (module_code) {
                    if (!this.is_module_exist(module_code)) {
                        if (module_code) {
                            this.module_codes.push(module_code);
                            console.log('this.module_codes', this.module_codes);
                        }
                    }
                },
                pop_module: function (module_code) {
                    var indx = this.module_codes.indexOf(module_code);
                    this.module_codes.splice(indx, 1);
                    console.log('pop module', indx, this.module_codes);
                },
                src_module_codes:<?php echo $module_codes_json ?>,
                src_action_codes: <?php echo $action_codes_json ?>,
                module_codes: <?php echo $module_codes_json ?>,
                action_codes: <?php echo $action_codes_json ?>,
                current_module_code: '',
                chosen_callback: function () {

                },
                getDBActionCheckBox: function (panel_no) {
                    var actions =<?php echo $action_json ?>;
                    var chkBoxHtml = '<div class="col-sm-12 text-left">';
                    for (var key in actions) {
                        if (actions.hasOwnProperty(key)) {
                            chkBoxHtml += "<div class='checkbox wraper_checkbox'>"
                                    + "<input name='permission[" + panel_no + "][action_id][]' value='" + key + "' type='checkbox'>" + actions[key].toUpperCase()
                                    + "</div>";
                        }
                    }
                    chkBoxHtml += "</div>";
                    return chkBoxHtml;
                },
                getPanelHtml: function (element) {
                    var panel_no = (this.get_panel_no(element) + 1);
                    var panel_heading = this.panelHeading;
                    var chkBoxHtml = this.getDBActionCheckBox(panel_no);

                    var htmls = '<div class="panel-body no_pad perm_panel" panel_no="' + panel_no + '" id="panel_' + panel_no + '">'
                            + '     <div class="panel panel-default ">'
                            + '        <div class="panel-heading">'
                            + '            <h3 class="panel-title col-sm-2 text-left ">Permission-' + panel_no + '</h3>'
                            + '            <h3 class="panel-title" data-toggle="collapse" data-target="#cpanel_' + panel_no + '" aria-expanded="true" style="cursor: pointer">'
                            + '                &nbsp;<i class="fa fa-chevron-down pull-right"></i>'
                            + '            </h3>'
                            + '        </div>'
                            + '        <div class="panel-body no_pad collapse in" id="cpanel_' + panel_no + '" aria-expanded="true">'
                            + '            <div class="box-body">'
                            + '                 <div class="col-sm-12 no_pad">'
                            + '                     <div class="col-sm-6">'
                            + '                         <div class="col-sm-12">'
                            + '                             <div class="col-sm-6">'
                            + '                                 <input name="permission[' + panel_no + '][module_name]" value="" class="form-control module_name_input" title="" type="text" placeholder="Module Name">'
                            + '                             </div>'
                            + '                             <div class="col-sm-6">'
                            + '                                 <input name="permission[' + panel_no + '][module_code]" value="" class="form-control module_code_input perm_module_code" title="" type="text" placeholder="Module Code">'
                            + '                             </div>'
                            + '                         </div>'
                            + '                     </div>'
                            + '                     <div class="col-sm-6">'
                            + '                         <div class="row">'
                            + '                             <div class="col-sm-12 text-left">' + chkBoxHtml + '</div>'
                            + '                         </div>'
                            + '                         <div class="row">'
                            + '                             <div class="col-sm-12 no_pad action_holder" data-panel-no="' + panel_no + '">'
                            + '                                 <div class="row-fluid no_pad">'
                            + '                                     <div class="col-sm-12 marginT5 no_pad">'
                            + '                                         <div class="col-sm-6">'
                            + '                                             <input name="permission[' + panel_no + '][action_name][]" value="" class="form-control action_name_input" title="" type="text" placeholder="Action Name">'
                            + '                                         </div>'
                            + '                                         <div class="col-sm-6">'
                            + '                                             <input name="permission[' + panel_no + '][action_code][]" value="" class="form-control action_code_input perm_action_code" title="" type="text" placeholder="Action Code">'
                            + '                                         </div>'
                            + '                                     </div>'
                            + '                             </div>'
                            + '                             </div>'
                            + '                             <span data-toggle="tooltip" class="fa fa-plus-square fa-lg pull-right add-single-action hand" title="add"> </span>'
                            + '                         </div>'
                            + '                     </div>'
                            + '                 </div>'
                            + '            </div>'
                            + '            <span class="fa fa-times-circle fa-lg pull-right remove_criteria"  title="Remove Criteria"> </span>'
                            + '        </div>'
                            + '    </div>'
                            + '</div>';
                    return htmls;
                },
                getActionHtml: function (element) {
                    var panel_no = $(element).parent("div").find(".action_holder").data('panel-no');
                    var htmls = '<div class="row-fluid no_pad single-action-row">'
                            + ' <div class="col-sm-12 marginT5 no_pad">'
                            + '     <div class="col-sm-6 ">'
                            + '         <input name="permission[' + panel_no + '][action_name][]" value="" class="form-control" title="" type="text" placeholder="Action Name">'
                            + '     </div>'
                            + '     <div class="col-sm-6 ">'
                            + '         <input name="permission[' + panel_no + '][action_code][]" value="" class="form-control perm_action_code" title="" type="text" placeholder="Action Code">'
                            + '     </div>'
                            + ' </div>'
                            + ' <span class="fa fa-times-circle pull-right remove_single_action hand"  title="Remove action"> </span>'
                            + '</div>';
                    return htmls;
                }
            };
            //console.log('MP',MP);
            //exapand/collapse all panel
            $('#expand-all').on('click', function () {
                $('.collapse').collapse('show');
            });
            $('#collapse-all').on('click', function () {
                $('.collapse:not("#super_panel")').collapse('hide');
            });
            $(document).on('click', '.remove_criteria', function () {
                $(this).closest('div.perm_panel').remove();
            });
            $(document).on('click', '.add-single-action', function () {
                var actionHtml = MP.getActionHtml(this);
                var act_holder = $(this).closest('div.row').find('.action_holder');
                act_holder.append(actionHtml);
            });
            $(document).on('click', '.remove_single_action', function () {
                $(this).parent('div.single-action-row').remove();
            });
            $('#module_perm_add').on('click', function () {
                //$('div.perm_panel:last').clone().appendTo($('div.panel_container'));
                var panel = MP.getPanelHtml('#super_panel');
                $('#super_panel').find('.panel_container').append(panel);
            });

            $(document).on('blur', '.perm_module_code', function () {
                var module_code = $(this).val().trim();
                if (module_code) {
                    if (!MP.is_module_exist(module_code)) {
                        MP.push_module(module_code);
                    } else {
                        $(this).val('');
                        var parent_div = $(this).closest('div');
                        show_error_span(parent_div,'Module code is already assigned, please user another');
                    }
                }
            });
            $(document).on('focus', '.perm_module_code', function () {
                MP.remove_module_on_edit_field($(this).val());
            });
            //remove error msg
            $(document).on('focus', '.module_name_input', function () {
                var module_name_parent = $(this).closest('div');
                module_name_parent.removeClass('has-error');
                module_name_parent.find('span.help-block').remove();
            });
            $(document).on('focus', '.module_code_input', function () {
                var module_code_parent = $(this).closest('div');
                module_code_parent.removeClass('has-error');
                module_code_parent.find('span.help-block').remove();
            });
            $(document).on('focus', '.action_code_input', function () {
                var action_code_parent = $(this).closest('div');
                action_code_parent.removeClass('has-error');
                action_code_parent.find('span.help-block').remove();
            });

            $(document).on('click', '#save_criteria', function (e) {
                var prent_div = '';
                var submit_flag = true;
                //module name validation
                $('.module_name_input').each(function () {
                    parent_div = $(this).closest('div');
                    if ($(this).val() == '') {
                        show_error_span(parent_div,'Module name is required');
                        submit_flag = false;                        
                    }
                });
                //module code validation
                $('.module_code_input').each(function () {
                    if ($(this).val() == '') {
                        parent_div = $(this).closest('div');
                        show_error_span(parent_div,'Module code is required.');
                        submit_flag = false;
                    }
                });
                //action code validation
                var action_name = '';
                $('.action_code_input').each(function () {
                    if ($(this).val() != '') {
                        action_name = $(this).parent('div').prev('div').find('input.action_name_input').val();
                        if (action_name == '') {
                            parent_div = $(this).closest('div');
                            show_error_span(parent_div,'Action name is required.'); 
                            submit_flag = false;
                        }
                    }
                });
                if (submit_flag) {
                    $('#module_permissions').submit();
                }
            });

            function show_error_span(selector,message) {
                if (!selector.hasClass('has-error')) {
                    selector.addClass('has-error');
                    selector.append('<span class="help-block pull-left">'+message+'</span>');                    
                }
            }
        });
    </script>
