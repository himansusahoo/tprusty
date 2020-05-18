<?php
require_once('header.php');
?>	
<style>
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
					<div class="col-md-8"> <h3>Buyer Report</h3>
                    <button id="product_submit" class="seller_buttons" onclick="window.location.href='<?php echo base_url().'admin/report/export_buyrreport/'.$start?>'" > 
           <i class="fa fa-file-excel-o" aria-hidden="true" style="color:#FFF;"></i> &nbsp;Export To Excel Buyer Report 
           </button></div>
                    </div>
					
						<form action="<?php echo base_url().'admin/report/filter_buyer' ?>" method="post" >
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
					<div>
						<table class="table table-bordered table-hover">
                        	<!--<tr>
                        	<?php// if($status){ ?>
                            	<td colspan="7">Filtered Data  as  Order Status : <strong><?//=$status; ?></strong></td>
                            <?php// }else if($seller_name){?>
                            	<td colspan="7">Filtered Data  as  Seller : <strong><?//=$seller_name; ?></strong></td>
                            <?php// }?>
                            </tr>-->
							<tr class="table_th">
								<th width="5%">User ID</th>
                                <th width="8%">Name</th>
								<th width="8%">Email</th>
								<th width="8%">Phone Number</th>
								<th width="8%">Address</th>
								<th width="8%">Total Ordered</th>
                                <th width="8%">Total Returned</th>
                                <th width="8%">Total Cancel</th>
                                <th width="8%">Total Replacement</th>
								
							</tr>
							<tr class="filter_tr">
							<td></td>
								<td>
									<input type="text" name="name" id="name" >
								</td>
								<td>
                                
									<input type="text" name="email" id="email" >
								</td>
								<td>
									<input type="number" name="phno" id="phno" >
								</td>
                                <td>
									<input type="text" name="address" id="address" >
								</td>
                                <td>
									<!--<input type="text" name="totl_order" id="totl_order" >-->
								</td>
                                <td>
									<!--<input type="text" name="totl_retn" id="totl_retn" >-->
								</td>
                                <td>
									<!--<input type="text" name="totl_cacl" id="totl_cacl" >-->
								</td>
                                <td>
									<!--<input type="text" name="totl_rplce" id="totl_rplce" >-->
								</td>
								                            
								
							</tr>
                            <?php
						    if($buyer_report->num_rows()>0){
								foreach($buyer_report->result() as $report_row){
								
								
								?>
                            <tr>
                            	<td><?php echo $report_row->user_id;?></td>
                                <td> <?php echo $report_row->full_name;?></td>
                                <td> <?php echo $report_row->email; ?></td>
                                <td> <?php echo $report_row->mob;?></td>
                                <td><div class="wrapper"><i style="font-size:16px;" class="fa fa-eye" title="view address"></i><div class="tooltip"><?php echo $report_row->address;?> </div></div><?php echo substr($report_row->address, 0, 18)." ...";?>
                                </td>
                                <td> <?php echo $report_row->totl_order;?></td>
                                <td>
                                <?php
								$user_id= $report_row->user_id;
								$query = $this->db->query("SELECT * FROM `ordered_product_from_addtocart` WHERE product_order_status='Return Received' AND user_id='$user_id' GROUP BY user_id");
								if($query->num_rows()>0)
								{
									echo $query->num_rows();
								}
								else
								{
									echo '0';
								}
								?>
                                </td>
                                <td><?php
								$query = $this->db->query("SELECT * FROM `ordered_product_from_addtocart` WHERE product_order_status='Failed' AND user_id='$user_id' GROUP BY user_id");
								if($query->num_rows()>0)
								{
									echo $query->num_rows();
								}
								else
								{
									echo '0';
								}
								?></td>
                                <td>
                                <?php $query = $this->db->query("SELECT a.order_id
									FROM ordered_product_from_addtocart a
									INNER JOIN order_status_log b ON a.order_id = b.order_id
									WHERE a.user_id='$user_id' AND b.return_received_date!='0000-00-00 00:00:00' AND a.product_order_status='Delivered' ");
								if($query->num_rows()>0)
								{
									echo $query->num_rows();
								}
								else
								{
									echo '0';
								}
								?>
                                
                                                              
                                </td>
								
                                
									
                            </tr>
                            <?php }
							 }
							else{?>
                             <tr>
                            	<td colspan="9">No Record Found.</td>
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