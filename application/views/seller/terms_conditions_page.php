<?php
require_once('header.php');
?>	
	
			<div id="content">    
				<div class="top-bar">
										
					<!-- header_session included here -->
					<?php
					require_once('header_session.php');
					?>
				</div>  <!-- @end top-bar  -->
				
				<!-- 31 
				<?php
				$seller_signup_id = $this->session->userdata('seller-signup-session');
				if(!$seller_signup_id) :
				?>
							<div style="padding-top:60px; margin:0px 50px;">
								<div class="alert alert-danger" role="alert"> *Important ! You have not completed signup. To complete click <a href="<?php echo base_url();?>seller/seller/incomplete_signup"><strong>here</strong></a></div>
							</div><br>
				<?php
				endif;
				?>-->
				
				<div class="main-content">
					<?php require_once('common.php'); ?>
					<h1>Terms & Conditions</h1>
                    
                    <?php echo @$tc_data[0]->tc_content; ?>
					<!--<p><strong>Terms & Conditions :</strong></p>
					<p>We only accept payment in Indian currency(INR) for all products purchased.</p>
					<p>Purchases are subjected to delivery charges as stated in the Cart at time of purchase.</p>
					<p><strong>Payment Terms :</strong></p>
					<p>We accept various forms of payment modes e.g. Credit Card / Debit Card Online Bank Transfer . We will process your order immediately after the payments has been confirmed cleared by Online Payment Acceptance Service Provider.</p>-->
				
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->
<?php
require_once('footer.php');
?>