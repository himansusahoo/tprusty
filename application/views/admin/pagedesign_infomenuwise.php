
<table class="table table-bordered table-hover">
                        <tr ><td colspan="10" >Change Section Status
						<select id="sec_status" name="sec_status" class="text2" style="width:200px; height:30px;" >
                                    <option value="">--select--</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>                                   
                                </select>                           
                            <input style="width:100px; height:30px;" type="button" name="change_sectionstatusbtn" class="seller_buttons" onClick="change_section_status()" value="Apply">
                            
                            <?php if($this->session->flashdata('flshmsg')){ ?>	<div id="successfully_verify" style="color:#0C0;" align="center">
						<img src="<?php echo base_url().'images/success_icon.png' ?>">&nbsp<?php echo $this->session->flashdata('flshmsg'); ?>
                        </div> 
						<?php } ?>
                            </td> 
                       
                        </tr>
                        	<tr class="table_th">
                            	<th width="3%"><input type="checkbox" id="check_all" name="check_all"></th>
								<th width="3%">Section Id</th>
                                <th width="20%">Section Demo Screenshot</th>
								<th width="6%">Section type</th>
								<th width="5%">Section Data type </th>
								<th width="5%">Section Status</th>
								<th width="5%">Section Background Color</th>
								<th width="3%">Number Of Column</th>
                                <th width="12%">Sorting</th>
								<th width="10%">Action</th>
							</tr>
                            <?php if($cat_data!=false)
								{   $sec_ctr=$cat_data->num_rows();
										if($sec_ctr>0){
											$sort_i=1;
											foreach($cat_data->result_array() as $res_secinfo){
								?>
                            
                            <!--Data Display from page section table start-->                            	
                                	<tr id=tblrow<?=$res_secinfo['pgsection_sqlid']?>> 
                                        <td><input type="checkbox" id="chk_sec<?=$res_secinfo['pgsection_sqlid']?>" name="chk_sec[]" value="<?=$res_secinfo['pgsection_sqlid']?>"  onclick="select_tblrow('<?=$res_secinfo['pgsection_sqlid']?>')"></td>
                                        <td><?=$res_secinfo['Sec_id']?>
                                        <div id="process_div<?=$res_secinfo['pgsection_sqlid']?>" style="display:none; color:#090;"> <img src="<?php echo base_url().'images/progress.gif' ?>" />Please Wait... </div><div id="div_imgsize"></div>
                                        </td>
                                        <td> 
                                   <?php
								   if($res_secinfo['sec_type']!='Catalog' && $res_secinfo['sec_type']!='Popular Product'){	     
								   $sec_type=str_replace(' ','_',$res_secinfo['sec_type']);
								   $col_num=$res_secinfo['nos_column'];
								   $img_size=$res_secinfo['image_size'];
								   $qr=$this->db->query("SELECT ".$sec_type." as srcshot_imgname FROM pagedesign_imagesize WHERE display_type='mobile' AND page_nm='catalog' AND culumns_count='$col_num' AND img_size='$img_size' ");
								   $qr->num_rows();
								   								  
								   ?>
                                   <?php if($res_secinfo['sec_type']=='Prodcts Vertical section') {?>
                                   <img style="float:left;" src="<?php echo base_url().'images/admin/mobile/mobile_catlog/product_vertical_section.png'; ?>" >									
                                   <?php } ?>
                                    <?php if($res_secinfo['sec_type']=='Video') {?>
                                   <img style="float:left;" src="<?php echo base_url().'images/admin/mobile/mobile_catlog/video.png'; ?>" >								
                                   <?php } ?>
                                   
                                    <?php if($res_secinfo['sec_type']=='Product') {?>
                                   <img style="float:left;" src="<?php echo base_url().'images/admin/mobile/mobile_catlog/proudct.png'; ?>" >								
                                   <?php } ?>
                                   
                                   <?php if($res_secinfo['sec_type']=='Rich Text Editor') {?>
                                   <img style="float:left;" src="<?php echo base_url().'images/admin/mobile/mobile_catlog/Rich_texteditor.png'; ?>" >								
                                   <?php } ?>
                                   
                                   <?php  if($res_secinfo['sec_type']!='Prodcts Vertical section' && $res_secinfo['sec_type']!='Video' && $res_secinfo['sec_type']!='Product' && $res_secinfo['sec_type']!='Rich Text Editor' ){ ?>
                                   <img style="float:left;" src="<?php echo base_url().'images/admin/mobile/mobile_catlog/'.$qr->row()->srcshot_imgname; ?>" >									<?php } ?>
                                   
								   <?php }else{ ?>
                                   <img style="float:left;" src="<?php echo base_url().'images/admin/mobile/mobile_catlog/product_vertical_section.png' ?>" >									
                                   <?php } ?>
                                     </td>
                                        <td><?=$res_secinfo['sec_type']?></td>
                                        <td><?=$res_secinfo['sec_type_data']?></td>
                                        <td><?=$res_secinfo['Status']?></td> 
                                        <td style="background-color:<?=$res_secinfo['bg_color']?>;"></td> 
                                    	<td><?=$res_secinfo['nos_column']?></td>
                                    	<td><?php if($sort_i>1) {?>
                                    		<img src='<?php echo base_url().'images/icon_finder/1495193298_Stock Index Up.ico' ?>' style="width:25px;height:29px;cursor:pointer;" onClick="catlogsortby_section_upajx('<?=$res_secinfo['pgsection_sqlid']?>')" > 
											<span><a style="cursor: pointer; color:#333" onClick="catlogsortby_section_upajx('<?=$res_secinfo['pgsection_sqlid']?>')">Up</a></span>
											<span style="float:right;"><a class="fa fa-angle-double-up" style="cursor: pointer; color:#333; font-size:20px;" title="Move To Top" onClick="catlogsortby_section_totopajx('<?=$res_secinfo['pgsection_sqlid']?>')"></a></span>
											<?php } ?><br>
                                    		<?php if($sort_i!=$sec_ctr){  ?>
                                    		<img src='<?php echo base_url().'images/icon_finder/1495193373_Stock Index Down.ico' ?>' style="width:25px;height:29px;cursor:pointer;" onClick="catlogsortby_section_downajx('<?=$res_secinfo['pgsection_sqlid']?>')" >
											<span><a style="cursor: pointer; color:#333" onClick="catlogsortby_section_upajx('<?=$res_secinfo['pgsection_sqlid']?>')">Down</a></span>&nbsp;&nbsp;
											<span style="float:right;"><a class="fa fa-angle-double-down" style="cursor: pointer; color:#333; font-size:20px;" title="Move To Buttom" onClick="catlogsortby_section_todownajx('<?=$res_secinfo['pgsection_sqlid']?>')"> </a></span>
                                    		<?php } ?>
                                    	</td>
										<td>
                                        <a href="<?php echo base_url().'admin/page_catlog/edit_mobilecatlogsection/'.$res_secinfo['pgsection_sqlid'] ?>" target="_blank">
                                        <img src='<?php echo base_url().'images/icon_finder/1495194794_edit-notes.ico' ?>' style="width:30px;height:25px;cursor:pointer;">
										&nbsp;</a>
										<span><a style="cursor: pointer; color:#333;" href="<?php echo base_url().'admin/page_catlog/edit_mobilecatlogsection/'.$res_secinfo['pgsection_sqlid'] ?>" target="_blank">Edit </a></span><br>
                            				<img src='<?php echo base_url().'images/icon_finder/1496144786_f-cross_256.ico' ?>' style="width:20px;height:20px;cursor:pointer;"  onClick="valid_remove('<?=$res_secinfo['pgsection_sqlid']?>')" >
											&nbsp;
											<span><a style="cursor: pointer; color:#333;" onClick="valid_remove('<?=$res_secinfo['pgsection_sqlid']?>')">Delete </a></span><br>
                            			</td>                                    
                                    </tr>
                            <!--Data Display from page section table end--->
									<?php 
                                        $sort_i++;	} // for loop end
                                            }
                                        }
										else
										{
                                    ?>
                                    <tr><td style="color:#F00; text-align:center;" colspan="10">No Record Found</td></tr>
                                    
                                    <?php } ?>	
                        </table>