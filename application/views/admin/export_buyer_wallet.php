<?php
# replace excelfile.xls with whatever you want the filename to default to
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=buyerwallet_report.xls");
header("Pragma: no-cache");
header("Expires: 0"); ?>
<div id="container">
<div id="header">
<div id="mainContent" align="center">   
 
<div style="padding-left:250px;">
	<table border="1">
    	<tr>
        	<th bgcolor="#FBFB00">User ID</th>
            <th bgcolor="#FBFB00">Buyer Name</th>
            <th bgcolor="#FBFB00">Email</th>
            <th bgcolor="#FBFB00">Contact Number</th>
            <th bgcolor="#FBFB00">Total Credited</th>
            <th bgcolor="#FBFB00">Total Debited</th>
            <th bgcolor="#FBFB00">Total Used</th>
            <th bgcolor="#FBFB00">Total Available</th>
        </tr>
         <?php
						    $buyrwalt_row = $result->num_rows();
		if($buyrwalt_row > 0){
			$sl=0;
			foreach($result->result() as $rows){
				$sl++;
								?>
                            <tr>
                            	<td><?php echo $rows->user_id;?></td>
                                <td><?php echo $rows->fname." ".$rows->fname;?></td>
                                <td><?php echo $rows->email;?></td>
                                <td><?php echo $rows->mob;?></td>
                                <td><?php echo  $rows->credit;?>
								</td>
                                <td><?php echo  $rows->debit;?>
								</td>
                                
                              
                                <td><?php $query = $this->db->query("select b.order_id,c.name as prd_name,d.imag,e.business_name,b.quantity,sum(b.sub_total_amount) as total_used,e.business_name from order_info a 
		INNER JOIN ordered_product_from_addtocart b on a.order_id=b.order_id 
		INNER JOIN product_general_info c on c.product_id=b.product_id 
		INNER JOIN  product_image d  on d.product_id=b.product_id 
		INNER JOIN seller_account_information e on b.seller_id = e.seller_id 
		WHERE b.user_id='$rows->user_id' and a.payment_mode=3 ");
								$sub_total_amount=$query->row();
											if($sub_total_amount){
										echo $sub_total_amount->total_used;
								?></td>
                                <?php } ?>
                                <td><?php echo $rows->wallet_balance;?></td>
							     <td><a href='<?php echo base_url().'admin/payment/buyerwallet_detail/'.$rows->user_id ?>' target='_blank' title="View Wallet Detail"> <i style="font-size:16px;" class="fa fa-eye"></i> </a></td>
                                </tr>
                             <?php }
							 }else{?>
                             <tr>
                            	<td colspan="9">No Record Found.</td>
                            </tr>
        <?php }?>
    </table>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/> 
        
</div>