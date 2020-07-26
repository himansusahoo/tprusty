<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="initial-scale=1.0"/>
        <meta name="format-detection" content="telephone=no">
            <title><?= ucfirst(DOMAIN_NAME) ?> - Shop Your Heart Out!</title>  

            <style type="text/css">

                /* Resets: see reset.css for details */
                html{width: 100%;margin:0; padding:0; }
                body {margin:0; padding:0; font-family: Arial,Tahoma, Helvetica, sans-serif; background-color:#eeeeee; }
                table {border-spacing:0;}
                img{display:block !important; outline:none; text-decoration:none; border:none; height: auto; line-height: 100%;}
                p{padding: 0; margin: 0; font-size:12px; line-height:20px;}
                table td, table tr { border-collapse: collapse; } a{text-decoration:none;}
                table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; font-size:12px; }
                .logo{width:150px; float:left;} .container-social{width:200px; float:right;}
                .nav{color:#fff; padding:5px; text-decoration:none; display:block; font-size:12px;}
                .f-nav{color:#fff; padding:5px; text-decoration:none; display:inline-block; font-size:12px;}
                .gretings{ padding-bottom:0px;} .status{padding-top:0px;}
                .notice{ background-color:#ffeaef; border:1px solid #5c0116; padding:5px; text-align:center; font-size:12px;}
                .container-social tr td{padding-top:3px;} .prdct-dtls tr td{padding:5px;}

                @media only screen and (max-width: 640px){
                    table[class="container"], td[class="container"]{ width: 100%!important; }
                }

                @media only screen and (max-width: 490px){
                    .container-social,.logo{ float:none; text-align:center; margin:5px auto; }
                }
            </style>

    </head>

    <body>
        <div  style="background-color:#eeeeee;margin: 0; width:100%; padding:10px 0; ">
            <table border="0" cellspacing="0" cellpadding="0" style="width:450px; background-color: #ffffff; border-top:3px solid #25203b;" align="center" class="container">
                <tr>
                    <td align="center" valign="top" style="padding:10px;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" >

                            <tr>
                                <td align="center" valign="top" width="100%">

                                    <!-- logo -->
                                    <div class="logo">
                                        <img src="<?= APP_BASE ?>images/logo.png" alt="logo"  hspace="0" vspace="0" width="150" style="border:none;"/>
                                    </div>
                                    <!-- end logo -->

                                    <!-- social icons -->
                                    <div class="container-social">
                                        <table border="0" cellspacing="0" cellpadding="5" align="center">
                                            <tr>
                                                <td align="left" valign="middle">
                                                    <a href="https://www.facebook.com/MoonboyIN/"  target="blank_">
                                                        <img src="<?= APP_BASE ?>images/facebook-icon.png" alt="" width="28" style="border:none;" vspace="0" /></a>
                                                </td>
                                                <td align="left" valign="middle">
                                                    <a href="https://twitter.com/moonboy_ltd"  target="blank_">
                                                        <img src="<?= APP_BASE ?>images/twitter-icon.png" alt="" width="28"  style="border:none;" vspace="0" /></a>
                                                </td>
                                                <td align="left" valign="middle">
                                                    <a href="https://plus.google.com/107116566163445169044"  target="blank_" >
                                                        <img src="<?= APP_BASE ?>images/google-icon.png" alt="" width="28"  style="border:none;" vspace="0" /></a>
                                                </td>
                                                <td align="left" valign="middle">
                                                    <a href="http://in.linkedin.com/in/moonboy"  target="blank_" >
                                                        <img src="<?= APP_BASE ?>images/linkedin-icon.png" alt="" width="28"  style="border:none;" vspace="0" /></a>
                                                </td>      
                                                <td align="left" valign="middle">
                                                    <a href="https://www.pinterest.com/moonboy_ltd/"  target="blank_">
                                                        <img src="<?= APP_BASE ?>images/pinit-icon.png" alt="" width="28"  style="border:none;" vspace="0" /></a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>   
                                    <!-- end social icons -->         

                                </td>
                            </tr>

                        </table>       

                        <!-- start layout-1 block -->

                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <!-- start space -->
                            <tr>
                                <td valign="top" height="14">
                                </td>
                            </tr>
                            <!-- end space -->
                        </table>


                        <table width="100%" bgcolor="#25203b" border="0" cellspacing="0" cellpadding="0" align="center">
                            <tr>
                                <td align="center" style="padding-bottom:3px;"> <span class="nav"><img src="<?= APP_BASE ?>images/original_products.png" width="20" height="20" alt="" style="float:left;" /> Original Products </span> </td>
                                <td align="center" style="padding-bottom:3px;"> <span class="nav"><img src="<?= APP_BASE ?>images/cash_on.png" width="20" height="20" alt="" style="float:left;"/> Cash On Delivery </span> </td>
                                <td align="center" style="padding-bottom:3px;"> <span class="nav"><img src="<?= APP_BASE ?>images/easy_returns.png" width="20" height="20" alt="" style="float:left;" /> Easy Return </span> </td>
                                <td align="center" style="padding-bottom:3px;"> <span class="nav"><img src="<?= APP_BASE ?>images/secure_pay.png" width="20" height="20" alt="" style="float:left;" /> Secured Payment  </span> </td>
                            </tr>      
                        </table>


                        <!-- start hor-line -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                            <!--start space height --> 
                            <tr>
                                <td height="24">
                                    <p class="gretings"> </p></br>
                                    <p> Call us : 917874460000 </p>
                                    <p> Email : <?= SELLER_MAIL ?> </p>
                                    </br></td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="status"> <?=COMPANY?> <strong></strong></p> 
                                </td>


                                <tr>

                                    <td>
                                        <p> <strong style='font-size:16px;'>Dear <?php echo $fname . " " . $lname; ?>"  ,</strong> <br /><br />

                                            <span style='color:#e25a0c; font-weight:bold;'> Order No.: <?php echo $rtorder_id; ?></span> <br /> <br />
                                            <span style='color:#e25a0c; font-weight:bold;'> Return Id.: <?php echo $retn_id; ?></span> <br /> <br />

                                            This Order has denied for return request by you with following details

                                            <table border='1' ><tr bgcolor='#CCC'> <th>Product Name </th><th>Quantity </th><th>Amount </th></tr> 
                                                <tr> 
                                                    <td> <?php echo $prd_name; ?> </td> <td> <?php echo $prd_qnt; ?> </td> <td>Rs.<?php echo $prd_totamnt; ?>  </td>  </tr>

                                            </table>
                                            <br />  <br />


                                    </td> 
                                </tr>
                                <tr>
                                    <td height="28">&copy; 2015 <?=COMPANY?>. 1st Floor, Khajotiya House, Beside Parsi Fire Temple , Sayedpura, Surat, GJ, IN- 395003 <br />
                                        You received this email because you're a registered <?=COMPANY?> user. </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p> <strong>Thanks & Regards,</strong> <br />
                                            <?= ucfirst(DOMAIN_NAME) ?> </p>
                                    </td>
                                </tr>


                        </table>
                        <!-- start hor-line -->





                        <!-- start layout-6 container -->
                        <table border="0" cellspacing="0" cellpadding="0" style="width:100%; background-color: #ffffff;" align="center" class="container">
                            <!--start space height --> 
                            <tr>
                                <td height="28"></td>
                            </tr>
                            <!--end space height -->      
                            <tr>
                                <td valign="top" style="padding: 0 10px;" bgcolor="#f3f3f3">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td align="center" valign="top" style="padding: 10px 3px; margin: 0; font-size: 13px;line-height: 18px; color:#3a3f50;">
                                                You're receiving this email because you signed up for <strong><?= DOMAIN_NAME ?></strong>. 
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>      
                            <!--start space height --> 
                            <tr>
                                <td height="28"></td>
                            </tr>
                            <!--end space height -->
                        </table>
                        <!-- end layout-6 container -->

                        <!-- start layout-7 container -->
                        <table border="0" cellspacing="0" cellpadding="0" style="width:100%; background-color: #25203b;" align="center">
                            <tr>
                                <td valign="top">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                                        <tr>

                                            <td height="25" align="center" class="ftr-nav">
                                                <a href="<?= APP_BASE ?>about-us" class="f-nav" target="blank_"> About Us |</a>
                                                <a href="<?= APP_BASE ?>privacy-policy" class="f-nav" target="blank_"> Privacy Policy |</a>
                                                <a href="<?= APP_BASE ?>contact-us" class="f-nav" target="blank_"> Faqs | </a>
                                                <a href="<?= APP_BASE ?>terns-and-conditions" class="f-nav" target="blank_"> Terms |</a>
                                                <a href="<?= APP_BASE ?>return-policy" class="f-nav" target="blank_"> Return Policy</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="middle" class="copy" style="text-transform:uppercase; text-align:center; color:#fff; font-size:12px; padding: 2px; margin: 0;">
                                                &copy; <strong><?= DOMAIN_NAME ?></strong></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <!-- end layout-7 container -->


                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>



