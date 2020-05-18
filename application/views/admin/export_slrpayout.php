<?php
# replace excelfile.xls with whatever you want the filename to default to
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=seller_payout_report.xls");
header("Pragma: no-cache");
header("Expires: 0"); ?>
<div id="container">
<div id="header">
<div id="mainContent" align="center">   
 
<div style="padding-left:250px;">
	<table border="1">
    	<tr>
        	<th bgcolor="#FBFB00">Pay Out Gen. Date</th>
            <th bgcolor="#FBFB00">Seller Name</th>
            <th bgcolor="#FBFB00">Seller ID</th>
            <th bgcolor="#FBFB00">No of Orders</th>
            <th bgcolor="#FBFB00">Final stl Amt</th>
            <th bgcolor="#FBFB00">Accnt. No</th>
            <th bgcolor="#FBFB00">Bank Name</th>
            <th bgcolor="#FBFB00">IFSC Code</th>
            <th bgcolor="#FBFB00">Accnt. Holder Name</th>
            <th bgcolor="#FBFB00">UTR No.</th>
            <th bgcolor="#FBFB00">Status</th>
            
        </tr>
        <?php
		$slrpayout_row = $result->num_rows();
		if($slrpayout_row > 0){
			$sl=0;
			foreach($result->result() as $rows){
				$sl++;
		?>
        <tr>
        	<td><?=$rows->pyt_generated_dt;?></td>
								<td>
                                	<input type="hidden" name="hidden_id[]" value="<?=$rows->id;?>">
									<?=$rows->business_name;?>
                                </td>
								<td><?=$rows->seller_id;?></td>
                                <td><?=$rows->no_of_orders;?></td>
								<td><?=$rows->fnl_stl_amt;?></td>
								<td><?=$rows->bnk_acnt_no;?></td>
								<td><?=$rows->bnk_name;?></td>
								<td><?=$rows->bnk_ifsc_code;?></td>
                                <td><?=$rows->acnt_hldr_name;?></td>
								<td width="10%"><?=$rows->utr_no;?>
                                </td>
                                <td width="10%"><?=$rows->status;?></td>
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