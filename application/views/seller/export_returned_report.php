<?php
# replace excelfile.xls with whatever you want the filename to default to
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=returned_order_report.xls");
header("Pragma: no-cache");
header("Expires: 0"); ?>
<div id="container">
<div id="header">
<div id="mainContent" align="center">   
 
<div style="padding-left:250px;">
	<table border="1">
    	<tr>
        
        
        
        						<th bgcolor="#FBFB00">Sl. No.</th>
								<th bgcolor="#FBFB00">Return Date</th>
								<th bgcolor="#FBFB00">Order ID</th>
								<th bgcolor="#FBFB00">Return ID</th>
                                <th bgcolor="#FBFB00">Product Name</th>
                                <th bgcolor="#FBFB00">Quantity</th>
                                <th bgcolor="#FBFB00">Reason</th>
                                <th bgcolor="#FBFB00">Customer Email</th>
                                <th bgcolor="#FBFB00">Amount</th>
                                <th bgcolor="#FBFB00">Status</th>
            
        </tr>
        <?php
		$ct=count($result);
								if($ct > 0){
									$sl=0;
									foreach($result as $res_retnrepo){
				$sl++;
		?>
        						<td><?=$sl; ?></td>
                                <td><?php $return_date=substr($res_retnrepo->cdate,0,10);
								echo date('d-M-Y',strtotime($return_date));?></td>
                                <td><?=$res_retnrepo->order_id; ?></td>                                
                                <td><?=$res_retnrepo->return_id; ?></td>
                                <td><?=$res_retnrepo->name; ?></td>
                                <td><?=$res_retnrepo->quantity; ?></td>
                                <td><?=$res_retnrepo->reason; ?></td>
                                <td><?=$res_retnrepo->email; ?></td>                                
                                <td>Rs.<?=$res_retnrepo->total_amount; ?></td>
                                <td><?=$res_retnrepo->status; ?></td>
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