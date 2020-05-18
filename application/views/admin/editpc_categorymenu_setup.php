<?php
require_once('header.php');
?>

 <script type="text/javascript" src="<?php echo base_url().'js/jquery.collapsibleCheckboxTree.js' ?>"></script>
       
        
        <script type="text/javascript">
jQuery(document).ready(function(){
		$('ul#example').collapsibleCheckboxTree();
});

</script>
<script src="<?php echo base_url();?>js/chosen.jquery.js"></script>
<script>
  $(function() {
	$('.chosen-select').chosen();
	$('.chosen-select-deselect').chosen({ allow_single_deselect: true });
  });
</script>

<script>
	
	function valid_menu()
	{
		if($('#menu_name').val()=='')
		{
			document.getElementById('show_error').innerHTML="Enter Menu Name";
			$('#menu_name').css('border','1px solid red');
			document.getElementById('menu_name').focus();
			return false;
	
		}
		
		if($('#urldisp_name').val()=='')
		{
			document.getElementById('show_error').innerHTML="Enter URL Display Name";
			$('#urldisp_name').css('border','1px solid red');
			document.getElementById('urldisp_name').focus();
			return false;
	
		}
		
		if($('#menu_isactive').val()=='')
		{
			document.getElementById('show_error').innerHTML="Select Active Status";
			$('#menu_isactive').css('border','1px solid red');
			document.getElementById('menu_isactive').focus();
			return false;
	
		}
		if($('#menu_have_Parent').val()=='')
		{
			document.getElementById('show_error').innerHTML="Select Have A Parent Menu";
			$('#menu_have_Parent').css('border','1px solid red');
			document.getElementById('menu_have_Parent').focus();
			return false;
	
		}
		if($('#menu_have_Parent').val()=='Yes' && $('[name="subcategory_id"]').is(':checked')==false )
		{
			document.getElementById('show_error').innerHTML="Select Parent From Left Side Menu Directory";			
			return false;
	
		}
		
		if($('#view_type').val()=='' )
		{
			document.getElementById('show_error').innerHTML="Select View Type";
			$('#view_type').css('border','1px solid red');
			document.getElementById('view_type').focus();
			return false;
	
		}
		//if($('.chosen-container').val()=='' )
//		{
//			document.getElementById('show_error').innerHTML="Select Category Name";
//			$('.chosen-container').css('border','1px solid red');
//	//		document.getElementById('catg_name_chosen').focus();
//			return false;
//	
//		}
			
	}
	
	function disable_menulistradiobutton()
	{
		if($('#menu_have_Parent').val()=='No' )
		{			
			$('input[name="subcategory_id"]').attr('disabled', 'disabled');			
			
	
		}else
		{
			$('input[name="subcategory_id"]').attr('disabled', false);	
		}
		
	}
	
	function valid_menulabelidedit()
	{
		//if($('[name="subcategory_id"]').is(':checked')==false)
//		{
//			$('#show_menuselecterror').css('display','block');
//			document.getElementById('show_menuselecterror').innerHTML="Please Select One Menu For Edit";
//		}
//		else
//		{  
		var menu_lable_id=$('input[name=subcategory_id]:radio:checked').val();			
		
			window.location.href="<?php echo base_url().'admin/Super_admin/edit_pcmenu/' ?>"+menu_lable_id;	
		//}
			
	}
	function valid_menulabeliddelete()
	{
			var conf=confirm("Do You want to Delete Menu and its child menu ?");
			if(conf)
			{
				var menu_lable_id=$('input[name=subcategory_id]:radio:checked').val();			
			
				window.location.href="<?php echo base_url().'admin/Super_admin/delete_pcmenu/' ?>"+menu_lable_id;	
			}
	}
	
	
	function enable_edit_deletebtn()
	{
		if($('[name="subcategory_id"]').is(':checked')==true)
		{
			$("#edit_mnb").attr('disabled',false);
			$("#delete_mnb").attr('disabled',false);
			
		}
		
	}

</script>
<script>
function remove_ctag(dskmenu_lbl_id,catg_id)
{
	
	$('#loader_div').css('display','block');
				$.ajax({
					method:"POST",
					url:"<?php echo base_url().'admin/super_admin/remove_pccategorylink' ?>",
					data:{dskmenu_lbl_id:dskmenu_lbl_id,catg_id:catg_id},
					success: function() {
						//$("#ss").html(data);
						//if(data == 'success'){
							//$('#loader_div').css('display','none');
							window.location.reload(true);
						//}
					}
				});
}

</script>


<div id="content">  
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_config.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
				</div>  <!-- @end top-bar  -->
                
    <div class="main-content">
		
		
		<?php if(@$data==true){ ?><div align="center" style="color:#0C6"> <?php  echo $data ?> </div> <?php } ?>
       
          <form id="save_catgory_form" method="post" action="<?php echo base_url().'admin/Super_admin/update_pcmenusetup' ?>">
			<div class="row content-header">
		   <div class="col-md-8"> <b>Edit Menu OF: <?=$pcmenu_edit->label_name ?> </b></div>
				                          
           <div class="col-md-4 show_report">
               
               <?php /*?> <input  type="button" class="all_buttons" value="Add Subcategory" onClick="window.location.href='<?php echo base_url().'admin/catalog/add_subcategory' ?>' " /><?php */?>
                
				<input  type="submit" class="all_buttons" value="Save" onClick="return valid_menu()"/>
				<input type="button" class="all_buttons" value="Reset" onClick="window.location.href='<?php echo base_url().'admin/super_admin/pcmenu_setup'; ?>' " />
				
           </div>
			</div>
            
           <div class="clearfix"></div>
           
           <div class="left-sidebar"> <div id="show_menuselecterror" align="center" style="color:#F00; display:none;" > </div> 
             <!--<input type="button" value="Add Main Menu" class="btns" onClick="window.location.href='<?php //echo base_url(); ?>admin/super_admin/pcmenu_setup'" />
             <input type="button" value="Add Submenu" class="btns" onClick="select_subcategory_valid()"  />-->
   <?php $first_lvlparent_id=0;
   		 $second_lvlparentid=0;	
    ?>           
  <ul id="example">
  <?php foreach($data2->result() as $rows){ ?> <!--level-1 --> 
    <li id="category_li">
      <input id="subcategory_id"  type="radio" name="subcategory_id"   value="<?php echo $rows->dskmenu_lbl_id; ?> " <?php if($pcmenu_edit->parent_id==$rows->dskmenu_lbl_id){echo "checked"; $first_lvlparent_id=$rows->dskmenu_lbl_id;} ?>  onChange="enable_edit_deletebtn()"  />
      <?php echo $rows->label_name; ?>
      <ul >
      <?php $qr=$this->db->query("select * from category_menu_desktop where parent_id='$rows->dskmenu_lbl_id' order by order_by "); 
	  	//$rw=$qr->result();
	  	$ct=$qr->num_rows();
		
	  	if($ct>0){ ?>
        
        <?php 
			foreach($qr->result() as $rs){ ?> <!--level-2 -->
       <li>		
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs->dskmenu_lbl_id; ?>" <?php if($pcmenu_edit->parent_id==$rs->dskmenu_lbl_id){echo "checked";$second_lvlparentid=$rs->dskmenu_lbl_id;} ?>  onChange="enable_edit_deletebtn()" />
				
		 <?php echo	$rs->label_name;?>
         
         <ul>
         <!--level-3-->
          <?php $qr1=$this->db->query("select * from category_menu_desktop where parent_id='$rs->dskmenu_lbl_id' order by order_by"); 
	  	//$rw=$qr->result();
	  	$ct1=$qr1->num_rows();
		
	  	if($ct1>0){ ?>
        
        <?php 
			foreach($qr1->result() as $rs1){ ?>
       <li>		
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs1->dskmenu_lbl_id; ?>"  <?php if($pcmenu_edit->parent_id==$rs1->dskmenu_lbl_id){echo "checked";} ?> onChange="enable_edit_deletebtn()"/>
				
		 <?php echo	$rs1->label_name;?>
         
         
         <ul>
         <!--level-4-->
          <?php $qr2=$this->db->query("select * from category_menu_desktop where parent_id='$rs1->dskmenu_lbl_id' order by order_by"); 
	  	//$rw=$qr->result();
	  	$ct2=$qr2->num_rows();
		
	  	if($ct2>0){ ?>
        
        <?php 
			foreach($qr2->result() as $rs2){ ?>
       <li>		
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs2->dskmenu_lbl_id; ?>" <?php if($pcmenu_edit->parent_id==$rs2->dskmenu_lbl_id){echo "checked";} ?> onChange="enable_edit_deletebtn()" />
				
		 <?php echo	$rs2->label_name;?>
         
         
         <ul>
         <!--level-5-->
          <?php $qr3=$this->db->query("select * from category_menu_desktop where parent_id='$rs2->dskmenu_lbl_id' order by order_by"); 
	  	//$rw=$qr->result();
	  	$ct3=$qr3->num_rows();
		
	  	if($ct3>0){ ?>
        
        <?php 
			foreach($qr3->result() as $rs3){ ?>
       <li>		
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs3->dskmenu_lbl_id; ?>"   <?php if($pcmenu_edit->parent_id==$rs3->dskmenu_lbl_id){echo "checked";} ?> onChange="enable_edit_deletebtn()"  />
				
		 <?php echo	$rs3->label_name;?>
         
                 
         <ul>
         <!--level-6-->
          <?php $qr4=$this->db->query("select * from category_menu_desktop where parent_id='$rs3->dskmenu_lbl_id' order by order_by"); 
	  	//$rw=$qr->result();
	  	$ct4=$qr4->num_rows();
		
	  	if($ct4>0){ ?>
        
        <?php 
			foreach($qr4->result() as $rs4){ ?>
       <li>		
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs4->dskmenu_lbl_id; ?>"  <?php if($pcmenu_edit->parent_id==$rs4->dskmenu_lbl_id){echo "checked";} ?> onChange="enable_edit_deletebtn()" />
				
		 <?php echo	$rs4->label_name;?>
         
                 
          <ul>
         <!--level-7-->
          <?php $qr5=$this->db->query("select * from category_menu_desktop where parent_id='$rs4->dskmenu_lbl_id' order by order_by"); 
	  	//$rw=$qr->result();
	  	$ct5=$qr5->num_rows();
		
	  	if($ct5>0){ ?>
        
        <?php 
			foreach($qr5->result() as $rs5){ ?>
       <li>		
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs5->dskmenu_lbl_id; ?>" <?php if($pcmenu_edit->parent_id==$rs5->dskmenu_lbl_id){echo "checked";} ?> onChange="enable_edit_deletebtn()" />
				
		 <?php echo	$rs5->label_name;?>
         
         
         <ul>
         <!--level-8-->
          <?php $qr6=$this->db->query("select * from category_menu_desktop where parent_id='$rs5->dskmenu_lbl_id' order by order_by"); 
	  	//$rw=$qr->result();
	  	$ct6=$qr6->num_rows();
		
	  	if($ct6>0){ ?>
        
        <?php 
			foreach($qr6->result() as $rs6){ ?>
       <li>		
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs6->dskmenu_lbl_id; ?>"  <?php if($pcmenu_edit->parent_id==$rs6->dskmenu_lbl_id){echo "checked";} ?>  onChange="enable_edit_deletebtn()"   />
				
		 <?php echo	$rs6->label_name;?>
         
         
          <ul>
         <!--level-9-->
          <?php $qr7=$this->db->query("select * from category_menu_desktop where parent_id='$rs6->dskmenu_lbl_id' order by order_by"); 
	  	//$rw=$qr->result();
	  	$ct7=$qr7->num_rows();
		
	  	if($ct7>0){ ?>
        
        <?php 
			foreach($qr7->result() as $rs7){ ?>
       <li>		
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs7->dskmenu_lbl_id; ?>"   <?php if($pcmenu_edit->parent_id==$rs7->dskmenu_lbl_id){echo "checked";} ?>  onChange="enable_edit_deletebtn()"  />
				
		 <?php echo	$rs7->label_name;?>
         
            <ul>
         <!--level-10-->
          <?php $qr8=$this->db->query("select * from category_menu_desktop where parent_id='$rs7->dskmenu_lbl_id' order by order_by"); 
	  	//$rw=$qr->result();
	  	$ct8=$qr8->num_rows();
		
	  	if($ct8>0){ ?>
        
        <?php 
			foreach($qr8->result() as $rs8){ ?>
       <li>		
			<input type="radio" id="subcategory_id" name="subcategory_id" value="<?php echo $rs8->dskmenu_lbl_id; ?>" <?php if($pcmenu_edit->parent_id==$rs8->dskmenu_lbl_id){echo "checked";} ?> onChange="enable_edit_deletebtn()"  />
				
		 <?php echo	$rs8->label_name;?>
         
                      
        </li> <?php } ?>  <?php } ?> </ul>              
                      
        </li> <?php } ?>  <?php } ?> </ul>
         
                      
        </li> <?php } ?>  <?php } ?> </ul>       
                      
        </li> <?php } ?>  <?php } ?> </ul>
         
                             
        </li> <?php } ?>  <?php } ?> </ul>
         
         
         
             
        </li> <?php } ?>  <?php } ?> </ul>
         
         
         
             
        </li> <?php } ?>  <?php } ?> </ul>
        
        
                 
        </li> <?php } ?>  <?php } ?> </ul>
              
         
        </li> <?php } ?>  <?php } ?> </ul>
     </li>
        <?php } ?>
  </ul>
           </div>  <!-- @end left-sidebar -->
           
           <!-- @start #right-content -->
           
           <div class="right-cont">
           <div id="show_error" align="center" style="color:#F00;"> </div>
           <div class="form_view">
						<h3>Desktop Menu Information
                        <input type="button" value="Edit Menu" class="btns" name="edit_mnb" id="edit_mnb" disabled onClick="valid_menulabelidedit()" />
                         <input type="button" value="Delete Menu" class="btns" name="delete_mnb" id="delete_mnb" disabled onClick="valid_menulabeliddelete()" /></h3>
							<table>
								<tr>
									<td style="width:20%;"> Menu Name <sup>*</sup> </td>
									<td>
                                    <input type='hidden' name='lbl_id' id='lbl_id' value='<?php echo $pcmenu_edit->dskmenu_lbl_id ?>' >
                                    <input type="text" class="text2" name="menu_name" id="menu_name" value="<?php echo $pcmenu_edit->label_name ?>"></td>
								</tr>
                                
                                <tr>
									<td style="width:20%;"> Display URL <sup>*</sup> 
                                    
                                    </td>
									<td><input type="text" class="text2" name="urldisp_name" id="urldisp_name" value="<?php echo $pcmenu_edit->url_displayname ?>">&nbsp;<span style="color:#F00;"><i class="fa fa-info-circle" aria-hidden="true"></i>
(Special Characters not allowed Except hyphen -)</span></td>
								</tr>
                                
                                <tr>
									<td>Menu Active Status <sup>*</sup> </td>
									<td>
                                    	<select name="menu_isactive" id="menu_isactive" class="text2">
                                        	<option value=''>---select---</option>
                                        	<option value="Yes" <?php if($pcmenu_edit->is_active=='Yes'){echo "selected";}?> >Yes</option>
                                            <option value="No" <?php if($pcmenu_edit->is_active=='No'){echo "selected";}?>>No</option>
                                        </select>
                                    </td>
								</tr>
								<tr>
									<td>Have A Parent Menu <sup>*</sup> </td>
									<td>
                                    	<select disabled name="menu_have_Parent" id="menu_have_Parent" class="text2" onChange="disable_menulistradiobutton()">
                                        	<option value=''>---select---</option>
                                        	<option value="Yes" <?php if($pcmenu_edit->parent_id!=0){echo "selected";}?>>Yes</option>
                                            <option value="No" <?php if($pcmenu_edit->parent_id==0){echo "selected";}?>>No</option>
                                        </select>
                                    </td>
								</tr>
                                <tr>
									<td>Order By <sup>*</sup> </td>
									<td>
                                    
                                    <?php 
										$ctr_orderby=count($pcmenu_orderby);
										
									 ?>
                                     <input type="hidden" name="parent_idmnb" id="parent_idmnb" value="<?php echo $pcmenu_edit->parent_id ?>" >                                   
                                    	<select name="slect_orderby" id="slect_orderby" class="text2" >
                                        	<option value=''>---select---</option>
                                        	<?php
												foreach($pcmenu_orderby as $res_order_by)
												{	
										     ?>
                                             <option <?php if($pcmenu_edit->order_by==$res_order_by->order_by) { echo "selected"; } ?>><?=$res_order_by->order_by?></option>
                                             <?php }?>
                                        </select>
                                    </td>
								</tr>
                                 <tr>
									<td>View Type <sup>*</sup> </td>
									<td>
                                    	<select name="view_type" id="view_type" class="text2">
                                        	<option value=''>---select---</option>                                        	
                                            <option value="catalog" <?php if($pcmenu_edit->view_type=='catalog'){echo "selected";}?>>Catalog</option>
                                            <option value="category" <?php if($pcmenu_edit->view_type=='category'){echo "selected";}?>>Category</option>
                                            <!--<option value="Custom">Custom</option>-->
                                        </select>
                                    </td>
								</tr>
                                
								<!--<tr>
									<td>URL </td>
									<td><textarea name="cust_url" class="cust_url" id="mdesc"></textarea></td>
								</tr>-->
                                
                                
                                <tr>
									<td style="width:20%;"> Category Link <sup>*</sup> </td>
									<td> 
                                    	<?php //$catg_arr=explode(',',$pcmenu_edit->category_id); ?>
                                        
                                    <select name="catg_name[]" id="catg_name" data-placeholder="Choose Category" class="chosen-select" multiple tabindex="4">
                                            <?php foreach($category_result as $catg_row){ ?>
                                            
                                            <option value="<?=$catg_row->lvl2;?>" > 
											<?=$catg_row->lvlmain_name." >> ".$catg_row->lvl1_name." >> ".$catg_row->lvl2_name;?>
                                            
                                            </option>
                                         
                                            <?php }?>
                                        </select></td>
								</tr>
                                
                                 <tr>
									<td style="width:20%;"> SEO Data Link With Category <sup>*</sup> </td>
									<td> <select name="seocatg_name" id="seocatg_name" data-placeholder="Choose Category" class="chosen-select"  tabindex="4">
                                            <option value="0">No Link</option>
											<?php 
											$pc_catglinkarr=explode(',',$pcmenu_edit->category_id);
											foreach($category_result as $catg_row){ ?>
                                             <?php if(in_array($catg_row->lvl2,$pc_catglinkarr)){ ?>
                                            <option value="<?=$catg_row->lvl2;?>" <?php if($pcmenu_edit->seo_categoryidlink==$catg_row->lvl2){ echo "selected";} ?>>
											<?=$catg_row->lvlmain_name." >> ".$catg_row->lvl1_name." >> <span style='background-color:#0C3;'>".$catg_row->lvl2_name."</span>";?> 
                                            </option>
                                         
                                            <?php }}?>
                                        </select></td>
								</tr>
                               <!-----------------------------------List of Category LInk Start----------------------------------------->                                
                                <tr>
                                 <div id="loader_div" style="display:none;  text-align:center;"> <img src="<?php echo base_url().'images/loading1.gif' ?>" /> 
                                                </div>
                                	<table class="table table-bordered">
					<tr bgcolor="#99CCFF">
						<th width="10%">Sl No</th>
						<th width="30%">Category Link Name</th>						
						<th width="10%">Action</th>
					</tr>
					
				<?php 
				
				if($pcmenu_edit->category_id!=''){ 
				$sl_no=1;			
				
			$qr=$this->db->query("SELECT DISTINCT lvl2, lvl2_name, lvl1, lvl1_name , lvlmain_name FROM  `temp_category`	WHERE lvl1 !=0 AND lvl2 IN ($pcmenu_edit->category_id) ");
			$result_catg= $qr->result();	
	
                if($result_catg) {
                    foreach($result_catg as $rows):
                ?>
                                    <tr>
                                        <td><?=$sl_no?></td>
                                        <td>
                                        
                                        <?=$rows->lvlmain_name." >> ".$rows->lvl1_name." >> ".$rows->lvl2_name;?>
                                        </td>                                  
                                        <td>
                                        <i class="fa fa-times" onClick="remove_ctag('<?php echo $pcmenu_edit->dskmenu_lbl_id?>','<?php echo $rows->lvl2?>')" title="Remove Category Link" style="cursor:pointer; color:#F00;"></i></td>
                                    </tr>
                <?php $sl_no++;
                    endforeach;
                }
				}
				else{
                ?>
                                    <tr>
                                        <td class="a-center" colspan="4">No Category Link Found!</td>
                                    </tr>
                <?php } ?>
                                </table>
                                
                                </tr>
							<!-----------------------------------------List Of Category Link End------------------------------------------>	
							</table>
					</div>
           
           
          </div>
				</form>
			</div>
            </div>
            <div class="clearfix"> </div>
            <!-- @end #right-content -->
            
            
	
    
                

</div><!--div content end-->                
<?php
require_once('footer.php');
?>	                