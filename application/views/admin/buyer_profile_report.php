<?php
require_once('header.php');
?>	


<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
<style>
.Zebra_DatePicker_Icon{left:63px !important; top: 6px !important;}
.wrapper {
  font-family: "Gill Sans", Impact, sans-serif;
  /*position: relative;*/
  text-align: center;
  float: right; position:relative;
  cursor: default;
  -webkit-transform: translateZ(0); /* webkit flicker fix */
  -webkit-font-smoothing: antialiased; /* webkit text rendering fix */
}
.wrapper .tooltip {
  background: #1496bb;
  bottom: 0;
  color: #fff;
  display: block;
  left: 30px;
  margin-bottom: 0px;
  opacity: 0;
  padding: 10px;
  pointer-events: none;
  position: absolute;
  width: 300px;
  -webkit-transform: translateY(10px);
     -moz-transform: translateY(10px);
      -ms-transform: translateY(10px);
       -o-transform: translateY(10px);
          transform: translateY(10px);
  -webkit-transition: all .25s ease-out;
     -moz-transition: all .25s ease-out;
      -ms-transition: all .25s ease-out;
       -o-transition: all .25s ease-out;
          transition: all .25s ease-out;
  -webkit-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
     -moz-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
      -ms-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
       -o-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
          box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
}

/* This bridges the gap so you can mouse into the tooltip without it disappearing */
.wrapper .tooltip:before {
  bottom: -20px;
  content: " ";
  display: block;
  height: 20px;
  left: 0;
  position: absolute;
  width: 100%;
}

/* CSS Triangles - see Trevor's post */
.wrapper .tooltip:after {
  border-left: solid transparent 10px;
  border-right: solid #1496bb 10px;
  border-top: solid transparent 10px;
  border-bottom: solid transparent 10px;
  bottom: 7px;
  content: " ";
  height: 0;
  left: -7px;
  margin-left: -13px;
  position: absolute;
  width: 0;
}
  
.wrapper:hover .tooltip {
  opacity: 1;
  pointer-events: auto;
  -webkit-transform: translateY(0px);
     -moz-transform: translateY(0px);
      -ms-transform: translateY(0px);
       -o-transform: translateY(0px);
          transform: translateY(0px);
}

/* IE can just show/hide with no transition */
.lte8 .wrapper .tooltip {
  display: none;
}

.lte8 .wrapper:hover .tooltip {
  display: block;
}
.fa-question-circle {
  font-size: 15px;
}

/*.wrapper{left:5px; top:5px; position:relative;}*/

</style>
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
					<div class="col-md-8"> <h3>Buyer Profile</h3>
                    <button id="product_submit" class="seller_buttons" onClick="window.location.href='<?php echo base_url().'admin/payment/buyrprfl_excel_report/'.$start?>'" > 
           <i class="fa fa-file-excel-o" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Export To Excel Buyer Profile Report 
           </button></div>
                    </div>
						<form action="<?php echo base_url().'admin/payment/filter_buyerprofile' ?>" method="post" >
						<div class="col-md-6 right show_report">
							<input type="submit" class="all_buttons" value="Search" >
							<input type="reset" class="all_buttons" value="Reset Filter">
						</div>
						<div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>
				    <div  class="col-md-6 left">	
                        <table class="multi_action">
							<tr>
                            	<td></td>
							</tr>
						</table>
					</div>	
					<div class="clearfix"></div>
					<div class="table-responsive">
                    
						<table class="table table-bordered table-hover">
                        	<!--<tr>
                        	<?php// if($status){ ?>
                            	<td colspan="7">Filtered Data  as  Order Status : <strong><?//=$status; ?></strong></td>
                            <?php// }else if($seller_name){?>
                            	<td colspan="7">Filtered Data  as  Seller : <strong><?//=$seller_name; ?></strong></td>
                            <?php// }?>
                            </tr>-->
							<tr class="table_th">
								<th width="5%">SL NO.</th>
                               <th width="10%">Buyer Name</th>
                                <th width="10%">Registered Date</th>
								<th width="10%">Gender</th>
								<th width="10%">Mob. No.</th>
								<th width="10%">Email</th>
								<th width="10%">Country</th>
                                <th width="10%">State</th>
                                <th width="10%">Street Address</th>
                                <th width="10%">City</th>
                                <th width="10%">Pincode</th>
								<th width="10%">Buyer Status</th>
								
							</tr>
							<tr class="filter_tr">
							<td></td>
                            <td>
									<input type="text" name="byrnm" id="byrnm" >
								</td>
								<td>
									<input type="text" name="regd_dt" id="datepicker-example7-start" >
								</td>
								<td>
                                	<select name="gender" id="gender">
										<option value="">--select--</option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
                                </td>
								<td>
									<input type="text" name="mob" id="mob" >
								</td>
								<td>
								<input type="text" name="email" id="email">
								</td>
                                <td>
									<input type="text" name="country" id="country" >
								</td>
                                <td>
									<input type="text" name="state" id="state" >
								</td>
                                <td>
									<input type="text" name="st_address" id="st_address" >
								</td>
                                <td><input type="text" name="city" id="city" ></td>
								<td>
									<!--<input type="text" name="pin" id="pin" >-->
								</td>
								
                                <td>
                                	<select name="status" id="status">
										<option value="">--select--</option>
										<option value="Active">Active</option>
										<option value="Inactive">Inactive</option>
									</select>
                                </td>
                                
								</tr>
                            <?php
						    if($byrprfl_report->num_rows()>0){	
								$sl=0;					
								foreach($byrprfl_report->result() as $report_row){
								
								$sl++;
								?>
                            <tr>
                            	<td><?php echo $sl;?></td>
                                <td> <?php echo $report_row->full_name;?></td>
                                <td> <?php $registration_date=substr($report_row->registration_date,0,10); 
										echo date('d-M-Y',strtotime($registration_date));?></td>
                                <td> <?php echo $report_row->gendr; ?></td>
                                <td> <?php echo $report_row->mob;?></td>
                                <td> <?php echo $report_row->email;?></td>
                                 <td><?php echo $report_row->country;?></td>
                                 <td> <?php echo $report_row->state;?></td>
                                 <td> <div class="wrapper"><i style="font-size:16px;" class="fa fa-eye" title="view address"></i><div class="tooltip"><?php echo $report_row->address;?> </div></div><?php echo substr($report_row->address,0,18)."...";?></td>
                                <td> <?php echo $report_row->city;?></td>
                                <td><?php echo $report_row->pin_code;?></td>
                                <td> <?php echo $report_row->status;?></td>
                               
                            </tr>
                            <?php }
							 }
							else{?>
                             <tr>
                            	<td colspan="14">No Record Found.</td>
                            </tr>
                            <?php }?>
						</table>
					</div>
                    </form>
                    <!--<?php// echo form_close(); ?>-->
				</div>
        
        	
	</div><!-- @end #content -->


<script>
function validFilter(){
	var seller_name = $('#fltr_seller').val();
	var status = $('#order_status').val();
	if(seller_name!='' && status!=''){
		alert('You should filtered data only one field in a time.');
		$('#filter_form').trigger("reset");
		return false;
	}
}
</script>
<?php
require_once('footer.php');
?>	