<html>
<head>					
<title></title>
</head>
<body style='background-color:#fabd2f; font-family:'Calibri',Arial, Helvetica, sans-serif;'>

<h3>Hi <?=$shipment_address_details->fname.' '.$shipment_address_details->lname;?>,</h3>
<p>Greeting from Moonboy.in!</p>
<p><?=$slr_qty_result->business_name;?> has shipped <?=$slr_qty_result->total_qty;?> item in your order <?=$order_id;?></p>
<strong>Shipment Details</strong>
<table width='600' cellspacing='0' align='center'>
<tr><td>Shipment No.: </td><td><?=$shipment_no;?></td></tr>
<tr><td>Courier Name: </td><td><?=$courier_name;?></td></tr>
<tr><td>Tracking Number: </td><td><?=$tracking_number;?></td></tr>
</table>
<p><strong>The following item has been shipped:</strong></p><br/><br/>
<table>
    <tr>
        <th></th>
        <th>Item Price</th>
        <th>Qty</th>
        <th>Subtotal</th>
        <th>Shipping Fee</th>
    </tr>
    <?php foreach($shipmnt_data as $order_rw){ ?>
    <tr>
        <td><?=$order_rw->name;?></td>
        <td>Rs. <?=($order_rw->sub_total_amount-$order_rw->sub_shipping_fees)/$order_rw->quantity;?></td>
        <td><?=$order_rw->quantity;?></td>
        <td>Rs. <?=$order_rw->sub_total_amount;?></td>
        <td>Rs. <?=$order_rw->sub_shipping_fees;?></td>
    </tr>
   <?php } ?>

<tr><td colspan='5' style='text-align:right;'>Total Amount Rs. <?=$total_amount_result->Total_amount;?></td></tr>
</table>
<p><strong>THE SHIPMENT WAS SENT TO :</strong></p><br/><br/>
<table>
    <tr><td><?=$shipment_address_details->full_name.",".$shipment_address_details->phone;?></td></tr>
    <tr>
        <td>
            <p><?=$shipment_address_details->address;?><br/><?=$shipment_address_details->city."-".$shipment_address_details->pin_code;?><br/><?=$shipment_address_details->STS;?></p>
        </td>
    </tr>
</table>

<table>
<tr>
<td style='background-color:#e8442b;  border:2px solid #e8442b; color:#fff; padding:15px; text-align:center;'>
 &copy; 2015 Moonboy. 1st Floor, Khajotiya House, Beside Parsi Fire Temple , Sayedpura, Surat, GJ, IN- 395003 <br />
You received this email because you're a registered Moonboy user. 
</td> </tr> </table>
</body>
</html>