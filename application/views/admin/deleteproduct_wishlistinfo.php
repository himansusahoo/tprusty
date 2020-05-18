<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>css/admin/styles.css">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>css/admin/font-awesome.min.css">
        <link href="<?php echo base_url();?>css/admin/font-awesome.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url();?>css/admin/bootstrap.min.css">
<h3>Wishlist Detail</h3>
<table class="table table-bordered table-hover">
					<tr class="table_th" style="background-color:#0CC;">
                    <td>EmailID</td>
                    <td>Quantity</td>
                    </tr>
                    
                    <?php if($wishlistinfo->num_rows()>0){ 
					foreach($wishlistinfo->result_array() as $res_wishlist){
					?>
                    <tr>
                    <td><?=$res_wishlist['email']?></td>
                    <td>
					<?php
					$user_id=$res_wishlist['user_id']; 
					$sku=$res_wishlist['sku'];
					
					$qr=$this->db->query("SELECT * FROM wishlist WHERE user_id=$user_id AND sku='$sku' ");
						
					echo $qr->num_rows(); 
					?></td>
                    </tr>            
                    
                    <?php 
							} // for loop end
					 }else{ ?>
                    
                    <tr><td colspan="2">No Record Found</td></tr>
                    <?php } ?>
                    
                    
</table>