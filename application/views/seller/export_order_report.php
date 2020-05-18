<?php
# replace excelfile.xls with whatever you want the filename to default to
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=order_report.xls");
header("Pragma: no-cache");
header("Expires: 0"); ?>
<div id="container">
<div id="header">
<div id="mainContent" align="center">   
 
<div style="padding-left:250px;">
	<table border="1">
    	<tr>
        	<th bgcolor="#FBFB00">SL ID</th>
            <th bgcolor="#FBFB00">date_of_order</th>
            <th bgcolor="#FBFB00">order_id</th>
            <th bgcolor="#FBFB00">email</th>
            <th bgcolor="#FBFB00">Total_amount</th>
            <th bgcolor="#FBFB00">order_status</th>
        </tr>
        <?php
		$ct=count($result);
								if($ct > 0){
									$sl=0;
									foreach($result as $res_orderepo){
				$sl++;
		?>
        						<td><?php echo $sl; ?></td>
                                <td><?php $date_of_order=substr($res_orderepo->date_of_order,0,10); 
										echo date('d-M-Y',strtotime($date_of_order));?></td>
                                <td><?=$res_orderepo->order_id; ?></td>
                                <td ><?=$res_orderepo->email; ?></td>
                                <td>Rs.<?=$res_orderepo->Total_amount; ?></td>
                                <td><?=$res_orderepo->order_status; ?></td>
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