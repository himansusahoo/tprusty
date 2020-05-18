<table class="table table-hover" style="background-color:#EBF5F5 !important;">
	<tr bgcolor="#DFDFDF">
        <td>Order no.</td>
        <td>Sale Value</td>
        <td>Fixed Charge</td>
        <td>season Charge</td>
        <td>PG Charge</td>
        <td>Commision</td>
        <td>Service Tax</td>
        <td>Penalty</td>
        <td>Discount</td>
        <td>Settl. Amt</td>
    </tr>
    <?php
		if($slr_payt_result != false){
			foreach($slr_payt_result as $row){
	?>
    <tr>
    	<td><?=$row->order_no;?></td>
        <td><?=$row->sale_value;?></td>
        <td><?=$row->fixed_chgs;?></td>
        <td><?=$row->season_chgs;?></td>
        <td><?=$row->pg_chgs;?></td>
        <td><?=$row->commission;?></td>
        <td><?=$row->service_tax;?></td>
        <td><?=$row->penalty;?></td>
        <td><?=$row->discount;?></td>
        <td><?=$row->fnal_settl_amt;?></td>
    </tr>
    <?php } } ?>
</table>