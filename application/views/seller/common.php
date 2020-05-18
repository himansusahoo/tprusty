
<!-- Session checking for Incomplete signup -->
<?php
$seller_signup_id = $this->session->userdata('seller-signup-session');
if(!$seller_signup_id) : 
?>
	<div style="margin:-12px 50px 8px;">
		<div class="alert alert-danger" role="alert"> *Important ! You have not completed signup. To complete click <a href="<?php echo base_url();?>seller/seller/incomplete_signup"><strong>here</strong></a></div>
	</div>
<?php
endif;

/*  Session checking for Seller notice  **/
$seller_notice_session = $this->session->userdata('seller-notice-session'); 
if($seller_notice_session) :
?>
	<div class="alert alert-danger"  role="alert" style="margin-top:-12px;"> <?=$seller_notice_session?> </div>
    <div class="clearfix"> &nbsp; </div>
<?php
endif;
?>
