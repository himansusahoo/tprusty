

<!--<div style="background-color:#FFF; border: 1px solid; border-radius: 5px; text-align:center; height:150px;"> 
<img src="<?php //echo base_url().'images/success_icon.png' ?>"> <?//=//$indx_sts?> Indexed in Solr Server Successfully. 
</div>-->
<div style="font-weight:bold; color:#F00;">
<?php
$qr=$this->db->query("SELECT sql_id FROM solar_indexing WHERE indexing_status='Pending' ");
		 $qr->num_rows();
		
		echo 'Total Record Pending: '.$qr->num_rows();
 ?>
 </div>

<div align="center">
<?php echo  $indx_sts; ?>
<?php /*?><fieldset style="background-color:rgb(193, 226, 217); border: 1px solid; border-radius: 5px; text-align:center; height:75px;"><legend style="background-color:#CCC;">Indexed Status</legend>
SKU:<span style="font-weight:bold;"> <?=$indx_sts?> </span> &nbsp;
<img src="<?php echo base_url().'images/success_icon.png' ?>"> Indexed in Solr Server Successfully. 

</fieldset><?php */?>

</div>