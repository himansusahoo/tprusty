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
<script>
$(document).ready(function(){
	$('#check_all').click(function(){
		$('input:checkbox').prop('checked', this.checked);
	});
});
</script> 

<script>

function select_tblrow(tblrowsl)
{
		
		if(document.getElementById('chk_sec'+tblrowsl).checked== true)
		{
			$("#tblrow"+tblrowsl).css("background-color", "#c39bd3");
			//document.getElementById('prodskuid_chk'+sl).checked='checked';
			
			
		}
		else if(document.getElementById('chk_sec'+tblrowsl).checked== false)
		{
			
			$("#tblrow"+tblrowsl).css("background-color", "");
			//document.getElementById('prodskuid_chk'+sl).checked='';
			
		}		  
	
}
</script> 

<script src="<?php echo base_url();?>js/chosen.jquery.js"></script>
<script>
  $(function() {
	$('.chosen-select').chosen();
	$('.chosen-select-deselect').chosen({ allow_single_deselect: true });
  });
</script>

<style>
.add-new-sec{
	background-color:#666;float:right;
}
.add-new-sec:hover{color:#fff !important;}
</style>

<!-- Lightbox link end here -->
<?php //require_once('pagedesign_setup/mobile_homepage_addsection.php'); ?>
			<div id="content">   
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_config.php';?>
					</div>
                    <div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
						
				</div>  <!-- @end top-bar  -->
						
				 <div class="clearfix"></div>
                 </br>
			 <!-- @end top-bar  -->
				<div class="main-content">
               		<div class="row content-header" >
                		<h4><b>Mobile Page Design</b></h4><div id="ssmessg"></div>
                	</div>
                </div>
                
					<?php
						require_once('mobilepage_setuptabmenu.php');
					?>
					<div class="row gray_bg">						
						<!--<div class="col-md-10 mt20">-->
							
						<?php //if($this->session->flashdata('msgcod_wtchrg')){ ?>	<!--<div id="successfully_verify" style="color:#0C0;">-->
						<!--<img src="<?php //echo base_url().'images/success_icon.png' ?>">-->&nbsp<?php //echo $this->session->flashdata('msgcod_wtchrg'); ?>
                       <!-- </div>--> <?php //} ?>									
                        
                        <?php /*?><button id="product_submit" class='seller_buttons' style="background-color:#666;float:right;" onclick="window.location.href='<?php echo base_url().'admin/page_single_product/addnewsection_mobile_signle_product'; ?>'" >
							<i class="fa fa-plus-square" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Add New Section 
           				</button> <?php */?>
                         <a id="product_submit" class='seller_buttons add-new-sec' style="background-color:#666;float:right;" href="<?php echo base_url().'admin/page_single_product/addnewsection_mobile_signle_product'; ?>" target="_blank">
							<i class="fa fa-plus-square" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Add New Section</a>
                            
							<div class="tab-content">
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											<div class="right mb10">
												<!--<a id="product_submit" class='seller_buttons inline' href='#inline_content_addweighcharges'  > 
           											<i class="fa fa-plus-square" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Add New Section 
           										</a>-->
                                               
											</div>
                                            <div class="pagination">
												<?php /*?><p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p><?php */?>
											</div>
                                            
                                           
                        </div>
                        <div class="clearfix"></div>
                        <div>
                     <!-- <div id="loader_div" style="display:none; text-align:center;"> <img src="<?php //echo base_url().'images/loading1.gif' ?>" /> -->
                       
                        </div>
					 
						<!-----DIV Data Start----->
                        <!---------------------menu link start--------------------->
                        <div>
                           <span>
                           		 <?php 
								 $qr_section=$this->db->query("SELECT menu_id FROM 
								                       mobilesite_pagesectioninfo WHERE page_id='4' AND page_name='single product' AND menu_id!=''  ");
								$menuid_arrfind=array();
								if($qr_section->num_rows()>0)
								{
									foreach($qr_section->result_array() as $res_menuids)
									{
										$menuid_arrfind=array_merge($menuid_arrfind,unserialize($res_menuids['menu_id']));	
									}	
								}						
										   ?>
                           
                                        <select name="menu_link" data-placeholder="Choose Category Links" 
                                        class="chosen-select" style="width:500px" id="menu_link" tabindex="4">
                                        <option value=''>Select Third Category</option>
                                            <?php foreach($select_catagories as $sel_catg){ ?>
                                            <?php if(in_array($sel_catg->lvl2,$menuid_arrfind)) {?>
                                                <option value="<?=$sel_catg->lvl2;?>" >
												<?=$sel_catg->lvlmain_name." >> ".$sel_catg->lvl1_name." >> ".$sel_catg->lvl2_name;?>
                                                </option>
                                            <?php } }?>
                                        </select>
                                    </span>
                               
                        	<input type="button" name="srch_pgdesing" id="srch_pgdesing" value="Search" onClick="srch_pgdesigninfo()">
                        
                        <!-- <div id="loader_div" style="display:none; text-align:center;"> <img src="<?php //echo base_url().'images/loading1.gif' ?>" />--> 
                       
                        </div>
                        </div>
                        <!---------------------menu link end--------------------->
                       
                        <div id="loader_div" style="display:none; text-align:center;"> 
                      <img src="<?php echo base_url().'images/loading1.gif' ?>" /> 
                      </div>
                        <div id="section_div">
                        <?php /*?><table class="table table-bordered table-hover">
                        <tr ><td colspan="10" >Change Section Status
						<select id="sec_status" name="sec_status" class="text2" style="width:200px; height:30px;" >
                                    <option value="">--select--</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>                                   
                                </select>                           
                            <input style="width:100px; height:30px;" type="button" name="change_sectionstatusbtn" class="seller_buttons" onClick="change_section_status()" value="Apply">
                            </td>
                       
                        </tr>
                        	<tr class="table_th">
                            	<th width="3%"><input type="checkbox" id="check_all" name="check_all"></th>
								<th width="3%">Section Id</th>
                                <th width="25%">Section Demo Screenshot</th>
								<th width="10%">Section type</th>
								<th width="5%">Section Data type </th>
								<th width="5%">Section Status</th>
								<th width="8%">Section Background Color</th>
								<th width="3%">Number Of Column</th>
                                <th width="5%">Sorting</th>
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
                                        <td><?=$res_secinfo['Sec_id']?></td>
                                        <td> 
                                   <?php
								   if($res_secinfo['sec_type']!='Catalog' && $res_secinfo['sec_type']!='Popular Product'){	     
								   $sec_type=str_replace(' ','_',$res_secinfo['sec_type']);
								   $col_num=$res_secinfo['nos_column'];
								   $img_size=$res_secinfo['image_size'];
								   $qr=$this->db->query("SELECT ".$sec_type." as srcshot_imgname FROM pagedesign_imagesize WHERE display_type='mobile' AND page_nm='single product' AND culumns_count='$col_num' AND img_size='$img_size' ");
								   $qr->num_rows();
								   								  
								   ?>
                                   <?php if($res_secinfo['sec_type']=='Prodcts Vertical section') {?>
                                   <img style="float:left;" src="<?php echo base_url().'images/admin/mobile/mobile_single_product/product_vertical_section.png'; ?>" >									
                                   <?php } ?>
                                    <?php if($res_secinfo['sec_type']=='Video') {?>
                                   <img style="float:left;" src="<?php echo base_url().'images/admin/mobile/mobile_single_product/video.png'; ?>" >								
                                   <?php } ?>
                                   
                                    <?php if($res_secinfo['sec_type']=='Product') {?>
                                   <img style="float:left;" src="<?php echo base_url().'images/admin/mobile/mobile_single_product/proudct.png'; ?>" >								
                                   <?php } ?>
                                   
                                   <?php if($res_secinfo['sec_type']=='Rich Text Editor') {?>
                                   <img style="float:left;" src="<?php echo base_url().'images/admin/mobile/mobile_single_product/Rich_texteditor.png'; ?>" >								
                                   <?php } ?>
                                   
                                   <?php  if($res_secinfo['sec_type']!='Prodcts Vertical section' && $res_secinfo['sec_type']!='Video' && $res_secinfo['sec_type']!='Product' && $res_secinfo['sec_type']!='Rich Text Editor' ){ ?>
                                   <img style="float:left;" src="<?php echo base_url().'images/admin/mobile/mobile_single_product/'.$qr->row()->srcshot_imgname; ?>" >									<?php } ?>
                                   
								   <?php }else{ ?>
                                   <img style="float:left;" src="<?php echo base_url().'images/admin/mobile/mobile_single_product/product_vertical_section.png' ?>" >									
                                   <?php } ?>
                                     </td>
                                        <td><?=$res_secinfo['sec_type']?></td>
                                        <td><?=$res_secinfo['sec_type_data']?></td>
                                        <td><?=$res_secinfo['Status']?></td> 
                                        <td style="background-color:<?=$res_secinfo['bg_color']?>;"></td> 
                                    	<td><?=$res_secinfo['nos_column']?></td>
                                    	<td><?php if($sort_i>1) {?>
                                    		<img src='<?php echo base_url().'images/icon_finder/1495193298_Stock Index Up.ico' ?>' style="width:25px;height:29px;cursor:pointer;" onClick="window.location.href='<?php echo base_url().'admin/page_single_product/single_productsortby_section_up/'.$res_secinfo['pgsection_sqlid'] ?>' " > &nbsp;  <?php } ?>
                                    		<?php if($sort_i!=$sec_ctr){  ?>
                                    		<img src='<?php echo base_url().'images/icon_finder/1495193373_Stock Index Down.ico' ?>' style="width:25px;height:29px;cursor:pointer;" onClick="window.location.href='<?php echo base_url().'admin/page_single_product/single_productsortby_section_down/'.$res_secinfo['pgsection_sqlid'] ?>' " >
                                    		<?php } ?>
                                    	</td>
										<td><img src='<?php echo base_url().'images/icon_finder/1495194794_edit-notes.ico' ?>' style="width:33px;height:29px;cursor:pointer;" onClick="window.location.href='<?php echo base_url().'admin/page_single_product/edit_mobile_singleproduct_section/'.$res_secinfo['pgsection_sqlid'] ?>' " >
                            &nbsp;
                            				<img src='<?php echo base_url().'images/icon_finder/1496144786_f-cross_256.ico' ?>' style="width:33px;height:29px;cursor:pointer;"  onClick="valid_remove('<?=$res_secinfo['pgsection_sqlid']?>')" >
                            			</td>                                    
                                    </tr>
                            <!--Data Display from page section table end--->
									<?php 
                                        $sort_i++;	} // for loop end
                                            }
                                        }
                                    ?>	
                        </table><?php */?>
                        </div>
						<!-----DIV Data End----->
										</div>
									</div>
								</div>
								<div id="tab2" class="tab-pane fade">
									
								</div>
							</div>
						</div>
					</div>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->
         </div>


<script>

function srch_pgdesigninfo()
{ var mnulinkid=$('#menu_link').val();

	if(mnulinkid=='')
	{
		alert('Please select 3rd level category link');
		return false;	
	}
	else
	{
		$('#loader_div').css('display','block');
					$.ajax({
						method:"POST",
						url:"<?php echo base_url(); ?>admin/Page_single_product/populate_singleprodpagedesigninfo",
						data:{mnulinkid:mnulinkid},
						success: function (data) {
							$('#section_div').html(data);
							$('#loader_div').css('display','none');						
							//window.location.reload(true);
						}
			});
	}

}

function singleprodsortby_section_upajx(pgsec_sqlid)
{
	var menu_id=$('#menu_link').val();
			
			$('#process_div'+pgsec_sqlid).css('display','block');
				$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/Page_single_product/single_productsortby_section_up",
					data:{pgsec_sqlid:pgsec_sqlid,mnulinkid:menu_id},
					success: function (data) {						
						
						$('#section_div').html(data);
						$('#process_div'+pgsec_sqlid).css('display','none');
						//window.location.reload(true);
					}
				});	
}


function singleprodsortby_section_downajx(pgsec_sqlid)
{
	var menu_id=$('#menu_link').val();
			
			$('#process_div'+pgsec_sqlid).css('display','block');
				$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/Page_single_product/single_productsortby_section_down",
					data:{pgsec_sqlid:pgsec_sqlid,mnulinkid:menu_id},
					success: function (data) {						
						
						$('#section_div').html(data);
						$('#process_div'+pgsec_sqlid).css('display','none');
						//window.location.reload(true);
					}
				});	
}

function singleprodsortby_section_totopajx(pgsec_sqlid)
{
	var menu_id=$('#menu_link').val();
			
			$('#process_div'+pgsec_sqlid).css('display','block');
				$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/Page_single_product/single_productsortby_section_totop",
					data:{pgsec_sqlid:pgsec_sqlid,mnulinkid:menu_id},
					success: function (data) {						
						
						$('#section_div').html(data);
						$('#process_div'+pgsec_sqlid).css('display','none');
						//window.location.reload(true);
					}
				});	
}

function singleprodsortby_section_todownajx(pgsec_sqlid)
{
	var menu_id=$('#menu_link').val();
			
			$('#process_div'+pgsec_sqlid).css('display','block');
				$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/Page_single_product/single_productsortby_section_todown",
					data:{pgsec_sqlid:pgsec_sqlid,mnulinkid:menu_id},
					success: function (data) {						
						
						$('#section_div').html(data);
						$('#process_div'+pgsec_sqlid).css('display','none');
						//window.location.reload(true);
					}
				});	
}

</script>   


<script>
function valid_remove(sec_sqlid)
{  
	var conf=confirm('Do You want to Delete Section ? ');
	if(conf)
	{
		//window.location.href='<?php //echo base_url().'admin/page_single_product/remove_mobile_singleproduct_section/'?>'+sec_sqlid ;
		
		var menu_id=$('#menu_link').val();
			
			$('#process_div'+sec_sqlid).css('display','block');
				$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/Page_single_product/remove_mobile_singleproduct_section",
					data:{pgsec_sqlid:sec_sqlid,mnulinkid:menu_id},
					success: function (data) {						
						
						$('#section_div').html(data);
						$('#process_div'+sec_sqlid).css('display','none');
						//window.location.reload(true);
					}
				});	
	}
}

function change_section_status()
{
	if($('#sec_status').val()=="")
		{
			alert("select change status value");return false;	
		}
		var sec_ids = document.getElementsByName("chk_sec[]");
		var secid_count=sec_ids.length;
		
		var count=0;
		for (var i=0; i<secid_count; i++) {
			if (sec_ids[i].checked === true) 
			{
				count++;
			}
		}
		
		if(count==0)
		{
			alert('Please select atleast one record');
			return false;
		}
		else
		{
				var secsql_id = $('input[name="chk_sec[]"]:checked').map(function(_, el){
        		return $(el).val();
    			}).get();
		
			var secstatus=$('#sec_status').val();			
			var menu_id=$('#menu_link').val();
			$('#loader_div').css('display','block');
				$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/page_single_product/change_sec_status",
					data:{secsql_id:secsql_id,secstatus:secstatus,mnulinkid:menu_id},
					success: function (data) {
						$('#section_div').html(data);
						$('#loader_div').css('display','none');						
						//window.location.reload(true);
					}
				});
		}	
}

</script>


</body>
</html>