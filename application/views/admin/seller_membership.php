<?php
require_once("header.php");
?>

<script>
	function addSellerMembership(){
		var base_url = '<?php echo base_url();?>';
		var controller = 'admin/sellers/';
		window.location.href = base_url+controller+'addsellermembershipaddform';
	}
</script>
			<div id="content">
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_sellers.php'; ?>
					</div>
					<div class="top-right">
						<?php include 'top_right.php'; ?>
					</div>
				</div>  <!-- @end top-bar  -->
				<div class="main-content">
					<div class="row content-header">
                    	<div class="col-md-8"><b> Seller Membership </b></div>
						<div class="col-md-4 show_report">
							<button type="button" class="all_buttons" onclick="addSellerMembership()">Add Seller Membership</button>
						</div>
					</div>
                    <div class="clearfix"></div>
					
					<div>
						<table class="table table-bordered table-hover spl_com_tbl">
							<tr style="background-color:#b8b8b8;">
								<th width="40%">Seller</th>
								<th width="40%">Membership Type</th>
								<th width="20%">Action</th>
							</tr>
							<?php
								if($membership){
									foreach($membership as $row):
							?>
							<tr>
								<td><?=$row->business_name?></td>
								<td><?=$row->membrship_name?></td>
								<td></td>
							</tr>
							<?php
									endforeach;
								}else{
							?>
							<tr>
								<td colspan="3" class="a-center">No records found !</td>
							</tr>
							<?php
								}
							?>
						</table>
					</div>
				</div>
			</div>

	</body>
</html>               