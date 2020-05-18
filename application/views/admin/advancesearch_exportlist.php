<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>css/admin/styles.css">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>css/admin/font-awesome.min.css">
        <link href="<?php echo base_url();?>css/admin/font-awesome.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url();?>css/admin/bootstrap.min.css">
<h3>Download List</h3>
<script>
function select_radio(sl)
{
		
		if(document.getElementById('attrbgrpid'+sl).checked== true)
		{
			document.getElementById('ctagid'+sl).checked='checked';
			
		}
		else if(document.getElementById('attrbgrpid'+sl).checked== false)
		{
			
			document.getElementById('ctagid'+sl).checked='';
			
		}		  
	
}
</script>
<?php echo form_open('admin/Advance_search/exportproduct_attributewise'); ?>
<table class="table table-bordered table-hover">
					<tr class="table_th" style="background-color:#0CC;">
                    <th>Category</th>
                    <th>Attribute</th>
                    </tr>                    
                 <?php if($fltrcatg_id!='' && $fltr_attrbgrpid!=''){ 
				 $i=1;
				 $qr_attrb=$this->db->query("SELECT * FROM  attribute_group WHERE attribute_group_id IN ($fltr_attrbgrpid)");
				 foreach($qr_attrb->result_array() as $res_attrb)	{			 
				 ?> 
                    <tr>
                    <td> <input type="radio" name="attrbgrpid[]" id="attrbgrpid<?=$i?>" value="<?=$res_attrb['attribute_group_id']?>" 
                    onclick="select_radio('<?=$i?>')" />
                    <?php 
					$attrbgroups_id=$res_attrb['attribute_group_id'];
					if($fltrseller_ids!='')
					{
						$qr=$this->db->query("SELECT b.lvl2_name,b.lvl2 FROM product_setting a 
					                      INNER JOIN  cornjob_productsearch b ON a.product_id=b.product_id
										  WHERE a.attribut_set='$attrbgroups_id' AND b.lvl2 IN ($fltrcatg_id) AND b.seller_id IN ($fltrseller_ids) AND b.sku!='' GROUP BY a.attribut_set  "); 	
					}
					else
					{
					$qr=$this->db->query("SELECT b.lvl2_name,b.lvl2 FROM product_setting a 
					                      INNER JOIN  cornjob_productsearch b ON a.product_id=b.product_id
										  WHERE a.attribut_set='$attrbgroups_id' AND b.lvl2 IN ($fltrcatg_id) AND b.sku!='' GROUP BY a.attribut_set  "); 
					}
						echo $qr->row()->lvl2_name;				  
						?>
                        
                        <input style="display:none;" type="radio" name="ctagid[]" id="ctagid<?=$i?>" value="<?=$qr->row()->lvl2?>"  />
					</td>
                    
                    <td>
					<?=$res_attrb['attribute_group_name']?>
                    </td>
                    </tr>            
                    
                   <?php $i++; }  ?>
				   
                   <tr><td colspan="2"><input type="submit" name="dwnl_excel" id="dwn_excel" value="Download">   </td> </tr>
                   
				   <?php } else {?>
                    
                    <tr><td colspan="2">No Record Found</td></tr><br />
					<?php } ?>
                   
                    
</table>
<?php echo form_close(); ?>