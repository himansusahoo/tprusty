			<div class="top-bar">
				<div class="top-left">
<?php include 'sub_catalog.php'; ?>
				</div>
                    
<!-- header_session included here -->
<?php
require_once('header_session.php');
?>
<!-- header_session included here -->

			</div>  <!-- @end top-bar  -->
<?php
$seller_signup_id = $this->session->userdata('seller-signup-session');
if(!$seller_signup_id) : 
?>
            <div style="padding-top:60px; margin:0px 50px;">
				<div class="alert alert-danger" role="alert"> *Important ! You have not completed signup. To complete click <a href="<?php echo base_url();?>seller/seller/incomplete_signup"><strong>here</strong></a></div>
			</div>
<?php
endif;
?>