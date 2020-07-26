<html>
    <head>					
        <title></title>
        <style type="text/css">
            *{padding:0px; margin:0px;}
        </style>
    </head>
    <body style="font-family:'Calibri',Arial, Helvetica, sans-serif;">

        <div style="width:80%; margin:0px 8%; background-color:#fff; padding:10px; border:2px solid #e8442b;">

            <div style="clear:both; border-bottom:2px solid #e8442b;"> &nbsp; </div>

            <h3> Hi <?= $shipment_address_details->fname . ' ' . $shipment_address_details->lname; ?>,</h3>
            <p> Greeting from <?= ucfirst(DOMAIN_NAME) ?>!</p>
            <p> Asianelectronics has shipped <?= $slr_qty_result->total_qty; ?> item in your order <strong><?= $order_id; ?></strong></p>
            <p> Shipment Tracking <strong> ID: FMPC3521656977</strong> </p>

            <h3> Shipment Details : </h3>
            <table width="600" cellpadding="5" cellspacing="5" align='center'>
                <tr> <td> <strong>Shipment No. :</strong> </td><td><?= $shipment_no; ?></td></tr>
                <tr> <td> <strong>Courier Name :</strong> </td><td><?= $courier_name; ?></td></tr>
                <tr> <td> <strong>Tracking Number :</strong> </td><td><?= $tracking_number; ?></td></tr>
            </table>

            <h3 style=" margin-top:30px;">The following item has been shipped : </h3>

            <table width="100%" style="text-align:center; border:1px solid #ccc;">
                <tr>
                    <th style="padding:5px;"> Name </th>
                    <th style="padding:5px;">Item Price</th>
                    <th style="padding:5px;">Qty</th>
                    <th style="padding:5px;">Subtotal</th>
                    <th style="padding:5px;">Shipping Fee</th>
                </tr>
                <?php foreach ($shipmnt_data as $order_rw) { ?>
                    <tr>
                        <td style="padding:5px;"><?= $order_rw->name; ?></td>
                        <td style="padding:5px;">Rs. <?= ($order_rw->sub_total_amount - $order_rw->sub_shipping_fees) / $order_rw->quantity; ?></td>
                        <td style="padding:5px;"><?= $order_rw->quantity; ?></td>
                        <td style="padding:5px;">Rs. <?= $order_rw->sub_total_amount; ?></td>
                        <td style="padding:5px;">Rs. <?= $order_rw->sub_shipping_fees; ?></td>
                    </tr>
                <?php } ?>
                <tr><td colspan='5' style="text-align:right; background-color:#f4f4f4; padding:5px;"><strong>Total Amount</strong> Rs. <?= $total_amount_result->Total_amount; ?></td></tr>
            </table>

            <h3 style="margin:10px 0px;"> THE SHIPMENT WAS SENT TO:</h3> <br/>
            <table>
                <tr><td><?= $shipment_address_details->full_name . "," . $shipment_address_details->phone; ?></td></tr>
                <tr>
                    <td>
                        <p><?= $shipment_address_details->address; ?><br/><?= $shipment_address_details->city . "-" . $shipment_address_details->pin_code; ?><br/><?= $shipment_address_details->state; ?></p>
                    </td>
                </tr>
            </table>

            <table width="100%">
                <tr>
                    <td style='background-color:#e8442b;  border:2px solid #e8442b; color:#fff; padding:15px; text-align:center;'>
                        &copy; 2015 <?=COMPANY?>. 1st Floor, Khajotiya House, Beside Parsi Fire Temple , Sayedpura, Surat, GJ, IN- 395003 <br />
                        You received this email because you're a registered <?=COMPANY?> user. 
                    </td> </tr> </table>

        </div>
    </body>
</html>