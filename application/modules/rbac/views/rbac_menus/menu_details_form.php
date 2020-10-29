<?php ?>
<div class="col-12">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Manage Menu</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" id="save_details_form" name="save_details_form" method="post">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="node_position" class="col-sm-3 col-form-label">Order</label>
                            <div class="col-sm-9">
                                <input name="node_position" id="node_position" value="<?= $menu_details['menu_order'] ?>" class="form-control" type="text"> 
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="menu_name" class="col-sm-3 col-form-label">Menu Name</label>
                            <div class="col-sm-9">
                                <input name="menu_name" id="menu_name" value="<?= $menu_details['text'] ?>" class="form-control" type="text"> 
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="menu_type" class="col-sm-3 col-form-label">Menu Type</label>
                            <div class="col-sm-9">
                                <?php
                                $attribute = array(
                                    "name" => "menu_type",
                                    "id" => "menu_type",
                                    "class" => "form-control"
                                );
                                $menu_type = (isset($menu_details['menu_type'])) ? $menu_details['menu_type'] : '';
                                echo form_error("menu_type");
                                echo form_dropdown($attribute, $menu_types, $menu_type);
                                ?>  
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="permission" class="col-sm-3 col-form-label">Permission</label>
                            <div class="col-sm-9">
                                <?php
                                $attribute = array(
                                    "name" => "permission",
                                    "id" => "permission",
                                    "class" => "form-control",
                                    "title" => "",
                                    "required" => "",
                                );
                                $permission_id = (isset($menu_details['permission_id'])) ? $menu_details['permission_id'] : '';
                                echo form_error("permission");
                                echo form_dropdown($attribute, $permission_id_list, $permission_id);
                                ?>   
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="url" class="col-sm-3 col-form-label">URL</label>
                            <div class="col-sm-9">
                                <input name="url" id="url" value="<?= $menu_details['url'] ?>" class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="icon_class" class="col-sm-3 col-form-label">Icon Class</label>
                            <div class="col-sm-9">
                                <input name="icon_class" id="icon_class" value="<?= $menu_details['icon_class'] ?>" class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="menu_class" class="col-sm-3 col-form-label">Menu Class</label>
                            <div class="col-sm-9">
                                <input name="menu_class" id="menu_class" value="<?= $menu_details['menu_class'] ?>" class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">                    
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-9">
                        <div class="form-group row">
                            <label for="attribute" class="col-sm-2 col-form-label">Attributes</label>
                            <div class="col-sm-10">
                                <input name="attribute" id="attribute" value="<?= $menu_details['attribute'] ?>" class="form-control" type="text">
                            </div>
                        </div>
                    </div>                
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <?php if ($this->rbac->has_permission('MANAGE_MENU', 'DELETE')) : ?>
                    <input name="menu_id" id="menu_id" value="<?= $menu_details['id'] ?>" class="form-control" type="hidden">                
                    <button type="button" class="btn btn-sm float-right btn-primary" id="save_menu_detail">Save</button>
                <?php endif; ?>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#permission').select2({
            theme: 'bootstrap4',
            allowClear: true,
            placeholder: {
                id: "", // the value of the option
                text: 'Select Permission'
            }
        });
        $('#menu_type').select2({
            theme: 'bootstrap4',
            allowClear: true,
            minimumResultsForSearch: 'Infinity',
            placeholder: {
                id: "", // the value of the option
                text: 'Select Menu Type'
            }
        });
        
    });
</script>