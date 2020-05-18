<span style="float:right;">   
                 <a id="product_submit" class='seller_buttons' onclick="valid_attrb()" style="cursor:pointer;" >
           				<i class="fa fa-floppy-o" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Save 
           		</a>
            </span> 
            <div id="show_errorattrb" align="center" style="color:#F00; display:none;" > </div> 
            
<div align="left">
<span style="text-align:left;">Select Attribute For Product Filter </span>
<fieldset>
    <legend>Filter By </legend>
    
    <span style="text-align:left;"><input type="checkbox" name="price" id="price" value='1' > Price</span><br>
    <span style="text-align:left;"><input type="checkbox" name="discount" id="discount" value='1' > Discount</span><br>
    <span style="text-align:left;"><input type="checkbox" name="seller" id="seller" value='1' > Seller</span><br>
    </fieldset>

<?php
 
if($attrb_subset->num_rows()>0)
{
	foreach($attrb_subset->result_array() as $res_subattrb)
	{
 ?>
 <fieldset>
    <legend><?php echo  $res_subattrb['attribute_heading_name'] ?></legend>
    
   <?php 
   $attrb_headingid=$res_subattrb['attribute_heading_id'];
   $realattrbquery=$this->db->query("SELECT * FROM attribute_real WHERE attribute_heading_id=' $attrb_headingid' ") ;
   if($realattrbquery->num_rows()>0)
   { 
   		foreach($realattrbquery->result_array() as $res_subattrb){
   ?>
   	    
    <span style="text-align:left;"><input type="checkbox" name="attrbfield_idchk[]" id="attrbfield_idchk" value="<?=$res_subattrb['attribute_id']?>"> <?=$res_subattrb['attribute_field_name'] ?></span><br>
    
   <?php 
   			
		} // inner for loop condition end
   } // sub attribute heading condtion end  
   		  else
		  {echo "No List Found";}	
   
   ?>
  </fieldset>
<?php 
	}
}
else
{ ?>
<span style="text-align:center; color:#F00;">No Data Found! </span>

 <?php } ?>

</div>