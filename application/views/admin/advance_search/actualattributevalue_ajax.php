<div style="height:300px; width:300px; overflow:auto;  ">

<?php if($attrbval_query->num_rows()>0)
					{ 
						foreach($attrbval_query->result_array() as $res_attrbval)
						{ 
							if($attrb_headname=='Color' || $attrb_headname=='COLOR' || $attrb_headname=='color'){
						?>
                        
                        <input type="checkbox" id="attbactval<?=$res_attrbval['id'];?>" class='attbactval' name="attbactval[]" value="<?=$res_attrbval['attr_value'];?>" onclick="checked_attrbactualvaluecheckbox('<?=$res_attrbval['id'];?>','<?=$attrfieldtd_id?>')" /> 	
                        <span style="display:none;"> 
                        <input type="checkbox" id="attbactval_hdn<?=$res_attrbval['id'];?>" class='attbactval'
                         name="attbactval_hdn[]" value="<?=$res_attrbval['id'];?>" /> 
                         
                         <input type="checkbox" id="attbheadingname_hdn<?=$res_attrbval['id'];?>" class='attbactval'
                         name="attbheadingname_hdn[]" value="<?=$attrb_headname.'_'.$res_attrbval['attr_value'];?>" /> 
                         
                         <input type="checkbox" id="attbidwithheadingname_hdn<?=$res_attrbval['id'];?>" class='attbactval'
                         name="attbidwithheadingname_hdn[]" value="<?=$attrb_headname.'_'.$res_attrbval['id'];?>" /> 	
                        </span>
                        
						<span style="background-color:<?=$res_attrbval['attr_value'];?>;width:300px; "><?=$res_attrbval['attr_value'];?></span>
						 <br />
                         <hr style="background-color:#666;" />
                        <?php }else{ ?>
                       <input type="checkbox" id="attbactval<?=$res_attrbval['id'];?>" name="attbactval[]" value="<?=$res_attrbval['attr_value'];?>" 
                       onclick="checked_attrbactualvaluecheckbox('<?=$res_attrbval['id'];?>','<?=$attrfieldtd_id?>')" />
                       
                        <span style="display:none;"> 
                        <input type="checkbox" id="attbactval_hdn<?=$res_attrbval['id'];?>" class='attbactval'
                         name="attbactval_hdn[]" value="<?=$res_attrbval['id'];?>" /> 
                         
                         
                         <input type="checkbox" id="attbheadingname_hdn<?=$res_attrbval['id'];?>" class='attbactval'
                         name="attbheadingname_hdn[]" value="<?=$attrb_headname.'_'.$res_attrbval['attr_value'];?>" /> 
                         
                          <input type="checkbox" id="attbidwithheadingname_hdn<?=$res_attrbval['id'];?>" class='attbactval'
                         name="attbidwithheadingname_hdn[]" value="<?=$attrb_headname.'_'.$res_attrbval['id'];?>" /> 		
                        </span>
                        	
						<span><?=$res_attrbval['attr_value'];?></span>
                        <br />
                         <hr style="background-color:#666;" />
                       <?php } ?> 	
							
	<?php				}
					}else
					{
							?>
                            
<span>No List Found</span>

<?php } ?>
</div>