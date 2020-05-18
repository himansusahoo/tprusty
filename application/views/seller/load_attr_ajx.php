<div class="load_attr_dv">
<?php
$attr_heading_rows = $attr_heading_result->num_rows();
$attr_heading_rows_length = count($attr_heading_rows);
if($attr_heading_rows > 0){ 
?>
    
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
                	<input type="hidden" name="hidden_attr_id[]" value="<?=$attr_fld_row->attribute_id;?>">
                	<input type="text" class="text" name="attr_value[]">
                </td>
            </tr>
        <?php } //End of attribute field foreach loop ?>
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

