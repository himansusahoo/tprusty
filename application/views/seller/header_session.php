<script>
    /*function lightbox_close(){
     document.getElementById('light').style.display='none';
     document.getElementById('fade').style.display='none';
     }*/
    function light_open() {
        window.scrollTo(0, 0);
        document.getElementById('light').style.display = 'block';
        document.getElementById('fade').style.display = 'block';

        $('#terms_conditions_button').click(function () {
            var base_url = "<?php echo base_url(); ?>";
            var controller = "seller/seller";
            if ($("input[name='terms_conditions']").is(':checked')) {
                var terms_value = $('input[name="terms_conditions"]:checked').val();
            } else {
                var terms_value = '';
            }
            //alert(terms_value); return false;
            if (terms_value == "") {
                alert("Please Accept Terms and Conditions.");
                return false;
            } else if (terms_value == "accept") {
                window.location.href = base_url + controller + '/terms_conditions';
            } else {
                window.location.href = base_url + controller;
            }
        });
    }
</script>
<style>
    #fade{display: none; position: fixed; top: 0%; left: 0%; width: 100%;height: 100%;background-color: #000;z-index:1001;-moz-opacity: 0.7;opacity:.70;filter: alpha(opacity=70);}
    #light{display: none;position: absolute;top: 50%;left: 30%;width: 1020px;height: auto;margin-left: -330px;margin-top: 100px;padding: 10px;border: 2px solid #FFF;background: #CCC;z-index:1002;overflow:visible;}
    #light form{width:100%;}
    #light h1{font-size: 16px; font-weight: normal; text-transform: uppercase;}
    #light p strong{font-size: 14px;}
    #light p{font-size: 12px;}
    #light button{text-transform: uppercase;}
</style>
<?php //if($signin_date == "0000-00-00 00:00:00") :  ?>
<div id="light">
    <div>
        <h1>Terms & Conditions</h1>
        <p><strong>Terms & Conditions :</strong></p>
        <p>We only accept payment in Indian currency(INR) for all products purchased.</p>
        <p>Purchases are subjected to delivery charges as stated in the Cart at time of purchase.</p>
        <!-- Comment on 26/10/15
        <p><strong>Shipping & Delivery :</strong></p>
        <p>Please allow at least 3-7 business days for your order to arrive after payment has been confirmed. If the product ordered is out of stocks, we will contact you immediately to confirm a new delivery date or other arrangements.</p>
        <p>Shipping through Reputed Couriers – Fedex/ DHL (Blue Dart)/  Professional/ DTDC / First Flight /Speed Post.</p>
        <p>Exchange (return and/or resend) shipping cost are borne by Buyer.</p>
        <p>All shipping and handling fees are not refundable.</p>-->
        <p><strong>Payment Terms :</strong></p>
        <p>We accept various forms of payment modes e.g. Credit Card / Debit Card Online Bank Transfer . We will process your order immediately after the payments has been confirmed cleared by Online Payment Acceptance Service Provider.</p>

        <input type="radio" name="terms_conditions" value="accept"> Accept <br> 
        <input type="radio" name="terms_conditions" value="decline"> Decline
        <div>
            <button class="seller_buttons" id="terms_conditions_button">Continue</button>
        </div>
    </div>
</div>
<div id="fade" onClick="lightbox_close();"></div>
<?php //endif;  ?>



<div class="top-right-seller">
    <ul>
        <?php
        $session_id = $this->session->userdata('seller-session');
        $query = $this->db->query("SELECT * FROM seller_account WHERE seller_id='$session_id' ");
        $row = $query->result();
        if (!$session_id) :
            ?>
            <li><a href="<?php echo base_url(); ?>seller/seller/seller_login"> Login </a></li> 
        <?php else : ?>
            <li>Account Status :<span  style="color:#fbbc6b; font-weight:bold; "> <?php echo $row[0]->status; ?> </span></li>
            <li class="seller_name" onMouseOver="OverFunction()" onMouseOut="OutFunction()"><a href="#"><?php echo $this->session->userdata('name'); ?>
                    <i class="fa fa-caret-down"></i> </a>
                <div id="profile_menu">
                    <ul>
                        <li><a href="<?php echo base_url(); ?>seller/account"> Manage Profile </a></li>
                        <li><a href="<?php echo base_url(); ?>seller/seller/seller_logout"> Logout </a></li>
                    </ul>
                </div>
            </li>

        <?php endif; ?>
    </ul>
</div>
<div class="clraefix"></div>

<!--  Login Menu Toggle-->
<script type="text/javascript">
    function OverFunction() {
        $("#profile_menu").show();
    }
    function OutFunction() {
        $("#profile_menu").hide();
    }
</script>
