<div class="row">
    <div class="col-md-9">
        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <div class="row">
                    <div class="col-sm-12">
                        <?php
                            $profile_pic=(isset($data['profile_pic']) && $data['profile_pic']!='' && $data['profile_pic']!=null)?'/uploads/employee/profile_picture/'.$data['profile_pic']:'images/user-icon.png';
                        ?>
                        <img title="Click to update profile picture" class="profile-user-img img-responsive img-circle" src="<?= base_url($profile_pic); ?>" alt="User profile picture"/>
                        <h3 class="profile-username text-center">
                            <?php
                            echo (isset($data["first_name"])) ? ucfirst($data["first_name"]) : "";
                            echo (isset($data["last_name"])) ? ' ' . ucfirst($data["last_name"]) : ""
                            ?>
                        </h3>                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Email: </b>                                 
                                <a href="#" id="verify_email" class="label bg-red pull-right marginL10 todo_dev">Verify</a>
                                <a class="pull-right"><?php echo (isset($data["email"])) ? $data["email"] : "" ?></a>                                
                            </li>
                            <li class="list-group-item">
                                <b>Mobile:</b> 
                                <a href="#" id="verify_mobile" class="label bg-red pull-right marginL10 todo_dev">Verify</a>
                                <a class="pull-right"><?php echo (isset($data["mobile"])) ? $data["mobile"] : "" ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Roles:</b> <a class="pull-right">
                                    <?php
                                    if (isset($data["employee_roles"])) {
                                        $role_codes = $this->rbac->get_role_codes();
                                        $sorted = $this->rbac->sort_user_roles($role_codes);
                                        $loop = 0;
                                        foreach ($sorted as $role_code) {
                                            if ($loop > 0) {
                                                echo ", " . ucfirst($this->rbac->get_role_desc($role_code));
                                            } else {
                                                echo ucfirst($this->rbac->get_role_desc($role_code));
                                            }
                                            $loop++;
                                        }
                                    }
                                    ?>

                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>Active Since: </b> <a class="pull-right"><?php echo (isset($data["created"])) ? date_format(date_create($data["created"]), 'd-m-Y') : "" ?></a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>    
    <div class="col-sm-3">
        <a class="btn btn-block btn-social btn-twitter" href="#" id="upload_profile_image">
            <i class="fa fa-file-image-o fa-sm"></i> Upload profile picture
        </a>
        <a class="btn btn-block btn-social btn-google" href="#" id="change_my_pass">
            <i class="fa fa-key fa-sm"></i> Change Password
        </a>  
    </div>
</div>
<div class="modal fade" id="change_my_pass_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php
            $form_attribute = array(
                "name" => "change_my_pass_form",
                "id" => "change_my_pass_form",
                "method" => "POST"
            );
            $form_action = base_url('change-employee-password');
            echo form_open($form_action, $form_attribute);
            ?>
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Password details</h4>
            </div>
            <div class="modal-body">
                <div class = 'form-group row'>
                    <label for = 'password' class = 'col-sm-4 col-form-label ele_required'>Current password</label>
                    <div class = 'col-sm-5'>
                        <?php
                        $attribute = array(
                            "name" => "password",
                            "id" => "password",
                            "class" => "form-control",
                            "title" => "",
                            "required" => "",
                            "type" => "password",
                            "value" => ""
                        );
                        echo form_error("password");
                        echo form_input($attribute);
                        ?>
                        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>                        
                    </div>                    
                </div>                
                <div class = 'form-group row'>

                    <label for = 'npassword' class = 'col-sm-4 col-form-label ele_required'>New password</label>
                    <div class = 'col-sm-5'>
                        <?php
                        $attribute = array(
                            "name" => "npassword",
                            "id" => "npassword",
                            "class" => "form-control inputPassword",
                            "title" => "",
                            "required" => "",
                            "type" => "password",
                            "value" => ""
                        );
                        echo form_error("npassword");
                        echo form_input($attribute);
                        ?>
                        <span toggle="#npassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        <span class="form-control default complexity"></span>
                    </div>
                </div>
                <div class = 'form-group row'>
                    <label for = 'cpassword' class = 'col-sm-4 col-form-label ele_required'>Confirm password</label>
                    <div class = 'col-sm-5'>
                        <?php
                        $attribute = array(
                            "name" => "cpassword",
                            "id" => "cpassword",
                            "class" => "form-control",
                            "title" => "",
                            "required" => "",
                            "type" => "password",
                            "value" => ""
                        );
                        echo form_error("cpassword");
                        echo form_input($attribute);
                        ?>
                        <span toggle="#cpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="update_password">Save</button>
                <button data-dismiss="modal" class="btn btn-danger" id="default_modal_box_btn_cancel" type="button">Cancel</button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="upload_photo_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php
            $form_attribute = array(
                "name" => "upload_image_form",
                "id" => "upload_image_form",
                "method" => "POST"
            );
            $form_action = base_url('upload-employee-photo');
            echo form_open($form_action, $form_attribute);
            ?>
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Upload Profile Picture</h4>
            </div>
            <div class="modal-body">
                <div class = 'form-group row'>
                    <label for = 'password' class = 'col-sm-5 col-form-label ele_required'>Select PNG/JPG/JPEG file</label>
                    <div class = 'col-sm-7'>
                        <span class="control-fileupload"> 
                            <label for="file">Choose file</label>
                            <input type="file" id="profile_image" name="profile_image">
                        </span>                       
                    </div>                    
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="save_upload_image">Upload</button>
                <button data-dismiss="modal" class="btn btn-danger" id="default_modal_box_btn_cancel" type="button">Cancel</button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '#change_my_pass', function (e) {
            e.preventDefault();
            $('.complexity').css('display', 'none');
            $('#password').val('');
            $('#npassword').val('');
            $('#cpassword').val('');

            $('#loading').css('display', 'block');
            $('#change_my_pass_modal').modal({backdrop: 'static', keyboard: false});
        });

        $('#change_my_pass_form').validate({
            rules: {
                password: "required",
                npassword: "required",
                cpassword: {
                    equalTo: '#npassword'
                }
            },
            messages: {
                password: 'Current password is required',
                npassword: 'New password is required',
                cpassword: {
                    equalTo: 'New password and Confirm password does not match'
                }
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.insertAfter(element.closest("div").find("span:last"));
            },
            submitHandler: function (form) {
                if ($(form).valid())
                    form.submit();
                return false; // prevent normal form posting
            }
        });

        $(document).on('click', '#update_password', function (e) {
            $('#loading').css('display', 'block');
            if ($('#change_my_pass_form').valid()) {
                const user_promise = new Promise(function (resolve, reject) {
                    var form_data = {
                        "password": $('#password').val()
                    };

                    $.ajax({
                        url: "<?= base_url('validate-my-password') ?>",
                        type: 'POST',
                        dataType: 'json',
                        data: form_data,
                        success: function (result) {
                            resolve(result);
                        },
                        error: function (result) {
                            reject(result);
                        }
                    });
                });
                user_promise.then(function (resolve) {
                    $('#loading').css('display', 'none');
                    if (parseInt(resolve.match) === 1) {

                        const user_match_promise = new Promise(function (resolve, reject) {
                            var form_data = {
                                "password": $('#password').val(),
                                "npassword": $('#npassword').val()
                            };
                            $('#loading').css('display', 'block');
                            $.ajax({
                                url: "<?= base_url('update-my-password') ?>",
                                type: 'POST',
                                dataType: 'json',
                                data: form_data,
                                success: function (result) {
                                    resolve(result);
                                },
                                error: function (result) {
                                    reject(result);
                                }
                            });
                        });
                        user_match_promise.then(function (resolve) {
                            $('#loading').css('display', 'none');
                            $('#change_my_pass_modal').modal('hide');
                            show_message(resolve);
                        }, function (reject) {
                            $('#loading').css('display', 'none');
                            show_message(reject);
                        });

                    } else {
                        console.log('resolve', resolve);
                        var errorLabel = $('#password').parent('div');
                        $(errorLabel).append('<div class="error">Password does not match!</div>');
                        //$('#password').closest("div").appendTo('<div id="password-error" class="error">Current password is required</div>');

                    }

                }, function (reject) {
                    $('#loading').css('display', 'none');
                    show_message(reject);
                });
            }
            return false;
        });
        $('input[type=file]').change(function () {
            var t = $(this).val();
            var labelText = t.substr(12, t.length);
            $(this).prev('label').text(labelText);
        })
        $.validator.addMethod('filesize', function (value, element, param) {
            //file size in kb            
            var size_in_kb = element.files[0].size / 1024;
            return this.optional(element) || (size_in_kb <= param)
        }, 'File size must be less than {0}');

        $('#upload_image_form').validate({
            rules: {
                profile_image: {
                    required: true,
                    extension: "png|jpg|jpeg|pdf|xlsx|xls",
                    filesize: 5120 //5mb
                }
            },
            messages: {
                profile_image: {
                    required: 'Select image to upload',
                    extension: 'Select a valid image to upload',
                    filesize: 'File size should be within 5MB'
                }
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.insertAfter(element.closest("div").find("span:last"));
            },
            submitHandler: function (form) {
                return false; // prevent normal form posting
            }
        });

        $(document).on('click', '#upload_profile_image', function (e) {
            $("#profile_image").val('');
            $("#profile_image-error").remove();
            $('.control-fileupload').find('label:first').html("Choose file");
            $('#upload_photo_modal').modal({backdrop: 'static', keyboard: false});
        });
        $(document).on('click', '#save_upload_image', function (e) {
            if ($('#upload_image_form').valid()) {
                var form_data = new FormData();
                var files = $('#profile_image')[0].files[0];
                form_data.append('profile_image', files);
                console.log('profile_image', $('#profile_image')[0]);
                const file_upload_promise = new Promise(function (resolve, reject) {


                    $('#loading').css('display', 'block');
                    $.ajax({
                        url: "<?= base_url('update-my-profile-pic') ?>",
                        type: 'POST',
                        dataType: 'json',
                        data: form_data,
                        processData: false,
                        contentType: false,
                        success: function (result) {
                            resolve(result);
                        },
                        error: function (result) {
                            reject(result);
                        }
                    });
                });
                file_upload_promise.then(function (resolve) {
                    $('#loading').css('display', 'none');
                    BootstrapDialog.show({
                        title: resolve.title,
                        message: resolve.message,
                        buttons: [{
                                label: 'Ok',
                                action: function (dialog) {
                                    dialog.close();
                                    location.reload();
                                }
                            }]
                    });
                }, function (reject) {
                    $('#loading').css('display', 'none');
                    show_message(reject);
                });
            }
        });
        $('.profile-user-img').on('click',function(){
            $('#upload_profile_image').trigger('click');
        });
        function show_message(reject) {
            var errMsg = {
                'type': 'default',
                title: (typeof reject.title != 'undefined' && reject.title != '') ? reject.title : 'My Profile',
                message: (reject.message != '') ? reject.message : 'There are some error, please try again!'
            }
            myApp.modal.alert(errMsg);
        }
    });
</script>