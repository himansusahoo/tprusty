<?php
# replace excelfile.xls with whatever you want the filename to default to
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Tax_report.xls");
header("Pragma: no-cache");
header("Expires: 0"); ?>
<div id="container">
<div id="header">
<div id="mainContent" align="center">   
 
<div style="padding-left:250px;">
	<table border="1">
    	<tr>
        
       							<th bgcolor="#FBFB00">Product ID</th>
                                <th bgcolor="#FBFB00">Product Name</th>
								<th bgcolor="#FBFB00">Seller Name</th>
								<th bgcolor="#FBFB00">MRP</th>
								<th bgcolor="#FBFB00">Selling Price</th>
								<th bgcolor="#FBFB00">Special Price</th>
                                <th bgcolor="#FBFB00">Special Price from date</th>
                                <th bgcolor="#FBFB00">Special Price to date</th>
                                <th bgcolor="#FBFB00">GST</th>
        						
        	
        </tr>
        <?php
		$taxreport = $result->num_rows();
		if($taxreport > 0){
			$sl=0;
			foreach($result->result() as $rows){
				$sl++;
		?>
        <tr>
              <td><?php echo $rows->product_id;?></td>
                                <td> <?php echo $rows->name;?></td>
                                <td> <?php echo $rows->business_name; ?></td>
                                <td> <?php echo $rows->mrp;?></td>
                                <td> <?php echo $rows->price;?></td>
                                 <td><?php echo $rows->special_price;?></td>
                                 <td> <?php $special_pric_from_dt=substr($rows->special_pric_from_dt,0,10); 
										echo date('d-M-Y',strtotime($special_pric_from_dt));
										?></td>
                                 <td> <?php $special_pric_to_dt=substr($rows->special_pric_to_dt,0,10); 
										echo date('d-M-Y',strtotime($special_pric_to_dt));?></td>
                                <td> <?php echo $rows->tax_amount;?>%</td>
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