<?php
# replace excelfile.xls with whatever you want the filename to default to
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Buyerrefund_report.xls");
header("Pragma: no-cache");
header("Expires: 0"); ?>
<div id="container">
<div id="header">
<div id="mainContent" align="center">   
 
<div style="padding-left:250px;">
	<table border="1">
    	<tr>
        		<th >SL. NO.</th>
        		<th >Order ID</th>
                     <th >Buyer Name</th>
                      <th > Refund Amount </th>
                      <th >Bank Name</th>
                       <th >Account Holder Name</th>
                         <th >Account No.</th>
                         <th >IFSC Code</th>
                         <th> UTR NO. </th>
           
        </tr>
        <?php
		
		if(count($buyer_refund) > 0){
			$sl=0;
			foreach($buyer_refund as $rows){
				$sl++;
		?>
        <tr>
        	<td><?=$sl;?></td>
            <td>'<?=$rows->order_id;?>'</td>
        	<td><?= $rows->fname. " ". $rows->lname  ?></td>
        	<td>Rs.<?= $rows->total_amount ?></td>
            <td><?= $rows->bank_name ?></td>
            <td><?= $rows->Ac_holder_name ?></td>
           <td>'<?= $rows->Ac_no ?>'</td>
            <td>'<?= $rows->IFSC ?>'</td>
            <td> </td>
            
        </tr>
        <?php }}else{?>
         <tr>
        	<td colspan="12">No Record Found.</td>
        </tr>
        <?php }?>
    </table>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/> 
        
</div>