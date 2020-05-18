<?php
require_once('header.php');
?>
<style>
    .main-content {margin-top: 65px;}
    .no_pad{
        padding:0px !important;
    }
    .no_lmargin{
        margin-left:0px !important;
    }
    .no_margin{
        margin:0px !important;
    }

    /*    .chk_box_td{width:30px !important;}
        .slr_name{width:120px !important;}
        .slr_id{width:80px !important;}
        .sale_value{width:95px !important;}
        .order_id{width:230px !important;}
        .order_status{width:160px !important;}
        .fixed_charges{width:90px !important;}
        .seasonal_charges{width:90px !important;}
        .pg_charges{width:90px !important;}
        .commission{width:90px !important;}
        .service_tax{width:90px !important;}
        .penalty{width:90px !important;}
        .settlement_amount{width:90px !important;}
        .discount{width:90px !important;}
        .final_setllement_amount{width:90px !important;}*/

</style>
<div id="content">
    <div class="top-bar">
        <div class="top-left">
            <?php include 'sub_payment.php'; ?>
        </div>
        <div class="top-right">
            <?php include 'top_right.php'; ?>
        </div>
    </div>  <!-- @end top-bar  -->

    <div class="main-content">
        <div class="row content-header">
            <div class="col-md-12 no_pad no_margin"> <h3 class="no_pad no_margin">Payout</h3> </div>            
        </div>
        <div class="row">
            <form id="payout_form" action="<?php echo base_url() . 'admin/payment/update_transaction_data' ?>" method="post" >
                <div class="row">
                    <div class="col-md-6 no_pad">
                        <?php
                        if ($payout_result) {
                            ?> 
                            <input type="button" class="all_buttons no_lmargin" id="payout_generate" name="payout_generate" value="Generate Payout" style="float:left !important;">
                        <?php } else { ?>
                            <input type="button" class="all_buttons_disable" value="Generate Payout" style="float:left !important;" onClick="alert('No data available for Payout Generation.')">
                        <?php } ?>
                        <input type="button" class="all_buttons" name="export_excl" value="Export Payout" onClick="exportPayoutReport()" style="float:left !important;">
                        <input type="button" class="all_buttons" name="export_excl" value="Export Seller Payout" onClick="exportSlrPayoutReport()" style="float:left !important;">
                        <span style="float:right; color:#090;"><?= $this->session->flashdata('succ_msg'); ?></span>
                        <span style="float:right; color:red;"><?= $this->session->flashdata('error_msg'); ?></span>
                        <span id="show_selected_items" style="float:right; color:#090;display: none;"></span>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 no_pad">
                        <table class="table table-bordered table-hover">
                            <tr class="table_th">
                                <th><input type="checkbox" id="check_all" name="check_all"></th>
                                <th>Seller Name</th>
<!--                                <th>Seller ID</th>-->
                                <th>Sale Value</th>
                                <th>Customer Name</th>
                                <th>SKU</th>
                                <th>Order ID.</th>
                                <th>Order Status</th>
                                <th>Order Date</th>
                                <th>Fixed charges</th>
                                <th>Seasonal charges</th>
                                <th>PG charges</th>
                                <th>Commission</th>
                                <th>Service Tax</th>
                                <th>Penalty</th>
                                <th>settlement amount</th>
                                <th>Discount<br/>(in Amount)</th>
                                <th>Final Settlement amount</th>
                            </tr>
                            <?php
                            if (count($payout_result) > 0) {
                                $sl = 1;
                                foreach ($payout_result as $record):
                                    ?>
                                    <tr>                                        
                                        <td style="text-align:center;"><input type="checkbox" class="payment_id_chk_cls" name="payment_id_chk[]" value="<?= $record['id'] ?>" ></td>
                                        <td>
                                            <?= $record['business_name']; ?>
                                        </td>                                        
                                        <td><?= $record['sale_value']; ?></td>
                                        <td><?= $record['full_name']; ?></td>
                                        <td>
                                            <?php
                                            $pos = strpos($record['sku'], '-', strpos($record['sku'], '-') + 1) + 1;
                                            echo substr($record['sku'], $pos)
                                            ?>
                                        </td>
                                        <td>
                                            <div><?= $record['order_no']; ?></div>                                            
                                            <div style="color:#903; font-weight:bold; font-size:12px;"><?= $record['payment_type'] ?></div>
                                        </td>
                                        <td>
                                            <?php
                                            if (strtolower($record['order_status']) == 'cancelled') {
                                                echo "<span title='Cancelled by " . $record['cancelled_by'] . "'>" . $record['order_status'] . "</span>";
                                            } else {
                                                echo $record['order_status'];
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?= date('d/m/Y', strtotime($record['date_of_order'])) ?>
                                            <div style="color:#903; font-weight:bold;">
                                                <?php
                                                if ($record['order_status_modified_date'] != '0000-00-00 00:00:00') {
                                                    echo date('d/m/Y', strtotime($record['order_status_modified_date']));
                                                }
                                                ?>
                                            </div>
                                        </td>
                                        <td><?= $record['fixed_chgs']; ?></td>
                                        <td><?= $record['season_chgs']; ?></td>
                                        <td><?= $record['pg_chgs']; ?></td>
                                        <td><?= $record['commission']; ?></td>
                                        <td><?= $record['service_tax']; ?></td>
                                        <td><?= $record['penalty']; ?></td>
                                        <td>
                                            <?php
                                            $total_deduct_amt = $record['fixed_chgs'] + $record['season_chgs'] + $record['pg_chgs'] + $record['commission'] + $record['service_tax'] + $record['penalty'];
                                            $settlement_value = $record['sale_value'] - $total_deduct_amt;
                                            echo $settlement_value;
                                            ?>
                                        </td>
                                        <td style="text-align:center;" width="12px">
                                            <input type="text" name="discount[]" id="discount<?= $sl; ?>" value="<?php
                                            //if ($record['discount'] != 0) {
                                                echo $record['discount'];
                                            //}
                                            ?>" style="width:50px;">
                                            <span class="edt" id="dcnt_spn<?= $sl; ?>" onClick="UpdateDiscount(<?= $sl; ?>, '<?= $record['id']; ?>')">Calculate</span>
                                             <!--<span class="edt" id="dcnt_spn<?//=$sl;?>" onClick="UpdateDiscount(<?//=$sl;?>,'<?//=$record['order_no;?>')">Calculate</span>-->
                                        </td>
                                        <td>
                                            <?php
                                            if ($record['discount'] != 0) {
                                                $discount_amt = $record['discount'];
                                                $final_settelment_amt = $settlement_value + $discount_amt;
                                            } else {
                                                $final_settelment_amt = $settlement_value;
                                            }
                                            echo $final_settelment_amt;
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $sl++;
                                endforeach;
                            } else {
                                echo '<tr><td style="text-align:center" colspan="15">No Records Found.</td></tr>';
                            }
                            ?>
                        </table>
                    </div>
                </div>
        </div>
        </form>
    </div>        
</div>

</div><!-- @end #content -->    


<style>
    .all_buttons_disable{
        background-color: #b6b4b4;
        border: 0 none;
        color: #fff;
        float: right;
        font-size: 12px;
        margin: 0 5px;
        padding: 3px 8px;
    }
    .all_buttons_disable:hover{background-color: #b6b4b4;}
</style>
<script>
    $(document).ready(function () {
        var selected_payout = 0;
        $('#check_all').click(function () {
            $('input:checkbox').prop('checked', this.checked);
            selected_payout = 0;
            if (this.checked) {
                selected_payout = $('.payment_id_chk_cls').length;
                show_selected_item(true, selected_payout);
            } else {
                show_selected_item(false, selected_payout);
            }


        });
        $('.payment_id_chk_cls').on('click', function () {
            if ($(this).prop('checked')) {
                selected_payout++;
            } else {
                selected_payout--;
            }
            if (selected_payout > 0) {
                show_selected_item(true, selected_payout);
            } else {
                show_selected_item(false, selected_payout);
            }

        });

        function show_selected_item(flag, item) {
            if (flag) {
                $('#show_selected_items').css('display', 'block');
                $('#show_selected_items').html('Selected Items: ' + item);
            } else {
                $('#show_selected_items').css('display', 'none');
                $('#show_selected_items').html('Selected Items: ' + item);
            }

        }

        $('#payout_generate').on('click', function () {
            var countCheckedCheckboxes = $('.payment_id_chk_cls').filter(':checked').length;
            if (countCheckedCheckboxes > 0) {
                $('#payout_form').submit();
            } else {
                alert('Please select item to payout.');
            }

        });
    });
    function UpdateDiscount(sl, id) {
        var discount_percent = $('#discount' + sl).val();
        if (discount_percent == '') {
            alert('Please enter discount percent.');
            $('#discount' + sl).focus();
            return false;
        } else if (isNaN(discount_percent)) {
            alert('Please enter a valid percent.');
            $('#discount' + sl).select();
            return false;
        } else {
            $('#dcnt_spn' + sl).css({"color": "#ccc", "cursor": "not-allowed"});
            $.ajax({
                url: '<?php echo base_url(); ?>admin/payment/update_settelment_discount',
                method: 'post',
                data: {discount: discount_percent, id: id},
                success: function (result) {
                    if (result == 'success') {
                        window.location.reload(true);
                    }
                }
            });
        }
    }

    function exportPayoutReport() {
        window.location.href = '<?php echo base_url() . 'admin/payment/payout_excel_report'; ?>';
    }

    function exportSlrPayoutReport() {
        window.location.href = '<?php echo base_url() . 'admin/payment/slr_payout_excel_report'; ?>';
    }
</script>

<?php
require_once('footer.php');
?>			
