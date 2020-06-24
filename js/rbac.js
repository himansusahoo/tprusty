(function ($) {
    jQuery('#loading').removeClass('hide');
    myApp.CommonMethod.checkAll($('#check_all'), 'check_item');

    $(document).on('change', '#manage_permission_role_list', function () {
        myApp.Ajax.sub_path = 'rbac';
        myApp.Ajax.controller = 'rbac_role_permissions';
        myApp.Ajax.method = 'manage_permissions';
        myApp.Ajax.post_data = {
            'role_id': $(this).val()
        }
        myApp.Ajax.genericAjax($('#role_permission_table'), 'html');
    });

    $(document).on('click', '#save_rbac_permission', function (e) {
        e.preventDefault();
        if ($('.check_item:checked').length == 0) {
            $('#error_msg').html('Please select permissions!');
        } else {
            $('#permission_form').submit();
        }
    });


    $('#save_role_permission').on('click', function (e) {
        e.preventDefault();

        if ($('select[name=manage_permission_role_list]').val() == '') {
            $('#error_msg').html('Select role!');
        } else if ($('.check_item:checked').length == 0) {
            $('#error_msg').html('Select options!');
        } else {

            myApp.Ajax.sub_path = 'rbac';
            myApp.Ajax.controller = 'rbac_role_permissions';
            myApp.Ajax.method = 'save_role_permission';
            myApp.Ajax.post_data = $("#role_permission_form").serialize();
            $.when(myApp.Ajax.genericAjax($('#role_permission_table'), null, message_toggle))
                    .then(function () {
                        $('#manage_permission_role_list').trigger('change');
                    });
        }
    });

    $(document).on('click', '#save_menu_table', function (e) {
        e.preventDefault();
        if ($('select[name=menu_module_id]').val() == '') {
            $('#error_msg').html('Select module!');
        } else {

            myApp.Ajax.sub_path = 'rbac';
            myApp.Ajax.controller = 'rbac_permissions';
            myApp.Ajax.method = 'save_managed_menu';
            myApp.Ajax.post_data = $("#manage_menu_form").serialize();
            $.when(myApp.Ajax.genericAjax($('#manage_menu_table'), 'html', message_toggle))
                    .then(function () {
                        $('#menu_module_id').trigger('change');
                    });
        }
    });

    $('#show_menu_actions').on('click', function () {
        myApp.Ajax.sub_path = 'rbac';
        myApp.Ajax.controller = 'rbac_permissions';
        myApp.Ajax.method = 'get_module_permissions';
        var modules = [];
        $("#menu_module_id_div input[type='checkbox']:checked").each(function () {
            if ($(this).val()) {
                modules.push($(this).val());
            }
        });        
        if (modules) {
            myApp.Ajax.post_data = {
                module: modules
            };            
            $.when(myApp.Ajax.genericAjax($('#manage_menu_table'), 'html'));
        }else{
            $('#manage_menu_table').html();
        }
    });

    $('#all_module_box').on('change', function () {
        myApp.Ajax.sub_path = 'rbac';
        myApp.Ajax.controller = 'rbac_permissions';
        myApp.Ajax.method = 'get_module_permissions';

        if ($(this).is(':checked')) {
            myApp.Ajax.post_data = {
                module: 0,
                all_module: 1
            };
            $.when(myApp.Ajax.genericAjax($('#manage_menu_table'), 'html'));
        } else {
            $('#manage_menu_table').html('');
        }

    });

})(jQuery);