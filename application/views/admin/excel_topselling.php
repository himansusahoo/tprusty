<?php
# replace excelfile.xls with whatever you want the filename to default to
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Topselling_report.xls");
header("Pragma: no-cache");
header("Expires: 0"); ?>
<div id="container">
<div id="header">
<div id="mainContent" align="center">   
 
<div style="padding-left:250px;">
	<table border="1">
    	<tr>
        
        						<th bgcolor="#FBFB00">SL NO.</th>
                                <th bgcolor="#FBFB00">Product Name</th>
								<th bgcolor="#FBFB00">Seller Name</th>
								<th bgcolor="#FBFB00">Selling Quantity</th>
								<th bgcolor="#FBFB00">Sale Ranking</th>
								<th bgcolor="#FBFB00">Approve Status</th>
                                <th bgcolor="#FBFB00">Display Status</th>
        	
        </tr>
        <?php
		$topselling = $result->num_rows();
		if($topselling > 0){
			$sl=0;
			foreach($result->result() as $rows){
				$sl++;
		?>
        <tr>
        	<td><?php echo $sl;?></td>
                                <td> <?php echo $rows->name;?></td>
                                <td> <?php echo $rows->business_name; ?></td>
                                <td> <?php echo $rows->salesqnty;?></td>
                                <td></td>
                                <td> <?php echo $rows->approve_status;?></td>
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