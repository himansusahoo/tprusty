<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="<?php //echo $data->meta_descrp ; ?>" content="">
        <meta name="<?php //echo $data->meta_keyword ; ?>" content="" />

        <meta name="author" content="">
        <title><?php //echo $data->title ; ?></title>

        <?php include "header.php"; ?>

    <div class="main-content">
        <div class="clearfix">  </div>
        <div  class="checkout"  align="center">

            <?php include('Crypto.php') ?>

            <?php
            //error_reporting(0);

            $working_key = WORKING_KEY; //Shared by CCAVENUES
            $access_code = ACCESS_CODE; //Shared by CCAVENUES
            $merchant_data = '';

            foreach ($_POST as $key => $value) {

                $merchant_data.=$key . '=' . $value . '&';
            }

            $encrypted_data = encrypt($merchant_data, $working_key); // Method for encrypting the data.

            $production_url = 'https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest=' . $encrypted_data . '&access_code=' . $access_code;
            ?>
            <iframe src="<?php echo $production_url ?>" id="paymentFrame" width="482" height="515" frameborder="0" scrolling="auto" ></iframe>

            <script type="text/javascript" src="<?php echo base_url() . 'js/jquery-1.7.2.js' ?>"></script>
            <script type="text/javascript">
                $(document).ready(function () {
                    window.addEventListener('message', function (e) {
                        $("#paymentFrame").css("height", e.data['newHeight'] + 'px');
                    }, false);

                });
            </script> 




            <!-- end main content -->

        </div>

<?php include "footer.php"; ?>