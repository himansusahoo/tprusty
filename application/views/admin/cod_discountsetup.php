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
           <i class="fa fa-plus-square" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Add Discount 
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
								<th width="10%">Amount Range(Rs.)</th>								
                                <th width="12%">Discount Percentages</th>
								<th width="6%">Action</th>
								
							</tr>
                            <?php
							if($codwtcharges->num_rows()>0)
							{ $sl=1;
							 foreach($codwtcharges->result_array() as $res_codwtcharges) {?>
                            <tr>  
                            <td><?=$sl?></td>
                            <td><?='Rs.'.$res_codwtcharges['discount_from'].' -- Rs.'.$res_codwtcharges['discount_to']?></td>
                            <td><?=$res_codwtcharges['discount_percentage'].'%'?></td>
                            <td><a class='inline' href="#inline_content_edit_cour_fld" onClick="edit_discount('<?=$res_codwtcharges['cod_dissqlid']?>','<?= $res_codwtcharges['discount_from']?>','<?=$res_codwtcharges['discount_to']?>','<?=$res_codwtcharges['discount_percentage']?>')" title="Edit"><i class="fa fa-pencil-square-o" style="font-size:16px;"></i></a>							
                           <i class="fa fa-times" style="font-size:16px; cursor:pointer; color:#F00;" onClick="delete_coddiscount('<?=$res_codwtcharges['cod_dissqlid']?>')"></i>
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
         	<h4 class="title sn">Add Discount </h4>
<div class="col-md-12">
<form action="<?php echo base_url().'admin/super_admin/add_coddiscount' ?>" method="POST">
		<table class="edit_address_form">
            <tr>
                <td>Amount From(Rs.): </td>
                <td>
                
                <input type="number" class="text" size="32px" name="discount_from" id="discount_from" required></td>
            </tr>
            <tr>
                <td>Amount To(Rs.): </td>
                <td><input type="number" class="text" size="32px" name="discount_to" id="discount_to" required></td>
            </tr>
            <tr>
                <td>Discount Perccentages(%): </td>
                <td><input type="number" step="0.01" class="text" size="32px" name="discount_perc" id="discount_perc" required></td>
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
         	<h4 class="title sn">Edit Discount</h4>
<div class="col-md-12">
<form action="<?php echo base_url().'admin/super_admin/edit_coddiscount' ?>" method="POST">
		<table class="edit_address_form">
            <tr>
                <td>Amount From(Rs.): </td>
                <td>
                <input type="hidden" class="text" size="32px" name="editdiscountsqlid" id="editdiscountsqlid" required>
                <input type="number" class="text" size="32px" name="editdiscount_from" id="editdiscount_from" required></td>
            </tr>
            <tr>
                <td>Amount To(Rs.): </td>
                <td><input type="number" class="text" size="32px" name="editdiscount_to" id="editdiscount_to" required></td>
            </tr>
            <tr>
                <td>Discount Perccentages(%): </td>
                <td><input type="number" step="0.01" class="text" size="32px" name="editdiscount_perc" id="editdiscount_perc" required></td>
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
function edit_discount(coddiscountsqlid,discountfrom,discountto,discountpercn)
{
	
	$('#inline_content_edit_attr_fld').css('display','block');
	
	document.getElementById('editdiscountsqlid').value=coddiscountsqlid;
	document.getElementById('editdiscount_from').value=discountfrom;
	document.getElementById('editdiscount_to').value=discountto;
	document.getElementById('editdiscount_perc').value=discountpercn;
	
}
function delete_coddiscount(delete_coddissqlid)
{
	
	var conf=confirm('Do You want to Delete ?');
	$('#loader_div').css('display','block');

	if(conf)	
	{
		$.ajax({
		
			url:'<?php echo base_url().'admin/super_admin/delete_coddiscountpercentage' ?>',
			method:'POST',
			data:{coddissqlid:delete_coddissqlid},
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