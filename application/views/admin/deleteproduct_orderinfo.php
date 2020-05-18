<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>css/admin/styles.css">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>css/admin/font-awesome.min.css">
        <link href="<?php echo base_url();?>css/admin/font-awesome.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url();?>css/admin/bootstrap.min.css">
<h3>Order Detail</h3>
<table class="table table-bordered table-hover">
					<tr class="table_th" style="background-color:#0CC;">
                    <td>Order No</td>
                    <td>Order Status</td>
                    </tr>
                    
                    <?php if($orderinfo->num_rows()>0){ 
					foreach($orderinfo->result_array() as $res_order){
					?>
                    <tr>
                    <td><?=$res_order['order_id']?></td>
                    <td><?=$res_order['product_order_status']?></td>
                    </tr>
                    
                    <?php 
							} // for loop end
					 }else{ ?>
                    
                    <tr><td colspan="2">No Record Found</td></tr>
                    <?php } ?>
                    
                    
</table>