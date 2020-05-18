<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>css/admin/styles.css">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>css/admin/font-awesome.min.css">
        <link href="<?php echo base_url();?>css/admin/font-awesome.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url();?>css/admin/bootstrap.min.css">
<h3>Existing Product SKU Detail</h3>
<table class="table table-bordered table-hover">
					<tr class="table_th" style="background-color:#0CC;">
                    <td>SKU</td>                   
                    </tr>
                    
                    <?php if($skuinfo->num_rows()>0){ 
					foreach($skuinfo->result_array() as $res_sku){
					?>
                    <tr>
                    <td><?=$res_sku['sku']?></td>                    
                    </tr>            
                    
                    <?php 
							} // for loop end
					 }else{ ?>
                    
                    <tr><td colspan="2">No Record Found</td></tr>
                    <?php } ?>
                    
                    
</table>