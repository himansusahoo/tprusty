<div class="load_attr_dv">
<?php
$attr_heading_rows = $attr_heading_result->num_rows();
$attr_heading_rows_length = count($attr_heading_rows);
if($attr_heading_rows > 0){
	
	//program start for getting filter attribute id //
	$filter_attr_rows = $filter_attr_result->num_rows();
	if($filter_attr_rows > 0){
		foreach($filter_attr_result->result() as $fltr_attr_rw){
			$fltr_attr_id = unserialize($fltr_attr_rw->attr_id);
		}
	}else{
		$fltr_attr_id = array();
	}
	//program start for getting filter attribute id //
	
	echo form_open('admin/filter/get_filter_data');
?>
<input type="submit" id="attr_sav_btn" class="all_buttons" value="Submit" style="margin-right:20px;">
<?php
	$sl=0;
	foreach($attr_heading_result->result() as $attr_heading_row){
	$sl++;
?>
<ul class="attr_heading_ul">
    <h4><a href="#" data-toggle="pill"><?=$attr_heading_row->attribute_heading_name;?></a></h4>
    <?php
    $query = $this->db->query("SELECT * FROM attribute_real WHERE attribute_heading_id=$attr_heading_row->attribute_heading_id");
    $field_result = $query->result();
    foreach($field_result as $attr_fld_row){
    ?>
    <li>
    	<input type="hidden" name="attr_group_id[]" value="<?=$attr_fld_row->attribute_group_id;?>">
    	<input type="checkbox" name="attr_id_val[]" <?php if(in_array($attr_fld_row->attribute_id,$fltr_attr_id)){ echo 'checked';} ?> value="<?=$attr_fld_row->attribute_id;?>">&nbsp;<?=$attr_fld_row->attribute_field_name; ?>
   	</li>
<?php }?>
</ul>
<?php 
	}
echo form_close();
?>

<?php }else{ //end of if condition ?>

<div style="text-align:center;">No Record Found.</div>
<?php }?>
</div>