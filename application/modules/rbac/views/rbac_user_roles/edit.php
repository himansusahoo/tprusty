<div class="col-sm-12">
 <?php $form_attribute = array(
                "name" => "rbac_user_roles",
                "id" => "rbac_user_roles",
                "method" => "POST"
            );
$form_action= "/rbac/rbac_user_roles/edit";
 echo form_open($form_action, $form_attribute); ?>
<?php $attribute=array(
                "name" =>"user_role_id",
                "id" => "user_role_id",
                "class" => "form-control",
                "title" => "",
"required"=>"", 
"type"=>"hidden", 
"value" => (isset($data["user_role_id"]))?$data["user_role_id"]:""
); 
echo form_error("user_role_id"); echo form_input($attribute); ?><div class = 'form-group row'>
                                <label for = 'user_id' class = 'col-sm-2 col-form-label'>User id</label>
                                <div class = 'col-sm-3'>
                                    <?php $attribute=array(
                                    "name" =>"user_id",
                                    "id" => "user_id",
                                    "class" => "form-control",
                                    "title" => "",
                                    "required"=>"", 
); $user_id=(isset($data['user_id']))?$data['user_id']:'';echo form_error("user_id");echo form_dropdown($attribute, $user_id_list, $user_id); ?>
                                </div>
                           </div>
<div class = 'form-group row'>
                                <label for = 'role_id' class = 'col-sm-2 col-form-label'>Role id</label>
                                <div class = 'col-sm-3'>
                                    <?php $attribute=array(
                                    "name" =>"role_id",
                                    "id" => "role_id",
                                    "class" => "form-control",
                                    "title" => "",
                                    "required"=>"", 
); $role_id=(isset($data['role_id']))?$data['role_id']:'';echo form_error("role_id");echo form_dropdown($attribute, $role_id_list, $role_id); ?>
                                </div>
                           </div>

<div class = 'form-group row'>
<div class = 'col-sm-1'>
<a class="text-right btn btn-default" href="<?php echo APP_BASE?>rbac/rbac_user_roles/index">
<span class="glyphicon glyphicon-th-list"></span> Cancel
</a>
</div>
<div class = 'col-sm-1'>
<input type="submit" id="submit" value="Update" class="btn btn-primary">
</div>
</div>
    <?php echo form_close() ?>
</div>