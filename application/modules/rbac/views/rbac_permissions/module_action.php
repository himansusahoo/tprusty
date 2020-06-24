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
        $form_action = "/rbac/rbac_permissions/module_action";
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
                            <div class="panel panel-default orange_border">
                                <div class="panel-heading orange_bg" style="min-height: 40px;">
                                    <div class="row">
                                        <div class="col-sm-3">                                
                                            <h3 class="panel-title text-left white-text">Update module permissions</h3>
                                        </div>                            
                                        <div class="col-sm-9 pull-right" style="text-align: right;">                    
                                            <a class="btn btn-default pannel_button pannel_button_w90" id="updatep-collapse-all" href="#">Collapse All</a>&nbsp;
                                            <a class="btn btn-default pannel_button pannel_button_w90" id="updatep-expand-all" href="#">Expand All</a>&nbsp;                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body collapse" id="update_perm_panel" aria-expanded="true">
                                    <div class="row-fluid panel_container">
                                        <div class="panel-body no_pad criteria_panel" panel_no="1" id="panel_1">
                                            <div class="panel panel-default orange_border">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title col-sm-2 text-left white-text">Permission-1</h3>
                                                    <h3 class="panel-title" data-toggle="collapse" data-target="#update_perm_panel_1" aria-expanded="true" style="cursor: pointer">
                                                        &nbsp;<i class="fa fa-chevron-down pull-right"></i>
                                                    </h3>
                                                </div>
                                                <div class="panel-body no_pad collapse in" id="update_perm_panel_1" aria-expanded="true">
                                                    <div class="box-body">
                                                        <div class="alert panel-default wraper_alert_bmargin main-module-action-box">                                                            
                                                            <div class="row">
                                                                <div class="col-sm-12 no_pad">                                                        
                                                                    <div class="col-sm-6">                                                            
                                                                        <div class="col-sm-12">
                                                                            <?php
                                                                            $attribute = array(
                                                                                "name" => "permission[1][modules]",
                                                                                "class" => "form-control",
                                                                                "title" => ""
                                                                            );
                                                                            echo form_dropdown($attribute, $module_options);
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <div class="col-sm-12 text-left">
                                                                                <?php
                                                                                if ($actions && is_array($actions)) {
                                                                                    foreach ($actions as $key => $val) {
                                                                                        if ($key != '') {
                                                                                            $attribute = array(
                                                                                                "name" => "permission[1][action_id][]",
                                                                                                "type" => "checkbox",
                                                                                                "value" => $key
                                                                                            );
                                                                                            echo '<div class="checkbox wraper_checkbox">' . form_checkbox($attribute) . ucfirst($val) . '</div>';
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>                                                                
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-sm-12 no_pad action_holder">
                                                                                <div class="row-fluid no_pad">
                                                                                    <div class="col-sm-12 marginT5 no_pad">
                                                                                        <div class="col-sm-6">
                                                                                            <input name="permission[1][action_name][]" value="" class="form-control" title="" type="text" placeholder="Action Name">    
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <input name="permission[1][action_code][]" value="" class="form-control" title="" type="text" placeholder="Action Code">    
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
                                            </div>
                                        </div>
                                    </div>
                                    <span id="upd_module_perm_add" data-toggle="tooltip" class="fa fa-plus-square fa-lg pull-right add-single-skill hand"  title="add"> </span>
                                </div>
                            </div>
                        </div>

                        <!--NEW PERMISSIONS-->
                        <div class="panel-body">
                            <div class="panel panel-default orange_border">
                                <div class="panel-heading orange_bg" style="min-height: 40px;">
                                    <div class="row">
                                        <div class="col-sm-3">                                
                                            <h3 class="panel-title text-left white-text">Create module permissions</h3>
                                        </div>                            
                                        <div class="col-sm-9 pull-right" style="text-align: right;">                    
                                            <a class="btn btn-default pannel_button pannel_button_w90" id="newp-collapse-all" href="#">Collapse All</a>&nbsp;
                                            <a class="btn btn-default pannel_button pannel_button_w90" id="newp-expand-all" href="#">Expand All</a>&nbsp;                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body collapse" id="new_perm_panel" aria-expanded="true">
                                    <div class="row-fluid panel_container">
                                        <div class="panel-body no_pad criteria_panel" panel_no="1" id="panel_1">
                                            <div class="panel panel-default orange_border">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title col-sm-2 text-left white-text">Permission-1</h3>
                                                    <h3 class="panel-title" data-toggle="collapse" data-target="#new_perm_panel_1" aria-expanded="true" style="cursor: pointer">
                                                        &nbsp;<i class="fa fa-chevron-down pull-right"></i>
                                                    </h3>
                                                </div>
                                                <div class="panel-body no_pad collapse in" id="new_perm_panel_1" aria-expanded="true">
                                                    <div class="box-body">                                            
                                                        <div class="alert panel-default wraper_alert_bmargin opt-module-action-box">                                                            
                                                            <div class="row">
                                                                <div class="col-sm-12 no_pad">                                                        
                                                                    <div class="col-sm-6">                                                        
                                                                        <div class="col-sm-6">
                                                                            <input name="permission[1][or][module_name]" value="" class="form-control" title="" type="text" placeholder="Module Name">    
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <input name="permission[1][or][module_code]" value="" class="form-control" title="" type="text" placeholder="Module Code">    
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <div class="col-sm-12 text-left">
                                                                                <?php
                                                                                if ($actions && is_array($actions)) {
                                                                                    foreach ($actions as $key => $val) {
                                                                                        if ($key != '') {
                                                                                            $attribute = array(
                                                                                                "name" => "permission[1][or][action_id][]",
                                                                                                "type" => "checkbox",
                                                                                                "value" => $key
                                                                                            );
                                                                                            echo form_error("action_id");
                                                                                            echo '<div class="checkbox wraper_checkbox">' . form_checkbox($attribute) . ucfirst($val) . '</div>';
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>      
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-sm-12 no_pad action_holder">
                                                                                <div class="row-fluid no_pad">
                                                                                    <div class="col-sm-12 marginT5 no_pad">
                                                                                        <div class="col-sm-6">
                                                                                            <input name="permission[1][or][action_name]" value="" class="form-control" title="" type="text" placeholder="Action Name">    
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <input name="permission[1][or][action_code]" value="" class="form-control" title="" type="text" placeholder="Action Code">    
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <span data-toggle="tooltip" class="fa fa-plus-square fa-lg pull-right add-single-action-or hand" title="add"> </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--end panel container row-->
                                    <span id="new_module_perm_add" data-toggle="tooltip" class="fa fa-plus-square fa-lg pull-right add-single-skill hand"  title="add"> </span>
                                </div>
                            </div>
                        </div>


                    </div><!--end panel container row-->                    
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
                    return parseInt($(element).find('.criteria_panel').last().attr('panel_no'));
                },
                get_action_no: function () {

                },
                m1_options: "",
                m2_options: "",
                m3_options: "",
                emp_options: "",
                chosen_callback: function () {

                },
                getCriteriaHtml: function (element) {
                    var panel_no = (this.get_panel_no(element) + 1);
                    var panel_heading = this.panelHeading;
                    var htmls = '<div class="panel-body no_pad criteria_panel" panel_no="' + panel_no + '" id="panel_' + panel_no + '">'
                            + '    <div class="panel panel-default orange_border">'
                            + '        <div class="panel-heading orange_bg">'
                            + '            <h3 class="panel-title col-sm-2 text-left white-text">Permission-' + panel_no + '</h3>'
                            + '            <h3 class="panel-title" data-toggle="collapse" data-target="#cpanel_' + panel_no + '" aria-expanded="true" style="cursor: pointer">'
                            + '                &nbsp;<i class="fa fa-chevron-down pull-right"></i>'
                            + '            </h3>'
                            + '        </div>'
                            + '        <div class="panel-body no_pad collapse in" id="cpanel_' + panel_no + '" aria-expanded="true">'
                            + '            <div class="box-body">'
                            + '                <div class="row padB10">'
                            + '                    <div class="col-sm-12">'
                            + '                    </div>'
                            + '                </div>'
                            + '                <div class="row padB10">'
                            + '                    <div class="col-sm-12">'
                            + '                    </div>'
                            + '                </div>'
                            + '                <div class="row padB10">'
                            + '                    <div class="col-sm-12">'
                            + '                    </div>'
                            + '                </div>'
                            + '                <div class="row padB10">'
                            + '                    <div class="col-sm-12">'
                            + '                    </div>'
                            + '                </div>'
                            + '                <div class="row padB10">'
                            + '                    <div class="col-sm-12">'
                            + '                    </div>'
                            + '                </div>'
                            + '             <span class="fa fa-times-circle fa-lg pull-right remove_criteria"  title="Remove Criteria"> </span>'
                            + '            </div>'
                            + '        </div>'
                            + '    </div>'
                            + '</div>';
                    return htmls;
                },
                getActionHtml: function () {
                    var panel_no = (this.get_panel_no());
                    var htmls = '<div class="row-fluid no_pad single-action-row">'
                            + ' <div class="col-sm-12 marginT5 no_pad">'
                            + '     <div class="col-sm-6 ">'
                            + '         <input name="permission[' + panel_no + '][action_name][]" value="" class="form-control" title="" type="text" placeholder="Action Name">'
                            + '     </div>'
                            + '     <div class="col-sm-6 ">'
                            + '         <input name="permission[' + panel_no + '][action_code][]" value="" class="form-control" title="" type="text" placeholder="Action Code">'
                            + '     </div>'
                            + ' </div>'
                            + ' <span class="fa fa-times-circle pull-right remove_single_action hand"  title="Remove action"> </span>'
                            + '</div>';
                    return htmls;
                },
                getActionHtmlOr: function () {
                    var panel_no = (this.get_panel_no());
                    var htmls = '<div class="row-fluid no_pad single-action-row">'
                            + ' <div class="col-sm-12 marginT5 no_pad">'
                            + '     <div class="col-sm-6 ">'
                            + '         <input name="permission[' + panel_no + '][or][action_name][]" value="" class="form-control" title="" type="text" placeholder="Action Name">'
                            + '     </div>'
                            + '     <div class="col-sm-6 ">'
                            + '         <input name="permission[' + panel_no + '][or][action_code][]" value="" class="form-control" title="" type="text" placeholder="Action Code">'
                            + '     </div>'
                            + ' </div>'
                            + ' <span class="fa fa-times-circle pull-right remove_single_action hand"  title="Remove action"> </span>'
                            + '</div>';
                    return htmls;
                }
            };
            //exapand/collapse all panel
            $('#expand-all').on('click', function () {
                $('.collapse').collapse('show');
            });
            $('#collapse-all').on('click', function () {
                $('.collapse:not("#super_panel")').collapse('hide');
            });
            
            $('#updatep-expand-all').on('click', function () {     
                $("#update_perm_panel").removeClass('in').addClass('in');
                $("#update_perm_panel").find('.collapse').collapse('show');
            });
            $('#updatep-collapse-all').on('click', function () {
                $("#update_perm_panel").find('.collapse').collapse('hide');                
            });
            
            $('#newp-expand-all').on('click', function () {     
                $("#new_perm_panel").removeClass('in').addClass('in');
                $("#new_perm_panel").find('.collapse').collapse('show');
            });
            $('#newp-collapse-all').on('click', function () {
                $("#new_perm_panel").find('.collapse').collapse('hide');                
            });
            
            
            $(document).on('click', '.remove_criteria', function () {
                $(this).closest('div.criteria_panel').remove();
            });
            $('#upd_module_perm_add').on('click', function () {
                //$('div.criteria_panel:last').clone().appendTo($('div.panel_container'));
                var panel = MP.getCriteriaHtml('#update_perm_panel');
                $('#update_perm_panel').find('.panel_container').append(panel);
            });
            
            $('#new_module_perm_add').on('click', function () {
                //$('div.criteria_panel:last').clone().appendTo($('div.panel_container'));
                var panel = MP.getCriteriaHtml('#new_perm_panel');
                $('#new_perm_panel').find('.panel_container').append(panel);
            });
            
            $(document).on('click', '.add-single-action', function () {
                var actionHtml = MP.getActionHtml();
                var act_holder = $(this).closest('div.row').find('.action_holder');
                act_holder.append(actionHtml);
            });
            $(document).on('click', '.add-single-action-or', function () {
                var actionHtml = MP.getActionHtmlOr();
                var act_holder = $(this).closest('div.row').find('.action_holder');
                act_holder.append(actionHtml);
            });
            $(document).on('click', '.remove_single_action', function () {
                $(this).parent('div.single-action-row').remove();
            });

            $(document).on('click', '.opt-module-action-box-radio', function () {
                var optEle = '.opt-module-action-box';
                var mainEle = '.main-module-action-box';
                enable_all_elements(optEle);
                disable_all_elements(mainEle);
            });

            $(document).on('click', '.main-module-action-box-radio', function () {
                var optEle = '.opt-module-action-box';
                var mainEle = '.main-module-action-box';

                enable_all_elements(mainEle);
                disable_all_elements(optEle);
            });

            function disable_all_elements(selecter) {
                console.log(selecter, 'disabled');
                $(selecter + " :input").prop("disabled", true);
                $(selecter + " :input:radio").prop("disabled", false);
            }

            function enable_all_elements(selecter) {
                $(selecter + " :input").prop("disabled", false);
                console.log(selecter, 'enabled');
            }
        });
    </script>
