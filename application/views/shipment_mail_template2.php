<html>
    <head>					
        <title></title>
        <style type="text/css">
            *{padding:0px; margin:0px;}
        </style>
    </head>
    <body style=" background-color:#fabd2f;font-family:'Calibri',Arial, Helvetica, sans-serif;">

        <div style="width:80%; margin:0px 10%; background-color:#fff; padding:10px; border:2px solid #e8442b;">

            <img src="<?= APP_BASE ?>images/logo.png" alt="" style="width:250px; height:60px; margin-left:36%;"  />
            <div style="clear:both; border-bottom:2px solid #e8442b;"> &nbsp; </div>

            <h3> Hi <?= $shipment_address_details->fname . ' ' . $shipment_address_details->lname; ?>,</h3>
            <p> Greeting from <?= ucfirst(DOMAIN_NAME) ?>!</p>
            <p> Asianelectronics has shipped <?= $slr_qty_result->total_qty; ?> item in your order <strong><?= $order_id; ?></strong></p>
            <p> Shipment Tracking <strong> ID: FMPC3521656977</strong> </p>

            <h3 style="color:#e8442b;"> Shipment Details </h3>
            <table width='600' cellspacing='0' align='center'>
                <tr> <td> <strong>Shipment No. :</strong> </td><td><?= $shipment_no; ?></td></tr>
                <tr> <td> <strong>Courier Name :</strong> </td><td><?= $courier_name; ?></td></tr>
                <tr> <td> <strong>Tracking Number :</strong> </td><td><?= $tracking_number; ?></td></tr>
            </table>

            <h3 style="color:#e8442b;">The following item has been shipped: </h3>

            <table width="100%">
                <tr>
                    <th> </th>
                    <th>Item Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th>Shipping Fee</th>
                </tr>
                <?php foreach ($shipmnt_data as $order_rw) { ?>
                    <tr>
                        <td> <img src="<?= APP_BASE ?>images/product_img/catalog_KSA152-2005.jpg" style="width:100px; height:100px;" > </td>
                        <td><?= $order_rw->name; ?></td>
                        <td>Rs. <?= ($order_rw->sub_total_amount - $order_rw->sub_shipping_fees) / $order_rw->quantity; ?></td>
                        <td><?= $order_rw->quantity; ?></td>
                        <td>Rs. <?= $order_rw->sub_total_amount; ?></td> </tr>
                    <tr>    
                        <td colspan='5'  style="text-align:right;">Rs. <?= $order_rw->sub_shipping_fees; ?></td>
                    </tr>
                <?php } ?>

                <tr><td colspan='5' style="text-align:right;">Total Amount Rs. <?= $total_amount_result->Total_amount; ?></td></tr>
            </table>

            <h3 style="margin:10px 0px; color:#e8442b;"> THE SHIPMENT WAS SENT TO:</h3> <br/>
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