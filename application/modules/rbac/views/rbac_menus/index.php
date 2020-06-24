<?php ?>

<div class="col-sm-12">
    <?php
    if ($this->rbac->has_permission('MANAGE_MENU', 'CREATE')) {
        echo '<button class="btn btn-primary" id="add_root" ><span class="fa fa-plus">Add Root</span></button>';
        echo '&nbsp;&nbsp;<button class="btn btn-primary" id="add_chield" ><span class="fa fa-plus">Add Chield</span></button>';
    }
    if ($this->rbac->has_permission('MANAGE_MENU', 'DELETE')) {
        echo '&nbsp;&nbsp;<button class="btn btn-danger" id="delete"><span class="fa fa-trash"> Delete</span></button>';
    }
    ?>

</div>
<?php if ($this->rbac->has_permission('MANAGE_MENU', 'LIST')) : ?>
    <div class="col-sm-12 no_lpad">
        <div class="col-sm-3 no_lpad" id="jstree"></div>
        <div class="col-sm-9 no_rpad">       
            <!-- form start -->
            <form class="form-horizontal">
                <div id="form_load">
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
    <script type="text/javascript">
        // Setup the jsTree.
        $(function () {
            myApp.CommonMethod.log_flag = true;
            var clicked_ele = '';
            var ele_count = 1;
            var js_tree = $('#jstree').jstree({
                "plugins": ["dnd", "types"],
                "themes": {"stripes": true},
                'core': {
                    'data': {
                        "url": "<?= base_url('rbac/rbac_menus/get_tree_data') ?>",
                        "dataType": "json", // needed only if you do not supply JSON headers

                    },
                    "multiple": false,
                    'check_callback': true
                }
            }).on("changed.jstree", function (e, data) {
                if (data.selected.length) {
                    clicked_ele = data.instance.get_node(data.selected[0]);
                    myApp.CommonMethod.app_log('clicked_ele', clicked_ele);
                    var indx = $('#' + clicked_ele.id).index();
                    render_menu_form(clicked_ele);
                    $('#node_position').val(indx);
                    //make ajax call to fetch perm details
                    //alert('The selected node is: ' + data.instance.get_node(data.selected[0]).text);
                }
            }).on("create_node.jstree", function (e, data) {
                myApp.CommonMethod.app_log('New node created', data);
            }).on('delete_node.jstree', function (e, data) {
                myApp.CommonMethod.app_log('Delete node', data);
            }).on('rename_node.jstree', function (e, data) {
                myApp.CommonMethod.app_log('Rename node', data);
            }).on('move_node.jstree', function (e, data) {
    <?php if ($this->rbac->has_permission('MANAGE_MENU', 'EDIT')) : ?>
                    update_parent(data);
    <?php endif; ?>

            });

            //add new node
            $('#add_root').on('click', function () {
                var selected_node = [];// $('#jstree').jstree(true).get_selected(true);
                createNewNode(selected_node);
            });
            //add new node
            $('#add_chield').on('click', function () {
                var selected_node = $('#jstree').jstree(true).get_selected(true);
                if (selected_node.length > 0) {
                    createNewNode(selected_node);
                } else {
                    //throw an error to set the job role of the current row.
                    var errorMsg = {
                        'type': 'default',
                        'title': "Error",
                        'message': "Please select node to create chiled node.",
                    };
                    myApp.modal.alert(errorMsg);
                }

            });
            //delete node        
            $('#delete').on('click', function () {
                var selected_node = $('#jstree').jstree(true).get_selected();
                deleteNode(selected_node[0]);
            });

            $(document).on('click', '#save_menu_detail', function () {
                var promise = new Promise(function (resolve, reject) {
                    var form_data = {
                        menu_name: $('#menu_name').val(),
                        menu_type: $('#menu_type').val(),
                        permission: $('#permission').val(),
                        url: $('#url').val(),
                        icon_class: $('#icon_class').val(),
                        menu_class: $('#menu_class').val(),
                        menu_attr: $('#attribute').val(),
                        parent: clicked_ele.parent,
                        menu_text: clicked_ele.text,
                        menu_id: $('#menu_id').val(),
                        menu_order: $('#node_position').val(),
                    };
                    $.ajax({
                        url: base_url + "rbac/rbac_menus/save_menu_details",
                        type: 'POST',
                        dataType: 'JSON',
                        data: {"menu_data": form_data},
                        success: function (result) {
                            resolve(result);
                        },
                        error: function (result) {
                            reject(result);
                        }
                    });
                });

                promise.then(function (resolve) {
                    var tree = $("#jstree").jstree(true);
                    tree.refresh();
                    show_message(resolve);
                }, function (reject) {
                    show_message(reject);
                });

            });

            function createNewNode(parent_node) {
                myApp.CommonMethod.app_log('parent_node', parent_node);
                var promise = new Promise(function (resolve, reject) {
                    var order = 1;
                    var parent_id = 0;
                    if (typeof parent_node[0] != 'undefined') {
                        if (parent_node[0].children.length) {
                            order = parseInt(parent_node[0].children.length) + 1;
                        }
                        parent_id = parent_node[0].id;
                    }
                    var node_data = {
                        menu_order: order,
                        parent: parent_id,
                        menu_name: 'new_node_' + order
                    };

                    myApp.CommonMethod.app_log('parent_node', node_data);
                    //console.log('node_data', node_data);
                    $.ajax({
                        url: base_url + "rbac/rbac_menus/create_dummy_menu",
                        type: 'POST',
                        dataType: 'JSON',
                        data: node_data,
                        success: function (result) {
                            resolve(result);
                        },
                        error: function (result) {
                            reject(result);
                        }
                    });

                });
                promise.then(function (resolve) {
                    myApp.CommonMethod.app_log('resolve', resolve);
                    var tree = $("#jstree").jstree(true);
                    tree.deselect_all(true);
                    $("#jstree").one("refresh.jstree", function () {
                        tree.select_node(resolve.new_node);
                    })
                    tree.refresh();

                }, function (reject) {
                    console.log('reject', reject);
                    show_message(reject);
                });
            }

            function deleteNode(selected_node) {
                BootstrapDialog.show({
                    title: 'Manage Menu',
                    message: 'Do you want to delete the menu?',
                    buttons: [{
                            label: 'Yes',
                            action: function (dialog) {
                                processNodeDeleting(selected_node);
                                $('#form_load').html('');
                                dialog.close();
                            }
                        }, {
                            label: 'Cancel',
                            action: function (dialog) {
                                dialog.close();
                            }
                        }]
                });
                //instance.delete_node();
            }

            function processNodeDeleting(node_id) {
                var promise = new Promise(function (resolve, reject) {
                    var node_data = {
                        node_id: node_id
                    };

                    $.ajax({
                        url: base_url + "rbac/rbac_menus/delete_menu",
                        type: 'POST',
                        dataType: 'JSON',
                        data: node_data,
                        success: function (result) {
                            resolve(result);
                        },
                        error: function (result) {
                            reject(result);
                        }
                    });

                });
                promise.then(function (resolve) {
                    js_tree.jstree("refresh");
                }, function (reject) {
                    show_message(reject);
                });
            }

            function show_message(reject) {
                var errMsg = {
                    'type': 'default',
                    title: (typeof reject.title != 'undefined' && reject.title != '') ? reject.title : 'Manage Menu',
                    message: (reject.message != '') ? reject.message : 'There are some error, please try again!'
                }
                myApp.modal.alert(errMsg);
            }

            function render_menu_form(node_data) {
                myApp.Ajax.controller = 'rbac/rbac_menus';
                myApp.Ajax.method = 'get_menu_details_form';
                myApp.Ajax.form_method = 'POST';
                myApp.Ajax.post_data = {id: node_data.id};
                myApp.Ajax.genericAjax($("#form_load"), 'html');
            }

            function update_parent(node_data) {
                myApp.Ajax.controller = 'rbac/rbac_menus';
                myApp.Ajax.method = 'update_parent_and_order';
                myApp.Ajax.form_method = 'POST';
                myApp.Ajax.post_data = {id: node_data.node.id, 'parent': node_data.parent, 'position': node_data.position};
                myApp.Ajax.genericAjax();
            }


        });
    </script>
<?php endif; ?>
