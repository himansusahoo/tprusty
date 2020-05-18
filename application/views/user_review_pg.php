<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content = "width = device-width, initial-scale =1.0, user-scalable = no">
		<meta name="<?php echo $data1->meta_descrp ;?>" content="">
        <meta name="<?php echo $data1->meta_keyword ;?>" content="" />
        
		
		<title><?php echo $data1->title ;?></title>

<?php include "header.php" ?>
<style>
.main-content {
    padding: 100px 0px 10px;
	width:100%;
}
.tab-pane {
    padding: 20px 10px;
    border-bottom: 1px solid #ccc;
    border-left: 1px solid #ccc;
    border-right: 1px solid #ccc;
}
.nav-tabs li a:hover {
    background-color: #fdbf14 !important;
    color: #fff !important;
}
</style>
<!------ Start Content ------>

<div class="main-content">
<div style="width:90%; margin:auto;">
	<h3>MY REVIEWS AND RATINGS</h3>
    <div class="off-section" style="padding:10px;">
		<ul class="nav nav-tabs tabs-horiz">
            <li id="li_tab1" class="active"><a data-toggle="tab" href="#tab1">Product Reviews</a></li>
            <li id="li_tab2"><a data-toggle="tab" href="#tab2">Seller Reviews</a></li>
        </ul>
        
        <!---- Tab content satrt here ---->
        <div class="tab-content form_view">
				<div id="tab1" class="tab-pane fade in active">
						<?php
                        	$no_of_product_review = $product_review->num_rows();
							if($no_of_product_review > 0){
								$result = $product_review->result();
                        ?>
					<h3>Reviews by <?=$result[0]->fname;?> (<?= $no_of_product_review;?>)</h3>
                    <?php
						$i=0;
						foreach($product_review->result() as $product_rev_rows){
							$i++;
							$date1 = $product_rev_rows->added_date;
							$dt1 = new DateTime($date1);
							$arr_img = explode(',',$product_rev_rows->imag);
							
							$cdate = date('Y-m-d');
							$special_price_from_dt = $product_rev_rows->special_pric_from_dt;
							$special_price_to_dt = $product_rev_rows->special_pric_to_dt;
							
							$taxdecimal = $product_rev_rows->tax_rate_percentage/100;
							
							//tax amount for product price
							$tax_amount = $product_rev_rows->price*$taxdecimal;
							
							//tax amount for product special price
							$tax_amount_special = $product_rev_rows->special_price*$taxdecimal;
					?> 
                    
                    <!-- Review start-->
                    <div class="review">
                     <div class="rev_product">
                     	<div class="rev_product_img"><img src="<?php echo base_url(); ?>images/product_img/<?=$arr_img[0]; ?>"></div>
                        <div class="rev_product_inn">
                        
                        	<h4 class="product-name" >
                            <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(" ","-",strtolower($product_rev_rows->name)))).'/'.$product_rev_rows->product_id.'/'.$product_rev_rows->sku ?>" target="_blank">
                             <?= $product_rev_rows->name;?> </a>
                             </h4>
                            
                            
                              <p>  
                              <!--Price: <strong class="price">Rs. <?//= $product_rev_rows->price;?> </strong> -->
                              
                            <?php /*?>  <?php 
							  if($product_rev_rows->special_price !=0){ 
								  if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
							  ?> 
							  
							  <span class="regular-price"> Rs. <?=ceil($product_rev_rows->price); ?> </span> &nbsp;&nbsp;
							  <span class="price"> Rs. <?=ceil($product_rev_rows->special_price); ?> </span>
							  <?php }else{ ?>
							  <span class="price"> Rs. <?=ceil($product_rev_rows->price); ?> </span>
								  <?php } //End of date condition ?>
							  
							  <?php }else{ ?>
							  <span class="price"> Rs. <?=ceil($product_rev_rows->price); ?> </span>
							  <?php } ?><?php */?>
                              
                              
                      <!--- Pricing script start here --->
                      <!---Special price exists condition start here --->
                      <?php
                      if($product_rev_rows->special_price !=0){
                          if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
                      ?>
                      
                      <span class="regular-price"> Rs. <?=ceil($product_rev_rows->mrp); ?> </span> &nbsp;&nbsp;
                      
                      <?php if($product_rev_rows->price != 0){?>
                      <span class="regular-price"> Rs. <?=ceil($product_rev_rows->price); ?> </span> &nbsp;&nbsp;
                      <?php }?>
                      
                      <span class="price"> Rs. <?=ceil($product_rev_rows->special_price); ?> </span>
                      <!---Special price exists condition end here --->
                      <?php }else{ ?>
                      
                      <?php if($product_rev_rows->price != 0){?>
                      <span class="regular-price"> Rs. <?=ceil($product_rev_rows->mrp); ?> </span> &nbsp;&nbsp;
                      <span class="price"> Rs. <?=ceil($product_rev_rows->price); ?> </span> &nbsp;&nbsp;
                      <?php }else{?>
                      <span class="price"> Rs. <?=ceil($product_rev_rows->mrp); ?> </span> &nbsp;&nbsp;
                      <?php }?>
                      
                      <?php } //End of date condition ?>
                      
                      <?php }else{ ?>
                      
                      <?php if($product_rev_rows->price != 0){?>
                      <span class="regular-price"> Rs. <?=ceil($product_rev_rows->mrp); ?> </span> &nbsp;&nbsp;
                      <span class="price"> Rs. <?=ceil($product_rev_rows->price); ?> </span> &nbsp;&nbsp;
                      <?php }else{?>
                      <span class="price"> Rs. <?=ceil($product_rev_rows->mrp); ?> </span> &nbsp;&nbsp;
                      <?php }?>
                      
                      <?php } ?>
                      <!--- Pricing script end here --->
                                    
                              
                              <br>
                               <?php $desc=$product_rev_rows->short_desc;
					 $descp=unserialize(substr($desc,0));
					 $desc1=implode(',',$descp);?>
                               <?= $desc1;?></p>
                        </div>
                        <div class="clearfix"> </div>
                     </div>  
                     <div class="usr_product_rev_dv">
                     	<strong> <?= $product_rev_rows->title;?> </strong>&nbsp;&nbsp;&nbsp;<span class="rev_date">on <?= $dt1->format('Y-m-d'); ?></span><br/>
                        <span><strong style="color:#6bb700;"> <?= $product_rev_rows->fname;?> </strong>rated:
                        	<select id="backingd<?=$i; ?>" disabled>
                                <option value="1" <?php if($product_rev_rows->rating == 1){ echo 'selected';} ?>>Bad</option>
                                <option value="2" <?php if($product_rev_rows->rating == 2){ echo 'selected';} ?>>OK</option>
                                <option value="3" <?php if($product_rev_rows->rating == 3){ echo 'selected';} ?>>Great</option>
                                <option value="4" <?php if($product_rev_rows->rating == 4){ echo 'selected';} ?>>Excellent</option>
                                <option value="5" <?php if($product_rev_rows->rating == 5){ echo 'selected';} ?>>Excellent1</option>
                            </select>
    						<div class="rateit" data-rateit-backingfld="#backingd<?=$i; ?>" data-rateit-min="0"></div>
                        </span>
                        <p><?= $product_rev_rows->content;?></p>
                     </div> 
                     <div class="clearfix"> </div>
                     </div> <!-- Review End-->
                     <?php } } else{ ?>
                    <h4>REVIEWS (0)</h4>
                    <p>You have not written any product reviews.</p>
                     <?php } ?>
				</div>
				<div id="tab2" class="tab-pane fade">
                <?php $no_of_seller_review = $seller_review->num_rows();?>
                    <h4>REVIEWS (<?= $no_of_seller_review;?>)</h4>
                    <?php
					$sl=0;
					if($no_of_seller_review > 0){
						foreach($seller_review->result() as $rev_rows){
							$sl++;
							$date = $rev_rows->added_date;
							$dt = new DateTime($date);
					?>
					<div class="seller-review">
                    <h4 class="product-name">
                    <a href="<?php echo base_url() ;?>sellers/<?= base64_encode($this->encrypt->encode($rev_rows->seller_id));?>" target="_blank">
					<?= $rev_rows->business_name; ?></a>
                    </h4>
                    <select id="backing<?= $sl; ?>c<?= $sl; ?>" disabled>
                        <option value="1" <?php if($rev_rows->rating == 1){ echo 'selected';} ?>>Bad</option>
                        <option value="2" <?php if($rev_rows->rating == 2){ echo 'selected';} ?>>OK</option>
                        <option value="3" <?php if($rev_rows->rating == 3){ echo 'selected';} ?>>Great</option>
                        <option value="4" <?php if($rev_rows->rating == 4){ echo 'selected';} ?>>Excellent</option>
                        <option value="5" <?php if($rev_rows->rating == 5){ echo 'selected';} ?>>Excellent1</option>
                    </select>
                    <div class="rateit" data-rateit-backingfld="#backing<?= $sl; ?>c<?= $sl; ?>" data-rateit-min="0"></div>&nbsp;
                    <span class="rev_date"> on <?= $dt->format('Y-m-d'); ?></span><br/>
                    <h4 ><?= $rev_rows->title; ?></h4>
                    <p><?= $rev_rows->content; ?></p>
                    </div> 
				<?php } }else{?>
                <p>You have not written any seller reviews.</p> 
                
                <?php } ?>
				</div>
                
            </div>
            
        <!---- Tab content satrt here ---->
        
	</div>
</div>
<?php include "footer.php" ?>

<!--Review script start here-->
<link href="<?php echo base_url(); ?>rateit/src/rateit.css" rel="stylesheet" type="text/css">
<!--<script src="<?php// echo base_url(); ?>rateit/src/jquery.min.js" type="text/javascript"></script>-->
<script src="<?php echo base_url(); ?>rateit/src/jquery.rateit.js" type="text/javascript"></script>
<!--Review script end here-->

</body>

</html>