<?php
if($excelupload_statu!="cancelled")
{
$uploded_id=$excelupload_statu;
$qr_uplod=$this->db->query("SELECT uploadprod_sqlid,uploadprod_uid,qc_status from bulkproductupload_log WHERE uploadprod_uid='$uploded_id' AND qc_status='Passed' ");
$ctr_uploadtot=$qr_uplod->num_rows();

 ?>
 
<span style="text-align:center; color:#0C0;"> <img src="<?php echo base_url().'images/success_icon.png' ?>"> <?=$ctr_uploadtot?> nos. of product uploaded. 
 </span>
 <?php
} else
{
 ?>
 <span style="text-align:center; color:#F00;"> <img src="<?php echo base_url().'images/error.png' ?>"> Upload Process Cancelled </span>
 <?php } ?>