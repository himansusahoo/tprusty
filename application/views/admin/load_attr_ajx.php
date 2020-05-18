<div class="load_attr_dv">
<?php
//echo $product_sku; exit;
$attr_heading_rows = $attr_heading_result->num_rows();
$attr_heading_rows_length = count($attr_heading_rows);
if($attr_heading_rows > 0){
?>
	<!--<div class="load_attr_dv_left">
	<?php
	//foreach($attr_heading_result->result() as $attr_heading_row){ ?>
		<h5 onClick="showAttrFields(<?//=$attr_heading_row->attribute_heading_id;?>)"><?//=$attr_heading_row->attribute_heading_name;?></h5>
	<?php //}?>
    </div>-->
    
   <ul class="nav nav-pills nav-stacked col-md-2 attr_tab_ul">
	<?php
    $sl=0;
    foreach($attr_heading_result->result() as $attr_heading_row){
        $sl++;
    ?>

  <li><a href="#tab_a<?=$sl; ?>" data-toggle="pill"><?=$attr_heading_row->attribute_heading_name;?></a></li>

  <?php } ?>
</ul>

<div class="tab-content col-md-6 attr_fld_dv">
<?php
$sl=0;
foreach($attr_heading_result->result() as $attr_heading_row){
$sl++;
?>

    <div class="tab-pane" id="tab_a<?=$sl; ?>">
    	<table>
    	<?php
		$query = $this->db->query("SELECT * FROM attribute_real WHERE attribute_heading_id=$attr_heading_row->attribute_heading_id");
		$field_result = $query->result();
		foreach($field_result as $attr_fld_row){
		?>
       		<tr>
            	<td width="30%"><?=$attr_fld_row->attribute_field_name; ?></td>
                <td>
                	<?php
					if($attr_fld_row->attribute_field_name == 'Color'){
						if($color_result != false){
					?>
                    <input type="hidden" name="hidden_attr_id[]" value="<?=$attr_fld_row->attribute_id;?>">
					<select name="attr_value[]">
                    	<option value="">Choose color</option>
                        <?php foreach($color_result as $color_row){ ?>
						
                        <option style="background-color:<?=$color_row->clr_cod;?>;" value="<?=$color_row->clr_name;?>"><?=$color_row->clr_name;?></option>
                        <?php } // End of foreach loop ?>
						
                    </select>
                    <?php } ?>
					<?php 
					} // End of color attribute condition
					else if($attr_fld_row->attribute_field_name == 'Size'){ //start of size attribute condition
						if($size_result != false){
							$attribute_id = $attr_fld_row->attribute_id;
					?>
                    <input type="hidden" name="hidden_attr_id[]" value="<?=$attr_fld_row->attribute_id;?>">
					<select name="attr_value[]">
                    	<option value="">Select size</option>
                        <?php foreach($size_result as $size_row){ ?>
                        <option value="<?=$size_row->size_name;?>"><?=$size_row->size_name;?></option>
                        <?php } // End of foreach loop ?>
                    </select>
                  	<?php
						}
					} // End of size attribute condition
					else if($attr_fld_row->attribute_field_name == 'Size Type'){ //start of size type attribute condition
						if($sub_size_result != false){
					?>
                    <!--Sub size code-->
                    <input type="hidden" name="hidden_attr_id[]" value="<?=$attr_fld_row->attribute_id;?>">
                    <select name="attr_value[]">
                    	<option value="">Select</option>
                        <?php foreach($sub_size_result as $sub_size_row){ ?>
                        <option value="<?=$sub_size_row->size_name;?>"><?=$sub_size_row->size_name;?></option>
                        <?php } // End of foreach loop ?>
                    </select>
                    <?php
						}
					}  //End size type attribute condition
					else
					{
					?>
                	<input type="hidden" name="hidden_attr_id[]" value="<?=$attr_fld_row->attribute_id;?>">
                	<input type="text" class="text" name="attr_value[]">
                    <?php }?>
                    <input type="hidden" name="attr_fld_nm[]" value="<?=$attr_fld_row->attribute_field_name;?>">
                </td>
            </tr>
        <?php } //End of attribute field foreach loop?>
        </table>
    </div>
        
<?php } ?>    
</div><!-- tab content -->

<?php } //end of if condition ?>
</div>


<script>
$(document).ready(function(){
	$( ".attr_tab_ul li:first-child" ).addClass( "active" );
	$(".attr_fld_dv div:first-child").addClass( "active" );
});
</script>