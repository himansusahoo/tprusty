<!DOCTYPE html>
<html lang="en"><head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content = "width = device-width, initial-scale =1.0, user-scalable = no">
		<meta name="description" content="<?php echo $result->meta_descrp; ?>">
        <meta name="keywords" content="<?php echo $result->meta_keyword; ?>" />

		<title><?php echo $result->title ;?></title>

<?php include "header.php" ?>

<!------ Start Content ------>

	<div class="main-content">
    <div class="container">
		<h3 class="title3"><?=$result->title?></h3>
		<?=$result->content?>
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