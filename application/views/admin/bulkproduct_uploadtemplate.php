<?php
# replace excelfile.xls with whatever you want the filename to default to 
//header("Content-type: application/octet-stream");
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=".preg_replace('#"#',"_",preg_replace('#/#',"_",str_replace(' ','_',strtolower($catgnm))))."_".$rand_string."_".$dt_rec.".xls");
header("Pragma: no-cache");

header("Expires: 0"); ?>

	<table  border='1'>
    	  
        <tr>	
            <th bgcolor="#FFFF00">SKU</th>
            <th  bgcolor="#FFFF00">Product Name</th>           
            <th  bgcolor="#FFFF00">Description</th>
            <th  bgcolor="#FFFF00">MRP</th>
            <th  bgcolor="#FFFF00">Selling Price</th>
            <th  bgcolor="#00CC66">Special Price</th>
            <th  bgcolor="#00CC66">Special Price From Date</th>
            <th  bgcolor="#00CC66">Special Price To Date</th>
            <th  bgcolor="#FFFF00">Quantity</th>
            <th  bgcolor="#FFFF00">VAT / CST</th>
            <th  bgcolor="#FFFF00">Weight(in grams)</th>
            <th  bgcolor="#FFFF00">Image URL1</th>
            <th  bgcolor="#00CC66">Image URL2</th>
            <th  bgcolor="#00CC66">Image URL3</th>
            <th  bgcolor="#00CC66">Image URL4</th>
            <th  bgcolor="#00CC66">Image URL5</th>
            <th  bgcolor="#FF0000">Shipping Fee Type(Free/Payable)</th>
            <th  bgcolor="#FF0000">Shipping Fee Amount</th>
            <th  bgcolor="#FF0000">Status(Enabled/Disabled)</th>
            <th  bgcolor="#FFFF00">product highlights-1</th>
            <th  bgcolor="#CCCCCC">product highlights-2</th>  
            <th  bgcolor="#CCCCCC">product highlights-3</th>
            <th  bgcolor="#CCCCCC">product highlights-4</th>
            <th  bgcolor="#CCCCCC">product highlights-5</th>
            <th  bgcolor="#CCCCCC">Country of Manufacture</th>
            <th  bgcolor="#CCCCCC">Meta Title</th>
            <th  bgcolor="#CCCCCC">Meta Keywords</th>
            <th  bgcolor="#CCCCCC">Meta Description</th>
            
            
           <!-- <th  bgcolor="#CCCCCC">Set Product as New from Date</th>
            <th  bgcolor="#CCCCCC">Set Product as New to Date</th>-->
            
            <!--<th  bgcolor="#CCCCCC">Is Featured</th>-->
           
           
               
        <?php
//echo $product_sku; exit;
$attr_heading_rows = $attr_heading_result->num_rows();
$attr_heading_rows_length = count($attr_heading_rows);
if($attr_heading_rows > 0){
?>
  <?php
    $sl=0;
    foreach($attr_heading_result->result() as $attr_heading_row){
        $sl++;
		
		$query = $this->db->query("SELECT * FROM attribute_real WHERE attribute_heading_id=$attr_heading_row->attribute_heading_id");
		$colspan=$query->num_rows()
    ?>
    <th bgcolor="#99CCFF" colspan="<?=$colspan?>" ><?=$attr_heading_row->attribute_heading_name;?>
    <table>
    <tr>
    <?php  
	$field_result = $query->result();
		foreach($field_result as $attr_fld_row){
	
	 ?>
     
     <th  bgcolor="#FFCCFF"><?=$attr_fld_row->attribute_field_name; ?></th>
     <?php } ?>
    </tr>
    </table>
    
    </th>
 <?php } // for loop end ?>   
          
<?php } ?>  

</tr>    
<?php for($i=0; $i<100; $i++){ ?>       
        <tr>
        	<td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <?php  
	foreach($attr_heading_result->result() as $attr_heading_row){
		$query = $this->db->query("SELECT * FROM attribute_real WHERE attribute_heading_id=$attr_heading_row->attribute_heading_id");
		$field_result = $query->result();
		foreach($field_result as $attr_fld_row){
	
	 ?>
     
     <td></td>
     <?php }} ?>
        	
        </tr>
 <?php } ?>       
    </table>
