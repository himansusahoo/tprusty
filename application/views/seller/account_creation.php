<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <meta name="author" content="">
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>css/admin/styles.css">
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>css/admin/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/admin/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

        <!--  JS for Google reCaptach start here -->
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <!--  JS for Google reCaptach End here -->

    </head>

    <body>

        <div class="signup_outer">
            <div class="signup_inner">
                <h3 class="a-center">Account Creation</h3>
                <hr>
                <?php if (validation_errors()) : ?>
                    <h4 class="validation_error a-center"><?php echo validation_errors(); ?></h4>
                    <?php
                endif;
                $attributes = array('name' => 'register_form');
                echo form_open('seller/seller/seller_signup', $attributes);
                ?>	
                <!--<form>-->
                <table>
                    <tr>
                        <td width="40%" class="seller_label"> Your name : </td>
                        <td width="50%"><input type="text" class="seller_input" name="name" value=""></td>
                    </tr>
                    <tr>
                        <td class="seller_label"> Your e-mail address : </td>
                        <td><input type="text" class="seller_input readonly_field" name="email" value="<?php echo $email; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="hidden" class="seller_input" name="mobile" value="<?php echo $mobile; ?>"></td>
                    </tr>
                    <tr>
                        <td class="seller_label"> Your city pincode : </td>
                        <td><input type="text" class="seller_input" name="pincode" value=""></td>
                    </tr>
                    <tr>
                        <td class="seller_label"> Address : </td>
                        <td><textarea name="address" class="textarea" rows="5" cols="32"></textarea></td>
                    </tr>
                    <tr>
                        <td class="seller_label"> City : </td>
                        <td><input type="text" class="seller_input" name="city" value=""></td>
                    </tr>
                    <tr>
                        <td class="seller_label"> State : </td>
                        <td>
                            <select class="seller_input" name="state">
                                <option value="">-- Select State --</option>
                                <?php
                                $query = $this->db->query("select * from state");
                                $rows = $query->num_rows();
                                if ($rows > 0) {
                                    foreach ($query->result() as $rs) {
                                        ?>
                                        <option value="<?= $rs->state ?>"><?= $rs->state ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="seller_label"> Create password : </td>
                        <td><input type="password" class="seller_input" name="pwd" value=""></td>
                    </tr>
                    <tr>
                        <td class="seller_label"> Retype your password : </td>
                        <td><input type="password" class="seller_input" name="cnfpwd" value=""></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div class="g-recaptcha" data-sitekey="6LcR4w8TAAAAADUpAdk9LdyrIVZCdSXCLXMXEZcr"></div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" class="seller_buttons" name="submit" value="Signup">
                        </td>
                    </tr>
                </table>
                </form>
            </div>
        </div>  <!-- @end #main-content -->
        <!--</div><!-- @end #content -->
        <!--</div><!-- @end #w -->
    </body>
</html>