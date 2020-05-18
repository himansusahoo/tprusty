<?php
# replace excelfile.xls with whatever you want the filename to default to
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=seller_profile_report.xls");
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
            <th bgcolor="#FBFB00">State</th>
            <th bgcolor="#FBFB00">City</th>
            <th bgcolor="#FBFB00">Seller Email Address</th>
            <th bgcolor="#FBFB00">Approval Date</th>
            <th bgcolor="#FBFB00">Status</th>
            <th bgcolor="#FBFB00">Bank Account Holder Name</th>
            <th bgcolor="#FBFB00">IFSC Code</th>
            <th bgcolor="#FBFB00">Bank Name</th>
            <th bgcolor="#FBFB00">Branch Name</th>
            <th bgcolor="#FBFB00">Bank account State</th>
            <th bgcolor="#FBFB00">PAN CARD</th>
            <th bgcolor="#FBFB00">TIN NO</th>
            <th bgcolor="#FBFB00">TAN ID</th>
        </tr>
        <?php
		$slrprfl_row = $result->num_rows();
		if($slrprfl_row > 0){
			$sl=0;
			foreach($result->result() as $rows){
				$sl++;
		?>
        <tr>
        	<td><?php echo $sl;?></td>
                                <td> <?php echo $rows->business_name;?></td>
                                <td> <?php echo $rows->seller_state;?></td>
                                <td> <?php echo $rows->seller_city; ?></td>
                                <td> <?php echo $rows->email;?></td>
                                <td> <?php echo $rows->approval_date;?></td>
                                 <td><?php echo $rows->status;?></td>
                                 <td> <?php echo $rows->ac_holder_name;?></td>
                                 <td> <?php echo $rows->ifsc_code;?></td>
                                <td> <?php echo $rows->bank;?></td>
                                <td><?php echo $rows->branch;?></td>
                                <td> <?php echo $rows->state;?></td>
                                <td> <?php echo $rows->pan; ?></td>
                                <td> <?php echo $rows->tin;?></td>
                                <td> <?php echo $rows->tan;?></td>
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