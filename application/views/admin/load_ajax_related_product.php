<h3>Related Products</h3>
<div class="row content-header"></div>

<div class="row">
    <div class="col-md-4 show_report">
        <button type="button" class="all_buttons">Reset</button>
        <button type="button" class="all_buttons">Search</button>
    </div>
</div>
<table class="table table-bordered table-hover">
    <tr class="table_th">
        <th width="5%" class="a-center"><input type="checkbox" id="check_all"></th>
        <th width="5%">ID</th>
        <th width="25%">Name</th>
       <!-- <th width="5%">Type</th>-->
        <th width="10%">Attrib. Set Name</th>
        <th width="8%">Status</th>
        <th width="8%">SKU</th>
        <th width="15%">Price</th>
        <!--<th width="15%">Position</th>-->
    
    </tr>
    <tr style="background-color:#e3eff1;">
        <td class="a-center">
            <select>
                <option selected="selected">Any</option>
                <option>Yes</option><option>No</option>
            </select>
        </td>
        <td><input type="text" name="page_no" class="input_text" value=""></td>
        <td><input type="text" name="page_no" value=""></td>
        <!--<td>
            <select>
                <option value=""></option>
                <option value=""> Simple Product </option>
                <option value=""> Grouped Product </option>
                <option value=""> Configurable Product </option>
                <option value=""> Virtual Product </option>
                <option value=""> Bundle Product </option>
                <option value=""> Downloadable Product </option>
            </select>
        </td>-->
        <td>
            <select>
                <?php foreach($result_attr_group as $row){ ?>
                    <option value="<?=$row->attribute_group_id;?>"><?= $row->attribute_group_name; ?></option>
                <?php } ?>
            </select>
        </td>
        <td>
            <select>
                <option value=""></option>
                <option value="">Enabled</option>
                <option value="">Disabled</option>
            </select>
        </td>
        <td><input type="text" name="sku" class="input_text" value=""></td>
        <td>
            <div class="price">
                <span class="label">From:</span>
                <input type="text" name="price_from" value="">
            </div><br/>
            <div class="price">	
                <span class="label">To:</span>
                <input type="text" name="price_to" value="">
            </div>
        </td>
    </tr>
    <?php
      $only_related_product_row = $only_related_product->num_rows();
      if($only_related_product_row > 0){
            foreach($only_related_product->result() as $rows1){
                 $related_products = unserialize($rows1->related_product_id);
            }
      }else{
              $related_products = array();
      }
      
      $row = $result_product_related->num_rows();
      if($row > 0){
          foreach($result_product_related->result() as $rows){
    ?>
    <tr>
        <td style="text-align:center"><input type="checkbox" name="chk_product[]" id="chk_product" value="<?=$rows->product_id ; ?>" <?php if($related_products != ''){if(in_array($rows->product_id,$related_products)){ echo 'checked';}} ?>></td>
        <td><?=$rows->product_id; ?></td>
        <td><?=$rows->name; ?></td>
        <!--<td><?//=$rows->product_type; ?></td>-->
        <td><?=$rows->attribute_group_name; ?></td>
        <td><?=$rows->status; ?></td>
        <td><?=$rows->sku; ?></td>
        <!--<td><?//= $rows->price; ?></td>-->
        
        <td><i class="icon-inr"></i> 
        <?php
            $amount = $rows->price;
            print number_format( $amount, 2, ".", "," );
        ?>
        </td>
    </tr>
      <?php 
          }
      }else{
      ?>
      <tr><td class="a-center" colspan="8">No records found ! </td></tr>
      <?php } ?>
</table>
