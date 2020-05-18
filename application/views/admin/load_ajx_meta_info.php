<h3>Meta Information</h3>
<table>
    <tr>
        <td style="width:20%;">Meta Title</td>
        <!--<td><input type="text" name="meta_title" class="text" value="<?php// echo $edit_product_details ? $edit_product_details[0]->meta_title : " "; ?>"></td>-->
        <td><input type="text" name="meta_title" class="text" value="<?php echo $pending_meta_info[0]->meta_title; ?>"></td>
    </tr>
    <tr>
        <td style="width:20%;">Meta Keywords<br/><span style="font-size:11px;">(keywords should be separated by comma)</span></td>
        <td><textarea name="meta_keyword" class="text" rows="7"><?php echo $pending_meta_info[0]->meta_keyword ; ?></textarea></td>
    </tr>
    <tr>
        <td>Meta Description</td>
        <td><textarea name="meta_description" class="text" rows="7"> <?php echo $pending_meta_info[0]->meta_description; ?></textarea></td>
    </tr>
</table>