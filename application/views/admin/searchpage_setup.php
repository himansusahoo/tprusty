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
                
                <div class="row content-header">
						<div class="col-md-8"><h4><b>Mobile Page Design</b></h4><div id="ssmessg"></div></div>
						<!--<div class="col-md-4 show_report">
							<button type="reset" class="all_buttons">Reset</button>
							<button type="submit" class="all_buttons">Save</button>
						</div>-->
					</div>
                     <div id="loader_div" style="display:none; text-align:center;"> <img src="<?php echo base_url().'images/loading1.gif' ?>" /> 
                     </div>
                <?php if($this->session->flashdata('flshmsg')){ ?>	<div id="successfully_verify" style="color:#0C0;" align="center">
						<img src="<?php echo base_url().'images/success_icon.png' ?>">&nbsp<?php echo $this->session->flashdata('flshmsg'); ?></div> <?php } ?>
					<?php 
						require_once('mobilepage_setuptabmenu.php');
					?>
					<div class="row gray_bg">
						
						<div class="col-md-10 mt20">
							
						<?php /*?><?php //if($this->session->flashdata('msgcod_wtchrg')){ ?>	<!--<div id="successfully_verify" style="color:#0C0;">-->
						<img src="<?php //echo base_url().'images/success_icon.png' ?>">&nbsp<?php //echo $this->session->flashdata('msgcod_wtchrg'); ?></div> <?php //} ?>									<button id="product_submit" class='seller_buttons' style="background-color:#666;float:right;" onclick="window.location.href='<?php echo base_url().'admin/Page_search/addnewsection_formobilehomepage'; ?>'" > 
           											<i class="fa fa-plus-square" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Add New Section 
           										</button><?php */?>
                                                
                            <?php //if($this->session->flashdata('msgcod_wtchrg')){ ?>	<!--<div id="successfully_verify" style="color:#0C0;">-->
						<img src="<?php //echo base_url().'images/success_icon.png' ?>">&nbsp<?php //echo $this->session->flashdata('msgcod_wtchrg'); ?></div> <?php //} ?>		
                            <a id="product_submit" class='seller_buttons add-new-sec' style="background-color:#666;float:right;" href="<?php echo base_url().'admin/Page_search/addnewsection_mobilesearchpage'; ?>" target="_blank">
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
                      <div id="loader_div" style="display:none; text-align:center;"> <img src="<?php //echo base_url().'images/loading1.gif' ?>" /> 
                       
                        </div>
						<!-----DIV Data Start----->
                        
                        
                        <div id="section_div">
                        <table class="table table-bordered table-hover">
                        <tr ><td colspan="10" >Change Section Status
						<select id="sec_status" name="sec_status"  class="text2" style="width:200px; height:30px;" >
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
                                <th width="20%">Section Demo Screenshot</th>
								<th width="6%">Section type</th>
								<th width="5%">Section Data type </th>
								<th width="5%">Section Status</th>
								<th width="5%">Section Background Color</th>
								<th width="3%">Number Of Column</th>
                                <th width="12%">Sorting</th>
								<th width="10%">Action</th>
								
							</tr>
                            
                            <!--Data Display from page section table start-->
                            	<?php if($sec_data!=false)
								{   $sec_ctr=$sec_data->num_rows();
										if($sec_ctr>0){
											$sort_i=1;
											foreach($sec_data->result_array() as $res_secinfo){
								?>
                                	<tr id=tblrow<?=$res_secinfo['pgsection_sqlid']?>> 
                                     <td><input type="checkbox" id="chk_sec<?=$res_secinfo['pgsection_sqlid']?>" name="chk_sec[]" value="<?=$res_secinfo['pgsection_sqlid']?>"  onclick="select_tblrow('<?=$res_secinfo['pgsection_sqlid']?>')"></td>
                                     <td><?=$res_secinfo['Sec_id']?></td>
                                     
                                     <td> 
                                   <?php
								   if($res_secinfo['sec_type']!='New Arrivals' && $res_secinfo['sec_type']!='Trending Products' && $res_secinfo['sec_type']!='Recently Viewed Items'){	     
								   $sec_type=str_replace(' ','_',$res_secinfo['sec_type']);
								   $col_num=$res_secinfo['nos_column'];
								   $img_size=$res_secinfo['image_size'];
								   $qr=$this->db->query("SELECT ".$sec_type." as srcshot_imgname FROM pagedesign_imagesize WHERE display_type='mobile' AND page_nm='searchpage' AND culumns_count='$col_num' AND img_size='$img_size' ");								  
								   ?>
                                   <?php if($res_secinfo['sec_type']=='Prodcts Vertical section') {?>
                                   <img style="float:left;" src="<?php echo base_url().'images/admin/mobile/mobile_searchpage/product_vertical_section.png'; ?>" >									
                                   <?php } ?>
                                    <?php if($res_secinfo['sec_type']=='Video') {?>
                                   <img style="float:left;" src="<?php echo base_url().'images/admin/mobile/mobile_searchpage/video.png'; ?>" >								
                                   <?php } ?>
                                   
                                    <?php if($res_secinfo['sec_type']=='Product') {?>
                                   <img style="float:left;" src="<?php echo base_url().'images/admin/mobile/mobile_searchpage/proudct.png'; ?>" >								
                                   <?php } ?>
                                   
                                   <?php if($res_secinfo['sec_type']=='Rich Text Editor') {?>
                                   <img style="float:left;" src="<?php echo base_url().'images/admin/mobile/mobile_searchpage/Rich_texteditor.png'; ?>" >								
                                   <?php } ?>
                                   
                                   <?php  if($res_secinfo['sec_type']!='Prodcts Vertical section' && $res_secinfo['sec_type']!='Video' && $res_secinfo['sec_type']!='Product' && $res_secinfo['sec_type']!='Rich Text Editor' ){ ?>
                                   <img style="float:left;" src="<?php echo base_url().'images/admin/mobile/mobile_searchpage/'.$qr->row()->srcshot_imgname; ?>" >									<?php } ?>
                                   
								   <?php }else{ ?>
                                   <img style="float:left;" src="<?php echo base_url().'images/admin/mobile/mobile_searchpage/product_vertical_section.png' ?>" >									
                                   <?php } ?>
                                     </td>
                                      
                                     <td><?=$res_secinfo['sec_type']?></td>
                                     <td><?=$res_secinfo['sec_type_data']?></td>
                                     <td><?=$res_secinfo['Status']?></td> 
                                     <td style="background-color:<?=$res_secinfo['bg_color']?>;"></td> 
                                    <td><?=$res_secinfo['nos_column']?></td>
                                    <td>
                                    <?php if($res_secinfo['sec_type']!='Rich Text Editor') {?>
                                    
                                    <?php if($sort_i>1) {?>
                                    <img src='<?php echo base_url().'images/icon_finder/1495193298_Stock Index Up.ico' ?>' style="width:25px;height:29px;cursor:pointer;" onClick="window.location.href='<?php echo base_url().'admin/Page_search/searchpagesortby_section_up/'.$res_secinfo['pgsection_sqlid'] ?>' " > &nbsp;
									<span><a style="cursor: pointer; color:#333" onClick="window.location.href='<?php echo base_url().'admin/Page_search/searchpagesortby_section_up/'.$res_secinfo['pgsection_sqlid'] ?>' ">Up </a></span>
									<span style="float:right;"><a class="fa fa-angle-double-up" style="cursor: pointer; color:#333; font-size:20px;" title="Move To Top" onClick="window.location.href='<?php echo base_url().'admin/Page_search/searchpagesortby_section_movetop/'.$res_secinfo['pgsection_sqlid'] ?>' "></a></span>
									<?php } ?><br>
                                    <?php if($sort_i!=$sec_ctr){  ?>
                                    <img src='<?php echo base_url().'images/icon_finder/1495193373_Stock Index Down.ico' ?>' style="width:25px;height:29px;cursor:pointer;" onClick="window.location.href='<?php echo base_url().'admin/Page_search/searchpagesortby_section_down/'.$res_secinfo['pgsection_sqlid'] ?>' " >
									<span><a style="cursor: pointer; color:#333" onClick="window.location.href='<?php echo base_url().'admin/Page_search/searchpagesortby_section_down/'.$res_secinfo['pgsection_sqlid'] ?>' ">Down</a></span>&nbsp;&nbsp;
									<span style="float:right;"><a class="fa fa-angle-double-down" style="cursor: pointer; color:#333; font-size:20px;" title="Move To Buttom" onClick="window.location.href='<?php echo base_url().'admin/Page_search/searchpagesortby_section_movedown/'.$res_secinfo['pgsection_sqlid'] ?>' "> </a></span>
                                    <?php } ?>
                                    <?php } ?>
                                    </td>
                                    <td>
                                     <a href="<?php echo base_url().'admin/Page_search/edit_mobilesearchpagesection/'.$res_secinfo['pgsection_sqlid'] ?>" target="_blank">
                                        <img src='<?php echo base_url().'images/icon_finder/1495194794_edit-notes.ico' ?>' style="width:30px;height:25px;cursor:pointer;" >
                            		&nbsp;</a>
									<span><a style="cursor: pointer; color:#333;" href="<?php echo base_url().'admin/Page_search/edit_mobilesearchpagesection/'.$res_secinfo['pgsection_sqlid'] ?>" target="_blank">Edit </a></span><br>
                            <img src='<?php echo base_url().'images/icon_finder/1496144786_f-cross_256.ico' ?>' style="width:20px;height:20px;cursor:pointer"  onClick="valid_remove('<?=$res_secinfo['pgsection_sqlid']?>')" >
							&nbsp;
							<span><a style="cursor: pointer; color:#333;" onClick="valid_remove('<?=$res_secinfo['pgsection_sqlid']?>')">Delete </a></span><br>
                            </td>
                                    
                                    
                                    </tr>
                                
                                <?php 
										$sort_i++;	} // for llop end
										}
									} 
										
										?>	
                            
                            <!--Data Display from page section table end--->
                            
                        </table>
                        
                        
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



<!--- light box div end here --->                               
     <!--- light box div start here --->
<div style="display:none">
      <div id="inline_content_addweighcharges" style="padding:10px; background:#fff;">
      	<div class="edit_address_dv">
         	<h4 class="title sn">Add New Sizes </h4>
<div class="col-md-12">
<form action="<?php echo base_url().'admin/super_admin/add_sizes' ?>" method="POST">
		<table class="edit_address_form">
        <tr></tr>
            <tr>
                <td>Size Name: </td>
                <td>
                
                <input type="text" class="text" size="32px" name="size_name" id="size_name" autocomplete="off" required></td>
            </tr>
            
            <tr>
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
            
        </div>
      </div>
</div>
<!--- light box div end here ---> 



<!--- light box div start here --->
<div style="display:none">
      <div id="inline_content_edit_cour_fld" style="padding:10px; background:#fff;">
      	<div class="edit_address_dv">
         	<h4 class="title sn">Edit Size Name</h4>
<div class="col-md-12">
<form action="<?php echo base_url().'admin/super_admin/edit_sizes' ?>" method="POST">
		<table class="edit_address_form">
            <tr>
                <td>Size Name: </td>
                <td>
                <input type="hidden" class="text" size="32px" name="size_idedit" id="size_idedit" autocomplete="off" required>
                <input type="text" class="text" size="32px" name="size_name" id="size_names" autocomplete="off"required></td>
            </tr>
            
            <tr>
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
            
        </div>
      </div>
</div>
<!--- light box div end here --->    
<script>
function edit_wtchrgs(size_id,size_name)
{
	$('#inline_content_edit_attr_fld').css('display','block');
	
	document.getElementById('size_idedit').value=size_id;
	document.getElementById('size_names').value=size_name;
	
}
function delete_codchargesaswtgh(delete_sizes)
{
	
	var conf=confirm('Do You want to Delete ?');
	$('#loader_div').css('display','block');

	if(conf)	
	{
		$.ajax({
		
			url:'<?php echo base_url().'admin/super_admin/delete_sizes' ?>',
			method:'POST',
			data:{size_id:delete_sizes},
			success:function(data)
			{ 
			   window.location.reload(true);
			   $('#loader_div').css('display','none');
			   		
			}
		});
			
	}
	else
	{
		 $('#loader_div').css('display','none');
		return false;	
	}
}
</script>
<script>
function valid_remove(sec_sqlid)
{
	var conf=confirm('Do You want to Delete Section ? ');
	if(conf)
	{
		window.location.href='<?php echo base_url().'admin/Page_search/remove_mobilesearchpagesection/'?>'+sec_sqlid ;
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
			
			$('#loader_div').css('display','block');
				$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/Page_search/change_sec_status",
					data:{secsql_id:secsql_id,secstatus:secstatus},
					success: function (data) {
						//$("#ss").html(data);
						//if(data == 'success'){
							window.location.reload(true);
						//}
					}
				});
		}	
}

</script>

	</body>
</html>