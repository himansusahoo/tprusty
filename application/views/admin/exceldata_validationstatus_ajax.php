<!--<img src="<?php //echo base_url().'images/error.png'  ?>"> -->
<!--<img src="<?php //echo base_url().'images/success_icon.png'  ?>"> -->

<?php if ($insertvalid_staus == "File has expired") { ?>
    <span style="text-align:center; color:#F00" > <img src="<?php echo base_url() . 'images/error.png' ?>"> Excel file has expired. </span>

<?php
} else {
    $uploded_id = $insertvalid_staus;
    $qr_uplod = $this->db->query("SELECT uploadprod_sqlid,uploadprod_uid,qc_status from bulkproductupload_log WHERE uploadprod_uid='$uploded_id' AND upload_status='Pending' ");
    $ctr_uploadtot = $qr_uplod->num_rows();

    $ctr_uploadpassed = 0;
    $ctr_uploadfailed = 0;

    foreach ($qr_uplod->result_array() as $res_uplod) {
        if ($res_uplod['qc_status'] == "Passed") {
            $ctr_uploadpassed++;
        } else {
            $ctr_uploadfailed++;
        }
    }

    if ($ctr_uploadfailed == 0 && $ctr_uploadfailed != $ctr_uploadtot) {
        ?>
        <span style="text-align:center; color:#333" > Do You want to continue to upload  <?= $ctr_uploadtot ?> nos. of products  </span>
        <table align="center"> 
            <tr>
                <td>
                    <input type="button" id="conf" name="conf" value="Yes" onclick="confirm_tosaveproduct('<?= $uploded_id ?>', 'yes')" />    	
                </td>
                <td>
                    <input type="button" id="conf" name="notconf" value="No" onclick="confirm_tosaveproduct1('<?= $uploded_id ?>', 'no')" /> 
                    <!--<input type="button" id="conf" name="notconf" value="No" onclick="confirm_tosaveproduct('<?//=//$uploded_id?>','no')" /> -->
                </td>    
            </tr>
        </table>

    <?php } ?>

    <?php if ($ctr_uploadfailed > 0 && $ctr_uploadfailed != $ctr_uploadtot) { ?>
        <span style="text-align:center; color:#333" > Do You want to continue to upload  <?= $ctr_uploadpassed ?> nos. of products out of <?= $ctr_uploadtot ?> nos. products  </span>
        <table align="center"> 
            <tr>
                <td>
                    <input type="button" id="conf" name="conf" value="Yes" onclick="confirm_tosaveproduct('<?= $uploded_id ?>', 'yes')" />    	
                </td>
                <td>
                    <input type="button" id="conf" name="notconf" value="No" onclick="confirm_tosaveproduct1('<?= $uploded_id ?>', 'no')" />
                        <!--<input type="button" id="conf" name="notconf" value="No" onclick="confirm_tosaveproduct('<?//=//$uploded_id?>','no')" /> -->
                </td>    
            </tr>
        </table>

    <?php
    }
    if ($ctr_uploadfailed == $ctr_uploadtot) {
        ?>
        <span style="text-align:center; color:#F00" > All Product Data has QC Failed </span>

    <?php
    }
}
?>