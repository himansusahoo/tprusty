<?php
require_once('header.php');
?>
<style>
.alert {
    padding: 20px;
    background-color: #f44336;
    color: white;
    opacity: 1;
    transition: opacity 0.6s;
    margin-bottom: 15px;
}

.alert.success {background-color: #4CAF50;}
.alert.info {background-color: #2196F3;}
.alert.warning {background-color: #ff9800;}

.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

.closebtn:hover {
    color: black;
}
</style>
<style>
.alert {
    opacity: 1;
    transition: opacity 0.6s; /* 600ms to fade out */
}
</style>
<script type="text/javascript" src="<?php echo base_url().'asset/ckeditor/ckeditor.js' ?>"></script>
<script src="<?php echo base_url();?>js/chosen.jquery.js"></script>
<script>
  $(function() {
	$('.chosen-select').chosen();
	$('.chosen-select-deselect').chosen({ allow_single_deselect: true });
  });
</script>


<script>
function remove_menulink(pgsection_sqlid,menu_id)
{
	var conf=confirm('Do You want to Delete ?');
	if(conf){
		$('#loader_div').css('display','block');
			$.ajax({
				method:"POST",
				url:"<?php echo base_url().'admin/Page_single_product/remove_categorymenulink' ?>",
				data:{pgsection_sqlid:pgsection_sqlid,menu_id:menu_id},
				success: function() {
						//$('#testid').html(data);					
						window.location.reload(true);
						$('#loader_div').css('display','none');
				}
			});
		
		
		}
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
                <?php require_once('pagedesign_setup/mobile_single_product_addsectionjs.php'); ?>
                	<?php
					//$attributes = array('onSubmit' => 'return valid_columndata()');
					echo form_open_multipart('admin/Page_single_product/update_single_product_sectiondata');
					?>
                	<!--<form onSubmit="return membershipInfo()">-->
					<div class="row content-header">
						<div class="col-md-8"><h4><b>Edit Section Of Single Product Page</b></h4><div id="ssmessg"><?= $this->session->flashdata('succss_msg'); ?></div></div>
						<div class="col-md-4 show_report">
                         <button type="button" id="section_submit" class='all_buttons' style="background-color:#C03;float:right; font-weight:bold; height:32px; width:72px;" onClick="window.location.href='<?php echo base_url(); ?>admin/Page_catlog/<?php if($this->uri->segment(2)=='Page_catlog'){ echo 'class="selected"';} ?>'" >
                        <i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Reset</button>
                        &nbsp;&nbsp;
							<button  type="submit" id="sectio_submit" class='all_buttons' style="background-color:#093; font-weight:bold;height:32px; width:72px;">                            <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Save</button>
						</div>
					</div>
                    <div id="show_error" align="center" style="color:#F00;display:none;"> </div>
                    
					<div class="form_view">
						<h3>Edit Section Of Single Product Page</h3>
							<table>
                            	<tr>                            
                            <td colspan="2">
                            	<!------------------------ Menu link table start----------------------------->
                                <?php $menu_arr=array(); 
								$qr_allcatg=$this->db->query("SELECT * FROM category_indexing WHERE cat_level='3' ");
								$ctr_allcatg=$qr_allcatg->num_rows();
								
								if($sec_info->row()->menu_id!='') {?>
									<div style="width:100%; height:150px; overflow-y:scroll;">
                                    	<table class="table table-bordered">
                                    		<div id="loader_div" style="display:none; text-align:center;"> 
                                            <img src="<?php echo base_url().'images/loading1.gif' ?>" /> 
                                                </div>
                                            <tr bgcolor="#99CCFF">
                                            	<th width="10%">Sl No</th>
                                                <th width="30%">Second Level Menu Link</th>						
                                                <th width="10%">Action</th>
                                            </tr>
                                            <?php  $menu_arr=unserialize($sec_info->row()->menu_id);
										  		$sl=1;
												$ext_menuid=array();
												foreach($menu_arr as $key=>$vsal)
												{
												$ext_menuid[]=$vsal;
												$pgsection=$sec_info->row()->pgsection_sqlid;
												$qr_child=$this->db->query("SELECT lvl2_name,lvl2,lvl1_name,lvlmain_name FROM temp_category WHERE lvl2='$vsal'");
												$row_data=$qr_child->result_array();
												if($row_data) {
													foreach($row_data as $rows){
														
												?>                                    
											<tr>
                                            	<td><?=$sl?></td>
                                                <td>
                                                	 <?php echo $rows['lvlmain_name']." >> ".$rows['lvl1_name']." >> ".$rows['lvl2_name'];?>          
                                                </td>
                                                <td>
                                                	<i class="fa fa-times" onclick="remove_menulink('<?php echo $pgsection;?>','<?php echo $rows['lvl2']; ?>')" title="Remove Menu Link" style="cursor:pointer; color:#F00;"></i>
                                                </td>
                                            </tr>
                                            <?php $sl++; } } } ?>
                                         </table>
                                    </div>
                                 
                                    <?php } ?>		
								<!------------------------ Menu link table start----------------------------->
			                </td>
                            </tr>
                            <tr>
                                <td style="float:right;"><input type="checkbox" <?php if($ctr_allcatg==count(@$menu_arr)){echo "checked";} ?> id="all_categories" name="all_categories" value="catid" onClick="apply_cat(this)"></td>
                                <td>Global Products<sup></sup></td>                                    
                            </tr>
                            
                            <tr>
                                    <td><?php if($ctr_allcatg!=count($menu_arr)){ ?>Third Categories Link<?php } ?></td>
                                    <td id="hide_cat">
                                    <?php if($ctr_allcatg!=count($menu_arr)){ ?>
                                        <select name="menu_cat[]" data-placeholder="Choose Category Links"  class="chosen-select" style="width:490px" multiple tabindex="4" >
											<?php
												foreach($select_catagories as $sel_catg){
												
												?>
                                                
                                            	 <?php
                                                        if(!in_array($sel_catg->lvl2,$ext_menuid)){
                                                    ?>
                                                <option value="<?=$sel_catg->lvl2;?>" ><?=$sel_catg->lvlmain_name." >> ".$sel_catg->lvl1_name." >> ".$sel_catg->lvl2_name;?>
                                                </option>
                                                <?php } ?>
                                            <?php }?>
                                        </select><?php } ?>   
                                    </td>
                                   
                                </tr>	
                             				
								<tr>
									<td> Section type <sup>*</sup> </td>
									<td>
                                    <input type="hidden" id="secid_hdn" name="secid_hdn" value="<?=$sec_info->row()->Sec_id?>">
                                    <input type="hidden" id="pg_id" name="pg_id" value="<?=$sec_info->row()->pgsection_sqlid?>">
                                    <label id="lbl_section_type" style="font-size:18px;"><?=$sec_info->row()->sec_type?> </label>
                                    	<select name="section_type" id="section_type" class="text2" style="display:none">
                                        	<option value=''>---select---</option>
                                            <option value="Banner" <?php if($sec_info->row()->sec_type=='Banner'){echo 'selected';} ?>>Banner</option>
                                            <option value="Slider" <?php if($sec_info->row()->sec_type=='Slider'){echo 'selected';} ?>>Slider</option>
                                        	<option value="Carousel" <?php if($sec_info->row()->sec_type=='Carousel'){echo 'selected';} ?>>Carousel</option>
                                            <option value="Video" <?php if($sec_info->row()->sec_type=='Video'){echo 'selected';} ?>>Video</option>
                                            <option value="Grouped Banner" <?php if($sec_info->row()->sec_type=='Grouped Banner'){echo 'selected';} ?>>Grouped Banner</option>
                                            <option value="Product" <?php if($sec_info->row()->sec_type=='Product'){echo 'selected';} ?>>Product</option>
                                            <option value="Featured Box" <?php if($sec_info->row()->sec_type=='Featured Box'){echo 'selected';} ?>>Featured Box</option>                                            <option value="Products Vertical section" <?php if($sec_info->row()->sec_type=='Products Vertical section'){echo 'selected';} ?>>Products Vertical section</option>
                                            <option value="Rich Text Editor" <?php if($sec_info->row()->sec_type=='Rich Text Editor'){echo 'selected';} ?>>Rich Text Editor</option>
                                         </select>
                                    </td>
								</tr>
                                
                                <tr>
									<td>Section Labelling</td>
									<td>                                     
                                    	<input type="text" class="text2" name="section_lbltxtbox" id="section_lbltxtbox" style="width:490px; height:40px;" 
                                        	value="<?=$sec_info->row()->sec_lbl?>"></td>
								</tr>
                                
                                <tr>
									<td> Section Data type <sup>*</sup> </td>
									<td>
                                     <label id="lbl_sectiondata_type" style="font-size:18px;"><?=$sec_info->row()->sec_type_data?></label>
                                    	<select name="sectiondata_type" id="sectiondata_type" class="text2" style="display:none">
                                        	<option value=''>---select---</option>
                                        	<option value="Banner" <?php if($sec_info->row()->sec_type_data=='Banner'){echo 'selected';} ?>>Banner</option>
                                            <option value="Product" <?php if($sec_info->row()->sec_type_data=='Product'){echo 'selected';} ?>>Product</option>                                        </select>
                                    </td>
								</tr>
                                 <tr>
									<td> Section Status <sup>*</sup></td>
									<td>
                                     <label id="lbl_section_status" style="font-size:18px;"><?=$sec_info->row()->Status?></label>
                                    	<select name="section_status" id="section_status" class="text2" style="display:none">
                                        	<option value=''>---select---</option>
                                        	<option value="active" <?php if($sec_info->row()->Status=='active'){echo 'selected';} ?>>Active</option>
                                            <option value="inactive" <?php if($sec_info->row()->Status=='inactive'){echo 'selected';} ?>>Inactive</option>                                        </select>
                                    </td>
								</tr>
                                <tr>
									<td>Applied Section Background Color <sup>*</sup> </td>
									<td>
                                     <div  style="font-size:18px;width:490px;background-color:<?=$sec_info->row()->bg_color?>;" align="center">&nbsp;</div>
                                    <input type="hidden" id="sec_hdnbgcolor" name="sec_hdnbgcolor" value="<?=$sec_info->row()->bg_color?>">
                                    <input type="radio" name="secclr_checked" id="secclr_checked" style="display:none;" value="" > 	
								</tr>
                                <tr>
									<td>Change Section Background Color <sup>*</sup> </td>
									<td>
                                     
                                    <input type="color" onChange="check_seccolorchanged()" class="text2" name="sectionbackg_clr" id="sectionbackg_clr" style="width:490px; height:40px;" ></td>
								</tr>
                                <tr>
									<td style="width:20%;"> Number Of Column <sup>*</sup> </td>
									<td><!--<input type="number" min='1' step='1' max='3' class="text2" name="col_num" id="col_num">-->
                                     <label id="lbl_col_num" style="font-size:18px;"><?=$sec_info->row()->nos_column;?></label>
                                     
                                    <select name="col_num" id="col_num" class="text2" style="display:none" >
                                        	<option value=''>---select---</option>
                                        	<option value="1" <?php if($sec_info->row()->nos_column=='1'){echo 'selected';} ?>>1</option>
                                            <option value="2" <?php if($sec_info->row()->nos_column=='2'){echo 'selected';} ?>>2</option>
                                            <option value="3" <?php if($sec_info->row()->nos_column=='3'){echo 'selected';} ?>>3</option>
                                        </select>
                                    &nbsp;&nbsp;
                                   
                                    </td>
								</tr>                                
                                <tr>
                                <td>Image Size <sup>*</sup>
                                </td>
                                <td>
                                <?php
									$clmn_conunt=$sec_info->row()->nos_column;
									$img_size=$this->db->query("SELECT * FROM pagedesign_imagesize WHERE display_type='mobile' AND page_nm='single product' AND culumns_count='$clmn_conunt' ");?>
                                    <?php if($sec_info->row()->image_size!='') {?>  
                                   <label id="lbl_col_num" style="font-size:18px;"><?=$sec_info->row()->image_size.' px';?></label> 
								   <?php } ?>
                                  <select name="slctimage_size" id="slctimage_size" class="text2" style="display:none">
                            <?php foreach($img_size->result_array() as $img_sz) { ?>            	
                                        	<option value="<?=$img_sz['img_size'];?>" <?php if($sec_info->row()->image_size==$img_sz['img_size']){echo 'selected';} ?> > 
											<?=$img_sz['img_size'];?>
                                            </option>
                            <?php } ?>                
</select>
                                    
                                </td>
                                </tr>
                                <tr>
									<td style="width:20%;"> Memo </td>
									<td>
                                    <textarea class="text2" name="sec_memo" id="sec_memo" ><?php echo $sec_info->row()->memo; ?></textarea>
                                   </td>
                                   <td>
                             		<div id="div_screenshot" align="center">
                             		<?php
								   if($sec_info->row()->sec_type!='Catalog' && $sec_info->row()->sec_type!='Popular Product'){	     
								   $sec_type=str_replace(' ','_',$sec_info->row()->sec_type);
								   $col_num=$sec_info->row()->nos_column;
								   $img_size=$sec_info->row()->image_size;
								   $qr=$this->db->query("SELECT ".$sec_type." as srcshot_imgname FROM pagedesign_imagesize WHERE display_type='mobile' AND page_nm='single product' AND culumns_count='$col_num' AND img_size='$img_size' ");								  
								   ?>
                                   <?php if($sec_info->row()->sec_type=='Prodcts Vertical section') {?>
                                   <img style="float:left;" src="<?php echo base_url().'images/admin/mobile/mobile_single_product/product_vertical_section.png'; ?>" >									
                                   <?php } ?>
                                    <?php if($sec_info->row()->sec_type=='Video') {?>
                                   <img style="float:left;" src="<?php echo base_url().'images/admin/mobile/mobile_single_product/video.png'; ?>" >								
                                   <?php } ?>
                                   
                                    <?php if($sec_info->row()->sec_type=='Product') {?>
                                   <img style="float:left;" src="<?php echo base_url().'images/admin/mobile/mobile_single_product/product_product_clmn2_300x400.png'; ?>" >								
                                   <?php } ?>
                                   
                                   <?php if($sec_info->row()->sec_type=='Rich Text Editor') {?>
                                   <img style="float:left;" src="<?php echo base_url().'images/admin/mobile/mobile_single_product/Rich_texteditor.png'; ?>" >								
                                   <?php } ?>
                                   
                                   <?php  if($sec_info->row()->sec_type!='Prodcts Vertical section' && $sec_info->row()->sec_type!='Video' && $sec_info->row()->sec_type!='Product' && $sec_info->row()->sec_type!='Rich Text Editor'){ ?>
                                   <img style="float:left;" src="<?php echo base_url().'images/admin/mobile/mobile_single_product/'.$qr->row()->srcshot_imgname; ?>" >									<?php } ?>
                                   
								   <?php }else{ ?>
                                   <img style="float:left;" src="<?php echo base_url().'images/admin/mobile/mobile_single_product/product_vertical_section.png' ?>" >									
                                   <?php } ?>
                             
                             	</div>
                                   </td>
								</tr>
                                <?php /*?><tr>
                                <td style="width:20%;" colspan="2" align="center"><button type="button" style="display:none;" id="add_sectioncolumninfo" class='seller_buttons' onClick='add_columninfo()' ><i class="fa fa-plus-square" aria-hidden="true"></i> &nbsp;ADD Column </button></td>
                                </tr><?php */?>
							</table>
                            <div id="richtexteditor_divid" style="display:<?php if($sec_info->row()->sec_type=='Rich Text Editor') {echo "block";}else{echo "none";}?>;" >   
                               <textarea rows="7" name="richtxteditor_data" id="richtxteditor_data" class="text"><?=$sec_info->row()->sec_descrp?></textarea>
									<script type="text/javascript">
                                        CKEDITOR.replace('richtxteditor_data');
                                    </script>
                           </div>
                            <div id="columninfo_div" style="background-color:#099;display;<?php if($sec_info->row()->sec_type!='Rich Text Editor') {echo "block";}else{echo "none";}?>;"" align="center">
                           <?php 
						   $i=1;
						   $sec_idclmn=$sec_info->row()->Sec_id;
						   $qr_clmnid=$this->db->query("SELECT * FROM mobilesite_columninfo WHERE page_id='4' AND sec_id='$sec_idclmn'  ");
						   
						   if($qr_clmnid->num_rows()>0){
						   	    foreach($qr_clmnid->result_array() as $res_clmninfo)
						   		{ ?>
								<fieldset id="fld_secion_<?=$i?>"><legend style="background-color:#a3e4d7;">Column<?=$i?> &nbsp;
                                <?php /*?><i style="color:#FF0000;cursor:pointer;" class="fa fa-times" aria-hidden="true"  onClick="remove_culmn('<?=$i?>')"></i><?php */?></legend>                         <table>
                                
                                <tr>
									<td>Applied Column Background Color <sup>*</sup> </td>
									<td>
                                     <div  style="font-size:18px;width:200px;background-color:<?=$res_clmninfo['bg_color']?>;" align="center">&nbsp;</div>
                                    <input type="hidden" name="clmn_sqlidhdn[]" id="clmn_sqlidhdn<?=$i?>" value="<?=$res_clmninfo['clmn_sqlid']?>" >
                                    <input type="hidden" name="clmn_idhdn[]" id="clmn_idhdn<?=$i?>" value="<?=$res_clmninfo['clmn_id']?>" >
                                    <input type="hidden" name="clmn_hdnbgcolor[]" id="clmn_idhdn<?=$i?>" value="<?=$res_clmninfo['bg_color']?>" >
								</tr>

                                <tr><td>Change Column Background Color</td>
                                <td align="left">
                                
                                <input type="color" class="text2" onChange="check_colorchange('<?=$i?>')"  name="clmn_bgcolor[]" id="clmn_bgcolor<?=$i?>" style="width:200px; height:40px;">
                                <input type="radio" name="clr_checked[]" id="clr_checked<?=$i?>" style="display:none;" value="" > 
                                </td>	               
                                 </tr>
                                <tr><td>Column Status</td>
                                <td align="left">
                                <select class="text2" name="clmn_sts[]" id="clmn_sts<?=$i?>" style="width:200px; height:40px;">
                                <option value="active" <?php if($res_clmninfo['clmn_status']=='active'){echo "selected";} ?>>Active</option>
                                <option value="inactive" <?php if($res_clmninfo['clmn_status']=='inactive'){echo "selected";} ?>>Inactive</option>
                                </select>
                                </td>
                                </tr>
                                <tr>
                                <td>Column Type</td>
                                <td>
                                <select class="text2" name="clmn_type[]" id="clmn_type<?=$i?>" style="width:200px; height:40px;">
                                <option value="">--select--</option>
                              	<option value="url" <?php if($res_clmninfo['type']=='url'){echo "selected";} ?>>URL</option>
                                <option value="sku" <?php if($res_clmninfo['type']=='sku'){echo "selected";} ?>>SKU</option>
                                </select></td>
                                </tr>
                                <tr>
                                <td style="width:20%;"> Memo </td>
                                <td><textarea class="text2" name="clmn_memo[]" id="clmn_memo<?=$i?>"><?php echo $res_clmninfo['memo']?></textarea></td>
                                </tr>
                                <tr>
                                <td colspan="2" align="center">
                                <fieldset id="fld_culmn<?=$i?>" style="background-color:#a9dfbf;">
                                <legend style="background-color:#9CF;">Image Upload With Link</legend>
                                <div class="alert" id="alrt<?=$i?>" style="display:none;">
                                <span class="closebtn" style="display:none;">&times;</span><strong>!</strong></div>
                                <?php
								
								$clmn_sqlid=$res_clmninfo['clmn_sqlid'];								
								 ?>
                                 <?php 
								 	if($sec_info->row()->sec_type!=='Video' && $sec_info->row()->sec_type!=='Product' && $sec_info->row()->sec_type!=='Prodcts Vertical section')
									{
								  ?>
                                <button style="float:right;" type="button" id="add_sectioncolumninfo" class="seller_buttons" onClick="add_imagefor_editpage('<?=$i?>')" ><i class="fa fa-file-image-o" aria-hidden="true"></i> &nbsp;ADD Image </button>
                                <?php } ?>
                                
                                <table id="img_tbl<?=$i?>" class="table table-bordered table-hover" style="background-color:#FFF;">
                                <tr style="background-color:#f5b041;"><th width="10%">Image</th>
                                <th width="5%">Link Type</th><th width="15%">SKU / URL</th>
                                <th width="5%">Image Status</th>
                                <th width="5%">From date</th>
                                <th width="5%">To date</th>
                                <th width="10%">Memo</th>
                                <th width="5%">Action</th>
                                </tr>
                                
                                <?php
								$clmn_sqlid=$res_clmninfo['clmn_sqlid'];
								$qr_imagnofo=$qr_clmnordby=$this->db->query("SELECT * FROM mobilesite_imageinfo WHERE clmn_sqlid='$clmn_sqlid'  ");							
								 $j=1;
								if($qr_imagnofo->num_rows()>0)
								{
								 foreach($qr_imagnofo->result_array() as $res_imgdata)
								 {
								 ?>
                                 
                                 
                                <tr id="tblrow_tbl<?=$i.$j?>">
                                <td>
                                <input type="hidden" name="imgsqlid_hidhdn<?=$i?>[]" id="imgsqlid_hidhdn<?=$i.$j?>" value="<?=$res_imgdata['img_sqlid']?>" >
                                
                                 <input type="hidden" name="oldimagename_hidhdn<?=$i?>[]" id="oldimagename_hidhdn<?=$i.$j?>" value="<?=$res_imgdata['imge_nm']?>" >
                                 
                                <input style="width:192px;" type="file" id="imgInp<?=$i.$j?>" name="userfile<?=$i?>[]"  onChange="preview_img(this,'<?=$i?>','<?=$j?>')" >
                                <img id="oldimg<?=$i.$j?>" src="<?php echo base_url().'images/pagedesign_image/'.$res_imgdata['imge_nm'] ?>" alt="your image" style="width:95px;height:80px;"  />
                                <img id="imgprvw<?=$i.$j?>" src="#" alt="your image" style="width:95px;height:80px;display:none;"  />
                                </br><span id="removimage<?=$i.$j?>" style="color:red;display:none;cursor:pointer;" onClick="img_remove('<?=$i?>','<?=$j?>')">Remove Image</span>
                                <fieldset id="imgelbl<?=$i.$j?>"><legend style="background-color:#CCC; font-size:13px; font-weight:bold;">Image Label</legend><span class="textarea_val<?=$i.$j?>" style="width:20%; float:right; margin-top: -52px;    padding: 16px; display: inline-block;"></span><textarea name="imglab_txtara<?=$i?>[]" id="imglab_txtara<?=$i.$j?>" class="imglab_txtara<?=$i.$j?>" onKeyUp="onkeuup(<?=$i.$j?>)" maxlength="8"  style="width:127px;" placeholder="Enter Image Label"><?=stripslashes($res_imgdata['imag_label'])?></textarea></fieldset>
                                </td>
                                <td>
                                <select onChange="display_urlvisible('<?=$i?>','<?=$j?>')" class="text2" name="img_skuorurl<?=$i?>[]" id="img_skuorurl<?=$i.$j?>" style="width:80px; height:40px;">
                                <option value="sku" <?php if($res_imgdata['sku']!=''){echo "selected";} ?>>SKU</option>
                                <option value="url" <?php if($res_imgdata['URL']!=''){echo "selected";} ?>>URL</option>
                                <option value="nolink" <?php if($res_imgdata['URL']=='' && $res_imgdata['sku']==''){echo "selected";} ?>>No Link</option>
                                </select>
                                </br></br>
                                <fieldset  style="display:<?php if($res_imgdata['sku']=='') {echo "none";}?>;"  id="displayurlfldset<?=$i.$j?>" ><legend style="background-color:#CCC; font-size:13px; font-weight:bold;">Display URL</legend>
                                <textarea name="dispaly_url<?=$i?>[]" id="dispaly_url<?=$i.$j?>"  style="width:127px;" placeholder="Enter Display URL"><?=$res_imgdata['display_url']?></textarea></fieldset>
                                </br>
                                <fieldset  style="display:<?php if($res_imgdata['sku']=='') {echo "none";}?>;" id="sortbyinfo<?=$i.$j?>"><legend style="background-color:#CCC; font-size:13px; font-weight:bold;">Sort By</legend>
                                <select style="width:150px; height:40px;" class="text2" name="sku_sortby<?=$i?>[]" id="sku_sortby<?=$i.$j?>">
                                	<option value="as_per_sku" <?php if($res_imgdata['sort_by_info']=='as_per_sku'){echo "selected";} ?>>As Per sku</option>
                                	<option value="random" <?php if($res_imgdata['sort_by_info']=='random'){echo "selected";} ?>>Random</option>
                                    <option value="prc_asc" <?php if($res_imgdata['sort_by_info']=='prc_asc'){echo "selected";} ?>>Price High To Low</option>
                                    <option value="pric_dec" <?php if($res_imgdata['sort_by_info']=='pric_dec'){echo "selected";} ?>>Price Low To High</option>
                                    </select></fieldset>
                                </td>
                                <td>
                                <textarea  id="imglinkkskuorurl<?=$i.$j?>" name="imglinkkskuorurl<?=$i?>[]" style="width:192px; height:80px;"><?php if($res_imgdata['sku']!='' && $res_imgdata['skulink_excelfile']==''){echo implode(',',unserialize($res_imgdata['sku']));} else if($res_imgdata['URL']!=''){echo $res_imgdata['URL']; } ?></textarea>
                                
                                <br><div style="font-weight:bold;text-align:center;" align="center">OR</div><br>
                                
                                <!------------------uploaded csv file display start----------------->
                                <?php if($res_imgdata['skulink_excelfile']!=''){ ?>
									<a id="exc_nmid<?=$i.$j?>" title="Download csv File" href="<?php echo base_url().'pagesetup_skuexcelfile/'.$res_imgdata['skulink_excelfile']; ?>">
                                    <img src="<?php echo base_url().'images/Excel.png' ?>" width="16" height="16" title="<?=$res_imgdata['skulink_excelfile']?>">
									<span  style="font-size:13px;"><?= substr($res_imgdata['skulink_excelfile'],0,15).'...csv'?></span></a>
                                    &nbsp;<i id="remove_ibutton<?=$i.$j?>" onClick="remove_csvfile('<?=$i?>','<?=$j?>','<?=$res_imgdata['img_sqlid']?>','<?=$res_imgdata['skulink_excelfile']?>')" title="Remove Excel File" class="fa fa-times" aria-hidden="true" style="color:#F00;font-size:16px; cursor:pointer;"></i>
                                    <div id="csvprocess_div<?=$i.$j?>" style="display:none; color:#090;"> <img src="<?php echo base_url().'images/progress.gif' ?>" />Wait... </div><div id="div_imgsize"></div>
								<?php } ?>
                                 <!------------------uploaded csv file display end---------------->
                                 
                                <input onChange="valid_csvfileextension(this,<?=$i?>,<?=$j?>)" style="width:192px;" type="file" id="ExcelInp<?=$i.$j?>" name="userfile_excel<?=$i?>[]">
                                <input type="hidden" name="csvfile_hidhdn<?=$i?>[]" id="csvfile_hidhdn<?=$i.$j?>" value="<?=$res_imgdata['skulink_excelfile']?>" >
                                </td>
                                <td>
                                <select class="text2" name="img_sts<?=$i?>[]" id="img_sts<?=$i.$j?>" style="width:80px;">
                                <option value="active" <?php if($res_imgdata['image_status']=='active'){echo "selected";} ?> >Active</option>
                                <option value="inactive" <?php if($res_imgdata['image_status']=='inactive'){echo "selected";} ?>>Inactive</option>
                                </select>
                                </td>
                                <td>
                                <?php if($res_imgdata['frm_dt_tm']!='0000-00-00 00:00:00'){echo  date('M-d-Y',strtotime($res_imgdata['frm_dt_tm'])); }?>
                                <input type="hidden" name="fromdt_hidhdn<?=$i?>[]" id="fromdt_hidhdn<?=$i.$j?>" value="<?=$res_imgdata['frm_dt_tm']?>" >
                                <br>
                                <input type="date" id="from_dt<?=$i.$j?>" style="width:150px;" name="from_dt<?=$i?>[]" >
                                </td>
                                <td>
                                 <?php if($res_imgdata['to_dt_tm']!='0000-00-00 00:00:00'){ echo  date('M-d-Y',strtotime($res_imgdata['to_dt_tm']));} ?>
                                 <input type="hidden" name="todt_hidhdn<?=$i?>[]" id="todt_hidhdn<?=$i.$j?>" value="<?=$res_imgdata['to_dt_tm']?>" >
                                <br>
                                <input type="date" id="to_date<?=$i.$j?>" name="to_date<?=$i?>[]" style="width:150px;" >
                                </td>
                                <td>
                            <textarea style="width:116px; height:80px;" name="img_memo<?=$i?>[]" id="img_memo<?=$i.$j?>" ><?=$res_imgdata['memo']?></textarea>
                                </td>
                                <td>
                                <i style="color:#FF0000;cursor:pointer;" onClick="remove_img('<?=$i?>',<?=$j?>,'<?=$res_imgdata['img_sqlid']?>')" class="fa fa-times" aria-hidden="true"></i>
                                <div id="process_div<?=$i.$j?>" style="display:none; color:#090;"> <img src="<?php echo base_url().'images/progress.gif' ?>" />Wait... </div><div id="div_imgsize"></div>
                                </td>
                                </tr>
                                
                                <?php $j++; }  // for loop conditon end for image display
									} // if condition end for image rows
								 ?>
                                </table>
                                </fieldset>
                                </td>
                                </tr></table>
                                
                                
                                </fieldset>
								
						   <?php  $i++; }
						   } //if condition end for number of columnns
						    ?>
                            </div>
					</div>
                    <?php echo form_close(); ?>
				</div><!--   End of Main-content  -->
		</div><!-- @end #content -->
        
<link rel="stylesheet" href="<?php echo base_url();?>jquery_date_picker/jquery-ui.css">
<!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>-->
<script src="<?php echo base_url();?>jquery_date_picker/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">

<script>
 $(function() {
       $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" }).val()
  });

  $(function() {
	$( "#datepicker" ).datepicker();
  });
</script>
<script>
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
    close[i].onclick = function(){
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; }, 600);
    }
}
</script>
<script>
function remove_img(i,j,img_sqlid)
{
	$("#process_div"+i+j).css('display','block');
	$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/Page_single_product/remove_imagedata",
					data:{img_sqlid:img_sqlid},
					success: function (data) {
						
							//window.location.reload(true);
							('#process_div'+i+j+'').css('display','none');
						
					}
				});
				
	//$('#oldimg'+i+j+'').css('display','none');	
	//$('#imgInp'+i+j+'').val('');
	
	$('#columninfo_div #fld_secion_'+i+' #fld_culmn'+i+' #img_tbl'+i+' #tblrow_tbl'+i+j+'').html('');
	$('#columninfo_div #fld_secion_'+i+' #fld_culmn'+i+' #img_tbl'+i+' #tblrow_tbl'+i+j+'').remove('');
				
		
}

function check_colorchange(i)
{$('#clr_checked'+i+'').val('color changed');
	document.getElementById('clr_checked'+i).checked= 'checked';
	
}

function check_seccolorchanged()
{
	$('#secclr_checked').val('color changed');
	document.getElementById('secclr_checked').checked= 'checked';	
}

function remove_csvfile(i,j,img_sqlid,cvsfilenm)
{
	var conf=confirm("Do You Want To Delete CSV File ?");
	
	if(conf)
	{
		$('#csvprocess_div'+i+j+'').css('display','block');
		$.ajax({
			method:"POST",
			url:"<?php echo base_url(); ?>admin/Page_single_product/remove_csvdata",
			data:{img_sqlid:img_sqlid,cvsfilenm:cvsfilenm},
			success: function (data) {
				
					//window.location.reload(true);
					$('#csvfile_hidhdn'+i+j+'').val('');
					$('#csvprocess_div'+i+j+'').css('display','none');
					$('#exc_nmid'+i+j+'').css('display','none');
					$('#remove_ibutton'+i+j+'').css('display','none');
					
					
				
			}
		});
	}
}

function apply_cat(e){
		if( $('input[name=all_categories]').is(':checked') ){
  			$('#all_categories').val('catid');
			$('#hide_cat').css('display','none');
		}
		else
			$('#all_categories').val('');
  			$('#hide_cat').css('display','block');
		
	}

</script>
<script>
	function onkeuup(valuid){
	var text_max = 8;
	var text_length = $('.imglab_txtara'+valuid).val().length;
	//alert (text_length);
	var text_remaining = text_max - text_length;
	 $('.textarea_val'+valuid).html('8/'+text_remaining);
	}
</script>
<?php
require_once('footer.php');
?>	