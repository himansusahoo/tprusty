<!DOCTYPE html>
<html lang="en"><head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="<?//php echo $result->meta_descrp; ?>" content="">
        <meta name="<?//php echo $result->meta_keyword; ?>" content="" />
        
		<meta name="author" content="">
		<title><?//php echo $result->title ;?></title>

<?php include "header.php" ?>

<!------ Start Content ------>

	<div class="main-content">
		
	
<div class="not-found">
<div class="error_img"><img src="<?php echo base_url();?>images/error-404.png" width="" height="" alt=""></div>

<div class="error_txt">
<h1 style=" color: #312857;font-size: 30px; font-weight:300; line-height: normal;">
<strong style="font-size:100px; color:#6bb700; ">OOPS..</strong> <br><strong> the Page or Product requested was not found</strong> :- ( </h1> <br><br>
Try to go back to the home page - <a href="<?=APP_BASE?>">Home »</a>
</div>

<div class="clearfix"></div>

</div>
    
    
	
	<?php include "footer.php" ?>

<script>
function addWishlistFunction(product_id,sku){
	$.ajax({
		url:'<?php echo base_url(); ?>user/add_wishlist',
		method:'post',
		data:{product_id:product_id,sku:sku},
		success:function(result){
			
			if(result=='success'){
				alert('successfully added');
			}
			if(result=='exists'){
				window.location.href='<?php echo base_url(); ?>wish-list';
			}
		}
	});
}
</script>

</body>

</html>