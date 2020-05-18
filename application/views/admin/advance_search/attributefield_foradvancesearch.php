<!--<span style="float:right;">   
                 <a id="product_submit" class='seller_buttons' onclick="valid_attrb()" style="cursor:pointer;" >
           				<i class="fa fa-floppy-o" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Save 
           		</a>
            </span> -->
            <div id="show_errorattrb" align="center" style="color:#F00; display:none;" > </div> 
            
<div align="left" >
<span style="text-align:left;">Select Attribute For Add To List </span>
<!--<fieldset>
    <legend>Filter By </legend>
    
    <span style="text-align:left;"><input type="checkbox" name="price" id="price" value='1' > Price</span><br>
    <span style="text-align:left;"><input type="checkbox" name="discount" id="discount" value='1' > Discount</span><br>
    <span style="text-align:left;"><input type="checkbox" name="seller" id="seller" value='1' > Seller</span><br>
    </fieldset>-->

<?php
 
if($attrb_subset->num_rows()>0)
{$td_id=1;
$accrod_id=1;
	foreach($attrb_subset->result_array() as $res_subattrb)
	{
 ?>
 <fieldset >
    <legend><?php echo  $res_subattrb['attribute_heading_name'] ?></legend>
    <table>
    <tr>
   <?php 
   $attrb_headingid=$res_subattrb['attribute_heading_id'];
   $realattrbquery=$this->db->query("SELECT * FROM attribute_real WHERE attribute_heading_id=' $attrb_headingid' ") ;
   if($realattrbquery->num_rows()>0)
   { 
   		foreach($realattrbquery->result_array() as $res_subattrb){
   ?>
   	    
    <td style="text-align:left;">
    <?php /*?><input type="radio" name="attrbfield_idchk[]" id="attrbfield_idchk" value="<?=$res_subattrb['attribute_id']?>" > <?=$res_subattrb['attribute_field_name'] ?><?php */?>
    
    
    
    
<div class="bs-example form_content">
	<div class="panel-group" id="accordion<?=$accrod_id?>">

			<!--<div class="panel panel-default">-->
            <div class="panel">
								<div class="product_attr_heading">
                                	<span style="display:none;"><input type="checkbox" id="attrbfld_chkbox<?=$td_id?>" name="attrbfld_chkbox[]" value="<?=$res_subattrb['attribute_field_name'] ?>"/>
                                    <input type="checkbox" id="attrbfldselected_chkbox<?=$td_id?>" name="attrbfldselected_chkbox[]" value="<?=$res_subattrb['attribute_field_name'] ?>"/>
                                    </span>
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$td_id?>" 
                                    onclick="attrubute_valuepopulate('<?=$res_subattrb['attribute_id']?>','<?=$td_id?>','<?=$res_subattrb['attribute_field_name'] ?>')">
                                     
										<div class="panel-heading">
											<h4 class="panel-title"><?=$res_subattrb['attribute_field_name'] ?></h4>
										</div>
									</a>
								</div>
								<div id="collapse<?=$td_id?>" class="panel-collapse collapse">
									<div class="panel-body">
										<div>
											<div class="product_image">
												<div class="" id="attribute_valuedivid<?=$td_id?>"  >
                                                
												 <div id="process_div_attarbactualvalue<?=$td_id?>" style="display:none; color:#090;"> 
                                                 <img src="<?php echo base_url().'images/progress.gif' ?>" style="width:50px; height:50px;" />Loading... 
                                                 </div>	
													
													
													
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							
							</div>
							</div>
    
    
    </td>
   
   <?php 
   		$td_id++;	
		} // inner for loop condition end
    // sub attribute heading condtion end 
   ?>
   </tr>
   
   <?php } 
   		  else {?>
		  
   <tr><td colspan="<?=$td_id?>">No List Found</td></tr>
 <?php }  ?>
   
   </table>
  </fieldset>
<?php 
	$accrod_id++;}
}
else
{ ?>
<span style="text-align:center; color:#F00;">No Data Found! </span>

 <?php } ?>

</div>