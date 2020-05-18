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
                
                <div class="row content-header">
						<div class="col-md-8"><h4><b>Desktop Page Design</b></h4><div id="ssmessg"></div></div>
						<!--<div class="col-md-4 show_report">
							<button type="reset" class="all_buttons">Reset</button>
							<button type="submit" class="all_buttons">Save</button>
						</div>-->
				</div>
                
                      
                <?php /*?><?php if($this->session->flashdata('flshmsg')){ ?>	<div id="successfully_verify" style="color:#0C0;" align="center">
						<img src="<?php echo base_url().'images/success_icon.png' ?>">&nbsp<?php echo $this->session->flashdata('flshmsg'); ?>
                        </div> 
						<?php } ?><?php */?>
					<?php
						require_once('desktop_page_setuptabmenu.php');
					?>
					<div class="row gray_bg">						
						<div class="col-md-10 mt20">
							
						<?php //if($this->session->flashdata('msgcod_wtchrg')){ ?>	<!--<div id="successfully_verify" style="color:#0C0;">-->
						<img src="<?php //echo base_url().'images/success_icon.png' ?>">&nbsp<?php //echo $this->session->flashdata('msgcod_wtchrg'); ?></div> <?php //} ?>									<?php /*?><button id="product_submit" class='seller_buttons' style="background-color:#666;float:right;" onclick="window.location.href='<?php echo base_url().'admin/desktop_page_catlog/addnewsection_desktopcatlog'; ?>'" >
							<i class="fa fa-plus-square" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Add New Section 
           				</button> <?php */?>
                        
                         <a id="product_submit" class='seller_buttons add-new-sec' style="background-color:#666;float:right;" href="<?php echo base_url().'admin/desktop_page_catlog/addnewsection_desktopcatlog'; ?>" target="_blank">
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
                     
					 
						<!-----DIV Data Start----->
                        <!---------------------menu link start--------------------->
                        <div>
                           <span>
                           		 <?php 
								 $qr_section=$this->db->query("SELECT menu_id FROM 
								                       desktopsite_pagesectioninfo WHERE page_id='3' AND page_name='catalog' AND menu_id!=''  ");
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
                                        class="chosen-select" style="width:490px" id="menu_link"  tabindex="4">
                                        <option value=''>Select Third Level Menu Link</option>
                                            <?php
												 if($sel_catg->num_rows()>0)
													foreach($sel_catg->result_array() as $rw){																			
													$dskmenu_lbl_id=$rw['parent_id'];
													$qr_parent=$this->db->query("SELECT parent_id,label_name FROM 
													category_menu_mobile WHERE dskmenu_lbl_id='$dskmenu_lbl_id' ");
													$parent_lblname=$qr_parent->row()->label_name;
													
													$parent_dsklblbid=$qr_parent->row()->parent_id;
													
													$qr_mainparent=$this->db->query("SELECT label_name FROM 
													category_menu_mobile WHERE dskmenu_lbl_id='$parent_dsklblbid' ");
													$mainparent_lblname=$qr_mainparent->row()->label_name;
																										
												if(in_array($rw['dskmenu_lbl_id'],$menuid_arrfind)){	
												
												?>
                                               
													<option value="<?=$rw['dskmenu_lbl_id'];?>"><?=$mainparent_lblname.">>".$parent_lblname." >> ".$rw['label_name'];?></option>
                                                    
											<?php } } ?>
                                        </select>
                                    </span>
                               
                        	<input type="button" name="srch_pgdesing" id="srch_pgdesing" value="Search" onClick="srch_pgdesigninfo()">
                        
                         <div id="loader_div" style="display:none; text-align:center;"> <img src="<?php echo base_url().'images/loading1.gif' ?>" /> 
                       
                        </div>
                        </div>
                        <!---------------------menu link end--------------------->
                       
                        <div id="section_div">
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
		alert('Please select menu link');
		return false;	
	}
	else
	{
		$('#loader_div').css('display','block');
					$.ajax({
						method:"POST",
						url:"<?php echo base_url(); ?>admin/Desktop_page_catlog/populate_pagedesigninfo",
						data:{mnulinkid:mnulinkid},
						success: function (data) {
							$('#section_div').html(data);
							$('#loader_div').css('display','none');						
							//window.location.reload(true);
						}
			});
	}

}
</script>

<script>
function valid_remove(sec_sqlid)
{
	var conf=confirm('Do You want to Delete Section ? ');
	if(conf)
	{
		//window.location.href='<?php //echo base_url().'admin/Page_catlog/remove_mobilecatlogsection/'?>'+sec_sqlid ;
	
	
	
	var menu_id=$('#menu_link').val();
			
			$('#process_div'+sec_sqlid).css('display','block');
				$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/Desktop_page_catlog/remove_desktopcatlogsection",
					data:{sec_sqlid:sec_sqlid,mnulinkid:menu_id},
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
					url:"<?php echo base_url(); ?>admin/Desktop_page_catlog/change_sec_status",
					data:{secsql_id:secsql_id,secstatus:secstatus,mnulinkid:menu_id},
					success: function (data) {						
						
						$('#section_div').html(data);
						$('#loader_div').css('display','none');
						//window.location.reload(true);
					}
				});
		}	
}

function catlogsortby_section_upajx(pgsec_sqlid)
{
	var menu_id=$('#menu_link').val();
			
			$('#process_div'+pgsec_sqlid).css('display','block');
				$.ajax({
					method:"POST",
					url:"<?php echo base_url(); ?>admin/Desktop_page_catlog/catlogsortby_section_up",
					data:{pgsec_sqlid:pgsec_sqlid,mnulinkid:menu_id},
					success: function (data) {						
						
						$('#section_div').html(data);
						$('#process_div'+pgsec_sqlid).css('display','none');
						//window.location.reload(true);
					}
				});	
}


function catlogsortby_section_downajx(pgsec_sqlid)
{
	var menu_id=$('#menu_link').val();
	
	$('#process_div'+pgsec_sqlid).css('display','block');
		$.ajax({
			method:"POST",
			url:"<?php echo base_url(); ?>admin/Desktop_page_catlog/catlogsortby_section_down",
			data:{pgsec_sqlid:pgsec_sqlid,mnulinkid:menu_id},
			success: function (data) {						
				
				$('#section_div').html(data);
				//$('#loader_div').css('display','none');
				$('#process_div'+pgsec_sqlid).css('display','none');
				//window.location.reload(true);
			}
		});	
}

function catlogsortby_section_movetopajx(pgsec_sqlid)
{
	var menu_id=$('#menu_link').val();
	$('#process_div'+pgsec_sqlid).css('display','block');
		$.ajax({
			method:"POST",
			url:"<?php echo base_url(); ?>admin/Desktop_page_catlog/catalogsortby_section_totop",
			data:{pgsec_sqlid:pgsec_sqlid,mnulinkid:menu_id},
			success: function (data) {						
				
				$('#section_div').html(data);
				//$('#loader_div').css('display','none');
				$('#process_div'+pgsec_sqlid).css('display','none');
				//window.location.reload(true);
			}
		});	
}

function catlogsortby_section_movedownajx(pgsec_sqlid)
{
	var menu_id=$('#menu_link').val();
	$('#process_div'+pgsec_sqlid).css('display','block');
		$.ajax({
			method:"POST",
			url:"<?php echo base_url(); ?>admin/Desktop_page_catlog/catalogsortby_section_todown",
			data:{pgsec_sqlid:pgsec_sqlid,mnulinkid:menu_id},
			success: function (data) {						
				
				$('#section_div').html(data);
				//$('#loader_div').css('display','none');
				$('#process_div'+pgsec_sqlid).css('display','none');
				//window.location.reload(true);
			}
		});	
}

</script>


</body>
</html>