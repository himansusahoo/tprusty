<style>
    @page {
        margin: 0cm 0cm;
    }
    .main{width:100%; margin:1.6cm auto; font-family:"Times New Roman", Times, serif; font-size:11px; padding: 0px 20px 0px 20px;} 
    .invoice_title{font-weight: bold; font-size: 20px; padding:15px;}
    /** Define the header rules **/
    header {
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 1.6cm;
        background-color: #D1D0CE;
        color: white;
        text-align: center;
        line-height: 1.6cm;
    }
    footer {
        position: fixed; 
        bottom: 0cm; 
        left: 0cm; 
        right: 0cm;
        height: 1cm;
        background-color: #D1D0CE;
        color: #000;
        text-align: center;
        line-height: 1cm;
    }

    .detail_table{
        width:100%;
        background-color:#f9f9f9; 
        border:1px dashed #ccc; 
        padding:5px;
        font-size: 11px;
    }
    .prod_table{
        width: 100%;
        font-size:11px; 
        border: 1px solid black;
    }
    .prod_table th{
        background-color:#000;         
        color:#fff; 
        padding:2px 10px 2px 10px; 
        font-weight:bold; 
        text-align: left;
    } 
    .prod_table td{padding-left: 10px;}
    .total_row td{
        border-top:1px solid black;        
        text-align:right; 
        font-weight: 600; 
        padding-right: 5px;
        padding-bottom: 3px;
    }
    .thank_you_table{font-size: 11px; width: 100%; margin-top: 10px; padding: 0px 10px 0px 10px;}
    .declaration{font-size: 11px; margin-top: 10px;}
    .dash_border td{border-bottom: 1px dashed gray;}
</style>
<div class="main">
    <!-- Define header and footer blocks before your content -->
    <header>
        <?php
        $imgPath = dirname(BASEPATH) . "/images/logo.png";
        $imgFile = file_get_contents($imgPath);
        $img = base64_encode($imgFile);
        echo "<img src=\"data:image/png;charset=utf8;base64, $img\"/>";
        ?>
    </header>
    <!-- Wrap the content of your PDF inside a main tag -->
    <main>

        <?php
        if ($invoiceData):
            $total_record = (count($invoiceData) - 1);
            $delivery_addr = current($invoiceData);
            ?> 
            <div class="invoice_title">Order Invoice</div>
            <!-- Delivery Address -->
            <div>
                <table class="detail_table">
                    <tr><td><h3>Delivery Address</h3></td></tr>
                    <tr>
                        <td>
                            <div><?= $delivery_addr['full_name'] ?></div>
                            <div><?= $delivery_addr['ship_addrress'] ?></div>
                            <div><?= $delivery_addr['ship_city'] . ", " . $delivery_addr['ship_pincode'] ?></div>
                            <div><?= $delivery_addr['ship_country'] ?></div>
                            <div><?= $delivery_addr['ship_phone'] ?></div>                                
                        </td>
                    </tr>
                </table>
            </div>
            <div>
                <!-- Buyer Detail -->
                <table class="detail_table">
                    <tr><td colspan="2"><h3>Buyer Details</h3></td></tr>
                    <tr>
                        <td width="50%"> 
                            <div><?= $delivery_addr['buyer_name'] ?></div>                                    
                            <div><?= $delivery_addr['address'] ?></div>
                            <div><?= $delivery_addr['city'] . ", " . $delivery_addr['state'] ?></div>
                            <div><?= $delivery_addr['country'] . " " . $delivery_addr['buyer_pincode'] ?></div>                               
                            <div>Contact: <?= $delivery_addr['mob'] ?></div>
                        </td>
                        <td>
                            <div>Order ID: <?= $delivery_addr['order_id'] ?></div>
                            <div>Order Date: <?= substr($delivery_addr['date_of_order'], 0, 10) ?></div>
                            <div>Invoice Number: <?= (isset($delivery_addr['invoice_id']) && $delivery_addr['invoice_id'] != '' ? $delivery_addr['invoice_id'] : "Not Available") ?></div>  
                        </td>
                    </tr>
                </table> 
            </div>

            <div>
                <!-- Sellers Details -->
                <table class="detail_table">
                    <tr><td><h3>Sold By</h3></td></tr>
                    <tr>
                        <td>
                            <div><?= $delivery_addr['business_name'] ?></div>
                            <div><?= $delivery_addr['seller_address'] ?></div>
                            <div><?= $delivery_addr['seller_city'] ?></div>
                            <div><?= $delivery_addr['seller_state'] . " " . $delivery_addr['pincode'] ?></div>
                            <div>Seller GSTIN: <?= $delivery_addr['gstin'] ?></div>
                        </td>
                    </tr>
                </table>
            </div>
            <div>
                <!--Display Product list -->                    
                <table class="prod_table" cellspacing="0" cellpadding="0">
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price (Without Tax)</th>
                        <?php
                        $cgstFlag = true;
                        if (strtolower(trim($delivery_addr['seller_state'])) == strtolower(trim($delivery_addr['state']))) {
                            echo "<th  class='heading'>CGST</th>";
                            echo "<th  class='heading'>SGST</th>";
                        } else {
                            $cgstFlag = false;
                            echo "<th  class='heading'>IGST</th>";
                        }
                        ?>   
                        <th>Total Price</th>
                    </tr>
                    <!-- fetch production general info -->
                    <?php
                    $total_amount = 0;
                    //COD
                    $codCharg = 0;
                    $codFlag = false;
                    if (strtolower(trim($delivery_addr['payment_type'])) == 'cod') {
                        $codCharg = $delivery_addr['cod_charge'];
                        $codFlag = true;
                    }
                    $shippingFee=0;
                    foreach ($invoiceData as $key => $product) :

                        //find product price without tax
                        $saleValue = $product['sub_total_amount'];
                        $noShipSaleValue = $saleValue - $product['sub_shipping_fees'];
                        $taxRate = 100 + $product['tax_rate'];
                        $withoutTaxValue = $noShipSaleValue / $taxRate * 100;

                        //find tax amount
                        $taxAmount = $noShipSaleValue - $withoutTaxValue;
                        $product_total_amout = $noShipSaleValue;

                        $shippingFee+=$product['sub_shipping_fees'];
                        $prodRowClass = "";
                        if ($key < $total_record) {
                            $prodRowClass = "class='dash_border'";
                        }
                        $total_amount+=$saleValue;
                        ?>
                        <tr <?= $prodRowClass ?>>
                            <td style="width:45%;">                                        
                                <div><b><?= $product['product_name'] ?></b></div>
                                <div>
                                    <?php
                                    if ($product['color'] != '') {
                                        echo "<span class='cart_attr'>Color : " . $product['color'] . '</span><br/>';
                                    }
                                    if ($product['size'] != '') {
                                        echo "<span class='cart_attr'>Size : " . $product['size'] . '</span><br/>';
                                    }
                                    if ($product['capacity'] != '') {
                                        echo "<span class='cart_attr'>Capacity : " . $product['capacity'] . '</span><br/>';
                                    }
                                    if ($product['ram'] != '') {
                                        echo "<span class='cart_attr'>RAM : " . $product['ram'] . '</span><br/>';
                                    }
                                    if ($product['rom'] != '') {
                                        echo "<span class='cart_attr'>ROM : " . $product['rom'] . '</span><br/>';
                                    }
                                    ?>  
                                </div>                     
                            </td>
                            <td>  
                                <div><?= $product['quantity'] ?></div>                                       
                            </td>
                            <td> 
                                <!-- Without Tax -->
                                <?php
                                echo "Rs." . round($withoutTaxValue, 2);
                                ?>
                            </td>
                            <?php
                            if ($cgstFlag) {
                                echo "<td class=\"dash_border\">Rs." . round(($taxAmount / 2), 2) . " (" . ($product['tax_rate'] / 2) . "%)</td>";
                                echo "<td class=\"dash_border\">Rs." . round(($taxAmount / 2), 2) . " (" . ($product['tax_rate'] / 2) . "%)</td>";
                            } else {
                                echo "<td class=\"dash_border\">Rs." . round($taxAmount, 2) . " (" . ($product['tax_rate']) . "%)</td>";
                            }
                            ?>    
                            <td><?= "Rs." . round($product_total_amout, 2); ?></td>
                        </tr>

                    <?php endforeach; ?>

                    <tr class="total_row">
                        <td colspan="<?= ($cgstFlag) ? 3 : 2 ?>" style="text-align:right;"></td>
                        <td colspan="2">Delivery Charges</td>
                        <td style="text-align:left; border-left: 1px solid black;">Rs.<?= $shippingFee; ?></td> 
                    </tr>
                    <?php if ($codFlag): ?>
                        <tr class="total_row">
                            <td colspan="<?= ($cgstFlag) ? 3 : 2 ?>" style="text-align:right;"></td>
                            <td colspan="2">COD Charges</td>
                            <td style="text-align:left; border-left: 1px solid black;">Rs.<?= $codCharg; ?></td> 
                        </tr>
                    <?php endif; ?>

                    <tr class="total_row">
                        <td colspan="<?= ($cgstFlag) ? 5 : 4 ?>">Total Amount (Including Tax & Shipping Fees)</td>
                        <td style="text-align:left;border-left: 1px solid black;">Rs.<?= ($total_amount + $codCharg); ?></td> 
                    </tr>
                </table>
            </div>
            <div>
                <p class="declaration">                            
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I <b><?= $delivery_addr['buyer_name'] ?></b>, hereby agree and confirm that the above said goods are purchased through the Seller: <b><?= $delivery_addr['business_name']; ?></b> on  <b><?= DOMAIN_NAME ?></b>, the above said goods are being purchased for my internal/personal purpose only and not for re-sale.I have read, understood and i am legally bound by terms and conditions of sale available on  <a target="_blank" href="<?= APP_BASE ?>"><?= DOMAIN_NAME ?></a></span>
                </p>
            </div>

        <?php endif; ?>

    </main>
    <footer>
        Thank you for buying from <?= DOMAIN_NAME ?> ! For any issue email : <a href="mailto:<?= SUPPORT_MAIL ?>"><?= SUPPORT_MAIL ?></a>
    </footer>
</div>