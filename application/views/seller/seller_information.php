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
    </head>

    <body>
        <!--<div id="w">
                <ul id="sidemenu">
                        <li> <a href="#" class="open"><i class="icon-home icon-large"></i><span> Dashboard </span></a></li>
                        <li> <a href="add_product.php"><i class="icon-lightbulb icon-large"></i><span> Catalog </span></a></li>
                        <li> <a href="active_orders.php"><i class="icon-envelope icon-large"></i><span> Orders </span></a></li>
                        <li> <a href="returns.php"><i class="icon-home icon-large"></i><span> Returns </span></a></li>
                        <li> <a href="settlements.php"><i class="icon-info-sign icon-large"></i><span> Payments </span></a></li>
                        <!--<li> <a href="#"><i class="icon-lightbulb icon-large"></i><span> Metrics </span></a></li>
                        <li> <a href="my_promotions.php"><i class="icon-home icon-large"></i><span> Promotions </span></a></li>-->
                        <!--<li> <a href="my_profile.php"><i class="icon-info-sign icon-large"></i><span> Account </span></a></li>
                </ul>
                <div id="content">    
                        <div class="top-bar">
                                <div class="top-right">
                                        <ul>
                                                <li> Welcome Admin </li>
                                                <li><a href="#"> Login </a></li> 
                                                <li><a href="#"> Logout </a></li> 
                                        </ul>
                                </div>
                        </div>  <!-- @end top-bar  -->
        <!--<div class="main-content">
                <div class="row ac_create_form">-->
        <div class="signup_outer">
            <div class="signup_inner">
                <h3 class="a-center">Seller Information</h3>
                <hr>
                <div class="form_content">
                    <?php if (validation_errors()) { ?>
                        <h4 class="validation_error a-center"><?php echo validation_errors(); ?></h4>
                        <?php
                    }
                    $attributes = array('name' => 'seller_information_form');
                    echo form_open_multipart('seller/seller/add_seller_information', $attributes);
                    ?>
                    <!--<form>-->
                    <table>
                        <tr>
                            <th class="seller_label" colspan="2">Personal Details</th>
                        </tr>
                        <tr>
                            <td class="seller_label" width="40%">Name<sup>*</sup> :</td>
                            <td width="60%"><input type="text" class="seller_input readonly_field" name="pname" value="<?php echo $result[0]->name; ?>" readonly></td>
                        </tr>
                        <tr>
                            <td class="seller_label">Email :</td>
                            <td><input type="text" class="seller_input readonly_field" name="pemail" value="<?php echo $result[0]->email; ?>" readonly></td>
                        </tr>
                        <tr>
                            <td class="seller_label">Mobile :</td>
                            <td><input type="text" class="seller_input readonly_field" name="pmobile" value="<?php echo $result[0]->mobile; ?>" readonly></td>
                        </tr>
                    </table>
                    <hr>
                    <table>
                        <tr>
                            <th class="seller_label" colspan="2">Business Details</th>
                        </tr>
                        <tr>
                            <td class="seller_label" width="40%">Business Name<sup>*</sup> :</td>
                            <td width="60%"><input type="text" class="seller_input" name="bname"> <span class="req_bname">This is a required field</span><!--Business name should be same as that of your TIN--></td>
                        </tr>
                        <tr>
                            <td class="seller_label">Business Description :</td>
                            <td>
                                <textarea name="business_desc" rows="5"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="seller_label">PAN ID<sup>*</sup> :</td>
                            <td><input type="text" class="seller_input" name="pan"> <span class="req_pan">This is a required field</span></td>
                        </tr>
                        <tr>
                            <td class="seller_label">PAN Document<sup>*</sup> :</td>
                            <td><input type="file" name="pan_img" id="pan_img" class="seller_input"> <span class="req_pan_img">This is a required field</span></td>
                        </tr>
                        <tr>
                            <td class="seller_label">TIN<sup>*</sup> :</td>
                            <td><input type="text" class="seller_input" name="tin"> <span class="req_tin">This is a required field</span><br>
                                <!--<a href="#">Continue without TIN</a>-->
                            </td>
                        </tr>
                        <tr>
                            <td class="seller_label">TIN Proof<sup>*</sup> :</td>
                            <td><input type="file" name="tin_img" id="tin_img" class="seller_input"> <span class="req_tin_img">This is a required field</span></td>
                        </tr>
                        <tr>
                            <td class="seller_label">TAN ID :</td>
                            <td><input type="text" class="seller_input" name="tan"><br>
                                <!--<a href="#">Continue without TAN</a>-->
                            </td>
                        </tr>
                        <tr>
                            <td class="seller_label">TAN Document :</td>
                            <td><input type="file" name="tan_img" id="tan_img" class="seller_input"> <span class="req_tan_img">This is a required field</span></td>
                        </tr>



                        <!-----------------------------------sujit start gstin5fts------------------------------------------->
                        <tr>
                            <td class="seller_label">GSTIN ID :</td>
                            <td><input type="text" class="seller_input" name="gstin"><br>
                                <!--<a href="#">Continue without TAN</a>-->
                            </td>
                        </tr>
                        <tr>
                            <td class="seller_label">GSTIN Document :</td>
                            <td><input type="file" name="gstin_img" id="gstin_img" class="seller_input"> <span class="req_gstin_img">This is a required field</span></td>
                        </tr>
                        <!-----------------------------------sujit end------------------------------------------------------->  




                    </table>
                    <hr>
                    <table>
                        <tr>
                            <th class="seller_label" colspan="2">Bank Details</th>
                        </tr>
                        <tr>
                            <td class="seller_label" width="40%">Account Holder Name<sup>*</sup> :</td>
                            <td width="60%"><input type="text" class="seller_input" name="ac_holder_name"> <span class="req_ac_name">This is a required field</span></td>
                        </tr>
                        <tr>
                            <td class="seller_label">Bank account number<sup>*</sup> :</td>
                            <td><input type="text" class="seller_input" name="ac_number"> <span class="req_ac_number">This is a required field</span></td>
                        </tr>
                        <tr>
                            <td class="seller_label">Retype account number<sup>*</sup> :</td>
                            <td><input type="text" class="seller_input" name="cnf_ac_number"> <span class="req_cnf_ac_number">This is a required field</span></td>
                        </tr>
                        <tr>
                            <td class="seller_label">IFSC code<sup>*</sup> :</td>
                            <td><input type="text" class="seller_input" name="ifsc"> <span class="req_ifsc">This is a required field</span><br>
                                <!--<a href="#">I don't remember IFSC code</a>--></td>
                        </tr>
                        <tr>
                            <td class="seller_label">Bank :</td>	
                            <td><input type="text" class="seller_input" name="bank"></td>
                        </tr>
                        <tr>
                            <td class="seller_label">State :</td>	
                            <td><input type="text" class="seller_input" name="state"></td>
                        </tr>
                        <tr>
                            <td class="seller_label">City :</td>	
                            <td><input type="text" class="seller_input" name="city"></td>
                        </tr>
                        <tr>
                            <td class="seller_label">Branch :</td>	
                            <td><input type="text" class="seller_input" name="branch"></td>
                        </tr>
                    </table>
                    <hr>
                    <table>
                        <tr>
                            <th class="seller_label" colspan="2">KYC Details</th>
                        </tr>
                        <tr>
                            <td class="seller_label" width="40%">Upload Address Proof<sup>*</sup> :</td>
                            <td width="60%"><input type="file" name="address_img" id="address_img" class="seller_input" > <span class="req_address_img">This is a required field</span></td>
                        </tr>
                        <tr>
                            <td class="seller_label">Upload ID Proof<sup>*</sup> :</td>
                            <td><input type="file" name="ID_img" id="ID_img" class="seller_input"> <span class="req_ID_img">This is a required field</span></td>
                        </tr>
                        <tr>
                            <td class="seller_label">Upload Cancelled Cheque<sup>*</sup> :</td>
                            <td><input type="file" name="Cheque_img" id="Cheque_img" class="seller_input"> <span class="req_Cheque_img">This is a required field</span></td>
                        </tr>
                    </table>
                    <hr>
                    <table>
                        <tr>
                            <th class="seller_label" colspan="2">Store Details</th>
                        </tr>
                        <tr>
                            <td class="seller_label" width="40%"> Display name<sup>*</sup> :</td>	
                            <td width="60%"><input type="text" class="seller_input" name="display_name"> <span class="req_display_name">This is a required field</span></td>
                        </tr>
                        <tr>
                            <td class="seller_label">Store Description<sup>*</sup> :</td>
                            <td>
                                <textarea name="store_desc" rows="5"></textarea> <span class="req_store_desc">This is a required field</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" class="seller_buttons a-center" name="save" value="Save & Continue" onClick="return valid()">
                                <!--<input type="submit" class="seller_buttons" name="save_continue" value="Save and Continue">-->
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        <!--</div>
</div>-->
    </body>


    <script>
        function valid() {
            var re = /(\.jpg|\.jpeg|\.png)$/i;

            var bname = $(".form_content input[name='bname']").val();
            var pan = $(".form_content input[name='pan']").val();
            var pan_img = $(".form_content input[name='pan_img']").val();
            var tin = $(".form_content input[name='tin']").val();
            var tin_img = $(".form_content input[name='tin_img']").val();
            var ac_holder_name = $(".form_content input[name='ac_holder_name']").val();
            var ac_number = $(".form_content input[name='ac_number']").val();
            var cnf_ac_number = $(".form_content input[name='cnf_ac_number']").val();
            var ifsc = $(".form_content input[name='ifsc']").val();
            var display_name = $(".form_content input[name='display_name']").val();
            var store_desc = $(".form_content textarea[name='store_desc']").val();
            var tan = $(".form_content input[name='tan']").val();
            var tan_img = $(".form_content input[name='tan_img']").val();
            var address_img = $(".form_content input[name='address_img']").val();
            var ID_img = $(".form_content input[name='ID_img']").val();
            var Cheque_img = $(".form_content input[name='Cheque_img']").val();

            //var allowedExtension = ['jpeg', 'jpg'];
            //var pan_img_fileExtn = pan_img.substr(pan_img.lastIndexOf('.') + 1);
            //var tin_img_fileExtn = tin_img.substr(tin_img.lastIndexOf('.') + 1);
            //var tan_img_fileExtn = tan_img.substr(tan_img.lastIndexOf('.') + 1);
            //var isValidFile = false;

            /*for(var index in allowedExtension) {
             if(fileExtension === allowedExtension[index]) {
             isValidFile = true; 
             break;
             }
             }*/




            if (bname == "") {
                $('.req_bname').show();
                $(".form_content input[name='bname']").focus().css('border-color', 'red');
                return false;
            } else if (pan == "") {
                $('.req_bname').hide();
                $(".form_content input[name='bname']").css('border-color', '#ccc');

                $('.req_pan').show();
                $(".form_content input[name='pan']").focus().css('border-color', 'red');
                return false;
            } else if (pan_img == "") {
                $('.req_bname').hide();
                $(".form_content input[name='bname']").css('border-color', '#ccc');
                $('.req_pan').hide();
                $(".form_content input[name='pan']").css('border-color', '#ccc');

                $('.req_pan_img').show();
                $(".form_content input[name='pan_img']").css('border-color', 'red');
                return false;
            } else if (!re.exec(pan_img)) {
                $('.req_bname').hide();
                $(".form_content input[name='bname']").css('border-color', '#ccc');
                $('.req_pan').hide();
                $(".form_content input[name='pan']").css('border-color', '#ccc');

                $('.req_pan_img').show().text("*.jpg, *.jpeg, *.png Extensions are allowed.");
                $(".form_content input[name='pan_img']").val("");
                $(".form_content input[name='pan_img']").css('border-color', 'red');
                return false;
            } else if (tin == "") {
                $('.req_bname').hide();
                $(".form_content input[name='bname']").css('border-color', '#ccc');
                $('.req_pan').hide();
                $(".form_content input[name='pan']").css('border-color', '#ccc');
                $('.req_pan_img').hide();
                $(".form_content input[name='pan_img']").css('border-color', '#ccc');

                $('.req_tin').show();
                $(".form_content input[name='tin']").focus().css('border-color', 'red');
                return false;
            } else if (tin_img == "") {
                $('.req_bname').hide();
                $(".form_content input[name='bname']").css('border-color', '#ccc');
                $('.req_pan').hide();
                $(".form_content input[name='pan']").css('border-color', '#ccc');
                $('.req_pan_img').hide();
                $(".form_content input[name='pan_img']").css('border-color', '#ccc');
                $('.req_tin').hide();
                $(".form_content input[name='tin']").css('border-color', '#ccc');

                $('.req_tin_img').show();
                $(".form_content input[name='tin_img']").css('border-color', 'red');
                return false;
            } else if (!re.exec(tin_img)) {
                $('.req_bname').hide();
                $(".form_content input[name='bname']").css('border-color', '#ccc');
                $('.req_pan').hide();
                $(".form_content input[name='pan']").css('border-color', '#ccc');
                $('.req_pan_img').hide();
                $(".form_content input[name='pan_img']").css('border-color', '#ccc');
                $('.req_tin').hide();
                $(".form_content input[name='tin']").css('border-color', '#ccc');

                $('.req_tin_img').show().text("*.jpg, *.jpeg, *.png Extensions are allowed.");
                $(".form_content input[name='tin_img']").val("");
                $(".form_content input[name='tin_img']").css('border-color', 'red');
                return false;
            } else if (tan != "" && tan_img == "") {
                $('.req_bname').hide();
                $(".form_content input[name='bname']").css('border-color', '#ccc');
                $('.req_pan').hide();
                $(".form_content input[name='pan']").css('border-color', '#ccc');
                $('.req_pan_img').hide();
                $(".form_content input[name='pan_img']").css('border-color', '#ccc');
                $('.req_tin').hide();
                $(".form_content input[name='tin']").css('border-color', '#ccc');
                $('.req_tin_img').hide();
                $(".form_content input[name='tin_img']").css('border-color', '#ccc');

                $('.req_tan_img').show();
                $(".form_content input[name='tan_img']").css('border-color', 'red');
                return false;
            } else if (tan != "" && !re.exec(tan_img)) {
                $('.req_bname').hide();
                $(".form_content input[name='bname']").css('border-color', '#ccc');
                $('.req_pan').hide();
                $(".form_content input[name='pan']").css('border-color', '#ccc');
                $('.req_pan_img').hide();
                $(".form_content input[name='pan_img']").css('border-color', '#ccc');
                $('.req_tin').hide();
                $(".form_content input[name='tin']").css('border-color', '#ccc');
                $('.req_tin_img').hide();
                $(".form_content input[name='tin_img']").css('border-color', '#ccc');

                $('.req_tan_img').show().text("*.jpg, *.jpeg, *.png Extensions are allowed.");
                $(".form_content input[name='tan_img']").val("");
                $(".form_content input[name='tan_img']").css('border-color', 'red');
                return false;
            } else if (ac_holder_name == "") {
                $('.req_bname').hide();
                $(".form_content input[name='bname']").css('border-color', '#ccc');
                $('.req_pan').hide();
                $(".form_content input[name='pan']").css('border-color', '#ccc');
                $('.req_pan_img').hide();
                $(".form_content input[name='pan_img']").css('border-color', '#ccc');
                $('.req_tin').hide();
                $(".form_content input[name='tin']").css('border-color', '#ccc');
                $('.req_tin_img').hide();
                $(".form_content input[name='tin_img']").css('border-color', '#ccc');
                $('.req_tan_img').hide();
                $(".form_content input[name='tan_img']").css('border-color', '#ccc');

                $('.req_ac_name').show();
                $(".form_content input[name='ac_holder_name']").focus().css('border-color', 'red');
                return false;
            } else if (ac_number == "") {
                $('.req_bname').hide();
                $(".form_content input[name='bname']").css('border-color', '#ccc');
                $('.req_pan').hide();
                $(".form_content input[name='pan']").css('border-color', '#ccc');
                $('.req_pan_img').hide();
                $(".form_content input[name='pan_img']").css('border-color', '#ccc');
                $('.req_tin').hide();
                $(".form_content input[name='tin']").css('border-color', '#ccc');
                $('.req_tin_img').hide();
                $(".form_content input[name='tin_img']").css('border-color', '#ccc');
                $('.req_tan_img').hide();
                $(".form_content input[name='tan_img']").css('border-color', '#ccc');
                $('.req_ac_name').hide();
                $(".form_content input[name='ac_holder_name']").css('border-color', '#ccc');

                $('.req_ac_number').show();
                $(".form_content input[name='ac_number']").focus().css('border-color', 'red');
                return false;
            } else if (isNaN(ac_number)) {
                $('.req_bname').hide();
                $(".form_content input[name='bname']").css('border-color', '#ccc');
                $('.req_pan').hide();
                $(".form_content input[name='pan']").css('border-color', '#ccc');
                $('.req_pan_img').hide();
                $(".form_content input[name='pan_img']").css('border-color', '#ccc');
                $('.req_tin').hide();
                $(".form_content input[name='tin']").css('border-color', '#ccc');
                $('.req_tin_img').hide();
                $(".form_content input[name='tin_img']").css('border-color', '#ccc');
                $('.req_tan_img').hide();
                $(".form_content input[name='tan_img']").css('border-color', '#ccc');
                $('.req_ac_name').hide();
                $(".form_content input[name='ac_holder_name']").css('border-color', '#ccc');

                $('.req_ac_number').show().text('This field should be numeric.');
                $(".form_content input[name='ac_number']").select().css('border-color', 'red');
                return false;
            } else if (cnf_ac_number == "") {
                $('.req_bname').hide();
                $(".form_content input[name='bname']").css('border-color', '#ccc');
                $('.req_pan').hide();
                $(".form_content input[name='pan']").css('border-color', '#ccc');
                $('.req_pan_img').hide();
                $(".form_content input[name='pan_img']").css('border-color', '#ccc');
                $('.req_tin').hide();
                $(".form_content input[name='tin']").css('border-color', '#ccc');
                $('.req_tin_img').hide();
                $(".form_content input[name='tin_img']").css('border-color', '#ccc');
                $('.req_tan_img').hide();
                $(".form_content input[name='tan_img']").css('border-color', '#ccc');
                $('.req_ac_name').hide();
                $(".form_content input[name='ac_holder_name']").css('border-color', '#ccc');
                $('.req_ac_number').hide();
                $(".form_content input[name='ac_number']").css('border-color', '#ccc');

                $('.req_cnf_ac_number').show();
                $(".form_content input[name='cnf_ac_number']").focus().css('border-color', 'red');
                return false;
            } else if (isNaN(cnf_ac_number)) {
                $('.req_bname').hide();
                $(".form_content input[name='bname']").css('border-color', '#ccc');
                $('.req_pan').hide();
                $(".form_content input[name='pan']").css('border-color', '#ccc');
                $('.req_pan_img').hide();
                $(".form_content input[name='pan_img']").css('border-color', '#ccc');
                $('.req_tin').hide();
                $(".form_content input[name='tin']").css('border-color', '#ccc');
                $('.req_tin_img').hide();
                $(".form_content input[name='tin_img']").css('border-color', '#ccc');
                $('.req_tan_img').hide();
                $(".form_content input[name='tan_img']").css('border-color', '#ccc');
                $('.req_ac_name').hide();
                $(".form_content input[name='ac_holder_name']").css('border-color', '#ccc');
                $('.req_ac_number').hide();
                $(".form_content input[name='ac_number']").css('border-color', '#ccc');

                $('.req_cnf_ac_number').show().text('This field should be numeric.');
                $(".form_content input[name='cnf_ac_number']").select().css('border-color', 'red');
                return false;
            } else if (ac_number !== cnf_ac_number) {
                $('.req_bname').hide();
                $(".form_content input[name='bname']").css('border-color', '#ccc');
                $('.req_pan').hide();
                $(".form_content input[name='pan']").css('border-color', '#ccc');
                $('.req_pan_img').hide();
                $(".form_content input[name='pan_img']").css('border-color', '#ccc');
                $('.req_tin').hide();
                $(".form_content input[name='tin']").css('border-color', '#ccc');
                $('.req_tin_img').hide();
                $(".form_content input[name='tin_img']").css('border-color', '#ccc');
                $('.req_tan_img').hide();
                $(".form_content input[name='tan_img']").css('border-color', '#ccc');
                $('.req_ac_name').hide();
                $(".form_content input[name='ac_holder_name']").css('border-color', '#ccc');
                $('.req_ac_number').hide();
                $(".form_content input[name='ac_number']").css('border-color', '#ccc');

                $('.req_cnf_ac_number').show().text('a/c number should match with confirm a/c number.');
                $(".form_content input[name='cnf_ac_number']").focus().css('border-color', 'red');
                return false;
            } else if (ifsc == "") {
                $('.req_bname').hide();
                $(".form_content input[name='bname']").css('border-color', '#ccc');
                $('.req_pan').hide();
                $(".form_content input[name='pan']").css('border-color', '#ccc');
                $('.req_pan_img').hide();
                $(".form_content input[name='pan_img']").css('border-color', '#ccc');
                $('.req_tin').hide();
                $(".form_content input[name='tin']").css('border-color', '#ccc');
                $('.req_tin_img').hide();
                $(".form_content input[name='tin_img']").css('border-color', '#ccc');
                $('.req_tan_img').hide();
                $(".form_content input[name='tan_img']").css('border-color', '#ccc');
                $('.req_ac_name').hide();
                $(".form_content input[name='ac_holder_name']").css('border-color', '#ccc');
                $('.req_ac_number').hide();
                $(".form_content input[name='ac_number']").css('border-color', '#ccc');
                $('.req_cnf_ac_number').hide();
                $(".form_content input[name='cnf_ac_number']").css('border-color', '#ccc');

                $('.req_ifsc').show();
                $(".form_content input[name='ifsc']").focus().css('border-color', 'red');
                return false;
            } else if (address_img == "") {
                $('.req_bname').hide();
                $(".form_content input[name='bname']").css('border-color', '#ccc');
                $('.req_pan').hide();
                $(".form_content input[name='pan']").css('border-color', '#ccc');
                $('.req_pan_img').hide();
                $(".form_content input[name='pan_img']").css('border-color', '#ccc');
                $('.req_tin').hide();
                $(".form_content input[name='tin']").css('border-color', '#ccc');
                $('.req_tin_img').hide();
                $(".form_content input[name='tin_img']").css('border-color', '#ccc');
                $('.req_tan_img').hide();
                $(".form_content input[name='tan_img']").css('border-color', '#ccc');
                $('.req_ac_name').hide();
                $(".form_content input[name='ac_holder_name']").css('border-color', '#ccc');
                $('.req_ac_number').hide();
                $(".form_content input[name='ac_number']").css('border-color', '#ccc');
                $('.req_cnf_ac_number').hide();
                $(".form_content input[name='cnf_ac_number']").css('border-color', '#ccc');
                $('.req_ifsc').hide();
                $(".form_content input[name='ifsc']").focus().css('border-color', '#ccc');

                $('.req_address_img').show();
                $(".form_content input[name='address_img']").focus().css('border-color', 'red');
                return false;
            } else if (!re.exec(address_img)) {
                $('.req_bname').hide();
                $(".form_content input[name='bname']").css('border-color', '#ccc');
                $('.req_pan').hide();
                $(".form_content input[name='pan']").css('border-color', '#ccc');
                $('.req_pan_img').hide();
                $(".form_content input[name='pan_img']").css('border-color', '#ccc');
                $('.req_tin').hide();
                $(".form_content input[name='tin']").css('border-color', '#ccc');
                $('.req_tin_img').hide();
                $(".form_content input[name='tin_img']").css('border-color', '#ccc');
                $('.req_tan_img').hide();
                $(".form_content input[name='tan_img']").css('border-color', '#ccc');
                $('.req_ac_name').hide();
                $(".form_content input[name='ac_holder_name']").css('border-color', '#ccc');
                $('.req_ac_number').hide();
                $(".form_content input[name='ac_number']").css('border-color', '#ccc');
                $('.req_cnf_ac_number').hide();
                $(".form_content input[name='cnf_ac_number']").css('border-color', '#ccc');
                $('.req_ifsc').hide();
                $(".form_content input[name='ifsc']").focus().css('border-color', '#ccc');

                $('.req_address_img').show().text("*.jpg, *.jpeg, *.png Extensions are allowed.");
                $(".form_content input[name='address_img']").val("");
                $(".form_content input[name='address_img']").focus().css('border-color', 'red');
                return false;
            } else if (ID_img == "") {
                $('.req_bname').hide();
                $(".form_content input[name='bname']").css('border-color', '#ccc');
                $('.req_pan').hide();
                $(".form_content input[name='pan']").css('border-color', '#ccc');
                $('.req_pan_img').hide();
                $(".form_content input[name='pan_img']").css('border-color', '#ccc');
                $('.req_tin').hide();
                $(".form_content input[name='tin']").css('border-color', '#ccc');
                $('.req_tin_img').hide();
                $(".form_content input[name='tin_img']").css('border-color', '#ccc');
                $('.req_tan_img').hide();
                $(".form_content input[name='tan_img']").css('border-color', '#ccc');
                $('.req_ac_name').hide();
                $(".form_content input[name='ac_holder_name']").css('border-color', '#ccc');
                $('.req_ac_number').hide();
                $(".form_content input[name='ac_number']").css('border-color', '#ccc');
                $('.req_cnf_ac_number').hide();
                $(".form_content input[name='cnf_ac_number']").css('border-color', '#ccc');
                $('.req_ifsc').hide();
                $(".form_content input[name='ifsc']").focus().css('border-color', '#ccc');
                $('.req_address_img').hide();
                $(".form_content input[name='address_img']").focus().css('border-color', '#ccc');

                $('.req_ID_img').show();
                $(".form_content input[name='ID_img']").focus().css('border-color', 'red');
                return false;
            } else if (!re.exec(ID_img)) {
                $('.req_bname').hide();
                $(".form_content input[name='bname']").css('border-color', '#ccc');
                $('.req_pan').hide();
                $(".form_content input[name='pan']").css('border-color', '#ccc');
                $('.req_pan_img').hide();
                $(".form_content input[name='pan_img']").css('border-color', '#ccc');
                $('.req_tin').hide();
                $(".form_content input[name='tin']").css('border-color', '#ccc');
                $('.req_tin_img').hide();
                $(".form_content input[name='tin_img']").css('border-color', '#ccc');
                $('.req_tan_img').hide();
                $(".form_content input[name='tan_img']").css('border-color', '#ccc');
                $('.req_ac_name').hide();
                $(".form_content input[name='ac_holder_name']").css('border-color', '#ccc');
                $('.req_ac_number').hide();
                $(".form_content input[name='ac_number']").css('border-color', '#ccc');
                $('.req_cnf_ac_number').hide();
                $(".form_content input[name='cnf_ac_number']").css('border-color', '#ccc');
                $('.req_ifsc').hide();
                $(".form_content input[name='ifsc']").focus().css('border-color', '#ccc');
                $('.req_address_img').hide();
                $(".form_content input[name='address_img']").focus().css('border-color', '#ccc');

                $('.req_ID_img').show().text("*.jpg, *.jpeg, *.png Extensions are allowed.");
                $(".form_content input[name='ID_img']").val("");
                $(".form_content input[name='ID_img']").focus().css('border-color', 'red');
                return false;
            } else if (Cheque_img == "") {
                $('.req_bname').hide();
                $(".form_content input[name='bname']").css('border-color', '#ccc');
                $('.req_pan').hide();
                $(".form_content input[name='pan']").css('border-color', '#ccc');
                $('.req_pan_img').hide();
                $(".form_content input[name='pan_img']").css('border-color', '#ccc');
                $('.req_tin').hide();
                $(".form_content input[name='tin']").css('border-color', '#ccc');
                $('.req_tin_img').hide();
                $(".form_content input[name='tin_img']").css('border-color', '#ccc');
                $('.req_tan_img').hide();
                $(".form_content input[name='tan_img']").css('border-color', '#ccc');
                $('.req_ac_name').hide();
                $(".form_content input[name='ac_holder_name']").css('border-color', '#ccc');
                $('.req_ac_number').hide();
                $(".form_content input[name='ac_number']").css('border-color', '#ccc');
                $('.req_cnf_ac_number').hide();
                $(".form_content input[name='cnf_ac_number']").css('border-color', '#ccc');
                $('.req_ifsc').hide();
                $(".form_content input[name='ifsc']").focus().css('border-color', '#ccc');
                $('.req_address_img').hide();
                $(".form_content input[name='address_img']").focus().css('border-color', '#ccc');
                $('.req_ID_img').hide();
                $(".form_content input[name='ID_img']").focus().css('border-color', '#ccc');

                $('.req_Cheque_img').show();
                $(".form_content input[name='Cheque_img']").focus().css('border-color', 'red');
                return false;
            } else if (!re.exec(Cheque_img)) {
                $('.req_bname').hide();
                $(".form_content input[name='bname']").css('border-color', '#ccc');
                $('.req_pan').hide();
                $(".form_content input[name='pan']").css('border-color', '#ccc');
                $('.req_pan_img').hide();
                $(".form_content input[name='pan_img']").css('border-color', '#ccc');
                $('.req_tin').hide();
                $(".form_content input[name='tin']").css('border-color', '#ccc');
                $('.req_tin_img').hide();
                $(".form_content input[name='tin_img']").css('border-color', '#ccc');
                $('.req_tan_img').hide();
                $(".form_content input[name='tan_img']").css('border-color', '#ccc');
                $('.req_ac_name').hide();
                $(".form_content input[name='ac_holder_name']").css('border-color', '#ccc');
                $('.req_ac_number').hide();
                $(".form_content input[name='ac_number']").css('border-color', '#ccc');
                $('.req_cnf_ac_number').hide();
                $(".form_content input[name='cnf_ac_number']").css('border-color', '#ccc');
                $('.req_ifsc').hide();
                $(".form_content input[name='ifsc']").focus().css('border-color', '#ccc');
                $('.req_address_img').hide();
                $(".form_content input[name='address_img']").focus().css('border-color', '#ccc');
                $('.req_ID_img').hide();
                $(".form_content input[name='ID_img']").focus().css('border-color', '#ccc');

                $('.req_Cheque_img').show().text("*.jpg, *.jpeg, *.png Extensions are allowed.");
                $(".form_content input[name='Cheque_img']").val("");
                $(".form_content input[name='Cheque_img']").focus().css('border-color', 'red');
                return false;
            } else if (display_name == "") {
                $('.req_bname').hide();
                $(".form_content input[name='bname']").css('border-color', '#ccc');
                $('.req_pan').hide();
                $(".form_content input[name='pan']").css('border-color', '#ccc');
                $('.req_pan_img').hide();
                $(".form_content input[name='pan_img']").css('border-color', '#ccc');
                $('.req_tin').hide();
                $(".form_content input[name='tin']").css('border-color', '#ccc');
                $('.req_tin_img').hide();
                $(".form_content input[name='tin_img']").css('border-color', '#ccc');
                $('.req_tan_img').hide();
                $(".form_content input[name='tan_img']").css('border-color', '#ccc');
                $('.req_ac_name').hide();
                $(".form_content input[name='ac_holder_name']").css('border-color', '#ccc');
                $('.req_ac_number').hide();
                $(".form_content input[name='ac_number']").css('border-color', '#ccc');
                $('.req_cnf_ac_number').hide();
                $(".form_content input[name='cnf_ac_number']").css('border-color', '#ccc');
                $('.req_ifsc').hide();
                $(".form_content input[name='ifsc']").css('border-color', '#ccc');
                $('.req_address_img').hide();
                $(".form_content input[name='address_img']").focus().css('border-color', '#ccc');
                $('.req_ID_img').hide();
                $(".form_content input[name='ID_img']").focus().css('border-color', '#ccc');
                $('.req_Cheque_img').hide();
                $(".form_content input[name='Cheque_img']").focus().css('border-color', '#ccc');

                $('.req_display_name').show();
                $(".form_content input[name='display_name']").focus().css('border-color', 'red');
                return false;
            } else if (store_desc == "") {
                $('.req_bname').hide();
                $(".form_content input[name='bname']").css('border-color', '#ccc');
                $('.req_pan').hide();
                $(".form_content input[name='pan']").css('border-color', '#ccc');
                $('.req_pan_img').hide();
                $(".form_content input[name='pan_img']").css('border-color', '#ccc');
                $('.req_tin').hide();
                $(".form_content input[name='tin']").css('border-color', '#ccc');
                $('.req_tin_img').hide();
                $(".form_content input[name='tin_img']").css('border-color', '#ccc');
                $('.req_tan_img').hide();
                $(".form_content input[name='tan_img']").css('border-color', '#ccc');
                $('.req_ac_name').hide();
                $(".form_content input[name='ac_holder_name']").css('border-color', '#ccc');
                $('.req_ac_number').hide();
                $(".form_content input[name='ac_number']").css('border-color', '#ccc');
                $('.req_cnf_ac_number').hide();
                $(".form_content input[name='cnf_ac_number']").css('border-color', '#ccc');
                $('.req_ifsc').hide();
                $(".form_content input[name='ifsc']").css('border-color', '#ccc');
                $('.req_address_img').hide();
                $(".form_content input[name='address_img']").focus().css('border-color', '#ccc');
                $('.req_ID_img').hide();
                $(".form_content input[name='ID_img']").focus().css('border-color', '#ccc');
                $('.req_Cheque_img').hide();
                $(".form_content input[name='Cheque_img']").focus().css('border-color', '#ccc');
                $('.req_display_name').hide();
                $(".form_content input[name='display_name']").css('border-color', '#ccc');

                $('.req_store_desc').show();
                $(".form_content textarea[name='store_desc']").focus().css('border-color', 'red');
                return false;
            }
        }
    </script>

    <script>
        function displayPreview(files, sl) {
            var reader = new FileReader();
            var img = new Image();

            reader.onload = function (e) {
                img.src = e.target.result;
                fileSize = Math.round(files.size / 1024);
                //alert("File size is " + fileSize + " kb");
                if (fileSize > 1024 && sl == 'pan') {
                    //alert("Maximum file size 1mb.");
                    $('.req_pan_img').show().text('Maximum file size 1MB.');
                    $("#pan_img").css('border-color', 'red');
                    $("#pan_img").val("");
                    return false;
                } else if (fileSize > 1024 && sl == 'tin') {
                    $('.req_pan_img').hide();
                    $("#pan_img").css('border-color', '#ccc');

                    //alert("Maximum file size 1mb.");
                    $('.req_tin_img').show().text('Maximum file size 1MB.');
                    $("#tin_img").val("").css('border-color', 'red');
                    return false;
                } else if (fileSize > 1024 && sl == 'tan') {
                    $('.req_pan_img').hide();
                    $("#pan_img").css('border-color', '#ccc');
                    $('.req_tin_img').hide();
                    $("#tin_img").css('border-color', '#ccc');

                    //alert("Maximum file size 1mb.");
                    $('.req_tan_img').show().text('Maximum file size 1MB.');
                    $("#tan_img").val("").css('border-color', 'red');
                    return false;
                } else if (fileSize > 1024 && sl == 'address') {
                    $('.req_pan_img').hide();
                    $("#pan_img").css('border-color', '#ccc');
                    $('.req_tin_img').hide();
                    $("#tin_img").css('border-color', '#ccc');
                    $('.req_tan_img').hide();
                    $("#tan_img").css('border-color', '#ccc');

                    //alert("Maximum file size 1mb.");
                    $('.req_address_img').show().text('Maximum file size 1MB.');
                    $("#address_img").val("").css('border-color', 'red');
                    return false;
                } else if (fileSize > 1024 && sl == 'id') {
                    $('.req_pan_img').hide();
                    $("#pan_img").css('border-color', '#ccc');
                    $('.req_tin_img').hide();
                    $("#tin_img").css('border-color', '#ccc');
                    $('.req_tan_img').hide();
                    $("#tan_img").css('border-color', '#ccc');
                    $('.req_address_img').hide();
                    $("#address_img").css('border-color', '#ccc');

                    //alert("Maximum file size 1mb.");
                    $('.req_ID_img').show().text('Maximum file size 1MB.');
                    $("#ID_img").val("").css('border-color', 'red');
                    return false;
                } else if (fileSize > 1024 && sl == 'cheque') {
                    $('.req_pan_img').hide();
                    $("#pan_img").css('border-color', '#ccc');
                    $('.req_tin_img').hide();
                    $("#tin_img").css('border-color', '#ccc');
                    $('.req_tan_img').hide();
                    $("#tan_img").css('border-color', '#ccc');
                    $('.req_address_img').hide();
                    $("#address_img").css('border-color', '#ccc');
                    $('.req_ID_img').hide();
                    $("#ID_img").css('border-color', '#ccc');

                    //alert("Maximum file size 1mb.");
                    $('.req_Cheque_img').show().text('Maximum file size 1MB.');
                    $("#Cheque_img").val("").css('border-color', 'red');
                    return false;
                }

            };
            reader.readAsDataURL(files);
        }


        $("#pan_img").change(function () {
            var file = this.files[0];
            displayPreview(file, 'pan');
        });
        $("#tin_img").change(function () {
            var file = this.files[0];
            displayPreview(file, 'tin');
        });
        $("#tan_img").change(function () {
            var file = this.files[0];
            displayPreview(file, 'tan');
        });

        $("#address_img").change(function () {
            var file = this.files[0];
            displayPreview(file, 'address');
        });
        $("#ID_img").change(function () {
            var file = this.files[0];
            displayPreview(file, 'id');
        });
        $("#Cheque_img").change(function () {
            var file = this.files[0];
            displayPreview(file, 'cheque');
        });

    </script>

</html>