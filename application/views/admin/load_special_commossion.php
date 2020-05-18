<h4 style="margin-left:50px;">Commission by product category</h4>
<table class="table-bordered table-hover commission_tbl" align="center" style=" width:100%; margin:0px;">
    <tr class="commision_tr_hed">
        <th> &nbsp;Product category</th>
        <th> &nbsp;Seller Commission</th>
        <th> &nbsp;Action</th>
    </tr>
    <?php
	$sl=0;
	foreach($category_result as $cat_row){
		$sl++;
	?>
    <tr>
        <td>
        <span class="first_cat">
		<?php
        $sql = $this->db->query("SELECT category_name,category_id FROM category_indexing 
        WHERE category_id=(SELECT parent_id FROM category_indexing WHERE category_id='$cat_row->parent_id')");
        $row = $sql->row();
        echo $row->category_name;
        ?>
        <span class="thrd_cart"><?=$cat_row->category_name;?></span>
        </span>
        
		<!--<?//=$cat_row->category_name;?>-->
        </td>
        <td>
        	<input type="text" class="text2" name="spl_commission" id="spl_commission<?=$sl;?>" value="">
            <img src="<?php echo base_url();?>images/progress.gif" class="comsn_loader" id="loder<?=$sl;?>">
           	<img src="<?php echo base_url();?>images/success_icon.png" class="comsn_loader" id="loder_complt<?=$sl;?>">
            <img src="<?php echo base_url();?>images/error.png" class="comsn_loader" id="loder_fail<?=$sl;?>">	
        </td>
        <td>
        	<span class="edt" id="sav1_spn<?=$sl;?>" onclick="SaveSpecialCommission(<?=$cat_row->category_id;?>,<?=$sl;?>)">Save</span>
            <span class="edt edt_sv" id="sav2_spn<?=$sl;?>">Save</span>
       </td>
    </tr>
    <?php } ?>
     <tr>
</table>