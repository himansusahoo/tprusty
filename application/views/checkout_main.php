<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content = "width = device-width, initial-scale =1.0, user-scalable = no">
        <meta name="<?php //echo $data->meta_descrp ; ?>" content="">
        <meta name="<?php //echo $data->meta_keyword ; ?>" content="" />

        <title><?php //echo $data->title ; ?></title>

        <script type= "text/javascript" src = "<?php echo base_url(); ?>js/countries.js"></script>

        <?php
        include "header.php";
        
        if ($this->session->userdata('chkoutemp_session_id') == "") {
            $dtm = str_replace(" ", "-", date('Y-m-d H:i:s'));
            $chkoutemp_session_id = random_string('alnum', 10) . $dtm;
            $this->session->set_userdata('chkoutemp_session_id', $chkoutemp_session_id);
        }
        ?>

        <script type="text/javascript">

            //Created / Generates the captcha function    
            function DrawCaptcha()
            {
                var a = Math.ceil(Math.random() * 10) + '';
                var b = Math.ceil(Math.random() * 10) + '';
                var c = Math.ceil(Math.random() * 10) + '';
                var d = Math.ceil(Math.random() * 10) + '';
                var e = Math.ceil(Math.random() * 10) + '';
                var f = Math.ceil(Math.random() * 10) + '';
                var g = Math.ceil(Math.random() * 10) + '';
                var code = a + ' ' + b + ' ' + ' ' + c + ' ' + d + ' ' + e + ' ' + f + ' ' + g;
                document.getElementById("txtCaptcha").value = code
            }

            // Validate the Entered input aganist the generated security code function   
            function ValidCaptcha(addtocart_ids, total_price, seller_id_arr, tax_arr, shipping_fees_arr, sub_total_arr, qantity_arr, sku_arr, address_id, price_arr, color_arr, size_arr) {
                var ids = addtocart_ids;
                //alert(size_strng.replace(' ','-'));return false;
                var str1 = removeSpaces(document.getElementById('txtCaptcha').value);
                var str2 = removeSpaces(document.getElementById('txtInput').value);
                if (str1 == str2)
                {
                    var conf = confirm('Do you confirm your Order(s)');
                    if (conf == true)
                    {
                        //Script start for attribute parametere//
                        var color_strng = color_arr.replace(' ', '&');
                        var size_strng = size_arr.replace(' ', '&');
                        //Script end of attribute parametere//

                        window.location.href = '<?php echo base_url() . 'my_order/myorder_detail/' ?>' + ids + '/' + total_price + '/' + seller_id_arr + '/' + tax_arr + '/' + shipping_fees_arr + '/' + sub_total_arr + '/' + qantity_arr + '/' + sku_arr + '/' + address_id + '/' + price_arr + '/' + color_strng + '/' + size_strng;
                    }

                } else
                {
                    alert('Enter Correct Number');
                }

            }



            function payfrom_wallet(addtocart_ids, total_price, seller_id_arr, tax_arr, shipping_fees_arr, sub_total_arr, qantity_arr, sku_arr, address_id, price_arr, color_arr, size_arr)
            {
                var deduct_wallet_amt = $('#wallet_amt').val();
                var ids = addtocart_ids;
                //alert(size_strng.replace(' ','-'));return false;

                var conf = confirm('Do you confirm your Order(s)');
                if (conf == true)
                {

                    //Script start for attribute parametere//
                    var color_strng = color_arr.replace(' ', '&');
                    var size_strng = size_arr.replace(' ', '&');
                    //Script end of attribute parametere//

                    window.location.href = '<?php echo base_url() . 'my_order/myorder_detail_wallet/' ?>' + ids + '/' + total_price + '/' + seller_id_arr + '/' + tax_arr + '/' + shipping_fees_arr + '/' + sub_total_arr + '/' + qantity_arr + '/' + sku_arr + '/' + address_id + '/' + price_arr + '/' + color_strng + '/' + size_strng + '/' + deduct_wallet_amt;
                }

            }



            function payment_confirm_from_voucher(addtocart_ids, total_price, seller_id_arr, tax_arr, shipping_fees_arr, sub_total_arr, qantity_arr, sku_arr, address_id, price_arr, color_arr, size_arr) {
                var ids = addtocart_ids;
                var conf = confirm('Do you confirm your Order(s)');
                if (conf) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>my_wallet/get_adj_wllt_amount',
                        method: 'post',
                        data: {adj_typ: 'W'},
                        success: function (result) {
                            if (result == 0) {
                                var deduct_wallet_amt = 0;
                            } else {
                                var deduct_wallet_amt = result;
                            }
                            //$('#ajxtst').html(result);
                            //Script start for attribute parametere//
                            var color_strng = color_arr.replace(' ', '&');
                            var size_strng = size_arr.replace(' ', '&');
                            //Script end of attribute parametere//
                            window.location.href = '<?php echo base_url() . 'my_order/myorder_detail_wallet/'; ?>' + ids + '/' + total_price + '/' + seller_id_arr + '/' + tax_arr + '/' + shipping_fees_arr + '/' + sub_total_arr + '/' + qantity_arr + '/' + sku_arr + '/' + address_id + '/' + price_arr + '/' + color_strng + '/' + size_strng + '/' + deduct_wallet_amt;
                        }
                    });
                }
            }





        // Remove the spaces from the entered and generated code
            function removeSpaces(string)
            {
                return string.split(' ').join('');
            }
        </script>

        <script>
            function gosellerReview(val) {
                //alert (val); return false;
                $('#goslr').css('color', '#a4f068');
                $.ajax({
                    url: '<?php echo base_url(); ?>product_description/seller_rev_pg',
                    method: 'post',
                    data: {seller_id: val},
                    success: function (result)
                    {
                        //$('#ajxtest').html(result);
                        if (result == 'success') {
                            window.location.href = '<?php echo base_url(); ?>seller';
                            //window.location.reload(true);
                            //setTimeout(function() { location.reload() },1500);
                        }
                    }
                });
            }
        </script>

        <script>
            function pay_by_wallet()
            {
                $.ajax({
                    url: '<?php echo base_url(); ?>my_wallet/calculate_total_adjustment_n_without_wallet',
                    method: 'post',
                    dataType: "json",
                    data: {adj_type: 'W'},
                    success: function (result) {
                        $('#ajxtst').html(result);
                        if (result != 'NOT') {
                            $('#amt_payble').html(result.rest_payble_amt);
                            $('#amt_payble_hidden').html(result.rest_payble_amt_without_wlt);
                            $('#onlinepay_div').css('display', 'none');
                            $('#payment_gv_div').css('display', 'none');
                            $('#payment_cod_div').css('display', 'none');
                            $('#payment_copn_div').css('display', 'none');
                            $('#payment_div_wallet').css('display', 'block');

                            if (result.rest_payble_amt <= 0) {
                                $('#wlt_btn_spn').html('<input type="button" value="APPLY" class="btn-big2 copn_dis_btn" onClick="alert(\'You can not applied wallet balance here!\')">');
                            }
                        }
                    }
                });
            }


            function PayByGV() {
                $.ajax({
                    url: '<?php echo base_url(); ?>my_wallet/calculate_adjustment',
                    method: 'post',
                    data: {adj_type: 'V'},
                    success: function (result) {
                        //$('#ajxtst').html(result);
                        if (result != 'NOT') {
                            $('#amt_payble_voucher').html(result);
                            $('#payment_cod_div').css('display', 'none');
                            $('#onlinepay_div').css('display', 'none');
                            $('#payment_div_wallet').css('display', 'none');
                            $('#payment_copn_div').css('display', 'none');
                            $('#payment_gv_div').css('display', 'block');

                            if (result <= 0) {
                                $('#vchr_btn_spn').html('<input type="button" value="APPLY" class="btn-big2 copn_dis_btn" onClick="alert(\'You can not applied any voucher here!\')">');
                                /*$('#vchr_input_spn').html('<input type="text" placeholder="Enter Gift Voutcher Number" readonly name="gv_number" id="gv_number" class="input-text" style="width:250px;">');*/
                            }
                        }
                    }
                });
            }


            function PayByCoupon() {
                $.ajax({
                    url: '<?php echo base_url(); ?>my_wallet/calculate_adjustment',
                    method: 'post',
                    data: {adj_type: 'C'},
                    success: function (result) {
                        //$('#ajxtst').html(result);
                        if (result != 'NOT') {
                            $('#amt_payble_copn').html(result);
                            $('#payment_cod_div').css('display', 'none');
                            $('#onlinepay_div').css('display', 'none');
                            $('#payment_div_wallet').css('display', 'none');
                            $('#payment_gv_div').css('display', 'none');
                            $('#payment_copn_div').css('display', 'block');

                            if (result <= 0) {
                                $('#copn_btn_spn').html('<input type="button" value="APPLY" class="btn-big2 copn_dis_btn" onClick="alert(\'You can not applied any coupon here!\')">');
                                /*$('#copn_input_spn').html('<input type="text" placeholder="Enter Coupon Code" readonly name="copn_code" id="copn_code" class="input-text" style="width:250px;">');*/
                            }
                        }
                    }
                });
            }


            function show_onlinepayment() {
                $.ajax({
                    url: '<?php echo base_url(); ?>mycart/load_ccavnue',
                    method: 'post',
                    data: {adj_type: 'O'},
                    success: function (result) {
                        //$('#ajxtst').html(result);
                        $('#payment_cod_div').css('display', 'none');
                        $('#payment_gv_div').css('display', 'none');
                        $('#payment_div_wallet').css('display', 'none');
                        $('#payment_copn_div').css('display', 'none');
                        $('#onlinepay_div').html(result);
                        $('#onlinepay_div').css('display', 'block');
                        $('#onlinr_pymt_link').html('<a  onClick="alert(\'You can use online payment option once in an order.\');" style="cursor:pointer;"> <i class="fa fa-credit-card"></i> PAY BY ONLINE </a>');
                    }
                });
            }


            function pay_by_cod()
            {
                alert('Currently COD Service not available to your location,Please go for Online Payment');
                $('#payment_div').css('display', 'block');
                $('#onlinepay_div').css('display', 'block');
                $('#payment_div_wallet').css('display', 'none');
                $('#payment_gv_div').css('display', 'none');
                $('#payment_copn_div').css('display', 'none');

                //var r=confirm('Currently COD Service not available,Please go for Online Payment');
        //	if (r == true) {
        //   show_onlinepayment();
        //} else if (r == false) {

        //}
                //cheackInventory();return false;
                /*$('#payment_div').css('display','block');
                 $('#payment_gv_div').css('display','none');
                 $('#onlinepay_div').css('display','none');
                 $('#payment_copn_div').css('display','none');
                 $('#payment_div_wallet').css('display','none');
                 $('#payment_cod_div').css('display','block');*/
            }
        </script>


        <!------ Start Content ------>
    <div class="main-content">
    <!--<ul class="back"> <li><i class="back_arrow"> </i>Back to <a href="index.html">Men's Clothing</a></li> </ul>-->
        <div class="cont">
            <div  class="checkout">
                <?php
                if ($cus_data != "") {
                    $address_id = $cus_data->address_id;
                    ?>

                    <h4 class="title2"> YOUR SHIPPING ADDRESS </h4>
                    <table width="100%" class="delivry-adrs">
                        <?php /* ?><tr>
                          <td>LOGIN ID</td>
                          <td><div style="font-size:20px; font-weight:bold"> <?php echo $cus_data->email;  ?> </div> </td>
                          </tr>
                          <tr><td>PHONE NUMBER</td><td><span style="font-size:20px; font-weight:bold"><?php echo "  ". $cus_data->mob;  ?></span></td></tr>
                          <tr><?php */ ?>
                        <tr>
                            <td valign="top">

                                <span style="font-size:14px; "><b style="font-size:18px;"> <?php echo $cus_data->full_name; ?></b><br>
                                    <?php echo $cus_data->city; ?> ,
                                    <?php echo $cus_data->state_name; ?> ,
                                    <?php echo $cus_data->country; ?> ,
                                    <?php echo $cus_data->pin_code; ?> ,
                                    <?php echo $cus_data->phone; ?><br>
                                </span>

                                <?php echo $cus_data->address; ?>
                            </td>
                            <td colspan="2" align="center"><a class='inline' href="#inline_content_add_address"><button class="button btn-cart-big" type="button"> <i class="fa fa-plus-square"></i>
                                        Add New Address</button></a></td>
                        </tr>
                    </table>
                <?php } else { ?>
                    <span style="font-size:20px; color:#F00"> You have not complete your personal information & <a class='inline' href="#inline_content_add_address">Address</a> in your account 
                        <script>
                            $(document).ready(function () {
                                $('#proceed_to_pay').hide();
                                $('#proceed_to_pay_dis').show();
                                $('#addrs_confrm_dv').show();
                                $.colorbox({inline: true, href: "#inline_content_add_address"});
                                //$(".inline").colorbox({inline:true, href:"#inline_content_add_address"});

                            });
                        </script>

                    </span>
                <?php } ?>
            </div>
            <div class="line">&nbsp;</div>

            <div class="address_dv">
                <?php
                if ($address_result != '') {
                    $sl = 0;
                    foreach ($address_result as $row_addrss) {
                        $sl++;
                        ?>
                        <div class="multi_address_dv_inn">
                            <a class='inline blue-sml-btn' href="#inline_content_edit_address<?= $sl; ?>" style="float:right;">  Edit <i class="fa fa-pencil" style="font-size:10px;"></i></a>
                            <strong><?= $row_addrss->full_name; ?></strong><br>
                            <span><?= $row_addrss->address; ?></span><br>
                            <span><?= $row_addrss->city . '-' . $row_addrss->pin_code; ?></span>,
                            <span><?= $row_addrss->state_name . ',' . $row_addrss->country; ?></span><br>
                            <span>Ph : <?= $row_addrss->phone; ?></span><br><br>
                            <span class="filter-form" >
                                <label class="radio">
                                    <input type="radio" onclick="setDefaultaddress(<?= $row_addrss->address_id; ?>)" <?php if ($cus_data != "") {
                    if ($address_id == $row_addrss->address_id) {
                        echo 'checked';
                    }
                } ?> name="addrs"> <i></i> Default Address </label> 
        <?php if ($cus_data != "") {
            if ($address_id != $row_addrss->address_id) { ?>
                                        <span  onclick="deleteAddress(<?php echo $row_addrss->address_id; ?>,<?= $sl; ?>)" class="del<?= $sl; ?> del gray-sml-btn"> <i class="fa fa-trash-o"></i>
                                            Delete address</span>
            <?php }
        } ?>
                            </span>
                        </div>    

                        <div style="display:none">
                            <div id="inline_content_edit_address<?= $sl; ?>" style="padding:10px; background:#fff;">
                                <div class="edit_address_dv">
                                    <h4 class="title6 sn">Edit the shipping address</h4>
                                    <div class="col-md-12">
                                        <table class="edit_address_form">
                                            <tr>
                                                <td width="150px">Name</td>
                                                <td>
                                                    <input type="text" class="input-text" name="full_name" id="full_name<?= $sl; ?>" value="<?= $row_addrss->full_name; ?>" placeholder="Name">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Country</td>
                                                <td>
                                                   <!-- <select id="country<?//=$sl; ?>" name ="country" class="input-text"></select>
                                                     <script language="javascript">
                                                        //populateCountries("country", "state");
                                                        populateCountries("country<?//=$sl; ?>");
                                                    </script>-->
        <?= $row_addrss->country; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>State</td>
                                                <td>
                                                    <select name ="state" id ="state<?= $sl; ?>" class="input-text">
                                                        <option value="">---select---</option>
        <?php foreach ($state_result as $state) { ?>
                                                            <option value="<?= $state->state_id; ?>" <?php if ($state->state_id == $row_addrss->state_id) {
                echo 'selected';
            } ?>><?= $state->state; ?></option>
        <?php } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>City</td>
                                                <td>
                                                    <input type="text" class="input-text" name="city" id="city<?= $sl; ?>" value="<?= $row_addrss->city; ?>" placeholder="City">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Street Address</td>
                                                <td>
                                                    <textarea class="input-text" name="street_addrs" id="street_addrs<?= $sl; ?>" placeholder="Address"><?= $row_addrss->address; ?></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pincode</td>
                                                <td>
                                                    <input type="text" class="input-text" name="pincode" id="pincode<?= $sl; ?>" value="<?= $row_addrss->pin_code; ?>" placeholder="Pincode">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mobile Number</td>
                                                <td>
                                                    <input type="text" class="input-text" name="mobile" maxlength="10" value="<?= $row_addrss->phone; ?>" id="mobile<?= $sl; ?>" placeholder="Mobile">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <input  type="submit" id="address_btn<?= $sl; ?>" onClick="updateAddress(<?= $sl; ?>,<?= $row_addrss->address_id; ?>)" class="btn-sign-in" value="Save Changes">
                                                </td>
                                            </tr>
                                        </table>

                                    </div>

                                </div>
                            </div>
                        </div>



        <?php
    } //End of foreach loop
} //End of if ccondition
?>
            </div>
            <div class="clearfix"></div>

            <div class="line">&nbsp;</div>

            <div  class="checkout" >

                <h3 class="title3" style="text-transform:capitalize;"> Order Summary </h3>

                <table width="100%" border="0" cellspacing="5">
                    <thead class="tbl-title"> 
                        <tr>
                            <td width="40%"> Item </td>
                           <!-- <td width="26%">Item Detail </td> -->
                            <td width="10%"> Qty </td>
                            <td width="15%"> Price </td>
                            <td width="20%"> Delivery Details  </td>
                            <td width="15%"> Sub Total </td>
                        </tr>
                    </thead>
                    <?php
                    $seller_id_arr = array();
                    $addtocart_id_arr = array();
                    $tax_arr = array();
                    $shipping_fees_arr = array();
                    $sub_total_arr = array();
                    $qantity_arr = array();
                    $sku_arr = array();
                    $price_arr = array();
                    $color_arr = array();
                    $size_arr = array();

                    $total_price = 0;

                    foreach ($cart_data->result() as $rec_cart) {
                        ?>
                        <tr>

                            <td> <div class="checkout-img">  
                                    <?php
                                    //$image_cart=explode(',',$rec_cart->imag);
                                    $qr1 = $this->db->query("select a.imag,b.sku,c.name,b.product_id from product_image a inner join product_master b on a.product_id=b.product_id inner join product_general_info c on b.product_id=c.product_id where a.product_id='$rec_cart->product_id'");
                                    $rw1 = $qr1->row();
                                    $image_cart = explode(',', $rw1->imag);
                                    ?> <a href="<?php echo base_url() . 'product_description/product_detail/' . preg_replace('#/#', "-", str_replace(" ", "-", strtolower($rw1->name))) . '/' . $rw1->product_id . '/' . $rw1->sku ?>" target="_blank"><img src="<?php echo base_url() . 'images/product_img/' . 'catalog_' . $image_cart[0]; ?>"  width="30"></a></div>
                                <div class="chckout-desc"> 
                                    <?php
                                    $qr2 = $this->db->query("select name from product_general_info where product_id='$rec_cart->product_id'");
                                    $rw2 = $qr2->row();
                                    // echo "<h3  class='product-name'>". $rw2->name ."</h3>" ;

                                    echo "<h3  class='product-name'>" . "<a href=" . "'" . base_url() . 'product_description/product_detail/' . preg_replace('#/#', "-", str_replace(" ", "-", strtolower($rw1->name))) . "/" . $rw1->product_id . "/" . $rw1->sku . "'" . " target=_blank>" . $rw2->name . "</a>" . "</h3> ";

                                    if ($rec_cart->prdt_color != '') {
                                        $color_val = $rec_cart->prdt_color;
                                        echo "<span class='cart_attr'>Color : " . $rec_cart->prdt_color . '</span><br/>';
                                    } else {
                                        $color_val = 'not';
                                    }
                                    array_push($color_arr, $color_val);

                                    if ($rec_cart->prdt_size != '') {
                                        $size_val = $rec_cart->prdt_size;
                                        echo "<span class='cart_attr'>Size : " . $rec_cart->prdt_size . '</span><br/>';
                                    } else {
                                        $size_val = 'not';
                                    }
                                    array_push($size_arr, $size_val);

                                    $query_sellername = $this->db->query("select a.business_name,a.seller_id from seller_account_information a inner join product_master b on a.seller_id=b.seller_id  where b.sku='$rec_cart->sku'  ");
                                    $count_row = $query_sellername->num_rows();

                                    $seller_id_arr_row = $query_sellername->row();
                                    //echo $seller_id_arr_row->seller_id;
                                    array_push($seller_id_arr, $seller_id_arr_row->seller_id); //seller_id array

                                    if ($count_row != 0) {
                                        $rw_sellername = $query_sellername->row();
                                        //echo  $count_row. '<br>';
//    print_r($rw_sellername->business_name);}
                                        ?>
        <?php /* ?> <a onClick="gosellerReview(<?= $rw_sellername->seller_id; ?>)" id="goslr" style="cursor:pointer !important;"><?php */ ?>
                                        <a href="<?php echo base_url(); ?>sellers/<?= base64_encode($this->encrypt->encode($rw_sellername->seller_id)); ?>" id="goslr" style="cursor:pointer !important;">
        <?php
        echo "Seller :" . "<span class='blue'>" . $rw_sellername->business_name . "</span>";
    } else {
        echo "Seller : moonboy";
    }
    ?>
                                    </a>

    <!--  <div class="fulfill"> <img src="<?//php echo base_url()?>images/moon-fulfilled.png"  alt="">  </div>-->

                                </div>
                                <div class="clearfix"> &nbsp;</div>

                                <span class="item-no"> <i class="fa fa-check-square-o"></i> 100% Refund / Replacement Guarantee*  </span>
                            <!--<a href="<?php // echo base_url().'mycart/remove_from_cart/'.$rec_cart->addtocart_id ?>" class="orange right"> <i class="fa fa-times-circle">  </i> Remove </a>-->

                                <span style="cursor:pointer;" onClick="removeFromCart('<?= $rec_cart->addtocart_id ?>')" class="orange right"> <i class="fa fa-times-circle">  </i> Remove </span> 

                                <div class="clearfix"></div>
                            </td>
                          <!--  <td>
                                <?php /* $qr2=$this->db->query("select description from product_general_info where product_id='$rec_cart->product_id'");
                                  $rw2=$qr2->row();
                                  echo  $rw2->description;
                                 */
                                ?>
                            
                            </td> -->
                            <td align="center"> <?php
                                    $user_id = $this->session->userdata['session_data']['user_id'];
                                    $qr2 = $this->db->query("select * from addtocart_temp where product_id='$rec_cart->product_id' and user_id='$user_id' and sku='$rec_cart->sku' ");
                                    $rec_ct = $qr2->num_rows();
                                    echo $rec_ct;
                                    array_push($qantity_arr, $rec_ct);
                                    ?>
                            </td>
                            <td  align="center">  
                                <h4> Rs. <?php
                                    $user_id = $this->session->userdata['session_data']['user_id'];
                                    $qr3 = $this->db->query("select * from addtocart_temp where product_id='$rec_cart->product_id' and user_id='$user_id' and sku='$rec_cart->sku'  ");
                                    //$row3=$qr3->row();
                                    $price = 0;
                                    $ct_rec = $qr3->num_rows();
                                    foreach ($qr3->result() as $rw_price) {

                                        $qr4 = $this->db->query("select * from product_master where sku='$rw_price->sku' ");
                                        $rec4 = $qr4->result();

                                        $cdate = date('Y-m-d');
                                        $special_price_from_dt = $rec4[0]->special_pric_from_dt;
                                        $special_price_to_dt = $rec4[0]->special_pric_to_dt;

                                        //calculatin tax amount//
                                        //$tax_class = $rec4[0]->tax_class;
                                        //$tax_sql = $this->db->query("SELECT tax_rate_percentage FROM tax_management WHERE tax_id='$tax_class'");
                                        // $tax_res = $tax_sql->row();
                                        //$tax_persent = $tax_res->tax_rate_percentage;
                                        $tax_persent = $rec4[0]->tax_amount;
                                        $taxdecimal = $tax_persent / 100;

                                        //array_push($tax_arr,$taxdecimal);
                                        //tax amount for product price
                                        $tax_amount = $rec4[0]->price * $taxdecimal;

                                        //tax amount for product special price
                                        $tax_amount_special = $rec4[0]->special_price * $taxdecimal;

                                        //tax amount for product mrp price
                                        $tax_amount_mrp = $rec4[0]->mrp * $taxdecimal;
                                        ///calculating tax amount script end here///

                                        if ($rec4[0]->special_price != 0) {
                                            if ($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt) {
                                                array_push($tax_arr, $tax_amount_special * $rec_ct);

                                                $price = $price + $rec4[0]->special_price;
                                            } else {
                                                //array_push($tax_arr,$tax_amount*$rec_ct);
                                                //$price= $price + $rec4[0]->price;
                                                if ($rec4[0]->price != 0) {
                                                    array_push($tax_arr, $tax_amount * $rec_ct);
                                                    $price = $price + $rec4[0]->price;
                                                } else {
                                                    array_push($tax_arr, $tax_amount_mrp * $rec_ct);
                                                    $price = $price + $rec4[0]->mrp;
                                                }
                                            } //End of date condition
                                        } else {
                                            //array_push($tax_arr,$tax_amount*$rec_ct);
                                            //$price= $price + $rec4[0]->price;

                                            if ($rec4[0]->price != 0) {
                                                array_push($tax_arr, $tax_amount * $rec_ct);
                                                $price = $price + $rec4[0]->price;
                                            } else {
                                                array_push($tax_arr, $tax_amount_mrp * $rec_ct);
                                                $price = $price + $rec4[0]->mrp;
                                            }
                                        } //End of date special_price!=0 condition
                                    }
                                    echo $final_price = ceil($price / $ct_rec);
                                    array_push($price_arr, $final_price);
                                    ?> </h4>  </td>
                            <td align="center">
                                <h5 class="price-blue">

                                    <?php
                                    /* foreach($shipping_fee_data as $k => $v){
                                      if($k == $rw_sellername->seller_id){ array_push($shipping_fees_arr,$v*$rec_ct); echo $v*$rec_ct ;}
                                      } */

                                    array_push($shipping_fees_arr, $rec4[0]->shipping_fee_amount * $rec_ct);
                                    if ($rec4[0]->shipping_fee_amount != 0) {
                                        echo 'Shipping Fees Rs.' . $rec4[0]->shipping_fee_amount * $rec_ct;
                                    }
                                    ?>
                                </h5> 

                                <span class="item-no">
                                    <?php
                                    $qr11 = $this->db->query("SELECT c.dispatch_days
		FROM seller_account a 
		INNER JOIN state b ON a.seller_state = b.state
		INNER JOIN dispatched_day_setting c ON b.state_id = c.state_id
		WHERE a.seller_id = '$rw_sellername->seller_id'");
                                    $ct11 = $qr11->num_rows();
                                    $res11 = $qr11->row();
                                    if ($ct11 > 0) {
                                        $days = $res11->dispatch_days + 5;

                                        
                                        $dt = date('d M', strtotime(+$days . 'days'));
                                        echo "STANDARD DELIVERY BY " . $dt;
                                    } else {

                                        $dt1 = date('d M', strtotime(+'12 days'));
                                        echo $dt1;
                                        //echo "Standard delivery by 10-12 Days";
                                    }
                                    ?>
                                </span>
                            </td>
                            <td align="center">
                                <span class="price-blue"> 
                                    Rs. &nbsp; 
    <?php
    $subtotal_price = 0;

    echo $subtotal_price = $subtotal_price + $rec4[0]->shipping_fee_amount * $rec_ct + ceil($price);
    array_push($sub_total_arr, $subtotal_price);
    ?>
                                </span>
                            </td>

     <!--<td> <div class="checkout-img"> <img src="<?php //echo base_url()  ?>images/1.jpg" width="30"> </div>
     <div class="chckout-desc"> Elegant Women Vintage Floral Crochet Cocktail <br> Bodycon Dress   Color : Black, Size : Free Size </div>
     <div class="clearfix"></div>
     </td>
     <td> <select> 
            <option>1 </option>
            <option>2 </option>
            <option>3 </option>
            <option>4 </option>
            <option>5 </option>
          </select>
     </td>
     <td>  <h4 class="catalog-price"> Rs. 1049.00  </h4>  </td>
     <td> Standard delivery: FREE  </td>
     <td> <h4 class="catalog-price"> Rs. 1049.00 </h4></td>
     <td> <a href="#"> Remove </a>  <br>
       <a href="#"> Save for later </a> </td>-->
                        </tr><?php
    $total_price = ceil($total_price + $subtotal_price);

    array_push($addtocart_id_arr, $rec_cart->addtocart_id);
    // echo $rec_cart->sku;
    array_push($sku_arr, $rec_cart->sku);
}
?>
                    <tr><td colspan='5' align="right">Total Amount : <span  style="font-size:18px; font-weight:bold;"> Rs. <?php echo " " . $total_price; ?> </span> </td></tr>
                </table>

            </div>

            <div class="clearfix">&nbsp;</div>&nbsp;&nbsp;&nbsp; 

            <!-- <div class="col-sm-3 discont-code" > 
             <div class="btn-bg"> <h4 class="title-sml"> Discount Codes </h4> </div>
             <p> <strong>Enter your coupon code if you have one.</strong>
             <input type="text" placeholde="type your coupon code Here"  class="discount"> 
             
               <a href="#" class="btn1 btn-primary1"> <span>Apply Coupon</span> </a> </p>
               
              </div>
             
             <div class="col-md-3 discont-code" > 
             <div class="btn-bg">  <h4 class="title-sml"> Estimate Shipping and Tax </h4> </div>
             <p> 
             <strong>Enter your destination to get a shipping estimate.</strong>  <br> 
               *Country <input type="text" placeholde="type your coupon code Here"  class="discount">  <br>
               State/Province <input type="text" placeholde="type your coupon code Here"  class="discount">  <br>
               Zip/Postal Code <input type="text" placeholde="type your coupon code Here"  class="discount">  <br>
             
             <a href="#" class="btn1 btn-primary1"> <span> Get A Quote </span> </a> 
             </p>
              </div>-->
<?php
$rw_ct = $cart_data->num_rows();
if ($rw_ct != 0) {
    ?>
                <div  class="col-md-6 cart-btns"> 
                    <!-- <button id="proceed_to_pay" type="button" title="Proceed To Pay" class="btn-big2"  onClick="pay()"> Proceed To Pay </button> -->

    <!--<button id="proceed_to_pay" type="button" title="Proceed To Pay" class="btn-big2"  onClick="pay('<?php // echo json_encode($sku_arr); ?>','<?php // echo json_encode($qantity_arr); ?>')"> Proceed To Pay </button> -->


                    <button id="proceed_to_pay" type="button" title="Proceed To Pay" class="btn-big2"  onClick="pay()"> Proceed To Pay </button>

                    <button id="proceed_to_pay_dis" onClick="alert('First you have to complete your personal information.')" type="button" title="Proceed To Pay" class="btn-big2"> Proceed To Pay </button>
                    <div id="addrs_confrm_dv" style="display:none;">
                        <span style="font-size:18px; color:#F00;">You have not complete your personal information & <a class='inline' href="#inline_content_add_address">Address</a> in your account</span>
                    </div>

<?php } else { ?>
                    <button id="proceed_to_pay" type="button" title="Continue Shopping" class="button btn-cart-big"  onClick="window.location.href = '<?php echo base_url(); ?>'" > <i class="fa fa-angle-double-left"></i> Continue Shopping  </button>
<?php } ?>


<!--<p> <a href="#"> <h4> <u> Checkout with Multiple Addresses </u> </h4> </a> </p>-->

            </div>
            <span id="ajxtst"></span>

            <div class="clearfix">&nbsp;</div>


            <div id="payment_div"> 
              <!--<span class="adjst_summery_icn" onClick="shoeAdjustSummery()"><i class="fa fa-list-alt"></i></span>-->
                <!--<div class="left-nav">-->
                <div class="category category_pay">
                    <h4> Payment Mode </h4>
                    <ul>
                        <li><a id="wallet_link" onClick="pay_by_wallet();
        " style="cursor:pointer;" > <span class="wallet"> &nbsp;</span> PAY BY WALLET </a></li>
                        <li><a  onClick="PayByGV()" style="cursor:pointer;" > <i class="fa fa-gift"></i> Gift Voucher </a></li>
                        <li><a onClick="PayByCoupon()" style="cursor:pointer;" > <i class="fa fa-credit-card-alt"></i> Use Coupon </a></li>
                        <li id="onlinr_pymt_link"> <a  onClick="show_onlinepayment();" style="cursor:pointer;"> <i class="fa fa-credit-card"></i> PAY BY ONLINE </a> </li>
                        <li><a id="cod_link" onClick="pay_by_cod();
        DrawCaptcha();" style="cursor:pointer;" > <i class="fa fa-inr"></i> COD </a></li>
                    </ul>
                </div>

                <div id="payment_cod_div">
                    <h4> Pay using Cash-on-Delivery </h4> 
                    <div class="captcha">
                        <table width="100%">
                            <tr>
                                <td width="55%">
                                    <strong> Verify Order </strong> <br>
                                    Type the characters you see in the image on the left.<br/><br/>
                                    <input type="text" id="txtCaptcha"/>
                                    <button id="btnrefresh" onclick="DrawCaptcha();"> <i class="fa fa-refresh"></i> </button>
                                    <input type="text" id="txtInput" class="captcha-input" placeholder="Enter the above code Here"/>
                                </td>
                                <td width="45%" class="rht_td">
                                    Amount Payable <br/><strong>Rs.<?php echo " " . $total_price; ?></strong>
                                </td>
                            </tr>

                        </table>

                        <button id="proceed_to_pay" type="button" title="Add to Cart" class="button btn-cart-big" onClick="ValidCaptcha('<?php echo implode('-', $addtocart_id_arr) ?>',<?php echo $total_price ?>, '<?php echo implode('-', $seller_id_arr) ?>', '<?php echo implode('-', $tax_arr) ?>', '<?php echo implode('-', $shipping_fees_arr) ?>', '<?php echo implode('-', $sub_total_arr) ?>', '<?php echo implode('-', $qantity_arr) ?>', '<?php echo implode('*', $sku_arr) ?>', '<?php echo $cus_data->address_id ?>', '<?php echo implode('-', $price_arr); ?>', '<?php echo implode('-', $color_arr); ?>', '<?php echo implode('-', $size_arr); ?>')" >Confirm your Order</button>

                        <?php
                        

                        $dt = preg_replace("/[^0-9]+/", "", date('Y-m-d H:i:s'));

                        $ccavenue_order_id = $this->session->userdata['session_data']['user_id'] . implode('', $addtocart_id_arr) . $dt;

                        $moonboy_trans_id = random_string('numeric', 2) . $dt;


                        $this->session->set_userdata('sessccavenue_order_id', $ccavenue_order_id);

                        $this->session->set_userdata('sessmoonboy_trans_id', $moonboy_trans_id);

                        $this->session->set_userdata('sessaddtocart_id_arr', implode('-', $addtocart_id_arr));

                        $this->session->set_userdata('sesstotal_price', $total_price);

                        $this->session->set_userdata('sessseller_id_arr', implode('-', $seller_id_arr));

                        $this->session->set_userdata('sesstax_arr', implode('-', $tax_arr));

                        $this->session->set_userdata('sessshipping_fees_arr', implode('-', $shipping_fees_arr));

                        $this->session->set_userdata('subtotal_arr', implode('-', $sub_total_arr));

                        $this->session->set_userdata('price_arr', implode('-', $price_arr));

                        $this->session->set_userdata('sessqantity_arr', implode('-', $qantity_arr));

                        $this->session->set_userdata('sesssku_arr', implode('*', $sku_arr));

                        $this->session->set_userdata('sesscus_data', $cus_data->address_id);

                        $this->session->set_userdata('color_arr', implode('-', $color_arr));

                        $this->session->set_userdata('size_arr', implode('-', $size_arr));
                        ?>

                    </div>

                </div>


                <div id="onlinepay_div" style="display:none;" align="center"></div>


                <!-- </div>--left nav>
                 
                <!--<div class="line">&nbsp;</div>-->

                <!-- end main content -->


                <!-- wallet payment div start -->
                <div id="payment_div_wallet">
                    <h4> Pay By M-Wallet </h4>
                    <div class="wallet_div_inn">
<?php
$user_id = $this->session->userdata['session_data']['user_id'];
$query_wallet = $this->db->query("select * from wallet_info where user_id='$user_id'");

$row_wallet = $query_wallet->row();
@$curr_wallet_balance = $row_wallet->wallet_balance;
@$wallet_approve_status = $row_wallet->wallet_approve_status;
?>
                        <table width="100%">
                            <tr>
                                <td width="55%">
                                    <span class="wlt-amnt"> Total Wallet Balance: <?php if ($query_wallet->num_rows() != 0) {
    echo "<strong class='tw'>Rs." . $curr_wallet_balance . '</strong>';
} else {
    echo "<strong>Rs.0</strong>";
} ?> </span><hr/>
<?php if ($curr_wallet_balance < $total_price || $query_wallet->num_rows() == 0 || $wallet_approve_status == 'Not Approved') { ?>
                                        <strong style="text-align:center; color:#F00;">Cannot pay by wallet due to insufficient balance.</strong><br>	 
                                    <?php } else { ?>
                                        Enter Amount : <span id="wlt_input_spn"><input type="text" placeholder="Enter Wallet Amount" name="wallet_amt" id="wallet_amt" class="input-text" style="width:250px;"></span>
                                        <span id="wlt_btn_spn"><input type="button" value="APPLY" onClick="getWalletAmt('<?= $total_price; ?>', '<?= $curr_wallet_balance; ?>');" class="btn-big2"></span>
                                        <br/><span id="ajx_msg_spn"></span>
                                        <hr/>

                                        <span id="order_confirm_btn"></span>
                                        <button id="proceed_to_pay" type="button" class="button btn-cart-big order_confirn_disable_btn" onClick="alert('You payment adjustment is not complited. \n So, you can not confirm your order here.')">Confirm your Order</button>

<?php } ?>
                                </td>
                                <td width="45%" class="rht_td">
<?php if ($curr_wallet_balance < $total_price || $query_wallet->num_rows() == 0 || $wallet_approve_status == 'Not Approved') { ?>
                                        Amount Payable <br/><strong>Rs.<?php echo " " . $total_price; ?></strong>
<?php } else { ?>
                                        <span class="wlt-amnt"> Available Wallet Balance: <?php if ($query_wallet->num_rows() != 0) {
        echo "<strong id='avail_wlt_bal'>Rs." . $curr_wallet_balance . '</strong>';
    } else {
        echo "<strong>Rs.0</strong>";
    } ?> </span><hr/>
                                        <ul class="gftv_amt_list">
                                            <li>Deducted Wallet Balance : <span id="deduct_wallet"></span></li>
                                        </ul><hr/>
                                        <!--Amount Payable <br/><strong>Rs.<?php // echo " ". $total_price;  ?></strong>-->

                                        Amount Payable <br/><strong>Rs.<span id="amt_payble"><?php echo " " . $total_price; ?></span></strong>
                                        <span id="amt_payble_hidden"><?php echo " " . $total_price; ?></span>
<?php } ?>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>


                <!--Gift Voutcher Div Sart Here-->
                <div id="payment_gv_div">
                    <h4> Pay Using Gift Voutcher </h4>
                    <div class="gv_div_inn">
                        <table width="100%">
                            <tr>
                                <td width="55%">
                                    Gift Voutcher : <span id="vchr_input_spn"><input type="text" placeholder="Enter Gift Voutcher Number" name="gv_number" id="gv_number" class="input-text" style="width:250px;"></span>
                                    <span id="vchr_btn_spn"><input type="button" onClick="getVoucherAmt();" value="APPLY" class="btn-big2"></span>
                                    <br/><span id="ajx_msg_voucher_spn"></span>
                                    <table id="voucher_tbl"></table><hr/>
                                    <span id="order_confirm_btn_for_gv"></span>
                                    <button id="proceed_to_pay" type="button" class="button btn-cart-big order_confirn_disable_btn" onClick="alert('You payment adjustment is not complited. \n So, you can not confirm your order here.')">Confirm your Order</button>
                                </td>
                                <td width="45%" class="rht_td">
                                    Amount Payable <br/><strong>Rs.<span id="amt_payble_voucher"><?php echo " " . $total_price; ?></span></strong>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!--Gift Voutcher Div End Here-->

                <!--Coupon Div Sart Here-->
                <div id="payment_copn_div">
                    <h4> Pay Using Coupon </h4>
                    <div class="gv_div_inn">
                        <table width="100%">
                            <tr>
                                <td width="55%">
                                    Coupon Code : <span id="copn_input_spn"><input type="text" placeholder="Enter Coupon Code" name="copn_code" id="copn_code" class="input-text" style="width:250px;"></span>
                                    <span id="copn_btn_spn"><input type="button" value="APPLY" class="btn-big2 copn_aply_btn" onClick="getCouponAmt();"></span>
                                    <br/><span id="ajx_msg_copn_spn"></span>
                                    <table id="coupon_tbl"></table>
                                    <hr/>
                                    <span id="order_confirm_btn_for_copn"></span>
                                    <button id="proceed_to_pay" type="button" class="button btn-cart-big order_confirn_disable_btn" onClick="alert('You payment adjustment is not complited. \n So, you can not confirm your order here.')">Confirm your Order</button>
                                </td>
                                <td width="45%" class="rht_td">
                                    Amount Payable <br/><strong>Rs.<span id="amt_payble_copn"><?php echo " " . $total_price; ?></span></strong>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!--Coupon Div End Here-->

                <!--Adjustment summery Div start here-->
                <div class="adjust_summery">

                </div>
                <!--Adjustment summery Div end here-->

                <div class="clearfix"></div>  

                <!-- wallet payment div end -->   
            </div>  <!-- end warp -->
            <div class="wrng"><strong>Payment process should be completed within 15 minutes.</strong></div>



            <div style="display:none">
                <div id="inline_content_add_address" style="padding:10px; background:#fff;">
                    <div class="edit_address_dv">
                        <h4 class="title6 sn">Add new shipping address</h4>
                        <div class="col-md-12">
                            <table class="edit_address_form">
                                <tr>
                                    <td width="150px">Name</td>
                                    <td>
                                        <input type="text" class="input-text" name="full_name" id="full_name" placeholder="Name">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td>
                                        <select id="country" name ="country" class="input-text"></select>
                                        <script language="javascript">
                                            //populateCountries("country", "state");
                                            populateCountries("country");
                                        </script>
                                    </td>
                                </tr>
                                <tr>
                                    <td>State</td>
                                    <td>
                                        <select name ="state" id ="state" class="input-text">
                                            <option value="">---select---</option>
<?php foreach ($state_result as $state) { ?>
                                                <option value="<?= $state->state_id; ?>"><?= $state->state; ?></option>
<?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td>
                                        <input type="text" class="input-text" name="city" id="city" placeholder="City">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Street Address</td>
                                    <td>
                                        <textarea class="input-text" name="street_addrs" id="street_addrs" placeholder="Address"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pincode</td>
                                    <td>
                                        <input type="text" class="input-text" name="pincode" id="pincode" placeholder="Pincode">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Mobile Number</td>
                                    <td>
                                        <input type="text" class="input-text" name="mobile" maxlength="10" id="mobile" placeholder="Mobile">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input  type="submit" id="address_btn" onClick="addAddress()" class="btn-sign-in" value="Save Changes">
                                    </td>
                                </tr>
                            </table>

                        </div>

                    </div>
                </div>
            </div>


            <script>
                function deleteAddress(id, sl) {
                    $spn_id = '.del' + sl;
                    $($spn_id).text('deleting...');
                    $.ajax({
                        url: '<?php echo base_url(); ?>user/delete_address',
                        method: 'post',
                        data: {id: id},
                        success: function (result)
                        {
                            if (result == 'deleted') {
                                window.location.reload(true);
                            }
                        }
                    });
                }


                function setDefaultaddress(address_id) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>user/update_user_default_address',
                        method: 'post',
                        data: {id: address_id},
                        success: function (result)
                        {
                            if (result == 'success') {
                                window.location.reload(true);
                            }
                        }
                    });
                }
            </script>


            <!---- update address script start here ---->
            <script>
                function updateAddress(sl, address_id) {
                    var full_name = $('#full_name' + sl).val();
                    //var country = $('#country'+sl).val();
                    var state = $('#state' + sl).val();
                    var city = $('#city' + sl).val();
                    var address = $('#street_addrs' + sl).val();
                    var pin = $('#pincode' + sl).val();
                    var mob = $('#mobile' + sl).val();

                    if (full_name == '') {
                        $('#full_name' + sl).css('border-color', 'red');
                        alert('Name field is required.');
                        $('#full_name' + sl).focus();
                        return false;
                    } else if (country == '') {
                        $('#country' + sl).css('border-color', 'red');
                        alert('Country field is required.');
                        return false;
                    } else if (state == '') {
                        $('#full_name' + sl).css('border-color', '#ebebeb');
                        $('#country' + sl).css('border-color', '#ebebeb');
                        $('#state' + sl).css('border-color', 'red');
                        alert('State field is required.');
                        return false;
                    } else if (city == '') {
                        $('#full_name' + sl).css('border-color', '#ebebeb');
                        $('#country' + sl).css('border-color', '#ebebeb');
                        $('#state').css('border-color', '#ebebeb');
                        $('#city' + sl).css('border-color', 'red');
                        alert('City field is required.');
                        $('#city' + sl).focus();
                        return false;
                    }/*else if(address == ''){
                     $('#full_name'+sl).css('border-color','#ebebeb');
                     $('#country'+sl).css('border-color','#ebebeb');
                     $('#state'+sl).css('border-color','#ebebeb');
                     $('#city').css('border-color','#ebebeb');
                     $('#street_addrs'+sl).css('border-color','red');
                     alert('Address field is required.');
                     $('#street_addrs'+sl).focus();
                     return false;
                     }*/ else if (pin == '') {
                        $('#full_name' + sl).css('border-color', '#ebebeb');
                        $('#country' + sl).css('border-color', '#ebebeb');
                        $('#state' + sl).css('border-color', '#ebebeb');
                        $('#city' + sl).css('border-color', '#ebebeb');
                        $('#street_addrs' + sl).css('border-color', '#ebebeb');
                        $('#pincode' + sl).css('border-color', 'red');
                        alert('Pin code field is required.');
                        $('#pincode' + sl).focus();
                        return false;
                    } else if (isNaN(pin)) {
                        $('#full_name' + sl).css('border-color', '#ebebeb');
                        $('#country' + sl).css('border-color', '#ebebeb');
                        $('#state' + sl).css('border-color', '#ebebeb');
                        $('#city' + sl).css('border-color', '#ebebeb');
                        $('#street_addrs' + sl).css('border-color', '#ebebeb');
                        $('#pincode' + sl).css('border-color', 'red');
                        alert('Invalid pin code.');
                        $('#pincode' + sl).select();
                        return false;
                    } else if (mob == '') {
                        $('#full_name' + sl).css('border-color', '#ebebeb');
                        $('#country' + sl).css('border-color', '#ebebeb');
                        $('#state' + sl).css('border-color', '#ebebeb');
                        $('#city' + sl).css('border-color', '#ebebeb');
                        $('#street_addrs' + sl).css('border-color', '#ebebeb');
                        $('#pincode' + sl).css('border-color', '#ebebeb');
                        $('#mobile' + sl).css('border-color', 'red');
                        alert('Mobile number is required.');
                        $('#mobile' + sl).focus();
                        return false;
                    } else if (isNaN(mob)) {
                        $('#full_name' + sl).css('border-color', '#ebebeb');
                        $('#country' + sl).css('border-color', '#ebebeb');
                        $('#state' + sl).css('border-color', '#ebebeb');
                        $('#city' + sl).css('border-color', '#ebebeb');
                        $('#street_addrs' + sl).css('border-color', '#ebebeb');
                        $('#pincode' + sl).css('border-color', '#ebebeb');
                        $('#mobile' + sl).css('border-color', 'red');
                        alert('Invalide Mobile number.');
                        $('#mobile' + sl).select();
                        return false;
                    } else if (mob.length != 10) {
                        $('#full_name' + sl).css('border-color', '#ebebeb');
                        $('#country' + sl).css('border-color', '#ebebeb');
                        $('#state' + sl).css('border-color', '#ebebeb');
                        $('#city' + sl).css('border-color', '#ebebeb');
                        $('#street_addrs' + sl).css('border-color', '#ebebeb');
                        $('#pincode' + sl).css('border-color', '#ebebeb');
                        $('#mobile' + sl).css('border-color', 'red');
                        alert('Please enter 10 digit mobile number.');
                        $('#mobile' + sl).select();
                        return false;
                    } else {

                        $('#address_btn' + sl).val('Processing...');
                        $.ajax({
                            url: '<?php echo base_url(); ?>user/update_address',
                            method: 'post',
                            data: {
                                id: address_id,
                                name: full_name,
                                /*country:country,*/
                                state: state,
                                city: city,
                                address: address,
                                pin: pin,
                                mob: mob,
                            },
                            success: function (result)
                            {
                                //$('#address_btn'+sl).val(result);
                                if (result == 'updated') {
                                    window.location.reload(true);
                                }
                                if (result == 'not_update') {
                                    $('#address_btn' + sl).val('No Changes');
                                }
                            }
                        });
                    }
                }
            </script>
            <!---- update address script start here ---->

            <!---- add address script start here ---->
            <script>
                function addAddress() {
                    var full_name = $('#full_name').val();
                    var country = $('#country').val();
                    var state = $('#state').val();
                    var city = $('#city').val();
                    var address = $('#street_addrs').val();
                    var pin = $('#pincode').val();
                    var mob = $('#mobile').val();

                    if (full_name == '') {
                        $('#full_name').css('border-color', 'red');
                        alert('Name field is required.');
                        $('#full_name').focus();
                        return false;
                    } else if (country == '') {
                        $('#country').css('border-color', 'red');
                        alert('Country field is required.');
                        return false;
                    } else if (state == '') {
                        $('#full_name').css('border-color', '#ebebeb');
                        $('#country').css('border-color', '#ebebeb');
                        $('#state').css('border-color', 'red');
                        alert('State field is required.');
                        return false;
                    } else if (city == '') {
                        $('#full_name').css('border-color', '#ebebeb');
                        $('#country').css('border-color', '#ebebeb');
                        $('#state').css('border-color', '#ebebeb');
                        $('#city').css('border-color', 'red');
                        alert('City field is required.');
                        $('#city').focus();
                        return false;
                    } else if (address == '') {
                        $('#full_name').css('border-color', '#ebebeb');
                        $('#country').css('border-color', '#ebebeb');
                        $('#state').css('border-color', '#ebebeb');
                        $('#city').css('border-color', '#ebebeb');
                        $('#street_addrs').css('border-color', 'red');
                        alert('Address field is required.');
                        $('#street_addrs').focus();
                        return false;
                    } else if (pin == '') {
                        $('#full_name').css('border-color', '#ebebeb');
                        $('#country').css('border-color', '#ebebeb');
                        $('#state').css('border-color', '#ebebeb');
                        $('#city').css('border-color', '#ebebeb');
                        $('#street_addrs').css('border-color', '#ebebeb');
                        $('#pincode').css('border-color', 'red');
                        alert('Pin code field is required.');
                        $('#pincode').focus();
                        return false;
                    } else if (isNaN(pin)) {
                        $('#full_name').css('border-color', '#ebebeb');
                        $('#country').css('border-color', '#ebebeb');
                        $('#state').css('border-color', '#ebebeb');
                        $('#city').css('border-color', '#ebebeb');
                        $('#street_addrs').css('border-color', '#ebebeb');
                        $('#pincode').css('border-color', 'red');
                        alert('Invalid pin code.');
                        $('#pincode').select();
                        return false;
                    } else if (mob == '') {
                        $('#full_name').css('border-color', '#ebebeb');
                        $('#country').css('border-color', '#ebebeb');
                        $('#state').css('border-color', '#ebebeb');
                        $('#city').css('border-color', '#ebebeb');
                        $('#street_addrs').css('border-color', '#ebebeb');
                        $('#pincode').css('border-color', '#ebebeb');
                        $('#mobile').css('border-color', 'red');
                        alert('Mobile number is required.');
                        $('#mobile').focus();
                        return false;
                    } else if (isNaN(mob)) {
                        $('#full_name').css('border-color', '#ebebeb');
                        $('#country').css('border-color', '#ebebeb');
                        $('#state').css('border-color', '#ebebeb');
                        $('#city').css('border-color', '#ebebeb');
                        $('#street_addrs').css('border-color', '#ebebeb');
                        $('#pincode').css('border-color', '#ebebeb');
                        $('#mobile').css('border-color', 'red');
                        alert('Invalide Mobile number.');
                        $('#mobile').select();
                        return false;
                    } else if (mob.length != 10) {
                        $('#full_name').css('border-color', '#ebebeb');
                        $('#country').css('border-color', '#ebebeb');
                        $('#state').css('border-color', '#ebebeb');
                        $('#city').css('border-color', '#ebebeb');
                        $('#street_addrs').css('border-color', '#ebebeb');
                        $('#pincode').css('border-color', '#ebebeb');
                        $('#mobile').css('border-color', 'red');
                        alert('Please enter 10 digit mobile number.');
                        $('#mobile').select();
                        return false;
                    } else {

                        $('#address_btn').val('Processing...');
                        $.ajax({
                            url: '<?php echo base_url(); ?>user/save_address',
                            method: 'post',
                            data: {
                                name: full_name,
                                country: country,
                                state: state,
                                city: city,
                                address: address,
                                pin: pin,
                                mob: mob,
                            },
                            success: function (result)
                            {

                                if (result == 'saved') {
                                    window.location.reload(true);
                                }
                                if (result == 'not saved') {
                                    $('#address_btn').val('No Changes');
                                }
                            }
                        });

                    }
                }
            </script>
            <!---- add address script end here ---->

            <script>
                function pay()
                {
                    $('#proceed_to_pay').attr('disabled', true);
                    $('#proceed_to_pay').css('background-color', '#ccc');
                    $('#proceed_to_pay').css('border', 'none');

                    var sku_arr = <?php echo json_encode($sku_arr); ?>;
                    var qty_arr = <?php echo json_encode($qantity_arr); ?>;
                    /*var len = qty_arr.length;
                     alert(len);*/

                    var jsonSkuString = JSON.stringify(sku_arr);
                    var jsonQtyString = JSON.stringify(qty_arr);

                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>mycart/insert_into_checkout_temp",
                        data: {sku: jsonSkuString, qty: jsonQtyString, },
                        cache: false,
                        success: function (result) {
                            // $('#ajxtst').html(result);
                            if (result == 'success') {
                                $('.wrng').show(1000);
                                $('#payment_div').toggle(
                                        function () {
                                            $('#payment_div');
                                        }
                                );
                            }
                        }
                    });
                }
            //////////////

                /*function cheackInventory(){
                 var sku_arr = <?php // echo json_encode($sku_arr);  ?>;
                 var qty_arr = <?php // echo json_encode($qantity_arr);  ?>;
     
                 var jsonSkuString = JSON.stringify(sku_arr);
                 var jsonQtyString = JSON.stringify(qty_arr);
     
                 $.ajax({
                 type: "POST",
                 url: "<?php // echo base_url(); ?>mycart/check_inventory_befor_order",
                 data: {sku : jsonSkuString, qty : jsonQtyString}, 
                 cache: false,
                 success: function(result){
                 $('#ajxtst').html(result);
                 }
                 });
                 }*/
            </script>

            <script>
                function removeFromCart(add_to_cart_id) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>mycart/remove_from_cart_in_final',
                        method: 'post',
                        data: {cart_id: add_to_cart_id},
                        success: function (result) {
                            if (result == 'success') {
                                window.location.reload(true);
                            }
                        }
                    });
                }
            </script>

            <script>
                function getWalletAmt(payble_amt, total_wlt_bal) {
                    var deduct_amt = $('#wallet_amt').val();
                    var amt_payble_wallet = parseFloat($('#amt_payble').text());
                    //var amt_payble_wallet = parseFloat($('#amt_payble_hidden').text());
                    if (deduct_amt == '') {
                        alert('Please enter the amount.');
                        $('#wallet_amt').focus();
                        return false;
                    } else if (isNaN(deduct_amt)) {
                        alert('Please enter a valid amount.');
                        $('#wallet_amt').select();
                        return false;
                    } else {
                        var amt_payble = parseFloat(payble_amt - deduct_amt);
                        var avail_wlt_bal = total_wlt_bal - deduct_amt;
                        var rest_amt = parseFloat(amt_payble_wallet - deduct_amt);
                        $.ajax({
                            url: '<?php echo base_url(); ?>my_wallet/deduct_from_wallet',
                            method: 'post',
                            dataType: "json",
                            data: {total_payble: payble_amt, rest_payble: amt_payble_wallet, wallet_payble: deduct_amt},
                            success: function (result) {
                                $('#ajxtst').html(result);
                                if (result != 'Invalid') {
                                    //$('#avail_wlt_bal').html('Rs. '+avail_wlt_bal);
                                    //$('#deduct_wallet').html('Rs. '+deduct_amt);
                                    var avail_wlt_bal = total_wlt_bal - result.wlt_adj_amt;
                                    $('#avail_wlt_bal').html('Rs. ' + avail_wlt_bal);
                                    $('#deduct_wallet').html('Rs. ' + result.wlt_adj_amt);
                                    //$('#amt_payble').html(amt_payble);
                                    //$('#amt_payble').html(rest_amt);
                                    $('#amt_payble').html(payble_amt - result.total_adj_amt);

                                    //this is optional user can update his wallet balance
                                    $('#wlt_btn_spn').html('<input type="button" value="APPLY" class="btn-big2 copn_dis_btn" onClick="alert(\'You can use wallet balance once in an order !\')">');
                                    /*$('#wlt_input_spn').html('<input type="text" placeholder="Enter Wallet Amount" readonly name="wallet_amt" id="wallet_amt" class="input-text" style="width:250px;">');*/

                                    //if(amt_payble <= 0){
                                    if (rest_amt <= 0) {
                                        $('.order_confirn_disable_btn').hide();
                                        $('#ajx_msg_spn').hide();
                                        $('#order_confirm_btn').html("<button id=\"proceed_to_pay\" type=\"button\" onClick=\"payfrom_wallet('<?php echo implode('-', $addtocart_id_arr) ?>',<?php echo $total_price ?>,'<?php echo implode('-', $seller_id_arr) ?>','<?php echo implode('-', $tax_arr) ?>','<?php echo implode('-', $shipping_fees_arr) ?>','<?php echo implode('-', $sub_total_arr) ?>','<?php echo implode('-', $qantity_arr) ?>','<?php echo implode('*', $sku_arr) ?>', '<?php echo $cus_data->address_id ?>','<?php echo implode('-', $price_arr); ?>','<?php echo implode('-', $color_arr); ?>','<?php echo implode('-', $size_arr); ?>')\" class=\"button btn-cart-big\">Confirm your Order</button>");
                                    } else {
                                        $('#ajx_msg_spn').hide();
                                        $('.order_confirn_disable_btn').show();
                                        $('#order_confirm_btn').html(' ');
                                    }
                                }
                                if (result.status == 'Invalid') {
                                    $('#avail_wlt_bal').html('Rs. ' + total_wlt_bal);
                                    $('#deduct_wallet').html(' ');
                                    //$('#amt_payble').html(payble_amt);
                                    $('#amt_payble').html(amt_payble_wallet);
                                    $('.order_confirn_disable_btn').show();
                                    $('#order_confirm_btn').html(' ');
                                    $('#ajx_msg_spn').show();
                                    $('#ajx_msg_spn').text('Please enter a propper amount !');

                                    $('#wlt_btn_spn').html('<input type="button" value="APPLY" onClick="getWalletAmt(\'<?= $total_price; ?>\',\'<?= $curr_wallet_balance; ?>\');" class="btn-big2">');
                                }
                            }
                        });
                    }
                }
            </script>


            <script>
                /*Gift voucher script start here*/
                function getVoucherAmt() {
                    var voucher_no = $('#gv_number').val();
                    var amt_payble_voucher = parseFloat($('#amt_payble_voucher').text());
                    if (voucher_no == '') {
                        alert('Please enter a voucher number.');
                        $('#gv_number').focus();
                        return false;
                    } else {
                        $.ajax({
                            url: '<?php echo base_url(); ?>my_wallet/shop_from_voucher',
                            method: 'post',
                            data: {voucher_no: voucher_no, amt_payble_voucher: amt_payble_voucher},
                            success: function (result) {
                                //$('#ajxtst').html(result);
                                if (result == 'T') {
                                    $('#ajx_msg_voucher_spn').show();
                                    $('#ajx_msg_voucher_spn').text('This Voucher Is Temporary Blocked.');
                                } else if (result == 'P') {
                                    $('#ajx_msg_voucher_spn').show();
                                    $('#ajx_msg_voucher_spn').text('This Voucher Is Permanently Blocked.');
                                } else if (result == 'U') {
                                    $('#ajx_msg_voucher_spn').show();
                                    $('#ajx_msg_voucher_spn').text('This Voucher Is Already Used.');
                                } else if (result == 'Invalid') {
                                    $('#ajx_msg_voucher_spn').show();
                                    $('#ajx_msg_voucher_spn').text('This is not a Valid Voucher.');
                                } else {
                                    //var voucher_amt = parseFloat(result);
                                    //var rest_amt = parseFloat(amt_payble_voucher-voucher_amt);
                                    //$('#amt_payble_voucher').html(rest_amt);
                                    $('#voucher_tbl').html(result);
                                    var voucher_amt = parseFloat($('#voucher_tbl').find('td:last span').text());
                                    var rest_amt = parseFloat(amt_payble_voucher - voucher_amt);
                                    $('#amt_payble_voucher').html(rest_amt);
                                    $('#ajx_msg_voucher_spn').hide();

                                    if (rest_amt <= 0) {
                                        $('.order_confirn_disable_btn').hide();
                                        $('#ajx_msg_voucher_spn').hide();
                                        $('#order_confirm_btn_for_gv').html("<button id=\"proceed_to_pay\" type=\"button\" onClick=\"payment_confirm_from_voucher('<?php echo implode('-', $addtocart_id_arr) ?>',<?php echo $total_price ?>,'<?php echo implode('-', $seller_id_arr) ?>','<?php echo implode('-', $tax_arr) ?>','<?php echo implode('-', $shipping_fees_arr) ?>','<?php echo implode('-', $sub_total_arr) ?>','<?php echo implode('-', $qantity_arr) ?>','<?php echo implode('*', $sku_arr) ?>', '<?php echo $cus_data->address_id ?>','<?php echo implode('-', $price_arr); ?>','<?php echo implode('-', $color_arr); ?>','<?php echo implode('-', $size_arr); ?>')\" class=\"button btn-cart-big\">Confirm your Order</button>");
                                    } else {
                                        $('.order_confirn_disable_btn').show();
                                        $('#order_confirm_btn_for_gv').html(' ');
                                    }
                                }
                            }
                        });
                    }
                }
                /*Gift voucher script end here*/
            </script>

            <script>
                /*Coupon script start here*/
                function getCouponAmt() {
                    var copn_code = $('#copn_code').val();
                    var amt_payble_copn = parseFloat($('#amt_payble_copn').text());
                    if (copn_code == '') {
                        alert('Please enter your coupon code.');
                        $('#copn_code').focus();
                        return false;
                    } else {
                        $.ajax({
                            url: '<?php echo base_url(); ?>my_wallet/shop_from_coupon',
                            method: 'post',
                            data: {copn_code: copn_code, amt_payble_copn: amt_payble_copn},
                            success: function (result) {
                                //$('#ajxtst').html(result);
                                if (result == 'T') {
                                    $('#ajx_msg_copn_spn').show();
                                    $('#ajx_msg_copn_spn').text('This Coupon Is Temporary Blocked.');
                                } else if (result == 'P') {
                                    $('#ajx_msg_copn_spn').show();
                                    $('#ajx_msg_copn_spn').text('This Coupon Is Permanently Blocked.');
                                } else if (result == 'U') {
                                    $('#ajx_msg_copn_spn').show();
                                    $('#ajx_msg_copn_spn').text('This Coupon Is Already Used.');
                                } else if (result == 'Invalid') {
                                    $('#ajx_msg_copn_spn').show();
                                    $('#ajx_msg_copn_spn').text('This is not a Valid Coupon.');
                                } else {
                                    $('#coupon_tbl').html(result);
                                    var copn_amt = parseFloat($('#coupon_tbl').find('td:last span').text());
                                    var rest_amt = parseFloat(amt_payble_copn - copn_amt);
                                    $('#amt_payble_copn').html(rest_amt);
                                    $('#ajx_msg_copn_spn').hide();
                                    $('#copn_btn_spn').html('<input type="button" value="APPLY" class="btn-big2 copn_dis_btn" onClick="alert(\'You can use only one coupon for an order!\')">');
                                    /*$('#copn_input_spn').html('<input type="text" placeholder="Enter Coupon Code" readonly name="copn_code" id="copn_code" class="input-text" style="width:250px;">');*/

                                    if (rest_amt <= 0) {
                                        $('.order_confirn_disable_btn').hide();
                                        $('#ajx_msg_copn_spn').hide();
                                        $('#order_confirm_btn_for_copn').html("<button id=\"proceed_to_pay\" type=\"button\" onClick=\"payment_confirm_from_voucher('<?php echo implode('-', $addtocart_id_arr) ?>',<?php echo $total_price ?>,'<?php echo implode('-', $seller_id_arr) ?>','<?php echo implode('-', $tax_arr) ?>','<?php echo implode('-', $shipping_fees_arr) ?>','<?php echo implode('-', $sub_total_arr) ?>','<?php echo implode('-', $qantity_arr) ?>','<?php echo implode('*', $sku_arr) ?>', '<?php echo $cus_data->address_id ?>','<?php echo implode('-', $price_arr); ?>','<?php echo implode('-', $color_arr); ?>','<?php echo implode('-', $size_arr); ?>')\" class=\"button btn-cart-big\">Confirm your Order</button>");
                                    } else {
                                        $('.order_confirn_disable_btn').show();
                                        $('#order_confirm_btn_for_copn').html(' ');
                                    }
                                }
                            }
                        });
                    }
                }
                /*Coupon script end here*/
            </script>
        </div>

        <style>
            #proceed_to_pay_dis{
                background:#ccc;
                border:1px solid #ccc;
                display:none;
            }
        </style>

        <!-- footer Section -->
<?php include "footer.php"; ?>
