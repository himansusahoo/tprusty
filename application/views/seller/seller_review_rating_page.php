<?php
require_once('header.php');
?>	
	
	<div id="content">    
		<div class="top-bar">
			<div class="seller_support_mail">For any query, Please Mail us <?=SELLER_MAIL?></div>
			<!-- header_session included here -->
			<?php require_once('header_session.php'); ?>
		</div>  <!-- @end top-bar  -->
		
		<div class="main-content">
			<?php require_once('common.php');  ?>
			<?php
				$seller_review_row = $seller_review_data->num_rows();
				if($seller_review_row > 0){
				////script start for avarage rating/////////
				$rating = array();
				foreach($seller_review_data->result() as $val){ 
					$rating[] = $val->rating;
				}
				$total_sum_of_rating = array_sum($rating);
				$average_rating = ceil($total_sum_of_rating / $seller_review_row) ;		
				////script end for avarage rating/////////
						
				$slr_data = $seller_review_data->result();
				$seller_business = $slr_data[0]->business_name;
				$seller_desc = $slr_data[0]->business_desc;
				$seller_id = $slr_data[0]->seller_id;
				
			?>
			<div class="seller-logo"> <img src="<?php echo base_url()?>images/seller-logo.jpg" width="134" height="89" alt=""></div>
			<div class="seller-details">
				<div class="col-md-7">
					<h2><?= $seller_business ;?></h2>
					<div>
						<select id="backing2c" disabled>
							<option value="1" <?php if($average_rating == 1){ echo 'selected';} ?>>Bad</option>
							<option value="2" <?php if($average_rating == 2){ echo 'selected';} ?>>OK</option>
							<option value="3" <?php if($average_rating == 3){ echo 'selected';} ?>>Great</option>
							<option value="4" <?php if($average_rating == 4){ echo 'selected';} ?>>Excellent</option>
							<option value="5" <?php if($average_rating == 5){ echo 'selected';} ?>>Excellent1</option>
						</select>
						<div class="rateit" data-rateit-backingfld="#backing2c" data-rateit-min="0"></div>
						(<?= $seller_review_row ;?> reviews)
					</div>
					<p><?=$seller_desc?></p>
				</div><div class="clearfix"></div><?php } ?>
				<div class="seller_review_rating">
					<h3>Seller Review & Rating</h3>
					<table class="table table-bordered" cellspacing="0" cellpadding="0" border="0">
						<?php $result_review = $seller_review_data->result();
						if($result_review){
							foreach($result_review as $val){ 
						?>
						<tr>
							<td width="25%"><?=$val->fname?></td>
							<td width="75%"><?=$val->content?></td>
						</tr>
						<?php }}else{?>
						<tr><td class="a-center">No review found.</tr></td>
						<?php
							}
						?>
					</table>
				</div>
			</div><!-- close seller-details-->
			
		</div>
	</div>
	
	<!--Review script start here-->
	<link href="<?php echo base_url(); ?>rateit/src/rateit.css" rel="stylesheet" type="text/css">
	<script src="<?php echo base_url(); ?>rateit/src/jquery.rateit.js" type="text/javascript"></script>
	<!--Review script end here-->
	
	<style>
		.seller_review_rating{padding:10px;}
	</style>		
<?php
require_once('footer.php');
?>	