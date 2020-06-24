<?php ?>
<form id="save_details_form" name="save_details_form" method="post">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Menu Details</h3>
        </div>
        <div class="box-body">
            <div class="row-fluid">
                <div class="col-sm-6 no_lpad">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Order</label>
                        <div class="col-sm-8">
                            <input name="node_position" id="node_position" value="<?= $menu_details['menu_order'] ?>" class="form-control" type="text">                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 no_lpad">

                </div> 
            </div> 
            <div class="row-fluid">
                <div class="col-sm-6 no_lpad">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Menu Name</label>
                        <div class="col-sm-8">
                            <input name="menu_name" id="menu_name" value="<?= $menu_details['text'] ?>" class="form-control" type="text">                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 no_lpad">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Menu type</label>
                        <div class="col-sm-8">
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
            </div>  
            <div class="row-fluid">
                <div class="col-sm-6 no_lpad">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Permission</label>
                        <div class="col-sm-8">
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
                <div class="col-sm-6 no_lpad">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">URL</label>
                        <div class="col-sm-8">
                            <input name="url" id="url" value="<?= $menu_details['url'] ?>" class="form-control" type="text">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">  
                <div class="col-sm-6 no_lpad">                
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Icon Class</label>
                        <div class="col-sm-8">
                            <input name="icon_class" id="icon_class" value="<?= $menu_details['icon_class'] ?>" class="form-control" type="text">
                        </div>
                    </div>                 
                </div>
                <div class="col-sm-6 no_lpad">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Menu Class</label>
                        <div class="col-sm-8">
                            <input name="menu_class" id="menu_class" value="<?= $menu_details['menu_class'] ?>" class="form-control" type="text">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="col-sm-12 no_lpad">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Attributes</label>
                        <div class="col-sm-10">
                            <input name="attribute" id="attribute" value="<?= $menu_details['attribute'] ?>" class="form-control" type="text">
                        </div>
                    </div>
                </div>            
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="pull-right">
                <?php if ($this->rbac->has_permission('MANAGE_MENU', 'DELETE')) : ?>
                    <input name="menu_id" id="menu_id" value="<?= $menu_details['id'] ?>" class="form-control" type="hidden">                
                    <button type="button" class="btn btn-primary" id="save_menu_detail">Save</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</form>
