 <?php if($catgname->num_rows()>0){ ?>
 <select name="catgnm" id="catgnm" class="seller_input" style="width:280px;" onchange="populate_attribute(this.value)">
                                        	<option value="">---Choose Category---</option>
                                            <?php foreach($catgname->result_array() as $res_catg) { ?>
                                        	<option value="<?= $res_catg['lvl2']?>">
											<?php echo stripslashes($res_catg['lvlmain_name']).'>>'.stripslashes($res_catg['lvl1_name']).'>>'.stripslashes($res_catg['lvl2_name'])?></option>
                                             <?php } ?>                         
                                        </select>
                                       
<?php } else{?>

<span style="text-align:center;"> No Category Found </span>

<?php } ?>