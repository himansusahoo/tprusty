<?php
# replace excelfile.xls with whatever you want the filename to default to
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=payout_report.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<div id="container">
    <div id="header">
        <div id="mainContent" align="center">   

            <div style="padding-left:250px;">
                <table border="1">
                    <tr>
                        <th bgcolor="#FBFB00">SL. NO.</th>
                        <th bgcolor="#FBFB00">Seller Name</th>
                        <th bgcolor="#FBFB00">Seller ID</th>                        
                        <th bgcolor="#FBFB00">Order ID</th>                        
                        <th bgcolor="#FBFB00">Fixed charges</th>
                        <th bgcolor="#FBFB00">Seasonal charges</th>
                        <th bgcolor="#FBFB00">PG charges</th>
                        <th bgcolor="#FBFB00">Commission</th>
                        <th bgcolor="#FBFB00">Service Tax</th>
                        <th bgcolor="#FBFB00">Penalty</th>
                        <th bgcolor="#FBFB00">Settlement amount</th>
                        <th bgcolor="#FBFB00">Discount</th>
                        <th bgcolor="#FBFB00">Final Settlement amount</th>
                        <th bgcolor="#FBFB00">SKU</th>
                        <th bgcolor="#FBFB00">Order Status</th>
                        <th bgcolor="#FBFB00">Customer Name</th>
                    </tr>
                    <?php
                    $payout_row = $result->num_rows();
                    if ($payout_row > 0) {
                        $sl = 0;
                        foreach ($result->result() as $rows) {
                            $sl++;
                            ?>
                            <tr>
                                <td><?= $sl; ?></td>
                                <td><?= $rows->business_name; ?></td>
                                <td><?= $rows->seller_id; ?></td>                                
                                <td>'<?= $rows->order_no; ?>'</td>                                
                                <td><?= $rows->fixed_chgs; ?></td>
                                <td><?= $rows->season_chgs; ?></td>
                                <td><?= $rows->pg_chgs; ?></td>
                                <td><?= $rows->commission; ?></td>
                                <td><?= $rows->service_tax; ?></td>
                                <td><?= $rows->penalty; ?></td>
                                <td><?= $rows->settl_amt; ?></td>
                                <td><?= $rows->discount; ?></td>
                                <td><?= $rows->fnal_settl_amt; ?></td>
                                <td>
                                    <?php
                                    $pos = strpos($rows->sku, '-', strpos($rows->sku, '-') + 1) + 1;
                                    echo substr($rows->sku, $pos)
                                    ?>
                                </td>
                                <td><?= $rows->order_status; ?></td>
                                <td><?= $rows->full_name; ?></td>
                            </tr>
                        <?php }
                    } else {
                        ?>
                        <tr>
                            <td colspan="12">No Record Found.</td>
                        </tr>
<?php } ?>
                </table>
            </div>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/> 

        </div>