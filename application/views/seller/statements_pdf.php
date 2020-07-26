<style type="text/css">
    .clr{clear:both;}
    .table{font-family:Arial, Helvetica, sans-serif;}
    .statement_desc_table tr th{background-color:#f3f3f3 !important; font-weight:bold; font-size:18px; padding:5px;}
    .statement_desc_table tr td{ border:1px solid #ccc; padding:3px; margin:0px; font-size:14px;}
    .address{background-color:#f9f9f9 !important; padding:5px; font-family:Arial, Helvetica, sans-serif; font-size:15px; margin-bottom:15px;}

</style>			

<div id="content">    

    <div class="main-content">

        <table class="address" width="98%">
            <tr> 
                <td><h3> <?=COMPANY?> International Pvt Ltd. </h3> </td>
                <td align="right"> <p>
                        H No - 12/2710, 1st Floor <br />
                        Khajotiya House, Aga No Wad, <br />
                        NR. Parsi Fire Temple, Sayedpura, <br />
                        Surat, Gujarat - 395003  <br />
                    </p>
                </td> 
            </tr>
        </table>

        <div class="statement_details">

            <div class="row stempt_for_invalid_date">

                <table  width="98%" class="table table-striped statement_table" id="searched_statement_details">
                    <?php
                    if ($statement_data != false) {
                        ?>
                        <tr>
                            <td>
                                <strong style="color:#036;">Settled balance</strong>
                                <i class="icon icon-question-sign ng-scope"></i>
                            </td>
                        </tr>
                        <tr>
                            <td class="settelment_details_table">
                                <table class="table table-striped statement_desc_table" width="100%" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <th background="#f5f5f5">Description</th>
                                            <th background="#f5f5f5">Credits(Rs)</th>
                                            <th background="#f5f5f5">Debits(Rs)</th>
                                            <th background="#f5f5f5">Net settled amount(Rs)</th>
                                        </tr>
                                        <tr>
                                            <td>Sale Amount <i class="icon icon-question-sign ng-scope"></i></td>
                                            <td><?= number_format($statement_data[0]->TOTAL_SALE_AMT, 2, ".", ","); ?></td>
                                            <td></td>
                                            <td><?= number_format($statement_data[0]->TOTAL_SALE_AMT, 2, ".", ","); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Refunds <i class="icon icon-question-sign ng-scope"></i></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Offer Amount <i class="icon icon-question-sign ng-scope"></i></td>
                                            <td><?= number_format($statement_data[0]->TOTAL_DISCOUNT_AMT, 2, ".", ","); ?></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                                <td>Commission <!--<i class="icon icon-question-sign ng-scope"></i>--></td>
                                            <td></td>
                                            <td><?= number_format($statement_data[0]->TOTAL_COMMISION, 2, ".", ","); ?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Fixed Fee <i class="icon icon-question-sign ng-scope"></i></td>
                                            <td></td>
                                            <td><?= number_format($statement_data[0]->TOTAL_FIXED_FEE, 2, ".", ","); ?></td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        if ($statement_data[0]->TOTAL_SEASON_FEE != 0) {
                                            ?>
                                            <tr>
                                                <td>Seasonal Fee <i class="icon icon-question-sign ng-scope"></i></td>
                                                <td></td>
                                                <td><?= number_format($statement_data[0]->TOTAL_SEASON_FEE, 2, ".", ","); ?></td>
                                                <td></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td>P.G Fee <i class="icon icon-question-sign ng-scope"></i></td>
                                            <td></td>
                                            <td><?= number_format($statement_data[0]->TOTAL_PG_FEE, 2, ".", ","); ?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Service Tax <i class="icon icon-question-sign ng-scope"></i></td>
                                            <td></td>
                                            <td><?= number_format($statement_data[0]->TOTAL_SERVC_TAX, 2, ".", ","); ?></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" style="padding:5px; background-color:#f5f5f5;">
                                <b>Total settled amount </b>
                                <b>
                                    Rs. 
                                    <?= number_format($statement_data[0]->TOTAL_FNL_STL_AMT, 2, ".", ","); ?>
                                </b>
                            </td>
                        </tr>
                    <?php } else { ?>
                        <tr>
                            <td>No Record Found!</td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>

    </div>  <!-- @end #main-content -->
</div><!-- @end #content -->