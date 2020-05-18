<?php
# replace excelfile.xls with whatever you want the filename to default to
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=sales_report.xls");
header("Pragma: no-cache");
header("Expires: 0"); ?>
<div id="container">
<div id="header">
<div id="mainContent" align="center">   
 
<div style="padding-left:250px;">
	<table border="1">
    	<tr>
        	<th bgcolor="#FBFB00">SL ID</th>
            <th bgcolor="#FBFB00">Seller Name</th>
            <th bgcolor="#FBFB00">Total Orders</th>
            <th bgcolor="#FBFB00">Sale</th>
            <th bgcolor="#FBFB00">Cancel</th>
            <th bgcolor="#FBFB00">Return</th>
            <th bgcolor="#FBFB00">Replacement</th>
        </tr>
        <?php
		$salerept_row = $result->num_rows();
		if($salerept_row > 0){
			$sl=0;
			foreach($result->result() as $rows){
			$sl++;	
		?>
        <tr>
        	<td><?php echo $sl;?></td>
                                <td><?=$rows->business_name;?></td>
                                <td><?=$rows->tot_order;?></td>
                                <td><?php
								$seller_id= $rows->seller_id;
								$query = $this->db->query("SELECT order_id FROM ordered_product_from_addtocart WHERE seller_id=$seller_id AND product_order_status='Delivered' GROUP BY order_id");
								if($query->num_rows()>0)
								{
									echo $query->num_rows();
								}
								else
								{
									echo '0';
								}
								?></td>
                                <td>
							<?php	$query = $this->db->query("SELECT order_id FROM ordered_product_from_addtocart WHERE seller_id=$seller_id AND product_order_status='Cancelled' GROUP BY order_id");
								if($query->num_rows()>0)
								{
									echo $query->num_rows();
								}
								else
								{
									echo '0';
								}
								?>
								</td>
                                <td>
								<?php $query = $this->db->query("SELECT order_id FROM ordered_product_from_addtocart WHERE seller_id=$seller_id AND product_order_status='Return Received' GROUP BY order_id");
								if($query->num_rows()>0)
								{
									echo $query->num_rows();
								}
								else
								{
									echo '0';
								}
								?>
								</td>
                                <td><?php $query = $this->db->query("SELECT a.order_id
									FROM ordered_product_from_addtocart a
									INNER JOIN order_status_log b ON a.order_id = b.order_id
									WHERE a.seller_id=$seller_id AND b.return_received_date!='0000-00-00 00:00:00' AND a.product_order_status='Delivered'");
								if($query->num_rows()>0)
								{
									echo $query->num_rows();
								}
								else
								{
									echo '0';
								}
								?></td>
        </tr>
        <?php }
		}else{?>
         <tr>
        	<td colspan="12">No Record Found.</td>
        </tr>
        <?php }?>
    </table>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/> 
        
</div>