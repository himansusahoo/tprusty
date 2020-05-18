<?php
# replace excelfile.xls with whatever you want the filename to default to
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=onlinepayment_report.xls");
header("Pragma: no-cache");
header("Expires: 0"); ?>
<div id="container">
<div id="header">
<div id="mainContent" align="center">   
 
<div style="padding-left:250px;">
	<table border="1">
    	<tr>
        	<th bgcolor="#FBFB00">Customr Oder No</th>
            <th bgcolor="#FBFB00">PG Order NO</th>
            
            <th bgcolor="#FBFB00">Total Order Amount</th>
            <th bgcolor="#FBFB00">Order Status</th>
            
        </tr>
        <?php
		$onlinepay_row = $result_onlinepay->num_rows();
		if($onlinepay_row > 0){
			$sl=0;
			foreach($result_onlinepay->result() as $rows){
				$sl++;
		?>
        <tr>
        	<td><?="'".$rows->order_id."'";?></td>
								<td>
                                	
									<?="'".$rows->order_id_payment_gateway	."'";?>
                                </td>
								
                                <td><?=$rows->Total_amount;?></td>
								<td><?=$rows->order_status;?></td>
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