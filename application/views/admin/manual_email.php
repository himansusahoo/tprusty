<?php
require_once('header.php');
?>
<!--- colorbox script start here--->
<link rel="stylesheet" href="<?php echo base_url(); ?>colorbox/colorbox.css" />
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
<!--<script src="../jquery.colorbox.js"></script>-->
<script src="<?php echo base_url(); ?>colorbox/jquery.colorbox.js"></script>
<script>
    $(document).ready(function () {
        //Examples of how to assign the Colorbox event to elements
        $(".group3").colorbox({rel: 'group3', transition: "none", width: "60%", height: "75%"});

        //Example of preserving a JavaScript event for inline calls.
        $("#click").click(function () {
            $('#click').css({"background-color": "#f00", "color": "#fff", "cursor": "inherit"}).text("Open this window again and this message will still be here.");
            return false;
        });
    });
</script>
<!--- colorbox script end here--->
<style>
    .cboxPhoto{
        cursor: pointer;
        float: none;
        height: 300px !important;
        margin-top: 78px !important;
        width: 450px !important;
    }
    #cboxTitle{
        color: #000;
        display: block;
        float: left;
        font-weight: 600;
        left: 50% !important;
        position: absolute !important;
        top: 400px !important;
    }
    #cboxCurrent{
        display:none !important;
    }
    #cboxPrevious,#cboxNext{display:none !important;}
    .udt{ display:none;}
</style>

<div id="content">
    <div class="top-bar">
        <div class="top-left">
            <?php include 'sub_sellers.php'; ?>
        </div>
        <div class="top-right">
            <?php include 'top_right.php'; ?>
        </div>
    </div>  <!-- @end top-bar  -->
    <div class="main-content">
        <?php include 'email_header.php'; ?>
        <?php
        $query_sellername = $this->db->query("select a.business_name from seller_account_information a where a.seller_id='$seller_id'  ");
        $rw_sellername = $query_sellername->row();

        $query_email = $this->db->query("select a.pemail from seller_account_information a where a.seller_id='$seller_id'  ");
        $rw_selleremail = $query_email->row();
        ?>              
        <form method="POST" action="<?php echo base_url(); ?>admin/sellers/manual_email_save" >                 
            <!-- start hor-line -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <!--start space height --> 
                <tr>
                    <td height="24"></td>
                </tr>
                <tr>
                    <td>

                        <input type="text" name="email_sub" placeholder="Enter Subject" >
                        <input type="hidden" name="seller_id" value="<?php echo $seller_id; ?>" >
                        <input type="hidden" name="seller_email" value="<?php echo $rw_selleremail->pemail; ?>" >


                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="recipients" placeholder="Enter Recipient Name"> <br/><br/>
                        <textarea cols="67" name="manual_content" rows="10"> 
                        </textarea>



                    </td>
                </tr>
                <tr> <td height="24"></td>  </tr>
                <tr>
                    <td>
                        <p><strong>Thanks & Regards,</strong> <br /></p>
                        <input type="text" name="sender_name" placeholder="Enter Your Name">

                    </td>
                </tr>

            </table>


            <!-- start hor-line -->



            <table border="0" cellspacing="0" cellpadding="0" style="width:100%; background-color: #ffffff;" align="center" class="container">
                <!--start space height --> 

                <!--end space height -->      

                <!--start space height --> 
                <tr>

                    <td height="25" align="center" class="ftr-nav">
                <blink><img onclick="window.location.href = 'https://play.google.com/store/apps/details?id=moonboy.online.shopping.india'" src="<?= APP_BASE ?>images/pagedesign_image/trfl40mfnwb8cr620170921175530.jpg" style="width: 100%;margin: 1px 0px;"/></blink>

                </td>
                </tr>
                <!--end space height -->
            </table>
            <!-- end layout-6 container -->
            <center>
                <table border="0" cellspacing="0" cellpadding="5"  style="width:100%; background-color: #25203b;" align="center">
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
                        <td align="left" valign="middle">
                            <a href="https://www.instagram.com/moonboy.in/"  target="blank_">
                                <img src="https://images.vexels.com/media/users/3/137380/isolated/preview/1b2ca367caa7eff8b45c09ec09b44c16-instagram-icon-logo-by-vexels.png" alt="" width="28"  style="border:none;" vspace="0" /></a>
                        </td>
                    </tr>
                </table>
            </center>
            <!-- start layout-7 container -->
            <table cellspacing="0" cellpadding="0" style="width:100%; background-color: #25203b; border: none; border-top: none;" align="center">

                <tr>
                    <td valign="top" style="border-top: none;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                            <tr>

                                <td height="25" align="center" class="ftr-nav">
                                    <a href="<?= APP_BASE ?>about-us" class="f-nav" target="blank_"> About Us |</a>

                                    <a href="<?= APP_BASE ?>contact-us" class="f-nav" target="blank_"> Faqs | </a>

                                    <a href="<?= APP_BASE ?>seller/seller" class="f-nav" target="blank_">Seller Login</a>
                                </td>
                            </tr>

                            <tr>
                                <td align="center" valign="middle" style="text-transform:uppercase; text-align:center; color:#fff; font-size:12px; padding: 2px; margin: 0;" class="copy">
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


<center>
    <label>From Id:</label>
    <select name="from_id" id="from_id">

        <option selected value="<?= SELLER_MAIL ?>"><?= SELLER_MAIL ?></option>
        <option value="<?= NO_REPLY_MAIL ?>"><?= NO_REPLY_MAIL ?></option>
        <option value="<?= SUPPORT_MAIL ?>"><?= SUPPORT_MAIL ?></option>

    </select>
    <input type="button" name="add_new" id="add_new" value="Add New">
    <input type="email" name="from_id" id="add_new_id" placeholder="Enter new Email" style="display:none;">
    <br>
    <br>
    <input type="submit" class="all_buttons" name="save_email" value="Next">
    <br>
    <br>
</center>
</form>
</div>
</div>
<div class="clearfix"></div>
<!-- @end #right-content -->

<!--</div>--><!-- @end #content -->
</div><!-- @end #w -->


<style>
    .dt {
        width: 150px;
    }
    .Zebra_DatePicker_Icon{left: 130px !important;}
</style>



<!--- Zebra_Datepicker link start here ---->
<!--<script src="<?php // echo base_url();             ?>Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script>-->
<!--<script src="<?php // echo base_url();             ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
<script src="<?php // echo base_url();             ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php // echo base_url();             ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">-->
<!--<link href="<?php // echo base_url();             ?>Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">-->
<!--- Zebra_Datepicker link end here ---->




<!---script start for Checking for unique SKU--->
<script type="text/javascript">
    $(document).ready(function () {
        $("#add_new_id").attr("disabled", true);
        $("#add_new").click(function () {
            $("#from_id").attr("disabled", true);
            $("#from_id").hide();
            $("#add_new").hide();
            $("#add_new_id").attr("disabled", false);
            $("#add_new_id").show();



            //$("#discountselection").show(); //To Show the dropdown
        });
    });

</script>


<?php
require_once('footer.php');
?>					