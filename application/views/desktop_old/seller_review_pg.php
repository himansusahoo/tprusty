<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content = "width = device-width, initial-scale =1.0, user-scalable = no">
		<meta name="Description" content="<?php //echo $data->meta_descrp ;?>">
        <meta name="Keywords" content="<?php //echo $data->meta_keyword ;?>" />

		<!--<title><?php //echo $data->title ;?></title>-->
        <title><?php echo 'Moonboy.in : Seller Profile :'.$seller_data[0]->business_name  ;?></title>
        <link rel="canonical" href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2)?>"/>

    <?php include "header.php" ;
	
	$this->db->cache_on();
	?>
	

<!------ Start Content ------>
<div class="main-content">
<ul class="back"><li><!--<i class="back_arrow"> </i>Back to <a href="index.html">Men's Clothing</a>--></li></ul>

<div class="container">
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
		//print_r($seller_id);exit;
		
	?>
     <!--<div class="seller-logo"> <img src="<?//php echo base_url()?>images/seller-logo.jpg" width="134" height="89" alt=""></div>-->
    
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
    <p><?= $seller_desc ;?></p>
    <?php
	 $query=$this->db->query("select sum(quantity) as quantity_count from  ordered_product_from_addtocart where seller_id='$seller_id' and product_order_status='Delivered'");
	 $row=$query->result();
	 $c = $row['0']->quantity_count;
	 if($c <= 99){
		 echo "<p> <strong> Less than 100 Products sold </strong> </p> ";
	 }else if($c > 99 && $c <= 199){
		 echo "<p> <strong> More than 100 Products sold </strong> </p> ";
	 }else if($c > 199 && $c <= 499){
		 echo "<p> <strong> More than 200 Products sold </strong> </p> ";
	 }else{
		 echo "<p> <strong> More than 500 Products sold </strong> </p> ";
	 }
	 ?>
     
    <!--<p> <strong> More than Products sold </strong> </p> -->
    </div>
    <div class="col-md-2 right">
    <ul class="seller-badge">
    <li>
     <?php
   foreach($seller_badge as $val){
	   					$badge = $val->seller_badge_type;
						if($badge){
					$badge_array = explode(',', $badge);
					
						?>
					
	                <?php
	
                        if(in_array('Moonboy Fulfilled', $badge_array)){
					?>
                    <img src="<?php echo base_url()?>images/moon-fulfilled.png" >
					<?php
						}
						if(in_array('Fast Shipping', $badge_array)){
					?>
					<img src="<?php echo base_url()?>images/fast-delivery.png">								
					<?php
						}
						if(in_array('Star Seller', $badge_array)){
						?>
							<img src="<?php echo base_url()?>images/star-seller.png">								
					<?php	
						} ?><?php }} ?></li>
     
  </ul>  
  </div> <div class="clearfix"></div></div>
    <div class="clearfix"> &nbsp;</div>
    
    <div class="col-md-3" style="padding-left:0px;">
    <ul class="slr-nav">
    <li> <a href="#"> Product From This Seller </a></li>
    <li> <a href="#revw"> Reviews </a></li>
    </ul>
    </div>
    
    
    <div class="col-md-9">
    
   <div class="prdct-frm-selr">
   
   <ul>
   <?php
   foreach($seller_data as $val){ 
					//$seller_badge = $val->seller_badge_type;
					//$badge_array = explode(',', $seller_badge);
					
					$extimg_sku=$val->sku;
					$qr_slrprodimg=$this->db->query("select b.image  from seller_product_master a INNER JOIN  seller_existingproduct_image b ON a.seller_exist_product_id=b.seller_extproduct_id WHERE  a.sku='$extimg_sku' ");
								if($qr_slrprodimg->num_rows()>0)
								{
									$image=$qr_slrprodimg->row()->image;
									$dsply_img = $qr_slrprodimg->row()->image;
									
								}
								else
								{	$image=$val->imag;
									$dsply_img = $val->catelog_img_url;
								}
					
					
					// echo $val->name;exit;
					$image_arr=explode(',',$image);
					$cdate = date('Y-m-d');
					$special_price_from_dt = $val->special_pric_from_dt;
					$special_price_to_dt = $val->special_pric_to_dt;
					 ?>
			
   <li>
   
  <?php /*?> <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($val->name)))).'/'.$val->product_id.'/'.$val->sku  ?>" ><?php */?>
   
   <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($val->name)))).'/'.$val->product_id.'/'.$val->sku  ?>" >
   
   <?php /*?> <a href="<?php echo base_url().'product_description/product_detail/'.str_replace(" ","-",strtolower($val->name)).'/'.$val->product_id.'/'.$val->sku  ?>"><?php */?>
   
   	<?php if(empty($dsply_img)){?>
    <img class="etalage_thumb_image img-responsive" src="<?php echo base_url();?>images/product_img/prdct-no-img.png" alt="<?=$val->name;?>">
    <?php }else{?>
    <img class="etalage_thumb_image img-responsive" src="<?php echo base_url();?>images/product_img/<?=$image_arr[0];?>" alt="<?=$val->name;?>">
    <?php } ?>
   
   <div class="best-slr-data">
   <h5 class="product-name"><?= substr($val->name,0,60).'...';?><?php //echo $val->name;?></h5>
   
   <div class="price-box"><?php 
		if($val->special_price !=0){ 
			if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
		?>
        
        <span class="regular-price"> Rs. <?=ceil($val->price); ?> </span> &nbsp;&nbsp;
        <span class="price"> Rs. <?=ceil($val->special_price); ?> </span>
		<?php }else{ ?>


        <span class="price"> Rs. <?=ceil($val->price); ?> </span>
            <?php } //End of date condition ?>
        
        <?php }else{ ?>
        <span class="price"> Rs. <?=ceil($val->price); ?> </span>
        <?php } ?></div>
   </div>
    </a> </li> <?php }?>
    
    <div class="clearfix"> &nbsp; </div>
   </ul>
   </div>
    
    <div class="clearfix"> &nbsp; </div>
    
    <a name="revw"></a><h4>REVIEWS & RATINGS</h4><hr/>
   <table width="100%" class="table-striped">
	<?php
		$sl=0;
		foreach($seller_review_data->result() as $review_row){ 
		$sl++;
	?>
	<tr>
        <td width="20%">
            <select id="backing<?= $sl; ?>c<?= $sl; ?>" disabled>
                <option value="1" <?php if($review_row->rating == 1){ echo 'selected';} ?>>Bad</option>
                <option value="2" <?php if($review_row->rating == 2){ echo 'selected';} ?>>OK</option>
                <option value="3" <?php if($review_row->rating == 3){ echo 'selected';} ?>>Great</option>
                <option value="4" <?php if($review_row->rating == 4){ echo 'selected';} ?>>Excellent</option>
                <option value="5" <?php if($review_row->rating == 5){ echo 'selected';} ?>>Excellent1</option>
            </select>
            <div class="rateit" data-rateit-backingfld="#backing<?= $sl; ?>c<?= $sl; ?>" data-rateit-min="0"></div>
       
        <?php
		$date = $review_row->added_date;
		$dt = new DateTime($date);
		?>
      <h4> <span style="color:#5d9b05;"> <?= $review_row->fname ; ?> </span> <span class="rev_date">on <?= $dt->format('Y-m-d'); ?> </span></h4>
     </td>
        <td width="80%"> <h4> <?= $review_row->title ; ?> </h4>
       <p> <?= $review_row->content ; ?> </p></td>
        
    </tr>
    
    <?php } ?>
</table>

</div>
<?php }else{ ?>

<!--<div class="seller-logo"> <img src="<?//php echo base_url()?>images/seller-logo.jpg" width="134" height="89" alt=""></div>-->
<div class="seller-details">
<div class="col-md-7">

<h2><?= $seller_data[0]->business_name ;?></h2>
<div>
    <select id="backing3c" disabled>
        <option value="1">Bad</option>
        <option value="2">OK</option>
        <option value="3">Great</option>
        <option value="4">Excellent</option>
        <option value="5">Excellent1</option>
    </select>
    <div class="rateit" data-rateit-backingfld="#backing3c" data-rateit-min="0"></div>
    (<?= $seller_review_row ;?> reviews)
</div>
<p><?= $seller_data[0]->business_desc ;?></p>
<?php
     $seller_id=$seller_data[0]->seller_id;
	 //print_r($seller_id);exit;
	 $query=$this->db->query("select sum(quantity) as quantity_count from  ordered_product_from_addtocart where seller_id='$seller_id' and product_order_status='Delivered'");
	 $row=$query->result();
	 $c = $row['0']->quantity_count;
	 if($c <= 99){
		 echo "<p> <strong> Less than 100 Products sold </strong> </p> ";
	 }else if($c > 99 && $c <= 199){
		 echo "<p> <strong> More than 100 Products sold </strong> </p> ";
	 }else if($c > 199 && $c <= 499){
		 echo "<p> <strong> More than 200 Products sold </strong> </p> ";
	 }else{
		 echo "<p> <strong> More than 500 Products sold </strong> </p> ";
	 }
	 ?>
 <!--<p> <strong> More than <?php echo $row['0']->quantity_count; ?> Products sold </strong> </p> -->

</div> 
<div class="col-md-2 right">
    <ul class="seller-badge">
    <li>
     <?php
   foreach($seller_badge as $val){
					$badge = $val->seller_badge_type;
					if($badge){
					$badge_array = explode(',', $badge);
					
						?>
					
	                <?php   
	
                        if(in_array('Moonboy Fulfilled', $badge_array)){
					?>
                    <img src="<?php echo base_url()?>images/moon-fulfilled.png" >
					<?php 
						}
						if(in_array('Fast Shipping', $badge_array)){
					?>
					<img src="<?php echo base_url()?>images/fast-delivery.png">								
					<?php
						}
						if(in_array('Star Seller', $badge_array)){
						?>
							<img src="<?php echo base_url()?>images/star-seller.png">								
					<?php	
						} ?><?php }} ?></li>
                        
      <!--<li> <img src="<?//php echo base_url()?>images/moon-fulfilled.png"  alt="" width="" height=""> </li>							
	  <li>  <img src="<?//php echo base_url()?>images/star-seller.png"  alt="" width="" height="">	 </li>
      <li> <img src="<?//php echo base_url()?>images/fast-delivery.png"  alt="" width="" height=""> </li>-->
  </ul>  
  </div>
   <div class="clearfix"></div>
 </div>
  <div class="clearfix"> &nbsp;</div>
    
    <div class="col-md-3" style="padding-left:0px;">
    <ul class="slr-nav">
    <li> <a href="#"> Product From This Seller </a></li>
    <li> <a href="#revw"> Reviews </a></li>
    </ul>
    </div>
    
    
    <div class="col-md-9">
    
   <div class="prdct-frm-selr">
   
   <ul>
   <?php
   foreach($seller_data as $val){ 
					//$seller_badge = $val->seller_badge_type;
					//$badge_array = explode(',', $seller_badge);
					$extimg_sku=$val->sku;
					$qr_slrprodimg=$this->db->query("select b.catelog_img_url  from seller_product_master a INNER JOIN  seller_existingproduct_image b ON a.seller_exist_product_id=b.seller_extproduct_id WHERE  a.sku='$extimg_sku' ");
								if($qr_slrprodimg->num_rows()>0)
								{
									$image=$qr_slrprodimg->row()->catelog_img_url;								
									
								}
								else
								{	$image=$val->catelog_img_url;
									
								}
					
					
					//$image=$val->catelog_img_url;
					//$skuid=$val->sku;
					// echo $val->name;exit;
					$image_arr=explode(',',$image); 
					$cdate = date('Y-m-d');
					$special_price_from_dt = $val->special_pric_from_dt;
					$special_price_to_dt = $val->special_pric_to_dt;
					
					if($val->product_id!='' && $val->sku!='' && $image_arr[0]!=''){
					?>
			
   <li>
   <div class="view view-fifth">
   <?php /*?> <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($val->name)))).'/'.$val->product_id.'/'.$val->sku  ?>" ><?php */?>
    
    <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($val->name)))).'/'.$val->product_id.'/'.$val->sku  ?>" >
   
    <?php /*?><a href="<?php echo base_url().'product_description/product_detail/'.str_replace(" ","-",strtolower($val->name)).'/'.$val->product_id.'/'.$val->sku  ?>"><?php */?>
   <img class="etalage_thumb_image img-responsive" src="<?php echo base_url().'images/product_img/'.$image_arr[0]; ?>" alt="<?=$val->name;?>"></a> </div>
   <div class="best-slr-data">
   
  <?php /*?> <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($val->name)))).'/'.$val->product_id.'/'.$val->sku  ?>" ><?php */?>
   
    <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($val->name)))).'/'.$val->product_id.'/'.$val->sku  ?>" >
   <h6 class="product-name"><?= substr($val->name,0,40).'...';?></h6>
   </a>
   
   <div class="price-box">
   <?php 
		if($val->special_price !=0){
			if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
		?> 
        
        <span class="regular-price"> Rs. <?=ceil($val->price); ?> </span> &nbsp;&nbsp;
        <span class="price"> Rs. <?=ceil($val->special_price); ?> </span>
		<?php }else{ ?>


        <span class="price"> Rs. <?=ceil($val->price); ?> </span>
            <?php } //End of date condition ?>
        
        <?php }else{ ?>
        
        
        <?php if($val->price != 0){?>
        <span class="regular-price"> Rs. <?=ceil($val->mrp); ?> </span> &nbsp;&nbsp;
        <span class="price"> Rs. <?=ceil($val->price); ?> </span> &nbsp;&nbsp;
        <?php }else{?>
        <span class="price"> Rs. <?=ceil($val->mrp); ?> </span> &nbsp;&nbsp;
        <?php }?>
        
        
        <!--<span class="price"> Rs. <?//=ceil($val->price); ?> </span>-->
        <?php } ?></div>
   </div>
    </li> <?php 
	
					}
					else{ //////////////Data Not found
					?>
						
						
						
					 <li> 
                     <?php /*?> <a href="<?php echo base_url().'product_description/product_detail/'.preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($val->name)))).'/'.$val->product_id.'/'.$val->sku  ?>" ><?php */?>
                      
                      <a href="<?php echo base_url().preg_replace('#"#',"-",preg_replace('#/#',"-",str_replace(' ','-',strtolower($val->name)))).'/'.$val->product_id.'/'.$val->sku  ?>" >
                     
                     <?php /*?><a href="<?php echo base_url().'product_description/product_detail/'.str_replace(" ","-",strtolower($val->name)).'/'.$val->product_id.'/'.$val->sku  ?>"><?php */?>
   <img  src="http://www.moonboy.in/images/loading_seller.gif" >
   <div class="best-slr-data">
   <h6 class="product-name"><?php // echo $val->name;?></h6>
   <div class="price-box">
   <?php 
		//if($val->special_price !=0){ 
//			if($cdate >= $special_price_from_dt && $cdate <= $special_price_to_dt){
		?> 
        
        <span class="regular-price"> <!--Rs.--> <?php // echo ceil($val->price); ?> </span> &nbsp;&nbsp;
        <span class="price"><!-- Rs.--> <?php // echo ceil($val->special_price); ?> </span>
		<?php // }else{ ?>


        <span class="price"><!-- Rs.--> <?php //echo ceil($val->price); ?> </span>
            <?php //  } //End of date condition ?>
        
        <?php //}else{ ?>
        <span class="price"> <!--Rs.--> <?php //echo ceil($val->price); ?> </span>
        <?php //} ?></div>
   </div>
    </a> </li>	
						
												
					<?php ////	
					}
	}?>
    <div class="clearfix"> &nbsp; </div>
   </ul>
   			<div class="pagination">
							<p><?php if(isset($links)) {echo '<li>'.$links.'</li>';} ?></p>
						</div>			
   </div>
    
    <div class="clearfix"> &nbsp; </div>

<h4>REVIEWS & RATINGS</h4><hr/>
<table width="100%" class="table-striped">
     <tr height="20px"><td colspan="5">No Reviews.</td></tr>
</table></div>
<?php } ?>
</div>
 
<?php include "footer.php" ?>



<!--Review script start here-->
<link href="<?php echo base_url(); ?>rateit/src/rateit.css" rel="stylesheet" type="text/css">
<!--<script src="<?php// echo base_url(); ?>rateit/src/jquery.min.js" type="text/javascript"></script>-->
<script src="<?php echo base_url(); ?>rateit/src/jquery.rateit.js" type="text/javascript"></script>
<!--Review script end here-->

</body>

</html>