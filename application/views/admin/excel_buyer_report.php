<?php
# replace excelfile.xls with whatever you want the filename to default to
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=buyer_profile_report.xls");
header("Pragma: no-cache");
header("Expires: 0"); ?>
<div id="container">
<div id="header">
<div id="mainContent" align="center">   
 
<div style="padding-left:250px;">
	<table border="1">
    	<tr>
        	<th bgcolor="#FBFB00">SL. NO.</th>
            <th bgcolor="#FBFB00">Buyer Name</th>
            <th bgcolor="#FBFB00">Registered Date</th>
            <th bgcolor="#FBFB00">Gender</th>
            <th bgcolor="#FBFB00">Mob. No.</th>
            <th bgcolor="#FBFB00">Email</th>
            <th bgcolor="#FBFB00">Country</th>
            <th bgcolor="#FBFB00">State</th>
            <th bgcolor="#FBFB00">Street Address</th>
            <th bgcolor="#FBFB00">City</th>
            <th bgcolor="#FBFB00">Pincode</th>
            <th bgcolor="#FBFB00">Buyer Status</th>
        </tr>
        <?php
		$buyrprfl_row = $result->num_rows();
		if($buyrprfl_row > 0){
			$sl=0;
			foreach($result->result() as $rows){
				$sl++;
		?>
        <tr>
        	<td><?php echo $sl;?></td>
                                <td> <?php echo $rows->full_name;?></td>
                                <td> <?php echo $rows->registration_date;?></td>
                                <td> <?php echo $rows->gendr; ?></td>
                                <td> <?php echo $rows->mob;?></td>
                                <td> <?php echo $rows->email;?></td>
                                 <td><?php echo $rows->country;?></td>
                                 <td> <?php echo $rows->state;?></td>
                                 <td> <?php echo $rows->address;?></td>
                                <td> <?php echo $rows->city;?></td>
                                <td><?php echo $rows->pin_code;?></td>
                                <td> <?php echo $rows->status;?></td>
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