<?php
require_once('header.php');
?>

			<div id="content">    
				<div class="top-bar">
					<div class="top-left">
						<?php include 'sub_catalog.php'; ?>
					</div>
					<?php
						require_once('header_session.php');
					?>
				</div>
				<!-- @end top-bar  -->
				<div class="main-content">
					<?php require_once('common.php');
						if($notice_list){
					?>
						<h3>Seller Notices</h3>
<?php
	foreach($notice_list as $result){
?>
							<div class="alert alert-danger"><?=$result->content?></div><br>

<?php
	}
}else{
?>	
		<div class="a-center">No notice found!</div>
<?php
}
?>
			</div>  <!-- @end #main-content -->
		</div><!-- @end #content -->


<?php
require_once('footer.php');
?>					