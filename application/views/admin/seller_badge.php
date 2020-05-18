<?php
require_once("header.php");
?>

<script>
	function addSellerBadge(){
		var base_url = '<?php echo base_url();?>';
		var controller = 'admin/sellers/';
		window.location.href = base_url+controller+'sellerbadgeaddform';
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
                    	<div class="col-md-8"><b> Seller Badge </b></div>
						<div class="col-md-4 show_report">
							<button type="button" class="all_buttons" onclick="addSellerBadge()">Add Seller Badge</button>
						</div>
					</div>
                    <div class="clearfix"></div>
					<div class="form_view">
						<h3>Seller Badge Settings </h3>
					</div>
					<div>
						<table class="table table-bordered table-hover spl_com_tbl">
							<tr style="background-color:#b8b8b8;">
								<th width="30%">Seller Name</th>
								<th width="20%">Seller Type</th>
								<th width="15%">From Date</th>
								<th width="15%">To Date</th>
								<th width="20%">Action</th>
							</tr>
							<?php
								if($seller_badge){
									foreach($seller_badge as $row):
							?>
							<tr>
								<td><?=$row->business_name?></td>
								<td><?=$row->seller_badge_type?></td>
								<td><?=$row->from_date?></td>
								<td><?=$row->to_date?></td>
								<td> 
									<a href="<?php echo base_url(); ?>admin/sellers/edit_seller_badge/<?=base64_encode($this->encrypt->encode($row->id));?>" title="Edit"><i class="fa fa-pencil-square-o" style="font-size:19px;"></i></a> &nbsp;&nbsp;&nbsp;   
									<a href="<?php echo base_url(); ?>admin/sellers/delete_seller_badge/<?=base64_encode($this->encrypt->encode($row->id));?>" title="Delete"><i class="fa fa-trash-o" style="font-size:19px;"></i></a>
								</td>
							</tr>
							<?php
									endforeach;
								}else{
							?>
							<tr>
								<td colspan="5" class="a-center">No records found !</td>
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