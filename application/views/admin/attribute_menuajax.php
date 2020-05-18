<?php //echo '<pre>';print_r($attrbset_data);exit; 
	if($attrbset_data!=''){
?>

<select class="seller_input" id="attribute_set" name="attribute_set" onChange="select_subattrb(this.value)" >
		<option value="">--Choose Attribute--</option>
		<?php foreach($attrbset_data->result_array() as $set_data) { ?>
			<option value="<?=$set_data['attribute_group_id'];?>"><?=$set_data['attribute_group_name'];?></option>
		<?php } ?>
</select>
<?php } else{ ?>
<select class="seller_input" id="attribute_set" name="attribute_set" onChange="select_subattrb(this.value)" >
		<option value="">--No Attribute Found--</option>
</select>
<?php }?>