 <?php if($attrbdata->num_rows()>0){ ?>
 
  <select name="allattrb_name" id="allattrb_name" class="seller_input" style="width:280px;" onchange="select_allsubattrb(this.value)">
                                        	<option value="">---Choose Attribute---</option>
                                        	<?php foreach($attrbdata->result_array() as $rea_atrrb){ ?>
                                            
                                             <option value="<?=$rea_atrrb['attribute_group_id']?>"><?=$rea_atrrb['attribute_group_name']?></option> 
                                             
                                             <?php } ?>                               
                                        </select>
<?php }else{ ?>

<!--<span style="text-align:center;"> No Attribute Found </span>-->

<select name="allattrb_name" id="allattrb_name" class="seller_input" style="width:280px;" >
                                        	<option value="">---No Attributes---</option>
                                        	                             
                                        </select>

<?php } ?> 