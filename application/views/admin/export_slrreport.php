<?php
# replace excelfile.xls with whatever you want the filename to default to
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=seller_report.xls");
header("Pragma: no-cache");
header("Expires: 0"); ?>
<div id="container">
<div id="header">
<div id="mainContent" align="center">   
 
<div style="padding-left:250px;">
	<table border="1">
    	<tr>
        	<th bgcolor="#FBFB00">SL NO.</th>
            <th bgcolor="#FBFB00">New  Registered</th>
            <th bgcolor="#FBFB00">Registered Date</th>
            <th bgcolor="#FBFB00">Status</th>
            <th bgcolor="#FBFB00">Zero Ratings</th>
            <th bgcolor="#FBFB00">Good Ratings</th>
            <th bgcolor="#FBFB00">Excellent Ratings</th>
        </tr>
        <?php
		$slrrept_row = $result->num_rows();
		if($slrrept_row > 0){
			$sl=0;
			foreach($result->result() as $rows){
				$sl++;
		?>
        <tr>
        	<td><?php echo $sl;?></td>
                                <td><?=$rows->business_name;?></td>
                                <td><?=$rows->register_date;?></td>
                                <td><?=$rows->status;?></td>
                                
                                <td><?php
								$seller_id= $rows->seller_id;
								$query = $this->db->query("SELECT seller_id FROM review_seller WHERE seller_id='$seller_id' AND rating_type='Bad' GROUP BY seller_id");
								if($query->num_rows()>0)
								{
									echo $query->num_rows();
								}
								else
								{
									echo '0';
								}
								?></td>
                                <td>
							<?php	$query = $this->db->query("SELECT seller_id FROM review_seller WHERE seller_id='$seller_id' AND rating_type='Good' GROUP BY seller_id");
								if($query->num_rows()>0)
								{
									echo $query->num_rows();
								}
								else
								{
									echo '0';
								}
								?>
								</td>
                                <td>
								<?php $query = $this->db->query("SELECT seller_id FROM review_seller WHERE seller_id='$seller_id' AND rating_type='Best' GROUP BY seller_id");
								if($query->num_rows()>0)
								{
									echo $query->num_rows();
								}
								else
								{
									echo '0';
								}
								?>
								</td>
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