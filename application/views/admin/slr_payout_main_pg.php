<?php
require_once('header.php');
?>		

			<div id="content">
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_payment.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
					<div class="row content-header">
					<div class="col-md-8"> <h3>Seller Payout</h3></div>
                    <!--<form action="<?php// echo base_url().'admin/payment/update_utr_no';?>" method="post" >-->
                    
                    <form action="<?php echo base_url().'admin/payment/seller_payout_datewise';?>" method="post" >
					<div class="col-md-4 show_report">
                    <button type="submit" class="all_buttons">Update UTR NO.</button>
                     </div>
                
					</div>
                    
                    
                    <div class="col-md-6">	
                        <!-- <input type="submit" class="all_buttons" name="payout_generate" value="Generate Payout" style="float:left !important;">
                         <input type="button" class="all_buttons" name="export_excl" value="Export To Excel" onClick="exportPayoutReport()" style="float:left !important;">-->
                         
                         Select Date : <input type="text" id="datepicker-example1" name="srch_dt">
                         <input type="submit" value="Search" id="dt_sch_btn" class="all_buttons"  action="<?php echo base_url(); ?>" style="float:none; margin-bottom:10px;">
                        
					</div>
                    
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
					</div>
					<div class="clearfix"></div>
					<div>
						
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
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
<!--<link href="<?php// echo base_url(); ?>Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">-->
<!--- Zebra_Datepicker link end here ---->


<script>
/*$(document).ready(function(){
	$('#dt_sch_btn').click(function(){
		
	});
});*/

/*$(document).ready(function(){
    $('.submit-buttons').click(function(){
		alert('hi');
       // $('form').attr('action',$(this).attr('action')).submit();
        return false;
    });

});​*/

function go_fun(action){
	
}
</script>

<?php
require_once('footer.php');
?>			