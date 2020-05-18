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
					<?php 
						require_once('codsetup_tabmenu.php');
					?>
					<div class="row gray_bg">
						
						<div class="col-md-10 mt20">
							
						<?php if($this->session->flashdata('msgcod_wtchrg')){ ?>	<div id="successfully_verify" style="color:#0C0;">
						<img src="<?php echo base_url().'images/success_icon.png' ?>">&nbsp<?php echo $this->session->flashdata('msgcod_wtchrg'); ?></div> <?php } ?>
                            
							<div class="tab-content">
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											<div class="right mb10">
												 <a id="product_submit" class='seller_buttons inline' href='#inline_content_addweighcharges'  > 
           <i class="fa fa-plus-square" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Add Charges 
           </a>
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
								<th width="10%">Weight</th>
								<th width="12%">Amount</th>
								<th width="6%">Action</th>
								
							</tr>
                            <?php
							if($codwtcharges->num_rows()>0)
							{ $sl=1;
							 foreach($codwtcharges->result_array() as $res_codwtcharges) {?>
                            <tr>  
                            <td><?=$sl?></td>
                            <td><?=$res_codwtcharges['wt_from'].'-'.$res_codwtcharges['wt_to'].' gm'?></td>
                            <td><?='Rs.'.$res_codwtcharges['wt_charge']?></td>
                            <td><a class='inline' href="#inline_content_edit_cour_fld" onClick="edit_wtchrgs('<?=$res_codwtcharges['cod_wtsqlid']?>','<?= $res_codwtcharges['wt_from']?>','<?=$res_codwtcharges['wt_to']?>','<?=$res_codwtcharges['wt_charge']?>')" title="Edit"><i class="fa fa-pencil-square-o" style="font-size:16px;"></i></a>							
                           <i class="fa fa-times" style="font-size:16px; cursor:pointer; color:#F00;" onClick="delete_codchargesaswtgh('<?=$res_codwtcharges['cod_wtsqlid']?>')"></i>
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
         	<h4 class="title sn">Add New Weight Charges </h4>
<div class="col-md-12">
<form action="<?php echo base_url().'admin/super_admin/add_codchargesasperweight' ?>" method="POST">
		<table class="edit_address_form">
            <tr>
                <td>Weight From(gm): </td>
                <td>
                
                <input type="number" class="text" size="32px" name="weight_from" id="weight_from" required></td>
            </tr>
            <tr>
                <td>Weight To(gm): </td>
                <td><input type="number" class="text" size="32px" name="weight_to" id="weight_to" required></td>
            </tr>
            <tr>
                <td>Charge Amount(Rs.): </td>
                <td><input type="number" class="text" size="32px" name="charge_amount" id="charge_amount" required></td>
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
         	<h4 class="title sn">Edit Weight Charges</h4>
<div class="col-md-12">
<form action="<?php echo base_url().'admin/super_admin/edit_codchargesasperweight' ?>" method="POST">
		<table class="edit_address_form">
            <tr>
                <td>Weight From(gm): </td>
                <td>
                <input type="hidden" class="text" size="32px" name="weight_sqlidedit" id="weight_sqlidedit" required>
                <input type="number" class="text" size="32px" name="weight_fromedit" id="weight_fromedit" required></td>
            </tr>
            <tr>
                <td>Weight To(gm): </td>
                <td><input type="number" class="text" size="32px" name="weight_toedit" id="weight_toedit" required></td>
            </tr>
            <tr>
                <td>Charge Amount(Rs.): </td>
                <td><input type="number" class="text" size="32px" name="charge_amountedit" id="charge_amountedit" required></td>
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
function edit_wtchrgs(codwtsqlid,wthfrom,wthto,wthamount)
{
	
	$('#inline_content_edit_attr_fld').css('display','block');
	
	document.getElementById('weight_sqlidedit').value=codwtsqlid;
	document.getElementById('weight_fromedit').value=wthfrom;
	document.getElementById('weight_toedit').value=wthto;
	document.getElementById('charge_amountedit').value=wthamount;
	
}
function delete_codchargesaswtgh(delete_codchargesaswtgh)
{
	
	var conf=confirm('Do You want to Delete ?');
	$('#loader_div').css('display','block');

	if(conf)	
	{
		$.ajax({
		
			url:'<?php echo base_url().'admin/super_admin/delete_codchargesasperweight' ?>',
			method:'POST',
			data:{codsqlidwtchrg:delete_codchargesaswtgh},
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

	</body>
</html>