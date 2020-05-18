<?php
# replace excelfile.xls with whatever you want the filename to default to
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=buyer_report.xls");
header("Pragma: no-cache");
header("Expires: 0"); ?>
<div id="container">
<div id="header">
<div id="mainContent" align="center">   
 
<div style="padding-left:250px;">
	<table border="1">
    	<tr>
        	<th bgcolor="#FBFB00">SL NO.</th>
            <th bgcolor="#FBFB00">Name</th>
            <th bgcolor="#FBFB00">Email</th>
            <th bgcolor="#FBFB00">Phone Number</th>
            <th bgcolor="#FBFB00">Address</th>
            <th bgcolor="#FBFB00">Total Ordered</th>
            <th bgcolor="#FBFB00">Total Returned</th>
            <th bgcolor="#FBFB00">Total Cancel</th>
            <th bgcolor="#FBFB00">Total Replacement</th>
        </tr>
        <?php
		$buyrrept_row = $result->num_rows();
		if($buyrrept_row > 0){
			$sl=0;
			foreach($result->result() as $rows){
				$sl++;
		?>
        <tr>
        	<td><?php echo $sl;?></td>
                                <td> <?php echo $rows->full_name;?></td>
                                <td> <?php echo $rows->email; ?></td>
                                <td> <?php echo $rows->mob;?></td>
                                <td><?php echo $rows->address;?></td>
                                <td> <?php echo $rows->totl_order;?></td>
                                <td>
                                <?php
								$user_id= $rows->user_id;
								$query = $this->db->query("SELECT * FROM `ordered_product_from_addtocart` WHERE product_order_status='Return Received' AND user_id=$user_id GROUP BY user_id");
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
                                <td><?php
								$user_id= $rows->user_id;
								$query = $this->db->query("SELECT * FROM `ordered_product_from_addtocart` WHERE product_order_status='Failed' AND user_id=$user_id GROUP BY user_id");
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
                                <?php $query = $this->db->query("SELECT a.order_id
									FROM ordered_product_from_addtocart a
									INNER JOIN order_status_log b ON a.order_id = b.order_id
									WHERE a.user_id=$user_id AND b.return_received_date!='0000-00-00 00:00:00' AND a.product_order_status='Delivered' ");
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
        </tr>
        <?php }}else{?>
         <tr>
        	<td colspan="9">No Record Found.</td>
        </tr>
        <?php }?>
    </table>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/> 
        
</div>