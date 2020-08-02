<?php
require_once('header.php');
?>
<div id="content">    
    <div class="top-bar">
        <div class="top-left">
            <?php include 'sub_reporttab.php'; ?>
        </div>
        <?php require_once('header_session.php'); ?>
    </div> 

    <div class="main-content">
        <?php require_once('common.php'); ?>
        <div class="page_header">
            <div class="left">
                <h3>Payment Reports</h3>
            </div>            
            <div class="clear"></div>
        </div>

        <div class="row mt20">

        </div><!--Settled & Unsettled table-->
        <div class="row mt20 settelment_period" style="margin-bottom:20px;">
            <form>
                <div class="input-append">

                </div>
                <div class="downloadAsButton right">
                    <a href="<?php echo base_url(); ?>"></a>
                </div>
            </form>

        </div>
        <div class="settelment_details_table">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Sl. No.</th>
                    <th>Pay Out Gen. Date</th>
                    <th>No of Orders</th>
                    <th>Final stl Amt</th>
                    <th >Accnt. No</th>
                    <th>Bank Name</th>
                    <th>IFSC Code</th>
                    <th>Accnt. Holder Name</th>
                    <th>UTR No.</th>
                    <th>Status</th>
                </tr>
                <?php
                $ct = count($payment_reportresult);
                if ($ct > 0) {
                    $i = 1;
                    foreach ($payment_reportresult as $res_repo) {
                        ?>

                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $res_repo->pyt_generated_dt; ?></td>
                            <td><?= $res_repo->no_of_orders; ?></td>                                
                            <td>Rs.<?= $res_repo->fnl_stl_amt; ?></td>
                            <td><?= $res_repo->bnk_acnt_no; ?></td>
                            <td><?= $res_repo->bnk_name; ?></td>                                
                            <td><?= $res_repo->bnk_ifsc_code; ?></td>
                            <td><?= $res_repo->acnt_hldr_name; ?></td>
                            <td><?= $res_repo->utr_no; ?></td>
                            <td><?= $res_repo->status; ?></td>
                        </tr>
                        <?php
                        $i++;
                    } //foreach end
                } else {
                    ?> 

                    <tr>
                        <td colspan="9">No Record Found!</td>
                    </tr>
                <?php } ?>
            </table>            
        </div>
    </div> 
</div>




<?php
require_once('footer.php');
?>