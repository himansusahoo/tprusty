<?php
# replace excelfile.xls with whatever you want the filename to default to
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Seller_payout_report.xls");
header("Pragma: no-cache");
header("Expires: 0"); ?>
<div id="container">
<div id="header">
<div id="mainContent" align="center">
 
<div style="padding-left:250px;">
	<table border="1">
    	<tr>
        	<th bgcolor="#FBFB00">SL. NO.</th>
            <th bgcolor="#FBFB00">Seller Name</th>
            <th bgcolor="#FBFB00">Seller ID</th>
            <th bgcolor="#FBFB00">No of Orders</th>
            <th bgcolor="#FBFB00">Final stld Amt</th>
            <th bgcolor="#FBFB00">Accnt No</th>
            <th bgcolor="#FBFB00">Bank Name</th>
            <th bgcolor="#FBFB00">Ifsc Code</th>
            <th bgcolor="#FBFB00">Accnt holder Name</th>
            <th bgcolor="#FBFB00">UTR No.</th>
        </tr>
        <?php
		$payout_row = $result->num_rows();
		if($payout_row > 0){
			$sl=0;
			foreach($result->result() as $rows){
				$sl++;
		?>
        <tr>
        	<td><?=$sl;?></td>
        	<td><?=$rows->business_name;?></td>
        	<td><?=$rows->seller_id;?></td>
            <td><?=$rows->no_of_orders;?></td>
            <td><?=$rows->fnl_stl_amt;?></td>
            <td>'<?=$rows->bnk_acnt_no;?>'</td>
            <td><?=$rows->bnk_name;?></td>
            <td><?=$rows->bnk_ifsc_code;?></td>
            <td><?=$rows->acnt_hldr_name;?></td>
            <td><?=$rows->utr_no;?></td>
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