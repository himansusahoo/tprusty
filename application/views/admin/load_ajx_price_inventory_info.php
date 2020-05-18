<h3>Prices</h3>
<table>
     <tr>
        <td style="width:20%;"> MRP <sup>*</sup> </td>
        <td colspan="2"> 
            <input type="text" name="mrp" id="mrp" class="text" value="<?=$edit_product_details[0]->mrp;?>">
            <label>[INR]</label>
        </td>
    </tr>
    <tr>
        <td style="width:20%;"> Selling Price </td>
        <td colspan="2"> 
            <input type="text" name="price" id="price" class="text" value="<?php echo $edit_product_details ? $edit_product_details[0]->price : " "; ?>">
            <label>[INR]</label>
            <!--<input type="hidden" name="product_id" value="<?php// echo $product_id; ?>">-->
        </td>
    </tr>
    <tr>
        <td style="width:20%;"> Special Price </td>
        <td colspan="2"> 
            <input type="text" name="special_price" id="special_price" class="text" value="<?php echo $edit_product_details ? $edit_product_details[0]->special_price : " "; ?>">
            <label>[INR]</label>
        </td>
    </tr>
    <tr>
        <td>Special Price From Date</td>
        <td><input name="spcil_price_from_date" class="text2 dt" id="datepicker-example7-start1" value="<?php echo $edit_product_details ? $edit_product_details[0]->price_fr_dt : " "; ?>"></td>
    </tr>
    <tr>
        <td>Special Price To Date</td>
        <td><input name="spcil_price_to_date" class="text2 dt" id="datepicker-example7-end1" value="<?php echo $edit_product_details ? $edit_product_details[0]->price_to_dt : " "; ?>"></td>
    </tr>
    <tr>
        <td> GST <sup>*</sup> : </td>
        <td> 
            <input type="text" name="vat_cst" id="vat_cst" value="<?=$edit_product_details[0]->tax_amount;?>" class="seller_input">&nbsp;%
        </td>
        <td></td>
    </tr>
   
     <tr>
        <td> Weight (in gram) <sup>*</sup> </td>
        <td> <input type="text" name="weight" onFocus="removeDefaultShipping()" id="prdt_weight" class="text" value="<?php echo $edit_product_details ? $edit_product_details[0]->weight : " "; ?>"> </td>
    </tr>
    <tr>
        <td> Shipping Fee <sup>*</sup></td>
        <td>
            <select name="shipping_typ" id="shipping_typ" class="text" style="width:200px;" onChange="showshippingAmount(this.value)">
                <option value="">Choose shipping type</option>
                <option value="Free" <?php if($edit_product_details[0]->shipping_fee == 0) {echo "selected";} ?> >Free</option>
                <!--<option value="Flat">Flat</option>-->
                <option value="Default" <?php if($edit_product_details[0]->shipping_fee > 0) {echo "selected";} ?> >Default</option>
            </select>
           <!-- <input type="radio" name="shippingfee" value="Free"> Free &nbsp;&nbsp;
            <input type="radio" name="shippingfee" value="Flat"> Flat &nbsp;&nbsp;
            <input type="radio" name="shippingfee" value="Default"> Default-->
        </td>
        <td>
        <!--<div id="shipping_fee_dv">Local : <input type="text" class="text dt" name="local_shipng_fee" id="local_shipng_fee">[INR] &nbsp;&nbsp;&nbsp;&nbsp; Zonal : <input type="text" class="text dt" name="zonal_shipng_fee" id="zonal_shipng_fee">[INR]&nbsp;&nbsp;&nbsp;&nbsp; National : <input type="text" class="text dt" name="national_shipng_fee" id="national_shipng_fee">[INR]</div>
        <div id="flat_fee">Set Amount : <input type="text" class="text dt" name="flat_shipng_fee" id="flat_shipng_fee">[INR]</div>-->
        <!--<div id="flat_fee">Set Amount : <input type="text" onBlur="CheckValue(this.value,this.id)" class="text dt" name="flat_shipng_fee" id="flat_shipng_fee">[INR]</div>-->
        
        <div id="default_fee">Set Amount : <input type="text" class="text dt" onKeyUp="calculateshippingCost(this.value)" name="default_shipng_fee" id="default_shipng_fee" onBlur="CheckVal(this.value)" value="<?php echo $edit_product_details ? $edit_product_details[0]->shipping_fee : " "; ?>">[INR] (per 1kg.) &nbsp;&nbsp;&nbsp;&nbsp;<span id="shpng_spn">Shipping fee : Rs.<?php echo $edit_product_details ? $edit_product_details[0]->shipping_fee_amount : " "; ?></span></div>
        <input type="hidden" id="hidden_shipping_fee" name="hidden_shipping_fee">
        
        </td>
    </tr>
    <tr>
          <td>Qty<sup>*</sup></td>
          <td><input type="text" class="text" name="qty" id="qty" value="<?php echo $edit_product_details ? $edit_product_details[0]->quantity : " "; ?>"></td>
      </tr>

</table>