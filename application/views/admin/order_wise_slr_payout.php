<table class="table table-hover" style="background-color:#EBF5F5 !important;">
    <tr bgcolor="#DFDFDF">
        <td width="8%">Order no.</td>
        <td width="8%">Sale Value</td>
        <td width="8%">Fixed Charge</td>
        <td width="8%">season Charge</td>
        <td width="8%">PG Charge</td>
        <td width="8%" >Commision</td>
        <td width="8%">GST</td>
        <td width="8%">Penalty</td>
        <td width="8%">Discount</td>
        <td width="8%">Settl. Amt</td>
        <td width="8%">Order Status</td>
    </tr>
    <?php
    if ($slr_payt_result != false) {
        foreach ($slr_payt_result as $row) {
            ?>
            <tr>
                <td><?= $row->order_no; ?></td>
                <td><?= $row->sale_value; ?></td>
                <td><?= $row->fixed_chgs; ?></td>
                <td><?= $row->season_chgs; ?></td>
                <td><?= $row->pg_chgs; ?></td>
                <td><?= $row->commission; ?></td>
                <td><?= $row->service_tax; ?></td>
                <td><?= $row->penalty; ?></td>
                <td><?= $row->discount; ?></td>
                <td><?= $row->fnal_settl_amt; ?></td>
                <td><?=$row->order_status?></td>
            </tr>
        <?php }
    } ?>
</table>