<h4 style="margin-left:50px;">Commission by product category</h4>
<table class="table-bordered table-hover commission_tbl" align="center" style=" width:100%; margin:0px;">
    <tr class="commision_tr_hed">
        <th> &nbsp;Product category</th>
        <th> &nbsp;Seller Commission</th>
        <th> &nbsp;Action</th>
    </tr>
    <?php
	$sl=0;
	foreach($category_n_membcommission_result as $cat_commsion_row){ 
	$sl++;
	?>
    <tr>
        <td>
        <span class="first_cat">
		<?php
        $sql = $this->db->query("SELECT category_name,category_id FROM category_indexing 
        WHERE category_id=(SELECT parent_id FROM category_indexing WHERE category_id='$cat_commsion_row->parent_id')");
        $row = $sql->row();
        echo $row->category_name;
        ?>
        <span class="thrd_cart"><?=$cat_commsion_row->category_name;?></span>
        </span>
        </td>
        <td>
        	<input type="text" name="memb_commission" id="memb_commission<?=$sl;?>" class="text2" value="<?=$cat_commsion_row->MEMB_COMMISSION;?>">
            <img src="<?php echo base_url();?>images/progress.gif" class="comsn_loader" id="loder<?=$sl;?>">
           	<img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader" id="loder_complt<?=$sl;?>">
            <img src="<?php echo base_url();?>images/error.png" class="comsn_loader" id="loder_fail<?=$sl;?>">
        </td>
        <td><span class="edt" onclick="InserUpdateMembershipCommission(<?=$cat_commsion_row->category_id;?>,<?=$sl;?>)">update</span></td>
    </tr>
    <?php } ?>
     <tr>
</table>