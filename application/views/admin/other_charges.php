<?php
require_once('header.php');
?>
<style>
.wrapper {
  background: #ececec;
  font-family: "Gill Sans", Impact, sans-serif;
  /*position: relative;*/
  text-align: center;
  width: 0px;
  float: right;
  right: 55px;
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
  width: 275px;
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
.wrapper{left:5px; top:5px; position:relative;}
</style>

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
                	<!--<form onSubmit="return membershipInfo()">-->
					<div class="row content-header">
						<div class="col-md-8"><b>Charges</b></div>
						<div class="col-md-4 show_report">
							<!--<button type="reset" class="all_buttons">Reset</button>
							<button type="submit" class="all_buttons">Save</button>-->
						</div>
					</div>
					<div class="form_view">
						<h3>Set Charges</h3>
							<table style="width:70% !important;">
								<tr>
									<td colspan="2">
                                    	<?php 
										$attributes = array('class' => 'charges_form');
										echo form_open('admin/super_admin/get_fixed_charges',$attributes);
										?>
                                        <fieldset>
                                            <legend>Fixed Charges<div class="wrapper"><i class="fa fa-question-circle"></i><div class="tooltip">Amount or Percentage of Product Selling Price</div></div></legend>
                                            
                                            <input type="radio" name="fixed_charges_type" value="rupees">
                                            Amount : <input type="text" class="text2 chg" name="amt_fixedcharges" id="amt_fixedcharges">&nbsp;&nbsp;
                                            <input type="radio" name="fixed_charges_type" value="percent">
                                            Percent : <input type="text" class="text2 chg" name="per_fixedcharges" id="per_fixedcharges">&nbsp;%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php
											if($fixed_chrgs_result[0]->percent){
												echo '<strong style="color:#885c0b">'.$fixed_chrgs_result[0]->percent. ' %</strong>';
											}else{
												echo '<strong style="color:#885c0b">Rs.'. $fixed_chrgs_result[0]->amount.'</strong>';
											}
											?>
                                            <input type="submit" name="submit" class="crg_btn" value="submit">
                                         </fieldset>
                                         <span><?= $this->session->flashdata('fixed_chargs_succ_msg'); ?></span>
                                         <?php echo form_close();?>
                                         
                                        <?php
										$attributes = array('class' => 'charges_form');
										echo form_open('admin/super_admin/get_pg_charges',$attributes);
										?>
                                          <fieldset>
                                            <legend>Payment gateway Charges<div class="wrapper"><i class="fa fa-question-circle"></i><div class="tooltip">Percentage Product of Selling Price</div></div></legend>
                                            
                                            <input type="text" class="text2 chg" name="pgcharges" id="pgcharges">&nbsp;%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php
											echo '<strong style="color:#885c0b">'.$pg_chrgs_result[0]->percent. ' %</strong>';
											?>
                                            <input type="submit" name="submit" class="crg_btn" value="submit">
                                         </fieldset>
                                         <span><?= $this->session->flashdata('pg_chargs_succ_msg'); ?></span>
                                         <?php echo form_close();?>
                                         
                                        <?php
										$attributes = array('class' => 'charges_form');
										echo form_open('admin/super_admin/get_seasonal_charges',$attributes);
										?>
                                         <fieldset>
                                            <legend>Seasonal Charges<div class="wrapper"><i class="fa fa-question-circle"></i><div class="tooltip">Amount or Percentage of Product Selling Price</div></div></legend>
                                            
                                            <input type="radio" name="seasonal_charges_type" value="rupees">
                                            	Amount : <input type="text" class="text2 chg" name="amt_season_charges" id="amt_fixedcharges1">&nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="seasonal_charges_type" value="percent">
                                        		Percent : <input type="text" class="text2 chg" name="per_season_charges" id="per_fixedcharges1">&nbsp;%&nbsp;&nbsp;&nbsp;
                                        		From Date<input type="text" id="datepicker-example7-start" class="text2 dt" name="from_dt">
                                        		To Date<input type="text" id="datepicker-example7-end" class="text2 dt" name="to_dt">&nbsp;&nbsp;
                                                <input type="checkbox" name="include_sts" value="fix_include">&nbsp;&nbsp;Including Fix Charges&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>
                                                
                                                <?php
												if($season_chrgs_result[0]->percent){
													echo '<strong style="color:#885c0b">'.$season_chrgs_result[0]->percent. ' %</strong>';
												}else{
													echo '<strong style="color:#885c0b">Rs.'. $season_chrgs_result[0]->amount.'</strong>';
												}
												?>
                                                , &nbsp;&nbsp;&nbsp;&nbsp;
                                                From Date : <?='<strong style="color:#885c0b">'.$season_chrgs_result[0]->from_dt. ' </strong>';?>
                                               , &nbsp;&nbsp;&nbsp;&nbsp;
                                                To Date : <?='<strong style="color:#885c0b">'.$season_chrgs_result[0]->to_date. ' </strong>';?>
                                                , &nbsp;&nbsp;&nbsp;&nbsp;
                                                <?php
												if($season_chrgs_result[0]->status == 'fix_include'){
													echo '<strong style="color:#885c0b">Including Fixed Charges</strong>';
												}else{
													echo '<strong style="color:#885c0b">Excluding Fixed Charges</strong>';
												}
												?>
                                                <input type="submit" name="submit" value="submit" class="crg_btn">&nbsp;&nbsp;
                                         </fieldset>
                                         <span><?= $this->session->flashdata('season_chargs_succ_msg'); ?></span>
                                         <?php echo form_close();?>
                                         
                                         <fieldset>
                                            <legend>Penalty Charges<div class="wrapper"><i class="fa fa-question-circle"></i><div class="tooltip">Percentage of Total deducted Amount .<br/>( commission + fixed charges + P.G charges + seasonal charges + service tax )</div></div></legend>
                                             	<?php
												$attributes = array('class' => 'charges_form');
												echo form_open('admin/super_admin/cancel_penalty_charges',$attributes);
												?>
                                            	Order Cancel : <input type="text" class="text2 chg" name="order_cancel" id="order_cancel" > &nbsp;%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <?php
												if($ordr_cancel_penlty_result[0]->percent){
													echo '<strong style="color:#885c0b">'.$ordr_cancel_penlty_result[0]->percent. ' %</strong>';
												}else{
													echo '<strong style="color:#885c0b">Rs.'. $ordr_cancel_penlty_result[0]->amount.'</strong>';
												}
												?>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="submit" name="submit" class="crg_btn" value="submit"><br/><br/>
                                                <span><?= $this->session->flashdata('cancel_chargs_succ_msg'); ?></span>
                                         		<?php echo form_close();?>
                                                
                                                <?php
												$attributes = array('class' => 'charges_form');
												echo form_open('admin/super_admin/order_not_process_penalty_charges',$attributes);
												?>
                                        		Order not process : <input type="text" class="text2 chg" name="order_not_process" id="order_not_process">&nbsp;%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                 <?php
												if($ordr_notprocess_penlty_result[0]->percent){
													echo '<strong style="color:#885c0b">'.$ordr_notprocess_penlty_result[0]->percent. ' %</strong>';
												}else{
													echo '<strong style="color:#885c0b">Rs.'. $ordr_notprocess_penlty_result[0]->amount.'</strong>';
												}
												?>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="submit" name="submit" class="crg_btn" value="submit"><br/><br/>
                                                <span><?= $this->session->flashdata('not_process_chargs_succ_msg'); ?></span>
                                         		<?php echo form_close();?>
                                                
                                                <?php
												$attributes = array('class' => 'charges_form');
												echo form_open('admin/super_admin/ship_delay_penalty_charges',$attributes);
												?>
                                        		Delay in order Shippment : <input type="text" class="text2 chg" name="order_ship_delay" id="order_ship_delay">&nbsp;%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                 <?php
												if($ordr_shpngdely_penlty_result[0]->percent){
													echo '<strong style="color:#885c0b">'.$ordr_shpngdely_penlty_result[0]->percent. ' %</strong>';
												}else{
													echo '<strong style="color:#885c0b">Rs.'. $ordr_shpngdely_penlty_result[0]->amount.'</strong>';
												}
												?>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="submit" name="submit" class="crg_btn" value="submit">
                                                <span><?= $this->session->flashdata('ship_delay_chargs_succ_msg'); ?></span>
                                         		<?php echo form_close();?>
                                         </fieldset>
                                    </td>
								</tr>
                                <!--<tr>
									<td colspan="2" align="center"> <input type="submit" name="submit" value="submit" class="btn-warning lsav3"> </td>
								</tr>-->
							</table>
                        </div>
                        
                        <!--<div class="form_view" style="margin-top:10px !important;"> 
                            <h3>Set Seasonal Charges</h3>
							<table style="width:70% !important;">
                            	<tr>
									<td> Seasonal Charges </td>
									<td>
                                    	Amount : <input type="text" class="text2 chg" name="amt_fixedcharges" id="amt_fixedcharges1">&nbsp;&nbsp;&nbsp;
                                        Percent : <input type="text" class="text2 chg" name="per_fixedcharges" id="per_fixedcharges1">&nbsp;%
                                    </td>
								</tr>
                            	<tr>
									<td> Date </td>
									<td>
                                    	From <input type="text" id="datepicker-example7-start" class="text2 dt" name="from_dt">
                                        To <input type="text" id="datepicker-example7-end" class="text2 dt" name="to_dt">
                                    </td>
								</tr>
								<tr>
									<td style="width:20%;"> Fixed Charges </td>
									<td>
                                    	Amount : <input type="text" class="text2 chg" name="amt_fixedcharges" id="amt_fixedcharges1">&nbsp;&nbsp;&nbsp;
                                        Percent : <input type="text" class="text2 chg" name="per_fixedcharges" id="per_fixedcharges1">&nbsp;%
                                    </td>
								</tr>
                                 <tr>
									<td colspan="2" align="center"> <input type="submit" name="submit" value="submit" class="btn-warning lsav3"> </td>
								</tr>
							</table>
                            
					</div>-->
                  
                    
                    
                    <!--<form action='<?php// echo base_url().'admin/Seller_penalty/insert_penalty_data' ?>' method='post' onSubmit="return valid_user_role()">
               
                       
				
                    <div id='show_error' align="center" style="color:#F00;"> </div>
					<div id="ss" ></div>
						<h3>Penalty Charges </h3>
							<table>
                            <tr>
									<td style="width:20%;">Order Cancel  </td>
									<td><input type="text" class="text2 chg" name="order_cancel" id="order_cancel" > &nbsp;%</td>
								</tr> <tr>
									<td style="width:20%;">Order not process  </td>
									<td><input type="text" class="text2 chg" name="order_not_process" id="order_not_process">&nbsp;%</td>
								</tr>
								<tr>
									<td style="width:20%;">Delay in order Shippment </td>
									<td><input type="text" class="text2 chg" name="order_ship_delay" id="order_ship_delay">&nbsp;%</td>
								</tr>
                                <tr><td colspan="2" align="center">
                                
							<input type="submit" class="btn-warning lsav3" value="Submit"  >
                                </td></tr>
                           
								</table>
                </form>-->
                    
                    
				</div><!--   End of Main-content  -->
		</div><!-- @end #content -->


<style>
.dt {
    width: 150px;
}
.Zebra_DatePicker_Icon{left: 130px !important;}
.Zebra_DatePicker{ z-index:9999;}
</style>
 
<!--- Zebra_Datepicker link start here ---->
<!--<script src="<?php// echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/jquery-1.11.1.js"></script>-->
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/examples/public/javascript/core1.js"></script>
<script src="<?php echo base_url(); ?>Zebra_Datepicker-master/public/javascript/zebra_datepicker.js"></script>
<link href="<?php echo base_url(); ?>Zebra_Datepicker-master/public/css/default.css" rel="stylesheet">
<!--<link href="<?php// echo base_url(); ?>Zebra_Datepicker-master/examples/public/css/style.css" rel="stylesheet">-->
<!--- Zebra_Datepicker link end here ---->

        
<script>
function chargesinfo(){
	var charges = $('#fixedcharges').val();
	var pgcharges = $('#pgcharges').val();
	return false;
	/*var mdesc = $('#mdesc').val();
	var memb_pln_typ = $('#memb_pln_typ').val();
	if(name == ''){
		alert('Membership name is required.');
		$('#mname').focus();
		return false;
	}else if(cost == ''){
		alert('Membership cost is required.');
		$('#mcost').focus();
		return false;
	}else if(isNaN(cost)){
		alert('Invalid cost amount');
		$('#mcost').select();
		return false;
	}else if(memb_pln_typ == ''){
		alert('Membership plan type is required.');
		return false;
	}*/
}
</script>

<script>
//script start for fixed charges //
$(document).ready(function(){
	$('#per_fixedcharges').prop('disabled', true);
	$('#amt_fixedcharges').prop('disabled', true);
	$(":radio[name='fixed_charges_type']").click(function(){
		var type = $("input[name=fixed_charges_type]:checked").val();
		if(type == 'rupees'){
			$('#per_fixedcharges').prop('disabled', true);
			$('#amt_fixedcharges').prop('disabled', false);
		}
		if(type == 'percent'){
			$('#amt_fixedcharges').prop('disabled', true);
			$('#per_fixedcharges').prop('disabled', false);
		}
	});
});
//script end of fixed charges //

//script start for Seasonal charges //
$(document).ready(function(){
	$('#per_fixedcharges1').prop('disabled', true);
	$('#amt_fixedcharges1').prop('disabled', true);
	$(":radio[name='seasonal_charges_type']").click(function(){
		var type = $("input[name=seasonal_charges_type]:checked").val();
		if(type == 'rupees'){
			$('#per_fixedcharges1').prop('disabled', true);
			$('#amt_fixedcharges1').prop('disabled', false);
		}
		if(type == 'percent'){
			$('#amt_fixedcharges1').prop('disabled', true);
			$('#per_fixedcharges1').prop('disabled', false);
		}
	});
});
//script end of Seasonal charges //
</script>

<?php
require_once('footer.php');
?>	