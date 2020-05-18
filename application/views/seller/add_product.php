<?php
require_once('header.php');
?>
<script>
$(document).ready(function(){
	$('form').submit(function(){
		var base_url = "<?php echo base_url(); ?>";
		var controller = "seller/catalog";
		var search_title = $('#search_title').val(); //alert(search_title); return false;
		if(search_title == ""){
			alert("Please enter product name");
			return false;
		}
	});
});

function add_product(){
	var base_url = "<?php echo base_url(); ?>";
	var controller = "seller/catalog";
	window.location.href = base_url + controller + '/add_new_product';
}
</script>

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
					<?php require_once('common.php'); ?>
					<div class="content-header">
						<h3>Add New Product</h3>
					</div>
					<div class="main_seller_prodt">
						<div class="search_prod">
							<h2><center>Go for existing product on moonboy.in</center></h2>
							<!--<div class="search"> 
								<!--<div><h4>Please enter product name</h4></div>
							<form class="search">-->
							<?php	
                            $attributes = array('class' => 'search');
                            echo form_open_multipart('seller/catalog/search_existing_product', $attributes);
                            ?>
								<input type="text" name="search_title" id="search_title" placeholder="Paste Product URL Here.." >
								<input type="submit" id="search_submit" class="srch-btn" value="Search">
							</form>
							<!--</div>-->
							<p><center>The product you want to create may already exist in moonboy.in. Search for it and add it directly to your listing.</center></p>
						</div>
						<div class="exist_prod">
							<h2><center>Your product does not exist on moonboy.in?</center></h2>
							<div class="exist_prod_new_list">
								<center><button type="button" onclick="add_product()">Create a new Product</button></center>
							</div>
							<p><center>NOTE: Please use "Add listings in bulk" for subcategories not available here.</center></p>
						</div>
					</div>
				</div>  <!-- @end #main-content -->
			</div><!-- @end #content -->
<?php
require_once('footer.php');
?>