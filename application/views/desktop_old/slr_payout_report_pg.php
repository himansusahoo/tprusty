<?php
require_once('header.php');
?>		

			<div id="content">
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_reports.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
					<div class="row content-header">
					<div class="col-md-8"> <h3>Seller Payout</h3></div>
                    <!--<form action="<?php// echo base_url().'admin/payment/update_utr_no';?>" method="post" >-->
                    
                    <form action="<?php echo base_url().'admin/payment/seller_all_payout_datewise';?>" method="post">
					<div class="col-md-4 show_report">
                    <!--<button type="submit" class="all_buttons">Update UTR NO.</button>-->
                   
                     </div>
                
					</div>
                    
                    <div class="col-md-6">
                         Select Date : <input type="text" id="datepicker" name="srch_dt">
                         <input type="submit" value="Search" id="dt_sch_btn" class="all_buttons" style="float:none; margin-bottom:10px;">
					</div>
                    </form>
                    
                    <form action="<?php //echo base_url().'admin/payment/update_utr_no';?>" method="post" >
				    <div class="col-md-6 left">
                        <table class="multi_action">
							<tr>
								<td>
                                     <!--<div class="right">
                                       <input type="button" class="all_buttons" value="Search" id="search" />
                                        <input type="reset" class="all_buttons" value="Reset Filter"/>
                                    </div>-->
								</td>
							</tr>
						</table>
                        <!--<button type="submit" class="all_buttons" style="float:right;">Update UTR NO.</button>-->
					</div>
					<div class="clearfix"></div>
					<div>
						<table class="table table-bordered table-hover">
							<tr class="table_th">
                            	<th>Pay Out Gen. Date</th>
								<th>Seller Name</th>
								<th>Seller ID</th>
								<th>No of Orders</th>
								<th>Final stl Amt</th>
								<th>Accnt. No</th>
								<th>Bank Name</th>
								<th>IFSC Code</th>
								<th>Accnt. Holder Name</th>
								<th>UTR No.</th>
                                <th>Status</th>
							</tr>
							<tr class="filter_tr">
								<td></td>
								<td></td>
                                <td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
                                <td></td>
								<td></td>
								<td></td>
                                <td></td>
							</tr>
                            <?php
							$slr_payout_row = $slr_payout_result->num_rows();
							if($slr_payout_row > 0){
								$sl=0;
							 foreach($slr_payout_result->result() as $rows){
								 $sl++; 
							?>
                            <tr>
                            	<td><?=$rows->pyt_generated_dt;?></td>
								<td>
                                	<input type="hidden" name="hidden_id[]" value="<?=$rows->id;?>">
									<?=$rows->business_name;?>
                                </td>
								<td><?=$rows->seller_id;?></td>
                                <td><?=$rows->no_of_orders;?></td>
								<td><?=$rows->fnl_stl_amt;?></td>
								<td><?=$rows->bnk_acnt_no;?></td>
								<td><?=$rows->bnk_name;?></td>
								<td><?=$rows->bnk_ifsc_code;?></td>
                                <td><?=$rows->acnt_hldr_name;?></td>
								<td width="10%"><?=$rows->utr_no;?>
                                <?php /*?><?php if($rows->utr_no == ''){ ?>
									<input type="text" name="utr_no[]" class="text">
                                <?php }else{ ?>
                                	<?=$rows->utr_no;?>
                                    <input type="text" name="utr_no[]" class="text" style="display:none">
                                <?php }?><?php */?>
                                </td>
                                <td width="10%"><?=$rows->status;?></td>
							</tr>
                            <?php } }else{?>
                            <tr>
                            	<td colspan="10">No Records Found.</td>
                            </tr>
                            <?php }?>
						</table>
					</div>
                 </form>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->    


<style>
.Zebra_DatePicker_Icon{left: 134px !important; top: 6px !important;}
.Zebra_DatePicker{ margin-top: 10px; z-index: 9999 !important;}
</style>
<!--- Zebra_Datepicker link start here ---->
<!--<script src="<?php// echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script>-->
<!--<script src="<?php// echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core.js"></script>
<script src="<?php// echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php// echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
--><!--<link href="<?php// echo base_url(); ?>Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">-->
<!--- Zebra_Datepicker link end here ---->


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

<?php
require_once('footer.php');
?>			