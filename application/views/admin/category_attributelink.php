<?php
require_once('header.php');
?>

<link rel="stylesheet" href="<?php echo base_url(); ?>colorbox/colorbox.css" />



<script src="<?php echo base_url(); ?>colorbox/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>colorbox/jquery.colorbox.js"></script>
  <script>
      $(document).ready(function(){
          $(".inline").colorbox({inline:true, width:"50%",height:"50%"});
      });
  </script>
 <script src="<?php echo base_url();?>js/chosen.jquery.js"></script>
<script>
  $(function() {
	$('.chosen-select').chosen();
	$('.chosen-select-deselect').chosen({ allow_single_deselect: true });
  });
</script>

<!--<script>
function remove_onectag(attri_id,attri_nm,attri_link)
{
	
	$('#loader_div').css('display','block');
		$.ajax({
					method:"POST",
					url:"<?php// echo base_url().'admin/super_admin/remove_oneattrilink' ?>",
					data:{attri_id:attri_id,attri_nm:attri_nm,attri_link:attri_link},
					success: function() {
						
							window.location.reload(true);
						
					}
				});
}

</script>-->
<script>
function remove_ctag(attri_id,attri_nm)
{ var cof=confirm('Do You Want Delete All Attribute Category Link');
   if(cof)
	{
	$('#loader_div').css('display','block');
				$.ajax({
					method:"POST",
					url:"<?php echo base_url().'admin/super_admin/remove_attrilink' ?>",
					data:{attri_id:attri_id,attri_nm:attri_nm},
					success: function() {
						
							window.location.reload(true);
						
					}
				});
	}
				
				
}
			function delete_cateory(cate_id,attri_id,attri_nm)
			{
				var conf=confirm("Do You want to Delete ?");
				
				
				if(conf){
					$('#loader_div').css('display','block');
							$.ajax({
						method:"POST",
						url:"<?php echo base_url().'admin/super_admin/remove_oneattrilink' ?>",
						data:{cate_id:cate_id,attri_id:attri_id,attri_nm:attri_nm},
						success: function() {
							
								window.location.reload(true);
							
						}
						});
				}
			}

				

</script>

<!--<script>
function remove_ctag(attri_id,attri_nm,attri_link)
{
	
	$('#loader_div').css('display','block');
				$.ajax({
					method:"POST",
					url:"<?php// echo base_url().'admin/super_admin/remove_pccategorylink' ?>",
					data:{dskmenu_lbl_id:attri_id,catg_id:attri_nm,dskmenu_lbl_id:attri_link},
					success: function() {
						//$("#ss").html(data);
						//if(data == 'success'){
							//$('#loader_div').css('display','none');
							window.location.reload(true);
						//}
					}
				});
}

</script>-->
<!-- Lightbox link end here-->

			<div id="content">   
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_config.php';?>
					</div>
                    <div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
						
				</div>  <!-- @end top-bar  -->
						
				
			 <!-- @end top-bar  -->
             
				<div class="main-content">
					<h3>Category Attribute Link</h3>
					<div class="row gray_bg">
						
						<div class="col-md-12 mt20">
							
						<?php if($this->session->flashdata('msgcod_wtchrg')){ ?>	<div id="successfully_verify" style="color:#0C0;">
						<img src="<?php echo base_url().'images/success_icon.png' ?>">&nbsp<?php echo $this->session->flashdata('msgcod_wtchrg'); ?></div> <?php } ?>
                            
							<div class="tab-content">
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											<div class="right mb10">
                                            <!--<span id="product_submit" class='seller_buttons' onClick="attributelink()" style="cursor:pointer;"><i class="fa fa-plus-square" aria-hidden="true" style="color:#FFF;"></i>Add Category Attribute Link</span>-->
												 <!--<a id="product_submit" class='seller_buttons inline' href='#inline_content_addweighcharges'  > 
           <i class="fa fa-plus-square" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Add Category Attribute Link 
           </a>-->
											</div>
                                             
                                            
                                            <div style="display:block" id="add_attrilink">
      
         	<h4 class="title sn">Add Category Attribute Link </h4>

<form action="<?php echo base_url().'admin/super_admin/add_attrilink' ?>" method="POST">
		<table >
        <tr>
                <td>Attribute Group Name: </td>
                <td>
                <?php $query=$this->db->query("SELECT * FROM  attribute_group ORDER BY attribute_group_id ASC");
											$attrgrnm=$query->result_array();
											?>
                                            <select name="catg_name" id="catg_name" data-placeholder="Choose Category" class="text2" required>
                                            <option value-"">---select---</option>
                                            <?php if($query->num_rows()>0){
											foreach($attrgrnm as $attrgrnm){ ?>
                                            <option value="<?=$attrgrnm['attribute_group_id']?>"><?=$attrgrnm['attribute_group_name']?></option>
                                            
                                         	<?php } } ?>	
                                            
                                        </select></td>
                                        
                
                
            </tr>
            <?php /*?><tr><?php if($query->num_rows()>0){
				foreach($attrgrnm as $attrgrnms){ ?>
                <input type="hidden" name="attri_groupid" value="<?=$attrgrnms->attribute_group_id;?>"/>
                <?php } } ?></tr><?php */?>
        <tr>
            
            <td>Category Attribute Link:</td>
            <td>
                 <?php  
				 /*$query_attrb=$this->db->query("SELECT * FROM  attribute_group WHERE cate_attributelink!='' ORDER BY attribute_group_id ASC");
				 $attrb_allslz=array();
				 foreach($query_attrb->result() as $res_catginfo)
				 {
					 $attrb_slz=unserialize($res_catginfo->cate_attributelink);
					 foreach($attrb_slz as $key=>$val)
					 {	 
					 $attrb_allslz[]=$val;				
					 }
			 	 }
					// array_merge($attrb_allslz, $attrb_slz);
				$attrb_string=implode(',',$attrb_allslz);
				
				if($attrb_string!=''){	
				 $qr=$this->db->query("SELECT DISTINCT lvl2, lvl2_name, lvl1, lvl1_name , lvlmain_name
										FROM  `temp_category` 
										WHERE lvl1 !=0 AND lvl2  NOT IN ($attrb_string)");
										$rw=$qr->result();
				}
				else{*/
				$qr=$this->db->query("SELECT DISTINCT lvl2, lvl2_name, lvl1, lvl1_name , lvlmain_name
									  FROM  `temp_category` 
									  WHERE lvl1 !=0 ");
									  $rw=$qr->result();
				//}
											?>
                <select name="attrilinkgroup[]"  data-placeholder="Choose Category" class="chosen-select" id="attrilink" multiple tabindex="4" required>
                								
                                            <?php if($qr->num_rows()>0)
											foreach($rw as $rw){ ?>
                                            <option value="<?=$rw->lvl2;?>"><?=$rw->lvlmain_name." >> ".$rw->lvl1_name." >> ".$rw->lvl2_name;?></option>
                                         <?php } ?>
                                         
                                        </select></td>
                                        </tr>
          
            <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input  type="submit" class="all_buttons" id="new_courier_btn" value="Save" >
                    <input  type="reset" class="all_buttons" id="new_courier_btn" value="Reset" >
                </td>
            </tr>
      </table>
</form>

</div>  
                                            <div class="pagination">
												<?php /*?><p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p><?php */?>
											</div>
                                            
                                        
                        </div>
                        
                        <div class="clearfix"></div>
                        
                        
             
					  <div>
                      <div id="loader_div" style="display:none; text-align:center;"> <img src="<?php echo base_url().'images/loading1.gif' ?>" /> 
                                                </div>
						<table class="table table-bordered table-hover">
                      
                           
							<tr class="table_th">
								
								<th width="5%">Sl No.</th>
								<th width="10%">Attribute Group Name</th>
                                <th width="18%">Category Attribute Link</th>
								<th width="10%">Action</th>
								
							</tr>
                            <?php
							if($attrlink->num_rows()>0)
							{ $sl=1;
							 foreach($attrlink->result_array() as $cate_attribute) {
								 $category=$cate_attribute['cate_attributelink'];
								 $arr_categlink=unserialize($category);
								 
								  ?>
								
                            <tr>  
                            <td><?=$sl?></td>
                            <td><?= $cate_attribute['attribute_group_name']?></td>
                            <td>
							<?php
							foreach($arr_categlink as $role => $actor) {
								$cate_attrid=$actor;
							$query=$this->db->query("SELECT * FROM  temp_category WHERE lvl2='$cate_attrid'");
											$attrcate=$query->row();
											echo $attrcate->lvlmain_name." >> ".$attrcate->lvl1_name." >> ".$attrcate->lvl2_name;
											?>
											
									<i class="fa fa-times" 
                                    onClick="delete_cateory('<?=$cate_attrid?>','<?=$cate_attribute['attribute_group_id']?>','<?=$cate_attribute['attribute_group_name']?>')" title="Remove Category Link" style="cursor:pointer; color:#F00;"></i>
							<br><hr>
						<?php	}?> 
							
							 
							 </td> 
                            <td><!--
                            <i class="fa fa-times" onClick="remove_ctag('<?//=$cate_attribute['attribute_group_id']?>','<?//= $cate_attribute['attribute_group_name']?>','<?//= $cate_attribute['cate_attributelink']?>')" title="Remove Category Link" style="cursor:pointer; color:#F00;"></i>	<a href="<?php// echo base_url().'admin/super_admin/add_attrilink/'.$cate_attribute['attribute_group_id'] ?>" title="Edit"> <i class="fa fa-pencil-square-o" style="font-size:24px;"></i> </a>
                            <a class='inline' href="#inline_content_edit_cour_fld" onClick="edit_wtchrgs('<?//=$cate_attribute['attribute_group_id']?>','<?//= $cate_attribute['attribute_group_name']?>','<?//= $cate_attribute['cate_attributelink']?>')" title="Edit"><i class="fa fa-pencil-square-o" style="font-size:16px;"></i></a>-->&nbsp;&nbsp;&nbsp;&nbsp;	
							
							<span onClick="remove_ctag('<?=$cate_attribute['attribute_group_id']?>','<?= $cate_attribute['attribute_group_name']?>')" title="Remove All Category Link" style="cursor:pointer; color:#F00;">Delete All</span>
                             <?php /*?><i class="fa fa-times" onClick="remove_ctag('<?=$cate_attribute['attribute_group_id']?>','<?= $cate_attribute['attribute_group_name']?>')" title="Remove Category Link" style="cursor:pointer; color:#F00;"></i><?php */?>	
                             
                             					
                           <!--<i class="fa fa-times" style="font-size:16px; cursor:pointer; color:#F00;" onClick="delete_codchargesaswtgh('<?//=//$res_colorsetup['color_id']?>')"></i>-->
                            </td>
                            
                            </tr>
                            <?php
								$sl++; 
							} //  forloop end
							}else{ ?>
                            <tr style="text-align:center;">
                            <td colspan="4">No Record Found!</td>
                            </tr>
                            <?php } ?>
                            </table>
										</div>
									</div>
								</div>
								
							</div>
                            

							
						</div>
					</div>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->




</div>


	</body>
</html>